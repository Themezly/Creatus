<?php if (!defined('FW')) die('Forbidden');

class ThzBuilderTemplates {
	
	
	private $api_uri;
	private $api_tpl;
	private $no_cache;
	
	/**
	 * Get cpac
	 */
	private $has_cpac = false;

	/**
	 * ThzBuilderTemplates constructor.
	 */
	public function __construct() {
		
		if (!function_exists('fw_get_path_url')) {
			return;
		}
		
		$this->no_cache 	= apply_filters( '_thz_filter_library_no_cache', false );
		$this->api_uri 		= apply_filters( '_thz_filter_library_api_url', 'https://resources.themezly.io/api/v1/info' );
		$this->api_tpl 		= apply_filters( '_thz_filter_library_api_tpl', 'https://resources.themezly.io/api/v1/template/' );
		
		$this->has_cpac();
		
		add_action(
			'fw_ext_builder:option_type:builder:enqueue',
			array($this, '_action_enqueue')
		);
		add_action(
			'wp_ajax_thz-theme-builder-templates-render',
			array($this, '_ajax_render')
		);
		add_action(
			'wp_ajax_thz-theme-builder-templates-load',
			array($this, '_ajax_load')
		);
		
		add_action(
			'wp_ajax_thz-theme-builder-templates-update',
			array($this, '_ajax_update')
		);
	}

	/**
	 * @return bool
	 */
	public function current_user_allowed() {
		return current_user_can('edit_posts');
	}


	/**
	 * Current dir url
	 * @param string
	 * @return string
	 */
	private function get_url($append = '') {
		
		try {
			$url = FW_Cache::get($cache_key = 'thz-theme:pred-tpl:url');
		} catch (FW_Cache_Not_Found_Exception $e) {
			FW_Cache::set(
				$cache_key,
				$url = get_template_directory_uri().'/inc/includes/builder-templates/'
			);
		}
		return $url . $append;
	}
	

	/**
	 * @param array $data
	 * @return void
	 * @internal
	 */
	public function _action_enqueue($data) {
		
		if ($data['option']['type'] !== 'page-builder') {
			return;
		}

		$prefix = 'thz-theme-';

		wp_enqueue_style(
			$prefix .'pb-pred-tpl',
			$this->get_url( '/static/styles.css' ),
			array(),
			fw()->theme->manifest->get_version()
		);

		wp_enqueue_script(
			$prefix .'pb-pred-tpl',
			$this->get_url( '/static/scripts.js'),
			array('jquery', 'fw-events'),
			fw()->theme->manifest->get_version(),
			true
		);

		wp_localize_script(
			$prefix .'pb-pred-tpl',
			'_theme_pb_pred_tpl',
			array(
				'l10n' => array(
					'add_button' => esc_html__('Template Library', 'creatus'),
				),
			)
		);
	}

	public function _ajax_render() {
		$r = array(
			'error' => '',
			'data' => array(),
		);

		do {
			if (!$this->current_user_allowed()) {
				$r['error'] = 'Forbidden';
				break;
			}

			$list = $this->get_list();
			
			$r['data']['html'] = fw_render_view(
				dirname(__FILE__) .'/views/sections.php',
				array(
					'sections' => $list['sections'],
					'sections_categories' => $list['sections_categories'],
					'last_update' => get_option('thz:builder:tpl:last:update', 0),
					'can_update' => $this->can_update(),
					'cpac' => $this->has_cpac
				)
			);
		} while(false);

		if ($r['error']) {
			wp_send_json_error(
				is_wp_error($r['error'])
					? $r['error']
					: new WP_Error('error', $r['error'])
			);
		} else {
			wp_send_json_success($r['data']);
		}
	}

	public function _ajax_load() {
		$r = array(
			'error' => '',
			'data' => array(),
		);

		do {
			if (!$this->current_user_allowed()) {
				$r['error'] = 'Forbidden';
				break;
			}

			if (empty($_POST['id'])) {
				$r['error'] = 'Id not specified';
				break;
			}

			$id = $_POST['id'];

			$list = $this->get_list();

			if (!isset($list['sections'][ $id ])) {
				$r['error'] = 'Invalid id';
				break;
			}
			
			if( 'remote' == $list['sections'][ $id ]['source'] ){
				
				$r['data']['json'] = $this->fetch_template( $id ) ;
				
			}else{
				
				$json_path = get_stylesheet_directory() .'/inc/includes/builder-templates/'. $id .'/json.php' ;
				$r['data']['json'] = fw_render_view( $json_path );
			}
			
			
		} while(false);

		if ($r['error']) {
			wp_send_json_error(
				is_wp_error($r['error'])
					? $r['error']
					: new WP_Error('error', $r['error'])
			);
		} else {
			wp_send_json_success($r['data']);
		}
	}
	
	public function _ajax_update() {
		$r = array(
			'error' => '',
			'data' => array(
				'updated' => false
			),
		);

		do {
			
			if (!$this->current_user_allowed()) {
				$r['error'] = 'Forbidden';
				break;
			}
			
			$u = $this->can_update() ? _thz_force_template_library_update() : false;
			$r['data']['updated'] = $u;
			
		} while(false);

		if ($r['error']) {
			wp_send_json_error(
				is_wp_error($r['error'])
					? $r['error']
					: new WP_Error('error', $r['error'])
			);
		} else {
			wp_send_json_success($r['data']);
		}
	}
	
	
	private function can_update(){
		
		$last_update = get_option('thz:builder:tpl:last:update', 0);
		
		if( $last_update <= strtotime('-15 minutes') ){
			
			return true;
		}
		
		return false;
	}
	
	private function process_json( $json ){
 
		$result = preg_replace_callback('/<p%(.*?)%p>/', function($match) {
			
			$replaced = $match[0];
			
			if( isset($match[1]) ){
				
				$vars 		= explode(',',$match[1]);
				$replaced 	= thz_dummy_post_ids( $vars[0],$vars[1] );
				
			}
			
			return $replaced; 

		}, $json);          
		
		
		return $result;
		
	}
	
	
	private function fetch_template( $id ){

		$transient = 'thz:builder:tpl:'.$id;
		
		if ( $this->no_cache || false === ( $template_data = get_transient( $transient ) ) ) {
			
			delete_transient( $transient );
			
					
			$response = wp_remote_get( $this->get_api_uri( 'template', $id ) , array( 'timeout' => 20 ) );
			$httpCode = wp_remote_retrieve_response_code( $response );
	
			if ( $httpCode >= 200 && $httpCode < 300 ) {
				
				$template_data = wp_remote_retrieve_body( $response );
				
			} else {
				
				$template_data = esc_html__( 'Not able to load builder templates', 'creatus' );
				
			}	
			
			set_transient( $transient, $template_data, 7 * DAY_IN_SECONDS );
			
		}
		
		
		$media_importer = new Thz_Media_Importer( $template_data );
		$template_data = $media_importer->get_template_json();

		return $this->process_json( $template_data );	
		
	}

	private function fetch_list(){
		
		$transient = 'thz:builder:tpl:info';

		if ( $this->no_cache || false === ( $templates_data = get_transient( $transient ) ) ) {
			
			delete_transient( $transient );
			
			$response = wp_remote_get( $this->get_api_uri( 'list' ) , array( 'timeout' => 20 ) );
			$httpCode = wp_remote_retrieve_response_code( $response );
	
			if ( $httpCode >= 200 && $httpCode < 300 ) {
				
				$templates_data = wp_remote_retrieve_body( $response );
				
			} else {
				
				$templates_data = esc_html__( 'Not able to load builder templates', 'creatus' );
				
			}
			
			update_option ('thz:builder:tpl:last:update', time() );
			set_transient( $transient, $templates_data, 7 * DAY_IN_SECONDS );
		
		}

		$data = json_decode($templates_data ,true );

		return $data;
							
	}

	/**
	 * Get resource URI
	 *
	 * @param string $type - can have values 'list' or 'template'
	 * @param string $prepend
	 *
	 * @return null|string
	 */
	private function get_api_uri( $type = 'list', $prepend = '' ){
		switch( $type ){
			case 'list':
				$uri = $this->api_uri . $prepend;
			break;
			case 'template':
				$uri = $this->api_tpl . $prepend;
			break;
			default:
				$uri = null;
			break;
		}

		if( !is_null( $uri ) && $this->has_cpac ){
			$uri = add_query_arg( array( 'cpac' => $this->has_cpac ), $uri );
		}

		return $uri;
	}
	
	
	private function has_cpac(){
		
		$cpac = thz_has_cpac();
		
		if( $cpac ){
			$this->has_cpac = $cpac;
		}		
	}
	
	private function get_list() {

		$fetched_list = $this->fetch_list();

		$r = array(
			'sections_categories' => $fetched_list['sections_categories'],
			'sections' => $fetched_list['sections'],
		);
		
		$paths = array();
		
		if( is_child_theme() ){
			
			$child = glob( get_stylesheet_directory(). '/inc/includes/builder-templates/*',GLOB_ONLYDIR);
			if(is_array($child) && !empty($child) ){
				$paths = array_merge($paths, $child);
			}
		}
		
		if ( !empty($paths) ) {
						
			foreach ($paths as $path) {
				
				$id = basename($path);

				$cfg = array_merge(
					array(
						'desc' => '',
						'categories' => array(),
					),
					include ($path .'/config.php')
				);
			  	
				$r['sections'][$id] = array(
					'thumbnail' => get_stylesheet_directory_uri() . '/inc/includes/builder-templates/'.$id.'/thumbnail.jpg',
					'source' => 'local',
					'desc' => $cfg['desc'],
					'categories' => $cfg['categories'],
				);

				$r['sections_categories'] = array_merge($r['sections_categories'], $cfg['categories']);
			}
		}

		return $r;
	}
}

/**
 * Class Thz_Media_Importer
 * Import media files into the local Media Gallery
 */
class Thz_Media_Importer{
	/**
	 * JSON encoded template data
	 * @var JSON string
	 */
	private $template_data;
	/**
	 * Will store any images found into the content
	 * @var array
	 */
	private $found_images = array();

	/**
	 * Thz_Media_Importer constructor.
	 *
	 * @param JSON string $template_data
	 */
	public function __construct( $template_data ) {
		$this->template_data = $template_data;
		// begin image detection. Will store all found images in $this->found_images
		$this->find_images( json_decode( $template_data, true ) );

		if( !$this->found_images ){
			return;
		}

		$this->fetch_remote_images();
	}

	/**
	 * @param string $key - the key that needs to be found
	 * @param array $array - array to be searched
	 *
	 * @return null
	 */
	private function find_images( $array ){
		
		if( !is_array($array) ){
			return;
		}
		
		foreach ( $array as $kk => $a ) {
			if( is_array( $a ) ) {
				if( ( 'image' == $kk && array_key_exists( 'url', $a ) ) || array_key_exists( 'attachment_id', $a ) ){
					$this->found_images[] = $a;
				}

				$this->find_images( $a );
			}
		}
	}

	/**
	 * Fetches all remote images from the template
	 */
	private function fetch_remote_images(){
		foreach( $this->found_images as $key => $image ) {
			if( is_array( $image ) && false === strpos( $image['url'], 'resources.themezly.io' ) ){
				unset( $this->found_images[ $key ] );
				continue;
			}

			// process images
			if ( is_array( $image ) ) {
				$image_id = false;
				// try to detect image ID
				if( isset( $image['attachment_id'] ) ){
					$image_id = $image['attachment_id'];
				}else if ( isset( $image['id'] ) ){
					$image_id = $image['id'];
				}
				// if no image ID detected, to avoid creating duplicates in media gallery, skip image import
				if( !$image_id ){
					unset( $this->found_images[ $key ] );
					continue;
				}

				$args = array(
					'post_type'  => 'attachment',
					'meta_query' => array(
						array(
							'key'     => 'thz_image_id',
							'value'   => $image_id,
							'compare' => '='
						)
					)
				);
				$img  = get_posts( $args );
				if ( $img ) {
					$this->found_images[ $key ]['wp_image_id'] = $img[0]->ID;
				} else {
					$img_id = $this->import_image( $image['url'], $image_id );
					if ( $img_id && !is_wp_error( $img_id ) ) {
						$this->found_images[ $key ]['wp_image_id'] = $img_id;
					}
				}
			}
		}
	}

	/**
	 * Import an image into WP Media Gallery based on its URL
	 *
	 * @param $image_url
	 * @param bool $unique_id
	 *
	 * @return bool|int|WP_Error
	 */
	private function import_image( $image_url, $unique_id = false ){
		if( 'http' != substr( $image_url, 0, 4 )){
			$image_url = 'http:' . $image_url;
		}

		// get the thumbnail
		$response = wp_remote_get(
			$image_url,
			array(
				'sslverify' => false,

				/**
				 * Request timeout filter
				 * @var int
				 */
				'timeout' => apply_filters( 'thz_image_request_timeout', 5 )
			)
		);

		if( is_wp_error( $response ) || 200 != wp_remote_retrieve_response_code($response) ) {
			return false;
		}

		$image_contents = $response['body'];
		$image_type 	= wp_remote_retrieve_header( $response, 'content-type' );
		// Translate MIME type into an extension
		if ( $image_type == 'image/jpeg' ){
			$image_extension = '.jpg';
		}elseif ( $image_type == 'image/png' ){
			$image_extension = '.png';
		}

		$file_name = basename( $image_url ) ;

		// Save the image bits using the new filename
		$upload = wp_upload_bits( $file_name, null, $image_contents );
		if ( $upload['error'] ) {
			return false;
		}

		$img_url 	= $upload['url'];
		$filename 	= $upload['file'];

		$wp_filetype = wp_check_filetype( basename( $filename ), null );
		$attachment = array(
			'post_mime_type'	=> $wp_filetype['type'],
			'post_title'		=> $file_name,
			'post_content'		=> '',
			'post_status'		=> 'inherit',
			'guid'				=> $img_url
		);
		$attach_id = wp_insert_attachment( $attachment, $filename );
		// you must first include the image.php file
		// for the function wp_generate_attachment_metadata() to work
		require_once( ABSPATH . 'wp-admin/includes/image.php' );
		$attach_data = wp_generate_attachment_metadata( $attach_id, $filename );
		wp_update_attachment_metadata( $attach_id, $attach_data );

		// Add field to mark image as a video thumbnail
		update_post_meta( $attach_id, 'thz_image_id', $unique_id );

		return $attach_id;
	}

	/**
	 * Get the update template with local paths instead of remote ones
	 * @return JSON|mixed
	 */
	public function get_template_json(){
		if( !$this->found_images ){
			return $this->template_data;
		}

		// store strings to search for
		$s = array();
		// store replacements for the strings
		$r = array();

		foreach( $this->found_images as $image ){
			if( isset( $image['wp_image_id'] ) ){
				$img_id = $image['wp_image_id'];
				$local_url = wp_get_attachment_image_src( $img_id, 'full' );
				if( !$local_url ){
					continue;
				}
				unset( $image['wp_image_id'] );
				$s[] = json_encode( $image );
				$r[] = json_encode( array(
					'attachment_id' => $img_id,
					'url' => $local_url[0]
				));
				$s[] = $image['url'];
				$r[] = $local_url[0];
			}
		}

		return str_replace( $s, $r, $this->template_data );
	}
}