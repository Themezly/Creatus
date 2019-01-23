<?php if (!defined('FW')) die('Forbidden');

$sidebars_options = fw()->theme->get_options('sidebars_settings');

$options = array(

	'defaults' => array(
		'title' => __('Defaults', 'creatus'),
		'type' => 'tab',
		'lazy_tabs'=> false,
		'options' => array(
			'sidebar' => array(
				'label'   => __( 'Sidebar', 'creatus' ),
				'desc'  => esc_html__('Select sidebar.', 'creatus'),
				'type'    => 'select',
				'choices' => FW_Shortcode_Widget_Area::get_sidebars()
			),
			'cs' => array(
				'type' => 'addable-popup',
				'value' => array(),
				'label' => __('Custom sidebar options', 'creatus'),
				'desc'  => esc_html__('Add custom sidebar options for this page or leave as is for theme defaults.', 'creatus'),
				'template' => esc_html__('Custom sidebar options are active','creatus'),
				'popup-title' => null,
				'size' => 'large', 
				'limit' => 1,
				'add-button-text' => esc_html__('Add custom sidebar options', 'creatus'),
				'sortable' => false,
				'popup-options' => array(
					$sidebars_options['sb_style']['popup-options']
				),
			),
			
			'id' => array(
				'type' => 'unique',
				'length' => 8
			),
			
			'bs' => array(
				'type' => 'thz-box-style',
				'label' => __('Container box style', 'creatus'),
				'preview' => false,
				'popup' => true,
				'desc' => esc_html__('Adjust .thz-shortcode-widget-area box style', 'creatus'),
				'button-text' => __('Customize container box style', 'creatus'),
				'disable' => array('layout','boxsize','transform','video'),
				'units' => array(
					'borderradius',
					'boxsize',
					'padding',
					'margin',
				),
				'value' => array()
			),	
			
			'cmx' => _thz_container_metrics_defaults(),
			
			'instyle' => array(
				'type' => 'short-text',
				'label' => __('Inherit style from', 'creatus'),
				'desc' => esc_html__('Insert widget area ID to inherit the style from. See help for more info.', 'creatus'),
				'help' => esc_html__('If you have multiple widget areas with same style you can set main swidget area Custom ID than add that ID here. This way every widget area on this page with this inherit ID will use same CSS. This reduces the overhead CSS and renders the widget area faster. Note that once the inherit ID is added the CSS for this widget area is not printed. The effects must be set on per element basis.', 'creatus'),
				'value' => ''
			),

		)
	),	
	
	'widgeteffects' => array(
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