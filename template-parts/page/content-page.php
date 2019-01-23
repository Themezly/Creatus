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
 * The template used for displaying page content in page.php
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'creatus' ),
				'after'  => '</div>',
			) );
		?>
        <?php thz_sdata('page',true,true); ?>
	</div>
</article><!-- #post-## -->
<?php 
	if ( ( comments_open() || get_comments_number()) && !is_attachment() ){
		comments_template(); 
	}
?>