<?php if ( ! defined( 'FW' ) ) {die( 'Forbidden' );} 
$id 				= thz_akg('id',$atts);
$css_id 			= thz_akg('cmx/i',$atts);
$id_out				= !empty($css_id) ? str_replace(' ','',$css_id): 'thz-cta-'.$id;
$css_class 			= thz_akg('cmx/c',$atts);
$css_class			= $css_class !='' ? $css_class.' ':'';
$res_class			= _thz_responsive_classes(thz_akg('cmx',$atts));
$heading 			= thz_akg('heading',$atts);
$subheading 		= thz_akg('subheading',$atts);
$elements_layout	= thz_akg('elements_layout',$atts);
$text 				= do_shortcode(thz_akg('text',$atts));
$show_button1 		= thz_akg('show_button1/picked',$atts);
$show_button2 		= thz_akg('show_button2/picked',$atts);
$buttons_align		= thz_akg('buttons_align',$elements_layout);
$buttons_position	= thz_akg('buttons_position',$elements_layout);
$spacers 			= thz_akg('spacers',$atts);
$button1_spacer		= thz_akg('button1',$spacers);
$button2_spacer		= thz_akg('button2',$spacers);
$icon 				= thz_akg('icon',$atts);
$icon_size 			= thz_akg('icon_size',$atts);
$icon_position 		= thz_akg('icon_position',$elements_layout);
$icon_align 		= thz_akg('icon_align',$elements_layout);
$icon_spacer		= thz_akg('icon',$spacers);
$animate			= thz_akg('animate',$atts);
$animation_data		= thz_print_animation($animate);
$animation_class	= thz_print_animation($animate,true);
$cpx				= thz_akg('cpx',$atts);
$cpx_data			= thz_print_cpx($cpx);
$cpx_class			= thz_print_cpx($cpx,true);
$text_align			= ' '.thz_akg('text_align',$elements_layout); 
$icon_shape			= thz_akg('icon_shape/picked',$atts);
$icon_shape_type	= thz_akg('icon_shape/active/type/picked',$atts);
$shape_padding_op	= thz_akg('icon_shape/active/shape_padding',$atts);
$shape_padding		= '';
$icon_shape_class	= '';
$shape_radius		='';

if($icon_shape =='active'){
	
	if($icon_shape_type != 'thz-cta-ishape-square'){
		$shape_radius_op = thz_akg('icon_shape/active/type/thz-cta-ishape-rounded/radius',$atts); 
		$shape_radius	 = $icon_shape_type == 'thz-cta-ishape-rounded' ? ' thz-radius-'.$shape_radius_op : '';
		$icon_shape_class = ' '.$icon_shape_type;
	}
	
	$shape_padding		= ' thz-vp-'.$shape_padding_op.' thz-hp-'.$shape_padding_op;
}


$html  ='';
$icon_html ='';
$button_html ='';
$button1_html ='';
$button2_html ='';
$button1_spacer	='<div class="thz-cta-spacer thz-spacer-'.$button1_spacer.'"></div>';
$button2_spacer	='<div class="thz-cta-spacer thz-spacer-'.$button2_spacer.'"></div>';
$icon_spacer	='<div class="thz-cta-spacer thz-spacer-'.$icon_spacer.'"></div>';

if($icon !=''){
	$icon_html .='<div class="thz-cta-icon '.$icon_align.'">';
	$icon_html .='<div class="thz-cta-icon-in'.$icon_shape_class.$shape_radius.$shape_padding.'">';
	$icon_html .='<span class="'.$icon.' '.$icon_size.'"></span>';
	$icon_html .='</div>';
	$icon_html .='</div>';
}


if($show_button1 == 'show'){
	
	
	if($buttons_position == 'right'){
		
		$button1_html .= $button1_spacer;
	}
	$button1_html .='<div class="thz-cta-button cta-btn-1 '.$buttons_align.'">';
	$button1_html .= thz_akg('show_button1/show/cta_button1/html',$atts);
	$button1_html .='</div>';
	if($buttons_position == 'left'){
		
		$button1_html .= $button1_spacer;
	}
}

if($show_button2 == 'show'){
	if($buttons_position == 'right' || $buttons_position == 'bottom'){
		
		$button2_html .= $button2_spacer;
	}
	$button2_html .='<div class="thz-cta-button cta-btn-2 '.$buttons_align.'">';
	$button2_html .= thz_akg('show_button2/show/cta_button2/html',$atts);
	$button2_html .='</div>';
	if($buttons_position == 'left'){
		
		$button2_html .= $button2_spacer;
	}
}


$button_html .= $button1_html.$button2_html;


if($buttons_position == 'left'){
	$html .= $button_html;
}
if($icon_position == 'left' && $icon !=''){
	$html .= $icon_html.$icon_spacer;
}
$html .='<div class="thz-cta-text-holder thz-va-middle">';
	if($icon_position == 'top' && $icon !=''){
		$html .= $icon_html;
	}
if($heading !='' || $subheading !=''){
	$html .='<div class="thz-cta-heading-holder">';
	if($heading !=''){
		$html .='<h2 class="thz-cta-heading">'.esc_attr($heading).'</h2>';
	}
	if($subheading !=''){
		$html .='<span class="thz-cta-subheading">'.esc_attr($subheading).'</span>';
	}
	$html .='</div>';
}
if($text !=''){
	$html .='<div class="thz-cta-text">';
	$html .= thz_html_trans(esc_textarea(do_shortcode($text)));
	$html .='</div>';
	if($buttons_position == 'bottom'){
		$html .= '<div class="thz-cta-bottom-buttons">';
		$html .= $button_html;
		$html .= '</div>';
	}
}
$html .='</div>';
if($icon_position == 'right' && $icon !=''){
	$html .= $icon_spacer.$icon_html;
}
if($buttons_position == 'right'){
	$html .= $button_html;
}
$holder_classes = $css_class.'thz-shc thz-cta-box-holder'.$text_align.$animation_class.$cpx_class.$res_class;
?>
<div id="<?php echo esc_attr($id_out) ?>" class="<?php echo thz_sanitize_class($holder_classes); ?>"<?php echo thz_sanitize_data($animation_data.$cpx_data)?>>
	<div class="thz-cta-box"><?php echo $html ?></div>
</div>