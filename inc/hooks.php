<?php
/**
 * @package      Thz Framework
 * @author       Themezly
 * @license      http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 * @websites     http://www.themezly.com | http://www.youjoomla.com | http://www.yjsimplegrid.com
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // No direct access
}

// theme constants
define( 'THZDS', DIRECTORY_SEPARATOR );
define( 'THEME_NAME', strtolower( get_template() ) );
	
	
/**
 *	Framework dir
 *  @internal
 */
function _thz_filter_framework_dir( $rel_path ) {
	return '/inc/thzframework';
}
add_filter( 'fw_framework_customizations_dir_rel_path', '_thz_filter_framework_dir' );


/**
 *	Page builder div class name
 *  @internal
 */
function _thz_filter_page_builder_class() {
	return 'thz-page-builder-content';
}

add_filter( 'fw_ext_page_builder_content_wrapper_class', '_thz_filter_page_builder_class' );


/**
 * Keep current preset as default on theme options reset
 * @internal
 */
function _thz_action_keep_current_preset( $old_values ) {
	
	$preset = fw_akg('presets',$old_values,'starter');
	
	update_option( 'thz_default_preset', $preset);
}

add_action('fw_settings_form_reset', '_thz_action_keep_current_preset');


/**
 * Theme default setup
 * @internal
 */
function _thz_action_theme_setup() {

	// set default preset
	$preset 		= thz_get_theme_option_early('presets',null);
	$default_preset = get_option( 'thz_default_preset',null);
	
	if(!$preset && $default_preset){
		$preset = $default_preset;
	}
	
	thz_set_preset($preset);
	
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on creatus, use a find and replace
	 * to change 'creatus' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'creatus', get_template_directory() . '/languages' );
	
	if(is_child_theme()){
		load_child_theme_textdomain('creatus', get_stylesheet_directory() . '/languages');
	}
	
	// Default WP generated title support
	add_theme_support( 'title-tag' );
	// Default RSS feed links
	add_theme_support( 'automatic-feed-links' );
	// Default custom header
	add_theme_support( 'custom-header' );
	// Default custom backgrounds
	add_theme_support( 'custom-background' );
	// Woocommerce Support
	add_theme_support( 'woocommerce' );
	// Post Formats
	add_theme_support( 'post-formats', array( 'audio', 'gallery', 'video', 'quote', 'link' ) );

	//Switch default core markup for search form, comment form, and comments
	add_theme_support( 'html5', array(
		 'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption' 
	 ) );
	 
	if( !thz_fw_loaded() ){ 
		$logo_defaults = array(
			'height'      => 80,
			'width'       => 300,
			'flex-height' => true,
			'flex-width'  => true,
			'header-text' => array( 'site-title', 'site-description' ),
		);
		add_theme_support( 'custom-logo', $logo_defaults );
	}

}

add_action( 'after_setup_theme', '_thz_action_theme_setup' );


/**
 * Add custom image sizes
*/
if ( ! function_exists( '_thz_action_add_image_sizes' ) ){ 

	function _thz_action_add_image_sizes(){
		
		// Add post thumbnail functionality
		add_theme_support('post-thumbnails');
		
		// Default image sizes
		$default_image_sizes = array(
		
			'thz-img-large'=> 1200,
			'thz-img-medium'=> 570,
			'thz-img-small'=> 350,
	
		);
			
		foreach (array_keys( $default_image_sizes ) as $img_opt ){
			
			$width = thz_get_theme_option_early( 'thz-img-sizes/'.$img_opt,$default_image_sizes[$img_opt]);
			
			add_image_size( $img_opt , $width,'', false );
			
		}
		
		unset ($default_image_sizes);
			
			
		// Custom image sizes
		$thz_custom_image_sizes = thz_get_theme_option_early('custom_image_sizes',array());
		
		
		if( !empty($thz_custom_image_sizes) ){
			
			foreach ($thz_custom_image_sizes as $img_size ){
				
				$size_name 			=  strtolower (str_replace(' ','',thz_akg('size_name',$img_size)));
				$image_sizes		=  thz_akg('image_sizes',$img_size);
				$max_width 			=  thz_akg('max-width',$image_sizes);
				$max_height 		=  thz_akg('max-height',$image_sizes);
				$crop_mode_picked	=  thz_akg('crop_mode/picked',$img_size);
				
				
				if($crop_mode_picked == 'custom'){
					$crop = array(thz_akg('crop_mode/custom/custom_crop/customx',$img_size),thz_akg('crop_mode/custom/custom_crop/customy',$img_size));
				}else if($crop_mode_picked == 'softcrop'){
					$crop = false;
				}else if($crop_mode_picked == 'hardcrop'){
					$crop = true;
				}
				if($size_name !=''){
					add_image_size( $size_name , $max_width, $max_height, $crop );
				}
				
			}
			unset ($thz_custom_image_sizes);
		}	
		
	}

}

/**
 * Image sizes loader
 */
function _thz_image_sizes_loader(){
	$priority = is_admin() ? 9 : 11;
	add_action( 'after_setup_theme', '_thz_action_add_image_sizes', $priority );
}

add_action( 'after_setup_theme', '_thz_image_sizes_loader', -999 );

/**
 * Image size names
 */
function _thz_filter_image_size_names( $sizes ) {
	
	$size_names = array(
	
		'thz-img-large' => esc_html__( 'Thz Large', 'creatus' ) ,
		'thz-img-medium' => esc_html__( 'Thz Medium', 'creatus' ),
		'thz-img-small' => esc_html__( 'Thz Small', 'creatus' ) ,
		'medium_large'  => esc_html__('Medium Large','creatus'),
	);	
	
	
	$thz_custom_image_sizes = thz_get_theme_option('custom_image_sizes',array());
	
	if(is_array($thz_custom_image_sizes) && !empty($thz_custom_image_sizes)){
		
		foreach ($thz_custom_image_sizes as $img_size ){
			
			$size_name 	=  strtolower (str_replace(' ','',thz_akg('size_name',$img_size)));
			if($size_name !=''){
				$size_names[$size_name] = ucfirst ( thz_akg('size_name',$img_size));
			}
		}
	}
	
	$custom_size_names = array_merge( $sizes, $size_names );
	return $custom_size_names;
}

add_filter( 'image_size_names_choose', '_thz_filter_image_size_names' );


/**
 * Do not resize image if certain name
 * default_sizes = leaves 3 default WP sizes
 * do_not_resize = does not resize image at all
 */
 
function _thz_filter_do_not_resize_image( $sizes, $meta ) {
	
	if( isset($meta['file']) ){
		
		if( thz_contains( $meta['file'], 'default_sizes' ) ){
		
			return array(
				'thumbnail' => $sizes['thumbnail'],
				'medium' => $sizes['medium'],
				'large' => $sizes['large']
			);
		
		}
		
		if( thz_contains( $meta['file'], 'do_not_resize' ) ){
			
			return array();
		}
		
				
	}
		
	return $sizes;

}

add_filter('intermediate_image_sizes_advanced', '_thz_filter_do_not_resize_image', 10, 2);


/**
 * Max image width
 */
function _thz_filter_max_srcset_image_width( $max_width ) {
    	return 1920;
} 


add_filter( 'max_srcset_image_width', '_thz_filter_max_srcset_image_width', 10, 2  );


/**
 * Register the required theme plugins.
 */
function thz_required_plugins() {

    /**
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = _thz_get_tgmpa_plugins_list();

    /**
     * Array of configuration settings. Amend each line as needed.
     * If you want the default strings to be available under your own theme domain,
     * leave the strings uncommented.
     * Some of the strings are added into a sprintf, so see the comments at the
     * end of each line for what each argument will be.
     */
    $config = array(
		'id'           => 'creatus',
        'menu'         => 'creatus-install-plugins', // Menu slug.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'is_automatic' => true,                   // Automatically activate plugins after installation or not.
    );
	
	
	$theme_id = defined('FW') ? fw()->theme->manifest->get_id() : 'creatus';
	$option_auto_setup = get_option('thz' . '_' . $theme_id . '_auto_install_state', array() );	
	
	
	if(!isset($option_auto_setup['steps'])){
		return;
	}
	
	if( isset( $option_auto_setup['steps']['auto-setup-step-choosed'] ) || $option_auto_setup['steps']['install-required-plugins'] != false ) {
		
		tgmpa( $plugins, $config );
	
	}

}
add_action( 'tgmpa_register', 'thz_required_plugins' );

/**
 * List of tgmpa plugins
 * Array of plugin arrays. Required keys are name and slug.
 * If the source is NOT from the .org repo, then source is also required.
 */
function _thz_get_tgmpa_plugins_list(){

	$plugins = array(
			
		// Public plugins
		'unyson'=> array(
			'name'      => 'Unyson',
			'slug'      => 'unyson',
			'required'  => false,
			'version'   => '1.0.0', 
		),
		'creatus-extended'=> array(
			'name'               => 'Creatus Extended', // The plugin name.
			'slug'               => 'creatus-extended', // The plugin slug (typically the folder name).
			'required'           => false, // If false, the plugin is only 'recommended' instead of required.
			'version'            => '1.0.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher.
		),
		'assign-widgets'=> array(
			'name'               => 'Assign Widgets', // The plugin name.
			'slug'               => 'assign-widgets', // The plugin slug (typically the folder name).
			'required'           => false, // If false, the plugin is only 'recommended' instead of required.
			'version'            => '1.0.4', // E.g. 1.0.0. If set, the active plugin must be this version or higher.
		),
		'woocommerce'=> array(
			'name'      => 'WooCommerce',
			'slug'      => 'woocommerce',
			'required'  => false,
			'force_activation'   => false,
			'has_notices' => false,
		),
		'buddypress'=> array(
			'name'      => 'BuddyPress',
			'slug'      => 'buddypress',
			'required'  => false,
			'force_activation'   => false,
			'has_notices' => false,
		),
		'bbpress'=> array(
			'name'      => 'bbPress',
			'slug'      => 'bbpress',
			'required'  => false,
			'force_activation'   => false,
			'has_notices' => false,
		),

    );	
	
	return $plugins;
	
}


/**
 * List of plugins used in specific demo
 */
function _thz_get_demos_plugins_list () {
	return array(

		'creatus'    => array(
			array(
				'name' => 'WooCommerce',
				'slug' => 'woocommerce',
			),

		),
						
		'clean'    => array(
			array(
				'name' => 'WooCommerce',
				'slug' => 'woocommerce',
			),

		),
		
		'shopsy'    => array(
			array(
				'name' => 'WooCommerce',
				'slug' => 'woocommerce',
			),

		),

		'bruno'    => array(
			array(
				'name' => 'WooCommerce',
				'slug' => 'woocommerce',
			),

		),
	);
}


/**
 * Disable Unyson update 
 * if new update is bigger than max version
*/

function _thz_filter_disable_unyson_update( $updates ) {

   $requirements = defined('FW') ? fw()->theme->manifest->get('requirements') : false;
   
   if($requirements && isset($updates->response) && isset($requirements['framework']['max_version'])){
	   
	   $response = $updates->response;
	   
	   if(isset($response['unyson/unyson.php']) ){
	   	 
		 $new_version = $response['unyson/unyson.php']->new_version;
		 $max_version = $requirements['framework']['max_version'];
		 
		 if (version_compare($new_version, $max_version, ">")) {
			 
			unset( $updates->response['unyson/unyson.php'] );
		 }
		
	   }
   }
   
   return $updates;
}

add_filter( 'site_transient_update_plugins', '_thz_filter_disable_unyson_update' );


/**
 * Get passed var
 * @return array|string
 */
function thz_passed_var( $var = false ) {

	if ( !is_admin() ) {
		
	   static $get_vars = NULL;
	
	   if ( empty( $get_vars ) ) {
	
			$page_info 	= thz_get_page_type_info( null ,true);
			$get_vars 	= array(
				
				'no_builder' 	=> true,
				'blog_sql' 		=> 'posts',
				'blog_layout' 	=> 'blog'
			
			);
			
			if( $page_info['setby'] =='is_author()' || $page_info['setby'] == 'is_archive()') {
				$get_vars['blog_layout'] = 'archive';
			}		
			
			if ( $page_info['setby'] == 'is_author()' ) {
				
				$get_vars['blog_sql'] = 'author';
				
			} else if ( is_tag() ) {
				
				$tag 		= get_query_var( 'tag' );
				$get_vars['blog_sql'] ='tag|'.$tag;
				
			} else if  (  $page_info['setby'] == 'is_archive()' && !is_tag() ) {
				
				$year 					= get_query_var( 'year' );
				$monthnum 				= get_query_var( 'monthnum' );

				$get_vars['blog_sql'] 	= 'archive|'.$year.'|'.$monthnum.'';
				
			}

			if( is_singular('fw-portfolio')  && thz_has_builder() ){ 
			
				$project_layout		= thz_get_option('project_layout/picked','full');
				if( 'builder' == $project_layout ){	
					$get_vars['no_builder']	= false;
				}
			}		
	
	   }
	   
	   if($var){
		   
		   return $get_vars[$var];
		   
	   }else{
		
			return $get_vars;
	   
	   }
   
	}
}

/**
 * thz_passed_var is normal function but
 * we just need to run once to cache the vars
 * than we can use it in templates with no performance hits
 * thus we wont prefix it with _action as all other action functions
 */
add_action( 'template_redirect', 'thz_passed_var' );


/**
 * System info page
 */
function _thz_system_info(){
	
	thz_render_view( thz_theme_file_path ( '/inc/includes/auto-setup/views/system_info.php' ), array(),false);
	
}


/**
 * Set image quality
*/
 
function _thz_filter_jpeg_quality( $quality ) {
    return thz_get_theme_option( 'image_quality',90 );
}
add_filter( 'image_quality', '_thz_filter_jpeg_quality' );



/*
 * Global scripts register
 */
function _thz_action_register_admin_scripts() {
	
	wp_register_style( 'thz-icons', thz_theme_file_uri( '/assets/fonts/thz-icons-pack/style.css' ), false, thz_theme_version() ,'all');
	wp_register_style( 'thz-admin', thz_theme_file_uri( '/inc/thzframework/admin/css/thz-admin.css' ), false, thz_theme_version(), 'all' );
	
	// Font face kits
	thz_register_font_face_kits();
	
	wp_register_script( 'thz-admin-plugins', thz_theme_file_uri( '/inc/thzframework/admin/js/thz.admin.plugins.js'), array(
		 'jquery' 
	) );
	wp_register_script( 'thz-admin', thz_theme_file_uri( '/inc/thzframework/admin/js/thz.admin.js'), array(
		 'jquery',
		 'thz-admin-plugins' 
	));
	
}

function _thz_action_register_frontend_scripts() {

	$preset = get_option('thz_default_preset','starter');
	
	// styles
	wp_register_style( 'thz-icons', thz_theme_file_uri( '/assets/fonts/thz-icons-pack/style.css' ), false, thz_theme_version() ,'all');
	wp_register_style( THEME_NAME. '-woocommerce', thz_theme_file_uri( '/assets/css/woocommerce.css' ), false, thz_theme_version() ,'all' );
	wp_register_style( THEME_NAME. '-bbpress', thz_theme_file_uri( '/assets/css/bbpress.css'), false, thz_theme_version() ,'all' );
	wp_register_style( THEME_NAME. '-theme', thz_theme_file_uri( '/assets/css/thz-theme.css'), false, thz_theme_version() ,'all' );
	wp_register_style( THEME_NAME. '-layout', thz_theme_file_uri( '/assets/css/thz-layout.css' ), false, thz_theme_version() ,'all' );
	wp_register_style( THEME_NAME. '-menus', thz_theme_file_uri( '/assets/css/thz-menus.css'), false, thz_theme_version() ,'all' );
	wp_register_style( THEME_NAME. '-units', thz_theme_file_uri( '/assets/css/thz-units.css' ), false, thz_theme_version() ,'all' );
	wp_register_style( THEME_NAME. '-utility', thz_theme_file_uri( '/assets/css/thz-utility.css' ), false, thz_theme_version() ,'all' );
	wp_register_style( THEME_NAME. '-shortcodes', thz_theme_file_uri( '/assets/css/thz-shortcodes.css' ), false, thz_theme_version() ,'all' );
	wp_register_style( THEME_NAME. '-buttons', thz_theme_file_uri( '/assets/css/thz-buttons.css'), false, thz_theme_version() ,'all' );
	wp_register_style( THEME_NAME. '-animate', thz_theme_file_uri( '/assets/css/thz-animate.css'), false, thz_theme_version() ,'all' );
	wp_register_style( THEME_NAME. '-hovers', thz_theme_file_uri( '/assets/css/thz-hovers.css'), false, thz_theme_version() ,'all' );
	wp_register_style( THEME_NAME. '-magnific', thz_theme_file_uri( '/assets/css/thz-magnific.css' ), false, thz_theme_version() ,'all' );
	wp_register_style( THEME_NAME. '-rtl', thz_theme_file_uri( '/rtl.css' ), false, thz_theme_version() ,'all' );
	
	// placeholder file for inline CSS
	wp_register_style( THEME_NAME. '-print', false );
	
	/*  
	 * use theme mediaelement CSS
	 */
	wp_deregister_style('mediaelement');
	wp_deregister_style('wp-mediaelement');	


	if(thz_theme_file_path( '/assets/css/'.$preset.'.css')){
		wp_register_style( THEME_NAME. '-style', thz_theme_file_uri( '/assets/css/'.$preset.'.css'), false, thz_theme_version() ,'all' );
	}
	
	// Font face kits
	thz_register_font_face_kits();
	
	if(is_child_theme()){
		wp_register_style( THEME_NAME. '-child', get_stylesheet_directory_uri().'/style.css', false, thz_theme_version() ,'all' );
	}
	
	// scripts
	
	$minjs	 	= thz_get_theme_option('thzopt/minjs','donotminify');
	wp_register_script( THEME_NAME. '-plugins', thz_theme_file_uri( '/assets/js/thz.site.plugins.js'), array('jquery'), thz_theme_version(), true  );
	wp_register_script( THEME_NAME. '-init', thz_theme_file_uri( '/assets/js/thz.init.js'),array('jquery'), thz_theme_version(), false );

	if($minjs  == 'donotminify'){
		wp_register_script( THEME_NAME. '-site', thz_theme_file_uri( '/assets/js/thz.site.js'),array('jquery',THEME_NAME. '-plugins'), thz_theme_version(), true );
	}else{
	
		wp_register_script( THEME_NAME. '-site', thz_theme_file_uri( '/assets/js/thz.site.min.js'),array('jquery'), thz_theme_version(), true );
				
	}

	
}

/*
 * Since we have deregistered medialement styles
 * make sure media dependencies are loaded 
 * in case of frontend editros
 * watch ticket https://core.trac.wordpress.org/ticket/42751#ticket
 */
function _thz_action_enque_media_views_css() {
	
	if( wp_script_is( 'media-views','enqueued' ) ){
		
		wp_enqueue_style( 'buttons' );
		wp_enqueue_style( 'imgareaselect');
		wp_enqueue_style( THEME_NAME.'-media-views','/'. WPINC . '/css/media-views.min.css', false, thz_theme_version() ,'all' );		
	}
}

add_action( 'wp_enqueue_scripts', '_thz_action_register_frontend_scripts' );
add_action( 'wp_enqueue_scripts', '_thz_action_enque_media_views_css',20 );
add_action( 'admin_enqueue_scripts', '_thz_action_register_admin_scripts' );


/**
 * Admin scripts
 * @internal
 */
function _thz_action_admin_scripts() {

	$notice = '<div class="notice notice-error thz-sys-notice">';
	$notice .= '<p>';
	$notice .= '<strong>'.esc_html('Check system info page.','creatus').'</strong>';
	$notice .= '</p>';
	$notice .= '<p>';
	$notice .= sprintf( wp_kses(__( 'Please visit <a href="%s">System info page</a> before saving and make sure all values are marked with green check.', 'creatus' ), array( 'a' => array( 'href' => array(),'target' => array() ) ) ), self_admin_url('admin.php?page=system_info') );
	$notice .= '</p>';
	$notice .= '</div>';
	
	$notice;
		
	wp_enqueue_style('thz-icons');
	
	// Font face kits
	thz_admin_enqueue_font_face_kits_styles();
	
	wp_enqueue_style('thz-admin');
	wp_enqueue_script('thz-admin');
	wp_enqueue_script('thz-admin-plugins');
	
	if( thz_theme_file_path( '/admin-splash.png') ){
		
		$add_css ='.thz-side-tabs-list:after{';
		$add_css .='background-image: url('.thz_theme_file_uri( '/admin-splash.png').');';
		$add_css .='}';
		wp_add_inline_style( 'thz-admin', $add_css );
		
	}
	
	wp_localize_script( 'thz-admin', 'thzadminLocalize', array(
		 'siteurl' 			=> get_option( 'siteurl' ),
		 'themeurl' 		=> thz_theme_uri(),
		 'themeversion' 	=> thz_theme_version(),
		 'system_notice' 	=> htmlentities( $notice ),
		 'magnificlink1' 	=> esc_html__( ' Magnific popup', 'creatus' ),
		 'magnificlink2' 	=> esc_html__( 'If link is not an image the popup will be opened as Magnific popup iframe.', 'creatus' ),
		 'templates_button' => esc_html__( 'Template Library', 'creatus' ),
	) );
	
}

add_action( 'admin_enqueue_scripts', '_thz_action_admin_scripts');


/**
 * Remove additional jquery-ui style
 */
if ( ! function_exists( '_thz_action_remove_additional_jquery_ui_css' ) ) {
	
	function _thz_action_remove_additional_jquery_ui_css() {
	
		if ( class_exists( 'WooCommerce' )  ) {
			wp_dequeue_style( 'jquery-ui-style' );
		}
		
		if ( class_exists( 'AMPHTML' )  ) {
			wp_dequeue_style( 'amphtml-admin-ui-css' );
		}
	}
}

add_action( 'admin_enqueue_scripts', '_thz_action_remove_additional_jquery_ui_css', 99 );

/**
 *	Column thumbnails
 *  @internal
 */
function _thz_filter_add_column_images( $column_thumbnails ) {
	
	$column_thumbnails['1_1']['icon'] = 'thzadmin thzadmin-shortcode_columns_1_1';
	$column_thumbnails['1_2']['icon'] = 'thzadmin thzadmin-shortcode_columns_1_2';
	$column_thumbnails['1_3']['icon'] = 'thzadmin thzadmin-shortcode_columns_1_3';
	$column_thumbnails['1_4']['icon'] = 'thzadmin thzadmin-shortcode_columns_1_4';
	$column_thumbnails['1_5']['icon'] = 'thzadmin thzadmin-shortcode_columns_1_5';
	$column_thumbnails['1_6']['icon'] = 'thzadmin thzadmin-shortcode_columns_1_6';
	$column_thumbnails['2_3']['icon'] = 'thzadmin thzadmin-shortcode_columns_2_3';
	$column_thumbnails['2_5']['icon'] = 'thzadmin thzadmin-shortcode_columns_2_5';
	$column_thumbnails['3_4']['icon'] = 'thzadmin thzadmin-shortcode_columns_3_4';
	$column_thumbnails['3_5']['icon'] = 'thzadmin thzadmin-shortcode_columns_3_5';
	$column_thumbnails['4_5']['icon'] = 'thzadmin thzadmin-shortcode_columns_4_5';
	
	return $column_thumbnails;
	
}

add_filter( 'fw_shortcode_column_thumbnails_data', '_thz_filter_add_column_images' );



/**
 *	Remove title from form shortcode
 *  @internal
 */
add_filter('fw:ext:forms:builder:load-item:form-header-title', '__return_false');


/**
 *	Events options reset
 *  @internal
 */
add_filter("fw_ext_events_post_options",function(){
    return array();
});

/**
 *	Events slug
 *  @internal
 */
function _thz_filter_custom_events_post_slug($slug) {
    return 'event';
}
add_filter('fw_ext_events_post_slug', '_thz_filter_custom_events_post_slug');

/**
 *	Events tax slug
 *  @internal
 */
function _thz_filter_custom_events_taxonomy_slug($slug) {
    return 'events';
}
add_filter('fw_ext_events_taxonomy_slug', '_thz_filter_custom_events_taxonomy_slug');


/**
 *	No login guess
 *  @internal
 */
function _thz_filter_no_login_guess() {
	
	return esc_html__( 'Passowrd or login guess hints are disabled', 'creatus' );
	
}
add_filter( 'login_errors', '_thz_filter_no_login_guess' );




/**
 * Get wp links
 */
function _thz_ajax_action_get_links() {
	
	
	if ( !isset( $_POST['linkSearch'] ) ) {
		return;
	}
	
	$search_term = esc_sql( $_POST['linkSearch'] );
	
	if ( empty( $search_term ) ){
		return;
	}
	
	$all_posts = array();
	
	global $wpdb;
	
	$all_post_types = get_post_types();
	foreach ( array(
		'revision',
		'link_category',
		'attachment',
		'bp-email'
	) as $unset ) {
		unset( $all_post_types[$unset] );
	}
	
	
	
	$posts = $wpdb->get_results( "
	
		SELECT posts.ID, posts.post_title, posts.post_type 
		" . "FROM $wpdb->posts as posts 
		" . "WHERE post_type IN ('" . implode( "', '", $all_post_types ) . "') 
		" . "AND post_status IN ( 'publish', 'private' ) 
		" . "AND post_title LIKE  '%" . $search_term . "%' 
		" . "ORDER BY post_date DESC LIMIT 100" 
	);
	
	unset( $all_post_types );
	
	
	if ( !empty( $posts ) || !is_wp_error( $posts ) ) {
		
		foreach ( $posts as $post ) {
			
			$title = $post->post_title;
			$slug  = 'pt_' . $post->post_type;
			
			if ( !get_permalink( $post->ID ) ) {
				continue;
			}
			$label                              = empty( $title ) ? $post->ID . esc_html__( '-no title', 'creatus' ) : $title;
			$all_posts[$slug . '_' . $post->ID] = array(
				
				'value' => get_permalink( $post->ID ),
				'label' => $label .' ( '.$post->post_type.' )'
				
			);
			
		}
		
		unset( $posts );
	}
	
	
	$taxonimies = get_taxonomies( array(
		 'public' => true 
	) );
	
	
	$items = get_terms( $taxonimies, array(
		'name__like' => $search_term,
		'hide_empty' => false,
		'number' => 100 
	) );
	
	foreach ( $items as $item ) {
		$slug = 'tx_' . $item->taxonomy;
		
		if ( !get_term_link( $item->term_id ) ) {
			continue;
		}
		$all_posts[$slug . '_' . $item->term_id] = array(
			
			'value' => get_term_link( $item->term_id ),
			'label' => $item->name .' ( '.$item->taxonomy.' )'
			
		);
		
	}
	unset( $items );
	
	//return $all_posts;
	wp_send_json_success( $all_posts );
}

add_action( 'wp_ajax_thz_get_links_action', '_thz_ajax_action_get_links' );


/**
 * Get wp post via ajax
 */
function _thz_ajax_action_get_posts() {
	
	
	$nonce = $_POST['nonce'];
	
	if ( !wp_verify_nonce( $nonce, 'thz-masonry' ) ) {
		die( -1 );
	}
	
	if ( !isset( $_POST['category'], $_POST['current'], $_POST['posttype'], $_POST['taxonomy'] ) ) {
		return;
	}
	
	
	$catID     		= (int) $_POST['category'];
	$current   		= $_POST['current'];
	$itemsload 		= (int) $_POST['itemsload'];
	$itemsload 		= $itemsload == -1 ? -1 : $itemsload  + 1; 
	$posttype  		= $_POST['posttype'];
	$taxonomy  		= $_POST['taxonomy'];
	$order     		= $_POST['order'];
	$orderby   		= $_POST['orderby'];
	$layouttype   	= $_POST['layouttype'];
	$postauthor		= isset($_POST['postauthor']) ? $_POST['postauthor'] : false;
	$sqlhook		= isset($_POST['sqlhook']) ? $_POST['sqlhook'] : false;
	$post_status 	= array('publish');
	$tax_query 		= array();
	$author__in 	= array();
	$year 			= '';
	$monthnum 		= '';
	$tag 			='';
	
	if( is_preview() || is_customize_preview() ){
		$post_status 	= array('publish', 'pending', 'draft');
	}	
	
	if ( $catID != '0' ) {
		$tax_query = array(
			 array(
				 'taxonomy' => $taxonomy,
				'field' => 'id',
				'terms' => $catID 
			) 
		);
	}
	
	
	if($postauthor && $postauthor != 0){
		$tax_query = array();
		$author__in = array($postauthor);
	}
	
	if (strpos($sqlhook, 'archive|') !== false) {
		$archive_info 	= explode('|',$sqlhook);
		$year 			= $archive_info[1];
		$monthnum 		= $archive_info[2];
	}

	if (strpos($sqlhook, 'tag|') !== false) {
		$tax_query 		= array();
		$tag_info 		= explode('|',$sqlhook);
		$tag 			= $tag_info[1];
	}	

	$args    = array(
		'post__not_in' => json_decode( stripslashes( $current ) ),
		'posts_per_page' => $itemsload,
		'post_type' => $posttype,
		'author__in'=> $author__in,
		'year' => $year,
		'monthnum' => $monthnum,
		'tag' => $tag,
		'tax_query' => $tax_query,
		'order' => $order,
		'orderby' => $orderby,
		'post_status' => $post_status
	);
	
	$wp_query = new WP_Query( $args );
	$c = json_decode( stripslashes( $current ) );
	
	global $thz_rowstarthook;

	$thz_rowstarthook = count($c);
	if ( $wp_query->have_posts() && $posttype == 'fw-portfolio' ) {
		while ( $wp_query->have_posts() ):
			$wp_query->the_post();
			get_template_part( 'template-parts/portfolio/portfolio','item') ;
			++$thz_rowstarthook;
		endwhile;
	}
	
	if ( $wp_query->have_posts() && $posttype == 'post' ) {
		
		while ( $wp_query->have_posts() ):
			$wp_query->the_post();
			get_template_part( 'template-parts/post/post','item') ;
			++$thz_rowstarthook;
		endwhile;
	}
	
	wp_reset_postdata();
	exit;
}

add_action( 'wp_ajax_thz_get_posts_action', '_thz_ajax_action_get_posts' );
add_action( 'wp_ajax_nopriv_thz_get_posts_action', '_thz_ajax_action_get_posts' );


/**
 * Get posts data for live search
 */
if ( ! function_exists( '_thz_ajax_action_posts_search' ) ){
	
	function _thz_ajax_action_posts_search() {
		
		
		if ( !isset( $_POST['search_term'] ) ) {
			return;
		}
		
		$search_term 	= isset($_POST['search_term']) ? esc_sql( $_POST['search_term'] ) : null;
		$post_types  	= isset($_POST['post_types']) ? esc_sql( $_POST['post_types'] ) : array();
		$search_through = isset($_POST['search_through']) ? esc_sql( $_POST['search_through'] ) : 'post_title';
		$results_limit  = isset($_POST['results_limit'])? (int) $_POST['results_limit'] : 5;
		$intro_limit  	= isset($_POST['intro_limit']) ? (int) $_POST['intro_limit'] : 20;
		$all_posts 		= array();
		
		if ( empty( $search_term ) ){
			return;
		}

		if(!empty($post_types)){
			
			$all_post_types = $post_types;
			
		}else{
		
			$all_post_types = thz_list_post_types(false);
		
		}
		
		if($search_through == 'both'){
	
			$search_sql = "
				AND (post_content LIKE  '%" . $search_term . "%' 
				OR post_excerpt LIKE  '%" . $search_term . "%' 
				OR post_title LIKE  '%" . $search_term . "%')
			";
			
		}else if($search_through == 'post_content'){
			
			$search_sql = "
				AND (post_content LIKE  '%" . $search_term . "%' 
				OR post_excerpt LIKE  '%" . $search_term . "%')
			";
		
		}else{
			
			$search_sql = "AND post_title LIKE  '%" . $search_term . "%'";
		}	
		
	
		global $wpdb;
		$posts = $wpdb->get_results( "
		
			SELECT posts.ID, posts.post_title, posts.post_type, posts.post_excerpt, posts.post_content 
			" . "FROM $wpdb->posts as posts 
			" . "WHERE post_type IN ('" . implode( "', '", $all_post_types ) . "') 
			" . "AND post_status IN ( 'publish', 'private' ) 
			" . "$search_sql
			" . "ORDER BY post_date DESC LIMIT ".$results_limit."" 
		);
		
		unset( $all_post_types );
		
		if ( !empty( $posts ) || !is_wp_error( $posts ) ) {
			
			foreach ( $posts as $post ) {

				if ( !get_permalink( $post->ID ) ) {
					continue;
				}		
						
				$title 		= $post->post_title;
				$slug  		= 'pt_' . $post->post_type;
				$excerpt	= apply_filters('the_excerpt',$post->post_excerpt);
				$intro		= $excerpt !='' ? $excerpt : apply_filters('the_content', $post->post_content);
				$item_intro = wp_strip_all_tags( thz_words_limit( $intro, $intro_limit ), true);
				$item_name  = empty( $title ) ? $post->ID . esc_html__( '-no title', 'creatus' ) : $title;
				
				
				$all_posts[$slug . '_' . $post->ID] = array(
					
					'item_link' => get_permalink( $post->ID ),
					'item_name' => $item_name,
					'item_intro' => $item_intro,
					'item_thumbnail' => get_the_post_thumbnail_url( $post->ID, 'thumbnail' )
					
				);
				
			}
			
			unset( $posts,$post );
		}
	
		wp_send_json_success( $all_posts );
	}
}

add_action( 'wp_ajax_thz_find_posts', '_thz_ajax_action_posts_search' );
add_action( 'wp_ajax_nopriv_thz_find_posts', '_thz_ajax_action_posts_search' );


/**
 * Get posts for post shorcode via ajax
 */
function _thz_ajax_action_shortcode_get_posts() {
	
	$nonce = $_POST['nonce'];
	
	if ( !wp_verify_nonce( $nonce, 'thz-masonry' ) ) {
		die( -1 );
	}
	
	if ( !isset( $_POST['current'], $_POST['shortcodeid'], $_POST['objectid'] , $_POST['itemsload']) ) {
		return;
	}
	
	global $thz_posts_id,$thz_object_id;
	
	// post vars
	$shortcodeid		= $_POST['shortcodeid'];
	$objectid			= $_POST['objectid'];
	$current   			= $_POST['current'];
	$current			= json_decode( stripslashes( $current ) );
	$itemsload   		= $_POST['itemsload'];
	$itemsload 			= $itemsload == -1 ? -1 : $itemsload  + 1; // +1 for next load check
	$preview_atts   	= $_POST['preview_atts'];
	$preview_atts   	= $preview_atts ? json_decode(stripslashes($preview_atts),true) : false;
	
	// shortcode vars
	$find_atts 			= new ThzShortcodeOptions($objectid,$shortcodeid,'posts'); 
	$atts 				= $preview_atts ? $preview_atts : $find_atts->get_result();
	
	// set global vars
	$thz_rowstarthook 	= count($current);
	$thz_posts_id 		= $shortcodeid;
	$thz_object_id 		= $objectid;
		
	// args vars
	$sql_types			= thz_akg('types',$atts,array()); 
	$sql_types			= empty($sql_types) ? array('post') : array_keys($sql_types);
	$sql_specific		= thz_akg('specific',$atts,array()); 
	$sql_categories		= thz_akg('categories',$atts,array()); 
	$sql_tags			= thz_akg('tags',$atts,array()); 
	$sql_author			= thz_akg('author',$atts,array());
	$sql_exclude		= thz_akg('exclude',$atts,array());
	$sql_days			= thz_akg('posts_mx/days',$atts);
	$order				= thz_akg('posts_mx/order',$atts);
	$orderby			= thz_akg('posts_mx/orderby',$atts);
	$formats	 		= thz_akg('pf',$atts,array());
	$exclude_formats	= empty($formats) ? true : false;
	
	$sql_ci				= thz_akg('ci',$atts,array());	
	$sql_ciq			= thz_akg('ciq',$atts,'donotlimit');	

	if( !empty( $sql_ci ) && 'limit' == $sql_ciq){
		
		foreach($sql_ci as $custom_item){
			
			if(!isset($custom_item['p'][0])){
				continue;
			}
			
			$sql_specific[] = $custom_item['p'][0];
			
			unset($custom_item);
		}
		
		unset($sql_ci);
	}
	
	// add post to current
	$current[]			= $objectid;

	// add excluded to current
	if(!empty($sql_exclude)){
		
		$current =  array_merge($current,$sql_exclude);
	}
	
	// remove current from specific and set types to all
	if(!empty($sql_specific)){
		
		$sql_specific 	= array_diff($sql_specific, $current);
		$sql_types 		= thz_list_post_types(false,array('forum','topic','reply' ));
	}
	

	$args = array(
	  'posts_per_page'  => $itemsload,
	  'post__in'		=> $sql_specific,
	  'post__not_in'	=> $current, 
	  'author__in' 		=> $sql_author,
	  'post_type'  		=> $sql_types,
	  'tax_query'  		=> thz_post_tax_query( $sql_categories,$sql_tags,$sql_types, $exclude_formats ),
	  'order'			=> $order,
	  'orderby'			=> $orderby,
	  'ignore_sticky_posts' => true,
	  'date_query'		=> thz_date_query_helper( $sql_days )
	);
	
	$query = new WP_Query( $args );

	if ( $query->have_posts() ) {
		
		while ( $query->have_posts() ):
			$query->the_post();
			thz_render_view(thz_theme_file_path ( '/inc/thzframework/extensions/shortcodes/shortcodes/posts/views/post-item.php' ), array(
				'atts' => $atts,
				'thz_rowstarthook' => $thz_rowstarthook,
			),false);
			++$thz_rowstarthook;
		endwhile;
	}
	
	wp_reset_postdata();
	exit;
}

add_action( 'wp_ajax_thz_shortcode_posts', '_thz_ajax_action_shortcode_get_posts' );
add_action( 'wp_ajax_nopriv_thz_shortcode_posts', '_thz_ajax_action_shortcode_get_posts' );

/**
 * Set portfolio posts per page
*/

function _thz_action_portfolio_posts_per_page( $query ) {
	
	if($query->is_main_query() && is_tax('fw-portfolio-category')){
		
		$posts_per_page =  thz_get_theme_option('pgrid/items',6);
		$query->set( 'posts_per_page', $posts_per_page);
		
	}

}
if( !is_admin() ){
	add_action( 'pre_get_posts', '_thz_action_portfolio_posts_per_page' );
}




/**
 * Fix fw portfolio tag names
 */
if ( ! function_exists( '_thz_filter_portfolio_tag_name' ) ) {
	
	function _thz_filter_portfolio_tag_name($tag_names) {
	 
		$tag_names['singular'] = esc_html('Portfolio tag','creatus');
		$tag_names['plural'] = esc_html('Portfolio tags','creatus');
		
		return $tag_names;
	 
	}
	
}

add_filter( 'fw_ext_portfolio_tag_name', '_thz_filter_portfolio_tag_name' );


/**
 * Redirect filter tags template
 */
function _thz_filter_fw_ext_portfolio_template_include( $template ) {

	if(!thz_fw_loaded() && !thz_fw_active()){
		
		return $template;
		
	}
	
	if ( fw_ext( 'portfolio' ) ) {
		
		$portfolio = fw()->extensions->get( 'portfolio' );
		
		if ( is_tax( 'fw-portfolio-tag' ) && $portfolio->locate_view_path( 'taxonomy-fw-portfolio-tag' ) ) {
		
			if ( preg_match( '/taxonomy-' . '.*\.php/i', basename( $template ) ) === 1 ) {
				return $template;
			}
		
			return $portfolio->locate_view_path( 'taxonomy-fw-portfolio-tag');
			
		}
	}
	
	return $template;
}

add_filter( 'template_include', '_thz_filter_fw_ext_portfolio_template_include' );


/**
 * Load thz pageblock template
 */
function _thz_filter_pageblock_template( $template ) {
 
	if ( is_singular('thz-pageblock') ) {
		
		return get_template_part( 'template-parts/thz-pageblock' );

	}
	
	return $template;

}

add_filter( 'template_include', '_thz_filter_pageblock_template' );



/**
 * Display no sidebar template for specific post types
 */
if ( ! function_exists( '_thz_filter_template_include_no_sidebar_template' ) ) {
	
	function _thz_filter_template_include_no_sidebar_template($template) {
	 
		global $post;
		
		$allowed = array('post','page','fw-portfolio','fw-event','product'); 
		
		if ( is_singular() && in_array($post->post_type,$allowed)) {
		 
			$assigned_template = get_page_template_slug( $post->ID );
			
			if ( strpos($assigned_template, 'no-sidebar') !== false ) {
			 
				$template = thz_theme_file_path ( '/'.$assigned_template );
			}
		}
	 
		return $template;
	 
	}
	
}

add_filter( 'template_include', '_thz_filter_template_include_no_sidebar_template', 99 );



/**
 * Activate portfolio tags
 */
add_filter('fw:ext:portfolio:enable-tags', '__return_true');

/**
 * FW CPT supports
 */
function _thz_action_fw_post_types_supports() {
	add_post_type_support( 'fw-portfolio', array( 'excerpt','comments', 'author', 'revisions') );
	add_post_type_support( 'fw-event', array( 'excerpt','comments', 'author', 'revisions' ) );
	add_post_type_support( 'product',  array('revisions'));
}

add_action( 'init', '_thz_action_fw_post_types_supports' );



/**
 * Override table shortcode defaults
 */
function _thz_filter_table_shortcode_override( $data ) {
	
	$data['content_options']['button-row']['button']['size'] = 'large';
	$data['header_options']['table_purpose']['label']        = esc_html__( 'Table Type', 'creatus' );
	
	return $data;
}
add_filter( 'fw_option_type_table_defaults', '_thz_filter_table_shortcode_override' );

/**
 * Override map shortcode defaults
 */
function _thz_filter_map_shortcode_override( $data ) {
	
	$data['custom']['options']['locations']['size'] = 'large';
	return $data;
}
add_filter( 'fw_shortcode_map_provider', '_thz_filter_map_shortcode_override' );


/**
 * Excerpts length
 */
if ( ! function_exists( '_thz_filter_excerpt_length' ) ){
	
	function _thz_filter_excerpt_length( $length ) {
		return 200;
	}
	
}
add_filter( 'excerpt_length', '_thz_filter_excerpt_length', 999 );



/**
 * Custom read more
 */
if ( ! function_exists( 'thz_read_more_link' ) ){
	
	function thz_read_more_link() {
		
		$html ='';
		
		$html .='<div class="thz-btn-container thz-wp-read-more">';
		$html .='<a class="thz-button thz-btn-theme thz-btn-small thz-radius-4 thz-btn-border-1 thz-align-center"';
		$html .=' href="'.get_permalink().'">';
		$html .='<span class="thz-btn-text thz-fs-12 thz-fw-400">';
		$html .= esc_html__('Read more','creatus');
		$html .='</span>';
		$html .='</a>';
		$html .='</div>';
		
		return $html;
		
	}
}

add_filter( 'the_content_more_link', 'thz_read_more_link' );


/**
 * Remove tag inline style
 */
function _thz_filter_remove_tag_style( $string ) {

	return preg_replace('/(<[^>]+) style=".*?"/i', '$1', $string);
	
}


add_filter( 'wp_generate_tag_cloud', '_thz_filter_remove_tag_style', 10, 3 );


/**
 * Remove "Project Gallery" metabox
 */
function _thz_remove_project_gallery_metabox() {
	if(function_exists('fw')){
    	remove_filter( 'fw_post_options', array( fw()->extensions->get( 'portfolio' ), '_filter_admin_add_post_options' ) );
	}
}
add_action( 'init', '_thz_remove_project_gallery_metabox' );


/**
 * Remove gallery shortcode from content
 */
function _thz_filter_remove_gallery($content){

	if( 'gallery'  == get_post_format() && function_exists('_thz_strip_shortcode') ){
		$content = _thz_strip_shortcode('gallery',$content);
	}
	
	return $content;       

}

add_filter('the_content', '_thz_filter_remove_gallery');


/**
 * Search filter adjustment
 */
function _thz_filter_search($query) {

	if ( $query->is_main_query() && $query->is_search && is_search() ) {
		
		$search_for = thz_get_theme_option('search_grid/for',null);
		$results 	= thz_get_theme_option('search_grid/results',null);
		$filter 	= thz_get_theme_option('search_grid/filter',null);	
		
		$query->set( 'posts_per_page', $results );	
		
		if($search_for == 'custom' && !empty( $filter ) ){
			
			$query->set('post_type', array_keys( $filter ));
			
		}
	}
	
}

if( !is_admin() && !is_preview() ){
	add_filter('pre_get_posts','_thz_filter_search');
}


/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 1200; /* pixels */
}

// LayerSlider
function _thz_action_layerslider_overrides() {
 
    // Disable auto-updates
    $GLOBALS['lsAutoUpdateBox'] = false;
}
add_action('layerslider_ready', '_thz_action_layerslider_overrides');

// no need for custom site stamping
remove_filter('wp_head','ls_meta_generator',9);

// Remove dangling LayerSlider CSS
if(!function_exists( '_thz_action_remove_layerslider_assets' )){
	function _thz_action_remove_layerslider_assets() {
		
		global $post;
		if(function_exists('layerslider') && isset($post->post_content)) {
			
			if (!has_shortcode($post->post_content, 'layerslider')) {
				wp_dequeue_style('layerslider');
				wp_dequeue_style('layerslider-front');
				wp_dequeue_style('ls-google-fonts');
			}
		}
	}
}

add_action('wp_enqueue_scripts', '_thz_action_remove_layerslider_assets');


// Revolution Slider
if(function_exists( 'set_revslider_as_theme' )){
	
	function _thz_action_revolution_slider() {
	 	set_revslider_as_theme();
	}
	add_action( 'init', '_thz_action_revolution_slider' );
}


/**
 * Disable framework sliders
 *
 * @param array $sliders
 */

if ( ! function_exists( '_thz_filter_core_sliders' ) ) {

	function _thz_filter_core_sliders( $sliders ) {
		$sliders = array_diff( $sliders, array( 'bx-slider', 'nivo-slider', 'owl-carousel' ) );

		return $sliders;
	}

	add_filter( 'fw_ext_slider_activated', '_thz_filter_core_sliders' );
}


/**
 *	Disable customizer sections
 *  @internal
 */
global  $wp_customize;

if (isset($wp_customize) && $wp_customize->is_preview() ) {
		
	function _thz_action_customizer_remove_sections( $wp_customize ) {

		$wp_customize->remove_section( 'colors' );
		$wp_customize->remove_section( 'background_image' );
		$wp_customize->remove_section( 'header_image' );

	}
	add_action( 'customize_register' , '_thz_action_customizer_remove_sections' );
}


/**
 *	Disallow builder for certain post types
 *  @internal
 */
function _thz_filter_disallow_builder( $result ) {
	
	unset($result['fw-event'],
		  $result['forum'],
		  $result['topic'],
		  $result['reply']
	);
	
	return  $result;
}
add_filter( 'fw_ext_page_builder_supported_post_types', '_thz_filter_disallow_builder' );


/**
 *	Builder auto activate for certain post types
 *  @internal
 */
function _thz_filter_auto_activate_builder() {
	
	$auto = array(
		'post' => true,
		'page' => true,
		'fw-portfolio' => true,
		'thz-pageblock' => true,
	);
	
	return  $auto;
}
add_filter( 'fw_ext_page_builder_settings_options_post_types_default_value', '_thz_filter_auto_activate_builder' );



/*
 * Wrap centered column in own row
*/
function _thz_filter_fw_ext_page_builder_item_corrector_column_width($width, $column) {
    
	if('center' == $column['atts']['centered']){
		return '1_1';
	}

    return $width;
}

add_filter('fw:ext:page-builder:item-corrector:column-width','_thz_filter_fw_ext_page_builder_item_corrector_column_width',10, 2);


/**
 *	Remove shortcodes from editor wp-shortcodes
 *  @internal
 */
function _thz_filter_remove_wp_editor_shortcodes( $existing ) {
		return array_diff(
			$existing, 
			array(
				'sections_menu',
				'call_to_action',
				'thz_breadcrumbs',
				'thz_post_meta'
			)
		);
}
add_filter( 'fw:ext:wp-shortcodes:default-shortcodes', '_thz_filter_remove_wp_editor_shortcodes' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function _thz_filter_body_classes( $classes ) {
	
	// Remove template parts class names from builder
   if ( is_page_template(  array(
		'template-parts/page-builder.php',
		'template-parts/page-blank.php',
	)) ) {

		$remove = array(
			'page-template-template-parts',
			'page-template-template-partspage-builder-php'
		);
		
		$classes = array_diff($classes, $remove); 

    }

	// Add a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}
	
	// Add first brightness class
	$brightness 		= Thz_Doc::get('brightness') ;
	$header_brightness 	= thz_get_option('header_brightness','none');
	
	if($header_brightness !='none'){
		$brightness = is_array($brightness) ? $brightness : array();
		$brightness = array( $header_brightness => $header_brightness) + $brightness; 
	}
	
    if( $brightness ) {
        $classes[] = 'thz-brightness-'.reset($brightness);
    }
	
	return $classes;
}

add_filter( 'body_class', '_thz_filter_body_classes' );


/**
 * Apply list class
 * @return array mixed 
 */
function _thz_filter_add_widget_list_class($params){

	
	$newclass = apply_filters( 'thz_filter_list_class', 'thz-has-list');
	
	$find = array(
		
		'widget_archive',
		'widget_categories',
		'widget_links',
		'widget_meta',
		'widget_nav_menu',
		'widget_pages',
		'widget_recent_comments',
		'widget_recent_entries',
		'widget_product_categories',
		'widget_layered_nav',
		'widget_display_topics',
		'widget_display_views',
		'widget_display_forums',
		'widget_display_replies'
	
	);

	$replace = array(
		
		'widget_archive '.$newclass,
		'widget_categories '.$newclass.' thz-is-nav',
		'widget_links '.$newclass,
		'widget_meta '.$newclass,
		'widget_nav_menu '.$newclass.' thz-is-nav',
		'widget_pages '.$newclass,
		'widget_recent_comments '.$newclass,
		'widget_recent_entries '.$newclass,
		'widget_product_categories '.$newclass.' thz-is-nav',
		'widget_layered_nav '.$newclass.' thz-is-nav',
		'widget_display_topics '.$newclass,
		'widget_display_views '.$newclass.' thz-is-nav',
		'widget_display_forums '.$newclass.' thz-is-nav',
		'widget_display_replies '.$newclass
	
	);
	
	$params[0]['before_widget'] = str_replace($find,$replace,$params[0]['before_widget']);

	
    return $params;
} 

add_filter('dynamic_sidebar_params', '_thz_filter_add_widget_list_class'); 


/**
 * Wrap widget titles in to a span
 */
function _thz_widget_title_to_span( $title,  $instance = array(),  $id = ''){
	
	$no_split = array(
		'rss',
		'bp_core_friends_widget',
		'bp_core_login_widget'
	);
	
	if( in_array($id,$no_split) ){
		return $title;
	}
	
	$new_title = thz_words_to_tags($title);
  	return $new_title;	
	
}

add_filter('widget_title', '_thz_widget_title_to_span', 10, 3);

// Disable W3TC footer comment for all users
add_filter( 'w3tc_can_print_comment', '__return_false', 10, 1 );

// Disable Gravity forms default css
add_filter( 'pre_option_rg_gforms_disable_css', '__return_true' );






/**
 * Get oembed , use doomdoc for custom size
 * @return html iframe 
 */
function thz_get_oembed($url, $args = array(),$autoplay = true) {
	
	if (strpos($url, 'twitter') !== false && strpos($url, 'status') !== false) {
		
		$status_url = 'https://api.twitter.com/1.1/statuses/oembed.json?id=' . basename($url);
		$transient  = 'thz_twst_'.basename($url);
		
		if(false === ($twitterStatus = get_transient($transient))) {
			
			delete_transient($transient);
			$response	= wp_remote_get( $status_url, array( 'timeout' => 20) );
			$httpCode   = wp_remote_retrieve_response_code( $response ) ;
			
			if ($httpCode >= 200 && $httpCode < 300) {
				
				$twitterStatus = wp_remote_retrieve_body( $response ) ;
				
				if($twitterStatus){
					$twitterStatus = thz_clean_html($twitterStatus);
				}
				
			}else{
				
				$twitterStatus = esc_html__('No response from Twitter','creatus');
				
			}
			
			set_transient($transient, $twitterStatus, 7 * DAY_IN_SECONDS);
		}

		$html = get_transient($transient);
		$json_data = json_decode($html, true);
		$html = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $json_data['html']);
		$html = str_replace('&mdash; ','',$html);		

		
		$dom_element = new domDocument;
		$dom_element->loadHTML($html);
		$dom_element->preserveWhiteSpace = false;
		$blockquotes = $dom_element->getElementsByTagname('blockquote');
		$quote = '';
		$quote_footer = '';
		
		foreach ($blockquotes as $item)	{
			
			$paragraphs = $item->getElementsByTagname('p');
			foreach ($paragraphs as $p_inner) {
				foreach ($p_inner->childNodes as $child) {
					$quote .= $child->ownerDocument->saveXML( $child );
				}
				$p_inner->parentNode->removeChild($p_inner);
			}
			foreach ($item->childNodes as $child) {
				$quote_footer .= $child->ownerDocument->saveXML( $child );
			}
			$item->parentNode->removeChild($item);
		}

							
		$html_print  = '<div class="thz-media-twitter">';					
		$html_print .= '<blockquote class="thz-twitter-quote quoted quote-centered">';
		$html_print .= '<p>' . $quote . '</p>';
		$html_print .= '<p class="thz-twitter-quote-footer">';
		$html_print .= '<i class="fa fa-twitter"></i><small>' . $quote_footer . '</small>';
		$html_print .= '</p>';
		$html_print .= '</blockquote>';
		$html_print .= '</div>';
		
					
		return $html_print;
	}
	
	
	
	$html = wp_oembed_get($url, $args);

	if (!empty($args['width']) and !empty($args['height']) and class_exists('DOMDocument') and !empty($html)) {
		
		$dom_element = new DOMDocument();
		$internalErrors = libxml_use_internal_errors(true);
		$dom_element->loadHTML($html);
		libxml_use_internal_errors($internalErrors);
		
		$obj = $dom_element->getElementsByTagName('iframe')->item(0);
		
		if($obj){
			
			$obj->setAttribute('width', $args['width']);
			$obj->setAttribute('height', $args['height']);
			
			if($autoplay){
				
				$players = array(
					'youtu' =>'&amp;autoplay=1&amp;enablejsapi=1',
					'vimeo' =>'?&amp;autoplay=1',
					'soundcloud' =>'&amp;auto_play=true',
					'dailymotion' =>'?autoPlay=1',
				);
				
				
				foreach ($players as $player => $link){
					
					if (strpos($url, $player) !== false) {
						
						$src = $obj->getAttribute('src'); 
						$obj->setAttribute('src', $src.$link);
						$obj->setAttribute('class', $player.'_iframe');
											
					}
				}
			}
			//saveXml instead of SaveHTML for php version compatibility
			$html = $dom_element->saveXML($obj, LIBXML_NOEMPTYTAG);
		
		}

	}
	return $html;
}

/**
 * Disable defalt shortcodes
 * @return array 
 */
function _thz_filter_disable_shortcodes($to_disable)
{
	$to_disable[] = 'media_video';
	$to_disable[] = 'team_member';
	return $to_disable;
}
add_filter('fw_ext_shortcodes_disable_shortcodes', '_thz_filter_disable_shortcodes');



/**
 * Get oembed via ajax
 * @return array mixed 
 */
function _thz_action_get_oembed_response() {

	if ( wp_verify_nonce( $_POST['_nonce'], '_thz_action_get_oembed_response' ) ) {
		
		$url 		= $_POST['url'];
		$width      = $_POST['width'];
		$height     = $_POST['height'];

		$iframe 	= thz_get_oembed( $url, compact( 'width', 'height' ) );

		wp_send_json_success( $iframe );
	}

	wp_send_json_error( 'Invalid nonce' );
}

add_action( 'wp_ajax_thz_oembed_response', '_thz_action_get_oembed_response' );
add_action( 'wp_ajax_nopriv_thz_oembed_response', '_thz_action_get_oembed_response' );



/*
 * Add spans around category counters 
*/
function _thz_filter_wp_list_categories($output, $args) {
	
	if($args['show_count']){
		$re = '/<\/a>(.*?)<\/li>/s';
		
		preg_match_all($re, $output, $matches);
		
		if(!empty($matches) && isset($matches[1])){
			
			$replaced = false;
			
			foreach($matches[1] as $between){
				
				if(!$replaced){
					$between 	= strip_tags($between);
					$output 	= str_replace($between,'<span class="count">'.$between.'</span>',$output);
				}
				
				$replaced = true;
			}
		}
	}
	
    return $output;
}

add_filter( 'wp_list_categories', '_thz_filter_wp_list_categories',10,2 );

/*
 * Add spans around archive counters 
*/
function _thz_filter_get_archives_link( $output ) { 

	$re = '/<\/a>(.*?)<\/li>/s';
	preg_match_all($re, $output, $matches);
	
	if(!empty($matches) && isset($matches[1])){
		
		$replaced = false;
		
		foreach($matches[1] as $between){
			
			if(!$replaced){
				$between = strip_tags($between);
				$output  = str_replace($between,'<span class="count">'.$between.'</span>',$output);
			}
			$replaced = true;
		}
	}
	
	return $output; 
}; 
         
add_filter( 'get_archives_link', '_thz_filter_get_archives_link', 10, 6 ); 


/*
 * Load fonts import page
*/
function _thz_action_import_fonts_page() {
    if (class_exists('FW_Settings_Form')) {
		
		$import_fonts = thz_theme_file_path('/inc/includes/thz-import-fonts.php');
		
		if( $import_fonts ){
			require_once $import_fonts;
			new FW_Settings_Form_ThzImportFonts('ThzImportFonts');
		}
    }
}


add_action('fw_init', '_thz_action_import_fonts_page');


/*
 * Allow shortcodes in widget text
*/
add_filter( 'widget_text', 'do_shortcode' );


/*
 * Add Formats button to editor
*/
if( !function_exists('_thz_filter_wysiwyg_buttons') ) {
	function _thz_filter_wysiwyg_buttons( $buttons ) {
		
	  array_unshift( $buttons, 'styleselect' );
	  
	  return $buttons;
	}
}
add_filter( 'mce_buttons', '_thz_filter_wysiwyg_buttons' );


/*
 * Add div, span and pre quick tags
*/
function _thz_action_add_editor_quick_tags() {
	
	if (wp_script_is('quicktags')){
		
		$quicktags ='<script type="text/javascript">';
		$quicktags .="QTags.addButton( 'div_code', 'div', '<div class=\"thz-editor-div\">', '</div>', '','Div tag', 1 );";
		$quicktags .="QTags.addButton( 'span_code', 'span', '<span class=\"thz-editor-span\">', '</span>', '','Span tag', 1 );";
		$quicktags .='</script>';
		
		echo $quicktags;
	}
}

add_action( 'admin_print_footer_scripts', '_thz_action_add_editor_quick_tags' );

/*
 * Add custom editor styles
*/
if( !function_exists('_thz_filter_wysiwyg_styles') ) {
	
	function _thz_filter_wysiwyg_styles( $settings ) {
		
		
		$settings['block_formats'] = 'Paragraph=p;Heading1=h1;Heading 2=h2;Heading 3=h3;Heading 4=h4;Heading 5=h5;Heading 6=h6;Div=div;Preformated=pre';

		$theme_styles = array(
			array(
				'title' => esc_html__( 'Dropcaps', 'creatus' ),
				'items' => array(
					array(
						'title' => esc_html__( 'Dropcap', 'creatus' ),
						'selector' => 'p,div,span',
						'classes' => 'thz-dropcap',
					),
					
					array(
						'title' => esc_html__( 'Dropcap box', 'creatus' ),
						'selector' => 'p,div,span',
						'classes' => 'thz-dropcap box',
					),
					
					array(
						'title' => esc_html__( 'Dropcap box outline', 'creatus' ),
						'selector' => 'p,div,span',
						'classes' => 'thz-dropcap box outline',
					),

					array(
						'title' => esc_html__( 'Dropcap rounded', 'creatus' ),
						'selector' => 'p,div,span',
						'classes' => 'thz-dropcap rounded',
					),
					
					array(
						'title' => esc_html__( 'Dropcap rounded outline', 'creatus' ),
						'selector' => 'p,div,span',
						'classes' => 'thz-dropcap rounded outline',
					),
										
					array(
						'title' => esc_html__( 'Dropcap circle', 'creatus' ),
						'selector' => 'p,div,span',
						'classes' => 'thz-dropcap circle',
					),
					
					array(
						'title' => esc_html__( 'Dropcap circle outline', 'creatus' ),
						'selector' => 'p,div,span',
						'classes' => 'thz-dropcap circle outline',
					),

				),
			),
			array(
				'title' => esc_html__( 'Theme Styles', 'creatus' ),
				'items' => array(
					array(
						'title' => esc_html__( 'Highlight', 'creatus' ),
						'inline' => 'span',
						'classes' => 'thz-highlight',
					),
					array(
						'title' => esc_html__( 'Bold primary color', 'creatus' ),
						'inline' => 'strong',
						'classes' => 'thz-bold-primary',
					),
					array(
						'title' => esc_html__( 'Primary color', 'creatus' ),
						'inline' => 'span',
						'classes' => 'thz-primary-color',
					),
					array(
						'title' => esc_html__( 'Muted color', 'creatus' ),
						'inline' => 'span',
						'classes' => 'thz-muted-color',
					),
					array(
						'title' => esc_html__( 'Dark color', 'creatus' ),
						'inline' => 'span',
						'classes' => 'thz-dark-color',
					),
					array(
						'title' => esc_html__( 'Underline', 'creatus' ),
						'inline' => 'span',
						'classes' => 'thz-underline',
					),
					array(
						'title' => esc_html__( 'Underline primary', 'creatus' ),
						'inline' => 'span',
						'classes' => 'thz-underline-primary',
					),
		
				),
			),
			array(
				'title' => esc_html__( 'Font sizes', 'creatus' ),
				'items' => array(
					array(
						'title' => esc_html__( 'Small', 'creatus' ),
						'inline' => 'small',
						'classes' => 'thz-font-small',
					),
					array(
						'title' => esc_html__( 'Font medium', 'creatus' ),
						'selector' => 'p,div,span,h1,h2,h2,h4,h5,h6',
						'classes' => 'thz-font-medium',
					),
					array(
						'title' => esc_html__( 'Font large', 'creatus' ),
						'selector' => 'p,div,span,h1,h2,h2,h4,h5,h6',
						'classes' => 'thz-font-large',
					),
					array(
						'title' => esc_html__( 'Font Xlarge', 'creatus' ),
						'selector' => 'p,div,span,h1,h2,h2,h4,h5,h6',
						'classes' => 'thz-font-xlarge',
					),
					array(
						'title' => esc_html__( 'Font Jumbo', 'creatus' ),
						'selector' => 'p,div,span,h1,h2,h2,h4,h5,h6',
						'classes' => 'thz-font-jumbo',
					),
					array(
						'title' => esc_html__( 'Font Mega', 'creatus' ),
						'selector' => 'p,div,span,h1,h2,h2,h4,h5,h6',
						'classes' => 'thz-font-mega',
					),	
				),
			),
			
			array(
				'title' => esc_html__( 'Content widths', 'creatus' ),
				'items' => array(
					array(
						'title' => esc_html__( '85 percent container', 'creatus' ),

						'block' => 'div', 
						'wrapper' => true, 
						'classes' => 'thz-content-85',
					),
					array(
						'title' => esc_html__( '75 percent container', 'creatus' ),
						'block' => 'div', 
						'wrapper' => true, 
						'classes' => 'thz-content-75',
					),
					array(
						'title' => esc_html__( '50 percent container', 'creatus' ),
						'block' => 'div', 
						'wrapper' => true, 
						'classes' => 'thz-content-50',
					),
					
					array(
						'title' => esc_html__( '40 percent container', 'creatus' ),
						'block' => 'div', 
						'wrapper' => true, 
						'classes' => 'thz-content-40',
					),
					
					array(
						'title' => esc_html__( 'Stretch full width', 'creatus' ),
						'block' => 'div', 
						'wrapper' => true, 
						'classes' => 'thz-stretch-content',
					),
					
					array(
						'title' => esc_html__( 'Stretch site width', 'creatus' ),
						'block' => 'div', 
						'wrapper' => true, 
						'classes' => 'thz-site-width thz-stretch-content',
					),
					
					array(
						'title' => esc_html__( '2 text columns', 'creatus' ),
						'block' => 'div', 
						'wrapper' => true, 
						'classes' => 'thz-text-column-1-2',
					),
					
					array(
						'title' => esc_html__( '3 text columns', 'creatus' ),
						'block' => 'div', 
						'wrapper' => true, 
						'classes' => 'thz-text-column-1-3',
					),
					
					array(
						'title' => esc_html__( '4 text columns', 'creatus' ),
						'block' => 'div', 
						'wrapper' => true, 
						'classes' => 'thz-text-column-1-4',
					),	
		
					array(
						'title' => esc_html__( '5 text columns', 'creatus' ),
						'block' => 'div', 
						'wrapper' => true, 
						'classes' => 'thz-text-column-1-5',
					),
					
					array(
						'title' => esc_html__( '6 text columns', 'creatus' ),
						'block' => 'div', 
						'wrapper' => true, 
						'classes' => 'thz-text-column-1-6',
					),				
				),
			),
			
			array(
				'title' => esc_html__( 'Containers', 'creatus' ),
				'items' => array(
					array(
						'title' => esc_html__( 'Div', 'creatus' ),
						'block' => 'div', 
						'wrapper' => true, 
						'classes' => 'thz-editor-div',
					),
					array(
						'title' => esc_html__( 'Section', 'creatus' ),
						'block' => 'section', 
						'wrapper' => true, 
						'classes' => 'thz-editor-section',
					),
				),
			),
						
			array(
				'title' => esc_html__( 'Blockquotes', 'creatus' ),
				'items' => array(
					array(
						'title' => esc_html__( 'Blockquote', 'creatus' ),
						'block' => 'blockquote', 
						'wrapper' => true, 
					),
					array(
						'title' => esc_html__( 'Pullquote', 'creatus' ),
						'block' => 'blockquote',
						'classes' => 'pullquote', 
						'wrapper' => true, 
					),
					array(
						'title' => esc_html__( 'Blockquote right', 'creatus' ),
						'selector' => 'blockquote',
						'classes' => 'quote-right', 
					),
					array(
						'title' => esc_html__( 'Blockquote centered', 'creatus' ),
						'selector' => 'blockquote',
						'classes' => 'quote-centered', 
					),
					array(
						'title' => esc_html__( 'Blockquote quoted', 'creatus' ),
						'block' => 'blockquote',
						'classes' => 'quoted', 
						'wrapper' => true, 
					),
					array(
						'title' => esc_html__( 'Blockquote brackets', 'creatus' ),
						'block' => 'blockquote',
						'classes' => 'brackets', 
						'wrapper' => true, 
					),
				),
			),
		);

		// Add new styles
		$settings['style_formats'] = json_encode( $theme_styles );
		
		// Add new styles dynamic CSS
		$is_block_editor = isset($settings['classic_block_editor']) && true === $settings['classic_block_editor'] ? true : false;
		$container = $is_block_editor ? '#editor .editor-writing-flow' : 'body.mce-content-body';
		$add_css  = $container. ' .thz-bold-primary,';
		$add_css .= $container. ' .thz-primary-color,';
		$add_css .= $container. ' .thz-bold-primary a,';
		$add_css .= $container. ' .thz-primary-color a{';
		$add_css .='color:color_1!important;';
		$add_css .='}';	
	
		$add_css .= $container. ' .thz-highlight{';
		$add_css .= 'background:color_1!important;';
		$add_css .='color:color_contrast!important;';
		$add_css .='}';	
		
		$add_css .= $container. ' .thz-underline-primary,';
		$add_css .= $container. ' blockquote,';
		$add_css .= $container. ' blockquote.quote-right,';
		$add_css .= $container. ' blockquote.quote-centered  p:first-of-type:after{';
		$add_css .='border-color:color_1!important;';
		$add_css .='}';	
		
		$add_css .= $container. ' .thz-dropcap.box:first-letter,';
		$add_css .= $container. ' .thz-dropcap.rounded:first-letter,';
		$add_css .= $container. ' .thz-dropcap.circle:first-letter{';
		$add_css .='background:color_1!important;';
		$add_css .='color:color_contrast!important;';
		$add_css .='}';	
		
		$add_css .= $container. ' .thz-dropcap.outline:first-letter{';
		$add_css .='border-color:color_1!important;';
		$add_css .='color:color_1!important;';
		$add_css .='background:none!important;';
		$add_css .='}';		
		
		// text columns
		$an_plus_el = thz_get_theme_option('thzbelsp/ae',30);
		$add_css .='[class*=\'thz-text-column-\']{';
		$add_css .='column-gap:'.thz_property_unit($an_plus_el,'px').';';
		$add_css .='}';
			
		$settings['content_style'] = thz_replace_palette_colors( $add_css );	
		
		// Return Settings
		return $settings;
	}
	
	
	
}
add_filter( 'tiny_mce_before_init', '_thz_filter_wysiwyg_styles' );

/*
 * Add custom editor styles CSS
*/
add_theme_support( 'editor-styles' );
add_editor_style(array('assets/css/thz-editor-styles.css'));

/**
 * Track post views
 */
if (!function_exists('_thz_action_track_post_viwes')){

	function _thz_action_track_post_viwes()	{
		
		if (!is_single()) {
			return;
		}
		global $post;
		$views = get_post_meta($post->ID, 'thz_post_views', true);
		$views = intval($views);
		update_post_meta($post->ID, 'thz_post_views', ++$views);
	}
}
add_action('wp_head', '_thz_action_track_post_viwes');



/**
 * Set post likes
 */
function _thz_ajax_action_set_like() {
	
	$nonce = $_POST['nonce'];
	
	if ( !wp_verify_nonce( $nonce, 'thz-likes' ) ) {
		die( -1 );
	}
	
	if ( !isset( $_POST['post_id'] ) ) {
		return;
	}
	
	$post_id = $_POST['post_id'];
	
	$r = array(
		'error' => '',
		'data' => array(
			'total' => false,
			'liked' => false
		),
	);

	do {
		
		$likes 		= get_post_meta($post_id, 'thz_post_likes', true);
		$likes 		= intval($likes);
		$liked 		= isset($_COOKIE['thz_likes_'. $post_id]) ? true : false;
		$total 		= $liked ? $likes : ++ $likes;
		
		if( ! $liked  ){
			update_post_meta($post_id, 'thz_post_likes',$total);
			setcookie('thz_likes_'. $post_id, $post_id, strtotime("+30 days"), '/');
		}
		
		$r['data']['total'] = $total;
		$r['data']['liked'] = $liked;
		
		
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

add_action( 'wp_ajax_thz_like', '_thz_ajax_action_set_like' );
add_action( 'wp_ajax_nopriv_thz_like', '_thz_ajax_action_set_like' );




/**
 * Custom password protected form
 */
function _thz_filter_password_form() {
     global $post;
     $label = 'pwbox-' . ( empty($post->ID) ? rand() : $post->ID );
	 $output ='<form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" class="post-password-form" method="post">';
	 $output .='<p>';
	 $output .= esc_html( 'This content is password protected. To view it please enter your password below:','creatus' );
	 $output .='</p>';
	 $output .='<p class="thz-form-row first">';
	 $output .='<label for="' . $label . '">' . esc_html__( 'Password:','creatus') . ' <input name="post_password" id="' . $label . '"';
	 $output .=' placeholder="' . esc_html__( 'Enter post password', 'creatus' ) . '"';
	 $output .=' type="password" size="20" />';
	 $output .='</label>';
	 $output .='</p>';
	 $output .='<p class="thz-form-row last">';
	 $output .='<input type="submit" name="Submit" value="' . esc_attr_x( 'Enter', 'post password form', 'creatus' ) . '" />';
	 $output .='</p>';
	 $output .='</form>';
	
	return $output;
}

add_filter( 'the_password_form', '_thz_filter_password_form' );


/**
 * Activate offline page
 */
function _thz_filter_offline_page( $request ) {
	
	if( is_admin()){
		return $request;
	}

	$offline 	= thz_get_theme_option('offline','inactive');
	$off_page 	= thz_get_theme_option('off_page',null);

	if('inactive' != $offline && !empty($off_page)){

		$user 			= wp_get_current_user();
		$off_roles		= thz_get_theme_option('off_roles',null);
		$allowed_roles 	= array_keys($off_roles);
		
		if(!in_array('administrator',$allowed_roles)){
			$allowed_roles[] = 'administrator';
		}

		if( !array_intersect($allowed_roles, $user->roles ) && ( get_the_ID() != $off_page[0] ) ){
	
			$dummy_query = new WP_Query();
			$dummy_query->parse_query( $request );
	
			unset( $request['pagename'] );
			$request['page_id'] = $off_page[0];	
				
		}
	}
	
    return $request;
}
add_filter( 'request', '_thz_filter_offline_page' );


/**
 * Set maintenance mode headers
 */
function _thz_action_set_offline_mode_maintenance_headers(){
	
	if( is_admin()){
		return;
	}

	$offline 	= thz_get_theme_option('offline','inactive');
	$off_page 	= thz_get_theme_option('off_page',null);
	
	if('maintenance' == $offline && !empty($off_page)){
		nocache_headers();	
		$protocol = wp_get_server_protocol();
		header( "$protocol 503 Service Unavailable", true, 503 );
		header( 'Content-Type: text/html; charset=utf-8' );
		header( 'Retry-After: 86400' );
	}
	
}
add_action( 'template_redirect', '_thz_action_set_offline_mode_maintenance_headers',1);


/**
 * Get list of user roles
 */
if (!function_exists('_thz_get_user_roles_list')){
	
	function _thz_get_user_roles_list($loggedin = false, $loggedout = false) {
		
		global $wp_roles;
	
		$all_roles = $wp_roles->roles;
		$editable_roles = apply_filters('editable_roles', $all_roles);
		$list = array();
		
		foreach($editable_roles as $key => $role){
			
			$list[$key] = $role['name'];
			unset($role);
		}
		
		unset($editable_roles);
		
		
		if($loggedin){
			$list['loggedin'] = esc_html__('Logged in ( overrides all roles above ) ', 'creatus');
		}
		
		if($loggedout){
			$list['loggedout'] = esc_html__('Logged out ( site visitors only )', 'creatus');
		}
		
		return $list;
	}
}

/**
 * Disable users enumeration
 */
if (!function_exists('_thz_disable_users_enumeration')){
	
	function _thz_disable_users_enumeration($redirect_url, $requested_url) {

		if( thz_contains( $requested_url, '?author=' ) ){
			wp_redirect( home_url(), 301 );
			exit;
	
		}
		
		return $redirect_url;
	}
}

if ( !is_admin() ) {
	add_filter( 'redirect_canonical', '_thz_disable_users_enumeration', 10, 2 );
}


/**
 * Page_options for all post types
 * if no custom options are set
 */
if (!function_exists('_thz_action_fw_options_for_any_post_type')){
	
	function _thz_action_fw_options_for_any_post_type( $options , $post_type ) {
		
		$custom_options =  apply_filters('thz_filter_custom_post_types_options', array( 
			'post', 
			'page', 
			'fw-portfolio', 
			'fw-event', 
			'product',
			'forum',
			'thz-pageblock',
			'attachment'  
		));
		
		if ( in_array( $post_type,$custom_options ) ) {
			return $options;
		}

		$options = array(

			'pagecssbox' => array(
				'type' => 'box',
				'options' => array(
					'pcss' => array(
						'type' => 'addable-popup',
						'value' => array(),
						'label' => false,
						'desc'  => esc_html__('Add CSS for this page', 'creatus'),
						'template' => esc_html__('Page CSS is active','creatus'),
						'popup-title' => esc_html__('Page CSS', 'creatus'),
						'size' => 'large', 
						'limit' => 1,
						'attr' => array(
							'class' => 'custom_options_popup'
						),
						'add-button-text' => esc_html__('Click to add page CSS', 'creatus'),
						'sortable' => false,
						'popup-options' => array(
							'css' => array(
								'type' => 'thz-ace',
								'label' => __('Page CSS', 'creatus'),
								'desc' => esc_html__('Insert your CSS code in the field below. Do not use any HTML tags. This CSS is loaded last after all CSS files and gives you the option to override every theme CSS property. If you need to override certain CSS selector add #thz-wrapper before selector to avoid the use of !important rule.', 'creatus'),
								'value'=>'',
								'mode'=>'css',
								'theme'=>'chrome',
								'height'=>450
							),
						),
					),
				),
				'title' => esc_html__('Page CSS', 'creatus'),
				'context' => 'side',
				'priority' => 'core',
			),
			
			'global_page_options_box' => array(
				'type' => 'box',
				'title'   => __( 'Creatus options', 'creatus' ),
				'options' => array(
					// tab page options
					'page_options_tab' => array(
						'title'   => __( 'Page options', 'creatus' ),
						'type'    => 'tab',
						'attr'	  => array(
							'class' => 'thz-page-options-container'
						),
						'options' => array(
				
							fw()->theme->get_options( 'posts/page_options',array('usefeatured' => true))
				
						),
					),
				)
			),		
		
		
		);
		
		return $options;
		
	}
}
add_action( 'fw_post_options', '_thz_action_fw_options_for_any_post_type', 10, 2 );


/**
 * Page_options for all taxonomies
 * if no custom options are set
 */
if (!function_exists('_thz_action_fw_options_for_any_taxonomy')){
	
	function _thz_action_fw_options_for_any_taxonomy( $options , $taxonomy ) {
		
		$taxonomy_options = apply_filters('thz_filter_custom_taxonomies_options', array( 
			'category',
			'fw-event-taxonomy-name', 
			'fw-portfolio-category'
		));
		
		if ( !in_array( $taxonomy,$taxonomy_options ) ) {
			return $options;
		}
		
		$options = array(
			'category_options_box' => array(
				'type' => 'box',
				'title'   => __( 'Creatus options', 'creatus' ),
				'options' => array(
					fw()->theme->get_options( 'taxonomies/category_options')
				)
			),
		);
		
		
		if ($taxonomy == 'category') {
			
			$cap_options = fw()->theme->get_options( 'blog_posts_settings');
			$cap_collected = array();
			fw_collect_options($cap_collected, $cap_options);
			foreach ($cap_collected as $id => $option) {
				$cap_collected[$id]['value'] = fw_get_db_settings_option($id, isset($option['value']) ? $option['value'] : null);
			}

			$options['category_options_box']['options'][0]['category_options_tab2']['options']['cap'] = array(
				'type' => 'addable-popup',
				'value' => array(),
				'label' => __( 'Custom posts options', 'creatus' ),
				'desc'  => esc_html__('Add custom posts options for this category or leave as is for theme defaults.', 'creatus'),
				'template' => esc_html__('Custom posts options are set','creatus'),
				'popup-title' => esc_html__('Custom posts options', 'creatus'),
				'size' => 'large', 
				'limit' => 1,
				'add-button-text' => esc_html__('Add custom posts options', 'creatus'),
				'sortable' => false,
				'attr' => array(
					'class' => 'custom_options_popup'
				),
				'popup-options' => array(
					$cap_options
				),
			);
			
		}
		
		return $options;
		
	}
	
}

add_action( 'fw_taxonomy_options', '_thz_action_fw_options_for_any_taxonomy', 10, 2 );


/**
 * Exclude specifics on db export
 */
function _thz_filter_db_export_exclude($exclude, $option_name, $is_full_backup) {
    
	if (!$is_full_backup) {
		
		$do_not_backup = array(
			'thz_registration',
			'creatus_pro_activation',
			'odb_rvg_excluded_tabs',
			'odb_rvg_options',
		);
		
		
        if ( in_array($option_name, $do_not_backup) ) {
            return true;
        }
    }

    return $exclude;
}

add_filter( 'fw_ext_backups_db_export_exclude_option','_thz_filter_db_export_exclude',10, 3);


/**
 * Keep specific options on DB restore
 */
function _thz_filter_db_keep_options($keep, $is_full_backup ) {
	
	$keep = $keep + array(
		'thz_registration' => true,
		'creatus_pro_activation' => true,
	);
	
    return $keep;
}

add_filter( 'fw_ext_backups_db_restore_keep_options','_thz_filter_db_keep_options',10, 2);


/**
 * Disable unvanted notices
 */
if (!function_exists('_thz_deactivate_notices')){
	function _thz_deactivate_notices() {
 
		if ( is_admin() &&  false === get_transient( 'fw_brz_admin_notice' ) ){
			set_transient( 'fw_brz_admin_notice', 1, 0 );
		}
	}
}
add_action( 'admin_init', '_thz_deactivate_notices' );


/**
 * Disable unvanted redirects
 */
function _thz_disable_plugins_redirect($instance, $data) {
	
	if ( isset( $data['plugins'] ) && false !== array_search( 'unyson/unyson.php', $data['plugins'] ) ) {
		delete_transient( '_fw_brz_redirect_after_update' );
		set_transient( '_fw_brz_redirect_after_init', 1 );
	}
	
}

add_action('upgrader_process_complete', '_thz_disable_plugins_redirect', 1000,2);


/**
 * Add comments fileds wrappers if side layouts
 */
function thz_action_comment_form_defaults($args) {
	
	$layout = thz_get_option ('comm_mx/lay','stacked');
	if( !is_user_logged_in() && 'stacked' != $layout ){
		
		$html ='<div class="thz-comments-fields-container">';
		$html .='<div class="thz-fields-column comments-textarea">';
		$html .= $args['comment_field'];
		$html .='</div>';
		
		$args['comment_field'] = $html;
	}
	
	return $args;
}

add_action( 'comment_form_defaults', 'thz_action_comment_form_defaults' );

function thz_action_comment_form_before_fields() {
	
	$layout = thz_get_option ('comm_mx/lay','stacked');
	
	if( !is_user_logged_in() &&  'stacked' != $layout ){
    	echo '<div class="thz-fields-column comments-fields">';
	}
}

add_action( 'comment_form_before_fields', 'thz_action_comment_form_before_fields' );

function thz_action_comment_form_after_fields() {
	
	$layout = thz_get_option ('comm_mx/lay','stacked');
	
	if( !is_user_logged_in() && 'stacked' != $layout ){
    	echo '</div></div>';// closing containers
	}
}

add_action( 'comment_form_after_fields', 'thz_action_comment_form_after_fields' );


/**
 * Replace palette colors if used in customizer native custom_css
 */
if (!function_exists('thz_filter_wp_get_custom_css')){
	function thz_filter_wp_get_custom_css( $css ) {
		return thz_replace_palette_colors($css);
	}
}

add_filter('wp_get_custom_css','thz_filter_wp_get_custom_css');

/*
 * Disable block editor
 * in case you need some logic see:
 * https://gist.github.com/danyj/ec00057550fd6f73995ab2f8fc8b729f
 */
if (!function_exists('_thz_filter_disable_block_editor_pt')){
	function _thz_filter_disable_block_editor_pt( $use_block_editor, $post_type ){
	  
	  $use_block_editor = false;
	  return  $use_block_editor;
	  
	}
}

add_filter( 'use_block_editor_for_post_type', '_thz_filter_disable_block_editor_pt', 10, 2 );