<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'unique_id'        => array(
		'type' => 'unique'
	),
	'slider_animation' => array(
		'type' => 'thz-multi-options',
		'label' => __('Slider animation', 'creatus'),
		'desc' => esc_html__('Adjust slider animation. Hover over info icon for details.', 'creatus'),
		'help' => esc_html__('Speed: Slide/Fade animation speed<br />Auto slide: If set to Yes, slider will start on page load<br />Auto time: Time till next slide transition<br />Infinite: If set to Yes, slides will loop infinitely<br />1000ms = 1s', 'creatus'),
		'value' => array(
			'speed' => 300,
			'autoplay' => 0,
			'autoplayspeed' => 3000,
			'fade' => 0,
			'infinite' => 1
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
				'attr' => array(
					'class' => 'thz-select-switch'
				),
				'choices' => array(
					0 => array(
						'text' => esc_html__('No', 'creatus') ,
						'attr' => array(
							'data-disable' => '.slop-auto-play-parent',
						)
					),
					1 => array(
						'text' => esc_html__('Yes', 'creatus') ,
						'attr' => array(
							'data-enable' => '.slop-auto-play-parent',
						)
					),
				)
			),
			'autoplayspeed' => array(
				'type' => 'spinner',
				'attr' => array(
					'class' =>'slop-auto-play'
				),
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
		),
	),
	'ratio' => array(
		'type' => 'multi-picker',
		'label' => false,
		'desc' => false,
		'picker' => array(
			'picked' => array(
				'label' => __('Slider height', 'creatus'),
				'desc' => esc_html__('Set slider container height.', 'creatus'),
				'type' => 'select',
				'value' => 'thz-ratio-16-9',
				'choices' => array(
					array( // optgroup
						'attr' => array(
							'label' => __('Misc', 'creatus')
						),
						'choices' => array(
							'custom' => esc_html__('Custom', 'creatus'),
							'thz-ratio-vh' => esc_html__('Viewport height', 'creatus')
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
							'thz-ratio-21-9' => esc_html__('Aspect ratio 21:9', 'creatus'),
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
					'value' => 550,
					'desc' => esc_html__('Media container height. ', 'creatus')
				)
			)
		)
	),

	'style' => array(
		'type' => 'popup',
		'value' => array(),
		'label' => __('Styling', 'creatus'),
		'desc'  => esc_html__('Customize slider style.', 'creatus'),
		'popup-title' => esc_html__('Slider style', 'creatus'),
		'size' => 'large',
		'button' => esc_html__('Edit Slider style', 'creatus'),
		'popup-options' => array(
			fw_ext('slick-full')->get_options('styling')
		),
	),	
	
);