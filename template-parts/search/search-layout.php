<?php
/**
 * @package      Thz Framework
 * @author       Themezly
 * @websites     http://www.themezly.com | http://www.youjoomla.com | http://www.yjsimplegrid.com
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // No direct access
} 
global $wp_query,$thz_rowstarthook;

if ( have_posts() ) : 
 
	$thz_rowstarthook = 0;
	$gutter 		= thz_get_theme_option('search_grid/gutter',15);
	$columns 		= thz_get_theme_option('search_grid/columns',3);
	$isotope 		= thz_get_theme_option('search_grid/isotope','fitRows');
	$no_response 	= $columns < 3 ? ' thz-grid-noresponse' :'';
	$row_classes 	= 'thz-items-grid thz-animate-parent thz-ml-n'.$gutter.$no_response;
	$column_classes = 'thz-grid-item thz-animate '.thz_col_width( $columns, 3 ).' thz-pl-'.$gutter;
	$form_mb		= thz_get_theme_option('search_spacings/form',30);
	$grid_mb		= thz_get_theme_option('search_spacings/grid',30);
?>
<div class="thz-search-isotope thz-is-isotope thz-items-grid-holder thz-mb-<?php echo thz_m_ton($grid_mb) ?>">
	<section class="thz-search-section thz-mb-<?php echo thz_m_ton($form_mb) ?>">
		<p class="thz-fw-600 thz-mb-10">
			<?php _e( 'Cannot find what you are looking for? Please try again with different keywords.', 'creatus' ); ?>
		</p>
		<form class="thz-search-form" method="get" action="<?php echo esc_url( home_url( '/' )); ?>">
        	<div class="thz-search-form-inner">
                <input type="text" class="text-input" placeholder="<?php _e('Search site', 'creatus'); ?>" value="" name="s" />
                <input type="submit" class="search-button" value="" />
            </div>
		</form>
	</section>
	<div class="<?php echo thz_sanitize_class($row_classes) ?>" data-isotope-mode="<?php echo esc_attr( $isotope ) ?>">
		<div class="thz-items-sizer <?php echo thz_col_width( $columns, 3 ) ?>"></div>
		<?php while ( have_posts() ) : the_post();  ?>
		<div class="<?php echo thz_sanitize_class($column_classes) ?>" data-anim-effect="thz-anim-slideIn-up" data-anim-duration="700" data-anim-delay="100">
			<div class="thz-grid-item-in thz-mb-<?php echo esc_attr( $gutter ) ?>">
				<?php get_template_part('template-parts/search/search','item'); ?>
			</div>
		</div>
		<?php ++$thz_rowstarthook; endwhile; ?>
	</div>
	<div class="thz-items-gutter-adjust thz-mb-n<?php echo esc_attr( $gutter ) ?>"></div>
</div>
<div class="thz-search-pagination">
	<?php thz_pagination(); ?>
</div>
<?php else : ?>
<div class="thz-search-isotope">
	<?php get_template_part( 'template-parts/content', 'none' ); ?>
</div>
<?php endif; ?>