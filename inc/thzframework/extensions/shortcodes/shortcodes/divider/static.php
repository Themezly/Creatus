<?php if (!defined('FW')) die('Forbidden');

/*
	custom css for divider

*/
if(!function_exists('_thz_divider_css')){
	
	function _thz_divider_css ($data) {
	
		$atts 		= _thz_shortcode_options($data,'divider');
		$id 		= thz_akg('id',$atts);
		$css_id 	= thz_akg('cmx/i',$atts);
		$id_out		= !empty($css_id) ? str_replace(' ','',$css_id): 'thz-divider-'.$id;
		$type  		= thz_akg('divider_type',$atts);
		$box_style	= thz_akg($type.'_bs',$atts);
		$style		= thz_akg('style/picked',$atts);
		$max_width	= thz_akg('style/'.$style.'/max_width',$atts);
		
		
		// main metrics
		$holder		= $type ==='horizontal' ? '.thz-divider-holder' :'.thz-divider-spacer';
		$add_css 	= '#'.$id_out.'.thz-divider-'.$id.'.thz-shc{'.thz_print_box_css($box_style).'}';
		
		
		// line
		if($style === 'line' && $type === 'horizontal'){
			
			$line_type 			= thz_akg('style/line/linetype/picked',$atts); 
			$border_width		= thz_akg('style/line/border/w',$atts);
			$border_style		= thz_akg('style/line/border/s',$atts);
			$border_color		= thz_akg('style/line/border/c',$atts);
			$divider_icon 		= thz_akg('style/line/divider_icon/picked',$atts);
			$icon 				= thz_akg('style/line/divider_icon/show/icon_metrics/icon',$atts);
			$icon_css			='';
			
			 
			if($divider_icon === 'show' && !empty($icon)){
				
				$icon_metrics 	= thz_akg('style/line/divider_icon/show/icon_metrics',$atts);
				$icon_color 	= thz_akg('style/line/divider_icon/show/icon_metrics/color',$atts);
				
				$icon_css	.='.thz-divider-'.$id.' .thz-divider-hasicon .thz-divider-icon{';
				$icon_css	.='font-size:'.esc_attr(thz_akg('size',$icon_metrics)).'px;';
				$icon_css	.='padding-left:'.esc_attr(thz_akg('padding',$icon_metrics)).'px;';
				$icon_css	.='padding-right:'.esc_attr(thz_akg('padding',$icon_metrics)).'px;';
				$icon_css	.='color:'.esc_attr($icon_color).';';
				$icon_css	.='}';
				
				
				$divider_classes  = '.thz-divider-'.$id.' .thz-divider-hasicon.thz-divider-'.$line_type.' .thz-divider-left:before,';
				$divider_classes .= '.thz-divider-'.$id.' .thz-divider-hasicon.thz-divider-'.$line_type.' .thz-divider-right:before';		
				
			}else{
				
				$divider_classes = '.thz-divider-'.$id.' .thz-divider.thz-divider-'.$line_type;
			}
			
			$add_css .= $divider_classes.'{';
			$add_css .='border-top:'.esc_attr($border_width).'px '.esc_attr($border_style).' '.esc_attr($border_color).';';
			if($line_type === 'doubleline'){
				
				$double_line_height = thz_akg('style/line/linetype/doubleline/height',$atts);
				
				$add_css .='border-bottom:'.esc_attr($border_width).'px '.esc_attr($border_style).' '.esc_attr($border_color).';';
				$add_css .='height:'.esc_attr($double_line_height).'px;';
			}
			$add_css .='}';	
			$add_css .= $icon_css;
			
			if(!empty($max_width) && $max_width !=='100%'){
				
				$dividerclass = $divider_icon ==='show' && !empty($icon) ? '-hasicon' :'';
				$add_css .=	'.thz-divider-'.$id.' .thz-divider'.$dividerclass.'{max-width:'.thz_property_unit($max_width,'px').';}';
			
			}		
			
	
			
		}
		// dualcolor
		if($style === 'dualcolor' && $type === 'horizontal'){
			
			$dual_height 	= thz_akg('style/dualcolor/height',$atts); 
			$long_color 	= thz_akg('style/dualcolor/long_color',$atts);
			$short_color 	= thz_akg('style/dualcolor/short_color',$atts);
			$short_width	= thz_akg('style/dualcolor/short_width',$atts);
			
			
			
			$add_css .=	'.thz-divider-'.$id.' .thz-divider-dualcolor{';
			$add_css .=	'background:'.esc_attr( $long_color ).';';
			$add_css .=	'height:'.thz_property_unit($dual_height,'px').';';
			$add_css .=	'}';
			$add_css .=	'.thz-divider-'.$id.' .thz-divider-dualcolor:before{';
			$add_css .=	'max-width:'.thz_property_unit($short_width,'px').';';
			$add_css .=	'background:'.esc_attr( $short_color ).';';
			$add_css .=	'}';
			
			if(!empty($max_width) && $max_width !=='100%'){
				
				$add_css .=	'.thz-divider-'.$id.' .thz-divider-dualcolor{max-width:'.thz_property_unit($max_width,'px').';}';
			
			}		
		}
		
		// shadow
		if($style === 'shadow' && $type === 'horizontal'){
			
			$shadow_height 		= thz_akg('style/shadow/shadow_height',$atts);
			$shadow_color 		= thz_akg('style/shadow/shadow_color',$atts);
			$divider_icon 		= thz_akg('style/shadow/divider_icon/picked',$atts);
			$icon 				= thz_akg('style/shadow/divider_icon/show/icon_metrics/icon',$atts);
			$icon_css			='';
			
			
			if($divider_icon === 'show' && !empty($icon)){
				
				
				$icon_metrics 	= thz_akg('style/shadow/divider_icon/show/icon_metrics',$atts);
				$icon_color 	= thz_akg('style/shadow/divider_icon/show/icon_metrics/color',$atts);
				
				$icon_css	.='.thz-divider-'.$id.' .thz-divider-hasicon .thz-divider-icon{';
				$icon_css	.='font-size:'.esc_attr(thz_akg('size',$icon_metrics)).'px;';
				$icon_css	.='padding-left:'.esc_attr(thz_akg('padding',$icon_metrics)).'px;';
				$icon_css	.='padding-right:'.esc_attr(thz_akg('padding',$icon_metrics)).'px;';
				$icon_css	.='color:'.esc_attr($icon_color).';';
				$icon_css	.='}';
				
				
				
				$add_css .=	'.thz-divider-'.$id.' .thz-divider-has-icon-shadow .thz-divider-left:before,';
				$add_css .=	'.thz-divider-'.$id.' .thz-divider-has-icon-shadow .thz-divider-right:before{';
				$add_css .='height:'.thz_property_unit($shadow_height,'px').';';	
				$add_css .='}';	
				
				
				$add_css .=	'.thz-divider-'.$id.' .thz-divider-has-icon-shadow .thz-divider-left:after,';
				$add_css .=	'.thz-divider-'.$id.' .thz-divider-has-icon-shadow .thz-divider-right:after{';
				$add_css .='top:-'.thz_property_unit($shadow_height,'px').';';	
				$add_css .='}';	
				
				
				$add_css .='.thz-divider-'.$id.' .thz-divider-has-icon-shadow .thz-divider-left:before,';
				$add_css .='.thz-divider-'.$id.' .thz-divider-has-icon-shadow .thz-divider-left:after{';
				$add_css .='background: radial-gradient(ellipse at 100% -50%, '.esc_attr($shadow_color).' 0px, rgba(0, 0, 0, 0) 80%);';
				$add_css .='background: -ms-radial-gradient(ellipse at 100% -50%, '.esc_attr($shadow_color).' 0px, rgba(0, 0, 0, 0) 80%);';
				$add_css .='background: -moz-radial-gradient(ellipse at 100% -50%, '.esc_attr($shadow_color).' 0px, rgba(0, 0, 0, 0) 80%);';
				$add_css .='background: -webkit-radial-gradient(ellipse at 100% -50%, '.esc_attr($shadow_color).' 0px, rgba(0, 0, 0, 0) 80%);';
				$add_css .='}';
				
				
				$add_css .='.thz-divider-'.$id.' .thz-divider-has-icon-shadow .thz-divider-right:before,';
				$add_css .='.thz-divider-'.$id.' .thz-divider-has-icon-shadow .thz-divider-right:after{';
				$add_css .='background: radial-gradient(ellipse at 0% -50%, '.esc_attr($shadow_color).' 0px, rgba(0, 0, 0, 0) 80%);';
				$add_css .='background: -ms-radial-gradient(ellipse at 0% -50%, '.esc_attr($shadow_color).' 0px, rgba(0, 0, 0, 0) 80%);';
				$add_css .='background: -moz-radial-gradient(ellipse at 0% -50%, '.esc_attr($shadow_color).' 0px, rgba(0, 0, 0, 0) 80%);';
				$add_css .='background: -webkit-radial-gradient(ellipse at 0% -50%, '.esc_attr($shadow_color).' 0px, rgba(0, 0, 0, 0) 80%);';
				$add_css .='}';	
				$add_css .= $icon_css;			
				
			}else{
				
				$add_css .=	'.thz-divider-'.$id.' .thz-divider-shadow{height:'.thz_property_unit($shadow_height,'px').';}';
				$add_css .=	'.thz-divider-'.$id.' .thz-divider-shadow,';
				$add_css .=	'.thz-divider-'.$id.' .thz-divider-shadow:after{';
				$add_css .='background: radial-gradient(ellipse at 50% -50%, '.esc_attr($shadow_color).' 0px, rgba(0, 0, 0, 0) 80%);';
				$add_css .='background: -ms-radial-gradient(ellipse at 50% -50%, '.esc_attr($shadow_color).' 0px, rgba(0, 0, 0, 0) 80%);';
				$add_css .='background: -moz-radial-gradient(ellipse at 50% -50%, '.esc_attr($shadow_color).' 0px, rgba(0, 0, 0, 0) 80%);';
				$add_css .='background: -webkit-radial-gradient(ellipse at 50% -50%, '.esc_attr($shadow_color).' 0px, rgba(0, 0, 0, 0) 80%);';
				$add_css .='}';
			}
			
			
			
			
			
			if(!empty($max_width) && $max_width !=='100%'){
				
				$dividerclass = $divider_icon ==='show' && !empty($icon) ? '.thz-divider-has-icon-shadow' :'.thz-divider-shadow';
				$add_css .=	'.thz-divider-'.$id.' '.$dividerclass.'{max-width:'.thz_property_unit($max_width,'px').';}';
			
			}		
		}
		
		// block 
		if($style === 'block' && $type === 'horizontal'){
			
			$height 			= thz_akg('style/block/height',$atts);
			$background			= thz_akg('style/block/bg',$atts); 
			$background_print 	= thz_print_box_css(array('background'=>$background));
			
			$add_css .=	'.thz-divider-'.$id.'{';
			$add_css .=	$background_print;
			if(!empty($max_width) && $max_width !=='100%'){
				
				$add_css .=	'max-width:'.thz_property_unit($max_width,'px').';';
			
			}
			$add_css .=	'height:'.thz_property_unit($height,'px').'';			
			$add_css .=	'}';
			
			
		}
		
		
		Thz_Doc::set( 'cssinhead', $add_css );
		
	}
	
	if( !thz_is_inline_css_cached() ){
		add_action('fw_ext_shortcodes_enqueue_static:divider','_thz_divider_css');
	}
}