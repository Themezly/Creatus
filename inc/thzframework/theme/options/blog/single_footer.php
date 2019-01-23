<?php
if (!defined('FW'))
	die('Forbidden');

$options = array(
	'bpfo' => array(
		'type' => 'multi-picker',
		'label' => false,
		'desc' => false,
		'show_borders' => true,
		'picker' => array(
			'picked' => array(
				'label' => __('Show post footer', 'creatus'),
				'desc' => esc_html__('Show/hide post footer', 'creatus'),
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
				'rowbs' => array(
					'type' => 'thz-box-style',
					'label' => __('Footer row box style', 'creatus'),
					'preview' => true,
					'button-text' => esc_html__('Customize footer row box style', 'creatus'),
					'desc' => esc_html__('Adjust .thz-post-footer-row box style', 'creatus'),
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
					'label' => __('Post footer holder', 'creatus'),
					'desc' => esc_html__('Adjust .thz-post-footer-holder. See help for more info.', 'creatus'),
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
				'fe' => array(
					'type' => 'thz-sortable-checks',
					'value' => array(
						'tags',
						'comments',
						'views',
						'likes'
					),
					'label' => __('Post footer elements', 'creatus'),
					'desc' => esc_html__('Check to show/hide specific post footer elements. Click and drag the label to sort.', 'creatus'),
					'choices' => _thz_meta_choices()
				),
				'fop' => _thz_metas_preferences('footer', array(
					'dlink'
				)),
				'bs' => array(
					'type' => 'thz-box-style',
					'label' => __('Post footer box style', 'creatus'),
					'preview' => true,
					'button-text' => esc_html__('Customize post footer box style', 'creatus'),
					'desc' => esc_html__('Adjust .thz-post-footer box style', 'creatus'),
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
							'top' => '0',
							'right' => 'auto',
							'bottom' => 30,
							'left' => 'auto'
						)
					)
				),
				'f' => array(
					'type' => 'thz-typography',
					'label' => __('Post footer font', 'creatus'),
					'desc' => esc_html__('Adjust post footer font metrics.', 'creatus'),
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
					'label' => __('Post footer colors', 'creatus'),
					'desc' => esc_html__('Adjust post footer colors', 'creatus'),
					'value' => array(
						'tc' => '',
						'lc' => '',
						'hlc' => '',
						'sep' => ''
					),
					'thz_options' => array(
						'tc' => array(
							'type' => 'color',
							'title' => esc_html__('Text', 'creatus'),
							'box' => true
						),
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
						'sep' => array(
							'type' => 'color',
							'title' => esc_html__('Separator', 'creatus'),
							'box' => true
						)
					)
				)
			)
		)
	),	
);