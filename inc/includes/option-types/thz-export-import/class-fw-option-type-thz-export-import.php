<?php if ( ! defined( 'ABSPATH' ) ) die( 'Direct access forbidden.' );

class FW_Option_Type_ThzExportImport extends FW_Option_Type {
	private $option_type = 'thz-export-import';

	public function get_type() {
		return $this->option_type;
	}
	/**
	 * @internal
	 */
	public function _get_backend_width_type()
	{
		return 'auto';
	}
	
	protected function _init() {
		
		add_action('wp_ajax_thz_import_preset', array($this, '_action_ajax_preset_import'));
		add_action('wp_ajax_thz_page_options_import', array($this, '_action_ajax_page_options_import'));
		add_action('wp_ajax_thz_settings_import', array($this, '_action_ajax_settings_import'));
		add_action('wp_ajax_thz_settings_export', array($this, '_action_ajax_settings_export'));
	}
	
	/**
	 * @internal
	 */
	protected function _enqueue_static( $id, $option, $data ) {

		$uri = get_template_directory_uri() .'/inc/includes/option-types/'. $this->get_type() .'/static';

		fw()->backend->option_type('multi-select')->enqueue_static();
		
		wp_enqueue_style(
			'fw-option-' . $this->get_type(),
			$uri . '/css/styles.css'
		);

		wp_enqueue_script(
			'fw-option-' . $this->get_type(),
			$uri . '/js/scripts.js',
			array('jquery', 'fw-events','fw-selectize'),
			fw()->manifest->get_version()
		);
		
		
		
		wp_localize_script('fw-option-'. $this->get_type(), '_thzexpimp', array(
			'warning' => esc_html__('Importing  preset','creatus'),
			'warning2' => esc_html__('You are about to import settings preset','creatus'),
			'warning3' => esc_html__('Click on the blue button to continue','creatus'),
			'warning4' => esc_html__('Note that import will automatically save the options in the database!','creatus'),
			'warning5' => esc_html__('Continue importing preset','creatus'),
			'pwarning' => esc_html__('Importing  settings from ','creatus'),
			'pwarning2' => esc_html__('You are about to import settings from','creatus'),
			'pwarning3' => esc_html__('Click on the blue button to continue','creatus'),
			'pwarning4' => esc_html__('Note that import will automatically save the options in the database!','creatus'),
			'pwarning5' => esc_html__('Continue importing settings from','creatus'),
			'importing' => esc_html__('Importing','creatus'),
			'importing2' => esc_html__('We are currently importing your settings','creatus'),
			'importing3' => esc_html__('This may take a few moments','creatus'),
			'reloading' => esc_html__('Import Successful!','creatus'),
			'reloading2' => esc_html__('Reloading page. Please wait...','creatus'),
			'saving' => esc_html__('Saving options please wait...','creatus'),
			'saving2' => esc_html__('Download dialog will apear after the options have been saved...','creatus'),
			'importcustom' => esc_html__('Select a file please','creatus'),
			'importcustom2' => esc_html__('JSON files only','creatus'),
			'importcustom3' => esc_html__('Importing your settings please wait...','creatus'),
			'importcustom4' => esc_html__('This page will reload after the import.','creatus'),
			'importcustom5' => esc_html__('Importing page settings please wait...','creatus'),
			)
		);

	}

	/**
	 * @param string $id
	 * @param array $option
	 * @param array $data
	 *
	 * @return string
	 *
	 * @internal
	 */
	protected function _render( $id, $option, $data ) {


		$secret = md5( md5( AUTH_KEY . SECURE_AUTH_KEY ) . '-' . fw()->theme->manifest->get_id() );
		$export_url = admin_url( 'admin-ajax.php?action=thz_settings_export&secret=' . $secret );
		$import_url = admin_url( 'admin-ajax.php?action=thz_settings_import&secret=' . $secret );
		
		return fw_render_view( dirname(__FILE__) . '/view.php', array(
			'import' 		=> $this,
			'id'            => $id,
			'option'        => $option,
			'data'          => $data,
			'defaults'      => $this->get_defaults(),
			'export_url'	=> $export_url,
			'import_url'	=> $import_url,
		) );

	}

	/**
	 * @param array $option
	 * @param array|null|string $input_value
	 *
	 * @return string
	 *
	 * @internal
	 */
	protected function _get_value_from_input( $option, $input_value ) {
		return (string) ( is_null( $input_value ) ? $option['value'] : $input_value );
	}

	/**
	 * @internal
	 */
	protected function _get_defaults() {
		return array(
			'value' => ''
		);
	}

	
	/**
	 * @internal
	 */
	public static function _action_ajax_settings_import(){
		

		if ( empty ( $_FILES ) ) {
			
			wp_send_json_error( 
				array(
					'message' => esc_html__('File is not uploaded','creatus')
				)
			);
			exit;
		}
			
		if ($_FILES["file"]["error"] > 0) {
			
			// error
			wp_send_json_error( 
				array(
					'message' => esc_html__('Something went wrong. Please check the .json file and try again', 'creatus')
				)
			);
			exit;
			
		} else {

			$wpfs 	 = thz_wp_file_system();
			$options = $wpfs->get_contents($_FILES["file"]["tmp_name"]);
		

			try {
	

				$options = json_decode( $options, true );

				if ( !empty ( $options ) && json_last_error() == JSON_ERROR_NONE ) {

					
					fw_set_db_settings_option(null,$options);
					update_option( 'thz_dynamic_css:'.get_template(), array() );
					update_option( 'thz_theme_files_log:'.get_template(),array() );	
					remove_theme_mod('fw_options');
										
					wp_send_json_success( 
						array(
							'message' => esc_html__('Import successful','creatus')
						)
					);

					exit;

				}

	
			} catch (Exception $e) {
			
			}


		}

		
		
		wp_send_json_error( 
			array(
				'message' => esc_html__('Invalid input data for import settings','creatus')
			)
		);
		exit;

	}

	/**
	 * @internal
	 */
	public static function _action_ajax_preset_import(){

		if ( empty ( $_POST['preset'] ) ) {
			wp_send_json_error( 
				array(
					'message' => esc_html__('Something went wrong. Please check the .json file and try again', 'creatus')
				)
			);
			exit;
		}
		
		
		$wpfs 	 		= thz_wp_file_system();
		$preset_name 	= $_POST['preset'];
		$preset  	 	= thz_theme_file_path ( '/inc/thzframework/presets/'.$preset_name.'.json' );
		$data 	 		= $wpfs->get_contents( $preset );


		try {

			$data = json_decode( $data, true );

			if ( !empty ( $data ) && json_last_error() == JSON_ERROR_NONE ) {

				fw_set_db_settings_option(null,$data);
				
				update_option('thz_default_preset',$preset_name);
				update_option('thz_dynamic_css:'.get_template(), array() );
				update_option('thz_theme_files_log:'.get_template(),array() );	
				remove_theme_mod('fw_options');				
				
				wp_send_json_success( 
					array(
						'message' => esc_html__('Import successful','creatus')
					)
				);

				exit;

			}


		} catch (Exception $e) {
			
		}

		wp_send_json_error( 
			array(
				'message' => esc_html__('Invalid input data for import settings','creatus')
			)
		);
		exit;
	}
	

	public static function _action_ajax_page_options_import(){

		if ( empty ( $_POST['page_id'] ) ) {
			wp_send_json_error( 
				array(
					'message' => esc_html__('Something went wrong. Please check the page ID', 'creatus')
				)
			);
			exit;
		}
		
		
		$page_id = (int) $_POST['page_id'];
		$data 	 = self::thz_import_page_options( $page_id );


		try {

			if ( $data ) {

				update_option('thz_dynamic_css:'.get_template(), array() );
				update_option('thz_theme_files_log:'.get_template(),array() );	
				remove_theme_mod('fw_options');				
				
				wp_send_json_success( 
					array(
						'message' => esc_html__('Import successful','creatus')
					)
				);

				exit;

			}


		} catch (Exception $e) {
			
		}

		wp_send_json_error( 
			array(
				'message' => esc_html__('This page does not contain custom options','creatus')
			)
		);
		exit;
	}
	

	public static function thz_import_page_options($page_id) {
		
		if(!$page_id){
			return false;
		}
		
		$groups = array(
			'post' => fw_get_db_post_option($page_id ,'custom_post_options/0'),
			'pagetitle' => fw_get_db_post_option($page_id ,'custom_pagetitle_options/0'),
			'site' => fw_get_db_post_option($page_id ,'custom_site_options/0'),
			'header' => fw_get_db_post_option($page_id ,'custom_header_options/0'),
			'logo' => fw_get_db_post_option($page_id ,'custom_logo/0'),
			'mainmenu' => fw_get_db_post_option($page_id ,'custom_mainmenu_options/0'),
			'footer' => fw_get_db_post_option($page_id ,'custom_footer_options/0')
		);
		
		$filter_groups = array_filter($groups);
		if( empty( $filter_groups ) ){
			return false;
		}
		
		$updated = false;
		
		foreach( $groups as $group_options){
			if( $group_options ){
				foreach( $group_options as $option_id => $value ){
					fw_set_db_settings_option($option_id, $value);
					$updated = true;
				}
			}
		}
		
		return $updated;
	}
		
	/**
	 * @internal
	 */
	public static function _action_ajax_settings_export() {

		if ( ! isset( $_GET['secret'] ) || $_GET['secret'] != md5( md5( AUTH_KEY . SECURE_AUTH_KEY ) . '-' . fw()->theme->manifest->get_id() ) ) {
			wp_die( 'Invalid Secret' );
			exit;
		}

		if ( isset( $_GET['action'] ) && $_GET['action'] == 'thz_settings_export' ) {
			header( 'Content-Description: File Transfer' );
			header( 'Content-type: text/html' );
			header('Content-Disposition: attachment; filename="'.THEME_NAME.'-theme-settings-'.date("d-M-y-h-i-s").'.json"');
			header( 'Content-Transfer-Encoding: binary' );
			header( 'Expires: 0' );
			header( 'Cache-Control: must-revalidate' );
			header( 'Pragma: public' );
			
			$options 		= fw_get_db_settings_option();
			
			$remove = array(
				'home_url',
				'site_url',
				'wp_version',
				'wp_multisite',
				'wp_debug_mode',
				'wp_memory_limit',
				'server_info',
				'php_version',
				'php_post_max_size',
				'php_time_limit',
				'php_max_input_vars',
				'suhosin_installed',
				'zip_archive',
				'mysql_version',
				'max_upload_size',
				'fsockopen',
				'legend',
			);
			
			foreach($remove as $notin){
				unset($options[$notin]);	
			}
			
			$options 		= json_encode ( $options );
			
			echo $options;
			exit;
		}else{
			
			wp_send_json_error( 
				array(
					'message' => esc_html__('Invalid input data for export settings','creatus')
				)
			);
			exit;
		
		}

	}
}


FW_Option_Type::register( 'FW_Option_Type_ThzExportImport' );