<?php if (!defined('FW')) die('Forbidden');

/*
	custom css for divider

*/

if(!function_exists('_thz_media_gallery_css')){
	
	function _thz_media_gallery_css ($data) {
	
		$atts 			= _thz_shortcode_options($data,'media_gallery');
		$id 			= thz_akg('id',$atts);
		$css_id 		= thz_akg('cmx/i',$atts);
		$id_out			= !empty($css_id) ? str_replace(' ','',$css_id): 'thz-media-gallery-'.$id;
		$media_layout	= thz_akg('media_layout',$atts,'grid');
		$med_over_bg    = thz_akg('med_over/background',$atts,array());
		$over_mode		= thz_akg('over_mode',$atts,'thzhover');
		$distance		= thz_akg('distance',$atts,0);
		$columns		= thz_akg('grid/columns',$atts,null);
		$gutter			= thz_akg('grid/gutter',$atts,null);
		$add_css		= '';
		$columns_width 	= 33.33;
		if($columns){
			$columns_width 	= $columns == 0 ? 100 :  (100) / $columns ;
		}


		// holder
		$holder_box_style 		= thz_akg('holder_bs',$atts,null);
		$holder_box_style_print	= thz_print_box_css($holder_box_style);
		if(!empty($holder_box_style_print)){
			$add_css .= '#'.$id_out.'.thz-media-holder.thz-shc{'.$holder_box_style_print.'}';
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
		
		
		if($media_layout == 'slider'){
			
			$columns = 1;
			$columns_width 	= 100;
			$gutter 	= 0;
			
			/* multiple slides preload calc */
			$slider_show   		= thz_akg('slider/show',$atts,null);
			$slider_space  		= thz_akg('slider/space',$atts,null);
			$slider_vertical  	= thz_akg('san/vertical',$atts,null);
			
			if( $slider_show > 1 ){
				
				$add_css .= thz_slick_multiple_css('#'.$id_out, $slider_show, $slider_space, $slider_vertical,'.thz-slide-media-gallery-item');
	
			}

			// navigations
			$nav_ar	  = thz_akg('nav',$atts,null);
			$arr_ar	  = thz_akg('arr',$atts,null);
			$add_css .= _thz_slider_navigations_css($nav_ar,$arr_ar,'#'.$id_out.' > .thz-slick-slider');
			
			
		}

		if($media_layout == 'grid'){
		
			$add_css .='#'.$id_out.' .thz-items-grid{';
			$add_css .='margin-left:-'.($columns > 1 ? $gutter : 0).'px;';
			$add_css .='}';
		
			$add_css .='#'.$id_out.' .thz-grid-item{';
			$add_css .='padding-left:'.($columns > 1 ? $gutter : 0).'px;';
			$add_css .='}';	
		
			$add_css .='#'.$id_out.' .thz-grid-item-in{';
			$add_css .='margin-bottom:'.$gutter.'px;';
			$add_css .='}';
			$add_css .='#'.$id_out.' .thz-items-gutter-adjust{';
			$add_css .='margin-bottom:-'.$gutter.'px;';
			$add_css .='}';	

			$add_css .='#'.$id_out.' .thz-grid-item,#'.$id_out.' .thz-items-sizer {width:'.$columns_width.'%;}';
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
		
		$media_height_picked	= thz_akg('media_height/picked',$atts,'thz-ratio-16-9');

		if($media_height_picked =='custom'){
			$media_height = thz_akg('media_height/custom/height',$atts,350);
			$add_css .='#'.$id_out.' .thz-media-item-media,';
			$add_css .='#'.$id_out.' .thz-media-custom-size';
			$add_css .='{height:'.thz_property_unit ($media_height,'px').';}';
			
		}

		// title
		$show_title 			= thz_akg('show_title/picked',$atts,null);
		
		if($show_title =='show'){
			
			$title_bs		= thz_akg('show_title/show/title_bs',$atts,null); 
			$title_bs_print	= thz_print_box_css($title_bs);
			$title_font		= thz_akg('show_title/show/title_f',$atts,null);
			
			$add_css .='#'.$id_out.' .thz-media-item-title{';
			$add_css .= $title_bs_print;
			if(!empty($title_font)){
				$add_css .= thz_typo_css($title_font);
			}
			$add_css .='}';	
			


		}
		
		// filter
		$show_filter 			= thz_akg('filter/picked',$atts,null);
		if($show_filter == 'show'){
			$filter_atts = thz_akg('filter/show',$atts,null);
			$add_css .= _thz_posts_filter_css_print($filter_atts,'#thz-posts-filter-'.$id);
		}	
		
		
		if($add_css !=''){
			Thz_Doc::set( 'cssinhead', $add_css );
		}
		
	}
	
	if( !thz_is_inline_css_cached() ){
		add_action('fw_ext_shortcodes_enqueue_static:media_gallery','_thz_media_gallery_css');
	}
}