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
 * Single Product Meta
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/meta.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.0.0
 */

global $post, $product;

$cat_count 			= get_the_terms( $post->ID, 'product_cat' )? sizeof( get_the_terms( $post->ID, 'product_cat' ) ) : 0;
$tag_count 			= get_the_terms( $post->ID, 'product_tag' ) ? sizeof( get_the_terms( $post->ID, 'product_tag' ) ) : 0;
$show_shares 		= thz_get_option('woopsh/picked','show');
$sharing_label 		= thz_get_option('woopsh/show/sharing_label',null);

if($show_shares =='show'){
	$woopsh_style = thz_get_option('woopsh/show/im/s','simple');
	$woopsh_shape = thz_get_option('woopsh/show/im/sh','square');
	$woopsh_shclass = $woopsh_style !='simple' ? ' thz-so-'.$woopsh_shape :'';
	$woopsh_class =' thz-so-'.$woopsh_style.$woopsh_shclass;
}
?>
<div class="thz-product-meta-container">

	<?php do_action( 'woocommerce_product_meta_start' ); ?>

	<?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>
		<div class="thz-product-meta">
			<div class="thz-product-meta-table">
				<div class="thz-product-meta-cell thz-product-meta-label">
					<?php _e( 'SKU:', 'creatus' ); ?>
				</div>
				<div class="thz-product-meta-cell thz-product-meta-info" itemprop="sku">
					<div class="thz-product-info-in">
					<?php echo ( $sku = $product->get_sku() ) ? $sku : esc_html__( 'N/A', 'creatus' ); ?>
					</div>
				</div>
			</div>
		</div>
	<?php endif; ?>
	
	<div class="thz-product-meta">
		<div class="thz-product-meta-table">
			<div class="thz-product-meta-cell thz-product-meta-label">
				<?php echo _n( 'Category:', 'Categories:', $cat_count, 'creatus' ); ?>
			</div>
			<div class="thz-product-meta-cell thz-product-meta-info" itemprop="sku">
				<div class="thz-product-info-in">
				<?php echo thz_woo_product_get_categories($product, ', ' ); ?>
				</div>
			</div>
		</div>
	</div>
	<?php if(thz_woo_product_get_tags($product)) { ?>
	<div class="thz-product-meta">
		<div class="thz-product-meta-table">
			<div class="thz-product-meta-cell thz-product-meta-label">
				<?php echo _n( 'Tag:', 'Tags:', $tag_count, 'creatus' ); ?>
			</div>
			<div class="thz-product-meta-cell thz-product-meta-info" itemprop="sku">
				<div class="thz-product-info-in">
				<?php echo thz_woo_product_get_tags($product, ', ' ); ?>
				</div>
			</div>
		</div>
	</div>	
	<?php } ?>

	<?php do_action( 'woocommerce_product_meta_end' ); ?>
	
	<?php if ( thz_has_shares() && $show_shares =='show' ) { ?>
	<div class="thz-product-meta">
		<div class="thz-product-meta-table">
			<div class="thz-product-meta-cell thz-product-meta-label">
				<?php echo esc_html( $sharing_label ); ?>
			</div>
			<div class="thz-product-meta-cell thz-product-meta-info thz-product-shares<?php echo thz_sanitize_class($woopsh_class) ?>" itemprop="sku">
				<div class="thz-product-info-in">
				<?php thz_core_post_shares(true,false,'hide') ?>
				</div>
			</div>
		</div>
	</div>	
	<?php } ?>
</div>