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
/**
 * Helper functions used in the theme
 */


/**
 *  Check if Unyson is active
 * @internal
 */
function thz_fw_active() {

	$active = false;

	$active_plugins = get_option( 'active_plugins' );

	if ( in_array( 'unyson/unyson.php', $active_plugins, true ) ) {
		$active = true;
	}

	if ( ! function_exists( 'is_plugin_active_for_network' ) ) {
		require_once( ABSPATH . '/wp-admin/includes/plugin.php' );
	}

	if ( is_plugin_active_for_network( 'unyson/unyson.php' ) ) {
		$active = true;
	}

	return $active;

}


/**
 * Check if Thz Core is active
 * @internal
 */
function thz_core(){
	
	return defined('THZHELPERS');
	
}

/**
 * Check if Creatus Extended is active
 * @internal
 */
function thz_creatus_extended(){
	
	return defined('CREATUSEXTENDED');
	
}

/**
 * Check if page is using page builder
 * @internal
 */

function thz_has_builder( $pageid = false ) {

	if ( $pageid ) {

		return fw_get_db_post_option( $pageid, 'page-builder/builder_active', false );

	} else {

		return thz_get_post_option( 'page-builder/builder_active', false );
	}

}

/**
 * Faster check for options
 * @internal
 */
function thz_fw_loaded() {

	return function_exists( 'fw_get_db_settings_option' );
}

/**
 * Gets post options including posts that are in the loop
 * Post ID is identified by method _thz_get_ID() which determines the
 * ID or any shown item (post, taxonomy, user, etc)
 *
 * @param string $option_id - ID of option
 * @param mixed $default - the default value to be returned if nothing is found
 *
 * @return array - the required post option
 */
function thz_get_post_option( $option_id = null, $default = null ) {
	return thz_item()->get_post_option( $option_id, $default );
}

/**
 * Get option value for the current item (page/post/category etc.) being displayed.
 * This should be used to get main page options, for posts withing a loop
 * use thz_get_post_option()
 *
 * @param string $id - option ID
 * @param mixed $default - default value to be returned if no value is found
 * @param string $theme_option - corresponding theme option ID that should be retrieved before returning $default if the option isn't set on the item
 *
 * @return mixed - option value or $default in case nothing is found
 */
function thz_get_option( $id = false, $default = null, $theme_option = null ) {

	$page_option = !$id ?
		thz_item()->get_main_page_options() :
		thz_item()->get_main_page_option( $id, $default, $theme_option );

	return $page_option;
}

/**
 * Get main theme options early
 *
 * @param string $id - ID of option to be retrieved
 * @param mixed $default - default value to be returned if nothing is found
 *
 * @return mixed|null
 */
function thz_get_theme_option_early( $id, $default = null ) {
	
	$option = thz_item()->get_theme_option( $id, $default, true );
	if( is_wp_error( $option ) ){
		$option = $default;
	}	
	
	return $option;
}

/**
 * Get main theme options
 *
 * @param string $id - ID of option to be retrieved
 * @param mixed $default - default value to be returned if nothing is found
 *
 * @return mixed|null
 */
function thz_get_theme_option( $id, $default = null ) {

	$option = thz_item()->get_theme_option( $id, $default );
	if( is_wp_error( $option ) ){
		$option = $default;
	}

	return $option;
}

/**
 * Return default options
 */
function thz_get_default_theme_options() {

	$options = get_option( 'fw_theme_settings_options:' . THEME_NAME );

	if ( ! empty( $options ) ) {

		return $options;

	} else {

		$wpfs    = thz_wp_file_system();
		$preset	 = get_option('thz_default_preset','starter');
		$options = $wpfs->get_contents( get_template_directory() . '/inc/thzframework/presets/'.$preset.'.json' );
		$options = json_decode( $options, true );

		return $options;

	}

}

/**
 * Get current hero options
 * @return array
 */
function thz_get_hero_options() {

	// page hero
	$hero = thz_get_option( 'hero/0', array() );

	if ( ! empty( $hero ) ) {

		return $hero;
	}

	// theme heros
	$heros = thz_get_theme_option( 'heros', array() );

	if ( empty( $heros ) ) {
		return false;
	}

	$options = false;

	foreach ( $heros as $key => $hero ) {

		$hero_page = thz_akg( 'hero_page', $hero );

		if ( thz_page_info_check( $hero_page ) ) {

			$options = thz_get_theme_option( 'heros/' . $key, array() );

			unset( $heros, $key );

			return $options;
		}
	}
}

/**
 * Check if full page is on
 * @return  bool
 * @data  array
 */
function thz_full_rows( $data = false, $option = false ){
	
	$val = false;
	
	if( !is_page() || !thz_has_builder() || !thz_fw_loaded() ){
		return $val;
	}
	
	$fpr = fw_get_db_post_option( get_the_ID(), 'fpr/0', array() );
	
	if ( ! empty( $fpr ) ) {

		$mob = thz_akg( 'fp/mob', $fpr ,'disable');
		
		if( $mob == 'disable' && wp_is_mobile() ){
			return $val;
		}
					
		if($data){
			
			$val = $option ? thz_akg( $option, $fpr ) : $fpr ;
		
		}else{
			
			$val = true;
		}
	}
	
	return $val;
}


/**
 * Get presets list
 * @return  clean array list
 */
function thz_get_presets_list( $dir ) {

	if ( ! is_dir( $dir ) ) {
		return array();
	}

	$list    = array();
	$presets = scandir( $dir );

	if ( ! empty( $presets ) ) {

		foreach ( $presets as $preset ) {

			if ( strpos( $preset, '.json' ) !== false ) {

				$list[] = $preset;

			} else {
				continue;
			}
		}
		unset( $presets );
	}

	return $list;

}

/**
 * Build select list for theme settings
 */
function thz_presets_select() {


	$dir          = get_template_directory() . '/inc/thzframework/presets';
	$cp_dir		  = defined('CP_PATH') ? CP_PATH.'inc/thzframework/presets' : null;
	$user_dir     = thz_theme_file_path( '/inc/thzframework/presets' );
	$presets      = thz_get_presets_list( $dir );
	$cp_presets   = thz_get_presets_list( $cp_dir );
	$user_presets = thz_get_presets_list( $user_dir );

	$all_presets = array_merge( $presets, $cp_presets, $user_presets );

	$list = array();
	foreach ( $all_presets as $preset ) {

		$name          = str_replace( '.json', '', $preset );
		$list[ $name ] = ucfirst( $name );
	}
	unset( $all_presets );

	return $list;

}


/**
 * Set default preset
 */
function thz_set_preset( $name ) {

	if ( ! is_admin() ) {
		return;
	}

	$options = get_option( 'fw_theme_settings_options:' . THEME_NAME );

	if ( ! empty( $options ) ) {
		return;
	}

	$name = apply_filters( 'thz_filter_set_preset', $name );

	if ( 'starter' == $name ) {
		return;
	}

	$preset = thz_theme_file_path( '/inc/thzframework/presets/' . $name . '.json' );

	if ( $preset ) {
		$wpfs    = thz_wp_file_system();
		$name_c  = ucfirst( THEME_NAME ) . '-' . $name;
		$options = $wpfs->get_contents( $preset );

		try {

			$options = json_decode( $options, true );

			if ( ! empty ( $options ) && json_last_error() == JSON_ERROR_NONE ) {


				fw_set_db_settings_option( null, $options );
				add_action( 'admin_notices', function () use ( $name_c ) {

					$msg = ' <div class="notice notice-success is-dismissible">';
					$msg .= '<p>';
					$msg .= wp_sprintf( esc_html__( '%s has been sucessfuly activated.', 'creatus' ), $name_c );
					$msg .= '</p>';
					$msg .= '</div>';

					echo $msg;
				} );
			}


		} catch ( Exception $e ) {

			// error
			add_action( 'admin_notices', function () {

				$msg = ' <div class="notice notice-error is-dismissible">';
				$msg .= '<p>';
				$msg .= esc_html__( 'Preset file has not been imported.', 'creatus' );
				$msg .= '</p>';
				$msg .= '</div>';

				echo $msg;
			} );
		}

	} else {

		// error
		add_action( 'admin_notices', function () {

			$msg = ' <div class="notice notice-error is-dismissible">';
			$msg .= '<p>';
			$msg .= esc_html__( 'Something went wrong. Not able to load start preset.', 'creatus' );
			$msg .= '</p>';
			$msg .= '</div>';

			echo $msg;
		} );
	}

}

/**
 * Safe load variables from an file
 * Use this function to not include files directly and to not give access to current context variables (like $this)
 *
 * @param string $file_path
 * @param array $_extract_variables Extract these from file array('variable_name' => 'default_value')
 * @param array $_set_variables Set these to be available in file (like variables in view)
 *
 * @return array
 */
function thz_get_variables_from_file( $file_path, array $_extract_variables, array $_set_variables = array() ) {
	extract( $_set_variables, EXTR_REFS );
	unset( $_set_variables );
	require $file_path;
	foreach ( $_extract_variables as $variable_name => $default_value ) {
		if ( isset( $$variable_name ) ) {
			$_extract_variables[ $variable_name ] = $$variable_name;
		}
	}
	return $_extract_variables;
}


/**
 * Recursively get a key's value in array
 *
 * @param string $keys 'a/b/c'
 * @param array|object $array_or_object
 * @param null|mixed $default_value
 * @param string $keys_delimiter
 *
 * @return null|mixed
 */
function thz_akg( $keys, $array_or_object, $default_value = null, $keys_delimiter = '/' ) {
	if ( ! is_array( $keys ) ) {
		$keys = explode( $keys_delimiter, (string) $keys );
	}
	$key_or_property = array_shift( $keys );
	if ( $key_or_property === null ) {
		return $default_value;
	}
	$is_object = is_object( $array_or_object );
	if ( $is_object ) {
		if ( ! property_exists( $array_or_object, $key_or_property ) ) {
			return $default_value;
		}
	} else {
		if ( ! is_array( $array_or_object ) || ! array_key_exists( $key_or_property, $array_or_object ) ) {
			return $default_value;
		}
	}
	if ( isset( $keys[0] ) ) { // not used count() for performance reasons
		if ( $is_object ) {
			return thz_akg( $keys, $array_or_object->{$key_or_property}, $default_value );
		} else {
			return thz_akg( $keys, $array_or_object[ $key_or_property ], $default_value );
		}
	} else {
		if ( $is_object ) {
			return $array_or_object->{$key_or_property};
		} else {
			return $array_or_object[ $key_or_property ];
		}
	}
}


/**
 * Return wp_filesystem, initiate if not there
 */
function thz_wp_file_system() {

	global $wp_filesystem;
	if ( empty( $wp_filesystem ) ) {
		require_once( ABSPATH . '/wp-admin/includes/file.php' );
		WP_Filesystem();
	}

	return $wp_filesystem;
}

/**
 * Return theme or child theme url
 */
function thz_theme_uri() {
	return thz_theme()->get_child_uri() ? thz_theme()->get_child_uri() : thz_theme()->get_parent_uri();
}


/**
 * Return theme or child theme dir
 */
function thz_theme_dir() {

	return thz_theme()->get_child_path() ? thz_theme()->get_child_path() : thz_theme()->get_parent_path();
}

/**
 * Search relative path in child than in parent theme directory and return URI
 *
 * @param  string $rel_path '/some/path_to_dir' or '/some/path_to_file.php'
 *
 * @return string URI
 */
function thz_theme_file_uri( $rel_path ) {
	
	return thz_theme()->child_file_uri( $rel_path );
}

/**
 * Search relative path in child than in parent theme directory and return full path
 *
 * @param  string $rel_path '/some/path_to_dir' or '/some/path_to_file.php'
 *
 * @return string path
 */
function thz_theme_file_path( $rel_path ) {

	return thz_theme()->child_first_file_path( $rel_path );
}

/**
 * Return theme version
 *
 * @return string
 */
function thz_theme_version() {

	$version  = false;
	if ( thz_theme()->get_theme() ) {
		$version = thz_theme()->get_theme()->get( 'Version' );
	}

	/**
	 * Filter the theme version to allow child theme to overwrite this
	 *
	 * @param string
	 */
	return apply_filters( 'thz-theme-version', $version );
}

/**
 * Get cpac
*/
function thz_has_cpac(){
		
	if( class_exists('CreatusPro_Plugin')){
		$cpac = CreatusPro_Plugin::get_instance()->get_cpac();
		if( $cpac ){
			return $cpac;
		}
	}		
}

/**
 * Return or echo video data
 */

function thz_video_bg( $option_name, $echo = true ) {

	if ( is_array( $option_name ) ) {

		$background_type = thz_akg( 'type', $option_name );

		if ( 'video' != $background_type ) {

			return false;
		}

		$video_link      = esc_url( thz_akg( 'video-link', $option_name ) );
		$video_sound     = thz_akg( 'video-sound', $option_name ) == 1 ? false : true;
		$video_loop      = thz_akg( 'video-loop', $option_name ) == 0 ? false : true;
		$video_poster    = esc_url( thz_akg( 'video-poster/url', $option_name ) );
		$poster_position = 'thz-center-top';


	} else {

		$video_link   = $option_name;
		$video_sound  = 0;
		$video_loop   = 1;
		$video_poster = '';
	}

	if ( ! $video_link ) {
		return;
	}

	$filetype       = wp_check_filetype( $video_link );
	$filetypes      = array( 'mp4' => 'mp4', 'ogv' => 'ogg', 'webm' => 'webm', 'jpg' => 'poster' );
	$filetype       = array_key_exists( (string) $filetype['ext'], $filetypes ) ? $filetypes[ $filetype['ext'] ] : 'video';
	$wallpaper_data = ' data-thz-wallpaper data-wallpaper-options="' . thz_htmlspecialchars( json_encode(
			array(
				'loop'   => $video_loop,
				'mute'   => $video_sound,
				'source' => array(
					'poster'          => $video_poster,
					'poster_position' => $poster_position,
					$filetype         => $video_link
				),

			)

		) ) . '"';
	$html           = '<div class="thz-video-bg"><div class="thz-video-container"' . $wallpaper_data . '></div></div>';

	if ( $echo ) {
		echo $html;
	} else {
		return $html;
	}

}

/**
 * Short version of thz_background_video
 * used by theme options only
 */
function thz_video_bg_o( $option_name, $echo = true ) {

	return thz_video_bg( thz_get_option( $option_name ), $echo );
}


/**
 * Check if contained is on if yes add thz-site-width class
 */
function thz_contained( $value, $echo = true, $option = false ) {


	if ( is_page_template( 'template-parts/page-builder.php' ) && $value == 'main_contained/picked' ) {
		return;
	}

	if ( $option ) {

		$option_value = thz_get_option( $value, 'contained' );

		$value = $option_value;
	}


	$contained = '';

	if ( $value == 'contained' ) {

		$contained = ' thz-site-width';
	}

	if ( $echo ) {

		echo $contained;

	} else {

		return $contained;

	}
}

/**
 * Print header toolbar
 */
function thz_toolbar_print( $show ) {
	
	if( 'show' == $show ){
		$toolbar 	= thz_theme_file_path('/template-parts/headers/header-toolbar.php');
		thz_render_view( $toolbar ,array(), false );
	}	
	
}

/**
 * Get logo options
 */
function _thz_logo_options() {

	$logo_options = thz_get_theme_option( 'site_logo', null );
	$custom_logo  = thz_get_post_option( 'custom_logo', null );

	if ( ! empty( $custom_logo ) && isset( $custom_logo[0] ) ) {
		$logo_options = thz_get_post_option( 'custom_logo/0/site_logo', null );
	}
	
	if( !thz_fw_loaded() ){

		$logo_options =  array(
				'type'=>'textual',
				'image' => array(),
				'darksections' => array(),
				'lightsections' => array(),
				'sticky' => array(),
				'mobile' => array(),
				'svgimg' => array(),
				'text'=> get_bloginfo( 'name' ),
				'f'=> array(
					'family'  		=> 'Creatus',
					'weight'     	=> '500',
					'subset'    	=> 'ffk',
					'transform' 	=> 'default',
					'align'     	=> 'default',
					'size' 			=> 20,
					'line-height' 	=> 1,
					'spacing' 		=> '0.3px',
					'color' 		=> 'color_2',
					'text-shadow' 	=> array()					
				),
				'sub-text'=> display_header_text() ? get_bloginfo( 'description' ) : '',
				'sub-f'=> array(
					'family'  		=> 'Creatus',
					'weight'     	=> '400',
					'subset'    	=> 'ffk',
					'transform' 	=> 'uppercase',
					'align'     	=> 'default',
					'size' 			=> 10,
					'line-height' 	=> 1.2,
					'spacing'		=> 0,
					'color' 		=> 'color_3',
					'text-shadow' 	=> array()				
				),
				'sc'=> array(
					't'=> '',
					's'=> '',
				),
				'mc'=> array(
					't'=> '',
					's'=> '',
				),
				'ds'=> array(
					't'=> '',
					's'=> '',
				),
				'ls'=> array(
					't'=> '',
					's'=> '',
				),
				'svg'=> array(
					'd'=> '',
					'ds'=> '',
					'ls'=> '',
					's'=> '',
					'm'=> '',
					'a'=> 'fill',
				),
				'width'=> 300,
				'height'=> 80,
				'mwidth'=> 80,
				'mheight'=> 80,
				'boxstyle'=>array(
					'margin' => array(
						'top' => '0',
						'right' => 'auto',
						'bottom' => '0',
						'left' => 'auto'
					),			
			),
		);

		if ( has_custom_logo() ) {
			$custom_logo_id = get_theme_mod( 'custom_logo' );
			$custom_logo  	= wp_get_attachment_image_src( $custom_logo_id , 'full' );			
			$logo_options['type'] = 'image';
			$logo_options['image']['attachment_id'] = $custom_logo_id ;
			$logo_options['image']['url'] = esc_url( $custom_logo[0] );
			$logo_options['image']['width'] = $custom_logo[1];
			$logo_options['image']['height'] = $custom_logo[2];
				
		}
			
		
	}

	return $logo_options;
}

/**
* Get default logo image
*/
function _thz_logo_image(){
	
	$logo_options		= _thz_logo_options();
	$logo_image			= thz_akg('image/url',$logo_options);

	if( $logo_image	){
		
		$logo_image		= esc_url ( $logo_image	);
		
	}else{
		
		$logo_image		= esc_url( thz_theme_file_uri( '/assets/images/logo.png' ) );
		
	}
	
	return $logo_image;
	
}

/**
 * Print logo HTML
 */
function thz_logo_print( $logoid = 'logo' ) {

	$logo_options  = _thz_logo_options();
	$logo_type     = thz_akg( 'type', $logo_options, 'textual' );
	$logo_text     = thz_akg( 'text', $logo_options );
	$logo_sub_text = thz_akg( 'sub-text', $logo_options, '' );
	$html          = '';
	$logo_image    = _thz_logo_image();
	

	if ( ! $logo_text ) {

		$logo_text = get_bloginfo( 'name' );

	}


	if ( 'textual' == $logo_type ) {

		$t_data = apply_filters( 'thz_filter_textual_logo_data', array(
			'logoid' => $logoid,
			'tag' 	 => 'div'
		));
		$t_tag = thz_akg('tag',$t_data,'div');
		$html .= '<div id="' . $logoid . 'holder" class="thz-logo-holder type-textual">';
		$html .= '<div id="' . $logoid . '" class="thz-logo">';
		$html .= '<div id="' . $logoid . '-in" class="thz-logo-in">';
		$html .= '<'.$t_tag.' class="site-title">';
		$html .= '<a href="' . esc_url( home_url( '/' ) ) . '">';
		$html .= esc_attr( $logo_text );
		$html .= '</a>';
		if ( $logo_sub_text ) {
			$html .= '<span class="site-description">';
			$html .= esc_attr( $logo_sub_text );
			$html .= '</span>';
		}
		$html .= '</'.$t_tag.'>';
		$html .= '</div>';
		$html .= '</div>';
		$html .= '</div>';

	} else if ( 'image' == $logo_type ) {

		if ( 'logomobile' == $logoid ) {

			$mobile_logo = thz_akg( 'mobile/url', $logo_options );
			$logo_image  = $mobile_logo ? $mobile_logo : $logo_image;

		}

		$alt          = apply_filters( 'thz_filter_logo_alt', get_bloginfo( 'name' ) );
		$sdata_active = thz_get_theme_option( 'sdata', 'active' );
		$sticky       = thz_get_option( 'sthe/picked', 'inactive' );
		$sticky_html  = '';

		$sd1 = '';
		$sd2 = '';
		$sd3 = '';

		if ( $sdata_active == 'active' && 'logo' == $logoid ) {
			$sd1 = ' itemscope itemtype="https://schema.org/Organization"';
			$sd2 = 'itemprop="url" ';
			$sd3 = 'itemprop="logo" ';
		}

		if ( $sticky == 'active' ) {

			$sticky_image = thz_akg( 'sticky/url', $logo_options );
			$sticky_image = $sticky_image ? $sticky_image : $logo_image;
			$sticky_html  = '<img class="sticky-logo" src="' . esc_url( $sticky_image ) . '" alt="' . esc_attr( $alt ) . '" />';

		}

		if('logo' == $logoid ){
			//dark body class
			$dark_section_image   = thz_akg( 'darksections/url', $logo_options );
			$dark_section_html	  = '';
			
			if ( $dark_section_image ) {
				$dark_section_html  = '<img class="dark-section-logo" src="' . esc_url( $dark_section_image ) . '" alt="' . esc_attr( $alt ) . '" />';
			}
					
			//light body class
			$light_section_image   = thz_akg( 'lightsections/url', $logo_options );
			$light_section_html	   = '';
			
			if ( $light_section_image ) {
				$light_section_html  = '<img class="light-section-logo" src="' . esc_url( $light_section_image ) . '" alt="' . esc_attr( $alt ) . '" />';
			}
		}
		

		$html .= '<div id="' . $logoid . 'holder" class="thz-logo-holder type-image">';
		$html .= '<div id="' . $logoid . '" class="thz-logo">';
		$html .= '<div id="' . $logoid . '-in" class="thz-logo-in"' . $sd1 . '>';
		$html .= '<a ' . $sd2 . 'href="' . esc_url( home_url( '/' ) ) . '">';
		$html .= '<img ' . $sd3 . 'class="site-logo" src="' . esc_url( $logo_image ) . '" alt="' . esc_attr( $alt ) . '" />';
		if('logo' == $logoid){
			$html .= $dark_section_html;
			$html .= $light_section_html;
		}
		$html .= $sticky_html;
		$html .= '</a>';
		$html .= '</div>';
		$html .= '</div>';
		$html .= '</div>';

		// svg
	} else {

		$sd1          = '';
		$sd2          = '';
		$sd3          = '';
		$sdata_active = thz_get_theme_option( 'sdata', 'active' );
		$svgimg       = thz_akg( 'svgimg', $logo_options );

		if ( $sdata_active == 'active' && 'logo' == $logoid ) {
			$sd1 = ' itemscope itemtype="https://schema.org/Organization"';
			$sd2 = 'itemprop="url" ';
			$sd3 = 'itemprop="logo"';
		}

		$default_svg = '<svg xmlns="http://www.w3.org/2000/svg" id="default-site-' . $logoid . '" class="thz-svg-logo" width="80" height="14" viewBox="0 0 80 14"><path d="M5.54 5.04c-.867 0-1.57.293-2.11.88-.54.587-.81 1.347-.81 2.28 0 .96.27 1.733.81 2.319.54.588 1.243.881 2.11.881 1.28 0 2.24-.42 2.88-1.26l1.62 1.34c-.48.693-1.114 1.227-1.9 1.6s-1.7.561-2.74.561c-1.054 0-1.99-.227-2.81-.681a4.783 4.783 0 0 1-1.91-1.91C.227 10.23 0 9.287 0 8.221 0 7.14.23 6.187.69 5.36a4.845 4.845 0 0 1 1.92-1.92c.82-.453 1.763-.68 2.83-.68.973 0 1.843.17 2.61.51s1.39.823 1.87 1.45l-1.58 1.5c-.72-.786-1.653-1.18-2.8-1.18zm11.55-1.73c.62-.367 1.343-.557 2.17-.57v2.52c-1.107-.067-1.99.19-2.65.77-.66.58-.99 1.363-.99 2.35v5.16h-2.6V2.84h2.6V4.9c.36-.693.85-1.223 1.47-1.59zm13.06.91c.859.973 1.289 2.34 1.289 4.1 0 .347-.007.606-.02.779h-7.9c.173.76.53 1.357 1.07 1.791.54.433 1.203.649 1.99.649.547 0 1.07-.103 1.57-.31s.937-.504 1.31-.891l1.399 1.46c-.533.587-1.183 1.04-1.95 1.36s-1.617.48-2.55.48c-1.094 0-2.057-.227-2.89-.681a4.752 4.752 0 0 1-1.93-1.91c-.453-.819-.68-1.763-.68-2.829 0-1.067.23-2.014.69-2.841.46-.826 1.103-1.47 1.93-1.93s1.767-.69 2.82-.69c1.708.003 2.992.49 3.852 1.463zm-1.09 3.14c-.027-.787-.287-1.413-.78-1.88-.494-.466-1.147-.7-1.96-.7-.76 0-1.397.23-1.91.69s-.83 1.09-.95 1.89h5.6zm11.7 6.18v-1.3c-.375.467-.854.82-1.441 1.06-.587.24-1.26.36-2.02.36-.747 0-1.404-.143-1.971-.43s-1.003-.684-1.31-1.19-.46-1.073-.46-1.7c0-1 .353-1.783 1.06-2.35.707-.567 1.707-.857 3-.87h3.12v-.28c0-.626-.207-1.113-.62-1.46-.413-.346-1.014-.52-1.8-.52-1.014 0-2.073.333-3.18 1l-.94-1.8c.84-.467 1.604-.803 2.29-1.01.687-.207 1.49-.31 2.41-.31 1.387 0 2.462.333 3.229 1 .766.667 1.156 1.6 1.17 2.8l.02 7H40.76zm-.921-2.41c.533-.353.833-.79.9-1.31v-.961h-2.7c-.693 0-1.203.104-1.529.311-.327.207-.49.543-.49 1.01 0 .453.17.814.51 1.08.34.268.803.4 1.39.4.746 0 1.386-.177 1.919-.53zm13.421 1.75c-.854.521-1.748.78-2.68.78-.92 0-1.674-.27-2.26-.811-.588-.539-.881-1.336-.881-2.39V5.18h-1.5l-.02-1.9h1.52V.34h2.58v2.94h3.061v1.9h-3.06V10c0 .494.094.844.279 1.05.188.207.467.31.84.31.4 0 .908-.146 1.521-.439l.6 1.959zM65.939 2.84v10.7h-2.621v-1.979c-.719 1.387-1.959 2.08-3.719 2.08-1.201 0-2.148-.367-2.84-1.101-.693-.733-1.041-1.733-1.041-3v-6.7h2.621v5.94c0 .747.203 1.333.609 1.76s.971.64 1.689.64c.826-.013 1.48-.307 1.961-.88.479-.573.719-1.3.719-2.18V2.84h2.622zm8.729 2.18c-.553-.173-1.063-.26-1.529-.26-.439 0-.789.077-1.051.23-.26.153-.389.39-.389.71 0 .333.162.59.49.77.326.18.842.37 1.549.57.748.227 1.361.45 1.84.67.48.22.896.547 1.25.979.354.434.531 1.004.531 1.711 0 1.039-.4 1.84-1.201 2.399-.799.56-1.807.841-3.02.841-.826 0-1.633-.131-2.42-.391s-1.453-.63-2-1.109l.9-1.82c.48.413 1.053.736 1.719.97.668.233 1.301.351 1.9.351.48 0 .863-.084 1.15-.25a.814.814 0 0 0 .43-.75c0-.373-.166-.654-.5-.841-.332-.187-.873-.394-1.619-.62a13.63 13.63 0 0 1-1.76-.63 3.17 3.17 0 0 1-1.18-.94c-.334-.42-.5-.97-.5-1.65 0-1.053.383-1.856 1.148-2.41.768-.553 1.73-.83 2.891-.83.707 0 1.402.1 2.09.3s1.297.48 1.83.84l-.939 1.88a7.62 7.62 0 0 0-1.61-.72z"/></svg>';

		$svg_attch = thz_akg( 'attachment_id', $svgimg );
		$svg_url   = thz_akg( 'url', $svgimg );

		// we have an url but it is not svg
		if ( $svg_url && ! thz_contains( $svg_url, '.svg' ) ) {

			$attch_meta = wp_prepare_attachment_for_js( $svg_attch );
			$attch_desc = thz_akg( 'description', $attch_meta );

			// check description, if svg print it
			if ( ! empty( $attch_desc ) && thz_contains( $attch_desc, '</svg>' ) ) {

				$svg_print = $attch_desc;

			} else {

				//no svg code, not an svg, print image instead
				$alt       = apply_filters( 'thz_filter_logo_alt', get_bloginfo( 'name' ) );
				$svg_print = '<img ' . $sd3 . 'class="site-logo" src="' . esc_url( $svg_url ) . '" alt="' . esc_attr( $alt ) . '" />';
			}

		} else {
			//if no image print default logo else send the svg logo array to get the svg print
			$svg_print = empty( $svgimg ) ? $default_svg : thz_svg_icon( $svgimg, 'site-'.$logoid );
		}


		$html .= '<div id="' . $logoid . 'holder" class="thz-logo-holder type-svg">';
		$html .= '<div id="' . $logoid . '" class="thz-logo">';
		$html .= '<div id="' . $logoid . '-in" class="thz-logo-in"' . $sd1 . '>';
		$html .= '<a ' . $sd2 . 'href="' . esc_url( home_url( '/' ) ) . '">';
		$html .= $svg_print;
		if ( $sd3 != '' && ! empty( $svgimg ) ) {
			$html .= '<link itemprop="logo" href="' . thz_akg( 'url', $svgimg ) . '" />';
		}
		$html .= '</a>';
		$html .= '</div>';
		$html .= '</div>';
		$html .= '</div>';

	}

	return $html;
}

/**
 * List of revolution slides
 */
function thz_revolution_slides() {


	$rev_slides = array();
	if ( shortcode_exists( "rev_slider" ) ) {

		$slider             = new RevSlider();
		$revolution_sliders = $slider->getArrSliders();

		foreach ( $revolution_sliders as $revolution_slider ) {
			$alias = $revolution_slider->getAlias();
			$title = $revolution_slider->getTitle();

			$rev_slides[ $alias ] = $title;

		}

	}

	if ( empty( $rev_slides ) ) {
		$rev_slides['none'] = esc_html__( 'No slides available. Go to Revolution Slider settings and create slides', 'creatus' );
	}

	return $rev_slides;
}

/**
 * Print revolution slider
 */
function thz_show_revolution_slider( $slide ) {

	if ( function_exists( "putRevSlider" ) ) {

		return putRevSlider( $slide );

	} else {

		echo '<div class="thz-notification thz-notification-red">' . esc_html__( 'Revolution Slider is not installed', 'creatus' ) . '</div>';
	}
}

/**
 * List of layer slider slides
 */
function thz_layer_slider_slides() {

	$layer_slides = array();
	if ( class_exists( "LS_Sliders" ) ) {

		$sliders = LS_Sliders::find();

		foreach ( $sliders as $layer_slider ) {

			$id    = $layer_slider['id'];
			$title = $layer_slider['name'];

			$layer_slides[ $id ] = $title;

		}

	}

	if ( empty( $layer_slides ) ) {

		$layer_slides['none'] = esc_html__( 'No slides available. Go to Layer Slider settings and create slides', 'creatus' );
	}


	return $layer_slides;
}

/**
 * Print layer slider
 */
function thz_show_layer_slider( $slide ) {

	if ( function_exists( "layerslider" ) ) {

		return layerslider( $slide );

	} else {

		echo '<div class="thz-notification thz-notification-red">' . esc_html__( 'Layer Slider is not installed', 'creatus' ) . '</div>';
	}
}



/**
 * Background layers print
 * returns background layers html
 */


function thz_background_layers_print( $array, $in_sticky = false ) {

	if ( empty( $array ) ) {
		return;
	}

	$html = '<div class="thz-bglayer-container">';
	foreach ( $array as $layer ) {

		$id              = thz_akg( 'id', $layer );
		$css_id 		 = thz_akg('lre/i',$layer);
		$id_out			 = !empty($css_id) ? str_replace(' ','',$css_id): 'thz-bglayer-'.$id;
		$css_class 		 = thz_akg('lre/c',$layer);
		$css_class		 = $css_class !='' ? $css_class.' ':'';
		$res_class       = _thz_responsive_classes( thz_akg( 'lre', $layer ) );
		$type            = thz_akg( 'layer_type/picked', $layer );
		$bgtype          = thz_akg( 'layer_type/' . $type . '/background/type', $layer );
		$direction       = thz_akg( 'layer_type/' . $type . '/direction', $layer );
		$velocity        = thz_akg( 'layer_type/' . $type . '/speed', $layer );
		$size            = thz_akg( 'dimensions/picked', $layer );
		$scale           = thz_akg( 'layer_type/' . $type . '/scale', $layer );
		$onmobile        = thz_akg( 'layer_type/' . $type . '/onmobile', $layer );
		$animate         = thz_akg( 'layeranimate', $layer );
		$animate_ac      = thz_akg( 'layeranimate/animate', $layer );
		$animation_data  = thz_print_animation( $animate );
		$particles_mode  = thz_akg( 'particles/m', $layer, 'inactive' );
		$print           = '';
		$particles_print = '';
		$is_shape        = 'shape' == $bgtype ? ' is-shape' : '';


		if ( $particles_mode != 'inactive' ) {

			$particles_data = $particles_mode == 'custom' ? thz_akg( 'par_up', $layer ) : thz_akg( 'particles', $layer, 'inactive' );

			$particles_opacity = thz_akg( 'particles/o', $layer, 1 );
			$particles_opacity = $particles_opacity < 1 ? str_replace( '0.', '', $particles_opacity ) : $particles_opacity . '00';
			$particles_print   .= '<div id="'.esc_attr( $id_out ).'-particles" class="'.$css_class.'thz-particles thz-opacity-' . esc_attr( $particles_opacity ) . '" ';
			$particles_print   .= 'data-particles="';
			$particles_print   .= thz_get_layer_particles_data( $particles_data );
			$particles_print   .= '">';
			$particles_print   .= '</div>';


		}


		if ( 'scroll' == $type ) {

			$data = ' data-thzplx-type="' . esc_attr( $type ) . '"';
			$data .= ' data-thzplx-direction="' . esc_attr( $direction ) . '"';
			$data .= ' data-thzplx-velocity="' . esc_attr( $velocity ) . '"';
			$data .= ' data-thzplx-size="' . esc_attr( $size ) . '"';
			$data .= ' data-thzplx-scale="' . esc_attr( $scale ) . '"';
			$data .= ' data-thzplx-onmobile="' . esc_attr( $onmobile ) . '"';

			if ( $in_sticky ) {

				$data .= ' data-thzplx-insticky="yes"';
			}

			if ( 'video' == $bgtype ) {

				$print .= '<div id="'.esc_attr( $id_out ).'" class="'.$css_class.'thz-parallax thz-parallax-' . $type . $res_class . '"' . $data . '>';
				$print .= $particles_print;
				$print .= thz_video_bg( thz_akg( 'layer_type/scroll/background', $layer ), false );
				$print .= '</div>';

			} elseif ( 'shape' == $bgtype ) {

				$shape_atts = thz_akg( 'layer_type/' . $type . '/background/shape', $layer );

				$print .= '<div id="'.esc_attr( $id_out ).'" class="'.$css_class.'thz-parallax thz-parallax-' . $type . $is_shape . $res_class . '"' . $data . '>';
				$print .= $particles_print;
				$print .= _thz_background_shape_print( $shape_atts );
				$print .= '</div>';

			} else {
				$print .= '<div id="'.esc_attr( $id_out ).'" class="'.$css_class.'thz-parallax thz-parallax-' . $type . $res_class . '"' . $data . '>';
				$print .= $particles_print;
				$print .= '</div>';

			}

		}

		if ( 'infinity' == $type ) {

			$data = ' data-thzinf-type="' . esc_attr( $type ) . '"';
			$data .= ' data-thzinf-direction="' . esc_attr( $direction ) . '"';
			$data .= ' data-thzinf-duration="' . esc_attr( $velocity ) . '"';
			$data .= ' data-thzinf-onmobile="' . esc_attr( $onmobile ) . '"';

			$sfx = $direction == 'left' || $direction == 'right' ? 'h' : 'v';


			$print .= '<div id="'.esc_attr( $id_out ).'" class="'.$css_class.'thz-infinity thz-infinity-' . $sfx . $res_class . '">';
			$print .= '<div class="thz-infinity-bg' . $is_shape . '"' . $data . '>';
			$print .= $particles_print;
			if ( 'shape' == $bgtype ) {

				$shape_atts = thz_akg( 'layer_type/' . $type . '/background/shape', $layer );
				$print      .= _thz_background_shape_print( $shape_atts );
				$print      .= _thz_background_shape_print( $shape_atts );

			}
			$print .= '</div>';
			$print .= '</div>';
		}

		if ( 'basic' == $type ) {

			if ( $bgtype == 'video' ) {

				$print .= '<div id="'.esc_attr( $id_out ).'" class="'.$css_class.'thz-basic-bglayer' . $res_class . '">';
				$print .= $particles_print;
				$print .= thz_video_bg( thz_akg( 'layer_type/basic/background', $layer ), false );
				$print .= '</div>';

			} else if ( 'shape' == $bgtype ) {

				$shape_atts = thz_akg( 'layer_type/' . $type . '/background/shape', $layer );

				$print .= '<div id="'.esc_attr( $id_out ).'" class="'.$css_class.'thz-basic-bglayer' . $is_shape . $res_class . '">';
				$print .= $particles_print;
				$print .= _thz_background_shape_print( $shape_atts );
				$print .= '</div>';

			} else {

				$print .= '<div id="'.esc_attr( $id_out ).'" class="'.$css_class.'thz-basic-bglayer' . $res_class . '">';
				$print .= $particles_print;
				$print .= '</div>';
			}

		}

		if ( $animate_ac === 'active' ) {

			$html .= '<div id="'.esc_attr( $id_out ).'-animation" class="thz-bglayer-animation thz-animate' . $res_class . '"' . thz_sanitize_data( $animation_data ) . '>';
			$html .= $print;
			$html .= '</div>';

		} else {

			$html .= $print;
		}

	}
	$html .= '</div>';

	return $html;
}


/**
 * Background shape print
 */
function _thz_background_shape_print( $shape_atts ) {

	$shape          = thz_akg( 's', $shape_atts );
	$shape_position = thz_akg( 'p', $shape_atts );
	$shape_flip     = thz_akg( 'f', $shape_atts );

	$layer_class = 'thz-shape-bglayer thz-shape-bglayer-' . $shape . ' ' . $shape_position;

	if ( $shape_flip == 'yes' ) {

		$layer_class .= ' flip';
	}

	$print = '<div class="' . thz_sanitize_class( $layer_class ) . '">';
	$print .= _thz_output_req_file( thz_theme_file_path( '/assets/images/shapes/' . $shape . '.svg' ) );
	$print .= '</div>';

	return $print;
}

/**
 * Print particles data
 */
function thz_get_layer_particles_data( $particles_data ) {


	if ( ! is_array( $particles_data ) ) {
		return;
	}


	if ( isset( $particles_data['attachment_id'] ) ) {

		$url       = $particles_data['url'];
		$id        = $particles_data['attachment_id'];
		$transient = 'thz_particles' . $id;


		if ( false === ( $customParticles = get_transient( $transient ) ) ) {

			delete_transient( $transient );

			$url = set_url_scheme( $url );

			$response = wp_remote_get( $url, array( 'timeout' => 20 ) );
			$httpCode = wp_remote_retrieve_response_code( $response );

			if ( $httpCode >= 200 && $httpCode < 300 ) {

				$customParticles = wp_remote_retrieve_body( $response );

			} else {

				$customParticles = esc_html__( 'Not able to load particles', 'creatus' );

			}

			set_transient( $transient, $customParticles, 7 * DAY_IN_SECONDS );
		}

		return thz_htmlspecialchars( thz_remove_empty_lines( $customParticles ) );


	} else {


		$mode      = thz_akg( 'm', $particles_data );
		$color     = thz_replace_palette_colors( thz_akg( 'c', $particles_data ) );
		$particles = array(

			'linked' => '{"particles":{"number":{"value":30,"density":{"enable":true,"value_area":1000}},"color":{"value":"' . $color . '"},"shape":{"type":"circle","stroke":{"width":0,"color":"' . $color . '"},"polygon":{"nb_sides":5},"image":{"src":"img/github.svg","width":100,"height":100}},"opacity":{"value":1,"random":false,"anim":{"enable":false,"speed":1,"opacity_min":0.1,"sync":false}},"size":{"value":3,"random":true,"anim":{"enable":false,"speed":40,"size_min":0.1,"sync":false}},"line_linked":{"enable":true,"distance":150,"color":"' . $color . '","opacity":0.4,"width":1},"move":{"enable":true,"speed":6,"direction":"none","random":false,"straight":false,"out_mode":"out","bounce":false,"attract":{"enable":false,"rotateX":600,"rotateY":1200}}},"interactivity":{"detect_on":"canvas","events":{"onhover":{"enable":false,"mode":"repulse"},"onclick":{"enable":false,"mode":"push"},"resize":true},"modes":{"grab":{"distance":400,"line_linked":{"opacity":1}},"bubble":{"distance":400,"size":40,"duration":2,"opacity":8,"speed":3},"repulse":{"distance":200,"duration":0.4},"push":{"particles_nb":4},"remove":{"particles_nb":2}}},"retina_detect":true}',

			'bubbles' => '{"particles":{"number":{"value":10,"density":{"enable":true,"value_area":800}},"color":{"value":"' . $color . '"},"shape":{"type":"circle","stroke":{"width":0,"color":"' . $color . '"},"polygon":{"nb_sides":6},"image":{"src":"img/github.svg","width":100,"height":100}},"opacity":{"value":1,"random":true,"anim":{"enable":false,"speed":0.4795204795204795,"opacity_min":0.1,"sync":false}},"size":{"value":30,"random":true,"anim":{"enable":false,"speed":0,"size_min":5,"sync":false}},"line_linked":{"enable":false,"distance":200,"color":"' . $color . '","opacity":1,"width":2},"move":{"enable":true,"speed":3,"direction":"none","random":false,"straight":false,"out_mode":"out","bounce":false,"attract":{"enable":false,"rotateX":600,"rotateY":1200}}},"interactivity":{"detect_on":"canvas","events":{"onhover":{"enable":false,"mode":"grab"},"onclick":{"enable":false,"mode":"push"},"resize":true},"modes":{"grab":{"distance":400,"line_linked":{"opacity":1}},"bubble":{"distance":400,"size":40,"duration":2,"opacity":8,"speed":3},"repulse":{"distance":200,"duration":0.4},"push":{"particles_nb":4},"remove":{"particles_nb":2}}},"retina_detect":true}',


			'polygon' => '{"particles":{"number":{"value":10,"density":{"enable":true,"value_area":800}},"color":{"value":"' . $color . '"},"shape":{"type":"polygon","stroke":{"width":0,"color":"' . $color . '"},"polygon":{"nb_sides":6},"image":{"src":"img/github.svg","width":100,"height":100}},"opacity":{"value":1,"random":true,"anim":{"enable":false,"speed":0.4795204795204795,"opacity_min":0.1,"sync":false}},"size":{"value":30,"random":true,"anim":{"enable":false,"speed":0,"size_min":5,"sync":false}},"line_linked":{"enable":false,"distance":200,"color":"' . $color . '","opacity":1,"width":2},"move":{"enable":true,"speed":3,"direction":"none","random":false,"straight":false,"out_mode":"out","bounce":false,"attract":{"enable":false,"rotateX":600,"rotateY":1200}}},"interactivity":{"detect_on":"canvas","events":{"onhover":{"enable":false,"mode":"grab"},"onclick":{"enable":false,"mode":"push"},"resize":true},"modes":{"grab":{"distance":400,"line_linked":{"opacity":1}},"bubble":{"distance":400,"size":40,"duration":2,"opacity":8,"speed":3},"repulse":{"distance":200,"duration":0.4},"push":{"particles_nb":4},"remove":{"particles_nb":2}}},"retina_detect":true}',


			'stars' => '{"particles":{"number":{"value":10,"density":{"enable":true,"value_area":800}},"color":{"value":"' . $color . '"},"shape":{"type":"star","stroke":{"width":0,"color":"' . $color . '"},"polygon":{"nb_sides":5},"image":{"src":"img/github.svg","width":100,"height":100}},"opacity":{"value":1,"random":true,"anim":{"enable":false,"speed":1,"opacity_min":0.1,"sync":false}},"size":{"value":15,"random":true,"anim":{"enable":false,"speed":40,"size_min":0.1,"sync":false}},"line_linked":{"enable":false,"distance":150,"color":"' . $color . '","opacity":0.4,"width":1},"move":{"enable":true,"speed":3,"direction":"none","random":false,"straight":false,"out_mode":"out","bounce":false,"attract":{"enable":false,"rotateX":600,"rotateY":1200}}},"interactivity":{"detect_on":"canvas","events":{"onhover":{"enable":false,"mode":"repulse"},"onclick":{"enable":false,"mode":"push"},"resize":true},"modes":{"grab":{"distance":400,"line_linked":{"opacity":1}},"bubble":{"distance":400,"size":40,"duration":2,"opacity":8,"speed":3},"repulse":{"distance":200,"duration":0.4},"push":{"particles_nb":4},"remove":{"particles_nb":2}}},"retina_detect":true}',
			
			'triangles' => '{"particles":{"number":{"value":10,"density":{"enable":true,"value_area":800}},"color":{"value":"' . $color . '"},"shape":{"type":"triangle","stroke":{"width":0,"color":"' . $color .'"},"polygon":{"nb_sides":6},"image":{"src":"img/github.svg","width":100,"height":100}},"opacity":{"value":1,"random":true,"anim":{"enable":false,"speed":1,"opacity_min":0.1,"sync":false}},"size":{"value":18,"random":true,"anim":{"enable":true,"speed":3,"size_min":5,"sync":false}},"line_linked":{"enable":false,"distance":200,"color":"' . $color . '","opacity":1,"width":2},"move":{"enable":true,"speed":3,"direction":"none","random":true,"straight":false,"out_mode":"out","bounce":false,"attract":{"enable":false,"rotateX":600,"rotateY":1200}}},"interactivity":{"detect_on":"canvas","events":{"onhover":{"enable":false,"mode":"grab"},"onclick":{"enable":false,"mode":"push"},"resize":true},"modes":{"grab":{"distance":400,"line_linked":{"opacity":1}},"bubble":{"distance":400,"size":18,"duration":2,"opacity":8,"speed":3},"repulse":{"distance":200,"duration":0.4},"push":{"particles_nb":4},"remove":{"particles_nb":2}}},"retina_detect":true}',
			
			'squares' => '{"particles":{"number":{"value":10,"density":{"enable":true,"value_area":800}},"color":{"value":"' . $color . '"},"shape":{"type":"edge","stroke":{"width":0,"color":"' . $color . '"},"polygon":{"nb_sides":6},"image":{"src":"img/github.svg","width":100,"height":100}},"opacity":{"value":1,"random":true,"anim":{"enable":false,"speed":1,"opacity_min":0.1,"sync":false}},"size":{"value":18,"random":true,"anim":{"enable":true,"speed":3,"size_min":5,"sync":false}},"line_linked":{"enable":false,"distance":200,"color":"' . $color . '","opacity":1,"width":2},"move":{"enable":true,"speed":3,"direction":"none","random":true,"straight":false,"out_mode":"out","bounce":false,"attract":{"enable":false,"rotateX":600,"rotateY":1200}}},"interactivity":{"detect_on":"canvas","events":{"onhover":{"enable":false,"mode":"grab"},"onclick":{"enable":false,"mode":"push"},"resize":true},"modes":{"grab":{"distance":400,"line_linked":{"opacity":1}},"bubble":{"distance":400,"size":40,"duration":2,"opacity":8,"speed":3},"repulse":{"distance":200,"duration":0.4},"push":{"particles_nb":4},"remove":{"particles_nb":2}}},"retina_detect":true}',

			'snow' => '{"particles":{"number":{"value":30,"density":{"enable":true,"value_area":800}},"color":{"value":"' . $color . '"},"shape":{"type":"circle","stroke":{"width":0,"color":"' . $color . '"},"polygon":{"nb_sides":5},"image":{"src":"img/github.svg","width":100,"height":100}},"opacity":{"value":1,"random":true,"anim":{"enable":false,"speed":1,"opacity_min":0.1,"sync":false}},"size":{"value":10,"random":true,"anim":{"enable":false,"speed":40,"size_min":0.1,"sync":false}},"line_linked":{"enable":false,"distance":500,"color":"' . $color . '","opacity":0.4,"width":2},"move":{"enable":true,"speed":6,"direction":"bottom","random":false,"straight":false,"out_mode":"out","bounce":false,"attract":{"enable":false,"rotateX":600,"rotateY":1200}}},"interactivity":{"detect_on":"canvas","events":{"onhover":{"enable":true,"mode":"bubble"},"onclick":{"enable":true,"mode":"repulse"},"resize":true},"modes":{"grab":{"distance":400,"line_linked":{"opacity":0.5}},"bubble":{"distance":400,"size":4,"duration":0.3,"opacity":1,"speed":3},"repulse":{"distance":200,"duration":0.4},"push":{"particles_nb":4},"remove":{"particles_nb":2}}},"retina_detect":true}'

		);


		if ( isset( $particles[ $mode ] ) ) {
			return thz_htmlspecialchars( $particles[ $mode ] );
		}

	}

}

/**
 * Separators html
 */
function thz_separators_print( $option ) {

	if ( empty( $option ) ) {
		return;
	}

	$type       = thz_akg( '0/mx/t', $option );
	$class      = $type == 'triangle' || $type == 'circle' ? 'thz-section-separator-' : 'thz-section-trans-separator-';
	$class      = $class . $type;
	$position   = thz_akg( '0/mx/p', $option );
	$icon       = thz_akg( '0/icon', $option );
	$iconsize   = thz_akg( '0/iconsize', $option );
	$html       = '';
	$separators = $position == 'both' ? array( 'top', 'bottom' ) : array( $position );

	foreach ( $separators as $poz ) {

		if ( 'haflcircle' == $type ) {
			$html .= '<div class="thz-separator-' . $poz . '-out">';
		}
		$html .= '<div class="' . $class . ' thz-ss-' . $poz . '">';
		if ( ! empty( $icon ) ) {
			$html .= '<i class="thz-ss-icon thz-ss-icon-' . $iconsize . ' ' . $icon . '"></i>';
		}
		if ( 'haflcircle' == $type ) {
			$html .= '<div class="thz-haflcircle-holder"><div class="thz-haflcircle"></div></div>';
		}
		$html .= '</div>';
		if ( 'haflcircle' == $type ) {
			$html .= '</div>';
		}

	}

	if ( ! empty( $html ) ) {
		return $html;
	}

}

/**
 * get shortcode options
 * @https://github.com/ThemeFuse/Unyson/issues/3072
 * @returns array
 */
function _thz_shortcode_options( $data, $shortcode ) {

	$atts    = shortcode_parse_atts( $data['atts_string'] );
	$post_id = isset( $data['post'] ) ? $data['post']->ID : 0;
	$atts    = fw_ext_shortcodes_decode_attr( $atts, $shortcode, $post_id );

	return $atts;
}

/**
 * generate linear/radial gradient from 2 colors
 * @returns css string
 */
function thz_bg_gradient( $color1, $color2, $type = 'linear' ) {


	if ( $color1 == '' && $color2 == '' ) {
		return;
	}

	$array = array(
		'background' => array(
			'type'                 => 'gradient', // none,color,image,gradient,video
			'gradient-style'       => $type, // linear, radial
			'gradient-angle'       => '0',
			'gradient-size'        => 'farthest-corner',//closest-corner, closest-side,farthest-corner,farthest-side
			'gradient-shape'       => 'circle',//circle,ellipse
			'gradient-h-poz'       => '50',
			'gradient-v-poz'       => '50',
			'gradient-start'       => '0',
			'gradient-start-color' => $color1,
			'gradient-add-stop'    => array(),
			'gradient-end'         => '100',
			'gradient-end-color'   => $color2,
		),
	);

	$print_css = new Thz_Css_Generator();
	return $print_css->background($array);
}



/**
 * Return margin class from margin sides value array
 * @returns string
 */
function thz_margin_class( $margins ) {

	if ( ! is_array( $margins ) || empty( $margins ) ) {
		return;
	}

	$margin_class = array();
	foreach ( $margins as $side => $imgm ) {

		$sc = $side[0];

		if ( $imgm > 0 ) {
			$class = 'thz-m' . $sc . '-' . $imgm;
		}

		if ( $imgm < 0 ) {
			$class = 'thz-m' . $sc . '-n' . str_replace( '-', '', $imgm );
		}

		if ( $imgm == 0 ) {

			$class = '';
		}
		if ( $class != '' ) {
			$margin_class [] = $class;
		}
	}

	return implode( ' ', $margin_class );
}


/**
 * Get get_the_content() with formating
 * @post_id specific post id
 * @returns content
 * @ref https://github.com/ThemeFuse/Unyson/issues/1337
 */

function thz_get_the_content( $post_id = false ) {

	$post_id 		= $post_id ? $post_id : get_the_ID();
	$status  		= get_post_status( $post_id );
	$post_status 	= array('publish');
	
	if( is_preview() && 'publish' != $status ){
		$post_status 	= array('publish', 'pending', 'draft', 'auto-draft', 'future', 'private');
	}
	
	$get_post = get_posts( array(
		'include'          => $post_id,
		'post_type'        => 'any',
		'numberposts'      => 1,
		'suppress_filters' => false,
		'post_status' => $post_status
	) );
	


	if ( isset( $get_post[0] ) ) {

		$content = apply_filters( 'the_content', $get_post[0]->post_content );
		$content = str_replace( ']]>', ']]&gt;', $content );

		return $content;
	}


}


/**
 * Print loop item intro text
 * @returns excerpt or content
 * thz_intro_text('chars',170);
 */
if ( ! function_exists( 'thz_intro_text' ) ) {

	function thz_intro_text( $by, $length, $echo = false ) {


		if ( $by == 'none' ) {

			if ( $echo ) {

				echo thz_get_the_content();

			} else {

				return thz_get_the_content();

			}
		}

		$introtext = get_the_excerpt( get_the_ID() ) != '' ? get_the_excerpt( get_the_ID() ) : thz_get_the_content();

		if ( $by == 'words' ) {

			$introtext_print = thz_words_limit( $introtext, $length );

		} else if ( $by == 'chars' ) {

			$introtext_print = thz_chars_limit( $introtext, $length );

		}

		if ( strlen( $introtext ) > $length ) {

			$introtext_print .= '...';
		}

		if ( $echo ) {

			echo wp_strip_all_tags( $introtext_print, true );

		} else {

			return wp_strip_all_tags( $introtext_print, true );

		}
	}
}


/**
 * Get current page
 */
function thz_paged() {

	$paged = 1;
	if ( get_query_var( 'paged' ) ) {
		$paged = get_query_var( 'paged' );
	} elseif ( get_query_var( 'page' ) ) {
		$paged = get_query_var( 'page' );
	}

	return $paged;

}

/**
 * Posts pagination
 */
if ( ! function_exists( 'thz_pagination' ) ) {

	function thz_pagination( $numpages = '', $paged = 1, $echo = true, $options = false ) {

		$html 	= '';
		$paged 	= thz_paged();
		
		if ( $numpages == '' ) {
			global $wp_query;
			$numpages = $wp_query->max_num_pages;
			if ( ! $numpages ) {
				$numpages = 1;
			}
		}

		if ( $options ) {
			
			$pagl_bs			 = thz_akg('pagl_bs',$options,null);
			$pagination_limit    = thz_akg( 'pagination_limit', $options, 1 );
			$pagination_text     = thz_akg( 'pagination_text', $options, 0 );
			$pagination_position = thz_akg( 'pagination_position', $options, 'thz-float-none' );
			$space               = thz_akg( 'pagination_metrics/space', $options, 5 );
			$disabled_show       = thz_akg( 'pagination_metrics/dis', $options, 's' );

		} else {
			
			$pagl_bs			 = thz_get_theme_option('pagl_bs',null);
			$pagination_limit    = thz_get_theme_option( 'pagination_limit', 1 );
			$pagination_text     = thz_get_theme_option( 'pagination_text', 0 );
			$pagination_position = thz_get_theme_option( 'pagination_position', 'thz-float-none' );
			$space               = thz_get_theme_option( 'pagination_metrics/space', 5 );
			$disabled_show       = thz_get_theme_option( 'pagination_metrics/dis', 's' );
		}
		
		$p_top			= thz_akg('padding/top', $pagl_bs, 10 );
		$p_bot			= thz_akg('padding/bottom', $pagl_bs, 10 );
		$bradius		= thz_akg('borderradius/top-left',$pagl_bs,4);
		$vpadding   	= (float)$p_top + (float) $p_bot;
		$nospace_class 	= $space == 0 ? ' no-spacing' : '';
		$radius_class  	= $bradius > 1 ? ' has-radius' : '';
		$position      	= ' ' . $pagination_position;
		$ul_pull       	= '';
		
		if ( $pagination_position == 'thz-float-left' ) {
			$ul_pull = ' thz-ml-n' . $space;
		} elseif ( $pagination_position == 'thz-float-right' ) {
			$ul_pull = ' thz-mr-n' . $space;
		}
		$ulclasses   = $nospace_class . $radius_class . $position . $ul_pull;
		$liclasses   = 'thz-ml-' . $space . ' thz-mr-' . $space;

		if ( $pagination_limit == 1 ) {

			if ( $paged == 2 || $paged == $numpages - 1 ) {

				$limit = 2;

			} else if ( $paged >= 3 && $paged != $numpages ) {

				$limit = 1;

			} else {

				$limit = 3;
			}
		}


		if ( $numpages != 1 ) {

			$dotshow = true;
			$has_text = $pagination_text == 1 ? ' has-text' : '';
			$html    .= '<nav class="thz-pagination-nav">';
			$html    .= '<ul class="thz-pagination' . thz_sanitize_class( $ulclasses ) . '">';
			
			if($pagination_text == 1){
				$liclasses .=' has-text';
			}
			
			// previous
			$show_dis_prev =  $disabled_show =='h' ? $paged > 1 :  true;
			if( $show_dis_prev ){
				$html .= '<li class="' . thz_sanitize_class( $liclasses ) . '">';
				if ( $paged > 1 ) {
					$html .= '<a class="thz-pagination-button thz-pagination-link thz-pagination-prev inactive" href="' . get_pagenum_link( ( $paged - 1 ) ) . '">';
				} else {
					$html .= '<span class="thz-pagination-button thz-pagination-prev thz-pagination-disabled inactive">';
				}
				$html .= '<i class="thzicon thzicon-angle-left'.$has_text.'"></i>';
				$html .= $pagination_text == 1 ? ' ' . esc_html__( 'Previous', 'creatus' ) : '';
				$html .= $paged > 1 ? '</a>' : '</span>';
				$html .= '</li>';
			}


			for ( $i = 1; $i <= $numpages; $i ++ ) {


				$output = '<li class="' . thz_sanitize_class( $liclasses ) . '">';
				if ( $i != $paged ) {
					$output .= '<a class="thz-pagination-button thz-pagination-link inactive" href="' . get_pagenum_link( $i ) . '">';
				} else {
					$output .= '<span class="thz-pagination-button thz-pagination-current">';
				}
				$output .= $i;
				$output .= $i != $paged ? '</a>' : '</span>';
				$output .= '</li>';


				if ( $pagination_limit == 1 ) {

					if ( $i == 1 || $i == $numpages || ( $i >= $paged - $limit && $i <= $paged + $limit ) ) {

						$dotshow = true;
						$html    .= $output;

					} else if ( $dotshow ) {

						$dotshow = false;

						$html .= '<li>';
						$html .= '<span class="thz-pagination-button thz-pagination-dots">';
						$html .= '...';
						$html .= '</span>';
						$html .= '</li>';
					}

				} else {

					$html .= $output;

				}

			}

			// next
			$show_dis_next =  $disabled_show =='h' ? $paged < $numpages :  true;
			if( $show_dis_next ){
				$html .= '<li class="' . thz_sanitize_class( $liclasses ) . '">';
				if ( $paged < $numpages ) {
					$html .= '<a class="thz-pagination-button thz-pagination-link thz-pagination-next inactive" href="' . get_pagenum_link( ( $paged + 1 ) ) . '">';
				} else {
					$html .= '<span class="thz-pagination-button thz-pagination-next thz-pagination-disabled inactive">';
				}
				$html .= $pagination_text == 1 ? esc_html__( 'Next', 'creatus' ) . ' ' : '';
				$html .= '<i class="thzicon thzicon-angle-right'.$has_text.'"></i>';
				$html .= $paged < $numpages ? '</a>' : '</span>';
				$html .= '</li>';
			}


			$html .= '</ul>';
			$html .= '</nav>';
		}
		if ( $html != '' ) {

			if ( $echo ) {

				echo $html;

			} else {

				return $html;
			}
		}
	}
}


/**
 * Single post navigation
 * link template
 */

if ( ! function_exists( 'thz_nav_link_tmpl' ) ) {
	
	function thz_nav_link_tmpl($dir,$object,$options){
		
		$mode 			= thz_akg( 'm',$options,'table');
		$show_icon 		= thz_akg( 'ic',$options,'show');
		$icon_size 		= thz_akg( 'ics',$options,'12');
		$show_thumb		= thz_akg( 'th',$options,'hide');
		$show_thumb 	= 'overlay' == $mode ? 'show' : $show_thumb;
		$show_dir 		= thz_akg( 'di',$options,'show');
		$show_title 	= thz_akg( 'ti',$options,'hide');
		$html 			= '';
		$thumb_html 	= false;
		$html_order		= array();
		$has_hovers		= 'hover' == $show_icon || 'hover' == $show_thumb ? ' has-hovers' : '';
		
		// thumb if overlay mode
		if ( $object && 'hide' != $show_thumb) {
			$size		= 'overlay' == $mode ? 'original' : 'thz-img-small';
			$thumb  	= thz_get_img_src( get_post_thumbnail_id( $object->ID),$size);
			$thumb_html .= '<span class="thz-nav-el el-thumb on-'.$show_thumb.'">';
			$thumb_html .= '<span class="thz-nav-thumb" style="background-image:url('.$thumb.');">';
			$thumb_html .= '</span>';
			$thumb_html .= '</span>';
		}
		
		if ( $thumb_html && 'overlay' == $mode) {
			$html .= $thumb_html;
		}
		
		// wrap
		$html .= '<span class="thz-nav-wrap '.$dir.$has_hovers.'">';
		
		// icon
		if ( 'hide' != $show_icon) {
			
			$icn 	= thz_akg( 'icn',$options,'');
			$nudge  = $icn !='' ? ' thz-ngv-'.str_replace('-','n',$icn) :'';
			$icc 	= ' thz-fs-'.$icon_size.$nudge;
			$icon_html = '<span class="thz-nav-el el-icon on-'.$show_icon.'">';
			$icon_html .= '<span class="thzicon thzicon-angle-left'.$icc.'"></span>';
			$icon_html .= '</span>';
			$html_order[] = $icon_html;
		}
		
		// thumb if table mode
		if ( $thumb_html && 'table' == $mode) {
			$html_order[] = $thumb_html;
		}
		
		$title_html = '<span class="thz-nav-el el-title">';
		
		// direction
		if ( 'show' == $show_dir) {
			$title_html .= '<span class="thz-nav-direction">';
			$title_html .= $dir =='previous' ? __( 'Previous', 'creatus' ) : __( 'Next', 'creatus' );
			$title_html .= '</span>';
		}
		
		// title
		if ( $object  && 'show' == $show_title) {
			$title_html .= '<span class="thz-nav-title">';
			$title_html .= '%title';
			$title_html .= '</span>';
		}
		
		$title_html .= '</span>';
		
		if ( 'show' == $show_dir || 'show' == $show_title) {
			$html_order[] = $title_html;
		}
		
		
		$html .= $dir =='previous' ? implode('',$html_order) : implode('',array_reverse($html_order));
		
		unset($html_order);
		
		// end wrap
		$html    .= '</span>';	
		
		
		$link_html = '<div class="thz-nav-link nav-'.$dir.'">';
		$link_html .= '%link';
		$link_html .= '</div>';	
		
		if ( $object ) {
	
			$link = $dir =='previous' ? get_previous_post_link( $link_html, $html ) : get_next_post_link( $link_html, $html );
	
		} else {
			
			if( 'overlay' == $mode ){
				$link = '';
			}else{
				$link_html = '<div class="thz-nav-link nav-'.$dir.'">';
				$link_html .= '<div class="thz-nav-link-empty">';
				$link_html .= $html;
				$link_html .= '</div>';
				$link_html .= '</div>';
				$link   = $link_html;
			}
		}
		
		
		return $link;
		
	}
}

/**
 * Single post navigation
 */

if ( ! function_exists( 'thz_single_post_navigation' ) ) {

	function thz_single_post_navigation( $location, $echo = true ) {

		if ( ! is_single() ) {
			return;
		}
		
		$post_type 	= get_post_type();
		$nav_data 	= 'bnav_mx';
		$custom_nav = 'cup_nav';
		
		if ( $post_type == 'fw-portfolio' ) {
			$nav_data = 'pnav_mx';
			$custom_nav = false;
		}
		
		if ( $post_type == 'product' ) {
			$nav_data = 'woonav_mx';
			$custom_nav = false;
		}

		if ( $post_type == 'fw-event' ) {
			$nav_data = 'enav_mx';
			$custom_nav = false;
		}

		$cup_nav			= $custom_nav ? thz_get_option( $custom_nav, null ) : array();
		$prefix				= !empty($cup_nav) ? $custom_nav.'/0/' : '';
		$show_navigation	= thz_get_option( $nav_data . '/v', 'show' );
		

		if ( $show_navigation == 'hide' ) {
			return;
		}
		
		$pnav_loc 	= thz_get_option( $prefix.'pnav_loc', 'inside' );		
		
		if ( $pnav_loc != $location ){
			return;
		}
		
		$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
		$next     = get_adjacent_post( false, '', false );
		$ispost   = get_post_type() == 'post' ? true : false;

		if ( ! $next && ! $previous ) {
			return;
		}

		if ( $pnav_loc != 'fixed' ) {
			
			if($pnav_loc == 'outside'){
				
				$contained = thz_contained( 'main_contained/notcontained/container_contained', false, true );
				$max  = thz_has_sidebar() ? ' thz-container' . $contained : thz_single_cmx( $nav_data, true, false );
			
			}else{
				
				$max = thz_single_cmx( $nav_data, true, false );
			}
			
			$navopt 		= thz_get_option( $prefix.'btnel_mx', null);
			$navmode 		= thz_get_option( $prefix.'btnel_mx/m', 'table');
			$max			= 'overlay' == $navmode ? '' : $max;
			$single_cmx		= 'overlay' == $navmode ? '' : thz_single_cmx( $nav_data, false, false ); 
			
			$html = '<div class="thz-post-navigation-row thz-'.$post_type.'-nav-row">';
			$html .= '<div class="thz-post-nav-holder' . $single_cmx . '">';
			$html .= '<div class="thz-max-holder' . $max . '">';
			$html .= '<nav class="thz-post-navigation thz-nav-mode-'.$navmode.'">';
			$html .= '<div class="thz-nav-links">';
			$html .= thz_nav_link_tmpl('previous',$previous,$navopt) . thz_nav_link_tmpl('next',$next,$navopt);
			$html .= '</div>';
			$html .= '</nav>';
			$html .= '</div>';
			$html .= '</div>';
			$html .= '</div>';
		}

		if ( $pnav_loc == 'fixed' ) {
			
			$prev_link     = '';
			$next_link     = '';
			$show_thumb    = thz_get_option( $prefix. 'nfthumb/picked', 'show' );
			$hasthumbclass = $show_thumb == 'show' ? ' thz-fixed-has-thumb' : ' thz-fixed-no-thumb';

			if ( $previous ) {

				$p_link_html = '<div class="thz-fixed-nav nav-previous' . $hasthumbclass . '">';
				$p_link_html .= '<span class="thz-fixed-nav-icon fa fa-angle-left"></span>';
				$p_link_html .= '%link';
				$p_link_html .= '</div>';

				$prev_html = '';
				$prev_html .= '<span class="thz-fixed-nav-wrap">';
				$prev_html .= '<span class="thz-fixed-nav-title">';
				$prev_html .= '%title';
				$prev_html .= '</span>';
				if ( $show_thumb == 'show' ) {

					$prevthumb    = get_the_post_thumbnail( $previous->ID, array( 80, 80 ) );
					$missingthumb = $prevthumb == '' ? ' thumb-missing' : '';
					$prev_html    .= '<span class="thz-fixed-nav-thumb' . $missingthumb . '">';
					$prev_html    .= $prevthumb;
					$prev_html    .= '</span>';

				}
				$prev_html .= '</span>';

				$prev_link = get_previous_post_link( $p_link_html, $prev_html, $ispost );
			}

			if ( $next ) {

				$n_link_html = '<div class="thz-fixed-nav nav-next' . $hasthumbclass . '">';
				$n_link_html .= '<span class="thz-fixed-nav-icon fa fa-angle-right"></span>';
				$n_link_html .= '%link';
				$n_link_html .= '</div>';
				$next_html   = '<span class="thz-fixed-nav-wrap">';
				if ( $show_thumb == 'show' ) {

					$nextthumb    = get_the_post_thumbnail( $next->ID, array( 80, 80 ) );
					$missingthumb = $nextthumb == '' ? ' thumb-missing' : '';
					$next_html    .= '<span class="thz-fixed-nav-thumb' . $missingthumb . '">';
					$next_html    .= $nextthumb;
					$next_html    .= '</span>';

				}
				$next_html .= '<span class="thz-fixed-nav-title">';
				$next_html .= '%title';
				$next_html .= '</span>';
				$next_html .= '</span>';

				$next_link = get_next_post_link( $n_link_html, $next_html, $ispost );
			}
			
			$html = $prev_link . $next_link;
		}


		if ( $echo ) {

			echo $html;

		} else {

			return $html;
		}

	}

}


/**
 * Check if any post except supported CPT's
 * used mainly for dynamic CSS
 */
if ( ! function_exists( 'thz_is_post' ) ) {
	function thz_is_post() {

		$builtin_cpt = array(
			'fw-portfolio',
			'fw-event',
			'forum',
			'topic',
			'reply',
			'product',
		);


		if ( ( ! is_archive() && ! is_category() ) && 'page' == get_post_type() ) {
			$builtin_cpt[] = 'page';
		}

		if ( in_array( get_post_type(), apply_filters( 'thz_filter_thz_is_post', $builtin_cpt ) ) ) {
			return;
		}

		return ( is_archive()
		         || is_author()
		         || is_category()
		         || is_home()
		         || is_single()
		         || is_tag() )
		       || is_attachment();
	}
}


/**
 *  Print post title
 */
if ( ! function_exists( 'thz_post_title' ) ) {

	function thz_post_title( $location, $option_location, $classes = '', $tag = 'h2', $default = 'under' ) {

		$title_classes = $classes != '' ? ' ' . thz_sanitize_class( $classes ) : '';

		if ( $location == $option_location ) {
			$html = '<' . $tag . ' class="entry-title' . $title_classes . '">';
			$html .= '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">';
			$html .= get_the_title();
			$html .= '</a>';
			$html .= '</' . $tag . '>';
			echo $html;
		}

	}
}

/**
 * Post meta preferences option array
 * p =  position, meta | footer
 */
if ( ! function_exists( '_thz_metas_preferences' ) ) {

	function _thz_metas_preferences( $p = 'meta', $remove = array() ) {

		$metas_options = array(

			'type'        => 'thz-multi-options',
			'label'       => sprintf( esc_html__( '%1$s preferences', 'creatus' ), ucfirst( $p ) ),
			'desc'        => sprintf( esc_html__( 'Adjust %1$s preferences', 'creatus' ), $p ),
			'value'       => array(
				'dlink'  => 'donotlink',
				'alink'  => 'link',
				'ashow'  => 'hide',
				'asize'  => 20,
				'ashape' => 'circle',
				'aspace' => 5,
			),
			'thz_options' => array(
				'dlink'  => array(
					'type'    => 'short-select',
					'title'   => esc_html__( 'Date link', 'creatus' ),
					'choices' => array(
						'link'      => esc_html__( 'Link to post', 'creatus' ),
						'donotlink' => esc_html__( 'Do not link to post', 'creatus' ),
					)
				),
				'alink'  => array(
					'type'    => 'short-select',
					'title'   => esc_html__( 'Author link', 'creatus' ),
					'choices' => array(
						'link'      => esc_html__( 'Link to author page', 'creatus' ),
						'donotlink' => esc_html__( 'Do not link to author page', 'creatus' ),
					)
				),
				'ashow'  => array(
					'title'   => esc_html__( 'Author avatar', 'creatus' ),
					'type'    => 'short-select',
					'value'   => 'show',
					'attr'    => array(
						'class' => 'thz-select-switch'
					),
					'choices' => array(
						'show' => array(
							'text' => esc_html__( 'Show', 'creatus' ),
							'attr' => array(
								'data-enable' => '.' . $p . 'mea-size-parent,.' . $p . 'mea-shape-parent,.' . $p . 'mea-space-parent',
							)
						),
						'hide' => array(
							'text' => esc_html__( 'Hide', 'creatus' ),
							'attr' => array(
								'data-disable' => '.' . $p . 'mea-size-parent,.' . $p . 'mea-shape-parent,.' . $p . 'mea-space-parent',
							)
						),
					)
				),
				'asize'  => array(
					'type'  => 'spinner',
					'title' => esc_html__( 'Avatar size', 'creatus' ),
					'addon' => 'px',
					'min'   => 0,
					'attr'  => array(
						'class' => $p . 'mea-size'
					),
				),
				'ashape' => array(
					'type'    => 'short-select',
					'title'   => esc_html__( 'Avatar shape', 'creatus' ),
					'choices' => array(
						'square'  => esc_html__( 'Square', 'creatus' ),
						'rounded' => esc_html__( 'Rounded', 'creatus' ),
						'circle'  => esc_html__( 'Circle', 'creatus' ),
					),
					'attr'    => array(
						'class' => $p . 'mea-shape'
					),
				),
				'aspace' => array(
					'type'  => 'spinner',
					'title' => esc_html__( 'Avatar space', 'creatus' ),
					'addon' => 'px',
					'max'   => 100,
					'attr'  => array(
						'class' => $p . 'mea-space'
					),
				),
			)


		);



		if ( ! empty( $remove ) ) {

			foreach ( $remove as $opt ) {

				unset( $metas_options['value'][ $opt ], $metas_options['thz_options'][ $opt ] );

			}
			unset( $remove, $opt );
		}

		return $metas_options;
	}


}


/**
 * Meta choices
 */

if ( ! function_exists( '_thz_meta_choices' ) ) {
	
	function _thz_meta_choices(){
		
		$choices  = array(
			'views' => esc_html__('Views', 'creatus'),
			'date' => esc_html__('Date', 'creatus'),
			'author' => esc_html__('Author', 'creatus'),
			'categories' => esc_html__('Categories', 'creatus'),
			'tags' => esc_html__('Tags', 'creatus'),
			'comments' => esc_html__('Comments count', 'creatus'),
			'likes' => esc_html__('Likes', 'creatus')
		);		
		
		return $choices;
	}
	
	
}

/**
 * Print post meta
 */
if ( ! function_exists( 'thz_theme_post_meta' ) ) {

	function thz_theme_post_meta( $position = 'meta', $location = 'under', $option_location = '', $before = '', $after = '', $elements = array(), $echo = true ) {

		if ( empty( $elements ) ) {
			return;
		}
		global $post;
		$meta_location = $option_location != '' ? $option_location : 'under';
		$elements_out  = array();
		$pref          = isset( $elements['pref'] ) ? $elements['pref'] : array();


		if ( in_array( 'views', $elements ) ) {
			
			$views = get_post_meta($post->ID, 'thz_post_views');
			$views = isset( $views[0] ) ? $views[0] : 0;
			
			$views_out = '<span class="thz-entry-' . $position . '-element thz-entry-views">';
			$views_out .= '<span class="thz-views-count">';
			$views_out .= $views;
			$views_out .= '</span>';
			$views_out .= '<span class="thz-views-text"> ';
			$views_out .= esc_html__('views', 'creatus');
			$views_out .= '</span>';
			$views_out .= '</span>';

			$elements_out['views'] = $views_out;
		}
		
		if ( in_array( 'date', $elements ) ) {

			$date_link = isset( $pref['dlink'] ) ? $pref['dlink'] : 'donotlink';

			$date_out = '<span class="thz-entry-' . $position . '-element thz-entry-date">';

			if ( $date_link == 'link' ) {
				$date_out .= '<a href="' . esc_url( get_permalink( $post->ID ) ) . '">';
			}

			$date_out .= '<time class="entry-date" datetime="' . esc_attr( get_the_date( 'c' ) ) . '">';
			$date_out .= get_the_date();
			$date_out .= '</time>';

			if ( $date_link == 'link' ) {
				$date_out .= '</a>';
			}

			$date_out .= '</span>';

			$elements_out['date'] = $date_out;
		}

		if ( in_array( 'author', $elements ) ) {

			$avatar_show = isset( $pref['ashow'] ) && $pref['ashow'] == 'show' ? true : false;
			$author_link = isset( $pref['alink'] ) ? $pref['alink'] : 'link';

			$author_avatar = '';
			$has_avatar    = ' no-avatar';
			$has_link      = $author_link == 'link' ? ' has-link' : ' no-link';


			if ( function_exists( 'get_avatar' ) && $avatar_show ) {

				$has_avatar = ' has-avatar';

				$author_avatar .= '<span class="thz-author-avatar ' . $pref['ashape'] . ' thz-pr-' . $pref['aspace'] . '">';
				$author_avatar .= get_avatar( $post->post_author, $pref['asize'] );
				$author_avatar .= '</span>';

			}

			$author_out = '<span class="thz-entry-' . $position . '-element thz-entry-author' . $has_avatar . $has_link . '">';
			if ( $author_link == 'link' ) {
				$author_out .= '<a href="' . esc_url( get_author_posts_url( $post->post_author ) ) . '">';
			}

			$author_out .= $author_avatar;
			$author_out .= '<span class="thz-author-name">';
			$author_out .= esc_html__( 'by', 'creatus' ) . ' ' . esc_attr( get_the_author_meta( 'display_name', $post->post_author ) );
			$author_out .= '</span>';

			if ( $author_link == 'link' ) {
				$author_out .= '</a>';
			}

			$author_out .= '</span>';

			$elements_out['author'] = $author_out;

		}

		unset( $elements['pref'] );

		if ( in_array( 'categories', $elements ) && thz_post_tax_links( 'links' ) ) {
			$cats_out = '<span class="thz-entry-' . $position . '-element thz-entry-category">';
			$cats_out .= thz_post_tax_links( 'links' );
			$cats_out .= '</span>';

			$elements_out['categories'] = $cats_out;
		}
		if ( in_array( 'tags', $elements ) && thz_post_tags_links() ) {

			$tags_out = '<span class="thz-entry-' . $position . '-element thz-entry-tags">';
			$tags_out .= thz_post_tags_links( '<span class="thz-tag-separator">, </span>' );
			$tags_out .= '</span>';

			$elements_out['tags'] = $tags_out;
		}

		if ( get_post_type() == 'fw-portfolio' ) {

			$show_comments = thz_get_option( 'pcom_mx/v', 'hide' );

		} else if ( get_post_type() == 'fw-event' ) {

			$show_comments = thz_get_theme_option( 'ecom_mx/v', 'hide' );

		} else {

			$show_comments = thz_get_option( 'bcom_mx/v', 'show' );

		}

		if ( $show_comments == 'show' && in_array( 'comments', $elements ) ) {

			if ( ! post_password_required() && ( comments_open( $post->ID ) || get_comments_number( $post->ID ) ) ) {

				$comments_out = '<span class="thz-entry-' . $position . '-element thz-entry-comments">';
				$comments_out .= thz_comments_link();
				$comments_out .= '</span>';

				$elements_out['comments'] = $comments_out;
			}
		}
		
		
		if ( in_array( 'likes', $elements ) ) {
			
			$likes 		= get_post_meta($post->ID, 'thz_post_likes');
			$likes 		= isset( $likes[0] ) ? $likes[0] : 0;
			$liked 		= isset($_COOKIE['thz_likes_'. $post->ID]) ? true : false;
			$likes_icon = $liked ? 'fa fa-heart' : 'fa fa-heart-o';
			$has_liked	= $liked ? ' has-liked' : ''; 
			$likes_text = $likes == 1 ? esc_html__('Like', 'creatus') : esc_html__('Likes', 'creatus');
			
			$likes_out = '<span class="thz-entry-' . $position . '-element thz-entry-likes">';
			$likes_out .= '<a class="thz-likes'.$has_liked.'" href="#" data-post-id="'.$post->ID.'">';
			$likes_out .= '<span class="thz-likes-icon '.$likes_icon.'"></span>';
			$likes_out .= '<span class="thz-likes-text"> ';
			$likes_out .= $likes_text;
			$likes_out .= ' </span>';
			$likes_out .= '<span class="thz-likes-count">';
			$likes_out .= $likes;
			$likes_out .= '</span>';
			$likes_out .= '</a>';
			$likes_out .= '</span>';

			$elements_out['likes'] = $likes_out;
		}
		

		if ( isset( $elements['separator'] ) ) {

			$separator = $elements['separator'];

			unset( $elements['separator'] );

		} else {

			$separator = '<span class="thz-meta-separator"></span>';
		}


		$elements_print = apply_filters ('thz_filter_meta_elements_print',thz_reorder_array( $elements_out, $elements ) );


		if ( ! empty( $elements_print ) && $location == $meta_location ) {

			if ( $echo ) {

				echo $before . implode( $separator, $elements_print ) . $after;

			} else {

				return $before . implode( $separator, $elements_print ) . $after;
			}

		}

	}

}

/**
 *  Print post footer
 */
if ( ! function_exists( 'thz_theme_post_footer' ) ) {

	function thz_theme_post_footer( $position = 'footer', $location = 'under', $option_id = '', $before = '', $after = '', $elements = array(), $echo = true ) {

		if ( $echo ) {


			thz_theme_post_meta( $position, $location, $option_id, $before, $after, $elements, $echo );

		} else {

			return thz_theme_post_meta( $position, $location, $option_id, $before, $after, $elements, $echo );
		}

	}
}


/**
 *  Get tax links
 */
function thz_post_tax_links( $out = 'links', $delimiter = ', ', $before = '', $after = '' ) {

	$id              = thz_item()->get_id();
	$cats_links      = array();
	$cats_names      = array();
	$cats_data       = array();
	$post_categories = thz_post_tax_objects( $id );

	if ( empty( $post_categories ) ) {
		return;
	}

	foreach ( $post_categories as $cat ) {

		if ( 'data' == $out ) {
			$cats_data[ 'category_' . $cat->term_id ] = esc_attr( $cat->name );
		}
		if ( 'names' == $out ) {
			$cats_names[] = 'category_' . $cat->term_id;
		}

		if ( 'links' == $out ) {

			$category_link = get_term_link( $cat->term_id );

			$link_out = $before;
			$link_out .= '<a href="' . esc_url( $category_link ) . '">';
			$link_out .= esc_attr( $cat->name );
			$link_out .= '</a>';
			$link_out .= $after;

			$cats_links[] = $link_out;

		}

	}
	unset( $post_categories );


	if ( 'data' == $out ) {
		$data_out = thz_htmlspecialchars( json_encode( $cats_data ) );
		$data_out = str_replace( array( '&amp;amp;', '&amp;' ), '&', $data_out );

		return $data_out;
	}

	if ( 'links' == $out ) {

		$item_cats = implode( $delimiter, $cats_links );
	}

	if ( 'names' == $out ) {

		$item_cats = implode( $delimiter, $cats_names );

	}

	return $item_cats;

}

/**
 *  Get tags links
 */
if ( ! function_exists( 'thz_post_tags_links' ) ) {
	function thz_post_tags_links( $delimiter = ', ', $before = '', $after = '' ) {

		$tags_check = false;

		if ( $tags_check ) {
			$tags_check = get_the_tags();
		}

		$id        = get_the_ID();
		$tag_links = array();
		$post_tags = false;
		$posts     = array(
			'post'         => 'post_tag',
			'page'         => 'post_tag',
			'fw-portfolio' => 'fw-portfolio-tag',
			'product'      => 'product_tag',
		);

		foreach ( $posts as $type => $tax ) {

			if ( $type == get_post_type() ) {

				$post_tags = get_the_terms( $id, $tax );

				break;
			}

		}

		if ( $post_tags === false ) {
			return;
		}

		foreach ( $post_tags as $tag ) {

			$tag_link = get_term_link( $tag->term_id );

			$link_out = $before;
			$link_out .= '<a href="' . esc_url( $tag_link ) . '" rel="tag">';
			$link_out .= esc_attr( $tag->name );
			$link_out .= '</a>';
			$link_out .= $after;

			$tag_links[] = $link_out;

		}
		unset( $post_tags );

		return implode( $delimiter, $tag_links );

	}
}

/**
 *  Print comments link with number of comments
 */
if ( ! function_exists( 'thz_comments_link' ) ) {

	function thz_comments_link( $before = '', $after = '' ) {

		$num_comments = get_comments_number();

		if ( $num_comments == 0 ) {
			
			$text 	= esc_html__( 'comments', 'creatus' );
			$count 	= 0;

		} elseif ( $num_comments > 1 ) {
			
			$text 	= esc_html__( 'comments', 'creatus' );
			$count 	= $num_comments;
			
		} else {
			
			$text 	= esc_html__( 'comment', 'creatus' );
			$count 	= 1;
		}

		$comments_out = '<span class="thz-comments-count">';
		$comments_out .= $count;
		$comments_out .= '</span>';		
		$comments_out .= ' <span class="thz-comments-text">';
		$comments_out .= $text;
		$comments_out .= '</span>';

		$write_comments = '<a href="' . get_comments_link() . '">' . $before . $comments_out . $after . '</a>';

		return $write_comments;

	}


}


/**
 * Project meta
 */
function thz_project_meta( $project_meta ) {

	if ( ! is_array( $project_meta ) || empty( $project_meta ) ) {
		return;
	}

	$html = '';
	$out  = '';

	foreach ( $project_meta as $key => $detail ) {

		$type = thz_akg( 'type/picked', $detail );
		$name = thz_akg( 'type/' . $type . '/name', $detail );

		if ( $type == 'link' ) {

			$url = thz_akg( 'type/' . $type . '/url', $detail );
			$txt = thz_akg( 'type/' . $type . '/text', $detail );
			$out = '<a href="' . esc_url( $url ) . '" target="_blank">' . esc_attr( $txt ) . '</a>';
		}

		if ( $type == 'text' ) {
			$txt = thz_akg( 'type/' . $type . '/text', $detail );
			$out = thz_html_trans( esc_textarea( do_shortcode( $txt ) ) );
		}

		if ( $type == 'category' ) {

			$categories = get_the_terms( get_the_ID(), 'fw-portfolio-category' );

			if ( ! empty( $categories ) ) {
				foreach ( $categories as $cat ) {

					$category_link = get_category_link( $cat->term_id );
					$cats_names[]  = '<a href="' . esc_url( $category_link ) . '" title="' . esc_attr( $cat->name ) . '">' . esc_attr( $cat->name ) . '</a>';

				}
				unset( $categories );
				$out = implode( ', ', $cats_names );

			} else {
				continue;
			}
		}

		if ( $type == 'date' ) {
			$date = thz_akg( 'type/' . $type . '/date', $detail );
			$out  = esc_attr( $date );
		}

		if ( $type == 'user' ) {

			$user_type   = thz_akg( 'type/user/user_type/picked', $detail );
			$userid      = $user_type == 'author' ? get_the_author_meta( 'ID' ) : thz_akg( 'type/user/user_type/specific/userid/0', $detail );
			$displayname = thz_akg( 'type/user/displayname', $detail, 'user_nicename' );
			$username    = get_the_author_meta( $displayname, $userid );
			$user_url    = get_author_posts_url( $userid );
			$user_avatar = thz_akg( 'type/user/author/show', $detail, 'hide' );
			$author_link = thz_akg( 'type/user/author/link', $detail, 'donotlink' );

			$author_avatar = '';
			$has_avatar    = ' no-avatar';

			if ( function_exists( 'get_avatar' ) && $user_avatar == 'show' ) {


				$avatar_size  = thz_akg( 'type/user/avatar/size', $detail, 20 );
				$avatar_shape = thz_akg( 'type/user/avatar/shape', $detail, 'circle' );
				$avatar_space = thz_akg( 'type/user/avatar/space', $detail, 5 );
				$has_avatar   = ' has-avatar';

				$author_avatar .= '<span class="thz-author-avatar ' . $avatar_shape . ' thz-pr-' . $avatar_space . '">';
				$author_avatar .= get_avatar( $userid, $avatar_size );
				$author_avatar .= '</span>';
			}
			$out = '';

			if ( $author_link == 'link' ) {
				$out .= '<a class="thz-project-author-link thz-tips' . $has_avatar . '" href="' . esc_url( $user_url ) . '" title="' . esc_attr( $username ) . '"';
				$out .= ' data-placement="top">';
			}
			$out .= $author_avatar;
			$out .= esc_attr( $username );
			if ( $author_link == 'link' ) {
				$out .= '</a>';
			}

		}

		if ( $type == 'tags' ) {

			$tags = wp_get_post_terms( get_the_ID(), 'fw-portfolio-tag' );

			if ( ! empty( $tags ) ) {

				$tag_out = array();
				foreach ( $tags as $tag ) {
					$tag_link = get_tag_link( $tag->term_id );
					$tag_html = '<a href="' . esc_url( $tag_link ) . '" title="' . $tag->name . '" class="' . $tag->slug . '">';
					$tag_html .= $tag->name;
					$tag_html .= '</a>';

					$tag_out[] = $tag_html;
				}
				unset( $tags );
				$out = implode( ', ', $tag_out );

			} else {
				continue;
			}
		}


		if ( $out != '' && ! empty( $out ) ) {

			$html .= '<div class="thz-project-meta">';
			$html .= '<div class="thz-project-meta-table">';
			$html .= '<div class="thz-project-meta-cell thz-prmeta-label">' . $name . ':</div>';
			$html .= '<div class="thz-project-meta-cell thz-prmeta-info">';
			$html .= '<div class="thz-prmeta-info-in">';
			$html .= $out;
			$html .= '</div>';
			$html .= '</div>';
			$html .= '</div>';
			$html .= '</div>';

		}
	}

	$show_project_shares = thz_get_option( 'ppps/picked', 'show' );

	if ( thz_has_shares() && $show_project_shares == 'show' ) {
		$sharing_label = thz_get_option( 'ppps/show/sharing_label', null );

		$ppps_style   = thz_get_option( 'ppps/show/im/s', 'simple' );
		$ppps_shape   = thz_get_option( 'ppps/show/im/sh', 'square' );
		$ppps_shclass = $ppps_style != 'simple' ? ' thz-so-' . $ppps_shape : '';
		$ppps_class   = ' thz-so-' . $ppps_style . $ppps_shclass;

		$html .= '<div class="thz-project-meta meta-socials">';
		$html .= '<div class="thz-project-meta-table">';
		$html .= '<div class="thz-project-meta-cell thz-prmeta-label">' . esc_html( $sharing_label ) . '</div>';
		$html .= '<div class="thz-project-meta-cell thz-prmeta-info">';
		$html .= '<div class="thz-prmeta-info-in thz-project-shares' . $ppps_class . '">';
		$html .= thz_core_post_shares( false, false );
		$html .= '</div>';
		$html .= '</div>';
		$html .= '</div>';
		$html .= '</div>';
	}


	if ( $html != '' ) {

		$before = '<div class="thz-project-meta-container">';
		$after  = '</div>';
		echo $before . $html . $after;

	}

}


/**
 * Post social share links
 */
if ( ! function_exists( 'thz_post_shares' ) ) {

	function thz_post_shares( $echo = true, $sharing_links = false, $sharing_tooltip = false, $sharing_icons = false ) {
		
		if ( thz_has_shares() ) {
			
			return thz_core_post_shares($echo, $sharing_links, $sharing_tooltip, $sharing_icons);
		}
		
	}

}


/**
 * Check if we have post shares
 * @return bool
*/
function thz_has_shares(){
	
	if ( function_exists( 'thz_core_post_shares' ) ) {
		return true;
	}
}

/**
 * Author contact
 */
if ( ! function_exists( 'thz_author_contacts' ) ) {

	function thz_author_contacts( $author_id ) {


		$author_contact = thz_get_theme_option( 'author_contact/picked' );
		$contacts       = thz_get_theme_option( 'author_contact/show/contacts', null );

		if ( $author_contact == 'hide' || empty( $contacts ) ) {
			return;
		}

		$contacts_space = thz_get_theme_option( 'author_imx/contact', null );
		$contact_label  = thz_get_theme_option( 'author_contact/show/contact_label', null );
		$placement      = thz_get_theme_option( 'author_contact/show/icons_metrics/tip', null );
		$tip_class      = $placement != 'hide' ? 'thz-tips ' : '';
		$contact_print  = '';

		$icons = array(

			'twitter'    => 'thzicon thzicon-twitter-social',
			'facebook'   => 'thzicon thzicon-facebook-social',
			'github'     => 'thzicon thzicon-github-social',
			'googleplus' => 'thzicon thzicon-google-plus-social',
			'linkedin'   => 'thzicon thzicon-linkedin-social',
			'dribbble'   => 'thzicon thzicon-dribbble-social',
			'url'        => 'thzicon thzicon-link',
			'email'      => 'thzicon thzicon-email-social'

		);

		foreach ( $contacts as $c ) {

			$meta = get_the_author_meta( $c, $author_id );

			if ( empty( $meta ) ) {
				continue;
			}

			$title         = $c == 'url' ? 'Website' : $c;
			$tip_print     = $placement != 'hide' ? ' title="' . ucfirst( $title ) . '" data-placement="' . $placement . '"' : '';
			$contact_print .= '<a class="' . $tip_class . 'thz-author-contact" href="' . $meta . '"' . $tip_print . '">';
			$contact_print .= '<span class="' . $icons[ $c ] . '"></span>';
			$contact_print .= '</a>';

		}

		if ( ! empty( $contact_print ) ) {

			$html = '<div class="thz-author-contacts-holder thz-mb-' . thz_m_ton( $contacts_space ) . '">';
			$html .= '<div class="thz-author-contact-label">';
			$html .= esc_html( $contact_label );
			$html .= '</div>';
			$html .= '<div class="thz-author-contacts">';
			$html .= $contact_print;
			$html .= '</div>';
			$html .= '</div>';

			return $html;

		}
	}
}

/**
 * Get related posts
 */
if ( ! function_exists( 'thz_related_posts' ) ) {

	function thz_related_posts( $type, $tax, $perpage ) {

		$tax_query  = array();
		$categories = get_the_terms( get_the_ID(), $tax );
		$cat_ids    = array();

		if ( ! empty( $categories ) ) {

			foreach ( $categories as $cat ) {
				$cat_ids[] = $cat->term_id;
			}
			unset( $categories );

		}

		$tax_query = array(
			array(
				'taxonomy' => $tax,
				'field'    => 'id',
				'terms'    => $cat_ids
			)
		);

		$args = apply_filters ('thz_filter_related_posts_args',array(
			'post__not_in'   => array( get_the_ID() ),
			'posts_per_page' => $perpage,
			'post_type'      => $type,
			'tax_query'      => $tax_query,
			'order'          => 'DESC',
			'orderby'        => 'date'
		));

		$query = new WP_Query( $args );

		return $query;

	}
}

/**
 * Related posts image
 */
if ( ! function_exists( 'thz_related_image' ) ) {

	function thz_related_image( $echo = true, $getid = false ) {

		$thumbnail_id  = get_post_thumbnail_id();
		$related_media = thz_get_post_option( 'post_media', array() );
		$rel_size      = thz_get_option( 'rel_media/show/rel_size', 'thz-img-medium' );


		if ( ! empty( $thumbnail_id ) ) {

			$img   = thz_get_img_src( $thumbnail_id, $rel_size );
			$theid = $thumbnail_id;

		} else if ( ! empty( $related_media ) && empty( $thumbnail_id ) ) {


			$attch_id = false;

			foreach ( $related_media as $relm ) {

				$type = thz_akg( 'type/picked', $relm );

				if ( $type != 'images' ) {

					$attch_id = thz_akg( 'type/' . $type . '/poster/attachment_id', $relm );

				} else {

					$attch_id = thz_akg( 'type/images/media/0/attachment_id', $relm );

				}

				if ( $attch_id && ! empty( $attch_id ) ) {

					$img = thz_get_img_src( $attch_id, $rel_size );

					break;

				} else {

					continue;
				}

			}


			if ( ! $attch_id ) {
				$img = thz_img_placeholder();
			}

			$theid = $attch_id;

		} else {

			$img   = thz_img_placeholder();
			$theid = false;
		}

		$img = set_url_scheme( $img );


		if ( $getid ) {

			return $theid;

		}


		if ( $echo ) {

			echo esc_url( $img );

		} else {

			return esc_url( $img );
		}

	}
}


/**
 * thz-pageblock visibility
 */
if ( ! function_exists( 'thz_page_block_visible' ) ) {

	function thz_page_block_visible( $pb_id ) {

		$status		= get_post_status( $pb_id );
		
		// status
		if ( 'publish' !== $status ){
			
			return false;
		}
		
		$assigned   	= true;
		$visible    	= true;
		$assignto   	= fw_get_db_post_option( $pb_id, 'assignto', array() );
		$unassignfrom   = fw_get_db_post_option( $pb_id, 'unassignfrom', array() );
		$visibility 	= fw_get_db_post_option( $pb_id, 'visibility', 'everyone' ); 
		$visibleto  	= fw_get_db_post_option( $pb_id, 'visibleto', array() );
		$user       	= wp_get_current_user();
		$user_roles 	= $user->roles;

		
		// assigned to
		if ( ! empty( $assignto ) ) {

			$assigned   = thz_page_info_check( $assignto );
			$assignment = fw_get_db_post_option( $pb_id, 'assignment', 'all' );

			if ( ( 'hide' == $assignment && $assigned ) || ( 'show' == $assignment && ! $assigned ) ) {

				$visible = false;

			}
			
			// unassign from
			if ( ! empty( $unassignfrom ) ) {
	
				$unassigned   = thz_page_info_check( $unassignfrom );
	
				if ( $visible && $unassigned ) {
	
					$visible = false;
	
				}else if( !$visible && $unassigned ){
					
					$visible = true;
					
				}
	
			}

		}

		// visible to
		if ( in_array( 'loggedout', $visibleto ) && ! $user->exists() ) {

			$user_roles[] = 'loggedout';
		}

		if ( in_array( 'loggedin', $visibleto ) && $user->exists() ) {

			$user_roles[] = 'loggedin';
		}

		if ( 'custom' == $visibility  && ! empty( $visibleto ) && ! array_intersect( array_keys( $visibleto ), $user_roles ) ) {

			$visible = false;
		}

		return $visible;
	}

}

/**
 * thz-pageblock output
 */
if ( ! function_exists( 'thz_print_page_blocks' ) ) {

	function thz_print_page_blocks( $page_blocks = array(), $class = false, $echo = true ) {

		$html = false;

		if ( thz_fw_loaded() && fw_ext( 'page-builder' ) && ! empty( $page_blocks ) ) {

			
			foreach ( $page_blocks as $pb_id ) {

				if ( thz_has_builder( $pb_id ) ) {

					if ( thz_page_block_visible( $pb_id ) ) {

						$pb_content = do_shortcode( fw_ext_page_builder_get_post_content( $pb_id ) );

						if ( $pb_content ) {

							$html .= $pb_content;

						}

					}
				}

			}

			

		}
		
		if($html){
			$add_class = $class ? ' ' . $class : '';
			$pbb = '<div class="thz-page-block-holder thz-page-builder-content' . $add_class . '">';	
			$pba = '</div>';		
			$html = $pbb.$html.$pba;
		}


		if ( $echo && $html ) {

			echo $html;

		} else {

			return $html;

		}

	}
}



/**
 * thz-pageblock position
 */
if ( ! function_exists( 'thz_page_block' ) ) {
	
	function thz_page_block( $position, $echo = true  ){
		
		$positions 		= get_option('thz_page_blocks_positions',array());
		
		if( empty($positions) ){
			
			return;
			
		}
		
		$my_positions 	= array_keys($positions, $position);
		
		if( !empty($positions) ){
			
			$class =  'thz-page-block-' . str_replace('_','-',$position);
			
			if ( $echo ) {
	
				thz_print_page_blocks( $my_positions, $class, $echo );
	
			} else {
	
				return thz_print_page_blocks( $my_positions, $class, $echo );
	
			}
			
		}
		
	}
	
}

 /**
 * List of pageblocks positions
 * @return array
 */
 
if ( ! function_exists( 'thz_pageblocks_positions_list' ) ) {
	
	function thz_pageblocks_positions_list($id = ''){
		
		$positions_list = array(
		
			'unassigned' 		=> esc_html__('Do not assign position', 'creatus'),
			'above_header' 		=> esc_html__('Above the header', 'creatus'),
			'under_header' 		=> esc_html__('Under the header', 'creatus'),
			'under_hero' 		=> esc_html__('Under the hero section', 'creatus'),
			'above_footer' 		=> esc_html__('Above the footer section', 'creatus'),
			'between_footer' 	=> esc_html__('Between the footer section and branding', 'creatus'),
			'under_footer' 		=> esc_html__('Under the footer branding', 'creatus'),
			'above_post' 		=> esc_html__('Above the post', 'creatus'),
			'under_post' 		=> esc_html__('Under the post', 'creatus'),
			'above_related' 	=> esc_html__('Above the related posts', 'creatus'),
			'under_related' 	=> esc_html__('Under the related posts', 'creatus'),
			'offcanvas_overlay' => esc_html__('Offcanvas Overlay', 'creatus'),					

		);
		
		$custom_positions =  apply_filters ('thz_filter_pageblocks_positions_list',array());
		
		if(!empty($custom_positions)){
			
			$positions_list = array_merge($positions_list, $custom_positions);	
			
		}
		
		return  $positions_list;
		
	}
}

/**
 * Load hero section template
 */
function thz_hero_section( $location ) {
	
	$hero = thz_get_hero_options();

	if ( empty( $hero ) ) {
		return;
	}

	if ( isset( $hero['disable'] ) ) {

		if ( $hero['disable'] === 'inactive' ) {
			return;
		}
	}

	$hero_location = thz_akg( 'hero_location', $hero, 'under' );
	$hero_type     = thz_akg( 'hero_type/picked', $hero, 'title' );


	if ( $location == $hero_location ) {

		if ( $hero_type == 'block' && fw_ext( 'page-builder' ) ) {

			$page_blocks = thz_akg( 'hero_type/block/pb', $hero, null );

			if ( ! empty( $page_blocks ) ) {

				$block_class = 'thz-hero-section-pageblock hero-location-' . $location;
				thz_print_page_blocks( $page_blocks, $block_class );

				return;

			} else {

				get_template_part( 'template-parts/hero', 'section' );

				return;
			}


		} else {

			get_template_part( 'template-parts/hero', 'section' );

			return;

		}


	}

}

/**
 * Load hero section sliders
 */
function thz_hero_section_sliders( $type, $slider_id ) {

	if ( $type == 'slider' ) {
		return fw()->extensions->get( 'slider' )->render_slider( $slider_id, array() );
	}

	if ( $type == 'rev' ) {

		return thz_show_revolution_slider( $slider_id );
	}

	if ( $type == 'layer' ) {

		return thz_show_layer_slider( $slider_id );
	}

}

/**
 * Load hero section post title
 */
function thz_hero_section_post_title( $atts ) {

	global $post;

	$title_mode     = thz_akg( 'hptm/mode', $atts, 'title' );
	$tag            = thz_akg( 'hptm/tag', $atts, 'h2' );
	$valign         = thz_akg( 'hptm/va', $atts, 'middle' );
	$align          = thz_akg( 'hptm/a', $atts, 'center' );
	$title_show_sub = thz_akg( 'hptm/s', $atts, 'u' );
	$title          = get_the_title();
	$current_page   = thz_get_page_type_info( false, true );
	$current_page   = $current_page ? $current_page['setby'] : null;
	$html           = '';
	$sub            = '';
	$allowed_subs   = array( 'is_thz_post_type()', 'is_front_page()', 'is_postspage' );
	$show_sub       = in_array( $current_page, $allowed_subs ) ? true : false;
	$sub_mode       = thz_akg( 'hpt_sm/mode', $atts, 'elements' );

	if ( 'custom' == $sub_mode ) {
		$show_sub = true;
	}

	$object          = get_queried_object();
	$animate         = thz_akg( 'hpt_an', $atts );
	$animation_data  = thz_print_animation( $animate );
	$animation_class = thz_print_animation( $animate, true );
	$author          = $post ? $post->post_author : null;
	$id              = $post ? $post->ID : null;
	$sub_elements    = thz_akg( 'hpt_se', $atts, array() );
	$avatar_location = null;


	if ( 'custom' == $title_mode ) {

		$title = thz_akg( 'hptm_txt', $atts, '' );

	} else {


		if ( ( is_archive() || is_category() || is_tag() ) && $object ) {

			$title = $object->labels ? $object->labels->name : $object->name;
		}

		if ( 'page' == get_option( 'show_on_front' ) &&
		     get_option( 'page_for_posts' ) != 0 &&
		     is_home() &&
		     ! is_front_page()
		) {
			$title  = $object->post_title;
			$author = $object->post_author;
			$id     = $object->ID;
		}

		if ( is_date() ) {

			if ( get_option( 'permalink_structure' ) ) {
				$day   = get_query_var( 'day' );
				$month = get_query_var( 'monthnum' );
				$year  = get_query_var( 'year' );
			} else {
				$m     = get_query_var( 'm' );
				$year  = substr( $m, 0, 4 );
				$month = substr( $m, 4, 2 );
				$day   = substr( $m, 6, 2 );
			}

			if ( is_day() ) {
				$title = mysql2date( 'd F Y', $day . '-' . $month . '-' . $year );
			} elseif ( is_month() ) {
				$title = mysql2date( 'F Y', '01.' . $month . '.' . $year );
			} else {
				$title = mysql2date( 'Y', '01.01.' . $year );
			}

		}


		if ( $current_page == 'is_shop()' ) {

			$title = esc_html__( 'Shop', 'creatus' );
		} elseif ( $current_page == 'is_search()' ) {

			$title = esc_html__( 'Search Results for:', 'creatus' ) . ' ' . esc_html( get_search_query() );
		} elseif ( $current_page == 'is_404()' ) {

			$title = esc_html__( '404', 'creatus' );
		} elseif ( $current_page == 'is_author()' ) {
			$title = get_the_author_meta( 'display_name' );
		} elseif ( $current_page == 'is_tag()' ) {
			$title = esc_html( 'Posts tagged with:', 'creatus' ) . ' ' . $title;
		}

	}

	if ( 'title' == $title_mode && ! in_array( $current_page, array( 'is_search()', 'is_404()' ) ) ) {

		$show_avatar     = thz_akg( 'hpt_aum/show', $atts, 'hide' );
		$avatar_location = thz_akg( 'hpt_aum/location', $atts, 'nextto' );
		$author_link     = thz_akg( 'hpt_aum/link', $atts, 'link' );
		$author_avatar   = '';
		$has_avatar      = ' no-avatar';

		if ( function_exists( 'get_avatar' ) && $show_avatar == 'show' ) {

			$avatar_size  = thz_akg( 'hpt_aum/size', $atts, 50 );
			$avatar_shape = thz_akg( 'hpt_aum/shape', $atts, 'circle' );
			$avatar_space = thz_akg( 'hpt_aum/space', $atts, 10 );

			$has_avatar = ' has-avatar';

			if ( $avatar_location == 'above' || $avatar_location == 'under' ) {

				$avatar_space = $title_show_sub == 'a' ? ' thz-pt-' . $avatar_space . ' thz-pb-' . $avatar_space : ' thz-pb-' . $avatar_space;

			} else if ( $avatar_location == 'undersub' ) {

				$avatar_space = ' thz-pt-' . $avatar_space;

			} else {

				$avatar_space = ' thz-pr-' . $avatar_space;

			}

			$author_avatar .= '<span class="thz-author-avatar ' . $avatar_shape . $avatar_space . '">';
			$author_avatar .= get_avatar( $author, $avatar_size );
			$author_avatar .= '</span>';


		}
	}

	if ( $show_sub && $title_show_sub != 'h' ) {

		if ( 'custom' == $sub_mode ) {

			$sub = do_shortcode( thz_akg( 'hpt_stx', $atts, '' ) );

		} else {

			$subs_array = array();

			if ( get_the_date( '', $id ) && in_array( 'date', $sub_elements ) ) {

				$sub_date = '<span class="thz-hero-title-date thz-hero-post-title-sub-element">';
				$sub_date .= '<time class="entry-date" datetime="' . esc_attr( get_the_date( 'c' ) ) . '">';
				$sub_date .= get_the_date( '', $id );
				$sub_date .= '</time>';
				$sub_date .= '</span>';

				$subs_array ['date'] = $sub_date;
			}

			if ( thz_post_tax_links( 'links' ) && in_array( 'categories', $sub_elements ) ) {


				$sub_cat = '<span class="thz-hero-title-category thz-hero-post-title-sub-element">';
				$sub_cat .= esc_html__( 'in', 'creatus' ) . ' ';
				$sub_cat .= thz_post_tax_links( 'links' );
				$sub_cat .= '</span>';

				$subs_array ['categories'] = $sub_cat;
			}

			if ( get_the_author_meta( 'display_name', $author ) && in_array( 'author', $sub_elements ) ) {

				$sub_author = '<span class="thz-hero-title-author thz-hero-post-title-sub-element' . $has_avatar . '">';

				if ( $avatar_location == 'nextto' ) {
					$sub_author .= $author_avatar;
				}
				$sub_author .= esc_html__( 'by', 'creatus' ) . ' ';
				if ( $author_link == 'link' ) {
					$sub_author .= '<a href="' . esc_url( get_author_posts_url( $author ) ) . '">';
				}
				$sub_author .= esc_attr( get_the_author_meta( 'display_name', $author ) );
				if ( $author_link == 'link' ) {
					$sub_author .= '</a>';
				}
				$sub_author .= '</span>';

				$subs_array ['author'] = $sub_author;

			}

			if ( ! empty( $subs_array ) ) {

				$order_subs = thz_reorder_array( $subs_array, $sub_elements );
				$separator  = thz_get_separator( thz_akg( 'hps_sep', $atts, null ), 'thz-title-sub-spacer' );

				$sub = implode( $separator, $order_subs );
			}

		}


	}

	// in case we have no sub but do have desc, show it.
	if ( ! $show_sub && $sub == '' ) {
		if ( $object ) {

			$desc = $object->description;
			if ( $desc != '' ) {
				$sub .= '<span class="thz-hero-title-desc">';
				$sub .= esc_html( $desc );
				$sub .= '</span>';
			}
		}
	}


	$html .= '<div class="thz-hero-post-title thz-align-' . thz_sanitize_class( $align . $animation_class ) . '"' . thz_sanitize_data( $animation_data ) . '>';
	$html .= '<div class="thz-hero-post-title-inner thz-va-' . thz_sanitize_class( $valign ) . '">';

	if ( $title_show_sub == 'a' && $sub != '' ) {
		$html .= '<div class="thz-hero-post-title-sub">';
		$html .= $sub;
		$html .= '</div>';
	}

	if ( $avatar_location == 'above' ) {
		$html .= $author_avatar;
	}

	$html .= '<' . $tag . ' class="thz-hero-post-title-heading">';
	$html .= $title;
	$html .= '</' . $tag . '>';


	if ( $avatar_location == 'under' ) {
		$html .= $author_avatar;
	}

	if ( $title_show_sub == 'u' && $sub != '' ) {
		$html .= '<div class="thz-hero-post-title-sub">';
		$html .= $sub;
		$html .= '</div>';
	}

	if ( $avatar_location == 'undersub' ) {
		$html .= $author_avatar;
	}

	$html .= '</div>';
	$html .= '</div>';


	return $html;


}

/**
 * Get page title
 */
if ( ! function_exists( 'thz_print_page_title' ) ) {
	
	function thz_print_page_title() {
	
		$page_title_mode   = thz_get_option( 'page_title_metrics/mode', 'both' );
		$show_pagetitle    = $page_title_mode == 'both' || $page_title_mode == 'title' ? true : false;
		$show_breadcrumbs  = $page_title_mode == 'both' || $page_title_mode == 'breadcrumbs' ? true : false;
		$show_subtitle     = thz_get_option( 'pt_show_subtitle/picked', 'hide' );
		$subtitle_location = thz_get_option( 'pt_show_subtitle/show/location', 'above' );
		$order             = thz_get_option( 'page_title_metrics/order', 'p' );
		$page_title_html   = '';
		$breadcrumbs_html  = '';
		$subtitle_html     = '';
		$prefix            = '';
	
		if ( $show_subtitle == 'show' ) {
	
			$subtitle_text = thz_get_option( 'pt_show_subtitle/show/text' );
	
			if ( $subtitle_text != '' ) {
	
				$subtitle_html .= '<div class="thz-pagetitle-subtitle">';
				$subtitle_html .= $subtitle_text;
				$subtitle_html .= '</div>';
			}
		}
	
		if ( $show_pagetitle ) {
	
			$pti_an			= thz_get_option('pti_an',array());
			$pti_and		= thz_print_animation($pti_an);
			$pti_anc		= thz_print_animation($pti_an,true);
			$sptmode		= thz_get_option('sptmode/m','name'); 
			$pt_tag			= thz_get_option('page_title_metrics/tag','h5'); 
	
			if ( class_exists( 'Breadcrumbs_Builder' ) ) {
	
				$build_breadcrumbs = new Breadcrumbs_Builder;
				if( isset($build_breadcrumbs->settings['labels']) ){
					$build_breadcrumbs->settings['labels']	= fw_get_db_ext_settings_option('breadcrumbs');
				}
				$get_breadcrumbs   = $build_breadcrumbs->get_breadcrumbs();
				$current           = end( $get_breadcrumbs );
				$current           = $current['name'];
	
			} else {
	
				$current = wp_title( '', false ) == '' ? esc_html__( 'Blog', 'creatus' ) : wp_title( '', false );
			}
			
			if( is_single() && 'title' != $sptmode ){
				
				if( 'name' == $sptmode  ){
					$obj = get_post_type_object( get_post_type() );
					if ( is_object( $obj ) ) {
						$current = $obj->labels->name;
					}
				}
				if( 'cat' == $sptmode  ){
					$id  = thz_item()->get_id();
					$cats = thz_post_tax_objects( $id );
					$current = !empty($cats) ? key($cats) : $current;
				}
			}
			
			$current = apply_filters( '_thz_filter_current_page_title', $current );
			
	
			if ( is_tag() ) {
				$prefix = esc_html( 'Posts tagged with: ', 'creatus' );
			}
	
			if ( is_author() ) {
				$prefix = esc_html( 'Posts by: ', 'creatus' );
			}
	
			$page_title_html .= '<div class="thz-pagetitle-title'.$pti_anc.'"'.thz_sanitize_data($pti_and).'>';
			if ( $subtitle_location == 'above' && $subtitle_html != '' ) {
				$page_title_html .= $subtitle_html;
			}
			$page_title_html .= '<'.$pt_tag.' class="thz-pagetitle-heading">';
			$page_title_html .= $prefix;
			$page_title_html .= $current;
			$page_title_html .= '</'.$pt_tag.'>';
			if ( $subtitle_location == 'under' && $subtitle_html != '' ) {
				$page_title_html .= $subtitle_html;
			}
			$page_title_html .= '</div>';
		}
	
	
		if ( $show_breadcrumbs && function_exists( 'fw_ext_breadcrumbs' ) ) {
	
			$pti_bca			= thz_get_option('pti_bca',array());
			$pti_bcd			= thz_print_animation($pti_bca);
			$pti_bcc			= thz_print_animation($pti_bca,true);
			$separator        	= thz_get_separator( thz_get_option( 'pt_sep', null ), 'thz-breadcrumbs-separator' );
			$breadcrumbs_html 	.= fw_ext_get_breadcrumbs( $separator );
			
			if(!empty($pti_bca)){
				$breadcrumbs_html = str_replace(
					array(
						'thz-breadcrumbs-links"',
						'thz-breadcrumbs-links'
					),
					array(
						'thz-breadcrumbs-links"'.$pti_bcd,
						'thz-breadcrumbs-links'.$pti_bcc
						
					),$breadcrumbs_html);
			}
			
		}
	
		if ( $order == 'p' ) {
	
			$html = $page_title_html;
			$html .= $breadcrumbs_html;
	
		} else {
	
			$html = $breadcrumbs_html;
			$html .= $page_title_html;
	
		}
		
		$html = apply_filters( '_thz_filter_page_title_print', $html );
	
		echo $html;
	
	}
}


/**
 * Check the page info
 * @return bool
 */
function thz_page_info_check( $assigned_pages = array() ) {

	$show_template = false;

	if ( empty( $assigned_pages ) ) {
		return $show_template;
	}

	foreach ( $assigned_pages as $page ) {

		$pageinfo = thz_get_page_type_info( $page );
		$sub_type = isset( $pageinfo['sub_type'] ) ? $pageinfo['sub_type'] : null;

		// found by slug , brake loop
		if ( $page == $pageinfo['slug'] ) {

			$show_template = true;

			break;
		}

		// found by sub_type
		if ( $page == $sub_type ) {

			$show_template = true;

			break;
		}

		if ( $page == 'all' ) {

			$show_template = true;

			break;
		}
	}

	unset( $assigned_pages );
	unset( $page );

	return $show_template;
}

/**
 * Check if page title should be shown
 * @return bool
 */
function thz_global_page_title() {
	
	if( !thz_fw_active() ){
		if ( 
		( 'page' == get_option( 'show_on_front' ) && is_front_page() && !is_home() ) || 
		( 'posts' == get_option( 'show_on_front' ) && is_home() && is_front_page() )
		){
			return false;
		}
	}

	$show_on           = thz_get_theme_option( 'pt_show_on', null );
	$show_title        = thz_page_info_check( $show_on );
	$global_title      = thz_get_option( 'custom_pagetitle_options/0/page_title_metrics/mode', null );
	$page_title_active = thz_get_option( 'page_title_metrics/mode', null );

	if ( ! $show_title && $global_title == 'inactive' ) {
		return false;
	}

	if ( $page_title_active == 'inactive' ) {
		return false;
	}

	return $show_title;
}

/**
 * Load page title section template
 */
function thz_page_title_section() {

	if ( thz_global_page_title() ) {
		get_template_part( 'template-parts/page-title', 'section' );
	}

}


/**
 * Sanitize and return button HTML
 */
if ( ! function_exists( 'thz_btn_print' ) ) {

	function thz_btn_print( $btn_html ) {

		if ( $btn_html == '' ) {
			return;
		}

		$allowed_btn_html = array(
			'div'    => array(
				'class'              => array(),
				'data-anim-effect'   => array(),
				'data-anim-duration' => array(),
				'data-anim-delay'    => array(),
			),
			'a'      => array(
				'href'   => array(),
				'class'  => array(),
				'target' => array(),
				'title'  => array(),
			),
			'button' => array(
				'class' => array(),
				'title' => array(),
			),
			'span'   => array(
				'class' => array(),
			),
			'i'      => array(
				'class' => array(),
			),

		);

		return wp_kses( $btn_html, $allowed_btn_html );

	}
}

/**
 * Return lightbox data
 */
if ( ! function_exists( 'thz_lightbox_data' ) ) {
	
	function thz_lightbox_data( $options = false ) {
	
		$lightbox_style   = thz_get_theme_option( 'lightbox_style', 'mfp-dark' );
		$lightbox_opacity = thz_get_theme_option( 'lightbox_opacity', 'mfp-opacity-08' );
		$lightbox_effect  = thz_get_theme_option( 'lightbox_effect', 'mfp-zoom-in' );
				
		if ( $options ) {
	
			$lightbox_style   = thz_akg( 'lightbox_style', $options, $lightbox_style );
			$lightbox_opacity = thz_akg( 'lightbox_opacity', $options, $lightbox_opacity );
			$lightbox_effect  = thz_akg( 'lightbox_effect', $options, $lightbox_effect );
	
		}
	
		$data = 'data-bg="' . esc_attr( $lightbox_style ) . '"';
		$data .= ' data-opacity="' . esc_attr( $lightbox_opacity ) . '"';
		$data .= ' data-effect="' . esc_attr( $lightbox_effect ) . '"';
	
		return $data;
	}
}

/**
 * Return lightbox classes
 */
if ( ! function_exists( 'thz_lightbox_classes' ) ) {
	
	function thz_lightbox_classes( $options = false , $item_media = false) {

		$lightbox_mode   = thz_get_theme_option('lightbox_mode', 'thz-lightbox-gallery-simple');
		$lightbox_slider = thz_get_theme_option('lightbox_slider','thz-mfp-show-slider');
				
		if ( $options ) {
	
			$lightbox_mode   = thz_akg('lightbox_mode', $options, $lightbox_mode);
			$lightbox_slider = thz_akg('lightbox_slider', $options, $lightbox_slider );
	
		} 
		
		if( $item_media ){
			
			if( 'thz-lightbox-mode-single' == $lightbox_mode){
				
				return 'thz-lightbox-gallery-simple '.esc_attr( $lightbox_slider );
			}
			
		}
		
		return esc_attr( $lightbox_mode ).' '.esc_attr( $lightbox_slider );
	}
}

/**
 * Return width class based on columns number
 */
function thz_col_width( $number, $default ) {

	if ( ! $number ) {
		$number = $default;
	}

	switch ( (int) $number ) {
		case 1:
			$class = "thz-width-100";
			break;
		case 2:
			$class = "thz-width-50";
			break;
		case 3:
			$class = "thz-width-33";
			break;
		case 4:
			$class = "thz-width-25";
			break;
		case 5:
			$class = "thz-width-20";
			break;
		case 6:
			$class = "thz-width-16";
			break;
		default:
			$class = thz_sanitize_class( $default );
	}

	return $class;
}

/*
 * Return post builder content if builder is active
*/
if ( ! function_exists( 'thz_post_using_builder' ) ) {

	function thz_post_using_builder() {

		if ( is_singular( 'fw-portfolio' ) ) {

			$builder_active_content = thz_get_option( 'ppbac', 'excerpt' );
			$project_layout         = thz_get_option( 'project_layout/picked', 'full' );

			if (
				( thz_has_builder() && $builder_active_content == 'excerpt' && $project_layout != 'builder' )
				||
				( thz_has_builder() && $project_layout == 'builder' )

			) {
				while ( have_posts() ) {
					the_post();
					the_content();
				}
			}
		}
	}
}


/**
 * If singular post block take over width and container spacing
 */
if ( ! function_exists( 'thz_single_blocks_controll' ) ) {

	function thz_single_blocks_controll() {

		if ( thz_has_sidebar() ) {
			return;
		}

		if ( is_singular( array( 'post', 'fw-portfolio', 'fw-event', 'product' ) ) ) {
			return true;
		}

	}

}

/**
 * thz-main container
 */
function thz_container() {

	if ( is_page_template( 'template-parts/page-builder.php' ) ) {

		return 'thz-full-width-container thz-main-container';

	} else {

		if ( thz_single_blocks_controll() ) {

			return 'thz-container-singular thz-main-container';

		} else {

			return 'thz-container thz-main-container';

		}
	}
}

/**
 * body data attr
 */
function thz_body_data(){
	
	$fpr_atts			= thz_full_rows(true);
	
	if( $fpr_atts ){
		
		$animation		= thz_akg('fp/animation',$fpr_atts,'none');
		$speed			= thz_akg('fp/speed',$fpr_atts,700);
		$easing			= thz_akg('fp/easing',$fpr_atts,'easeInOutCubic');
		$scrollbars		= thz_akg('fp/scrollbars',$fpr_atts,'donothide');
		$overflow		= thz_akg('fp/overflow',$fpr_atts,'enable');
		$hash			= thz_akg('fp/hash',$fpr_atts,'disable');
		$replay			= thz_akg('ra',$fpr_atts,'replay');
		
		$fpr_data	= array(
			'data-fpr-animation="'.esc_attr($animation).'"',
			'data-fpr-speed="'.esc_attr($speed).'"',
			'data-fpr-easing="'.esc_attr($easing).'"',
			'data-fpr-scrollbars="'.esc_attr($scrollbars).'"',
			'data-fpr-overflow="'.esc_attr($overflow).'"',
			'data-fpr-hash="'.esc_attr($hash).'"',
			'data-fpr-replay="'.esc_attr($replay).'"'
		);	
		
		echo implode('' ,$fpr_data) ;
	}
}

/*
 * Start main page content wrappers
*/
if ( ! function_exists( 'thz_site_main_start' ) ) {

	function thz_site_main_start() {

		thz_post_using_builder();

		if ( thz_passed_var( 'no_builder' ) ) {

			$mainclass = array();
			$bodyclass = get_body_class();
			
			if( thz_has_sidebar() ){
				
				$mainclass[] = 'thz-has-sidebar';
			}
			
			foreach ( $bodyclass as $key => $bc ) {
				if ( $key > 3 ) {
					continue;
				}
				$mainclass[] = 'thz-mainwrap-' . $bc;
			}
			$sticky_l = thz_get_option( 'stsb/l', 'inactive' );
			$sticky_r = thz_get_option( 'stsb/r', 'inactive' );

			if ( 'active' == $sticky_l ) {

				$mainclass[] = 'thz-sticky-sidebar-left';
			}

			if ( 'active' == $sticky_r ) {

				$mainclass[] = 'thz-sticky-sidebar-right';
			}

			$mainclass = implode( ' ', $mainclass );
			$contain   = thz_contained( 'main_contained/picked', false, true );

			if ( thz_single_blocks_controll() ) {

				$contain = '';
			}

			$html = '<div id="thz-main-wrap" class="thz-mainwrap ' . $mainclass . '">';
			$html .= '<div class="' . thz_container() . $contain .'">';
			$html .= '<div class="thz-main">';

			echo $html;
		}

	}
}

/*
 * End main page content wrappers
*/
if ( ! function_exists( 'thz_site_main_end' ) ) {

	function thz_site_main_end() {

		if ( thz_passed_var( 'no_builder' ) ) {
			$html = '</div><!-- / .thz-main  -->';
			$html .= '</div><!-- / .thz-container  -->';
			$html .= '</div><!-- / #thz-main-wrap -->';

			echo $html;
		}

	}
}

/*
 * Detect lateral headers
*/
function thz_detect_lateral_header( $side = false ) {

	$headers = thz_get_option( 'headers/picked', 'inline' );

	switch ( $side ) {
		case 'left':
			$laterals = array( 'left', 'mini', 'offcanvas' );
			break;
		case 'right':
			$laterals = array( 'right', 'miniright' );
			break;
		default:
			$laterals = array( 'left', 'right', 'mini', 'miniright', 'offcanvas' );
	}

	if ( in_array( $headers, $laterals ) ) {

		return true;

	} else {

		return false;

	}
}

/*
 * Load headers
*/
function thz_site_header( $location ) {

	$header_type = thz_get_option( 'headers/picked', 'inline' );
	$path 		 = thz_theme_file_path('/template-parts/headers/header-'.$header_type.'.php');

	if ( $location == 'left' && thz_detect_lateral_header( 'left' ) ) {
		thz_render_view( $path ,array(), false );
	}

	if ( $location == 'right' && thz_detect_lateral_header( 'right' ) ) {
		thz_render_view( $path ,array(), false );
	}

	if ( $location == 'main' && ! thz_detect_lateral_header() ) {
		thz_render_view( $path ,array(), false );
	}

}

/*
 * Load blocks above header
*/
function thz_above_header( $location ) {
	
	 $header_type 	= thz_get_option( 'headers/picked', 'inline' );
	 $show_in 		= array( 'left', 'right', 'mini', 'miniright');
	 $show_out 		= array( 'stacked', 'inline', 'centered', 'split', 'offcanvas' );
	 
	 if(  
	 	$location == 'out' && in_array( $header_type,  $show_out) 
		||
		$location == 'in' && in_array( $header_type,  $show_in)
	 
	  ){
		
		 thz_hero_section('above');
		 thz_widgets_section_print('ah','above_header_section');
		 thz_page_block('above_header');
		
	 }
	 
}

/*
 * Add html class names
*/
if ( ! function_exists( 'thz_html_classes' ) ) {

	function thz_html_classes() {

		$site            = 'thz-site-html';
		$header_mode 	 = ' thz-header-mode-'.thz_get_option('header_mode','stacked');
		$headers         = ' header_' . thz_get_option( 'headers/picked', 'inline' ).$header_mode;
		$preloader       = thz_get_option( 'preloader', 'disable' ) == 'enable' ? ' thz-preloader-active' : '';
		$lateral         = thz_detect_lateral_header() ? ' thz-lateral-header' : ' thz-horizontal-header';
		$body_frame      = thz_get_option( 'bf/m', 'inactive' );
		$browser         = new ThzBrowser;
		$browser_class   = array();
		$browser_class[] = 'thz-' . $browser->Name;
		$browser_class[] = 'thz-' . $browser->Name . '-' . str_replace( '.', '-', $browser->Version );
		$browser_class[] = 'thz-' . $browser->Name . '-' . ( wp_is_mobile() ? 'mobile thz-is-mobile' : 'desktop' );

		if ( 'active' == $body_frame ) {

			$browser_class[] = 'thz-body-is-framed';
		}
		
		if( thz_full_rows( true, 'fp/scrollbars' ) == 'hide' ){
			$browser_class[] = 'thz-overflow-hidden';
		}
		
		$browser_class = ' ' . implode( ' ', $browser_class );

		echo thz_sanitize_class( $site . $headers . $lateral . $preloader . $browser_class );

	}
}

/*
* Add page preloader
* @return preloader html or css
**/
function thz_preloader( $css = false ) {

	$preloader = thz_get_option( 'preloader', 'disable' );

	if ( $preloader == 'enable' ) {

		$preloader_style   = thz_get_option( 'pl_style', '1' );
		$preloader_delay   = thz_get_option( 'pl_mx/delay', 500 );
		$preloader_onclick = thz_get_option( 'pl_mx/onclick', 'active' );
		$preloader_text    = thz_get_option( 'pl_mx/text', 'hide' );
		$preloader_leave   = thz_get_option( 'pl_mx/effect', 'curtain' );


		if ( $css ) {

			$preloaderbg = thz_get_option( 'pl_mx/bg', '#333333' );
			$preloaderc  = thz_get_option( 'pl_mx/co', 'color_1' );

			$add_css = '.thz-preloader,.thz-preloader.leave-curtain:before,.thz-preloader.leave-curtain:after{';
			$add_css .= 'background:' . $preloaderbg . ';';
			$add_css .= '}';
			if ( $preloader_text == 'show' ) {
				$add_css .= '.thz-preloader-text{';
				$add_css .= 'color:' . $preloaderc . ';';
				$add_css .= '}';
			}
			$add_css .= '.thz-loader-1 {';
			$add_css .= 'border-top-color: ' . $preloaderc . ';';
			$add_css .= 'border-bottom-color: ' . $preloaderc . ';';
			$add_css .= 'border-left-color: ' . $preloaderc . ';';
			$add_css .= '}';
			$add_css .= '.thz-loader-1::after,.thz-loader-4::after,';
			$add_css .= '.thz-loader-7,.thz-loader-7::after,.thz-loader-7::before{';
			$add_css .= 'background: ' . $preloaderc . ';';
			$add_css .= '}';
			$add_css .= '.thz-loader-2{';
			$add_css .= 'border-top-color: ' . $preloaderc . ';';
			$add_css .= '}';
			$add_css .= '.thz-loader-2:before ,.thz-loader-4::before ,.thz-loader-5,';
			$add_css .= '.thz-loader-6::before,.thz-loader-6::after{';
			$add_css .= 'border-color: ' . $preloaderc . ';';
			$add_css .= '}';
			$add_css .= '.thz-loader-3 {';
			$add_css .= 'border-top-color: ' . $preloaderc . ';';
			$add_css .= 'border-bottom-color: ' . $preloaderc . ';';
			$add_css .= '}';
			$add_css .= '.thz-loader-7,';
			$add_css .= '.thz-loader-7::after,';
			$add_css .= '.thz-loader-7::before,';
			$add_css .= '.thz-loader-8,';
			$add_css .= '.thz-loader-9 {';
			$add_css .= 'color:' . $preloaderc . ';';
			$add_css .= '}';


			return $add_css;

		} else {

			$html = '<div class="thz-preloader leave-' . thz_sanitize_class( $preloader_leave ) . '"';
			$html .= ' data-delay="' . esc_attr( $preloader_delay ) . '"';
			$html .= ' data-onclick="' . esc_attr( $preloader_onclick ) . '">';
			$html .= '<div class="thz-preloader-in">';
			$html .= '<div class="thz-loader-' . thz_sanitize_class( $preloader_style ) . '"></div>';
			if ( $preloader_text == 'show' ) {
				$html .= '<div class="thz-preloader-text">';
				$html .= esc_html( 'Loading...', 'creatus' );
				$html .= '</div>';
			}
			$html .= '</div>';
			$html .= '</div>';

			echo $html;

		}
	}
}


/* Slick slider data */
function thz_slick_data( $layout, $animation, $breakpoints = false ) {

	// layout
	$slidesToShow   = thz_akg( 'show', $layout, 1 );
	$slidesToScroll = thz_akg( 'scroll', $layout, 1 );
	$space          = thz_akg( 'space', $layout, 0 );
	$dots           = thz_akg( 'dots', $layout, 'inside' );
	$arrows         = thz_akg( 'arrows', $layout, 'show' );
	$centerMode     = thz_akg( 'center', $layout, 0 );
	$centerPadding  = thz_akg( 'cspace', $layout, 60 );
	$listoverflow  	= thz_akg( 'listov', $layout, 'hidden' );

	// animation
	$speed         = thz_akg( 'speed', $animation, 300 );
	$autoplay      = thz_akg( 'autoplay', $animation, 0 );
	$autoplaySpeed = thz_akg( 'autoplayspeed', $animation, 3000 );
	$pauseOnHover  = thz_akg( 'pauseonhover', $animation, 1 );
	$infinite      = thz_akg( 'infinite', $animation, 1 );
	$fade          = thz_akg( 'fade', $animation, 0 );
	$vertical      = thz_akg( 'vertical', $animation, 0 );
	$cssease       = thz_akg( 'cssease', $animation, 'ease-in-out' );
	$autodir       = thz_akg( 'autodir', $animation, 'default' );

	if ( $slidesToShow > 1 ) {

		$fade = 0;
	}

	$slick_data  = ' data-slidesToShow="' . esc_attr( $slidesToShow ) . '"';
	$slick_data .= ' data-slidesToScroll="' . esc_attr( $slidesToScroll ) . '"';
	$slick_data .= ' data-space="' . esc_attr( $space ) . '"';
	$slick_data .= ' data-dots="' . esc_attr( $dots ) . '"';
	$slick_data .= ' data-arrows="' . esc_attr( $arrows ) . '"';
	$slick_data .= ' data-cssease="' . esc_attr( $cssease ) . '"';
	$slick_data .= ' data-speed="' . esc_attr( $speed ) . '"';

	if ( $centerMode == 1 ) {
		$slick_data .= ' data-centermode="' . esc_attr( $centerMode ) . '"';
		$slick_data .= ' data-centerpadding="' . esc_attr( $centerPadding ) . '"';
	}

	if ( $autoplay == 1 ) {
		$slick_data .= ' data-autoplay="' . esc_attr( $autoplay ) . '"';
		$slick_data .= ' data-autoplaySpeed="' . esc_attr( $autoplaySpeed ) . '"';
		$slick_data .= ' data-pauseOnHover="' . esc_attr( $pauseOnHover ) . '"';
		
		if ( $vertical == 0 && $autodir == 'reverse' ) {
			$slick_data .= ' data-autodir="reverse"';
		}
	}
	
	if ( $vertical == 1 || $vertical == 2 ) {
		$fade       = 0;
		$slick_data .= ' data-vertical="' . esc_attr( $vertical ) . '"';
	}

	if ( $listoverflow == 'visible' ) {
		$slick_data .= ' data-list="visible"';
	}

	if ( $infinite == 1 ) {
		$slick_data .= ' data-infinite="' . esc_attr( $infinite ) . '"';
	}

	if ( $fade == 1 ) {
		$slick_data .= ' data-fade="' . esc_attr( $fade ) . '"';
	}

	if ( ! is_array( $layout ) && is_array( $layout ) ) {
		$slick_data .= ' data-checkslick="check-slick"';
	}

	if ( $breakpoints && ! empty( $breakpoints ) ) {


		$bps = array();
		foreach ( $breakpoints as $key => $b ) {
			$bps[ $key ]['breakpoint'] = (int) $b['b']['breakpoint'];
			$bps[ $key ]['settings']   = array(

				'slidesToShow'   => (int) $b['b']['show'],
				'slidesToScroll' => (int) $b['b']['scroll'],
				'thzSpace'       => (int) $b['b']['space'],
				'centerMode'     => (bool) $b['b']['center'],
				'centerPadding'  => thz_property_unit( $b['b']['cspace'], 'px' ),

			);
			unset( $b );
		}
		unset( $breakpoints );
		$slick_data .= ' data-breakpoints="' . thz_htmlspecialchars( json_encode( $bps ) ) . '"';
	}

	return $slick_data;

}

/**
 * Multiple slides CSS
 */
if ( ! function_exists( 'thz_slick_multiple_css' ) ) {

	function thz_slick_multiple_css( $container, $show, $space, $vertical, $class = '' ) {

		$add_css = '';

		if ( $vertical == 1 || $vertical == 2 ) {

			if ( $space > 0 ) {
				$add_css .= $container . ' .thz-slick-initiating .thz-slick-slide' . $class . '{';
				$add_css .= 'padding-bottom:' . thz_property_unit( $space, 'px' ) . ';';
				$add_css .= '}';

				$add_css .= $container . ' .thz-slick-initiating{';
				$add_css .= 'margin-bottom:-' . thz_property_unit( $space, 'px' ) . ';';
				$add_css .= '}';
			}

			$add_css .= $container . ' .thz-slick-initiating .thz-slick-slide:nth-child(' . $show . ') ~ .thz-slick-slide{';
			$add_css .= 'display:none';
			$add_css .= '}';

		} else {

			$calc_per = 100 / $show;
			$calc_n   = $space > 0 ? $space / $show : 0;
			$add_css  .= $container . ' .thz-slick-initiating .thz-slick-slide' . $class . '{';
			$add_css  .= 'width:calc(' . thz_property_unit( $calc_per, '%' ) . ' + ' . thz_property_unit( $calc_n, 'px' ) . ');';
			$add_css  .= 'padding-right:' . thz_property_unit( $space, 'px' ) . ';';
			$add_css  .= '}';

		}

		return $add_css;

	}
}

/**
 * Woo in cart
 */
function thz_woo_in_cart( $product_id ) {
	global $woocommerce;

	foreach ( $woocommerce->cart->get_cart() as $val ) {
		$_product = $val['data'];

		if ( $product_id == thz_woo_get_id( $_product ) ) {
			return true;
		}
	}

	return false;
}


/**
 * FW flash msg
 */
function thz_flash_fw_msg() {

	if ( defined( 'FW' ) ) {
		FW_Flash_Messages::_print_frontend();
	}

}


/**
 * Timestamp to date
 */
function thz_ts_date( $timestamp, $format = false ) {


	$date = new DateTime();
	$date->setTimestamp( $timestamp );

	$date_setting = get_option( 'date_format' );
	$time_setting = get_option( 'time_format' );
	$set_format   = $date_setting . ' ' . $time_setting;

	if ( $format ) {
		$set_format = $format;
	}

	return $date->format( $set_format );

}


/**
 * Events date and time
 */
function thz_events_date( $from, $to, $date = true, $time = true ) {

	$from = explode( ' ', $from );
	$to   = explode( ' ', $to );

	$f_date = isset( $from[0] ) ? thz_ts_date( strtotime( $from[0] ), get_option( 'date_format', 'F j, Y' ) ) : '';
	$f_time = isset( $from[1] ) ? thz_ts_date( strtotime( $from[1] ), get_option( 'time_format', 'g:i a' ) ) : '';

	$t_date = isset( $to[0] ) ? thz_ts_date( strtotime( $to[0] ), get_option( 'date_format', 'F j, Y' ) ) : '';
	$t_time = isset( $to[1] ) ? thz_ts_date( strtotime( $to[1] ), get_option( 'time_format', 'g:i a' ) ) : '';

	$date_print = '';
	$sep        = ' - ';
	$sep_at     = ' @ ';


	if ( ! $date ) {
		$sep_at = '';
		$f_date = '';
		$t_date = '';
	}

	if ( ! $time ) {
		$sep_at = '';
		$f_time = '';
		$t_time = '';
	}

	// diff dates & time
	if ( $f_date !== $t_date && $f_time !== $t_time ) {

		$add_f_time = $f_time != '' ? $sep_at . $f_time : '';
		$add_t_time = $t_time != '' ? $sep_at . $t_time : '';
		$date_print = $f_date . $add_f_time . $sep . $t_date . $add_t_time;
	}

	// same dates diff times
	if ( $f_date === $t_date && $f_time !== $t_time ) {

		$date_print = $f_date . $sep_at . $f_time . $sep . $t_time;
	}

	// same dates same times
	if ( $f_date === $t_date && $f_time === $t_time ) {

		$add_time   = $f_time != '' ? $sep_at . $f_time : '';
		$date_print = $f_date . $add_time;
	}

	// diff dates empty times
	if ( $f_date !== $t_date && $f_time === '' ) {

		$date_print = $f_date . $sep . $t_date;
	}

	// remove year if current
	if ( date( 'Y', strtotime( $from[0] ) ) === date( "Y" ) && date( 'Y', strtotime( $to[0] ) ) === date( "Y" ) ) {
		$date_print = str_replace( array( ', ' . date( "Y" ), date( "Y" ) . '-', '/' . date( "Y" ) ), '', $date_print );
	}

	return $date_print;
}


/**
 * Get shortcode [map] html string
 *
 * @param int $post_id
 *
 * @return null | string
 */
if ( ! function_exists( 'thz_ext_events_render_map' ) ) {

	function thz_ext_events_render_map( $post_id = 0, $map_height = 250 ) {
		if ( 0 === $post_id && null === ( $post_id = get_the_ID() ) ) {
			return null;
		}
		$fw_ext_events = fw()->extensions->get( 'events' );
		if ( empty( $fw_ext_events ) ) {
			return null;
		}
		$post = get_post( $post_id );
		if ( $post->post_type !== $fw_ext_events->get_post_type_name() ) {
			return null;
		}
		$shortcode_ext = fw()->extensions->get( 'shortcodes' );
		if ( empty( $shortcode_ext ) ) {
			return null;
		}
		$shortcode_map = $shortcode_ext->get_shortcode( 'map' );
		if ( empty( $shortcode_map ) ) {
			return null;
		}
		$options = fw_get_db_post_option( $post->ID, $fw_ext_events->get_event_option_id() );
		if ( empty( $options['event_location']['location'] ) or empty( $options['event_location']['coordinates']['lat'] ) or empty( $options['event_location']['coordinates']['lng'] ) ) {
			return null;
		}

		return $shortcode_map->render_custom(
			array(
				array(
					'title'       => $post->post_title,
					'url'         => get_permalink( $post->ID ),
					'description' => $options['event_location']['location'],
					'thumb'       => array( 'attachment_id' => get_post_thumbnail_id( $post->ID ) ),
					'location'    => array(
						'coordinates' => array(
							'lat' => $options['event_location']['coordinates']['lat'],
							'lng' => $options['event_location']['coordinates']['lng']
						)
					)
				)
			),
			array(
				'map_height' => $map_height,
				'map_type'   => false
			)
		);
	}
}

/**
 * Events price
 */

function thz_event_price() {


	$ev_price = thz_get_post_option( 'ev_price', array() );

	if ( empty( $ev_price ) ) {
		return;
	}

	$html = '';
	if ( $ev_price['l'] != '' ) {
		$html .= '<a class="thz-event-price-link" href="' . $ev_price['l'] . '">';
	}

	if ( $ev_price['s'] != '' && $ev_price['sl'] == 'b' ) {
		$html .= '<span class="thz-event-price-symbol">';
		$html .= $ev_price['s'];
		$html .= '</span>';
	}
	if ( $ev_price['c'] != '' ) {
		$html .= '<span class="thz-event-price-cost">';
		$html .= $ev_price['c'];
		$html .= '</span>';
	}
	if ( $ev_price['s'] != '' && $ev_price['sl'] == 'a' ) {
		$html .= '<span class="thz-event-price-symbol">';
		$html .= $ev_price['s'];
		$html .= '</span>';
	}
	if ( $ev_price['l'] != '' ) {
		$html .= '</a>';
	}

	if ( $html != '' ) {
		return $html;
	}

}

/**
 * Event organizer
 */
function thz_event_organizer() {

	$ev_organizer = thz_get_post_option( 'ev_organizer/picked', 'custom' );

	$html = '';
	if ( $ev_organizer == 'c' ) {
		$user = thz_get_post_option( 'ev_organizer/c/user', '' );
		$html .= $user;
	} else {

		$displayname = thz_get_post_option( 'ev_organizer/s/display', '' );
		$userid      = thz_get_post_option( 'ev_organizer/s/user/0', '' );
		$username    = get_the_author_meta( $displayname, $userid );
		$user_url    = get_author_posts_url( $userid );
		$html        .= '<a class="thz-event-organizer-link" href="' . esc_url( $user_url ) . '" title="' . esc_attr( $username ) . '">';
		$html        .= esc_attr( $username );
		$html        .= '</a>';
	}

	if ( $html != '' ) {
		return $html;
	}

}

if ( ! function_exists( '_thz_return_memory_size' ) ) {
	/**
	 * print theme requirements page
	 *
	 * @param string $size
	 */
	function _thz_return_memory_size( $size ) {
		$symbol = substr( $size, - 1 );
		$return = (int) $size;
		switch ( strtoupper( $symbol ) ) {
			case 'P':
				$return *= 1024;
			case 'T':
				$return *= 1024;
			case 'G':
				$return *= 1024;
			case 'M':
				$return *= 1024;
			case 'K':
				$return *= 1024;
		}

		return $return;
	}
}


/**
 * get toolbar content
 *
 * @return string
 */
if ( ! function_exists( 'thz_toolbar_content' ) ) {


	function thz_toolbar_content( $side ) {

		$content = thz_get_option( 'htb/show/c/' . $side, 'p' );


		if ( $content === 'p' ) {

			$spe    = '';
			$slogan = thz_get_option( 'htb/show/s', '' );
			$phone  = thz_get_option( 'htb/show/p', '' );
			$email  = thz_get_option( 'htb/show/e', '' );


			if ( $slogan != '' ) {
				$spe .= '<div class="thz-ht-slogan thz-ht-item">';
				$spe .= esc_html( $slogan );
				$spe .= '</div>';
			}
			if ( $phone != '' ) {
				$spe .= '<div class="thz-ht-phone thz-ht-item">';
				$spe .= '<span class="thzicon thzicon-phone2"></span>';
				$spe .= esc_html( $phone );
				$spe .= '</div>';
			}
			if ( $email != '' ) {
				$spe .= '<div class="thz-ht-phone thz-ht-item">';
				$spe .= '<span class="fa fa-paper-plane"></span>';
				$spe .= '<a href="' . thz_protect_email( $email, true ) . '">';
				$spe .= esc_html( $email );
				$spe .= '</a>';
				$spe .= '</div>';
			}

			if ( $spe != '' ) {
				return $spe;
			}

		}

		if ( $content === 's' ) {
			$socials = thz_social_links_print( 'tsim', 'tc', 'thz-socials-toolbar' );

			return $socials;
		}


		if ( $content === 'n' ) {
			thz_toolbar_menu();
		}

	}

}


/**
 * Offcanvas html
 *
 * @return string
 */
if ( ! function_exists( 'thz_offcanvas_header_layout' ) ) {

	function thz_offcanvas_header_layout() {

		$header_layout  = thz_get_option( 'hicmx/l', 'layout1' );
		$show_search    = thz_get_option( 'hicmx/s', 'hide' );
		$show_woo       = thz_get_option( 'hicmx/w', 'hide' );
		$show_socials   = thz_get_option( 'hicmx/so', 'hide' );
		$offcanvas_type = thz_get_option( 'hofmx/t', 'push' );
		$socials_cont   = '';
		$socials        = '';

		// socials
		if ( 'show' == $show_socials ) {

			$socials_links = thz_get_option( 'thz_sl', array() );
			foreach ( $socials_links as $social_link ) {

				if ( 'hide' == $social_link['showin']['m'] ) {
					continue;
				}

				$socials .= '<a href="' . esc_url( $social_link['link'] ) . '" target="_blank" class="thz-menu-social-link thz-offcanvas-icon">';
				$socials .= '<i class="' . esc_attr( $social_link['icon'] ) . '"></i>';
				$socials .= '</a>';
			}


			if ( $header_layout == 'layout6' || $header_layout == 'layout7' ) {

				$socials_cont .= '<div class="thz-header-cell thz-offcanvas-socials">';
				$socials_cont .= '<div class="thz-header-cell-in">';
				$socials_cont .= $socials;
				$socials_cont .= '</div>';
				$socials_cont .= '</div>';

			} else {

				$socials_cont .= '<div class="thz-header-cell-in thz-offcanvas-socials">';
				$socials_cont .= $socials;
				$socials_cont .= '</div>';

			}

		}


		$logo = thz_logo_print();

		$burger = '<span class="thz-offcanvas-icon thz-offcanvas-burger">';
		$burger .= '<button class="thz-burger thz-burger--spin-r thz-open-canvas thz-burger-onoverlay thz-canvas-burger" type="button">';
		$burger .= '<span class="thz-burger-box"><span class="thz-burger-inner"></span></span>';
		$burger .= '</button>';
		$burger .= '</span>';

		$menu = '<div class="thz-header-cell thz-offcanvas-buttons thz-offcanvas-burger">';
		$menu .= '<div class="thz-header-cell-in">';
		$menu .= $burger;
		$menu .= '</div>';
		$menu .= '</div>';


		$icons = '<div class="thz-header-cell thz-offcanvas-buttons">';
		$icons .= '<div class="thz-header-cell-in">';


		if ( $header_layout == 'layout1' || $header_layout == 'layout2' ) {
			$icons .= $socials_cont;
		}

		if ( $header_layout == 'layout4' || $header_layout == 'layout7' ) {
			$icons .= $burger;
		}


		if ( $header_layout == 'layout3' ) {
			$icons .= $socials_cont;
		}

		if ( $show_search == 'show' ) {
			$icons .= '<a class="thz-offcanvas-search thz-open-search thz-offcanvas-icon" href="#"><i class="thzicon thzicon-search3"></i></a>';
		}
		if ( $show_woo == 'show' && class_exists( 'WooCommerce' ) ) {

			global $woocommerce;

			$cart_url   = wc_get_cart_url();
			$cart_icon  = thz_get_option( 'hicmx/cic', 'thzicon thzicon-shopping-cart2' );
			$show_count = thz_get_option( 'hicmx/ico', 'hide' );
			$cart_badge = '';

			if ( $show_count == 'show' ) {
				$nitems     = $woocommerce->cart->cart_contents_count;
				$double     = $nitems > 9 ? ' thz-mini-double' : ' thz-mini-single';
				$has_items  = $nitems > 0 ? ' thz-mini-has-items' . $double : ' thz-mini-no-items' . $double;
				$cart_badge .= '<span class="thz-woo-cart-badge' . $has_items . '">';
				$cart_badge .= '<span>';
				$cart_badge .= $nitems;
				$cart_badge .= '</span>';
				$cart_badge .= '</span>';
			}

			$icons .= '<a class="thz-offcanvas-shop thz-offcanvas-icon" href="' . $cart_url . '"><i class="thz-woo-cart-icon ' . $cart_icon . '">' . $cart_badge . '</i></a>';
		}


		if ( $header_layout == 'layout4' || $header_layout == 'layout5' || $header_layout == 'layout8' ) {
			$icons .= $socials_cont;
		}

		if ( $header_layout == 'layout1' || $header_layout == 'layout6' ) {
			$icons .= $burger;
		}
		$icons .= '</div></div>';


		switch ( $header_layout ) {
			case 'layout1':
				$html = $logo . $icons;
				break;
			case 'layout2':
				$html = $menu . $logo . $icons;
				break;
			case 'layout3':
				$html = $menu . $logo . $icons;
				break;
			case 'layout4':
				$html = $icons . $logo;
				break;
			case 'layout5':
				$html = $icons . $logo . $menu;
				break;
			case 'layout6':
				$html = $socials_cont . $logo . $icons;
				break;
			case 'layout7':
				$html = $icons . $logo . $socials_cont;
				break;
			case 'layout8':
				$html = $icons . $logo . $menu;
				break;
			default:
				$html = $logo . $icons;
		}

		return $html;
	}
}

/**
 * Stacked header html
 *
 * @return string
 */
if ( ! function_exists( 'thz_stacked_header_content_print' ) ) {

	function thz_stacked_header_content_print() {


		$content_type = thz_get_option( 'hstac', 'search' );
		$slogan       = thz_get_option( 'hstas', '' );


		$html = '<div class="thz-header-content type-' . $content_type . '">';
		$html .= '<div class="thz-header-content-in">';

		if ( 'banner' == $content_type ) {
			$banner = thz_get_option( 'hstab', '' );

			if ( $banner != '' ) {
				$html .= do_shortcode( $banner );
			}
		}
		if ( 'search' == $content_type || 'slogansearch' == $content_type ) {
			if ( $slogan != '' && 'slogansearch' == $content_type ) {
				$html .= '<div class="thz-header-content-slogan">';
				$html .= esc_attr( $slogan );
				$html .= '</div>';
			}
			$html .= '<form class="thz-search-form" method="get" action="' . esc_url( home_url( '/' ) ) . '">';
			$html .= '<div class="thz-search-form-inner">';
			$html .= '<input type="text" class="text-input" placeholder="' . __( 'Start typing', 'creatus' ) . '" value="" name="s" />';
			$html .= '<input value="" class="search-button" type="submit" />';
			$html .= '</div>';
			$html .= '</form>';
		}

		if ( 'slogan' == $content_type && $slogan != '' ) {

			if ( $slogan != '' ) {
				$html .= '<div class="thz-header-content-slogan">';
				$html .= esc_attr( $slogan );
				$html .= '</div>';
			}
		}

		$html .= '</div>';
		$html .= '</div>';


		if ( 'nothing' != $content_type ) {
			return $html;
		}
	}
}


/**
 * Footer content
 *
 * @return mixed
 */
if ( ! function_exists( 'thz_footer_content' ) ) {


	function thz_footer_content( $side ) {

		$content = thz_get_option( 'foc/' . $side, 'b' );;

		// branding
		if ( $content === 'b' ) {

			$branding = thz_print_branding( false );

			return $branding;

		}

		// socials
		if ( $content === 's' ) {
			$socials = thz_social_links_print( 'fsim', 'fc', 'thz-socials-footer', false, false );

			return $socials;
		}

		// navigation
		if ( $content === 'n' ) {
			return thz_footer_menu();
		}

	}

}

/**
 * Footer html
 *
 * @return string
 */
if ( ! function_exists( 'thz_print_footer' ) ) {

	function thz_print_footer() {


		$display_mode    = thz_get_option( 'footer_mx/m', 'both' );
		$footer_on       = true;
		$footer_sections = thz_widgets_section_print( 'f', 'footer_section', false );
		$html            = '';
		
		if ( 'hidden' == $display_mode || 'widgets' == $display_mode ) {
			$footer_on = false;
		}
		if ( 'hidden' == $display_mode || 'footer' == $display_mode || 'block' == $display_mode ) {
			$footer_sections = false;
		}

		if ( $footer_sections || $footer_on ) {

			$page_blocks = thz_get_option( 'fpb', null );

			if ( 'block' != $display_mode ) {

				$layout     = thz_get_option( 'foc/la', 'table' );
				$left       = thz_get_option( 'foc/l', 'b' );
				$middle     = thz_get_option( 'foc/m', 'h' );
				$right      = thz_get_option( 'foc/r', 's' );
				$cell_class = ' third';
				$all_sides  = array( $left, $middle, $right );


				if ( in_array( 'h', $all_sides ) ) {

					$counts = array_count_values( $all_sides );

					if ( $counts['h'] == 1 ) {

						$cell_class = ' half';

					} else if ( $counts['h'] == 2 ) {

						$cell_class = ' one';

					} else if ( $counts['h'] == 3 ) {

						$footer_on = false;
					}

				}

				$class = 'thz-footer-' . $layout . $cell_class;
				$cell  = 'table' == $layout ? 'cell' : 'block';

			}

			$reveal    = thz_get_option( 'footer_mx/r', 'donotreveal' );
			$res_class = _thz_responsive_classes( thz_get_option( 'fre', null ) );
			$revealc   = '';

			if ( $reveal == 'reveal' ) {
				$revealc = ' thz-reveal-footer';
				$html    .= '<div id="thz-footer-reveal" class="thz-footer-reveal"></div>';
			}
			$html .= '<div class="thz-footer-sections-holder' . $revealc . '">';

			if ( $footer_sections ) {
				$html .= $footer_sections;
			}
			
			$html .= thz_page_block('between_footer', false);
			
			if ( $footer_on ) {

				$html .= '<footer id="footer" class="footer' . thz_sanitize_class( $res_class ) . '"' . thz_sdata( 'footer', false ) . '>';

				if ( 'block' == $display_mode ) {

					$block_class = 'thz-footer-section-pageblock';

					$html .= thz_print_page_blocks( $page_blocks, $block_class, false );

				} else {

					$html .= '<div class="thz-container' . thz_contained( 'footer_mx/c', false, true ) . '">';
					$html .= '<div class="' . thz_sanitize_class( $class ) . '">';

					if ( 'h' != $left ) {
						$html .= '<div class="thz-footer-' . $cell . ' left">';
						$html .= thz_footer_content( 'l' );
						$html .= '</div>';
					}
					if ( 'h' != $middle ) {
						$html .= '<div class="thz-footer-' . $cell . ' middle">';
						$html .= thz_footer_content( 'm' );
						$html .= '</div>';
					}

					if ( 'h' != $right ) {
						$html .= '<div class="thz-footer-' . $cell . ' right">';
						$html .= thz_footer_content( 'r' );
						$html .= '</div>';
					}
					$html .= '</div>';
					$html .= '</div>';
					$html .= thz_video_bg_o( 'footer_boxstyle/background', false );

				}


				$html .= '</footer>';
			}
			
			$html .= '</div>';
		}
		
		$scrolltop = thz_get_option( 'scrolltop', 'enable' );
		if ( $scrolltop == 'enable' ) {
			$html .= '<a class="thz-to-top thz-scroll" data-duration="800" href="#thz-wrapper" title="';
			$html .= esc_html( 'Back to Top', 'creatus' );
			$html .= '"><i class="fa fa-angle-up"></i></a>';
		}


		echo $html;

	}
}

/**
 * Search overlay html
 *
 * @return string
 */
if ( ! function_exists( 'thz_print_search_overlay' ) ) {

	function thz_print_search_overlay() {

		$offcanvas_search = thz_get_option( 'hicmx/s', 'hide' );
		$inmenu_search    = thz_get_option( 'tm_elmx/si', 'show' );
		$inmmenu_search   = thz_get_option( 'mm_elmx/si', 'show' );

		if ( 'show' == $offcanvas_search || 'show' == $inmenu_search || 'show' == $inmmenu_search ) {

			$html = '<div class="thz-search-overlay">';
			$html .= '<a href="#" class="thz-close-search"><i class="thzicon thzicon-cross2"></i></a>';
			$html .= '<div class="thz-search-overlay-in">';
			$html .= '<form class="thz-search-form" method="get" action="' . esc_url( home_url( '/' ) ) . '">';
			$html .= '<div class="thz-search-form-inner">';
			$html .= '<input type="text" class="text-input" placeholder="' . __( 'Search...', 'creatus' ) . '" value="" name="s" />';
			$html .= '<input value="" class="search-button" type="submit" />';
			$html .= '</div>';
			$html .= '</form>';
			$html .= '</div>';
			$html .= '</div>';

			echo $html;
		}
	}

}

/**
 * Cookies consent html
 *
 * @return string
 */
if ( ! function_exists( 'thz_print_cookies_consent' ) ) {

	function thz_print_cookies_consent() {

		$active 		= thz_get_theme_option( 'cookcn/picked', 'inactive' );
		
		if ( 'active' == $active && (!isset($_COOKIE['ThzCookiesConsent']) || is_customize_preview() ) ) {
			
			$path 				= thz_theme_file_path('/template-parts/thz-cookies-consent.php');
			$cookies_consent 	= thz_render_view( $path,array());

			echo $cookies_consent;
		}
	}

}


/**
 * Body frame
 *
 * @return string
 */
if ( ! function_exists( 'thz_print_body_frame' ) ) {

	function thz_print_body_frame() {

		$body_frame = thz_get_option( 'bf/m', 'inactive' );

		if ( 'active' == $body_frame ) {

			$html = '<div class="thz-body-frame">';
			$html .= '<div class="thz-bf-top shadow"></div>';
			$html .= '<div class="thz-bf-right shadow"></div>';
			$html .= '<div class="thz-bf-bottom shadow"></div>';
			$html .= '<div class="thz-bf-left shadow"></div>';
			$html .= '<div class="thz-bf-top"></div>';
			$html .= '<div class="thz-bf-right"></div>';
			$html .= '<div class="thz-bf-bottom"></div>';
			$html .= '<div class="thz-bf-left"></div>';
			$html .= '</div>';

			echo $html;
		}
	}

}

/**
 * Full height calc
 * when body frame is on
 * @return string
 */
if ( ! function_exists( 'thz_body_frame_fh' ) ) {

	function thz_body_frame_fh( $total_p ) {

		$body_frame = thz_get_option( 'bf/m', 'inactive' );

		if ( 'active' == $body_frame ) {
			$bodyf_width = thz_get_option( 'bf/w', 20 );
			$total_p     = thz_full_rows() ? $total_p + $bodyf_width : $total_p + ( $bodyf_width * 2 );
		}

		return $total_p;
	}

}



/**
 * Get full height minus
 * top and bottom padding
*/
if ( ! function_exists( 'thz_full_height_calc' ) ) {
	
	function thz_full_height_calc( $padding, $vpheight, $element = 'section' ){

		$top_p 	= thz_akg('top',$padding);
		$bot_p 	= thz_akg('bottom',$padding);
					
		if('section' == $element){
			
			if( 'none' == $top_p || 'none' == $bot_p || null === $top_p || null === $bot_p  ){
				$columns_spacing	= thz_get_option('spacings/col',30);
				$section_spacing	= thz_get_option('spacings/sec',3);
				$single_vertical	= (float) $section_spacing * (float) $columns_spacing;
			}
						
			$top_p		= 'none' == $top_p ? $single_vertical : $top_p;
			$bot_p		= 'none' == $bot_p ? $single_vertical : $bot_p;
			$total_p 	= ( null === $top_p && null === $bot_p ) ? null : (float) $top_p + (float) $bot_p;		
		
			if($total_p === null){
				$total_p = $single_vertical * 2;			
			}
			
		}else{
			
			$total_p 	= (float) $top_p + (float) $bot_p;			
		}
		
		$total_p 	= thz_body_frame_fh($total_p);
		$calc 		= $total_p > 0 ? 'calc('.$vpheight.'vh - '.$total_p.'px)': $vpheight.'vh';
		
		return $calc;
	}
	
}



/**
 * Print site branding
 */
if ( ! function_exists( 'thz_print_branding' ) ) {

	function thz_print_branding( $echo = true ) {

		$branding = thz_current_year( thz_get_option( 'site_branding', 'Copyright &copy; {year}' ));

		if ( empty( $branding ) ) {
			return;
		}
		
		$allowed_html = array(
			'img'  => array(
				'id'     => array(),
				'src'    => array(),
				'width'  => array(),
				'height' => array(),
				'class'  => array(),
				'style'  => array(),
			),
			'a'    => array(
				'id'     => array(),
				'href'   => array(),
				'target' => array(),
				'class'  => array(),
				'style'  => array(),
			),
			'span' => array(
				'id'    => array(),
				'class' => array(),
				'style' => array(),
			),
			'br'   => array(
				'id'    => array(),
				'class' => array(),
				'style' => array(),
			),
			'div'  => array(
				'id'    => array(),
				'class' => array(),
				'style' => array(),
			)
		);

		$html = '<div class="thz-bradning-holder">' . wp_kses( $branding, $allowed_html ) . '</div>';

		if ( $echo ) {

			echo $html;

		} else {

			return $html;

		}
	}
}

/**
 * is_bbpress() does not work
 * https://bbpress.trac.wordpress.org/ticket/2996
 * modify this function to include check is_page( array(ID's) );
 * this function is used in 2 places and is inside the
 * class_exists('bbPress') check, so no need to check again
 */

if ( ! function_exists( 'thz_is_bbpress' ) ) {

	function thz_is_bbpress() {

		//if( is_bbpress() ){ // should be just this

		if ( class_exists( 'bbPress' ) ) {

			return true;

		} else {

			return false;
		}

		/*	sample with page ID's

		if( is_bbpress() || is_page(array(6551,6549))){

			return true;

		}else{

			return false;
		}

		*/

	}

}


/**
 * Box CSS print
 * @return string
 */
function thz_print_box_css( $cssarray ) {

	if ( empty( $cssarray ) ) {
		return;
	}

	if ( isset( $cssarray['css'] ) && ! empty( $cssarray['css'] ) ) {

		return $cssarray['css'];

	} else {

		$print_css = new Thz_Css_Generator();
		return $print_css->generate_css($cssarray);
	}

}


/**
 * Typography CSS print
 * @return string
 */

function thz_typo_css( $typo_array ) {
	
	$font_css         = thz_akg( 'css', $typo_array );
	$google_font_link = thz_akg( 'google_font_link', $typo_array );
	$typekitid        = thz_akg( 'typekitid', $typo_array );
	$subset           = thz_akg( 'subset', $typo_array );

	if ( ! empty( $font_css ) ) {

		$typo_print = $font_css;

	} else {

		$typo_print = thz_process_typo_css( $typo_array );

	}

	if ( ! empty( $google_font_link ) ) {

		Thz_Doc::set( 'googlefont', $google_font_link );
	}

	if ( ! empty( $typekitid ) ) {

		Thz_Doc::set( 'typekitids', $typekitid );
	}

	if ( $subset == 'fsq' ) {

		$family  = thz_akg( 'family', $typo_array );
		$variant = thz_akg( 'weight', $typo_array );
		$fsq_css = thz_get_fsq_css( $family, $variant );
		if ( $fsq_css ) {
			Thz_Doc::set( 'fontsquirell', $fsq_css,$variant);
		}

	}
	
	if ( $subset == 'ffk' ) {
		$family  	= thz_akg( 'family', $typo_array );
		$ffk_data	= thz_fontface_kit_data($family);
		
		if($ffk_data){
			Thz_Doc::set( 'fontfacekits',$ffk_data['css_file_uri'],true,$ffk_data['kitname'].'-ff-kit');
		}
	}

	return $typo_print;
}

/**
 * Typography CSS print process if not set
 * @return string
 */
function thz_process_typo_css( $typo_array, $add_to_doc = true ) {


	$font_family    = isset( $typo_array['family'] ) ? $typo_array['family'] : false;
	$font_style     = isset( $typo_array['style'] ) ? $typo_array['style'] : false;
	$font_weight    = isset( $typo_array['weight'] ) ? $typo_array['weight'] : false;
	$font_weight    = $font_weight == 'regular' ? 'normal' : $font_weight;
	$font_subset    = isset( $typo_array['subset'] ) ? $typo_array['subset'] : false;
	$font_transform = isset( $typo_array['transform'] ) ? $typo_array['transform'] : false;
	$font_align     = isset( $typo_array['align'] ) ? $typo_array['align'] : false;
	$font_size      = isset( $typo_array['size'] ) ? $typo_array['size'] : false;
	$font_color     = isset( $typo_array['color'] ) ? $typo_array['color'] : false;
	$line_height    = isset( $typo_array['line-height'] ) ? $typo_array['line-height'] : false;
	$font_type      = $font_subset ? 'google' : 'standard';

	if ( $font_subset == 'fsq' ) {

		$font_type   = 'fontsquirell';
		$font_family = $font_weight;
		$font_weight = 'normal';
		$font_style  = 'normal';
	}

	if ( $font_subset == 'ffk' ) {

		$font_type = 'fontfacekit';
	}

	if ( $font_subset == 'default' || $font_subset == 'all' ) {

		$font_type  = 'typekit';
		$font_style = 'normal';
	}

	$letter_spacing   = isset( $typo_array['spacing'] ) ? $typo_array['spacing'] : false;
	$google_font_link = isset( $typo_array['google_font_link'] ) ? $typo_array['google_font_link'] : false;
	$typekit_id       = isset( $typo_array['typekitid'] ) ? $typo_array['typekitid'] : false;
	$text_shadow      = isset( $typo_array['text-shadow'] ) ? $typo_array['text-shadow'] : false;

	$add_css = '';

	if ( $font_family && $font_family != 'default' ) {
		if ( $font_type == 'google' ) {

			$add_css    .= "font-family:'$font_family',sans-serif;";
			$font_style = false;

		} else if ( $font_type == 'typekit' ) {

			$add_css .= 'font-family:' . $font_family . ';';

		} else if ( $font_type == 'fontsquirell' ) {

			$add_css .= "font-family:'$font_family',sans-serif;";

		} else if ( $font_type == 'fontfacekit' ) {

			$add_css .= "font-family:'$font_family',sans-serif;";

		} else {
			$add_css .= 'font-family:' . $font_family . ';';
		}
	}

	if ( ! empty( $font_size ) ) {

		$add_css .= 'font-size:' . thz_property_unit( $font_size, 'px' ) . ';';

	}

	if ( $font_weight && $font_weight != 'default' ) {
		if ( thz_contains( $font_weight, 'italic' ) ) {

			$font_weight = explode( 'italic', $font_weight );
			$font_weight = ! empty( $font_weight[0] ) ? $font_weight[0] : 'normal';

			if ( $font_weight ) {
				$add_css .= 'font-weight:' . $font_weight . ';';
			}
			$font_style = 'italic';

		} else {

			$add_css .= 'font-weight:' . $font_weight . ';';
		}
	}

	$font_style  = $font_style == 'default' ? false : $font_style;
	
	if ( $font_style ) {
		$add_css .= 'font-style:' . $font_style . ';';
	}

	if ( isset( $line_height ) && ! empty( $line_height ) ) {
		$lh      = $line_height == 'normal' ? 'normal' : thz_property_unit( $line_height, '' );
		$add_css .= 'line-height:' . $lh . ';';

	}

	if ( $letter_spacing != '' && $letter_spacing != 'normal' ) {
		$add_css .= 'letter-spacing:' . thz_property_unit( $letter_spacing, 'px' ) . ';';
	}


	if ( ! empty( $font_color ) ) {
		$add_css .= 'color:' . $font_color . ';';

	}

	if ( $font_transform && $font_transform != 'default' ) {
		$add_css .= 'text-transform:' . $font_transform . ';';
	}

	if ( $font_align && $font_align != 'default' ) {
		$add_css .= 'text-align:' . $font_align . ';';
	}

	if ( $text_shadow ) {
		$add_css .= 'text-shadow:' . $text_shadow . ';';
	}


	if ( $add_to_doc && $font_type == 'google' && $google_font_link ) {
		Thz_Doc::set( 'googlefont', thz_typo_get_google_link($typo_array));
	}

	if ( $add_to_doc && $font_type == 'typekit' && $typekit_id ) {
		Thz_Doc::set( 'typekitids',$typekit_id);
	}


	if ( $add_to_doc && $font_type == 'fontsquirell' && $typekit_id ) {

		$fsq_css = thz_get_fsq_css( $font_family, $font_weight );
		if ( $fsq_css ) {
			Thz_Doc::set( 'fontsquirell', $fsq_css,$font_weight);
		}

	}

	if ( $add_css != '' ) {
		return $add_css;
	}

}


/**
 * Build google font link from typography array
 * @return string
 */
function thz_typo_get_google_link( $typo_array ) {

	if ( ! isset( $typo_array['family'], $typo_array['weight'], $typo_array['subset'] ) ) {
		return false;
	}

	$other_subsets = array( 'default', 'all', 'fsq', 'ffk' );

	if ( in_array( $typo_array['subset'], $other_subsets ) ) {

		return false;
	}

	if ( $typo_array['family'] && $typo_array['weight'] && $typo_array['subset'] ) {

		return $typo_array['family'] . ':' . $typo_array['weight'] . '&subset=' . $typo_array['subset'];

	}

	return false;
}


/**
 * Get typekit ID for typography option
 * @return string
 */
function thz_typo_get_typekit_id( $typo_array ) {

	if ( ! isset( $typo_array['family'], $typo_array['weight'], $typo_array['subset'] ) ) {
		return false;
	}

	if ( $typo_array['subset'] == 'default' || $typo_array['subset'] == 'all' ) {

		$imported   = get_option( 'thz_imported_fonts' );
		$slug       = thz_typekit_slug( $typo_array['family'] );
		$font_kitid = thz_akg( 'tykfonts/fonts_data/' . $slug . '/kitid', $imported, false );

		if ( $font_kitid ) {

			return $font_kitid;
		}

	}

	return false;
}

/**
 * Replace multiple color palette strings with color value
 * @return string
 */
function thz_replace_palette_colors( $string, $palette = false ) {

	if ( strpos( $string, 'color_' ) !== false ) {

		if ( ! $palette ) {

			$palette = thz_get_theme_option( 'theme_palette', array(
				'color_1' => '#039bf4',
				'color_2' => '#454545',
				'color_3' => '#8f8f8f',
				'color_4' => '#eaeaea',
				'color_5' => '#fafafa',
			) );

			$palette = thz_array_insert( $palette, thz_palette_shades(), 1 );

		}

		foreach ( $palette as $key => $val ) {

			if ( strpos( $key, 'darker' ) !== false or strpos( $key, 'lighter' ) !== false or strpos( $key, 'contrast' ) !== false ) {

				$data    = explode( '_', $key );
				$shade   = $data[1];
				$percent = isset( $data[2] ) ? $data[2] : null;
				$color1  = new Thz_Color($palette['color_1']);

				if ( $shade == 'darker' ) {

					$val = $color1->darker( $percent );

				} else if ( $shade == 'lighter' ) {

					$val = $color1->lighter( $percent );

				} else if ( $shade == 'contrast' ) {

					$val = $color1->isLight( $palette['color_1'] ) ? '#000000' : '#ffffff';
				}

			}

			$string = preg_replace( '/\b' . $key . '\b/', $val, $string );
		}

	}

	return $string;
}

/**
 * Create palette shades based on color_1 value
 * @return array
 */
if ( ! function_exists( 'thz_palette_shades' ) ) {

	function thz_palette_shades( $color_1 = false ) {

		if ( ! $color_1 ) {
			$color_1 = thz_get_theme_option( 'theme_palette/color_1', '#039bf4' );
		}
		$thz_color 	= new Thz_Color($color_1);
		$contrast  = $thz_color->isLight( $color_1 ) ? '#000000' : '#ffffff';


		$shades = array(

			'color_darker_5'   => $thz_color->darker( 5 ),
			'color_darker_10'  => $thz_color->darker( 10 ),
			'color_darker_15'  => $thz_color->darker( 15 ),
			'color_darker_20'  => $thz_color->darker( 20 ),
			'color_darker_25'  => $thz_color->darker( 25 ),
			'color_darker_30'  => $thz_color->darker( 30 ),
			'color_darker_35'  => $thz_color->darker( 35 ),
			'color_lighter_5'  => $thz_color->lighter( 5 ),
			'color_lighter_10' => $thz_color->lighter( 10 ),
			'color_lighter_15' => $thz_color->lighter( 15 ),
			'color_lighter_20' => $thz_color->lighter( 20 ),
			'color_lighter_25' => $thz_color->lighter( 25 ),
			'color_lighter_30' => $thz_color->lighter( 30 ),
			'color_lighter_35' => $thz_color->lighter( 35 ),
			'color_contrast'   => $contrast,
		);

		return $shades;

	}
}


/**
 * Metro sequence maker
 * @return array
 */
if ( ! function_exists( 'thz_metro_sequence_maker' ) ) {

	function thz_metro_sequence_maker( $sequence, $get_array = false ) {

		$sequences = array(

			// 2 columns, 3 items
			1  => array(
				'count' => 3,
				'items' => array( 'landscape', 'small', 'small' )

			),

			// 2 columns, 3 items
			2  => array(
				'count' => 6,
				'items' => array( 'portrait', 'small', 'small', 'small', 'portrait', 'small' )

			),

			// 3 columns, 4 items
			3  => array(
				'count' => 8,
				'items' => array( 'landscape', 'portrait', 'small', 'small', 'portrait', 'landscape', 'small', 'small' )

			),

			// 3 columns, 4 items
			4  => array(
				'count' => 4,
				'items' => array( 'small', 'landscape', 'landscape', 'small' )

			),


			// 6 columns, 9 items
			5  => array(

				'count' => 9,
				'items' => array( 'small', 'small', 'double', 'small', 'small', 'double', 'double', 'small', 'small' )

			),

			// 6 columns, 9 items
			6  => array(

				'count' => 9,
				'items' => array( 'double', 'small', 'small', 'double', 'double', 'small', 'small', 'small', 'small' )

			),

			// 6 columns, 9 items
			7  => array(
				'count' => 10,
				'items' => array(
					'double',
					'landscape',
					'double',
					'small',
					'small',
					'small',
					'small',
					'landscape',
					'small',
					'small'
				)

			),

			// 6 columns, 10 items
			8  => array(
				'count' => 10,
				'items' => array(
					'portrait',
					'small',
					'landscape',
					'small',
					'portrait',
					'small',
					'double',
					'landscape',
					'landscape',
					'small'
				)

			),

			// 6 columns, 10 items
			9  => array(
				'count' => 10,
				//'items' => array('portrait','small','double','small','portrait','small','landscape','landscape','landscape','small')
				'items' => array(
					'small',
					'portrait',
					'double',
					'portrait',
					'small',
					'small',
					'small',
					'landscape',
					'landscape',
					'landscape'
				)

			),

			// 6 columns, 6 items
			10 => array(
				'count' => 6,
				'items' => array( 'double', 'small', 'small', 'double', 'small', 'small' )

			),

			// 4 columns, 5/10 items
			11 => array(
				'count' => 10,
				'items' => array(
					'double',
					'small',
					'small',
					'small',
					'small',
					'small',
					'small',
					'double',
					'small',
					'small'
				)

			),

			// 3 columns, 6 items
			12 => array(
				'count' => 6,
				'items' => array(
					'double',
					'small',
					'small',
					'small',
					'small',
					'small',
					'small',
					'double',
					'small',
					'small',
					'small'
				)

			),


			// 4 columns, 6 items
			13 => array(
				'count' => 6,
				'items' => array( 'double', 'small', 'small', 'double', 'small', 'small' )

			),

			// 3 columns, 6 items
			14 => array(
				'count' => 5,
				'items' => array( 'small', 'double', 'small', 'small', 'small' )

			),

			// 3 columns, 6 items
			15 => array(
				'count' => 6,
				'items' => array( 'double', 'small', 'small', 'small', 'double', 'small' )

			),

			// 3 columns, 4 items
			16  => array(
				'count' => 4,
				'items' => array( 'portrait', 'small', 'portrait', 'small')

			),

		);

		if ( $get_array ) {
			return $sequences;
		}

		return $sequences[ $sequence ];
	}

}

/**
 * Build option based on metro sequences
 * @return option array
 */
function _thz_metro_sequence_option() {

	$sequences = thz_metro_sequence_maker( false, true );

	$option = array(

		'label' => __( 'Select metro layout', 'creatus' ),
		'type'  => 'image-picker',
		'value' => 1,
		'desc'  => esc_html__( 'Select desired metro layout. See help for more info', 'creatus' ),
		'help'  => esc_html__( 'Hover over layout images and use suggested column/items combo for perfect layouts. Insert the items in assigned items option and columns in "Grid settings" Columns option. Make sure that Isotope mode in grid settings is "Packery"', 'creatus' ),

		'choices' => array()


	);

	foreach ( $sequences as $key => $choice ) {

		$option['choices'][ $key ] = array(
			'small' => array(
				'height' => 38,
				'src'    => thz_theme_file_uri( '/inc/thzframework/admin/images/metro' . $key . '.jpg' )
			),
			'large' => thz_theme_file_uri( '/inc/thzframework/admin/images/metro' . $key . '.jpg' )
		);
		unset( $choice );
	}

	unset( $sequences );

	return $option;

}

/**
 * Google fonts data
 * @return arrays data or list
 */
function thz_google_fonts_data( $print_list = false ) {

	$google_fonts_data = get_option( 'thz_google_fonts_data', false );
	$google_fonts_list = get_option( 'thz_google_fonts_list', false );
	$ttl               = 7 * DAY_IN_SECONDS;

	if ( false === $google_fonts_data || ( $google_fonts_data['last_update'] + $ttl < time() ) ) {

		$google_fonts_data = array();
		$google_fonts_list = array();

		$google_fonts_json = fw_get_google_fonts_v2();

		// falback in case fw is not returning google fonts json
		if ( empty( $google_fonts_json ) ) {

			global $wp_filesystem;
			if ( empty( $wp_filesystem ) ) {
				require_once( ABSPATH . '/wp-admin/includes/file.php' );
				WP_Filesystem();
			}
			$google_fonts_json = $wp_filesystem->get_contents( thz_theme_file_path( '/inc/includes/option-types/thz-typography/thztypo/google.fonts.json' ) );
		}


		$fonts = json_decode( $google_fonts_json, true );


		foreach ( $fonts['items'] as $font ) {

			$font_name = $font['family'];
			$handle    = 'thz-ff-g-' . strtolower( str_replace( ' ', '-', $font_name ) );

			foreach ( $font['variants'] as $variant ) {

				$vhandle = $handle . '-' . $variant;
				$style   = 'normal';
				$weight  = $variant == 'regular' ? 'normal' : $variant;

				if ( strpos( $variant, 'italic' ) !== false ) {
					$style      = 'italic';
					$weight_arr = explode( 'italic', $variant );
					$weight     = ! empty( $weight_arr[0] ) ? $weight_arr[0] : 'normal';
				}


				$font_weight_print = 'font-weight:' . $weight . '!important;';
				$font_style_print  = 'font-style:' . $style . '!important;';

				$css_print = '.' . $vhandle . '{';
				$css_print .= "font-family:'" . $font_name . "',sans-serif!important;";
				$css_print .= $font_weight_print;
				$css_print .= $font_style_print;
				$css_print .= '}';

				$list = '<option value="' . $vhandle . '" data-link="' . $font_name . ':' . $variant . '&subset=latin" data-family="' . $font_name . '"';
				$list .= ' data-font="' . $font_weight_print . $font_style_print . '">';
				$list .= $font_name . '-' . $variant;
				$list .= '</option>';

				$google_fonts_data['fonts'][ $vhandle ] = array(
					'css'  => $css_print,
					'link' => $font_name . ':' . $variant . '&subset=latin',

				);

				$google_fonts_list['list'][ $vhandle ] = $list;

			}

		}

		unset( $fonts, $font );

		update_option( 'thz_google_fonts_data', array(
			'last_update' => time() - $ttl + MINUTE_IN_SECONDS,
			'fonts'       => $google_fonts_data['fonts'],
		), false );


		update_option( 'thz_google_fonts_list', array(
			'last_update' => time() - $ttl + MINUTE_IN_SECONDS,
			'list'        => $google_fonts_list['list']
		), false );

	}

	if ( $print_list ) {

		return implode( '', $google_fonts_list['list'] );

	} else {

		return $google_fonts_data['fonts'];
	}

}


/**
 * Print button CSS and add google font class CSS in head if exists
 * @return string
 * $btn_data array
 * $css_handle class name replacemant, can be element class or ID (.thz-404-button)
 */
function thz_print_button_css( $btn_data, $css_handle ) {


	$add_css = '';
	//load button google fonts
	$gfonts = thz_akg( 'gfonts', $btn_data, array() );
	if ( isset( $gfonts ) && ! empty( $gfonts ) ) {
		foreach ( $gfonts as $add_g_font ) {
			Thz_Doc::set( 'googleclassname', $add_g_font );
		}

	}


	$button_css = thz_akg( 'css', $btn_data, null );
	if ( $button_css != '' ) {

		$button_json  = json_decode( thz_akg( 'json', $btn_data, null ), true );
		$custom_class = $button_json['customClass'];
		$button_css   = str_replace( '.' . $custom_class, $css_handle . ' .' . $custom_class, $button_css );

		$add_css .= $button_css;
	}


	if ( $add_css != '' ) {
		return $add_css;
	}
}

/**
 * Get multi side ID
 * @return string
 */
function thz_multisite_id() {

	$siteid = 1;
	if ( is_multisite() ) {
		$get_site = get_blog_details();
		$siteid   = $get_site->blog_id;
	}
	$siteid = ( is_multisite() && $siteid > 1 ) ? '-site-' . $siteid : null;

	return $siteid;

}


/**
 * Get global page ID
 * @return string
 */
function thz_global_page_id() {

	global $post;
	$siteid = thz_multisite_id();


	if ( 'page' == get_option( 'show_on_front' ) && is_front_page() && ! is_home() ) {
		$id = 'frontpage';

		return $siteid . $id;
	}

	if ( 'posts' == get_option( 'show_on_front' ) && is_home() && is_front_page() ) {
		$id = 'bloghomepage';

		return $siteid . $id;
	}

	if ( 'page' == get_option( 'show_on_front' ) && is_home() && ! is_front_page() ) {
		$id = 'postspage';

		return $siteid . $id;
	}

	$id = ( is_singular() ) ? $post->ID : false;

	if ( $id ) {

		return $siteid . $id;
	}

	if ( is_tax() || is_category() ) {

		$tax = is_tax() ? get_queried_object()->taxonomy : 'category';
		$id  = $tax . get_queried_object_id();

	} else if ( class_exists( 'WooCommerce' ) && ! is_single() && ! is_page() ) {

		if ( ( is_shop() || is_cart() || is_checkout() || is_account_page() ) ) {

			$id = is_shop() ? wc_get_page_id( 'shop' ) : get_queried_object_id();

		}

	}

	if ( is_404() ) {

		$id = '404page';
	}

	if ( is_search() ) {

		$id = 'searchpage';
	}

	if ( function_exists( 'bp_is_my_profile' ) && bp_is_my_profile() ) {

		$id = 'bp_page';
	}

	if ( is_author() ) {

		$id = 'author' . get_queried_object_id();
	}

	if ( $id === 0 || $id == '' ) {
		$id = get_queried_object_id() != 0 ? get_queried_object_id() : 'global';
	}


	return $siteid . $id;
}


/**
 * Panel data
 * @return array
 */
function thz_panel( $panel ) {

	$panel_side = thz_get_theme_option( $panel );

	if( !is_array( $panel_side ) || empty( $panel_side ) ){
		return false;
	}

	if ( $panel_side['json'] != '[]' && $panel_side['json'] != '' ) {

		//https://regex101.com/r/S92yQ2/2
		if ( $panel == 'side_panel' ) {
			$re = '/"panelspeed":"(.*?)".*panelposition":"(.*?)".*panelwidth":"(.*?)"/';
		} else {
			$re = '/"panelspeed":"(.*?)"/';
		}

		$cmx = '/"cmx":{(.*?)}/';

		$panel_options = array();

		preg_match_all( $re, $panel_side['json'], $matches );
		preg_match_all( $cmx, $panel_side['json'], $matches2 );


		$panel_options['speed'] = $matches[1][0];

		$cmx_json             = '{' . $matches2[1][1] . '}';
		$panel_options['cmx'] = json_decode( $cmx_json, true );

		if ( $panel == 'side_panel' ) {

			$panel_options['direction'] = $matches[2][0];
			$panel_options['width']     = $matches[3][0];

		}

		return $panel_options;

	} else {

		return false;

	}
}


/**
 * Structured data
 * @return string
 */
function thz_sdata( $type, $echo = true, $meta = false, $data = false ) {

	$sdata_active = thz_get_theme_option( 'sdata', 'active' );

	if ( $sdata_active == 'inactive' ) {
		return;
	}

	$structured_data = '';


	if ( ! $meta ) {

		// http://w3c.github.io/html-aria/#docconformance
		$attr = array();

		switch ( $type ) {
			case 'body':
				$attr['itemscope'] = 'itemscope';
				$attr['itemtype']  = 'https://schema.org/WebPage';
				break;

			case 'header':
				$attr['itemscope'] = 'itemscope';
				$attr['itemtype']  = 'https://schema.org/WPHeader';
				break;

			case 'nav':
				$attr['itemscope'] = 'itemscope';
				$attr['itemtype']  = 'https://schema.org/SiteNavigationElement';
				break;

			case 'main':
				$attr['itemprop'] = 'mainContentOfPage';
				break;

			case 'mainentity':
				$attr['itemprop'] = 'mainEntityOfPage';
				break;

			case 'search':
				$attr['role']     = 'main';
				$attr['itemprop'] = 'mainContentOfPage';
				$attr['itemtype'] = 'https://schema.org/SearchResultsPage';
				break;

			case 'sidebar':
				$attr['role']      = 'complementary';
				$attr['itemscope'] = 'itemscope';
				$attr['itemtype']  = 'https://schema.org/WPSideBar';
				break;

			case 'footer':
				$attr['itemscope'] = 'itemscope';
				$attr['itemtype']  = 'https://schema.org/WPFooter';
				break;

			case 'blog':
				$attr['itemscope'] = 'itemscope';
				$attr['itemtype']  = 'https://schema.org/Blog';
				break;

			case 'blog_post':
				$attr['itemscope'] = 'itemscope';
				$attr['itemtype']  = 'https://schema.org/BlogPosting';
				break;

			case 'image':
				$attr['itemprop'] = 'image';
				break;

			case 'video':
				$attr['itemprop'] = 'video';
				$attr['itemtype'] = 'https://schema.org/VideoObject';
				break;

			case 'audio':
				$attr['itemscope'] = 'itemscope';
				$attr['itemtype']  = 'https://schema.org/AudioObject';
				break;

			case 'name':
				$attr['itemprop'] = 'name';
				break;

			case 'author':
				$attr['itemprop']  = 'author';
				$attr['itemscope'] = 'itemscope';
				$attr['itemtype']  = 'https://schema.org/Person';
				break;

			case 'person':
				$attr['itemscope'] = 'itemscope';
				$attr['itemtype']  = 'https://schema.org/Person';
				break;

			case 'url':
				$attr['itemprop'] = 'url';
				break;

			case 'email':
				$attr['itemprop'] = 'email';
				break;

			case 'headline':
				$attr['itemprop'] = 'headline';
				break;

		}

		foreach ( $attr as $key => $value ) {
			$structured_data .= ' ' . $key . '="' . $value . '"';
		}
	}


	if ( $type == 'post' && $meta ) {

		$thumbnail_id = get_post_thumbnail_id();
		$comments     = get_comment_count( get_the_ID() );

		// type
		$structured_data .= '<span class="thz-structured-data" itemscope itemtype="https://schema.org/BlogPosting">';
		$structured_data .= '<meta itemprop="headline" content="' . esc_attr( get_the_title() ) . '" />';
		$structured_data .= '<meta itemscope itemprop="mainEntityOfPage" itemType="https://schema.org/WebPage" itemid="' . esc_url( get_the_permalink() ) . '" />';
		$structured_data .= '<meta itemprop="url" content="' . esc_url( get_the_permalink() ) . '" />';

		// image
		if ( $thumbnail_id ) {


			$img_data = wp_get_attachment_image_src( $thumbnail_id, "full" );

			$src = $img_data[0];
			$w   = $img_data[1];
			$h   = $img_data[2];

			$structured_data .= '<span itemprop="image" itemscope itemtype="https://schema.org/ImageObject">';
			$structured_data .= '<meta itemprop="url" content="' . esc_url( $src ) . '" />';
			$structured_data .= '<meta itemprop="width" content="' . esc_attr( $w ) . '" />';
			$structured_data .= '<meta itemprop="height" content="' . esc_attr( $h ) . '" />';
			$structured_data .= '</span>';

		}
		// author and description
		$structured_data .= '<meta itemprop="author" content="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '" />';
		$structured_data .= '<meta itemprop="description" content="' . thz_intro_text( 'chars', 170 ) . '" />';
		$structured_data .= '<meta itemprop="datePublished" content="' . esc_attr( get_the_date( 'c' ) ) . '" />';
		$structured_data .= '<meta itemprop="dateModified" content="' . esc_attr( get_the_modified_date( 'c', get_the_ID() ) ) . '" />';

		// comments
		$structured_data .= '<span itemprop="interactionStatistic" itemscope itemtype="https://schema.org/InteractionCounter">';
		$structured_data .= '<meta itemprop="interactionType" content="https://schema.org/CommentAction" />';
		$structured_data .= '<meta itemprop="userInteractionCount" content="' . $comments['approved'] . '" />';
		$structured_data .= '</span>';

		// organization
		$structured_data .= '<span itemprop="publisher" itemscope itemtype="https://schema.org/Organization">';
		$structured_data .= '<span itemprop="logo" itemscope itemtype="https://schema.org/ImageObject">';
		$structured_data .= '<meta itemprop="url" content="' . _thz_logo_image() . '" />';
		$structured_data .= '</span>';
		$structured_data .= '<meta itemprop="name" content="' . esc_attr( get_bloginfo( 'name' ) ) . '" />';
		$structured_data .= '</span>';
		$structured_data .= '</span>';

	}


	if ( $type == 'page' && $meta ) {

		$structured_data .= '<span class="thz-structured-data">';
		$structured_data .= '<meta itemprop="headline" content="' . esc_attr( get_the_title() ) . '" />';
		$structured_data .= '<meta itemprop="url" content="' . esc_url( get_the_permalink() ) . '" />';
		$structured_data .= '<meta itemprop="author" content="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '" />';
		$structured_data .= '<meta itemprop="datePublished" content="' . esc_attr( get_the_date( 'c' ) ) . '"/>';
		$structured_data .= '<meta itemprop="dateModified" content="' . esc_attr( get_the_modified_date( 'c', get_the_ID() ) ) . '" />';
		$structured_data .= '</span>';

	}


	if ( $type == 'project' && $meta ) {

		$structured_data .= '<span class="thz-structured-data" itemscope itemtype="https://schema.org/CreativeWork">';
		$structured_data .= '<meta itemprop="headline" content="' . esc_attr( get_the_title() ) . '" />';
		$structured_data .= '<meta itemprop="url" content="' . esc_url( get_the_permalink() ) . '" />';
		$structured_data .= '<meta itemprop="description" content="' . thz_intro_text( 'chars', 170 ) . '" />';
		$structured_data .= '</span>';

	}


	if ( $type == 'event' && $meta && $data ) {

		$thumbnail_id = get_post_thumbnail_id();

		$structured_data .= '<span class="thz-structured-data" itemscope itemtype="https://schema.org/Event">';
		$structured_data .= '<meta itemprop="name" content="' . esc_attr( get_the_title() ) . '" />';
		$structured_data .= '<meta itemprop="startDate" content="' . $data[0] . '" />';
		$structured_data .= '<meta itemprop="endDate" content="' . $data[1] . '" />';
		$structured_data .= '<meta itemprop="url" content="' . esc_url( get_the_permalink() ) . '" />';
		$structured_data .= '<meta itemprop="description" content="' . thz_intro_text( 'chars', 170 ) . '" />';

		$structured_data .= '<span itemprop="location" itemscope itemtype="https://schema.org/Place">';
		$structured_data .= '<meta itemprop="name" content="' . $data[2]['venue'] . '" />';

		$structured_data .= '<span itemprop="address" itemscope itemtype="https://schema.org/PostalAddress">';
		$structured_data .= '<meta itemprop="streetAddress" content="' . $data[2]['address'] . '" />';
		$structured_data .= '<meta itemprop="addressLocality" content="' . $data[2]['city'] . '" />';
		$structured_data .= '<meta itemprop="addressRegion" content="' . $data[2]['country'] . '" />';
		$structured_data .= '<meta itemprop="postalCode" content="' . $data[2]['zip'] . '" />';
		$structured_data .= '</span>';

		$structured_data .= '</span>';

		// image
		if ( $thumbnail_id ) {

			$img_data = wp_get_attachment_image_src( $thumbnail_id, "full" );

			$src = $img_data[0];
			$w   = $img_data[1];
			$h   = $img_data[2];

			$structured_data .= '<span itemprop="image" itemscope itemtype="https://schema.org/ImageObject">';
			$structured_data .= '<meta itemprop="url" content="' . esc_url( $src ) . '" />';
			$structured_data .= '<meta itemprop="width" content="' . esc_attr( $w ) . '" />';
			$structured_data .= '<meta itemprop="height" content="' . esc_attr( $h ) . '" />';
			$structured_data .= '</span>';

		}

		$event_price = thz_get_post_option( 'ev_price', array() );

		if ( $event_price != '' ) {
			$structured_data .= '<span itemprop="offers" itemscope itemtype="https://schema.org/Offer">';
			$structured_data .= '<meta itemprop="price" content="' . $event_price['c'] . '" />';
			$structured_data .= '<meta itemprop="url" content="' . $event_price['l'] . '" />';
			$structured_data .= '</span>';
		}


		$structured_data .= '</span>';

	}

	if ( $echo ) {

		echo $structured_data;

	} else {

		return $structured_data;

	}


}

/**
 * Get post type taxonomies
 * @$posts string , array or object
 * @$output objects or names
 * @ref stack How to get all taxonomies of a post type?
 * @return array
 */
function thz_get_post_taxonomies( $posts, $output = 'objects' ) {

	$taxonomies = get_object_taxonomies( $posts, $output );

	return (array) $taxonomies;
}

/**
 * Tax query array
 * @return array
 */
if ( ! function_exists( 'thz_post_tax_query' ) ) {

	function thz_post_tax_query( $categories = array(), $tags = array(), $types = array( 'post' ), $exclude_post_formats = false ) {

		$post_tax_query  = array();
		$exclude_formats = array();

		if ( ! empty( $categories ) || ! empty( $tags ) ) {

			$tax_query = array(
				'relation' => 'OR',
			);

			$taxonomies = thz_get_post_taxonomies( $types, 'objects' );

			if ( ! empty( $taxonomies ) ) {
				foreach ( $taxonomies as $tax ) {
					if ( ! $tax->hierarchical ) {
						continue;
					}
					$tax_query[] = array(
						'taxonomy' => $tax->name,
						'field'    => 'term_id',
						'terms'    => $categories
					);

					unset( $tax );
				}
				unset( $taxonomies );
			}


			// by tag
			if ( ! empty( $tags ) && in_array( 'post', $types ) ) {

				$tax_query[] = array(
					'taxonomy' => 'post_tag',
					'field'    => 'term_id',
					'terms'    => $tags
				);
			}

			if ( ! empty( $tags ) && in_array( 'product', $types ) ) {
				$tax_query[] = array(
					'taxonomy' => 'product_tag',
					'field'    => 'term_id',
					'terms'    => $tags
				);
			}


			if ( ! empty( $tags ) && in_array( 'fw-portfolio', $types ) ) {
				$tax_query[] = array(
					'taxonomy' => 'fw-portfolio-tag',
					'field'    => 'term_id',
					'terms'    => $tags
				);
			}


			$post_tax_query    [] = $tax_query;
		}

		if ( $exclude_post_formats ) {

			$exclude_formats = array(

				'relation' => 'AND',
				array(
					'taxonomy' => 'post_format',
					'operator' => 'NOT EXISTS',
				)
			);

			$post_tax_query [] = $exclude_formats;
		}

		return $post_tax_query;

	}
}


/**
 *  Get tax objects
 */
function thz_post_tax_objects( $id ) {

	$post_terms = false;

	$args = array(
		'public' => true,
	);

	$tax_names = get_taxonomies( $args );

	foreach ( $tax_names as $tax ) {

		if ( get_the_terms( $id, $tax ) ) {

			$post_terms = get_the_terms( $id, $tax );

			break;
		}

	}

	if ( $post_terms === false ) {
		return;
	}

	$tax_object = array();
	foreach ( $post_terms as $term ) {

		$tax_object[ $term->name ] = $term;

	}
	unset( $post_terms );

	return $tax_object;

}

/**
 * Get term by ID
 * @return object
 */
if ( ! function_exists( 'thz_get_term_by_id' ) ) {

	function thz_get_term_by_id( $term_id, $output = OBJECT, $filter = 'raw' ) {
		
		if( !is_numeric( $term_id ) ){
			return false;
		}
		
		global $wpdb;

		$_tax     = $wpdb->get_row( $wpdb->prepare( "SELECT t.* FROM $wpdb->term_taxonomy AS t WHERE t.term_id = %s LIMIT 1", $term_id ) );
		$taxonomy = $_tax->taxonomy;

		return get_term( $term_id, $taxonomy, $output, $filter );

	}
}


/**
 * Tax query
 * @return array
 */
if ( ! function_exists( 'thz_query_taxonomies' ) ) {

	function thz_query_taxonomies( $tax_ids, $query ) {

		if ( ! empty( $tax_ids ) ) {

			$categories = array();

			foreach ( $tax_ids as $tax ) {

				$tax_data = thz_get_term_by_id( $tax );
				if ( $tax_data ) {
					$categories[] = $tax_data;
				}
			}

			return $categories;

		} else {

			$all_posts = $query->posts;
			$all_cats  = array();

			foreach ( $all_posts as $thz_post ) {

				$post_categories = thz_post_tax_objects( $thz_post->ID );

				if ( empty( $post_categories ) ) {
					continue;
				}

				foreach ( $post_categories as $cat ) {
					$all_cats[ $cat->name ] = $cat;
				}

				unset( $post_categories );

			}
			unset( $all_posts );

			wp_reset_postdata();

			return $all_cats;

		}


	}
}

/**
 * Woo buttons
 * @return string
 */
function _thz_woo_buttons( $product, $atts ) {

	$btns_show = thz_akg( 'cart_btn', $atts, 'both' );
	$html      = '';

	if ( $btns_show != 'hide' ) {

		$label_space = $btns_show == 'both' ? ' thz-ml-10' : '';
		$cartajax    = thz_woo_product_type( $product ) == 'simple' ? ' ajax_add_to_cart' : '';
		$item_badge  = '';

		global $woocommerce;

		switch ( thz_woo_product_type( $product ) ) {
			case "variable" :
				$link       = apply_filters( 'variable_add_to_cart_url', get_permalink( thz_woo_get_id( $product ) ) );
				$label      = apply_filters( 'variable_add_to_cart_text', esc_html__( 'Select Options', 'creatus' ) );
				$icon_class = 'thzicon thzicon-plus';
				break;
			case "grouped" :
				$link       = apply_filters( 'grouped_add_to_cart_url', get_permalink( thz_woo_get_id( $product ) ) );
				$label      = apply_filters( 'grouped_add_to_cart_text', esc_html__( 'View Options', 'creatus' ) );
				$icon_class = 'thzicon thzicon-search3';
				break;
			case "external" :
				$link       = apply_filters( 'external_add_to_cart_url', get_permalink( thz_woo_get_id( $product ) ) );
				$label      = apply_filters( 'external_add_to_cart_text', esc_html__( 'More Info', 'creatus' ) );
				$icon_class = 'thzicon thzicon-circle-plus';
				break;
			default :
				$link       = apply_filters( 'add_to_cart_url', esc_url( $product->add_to_cart_url() ) );
				$label      = apply_filters( 'add_to_cart_text', esc_html__( 'Add to Cart', 'creatus' ) );
				$icon_class = thz_get_option( 'wooicons/mc', 'thzicon thzicon-shopping-cart2' );
				break;
		}


		if ( thz_woo_in_cart( $product->get_id() ) ) {

			$label = esc_html__( 'View cart', 'creatus' );

		}
		if ( ! $product->is_in_stock() ) {
			$label = esc_html__( 'More Info', 'creatus' );
		}

		$tip       = $btns_show == 'icon' ? ' title="' . $label . '"' : '';
		$tip_class = $btns_show == 'icon' ? ' thz-tips' : '';

		if ( thz_woo_product_type( $product ) && ! thz_woo_in_cart( thz_woo_get_id( $product ) ) ) {

			$eclass = 'thz-woo-item-add-to-cart thz-woo-item-cart-buttons add_to_cart_button product_type_' . thz_woo_product_type( $product ) . $cartajax . '';

			$add_to_cart = '<a href="' . $link . '" rel="nofollow" data-product_id="' . thz_woo_get_id( $product ) . '"';
			$add_to_cart .= ' class="' . thz_sanitize_class( $eclass ) . '">';
			if ( $btns_show == 'icon' || $btns_show == 'both' ) {
				$add_to_cart .= '<i class="' . $icon_class . '"></i>';
			}
			if ( $btns_show == 'label' || $btns_show == 'both' ) {
				$add_to_cart .= '<span class="thz-woo-item-cart-label' . $label_space . '">';
				$add_to_cart .= $label;
				$add_to_cart .= '</span>';
			}
			$add_to_cart .= '</a>';

		} else {
			$add_to_cart = '';
		}

		if ( ! $product->is_in_stock() ) {

			$item_badge .= '<span class="thz-woo-item-badge thz-woo-item-out-of-stock">';
			$item_badge .= esc_html__( 'Out of stock!', 'creatus' );
			$item_badge .= '</span>';

			$link        = apply_filters( 'out_of_stock_add_to_cart_url', get_permalink( thz_woo_get_id( $product ) ) );
			$add_to_cart = '<a href="' . $link . '" rel="nofollow"';
			$add_to_cart .= ' class="thz-woo-item-add-to-cart thz-woo-item-cart-buttons">';
			if ( $btns_show == 'icon' || $btns_show == 'both' ) {
				$add_to_cart .= '<i class="thzicon thzicon-circle-plus"></i>';
			}
			if ( $btns_show == 'label' || $btns_show == 'both' ) {
				$add_to_cart .= '<span class="thz-woo-item-cart-label' . $label_space . '">';
				$add_to_cart .= esc_html__( 'More Info', 'creatus' );
				$add_to_cart .= '</span>';
			}
			$add_to_cart .= '</a>';
		}

		if ( $product->is_on_sale() && $product->is_in_stock() ) {

			$item_badge .= '<span class="thz-woo-item-badge thz-woo-item-on-sale">';
			$item_badge .= esc_html__( 'Sale!', 'creatus' );
			$item_badge .= '</span>';
		}

		$view_cart = '<a class="thz-woo-item-view-cart thz-woo-item-cart-buttons"';
		$view_cart .= ' href="' . wc_get_cart_url() . '">';
		if ( $btns_show == 'icon' || $btns_show == 'both' ) {
			$view_cart .= '<i class="thzicon thzicon-check"></i>';
		}
		if ( $btns_show == 'label' || $btns_show == 'both' ) {
			$view_cart .= '<span class="thz-woo-item-cart-label' . $label_space . '">';
			$view_cart .= esc_html__( 'View cart', 'creatus' );
			$view_cart .= '</span>';
		}
		$view_cart .= '</a>';

		//$html .= $item_badge;
		$html .= '<div class="thz-posts-woo-buttons' . $tip_class . '"' . $tip . '>';
		$html .= $add_to_cart;
		$html .= $view_cart;
		$html .= '</div>';

	}

	return $html;

}

/**
 * Build list
 * @return string
 */
function thz_build_list( $items, $tag = 'ul', $id, $class = 'default', $icon_data = false, $custom_data = false, $print_css = false ) {


	if ( empty( $items ) ) {

		return;

	}

	$add_css = '';
	$out     = '';

	if ( ! $print_css ) {

		$animate         = isset( $custom_data['animate'] ) ? thz_akg( 'animate', $custom_data ) : false;
		$animation_data  = thz_print_animation( $animate );
		$animation_class = thz_print_animation( $animate, true );
		$cpx             = isset( $custom_data['cpx'] ) ? thz_akg( 'cpx', $custom_data ) : false;
		$cpx_data        = thz_print_cpx( $cpx );
		$cpx_class       = thz_print_cpx( $cpx, true );
		$anim_delay      = $animation_class != '' ? ' thz-anim-auto-delay' : '';

		$out .= '<' . $tag . ' id="' . $id . '" class="' . thz_sanitize_class( $class . $cpx_class . $anim_delay ) . '"' . thz_sanitize_data( $cpx_data ) . '>';
	}

	foreach ( $items as $item ) {

		$item_id       = thz_akg( 'itemid', $item );
		$title         = thz_akg( 'title', $item );
		$subitems      = thz_akg( 'subitems', $item );
		$item_icon     = thz_akg( 'icon/icon', $item );
		$icon_size     = thz_akg( 'icon/size', $item );
		$icon_color    = thz_akg( 'icon/color', $item );
		$icon_vnudge   = thz_akg( 'icon/v-nudge', $item );
		$icon_hnudge   = thz_akg( 'icon/h-nudge', $item );
		$icon_space    = thz_akg( 'icon/space', $item );
		$icon_position = thz_akg( 'ip', $icon_data );
		$margin_side   = $icon_position == 'left' ? 'right' : 'left';
		$link          = thz_akg( 'link', $item );
		$out_icon      = thz_akg( 'icon', $icon_data, false );
		$link_out      = false;

		if ( $item_icon ) {
			$out_icon      = $item_icon;
			$icon_position = thz_akg( 'ip', $item );
		}

		if ( $out_icon && $print_css ) {

			if ( $icon_color != '' || $icon_size != '' || $icon_vnudge != '' || $icon_hnudge != '' || $icon_space != '' ) {

				$add_css .= '#thz-list-item-' . esc_attr( $item_id ) . ' i{';
				if ( $icon_color != '' ) {
					$add_css .= 'color:' . esc_attr( $icon_color ) . ';';
				}
				if ( $icon_size != '' ) {
					$add_css .= 'font-size:' . thz_property_unit( $icon_size, 'px' ) . ';';
				}
				if ( $icon_vnudge != '' ) {
					$add_css .= 'top:' . thz_property_unit( $icon_vnudge, 'px' ) . ';';
				}
				if ( $icon_hnudge != '' ) {
					$add_css .= 'left:' . thz_property_unit( $icon_hnudge, 'px' ) . ';';
				}
				if ( $icon_space != '' ) {
					$add_css .= 'margin-' . $margin_side . ':' . thz_property_unit( $icon_space, 'px' ) . ';';
				}
				$add_css .= '}';
			}
		}

		if ( ! $print_css ) {

			if ( $link ) {

				if ( $link['type'] == 'normal' && $link['url'] != '' ) {

					$link_out = '<a href="' . esc_url( $link['url'] ) . '" target="' . esc_attr( $link['target'] ) . '">';

				} elseif ( $link['type'] == 'magnific' && $link['magnific'] != '' ) {

					$hash     = thz_contains( $link['magnific'], array( '#', 'http' ) ) ? '' : '#';
					$link_out = '<a class="thz-trigger-lightbox" href="' . $hash . esc_attr( $link['magnific'] ) . '">';
				}

			}

			$has_sub = ! empty( $subitems ) ? ' has-sub-list' : '';
			$out     .= '<li id="thz-list-item-' . esc_attr( $item_id ) . '" class="thz-list-item' . $has_sub . $animation_class . '"' . thz_sanitize_data( $animation_data ) . '>';

			if ( $out_icon && 'left' == $icon_position ) {
				$out .= '<i class="' . $out_icon . '"></i> ';
			}
			if ( $link_out ) {
				$out .= $link_out;
			}
			$out .= $title;
			if ( $link_out ) {
				$out .= '</a>';
			}
			if ( $out_icon && 'right' == $icon_position ) {
				$out .= '<i class="' . $out_icon . '"></i> ';
			}

			if ( ! empty( $subitems ) ) {
				$class = str_replace( 'thz-shc ', '', $class );
				if ( isset( $custom_data['cpx'] ) ) {
					unset( $custom_data['cpx'] );
				}
				$out .= thz_build_list( $subitems, $tag, $id . '-sub-list', $class . ' sub-list', $icon_data, $custom_data );
			}

			$out .= '</li>';

		}


	}

	if ( ! $print_css ) {
		$out .= '</' . $tag . '>';
	}

	if ( $print_css ) {

		return $add_css;

	} else {

		return $out;
	}

}

/**
 * Check if has shortcode
 * @return bool
 */
function thz_has_shortcodes( $shortcodes = array() ) {

	if ( empty( $shortcodes ) || !is_array( $shortcodes )) {
		return false;
	}

	global $post;

	foreach ( $shortcodes as $shortcode ) {

		if ( is_a( $post, 'WP_Post' ) && ( has_shortcode( $post->post_content, $shortcode ) || strpos( $post->post_content, $shortcode ) !== false ) ) {
			return true;
			break;
		}

	}

	return false;

}

/**
 * Check if has woo shortcodes
 * @return bool
 */
function thz_has_woo_shortcode() {

	$woo_shortcodes = array(

		'recent_products',
		'featured_products',
		'product',
		'product_category',
		'product_categories',
		'sale_products',
		'best_selling_products',
		'top_rated_products',
		'woocommerce_cart',
		'woocommerce_checkout',
		'woocommerce_order_tracking',
		'woocommerce_my_account'

	);

	if ( thz_has_shortcodes( $woo_shortcodes ) ) {

		return true;
	}

}

/**
 * Check if page has woo items
 * @return bool
 */
function thz_has_woo() {

	if ( function_exists( 'is_woocommerce' ) ) {
		if ( is_woocommerce() || is_cart() || is_checkout() || thz_has_woo_shortcode() ) {
			return true;
		}
	}

	return false;
}


/**
 * List all post types
 * @labels assoc with label names
 * @remove array remove post types from list
 * @return array
 */
function thz_list_post_types( $labels = true, $remove = array() ) {

	$pots_types     = array();
	$all_post_types = get_post_types( array(
		'public' => true,
	), 'object' );

	$remove_types = array(
		'attachment',
		'thz-pageblock'
	);

	if ( ! empty( $remove ) ) {
		$remove_types = array_merge( $remove_types, $remove );
	}

	foreach ( $remove_types as $unset ) {
		unset( $all_post_types[ $unset ] );
	}

	foreach ( $all_post_types as $type => $post_type ) {

		if ( $labels ) {

			$label               = $post_type->labels->singular_name;
			$label               = $label == 'Blog' ? 'Post' : $label;
			$pots_types[ $type ] = $label;

		} else {

			$pots_types[] = $type;
		}

	}
	unset( $all_post_types );

	return $pots_types;

}


/**
 * Translate html output
 */
function thz_html_trans( $content ) {

	$content = html_entity_decode( $content, ENT_QUOTES, 'UTF-8' );

	if ( function_exists( 'icl_object_id' ) && strpos( $content, 'wpml_translate' ) == true ) {
		$content = do_shortcode( $content );
	} elseif ( function_exists( 'qtrans_useCurrentLanguageIfNotFoundUseDefaultLanguage' ) ) {
		$content = qtrans_useCurrentLanguageIfNotFoundUseDefaultLanguage( $content );
	} elseif ( function_exists( 'ppqtrans_useCurrentLanguageIfNotFoundUseDefaultLanguage' ) ) {
		$content = ppqtrans_useCurrentLanguageIfNotFoundUseDefaultLanguage( $content );
	}

	return $content;
}

/**
 * Date query helper
 * @retrun array
 */
function thz_date_query_helper( $date ) {

	$date_query = array();
	if ( $date != 'all_posts' ) {
		$days       = (int) $date;
		$time       = time() - ( $days * 24 * 60 * 60 );
		$date_query = array(
			'after'     => date( 'F jS, Y', $time ),
			'before'    => date( 'F jS, Y' ),
			'inclusive' => true,
		);
	}

	return $date_query;
}


/**
 * Single templates paths based on post type
 * @retrun string
 */
if ( ! function_exists( 'thz_single_template_part' ) ) {


	function thz_single_template_part() {

		$template_part = 'template-parts/post/post-single';

		if ( 'page' == get_post_type() ) {

			$template_part = 'template-parts/page/content-page';
		}

		if ( function_exists( 'is_woocommerce' ) && 'product' == get_post_type() ) {

			$template_part = 'woocommerce/content-single-product';
		}

		if ( 'fw-portfolio' == get_post_type() ) {

			$project_layout = thz_get_option( 'project_layout/picked', 'full' );
			$template_part  = 'template-parts/portfolio/project-' . $project_layout;
		}

		if ( 'fw-event' == get_post_type() ) {

			$template_part = 'template-parts/events/event';
		}

		return $template_part;

	}

}


/**
 * Special heading parts
 * @retrun array
 */
if ( ! function_exists( '_thz_special_heading_parts' ) ) {


	function _thz_special_heading_parts( $parts ) {

		if ( empty( $parts ) ) {
			return;
		}

		$all_parts = array();

		foreach ( $parts as $part ) {

			if ( empty( $part['t'] ) ) {
				continue;
			}

			$key             = $part['m']['e'] . $part['m']['l'];
			$animate         = thz_akg( 'animate', $part );
			$animation_data  = thz_print_animation( $animate );
			$animation_class = thz_print_animation( $animate, true );
			$has_strings	 = thz_akg( 'rs/picked', $part, 'inactive' ); 
			$strings		 = thz_akg( 'rs/active/s', $part, array() );
			$rotation_data	 = '';
			$gr_mode         = thz_akg( 'gr/mode', $part, 'inactive' );
			$class           = 'thz-sh-part thz-sh-part-' . $key . $animation_class;
			
			if( 'active' == $has_strings && !empty($strings)){
				$class .= ' thz-rotate-text';
				$sd	= thz_akg( 'rs/active/mx/sd', $part, 200 );
				$rd	= thz_akg( 'rs/active/mx/rd', $part, 2000 );
				$rotation_data = ' data-start-delay="'.esc_attr($sd).'" data-rotation-delay="'.esc_attr($rd).'"';
			}
			
			if ( 'active' == $gr_mode ) {
				$class .= ' thz-gradient-text';
			}
			
			$brake = $part['m']['b'];
			$html  = '';
			
			if ( $brake == 'b' ) {
				$html .= '<br />';
			}
			
			$html .= '<span id="thz-sh-part-' . $part['id'] . '" class="' . $class . '"' . $animation_data . $rotation_data . '>';
			
			if( 'active' == $has_strings && !empty($strings)){
				$html .= '<span class="text-string text-active first">'.str_replace(' ','&nbsp;',$part['t']).'</span>';
				foreach($strings as $string){
					$html .= '<span class="text-string">'.str_replace(' ','&nbsp;',$string).'</span>';
				}
				unset($strings);
			}else{
				$html .= str_replace(' ','&nbsp;',$part['t']);
			}
			$html .='</span>';

			
			if ( $brake == 'a' ) {
				$html .= '<br />';
			}
			
			$all_parts[ $key ][] = $html;

			unset( $part );
		}

		unset( $parts );

		if ( ! empty( $all_parts ) ) {
			foreach ( $all_parts as $key => $parts ) {

				$all_parts[ $key ] = implode('', $parts );

				unset( $key, $parts );
			}

			return $all_parts;
		}
	}

}

/**
 * Special heading parts CSS
 * @retrun string
 */
if ( ! function_exists( '_thz_special_heading_parts_css' ) ) {


	function _thz_special_heading_parts_css( $parts ) {

		if ( empty( $parts ) ) {
			return;
		}

		$add_css = '';

		foreach ( $parts as $part ) {

			if ( empty( $part['t'] ) ) {
				continue;
			}

			$gr_css    = _thz_gradient_text_css( thz_akg( 'gr', $part ) );
			$part_typo = thz_typo_css( thz_akg( 'f', $part ) );

			if ( $part_typo != '' || $gr_css ) {
				$add_css .= '.thz-heading-holder:not(#♥) #thz-sh-part-' . $part['id'] . ',';
				$add_css .= '.thz-heading-holder:not(#♥) #thz-sh-part-' . $part['id'] . ' *{';
				if ( $part_typo != '' ) {
					$add_css .= $part_typo;
				}
				if ( $gr_css ) {
					$add_css .= $gr_css;
				}
				$add_css .= '}';
			}

			unset( $part );
		}

		unset( $parts );

		if ( $add_css != '' ) {

			return $add_css;

		}

	}

}


/**
 * Print mini header items
 * @retrun string
 */
if ( ! function_exists( '_thz_mini_header_items' ) ) {

	function _thz_mini_header_items( $echo = true ) {

		$mini_logo     = thz_get_option( 'minimx/l', 'h' );
		$mini_logo_img = thz_get_option( 'minilogo' );
		$mini_hamb     = thz_get_option( 'minimx/h', 't' );
		$mini_soc      = thz_get_option( 'minimx/s', 'b' );
		$hamx_oc       = thz_get_option( 'hamx/hc', 'click' );
		$positions     = array( 't' => array(), 'm' => array(), 'b' => array() );
		$html          = '';

		if ( $mini_logo != 'h' && ! empty( $mini_logo_img ) ) {

			$alt          = apply_filters( 'thz_filter_mini_logo_alt', get_bloginfo( 'name' ) );
			$sdata_active = thz_get_theme_option( 'sdata', 'active' );

			$sd1 = '';
			$sd2 = '';
			$sd3 = '';

			if ( $sdata_active == 'active' ) {
				$sd1 = ' itemscope itemtype="https://schema.org/Organization"';
				$sd2 = 'itemprop="url" ';
				$sd3 = 'itemprop="logo"';
			}

			$logo_html = '<div class="thz-mini-logo thz-mini-item"' . $sd1 . '>';
			$logo_html .= '<a ' . $sd2 . 'href="' . esc_url( home_url( '/' ) ) . '">';
			$logo_html .= '<img ' . $sd3 . 'class="mini-logo" src="' . esc_url( $mini_logo_img['url'] ) . '" alt="' . esc_attr( $alt ) . '" />';
			$logo_html .= '</a>';
			$logo_html .= '</div>';

			$positions[ $mini_logo ][] = $logo_html;
		}

		$bur_html = '<div class="thz-mini-burger thz-mini-item">';
		$bur_html .= '<button class="thz-burger thz-burger--spin-r thz-open-canvas thz-burger-on' . $hamx_oc . ' thz-burger-onoverlay" type="button">';
		$bur_html .= '<span class="thz-burger-box">';
		$bur_html .= '<span class="thz-burger-inner"></span>';
		$bur_html .= '</span>';
		$bur_html .= '</button>';
		$bur_html .= '</div>';


		$positions[ $mini_hamb ][] = $bur_html;

		if ( $mini_soc != 'h' ) {


			$soc_html = '<div class="thz-mini-socials thz-mini-item">';
			$soc_html .= thz_social_links_print( 'lsim', 'lc', 'thz-socials-header-lateral', false, false );
			$soc_html .= '</div>';

			$positions[ $mini_soc ][] = $soc_html;
		}


		foreach ( $positions as $key => $poz ) {

			if ( empty( $poz ) ) {
				continue;
			}

			$html .= '<div class="thz-mini-pos-' . $key . '">';
			$html .= implode( '', $poz );
			$html .= '</div>';

			unset( $key, $poz );
		}
		unset( $positions );


		if ( $html != '' ) {

			$mini = '<div class="thz-mini-header-items">';
			$mini .= $html;
			$mini .= '</div>';

			if ( $echo ) {
				echo $mini;
			} else {
				return $mini;
			}
		}
	}
}

/**
 * Related posts output
*/
if ( ! function_exists( 'thz_related_posts_output' ) ) {
	
	function thz_related_posts_output($location){
	
		if ( ! is_singular(array('post','fw-portfolio','fw-event')) || is_page() || is_attachment() ) {
			return;
		}
				
		$post_type	= get_post_type();
		if($post_type =='fw-portfolio'){
			$relh_mx 		= 'prel_mx';
			$prefix			= 'prr_';
			
		}else if($post_type =='fw-event'){
	
			$relh_mx 		= 'erel_mx';
			$prefix			= 'er_';
			
		}else{
			
			$relh_mx 		= 'brel_mx';
			$prefix			= 'pr_';
		}
		
		$mx 		= thz_get_option($relh_mx ,null );
		$type 		= thz_get_option($prefix.'type/picked','slider');
		$show 		= thz_akg('v',$mx,'show');
		$position 	= thz_akg('l',$mx,'inside');
		
		if( 'hide' == $show ||  $location != $position ){
			return;
		}
		
		$path 		= thz_theme_file_path('/template-parts/related/post-related-layout-'.$type.'.php');
		$related 	= thz_render_view( $path,array());
		
		echo $related;
	}
}


/**
 * Post comments output
*/
if ( ! function_exists( 'thz_comments_output' ) ) {
	
	function thz_comments_output($location){
		
		if ( ! is_singular(array('post','fw-portolio','fw-event')) || is_page() || is_attachment() ) {
			return;
		}
				
		$post_type	= get_post_type();
		
		if($post_type =='fw-portfolio'){
			
			$com_mx 		= 'pcom_mx';
			
		}else if($post_type =='fw-event'){
	
			$com_mx 		= 'ecom_mx';
			
		}else{
			
			$com_mx 		= 'bcom_mx';
		}
		
		$mx 		= thz_get_option($com_mx ,null );
		$show 		= thz_akg('v',$mx,'show');
		$position 	= thz_akg('l',$mx,'inside');
		
		if( 'hide' == $show || $location != $position ){
			return;
		}	
		
		if ( $show =='show' && (  comments_open() || get_comments_number() )){
			
			$html = '<div class="thz-post-comments-row thz-content-row">';
			$html .='<div class="thz-post-comments-holder'.thz_single_cmx($com_mx, false, false ).'">';
			$html .='<div class="thz-max-holder'.thz_single_cmx($com_mx ,true, false).'">';
			$html .= thz_get_post_comments();
			$html .='</div>';
			$html .='</div>';
			$html .='</div>';
			
			echo $html;
		}
	}
	
}

/**
 * Get comments as return
*/
if ( ! function_exists( 'thz_get_post_comments' ) ) {
	function thz_get_post_comments(){
		
		ob_start();
		comments_template();
		return ob_get_clean();
		
	}
}


/**
 * Get customizer settings
 * @option mode|panels
 * @return mixed
*/
if ( ! function_exists( 'thz_get_customizer_settings' ) ) {
	function thz_get_customizer_settings( $option = null ){
		
		$customizer_settings = get_option('thz_customizer_mode',array(
			'picked' =>'accordions',
			'accordions' =>array(
				'panels' => array(
					'site' => true,
					'header' => true,
					'logo' => true,
					'mainmenu' => true,
					'pagetitle' => true,
					'blog' => true,
					'footer' => true,
				)
			)
		));
		
		$customizer_mode 	= thz_akg('picked',$customizer_settings,'accordions');
		
		if( 'mode' == $option ){
			return $customizer_mode;
		}
		
		if( 'panels' == $option ){
			$customizer_panels	= thz_akg($customizer_mode.'/panels',$customizer_settings, array());
			return $customizer_panels;
		}
		
		return $customizer_settings;
	}
}

/**
 * Get customizer mode
*/
if ( ! function_exists( 'thz_get_customizer_mode' ) ) {
	function thz_get_customizer_mode(){
		return thz_get_customizer_settings( 'mode' );
	}
}

/**
 * Get customizer panels
*/
if ( ! function_exists( 'thz_get_customizer_panels' ) ) {
	function thz_get_customizer_panels(){
		return thz_get_customizer_settings( 'panels' );
	}
}

/**
 * Customizer options
 * @options customizer options set
 * @return mixed | only selected panels
*/
if ( ! function_exists( 'thz_customizer_options' ) ) {
	function thz_customizer_options( $options ){
		
		$customizer_mode = thz_get_customizer_mode();
		$customizer_panels = thz_get_customizer_panels();
		
		if( 'popups' == $customizer_mode ){
			
			foreach($options['creatus_panel']['options'] as $section => $s){
				
				$section_key = str_replace('customizer_','', $section);
				
				if( array_key_exists($section_key,$customizer_panels) ){
					continue;	
				}
				
				unset($options['creatus_panel']['options'][$section]);
			}
			
		}else{
			
			foreach($options as $panel => $p){
				
				$panel_key = str_replace('_panel','', $panel);
				
				if( array_key_exists($panel_key,$customizer_panels) ){
					continue;	
				}
				
				unset($options[$panel]);
			}			
			
		}
		
		return $options;
	}
}

/**
 * Customizer page options
 * Advise if page has custom options override
 * @return string
*/
if ( ! function_exists( 'thz_customizer_page_options' ) ) {
	function thz_customizer_page_options(){
		
		$customizer_oon = thz_get_theme_option('customizer_oon','active');
		
		if( is_customize_preview() && 'active' == $customizer_oon ){
			
			$options = thz_get_option();
			
			if(!empty($options)){
				return implode(', ',array_keys($options));
			}
		}
		
		return 0;
	}
}