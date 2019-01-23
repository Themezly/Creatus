<?php
if (!defined('FW'))
	die('Forbidden');
$options = array(
	'thzeladd' => array(
		'type' => 'addable-popup',
		'value' => array(
			array(
				'classes' => 'input[type="text"],input[type="number"],input[type="search"],input[type="password"],input[type="email"],input[type="tel"],input[type="url"],input[type="datetime"],input[type="date"],input[type="datetime-local"],input[type="month"],input[type="week"],input[type="time"],select,textarea,.select2-container .select2-choice,#bbp_topic_content,#bbp_reply_content,.thz-site-html .select2-drop-active,.thz-site-html .select2-selection--single,.thz-site-html .woocommerce-page input.select2-search__field,.thz-site-html .select2-dropdown,fieldset',
				'thzelf' => array(),
				'thzelm' => array(
					'padding' => array(
						'top' => '10',
						'right' => '15',
						'bottom' => '10',
						'left' => '15'
					),
					'borders' => array(
						'all' => 'same',
						'top' => array(
							'w' => '1',
							's' => 'solid',
							'c' => 'rgba(0,0,0,0)'
						),
					),
					'borderradius' => array(
						'top-left' => '4',
						'top-right' => '4',
						'bottom-left' => '4',
						'bottom-right' => '4'
					),
					
					'background' => array(
						'type' => 'color',
						'color' => 'color_5',
					),
				),
				'thzelch' => array(
					'bg' => '#ffffff',
					'color' => 'color_2',
					'bcolor' => 'color_4'
				),
				'thzelcf' => array(
					'bg' => '#ffffff',
					'color' => 'color_2',
					'bcolor' => 'color_4'
				)
			),
			
			array(
				'classes' => 'fieldset',
				'thzelf' => array(),
				'thzelm' => array(
					'borders' => array(
						'all' => 'same',
						'top' => array(
							'w' => '1',
							's' => 'solid',
							'c' => 'color_4'
						),
					),
					'background' => array(
						'type' => 'color',
						'color' => '#ffffff',
					),
				),
				'thzelch' => array(
					'bg' => '#ffffff',
					'color' => 'color_2',
					'bcolor' => 'color_4'
				),
				'thzelcf' => array(
					'bg' => '#ffffff',
					'color' => 'color_2',
					'bcolor' => 'color_4'
				)
			),
			array(
				'classes' => 'input[type="button"],input[type="submit"],input[type="reset"],input[type="file"],form button,.button',
				'thzelf' => array(
					'family' => 'Creatus',
					'weight' => 500,
					'subset' => 'ffk',
					'size' => '13',
					'spacing' => '0.5px',
				),
				'thzelm' => array(
					'padding' => array(
						'top' => '10',
						'right' => '15',
						'bottom' => '10',
						'left' => '15'
					),
					'borderradius' => array(
						'top-left' => '4',
						'top-right' => '4',
						'bottom-left' => '4',
						'bottom-right' => '4'
					),
					'background' => array(
						'type' => 'color',
						'color' => 'color_2',
					)
				),
				'thzelco' =>'#ffffff',
				'thzelch' => array(
					'bg' => 'color_1',
					'color' => '#ffffff',
					'bcolor' => ''
				),
				'thzelcf' => array(
					'bg' => '',
					'color' => '',
					'bcolor' => ''
				)
			)
		),
		'label' => __('Page elements styles', 'creatus'),
		'desc' => esc_html__('Click to add page element style.', 'creatus'),
		'template' => '{{- classes }}',
		'popup-title' => esc_html__('Customize your elements', 'creatus'),
		'size' => 'large',
		'sortable' => true,
		'popup-options' => array(
			'defautlstab' => array(
				'title' => __('Defaults', 'creatus'),
				'type' => 'tab',
				'options' => array(
					'classes' => array(
						'label' => __('Element names', 'creatus'),
						'type' => 'textarea',
						'value' => '',
						'desc' => esc_html__('Insert element class or ID names separated by comma.eg: .checkout-button,.cart_button', 'creatus')
					),
					
					'thzelf' => array(
						'type' => 'thz-typography',
						'label' => __('Element typography', 'creatus'),
						'value' => array(),
						'disable' => array('color','hovered'),
						'desc' => esc_html__('Adjust element typography', 'creatus'),
					),
				)
			),
			'styletab' => array(
				'title' => __('Style', 'creatus'),
				'type' => 'tab',
				'options' => array(
					'thzelm' => array(
						'type' => 'thz-box-style',
						'label' => __('Element box style', 'creatus'),
						'preview' => true,
						'disable' => array('video'),
						'units' => array(
							'padding' ,
							'margin' ,
							'borderradius',
							'boxsize' ,
						),
						'popup' => false,
						'value' => array()
					),
					
					'thzelco' => array(
						'type' => 'thz-color-picker',
						'value' => '',
						'label' => __('Element color', 'creatus'),
						'desc' => esc_html__('Set element text color', 'creatus')
					),
					
					'thzelch' => array(
						'type' => 'thz-multi-options',
						'label' => __('Element hover colors', 'creatus'),
						'desc' => esc_html__('Adjust element:hover colors', 'creatus'),
						'value' => array(
							'bg' => '',
							'color' => '',
							'bcolor' => ''
						),
						'thz_options' => array(
							'bg' => array(
								'type' => 'color',
								'title' => esc_html__('Background', 'creatus'),
								'box' => true
							),
							'color' => array(
								'type' => 'color',
								'title' => esc_html__('Text color', 'creatus'),
								'box' => true
							),
							'bcolor' => array(
								'type' => 'color',
								'title' => esc_html__('Border color', 'creatus'),
								'box' => true
							)
						)
					),
					'thzelcf' => array(
						'type' => 'thz-multi-options',
						'label' => __('Element focus colors', 'creatus'),
						'desc' => esc_html__('Adjust element:focus colors', 'creatus'),
						'value' => array(
							'bg' => '',
							'color' => '',
							'bcolor' => ''
						),
						'thz_options' => array(
							'bg' => array(
								'type' => 'color',
								'title' => esc_html__('Background', 'creatus'),
								'box' => true
							),
							'color' => array(
								'type' => 'color',
								'title' => esc_html__('Text color', 'creatus'),
								'box' => true
							),
							'bcolor' => array(
								'type' => 'color',
								'title' => esc_html__('Border color', 'creatus'),
								'box' => true
							)
						)
					)
				)
			)
		)
	),
	
	'thzbelsp' => array(
		'type' => 'thz-multi-options',
		'label' => __('Block elements space', 'creatus'),
		'desc' => esc_html__('Adjust space between HTML block elements. See help for more info.', 'creatus'),
		'help' => sprintf( esc_html__('HTML block elements like headings, paragraphs, tables, blockquotes, forms, fieldsets, lists or any theme defined block element need a vertical space ( top margin ) between each other. This option set will help you define the global space between%1$s *( any element ) + next block element%1$sheading + *( any ) element after.%1$sSimple example; 30px between elements and 15px between heading and first element after.%1$sNOTE this setting will NOT set the default space between two div or any hr elements.', 'creatus'),'<br /><br />'),
		'value' => array(
			'ae' => 30,
			'ha' => 15,
		),
		'thz_options' => array(
			'ae' => array(
				'type' => 'spinner',
				'title' => esc_html__('Element + element', 'creatus'),
				'addon' => 'px',
				'min' => 0,
				'step' => 0.05,
				'units' => array('px','em','rem','%')
			),
			'ha' => array(
				'type' => 'spinner',
				'title' => esc_html__('Heading + element', 'creatus'),
				'addon' => 'px',
				'min' => 0,
				'step' => 0.05,
				'units' => array('px','em','rem','%')
			)
		)
	),
);