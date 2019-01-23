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
 * Class Thz_Main_Page_Utility
 */
class Thz_Main_Page_Utility implements Thz_Post_Utility_Interface{
	/**
	 * Store ID of post/page/custom post being displayed
	 * @var null|int
	 */
	private $post_id = null;
	/**
	 * Store ID of category/tag/taxonomy page being displayed
	 * @var null|int
	 */
	private $term_id = null;
	/**
	 * Store ID of author if author page is displayed
	 * @var null|int
	 */
	private $author_id = null;
	/**
	 * Stores the queried object
	 * @var mixed
	 */
	private $queried_object = null;
	/**
	 * @var Thz_Item_Options
	 */
	private $options;
	/**
	 * @var Thz_Main_Page_Options
	 */
	private $page_options;

	/**
	 * Thz_Main_Page_Utility constructor.
	 */
	public function __construct() {
		if( did_action( 'wp' ) ){
			_doing_it_wrong( __METHOD__, __( 'Class should be instantiated before "wp" action is triggered because it uses this hook to set the ID of the currently displaying page.', 'creatus' ) );
		}
		// hook early to get queried object
		add_action( 'pre_get_posts', array( $this, 'parse_query' ), -9999 );

		$this->options = new Thz_Item_Options( $this );
		$this->page_options = new Thz_Main_Page_Options( $this );
	}

	/**
	 * Callback function for pre_get_posts action
	 * @param WP_Query $q
	 */
	public function parse_query( $q ){
		if( !$q->is_main_query() ){
			return;
		}
		if( !is_author() ){
			$this->object_queried( $q );
		}
		if( !$this->get_queried_object() ){
			// hook a bit later too in case "pre_get_posts" hook callback didn't catch anything
			add_action( 'wp', array( $this, 'object_queried' ), -9999 );
		}
	}

	/**
	 * @param WP $wp
	 * @internal - used as callback on action "wp" to set the current queried object and post/term/author ID
	 */
	public function object_queried( $wp ){
		$object = get_queried_object();
		// in some cases, for example if an image isn't found, the hook is triggered again and queried object is NULL. Avoid this.
		if( !$object ){
			return;
		}

		/**
		 * Queried object has ID, store it depending on its type
		 */
		if( isset( $object->ID ) ){
			if( is_a( $object, 'WP_User' ) ){
				$this->author_id = $object->ID;
			}else {
				$this->post_id = $object->ID;
			}
			$this->_clear_action();
		}

		// check if displaying custom post type archive
		if( is_a( $object, 'WP_Post_Type' ) ){
			// check if displaying WooCommerce shop page
			if( class_exists( 'WooCommerce' ) && is_shop() ){
				$this->post_id = wc_get_page_id( 'shop' );
				$this->_clear_action();
			}
		}

		// detect terms
		if( is_a( $object, 'WP_Term' ) ){
			if( isset( $object->term_id ) ){
				$this->term_id = $object->term_id;
				$this->_clear_action();
			}
		}
		// store queried object
		$this->queried_object = $object;
	}

	/**
	 * Getter for post ID
	 * @return int|null
	 */
	public function get_post_id(){
		return $this->post_id;
	}

	/**
	 * Getter for term ID
	 * @return int|null
	 */
	public function get_term_id(){
		return $this->term_id;
	}

	/**
	 * Getter for author ID
	 * @return int|null
	 */
	public function get_author_id(){
		return $this->author_id;
	}

	/**
	 * Get option
	 *
	 * @param string $id - option ID
	 * @param mixed $default - default value to be returned if nothing is found
	 * @param string $theme_option - theme option ID to be searched if post option isn't found
	 *
	 * @return mixed|null|theme
	 */
	public function get_option( $id, $default, $theme_option = null ){
		// get option from predefined set of options
		$option = $this->page_options->get_option( $id, $default );
		if( !is_wp_error( $option ) ){
			return $option;
		}

		// get option from main page options
		return $this->options->get_option( $id, $default, $theme_option );
	}

	/**
	 * Return all options
	 * @return array|null
	 */
	public function get_options(){
		return $this->page_options->get_options();
	}

	/**
	 * Returns only the page option, without defaulting to theme option.
	 * Useful if trying to find if an option is set in page (item actually,
	 * which includes posts, pages, taxonomies) settings
	 *
	 * @param $id
	 * @param $default
	 *
	 * @return mixed|null
	 */
	public function get_page_option( $id, $default ){
		// get option from predefined set of options
		$option = $this->page_options->get_option( $id, $default, true );
		return is_wp_error( $option ) ? $default : $option;
	}

	/**
	 * @return mixed|object
	 */
	public function get_queried_object(){
		return $this->queried_object;
	}

	/**
	 * @return Thz_Item_Options
	 */
	public function get_options_obj(){
		return $this->options;
	}

	/**
	 * Removes action that is triggered when WP is ready
	 * @return void
	 */
	private function _clear_action(){
		remove_action( 'wp', array( $this, 'object_queried' ), -9999 );
	}
}