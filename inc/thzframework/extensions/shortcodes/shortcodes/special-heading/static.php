<?php if (!defined('FW')) die('Forbidden');

/*
	custom css for special headings

*/
if(!function_exists('_thz_special_heading_css')){
	
	function _thz_special_heading_css($data) {
		
		$atts 			= _thz_shortcode_options($data,'special_heading');
		$instyle		= thz_akg('instyle',$atts);
		$parts			= thz_akg('hp',$atts);
		
		if( $instyle !=''){
			
			if(!empty($parts)){
				$add_css	= _thz_special_heading_parts_css( $parts );
				Thz_Doc::set( 'cssinhead', $add_css );
			}
			
			return;
		}
		
		$id				= thz_akg('id',$atts);
		$css_id 		= thz_akg('cmx/i',$atts);
		$fnot			= ':not(#♥)';
		$id_out			= !empty($css_id) ? str_replace(' ','',$css_id).$fnot: 'thz-sh-'.$id.$fnot;
		$style			= thz_akg('style',$atts);
		$heading_typo 	= thz_typo_css(thz_akg('ht',$atts));
		
		$max_width		= thz_akg('hem/max',$atts);
		$pos			= thz_akg('hem/pos',$atts);
		$bs				= thz_print_box_css(thz_akg('bs',$atts));
		$tbs			= thz_print_box_css(thz_akg('tbs',$atts));
		$add_css 		= '';

		if($bs !=''){
			$add_css .= '.'.$id_out.'.thz-heading.thz-shc{';
			$add_css .= $bs;
			$add_css .='}';
		}
		
		if($tbs !=''){
			$add_css .= '.'.$id_out.' .thz-heading-title{';
			$add_css .= $tbs;
			$add_css .='}';
		}

		$add_css .='.'.$id_out.' .thz-heading-holder{';
		$add_css .='max-width:'. thz_property_unit($max_width,'%').';';
		$add_css .='float:'.$pos.';';
		$add_css .='}';
		
		if($heading_typo != ''){
			$add_css .='.'.$id_out.' .thz-heading-title,';
			$add_css .='.'.$id_out.' .thz-heading-title *{';
			$add_css .= $heading_typo;
			$add_css .='}';	
		}
		
		// underline
		if($style =='underline'){
			
			// container
			$uc_width			= thz_akg('ulcm/width',$atts);
			$uc_height			= thz_akg('ulcm/height',$atts);
			$uc_br				= thz_akg('ulcm/br',$atts);
			$uc_distance		= thz_akg('ulcm/distance',$atts);
			$uc_bg				= thz_akg('ulcm/bg',$atts);
			
			$add_css .= '.'.$id_out.' .thz-sh-line{';
			$add_css .='max-width:'. thz_property_unit($uc_width,'px').';';
			$add_css .='background-color:'. ($uc_bg == '' ? 'transparent': $uc_bg) .';';
			$add_css .='height:'.thz_property_unit( $uc_height ,'px').';';
			$add_css .='margin-top:'. thz_property_unit( $uc_distance ,'px') .';';
			if($uc_br > 0){
				$add_css .='border-radius:'. thz_property_unit( $uc_br,'px') .';';
			}
			$add_css .= '}';
			
			// underline 
			$u_pos				= thz_akg('ulm/pos',$atts);
			$u_width			= thz_akg('ulm/width',$atts);
			$u_mode				= thz_akg('ulm/mode',$atts);	
			$u_color			= thz_akg('ulm/co',$atts);	
			$u_br				= thz_akg('ulm/br',$atts);		
			$add_css .= '.'.$id_out.' .thz-sh-line:after{';
			$add_css .='width:'. thz_property_unit( $u_width,'px') .';';
			
			if($u_mode =='color'){
			
				$add_css .='background-color:'. ($u_color == '' ? 'transparent': $u_color) .';';
			
			}else{
				$u_color2 = thz_akg('ulm/co2',$atts);	
				$add_css .=_thz_gradient_background_css($u_color,$u_color2,$u_mode);
			}
			
			$add_css .='float:'.$u_pos.';';
			if($u_br > 0){
				$add_css .='border-radius:'. thz_property_unit( $u_br,'px') .';';
			}
			$add_css .= '}';
			
		}	
		
		// sideline
		if($style =='sideline'){
			
			
			$slm_type			= thz_akg('slm/type',$atts);
			$slm_pos			= thz_akg('slm/pos',$atts);
			$slm_height			= thz_akg('slm/height',$atts);
			$slm_space			= thz_akg('slm/space',$atts);
			$slm_width			= thz_akg('slm/width',$atts);
			$slm_color			= thz_akg('slm/co',$atts);
			$slm_mode			= thz_akg('slm/mode',$atts);
			
			$heading_w = 100 - $slm_width * ($slm_pos !='both' ? 1 : 2);

			
			
			$add_css .= '.'.$id_out.'.thz-sh-sideline .thz-sh-ls,';
			$add_css .= '.'.$id_out.'.thz-sh-sideline .thz-sh-rs{';
			$add_css .='width:'.thz_property_unit($slm_width,'%').';';
			if($slm_type =='double'){
				$add_css .='height:'.thz_property_unit($slm_space + ($slm_height * 2),'px').';';
			}else{
				$add_css .='height:'.thz_property_unit($slm_height,'px').';';
			}
			$add_css .='}';
			
			if($slm_type =='double'){
				$add_css .= '.'.$id_out.'.thz-sh-sideline .thz-sh-ls:after,';
				$add_css .= '.'.$id_out.'.thz-sh-sideline .thz-sh-rs:after,';
			}
			$add_css .= '.'.$id_out.'.thz-sh-sideline .thz-sh-ls:before,';
			$add_css .= '.'.$id_out.'.thz-sh-sideline .thz-sh-rs:before{';
			$add_css .='height:'.thz_property_unit($slm_height,'px').';';
			if($slm_mode =='color'){
				
				$add_css .='background:'. $slm_color .';';
				
			}else{
				
				$slm_color2 = thz_akg('slm/co2',$atts);	
				$add_css .=_thz_gradient_background_css($slm_color,$slm_color2,$slm_mode);
				
			}
			$add_css .='}';
			
			$add_css .='.'.$id_out.' .thz-heading-title{';
			$add_css .='width:'. thz_property_unit($heading_w,'%').';';
			$add_css .='}';

		}
		
		// subtext
		$show_sub		= thz_akg('shsub/picked',$atts);
		$sub_text		= thz_akg('shsub/show/text',$atts);	
			
		if($show_sub =='show'){
			
			$sub_bs			= thz_print_box_css(thz_akg('shsub/show/bs',$atts));
			$sub_typo 		= thz_typo_css(thz_akg('shsub/show/st',$atts));
			
			if($sub_typo != ''){
				$add_css .='.'.$id_out.' .thz-sh-sub,';
				$add_css .='.'.$id_out.' .thz-sh-sub *{';
				$add_css .= $sub_typo;
				$add_css .='}';	
			}
			
			if(!empty($sub_bs)){		
				$add_css .='.'.$id_out.' .thz-sh-sub{';
				$add_css .= $sub_bs;	
				$add_css .='}';	
			}
		}
		
		// gradient
		$gr_css	= _thz_gradient_text_css(thz_akg('gr',$atts));
			
		if($gr_css){
			$add_css .='.'.$id_out.' .thz-gradient-text{';
			$add_css .= $gr_css;
			$add_css .='}';
		}
		
		// parts
		if(!empty($parts)){
			$add_css	.= _thz_special_heading_parts_css( $parts );
		}
		
		if($add_css !=''){
			Thz_Doc::set( 'cssinhead', $add_css );
		}
		
		
	}
	
	if( !thz_is_inline_css_cached() ){
		add_action('fw_ext_shortcodes_enqueue_static:special_heading','_thz_special_heading_css');
	}
}
