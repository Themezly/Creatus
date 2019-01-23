<?php
if (!defined('FW')) {
	die('Forbidden');
}
$options = array(
	'woosingels' => array(
		'type' => 'thz-multi-options',
		'label' => __('Elements', 'creatus'),
		'desc' => esc_html__('Adjust products elements visibility.', 'creatus'),
		'value' => array(
			't' => 'show',
			'r' => 'show',
		),
		'thz_options' => array(
			't' => array(
				'title' => esc_html__('Title', 'creatus'),
				'type' => 'short-select',
				'attr' => array(
					'class' => 'thz-select-switch'
				),
				'choices' => array(
					'show' => array(
						'text' => esc_html__('Show', 'creatus'),
						'attr' => array(
							'data-enable' => 'woosptfm,woospt_bs'
						)
					),
					'hide' => array(
						'text' => esc_html__('Hide', 'creatus'),
						'attr' => array(
							'data-disable' => 'woosptfm,woospt_bs'
						)
					)
				)
			),
			
			'r' => array(
				'title' => esc_html__('Rating stars', 'creatus'),
				'type' => 'short-select',
				'attr' => array(
					'class' => 'thz-select-switch'
				),
				'choices' => array(
					'show' => array(
						'text' => esc_html__('Show', 'creatus'),
						'attr' => array(
							'data-enable' => 'woospra_mx,woospra_bs'
						)
					),
					'hide' => array(
						'text' => esc_html__('Hide', 'creatus'),
						'attr' => array(
							'data-disable' => 'woospra_mx,woospra_bs'
						)
					)
				)
			),

		)
	),

	'woospt_bs' => array(
		'type' => 'thz-box-style',
		'label' => __('Title box style', 'creatus'),
		'preview' => true,
		'button-text' => esc_html__('Customize related row box style', 'creatus'),
		'desc' => esc_html__('Adjust .thz-product-title box style', 'creatus'),
		'popup' => true,
		'disable' => array('video'),
		'value' => array()
	),
				
	'woosptfm' => array(
		'type' => 'thz-typography',
		'label' => __('Title font metrics', 'creatus'),
		'desc' => esc_html__('Adjust product title font metrics.', 'creatus'),
		'value' => array(
			'size' => 28
		),
		'disable' => array(
			'hovered',
			'align'
		),
	),

	'woospra_bs' => array(
		'type' => 'thz-box-style',
		'label' => __('Rating stars box style', 'creatus'),
		'preview' => true,
		'button-text' => esc_html__('Customize product rating box style', 'creatus'),
		'desc' => esc_html__('Adjust .woocommerce-product-rating box style', 'creatus'),
		'popup' => true,
		'disable' => array('video'),
		'value' => array()
	),
	
	'woospra_mx' => array(
		'type' => 'thz-multi-options',
		'label' => __('Rating stars metrics', 'creatus'),
		'desc' => esc_html__('Adjust rating stars metrics.', 'creatus'),
		'value' => array(
			'c' => '#121212',
			's' => 12
		),
		'thz_options' => array(
			'c' => array(
				'type' => 'color',
				'title' => esc_html__('Color', 'creatus'),
				'box' => true
			),
			's' => array(
				'type' => 'spinner',
				'title' => esc_html__('Size', 'creatus'),
				'addon' => 'px',
				'min' => 0,
			)
		)
	),
	
	'woospp_bs' => array(
		'type' => 'thz-box-style',
		'label' => __('Price box style', 'creatus'),
		'preview' => true,
		'button-text' => esc_html__('Customize product price box style', 'creatus'),
		'desc' => esc_html__('Adjust .thz-product-price box style', 'creatus'),
		'popup' => true,
		'disable' => array('video'),
		'value' => array()
	),
	
	'woosppfm' => array(
		'type' => 'thz-typography',
		'label' => __('Price font metrics', 'creatus'),
		'desc' => esc_html__('Adjust product price font metrics.', 'creatus'),
		'value' => array(
			'color' => '#1ecb67',
			'size' => 24
		),
		'disable' => array(
			'hovered',
			'align'
		),
	),
	'woosppoc' => array(
		'type' => 'thz-color-picker',
		'label' => __('Old price color', 'creatus'),
		'desc' => esc_html__('Adjust old price color.', 'creatus'),
		'value' => '#cccccc'
	)
);