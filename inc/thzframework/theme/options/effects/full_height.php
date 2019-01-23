<?php if ( ! defined( 'FW' ) ) die( 'Forbidden' );


$options = array(
	'fh' => array(
		'type' => 'addable-popup',
		'value' => array(),
		'label' => __('Full height', 'creatus'),
		'desc' => esc_html__('Add full height effect', 'creatus'),
		'template' => '<b>' . esc_html__('Full height is active', 'creatus') . '</b>',
		'popup-title' => esc_html__('Full height settings', 'creatus'),
		'help' => esc_html__('This option adds full height ( viewport  height ) to the HTML container.', 'creatus'),
		'size' => 'small',
		'add-button-text' => esc_html__('Click to add full height effect', 'creatus'),
		'sortable' => false,
		'limit' => 1,
		'popup-options' => array(
			'height' => array(
				'type' => 'thz-spinner',
				'label' => __('Viewport height', 'creatus'),
				'addon' => '%',
				'min' => 0,
				'max' => 100,
				'value' => '100',
				'desc' => esc_html__('Set the viewport height percentage to inherit.', 'creatus')
			),
			'contentalign' => array(
				'type' => 'short-select',
				'value' => 'thz-va-middle',
				'label' => __('Content v-align','creatus'),
				'desc' => esc_html__('Set the container content vertical alignment.', 'creatus'),
				'choices' => array(
					'thz-va-top' => esc_html__('Top', 'creatus'),
					'thz-va-middle' => esc_html__('Middle', 'creatus'),
					'thz-va-bottom' => esc_html__('Bottom', 'creatus'),
					'thz-va-baseline' => esc_html__('Do not align', 'creatus')
				)
			)
		)
	)
);