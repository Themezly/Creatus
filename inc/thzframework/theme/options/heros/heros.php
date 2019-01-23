<?php
if (!defined('FW')) {
	die('Forbidden');
}
$slider_choices = fw_ext('slider') ? fw()->extensions->get('slider')->get_populated_sliders_choices() : array();
if (empty($slider_choices)) {
	$slider_choices = array(
		'none' => esc_html__('No slides available. Go to Appearance > Slider and create slider', 'creatus')
	);
}

$usefeatured = isset($usefeatured) ? $usefeatured : false;
$pageoptions = isset($pageoptions) ? $pageoptions : false;
$disable_hero = array();


if($pageoptions){
	
	$disable_hero['disable'] = array(
		'type' => 'short-select',
		'label' => __('Hero section active', 'creatus'),
		'desc' => esc_html__('Activate/deactivate hero section for this page', 'creatus'),
		'value' => 'enable',
		'attr' => array(
			'class' => 'thz-select-switch'
		),
		'choices' => array(
			'active' =>array(
				'text' =>  esc_html__('Active', 'creatus'),
				'attr' => array(
					'data-enable' => 'hero_location,hero_type,.media-frame-content .fw-options-tabs-list',
				)
			),
			'inactive' =>array(
				'text' =>  esc_html__('Inactive', 'creatus'),
				'attr' => array(
					'data-disable' => 'hero_location,hero_type,.media-frame-content .fw-options-tabs-list',
				)
			),

		)
	);
	
}

$options = array(
	'defaults' => array(
		'title' => __('Defaults', 'creatus'),
		'type' => 'tab',
		'lazy_tabs'=> false,
		'options' => array(
			$disable_hero,
			'hero_location' => array(
				'label' => __('Hero section location', 'creatus'),
				'desc' => esc_html__('Select where to display the hero section', 'creatus'),
				'type' => 'switch',
				'right-choice' => array(
					'value' => 'above',
					'label' => __('Above the header', 'creatus')
				),
				'left-choice' => array(
					'value' => 'under',
					'label' => __('Under the header', 'creatus')
				),
				'value' => 'under'
			),
			'hero_type' => array(
				'type' => 'multi-picker',
				'label' => false,
				'desc' => false,
				'picker' => array(
					'picked' => array(
						'label' => __('Hero section type', 'creatus'),
						'desc' => esc_html__('Select hero section type', 'creatus'),
						'help' => esc_html__('If you would rather use page blocks instead of any other hero section type, please make sure you first have page blocks created. Look to your left at WordPress side menu and locate Page Blocks custom post type. In page blocks you need to use page builder to create custom page blocks that will be displayed as hero section.', 'creatus'),
						'type' => 'short-select',
						'value' => 'none',
						'attr' => array(
							'class' => 'thz-select-switch'
						),
						'choices' => array(
							
							'title' =>array(
								'text' =>  esc_html__('Title', 'creatus'),
								'attr' => array(
									'data-enable' => '.hero_title_tab_li,.hero_layout_tab_li,.hero_effects_tab_li',
									'data-disable' => '.hero_typo_tab_li',
									'data-check' =>'.sub-title-switch-parent'
									
								)
							),

							'block' =>array(
								'text' =>  esc_html__('Page Blocks', 'creatus'),
								'attr' => array(
									'data-enable' => '',
									'data-disable' => '.hero_typo_tab_li,.hero_title_tab_li,.hero_sub_title_tab_li,.hero_layout_tab_li,.hero_effects_tab_li',
									
								)
							),
							
							'slider' =>array(
								'text' =>  esc_html__('Slider', 'creatus'),
								'attr' => array(
									'data-enable' => '.hero_layout_tab_li,.hero_effects_tab_li',
									'data-disable' => '.hero_typo_tab_li,.hero_title_tab_li,.hero_sub_title_tab_li',
									
								)
							),
							'layer' =>array(
								'text' =>  esc_html__('Layer slider', 'creatus'),
								'attr' => array(
									'data-enable' => '.hero_layout_tab_li,.hero_effects_tab_li',
									'data-disable' => '.hero_typo_tab_li,.hero_title_tab_li,.hero_sub_title_tab_li',
								)
							),
							'rev' =>array(
								'text' =>  esc_html__('Revolution slider', 'creatus'),
								'attr' => array(
									'data-enable' => '.hero_layout_tab_li,.hero_effects_tab_li',
									'data-disable' => '.hero_typo_tab_li,.hero_title_tab_li,.hero_sub_title_tab_li',
								)
							),
							'editor' =>array(
								'text' =>  esc_html__('Editor', 'creatus'),
								'attr' => array(
									'data-enable' => '.hero_typo_tab_li,.hero_layout_tab_li,.hero_effects_tab_li',
									'data-disable' => '.hero_title_tab_li,.hero_sub_title_tab_li',
								)
							),

						)
					)
				),

				
				'choices' => array(
					
					'block' => array(
						
						'pb' => array(
							'type' => 'multi-select',
							'value' => array(),
							'attr' => array(
								'class' => 'thz-pageblock-multi'
							),
							'label' => __('Page blocks', 'creatus'),
							'desc' => esc_html__('Type in block name or select from the list. Drag and drop to reorder.', 'creatus'),
							'population' => 'posts',
							'source' => 'thz-pageblock',
							'prepopulate' => 10,
							'limit' => 5,
						),
					
					),
					
					'title' => array(
						'arrow' => array(
							'type' => 'thz-multi-options',
							'label' => __('Scroll arrow metrics', 'creatus'),
							'desc' => esc_html__('Show/hide scroll arrow at the bottom of the section', 'creatus'),
							'value' => array(
								's' => 'show',
								'c' => '#ffffff',
								'si' => 22
							),
							'thz_options' => array(
								's' => array(
									'type' => 'short-select',
									'title' => esc_html__('Show arrow', 'creatus'),
									'attr' => array(
										'class' => 'thz-select-switch'
									),
									'choices' => array(
										'show' =>array(
											'text' =>  esc_html__('Show', 'creatus'),
											'attr' => array(
												'data-enable' => '.thz-mh-fw-edit-options-modal-hero_type-title-arrow-c,.thz-mh-fw-edit-options-modal-hero_type-title-arrow-si',
											)
										),
										'hide' =>array(
											'text' =>  esc_html__('Hide', 'creatus'),
											'attr' => array(
												'data-disable' => '.thz-mh-fw-edit-options-modal-hero_type-title-arrow-c,.thz-mh-fw-edit-options-modal-hero_type-title-arrow-si',
											)
										),
									)
								),
								'c' => array(
									'type' => 'color',
									'title' => esc_html__('Arrow color', 'creatus'),
									'box' => true
								),
								'si' => array(
									'type' => 'spinner',
									'title' => esc_html__('Arrow size', 'creatus'),
									'addon' => 'px'
								),	
							)
						),
					),
					'slider' => array(
						'id' => array(
							'type' => 'select',
							'label' => __('Select Slider', 'creatus'),
							'choices' => $slider_choices
						)
					),
					'layer' => array(
						'id' => array(
							'type' => 'select',
							'label' => __('Select Layer Slider', 'creatus'),
							'choices' => thz_layer_slider_slides()
						)
					),
					'rev' => array(
						'id' => array(
							'type' => 'select',
							'label' => __('Select Revolution Slider', 'creatus'),
							'choices' => thz_revolution_slides()
						)
					),
					'editor' => array(
						'arrow' => array(
							'type' => 'thz-multi-options',
							'label' => __('Scroll arrow metrics', 'creatus'),
							'desc' => esc_html__('Show/hide scroll arrow at the bottom of the section', 'creatus'),
							'value' => array(
								's' => 'show',
								'c' => '#ffffff',
								'si' => 22
							),
							'thz_options' => array(
								's' => array(
									'type' => 'short-select',
									'title' => esc_html__('Show arrow', 'creatus'),
									'attr' => array(
										'class' => 'thz-select-switch'
									),
									'choices' => array(
										'show' =>array(
											'text' =>  esc_html__('Show', 'creatus'),
											'attr' => array(
												'data-enable' => '.thz-mh-fw-edit-options-modal-hero_type-title-arrow-c,.thz-mh-fw-edit-options-modal-hero_type-title-arrow-si',
											)
										),
										'hide' =>array(
											'text' =>  esc_html__('Hide', 'creatus'),
											'attr' => array(
												'data-disable' => '.thz-mh-fw-edit-options-modal-hero_type-title-arrow-c,.thz-mh-fw-edit-options-modal-hero_type-title-arrow-si',
											)
										),
									)
								),
								'c' => array(
									'type' => 'color',
									'title' => esc_html__('Arrow color', 'creatus'),
									'box' => true
								),
								'si' => array(
									'type' => 'spinner',
									'title' => esc_html__('Arrow size', 'creatus'),
									'addon' => 'px'
								),	
							)
						),
						'e' => array(
							'type' => 'wp-editor',
							'size' => 'large',
							'editor_height' => 200,
							'shortcodes' => true,
							'editor_type' => 'tinymce',
							'wpautop' => false,
							'label' => __('Content', 'creatus'),
							'desc' => esc_html__('Enter some content for this text block', 'creatus'),
							'value' => 'Praesent ut accumsan est. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras volutpat, ligula quis mollis elementum, ex nisi interdum ante, eu posuere sem sem et tortor.'
						)
					)
				)
			)
		)
	),
	'sectionlayouttab' => array(
		'title' => __('Layout', 'creatus'),
		'li-attr' => array('class' => 'hero_layout_tab_li'),
		'type' => 'tab',
		'lazy_tabs'=> false,
		'options' => array(
			'bs' => array(
				'type' => 'thz-box-style',
				'label' => __('Section box style', 'creatus'),
				'preview' => true,
				'popup' => true,
				'button-text' => esc_html__('Customize section box style', 'creatus'),
				'desc' => esc_html__('Adjust .thz-section-holder > section box style','creatus'),
				'featured'=> true,
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
	'sectiontypographytab' => array(
		'title' => __('Typography', 'creatus'),
		'type' => 'tab',
		'li-attr' => array('class' => 'hero_typo_tab_li'),
		'lazy_tabs'=> false,
		'options' => array(
			fw()->theme->get_options('custom_typo')
		)
	),
	'sectiontitletab' => array(
		'title' => __('Title Options', 'creatus'),
		'type' => 'tab',
		'li-attr' => array('class' => 'hero_title_tab_li'),
		'lazy_tabs'=> false,
		'options' => array(
			fw()->theme->get_options('heros/title',array('pageoptions' => $pageoptions))
		)
	),


	'sectionsubtitletab' => array(
		'title' => __('Sub Title Options', 'creatus'),
		'type' => 'tab',
		'li-attr' => array('class' => 'hero_sub_title_tab_li'),
		'lazy_tabs'=> false,
		'options' => array(
			fw()->theme->get_options('heros/sub_title',array('pageoptions' => $pageoptions))
		)
	),
	
	
	'sectioneffectstab' => array(
		'title' => __('Effects', 'creatus'),
		'type' => 'tab',
		'li-attr' => array('class' => 'hero_effects_tab_li'),
		'lazy_tabs'=> false,
		'options' => array(
			fw()->theme->get_options('custom_effects',array('usefeatured' => $usefeatured))
		)
	),
	
	'sectionresstab' => array(
		'title' => __('Responsive', 'creatus'),
		'type' => 'tab',
		'li-attr' => array('class' => 'hero_effects_tab_li'),
		'lazy_tabs'=> false,
		'options' => array(
			'res' => array(
				'type' => 'addable-popup',
				'label' => __('Hero breakpoints', 'creatus'),
				'desc' => __('Add custom hero settings on specific breakpoints.', 'creatus'),
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
					
					'b' => array(
						'type' => 'thz-box-style',
						'label' => __('Section box style', 'creatus'),
						'desc' => esc_html__('Adjust .thz-section-holder section box style for this breakpoint', 'creatus'),
						'preview' => true,
						'button-text' => esc_html__('Customize section box style', 'creatus'),
						'popup' => true,
						'disable' => array(),
						'value' => array(),
						'units' => array(
							'borderradius',
							'boxsize',
							'padding',
							'margin',
						),
					),
					
					'tb' => array(
						'type' => 'thz-box-style',
						'label' => __('Title box style', 'creatus'),
						'desc' => esc_html__('Adjust .thz-hero-post-title box style for this breakpoint', 'creatus'),
						'preview' => true,
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
					
					'stb' => array(
						'type' => 'thz-box-style',
						'label' => __('Sub title box style', 'creatus'),
						'desc' => esc_html__('Adjust .thz-hero-post-title-sub box style for this breakpoint', 'creatus'),
						'preview' => true,
						'button-text' => esc_html__('Customize sub title box style', 'creatus'),
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