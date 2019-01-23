<?php
if (!defined('FW')) {
	die('Forbidden');
}
$options = array(
	'woopbagbs' => array(
		'type' => 'thz-multi-options',
		'label' => __('Badges metrics', 'creatus'),
		'desc' => esc_html__('Adjust sales and out of stock badge padding, margin and border radius', 'creatus'),
		'value' => array(
			'vp' => 8,
			'hp' => 15,
			'mt' => 15,
			'ml' => 15,
			'br' => 4
		),
		'thz_options' => array(
			'vp' => array(
				'type' => 'spinner',
				'title' => esc_html__('V-padding', 'creatus'),
				'box' => true
			),
			'hp' => array(
				'type' => 'spinner',
				'title' => esc_html__('H-padding', 'creatus'),
				'box' => true
			),
			'mt' => array(
				'type' => 'spinner',
				'title' => esc_html__('Margin top', 'creatus'),
				'box' => true
			),
			'ml' => array(
				'type' => 'spinner',
				'title' => esc_html__('Margin left', 'creatus'),
				'box' => true
			),
			'br' => array(
				'type' => 'spinner',
				'title' => esc_html__('Border radius', 'creatus')
			)
		)
	),
	'woopbf' => array(
		'type' => 'thz-typography',
		'label' => __('Badges font metrics', 'creatus'),
		'desc' => esc_html__('Adjust badges font metrics.', 'creatus'),
		'value' => array(
			'size' => 12,
			'weight' => 600,
		),
		'disable' => array('color','hovered','align'),
	),
	'woopbagc' => array(
		'type' => 'thz-multi-options',
		'label' => __('Badge colors', 'creatus'),
		'desc' => esc_html__('Adjust sales and out of stock badge colors and border radius', 'creatus'),
		'value' => array(
			'sbg' => '#1ecb67',
			'sco' => '#ffffff',
			'obg' => '#ff4542',
			'oco' => '#ffffff'
		),
		'thz_options' => array(
			'sbg' => array(
				'type' => 'color',
				'title' => esc_html__('Sales bg', 'creatus'),
				'box' => true
			),
			'sco' => array(
				'type' => 'color',
				'title' => esc_html__('Sales color', 'creatus'),
				'box' => true
			),
			'obg' => array(
				'type' => 'color',
				'title' => esc_html__('Out bg', 'creatus'),
				'box' => true
			),
			'oco' => array(
				'type' => 'color',
				'title' => esc_html__('Out color', 'creatus'),
				'box' => true
			)
		)
	),
	'woopaco' => array(
		'type' => 'thz-multi-options',
		'label' => __('Action icons colors', 'creatus'),
		'desc' => esc_html__('Set ajax action icons color. Add to cart ajax spinner and check icon.', 'creatus'),
		'value' => array(
			'spin' => '#ffffff',
			'check' => '#ffffff'
		),
		'thz_options' => array(
			'spin' => array(
				'type' => 'color',
				'title' => esc_html__('Spinner', 'creatus'),
				'box' => true
			),
			'check' => array(
				'type' => 'color',
				'title' => esc_html__('Check', 'creatus'),
				'box' => true
			)
		)
	),
	'woopfc' => array(
		'type' => 'thz-multi-options',
		'label' => __('Price filter colors', 'creatus'),
		'desc' => esc_html__('Adjust WooCommerce price filter widget colors', 'creatus'),
		'value' => array(
			'sbg' => '#cccccc',
			'rbg' => 'color_1',
			'hbg' => '#ffffff',
			'hbo' => '#cccccc'
		),
		'thz_options' => array(
			'sbg' => array(
				'type' => 'color',
				'title' => esc_html__('Slider bg', 'creatus'),
				'box' => true
			),
			'rbg' => array(
				'type' => 'color',
				'title' => esc_html__('Range bg', 'creatus'),
				'box' => true
			),
			'hbg' => array(
				'type' => 'color',
				'title' => esc_html__('Handle bg', 'creatus'),
				'box' => true
			),
			'hbo' => array(
				'type' => 'color',
				'title' => esc_html__('Handle border', 'creatus'),
				'box' => true
			)
		)
	),
	'woocrgrid' => array(
		'type' => 'thz-multi-options',
		'label' => __('Cross sell grid settings', 'creatus'),
		'desc' => esc_html__('Set cross-sell products grid columns, gutter, number of items and image size', 'creatus'),
		'value' => array(
			'columns' => 4,
			'gutter' => 30,
			'items' => 4,
			'imgs' => 'thz-img-small'
		),
		'thz_options' => array(
			'gutter' => array(
				'type' => 'spinner',
				'title' => esc_html__('Gutter', 'creatus'),
				'addon' => 'px',
				'min' => 0,
				'max' => 100
			),
			'columns' => array(
				'type' => 'select',
				'title' => esc_html__('Columns', 'creatus'),
				'choices' => array(
					'1' => esc_html__('1', 'creatus'),
					'2' => esc_html__('2', 'creatus'),
					'3' => esc_html__('3', 'creatus'),
					'4' => esc_html__('4', 'creatus'),
					'5' => esc_html__('5', 'creatus'),
					'6' => esc_html__('6', 'creatus')
				)
			),
			'items' => array(
				'type' => 'spinner',
				'title' => esc_html__('Items', 'creatus'),
				'addon' => '#',
				'min' => 1,
				'max' => 100
			),
			'imgs' => array(
				'type' => 'short-select',
				'title' => esc_html__('Image size', 'creatus'),
				'choices' => thz_get_image_sizes_list( true )
			),
		)
	),

);