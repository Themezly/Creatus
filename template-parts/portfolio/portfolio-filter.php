<?php
/**
 * @package      Thz Framework
 * @author       Themezly
 * @websites     http://www.themezly.com | http://www.youjoomla.com | http://www.yjsimplegrid.com
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // No direct access
}

$show_filter 	= thz_get_theme_option('project_style/filter/picked');

if ($show_filter !== 'show' ) {
	return;	
}
$term     	 			= get_queried_object(); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.OverrideProhibited
$term_id  	  			= isset($term->term_id) ? get_queried_object_id() : 0;
$categories   			= fw_ext_portfolio_get_listing_categories( $term_id );
$cat_name				= get_cat_name($term_id);
$filter_group 			= strtolower( str_replace(' ','',$cat_name ));
$filter_all 			= thz_get_theme_option('project_style/filter/show/fm/at','All');

if(isset($term->taxonomy) && $term->taxonomy == 'fw-portfolio-tag' ){
	
	$posts_per_page	= thz_get_theme_option('pgrid/items',9);
	$paged 			= thz_paged(); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.OverrideProhibited
	$order			= thz_get_theme_option('projects_order/order'); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.OverrideProhibited
	$orderby		= thz_get_theme_option('projects_order/orderby'); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.OverrideProhibited
	
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
	
	$query 			= new WP_Query( $args );
	$categories		= thz_query_taxonomies(array(),$query);
}
?>
<?php if ( !empty( $categories ) ) : ?>
<ul id="thz-portfolio-filter-<?php echo esc_attr( $term_id ) ?>" class="thz-items-grid-categories thz-projects-filter" data-filter-group="<?php echo $filter_group ?>">
	<li class="thz-items-categories-item">
		<a class="active thz-posts-filter-link" href='#' data-filter-value=".category_all">
			<?php echo $filter_all; ?>
		</a>
	</li>
	<?php foreach ( $categories as $category ) : ?>
	<li class="thz-items-categories-item">
		<a class="thz-posts-filter-link" href='#' data-filter-value=".category_<?php echo $category->term_id ?>">
			<?php echo $category->name; ?>
		</a>
	</li>
	<?php endforeach; ?>
</ul>
<?php endif ?>