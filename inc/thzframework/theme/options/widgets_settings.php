<?php
if (!defined('ABSPATH')) {
	die('Direct access forbidden.');
}
$options = array(
	'wi_bs' => array(
		'type' => 'thz-box-style',
		'label' => __('Widget box style', 'creatus'),
		'preview' => true,
		'button-text' => esc_html__('Customize widget box style', 'creatus'),
		'desc' => esc_html__('Adjust .thz-sidebars .widget box style', 'creatus'),
		'popup' => true,
		'disable' => array('layout','video','boxsize','transform'),
		'value' => array(
			'margin' => array(
				'top' => '0',
				'right' => 0,
				'bottom' => 60,
				'left' => 0
			),
		)
	),
	'wi_tbs' => array(
		'type' => 'thz-box-style',
		'label' => __('Widget title box style', 'creatus'),
		'preview' => true,
		'button-text' => esc_html__('Customize widget title box style', 'creatus'),
		'desc' => esc_html__('Adjust .thz-sidebars .widget-title box style', 'creatus'),
		'disable' => array(
			'video'
		),
		'disable' => array('layout','video','boxsize','transform'),
		'popup' => true,
		'value' => array(
			'padding' => array(
				'top' => '0',
				'right' => 0,
				'bottom' => 30,
				'left' => 0
			),
			'margin' => array(
				'top' => '0',
				'right' => 0,
				'bottom' => 0,
				'left' => 0
			),
		)
	),
	'wi_title' => array(
		'type' => 'thz-typography',
		'label' => __('Widget title metrics', 'creatus'),
		'desc' => esc_html__('Adjust widget title metrics.', 'creatus'),
		'value' => array(
			'size' => '14',
			'weight' => 600,
			'transform' => 'uppercase',
		),
		'disable' => array('hovered'),
	),
	'wi_metrics' => array(
		'type' => 'thz-multi-options',
		'label' => __('Widgets metrics', 'creatus'),
		'desc' => esc_html__('Adjust widgets metrics. Theme colors are inherited if empty.', 'creatus'),
		'help' => esc_html__('Li top , Li bottom and Lists border color, adjust the top and bottom padding for list items(.thz-has-list li a) and their border color.', 'creatus'),
		'value' => array(
			'tx' => '',
			'he' => '',
			'li' => '',
			'lih' => '',
			'set' => '',
			'seb' => '',
			'sep' => '',
		),
		'breakafter' =>array('lih'),
		'thz_options' => array(
			'tx' => array(
				'type' => 'color',
				'title' => esc_html__('Text', 'creatus'),
				'box' => true
			),
			'he' => array(
				'type' => 'color',
				'title' => esc_html__('Headings', 'creatus'),
				'box' => true
			),
			'li' => array(
				'type' => 'color',
				'title' => esc_html__('Link', 'creatus'),
				'box' => true
			),
			'lih' => array(
				'type' => 'color',
				'title' => esc_html__('Hovered link', 'creatus'),
				'box' => true
			),
			'set' => array(
				'type' => 'spinner',
				'title' => esc_html__('li top', 'creatus'),
				'addon' => 'px',
				'min' => 0,
				'step' => 0.1,
				'attr' => array(
					'placeholder' => 7.5
				),
			),
			'seb' => array(
				'type' => 'spinner',
				'title' => esc_html__('li bottom', 'creatus'),
				'addon' => 'px',
				'min' => 0,
				'step' => 0.1,
				'attr' => array(
					'placeholder' => 7.5
				),
			),
			'sep' => array(
				'type' => 'color',
				'title' => esc_html__('List items border', 'creatus'),
				'box' => true
			)
		)
	),
	
	'wi_tagbs' => array(
		'type' => 'thz-box-style',
		'label' => __('Tags box style', 'creatus'),
		'preview' => true,
		'button-text' => esc_html__('Customize tag items box style', 'creatus'),
		'desc' => esc_html__('Adjust .tagcloud a (Tag Cloud widget item) box style.', 'creatus'),
		'popup' => true,
		'disable' => array('layout','video','boxsize','transform'),
		'value' => array(
			'padding' => array(
				'top' => '5',
				'right' => 5,
				'bottom' => 5,
				'left' => 5
			),
			'margin' => array(
				'top' => '0',
				'right' => 5,
				'bottom' => 5,
				'left' => 0
			),
			'borders' => array(
				'all'=> 'same',			
				'top'=> array(
					'w' => '1',
					's' => 'solid',
					'c' => 'color_4'
				),
				'right'=> array(
					'w' => '',
					's' => 'solid',
					'c' => ''
				),
				'bottom'=> array(
					'w' => '',
					's' => 'solid',
					'c' => ''
				),
				'left'=> array(
					'w' => '',
					's' => 'solid',
					'c' => ''
				)
			),
			'borderradius' => array(
				'top-left' => '4',
				'top-right' => '4',
				'bottom-right' => '4',
				'bottom-left' => '4',
			),
		),
		'units' => array(
			'borderradius',
			'padding',
			'margin',
		),
	),
		
	'wi_tagfm' => array(
		'type' => 'thz-typography',
		'label' => __('Tags font metrics', 'creatus'),
		'desc' => esc_html__('Adjust tag items font metrics.', 'creatus'),
		'value' => array(
			'size' => '10',
			'weight' => 600,
			'transform' => 'uppercase',
		),
	),
	
);

if( isset($wi_bs) && $wi_bs == false){
	
	unset($options['wi_bs']);
	
}