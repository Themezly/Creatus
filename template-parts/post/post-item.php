<?php
/**
 * @package      Thz Framework
 * @author       Themezly
 * @websites     http://www.themezly.com | http://www.youjoomla.com | http://www.yjsimplegrid.com
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // No direct access
}

global $thz_rowstarthook;

$thumbnail_id 		= get_post_thumbnail_id();
$arch				= thz_get_theme_option('arch',array());
$cap				= thz_get_option('cap/0',array());
$prefix				= thz_passed_var('blog_layout') =='archive' && !empty($arch) ? 'arch/0/' : '';
$prefix				= !empty($cap) ? 'cap/0/' : $prefix;

$blog_layout_type 	= thz_get_option($prefix.'blog_layout_type/picked','classic');
$post_media 		= thz_get_post_option('post_media',array());
$media_alignment 	= thz_get_option($prefix.'blog_layout_type/classic/ma','full');
$classic_va 		= thz_get_option($prefix.'blog_layout_type/classic/mx/va','middle');
$tm_loc_title		= thz_get_option($prefix.'blog_layout_type/'.$blog_layout_type.'/tm_loc/title',null);
$tm_loc_meta		= thz_get_option($prefix.'blog_layout_type/'.$blog_layout_type.'/tm_loc/meta',null);  
if($blog_layout_type == 'classic'){
	$tm_loc_title	= thz_get_option($prefix.'blog_layout_type/classic/mx/title','under');
	$tm_loc_meta	= thz_get_option($prefix.'blog_layout_type/classic/mx/meta',null); 	
}
$meta_elements		= thz_get_option($prefix.'posts_style/meta_elements',null); 
$footer_elements	= thz_get_option($prefix.'posts_style/footer_elements',null);
$separator			= thz_get_option($prefix.'posts_style/sep',null);
$separator			= thz_get_separator ($separator,'thz-meta-separator');

$meta_elements['separator'] 	= $separator;
$footer_elements['separator'] 	= $separator;
$meta_elements['pref'] 			= thz_get_option($prefix.'posts_style/meta_pref',null);
$footer_elements['pref'] 		= thz_get_option($prefix.'posts_style/footer_pref',null);

$title_location  	= $blog_layout_type == 'classic' && $media_alignment !='full' ? 'under':$tm_loc_title;
$meta_location   	= $tm_loc_meta;
$animate			= thz_get_option($prefix.'posts_animate',array());
$animation_data		= thz_print_animation($animate);
$animation_class	= thz_print_animation($animate,true,'thz-isotope-animate');
$animate_parent		= thz_akg('animate',$animate) == 'active' ? 'thz-animate-parent' :'';
$media_classes 		= '';
$post_format 		= get_post_format();
$format_name 		= !$post_format ? 'standard' : $post_format;
$item_media 		= !$post_format ? 'catview' : $post_format;
$custom_format		= $post_format =='link' || $post_format =='quote' ? ' thz-custom-format' : '';
$show_button		= thz_get_option($prefix.'posts_style/show_button/picked','hide');
$item_link 			= get_permalink();
$quote_display		= thz_get_option($prefix.'posts_style/quote_display','detailed'); 
$link_display		= thz_get_option($prefix.'posts_style/link_display','detailed');
$show_media 		= thz_get_option($prefix.'posts_style/hmx/media','show');
$show_media			= $show_media == 'show' ? true : false ;
$has_media			= (thz_post_has_media() || $post_format) && $show_media ? true : false;
$custom_format_ex	= ($post_format == 'quote' && $quote_display == 'detailed')  || ( $post_format == 'link' && $link_display == 'detailed') ?  ' thz-item-has-excerpt' : '';		
$show_title 		= thz_get_option($prefix.'posts_style/show_title/picked','show');
$show_introtext		= thz_get_option($prefix.'posts_style/show_introtext/picked','show'); 
$intro_align		= thz_get_option($prefix.'posts_style/hmx/align','thz-align-left'); 
$title_classes		= 'thz-grid-item-title';	
$introtext			= '';


if($blog_layout_type === 'classic' && $has_media) {
		
	if($media_alignment =='left' || $media_alignment =='right' ){
		
		$alternate		= thz_get_option($prefix.'blog_layout_type/classic/mx/a','inactive');
		$first_side		= $media_alignment =='left' ? 'left' : 'right';
		$second_side	= $media_alignment =='left' ? 'right' : 'left';
		
		if( $alternate == 'active'){
			$altc = ' thz-palt-'.$media_alignment;
			if( $thz_rowstarthook % 2 == 0 ) {
				$media_classes .= $custom_format.' thz-item-aligned thz-grid-item-media-align-'.$first_side.' thz-pva-'.$classic_va.$altc;
			} else {
				$media_classes .= $custom_format.' thz-item-aligned thz-grid-item-media-align-'.$second_side.' thz-pva-'.$classic_va.$altc;
			}	
						
		}else{
			$media_classes .= $custom_format.' thz-item-aligned thz-grid-item-media-align-'.$media_alignment.' thz-pva-'.$classic_va;
		}
		
	}
	
}

if($blog_layout_type =='grid'){
	
	$columns 		= thz_get_option($prefix.'blog_layout_type/grid/bgrid/columns',3);
	$postclasses = array(
		'thz-grid-item',
		thz_col_width( $columns ,3),
		$animate_parent
	);	
	
}else if($blog_layout_type =='timeline'){

	$columns 		= thz_get_option($prefix.'blog_layout_type/timeline/mx/c',2);
	$column_side 	= '';
	
	if($columns == 2){
		
		if( $thz_rowstarthook % 2 == 0) {
			$column_side = 'thz-timeline-item-left';
		} else {
			$column_side = 'thz-timeline-item-right';
		}
	}
	
	$postclasses = array(
		'thz-grid-item',
		'thz-width-100',
		'thz-grid-item-timeline',
		$animate_parent,
		$column_side
	);
}else{
	$postclasses = array(
		'thz-grid-item',
		'thz-width-100',
		'thz-pl-0',
		$animate_parent
	);
}

if($show_introtext =='show'){
	$limit_by		= thz_get_option($prefix.'posts_style/show_introtext/show/intro_length/picked','none');
	$limit_lenght	= thz_get_option($prefix.'posts_style/show_introtext/show/intro_length/'.$limit_by.'/limit',40);
}

// outs
$item_more_button	= $show_button =='show' ? str_replace('href="#"','href="'.$item_link.'"',thz_get_option($prefix.'posts_style/show_button/show/button/html')):'';
$item_data 			= ' data-itemid="'.get_the_ID().'" data-mode="default"';
$item_in_classes 	= $animation_class.$media_classes.$custom_format_ex;
$mediabox_classes	= ' thz-blog-post-media thz-grid-item-media-'.$format_name;


// timeline html
$timeline_html ='';
if($blog_layout_type =='timeline'){
	$date_radius = thz_get_option($prefix.'blog_layout_type/timeline/mx/r',4);
	$timeline_html	.= '<div class="thz-timeline-date thz-radius-'. esc_attr( $date_radius ) .'">';
		$timeline_html	.= '<span class="thz-timeline-day">';
		$timeline_html	.= get_the_date('d');
		$timeline_html	.= '<span class="thz-timeline-monthyear">';
		$timeline_html	.= get_the_date('M Y');
		$timeline_html	.= '</span>';
		$timeline_html	.= '</span>';
	$timeline_html	.= '</div>';
	$timeline_html	.= '<span class="thz-timeline-line"></span>';
}

$postclasses[] = ($thz_rowstarthook %2 == 0) ? 'thz-grid-item-odd' : 'thz-grid-item-even';
?>
<article id="post-<?php the_ID(); ?>" <?php post_class($postclasses); ?><?php echo thz_sanitize_data($item_data) ?>><?php echo $timeline_html ?>
	<div class="thz-grid-item-in<?php echo thz_sanitize_class ( $item_in_classes ) ?>"<?php echo thz_sanitize_data($animation_data) ?>>
		<?php 
		if( ($link_display =='only' && $post_format =='link' ) || ( $quote_display =='only' && $post_format =='quote')) {
			get_template_part('template-parts/post/post-item-format',$post_format);
		?>
		<?php }else{ ?>
			<?php 
				if($meta_location =='above' && $title_location =='above'){
					
					thz_theme_post_meta('meta','above',$meta_location,'<div class="thz-grid-item-meta">','</div>',$meta_elements);
				}
				if($show_title =='show' && $title_location =='above'){
					thz_post_title('above',$title_location,$title_classes,'h2','under');
				}
				if($meta_location =='under'&& $title_location =='above'){
					
					thz_theme_post_meta('meta','under',$meta_location,'<div class="thz-grid-item-meta">','</div>',$meta_elements);
				} 
			?>
			<?php if( $has_media ) {?>
			<div class="thz-grid-item-media-holder">
				<div class="thz-grid-item-media<?php echo thz_sanitize_class ( $mediabox_classes )?>">
					<?php get_template_part( 'template-parts/post/post-media',$item_media); ?>
				</div>
			</div>
			<?php } ?>
			<div class="thz-grid-item-intro-holder">
				<div class="thz-grid-item-intro <?php echo esc_attr( $intro_align )?>">
					<?php 
						if($meta_location =='above' && $title_location =='under'){
							
							thz_theme_post_meta('meta','above',$meta_location,'<div class="thz-grid-item-meta">','</div>',$meta_elements);
						}
						if($show_title =='show' && $title_location =='under'){
							thz_post_title('under',$title_location,$title_classes,'h2','under');
						}
						if($meta_location =='under'&& $title_location =='under'){
							
							thz_theme_post_meta('meta','under',$meta_location,'<div class="thz-grid-item-meta">','</div>',$meta_elements);
						}
					?>
					<?php if($show_introtext =='show' && thz_intro_text($limit_by,$limit_lenght) !=''){?>
					<div class="thz-grid-item-intro-text">
						<?php echo thz_intro_text($limit_by,$limit_lenght); ?>
					</div>
					<?php } ?>
					<?php thz_theme_post_footer('footer','under','under','<div class="thz-grid-item-footer">','</div>',$footer_elements); ?>
					<?php if($show_button == 'show' ): ?>
					<div class="thz-grid-item-button">
						<?php echo thz_btn_print ( $item_more_button );	?>
					</div>
					<?php endif; ?>
				</div>
			</div>	
		<?php } ?>
	</div>
</article>