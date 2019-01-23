<?php
if (!defined('FW'))
	die('Forbidden');
$options = array(
	'pr_title' => array(
		'type' => 'multi-picker',
		'label' => false,
		'desc' => false,
		'picker' => array(
			'picked' => array(
				'label' => __('Show title', 'creatus'),
				'desc' => esc_html__('Show/hide related item title', 'creatus'),
				'type' => 'switch',
				'right-choice' => array(
					'value' => 'hide',
					'label' => __('Hide', 'creatus')
				),
				'left-choice' => array(
					'value' => 'show',
					'label' => __('Show', 'creatus')
				),
				'value' => 'show'
			)
		),
		'show_borders' => true,
		'choices' => array(
			'show' => array(
				'bs' => array(
					'type' => 'thz-box-style',
					'label' => __('Related title box style', 'creatus'),
					'preview' => true,
					'button-text' => esc_html__('Customize related title box style', 'creatus'),
					'desc' => esc_html__('Adjust .thz-related-item-title box style','creatus'),
					'popup' => true,
					'disable' => array('video'),
					'value' => array()
				),
				'font' => array(
					'type' => 'thz-typography',
					'label' => __('Related title font', 'creatus'),
					'desc' => esc_html__('Adjust related item title metrics.', 'creatus'),
					'value' => array(
						'size' => 16,
					),
				)
			)
		)
	)
);