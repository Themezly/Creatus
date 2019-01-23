<?php
if (!defined('FW')) {
	die('Forbidden');
}
$options = array(
	'defaultettings' => array(
		'title' => __('Defaults', 'creatus'),
		'type' => 'tab',
		'options' => array(
			'id' => array(
				'type' => 'unique',
				'length' => 8
			),
			'metrics' => array(
				'type' => 'thz-multi-options',
				'label' => __('Icon metrics', 'creatus'),
				'desc' => esc_html__('Adjust icon metrics. Color is not applicable if your are using own icon image.', 'creatus'),
				'help' => esc_html__('SVG color modes are used only if SVG Icon image is selected. Icon color is than applied to the SVG selection. To enable WordPress SVG uploads please use 3rd party plugin that allows this feature.', 'creatus'),
				'value' => array(
					'type' => 'simple',
					'icon' => 'thzicon thzicon-play2',
					'size' => 28,
					'align' => 'inline',
					'mode' => 'color',
					'color' => 'color_1',
					'color2' => '',
					'hovered' => 'color_2',
					'hovered2' => '',
				),
				'breakafter' =>'align',
				'thz_options' => array(
					'type' => array(
						'type' => 'short-select',
						'title' => esc_html__('Type', 'creatus'),
						'attr' => array(
							'class' => 'thz-select-switch link-switch'
						),
						'choices' => array(
							'simple' => array(
								'text' => esc_html__('Simple icon', 'creatus'),
								'attr' => array(
									'data-disable' => '.icon-hovered-parent,icon_link,.ic-hovered-2-parent'
								)
							),
							'link' => array(
								'text' => esc_html__('Link icon', 'creatus'),
								'attr' => array(
									'data-enable' => '.icon-hovered-parent,icon_link,.ic-hovered-2-parent',
								)
							)
						)
					),
					'icon' => array(
						'type' => 'icon',
						'title' => esc_html__('Icon', 'creatus')
					),
					'size' => array(
						'type' => 'spinner',
						'title' => esc_html__('Size', 'creatus'),
						'addon' => 'px'
					),
					'align' => array(
						'type' => 'short-select',
						'title' => esc_html__('Align', 'creatus'),
						'choices' => array(
							'inline' => esc_html__('Inline with text', 'creatus'),
							'left' => esc_html__('Float left', 'creatus'),
							'right' => esc_html__('Float right', 'creatus'),
							'center' => esc_html__('Center ', 'creatus')
						)
					),
					'mode' => array(
						'title' => esc_html__('Color mode', 'creatus'),
						'type' => 'short-select',
						'attr' => array(
							'class' => 'thz-select-switch thz-color-mode'
						),
						'choices' => array(
							'color' => array(
								'text' => esc_html__('Color', 'creatus'),
								'attr' => array(
									'data-disable' => '.ic-color-2-parent,.ic-hovered-2-parent,.effect-icon-color2-parent',
								)
							),
							'vertical' => array(
								'text' => esc_html__('Vertical gradient', 'creatus'),
								'attr' => array(
									'data-enable' => '.ic-color-2-parent,.effect-icon-color2-parent',
									'data-check' => '.link-switch'
								)
							),
							'horizontal' => array(
								'text' => esc_html__('Horizontal gradient', 'creatus'),
								'attr' => array(
									'data-enable' => '.ic-color-2-parent,.effect-icon-color2-parent',
									'data-check' => '.link-switch'
								)
							),
							'radial' => array(
								'text' => esc_html__('Radial gradient', 'creatus'),
								'attr' => array(
									'data-enable' => '.ic-color-2-parent,.effect-icon-color2-parent',
									'data-check' => '.link-switch'
								)
							),
							'fill' => array(
								'text' => esc_html__('SVG fill', 'creatus'),
								'attr' => array(
									'data-disable' => '.ic-color-2-parent,.ic-hovered-2-parent,.effect-icon-color2-parent',
								)
							),
							'stroke' => array(
								'text' => esc_html__('SVG stroke', 'creatus'),
								'attr' => array(
									'data-disable' => '.ic-color-2-parent,.ic-hovered-2-parent,.effect-icon-color2-parent',
								)
							),
							'both' => array(
								'text' => esc_html__('SVG fill and stroke', 'creatus'),
								'attr' => array(
									'data-disable' => '.ic-color-2-parent,.ic-hovered-2-parent,.effect-icon-color2-parent',
								)
							)
						)
					),
					'color' => array(
						'type' => 'color',
						'title' => esc_html__('Color', 'creatus'),
						'box' => true,
						'attr' => array(
							'class' => 'ic-color-1'
						)
					),
					'color2' => array(
						'type' => 'color',
						'title' => esc_html__('Color 2', 'creatus'),
						'box' => true,
						'attr' => array(
							'class' => 'ic-color-2'
						)
					),
					'hovered' => array(
						'type' => 'color',
						'title' => esc_html__('Hovered', 'creatus'),
						'box' => true,
						'attr' => array(
							'class' => 'icon-hovered'
						)
					),
					'hovered2' => array(
						'type' => 'color',
						'title' => esc_html__('Hovered 2', 'creatus'),
						'box' => true,
						'attr' => array(
							'class' => 'ic-hovered-2'
						)
					),
				)
			),
			'icon_link' => array(
				'type' => 'thz-url',
				'value' => array(
					'type' => 'normal',
					'url' => '',
					'title' => '',
					'target' => '_self',
					'magnific' => ''
				)
			),
			'boxstyle' => array(
				'type' => 'thz-box-style',
				'popup' => true,
				'label' => __('Icon holder box style', 'creatus'),
				'button-text' => esc_html__('Icon holder box style', 'creatus'),
				'desc' => esc_html__('Adjust icon holder box style', 'creatus'),
				'disable' => array(
					'video'
				),
				'units' => array(
					'borderradius',
					'boxsize',
					'padding',
					'margin',
				),
				'value' => array()
			),
			'iconimg' => array(
				'type' => 'upload',
				'value' => array(),
				'label' => __('Icon image', 'creatus'),
				'desc' => esc_html__('Upload or select icon image. This option has precedence over the icon option above.', 'creatus'),
				'images_only' => true
			),
			'cmx' => _thz_container_metrics_defaults()
		)
	),
	'icontextsettings' => array(
		'title' => __('Text', 'creatus'),
		'type' => 'tab',
		'lazy_tabs' => false,
		'options' => array(
			'ict' => array(
				'type' => 'addable-popup',
				'value' => array(),
				'label' => __('Icon text', 'creatus'),
				'desc' => esc_html__('Add icon text.', 'creatus'),
				'template' => esc_html__('Icon text is set', 'creatus'),
				'popup-title' => 'Add icon text',
				'size' => 'large',
				'limit' => 1,
				'add-button-text' => esc_html__('Add icon text', 'creatus'),
				'sortable' => false,
				'popup-options' => array(
					'tmx' => array(
						'type' => 'thz-multi-options',
						'label' => __('Text metrics', 'creatus'),
						'desc' => esc_html__('Choose text position and adjust the space between icon and text', 'creatus'),
						'value' => array(
							'p' => 'left',
							's' => 15,
							'v' => ''
						),
						'breakafter' => 'bc',
						'thz_options' => array(
							'p' => array(
								'type' => 'short-select',
								'title' => esc_html__('Position', 'creatus'),
								'attr' => array(
									'class' => 'thz-select-switch'
								),
								'choices' => array(
									'left' => array(
										'text' => esc_html__('Text on the left', 'creatus'),
										'attr' => array(
											'data-enable' => 'text_left,animate_left',
											'data-disable' => 'text_right,animate_right'
										)
									),
									'right' => array(
										'text' => esc_html__('Text on the right', 'creatus'),
										'attr' => array(
											'data-enable' => 'text_right,animate_right',
											'data-disable' => 'text_left,animate_left'
										)
									),
									'both' => array(
										'text' => esc_html__('Left and right', 'creatus'),
										'attr' => array(
											'data-enable' => 'text_left,animate_left,text_right,animate_right'
										)
									)
								)
							),
							's' => array(
								'type' => 'spinner',
								'title' => esc_html__('Side Space', 'creatus'),
								'addon' => 'px',
								'min' > 0
							),
							'v' => array(
								'type' => 'spinner',
								'title' => esc_html__('Vertical Space', 'creatus'),
								'addon' => 'px'
							),
						)
					),

					'text_left' => array(
						'label' => __('Text left', 'creatus'),
						'desc' => esc_html__('Text on the left side of the icon', 'creatus'),
						'type' => 'wp-editor',
						'size' => 'large',
						'editor_height' => 100,
						'editor_type' => 'tinymce',
						'wpautop' => false,
						'shortcodes' => false,
						'value' => esc_html__('On the left.', 'creatus')
					),
					'animate_left' => array(
						'type' => 'thz-animation',
						'label' => false,
						'value' => array(
							'animate' => 'inactive',
							'effect' => 'thz-anim-fadeIn',
							'duration' => 1000,
							'delay' => 0
						),
						'addlabel' => 'Animate left'
					),
					'text_right' => array(
						'label' => __('Text right', 'creatus'),
						'desc' => esc_html__('Text on the right side of the icon', 'creatus'),
						'type' => 'wp-editor',
						'size' => 'large',
						'editor_height' => 100,
						'editor_type' => 'tinymce',
						'wpautop' => false,
						'shortcodes' => false,
						'value' => esc_html__('On the right.', 'creatus')
					),
					'animate_right' => array(
						'type' => 'thz-animation',
						'label' => false,
						'value' => array(
							'animate' => 'inactive',
							'effect' => 'thz-anim-fadeIn',
							'duration' => 1000,
							'delay' => 0
						),
						'addlabel' => 'Animate right'
					)
				)
			)
		)
	),
	'iconshapesettings' => array(
		'title' => __('Background shape', 'creatus'),
		'type' => 'tab',
		'options' => array(
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
						'sh_metrics' => array(
							'type' => 'thz-multi-options',
							'label' => __('Shape metrics', 'creatus'),
							'desc' => esc_html__('Set shape width background, border and space between border and shape', 'creatus'),
							'value' => array(
								'w' => 70,
								'ct' => 'color',
								'bg' => '#fafafa',
								'bg2' => '',
								'bw' => '',
								'bs' => 'solid',
								'bc' => 'color_1',
								'sp' => '',
								'sbg' => '',
								'sh_bs' => '',
							),
							'breakafter' => 'bw',
							'thz_options' => array(
								'w' => array(
									'type' => 'spinner',
									'title' => esc_html__('Shape width', 'creatus'),
									'addon' => 'px'
								),
								'ct' => array(
									'type' => 'short-select',
									'title' => esc_html__('Color type', 'creatus'),
									'attr' => array(
										'class' => 'thz-select-switch'
									),
									'choices' => array(
										'color' => esc_html__('Solid color', 'creatus'),
										'vertical' => esc_html__('Vertical gradient', 'creatus'),
										'horizontal' => esc_html__('Horizontal gradient', 'creatus'),
										'radial' => esc_html__('Radial gradient', 'creatus'),
										'color' => array(
											'text' => esc_html__('Solid color', 'creatus'),
											'attr' => array(
												'data-disable' => '.bg-color-2-parent'
											)
										),
										'vertical' => array(
											'text' => esc_html__('Vertical gradient', 'creatus'),
											'attr' => array(
												'data-enable' => '.bg-color-2-parent'
											)
										),
										'horizontal' => array(
											'text' => esc_html__('Horizontal gradient', 'creatus'),
											'attr' => array(
												'data-enable' => '.bg-color-2-parent'
											)
										),
										'radial' => array(
											'text' => esc_html__('Radial gradient', 'creatus'),
											'attr' => array(
												'data-enable' => '.bg-color-2-parent'
											)
										),
									)
								),
								'bg' => array(
									'type' => 'color',
									'title' => esc_html__('Shape color', 'creatus'),
									'box' => true
								),
								'bg2' => array(
									'type' => 'color',
									'title' => esc_html__('Shape color 2', 'creatus'),
									'box' => true,
									'attr' => array(
										'class' => 'bg-color-2'
									)
								),
								'bw' => array(
									'type' => 'spinner',
									'title' => esc_html__('Border width', 'creatus'),
									'addon' => 'px',
									'min' => 0
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
								'bc' => array(
									'type' => 'color',
									'title' => esc_html__('Border Color', 'creatus'),
									'box' => true
								),
								'sp' => array(
									'type' => 'spinner',
									'title' => esc_html__('Border space', 'creatus'),
									'addon' => 'px',
									'min' => 0
								),
								'sbg' => array(
									'type' => 'color',
									'title' => esc_html__('Space background', 'creatus'),
									'box' => true
								),
								'sh_bs' => array(
									'type' => 'box-style',
									'title' => esc_html__('Box shadow', 'creatus'),
									'button-text' => esc_html__('Edit', 'creatus'),
									'connect' => 'icon_shape-active-sh_bs'
								),
							),
						),
						'sh_bs' => array(
							'type' => 'thz-box-style',
							'label' => __('Adjust .thz-icon-shape box shadow', 'creatus'),
							'preview' => true,
							'button-text' => esc_html__('Customize box shadow', 'creatus'),
							'desc' => esc_html__('Adjust .thz-icon-shape box shadow', 'creatus'),
							'popup' => true,
							'disable' => array('layout','borders','background','padding','margin','borderradius','boxsize','transform'),
							'value' => array()
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
									'value' => 'circle',
									'inline' => true,
									'choices' => array(
										'circle' => esc_html__('Circle', 'creatus'),
										'square' => esc_html__('Square', 'creatus'),
										'rounded' => esc_html__('Rounded', 'creatus')
									)
								)
							),
							'choices' => array(
								'rounded' => array(
									'radius' => array(
										'type' => 'thz-spinner',
										'addon' => 'px',
										'min' => 2,
										'max' => 800,
										'value' => 8,
										'label' => __('Border radius', 'creatus'),
										'desc' => esc_html__('Set shape border radius', 'creatus')
									)
								)
							)
						),
						'nudge' => array(
							'type' => 'thz-box-style',
							'desc' => esc_html__('Nudge icon. All values must be entered for style to be applied.', 'creatus'),
							'help' => esc_html__('By default icons inside the shape are centered but some icons visualy appear as out of line. See play borderless icon for instance. This option helps you move the icon inside the shape and this way adjust the appearance. If you need to pull the icon up, use negative top value.', 'creatus'),
							'disable' => array(
								'layout',
								'padding',
								'borders',
								'borderradius',
								'boxsize',
								'transform',
								'boxshadow',
								'background'
							),
							'value' => array()
						),
						'effect' => array(
							'type' => 'thz-multi-options',
							'label' => __('Hover effects', 'creatus'),
							'desc' => esc_html__('Select shape hover effect', 'creatus'),
							'value' => array(
								'type' => 'none',
								'color' => 'color_1',
								'icon_color' => '#ffffff',
								'icon_color2' => '',
								'background' => 'color_1'
							),
							'thz_options' => array(
								'type' => array(
									'type' => 'short-select',
									'title' => esc_html__('Effect', 'creatus'),
									'attr' => array(
										'class' => 'thz-select-switch'
									),
									'choices' => array(
										'none' => array(
											'text' => esc_html__('No effect', 'creatus'),
											'attr' => array(
												'data-disable' => '.effect-color-parent,.effect-icon-color-parent,.effect-icon-background-parent,.effect-icon-color2-parent',
											)
										),
										'justhover' => array(
											'text' => esc_html__('Just hover', 'creatus'),
											'attr' => array(
												'data-enable' => '.effect-color-parent,.effect-icon-color-parent',
												'data-disable' => '.effect-icon-background-parent',
												'data-check' =>'.thz-color-mode'
											)
										),
										'halo' => array(
											'text' => esc_html__('Halo', 'creatus'),
											'attr' => array(
												'data-enable' => '.effect-color-parent,.effect-icon-color-parent,.effect-icon-background-parent',
												'data-check' =>'.thz-color-mode'
											)
										),
										'sonar' => array(
											'text' => esc_html__('Sonar', 'creatus'),
											'attr' => array(
												'data-enable' => '.effect-color-parent',
												'data-disable' => '.effect-icon-color-parent,.effect-icon-background-parent,.effect-icon-color2-parent',
											)
										),
										'pulsate' => array(
											'text' => esc_html__('Pulsate', 'creatus'),
											'attr' => array(
												'data-enable' => '.effect-color-parent',
												'data-disable' => '.effect-icon-color-parent,.effect-icon-background-parent,.effect-icon-color2-parent',
											)
										),
										'spinme' => array(
											'text' => esc_html__('Spinme', 'creatus'),
											'attr' => array(
												'data-enable' => '.effect-icon-color-parent,.effect-icon-background-parent',
												'data-disable' => '.effect-color-parent',
												'data-check' =>'.thz-color-mode'
											)
										),
										'fillup' => array(
											'text' => esc_html__('Fill up', 'creatus'),
											'attr' => array(
												'data-enable' => '.effect-color-parent,.effect-icon-color-parent',
												'data-disable' => '.effect-icon-background-parent',
												'data-check' =>'.thz-color-mode'
											)
										),
										'filldown' => array(
											'text' => esc_html__('Fill down', 'creatus'),
											'attr' => array(
												'data-enable' => '.effect-color-parent,.effect-icon-color-parent',
												'data-disable' => '.effect-icon-background-parent',
												'data-check' =>'.thz-color-mode'
											)
										),
										'fillleft' => array(
											'text' => esc_html__('Fill left', 'creatus'),
											'attr' => array(
												'data-enable' => '.effect-color-parent,.effect-icon-color-parent',
												'data-disable' => '.effect-icon-background-parent',
												'data-check' =>'.thz-color-mode'
											)
										),
										'fillright' => array(
											'text' => esc_html__('Fill right', 'creatus'),
											'attr' => array(
												'data-enable' => '.effect-color-parent,.effect-icon-color-parent',
												'data-disable' => '.effect-icon-background-parent',
												'data-check' =>'.thz-color-mode'
											)
										)
									)
								),
								'color' => array(
									'type' => 'color',
									'title' => esc_html__('Effect color', 'creatus'),
									'box' => true,
									'attr' => array(
										'class' => 'effect-color'
									)
								),
								'icon_color' => array(
									'type' => 'color',
									'title' => esc_html__('Icon color', 'creatus'),
									'box' => true,
									'attr' => array(
										'class' => 'effect-icon-color'
									)
								),
								'icon_color2' => array(
									'type' => 'color',
									'title' => esc_html__('Icon color 2', 'creatus'),
									'box' => true,
									'attr' => array(
										'class' => 'effect-icon-color2'
									)
								),
								'background' => array(
									'type' => 'color',
									'title' => esc_html__('Icon background', 'creatus'),
									'box' => true,
									'attr' => array(
										'class' => 'effect-icon-background'
									)
								)
							)
						)
					)
				)
			)
		)
	),
	
	'iconeffects' => array(
		'title' => __('Effects', 'creatus'),
		'type' => 'tab',
		'options' => array(
			'animate' => array(
				'type' => 'thz-animation',
				'label' => false,
				'draw' => true,
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