<?php
if (!defined('FW'))
	die('Forbidden');
$options = array(
	'ev_grid' => array(
		'type' => 'thz-multi-options',
		'label' => __('Grid settings', 'creatus'),
		'desc' => esc_html__('Adjust grid settings. See help for more info.', 'creatus'),
		'help' => esc_html__('If the .thz-grid-item-in width is less than desired min width, the columns number drops down by one in order to honor the min width setting. On the other hand if the window width is below 980px and grid has more than 2 columns, only 2 columns are shown. Under 767px 1 column is shown.', 'creatus'),
		'value' => array(
			'columns' => 1,
			'gutter' => 60,
			'minwidth' => 200
		),
		'thz_options' => array(
			'gutter' => array(
				'type' => 'spinner',
				'title' => esc_html__('Gutter', 'creatus'),
				'addon' => 'px',
				'min' => 0,
				'max' => 200
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
			'minwidth' => array(
				'type' => 'spinner',
				'title' => esc_html__('Item min width', 'creatus'),
				'addon' => 'px',
			),
		)
	),
	'ev_ma' => array(
		'type' => 'multi-picker',
		'label' => false,
		'desc' => false,
		'picker' => array(
			'picked' => array(
				'label' => __('Media container alignment', 'creatus'),
				'type' => 'image-picker',
				'value' => 'full',
				'desc' => esc_html__('Select event media container alignment', 'creatus'),
				'choices' => array(
					'left' => array(
						'small' => array(
							'height' => 50,
							'src' => thz_theme_file_uri( '/inc/thzframework/admin/images/post_media_left.jpg')
						)
					),
					'full' => array(
						'small' => array(
							'height' => 50,
							'src' => thz_theme_file_uri( '/inc/thzframework/admin/images/post_media_full.jpg')
						)
					),
					'right' => array(
						'small' => array(
							'height' => 50,
							'src' => thz_theme_file_uri( '/inc/thzframework/admin/images/post_media_right.jpg')
						)
					)
				)
			)
		),
		'choices' => array(
			'left' => array(
				'media_width' => array(
					'type' => 'thz-spinner',
					'label' => __('Media container width', 'creatus'),
					'desc' => esc_html__('Set media container width', 'creatus'),
					'addon' => '%',
					'min' => 0,
					'max' => 100,
					'value' => 40
				)
			),
			'full' => array(),
			'right' => array(
				'media_width' => array(
					'type' => 'thz-spinner',
					'label' => __('Media container width', 'creatus'),
					'desc' => esc_html__('Set media container width', 'creatus'),
					'addon' => '%',
					'min' => 0,
					'max' => 100,
					'value' => 40
				)
			)
		)
	),
	'ev_mh' => array(
		'type' => 'multi-picker',
		'label' => false,
		'desc' => false,
		'picker' => array(
			'picked' => array(
				'label' => __('Media container height', 'creatus'),
				'desc' => esc_html__('Set media container height.', 'creatus'),
				'type' => 'select',
				'value' => 'thz-ratio-16-9',
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
	'ev_is' => array(
		'label' => __('Events image size', 'creatus'),
		'desc' => esc_html__('Select the image size to be used in event.', 'creatus'),
		'value' => 'medium_large',
		'type' => 'short-select',
		'choices' => thz_get_image_sizes_list()
	),
	'ev_style' => array(
		'type' => 'popup',
		'size' => 'large',
		'label' => __('Events style', 'creatus'),
		'desc' => esc_html__('Customize events layout and feel', 'creatus'),
		'button' => esc_html__('Edit events style', 'creatus'),
		'popup-title' => esc_html__('Events style settings', 'creatus'),
		'popup-options' => array(
			fw()->theme->get_options('events/events_style')
		)
	)
);