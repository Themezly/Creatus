<?php
if (!defined('FW')) {
	die('Forbidden');
}
$options = array(
	'ppm' => array(
		'type' => 'multi-picker',
		'label' => false,
		'desc' => false,
		'show_borders' => true,
		'picker' => array(
			'picked' => array(
				'label' => __('Show project media', 'creatus'),
				'desc' => esc_html__('Show/hide project media', 'creatus'),
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
					'label' => __('Project media box style', 'creatus'),
					'preview' => true,
					'button-text' => esc_html__('Customize project media box style', 'creatus'),
					'desc' => esc_html__('Adjust .thz-project-media box style', 'creatus'),
					'popup' => true,
					'disable' => array('video'),
					'value' => array(
						'margin' => array(
							'top' => '0',
							'right' => 'auto',
							'bottom' => 60,
							'left' => 'auto'
						),
					)
				),
				'lay' => array(
					'type' => 'thz-multi-options',
					'label' => __('Media slider layout', 'creatus'),
					'desc' => esc_html__('Adjust media slider layout', 'creatus'),
					'value' => array(
						'show' => '1',
						'scroll' => '1',
						'space' => '0',
						'dots' => 'inside',
						'arrows' => 'show'
					),
					'thz_options' => array(
						'show' => array(
							'type' => 'select',
							'title' => esc_html__('Slides to show', 'creatus'),
							'choices' => array(
								'1' => esc_html__('1', 'creatus'),
								'2' => esc_html__('2', 'creatus'),
								'3' => esc_html__('3', 'creatus'),
								'4' => esc_html__('4', 'creatus'),
								'5' => esc_html__('5', 'creatus'),
								'6' => esc_html__('6', 'creatus')
							)
						),
						'scroll' => array(
							'type' => 'select',
							'title' => esc_html__('Slides to scroll', 'creatus'),
							'choices' => array(
								'1' => esc_html__('1', 'creatus'),
								'2' => esc_html__('2', 'creatus'),
								'3' => esc_html__('3', 'creatus'),
								'4' => esc_html__('4', 'creatus'),
								'5' => esc_html__('5', 'creatus'),
								'6' => esc_html__('6', 'creatus')
							)
						),
						'space' => array(
							'type' => 'spinner',
							'title' => esc_html__('Slides space', 'creatus'),
							'addon' => 'px',
							'min' => 0,
						),
						'dots' => array(
							'type' => 'short-select',
							'title' => esc_html__('Dots location', 'creatus'),
							'choices' => array(
								'hide' => esc_html__('Hide', 'creatus'),
								'inside' => esc_html__('Inside', 'creatus'),
								'outside' => esc_html__('Outside', 'creatus')
							)
						),
						'arrows' => array(
							'type' => 'short-select',
							'title' => esc_html__('Arrows', 'creatus'),
							'choices' => array(
								'hide' => esc_html__('Hide', 'creatus'),
								'show' => esc_html__('Show', 'creatus'),
							)
						)
					)
				),
				'sa' => array(
					'type' => 'thz-multi-options',
					'label' => __('Media slider animation', 'creatus'),
					'desc' => esc_html__('Adjust posts slider. Hover over help icon for more info.', 'creatus'),
					'help' => esc_html__('Speed: Slide animation speed<br />Auto slide: If set to Yes, slider will start on page load<br />Auto time: Time till next slide transition<br />Infinite: If set to Yes, slides will loop infinitely<br />1000ms = 1s', 'creatus'),
					'value' => array(
						'speed' => 300,
						'autoplay' => 0,
						'autoplayspeed' => 3000,
						'infinite' => 1
					),
					'thz_options' => array(
						'speed' => array(
							'type' => 'spinner',
							'title' => esc_html__('Speed', 'creatus'),
							'addon' => 'ms',
							'min' => 0,
							'step' => 50,
							'max' => 1500
						),
						'autoplay' => array(
							'type' => 'select',
							'title' => esc_html__('Auto slide', 'creatus'),
							'choices' => array(
								0 => esc_html__('No', 'creatus'),
								1 => esc_html__('Yes', 'creatus')
							)
						),
						'autoplayspeed' => array(
							'type' => 'spinner',
							'title' => esc_html__('Auto time', 'creatus'),
							'addon' => 'ms',
							'min' => 0,
							'step' => 50,
							'max' => 10000
						),
						'infinite' => array(
							'type' => 'select',
							'title' => esc_html__('Infinite', 'creatus'),
							'choices' => array(
								0 => esc_html__('No', 'creatus'),
								1 => esc_html__('Yes', 'creatus')
							)
						)
					)
				),
				'mi' => array(
					'type' => 'multi-picker',
					'label' => false,
					'desc' => false,
					'show_borders' => true,
					'picker' => array(
						'picked' => array(
							'label' => __('Show overlay icon', 'creatus'),
							'desc' => esc_html__('Show/hide overlay icon', 'creatus'),
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
							'icon' => array(
								'type' => 'thz-icon',
								'value' => 'thzicon thzicon-plus',
								'label' => __('Overlay icon', 'creatus'),
								'desc' => esc_html__('Set overlay icon. Shown only if icon selected.', 'creatus')
							),
							'icon_metrics' => array(
								'type' => 'thz-multi-options',
								'label' => __('Icon metrics', 'creatus'),
								'desc' => esc_html__('Adjust icon metrics', 'creatus'),
								'value' => array(
									'pa' => 10,
									'fs' => 16,
									'co' => '#ffffff'
								),
								'thz_options' => array(
									'pa' => array(
										'type' => 'spinner',
										'title' => esc_html__('Padding', 'creatus'),
										'addon' => 'px',
										'min' => 0,
										'max' => 100
									),
									'fs' => array(
										'type' => 'spinner',
										'title' => esc_html__('Icon size', 'creatus'),
										'addon' => 'px',
										'min' => 0,
										'max' => 100
									),
									'co' => array(
										'type' => 'color',
										'title' => esc_html__('Icon color', 'creatus'),
										'box' => true
									)
								)
							),
							'iconbg_metrics' => array(
								'type' => 'thz-multi-options',
								'label' => __('Shape metrics', 'creatus'),
								'desc' => esc_html__('Adjust icon background shape metrics', 'creatus'),
								'value' => array(
									'sh' => 'square',
									'bg' => '',
									'bs' => 'solid',
									'bsi' => 0,
									'bc' => ''
								),
								'thz_options' => array(
									'sh' => array(
										'type' => 'short-select',
										'title' => esc_html__('Type', 'creatus'),
										'choices' => array(
											'circle' => esc_html__('Circle', 'creatus'),
											'square' => esc_html__('Square', 'creatus'),
											'rounded' => esc_html__('Rounded', 'creatus')
										)
									),
									'bg' => array(
										'type' => 'color',
										'title' => esc_html__('Background', 'creatus'),
										'box' => true
									),
									'bs' => array(
										'type' => 'short-select',
										'title' => esc_html__('Border style', 'creatus'),
										'choices' => array(
											'solid' => esc_html__('Solid', 'creatus'),
											'dashed' => esc_html__('Dashed', 'creatus'),
											'dotted' => esc_html__('Dotted', 'creatus')
										)
									),
									'bsi' => array(
										'type' => 'spinner',
										'title' => esc_html__('Border size', 'creatus'),
										'addon' => 'px',
										'min' => 0,
										'max' => 100
									),
									'bc' => array(
										'type' => 'color',
										'title' => esc_html__('Border color', 'creatus'),
										'box' => true
									)
								)
							)
						)
					)
				)
			)
		)
	)
);