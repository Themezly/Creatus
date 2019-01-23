<?php
if (!defined('FW')) {
	die('Forbidden');
}
$map_shortcode = fw_ext('shortcodes')->get_shortcode('map');
$options       = array(
	'mapdefaults' => array(
		'title' => __('Defaults', 'creatus'),
		'type' => 'tab',
		'options' => array(
			'data_provider' => array(
				'type' => 'multi-picker',
				'label' => false,
				'desc' => false,
				'picker' => array(
					'population_method' => array(
						'label' => __('Population Method', 'creatus'),
						'desc' => esc_html__('Select map population method (Ex: events, custom)', 'creatus'),
						'type' => 'select',
						'choices' => $map_shortcode->_get_picker_dropdown_choices()
					)
				),
				'choices' => $map_shortcode->_get_picker_choices(),
				'show_borders' => false
			),
			'map_type' => array(
				'type' => 'select',
				'label' => __('Map Type', 'creatus'),
				'desc' => esc_html__('Select map type', 'creatus'),
				'choices' => array(
					'roadmap' => esc_html__('Roadmap', 'creatus'),
					'terrain' => esc_html__('Terrain', 'creatus'),
					'satellite' => esc_html__('Satellite', 'creatus'),
					'hybrid' => esc_html__('Hybrid', 'creatus')
				)
			),
			'map_height' => array(
				'label' => __('Map Height', 'creatus'),
				'desc' => esc_html__('Set map height (Ex: 300)', 'creatus'),
				'type' => 'text'
			),
			'id' => array(
				'type' => 'unique',
				'length' => 8
			),
			'cmx' => _thz_container_metrics_defaults()
		)
	),
	'mapstyle' => array(
		'title' => __('Style', 'creatus'),
		'type' => 'tab',
		'options' => array(
			'map_zoom' => array(
				'type' => 'thz-slider',
				'value' => '10',
				'properties' => array(
					'min' => 0,
					'max' => 21
				),
				'showinput' => true,
				'label' => __('Map zoom', 'creatus'),
				'desc' => esc_html__('Set map zoom', 'creatus')
			),
			'bs' => array(
				'type' => 'thz-box-style',
				'label' => __('Map box style', 'creatus'),
				'preview' => true,
				'popup' => true,
				'button-text' => esc_html__('Customize map container box style', 'creatus'),
				'desc' => esc_html__('Adjust .thz-map box style','creatus'),
				'disable' => array('layout','boxsize','transform','video'),
				'units' => array(
					'borderradius',
					'boxsize',
					'padding',
					'margin',
				),
				'value' => array(
					'background' => array(
						'type' => 'color',
						'color' => '#efefef',
					),
				)
			),
			'map_pin' => array(
				'type' => 'upload',
				'value' => array(),
				'label' => __('Map pin image', 'creatus'),
				'desc' => esc_html__('Upload a pin for your location(s) (64x64)', 'creatus'),
				'images_only' => true
			),
			'style' => array(
				'type' => 'textarea',
				'label' => __('Map style', 'creatus'),
				'desc' => sprintf(esc_html__('Copy/Paste map styles from %1s', 'creatus'),'<a target="_blank" href="https://snazzymaps.com/explore">https://snazzymaps.com/</a>')
			)
		)
	),
	'mapcontrol' => array(
		'title' => __('Map Controls', 'creatus'),
		'type' => 'tab',
		'options' => array(
			'zoomcontrol' => array(
				'label' => __('Zoom', 'creatus'),
				'desc' => esc_html__('Show/hide map zoom control', 'creatus'),
				'type' => 'switch',
				'right-choice' => array(
					'value' => 'hide',
					'label' => __('Hide', 'creatus')
				),
				'left-choice' => array(
					'value' => 'show',
					'label' => __('Show', 'creatus')
				),
				'value' => 'show'
			),
			'streetviewcontrol' => array(
				'label' => __('Street view', 'creatus'),
				'desc' => esc_html__('Show/hide map street view control', 'creatus'),
				'type' => 'switch',
				'right-choice' => array(
					'value' => 'hide',
					'label' => __('Hide', 'creatus')
				),
				'left-choice' => array(
					'value' => 'show',
					'label' => __('Show', 'creatus')
				),
				'value' => 'show'
			),
			'pancontrol' => array(
				'label' => __('Pan', 'creatus'),
				'desc' => esc_html__('Show/hide map pan control', 'creatus'),
				'type' => 'switch',
				'right-choice' => array(
					'value' => 'hide',
					'label' => __('Hide', 'creatus')
				),
				'left-choice' => array(
					'value' => 'show',
					'label' => __('Show', 'creatus')
				),
				'value' => 'show'
			),
			'typecontrol' => array(
				'label' => __('Map type', 'creatus'),
				'desc' => esc_html__('Show/hide map type control', 'creatus'),
				'type' => 'switch',
				'right-choice' => array(
					'value' => 'hide',
					'label' => __('Hide', 'creatus')
				),
				'left-choice' => array(
					'value' => 'show',
					'label' => __('Show', 'creatus')
				),
				'value' => 'show'
			)
		)
	),
	
	'maptypography' => array(
		'title' => __('Typography', 'creatus'),
		'type' => 'tab',
		'options' => array(
			'title_font' => array(
				'label' => __('Location Title', 'creatus'),
				'type' => 'thz-typography',
				'value' => array(
					'size' 			=> 20,
				),
				'disable' => array('hovered'),
				'desc' => esc_html__('Location title font color family and metrics', 'creatus')
			),
			'description_font' => array(
				'label' => __('Location Description', 'creatus'),
				'type' => 'thz-typography',
				'value' => array(
					'size' 			=> 16,
				),
				'disable' => array('hovered'),
				'desc' => esc_html__('Location description font color family and metrics', 'creatus')
			)
		)
	),
	'mapeffects' => array(
		'title' => __('Effects', 'creatus'),
		'type' => 'tab',
		'options' => array(
			'animate' => array(
				'type' => 'thz-animation',
				'label' => false,
				'value' => array(
					'animate' => 'inactive',
					'effect' => 'thz-anim-fadeIn',
					'duration' => 400,
					'delay' => 0
				)
			),
			'cpx' => _thz_container_parallax_default()
		)
	)
);