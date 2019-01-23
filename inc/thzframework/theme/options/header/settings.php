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
	thz_theme()->get_options('header/sticky_tab'),
	thz_theme()->get_options('header/brightness_tab'),
	'toolbartab' => array(
		'title' => __('Toolbar', 'creatus'),
		'type' => 'tab',
		'lazy_tabs'=> false,
		'li-attr' => array(
			'class' => 'thz-heto-tab'
		),
		'options' => array(
			fw()->theme->get_options( 'header/toolbar')
		)
	)
);