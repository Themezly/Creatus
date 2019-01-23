<?php
if (!defined('FW'))
	die('Forbidden');
	
$options = array(
	'tm_active_link' => array(
		'type' => 'thz-multi-options',
		'label' => __('Top level active link colors', 'creatus'),
		'desc' => esc_html__('Set top level active item colors', 'creatus'),
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
					'data-tminputid' => 'tm_active_link'
				)
			),
			'bg' => array(
				'type' => 'color',
				'title' => esc_html__('Background', 'creatus'),
				'box' => true,
				'attr' => array(
					'data-tminputid' => 'tm_active_link_bg'
				)
			)
		)
	),
	'tm_active_link_border' => array(
		'type' => 'thz-box-style',
		'label' => 'Top level active link border',
		'attr' => array(
			'data-tmborders' => 'tm_active_link_border',
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
	'tm_subul_active_link' => array(
		'type' => 'thz-multi-options',
		'label' => __('Sub level active link colors', 'creatus'),
		'desc' => esc_html__('Set sub level active item colors', 'creatus'),
		'value' => array(
			'co' => 'color_2',
			'bg' => '#f9f9f9'
		),
		'thz_options' => array(
			'co' => array(
				'type' => 'color',
				'title' => esc_html__('Color', 'creatus'),
				'box' => true,
				'attr' => array(
					'data-tminputid' => 'tm_subul_active_link'
				)
			),
			'bg' => array(
				'type' => 'color',
				'title' => esc_html__('Background', 'creatus'),
				'box' => true,
				'attr' => array(
					'data-tminputid' => 'tm_subul_active_link_bg'
				)
			)
		)
	)
);
