<?php if (!defined('FW')) die('Forbidden');
/*
	custom css for image

*/

if(!function_exists('_thz_media_image_css')){
	
	function _thz_media_image_css ($data) {
	
		$atts 					= _thz_shortcode_options($data,'media_image');
		$id 					= thz_akg('id',$atts);
		$css_id 				= thz_akg('cmx/i',$atts);
		$id_out					= !empty($css_id) ? str_replace(' ','',$css_id): 'thz-media-image-'.$id;
		$med_over_bg 			= thz_akg('med_over/background',$atts,array());
		$over_mode				= thz_akg('over_mode',$atts,'thzhover');
		$distance				= thz_akg('distance',$atts,0);
		$show_caption 			= thz_akg('caption/picked',$atts,'hide');
		$add_css				= '';
		$con_box_style			= thz_print_box_css(thz_akg('con_bs',$atts,null));
		$media_box_style		= thz_print_box_css(thz_akg('media_bs',$atts,null));
		
		if(!empty($con_box_style)){
			$add_css .='#'.$id_out.'.thz-media-image-container.thz-shc{';
			$add_css .= $con_box_style;
			$add_css .='}';
		}	
		
		if(!empty($media_box_style)){
			$add_css .= '#'.$id_out.' .thz-media-item-image{';
			$add_css .= $media_box_style;
			$add_css .='}';
		}
		
		if($over_mode !='none'){
			if($over_mode =='thzhover'){
	
				$add_css .='#'.$id_out.' .thz-hover-mask{';
				$add_css .= _thz_media_overlay_background_css_print($med_over_bg).';';
				
				if($distance > 0){
					$add_css .='margin:'.thz_property_unit($distance,'px').';';
				}
				
				$add_css .='}';
				
				
			}else{
				
				$add_css .='#'.$id_out.' .thz-overlay-box{';
				$add_css .= _thz_media_overlay_background_css_print($med_over_bg).';';
				
				if($distance > 0){
					$add_css .='top:'.thz_property_unit($distance,'px').';';
					$add_css .='right:'.thz_property_unit($distance,'px').';';
					$add_css .='bottom:'.thz_property_unit($distance,'px').';';
					$add_css .='left:'.thz_property_unit($distance,'px').';';				
				}
				
				$add_css .='}';
				
				$add_css .='#'.$id_out.' .thz-hover-mask{';
				$add_css .='background:none;';
				$add_css .='}';				
			}
			
			$show_media_icon	= thz_akg('mi/picked',$atts,'show'); 
			
			if($show_media_icon =='show'){
				
				$icon_co 	= thz_akg('mi/show/icon_metrics/co',$atts);
				$icon_bg 	= thz_akg('mi/show/iconbg_metrics/bg',$atts);
				$icon_bs 	= thz_akg('mi/show/iconbg_metrics/bs',$atts);
				$icon_bsi 	= thz_akg('mi/show/iconbg_metrics/bsi',$atts);
				$icon_bc 	= thz_akg('mi/show/iconbg_metrics/bc',$atts);
				$icon_fs 	= thz_akg('mi/show/icon_metrics/fs',$atts,16);
				
				if($icon_co !='' || $icon_bg !='' || ($icon_bsi > 0 && $icon_bc !='')){
					
					$add_css .='#'.$id_out.' .thz-hover-icon,';
					$add_css .='#'.$id_out.' .thz-hover-icon:focus{';
					if($icon_co !=''){
						$add_css .='color:'.esc_attr($icon_co).';';
					}
					if($icon_bg !=''){
						$add_css .='background:'.esc_attr($icon_bg).';';
					}
					if($icon_bsi > 0 && $icon_bc !=''){
						$add_css .='border:'.esc_attr($icon_bsi).'px '.esc_attr($icon_bs).' '.esc_attr($icon_bc).';';
					}
					$add_css .='}';	
					
					$add_css .='#'.$id_out.' .thz-hover-icon span{';
					$add_css .='width:'.thz_property_unit($icon_fs,'px').';';
					$add_css .='height:'.thz_property_unit($icon_fs,'px').';';	
					$add_css .='}';					
					
				}
	
				
			}
		}	

		$height_picked	= thz_akg('height/picked',$atts,'thz-ratio-16-9');
		
		if($height_picked =='custom'){
			
			$bs_height 	= thz_akg('media_bs/boxsize/height',$atts,null);
			$height 	= $bs_height ? $bs_height : thz_akg('height/custom/height',$atts,350);
			$add_css .='#'.$id_out.' .thz-media-item-image,';
			$add_css .='#'.$id_out.' .thz-media-custom-size';
			$add_css .='{height:'.thz_property_unit ($height,'px').';}';
			
		}
		
		
		// caption
		if( $show_caption == 'show'){
			
			$caption_box_style 	= thz_print_box_css(thz_akg('caption/show/bs',$atts,null));
			$caption_font		= thz_akg('caption/show/f',$atts,null);

			if( !empty($caption_box_style)  || !empty($caption_font) ){
				$add_css .= '#'.$id_out.' .thz-media-image-caption{';
				if( !empty($caption_box_style) ){
					$add_css .= $caption_box_style;
				}
				if(!empty($caption_font)){
					$add_css .= thz_typo_css($caption_font);
				}
				$add_css .='}';	
			}
		}

		if($add_css !=''){
			Thz_Doc::set( 'cssinhead', $add_css );
		}
		
	}
	
	if( !thz_is_inline_css_cached() ){
		add_action('fw_ext_shortcodes_enqueue_static:media_image','_thz_media_image_css');
	}
}