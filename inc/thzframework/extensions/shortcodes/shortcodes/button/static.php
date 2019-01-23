<?php if (!defined('FW')) die('Forbidden');
/*
	custom css for button

*/

if(!function_exists('_thz_button_css')){
	
	function _thz_button_css ($data) {
	
		$atts 				= _thz_shortcode_options($data,'button');
		$button_css 		= thz_akg('shortcode_button/css',$atts);
		$button_gfonts	 	= thz_akg('shortcode_button/gfonts',$atts);
		
		if(isset($button_gfonts) && !empty($button_gfonts)){
			
			foreach($button_gfonts as $add_g_font){
				
				Thz_Doc::set( 'googleclassname', $add_g_font );
				
			}
			
		}
		if($button_css != ''){
			
			$button_json 	= json_decode( thz_akg('shortcode_button/json',$atts) ,true);
			$custom_class 	= $button_json['customClass'];
			
			Thz_Doc::set( 'cssinhead', $button_css, false, $custom_class );
		}
	}
	if( !thz_is_inline_css_cached() ){
		add_action('fw_ext_shortcodes_enqueue_static:button','_thz_button_css');
	}
}