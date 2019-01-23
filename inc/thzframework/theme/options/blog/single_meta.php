<?php
if (!defined('FW'))
	die('Forbidden');

$options = array(
	'bpme' => array(
		'type' => 'multi-picker',
		'label' => false,
		'desc' => false,
		'show_borders' => true,
		'picker' => array(
			'picked' => array(
				'label' => __('Show post meta', 'creatus'),
				'desc' => esc_html__('Show/hide post meta', 'creatus'),
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
				'loc' => array(
					'label' => __('Post meta location', 'creatus'),
					'desc' => esc_html__('Set post meta location. Under or above the title', 'creatus'),
					'type' => 'switch',
					'right-choice' => array(
						'value' => 'under',
						'label' => __('Under the title', 'creatus')
					),
					'left-choice' => array(
						'value' => 'above',
						'label' => __('Above the title', 'creatus')
					),
					'value' => 'under'
				),
				'me' => array(
					'type' => 'thz-sortable-checks',
					'value' => array(
						'date',
						'author',
						'categories'
					),
					'label' => __('Post meta elements', 'creatus'),
					'desc' => esc_html__('Check to show/hide specific post meta elements. Click and drag the label to sort.', 'creatus'),
					'choices' => _thz_meta_choices()
				),
				'mep' => _thz_metas_preferences('meta', array(
					'dlink'
				)),
				'bs' => array(
					'type' => 'thz-box-style',
					'label' => __('Post meta box style', 'creatus'),
					'preview' => true,
					'button-text' => esc_html__('Customize post meta box style', 'creatus'),
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
					'desc' => esc_html__('Adjust .thz-post-meta box style', 'creatus'),
					'value' => array(
						'margin' => array(
							'top' => 15,
							'right' => 'auto',
							'bottom' => 15,
							'left' => 'auto'
						)
					)
				),
				'f' => array(
					'type' => 'thz-typography',
					'label' => __('Post meta font', 'creatus'),
					'desc' => esc_html__('Adjust post meta font metrics.', 'creatus'),
					'value' => array(
						'size' => '0.93em',
					),
					'disable' => array(
						'color',
						'hovered',
						'text-shadow'
					),
				),
				'c' => array(
					'type' => 'thz-multi-options',
					'label' => __('Post meta colors', 'creatus'),
					'desc' => esc_html__('Adjust post meta colors', 'creatus'),
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
	)	
);