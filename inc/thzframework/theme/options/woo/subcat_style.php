<?php
if (!defined('FW')) {
	die('Forbidden');
}
$options = array(
	'tabdefaultsettings' => array(
		'title' => __('Defaults', 'creatus'),
		'type' => 'tab',
		'options' => array(
			'gutter' => array(
				'type' => 'thz-spinner',
				'label'   => esc_html__( 'Sub categories grid gutter', 'creatus' ),
				'desc' => esc_html__('Set space between subcategories', 'creatus'),
				'addon' => 'px',
				'min' => 0,
				'max' => 100,
				'value' => 30,
			),		

			'wooscbs' => array(
				'type' => 'thz-box-style',
				'label' => __('Sub category style', 'creatus'),
				'preview' => true,
				'button-text' => esc_html__('Customize sub category box style', 'creatus'),
				'desc' => esc_html__('Adjust .thz-woo-sub-category box style', 'creatus'),
				'popup' => true,
				'disable' => array('layout','video','boxsize','transform'),
				'value' => array()
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
						'value' => 'thz-ratio-2-3',
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

		)
	),
	'tabtitlesettings' => array(
		'title' => __('Title', 'creatus'),
		'type' => 'tab',
		'options' => array(
			'title' => array(
				'type' => 'thz-box-style',
				'label' => __('Sub category title metrics', 'creatus'),
				'preview' => true,
				'desc' => esc_html__('Adjust .thz-woo-cat-title padding and margin', 'creatus'),
				'popup' => false,
				'disable' => array('layout','borders','borderradius','boxsize','transform','boxshadow','background'),
				'value' => array(
					'padding' => array(
						'top' => 30,
						'right' => 0,
						'bottom' => 30,
						'left' => 0
					),
				)
			),
			'tfont' => array(
				'type' => 'thz-typography',
				'label' => __('Title font metrics', 'creatus'),
				'desc' => esc_html__('Adjust sub category title font metrics.', 'creatus'),
				'value' => array(),
			),
			
			'counter' => array(
				'label' => __('Products counter', 'creatus'),
				'desc' => esc_html__('Show/hide number of products counter', 'creatus'),
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
			
			
			
		)
	),
	
	
);