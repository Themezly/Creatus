<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$id 				= thz_akg('id',$atts); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.OverrideProhibited
$css_id 			= thz_akg('cmx/i',$atts);
$id_out				= !empty($css_id) ? str_replace(' ','',$css_id): 'thz-media-item-'.$id;
$css_class 			= thz_akg('cmx/c',$atts);
$css_class			= $css_class !='' ? $css_class.' ':'';
$res_class			= _thz_responsive_classes(thz_akg('cmx',$atts));
$use_poster			= thz_akg('use_poster',$atts,'active'); 
$get_media			= thz_akg('m',$atts,null);
$get_media			= !empty($get_media) ? thz_merge_media(array($get_media)) : array();
$get_media 			= $use_poster == 'active' ? thz_magnific_media( $get_media,$atts ) : $get_media ;
$media_height		= thz_akg('media_height/picked',$atts,'thz-ratio-16-9'); 
$over_mode			= thz_akg('over_mode',$atts,'thzhover');
$mode_class			= ' thz-media-mode-'.$over_mode;
$hover_bgtype		= thz_akg('med_over/background/type',$atts,'solid');
$hover_ef 			= thz_akg('med_over/oeffect',$atts,'thz-hover-fadein');
$hover_tr 			= thz_akg('med_over/oduration',$atts,'thz-transease-04');
$img_ef				= thz_akg('med_over/ieffect',$atts,'thz-img-zoomin');
$img_tr 			= thz_akg('med_over/iduration',$atts,'thz-transease-04');
$grayscale			= thz_akg('grayscale',$atts,'none');
$grayscale			= $grayscale !='none' ? ' '.$grayscale :'';
$media_size			= thz_akg('media_size',$atts,'thz-img-medium'); 
$animate			= thz_akg('animate',$atts);
$animate_data		= thz_print_animation($animate);
$animation_class	= thz_print_animation($animate,true,'thz-isotope-animate');
$cpx				= thz_akg('cpx',$atts);
$cpx_data			= thz_print_cpx($cpx);
$cpx_class			= thz_print_cpx($cpx,true);
$animate_parent		= $animation_class != '' ? ' thz-animate-parent ' :'';
$hover_classes 		= 'thz-hover-bg-'.$hover_bgtype.' '.$hover_ef.' '.$img_ef.' '.$img_tr.$grayscale;
$overlay_icon		= thz_akg('icon_mx/i',$atts,'thzicon thzicon-play3');

if($media_height == 'custom' || $media_height == 'metro'){
	
	$ratio_class 	= ' thz-media-custom-size';
	$img_ratio		= ' thz-media-custom-size';
	$img_mask		= ' thz-hover-img-mask';
	
}else if ($media_height == 'auto'){
	
	$ratio_class 	= ' thz-aspect thz-media-height-auto';
	$img_ratio		= ' thz-media-height-auto';
	$img_mask		= '';
	
}else{
	$ratio_class 	= ' thz-aspect '.$media_height;
	$img_ratio		= ' thz-aspect '.$media_height;
	$img_mask		= ' thz-hover-img-mask';
}


$icons_ef 			= thz_akg('med_over/iceffect',$atts,'thz-comein-bottom');
$icons_tr 			= thz_akg('med_over/icduration',$atts,'thz-transease-05');
$icon_classes		= ' square thz-vp-10 thz-hp-10';	
$iconef_classes 	= ' '.$icons_ef.' '.$icons_tr;

$holder_classes 	= $css_class.'thz-shc thz-media-item-container thz-lightbox-single'.$mode_class.$animate_parent.$cpx_class.$res_class;
$item_classes 		= ' thz-media-item'.$animation_class;
?>

<?php if ( !empty($get_media) ){ ?>
<div id="<?php echo esc_attr($id_out) ?>" class="<?php echo thz_sanitize_class($holder_classes); ?>"<?php echo thz_sanitize_data($cpx_data) ?>>
	<?php 
		
		$media		= $get_media[0];
		$type 		= thz_akg('type',$media); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.OverrideProhibited
		$source 	= thz_akg('media',$media);
		$mediaid 	= thz_akg('mediaid',$media); 
		$qtitle 	= thz_akg('qtitle',$media,null);
		$has_poster	= '';
		$controls	= '';
		$video_attr = '';
		$dmejs 		= '';
		
		if($type === 'oembed') {
			
			$autoplay = thz_akg('m/type/oembed/autoplay',$atts,'inactive');
			$autoplay = $autoplay == 'active' ? true :false;
		
		}else{
			
			$vmx			= thz_akg('m/type/'.$type.'/vmx',$atts,false);
			
			if( false == $vmx ){
				
				$autoplay = thz_akg('m/type/'.$type.'/autoplay',$atts,'inactive');
				$autoplay = $autoplay == 'active' ? ' thz-media-autoplay' :'';				
				
			}else{
			
				$autoplay 		= isset($vmx['autoplay']) ? ' thz-media-autoplay' :'';
	
				if(!isset($vmx['controls'])){
					$vmx['playsinline'] = true;
				}
				$video_attr = !empty($vmx) ? implode(' ',array_keys($vmx)).' ' : '';
				$dmejs		= isset($vmx['dmejs']) ? '-dmejs': '';
				$controls 	= !isset($vmx['controls']) ? ' thz-hide-controls': '';	
			
			}
			
		}
		

		if($type === 'html5video' || $type === 'selfvideo') {
			
			$poster		=  thz_akg('m/type/'.$type.'/poster',$atts, array());
			$poster 	= !empty($poster) ? $poster['url'] : null;
			$has_poster = ' thz-media-has-poster';
			
		}
	
		$vtag_class = $autoplay.$has_poster.$controls;
		
		if($type ==='image') {
	
			$img_meta 		= wp_prepare_attachment_for_js($source['attachment_id']); 
			$img_title 		= $qtitle ? esc_attr( $qtitle ) : esc_attr( $img_meta['title']);
			$img_alt 		= $img_meta['alt'] == '' ? $img_title : esc_attr( $img_meta['alt']);
			$style 			= $media_height == 'auto' ? '' : thz_print_img_style( $source, $media_size );		
			$magnific_link 	= isset($source['magnific_link']) ? $source['magnific_link'] : null;
			$hover_icon 	= $overlay_icon =='' ? $source['overlay_icon'] : $overlay_icon;
			
		}

		$hover_out = 'thz-hover'.$img_mask.' '.$hover_classes;
		
	?>
	<?php if($type ==='image') {?>
	<div class="thz-media-item-media<?php echo thz_sanitize_class($item_classes); ?>"<?php echo thz_sanitize_data($animate_data) ?>>
		<div class="thz-media-item-ratio<?php echo thz_sanitize_class($img_ratio) ?>">
			<div class="thz-ratio-in">
					<div class="<?php echo thz_sanitize_class($hover_out) ?>"<?php echo thz_sanitize_data($style) ?>>																					 								<?php 
					
						if($over_mode == 'reveal' || $over_mode == 'directional'){
							
							$overlay_box ='';
							
							if($over_mode == 'reveal'){
								
								$reveal_effect 	= thz_akg('reveal_effect/effect',$atts,'thz-reveal-goleft'); 
								$transition 	= thz_akg('reveal_effect/transition',$atts,'thz-transease-04'); 
								$reveal_class	= 'thz-overlay-box '.$reveal_effect.' '.$transition;
								
							}else{
								
								$reveal_class = 'thz-overlay-box'; 
							}
							
							if($over_mode == 'directional'){
								$overlay_box .='<div class="thz-overlay-box-directional">';
							}
							
							$overlay_box .='<div class="'.thz_sanitize_class($reveal_class).'">';
							$overlay_box .='<div class="thz-overlay-box-icon">';
							$overlay_box .='<div class="thz-hover-icon '.thz_sanitize_class($icon_classes).'">';
							$overlay_box .='<span class="'.thz_sanitize_class($hover_icon).'">';
							$overlay_box .='</span>';
							$overlay_box .='</div>';
							$overlay_box .='</div>';
							
							
							$overlay_box .='</div>';
							
							if($over_mode == 'directional'){
								 $overlay_box .='</div>';
							}
							
							echo $overlay_box;	
						}							
					?>
					<?php if ($media_height =='auto' ) { ?>
					<?php echo thz_print_img_html($source, $media_size, array('class' => $img_tr , 'alt' => $img_alt)) ?>
					<?php } ?>
					<div class="thz-hover-mask <?php echo thz_sanitize_class($hover_tr) ?>">
						<div class="thz-hover-mask-table">
							<?php echo $magnific_link ; ?>
							<?php if($over_mode =='thzhover'){ ?>
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
	<?php }?>
	<?php if($type ==='vimeo') {?>
	<div class="thz-media-item-media<?php echo thz_sanitize_class($item_classes); ?>"<?php echo thz_sanitize_data($animate_data) ?>>
		<div class="<?php echo $ratio_class ?>">
			<div class="thz-ratio-in">
				<video id="thz_media<?php echo $mediaid ?>" <?php echo $video_attr; ?>class="thz-media thz-video-vimeo thz-media-respond<?php echo thz_sanitize_class($vtag_class); ?>" width="640" height="360">
					<source src="<?php echo esc_url ( $source ) ?>" type="video/vimeo">
				</video>
			</div>
		</div>
	</div>
	<?php }?>
	<?php if($type ==='youtube') {?>
	<div class="thz-media-item-media<?php echo thz_sanitize_class($item_classes); ?>"<?php echo thz_sanitize_data($animate_data) ?>>
		<div class="<?php echo $ratio_class ?>">
			<div class="thz-ratio-in">
				<video id="thz_media<?php echo esc_attr($mediaid) ?>" width="640" height="360" <?php echo $video_attr; ?>class="thz-media thz-video-youtube thz-media-respond<?php echo thz_sanitize_class($vtag_class); ?>">
					<source src="<?php echo esc_url ( $source ) ?>" type="video/youtube">
				</video>
			</div>
		</div>
	</div>
	<?php }?>
	<?php if($type ==='html5video') {?>
	<div class="thz-media-item-media<?php echo thz_sanitize_class($item_classes); ?>"<?php echo thz_sanitize_data($animate_data) ?>>
		<div class="<?php echo $ratio_class ?>">
			<div class="thz-ratio-in">
				<video id="thz_media<?php echo esc_attr($mediaid) ?>" width="640" height="360" <?php echo $video_attr; ?>class="thz-media<?php echo $dmejs ?> thz-video-html5 thz-media-respond<?php echo thz_sanitize_class($vtag_class); ?>"<?php if( $poster ){ echo ' poster="'.esc_url($poster).'"';}?>>
					<source src="<?php echo esc_url ( $source ) ?>" />
				</video>
			</div>
		</div>
	</div>
	<?php }?>
	<?php if($type ==='html5audio') {?>
	<div class="thz-media-item-media<?php echo thz_sanitize_class($item_classes); ?>"<?php echo thz_sanitize_data($animate_data) ?>>
		<div class="<?php echo $ratio_class ?>">
			<div class="thz-ratio-in">
				<div class="thz-media-audio-holder">
					<audio id="thz_media<?php echo esc_attr($mediaid) ?>" height="30px" class="thz-media thz-audio thz-media-respond">
						<source src="<?php echo esc_url ( trim($source) ) ?>" type="audio/mp3">
					</audio>
				</div>
			</div>
		</div>
	</div>
	<?php }?>
	<?php if($type ==='iframe') {?>
	<div class="thz-media-item-media<?php echo thz_sanitize_class($item_classes); ?>"<?php echo thz_sanitize_data($animate_data) ?>>
		<div class="<?php echo $ratio_class ?>">
			<div class="thz-ratio-in">
				<?php thz_media_iframe_helper($source); ?>
			</div>
		</div>
	</div>
	<?php }?>
	<?php if($type ==='oembed') {?>
	<div class="thz-media-item-media<?php echo thz_sanitize_class($item_classes); ?>"<?php echo thz_sanitize_data($animate_data) ?>>
		<div class="<?php echo $ratio_class ?>">
			<div class="thz-ratio-in">
				<?php echo thz_get_oembed( esc_url ( trim($source) ) , array('width'  => 640,'height' => 360),$autoplay );?>
			</div>
		</div>
	</div>
	<?php }?>
	<?php if($type ==='selfvideo') {?>
	<div class="thz-media-item-media<?php echo thz_sanitize_class($item_classes); ?>"<?php echo thz_sanitize_data($animate_data) ?>>
		<div class="<?php echo $ratio_class ?>">
			<div class="thz-ratio-in">
				<video id="thz_media<?php echo esc_attr($mediaid) ?>" width="640" height="360" <?php echo $video_attr; ?>class="thz-media<?php echo $dmejs ?> thz-video-html5 thz-media-respond<?php echo thz_sanitize_class($vtag_class); ?>"<?php if( $poster ){ echo ' poster="'.esc_url($poster).'"';}?>>
					<?php foreach($source as $video_ext){ $type = wp_check_filetype( $video_ext['url']); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.OverrideProhibited ?>
						<source src="<?php echo esc_url ( $video_ext['url'] ) ?>" type="<?php echo $type['type'] ?>" />
					<?php } unset($video_ext);?>
				</video>
			</div>
		</div>
	</div>
	<?php }?>
	<?php if($type ==='selfaudio') {?>
	<div class="thz-media-item-media<?php echo thz_sanitize_class($item_classes); ?>"<?php echo thz_sanitize_data($animate_data) ?>>
		<div class="<?php echo $ratio_class ?>">
			<div class="thz-ratio-in">
				<div class="thz-media-audio-holder">
					<audio id="thz_media<?php echo esc_attr($mediaid)?>" height="30px" class="thz-media thz-audio thz-media-respond">
					<?php foreach($source as $audio_ext){ $type = wp_check_filetype( $audio_ext['url']); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.OverrideProhibited ?>
						<source src="<?php echo esc_url ( $audio_ext['url'] ) ?>" type="<?php echo $type['type'] ?>" />
					<?php } unset($audio_ext);?>
					</audio>
				</div>
			</div>
		</div>
	</div>
	<?php }?>
 </div>
<?php }?>