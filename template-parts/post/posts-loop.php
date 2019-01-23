<?php
/**
 * @package      Thz Framework
 * @author       Themezly
 * @websites     http://www.themezly.com | http://www.youjoomla.com | http://www.yjsimplegrid.com
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // No direct access
}

global $wp_query,$thz_rowstarthook;
$thz_rowstarthook = 0; 
while ( have_posts() ) : the_post(); 
	get_template_part('template-parts/post/post','item');
	++$thz_rowstarthook; 
endwhile;