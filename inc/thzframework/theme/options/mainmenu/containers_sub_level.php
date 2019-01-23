<?php
if (!defined('FW'))
	die('Forbidden');
	
$options = array(

	'tm_subul_style' => array(
		'type' => 'thz-box-style',
		'label' => __('Sub level ul style', 'creatus'),
		'button-text' => esc_html__('Customize sub level ul box style', 'creatus'),
		'popup' => true,
		'attr' => array(
			'data-tminputid' => 'tm_subul_style',
			'data-changing' => 'border,box-shadow,background,background-color'
		),
		'disable' => array(
			'layout',
			'margin',
			'boxsize',
			'borderradius',
			'video',
			'image',
			'gradient',
			'transform'
		),
		'value' => array(
			'padding' => array(
				'top' => 15,
				'right' => 15,
				'bottom' => 15,
				'left' => 15
			),
			'boxshadow' => array(
				1 => array(
					'inset' => false,
					'horizontal-offset' => 0,
					'vertical-offset' => 8,
					'blur-radius' => 28,
					'spread-radius' => 0,
					'shadow-color' =>'rgba(0,0,0,0.08)'
				)
			),
			'background' => array(
				'type' => 'color',
				'color' => '#ffffff'
			)
		)
	),
	'tm_subul_radius' => array(
		'type' => 'thz-slider',
		'showinput' => true,
		'value' => 0,
		'attr' => array(
			'data-tminputid' => 'tm_subul_radius'
		),
		'label' => __('Sub level ul border radius', 'creatus'),
		'desc' => esc_html__('Set sub level ul border radius.', 'creatus')
	),
	'tm_subli_border' => array(
		'type' => 'thz-box-style',
		'label' => 'Sub level li border',
		'attr' => array(
			'data-tminputid' => 'tm_subli_border',
			'data-changing' => 'border'
		),
		'disable' => array(
			'layout',
			'padding',
			'margin',
			'borderradius',
			'boxsize',
			'boxshadow',
			'background'
		),
		'value' => array()
	),
	'tm_top_offset' => array(
		'type' => 'thz-slider',
		'value' => '10',
		'properties' => array(
			'min' => -200,
			'max' => 200
		),
		'showinput' => true,
		'attr' => array(
			'data-tminputid' => 'tm_top_offset'
		),
		'label' => __('First sub level top offset', 'creatus'),
		'desc' => esc_html__('Set first sub level top offset', 'creatus'),
		'help' => esc_html__('This is the first sub level flyout position. All first sub level flyouts start at the very bottom of your top menu. This settings can move them down ( e.g. 30px ) from their orignal position.', 'creatus')
	),
	'tm_left_offset' => array(
		'type' => 'thz-slider',
		'value' => '10',
		'properties' => array(
			'min' => -200,
			'max' => 200
		),
		'showinput' => true,
		'attr' => array(
			'data-tminputid' => 'tm_left_offset'
		),
		'label' => __('Next sub level left offset', 'creatus'),
		'desc' => esc_html__('Set next sub level left offset', 'creatus'),
		'help' => esc_html__('This is the next sub level level flyout position. All second level flyouts start at the very left of their parent holder. This settings can move them to the right( e.g. 30px ) from their orignal position.', 'creatus')
	),
	
	'tm_sep_bs' => array(
		'type' => 'thz-box-style',
		'label' => __('Separator box style', 'creatus'),
		'preview' => true,
		'button-text' => esc_html__('Adjust separator box style', 'creatus'),
		'desc' => esc_html__('Adjust a.items-separator box tyle', 'creatus'),
		'popup' => true,
		'disable' => array(
			'layout',
			'boxsize',
			'transform',
			'video'
		),
		'value' => array(
			'padding' => array(
				'top' => 0,
				'right' => 15,
				'bottom' => 7.5,
				'left' => 15
			),
			'margin' => array(
				'top' => 15,
				'right' => 0,
				'bottom' => 0,
				'left' => 0
			)
		),
		'units' => array(
			'borderradius',
			'padding',
			'margin',
		),
		'desc' => esc_html__('Adjust separator item box style', 'creatus')
	),
	'tm_sepf' => array(
		'type' => 'thz-typography',
		'label' => __('Separator item font', 'creatus'),
		'desc' => esc_html__('Adjust separator item font metrics.', 'creatus'),
		'value' => array(
			'family' => 'Creatus',
			'weight' => 500,
			'subset' => 'ffk',
			'transform' => 'uppercase',
			'size' => '12',
			'spacing' => '0.3px',
		),
	),

);
