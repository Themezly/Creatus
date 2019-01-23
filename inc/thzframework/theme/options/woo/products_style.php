<?php
if (!defined('FW')) {
	die('Forbidden');
}
$options = array(
	'tabdefaultsettings' => array(
		'title' => __('Defaults', 'creatus'),
		'type' => 'tab',
		'options' => array(
		
			'grid' => array(
				'type' => 'thz-multi-options',
				'label' => __('Grid settings', 'creatus'),
				'desc' => esc_html__('Set shop home/archive products grid columns, gutter and products per page', 'creatus'),
				'value' => array(
					'columns' => 3,
					'gutter' => 30,
					'items' => 9,
				),
				'thz_options' => array(
					'gutter' => array(
						'type' => 'spinner',
						'title' => esc_html__('Gutter', 'creatus'),
						'addon' => 'px',
						'min' => 0,
						'max' => 100
					),
					'columns' => array(
						'type' => 'select',
						'title' => esc_html__('Columns', 'creatus'),
						'choices' => array(
							'1' => esc_html__('1', 'creatus'),
							'2' => esc_html__('2', 'creatus'),
							'3' => esc_html__('3', 'creatus'),
							'4' => esc_html__('4', 'creatus'),
							'5' => esc_html__('5', 'creatus'),
							'6' => esc_html__('6', 'creatus')
						)
					),
					'items' => array(
						'type' => 'spinner',
						'title' => esc_html__('Products', 'creatus'),
						'addon' => '#',
						'min' => 1,
						'max' => 100
					),
				)
			),
		
		
			'woopbs' => array(
				'type' => 'thz-box-style',
				'label' => __('Product box style', 'creatus'),
				'preview' => true,
				'button-text' => esc_html__('Customize product box style', 'creatus'),
				'desc' => esc_html__('Adjust .thz-woo-grid-holder .thz-grid-item-in box style', 'creatus'),
				'popup' => true,
				'disable' => array('layout','margin','boxsize','transform','video'),
				'value' => array()
			),
			
			'woopimbs' => array(
				'type' => 'thz-box-style',
				'label' => __('Product media box style', 'creatus'),
				'preview' => true,
				'button-text' => esc_html__('Customize product media box style', 'creatus'),
				'desc' => esc_html__('Adjust .thz-woo-item-media box style', 'creatus'),
				'popup' => true,
				'disable' => array('layout','video','boxsize','transform'),
				'value' => array()
			),
			
			'woopibs' => array(
				'type' => 'thz-box-style',
				'label' => __('Product info box style', 'creatus'),
				'preview' => true,
				'button-text' => esc_html__('Customize product info box style', 'creatus'),
				'desc' => esc_html__('Adjust .thz-woo-item-info box style', 'creatus'),
				'popup' => true,
				'disable' => array('layout','video','boxsize','transform'),
				'value' => array(
					'padding' => array(
						'top' => '8%',
						'right' => '0',
						'bottom' => '8%',
						'left' => '0'
					),
					'background' => array(
						'type' => 'color',
						'color' => '#ffffff',
					)
				)
			),
			
			'imgh' => array(
				'type' => 'multi-picker',
				'label' => false,
				'desc' => false,
				'picker' => array(
					'picked' => array(
						'label' => __('Image container height', 'creatus'),
						'desc' => esc_html__('Set image container height.', 'creatus'),
						'type' => 'select',
						'value' => 'thz-ratio-3-4',
						'choices' => array(
							array( // optgroup
								'attr' => array(
									'label' => __('Misc', 'creatus')
								),
								'choices' => array(
									'auto' => esc_html__('Auto', 'creatus'),
									'custom' => esc_html__('Custom', 'creatus')
								)
							),
							array( // optgroup
								'attr' => array(
									'label' => __('Square', 'creatus')
								),
								'choices' => array(
									'thz-ratio-1-1' => esc_html__('Aspect ratio 1:1', 'creatus')
								)
							),
							array( // optgroup
								'attr' => array(
									'label' => __('Landscape', 'creatus')
								),
								'choices' => array(
									'thz-ratio-2-1' => esc_html__('Aspect ratio 2:1', 'creatus'),
									'thz-ratio-3-2' => esc_html__('Aspect ratio 3:2', 'creatus'),
									'thz-ratio-4-3' => esc_html__('Aspect ratio 4:3', 'creatus'),
									'thz-ratio-16-9' => esc_html__('Aspect ratio 16:9', 'creatus'),
									'thz-ratio-21-9' => esc_html__('Aspect ratio 21:9', 'creatus')
								)
							),
							array( // optgroup
								'attr' => array(
									'label' => __('Portrait', 'creatus')
								),
								'choices' => array(
									'thz-ratio-1-2' => esc_html__('Aspect ratio 1:2', 'creatus'),
									'thz-ratio-3-4' => esc_html__('Aspect ratio 3:4', 'creatus'),
									'thz-ratio-2-3' => esc_html__('Aspect ratio 2:3', 'creatus'),
									'thz-ratio-9-16' => esc_html__('Aspect ratio 9:16', 'creatus')
								)
							)
						)
					)
				),
				'choices' => array(
					'custom' => array(
						'height' => array(
							'type' => 'thz-spinner',
							'addon' => 'px',
							'min' => 0,
							'max' => 1000,
							'label' => '',
							'value' => 350,
							'desc' => esc_html__('Media container height. ', 'creatus')
						)
					)
				)
			),
			
			'imgs' => array(
				'label' => __('Image size', 'creatus'),
				'desc' => esc_html__('Select the image size to be used.', 'creatus'),
				'value' => 'thz-img-medium',
				'type' => 'short-select',
				'choices' => thz_get_image_sizes_list( true )
			),
			
			'wooprs' => array(
				'type' => 'multi-picker',
				'label' => false,
				'desc' => false,
				'picker' => array(
					'picked' => array(
						'label' => __('Show rating stars', 'creatus'),
						'desc' => esc_html__('Show/hide rating stars', 'creatus'),
						'type' => 'switch',
						'right-choice' => array(
							'value' => 'hide',
							'label' => __('Hide', 'creatus')
						),
						'left-choice' => array(
							'value' => 'show',
							'label' => __('Show', 'creatus')
						),
						'value' => 'show'
					)
				),
				'choices' => array(
					'show' => array(
						'bs' => array(
							'type' => 'thz-box-style',
							'label' => __('Ratings container box style', 'creatus'),
							'preview' => true,
							'button-text' => esc_html__('Customize ratings container box style', 'creatus'),
							'desc' => esc_html__('Adjust .thz-woo-item-rating box style', 'creatus'),
							'popup' => true,
							'disable' => array('video'),
							'value' => array()
						),
						
						'color' => array(
							'type' => 'thz-color-picker',
							'value' => '#ffffff',
							'label' => __('Rating stars color', 'creatus'),
							'desc' => esc_html__('Set rating stars icon color', 'creatus')
						),

					)
				)
			),
			
			
		)
	),
	'tabtitlesettings' => array(
		'title' => __('Title', 'creatus'),
		'type' => 'tab',
		'options' => array(
			'wooptbs' => array(
				'type' => 'thz-box-style',
				'label' => __('Product title metrics', 'creatus'),
				'preview' => true,
				'desc' => esc_html__('Adjust .thz-woo-item-title padding and margin', 'creatus'),
				'popup' => false,
				'disable' => array('layout','borders','borderradius','boxsize','transform','boxshadow','background'),
				'value' => array()
			),
			'wooptf' => array(
				'type' => 'thz-typography',
				'label' => __('Title font metrics', 'creatus'),
				'desc' => esc_html__('Adjust product title font metrics.', 'creatus'),
				'value' => array(
					'size' => 16,
					'line-height' => 1.3
				),
			)
		)
	),
	'tabpricesettings' => array(
		'title' => __('Price', 'creatus'),
		'type' => 'tab',
		'options' => array(
			'wooppbs' => array(
				'type' => 'thz-box-style',
				'label' => __('Product price metrics', 'creatus'),
				'preview' => false,
				'desc' => esc_html__('Adjust .thz-woo-item-price padding and margin', 'creatus'),
				'popup' => false,
				'disable' => array('layout','borders','borderradius','boxsize','transform','boxshadow','background'),
				'value' => array(
					'margin' => array(
						'top' => 10,
						'right' => 0,
						'bottom' => 0,
						'left' => 0
					),				
				)
			),
			'woopptf' => array(
				'type' => 'thz-typography',
				'label' => __('Price font metrics', 'creatus'),
				'desc' => esc_html__('Adjust product price font metrics.', 'creatus'),
				'value' => array(
					'size' => 14,
					'line-height' => 1
				),
				'disable' => array('hovered','text-shadow'),
			),
			'wooppoc' => array(
				'type' => 'thz-multi-options',
				'label' => __('Old price color', 'creatus'),
				'desc' => esc_html__('Adjust old price color.', 'creatus'),
				'value' => array(
					'old' => '#cccccc'
				),
				'thz_options' => array(
					'old' => array(
						'type' => 'color',
						'title' => esc_html__('Old price color', 'creatus'),
						'box' => true
					)
				)
			)
		)
	),
	'tabbuttonssettings' => array(
		'title' => __('Buttons', 'creatus'),
		'type' => 'tab',
		'options' => array(
			'btns_show' => array(
				'label' => __('Buttons type', 'creatus'),
				'desc' => esc_html__('Set buttons type or hide buttons', 'creatus'),
				'type' => 'select',
				'value' => 'both',
				'attr' => array(
					'class' => 'thz-select-switch'
				),
				'choices' => array(
					'label' => array(
						'text' => esc_html__('Only label', 'creatus'),
						'attr' => array(
							'data-enable' => 'woopbbs,woopbf'
						)
					),
					'icon' => array(
						'text' => esc_html__('Only icon', 'creatus'),
						'attr' => array(
							'data-enable' => 'woopbbs,woopbf'
						)
					),
					'both' => array(
						'text' => esc_html__('Icon and label', 'creatus'),
						'attr' => array(
							'data-enable' => 'woopbbs,woopbf'
						)
					),
					'hide' => array(
						'text' => esc_html__('Hide buttons', 'creatus'),
						'attr' => array(
							'data-disable' => 'woopbbs,woopbf'
						)
					)
				)
			),
			'woopbcbs' => array(
				'type' => 'thz-box-style',
				'label' => __('Buttons container box style', 'creatus'),
				'preview' => true,
				'button-text' => esc_html__('Customize buttons container box style', 'creatus'),
				'desc' => esc_html__('Adjust .thz-woo-buttons-container box style', 'creatus'),
				'popup' => true,
				'disable' => array('video'),
				'value' => array()
			),
			'woopbbs' => array(
				'type' => 'thz-box-style',
				'label' => __('Buttons box style', 'creatus'),
				'preview' => true,
				'button-text' => esc_html__('Customize buttons box style', 'creatus'),
				'desc' => esc_html__('Adjust .thz-woo-item-cart-buttons box style', 'creatus'),
				'popup' => true,
				'disable' => array('video'),
				'value' => array(
					'padding' => array(
						'top' => 5,
						'right' => 15,
						'bottom' => 5,
						'left' => 15
					),
					'borderradius' => array(
						'top-left' => 4,
						'top-right' => 4,
						'bottom-left' => 4,
						'bottom-right' => 4
					),
					'background' => array(
						'type' => 'color',
						'color' => 'rgba(0,0,0,0.7)',
					)
				)
			),
			'woopbf' => array(
				'type' => 'thz-typography',
				'label' => __('Button font metrics', 'creatus'),
				'desc' => esc_html__('Adjust button font metrics.', 'creatus'),
				'value' => array(
					'size' => 14,
					'color' => '#ffffff'
				),
				'disable' => array('hovered','align'),
			)
		)
	),

);