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
 * The template part for displaying a message that posts cannot be found.
 */
?>
<section class="thz-search-no-results no-results not-found">
	<h2 class="thz-search-page-title">
		<?php _e( 'Nothing Found', 'creatus' ); ?>
	</h2>
	<div class="thz-search-page-content">
		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>
		<p class="thz-fw-600"><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'creatus' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>
		<?php elseif ( is_search() ) : ?>
		<p class="thz-fw-600 thz-mb-10">
			<?php _e( 'Cannot find what you are looking for? Please try again with different keywords.', 'creatus' ); ?>
		</p>
		<?php get_search_form(); ?>
		<?php else : ?>
		<p class="thz-fw-600 thz-mb-10">
			<?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'creatus' ); ?>
		</p>
		<?php get_search_form(); ?>
		<?php endif; ?>
	</div>
</section>
