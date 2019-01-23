<?php
if (!defined('FW')) {
	die('Forbidden');
}

if ( !class_exists( 'WooCommerce' ) ) {
	$options = array();
	return;
}

$options = array(
	'wooshoptab' => array(
		'title' => __('Shop', 'creatus'),
		'type' => 'tab',
		'lazy_tabs'=> false,
		'options' => fw()->theme->get_options('woo/shop')
	),
	'woosingletab' => array(
		'title' => __('Single product', 'creatus'),
		'type' => 'tab',
		'lazy_tabs'=> false,
		'options' => array(
			'productsinglegroup' => array(
				'type' => 'group',
				'attr' => array(
					'class' => 'show-borders'
				),
				'options' => array(
					fw()->theme->get_options('woo/single')
				)
			)
		)
	),
	'woomisctab' => array(
		'title' => __('Miscellaneous', 'creatus'),
		'type' => 'tab',
		'lazy_tabs'=> false,
		'options' => array(
			'miscelenousgroup' => array(
				'type' => 'group',
				'attr' => array(
					'class' => 'show-borders'
				),
				'options' => array(
					fw()->theme->get_options('woo/miscellaneous')
				)
			)
		)
	)
);