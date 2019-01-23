<?php if ( ! defined( 'FW' ) ) die( 'Forbidden' );

$palette = apply_filters ('thz_filter_palette_colors', array(
	'color_1' => '#039bf4',
	'color_2' => '#2c2e30',
	'color_3' => '#8f8f8f',
	'color_4' => '#eaeaea',
	'color_5' => '#fafafa',
	'color_6' => '',
	'color_7' => '',
	'color_8' => '',
	'color_9' => '',
	'color_10' => '',
));

$options_set 	= array(
	'theme_palette' => array(
		'type' => 'thz-palette',
		'label' => __('Theme palette', 'creatus'),
		'value' => $palette
	),
	'body_boxstyle' => array(
		'type' => 'thz-box-style',
		'label' => __('Body box style', 'creatus'),
		'preview' => true,
		'button-text' => esc_html__('Customize body box style', 'creatus'),
		'desc' => esc_html__('Customize body box style', 'creatus'),
		'popup' => true,
		'disable' => array('layout','boxsize','transform','borderradius','transform'),
		'value' => array(
			'background' => array(
				'type' => 'color',
				'color' => '#ffffff',
			)
		)
	),
	'wrapper_boxstyle' => array(
		'type' => 'thz-box-style',
		'label' => __('Wrapper box style', 'creatus'),
		'preview' => true,
		'button-text' => esc_html__('Customize wrapper box style', 'creatus'),
		'desc' => esc_html__('Customize #thz-wrapper box style', 'creatus'),
		'popup' => true,
		'disable' => array('layout','boxsize','transform','transform'),
		'value' => array(
			'background' => array(
				'type' => 'color',
				'color' => '#ffffff',
			)
		)
	),
	'main_boxstyle' => array(
		'type' => 'thz-box-style',
		'label' => __('Main div box style', 'creatus'),
		'desc' => esc_html__('Adjust .thz-main box style', 'creatus'),
		'preview' => true,
		'button-text' => esc_html__('Customize main div box style', 'creatus'),
		'popup' => true,
		'disable' => array('layout','video','transform'),
		'value' => array(
			'background' => array(
				'type' => 'color',
				'color' => '#ffffff',
			)
		)
	)
);

$sidebars = fw()->theme->get_options('sidebars_settings');
$elements = fw()->theme->get_options('elements_settings');

$options = array(
	$options_set,
	$sidebars,
	$elements
);