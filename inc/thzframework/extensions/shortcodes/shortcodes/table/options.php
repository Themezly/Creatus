<?php
if (!defined('FW')) {
	die('Forbidden');
}
$options = array(
	'tabledefaults' => array(
		'title' => __('Defaults', 'creatus'),
		'type' => 'tab',
		'lazy_tabs'=> false,
		'options' => array(
			'table' => array(
				'type' => 'table',
				'label' => false,
				'desc' => false
			),
			'id' => array(
				'type' => 'unique',
				'length' => 8
			)
		)
	),
	'tablestyles' => array(
		'title' => __('Style', 'creatus'),
		'type' => 'tab',
		'lazy_tabs'=> false,
		'options' => array(
			'table_style' => array(
				'type' => 'multi-picker',
				'label' => false,
				'desc' => false,
				'attr' => array(
					'class' => 'thz-tabular-styles'
				),
				'picker' => array(
					'picked' => array(
						'label' => __('Table Style', 'creatus'),
						'desc' => esc_html__('Select table style', 'creatus'),
						'help' => esc_html__('If no style is selected , table layout remanis in tact but all styling is removed. This way you can style it yourself.', 'creatus'),
						'type' => 'short-select',
						'value' => 'solid',
						'choices' => array(
							'thz-table-bordered' => esc_html__('Bordered', 'creatus'),
							'thz-table-lines' => esc_html__('Lines', 'creatus'),
							'thz-table-unstyled' => esc_html__('No style', 'creatus')
						)
					)
				),
				'choices' => array(
					'thz-table-bordered' => array(
						'table_settings' => array(
							'type' => 'thz-multi-options',
							'label' => __('Table settings', 'creatus'),
							'desc' => esc_html__('Customize table style.', 'creatus'),
							'value' => array(
								'background' => '#ffffff',
								'border_color' => '#dddddd',
								'text_color' => ''
							),
							'thz_options' => array(
								'background' => array(
									'type' => 'color',
									'title' => esc_html__('Background color', 'creatus')
								),
								'border_color' => array(
									'type' => 'color',
									'title' => esc_html__('Border color', 'creatus')
								),
								'text_color' => array(
									'type' => 'color',
									'title' => esc_html__('Text color', 'creatus')
								)
							)
						)
					),
					'thz-table-lines' => array(
						'table_settings' => array(
							'type' => 'thz-multi-options',
							'label' => __('Table settings', 'creatus'),
							'desc' => esc_html__('Customize table style.', 'creatus'),
							'value' => array(
								'background' => '#ffffff',
								'border_color' => '#dddddd',
								'text_color' => ''
							),
							'thz_options' => array(
								'background' => array(
									'type' => 'color',
									'title' => esc_html__('Background color', 'creatus')
								),
								'border_color' => array(
									'type' => 'color',
									'title' => esc_html__('Border color', 'creatus')
								),
								'text_color' => array(
									'type' => 'color',
									'title' => esc_html__('Text color', 'creatus')
								)
							)
						)
					)
				)
			),
			'stripes' => array(
				'type' => 'multi-picker',
				'label' => false,
				'desc' => false,
				'picker' => array(
					'picked' => array(
						'label' => __('Striped rows', 'creatus'),
						'desc' => esc_html__('Show/hide striped rows', 'creatus'),
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
						'stripes_settings' => array(
							'type' => 'thz-multi-options',
							'label' => '',
							'desc' => esc_html__('Customize striped rows style.', 'creatus'),
							'value' => array(
								'background' => '#fafafa',
								'text_color' => '',
								'hovered_background' => '#f7f7f7',
								'hovered_text' => ''
								
							),
							'thz_options' => array(
								'background' => array(
									'type' => 'color',
									'title' => esc_html__('Background', 'creatus')
								),
								'text_color' => array(
									'type' => 'color',
									'title' => esc_html__('Text color', 'creatus')
								),
								'hovered_background' => array(
									'type' => 'color',
									'title' => esc_html__('Hovered background', 'creatus')
								),
								'hovered_text' => array(
									'type' => 'color',
									'title' => esc_html__('Hovered text color', 'creatus')
								),

							)
						)
					)
				)
			),
			'tr_mx' => array(
				'type' => 'thz-multi-options',
				'label' => __('Row paddding', 'creatus'),
				'desc' => esc_html__('Customize table row padding', 'creatus'),
				'value' => array(
					'vp' => '',
					'hp' => '',
				),
				'thz_options' => array(
					'vp' => array(
						'type' => 'spinner',
						'title' => esc_html__('Vertical', 'creatus'),
						'addon' => 'px',
						'min' => 0,
						'step' => 0.1,
						'attr' => array(
							'placeholder' => 10
						),
					),
					'hp' => array(
						'type' => 'spinner',
						'title' => esc_html__('Horizontal', 'creatus'),
						'addon' => 'px',
						'min' => 0,
						'step' => 0.1,
						'attr' => array(
							'placeholder' => 10
						),
					),
				)
			),	
			'pricing_style' => array(
				'type' => 'multi-picker',
				'label' => false,
				'desc' => false,
				'attr' => array(
					'class' => 'thz-pricing-styles'
				),
				'picker' => array(
					'picked' => array(
						'label' => __('Style', 'creatus'),
						'desc' => esc_html__('Select table style', 'creatus'),
						'help' => esc_html__('If no style is selected , the tables layout remanis in tact but all styling is removed. This way you can style it yourself.', 'creatus'),
						'type' => 'select',
						'value' => 'style1',
						'choices' => array(
							'style1' => esc_html__('Style 1', 'creatus'),
							'style2' => esc_html__('Style 2', 'creatus'),
							'style3' => esc_html__('Style 3 ', 'creatus'),
							'none' => esc_html__('No style', 'creatus')
						)
					)
				),
				'choices' => array(
					'style1' => array(
						'package' => array(
							'type' => 'thz-multi-options',
							'label' => __('Package', 'creatus'),
							'desc' => esc_html__('Customize package style.', 'creatus'),
							'help' => esc_html__('Background gradient is created if both background colors are used.', 'creatus'),
							'value' => array(
								'background' => '#ffffff',
								'background2' => '',
								'gradient' => 'linear',
								'border_color' => '#eaeaea',
								'shadow' => 0.1
							),
							'thz_options' => array(
								'background' => array(
									'type' => 'color',
									'title' => esc_html__('Background color 1', 'creatus')
								),
								'background2' => array(
									'type' => 'color',
									'title' => esc_html__('Background color 2', 'creatus')
								),
								'gradient' => array(
									'type' => 'short-select',
									'title' => esc_html__('Gradient type', 'creatus'),
									'choices' => array(
										'linear' => esc_html__('Linear', 'creatus'),
										'radial' => esc_html__('Radial', 'creatus')
									)
								),
								'border_color' => array(
									'type' => 'color',
									'title' => esc_html__('Border color', 'creatus')
								),
								'shadow' => array(
									'type' => 'spinner',
									'title' => esc_html__('Highlight box shadow', 'creatus'),
									'addon' => 'px',
									'step' => 0.1,
									'min' => 0,
									'max' => 1
								)
							)
						),
						'heading' => array(
							'type' => 'thz-multi-options',
							'label' => __('Heading row', 'creatus'),
							'desc' => esc_html__('Customize heading style.', 'creatus'),
							'help' => esc_html__('Background gradient is created if both background colors are used.', 'creatus'),
							'value' => array(
								'background' => '#fefefe',
								'background2' => '',
								'gradient' => 'linear',
								'text_color' => '',
								'small_color' => '#acacac'
							),
							'thz_options' => array(
								'background' => array(
									'type' => 'color',
									'title' => esc_html__('Background color 1', 'creatus')
								),
								'background2' => array(
									'type' => 'color',
									'title' => esc_html__('Background color 2', 'creatus')
								),
								'gradient' => array(
									'type' => 'short-select',
									'title' => esc_html__('Gradient type', 'creatus'),
									'choices' => array(
										'linear' => esc_html__('Linear', 'creatus'),
										'radial' => esc_html__('Radial', 'creatus')
									)
								),
								'text_color' => array(
									'type' => 'color',
									'title' => esc_html__('Text color', 'creatus')
								),
								'small_color' => array(
									'type' => 'color',
									'title' => esc_html__('Per month', 'creatus')
								)
							)
						),
						'price' => array(
							'type' => 'thz-multi-options',
							'label' => __('Price row', 'creatus'),
							'desc' => esc_html__('Customize price style.', 'creatus'),
							'help' => esc_html__('Background gradient is created if both background colors are used.', 'creatus'),
							'value' => array(
								'background' => '#fafafa',
								'background2' => '',
								'gradient' => 'linear',
								'text_color' => ''
							),
							'thz_options' => array(
								'background' => array(
									'type' => 'color',
									'title' => esc_html__('Background color 1', 'creatus')
								),
								'background2' => array(
									'type' => 'color',
									'title' => esc_html__('Background color 2', 'creatus')
								),
								'gradient' => array(
									'type' => 'short-select',
									'title' => esc_html__('Gradient type', 'creatus'),
									'choices' => array(
										'linear' => esc_html__('Linear', 'creatus'),
										'radial' => esc_html__('Radial', 'creatus')
									)
								),
								'text_color' => array(
									'type' => 'color',
									'title' => esc_html__('Text color', 'creatus')
								)
							)
						),
						'misc_colors' => array(
							'type' => 'thz-multi-options',
							'label' => __('Miscellaneous colors', 'creatus'),
							'desc' => esc_html__('Customize description row and switch row icon colors.', 'creatus'),
							'value' => array(
								'text_color' => '#121212',
								'switchyes' => '#1ecb67',
								'switchno' => '#ed5565',
								'descrow' => '#999999'
							),
							'thz_options' => array(
								'text_color' => array(
									'type' => 'color',
									'title' => esc_html__('Package text color', 'creatus')
								),
								'switchyes' => array(
									'type' => 'color',
									'title' => esc_html__('Yes icon', 'creatus')
								),
								'switchno' => array(
									'type' => 'color',
									'title' => esc_html__('No icon', 'creatus')
								),
								'descrow' => array(
									'type' => 'color',
									'title' => esc_html__('Description row', 'creatus')
								)
							)
						)
					),
					'style2' => array(
						'package' => array(
							'type' => 'thz-multi-options',
							'label' => __('Package', 'creatus'),
							'desc' => esc_html__('Customize package style.', 'creatus'),
							'help' => esc_html__('Background gradient is created if both background colors are used.', 'creatus'),
							'value' => array(
								'background' => '#ffffff',
								'background2' => '',
								'gradient' => 'linear',
								'border_color' => '#eaeaea',
								'shadow' => 0
							),
							'thz_options' => array(
								'background' => array(
									'type' => 'color',
									'title' => esc_html__('Background color 1', 'creatus')
								),
								'background2' => array(
									'type' => 'color',
									'title' => esc_html__('Background color 2', 'creatus')
								),
								'gradient' => array(
									'type' => 'short-select',
									'title' => esc_html__('Gradient type', 'creatus'),
									'choices' => array(
										'linear' => esc_html__('Linear', 'creatus'),
										'radial' => esc_html__('Radial', 'creatus')
									)
								),
								'border_color' => array(
									'type' => 'color',
									'title' => esc_html__('Border color', 'creatus')
								),
								'shadow' => array(
									'type' => 'spinner',
									'title' => esc_html__('Highlight box shadow', 'creatus'),
									'addon' => 'px',
									'step' => 0.1,
									'min' => 0,
									'max' => 1
								)
							)
						),
						'heading' => array(
							'type' => 'thz-multi-options',
							'label' => __('Heading row', 'creatus'),
							'desc' => esc_html__('Customize heading style.', 'creatus'),
							'help' => esc_html__('Background gradient is created if both background colors are used.', 'creatus'),
							'value' => array(
								'background' => '#fafafa',
								'background2' => '',
								'gradient' => 'linear',
								'text_color' => ''
							),
							'thz_options' => array(
								'background' => array(
									'type' => 'color',
									'title' => esc_html__('Background color 1', 'creatus')
								),
								'background2' => array(
									'type' => 'color',
									'title' => esc_html__('Background color 2', 'creatus')
								),
								'gradient' => array(
									'type' => 'short-select',
									'title' => esc_html__('Gradient type', 'creatus'),
									'choices' => array(
										'linear' => esc_html__('Linear', 'creatus'),
										'radial' => esc_html__('Radial', 'creatus')
									)
								),
								'text_color' => array(
									'type' => 'color',
									'title' => esc_html__('Text color', 'creatus')
								)
							)
						),
						'price' => array(
							'type' => 'thz-multi-options',
							'label' => __('Price circle', 'creatus'),
							'desc' => esc_html__('Customize price style.', 'creatus'),
							'help' => esc_html__('Background gradient is created if both background colors are used.', 'creatus'),
							'value' => array(
								'background' => '#fafafa',
								'background2' => '',
								'gradient' => 'linear',
								'border_color' => 'color_1',
								'text_color' => ''
							),
							'thz_options' => array(
								'background' => array(
									'type' => 'color',
									'title' => esc_html__('Background color 1', 'creatus')
								),
								'background2' => array(
									'type' => 'color',
									'title' => esc_html__('Background color 2', 'creatus')
								),
								'gradient' => array(
									'type' => 'short-select',
									'title' => esc_html__('Gradient type', 'creatus'),
									'choices' => array(
										'linear' => esc_html__('Linear', 'creatus'),
										'radial' => esc_html__('Radial', 'creatus')
									)
								),
								'border_color' => array(
									'type' => 'color',
									'title' => esc_html__('Border color', 'creatus')
								),
								'text_color' => array(
									'type' => 'color',
									'title' => esc_html__('Text color', 'creatus')
								)
							)
						),
						'misc_colors' => array(
							'type' => 'thz-multi-options',
							'label' => __('Miscellaneous colors', 'creatus'),
							'desc' => esc_html__('Customize description row and switch row icon colors.', 'creatus'),
							'value' => array(
								'text_color' => '#121212',
								'switchyes' => '#1ecb67',
								'switchno' => '#ed5565',
								'descrow' => '#999999'
							),
							'thz_options' => array(
								'text_color' => array(
									'type' => 'color',
									'title' => esc_html__('Package text color', 'creatus')
								),
								'switchyes' => array(
									'type' => 'color',
									'title' => esc_html__('Yes icon', 'creatus')
								),
								'switchno' => array(
									'type' => 'color',
									'title' => esc_html__('No icon', 'creatus')
								),
								'descrow' => array(
									'type' => 'color',
									'title' => esc_html__('Description row', 'creatus')
								)
							)
						)
					),
					'style3' => array(
						'package' => array(
							'type' => 'thz-multi-options',
							'label' => __('Package', 'creatus'),
							'desc' => esc_html__('Customize package style.', 'creatus'),
							'help' => esc_html__('Background gradient is created if both background colors are used.', 'creatus'),
							'value' => array(
								'background' => '#ffffff',
								'background2' => '',
								'gradient' => 'linear',
								'border_color' => '#eaeaea',
								'shadow' => 0.2
							),
							'thz_options' => array(
								'background' => array(
									'type' => 'color',
									'title' => esc_html__('Background color 1', 'creatus')
								),
								'background2' => array(
									'type' => 'color',
									'title' => esc_html__('Background color 2', 'creatus')
								),
								'gradient' => array(
									'type' => 'short-select',
									'title' => esc_html__('Gradient type', 'creatus'),
									'choices' => array(
										'linear' => esc_html__('Linear', 'creatus'),
										'radial' => esc_html__('Radial', 'creatus')
									)
								),
								'border_color' => array(
									'type' => 'color',
									'title' => esc_html__('Border color', 'creatus')
								),
								'shadow' => array(
									'type' => 'spinner',
									'title' => esc_html__('Box shadow', 'creatus'),
									'addon' => 'px',
									'step' => 0.1,
									'min' => 0,
									'max' => 1
								)
							)
						),
						'heading' => array(
							'type' => 'thz-multi-options',
							'label' => __('Heading row', 'creatus'),
							'desc' => esc_html__('Customize heading style.', 'creatus'),
							'help' => esc_html__('Background gradient is created if both background colors are used.', 'creatus'),
							'value' => array(
								'background' => 'color_1',
								'background2' => '',
								'gradient' => 'linear',
								'text_color' => '#ffffff'
							),
							'thz_options' => array(
								'background' => array(
									'type' => 'color',
									'title' => esc_html__('Background color 1', 'creatus')
								),
								'background2' => array(
									'type' => 'color',
									'title' => esc_html__('Background color 2', 'creatus')
								),
								'gradient' => array(
									'type' => 'short-select',
									'title' => esc_html__('Gradient type', 'creatus'),
									'choices' => array(
										'linear' => esc_html__('Linear', 'creatus'),
										'radial' => esc_html__('Radial', 'creatus')
									)
								),
								'text_color' => array(
									'type' => 'color',
									'title' => esc_html__('Text color', 'creatus')
								)
							)
						),
						'highlight_heading' => array(
							'type' => 'thz-multi-options',
							'label' => __('Highlight row heading', 'creatus'),
							'desc' => esc_html__('Customize highlight row heading style.', 'creatus'),
							'help' => esc_html__('Background gradient is created if both background colors are used.', 'creatus'),
							'value' => array(
								'background' => 'color_darker_25',
								'background2' => '',
								'gradient' => 'linear',
								'text_color' => 'color_contrast'
							),
							'thz_options' => array(
								'background' => array(
									'type' => 'color',
									'title' => esc_html__('Background color 1', 'creatus')
								),
								'background2' => array(
									'type' => 'color',
									'title' => esc_html__('Background color 2', 'creatus')
								),
								'gradient' => array(
									'type' => 'short-select',
									'title' => esc_html__('Gradient type', 'creatus'),
									'choices' => array(
										'linear' => esc_html__('Linear', 'creatus'),
										'radial' => esc_html__('Radial', 'creatus')
									)
								),
								'text_color' => array(
									'type' => 'color',
									'title' => esc_html__('Text color', 'creatus')
								)
							)
						),
						'misc_colors' => array(
							'type' => 'thz-multi-options',
							'label' => __('Miscellaneous colors', 'creatus'),
							'desc' => esc_html__('Customize description row and switch row icon colors.', 'creatus'),
							'value' => array(
								'text_color' => '#121212',
								'switchyes' => '#1ecb67',
								'switchno' => '#ed5565',
								'descrow' => '#999999'
							),
							'thz_options' => array(
								'text_color' => array(
									'type' => 'color',
									'title' => esc_html__('Package text color', 'creatus')
								),
								'switchyes' => array(
									'type' => 'color',
									'title' => esc_html__('Yes icon', 'creatus')
								),
								'switchno' => array(
									'type' => 'color',
									'title' => esc_html__('No icon', 'creatus')
								),
								'descrow' => array(
									'type' => 'color',
									'title' => esc_html__('Description row', 'creatus')
								)
							)
						)
					)
				)
			),
		
			'bs' => array(
				'type' => 'thz-box-style',
				'label' => __('Container box style', 'creatus'),
				'preview' => false,
				'popup' => true,
				'desc' => esc_html__('Adjust .thz-table-container box style', 'creatus'),
				'button-text' => __('Customize container box style', 'creatus'),
				'disable' => array('video'),
				'units' => array(
					'borderradius',
					'boxsize',
					'padding',
					'margin',
				),
				'value' => array()
			),
			
			'cmx' => _thz_container_metrics_defaults()
		)
	),
	'tableffects' => array(
		'title' => __('Effects', 'creatus'),
		'type' => 'tab',
		'lazy_tabs'=> false,
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