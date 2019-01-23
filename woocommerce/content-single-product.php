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
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.4.0
 */
$show_product_nav = thz_get_option('woonav_mx/v','show');
$wooimgcol 	= thz_get_option('wooimgcol/w','thz-col-1-2');
$woosumcol	= $wooimgcol;
if('thz-col-1-3' == $wooimgcol ) {
	
	$woosumcol = 'thz-col-2-3';
	
}elseif('thz-col-1-4' == $wooimgcol ) {
	
	$woosumcol = 'thz-col-3-4';
	
}elseif('thz-col-2-3' == $wooimgcol ) {
	
	$woosumcol = 'thz-col-1-3';
	
}elseif('thz-col-3-4' == $wooimgcol ) {
	
	$woosumcol = 'thz-col-1-4';
}
?>

<?php
	/**
	 * woocommerce_before_single_product hook.
	 *
	 * @hooked wc_print_notices - 10
	 */
	 do_action( 'woocommerce_before_single_product' );

	 if ( post_password_required() ) {
	 	echo get_the_password_form();
	 	return;
	 }
?>
<?php if (thz_woo_version( '2.7' )) {?>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class(); ?>>
<?php }else{ ?>
<div itemscope itemtype="<?php echo woocommerce_get_product_schema(); ?>" id="product-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php } ?>
	<div class="thz-product-details-row thz-content-row">
        <div class="thz-product-details-holder<?php thz_single_cmx('woodetails_mx') ?>">
            <div class="thz-max-holder<?php thz_single_cmx('woodetails_mx',true) ?>">
                <div class="thz-row thz-woo-details-row">
                    <?php
                        /**
                         * woocommerce_before_single_product_summary hook.
                         *
                         * @hooked woocommerce_show_product_sale_flash - 10
                         * @hooked woocommerce_show_product_images - 20
                         */
                        do_action( 'woocommerce_before_single_product_summary' );
                    ?>
                    <div class="thz-column <?php echo thz_sanitize_class( $woosumcol ) ?>">
                        <div class="summary entry-summary">
                    
                            <?php
                                /**
                                 * woocommerce_single_product_summary hook.
                                 *
                                 * @hooked woocommerce_template_single_title - 5
                                 * @hooked woocommerce_template_single_rating - 10
                                 * @hooked woocommerce_template_single_price - 10
                                 * @hooked woocommerce_template_single_excerpt - 20
                                 * @hooked woocommerce_template_single_add_to_cart - 30
                                 * @hooked woocommerce_template_single_meta - 40
                                 * @hooked woocommerce_template_single_sharing - 50
                                 */
                                do_action( 'woocommerce_single_product_summary' );
                            ?>
                    
                        </div><!-- .summary -->
                   </div>
                </div>
            </div>
        </div>
    </div>
	<?php
		/**
		 * woocommerce_after_single_product_summary hook.
		 *
		 * @hooked woocommerce_output_product_data_tabs - 10
		 * @hooked woocommerce_upsell_display - 15
		 * @hooked woocommerce_output_related_products - 20
		 */
		do_action( 'woocommerce_after_single_product_summary' );
	?>

	<meta itemprop="url" content="<?php the_permalink(); ?>" />

</div><!-- #product-<?php the_ID(); ?> -->

<?php do_action( 'woocommerce_after_single_product' ); ?>
<?php thz_single_post_navigation('inside'); ?>