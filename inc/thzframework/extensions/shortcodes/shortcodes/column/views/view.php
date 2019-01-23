<?php if (!defined('FW')) die('Forbidden');


$id 				= thz_akg('id',$atts);
$css_id 			= thz_akg('cmx/i',$atts);
$id_out				= !empty($css_id) ? str_replace(' ','',$css_id): 'thz-column-c'.$id;
$css_class 			= thz_akg('cmx/c',$atts);
$css_class			= $css_class !='' ? $css_class.' ':'';
$res_class			= _thz_responsive_classes(thz_akg('cmx',$atts));
$column_video		= thz_akg('bs/background',$atts);
$animate			= thz_akg('an',$atts);
$animation_data		= thz_print_animation($animate);
$animation_class	= thz_print_animation($animate,true);
$cpx				= thz_akg('cpx',$atts);
$cpx_data			= thz_print_cpx($cpx);
$cpx_class			= thz_print_cpx($cpx,true);
$background_layers	= thz_akg('bl',$atts); 
$scrollfade_o		= thz_akg('sf',$atts);
$scrollfade_at		= (int) esc_attr( thz_akg('sf/0/fadeat',$atts));
$scrollfade_class	= !empty($scrollfade_o) ? ' thz-scroll-fade' : '';
$whattofade_o		= thz_akg('sf/0/whattofade',$atts); 
$whattofade			= $whattofade_o == 'content' ? ' data-whattofade=".thz-column-shortcodes"' : '';
$scrollfade_data	= !empty($scrollfade_o) ? ' data-fadestart="'.$scrollfade_at.'"'.$whattofade.'' : '';
$fullheight			= thz_akg('fh',$atts);
$contentalign		= thz_akg('fh/0/contentalign',$atts);
$smootha 			= thz_akg('smootha/m',$atts);
$centered 			= thz_akg('centered',$atts);
$anchordata			= '';
$flexalign			= ' '.thz_akg('flexalign',$atts,'fstart');
$op_classes			= $centered == 'center' ? ' thz-col-centered' :'';

if($smootha != 'inactive' && $css_id){
	$stop 			= (int) thz_akg('smootha/p',$atts);
	$duration		= (int) thz_akg('smootha/d',$atts);		
	$op_classes 	.= ' thz-element-anchor';
	$anchordata		= ' data-anchor-'.esc_attr( $smootha ).'="'.esc_attr( $stop ).'" data-anchor-duration="'.esc_attr( $duration ).'"';
}

$sticky		= thz_akg('st',$atts);
$sticky_r	= !empty($sticky) ? thz_akg('st/0/r',$atts) : array();
$stickme 	= !empty($sticky) ? ' thz-sticky-column'._thz_responsive_classes ( $sticky_r ):'';
$in_sticky	= !empty($sticky) ? true : false;
$stickme_d	= !empty($sticky) ? ' data-sticky-offset="'.thz_akg('st/0/s/o',$atts,0).'"  data-sticky-bottoming="'.thz_akg('st/0/s/b',$atts,'no').'"':'';

$con_d 		= $animation_data.$anchordata.$stickme_d.$cpx_data;
$col_d 		= $scrollfade_data;
$w_class 	= fw_ext_builder_get_item_width('page-builder', $atts['width'] . '/frontend_class');
$class 		= $css_class.$w_class.$animation_class.$flexalign.$op_classes.$stickme.$cpx_class.$res_class;
$con_class	= $centered == 'center' ? str_replace('thz-column','',$w_class) :''; 

?>
<div id="<?php echo esc_attr( $id_out ) ?>" class="<?php echo thz_sanitize_class ( $class ); ?>"<?php echo thz_sanitize_data($con_d) ?>>
	<div class="thz-column-container<?php echo thz_sanitize_class ( $con_class ) ?>">
        <div class="thz-column-in<?php echo thz_sanitize_class ( $scrollfade_class ) ?>"<?php echo thz_sanitize_data($col_d) ?>>
            <?php if(!empty($fullheight)) { ?>
            <div class="thz-full-height">
                <div class="thz-full-height-in <?php echo thz_sanitize_class ( $contentalign ) ?>">
            <?php } ?>
            <div class="thz-column-shortcodes">	
                <?php echo do_shortcode($content); ?>
            </div>
            <?php if(!empty($fullheight)) { ?>
                </div>
            </div>
            <?php } ?>
            <?php echo thz_video_bg($column_video,false) ?>
            <?php echo thz_background_layers_print($background_layers,$in_sticky); ?>
        </div>
    </div>
</div>