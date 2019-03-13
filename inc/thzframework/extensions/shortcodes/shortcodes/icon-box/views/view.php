<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}
/**
 * @var array $atts
 */
 
$id					= thz_akg('id',$atts); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.OverrideProhibited
$css_id 			= thz_akg('cmx/i',$atts);
$id_out				= !empty($css_id) ? str_replace(' ','',$css_id): 'thz-icon-box-'.$id;
$css_class 			= thz_akg('cmx/c',$atts);
$css_class			= $css_class !='' ? $css_class.' ':'';
$instyle			= thz_akg('instyle',$atts);
$instyle			= $instyle !='' ? 'thz-ib-'.$instyle.' ':'';
$res_class			= _thz_responsive_classes(thz_akg('cmx',$atts));
$icon				= thz_akg('icon_metrics/icon',$atts);
$noicon				= empty($icon) ? '?' : '';
$iconimg			= thz_akg('iconimg',$atts);
$heading			= thz_akg('heading',$atts);
$text_op			= do_shortcode( thz_akg('text',$atts) );
$icon_position		= thz_akg('icon_metrics/position',$atts);
$animate			= thz_akg('animate',$atts);
$an_data			= thz_print_animation($animate);
$an_class			= thz_print_animation($animate,true);
$ic_animate			= thz_akg('icon_animate',$atts);
$ic_an_data			= thz_print_animation($ic_animate);
$ic_an_class		= thz_print_animation($ic_animate,true);
$cpx				= thz_akg('cpx',$atts);
$cpx_data			= thz_print_cpx($cpx);
$cpx_class			= thz_print_cpx($cpx,true);
$icon_shape			= thz_akg('icon_shape/picked',$atts);
$button				= thz_akg('button/picked',$atts); 
$icon_align			= thz_akg('icon_metrics/valign',$atts); 
$link_type			= thz_akg('link_type',$atts); 
$apply_link			= thz_akg('apply_link',$atts);

 
$icon_html			= '';
$text				= '';
$overlink_html		= '';
$button_html		= '';
$button_link		= '';

if(!empty($text_op)){
	
	$text .='<div class="thz-icon-box-text">';
	$text .= $text_op;
	$text .='</div>';
	
}

if(!empty($iconimg)){
	
	$size	= thz_akg('icon_metrics/size',$atts);
	$icon	= 'thz-image-icon';
	$is_svg = pathinfo($iconimg['url'],PATHINFO_EXTENSION );
	
	if($is_svg =='svg'){
		
		$icon			= 'thz-svg-icon';
		$noicon	 		= thz_svg_icon($iconimg,$id);
		$color_mode		= thz_akg('icon_metrics/mode',$atts,'color');
		$ic_an_class	= $ic_animate['effect'] == 'thz-anim-draw-svg' && $color_mode !='stroke' ? ' thz-anim-inactive-not-stroke' : $ic_an_class;
		
	}else{
	
		$noicon ='<img src="'.$iconimg['url'].'" width="'.esc_attr($size).'" height="'.esc_attr($size).'" alt="'.get_the_title($iconimg['attachment_id']).'" />';
	
	}
}

// heading link
if($apply_link !== 'button'){
	
	$btn_options 	= json_decode( thz_akg('iconbox_button/json',$atts), true);
	$iconbox_link	= thz_akg('iconbox_link',$atts);
	$link_type_op	= $iconbox_link['type']; 
	$modal_class	= $link_type_op == 'magnific' ? ' thz-trigger-lightbox' :'';
	$target			= $link_type_op == 'normal' && $iconbox_link['target'] =='_blank'? ' target="_blank"' :'';
	$title			= $link_type_op == 'normal' && $iconbox_link['title'] !=='' ? ' title="'.esc_attr($iconbox_link['title']).'"' :''; // phpcs:ignore WordPress.WP.GlobalVariablesOverride.OverrideProhibited
	$hash			= thz_contains($iconbox_link['magnific'],array('#','http')) ? '' :'#';
	$link			= $link_type_op == 'normal' ? esc_url($iconbox_link['url']) : $hash.esc_attr($iconbox_link['magnific']) ; // phpcs:ignore WordPress.WP.GlobalVariablesOverride.OverrideProhibited
	$overlink		= thz_akg('ovl_mx/m',$atts,'inactive');
	$a_markup		= thz_akg('ovl_mx/a',$atts,'anchor');
	
	if($link !==''){

		if('active' == $overlink){
			$overlink_html = '<a class="thz-icon-box-overlink'.$modal_class.'" href="'.$link.'"'.$title.$target.'></a>';
		}
		
		if('active' == $overlink && 'remove' == $a_markup){
			$heading_output = strip_tags( $heading,'<p><br><span><b><strong><a><i><em>');
		}else{
			
			$heading_output = '<a class="thz-heading-link'.$modal_class.'" href="'.$link.'"'.$title.$target.'>';
			$heading_output .= strip_tags( $heading,'<p><br><span><b><strong><a><i><em>');
			$heading_output .= '</a>';			
		}
	
		$heading = $heading_output;
		

	}

}


// read more button
if($apply_link !== 'title'){
	
	$hover_trigger	= thz_akg('hover_trigger',$atts);
	$trigger_hover	= $hover_trigger =='iconbox' ? ' triggerhover' : '';
	
	$button_html  ='<div class="thz-ib-button'.thz_sanitize_class($trigger_hover).'">';
	$button_html .= thz_akg('iconbox_button/html',$atts);
	$button_html .='</div>';
	
}

// icon shape
if($icon_shape == 'active'){

	$effect 		= thz_akg('icon_shape/active/effect/type',$atts); 
	$ef_class		='';
	if($effect != 'none'){
		$ef_class 		= ' thz-icon-shape-'.$effect;
		$firstcont  	= array('sonar','pulsate','halo');
		$secondcont  	= array('fillup','filldown','fillleft','fillright','spinme','justhover');
		$ef_data		= ' data-trigger="trigger.thz-icon-box" data-effect="'.esc_attr($effect).'"';
	}
	
	$shape_type = thz_akg('icon_shape/active/type/picked',$atts); 
	$bg_type 	= thz_akg('icon_shape/active/sh_metrics/bw',$atts) > 0 ? 'solidborder' : 'solid';
	$space	 	= thz_akg('icon_shape/active/sh_metrics/sp',$atts); 
	$space_class = $space > 0 ? ' thz-icon-bt-spaced' : '';
	$icon_html .='<div class="thz-icon-shape-container">';
	$icon_html .='<div class="thz-icon-shape thz-icon-st-'.esc_attr($shape_type).' thz-icon-bt-'.thz_sanitize_class($bg_type.$space_class.$ef_class).'">';
	
	if($effect != 'none' && in_array($effect,$firstcont)){
		$icon_html .='<div class="thz-icon-shape-effect"'.thz_sanitize_data($ef_data).'></div>';
	}
	
	$icon_html .='<div class="thz-icon-shape-in thz-icon-st-'.esc_attr($shape_type).' thz-icon-bt-'.esc_attr($bg_type).'">';
	
	if($effect != 'none' && in_array($effect,$secondcont)){
		$icon_html .='<div class="thz-icon-shape-effect"'.thz_sanitize_data($ef_data).'></div>';
	}
}

$icon_html .= '<i class="'.esc_attr($icon).'">'.$noicon.'</i>';

// close icon shape
if($icon_shape == 'active'){
	$icon_html .='</div>';
	$icon_html .='</div>';
	$icon_html .='</div>';
}

$icon_align_class= ' '.$icon_align;

$iconclass = 'thz-icon-holder'.$ic_an_class;
$output ='';
if($icon_position == 'center' || $icon_position == 'centertop' || $icon_position == 'topleft' || $icon_position == 'topright'){
	if($icon !==''){
		$output .='<div class="'.thz_sanitize_class($iconclass).'"'.thz_sanitize_data($ic_an_data).'>'.$icon_html.'</div>';
	}
	$output .='<div class="thz-icon-box-heading-holder">';
		$output .='<div class="thz-icon-box-heading">';
			$output .='<h3 class="thz-icon-box-title">'.$heading.'</h3>';
		$output .='</div>';
	$output .='</div>';
	if($text !='' || $button_html !=''){
		$output .='<div class="thz-icon-box-text-holder">'.thz_html_trans(esc_textarea($text).$button_html).'</div>';
	}
}

if($icon_position == 'left'){
	$output  .='<div class="thz-icon-box-heading-holder">';
		if($icon !==''){
			$output .='<div class="'.thz_sanitize_class($iconclass.$icon_align_class).'"'.thz_sanitize_data($ic_an_data).'>'.$icon_html.'</div>';
		}
		$output .='<div class="thz-icon-box-text-holder">';
			$output  .='<div class="thz-icon-box-heading-holder">';
			$output .='<div class="thz-icon-box-heading">';
				$output .='<h3 class="thz-icon-box-title">'.$heading.'</h3>';
			$output .='</div>';
			$output .='</div>';
			$output .= thz_html_trans(esc_textarea($text).$button_html);
		$output .='</div>';
	$output .='</div>';
	
}
if($icon_position == 'right'){
	$output  .='<div class="thz-icon-box-heading-holder">';
		$output .='<div class="thz-icon-box-text-holder">';
			$output .='<div class="thz-icon-box-heading">';
				$output .='<h3 class="thz-icon-box-title">'.$heading.'</h3>';
			$output .='</div>';
			$output .= thz_html_trans(esc_textarea($text).$button_html);
			$output .='</div>';
		if($icon !==''){
			$output .='<div class="'.thz_sanitize_class($iconclass.$icon_align_class).'"'.thz_sanitize_data($ic_an_data).'>'.$icon_html.'</div>';
		}
	$output .='</div>';
	
}
if($icon_position == 'leftheading'){
	$output  .='<div class="thz-icon-box-heading-holder">';
		if($icon !==''){
			$output .='<div class="'.thz_sanitize_class($iconclass.$icon_align_class).'"'.thz_sanitize_data($ic_an_data).'>'.$icon_html.'</div>';
		}
		$output .='<div class="thz-icon-box-heading">';
			$output .='<h3 class="thz-icon-box-title">'.$heading.'</h3>';
		$output .='</div>';
	$output .='</div>';
	if($text !='' || $button_html !=''){
		$output .='<div class="thz-icon-box-text-holder">'.thz_html_trans(esc_textarea($text).$button_html).'</div>';
	}
}

if($icon_position == 'rightheading'){
	$output  .='<div class="thz-icon-box-heading-holder">';
		$output .='<div class="thz-icon-box-heading">';
			$output .='<h3 class="thz-icon-box-title">'.$heading.'</h3>';
		$output .='</div>';
		if($icon !==''){
			$output .='<div class="'.thz_sanitize_class($iconclass.$icon_align_class).'"'.thz_sanitize_data($ic_an_data).'>'.$icon_html.'</div>';
		}
	$output .='</div>';
	if($text !='' || $button_html !=''){
		$output .='<div class="thz-icon-box-text-holder">'.thz_html_trans(esc_textarea($text).$button_html).'</div>';
	}
}
$output .= $overlink_html;


$icon_box_class = $instyle.$css_class.'thz-shc thz-ib-'.$id_out.' thz-icon-box thz-icon-poz-'.$icon_position.$an_class.$cpx_class.$res_class;

?>
<div id="<?php echo esc_attr($id_out);?>" class="<?php echo thz_sanitize_class($icon_box_class)?>"<?php echo thz_sanitize_data($an_data.$cpx_data)?>>
	<?php echo $output; ?>
</div>