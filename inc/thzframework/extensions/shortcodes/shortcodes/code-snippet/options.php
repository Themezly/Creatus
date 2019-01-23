<?php
if (!defined('FW')) {
	die('Forbidden');
}
$options = array(
	'codetab' => array(
		'title' => __('Code', 'creatus'),
		'type' => 'tab',
		'options' => array(
			'id' => array(
				'type' => 'unique',
				'length' => 8
			),
			'code' => array(
				'type' => 'thz-ace',
				'label' => __('Code snippet', 'creatus'),
				'desc' => esc_html__('Insert your code snippet', 'creatus'),
				'value' => '',
				'mode' => 'html',
				'theme' => 'chrome',
				'height' => 300,
				'width' => '100%'
			)
		)
	),
	'layouttab' => array(
		'title' => __('Layout', 'creatus'),
		'type' => 'tab',
		'options' => array(
			'style' => array(
				'label' => __('Style', 'creatus'),
				'desc' => esc_html__('Select code snippet style', 'creatus'),
				'type' => 'switch',
				'right-choice' => array(
					'value' => 'dark',
					'label' => __('Dark', 'creatus')
				),
				'left-choice' => array(
					'value' => 'light',
					'label' => __('Light', 'creatus')
				),
				'value' => 'light'
			),
			
			'bs' => array(
				'type' => 'thz-box-style',
				'label' => __('Container margin', 'creatus'),
				'preview' => false,
				'popup' => false,
				'desc' => esc_html__('Adjust .thz-code-snippet container margin', 'creatus'),
				'disable' => array('layout','padding','borders','borderradius','boxsize','transform','boxshadow','background'),
				'units' => array(
					'borderradius',
					'boxsize',
					'padding',
					'margin',
				),
				'value' => array()
			),
			
			'height' => array(
				'label' => __('Limit height', 'creatus'),
				'desc' => esc_html__('Limit code snippet height and make its content scrollable', 'creatus'),
				'type' => 'switch',
				'right-choice' => array(
					'value' => 'donotlimit',
					'label' => __('Do not limit', 'creatus')
				),
				'left-choice' => array(
					'value' => 'limit',
					'label' => __('Limit', 'creatus')
				),
				'value' => 'limit'
			),
			'highlight' => array(
				'type' => 'multi-picker',
				'label' => false,
				'desc' => false,
				'picker' => array(
					'picked' => array(
						'label' => __('Syntax highlighting', 'creatus'),
						'desc' => esc_html__('Activate/deactivate syntax highlighting', 'creatus'),
						'type' => 'switch',
						'right-choice' => array(
							'value' => 'inactive',
							'label' => __('Inactive', 'creatus')
						),
						'left-choice' => array(
							'value' => 'active',
							'label' => __('Active', 'creatus')
						),
						'value' => 'inactive'
					)
				),
				'choices' => array(
					'active' => array(
						'linenums' => array(
							'label' => __('Line numbers', 'creatus'),
							'desc' => esc_html__('Show hide code line numbers', 'creatus'),
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
					)
				)
			),
			
			'cmx' => _thz_container_metrics_defaults()
		),
		
	),
	'progresseffects' => array(
		'title' => __('Effects', 'creatus'),
		'type' => 'tab',
		'options' => array(
			'animate' => array(
				'type' => 'thz-animation',
				'label' => false,
				'value' => array(
					'animate' => 'inactive',
					'effect' => 'thz-anim-fadeIn',
					'duration' => 400,
					'delay' => 0
				)
			),
			'cpx' => _thz_container_parallax_default()
		)
	)
);