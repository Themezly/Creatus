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
 * This is header file with menu inside the header
 * menu location is right of the logo
 *
 * The inclusion is using get_template_part WP function
 *
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // No direct access
}
$an				= thz_get_option('hea',array());
$and			= thz_print_animation($an);
$anc			= thz_print_animation($an,true);
$sticky 		= thz_get_option('sthe/picked','inactive');
$mode 			= ' header-mode-'.thz_get_option('header_mode','stacked');
$sticky_atype	= thz_get_option('sthe/active/type','hide');
$sticky_type 	= 'sticky-'.$sticky_atype;
$sticky_class 	= $sticky == 'active' ? ' thz-sticky-header sticky-wait '.$sticky_type :'';
$show_toolbar 	= thz_get_option('htb/picked','show');
$menu_pos 		= thz_get_option('htmp','right');
$header_classes = 'thz-mobile-hidden thz-tablet-hidden thz-header-menu-'.$menu_pos.' header-inline header_holder'.$sticky_class.$mode.$anc;
?>
<header id="header_holder" class="<?php echo thz_sanitize_class( $header_classes) ?>"<?php thz_sdata('header')?><?php echo thz_sanitize_data($and); ?>>
	<?php thz_toolbar_print( $show_toolbar ); ?>	
	<div class="thz-container<?php thz_contained('header_contained',true,true)?>">
		<div id="header">
			<?php echo thz_logo_print() ?>
			<div id="mainmenu_holder" class="thzmega thz-poz-menu-<?php echo thz_sanitize_class( $menu_pos ) ?>">
				<div class="thz-menu-holder">
					<?php thz_wp_nav_menu(); ?>
				</div>
			</div>
		</div>
	</div>
<?php thz_video_bg_o('header_boxstyle/background') ?>
</header>