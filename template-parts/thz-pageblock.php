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
 * The template for displaying thz-pageblock.
 */
?>
<!DOCTYPE html>
<html id="thz-site-html" <?php language_attributes(); ?> class="<?php thz_html_classes(); ?>">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php wp_head(); ?>
<?php thz_print_codes('before_head',true); ?>
</head>
	<body <?php body_class(); ?>><?php thz_preloader();thz_print_codes('after_body',true); ?>
    	<div id="thz-body-box" class="thz-body-box">
        	<div id="thz-body-container" class="thz-body-container">
                <div id="thz-wrapper" class="thz-wrapper<?php thz_layout(); ?>">
                	<?php thz_site_header('left'); ?>
                	<div class="thz-wrapper-inner thz-pageblock-wrapper">
                    	<?php thz_site_header('main'); ?>
						<?php 
                            if(thz_has_builder()){
                                
                                while ( have_posts() ) {
                                   the_post();
                                   the_content();
                                }
                                
                            }else{
                                
                                $n_title 	= esc_html__('Please use page builder','creatus');
                                $n_msg		= get_the_title(). ' ';
                                $n_msg 		.= esc_html__('Page block post type content must use Unyson page builder','creatus');
                                thz_notify('yellow thz-shc',$n_title,$n_msg);
                                
                            }
                         ?>
                     </div>
                     <?php thz_site_header('right'); ?>
                </div>
            </div>
        </div>
		<?php thz_print_search_overlay(); ?>
        <?php thz_video_bg_o('body_boxstyle/background') ?> 
        <?php wp_footer(); ?>
        <?php thz_print_codes('before_body',true); ?>
	</body>
</html>