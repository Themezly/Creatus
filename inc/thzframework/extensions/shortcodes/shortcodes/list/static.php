<?php if (!defined('FW')) die('Forbidden');

/*
	custom css for list

*/
if(!function_exists('_thz_list_css')){
	
	function _thz_list_css ($data) {
	
		$atts 			= _thz_shortcode_options($data,'list');
		$instyle		= thz_akg('instyle',$atts);
		
		if( $instyle !=''){
			return;
		}
		
		$id				= thz_akg('id',$atts);
		$css_id 		= thz_akg('cmx/i',$atts);
		$fnot			= ':not(#♥)';
		$id_out			= !empty($css_id) ? str_replace(' ','',$css_id).$fnot: 'thz-shortcode-list-'.$id.$fnot;
		$items			= thz_akg('items',$atts);
		$type			= thz_akg('type/picked',$atts,'default');
		$ulbs_print		= thz_print_box_css(thz_akg('ulbs',$atts));
		$bs_print		= thz_print_box_css(thz_akg('bs',$atts));
		$subs_print		= thz_print_box_css(thz_akg('subs',$atts));
		$link_l 	    = thz_akg('mx/l',$atts,null);	
		$link_h 	    = thz_akg('mx/h',$atts,null);
		$p_reset		= thz_akg('mx/pr',$atts,'donotreset');	
		$m_reset		= thz_akg('mx/mr',$atts,'donotreset');	
		$b_reset		= thz_akg('mx/bo',$atts,'donotreset');		
		$add_css		='';
		$font 			= thz_typo_css(thz_akg('if',$atts));		
		
		if(!empty($ulbs_print)){
			$add_css .= '.'.$id_out.'.thz-'.$type.'-list.thz-shc{';
			$add_css .= $ulbs_print;
			$add_css .= '}';
		}

		if(!empty($subs_print)){
			$add_css .= '.'.$id_out.' .sub-list{';
			$add_css .= $subs_print;
			$add_css .= '}';
		}
		if(!empty($bs_print) || !empty($font)){
			$add_css .= '.'.$id_out.' li{';
			if(!empty($bs_print)){
				$add_css .= $bs_print;
			}
			if(!empty($font)){
				$add_css .=  $font;
			}
			$add_css .= '}';
		}
		
		if($link_l !=''){
			$add_css .= '.'.$id_out.' li a{';
			$add_css .= 'color:'.esc_attr($link_l).';';
			$add_css .= '}';
			
		}
		
		
		if($link_h !=''){
			$add_css .= '.'.$id_out.' li a:hover{';
			$add_css .= 'color:'.esc_attr($link_h).';';
			$add_css .= '}';
			
		}
		
		if($type =='icons'){
			
			$icon 			= thz_akg('type/icons/icon',$atts);
			$icon_color 	= thz_akg('type/icons/icon/color',$atts);
			$icon_size		= thz_akg('type/icons/icon/size',$atts);
			$icon_vnudge	= thz_akg('type/icons/icon/v-nudge',$atts);
			$icon_hnudge	= thz_akg('type/icons/icon/h-nudge',$atts);
			$icon_space		= thz_akg('type/icons/icon/space',$atts);
			$icon_position	= thz_akg('type/icons/ip',$atts);
			$margin_side	= $icon_position == 'left' ? 'right' :'left';
			
			if($icon && ( $icon_color !='' || $icon_size !='' || $icon_vnudge !='' || $icon_hnudge !=''|| $icon_space !='')){
				
				$add_css .= '.'.$id_out.' li i{';
				if($icon_color !=''){
					$add_css .= 'color:'.esc_attr($icon_color).';';
				}
				if($icon_size !=''){
					$add_css .= 'font-size:'.thz_property_unit($icon_size,'px').';';
				}
				if($icon_vnudge !=''){
					$add_css .= 'top:'.thz_property_unit($icon_vnudge,'px').';';
				}
				if($icon_hnudge !=''){
					$add_css .= 'left:'.thz_property_unit($icon_hnudge,'px').';';
				}
				if($icon_space !=''){
					$add_css .= 'margin-'.$margin_side.':'.thz_property_unit($icon_space,'px').';';
				}
				$add_css .= '}';
			}
		}
		
		if($p_reset !='donotreset'){
			
			$reset_p = explode('_',$p_reset);
			
			$p_item  = $reset_p[0];
			$p_side  = $reset_p[1];
			
			$add_css .= '.'.$id_out.' li:'.$p_item.'-child{';
			$add_css .= 'padding-'.$p_side.':0px;';
			$add_css .= '}';			
			
		}
		
		
		if($m_reset !='donotreset'){
			
			$reset_m = explode('_',$m_reset);
			
			$m_item  = $reset_m[0];
			$m_side  = $reset_m[1];
			
			$add_css .= '.'.$id_out.' li:'.$m_item.'-child{';
			$add_css .= 'margin-'.$m_side.':0px;';
			$add_css .= '}';			
			
		}
		
		
		if($b_reset !='donotreset'){
			
			$reset_b = explode('_',$b_reset);
			
			$b_item  = $reset_b[0];
			$b_side  = $reset_b[1];
			
			$add_css .= '.'.$id_out.' li:'.$b_item.'-child{';
			$add_css .= 'border-'.$b_side.'-color:transparent;';
			$add_css .= '}';			
			
		}
		
		
		$add_css .= thz_build_list($items,$id_out,false,false,false,false,true);
		
		if($add_css !=''){
			Thz_Doc::set( 'cssinhead', $add_css );
		}
		
	}
	
	if( !thz_is_inline_css_cached() ){
		add_action('fw_ext_shortcodes_enqueue_static:list','_thz_list_css');
	}
}