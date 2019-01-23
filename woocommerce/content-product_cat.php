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
 * The template for displaying product category thumbnails within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product_cat.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see     http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.6.1
 */

global $woocommerce_loop;

// Store loop count we're currently on.
if ( empty( $woocommerce_loop['loop'] ) ) {
	$woocommerce_loop['loop'] = 0;
}

// Store column count for displaying the grid.
if ( empty( $woocommerce_loop['columns'] ) ) {
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );
}

// Increase loop count.
$woocommerce_loop['loop']++;


$args = array(
    'type'                     => 'product',
    'parent'                   => get_queried_object_id(),
    'hide_empty'               => true,
    'hierarchical'             => 1,
    'taxonomy'                 => 'product_cat',
    'pad_counts'               => false
);

$cats 		= get_categories( $args );
$prefix		= !empty(thz_get_option('woo_cat/0',array())) ? 'woo_cat/0/' : '';
$gutter  	= thz_get_option($prefix.'wooscst/gutter',30);
$columns 	= count($cats) > 3 ? 3 : count($cats);
$classes 	= 'thz-grid-item '.thz_col_width( $columns, 3 ).' thz-pl-'.$gutter;
?>
<div class="<?php echo thz_sanitize_class($classes) ?> thz-woo-item-category">
	<div class="thz-grid-item-in thz-mb-<?php echo esc_attr( $gutter ) ?>">
		<div class="thz-woo-sub-category">
		<?php
		/**
		 * woocommerce_before_subcategory hook.
		 *
		 * @hooked woocommerce_template_loop_category_link_open - 10
		 */
		do_action( 'woocommerce_before_subcategory', $category );
	
		/**
		 * woocommerce_before_subcategory_title hook.
		 *
		 * @hooked woocommerce_subcategory_thumbnail - 10
		 */
		do_action( 'woocommerce_before_subcategory_title', $category );
	
		/**
		 * woocommerce_shop_loop_subcategory_title hook.
		 *
		 * @hooked woocommerce_template_loop_category_title - 10
		 */
		do_action( 'woocommerce_shop_loop_subcategory_title', $category );
	
		/**
		 * woocommerce_after_subcategory_title hook.
		 */
		do_action( 'woocommerce_after_subcategory_title', $category );
	
		/**
		 * woocommerce_after_subcategory hook.
		 *
		 * @hooked woocommerce_template_loop_category_link_close - 10
		 */
		do_action( 'woocommerce_after_subcategory', $category ); ?>
		</div>
	</div>
</div>