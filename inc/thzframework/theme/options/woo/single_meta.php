<?php
if (!defined('FW')) {
	die('Forbidden');
}
$options = array(
	'woopmc' => array(
		'type' => 'thz-box-style',
		'label' => __('Meta container box style', 'creatus'),
		'desc' => esc_html__('Adjust .thz-product-meta-container box style', 'creatus'),
		'preview' => true,
		'button-text' => esc_html__('Customize project meta container box style', 'creatus'),
		'popup' => true,
		'disable' => array(
			'layout',
			'video',
			'transform',
			'boxsize'
		),
		'value' => array(
			'padding' => array(
				'top' => 30,
				'right' => 0,
				'bottom' =>0,
				'left' => 0
			),
			'margin' => array(
				'top' => 30,
				'right' => 'auto',
				'bottom' => 0,
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
			),
		)
	),
	'woopmbs' => array(
		'type' => 'thz-box-style',
		'label' => __('Meta box style', 'creatus'),
		'desc' => esc_html__('Adjust .thz-product-meta box style', 'creatus'),
		'preview' => true,
		'button-text' => esc_html__('Customize project meta box style', 'creatus'),
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
		)
	),
	'woometa_label_width' => array(
		'type' => 'thz-spinner',
		'label' => __('Meta label width', 'creatus'),
		'desc' => esc_html__('Set product meta label width', 'creatus'),
		'addon' => '%',
		'min' => 0,
		'max' => 100,
		'value' => 30
	),
	'woometa_label_metrics' => array(
		'type' => 'thz-typography',
		'label' => __('Meta label font metrics', 'creatus'),
		'desc' => esc_html__('Adjust product meta label font metrics.', 'creatus'),
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
	'woometa_metrics' => array(
		'type' => 'thz-typography',
		'label' => __('Meta font metrics', 'creatus'),
		'desc' => esc_html__('Adjust product meta font metrics.', 'creatus'),
		'value' => array(),
		'disable' => array(
			'hovered',
			'align',
			'text-shadow'
		),
	),
	'woometa_colors' => array(
		'type' => 'thz-multi-options',
		'label' => __('Meta colors', 'creatus'),
		'desc' => esc_html__('Adjust product meta colors. Theme colors are inherited if empty', 'creatus'),
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