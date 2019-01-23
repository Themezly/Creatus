<?php
/**
 * @package      Thz Framework
 * @author       Themezly
 * @websites     http://www.themezly.com | http://www.youjoomla.com | http://www.yjsimplegrid.com
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // No direct access
}

global $thz_rowstarthook,$thz_post_in_loop;
$thz_post_in_loop	= true;
$thumbnail_id 		= get_post_thumbnail_id();
$media_height		= thz_get_theme_option('project_style/media_height/picked','thz-ratio-16-9');
$show_icons			= thz_get_theme_option('project_style/show_icons/picked');
$animate			= thz_get_theme_option('project_animate');
$animation_data		= thz_print_animation($animate);
$animation_class	= thz_print_animation($animate,true,'thz-isotope-animate');
$cats_array			= array();
$cats_names			= array();
$post_categories 	= get_the_terms( get_the_ID(),'fw-portfolio-category');
$metroitem			= '';
$display_mode		= thz_get_theme_option('project_style/display_mode/picked');
$show_button		= thz_get_theme_option('project_style/show_button/picked');
$item_link 			= get_permalink();
$use_poster			= thz_get_post_option('use_poster','active'); 
$post_media 		= thz_get_post_media();
$post_media 		= $use_poster == 'active' ? thz_magnific_media( $post_media ) : $post_media ;
$media_data 		= !empty($post_media) ? $post_media[0]: array();
$project_atts 		= thz_get_theme_option('project_style');
$intro_align		= thz_get_theme_option('project_style/intro_align','thz-align-left'); 
$meta_elements		= thz_get_theme_option('project_style/meta_elements',null);
$footer_elements	= thz_get_theme_option('project_style/footer_elements',null);

$separator			= thz_get_theme_option('project_style/sep',null);
$separator			= thz_get_separator ($separator,'thz-meta-separator');

$meta_elements['separator'] 	= $separator;
$footer_elements['separator'] 	= $separator;
$meta_elements['author_data'] 	= thz_get_theme_option('project_style/meta_author',null);
$footer_elements['author_data'] = thz_get_theme_option('project_style/footer_author/size',20);


$introtext			= '';
$introbox_classes	= $intro_align;
$show_title 		= thz_get_theme_option('project_style/show_title/picked');
$show_introtext		= thz_get_theme_option('project_style/show_introtext/picked'); 

if($post_categories){
	foreach($post_categories as $cat){
		
		$cats_array[]= 'category_'.$cat->term_id;
		$category_link = get_category_link( $cat->term_id );
		$cats_names[]= '<a href="'.esc_url( $category_link ).'" title="'.esc_attr ( $cat->name ).'">'.esc_attr ( $cat->name ).'</a>';
		
	}
	unset($post_categories);
}

$item_cats 		 = implode(' ',$cats_array);
$item_cats_names = implode(', ',$cats_names);


if( $media_height == 'metro' ){
	
	$sequence_type = thz_get_theme_option('project_style/media_height/metro/sequence',1);
	
	$sequence = thz_metro_sequence_maker($sequence_type);
	
	foreach ($sequence['items'] as $key => $size){
		
		if($thz_rowstarthook % $sequence['count'] == $key){
			
			$metroitem = ' thz-item-metro-'. $size ;
		}
		
		unset($key,$size);
	}
	unset($sequence);

}

if($show_introtext =='show'){
	$limit_by				= thz_get_theme_option('project_style/show_introtext/show/intro_length/picked');
	$limit_lenght			= thz_get_theme_option('project_style/show_introtext/show/intro_length/'.$limit_by.'/limit');
}


// outs
$item_more_button	= $show_button =='show' ? str_replace('href="#"','href="'.$item_link.'"',thz_get_theme_option('project_style/show_button/show/button/html')):'';	
$item_data 			= 'data-itemid="'.get_the_ID().'" data-mode="'.esc_attr ( $display_mode ).'"  data-cats="'.thz_post_tax_links('data').'"';
$item_classes 		= $item_cats.$metroitem;
$item_in_classes 	= $animation_class;

$reveal_classes		= '';
if($display_mode == 'reveal'){
	$reveal_ef			= thz_get_theme_option('project_style/display_mode/reveal/reveal_effect/effect');
	$reveal_tr			= str_replace('.','',thz_get_theme_option('project_style/display_mode/reveal/reveal_effect/transition'));
	$intro_height		= thz_get_theme_option('project_style/display_mode/reveal/intro_height/picked'); 
	$valign				= $intro_height == 'full' ? ' '.thz_get_theme_option('project_style/display_mode/reveal/intro_height/full/valign','thz-va-middle') : '';
	$intro_poz			= $intro_height == 'auto' ? ' thz-grid-item-ip-'.thz_get_theme_option('project_style/display_mode/reveal/intro_height/auto/position') : ''; 
	$introbox_classes	= $introbox_classes.$valign.$intro_poz;
	
	$reveal_classes		= ' '.$reveal_ef.' '.$reveal_tr.' thz-grid-item-ih-'.$intro_height;
}

if($display_mode == 'directional'){
	$valign				= thz_get_theme_option('project_style/display_mode/directional/valign','thz-va-middle');
	$introbox_classes	= $introbox_classes.' '.$valign;
}

?>
<div class="thz-grid-item thz-animate-parent category_all <?php echo thz_sanitize_class( $item_classes ) ?>" <?php echo thz_sanitize_data($item_data) ?>>
	<div class="thz-grid-item-in<?php echo thz_sanitize_class( $item_in_classes )?>"<?php echo thz_sanitize_data($animation_data) ?>>
		<div class="thz-grid-item-media-holder">
			<div class="thz-grid-item-media">
				<?php get_template_part( 'template-parts/portfolio/project-media', 'catview' ); ?>
			</div>
		</div>
        <?php if($show_title == 'show'  || $show_introtext == 'show' || $show_button == 'show' || $project_meta !='' || $project_footer !='') { ?>
		<div class="thz-grid-item-intro-holder<?php echo thz_sanitize_class ( $reveal_classes ) ?>">
			<div class="thz-grid-item-poz">
				<div class="thz-grid-item-intro <?php echo thz_sanitize_class( $introbox_classes )?>">
					<?php if($show_icons =='show' && $display_mode == 'directional' ) { ?>
					<?php echo thz_print_post_media_icons($project_atts,$item_link,$media_data) ?>
					<?php } ?>
					<?php if($show_title == 'show') { ?>
					<h3 class="thz-grid-item-title">
						<a href="<?php echo esc_url ( $item_link )?>">
							<?php the_title(); ?>
						</a>
					</h3>
					<?php } ?>
					<?php echo thz_theme_post_meta('meta','above','above','<div class="thz-grid-item-meta">','</div>',$meta_elements,false);  ?>
					<?php if($show_introtext =='show'): if(thz_intro_text($limit_by,$limit_lenght) !=''){?>
					<div class="thz-grid-item-intro-text">
						<?php echo thz_intro_text($limit_by,$limit_lenght); ?>
					</div>
					<?php }endif; ?>
                   <?php echo thz_theme_post_footer('footer','under','under','<div class="thz-grid-item-footer">','</div>',$footer_elements,false);?>
					<?php if($show_button == 'show' ): ?>
					<div class="thz-grid-item-button">
						<?php echo thz_btn_print ( $item_more_button );	?>
					</div>
					<?php endif; ?>
					<?php if($display_mode == 'reveal') { ?>
                    <a href="<?php echo esc_url ( $item_link )?>" class="thz-reveal-link"></a>
                    <?php } ?>                    
				</div>
			</div>
		</div>
        <?php } ?>
	</div><?php thz_sdata('project',true,true); ?>
</div>