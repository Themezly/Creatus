<?php
if (!defined('FW')){
	die('Forbidden');
}

$post_single_settings = fw()->theme->get_options( 'blog/single');
$pss_collected = array();
fw_collect_options($pss_collected, $post_single_settings);
foreach ($pss_collected as $id => $option) { // phpcs:ignore WordPress.WP.GlobalVariablesOverride.OverrideProhibited
    $pss_collected[$id]['value'] = fw_get_db_settings_option($id, isset($option['value']) ? $option['value'] : null);
}

$options = $post_single_settings;