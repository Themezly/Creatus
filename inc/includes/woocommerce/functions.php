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
 * Get option prefix depending on which page it's being displayed
 *
 * @internal - used by other functions to determine the name of the option that should be retrieved based on the page currently displayed
 *
 * @param string $part - last part of the optin name that is common for all option types (theme options, category options and related products options)
 *
 * @return string
 */
function _thz_get_woo_loop_option_name( $part = '', $theme_option = false ){
	// theme option prefix, applies in all cases
	$prefix = is_product() ? 'woorelgrid' : 'woopst/grid';

	if( !$theme_option ) {
		// single product page, get related products grid
		if ( is_product() ) {
			$prefix = 'woorelgrid';
		} elseif ( is_product_category() ) { // category page
			$prefix = 'woo_cat/0/woopst/grid';
		}
	}

	return $prefix . '/' . $part;
}

/**
 * Get a WooCommerce loop option needed for pagination
 *
 * @internal - used by other specialized functions to quickly get an option
 *
 * @uses _thz_get_woo_loop_option_name()
 *
 * @param string $option - partial option name that is common for all option types (theme, category, post)
 * @param mixed $default - default value that should be returned if option isn't found
 *
 * @return mixed
 */
function _thz_get_woo_loop_option( $option, $default ){
	return thz_get_option(
		_thz_get_woo_loop_option_name( $option ),
		$default,
		_thz_get_woo_loop_option_name( $option, true )
	);
}

/**
 * Get number of items per page displayed on any WooCommerce page containing a loop
 *
 * @uses _thz_get_woo_loop_option()
 *
 * @param int $default - the default value that should be returned if option isn't found
 *
 * @return integer
 */
function thz_get_woo_items_per_page( $default = 9 ){
	return _thz_get_woo_loop_option( 'items', $default );
}

/**
 * Get number of columns displayed on any WooCommerce page containing a loop
 *
 * @uses _thz_get_woo_loop_option()
 *
 * @param int $default - the default value that should be returned if option isn't found
 *
 * @return integer
 */
function thz_get_woo_columns( $default = 3 ){
	return _thz_get_woo_loop_option( 'columns', $default );
}

/**
 * Get value of gutter displayed on any WooCommerce page containing a loop
 *
 * @uses _thz_get_woo_loop_option()
 *
 * @param int $default - the default value that should be returned if option isn't found
 *
 * @return integer
 */
function thz_get_woo_gutter( $default = 30 ){
	return _thz_get_woo_loop_option( 'gutter', $default );
}

/**
 * Support for 2.x and 3.x
 */

/**
 * Check if installed WooCommerce version is higher than given version
 *
 * @param string $version - version to compare against
 *
 * @return bool
 */
function thz_woo_version( $version = '2.7' ) {

	if ( function_exists( 'is_woocommerce' ) ) {

		global $woocommerce;

		return version_compare( $woocommerce->version, $version, ">=" ) ;

	}

	return false;
}

/**
 * @param $object
 *
 * @return mixed
 */
function thz_woo_get_id( $object ){
	return thz_woo_version( '2.7' ) ? $object->get_id() : $object->id;
}

/**
 * @param WC_Product $product
 *
 * @return mixed
 */
function  thz_woo_get_product_images( $product ){
	return thz_woo_version( '2.7' ) ? $product->get_gallery_image_ids() : $product->get_gallery_attachment_ids();
}

/**
 * @param $product
 *
 * @return mixed
 */
function  thz_woo_get_upsels($product){
	return thz_woo_version( '2.7' ) ? $product->get_upsell_ids() : $product->get_upsells();
}

/**
 * @param $order
 *
 * @return string
 */
function  thz_woo_get_order_date($order){
	return thz_woo_version( '2.7' ) ? wc_format_datetime( $order->get_date_created() ) : date_i18n( get_option( 'date_format' ), strtotime( $order->order_date ) );
}

/**
 * @param $order
 *
 * @return string
 */
function  thz_woo_get_payment_method_title($order){
	return thz_woo_version( '2.7' ) ? wp_kses_post( $order->get_payment_method_title() ) : $order->payment_method_title;
}

/**
 * @param $order
 *
 * @return mixed
 */
function  thz_woo_payment_method($order){
	return thz_woo_version( '2.7' ) ? $order->get_payment_method() : $order->payment_method;
}

/**
 * @param $order
 *
 * @return mixed
 */
function  thz_woo_order_customer_note($order){
	return thz_woo_version( '2.7' ) ? $order->get_customer_note() : $order->customer_note;
}

/**
 * @param $order
 *
 * @return mixed
 */
function  thz_woo_order_billing_email($order){
	return thz_woo_version( '2.7' ) ? $order->get_billing_email() : $order->billing_email;
}

/**
 * @param $order
 *
 * @return mixed
 */
function  thz_woo_order_billing_phone($order){
	return thz_woo_version( '2.7' ) ? $order->get_billing_phone() : $order->billing_phone;
}

/**
 * @param $order
 * @param $item
 *
 * @return string|void
 */
function  thz_woo_display_item_meta($order,$item){
	return thz_woo_version( '2.7' ) ? wc_display_item_meta($item) : $order->display_item_meta( $item );
}

/**
 * @param $order
 * @param $item
 *
 * @return string|void
 */
function  thz_woo_display_item_downloads($order,$item){
	return thz_woo_version( '2.7' ) ? wc_display_item_downloads($item) : $order->display_item_downloads( $item );
}

/**
 * @param $product
 *
 * @return mixed
 */
function  thz_woo_get_product_purchase_note($product){
	return thz_woo_version( '2.7' ) ? $product->get_purchase_note() : get_post_meta( $product->id, '_purchase_note', true );
}

/**
 * @param $product
 *
 * @return mixed
 */
function  thz_woo_product_type($product){
	return thz_woo_version( '2.7' ) ? $product->get_type(thz_woo_get_id( $product )) : $product->product_type;
}

/**
 * @param $product
 *
 * @return string
 */
function  thz_woo_product_rating($product){
	return thz_woo_version( '2.7' ) ? wc_get_rating_html($product->get_average_rating()) : $product->get_rating_html();
}

/**
 * @param $product
 * @param string $sep
 * @param string $before
 * @param string $after
 *
 * @return string
 */
function  thz_woo_product_get_categories($product, $sep = ', ', $before = '', $after = ''){
	return thz_woo_version( '2.7' ) ? wc_get_product_category_list( thz_woo_get_id( $product ), $sep, $before, $after ) : $product->get_categories( $sep, $before, $after );
}

/**
 * @param $product
 * @param string $sep
 * @param string $before
 * @param string $after
 *
 * @return string
 */
function  thz_woo_product_get_tags($product, $sep = ', ', $before = '', $after = ''){
	return thz_woo_version( '2.7' ) ? wc_get_product_tag_list( thz_woo_get_id( $product ), $sep, $before, $after ) : $product->get_tags( $sep, $before, $after );
}