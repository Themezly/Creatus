<?php if ( ! defined( 'FW' ) ) die( 'Forbidden' );

$options = array(
	'searchoptionstab' => array(
		'title'   => __( 'Search', 'creatus' ),
		'type'    => 'tab',
		'lazy_tabs'=> false,
		'options' => array(
			fw()->theme->get_options( 'pagetemplates/search' ),
		),
	),
	'fourofouroptionstab' => array(
		'title'   => __( '404', 'creatus' ),
		'type'    => 'tab',
		'lazy_tabs'=> false,
		'options' => array(
			fw()->theme->get_options( 'pagetemplates/404' ),
		),
	),
	'authoroptionstab' => array(
		'title'   => __( 'Author', 'creatus' ),
		'type'    => 'tab',
		'lazy_tabs'=> false,
		'options' => array(
			fw()->theme->get_options( 'pagetemplates/author' ),
		),
	),
);