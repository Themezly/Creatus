<?php
if (!defined('FW'))
	die('Forbidden');
	
$options = array(
	'mm_bs' => array(
		'type' => 'thz-box-style',
		'label' => __('Adjust .thz-mobile-menu-holder box style', 'creatus'),
		'preview' => true,
		'button-text' => esc_html__('Customize mobile menu box style', 'creatus'),
		'desc' => esc_html__('Adjust .thz-mobile-menu-holder box style', 'creatus'),
		'popup' => true,
		'disable' => array('video'),
		'value' => array(
			'borders' => array(
				'all' => 'separate',
				'top' => array(
					'w' => '',
					's' => 'solid',
					'c' => ''
				),
				'right' => array(
					'w' => '',
					's' => 'solid',
					'c' => ''
				),
				'bottom' => array(
					'w' => 1,
					's' => 'solid',
					'c' => 'color_4'
				),
				'left' => array(
					'w' => '',
					's' => 'solid',
					'c' => ''
				),
			),
			'background' => array(
				'type' => 'color',
				'color' => '#ffffff',
			)
		)
	),
	'mm_c' => array(
		'type' => 'thz-multi-options',
		'label' => __('Menu container', 'creatus'),
		'desc' => esc_html__('Adjust mobile menu container box style and colors', 'creatus'),
		'value' => array(
			'bs' => '',
			'i' => '',
			'a' => ''
		),
		'thz_options' => array(
			'bs' => array(
				'type' => 'box-style',
				'title' => esc_html__('Box style', 'creatus'),
				'button-text' => esc_html__('Edit', 'creatus'),
				'connect' => 'mm_bs'
			),
			'i' => array(
				'type' => 'color',
				'title' => esc_html__('Hamburger inactive', 'creatus'),
				'box' => true
			),
			'a' => array(
				'type' => 'color',
				'title' => esc_html__('Hamburger active', 'creatus'),
				'box' => true
			)
		)
	),
	'mm_l' => array(
		'type' => 'thz-multi-options',
		'label' => __('Link', 'creatus'),
		'desc' => esc_html__('Adjust mobile menu link colors', 'creatus'),
		'value' => array(
			'c' => '',
			'bg' => '#ffffff',
			'b' => 'color_4'
		),
		'thz_options' => array(
			'c' => array(
				'type' => 'color',
				'title' => esc_html__('Color', 'creatus'),
				'box' => true
			),
			'bg' => array(
				'type' => 'color',
				'title' => esc_html__('Background', 'creatus'),
				'box' => true
			),
			'b' => array(
				'type' => 'color',
				'title' => esc_html__('Border', 'creatus'),
				'box' => true
			)
		)
	),
	'mm_h' => array(
		'type' => 'thz-multi-options',
		'label' => __('Hovered link', 'creatus'),
		'desc' => esc_html__('Adjust mobile menu hovered link colors', 'creatus'),
		'value' => array(
			'c' => '',
			'bg' => 'color_5',
			'b' => 'color_4'
		),
		'thz_options' => array(
			'c' => array(
				'type' => 'color',
				'title' => esc_html__('Color', 'creatus'),
				'box' => true
			),
			'bg' => array(
				'type' => 'color',
				'title' => esc_html__('Background', 'creatus'),
				'box' => true
			),
			'b' => array(
				'type' => 'color',
				'title' => esc_html__('Border', 'creatus'),
				'box' => true
			)
		)
	),
	'mm_a' => array(
		'type' => 'thz-multi-options',
		'label' => __('Active link', 'creatus'),
		'desc' => esc_html__('Adjust mobile menu active link colors', 'creatus'),
		'value' => array(
			'c' => '',
			'bg' => '#fcfcfc',
			'b' => 'color_4'
		),
		'thz_options' => array(
			'c' => array(
				'type' => 'color',
				'title' => esc_html__('Color', 'creatus'),
				'box' => true
			),
			'bg' => array(
				'type' => 'color',
				'title' => esc_html__('Background', 'creatus'),
				'box' => true
			),
			'b' => array(
				'type' => 'color',
				'title' => esc_html__('Border', 'creatus'),
				'box' => true
			)
		)
	),
	'mm_elmx' => array(
		'type' => 'thz-multi-options',
		'label' => __('Secondary menu elements', 'creatus'),
		'desc' => esc_html__('Adjust secondary menu elements', 'creatus'),
		'value' => array(
			'il' => 'hide',
			'so' => 'hide',
			'si' => 'show',
			'mc' => 'hide',
		),
		'thz_options' => array(
			'il' => array(
				'type' => 'short-select',
				'title' => esc_html__('Items', 'creatus'),
				'choices' => array(
					'before' => array(
						'text' => esc_html__('Before menu icons', 'creatus'),
					),
					'after' => array(
						'text' => esc_html__('After menu icons', 'creatus'),
					),
					'hide' => array(
						'text' => esc_html__('Hide', 'creatus'),
					),
				)
			),
			'so' => array(
				'type' => 'short-select',
				'title' => esc_html__('Social links', 'creatus'),
				'choices' => array(
					'show' => esc_html__('Show', 'creatus'),
					'hide' => esc_html__('Hide', 'creatus')
				)
			),
			'si' => array(
				'type' => 'short-select',
				'title' => esc_html__('Search icon', 'creatus'),
				'choices' => array(
					'show' => esc_html__('Show', 'creatus'),
					'hide' => esc_html__('Hide', 'creatus')
				)
			),
			'mc' => array(
				'type' => 'short-select',
				'title' => esc_html__('Mini cart', 'creatus'),
				'choices' => array(
					'show' => esc_html__('Show', 'creatus'),
					'hide' => esc_html__('Hide', 'creatus')
				)
			),
		)
	)
);
