<?php
if (!defined('FW')) {
	die('Forbidden');
}
$custom_typo = fw()->theme->get_options('custom_typo');
unset($custom_typo['tl']);
$options = array(

	'paneloptionstab' => array(
		'title'   => __( 'Panel options', 'creatus' ),
		'type'    => 'tab',
		'options' => array(
			
			'panelspeed' => array(
				'type' => 'thz-spinner',
				'label'   => esc_html__( 'Transition speed', 'creatus' ),
				'desc' => esc_html__('Set panel open/close transition speed. 1000ms = 1s', 'creatus'),
				'addon' => 'ms',
				'min' => 0,
				'value' => 500,
				'step' => 50,
			),
			
			'panelposition' => array(
				'label' => __('Position', 'creatus'),
				'desc' => esc_html__('Position the side panel', 'creatus'),
				'type' => 'switch',
				'right-choice' => array(
					'value' => 'left',
					'label' => __('Left', 'creatus')
				),
				'left-choice' => array(
					'value' => 'right',
					'label' => __('Right', 'creatus')
				),
				'value' => 'right'
			),
			
			'panelwidth'    => array(
				'type'  => 'short-text',
				'label' => __( 'Panel width', 'creatus' ),
				'desc'  => esc_html__( 'Insert pannel width.', 'creatus' ),
				'value'  => '350px',
				'help'  => esc_html__( 'You can use pixels ( px ) or percentage ( % ). If no unit is set px is default.', 'creatus' ),
			),		
						
			'pc' => array(
				'type' => 'thz-multi-options',
				'label' => __('Panel colors', 'creatus'),
				'desc' => esc_html__('Adjust panel colors. See help for more info', 'creatus'),
				'help' => esc_html__('This section is located inside a panel, the colors here adjust that panel background, opener background and opener icon color. All section CSS settings are in Section box style option. If you set "Section Contained" at "Not contained" and give this section a background color, that background color will be visible and panel background color is than behind the section.', 'creatus'),
				'value' => array(
					'b' => '#efefef',
					'o' => '#efefef',
					'i' => '#454545'
				),
				'thz_options' => array(
					'b' => array(
						'type' => 'color',
						'title' => esc_html__('Background', 'creatus'),
						'box' => true
					),
					'o' => array(
						'type' => 'color',
						'title' => esc_html__('Opener', 'creatus'),
						'box' => true
					),
					'i' => array(
						'type' => 'color',
						'title' => esc_html__('Icon', 'creatus'),
						'box' => true
					)
				)
			),
			
			'panel_name' => array(
				'type' => 'hidden',
			),
		),
	),

	'sectionlayouttab' => array(
		'title' => __('Layout', 'creatus'),
		'type' => 'tab',
		'options' => array(
			'section_name' => array(
				'type' => 'hidden',
			),

			'bs' => array(
				'type' => 'thz-box-style',
				'label' => __('Section box style', 'creatus'),
				'desc' => esc_html__('Adjust .thz-section-holder section box style', 'creatus'),
				'preview' => true,
				'popup' => true,
				'button-text' => esc_html__('Customize section box style', 'creatus'),
				'value' => array(),
				'units' => array(
					'borderradius',
					'boxsize',
					'padding',
					'margin',
				),
			),
			'section_contained' => array(
				'type' => 'multi-picker',
				'label' => false,
				'desc' => false,
				'picker' => array(
					'picked' => array(
						'label' => __('Section Contained', 'creatus'),
						'type' => 'switch',
						'right-choice' => array(
							'value' => 'contained',
							'label' => __('Contained', 'creatus')
						),
						'left-choice' => array(
							'value' => 'notcontained',
							'label' => __('Not contained', 'creatus')
						),
						'value' => 'notcontained',
						'desc' => esc_html__('If set to contained this section will be contained by max site width.', 'creatus'),
					)
				),
				'choices' => array(
					'notcontained' => array(
						'content_contained' => array(
							'label' => __('Content contained?', 'creatus'),
							'desc' => esc_html__('If set to contained this section content will be contained by max site width', 'creatus'),
							'type' => 'switch',
							'right-choice' => array(
								'value' => 'contained',
								'label' => __('Contained', 'creatus')
							),
							'left-choice' => array(
								'value' => 'notcontained',
								'label' => __('Not contained', 'creatus')
							),
							'value' => 'contained',
							'help' => esc_html__('This option is useful when you would like to stretch the section content all the way to the section edges.', 'creatus')
						)
					)
				)
			),
			'spacings' => array(
				'type' => 'thz-multi-options',
				'label' => __('Section spacings', 'creatus'),
				'addon' => 'px',
				'min' => 0,
				'value' => array(
					'con' => '',
					'col' => '',
					
				),
				'desc' => esc_html__('Adjust spacings for all containers or columns in this section.', 'creatus'),
				'help' => esc_html__('This option will let you adjust side space for this section .thz-container or .thz-column. If empty it will use spacings options located in theme options "Site" tab.', 'creatus'),
				'thz_options' => array(
					'con' => array(
						'type' => 'spinner',
						'title' => esc_html__('Containers', 'creatus'),
						'addon' => 'px',
						'min' => 0,
						'max' => 1000,
						'step' => 1,
						'attr' => array(
						
							'placeholder' => fw_get_db_settings_option('spacings/con', 30)
						
						),
					),
					'col' => array(
						'type' => 'spinner',
						'title' => esc_html__('Columns', 'creatus'),
						'addon' => 'px',
						'min' => 0,
						'max' => 1000,
						'step' => 1,
						'attr' => array(
						
							'placeholder' => fw_get_db_settings_option('spacings/col', 30)
						
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
	'sectionwidgetsoptions' => array(
		'title' => __('Widgets options', 'creatus'),
		'type' => 'tab',
		'options' => array(
			
			$custom_typo,
			
			'wi_tbs' => array(
				'type' => 'thz-box-style',
				'label' => __('Widgets title box style', 'creatus'),
				'preview' => true,
				'button-text' => esc_html__('Customize widgets title box style', 'creatus'),
				'desc' => esc_html__('Adjust .thz-section-in .widget-title box style', 'creatus'),
				'disable' => array(
					'video',
				),
				'popup' => true,
				'value' => array()
			),
			'wi_title' => array(
				'type' => 'thz-typography',
				'label' => __('Widgets title metrics', 'creatus'),
				'desc' => esc_html__('Adjust widgets title metrics.', 'creatus'),
				'value' => array(
					'size' => 20,
				),
				'disable' => array('hovered'),
			),
			'wi_metrics' => array(
				'type' => 'thz-multi-options',
				'label' => __('Widgets items colors', 'creatus'),
				'desc' => esc_html__('Adjust widgets items colors. Theme colors are inherited if empty.', 'creatus'),
				'help' => esc_html__('Lists ( menus list ) border color is applied to all .thz-section-in .thz-has-list li a items.', 'creatus'),
				'value' => array(
					'li' => '',
					'lih' => '',
					'sep' => '#eaeaea'
				),
				'thz_options' => array(
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
					'sep' => array(
						'type' => 'color',
						'title' => esc_html__('Lists border', 'creatus'),
						'box' => true
					)
				)
			),			
			
		)
	),

);

/*$section_builder = new FW_Option_Type_ThzSection_Builder_Item_Section();
$section_options = $section_builder->get_options();
$section_options = $section_options[0];

$options_array = $section_options['sectionlayouttab']['options'];


$section_options['sectionlayouttab']['options']['panel_name'] = array(
				'type' => 'hidden',
			);
$section_options['sectionlayouttab']['options']['pc'] = array(
				'type' => 'thz-multi-options',
				'label' => __('Panel colors', 'creatus'),
				'desc' => esc_html__('Adjust panel colors. See help for more info', 'creatus'),
				'help' => esc_html__('This section is located inside a panel, the colors here adjust that panel background, opener background and opener icon color. All section CSS settings are in Section box style option. If you set "Section Contained" at "Not contained" and give this section a background color, that background color will be visible and panel background color is than behind the section.', 'creatus'),
				'value' => array(
					'b' => '#efefef',
					'o' => '#efefef',
					'i' => '#454545'
				),
				'thz_options' => array(
					'b' => array(
						'type' => 'color',
						'title' => esc_html__('Background', 'creatus'),
						'box' => true
					),
					'o' => array(
						'type' => 'color',
						'title' => esc_html__('Opener', 'creatus'),
						'box' => true
					),
					'i' => array(
						'type' => 'color',
						'title' => esc_html__('Icon', 'creatus'),
						'box' => true
					)
				)
			);


unset($section_options['sectioneffectstab'],$section_options['sectionlayouttab']['options']['useanchor']);

$options = $section_options;*/