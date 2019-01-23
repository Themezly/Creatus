<?php if ( ! defined( 'FW' ) ) die( 'Forbidden' );


$options = array(
	'site_width' => array(
		'type' => 'thz-spinner',
		'value' => 1200,
		'addon' => 'px',
		'units' => array('px','%'),
		'label' => __('Site max width', 'creatus'),
		'desc' => esc_html__('Define website max-width', 'creatus'),
		'help' => esc_html__('You can use pixels ( px ) or percentage ( % ).', 'creatus')
	),
	'layout_type' => array(
		'type' => 'image-picker',
		'label' => __('Site layout type', 'creatus'),
		'value' => 'full',
		'choices' => array(
			'full' => array(
				'small' => array(
					'height' => 96,
					'src' => thz_theme_file_uri('/inc/thzframework/admin/images/full_width_page_layout.png')
				)
			),
			'boxed' => array(
				'small' => array(
					'height' => 96,
					'src' => thz_theme_file_uri('/inc/thzframework/admin/images/boxed_page_layout.png')
				)
			)
		),
		'desc' => esc_html__('Select site layout type. Full or boxed width.', 'creatus'),
		'help' => esc_html__('Select site layout style. It can boxed or full. Note that if you set this option to "Boxed",  "Contained" option for Header, Mainmenu, Main content and Footer are not effective.', 'creatus')
	),
	
	'bf' => array(
		'type' => 'thz-multi-options',
		'label' => __('Body frame', 'creatus'),
		'desc' => esc_html__('Activate/deactivate body frame', 'creatus'),
		'value' => array(
			'm' => 'inactive',
			'w' => 20,
			'c' => '#ffffff',
			'ss' => 20,
			'sc' => 'rgba(0,0,0,0.1)',
		),
		'thz_options' => array(
			'm' => array(
				'type' => 'select',
				'title' => esc_html__('Mode', 'creatus') ,
				'attr' => array(
					'class' => 'thz-select-switch'
				) ,
				'choices' => array(
					'inactive' => array(
						'text' => esc_html__('Inactive', 'creatus') ,
						'attr' => array(
							'data-disable' => '.bf-mx-parent',
						)
					),
					'active' => array(
						'text' => esc_html__('Active', 'creatus') ,
						'attr' => array(
							'data-enable' => '.bf-mx-parent',
						)
					),

				)
			),
			'w' => array(
				'type' => 'spinner',
				'title' => esc_html__('Frame width', 'creatus'),
				'addon' => 'px',
				'min' => 0,
				'step' => 1,
				'attr' => array(
					'class' =>'bf-mx'
				)
			),
			'c' => array(
				'type' => 'color',
				'title' => esc_html__('Frame color', 'creatus'),
				'box' => true,
				'attr' => array(
					'class' =>'bf-mx'
				)
			),
			'ss' => array(
				'type' => 'spinner',
				'title' => esc_html__('Shadow Size', 'creatus'),
				'addon' => 'px',
				'min' => 0,
				'step' => 1,
				'attr' => array(
					'class' =>'bf-mx'
				)
			),
			'sc' => array(
				'type' => 'color',
				'title' => esc_html__('Shadow color', 'creatus'),
				'box' => true,
				'attr' => array(
					'class' =>'bf-mx'
				)
			),
		)
	),
	
	'main_contained' => array(
		'type' => 'multi-picker',
		'label' => false,
		'desc' => false,
		'picker' => array(
			'picked' => array(
				'label' => __('Main div contained?', 'creatus'),
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
				'desc' => esc_html__('If set to contained main div will be contained by max site width.', 'creatus'),
				'help' => esc_html__('Main content div holds your blog content and left and right sidebar. This option is useful when you would like to stretch the main div all the way to the page edges.', 'creatus')
			)
		),
	),
	
	
	'spacings' => array(
		'type' => 'thz-multi-options',
		'label' => __('Site spacings', 'creatus'),
		'addon' => 'px',
		'min' => 0,
		'value' => array(
			'con' => 30,
			'col' => 30,
			'sec' => 4,
		),
		'desc' => esc_html__('Adjust spacings for all site containers, sections or columns.', 'creatus'),
		'help' => sprintf( esc_html__('Container is side padding for all theme containers a.k.a .thz-container. These containers hold all main site sections;, header, footer, top menu and grid layout.%1$sColumns is side padding for all columns a.k.a .thz-column. They are located inside the .thz-row.%1$sSection is default vertical padding for theme page builder sections a.k.a .thz-section and its value is multiplied by columns spacing.%1$sAll these can also be re-adjusted in every section settings.', 'creatus'),'<br /><br />'),
		'thz_options' => array(
			'con' => array(
				'type' => 'spinner',
				'title' => esc_html__('Containers', 'creatus'),
				'addon' => 'px',
				'min' => 0,
				'max' => 1000,
				'step' => 1,
			),
			'col' => array(
				'type' => 'spinner',
				'title' => esc_html__('Columns', 'creatus'),
				'addon' => 'px',
				'min' => 0,
				'max' => 1000,
				'step' => 1,
			),
			'sec' => array(
				'type' => 'spinner',
				'title' => esc_html__('Sections', 'creatus'),
				'addon' => 'X',
				'min' => 0,
				'step' => 0.5,
			),
		)
	),
	
	'blocks_spacing' => array(
		'type' => 'thz-multi-options',
		'label' => __('Blocks spacings', 'creatus'),
		'desc' => esc_html__('Adjust .thz-block-spacer spacing', 'creatus'),
		'help' => esc_html__('This is spacing for .thz-block-spacer. These containers surround content and left/right sidebars.', 'creatus'),
		'value' => array(
			't' => 75,
			'b' => 75,
			'h' => 75,
			
		),
		'thz_options' => array(
			't' => array(
				'type' => 'spinner',
				'title' => esc_html__('Top', 'creatus'),
				'addon' => 'px',
				'min' => 0,
				'max' => 1000,
				'step' => 1
			),
			'b' => array(
				'type' => 'spinner',
				'title' => esc_html__('Bottom', 'creatus'),
				'addon' => 'px',
				'min' => 0,
				'max' => 1000,
				'step' => 1
			),
			'h' => array(
				'type' => 'spinner',
				'title' => esc_html__('Horizontal', 'creatus'),
				'addon' => 'px',
				'min' => 0,
				'max' => 1000,
				'step' => 1
			),
		)
	),
	
	'sp_res' => array(
		'type' => 'addable-popup',
		'label' => __('Responsive spacings', 'creatus'),
		'desc' => __('Add spacings for specific breakpoints.', 'creatus'),
		'popup-title' => esc_html__('Add/Edit Responsive breakpoint', 'creatus'),
		'template' => 'Breakpoint for {{ if (m.b == "767") { }} : <strong>Mobiles</strong>{{ } }}{{ if (m.b == "979") { }} : <strong>Tablets</strong>{{ } }}{{ if (m.b == "1699") { }} : <strong>Large desktops</strong>{{ } }}',
		'add-button-text' => esc_html__('Add/Edit breakpoint', 'creatus'),
		'size' => 'large',
		'limit' => 3,
		'sortable' => false,
		'popup-options' => array(
			'm' => array(
				'type' => 'thz-multi-options',
				'label' => __('Breakpoint for', 'creatus'),
				'addon' => 'px',
				'min' => 0,
				'value' => array(
					'b' => 767,
				),
				'desc' => esc_html__('Select breakpoint', 'creatus'),
				'thz_options' => array(
					'b' => array(
						'type' => 'short-select',
						'title' => false,
						'choices' => array(
							767 => esc_html__('Mobiles ( under 768px ) ', 'creatus'),
							979 => esc_html__('Tablets ( under 980px )', 'creatus'),
							1699 => esc_html__('Large desktops ( above 1699px )', 'creatus'),
						)
					),
				)
			),					
			's' => array(
				'type' => 'thz-multi-options',
				'label' => __('Site spacings', 'creatus'),
				'addon' => 'px',
				'min' => 0,
				'value' => array(
					'con' => 30,
					'col' => 30,
					'sec' => 3,
				),
				'desc' => esc_html__('Adjust spacings for all site containers, sections or columns.', 'creatus'),
				'help' => sprintf( esc_html__('Container is side padding for all theme containers a.k.a .thz-container. These containers hold all main site sections;, header, footer, top menu and grid layout.%1$sColumns is side padding for all columns a.k.a .thz-column. They are located inside the .thz-row.%1$sSection is default vertical padding for theme page builder sections a.k.a .thz-section and its value is multiplied by columns spacing.%1$sAll these can also be re-adjusted in every section settings.', 'creatus'),'<br /><br />'),
				'thz_options' => array(
					'con' => array(
						'type' => 'spinner',
						'title' => esc_html__('Containers', 'creatus'),
						'addon' => 'px',
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					),
					'col' => array(
						'type' => 'spinner',
						'title' => esc_html__('Columns', 'creatus'),
						'addon' => 'px',
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					),
					'sec' => array(
						'type' => 'spinner',
						'title' => esc_html__('Sections', 'creatus'),
						'addon' => 'X',
						'min' => 0,
						'step' => 0.5,
					),
				)
			),
			'bs' => array(
				'type' => 'thz-multi-options',
				'label' => __('Blocks spacings', 'creatus'),
				'desc' => esc_html__('Adjust .thz-block-spacer spacing', 'creatus'),
				'help' => esc_html__('This is spacing for .thz-block-spacer. These containers surround content and left/right sidebars.', 'creatus'),
				'value' => array(
					't' => 60,
					'b' => 60,
					'h' => 60,
					
				),
				'thz_options' => array(
					't' => array(
						'type' => 'spinner',
						'title' => esc_html__('Top', 'creatus'),
						'addon' => 'px',
						'min' => 0,
						'max' => 1000,
						'step' => 1
					),
					'b' => array(
						'type' => 'spinner',
						'title' => esc_html__('Bottom', 'creatus'),
						'addon' => 'px',
						'min' => 0,
						'max' => 1000,
						'step' => 1
					),
					'h' => array(
						'type' => 'spinner',
						'title' => esc_html__('Horizontal', 'creatus'),
						'addon' => 'px',
						'min' => 0,
						'max' => 1000,
						'step' => 1
					),
				)
			),

		)
	),
);