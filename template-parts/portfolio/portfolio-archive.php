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
global $thz_rowstarthook;
$term     	 	= get_queried_object(); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.OverrideProhibited
$term_id  	  	= isset($term->term_id) ? get_queried_object_id() : 0;
$paged 			= thz_paged(); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.OverrideProhibited
$cat_desc		= $term->description;
$columns		= thz_get_theme_option('pgrid/columns',3);
$posts_per_page	= thz_get_theme_option('pgrid/items',9);
$pagination		= thz_get_theme_option('projects_pagination/picked');
$items_load		= thz_get_theme_option('projects_pagination/'.$pagination.'/items_load');
$more_button	= thz_get_theme_option('projects_pagination/click/more_button/button/html');
$media_height	= thz_get_theme_option('project_style/media_height/picked','thz-ratio-16-9');
$data_layout	= $media_height == 'auto' ? 'masonry' : $media_height;
$gutter			= esc_attr( thz_get_theme_option('pgrid/gutter') );
$display_mode	= thz_get_theme_option('project_style/display_mode/picked');
$gutter_class	= $gutter == 0 ? ' thz-items-grid-nogutter' : '';
$order			= thz_get_theme_option('projects_order/order'); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.OverrideProhibited
$orderby		= thz_get_theme_option('projects_order/orderby'); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.OverrideProhibited
$no_response 	= $columns < 3 ? ' thz-grid-noresponse' :'';
$mfp_classes	= ' '.thz_lightbox_classes();
$tax_query 		= array();
if ( $term_id != '0' ) {
	$tax_query = array(
		array(
			'taxonomy' => $term->taxonomy,
			'field'    => 'id',
			'terms'    => $term_id
		)
	);
}

$args = array(
  'posts_per_page'  => $posts_per_page,
  'post_type'  		=> 'fw-portfolio',
  'paged'			=> $paged,
  'tax_query'  		=> $tax_query,
  'order'			=> $order,
  'orderby'			=> $orderby,
  'ignore_sticky_posts' => true,
);

$query 		= new WP_Query( $args );
$get_tax	= isset($term->taxonomy) ? $term->taxonomy : 'fw-portfolio-category';
$grid_data 	= ' data-pagination="'.$pagination.'" data-catid="'.$term_id.'" data-itemsload="'.$items_load.'"';
$grid_data .= ' data-maxpages="'.$query->max_num_pages.'" data-posttype="fw-portfolio" data-taxonomy="'.$get_tax.'" data-layout-type="'.$data_layout.'"';
$grid_data .= ' data-order="'.$order.'" data-orderby="'.$orderby.'" data-display-mode="'.$display_mode.'"';

$isotope		= thz_get_theme_option('pgrid/isotope','packery');
$isotope		= $columns == 1 ? 'vertical' : $isotope;
$grid_data 		.= ' data-isotope-mode="'.esc_attr($isotope).'"';

if($media_height !='metro'){
	$minwidth	= thz_get_theme_option('pgrid/minwidth',200);
	$grid_data 	.= ' data-minwidth="'.esc_attr($minwidth + $gutter ).'"';
}


$grid_holder_classes = 'thz-items-grid-holder thz-grid-on-load thz-is-isotope thz-grid-has-col-'.$columns.' thz-portfolio';
$grid_holder_classes .=' thz-items-grid-'.$data_layout.$gutter_class.$mfp_classes;
$grid_classes		= 'thz-items-grid thz-items-display-'.$display_mode.$no_response;
?>
<div id="thz-portfolio-<?php echo $term_id ?>" class="<?php echo thz_sanitize_class ( $grid_holder_classes ) ?>">
	<?php get_template_part( 'template-parts/portfolio/portfolio', 'filter' ); ?>
	<?php if ($query->have_posts() ) : ?>
		<div id="thz-items-grid-<?php echo $term_id ?>" class="<?php echo thz_sanitize_class( $grid_classes ) ?>"<?php echo thz_sanitize_data($grid_data) ?>>
			<div class="thz-items-sizer"></div>
			<?php
			$thz_rowstarthook = 0;
			while ( $query->have_posts() ) : $query->the_post();
				get_template_part( 'template-parts/portfolio/portfolio', 'item');
			++$thz_rowstarthook;
			endwhile;
			?>
		</div>
		<div class="thz-items-gutter-adjust"></div>
		<?php if($pagination =='pagination') {?>
			<div class="thz-clear"></div>
			<?php thz_pagination($query->max_num_pages,$paged ); ?>
			<?php } ?>
			<?php wp_reset_postdata(); ?>
			<div class="thz-items-loading"></div>
			<?php if($pagination =='click' && $query->max_num_pages > 1) {?>
			<div id="thz-items-more-<?php echo $term_id ?>" class="thz-items-more">
				<?php echo thz_btn_print ( $more_button ) ?>
			</div>
		<?php } ?>
		<div id="thz-portfolio-scrollto-<?php echo $term_id ?>" class="thz-items-scrollto"></div>
	<?php else : ?>
		<?php get_template_part( 'content', 'none' ); ?>
	<?php endif; ?>
</div>