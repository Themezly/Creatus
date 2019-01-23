<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}
/**
 * @var $wrapper_atts
 * @var $atts
 * @var $content
 * @var $tag
 */
 
$id 				= thz_akg('id',$atts);
$css_id 			= thz_akg('cmx/i',$atts);
$id_out				= !empty($css_id) ? str_replace(' ','',$css_id): 'thz-calendar-'.$id;
$css_class 			= thz_akg('cmx/c',$atts);
$css_class			= $css_class !='' ? $css_class.' ':'';
$res_class			= _thz_responsive_classes(thz_akg('cmx',$atts));
$type 				= thz_akg('type/picked',$atts); 
$predefined			= strpos($type, 'custom') !== false? 'custom':'predefined';
$style_type			= ' thz-calendar-style-'.$predefined;
$animate			= thz_akg('animate',$atts);
$animation_data		= thz_print_animation($animate);
$animation_class	= thz_print_animation($animate,true);
$cpx				= thz_akg('cpx',$atts);
$cpx_data			= thz_print_cpx($cpx);
$cpx_class			= thz_print_cpx($cpx,true);

$wrapper_atts['data-template'] = str_replace('custom','',$type);
$wrapper_atts['data-template-path'] = thz_theme_file_uri ( '/inc/thzframework/extensions/shortcodes/shortcodes/calendar/views/');
$wrapper_atts['class'] =  $css_class.fw_akg('class', $wrapper_atts, '') . ' thz-shc thz-calendar-wrapper thz-calendar-'.$type.$animation_class.$style_type.$cpx_class.$res_class;
?>
<div id="<?php echo esc_attr($id_out) ?>" <?php echo fw_attr_to_html($wrapper_atts).thz_sanitize_data($animation_data.$cpx_data); ?>>
	<div class="thz-clear"></div>
    <div class="thz-calendar-header hide-calendar-section">
        <button data-calendar-nav="prev"><i class="fa fa-angle-left"></i></button>
        <h3 class="thz-calendar-title"><!-- Title will be set here --></h3>
        <button data-calendar-nav="next"><i class="fa fa-angle-right"></i></button>
    </div>
	<div class="thz-calendar-holder">
		<div class="thz-calendar hide-calendar-section"></div>
	</div>
</div>