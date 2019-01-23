<?php if ( ! defined( 'FW' ) ) die( 'Forbidden' );

$typekithtml ='<h3>';
$typekithtml .= esc_html__('Please visit','creatus');
$typekithtml .=' <a href="https://typekit.com/account/tokens" target="_blank">Typekit API Tokens</a> ';
$typekithtml .= esc_html__('and create new token or use existing one.','creatus');
$typekithtml .='</h3>';


$options = array(
	'tykhtml' => array(
		'label' => false,
		'type'  => 'thz-html',
		'html'  => $typekithtml,
	),
	
	'tyktoken'    => array(
		'type'  => 'text',
		'label' => __( 'API Token', 'creatus' ),
		'desc'  => esc_html__( 'Paste your Typekit API token here', 'creatus' ),
		'attr' => array(
			
			'class' => 'thz-typekit-token thz-typekit-input'
		
		)
	),
	
	'tykids'    => array(
		'type'  => 'addable-option',
		'label' => __( "Project ID's", 'creatus' ),
		'desc'  => esc_html__( "Click the button to add Typekit project ID", 'creatus' ),
		'value' => array(),
		'option' => array( 
			'type' => 'text',
			'attr' => array(
				
				'class' => 'thz-typekit-id thz-typekit-input'
			
			)
		),
		'add-button-text' => __('Click to add Project ID', 'creatus'),
		'sortable' => false,
	),
	
	'tykfonts' => array(
		'label' => false,
		'type' 	=> 'thz-import-fonts',
		'value' => array(),
		'provider' => 'typekit',
		
	),
);