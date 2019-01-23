<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}
/**
 * @var array $atts
 */
 
$id					= thz_akg('id',$atts);
$css_id 			= thz_akg('cmx/i',$atts);
$id_out				= !empty($css_id) ? str_replace(' ','',$css_id): 'thz-icon-'.$id;
$css_class 			= thz_akg('cmx/c',$atts);
$css_class			= $css_class !='' ? $css_class.' ':'';
$res_class			= _thz_responsive_classes(thz_akg('cmx',$atts));
$icon				= thz_akg('metrics/icon',$atts);
$iconimg			= thz_akg('iconimg',$atts);
$noicon				= empty($icon) ? '?' : '';
$type				= thz_akg('metrics/type',$atts);
$ict				= thz_akg('ict',$atts);
$icontext			= !empty($ict) ? thz_akg('ict/0/tmx/p',$atts): 'none';
$align				= ' thz-icon-align-'.thz_akg('metrics/align',$atts);
$animate			= thz_akg('animate',$atts);
$animation_data		= thz_print_animation($animate);
$animation_class	= thz_print_animation($animate,true);
$cpx				= thz_akg('cpx',$atts);
$cpx_data			= thz_print_cpx($cpx);
$cpx_class			= thz_print_cpx($cpx,true);
$icon_shape			= thz_akg('icon_shape/picked',$atts);
$html				= '';


if(!empty($iconimg)){
	
	$size	= thz_akg('metrics/size',$atts);
	$icon	= 'thz-image-icon';
	$is_svg = pathinfo($iconimg['url'],PATHINFO_EXTENSION );
	
	if($is_svg =='svg'){
		
		$icon				= 'thz-svg-icon';
		$noicon				= thz_svg_icon($iconimg,$id);
		$color_mode			= thz_akg('metrics/mode',$atts,'color');
		$animation_class	= $animate['effect'] == 'thz-anim-draw-svg' && $color_mode !='stroke' ? ' thz-anim-inactive-not-stroke' : $animation_class;

	}else{
	
		$noicon ='<img src="'.$iconimg['url'].'" width="'.esc_attr($size).'" height="'.esc_attr($size).'" alt="'.get_the_title($iconimg['attachment_id']).'" />';
	
	}
}


// has text
if($icontext !='none'){
	$html .='<div class="thz-icon-has-text">';
}
if($icontext == 'left'|| $icontext == 'both'){
	
	$text_left 		= thz_akg('ict/0/text_left',$atts);
	$ani_left 		= thz_akg('ict/0/animate_left',$atts);	
	$ani_data_left	= thz_print_animation($ani_left);
	$ani_class_left	= thz_print_animation($ani_left,true);
	
	
	$html .='<div class="thz-icon-text-left">';
	$html .='<div class="thz-icon-text-in'.thz_sanitize_class($ani_class_left).'"'.thz_sanitize_data($ani_data_left).'>';
	$html .= thz_html_trans(esc_textarea( $text_left ));
	$html .='</div>';
	$html .='</div>';
}
// has text add container
if($icontext !='none'){
	$html .='<div class="thz-icon-text-icon">';
}
// icon shape
if($icon_shape == 'active'){

	$effect 		= thz_akg('icon_shape/active/effect/type',$atts); 
	$ef_class		='';
	if($effect != 'none'){
		
		$ef_trigger 	= thz_akg('icon_shape/active/effect/trigger',$atts);
		$ef_class 		= ' thz-icon-shape-'.$effect;
		$firstcont  	= array('sonar','pulsate','halo');
		$secondcont  	= array('fillup','filldown','fillleft','fillright','spinme','justhover');
		$ef_data		= ' data-trigger="'.esc_attr($ef_trigger).'" data-effect="'.esc_attr($effect).'"';
	}
	
	$shape_type = thz_akg('icon_shape/active/type/picked',$atts); 
	$bg_type 	= thz_akg('icon_shape/active/sh_metrics/bw',$atts) > 0 ? 'solidborder' : 'solid';
	$space	 	= thz_akg('icon_shape/active/sh_metrics/sp',$atts); 
	$space_class = $space > 0 ? ' thz-icon-bt-spaced' : '';
	$html .='<div class="thz-icon-shape-container">';
	$html .='<div class="thz-icon-shape thz-icon-st-'.thz_sanitize_class($shape_type).' thz-icon-bt-'.thz_sanitize_class($bg_type.$space_class.$ef_class).'">';
	
	if($effect != 'none' && in_array($effect,$firstcont)){
		$html .='<div class="thz-icon-shape-effect"'.thz_sanitize_data($ef_data).'></div>';
	}
	
	$html .='<div class="thz-icon-shape-in thz-icon-st-'.thz_sanitize_class($shape_type).' thz-icon-bt-'.thz_sanitize_class($bg_type).'">';
	
	if($effect != 'none' && in_array($effect,$secondcont)){
		$html .='<div class="thz-icon-shape-effect"'.thz_sanitize_data($ef_data).'></div>';
	}
}

if($type == 'link'){
	
	
	$icon_link		= thz_akg('icon_link',$atts); 
	$link_type		= $icon_link['type']; 
	$modal_class	= $link_type == 'magnific' ? ' thz-trigger-lightbox' :'';
	$target			= $link_type == 'normal' && $icon_link['target'] =='_blank'? ' target="_blank"' :'';
	$title			= $link_type == 'normal' && $icon_link['title'] !=='' ? ' title="'.esc_attr($icon_link['title']).'"' :'';
	$hash			= thz_contains($icon_link['magnific'],array('#','http')) ? '' :'#';
	$link			= $link_type == 'normal' ? esc_url($icon_link['url']) : $hash.esc_attr($icon_link['magnific']);
	
	$html .= '<a class="thz-icon-link'.$modal_class.'" href="'.$link.'"'.$title.$target.'>';
	$html .= '<i class="'.esc_attr($icon).'">'.$noicon.'</i>';	
	$html .= '</a>';	


}else{
	
	$html .= '<i class="'.esc_attr($icon).'">'.$noicon.'</i>';	
	
}

// close icon shape
if($icon_shape == 'active'){
	$html .='</div>';
	$html .='</div>';
	$html .='</div>';
}

// close has text add container
if($icontext !='none'){
	$html .='</div>';
}

	
if($icontext == 'right'|| $icontext == 'both'){
	
	$text_right 		= thz_akg('ict/0/text_right',$atts);
	$ani_right			= thz_akg('ict/0/animate_right',$atts);	
	$ani_data_right		= thz_print_animation($ani_right);
	$ani_class_right 	= thz_print_animation($ani_right,true);
	
	
	
	$html .='<div class="thz-icon-text-right">';
	$html .='<div class="thz-icon-text-in'.thz_sanitize_class($ani_class_right).'"'.thz_sanitize_data( $ani_data_right ).'>';
	$html .= thz_html_trans(esc_textarea($text_right));
	$html .='</div>';
	$html .='</div>';
}
// close has text
if($icontext !='none'){
	$html .='</div>';
}

$class = $css_class.'thz-shc thz-icon-'.$id.' thz-icon-holder thz-icon-'.$type.$align.$animation_class.$cpx_class.$res_class;

?>
<div id="<?php echo esc_attr($id_out)?>" class="<?php echo thz_sanitize_class($class)?>"<?php echo thz_sanitize_data($animation_data.$cpx_data) ?>><?php echo $html ?></div>