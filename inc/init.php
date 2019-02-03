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

class Thz_Theme_Includes {
	/**
	 * Store relative path for includes inside theme folder (ie. /inc )
	 * @var string|null
	 */
	private static $rel_path = null;
	/**
	 * Check if class initialized already
	 * @var bool
	 */
	private static $initialized = false;
	/**
	 * @var Thz_Theme_Utility
	 */
	private static $path_utility = null;

	/**
	 * Private constructor, use init() to fire up the class
	 * Thz_Theme_Includes constructor.
	 */
	private function __construct() {
	}

	/**
	 * @param string $rel_path - relative path of includes inside theme folder
	 * @param Thz_Theme_Utility $path_utility - instance of Thz_Theme_Utility class
	 */
	public static function init( /*string*/ $rel_path, Thz_Theme_Utility $path_utility ) {
		if ( self::$initialized ) {
			return;
		} else {
			self::$initialized = true;
		}

		self::$path_utility = $path_utility;
		self::$rel_path     = $rel_path;
		// include necessary files, child theme first
		self::include_child_first( '/utility.php' );
		self::include_child_first( '/media-utility.php' );
		self::include_child_first( '/helpers.php' );
		self::include_child_first( '/fonts-utility.php' );
		self::include_child_first( '/css-helpers.php' );
		self::include_child_first( '/hooks.php' );
		self::include_all_child_first( '/includes' );
		self::include_customizer();

		add_action( 'init', array( __CLASS__, '_action_init' ) );
		add_action( 'widgets_init', array( __CLASS__, '_action_widgets_init' ) );

		/**
		 * Only frontend
		 */
		if ( ! is_admin() ) {
			add_action( 'wp_enqueue_scripts', array( __CLASS__, '_action_enqueue_scripts' ),
				20 // Include later to be able to make wp_dequeue_style|script()
			);
		}
		
	}

	/**
	 * Load all necessary customizer files
	 */
	private static function include_customizer(){
		// load the customizer
		if( is_admin() || is_customize_preview() ) {
			$abs_path = self::$path_utility->get_parent_path() . '/inc/includes/utilities/customizer/';
			$files    = array(
				'class-thz-customizer.php'
			);
			foreach ( $files as $file ) {
				require_once $abs_path . $file;
			}
		}
	}
	
	/**
	 * Include necessary files, will check if file exists in child theme and will include it
	 * before inclusion of parent theme file
	 *
	 * @param $rel_path
	 */
	public static function include_child_first( $rel_path ) {
		// file relative path is the same for both child and parent theme
		$rel_path = self::get_rel_path( $rel_path );

		// include child theme file if found
		$file = self::$path_utility->child_file_path( $rel_path );
		if ( $file ) {
			self::include_isolated( $file, false );
		}

		// include parent theme file if found
		$file = self::$path_utility->parent_file_path( $rel_path );
		if ( $file ) {
			self::include_isolated( $file, false );
		}
	}

	/**
	 * Returns a complete relative path within the theme folder
	 * @param string $append
	 *
	 * @return string
	 */
	private static function get_rel_path( $append = '' ) {
		return self::$rel_path . $append;
	}

	/**
	 * Simple file inclusion
	 * @param string $path - absolute path to file
	 * @param boolean $check_exists - check if file exists first (true) or do the include
	 */
	public static function include_isolated( $path, $check_exists = true ) {
		if( $check_exists ) {
			if( file_exists( $path ) ) {
				include $path;
			}
		}else{
			include $path;
		}
	}

	/**
	 * @param $dir_rel_path
	 */
	private static function include_all_child_first( $dir_rel_path ) {
		$files = self::get_includes_files_list( $dir_rel_path );
		foreach ( $files as $file ) {
			self::include_isolated( $file, true );
		}
		unset( $files );
	}

	/**
	 * @param $dir_rel_path
	 *
	 * @return array
	 */
	private static function get_includes_files_list( $dir_rel_path ) {
		$path = self::$path_utility->get_parent_path() . self::get_rel_path( $dir_rel_path ) . '/';
		$includes_files_list = array(
			$path . 'option-types.php',
			$path . 'class-thz-item-utility.php',
			$path . 'classes-thz-menu-walkers.php',
			$path . 'class-thz-doc.php',
			$path . 'class-thz-dynamic-css.php',
			$path . 'class-thz-generate-css.php',
			$path . 'thz-assign-layout.php',
			$path . 'thz-widgets-generator.php',
			$path . 'class-thz-color.php'
		);
		// admin area only files includes
		if ( is_admin() || is_customize_preview() ) {
			$includes_files_list[] = $path . 'sub-includes.php';
			$includes_files_list[] = $path . 'class-tgm-plugin-activation.php';
		}
		// include only if bbPress is installed
		if ( class_exists( 'bbPress' ) ) {
			$includes_files_list[] = $path . 'thz-bb-bp-hooks.php';
		}
		// include only if WooCommerce is installed
		if ( class_exists( 'WooCommerce' ) ) {
			$includes_files_list[] = $path . 'woocommerce/functions.php';
			$includes_files_list[] = $path . 'woocommerce/hooks.php';
		}

		/**
		 * Action that gets triggered before all theme includes are
		 * actually added into the page.
		 * Can be used in child themes to include custom files.
		 */
		do_action( 'thz_filter_init_includes' );

		return $includes_files_list;
	}

	/**
	 * @internal
	 */
	public static function _action_enqueue_scripts() {
		self::include_child_first( '/static.php' );
	}

	/**
	 * @internal
	 */
	public static function _action_init() {
		self::include_child_first( '/menus.php' );
		self::include_child_first( '/posts.php' );
	}

	/**
	 * @internal
	 */
	public static function _action_widgets_init() {
		$paths = array();
		if ( self::$path_utility->is_child_theme() ) {
			$paths[] = self::$path_utility->get_child_path() . self::get_rel_path( '/widgets' );
		}
		$paths[] = self::$path_utility->get_parent_path() . self::get_rel_path( '/widgets' );

		$included_widgets = array();

		foreach ( $paths as $path ) {
			$dirs = glob( $path . '/*', GLOB_ONLYDIR );

			if ( ! $dirs ) {
				continue;
			}

			foreach ( $dirs as $dir ) {
				$dirname = basename( $dir );

				if ( isset( $included_widgets[ $dirname ] ) ) {
					// this happens when a widget in child theme wants to overwrite the widget from parent theme
					continue;
				} else {
					$included_widgets[ $dirname ] = true;
				}

				self::include_isolated( $dir . '/class-widget-' . $dirname . '.php', false );

				register_widget( 'Widget_' . self::dirname_to_classname( $dirname ) );
			}
		}
	}

	/**
	 * @param string $dirname 'foo-bar'
	 *
	 * @return string 'Foo_Bar'
	 */
	private static function dirname_to_classname( $dirname ) {
		$class_name = explode( '-', $dirname );
		$class_name = array_map( 'ucfirst', $class_name );
		$class_name = implode( '_', $class_name );

		return $class_name;
	}
}

require_once get_template_directory() . '/inc/includes/class-thz-theme-utility.php';
Thz_Theme_Includes::init( '/inc', Thz_Theme_Utility::get_instance() );
