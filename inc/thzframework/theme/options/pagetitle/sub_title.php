<?php
if (!defined('FW'))
	die('Forbidden');

$options = array(
	'pt_show_subtitle' => array(
		'type' => 'multi-picker',
		'label' => false,
		'desc' => false,
		'show_borders' => true,
		'picker' => array(
			'picked' => array(
				'label' => __('Show subtitle', 'creatus'),
				'desc' => esc_html__('Show/hide subtitle', 'creatus'),
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
		'choices' => array(
			'show' => array(
				'text' => array(
					'type' => 'text',
					'label' => __('Subtitle text', 'creatus'),
					'desc' => esc_html__('Add subtitle text', 'creatus'),
					'value' => ''
				),
				'location' => array(
					'label' => __('Subtitle location', 'creatus'),
					'desc' => esc_html__('Set subtitle location', 'creatus'),
					'type' => 'switch',
					'right-choice' => array(
						'value' => 'under',
						'label' => __('Under the title', 'creatus')
					),
					'left-choice' => array(
						'value' => 'above',
						'label' => __('Above the title', 'creatus')
					),
					'value' => 'above'
				),
				'font' => array(
					'type' => 'thz-typography',
					'label' => __('Subtitle font', 'creatus'),
					'desc' => esc_html__('Subtitle font metrics', 'creatus'),
					'value' => array(
						'size' => 18,
					),
					'disable' => array('hovered','align'),
				),
				'margin' => array(
					'type' => 'thz-box-style',
					'label' => __('Subtitle margin', 'creatus'),
					'desc' => esc_html__('Set subtitle margin', 'creatus'),
					'disable' => array('layout','padding','borders','borderradius','boxsize','transform','boxshadow','background'),
					'value' => array(
						'margin' => array(
							'top' => 0,
							'right' => 0,
							'bottom' => 0,
							'left' => 0
						),
					)
				)
			)
		)
	)

);