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
 * Class Thz_Theme_Utility
 * Utility class that can be used to return file paths from child/parent theme
 * or theme details
 *
 * Usage:
 *
 * $instance = Thz_Theme_Utility::get_instance();
 * $instance->get_theme();
 *
 *
 */
class Thz_Theme_Utility {

	private static $instance = null;

	/**
	 * @var bool
	 */
	private $is_child_theme;
	/**
	 * @var null|string
	 */
	private $child_url = null;
	/**
	 * @var null|string
	 */
	private $child_path = null;
	/**
	 * @var string
	 */
	private $parent_url;
	/**
	 * @var string
	 */
	private $parent_path;
	/**
	 * @var string
	 */
	private $cp_url = null;
	/**
	 * @var string
	 */
	private $cp_path = null;
	/**
	 * @var WP_Theme
	 */
	private $theme;

	/**
	 * Thz_Theme_Utility constructor.
	 */
	protected function __construct() {
		$this->is_child_theme = is_child_theme();
		if ( $this->is_child_theme ) {
			$this->child_url  = get_stylesheet_directory_uri();
			$this->child_path = get_stylesheet_directory();
		}
		$this->parent_url  	= get_template_directory_uri();
		$this->parent_path 	= get_template_directory();
		$this->cp_url 		= !defined('CP_URL') ? null : CP_URL;
		$this->cp_path 		= !defined('CP_PATH') ? null : CP_PATH;
		$this->theme       	= wp_get_theme( get_template() );
		
		if ( ! is_a( $this->theme, 'WP_Theme' ) ) {
			$this->theme = false;
		}
	}

	/**
	 * @return null|Thz_Theme_Utility
	 */
	public static function get_instance() {
		if ( self::$instance === null ) {
			self::$instance = new Thz_Theme_Utility();
		}

		return self::$instance;
	}

	/**
	 * If given file path exists in child theme, it will return the URL to
	 * child theme file and ignore parent theme.
	 * If no child theme present or file is missing in child theme, it will return
	 * parent URL if file existing in parent.
	 *
	 * @param $rel_path
	 *
	 * @return bool|string
	 */
	public function child_file_uri( $rel_path ) {
		return $this->get_child_file( $rel_path, 'url' );
	}

	/**
	 * @param $rel_path
	 * @param string $type
	 *
	 * @return bool|string
	 */
	private function get_child_file( $rel_path, $type = 'url' ) {
		
		if ( $this->child_file_path( $rel_path ) ) {
			return ( $type == 'url' ? $this->child_url : $this->child_path ) . $rel_path;
		} elseif ( $this->cp_file_path( $rel_path ) ) {
			return ( $type == 'url' ? $this->cp_url : $this->cp_path ) . $rel_path;
		} elseif ( $this->parent_file_path( $rel_path ) ) {
			return ( $type == 'url' ? $this->parent_url : $this->parent_path ) . $rel_path;
		}

		return false;
	}

	/**
	 * Returns the absolute path to a file within the child theme directory.
	 * If file does not exist returns false.
	 *
	 * @param $rel_path
	 *
	 * @return bool|string
	 */
	public function child_file_path( $rel_path ) {
		if ( $this->file_exists( $rel_path, 'child' ) ) {
			return $this->child_path . $rel_path;
		}

		return false;
	}

	/**
	 * @param $rel_path
	 * @param string $theme
	 *
	 * @return bool
	 */
	private function file_exists( $rel_path, $theme = 'parent' ) {
		
		$exists = false;
		
		if ( ! $this->is_child_theme && 'child' == $theme ) {
			return $exists;
		}
		
		switch( $theme ){
			case 'parent':
				$exists = file_exists ( $this->parent_path . $rel_path );
			break;
			case 'child':
				$exists = file_exists ( $this->child_path . $rel_path );
			break;
			case 'cp':
			default:
				$exists = file_exists ( $this->cp_path . $rel_path );
			break;	
		}
		
		return $exists;
		
	}

	/**
	 * Returns absolute path to file inside parent theme directory.
	 * If file isn't found returns false.
	 *
	 * @param $rel_path
	 *
	 * @return bool|string
	 */
	public function parent_file_path( $rel_path ) {
		if ( $this->file_exists( $rel_path, 'parent' ) ) {
			return $this->parent_path . $rel_path;
		}

		return false;
	}
	
	/**
	 * Returns absolute path to file inside cp theme directory.
	 * If file isn't found returns false.
	 *
	 * @param $rel_path
	 *
	 * @return bool|string
	 */
	public function cp_file_path( $rel_path ) {
		if ( $this->file_exists( $rel_path, 'cp' ) ) {
			return $this->cp_path . $rel_path;
		}

		return false;
	}
	
	/**
	 * Return array with options from specified name/path
	 *
	 * @param string $name '{theme}/inc/thzframework/theme/options/{$name}.php'
	 * @param array $variables These will be available in options file (like variables for view)
	 * @param $custom define custom path '/inc/thzframework/theme/options/'
	 * @return array
	 */
	public function get_options( $name, array $variables = array(), $custom = false ){
		
		if($custom){
			$path = $this->child_first_file_path( $custom . $name . '.php' );
		}else{
			$path = $this->child_first_file_path( '/inc/thzframework/theme/options/' . $name . '.php' );
		}
		
		if ( ! $path ) {
			return array();
		}
		$variables = thz_get_variables_from_file( $path, array( 'options' => array() ), $variables );
		return $variables['options'];	
		
	}
	
	/**
	 * If given file path exists in child theme, it will return the path to
	 * child theme file and ignore parent theme.
	 * If no child theme present or file is missing in child theme, it will return
	 * parent path if file existing in parent.
	 *
	 * @param $rel_path
	 *
	 * @return bool|string
	 */
	public function child_first_file_path( $rel_path ) {
		return $this->get_child_file( $rel_path, 'path' );
	}

	/**
	 * @return null|string
	 */
	public function get_child_path() {
		return $this->child_path;
	}

	/**
	 * @return string
	 */
	public function get_parent_path() {
		return $this->parent_path;
	}
	
	/**
	 * @return null|string
	 */
	public function get_cp_path() {
		return $this->cp_path;
	}

	/**
	 * @return null|string
	 */
	public function get_child_uri() {
		return $this->child_url;
	}

	/**
	 * @return string
	 */
	public function get_parent_uri() {
		return $this->parent_url;
	}
	
	/**
	 * @return null|string
	 */
	public function get_cp_uri() {
		return $this->cp_url;
	}

	/**
	 * @return bool|WP_Theme
	 */
	public function get_theme() {
		return $this->theme;
	}

	/**
	 * @return bool
	 */
	public function is_child_theme() {
		return $this->is_child_theme;
	}
}



/**
 * @return Thz_Theme_Utility instance
 */
function thz_theme() {

	static $THZTHEME = null; // cache
	
	if ($THZTHEME === null) {
		$THZTHEME = Thz_Theme_Utility::get_instance();
	}
	
	return $THZTHEME;
}