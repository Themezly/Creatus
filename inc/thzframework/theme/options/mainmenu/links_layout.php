<?php
if (!defined('FW'))
	die('Forbidden');
	
$options = array(
	'tm_tl_icon' => array(
		'type' => 'thz-icon',
		'value' => 'fa fa-angle-down',
		'label' => __('Top level child indicator', 'creatus'),
		'attr' => array(
			'class' => 'thz-child-toplevel'
		)
	),
	'tm_tl_height' => array(
		'type' => 'thz-slider',
		'value' => 80,
		'showinput' => true,
		'attr' => array(
			'data-tminputid' => 'tm_tl_height'
		),
		'properties' => array(
			'min' => 0,
			'max' => 300,
			'sep' => 1
		),
		'label' => __('Top level link height', 'creatus'),
		'desc' => esc_html__('Set top level link height. The menu height will be adjusted to this option.', 'creatus')
	),
	'tm_tl_boxstyle' => array(
		'type' => 'thz-box-style',
		'label' => __('Top level link padding', 'creatus'),
		'attr' => array(
			'data-tminputid' => 'tm_tl_boxstyle',
			'data-changing' => 'padding'
		),
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
				'top' => '0',
				'right' => '15',
				'bottom' => '0',
				'left' => '15'
			)
		)
	),
	'tm_tl_spacing' => array(
		'type' => 'thz-slider',
		'value' => 0,
		'showinput' => true,
		'attr' => array(
			'data-tminputid' => 'tm_tl_spacing'
		),
		'label' => __('Top level links spacing', 'creatus'),
		'desc' => esc_html__('Adjust space between the top level links.', 'creatus')
	),
	'tm_tl_radius' => array(
		'type' => 'thz-slider',
		'showinput' => true,
		'value' => 0,
		'attr' => array(
			'data-tminputid' => 'tm_tl_radius'
		),
		'label' => __('Top level link border radius', 'creatus'),
		'desc' => esc_html__('Set top level link border radius.', 'creatus')
	),
	'tm_sl_icon' => array(
		'type' => 'thz-icon',
		'value' => 'fa fa-angle-right',
		'label' => __('Sub levelel child indicator', 'creatus'),
		'attr' => array(
			'class' => 'thz-child-sublevel'
		)
	),
	'tm_subul_link_width' => array(
		'type' => 'thz-slider',
		'showinput' => true,
		'value' => 250,
		'attr' => array(
			'data-tminputid' => 'tm_subul_link_width'
		),
		'properties' => array(
			'min' => 0,
			'max' => 500,
			'sep' => 1
		),
		'label' => __('Sub level link width', 'creatus'),
		'desc' => esc_html__('Set sub level elements width', 'creatus'),
		'help' => esc_html__('Define sub level menu elements width here. This setting will not affect Mega Menu group holder elements width.', 'creatus')
	),
	'tm_subul_link_height' => array(
		'type' => 'thz-slider',
		'value' => 40,
		'showinput' => true,
		'attr' => array(
			'data-tminputid' => 'tm_subul_link_height'
		),
		'properties' => array(
			'min' => 0,
			'max' => 200,
			'sep' => 1
		),
		'label' => __('Sub level link height', 'creatus'),
		'desc' => esc_html__('Set sub level link height.', 'creatus')
	),
	'tm_sl_boxstyle' => array(
		'type' => 'thz-box-style',
		'label' => __('Sub level link padding', 'creatus'),
		'attr' => array(
			'data-tminputid' => 'tm_sl_boxstyle',
			'data-changing' => 'padding'
		),
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
				'top' => 0,
				'right' => 15,
				'bottom' => 0,
				'left' => 15
			)
		)
	),
	
	'tm_sl_radius' => array(
		'type' => 'thz-slider',
		'showinput' => true,
		'value' => 4,
		'attr' => array(
			'data-tminputid' => 'tm_sl_radius'
		),
		'label' => __('Sub level link border radius', 'creatus'),
		'desc' => esc_html__('Set sub level link border radius.', 'creatus')
	),

);
