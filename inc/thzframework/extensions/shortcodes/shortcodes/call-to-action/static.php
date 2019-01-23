<?php if (!defined('FW')) die('Forbidden');

/*
	custom css for cta

*/

if(!function_exists('_thz_call_to_action_css')){
	
	function _thz_call_to_action_css ($data) {
	
		$atts 				= _thz_shortcode_options($data,'call_to_action');
		$id 				= thz_akg('id',$atts);
		$css_id 			= thz_akg('cmx/i',$atts);
		$id_out				= !(empty($css_id )) ? $css_id : 'thz-cta-'.$id;
		$hbs				= thz_print_box_css(thz_akg('hbs',$atts)); 
		$cbs				= thz_print_box_css(thz_akg('cbs',$atts)); 
		$button1_css 		= thz_akg('show_button1/show/cta_button1/css',$atts);
		$button2_css 		= thz_akg('show_button2/show/cta_button2/css',$atts);
		$show_button1 		= thz_akg('show_button1/picked',$atts);
		$show_button2 		= thz_akg('show_button2/picked',$atts);		
		$heading 			= thz_akg('heading',$atts);
		$subheading 		= thz_akg('subheading',$atts);
		$text 				= thz_akg('text',$atts);
		$icon 				= thz_akg('icon',$atts);
		
		
		$heading_color		= thz_akg('heading_color',$atts);
		$subheading_color	= thz_akg('subheading_color',$atts);
		$text_color			= thz_akg('text_color',$atts);
		$icon_color			= thz_akg('icon_color',$atts);
		
		$heading_padding	= thz_print_box_css(thz_akg('heading_padding',$atts));
		$subheading_padding	= thz_print_box_css(thz_akg('subheading_padding',$atts));
		$text_padding		= thz_print_box_css(thz_akg('text_padding',$atts));
		$buttons_padding	= thz_print_box_css(thz_akg('buttons_padding',$atts));
		$icon_padding		= thz_print_box_css(thz_akg('icon_padding',$atts));	
		$icon_shape			= thz_akg('icon_shape/picked',$atts);
		$cta_heading_font	= thz_akg('cta_heading_font/picked',$atts);
		$cta_subheading_font= thz_akg('cta_subheading_font/picked',$atts);
		$cta_text_font		= thz_akg('cta_text_font/picked',$atts);
		
		$add_css			='';
		
		
		if($cbs !=''){
			$add_css .= '#'.$id_out.' .thz-cta-box{';
			$add_css .= $cbs;
			$add_css .= '}';
		}		
		if($hbs !=''){
			$add_css .= '#'.$id_out.'.thz-cta-box-holder.thz-shc{';
			$add_css .= $hbs;
			$add_css .= '}';
		}
		
		
		if($heading !=''){
			$add_css .= '#'.$id_out.' .thz-cta-heading-holder{';
			$add_css .=$heading_padding;
			$add_css .='}';
			if($heading_color !='' || $cta_heading_font =='custom'){
				$add_css .= '#'.$id_out.' .thz-cta-heading{';
				
				if($heading_color !=''){
					$add_css .='color:'.$heading_color.';';
				}
				
				if($cta_heading_font =='custom'){
					$heading_font = thz_akg('cta_heading_font/custom/heading_font',$atts);
					$add_css .= thz_typo_css($heading_font);
				}
				$add_css .='}';
			}
		}		
		
		if($subheading !=''){
			$add_css .= '#'.$id_out.' .thz-cta-subheading{';
			if($subheading_color !=''){
				$add_css .='color:'.$subheading_color.';';
			}
			$add_css .=$subheading_padding;
			if($cta_subheading_font =='custom'){
				$subheading_font = thz_akg('cta_subheading_font/custom/subheading_font',$atts);
				$add_css .= thz_typo_css($subheading_font);
			}
			$add_css .='}';
		}
		
		if($text !=''){
			$add_css .= '#'.$id_out.' .thz-cta-text{';
			if($text_color !=''){
				$add_css .='color:'.$text_color.';';
			}
			$add_css .=$text_padding;
			$add_css .='}';
		}
		
		if($icon !=''){
			$add_css .= '#'.$id_out.' .thz-cta-icon{';
			if($icon_color !=''){
				$add_css .='color:'.$icon_color.';';
			}
			$add_css .=$icon_padding;
			$add_css .='}';
		}
		
		
		if($show_button1 == 'show' || $show_button2 == 'show'){
			$add_css .= '#'.$id_out.' .thz-cta-button{';
			$add_css .=$buttons_padding;
			$add_css .='}';			
			
		}
		
		if($icon_shape =='active'){
			$icon_shape_bg_type			= thz_akg('icon_shape/active/bg_type/picked',$atts);
			$icon_shape_color			= thz_akg('icon_shape/active/bg_type/'.$icon_shape_bg_type.'/color',$atts);

			$add_css .= '#'.$id_out.' .thz-cta-icon-in{';
			$add_css .='background:'.$icon_shape_color.';';
			if($icon_shape_bg_type == 'solidborder'){
				$border_size		= thz_akg('icon_shape/active/bg_type/solidborder/border_size',$atts);
				$border_color	= thz_akg('icon_shape/active/bg_type/solidborder/border_color',$atts);
				$border_style 	= thz_akg('icon_shape/active/bg_type/solidborder/border_style',$atts);
				$add_css .='border:'.$border_size.'px '.$border_style.' '.$border_color.';';
			}
			$add_css .='}';				
		}
		
		
		if($cta_text_font =='custom'){
			$text_font = thz_akg('cta_text_font/custom/text_font',$atts);
			$add_css .= '#'.$id_out.' .thz-cta-text{';
			$add_css .= thz_typo_css($text_font);
			$add_css .= '}';
		}
		
		$button1_data = thz_akg('show_button1/show/cta_button1',$atts,array());
		$add_css .= thz_print_button_css($button1_data,'#'.$id_out);
		
		$button2_data = thz_akg('show_button2/show/cta_button2',$atts,array());
		$add_css .= thz_print_button_css($button2_data,'#'.$id_out);	

			
		if($add_css !=''){
			Thz_Doc::set( 'cssinhead', $add_css );
		}
	}
	if( !thz_is_inline_css_cached() ){
		add_action('fw_ext_shortcodes_enqueue_static:call_to_action','_thz_call_to_action_css');
	}

}