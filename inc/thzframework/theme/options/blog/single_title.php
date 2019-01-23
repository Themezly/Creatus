<?php
if (!defined('FW'))
	die('Forbidden');

$options = array(
	'bpt' => array(
		'type' => 'multi-picker',
		'label' => false,
		'desc' => false,
		'show_borders' => true,
		'picker' => array(
			'picked' => array(
				'label' => __('Show post title', 'creatus'),
				'desc' => esc_html__('Show/hide post title', 'creatus'),
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
				'single_title_location' => array(
					'label' => __('Post title location', 'creatus'),
					'desc' => esc_html__('Set post title location. Under or above the media container', 'creatus'),
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
					'label' => __('Post title box style', 'creatus'),
					'preview' => true,
					'button-text' => esc_html__('Customize post title box style', 'creatus'),
					'popup' => true,
					'disable' => array(
						'video',
					),
					'units' => array(
						'borderradius',
						'boxsize',
						'padding',
						'margin',
					),
					'desc' => esc_html__('Adjust .thz-post-title box style', 'creatus'),
					'value' => array()
				),
				'm' => array(
					'type' => 'thz-typography',
					'label' => __('Post title font', 'creatus'),
					'desc' => esc_html__('Adjust post title font metrics.', 'creatus'),
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
					'label' => __('Post title colors', 'creatus'),
					'desc' => esc_html__('Adjust post title colors. Theme links colors are inherited if empty', 'creatus'),
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
	)	
);