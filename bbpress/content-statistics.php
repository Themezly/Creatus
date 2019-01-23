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
 * Statistics Content Part
 *
 * @package bbPress
 * @subpackage Theme
 */

// Get the statistics
$stats = bbp_get_statistics(); ?>

<dl class="thz-dl-horizontal bbp-dl-stats" role="main">

	<?php do_action( 'bbp_before_statistics' ); ?>

	<dt><?php _e( 'Registered Users', 'creatus' ); ?></dt>
	<dd>
		<strong><?php echo esc_html( $stats['user_count'] ); ?></strong>
	</dd>

	<dt><?php _e( 'Forums', 'creatus' ); ?></dt>
	<dd>
		<strong><?php echo esc_html( $stats['forum_count'] ); ?></strong>
	</dd>

	<dt><?php _e( 'Topics', 'creatus' ); ?></dt>
	<dd>
		<strong><?php echo esc_html( $stats['topic_count'] ); ?></strong>
	</dd>

	<dt><?php _e( 'Replies', 'creatus' ); ?></dt>
	<dd>
		<strong><?php echo esc_html( $stats['reply_count'] ); ?></strong>
	</dd>

	<dt><?php _e( 'Topic Tags', 'creatus' ); ?></dt>
	<dd>
		<strong><?php echo esc_html( $stats['topic_tag_count'] ); ?></strong>
	</dd>

	<?php if ( !empty( $stats['empty_topic_tag_count'] ) ) : ?>

		<dt><?php _e( 'Empty Topic Tags', 'creatus' ); ?></dt>
		<dd>
			<strong><?php echo esc_html( $stats['empty_topic_tag_count'] ); ?></strong>
		</dd>

	<?php endif; ?>

	<?php if ( !empty( $stats['topic_count_hidden'] ) ) : ?>

		<dt><?php _e( 'Hidden Topics', 'creatus' ); ?></dt>
		<dd>
			<strong>
				<abbr title="<?php echo esc_attr( $stats['hidden_topic_title'] ); ?>"><?php echo esc_html( $stats['topic_count_hidden'] ); ?></abbr>
			</strong>
		</dd>

	<?php endif; ?>

	<?php if ( !empty( $stats['reply_count_hidden'] ) ) : ?>

		<dt><?php _e( 'Hidden Replies', 'creatus' ); ?></dt>
		<dd>
			<strong>
				<abbr title="<?php echo esc_attr( $stats['hidden_reply_title'] ); ?>"><?php echo esc_html( $stats['reply_count_hidden'] ); ?></abbr>
			</strong>
		</dd>

	<?php endif; ?>

	<?php do_action( 'bbp_after_statistics' ); ?>

</dl>

<?php unset( $stats );