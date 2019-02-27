<?php
if (!defined('FW'))
	die('Forbidden');
$options = array(
	'er_type' => array(
		'type' => 'multi-picker',
		'label' => false,
		'desc' => false,
		'picker' => array(
			'picked' => array(
				'label' => __('Layout Type', 'creatus'),
				'desc' => esc_html__('Select related items layout type', 'creatus'),
				'type' => 'short-select',
				'value' => 'grid',
				'choices' => array(
					'slider' => esc_html__('Slider', 'creatus'),
					'grid' => esc_html__('Grid', 'creatus')
				)
			)
		),
		'choices' => array(
			'slider' => array(
				'layout' => array(
					'type' => 'thz-multi-options',
					'label' => __('Related slider layout', 'creatus'),
					'desc' => esc_html__('Adjust related slider layout', 'creatus'),
					'value' => array(
						'items' => 6,
						'show' => 3,
						'scroll' => 1,
						'space' => 30,
						'dots' => 'outside',
						'arrows' => 'show'
					),
					'thz_options' => array(
						'items' => array(
							'type' => 'spinner',
							'title' => esc_html__('# of slides', 'creatus'),
							'addon' => '#',
							'min' => 0,
							'max' => 100
						),
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
							'title' => esc_html__('Dots location', 'creatus'),
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
								'show' => esc_html__('Show', 'creatus'),
							)
						)
					)
				),
				'animation' => array(
					'type' => 'thz-multi-options',
					'label' => __('Related slider animation', 'creatus'),
					'desc' => esc_html__('Adjust related slider. Hover over help icon for more info.', 'creatus'),
					'help' => esc_html__('Speed: Slide animation speed<br />Auto slide: If set to Yes, slider will start on page load<br />Auto time: Time till next slide transition<br />Infinite: If set to Yes, slides will loop infinitely<br />1000ms = 1s', 'creatus'),
					'value' => array(
						'speed' => 300,
						'autoplay' => 0,
						'autoplayspeed' => 3000,
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
						'infinite' => array(
							'type' => 'select',
							'title' => esc_html__('Infinite', 'creatus'),
							'choices' => array(
								0 => esc_html__('No', 'creatus'),
								1 => esc_html__('Yes', 'creatus')
							)
						)
					)
				)
			),
			'grid' => array(
				'layout' => array(
					'type' => 'thz-multi-options',
					'label' => __('Related grid settings', 'creatus'),
					'desc' => esc_html__('Set related items grid columns, gutter, results per page and height', 'creatus'),
					'value' => array(
						'columns' => 3,
						'gutter' => 30,
						'items' => 3
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
							'title' => esc_html__('Items', 'creatus'),
							'addon' => '#',
							'min' => 1,
							'max' => 100
						)
					)
				)
			),
		)
	),
	'er_rbs' => array(
		'type' => 'thz-box-style',
		'label' => __('Related row box style', 'creatus'),
		'preview' => true,
		'button-text' => esc_html__('Customize related row box style', 'creatus'),
		'desc' => esc_html__('Adjust .thz-related-posts-row box style', 'creatus'),
		'popup' => true,
		'disable' => array('video'),
		'units' => array(
			'borderradius',
			'boxsize',
			'padding',
			'margin',
		),
		'value' => array()
	),
	'er_hbs' => array(
		'type' => 'thz-box-style',
		'label' => __('Related holder box style', 'creatus'),
		'preview' => true,
		'button-text' => esc_html__('Customize related holder box style', 'creatus'),
		'desc' => esc_html__('Adjust .thz-related-holder box style','creatus'),
		'popup' => true,
		'disable' => array('video'),
		'value' => array(
			'margin' => array(
				'top' => '0',
				'right' => 'auto',
				'bottom' => 0,
				'left' => 'auto'
			),
			'padding' => array(
				'top' => 60,
				'right' => 0,
				'bottom' => 0,
				'left' => 0
			),
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
	'er_ht' => array(
		'type' => 'text',
		'value' => 'Related Events',
		'label' => __('Related heading text', 'creatus'),
		'desc' => esc_html__('Insert related events heading text', 'creatus')
	),
	'er_h' => array(
		'type' => 'thz-typography',
		'label' => __('Related heading metrics', 'creatus'),
		'desc' => esc_html__('Adjust related heading ( Realted Events ) font metrics.', 'creatus'),
		'value' => array(
			'size' => 20,
		),
		'disable' => array('hovered'),
	),
	'er_hebs' => array(
		'type' => 'thz-box-style',
		'label' => __('Related heading box style', 'creatus'),
		'desc' => esc_html__('Adjust .thz-related-heading box style','creatus'),
		'preview' => true,
		'button-text' => esc_html__('Customize related heading box style', 'creatus'),
		'popup' => true,
		'disable' => array('video'),
		'units' => array(
			'borderradius',
			'boxsize',
			'padding',
			'margin',
		),
		'value' => array(
			'margin' => array(
				'top' => 0,
				'right' => 'auto',
				'bottom' => 30,
				'left' => 'auto'
			),
		)
	),
	'er_ibs' => array(
		'type' => 'thz-box-style',
		'label' => __('Related item box style', 'creatus'),
		'preview' => true,
		'button-text' => esc_html__('Customize related item box style', 'creatus'),
		'desc' => esc_html__('Adjust .thz-related-item-box box style','creatus'),
		'popup' => true,
		'disable' => array('layout','video','boxsize','transform'),
		'value' => array()
	),
	'er_inbs' => array(
		'type' => 'thz-box-style',
		'label' => __('Intro holder box style', 'creatus'),
		'preview' => true,
		'popup' => true,
		'desc' => esc_html__('Adjust .thz-related-intro-holder box style','creatus'),
		'button-text' => esc_html__('Customize intro holder box style', 'creatus'),
		'disable' => array('layout','margin','boxsize','transform','video'),
		'value' => array(
			'padding' => array(
				'top' => 0,
				'right' => 0,
				'bottom' => 0,
				'left' => 30
			),
		)
	),	
);