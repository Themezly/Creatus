<?php if (!defined('FW')) die('Forbidden');

/*
	custom css for icons

*/
if(!function_exists('_thz_icon_css')){
	
	function _thz_icon_css ($data) {
	
		$atts 				= _thz_shortcode_options($data,'icon');
		$id					= thz_akg('id',$atts);
		$css_id 			= thz_akg('cmx/i',$atts);
		$id_out				= !empty($css_id) ? str_replace(' ','',$css_id): 'thz-icon-'.$id;
		$size				= thz_property_unit(thz_akg('metrics/size',$atts),'px');
		$type				= thz_akg('metrics/type',$atts);
		$icon_color			= thz_akg('metrics/color',$atts);
		$color_mode			= thz_akg('metrics/mode',$atts,'color');
		$icon_boxstyle		= thz_print_box_css(thz_akg('boxstyle',$atts)); 
		$icontext			= thz_akg('ict',$atts);
		$icon_shape			= thz_akg('icon_shape/picked',$atts);
		$ict				= thz_akg('ict',$atts);
		$add_css 			= '';
		
		$iconimg			= thz_akg('iconimg',$atts);
		$is_svg				= false;
		
		if(!empty($iconimg)){
			$img_type = pathinfo($iconimg['url'],PATHINFO_EXTENSION );
			if($img_type == 'svg' ){
				
				$is_svg	= true;
				if($size != ''){
					$add_css .= '#'.$id_out.' svg{';
					$add_css .='width:'.$size.';';
					$add_css .='}';
				}
			}
		}
		
		if($type == 'link'){
			
			$hover_color			= thz_akg('metrics/hovered',$atts);
			
			if($is_svg){
				
				$add_css .= thz_color_svg ('#'.$id_out.' a svg *',$color_mode, $icon_color);
				
			}else{
				
				$add_css .= '#'.$id_out.' a i{';
				if($size != ''){
					$add_css .='font-size:'.$size.';';
				}
				if($icon_color !='' && $color_mode =='color'){
					$add_css .='color:'.$icon_color	.';';
				}
				if($color_mode !='color'){
					$gradient = array(
						'color1' => $icon_color,
						'color2' => thz_akg('metrics/color2',$atts),
						'gradient' => $color_mode
					);
					$add_css .= _thz_gradient_text_css($gradient, true);
				}
				$add_css .='}';
			}
			
			
			if(!empty($hover_color)){
				
				
				if($is_svg){
					
					$add_css .= thz_color_svg ('#'.$id_out.' a:hover svg *',$color_mode, $hover_color);
					
				}else{
				
					$add_css .= '#'.$id_out.' a:hover i{';	
					$add_css .='color:'.$hover_color.';';
					if($color_mode !='color'){
						$h_gradient = array(
							'color1' => $hover_color,
							'color2' => thz_akg('metrics/hovered2',$atts),
							'gradient' => $color_mode
						);
						$add_css .= _thz_gradient_text_css($h_gradient, true);
					}
					$add_css .='}';
				}
			}
			
		}else{
			
			if($is_svg){
				
				$add_css .= thz_color_svg ('#'.$id_out.' svg *',$color_mode, $icon_color);
				
			}else{
				
				$add_css .= '#'.$id_out.' i{';
				$add_css .='font-size:'.$size.';';
				if($icon_color !=''){
					$add_css .='color:'.$icon_color	.';';
				}
				if($color_mode !='color'){
					$gradient = array(
						'color1' => $icon_color,
						'color2' => thz_akg('metrics/color2',$atts),
						'gradient' => $color_mode
					);
					$add_css .= _thz_gradient_text_css($gradient, true);
				}
				$add_css .='}';
			}
		}
		
		
		if($icon_boxstyle !=''){
			
			$add_css .= '#'.$id_out.'.thz-icon-holder.thz-shc{'.$icon_boxstyle.'}';
		}
		
		
		// icon shape
		if($icon_shape == 'active'){

			$shape_type 		= thz_akg('icon_shape/active/type/picked',$atts); 
			$shape_size     	= thz_akg('icon_shape/active/sh_metrics/w',$atts);  
			$shape_bs			= thz_print_box_css(thz_akg('icon_shape/active/sh_bs',$atts));
			
			$shape_border_size 	= thz_akg('icon_shape/active/sh_metrics/bw',$atts);
			
			$shape_bg_type		= $shape_border_size > 0 ? 'solidborder' : 'solid';  
			$shape_color_type	= thz_akg('icon_shape/active/sh_metrics/ct',$atts);
			$shape_color		= thz_akg('icon_shape/active/sh_metrics/bg',$atts);
			$shape_color2		= thz_akg('icon_shape/active/sh_metrics/bg2',$atts); 
			
			$shape_border_color = thz_akg('icon_shape/active/sh_metrics/bc',$atts);
			$shape_border_style = thz_akg('icon_shape/active/sh_metrics/bs',$atts);
			
			$shape_space_size	= thz_akg('icon_shape/active/sh_metrics/sp',$atts);
			$shape_space 		= $shape_space_size > 0 ? true : false;

			$shape_space_bg		= thz_akg('icon_shape/active/sh_metrics/sbg',$atts);

			
			$nudge			= thz_print_box_css(thz_akg('icon_shape/active/nudge',$atts));
			$effect			= thz_akg('icon_shape/active/effect/type',$atts); 
	
			$add_css .= '#'.$id_out.' .thz-icon-shape,.thz-icon-'.$id.' .thz-icon-shape-in';
			$add_css .= '{height:'. thz_property_unit( $shape_size ,'px') .';width:'. thz_property_unit( $shape_size ,'px') .';}';
			$add_css .= '#'.$id_out.' .thz-icon-shape-in';
			$add_css .= '{line-height:'. thz_property_unit( $shape_size ,'px') .';}';

			if(!empty($shape_bs)){
				$add_css .= '#'.$id_out.' .thz-icon-shape{'.$shape_bs.'}';
			}
			
			if($shape_type == 'rounded'){
				$b = thz_property_unit(thz_akg('icon_shape/active/type/rounded/radius',$atts),'px');
				$add_css .= '#'.$id_out.' .thz-icon-st-rounded';
				$add_css .= '{border-radius:'.$b.';}';
			}
	
			if(!empty($shape_color)){

				if( !$shape_space && 'square' != $shape_type ){
					$add_css .= '#'.$id_out.' .thz-icon-shape,';
				}
									
				if(!empty($shape_color2) && 'color' != $shape_color_type){

					$add_css .= '#'.$id_out.' .thz-icon-shape-in{';
					$add_css .= _thz_gradient_background_css($shape_color,$shape_color2,$shape_color_type);
					$add_css .= '}';
					
				}else{
					
					$add_css .= '#'.$id_out.' .thz-icon-shape-in{';
					$add_css .= 'background:'. esc_attr( $shape_color ) .';';
					$add_css .= '}';				
				
				}
			}
	
			if(!empty($shape_border_color)){
				$add_css .='#'.$id_out.' .thz-icon-shape.thz-icon-bt-solidborder';
				$add_css .= '{border:'. thz_property_unit( $shape_border_size ,'px') .' '.$shape_border_style.' '. esc_attr( $shape_border_color ) .';}';
			}
			
			if( $shape_space ){
				
				if(!empty($shape_space_bg)){
					$space_bg = 'background-color:'.$shape_space_bg.';';	
				}else{
					$space_bg = '';
				}
				$add_css .= '#'.$id_out.' .thz-icon-shape.thz-icon-bt-spaced{padding:'. thz_property_unit( $shape_space_size ,'px') .';'.$space_bg.'}';
			}
			
			if(!empty($nudge)){
				$add_css .= '#'.$id_out.' .thz-icon-shape i{'. $nudge .'}';
			}
			
			if($effect != 'none'){
				
				$fillups = array('fillup','filldown','fillleft','fillright'); 
				
				$eff_color 		= thz_akg('icon_shape/active/effect/color',$atts);
				$eff_icon_color = thz_akg('icon_shape/active/effect/icon_color',$atts);
				$eff_background = thz_akg('icon_shape/active/effect/background',$atts);
				
				
				if($effect == 'halo'){

					$add_css .= '#'.$id_out.' .thz-icon-shape-halo.effectactive .thz-icon-shape-effect{border-color:'.$eff_color.';}';
					$add_css .= '#'.$id_out.' .thz-icon-shape-halo.effectactive .thz-icon-shape-in{background:'.$eff_background.';}';
					
					if($is_svg){
						
						$add_css .= thz_color_svg ('#'.$id_out.' .thz-icon-shape-halo.effectactive svg *',$color_mode, $eff_icon_color);
						
					}else{
					
						$add_css .= '#'.$id_out.' .thz-icon-shape-halo.effectactive i:before{';
						$add_css .= 'color:'.$eff_icon_color.';';
						if($color_mode !='color'){
							$ef_gradient = array(
								'color1' => $eff_icon_color,
								'color2' => thz_akg('icon_shape/active/effect/icon_color2',$atts),
								'gradient' => $color_mode
							);
							$add_css .= _thz_gradient_text_css($ef_gradient, true);
						}
						$add_css .= '}';
						
					}
				}
				
				if($effect == 'sonar'){
					
					$add_css .= '#'.$id_out.' .thz-icon-shape-sonar .thz-icon-shape-effect';
					$add_css .= '{box-shadow: 0 0 0 2px rgba(255,255,255,0.1), 0 0 10px 10px '.$eff_color.', 0 0 0 10px rgba(255,255,255,0.5);}';
				}
				
				if($effect == 'justhover'){
					$add_css .= '#'.$id_out.' .thz-icon-shape-'.$effect.'.effectactive .thz-icon-shape-effect{background:'.$eff_color.';}';
					
					if($is_svg){
						
						$add_css .= thz_color_svg ('#'.$id_out.' .thz-icon-shape-'.$effect.'.effectactive svg *',$color_mode, $eff_icon_color);
						
					}else{
					
						$add_css .= '#'.$id_out.' .thz-icon-shape-'.$effect.'.effectactive i:before{';
						$add_css .= 'color:'.$eff_icon_color.';';	
						if($color_mode !='color'){
							$ef_gradient = array(
								'color1' => $eff_icon_color,
								'color2' => thz_akg('icon_shape/active/effect/icon_color2',$atts),
								'gradient' => $color_mode
							);
							$add_css .= _thz_gradient_text_css($ef_gradient, true);
						}
						$add_css .= '}';
							
					}
				}
				
				if($effect == 'pulsate'){
					$add_css .= '#'.$id_out.' .thz-icon-shape-pulsate .thz-icon-shape-effect';
					$add_css .= '{box-shadow:0 0 15px '.$eff_color.';}';
				}
				
				if($effect == 'spinme'){
					$add_css .= '#'.$id_out.' .thz-icon-shape-spinme.effectactive .thz-icon-shape-effect{background:'.$eff_background.';}';
					$add_css .= '#'.$id_out.' .thz-icon-shape-spinme.effectactive i:before{color:'.$eff_icon_color.';}';
					
					if($is_svg){
						
						$add_css .= thz_color_svg ('#'.$id_out.' .thz-icon-shape-spinme.effectactive svg *',$color_mode, $eff_icon_color);
						
					}else{
					
						$add_css .= '#'.$id_out.' .thz-icon-shape-spinme.effectactive i:before{';
						$add_css .= 'color:'.$eff_icon_color.';';
						if($color_mode !='color'){
							$ef_gradient = array(
								'color1' => $eff_icon_color,
								'color2' => thz_akg('icon_shape/active/effect/icon_color2',$atts),
								'gradient' => $color_mode
							);
							$add_css .= _thz_gradient_text_css($ef_gradient, true);
						}
						$add_css .= '}';
						
					}
				}
				
				if(in_array($effect,$fillups)){
					
					$add_css .= '#'.$id_out.' .thz-icon-shape-'.$effect.' .thz-icon-shape-effect{background:'.$eff_color.';}';
					
					if($is_svg){
						
						$add_css .= thz_color_svg ('#'.$id_out.' .thz-icon-shape-'.$effect.'.effectactive svg *',$color_mode, $eff_icon_color);
						
					}else{
						
						$add_css .= '#'.$id_out.' .thz-icon-shape-'.$effect.'.effectactive i:before{';
						$add_css .= 'color:'.$eff_icon_color.';';
						if($color_mode !='color'){
							$ef_gradient = array(
								'color1' => $eff_icon_color,
								'color2' => thz_akg('icon_shape/active/effect/icon_color2',$atts),
								'gradient' => $color_mode
							);
							$add_css .= _thz_gradient_text_css($ef_gradient, true);
						}
						$add_css .= '}';
					}
				}

			}

		}
		
		// text
		if(!empty($ict)){
			
			$text_poz 	=  thz_akg('ict/0/tmx/p',$atts);
			$text_space =  thz_akg('ict/0/tmx/s',$atts,15);
			$v_space 	=  thz_akg('ict/0/tmx/v',$atts,'');
			
			if(($text_poz =='left' || $text_poz =='both')){
				
				if($text_space != '' || $v_space != ''){
					$add_css .= '#'.$id_out.' .thz-icon-text-left{';
					if($text_space != ''){
						$add_css .= 'padding-right:'.thz_property_unit($text_space,'px').';';
					}
					if($v_space !=''){
						$add_css .= 'top:'.thz_property_unit($v_space,'px').';';
					}
					$add_css .= '}';
				}
			}
			
			if(($text_poz =='right' || $text_poz =='both')){
				if($text_space != '' || $v_space != ''){
					$add_css .= '#'.$id_out.' .thz-icon-text-right{';
					if($text_space != ''){
						$add_css .= 'padding-left:'.thz_property_unit($text_space,'px').';';
					}
					if($v_space !=''){
						$add_css .= 'top:'.thz_property_unit($v_space,'px').';';
					}	
					$add_css .= '}';
				}
			}
		}
				
		Thz_Doc::set( 'cssinhead', $add_css );
	}
	
	if( !thz_is_inline_css_cached() ){
		add_action('fw_ext_shortcodes_enqueue_static:icon','_thz_icon_css');
	}
}