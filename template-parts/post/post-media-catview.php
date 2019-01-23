<?php
/**
 * @package      Thz Framework
 * @author       Themezly
 * @websites     http://www.themezly.com | http://www.youjoomla.com | http://www.yjsimplegrid.com
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // No direct access
}

$arch				= thz_get_theme_option('arch',array());
$prefix				= thz_passed_var('blog_layout') == 'archive' && !empty($arch) ? 'arch/0/' : '';
$use_poster			= thz_get_theme_option($prefix.'posts_style/use_poster','active'); 
$post_media 		= thz_get_post_media(false);
$post_media 		= $use_poster == 'active' ? thz_magnific_media( $post_media ) : $post_media ;
$showall 	 	 	= thz_get_theme_option($prefix.'posts_style/slider/showall','all');
if('first' == $showall && !empty($post_media) ){
	$post_media 		= array(0 => $post_media[0]);
}
$post_atts 			= thz_get_theme_option('posts_style',array());
$item_link 			= get_permalink();
$media_size 		= thz_get_theme_option($prefix.'posts_style/image_size');
$media_height		= thz_get_theme_option($prefix.'posts_style/media_height/picked','thz-ratio-16-9');
$mediacount	 		= count($post_media);
$slick_in_class 	= $mediacount > 1 ? 'thz-slick-slide-in ' :'';

if($media_height == 'custom'){
	
	$ratio_class 	= $slick_in_class.'thz-media-custom-size';
	$img_ratio		= $slick_in_class.'thz-media-custom-size';
	$img_mask		= 'thz-hover-img-mask ';
	
	
}else if($media_height == 'auto'){
	
	$ratio_class 	= $slick_in_class.'thz-aspect thz-ratio-16-9';	
	$img_ratio		= $slick_in_class.'thz-media-height-auto';
	$img_mask		= '';
	
}else{
	
	$ratio_class 	= $slick_in_class.'thz-aspect '.$media_height;
	$img_ratio		= $slick_in_class.'thz-aspect '.$media_height;
	$img_mask		= 'thz-hover-img-mask ';
}

$hover_bgtype		= thz_ov_ef('.thz-archive','background/type');
$hover_ef 			= thz_ov_ef('.thz-archive','oeffect');
$hover_tr 			= thz_ov_ef('.thz-archive','oduration');
$img_ef				= thz_ov_ef('.thz-archive','ieffect');
$img_tr 			= thz_ov_ef('.thz-archive','iduration');
$icons_ef 			= thz_ov_ef('.thz-archive','iceffect');
$icons_tr 			= thz_ov_ef('.thz-archive','icduration');
$hover_classes 		= $img_mask.'thz-hover-bg-'.$hover_bgtype.' '.$hover_ef.' '.$img_ef.' '.$img_tr;
$icons_classes 		= ' '.$icons_ef.' '.$icons_tr;
$multiple			='';
$slick_data 		 = '';
$start_slick_wrap	 = '';
$end_slick_wrap	 	 = '';
$start_slick_item	 = '';
$end_slick_item	 	 = '';
$media_class		 = 'thz-media';


if($mediacount > 1 ){
	
	$mfp_classes		= ' '.thz_lightbox_classes(false, true);
	$slider_layout 	 	= thz_get_theme_option($prefix.'posts_style/slider',null);
	$slider_animation 	= thz_get_theme_option($prefix.'posts_style/slider_a',null);
	$slick_data 		= thz_slick_data($slider_layout,$slider_animation);
	$slidesToShow		= thz_akg('show',$slider_layout,1);
	$multiple		 	= $slidesToShow > 1 ? ' thz-slick-show-multiple' :'';
	
	$start_slick_wrap	 = '<div class="thz-slick-holder'.$mfp_classes.$multiple.'">';
	$start_slick_wrap	 .= '<div class="thz-slick-slider thz-slick-active thz-slick-initiating"'.$slick_data.'>';
	$end_slick_wrap	 	 = '</div></div>';
	$media_class		 = 'thz-slick-media';
}
?>
<?php if ( !empty($post_media) ){ 
	echo $start_slick_wrap; ?>
	<?php foreach($post_media as $key => $media ) :
            $type 			= thz_akg('type',$media);
            $source 		= thz_akg('media',$media);
            $mediaid 		= thz_akg('mediaid',$media);
            $qtitle 		= thz_akg('qtitle',$media,null);
            
            if($mediacount > 1){
                $start_slick_item	 = '<div class="thz-slick-slide" data-type="'.$type.'">';
                $end_slick_item	 	 = '</div>';
            }
            
            if($type ==='image') {
                
                $img_meta 		= wp_prepare_attachment_for_js($source['attachment_id']); 
                $img_title 		= $qtitle ? esc_attr( $qtitle ) : esc_attr( $img_meta['title']);
                $img_alt 		= $img_meta['alt'] == '' ? $img_title : esc_attr( $img_meta['alt']);
                $style 			= $media_height == 'auto' ? '' : thz_print_img_style( $source, $media_size );
                $magnific_link 	= isset($source['magnific_link']) ? $source['magnific_link'] : null;
              
            }
    ?>
    <?php if($type ==='image') { echo $start_slick_item; ?>
        <div class="<?php echo esc_attr( $img_ratio ) ?>">
            <div class="thz-ratio-in">
                <?php if($key == 0 || $slidesToShow > 1) { ?>
                <div class="thz-hover <?php echo esc_attr ( $hover_classes ) ?> thz-items-grid-image"<?php echo $style ?>>
                    <?php if ($media_height == 'auto') { ?>
					<?php echo thz_print_img_html($source, $media_size, array('class' => $img_tr , 'alt' => $img_alt)) ?>
                    <?php } ?>
                    <div class="thz-hover-mask <?php echo esc_attr ( $hover_tr ) ?>">
                        <div class="thz-hover-mask-table">
                            <a class="thz-hover-link" href="<?php echo esc_url( $item_link  ) ?>"></a>
                            <div class="thz-hover-icons<?php echo esc_attr( $icons_classes ) ?>">
                                <?php echo thz_print_post_media_icons($post_atts,$item_link,$media); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php }else { ?>
                <div class="thz-hover <?php echo esc_attr ( $img_mask ) ?> thz-items-grid-image"<?php echo $style ?>>
                    <?php if ( $media_height == 'auto' ) { ?>
                    <?php echo thz_print_img_html($source, $media_size, array( 'alt' => $img_alt ) ) ?>
                    <?php } ?>
                    <a class="thz-hover-link" href="<?php echo esc_url( $item_link  ) ?>"></a>
                    <?php if( $magnific_link ) { ?> 
                        <div class="mfp-hide"><?php echo $magnific_link ?></div>
                    <?php }else{ ?>
                    <a class="thz-lightbox mfp-hide" href="#" data-mfp-src="<?php echo esc_url ($source['url'] )?>" data-mfp-title="<?php echo esc_attr ( $img_title )?>"></a><?php } ?>
                </div>
                <?php } ?>
            </div>
        </div>
    <?php echo $end_slick_item; } ?>
    <?php if($type ==='vimeo') { echo $start_slick_item; ?>
        <div class="<?php echo esc_attr ( $ratio_class ) ?>">
            <div class="thz-ratio-in">
                <video id="thz_media<?php echo esc_attr ( $mediaid ) ?>" class="<?php echo $media_class ?> thz-video-vimeo thz-media-respond">
                    <source src="<?php echo esc_url ( $source ) ?>" type="video/vimeo">
                </video>
            </div>
        </div>
    <?php echo $end_slick_item; } ?>
    <?php if($type ==='youtube') { echo $start_slick_item; ?>
        <div class="<?php echo esc_attr ( $ratio_class ) ?>">
            <div class="thz-ratio-in">
                <video id="thz_media<?php echo esc_attr ( $mediaid )?>" class="<?php echo $media_class ?> thz-video-youtube thz-media-respond">
                    <source src="<?php echo esc_url ( $source ) ?>" type="video/youtube">
                </video>
            </div>
        </div>
    <?php echo $end_slick_item; } ?>
    <?php if($type ==='html5video') { echo $start_slick_item; ?>
        <div class="<?php echo esc_attr ( $ratio_class ) ?>">
            <div class="thz-ratio-in">
                <video id="thz_media<?php echo esc_attr ( $mediaid ) ?>" class="<?php echo $media_class ?> thz-video-html5 thz-media-respond">
                    <source src="<?php echo esc_url ( $source ) ?>" />
                </video>
            </div>
        </div>
    <?php echo $end_slick_item; } ?>
    <?php if($type ==='html5audio') { echo $start_slick_item; ?>
        <div class="<?php echo esc_attr ( $ratio_class ) ?> thz-slick-audio">
            <div class="thz-ratio-in">
                <div class="thz-media-audio-holder">
                    <audio id="thz_media<?php echo esc_attr ( $mediaid ) ?>" class="<?php echo $media_class ?> thz-audio thz-media-respond">
                        <source src="<?php echo esc_url ( trim($source) ) ?>" type="audio/mp3">
                    </audio>
                </div>
            </div>
        </div>
    <?php echo $end_slick_item; } ?>
    <?php if($type ==='iframe') { echo $start_slick_item; ?>
        <div class="<?php echo esc_attr ( $ratio_class ) ?> thz-slick-iframe">
            <div class="thz-ratio-in">
                <?php thz_media_iframe_helper($source); ?>
            </div>
        </div>
    <?php echo $end_slick_item; } ?>
    <?php if($type ==='oembed') { echo $start_slick_item; ?>
        <div class="<?php echo esc_attr ( $ratio_class ) ?> thz-slick-oembed">
            <div class="thz-ratio-in">
                <?php echo wp_oembed_get( esc_url ( trim($source) ) , array('width'  => 640,'height' => 360) );?>
            </div>
        </div>
    <?php echo $end_slick_item; } ?> 
    <?php if($type ==='selfvideo') { echo $start_slick_item; ?>
        <div class="<?php echo esc_attr ( $ratio_class ) ?>">
            <div class="thz-ratio-in">
                <video id="thz_media<?php echo esc_attr ( $mediaid ) ?>" class="<?php echo $media_class ?> thz-video-html5 thz-media-respond">
                    <?php foreach($source as $video_ext){ $type = wp_check_filetype( $video_ext['url']); ?>
                        <source src="<?php echo esc_url ( $video_ext['url'] ) ?>" type="<?php echo $type['type']  ?>" />
                    <?php } unset($video_ext);?>
                </video>
            </div>
        </div>
   <?php echo $end_slick_item; } ?> 
    <?php if($type ==='selfaudio') { echo $start_slick_item; ?>
        <div class="<?php echo esc_attr ( $ratio_class ) ?> thz-slick-audio">
            <div class="thz-ratio-in">
                <div class="thz-media-audio-holder">
                    <audio id="thz_media<?php echo esc_attr ( $mediaid ) ?>" class="<?php echo $media_class ?> thz-audio thz-media-respond">
                        <?php foreach($source as $audio_ext){ $type = wp_check_filetype( $audio_ext['url']); ?>
                            <source src="<?php echo esc_url ( $audio_ext['url'] ) ?>" type="<?php echo $type['type']  ?>" />
                        <?php } unset($audio_ext);?>
                    </audio>
                </div>
            </div>
        </div>
    <?php echo $end_slick_item; } ?>             
    <?php endforeach; echo $end_slick_wrap; ?>
<?php }?>