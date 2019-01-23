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
 * Order Customer Details
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-details-customer.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	http://docs.woothemes.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.4
 */
 
$show_shipping = ! wc_ship_to_billing_address_only() && $order->needs_shipping_address();
?>
<?php if ( $show_shipping ) : ?>
<h2>
	<?php esc_html_e( 'Your Details', 'creatus' ); ?>
</h2>
<table class="thz-woo-table thz-table thz-table-bordered shop_table customer_details">
	<?php if ( thz_woo_order_customer_note($order) ) : ?>
	<tr>
		<th>
			<?php _e( 'Note:', 'creatus' ); ?>
		</th>
		<td><?php echo wptexturize( thz_woo_order_customer_note($order) ); ?></td>
	</tr>
	<?php endif; ?>
	<?php if ( thz_woo_order_billing_email($order) ) : ?>
	<tr>
		<th>
			<?php _e( 'Email:', 'creatus' ); ?>
		</th>
		<td><?php echo esc_html( thz_woo_order_billing_email($order) ); ?></td>
	</tr>
	<?php endif; ?>
	<?php if ( thz_woo_order_billing_phone( $order ) ) : ?>
	<tr>
		<th>
			<?php _e( 'Telephone:', 'creatus' ); ?>
		</th>
		<td><?php echo esc_html( thz_woo_order_billing_phone( $order ) ); ?></td>
	</tr>
	<?php endif; ?>
	<?php do_action( 'woocommerce_order_details_after_customer_details', $order ); ?>
</table>
<?php endif; ?>


<div class="col2-set addresses">
	<div class="col-1">
        <header class="title">
            <h3>
                <?php esc_html_e( 'Billing Address', 'creatus' ); ?>
            </h3>
        </header>
		<address>
		<?php echo ( $address = $order->get_formatted_billing_address() ) ? $address : esc_html__( 'N/A', 'creatus' ); ?>
		</address>
	</div>
	<!-- /.col-1 -->
    <?php if ( $show_shipping ) : ?>
	<div class="col-2">
		<header class="title">
			<h3>
				<?php esc_html_e( 'Shipping Address', 'creatus' ); ?>
			</h3>
		</header>
		<address>
		<?php echo ( $address = $order->get_formatted_shipping_address() ) ? $address : esc_html__( 'N/A', 'creatus' ); ?>
		</address>
	</div>
	<!-- /.col-2 -->
    <?php endif; ?>
</div>
<!-- /.col2-set -->


