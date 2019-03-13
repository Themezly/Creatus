<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}
/**
 * @var array $atts
 */
$image  			= thz_akg('image',$atts,null); 
if(empty($image)){
	
	$n_title 	= esc_html__('Missing an image','creatus');
	$n_msg 		= esc_html__('Please go in shortcode settings and add an image','creatus');
	thz_notify('yellow thz-shc',$n_title,$n_msg);
	return;	
}

$id 				= thz_akg('id',$atts); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.OverrideProhibited
$css_id 			= thz_akg('cmx/i',$atts);
$id_out				= !empty($css_id) ? str_replace(' ','',$css_id): 'thz-media-image-'.$id;
$css_class 			= thz_akg('cmx/c',$atts);
$css_class			= $css_class !='' ? $css_class.' ':'';
$res_class			= _thz_responsive_classes(thz_akg('cmx',$atts));
$height				= thz_akg('height/picked',$atts,'thz-ratio-16-9');
$hover_bgtype		= thz_akg('med_over/background/type',$atts,'solid'); 
$hover_ef 			= thz_akg('med_over/oeffect',$atts,'thz-hover-fadein');
$hover_tr 			= ' '.thz_akg('med_over/oduration',$atts,'thz-transease-04');
$img_ef				= thz_akg('med_over/ieffect',$atts,'thz-img-zoomin');
$img_tr 			= thz_akg('med_over/iduration',$atts,'thz-transease-04');
$grayscale			= thz_akg('grayscale',$atts,'none');
$grayscale			= $grayscale !='none' ? ' '.$grayscale :'';
$click				= thz_akg('click',$atts,'none');
$over_mode			= $click =='none' ? 'none' : thz_akg('over_mode',$atts,'thzhover');
$mode_class			= ' thz-media-mode-'.$over_mode;
$show_caption 		= thz_akg('caption/picked',$atts,'hide');
$link				= thz_akg('link',$atts,null); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.OverrideProhibited
$link_output		= null;
$show_media_icon	= $click =='none' ? 'hide' : thz_akg('mi/picked',$atts,'show'); 
$animate			= thz_akg('animate',$atts);
$animate_data		= thz_print_animation($animate);
$animation_class	= thz_print_animation($animate,true);
$cpx				= thz_akg('cpx',$atts);
$cpx_data			= thz_print_cpx($cpx);
$cpx_class			= thz_print_cpx($cpx,true);
$mpx				= thz_akg('mpx',$atts);
$mpx_print			= thz_print_mpx($mpx);

$animate_parent		= thz_akg('animate',$animate) == 'active' ? ' thz-animate-parent ' :'';	
$style 				= '';
$overlay_box 		= '';
$image_caption 		= '';

if($show_media_icon =='show'){
	$icons_ef 			= thz_akg('med_over/iceffect',$atts,'thz-comein-bottom');
	$icons_tr 			= thz_akg('med_over/icduration',$atts,'thz-transease-05');
	$icon_shape			= thz_akg('mi/show/iconbg_metrics/sh',$atts,'square');
	$icon_pa			= thz_akg('mi/show/icon_metrics/pa',$atts,10);
	$icon_fs			= thz_akg('mi/show/icon_metrics/fs',$atts,16);
	$overlay_icon		= thz_akg('mi/show/icon',$atts,'thzicon thzicon-plus');
	$icon_classes		= $icon_shape.' thz-fs-'.$icon_fs.' thz-vp-'.$icon_pa.' thz-hp-'.$icon_pa;	
	$iconef_classes 	= ' '.$icons_ef.' '.$icons_tr;
}
				
$hover_classes 			= 'thz-hover-bg-'.$hover_bgtype.' '.$hover_ef.' '.$img_ef.' '.$img_tr.$grayscale;				

if($over_mode == 'none'){
	
	$hover_classes = $grayscale !='' ? $grayscale.' thz-transease-04':'';
	$hover_ef 	='';
	$img_ef 	='';
	$img_tr 	= $grayscale !='' ? 'thz-transease-04' : '';
}

if($height == 'custom'){
	
	$img_ratio		= ' thz-media-custom-size';
	$img_mask		= ' thz-hover-img-mask';
	
}else if ($height == 'auto'){
	
	$img_ratio		= ' thz-media-height-auto';
	$img_mask		= '';
	
}else{
	
	$img_ratio		= ' thz-aspect '.$height;
	$img_mask		= ' thz-hover-img-mask';
}

$media_size			= thz_akg('media_size',$atts,'thz-img-medium');
$img_meta 			= wp_prepare_attachment_for_js($image['attachment_id']); 
$img_title 			= esc_attr( $img_meta['title'] );
$img_alt 			= $img_meta['alt'] == '' ? $img_title : esc_attr( $img_meta['alt']);
$style 				= $height == 'auto' ? '' : thz_print_img_style( $image, $media_size );
$swap_output 		= '';
$swap				= thz_akg('swap',$atts,'inactive');

if($swap =='active'){
	
	$swap_image		= thz_akg('swapimg',$atts,null); 
	$swapimg_size	= thz_akg('swapimg_size',$atts,'thz-img-medium');
	$swap_action	= thz_akg('swap_action',$atts,'hover');
	$swap_meta 		= wp_prepare_attachment_for_js($swap_image['attachment_id']); 
	$swap_src 		= thz_get_img_src($swap_image['attachment_id'], $swapimg_size);

	$swap_style  	= thz_print_img_style( $swap_image, $swapimg_size );
	$swap_class 	= $height =='auto' ? 'thz-swap-img is_auto': 'thz-swap-img';
	
	$swap_output .='<div class="'.thz_sanitize_class($swap_class).' thz-swap-on-'.esc_attr($swap_action).'"';
	$swap_output .=' data-swap="'.esc_url ( $swap_src ).'" '.$swap_style.'>';
	$swap_output .='</div>';
}


if($over_mode == 'reveal' || $over_mode == 'directional'){

	if($over_mode == 'reveal'){
		
		$reveal_effect 	= thz_akg('reveal_effect/effect',$atts,'thz-reveal-goleft'); 
		$transition 	= thz_akg('reveal_effect/transition',$atts,'thz-transease-04'); 
		$reveal_class	= 'thz-overlay-box '.$reveal_effect.' '.$transition;
		
	}else{
		
		$reveal_class = 'thz-overlay-box'; 
	}
	
	if($over_mode == 'directional'){
		$overlay_box .='<div class="thz-overlay-box-directional">';
	}
	
	$overlay_box .='<div class="'.thz_sanitize_class($reveal_class).'">';
	if($show_media_icon =='show'){
		$overlay_box .='<div class="thz-overlay-box-icon">';
		$overlay_box .='<div class="thz-hover-icon '.thz_sanitize_class($icon_classes).'">';
		$overlay_box .='<span class="'.thz_sanitize_class($overlay_icon).'">';
		$overlay_box .='</span>';
		$overlay_box .='</div>';
		$overlay_box .='</div>';
	}
	
	$overlay_box .='</div>';
	
	if($over_mode == 'directional'){
		 $overlay_box .='</div>';
	}
	
		
}

if($click !='none'){
	
	if($click =='lightbox'){
		
		$link_output ='<a class="thz-hover-link thz-lightbox mfp-image" href="#" '.thz_lightbox_data($atts).'';
		$link_output .=' data-mfp-src="'.esc_url( $image['url'] ).'" data-mfp-title="'.esc_attr( $img_title ).'">';
		$link_output .='</a>';
	}

	if($click =='link' && $link){
		$link_output ='<a ';
		if($link['type'] == 'normal'){
			
			$link_output .='class="thz-hover-link" href="'.esc_url( $link['url'] ).'" target="'.esc_attr($link['target']).'">';
			
		}else{
			
			$link_output .='class="thz-hover-link thz-trigger-lightbox" href="'.esc_url($link['magnific']).'">';
		}
		$link_output .='</a>';
	}
	
}


if($show_caption == 'show'){
	$image_caption .= '<div class="thz-media-image-caption">';
	$image_caption .= $img_meta['caption'];
	$image_caption .= '</div>';
}

$holder_classes = $css_class.'thz-shc thz-media-image-container'.$mode_class.$animate_parent.$cpx_class.$res_class;
$item_classes 	= 'thz-media-item thz-media-item-image'.$animation_class;


//container
$image_html = '<div id="'.esc_attr($id_out).'" class="'.thz_sanitize_class($holder_classes).'"'.thz_sanitize_data($cpx_data).'>';

//thz-media-item-image
$image_html .= '<div class="'.thz_sanitize_class($item_classes).'"'.thz_sanitize_data($animate_data).'>';

//thz-ratio 
if ($height !='auto' ) { 
	$image_html .= '<div class="thz-media-image-ratio'.thz_sanitize_class($img_ratio).'">';
	$image_html .= '<div class="thz-ratio-in">';
}

//thz-hover
if ( $over_mode !='none'  || $grayscale !='' || $height !='auto' ) { 
	if($mpx_print){
		$hover_classes .=' has-media-cpx';
	}
	$image_html .= '<div class="thz-hover'.esc_attr ( $img_mask ).' '.thz_sanitize_class($hover_classes).'"'.thz_sanitize_data($style).'>';
	if($mpx_print){
		$image_html .= $mpx_print;
	}
}
$image_html .= $overlay_box;
if ($height =='auto' ) {
	$image_html .= thz_print_img_html($image, $media_size, array('class' => $img_tr , 'alt' => $img_alt));
}
if ( $over_mode =='none' ) {
	$image_html .= $link_output;
}
$image_html .= $swap_output;

//thz-hover-mask
if ( $over_mode !='none' ) {
	$image_html .= '<div class="thz-hover-mask'.thz_sanitize_class($hover_tr).'">';
	
	// thz-hover-mask-table
	if($show_media_icon =='show' && $over_mode =='thzhover'){
		$image_html .= '<div class="thz-hover-mask-table">';
	}
	
	$image_html .= $link_output;
	if($show_media_icon =='show' && $over_mode =='thzhover'){
		$image_html .= '<div class="thz-hover-icons '.thz_sanitize_class($iconef_classes).'">';
		$image_html .= '<div class="thz-hover-icon '.thz_sanitize_class($icon_classes).'">';
		$image_html .= '<span class="'.thz_sanitize_class($overlay_icon).'">';
		$image_html .= '</span>';
		$image_html .= '</div>';
		$image_html .= '</div>';
	}
	
	// thz-hover-mask-table
	if($show_media_icon =='show' && $over_mode =='thzhover'){
		$image_html .= '</div>';
	}
	
	$image_html .= '</div>';
	
}

// thz-hover
if ( $over_mode !='none'  || $grayscale !='' || $height !='auto' ) {
	$image_html .= '</div>';
}

// thz-ratio
if ( $height !='auto' ) {
	$image_html .= '</div>';
	$image_html .= '</div>';
}

//thz-media-item-image
$image_html .= '</div>';

$image_html .= $image_caption;

//container
$image_html .='</div>';


// output
echo $image_html;


?>