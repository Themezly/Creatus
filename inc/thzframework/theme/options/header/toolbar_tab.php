<?php
if (!defined('FW'))
	die('Forbidden');
	
$options = array(
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