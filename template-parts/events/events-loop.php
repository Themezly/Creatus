<?php
/**
 * @package      Thz Framework
 * @author       Themezly
 * @websites     http://www.themezly.com | http://www.youjoomla.com | http://www.yjsimplegrid.com
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // No direct access
}
global $wp_query;
$pagination 	= false;
$media_align 	= thz_get_theme_option('ev_ma/picked','left');
$columns 		= thz_get_theme_option('ev_grid/columns',1);
$gutter 		= thz_get_theme_option('ev_grid/gutter',30);
$minwidth		= thz_get_theme_option('ev_grid/minwidth',200);
$isotope		= $columns == 1 ? 'vertical' : 'packery';
$grid_data 		= ' data-isotope-mode="'.$isotope.'"';
$grid_data 		.= ' data-minwidth="'.esc_attr( $minwidth + $gutter ).'"';
?>
<?php if ( have_posts() ) : ?>
<div class="thz-items-grid-holder thz-is-isotope thz-events-archive">
	<div class="thz-events thz-items-grid <?php echo thz_sanitize_class($media_align) ?>"<?php echo $grid_data ?>>
		<div class="thz-items-sizer"></div>
		<?php 
			while ( have_posts() ) : the_post(); 
				get_template_part('template-parts/events/events','item');
			endwhile;
		?>	
	</div>
	<div class="thz-items-gutter-adjust"></div>
	<?php if($pagination =='wpdefault'){the_posts_pagination();} ?>
	<?php thz_pagination(); ?>
</div>
<?php else : ?>
	<?php get_template_part( 'template-parts/content', 'none' ); ?>
<?php endif; ?>