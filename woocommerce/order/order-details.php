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
 * Order details
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-details.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	https://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.5.2
 */

if ( ! $order = wc_get_order( $order_id ) ) {
	return;
}
$order_items           = $order->get_items( apply_filters( 'woocommerce_purchase_order_item_types', 'line_item' ) );
$show_purchase_note    = $order->has_status( apply_filters( 'woocommerce_purchase_note_order_statuses', array( 'completed', 'processing' ) ) );
$show_customer_details = is_user_logged_in() && $order->get_user_id() === get_current_user_id();
$downloads             = $order->get_downloadable_items();
$show_downloads        = $order->has_downloadable_item() && $order->is_download_permitted();

if ( $show_downloads ) {
	wc_get_template( 'order/order-downloads.php', array( 'downloads' => $downloads, 'show_title' => true ) );
}
?>
<h2><?php _e( 'Order Details', 'creatus' ); ?></h2>
<table class="thz-woo-table thz-table thz-table-bordered shop_table order_details">
	<thead>
		<tr>
			<th class="product-name"><?php _e( 'Product', 'creatus' ); ?></th>
			<th class="product-total"><?php _e( 'Total', 'creatus' ); ?></th>
		</tr>
	</thead>
	<tbody>
		<?php
			foreach( $order_items as $item_id => $item ) {
				$product = $item->get_product();

				wc_get_template( 'order/order-details-item.php', array(
					'order'			     => $order,
					'item_id'		     => $item_id,
					'item'			     => $item,
					'show_purchase_note' => $show_purchase_note,
					'purchase_note'	     => $product ? thz_woo_get_product_purchase_note($product) : '',
					'product'	         => $product,
				) );
			}
		?>
		<?php do_action( 'woocommerce_order_items_table', $order ); ?>
	</tbody>
	<tfoot>
	<?php
        foreach ( $order->get_order_item_totals() as $key => $total ) {
            ?>
            <tr>
                <th scope="row"><?php echo $total['label']; ?></th>
                <td><?php echo $total['value']; ?></td>
            </tr>
            <?php
        }
    ?>
    <?php if ( $order->get_customer_note() ) : ?>
        <tr>
            <th><?php _e( 'Note:', 'creatus' ); ?></th>
            <td><?php echo wptexturize( $order->get_customer_note() ); ?></td>
        </tr>
    <?php endif; ?>
	</tfoot>
</table>

<?php do_action( 'woocommerce_order_details_after_order_table', $order ); ?>

<?php
if ( $show_customer_details ) {
	wc_get_template( 'order/order-details-customer.php', array( 'order' => $order ) );
}