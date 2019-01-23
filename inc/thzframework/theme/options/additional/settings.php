<?php if ( ! defined( 'FW' ) ) die( 'Forbidden' );

$options = array(
	'overlayoptionstab' => array(
		'title' => __('Media overlay', 'creatus'),
		'type' => 'tab',
		'lazy_tabs'=> false,
		'options' => array(
			fw()->theme->get_options('additional/overlay'),
			fw()->theme->get_options('additional/custom_overlay'),
		)
	),
	'lightboxoptionstab' => array(
		'title' => __('Lightbox', 'creatus'),
		'type' => 'tab',
		'lazy_tabs'=> false,
		'options' => array(
			fw()->theme->get_options('additional/lightbox')
		)
	),
	'navigationsstab' => array(
		'title' => __('Navigations', 'creatus'),
		'type' => 'tab',
		'lazy_tabs'=> false,
		'options' => array(
			fw()->theme->get_options('additional/navigations_tab')
		)
	),
	thz_theme()->get_options( 'site_offline_tab' ), 
	'miscoptionstab' => array(
		'title'   => __( 'Miscellaneous', 'creatus' ),
		'type'    => 'tab',
		'lazy_tabs'=> false,
		'options' => array(
			fw()->theme->get_options('additional/miscellaneous'),
		),
	),
);