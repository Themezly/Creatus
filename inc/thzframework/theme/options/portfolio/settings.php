<?php
if (!defined('FW'))
	die('Forbidden');
	
$options = array(
	'portfoliooptionsgroup' => array(
		'type' => 'group',
		'options' => array(
			'portfoliogeneraltab' => array(
				'title' => __('General', 'creatus'),
				'type' => 'tab',
				'options' => fw()->theme->get_options('portfolio/general')
			),

			'portfoliostylestab' => array(
				'title' => __('Projects style', 'creatus'),
				'type' => 'tab',
				'options' => fw()->theme->get_options('portfolio/projects_style')
			)
		)
	)
);