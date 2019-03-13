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
$video_type 	= thz_get_post_option('video_format_type/picked');
$video			= thz_get_post_option('video_format_type/'.$video_type.'/video');
$media_height	= is_singular('post') ? 'auto' : thz_get_theme_option($prefix.'posts_style/media_height/picked','thz-ratio-16-9');
$has_poster		= '';
if($video_type === 'self') {
	
	$poster	=  thz_get_post_option('video_format_type/'.$video_type.'/poster',array());
	$poster = !empty($poster) ? $poster['url'] : null;
	$has_poster = ' thz-media-has-poster';
}
$vtag_class = $has_poster;

if($media_height == 'custom' || $media_height == 'metro'){
	
	$ratio_class 	= ' thz-media-custom-size';
	
}else if($media_height == 'auto'){
	
	$ratio_class 	= ' thz-aspect thz-ratio-16-9';	
	
}else{
	
	$ratio_class 	= ' thz-aspect '.$media_height;
}
?>
<div class="thz-post-format-video">
	<?php if($video){ ?>
	<div class="thz-post-format-video-in<?php echo esc_attr ( $ratio_class ) ?>">
		<div class="thz-ratio-in">
		<?php if($video_type == 'embed'){ ?>
			<?php thz_media_iframe_helper($video); ?>
		<?php }elseif($video_type == 'link'){ $type = strpos($video, 'vimeo') !== false ? 'vimeo' : 'youtube'; // phpcs:ignore WordPress.WP.GlobalVariablesOverride.OverrideProhibited ?>
			<video id="thz_media<?php echo get_the_ID() ?>" class="thz-media thz-video-<?php echo $type ?> thz-media-respond">
				<source src="<?php echo esc_url ( $video ) ?>" type="video/<?php echo $type ?>" />
			</video>	
		<?php }else{ ?>
			<video id="thz_media<?php echo get_the_ID() ?>" class="thz-media thz-video-html5 thz-media-respond<?php echo thz_sanitize_class($vtag_class); ?>"<?php if( $poster ){ echo ' poster="'.esc_url($poster).'"';}?>>
				<?php foreach($video as $video_ext){ $type = wp_check_filetype( $video_ext['url']); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.OverrideProhibited ?>
					<source src="<?php echo esc_url ( $video_ext['url'] ) ?>" type="<?php echo $type['type']  ?>" />
				<?php } unset($video);?>
			</video>			
		<?php }?>
		</div>
	</div>
	<?php }else{ 
    
            $n_title 	= esc_html__('Video file missing','creatus');
            $n_msg 		= esc_html__('Please check video post format settings and select a video file.','creatus');
            thz_notify('yellow',$n_title,$n_msg);
        } 
    ?>
</div>