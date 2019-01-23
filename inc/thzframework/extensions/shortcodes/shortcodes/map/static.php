<?php if (!defined('FW')) die('Forbidden');

$ext = fw_ext('shortcodes');
/*wp_enqueue_style(
	'fw-shortcode-map',
	$ext->locate_URI( '/shortcodes/map/static/css/styles.css' )
);*/


$key = method_exists('FW_Option_Type_Map', 'api_key') ? FW_Option_Type_Map::api_key() :'';
wp_enqueue_script(
    'google-maps-api-v3',
    'https://maps.googleapis.com/maps/api/js?' . http_build_query(array(
        'v' => '3',
        'libraries' => 'places',
        'language' => substr( get_locale(), 0, 2 ),
        'key' => !empty($key)
            ? $key
            : 'AIzaSyBdS6jImGHwjmLVORfJfrj8Lw_dINNbo3s' // Use ours than
    )),
    array(),
    '3',
    true
);

wp_enqueue_script(
	'fw-shortcode-map-script',
	$ext->locate_URI( '/shortcodes/map/static/js/scripts.js'),
	array('jquery', 'underscore', 'google-maps-api-v3'),
	fw()->manifest->get_version(),
	true
);

/*
	custom css for map

*/
if(!function_exists('_thz_map_css')){
	
	function _thz_map_css ($data) {
	
		$atts 				= _thz_shortcode_options($data,'map');
		$id 				= thz_akg('id',$atts);
		$css_id 			= thz_akg('cmx/i',$atts);
		$id_out				= !empty($css_id) ? str_replace(' ','',$css_id): 'thz-map-'.$id;
		$map_height			= thz_akg('map_height',$atts);
		$map_background		= thz_akg('map_background',$atts);
		$title_font			= thz_typo_css( thz_akg('title_font',$atts) );
		$description_font	= thz_typo_css( thz_akg('description_font',$atts) );
		$box_style 			= thz_print_box_css(thz_akg('bs',$atts));
		
		$add_css = '';
		
		
		if($map_height !='' || $box_style !=''){
			$add_css .= '#'.$id_out	.'.fw-map.thz-shc{';
			if($map_height !=''){
				$add_css .= 'min-height:'.thz_property_unit($map_height,'px').';';
			}
			if( $box_style !=''){
				$add_css .= $box_style;
			}
			$add_css .= '}';
		}
		$add_css .= '#'.$id_out	.' .infowindow-title a{'.$title_font.'}';
		$add_css .= '#'.$id_out	.' .infowindow-description{'.$description_font.'}';
		
		

		
		
		
		if($add_css  !=''){
			Thz_Doc::set( 'cssinhead', $add_css );
		}
	}
	
	if( !thz_is_inline_css_cached() ){
		add_action('fw_ext_shortcodes_enqueue_static:map','_thz_map_css');
	}

}