<?php
if (!defined('FW'))
	die('Forbidden');
$options = array(
	'phbs' => array(
		'type' => 'thz-box-style',
		'label' => __('Holder box style', 'creatus'),
		'preview' => true,
		'button-text' => esc_html__('Customize pagination holder box style', 'creatus'),
		'desc' => esc_html__('Adjust .thz-pagination-nav box style', 'creatus'),
		'popup' => true,
		'disable' => array('layout','video','boxsize','transform'),
		'value' => array(
			'margin' => array(
				'top' => 60,
				'right' => 'auto',
				'bottom' => 0,
				'left' => 'auto'
			),
		)
	),
	'pagination_limit' => array(
		'label' => __('Pagination links limit', 'creatus'),
		'desc' => esc_html__('Limit the number of pagination links.', 'creatus'),
		'help' => esc_html__('If set to limit, it will show only max of 5 pagination links and dots (...) pointers for additional pagination links.', 'creatus'),
		'type' => 'switch',
		'right-choice' => array(
			'value' => 0,
			'label' => __('Do not limit', 'creatus')
		),
		'left-choice' => array(
			'value' => 1,
			'label' => __('Limit', 'creatus')
		),
		'value' => 1
	),
	'pagination_text' => array(
		'label' => __('Pagination text', 'creatus'),
		'desc' => esc_html__('Show/hide pagination text ( Previous/Next ) next to pagination arrows.', 'creatus'),
		'type' => 'switch',
		'right-choice' => array(
			'value' => 0,
			'label' => __('Hide', 'creatus')
		),
		'left-choice' => array(
			'value' => 1,
			'label' => __('Show', 'creatus')
		),
		'value' => 0
	),
	'pagination_position' => array(
		'label' => __('Pagination position', 'creatus'),
		'desc' => esc_html__('Set the pagination position', 'creatus'),
		'type' => 'radio',
		'inline' => true,
		'value' => 'thz-float-none',
		'choices' => array(
			'thz-float-left' => esc_html__('Left', 'creatus'),
			'thz-float-none' => esc_html__('Centered', 'creatus'),
			'thz-float-right' => esc_html__('Right', 'creatus')
		)
	),
	
	'pagl_bs' => array(
		'type' => 'thz-box-style',
		'label' => __('Adjust pagination links box style', 'creatus'),
		'preview' => true,
		'button-text' => esc_html__('Customize quote box style', 'creatus'),
		'desc' => esc_html__('Adjust .thz-paginatio an box style', 'creatus'),
		'popup' => true,
		'disable' => array('layout','background','video','transform'),
		'value' => array(
			'padding' => array(
				'top' => 0,
				'right' => 0,
				'bottom' => 0,
				'left' => 0
			),
			'boxsize' => array(
				'width' => 38,
				'height' => 38,
			),
			'borderradius' => array(
				'top-left' => 38,
				'top-right' => 38,
				'bottom-right' => 38,
				'bottom-left' => 38,
			),
			'boxshadow' => array(
				1 => array(
					'inset' => false,
					'horizontal-offset' => 0,
					'vertical-offset' => 2,
					'blur-radius' => 24,
					'spread-radius' => 0,
					'shadow-color' =>'rgba(0,0,0,0.18)'
				)
			),
		)
	),
	
	'pagination_metrics' => array(
		'type' => 'thz-multi-options',
		'label' => __('Pagination metrics', 'creatus'),
		'desc' => esc_html__('Adjust pagination links metrics', 'creatus'),
		'value' => array(
			'bs' => '',
			'space' => 5,
			'dis' => 's',
		),
		'thz_options' => array(
			'bs' => array(
				'type' => 'box-style',
				'title' => esc_html__('Box style', 'creatus'),
				'button-text' => esc_html__('Edit links box style', 'creatus'),
				'connect' => 'pagl_bs',
			),
			'space' => array(
				'type' => 'spinner',
				'title' => esc_html__('Space', 'creatus'),
				'addon' => 'px',
				'min' => 0,
				'max' => 100
			),
			'dis' => array(
				'type' => 'short-select',
				'title' => esc_html__('Disabled link', 'creatus'),
				'choices' => array(
					's' => esc_html__('Show', 'creatus'),
					'h' => esc_html__('Hide', 'creatus'),
				)
			),
		)
	),
	
	'pagf' => array(
		'type' => 'thz-typography',
		'label' => __('Pagination font', 'creatus'),
		'desc' => esc_html__('Adjust pagination button font metrics.', 'creatus'),
		'value' => array(
			'size' => 12,
			'weight' => 600,
		),
		'disable' => array('line-height','transform','style','spacing','color','hovered','align'),
	),

	'pagination_active' => array(
		'type' => 'thz-multi-options',
		'label' => __('Active link metrics', 'creatus'),
		'desc' => esc_html__('Adjust pagination active link colors', 'creatus'),
		'value' => array(
			'bg' => 'color_2',
			'color' => 'color_5',
			'bsh' => 's',
		),
		'thz_options' => array(
			'bg' => array(
				'type' => 'color',
				'title' => esc_html__('Active bg', 'creatus'),
				'box' => true
			),
			'color' => array(
				'type' => 'color',
				'title' => esc_html__('Active color', 'creatus'),
				'box' => true
			),
			'bsh' => array(
				'type' => 'short-select',
				'title' => esc_html__('Box shadow', 'creatus'),
				'choices' => array(
					's' => esc_html__('Show', 'creatus'),
					'h' => esc_html__('Hide', 'creatus'),
				)
			),
		)
	),
	'pagination_inactive' => array(
		'type' => 'thz-multi-options',
		'label' => __('Inactive link metrics', 'creatus'),
		'desc' => esc_html__('Adjust pagination inactive link colors', 'creatus'),
		'value' => array(
			'bg' => '',
			'color' => 'color_2',
			'bcolor' => '',
			'disabled' => '#ccc',
			'bsh' => 'h',
		),
		'thz_options' => array(
			'bg' => array(
				'type' => 'color',
				'title' => esc_html__('Inactive bg', 'creatus'),
				'box' => true
			),
			'color' => array(
				'type' => 'color',
				'title' => esc_html__('Inactive color', 'creatus'),
				'box' => true
			),
			'bcolor' => array(
				'type' => 'color',
				'title' => esc_html__('Border color', 'creatus'),
				'box' => true
			),
			'disabled' => array(
				'type' => 'color',
				'title' => esc_html__('Disabled color', 'creatus'),
				'box' => true
			),
			'bsh' => array(
				'type' => 'short-select',
				'title' => esc_html__('Box shadow', 'creatus'),
				'choices' => array(
					's' => esc_html__('Show', 'creatus'),
					'h' => esc_html__('Hide', 'creatus'),
				)
			),
		)
	),
	'pagination_hovered' => array(
		'type' => 'thz-multi-options',
		'label' => __('Hovered link metrics', 'creatus'),
		'desc' => esc_html__('Adjust pagination hovered link colors', 'creatus'),
		'value' => array(
			'bg' => 'color_2',
			'color' => 'color_5',
			'bcolor' => '',
			'bsh' => 'h',
		),
		'thz_options' => array(
			'bg' => array(
				'type' => 'color',
				'title' => esc_html__('Hovered bg', 'creatus'),
				'box' => true
			),
			'color' => array(
				'type' => 'color',
				'title' => esc_html__('Hovered color', 'creatus'),
				'box' => true
			),
			'bcolor' => array(
				'type' => 'color',
				'title' => esc_html__('Border color', 'creatus'),
				'box' => true
			),
			'bsh' => array(
				'type' => 'short-select',
				'title' => esc_html__('Box shadow', 'creatus'),
				'choices' => array(
					's' => esc_html__('Show', 'creatus'),
					'h' => esc_html__('Hide', 'creatus'),
				)
			),
		)
	)
);