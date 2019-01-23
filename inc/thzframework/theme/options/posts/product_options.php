<?php
if (!defined('FW')){
	die('Forbidden');
}
$product_settings = fw()->theme->get_options( 'woo/single');
$s_collected = array();
fw_collect_options($s_collected, $product_settings);
foreach ($s_collected as $id => $option) {
    $s_collected[$id]['value'] = fw_get_db_settings_option($id, isset($option['value']) ? $option['value'] : null);
}
$options = $product_settings;