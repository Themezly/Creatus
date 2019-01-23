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
 * Product Loop Start
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/loop-start.php.
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
$columns  		= thz_get_woo_columns();
$gutter  		= thz_get_woo_gutter();
?>
<div class="thz-clear"></div>
<div class="thz-items-grid-holder thz-woo-grid-holder thz-grid-has-col-<?php echo esc_attr( $columns )?>">
	<div class="thz-items-grid thz-woo-products thz-ml-n<?php echo esc_attr( $gutter )?>">
