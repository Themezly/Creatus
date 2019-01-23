<?php
/**
 * @package      Thz Framework
 * @author       Themezly
 * @websites     http://www.themezly.com | http://www.youjoomla.com | http://www.yjsimplegrid.com
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // No direct access
}
get_header();

$ev_sidebar_width = thz_get_option('ev_sw','thz-col-1-3');
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
            <?php thz_page_block('above_post'); ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php  
					
					if('thz-col-1' ==  $ev_sidebar_width){
						get_template_part( 'template-parts/events/event','grid'); 
					}else{
						get_template_part( 'template-parts/events/event','sidebar'); 
					}
				 ?>
			<?php endwhile; // end of the loop. ?>
            <?php thz_page_block('under_post'); ?>
			</div>
		</div>
	</main><!-- #contentblock -->
	<?php get_sidebar(); ?>
</div><!-- .holders -->
<?php get_footer(); ?>