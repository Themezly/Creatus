<?php if (!defined('FW')) die('Forbidden');
/*
	custom css for widget_area

*/
if(!function_exists('_thz_widget_area_css')){
	
	function _thz_widget_area_css ($data) {
	
		$atts 		= _thz_shortcode_options($data,'widget_area');
		$instyle	= thz_akg('instyle',$atts);
		
		if( $instyle !=''){

			return;
		}		
		
		$id			= thz_akg('id',$atts);
		$css_id 	= thz_akg('cmx/i',$atts);
		$fnot		= ':not(#♥)';
		$id_out		= !empty($css_id) ? str_replace(' ','',$css_id).$fnot: 'thz-shortcode-widget-area-'.$id.$fnot;
		$cs			= thz_akg('cs',$atts);
		$bs			= thz_print_box_css(thz_akg('bs',$atts));
		$add_css	= '';
		if($bs !=''){
			$add_css .= '.'.$id_out.'.thz-shortcode-widget-area.thz-shc{';
			$add_css .= $bs;
			$add_css .='}';
		}
		
		if(!empty($cs)){
			$add_css	.= _thz_sidebars_css(thz_akg('cs/0',$atts), '.'.$id_out.'.thz-sidebars');
		}

		if($add_css !=''){
			Thz_Doc::set( 'cssinhead', $add_css );
		}		
	}
	
	if( !thz_is_inline_css_cached() ){
		add_action('fw_ext_shortcodes_enqueue_static:widget_area','_thz_widget_area_css');
	}
}