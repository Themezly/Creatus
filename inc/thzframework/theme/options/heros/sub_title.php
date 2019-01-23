<?php
if (!defined('FW'))
	die('Forbidden');
	
$pageoptions = isset($pageoptions) ? $pageoptions : false;	

$options = array(

	'hpt_sbs' => array(
		'type' => 'thz-box-style',
		'label' => __('Sub box style', 'creatus'),
		'preview' => true,
		'popup' => true,
		'button-text' => esc_html__('Customize sub title box style', 'creatus'),
		'desc' => esc_html__('Adjust .thz-hero-post-title-sub box style','creatus'),
		'disable' => array('video'),
		'value' => array(
			'margin' => array(
				'top' => 10,
				'right' => 0,
				'bottom' => 10,
				'left' => 0
			),
		)
	),
	
	'hpt_sf' => array(
		'label' => __('Sub title font', 'creatus'),
		'type' => 'thz-typography',
		'value' => array(
			'size' 			=> 16,
			'spacing'		=>'normal',
		),
		'disable' => array('color','hovered'),
		'desc' => esc_html__('Adjust sub title font family and metrics.', 'creatus')
	),
	
	'hpt_sm' => array(
		'type' => 'thz-multi-options',
		'label' => __('Sub title colors', 'creatus'),
		'desc' => esc_html__('Adjust sub title font colors. If empty, colors are inherited from theme.', 'creatus'),
		'value' => array(
			'mode' =>'elements',
			'text' => '',
			'headings' => '',
			'link' => '',
			'hover' => '',
			'sep' =>'',
		),
		'thz_options' => array(
			
			'mode' => array(
				'type' => 'short-select',
				'title' => esc_html__('Mode', 'creatus'),
				'attr' => array(
					'class' => 'thz-select-switch'
				),
				'choices' => array(
					'elements' =>array(
						'text' =>  esc_html__('Elements', 'creatus'),
						'attr' => array(
							'data-enable' => 'hpt_se,hps_sep',
							'data-disable' => 'hpt_stx',
						)
					),
					'custom' =>array(
						'text' =>  esc_html__('Custom content', 'creatus'),
						'attr' => array(
							'data-enable' => 'hpt_stx',
							'data-disable' => 'hpt_se,hps_sep',
						)
					),
		
				),
			),			
			
			'text' => array(
				'type' => 'color',
				'title' => esc_html__('Text', 'creatus'),
				'box' => true
			),
			'headings' => array(
				'type' => 'color',
				'title' => esc_html__('Headings', 'creatus'),
				'box' => true
			),
						
			'link' => array(
				'type' => 'color',
				'title' => esc_html__('Link', 'creatus'),
				'box' => true
			),
			
			'hover' => array(
				'type' => 'color',
				'title' => esc_html__('Hovered link', 'creatus'),
				'box' => true
			),
			'sep' => array(
				'type' => 'color',
				'title' => esc_html__('Separator', 'creatus'),
				'box' => true
			),
		)
	),
	
	'hpt_stx' => array(
		'type' => 'wp-editor',
		'label' => __('Subtitle content', 'creatus'),
		'desc' => esc_html__('Enter sub title content', 'creatus'),
		'size' => 'large',
		'editor_height' => 150,
		'shortcodes' => true,
		'editor_type' => 'tinymce',
		'wpautop' => true,
		'value' => 'I am custom sub title. Praesent ut accumsan est. Lorem ipsum dolor sit amet.'
	),
		
	'hpt_se' => array(
		'type' => 'thz-sortable-checks',
		'value' => array(
			'date',
			'categories',
			'author',
		),
		'label' => __('Sub title elements', 'creatus'),
		'desc' => esc_html__('Check to show/hide specific elements. Click and drag the label to sort.', 'creatus'),
		'choices' => array(
			'date' => esc_html__('Date', 'creatus'),
			'categories' => esc_html__('Categories', 'creatus'),
			'author' => esc_html__('Author', 'creatus'),
		),
	),
	
	'hps_sep' => array(
		'type' => 'thz-multi-options',
		'label' => __('Elements separator', 'creatus'),
		'desc' => esc_html__('Select separator type. See help for more info', 'creatus'),
		'help' => esc_html__('This option will let you adjust space between separator and elements. Nudge option can help you align the separator verticaly. This can come in handy if separator is icon and icon font does not place the icon in absolute vertical middle. Nudge moves relative top position of the separator.', 'creatus'),
		'value' => array(
			'ty' => 'textual',
			't' => '|',
			'i' => 'thzicon thzicon-primitive-dot',
			'fs' => '',
			's' => 10,
			'n' => 0,
		),
		'thz_options' => array(
			'ty' => array(
				'title' => esc_html__('Type', 'creatus'),
				'type' => 'short-select',
				'attr' => array(
					'class' => 'thz-select-switch'
				),
				'choices' => array(
					'textual' => array(
						'text' => esc_html__('Textual', 'creatus'),
						'attr' => array(
							'data-enable' => '.pt_sep-text-parent',
							'data-disable' => '.pt_sep-icon-parent',
							
						)
					),
					'icon' => array(
						'text' => esc_html__('Icon', 'creatus'),
						'attr' => array(
							'data-enable' => '.pt_sep-icon-parent',
							'data-disable' => '.pt_sep-text-parent',
							
						)
					),
				)
			),
			't' => array(
				'type' => 'short-text',
				'title' => esc_html__('Separator', 'creatus'),
				'attr' => array(
					'class' => 'pt_sep-text'
				),
			),
			'i' => array(
				'type' => 'icon',
				'title' => esc_html__('Icon', 'creatus'),
				'attr' => array(
					'class' => 'pt_sep-icon'
				),
			),
			'fs' => array(
				'type' => 'spinner',
				'title' => esc_html__('Size', 'creatus'),
				'addon' => 'px',
				'min' => 0,
				'max' => 100
			),
			's' => array(
				'type' => 'spinner',
				'title' => esc_html__('Space', 'creatus'),
				'addon' => 'px',
				'max' => 100,
			),
			'n' => array(
				'type' => 'spinner',
				'title' => esc_html__('Nudge icon', 'creatus'),
				'addon' => 'px',
				'min' => -20,
				'max' => 20,
			),

		)
	),
);

if($pageoptions){	

	$options['hpt_sm']['label'] =  __('Sub title metrics', 'creatus');
	$options['hpt_sm']['desc'] 	= esc_html__('Choose sub title mode and adjust font colors. If colors are empty, they will be inherited from theme.', 'creatus');
}
	

if(!$pageoptions){

	unset($options['hpt_sm']['value']['mode'],$options['hpt_sm']['thz_options']['mode'],$options['hpt_stx']);
	
}