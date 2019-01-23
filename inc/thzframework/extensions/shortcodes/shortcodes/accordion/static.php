<?php if (!defined('FW')) die('Forbidden');
/*
	custom css for accordion

*/
if(!function_exists('_thz_accordion_css')){
	
	function _thz_accordion_css ($data) {
	
		$atts 					= _thz_shortcode_options($data,'accordion');
		$id						= thz_akg('id',$atts);
		$css_id 				= thz_akg('cmx/i',$atts);
		$id_out					= !empty($css_id) ? str_replace(' ','',$css_id): 'thz-accordion-'.$id; 
		$add_css 				= '';
		
		$bs						= thz_print_box_css(thz_akg('bs',$atts));
		$title_padding			= thz_akg('title_padding',$atts);
		$title_padding_print	= thz_print_box_css($title_padding);		
		$content_padding		= thz_akg('content_padding',$atts);
		$content_padding_print	= thz_print_box_css($content_padding);
		
		$title_borders			= thz_akg('gm/tb',$atts,'hideside');
		$content_borders		= thz_akg('gm/cb',$atts,'hide');
		$borderwidth			= thz_akg('gm/bw',$atts,1);
		$space					= thz_akg('gm/space',$atts,0);
		
		$active_bg				= thz_akg('ac/bg',$atts,'');
		$active_co				= thz_akg('ac/co',$atts,'');
		
		$inactive_bg			= thz_akg('ic/bg',$atts,'');
		$inactive_co			= thz_akg('ic/co',$atts,'');
		
		$content_bg				= thz_akg('gc/content',$atts,'');
		$borders_co				= thz_akg('gc/borders',$atts,'');
		$text					= thz_akg('gc/text',$atts,'');
		$link					= thz_akg('gc/link',$atts,'');
		$linkh					= thz_akg('gc/linkh',$atts,'');
		$headings				= thz_akg('gc/headings',$atts,'');
		$title_font 			= thz_akg('af',$atts, null);
		$accordions				= thz_akg('accordions',$atts);


		// page blocks CSS
		if(!empty($accordions)){
			foreach ($accordions as $acc) {
				$ctype  	= thz_akg('ctype',$acc,'editor');
				if('page_blocks' == $ctype){
					$page_blocks = thz_akg('page_blocks',$acc);
					thz_page_blocks_css( $page_blocks );
				}
			}
		}
			
		if($bs !=''){
			$add_css .= '#'.$id_out.'.thz-shortcode-accordion.thz-shc{';
			$add_css .= $bs;
			$add_css .='}';
		}

		$add_css .= '#'.$id_out.' .thz-accordion-group:not(:first-child){';
		$add_css .= 'margin-top:-'.thz_property_unit($borderwidth,'px').';';
		$add_css .= '}';
		
		if($space > 0){
			$add_css .= '#'.$id_out.' .thz-accordion-group + .thz-accordion-group{';
			$add_css .= 'margin-top:'.thz_property_unit($space + $borderwidth,'px').';';
			$add_css .= '}';
		}		

		
		$add_css .= '#'.$id_out.' .thz-accordion-title{';
		$add_css .= 'background-color:'.(empty($inactive_bg) ? 'transparent' : $inactive_bg).';';
		if($title_borders != 'hide'){
			$add_css .= 'border-color:'.(empty($borders_co) ? 'transparent' : $borders_co).';';
			$add_css .= 'border-width:'.thz_property_unit($borderwidth,'px').';';
		}
		$add_css .= thz_typo_css($title_font);
		$add_css .= '}';		
		
		$add_css .= '#'.$id_out.' .thz-accordion-title a{';
		$add_css .= $title_padding_print;
		if($active_co !=''){
			$add_css .= 'color:'.$inactive_co.';';
		}
		$add_css .= '}';
		
		
		$add_css .= '#'.$id_out.' .thz-accordion-content{';
		$add_css .= $content_padding_print;
		if($content_borders != 'hide'){
			$add_css .= 'border-color:'.(empty($borders_co) ? 'transparent' : $borders_co).';';
			$add_css .= 'border-width:'.thz_property_unit($borderwidth,'px').';';
		}
		if($content_bg !=''){
			$add_css .= 'background-color:'.$content_bg.';';
		}
		if($text !=''){
			$add_css .= 'color:'.$text.';';
		}
		$add_css .= '}';
		
		
		if($link !=''){
			$add_css .= '#'.$id_out.' .thz-accordion-content a{';
			$add_css .= 'color:'.$link.';';
			$add_css .= '}';
		}
		
		if($linkh !=''){
			$add_css .= '#'.$id_out.' .thz-accordion-content a:hover{';
			$add_css .= 'color:'.$linkh.';';
			$add_css .= '}';
		}
		
		if($headings !=''){
			$add_css .= '#'.$id_out.' .thz-accordion-content h1,';
			$add_css .= '#'.$id_out.' .thz-accordion-content h2,';
			$add_css .= '#'.$id_out.' .thz-accordion-content h3,';
			$add_css .= '#'.$id_out.' .thz-accordion-content h4,';
			$add_css .= '#'.$id_out.' .thz-accordion-content h5,';
			$add_css .= '#'.$id_out.' .thz-accordion-content h6{';
			$add_css .= 'color:'.$headings.';';
			$add_css .= '}';
		}
		

		$add_css .= '#'.$id_out.' .thz-accordion-title.hovered,';
		$add_css .= '#'.$id_out.' .thz-accordion-title.active{';
		$add_css .= 'background-color:'.(empty($active_bg) ? 'transparent' : $active_bg).';';
		$add_css .= '}';
		
		if($active_co !=''){
			$add_css .= '#'.$id_out.' .thz-accordion-title.hovered a,';
			$add_css .= '#'.$id_out.' .thz-accordion-title.active a{';
			$add_css .= 'color:'.$active_co.';';
			$add_css .= '}';
		}
		

		if(!empty($add_css)){
			Thz_Doc::set( 'cssinhead', $add_css );
		}
	}
	if( !thz_is_inline_css_cached() ){
		add_action('fw_ext_shortcodes_enqueue_static:accordion','_thz_accordion_css');
	}
}