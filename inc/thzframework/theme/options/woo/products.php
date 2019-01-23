<?php
if (!defined('FW')) {
	die('Forbidden');
}
$options = array(
	'wooscst' => array(
		'type' => 'popup',
		'size' => 'large',
		'label' => __('Sub categories style', 'creatus'),
		'desc' => esc_html__('Customize sub categories layout and feel', 'creatus'),
		'button' => esc_html__('Edit sub categories style', 'creatus'),
		'popup-title' => esc_html__('Sub categories style settings', 'creatus'),
		'popup-options' => array(
			fw()->theme->get_options('woo/subcat_style')
		)
	),
	'woopst' => array(
		'type' => 'popup',
		'size' => 'large',
		'label' => __('Products style', 'creatus'),
		'desc' => esc_html__('Customize products layout and feel', 'creatus'),
		'button' => esc_html__('Edit products style', 'creatus'),
		'popup-title' => esc_html__('Products style settings', 'creatus'),
		'popup-options' => array(
			fw()->theme->get_options('woo/products_style')
		)
	),
	'woopanim' => array(
		'type' => 'thz-animation',
		'label' => false,
		'value' => array(
			'animate' => 'inactive',
			'effect' => 'thz-anim-fadeIn',
			'duration' => 400,
			'delay' => 100
		),
		'addlabel' => esc_html__('Animate products', 'creatus'),
		'adddesc' => esc_html__('Add animation to the products HTML container', 'creatus')
	),
);