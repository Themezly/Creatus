<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}
$id 					= thz_akg('id',$atts);
$css_id 				= thz_akg('cmx/i',$atts);
$id_out					= !empty($css_id) ? str_replace(' ','',$css_id): 'thz-notification-'.$id;
$css_class 				= thz_akg('cmx/c',$atts);
$css_class				= $css_class !='' ? $css_class.' ':'';
$res_class				= _thz_responsive_classes(thz_akg('cmx',$atts));
$title 					= thz_akg('mx/title',$atts);
$notification 			= do_shortcode( thz_akg('notification',$atts) );
$notification_style 	= thz_akg('style/picked',$atts);
$tag					= thz_akg('mx/tag',$atts);
$nfp					= $notification_style =='predefined' ? true : false;
$notification_color 	= $nfp ? thz_akg('style/predefined/mx/c',$atts) :'custom';
$nfbs					= thz_akg('style/predefined/mx/b',$atts);
$border_style 			= $nfp && $nfbs !='default' ? ' '.$nfbs : '';
$nfbr					= thz_akg('style/predefined/mx/br',$atts);
$border_radius 			= $nfp && $nfbr !=0 ? ' thz-radius-'.esc_attr($nfbr) : '';
$close_button 			= thz_akg('close_button',$atts);
$icon 					= thz_akg('imx/icon',$atts);
$icon_size 				= thz_akg('imx/size',$atts) !='default' ? ' '.thz_akg('imx/size',$atts) : '';
$icon_align 			= thz_akg('imx/align',$atts) !='thz-va-top' ? ' '.thz_akg('imx/align',$atts) : '';
$align					= thz_akg('mx/align',$atts);
$animate				= thz_akg('animate',$atts);
$animation_data			= thz_print_animation($animate);
$animation_class		= thz_print_animation($animate,true);
$cpx					= thz_akg('cpx',$atts);
$cpx_data				= thz_print_cpx($cpx);
$cpx_class				= thz_print_cpx($cpx,true);
$classes				= $css_class.'thz-shc thz-notification-container'.$animation_class.$cpx_class.$res_class;
$nf_class				= 'thz-nf-'.$id.' thz-notification thz-notification-'.$notification_color.$border_style.$border_radius.' '.$align;
$icon_class				= $icon_align.' '.$icon.$icon_size;
?>
<div id="<?php echo esc_attr( $id_out ) ?>" class="<?php echo thz_sanitize_class($classes); ?>"<?php echo thz_sanitize_data($animation_data.$cpx_data)?>>
    <div class="<?php echo thz_sanitize_class($nf_class); ?>">
        <?php if($close_button =='show'){ ?>
        <span class="thz-notification-close" data-parent="thz-notification-<?php echo esc_attr($id) ?>"></span>
        <?php } ?>
        <div class="thz-notification-inner <?php echo thz_sanitize_class($align); ?>">
            <div class="thz-notification-box<?php if(!empty($icon)){echo ' thz-iconlineup';} ?>">
                <?php if(!empty($icon) && $align !='thz-align-right'){ ?>
                <span class="thz-notification-icon<?php echo thz_sanitize_class($icon_class); ?>"></span>
                <?php } ?>
                <div class="thz-notification-content">
                    <?php if(!empty($title)){ ?>
                    <<?php echo esc_attr($tag) ?> class="thz-notification-title"><?php echo esc_attr($title) ?></<?php echo esc_attr($tag) ?>>
                    <?php } ?>
                    <?php if(!empty($notification)){ ?>
                    <div class="thz-notification-text">
                    <?php echo thz_html_trans(esc_textarea( do_shortcode($notification))); ?>
                    </div>
                    <?php } ?>
                </div>
                <?php if(!empty($icon) && $align =='thz-align-right'){ ?>
                <span class="thz-notification-icon<?php echo thz_sanitize_class($icon_class); ?>"></span>
                <?php } ?>
            </div>
        </div>
    </div>
</div>