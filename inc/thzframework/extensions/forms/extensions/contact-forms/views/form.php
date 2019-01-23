<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}
/**
 * @var string $form_id
 * @var string $form_html
 * @var array $extra_data
 */
$atts				= $extra_data;
$id					= $form_id;
$css_id 			= thz_akg('cmx/i',$atts);
$id_out				= !empty($css_id) ? str_replace(' ','',$css_id): 'thz-contact-form-'.$id; 
$css_class 			= thz_akg('cmx/c',$atts);
$css_class			= $css_class !='' ? $css_class.' ':'';
$res_class			= _thz_responsive_classes(thz_akg('cmx',$atts));
$fhide				= thz_akg('fhide',$atts,'donothide');
$animate			= thz_akg('animate',$atts);
$animation_data		= thz_print_animation($animate);
$animation_class	= thz_print_animation($animate,true);
$cpx				= thz_akg('cpx',$atts);
$cpx_data			= thz_print_cpx($cpx);
$cpx_class			= thz_print_cpx($cpx,true);
$hideform			= $fhide == 'hide' ? ' thz-hide-form' :'';
$classes			= $css_class.'thz-shc thz-shortcode-form form-wrapper contact-form'.$hideform.$animation_class.$cpx_class.$res_class;

?>
<div id="<?php echo esc_attr($id_out) ?>" class="<?php echo thz_sanitize_class($classes); ?>"<?php echo thz_sanitize_data($animation_data.$cpx_data); ?>>
	<div class="thz-shortcode-form-msg-container"><div class="thz-shortcode-form-msg"></div></div>
	<?php echo str_replace('<div class="thz-row"></div>','',$form_html); ?>
    <div class="thz-items-loading"></div>
</div>