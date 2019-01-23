<?php
if (!defined('FW')) {
	die('Forbidden');
}

$customizer_mode = thz_get_customizer_mode();
$options = thz_customizer_options( fw()->theme->get_options('customizer/options_'.$customizer_mode) );