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
 * This is header  file with menu under the header
 *
 * The inclusion is using get_template_part WP function
 *
 */
 
$an				= thz_get_option('hea',array());
$and			= thz_print_animation($an);
$anc			= thz_print_animation($an,true);
$mode 			= thz_get_option('header_mode','stacked');
$sticky 		= thz_get_option('sthe/picked','inactive');
$sticky_atype	= thz_get_option('sthe/active/type','hide');
$sticky_type 	= 'sticky-'.$sticky_atype;
$sticky_class 	=  $sticky == 'active' ? 'thz-mobile-hidden thz-tablet-hidden thz-sticky-header sticky-wait sticky-early '.$sticky_type : '';
$show_toolbar 	= thz_get_option('htb/picked','show');
$wrapper_c		= 'header-stacked-wrapper'.$anc;
$header_c		= 'thz-mobile-hidden thz-tablet-hidden header-stacked header_holder';

if($mode =='absolute'){
	$wrapper_c.=' header-mode-absolute';
}

?>
<div class="<?php echo thz_sanitize_class( $wrapper_c ) ?>"<?php echo thz_sanitize_data($and); ?>>
	<?php thz_toolbar_print( $show_toolbar ); ?>
    <header id="header_holder" class="<?php echo thz_sanitize_class( $header_c ) ?>"<?php thz_sdata('header'); ?>>
        <div class="thz-container<?php thz_contained('header_contained',true,true)?>">
            <div id="header">
                <?php echo thz_logo_print(); ?>
                <?php echo thz_stacked_header_content_print(); ?>
            </div>
        </div>
    <?php thz_video_bg_o('header_boxstyle/background') ?>
    </header>
    <?php if($sticky =='active'){ ?>
    <div class="<?php echo thz_sanitize_class($sticky_class) ?>">
    <?php } ?>
        <div id="mainmenu_holder" class="thz-poz-menu-stacked thzmega<?php thz_contained('tm_contained/picked',true,true) ?>">
            <div class="thz-container thz-menu-holder<?php thz_contained('tm_contained/notcontained/nav_contained',true,true) ?>">
                <?php thz_wp_nav_menu() ?>
            </div>
        </div>
    <?php if($sticky =='active'){ ?>
    </div>
    <?php } ?>
</div>