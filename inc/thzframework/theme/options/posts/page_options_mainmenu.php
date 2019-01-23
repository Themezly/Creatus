<?php
if (!defined('FW')){
	die('Forbidden');
}
$mainmenu_settings = fw()->theme->get_options( 'mainmenu/settings');
$t_collecten = array();
fw_collect_options($t_collecten, $mainmenu_settings);
foreach ($t_collecten as $id => $option) {
    $t_collecten[$id]['value'] = fw_get_db_settings_option($id, isset($option['value']) ? $option['value'] : null);
}

$options = $mainmenu_settings;