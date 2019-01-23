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

// bbPress
if( !is_admin() && class_exists('bbPress')){ 


	/**
	 *	Replace bbpress style with our own
	 *  @internal
	 */
	function _thz_action_bbpress_style() {
		
		wp_dequeue_style( 'bbp-default' );
		
		if(thz_is_bbpress()){
			wp_enqueue_style( THEME_NAME. '-bbpress' );	
		}

	}
	
	add_action( 'wp_enqueue_scripts', '_thz_action_bbpress_style' );
	
	
	/**
	 *	Shorten freshness wording
	 *  @internal
	 */
	function _thz_filter_short_freshness( $output) {
		$output = preg_replace( '/, .*[^ago]/', ' ', $output );
		return $output;
	}
	
	add_filter( 'bbp_get_time_since', '_thz_filter_short_freshness' );
	add_filter('bp_core_time_since', '_thz_filter_short_freshness');		

	
	/**
	 * Redirect to assigned index page if set
	 */
	function _thz_filter_redirect_to_index_page() {

		if( bbp_is_forum_archive() ){

			$forum_index = thz_get_theme_option('bbpix/0',null);
			
			if(isset($forum_index)){
				exit( wp_redirect( get_permalink( $forum_index ) ) );
			}

		}
		
	}
	
	add_filter( 'template_redirect', '_thz_filter_redirect_to_index_page' );	
}


// BuddyPress
if( !is_admin() && function_exists('bp_current_component')){ 


	/**
	 *	Remove BuddyPress styles if not on bp page
	 *  @internal
	 */
	function _thz_action_buddypress_style() {
		if(!bp_current_component()){
			wp_dequeue_style( 'bp-mentions-css' );
			wp_dequeue_style( 'bp-parent-css' );
		}
	}

	add_action( 'wp_enqueue_scripts', '_thz_action_buddypress_style' );
		
		
	
	/**
	 *	BudyPress cover image
	 *  @internal
	 */
	function _thz_filter_bp_cover_image_css( $settings = array() ) {

		$theme_handle = 'bp-parent-css';
	
		$settings['theme_handle'] = $theme_handle;
	
		$settings['callback'] = 'thz_bp_cover_image_callback';
	
		return $settings;
	
	}
	
	function thz_bp_cover_image_callback( $params = array() ) {
		
		if ( empty( $params ) ) {
			return;
		}
		$add_css = '#buddypress #header-cover-image{';
		$add_css .= 'height: ' . $params["height"] . 'px;';
		$add_css .= 'background-image: url(' . $params['cover_image'] . ')';
		$add_css .= '}';

		return $add_css;
	}

	add_filter( 'bp_before_xprofile_cover_image_settings_parse_args', '_thz_filter_bp_cover_image_css', 10, 1 );
	add_filter( 'bp_before_groups_cover_image_settings_parse_args', '_thz_filter_bp_cover_image_css', 10, 1 );
	
	
	
	
	/**
	 *	BudyPress default profile cover image
	 *  @internal
	 */
	function _thz_filter_bp_profile_default_cover( $settings = array() ) {
	
		$settings['default_cover'] = thz_theme_file_uri( '/assets/images/bp-profile-cover.png' );
		$settings['width'] 	= 1280;
		$settings['height'] = thz_get_theme_option('bbci/p',450);
		
		return $settings;
	
	}
	
	add_filter( 'bp_before_xprofile_cover_image_settings_parse_args', '_thz_filter_bp_profile_default_cover', 10, 1 );
	
	/**
	 *	BudyPress default group cover image
	 *  @internal
	 */
	function _thz_filter_bp_groups_default_cover( $settings = array() ) {
	
		$settings['default_cover'] 	= thz_theme_file_uri( '/assets/images/bp-group-cover.png' );
		$settings['width'] 			= 1280;
		$settings['height'] 		= thz_get_theme_option('bbci/g',450);
		
		return $settings;
	
	}

	add_filter( 'bp_before_groups_cover_image_settings_parse_args', '_thz_filter_bp_groups_default_cover', 10, 1 );
	
	
	
	
	
	/**
	 *	Wrap buddypress activity
	 *  @internal
	 */
	function _thz_action_before_activity(){
		
		$layout_type = thz_get_theme_option('bplt','timeline');
		
		$html = '<div class="thz-bp-activity '.$layout_type.'">';
		
		echo $html;
	}
	
	add_action( 'bp_before_directory_activity_list', '_thz_action_before_activity', 10 , 0);
	add_action( 'bp_before_member_activity_content', '_thz_action_before_activity', 10 , 0);
	add_action( 'bp_before_group_activity_content', '_thz_action_before_activity', 10 , 0);
	
	function _thz_action_after_activity(){
		
		$html = '</div>';
		
		echo $html;
		
	}
	
	add_action( 'bp_after_directory_activity_list', '_thz_action_after_activity', 10 , 0);
	add_action( 'bp_after_member_activity_content', '_thz_action_after_activity', 10 , 0);
	add_action( 'bp_after_group_activity_content', '_thz_action_before_activity', 10 , 0);
}