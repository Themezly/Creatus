<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

/**
 * @var $map_data_attr
 * @var $atts
 * @var $content
 * @var $tag
 */
$id 				= thz_akg('id',$atts);
$css_id 			= thz_akg('cmx/i',$atts);
$id_out				= !empty($css_id) ? str_replace(' ','',$css_id): 'thz-map-'.$id;
$css_class 			= thz_akg('cmx/c',$atts);
$css_class			= $css_class !='' ? $css_class.' ':'';
$res_class			= _thz_responsive_classes(thz_akg('cmx',$atts));

$map_style 			= thz_akg('style',$atts);
$map_zoom 			= thz_akg('map_zoom',$atts);
$map_pin 			= thz_akg('map_pin',$atts);
$map_background		= thz_akg('bs/background/color',$atts);
$zoomcontrol		= thz_akg('zoomcontrol',$atts);
$streetviewcontrol	= thz_akg('streetviewcontrol',$atts);
$pancontrol			= thz_akg('pancontrol',$atts);
$typecontrol		= thz_akg('typecontrol',$atts);
 
$animate			= thz_akg('animate',$atts);
$animation_data		= thz_print_animation($animate);
$animation_class	= thz_print_animation($animate,true);
$cpx				= thz_akg('cpx',$atts);
$cpx_data			= thz_print_cpx($cpx);
$cpx_class			= thz_print_cpx($cpx,true);
 
if(isset($map_pin['url'])){
 unset($map_pin['attachment_id']);
 $map_pin_json = json_encode($map_pin);
}else{
 $map_pin_json = '{"url":""}';
}

$map_data_attr['data-map-style'] 				= $map_style;
$map_data_attr['data-map-zoom'] 				= $map_zoom;
$map_data_attr['data-map-pin']	 				= $map_pin_json;
$map_data_attr['data-map-bg'] 					= $map_background;
$map_data_attr['data-map-zoomcontrol'] 			= $zoomcontrol;
$map_data_attr['data-map-streetviewcontrol'] 	= $streetviewcontrol;
$map_data_attr['data-map-pancontrol'] 			= $pancontrol;
$map_data_attr['data-map-typecontrol'] 			= $typecontrol;

$classes = $css_class.'thz-shc thz-map fw-map'.$animation_class.$cpx_class.$res_class;
?>
<div id="<?php echo esc_attr($id_out) ?>" class="<?php echo thz_sanitize_class($classes) ?>" <?php echo fw_attr_to_html($map_data_attr).thz_sanitize_data($animation_data.$cpx_data); ?>>
	<div class="fw-map-canvas"></div>
</div>