<?php
if (!defined('FW'))
	die('Forbidden');
	
	
if ( !class_exists( 'bbPress' ) ) {
	$options = array();
	return;
}

$options = array(
	'bbp' => array(
		'type' => 'thz-multi-options',
		'label' => __('Headers and titles', 'creatus'),
		'desc' => esc_html__('Adjust forum headers and titles colors', 'creatus'),
		'value' => array(
			'hbg' => 'color_5',
			'bo' => 'color_4',
			'ft' => 'color_2'
		),
		'thz_options' => array(
			'hbg' => array(
				'type' => 'color',
				'title' => esc_html__('Headers bg', 'creatus'),
				'box' => true
			),
			'bo' => array(
				'type' => 'color',
				'title' => esc_html__('Borders color', 'creatus'),
				'box' => true
			),
			'ft' => array(
				'type' => 'color',
				'title' => esc_html__('Forum titles', 'creatus'),
				'box' => true
			)
		)
	),
	'bbpth' => array(
		'type' => 'thz-multi-options',
		'label' => __('Topic header text', 'creatus'),
		'desc' => esc_html__('Adjust topic headers text and links', 'creatus'),
		'value' => array(
			'co' => '',
			'li' => '',
			'lih' => ''
		),
		'thz_options' => array(
			'co' => array(
				'type' => 'color',
				'title' => esc_html__('Text', 'creatus'),
				'box' => true
			),
			'li' => array(
				'type' => 'color',
				'title' => esc_html__('Links', 'creatus'),
				'box' => true
			),
			'lih' => array(
				'type' => 'color',
				'title' => esc_html__('Links hovered', 'creatus'),
				'box' => true
			)
		)
	),
	'bbpl' => array(
		'type' => 'thz-multi-options',
		'label' => __('Links and bits', 'creatus'),
		'desc' => esc_html__('Adjust forum links and bits color', 'creatus'),
		'value' => array(
			'li' => '',
			'lih' => '',
			'bit' => ''
		),
		'thz_options' => array(
			'li' => array(
				'type' => 'color',
				'title' => esc_html__('Links', 'creatus'),
				'box' => true
			),
			'lih' => array(
				'type' => 'color',
				'title' => esc_html__('Links hovered', 'creatus'),
				'box' => true
			),
			'bit' => array(
				'type' => 'color',
				'title' => esc_html__('Bits', 'creatus'),
				'box' => true
			)
		)
	),
	'bbpix' => array(
		'type' => 'multi-select',
		'value' => array(),
		'label' => __('Forum index page', 'creatus'),
		'desc' => esc_html__('Assign forum index page. See help for more info', 'creatus'),
		'help' => esc_html__('There is a known issue with breadcrumbs and use of shortcode bbp-forum-index to assign the index page. You might endup with 2 index pages and or will not be able to add specific page options. To avoid these issues and give you full templating freedom, after you have created the index page just set that page here and all requests to main bb archive will be sent to your assigned forum index page. Please make sure that the Forum Root and your index page do not have the same slug.', 'creatus'),
		'population' => 'posts',
		'source' => 'page',
		'prepopulate' => 10,
		'limit' => 1,
	),
);