<?php
if (!defined('FW')) {
	die('Forbidden');
}
$options = array(
	'audio_format_colors' => array(
		'type' => 'thz-multi-options',
		'label' => __('Audio colors', 'creatus'),
		'desc' => esc_html__('Adjust audio post format colors. If empty, theme defaults are used.', 'creatus'),
		'value' => array(
			'bg' => 'color_5',
			'controlls' => 'color_3',
			'current' => '#313131'
		),
		'thz_options' => array(
			'bg' => array(
				'type' => 'color',
				'title' => esc_html__('Background', 'creatus'),
				'box' => true
			),
			'controlls' => array(
				'type' => 'color',
				'title' => esc_html__('Controlls', 'creatus'),
				'box' => true
			),
			'current' => array(
				'type' => 'color',
				'title' => esc_html__('Current', 'creatus'),
				'box' => true
			)
		)
	)
);