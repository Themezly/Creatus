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
 
$username 		= $instance['username'];
$number	 		= $instance['number'];
$widget_id		= $instance['widget_id'];
$keep_data  	= $instance['keep_data'];
$images 		= thz_instagram_images($username,$number,$widget_id,false,$keep_data);
$hover_bgtype	= thz_ov_ef('.thz-instagram-images','background/type');
$hover_ef 		= thz_ov_ef('.thz-instagram-images','oeffect');
$hover_tr 		= thz_ov_ef('.thz-instagram-images','oduration');
$img_ef			= thz_ov_ef('.thz-instagram-images','ieffect');
$img_tr 		= thz_ov_ef('.thz-instagram-images','iduration');
echo $before_widget;
echo $title;
?>
<?php if ( is_array( $images ) && !empty( $images ) && ! isset($images->errors ) ) {?>
<ul class="thz-instagram-images thz-social-images">
<?php foreach ($images as $image ) {;


			
		$style 				= ' style="background-image:url('.$image['link'].');"';
		$hover_classes 		= 'thz-hover thz-hover-img-mask thz-hover-bg-'.$hover_bgtype.' '.$hover_ef.' '.$img_ef.' '.$img_tr;
		
		$thumbnail_print ='<div class="thz-social-img">';
		$thumbnail_print .='<div class="'.thz_sanitize_class($hover_classes).'"'.$style.'>';
		$thumbnail_print .='<div class="thz-hover-mask '.$hover_tr.'">';
		$thumbnail_print .='<div class="thz-hover-mask-table">';
		$thumbnail_print .='<a href="http://instagram.com/p/'.$image['code'].'" class="thz-hover-link" target="_blank"></a>';
		$thumbnail_print .='</div>';
		$thumbnail_print .='</div>';
		$thumbnail_print .='</div>';	
		$thumbnail_print .='</div>';


?>
	<li>
        <?php echo $thumbnail_print ?>
    </li>
<?php }?>
</ul>
<?php 

	}else{
		
 		echo esc_html_e('Not able to display user images. Check widget settings.', 'creatus');
	}
	echo $after_widget;
?>