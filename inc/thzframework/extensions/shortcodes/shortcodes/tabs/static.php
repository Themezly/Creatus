<?php if (!defined('FW')) die('Forbidden');

/*
	custom css for tabs

*/

if(!function_exists('_thz_tabs_css')){
	
	function _thz_tabs_css ($data) {
	
		$atts 	 				= _thz_shortcode_options($data,'tabs');
		$id 					= thz_akg('id',$atts);
		$css_id 				= thz_akg('cmx/i',$atts);
		$id_out					= !empty($css_id) ? str_replace(' ','',$css_id): 'thz-tabs-'.$id;
		$tabs					= thz_akg('tabs',$atts);
		$l_space				= thz_akg('tabl/lsp',$atts);
		$l_bradius				= thz_akg('tabl/lbr',$atts);
		$tabs_layout			= thz_akg('tabl/lay',$atts);
		$tabs_mainc				= 'thz-tabs-'.$id;
		$tabcm					= thz_print_box_css(thz_akg('tabcm',$atts));
		$tablink_padding		= thz_print_box_css(thz_akg('tablp',$atts));
		$tabcontent_bs			= thz_print_box_css(thz_akg('tabcbs',$atts));
		$tabcontent_inner_bs	= thz_print_box_css(thz_akg('tabcibs',$atts));
		$title_font 			= thz_akg('tabf',$atts, null);
		
		$add_css 				= '';
		
		// container bs
		if($tabcm !=''){
			$add_css .= '#'.$id_out.'.thz-shortcode-tabs.thz-shc{';
			$add_css .= $tabcm;
			$add_css .='}';	
		}
		
		// space
		if($l_space > 0 && ($tabs_layout =='top' || $tabs_layout =='centered') ){
			$add_css .= '.'.$tabs_mainc .' ul.thz-tabs-menu li{';
			$add_css .='margin-right:'.thz_property_unit($l_space,'px').';';
			$add_css .='}';
		}
		
		// link
		$add_css .=  '.'.$tabs_mainc .' ul.thz-tabs-menu li a{';
		$add_css .= $tablink_padding;
		if($l_bradius > 0  && ($tabs_layout !='left' && $tabs_layout !='right')){
			$add_css .='border-radius:'.thz_property_unit($l_bradius,'px').';';
		}
		$add_css .= thz_typo_css($title_font);
		$add_css .='}';
		
		// active 
		$active_link					= thz_akg('tablc/al',$atts);
		$active_linkh					= thz_akg('tablc/alh',$atts);
		$active_style 					= thz_print_box_css(thz_akg('tababs',$atts));
				
		$add_css .= '.'.$tabs_mainc .' ul.thz-tabs-menu li.thz-active-tab a{';
		$add_css .= $active_style;
		if($active_link !=''){
			$add_css .='color:'.$active_link.';';
		}
		$add_css .='}';
		
		if($active_linkh !=''){
			$add_css .= '.'.$tabs_mainc .' ul.thz-tabs-menu li.thz-active-tab a:hover{';
			$add_css .='color:'.$active_linkh.';';
			$add_css .='}';
		}
		
		// inactive
		$inactive_link					= thz_akg('tablc/il',$atts);
		$inactive_linkh					= thz_akg('tablc/ilh',$atts);
		$inactive_style 				= thz_print_box_css(thz_akg('tabibs',$atts));
				
		$add_css .= '.'.$tabs_mainc .' ul.thz-tabs-menu li.thz-inactive-tab a{';
		$add_css .= $inactive_style;
		if($inactive_link !=''){
			$add_css .='color:'.$inactive_link.';';
		}
		$add_css .='}';
		
		
		if($inactive_linkh !=''){
			$add_css .= '.'.$tabs_mainc .' ul.thz-tabs-menu li.thz-inactive-tab a:hover{';
			$add_css .='color:'.$inactive_linkh.';';
			$add_css .='}';
		}
		
		// content 
		
		
		if($tabs_layout == 'left'){
			
			$btype			= thz_akg('tabcbs/borders/all',$atts); 
			$bside			= $btype == 'same' ? 'top' : 'left';
			$adjust_margin  = thz_akg('tabcbs/borders/'.$bside.'/w',$atts);
			$margin 		= 'margin-right:-'.thz_property_unit($adjust_margin,'px').';';
			$tabs_class 	= '.thz-tabs-left.'.$tabs_mainc .' ul.thz-tabs-menu{';
						
		}elseif($tabs_layout == 'right'){
			
			$btype			= thz_akg('tabcbs/borders/all',$atts); 
			$bside			= $btype == 'same' ? 'top' : 'right';
			$adjust_margin  = thz_akg('tabcbs/borders/'.$bside.'/w',$atts);			
			$margin 		= 'margin-left:-'.thz_property_unit($adjust_margin,'px').';';
			$tabs_class 	= '.thz-tabs-right.'.$tabs_mainc .' ul.thz-tabs-menu{';
			
		}else{
			
			$adjust_margin 	= thz_akg('tabcbs/borders/top/w',$atts);
			$margin 		= 'margin-bottom:-'.thz_property_unit($adjust_margin,'px').';';
			$tabs_class 	= '.thz-tabs-above.'.$tabs_mainc .' ul.thz-tabs-menu li{';
		}
		
		if($adjust_margin > 0){
			$add_css .= $tabs_class;
			$add_css .= $margin;
			$add_css .='}';			
		}
		
		$content_txt				= thz_akg('tabcc/ctc',$atts);
		$content_link				= thz_akg('tabcc/clc',$atts);
		$content_linkh				= thz_akg('tabcc/clh',$atts);
		$content_heading			= thz_akg('tabcc/chc',$atts);
		
		$add_css .= '.thz-shortcode-tabs.'.$tabs_mainc .' .thz-tab-content{';
		$add_css .= $tabcontent_bs;
		if($content_txt !=''){
			$add_css .='color:'.$content_txt.';';
		}
		$add_css .='}';
		
		if($tabcontent_inner_bs !=''){
			
			$add_css .= '.thz-shortcode-tabs.'.$tabs_mainc .' .thz-tab-content-inner{';
			$add_css .= $tabcontent_inner_bs;
			$add_css .='}';
		}
		
		if($content_link !=''){
			$add_css .= '.'.$tabs_mainc .' .thz-tab-content a{';
			$add_css .='color:'.$content_link.';';
			$add_css .='}';
		}	
		if($content_linkh !=''){
			$add_css .= '.'.$tabs_mainc .' .thz-tab-content a:hover{';
			$add_css .='color:'.$content_linkh.';';
			$add_css .='}';
		}	
		if($content_heading !=''){
			$add_css .= '.'.$tabs_mainc .' .thz-tab-content h1,';
			$add_css .= '.'.$tabs_mainc .' .thz-tab-content h2,';
			$add_css .= '.'.$tabs_mainc .' .thz-tab-content h3,';
			$add_css .= '.'.$tabs_mainc .' .thz-tab-content h4,';
			$add_css .= '.'.$tabs_mainc .' .thz-tab-content h5,';
			$add_css .= '.'.$tabs_mainc .' .thz-tab-content h6{';
			$add_css .='color:'.$content_heading.';';
			$add_css .='}';
		}
		
		//  icon 
		if(!empty($tabs)){
			foreach ($tabs as $key => $tab){
				
				// page blocks CSS
				$ctype  	= thz_akg('ctype',$tab,'editor');
				if('page_blocks' == $ctype){
					$page_blocks = thz_akg('page_blocks',$tab);
					thz_page_blocks_css( $page_blocks );
				}
				
				$icon 			= thz_akg('imx/i',$tab);
				
				if(empty($icon)){
					continue;
				}
				
				$icon_size		= thz_akg('imx/s',$tab);
				$icon_vnudge	= thz_akg('imx/v',$tab);
				$icon_hnudge	= thz_akg('imx/h',$tab);
				$icon_space		= thz_akg('imx/m',$tab);
				$icon_position	= thz_akg('imx/p',$tab);
				$margin_side	= 'right';
				
				if($icon_position == 'right'){
					$margin_side	= 'left';
				}else if($icon_position == 'above'){
					$margin_side	= 'bottom';
				}
								
				if($icon && ( $icon_size !='' || $icon_vnudge !='' || $icon_hnudge !=''|| $icon_space !='')){
					
					$add_css .= '.tab-li-'.$id.'-'.$key.' a span{';
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
		}
		
		
		if(!empty($add_css)){
			Thz_Doc::set( 'cssinhead', $add_css );
		}
	}
	
	if( !thz_is_inline_css_cached() ){
		add_action('fw_ext_shortcodes_enqueue_static:tabs','_thz_tabs_css');
	}
}
