<?php
if (!defined('FW'))
	die('Forbidden');

$options = array(
	'bpau' => array(
		'type' => 'multi-picker',
		'label' => false,
		'desc' => false,
		'show_borders' => true,
		'picker' => array(
			'picked' => array(
				'label' => __('Show author bio', 'creatus'),
				'desc' => esc_html__('Show/hide author bio box', 'creatus'),
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
				'rowbs' => array(
					'type' => 'thz-box-style',
					'label' => __('Author row box style', 'creatus'),
					'preview' => true,
					'button-text' => esc_html__('Customize author row box style', 'creatus'),
					'desc' => esc_html__('Adjust .thz-post-author-row box style', 'creatus'),
					'popup' => true,
					'disable' => array('video'),
					'value' => array(),
					'units' => array(
						'borderradius',
						'boxsize',
						'padding',
						'margin',
					),
				),
				'holder_mx' => array(
					'type' => 'thz-multi-options',
					'label' => __('Author holder', 'creatus'),
					'desc' => esc_html__('Adjust .thz-post-author-holder. See help for more info.', 'creatus'),
					'help' => esc_html__('Note that the holder and max width settings are effective only if there is no active page sidebar.', 'creatus'),
					'value' => array(
						'h' => 'contained',
						'm' => 100
					),
					'thz_options' => array(
						'h' => array(
							'type' => 'short-select',
							'title' => __('Holder', 'creatus'),
							'choices' => array(
								'contained' => __('Contained', 'creatus'),
								'notcontained' => __('Not contained', 'creatus')
							)
						),
						'm' => array(
							'type' => 'select',
							'title' => esc_html__('Max width', 'creatus'),
							'choices' => _thz_max_width_list()
						)
					)
				),
				'as' => array(
					'type' => 'thz-multi-options',
					'label' => __('Author bio box settings', 'creatus'),
					'desc' => esc_html__('Adjust author bio box mode and elements spacings.', 'creatus'),
					'value' => array(
						'mode' => 'left',
						'heading' => 15,
						'text' => 15,
						'link' => 0
					),
					'thz_options' => array(
						'mode' => array(
							'type' => 'short-select',
							'title' => esc_html__('Mode', 'creatus'),
							'choices' => array(
								'left' => esc_html__('Left aligned', 'creatus'),
								'centered' => esc_html__('Centered', 'creatus')
							)
						),
						'heading' => array(
							'type' => 'spinner',
							'title' => esc_html__('Heading', 'creatus'),
							'addon' => 'px',
							'min' => -100,
							'max' => 100
						),
						'text' => array(
							'type' => 'spinner',
							'title' => esc_html__('Text', 'creatus'),
							'addon' => 'px',
							'min' => 0,
							'max' => 100
						),
						'link' => array(
							'type' => 'spinner',
							'title' => esc_html__('Link', 'creatus'),
							'addon' => 'px',
							'min' => -100,
							'max' => 100
						)
					)
				),
				'bs' => array(
					'type' => 'thz-box-style',
					'label' => __('Author bio box style', 'creatus'),
					'preview' => true,
					'desc' => esc_html__('Adjust .thz-author-bio box style', 'creatus'),
					'button-text' => esc_html__('Customize author bio box style', 'creatus'),
					'popup' => true,
					'disable' => array('video'),
					'units' => array(
						'borderradius',
						'boxsize',
						'padding',
						'margin',
					),
					'value' => array(
						'borders' => array(
							'all' => 'separate',
							'top' => array(
								'w' => 1,
								's' => 'solid',
								'c' => 'color_4'
							),
							'right' => array(
								'w' => 0,
								's' => 'solid',
								'c' => ''
							),
							'bottom' => array(
								'w' => 0,
								's' => 'solid',
								'c' => ''
							),
							'left' => array(
								'w' => 0,
								's' => 'solid',
								'c' => ''
							),
						),
					)
				),
				'av' => array(
					'type' => 'multi-picker',
					'label' => false,
					'desc' => false,
					'show_borders' => true,
					'picker' => array(
						'picked' => array(
							'label' => __('Show author avatar', 'creatus'),
							'desc' => esc_html__('Show/hide author avatar', 'creatus'),
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
							'size' => array(
								'type' => 'thz-spinner',
								'label' => __('Author avatar size', 'creatus'),
								'desc' => esc_html__('Set author avatar image size', 'creatus'),
								'addon' => 'px',
								'min' => 0,
								'value' => 65
							),
							'bs' => array(
								'type' => 'thz-box-style',
								'label' => __('Avatar box style', 'creatus'),
								'preview' => true,
								'button-text' => esc_html__('Customize avatar box style', 'creatus'),
								'desc' => esc_html__('Adjust .thz-author-avatar box style', 'creatus'),
								'popup' => true,
								'disable' => array(
									'layout',
									'video',
									'transform',
									'boxsize'
								),
								'units' => array(
									'borderradius',
									'padding',
									'margin',
								),
								'value' => array(
									'margin' => array(
										'top' => '0',
										'right' => '30',
										'bottom' => '0',
										'left' => '0'
									),
									'borderradius' => array(
										'top-left' => 65,
										'top-right' => 65,
										'bottom-right' => 65,
										'bottom-left' => 65,
									),													
								)
							)
						)
					)
				),
				'ah' => array(
					'type' => 'thz-typography',
					'label' => __('Author heading metrics', 'creatus'),
					'desc' => esc_html__('Adjust author heading font metrics.', 'creatus'),
					'value' => array(
						'size' => 16
					),
					'disable' => array(
						'hovered',
						'align'
					),
				),
				'at' => array(
					'type' => 'thz-typography',
					'label' => __('Author text metrics', 'creatus'),
					'desc' => esc_html__('Adjust author text font metrics.', 'creatus'),
					'value' => array(),
					'disable' => array(
						'hovered',
						'align',
						'text-shadow'
					),
				),
				'al' => array(
					'type' => 'thz-typography',
					'label' => __('Author link metrics', 'creatus'),
					'desc' => esc_html__('Adjust author more link font metrics.', 'creatus'),
					'value' => array(
						'size' => 13,
						'weight' => 600,
						'style' => 'italic'
					),
					'disable' => array(
						'align',
						'text-shadow'
					),
				),
				'alt' => array(
					'type' => 'text',
					'value' => esc_html__('More posts by', 'creatus'),
					'label' => __('Author link text', 'creatus'),
					'desc' => esc_html__('Insert author link text', 'creatus')
				)
			)
		)
	)	
);