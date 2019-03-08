<?php
if (!defined('FW'))
	die('Forbidden');
$options = apply_filters('thz_filter_header_general', array(
	'headers' => array(
		'type' => 'multi-picker',
		'label' => false,
		'desc' => false,
		'show_borders' => true,
		'picker' => array(
			'picked' => array(
				'label' => __('Header layout type', 'creatus'),
				'type' => 'image-picker',
				'value' => 'inline',
				'attr' => array(
					'class' => 'thz_option_headers thz-select-switch'
				),
				'choices' => array(
					'stacked' => array(
						'attr' => array(
							'data-enable' => 'tm_top_offset,tm_left_offset,tm_contained,.thz-heto-tab,.thz-sthe-tab,.thz-sehe-tab,header_contained,tm_subul_link_width,hstac,tm_anim,header_mode',
							'data-disable' => 'lhs,lhb,lh_branding,hamx,minimx,minilogo,hemmx,hofmx,hamimx,hicmx,htmp',
							'data-check' =>'hstac'
						),
						'small' => thz_theme_file_uri( '/inc/thzframework/admin/images/header_stacked_small.png'),
						'large' => thz_theme_file_uri( '/inc/thzframework/admin/images/header_stacked.png'),
					),
					'inline' => array(
						'attr' => array(
							'data-enable' => 'tm_top_offset,tm_left_offset,.thz-heto-tab,.thz-sthe-tab,.thz-sehe-tab,header_contained,tm_subul_link_width,htmp,tm_anim,header_mode',
							'data-disable' => 'tm_contained,lhs,lhb,lh_branding,hamx,minimx,minilogo,hemmx,hofmx,hamimx,hicmx,hstac,hstab,hstas',
						),
						
						'small' => thz_theme_file_uri( '/inc/thzframework/admin/images/header_inline_small.png'),
						'large' => thz_theme_file_uri( '/inc/thzframework/admin/images/header_inline.png'),
					),
				)
			)
		),
	),
	
	'header_mode' => array(
		'label' => __('Header mode', 'creatus'),
		'desc' => esc_html__('Select header mode', 'creatus'),
		'help' => esc_html__('If stacked header is positioned above the next element. Aboslute header is positioned over the next element and it is mostly used for transparent header layouts.', 'creatus'),
		'type' => 'short-select',
		'value' => 'stacked',
		'choices' => array(
			'stacked' => esc_html__('Stacked', 'creatus'),
			'absolute' => esc_html__('Absolute', 'creatus'),
		),
	),
	
	'header_boxstyle' => array(
		'type' => 'thz-box-style',
		'label' => __('Header box style', 'creatus'),
		'preview' => true,
		'button-text' => esc_html__('Customize header box style', 'creatus'),
		'desc' => esc_html__('Adjust #header_holder box style', 'creatus'),
		'popup' => true,
		'disable' => array('layout','boxsize','transform'),
		'value' => array(
			'boxshadow' => array(
				1 => array(
					'inset' => false,
					'horizontal-offset' => 0,
					'vertical-offset' => 0,
					'blur-radius' => 18,
					'spread-radius' => 0,
					'shadow-color' =>'rgba(0,0,0,0.05)'
				)
			),
			'background' => array(
				'type' => 'color',
				'color' => '#ffffff',
			)
		)
	),

	'htmp' => array(
		'label' => __('Menu position', 'creatus'),
		'desc' => esc_html__('Select desired menu position', 'creatus'),
		'type' => 'image-picker',
		'value' => 'right',
		'choices' => array(
			'left' => array(
				'small' => thz_theme_file_uri( '/inc/thzframework/admin/images/menu_inline_left_small.png'),
				'large' => thz_theme_file_uri( '/inc/thzframework/admin/images/menu_inline_left.png'),
			),
			'center' => array(
				'small' => thz_theme_file_uri( '/inc/thzframework/admin/images/menu_inline_centered_small.png'),
				'large' => thz_theme_file_uri( '/inc/thzframework/admin/images/menu_inline_centered.png'),
			),
			'right' => array(
				'small' => thz_theme_file_uri( '/inc/thzframework/admin/images/menu_inline_right_small.png'),
				'large' => thz_theme_file_uri( '/inc/thzframework/admin/images/menu_inline_right.png'),
			),

		 )
	),
	
	'header_contained' => array(
		'label' => __('Header contained?', 'creatus'),
		'desc' => esc_html__('If set to contained header will be contained by max site width', 'creatus'),
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
		'help' => esc_html__('This option is useful when you would like to stretch the header content all the way to the page edges.', 'creatus')
	),
	
	'hstac' => array(
		'label' => __('Header content', 'creatus'),
		'desc' => esc_html__('Select what will be shown in header content ( right side of the header ) ', 'creatus'),
		'type' => 'select',
		'value' => 'search',
		'attr' => array(
			'class' => 'thz-select-switch'
		),
		'choices' => array(
			'search' => array(
				'text' => esc_html__('Search input box','creatus'),
				'attr' => array(
					'data-disable' =>'hstab,hstas',
				),					
			),
			'banner' => array(
				'text' => esc_html__('Advertising banner','creatus'),
				'attr' => array(
					'data-enable' =>'hstab',
					'data-disable' =>'hstas',
				),					
			),
			
			'slogan' => array(
				'text' => esc_html__('Slogan','creatus'),
				'attr' => array(
					'data-enable' =>'hstas',
					'data-disable' =>'hstab',
				),					
			),
			'slogansearch' => array(
				'text' => esc_html__('Slogan and search','creatus'),
				'attr' => array(
					'data-enable' =>'hstas',
					'data-disable' =>'hstab',
				),					
			),
			'nothing' => array(
				'text' => esc_html__('Do not use','creatus'),
				'attr' => array(
					'data-disable' =>'hstab,hstas',
				),					
			),
						
		)
	 ),	
	'hstas' => array(
		'type' => 'text',
		'label' => __('Insert slogan', 'creatus'),
		'desc' => esc_html__('Add your custom slogan here.', 'creatus'),
		'value'=> 'Creatus rocks!',
	),			 
	'hstab' => array(
		'type' => 'thz-ace',
		'label' => __('Insert banner code', 'creatus'),
		'desc' => esc_html__('Add your banner code here . Use valid Javascript or HTML. You can also add shortcodes here.', 'creatus'),
		'value'=>'',
		'mode'=>'html',
		'theme'=>'chrome',
		'height'=>200,
	),			 

));