<?php if ( ! defined( 'FW' ) ) die( 'Forbidden' );


$comments_settings 	= fw()->theme->get_options( 'additional/comments');
$preloader_settings = thz_theme()->get_options( 'additional/preloader');

$misc_options = apply_filters('thz_filter_additional_miscellaneous', array(
	
	'ovsrc' => array(
		'type' => 'thz-multi-options',
		'label' => __('Overlay search colors', 'creatus'),
		'desc' => esc_html__('Adjust overlay search colors', 'creatus'),
		'value' => array(
			'o' => '',
			't' => '',
			'i' => '',
			'b' => '',
		),
		'thz_options' => array(
			'o' => array(
				'type' => 'color',
				'title' => esc_html__('Overlay color', 'creatus'),
				'box' => true
			),
			't' => array(
				'type' => 'color',
				'title' => esc_html__('Text color', 'creatus'),
				'box' => true
			),
			'i' => array(
				'type' => 'color',
				'title' => esc_html__('Input background color', 'creatus'),
				'box' => true
			),
			'b' => array(
				'type' => 'color',
				'title' => esc_html__('Input border color', 'creatus'),
				'box' => true
			),
		)
	),

	'emojis' => array(
		'label' => __('Emojis', 'creatus'),
		'desc' => esc_html__('Activate/deactivate emojis.', 'creatus'),
		'type' => 'switch',
		'right-choice' => array(
			'value' => 'inactive',
			'label' => __('Inactive', 'creatus')
		),
		'left-choice' => array(
			'value' => 'active',
			'label' => __('Active', 'creatus')
		),
		'value' => 'inactive'
	),

	'sdata' => array(
		'label' => __('Structured data', 'creatus'),
		'desc' => esc_html__('Structured data helps highlight specific website information for search engines.', 'creatus'),
		'type' => 'switch',
		'right-choice' => array(
			'value' => 'inactive',
			'label' => __('Inactive', 'creatus')
		),
		'left-choice' => array(
			'value' => 'active',
			'label' => __('Active', 'creatus')
		),
		'value' => 'active'
	),
));

$options = array(
	$comments_settings,
	$misc_options,
	$preloader_settings
);