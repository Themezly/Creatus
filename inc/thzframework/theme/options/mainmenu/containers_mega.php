<?php
if (!defined('FW'))
	die('Forbidden');
	
$options = array(

	'tm_mr_co' => array(
		'label' => __('Row contained?', 'creatus'),
		'desc' => esc_html__('If set to contained .mega-menu-row will be contained by max site width', 'creatus'),
		'type' => 'switch',
		'right-choice' => array(
			'value' => 'contained',
			'label' => __('Contained', 'creatus')
		),
		'left-choice' => array(
			'value' => 'notcontained',
			'label' => __('Not contained', 'creatus')
		),
		'value' => 'notcontained',
		'help' => esc_html__('If header is not contained than the mega menu row stretches as wide as the header. This option can limit the mega menu row to always have the same max-width.', 'creatus')
	),				

	'tm_mr_bs' => array(
		'type' => 'thz-box-style',
		'label' => __('Row box style', 'creatus'),
		'desc' => esc_html__('Adjust .mega-menu-row box style','creatus'),
		'preview' => true,
		'button-text' => esc_html__('Customize row box style', 'creatus'),
		'popup' => true,
		'disable' => array('layout','margin','borders','borderradius','boxsize','transform','video','shape'),
		'units' => array(
			'borderradius',
			'boxsize',
			'padding',
			'margin',
		),
		'value' => array(),
		'desc' => esc_html__('Adjust mega menu row box style', 'creatus')
	),
	'tm_mr_cbs' => array(
		'type' => 'thz-box-style',
		'label' => __('Columns padding', 'creatus'),
		'disable' => array(
			'layout',
			'margin',
			'borders',
			'borderradius',
			'boxsize',
			'transform',
			'boxshadow',
			'background'
		),
		'value' => array(
			'padding' => array(
				'top' => 30,
				'right' => 30,
				'bottom' => 30,
				'left' => 30
			)
		),
		'desc' => esc_html__('Adjust mega menu columns padding', 'creatus')
	),
	'tm_mr_cmx' => array(
		'type' => 'thz-multi-options',
		'label' => __('Columns separator', 'creatus'),
		'desc' => esc_html__('Ajust the columns separator. This is a side border between the columns.', 'creatus'),
		'value' => array(
			't' => 'show',
			'w' => 1,
			's' => 'solid',
			'c' => 'color_4'
		),
		'thz_options' => array(
			't' => array(
				'title' => esc_html__('Show/hide', 'creatus'),
				'type' => 'short-select',
				'value' => 'show',
				'attr' => array(
					'class' => 'thz-select-switch'
				),
				'choices' => array(
					'show' => array(
						'text' => esc_html__('Show', 'creatus'),
						'attr' => array(
							'data-enable' => '.mega-col-sep-parent'
						)
					),
					'hide' => array(
						'text' => esc_html__('Hide', 'creatus'),
						'attr' => array(
							'data-disable' => '.mega-col-sep-parent'
						)
					)
				)
			),
			'w' => array(
				'type' => 'spinner',
				'title' => esc_html__('Width', 'creatus'),
				'addon' => 'px',
				'min' => 0,
				'attr' => array(
					'class' => 'mega-col-sep'
				)
			),
			's' => array(
				'type' => 'short-select',
				'title' => esc_html__('Style', 'creatus'),
				'choices' => array(
					'solid' => esc_html__('Solid', 'creatus'),
					'dashed' => esc_html__('Dashed', 'creatus'),
					'dotted' => esc_html__('Dotted', 'creatus')
				),
				'attr' => array(
					'class' => 'mega-col-sep'
				)
			),
			'c' => array(
				'type' => 'color',
				'title' => esc_html__('Color', 'creatus'),
				'box' => true,
				'attr' => array(
					'class' => 'mega-col-sep'
				)
			)
		)
	),
	'tm_mr_ctp' => array(
		'type' => 'thz-box-style',
		'label' => __('Columns title box style', 'creatus'),
		'preview' => true,
		'button-text' => esc_html__('Customize column title box style', 'creatus'),
		'desc' => esc_html__('Adjust a.holdsgroupTitle box tyle', 'creatus'),
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
			)
		),
		'units' => array(
			'borderradius',
			'padding',
			'margin',
		),
		'desc' => esc_html__('Adjust mega menu columns title box style', 'creatus')
	),
	'tm_mr_ctf' => array(
		'type' => 'thz-typography',
		'label' => __('Columns titles font', 'creatus'),
		'desc' => esc_html__('Adjust mega menu columns titles font metrics.', 'creatus'),
		'value' => array(
			'family' => 'Creatus',
			'weight' => 500,
			'subset' => 'ffk',
			'transform' => 'uppercase',
			'size' => '12',
			'spacing' => '0.3px',
		),
	)

);
