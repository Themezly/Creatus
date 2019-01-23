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
 * Class Thz_Loop_Post_Utility
 * Used for getting options from posts within the loop
 */
class Thz_Loop_Post_Utility implements Thz_Post_Utility_Interface{
	/**
	 * @var Thz_Item_Options
	 */
	private $options;

	/**
	 * Thz_Loop_Post_Utility constructor.
	 */
	public function __construct() {
		$this->options = new Thz_Item_Options( $this );
	}

	/**
	 * Returns current post ID in loop
	 * @return int
	 */
	public function get_post_id() {
		return $this->get_id();
	}

	/**
	 * Returns an option
	 *
	 * @param string $id - option ID
	 * @param mixed $default - default value to be returned if nothing is found
	 * @param string $theme_option - theme option ID to be searched if post option isn't found
	 *
	 * @return mixed
	 */
	public function get_option( $id, $default, $theme_option = null ) {
		return $this->options->get_option( $id, $default );
	}

	/**
	 * Check if currently in loop
	 * @return bool
	 */
	public function in_loop(){
		/**
		 * Used in custom WP_Query
		 */
		global $thz_post_in_loop;
		return ( in_the_loop() || $thz_post_in_loop ? true : false );
	}

	/**
	 * Get the current ID from the loop
	 * @return int|null
	 */
	private function get_id(){
		return ( $this->in_loop() ? get_the_ID() : null );
	}

	private function __clone() {}
	private function __wakeup() {}
}