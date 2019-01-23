<?php
if (!defined('FW'))
	die('Forbidden');
$options = array(
	'ev_title' => array(
		'type' => 'multi-picker',
		'label' => false,
		'desc' => false,
		'show_borders' => true,
		'picker' => array(
			'picked' => array(
				'label' => __('Show event title', 'creatus'),
				'desc' => esc_html__('Show/hide event title', 'creatus'),
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
				'location' => array(
					'label' => __('Event title location', 'creatus'),
					'desc' => esc_html__('Set event title location. Under or above the media container', 'creatus'),
					'type' => 'switch',
					'right-choice' => array(
						'value' => 'under',
						'label' => __('Under the media', 'creatus')
					),
					'left-choice' => array(
						'value' => 'above',
						'label' => __('Above the media', 'creatus')
					),
					'value' => 'under'
				),
				'bs' => array(
					'type' => 'thz-box-style',
					'label' => __('Event title box style', 'creatus'),
					'preview' => true,
					'button-text' => esc_html__('Customize event title box style', 'creatus'),
					'desc' => esc_html__('Adjust .thz-event-title box style', 'creatus'),
					'popup' => true,
					'disable' => array(
						'layout',
						'video',
						'transform',
						'boxsize'
					),
					'value' => array(
						'margin' => array(
							'top' => 0,
							'right' => 'auto',
							'bottom' => 0,
							'left' => 'auto'
						)
					)
				),
				'f' => array(
					'type' => 'thz-typography',
					'label' => __('Event title font', 'creatus'),
					'desc' => esc_html__('Adjust event title font metrics.', 'creatus'),
					'value' => array(
						'size' => 28
					),
					'disable' => array(
						'color',
						'hovered'
					),
				),
				'c' => array(
					'type' => 'thz-multi-options',
					'label' => __('Event title colors', 'creatus'),
					'desc' => esc_html__('Adjust event title colors. Theme links colors are inherited if empty', 'creatus'),
					'value' => array(
						'co' => '',
						'hc' => ''
					),
					'thz_options' => array(
						'co' => array(
							'type' => 'color',
							'title' => esc_html__('Color', 'creatus'),
							'box' => true
						),
						'hc' => array(
							'type' => 'color',
							'title' => esc_html__('Hovered Color', 'creatus'),
							'box' => true
						)
					)
				)
			)
		)
	),
	'ev_dt' => array(
		'type' => 'multi-picker',
		'label' => false,
		'desc' => false,
		'show_borders' => true,
		'picker' => array(
			'picked' => array(
				'label' => __('Show date & time', 'creatus'),
				'desc' => esc_html__('Show/hide date & time', 'creatus'),
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
					'label' => __('Date & time box style', 'creatus'),
					'preview' => true,
					'button-text' => esc_html__('Customize date & time box style', 'creatus'),
					'desc' => esc_html__('Adjust .thz-event-date-time box style', 'creatus'),
					'popup' => true,
					'disable' => array(
						'layout',
						'video',
						'transform',
						'boxsize'
					),
					'value' => array(
						'margin' => array(
							'top' => 5,
							'right' => 'auto',
							'bottom' => 15,
							'left' => 'auto'
						)
					)
				),
				'f' => array(
					'type' => 'thz-typography',
					'label' => __('Date & time font', 'creatus'),
					'desc' => esc_html__('Adjust event date & time font metrics.', 'creatus'),
					'value' => array(
						'size' => '1.2em',
					),
					'disable' => array(
						'hovered',
						'text-shadow'
					),
				)
			)
		)
	),
	'ev_hmx' => array(
		'type' => 'thz-typography',
		'label' => __('Headings font', 'creatus'),
		'desc' => esc_html__('Adjust .thz-event-meta-title ( Details, Organizer, Venue, Agenda ) font metrics.', 'creatus'),
		'value' => array(
			'size' => 20,
		),
		'disable' => array('hovered'),
	),
	'ev_hbs' => array(
		'type' => 'thz-box-style',
		'label' => __('Headings box style', 'creatus'),
		'desc' => esc_html__('Adjust .thz-event-meta-title ( Details, Organizer, Venue, Agenda ) box style','creatus'),
		'preview' => true,
		'button-text' => esc_html__('Customize event meta headings box style', 'creatus'),
		'popup' => true,
		'disable' => array('layout','video','boxsize','transform'),
		'value' => array(
			'margin' => array(
				'top' => 0,
				'right' => 'auto',
				'bottom' => 15,
				'left' => 'auto'
			),
		)
	),	
);