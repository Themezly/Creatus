<?php
if (!defined('FW')) {
	die('Forbidden');
}
$options = array(
	'defaultstab' => array(
		'title' => __('Defaults', 'creatus'),
		'type' => 'tab',
		'options' => array(
			'id' => array(
				'type' => 'unique',
				'length' => 8
			),
			'heading' => array(
				'type' => 'wp-editor',
				'media_buttons' => false,
				'drag_drop_upload' => false,
				'size' => 'large',
				'editor_height' => 150,
				'editor_type' => 'tinymce',
				'wpautop' => true,
				'shortcodes' => false,
				'value' => 'This is dummy heading text',
				'label' => __('Heading', 'creatus'),
				'desc' => esc_html__('Add heading text', 'creatus')
			),
			'hm' => array(
				'type' => 'thz-multi-options',
				'label' => __('Strip tags', 'creatus'),
				'desc' => esc_html__('Activate/deactivate strip tags', 'creatus'),
				'help' => esc_html__('Strip tags if active, will remove all HTML formating and leave text only. Allowed tags are; b,br,span,strong,a,i,em', 'creatus'),
				'value' => array(
					's' => 'active',
				),
				'thz_options' => array(
					's' => array(
						'type' => 'short-select',
						'title' => false,
						'choices' => array(
							'inactive' => esc_html__('Inactive', 'creatus'),
							'active' => esc_html__('Active', 'creatus')
						)
					),
				),
			),
			
			'cmx' => _thz_container_metrics_defaults(),
			
			'instyle' => array(
				'type' => 'short-text',
				'label' => __('Inherit style from', 'creatus'),
				'desc' => esc_html__('Insert special heading ID to inherit the style from. See help for more info.', 'creatus'),
				'help' => esc_html__('If you have multiple special headings with same style you can set main special heading Custom ID than add that ID here. This way every special heading on this page with this inherit ID will use same CSS. This reduces the overhead CSS and renders the special heading faster. Note that once the inherit ID is added the CSS for this special heading is not printed. The effects must be set on per element basis.', 'creatus'),
				'value' => ''
			),
			
			
		)
	),
	'layouttab' => array(
		'title' => __('Layout', 'creatus'),
		'type' => 'tab',
		'options' => array(
			'tag' => array(
				'type' => 'short-select',
				'label' => __('Heading tag', 'creatus'),
				'desc' => esc_html__('Set heading HTML tag', 'creatus'),
				'value' => 'h2',
				'choices' => array(
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
					'div' => 'DIV'
				)
			),
			'bs' => array(
				'type' => 'thz-box-style',
				'label' => __('Container box style', 'creatus'),
				'preview' => true,
				'popup' => true,
				'desc' => esc_html__('Adjust .thz-heading box style', 'creatus'),
				'button-text' => __('Customize container box style', 'creatus'),
				'disable' => array(
					'video'
				),
				'units' => array(
					'borderradius',
					'boxsize',
					'padding',
					'margin',
				),
				'value' => array()
			),
			'hem' => array(
				'type' => 'thz-multi-options',
				'label' => __('Heading holder metrics', 'creatus'),
				'desc' => esc_html__('Adjust heading .thz-heading-holder metrics', 'creatus'),
				'value' => array(
					'pos' => 'left',
					'max' => '100'
				),
				'thz_options' => array(
					'pos' => array(
						'type' => 'short-select',
						'title' => esc_html__('Align', 'creatus'),
						'choices' => array(
							'left' => esc_html__('Left', 'creatus'),
							'none' => esc_html__('Middle', 'creatus'),
							'right' => esc_html__('Right', 'creatus')
						)
					),
					'max' => array(
						'type' => 'spinner',
						'title' => esc_html__('Max width', 'creatus'),
						'addon' =>'%',
						'units' => array('%','px',),
					)
				)
			)
		)
	),
	'styletab' => array(
		'title' => __('Style', 'creatus'),
		'type' => 'tab',
		'options' => array(
			'style' => array(
				'label' => esc_html__('Heading style', 'creatus'),
				'type' => 'select',
				'value' => 'plain',
				'attr' => array(
					'class' => 'thz-select-switch'
				),
				'choices' => array(
					'plain' => array(
						'text' => esc_html__('Plain', 'creatus'),
						'attr' => array(
							'data-disable' => 'ulcm,ulm,slm'
						)
					),
					'underline' => array(
						'text' => esc_html__('Underline', 'creatus'),
						'attr' => array(
							'data-enable' => 'ulcm,ulm',
							'data-disable' => 'slm'
						)
					),
					'sideline' => array(
						'text' => esc_html__('Side line', 'creatus'),
						'attr' => array(
							'data-enable' => 'slm',
							'data-disable' => 'ulcm,ulm'
						)
					)
				),
				'desc' => esc_html__('Select special heading style', 'creatus')
			),
			'ulcm' => array(
				'type' => 'thz-multi-options',
				'label' => __('Underline container', 'creatus'),
				'desc' => esc_html__('Adjust underline container metrics', 'creatus'),
				'value' => array(
					'width' => '100%',
					'height' => 2,
					'br' => 0,
					'distance' => 15,
					'bg' => ''
				),
				'thz_options' => array(
					'width' => array(
						'type' => 'short-text',
						'title' => esc_html__('Width', 'creatus')
					),
					'height' => array(
						'type' => 'spinner',
						'title' => esc_html__('Height', 'creatus'),
						'addon' => 'px'
					),
					'br' => array(
						'type' => 'spinner',
						'title' => esc_html__('Border radius', 'creatus'),
						'addon' => 'px'
					),
					'distance' => array(
						'type' => 'spinner',
						'title' => esc_html__('Distance', 'creatus'),
						'addon' => 'px'
					),
					'bg' => array(
						'type' => 'color',
						'title' => esc_html__('Background', 'creatus'),
						'box' => true
					)
				)
			),
			'ulm' => array(
				'type' => 'thz-multi-options',
				'label' => __('Underline metrics', 'creatus'),
				'desc' => esc_html__('Adjust heading underline', 'creatus'),
				'value' => array(
					'pos' => 'left',
					'width' => '75px',
					'br' => 0,
					'mode' => 'color',
					'co' => 'color_1',
					'co2' => ''
				),
				'thz_options' => array(
					'pos' => array(
						'type' => 'short-select',
						'title' => esc_html__('Position', 'creatus'),
						'choices' => array(
							'left' => esc_html__('Left', 'creatus'),
							'none' => esc_html__('Middle', 'creatus'),
							'right' => esc_html__('Right', 'creatus')
						)
					),
					'width' => array(
						'type' => 'short-text',
						'title' => esc_html__('Width', 'creatus')
					),
					'br' => array(
						'type' => 'spinner',
						'title' => esc_html__('Border radius', 'creatus'),
						'addon' => 'px'
					),
					'mode' => array(
						'title' => esc_html__('Color mode', 'creatus'),
						'type' => 'short-select',
						'attr' => array(
							'class' => 'thz-select-switch'
						),
						'choices' => array(
							'color' => array(
								'text' => esc_html__('Color', 'creatus'),
								'attr' => array(
									'data-disable' => '.ul-color-2-parent'
								)
							),
							'vertical' => array(
								'text' => esc_html__('Vertical gradient', 'creatus'),
								'attr' => array(
									'data-enable' => '.ul-color-2-parent'
								)
							),
							'horizontal' => array(
								'text' => esc_html__('Horizontal gradient', 'creatus'),
								'attr' => array(
									'data-enable' => '.ul-color-2-parent'
								)
							),
							'radial' => array(
								'text' => esc_html__('Radial gradient', 'creatus'),
								'attr' => array(
									'data-enable' => '.ul-color-2-parent'
								)
							)
						)
					),
					'co' => array(
						'type' => 'color',
						'title' => esc_html__('Color', 'creatus'),
						'box' => true,
						'attr' => array(
							'class' => 'ul-color-1'
						)
					),
					'co2' => array(
						'type' => 'color',
						'title' => esc_html__('Color 2', 'creatus'),
						'box' => true,
						'attr' => array(
							'class' => 'ul-color-2'
						)
					)
				)
			),
			'slm' => array(
				'type' => 'thz-multi-options',
				'label' => __('Side line metrics', 'creatus'),
				'desc' => esc_html__('Adjust heading side line', 'creatus'),
				'value' => array(
					'type' => 'single',
					'pos' => 'both',
					'height' => 1,
					'height' => 1,
					'space' => 8,
					'width' => 20,
					'mode' => 'color',
					'co' => '#efefef',
					'co2' => ''
				),
				'thz_options' => array(
					'type' => array(
						'type' => 'short-select',
						'title' => esc_html__('Type', 'creatus'),
						'attr' => array(
							'class' => 'thz-select-switch'
						),
						'choices' => array(
							'single' => array(
								'text' => esc_html__('Single', 'creatus'),
								'attr' => array(
									'data-disable' => '.thz-mh-fw-edit-options-modal-slm-space'
								)
							),
							'double' => array(
								'text' => esc_html__('Double', 'creatus'),
								'attr' => array(
									'data-enable' => '.thz-mh-fw-edit-options-modal-slm-space'
								)
							)
						)
					),
					'pos' => array(
						'type' => 'short-select',
						'title' => esc_html__('Position', 'creatus'),
						'choices' => array(
							'left' => esc_html__('Left', 'creatus'),
							'both' => esc_html__('Both', 'creatus'),
							'right' => esc_html__('Right', 'creatus')
						)
					),
					'width' => array(
						'type' => 'spinner',
						'title' => esc_html__('Width', 'creatus'),
						'addon' => '%',
						'min' => 0
					),
					'height' => array(
						'type' => 'spinner',
						'title' => esc_html__('Height', 'creatus'),
						'addon' => 'px',
						'min' => 0
					),
					'space' => array(
						'type' => 'spinner',
						'title' => esc_html__('Lines space', 'creatus'),
						'addon' => 'px',
						'min' => 0
					),
					'mode' => array(
						'title' => esc_html__('Color mode', 'creatus'),
						'type' => 'short-select',
						'attr' => array(
							'class' => 'thz-select-switch'
						),
						'choices' => array(
							'color' => array(
								'text' => esc_html__('Color', 'creatus'),
								'attr' => array(
									'data-disable' => '.sl-color-2-parent'
								)
							),
							'vertical' => array(
								'text' => esc_html__('Vertical gradient', 'creatus'),
								'attr' => array(
									'data-enable' => '.sl-color-2-parent'
								)
							),
							'horizontal' => array(
								'text' => esc_html__('Horizontal gradient', 'creatus'),
								'attr' => array(
									'data-enable' => '.sl-color-2-parent'
								)
							),
							'radial' => array(
								'text' => esc_html__('Radial gradient', 'creatus'),
								'attr' => array(
									'data-enable' => '.sl-color-2-parent'
								)
							)
						)
					),
					'co' => array(
						'type' => 'color',
						'title' => esc_html__('Color', 'creatus'),
						'box' => true,
						'attr' => array(
							'class' => 'sl-color-1'
						)
					),
					'co2' => array(
						'type' => 'color',
						'title' => esc_html__('Color 2', 'creatus'),
						'box' => true,
						'attr' => array(
							'class' => 'sl-color-2'
						)
					)
				)
			),
			'tbs' => array(
				'type' => 'thz-box-style',
				'label' => __('Heading box style', 'creatus'),
				'preview' => true,
				'popup' => true,
				'desc' => esc_html__('Adjust .thz-heading-title box style', 'creatus'),
				'button-text' => __('Customize heading box style', 'creatus'),
				'disable' => array(
					'video'
				),
				'units' => array(
					'borderradius',
					'boxsize',
					'padding',
					'margin',
				),
				'value' => array()
			),
			'ht' => array(
				'label' => __('Font settings', 'creatus'),
				'desc' => esc_html__('Adjust heading font.', 'creatus'),
				'type' => 'thz-typography',
				'value' => array(),
				'disable' => array('hovered'),
			),
		)
	),
	'subtab' => array(
		'title' => __('Sub text ', 'creatus'),
		'type' => 'tab',
		'options' => array(
			'shsub' => array(
				'type' => 'multi-picker',
				'label' => false,
				'desc' => false,
				'show_borders' => true,
				'picker' => array(
					'picked' => array(
						'label' => __('Show sub text', 'creatus'),
						'desc' => esc_html__('Show/hide sub text', 'creatus'),
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
						'text' => array(
							'type' => 'wp-editor',
							'size' => 'large',
							'editor_height' => 100,
							'editor_type' => 'tinymce',
							'wpautop' => true,
							'shortcodes' => false,
							'value' => 'I am dummy sub text',
							'label' => __('Sub text', 'creatus'),
							'desc' => esc_html__('Add sub text', 'creatus'),
						),
						'metrics' => array(
							'type' => 'thz-multi-options',
							'label' => __('Sub text metrics', 'creatus'),
							'desc' => esc_html__('Adjust sub text container metrics', 'creatus'),
							'help' => esc_html__('Strip tags if active, will remove all HTML formating and leave text only. Allowed tags are; b,br,span,strong,a,i,em', 'creatus'),
							'value' => array(
								'tag' => 'div',
								'loc' => 'under',
								'strip' => 'inactive',
								'bs' => '',
							),
							'thz_options' => array(
								'tag' => array(
									'type' => 'short-select',
									'title' => esc_html__('Tag', 'creatus'),
									'choices' => array(
										'h1' => 'H1',
										'h2' => 'H2',
										'h3' => 'H3',
										'h4' => 'H4',
										'h5' => 'H5',
										'h6' => 'H6',
										'div' => 'DIV'
									)
								),
								'loc' => array(
									'type' => 'short-select',
									'title' => esc_html__('Location', 'creatus'),
									'choices' => array(
										'under' => esc_html__('Under the heading', 'creatus'),
										'above' => esc_html__('Above the heading', 'creatus')
									)
								),
								'bs' => array(
									'type' => 'box-style',
									'title' => esc_html__('Box style', 'creatus'),
									'button-text' => esc_html__('Edit box style', 'creatus'),
									'connect' => 'shsub-show-bs'
								),
								'strip' => array(
									'type' => 'short-select',
									'title' => esc_html__('Strip tags', 'creatus'),
									'choices' => array(
										'inactive' => esc_html__('Inactive', 'creatus'),
										'active' => esc_html__('Active', 'creatus')
									)
								),
							)
						),
						'bs' => array(
							'type' => 'thz-box-style',
							'label' => __('Sub text box style', 'creatus'),
							'preview' => false,
							'popup' => true,
							'desc' => esc_html__('Adjust .thz-heading box style', 'creatus'),
							'button-text' => __('Customize container box style', 'creatus'),
							'disable' => array(
								'video',
							),
							'units' => array(
								'borderradius',
								'boxsize',
								'padding',
								'margin',
							),
							'value' => array(
								'margin' => array(
									'top' => 15,
									'right' => 0,
									'bottom' => 0,
									'left' => 0
								)
							)
						),
						'st' => array(
							'label' => __('Sub text font', 'creatus'),
							'desc' => esc_html__('Adjust sub text font.', 'creatus'),
							'type' => 'thz-typography',
							'value' => array(
								'size' => '16',
							),
							'disable' => array('hovered')
						),
					)
				)
			)
		)
	),
	
	'headingparts' => array(
		'title'   => __( 'Parts', 'creatus' ),
		'type'    => 'tab',
		'options' => array(
		
			'hp' => array(
				'type' => 'addable-popup',
				'value' => array(),
				'label' => __('Heading parts', 'creatus'),
				'desc' => esc_html__('Add parts of the text before or after the heading or sub heading', 'creatus'),
				'template' => '<b>Text:</b> {{- t }}<br /><b>Element:</b> {{  if(m.e == \'h\'){ }}Heading{{ }else{ }} Sub heading {{ } }}<br /><b>Location:</b> {{  if(m.l == \'b\'){ }}Before{{ }else{ }} After {{ } }}',
				'popup-title' => esc_html__('Heading part settings', 'creatus'),
				'size' => 'large',
				'add-button-text' => esc_html__('Add/edit heading part', 'creatus'),
				'sortable' => true,
				'popup-options' => array(
					'partdefaults' => array(
						'title' => __('Defaults', 'creatus'),
						'type' => 'tab',
						'options' => array(
							'id' => array(
								'type' => 'unique',
								'length' => 8
							),
							
							't' => array(
								'type' => 'text',
								'label' => __('Text', 'creatus'),
								'desc' => __('Insert heading part text', 'creatus')
							),
							'm' => array(
								'type' => 'thz-multi-options',
								'label' => __('Part metrics', 'creatus'),
								'desc' => esc_html__('Adjust part metrics', 'creatus'),
								'value' => array(
									'e' => 'h',
									'l' => 'a',
									'b' => 'n',
								),
								'thz_options' => array(
									'e' => array(
										'type' => 'short-select',
										'title' => esc_html__('Element', 'creatus'),
										'choices' => array(
											'h' => esc_html__('Heading', 'creatus'),
											's' => esc_html__('Sub heading', 'creatus')
										)
									),
									'l' => array(
										'type' => 'short-select',
										'title' => esc_html__('Part location', 'creatus'),
										'choices' => array(
											'b' => esc_html__('Before the element', 'creatus'),
											'a' => esc_html__('After the element', 'creatus')
										)
									),
									'b' => array(
										'type' => 'short-select',
										'title' => esc_html__('Brake', 'creatus'),
										'choices' => array(
											'n' => esc_html__('Do not add brake', 'creatus'),
											'b' => esc_html__('Before the part', 'creatus'),
											'a' => esc_html__('After the part', 'creatus')
										)
									),
								)
							),
							'f' => array(
								'label' => __('Font settings', 'creatus'),
								'desc' => esc_html__('Adjust part font', 'creatus'),
								'type' => 'thz-typography',
								'value' => array(),
								'disable' => array('hovered')
							)
						)
					),

					'parteffects' => array(
						'title' => __('Effects', 'creatus'),
						'type' => 'tab',
						'options' => array(
							'animate' => array(
								'type' => 'thz-animation',
								'label' => false,
								'value' => array(
									'animate' => 'inactive',
									'effect' => 'thz-anim-fadeIn',
									'duration' => 400,
									'delay' => 100
								)
							),
							'gr' => array(
								'type' => 'thz-multi-options',
								'label' => __('Gradient text', 'creatus'),
								'desc' => esc_html__('Use gradient as heading part text color. See help for more info.', 'creatus'),
								'help' => esc_html__('Fallback is color 1 on non webkit browsers. Heading part color from Font settings is not used if gradient is active.', 'creatus'),
								'value' => array(
									'mode' => 'inactive',
									'gradient' => 'horizontal',
									'color1' => '#3f51b5',
									'color2' => '#f44336'
								),
								'thz_options' => array(
									'mode' => array(
										'title' => esc_html__('Mode', 'creatus'),
										'type' => 'short-select',
										'attr' => array(
											'class' => 'thz-select-switch'
										),
										'choices' => array(
											'inactive' => array(
												'text' => esc_html__('Inactive', 'creatus'),
												'attr' => array(
													'data-disable' => '.grp-gradient-parent,.grp-color-1-parent,.grp-color-2-parent'
												)
											),
											'active' => array(
												'text' => esc_html__('Active', 'creatus'),
												'attr' => array(
													'data-enable' => '.grp-gradient-parent,.grp-color-1-parent,.grp-color-2-parent'
												)
											)
										)
									),
									'gradient' => array(
										'type' => 'short-select',
										'title' => esc_html__('Gradient type', 'creatus'),
										'attr' => array(
											'class' => 'grp-gradient'
										),
										'choices' => array(
											'vertical' => esc_html__('Vertical', 'creatus'),
											'horizontal' => esc_html__('Horizontal', 'creatus'),
											'radial' => esc_html__('Radial', 'creatus')
										)
									),
									'color1' => array(
										'type' => 'color',
										'title' => esc_html__('Color 1', 'creatus'),
										'box' => true,
										'attr' => array(
											'class' => 'grp-color-1'
										)
									),
									'color2' => array(
										'type' => 'color',
										'title' => esc_html__('Color 2', 'creatus'),
										'box' => true,
										'attr' => array(
											'class' => 'grp-color-2'
										)
									)
								),
								
							),
							
							'rs' => array(
								'type' => 'multi-picker',
									'label' => false,
									'desc' => false,
									'picker' => array(
										'picked' => array(
											'label' => __('Rotate strings', 'creatus'),
											'desc' => __('Activate strings rotation effect', 'creatus'),
											'type' => 'switch',
											'right-choice' => array(
												'value' => 'inactive',
												'label' => __('Inactive', 'creatus')
											),
											'left-choice' => array(
												'value' => 'active',
												'label' => __('Active', 'creatus')
											),
											'value' => 'inactive'
										)
									),
									'choices' => array(
										'active' => array(
											'mx' => array(
												'type' => 'thz-multi-options',
												'label' => __('Rotation metrics', 'creatus'),
												'desc' => esc_html__('Adjust rotation metrics.', 'creatus'),
												'value' => array(
													'sd' => 200,
													'rd' => 2000,
												),
												'thz_options' => array(
													'sd' => array(
														'type' => 'spinner',
														'title' => esc_html__('Start delay', 'creatus'),
														'addon' => 'ms',
														'min' => 0,
														'step' => 50
													),
													'rd' => array(
														'type' => 'spinner',
														'title' => esc_html__('Rotation delay', 'creatus'),
														'addon' => 'ms',
														'min' => 0,
														'step' => 50
													),
												)
											),
										
											's' => array(
												'type' => 'addable-option',
												'value' => array(
													'Next String'
												),
												'label' => __('Strings', 'creatus'),
												'desc' => esc_html__('First string is the part text. Click the button to add a new string. ', 'creatus'),
												'option' => array(
													'type' => 'text'
												),
												'add-button-text' => esc_html__('Add a new string', 'creatus'),
												'sortable' => true
											),											
										),
										
										
									
									)			
							),	
							
						)
					)



				)
			),		
		

		),
	),
	
	'headingeffects' => array(
		'title' => __('Effects', 'creatus'),
		'type' => 'tab',
		'options' => array(
			'animate' => array(
				'type' => 'thz-animation',
				'label' => false,
				'value' => array(
					'animate' => 'inactive',
					'effect' => 'thz-anim-fadeIn',
					'duration' => 400,
					'delay' => 100
				)
			),
			'gr' => array(
				'type' => 'thz-multi-options',
				'label' => __('Gradient text', 'creatus'),
				'desc' => esc_html__('Use gradient as heading text color. See help for more info.', 'creatus'),
				'help' => esc_html__('Fallback is color 1 on non webkit browsers. Heading color from Font settings is not used if gradient is active.', 'creatus'),
				'value' => array(
					'mode' => 'inactive',
					'gradient' => 'horizontal',
					'color1' => '#3f51b5',
					'color2' => '#f44336'
				),
				'thz_options' => array(
					'mode' => array(
						'title' => esc_html__('Mode', 'creatus'),
						'type' => 'short-select',
						'attr' => array(
							'class' => 'thz-select-switch'
						),
						'choices' => array(
							'inactive' => array(
								'text' => esc_html__('Inactive', 'creatus'),
								'attr' => array(
									'data-disable' => '.gr-gradient-parent,.gr-color-1-parent,.gr-color-2-parent'
								)
							),
							'active' => array(
								'text' => esc_html__('Active', 'creatus'),
								'attr' => array(
									'data-enable' => '.gr-gradient-parent,.gr-color-1-parent,.gr-color-2-parent'
								)
							)
						)
					),
					'gradient' => array(
						'type' => 'short-select',
						'title' => esc_html__('Gradient type', 'creatus'),
						'attr' => array(
							'class' => 'gr-gradient'
						),
						'choices' => array(
							'vertical' => esc_html__('Vertical', 'creatus'),
							'horizontal' => esc_html__('Horizontal', 'creatus'),
							'radial' => esc_html__('Radial', 'creatus')
						)
					),
					'color1' => array(
						'type' => 'color',
						'title' => esc_html__('Color 1', 'creatus'),
						'box' => true,
						'attr' => array(
							'class' => 'gr-color-1'
						)
					),
					'color2' => array(
						'type' => 'color',
						'title' => esc_html__('Color 2', 'creatus'),
						'box' => true,
						'attr' => array(
							'class' => 'gr-color-2'
						)
					)
				)
			),
			'cpx' => _thz_container_parallax_default()
		)
	)
);