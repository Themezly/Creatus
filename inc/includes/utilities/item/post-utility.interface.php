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
 * Interface Thz_Post_Utility_Interface
 */
interface Thz_Post_Utility_Interface{
	/**
	 * Returns current post ID
	 * @return int
	 */
	public function get_post_id();

	/**
	 * Returns an option
	 * @param $id
	 * @param $default
	 *
	 * @return mixed
	 */
	public function get_option( $id, $default, $theme_option );
}