<?php
if (!defined('FW')) {
	die('Forbidden');
}

if ( !fw_ext( 'portfolio' ) ) {
	$options = array();
	return;
}

$options = array(
	'portfoliooptionstab' => array(
		'title' => __('Portfolio', 'creatus'),
		'type' => 'tab',
		'options' => array(
			'portfolioprojectstab' => array(
				'title' => __('Portfolio projects', 'creatus'),
				'type' => 'tab',
				'options' => array(
					fw()->theme->get_options('portfolio/settings')
				)
			),
			'projectssingletab' => array(
				'title' => __('Single project', 'creatus'),
				'type' => 'tab',
				'options' => array(
					fw()->theme->get_options('portfolio/single')
				)
			)
		)
	)
);