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
 * The template for displaying the footer.
 *
 * Contains the closing of the 
 * .thz-wrapper , #thz-main-wrap and .thz-container started in header.php
 * @package creatus
 */
?>			<?php thz_site_main_end(); ?>
			<?php thz_single_post_navigation('outside'); ?>
            <?php thz_related_posts_output('outside') ?>
            <?php thz_comments_output('outside'); ?>
			<?php get_template_part( 'template-parts/thz', 'panels'); ?>
			</div><!-- / .thz-wrapper-inner -->
            <?php thz_page_block('above_footer'); ?>
			<?php thz_print_footer();?>
            <?php thz_page_block('under_footer'); ?>
			<?php thz_video_bg_o('wrapper_boxstyle/background') ?>
			<?php thz_site_header('right'); ?>
            <?php thz_single_post_navigation('fixed'); ?>
            </div><!-- / .thz-wrapper -->
         </div><!-- / .thz-body-container -->
     </div><!-- / .thz-body-box -->
    <?php thz_print_search_overlay(); ?>
    <?php thz_print_cookies_consent(); ?>
	<?php thz_video_bg_o('body_boxstyle/background') ?> 
	<?php wp_footer(); ?>
	<?php thz_print_codes('before_body',true); ?>
	</body>
</html>