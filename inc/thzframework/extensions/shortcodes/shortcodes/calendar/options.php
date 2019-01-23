<?php
if (!defined('FW')) {
	die('Forbidden');
}
$calendar_shortcode = fw_ext('shortcodes')->get_shortcode('calendar');
$options            = array(
	'calendardefaults' => array(
		'title' => __('Defaults', 'creatus'),
		'type' => 'tab',
		'options' => array(
			'data_provider' => array(
				'type' => 'multi-picker',
				'label' => false,
				'desc' => false,
				'picker' => array(
					'population_method' => array(
						'label' => __('Population Method', 'creatus'),
						'desc' => esc_html__('Select calendar population method (Ex: events, custom)', 'creatus'),
						'type' => 'short-select',
						'choices' => $calendar_shortcode->_get_picker_dropdown_choices()
					)
				),
				'choices' => $calendar_shortcode->_get_picker_choices(),
				'show_borders' => false
			),
			'first_week_day' => array(
				'label' => __('Start Week On', 'creatus'),
				'desc' => esc_html__('Select first day of week', 'creatus'),
				'type' => 'short-select',
				'choices' => array(
					'1' => esc_html__('Monday', 'creatus'),
					'2' => esc_html__('Sunday', 'creatus')
				),
				'value' => 1
			),
			'id' => array(
				'type' => 'unique',
				'length' => 8
			),
			'cmx' => _thz_container_metrics_defaults()
		)
	),
	'calendarstyle' => array(
		'title' => __('Style', 'creatus'),
		'type' => 'tab',
		'options' => array(
			'bs' => array(
				'type' => 'thz-box-style',
				'label' => __('Container box style', 'creatus'),
				'preview' => false,
				'popup' => true,
				'desc' => esc_html__('Adjust .thz-calendar-wrapper box style', 'creatus'),
				'button-text' => __('Container box style', 'creatus'),
				'disable' => array('video'),
				'units' => array(
					'borderradius',
					'boxsize',
					'padding',
					'margin',
				),
				'value' => array()
			),
			'type' => array(
				'type' => 'multi-picker',
				'label' => false,
				'desc' => false,
				'show_borders' => true,
				'picker' => array(
					'picked' => array(
						'label' => __('Calendar Type', 'creatus'),
						'desc' => esc_html__('Select calendar type. See help for more info.', 'creatus'),
						'help' => esc_html__('If custom type is choosen all colors, backrgounds and borders are removed from the calendar. The layout will remain in tact. This way you can CSS it on your own.', 'creatus'),
						'type' => 'short-select',
						'value' => 'month',
						'choices' => array(
							'day' => esc_html__('Daily', 'creatus'),
							'week' => esc_html__('Weekly', 'creatus'),
							'month' => esc_html__('Monthly', 'creatus'),
							'customday' => esc_html__('Custom daily', 'creatus'),
							'custommonth' => esc_html__('Custom monthly', 'creatus'),
							'customweek' => esc_html__('Custom weekly', 'creatus')
						)
					)
				),
				'choices' => array(
					'day' => array(
						'calendar' => array(
							'type' => 'thz-multi-options',
							'label' => __('Calendar', 'creatus'),
							'desc' => esc_html__('Adjust calendar styling.', 'creatus'),
							'value' => array(
								'border_size' => 1,
								'border_style' => 'dashed',
								'border_color' => 'color_4',
								'background' => '#ffffff',
								'color' => 'color_2'
							),
							'thz_options' => array(
								'border_size' => array(
									'type' => 'spinner',
									'title' => esc_html__('Border size', 'creatus'),
									'addon' => 'px',
									'min' => 0,
									'max' => 500
								),
								'border_style' => array(
									'type' => 'short-select',
									'title' => esc_html__('Border style', 'creatus'),
									'choices' => array(
										'solid' => esc_html__('Solid', 'creatus'),
										'dashed' => esc_html__('Dashed', 'creatus'),
										'dotted' => esc_html__('Dotted', 'creatus')
									)
								),
								'border_color' => array(
									'type' => 'color',
									'title' => esc_html__('Border color', 'creatus')
								),
								'background' => array(
									'type' => 'color',
									'title' => esc_html__('Background', 'creatus')
								),
								'color' => array(
									'type' => 'color',
									'title' => esc_html__('Text color', 'creatus')
								)
							)
						),
						'row_even' => array(
							'type' => 'thz-multi-options',
							'label' => __('Row even styling', 'creatus'),
							'desc' => esc_html__('Adjust row even styling.', 'creatus'),
							'value' => array(
								'border_size' => 1,
								'border_style' => 'dashed',
								'border_color' => 'color_4',
								'background' => 'color_5',
								'color' => 'color_2'
							),
							'thz_options' => array(
								'border_size' => array(
									'type' => 'spinner',
									'title' => esc_html__('Border size', 'creatus'),
									'addon' => 'px',
									'min' => 0,
									'max' => 500
								),
								'border_style' => array(
									'type' => 'short-select',
									'title' => esc_html__('Border style', 'creatus'),
									'choices' => array(
										'solid' => esc_html__('Solid', 'creatus'),
										'dashed' => esc_html__('Dashed', 'creatus'),
										'dotted' => esc_html__('Dotted', 'creatus')
									)
								),
								'border_color' => array(
									'type' => 'color',
									'title' => esc_html__('Border color', 'creatus')
								),
								'background' => array(
									'type' => 'color',
									'title' => esc_html__('Background', 'creatus')
								),
								'color' => array(
									'type' => 'color',
									'title' => esc_html__('Text color', 'creatus')
								)
							)
						),
						'row_odd' => array(
							'type' => 'thz-multi-options',
							'label' => __('Row odd styling', 'creatus'),
							'desc' => esc_html__('Adjust row even styling.', 'creatus'),
							'value' => array(
								'border_size' => 1,
								'border_style' => 'dashed',
								'border_color' => 'color4',
								'background' => '#ffffff',
								'color' => 'color_2'
							),
							'thz_options' => array(
								'border_size' => array(
									'type' => 'spinner',
									'title' => esc_html__('Border size', 'creatus'),
									'addon' => 'px',
									'min' => 0,
									'max' => 500
								),
								'border_style' => array(
									'type' => 'short-select',
									'title' => esc_html__('Border style', 'creatus'),
									'choices' => array(
										'solid' => esc_html__('Solid', 'creatus'),
										'dashed' => esc_html__('Dashed', 'creatus'),
										'dotted' => esc_html__('Dotted', 'creatus')
									)
								),
								'border_color' => array(
									'type' => 'color',
									'title' => esc_html__('Border color', 'creatus')
								),
								'background' => array(
									'type' => 'color',
									'title' => esc_html__('Background', 'creatus')
								),
								'color' => array(
									'type' => 'color',
									'title' => esc_html__('Text color', 'creatus')
								)
							)
						),
						'event_links' => array(
							'type' => 'thz-multi-options',
							'label' => __('Event links', 'creatus'),
							'desc' => esc_html__('Adjust event links color. Theme default used if empty', 'creatus'),
							'value' => array(
								'color' => '',
								'hovered' => ''
							),
							'thz_options' => array(
								'color' => array(
									'type' => 'color',
									'title' => esc_html__('Color', 'creatus')
								),
								'hovered' => array(
									'type' => 'color',
									'title' => esc_html__('Hovered color', 'creatus')
								)
							)
						)
					),
					'week' => array(
						'day_settings' => array(
							'type' => 'thz-multi-options',
							'label' => __('Day styles', 'creatus'),
							'desc' => esc_html__('Adjust day box styling.', 'creatus'),
							'value' => array(
								'border_size' => 5,
								'border_style' => 'solid',
								'border_color' => '#ffffff',
								'background' => 'color_5',
								'color' => 'color_2'
							),
							'thz_options' => array(
								'border_size' => array(
									'type' => 'spinner',
									'title' => esc_html__('Border size', 'creatus'),
									'addon' => 'px',
									'min' => 0,
									'max' => 500
								),
								'border_style' => array(
									'type' => 'short-select',
									'title' => esc_html__('Border style', 'creatus'),
									'choices' => array(
										'solid' => esc_html__('Solid', 'creatus'),
										'dashed' => esc_html__('Dashed', 'creatus'),
										'dotted' => esc_html__('Dotted', 'creatus')
									)
								),
								'border_color' => array(
									'type' => 'color',
									'title' => esc_html__('Border color', 'creatus')
								),
								'background' => array(
									'type' => 'color',
									'title' => esc_html__('Background', 'creatus')
								),
								'color' => array(
									'type' => 'color',
									'title' => esc_html__('Text color', 'creatus')
								)
							)
						),
						'today_settings' => array(
							'type' => 'thz-multi-options',
							'label' => __('Today styles', 'creatus'),
							'desc' => esc_html__('Adjust today styling.', 'creatus'),
							'value' => array(
								'background' => 'color_1',
								'color' => 'color_lighter_35'
							),
							'thz_options' => array(
								'background' => array(
									'type' => 'color',
									'title' => esc_html__('Background', 'creatus')
								),
								'color' => array(
									'type' => 'color',
									'title' => esc_html__('Text color', 'creatus')
								)
							)
						),
						'date_settings' => array(
							'type' => 'thz-multi-options',
							'label' => __('Day date styles', 'creatus'),
							'desc' => esc_html__('Adjust day date styling.', 'creatus'),
							'value' => array(
								'color' => 'color_3',
								'hovered' => 'color_1'
							),
							'thz_options' => array(
								'color' => array(
									'type' => 'color',
									'title' => esc_html__('Color', 'creatus')
								),
								'hovered' => array(
									'type' => 'color',
									'title' => esc_html__('Hovered color', 'creatus')
								)
							)
						),
						'event_links' => array(
							'type' => 'thz-multi-options',
							'label' => __('Event links', 'creatus'),
							'desc' => esc_html__('Adjust event links color. Theme default used if empty', 'creatus'),
							'value' => array(
								'color' => '',
								'hovered' => ''
							),
							'thz_options' => array(
								'color' => array(
									'type' => 'color',
									'title' => esc_html__('Color', 'creatus')
								),
								'hovered' => array(
									'type' => 'color',
									'title' => esc_html__('Hovered color', 'creatus')
								)
							)
						)
					),
					'month' => array(
						'day' => array(
							'type' => 'thz-multi-options',
							'label' => __('Day', 'creatus'),
							'desc' => esc_html__('Adjust day color and background.', 'creatus'),
							'value' => array(
								'border_size' => 5,
								'border_style' => 'solid',
								'border_color' => '#ffffff',
								'background' => 'color_5',
								'color' => 'color_2'
							),
							'thz_options' => array(
								'border_size' => array(
									'type' => 'spinner',
									'title' => esc_html__('Border size', 'creatus'),
									'addon' => 'px',
									'min' => 0,
									'max' => 500
								),
								'border_style' => array(
									'type' => 'short-select',
									'title' => esc_html__('Border style', 'creatus'),
									'choices' => array(
										'solid' => esc_html__('Solid', 'creatus'),
										'dashed' => esc_html__('Dashed', 'creatus'),
										'dotted' => esc_html__('Dotted', 'creatus')
									)
								),
								'border_color' => array(
									'type' => 'color',
									'title' => esc_html__('Border color', 'creatus')
								),
								'background' => array(
									'type' => 'color',
									'title' => esc_html__('Background', 'creatus')
								),
								'color' => array(
									'type' => 'color',
									'title' => esc_html__('Text color', 'creatus')
								)
							)
						),
						'day_hovered' => array(
							'type' => 'thz-multi-options',
							'label' => __('Today & hovered day', 'creatus'),
							'desc' => esc_html__('Adjust today and hovered day color and background.', 'creatus'),
							'value' => array(
								'background' => 'color_1',
								'color' => 'color_lighter_35'
							),
							'thz_options' => array(
								'background' => array(
									'type' => 'color',
									'title' => esc_html__('Background', 'creatus')
								),
								'color' => array(
									'type' => 'color',
									'title' => esc_html__('Text color', 'creatus')
								)
							)
						),
						'event_day' => array(
							'type' => 'thz-multi-options',
							'label' => __('Event day', 'creatus'),
							'desc' => esc_html__('Adjust event day color and background.', 'creatus'),
							'value' => array(
								'background' => 'color_darker_30',
								'color' => 'color_lighter_15'
							),
							'thz_options' => array(
								'background' => array(
									'type' => 'color',
									'title' => esc_html__('Background', 'creatus')
								),
								'color' => array(
									'type' => 'color',
									'title' => esc_html__('Text color', 'creatus')
								)
							)
						),
						'header_settings' => array(
							'type' => 'thz-multi-options',
							'label' => __('Calendar header', 'creatus'),
							'desc' => esc_html__('Adjust calendar header styles.', 'creatus'),
							'value' => array(
								'background' => 'color_5',
								'color' => 'color_2'
							),
							'thz_options' => array(
								'background' => array(
									'type' => 'color',
									'title' => esc_html__('Background', 'creatus')
								),
								'color' => array(
									'type' => 'color',
									'title' => esc_html__('Text color', 'creatus')
								)
							)
						),
						'event_links' => array(
							'type' => 'thz-multi-options',
							'label' => __('Event links', 'creatus'),
							'desc' => esc_html__('Adjust event links color. Theme default used if empty', 'creatus'),
							'value' => array(
								'color' => '',
								'hovered' => ''
							),
							'thz_options' => array(
								'color' => array(
									'type' => 'color',
									'title' => esc_html__('Color', 'creatus')
								),
								'hovered' => array(
									'type' => 'color',
									'title' => esc_html__('Hovered color', 'creatus')
								)
							)
						)
					)
				)
			)
		)
	),
	'calendareffects' => array(
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