<?php
if (!defined('FW')){
	die('Forbidden');
}
$page_title_settings = fw()->theme->get_options( 'pagetitle/settings');
$pt_collected = array();
fw_collect_options($pt_collected, $page_title_settings);
foreach ($pt_collected as $id => $option) {
    $pt_collected[$id]['value'] = fw_get_db_settings_option($id, isset($option['value']) ? $option['value'] : null);
}
unset($page_title_settings['pagetitlesectionsettings']['options']['pt_show_on']);
$options = $page_title_settings;