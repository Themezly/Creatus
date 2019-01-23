<?php
if (!defined('FW')) {
	die('Forbidden');
}
$options = array(
	'iconboxsettings' => array(
		'title' => __('Defaults', 'creatus'),
		'type' => 'tab',
		'options' => array(
			'id' => array(
				'type' => 'unique',
				'length' => 8
			),
			'boxstyle' => array(
				'type' => 'thz-box-style',
				'label' => __('Box style', 'creatus'),
				'preview' => true,
				'desc' => esc_html__('Adjust .thz-icon-box box style', 'creatus'),
				'button-text' => esc_html__('Customize box style', 'creatus'),
				'popup' => true,
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
			'cmx' => _thz_container_metrics_defaults(),
			'instyle' => array(
				'type' => 'short-text',
				'label' => __('Inherit style from', 'creatus'),
				'desc' => esc_html__('Insert icon box ID to inherit the style from. See help for more info.', 'creatus'),
				'help' => esc_html__('If you have multiple Icon boxes with same style you can set main icon box Custom ID than add that ID here. This way every icon box on this page with this inherit ID will use same CSS. This reduces the overhead CSS and renders the icon box faster. Note that once the inherit ID is added the CSS for this icon box is not printed. The effects must be set on per element basis.', 'creatus'),
				'value' => ''
			),
		)
	),
	'iconsettings' => array(
		'title' => __('Icon', 'creatus'),
		'type' => 'tab',
		'options' => array(
			'icon_metrics' => array(
				'type' => 'thz-multi-options',
				'label' => __('Icon metrics', 'creatus'),
				'desc' => esc_html__('Adjust icon metrics. Color is not applicable if your are using own icon image.', 'creatus'),
				'help' => esc_html__('SVG color modes are used only if SVG Icon image is selected. Icon color is than applied to the SVG selection. To enable WordPress SVG uploads please use 3rd party plugin that allows this feature.', 'creatus'),
				'value' => array(
					'icon' => 'fa fa-rocket',
					'size' => 28,
					'position' => 'center',
					'valign' => 'thz-va-middle',
					'mode' => 'color',
					'color' => 'color_1',
					'color2' => '',
				),
				'thz_options' => array(
					'icon' => array(
						'type' => 'icon',
						'title' => esc_html__('Icon', 'creatus')
					),
					'size' => array(
						'type' => 'spinner',
						'title' => esc_html__('Size', 'creatus'),
						'addon' => 'px'
					),
					'position' => array(
						'type' => 'short-select',
						'title' => esc_html__('Position', 'creatus'),
						'attr' => array(
							'class' => 'thz-select-switch'
						),
						'choices' => array(
							'topleft' => array(
								'text' => esc_html__('Above heading left', 'creatus'),
								'attr' => array(
									'data-disable' => '.poz-v-align-parent'
								)
							),
							'topright' => array(
								'text' => esc_html__('Above heading right', 'creatus'),
								'attr' => array(
									'data-disable' => '.poz-v-align-parent'
								)
							),
							'center' => array(
								'text' => esc_html__('Above heading centered', 'creatus'),
								'attr' => array(
									'data-disable' => '.poz-v-align-parent'
								)
							),
							'centertop' => array(
								'text' => esc_html__('Half above the box', 'creatus'),
								'attr' => array(
									'data-disable' => '.poz-v-align-parent'
								)
							),
							
							'left' => array(
								'text' => esc_html__('Left of the text', 'creatus'),
								'attr' => array(
									'data-enable' => '.poz-v-align-parent'
								)
							),
							
							'leftheading' => array(
								'text' => esc_html__('Left of the heading', 'creatus'),
								'attr' => array(
									'data-enable' => '.poz-v-align-parent'
								)
							),
							'right' => array(
								'text' => esc_html__('Right of the text', 'creatus'),
								'attr' => array(
									'data-enable' => '.poz-v-align-parent'
								)
							),
							'rightheading' => array(
								'text' => esc_html__('Right of the heading', 'creatus'),
								'attr' => array(
									'data-enable' => '.poz-v-align-parent'
								)
							),
						)
					),
					'valign' => array(
						'type' => 'short-select',
						'title' => esc_html__('V-align', 'creatus'),
						'attr' => array(
							'class' => 'poz-v-align'
						),
						'choices' => array(
							'thz-va-top' => esc_html__('Top', 'creatus'),
							'thz-va-middle' => esc_html__('Middle', 'creatus'),
							'thz-va-bottom' => esc_html__('Bottom', 'creatus')
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
									'data-disable' => '.ic-color-2-parent,.effect-icon-color2-parent'
								)
							),
							'vertical' => array(
								'text' => esc_html__('Vertical gradient', 'creatus'),
								'attr' => array(
									'data-enable' => '.ic-color-2-parent,.effect-icon-color2-parent'
								)
							),
							'horizontal' => array(
								'text' => esc_html__('Horizontal gradient', 'creatus'),
								'attr' => array(
									'data-enable' => '.ic-color-2-parent,.effect-icon-color2-parent'
								)
							),
							'radial' => array(
								'text' => esc_html__('Radial gradient', 'creatus'),
								'attr' => array(
									'data-enable' => '.ic-color-2-parent,.effect-icon-color2-parent'
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
				)
			),
			'iconimg' => array(
				'type' => 'upload',
				'value' => array(),
				'label' => __('Icon image', 'creatus'),
				'desc' => esc_html__('Upload or select icon image. This option has precedence over the icon option above.', 'creatus'),
				'images_only' => true
			),
			'icon_bs' => array(
				'type' => 'thz-box-style',
				'label' => __('Icon padding', 'creatus'),
				'desc' => esc_html__('Set icon container .thz-icon-holder padding.', 'creatus'),
				'preview' => false,
				'popup' => false,
				'disable' => array(
					'layout',
					'margin',
					'borders',
					'borderradius',
					'boxsize',
					'transform',
					'boxshadow',
					'background'
				),
				'value' => array()
			),
		)
	),
	'iconboxshapesettings' => array(
		'title' => __('Icon shape', 'creatus'),
		'type' => 'tab',
		'lazy_tabs' => false,
		'options' => array(
			'icon_shape' => array(
				'type' => 'multi-picker',
				'label' => false,
				'desc' => false,
				'show_borders'=> true,
				'picker' => array(
					'picked' => array(
						'label' => __('Icon background shape', 'creatus'),
						'desc' => esc_html__('If active, this icon will be placed inside a adjustable container.', 'creatus'),
						'type' => 'switch',
						'right-choice' => array(
							'value' => 'active',
							'label' => __('Active', 'creatus')
						),
						'left-choice' => array(
							'value' => 'inactive',
							'label' => __('Inactive', 'creatus')
						),
						'value' => 'active'
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
							)
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
							'desc' => esc_html__('Nudge .thz-icon-shape i', 'creatus'),
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
					) // active end 
				) // choices end
			)
		)
	),
	'iconboxtextsettings' => array(
		'title' => __('Text', 'creatus'),
		'type' => 'tab',
		'options' => array(
			'heading' => array(
				'type' => 'text',
				'label' => __('Heading', 'creatus'),
				'desc' => esc_html__('Icon box heading', 'creatus'),
				'value' => esc_html__('Hello I am icon box', 'creatus')
			),
			'text' => array(
				'label' => __('Text', 'creatus'),
				'desc' => esc_html__('Set icon box text', 'creatus'),
				'type' => 'wp-editor',
				'size' => 'large',
				'editor_height' => 100,
				'editor_type' => 'tinymce',
				'wpautop' => true,
				'shortcodes' => true,
				'value' => esc_html__('Pellentesque egestas dignissim quam vel pretium. Fusce elementum suspendum.', 'creatus')
			),
			'heading_padding' => array(
				'type' => 'thz-box-style',
				'label' => __('Heading padding', 'creatus'),
				'desc' => esc_html__('Set heading padding. All values must be entered for style to be applied.', 'creatus'),
				'preview' => false,
				'popup' => false,
				'disable' => array(
					'layout',
					'margin',
					'borders',
					'borderradius',
					'boxsize',
					'transform',
					'boxshadow',
					'background'
				),
				'value' => array()
			),
			'font_metrics' => array(
				'type' => 'thz-typography',
				'label' => __('Heading font metrics', 'creatus'),
				'desc' => esc_html__('Adjust heading font metrics.', 'creatus'),
				'value' => array(
					'size' => 18,
				),
				'disable' => array('hovered'),
			),
			'tfm' => array(
				'type' => 'thz-typography',
				'label' => __('Text font metrics', 'creatus'),
				'desc' => esc_html__('Adjust text font metrics.', 'creatus'),
				'value' => array(),
				'disable' => array('hovered'),
			),
		)
	),
	'iconboxbuttonsettings' => array(
		'title' => __('Link', 'creatus'),
		'type' => 'tab',
		'options' => array(
			'iconbox_link' => array(
				'type' => 'thz-url',
				'value' => array(
					'type' => 'normal',
					'url' => '',
					'title' => '',
					'target' => '_self',
					'magnific' => ''
				),
				'data-parent' => '.media-frame-content',
				'data-type' => '.thz-url-type,.linkType',
				'data-link' => '.thz-url-input,.normalLink',
				'data-title' => '.thz-url-title,.linkTitle',
				'data-target' => '.thz-url-target,.linkTarget',
				'data-magnific' => '.thz-url-magnific,.magnificId',
				'label' => __('Add url', 'creatus')
			),
			'apply_link' => array(
				'label' => __('Apply link to', 'creatus'),
				'desc' => esc_html__('Select where this link should be applied', 'creatus'),
				'type' => 'select',
				'value' => 'title',
				'attr' => array(
					'class' => 'thz-select-switch'
				),
				'choices' => array(
					'title' => array(
						'text' => esc_html__('Icon box title', 'creatus'),
						'attr' => array(
							'data-disable' => 'iconbox_button',
							'data-enable' => 'ovl_mx'
						)
					),
					'button' => array(
						'text' => esc_html__('Icon box button', 'creatus'),
						'attr' => array(
							'data-disable' => 'ovl_mx',
							'data-enable' => 'iconbox_button'
						)
					),
					'both' => array(
						'text' => esc_html__('Icon box title and button', 'creatus'),
						'attr' => array(
							'data-disable' => 'ovl_mx',
							'data-enable' => 'iconbox_button'
						)
					)
				)
			),

			'ovl_mx' => array(
				'type' => 'thz-multi-options',
				'label' => __('Over link', 'creatus'),
				'desc' => __('Activate/deactivate a link that covers the entire icon box', 'creatus'),
				'value' => array(
					'm' => 'inactive',
					'a' => 'anchor',
				),
				'thz_options' => array(
					'm' => array(
						'type' => 'short-select',
						'title' => __('Mode', 'creatus'),
						'attr' => array(
							'class' => 'thz-select-switch'
						),
						'choices' => array(
							'inactive' => __('Inactive', 'creatus'),
							'active' => __('Active', 'creatus'),
						),
						'choices' => array(
							'inactive' => array(
								'text' => esc_html__('Inactive', 'creatus'),
								'attr' => array(
									'data-disable' => '.ovl-anch-parent',
								)
							),
							'active' => array(
								'text' => esc_html__('Active', 'creatus'),
								'attr' => array(
									'data-enable' => '.ovl-anch-parent'
								)
							)
						)
					),
					'a' => array(
						'type' => 'select',
						'title' => __('Title anchor markup', 'creatus'),
						'attr' => array(
							'class' => 'ovl-anch'
						),
						'choices' => array(
							'remove' => __('Remove', 'creatus'),
							'anchor' => __('Leave anchor', 'creatus'),
						)
					),
				)
			),	

			'iconbox_button' => array(
				'type' => 'thz-button',
				'value' => array(
					'json' => '{"buttonText":"Read more","activeColor":"theme","buttonSizeClass":"normal","marginTop":25}'
				),
				'attr' => array(
					'class' => 'thz-iconbox-button'
				),
				'label' => false,
				'hidelinks' => true
			)
		) // end tab options
	), // end button tab
	'iconboxhoveredsettings' => array(
		'title' => __('Hovered', 'creatus'),
		'type' => 'tab',
		'lazy_tabs' => false,
		'options' => array(
			'hover_trigger' => array(
				'label' => __('Hover trigger', 'creatus'),
				'desc' => esc_html__('Choose when to trigger hover effects.', 'creatus'),
				'help' => esc_html__('Normaly hover effects are triggered when you place your mouse over the element. This setting will let you trigger the hover for all elements inside the icon box when you place the moue over the icon box. Note that element hover is not effective if icon box over link is enabled.', 'creatus'),
				'type' => 'select',
				'value' => 'iconbox',
				'choices' => array(
					'iconbox' => esc_html__('When mouse is over the Icon box', 'creatus'),
					'elements' => esc_html__('When mouse is over the element', 'creatus')
				)
			),
			
			'boxhovered' => array(
				'type' => 'thz-box-style',
				'label' => __('Hovered box style', 'creatus'),
				'preview' => true,
				'desc' => esc_html__('Adjust .thz-icon-box:hover box style', 'creatus'),
				'button-text' => esc_html__('Customize hovered box style', 'creatus'),
				'popup' => true,
				'disable' => array(
					'video'
				),
				'units' => array(
					'borderradius',
					'padding',
					'margin',
				),
				'value' => array()
			),

			'hovered_c' => array(
				'type' => 'thz-multi-options',
				'label' => __('Hovered metrics', 'creatus'),
				'desc' => esc_html__('Adjust hovered icon, headings, text and links colors. See help for more info.', 'creatus'),
				'help' => esc_html__('If shape hover effect is active the hovered icon color here is overwritten by shape hovered settings.', 'creatus'),
				'value' => array(
					'i' => '',
					'i2' => '',
					'h' => '',
					't' => '',
					'l' => ''
				),
				'thz_options' => array(
					'i' => array(
						'type' => 'color',
						'title' => esc_html__('Icon', 'creatus'),
						'box' => true
					),
					'i2' => array(
						'type' => 'color',
						'title' => esc_html__('Icon 2', 'creatus'),
						'box' => true,
						'attr' => array(
							'class' => 'ic-color-2'
						)
					),
					'h' => array(
						'type' => 'color',
						'title' => esc_html__('Headings', 'creatus'),
						'box' => true
					),
					't' => array(
						'type' => 'color',
						'title' => esc_html__('Text', 'creatus'),
						'box' => true
					),
					'l' => array(
						'type' => 'color',
						'title' => esc_html__('Links', 'creatus'),
						'box' => true
					)
				)
			)
		) // hoverd options end
	),
	'iconboxeffects' => array(
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
			'icon_animate' => array(
				'type' => 'thz-animation',
				'label' => false,
				'draw' => true,
				'value' => array(
					'animate' => 'inactive',
					'effect' => 'thz-anim-fadeIn',
					'duration' => 400,
					'delay' => 200
				),
				'addlabel' => esc_html__('Animate icon', 'creatus'),
				'adddesc' => esc_html__('Add animation to the icon HTML container', 'creatus')
			),
			'cpx' => _thz_container_parallax_default()
		)
	)
);