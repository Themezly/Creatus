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
 * Class Thz_Unyson_Helper
 *
 * Helper class that checks and returns Unyson options or defaults depending whether
 * Unyson is loaded or not.
 */
class Thz_Unyson_Helper{
	/**
	 * @var Thz_Item_Options
	 */
	private $item;

	/**
	 * Thz_Unyson_Helper constructor.
	 *
	 * @param Thz_Item_Options $item
	 */
	public function __construct( Thz_Item_Options $item ) {
		$this->item = $item;
	}

	/**
	 * @param $default
	 *
	 * @return mixed|null
	 */
	public function get_post_options( $default ){
		return $this->unyson_loaded() ?
			fw_get_db_post_option( $this->item->_get_post()->get_post_id() ) :
			$default;
	}

	/**
	 * @param $default
	 *
	 * @return mixed|null
	 */
	public function get_term_options( $default ){
		return $this->unyson_loaded() ?
			fw_get_db_term_option( $this->item->_get_post()->get_term_id(), $this->item->_get_post()->get_queried_object()->taxonomy ) :
			$default;
	}

	/**
	 * @return array|mixed|null|object|void
	 */
	public function get_theme_options(){
		return $this->unyson_loaded() ?
			fw_get_db_settings_option() :
			thz_get_default_theme_options();
	}

	/**
	 * @return bool
	 */
	private function unyson_loaded(){
		return thz_fw_loaded();
	}
}