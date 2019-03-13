<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$id 					= thz_akg('id',$atts); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.OverrideProhibited
$css_id 				= thz_akg('cmx/i',$atts);
$id_out					= !empty($css_id) ? str_replace(' ','',$css_id): 'thz-section-holder-s'.$id;
$css_class 				= thz_akg('cmx/c',$atts);
$css_class				= $css_class !='' ? $css_class.' ':'';
$res_class				= _thz_responsive_classes(thz_akg('cmx',$atts));
$s_contained 			= thz_akg('section_contained/picked',$atts);
$c_contained 			= thz_akg('section_contained/notcontained/content_contained',$atts);;
$contain_section		= thz_contained( $s_contained , false);
$contain_content		= thz_contained( $c_contained , false);
$section_video			= thz_akg('bs/background',$atts);
$animate				= thz_akg('an',$atts);
$animation_data			= thz_print_animation($animate);
$animation_class		= thz_print_animation($animate,true);
$cpx					= thz_akg('cpx',$atts);
$cpx_data				= thz_print_cpx($cpx);
$cpx_class				= thz_print_cpx($cpx,true);
$smootha 				= thz_akg('smootha/m',$atts);
$anchordata				= '';
$cp_o					= thz_akg('cp',$atts);
$cp_speed				= (int) esc_attr( thz_akg('cp/0/s',$atts));
$cp_data				= !empty($cp_o) ? ' data-parallaxspeed="'.$cp_speed.'"' : '';
$scrollfade_o			= thz_akg('sf',$atts);
$scrollfade_at			= (int) esc_attr( thz_akg('sf/0/fadeat',$atts));
$scrollfade_class		= !empty($scrollfade_o) ? ' thz-scroll-fade' : '';
$whattofade_o			= thz_akg('sf/0/whattofade',$atts); 
$whattofade				= $whattofade_o == 'content' ? ' data-whattofade=".thz-container"' : '';
$scrollfade_data		= !empty($scrollfade_o) ? ' data-fadestart="'.$scrollfade_at.'"'.$whattofade.'' : '';
$separator 				= thz_akg('se',$atts);
$is_slide 				= thz_akg('is_slide',$atts,false);
$background_layers		= thz_akg('bl',$atts); 
$full_exclude			= thz_akg('n/fp',$atts,'include');
$full_rows				= $full_exclude == 'exclude' ? false : thz_full_rows();
$fpex_class				= !$is_slide && thz_full_rows() && $full_exclude == 'exclude'  ? ' thz-fp-excluded':'';
$fullheight				= thz_akg('fh',$atts);
$contentalign			= $full_rows ? 'thz-va-middle' : thz_akg('fh/0/contentalign',$atts);
$mode					= thz_akg('mode',$atts,'default'); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.OverrideProhibited
$op_classes				= !empty($cp_o) ?' thz-parallax-over':'';
$scroll_to				= thz_akg('n/s',$atts,'inactive');
$brightness				= thz_akg('cmx/b',$atts,'none');
$brightness_tag			= $is_slide ? 'get' :'view';
$bright_data			= ' data-'.$brightness_tag.'-brightness="'.$brightness.'"';
$scroll_to_data			= $scroll_to == 'active' ? ' data-slabel="'.thz_htmlspecialchars( thz_akg('n/l',$atts,'') ).'"' :'';
$lightbox				= thz_akg('lb',$atts);  
$lightbox_data			= '';

if( !empty($lightbox) ){
	$lightbox_data .=' data-bg="'.thz_akg('lb/0/e',$atts,'mfp-dark').'"';
	$lightbox_data .=' data-opacity="'.thz_akg('lb/0/s',$atts,'mfp-opacity-08').'"';
	$lightbox_data .=' data-effect="'.thz_akg('lb/0/o',$atts,'mfp-zoom-in').'"';
	$lightbox_data .=' data-modal-size="'.thz_akg('lb/0/m',$atts,'xlarge').'"';
	$css_class .='thz-open-in-lightbox mfp-hide ';
}

if($smootha != 'inactive' && $css_id){
	
	$stop 				= (int) thz_akg('smootha/p',$atts);
	$duration			= (int) thz_akg('smootha/d',$atts);	
	$op_classes 		.= ' thz-element-anchor';
	$anchordata			= ' data-anchor-'.esc_attr( $smootha ).'="'.esc_attr( $stop ).'" data-anchor-duration="'.esc_attr( $duration ).'"';
}

$sc_class	= $css_class.'thz-section-holder section-'.$s_contained.$contain_section.$animation_class.$scrollfade_class.$op_classes.$cpx_class.$fpex_class.$res_class; 
$cc_class	= ' content-'.$c_contained.$contain_content;
$cc_datas	= $animation_data.$scrollfade_data.$cp_data.$anchordata.$scroll_to_data.$bright_data.$cpx_data.$lightbox_data;
$s_class	= $mode == 'default' ? 'thz-section' : 'thz-section '.$mode;


if( !$is_slide && $full_rows ) { 
	$full_row = '<div id="'.esc_attr( $id_out ).'-fpr" class="thz-full-page-row" data-fpr-link="'.thz_clean_string(thz_akg('n/l',$atts,'')).'" data-slabel="'.thz_htmlspecialchars( thz_akg('n/l',$atts,'') ).'">';
	$full_row .= '<div class="thz-full-page-row-in">';
	echo $full_row;
}

if( $is_slide ) { 
	
	$sb = '<div class="thz-slick-slide">';
	$sb .='<div class="thz-slick-slide-in">';
	$sb .='<div class="thz-sections-slide">';
	
	echo $sb;
} 

?>
<div id="<?php echo esc_attr( $id_out ) ?>" class="<?php echo thz_sanitize_class( $sc_class ) ?>"<?php echo thz_sanitize_data($cc_datas); ?>>
	<section class="<?php echo thz_sanitize_class( $s_class ); ?>">
		<div class="thz-section-in">
		<?php if(!empty($fullheight) || $full_rows ) { ?>
		<div class="thz-full-height">
			<div class="thz-full-height-in <?php echo  thz_sanitize_class ( $contentalign ) ?>">
		<?php } ?>
			<div class="thz-container<?php echo thz_sanitize_class ( $cc_class ) ?>">
				<?php echo do_shortcode( $content ); ?>
			</div>
		<?php if(!empty($fullheight) || $full_rows) { ?>
			</div>
		</div>
		<?php } ?>
		</div>
	<?php echo thz_separators_print($separator); ?>
	<?php echo thz_background_layers_print($background_layers); ?>
	<?php echo thz_video_bg($section_video,false) ?>
	</section>
</div>
<?php 

	if( $is_slide ) { 
		// slide after
		echo '</div></div></div>';
	} 
	
	if( !$is_slide && $full_rows ) { 
		echo '</div></div>';
	}
?>