<?php
if (!defined('FW'))	die('Forbidden');

$options = array(
	'imagestab' => array(
		'title' => __('Images', 'creatus'),
		'type' => 'tab',
		'lazy_tabs'=> false,
		'options' => array(
			fw()->theme->get_options('advanced/images')
		)
	),

	'apistab' => array(
		'title' => __('API\'s', 'creatus'),
		'type' => 'tab',
		'lazy_tabs'=> false,
		'options' => array(
			fw()->theme->get_options('advanced/apis')
		)
	),
	
	'optimizationtab' => array(
		'title' => __('Optimization', 'creatus'),
		'type' => 'tab',
		'lazy_tabs'=> false,
		'options' => array(
			fw()->theme->get_options( 'advanced/optimization')
		)
	),
	
	thz_theme()->get_options( 'advanced/cookies_consent_tab'),
	
	'customizertab' => array(
		'title' => __('Customizer', 'creatus'),
		'type' => 'tab',
		'lazy_tabs'=> false,
		'options' => array(
			fw()->theme->get_options( 'advanced/customizer')
		)
	),
);

$is_customizer = isset($forcustomzier) ? $forcustomzier : false;

if( $is_customizer ){
	
	unset($options['imagestab'],$options['optimizationtab'],$options['customizertab']);
}