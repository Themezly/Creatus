<?php
if (!defined('FW')) {
	die('Forbidden');
}
$options = array(
	'defaultstab' => array(
		'title' => __('Defaults', 'creatus'),
		'type' => 'tab',
		'options' => array(
			'id' => array(
				'type' => 'unique',
				'length' => 8
			),
			'divider_type' => array(
				'type' => 'select',
				'value' => 'horizontal',
				'label' => __('Divider Type', 'creatus'),
				'desc' => esc_html__('Select divider type', 'creatus'),
				'attr' => array(
					'class' => 'thz-select-switch'
				),
				'choices' => array(
					'horizontal' => array(
						'text' => esc_html__('Horizontal divider', 'creatus'),
						'attr' => array(
							'data-enable' => '.thz-divider-style-li,horizontal_bs',
							'data-disable' => 'inline_bs'
						)
					),
					'inline' => array(
						'text' => esc_html__('Inline spacer', 'creatus'),
						'attr' => array(
							'data-enable' => 'inline_bs',
							'data-disable' => '.thz-divider-style-li,horizontal_bs'
						)
					)
				)
			),
			'inline_bs' => array(
				'type' => 'thz-box-style',
				'label' => __('Divider box style', 'creatus'),
				'desc' => esc_html__('Set divider box style. You can also add border and height to this divider.', 'creatus'),
				'help' => esc_html__('Inline spacer can quickly be transformed to vertical divider with border. Simply add side border and adjust the height.', 'creatus'),
				'preview' => true,
				'button-text' => esc_html__('Customize divider box style', 'creatus'),
				'popup' => true,
				'disable' => array('video'),
				'units' => array(
					'borderradius',
					'boxsize',
					'padding',
					'margin',
				),
				'value' => array(
					'margin' => array(
						'top' => '0',
						'right' => '15',
						'bottom' => '0',
						'left' => '15'
					),
					'boxsize' => array(
						'width' => '',
						'height' => '14',
						'min-width' => '',
						'min-height' => '',
						'max-width' => '',
						'max-height' => ''
					)
				)
			),
			'horizontal_bs' => array(
				'type' => 'thz-box-style',
				'label' => __('Divider margin', 'creatus'),
				'desc' => esc_html__('Set divider margin', 'creatus'),
				'button-text' => esc_html__('Customize divider margin', 'creatus'),
				'popup' => false,
				'disable' => array('layout','padding','borders','borderradius','boxsize','transform','boxshadow','background'),
				'units' => array(
					'borderradius',
					'boxsize',
					'padding',
					'margin',
				),
				'value' => array(
					'margin' => array(
						'top' => '15',
						'right' => 'auto',
						'bottom' => '15',
						'left' => 'auto'
					)
				)
			),
			
			'cmx' => _thz_container_metrics_defaults()
		)
	),
	'styletab' => array(
		'title' => __('Styling', 'creatus'),
		'type' => 'tab',
		'li-attr' => array(
			'class' => 'thz-divider-style-li'
		),
		'options' => array(
			'style' => array(
				'type' => 'multi-picker',
				'label' => false,
				'desc' => false,
				'show_borders' => true,
				'picker' => array(
					'picked' => array(
						'label' => __('Style', 'creatus'),
						'desc' => esc_html__('Select divider style', 'creatus'),
						'type' => 'short-select',
						'value' => 'none',
						'choices' => array(
							'none' => esc_html__('None', 'creatus'),
							'line' => esc_html__('Line', 'creatus'),
							'dualcolor' => esc_html__('Dual color', 'creatus'),
							'shadow' => esc_html__('Shadow', 'creatus'),
							'block' => esc_html__('Background block', 'creatus')
						)
					)
				),
				'choices' => array(
					'line' => array(
						'max_width' => array(
							'type' => 'short-text',
							'label' => __('Divider max width', 'creatus'),
							'value' => '100%',
							'desc' => esc_html__('Set max width. Can be px or %.', 'creatus')
						),
						'divider_position' => array(
							'label' => __('Divider position', 'creatus'),
							'desc' => esc_html__('Set divider position. Best seen when divider width is not 100%', 'creatus'),
							'value' => 'thz-float-none',
							'type' => 'radio',
							'inline' => true,
							'choices' => array(
								'thz-float-left' => esc_html__('Left', 'creatus'),
								'thz-float-none' => esc_html__('Center', 'creatus'),
								'thz-float-right' => esc_html__('Right', 'creatus')
							)
						),
						'linetype' => array(
							'type' => 'multi-picker',
							'label' => false,
							'desc' => false,
							'picker' => array(
								'picked' => array(
									'label' => __('Line type', 'creatus'),
									'desc' => esc_html__('Select line type, single or double', 'creatus'),
									'value' => 'singleline',
									'type' => 'short-select',
									'choices' => array(
										'singleline' => esc_html__('Single line', 'creatus'),
										'doubleline' => esc_html__('Double line', 'creatus')
									)
								)
							),
							'choices' => array(
								'doubleline' => array(
									'height' => array(
										'type' => 'thz-spinner',
										'label' => __('Double line height', 'creatus'),
										'addon' => 'px',
										'min' => 1,
										'value' => 10,
										'desc' => esc_html__('Set double line height.', 'creatus')
									)
								)
							)
						),
						'border' => array(
							'type' => 'thz-multi-options',
							'label' => __('Border', 'creatus'),
							'desc' => esc_html__('Adjust border', 'creatus'),
							'value' => array(
								'w' => 1,
								's' => 'solid',
								'c' =>'#eaeaea',
							),
							'thz_options' => array(
								'w' => array(
									'type' => 'spinner',
									'title' => esc_html__('Width', 'creatus'),
									'addon' => 'px'
								),
								's' => array(
									'type' => 'short-select',
									'title' => esc_html__('Style', 'creatus'),
									'choices' => array(
										'solid' => esc_html__('Solid', 'creatus'),
										'dashed' => esc_html__('Dashed', 'creatus'),
										'dotted' => esc_html__('Dotted', 'creatus')
									)
								),
								'c' => array(
									'type' => 'color',
									'title' => esc_html__('Color', 'creatus'),
									'box' => true
								)
							)
						),

						'divider_icon' => array(
							'type' => 'multi-picker',
							'label' => false,
							'desc' => false,
							'picker' => array(
								'picked' => array(
									'label' => __('Divider icon', 'creatus'),
									'desc' => esc_html__('Show/hide divider icon', 'creatus'),
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
									'icon_position' => array(
										'label' => __('Icon position', 'creatus'),
										'desc' => esc_html__('Set icon position', 'creatus'),
										'value' => 'center',
										'type' => 'radio',
										'inline' => true,
										'choices' => array(
											'left' => esc_html__('Left', 'creatus'),
											'center' => esc_html__('Center', 'creatus'),
											'right' => esc_html__('Right', 'creatus')
										)
									),
									'icon_metrics' => array(
										'type' => 'thz-multi-options',
										'label' => __('Icon metrics', 'creatus'),
										'desc' => esc_html__('Set icon size and side spacing', 'creatus'),
										'value' => array(
											'icon' => '',
											'size' => 38,
											'padding' => 20,
											'color' =>'color_1',
										),
										'thz_options' => array(
											'icon' => array(
												'type' => 'icon',
												'title' => esc_html__('Icon', 'creatus'),
											),
											'size' => array(
												'type' => 'spinner',
												'min' => 14,
												'title' => esc_html__('Icon size', 'creatus'),
												'addon' => 'px'
											),
											'padding' => array(
												'type' => 'spinner',
												'title' => esc_html__('Side space', 'creatus'),
												'addon' => 'px'
											),
											'color' => array(
												'type' => 'color',
												'title' => esc_html__('Icon color', 'creatus'),
												'boxed' => true
											)
										)
									),
								)
							)
						)
					), // end line
					'dualcolor' => array(
						'max_width' => array(
							'type' => 'short-text',
							'label' => __('Divider max width', 'creatus'),
							'value' => '100%',
							'desc' => esc_html__('Set max width. Can be px or %.', 'creatus')
						),
						'divider_position' => array(
							'label' => __('Divider position', 'creatus'),
							'desc' => esc_html__('Set divider position. Best seen when divider width is not 100%', 'creatus'),
							'value' => 'thz-float-none',
							'type' => 'radio',
							'inline' => true,
							'choices' => array(
								'thz-float-left' => esc_html__('Left', 'creatus'),
								'thz-float-none' => esc_html__('Center', 'creatus'),
								'thz-float-right' => esc_html__('Right', 'creatus')
							)
						),
						'height' => array(
							'type' => 'thz-spinner',
							'label' => __('Divider height', 'creatus'),
							'addon' => 'px',
							'min' => 0,
							'value' => 3,
							'desc' => esc_html__('Set the divider height.', 'creatus')
						),
						'long_color' => array(
							'type' => 'thz-color-picker',
							'value' => '#eaeaea',
							'label' => __('Long line color', 'creatus'),
							'desc' => esc_html__('Select long line color', 'creatus')
						),
						'short_color' => array(
							'type' => 'thz-color-picker',
							'value' => 'color_1',
							'label' => __('Short line color', 'creatus'),
							'desc' => esc_html__('Select short underline color', 'creatus')
						),
						'short_width' => array(
							'type' => 'short-text',
							'label' => __('Short line width', 'creatus'),
							'value' => '150px',
							'desc' => esc_html__('Set max width. Can be px or %.', 'creatus')
						),
						'short_position' => array(
							'label' => __('Short line position', 'creatus'),
							'desc' => esc_html__('Select short line position', 'creatus'),
							'value' => 'thz-dc-left',
							'type' => 'radio',
							'inline' => true,
							'choices' => array(
								'thz-dc-left' => esc_html__('Left', 'creatus'),
								'thz-dc-center' => esc_html__('Center', 'creatus'),
								'thz-dc-right' => esc_html__('Right', 'creatus')
							)
						)
					), // end dualcolor,
					'shadow' => array(
						'max_width' => array(
							'type' => 'short-text',
							'label' => __('Divider max width', 'creatus'),
							'value' => '100%',
							'desc' => esc_html__('Set max width. Can be px or %.', 'creatus')
						),
						'divider_position' => array(
							'label' => __('Divider position', 'creatus'),
							'desc' => esc_html__('Set divider position. Best seen when divider width is not 100%', 'creatus'),
							'value' => 'thz-float-none',
							'type' => 'radio',
							'inline' => true,
							'choices' => array(
								'thz-float-left' => esc_html__('Left', 'creatus'),
								'thz-float-none' => esc_html__('Center', 'creatus'),
								'thz-float-right' => esc_html__('Right', 'creatus')
							)
						),
						'shadow_height' => array(
							'type' => 'thz-spinner',
							'label' => __('Shadow height', 'creatus'),
							'addon' => 'px',
							'min' => 0,
							'value' => 5,
							'desc' => esc_html__('Set the shadow height.', 'creatus')
						),
						'shadow_color' => array(
							'type' => 'thz-color-picker',
							'value' => 'rgba(0, 0, 0, 0.2)',
							'label' => __('Shadow color', 'creatus'),
							'desc' => esc_html__('Set shadow icon color. Keep transparency for best effect', 'creatus')
						),
						'divider_icon' => array(
							'type' => 'multi-picker',
							'label' => false,
							'desc' => false,
							'picker' => array(
								'picked' => array(
									'label' => __('Divider icon', 'creatus'),
									'desc' => esc_html__('Show/hide divider icon', 'creatus'),
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
									'icon_metrics' => array(
										'type' => 'thz-multi-options',
										'label' => __('Icon metrics', 'creatus'),
										'desc' => esc_html__('Set icon size and side spacing', 'creatus'),
										'value' => array(
											'icon' => '',
											'size' => 38,
											'padding' => 20,
											'color' =>'color_1',
										),
										'thz_options' => array(
											'icon' => array(
												'type' => 'icon',
												'title' => esc_html__('Icon', 'creatus'),
											),
											'size' => array(
												'type' => 'spinner',
												'min' => 14,
												'title' => esc_html__('Icon size', 'creatus'),
												'addon' => 'px'
											),
											'padding' => array(
												'type' => 'spinner',
												'title' => esc_html__('Side space', 'creatus'),
												'addon' => 'px'
											),
											'color' => array(
												'type' => 'color',
												'title' => esc_html__('Icon color', 'creatus'),
												'boxed' => true
											)
										)
									),
								)
							)
						)
					), // end shadow
					'block' => array(
						'max_width' => array(
							'type' => 'short-text',
							'label' => __('Divider max width', 'creatus'),
							'value' => '100%',
							'desc' => esc_html__('Set max width. Can be px or %.', 'creatus')
						),
						'height' => array(
							'type' => 'thz-spinner',
							'label' => __('Divider height', 'creatus'),
							'addon' => 'px',
							'min' => 0,
							'value' => 10,
							'desc' => esc_html__('Set the divider height.', 'creatus')
						),
						'bg' => array(
							'type' => 'thz-background',
							'label' => __('Background', 'creatus'),
							'disable' => array('shape','video'),
							'value' => array(
								'type' => 'gradient',
								'gradient-style' => 'linear', // linear, radial
								'gradient-angle' => '0',
								'gradient-size' => 'farthest-corner', //closest-corner, closest-side,farthest-corner,farthest-side
								'gradient-shape' => 'circle', //circle,ellipse
								'gradient-h-poz' => '50',
								'gradient-v-poz' => '50',
								'gradient-start' => '0',
								'gradient-start-color' => '#ffffff',
								'gradient-add-stop' => array(),
								'gradient-end' => '100',
								'gradient-end-color' => 'color_1'
							),
							'desc' => esc_html__('Set divider background', 'creatus')
						)
					)
				)
			)
		)
	),
	'dividereffects' => array(
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
