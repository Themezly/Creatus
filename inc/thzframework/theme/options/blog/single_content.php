<?php
if (!defined('FW'))
	die('Forbidden');

$options = array(
	'bprowbs' => array(
		'type' => 'thz-box-style',
		'label' => __('Details row box style', 'creatus'),
		'preview' => true,
		'button-text' => esc_html__('Customize details row box style', 'creatus'),
		'desc' => esc_html__('Adjust .thz-post-details-row box style', 'creatus'),
		'popup' => true,
		'disable' => array('video'),
		'value' => array(),
		'units' => array(
			'borderradius',
			'boxsize',
			'padding',
			'margin',
		),
	),
	'bpcbs' => array(
		'type' => 'thz-box-style',
		'label' => __('Post content box style', 'creatus'),
		'preview' => true,
		'button-text' => esc_html__('Customize post content box style', 'creatus'),
		'popup' => true,
		'disable' => array(
			'layout',
			'video',
			'transform',
			'boxsize'
		),
		'units' => array(
			'borderradius',
			'padding',
			'margin',
		),
		'desc' => esc_html__('Adjust .thz-entry-content box style', 'creatus'),
		'value' => array(
			'margin' => array(
				'top' => 30,
				'right' => 'auto',
				'bottom' => 30,
				'left' => 'auto'
			)
		)
	),
	'bpcc' => array(
		'type' => 'thz-multi-options',
		'label' => __('Post content colors', 'creatus'),
		'desc' => esc_html__('Adjust post content colors. Theme colors are used if empty.', 'creatus'),
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
	),	
);