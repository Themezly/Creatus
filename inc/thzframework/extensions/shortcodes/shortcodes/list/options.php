<?php
if (!defined('FW')) {
	die('Forbidden');
}
$options = array(
	'defaulttab' => array(
		'title' => __('Defaults', 'creatus'),
		'type' => 'tab',
		'options' => array(
			'id' => array(
				'type' => 'unique',
				'length' => 8
			),
			'type' => array(
				'type' => 'multi-picker',
				'label' => false,
				'desc' => false,
				'picker' => array(
					'picked' => array(
						'label' => __('List Type', 'creatus'),
						'desc' => esc_html__('Select list type', 'creatus'),
						'type' => 'short-select',
						'value' => 'default',
						'choices' => array(
							'default' => esc_html__('Default list', 'creatus'),
							'ordered' => esc_html__('Ordered list', 'creatus'),
							'unstyled' => esc_html__('Unstyled list', 'creatus'),
							'icons' => esc_html__('Icon list', 'creatus')
						)
					)
				),
				'choices' => array(
					'icons' => array(
						'icon' => array(
							'type' => 'thz-icon',
							'value' => array(
								'icon' => '',
								'size' => '',
								'v-nudge' => '',
								'h-nudge' => '',
								'space' => '',
								'color' => ''
							),
							'label' => __('List Icon', 'creatus'),
							'desc' => esc_html__('Add items icon. Can be overwritten by Item Icon.', 'creatus')
						),
						
						'ip' => array(
							'label' => __('Icon position', 'creatus'),
							'desc' => esc_html__('Select icon position', 'creatus'),
							'type' => 'short-select',
							'value' => 'left',
							'choices' => array(
								'left' => esc_html__('Left', 'creatus'),
								'right' => esc_html__('Right', 'creatus'),
							)
						)
					)
				)
			),
			'items' => array(
				'type' => 'addable-popup',
				'label' => __('List items', 'creatus'),
				'popup-title' => esc_html__('Add/Edit List item', 'creatus'),
				'desc' => esc_html__('Create your list items', 'creatus'),
				'template' => '{{=title}}',
				'size' => 'large',
				'popup-options' => array(
					'itemid' => array(
						'type' => 'unique',
						'length' => 8
					),
					'title' => array(
						'type' => 'text',
						'label' => __('Title', 'creatus'),
						'value' => 'Item title',
						'desc' => esc_html__('Set item title', 'creatus')
					),
					'icon' => array(
						'type' => 'thz-icon',
						'value' => array(
							'icon' => '',
							'size' => '',
							'v-nudge' => '',
							'h-nudge' => '',
							'space' => 5,
							'color' => ''
						),
						'label' => __('Item Icon', 'creatus'),
						'desc' => esc_html__('Add item icon. This icon overrides List type "Icon list" icon', 'creatus')
					),
					'ip' => array(
						'label' => __('Icon position', 'creatus'),
						'desc' => esc_html__('Select icon position', 'creatus'),
						'type' => 'short-select',
						'value' => 'left',
						'choices' => array(
							'left' => esc_html__('Left', 'creatus'),
							'right' => esc_html__('Right', 'creatus'),
						)
					),
					'link' => array(
						'label' => __('Add link', 'creatus'),
						'desc' => esc_html__('Add link for this item', 'creatus'),
						'type' => 'thz-url',
						'value' => array(
							'type' => 'normal',
							'url' => '',
							'title' => '',
							'target' => '_self',
							'magnific' => ''
						),
						'data-parent' => 'parent',
						'data-type' => '.thz-url-type,.linkType',
						'data-link' => '.thz-url-input,.normalLink',
						'data-title' => '.thz-url-title,.linkTitle',
						'data-target' => '.thz-url-target,.linkTarget',
						'data-magnific' => '.thz-url-magnific,.magnificId',
						'data-hide' => 'hide-title'
					),
					'subitems' => array(
						'type' => 'addable-popup',
						'label' => __('Sub items', 'creatus'),
						'popup-title' => esc_html__('Add/Edit Sub item', 'creatus'),
						'desc' => esc_html__('Create sub items', 'creatus'),
						'template' => '{{=title}}',
						'size' => 'large',
						'popup-options' => array(
							'itemid' => array(
								'type' => 'unique',
								'length' => 8
							),
							'title' => array(
								'type' => 'text',
								'label' => __('Title', 'creatus'),
								'value' => 'Sub Item title'
							),
							'icon' => array(
								'type' => 'thz-icon',
								'value' => array(
									'icon' => '',
									'size' => '',
									'v-nudge' => '',
									'h-nudge' => '',
									'space' => '',
									'color' => ''
								),
								'label' => __('Sub Item Icon', 'creatus'),
								'desc' => esc_html__('Add subitem icon. This icon overrides List type "Icon list" icon.', 'creatus')
							),
							'ip' => array(
								'label' => __('Icon position', 'creatus'),
								'desc' => esc_html__('Select icon position', 'creatus'),
								'type' => 'short-select',
								'value' => 'left',
								'choices' => array(
									'left' => esc_html__('Left', 'creatus'),
									'right' => esc_html__('Right', 'creatus'),
								)
							),
							'link' => array(
								'label' => __('Add link', 'creatus'),
								'desc' => esc_html__('Add link for this item', 'creatus'),
								'type' => 'thz-url',
								'value' => array(
									'type' => 'normal',
									'url' => '',
									'title' => '',
									'target' => '_self',
									'magnific' => ''
								),
								'data-parent' => 'parent',
								'data-type' => '.thz-url-type,.linkType',
								'data-link' => '.thz-url-input,.normalLink',
								'data-title' => '.thz-url-title,.linkTitle',
								'data-target' => '.thz-url-target,.linkTarget',
								'data-magnific' => '.thz-url-magnific,.magnificId'
							)
						)
					)
				)
			)
		)
	),
	'styletab' => array(
		'title' => __('Style', 'creatus'),
		'type' => 'tab',
		'options' => array(
		
			'if' => array(
				'type' => 'thz-typography',
				'label' => __('Items font', 'creatus'),
				'value' => array(),
				'disable' => array('hovered'),
				'desc' => esc_html__('Adjust items font.', 'creatus'),
			),

			'ulbs' => array(
				'type' => 'thz-box-style',
				'label' => __('List box style', 'creatus'),
				'desc' => esc_html__('Adjust .thz-shortcode-list box style', 'creatus'),
				'preview' => true,
				'popup' => true,
				'button-text' => esc_html__('Customize list box style', 'creatus'),
				'disable' => array(
					'video',
				),
				'units' => array(
					'borderradius',
					'boxsize',
					'padding',
					'margin',
				),
				'value' => array()
			),
			'bs' => array(
				'type' => 'thz-box-style',
				'label' => __('Items box style', 'creatus'),
				'desc' => esc_html__('Adjust .thz-list-item box style', 'creatus'),
				'preview' => true,
				'popup' => true,
				'button-text' => esc_html__('Customize list items box style', 'creatus'),
				'disable' => array(
					'video',
				),
				'units' => array(
					'borderradius',
					'boxsize',
					'padding',
					'margin',
				),
				'value' => array()
			),
			
			'subs' => array(
				'type' => 'thz-box-style',
				'label' => __('Sub list box style', 'creatus'),
				'desc' => esc_html__('Adjust .thz-list-item .sub-list box style', 'creatus'),
				'preview' => true,
				'popup' => true,
				'button-text' => esc_html__('Customize items sub list box style', 'creatus'),
				'disable' => array(
					'video',
				),
				'units' => array(
					'borderradius',
					'boxsize',
					'padding',
					'margin',
				),
				'value' => array()
			),
			
			'mx' => array(
				'type' => 'thz-multi-options',
				'label' => __('List items metrics', 'creatus'),
				'desc' => esc_html__('Reset item margin, padding and border or set items links colors', 'creatus'),
				'value' => array(
					'pr' => 'donotreset',
					'mr' => 'donotreset',
					'bo' => 'donotreset',
					'l' => '',
					'h' => ''
				),
				'thz_options' => array(
					'pr' => array(
						'type' => 'short-select',
						'title' => esc_html__('Padding reset', 'creatus'),
						'choices' => array(
							'first_top' => esc_html__('Reset first item top padding', 'creatus'),
							'first_bottom' => esc_html__('Reset first item bottom padding', 'creatus'),
							'last_top' => esc_html__('Reset last item top padding', 'creatus'),
							'last_bottom' => esc_html__('Reset last item bottom padding', 'creatus'),
							'donotreset' => esc_html__('Do not reset', 'creatus'),
						)
					),
					'mr' => array(
						'type' => 'short-select',
						'title' => esc_html__('Margin reset', 'creatus'),
						'choices' => array(
							'first_top' => esc_html__('Reset first item top margin', 'creatus'),
							'first_bottom' => esc_html__('Reset first item bottom margin', 'creatus'),
							'last_top' => esc_html__('Reset last item top margin', 'creatus'),
							'last_bottom' => esc_html__('Reset last item bottom margin', 'creatus'),
							'donotreset' => esc_html__('Do not reset', 'creatus'),
						)
					),
					
					'bo' => array(
						'type' => 'short-select',
						'title' => esc_html__('Borders reset', 'creatus'),
						'choices' => array(
							'first_top' => esc_html__('Reset first item top border', 'creatus'),
							'first_bottom' => esc_html__('Reset first item bottom border', 'creatus'),
							'last_top' => esc_html__('Reset last item top border', 'creatus'),
							'last_bottom' => esc_html__('Reset last item bottom border', 'creatus'),
							'donotreset' => esc_html__('Do not reset', 'creatus'),
						)
					),
					
					'l' => array(
						'type' => 'color',
						'title' => esc_html__('Link color', 'creatus'),
						'box' => true
					),
					'h' => array(
						'type' => 'color',
						'title' => esc_html__('Hovered', 'creatus'),
						'box' => true
					)
				)
			),
			
			'cmx' => _thz_container_metrics_defaults(),
			
			'instyle' => array(
				'type' => 'short-text',
				'label' => __('Inherit style from', 'creatus'),
				'desc' => esc_html__('Insert list ID to inherit the style from. See help for more info.', 'creatus'),
				'help' => esc_html__('If you have multiple lists with same style you can set main list Custom ID than add that ID here. This way every list on this page with this inherit ID will use same CSS. This reduces the overhead CSS and renders the list faster. Note that once the inherit ID is added the CSS for this list is not printed. The effects must be set on per element basis.', 'creatus'),
				'value' => ''
			),
			
		)
	),
	'itemsgrideffects' => array(
		'title' => __('Effects', 'creatus'),
		'type' => 'tab',
		'options' => array(
			'animate' => array(
				'type' => 'thz-animation',
				'label' => false,
				'value' => array(
					'animate' => 'inactive',
					'effect' => 'thz-anim-slideIn-up',
					'duration' => 400,
					'delay' => 200
				),
				'addlabel' => esc_html__('Animate items', 'creatus'),
				'adddesc' => esc_html__('Add animation to items HTML container', 'creatus')
			),
			'cpx' => _thz_container_parallax_default()
		)
	)	
);