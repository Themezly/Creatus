<?php
if (!defined('FW')) {
	die('Forbidden');
}
$options = array(
	'ppt' => array(
		'type' => 'multi-picker',
		'label' => false,
		'desc' => false,
		'show_borders' => true,
		'picker' => array(
			'picked' => array(
				'label' => __('Show project title', 'creatus'),
				'desc' => esc_html__('Show/hide project title', 'creatus'),
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
		'choices' => array(
			'show' => array(
				'bs' => array(
					'type' => 'thz-box-style',
					'label' => __('Project title box style', 'creatus'),
					'preview' => true,
					'button-text' => esc_html__('Customize project title box style', 'creatus'),
					'desc' => esc_html__('Adjust .thz-project-title box style', 'creatus'),
					'popup' => true,
					'disable' => array('layout','video','boxsize','transform'),
					'value' => array(
						'margin' => array(
							'top' => '0',
							'right' => 'auto',
							'bottom' => '10',
							'left' => 'auto'
						),
					)
				),
				'tm' => array(
					'type' => 'thz-typography',
					'label' => __('Project title metrics', 'creatus'),
					'desc' => esc_html__('Adjust project title metrics.', 'creatus'),
					'value' => array(
						'size' => 28,
					),
					'disable' => array('color','hovered'),
				),
				'c' => array(
					'type' => 'thz-multi-options',
					'label' => __('Project title colors', 'creatus'),
					'desc' => esc_html__('Adjust project title colors. Theme links colors are inherited if empty', 'creatus'),
					'value' => array(
						'co' => '',
						'hc' => ''
					),
					'thz_options' => array(
						'co' => array(
							'type' => 'color',
							'title' => esc_html__('Color', 'creatus'),
							'box' => true
						),
						'hc' => array(
							'type' => 'color',
							'title' => esc_html__('Hovered Color', 'creatus'),
							'box' => true
						)
					)
				)
			)
		)
	)
);