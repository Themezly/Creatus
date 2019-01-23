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
 * Cross-sells
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cross-sells.php.
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


global $product, $woocommerce_loop;

$crosssells = WC()->cart->get_cross_sells();

if ( 0 === sizeof( $crosssells ) ) return;

$meta_query = WC()->query->get_meta_query();

$args = array(
	'post_type'           => 'product',
	'ignore_sticky_posts' => 1,
	'no_found_rows'       => 1,
	'posts_per_page'      => thz_get_theme_option('woocrgrid/items',4),
	'orderby'             => $orderby,
	'post__in'            => $crosssells,
	'meta_query'          => $meta_query
);

$products = new WP_Query( $args );

$woocommerce_loop['columns'] = apply_filters( 'woocommerce_cross_sells_columns', $columns );


$gutter  	= thz_get_theme_option('woocrgrid/gutter',30);
$columns 	= thz_get_theme_option('woocrgrid/columns',3);
$slickdata 	= ' data-space="'.$gutter.'" data-speed="300" data-dots="outside" data-autoplay="0" ';
$slickdata .= 'data-autoplaySpeed="3000" data-fade="0" data-slidesToShow="'.$columns.'" data-slidesToScroll="'.$columns.'" data-infinite="0"';
$slider_active	= count($crosssells) > 1 ? 'thz-slick-active' :'thz-slick-inactive';
if ( $products->have_posts() ) : ?>
<div class="thz-woo-cross-sells-holder">
	<h3 class="thz-woo-cross-sells-heading">
		<?php _e( 'You may be interested in&hellip;', 'creatus' ) ?>
	</h3>
	<div class="thz-slick-holder thz-slick-show-multiple thz-woo-item-rel-holder">
		<div class="thz-slick-slider <?php echo thz_sanitize_class($slider_active)?> thz-slick-initiating"<?php echo $slickdata?>>
			<?php while ( $products->have_posts() ) : $products->the_post(); ?>
			<div class="thz-slick-slide" data-type="image">
				<div class="thz-slick-slide-in">
					<?php wc_get_template_part( 'content', 'product_rel' ); ?>
				</div>
			</div>
			<?php endwhile; // end of the loop. ?>
		</div>
	</div>
</div>
<?php endif;

wp_reset_query();

