<?php if ( ! defined( 'FW' ) ) die( 'Forbidden' );

$options = array(

	'med_over' => array(
		'type' => 'thz-hover',
		'value' => array(
			'background' => array(
				'type' =>'gradient',
				'gradient' =>'radial',
				'color1' =>'rgba(0,0,0,0.1)',
				'color2' =>'rgba(0,0,0,0.8)',
			),
			'oeffect' => 'thz-hover-fadein',
			'oduration' => 'thz-transease-04',
			'ieffect' => 'thz-img-zoomin',
			'iduration' => 'thz-transease-04',
			'iceffect' => 'thz-comein-bottom',
			'icduration' => 'thz-transease-05'
		),
		'labels' => array(
			'background' => esc_html__('Media overlay background', 'creatus'),
			'overlay' => esc_html__('Media overlay effect', 'creatus'),
			'image' => esc_html__('Media image effect', 'creatus'),
			'icons' => esc_html__('Overlay element effect', 'creatus')
		),
		'descriptions' => array(
			'background' => esc_html__('Set media overlay background', 'creatus'),
			'overlay' => esc_html__('Select media overlay hover effect and duration', 'creatus'),
			'image' => esc_html__('Select media image hover effect and duration', 'creatus'),
			'icons' => esc_html__('Select media overlay element hover effect and duration', 'creatus')
		),
		'label' => false,
		'desc' => false
	),
);