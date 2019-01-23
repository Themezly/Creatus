<?php if ( ! defined( 'FW' ) ) die( 'Forbidden' );

$options = array(

	'nav' => array(
		'type' => 'thz-multi-options',
		'label' => __('Navigation metrics', 'creatus') ,
		'desc' => esc_html__('Adjust slider navigation colors and position. See help for more info', 'creatus') ,
		'help' => sprintf(esc_html__('Custom Position expects position absolute CSS values. Examples;%1$sDots vertical right 60px;%1$s set the navigations orientation to Vertical and in positions inputs enter;%1$s 50%% 60px auto auto%1$sDots horizontal bottom 60px;%1$s set the navigations orientation to Horizontal and in positions inputs enter;%1$s auto 0px 60px 0px', 'creatus') , '<br />') ,
		'value' => array(
			'show' => 'inside',
			'style' => 'rings',
			'shadows' => 'active',
			'opacities' => 'active',
			'ring' => '#ffffff',
			'dot' => '#ffffff',
			'idot' => '#ffffff',
			'p' => 'bc',
			't' => 'auto',
			'r' => '0px',
			'b' => '40px',
			'l' => '0px',
			'o' => 'h',
		) ,
		'breakafter' => 'p',
		'thz_options' => array(
			'show' => array(
				'type' => 'select',
				'title' => esc_html__('Mode', 'creatus') ,
				'attr' => array(
					'class' => 'thz-select-switch'
				) ,
				'choices' => array(
					'inside' => array(
						'text' => esc_html__('Show', 'creatus') ,
						'attr' => array(
							'data-enable' => '.dots-mx-parent,.dots-pozswitch-parent,.dots-ringswitch-parent',
							'data-check' =>'.dots-pozswitch,.dots-ringswitch'
						)
					) ,
					'hide' => array(
						'text' => esc_html__('Hide', 'creatus') ,
						'attr' => array(
							'data-disable' => '.dots-mx-parent,.dots-cpoz-parent,.dots-pozswitch-parent,.dots-ringswitch-parent,.dots-ring-parent,.idot-parent',
						)
					),
				)
			),
			
			'style' => array(
				'type' => 'select',
				'title' => esc_html__('Style', 'creatus') ,
				'attr' => array(
					'class' => 'thz-select-switch dots-ringswitch'
				) ,
				'choices' => array(
					'rings' => array(
						'text' => esc_html__('Rings', 'creatus') ,
						'attr' => array(
							'data-enable' => '.dots-ring-parent',
							'data-disable' => '.idot-parent',
						)
					) ,
					'dots' => array(
						'text' => esc_html__('Dots', 'creatus') ,
						'attr' => array(
							'data-enable' => '.idot-parent',
							'data-disable' => '.dots-ring-parent',
						)
					),
					'rectangle' => array(
						'text' => esc_html__('Rectangle', 'creatus') ,
						'attr' => array(
							'data-enable' => '.idot-parent',
							'data-disable' => '.dots-ring-parent',
						)
					),
					'dash' => array(
						'text' => esc_html__('Dash', 'creatus') ,
						'attr' => array(
							'data-enable' => '.idot-parent',
							'data-disable' => '.dots-ring-parent',
						)
					),
				)
			),
			
			'shadows' => array(
				'type' => 'select',
				'title' => esc_html__('Shadows', 'creatus') ,
				'choices' => array(
					'active' => esc_html__('Active', 'creatus'),
					'inactive' => esc_html__('Inactive', 'creatus')
				),
				'attr' => array(
					'class' =>'dots-mx'
				)
			),
			
			'opacities' => array(
				'type' => 'select',
				'title' => esc_html__('Opacities', 'creatus') ,
				'choices' => array(
					'active' => esc_html__('Active', 'creatus'),
					'inactive' => esc_html__('Inactive', 'creatus')
				),
				'attr' => array(
					'class' =>'dots-mx'
				)
			),
			
			'ring' => array(
				'type' => 'color',
				'title' => esc_html__('Ring color', 'creatus') ,
				'box' => true,
				'attr' => array(
					'class' =>'dots-ring'
				)
			) ,
			'dot' => array(
				'type' => 'color',
				'title' => esc_html__('Active color', 'creatus') ,
				'box' => true,
				'attr' => array(
					'class' =>'dots-mx'
				)
			),
			'idot' => array(
				'type' => 'color',
				'title' => esc_html__('Inactive color', 'creatus') ,
				'box' => true,
				'attr' => array(
					'class' =>'idot'
				)
			),
			'p' => array(
				'type' => 'select',
				'title' => esc_html__('Position', 'creatus') ,
				'attr' => array(
					'class' => 'thz-select-switch dots-pozswitch'
				),
				'choices' => array(

					'bl' => array(
						'text' => esc_html__('Bottom left', 'creatus') ,
						'attr' => array(
							'data-disable' => '.dots-cpoz-parent',
						)
					),

					'bc' => array(
						'text' => esc_html__('Bottom center', 'creatus') ,
						'attr' => array(
							'data-disable' => '.dots-cpoz-parent',
						)
					),
					'br' => array(
						'text' => esc_html__('Bottom right', 'creatus') ,
						'attr' => array(
							'data-disable' => '.dots-cpoz-parent',
						)
					),

					'rt' => array(
						'text' => esc_html__('Right top', 'creatus') ,
						'attr' => array(
							'data-disable' => '.dots-cpoz-parent',
						)
					),
					
					'rc' => array(
						'text' => esc_html__('Right center', 'creatus') ,
						'attr' => array(
							'data-disable' => '.dots-cpoz-parent',
						)
					),
					
					'rb' => array(
						'text' => esc_html__('Right bottom', 'creatus') ,
						'attr' => array(
							'data-disable' => '.dots-cpoz-parent',
						)
					),
					
					'lt' => array(
						'text' => esc_html__('Left top', 'creatus') ,
						'attr' => array(
							'data-disable' => '.dots-cpoz-parent',
						)
					),
					
					'lc' => array(
						'text' => esc_html__('Left center', 'creatus') ,
						'attr' => array(
							'data-disable' => '.dots-cpoz-parent',
						)
					),
					
					'lb' => array(
						'text' => esc_html__('Left bottom', 'creatus') ,
						'attr' => array(
							'data-disable' => '.dots-cpoz-parent',
						)
					),
					
					'c' => array(
						'text' => esc_html__('Custom position', 'creatus') ,
						'attr' => array(
							'data-enable' => '.dots-cpoz-parent',
						)
					),
					

				),
			),
			
			't' => array(
				'type' => 'spinner',
				'title' => esc_html__('Top', 'creatus'),
				'addon' =>'px',
				'units' => array('px','%','auto'),
				'attr' => array(
					'class' => 'dots-cpoz'
				)
			),
			'r' => array(
				'type' => 'spinner',
				'title' => esc_html__('Right', 'creatus'),
				'addon' =>'px',
				'units' => array('px','%','auto'),
				'attr' => array(
					'class' => 'dots-cpoz'
				)
			),
			'b' => array(
				'type' => 'spinner',
				'title' => esc_html__('Bottom', 'creatus'),
				'addon' =>'px',
				'units' => array('px','%','auto'),
				'attr' => array(
					'class' => 'dots-cpoz'
				)
			),
			'l' => array(
				'type' => 'spinner',
				'title' => esc_html__('Left', 'creatus'),
				'addon' =>'px',
				'units' => array('px','%','auto'),
				'attr' => array(
					'class' => 'dots-cpoz'
				)
			),
			'o' => array(
				'type' => 'short-select',
				'title' => esc_html__('Orientation', 'creatus') ,
				'choices' => array(
					'h' => esc_html__('Horizontal', 'creatus') ,
					'v' => esc_html__('Vertical', 'creatus') ,
				),
				'attr' => array(
					'class' =>'dots-cpoz'
				)
			),
		) ,
	) ,
	'arr' => array(
		'type' => 'thz-multi-options',
		'label' => __('Arrows metrics', 'creatus') ,
		'desc' => esc_html__('Adjust slider navigation arrows colors, shape and size.', 'creatus') ,
		'value' => array(
			'show' => 'show',
			'color' => '#ffffff',
			'size' => 22,
			'shapetype' => 'rounded',
			'shapesize' => 40,
			'shapebg' => '',
		) ,
		'thz_options' => array(
			'show' => array(
				'type' => 'select',
				'title' => esc_html__('Mode', 'creatus') ,
				'attr' => array(
					'class' => 'thz-select-switch'
				) ,
				'choices' => array(
					'show' => array(
						'text' => esc_html__('Show', 'creatus') ,
						'attr' => array(
							'data-enable' => '.arr-mx-parent',
						)
					) ,
					'hide' => array(
						'text' => esc_html__('Hide', 'creatus') ,
						'attr' => array(
							'data-disable' => '.arr-mx-parent'
						)
					) ,
				)
			) ,
			'color' => array(
				'type' => 'color',
				'title' => esc_html__('Arrows color', 'creatus') ,
				'box' => true,
				'attr' => array(
					'class' =>'arr-mx'
				)
			) ,
			'size' => array(
				'type' => 'spinner',
				'title' => esc_html__('Arrows size', 'creatus') ,
				'addon' => 'px',
				'min' => 0,
				'attr' => array(
					'class' =>'arr-mx'
				)
			),
			'shapetype' => array(
				'type' => 'short-select',
				'title' => esc_html__('Shape type', 'creatus') ,
				'choices' => array(
					'square' => esc_html__('Square', 'creatus'),
					'rounded' => esc_html__('Rounded', 'creatus'),
					'circle' => esc_html__('Circle', 'creatus'),
				),
				'attr' => array(
					'class' =>'arr-mx'
				)
			),
			'shapesize' => array(
				'type' => 'spinner',
				'title' => esc_html__('Shape size', 'creatus') ,
				'addon' => 'px',
				'min' => 0,
				'attr' => array(
					'class' =>'arr-mx'
				)
			),
			'shapebg' => array(
				'type' => 'color',
				'title' => esc_html__('Shape color', 'creatus') ,
				'box' => true,
				'attr' => array(
					'class' =>'arr-mx'
				)
			) ,
		) ,
	) ,

);