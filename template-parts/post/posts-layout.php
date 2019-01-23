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

$postauthor			= is_author() ? get_queried_object_id() : 0;
$arch				= thz_get_theme_option('arch',array());
$cap				= thz_get_option('cap/0',array());
$prefix				= thz_passed_var('blog_layout') =='archive' && !empty($arch) ? 'arch/0/' : '';
$prefix				= !empty($cap) ? 'cap/0/' : $prefix;

$layout_type 		= thz_get_option($prefix.'blog_layout_type/picked','classic');
$author_mode		= thz_get_theme_option('author_imx/mode','left');
$columns 			= 1;
$gutter 			= ' thz-ml-0';
$data_layout		= $layout_type;
$grid_data			='';


if($layout_type =='grid'){
	
	$columns 		= thz_get_option($prefix.'blog_layout_type/grid/bgrid/columns',3);
	$getheight		= thz_get_option($prefix.'posts_style/media_height/picked','thz-ratio-16-9');
	$data_layout	= $getheight == 'auto' ? 'masonry' : $layout_type;
	$gutter 		= $columns > 1 ? '': ' thz-ml-0';
	
	$isotope		= thz_get_option($prefix.'blog_layout_type/grid/bgrid/isotope','packery');
	$isotope		= $columns == 1 ? 'vertical' : $isotope;
	$grid_data 		.= ' data-isotope-mode="'.esc_attr($isotope).'"';
	
	if($getheight !='metro'){
		$get_gutter = thz_get_option($prefix.'blog_layout_type/grid/bgrid/gutter',30);
		$minwidth	= thz_get_option($prefix.'blog_layout_type/grid/bgrid/minwidth',200);
		$grid_data 	.= ' data-minwidth="'.esc_attr( $minwidth + $get_gutter ).'"';
	}
}

if($layout_type =='classic'){
	
	$grid_data 		.= ' data-isotope-mode="vertical"';
}

if($layout_type =='timeline'){
	
	$columns 		= thz_get_option($prefix.'blog_layout_type/timeline/mx/c',2);
	$tml_bw 		= thz_get_option($prefix.'blog_layout_type/timeline/mx/w',1);
	$timeline_class = $columns == 1? 'single': 'double';
	$gutter 		= ' thz-timeline-'.$timeline_class.' thz-grid-timeline thz-timeline-bw-'.$tml_bw ;
}
$no_response 		= $columns < 3 ? ' thz-grid-noresponse' :'';
$is_isotope			= $layout_type == 'timeline' ? ' thz-is-timeline' : ' thz-is-isotope';
$pagination			= thz_get_theme_option($prefix.'posts_pagination/picked','pagination');
$items_load			= thz_get_theme_option($prefix.'posts_pagination/'.$pagination.'/items_load');
$more_button		= thz_get_theme_option($prefix.'posts_pagination/click/more_button/button/html');
$term_id   			= thz_get_current_cat_id();
$mfp_classes		= ' '.thz_lightbox_classes();
$grid_data 			.= ' data-pagination="'.esc_attr($pagination).'" data-catid="'.esc_attr($term_id).'" data-itemsload="'.$items_load.'"';
$grid_data 			.= ' data-layouthook="'.thz_passed_var('blog_layout').'" data-sqlhook="'. thz_passed_var('blog_sql') .'"';
$grid_data 			.= ' data-maxpages="'.$wp_query->max_num_pages.'" data-postauthor="'.esc_attr($postauthor).'" data-posttype="post"';
$grid_data 			.= ' data-taxonomy="category" data-layout-type="'.esc_attr($data_layout).'"';
$grid_data 			.= ' data-order="DESC" data-orderby="date"';





$grid_h_classes		= 'thz-items-grid-holder thz-grid-has-col-'.$columns.' thz-archive thz-archive-'.$layout_type.$is_isotope.$mfp_classes;
$grid_classes		= 'thz-items-grid'.$gutter.' thz-blog-layout-'.$layout_type.$no_response;
?>
<?php if ( have_posts() ) : ?>
<div class="<?php echo thz_sanitize_class($grid_h_classes) ?>"<?php thz_sdata('blog');?>>
	<?php if( is_author() && 'hide' != $author_mode ){ ?>
	<?php get_template_part( 'template-parts/author','info'); ?>
	<?php } ?>
	<div id="thz-items-grid-<?php echo $term_id?>" class="<?php echo thz_sanitize_class( $grid_classes )?>"<?php echo thz_sanitize_data($grid_data) ?>>
		<div class="thz-items-sizer"></div>
		<?php if($layout_type =='timeline' && $columns == 2){ ?>
			<div class="thz-timeline-left">	
				<?php get_template_part('template-parts/post/posts-loop','odd');?>
			</div>
			<div class="thz-timeline-right">
				<?php get_template_part('template-parts/post/posts-loop','even');?>
			</div>
		<?php }else{ ?>
			<?php get_template_part('template-parts/post/posts','loop');?>			
		<?php } ?>
	</div>
	<div class="thz-items-gutter-adjust"></div>
	<?php if($pagination =='pagination') {?>
		<div class="thz-clear"></div>
		<?php if($pagination =='wpdefault'){the_posts_pagination();} ?>
		<?php thz_pagination(); ?>
		<?php } ?>
		<div class="thz-items-loading"></div>
		<?php if($pagination =='click' && $wp_query->max_num_pages > 1) {?>
		<div id="thz-items-more-<?php echo $term_id ?>" class="thz-items-more">
			<?php echo thz_btn_print ( $more_button ) ?>
		</div>
	<?php } ?>
</div>
<?php else : ?>
	<?php get_template_part( 'template-parts/content', 'none' ); ?>
<?php endif; ?>