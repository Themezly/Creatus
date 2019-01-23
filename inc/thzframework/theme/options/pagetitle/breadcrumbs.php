<?php
if (!defined('FW'))
	die('Forbidden');

$options = array(
	'pt_font' => array(
		'type' => 'thz-typography',
		'label' => __('Breadcrumbs font', 'creatus'),
		'desc' => esc_html__('Breadcrumbs  font metrics', 'creatus'),
		'value' => array(
			'size' => 13,
		),
		'disable' => array('color','hovered','align'),
	),
	'pt_colors' => array(
		'type' => 'thz-multi-options',
		'label' => __('Breadcrumbs colors', 'creatus'),
		'desc' => esc_html__('Breadcrumbs font colors. If empty, colors are inhereted from theme.', 'creatus'),
		'value' => array(
			'text' => '',
			'link' => '',
			'hover' => '',
			'sep' =>'',
		),
		'thz_options' => array(
			'text' => array(
				'type' => 'color',
				'title' => esc_html__('Text', 'creatus'),
				'box' => true
			),
			'link' => array(
				'type' => 'color',
				'title' => esc_html__('Link', 'creatus'),
				'box' => true
			),
			'hover' => array(
				'type' => 'color',
				'title' => esc_html__('Hovered link', 'creatus'),
				'box' => true
			),
			'sep' => array(
				'type' => 'color',
				'title' => esc_html__('Separator', 'creatus'),
				'box' => true
			),
		)
	),
	
	'pt_sep' => array(
		'type' => 'thz-multi-options',
		'label' => __('Breadcrumbs Separator', 'creatus'),
		'desc' => esc_html__('Select separator type and adjust space between separator and breadcrumbs', 'creatus'),
		'help' => esc_html__('This option will let you adjust space between separator and breadcrumbs. Nudge option can help you align the separator verticaly. This can come in handy if separator is icon and icon font does not place the icon in absolute vertical middle. Nudge moves relative top position of the separator.', 'creatus'),
		'value' => array(
			'ty' => 'textual',
			't' => '/',
			'i' => 'fa fa-angle-right',
			'fs' => '',
			's' => 5,
			'n' => 0,
		),
		'thz_options' => array(
			'ty' => array(
				'title' => esc_html__('Type', 'creatus'),
				'type' => 'short-select',
				'value' => 'show',
				'attr' => array(
					'class' => 'thz-select-switch'
				),
				'choices' => array(
					'textual' => array(
						'text' => esc_html__('Textual', 'creatus'),
						'attr' => array(
							'data-enable' => '.pt_sep-text-parent',
							'data-disable' => '.pt_sep-icon-parent',
							
						)
					),
					'icon' => array(
						'text' => esc_html__('Icon', 'creatus'),
						'attr' => array(
							'data-enable' => '.pt_sep-icon-parent',
							'data-disable' => '.pt_sep-text-parent',
							
						)
					),
				)
			),
			't' => array(
				'type' => 'short-text',
				'title' => esc_html__('Separator', 'creatus'),
				'attr' => array(
					'class' => 'pt_sep-text'
				),
			),
			'i' => array(
				'type' => 'icon',
				'title' => esc_html__('Icon', 'creatus'),
				'attr' => array(
					'class' => 'pt_sep-icon'
				),
			),
			'fs' => array(
				'type' => 'spinner',
				'title' => esc_html__('Size', 'creatus'),
				'addon' => 'px',
				'min' => 0,
				'max' => 100
			),
			's' => array(
				'type' => 'spinner',
				'title' => esc_html__('Space', 'creatus'),
				'addon' => 'px',
				'max' => 100,
			),
			'n' => array(
				'type' => 'spinner',
				'title' => esc_html__('Nudge', 'creatus'),
				'addon' => 'px',
				'min' => -20,
				'max' => 20,
			),

		)
	),
	
	'pti_bca' => array(
		'type' => 'thz-animation',
		'label' => false,
		'value' => array(
			'animate' => 'inactive',
			'effect' => 'thz-anim-fadeIn',
			'duration' => 400,
			'delay' => 0
		),
		'addlabel' => esc_html__('Animate breadcrumbs', 'creatus'),
		'adddesc' => esc_html__('Add animation to breadcrumbs container', 'creatus')
	),

);