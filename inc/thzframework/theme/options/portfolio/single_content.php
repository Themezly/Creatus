<?php
if (!defined('FW')) {
	die('Forbidden');
}
$options = array(
	'ppbac' => array(
		'label' => __('Builder active content', 'creatus'),
		'desc' => __('Select project content ( description ) when page builder is active.', 'creatus'),
		'help' => __('If excerpt is selected and page builder is active, page builder content is displayed above the project. If Page builder content is selected it is displayed within the project as project content.', 'creatus'),
		'type' => 'short-select',
		'value' => 'builder',
		'choices' => array(
			'builder' => __('Page builder content', 'creatus'),
			'excerpt' => __('Excerpt', 'creatus'),
		)
	),

	'ppcbs' => array(
		'type' => 'thz-box-style',
		'label' => __('Project content box style', 'creatus'),
		'preview' => true,
		'button-text' => esc_html__('Customize project content box style', 'creatus'),
		'desc' => esc_html__('Adjust .thz-project-content box style', 'creatus'),
		'popup' => true,
		'disable' => array('layout','video','boxsize','transform'),
		'value' => array(
			'margin' => array(
				'top' => '0',
				'right' => 'auto',
				'bottom' => 60,
				'left' => 'auto'
			),
		)
	),
	'ppcc' => array(
		'type' => 'thz-multi-options',
		'label' => __('Project content colors', 'creatus'),
		'desc' => esc_html__('Adjust project content colors. Theme colors are used if empty.', 'creatus'),
		'value' => array(
			'text' => '',
			'link' => '',
			'linkhovered' => '',
			'headings' => ''
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
			'linkhovered' => array(
				'type' => 'color',
				'title' => esc_html__('Link Hovered', 'creatus'),
				'box' => true
			),
			'headings' => array(
				'type' => 'color',
				'title' => esc_html__('Headings', 'creatus'),
				'box' => true
			)
		)
	),
);