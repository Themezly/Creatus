<?php
if (!defined('FW')) {
	die('Forbidden');
}
$options = apply_filters('thz_filter_pagetemplates_404', array(

	'etitle'    => array(
		'type'  => 'text',
		'value' => '',
		'label' => __( 'Title', 'creatus' ),
		'desc'  => esc_html__( '404 page title. Theme default is used if empty', 'creatus' ),
	),
	
	'esub'    => array(
		'type'  => 'text',
		'value' => '',
		'label' => __( 'Sub title', 'creatus' ),
		'desc'  => esc_html__( '404 page sub title. Theme default is used if empty', 'creatus' ),
	),
	
	'etext'    => array(
		'type'  => 'textarea',
		'value' => '',
		'label' => __( 'Text', 'creatus' ),
		'desc'  => esc_html__( '404 page text. Theme default is used if empty', 'creatus' ),
	),
	

	
	'etitlef' => array(
		'type' => 'thz-typography',
		'label' => __('Title font metrics', 'creatus'),
		'desc' => esc_html__('Adjust 404 page title font metrics.', 'creatus'),
		'value' => array(
			'size' => 200,
			'weight' => 600,
		),
		'disable' => array('family','line-height','hovered','align'),
		'sizelimit' => 500,
		'cssclasses' => true,
		'cssprint' => false,
	),
	
	'esubf' => array(
		'type' => 'thz-typography',
		'label' => __('Sub title font metrics', 'creatus'),
		'desc' => esc_html__('Adjust 404 page sub title font metrics.', 'creatus'),
		'value' => array(
			'size' => 50,
		),
		'disable' => array('family','line-height','hovered','align'),
		'sizelimit' => 500,
		'cssclasses' => true,
		'cssprint' => false,
	),
	
	
	'etextf' => array(
		'type' => 'thz-typography',
		'label' => __('Text font metrics', 'creatus'),
		'desc' => esc_html__('Adjust 404 page text font metrics.', 'creatus'),
		'value' => array(
			'size' => 16,
		),
		'disable' => array('family','line-height','hovered','align','text-shadow'),
		'sizelimit' => 500,
		'cssclasses' => true,
		'cssprint' => false,
	),
	
	
	'ebutton' => array(
		'type' => 'popup',
		'size' => 'large',
		'label' => __('Back button', 'creatus'),
		'button' => esc_html__('Edit back button', 'creatus'),
		'desc' => esc_html__('Adjust 404 page back to homepage button.', 'creatus'),
		'popup-title' => esc_html__('Back button settings', 'creatus'),
		'popup-options' => array(
			'button' => array(
				'type' => 'thz-button',
				'value' => array(
					'buttonText' => 'Back to homepage',
					'activeColor' => 'white',
					'buttonSizeClass' => 'medium',
					'fontSize' => 16,
					'fontWeight' => 600,
					'buttonIcon' => 'thzicon thzicon-arrow-left5',
					'iconType' => 'inline',
					'iconSize' 	=> 'inherit',
					'iconPosition' 	=> 'left',
					'iconSpace' 	=> 8,
					'iconNudgeV' 	=> -1,
					'marginTop' 	=> 50,
					'html' => '<div class="thz-btn-container thz-btn-icon-left thz-btn-icon-hidden thz-mt-50 thz-btn-flat"><a class="thz-button thz-btn-white thz-btn-medium thz-radius-36 thz-align-center thz-boxshadow-down-01" href="#"><span class="thz-btn-text thz-fs-16 thz-fw-600"><i class="thzicon thzicon-arrow-left5 thz-ifw-8 thz-ngv-n1 thz-fs-16"></i>Back to homepage</span></a></div>'
				),
				'label' => false,
				'hidelinks' => true
			)
		)
	),
	
));