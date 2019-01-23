<?php
if (!defined('FW')){
	die('Forbidden');
}
		
$custom_effects = fw()->theme->get_options('custom_effects');
unset($custom_effects['cp'], $custom_effects['se']);
$options = array(
	'widget_name' => array(
		'type' => 'hidden',
	),
	'columninlayouttab' => array(
		'title' => __('Layout', 'creatus'),
		'type' => 'tab',
		'options' => array(
			'centered' => array(
				'label' => __('Center widget', 'creatus'),
				'desc' => esc_html__('If set to center, this widget float is removed and it will be centered inside the section.', 'creatus'),
				'type' => 'switch',
				'right-choice' => array(
					'value' => 'donotcenter',
					'label' => __('Do not center', 'creatus')
				),
				'left-choice' => array(
					'value' => 'center',
					'label' => __('Center', 'creatus')
				),
				'value' => 'donotcenter'
			),
			'flexalign' => array(
				'label' => __('Flexbox alignment', 'creatus'),
				'desc' => esc_html__('Select flexbox alignment', 'creatus'),
				'type' => 'short-select',
				'value' => 'fstart',
				'choices' => array(
					'fstart' => esc_html__('Top', 'creatus'),
					'fcenter' => esc_html__('Center', 'creatus'),
					'fend' => esc_html__('Bottom', 'creatus'),
				)
			),
			'bs' => array(
				'type' => 'thz-box-style',
				'label' => __('Widget-in box style', 'creatus'),
				'preview' => true,
				'popup' => true,
				'button-text' => esc_html__('Customize widget-in box style', 'creatus'),
				'desc' => esc_html__('This option will let you customize the box style of .thz-widget-column-in container', 'creatus'),
				'value' => array(),
				'units' => array(
					'borderradius',
					'boxsize',
					'padding',
					'margin',
				),
			),
			'smootha' => array(
				'type' => 'thz-multi-options',
				'label' => __('Smooth scroll anchor', 'creatus'),
				'min' => 0,
				'value' => array(
					'm' => 'inactive',
					'p' => 0,
					'd' => 800,
				),
				'desc' => esc_html__('Smooth scroll to container anchor. See help for more info.', 'creatus'),
				'help' => esc_html__('To smooth scroll to this anchor ( the container ID  ) via link, create a link or a new menu Custom link with URL #thisID. Do not forget the hash (#) sign in front of the ID. Stop at px stops the scroll at that px before/after the anchor. Effect duration is in milliseconds. 1000ms = 1s.', 'creatus'),
				'thz_options' => array(
					'm' => array(
						'type' => 'short-select',
						'title' => esc_html__('Mode', 'creatus'),
						'attr' => array(
							'class' => 'thz-select-switch'
						),
						'choices' => array(
							'before' => array(
								'text' => esc_html__('Before anchor','creatus'),
								'attr' => array(
									'data-enable' =>'.ua-poz-parent,.ua-ef-parent',
								),                  
							),
							'after' => array(
								'text' => esc_html__('After anchor','creatus'),
								'attr' => array(
									'data-enable' =>'.ua-poz-parent,.ua-ef-parent',
								),                  
							),							
							'inactive' => array(
								'text' => esc_html__('Inactive','creatus'),
								'attr' => array(
									'data-disable' =>'.ua-poz-parent,.ua-ef-parent',
								),                  
							),
						),
					),
					'p' => array(
						'type' => 'spinner',
						'title' => esc_html__('Stop at px', 'creatus'),
						'addon' => 'px',
						'min' => 0,
						'attr' => array(
							'class' => 'ua-poz'
						),
					),
					'd' => array(
						'type' => 'spinner',
						'title' => esc_html__('Duration', 'creatus'),
						'addon' => 'ms',
						'min' => 0,
						'attr' => array(
							'class' => 'ua-ef'
						),
					),

				)
			),	
			'id' => array(
				'type' => 'unique',
				'length' => 8
			),
			'cmx' => _thz_container_metrics_defaults()
		)
	),

	'columneffectstab' => array(
		'title' => __('Effects', 'creatus'),
		'type' => 'tab',
		'options' => array(
			$custom_effects
		)
	),
	
	'columnresponsivetab' => array(
		'title' => __('Responsive', 'creatus'),
		'type' => 'tab',
		'options' => array(
			're' => array(
				'type' => 'addable-popup',
				'label' => __('Breakpoints', 'creatus'),
				'desc' => __('Add custom column settings for specific breakpoints.', 'creatus'),
				'popup-title' => esc_html__('Add/Edit Responsive breakpoint', 'creatus'),
				'template' => 'Breakpoint for {{ if (m.b == "767") { }} : <strong>Mobiles</strong>{{ } }}{{ if (m.b == "979") { }} : <strong>Tablets</strong>{{ } }}{{ if (m.b == "1699") { }} : <strong>Large desktops</strong>{{ } }}',
				'add-button-text' => esc_html__('Add/Edit breakpoint', 'creatus'),
				'size' => 'large',
				'limit' => 3,
				'sortable' => false,
				'popup-options' => array(
					'm' => array(
						'type' => 'thz-multi-options',
						'label' => __('Breakpoint metrics', 'creatus'),
						'addon' => 'px',
						'min' => 0,
						'value' => array(
							'b' => 767,
							'w' => 'default',
							's' => '',
							't' => 'default',
						),
						'desc' => esc_html__('Select breakpoint and set the widget metrics.', 'creatus'),
						'help' => esc_html__('Note that on mobile devices the widget widths are 1/1 ( 100% ) by default. Top space is column top margin. Leave it empty if the widget has enough top space at this breakpoint.', 'creatus'),
						'thz_options' => array(
							'b' => array(
								'type' => 'short-select',
								'title' => esc_html__('Breakpoint for', 'creatus'),
								'choices' => array(
									767 => esc_html__('Mobiles ( under 768px ) ', 'creatus'),
									979 => esc_html__('Tablets ( under 980px )', 'creatus'),
									1699 => esc_html__('Large desktops ( above 1699px )', 'creatus'),
								)
							),
							'w' => array(
								'type' => 'short-select',
								'title' => esc_html__('Widget width', 'creatus'),
								'choices' => array(
									'default' => esc_html__('Do not change', 'creatus'),
									'1_1' => esc_html__('1/1', 'creatus'),
									'1_2' => esc_html__('1/2', 'creatus'),
									'1_3' => esc_html__('1/3', 'creatus'),
									'1_4' => esc_html__('1/4', 'creatus'),
									'1_5' => esc_html__('1/5', 'creatus'),
									'1_6' => esc_html__('1/6', 'creatus'),
									'2_3' => esc_html__('2/3', 'creatus'),
									'2_5' => esc_html__('2/5', 'creatus'),
									'3_4' => esc_html__('3/4', 'creatus'),
									'3_5' => esc_html__('3/5', 'creatus'),
									'4_5' => esc_html__('4/5', 'creatus'),
								)
							),
							's' => array(
								'type' => 'spinner',
								'title' => esc_html__('Top Space', 'creatus'),
								'addon' => 'px',
								'min' => 0,
							),
							't' => array(
								'type' => 'short-select',
								'title' => esc_html__('Text align', 'creatus'),
								'choices' => array(
									'default' => esc_html__('Do not change', 'creatus'),
									'left' => esc_html__('Left', 'creatus'),
									'center' => esc_html__('Center', 'creatus'),
									'right' => esc_html__('Right', 'creatus'),
								)
							),
						)
					),	
					
					'b' => array(
						'type' => 'thz-box-style',
						'label' => __('Widget-in box style', 'creatus'),
						'desc' => esc_html__('Adjust .thz-widget-column-in box style for this breakpoint', 'creatus'),
						'preview' => true,
						'button-text' => esc_html__('Customize widget-in box style', 'creatus'),
						'popup' => true,
						'disable' => array('video'),
						'value' => array(),
						'units' => array(
							'borderradius',
							'boxsize',
							'padding',
							'margin',
						),
					),
				)
			),
		)
	),
);