<?php
if (!defined('FW'))
	die('Forbidden');
	
$options = array(
	'toplevel_font' => array(
		'label' => __('Top level font', 'creatus'),
		'type' => 'thz-typography',
		'attr' => array(
			'class' => 'thztoplevelfont'
		),
		'value' => array(
			'family' => 'Creatus',
			'weight' => 500,
			'subset' => 'ffk',
			'transform' => 'uppercase',
			'size' => '12',
			'spacing' => '0.3px',
		),
		'disable' => array('color','hovered','line-height'),
	),
	'sublevel_font' => array(
		'label' => __('Sub level font', 'creatus'),
		'type' => 'thz-typography',
		'attr' => array(
			'class' => 'thzsublevelfont'
		),
		'value' => array(
			'size' => '14',
		),
		'disable' => array('color','hovered','line-height'),
	),
	'tm_anim' => array(
		'label' => __('Dropdown animation', 'creatus'),
		'type' => 'select',
		'value' => 'fade',
		'choices' => array(
			'none' => esc_html__('None', 'creatus'),
			'fade' => esc_html__('Fade in', 'creatus'),
			'top' => esc_html__('Come from top', 'creatus'),
			'right' => esc_html__('Come from right', 'creatus'),
			'bottom' => esc_html__('Come from bottom', 'creatus'),
			'left' => esc_html__('Come from left', 'creatus'),
			'zoom' => esc_html__('Zoom in', 'creatus')
		),
		'desc' => esc_html__('Select menu droptown animation', 'creatus')
	),
	'tm_elmx' => array(
		'type' => 'thz-multi-options',
		'label' => __('Secondary menu elements', 'creatus'),
		'desc' => esc_html__('Adjust secondary menu elements. See help for more info.', 'creatus'),
		'help' => esc_html__('Secondary menu items are items added in Secondary menu Display location. Items location option will help you set these items location. If icon size is empty the size is inherited from menu Top level font size. Icon nudge is i element relative top position.', 'creatus'),
		'value' => array(
			'il' => 'before',
			'so' => 'hide',
			'si' => 'show',
			'mc' => 'only',
			'is' => '14',
			'in' => '',
			'ic' => '',
			'ih' => ''
		),
		'breakafter' => array('mc'),
		'thz_options' => array(
			'il' => array(
				'type' => 'short-select',
				'title' => esc_html__('Items', 'creatus'),
				'choices' => array(
					'before' => array(
						'text' => esc_html__('Before menu icons', 'creatus'),
					),
					'after' => array(
						'text' => esc_html__('After menu icons', 'creatus'),
					),
					'hide' => array(
						'text' => esc_html__('Hide', 'creatus'),
					),
				)
			),
			'so' => array(
				'type' => 'short-select',
				'title' => esc_html__('Social links', 'creatus'),
				'choices' => array(
					'show' => esc_html__('Show', 'creatus'),
					'hide' => esc_html__('Hide', 'creatus')
				)
			),
			'si' => array(
				'type' => 'short-select',
				'title' => esc_html__('Search icon', 'creatus'),
				'choices' => array(
					'show' => esc_html__('Show', 'creatus'),
					'hide' => esc_html__('Hide', 'creatus')
				)
			),
			'mc' => array(
				'title' => esc_html__('Mini cart', 'creatus'),
				'type' => 'short-select',
				'attr' => array(
					'class' => 'thz-select-switch'
				),
				'choices' => array(
					'show' => array(
						'text' => esc_html__('Show', 'creatus'),
						'attr' => array(
							'data-enable' => 'wminc,wooicons'
						)
					),
					'hide' => array(
						'text' => esc_html__('Hide', 'creatus'),
						'attr' => array(
							'data-disable' => 'wminc,wooicons'
						)
					),
					'only' => array(
						'text' => esc_html__('Woo pages only', 'creatus'),
						'attr' => array(
							'data-enable' => 'wminc,wooicons'
						)
					),
				)
			),
			'is' => array(
				'type' => 'spinner',
				'title' => esc_html__('Icons size', 'creatus'),
				'addon' => 'px'
			),
			'in' => array(
				'type' => 'spinner',
				'title' => esc_html__('Icons nudge', 'creatus'),
				'addon' => 'px'
			),
			'ic' => array(
				'type' => 'color',
				'title' => esc_html__('Icon color', 'creatus'),
				'box' => true
			),
			'ih' => array(
				'type' => 'color',
				'title' => esc_html__('Icon hovered', 'creatus'),
				'box' => true
			),
		)
	),

);
if ( class_exists( 'WooCommerce' ) ) {
	
	$options['wminc'] = array(
		'type' => 'thz-multi-options',
		'label' => __('Menu mini cart colors', 'creatus'),
		'desc' => esc_html__('Adjust mini cart colors.', 'creatus'),
		'value' => array(
			'bg' => '',
			'tx' => '',
			'lic' => '',
			'lihc' => '',
			'cbg' => 'color_4',
			'cco' => 'color_2'
		),
		'thz_options' => array(
			'bg' => array(
				'type' => 'color',
				'title' => esc_html__('Background', 'creatus'),
				'box' => true
			),
			'tx' => array(
				'type' => 'color',
				'title' => esc_html__('Text', 'creatus'),
				'box' => true
			),
			'lic' => array(
				'type' => 'color',
				'title' => esc_html__('Links', 'creatus'),
				'box' => true
			),
			'lihc' => array(
				'type' => 'color',
				'title' => esc_html__('Links hovered', 'creatus'),
				'box' => true
			),
			'cbg' => array(
				'type' => 'color',
				'title' => esc_html__('Counter bg', 'creatus'),
				'box' => true
			),
			'cco' => array(
				'type' => 'color',
				'title' => esc_html__('Counter color', 'creatus'),
				'box' => true
			)
		)
	);
	$options['wooicons'] = array(
		'type' => 'thz-multi-options',
		'label' => __('Menu mini cart icons', 'creatus'),
		'desc' => esc_html__('Select menu mini cart icons', 'creatus'),
		'value' => array(
			'mc' => 'thzicon thzicon-shopping-cart2',
			'vc' => 'thzicon thzicon-bag',
			'ch' => 'fa fa-check-square-o'
		),
		'thz_options' => array(
			'mc' => array(
				'type' => 'icon',
				'title' => esc_html__('Cart', 'creatus')
			),
			'vc' => array(
				'type' => 'icon',
				'title' => esc_html__('View cart', 'creatus')
			),
			'ch' => array(
				'type' => 'icon',
				'title' => esc_html__('Checkout', 'creatus')
			)
		)
	);
}