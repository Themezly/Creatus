<?php
if (!defined('FW')) {
	die('Forbidden');
}
$options = array(
	'woodetails_mx' => array(
		'type' => 'thz-multi-options',
		'label' => __('Details holder', 'creatus'),
		'desc' => esc_html__('Adjust .thz-product-details-holder. See help for more info.', 'creatus'),
		'help' => esc_html__('Product details holder holds, media, title, summary and meta. Note that the holder and max width settings are effective only if there is no active page sidebar.', 'creatus'),
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
	'wooup_mx' => array(
		'type' => 'thz-multi-options',
		'label' => __('Up-sell products holder', 'creatus'),
		'desc' => esc_html__('Adjust up-sell products holder. See help for more info.', 'creatus'),
		'help' => esc_html__('Note that the holder and max width settings are effective only if there is no active page sidebar.', 'creatus'),
		'value' => array(
			'v' => 'show',
			'h' => 'contained',
			'm' => 100
		),
		'thz_options' => array(
			'v' => array(
				'title' => esc_html__('Visibility', 'creatus'),
				'type' => 'short-select',
				'attr' => array(
					'class' => 'thz-select-switch'
				),
				'choices' => array(
					'show' => array(
						'text' => esc_html__('Show', 'creatus'),
						'attr' => array(
							'data-enable' => '.wupsell-hol-mx-parent,.thz-upsell-products-li'
						)
					),
					'hide' => array(
						'text' => esc_html__('Hide', 'creatus'),
						'attr' => array(
							'data-disable' => '.wupsell-hol-mx-parent,.thz-upsell-products-li'
						)
					)
				)
			),
			'h' => array(
				'type' => 'short-select',
				'title' => __('Holder', 'creatus'),
				'choices' => array(
					'contained' => __('Contained', 'creatus'),
					'notcontained' => __('Not contained', 'creatus')
				),
				'attr' => array(
					'class' => 'wupsell-hol-mx'
				)
			),
			'm' => array(
				'type' => 'select',
				'title' => esc_html__('Max width', 'creatus'),
				'choices' => _thz_max_width_list(),
				'attr' => array(
					'class' => 'wupsell-hol-mx'
				)
			)
		)
	),
	'woorel_mx' => array(
		'type' => 'thz-multi-options',
		'label' => __('Related products holder', 'creatus'),
		'desc' => esc_html__('Adjust related products holder. See help for more info.', 'creatus'),
		'help' => esc_html__('Note that the holder and max width settings are effective only if there is no active page sidebar.', 'creatus'),
		'value' => array(
			'v' => 'show',
			'h' => 'contained',
			'm' => 100
		),
		'thz_options' => array(
			'v' => array(
				'title' => esc_html__('Visibility', 'creatus'),
				'type' => 'short-select',
				'attr' => array(
					'class' => 'thz-select-switch'
				),
				'choices' => array(
					'show' => array(
						'text' => esc_html__('Show', 'creatus'),
						'attr' => array(
							'data-enable' => '.wrel-hol-mx-parent,.thz-related-products-li'
						)
					),
					'hide' => array(
						'text' => esc_html__('Hide', 'creatus'),
						'attr' => array(
							'data-disable' => '.wrel-hol-mx-parent,.thz-related-products-li'
						)
					)
				)
			),
			'h' => array(
				'type' => 'short-select',
				'title' => __('Holder', 'creatus'),
				'choices' => array(
					'contained' => __('Contained', 'creatus'),
					'notcontained' => __('Not contained', 'creatus')
				),
				'attr' => array(
					'class' => 'wrel-hol-mx'
				)
			),
			'm' => array(
				'type' => 'select',
				'title' => esc_html__('Max width', 'creatus'),
				'choices' => _thz_max_width_list(),
				'attr' => array(
					'class' => 'wrel-hol-mx'
				)
			)
		)
	),
	'woonav_mx' => array(
		'type' => 'thz-multi-options',
		'label' => __('Products navigation', 'creatus'),
		'desc' => esc_html__('Adjust products navigation ( next/previous ) visibility and holder. See help for more info.', 'creatus'),
		'help' => esc_html__('Note that the holder and max width settings are effective only if there is no active page sidebar.', 'creatus'),
		'value' => array(
			'v' => 'show',
			'h' => 'contained',
			'm' => 100
		),
		'thz_options' => array(
			'v' => array(
				'title' => esc_html__('Visibility', 'creatus'),
				'type' => 'short-select',
				'attr' => array(
					'class' => 'thz-select-switch'
				),
				'choices' => array(
					'show' => array(
						'text' => esc_html__('Show', 'creatus'),
						'attr' => array(
							'data-enable' => '.woonav-hol-mx-parent'
						)
					),
					'hide' => array(
						'text' => esc_html__('Hide', 'creatus'),
						'attr' => array(
							'data-disable' => '.woonav-hol-mx-parent'
						)
					)
				)
			),
			'h' => array(
				'type' => 'short-select',
				'title' => __('Holder', 'creatus'),
				'choices' => array(
					'contained' => __('Contained', 'creatus'),
					'notcontained' => __('Not contained', 'creatus')
				),
				'attr' => array(
					'class' => 'woonav-hol-mx'
				)
			),
			'm' => array(
				'type' => 'select',
				'title' => esc_html__('Max width', 'creatus'),
				'choices' => _thz_max_width_list(),
				'attr' => array(
					'class' => 'woonav-hol-mx'
				)
			)
		)
	),
);