<?php
if (!defined('FW')) {
	die('Forbidden');
}
$options = array(
	'wootabs_mx' => array(
		'type' => 'thz-multi-options',
		'label' => __('Product tabs holder', 'creatus'),
		'desc' => esc_html__('Adjust product tabs holder. See help for more info.', 'creatus'),
		'help' => esc_html__('Note that the holder and max width settings are effective only if there is no active page sidebar.', 'creatus'),
		'value' => array(
			'h' => 'contained',
			'm' => 100
		),
		'thz_options' => array(
			'h' => array(
				'type' => 'short-select',
				'title' => __('Holder', 'creatus'),
				'choices' => array(
					'contained' => __('Contained', 'creatus'),
					'notcontained' => __('Not contained', 'creatus')
				)
			),
			'm' => array(
				'type' => 'select',
				'title' => esc_html__('Max width', 'creatus'),
				'choices' => _thz_max_width_list()
			)
		)
	),
	'wootabs' => array(
		'type' => 'popup',
		'size' => 'large',
		'label' => __('Product tabs settings', 'creatus'),
		'desc' => esc_html__('Customize product tabs', 'creatus'),
		'button' => esc_html__('Edit product tabs', 'creatus'),
		'popup-title' => esc_html__('Product tabs settings', 'creatus'),
		'popup-options' => array(
			fw()->theme->get_options('woo/product_tabs')
		)
	)
);