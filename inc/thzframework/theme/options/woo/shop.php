<?php
if (!defined('FW')) {
	die('Forbidden');
}
$options = array(
	'wooshmx' => array(
		'type' => 'thz-multi-options',
		'label' => __('Shop metrics', 'creatus'),
		'desc' => esc_html__('Adjust shop metrics', 'creatus'),
		'value' => array(
			'title' => 'hide',
			'desc' => 'hide',
			'result' => 'hide',
			'catalog' => 'hide',									

		),
		'thz_options' => array(
			'title' => array(
				'type' => 'short-select',
				'title' => esc_html__('Page title', 'creatus'),
				'choices' => array(
					'hide' => esc_html__('Hide', 'creatus'),
					'show' => esc_html__('Show', 'creatus'),
				),
			),
			'desc' => array(
				'type' => 'short-select',
				'title' => esc_html__('Archive description', 'creatus'),
				'choices' => array(
					'hide' => esc_html__('Hide', 'creatus'),
					'show' => esc_html__('Show', 'creatus'),
				),
			),
			'result' => array(
				'type' => 'short-select',
				'title' => esc_html__('Result count', 'creatus'),
				'choices' => array(
					'hide' => esc_html__('Hide', 'creatus'),
					'show' => esc_html__('Show', 'creatus'),
				),
			),
			'catalog' => array(
				'type' => 'short-select',
				'title' => esc_html__('Catalog ordering', 'creatus'),
				'choices' => array(
					'hide' => esc_html__('Hide', 'creatus'),
					'show' => esc_html__('Show', 'creatus'),
				),
			),
			
		)
	),
	fw()->theme->get_options('woo/products'),
);