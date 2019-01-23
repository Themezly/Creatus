<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$cfg = array();

$cfg['image_sizes'] = array(
	'featured-image' => array(
		'width'  => 980,
		'height' => 640,
		'crop'   => true
	),
	'gallery-image'  => array(
		'width'  => 700,
		'height' => 455,
		'crop'   => true
	)
);

$cfg['has-gallery'] = true;