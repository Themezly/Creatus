<?php if ( ! defined( 'FW' ) ) die( 'Forbidden' );


$options = array(
	'se' => array(
		'type' => 'addable-popup',
		'value' => array(),
		'label' => __('Separator', 'creatus'),
		'desc' => esc_html__('Add separator', 'creatus'),
		'template' => '<b>' . esc_html__('Activated separator:', 'creatus') . ' {{= mx.t}}</b>',
		'popup-title' => esc_html__('Separator settings', 'creatus'),
		'help' => esc_html__('This option adds separator layer to the HTML container.', 'creatus'),
		'size' => 'large',
		'add-button-text' => esc_html__('Click to add separator', 'creatus'),
		'sortable' => false,
		'limit' => 1,
		'popup-options' => array(
		
			'mx' => array(
				'type' => 'thz-multi-options',
				'label' => __('Separator metrics', 'creatus'),
				'desc' => esc_html__('Adjust separator metrics. See help for more info', 'creatus'),
				'help' => esc_html__('For optimal performance use same background color as section background and add section top and bottom padding that is same or bigger than the separator size.', 'creatus'),
				'value' => array(
					't' => 'triangle',
					'p' => 'bottom',
					's' => 50,
					'b' => 'color_4'
				),
				'thz_options' => array(
					't' => array(
						'type' => 'short-select',
						'title' => esc_html__('Type', 'creatus'),
						'choices' => array(
							'triangle' => esc_html__('Triangle', 'creatus'),
							'circle' => esc_html__('Circle', 'creatus'),
							'arrow' => esc_html__('Transparent arrow', 'creatus'),
							'haflcircle' => esc_html__('Transparent half circle', 'creatus'),
						)						
					),

					'p' => array(
						'type' => 'short-select',
						'title' => esc_html__('Position', 'creatus'),
						'choices' => array(
							'top' => esc_html__('Top', 'creatus'),
							'bottom' => esc_html__('Bottom', 'creatus'),
							'both' => esc_html__('Top and bottom', 'creatus')
						)
					),
					
					
					's' => array(
						'type' => 'spinner',
						'title' => esc_html__('Size', 'creatus'),
						'addon' => 'px',
						'min' => 0,
						'max' => 300,
					),
					
					'b' => array(
						'type' => 'color',
						'title' => esc_html__('Background', 'creatus'),
						'box' => true
					),					
					
					
				)
			),		
		
			'icon' => array(
				'type' => 'thz-icon',
				'value' => '',
				'label' => __('Separtor icon', 'creatus'),
				'desc' => esc_html__('Set separator icon. Shown only if icon selected.', 'creatus')
			),
			'iconsize' => array(
				'type' => 'short-select',
				'value' => 'medium',
				'label' => 'Icon size',
				'desc' => esc_html__('Set the icon size. For optimal performance make separator min 2.5 times bigger than the icon size.', 'creatus'),
				'choices' => array(
					'small' => esc_html__('Small 16px', 'creatus'),
					'medium' => esc_html__('Medium 22px', 'creatus'),
					'large' => esc_html__('Large 38px', 'creatus')
				)
			),
			'iconcolor' => array(
				'type' => 'thz-color-picker',
				'value' => '#000000',
				'label' => __('Icon color', 'creatus'),
				'desc' => esc_html__('Set separator icon color', 'creatus')
			)
		)
	)
);