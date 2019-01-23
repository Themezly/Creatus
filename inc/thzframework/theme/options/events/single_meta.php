<?php
if (!defined('FW'))
	die('Forbidden');
$options = array(
	'ev_inbs' => array(
		'type' => 'thz-box-style',
		'label' => __('Meta container box style', 'creatus'),
		'preview' => true,
		'button-text' => esc_html__('Customize meta container box style', 'creatus'),
		'desc' => esc_html__('Adjust .thz-event-info-in box style', 'creatus'),
		'popup' => true,
		'disable' => array(
			'layout',
			'video',
		),
		'value' => array(
		
			'padding' => array(
				'top' => 30,
				'right' => 30,
				'bottom' => 30,
				'left' => 30
			),
			'background' => array(
				'type' => 'color',
				'color' => 'color_5',
			)
		
		)
	),	
	
	'ev_mbs' => array(
		'type' => 'thz-box-style',
		'label' => __('Meta block box style', 'creatus'),
		'preview' => true,
		'button-text' => esc_html__('Customize meta block box style', 'creatus'),
		'desc' => esc_html__('Adjust .thz-event-meta-block box style', 'creatus'),
		'popup' => true,
		'disable' => array(
			'layout',
			'video',
			'borders',
			'transform',
			'boxsize'
		),
		'value' => array(
			'margin' => array(
				'top' => '0',
				'right' => 'auto',
				'bottom' => 30,
				'left' => 'auto'
			)
		)
	),
	'ev_mibs' => array(
		'type' => 'thz-box-style',
		'label' => __('Meta item box style', 'creatus'),
		'preview' => true,
		'button-text' => esc_html__('Customize event meta item box style', 'creatus'),
		'desc' => esc_html__('Adjust .thz-event-meta-block li box style', 'creatus'),
		'popup' => true,
		'disable' => array(
			'layout',
			'video',
			'transform',
			'boxsize'
		),
		'value' => array(
			'padding' => array(
				'top' => 0,
				'right' => 0,
				'bottom' => 15,
				'left' => 0
			),
			'margin' => array(
				'top' => 0,
				'right' => 'auto',
				'bottom' => 15,
				'left' => 'auto'
			),
			'borders' => array(
				'all' => 'separate',
				'top' => array(
					'w' => 0,
					's' => 'solid',
					'c' => ''
				),
				'right' => array(
					'w' => 0,
					's' => 'solid',
					'c' => ''
				),
				'bottom' => array(
					'w' => 1,
					's' => 'solid',
					'c' => 'color_4'
				),
				'left' => array(
					'w' => 0,
					's' => 'solid',
					'c' => ''
				)
			)
		)
	),
	'ev_mlw' => array(
		'type' => 'thz-spinner',
		'label' => __('Meta label width', 'creatus'),
		'desc' => esc_html__('Set event meta label width', 'creatus'),
		'addon' => '%',
		'min' => 0,
		'max' => 100,
		'value' => 30
	),
	'ev_mlf' => array(
		'type' => 'thz-typography',
		'label' => __('Meta label font metrics', 'creatus'),
		'desc' => esc_html__('Adjust event meta label font metrics.', 'creatus'),
		'value' => array(
			'size' => 14,
			'weight' => 600,
			'color' => 'color_2'

		),
		'disable' => array(
			'hovered',
			'align',
			'text-shadow'
		),
	),
	'ev_mf' => array(
		'type' => 'thz-typography',
		'label' => __('Meta font metrics', 'creatus'),
		'desc' => esc_html__('Adjust event meta font metrics.', 'creatus'),
		'value' => array(),
		'disable' => array(
			'color',
			'hovered',
			'align',
			'text-shadow'
		),
	),
	'ev_mfc' => array(
		'type' => 'thz-multi-options',
		'label' => __('Meta item colors', 'creatus'),
		'desc' => esc_html__('Adjust event meta colors. Theme colors are inherited if empty', 'creatus'),
		'value' => array(
			'co' => '',
			'lc' => '',
			'hc' => ''
		),
		'thz_options' => array(
			'co' => array(
				'type' => 'color',
				'title' => esc_html__('Text', 'creatus'),
				'box' => true
			),
			'lc' => array(
				'type' => 'color',
				'title' => esc_html__('Link', 'creatus'),
				'box' => true
			),
			'hc' => array(
				'type' => 'color',
				'title' => esc_html__('Link Hovered', 'creatus'),
				'box' => true
			)
		)
	)	
);