<?php if (!defined('FW')) die('Forbidden');
/*
	custom css for code snippet

*/
if(!function_exists('_thz_code_snippet_css')){
	
	function _thz_code_snippet_css ($data) {
	
		$atts 			= _thz_shortcode_options($data,'code_snippet');
		$id				= thz_akg('id',$atts);
		$css_id 		= thz_akg('cmx/i',$atts);
		$id_out			= !empty($css_id) ? str_replace(' ','',$css_id): 'thz-code-snippet-'.$id;
		$add_css 		= '';
		$bs				= thz_print_box_css(thz_akg('bs',$atts));

		if($bs !=''){
			$add_css .= '#'.$id_out.'.thz-code-snippet.thz-shc{';
			$add_css .= $bs;
			$add_css .='}';
		}

		if(!empty($add_css)){
			Thz_Doc::set( 'cssinhead', $add_css );
		}
	}
	
	if( !thz_is_inline_css_cached() ){
		add_action('fw_ext_shortcodes_enqueue_static:code_snippet','_thz_code_snippet_css');
	}
}