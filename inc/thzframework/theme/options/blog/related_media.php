<?php
if (!defined('FW'))
	die('Forbidden');
$options = array(
	'pr_media' => array(
		'type' => 'multi-picker',
		'label' => false,
		'desc' => false,
		'picker' => array(
			'picked' => array(
				'label' => __('Show media', 'creatus'),
				'desc' => esc_html__('Show/hide related item media', 'creatus'),
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
		'show_borders' => true,
		'choices' => array(
			'show' => array(
				'align' => array(
					'type' => 'multi-picker',
					'label' => false,
					'desc' => false,
					'picker' => array(
						'picked' => array(
							'label' => __('Media container alignment', 'creatus'),
							'type' => 'image-picker',
							'value' => 'full',
							'desc' => esc_html__('Select related item media container alignment', 'creatus'),
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
							'width' => array(
								'type' => 'thz-spinner',
								'label' => __('Media container width', 'creatus'),
								'desc' => esc_html__('Set media container width', 'creatus'),
								'addon' => '%',
								'min' => 0,
								'max' => 500,
								'value' => 40
							)
						),
						'right' => array(
							'width' => array(
								'type' => 'thz-spinner',
								'label' => __('Media container width', 'creatus'),
								'desc' => esc_html__('Set media container width', 'creatus'),
								'addon' => '%',
								'min' => 0,
								'max' => 500,
								'value' => 40
							)
						)
					)
				),
				'height' => array(
					'type' => 'thz-spinner',
					'label' => __('Media container height', 'creatus'),
					'desc' => esc_html__('Set media container height', 'creatus'),
					'addon' => 'px',
					'min' => 0,
					'max' => 500,
					'value' => 220
				),
				
				'rel_mbs' => array(
					'type' => 'thz-box-style',
					'label' => __('Related media box style', 'creatus'),
					'preview' => true,
					'button-text' => esc_html__('Customize related media box style', 'creatus'),
					'desc' => esc_html__('Adjust .thz-related-media box style', 'creatus'),
					'popup' => true,
					'disable' => array('boxsize','video'),
					'value' => array(),
					'units' => array(
						'borderradius',
						'padding',
						'margin',
					),
				),
				
				'rel_size' => array(
					'label' => __('Related Image size', 'creatus'),
					'desc' => esc_html__('Select the image size to be used in related posts.', 'creatus'),
					'value' => 'thz-img-medium',
					'type' => 'short-select',
					'choices' => thz_get_image_sizes_list()
				),
				'rel_ind' => array(
					'type' => 'multi-picker',
					'label' => false,
					'desc' => false,
					'picker' => array(
						'picked' => array(
							'label' => __('Related indicator', 'creatus'),
							'desc' => esc_html__('Indicator shows up on media hover. It can be related item title or icon', 'creatus'),
							'type' => 'switch',
							'right-choice' => array(
								'value' => 'title',
								'label' => __('Title', 'creatus')
							),
							'left-choice' => array(
								'value' => 'icon',
								'label' => __('icon', 'creatus')
							),
							'value' => 'icon'
						)
					),
					'choices' => array(
						'icon' => array(
							'icon' => array(
								'type' => 'thz-icon',
								'value' => array(
									'icon' => 'thzicon thzicon-plus',
									'size' => 16,
									'color' => '#ffffff'
								),
								'label' => __('Indicator icon', 'creatus'),
								'desc' => esc_html__('Set indicator icon. Shown only if icon selected.', 'creatus')
							)
						),
						'title' => array(
							'font' => array(
								'type' => 'thz-typography',
								'label' => __('Title indicator font', 'creatus'),
								'desc' => esc_html__('Adjust title indicator font metrics.', 'creatus'),
								'value' => array(
									'size' => 16,
									'color' => '#ffffff'
								),
								'disable' => array('line-height','hovered','align','text-shadow'),
							)
						)
					)
				)
			)
		)
	)
);