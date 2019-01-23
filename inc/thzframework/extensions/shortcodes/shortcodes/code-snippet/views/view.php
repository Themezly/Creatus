<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}
$id					= thz_akg('id',$atts);
$css_id 			= thz_akg('cmx/i',$atts);
$id_out				= !empty($css_id) ? str_replace(' ','',$css_id): 'thz-code-snippet-'.$id;
$css_class 			= thz_akg('cmx/c',$atts);
$css_class			= $css_class !='' ? $css_class.' ':'';
$res_class			= _thz_responsive_classes(thz_akg('cmx',$atts));
$code				= thz_akg('code',$atts,null);
$style				= thz_akg('style',$atts,'light');
$height				= thz_akg('height',$atts,'limit');
$animate			= thz_akg('animate',$atts);
$animation_data		= thz_print_animation($animate);
$animation_class	= thz_print_animation($animate,true);
$cpx				= thz_akg('cpx',$atts);
$cpx_data			= thz_print_cpx($cpx);
$cpx_class			= thz_print_cpx($cpx,true);
$scrollable			= $height =='limit' ?'pre-scrollable ':'';
$highlight			= thz_akg('highlight/picked',$atts,'inactive');
$linenums			= thz_akg('highlight/active/linenums',$atts,'hide');
$linenums			= ( $highlight == 'active' && $linenums == 'show' ) ? 'linenums ':'';
$highlight			= $highlight == 'active' ? 'prettyprint ':'';
$class				= $scrollable.$highlight.$linenums.$style;
$holder_classes 	= $css_class.'thz-shc thz-code-snippet'.$animation_class.$cpx_class.$res_class;
?>
<div id="<?php echo esc_attr($id_out)?>" class="<?php echo thz_sanitize_class($holder_classes)?>"<?php echo thz_sanitize_data($animation_data.$cpx_data); ?>>
    <pre class="<?php echo thz_sanitize_class($class)?>"><?php echo htmlentities($code, ENT_QUOTES, 'UTF-8'); ?></pre>
</div>