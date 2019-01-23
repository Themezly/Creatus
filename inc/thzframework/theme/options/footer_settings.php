<?php
if (!defined('FW'))
	die('Forbidden');
$options = apply_filters('thz_filter_footer_settings', array(

	'footer_mx' => array(
		'type' => 'thz-multi-options',
		'label' => __('Footer metrics', 'creatus'),
		'desc' => esc_html__('Adjust footer metrics. See help for more info.', 'creatus'),
		'help' => esc_html__('If Contained is set to yes footer will be contained by max site width. If reveal effect is active, .thz-footer-sections-holder appears as coming under the site when user scrolls to it. If you would rather use page blocks instead of any other footer type, please make sure you first have page blocks created. Look to your left at WordPress side menu and locate Page Blocks custom post type. In page blocks you need to use page builder to create custom page blocks that will be displayed as footer section.', 'creatus'),
		'value' => array(
			'm' => 'both',
			'c' => 'contained',
		),
		'thz_options' => array(
		
			'm' => array(
				'title' => esc_html__('Display mode', 'creatus'),
				'type' => 'short-select',
				'value' => 'show',
				'attr' => array(
					'class' => 'thz-select-switch'
				),
				'choices' => array(
					'hidden' => array(
						'text' => esc_html__('Hide', 'creatus'),
						'attr' => array(
							'data-disable' => 'fpb,footer_boxstyle,footable_bs,footer_colors,foc,fof,site_branding,fre,.foot-cont-parent,.foot-rev-parent',
							
						)
					),
					'both' => array(
						'text' => esc_html__('Footer and widgets section', 'creatus'),
						'attr' => array(
							'data-enable' => 'footer_boxstyle,footable_bs,footer_colors,foc,fof,site_branding,fre,.foot-cont-parent,.foot-rev-parent',
							'data-disable' => 'fpb',
							
						)
					),
					'footer' => array(
						'text' => esc_html__('Footer', 'creatus'),
						'attr' => array(
							'data-enable' => 'footer_boxstyle,footable_bs,footer_colors,foc,fof,site_branding,fre,.foot-cont-parent,.foot-rev-parent',
							'data-disable' => 'fpb',
						)
					),
					'widgets' => array(
						'text' => esc_html__('Footer widgets section', 'creatus'),
						'attr' => array(
							'data-enable' => '.foot-rev-parent',
							'data-disable' => 'fpb,footer_boxstyle,footable_bs,footer_colors,foc,fof,site_branding,fre,.foot-cont-parent',
							
						)
					),
				)
			),
			
			'c' => array(
				'type' => 'short-select',
				'title' => esc_html__('Contained', 'creatus'),
				'choices' => array(
					'contained' => esc_html__('Yes', 'creatus'),
					'notcontained' => esc_html__('No', 'creatus'),
				),
				'attr' => array(
					'class' => 'foot-cont'
				),
			),
		)
	),	

	'footer_boxstyle' => array(
		'type' => 'thz-box-style',
		'label' => __('Footer box style', 'creatus'),
		'desc' => esc_html__('Customize #footer box style', 'creatus'),
		'preview' => true,
		'button-text' => esc_html__('Customize footer box style', 'creatus'),
		'popup' => true,
		'disable' => array('layout'),
		'value' => array(
			'background' => array(
				'type' => 'color',
				'color' => 'color_5',
			)
		)
	),
	
	'footable_bs' => array(
		'type' => 'thz-box-style',
		'label' => __('Footer table box style', 'creatus'),
		'desc' => esc_html__('Customize .thz-footer-table box style', 'creatus'),
		'preview' => true,
		'button-text' => esc_html__('Customize footer table box style', 'creatus'),
		'popup' => true,
		'disable' => array('layout'),
		'value' => array(
			'padding' => array(
				'top' => 45,
				'right' => 'none',
				'bottom' => 'none',
				'left' => 'none'
			),
			'margin' => array(
				'top' => 90,
				'right' => 'none',
				'bottom' => 90,
				'left' => 'none'
			),
			'borders' => array(
				'all' => 'separate',
				'top' => array(
					'w' => 1,
					's' => 'solid',
					'c' => 'color_4'
				),
				'right' => array(
					'w' => 0,
					's' => 'solid',
					'c' => ''
				),
				'bottom' => array(
					'w' => 0,
					's' => 'solid',
					'c' => ''
				),
				'left' => array(
					'w' => 0,
					's' => 'solid',
					'c' => ''
				),
			),
		)
	),

	// footer fonts
	'fof' => array(
		'type' => 'addable-popup',
		'value' => array(),
		'label' => __('Footer fonts', 'creatus'),
		'desc' => esc_html__('Add custom footer font settings', 'creatus'),
		'template' => '<b>' . esc_html__('Custom font settings are active', 'creatus') . '</b>',
		'popup-title' => esc_html__('Fonts settings', 'creatus'),
		'size' => 'large',
		'add-button-text' => esc_html__('Click to adjust footer fonts', 'creatus'),
		'sortable' => false,
		'limit' => 1,
		'popup-options' => array(
			'b' => array(
				'label' =>__('Branding font', 'creatus'),
				'desc' => esc_html__('Adjust branding font.', 'creatus'),
				'type' => 'thz-typography',
				'value' => array(),
				'disable' => array('color','hovered'),
			),
			'n' => array(
				'label' =>__('Navigation font', 'creatus'),
				'desc' => esc_html__('Adjust navigation font.', 'creatus'),
				'type' => 'thz-typography',
				'value' => array(),
			)
		)
	),
		
	'footer_colors' => array(
		'type' => 'thz-colorset',
		'label' => __('Footer colors', 'creatus'),
		'desc' => esc_html__('Adjust footer colors. Theme colors used if empty', 'creatus'),
		'value' => array(
			'text_color' => '',
			'link_color' => '',
			'link_hover_color' => ''
		),

	),

	'foc' => array(
		'type' => 'thz-multi-options',
		'label' => __('Footer content', 'creatus'),
		'desc' => esc_html__('Select footer layout and choose what will be shown in footer content', 'creatus'),
		'value' => array(
			'la' => 'table',
			'l' => 'b',
			'm' => 'h',
			'r' => 's'
		),
		'thz_options' => array(
			'la' => array(
				'type' => 'short-select',
				'title' => esc_html__('Layout', 'creatus'),
				'choices' => array(
					'table' => esc_html__('Table', 'creatus'),
					'centered' => esc_html__('Centered', 'creatus'),
				)
			),
			'l' => array(
				'type' => 'short-select',
				'title' => esc_html__('Left content', 'creatus'),
				'choices' => array(
					's' => esc_html__('Social links', 'creatus'),
					'n' => esc_html__('Navigation', 'creatus'),
					'b' => esc_html__('Branding', 'creatus'),
					'h' => esc_html__('Hide', 'creatus')
				)
			),
			'm' => array(
				'type' => 'short-select',
				'title' => esc_html__('Middle content', 'creatus'),
				'choices' => array(
					's' => esc_html__('Social links', 'creatus'),
					'n' => esc_html__('Navigation', 'creatus'),
					'b' => esc_html__('Branding', 'creatus'),
					'h' => esc_html__('Hide', 'creatus')
				)
			),
			'r' => array(
				'type' => 'short-select',
				'title' => esc_html__('Right content', 'creatus'),
				'choices' => array(
					's' => esc_html__('Social links', 'creatus'),
					'n' => esc_html__('Navigation', 'creatus'),
					'b' => esc_html__('Branding', 'creatus'),
					'h' => esc_html__('Hide', 'creatus')
				)
			)
		)
	),	

	'site_branding' => array(
		'type' => 'textarea',
		'value' => '<span class="thz-copyright">Copyright &copy; {year} <a href="http://themezly.com" target="_blank">Themezly</a>.</span>',
		'label' => __('Site branding', 'creatus'),
		'desc' => esc_html__('Add site branding', 'creatus'),
		'help' => esc_html__('You can use span, a, div and img html tags. If you wish to add copyright year please use {year} instead of the numbers. This way the current year will be shown.', 'creatus')
	),
	
	
	'scrolltop' => array(
		'label' => __('Scroll to top anchor', 'creatus'),
		'type' => 'short-select',
		'value' => 'enable',
	  	'attr' => array(
			'class' => 'thz-select-switch'
		),
		'choices' => array(
			'enable' => array(
				'text' => esc_html__('Enabled','creatus'),
				'attr' => array(
					'data-enable' =>'scrolltc',
				),                  
			),
			
			'disable' => array(
				'text' => esc_html__('Disabled','creatus'),
				'attr' => array(
					'data-disable' =>'scrolltc',
				),                  
			),
		),
		'desc' => esc_html__('This option disables/enables scroll to top anchor.', 'creatus')
		
	),	
	
	'scrolltc' => array(
		'type' => 'thz-multi-options',
		'label' => __('Scroll to top metrics', 'creatus'),
		'desc' => esc_html__('Adjust scroll to top anchor metrics', 'creatus'),
		'value' => array(
			'size_sh' => 30,
			'radius_sh' => 3,
			'size_f' => 16,
			'bottom' => 70,
			'right' => 20,
			'color_i' => '',
			'color_sh' => '#ffffff',
			'color_b' => 'color_4',
		),
		'breakafter' => 'right',
		'thz_options' => array(
			'size_sh' => array(
				'type' => 'spinner',
				'title' => esc_html__('Shape size', 'creatus'),
			),
			'radius_sh' => array(
				'type' => 'spinner',
				'title' => esc_html__('Shape radius', 'creatus'),
			),
			'size_f' => array(
				'type' => 'spinner',
				'title' => esc_html__('Font size', 'creatus'),
			),
			'bottom' => array(
				'type' => 'spinner',
				'title' => esc_html__('Bottom position', 'creatus'),
			),
			'right' => array(
				'type' => 'spinner',
				'title' => esc_html__('Right position', 'creatus'),
			),
			'color_i' => array(
				'type' => 'color',
				'title' => esc_html__('Icon color', 'creatus'),
				'box' => true
			),
			'color_sh' => array(
				'type' => 'color',
				'title' => esc_html__('Shape color', 'creatus'),
				'box' => true
			),
			'color_b' => array(
				'type' => 'color',
				'title' => esc_html__('Border color', 'creatus'),
				'box' => true
			),
		)
	),
	
	
	'fre' => _thz_responsive_options(),
	
));