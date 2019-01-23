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
 * Template for displaying the search form
 */
?>
<form class="thz-search-form" method="get" action="<?php echo esc_url( home_url( '/' )); ?>">
	<div class="thz-search-form-inner">
        <input type="text" class="text-input" placeholder="<?php _e('Search site', 'creatus'); ?>" value="" name="s" />
        <input type="submit" class="search-button" value="" />
    </div>
</form>