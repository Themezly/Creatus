<?php
if (!defined('FW')) {
	die('Forbidden');
}
$options = array(
	'productgeneraltab' => array(
		'title' => __('Product', 'creatus'),
		'type' => 'tab',
		'lazy_tabs' => false,
		'options' => fw()->theme->get_options('woo/single_product')
	),
	'productelements' => array(
		'title'   => __( 'Elements', 'creatus' ),
		'type'    => 'tab',
		'options' => fw()->theme->get_options('woo/single_elements')
	),	
	'productimagetab' => array(
		'title' => __('Image', 'creatus'),
		'type' => 'tab',
		'lazy_tabs' => false,
		'options' => fw()->theme->get_options('woo/single_image')
	),
	'productmetastab' => array(
		'title' => __('Meta', 'creatus'),
		'type' => 'tab',
		'lazy_tabs' => false,
		'options' => fw()->theme->get_options('woo/single_meta')
	),
	'producttabsdtab' => array(
		'title' => __('Tabs', 'creatus'),
		'type' => 'tab',
		'lazy_tabs' => false,
		'options' => fw()->theme->get_options('woo/single_tabs')
	),
	'productrelatedtab' => array(
		'title' => __('Related products', 'creatus'),
		'type' => 'tab',
		'li-attr' => array('class' => 'thz-related-products-li'),
		'lazy_tabs' => false,
		'options' => fw()->theme->get_options('woo/single_related')
	),
	'productupselltab' => array(
		'title' => __('Up sells', 'creatus'),
		'type' => 'tab',
		'li-attr' => array('class' => 'thz-upsell-products-li'),
		'lazy_tabs' => false,
		'options' => fw()->theme->get_options('woo/single_upsell')
	),
	thz_theme()->get_options('woo/single_sharing_tab'),
);