<?php
if (!defined('FW'))
	die('Forbidden');
	
$options = array(
	'headergeneraltab' => array(
		'title' => __('General', 'creatus'),
		'type' => 'tab',
		'lazy_tabs' => false,
		'options' => array(
			fw()->theme->get_options( 'header/general')
		)
	),
);