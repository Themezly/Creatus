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

if ( !is_admin()) {

	if( wp_style_is( THEME_NAME.'-compiled', 'registered')){
		
		wp_enqueue_style( THEME_NAME . '-compiled');
		
	}else{
		
		$remch	 	= thz_get_theme_option('thzopt/remch','donotremove');
		
		wp_enqueue_style('font-awesome');
		wp_enqueue_style('thz-icons');
		wp_enqueue_style( THEME_NAME. '-theme' );
		wp_enqueue_style( THEME_NAME. '-menus' );
		wp_enqueue_style( THEME_NAME. '-shortcodes' );
		wp_enqueue_style( THEME_NAME. '-layout' );
		wp_enqueue_style( THEME_NAME. '-units' );
		wp_enqueue_style( THEME_NAME. '-utility' );
		wp_enqueue_style( THEME_NAME. '-buttons' );
		wp_enqueue_style( THEME_NAME. '-animate' );
		wp_enqueue_style( THEME_NAME. '-hovers' );
		wp_enqueue_style( THEME_NAME. '-magnific' );
		wp_enqueue_style( THEME_NAME. '-print' );
		
		if( wp_style_is( THEME_NAME.'-style', 'registered')){
			wp_enqueue_style( THEME_NAME. '-style');
		}
		
		if( 'donotremove' == $remch && is_child_theme() ){
			wp_enqueue_style( THEME_NAME. '-child');
		}
	}

	if( is_rtl() ){
		
		wp_enqueue_style( THEME_NAME. '-rtl' );
		
	}

	/* scripts */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	
	thz_enqueue_mediaelement_scripts();
	
	$minjs	 	= thz_get_theme_option('thzopt/minjs','donotminify');
	
	if($minjs  == 'donotminify'){
		wp_enqueue_script( THEME_NAME. '-plugins');
	}
	
	wp_enqueue_script( THEME_NAME. '-init');
	wp_enqueue_script( THEME_NAME. '-site');
	
	wp_localize_script( THEME_NAME. '-site', 'thzsite', array(
		'ajaxurl'			=> admin_url( 'admin-ajax.php' ),
		'masonrynonce'		=> wp_create_nonce( 'thz-masonry' ),
		'likesnonce'		=> wp_create_nonce( 'thz-likes' ),
		'likesingular'		=> esc_html__('Like', 'creatus'),
		'likeplural'		=> esc_html__('Likes', 'creatus'),
		'smoothscroll' 		=> thz_get_option('smoothscroll','inactive'),
		'offline'	 		=> thz_get_theme_option('offline','inactive'),
		'site_url'	 		=> get_site_url(),
		'lightbox_style'	=> thz_get_theme_option('lightbox_style','mfp-dark'),
		'lightbox_opacity'	=> thz_get_theme_option('lightbox_opacity','mfp-opacity-08'),
		'lightbox_effect'	=> thz_get_theme_option('lightbox_effect','mfp-zoom-in'),
		'is_rtl'			=> is_rtl(),
		'is_customizer'		=> is_customize_preview() ? 1 : 0,
		'page_options'		=> thz_customizer_page_options()
	));
	
}