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
 * The template for displaying archive page.
 */
get_header();
?>

<div id="<?php thz_set_holder() ?>" class="holders">
	<?php if (thz_show_left_content_right ()): ?>
	<aside id="leftblock" class="thz-block"<?php thz_sdata('sidebar')?>>
		<div class="thz-block-spacer">
			<div class="thz-sidebars">
				<?php thz_load_sidebar('left') ?>
			</div>
		</div>
	</aside>
	<?php endif; ?>
	<main id="contentblock" class="thz-block thz-block-main"<?php thz_sdata('main'); ?>>
		<div class="thz-block-spacer">
			<div class="thz-main-in">
				<?php get_template_part( 'template-parts/post/posts','layout'); ?>
			</div>
		</div>
	</main>
	<!-- #contentblock -->
	<?php get_sidebar(); ?>
</div>
<!-- .holders -->
<?php get_footer(); ?>
