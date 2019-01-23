<?php
if (!defined('FW')) {
	die('Forbidden');
}
$options = array(
	'calltoactiondefaults' => array(
		'title' => __('General', 'creatus'),
		'type' => 'tab',
		'options' => array(
			'id' => array(
				'type' => 'unique',
				'length' => 8
			),
			'hbs' => array(
				'type' => 'thz-box-style',
				'label' => __('Cta holder box style', 'creatus'),
				'preview' => true,
				'popup' => true,
				'desc' => esc_html__('Adjust .thz-cta-box-holder box style','creatus'),
				'button-text' => esc_html__('Customize holder style', 'creatus'),
				'disable' => array('layout','boxsize','transform','video'),
				'units' => array(
					'borderradius',
					'boxsize',
					'padding',
					'margin',
				),
				'value' => array()
			),
			'cbs' => array(
				'type' => 'thz-box-style',
				'label' => __('Cta box style', 'creatus'),
				'preview' => true,
				'popup' => true,
				'desc' => esc_html__('Adjust .thz-cta-box box style','creatus'),
				'button-text' => esc_html__('Customize cta box style', 'creatus'),
				'disable' => array('layout','boxsize','transform','video'),
				'units' => array(
					'borderradius',
					'boxsize',
					'padding',
					'margin',
				),
				'value' => array(
					'padding' => array(
						'top' => '30',
						'right' => '30',
						'bottom' => '30',
						'left' => '30'
					),
					'borders' => array(
						'all'=> 'same',			
						'top'=> array(
							'w' => 1,
							's' => 'solid',
							'c' => '#eaeaea'
						),
					)
				)
			),
			'cmx' => _thz_container_metrics_defaults()
		)
	),
	'calltoactiontext' => array(
		'title' => __('Text', 'creatus'),
		'type' => 'tab',
		'options' => array(
			'heading' => array(
				'type' => 'text',
				'value' => 'I am call to action box!',
				'label' => __('Heading', 'creatus'),
				'desc' => esc_html__('Not used if empty', 'creatus')
			),
			'subheading' => array(
				'type' => 'text',
				'value' => 'I am a cool sub heading',
				'label' => __('Sub heading', 'creatus'),
				'desc' => esc_html__('Not used if empty', 'creatus')
			),
			'text' => array(
				'label' => __('Text', 'creatus'),
				'desc' => esc_html__('Call to action text', 'creatus'),
				'type' => 'wp-editor',
				'size' => 'large',
				'editor_height' => 100,
				'editor_type' => 'tinymce',
				'wpautop' => false,
				'shortcodes' => false,
				'value' => esc_html__('This is dummy call to action text. Please replace it. Nullam ac interdum nulla, nec convallis velit. Aenean congue sodales eleifend. Pellentesque eget leo vehicula, elementum ipsum in, volutpat arcu.', 'creatus')
			)
		)
	),
	'calltoactionbutton1' => array(
		'title' => __('Button 1', 'creatus'),
		'type' => 'tab',
		'options' => array(
			'show_button1' => array(
				'type' => 'multi-picker',
				'label' => false,
				'desc' => false,
				'picker' => array(
					'picked' => array(
						'label' => __('Show button 1', 'creatus'),
						'desc' => esc_html__('Show or hide cta buton 1', 'creatus'),
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
						'cta_button1' => array(
							'type' => 'thz-button',
							'value' => array(
								'buttonText' => 'Click here!',
								'activeColor' => 'theme',
								'html' => '<div class="thz-btn-container"><a class="thz-button thz-btn-theme thz-btn-normal thz-radius-4 thz-btn-border-1 thz-align-center" href="#"><span class="thz-btn-text thz-fs-14 thz-fw-400">Click here!</span></a></div>'
							),
							'label' => false
						)
					)
				),
				'show_borders' => true
			)
		)
	),
	'calltoactionbutton2' => array(
		'title' => __('Button 2', 'creatus'),
		'type' => 'tab',
		'options' => array(
			'show_button2' => array(
				'type' => 'multi-picker',
				'label' => false,
				'desc' => false,
				'picker' => array(
					'picked' => array(
						'label' => __('Show button 2', 'creatus'),
						'desc' => esc_html__('Show or hide cta buton 2', 'creatus'),
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
						'cta_button2' => array(
							'type' => 'thz-button',
							'value' => array(
								'buttonText' => 'Click here!',
								'activeColor' => 'yellow',
							),
							'label' => false
						)
					)
				),
				'show_borders' => true
			)
		)
	),
	'calltoactionicon' => array(
		'title' => __('Icon', 'creatus'),
		'type' => 'tab',
		'options' => array(
			'icon' => array(
				'type' => 'thz-icon',
				'value' => 'fa fa-rocket',
				'label' => __('Icon', 'creatus'),
				'desc' => esc_html__('Not used if empty', 'creatus')
			),
			'icon_size' => array(
				'type' => 'short-select',
				'label' => __('Icon size', 'creatus'),
				'value' => 'thz-is-lg',
				'choices' => array(
					'thz-is-md' => esc_html__('Medium (em)', 'creatus'),
					'thz-is-lg' => esc_html__('Large (em)', 'creatus'),
					'thz-is-xl' => esc_html__('X-large (em)', 'creatus'),
					'thz-is-x4' => esc_html__('Jumbo (em)', 'creatus'),
					'thz-is-x5' => esc_html__('Mega (em)', 'creatus'),
					'thz-is-sm-px' => esc_html__('Small (px)', 'creatus'),
					'thz-is-md-px' => esc_html__('Medium (px)', 'creatus'),
					'thz-is-lg-px' => esc_html__('Large (px)', 'creatus'),
					'thz-is-x4-px' => esc_html__('X-Large (px)', 'creatus'),
					'thz-is-x5-px' => esc_html__('Jumbo (px)', 'creatus')
				)
			),
			'icon_shape' => array(
				'type' => 'multi-picker',
				'label' => false,
				'desc' => false,
				'picker' => array(
					'picked' => array(
						'label' => __('Background shape', 'creatus'),
						'desc' => esc_html__('If active, this icon will be placed inside a adjustable container.', 'creatus'),
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
						'shape_padding' => array(
							'type' => 'thz-spinner',
							'addon' => 'px',
							'min' => 10,
							'max' => 800,
							'value' => 30,
							'label' => __('Shape padding', 'creatus'),
							'desc' => esc_html__('Set shape padding.', 'creatus')
						),
						'type' => array(
							'type' => 'multi-picker',
							'label' => false,
							'desc' => false,
							'picker' => array(
								'picked' => array(
									'label' => __('Shape type', 'creatus'),
									'desc' => esc_html__('Select shape type', 'creatus'),
									'type' => 'radio',
									'value' => 'thz-cta-ishape-rounded',
									'inline' => true,
									'choices' => array(
										'thz-cta-ishape-circle' => esc_html__('Circle', 'creatus'),
										'thz-cta-ishape-square' => esc_html__('Square', 'creatus'),
										'thz-cta-ishape-rounded' => esc_html__('Rounded', 'creatus')
									)
								)
							),
							'choices' => array(
								'thz-cta-ishape-rounded' => array(
									'radius' => array(
										'type' => 'thz-spinner',
										'addon' => 'px',
										'min' => 2,
										'max' => 100,
										'value' => 8,
										'label' => __('Border radius', 'creatus'),
										'desc' => esc_html__('Set shape border radius', 'creatus')
									)
								)
							)
						),
						'bg_type' => array(
							'type' => 'multi-picker',
							'label' => false,
							'desc' => false,
							'picker' => array(
								'picked' => array(
									'label' => __('Background type', 'creatus'),
									'desc' => esc_html__('Select shape background type', 'creatus'),
									'type' => 'select',
									'value' => 'solid',
									'choices' => array(
										'solid' => esc_html__('Solid background', 'creatus'),
										'solidborder' => esc_html__('Solid background with border', 'creatus')
									)
								)
							),
							'choices' => array(
								'solid' => array(
									'color' => array(
										'type' => 'thz-color-picker',
										'value' => '#fafafa',
										'label' => __('Shape color', 'creatus'),
										'desc' => esc_html__('Set icon background shape color.', 'creatus')
									)
								),
								'solidborder' => array(
									'color' => array(
										'type' => 'thz-color-picker',
										'value' => '#fafafa',
										'label' => __('Shape color', 'creatus'),
										'desc' => esc_html__('Set icon background shape color.', 'creatus')
									),
									'border_color' => array(
										'type' => 'thz-color-picker',
										'value' => 'color_1',
										'label' => __('Shape border color', 'creatus'),
										'desc' => esc_html__('Set icon background shape border color.', 'creatus')
									),
									'border_size' => array(
										'type' => 'thz-spinner',
										'label' => __('Shape border size', 'creatus'),
										'addon' => 'px',
										'min' => 0,
										'max' => 50,
										'value' => 2,
										'desc' => esc_html__('Set shape border size', 'creatus')
									),
									'border_style' => array(
										'label' => __('Border style', 'creatus'),
										'desc' => esc_html__('Set shape border style', 'creatus'),
										'type' => 'short-select',
										'value' => 'solid',
										'choices' => array(
											'solid' => esc_html__('Solid', 'creatus'),
											'dashed' => esc_html__('Dashed', 'creatus'),
											'dotted' => esc_html__('Dotted', 'creatus')
										)
									)
								)
							) // choices end
						) // bg type end								
					)
				)
			)
		)
	),
	'calltoactiolayout' => array(
		'title' => __('Layout', 'creatus'),
		'type' => 'tab',
		'options' => array(
			'elements_layout' => array(
				'type' => 'thz-multi-options',
				'label' => __('Elements settings', 'creatus'),
				'desc' => esc_html__('Set text alignment, button and icon position and vertical alignment.', 'creatus'),
				'value' => array(
					'text_align' => 'right',
					'buttons_position' => 'right',
					'buttons_align' => 'thz-va-middle',
					'icon_position' => 'left',
					'icon_align' => 'thz-va-top',
				),
				'thz_options' => array(
					'text_align' => array(
						'type' => 'short-select',
						'title' => esc_html__('Text alignment', 'creatus'),
						'choices' => array(
							'thz-align-left' => esc_html__('Left', 'creatus'),
							'thz-align-center' => esc_html__('Center', 'creatus'),
							'thz-align-right' => esc_html__('Right', 'creatus')
						)
					),
					'buttons_position' => array(
						'type' => 'short-select',
						'title' => esc_html__('Buttons position', 'creatus'),
						'choices' => array(
							'left' => esc_html__('Left', 'creatus'),
							'right' => esc_html__('Right', 'creatus'),
							'bottom' => esc_html__('Bottom', 'creatus')
						)
					),
					'buttons_align' => array(
						'type' => 'short-select',
						'title' => esc_html__('Buttons v-align', 'creatus'),
						'choices' => array(
							'thz-va-top' => esc_html__('Top', 'creatus'),
							'thz-va-middle' => esc_html__('Middle', 'creatus'),
							'thz-va-bottom' => esc_html__('Bottom', 'creatus')
						)
					),
					'icon_position' => array(
						'type' => 'short-select',
						'title' => esc_html__('Icon position', 'creatus'),
						'choices' => array(
							'top' => esc_html__('Top', 'creatus'),
							'left' => esc_html__('Left', 'creatus'),
							'right' => esc_html__('Right', 'creatus')
						)
					),
					'icon_align' => array(
						'type' => 'short-select',
						'title' => esc_html__('Icon v-align', 'creatus'),
						'choices' => array(
							'thz-va-top' => esc_html__('Top', 'creatus'),
							'thz-va-middle' => esc_html__('Middle', 'creatus'),
							'thz-va-bottom' => esc_html__('Bottom', 'creatus')
						)
					)
				)
			),

			'spacers' => array(
				'type' => 'thz-multi-options',
				'label' => __('Spacers', 'creatus'),
				'desc' => esc_html__('This is the space between the element and the surrounding elements.', 'creatus'),
				'value' => array(
					'button1' =>20,
					'button2' =>20,
					'icon' =>20
				),
				'thz_options' => array(
					'button1' => array(
						'type' => 'spinner',
						'title' => esc_html__('Button 1', 'creatus'),
						'addon' => 'px',
						'min' => 0,
						'max' => 100
					),
					'button2' => array(
						'type' => 'spinner',
						'title' => esc_html__('Button 2', 'creatus'),
						'addon' => 'px',
						'min' => 0,
						'max' => 100
					),
					'icon' => array(
						'type' => 'spinner',
						'title' => esc_html__('Icon', 'creatus'),
						'addon' => 'px',
						'min' => 0,
						'max' => 100
					),
				)
			),
			
			
			'heading_padding' => array(
				'type' => 'thz-box-style',
				'label' => __('Heading padding', 'creatus'),
				'preview' => false,
				'popup' => false,
				'desc' => esc_html__('Set heading padding.', 'creatus'),
				'disable' => array('layout','margin','borders','borderradius','transform','boxsize','boxshadow','background'),
				'value' => array(
					'padding' => array(
						'top' => '0',
						'right' => '0',
						'bottom' => '0',
						'left' => '0'
					)
				)
			),
			'subheading_padding' => array(
				'type' => 'thz-box-style',
				'label' => __('Sub heading padding', 'creatus'),
				'preview' => false,
				'popup' => false,
				'desc' => esc_html__('Set sub heading padding.', 'creatus'),
				'disable' => array('layout','margin','borders','borderradius','transform','boxsize','boxshadow','background'),
				'value' => array()
			),
			'text_padding' => array(
				'type' => 'thz-box-style',
				'label' => __('Text padding', 'creatus'),
				'preview' => false,
				'popup' => false,
				'desc' => esc_html__('Set text heading padding.', 'creatus'),
				'disable' => array('layout','margin','borders','borderradius','transform','boxsize','boxshadow','background'),
				'value' => array(
					'padding' => array(
						'top' => '10',
						'right' => '0',
						'bottom' => '0',
						'left' => '0'
					)
				)
			),
			'buttons_padding' => array(
				'type' => 'thz-box-style',
				'label' => __('Buttons container padding', 'creatus'),
				'preview' => false,
				'popup' => false,
				'desc' => esc_html__('Set buttons container padding.', 'creatus'),
				'disable' => array('layout','margin','borders','borderradius','transform','boxsize','boxshadow','background'),
				'value' => array()
			),
			'icon_padding' => array(
				'type' => 'thz-box-style',
				'label' => __('Icon padding', 'creatus'),
				'preview' => false,
				'popup' => false,
				'desc' => esc_html__('Set icon container padding', 'creatus'),
				'disable' => array('layout','margin','borders','borderradius','transform','boxsize','boxshadow','background'),
				'value' => array()
			)
		)
	),
	'calltoactioncolors' => array(
		'title' => __('Colors', 'creatus'),
		'type' => 'tab',
		'options' => array(
			'heading_color' => array(
				'type' => 'thz-color-picker',
				'value' => '',
				'label' => __('Heading color', 'creatus'),
				'desc' => esc_html__('Set heading color.', 'creatus')
			),
			'subheading_color' => array(
				'type' => 'thz-color-picker',
				'value' => '',
				'label' => __('Sub heading color', 'creatus'),
				'desc' => esc_html__('Set Sub heading color.', 'creatus')
			),
			'text_color' => array(
				'type' => 'thz-color-picker',
				'value' => '',
				'label' => __('Text color', 'creatus'),
				'desc' => esc_html__('Set text color.', 'creatus')
			),
			'icon_color' => array(
				'type' => 'thz-color-picker',
				'value' => '',
				'label' => __('Icon color', 'creatus'),
				'desc' => esc_html__('Set icon color.', 'creatus')
			)
		)
	),
	'calltoactiontypo' => array(
		'title' => __('Typography', 'creatus'),
		'type' => 'tab',
		'options' => array(
			'cta_heading_font' => array(
				'type' => 'multi-picker',
				'label' => false,
				'desc' => false,
				'picker' => array(
					'picked' => array(
						'label' => 'Heading font',
						'type' => 'radio',
						'value' => 'default',
						'choices' => array(
							'default' => esc_html__('Use theme or container default', 'creatus'),
							'custom' => esc_html__('Set custom', 'creatus')
						),
						'desc' => esc_html__('Set custom font settings for heading', 'creatus')
					)
				),
				'choices' => array(
					'custom' => array(
						'heading_font' => array(
							'label' => '',
							'type' => 'thz-typography',
							'value' => array(
								'size' => 30
							),
							'disable' => array('color','hovered'),
							'desc' => esc_html__('Heading font family and metrics', 'creatus')
						)
					)
				),
				'show_borders' => false
			), //
			'cta_subheading_font' => array(
				'type' => 'multi-picker',
				'label' => false,
				'desc' => false,
				'picker' => array(
					'picked' => array(
						'label' => 'Sub heading font',
						'type' => 'radio',
						'value' => 'default',
						'choices' => array(
							'default' => esc_html__('Use theme or container default', 'creatus'),
							'custom' => esc_html__('Set custom', 'creatus')
						),
						'desc' => esc_html__('Set custom font settings for sub heading', 'creatus')
					)
				),
				'choices' => array(
					'custom' => array(
						'subheading_font' => array(
							'label' => '',
							'type' => 'thz-typography',
							'value' => array(
								'size' 			=> 18,
							),
							'disable' => array('color','hovered'),
							'desc' => esc_html__('Sub heading font family and metrics', 'creatus')
						)
					)
				),
				'show_borders' => false
			), //
			'cta_text_font' => array(
				'type' => 'multi-picker',
				'label' => false,
				'desc' => false,
				'picker' => array(
					'picked' => array(
						'label' => 'Text font',
						'type' => 'radio',
						'value' => 'default',
						'choices' => array(
							'default' => esc_html__('Use theme or container default', 'creatus'),
							'custom' => esc_html__('Set custom', 'creatus')
						),
						'desc' => esc_html__('Set custom font settings for cta text', 'creatus')
					)
				),
				'choices' => array(
					'custom' => array(
						'text_font' => array(
							'label' => '',
							'type' => 'thz-typography',
							'value' => array(),
							'disable' => array('color','hovered'),
							'desc' => esc_html__('Text font family and metrics', 'creatus')
						)
					)
				),
				'show_borders' => false
			) //	
		)
	),
	'ctaeffects' => array(
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