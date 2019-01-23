<?php
/**
 * @package      Thz Framework
 * @author       Themezly
 * @websites     http://www.themezly.com | http://www.youjoomla.com | http://www.yjsimplegrid.com
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // No direct access
}

$arch					= thz_get_theme_option('arch',array());
$prefix					= thz_passed_var('blog_layout') =='archive' && !empty($arch) ? 'arch/0/' : '';
$quote_format_text 		= thz_get_post_option('quote_format_text','');
$quote_format_author 	= thz_get_post_option('quote_format_author','');
$quote_format_type		= thz_get_post_option('quote_format_type','quotes'); 
$media_height			= thz_get_theme_option($prefix.'posts_style/media_height/picked','thz-ratio-16-9');
$quote_height			= thz_get_theme_option($prefix.'posts_style/quote_height','auto'); 
$ratio_in_class 		='thz-ratio-in';
$has_ratio				= ' thz-has-ratio';
if($media_height == 'custom'){
	
	$ratio_class 	= 'thz-media-custom-size';
	
}else{
	
	$ratio_class 	= 'thz-aspect '.$media_height;
}

if('auto' == $quote_height || $media_height == 'auto'){
	$ratio_class ='thz-media-quote-auto';
	$ratio_in_class ='thz-media-quote-auto-in';
	$has_ratio = '';
}
?>
<div class="thz-grid-item-media-holder thz-no-excerpt<?php echo thz_sanitize_class ( $has_ratio ) ?>">
	<div class="thz-grid-item-media thz-grid-item-media-quote">
		<?php if($quote_format_text){ ?>
		<div class="thz-post-format-quote thz-custom-format-item thz-quote-type-<?php echo esc_attr ( $quote_format_type ) ?>">
            <div class="<?php echo thz_sanitize_class ( $ratio_class ) ?>">
                <div class="<?php echo thz_sanitize_class ( $ratio_in_class ) ?>">
                    <span class="thz-custom-format-item-in">
                        <span class="thz-custom-format-main">
                            <span class="thz-custom-format-holder">
                                <span class="thz-custom-format-title">
                                    <?php echo esc_attr ($quote_format_text) ?>
                                </span>
                                <?php if($quote_format_author != '') { ?>
                                <span class="thz-custom-format-sub thz-post-format-quote-author">
                                    <?php echo esc_attr ($quote_format_author) ?>
                                </span>
                                <?php } ?>
                            </span>
                        </span>
                    </span>
                    <a class="thz-custom-format-over-link" href="<?php echo get_permalink() ?>"></a>
                </div>
            </div>
    	</div>
		<?php }else{ 
        
                $n_title 	= esc_html__('Quote missing','creatus');
                $n_msg 		= esc_html__('Please check quote post format settings and insert quote text.','creatus');
                thz_notify('yellow',$n_title,$n_msg);
            } 
        ?>
	</div>
</div>