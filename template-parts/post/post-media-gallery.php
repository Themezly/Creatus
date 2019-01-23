<?php
/**
 * @package      Thz Framework
 * @author       Themezly
 * @websites     http://www.themezly.com | http://www.youjoomla.com | http://www.yjsimplegrid.com
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // No direct access
}

$arch			= thz_get_theme_option('arch',array());
$prefix			= thz_passed_var('blog_layout') =='archive' && !empty($arch) ? 'arch/0/' : '';
$post_atts 		= thz_get_theme_option($prefix.'posts_style',array());
$galleries		= get_post_galleries( get_the_ID(), false );
$media_height	= is_singular('post') ? 'auto' :  thz_get_theme_option($prefix.'posts_style/media_height/picked','thz-ratio-16-9');
$mfp_classes	= ' thz-lightbox-gallery-simple '.thz_get_theme_option('lightbox_slider','thz-mfp-show-slider');
$item_link 		= get_permalink();

if($media_height == 'custom' || $media_height == 'metro'){
	
	$ratio_class 	= ' thz-media-custom-size';
	$img_ratio		= ' thz-media-custom-size';
	$img_mask		= 'thz-hover-img-mask ';
	
	
}else if($media_height == 'auto'){
	
	$ratio_class 	= ' thz-aspect thz-ratio-16-9';	
	$img_ratio		= ' thz-media-height-auto';
	$img_mask		= '';
	
}else{
	
	$ratio_class 	= ' thz-aspect '.$media_height;
	$img_ratio		= ' thz-aspect '.$media_height;
	$img_mask		= 'thz-hover-img-mask ';
}

?>
<?php foreach ($galleries as $key => $gallery) { if ($key > 0 ){ continue; }?>
<div class="thz-post-format-gallery">
	<?php if($gallery){ 
		$slider_layout		= is_singular('post') ? thz_get_option('bpm/show/lay',null): thz_get_theme_option($prefix.'posts_style/slider',null);
		$slider_animation	= is_singular('post') ? thz_get_option('bpm/show/sa',null): thz_get_theme_option($prefix.'posts_style/slider_a',null);
		$slick_data			= thz_slick_data($slider_layout,$slider_animation);
		$slidesToShow		= thz_akg('show',$slider_layout,1);
		$multiple			= '';
		$images				= explode(',',$gallery['ids']);
		$mediacount			= count($gallery);
		
		$activate_slider 	= ' thz-slick-inactive';
		if($gallery > 1){
			$activate_slider = ' thz-slick-active thz-slick-initiating';
			$multiple	= $slidesToShow > 1 ? ' thz-slick-show-multiple' :'';	
		}

		if (is_singular('post')) {
			
			$hover_bgtype		= thz_ov_ef('.thz-single-post','background/type');
			$hover_ef 			= thz_ov_ef('.thz-single-post','oeffect');
			$hover_tr 			= thz_ov_ef('.thz-single-post','oduration');
			$img_ef				= thz_ov_ef('.thz-single-post','ieffect');
			$img_tr 			= thz_ov_ef('.thz-single-post','iduration');
			$show_media_icon	= thz_get_option('bpm/show/mi/picked','show');
			
			if($show_media_icon =='show'){
				$icons_ef 			= thz_ov_ef('.thz-single-post','iceffect');
				$icons_tr 			= thz_ov_ef('.thz-single-post','icduration');
				$icon_shape			= thz_get_option('bpm/show/mi/show/iconbg_metrics/sh','square');
				$icon_pa			= thz_get_option('bpm/show/mi/show/icon_metrics/pa',10);
				$icon_fs			= thz_get_option('bpm/show/mi/show/icon_metrics/fs',16);
				$overlay_icon		= thz_get_option('bpm/show/mi/show/icon','thzicon thzicon-plus');
				$icon_classes		= $icon_shape.' thz-fs-'.$icon_fs.' thz-vp-'.$icon_pa.' thz-hp-'.$icon_pa;	
				$iconef_classes 	= ' '.$icons_ef.' '.$icons_tr;
			}
			$hover_classes 		= $img_mask.'thz-hover-bg-'.$hover_bgtype.' '.$hover_ef.' '.$img_ef.' '.$img_tr;			
			
		}else{
			
			$hover_bgtype		= thz_ov_ef('.thz-archive','background/type');
			$hover_ef 			= thz_ov_ef('.thz-archive','oeffect');
			$hover_tr 			= thz_ov_ef('.thz-archive','oduration');
			$img_ef				= thz_ov_ef('.thz-archive','ieffect');
			$img_tr 			= thz_ov_ef('.thz-archive','iduration');
			$icons_ef 			= thz_ov_ef('.thz-archive','iceffect');
			$icons_tr 			= thz_ov_ef('.thz-archive','icduration');
			$hover_classes 		= $img_mask.'thz-hover-bg-'.$hover_bgtype.' '.$hover_ef.' '.$img_ef.' '.$img_tr;
			$icons_classes 		= ' '.$icons_ef.' '.$icons_tr;			
			
		}
		
	?>
	<div class="thz-post-format-gallery-in">
		<div class="thz-slick-holder <?php echo thz_sanitize_class($mfp_classes.$multiple)?>">
			<div class="thz-slick-slider <?php echo esc_attr( $activate_slider ) ?>"<?php echo thz_sanitize_data($slick_data) ?>>
				<?php foreach($images as $imgskey => $image_id ) { 
					
					$image_size	= isset($gallery['size']) ? $gallery['size'] :'thumbnail';
					$img_meta 	= wp_prepare_attachment_for_js($image_id); 
					$img_title	= $img_meta['caption'] != '' ? $img_meta['caption'] : $img_meta['title'];
                	$img_alt 	= $img_meta['alt'] == '' ? $img_title : esc_attr( $img_meta['alt']);
                	$style 		= $media_height == 'auto' ? '' : thz_print_img_style( $img_meta, $image_size );

					?>
                    <div class="thz-slick-slide" data-type="image">
                        <div class="thz-slick-slide-in<?php echo $img_ratio ?>">
                            <div class="thz-ratio-in">
                                <div class="thz-hover <?php echo esc_attr ( $hover_classes ) ?> thz-items-grid-image"<?php echo $style ?>>
                                    <?php if ($media_height == 'auto') { ?>
                                    <?php echo thz_print_img_html($image_id, $image_size, array('class' => $img_tr , 'alt' => $img_alt)) ?>
                                    <?php } ?>
                                    <div class="thz-hover-mask <?php echo esc_attr ( $hover_tr ) ?>">
                                        <div class="thz-hover-mask-table">
                                            <?php if (is_singular('post')) { ?>
                                                <a class="thz-hover-link thz-lightbox mfp-image" href="#" <?php echo thz_lightbox_data(); ?> data-mfp-src="<?php echo esc_url( $img_meta['url'] ) ?>" data-mfp-title="<?php echo esc_attr( $img_title ) ?>">
                                                </a>										
                                                <?php if($show_media_icon =='show'){ ?>
                                                <div class="thz-hover-icons <?php echo thz_sanitize_class($iconef_classes) ?>">
                                                    <div class="thz-hover-icon <?php echo thz_sanitize_class($icon_classes) ?>">
                                                        <span class="<?php echo thz_sanitize_class($overlay_icon) ?>"></span>
                                                    </div>
                                                </div>
                                                <?php } ?>
                                            <?php }else{ ?>
                                                <a class="thz-hover-link" href="<?php echo esc_url( $item_link  ) ?>"></a>
                                                <div class="thz-hover-icons<?php echo esc_attr( $icons_classes ) ?>">
                                                <?php echo thz_print_post_media_icons($post_atts,$item_link,$image_id); ?>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } // end images foreach?>
			</div>
		</div>
	</div>
	<?php }else{ 
	
			$n_title 	= esc_html__('Gallery images missing','creatus');
			$n_msg 		= esc_html__('Please check gallery post format settings and create your post gallery via "Add media" button in post edit screen.','creatus');
			thz_notify('yellow',$n_title,$n_msg);
		} 
	?>
</div>
<?php } ?>