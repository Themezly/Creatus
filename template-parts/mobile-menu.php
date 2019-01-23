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
 * The template for displaying mobile menu.
 */
?>
<div class="thz-mobile-menu-holder thz-desktop-hidden">
	<div class="thz-mobile-menu-table">
		<?php echo thz_logo_print('logomobile'); ?>
		<div class="thz-mobile-menu-cell">
			<button class="thz-burger thz-burger--spin-r thz-open-mobile-menu" type="button">
			<span class="thz-burger-box">
			<span class="thz-burger-inner"></span>
			</span>
			</button>			
		</div>
	</div>
	<?php thz_mobile_menu(); ?>
</div>