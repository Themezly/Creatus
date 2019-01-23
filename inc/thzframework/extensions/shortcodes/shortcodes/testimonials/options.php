<?php
if (!defined('FW')) {
	die('Forbidden');
}
$options = array(
	'defaultstab' => array(
		'title' => __('Defaults', 'creatus'),
		'type' => 'tab',
		'options' => array(
			'id' => array(
				'type' => 'unique',
				'length' => 8
			),
			'testimonials' => array(
				'label' => __('Testimonials', 'creatus'),
				'popup-title' => esc_html__('Add/Edit Testimonial', 'creatus'),
				'desc' => esc_html__('Here you can add, remove and edit your testimonials.', 'creatus'),
				'type' => 'addable-popup',
				'template' => '{{=author_name}}',
				'add-button-text' => esc_html__('Add/edit testimonial', 'creatus'),
				'size' => 'large',
				'popup-options' => array(
					'author_quote' => array(
						'label' => __('Quote', 'creatus'),
						'desc' => esc_html__('Enter the author quote', 'creatus'),
						'type' => 'textarea'
					),
					'author_avatar' => array(
						'label' => __('Image', 'creatus'),
						'desc' => esc_html__('Upload or select author image', 'creatus'),
						'type' => 'upload'
					),
					'author_name' => array(
						'label' => __('Name', 'creatus'),
						'desc' => esc_html__('Enter the author name', 'creatus'),
						'type' => 'text'
					),
					'author_job' => array(
						'label' => __('Job', 'creatus'),
						'desc' => esc_html__('Enter author job position', 'creatus'),
						'type' => 'text'
					),
					'author_website' => array(
						'label' => __('Website Name', 'creatus'),
						'desc' => esc_html__('Enter author website name', 'creatus'),
						'type' => 'text'
					),
					'author_url' => array(
						'label' => __('Website Link', 'creatus'),
						'desc' => esc_html__('Enter author website link', 'creatus'),
						'type' => 'text'
					)
				)
			),
			'cmx' => _thz_container_metrics_defaults()
		)
	),
	'layouttab' => array(
		'title' => __('Layout & Style', 'creatus'),
		'type' => 'tab',
		'options' => array(
			'bs' => array(
				'type' => 'thz-box-style',
				'label' => __('Container box style', 'creatus'),
				'preview' => false,
				'popup' => true,
				'desc' => esc_html__('Adjust .thz-testimonials-holder box style', 'creatus'),
				'button-text' => __('Customize container box style', 'creatus'),
				'disable' => array('video'),
				'units' => array(
					'borderradius',
					'boxsize',
					'padding',
					'margin',
				),
				'value' => array()
			),
			'tbs' => array(
				'type' => 'thz-box-style',
				'label' => __('Testimonial box style', 'creatus'),
				'preview' => false,
				'popup' => true,
				'desc' => esc_html__('Adjust .thz-testimonial box style', 'creatus'),
				'button-text' => __('Customize testimonial box style', 'creatus'),
				'disable' => array('video'),
				'units' => array(
					'borderradius',
					'boxsize',
					'padding',
					'margin',
				),
				'value' => array()
			),
			
			'layout_mode' => array(
				'label' => __('Layout mode', 'creatus'),
				'desc' => esc_html__('Select testimonials layout mode', 'creatus'),
				'type' => 'short-select',
				'attr' => array(
					'class' => 'thz-select-switch'
				),
				'value' => 'slider',
				'choices' => array(
					'grid' => array(
						'text' => esc_html__('Grid', 'creatus'),
						'attr' => array(
							'data-enable' => 'grid,animate',
							'data-disable' => '.thz-tab-slider-li'
						)
					),
					'slider' => array(
						'text' => esc_html__('Slider', 'creatus'),
						'attr' => array(
							'data-enable' => '.thz-tab-slider-li',
							'data-disable' => 'grid,animate'
						)
					),
				)
			),
			'grid' => array(
				'type' => 'thz-multi-options',
				'label' => __('Grid settings', 'creatus'),
				'desc' => esc_html__('Adjust grid settings. See help for more info.', 'creatus'),
				'help' => esc_html__('If the .thz-grid-item-in width is less than desired min width, the columns number drops down by one in order to honor the min width setting. On the other hand if the window width is below 980px and grid has more than 2 columns, only 2 columns are shown. Under 767px 1 column is shown.', 'creatus'),
				'value' => array(
					'columns' => 3,
					'gutter' => 30,
					'minwidth' => 220,
					'isotope' => 'packery'
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
					'isotope' => array(
						'type' => 'short-select',
						'title' => esc_html__('Isotope mode', 'creatus'),
						'choices' => array(
							'packery' => esc_html__('Packery ( Masonry, place items where they fit )', 'creatus'),
							'fitRows' => esc_html__('fitRows ( Row height by tallest item in row )', 'creatus'),
							'vertical' => esc_html__('Vertical ( best with 1 column grid ) ', 'creatus'),
						)
					),
				)
			),
			'qbs' => array(
				'type' => 'thz-box-style',
				'label' => __('Adjust .thz-testimonial-quote box style', 'creatus'),
				'preview' => true,
				'button-text' => esc_html__('Customize quote box style', 'creatus'),
				'desc' => esc_html__('Adjust .thz-testimonial-quote box style', 'creatus'),
				'popup' => true,
				'disable' => array('video','transform'),
				'value' => array(
					'padding' => array(
						'top' => 30,
						'right' => 30,
						'bottom' => 30,
						'left' => 30
					),	
					'borders' => array(
						'all' => 'same',
						'top' => array(
							'w' => 1,
							's' => 'solid',
							'c' => 'color_4'
						),
					),
					'borderradius' => array(
						'top-left' => 2,
						'top-right' => 2,
						'bottom-right' => 2,
						'bottom-left' => 2,
					),
					'background' => array(
						'type' => 'color',
						'color' => '#ffffff',
					)			
				)
			),
			'tm' => array(
				'type' => 'thz-multi-options',
				'label' => __('Testimonials metrics', 'creatus'),
				'desc' => esc_html__('Adjust testimonial metrics', 'creatus'),
				'value' => array(
					'info_side' => 'center',
					'image_shape' => 'circle',
					'ar' => 'show-arrow',
					'qu' => 'show',
					'style' => 'quick',
					'qbs' => '',
					'padding' => 30,
					'bg' => '#fafafa',
					'bo' => '#eaeaea',
					'bw' => 1,
					'bs' => 'solid',
					'br' => 2,
				),
				'breakafter' => array('style'),
				'thz_options' => array(
					'info_side' => array(
						'type' => 'short-select',
						'title' => esc_html__('Info side', 'creatus'),
						'choices' => array(
							'left' => esc_html__('Left', 'creatus'),
							'center' => esc_html__('Center', 'creatus'),
							'right' => esc_html__('Right', 'creatus')
						)
					),
					'image_shape' => array(
						'type' => 'short-select',
						'title' => esc_html__('Image shape', 'creatus'),
						'choices' => array(
							'square' => esc_html__('Square', 'creatus'),
							'rounded' => esc_html__('Rounded', 'creatus'),
							'circle' => esc_html__('Circle', 'creatus')
						)
					),
					'ar' => array(
						'type' => 'short-select',
						'title' => esc_html__('Arrow', 'creatus'),
						'choices' => array(
							'show-arrow' => esc_html__('Show', 'creatus'),
							'hide-arrow' => esc_html__('Hide', 'creatus')
						)
					),
					'qu' => array(
						'type' => 'short-select',
						'title' => esc_html__('Quotes', 'creatus'),
						'choices' => array(
							'show' => esc_html__('Show', 'creatus'),
							'hide' => esc_html__('Hide', 'creatus')
						)
					),
					'style' => array(
						'type' => 'short-select',
						'title' => esc_html__('Quote style mode', 'creatus'),
						'attr' => array(
							'class' => 'thz-select-switch'
						),
						'choices' => array(
							'quick' => array(
								'text' => esc_html__('Quick', 'creatus'),
								'attr' => array(
									'data-enable' => '.quicks-parent',
									'data-disable' => '.customs-parent'
								)
							),
							'custom' => array(
								'text' => esc_html__('Custom', 'creatus'),
								'attr' => array(
									'data-enable' => '.customs-parent',
									'data-disable' => '.quicks-parent'
								)
							),
						),
					),
					'qbs' => array(
						'type' => 'box-style',
						'title' => esc_html__('Quote box style', 'creatus'),
						'button-text' => esc_html__('Edit quote box style', 'creatus'),
						'connect' => 'qbs',
						'attr' => array(
							'class' => 'customs'
						),
					),
					'padding' => array(
						'type' => 'spinner',
						'title' => esc_html__('Padding', 'creatus'),
						'addon' => 'px',
						'min' => 0,
						'attr' => array(
							'class' => 'quicks'
						),
					),
					'bg' => array(
						'type' => 'color',
						'title' => esc_html__('Background', 'creatus'),
						'box' => true,
						'attr' => array(
							'class' => 'quicks'
						),
					),
					'bo' => array(
						'type' => 'color',
						'title' => esc_html__('Border', 'creatus'),
						'box' => true,
						'attr' => array(
							'class' => 'quicks'
						),
					),
					'bw' => array(
						'type' => 'spinner',
						'title' => esc_html__('Border width', 'creatus'),
						'addon' => 'px',
						'min' => 0,
						'max' => 5,
						'attr' => array(
							'class' => 'quicks'
						),
					),
					'bs' => array(
						'type' => 'short-select',
						'title' => esc_html__('Border style', 'creatus'),
						'choices' => array(
							'solid' => esc_html__('Solid', 'creatus'),
							'dashed' => esc_html__('Dashed', 'creatus'),
							'dotted' => esc_html__('Dotted', 'creatus')
						),
						'attr' => array(
							'class' => 'quicks'
						),
					),
					'br' => array(
						'type' => 'spinner',
						'title' => esc_html__('Border radius', 'creatus'),
						'addon' => 'px',
						'min' => 0,
						'attr' => array(
							'class' => 'quicks'
						),
					),

				)
			),
		)
	),
	
	'slidertab' => array(
		'title' => __('Slider settings', 'creatus'),
		'type' => 'tab',
		'li-attr' => array(
			'class' => 'thz-tab-slider-li'
		),
		'lazy_tabs' => false,
		'options' => array(	

			fw()->theme->get_options( 'slider_settings')
		)
	),
	
	'fontstab' => array(
		'title' => __('Fonts', 'creatus'),
		'type' => 'tab',
		'options' => array(
			'qf' => array(
				'type' => 'thz-typography',
				'label' => __('Quote font', 'creatus'),
				'desc' => esc_html__('Adjust author quote font.', 'creatus'),
				'value' => array(
					'size' 			=> 28,
				),
				'disable' => array('hovered'),
			),
			'nf' => array(
				'type' => 'thz-typography',
				'label' => __('Name font', 'creatus'),
				'desc' => esc_html__('Adjust author name font.', 'creatus'),
				'value' => array(
					'weight' => 600,
				),
				'disable' => array('hovered','align'),
			),
			'jf' => array(
				'type' => 'thz-typography',
				'label' => __('Job font', 'creatus'),
				'desc' => esc_html__('Adjust author job font.', 'creatus'),
				'value' => array(),
				'disable' => array('hovered','align'),
			),
			'wf' => array(
				'type' => 'thz-typography',
				'label' => __('Website font', 'creatus'),
				'desc' => esc_html__('Adjust author website font.', 'creatus'),
				'value' => array(),
				'disable' => array('align'),
			)
		)
	),
	
	'testeffects' => array(
		'title' => __('Effects', 'creatus'),
		'type' => 'tab',
		'lazy_tabs' => false,
		'options' => array(
			'animate' => array(
				'type' => 'thz-animation',
				'label' => false,
				'value' => array(
					'animate' => 'inactive',
					'effect' => 'thz-anim-slideIn-up',
					'duration' => 400,
					'delay' => 200
				),
				'addlabel' => esc_html__('Animate testimonials', 'creatus'),
				'adddesc' => esc_html__('Add animation to the testimonials HTML container', 'creatus')
			),
			'cpx' => _thz_container_parallax_default()
		)
	)
);