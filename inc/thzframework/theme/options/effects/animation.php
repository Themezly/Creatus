<?php if ( ! defined( 'FW' ) ) die( 'Forbidden' );


$options = array(
	'an' => array(
		'type' => 'addable-popup',
		'value' => array(),
		'label' => __('Animation', 'creatus'),
		'desc' => esc_html__('Add animation', 'creatus'),
		'template' => '<b>' . esc_html__('Animation is active', 'creatus') . '</b>',
		'popup-title' => esc_html__('Animation settings', 'creatus'),
		'size' => 'small',
		'add-button-text' => esc_html__('Click to add animation', 'creatus'),
		'help' => esc_html__('This option adds animation effect to the HTML container.', 'creatus'),
		'sortable' => false,
		'limit' => 1,
		'popup-options' => array(
			'effect' => array(
				'type' => 'select',
				'label' => __('Effect', 'creatus'),
				'desc' => esc_html__('Select the animation effect.', 'creatus'),
				'choices' => _thz_animations_list()
			),
			'duration' => array(
				'type' => 'thz-spinner',
				'value' => 700,
				'label' => __('Duration', 'creatus'),
				'desc' => esc_html__('Set duration in milliseconds. 1000ms = 1s', 'creatus'),
				'addon' => 'ms',
				'min' => 0,
				'max' => 2000,
				'step' => 100
			),
			'delay' => array(
				'type' => 'thz-spinner',
				'value' => 0,
				'label' => __('Delay', 'creatus'),
				'desc' => esc_html__('Set delay in milliseconds. 1000ms = 1s', 'creatus'),
				'addon' => 'ms',
				'min' => 0,
				'max' => 10000,
				'step' => 100
			)
		)
	)
);