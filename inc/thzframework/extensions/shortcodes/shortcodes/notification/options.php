<?php
if (!defined('FW')) {
	die('Forbidden');
}
$options = array(
	'notificationgeneral' => array(
		'title' => __('General settings', 'creatus'),
		'type' => 'tab',
		'options' => array(
			'id' => array(
				'type' => 'unique',
				'length' => 8
			),
			'close_button' => array(
				'label' => __('Show close button?', 'creatus'),
				'desc' => esc_html__('Show/hide the close button', 'creatus'),
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
			),
			'cmx' => _thz_container_metrics_defaults()
		)
	),
	'notificationtext' => array(
		'title' => __('Notfication', 'creatus'),
		'type' => 'tab',
		'options' => array(
			'mx' => array(
				'type' => 'thz-multi-options',
				'label' => __('Notification metrics', 'creatus'),
				'desc' => esc_html__('Set notification title, tag and alignment.', 'creatus'),
				'value' => array(
					'title' => 'Notification title',
					'tag' => 'h3',
					'align' => 'thz-align-left'
				),
				'thz_options' => array(
					'title' => array(
						'type' => 'text',
						'title' => esc_html__('Title', 'creatus')
					),
					'tag' => array(
						'type' => 'short-select',
						'title' => esc_html__('Title Tag', 'creatus'),
						'choices' => array(
							'h1' => 'H1',
							'h2' => 'H2',
							'h3' => 'H3',
							'h4' => 'H4',
							'h5' => 'H5',
							'h6' => 'H6',
							'div' => 'div'
						)
					),
					'align' => array(
						'type' => 'short-select',
						'title' => esc_html__('Text alignment', 'creatus'),
						'choices' => array(
							'thz-align-left' => esc_html__('Left', 'creatus'),
							'thz-align-center' => esc_html__('Center', 'creatus'),
							'thz-align-right' => esc_html__('Right', 'creatus')
						)
					)
				)
			),
			'imx' => array(
				'type' => 'thz-multi-options',
				'label' => __('Notification icon metrics', 'creatus'),
				'desc' => esc_html__('Set notification icon, icon size and vrtical alignment.', 'creatus'),
				'value' => array(
					'icon' => '',
					'size' => 'thz-is-lg',
					'align' => 'thz-va-top'
				),
				'thz_options' => array(
					'icon' => array(
						'type' => 'icon',
						'title' => esc_html__('Icon', 'creatus')
					),
					'size' => array(
						'type' => 'short-select',
						'title' => esc_html__('Size', 'creatus'),
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
					'align' => array(
						'type' => 'short-select',
						'title' => esc_html__('Alignment', 'creatus'),
						'choices' => array(
							'thz-va-top' => esc_html__('Top', 'creatus'),
							'thz-va-middle' => esc_html__('Middle', 'creatus'),
							'thz-va-bottom' => esc_html__('Bottom', 'creatus')
						)
					)
				)
			),
			'notification' => array(
				'label' => __('Text', 'creatus'),
				'desc' => esc_html__('Notification text', 'creatus'),
				'type' => 'wp-editor',
				'size' => 'large',
				'editor_height' => 100,
				'editor_type' => 'tinymce',
				'wpautop' => false,
				'shortcodes' => false,
				'value' => esc_html__('This is dummy notification text. Please replace it.', 'creatus')
			)
		)
	),
	'notificationstyling' => array(
		'title' => __('Styling', 'creatus'),
		'type' => 'tab',
		'options' => array(
			'style' => array(
				'type' => 'multi-picker',
				'label' => false,
				'desc' => false,
				'picker' => array(
					'picked' => array(
						'label' => 'Notification style type',
						'type' => 'switch',
						'right-choice' => array(
							'value' => 'predefined',
							'label' => __('Predefined', 'creatus')
						),
						'left-choice' => array(
							'value' => 'custom',
							'label' => __('Custom', 'creatus')
						),
						'value' => 'predefined',
						'desc' => esc_html__('Select notification style type', 'creatus')
					)
				),
				'choices' => array(
					'predefined' => array(
						'mx' => array(
							'type' => 'thz-multi-options',
							'label' => __('Notification style', 'creatus'),
							'desc' => esc_html__('Set notification style.', 'creatus'),
							'value' => array(
								'c' => 'blue',
								'b' => 'bordernone',
								'br' => ''
							),
							'thz_options' => array(
								'c' => array(
									'type' => 'short-select',
									'title' => esc_html__('Color', 'creatus'),
									'choices' => array(
										'red' => esc_html__('Red', 'creatus'),
										'green' => esc_html__('Green', 'creatus'),
										'blue' => esc_html__('Blue', 'creatus'),
										'yellow' => esc_html__('Yellow', 'creatus'),
										'gray' => esc_html__('Gray', 'creatus'),
										'dark' => esc_html__('Dark', 'creatus'),
										'clear' => esc_html__('Clear', 'creatus')
									)
								),
								'b' => array(
									'type' => 'short-select',
									'title' => esc_html__('Border style', 'creatus'),
									'choices' => array(
										'default' => esc_html__('Solid', 'creatus'),
										'bordernone' => esc_html__('None', 'creatus'),
										'dashedb' => esc_html__('Dashed', 'creatus'),
										'dottedb' => esc_html__('Dotted', 'creatus'),
										'doubleb' => esc_html__('Double', 'creatus'),
									)
								),
								'br' => array(
									'type' => 'spinner',
									'title' => esc_html__('Border radius', 'creatus'),
									'addon' => 'px',
									'min' => 0,
									'max' => 50
								)
							)
						)
					),
					'custom' => array(
						'bs' => array(
							'type' => 'thz-box-style',
							'label' => __('Notification box style', 'creatus'),
							'preview' => true,
							'popup' => true,
							'button-text' => esc_html__('Customize notification box style', 'creatus'),
							'desc' => esc_html__('Adjust .thz-notification box style.', 'creatus'),
							'disable' => array(
								'video',
								'layout',
								'transform',
								'boxsize'
							),
							'units' => array(
								'borderradius',
								'boxsize',
								'padding',
								'margin',
							),
							'value' => array()
						),
						'colors' => array(
							'type' => 'thz-multi-options',
							'label' => __('Notification colors', 'creatus'),
							'desc' => esc_html__('Set notification colors. See help for more info', 'creatus'),
							'help' => sprintf(esc_html__('Accent: This is color for notification title, icon and close button%1$sText: This is notification text color%1$sLink: Set default color for notification links%1$sLink hovered: Set hovered link color', 'creatus'), '<br />'),
							'value' => array(
								'a' => 'color_1',
								't' => fw_get_db_settings_option('body_font/color', '#444444'),
								'l' => 'color_1',
								'lh' => 'color_2'
							),
							'thz_options' => array(
								'a' => array(
									'type' => 'color',
									'title' => esc_html__('Accent', 'creatus'),
									'box' => true
								),
								't' => array(
									'type' => 'color',
									'title' => esc_html__('Text', 'creatus'),
									'box' => true
								),
								'l' => array(
									'type' => 'color',
									'title' => esc_html__('Link', 'creatus'),
									'box' => true
								),
								'lh' => array(
									'type' => 'color',
									'title' => esc_html__('Link hovered', 'creatus'),
									'box' => true
								)
							)
						)
					)
				),
				'show_borders' => false
			),
			
			'bs' => array(
				'type' => 'thz-box-style',
				'label' => __('Container box style', 'creatus'),
				'preview' => true,
				'button-text' => esc_html__('Customize container box style', 'creatus'),
				'desc' => esc_html__('Adjust .thz-notification-container box style', 'creatus'),
				'popup' => true,
				'disable' => array(
					'video',
				),
				'value' => array()
			),
		)
	),
	
	'notificationeffects' => array(
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