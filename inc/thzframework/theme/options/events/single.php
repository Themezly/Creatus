<?php
if (!defined('FW'))
	die('Forbidden');
$options = array(
	'singleeventsetingsgroup' => array(
		'type' => 'group',
		'options' => array(
			'singleeventtab' => array(
				'title' => __('Event', 'creatus'),
				'type' => 'tab',
				'options' => fw()->theme->get_options('events/single_event')
			),
			'singleeventtitletab' => array(
				'title' => __('Titles & date', 'creatus'),
				'type' => 'tab',
				'options' => fw()->theme->get_options('events/single_title_and_date')
			),
			'singleeventcontenttab' => array(
				'title' => __('Content', 'creatus'),
				'type' => 'tab',
				'options' => fw()->theme->get_options('events/single_content')
			),			
			thz_theme()->get_options('events/single_sharing_tab'),
			'eventagenda' => array(
				'title' => __('Agenda', 'creatus'),
				'type' => 'tab',
				'options' => fw()->theme->get_options('events/single_agenda')
			),
			'eventagendadetails' => array(
				'title' => __('Meta', 'creatus'),
				'type' => 'tab',
				'options' => fw()->theme->get_options('events/single_meta')
			),
			'relatedeventstab' => array(
				'title' => __('Related events', 'creatus'),
				'type' => 'tab',
				'li-attr' => array('class' => 'thz-related-events-li'),
				'lazy_tabs'=> false,
				'options' => array(
					fw()->theme->get_options('events/related')
				)
			),
		)
	) // group
);