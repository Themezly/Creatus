<?php
if (!defined('FW'))
	die('Forbidden');
$options = array(
	'relatedgeneraltab' => array(
		'title' => __('General', 'creatus'),
		'type' => 'tab',
		'options' => fw()->theme->get_options('events/related_general')
	),
	'relatedmediatab' => array(
		'title' => __('Media', 'creatus'),
		'type' => 'tab',
		'options' => fw()->theme->get_options('events/related_media')
	),
	'relatedtitletab' => array(
		'title' => __('Title', 'creatus'),
		'type' => 'tab',
		'options' => fw()->theme->get_options('events/related_title')
	),
	'relatedintrotab' => array(
		'title' => __('Intro text', 'creatus'),
		'type' => 'tab',
		'options' => fw()->theme->get_options('events/related_intro')
	)
);