<?php
if (!defined('FW')){
	die('Forbidden');
}
$header_settings = fw()->theme->get_options( 'header/settings');
$h_collected = array();
fw_collect_options($h_collected, $header_settings);
foreach ($h_collected as $id => $option) { // phpcs:ignore WordPress.WP.GlobalVariablesOverride.OverrideProhibited
    $h_collected[$id]['value'] = fw_get_db_settings_option($id, isset($option['value']) ? $option['value'] : null);
}

$options = $header_settings;