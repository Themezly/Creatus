<?php if (!defined('FW')) die('Forbidden');

/*
	custom css for notifications

*/

if(!function_exists('_thz_notification_css')){
	
	function _thz_notification_css ($data) {
	
		$atts 					= _thz_shortcode_options($data,'notification');
		$nf_id  				= thz_akg('id',$atts);
		$notification_style 	= thz_akg('style/picked',$atts);
		$notification_box_style	= thz_print_box_css(thz_akg('style/custom/bs',$atts));
		$accent_color 			= thz_akg('style/custom/colors/a',$atts);
		$text_color 			= thz_akg('style/custom/colors/t',$atts);
		$link_color 			= thz_akg('style/custom/colors/l',$atts);
		$link_hover_color 		= thz_akg('style/custom/colors/lh',$atts);
		$bs						= thz_print_box_css(thz_akg('bs',$atts));
		$css_id 				= thz_akg('cmx/i',$atts);
		$id_out					= !empty($css_id) ? str_replace(' ','',$css_id): 'thz-notification-'.$nf_id;
		$add_css 				= '';
		
		if($bs !=''){
			$add_css .= '#'.$id_out.'.thz-notification-container.thz-shc{';
			$add_css .= $bs;
			$add_css .='}';
		}
		
		if($notification_style =='custom'){
			$add_css .= ".thz-nf-".$nf_id ." .thz-notification-title,";
			$add_css .= ".thz-nf-".$nf_id ." .thz-notification-icon,";
			$add_css .= ".thz-nf-".$nf_id ." .thz-notification-close";
			$add_css .= "{color:".$accent_color.";}";
			$add_css .= ".thz-nf-".$nf_id ." .thz-notification-text a";
			$add_css .= "{color:".$link_color.";}";
			$add_css .= ".thz-nf-".$nf_id ." .thz-notification-text a:hover";
			$add_css .= "{color:".$link_hover_color.";}";
			
			$add_css .= ".thz-nf-".$nf_id ."{". $notification_box_style ."color:".$text_color.";}";
		
		}
		
		if(!empty($add_css)){
			Thz_Doc::set( 'cssinhead', $add_css );
		}
	}
	
	if( !thz_is_inline_css_cached() ){
		add_action('fw_ext_shortcodes_enqueue_static:notification','_thz_notification_css');
	}

}