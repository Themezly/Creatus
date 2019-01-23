<?php
if (!defined('FW'))
	die('Forbidden');
$options = array(
	// typo
	'tf' => array(
		'type' => 'addable-popup',
		'value' => array(),
		'label' => __('Fonts settings', 'creatus'),
		'desc' => esc_html__('Add custom font settings', 'creatus'),
		'template' => '<b>' . esc_html__('Custom font settings are active', 'creatus') . '</b>',
		'popup-title' => esc_html__('Fonts settings', 'creatus'),
		'size' => 'large',
		'add-button-text' => esc_html__('Click to add custom fonts settings', 'creatus'),
		'sortable' => false,
		'limit' => 1,
		'popup-options' => array(
			'f' => array(
				'label' => __('Text font', 'creatus'),
				'type' => 'thz-typography',
				'value' => fw_get_db_settings_option('body_font',null),
				'disable' => array('hovered','text-shadow'),
				'desc' => esc_html__('Text font color family and metrics', 'creatus'),
				
			),
			'h' => array(
				'label' => __('Headings font-family', 'creatus'),
				'type' => 'thz-typography',
				'value' => fw_get_db_settings_option('headings_font',null),
				'disable' => array('size','line-height','spacing','align','color','hovered','text-shadow'),
				'desc' => esc_html__('H1, H2, H3, H4, H5 & H6 font-family.', 'creatus')
			),
			'h1' => array(
				'label' => __('H1 font metrics', 'creatus'),
				'type' => 'thz-typography',
				'value' => fw_get_db_settings_option('h1_font',null),
				'disable' => array('family','weight','style','transform','align','hovered','text-shadow'),
			),
			'h2' => array(
				'label' => __('H2 font metrics', 'creatus'),
				'type' => 'thz-typography',
				'value' => fw_get_db_settings_option('h2_font',null),
				'disable' => array('family','weight','style','transform','align','hovered','text-shadow'),
			),
			'h3' => array(
				'label' => __('H3 font metrics', 'creatus'),
				'type' => 'thz-typography',
				'value' => fw_get_db_settings_option('h3_font',null),
				'disable' => array('family','weight','style','transform','align','hovered','text-shadow'),
			),
			'h4' => array(
				'label' => __('H4 font metrics', 'creatus'),
				'type' => 'thz-typography',
				'value' => fw_get_db_settings_option('h4_font',null),
				'disable' => array('family','weight','style','transform','align','hovered','text-shadow'),
			),
			'h5' => array(
				'label' => __('H5 font metrics', 'creatus'),
				'type' => 'thz-typography',
				'value' => fw_get_db_settings_option('h5_font',null),
				'disable' => array('family','weight','style','transform','align','hovered','text-shadow'),
			),
			'h6' => array(
				'label' => __('H6 font metrics', 'creatus'),
				'type' => 'thz-typography',
				'value' => fw_get_db_settings_option('h6_font',null),
				'disable' => array('family','weight','style','transform','align','hovered','text-shadow'),
			)
		)
	),
	// color set
	'tl' => array(
		'type' => 'addable-popup',
		'value' => array(),
		'label' => __('Links colors', 'creatus'),
		'desc' => esc_html__('Add custom links colors', 'creatus'),
		'template' => '<b>' . esc_html__('Custom links colors are active', 'creatus') . '</b>',
		'popup-title' => esc_html__('Custom links', 'creatus'),
		'size' => 'small',
		'add-button-text' => esc_html__('Click to add custom links colors', 'creatus'),
		'sortable' => false,
		'limit' => 1,
		'popup-options' => array(
			'c' => array(
				'type' => 'thz-colorset',
				'value' => array(
					'link_color' => fw_get_db_settings_option('sitelc/lc',null),
					'link_hover_color' => fw_get_db_settings_option('sitelc/lh',null)
				),
				'label' => __('Custom links colors', 'creatus'),
				'desc' => esc_html__('Add custom links colors.', 'creatus'),
			)
		)
	)
);