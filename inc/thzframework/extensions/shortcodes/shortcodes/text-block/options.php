<?php
if (!defined('FW')) {
	die('Forbidden');
}
$options = array(
	'id' => array(
		'type' => 'unique',
		'length' => 8
	),
	'textblockdefaults' => array(
		'title' => __('Defaults', 'creatus'),
		'type' => 'tab',
		'options' => array(
			'text' => array(
				'type' => 'wp-editor',
				'size' => 'large',
				'editor_height' => 200,
				'shortcodes' => true,
				'editor_type' => 'tinymce',
				'wpautop' => true,
				'label' => __('Content', 'creatus'),
				'desc' => esc_html__('Enter some content for this text block', 'creatus'),
				'value' =>'I am a text block. Praesent ut accumsan est. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras volutpat, ligula quis mollis elementum, ex nisi interdum ante, eu posuere sem sem et tortor.'
			),
			'cmx' => _thz_container_metrics_defaults()
		)
	),
	'textblockstyling' => array(
		'title' => __('Styling', 'creatus'),
		'type' => 'tab',
		'options' => array(
			'bs' => array(
				'type' => 'thz-box-style',
				'label' => __('Container box style', 'creatus'),
				'preview' => false,
				'popup' => true,
				'desc' => esc_html__('Adjust .thz-text-block box style', 'creatus'),
				'button-text' => __('Customize container box style', 'creatus'),
				'disable' => array('video'),
				'units' => array(
					'borderradius',
					'boxsize',
					'padding',
					'margin',
				),
				'value' => array()
			),

			'h' => array(
				'type' => 'thz-typography',
				'label' => __('Headings', 'creatus'),
				'desc' => esc_html__('Headings font', 'creatus'),
				'value' => array(),
				'disable' => array('hovered'),
			),
						
			't' => array(
				'label' => __('Text', 'creatus'),
				'desc' => esc_html__('Text font', 'creatus'),
				'value' => array(),
				'type' => 'thz-typography',
				'value' => array(),
				'disable' => array('hovered'),
			),

			'l' => array(
				'type' => 'thz-typography',
				'label' => __('Links', 'creatus'),
				'desc' => esc_html__('Links font', 'creatus'),
				'value' => array(),
				'disable' => array(),
			)			
			
		)
	),
	
	'texteffects' => array(
		'title' => __('Effects', 'creatus'),
		'type' => 'tab',
		'lazy_tabs'=> false,
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
