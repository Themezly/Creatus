<?php
if (!defined('FW')) {
	die('Forbidden');
}
$options = array(
	'wooupgrid' => array(
		'type' => 'thz-multi-options',
		'label' => __('Up sells grid settings', 'creatus'),
		'desc' => esc_html__('Set up sells grid columns, gutter, number of items and image size', 'creatus'),
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
	
	'wu_rbs' => array(
		'type' => 'thz-box-style',
		'label' => __('Up sells row box style', 'creatus'),
		'preview' => true,
		'button-text' => esc_html__('Customize up sells row box style', 'creatus'),
		'desc' => esc_html__('Adjust .thz-product-up-sells-row box style', 'creatus'),
		'popup' => true,
		'disable' => array('video'),
		'value' => array()
	),
	
	'wu_rhs' => array(
		'type' => 'thz-box-style',
		'label' => __('Up sells holder box style', 'creatus'),
		'preview' => true,
		'button-text' => esc_html__('Customize up sells holder box style', 'creatus'),
		'desc' => esc_html__('Adjust .thz-woo-up-sells-holder box style', 'creatus'),
		'popup' => true,
		'disable' => array('video'),
		'value' => array(
			'padding' => array(
				'top' => 60,
				'right' => 0,
				'bottom' => 60,
				'left' => 0
			),
			'borders' => array(
				'all' => 'separate',
				'top' => array(
					'w' => 1,
					's' => 'solid',
					'c' => 'color_4'
				),
				'right' => array(
					'w' => 0,
					's' => 'solid',
					'c' => ''
				),
				'bottom' => array(
					'w' => 0,
					's' => 'solid',
					'c' => ''
				),
				'left' => array(
					'w' => 0,
					's' => 'solid',
					'c' => ''
				),
			),
		)
	),

	'wu_ut' => array(
		'type' => 'text',
		'value' => 'You may also like...',
		'label' => __('Up sells heading text', 'creatus'),
		'desc' => esc_html__('Insert up sell products heading text', 'creatus')
	),
				
	'wu_hef' => array(
		'type' => 'thz-typography',
		'label' => __('Up sells heading metrics', 'creatus'),
		'desc' => esc_html__('Adjust up sells heading font metrics.', 'creatus'),
		'value' => array(
			'size' => 20,
			'align' => 'center'
		),
	),
	'wu_hebs' => array(
		'type' => 'thz-box-style',
		'label' => __('Up sells heading box style', 'creatus'),
		'desc' => esc_html__('Adjust .thz-woo-up-sells-heading box style','creatus'),
		'preview' => true,
		'button-text' => esc_html__('Customize up sells heading box style', 'creatus'),
		'popup' => true,
		'disable' => array('layout','video','boxsize','transform'),
		'value' => array(
			'margin' => array(
				'top' => 0,
				'right' => 'auto',
				'bottom' => 60,
				'left' => 'auto'
			),
		)
	),
);