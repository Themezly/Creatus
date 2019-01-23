<?php if ( ! defined( 'FW' ) ) die( 'Forbidden' );

$options = array(
		'installregen' => array(
			'type' => 'thz-html',
			'label' => false,
			'html' => '<h3>After changing any of these values, please install and run <a href="' . admin_url() . 'plugin-install.php?tab=plugin-information&amp;plugin=regenerate-thumbnails&amp;TB_iframe=true&amp;width=830&amp;height=472" class="thickbox" title="' . esc_html__('Regenerate Thumbnails', 'creatus') . '">' . esc_html__('Regenerate Thumbnails plugin', 'creatus') . '</a></h3><h4>For more informations on custom image sizes please visit <a target="_blank" href="https://developer.wordpress.org/reference/functions/add_image_size/">WP Codex add_image_size</a>.</h4>'
		),
		'image_quality' => array(
			'type' => 'thz-spinner',
			'value' => 90,
			'addon' => '%',
			'min' => 10,
			'max' => 100,
			'value' => 90,
			'label' => __('Processed image quality', 'creatus'),
			'desc' => esc_html__('Set quality of processed images. The higher the number the larger the image size.', 'creatus')
		),
		
		'thz-img-sizes' => array(
			'type' => 'thz-multi-options',
			'label' => __('Default image sizes', 'creatus'),
			'desc' => esc_html__('Set default image sizes. See help for more info.', 'creatus'),
			'help' => esc_html__('These are only width values and images are not croped. Images can be accessed via following size handles; thz-img-large, thz-img-medium, thz-img-small', 'creatus'),
			'value' => array(
				'thz-img-large' => 1200,
				'thz-img-medium' => 570,
				'thz-img-small' => 350,
			),
			'thz_options' => array(
				'thz-img-large' => array(
					'type' => 'spinner',
					'title' => esc_html__('Large', 'creatus'),
					'addon' => 'px',
					'min' => 0,
				),
				'thz-img-medium' => array(
					'type' => 'spinner',
					'title' => esc_html__('Medium', 'creatus'),
					'addon' => 'px',
					'min' => 0,
				),
				'thz-img-small' => array(
					'type' => 'spinner',
					'title' => esc_html__('Small', 'creatus'),
					'addon' => 'px',
					'min' => 0,
				),
			)
		),
		
		'custom_image_sizes' => array(
			'type' => 'addable-popup',
			'value' => array(),
			'label' => __('Custom Image sizes', 'creatus'),
			'desc' => esc_html__('Add custom image sizes', 'creatus'),
			'template' => '<strong>{{- size_name }}</strong>: {{- image_sizes[\'max-width\'] }} x {{- image_sizes[\'max-height\'] }}<strong> - {{- crop_mode.picked }}</strong>',
			'popup-title' => null,
			'size' => 'large',
			'sortable' => false,
			'add-button-text' => esc_html__('Add custom image size', 'creatus'),
			'popup-options' => array(
				'size_name' => array(
					'label' => __('Size name', 'creatus'),
					'type' => 'text',
					'value' => '',
					'desc' => esc_html__('Add image size name. This is required and it is used in add_image_size function.', 'creatus')
				),
				'image_sizes' => array(
					'type' => 'thz-multi-options',
					'label' => __('Set image sizes', 'creatus'),
					'desc' => esc_html__('Set custom image sizes', 'creatus'),
					'value' => array(
						'max-width' => 1200,
						'max-height' => 690
					),
					'thz_options' => array(
						'max-width' => array(
							'type' => 'spinner',
							'title' => esc_html__('Max width', 'creatus'),
							'addon' => 'px',
							'min' => 0,
						),
						'max-height' => array(
							'type' => 'spinner',
							'title' => esc_html__('Max height', 'creatus'),
							'addon' => 'px',
							'min' => 0,
						)
					)
				),
				'crop_mode' => array(
					'type' => 'multi-picker',
					'label' => false,
					'desc' => false,
					'picker' => array(
						'picked' => array(
							'label' => __('Crop mode', 'creatus'),
							'desc' => sprintf ( esc_html__('Select crop mode. Visit %1s for more info', 'creatus'),'<a target="_blank" href="https://developer.wordpress.org/reference/functions/add_image_size/">WP Codex add_image_size</a>'),
							'type' => 'radio',
							'value' => 'softcrop',
							'inline' => true,
							'choices' => array(
								'softcrop' => esc_html__('Soft crop', 'creatus'),
								'hardcrop' => esc_html__('Hard crop', 'creatus'),
								'custom' => esc_html__('Custom', 'creatus')
							)
						)
					),
					'choices' => array(
						'custom' => array(
							'custom_crop' => array(
								'type' => 'thz-multi-options',
								'label' => __('Set image sizes', 'creatus'),
								'desc' => esc_html__('Select x and y crop values', 'creatus'),
								'value' => array(
									'customx' => 'left',
									'customy' => 'top'
								),
								'thz_options' => array(
									'customx' => array(
										'type' => 'short-select',
										'title' => esc_html__('X Crop', 'creatus'),
										'choices' => array(
											'left' => esc_html__('Left', 'creatus'),
											'center' => esc_html__('Center', 'creatus'),
											'right' => esc_html__('Right', 'creatus')
										)
									),
									'customy' => array(
										'type' => 'short-select',
										'title' => esc_html__('Y Crop', 'creatus'),
										'choices' => array(
											'top' => esc_html__('Top', 'creatus'),
											'center' => esc_html__('Center', 'creatus'),
											'bottom' => esc_html__('Bottom', 'creatus')
										)
									)
								)
							)
						)
					)
				)
			)
		),
		

);