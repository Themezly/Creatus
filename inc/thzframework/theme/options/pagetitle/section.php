<?php
if (!defined('FW'))
	die('Forbidden');



$options = array(
	'page_title_metrics' => array(
		'type' => 'thz-multi-options',
		'label' => __('Page title metrics', 'creatus'),
		'desc' => esc_html__('Select page title mode, layout and choose the content order', 'creatus'),
		'value' => array(
			'mode' => 'both',
			'layout' => 'table',
			'tag' => 'h5',
			'align' => 'center',
			'order' => 'p',
		),
		'thz_options' => array(
			'mode' => array(
				'type' => 'short-select',
				'title' => esc_html__('Mode', 'creatus'),
				'attr' => array(
					'class' => 'thz-select-switch'
				),
				'choices' => array(
					'both' => array(
						'text' => esc_html__('Title and Breadcrumbs', 'creatus'),
						'attr' => array(
							'data-enable' => '.thz-mh-fw-option-page_title_metrics-layout,.thz-mh-fw-option-page_title_metrics-order,.thz-mh-fw-edit-options-modal-page_title_metrics-layout,.thz-mh-fw-edit-options-modal-page_title_metrics-order,.thz-pagetitle-section-li,.thz-pagetitle-title-li,.thz-pagetitle-breadcrumbs-li,.thz-pagetitle-subtitle-li,pt_show_on,page_title_options,.media-frame-content .fw-options-tabs-list,#fw-options-box-pagetitle_subbox .fw-options-tabs-list,.pt-tag-parent',
							'data-check' =>'.thz-mh-fw-option-page_title_metrics-layout,.thz-mh-fw-option-page_title_metrics-layout'
						)
					),
					'title' => array(
						'text' => esc_html__('Title only', 'creatus'),
						'attr' => array(
							'data-enable' => '.thz-mh-fw-option-page_title_metrics-layout,.thz-mh-fw-edit-options-modal-page_title_metrics-layout,.thz-pagetitle-section-li,.thz-pagetitle-title-li,.thz-pagetitle-subtitle-li,pt_show_on,page_title_options,.media-frame-content .fw-options-tabs-list,#fw-options-box-pagetitle_subbox .fw-options-tabs-list,.pt-tag-parent',
							'data-disable' => '.thz-mh-fw-option-page_title_metrics-order,.thz-mh-fw-edit-options-modal-page_title_metrics-order,.thz-pagetitle-breadcrumbs-li',
							'data-check' =>'.thz-mh-fw-option-page_title_metrics-layout,.thz-mh-fw-option-page_title_metrics-layout'
						)
					),
					'breadcrumbs' => array(
						'text' => esc_html__('Breadcrumbs only', 'creatus'),
						'attr' => array(
							'data-enable' => '.thz-mh-fw-option-page_title_metrics-layout,.thz-mh-fw-edit-options-modal-page_title_metrics-layout,.thz-pagetitle-section-li,.thz-pagetitle-breadcrumbs-li,pt_show_on,page_title_options,.media-frame-content .fw-options-tabs-list,#fw-options-box-pagetitle_subbox .fw-options-tabs-list',
							'data-disable' => '.thz-mh-fw-option-page_title_metrics-order,.thz-mh-fw-edit-options-modal-page_title_metrics-order,.thz-pagetitle-title-li,.thz-pagetitle-subtitle-li,.pt-tag-parent',
							'data-check' =>'.thz-mh-fw-option-page_title_metrics-layout,.thz-mh-fw-option-page_title_metrics-layout'
						)
					),
					'inactive' => array(
						'text' => esc_html__('Inactive', 'creatus'),
						'attr' => array(
							'data-disable' => '.thz-mh-fw-option-page_title_metrics-layout,.thz-mh-fw-option-page_title_metrics-order,.thz-mh-fw-edit-options-modal-page_title_metrics-layout,.thz-mh-fw-edit-options-modal-page_title_metrics-order,.thz-pagetitle-section-li,.thz-pagetitle-title-li,.thz-pagetitle-breadcrumbs-li,.thz-pagetitle-subtitle-li,pt_show_on,page_title_options,.media-frame-content .fw-options-tabs-list,#fw-options-box-pagetitle_subbox .fw-options-tabs-list,.thz-mh-fw-option-page_title_metrics-align,.thz-mh-fw-edit-options-modal-page_title_metrics-align,.pt-tag-parent',
							'data-check' =>'.thz-mh-fw-option-page_title_metrics-layout,.thz-mh-fw-option-page_title_metrics-layout'
						)
					)
				)
			),
			'layout' => array(
				'type' => 'short-select',
				'title' => esc_html__('Layout', 'creatus'),
				'attr' => array(
					'class' => 'thz-select-switch'
				),
				'choices' => array(
					'table' => array(
						'text' => esc_html__('Table', 'creatus'),
						'attr' => array(
							'data-disable' => '.thz-mh-fw-option-page_title_metrics-align,.thz-mh-fw-edit-options-modal-page_title_metrics-align'
						)

					),
					'stack' => array(
						'text' => esc_html__('Stack', 'creatus'),
						'attr' => array(
							'data-enable' => '.thz-mh-fw-option-page_title_metrics-align,.thz-mh-fw-edit-options-modal-page_title_metrics-align'
						)
					),
				)
			),
			'tag' => array(
				'type' => 'short-select',
				'title' => esc_html__('Title tag', 'creatus'),
				'attr' => array(
					'class' => 'pt-tag'
				),
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
			'align' => array(
				'type' => 'short-select',
				'title' => esc_html__('Align', 'creatus'),
				'choices' => array(
					'left' => esc_html__('Left', 'creatus'),
					'center' => esc_html__('Center', 'creatus'),
					'right' => esc_html__('Right', 'creatus')
				)
			),
			'order' => array(
				'type' => 'short-select',
				'title' => esc_html__('Order', 'creatus'),
				'choices' => array(
					'p' => esc_html__('Page title first', 'creatus'),
					'b' => esc_html__('Breadcrumbs first', 'creatus')
				)
			),

		)
	),
	'pt_show_on' => array(
		'type' => 'thz-post-type',
		'value' => array(
			'all'
		),
		'label' => __('Show pagetitle on', 'creatus'),
		'desc' => esc_html__('Choose where page title should be shown', 'creatus')
	),
	'page_title_options' => array(
		'type' => 'popup',
		'label' => __('Page title section options', 'creatus'),
		'desc' => esc_html__('Adjust page title section layout and feel', 'creatus'),
		'button' => esc_html__('Customize page title section', 'creatus'),
		'size' => 'large',
		'popup-options' => array(
			'sectionlayouttab' => array(
				'title' => __('Layout', 'creatus'),
				'type' => 'tab',
				'lazy_tabs' => false,
				'options' => array(
					'section_boxstyle' => array(
						'type' => 'thz-box-style',
						'label' => __('Section box style', 'creatus'),
						'desc' => esc_html__('Adjust .thz-pagetitle-section > section box style', 'creatus'),
						'preview' => true,
						'popup' => true,
						'featured' => false,
						'button-text' => esc_html__('Customize section box style', 'creatus'),
						'disable' => array('layout','video','borderradius'),
						'value' => array(
							'padding' => array(
								'top' => '30',
								'right' => '0',
								'bottom' => '30',
								'left' => '0'
							),
							'background' => array(
								'type' => 'color',
								'color' => 'color_5',
							)
						)
					),
					
					'con_bs' => array(
						'type' => 'thz-box-style',
						'label' => __('Container box style', 'creatus'),
						'desc' => esc_html__('Adjust .thz-pagetitle box style', 'creatus'),
						'preview' => true,
						'popup' => true,
						'featured' => false,
						'button-text' => esc_html__('Customize container box style', 'creatus'),
						'disable' => array('layout','video'),
						'value' => array()
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
					'pre' => _thz_responsive_options(),
				)
			),
			'sectioneffectstab' => array(
				'title' => __('Effects', 'creatus'),
				'type' => 'tab',
				'lazy_tabs' => false,
				'options' => array(
					'animate' => array(
						'type' => 'thz-animation',
						'label' => false,
						'value' => array(
							'animate' => 'inactive',
							'effect' => 'thz-anim-fadeIn',
							'duration' => 1000,
							'delay' => 0
						)
					),
				)
			)
		)
	),

);


$bg_layers = thz_theme()->get_options('effects/background_layers',array('inneroptions' => true ));

if( !empty($bg_layers) ){
	
	$options['page_title_options']['popup-options']['sectioneffectstab']['options']['background_layers'] = array(
		'type' => 'addable-popup',
		'label' => __('Background layers', 'creatus'),
		'popup-title' => esc_html__('Add/Edit Background Layer', 'creatus'),
		'desc' => esc_html__('Create background layer. Add parallax, infinity or basic background layer ', 'creatus'),
		'help' => esc_html__('Note that z-index is assigned per layer position in the order. The layer on top has the highest z-index.', 'creatus'),
		'template' => '{{=layer_title}}',
		'add-button-text' => esc_html__('Add/Edit Background layer', 'creatus'),
		'size' => 'large',
		'popup-options' => array(
			$bg_layers
		)
	);
}