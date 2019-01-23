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
 * The template for displaying page builder content.
 * Template Name: Page builder template
 */
get_header(); 
?>
<div id="thz-full-page-holder" class="thz-full-width">
	<main id="contentblock" class="main-full-width"<?php thz_sdata('main'); ?>>
		<?php while ( have_posts() ) : the_post(); ?>
        	<?php thz_sdata('page',true,true); ?>
            <?php the_content(); ?>
        <?php endwhile; // end of the loop. ?>
	</main><!-- #contentblock -->
</div><!-- .holders -->
<?php get_footer(); ?>