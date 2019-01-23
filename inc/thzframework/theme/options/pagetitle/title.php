<?php
if (!defined('FW'))
	die('Forbidden');

$options = array(
	'sptmode' => array(
		'type' => 'thz-multi-options',
		'label' => __('Single title mode', 'creatus'),
		'desc' => esc_html__('Select the single post page title display mode.', 'creatus'),
		'value' => array(
			'm' => 'name',
		),
		'thz_options' => array(
			'm' => array(
				'type' => 'select',
				'title' => false,
				'choices' => array(
					'title' => esc_html__('Post Title', 'creatus'),
					'cat' => esc_html__('First Category', 'creatus'),
					'name' =>  esc_html__('Post Type Name', 'creatus'),
				)
			),			

		)
	),
	'page_title_margin' => array(
		'type' => 'thz-box-style',
		'label' => __('Page title margin', 'creatus'),
		'desc' => esc_html__('Set page title margin', 'creatus'),
		'disable' => array('layout','padding','borders','borderradius','boxsize','transform','boxshadow','background'),
		'value' => array(
			'margin' => array(
				'top' => 0,
				'right' => 0,
				'bottom' => 0,
				'left' => 0
			),
		)
	),
	
	'page_title_font' => array(
		'type' => 'thz-typography',
		'label' => __('Page title font', 'creatus'),
		'desc' => esc_html__('Page title font color and metrics', 'creatus'),
		'value' => array(
			'size' => 18,
		),
		'disable' => array('hovered','align'),
	),
	
	'pti_an' => array(
		'type' => 'thz-animation',
		'label' => false,
		'value' => array(
			'animate' => 'inactive',
			'effect' => 'thz-anim-fadeIn',
			'duration' => 400,
			'delay' => 0
		),
		'addlabel' => esc_html__('Animate page title', 'creatus'),
		'adddesc' => esc_html__('Add animation to page title container', 'creatus')
	),

);