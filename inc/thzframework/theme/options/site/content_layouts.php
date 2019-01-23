<?php if ( ! defined( 'FW' ) ) die( 'Forbidden' );
	
$options = array(
	'content_layout' => array(
		'label' => __('Content layouts generator', 'creatus'),
		'type' => 'thz-content-layout',
		'value' => array(
			array(
				'title' => 'All pages',
				'page' => 'all',
				'layout' => 'right',
				'leftblock' => 0,
				'contentblock' => 72.5,
				'rightblock' => 27.5
			)
		)
	)
);