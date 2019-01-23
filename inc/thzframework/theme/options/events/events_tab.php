<?php
if (!defined('FW'))
	die('Forbidden');
	
if ( !fw_ext( 'events' ) ) {
	$options = array();
	return;
}

$options = array(
	'eventsoptionstab' => array(
		'title' => __('Events', 'creatus'),
		'type' => 'tab',
		'options' => array(
			'eventsarchivetab' => array(
				'title' => __('Events archive', 'creatus'),
				'type' => 'tab',
				'options' => fw()->theme->get_options('events/general')
			),
			'singleevnttab' => array(
				'title' => __('Single event', 'creatus'),
				'type' => 'tab',
				'options' => array(
					fw()->theme->get_options('events/single')
				)
			)
		)
	)
);