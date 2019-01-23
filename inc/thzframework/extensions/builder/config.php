<?php if (!defined('FW')) die('Forbidden');

$cfg = array();

/**
 * Default item widths for all builders
 *
 * It is better to use fw_ext_builder_get_item_width() function to retrieve the item widths
 * because it has a filter and users will be able to customize the widths for a specific builder
 *
 * @see fw_ext_builder_get_item_width()
 */
 
$cfg['grid.row.class'] ='thz-row';
$cfg['default_item_widths'] = array(

	'1_6' => array(
		'title'          => '1/6',
		'backend_class'  => 'fw-col-sm-2',
		'frontend_class' => 'thz-column thz-col-1-6',
	),
	'1_5' => array(
		'title'          => '1/5',
		'backend_class'  => 'fw-col-sm-15',
		'frontend_class' => 'thz-column thz-col-1-5',
	),
	'1_4' => array(
		'title'          => '1/4',
		'backend_class'  => 'fw-col-sm-3',
		'frontend_class' => 'thz-column thz-col-1-4',
	),
	'1_3' => array(
		'title'          => '1/3',
		'backend_class'  => 'fw-col-sm-4',
		'frontend_class' => 'thz-column thz-col-1-3',
	),
	'2_5' => array(
		'title'          => '2/5',
		'backend_class'  => 'thz-col-2-5',
		'frontend_class' => 'thz-column thz-col-2-5',
	),
	'1_2' => array(
		'title'          => '1/2',
		'backend_class'  => 'fw-col-sm-6',
		'frontend_class' => 'thz-column thz-col-1-2',
	),
	'3_5' => array(
		'title'          => '3/5',
		'backend_class'  => 'thz-col-3-5',
		'frontend_class' => 'thz-column thz-col-3-5',
	),
	'2_3' => array(
		'title'          => '2/3',
		'backend_class'  => 'fw-col-sm-8',
		'frontend_class' => 'thz-column thz-col-2-3',
	),
	'3_4' => array(
		'title'          => '3/4',
		'backend_class'  => 'fw-col-sm-9',
		'frontend_class' => 'thz-column thz-col-3-4',
	),
	'4_5' => array(
		'title'          => '4/5',
		'backend_class'  => 'thz-col-4-5',
		'frontend_class' => 'thz-column thz-col-4-5',
	),
	'1_1' => array(
		'title'          => '1/1',
		'backend_class'  => 'fw-col-sm-12',
		'frontend_class' => 'thz-column thz-col-1',
	),
);
