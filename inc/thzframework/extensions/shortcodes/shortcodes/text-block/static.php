<?php if (!defined('FW')) die('Forbidden');

/*
	custom css for text block

*/

if(!function_exists('_thz_text_block_css')){
	
	function _thz_text_block_css ($data) {
	
		$atts 		= _thz_shortcode_options($data,'text_block');
		$id 		= thz_akg('id',$atts);
		$css_id 	= thz_akg('cmx/i',$atts);
		$id_out		= !empty($css_id) ? str_replace(' ','',$css_id): 'thz-text-block-'.$id;
		$bs			= thz_print_box_css(thz_akg('bs',$atts));
		$h			= thz_typo_css(thz_akg('h',$atts));
		$t			= thz_typo_css(thz_akg('t',$atts));
		$l			= thz_typo_css(thz_akg('l',$atts));
		$lh			= thz_akg('l/hovered',$atts);
		$add_css 	= '';
		
		
		if($bs !='' || $t !=''){
			$add_css .= '#'.$id_out.'.thz-text-block.thz-shc{';
			$add_css .= $bs;
			if($t !=''){
				$add_css .= $t;
			}
			$add_css .='}';
		}
		
		if($h !=''){
			$add_css .='#'.$id_out.' h1{'.$h.'}';
			$add_css .='#'.$id_out.' h2{'.$h.'}';
			$add_css .='#'.$id_out.' h3{'.$h.'}';
			$add_css .='#'.$id_out.' h4{'.$h.'}';
			$add_css .='#'.$id_out.' h5{'.$h.'}';
			$add_css .='#'.$id_out.' h6{'.$h.'}';
		}
		
		if($l !=''){
			$add_css .= '#'.$id_out.'.thz-text-block.thz-shc a{';
			$add_css .= $l;
			$add_css .='}';			
		}
		
		if($lh !=''){
			$add_css .= thz_hover_css('#'.$id_out.'.thz-text-block.thz-shc a',$lh);			
		}
				
		if(!empty($add_css)){
			Thz_Doc::set( 'cssinhead', $add_css );
		}		
	}
	
	if( !thz_is_inline_css_cached() ){
		add_action('fw_ext_shortcodes_enqueue_static:text_block','_thz_text_block_css');
	}
}