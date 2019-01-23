<?php
if (!defined('FW')){
	die('Forbidden');
}
$event_settings = fw()->theme->get_options( 'events/single');
$s_collected = array();
fw_collect_options($s_collected, $event_settings);
foreach ($s_collected as $id => $option) {
    $s_collected[$id]['value'] = fw_get_db_settings_option($id, isset($option['value']) ? $option['value'] : null);
}
$options = $event_settings;