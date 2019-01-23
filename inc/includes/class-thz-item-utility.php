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

class Thz_Item_Utility{
	/**
	 * @var Thz_Item_Utility
	 */
	private static $instance = null;
	/**
	 * @var null|Thz_Theme_Utility
	 */
	private $main_page_utils;
	/**
	 * @var null|Thz_Loop_Post_Utility
	 */
	private $post_loop_utils;
	/**
	 * @var false|is_customize_preview 
	 */
	private $customizer = false;

	/**
	 * Thz_Item_Utility constructor.
	 */
	private function __construct() {
		$this->load_dependencies( Thz_Theme_Utility::get_instance() );
		/**
		 * Start Main Page Utility class because it needs to hook to action "wp"
		 * in order to determine and set the "thing" being displayed, no matter what is
		 * displayed: page, post, author, taxonomy, etc
		 */
		$this->main_page_utils 	= new Thz_Main_Page_Utility();
		$this->post_loop_utils 	= new Thz_Loop_Post_Utility();
		$this->customizer 		= is_customize_preview();
	}

	/**
	 * Get class instance
	 * @return null|Thz_Item_Utility
	 */
	public static function get_instance() {
		if ( self::$instance === null ) {
			self::$instance = new Thz_Item_Utility();
		}

		return self::$instance;
	}

	/**
	 * Returns the ID of the current element in loop or of the main page
	 * being displayed to the user
	 *
	 * @return int|null
	 */
	public function get_id(){
		$id = null;
		// post loop ID takes precedence, set it first
		$id = $this->post_loop_utils->get_post_id();
		// post ID not set yet, get it from the main page
		if( !$id ){
			// try to set the post
			$id = $this->main_page_utils->get_post_id();
			if( !$id ){
				// if post ID not available, might be term
				$id = $this->main_page_utils->get_term_id();
			}
			// if not even term ID, get author ID
			if( !$id ){
				$id = $this->main_page_utils->get_author_id();
			}
		}

		return $id;
	}

	/**
	 * Returns post options based on which part of the page requests the information.
	 *
	 * @param null $option_id
	 * @param null $default
	 *
	 * @return mixed|null|theme
	 */
	public function get_post_option( $option_id = null, $default = null ){
		if( !$this->get_id() ){
			return $default;
		}

		// assign default to options
		$options = $default;

		// is term, get term options
		if ( $this->post_loop_utils->get_post_id() ){ // in loop, get loop options
			$options = $this->post_loop_utils->get_option( $option_id, $default );
		}else{
			// not in loop, return main page options
			$options = $this->main_page_utils->get_option( $option_id, $default );
		}

		return $options;
	}

	/**
	 * Returns a custom array for main page options
	 * @return mixed
	 */
	public function get_main_page_option( $option_id = null, $default = null, $theme_option = null ){
		
		$value =  $this->main_page_utils->get_option( $option_id, $default, $theme_option );
		
		return $this->check_customizer_option( $option_id, $value );
	}

	/**
	 * Returns all main page options
	 */
	public function get_main_page_options(){
		return $this->main_page_utils->get_options();
	}

	/**
	 * Return a theme option
	 *
	 * @param string $option_id - the ID of the option
	 * @param mixed $default - default value to be returned if option isn't found
	 *
	 * @return theme
	 */
	public function get_theme_option( $option_id = null, $default = null , $bypass_customizer = null ){
		
		$value = $this->main_page_utils->get_options_obj()->get_theme_options( $option_id, $default );
		
		if( $bypass_customizer ){
			return $value;
		}

		return $this->check_customizer_option( $option_id, $value );
	}
	
	/**
	 * Check if main page has option
	 * @return bool
	 */	
	public function main_page_has_option( $option_id ){
		
		return $this->main_page_utils->get_page_option( $option_id , false );
		
	}
	
	/**
	 * Check customizer option if in preview
	 * @return mixed
	 */	
	public function check_customizer_option( $option_id = null, $default = null ){
		
		if( $this->customizer && did_action( 'customize_preview_init' ) ){
			
			if( function_exists('fw_get_db_customizer_option') && $this->main_page_has_option( $option_id ) === false ){
				
				$customizer_value = $this->get_customizer_option($option_id);
				
				if( isset( $customizer_value ) ){
					return $this->get_customizer_option( $option_id, $default );
				}
			}
		}		
		
		return $default;
	}
	
	/**
	 * Get customizer option based on mode
	 * @return mixed
	 */		
	public function get_customizer_option($option_id = null, $default = null){
		
		$customizer_options = fw_get_db_customizer_option();
		$customizer_mode 	= thz_get_customizer_mode();
		
		if( 'popups' == $customizer_mode ){
			
			$merged_options = array();
			
			foreach( $customizer_options as $key => $options ){
				
				if (strpos($key, 'customizer_') !== false) {
				
					$merged_options = array_merge( $merged_options, $options );
				
				}
			}
			
			$customizer_options  = $merged_options;
			
			unset($merged_options);
		}
		
		if( 'accordions' == $customizer_mode && $option_id == 'custom_css' ){
			$option_id = 'temp_custom_css';
		}
					
		return thz_akg( $option_id, $customizer_options, $default );
	}
	

	/**
	 * Load all classes needed by this class
	 * @param Thz_Theme_Utility $theme_utility
	 */
	private function load_dependencies( Thz_Theme_Utility $theme_utility ){
		$abs_path = $theme_utility->get_parent_path() . '/inc/includes/utilities/item/';
		$files = array(
			'post-utility.interface.php',
			'main-page-options.class.php',
			'main-page-utility.class.php',
			'post-loop-utility.class.php',
			'unyson-helper.class.php',
			'array-flatten.class.php',
			'item-options.class.php'
		);
		foreach ( $files as $file ){
			require_once $abs_path . $file;
		}
	}
}


/**
 * @return Thz_Item_Utility instance
 */
function thz_item() {

	static $THZITEM = null; // cache
	
	if ($THZITEM === null) {
		$THZITEM = Thz_Item_Utility::get_instance();
	}
	
	return $THZITEM;
}


Thz_Item_Utility::get_instance();