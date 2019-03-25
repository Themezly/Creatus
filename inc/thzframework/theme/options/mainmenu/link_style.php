<?php
if (!defined('FW'))
	die('Forbidden');
	
$options = array(
	'tm_link' => array(
		'type' => 'thz-multi-options',
		'label' => __('Top level link colors', 'creatus'),
		'desc' => esc_html__('Set top level link colors', 'creatus'),
		'value' => array(
			'co' => 'color_2',
			'bg' => 'rgba(255,255,255,0)'
		),
		'thz_options' => array(
			'co' => array(
				'type' => 'color',
				'title' => esc_html__('Color', 'creatus'),
				'box' => true,
				'attr' => array(
					'data-tminputid' => 'tm_link'
				)
			),
			'bg' => array(
				'type' => 'color',
				'title' => esc_html__('Background', 'creatus'),
				'box' => true,
				'attr' => array(
					'data-tminputid' => 'tm_link_bg'
				)
			)
		)
	),
	'tm_tl_border' => array(
		'type' => 'thz-box-style',
		'label' => __('Top level link border', 'creatus'),
		'attr' => array(
			'data-tmborders' => 'tm_tl_border',
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
	'tm_subul_link' => array(
		'type' => 'thz-multi-options',
		'label' => __('Sub level link colors', 'creatus'),
		'desc' => esc_html__('Set sub level item colors', 'creatus'),
		'value' => array(
			'co' => 'color_2',
			'bg' => '#ffffff'
		),
		'thz_options' => array(
			'co' => array(
				'type' => 'color',
				'title' => esc_html__('Color', 'creatus'),
				'box' => true,
				'attr' => array(
					'data-tminputid' => 'tm_subul_link'
				)
			),
			'bg' => array(
				'type' => 'color',
				'title' => esc_html__('Background', 'creatus'),
				'box' => true,
				'attr' => array(
					'data-tminputid' => 'tm_subul_link_bg'
				)
			)
		)
	)
);
