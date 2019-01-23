<?php
if (!defined('FW')){
	die('Forbidden');
}
$footer_settings = fw()->theme->get_options( 'footer_settings');
$f_collected = array();
fw_collect_options($f_collected, $footer_settings);
foreach ($f_collected as $id => $option) {
    $f_collected[$id]['value'] = fw_get_db_settings_option($id, isset($option['value']) ? $option['value'] : null);
}
$options = $footer_settings;