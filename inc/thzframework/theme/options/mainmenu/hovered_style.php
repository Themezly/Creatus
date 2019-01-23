<?php
if (!defined('FW'))
	die('Forbidden');
	
$options = array(
	'tm_link_hover' => array(
		'type' => 'thz-multi-options',
		'label' => __('Top level hovered link colors', 'creatus'),
		'desc' => esc_html__('Set top level hovered item colors', 'creatus'),
		'value' => array(
			'co' => 'rgba(82, 82, 82, 0.58)',
			'bg' => 'rgba(255,255,255,0)'
		),
		'thz_options' => array(
			'co' => array(
				'type' => 'color',
				'title' => esc_html__('Color', 'creatus'),
				'box' => true,
				'attr' => array(
					'data-tminputid' => 'tm_link_hover'
				)
			),
			'bg' => array(
				'type' => 'color',
				'title' => esc_html__('Background', 'creatus'),
				'box' => true,
				'attr' => array(
					'data-tminputid' => 'tm_link_hover_bg'
				)
			)
		)
	),
	'tm_link_hover_border' => array(
		'type' => 'thz-box-style',
		'label' => 'Top level hovered link border',
		'attr' => array(
			'data-tmborders' => 'tm_link_hover_border',
			'data-changing' => 'border'
		),
		'disable' => array(
			'layout',
			'padding',
			'margin',
			'borderradius',
			'boxsize',
			'transform',
			'boxshadow',
			'background'
		),
		'value' => array()
	),
	'tm_subul_link_hover' => array(
		'type' => 'thz-multi-options',
		'label' => __('Sub level hovered link colors', 'creatus'),
		'desc' => esc_html__('Set sub level hovered item colors', 'creatus'),
		'value' => array(
			'co' => 'color_2',
			'bg' => 'color_5'
		),
		'thz_options' => array(
			'co' => array(
				'type' => 'color',
				'title' => esc_html__('Color', 'creatus'),
				'box' => true,
				'attr' => array(
					'data-tminputid' => 'tm_subul_link_hover'
				)
			),
			'bg' => array(
				'type' => 'color',
				'title' => esc_html__('Background', 'creatus'),
				'box' => true,
				'attr' => array(
					'data-tminputid' => 'tm_subul_link_hover_bg'
				)
			)
		)
	)
);
