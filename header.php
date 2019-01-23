<?php
/**
 * @package      Thz Framework
 * @author       Themezly
 * @websites     http://www.themezly.com | http://www.youjoomla.com | http://www.yjsimplegrid.com
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // No direct access
}
?>
<!DOCTYPE html>
<html id="thz-site-html" <?php language_attributes(); ?> class="<?php thz_html_classes(); ?>">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php wp_head(); ?>
<?php thz_print_codes('before_head',true); ?>
</head>
<body <?php body_class();thz_sdata('body');thz_body_data(); ?>><?php thz_preloader();thz_print_body_frame();thz_print_codes('after_body',true); ?>
	<div id="thz-body-box" class="thz-body-box">
    	<div id="thz-body-container" class="thz-body-container">
        	<?php thz_above_header('out'); ?>
            <div id="thz-wrapper" class="thz-wrapper<?php thz_layout(); ?>">
                <?php thz_site_header('left'); ?>
                <div class="thz-wrapper-inner">
                <?php thz_above_header('in'); ?>
                <?php thz_site_header('main'); ?>
                <?php get_template_part( 'template-parts/mobile', 'menu'); ?>
                <?php thz_page_block('under_header'); ?>
				<?php thz_hero_section('under'); ?>
                <?php thz_page_block('under_hero'); ?>
                <?php thz_page_title_section(); ?>
                <?php thz_widgets_section_print('uh','under_header_section'); ?>
                <?php thz_site_main_start();thz_flash_fw_msg(); ?>