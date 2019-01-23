<?php if (!defined('FW')) die('Forbidden');
/*
	custom css for icon-box

*/

if(!function_exists('_thz_icon_box_css')){

	function _thz_icon_box_css ($data) {
	
		$atts 					= _thz_shortcode_options($data,'icon_box');
		$instyle				= thz_akg('instyle',$atts);
		
		if( $instyle !=''){
			return;
		}
		
		$id						= thz_akg('id',$atts);
		$css_id 				= thz_akg('cmx/i',$atts);
		$fnot					= ':not(#♥)';
		$id_out					= !empty($css_id) ? str_replace(' ','',$css_id).$fnot: 'thz-icon-box-'.$id.$fnot;
		$add_css 				= '';
		$size					= thz_property_unit(thz_akg('icon_metrics/size',$atts),'px');
		$icon_color				= thz_akg('icon_metrics/color',$atts);
		$color_mode				= thz_akg('icon_metrics/mode',$atts,'color');
		$boxstyle				= thz_print_box_css(thz_akg('boxstyle',$atts));
		$icon_shape				= thz_akg('icon_shape/picked',$atts);
		$icon_position			= thz_akg('icon_metrics/position',$atts);
		$icon_bs 	 			= thz_print_box_css(thz_akg('icon_bs',$atts));
		$heading_color			= thz_akg('font_metrics/color',$atts);
		$hover_trigger			= thz_akg('hover_trigger',$atts);
		$boxhovered				= thz_print_box_css(thz_akg('boxhovered',$atts));
		$icon_hovered_color 	= thz_akg('hovered_c/i',$atts);
		$headings_hovered_color	= thz_akg('hovered_c/h',$atts);
		$text_hovered_color		= thz_akg('hovered_c/t',$atts);
		$links_hovered_color	= thz_akg('hovered_c/l',$atts);
		$font_metrics 			= thz_typo_css(thz_akg('font_metrics',$atts));
		$text_fm 				= thz_typo_css(thz_akg('tfm',$atts));
		$heading_padding 		= thz_print_box_css(thz_akg('heading_padding',$atts));
		$apply_link				= thz_akg('apply_link',$atts); 
		$iconimg				= thz_akg('iconimg',$atts);
		$is_svg					= false;
		
		$add_css .= '.thz-ib-'.$id_out.'.thz-icon-box .thz-icon-box-title{'.$font_metrics.'}';
		
	
		if(!empty($icon_bs)){
			$add_css 		.= '.thz-ib-'.$id_out.'.thz-icon-poz-'.$icon_position.' .thz-icon-holder{'.$icon_bs.'}';
		}
		
		if(!empty($heading_padding)){
			$heading_class 	= $icon_position == 'left' || $icon_position == 'right' ? ' .thz-icon-box-heading' : ' .thz-icon-box-heading-holder';
			$add_css 		.= '.thz-ib-'.$id_out.'.thz-icon-poz-'.$icon_position.$heading_class.'{'.$heading_padding.'}';
		}
		
		
		if(!empty($iconimg)){
			$img_type = pathinfo($iconimg['url'],PATHINFO_EXTENSION );
			if($img_type == 'svg' ){
				
				$is_svg	= true;
				
				if($size != ''){
					$add_css .= '.thz-ib-'.$id_out.'.thz-icon-box svg{';
					$add_css .='width:'.$size.';';
					$add_css .='}';
				}

				
			}
		}
	
		
		if(!empty($heading_color)){
			
			$add_css .= '.thz-ib-'.$id_out.'.thz-icon-box .thz-icon-box-title,';
			$add_css .= '.thz-ib-'.$id_out.'.thz-icon-box .thz-icon-box-title a';
			$add_css .= '{color:'.$heading_color.';}';
			
		}
		
		if(!empty($text_fm)){
			
			$add_css .= '.thz-ib-'.$id_out.'.thz-icon-box{'.$text_fm.'}';
		}
		
		if(!empty($icon_hovered_color)){

			if($is_svg){
				
				$add_css .= thz_color_svg ('.thz-ib-'.$id_out.'.thz-ib-hover .thz-icon-holder svg *',$color_mode, $icon_hovered_color);
				
			}else{
	
				if(empty($iconimg)){
					$add_css .= '.thz-ib-'.$id_out.'.thz-ib-hover .thz-icon-holder i{';
					$add_css .= 'color:'.esc_attr( $icon_hovered_color ).';';
					if($color_mode !='color'){
						$ih_gradient = array(
							'color1' => $icon_hovered_color,
							'color2' => thz_akg('hovered_c/i2',$atts),
							'gradient' => $color_mode
						);
						$add_css .= _thz_gradient_text_css($ih_gradient, true);
					}
					$add_css .= '}';
				}
				
			}
		}	
		
		if(!empty($headings_hovered_color)){
			
			$add_css .= '.thz-ib-'.$id_out.'.thz-icon-box .thz-icon-box-title:hover,';
			if($hover_trigger =='iconbox'){
				$add_css .= '.thz-ib-'.$id_out.'.thz-icon-box.thz-ib-hover .thz-icon-box-title,';
				$add_css .= '.thz-ib-'.$id_out.'.thz-icon-box.thz-ib-hover .thz-icon-box-title a,';
				$add_css .= '.thz-ib-'.$id_out.'.thz-icon-box.thz-ib-hover h1,';
				$add_css .= '.thz-ib-'.$id_out.'.thz-icon-box.thz-ib-hover h2,';
				$add_css .= '.thz-ib-'.$id_out.'.thz-icon-box.thz-ib-hover h3,';
				$add_css .= '.thz-ib-'.$id_out.'.thz-icon-box.thz-ib-hover h4,';
				$add_css .= '.thz-ib-'.$id_out.'.thz-icon-box.thz-ib-hover h5,';
				$add_css .= '.thz-ib-'.$id_out.'.thz-icon-box.thz-ib-hover h6,';
			}
			$add_css .= '.thz-ib-'.$id_out.'.thz-icon-box .thz-icon-box-title a:hover';

			$add_css .= '{color:'.$headings_hovered_color.';}';
			
		}
		
		if(!empty($text_hovered_color)){
			
			if($hover_trigger =='iconbox'){
				$add_css .= '.thz-ib-'.$id_out.'.thz-icon-box:hover .thz-icon-box-text,';
			}
			$add_css .= '.thz-ib-'.$id_out.' .thz-icon-box-text:hover';
			$add_css .= '{color:'.$text_hovered_color.';}';
		}
		
		if(!empty($links_hovered_color)){
			
			$add_css .= '.thz-ib-'.$id_out.'.thz-icon-box:hover a{color:'.$links_hovered_color.';}';
		}
		
		
		
		if($is_svg){
			
			$add_css .= thz_color_svg ('.thz-ib-'.$id_out.' .thz-icon-holder svg *',$color_mode, $icon_color);
			
		}else{
			
			if(empty($iconimg)){
				$add_css .= '.thz-ib-'.$id_out.' .thz-icon-holder i{';
				if($size != ''){
					$add_css .= 'font-size:'.$size.';';
				}
				if($icon_color !=''){
					$add_css .= 'color:'.$icon_color.';';
				}
				if($color_mode !='color'){
					$gradient = array(
						'color1' => $icon_color,
						'color2' => thz_akg('icon_metrics/color2',$atts),
						'gradient' => $color_mode
					);
					$add_css .= _thz_gradient_text_css($gradient, true);
				}
				$add_css .= '}';
			}
		
		}
		
		if(!empty($boxstyle)){
			$add_css .= '.thz-ib-'.$id_out.'.thz-icon-box.thz-shc{'.$boxstyle.'}';
		}
		
		
		if(!empty($boxhovered)){
			$add_css .= '.thz-ib-'.$id_out.'.thz-icon-box.thz-shc.thz-ib-hover{'.$boxhovered.'}';
		}
	   
		$icon_holder_size = (int)$size;
		
		
		// icon shape
		if($icon_shape == 'active'){
			
			$shape_type 		= thz_akg('icon_shape/active/type/picked',$atts); 
			$shape_size     	= thz_akg('icon_shape/active/sh_metrics/w',$atts);  
			$shape_bs			= thz_print_box_css(thz_akg('icon_shape/active/sh_bs',$atts));
			
			$shape_border_size 	= thz_akg('icon_shape/active/sh_metrics/bw',$atts);
			
			$shape_bg_type		= $shape_border_size > 0 ? 'solidborder' : 'solid';  
			$shape_color		= thz_akg('icon_shape/active/sh_metrics/bg',$atts);
			$shape_color_type	= thz_akg('icon_shape/active/sh_metrics/ct',$atts);
			$shape_color		= thz_akg('icon_shape/active/sh_metrics/bg',$atts);
			$shape_color2		= thz_akg('icon_shape/active/sh_metrics/bg2',$atts); 
			
			$shape_border_color = thz_akg('icon_shape/active/sh_metrics/bc',$atts);
			$shape_border_style = thz_akg('icon_shape/active/sh_metrics/bs',$atts);
			
			$shape_space_size	= thz_akg('icon_shape/active/sh_metrics/sp',$atts);
			$shape_space 		= $shape_space_size > 0 ? true : false;

			$shape_space_bg		= thz_akg('icon_shape/active/sh_metrics/sbg',$atts);
		
			$nudge				= thz_print_box_css(thz_akg('icon_shape/active/nudge',$atts));
			$effect				= thz_akg('icon_shape/active/effect/type',$atts);  
			
			
			
			$icon_holder_size 	= (int)$shape_size + ((int)$shape_border_size * 2);
	
			$add_css .= '.thz-ib-'.$id_out.' .thz-icon-shape,.thz-ib-'.$id_out.' .thz-icon-shape-in';
			$add_css .= '{height:'. thz_property_unit( $shape_size ,'px') .';width:'. thz_property_unit( $shape_size ,'px') .';}';
			$add_css .= '.thz-ib-'.$id_out.' .thz-icon-shape-in';
			$add_css .= '{line-height:'. thz_property_unit( $shape_size ,'px') .';}';

			if(!empty($shape_bs)){
				$add_css .= '.thz-ib-'.$id_out.' .thz-icon-shape{'.$shape_bs.'}';
			}
			
			if($shape_type == 'rounded'){
				$b = thz_property_unit(thz_akg('icon_shape/active/type/rounded/radius',$atts),'px');
				$add_css .= '.thz-ib-'.$id_out.' .thz-icon-st-rounded';
				$add_css .= '{border-radius:'.$b.';}';
			}
	
			if(!empty($shape_color)){

				if( !$shape_space && 'square' != $shape_type ){
					$add_css .= '.thz-ib-'.$id_out.' .thz-icon-shape,';
				}
									
				if(!empty($shape_color2) && 'color' != $shape_color_type){

					$add_css .= '.thz-ib-'.$id_out.' .thz-icon-shape-in{';
					$add_css .= _thz_gradient_background_css($shape_color,$shape_color2,$shape_color_type);
					$add_css .= '}';
					
				}else{
					
					$add_css .= '.thz-ib-'.$id_out.' .thz-icon-shape-in{';
					$add_css .= 'background:'. esc_attr( $shape_color ) .';';
					$add_css .= '}';				
				
				}
			}
	
			if(!empty($shape_border_color)){
				$add_css .='.thz-ib-'.$id_out.' .thz-icon-shape.thz-icon-bt-solidborder';
				$add_css .= '{border:'. thz_property_unit( $shape_border_size ,'px') .' '.$shape_border_style.' '. esc_attr( $shape_border_color ) .';}';
			}
	
			if( $shape_space ){
				$icon_holder_size = (int)$shape_size + ((int)$shape_border_size * 2) + ((int)$shape_space_size * 2);
				
				if(!empty($shape_space_bg)){
					$space_bg = 'background-color:'.$shape_space_bg.';';	
				}else{
					$space_bg = '';
				}
				$add_css .= '.thz-ib-'.$id_out.' .thz-icon-shape.thz-icon-bt-spaced{padding:'. thz_property_unit( $shape_space_size ,'px') .';'.$space_bg.'}';
			}
			
			if(!empty($nudge)){
				$add_css .= '.thz-ib-'.$id_out.' .thz-icon-shape i{'. $nudge  .'}';
			}
			
			if($effect != 'none'){
				
				$eff_color 		= thz_akg('icon_shape/active/effect/color',$atts);
				$eff_icon_color = thz_akg('icon_shape/active/effect/icon_color',$atts);
				$eff_background = thz_akg('icon_shape/active/effect/background',$atts);
				
				
				$fillups = array('fillup','filldown','fillleft','fillright'); 
				
				if($effect == 'halo'){
					$add_css .= '.thz-ib-'.$id_out.' .thz-icon-shape-halo.effectactive .thz-icon-shape-effect{border-color:'.$eff_color.';}';
					$add_css .= '.thz-ib-'.$id_out.' .thz-icon-shape-halo.effectactive .thz-icon-shape-in{background:'.$eff_background.';}';
					
					if($is_svg){
						
						$add_css .= thz_color_svg ('.thz-ib-'.$id_out.' .thz-icon-shape-halo.effectactive svg *',$color_mode, $eff_icon_color);
						
					}else{
					
						$add_css .= '.thz-ib-'.$id_out.' .thz-icon-shape-halo.effectactive i:before{';
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
					
					$add_css .= '.thz-ib-'.$id_out.' .thz-icon-shape-sonar .thz-icon-shape-effect';
					$add_css .= '{box-shadow: 0 0 0 2px rgba(255,255,255,0.1), 0 0 10px 10px '.$eff_color.', 0 0 0 10px rgba(255,255,255,0.5);}';
				}
				
				if($effect == 'justhover'){
					$add_css .= '.thz-ib-'.$id_out.' .thz-icon-shape-'.$effect.'.effectactive .thz-icon-shape-effect{background:'.$eff_color.';}';
					
					if($is_svg){
						
						$add_css .= thz_color_svg ('.thz-ib-'.$id_out.' .thz-icon-shape-'.$effect.'.effectactive svg *',$color_mode, $eff_icon_color);
						
					}else{
					
						$add_css .= '.thz-ib-'.$id_out.' .thz-icon-shape-'.$effect.'.effectactive i:before{';
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
					$add_css .= '.thz-ib-'.$id_out.' .thz-icon-shape-pulsate .thz-icon-shape-effect';
					$add_css .= '{box-shadow:0 0 15px '.$eff_color.';}';
				}
				
				if($effect == 'spinme'){
					$add_css .= '.thz-ib-'.$id_out.' .thz-icon-shape-spinme.effectactive .thz-icon-shape-effect{background:'.$eff_background.';}';
					
					if($is_svg){
						
						$add_css .= thz_color_svg ('.thz-ib-'.$id_out.' .thz-icon-shape-spinme.effectactive svg *',$color_mode, $eff_icon_color);
						
					}else{
					
						$add_css .= '.thz-ib-'.$id_out.' .thz-icon-shape-spinme.effectactive i:before{';
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
					$add_css .= '.thz-ib-'.$id_out.' .thz-icon-shape-'.$effect.' .thz-icon-shape-effect{background:'.$eff_color.';}';
					
					
					if($is_svg){
						
						$add_css .= thz_color_svg ('.thz-ib-'.$id_out.' .thz-icon-shape-'.$effect.'.effectactive svg *',$color_mode, $eff_icon_color);
						
					}else{
					
						$add_css .= '.thz-ib-'.$id_out.' .thz-icon-shape-'.$effect.'.effectactive i:before{';
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
		
		if($icon_position == 'centertop'){
			$add_css .= '.thz-ib-'.$id_out.'.thz-icon-poz-centertop .thz-icon-holder{height:'.$icon_holder_size.'px;width:'.$icon_holder_size.'px;top:-'.($icon_holder_size/2).'px;}';
		}
		
		
		if($apply_link != 'title'){
			
			$button_data = thz_akg('iconbox_button',$atts,array());
			$add_css .= thz_print_button_css($button_data,'.thz-ib-'.$id_out);
	
		}
		
		Thz_Doc::set( 'cssinhead', $add_css );
	}
	
	if( !thz_is_inline_css_cached() ){
		add_action('fw_ext_shortcodes_enqueue_static:icon_box','_thz_icon_box_css');
	}
}