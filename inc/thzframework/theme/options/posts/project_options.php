<?php
if (!defined('FW')) {
	die('Forbidden');
}
$options = array(
	'project_meta' => array(
		'type' => 'addable-popup',
		'attr' => array(
			'class' => 'prmetas-option'
		),
		'value' => array(
			array(
				'type' => array(
					'picked' => 'category',
					'category' => array(
						'name' => 'Category'
					)
				)
			),
			array(
				'type' => array(
					'picked' => 'text',
					'text' => array(
						'name' => 'Services',
						'text' => 'Design,Development'
					)
				)
			),
			array(
				'type' => array(
					'picked' => 'text',
					'text' => array(
						'name' => 'Year',
						'text' => '2016'
					)
				)
			),
			array(
				'type' => array(
					'picked' => 'link',
					'link' => array(
						'name' => 'Website',
						'url' => 'http://www.themezly.com/creatus',
						'text' => 'Visit project'
					)
				)
			)
		),
		'label' => __('Project meta', 'creatus'),
		'desc' => esc_html__('Add project meta', 'creatus'),
		'template' => '{{  var current = type.picked;  }}{{-type[current].name}}',
		'popup-title' => null,
		'size' => 'large',
		'add-button-text' => esc_html__('Add/edit project meta', 'creatus'),
		'sortable' => true,
		'popup-options' => array(
			'type' => array(
				'type' => 'multi-picker',
				'label' => false,
				'desc' => false,
				'show_borders' => true,
				'picker' => array(
					'picked' => array(
						'label' => __('Meta Type', 'creatus'),
						'desc' => esc_html__('Select meta type', 'creatus'),
						'type' => 'short-select',
						'value' => 'category',
						'choices' => array(
							'category' => esc_html__('Category', 'creatus'),
							'tags' => esc_html__('Tags', 'creatus'),
							'date' => esc_html__('Date', 'creatus'),
							'link' => esc_html__('Link', 'creatus'),
							'text' => esc_html__('Text', 'creatus'),
							'user' => esc_html__('User', 'creatus')
						)
					)
				),
				'choices' => array(
					'category' => array(
						'name' => array(
							'label' => __('Name', 'creatus'),
							'type' => 'text',
							'value' => 'Category',
							'desc' => esc_html__('Set meta name', 'creatus')
						)
					),
					'tags' => array(
						'name' => array(
							'label' => __('Tags', 'creatus'),
							'type' => 'text',
							'value' => 'Tags',
							'desc' => esc_html__('Set meta name', 'creatus')
						)
					),
					'date' => array(
						'name' => array(
							'label' => __('Name', 'creatus'),
							'type' => 'text',
							'value' => 'Date',
							'desc' => esc_html__('Set meta name', 'creatus')
						),
						'date' => array(
							'type' => 'datetime-picker',
							'label' => __('Date', 'creatus'),
							'desc' => esc_html__('Set project date.', 'creatus'),
							'datetime-picker' => array(
								'format' => 'M jS, Y',
								'timepicker' => false
							)
						)
					),
					'link' => array(
						'name' => array(
							'label' => __('Name', 'creatus'),
							'type' => 'text',
							'value' => 'Project URL',
							'desc' => esc_html__('Set meta name', 'creatus')
						),
						'text' => array(
							'label' => __('Link text', 'creatus'),
							'type' => 'text',
							'value' => '',
							'desc' => esc_html__('Set meta link', 'creatus')
						),
						'url' => array(
							'label' => __('URL', 'creatus'),
							'type' => 'text',
							'value' => '',
							'desc' => esc_html__('Set meta link', 'creatus')
						)
					),
					'text' => array(
						'name' => array(
							'label' => __('Name', 'creatus'),
							'type' => 'text',
							'value' => '',
							'desc' => esc_html__('Set meta name.', 'creatus')
						),
						'text' => array(
							'label' => __('Text', 'creatus'),
							'type' => 'wp-editor',
							'size' => 'large',
							'editor_height' => 200,
							'shortcodes' => false,
							'editor_type' => 'tinymce',
							'wpautop' => true,
							'value' => '',
							'desc' => esc_html__('Set meta text.', 'creatus')
						)
					),
					'user' => array(
						'name' => array(
							'label' => __('Name', 'creatus'),
							'type' => 'text',
							'value' => 'By',
							'desc' => esc_html__('Set meta name', 'creatus')
						),
						'user_type' => array(
							'type' => 'multi-picker',
							'label' => false,
							'desc' => false,
							'picker' => array(
								'picked' => array(
									'label' => __('User type', 'creatus'),
									'desc' => esc_html__('Select author or specific user', 'creatus'),
									'type' => 'switch',
									'right-choice' => array(
										'value' => 'author',
										'label' => __('Project author', 'creatus')
									),
									'left-choice' => array(
										'value' => 'specific',
										'label' => __('Specific user', 'creatus')
									),
									'value' => 'author'
								)
							),
							'choices' => array(
								'specific' => array(
									'userid' => array(
										'type' => 'multi-select',
										'value' => array(),
										'label' => __('User', 'creatus'),
										'desc' => esc_html__('Start typing username than click to select.', 'creatus'),
										'population' => 'users',
										'prepopulate' => false,
										'limit' => 1
									)
								)
							)
						),
						'displayname' => array(
							'label' => __('Display name', 'creatus'),
							'desc' => esc_html__('Choose how to display user name', 'creatus'),
							'type' => 'switch',
							'right-choice' => array(
								'value' => 'user_nicename',
								'label' => __('Username', 'creatus')
							),
							'left-choice' => array(
								'value' => 'display_name',
								'label' => __('Display name', 'creatus')
							),
							'value' => 'display_name'
						),
						'author' => array(
							'type' => 'thz-multi-options',
							'label' => __('Author metric', 'creatus'),
							'desc' => esc_html__('Adjust author metrics', 'creatus'),
							'value' => array(
								'link' => 'link',
								'show' => 'hide',
								'size' => 20,
								'shape' => 'circle',
								'space' => 5,
							),
							'thz_options' => array(
								'link' => array(
									'type' => 'short-select',
									'title' => esc_html__('Author link', 'creatus'),
									'choices' => array(
										'link' => esc_html__('Link to author page', 'creatus'),
										'donotlink' => esc_html__('Do not link to author page', 'creatus'),
									)
								),
								'show' => array(
									'title' => esc_html__('Author avatar', 'creatus'),
									'type' => 'short-select',
									'value' => 'show',
									'attr' => array(
										'class' => 'thz-select-switch'
									),
									'choices' => array(
										'show' => array(
											'text' => esc_html__('Show', 'creatus'),
											'attr' => array(
												'data-enable' => '.projmea-size-parent,.projmea-shape-parent,.projmea-space-parent',
											)
										),
										'hide' => array(
											'text' => esc_html__('Hide', 'creatus'),
											'attr' => array(
												'data-disable' => '.projmea-size-parent,.projmea-shape-parent,.projmea-space-parent',
											)
										),
									)
								),
								'size' => array(
									'type' => 'spinner',
									'title' => esc_html__('Avatar size', 'creatus'),
									'addon' => 'px',
									'min' => 10,
									'attr' => array(
										'class' => 'projmea-size'
									),
								),
								'shape' => array(
									'type' => 'short-select',
									'title' => esc_html__('Avatar shape', 'creatus'),
									'choices' => array(
										'square' => esc_html__('Square', 'creatus'),
										'rounded' => esc_html__('Rounded', 'creatus'),
										'circle' => esc_html__('Circle', 'creatus'),
									),
									'attr' => array(
										'class' => 'projmea-shape'
									),
								),
								'space' => array(
									'type' => 'spinner',
									'title' => esc_html__('Avatar space', 'creatus'),
									'addon' => 'px',
									'max' => 100,
									'attr' => array(
										'class' => 'projmea-space'
									),
								),			
							)
						),
					)
				)
			)
		)
	),
	'custom_post_options' => array(
		'type' => 'addable-popup',
		'value' => array(),
		'label' => __('Custom project options', 'creatus'),
		'desc' => esc_html__('Add custom project options for this page or leave as is for theme defaults.', 'creatus'),
		'template' => esc_html__('Custom project options for this page', 'creatus'),
		'popup-title' => null,
		'size' => 'large',
		'limit' => 1,
		'attr' => array(
			'class' => 'custom_options_popup'
		),
		'add-button-text' => esc_html__('Add custom project options', 'creatus'),
		'sortable' => false,
		'popup-options' => array(
			fw()->theme->get_options('posts/page_options_project')
		)
	)
);