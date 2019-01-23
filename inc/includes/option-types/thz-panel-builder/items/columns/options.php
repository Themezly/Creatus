<?php
if (!defined('FW')){
	die('Forbidden');
}
		
$custom_effects = fw()->theme->get_options('custom_effects');
unset($custom_effects['cp'], $custom_effects['se']);
$options = array(
	'widget_name' => array(
		'type' => 'hidden',
	),

	'centered' => array(
		'label' => __('Center widget', 'creatus'),
		'desc' => esc_html__('If set to center, this widget float is removed and it will be centered inside the section.', 'creatus'),
		'type' => 'switch',
		'right-choice' => array(
			'value' => 'donotcenter',
			'label' => __('Do not center', 'creatus')
		),
		'left-choice' => array(
			'value' => 'center',
			'label' => __('Center', 'creatus')
		),
		'value' => 'donotcenter'
	),
	'bs' => array(
		'type' => 'thz-box-style',
		'label' => __('Widget-in box style', 'creatus'),
		'preview' => true,
		'popup' => true,
		'button-text' => esc_html__('Customize widget-in box style', 'creatus'),
		'desc' => esc_html__('This option will let you customize the box style of .thz-widget-column-in container', 'creatus'),
		'value' => array(),
		'units' => array(
			'borderradius',
			'boxsize',
			'padding',
			'margin',
		),
	),
	'id' => array(
		'type' => 'unique',
		'length' => 8
	),
	'cmx' => _thz_container_metrics_defaults()

);