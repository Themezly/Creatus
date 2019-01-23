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
 * Single Product Sale Flash
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/sale-flash.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

global $post, $product;

?>
<?php if ( $product->is_on_sale()  && $product->is_in_stock() ) : ?>

	<?php echo apply_filters( 'woocommerce_sale_flash', '<span class="thz-woo-item-badge thz-woo-item-on-sale">' . esc_html__( 'Sale!', 'creatus' ) . '</span>', $post, $product ); ?>

<?php endif; ?>
<?php if ( !$product->is_in_stock() ) : ?>

<span class="thz-woo-item-badge thz-woo-item-out-of-stock"><?php echo esc_html__( 'Out of stock!', 'creatus' ) ?></span>

<?php endif; ?>
