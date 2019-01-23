<?php
if (!defined('FW'))
	die('Forbidden');
$options = array(
	'ev_ag_bs' => array(
		'type' => 'thz-box-style',
		'label' => __('Agenda box style', 'creatus'),
		'preview' => false,
		'button-text' => esc_html__('Adjust agenda box style', 'creatus'),
		'desc' => esc_html__('Adjust .thz-event-agenda-container box style', 'creatus'),
		'popup' => true,
		'disable' => array(
			'layout',
			'video',
			'transform',
			'boxsize',
		),
		'value' => array(
			'padding' => array(
				'top' => '0',
				'right' => '0',
				'bottom' => '0',
				'left' => '0'
			),
			'margin' => array(
				'top' => 30,
				'right' => 'auto',
				'bottom' => 0,
				'left' => 'auto'
			)
		)
	),
	'ev_agi_bs' => array(
		'type' => 'thz-box-style',
		'label' => __('Agenda item box style', 'creatus'),
		'preview' => true,
		'desc' => esc_html__('Adjust .thz-event-agenda-item box style', 'creatus'),
		'button-text' => esc_html__('Adjust agenda item box style', 'creatus'),
		'popup' => true,
		'disable' => array(
			'layout',
			'video',
			'transform',
			'boxsize'
		),
		'value' => array(
			'padding' => array(
				'top' => 15,
				'right' => 0,
				'bottom' => '30',
				'left' => 0
			),
			'margin' => array(
				'top' => '0',
				'right' => 'auto',
				'bottom' => '0',
				'left' => 'auto'
			),
			'borders' => array(
				'all' => 'separate',
				'top' => array(
					'w' => 1,
					's' => 'solid',
					'c' => 'color_4'
				),
				'right' => array(
					'w' => 0,
					's' => 'solid',
					'c' => ''
				),
				'bottom' => array(
					'w' => 0,
					's' => 'solid',
					'c' => ''
				),
				'left' => array(
					'w' => 0,
					's' => 'solid',
					'c' => ''
				)
			)
		)
	),
	'ev_aitf' => array(
		'type' => 'thz-typography',
		'label' => __('Agenda item time', 'creatus'),
		'desc' => esc_html__('Adjust agenda time font metrics.', 'creatus'),
		'value' => array(
			'size' => 14,
			'weight' => 600,
			'color' => 'color_2'

		),
		'disable' => array(
			'hovered',
			'align'
		),
	),
	'ev_aitif' => array(
		'type' => 'thz-typography',
		'label' => __('Agenda item title', 'creatus'),
		'desc' => esc_html__('Adjust agenda item title font metrics.', 'creatus'),
		'value' => array(
			'size' => 16,
			'weight' => 600,
			'color' => 'color_2'
		),
		'disable' => array(
			'hovered',
			'align'
		),
	),
	'ev_aitef' => array(
		'type' => 'thz-typography',
		'label' => __('Agenda item text', 'creatus'),
		'desc' => esc_html__('Adjust agenda item text font metrics.', 'creatus'),
		'value' => array(),
		'disable' => array(
			'hovered',
			'align',
			'text-shadow'
		),
	),
	'ev_aitec' => array(
		'type' => 'thz-multi-options',
		'label' => __('Agenda item text colors', 'creatus'),
		'desc' => esc_html__('Adjust agenda item text colors. Theme colors are used if empty.', 'creatus'),
		'value' => array(
			'link' => '',
			'linkhovered' => '',
			'headings' => ''
		),
		'thz_options' => array(
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