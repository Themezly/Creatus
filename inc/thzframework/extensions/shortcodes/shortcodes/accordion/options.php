<?php
if (!defined('FW')) {
	die('Forbidden');
}
$title_template = '<b>{{-accordion_title}}</b>';
$title_template .= '{{  if( ctype ==\'page_blocks\'){ }}';
$title_template .= '<span class="thz-bsp"></span>Page blocks: {{= page_blocks }}';
$title_template .= '{{ } }}';
$title_template .= '{{  if( ctype ==\'editor\' && accordion_content.length > 0){ }}';
$title_template .= '{{  var acc_text = thz.thz_strip_tags_to_space(accordion_content); }}';
$title_template .= '{{  if(acc_text.length > 60){ acc_text = acc_text.substring(0, 60) + \'...\'; } }}';
$title_template .= '<span class="thz-bsp"></span>{{= acc_text }}';
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
			'accordions' => array(
				'type' => 'addable-popup',
				'label' => __('Accordions', 'creatus'),
				'popup-title' => esc_html__('Add/Edit Accordions', 'creatus'),
				'desc' => esc_html__('Create your accordions', 'creatus'),
				'template' => $title_template,
				'size' => 'large',
				'popup-options' => array(
					'accordion_title' => array(
						'type' => 'text',
						'label' => __('Title', 'creatus'),
						'value' => 'Accordion title'
					),
					'accordion_icon' => array(
						'type' => 'thz-icon',
						'value' => '',
						'label' => __('Accordion title Icon', 'creatus')
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
									'data-enable' => 'accordion_content',
									'data-disable' => 'page_blocks',
									
								)
							),
							'page_blocks' =>array(
								'text' =>  esc_html__('Page Blocks', 'creatus'),
								'attr' => array(
									'data-enable' => 'page_blocks',
									'data-disable' => 'accordion_content',
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
					
					'accordion_content' => array(
						'type' => 'wp-editor',
						'size' => 'large',
						'editor_height' => 250,
						'editor_type' => 'tinymce',
						'shortcodes' => true,
						'value' => 'I am an accordion. Praesent ut accumsan est. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras volutpat, ligula quis mollis elementum, ex nisi interdum ante, eu posuere sem sem et tortor.',
						'label' => __('Content', 'creatus')
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
			'bs' => array(
				'type' => 'thz-box-style',
				'label' => __('Container box style', 'creatus'),
				'preview' => false,
				'popup' => true,
				'desc' => esc_html__('Adjust .thz-shortcode-accordion box style', 'creatus'),
				'button-text' => __('Container box style', 'creatus'),
				'disable' => array('layout','boxsize','transform','video'),
				'units' => array(
					'borderradius',
					'boxsize',
					'padding',
					'margin',
				),
				'value' => array()
			),
			'gm' => array(
				'type' => 'thz-multi-options',
				'label' => __('Global metrics', 'creatus'),
				'desc' => esc_html__('Adjust borders, borders width, space between accordions, toggle arrow, and first accordion open/closed on page load.', 'creatus'),
				'value' => array(
					'tb' => 'hideside',
					'cb' => 'hide',
					'bw' => 1,
					'space' => 0,
					'togglearrow' => 'show',
					'openonload' => 'loadopened',
				),
				'thz_options' => array(
					'tb' => array(
						'type' => 'short-select',
						'title' => esc_html__('Title border', 'creatus'),
						'choices' => array(
							'hide' => esc_html__('Hide', 'creatus'),
							'show' => esc_html__('Show', 'creatus'),
							'hideside' => esc_html__('Hide side borders', 'creatus')
						)
					),
					'cb' => array(
						'type' => 'short-select',
						'title' => esc_html__('Content border', 'creatus'),
						'choices' => array(
							'hide' => esc_html__('Hide', 'creatus'),
							'show' => esc_html__('Show', 'creatus'),
							'hideside' => esc_html__('Hide side borders', 'creatus')
						)
					),
					'bw' => array(
						'type' => 'spinner',
						'title' => esc_html__('Borders width', 'creatus'),
						'addon' => 'px'
					),
					'space' => array(
						'type' => 'spinner',
						'title' => esc_html__('Space', 'creatus'),
						'addon' => 'px'
					),
					'togglearrow' => array(
						'type' => 'short-select',
						'title' => esc_html__('Toggle arrow', 'creatus'),
						'choices' => array(
							'hide' => esc_html__('Hide', 'creatus'),
							'show' => esc_html__('Show', 'creatus')
						)
					),
					'openonload' => array(
						'type' => 'short-select',
						'title' => esc_html__('First on load', 'creatus'),
						'choices' => array(
							'loadopened' => esc_html__('Opened', 'creatus'),
							'loadclosed' => esc_html__('Closed', 'creatus')
						)
					),
				)
			),
			'title_padding' => array(
				'type' => 'thz-box-style',
				'label' => __('Title padding', 'creatus'),
				'preview' => false,
				'popup' => false,
				'desc' => esc_html__('Adjust .thz-accordion-title padding', 'creatus'),
				'disable' => array('layout','margin','borders','borderradius','boxsize','transform','boxshadow','background'),
				'value' => array(
					'padding' => array(
						'top' => '15',
						'right' => '0',
						'bottom' => '15',
						'left' => '0'
					)
				)
			),
			'content_padding' => array(
				'type' => 'thz-box-style',
				'label' => __('Content padding', 'creatus'),
				'preview' => false,
				'popup' => false,
				'desc' => esc_html__('Adjust .thz-accordion-content padding', 'creatus'),
				'disable' => array('layout','margin','borders','borderradius','transform','boxsize','boxshadow','background'),
				'value' => array(
					'padding' => array(
						'top' => '30',
						'right' => '0',
						'bottom' => '30',
						'left' => '0'
					)
				)
			)
		)
	),
	'stylingtab' => array(
		'title' => __('Styling', 'creatus'),
		'type' => 'tab',
		'options' => array(
			'af' => array(
				'type' => 'thz-typography',
				'label' => __('Title font', 'creatus'),
				'desc' => esc_html__('Accordion title font metrics', 'creatus'),
				'value' => array(),
				'disable' => array('color','hovered'),
			),
			'ac' => array(
				'type' => 'thz-multi-options',
				'label' => __('Active title colors', 'creatus'),
				'desc' => esc_html__('Set active accordion title colors', 'creatus'),
				'value' => array(
					'bg' => '',
					'co' => ''
				),
				'thz_options' => array(
					'bg' => array(
						'type' => 'color',
						'title' => esc_html__('Background', 'creatus'),
						'box' => true
					),
					'co' => array(
						'type' => 'color',
						'title' => esc_html__('Color', 'creatus'),
						'box' => true
					)
				)
			),
			'ic' => array(
				'type' => 'thz-multi-options',
				'label' => __('Inactive title colors', 'creatus'),
				'desc' => esc_html__('Set inactive accordion title colors', 'creatus'),
				'value' => array(
					'bg' => '',
					'co' => ''
				),
				'thz_options' => array(
					'bg' => array(
						'type' => 'color',
						'title' => esc_html__('Background', 'creatus'),
						'box' => true
					),
					'co' => array(
						'type' => 'color',
						'title' => esc_html__('Color', 'creatus'),
						'box' => true
					)
				)
			),
			'gc' => array(
				'type' => 'thz-multi-options',
				'label' => __('Global colors', 'creatus'),
				'desc' => esc_html__('Set borders colors, content background, link, links hovered and headings colors. Theme defaults are used if empty.', 'creatus'),
				'value' => array(
					'borders' => 'color_4',
					'content' => '',
					'text' => '',
					'link' => '',
					'linkh' => '',
					'headings' => ''
				),
				'thz_options' => array(
					'borders' => array(
						'type' => 'color',
						'title' => esc_html__('Borders', 'creatus'),
						'box' => true
					),
					'content' => array(
						'type' => 'color',
						'title' => esc_html__('Content bg', 'creatus'),
						'box' => true
					),
					'text' => array(
						'type' => 'color',
						'title' => esc_html__('Text', 'creatus'),
						'box' => true
					),
					'link' => array(
						'type' => 'color',
						'title' => esc_html__('Link', 'creatus'),
						'box' => true
					),
					'linkh' => array(
						'type' => 'color',
						'title' => esc_html__('Link hovered', 'creatus'),
						'box' => true
					),
					'headings' => array(
						'type' => 'color',
						'title' => esc_html__('Headings', 'creatus'),
						'box' => true
					)
				)
			)
		)
	),
	
	'acceffects' => array(
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
					'delay' => 0
				)
			),
			'cpx' => _thz_container_parallax_default()
		)
	)
);