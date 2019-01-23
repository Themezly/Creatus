<?php
if (!defined('FW')) {
	die('Forbidden');
}
$options = array(
	
	'com_rbs' => array(
		'type' => 'thz-box-style',
		'label' => __('Adjust .thz-comments-posts-row box style', 'creatus'),
		'preview' => true,
		'button-text' => esc_html__('Customize comments row box style', 'creatus'),
		'desc' => esc_html__('Adjust .thz-comments-posts-row box style', 'creatus'),
		'popup' => true,
		'disable' => array('video'),
		'units' => array(
			'borderradius',
			'boxsize',
			'padding',
			'margin',
		),
		'value' => array()
	),
	'com_hbs' => array(
		'type' => 'thz-box-style',
		'label' => __('Adjust .comments-area box style', 'creatus'),
		'preview' => true,
		'button-text' => esc_html__('Customize comments area box style', 'creatus'),
		'desc' => esc_html__('Adjust .comments-area box style','creatus'),
		'popup' => true,
		'disable' => array('video'),
		'units' => array(
			'borderradius',
			'boxsize',
			'padding',
			'margin',
		),
		'value' => array(
			'margin' => array(
				'top' => 60,
				'right' => 'auto',
				'bottom' => 0,
				'left' => 'auto'
			),
			'padding' => array(
				'top' => 60,
				'right' => 0,
				'bottom' => 0,
				'left' => 0
			),
			'borders' => array(
				'all' => 'separate',
				'top' => array(
					'w' => 1,
					's' => 'solid',
					'c' => 'color_4'
				),
				'right' => array(
					'w' => 0,
					's' => 'solid',
					'c' => ''
				),
				'bottom' => array(
					'w' => 0,
					's' => 'solid',
					'c' => ''
				),
				'left' => array(
					'w' => 0,
					's' => 'solid',
					'c' => ''
				),
			),
		)
	),
	'com_bbs' => array(
		'type' => 'thz-box-style',
		'label' => __('Adjust .comment-body box style', 'creatus'),
		'preview' => true,
		'button-text' => esc_html__('Customize comments body box style', 'creatus'),
		'desc' => esc_html__('Adjust .comment-body box style', 'creatus'),
		'popup' => true,
		'disable' => array('video'),
		'value' => array(
			'padding' => array(
				'top' => 30,
				'right' => 0,
				'bottom' => 30,
				'left' => 0
			),
			'borders' => array(
				'all' => 'separate',
				'top' => array(
					'w' => 0,
					's' => 'solid',
					'c' => ''
				),
				'right' => array(
					'w' => 0,
					's' => 'solid',
					'c' => ''
				),
				'bottom' => array(
					'w' => 1,
					's' => 'solid',
					'c' => 'color_4'
				),
				'left' => array(
					'w' => 0,
					's' => 'solid',
					'c' => ''
				),
			),
		)
	),
	'comm_mx' => array(
		'type' => 'thz-multi-options',
		'label' => __('Comments metrics', 'creatus'),
		'desc' => esc_html__('Adjust comments metrics', 'creatus'),
		'value' => array(
			'rbs' => '',
			'hbs' => '',
			'bbs' => '',
			'as' => 48,
			'ash' => 'circle',
			'lay' => 'stacked',
			'lab' => 'outside',
			't' => '',
			'l' => '',
			'lh' => '',
		),
		'breakafter' =>'ash',
		'thz_options' => array(
			'rbs' => array(
				'type' => 'box-style',
				'title' => esc_html__('Row box style', 'creatus'),
				'button-text' => esc_html__('Edit box style', 'creatus'),
				'connect' => 'com_rbs'
			),
			
			'hbs' => array(
				'type' => 'box-style',
				'title' => esc_html__('Holder box style', 'creatus'),
				'button-text' => esc_html__('Edit box style', 'creatus'),
				'connect' => 'com_hbs'
			),
			
			'bbs' => array(
				'type' => 'box-style',
				'title' => esc_html__('Body box style', 'creatus'),
				'button-text' => esc_html__('Edit box style', 'creatus'),
				'connect' => 'com_bbs'
			),
			'as' => array(
				'type' => 'spinner',
				'title' => esc_html__('Avatar size', 'creatus'),
				'addon' => 'px',
				'min' => 10,
			),
			'ash' => array(
				'type' => 'short-select',
				'title' => esc_html__('Avatar shape', 'creatus'),
				'choices' => array(
					'square' => esc_html__('Square', 'creatus'),
					'rounded' => esc_html__('Rounded', 'creatus'),
					'circle' => esc_html__('Circle', 'creatus'),
				),
			),
			'lay' => array(
				'type' => 'short-select',
				'title' => esc_html__('Form layout', 'creatus'),
				'choices' => array(
					'stacked' => esc_html__('Stacked', 'creatus'),
					'left' => esc_html__('Left', 'creatus'),
					'right' => esc_html__('Right', 'creatus'),
				),
			),
			'lab' => array(
				'type' => 'short-select',
				'title' => esc_html__('Form labels', 'creatus'),
				'choices' => array(
					'inside' => esc_html__('Inside', 'creatus'),
					'outside' => esc_html__('Outside', 'creatus'),
				),
			),
			't' => array(
				'type' => 'color',
				'title' => esc_html__('Text', 'creatus'),
				'box' => true
			),
			'l' => array(
				'type' => 'color',
				'title' => esc_html__('Link', 'creatus'),
				'box' => true
			),	
			'lh' => array(
				'type' => 'color',
				'title' => esc_html__('Link hovered', 'creatus'),
				'box' => true
			),				
		)
	),	
	
	'comm_h' => array(
		'type' => 'thz-typography',
		'label' => __('Comment area headings', 'creatus'),
		'desc' => esc_html__('Adjust comment area .comments-title and .comment-reply-title font metrics.', 'creatus'),
		'value' => array(
			'size' => 20,
		),
		'disable' => array('hovered'),
	),
	
);