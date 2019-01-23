<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$cfg = array();

$cfg['page_builder'] = array(
	'title'       	=> esc_html__( 'Contact form', 'creatus' ),
	'description' 	=> esc_html__( 'Add a Contact Form', 'creatus' ),
	'tab'         	=> esc_html__( 'Content Elements', 'creatus' ),
	'popup_size'  	=> 'large',
	'type'        	=> 'special',
 	'icon'			=> 'thzadmin thzadmin-shortcode_contact_form'
);