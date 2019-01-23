<?php
if (!defined('FW')) {
	die('Forbidden');
}

$title_template = '<b>{{-tab_title}}</b>';
$title_template .= '{{  if( ctype ==\'page_blocks\'){ }}';
$title_template .= '<span class="thz-bsp"></span>Page blocks: {{= page_blocks }}';
$title_template .= '{{ } }}';
$title_template .= '{{  if( ctype ==\'editor\' && tab_content.length > 0){ }}';
$title_template .= '{{  var tabs_text = thz.thz_strip_tags_to_space(tab_content); }}';
$title_template .= '{{  if(tabs_text.length > 60){ tabs_text = tabs_text.substring(0, 60) + \'...\'; } }}';
$title_template .= '<span class="thz-bsp"></span>{{= tabs_text }}';
$title_template .= '{{ } }}';

$options = array(
	'defaultstab' => array(
		'title' => __('Defaults', 'creatus'),
		'type' => 'tab',
		'options' => array(
			'id' => array(
				'type' => 'unique',
				'length' => 8
			),
			'sort_title' => array(
				'type' => 'text',
				'label' => __('Sorting title', 'creatus'),
				'value' => '',
				'desc' => esc_html__('Used only in builder for easy sorting.', 'creatus')
			),
			'tabs' => array(
				'type' => 'addable-popup',
				'label' => __('Tabs', 'creatus'),
				'popup-title' => esc_html__('Add/Edit Tab', 'creatus'),
				'desc' => esc_html__('Create your tabs', 'creatus'),
				'template' => $title_template,
				'size' => 'large',
				'popup-options' => array(
					'tab_title' => array(
						'type' => 'text',
						'label' => __('Title', 'creatus'),
						'value' => 'Tab title',
						'desc' => esc_html__('Set tab title.', 'creatus')
					),
					'imx' => array(
						'type' => 'thz-multi-options',
						'label' => __('Tab icon metrics', 'creatus'),
						'desc' => esc_html__('Add tab icon and adjust the settings. See help for more info.', 'creatus'),
						'help' => esc_html__('If icon size is not set the size is inherited from title font size. Nudge vertical or horizontal moves the icon ( up/down or left/right ) in case it is not positioned properly. Space is the margin between the icon and the title and it is adjusted based on the icon position.', 'creatus'),
						'value' => array(
							'i' => '',
							's' => '',
							'p' => 'left',
							'v' => '',
							'h' => '',
							'm' => 10,
						),
						'thz_options' => array(
							'i' => array(
								'type' => 'icon',
								'title' => esc_html__('Icon', 'creatus'),
								'box' => true
							),
							's' => array(
								'type' => 'spinner',
								'title' => esc_html__('Size', 'creatus'),
								'addon' => 'px'
							),
							'p' => array(
								'type' => 'short-select',
								'title' => esc_html__('Position', 'creatus'),
								'choices' => array(
									'left' => esc_html__('Left', 'creatus'),
									'right' => esc_html__('Right', 'creatus'),
									'above' => esc_html__('Above', 'creatus'),
								)
							),
							'v' => array(
								'type' => 'spinner',
								'title' => esc_html__('V-nudge', 'creatus'),
								'addon' => 'px'
							),
							'h' => array(
								'type' => 'spinner',
								'title' => esc_html__('H-nudge', 'creatus'),
								'addon' => 'px'
							),
							'm' => array(
								'type' => 'spinner',
								'title' => esc_html__('Space', 'creatus'),
								'addon' => 'px'
							),
						)
					),
					
					'ctype' => array(
						'type' => 'select',
						'label' => esc_html__('Content type', 'creatus'),
						'desc' => esc_html__('Select content type.', 'creatus'),
						'value' =>'editor',
						'attr' => array(
							'class' => 'thz-select-switch'
						),
						'choices' => array(
							'editor' =>array(
								'text' =>  esc_html__('Editor', 'creatus'),
								'attr' => array(
									'data-enable' => 'tab_content',
									'data-disable' => 'page_blocks',
									
								)
							),
							'page_blocks' =>array(
								'text' =>  esc_html__('Page Blocks', 'creatus'),
								'attr' => array(
									'data-enable' => 'page_blocks',
									'data-disable' => 'tab_content',
								)
							),
						)				
		
					),
					
					'page_blocks' => array(
						'type' => 'multi-select',
						'value' => array(),
						'attr' => array(
							'class' => 'thz-pageblock-multi'
						),
						'label' => __('Page blocks', 'creatus'),
						'desc' => esc_html__('Type in block name or select from the list. Drag and drop to reorder.', 'creatus'),
						'population' => 'posts',
						'source' => array('thz-pageblock'),
						'prepopulate' => 10,
						'limit' => 5,
					),
					
					'tab_content' => array(
						'type' => 'wp-editor',
						'size' => 'large',
						'editor_height' => 250,
						'editor_type' => 'tinymce',
						'shortcodes' => true,
						'value' => 'I am a tab. Praesent ut accumsan est. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras volutpat, ligula quis mollis elementum, ex nisi interdum ante, eu posuere sem sem et tortor.',
						'label' => __('Content', 'creatus'),
						'desc' => esc_html__('Set tab content.', 'creatus')
					)
				)
			),
			'cmx' => _thz_container_metrics_defaults()
		)
	),
	'layouttab' => array(
		'title' => __('Layout', 'creatus'),
		'type' => 'tab',
		'options' => array(
			'tabcm' => array(
				'type' => 'thz-box-style',
				'label' => __('Container box style', 'creatus'),
				'preview' => false,
				'popup' => true,
				'desc' => esc_html__('Adjust .thz-shortcode-tabs box style', 'creatus'),
				'button-text' => __('Customize container box style', 'creatus'),
				'disable' => array('layout','boxsize','video','transform'),
				'units' => array(
					'borderradius',
					'boxsize',
					'padding',
					'margin',
				),
				'value' => array()
			),
			'tabl' => array(
				'type' => 'thz-multi-options',
				'label' => __('Tab links setting', 'creatus'),
				'desc' => esc_html__('Choose tabs links layout, border radius or set the space between the tab links', 'creatus'),
				'value' => array(
					'lay' => 'top',
					'lsp' => 0,
					'lbr' => 0
				),
				'thz_options' => array(
					'lay' => array(
						'type' => 'short-select',
						'title' => esc_html__('Layout', 'creatus'),
						'attr' => array(
							'class' => 'thz-select-switch'
						),
						'choices' => array(
							'top' => array(
								'text' => esc_html__('Top left', 'creatus'),
								'attr' => array(
									'data-enable' => '.thz-mh-fw-edit-options-modal-tabl-lsp,.thz-mh-fw-edit-options-modal-tabl-lbr'
								)
							),
							'centered' => array(
								'text' => esc_html__('Top centered', 'creatus'),
								'attr' => array(
									'data-enable' => '.thz-mh-fw-edit-options-modal-tabl-lsp,.thz-mh-fw-edit-options-modal-tabl-lbr'
								)
							),
							'topright' => array(
								'text' => esc_html__('Top right', 'creatus'),
								'attr' => array(
									'data-enable' => '.thz-mh-fw-edit-options-modal-tabl-lsp,.thz-mh-fw-edit-options-modal-tabl-lbr'
								)
							),
							'left' => array(
								'text' => esc_html__('Left side', 'creatus'),
								'attr' => array(
									'data-disable' => '.thz-mh-fw-edit-options-modal-tabl-lsp,.thz-mh-fw-edit-options-modal-tabl-lbr'
								)
							),
							'right' => array(
								'text' => esc_html__('Right side', 'creatus'),
								'attr' => array(
									'data-disable' => '.thz-mh-fw-edit-options-modal-tabl-lsp,.thz-mh-fw-edit-options-modal-tabl-lbr'
								)
							),
							'full' => array(
								'text' => esc_html__('Full width', 'creatus'),
								'attr' => array(
									'data-disable' => '.thz-mh-fw-edit-options-modal-tabl-lsp',
									'data-enable' => '.thz-mh-fw-edit-options-modal-tabl-lbr'
								)
							)
						)
					),
					'lsp' => array(
						'type' => 'spinner',
						'addon' => 'px',
						'title' => esc_html__('Space', 'creatus')
					),
					'lbr' => array(
						'type' => 'spinner',
						'addon' => 'px',
						'title' => esc_html__('Border radius', 'creatus')
					)
				)
			),
			'tablp' => array(
				'type' => 'thz-box-style',
				'label' => __('Tab link padding', 'creatus'),
				'preview' => false,
				'popup' => false,
				'desc' => esc_html__('Set the padding of tabs menu link item.', 'creatus'),
				'disable' => array('layout','margin','borders','borderradius','boxsize','transform','boxshadow','background'),
				'value' => array(
					'padding' => array(
						'top' => '15',
						'right' => '20',
						'bottom' => '15',
						'left' => '20'
					)
				)
			),
			'tabcbs' => array(
				'type' => 'thz-box-style',
				'label' => __('Content box style', 'creatus'),
				'desc' => esc_html__('Adjust .thz-tab-content', 'creatus'),
				'preview' => true,
				'popup' => true,
				'button-text' => esc_html__('Customize content box style', 'creatus'),
				'disable' => array('layout','margin','borderradius','boxsize','transform','boxshadow','video'),
				'value' => array(
					'padding' => array(
						'top' => '30',
						'right' => '25',
						'bottom' => '30',
						'left' => '25'
					),
					'borders' => array(
						'all' => 'same',
						'top' => array(
							'w' => 1,
							's' => 'solid',
							'c' => '#eaeaea'
						),
					),
				)
			),
			'tabcibs' => array(
				'type' => 'thz-box-style',
				'label' => __('Content inner box style', 'creatus'),
				'desc' => esc_html__('Adjust .thz-tab-content-inner', 'creatus'),
				'preview' => true,
				'popup' => true,
				'button-text' => esc_html__('Customize content inner box style', 'creatus'),
				'disable' => array('layout','video'),
				'value' => array()
			)
		)
	),
	'stylingtab' => array(
		'title' => __('Styling', 'creatus'),
		'type' => 'tab',
		'options' => array(
			'tabf' => array(
				'type' => 'thz-typography',
				'label' => __('Title font', 'creatus'),
				'desc' => esc_html__('Tabs title font metrics', 'creatus'),
				'value' => array(),
				'disable' => array('color','hovered')
			),
			'tababs' => array(
				'type' => 'thz-box-style',
				'label' => __('Active link', 'creatus'),
				'desc' => esc_html__('Adjust .thz-active-tab .thz-tab-button', 'creatus'),
				'preview' => true,
				'popup' => true,
				'button-text' => esc_html__('Customize active tab', 'creatus'),
				'disable' => array('layout','padding','margin','borderradius','boxsize','transform','boxshadow','video'),
				'value' => array(
					'borders' => array(
						'all' => 'separate',
						'top' => array(
							'w' => 1,
							's' => 'solid',
							'c' => '#eaeaea'
						),
						'right' => array(
							'w' => 1,
							's' => 'solid',
							'c' => '#eaeaea'
						),
						'bottom' => array(
							'w' => 1,
							's' => 'solid',
							'c' => '#ffffff'
						),
						'left' => array(
							'w' => 1,
							's' => 'solid',
							'c' => '#eaeaea'
						)
					),
					'background' => array(
						'type' => 'color',
						'color' => '#ffffff',
					)
				)
			),
			'tabibs' => array(
				'type' => 'thz-box-style',
				'label' => __('Inactive link', 'creatus'),
				'desc' => esc_html__('Adjust .thz-inactive-tab .thz-tab-button', 'creatus'),
				'preview' => true,
				'popup' => true,
				'button-text' => esc_html__('Customize inactive tab', 'creatus'),
				'disable' => array('layout','padding','margin','borderradius','boxsize','transform','boxshadow','video'),
				'value' => array(
					'borders' => array(
						'all' => 'same',
						'top' => array(
							'w' => 1,
							's' => 'solid',
							'c' => '#eaeaea'
						),
					),
					'background' => array(
						'type' => 'color',
						'color' => '#fafafa',
					)
				)
			),
			'tablc' => array(
				'type' => 'thz-multi-options',
				'label' => __('Tab links colors', 'creatus'),
				'desc' => esc_html__('Adjust tab links colors', 'creatus'),
				'value' => array(
					'al' => '#444444',
					'alh' => '#121212',
					'il' => '#444444',
					'ilh' => '#121212'
				),
				'thz_options' => array(
					'al' => array(
						'type' => 'color',
						'title' => esc_html__('Active', 'creatus'),
						'box' => true
					),
					'alh' => array(
						'type' => 'color',
						'title' => esc_html__('Active hovered', 'creatus'),
						'box' => true
					),
					'il' => array(
						'type' => 'color',
						'title' => esc_html__('Inactive', 'creatus'),
						'box' => true
					),
					'ilh' => array(
						'type' => 'color',
						'title' => esc_html__('Inactive hovered', 'creatus'),
						'box' => true
					)
				)
			),
			'tabcc' => array(
				'type' => 'thz-multi-options',
				'label' => __('Tab content colors', 'creatus'),
				'desc' => esc_html__('Adjust tab content colors', 'creatus'),
				'value' => array(
					'ctc' => '',
					'clc' => '',
					'clh' => '',
					'chc' => ''
				),
				'thz_options' => array(
					'ctc' => array(
						'type' => 'color',
						'title' => esc_html__('Text', 'creatus'),
						'box' => true
					),
					'clc' => array(
						'type' => 'color',
						'title' => esc_html__('Link', 'creatus'),
						'box' => true
					),
					'clh' => array(
						'type' => 'color',
						'title' => esc_html__('Link hovered', 'creatus'),
						'box' => true
					),
					'chc' => array(
						'type' => 'color',
						'title' => esc_html__('Headings', 'creatus'),
						'box' => true
					)
				)
			)
		)
	),
	
	'tabseffects' => array(
		'title' => __('Effects', 'creatus'),
		'type' => 'tab',
		'lazy_tabs'=> false,
		'options' => array(
			'animate' => array(
				'type' => 'thz-animation',
				'label' => false,
				'value' => array(
					'animate' => 'inactive',
					'effect' => 'thz-anim-fadeIn',
					'duration' => 400,
					'delay' => 0
				)
			),
			'cpx' => _thz_container_parallax_default()
		)
	)
);