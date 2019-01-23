<?php if ( ! defined( 'FW' ) ) die( 'Forbidden' );

$gminf ='<h3>';
$gminf .= esc_html__('To obtain Google Maps API key please visit','creatus');
$gminf .=' <a href="https://developers.google.com/maps/documentation/javascript/get-api-key" target="_blank">https://developers.google.com</a> ';
$gminf .= esc_html__('and create new project.','creatus');
$gminf .='</h3>';


$twinf ='<h3>';
$twinf .= esc_html__('To obtain Twitter API keys please visit','creatus');
$twinf .=' <a href="https://dev.twitter.com/apps" target="_blank">https://dev.twitter.com/apps</a> ';
$twinf .= esc_html__('and create new application.','creatus');
$twinf .='</h3>';

$options = array(
	'gminf' => array(
		'label' => false,
		'type'  => 'thz-html',
		'html'  => $gminf,
	),
	'gmapapi' => array(
    	'type' => 'gmap-key',
		'label' => __('Google Maps Key', 'creatus'),
		'desc' => esc_html__('Paste your Google Maps API key here', 'creatus'),
	),	
	'twinf' => array(
		'label' => false,
		'type'  => 'thz-html',
		'html'  => $twinf,
	),	
	'twck'    => array(
		'type'  => 'text',
		'label' => __( 'Consumer key', 'creatus' ),
		'desc'  => esc_html__( 'Paste your Twitter application consumer key here', 'creatus' ),
	),
	
	'twcs'    => array(
		'type'  => 'text',
		'label' => __( 'Consumer secret', 'creatus' ),
		'desc'  => esc_html__( 'Paste your Twitter application consumer secret here', 'creatus' ),
	),
	
	'twat'    => array(
		'type'  => 'text',
		'label' => __( 'Access token', 'creatus' ),
		'desc'  => esc_html__( 'Paste your Twitter access token here', 'creatus' ),
	),
	'twts'    => array(
		'type'  => 'text',
		'label' => __( 'Access token secret', 'creatus' ),
		'desc'  => esc_html__( 'Paste your Twitter access token secret here', 'creatus' ),
	)
);