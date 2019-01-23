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
 * @var $instance
 * @var $before_widget
 * @var $after_widget
 * @var $title
 */
 
$api 		= $instance['api'];
$userid 	= $instance['userid']; 
$photoset 	= $instance['photoset'];
$number	 	= $instance['number'];
$widget_id	= $instance['widget_id']; 
$keep_data  = $instance['keep_data'];

echo $before_widget;
echo $title;

$images 		= thz_flickr_images($api,$userid,$photoset,$number,'m',$widget_id,false,$keep_data);
$hover_bgtype	= thz_ov_ef('.thz-flickr-images','background/type');
$hover_ef 		= thz_ov_ef('.thz-flickr-images','oeffect');
$hover_tr 		= thz_ov_ef('.thz-flickr-images','oduration');
$img_ef			= thz_ov_ef('.thz-flickr-images','ieffect');
$img_tr 		= thz_ov_ef('.thz-flickr-images','iduration');

?>
<?php if ( is_array( $images ) && ! empty( $images )) {?>
<ul class="thz-flickr-images thz-social-images">
<?php foreach ($images as $image ) {

	$style 				= ' style="background-image:url('.$image['thumb'].');"';
	$hover_classes 		= 'thz-hover thz-hover-img-mask thz-hover-bg-'.$hover_bgtype.' '.$hover_ef.' '.$img_ef.' '.$img_tr;
	
	$thumbnail_print ='<div class="thz-social-img">';
	$thumbnail_print .='<div class="'.thz_sanitize_class($hover_classes).'"'.$style.'>';
	$thumbnail_print .='<div class="thz-hover-mask '.$hover_tr.'">';
	$thumbnail_print .='<div class="thz-hover-mask-table">';
	$thumbnail_print .='<a href="'.$image['url'].'" class="thz-hover-link" target="_blank"></a>';
	$thumbnail_print .='</div>';
	$thumbnail_print .='</div>';
	$thumbnail_print .='</div>';	
	$thumbnail_print .='</div>';


?>
	<li>
        <?php echo $thumbnail_print ?>
    </li>
<?php }// end foreach?>
</ul>
<?php 

	}else{
		
 		echo esc_html_e('Not able to display user images. Check widget settings.', 'creatus');
	}
	echo $after_widget;
?>