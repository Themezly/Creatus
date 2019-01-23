<?php
if (!defined('FW')) {
	die('Forbidden');
}
$options = array(
	'project_layout' => array(
		'type' => 'multi-picker',
		'label' => false,
		'desc' => false,
		'show_borders' => true,
		'picker' => array(
			'picked' => array(
				'label' => __('Project layout', 'creatus'),
				'desc' => esc_html__('Select project layout type', 'creatus'),
				'help' => esc_html__('Full; Media is above or under the project, content and meta are in a 2 columns grid. Sidebar; Content and meta are in a sidebar and media is left or right of the sidebar. Page builder; All project elements are disabled and you can use the page builder just like you would in page post type.', 'creatus'),
				'type' => 'short-select',
				'value' => 'full',
				'attr' => array(
					'class' => 'thz-select-switch'
				),
				'choices' => array(
					'full' => array(
						'text' => esc_html__('Full', 'creatus'),
						'attr' => array(
							'data-enable' => '.proj-elements,#fw-backend-option-fw-option-prel_mx,#fw-backend-option-fw-option-pcom_mx,#fw-backend-option-fw-edit-options-modal-prel_mx,#fw-backend-option-fw-edit-options-modal-pcom_mx',
							'data-check' =>'.related-switch'
						)
					),
					'sidebar' => array(
						'text' => esc_html__('Sidebar ( Project content and meta in sidebar ) ', 'creatus'),
						'attr' => array(
							'data-enable' => '.proj-elements,#fw-backend-option-fw-option-prel_mx,#fw-backend-option-fw-option-pcom_mx,#fw-backend-option-fw-edit-options-modal-prel_mx,#fw-backend-option-fw-edit-options-modal-pcom_mx',
							'data-check' =>'.related-switch'
							
						)
					),
					'builder' => array(
						'text' => esc_html__('Page builder ( Disable all project elements and use page builder ) ', 'creatus'),
						'attr' => array(
							'data-disable' => '.proj-elements,#fw-backend-option-fw-option-prel_mx,#fw-backend-option-fw-option-pcom_mx,#fw-backend-option-fw-edit-options-modal-prel_mx,#fw-backend-option-fw-edit-options-modal-pcom_mx,.thz-related-projects-li',
						)
					),
				),

			)
		),
		'choices' => array(
			'full' => array(
			
			'media_mx' => array(
					'type' => 'thz-multi-options',
					'label' => __('Media holder', 'creatus'),
					'desc' => esc_html__('Adjust media holder metrics. See help for more info.', 'creatus'),
					'help' => esc_html__('Note that the holder and max width settings are effective only if there is no active page sidebar.', 'creatus'),
					'value' => array(
						'l' => 'above',
						'h' => 'contained',
						'm' => 100,
					),
					'thz_options' => array(
						'l' => array(
							'title' => esc_html__('Location', 'creatus'),
							'type' => 'short-select',
							'choices' => array(
								'above' => __('Above the project details', 'creatus'),
								'under' => __('Under the project details', 'creatus'),
							),
						),
						'h' => array(
							'type' => 'short-select',
							'title' => __('Holder', 'creatus'),
							'choices' => array(
								'contained' => __('Contained', 'creatus'),
								'notcontained' => __('Not contained', 'creatus'),
								'full' => __('Full width no side space', 'creatus'),
							),
						),
						'm' => array(
							'type' => 'select',
							'title' => esc_html__('Max width', 'creatus'),
							'choices' => _thz_max_width_list(),
						),					
					)
				),
				'details_mx' => array(
					'type' => 'thz-multi-options',
					'label' => __('Details holder metrics', 'creatus'),
					'desc' => esc_html__('Adjust .thz-project-details-holder. See help for more info.', 'creatus'),
					'help' => esc_html__('Note that the holder and max width settings are effective only if there is no active page sidebar.', 'creatus'),
					'value' => array(
						'h' => 'contained',
						'm' => 100,
					),
					'thz_options' => array(
						'h' => array(
							'type' => 'short-select',
							'title' => __('Holder', 'creatus'),
							'choices' => array(
								'contained' => __('Contained', 'creatus'),
								'notcontained' => __('Not contained', 'creatus'),
							),
						),
						'm' => array(
							'type' => 'select',
							'title' => esc_html__('Max width', 'creatus'),
							'choices' => _thz_max_width_list(),
						),					
					)
				),
				'prmeta_side' => array(
					'label' => __('Meta side', 'creatus'),
					'desc' => esc_html__('Choose project meta side.', 'creatus'),
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
				'side_width' => array(
					'label' => __('Meta width', 'creatus'),
					'desc' => esc_html__('Select project meta width', 'creatus'),
					'type' => 'radio',
					'value' => 'thz-col-1-3',
					'inline' => true,
					'choices' => array(
						'thz-col-1-2' => esc_html__('50%', 'creatus'),
						'thz-col-1-3' => esc_html__('33.3%', 'creatus'),
						'thz-col-1-4' => esc_html__('20%', 'creatus')
					)
				),
				'side_space' => array(
					'type' => 'thz-spinner',
					'label' => __('Meta space', 'creatus'),
					'desc' => esc_html__('Set space between meta and content', 'creatus'),
					'addon' => 'px',
					'min' => 0,
					'max' => 300,
					'value' => 60
				),

			),
			'sidebar' => array(
				'holder_mx' => array(
					'type' => 'thz-multi-options',
					'label' => __('Project holder', 'creatus'),
					'desc' => esc_html__('Adjust .thz-project-holder. See help for more info.', 'creatus'),
					'help' => esc_html__('Note that the holder and max width settings are effective only if there is no active page sidebar.', 'creatus'),
					'value' => array(
						'h' => 'contained',
						'm' => 100,
					),
					'thz_options' => array(
						'h' => array(
							'type' => 'short-select',
							'title' => __('Holder', 'creatus'),
							'choices' => array(
								'contained' => __('Contained', 'creatus'),
								'notcontained' => __('Not contained', 'creatus'),
							),
						),
						'm' => array(
							'type' => 'select',
							'title' => esc_html__('Max width', 'creatus'),
							'choices' => _thz_max_width_list(),
						),					
					)
				),
				'sidebar_side' => array(
					'label' => __('Sidebar side', 'creatus'),
					'desc' => esc_html__('Choose sidebar  side.', 'creatus'),
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
				'sticky_sidebar' => array(
					'label' => __('Sticky sidebar', 'creatus'),
					'desc' => esc_html__('Make sidebar stick while scrolling', 'creatus'),
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
				'side_width' => array(
					'label' => __('Sidebar width', 'creatus'),
					'desc' => esc_html__('Select project sidebar width', 'creatus'),
					'type' => 'radio',
					'inline' => true,
					'value' => 'thz-col-1-3',
					'choices' => array(
						'thz-col-1-2' => esc_html__('50%', 'creatus'),
						'thz-col-1-3' => esc_html__('33.3%', 'creatus'),
						'thz-col-1-4' => esc_html__('20%', 'creatus')
					)
				),
				'side_space' => array(
					'type' => 'thz-spinner',
					'label' => __('Sidebar space', 'creatus'),
					'desc' => esc_html__('Set space between sidebar and media', 'creatus'),
					'addon' => 'px',
					'min' => 0,
					'max' => 300,
					'value' => 60
				),

			)
		)
	),

	'prel_mx' => array(
			'type' => 'thz-multi-options',
			'label' => __('Related projects', 'creatus'),
			'desc' => esc_html__('Adjust related project visibility and holder. See help for more info.', 'creatus'),
			'help' => esc_html__('Note that the holder and max width settings are effective only if there is no active page sidebar or location is outside.', 'creatus'),
			'value' => array(
				'v' => 'show',
				'l' => 'inside',
				'h' => 'contained',
				'm' => 100,
			),
			'thz_options' => array(
				'v' => array(
					'title' => esc_html__('Visibility', 'creatus'),
					'type' => 'short-select',
					'attr' => array(
						'class' => 'thz-select-switch related-switch'
					),
					'choices' => array(
						'show' => array(
							'text' => esc_html__('Show', 'creatus'),
							'attr' => array(
								'data-enable' => '.prel-hol-mx-parent,.thz-related-projects-li',
							)
						),
						'hide' => array(
							'text' => esc_html__('Hide', 'creatus'),
							'attr' => array(
								'data-disable' => '.prel-hol-mx-parent,.thz-related-projects-li',
								
							)
						),
					)
				),
				'l' => array(
					'type' => 'short-select',
					'title' => __('Location', 'creatus'),
					'choices' => array(
						'outside' => __('Outside ( above the footer )', 'creatus'),
						'inside' => __('Inside ( inside the article ) ', 'creatus')
					),
					'attr' => array(
						'class' => 'prel-hol-mx'
					)
				),
				'h' => array(
					'type' => 'short-select',
					'title' => __('Holder', 'creatus'),
					'choices' => array(
						'contained' => __('Contained', 'creatus'),
						'notcontained' => __('Not contained', 'creatus'),
					),
					'attr' => array(
						'class' => 'prel-hol-mx'
					),
				),
				'm' => array(
					'type' => 'select',
					'title' => esc_html__('Max width', 'creatus'),
					'choices' => _thz_max_width_list(),
					'attr' => array(
						'class' => 'prel-hol-mx'
					),
				),					
			)
		),
		
		
	'pcom_mx' => array(
			'type' => 'thz-multi-options',
			'label' => __('Project comments', 'creatus'),
			'desc' => esc_html__('Adjust project comments visibility and holder. See help for more info.', 'creatus'),
			'help' => esc_html__('Note that the holder and max width settings are effective only if there is no active page sidebar or location is outside.', 'creatus'),
			'value' => array(
				'v' => 'show',
				'l' => 'inside',
				'h' => 'contained',
				'm' => 100,
			),
			'thz_options' => array(
				'v' => array(
					'title' => esc_html__('Visibility', 'creatus'),
					'type' => 'short-select',
					'attr' => array(
						'class' => 'thz-select-switch'
					),
					'choices' => array(
						'show' => array(
							'text' => esc_html__('Show', 'creatus'),
							'attr' => array(
								'data-enable' => '.pcom-hol-mx-parent',
								
							)
						),
						'hide' => array(
							'text' => esc_html__('Hide', 'creatus'),
							'attr' => array(
								'data-disable' => '.pcom-hol-mx-parent',
								
							)
						),
					)
				),
				'l' => array(
					'type' => 'short-select',
					'title' => __('Location', 'creatus'),
					'choices' => array(
						'outside' => __('Outside ( above the footer )', 'creatus'),
						'inside' => __('Inside ( inside the article ) ', 'creatus')
					),
					'attr' => array(
						'class' => 'pcom-hol-mx'
					)
				),
				'h' => array(
					'type' => 'short-select',
					'title' => __('Holder', 'creatus'),
					'choices' => array(
						'contained' => __('Contained', 'creatus'),
						'notcontained' => __('Not contained', 'creatus'),
					),
					'attr' => array(
						'class' => 'pcom-hol-mx'
					),
				),
				'm' => array(
					'type' => 'select',
					'title' => esc_html__('Max width', 'creatus'),
					'choices' => _thz_max_width_list(),
					'attr' => array(
						'class' => 'pcom-hol-mx'
					),
				),					
			)
		),
		
	'pnav_mx' => array(
			'type' => 'thz-multi-options',
			'label' => __('Projects navigation', 'creatus'),
			'desc' => esc_html__('Adjust projects navigation ( next/previous ) visibility and holder. See help for more info.', 'creatus'),
			'help' => esc_html__('Note that the holder and max width settings are effective only if there is no active page sidebar.', 'creatus'),
			'value' => array(
				'v' => 'show',
				'h' => 'contained',
				'm' => 100,
			),
			'thz_options' => array(
				'v' => array(
					'title' => esc_html__('Visibility', 'creatus'),
					'type' => 'short-select',
					'attr' => array(
						'class' => 'thz-select-switch'
					),
					'choices' => array(
						'show' => array(
							'text' => esc_html__('Show', 'creatus'),
							'attr' => array(
								'data-enable' => '.pnav-hol-mx-parent',
								
							)
						),
						'hide' => array(
							'text' => esc_html__('Hide', 'creatus'),
							'attr' => array(
								'data-disable' => '.pnav-hol-mx-parent',
								
							)
						),
					)
				),
				'h' => array(
					'type' => 'short-select',
					'title' => __('Holder', 'creatus'),
					'choices' => array(
						'contained' => __('Contained', 'creatus'),
						'notcontained' => __('Not contained', 'creatus'),
					),
					'attr' => array(
						'class' => 'pnav-hol-mx'
					),
				),
				'm' => array(
					'type' => 'select',
					'title' => esc_html__('Max width', 'creatus'),
					'choices' => _thz_max_width_list(),
					'attr' => array(
						'class' => 'pnav-hol-mx'
					),
				),					
			)
		),
);