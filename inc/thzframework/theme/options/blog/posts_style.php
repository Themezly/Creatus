<?php
if (!defined('FW')) {
	die('Forbidden');
}
$options = array(
	'posts_style' => array(
		'type' => 'popup',
		'size' => 'large',
		'label' => __('Posts style', 'creatus'),
		'desc' => esc_html__('Customize posts layout and feel', 'creatus'),
		'button' => esc_html__('Edit posts style', 'creatus'),
		'popup-title' => esc_html__('Posts style settings', 'creatus'),
		'popup-options' => array(
						
			'tabboxsettings' => array(
				'title' => __('General', 'creatus'),
				'type' => 'tab',
				'options' => array(
					'holder_box_style' => array(
						'type' => 'thz-box-style',
						'label' => __('Holder box style', 'creatus'),
						'preview' => true,
						'button-text' => esc_html__('Customize holder box style', 'creatus'),
						'desc' => esc_html__('Adjust .thz-grid-item-in box style', 'creatus'),
						'popup' => true,
						'disable' => array('layout','padding','margin','video','boxsize','transform'),
						'value' => array(
							'background' => array(
								'type' => 'color',
								'color' => '#ffffff',
							),
							'boxshadow' => array(
								1 => array(
									'inset' => false,
									'horizontal-offset' => 0,
									'vertical-offset' => 4,
									'blur-radius' => 28,
									'spread-radius' => 0,
									'shadow-color' =>'rgba(0, 0, 0, 0.08)'
								)
							),
						)
					),
					'intro_bs' => array(
						'type' => 'thz-box-style',
						'label' => __('Intro box style', 'creatus'),
						'preview' => true,
						'button-text' => esc_html__('Customize intro box style', 'creatus'),
						'desc' => esc_html__('Adjust .thz-grid-item-intro box style', 'creatus'),
						'popup' => true,
						'disable' => array('layout','video','image','boxsize','transform'),
						'value' => array(
							'padding' => array(
								'top' => 45,
								'right' => 45,
								'bottom' => 45,
								'left' => 45
							),
						),
						'units' => array(
							'borderradius',
							'padding',
							'margin',
						),
					),
					'media_bs' => array(
						'type' => 'thz-box-style',
						'label' => __('Media box style', 'creatus'),
						'desc' => esc_html__('Adjust .thz-grid-item-media box style. This box holds image, slider or video', 'creatus'),
						'popup' => true,
						'button-text' => esc_html__('Customize media box style', 'creatus'),
						'disable' => array('layout','boxsize','background','transform'),
						'value' => array(),
						'units' => array(
							'borderradius',
							'padding',
							'margin',
						),
					),			
					'hmx' => array(
						'type' => 'thz-multi-options',
						'label' => __('Holder metrics', 'creatus'),
						'desc' => esc_html__('Adjust text alignment and media container visibility', 'creatus'),
						'value' => array(
							'media' => 'show',
							'align' => 'thz-align-left',
						),
						'thz_options' => array(
							'media' => array(
								'title' => esc_html__('Post media', 'creatus'),
								'type' => 'short-select',
								'attr' => array(
									'class' => 'thz-select-switch'
								),
								'choices' => array(
									'show' => array(
										'text' => esc_html__('Show', 'creatus'),
										'attr' => array(
											'data-enable' => 'media_bs,.thz-tab-media-settings,.thz-tab-icon-settings'
										)
									),
									'hide' => array(
										'text' => esc_html__('Hide', 'creatus'),
										'attr' => array(
											'data-disable' => 'media_bs,.thz-tab-media-settings,.thz-tab-icon-settings'
										)
									)
								)
							),
							'align' => array(
								'type' => 'short-select',
								'title' => esc_html__('Text align', 'creatus'),
								'choices' => array(
									'thz-align-left' => esc_html__('Left', 'creatus'),
									'thz-align-right' => esc_html__('Right', 'creatus'),
									'thz-align-center' => esc_html__('Center', 'creatus')
								)
							),
		
				
						),
					
					),			
					'sep' => array(
						'type' => 'thz-multi-options',
						'label' => __('Elements separator', 'creatus'),
						'desc' => esc_html__('Select meta/footer elements separator. See help for more info.', 'creatus'),
						'help' => esc_html__('This option will let you adjust space between separator and elements. Nudge option can help you align the separator verticaly. This can come in handy if separator is icon and icon font does not place the icon in absolute vertical middle. Nudge moves relative top position of the separator.', 'creatus'),			
						'value' => array(
							'ty' => 'textual',
							't' => '|',
							'i' => 'thzicon thzicon-primitive-dot',
							'fs' => '',
							's' => 5,
							'n' => 0,
						),
						'thz_options' => array(
							'ty' => array(
								'title' => esc_html__('Type', 'creatus'),
								'type' => 'short-select',
								'value' => 'show',
								'attr' => array(
									'class' => 'thz-select-switch'
								),
								'choices' => array(
									'textual' => array(
										'text' => esc_html__('Textual', 'creatus'),
										'attr' => array(
											'data-enable' => '.post_sep-text-parent',
											'data-disable' => '.post_sep-icon-parent',
											
										)
									),
									'icon' => array(
										'text' => esc_html__('Icon', 'creatus'),
										'attr' => array(
											'data-enable' => '.post_sep-icon-parent',
											'data-disable' => '.post_sep-text-parent',
											
										)
									),
								)
							),
							't' => array(
								'type' => 'short-text',
								'title' => esc_html__('Separator', 'creatus'),
								'attr' => array(
									'class' => 'post_sep-text'
								),
							),
							'i' => array(
								'type' => 'icon',
								'title' => esc_html__('Icon', 'creatus'),
								'attr' => array(
									'class' => 'post_sep-icon'
								),
							),
							'fs' => array(
								'type' => 'spinner',
								'title' => esc_html__('Size', 'creatus'),
								'addon' => 'px',
								'min' => 0,
								'max' => 100
							),
							's' => array(
								'type' => 'spinner',
								'title' => esc_html__('Space', 'creatus'),
								'addon' => 'px',
								'max' => 100,
							),
							'n' => array(
								'type' => 'spinner',
								'title' => esc_html__('Nudge icon', 'creatus'),
								'addon' => 'px',
								'min' => -20,
								'max' => 20,
							),		
						)
					),
		
				)
			),
			'tabmediasettings' => array(
				'title' => __('Media', 'creatus'),
				'type' => 'tab',
				'li-attr' => array(
					'class' => 'thz-tab-media-settings'
				),
				'options' => array(
					'media_height' => array(
						'type' => 'multi-picker',
						'label' => false,
						'desc' => false,
						'picker' => array(
							'picked' => array(
								'label' => __('Media container height', 'creatus'),
								'desc' => esc_html__('Set media container height.', 'creatus'),
								'type' => 'select',
								'value' => 'thz-ratio-16-9',
								'choices' => array(
									array( // optgroup
										'attr' => array(
											'label' => __('Misc', 'creatus')
										),
										'choices' => array(
											'auto' => esc_html__('Auto', 'creatus'),
											'custom' => esc_html__('Custom', 'creatus')
										)
									),
									array( // optgroup
										'attr' => array(
											'label' => __('Square', 'creatus')
										),
										'choices' => array(
											'thz-ratio-1-1' => esc_html__('Aspect ratio 1:1', 'creatus')
										)
									),
									array( // optgroup
										'attr' => array(
											'label' => __('Landscape', 'creatus')
										),
										'choices' => array(
											'thz-ratio-2-1' => esc_html__('Aspect ratio 2:1', 'creatus'),
											'thz-ratio-3-2' => esc_html__('Aspect ratio 3:2', 'creatus'),
											'thz-ratio-4-3' => esc_html__('Aspect ratio 4:3', 'creatus'),
											'thz-ratio-16-9' => esc_html__('Aspect ratio 16:9', 'creatus'),
											'thz-ratio-21-9' => esc_html__('Aspect ratio 21:9', 'creatus')
										)
									),
									array( // optgroup
										'attr' => array(
											'label' => __('Portrait', 'creatus')
										),
										'choices' => array(
											'thz-ratio-1-2' => esc_html__('Aspect ratio 1:2', 'creatus'),
											'thz-ratio-3-4' => esc_html__('Aspect ratio 3:4', 'creatus'),
											'thz-ratio-2-3' => esc_html__('Aspect ratio 2:3', 'creatus'),
											'thz-ratio-9-16' => esc_html__('Aspect ratio 9:16', 'creatus')
										)
									)
								)
							)
						),
						'choices' => array(
							'custom' => array(
								'height' => array(
									'type' => 'thz-spinner',
									'addon' => 'px',
									'min' => 0,
									'label' => '',
									'value' => 350,
									'desc' => esc_html__('Media container height. ', 'creatus')
								)
							)
						)
					),
					'image_size' => array(
						'label' => __('Post image size', 'creatus'),
						'desc' => esc_html__('Select the image size to be used in posts.', 'creatus'),
						'value' => 'medium_large',
						'type' => 'short-select',
						'choices' => thz_get_image_sizes_list()
					),
					'use_poster' => array(
						'label' => __('Media posters', 'creatus'),
						'desc' => esc_html__('Activate media posters for all media types except images. See help for more info. ', 'creatus'),
						'help' => esc_html__('If this option is inactive, all videos and iframes load on pageload and increase page load time. This option adds a preview poster which than activates the media on click. ', 'creatus'),
						'type' => 'switch',
						'right-choice' => array(
							'value' => 'inactive',
							'label' => __('Inactive', 'creatus')
						),
						'left-choice' => array(
							'value' => 'active',
							'label' => __('Active', 'creatus')
						),
						'value' => 'active'
					),
					'slider' => array(
						'type' => 'thz-multi-options',
						'label' => __('Media slider layout', 'creatus'),
						'desc' => esc_html__('Adjust media slider layout. See help for more info', 'creatus'),
						'help' => esc_html__('Every post can have multiple media thus creating posts media slider, the Slides option can show only first slide instead which would also increase the site speed. Note that Gallery post format will always display all slides.', 'creatus'),
						'value' => array(
							'showall' => 'all',
							'show' => '1',
							'scroll' => '1',
							'space' => '0',
							'dots' => 'inside',
							'arrows' => 'show'
						),
						'thz_options' => array(
							'showall' => array(
								'type' => 'short-select',
								'title' => esc_html__('Slides', 'creatus'),
								'attr' => array(
									'class' => 'thz-select-switch'
								),
								'value' => 'grid',
								'choices' => array(
									'all' => array(
										'text' => esc_html__('Show all', 'creatus'),
										'attr' => array(
											'data-enable' => '.show-tz-all-parent,slider_a',
										)
									),
									'first' => array(
										'text' => esc_html__('Show only first', 'creatus'),
										'attr' => array(
											'data-disable' => '.show-tz-all-parent,slider_a',
										)
									)
								)
							),
							'show' => array(
								'type' => 'select',
								'title' => esc_html__('Slides to show', 'creatus'),
								'choices' => array(
									'1' => esc_html__('1', 'creatus'),
									'2' => esc_html__('2', 'creatus'),
									'3' => esc_html__('3', 'creatus'),
									'4' => esc_html__('4', 'creatus'),
									'5' => esc_html__('5', 'creatus'),
									'6' => esc_html__('6', 'creatus')
								),
								'attr' => array(
									'class' => 'show-tz-all'
								),
							),
							'scroll' => array(
								'type' => 'select',
								'title' => esc_html__('Slides to scroll', 'creatus'),
								'choices' => array(
									'1' => esc_html__('1', 'creatus'),
									'2' => esc_html__('2', 'creatus'),
									'3' => esc_html__('3', 'creatus'),
									'4' => esc_html__('4', 'creatus'),
									'5' => esc_html__('5', 'creatus'),
									'6' => esc_html__('6', 'creatus')
								),
								'attr' => array(
									'class' => 'show-tz-all'
								),
							),
							'space' => array(
								'type' => 'spinner',
								'title' => esc_html__('Slides space', 'creatus'),
								'addon' => 'px',
								'min' => 0,
								'attr' => array(
									'class' => 'show-tz-all'
								),
							),
							'dots' => array(
								'type' => 'short-select',
								'title' => esc_html__('Navigation dots', 'creatus'),
								'choices' => array(
									'hide' => esc_html__('Hide', 'creatus'),
									'inside' => esc_html__('Inside', 'creatus'),
									'outside' => esc_html__('Outside', 'creatus')
								),
								'attr' => array(
									'class' => 'show-tz-all'
								),
							),
							'arrows' => array(
								'type' => 'short-select',
								'title' => esc_html__('Arrows', 'creatus'),
								'choices' => array(
									'hide' => esc_html__('Hide', 'creatus'),
									'show' => esc_html__('Show', 'creatus'),
								),
								'attr' => array(
									'class' => 'show-tz-all'
								),
							)
						)
					),
					'slider_a' => array(
						'type' => 'thz-multi-options',
						'label' => __('Media slider animation', 'creatus'),
						'desc' => esc_html__('Adjust media slider animation. Hover over info icon for details.', 'creatus'),
						'help' => esc_html__('Speed: Slide/Fade animation speed<br />Auto slide: If set to Yes, slider will start on page load<br />Auto time: Time till next slide transition<br />Infinite: If set to Yes, slides will loop infinitely<br />1000ms = 1s', 'creatus'),
						'value' => array(
							'speed' => 300,
							'autoplay' => 0,
							'autoplayspeed' => 3000,
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
								'max' => 1500
							),
							'autoplay' => array(
								'type' => 'select',
								'title' => esc_html__('Auto slide', 'creatus'),
								'choices' => array(
									0 => esc_html__('No', 'creatus'),
									1 => esc_html__('Yes', 'creatus')
								)
							),
							'autoplayspeed' => array(
								'type' => 'spinner',
								'title' => esc_html__('Auto time', 'creatus'),
								'addon' => 'ms',
								'min' => 0,
								'step' => 50,
								'max' => 10000
							),
							'fade' => array(
								'type' => 'select',
								'title' => esc_html__('Fade', 'creatus'),
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
					)
				)
			),
			'tabtitlesettings' => array(
				'title' => __('Title', 'creatus'),
				'type' => 'tab',
				'options' => array(
					'show_title' => array(
						'type' => 'multi-picker',
						'label' => false,
						'desc' => false,
						'show_borders' => true,
						'picker' => array(
							'picked' => array(
								'label' => __('Show title', 'creatus'),
								'desc' => esc_html__('Show/hide title', 'creatus'),
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
						),
						'choices' => array(
							'show' => array(
								'title_bs' => array(
									'type' => 'thz-box-style',
									'label' => __('Title box style', 'creatus'),
									'desc' => esc_html__('Adjust .thz-grid-item-title box style', 'creatus'),
									'button-text' => esc_html__('Customize title box style', 'creatus'),
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
								'title_font' => array(
									'type' => 'thz-typography',
									'label' => __('Title font', 'creatus'),
									'desc' => esc_html__('Adjust item title font.', 'creatus'),
									'value' => array(),
									'cssprint' => true
								),
							)
						)
					)
				)
			),
			'tabmetasettings' => array(
				'title' => __('Meta', 'creatus'),
				'type' => 'tab',
				'options' => array(
					'meta_elements' => array(
						'type' => 'thz-sortable-checks',
						'value' => array(
							'date',
							'author',
							'categories'
						),
						'label' => __('Meta elements', 'creatus'),
						'desc' => esc_html__('Check to show/hide specific post meta elements. Click and drag the label to sort.', 'creatus'),
						'choices' => _thz_meta_choices()
					),
					'meta_pref' => _thz_metas_preferences('meta'),
					'meta_bs' => array(
						'type' => 'thz-box-style',
						'label' => __('Meta box style', 'creatus'),
						'button-text' => esc_html__('Customize meta box style', 'creatus'),
						'desc' => esc_html__('Adjust .thz-grid-item-meta box style', 'creatus'),
						'popup' => true,
						'preview' => true,
						'disable' => array('video'),
						'value' => array(
							'margin' => array(
								'top' => 5,
								'right' => 0,
								'bottom' => 15,
								'left' => 0
							),
						),
						'units' => array(
							'borderradius',
							'boxsize',
							'padding',
							'margin',
						),				
					),
					'meta_font' => array(
						'type' => 'thz-typography',
						'label' => __('Font settings', 'creatus'),
						'desc' => esc_html__('Adjust meta elements fonts.', 'creatus'),
						'value' => array(
							'size' => '0.93em',
						),
						'disable' => array('color','hovered','text-shadow'),
					),
					'meta_colors' => array(
						'type' => 'thz-multi-options',
						'label' => __('Meta colors', 'creatus'),
						'desc' => esc_html__('Adjust meta elements colors', 'creatus'),
						'value' => array(
							'tc' => '',
							'lc' => '',
							'hlc' => '',
							'sep' => ''
						),
						'thz_options' => array(
							'tc' => array(
								'type' => 'color',
								'title' => esc_html__('Text', 'creatus'),
								'box' => true
							),
							'lc' => array(
								'type' => 'color',
								'title' => esc_html__('Link', 'creatus'),
								'box' => true
							),
							'hlc' => array(
								'type' => 'color',
								'title' => esc_html__('Link Hovered', 'creatus'),
								'box' => true
							),
							'sep' => array(
								'type' => 'color',
								'title' => esc_html__('Separator', 'creatus'),
								'box' => true
							)
						)
					)
				)
			),
			'tabfootersettings' => array(
				'title' => __('Footer', 'creatus'),
				'type' => 'tab',
				'options' => array(
					'footer_elements' => array(
						'type' => 'thz-sortable-checks',
						'value' => array(
							'tags',
							'comments'
						),
						'label' => __('Footer elements', 'creatus'),
						'desc' => esc_html__('Check to show/hide specific post footer elements. Click and drag the label to sort.', 'creatus'),
						'choices' => _thz_meta_choices()
					),
					'footer_pref' => _thz_metas_preferences('footer'),
					'footer_bs' => array(
						'type' => 'thz-box-style',
						'label' => __('Footer box style', 'creatus'),
						'button-text' => esc_html__('Customize footer box style', 'creatus'),
						'desc' => esc_html__('Adjust .thz-grid-item-footer box style', 'creatus'),
						'popup' => true,
						'preview' => true,
						'disable' => array('video'),
						'value' => array(
							'padding' => array(
								'top' => 30,
								'right' => 0,
								'bottom' => 0,
								'left' => 0
							),
							'borders' => array(
								'all' => 'separate',
								'top' => array(
									'w' => 1,
									's' => 'solid',
									'c' => 'color_4'
								),
								'right' => array(
									'w' => '',
									's' => 'solid',
									'c' => ''
								),
								'bottom' => array(
									'w' => '',
									's' => 'solid',
									'c' => 'color_4'
								),
								'left' => array(
									'w' => '',
									's' => 'solid',
									'c' => ''
								),
							),
							'margin' => array(
								'top' => 30,
								'right' => 0,
								'bottom' => 0,
								'left' => 0
							),
						),
						'units' => array(
							'borderradius',
							'boxsize',
							'padding',
							'margin',
						),
					),
					'footer_font' => array(
						'type' => 'thz-typography',
						'label' => __('Font settings', 'creatus'),
						'desc' => esc_html__('Adjust footer elements fonts.', 'creatus'),
						'value' => array(
							'size' => '0.93em',
							'transform' => 'capitalize'
						),
						'disable' => array('color','hovered','text-shadow'),
					),
					'footer_colors' => array(
						'type' => 'thz-multi-options',
						'label' => __('Footer colors', 'creatus'),
						'desc' => esc_html__('Adjust footer elements colors', 'creatus'),
						'value' => array(
							'tc' => '',
							'lc' => '',
							'hlc' => '',
							'sep' => ''
						),
						'thz_options' => array(
							'tc' => array(
								'type' => 'color',
								'title' => esc_html__('Text', 'creatus'),
								'box' => true
							),
							'lc' => array(
								'type' => 'color',
								'title' => esc_html__('Link', 'creatus'),
								'box' => true
							),
							'hlc' => array(
								'type' => 'color',
								'title' => esc_html__('Link Hovered', 'creatus'),
								'box' => true
							),
							'sep' => array(
								'type' => 'color',
								'title' => esc_html__('Separator', 'creatus'),
								'box' => true
							)
						)
					)
				)
			),
			'tabintrotxtsettings' => array(
				'title' => __('Intro text', 'creatus'),
				'type' => 'tab',
				'options' => array(
					'show_introtext' => array(
						'type' => 'multi-picker',
						'label' => false,
						'desc' => false,
						'show_borders' => true,
						'picker' => array(
							'picked' => array(
								'label' => __('Show intro text', 'creatus'),
								'desc' => esc_html__('Show/hide intro text (excerpt)', 'creatus'),
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
						),
						'choices' => array(
							'show' => array(
								'intro_length' => array(
									'type' => 'multi-picker',
									'label' => false,
									'desc' => false,
									'picker' => array(
										'picked' => array(
											'label' => __('Intro length limit', 'creatus'),
											'desc' => esc_html__('Set excerpt length limit. No limit displays full post content.', 'creatus'),
											'type' => 'radio',
											'value' => 'chars',
											'choices' => array(
												'words' => esc_html__('By words', 'creatus'),
												'chars' => esc_html__('By characters', 'creatus'),
												'none' => esc_html__('No limit', 'creatus')
											),
											'inline' => true
										)
									),
									'choices' => array(
										'words' => array(
											'limit' => array(
												'type' => 'thz-spinner',
												'label' => __('Number of words', 'creatus'),
												'desc' => esc_html__('Set number of words to show', 'creatus'),
												'addon' => '#',
												'min' => 0,
												'value' => 30
											)
										),
										'chars' => array(
											'limit' => array(
												'type' => 'thz-spinner',
												'label' => __('Number of characters', 'creatus'),
												'desc' => esc_html__('Set number of characters to show', 'creatus'),
												'addon' => '#',
												'min' => 0,
												'value' => 300
											)
										)
									)
								),
								'introtext_bs' => array(
									'type' => 'thz-box-style',
									'label' => __('Intro text box style', 'creatus'),
									'desc' => esc_html__('Adjust .thz-grid-item-intro-text (excerpt) box style', 'creatus'),
									'button-text' => esc_html__('Customize intro text box style', 'creatus'),
									'popup' => true,
									'disable' => array('layout','borders','borderradius','boxsize','transform','boxshadow','background'),
									'value' => array(),
									'units' => array(
										'padding',
										'margin',
									),
								),
								'introtext_font' => array(
									'type' => 'thz-typography',
									'label' => __('Intro text metrics', 'creatus'),
									'desc' => esc_html__('Adjust intro text (excerpt) metrics', 'creatus'),
									'value' => array(),
									'disable' => array('hovered','text-shadow'),
								)
							)
						)
					)
				)
			),
			'tabiconssettings' => array(
				'title' => __('Icons', 'creatus'),
				'type' => 'tab',
				'li-attr' => array(
					'class' => 'thz-tab-icon-settings'
				),
				'options' => array(
					'show_icons' => array(
						'type' => 'multi-picker',
						'label' => false,
						'desc' => false,
						'picker' => array(
							'picked' => array(
								'label' => __('Show icons', 'creatus'),
								'desc' => esc_html__('Show/hide media or link icons', 'creatus'),
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
						),
						'choices' => array(
							'show' => array(
								'icons_metrics' => array(
									'type' => 'thz-multi-options',
									'label' => __('Icons metrics', 'creatus'),
									'desc' => esc_html__('Adjust icons metrics', 'creatus'),
									'value' => array(
										'pa' => 10,
										'fs' => 16,
										'co' => '#ffffff'
									),
									'thz_options' => array(
										'pa' => array(
											'type' => 'spinner',
											'title' => esc_html__('Padding', 'creatus'),
											'addon' => 'px',
											'min' => 0,
											'max' => 100
										),
										'fs' => array(
											'type' => 'spinner',
											'title' => esc_html__('Icon size', 'creatus'),
											'addon' => 'px',
											'min' => 0,
											'max' => 100
										),
										'co' => array(
											'type' => 'color',
											'title' => esc_html__('Icon color', 'creatus'),
											'box' => true
										)
									)
								),
								'iconsbg_metrics' => array(
									'type' => 'thz-multi-options',
									'label' => __('Shape metrics', 'creatus'),
									'desc' => esc_html__('Adjust icons background shape metrics', 'creatus'),
									'value' => array(
										'sh' => 'circle',
										'bg' => '',
										'bgh' => '',
										'bs' => 'solid',
										'bsi' => 0,
										'bc' => ''
									),
									'thz_options' => array(
										'sh' => array(
											'type' => 'short-select',
											'title' => esc_html__('Type', 'creatus'),
											'choices' => array(
												'circle' => esc_html__('Circle', 'creatus'),
												'square' => esc_html__('Square', 'creatus'),
												'rounded' => esc_html__('Rounded', 'creatus')
											)
										),
										'bg' => array(
											'type' => 'color',
											'title' => esc_html__('Background', 'creatus'),
											'box' => true
										),
										'bgh' => array(
											'type' => 'color',
											'title' => esc_html__('Background hovered', 'creatus'),
											'box' => true
										),
										'bs' => array(
											'type' => 'short-select',
											'title' => esc_html__('Border style', 'creatus'),
											'choices' => array(
												'solid' => esc_html__('Solid', 'creatus'),
												'dashed' => esc_html__('Dashed', 'creatus'),
												'dotted' => esc_html__('Dotted', 'creatus')
											)
										),
										'bsi' => array(
											'type' => 'spinner',
											'title' => esc_html__('Border size', 'creatus'),
											'addon' => 'px',
											'min' => 0,
											'max' => 100
										),
										'bc' => array(
											'type' => 'color',
											'title' => esc_html__('Border color', 'creatus'),
											'box' => true
										)
									)
								),
								'link_icon' => array(
									'type' => 'multi-picker',
									'label' => false,
									'desc' => false,
									'picker' => array(
										'picked' => array(
											'label' => __('Show link icon', 'creatus'),
											'desc' => esc_html__('Show/hide link icon', 'creatus'),
											'type' => 'switch',
											'right-choice' => array(
												'value' => 'hide',
												'label' => __('Hide', 'creatus')
											),
											'left-choice' => array(
												'value' => 'show',
												'label' => __('Show', 'creatus')
											),
											'value' => 'hide'
										)
									),
									'choices' => array(
										'show' => array(
											'icon' => array(
												'type' => 'thz-icon',
												'value' => 'thzicon thzicon-link',
												'label' => __('Link icon', 'creatus'),
												'desc' => esc_html__('Set link icon. Shown only if icon selected.', 'creatus')
											)
										)
									)
								),
								'media_icon' => array(
									'type' => 'multi-picker',
									'label' => false,
									'desc' => false,
									'picker' => array(
										'picked' => array(
											'label' => __('Show media icon', 'creatus'),
											'desc' => esc_html__('Show/hide media icon', 'creatus'),
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
									),
									'choices' => array(
										'show' => array(
											'icon' => array(
												'type' => 'thz-icon',
												'value' => 'thzicon thzicon-plus',
												'label' => __('Media icon', 'creatus'),
												'desc' => esc_html__('Set media icon. Shown only if icon selected.', 'creatus')
											)
										)
									)
								)
							)
						)
					)
				)
			),
			'tabbutton' => array(
				'title' => __('Button', 'creatus'),
				'type' => 'tab',
				'options' => array(
					'show_button' => array(
						'type' => 'multi-picker',
						'label' => false,
						'desc' => false,
						'picker' => array(
							'picked' => array(
								'label' => __('Show more button', 'creatus'),
								'desc' => esc_html__('Show or hide more button', 'creatus'),
								'type' => 'switch',
								'right-choice' => array(
									'value' => 'hide',
									'label' => __('Hide', 'creatus')
								),
								'left-choice' => array(
									'value' => 'show',
									'label' => __('Show', 'creatus')
								),
								'value' => 'hide'
							)
						),
						'choices' => array(
							'show' => array(
								'cbs' => array(
									'type' => 'thz-box-style',
									'label' => __('Container box style', 'creatus'),
									'preview' => true,
									'button-text' => esc_html__('Customize button container box style', 'creatus'),
									'desc' => esc_html__('Adjust .thz-grid-item-button box style', 'creatus'),
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
								'button' => array(
									'type' => 'thz-button',
									'value' => array(
										'html' => '<div class="thz-btn-container thz-grid-item-more thz-btn-outline"><a class="thz-button thz-btn-theme thz-btn-small thz-radius-4 thz-btn-border-1 thz-align-center" href="#"><span class="thz-btn-text thz-fs-13 thz-fw-600 thz-ngv-n1">more</span></a></div>',
										'buttonText' => 'more',
										'activeColor' => 'theme',
										'buttonSizeClass' 		=> 'small',
										'fontSize' 	=> 13,
										'fontWeight' => 600,
										'textNudgeV' => -1,
										'marginTop' => 30,
										'customClass'	=> 'thz-grid-item-more'
									),
									'label' => false,
									'hidelinks' => true
								)
							)
						)
					)
				)
			),
			
			
			'postformats' => array(
				'title'   => __( 'Post formats', 'creatus' ),
				'type'    => 'tab',
				'options' => array(
		
					'audio_height' => array(
						'label' => __('Audio height', 'creatus'),
						'desc' => esc_html__('Select audio player height. Inherit from media container or show player only', 'creatus'),
						'type' => 'switch',
						'right-choice' => array(
							'value' => 'only',
							'label' => __('Show player only', 'creatus')
						),
						'left-choice' => array(
							'value' => 'inherit',
							'label' => __('Inherit from media container', 'creatus')
						),
						'value' => 'inherit'
					),					
					
					'quote_height' => array(
						'label' => __('Quote height', 'creatus'),
						'desc' => esc_html__('Select quote height. Inherit from media container or auto.', 'creatus'),
						'type' => 'switch',
						'right-choice' => array(
							'value' => 'auto',
							'label' => __('Auto', 'creatus')
						),
						'left-choice' => array(
							'value' => 'inherit',
							'label' => __('Inherit from media container', 'creatus')
						),
						'value' => 'auto'
					),
					'quote_display' => array(
						'label' => __('Quote display mode', 'creatus'),
						'desc' => esc_html__('Select quote display mode. Only the quote or quote with meta, excerpt and footer', 'creatus'),
						'type' => 'switch',
						'right-choice' => array(
							'value' => 'only',
							'label' => __('Show quote only', 'creatus')
						),
						'left-choice' => array(
							'value' => 'detailed',
							'label' => __('Show quote and details', 'creatus')
						),
						'value' => 'detailed'
					),
					'link_height' => array(
						'label' => __('Link height', 'creatus'),
						'desc' => esc_html__('Select link post format height. Inherit from media container or auto.', 'creatus'),
						'type' => 'switch',
						'right-choice' => array(
							'value' => 'auto',
							'label' => __('Auto', 'creatus')
						),
						'left-choice' => array(
							'value' => 'inherit',
							'label' => __('Inherit from media container', 'creatus')
						),
						'value' => 'auto'
					),
					'link_display' => array(
						'label' => __('Link display mode', 'creatus'),
						'desc' => esc_html__('Select link display mode. Only the link or link with meta, excerpt and footer', 'creatus'),
						'type' => 'switch',
						'right-choice' => array(
							'value' => 'only',
							'label' => __('Show link only', 'creatus')
						),
						'left-choice' => array(
							'value' => 'detailed',
							'label' => __('Show link and details', 'creatus')
						),
						'value' => 'detailed'
					),
							
				),
			),
		)
	)
);