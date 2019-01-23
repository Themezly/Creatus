<?php
if (!defined('FW'))
	die('Forbidden');

$options = array(
	'bptags' => array(
		'type' => 'multi-picker',
		'label' => false,
		'desc' => false,
		'show_borders' => true,
		'picker' => array(
			'picked' => array(
				'label' => __('Show post tags', 'creatus'),
				'desc' => esc_html__('Show/hide post tags', 'creatus'),
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
				'rowbs' => array(
					'type' => 'thz-box-style',
					'label' => __('Post tags row box style', 'creatus'),
					'preview' => true,
					'button-text' => esc_html__('Customize tags row box style', 'creatus'),
					'desc' => esc_html__('Adjust .thz-post-tags-row box style', 'creatus'),
					'popup' => true,
					'disable' => array('video'),
					'value' => array(),
					'units' => array(
						'borderradius',
						'boxsize',
						'padding',
						'margin',
					),
				),
				'holder_mx' => array(
					'type' => 'thz-multi-options',
					'label' => __('Post tags holder', 'creatus'),
					'desc' => esc_html__('Adjust .thz-post-tags-holder See help for more info.', 'creatus'),
					'help' => esc_html__('Note that the holder and max width settings are effective only if there is no active page sidebar.', 'creatus'),
					'value' => array(
						'h' => 'contained',
						'm' => 100
					),
					'thz_options' => array(
						'h' => array(
							'type' => 'short-select',
							'title' => __('Holder', 'creatus'),
							'choices' => array(
								'contained' => __('Contained', 'creatus'),
								'notcontained' => __('Not contained', 'creatus')
							)
						),
						'm' => array(
							'type' => 'select',
							'title' => esc_html__('Max width', 'creatus'),
							'choices' => _thz_max_width_list()
						)
					)
				),
				
				'bs' => array(
					'type' => 'thz-box-style',
					'label' => __('Post tags box style', 'creatus'),
					'preview' => true,
					'button-text' => esc_html__('Customize post tags box style', 'creatus'),
					'desc' => esc_html__('Adjust .thz-single-post-tags box style', 'creatus'),
					'popup' => true,
					'disable' => array('video'),
					'value' => array(
						'margin' => array(
							'top' => '0',
							'right' => 'auto',
							'bottom' => 30,
							'left' => 'auto'
						)
					),
					'units' => array(
						'borderradius',
						'boxsize',
						'padding',
						'margin',
					),
				),
				
				'tbs' => array(
					'type' => 'thz-box-style',
					'label' => __('Post tags item box style', 'creatus'),
					'preview' => true,
					'button-text' => esc_html__('Customize post tags item box style', 'creatus'),
					'desc' => esc_html__('Adjust .thz-post-tags-item box style', 'creatus'),
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
					'value' => array(
						'margin' => array(
							'top' => 0,
							'right' => 15,
							'bottom' => 0,
							'left' => 0
						)
					)
				),
				
				'thbs' => array(
					'type' => 'thz-box-style',
					'label' => __('Post tags item hovered box style', 'creatus'),
					'preview' => true,
					'button-text' => esc_html__('Customize tags item hovered box style', 'creatus'),
					'desc' => esc_html__('Adjust .thz-post-tags-item:hover box style', 'creatus'),
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
				
				'f' => array(
					'type' => 'thz-typography',
					'label' => __('Post tags item font', 'creatus'),
					'desc' => esc_html__('Adjust post tags item font metrics.', 'creatus'),
					'value' => array(
						'size' => '0.93em',
						'transform' => 'capitalize'
					),
					'disable' => array(
						'color',
						'hovered',
						'text-shadow'
					),
				),
				
				'c' => array(
					'type' => 'thz-multi-options',
					'label' => __('Post tags metrics', 'creatus'),
					'desc' => esc_html__('Adjust tags item colors', 'creatus'),
					'value' => array(
						'lc' => '',
						'hlc' => '',
						'beft' => '',
						'bef' => ''
					),
					'thz_options' => array(
						'lc' => array(
							'type' => 'color',
							'title' => esc_html__('Link', 'creatus'),
							'box' => true
						),
						'hlc' => array(
							'type' => 'color',
							'title' => esc_html__('Link Hovered', 'creatus'),
							'box' => true
						),
						'beft' => array(
							'type' => 'short-text',
							'title' => esc_html__('Before text', 'creatus'),
							'box' => true
						),
						'bef' => array(
							'type' => 'color',
							'title' => esc_html__('Before color', 'creatus'),
							'box' => true
						)
					)
				)
			)
		)
	)	
);