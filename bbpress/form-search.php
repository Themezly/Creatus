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
 * Search 
 *
 * @package bbPress
 * @subpackage Theme
 */

?>
<form class="thz-search-form" role="search" method="get" id="bbp-search-form" action="<?php bbp_search_url(); ?>">
	<div>
		<label class="screen-reader-text hidden" for="bbp_search"><?php _e( 'Search for:', 'creatus' ); ?></label>
		<input type="hidden" name="action" value="bbp-search-request" />
		<input tabindex="<?php bbp_tab_index(); ?>" type="text" placeholder="<?php esc_attr_e( 'Search forums', 'creatus' ); ?>" value="<?php echo esc_attr( bbp_get_search_terms() ); ?>" name="bbp_search" id="bbp_search" />
		<input tabindex="<?php bbp_tab_index(); ?>" class="button" type="submit" id="bbp_search_submit" value="" />
	</div>
</form>
