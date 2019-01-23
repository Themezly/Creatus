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
$audio_type 	= thz_get_post_option('audio_format_type/picked');
$audio			= thz_get_post_option('audio_format_type/'.$audio_type.'/audio'); 
$media_height	= thz_get_theme_option($prefix.'posts_style/media_height/picked','thz-ratio-16-9');
$audio_height	= thz_get_theme_option($prefix.'posts_style/audio_height','inherit'); 
$ratio_in_class ='thz-ratio-in';
if($media_height == 'custom' || $media_height == 'metro'){
	
	$ratio_class 	= ' thz-media-custom-size';
	
}else if($media_height == 'auto'){
	
	$ratio_class 	= ' thz-aspect thz-ratio-16-9';	
	
}else{
	
	$ratio_class 	= ' thz-aspect '.$media_height;
}

if('only' == $audio_height || is_singular('post')){
	$ratio_class =' thz-media-audio-player-only';
	$ratio_in_class ='thz-media-audio-player-only-in';
}
?>
<div class="thz-post-format-audio">
	<?php if($audio){ ?>
	<div class="thz-post-format-audio-in<?php echo thz_sanitize_class ( $ratio_class ) ?>">
		<div class="<?php echo thz_sanitize_class ( $ratio_in_class ) ?>">
			<div class="thz-media-audio-holder">
				<audio id="thz_media<?php echo get_the_ID() ?>" class="thz-media thz-audio thz-media-respond">
					<?php if($audio_type == 'self'){ ?>
					<?php foreach($audio as $audio_ext){ $type = wp_check_filetype( $audio_ext['url']); ?>
					<source src="<?php echo esc_url ( $audio_ext['url'] ) ?>" type="<?php echo $type['type']  ?>" />
					<?php }unset($audio);?>
					<?php }else{ $type = wp_check_filetype( $audio ); ?>
					<source src="<?php echo esc_url ( $audio ) ?>" type="<?php echo $type['type']  ?>" />
					<?php } ?>
				</audio>
			</div>
		</div>
	</div>
	<?php }else{ 
	
		$n_title 	= esc_html__('Audio file missing','creatus');
		$n_msg 		= esc_html__('Please check audio post format settings and select an audio file.','creatus');
		thz_notify('yellow',$n_title,$n_msg);
	
	 } 
	 ?>
</div>
