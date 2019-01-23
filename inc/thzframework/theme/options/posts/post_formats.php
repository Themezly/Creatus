<?php
if (!defined('FW')) {
	die('Forbidden');
}
$curf = get_post_format();
$options = array(
	'link_format_box' => array(
		'type' => 'group',
		'attr' => array(
			'class' => 'thz-formats-group thz-format-link'.($curf == 'link' ? '' : ' thz-format-group-hide') 
		),
		'options' => array(
			'link_format_link' => array(
				'type' => 'text',
				'label' => __('Link', 'creatus'),
				'desc' => esc_html__('Insert link', 'creatus')
			),
			'link_format_target' => array(
				'label' => __('Link target', 'creatus'),
				'desc' => esc_html__('Set link target', 'creatus'),
				'type' => 'switch',
				'right-choice' => array(
					'value' => '_blank',
					'label' => __('New window', 'creatus')
				),
				'left-choice' => array(
					'value' => '_self',
					'label' => __('Same window', 'creatus')
				),
				'value' => '_self'
			),

		)
	),
	'audio_format_box' => array(
		'type' => 'group',
		'attr' => array(
			'class' => 'thz-formats-group thz-format-audio'.($curf == 'audio' ? '' : ' thz-format-group-hide')
		),
		'options' => array(
			'audio_format_type' => array(
				'type' => 'multi-picker',
				'label' => false,
				'desc' => false,
				'picker' => array(
					'picked' => array(
						'label' => __('Audio type', 'creatus'),
						'desc' => esc_html__('Select audio type', 'creatus'),
						'type' => 'select',
						'value' => 'self',
						'choices' => array(
							'link' => esc_html__('Link', 'creatus'),
							'self' => esc_html__('Self hosted', 'creatus')
						)
					)
				),
				'choices' => array(
					'link' => array(
						'audio' => array(
							'type' => 'text',
							'label' => __('Audio link', 'creatus'),
							'desc' => esc_html__('Insert link to your audio file. Supported audio formats are; mp3, wav, and ogg', 'creatus')
						)
					),
					'self' => array(
						'audio' => array(
							'type' => 'multi-upload',
							'value' => array(),
							'label' => __('Upload/select audio', 'creatus'),
							'desc' => esc_html__('Allowed audio formats are; mp3, wav, and ogg. You can select all 3 audio types at once.', 'creatus'),
							'images_only' => false,
							'files_ext' => array(
								'mp3',
								'wav',
								'ogg'
							)
						)
					)
				)
			)
		)
	),
	'quote_format_box' => array(
		'type' => 'group',
		'attr' => array(
			'class' => 'thz-formats-group thz-format-quote'.($curf == 'quote' ? '' : ' thz-format-group-hide')
		),
		'options' => array(
			'quote_format_text' => array(
				'type' => 'textarea',
				'label' => __('Quote text', 'creatus'),
				'desc' => esc_html__('Add quote text', 'creatus')
			),
			'quote_format_author' => array(
				'type' => 'text',
				'label' => __('Quote author', 'creatus'),
				'desc' => esc_html__('Add quote author name', 'creatus')
			),
			'quote_format_type' => array(
				'label' => __('Quote format type', 'creatus'),
				'desc' => esc_html__('Select the quote type.', 'creatus'),
				'type' => 'short-select',
				'value' => 'quotes',
				'choices' => array(
					'quotes' => esc_html__('Quotes', 'creatus'),
					'brackets' => esc_html__('Brackets', 'creatus')
				)
			),

		)
	),
	'video_format_box' => array(
		'type' => 'group',
		'attr' => array(
			'class' => 'thz-formats-group thz-format-video'.($curf == 'video' ? '' : ' thz-format-group-hide')
		),
		'options' => array(
			'video_format_type' => array(
				'type' => 'multi-picker',
				'label' => false,
				'desc' => false,
				'picker' => array(
					'picked' => array(
						'label' => __('Video type', 'creatus'),
						'desc' => esc_html__('Select video type', 'creatus'),
						'type' => 'select',
						'value' => 'youtube',
						'choices' => array(
							'embed' => esc_html__('Video embed', 'creatus'),
							'link' => esc_html__('Video link', 'creatus'),
							'self' => esc_html__('Self hosted', 'creatus')
						)
					)
				),
				'choices' => array(
					'embed' => array(
						'video' => array(
							'type' => 'textarea',
							'label' => __('Video embed code', 'creatus'),
							'desc' => esc_html__('Insert your Youtube or Vimeo video embed code', 'creatus')
						)
					),
					'link' => array(
						'video' => array(
							'type' => 'text',
							'label' => __('Video link', 'creatus'),
							'desc' => esc_html__('Insert a link to your Youtube or Vimeo video', 'creatus')
						),
					),

					'self' => array(
						'video' => array(
							'type' => 'multi-upload',
							'value' => array(),
							'label' => __('Upload/select video', 'creatus'),
							'desc' => esc_html__('Allowed  video formats are; mp4, webm, and ogv. You can select all 3 video types at once.', 'creatus'),
							'images_only' => false,
							'files_ext' => array(
								'mp4',
								'webm',
								'ogv'
							)
						),
						'poster' => array(
							'type' => 'upload',
							'value' => array(),
							'label' => __('Poster image', 'creatus'),
							'desc' => esc_html__('Insert a poster image for this media.', 'creatus'),
							'images_only' => true
						),
					)
				)
			)
		)
	),
	'gallery_format_box' => array(
		'type' => 'group',
		'attr' => array(
			'class' => 'thz-formats-group thz-format-gallery'.($curf == 'gallery' ? '' : ' thz-format-group-hide')
		),
		'options' => array(
			'gallery_format_slider' => array(
				'type' => 'thz-multi-options',
				'label' => __('Gallery slider settings', 'creatus'),
				'desc' => esc_html__('Adjust gallery slider. Hover over help icon for more info.', 'creatus'),
				'help' => esc_html__('Speed: Slide animation speed<br />Auto slide: If set to Yes, slider will start on page load<br />Auto time: Time till next slide transition<br />Infinite: If set to Yes, slides will loop infinitely<br />1000ms = 1s', 'creatus'),
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
		)
	)
);