<?php
if (!defined('FW')) {
	die('Forbidden');
}

$options = array(
	'search_grid' => array(
		'type' => 'thz-multi-options',
		'label' => __('Search grid settings', 'creatus'),
		'desc' => esc_html__('Set search items grid columns, gutter, results per page and search filter', 'creatus'),
		'value' => array(
			'columns' => 3,
			'gutter' => 30,
			'results' => 9,
			'isotope' => 'fitRows',
			'for' => 'any',
			'filter' => array()
		),
		'breakafter' => 'for',
		'thz_options' => array(
			'gutter' => array(
				'type' => 'spinner',
				'title' => esc_html__('Gutter', 'creatus'),
				'addon' => 'px',
				'min' => 0,
				'max' => 100
			),
			'columns' => array(
				'type' => 'select',
				'title' => esc_html__('Columns', 'creatus'),
				'choices' => array(
					'1' => esc_html__('1', 'creatus'),
					'2' => esc_html__('2', 'creatus'),
					'3' => esc_html__('3', 'creatus'),
					'4' => esc_html__('4', 'creatus'),
					'5' => esc_html__('5', 'creatus'),
					'6' => esc_html__('6', 'creatus')
				)
			),
			'results' => array(
				'type' => 'spinner',
				'title' => esc_html__('Per page', 'creatus'),
				'addon' => '#',
				'min' => 1,
				'max' => 100
			),
			'isotope' => array(
				'type' => 'short-select',
				'title' => esc_html__('Isotope mode', 'creatus'),
				'choices' => array(
					'packery' => esc_html__('Packery ( Masonry, place items where they fit )', 'creatus'),
					'fitRows' => esc_html__('fitRows ( Row height by tallest item in row )', 'creatus'),
					'vertical' => esc_html__('Vertical ( best with 1 column grid ) ', 'creatus')
				)
			),
			'for' => array(
				'type' => 'select',
				'title' => esc_html__('Search for', 'creatus'),
				'attr' => array(
					'class' => 'thz-select-switch'
				),
				'choices' => array(
					'custom' => array(
						'text' => esc_html__('Custom filter results', 'creatus'),
						'attr' => array(
							'data-enable' => '.seaf-op-parent'
						)
					),
					'any' => array(
						'text' => esc_html__('Do not filter results', 'creatus'),
						'attr' => array(
							'data-disable' => '.seaf-op-parent'
						)
					)
					
				)
				
			),
			'filter' => array(
				'type' => 'checkboxes',
				'title' => esc_html__('Show search results for', 'creatus'),
				'choices' => 'posts',
				'attr' => array(
					'class' => 'seaf-op'
				)
			)
		)
	),
	'search_bs' => array(
		'type' => 'thz-box-style',
		'label' => __('Search item box style', 'creatus'),
		'desc' => esc_html__('Customize .thz-grid-item-in box style', 'creatus'),
		'preview' => true,
		'button-text' => esc_html__('Customize search item box style', 'creatus'),
		'popup' => true,
		'disable' => array(
			'layout',
			'margin',
			'boxsize',
			'transform',
			'video'
		),
		'value' => array(
			'padding' => array(
				'top' => 20,
				'right' => 20,
				'bottom' => 20,
				'left' => 20
			),
			'borders' => array(
				'all' => 'same',
				'top' => array(
					'w' => 1,
					's' => 'solid',
					'c' => 'color_4'
				)
			),
			'borderradius' => array(
				'top-left' => 2,
				'top-right' => 2,
				'bottom-left' => 2,
				'bottom-right' => 2
			),
			'background' => array(
				'type' => 'color',
				'color' => 'color_5'
			)
		)
	),
	'search_spacings' => array(
		'type' => 'thz-multi-options',
		'label' => __('Search elements spacings', 'creatus'),
		'desc' => esc_html__('Adjust search page elements spacings. This is elements bottom margin.', 'creatus'),
		'value' => array(
			'form' => 30,
			'grid' => 0,
			'type' => 10,
			'title' => 10,
			'meta' => 0
		),
		'thz_options' => array(
			'form' => array(
				'type' => 'spinner',
				'title' => esc_html__('Form', 'creatus'),
				'addon' => 'px',
				'min' => -100,
				'max' => 100
			),
			'grid' => array(
				'type' => 'spinner',
				'title' => esc_html__('Grid', 'creatus'),
				'addon' => 'px',
				'min' => -100,
				'max' => 100
			),
			'type' => array(
				'type' => 'spinner',
				'title' => esc_html__('Type', 'creatus'),
				'addon' => 'px',
				'min' => 0,
				'max' => 100
			),
			'title' => array(
				'type' => 'spinner',
				'title' => esc_html__('Title', 'creatus'),
				'addon' => 'px',
				'min' => -100,
				'max' => 100
			),
			'meta' => array(
				'type' => 'spinner',
				'title' => esc_html__('Meta', 'creatus'),
				'addon' => 'px',
				'min' => -100,
				'max' => 100
			)
		)
	),
	'search_title' => array(
		'type' => 'thz-typography',
		'label' => __('Search title font', 'creatus'),
		'desc' => esc_html__('Adjust search item title font metrics.', 'creatus'),
		'value' => array(
			'size' => 18,
			'line-height' => '1.3'
		)
	),
	'search_meta' => array(
		'type' => 'multi-picker',
		'label' => false,
		'desc' => false,
		'picker' => array(
			'picked' => array(
				'label' => __('Show item meta', 'creatus'),
				'desc' => esc_html__('Show/hide search item meta', 'creatus'),
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
				
				'els' => array(
					'type' => 'thz-sortable-checks',
					'value' => array(
						'date'
					),
					'label' => __('Meta elements', 'creatus'),
					'desc' => esc_html__('Check to show/hide specific post meta elements. Click and drag the label to sort.', 'creatus'),
					'choices' => _thz_meta_choices()
				),
				
				'pref' => _thz_metas_preferences('meta'),
				
				
				'sep' => array(
					'type' => 'thz-multi-options',
					'label' => __('Meta separator', 'creatus'),
					'desc' => esc_html__('Adjust meta elements separator. See help for more info.', 'creatus'),
					'help' => esc_html__('This option will let you adjust space between separator and elements. Nudge option can help you align the separator verticaly. This can come in handy if separator is icon and icon font does not place the icon in absolute vertical middle. Nudge moves relative top position of the separator.', 'creatus'),
					'value' => array(
						'ty' => 'textual',
						't' => '|',
						'i' => 'thzicon thzicon-primitive-dot',
						'fs' => '',
						's' => 5,
						'n' => 0
						
					),
					'thz_options' => array(
						'ty' => array(
							'title' => esc_html__('Separator Type', 'creatus'),
							'type' => 'short-select',
							'value' => 'show',
							'attr' => array(
								'class' => 'thz-select-switch'
							),
							'choices' => array(
								'textual' => array(
									'text' => esc_html__('Textual', 'creatus'),
									'attr' => array(
										'data-enable' => '.pos_sep-text-parent',
										'data-disable' => '.pos_sep-icon-parent'
										
									)
								),
								'icon' => array(
									'text' => esc_html__('Icon', 'creatus'),
									'attr' => array(
										'data-enable' => '.pos_sep-icon-parent',
										'data-disable' => '.pos_sep-text-parent'
										
									)
								)
							)
						),
						't' => array(
							'type' => 'short-text',
							'title' => esc_html__('Separator', 'creatus'),
							'attr' => array(
								'class' => 'pos_sep-text'
							)
						),
						'i' => array(
							'type' => 'icon',
							'title' => esc_html__('Icon', 'creatus'),
							'attr' => array(
								'class' => 'pos_sep-icon'
							)
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
							'max' => 100
						),
						'n' => array(
							'type' => 'spinner',
							'title' => esc_html__('Nudge', 'creatus'),
							'addon' => 'px',
							'min' => -20,
							'max' => 20
						)
						
					)
				),
				
				'font' => array(
					'type' => 'thz-typography',
					'label' => __('Meta font', 'creatus'),
					'desc' => esc_html__('Adjust search item meta font metrics.', 'creatus'),
					'value' => array(),
					'disable' => array(
						'color',
						'hovered'
					)
				),
				
				'colors' => array(
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
		)
	),
	'search_type' => array(
		'type' => 'multi-picker',
		'label' => false,
		'desc' => false,
		'picker' => array(
			'picked' => array(
				'label' => __('Show item type', 'creatus'),
				'desc' => esc_html__('Show/hide search item type', 'creatus'),
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
				'font' => array(
					'type' => 'thz-typography',
					'label' => __('Item type font', 'creatus'),
					'desc' => esc_html__('Adjust search item type font metrics.', 'creatus'),
					'value' => array(
						'size' => 13,
						'style' => 'italic'
					),
					'disable' => array(
						'hovered'
					)
				)
			)
		)
	)
);