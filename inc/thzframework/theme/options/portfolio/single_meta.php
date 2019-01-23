<?php
if (!defined('FW')) {
	die('Forbidden');
}
$options = array(
	'ppmcbs' => array(
		'type' => 'thz-box-style',
		'label' => __('Meta container box style', 'creatus'),
		'preview' => true,
		'button-text' => esc_html__('Customize project meta container box style', 'creatus'),
		'desc' => esc_html__('Adjust .thz-project-meta-container box style', 'creatus'),
		'popup' => true,
		'disable' => array('layout','video','boxsize','transform'),
		'value' => array(
			'margin' => array(
				'top' => '0',
				'right' => 'auto',
				'bottom' => 60,
				'left' => 'auto'
			),
		)
	),
	'ppmbs' => array(
		'type' => 'thz-box-style',
		'label' => __('Meta box style', 'creatus'),
		'preview' => true,
		'button-text' => esc_html__('Customize project meta item box style', 'creatus'),
		'desc' => esc_html__('Adjust .thz-project-meta box style', 'creatus'),
		'popup' => true,
		'disable' => array('layout','video','boxsize','transform'),
		'value' => array(
			'padding' => array(
				'top' => '0',
				'right' => '0',
				'bottom' => '15',
				'left' => '0'
			),
			'margin' => array(
				'top' => '0',
				'right' => 'auto',
				'bottom' => '15',
				'left' => 'auto'
			),
			'borders' => array(
				'all'=> 'separate',			
				'top'=> array(
					'w' => 0,
					's' => 'solid',
					'c' => ''
				),
				'right'=> array(
					'w' => 0,
					's' => 'solid',
					'c' => ''
				),
				'bottom'=> array(
					'w' => 1,
					's' => 'solid',
					'c' => 'color_4'
				),
				'left'=> array(
					'w' => 0,
					's' => 'solid',
					'c' => ''
				)
			),
		)
	),

	'ppmlw' => array(
		'type' => 'thz-spinner',
		'label' => __('Meta label width', 'creatus'),
		'desc' => esc_html__('Set project meta label width', 'creatus'),
		'addon' => '%',
		'min' => 0,
		'max' => 100,
		'value' => 30
	),
	'ppmlm' => array(
		'type' => 'thz-typography',
		'label' => __('Meta label font metrics', 'creatus'),
		'desc' => esc_html__('Adjust project meta label font metrics.', 'creatus'),
		'value' => array(
			'size' => 14,
			'weight' => 600,
			'color' => 'color_2'
		),
		'disable' => array('hovered','align','text-shadow'),
	),
	'ppmm' => array(
		'type' => 'thz-typography',
		'label' => __('Meta font metrics', 'creatus'),
		'desc' => esc_html__('Adjust project meta font metrics.', 'creatus'),
		'value' => array(),
		'disable' => array('color','hovered','align','text-shadow'),
	),
	'ppmc' => array(
		'type' => 'thz-multi-options',
		'label' => __('Meta item metrics', 'creatus'),
		'desc' => esc_html__('Adjust meta item resets and colors. Theme colors are inherited if empty', 'creatus'),
		'value' => array(
			'pr' => 'donotreset',
			'mr' => 'donotreset',
			'bo' => 'last_bottom',
			'co' => '',
			'lc' => '',
			'hc' => ''
		),
		'thz_options' => array(
			'pr' => array(
				'type' => 'short-select',
				'title' => esc_html__('Padding reset', 'creatus'),
				'choices' => array(
					'first_top' => esc_html__('Reset first item top padding', 'creatus'),
					'first_bottom' => esc_html__('Reset first item bottom padding', 'creatus'),
					'last_top' => esc_html__('Reset last item top padding', 'creatus'),
					'last_bottom' => esc_html__('Reset last item bottom padding', 'creatus'),
					'donotreset' => esc_html__('Do not reset', 'creatus'),
				)
			),
			'mr' => array(
				'type' => 'short-select',
				'title' => esc_html__('Margin reset', 'creatus'),
				'choices' => array(
					'first_top' => esc_html__('Reset first item top margin', 'creatus'),
					'first_bottom' => esc_html__('Reset first item bottom margin', 'creatus'),
					'last_top' => esc_html__('Reset last item top margin', 'creatus'),
					'last_bottom' => esc_html__('Reset last item bottom margin', 'creatus'),
					'donotreset' => esc_html__('Do not reset', 'creatus'),
				)
			),
			
			'bo' => array(
				'type' => 'short-select',
				'title' => esc_html__('Borders reset', 'creatus'),
				'choices' => array(
					'first_top' => esc_html__('Reset first item top border', 'creatus'),
					'first_bottom' => esc_html__('Reset first item bottom border', 'creatus'),
					'last_top' => esc_html__('Reset last item top border', 'creatus'),
					'last_bottom' => esc_html__('Reset last item bottom border', 'creatus'),
					'donotreset' => esc_html__('Do not reset', 'creatus'),
				)
			),
			'co' => array(
				'type' => 'color',
				'title' => esc_html__('Text', 'creatus'),
				'box' => true
			),
			'lc' => array(
				'type' => 'color',
				'title' => esc_html__('Link', 'creatus'),
				'box' => true
			),
			'hc' => array(
				'type' => 'color',
				'title' => esc_html__('Link Hovered', 'creatus'),
				'box' => true
			)
		)
	)
);