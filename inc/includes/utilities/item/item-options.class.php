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
 * Class Thz_Item_Options
 * Utility class that returns the options for a given object that implements
 * Thz_Post_Utility object
 *
 * @uses Thz_Unyson_Helper
 * @uses Thz_Array_Flatten
 */
class Thz_Item_Options{
	/**
	 * @var Thz_Post_Utility_Interface
	 */
	private $post;
	/**
	 * @var
	 */
	private $theme_options;
	/**
	 * @var
	 */
	private $item_options;
	/**
	 * @var Thz_Unyson_Helper
	 */
	private $unyson_helper;

	/**
	 * Thz_Item_Options constructor.
	 *
	 * @param Thz_Main_Page_Utility $page
	 */
	public function __construct( Thz_Post_Utility_Interface $post ) {
		$this->post = $post;
		$this->unyson_helper = new Thz_Unyson_Helper( $this );
	}

	/**
	 * Get an option
	 *
	 * @param string $id - option ID
	 * @param mixed $default - default value to be returned if nothing is found
	 * @param string $theme_option - theme option ID to be searched if post option isn't found
	 *
	 * @return mixed|null
	 */
	public function get_option( $id, $default = null, $theme_option = null ){
		// check if it's a term and return its options
		if ( method_exists( $this->post, 'get_term_id' ) && $this->post->get_term_id() ){
			$options = $this->get_term_options( $id, $default );
		}elseif ( $this->post->get_post_id() ){ // check if it's a post and return its options
			$options = $this->get_post_options( $id, $default );
		}
		// if nothing is set or an error is returned, option isn't set. Get it from general theme settings
		if( !isset( $options ) || is_wp_error( $options ) ) {
			$option_name = null !== $theme_option ? $theme_option : $id;
			$options = $this->get_theme_options( $option_name, $default );
		}
		// if still no option is set, return the default
		return is_wp_error( $options ) ? $default : $options;
	}

	/**
	 * @param $id
	 * @param $default
	 *
	 * @return mixed|null
	 */
	private function get_term_options( $id, $default ){
		if( !$this->item_options ){
			$this->item_options = new Thz_Array_Flatten( $this->unyson_helper->get_term_options( $default ) );
		}
		return $this->item_options->get_option( $id, $default );
	}

	/**
	 * @param $id
	 * @param $default
	 *
	 * @return mixed|null
	 */
	private function get_post_options( $id, $default ){
		if( !$this->item_options || ( method_exists( $this->post, 'in_loop' ) && $this->post->in_loop() ) ){
			$this->item_options = new Thz_Array_Flatten( $this->unyson_helper->get_post_options( $default ) );
		}
		return $this->item_options->get_option( $id, $default );
	}

	/**
	 * @param $id
	 * @param $default
	 *
	 * @return theme
	 */
	public function get_theme_options( $id, $default ){
		if( !$this->theme_options ){
			$this->theme_options = new Thz_Array_Flatten( $this->unyson_helper->get_theme_options() );
		}
		return $this->theme_options->get_option( $id, $default );
	}

	/**
	 * @return Thz_Post_Utility_Interface
	 */
	public function _get_post(){
		return $this->post;
	}
}