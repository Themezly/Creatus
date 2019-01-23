<?php if ( ! defined( 'FW' ) ) die( 'Forbidden' );
	
$options = array(
	'body_font' => array(
		'label' => __('Body font', 'creatus'),
		'type' => 'thz-typography',
		'value' => array(
			'family'  		=> 'Open Sans Creatus',
			'weight'     	=> 'regular',
			'subset'    	=> 'ffk',
			'size' 			=> '14',
			'line-height' 	=> 1.8,
			'color' 		=> '#757575',
		),
		'disable' => array('hovered','text-shadow'),
		'desc' => esc_html__('Body font color family and metrics', 'creatus')
	),

	'sitelc' => array(
		'type' => 'thz-multi-options',
		'label' => __('Site colors', 'creatus'),
		'desc' => esc_html__('Adjust site colors', 'creatus'),
		'value' => array(
			'lc' => 'color_2',
			'lh' => 'color_1'
		),
		'thz_options' => array(
			'lc' => array(
				'type' => 'color',
				'title' => esc_html__('Link', 'creatus'),
				'box' => true
			),
			'lh' => array(
				'type' => 'color',
				'title' => esc_html__('Link hovered', 'creatus'),
				'box' => true
			)
		)
	),
	'headings_font' => array(
		'label' => __('Headings font-family', 'creatus'),
		'type' => 'thz-typography',
		'value' => array(
			'family'  		=> 'Creatus',
			'weight'     	=> '500',
			'subset'    	=> 'ffk',
			'transform' 	=> 'default',
		),
		'disable' => array('size','line-height','spacing','align','color','hovered','text-shadow'),
		'desc' => esc_html__('H1, H2, H3, H4, H5 & H6 font-family.', 'creatus')
	),
	'h1_font' => array(
		'label' => __('H1 font metrics', 'creatus'),
		'type' => 'thz-typography',
		'value' => array(
			'size' => 36,
			'line-height' => 1.1,
			'color' => 'color_2'
		),
		'disable' => array('family','weight','style','transform','align','hovered','text-shadow'),
	),
	'h2_font' => array(
		'label' => __('H2 font metrics', 'creatus'),
		'type' => 'thz-typography',
		'value' => array(
			'size' => 30,
			'line-height' => 1.1,
			'color' => 'color_2'
		),
		'disable' => array('family','weight','style','transform','align','hovered','text-shadow'),
	),
	'h3_font' => array(
		'label' => __('H3 font metrics', 'creatus'),
		'type' => 'thz-typography',
		'value' => array(
			'size' => 24,
			'line-height' => 1.1,
			'color' => 'color_2'
		),
		'disable' => array('family','weight','style','transform','align','hovered','text-shadow'),
	),
	'h4_font' => array(
		'label' => __('H4 font metrics', 'creatus'),
		'type' => 'thz-typography',
		'value' => array(
			'size' => 18,
			'line-height' => 1.1,
			'color' => 'color_2'
		),
		'disable' => array('family','weight','style','transform','align','hovered','text-shadow'),
	),
	'h5_font' => array(
		'label' => __('H5 font metrics', 'creatus'),
		'type' => 'thz-typography',
		'value' => array(
			'size' => 16,
			'line-height' => 1.1,
			'color' => 'color_2'
		),
		'disable' => array('family','weight','style','transform','align','hovered','text-shadow'),
	),
	'h6_font' => array(
		'label' => __('H6 font metrics', 'creatus'),
		'type' => 'thz-typography',
		'value' => array(
			'size' => 14,
			'line-height' => 1.1,
			'color' => 'color_2'
		),
		'disable' => array('family','weight','style','transform','align','hovered','text-shadow'),
	),
	
	'floader' => array(
		'type' => 'addable-popup',
		'value' => array(),
		'label' => __('Font loader', 'creatus'),
		'desc'  => esc_html__('Use this option to load additional font weights and styles.', 'creatus'),
		'template' => esc_html__('Additional fonts are loaded','creatus'),
		'popup-title' => null,
		'size' => 'medium', 
		'limit' => 1,
		'add-button-text' => esc_html__('Add addtional font', 'creatus'),
		'sortable' => false,
		'popup-options' => array(
			'l' => array(
				'type' => 'addable-popup',
				'value' => array(),
				'label' => __('Font', 'creatus'),
				'desc'  => esc_html__('Load additional font.', 'creatus'),
				'template' => '{{= f.family }}, {{= f.weight }}, {{= f.subset }}',
				'popup-title' => null,
				'size' => 'medium', 
				'add-button-text' => esc_html__('Click to add/edit font', 'creatus'),
				'popup-options' => array(
					'f' => array(
						'label' => false,
						'type' => 'thz-typography',
						'value' => array(
							'family'  		=> 'Open Sans',
							'weight'     	=> 'regular',
							'subset'    	=> 'latin',
						),
						'disable' => array('size','line-height','spacing','transform','align','color','hovered','text-shadow'),
						'desc' => esc_html__('Select additional font.', 'creatus')
					),
				),
			),				
		),
	),
);