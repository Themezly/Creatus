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
 * The template for displaying 404 pages (not found).
 *
 */


$ebutton 	= thz_get_theme_option('ebutton/button/html');
$ebutton 	= str_replace('href="#"','href="'.get_home_url().'"',$ebutton);
$etitle 	= thz_get_theme_option('etitle') != '' ? thz_get_theme_option('etitle') : esc_html__('404','creatus');
$esub 		= thz_get_theme_option('esub') != '' ? thz_get_theme_option('esub') : esc_html__('Page not found','creatus');
$etext 		= thz_get_theme_option('etext') != '' ? thz_get_theme_option('etext') : esc_html__('The requested page could not be found.','creatus');

?>
<section class="thz-404-section error-404 not-found thz-align-center">
	<h2 class="thz-404-title"><?php echo esc_html ( $etitle ) ?></h2>
	<h3 class="thz-404-subtitle"><?php echo esc_html ( $esub ) ?></h3>
	<p class="thz-404-text"><?php echo esc_html ( $etext ) ?></p>
	<div class="thz-404-button">
		<?php echo thz_btn_print ( $ebutton ) ?>
	</div>
</section>