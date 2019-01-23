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
rewind_posts();
while (have_posts()): $thz_rowstarthook++;
	if (($thz_rowstarthook % 2) != 0){ // skip 'odd' posts
		$wp_query->next_post();
	}else{
		the_post();
		get_template_part('template-parts/post/post','item');
	}
endwhile;