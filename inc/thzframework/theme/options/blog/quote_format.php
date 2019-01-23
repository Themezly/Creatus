<?php
if (!defined('FW')) {
	die('Forbidden');
}
$options = array(
	'quote_metrics' => array(
		'type' => 'thz-typography',
		'label' => __('Quote font', 'creatus'),
		'desc' => esc_html__('Adjust quote font.', 'creatus'),
		'value' => array(
			'size' => 20,
			'align' => 'center',
		),
		'disable' => array('color','hovered'),
	),
	'quote_author_metrics' => array(
		'type' => 'thz-typography',
		'label' => __('Quote author font', 'creatus'),
		'desc' => esc_html__('Adjust quote author font.', 'creatus'),
		'value' => array(
			'size' => 16,
			'align' => 'center',
		),
		'disable' => array('color','hovered'),
	),
	'quote_format_colors' => array(
		'type' => 'thz-multi-options',
		'label' => __('Quote colors', 'creatus'),
		'desc' => esc_html__('Adjust link post format colors. If empty, theme defaults are used.', 'creatus'),
		'value' => array(
			'bg' => 'color_5',
			'qc' => 'color_2',
			'ac' => 'color_3',
			'bgh' => '#313131',
			'qch' => '#ffffff',
			'ach' => 'rgba(255,255,255,0.7)'
		),
		'thz_options' => array(
			'bg' => array(
				'type' => 'color',
				'title' => esc_html__('Background', 'creatus'),
				'box' => true
			),
			'qc' => array(
				'type' => 'color',
				'title' => esc_html__('Quote', 'creatus'),
				'box' => true
			),
			'ac' => array(
				'type' => 'color',
				'title' => esc_html__('Author', 'creatus'),
				'box' => true
			),
			'bgh' => array(
				'type' => 'color',
				'title' => esc_html__('Background hovered', 'creatus'),
				'box' => true
			),
			'qch' => array(
				'type' => 'color',
				'title' => esc_html__('Quote hovered', 'creatus'),
				'box' => true
			),
			'ach' => array(
				'type' => 'color',
				'title' => esc_html__('Author hovered', 'creatus'),
				'box' => true
			)
		)
	)
);