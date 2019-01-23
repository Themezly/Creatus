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
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see     http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

global $product, $woocommerce_loop;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) ) {
	$woocommerce_loop['loop'] = 0;
}

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) ) {
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );
}

// Ensure visibility
if ( ! $product || ! $product->is_visible() ) {
	return;
}

// Increase loop count
$woocommerce_loop['loop']++;

// Extra post classes
$classes = array();



if ( 0 === ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 === $woocommerce_loop['columns'] ) {
	$classes[] = 'woo-first';
}
if ( 0 === $woocommerce_loop['loop'] % $woocommerce_loop['columns'] ) {
	$classes[] = 'woo-last';
}


$animate			= thz_get_theme_option('woopanim',array());
$animation_data		= thz_print_animation($animate);
$animation_class	= thz_akg('animate',$animate) == 'active' ? ' thz-woo-animate thz-animate' :'';
$animate_parent		= thz_akg('animate',$animate) == 'active' ? ' thz-animate-parent' :'';
$gutter  			= thz_get_woo_gutter();
$columns 			= thz_get_woo_columns();

if(isset($woocommerce_loop['name'],$woocommerce_loop['columns'])){
	
	$shortcodes = array(
		'products',
		'recent_products',
		'featured_products',
		'product_category',
		'product_categories',
		'featured_products',
		'best_selling_products',
		'top_rated_products'
	);
	
	if(in_array($woocommerce_loop['name'],$shortcodes)){
		
		if($woocommerce_loop['columns'] != $columns){
			$columns = $woocommerce_loop['columns'] > 6 ? 6 : $woocommerce_loop['columns'];
		}
	}
}


$classes[] 	= 'thz-grid-item';
$classes[]	= thz_col_width( $columns, 3 );
$classes[] 	= 'thz-pl-'.$gutter;
$classes[] 	= $animate_parent;
$in_cart 	= thz_woo_in_cart(thz_woo_get_id( $product )) ? ' thz-woo-item-in-cart':'';




$item_in_classes  	= $gutter.$animation_class;
$woo_item_classes  	= $in_cart;

?>
<div <?php wc_product_class( $classes ); ?>>
	<div class="thz-grid-item-in thz-mb-<?php echo thz_sanitize_class( $item_in_classes ) ?>"<?php echo thz_sanitize_data($animation_data); ?>>
		<div class="thz-woo-item<?php echo thz_sanitize_class($woo_item_classes)?>">
		<?php
		/**
		 * woocommerce_before_shop_loop_item hook.
		 *
		 * @hooked woocommerce_template_loop_product_link_open - 10
		 */
		do_action( 'woocommerce_before_shop_loop_item' );
	
		/**
		 * woocommerce_before_shop_loop_item_title hook.
		 *
		 * @hooked woocommerce_show_product_loop_sale_flash - 10
		 * @hooked woocommerce_template_loop_product_thumbnail - 10
		 */
		do_action( 'woocommerce_before_shop_loop_item_title' );
	
		/**
		 * woocommerce_shop_loop_item_title hook.
		 *
		 * @hooked woocommerce_template_loop_product_title - 10
		 */
		do_action( 'woocommerce_shop_loop_item_title' );
	
		/**
		 * woocommerce_after_shop_loop_item_title hook.
		 *
		 * @hooked woocommerce_template_loop_rating - 5
		 * @hooked woocommerce_template_loop_price - 10
		 */
		do_action( 'woocommerce_after_shop_loop_item_title' );
	
		/**
		 * woocommerce_after_shop_loop_item hook.
		 *
		 * @hooked woocommerce_template_loop_product_link_close - 5
		 * @hooked woocommerce_template_loop_add_to_cart - 10
		 */
		do_action( 'woocommerce_after_shop_loop_item' );
		?>
		</div>
	</div>
</div>