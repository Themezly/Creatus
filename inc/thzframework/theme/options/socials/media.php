<?php
if (!defined('FW'))
	die('Forbidden');
$options = array(
	'thz_sl' => array(
		'type' => 'addable-popup',
		'label' => __('Social media links', 'creatus'),
		'desc' => esc_html__('Click to add new social media link. Drag and drop to reorder.', 'creatus'),
		'template' => '{{- name }}',
		'popup-title' => null,
		'size' => 'large',
		'value' => array(),
		'popup-options' => array(
			'defaultstab' => array(
				'title' => __('Defaults', 'creatus'),
				'type' => 'tab',
				'lazy_tabs'=> false,
				'options' => array(
					'name' => array(
						'label' => __('Website name', 'creatus'),
						'type' => 'text',
						'value' => '',
						'desc' => esc_html__('Social website name.eg:Facebook', 'creatus'),
						'help' => esc_html__('This option is used in a social link tooltip so you can do something like; Visit us on Facebook', 'creatus')
					),
					'icon' => array(
						'type' => 'thz-icon',
						'value' => '',
						'label' => __('Social icon', 'creatus'),
					),
					'link' => array(
						'label' => __('Social Link', 'creatus'),
						'type' => 'text',
						'value' => '',
						'desc' => esc_html__('Social website link.eg: http://www.facebook.com/themezly', 'creatus')
					),
					'inmenu' => array(
						'label' => __('In menus', 'creatus'),
						'desc' => __('Show/hide this social icon in header menus', 'creatus'),
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
					),
					
					'showin' => array(
						'type' => 'thz-multi-options',
						'label' => __('Where to show', 'creatus'),
						'desc' => __('Show/hide this social icon in specific positions', 'creatus'),
						'value' => array(
							'm' => 'show',
							't' => 'show',
							'f' => 'show'
						),
						'thz_options' => array(
						
							'm' => array(
								'type' => 'short-select',
								'title' => esc_html__('Header menus', 'creatus'),
								'choices' => array(
									'show' => esc_html__('Show', 'creatus'),
									'hide' => esc_html__('Hide', 'creatus'),
								),
							),
							
							't' => array(
								'type' => 'short-select',
								'title' => esc_html__('Toolbar', 'creatus'),
								'choices' => array(
									'show' => esc_html__('Show', 'creatus'),
									'hide' => esc_html__('Hide', 'creatus'),
								),
							),
							
							'f' => array(
								'type' => 'short-select',
								'title' => esc_html__('Footer', 'creatus'),
								'choices' => array(
									'show' => esc_html__('Show', 'creatus'),
									'hide' => esc_html__('Hide', 'creatus'),
								),
							),

						)
					),
					
					
				)
			),
			'styletab' => array(
				'title' => __('Style', 'creatus'),
				'type' => 'tab',
				'lazy_tabs'=> false,
				'options' => array(
					'tc' => array(
						'type' => 'thz-multi-options',
						'label' => __('Toolbar icon colors', 'creatus'),
						'desc' => esc_html__('Set header toolbar icon colors. Leave empty for default site link color', 'creatus'),
						'help' => esc_html__('Style color is used depending on the icon style. If outline, color is used for shape outline border if flat, color is used as shape background color', 'creatus'),
						'value' => array(
							'l' => '',
							'h' => '',
							's' => '',
							'sh' => ''
						),
						'thz_options' => array(
							'l' => array(
								'type' => 'color',
								'title' => esc_html__('Color', 'creatus'),
								'box' => true
							),
							'h' => array(
								'type' => 'color',
								'title' => esc_html__('Hovered', 'creatus'),
								'box' => true
							),
							's' => array(
								'type' => 'color',
								'title' => esc_html__('Style color', 'creatus'),
								'box' => true
							),
							'sh' => array(
								'type' => 'color',
								'title' => esc_html__('Style hovered', 'creatus'),
								'box' => true
							)
						)
					),
					'fc' => array(
						'type' => 'thz-multi-options',
						'label' => __('Footer icon colors', 'creatus'),
						'desc' => esc_html__('Set footer icon colors. Leave empty for default site link color', 'creatus'),
						'help' => esc_html__('Style color is used depending on the icon style. If outline, color is used for shape outline border if flat, color is used as shape background color', 'creatus'),
						'value' => array(
							'l' => '',
							'h' => '',
							's' => '',
							'sh' => ''
						),
						'thz_options' => array(
							'l' => array(
								'type' => 'color',
								'title' => esc_html__('Color', 'creatus'),
								'box' => true
							),
							'h' => array(
								'type' => 'color',
								'title' => esc_html__('Hovered', 'creatus'),
								'box' => true
							),
							's' => array(
								'type' => 'color',
								'title' => esc_html__('Style color', 'creatus'),
								'box' => true
							),
							'sh' => array(
								'type' => 'color',
								'title' => esc_html__('Style hovered', 'creatus'),
								'box' => true
							)
						)
					),
					
					
					'lc' => array(
						'type' => 'thz-multi-options',
						'label' => __('Lateral header colors', 'creatus'),
						'desc' => esc_html__('Set lateral header icon colors. Leave empty for default site link color', 'creatus'),
						'help' => esc_html__('Style color is used depending on the icon style. If outline, color is used for shape outline border if flat, color is used as shape background color', 'creatus'),
						'value' => array(
							'l' => '',
							'h' => '',
							's' => '',
							'sh' => ''
						),
						'thz_options' => array(
							'l' => array(
								'type' => 'color',
								'title' => esc_html__('Color', 'creatus'),
								'box' => true
							),
							'h' => array(
								'type' => 'color',
								'title' => esc_html__('Hovered', 'creatus'),
								'box' => true
							),
							's' => array(
								'type' => 'color',
								'title' => esc_html__('Style color', 'creatus'),
								'box' => true
							),
							'sh' => array(
								'type' => 'color',
								'title' => esc_html__('Style hovered', 'creatus'),
								'box' => true
							)
						)
					)
					
				)
			)
		)
	),
	
	'tsim' => array(
		'type' => 'thz-multi-options',
		'label' => __('Toolbar icons', 'creatus'),
		'desc' => esc_html__('Adjust header toolbar icons metrics', 'creatus'),
		'help' => esc_html__('Style color is used depending on the icon style. If outline, color is used for shape outline border, if flat, color is used as shape background color. Each icon color setting will overide colors set here.', 'creatus'),
		'value' => array(
			'f' => 14,
			's' => 'simple',
			'sh' => 'square',
			'r' => 2,
			'dl' => '',
			'dh' => '',
			'ds' => '',
			'dsh' => ''
		),
		'breakafter' => 'r',
		'thz_options' => array(
			'f' => array(
				'type' => 'spinner',
				'title' => esc_html__('Icon size', 'creatus'),
				'addon' => 'px',
				'min' => 0,
				'max' => 100
			),
			's' => array(
				'type' => 'short-select',
				'title' => esc_html__('Style', 'creatus'),
				'attr' => array(
					'class' => 'thz-select-switch'
				),
				'choices' => array(
					'simple' => array(
						'text' => esc_html__('Simple', 'creatus'),
						'attr' => array(
							'data-disable' => '.tol-s-sh-parent,.tol-s-r-parent,.tol-s-ds-parent,.tol-s-dsh-parent'
						)
					),
					'outline' => array(
						'text' => esc_html__('Outline', 'creatus'),
						'attr' => array(
							'data-enable' => '.tol-s-sh-parent,.tol-s-r-parent,.tol-s-ds-parent,.tol-s-dsh-parent'
						)
					),
					'flat' => array(
						'text' => esc_html__('Flat', 'creatus'),
						'attr' => array(
							'data-enable' => '.tol-s-sh-parent,.tol-s-r-parent,.tol-s-ds-parent,.tol-s-dsh-parent'
						)
					)
				)
			),
			'sh' => array(
				'type' => 'short-select',
				'title' => esc_html__('Shape', 'creatus'),
				'choices' => array(
					'circle' => esc_html__('Circle', 'creatus'),
					'square' => esc_html__('Square', 'creatus'),
					'rounded' => esc_html__('Rounded', 'creatus')
				),
				'attr' => array(
					'class' => 'tol-s-sh'
				),
			),
			'r' => array(
				'type' => 'spinner',
				'title' => esc_html__('Shape ratio', 'creatus'),
				'addon' => 'X',
				'attr' => array(
					'class' => 'tol-s-r'
				),
			),
			'dl' => array(
				'type' => 'color',
				'title' => esc_html__('Color', 'creatus'),
				'box' => true
			),
			'dh' => array(
				'type' => 'color',
				'title' => esc_html__('Hovered', 'creatus'),
				'box' => true
			),
			'ds' => array(
				'type' => 'color',
				'title' => esc_html__('Style color', 'creatus'),
				'box' => true,
				'attr' => array(
					'class' => 'tol-s-ds'
				),
			),
			'dsh' => array(
				'type' => 'color',
				'title' => esc_html__('Style hovered', 'creatus'),
				'box' => true,
				'attr' => array(
					'class' => 'tol-s-dsh'
				),
			)
		)
	),
	'fsim' => array(
		'type' => 'thz-multi-options',
		'label' => __('Footer icons', 'creatus'),
		'desc' => esc_html__('Adjust footer icons metrics', 'creatus'),
		'help' => esc_html__('Style color is used depending on the icon style. If outline, color is used for shape outline border, if flat, color is used as shape background color. Each icon color setting will overide colors set here.', 'creatus'),
		'value' => array(
			'f' => 14,
			's' => 'simple',
			'sh' => 'square',
			'r' => 2,
			'dl' => '',
			'dh' => '',
			'ds' => '',
			'dsh' => ''
		),
		'breakafter' => 'r',
		'thz_options' => array(
			'f' => array(
				'type' => 'spinner',
				'title' => esc_html__('Icon size', 'creatus'),
				'addon' => 'px',
				'min' => 0,
				'max' => 100
			),
			's' => array(
				'type' => 'short-select',
				'title' => esc_html__('Style', 'creatus'),
				'attr' => array(
					'class' => 'thz-select-switch'
				),
				'choices' => array(
					'simple' => array(
						'text' => esc_html__('Simple', 'creatus'),
						'attr' => array(
							'data-disable' => '.foo-s-sh-parent,.foo-s-r-parent,.foo-s-ds-parent,.foo-s-dsh-parent'
						)
					),
					'outline' => array(
						'text' => esc_html__('Outline', 'creatus'),
						'attr' => array(
							'data-enable' => '.foo-s-sh-parent,.foo-s-r-parent,.foo-s-ds-parent,.foo-s-dsh-parent'
						)
					),
					'flat' => array(
						'text' => esc_html__('Flat', 'creatus'),
						'attr' => array(
							'data-enable' => '.foo-s-sh-parent,.foo-s-r-parent,.foo-s-ds-parent,.foo-s-dsh-parent'
						)
					)
				)
			),
			'sh' => array(
				'type' => 'short-select',
				'title' => esc_html__('Shape', 'creatus'),
				'attr' => array(
					'class' => 'foo-s-sh'
				),
				'choices' => array(
					'circle' => esc_html__('Circle', 'creatus'),
					'square' => esc_html__('Square', 'creatus'),
					'rounded' => esc_html__('Rounded', 'creatus')
				)
			),
			'r' => array(
				'type' => 'spinner',
				'title' => esc_html__('Shape ratio', 'creatus'),
				'addon' => 'X',
				'attr' => array(
					'class' => 'foo-s-r'
				),
			),
			'dl' => array(
				'type' => 'color',
				'title' => esc_html__('Color', 'creatus'),
				'box' => true
			),
			'dh' => array(
				'type' => 'color',
				'title' => esc_html__('Hovered', 'creatus'),
				'box' => true
			),
			'ds' => array(
				'type' => 'color',
				'title' => esc_html__('Style color', 'creatus'),
				'box' => true,
				'attr' => array(
					'class' => 'foo-s-ds'
				),
			),
			'dsh' => array(
				'type' => 'color',
				'title' => esc_html__('Style hovered', 'creatus'),
				'box' => true,
				'attr' => array(
					'class' => 'foo-s-dsh'
				),
			)
		)
	),
	
	
	'lsim' => array(
		'type' => 'thz-multi-options',
		'label' => __('Lateral header icons', 'creatus'),
		'desc' => esc_html__('Adjust lateral header icons metrics', 'creatus'),
		'help' => esc_html__('Style color is used depending on the icon style. If outline, color is used for shape outline border, if flat, color is used as shape background color. Each icon color setting will overide colors set here.', 'creatus'),
		'value' => array(
			'f' => 14,
			's' => 'simple',
			'sh' => 'square',
			'r' => 2,
			'dl' => '',
			'dh' => '',
			'ds' => '',
			'dsh' => ''
		),
		'breakafter' => 'r',
		'thz_options' => array(
			'f' => array(
				'type' => 'spinner',
				'title' => esc_html__('Icon size', 'creatus'),
				'addon' => 'px',
				'min' => 0,
				'max' => 100
			),
			's' => array(
				'type' => 'short-select',
				'title' => esc_html__('Style', 'creatus'),
				'attr' => array(
					'class' => 'thz-select-switch'
				),
				'choices' => array(
					'simple' => array(
						'text' => esc_html__('Simple', 'creatus'),
						'attr' => array(
							'data-disable' => '.lat-s-sh-parent,.lat-s-r-parent,.lat-s-ds-parent,.lat-s-dsh-parent'
						)
					),
					'outline' => array(
						'text' => esc_html__('Outline', 'creatus'),
						'attr' => array(
							'data-enable' => '.lat-s-sh-parent,.lat-s-r-parent,.lat-s-ds-parent,.lat-s-dsh-parent'
						)
					),
					'flat' => array(
						'text' => esc_html__('Flat', 'creatus'),
						'attr' => array(
							'data-enable' => '.lat-s-sh-parent,.lat-s-r-parent,.lat-s-ds-parent,.lat-s-dsh-parent'
						)
					)
				)
			),
			'sh' => array(
				'type' => 'short-select',
				'title' => esc_html__('Shape', 'creatus'),
				'choices' => array(
					'circle' => esc_html__('Circle', 'creatus'),
					'square' => esc_html__('Square', 'creatus'),
					'rounded' => esc_html__('Rounded', 'creatus')
				),
				'attr' => array(
					'class' => 'lat-s-sh'
				),
			),
			'r' => array(
				'type' => 'spinner',
				'title' => esc_html__('Shape ratio', 'creatus'),
				'addon' => 'X',
				'attr' => array(
					'class' => 'lat-s-r'
				),
			),
			'dl' => array(
				'type' => 'color',
				'title' => esc_html__('Color', 'creatus'),
				'box' => true
			),
			'dh' => array(
				'type' => 'color',
				'title' => esc_html__('Hovered', 'creatus'),
				'box' => true
			),
			'ds' => array(
				'type' => 'color',
				'title' => esc_html__('Style color', 'creatus'),
				'box' => true,
				'attr' => array(
					'class' => 'lat-s-ds'
				),
			),
			'dsh' => array(
				'type' => 'color',
				'title' => esc_html__('Style hovered', 'creatus'),
				'box' => true,
				'attr' => array(
					'class' => 'lat-s-dsh'
				),
			)
		)
	),	
);