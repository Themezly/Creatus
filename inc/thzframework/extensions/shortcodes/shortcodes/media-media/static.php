<?php if (!defined('FW')) die('Forbidden');

if(!function_exists('_thz_media_media_css')){
	
	function _thz_media_media_css ($data) {
	
		$atts 			= _thz_shortcode_options($data,'media_gallery');
		$id 			= thz_akg('id',$atts);
		$css_id 		= thz_akg('cmx/i',$atts);
		$id_out			= !empty($css_id) ? str_replace(' ','',$css_id): 'thz-media-item-'.$id;
		$med_over_bg    = thz_akg('med_over/background',$atts,array());
		$over_mode		= thz_akg('over_mode',$atts,'thzhover');
		$distance		= thz_akg('distance',$atts,0);
		$columns		= thz_akg('grid/columns',$atts,null);
		$gutter			= thz_akg('grid/gutter',$atts,null);
		$add_css		= '';

		// holder
		$holder_box_style 		= thz_akg('holder_bs',$atts,null);
		$holder_box_style_print	= thz_print_box_css($holder_box_style);
		if(!empty($holder_box_style_print)){
			$add_css .= '#'.$id_out.'.thz-media-item-container.thz-shc{'.$holder_box_style_print.'}';
		}

		// media
		$media_box_style 		= thz_akg('media_bs',$atts,null);
		$media_box_style_print	= thz_print_box_css($media_box_style);
		if(!empty($media_box_style_print)){
			$add_css .= '#'.$id_out.' .thz-media-item-media{'.$media_box_style_print.'}';
		}		

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


		$media_height_picked	= thz_akg('media_height/picked',$atts,'thz-ratio-16-9');
		
		if($media_height_picked =='custom'){
			$media_height = thz_akg('media_height/custom/height',$atts,350);
			$add_css .='#'.$id_out.' .thz-media-item-media,';
			$add_css .='#'.$id_out.' .thz-media-custom-size';
			$add_css .='{height:'.thz_property_unit ($media_height,'px').';}';
		}

		$icon_co 	= thz_akg('icon_mx/c',$atts);
		$icon_fs 	= thz_akg('icon_mx/s',$atts,18);
		
		$add_css .='#'.$id_out.' .thz-hover-icon,';
		$add_css .='#'.$id_out.' .thz-hover-icon:focus{';
		$add_css .='color:'.esc_attr($icon_co).';';
		$add_css .='}';	
		
		$add_css .='#'.$id_out.' .thz-hover-icon span{';
		$add_css .='font-size:'.thz_property_unit($icon_fs,'px').';';	
		$add_css .='width:'.thz_property_unit($icon_fs,'px').';';
		$add_css .='height:'.thz_property_unit($icon_fs,'px').';';
		$add_css .='}';					

		
		if($add_css !=''){
			Thz_Doc::set( 'cssinhead', $add_css );
		}
		
	}
	
	if( !thz_is_inline_css_cached() ){
		add_action('fw_ext_shortcodes_enqueue_static:media_media','_thz_media_media_css');
	}
}