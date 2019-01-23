<?php
/**
 * @package      Thz Framework
 * @author       Themezly
 * @websites     http://www.themezly.com | http://www.youjoomla.com | http://www.yjsimplegrid.com
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // No direct access
}
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.5.1
 */

global $post, $woocommerce, $product;

$attachment_ids 	= thz_woo_get_product_images( $product );

array_unshift($attachment_ids,get_post_thumbnail_id());

$slider_layout 	 	= thz_get_option('wooimgsl',null);
$slider_animation 	= thz_get_option('wooimgsa',null);
$media_height		= thz_get_option('wooimgh/picked','thz-ratio-16-9'); 
$slick_data 		= thz_slick_data($slider_layout,$slider_animation);
$mfp_classes		= ' thz-lightbox-gallery-simple '.thz_get_theme_option('lightbox_slider','thz-mfp-show-slider');

$obgtype	 		= thz_ov_ef('.thz-product-media','background/type');
$oeffect 			= thz_ov_ef('.thz-product-media','oeffect'); 
$oduration			= thz_ov_ef('.thz-product-media','oduration'); 
$ieffect			= thz_ov_ef('.thz-product-media','ieffect'); 
$iduration			= thz_ov_ef('.thz-product-media','iduration');

$show_media_icon	= thz_get_option('wooimgmi/picked');  
if($show_media_icon =='show'){
	$iceffect			= thz_ov_ef('.thz-product-media','iceffect');
	$icduration			= thz_ov_ef('.thz-product-media','icduration');
	
	$icon_shape			= thz_get_option('wooimgmi/show/ibgm/sh','square');
	$icon_pa			= thz_get_option('wooimgmi/show/icm/pa',10);
	$icon_fs			= thz_get_option('wooimgmi/show/icm/fs',16);
	$overlay_icon		= thz_get_option('wooimgmi/show/icon','thzicon thzicon-plus');
	$icon_classes		= $icon_shape.' thz-fs-'.$icon_fs.' thz-vp-'.$icon_pa.' thz-hp-'.$icon_pa;
	$iconef_classes 	= $iceffect.' '.$icduration;
}
$slidesToShow		= thz_get_option('wooimgsl/show',1);
$hover_classes 		= 'thz-hover thz-hover-bg-'.$obgtype.' '.$oeffect.' '.$oduration.' '.$ieffect.'';


if($media_height == 'custom'){
	
	$img_ratio		= ' thz-media-custom-size';
	$img_mask		= ' thz-hover-img-mask';
	
}else if ($media_height == 'auto'){
	
	$img_ratio		= ' thz-media-height-auto';
	$img_mask		= '';
	
}else{
	$img_ratio		= ' thz-aspect '.$media_height;
	$img_mask		= ' thz-hover-img-mask';
}
$is_active 		= count($attachment_ids) > 1 ? 'thz-slick-active' :'thz-slick-inactive';
$multiple  		= $slidesToShow > 1 ? ' thz-slick-show-multiple' :'';
$img_holder  	= 'thz-woo-item-img-slick thz-slick-holder '.$mfp_classes.$multiple; 
$img_slider		= 'thz-slick-slider '.$is_active.' thz-woo-slick-images thz-slick-initiating';
$wooimgcol		= thz_get_option('wooimgcol/w','thz-col-1-2');
$image_size		= thz_get_option('wooimgsl/img','thz-img-large');
$thumb_size		= thz_get_option('wooimgsl/thumb','thz-img-small');
$thumb_show		= thz_get_option('wooimgsl/showt',4);
$thumb_space 	= thz_get_option('wooimgsl/spacet',20);
?>

<div class="thz-column <?php echo thz_sanitize_class( $wooimgcol ) ?>">
	<div class="thz-product-media images">
		<?php wc_get_template_part( 'single-product/sale', 'flash' ); ?>
        <div class="<?php echo thz_sanitize_class($img_holder) ?>">
            <div class=" <?php echo thz_sanitize_class($img_slider); ?>"<?php echo $slick_data?> data-navfor=".thz-slick-woo-thumbs">
                <?php foreach ($attachment_ids as $attachment_id ): 
                    $image_title 	= esc_attr( get_the_title( $attachment_id ) );
                    $image   		= thz_get_img_src( $attachment_id, $image_size );
                    $style 			='';
                    if ($media_height !='auto' ) { 
                        $style = ' style="background-image:url('.esc_url ( $image ).');"';
                    }
                ?><div class="thz-slick-slide" data-type="image">
                    <div class="thz-slick-slide-in<?php echo $img_ratio ?>">
                        <div class="thz-ratio-in">
                            <div class="<?php echo thz_sanitize_class($hover_classes) ?> <?php echo esc_attr ( $img_mask ) ?>"<?php echo $style ?>>
                                <?php if ($media_height =='auto' ) { ?>
                                <img class="<?php echo thz_sanitize_class($iduration) ?>" src="<?php echo esc_url( $image ) ?>" alt="<?php echo esc_attr( $image_title ) ?>" />
                                <?php } ?>
                                <div class="thz-hover-mask <?php echo thz_sanitize_class($oduration) ?>">
                                    <div class="thz-hover-mask-table">
                                        <a class="thz-hover-link thz-lightbox mfp-image" href="#" <?php echo thz_lightbox_data(); ?> data-mfp-src="<?php echo esc_url( $image ) ?>" data-mfp-title="<?php echo esc_attr( $image_title ) ?>">
                                        </a>
                                        <?php if($show_media_icon =='show'){ ?>
                                        <div class="thz-hover-icons <?php echo thz_sanitize_class($iconef_classes) ?>">
                                            <div class="thz-hover-icon <?php echo thz_sanitize_class($icon_classes) ?>">
                                                <span class="<?php echo $overlay_icon ?>"></span>
                                            </div>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><?php endforeach; ?>
            </div>
        </div>
        <div class="thz-clear"></div>
        <?php
        
        if(count($attachment_ids) > 1 ){
            
           $imgthumbs = '<div class="thz-woo-item-thumbs-slick">';
           $imgthumbs .= '<div class="thz-slick-holder thz-slick-show-multiple">';
           $imgthumbs .= '<div class="thz-slick-slider thz-slick-active thz-slick-woo-thumbs thz-slick-initiating"';
           $imgthumbs .= ' data-space="'.$thumb_space.'" data-speed="300" data-dots="hide" data-autoplay="0" ';
           $imgthumbs .= 'data-autoplaySpeed="3000" data-fade="0" data-slidesToShow="'.$thumb_show.'" data-slidesToScroll="1"';
           $imgthumbs .= ' data-infinite="0" data-navfor=".thz-woo-slick-images" data-navfocus="1"';
           $imgthumbs .= '>';
        
           foreach ($attachment_ids as $key =>  $attachment_id ){ 
               $thumb = thz_get_img_src( $attachment_id , $thumb_size );
               $bg = ' style="background-image:url('. esc_url( $thumb ) .');" data-vid="'.$attachment_id.'"';
               $active =  $key == 0 ? ' slick-current' : ''; 
               
               $imgthumbs .= '<div class="thz-slick-slide'.$active.'" data-type="image">';
               $imgthumbs .= '<div class="thz-slick-slide-in thz-media-custom-size">';
               $imgthumbs .= '<div class="thz-ratio-in">';
               $imgthumbs .= '<div class="'.$hover_classes.' thz-hover-img-mask"';
               $imgthumbs .= $bg . '>';
               $imgthumbs .= '<div class="thz-hover-mask '.$oduration.'">';
               $imgthumbs .= '<div class="thz-hover-mask-table">';
               $imgthumbs .= '</div>';
               $imgthumbs .= '</div>';
               $imgthumbs .= '</div>';
               $imgthumbs .= '</div>';
               $imgthumbs .= '</div>';
               $imgthumbs .= '</div>';
        
           }
        
           $imgthumbs .= '</div>';
           $imgthumbs .= '</div>';
           $imgthumbs .= '</div>';
            
           echo $imgthumbs;
        }
    
        ?>
    </div>
</div>