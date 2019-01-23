<?php
if (!defined('FW'))
	die('Forbidden');
$options = array(
	'htb' => array(
		'type' => 'multi-picker',
		'label' => false,
		'desc' => false,
		'show_borders' => true,
		'picker' => array(
			'picked' => array(
				'label' => __('Header toolbar', 'creatus'),
				'desc' => esc_html__('Show/hide header toolbar', 'creatus'),
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
				'bs' => array(
					'type' => 'thz-box-style',
					'label' => __('Toolbar style', 'creatus'),
					'preview' => true,
					'button-text' => esc_html__('Customize toolbar box style', 'creatus'),
					'desc' => esc_html__('Customize .thz-header-toolbar box style', 'creatus'),
					'popup' => true,
					'disable' => array('video'),
					'value' => array(
						'borders' => array(
							'all' => 'separate',
							'top' => array(
								'w' => 0,
								's' => 'solid',
								'c' => ''
							),
							'right' => array(
								'w' => 0,
								's' => 'solid',
								'c' => ''
							),
							'bottom' => array(
								'w' => 1,
								's' => 'solid',
								'c' => 'color_4'
							),
							'left' => array(
								'w' => 0,
								's' => 'solid',
								'c' => ''
							)
						),
						'background' => array(
							'type' => 'color',
							'color' => '#ffffff'
						)
					)
				),
				'm' => array(
					'type' => 'thz-multi-options',
					'label' => __('Toolbar metrics', 'creatus'),
					'desc' => esc_html__('Adjust toolbar font size, line height and colors', 'creatus'),
					'value' => array(
						'f' => '13',
						'lh' => '45',
						't' => '',
						'l' => '',
						'h' => ''
					),
					'thz_options' => array(
						'f' => array(
							'type' => 'spinner',
							'title' => esc_html__('Font size', 'creatus'),
							'addon' => 'px',
							'min' => 8,
							'max' => 100
						),
						'lh' => array(
							'type' => 'spinner',
							'title' => esc_html__('Line height', 'creatus'),
							'addon' => 'px',
							'min' => 8,
							'max' => 100
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
						'h' => array(
							'type' => 'color',
							'title' => esc_html__('Hovered link', 'creatus'),
							'box' => true
						)
					)
				),
				'c' => array(
					'type' => 'thz-multi-options',
					'label' => __('Toolbar content', 'creatus'),
					'desc' => esc_html__('Choose what will be shown in left and right toolbar side', 'creatus'),
					'value' => array(
						'l' => 'p',
						'r' => 's'
					),
					'thz_options' => array(
						'l' => array(
							'type' => 'short-select',
							'title' => esc_html__('Left content', 'creatus'),
							'choices' => array(
								'p' => esc_html__('Slogan phone and email', 'creatus'),
								's' => esc_html__('Social links', 'creatus'),
								'n' => esc_html__('Navigation', 'creatus'),
								'h' => esc_html__('Hide', 'creatus')
							)
						),
						'r' => array(
							'type' => 'short-select',
							'title' => esc_html__('Right content', 'creatus'),
							'choices' => array(
								'p' => esc_html__('Slogan phone and email', 'creatus'),
								's' => esc_html__('Social links', 'creatus'),
								'n' => esc_html__('Navigation', 'creatus'),
								'h' => esc_html__('Hide', 'creatus')
							)
						)
					)
				),
				's' => array(
					'type' => 'text',
					'label' => __('Slogan', 'creatus'),
					'desc' => esc_html__('Add your slogan text. Not shown if empty.', 'creatus')
				),
				'p' => array(
					'type' => 'text',
					'label' => __('Phone', 'creatus'),
					'desc' => esc_html__('Add your phone number. Not shown if empty.', 'creatus')
				),
				'e' => array(
					'type' => 'text',
					'label' => __('Email', 'creatus'),
					'desc' => esc_html__('Add your contact email adress. Not shown if empty.', 'creatus')
				),
				'nt' => array(
					'type' => 'thz-multi-options',
					'label' => __('Navigation top level', 'creatus'),
					'desc' => esc_html__('Adjust toolbar navigation top level item colors', 'creatus'),
					'value' => array(
						'pl' => 10,
						'pr' => 10,
						'bg' => '',
						'l' => '',
						'hbg' => 'color_5',
						'h' => '',
						'b' => 'color_4'
					),
					'breakafter' => array('pr'),
					'thz_options' => array(
						'pl' => array(
							'type' => 'spinner',
							'title' => esc_html__('Padding left', 'creatus'),
							'addon' => 'px',
							'min' => 0,
						),
						'pr' => array(
							'type' => 'spinner',
							'title' => esc_html__('Padding right', 'creatus'),
							'addon' => 'px',
							'min' => 0,
						),
						'bg' => array(
							'type' => 'color',
							'title' => esc_html__('Background', 'creatus'),
							'box' => true
						),
						'l' => array(
							'type' => 'color',
							'title' => esc_html__('Link', 'creatus'),
							'box' => true
						),
						'hbg' => array(
							'type' => 'color',
							'title' => esc_html__('Hovered background', 'creatus'),
							'box' => true
						),
						'h' => array(
							'type' => 'color',
							'title' => esc_html__('Hovered link', 'creatus'),
							'box' => true
						),
						'b' => array(
							'type' => 'color',
							'title' => esc_html__('Border', 'creatus'),
							'box' => true
						)
					)
				),
				'ns' => array(
					'type' => 'thz-multi-options',
					'label' => __('Navigation sub level', 'creatus'),
					'desc' => esc_html__('Adjust toolbar navigation sub level item colors and item width', 'creatus'),
					'value' => array(
						'bg' => '',
						'l' => '',
						'hbg' => '#fafafa',
						'h' => '',
						'b' => '#eaeaea',
						'w' => '160'
					),
					'thz_options' => array(
						'bg' => array(
							'type' => 'color',
							'title' => esc_html__('Background', 'creatus'),
							'box' => true
						),
						'l' => array(
							'type' => 'color',
							'title' => esc_html__('Link', 'creatus'),
							'box' => true
						),
						'hbg' => array(
							'type' => 'color',
							'title' => esc_html__('Hovered background', 'creatus'),
							'box' => true
						),
						'h' => array(
							'type' => 'color',
							'title' => esc_html__('Hovered link', 'creatus'),
							'box' => true
						),
						'b' => array(
							'type' => 'color',
							'title' => esc_html__('Border', 'creatus'),
							'box' => true
						),
						'w' => array(
							'type' => 'spinner',
							'title' => esc_html__('Width', 'creatus'),
							'addon' => 'px',
							'min' => 100,
							'max' => 400
						)
					)
				)
			)
		)
	)	
);