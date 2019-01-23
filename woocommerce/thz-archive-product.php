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
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.3.0
 */
 
$prefix		= !empty(thz_get_option('woo_cat/0',array())) ? 'woo_cat/0/' : '';
$show_title	 = thz_get_option($prefix.'wooshmx/title','hide') == 'show' ? true : false;
$show_desc	 = thz_get_option($prefix.'wooshmx/desc','hide') == 'show' ? true : false;
?>

<?php if ( apply_filters( 'woocommerce_show_page_title', $show_title ) ) : ?>

	<h1 class="thz-shop-category page-title"><?php woocommerce_page_title(); ?></h1>

<?php endif; ?>	

<?php

if( $show_desc ){
	do_action( 'woocommerce_archive_description' ); 
}

if ( have_posts() ) {

	thz_woo_before_shop_loop();
	
	thz_woocommerce_subcategories();
	
	woocommerce_product_loop_start();
	

	if ( wc_get_loop_prop( 'total' ) ) {
		while ( have_posts() ) {
			the_post();

			/**
			 * Hook: woocommerce_shop_loop.
			 *
			 * @hooked WC_Structured_Data::generate_product_data() - 10
			 */
			do_action( 'woocommerce_shop_loop' );

			wc_get_template_part( 'content', 'product' );
		}
	}

	woocommerce_product_loop_end();

	/**
	 * Hook: woocommerce_after_shop_loop.
	 *
	 * @hooked woocommerce_pagination - 10
	 */
	do_action( 'woocommerce_after_shop_loop' );
	
} else {
	/**
	 * Hook: woocommerce_no_products_found.
	 *
	 * @hooked wc_no_products_found - 10
	 */
	do_action( 'woocommerce_no_products_found' );
}