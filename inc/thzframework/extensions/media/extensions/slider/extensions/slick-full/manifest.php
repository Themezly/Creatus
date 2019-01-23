<?php
if ( !defined( 'ABSPATH' ) ) {
	die( 'Direct access forbidden.' );
}
$manifest = array();
$manifest['name']        = esc_html__( 'Slick Slider', 'creatus' );
$manifest['description'] = esc_html__( 'Slick Slider', 'creatus' );
$manifest['version'] = '1.0.0';
$manifest['display'] = 'slider';
$manifest['standalone'] = true;