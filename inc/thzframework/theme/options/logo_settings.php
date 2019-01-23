<?php
if (!defined('FW'))
	die('Forbidden');

$options = array(
	
	'site_logo' => array(
		'label' => false,
		'type' => 'thz-logo',
		'value' => array(
			'type'=>'svg',
			'image' => array(),
			'darksections' => array(),
			'lightsections' => array(),
			'sticky' => array(),
			'mobile' => array(),
			'svgimg' => array(),
			'text'=> 'creatus',
			'f'=> array(
				'family'  		=> 'Creatus',
				'weight'     	=> '500',
				'subset'    	=> 'ffk',
				'transform' 	=> 'default',
				'align'     	=> 'default',
				'size' 			=> 20,
				'line-height' 	=> 1,
				'spacing' 		=> '0.3px',
				'color' 		=> 'color_2',
				'text-shadow' 	=> array()					
			),
			'sub-text'=> '',
			'sub-f'=> array(
				'family'  		=> 'Creatus',
				'weight'     	=> '400',
				'subset'    	=> 'ffk',
				'transform' 	=> 'uppercase',
				'align'     	=> 'default',
				'size' 			=> 10,
				'line-height' 	=> 1.2,
				'spacing'		=> 0,
				'color' 		=> 'color_3',
				'text-shadow' 	=> array()				
			),
			'sc'=> array(
				't'=> '',
				's'=> '',
			),
			'mc'=> array(
				't'=> '',
				's'=> '',
			),
			'ds'=> array(
				't'=> '',
				's'=> '',
			),
			'ls'=> array(
				't'=> '',
				's'=> '',
			),
			'svg'=> array(
				'd'=> '',
				'ds'=> '',
				'ls'=> '',
				's'=> '',
				'm'=> '',
				'a'=> 'fill',
			),
			'width'=> 80,
			'height'=> 80,
			'mwidth'=> 80,
			'mheight'=> 80,
			'boxstyle'=>array(
				'margin' => array(
					'top' => '0',
					'right' => 'auto',
					'bottom' => '0',
					'left' => 'auto'
				),			
			),
		),
	),

);