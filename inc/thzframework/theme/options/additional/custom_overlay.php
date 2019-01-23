<?php
if (!defined('FW'))
	die('Forbidden');
$options = array(
	'co' => array(
		'type' => 'addable-popup',
		'value' => array(),
		'label' => __('Custom overlays', 'creatus'),
		'desc' => esc_html__('Add custom overlays for specific medias or leave as is and use above settings as defaults.', 'creatus'),
		'template' => '{{= e }}',
		'popup-title' => null,
		'size' => 'large',
		'limit' => 20,
		'add-button-text' => esc_html__('Add custom overlays options', 'creatus'),
		'sortable' => true,
		'popup-options' => array(
			'e' => array(
				'type' => 'select',
				'label' => esc_html__('Media Element', 'creatus'),
				'desc' => esc_html__('Select media element that should be affected by these options.', 'creatus'),
				'value' => '.thz-archive',
				'choices' => array(
					array(
						'attr' => array(
							'label' => __('Archives', 'creatus')
						),
						'choices' => array(
							'.thz-archive' => esc_html__('Blog Posts', 'creatus'),
							'.thz-portfolio' => esc_html__('Portfolio Projects', 'creatus'),
							'.thz-woo-item' => esc_html__('WooCommerce Items', 'creatus'),
							'.thz-woo-sub-category' => esc_html__('WooCommerce Sub Category', 'creatus')
						)
					),
					array(
						'attr' => array(
							'label' => __('Single Post', 'creatus')
						),
						'choices' => array(
							'.thz-post-media' => esc_html__('Single Post', 'creatus'),
							'.thz-project-media' => esc_html__('Single Project', 'creatus'),
							'.thz-product-media' => esc_html__('Single Product', 'creatus')
						)
					),
					array(
						'attr' => array(
							'label' => __('Related Posts', 'creatus')
						),
						'choices' => array(
							'.thz-post-related-holder' => esc_html__('Related Blog Posts', 'creatus'),
							'.thz-fw-portfolio-related-holder' => esc_html__('Related Projects', 'creatus')
						)
					),
					array(
						'attr' => array(
							'label' => __('Widgets', 'creatus')
						),
						'choices' => array(
							'.thz-flickr-images' => esc_html__('Thz Flicker Widget Items', 'creatus'),
							'.thz-instagram-images' => esc_html__('Thz Instagram Widget Items', 'creatus'),
							'.thz-posts-widget-list' => esc_html__('Thz Posts Widget Items', 'creatus')
						)
					)
				)
			),
			'o' => array(
				'type' => 'thz-hover',
				'value' => array(
					'background' => array(
						'type' => 'gradient',
						'gradient' => 'radial',
						'color1' => 'rgba(0,0,0,0.1)',
						'color2' => 'rgba(0,0,0,0.8)'
					),
					'oeffect' => 'thz-hover-fadein',
					'oduration' => 'thz-transease-04',
					'ieffect' => 'thz-img-zoomin',
					'iduration' => 'thz-transease-04',
					'iceffect' => 'thz-comein-bottom',
					'icduration' => 'thz-transease-05'
				),
				'labels' => array(
					'background' => esc_html__('Media overlay background', 'creatus'),
					'overlay' => esc_html__('Media overlay effect', 'creatus'),
					'image' => esc_html__('Media image effect', 'creatus'),
					'icons' => esc_html__('Overlay element effect', 'creatus')
				),
				'descriptions' => array(
					'background' => esc_html__('Set media overlay background', 'creatus'),
					'overlay' => esc_html__('Select media overlay hover effect and duration', 'creatus'),
					'image' => esc_html__('Select media image hover effect and duration', 'creatus'),
					'icons' => esc_html__('Select media overlay element hover effect and duration', 'creatus')
				),
				'label' => false,
				'desc' => false
			)
		)
	)
);