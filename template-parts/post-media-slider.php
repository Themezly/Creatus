<?php
/**
 * @package      Thz Framework
 * @author       Themezly
 * @websites     http://www.themezly.com | http://www.youjoomla.com | http://www.yjsimplegrid.com
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // No direct access
}

$incfeatured		= thz_get_post_option('incfeatured', 'include');
$use_poster			= thz_get_post_option('use_poster','active'); 
$post_media 		= $incfeatured == 'include' ? thz_get_post_media(false,true) : thz_get_post_media(false,false);
$post_media 		= $use_poster == 'active' ? thz_magnific_media( $post_media ) : $post_media ;
$media_height		= thz_get_post_option('media_height/picked','thz-ratio-16-9');
$media_size			= thz_get_post_option('media_size','thz-img-large');  
$mfp_classes		= ' thz-lightbox-gallery-simple '.thz_get_theme_option('lightbox_slider','thz-mfp-show-slider');
$mediacount	 		= count($post_media);
$slick_in_class 	= $mediacount > 1 ? 'thz-slick-slide-in ' :'';

$opset 		 		= get_post_type() == 'post' ? 'bpm' : 'ppm';
$show_media_icon	= thz_get_option($opset.'/show/mi/picked','show');
$hover_ovc			= $opset == 'bpm' ? '.thz-post-media' : '.thz-project-media';
$hover_bgtype		= thz_ov_ef($hover_ovc,'background/type');
$hover_ef 			= thz_ov_ef($hover_ovc,'oeffect');
$hover_tr 			= thz_ov_ef($hover_ovc,'oduration');
$img_ef				= thz_ov_ef($hover_ovc,'ieffect');
$img_tr 			= thz_ov_ef($hover_ovc,'iduration');

if($show_media_icon =='show'){
	$icons_ef 			= thz_ov_ef($hover_ovc,'iceffect');
	$icons_tr 			= thz_ov_ef($hover_ovc,'icduration');
	$icon_shape			= thz_get_option($opset.'/show/mi/show/iconbg_metrics/sh','square');
	$icon_pa			= thz_get_option($opset.'/show/mi/show/icon_metrics/pa',10);
	$icon_fs			= thz_get_option($opset.'/show/mi/show/icon_metrics/fs',16);
	$overlay_icon		= thz_get_option($opset.'/show/mi/show/icon','thzicon thzicon-plus');
	$icon_classes		= $icon_shape.' thz-fs-'.$icon_fs.' thz-vp-'.$icon_pa.' thz-hp-'.$icon_pa;	
	$iconef_classes 	= ' '.$icons_ef.' '.$icons_tr;
}
$hover_classes 		= 'thz-hover-bg-'.$hover_bgtype.' '.$hover_ef.' '.$img_ef.' '.$img_tr;




if($media_height == 'custom'){
	
	$ratio_class 	= $slick_in_class.'thz-media-custom-size';
	$img_ratio		= $slick_in_class.'thz-media-custom-size';
	$img_mask		= $slick_in_class.'thz-hover-img-mask';
	
}else if ($media_height == 'auto'){
	
	$ratio_class 	= $slick_in_class.'thz-aspect thz-ratio-16-9';
	$img_ratio		= $slick_in_class.'thz-media-height-auto';
	$img_mask		= '';
	
}else{
	$ratio_class 	= $slick_in_class.'thz-aspect '.$media_height;
	$img_ratio		= $slick_in_class.'thz-aspect '.$media_height;
	$img_mask		= ' thz-hover-img-mask';
}


$multiple			 = '';
$slick_data 		 = '';
$start_slick_wrap	 = '';
$end_slick_wrap	 	 = '';
$start_slick_item	 = '';
$end_slick_item	 	 = '';
$media_class		 = 'thz-media';

if( $mediacount > 1 ){
	
	$slider_layout 	 	 = thz_get_option($opset.'/show/lay',null);
	$slider_animation 	 = thz_get_option($opset.'/show/sa',null);
	$slick_data 		 = thz_slick_data($slider_layout,$slider_animation);
	$slidesToShow		 = thz_akg('show',$slider_layout,1);
	$multiple			 = $slidesToShow > 1 ? ' thz-slick-show-multiple' :'';	
	
	$start_slick_wrap	 = '<div class="thz-slick-holder '.$mfp_classes.$multiple.'">';
	$start_slick_wrap	 .= '<div class="thz-slick-slider thz-slick-active thz-slick-initiating"'.$slick_data.'>';
	$end_slick_wrap	 	 = '</div></div>';
	$media_class		 = 'thz-slick-media';
}

?>
<?php if ( !empty($post_media) ){ 
	echo $start_slick_wrap; ?>
	<?php foreach($post_media as $media ) :
	
		$type 		= thz_akg('type',$media);
		$source 	= thz_akg('media',$media);
		$mediaid 	= thz_akg('mediaid',$media); 
		$qtitle 	= thz_akg('qtitle',$media,null);
	
		if($mediacount > 1){
			$start_slick_item	 = '<div class="thz-slick-slide" data-type="'.$type.'">';
			$end_slick_item	 	 = '</div>';
		}
					
		if($type ==='image') {
			
			$img_meta 		= wp_prepare_attachment_for_js($source['attachment_id']); 
			$img_title 		= $qtitle ? $qtitle : $img_meta['title'];
			$img_alt 		= $img_meta['alt'] == '' ? $img_title : esc_attr( $img_meta['alt']);
			$style 			= $media_height == 'auto' ? '' : thz_print_img_style( $source, $media_size );
			$magnific_link 	= isset($source['magnific_link']) ? $source['magnific_link'] : null;
			
			if($show_media_icon =='show'){
				$hover_icon 	= isset($source['overlay_icon']) ? $source['overlay_icon'] : $overlay_icon;
			}					
		}
		
		if($type === 'html5video' || $type === 'selfvideo') {
	
			$poster	= thz_akg('poster',$media);
			$poster = !empty($poster) ? $poster['url'] : null;
			$has_poster = $poster ? ' thz-media-has-poster':'';
		}
	?>
	<?php if($type ==='image') { echo $start_slick_item; ?>
		<div class="<?php echo $img_ratio ?>">
			<div class="thz-ratio-in">
				<div class="thz-hover<?php echo esc_attr ( $img_mask ) ?> <?php echo thz_sanitize_class($hover_classes) ?>"<?php echo $style ?>>
					<?php if ($media_height =='auto' ) { ?>
					<?php echo thz_print_img_html($source, $media_size, array('class' => $img_tr , 'alt' => $img_alt)) ?>
					<?php } ?>
					<div class="thz-hover-mask <?php echo thz_sanitize_class($hover_tr) ?>">
						<div class="thz-hover-mask-table">
						<?php if( $magnific_link ) { echo $magnific_link ; }else{ ?>
						<a class="thz-hover-link thz-lightbox mfp-image" href="#" <?php echo thz_lightbox_data(); ?> data-mfp-src="<?php echo esc_url( $source['url'] ) ?>" data-mfp-title="<?php echo esc_attr( $img_alt ) ?>"></a><?php } ?>
							<?php if($show_media_icon =='show'){ ?>
							<div class="thz-hover-icons <?php echo thz_sanitize_class($iconef_classes) ?>">
								<div class="thz-hover-icon <?php echo thz_sanitize_class($icon_classes) ?>">
									<span class="<?php echo thz_sanitize_class($hover_icon) ?>"></span>
								</div>
							</div>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php echo $end_slick_item; } ?>
	<?php if($type ==='vimeo') { echo $start_slick_item; ?>
		<div class="<?php echo $ratio_class ?>">
			<div class="thz-ratio-in">
				<video id="thz_media<?php echo $mediaid ?>" class="<?php echo $media_class ?> thz-video-vimeo thz-media-respond" width="640" height="360">
					<source src="<?php echo esc_url ( $source ) ?>" type="video/vimeo">
				</video>
			</div>
		</div>
	<?php echo $end_slick_item; } ?>
	<?php if($type ==='youtube') { echo $start_slick_item; ?>
		<div class="<?php echo $ratio_class ?>">
			<div class="thz-ratio-in">
				<video id="thz_media<?php echo $mediaid ?>" width="640" height="360" class="<?php echo $media_class ?> thz-video-youtube thz-media-respond">
					<source src="<?php echo esc_url ( $source ) ?>" type="video/youtube">
				</video>
			</div>
		</div>
	<?php echo $end_slick_item; } ?>
	<?php if($type ==='html5video') { echo $start_slick_item; ?>
		<div class="<?php echo $ratio_class ?>">
			<div class="thz-ratio-in">
				<video id="thz_media<?php echo $mediaid ?>" width="640" height="360" class="<?php echo $media_class ?> thz-video-html5 thz-media-respond<?php echo thz_sanitize_class ( $has_poster ) ?>"<?php if( $poster ){ echo ' poster="'.esc_url($poster).'"';}?>>
					<source src="<?php echo esc_url ( $source ) ?>" />
				</video>
			</div>
		</div>
	<?php echo $end_slick_item; } ?>
	<?php if($type ==='html5audio') { echo $start_slick_item; ?>
		<div class="<?php echo $ratio_class ?> thz-slick-audio">
			<div class="thz-ratio-in">
				<div class="thz-media-audio-holder">
					<audio id="thz_media<?php echo $mediaid ?>" height="30px" class="<?php echo $media_class ?> thz-audio thz-media-respond">
						<source src="<?php echo esc_url ( trim($source) ) ?>" type="audio/mp3">
					</audio>
				</div>
			</div>
		</div>
	<?php echo $end_slick_item; } ?>
	<?php if($type ==='iframe') { echo $start_slick_item; ?>
		<div class="<?php echo $ratio_class ?> thz-slick-iframe">
			<div class="thz-ratio-in">
				<?php thz_media_iframe_helper($source); ?>
			</div>
		</div>
	<?php echo $end_slick_item; } ?>
	<?php if($type ==='oembed') { echo $start_slick_item; ?>
		<div class="<?php echo $ratio_class ?> thz-slick-oembed">
			<div class="thz-ratio-in">
				<?php echo wp_oembed_get( esc_url ( trim($source) ) , array('width'  => 640,'height' => 360) );?>
			</div>
		</div>
	<?php echo $end_slick_item; } ?> 
	<?php if($type ==='selfvideo') { echo $start_slick_item; ?>
		<div class="<?php echo $ratio_class ?>">
			<div class="thz-ratio-in">
				<video id="thz_media<?php echo $mediaid ?>" width="640" height="360" class="<?php echo $media_class ?> thz-video-html5 thz-media-respond<?php echo thz_sanitize_class ( $has_poster ) ?>"<?php if( $poster ){ echo ' poster="'.esc_url($poster).'"';}?>>
					<?php foreach($source as $video_ext){ $type = wp_check_filetype( $video_ext['url']); ?>
						<source src="<?php echo esc_url ( $video_ext['url'] ) ?>" type="<?php echo $type['type']  ?>" />
					<?php } unset($video_ext);?>
				</video>
			</div>
		</div>
	<?php echo $end_slick_item; } ?>
	<?php if($type ==='selfaudio') { echo $start_slick_item; ?>
		<div class="<?php echo $ratio_class ?> thz-slick-audio">
			<div class="thz-ratio-in">
				<div class="thz-media-audio-holder">
					<audio id="thz_media<?php echo $mediaid ?>" height="30px" class="<?php echo $media_class ?> thz-audio thz-media-respond">
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