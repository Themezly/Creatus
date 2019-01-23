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
 * Thankyou page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.2.0
 */

if ( $order ) : ?>

	<?php if ( $order->has_status( 'failed' ) ) : ?>

		<p class="woocommerce-thankyou-order-failed"><?php _e( 'Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'creatus' ); ?></p>

		<p class="woocommerce-thankyou-order-failed-actions">
			<a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" class="button pay"><?php _e( 'Pay', 'creatus' ) ?></a>
			<?php if ( is_user_logged_in() ) : ?>
				<a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" class="button pay"><?php _e( 'My Account', 'creatus' ); ?></a>
			<?php endif; ?>
		</p>

	<?php else : ?>

		<h3 class="woocommerce-thankyou-order-received">
			<?php echo apply_filters( 'woocommerce_thankyou_order_received_text', esc_html__( 'Thank you. Your order has been received.', 'creatus' ), $order ); ?>
		</h3>

		<table class="thz-woo-table thz-table thz-table-bordered thz-woo-thankyou-order-details">
			<thead>
				<tr>
					<th class="order-name">
						<?php _e( 'Order Number', 'creatus' ); ?>
					</th>
					<th class="order-date">
						<?php _e( 'Date', 'creatus' ); ?>
					</th>
					<th class="order-total">
						<?php _e( 'Total', 'creatus' ); ?>
					</th>
					<th class="order-method">
						<?php _e( 'Payment Method', 'creatus' ); ?>
					</th>
				</tr>
			</thead>
			<tbody>
				<tr class="order_item">
					<td class="order-name">
						<?php echo $order->get_order_number(); ?>
					</td>
					<td class="order-date">
						<?php echo thz_woo_get_order_date( $order ) ?>
					</td>
					<td class="order-total">
						<?php echo $order->get_formatted_order_total(); ?>
					</td>
					<td class="order-method">
						<?php echo thz_woo_get_payment_method_title( $order ) ?>
					</td>
				</tr>
			</tbody>
		</table>

	<?php endif; ?>

	<?php do_action( 'woocommerce_thankyou_' . thz_woo_payment_method($order), thz_woo_get_id( $order ) ); ?>
	<?php do_action( 'woocommerce_thankyou', thz_woo_get_id( $order ) ); ?>

<?php else : ?>

	<h3 class="woocommerce-thankyou-order-received">
		<?php echo apply_filters( 'woocommerce_thankyou_order_received_text', esc_html__( 'Thank you. Your order has been received.', 'creatus' ), null ); ?>
	</h3>
<?php endif; ?>
