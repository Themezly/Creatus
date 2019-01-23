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
 * The sidebar containing the main widget area.
 */
?>
<?php if (thz_show_left ()): ?>
<aside id="leftblock" class="thz-block"<?php thz_sdata('sidebar')?>>
	<div class="thz-block-spacer">
		<div class="thz-sidebars">
			<?php thz_load_sidebar('left') ?>
		</div>
	</div>
</aside>
<?php endif; ?>
<?php if (thz_show_right ()): ?>
<aside id="rightblock" class="thz-block"<?php thz_sdata('sidebar')?>>
	<div class="thz-block-spacer">
		<div class="thz-sidebars">
			<?php thz_load_sidebar('right') ?>
		</div>
	</div>
</aside>
<?php endif; ?>