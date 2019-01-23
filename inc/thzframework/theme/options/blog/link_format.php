<?php
if (!defined('FW')) {
	die('Forbidden');
}
$options = array(
	'link_title_metrics' => array(
		'type' => 'thz-typography',
		'label' => __('Link title font', 'creatus'),
		'desc' => esc_html__('Adjust link title font.', 'creatus'),
		'value' => array(
			'size' => 20,
			'align' => 'center',
		),
		'disable' => array('color','hovered'),
	),
	'link_url_metrics' => array(
		'type' => 'thz-typography',
		'label' => __('Link url font', 'creatus'),
		'desc' => esc_html__('Adjust url link font.', 'creatus'),
		'value' => array(
			'size' => 16,
			'align' => 'center',
		),
		'disable' => array('color','hovered'),
	),
	'link_format_colors' => array(
		'type' => 'thz-multi-options',
		'label' => __('Link colors', 'creatus'),
		'desc' => esc_html__('Adjust link post format colors. If empty, theme defaults are used.', 'creatus'),
		'value' => array(
			'bg' => 'color_5',
			'tc' => 'color_2',
			'uc' => 'color_3',
			'bgh' => '#313131',
			'tch' => '#ffffff',
			'uch' => 'rgba(255,255,255,0.7)'
		),
		'thz_options' => array(
			'bg' => array(
				'type' => 'color',
				'title' => esc_html__('Background', 'creatus'),
				'box' => true
			),
			'tc' => array(
				'type' => 'color',
				'title' => esc_html__('Title', 'creatus'),
				'box' => true
			),
			'uc' => array(
				'type' => 'color',
				'title' => esc_html__('Url', 'creatus'),
				'box' => true
			),
			'bgh' => array(
				'type' => 'color',
				'title' => esc_html__('Background hovered', 'creatus'),
				'box' => true
			),
			'tch' => array(
				'type' => 'color',
				'title' => esc_html__('Title hovered', 'creatus'),
				'box' => true
			),
			'uch' => array(
				'type' => 'color',
				'title' => esc_html__('Url hovered', 'creatus'),
				'box' => true
			)
		)
	)
);