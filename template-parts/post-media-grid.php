<?php
/**
 * @package      Thz Framework
 * @author       Themezly
 * @websites     http://www.themezly.com | http://www.youjoomla.com | http://www.yjsimplegrid.com
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // No direct access
} 
$opset 		 	= get_post_type() == 'post' ? 'bpm' : 'ppm';
$incfeatured	= thz_get_post_option('incfeatured', 'include');
$use_poster		= thz_get_post_option('use_poster','active'); 
$post_media 	= $incfeatured == 'include' ? thz_get_post_media(false,true) : thz_get_post_media(false,false);
$post_media 	= $use_poster == 'active' ? thz_magnific_media( $post_media ) : $post_media ;
$media_height	= thz_get_post_option('media_height/picked','thz-ratio-16-9'); 
$media_size		= thz_get_post_option('media_size','thz-img-large');
$mfp_classes	= ' thz-lightbox-gallery-simple '.thz_get_theme_option('lightbox_slider','thz-mfp-show-slider');

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
$hover_classes 			= 'thz-hover-bg-'.$hover_bgtype.' '.$hover_ef.' '.$img_ef.' '.$img_tr;


if($media_height == 'custom' || $media_height == 'metro'){
	
	$ratio_class 	= ' thz-media-custom-size';
	$img_ratio		= ' thz-media-custom-size';
	$img_mask		= ' thz-hover-img-mask';
	
}else if ($media_height == 'auto'){
	
	$ratio_class 	= ' thz-aspect thz-ratio-16-9';
	$img_ratio		= ' thz-media-height-auto';
	$img_mask		= '';
	
}else{
	$ratio_class 	= ' thz-aspect '.$media_height;
	$img_ratio		= ' thz-aspect '.$media_height;
	$img_mask		= ' thz-hover-img-mask';
}

if( $media_height == 'metro' ){
	$sequence_type = thz_get_post_option('media_height/metro/sequence',1);
}

$gutter 		= thz_get_post_option('media_layout/grid/gutter',15);
$columns 		= thz_get_post_option('media_layout/grid/columns',3);
$no_response 	= $columns < 3 ? ' thz-grid-noresponse' :'';
$data_layout	= $media_height == 'auto' ? 'masonry' : $media_height;
$animate_data 	= ' data-type="image" data-anim-effect="thz-anim-fadeIn" data-anim-duration="700" data-anim-delay="100"';
$row_classes 	= 'thz-items-grid thz-post-media-grid thz-post-single thz-ml-n'.$gutter.$no_response.$mfp_classes;
$column_classes = 'thz-grid-item thz-media-grid-item thz-animate-parent '.thz_col_width( $columns, 3 ).' thz-pl-'.$gutter;
$grid_data 		= ' data-isotope-mode="packery" data-layout-type="'.esc_attr( $data_layout ).'"';
?>
<div class="thz-media-grid-isotope thz-is-isotope thz-post-media-container">
	<?php if ( !empty($post_media) ){ ?>
	<div class="<?php echo thz_sanitize_class ( $row_classes ) ?>"<?php echo thz_sanitize_data($grid_data)?>>
		<div class="thz-items-sizer <?php echo thz_col_width( $columns, 3 ) ?>"></div>
		<?php foreach($post_media as $mediakey => $media ) :
				$type 		= thz_akg('type',$media);
				$source 	= thz_akg('media',$media);
				$mediaid 	= thz_akg('mediaid',$media); 
				$qtitle 	= thz_akg('qtitle',$media,null);
				$metroitem 	= '';
				
				// metro
				if( $media_height == 'metro' ){
					
					$sequence = thz_metro_sequence_maker($sequence_type);
					
					foreach ($sequence['items'] as $key => $size){
						
						if($mediakey % $sequence['count'] == $key){
							
							$metroitem = ' thz-item-metro-'. $size ;
						}
						unset($key,$size);
					}
					unset($sequence);
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
		<?php if($type ==='image') {?>
		<div class="<?php echo thz_sanitize_class( $column_classes.$metroitem ) ?>" data-type="image">
			<div class="thz-grid-item-in thz-mb-<?php echo esc_attr( $gutter ) ?> thz-animate"<?php echo $animate_data ?>>
				<div class="thz-media-grid-ratio<?php echo $img_ratio ?>">
					<div class="thz-ratio-in">
						<div class="thz-hover<?php echo esc_attr ( $img_mask ) ?> <?php echo thz_sanitize_class($hover_classes) ?>"<?php echo $style ?>>
							<?php if ($media_height =='auto' ) { ?>
                            <?php echo thz_print_img_html($source, $media_size, array('class' => $img_tr , 'alt' => $img_alt)) ?>
							<?php } ?>
							<div class="thz-hover-mask <?php echo thz_sanitize_class($hover_tr) ?>">
								<div class="thz-hover-mask-table">
                                <?php if( $magnific_link ) { echo $magnific_link ; }else{ ?>
								<a class="thz-hover-link thz-lightbox mfp-image" href="#" <?php echo thz_lightbox_data(); ?> data-mfp-src="<?php echo esc_url( $source['url'] ) ?>" data-mfp-title="<?php echo esc_attr( $img_title ) ?>"></a><?php } ?>
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
			</div>
		</div>
		<?php }?>
		<?php if($type ==='vimeo') {?>
		<div class="<?php echo thz_sanitize_class( $column_classes.$metroitem ) ?>" data-type="vimeo"<?php echo $animate_data ?>>
			<div class="thz-grid-item-in thz-mb-<?php echo esc_attr( $gutter ) ?>">
				<div class="<?php echo $ratio_class ?>">
					<div class="thz-ratio-in">
						<video id="thz_media<?php echo $mediaid ?>" class="thz-media thz-video-vimeo thz-media-respond" width="640" height="360">
							<source src="<?php echo esc_url ( $source ) ?>" type="video/vimeo">
						</video>
					</div>
				</div>
			</div>
		</div>
		<?php }?>
		<?php if($type ==='youtube') {?>
		<div class="<?php echo thz_sanitize_class( $column_classes.$metroitem ) ?>" data-type="youtube"<?php echo $animate_data ?>>
			<div class="thz-grid-item-in thz-mb-<?php echo esc_attr( $gutter ) ?>">
				<div class="<?php echo $ratio_class ?>">
					<div class="thz-ratio-in">
						<video id="thz_media<?php echo $mediaid ?>" width="640" height="360" class="thz-media thz-video-youtube thz-media-respond">
							<source src="<?php echo esc_url ( $source ) ?>" type="video/youtube">
						</video>
					</div>
				</div>
			</div>
		</div>
		<?php }?>
		<?php if($type ==='html5video') {?>
		<div class="<?php echo thz_sanitize_class( $column_classes.$metroitem ) ?>" data-type="html5video"<?php echo $animate_data ?>>
			<div class="thz-grid-item-in thz-mb-<?php echo esc_attr( $gutter ) ?>">
				<div class="<?php echo $ratio_class ?>">
					<div class="thz-ratio-in">
						<video id="thz_media<?php echo $mediaid ?>" width="640" height="360" class="thz-media thz-video-html5 thz-media-respond<?php echo thz_sanitize_class ( $has_poster ) ?>"<?php if( $poster ){ echo ' poster="'.esc_url($poster).'"';}?>>
							<source src="<?php echo esc_url ( $source ) ?>" />
						</video>
					</div>
				</div>
			</div>
		</div>
		<?php }?>
		<?php if($type ==='html5audio') {?>
		<div class="<?php echo thz_sanitize_class( $column_classes.$metroitem ) ?>" data-type="html5audio"<?php echo $animate_data ?>>
			<div class="thz-grid-item-in thz-mb-<?php echo esc_attr( $gutter ) ?>">
				<div class="<?php echo $ratio_class ?>">
					<div class="thz-ratio-in">
						<div class="thz-media-audio-holder">
							<audio id="thz_media<?php echo $mediaid ?>" height="30px" class="thz-media thz-audio thz-media-respond">
								<source src="<?php echo esc_url ( trim($source) ) ?>" type="audio/mp3">
							</audio>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php }?>
		<?php if($type ==='iframe') {?>
		<div class="<?php echo thz_sanitize_class( $column_classes.$metroitem ) ?>" data-type="iframe"<?php echo $animate_data ?>>
			<div class="thz-grid-item-in thz-mb-<?php echo esc_attr( $gutter ) ?>">
				<div class="<?php echo $ratio_class ?>">
					<div class="thz-ratio-in">
						<?php thz_media_iframe_helper($source); ?>
					</div>
				</div>
			</div>
		</div>
		<?php }?>
		<?php if($type ==='oembed') {?>
		<div class="<?php echo thz_sanitize_class( $column_classes.$metroitem ) ?>" data-type="iframe"<?php echo $animate_data ?>>
			<div class="thz-grid-item-in thz-mb-<?php echo esc_attr( $gutter ) ?>">
				<div class="<?php echo $ratio_class ?>">
					<div class="thz-ratio-in">
						<?php echo wp_oembed_get( esc_url ( trim($source) ) , array('width'  => 640,'height' => 360) );?>
					</div>
				</div>
			</div>
		</div>
		<?php }?>
		<?php if($type ==='selfvideo') {?>
		<div class="<?php echo thz_sanitize_class( $column_classes.$metroitem ) ?>" data-type="html5video"<?php echo $animate_data ?>>
			<div class="thz-grid-item-in thz-mb-<?php echo esc_attr( $gutter ) ?>">
				<div class="<?php echo $ratio_class ?>">
					<div class="thz-ratio-in">
						<video id="thz_media<?php echo $mediaid ?>" width="640" height="360" class="thz-media thz-video-html5 thz-media-respond<?php echo thz_sanitize_class ( $has_poster ) ?>"<?php if( $poster ){ echo ' poster="'.esc_url($poster).'"';}?>>
							<?php foreach($source as $video_ext){ $type = wp_check_filetype( $video_ext['url']); ?>
                                <source src="<?php echo esc_url ( $video_ext['url'] ) ?>" type="<?php echo $type['type']  ?>" />
                            <?php } unset($video_ext);?>
						</video>
					</div>
				</div>
			</div>
		</div>
		<?php }?>
		<?php if($type ==='selfaudio') {?>
		<div class="<?php echo thz_sanitize_class( $column_classes.$metroitem ) ?>" data-type="html5audio"<?php echo $animate_data ?>>
			<div class="thz-grid-item-in thz-mb-<?php echo esc_attr( $gutter ) ?>">
				<div class="<?php echo $ratio_class ?>">
					<div class="thz-ratio-in">
						<div class="thz-media-audio-holder">
							<audio id="thz_media<?php echo $mediaid ?>" height="30px" class="thz-media thz-audio thz-media-respond">
								<?php foreach($source as $audio_ext){ $type = wp_check_filetype( $audio_ext['url']); ?>
                                    <source src="<?php echo esc_url ( $audio_ext['url'] ) ?>" type="<?php echo $type['type']  ?>" />
                                <?php } unset($audio_ext);?>
							</audio>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php }?>        
		<?php endforeach;?>
	</div>
	<?php }?>
	<div class="thz-items-gutter-adjust thz-mb-n<?php echo esc_attr( $gutter ) ?>"></div>
</div>