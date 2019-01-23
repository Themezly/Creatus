<?php
if (!defined('FW')) {
	die('Forbidden');
}
$options = array(
	'tabboxsettings' => array(
		'title' => __('Boxes', 'creatus'),
		'type' => 'tab',
		'options' => array(
			'hbs' => array(
				'type' => 'thz-box-style',
				'label' => __('Holder box style', 'creatus'),
				'preview' => true,
				'button-text' => esc_html__('Customize holder box style', 'creatus'),
				'desc' => esc_html__('Adjust .thz-events .thz-grid-item-in box style','creatus'),
				'popup' => true,
				'disable' => array('video'),
				'value' => array(
					'borderradius' => array(
						'top-left' => 4,
						'top-right' => 4,
						'bottom-left' => 4,
						'bottom-right' => 4
					),			
					'boxshadow' => array(
						1 => array(
							'inset' => false,
							'horizontal-offset' => 0,
							'vertical-offset' => 4,
							'blur-radius' => 28,
							'spread-radius' => 0,
							'shadow-color' =>'rgba(0,0,0,0.08)'
						)
					),
					'background' => array(
						'type' => 'color',
						'color' => '#ffffff',
					)
				
				)
			),
			'me_bs' => array(
				'type' => 'thz-box-style',
				'label' => __('Media box style', 'creatus'),
				'desc' => esc_html__('Adjust .thz-grid-item-media box style.', 'creatus'),
				'preview' => true,
				'popup' => true,
				'button-text' => esc_html__('Customize media box style', 'creatus'),
				'disable' => array('layout','boxsize','transform','video'),	
				'value' => array(),
			),
			'ib_bs' => array(
				'type' => 'thz-box-style',
				'label' => __('Intro box style', 'creatus'),
				'desc' => esc_html__('Adjust .thz-events-intro box style.', 'creatus'),
				'button-text' => esc_html__('Customize intro box style', 'creatus'),
				'preview' => true,
				'popup' => true,
				'disable' => array('layout','boxsize','transform','video'),
				'value' => array(
					'padding' => array(
						'top' => 45,
						'right' => 45,
						'bottom' => 45,
						'left' => 45
					),	
				)
			),
		)
	),
	'tabtitlesettings' => array(
		'title' => __('Title', 'creatus'),
		'type' => 'tab',
		'options' => array(
			'ti_bs' => array(
				'type' => 'thz-box-style',
				'label' => __('Title box style', 'creatus'),
				'desc' => esc_html__('Adjust .thz-grid-item-title box style', 'creatus'),
				'preview' => true,
				'popup' => true,
				'button-text' => esc_html__('Customize . box style', 'creatus'),
				'disable' => array('layout','boxsize','transform','video'),		
				'value' => array(
					'margin' => array(
						'top' => 0,
						'right' => 0,
						'bottom' => 15,
						'left' => 0
					),
				),
			),
			'timx' => array(
				'type' => 'thz-typography',
				'label' => __('Title metrics', 'creatus'),
				'desc' => esc_html__('Adjust item title metrics.', 'creatus'),
				'value' => array(),
			),
		)
	),
	'tabmetasettings' => array(
		'title' => __('Meta', 'creatus'),
		'type' => 'tab',
		'options' => array(
			'metm' => array(
				'type' => 'thz-box-style',
				'label' => __('Meta box margin', 'creatus'),
				'desc' => esc_html__('Adjust meta box margin', 'creatus'),
				'disable' => array('layout','boxsize','transform','video'),
				'value' => array(
					'padding' => array(
						'top' => 0,
						'right' => 0,
						'bottom' => 15,
						'left' => 0
					),
					'margin' => array(
						'top' => 0,
						'right' => 0,
						'bottom' => 15,
						'left' => 0
					),
					'borders' => array(
						'all' => 'separate',
						'top' => array(
							'w' => '',
							's' => 'solid',
							'c' => ''
						),
						'right' => array(
							'w' => '',
							's' => 'solid',
							'c' => ''
						),
						'bottom' => array(
							'w' => 1,
							's' => 'solid',
							'c' => 'color_4'
						),
						'left' => array(
							'w' => '',
							's' => 'solid',
							'c' => ''
						),
					),
				),
			),
			'metf' => array(
				'type' => 'thz-typography',
				'label' => __('Font settings', 'creatus'),
				'desc' => esc_html__('Adjust meta elements fonts.', 'creatus'),
				'value' => array(
					'size' => '0.93em',
				),
				'disable' => array('hovered','text-shadow'),
			),
		)
	),
	
	'tabintrotxtsettings' => array(
		'title' => __('Intro text', 'creatus'),
		'type' => 'tab',
		'options' => array(
			'show_it' => array(
				'type' => 'multi-picker',
				'label' => false,
				'desc' => false,
				'show_borders' => true,
				'picker' => array(
					'picked' => array(
						'label' => __('Show intro text', 'creatus'),
						'desc' => esc_html__('Show/hide intro text (excerpt)', 'creatus'),
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
						'itl' => array(
							'type' => 'multi-picker',
							'label' => false,
							'desc' => false,
							'picker' => array(
								'picked' => array(
									'label' => __('Intro length limit', 'creatus'),
									'desc' => esc_html__('Set excerpt length limit. No limit displays full post content.', 'creatus'),
									'type' => 'radio',
									'value' => 'chars',
									'choices' => array( 
										'words' => esc_html__('By words', 'creatus'),
										'chars' => esc_html__('By characters', 'creatus'),
										'none' => esc_html__('No limit', 'creatus'),
									),
									'inline' => true,

								)
							),
							'choices' => array(
								'words' => array(
									'limit' => array(
										'type' => 'thz-spinner',
										'label' => __('Number of words', 'creatus'),
										'desc' => esc_html__('Set number of words to show', 'creatus'),
										'addon' => '#',
										'min' => 0,
										'value' => 30
									)
								),
								'chars' => array(
									'limit' => array(
										'type' => 'thz-spinner',
										'label' => __('Number of characters', 'creatus'),
										'desc' => esc_html__('Set number of characters to show', 'creatus'),
										'addon' => '#',
										'min' => 0,
										'value' => 230
									)
								)
							)
						),
						
						'int_bs' => array(
							'type' => 'thz-box-style',
							'label' => __('Intro text box style', 'creatus'),
							'desc' => esc_html__('Adjust Introtext box style.', 'creatus'),
							'preview' => false,
							'popup' => true,
							'disable' => array('layout','borders','borderradius','boxsize','transform','boxshadow','background'),
							'value' => array()
						),
						'int_f' => array(
							'type' => 'thz-typography',
							'label' => __('Intro text font', 'creatus'),
							'desc' => esc_html__('Adjust intro text font metrics.', 'creatus'),
							'value' => array(),
							'disable' => array('hovered','text-shadow'),
						)

					)
				)
			)
		)
	),
	
	'tabbutton' => array(
		'title' => __('Button', 'creatus'),
		'type' => 'tab',
		'options' => array(
			'show_button' => array(
				'type' => 'multi-picker',
				'label' => false,
				'desc' => false,
				'picker' => array(
					'picked' => array(
						'label' => __('Show more button', 'creatus'),
						'desc' => esc_html__('Show or hide more button', 'creatus'),
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
						'cbs' => array(
							'type' => 'thz-box-style',
							'label' => __('Container box style', 'creatus'),
							'preview' => true,
							'button-text' => esc_html__('Customize button container box style', 'creatus'),
							'desc' => esc_html__('Adjust .thz-grid-item-button box style', 'creatus'),
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
						'button' => array(
							'type' => 'thz-button',
							'value' => array(
								'text' => 'Find out more',
								'html' => '<div class="thz-btn-container thz-grid-item-more thz-btn-icon-right thz-btn-icon-hidden thz-mt-20"><a class="thz-button thz-btn-none thz-radius-4 thz-btn-border-1 thz-align-center" href="#"><span class="thz-btn-text thz-vp-0 thz-hp-0 thz-fs-14 thz-fw-600">Find out more<i class="fa fa-angle-right thz-ifw-1 thz-ngv-n1 thz-ngh-n5 thz-fs-14"></i></span></a></div>',
								'buttonText' => 'Find out more',
								'activeColor' 	=> 'none',
								'buttonSizeClass' => 'custom',
								'fontSize' 	=> 14,
								'fontWeight' => 600,
								'buttonIcon' => 'fa fa-angle-right',
								'iconType' => 'inline',
								'iconSize' 	=> 'inherit',
								'iconPosition' 	=> 'right',
								'iconSpace' 	=> 1,
								'iconNudgeH' 	=> -5,
								'iconNudgeV' 	=> -1,
								'paddingX'		=> 0,
								'paddingY'		=> 0,
								'marginTop'		=> 20,
								'customClass'	=> 'thz-grid-item-more',
								'iconOnHover'	=>'on'
							),
							'label' => false,
							'hidelinks' => true
						)
					)
				)
			)
		)
	),
);