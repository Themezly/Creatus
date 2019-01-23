<?php if ( ! defined( 'FW' ) ) die( 'Forbidden' );

$fontsquirrelhtml ='<h3>';
$fontsquirrelhtml .= esc_html__('Click on download icon to get the font. After the download font will be available in every typography option.','creatus');
$fontsquirrelhtml .='</h3>';

$options = array(
	'fsqhtml' => array(
		'label' => false,
		'type'  => 'thz-html',
		'html'  => $fontsquirrelhtml,
	),
	
	'fsqfonts' => array(
		'label' => false,
		'type' 	=> 'thz-import-fonts',
		'value' => array(),
		'provider' => 'fontsquirrel',
	),
);