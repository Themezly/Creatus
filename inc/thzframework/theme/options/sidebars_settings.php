<?php
if (!defined('ABSPATH')) {
	die('Direct access forbidden.');
}
$options = array(
	'sb_style' => array(
		'type' => 'popup',
		'size' => 'large',
		'label' => __('Sidebars style', 'creatus'),
		'desc' => esc_html__('Customize left and right sidebars and widgets', 'creatus'),
		'button' => esc_html__('Edit sidebars style', 'creatus'),
		'popup-title' => esc_html__('Sidebars style settings', 'creatus'),
		'popup-options' => array(
			'sb_bs' => array(
				'type' => 'thz-box-style',
				'label' => __('Sidebars box style', 'creatus'),
				'preview' => true,
				'button-text' => esc_html__('Customize sidebars box style', 'creatus'),
				'desc' => esc_html__('Adjust .thz-sidebars box style', 'creatus'),
				'popup' => true,
				'disable' => array('layout','video','boxsize','transform'),
				'value' => array()
			),
			fw()->theme->get_options( 'widgets_settings')
		)
	)
);