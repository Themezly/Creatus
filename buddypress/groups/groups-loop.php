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
 * BuddyPress - Groups Loop
 *
 * Querystring is set via AJAX in _inc/ajax.php - bp_legacy_theme_object_filter().
 *
 * @package BuddyPress
 * @subpackage bp-legacy
 */

?>

<?php

/**
 * Fires before the display of groups from the groups loop.
 *
 * @since 1.2.0
 */
$animate			= thz_get_theme_option('bp_animate',array());
$animation_data		= thz_print_animation($animate);
$animation_class	= thz_print_animation($animate,true);
$classes 			= array($animation_class);

do_action( 'bp_before_groups_loop' ); ?>

<?php if ( bp_has_groups( bp_ajax_querystring( 'groups' ) ) ) : ?>

	<div id="pag-top" class="pagination">

		<div class="pag-count" id="group-dir-count-top">

			<?php bp_groups_pagination_count(); ?>

		</div>

		<div class="pagination-links" id="group-dir-pag-top">

			<?php bp_groups_pagination_links(); ?>

		</div>

	</div>

	<?php

	/**
	 * Fires before the listing of the groups list.
	 *
	 * @since 1.1.0
	 */
	do_action( 'bp_before_directory_groups_list' ); ?>

	<ul id="groups-list" class="item-list">

	<?php while ( bp_groups() ) : bp_the_group(); ?>

		<li <?php bp_group_class($classes); ?><?php echo thz_sanitize_data($animation_data)?>>
			<?php if ( ! bp_disable_group_avatar_uploads() ) : ?>
				<div class="item-avatar">
					<a href="<?php bp_group_permalink(); ?>"><?php bp_group_avatar( 'type=thumb&width=210&height=210' ); ?></a>
				</div>
			<?php endif; ?>

			<div class="item">
				<div class="item-title"><a href="<?php bp_group_permalink(); ?>"><?php bp_group_name(); ?></a></div>
				<div class="item-meta"><span class="activity"><?php printf( esc_html__( 'active %s', 'creatus' ), bp_get_group_last_active() ); ?></span></div>

<?php /*?>				<div class="item-desc"><?php bp_group_description_excerpt(); ?></div>
<?php */?>
				<?php

				/**
				 * Fires inside the listing of an individual group listing item.
				 *
				 * @since 1.1.0
				 */
				do_action( 'bp_directory_groups_item' ); ?>

			</div>

			<div class="action">

				<?php

				/**
				 * Fires inside the action section of an individual group listing item.
				 *
				 * @since 1.1.0
				 */
				do_action( 'bp_directory_groups_actions' ); ?>

				<div class="meta">

					<?php bp_group_type(); ?> / <?php bp_group_member_count(); ?>

				</div>

			</div>

			<div class="clear"></div>
		</li>

	<?php endwhile; ?>

	</ul>

	<?php

	/**
	 * Fires after the listing of the groups list.
	 *
	 * @since 1.1.0
	 */
	do_action( 'bp_after_directory_groups_list' ); ?>

	<div id="pag-bottom" class="pagination">

		<div class="pag-count" id="group-dir-count-bottom">

			<?php bp_groups_pagination_count(); ?>

		</div>

		<div class="pagination-links" id="group-dir-pag-bottom">

			<?php bp_groups_pagination_links(); ?>

		</div>

	</div>

<?php else: ?>

	<div id="message" class="info">
		<p><?php _e( 'There were no groups found.', 'creatus' ); ?></p>
	</div>

<?php endif; ?>

<?php

/**
 * Fires after the display of groups from the groups loop.
 *
 * @since 1.2.0
 */
do_action( 'bp_after_groups_loop' ); ?>
