<?php
if (!defined('FW'))
	die('Forbidden');
$options = array(
	'paginationsettingstab' => array(
		'title'   => __( 'Pagination', 'creatus' ),
		'type'    => 'tab',
		'options' => array(
			fw()->theme->get_options('additional/pagination')
		),
	),
	'navigationsettingstab' => array(
		'title'   => __( 'Navigation', 'creatus' ),
		'type'    => 'tab',
		'options' => array(
			fw()->theme->get_options('additional/navigation')
		),
	),
	
);