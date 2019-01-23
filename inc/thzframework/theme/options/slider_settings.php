<?php
if (!defined('FW'))
    die('Forbidden');

$options = array(
    
    'slider' => array(
        'type' => 'thz-multi-options',
        'label' => __('Slider layout', 'creatus'),
        'desc' => esc_html__('Adjust slider layout', 'creatus'),
        'help' => esc_html__('If slides are centered the Side space setting is going to show that portion in pixels of the left and right slide. This space should be minimum double the Slides space. Note that Ininite option in Slider animation settings must be set to Yes in order to center the slider in the middle of the page. By default SlickSlider places overflow:hidden on .slick-list, the List overflow option can remove this if you need it.', 'creatus'),
        'value' => array(
            'show' => 3,
            'scroll' => 3,
            'space' => 30,
            'center' => 0,
            'cspace' => 60,
            'listov' => 'hidden'
        ),
        'thz_options' => array(
            'show' => array(
                'type' => 'spinner',
                'title' => esc_html__('Slides to show', 'creatus'),
                'addon' => '#',
                'min' => 1
            ),
            'scroll' => array(
                'type' => 'spinner',
                'title' => esc_html__('Slides to scroll', 'creatus'),
                'addon' => '#',
                'min' => 1,
                'attr' => array(
                    'class' => 'slides-scroll'
                )
            ),
            'space' => array(
                'type' => 'spinner',
                'title' => esc_html__('Slides space', 'creatus'),
                'addon' => 'px',
                'min' => 0
            ),
            'center' => array(
                'type' => 'short-select',
                'title' => esc_html__('Center slides', 'creatus'),
                'attr' => array(
                    'class' => 'thz-select-switch'
                ),
                'choices' => array(
                    0 => array(
                        'text' => esc_html__('Do not center', 'creatus'),
                        'attr' => array(
                            'data-enable' => '.slides-scroll-parent',
                            'data-disable' => '.center-space-parent'
                        )
                    ),
                    1 => array(
                        'text' => esc_html__('Center', 'creatus'),
                        'attr' => array(
                            'data-enable' => '.center-space-parent',
                            'data-disable' => '.slides-scroll-parent'
                        )
                    )
                )
            ),
            'cspace' => array(
                'type' => 'spinner',
                'title' => esc_html__('Side space', 'creatus'),
                'addon' => 'px',
                'min' => 0,
                'attr' => array(
                    'class' => 'center-space'
                )
            ),
            'listov' => array(
                'type' => 'short-select',
                'title' => esc_html__('List overflow', 'creatus'),
                'choices' => array(
                    'hidden' => esc_html__('Hidden', 'creatus'),
                    'visible' => esc_html__('Visible', 'creatus')
                )
            )
        )
    ),
    'san' => array(
        'type' => 'thz-multi-options',
        'label' => __('Slider animation', 'creatus'),
        'desc' => esc_html__('Adjust slider. Hover over help icon for more info.', 'creatus'),
        'help' => sprintf(esc_html__('Speed: Slide animation speed%1$sAuto slide: If set to Yes, slider will start on page load%1$sAuto time: Time till next slide transition%1$sVertical: If reverse is selected items slide from top to bottom%1$sFade; Fade mode is disabled if Slides to show option value is more than 1 or Vertical is set to Yes or Reverse.%1$sInfinite: If set to Yes, slides will loop infinitely%1$s1000ms = 1s', 'creatus'), '<br />'),
        'value' => array(
            'speed' => 300,
            'autoplay' => 0,
			'autodir' => 'default',
			'pauseonhover' => 1,
            'autoplayspeed' => 3000,
			'cssease' => 'ease-in-out',
            'vertical' => 0,
            'fade' => 0,
            'infinite' => 1
        ),
        'thz_options' => array(
            'speed' => array(
                'type' => 'spinner',
                'title' => esc_html__('Speed', 'creatus'),
                'addon' => 'ms',
                'min' => 0,
                'step' => 50,
            ),
            'autoplay' => array(
                'type' => 'select',
                'title' => esc_html__('Auto slide', 'creatus'),
                'attr' => array(
                    'class' => 'thz-select-switch slop-auto-slide'
                ),
                'choices' => array(
                    0 => array(
                        'text' => esc_html__('No', 'creatus'),
                        'attr' => array(
                            'data-disable' => '.slop-auto-play-parent,.slop-auto-dir-parent'
                        )
                    ),
                    1 => array(
                        'text' => esc_html__('Yes', 'creatus'),
                        'attr' => array(
                            'data-enable' => '.slop-auto-play-parent,.slop-auto-dir-parent',
                        )
                    )
                )
            ),
            'autodir' => array(
                'type' => 'select',
                'title' => esc_html__('Direction', 'creatus'),
                'attr' => array(
                    'class' => 'slop-auto-dir'
                ),
                'choices' => array(
                    'default' => esc_html__('Default', 'creatus'),
                    'reverse' => esc_html__('Reverse', 'creatus')
                )
            ),
            'autoplayspeed' => array(
                'type' => 'spinner',
                'attr' => array(
                    'class' => 'slop-auto-play'
                ),
                'title' => esc_html__('Auto time', 'creatus'),
                'addon' => 'ms',
                'min' => 0,
                'step' => 50,
            ),
            'pauseonhover' => array(
                'type' => 'select',
                'title' => esc_html__('Pause on hover', 'creatus'),
                'attr' => array(
                    'class' => 'slop-auto-play'
                ),
                'choices' => array(
                    0 => esc_html__('No', 'creatus'),
                    1 => esc_html__('Yes', 'creatus')
                )
            ),
            'cssease' => array(
                'type' => 'short-select',
                'title' => esc_html__('Easing', 'creatus'),
                'choices' => array(
                    'linear' => esc_html__('linear', 'creatus'),
					'ease' => esc_html__('ease', 'creatus'),
					'ease-in' => esc_html__('ease-in', 'creatus'),
					'ease-out' => esc_html__('ease-out', 'creatus'),
					'ease-in-out' => esc_html__('ease-in-out', 'creatus'),
                )
            ),
            'vertical' => array(
                'type' => 'select',
                'title' => esc_html__('Vertical', 'creatus'),
                'attr' => array(
                    'class' => 'thz-select-switch slop-vertical'
                ),
                'choices' => array(
                    0 => array(
                        'text' => esc_html__('No', 'creatus'),
                        'attr' => array(
                            'data-enable' => '.slop-fade-parent',
							'data-check' => '.slop-auto-slide'
                        )
                    ),
                    1 => array(
                        'text' => esc_html__('Yes', 'creatus'),
                        'attr' => array(
                            'data-disable' => '.slop-fade-parent,.slop-auto-dir-parent'
                        )
                    ),
                    2 => array(
                        'text' => esc_html__('Reverse', 'creatus'),
                        'attr' => array(
                            'data-disable' => '.slop-fade-parent,.slop-auto-dir-parent'
                        )
                    )
                )
            ),
            'fade' => array(
                'type' => 'select',
                'title' => esc_html__('Fade', 'creatus'),
                'attr' => array(
                    'class' => 'slop-fade'
                ),
                'choices' => array(
                    0 => esc_html__('No', 'creatus'),
                    1 => esc_html__('Yes', 'creatus')
                )
            ),
            'infinite' => array(
                'type' => 'select',
                'title' => esc_html__('Infinite', 'creatus'),
                'choices' => array(
                    0 => esc_html__('No', 'creatus'),
                    1 => esc_html__('Yes', 'creatus')
                )
            )
        )
    ),
    
    'nav' => array(
        'type' => 'thz-multi-options',
        'label' => __('Navigation metrics', 'creatus'),
        'desc' => esc_html__('Adjust slider navigation colors and position. See help for more info', 'creatus'),
        'help' => sprintf(esc_html__('Custom Position expects position absolute CSS values. Examples;%1$sDots vertical right 60px;%1$s set the navigations orientation to Vertical and in positions inputs enter;%1$s 50%% 60px auto auto%1$sDots horizontal bottom 60px;%1$s set the navigations orientation to Horizontal and in positions inputs enter;%1$s auto 0px 60px 0px', 'creatus'), '<br />'),
        'value' => array(
            'show' => 'outside',
            'style' => 'dots',
            'shadows' => 'active',
            'opacities' => 'active',
            'ring' => '#ffffff',
            'dot' => '#000000',
            'idot' => '#000000',
            'p' => 'bc',
            't' => 'auto',
            'r' => '0px',
            'b' => '40px',
            'l' => '0px',
            'o' => 'h'
        ),
        'breakafter' => 'p',
        'thz_options' => array(
            'show' => array(
                'type' => 'select',
                'title' => esc_html__('Mode', 'creatus'),
                'attr' => array(
                    'class' => 'thz-select-switch'
                ),
                'choices' => array(
                    'outside' => array(
                        'text' => esc_html__('Outside', 'creatus'),
                        'attr' => array(
                            'data-enable' => '.dots-mx-parent,.dots-pozswitch-parent,.dots-ringswitch-parent',
                            'data-check' => '.dots-pozswitch,.dots-ringswitch'
                        )
                    ),
                    'inside' => array(
                        'text' => esc_html__('Inside', 'creatus'),
                        'attr' => array(
                            'data-enable' => '.dots-mx-parent,.dots-pozswitch-parent,.dots-ringswitch-parent',
                            'data-check' => '.dots-pozswitch,.dots-ringswitch'
                        )
                    ),
                    'hide' => array(
                        'text' => esc_html__('Hide', 'creatus'),
                        'attr' => array(
                            'data-disable' => '.dots-mx-parent,.dots-cpoz-parent,.dots-pozswitch-parent,.dots-ringswitch-parent,.dots-ring-parent,.idot-parent'
                        )
                    )
                )
            ),
            
            'style' => array(
                'type' => 'select',
                'title' => esc_html__('Style', 'creatus'),
                'attr' => array(
                    'class' => 'thz-select-switch dots-ringswitch'
                ),
                'choices' => array(
                    'rings' => array(
                        'text' => esc_html__('Rings', 'creatus'),
                        'attr' => array(
                            'data-enable' => '.dots-ring-parent',
                            'data-disable' => '.idot-parent'
                        )
                    ),
                    'dots' => array(
                        'text' => esc_html__('Dots', 'creatus'),
                        'attr' => array(
                            'data-enable' => '.idot-parent',
                            'data-disable' => '.dots-ring-parent'
                        )
                    ),
                    'rectangle' => array(
                        'text' => esc_html__('Rectangle', 'creatus'),
                        'attr' => array(
                            'data-enable' => '.idot-parent',
                            'data-disable' => '.dots-ring-parent'
                        )
                    ),
                    'dash' => array(
                        'text' => esc_html__('Dash', 'creatus'),
                        'attr' => array(
                            'data-enable' => '.idot-parent',
                            'data-disable' => '.dots-ring-parent'
                        )
                    )
                )
            ),
            
            'shadows' => array(
                'type' => 'select',
                'title' => esc_html__('Shadows', 'creatus'),
                'choices' => array(
                    'active' => esc_html__('Active', 'creatus'),
                    'inactive' => esc_html__('Inactive', 'creatus')
                ),
                'attr' => array(
                    'class' => 'dots-mx'
                )
            ),
            
            'opacities' => array(
                'type' => 'select',
                'title' => esc_html__('Opacities', 'creatus'),
                'choices' => array(
                    'active' => esc_html__('Active', 'creatus'),
                    'inactive' => esc_html__('Inactive', 'creatus')
                ),
                'attr' => array(
                    'class' => 'dots-mx'
                )
            ),
            
            'ring' => array(
                'type' => 'color',
                'title' => esc_html__('Ring color', 'creatus'),
                'box' => true,
                'attr' => array(
                    'class' => 'dots-ring'
                )
            ),
            'dot' => array(
                'type' => 'color',
                'title' => esc_html__('Active color', 'creatus'),
                'box' => true,
                'attr' => array(
                    'class' => 'dots-mx'
                )
            ),
            'idot' => array(
                'type' => 'color',
                'title' => esc_html__('Inactive color', 'creatus'),
                'box' => true,
                'attr' => array(
                    'class' => 'idot'
                )
            ),
            'p' => array(
                'type' => 'select',
                'title' => esc_html__('Position', 'creatus'),
                'attr' => array(
                    'class' => 'thz-select-switch dots-pozswitch'
                ),
                'choices' => array(
                    
                    'bl' => array(
                        'text' => esc_html__('Bottom left', 'creatus'),
                        'attr' => array(
                            'data-disable' => '.dots-cpoz-parent'
                        )
                    ),
                    
                    'bc' => array(
                        'text' => esc_html__('Bottom center', 'creatus'),
                        'attr' => array(
                            'data-disable' => '.dots-cpoz-parent'
                        )
                    ),
                    'br' => array(
                        'text' => esc_html__('Bottom right', 'creatus'),
                        'attr' => array(
                            'data-disable' => '.dots-cpoz-parent'
                        )
                    ),
                    
                    'rt' => array(
                        'text' => esc_html__('Right top', 'creatus'),
                        'attr' => array(
                            'data-disable' => '.dots-cpoz-parent'
                        )
                    ),
                    
                    'rc' => array(
                        'text' => esc_html__('Right center', 'creatus'),
                        'attr' => array(
                            'data-disable' => '.dots-cpoz-parent'
                        )
                    ),
                    
                    'rb' => array(
                        'text' => esc_html__('Right bottom', 'creatus'),
                        'attr' => array(
                            'data-disable' => '.dots-cpoz-parent'
                        )
                    ),
                    
                    'lt' => array(
                        'text' => esc_html__('Left top', 'creatus'),
                        'attr' => array(
                            'data-disable' => '.dots-cpoz-parent'
                        )
                    ),
                    
                    'lc' => array(
                        'text' => esc_html__('Left center', 'creatus'),
                        'attr' => array(
                            'data-disable' => '.dots-cpoz-parent'
                        )
                    ),
                    
                    'lb' => array(
                        'text' => esc_html__('Left bottom', 'creatus'),
                        'attr' => array(
                            'data-disable' => '.dots-cpoz-parent'
                        )
                    ),
                    
                    'c' => array(
                        'text' => esc_html__('Custom position', 'creatus'),
                        'attr' => array(
                            'data-enable' => '.dots-cpoz-parent'
                        )
                    )
                    
                    
                )
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
                'title' => esc_html__('Orientation', 'creatus'),
                'choices' => array(
                    'h' => esc_html__('Horizontal', 'creatus'),
                    'v' => esc_html__('Vertical', 'creatus')
                ),
                'attr' => array(
                    'class' => 'dots-cpoz'
                )
            )
        )
    ),
    'arr' => array(
        'type' => 'thz-multi-options',
        'label' => __('Arrows metrics', 'creatus'),
        'desc' => esc_html__('Adjust slider navigation arrows colors, shape and size.', 'creatus'),
        'value' => array(
            'show' => 'hide',
            'color' => '#ffffff',
            'size' => 22,
            'shapetype' => 'rounded',
            'shapesize' => 40,
            'shapebg' => ''
        ),
        'thz_options' => array(
            'show' => array(
                'type' => 'select',
                'title' => esc_html__('Mode', 'creatus'),
                'attr' => array(
                    'class' => 'thz-select-switch'
                ),
                'choices' => array(
                    'show' => array(
                        'text' => esc_html__('Show', 'creatus'),
                        'attr' => array(
                            'data-enable' => '.arr-mx-parent'
                        )
                    ),
                    'hide' => array(
                        'text' => esc_html__('Hide', 'creatus'),
                        'attr' => array(
                            'data-disable' => '.arr-mx-parent'
                        )
                    )
                )
            ),
            'color' => array(
                'type' => 'color',
                'title' => esc_html__('Arrows color', 'creatus'),
                'box' => true,
                'attr' => array(
                    'class' => 'arr-mx'
                )
            ),
            'size' => array(
                'type' => 'spinner',
                'title' => esc_html__('Arrows size', 'creatus'),
                'addon' => 'px',
                'min' => 0,
                'attr' => array(
                    'class' => 'arr-mx'
                )
            ),
            'shapetype' => array(
                'type' => 'short-select',
                'title' => esc_html__('Shape type', 'creatus'),
                'choices' => array(
                    'square' => esc_html__('Square', 'creatus'),
                    'rounded' => esc_html__('Rounded', 'creatus'),
                    'circle' => esc_html__('Circle', 'creatus')
                ),
                'attr' => array(
                    'class' => 'arr-mx'
                )
            ),
            'shapesize' => array(
                'type' => 'spinner',
                'title' => esc_html__('Shape size', 'creatus'),
                'addon' => 'px',
                'min' => 0,
                'attr' => array(
                    'class' => 'arr-mx'
                )
            ),
            'shapebg' => array(
                'type' => 'color',
                'title' => esc_html__('Shape color', 'creatus'),
                'box' => true,
                'attr' => array(
                    'class' => 'arr-mx'
                )
            )
        )
    ),
    
    
    
    'slbp' => array(
        'type' => 'addable-popup',
        'label' => __('Custom breakpoints', 'creatus'),
        'desc' => __('Add custom slider settings for specific breakpoints.', 'creatus'),
        'popup-title' => esc_html__('Add/Edit Breakpoint', 'creatus'),
        'template' => 'Breakpoint for {{- b.breakpoint }} px',
        'add-button-text' => esc_html__('Add/Edit breakpoint', 'creatus'),
        'size' => 'large',
        'sortable' => false,
        'popup-options' => array(
            'b' => array(
                'type' => 'thz-multi-options',
                'label' => __('Slider layout', 'creatus'),
                'desc' => esc_html__('Adjust slider layout for this breakpoint', 'creatus'),
                'help' => esc_html__('If slides are centered the Side space setting is going to show that portion in pixels of the left and right slide. This space should be minimum double the Slides space. Note that Ininite option in Slider animation settings must be set to Yes in order to center the slider in the middle of the page.', 'creatus'),
                'value' => array(
                    'breakpoint' => 979,
                    'show' => 1,
                    'scroll' => 1,
                    'space' => 0,
                    'center' => 0,
                    'cspace' => 0
                ),
                'breakafter' => 'breakpoint',
                'thz_options' => array(
                    'breakpoint' => array(
                        'type' => 'spinner',
                        'title' => esc_html__('Breakpoint', 'creatus'),
                        'addon' => 'px'
                    ),
                    'show' => array(
                        'type' => 'spinner',
                        'title' => esc_html__('Slides to show', 'creatus'),
                        'addon' => '#',
                        'min' => 1
                    ),
                    'scroll' => array(
                        'type' => 'spinner',
                        'title' => esc_html__('Slides to scroll', 'creatus'),
                        'addon' => '#',
                        'min' => 1,
                        'attr' => array(
                            'class' => 'bp-slides-scroll'
                        )
                    ),
                    'space' => array(
                        'type' => 'spinner',
                        'title' => esc_html__('Slides space', 'creatus'),
                        'addon' => 'px',
                        'min' => 0
                    ),
                    'center' => array(
                        'type' => 'short-select',
                        'title' => esc_html__('Center slides', 'creatus'),
                        'attr' => array(
                            'class' => 'thz-select-switch'
                        ),
                        'choices' => array(
                            0 => array(
                                'text' => esc_html__('Do not center', 'creatus'),
                                'attr' => array(
                                    'data-enable' => '.bp-slides-scroll-parent',
                                    'data-disable' => '.bp-center-space-parent'
                                )
                            ),
                            1 => array(
                                'text' => esc_html__('Center', 'creatus'),
                                'attr' => array(
                                    'data-enable' => '.bp-center-space-parent',
                                    'data-disable' => '.bp-slides-scroll-parent'
                                )
                            )
                        )
                    ),
                    'cspace' => array(
                        'type' => 'spinner',
                        'title' => esc_html__('Side space', 'creatus'),
                        'addon' => 'px',
                        'min' => 0,
                        'attr' => array(
                            'class' => 'bp-center-space'
                        )
                    )
                )
            )
        )
    )
);