<?php
if (!defined('FW'))
	die('Forbidden');
$options = array(
	'ev_cbs' => array(
		'type' => 'thz-box-style',
		'label' => __('Event content box style', 'creatus'),
		'desc' => esc_html__('Adjust .thz-event-content box style', 'creatus'),
		'preview' => true,
		'button-text' => esc_html__('Customize event content box style', 'creatus'),
		'popup' => true,
		'disable' => array(
			'layout',
			'video',
			'transform',
			'boxsize'
		),
		'value' => array(
			'margin' => array(
				'top' => '0',
				'right' => 'auto',
				'bottom' => 60,
				'left' => 'auto'
			)
		)
	),
	'ev_cc' => array(
		'type' => 'thz-multi-options',
		'label' => __('Event content colors', 'creatus'),
		'desc' => esc_html__('Adjust event content colors. Theme colors are used if empty.', 'creatus'),
		'value' => array(
			'text' => '',
			'link' => '',
			'linkhovered' => '',
			'headings' => ''
		),
		'thz_options' => array(
			'text' => array(
				'type' => 'color',
				'title' => esc_html__('Text', 'creatus'),
				'box' => true
			),
			'link' => array(
				'type' => 'color',
				'title' => esc_html__('Link', 'creatus'),
				'box' => true
			),
			'linkhovered' => array(
				'type' => 'color',
				'title' => esc_html__('Link Hovered', 'creatus'),
				'box' => true
			),
			'headings' => array(
				'type' => 'color',
				'title' => esc_html__('Headings', 'creatus'),
				'box' => true
			)
		)
	)	
);