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
 * Sync Theme Settings and Customizer options db values
 * @internal
 */
class Thz_Customizer {
	
	private static $instance = null;

	public function __construct() {

		if( !thz_fw_active() || empty( $this->panels() ) ){
			return;
		}
				
		add_action('customize_save_after', array(__CLASS__, '_thz_action_after_customizer_save'));
		add_action('fw_settings_form_saved', array(__CLASS__, '_thz_action_after_settings_save'));
		add_action('fw_settings_form_reset', array(__CLASS__, '_thz_action_after_settings_save'));
		add_action('customize_controls_enqueue_scripts', array(__CLASS__, '_thz_action_customizer_controls_scripts'));
		add_action('customize_controls_print_styles', array(__CLASS__, '_thz_action_customizer_preloader'));
		add_action('customize_register', array(__CLASS__, '_thz_action_customizer_live_fw_options'));
		add_action('customize_preview_init', array(__CLASS__, '_thz_action_customizer_live_fw_options_preview'));
		
		add_filter('fw_customizer_options', array(__CLASS__, '_thz_filter_set_default_customizer_options'));
	}
		
	/**
	 * Get class instance
	 * @return null|Thz_Customizer
	 */
	public static function get_instance() {
		if ( self::$instance === null ) {
			self::$instance = new Thz_Customizer();
		}

		return self::$instance;
	}
	
	/**
	 * Get mode
	 */	
	public static function mode(){
		return thz_get_customizer_mode();
	}

	/**
	 * Get panels
	 */
	public static function panels(){
	   return thz_get_customizer_panels();
	}
		
	/**
	 * If theme_mods fw_options is not set 
	 * set default values from theme settigns DB
	 */	
	public static function _thz_filter_set_default_customizer_options($options) {
	
			$mods = get_theme_mods();

			if(!isset($mods['fw_options'])){

				$collect_options = array();
				fw_collect_options($collect_options, $options);
									
				if( 'accordions' == self::mode() ){
					
					foreach ($collect_options as $id => $option) {
						$collect_options[$id]['value'] = fw_get_db_settings_option($id, isset($option['value']) ? $option['value'] : null);
					}
					
				}else{
					
					foreach ($collect_options as $popup_id => $options_popup) {
						
						$inner_options = array();
						fw_collect_options($inner_options, $collect_options[$popup_id]['popup-options']);
						
						foreach ($inner_options as $id => $option) {
							$collect_options[$popup_id]['value'][$id] = fw_get_db_settings_option($id, isset($option['value']) ? $option['value'] : null);
						}

					}
					unset($collect_options,$inner_options);					
				}
			}
		
			
		return $options;
	}

	/**
	 * If a customizer option also exists in settings options, copy its value to settings option value
	 */
	public static function _thz_action_after_customizer_save(){

		$settings_options 	= fw_extract_only_options(fw()->theme->get_settings_options());
		$customizer_options = fw_extract_only_options(fw()->theme->get_customizer_options());
		
		
		if( 'popups' == self::mode() ){
			
			foreach( $customizer_options as $section_options ){
				
				$inner_options = fw_extract_only_options($section_options['popup-options']);
				$section_id    = $section_options['section'];
				
				foreach (
					array_intersect_key(
						$inner_options,
						$settings_options
					)
					as $option_id => $option
				) {
					
					if ($option['type'] === $settings_options[$option_id]['type']) {
						
						fw_set_db_settings_option(
							$option_id, fw_get_db_customizer_option($section_id.'/'.$option_id)
						);
					}
				}				
				
			}
			
		}else{
			
			if( array_key_exists('css',self::panels()) ){
				$temp_custom_css = fw_get_db_customizer_option('temp_custom_css');
				if( isset($temp_custom_css) ){
					fw_set_db_settings_option('custom_css',$temp_custom_css);
				}
			}
					
			foreach (
				array_intersect_key(
					$customizer_options,
					$settings_options
				)
				as $option_id => $option
			) {
				if ($option['type'] === $settings_options[$option_id]['type']) {
					fw_set_db_settings_option(
						$option_id, fw_get_db_customizer_option($option_id)
					);
				}

			}
		}
	}

	/**
	 * If a settings option also exists in customizer options, copy its value to customizer option value
	 */
	public static function _thz_action_after_settings_save(){
		
		$settings_options 	= fw_extract_only_options(fw()->theme->get_settings_options());
		$customizer_options = fw_extract_only_options(fw()->theme->get_customizer_options());
		
		// cleanup first to make sure that only assigned mode options are present
		fw_set_db_customizer_option(null,array());
		
		if( 'popups' == self::mode() ){
			
			foreach( $customizer_options as $section_options ){
				
				$inner_options = fw_extract_only_options($section_options['popup-options']);
				$section_id    = $section_options['section'];
				foreach (
					array_intersect_key(
						$settings_options,
						$inner_options
					)
					as $option_id => $option
				) {
					
					if ($option['type'] === $inner_options[$option_id]['type']) {
						
						fw_set_db_customizer_option(
							$section_id.'/'.$option_id, fw_get_db_settings_option($option_id)
						);
					}
				}				
				
			}
			
		} else {

			if( array_key_exists('css',self::panels()) ){
				$custom_css = fw_get_db_settings_option('custom_css');
				fw_set_db_customizer_option('temp_custom_css',$custom_css);
			}
			
			foreach (
				array_intersect_key(
					$settings_options,
					$customizer_options
				)
				as $option_id => $option
			) {
				if ($option['type'] === $customizer_options[$option_id]['type']) {
					fw_set_db_customizer_option(
						$option_id, fw_get_db_settings_option($option_id)
					);
				}

			}			
			
		}

	}
	
	public static function _thz_action_customizer_controls_scripts() {
		
		$path = thz_theme_file_uri( '/inc/includes/utilities/customizer/assets' );
		wp_register_style( THEME_NAME. '-customizer', $path.'/css/style.css', false, thz_theme_version() ,'all' );		
		wp_enqueue_style( THEME_NAME. '-customizer' );
		
		wp_register_script( 'thz-customizer', $path.'/js/scripts.js', array(
			 'jquery',
			  'customize-controls',
			  'fw-events', 'qtip', 'fw-reactive-options'
		),fw()->theme->manifest->get_version(),true);
		
		wp_localize_script('thz-customizer', 'thzcustomizer', array(
			'options_heading' => esc_html__('Theme options override is active','creatus'),
			'options_title' => esc_html__('This page has custom theme options for;','creatus'),
			'options_info' => esc_html__('Some of the live preview options will not be affected by the customizer option value change.','creatus'),
			'options_disable_notice' => esc_html__('Disable notice for this page','creatus'),
			'more_options_text' => esc_html__('More options','creatus'),
			'more_options_link' => 'themes.php?page=fw-settings#fw-options-tab-advanced'
		));
		
		wp_dequeue_script('fw-option-types');
		wp_enqueue_script('thz-customizer');
		
	}
	
	public static function _thz_action_customizer_preloader(){
		
		ob_start();
		
		$preloader ='<div id="thz-customizer-preloader">';
		$preloader .='<div class="thz-customizer-preloader-in">';
		$preloader .='<div class="thz-customizer-text">';
		$preloader .='<span class="thz-icon-shape-pulsate effectactive">';
		$preloader .='<span class="thz-icon-shape-effect"></span>';
		$preloader .='<span class="thz-icon thzicon thzicon-themezly"></span>';
		$preloader .='</span>';
		$preloader .='<p>';
		$preloader .= __('This will take a moment. Loading customizer options please wait...','creatus');
		$preloader .=' </p>';
		$preloader .=' </div>';
		$preloader .='</div>';
		$preloader .='</div>';
		
		$output = $preloader; ob_get_contents(); ob_end_clean();
		echo $output;
		
	}
	
	public static function _thz_action_customizer_live_fw_options($wp_customize) {
		
		if( 'accordions' == self::mode() ){
			$live_options = array(
				//'temp_custom_css',
				'layout_type',
				'site_width'
			);
			
			foreach( $live_options as $option ){
				if ($wp_customize->get_setting('fw_options['.$option.']')) {
					$wp_customize->get_setting('fw_options['.$option.']')->transport = 'postMessage';
				}
			}
		}
	}
	
   public static function _thz_action_customizer_live_fw_options_preview() {
		
		if( 'accordions' == self::mode() ){
			
			$path = thz_theme_file_uri( '/inc/includes/utilities/customizer/assets' );
	
			wp_enqueue_script( 'thz-admin-plugins', thz_theme_file_uri( '/inc/thzframework/admin/js/thz.admin.plugins.js'), array(
				 'jquery' 
			) );
	
			wp_enqueue_script( 'thz-customizer-live', $path.'/js/thz.customizer.live.js', array(
				 'jquery',
				  'customize-preview',
			));
			
			wp_localize_script('thz-customizer-live', 'thz_customizer_vars', array(
					'thz_palette' => json_encode(thz_get_theme_option('theme_palette')),
				)
			);
		}
	}
	
}
/**
 * Get Thz_Customizer instance
 */
Thz_Customizer::get_instance();


/* Options active_callback functions */

/**
 * Is posts archive
 */
function thz_customizer_is_posts_archive(){
	
	if(
	'posts' == get_option( 'show_on_front' ) && is_home() && is_front_page() 
	||
	'page' == get_option( 'show_on_front' ) && is_home() && !is_front_page()
	||
	is_author()
	||
	is_category()
	||
	is_tag() 
	||
	is_tax()
	||
	 is_archive() && ! is_tax() 
	){
		return true;
	}
}
/**
 * Is single post
 */
function thz_customizer_single_post(){
	
	if( is_singular(array(
			'fw-portfolio',
			'fw-event',
			'forum',
			'topic',
			'reply',
			'product',
		))){
		return false;
	}
	
	return  is_single();
}

/**
 * Is portfolio
 */
function thz_customizer_is_portfolio(){
	
	if ( is_singular('fw-portfolio') 
		||
		get_post_type() == 'fw-portfolio' && is_archive()
	) {
		return true;
	}
}
/**
 * Is portfolio archive
 */
function thz_customizer_is_portfolio_archive(){
	
	if ( get_post_type() == 'fw-portfolio' && is_archive() ) {
		return true;
	}
}
/**
 * Is single portfolio
 */
function thz_customizer_single_project(){
	return is_singular('fw-portfolio');
}
/**
 * Is event
 */
function thz_customizer_is_event(){
	
	if ( is_singular('fw-event') 
		||
		get_post_type() == 'fw-event' && is_archive()
	) {
		return true;
	}
}
/**
 * Is event archive
 */
function thz_customizer_is_event_archive(){
	
	if ( get_post_type() == 'fw-event' && is_archive() ) {
		return true;
	}
}
/**
 * Is single event
 */
function thz_customizer_single_event(){
	return is_singular('fw-event');
}
/**
 * Is woo
 */
function thz_customizer_is_woo(){
	if ( class_exists( 'WooCommerce' )  ) {
		if ( is_shop() 
			|| 
			is_singular('product') 
			||
			get_post_type() == 'product' && is_archive()
		) {
			return true;
		}
	}
}
/**
 * Is woo archive
 */
function thz_customizer_is_woo_archive(){
	
	if ( get_post_type() == 'product' && is_archive() ) {
		return true;
	}
}
/**
 * Is single product
 */
function thz_customizer_single_product(){
	return is_singular('product');
}