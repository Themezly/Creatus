<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$cfg = array();

$cfg['page_builder'] = array(
	'title'       => esc_html__( 'Slider', 'creatus' ),
	'description' => esc_html__( 'Add a Slider', 'creatus' ),
	'tab'         => esc_html__( 'Media Elements', 'creatus' ),
	'popup_size'  => 'large',
	'icon' => 'thzadmin thzadmin-shortcode_slider'
);
