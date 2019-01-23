<?php
/**
 * @package      Thz Framework
 * @author       Themezly
 * @websites     http://www.themezly.com | http://www.youjoomla.com | http://www.yjsimplegrid.com
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // No direct access
}
/**
 * Single variation cart button
 *
 * @see 	http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

global $product;
?>
<div class="woocommerce-variation-add-to-cart variations_button">
	<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

	<?php
	do_action( 'woocommerce_before_add_to_cart_quantity' );
	woocommerce_quantity_input( array(
		'min_value'   => apply_filters( 'woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product ),
		'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product ),
		'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( wp_unslash( $_POST['quantity'] ) ) : $product->get_min_purchase_quantity(), // WPCS: CSRF ok, input var ok.
	) );
	do_action( 'woocommerce_after_add_to_cart_quantity' );
	?>
	<button type="submit" class="single_add_to_cart_button button alt">
			<?php echo esc_html( $product->single_add_to_cart_text() ); ?>
	</button>
    <?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
	<input type="hidden" name="add-to-cart" value="<?php echo absint( thz_woo_get_id( $product ) ); ?>" />
	<input type="hidden" name="product_id" value="<?php echo absint( thz_woo_get_id( $product ) ); ?>" />
	<input type="hidden" name="variation_id" class="variation_id" value="0" />
</div>
