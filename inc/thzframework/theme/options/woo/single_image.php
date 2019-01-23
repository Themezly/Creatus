<?php
if (!defined('FW')) {
	die('Forbidden');
}
$options = array(
	'wooimgcol' => array(
		'type' => 'thz-multi-options',
		'label' => __('Image column settings', 'creatus'),
		'desc' => esc_html__('Adjust image column width and space between the image and summary.', 'creatus'),
		'value' => array(
			'w' => 'thz-col-1-2',
			's' => 60
		),
		'thz_options' => array(
			'w' => array(
				'type' => 'short-select',
				'title' => __('Width', 'creatus'),
				'choices' => array(
					'thz-col-1' => __('1/1', 'creatus'),
					'thz-col-1-2' => __('1/2', 'creatus'),
					'thz-col-1-3' => __('1/3', 'creatus'),
					'thz-col-1-4' => __('1/4', 'creatus'),
					'thz-col-2-3' => __('2/3', 'creatus'),
					'thz-col-3-4' => __('3/4', 'creatus'),
				)
			),
			's' => array(
				'type' => 'spinner',
				'title' => esc_html__('Space', 'creatus'),
				'addon' => 'px',
				'min' => 0,
			)
		)
	),
	'wooimgh' => array(
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
	'wooimgsl' => array(
		'type' => 'thz-multi-options',
		'label' => __('Image slider layout', 'creatus'),
		'desc' => esc_html__('Adjust image slider layout', 'creatus'),
		'value' => array(
			'show' => 1,
			'scroll' => 1,
			'space' => 0,
			'dots' => 'hide',
			'arrows' => 'show',
			'img' => 'thz-img-large',
			'showt' => 4,
			'thumbh' => 80,
			'spacet' => 20,
			'thumb' => 'thz-img-large',
			
		),
		'breakafter' => array('arrows'),
		'thz_options' => array(
			'show' => array(
				'type' => 'select',
				'title' => esc_html__('Slides to show', 'creatus'),
				'choices' => array(
					'1' => esc_html__('1', 'creatus'),
					'2' => esc_html__('2', 'creatus'),
					'3' => esc_html__('3', 'creatus'),
					'4' => esc_html__('4', 'creatus'),
					'5' => esc_html__('5', 'creatus'),
					'6' => esc_html__('6', 'creatus')
				)
			),
			'scroll' => array(
				'type' => 'select',
				'title' => esc_html__('Slides to scroll', 'creatus'),
				'choices' => array(
					'1' => esc_html__('1', 'creatus'),
					'2' => esc_html__('2', 'creatus'),
					'3' => esc_html__('3', 'creatus'),
					'4' => esc_html__('4', 'creatus'),
					'5' => esc_html__('5', 'creatus'),
					'6' => esc_html__('6', 'creatus')
				)
			),
			'space' => array(
				'type' => 'spinner',
				'title' => esc_html__('Slides space', 'creatus'),
				'addon' => 'px',
				'min' => 0,
			),
			'dots' => array(
				'type' => 'short-select',
				'title' => esc_html__('Navigation dots', 'creatus'),
				'choices' => array(
					'hide' => esc_html__('Hide', 'creatus'),
					'inside' => esc_html__('Inside', 'creatus'),
					'outside' => esc_html__('Outside', 'creatus')
				)
			),
			'arrows' => array(
				'type' => 'short-select',
				'title' => esc_html__('Arrows', 'creatus'),
				'choices' => array(
					'hide' => esc_html__('Hide', 'creatus'),
					'show' => esc_html__('Show', 'creatus')
				)
			),
			'img' => array(
				'type' => 'short-select',
				'title' => esc_html__('Image size', 'creatus'),
				'choices' => thz_get_image_sizes_list()
			),
	
			'showt' => array(
				'type' => 'select',
				'title' => esc_html__('Thumbs to show', 'creatus'),
				'choices' => array(
					'1' => esc_html__('1', 'creatus'),
					'2' => esc_html__('2', 'creatus'),
					'3' => esc_html__('3', 'creatus'),
					'4' => esc_html__('4', 'creatus'),
					'5' => esc_html__('5', 'creatus'),
					'6' => esc_html__('6', 'creatus')
				)
			),
			'spacet' => array(
				'type' => 'spinner',
				'title' => esc_html__('Thumbs space', 'creatus'),
				'addon' => 'px',
				'min' => 0,
			),
			'thumbh' => array(
				'type' => 'spinner',
				'title' => esc_html__('Thumbs height', 'creatus'),
				'addon' => 'px',
				'min' => 0,
			),
			'thumb' => array(
				'type' => 'short-select',
				'title' => esc_html__('Thumbs size', 'creatus'),
				'choices' => thz_get_image_sizes_list()
			),
		)
	),
	'wooimgsa' => array(
		'type' => 'thz-multi-options',
		'label' => __('Image slider animation', 'creatus'),
		'desc' => esc_html__('Adjust image slider animation. Hover over info icon for details.', 'creatus'),
		'help' => esc_html__('Speed: Slide/Fade animation speed<br />Auto slide: If set to Yes, slider will start on page load<br />Auto time: Time till next slide transition<br />Infinite: If set to Yes, slides will loop infinitely<br />1000ms = 1s', 'creatus'),
		'value' => array(
			'speed' => 300,
			'autoplay' => 0,
			'autoplayspeed' => 3000,
			'fade' => 0,
			'infinite' => 0
		),
		'thz_options' => array(
			'speed' => array(
				'type' => 'spinner',
				'title' => esc_html__('Speed', 'creatus'),
				'addon' => 'ms',
				'min' => 0,
				'step' => 50,
				'max' => 1500
			),
			'autoplay' => array(
				'type' => 'select',
				'title' => esc_html__('Auto slide', 'creatus'),
				'choices' => array(
					0 => esc_html__('No', 'creatus'),
					1 => esc_html__('Yes', 'creatus')
				)
			),
			'autoplayspeed' => array(
				'type' => 'spinner',
				'title' => esc_html__('Auto time', 'creatus'),
				'addon' => 'ms',
				'min' => 0,
				'step' => 50,
				'max' => 10000
			),
			'fade' => array(
				'type' => 'select',
				'title' => esc_html__('Fade', 'creatus'),
				'choices' => array(
					0 => esc_html__('No', 'creatus'),
					1 => esc_html__('Yes', 'creatus')
				)
			),
			'infinite' => array(
				'type' => 'select',
				'title' => esc_html__('Infinite', 'creatus'),
				'choices' => array(
					0 => esc_html__('No', 'creatus'),
					1 => esc_html__('Yes', 'creatus')
				)
			)
		)
	),
	'wooimgmi' => array(
		'type' => 'multi-picker',
		'label' => false,
		'desc' => false,
		'show_borders' => true,
		'picker' => array(
			'picked' => array(
				'label' => __('Show overlay icon', 'creatus'),
				'desc' => esc_html__('Show/hide overlay icon', 'creatus'),
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
				'icon' => array(
					'type' => 'thz-icon',
					'value' => 'thzicon thzicon-plus',
					'label' => __('Overlay icon', 'creatus'),
					'desc' => esc_html__('Set overlay icon. Shown only if icon selected.', 'creatus')
				),
				'icm' => array(
					'type' => 'thz-multi-options',
					'label' => __('Icon metrics', 'creatus'),
					'desc' => esc_html__('Adjust icon metrics', 'creatus'),
					'value' => array(
						'pa' => 10,
						'fs' => 16,
						'co' => '#ffffff'
					),
					'thz_options' => array(
						'pa' => array(
							'type' => 'spinner',
							'title' => esc_html__('Padding', 'creatus'),
							'addon' => 'px',
							'min' => 0,
							'max' => 100
						),
						'fs' => array(
							'type' => 'spinner',
							'title' => esc_html__('Icon size', 'creatus'),
							'addon' => 'px',
							'min' => 0,
							'max' => 100
						),
						'co' => array(
							'type' => 'color',
							'title' => esc_html__('Icon color', 'creatus'),
							'box' => true
						)
					)
				),
				'ibgm' => array(
					'type' => 'thz-multi-options',
					'label' => __('Shape metrics', 'creatus'),
					'desc' => esc_html__('Adjust icon background shape metrics', 'creatus'),
					'value' => array(
						'sh' => 'square',
						'bg' => '',
						'bs' => 'solid',
						'bsi' => 0,
						'bc' => ''
					),
					'thz_options' => array(
						'sh' => array(
							'type' => 'short-select',
							'title' => esc_html__('Type', 'creatus'),
							'choices' => array(
								'circle' => esc_html__('Circle', 'creatus'),
								'square' => esc_html__('Square', 'creatus'),
								'rounded' => esc_html__('Rounded', 'creatus')
							)
						),
						'bg' => array(
							'type' => 'color',
							'title' => esc_html__('Background', 'creatus'),
							'box' => true
						),
						'bs' => array(
							'type' => 'short-select',
							'title' => esc_html__('Border style', 'creatus'),
							'choices' => array(
								'solid' => esc_html__('Solid', 'creatus'),
								'dashed' => esc_html__('Dashed', 'creatus'),
								'dotted' => esc_html__('Dotted', 'creatus')
							)
						),
						'bsi' => array(
							'type' => 'spinner',
							'title' => esc_html__('Border size', 'creatus'),
							'addon' => 'px',
							'min' => 0,
							'max' => 100
						),
						'bc' => array(
							'type' => 'color',
							'title' => esc_html__('Border color', 'creatus'),
							'box' => true
						)
					)
				)
			)
		)
	)
);