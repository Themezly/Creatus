<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}
/**
 * @var array $atts ;
 * @var string $content ;
 * @var string $tag ;
 */
$id 				= thz_akg('id',$atts);
$css_id 			= thz_akg('cmx/i',$atts);
$id_out				= !empty($css_id) ? str_replace(' ','',$css_id): 'thz-shortcode-widget-area-'.$id;
$css_class 			= thz_akg('cmx/c',$atts);
$css_class			= $css_class !='' ? $css_class.' ':'';
$instyle			= thz_akg('instyle',$atts);
$instyle			= $instyle !='' ? $instyle.' ':'';
$res_class			= _thz_responsive_classes(thz_akg('cmx',$atts));
$animate			= thz_akg('animate',$atts);
$animation_data		= thz_print_animation($animate);
$animation_class	= thz_print_animation($animate,true);
$cpx				= thz_akg('cpx',$atts);
$cpx_data			= thz_print_cpx($cpx);
$cpx_class			= thz_print_cpx($cpx,true);

$class 				= $instyle.$css_class.'thz-shc '.$id_out.' thz-shortcode-widget-area thz-sidebars'.$animation_class.$cpx_class.$res_class;
?>
<div id="<?php echo esc_attr( $id_out ) ?>" class="<?php echo thz_sanitize_class( $class ) ?>"<?php echo thz_sanitize_data($animation_data.$cpx_data); ?>><?php dynamic_sidebar( $atts['sidebar'] ); ?></div>