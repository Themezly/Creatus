<?php
if (!defined('FW')) {
	die('Forbidden');
}
$options = array(
	'prr_intro' => array(
		'type' => 'multi-picker',
		'label' => false,
		'desc' => false,
		'picker' => array(
			'picked' => array(
				'label' => __('Show intro text', 'creatus'),
				'desc' => esc_html__('Show/hide related item intro text (excerpt)', 'creatus'),
				'type' => 'switch',
				'right-choice' => array(
					'value' => 'hide',
					'label' => __('Hide', 'creatus')
				),
				'left-choice' => array(
					'value' => 'show',
					'label' => __('Show', 'creatus')
				),
				'value' => 'hide'
			)
		),
		'show_borders' => true,
		'choices' => array(
			'show' => array(
				'intro_length' => array(
					'type' => 'multi-picker',
					'label' => false,
					'desc' => false,
					'picker' => array(
						'picked' => array(
							'label' => __('Intro length limit', 'creatus'),
							'desc' => esc_html__('Set excerpt length limit', 'creatus'),
							'type' => 'short-select',
							'value' => 'chars',
							'choices' => array(
								'words' => esc_html__('Limit by number of words', 'creatus'),
								'chars' => esc_html__('Limit by number of characters', 'creatus')
							)
						)
					),
					'choices' => array(
						'words' => array(
							'limit' => array(
								'type' => 'thz-spinner',
								'label' => __('Number of words', 'creatus'),
								'desc' => esc_html__('Set number of words to show', 'creatus'),
								'addon' => '#',
								'min' => 0,
								'max' => 200,
								'value' => 10
							)
						),
						'chars' => array(
							'limit' => array(
								'type' => 'thz-spinner',
								'label' => __('Number of characters', 'creatus'),
								'desc' => esc_html__('Set number of characters to show', 'creatus'),
								'addon' => '#',
								'min' => 0,
								'max' => 500,
								'value' => 75
							)
						)
					)
				),
				'bs' => array(
					'type' => 'thz-box-style',
					'label' => __('Intro box style', 'creatus'),
					'preview' => true,
					'button-text' => esc_html__('Customize intro text box style', 'creatus'),
					'desc' => esc_html__('Adjust .thz-related-intro-text box style','creatus'),
					'popup' => true,
					'disable' => array('video'),
					'value' => array()
				),
				'font' => array(
					'type' => 'thz-typography',
					'label' => __('Intro font', 'creatus'),
					'desc' => esc_html__('Adjust related item intro text metrics.', 'creatus'),
					'value' => array(),
					'disable' => array('hovered','text-shadow'),
				),
			)
		)
	)
);