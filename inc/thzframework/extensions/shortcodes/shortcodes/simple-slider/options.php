<?php
if (!defined('FW')) {
	die('Forbidden');
}

$title_template = '<b>{{-slide_name}}</b>';
$title_template .= '{{  if( ctype ==\'page_blocks\'){ }}';
$title_template .= '<span class="thz-bsp"></span>Page blocks: {{= page_blocks }}';
$title_template .= '{{ } }}';
$title_template .= '{{  if( ctype ==\'editor\' && content.length > 0){ }}';
$title_template .= '{{  var slide_text = thz.thz_strip_tags_to_space(content); }}';
$title_template .= '{{  if(slide_text.length > 60){ slide_text = slide_text.substring(0, 60) + \'...\'; } }}';
$title_template .= '<span class="thz-bsp"></span>{{= slide_text }}';
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
			'slides' => array(
				'label' => __('Slides', 'creatus'),
				'popup-title' => esc_html__('Add/Edit Slide', 'creatus'),
				'desc' => esc_html__('Here you can add, remove and edit your slides.', 'creatus'),
				'type' => 'addable-popup',
				'template' => $title_template,
				'size' => 'large',
				'add-button-text' => esc_html__('Add/edit slide', 'creatus'),
				'popup-options' => array(
					'slide_name' => array(
						'label' => __('Slide name', 'creatus'),
						'desc' => esc_html__('Used only for sorting', 'creatus'),
						'type' => 'text'
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
									'data-enable' => 'content',
									'data-disable' => 'page_blocks',
									
								)
							),
							'page_blocks' =>array(
								'text' =>  esc_html__('Page Blocks', 'creatus'),
								'attr' => array(
									'data-enable' => 'page_blocks',
									'data-disable' => 'content',
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
					
					'content' => array(
						'label' => __('Content', 'creatus'),
						'desc' => esc_html__('Enter slide content', 'creatus'),
						'type' => 'wp-editor',
						'size' => 'large',
						'editor_height' => 100,
						'editor_type' => 'tinymce',
						'wpautop' => true,
						'shortcodes' => true,
						'label' => __('Content', 'creatus'),
						'value' => 'I am a simple slide. Praesent ut accumsan est. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras volutpat, ligula quis mollis elementum, ex nisi interdum ante, eu posuere sem sem et tortor.',
						'desc' => esc_html__('Enter some content for this slide', 'creatus')
					)
				)
			),
			
			'bs' => array(
				'type' => 'thz-box-style',
				'label' => __('Container box style', 'creatus'),
				'preview' => false,
				'popup' => true,
				'button-text' => esc_html__('Customize container box style', 'creatus'),
				'desc' => esc_html__('Adjust .thz-slick-holder container box style', 'creatus'),
				'disable' => array('layout','boxsize','video','transform'),
				'units' => array(
					'borderradius',
					'boxsize',
					'padding',
					'margin',
				),
				'value' => array()
			),
			
			'cmx' => _thz_container_metrics_defaults()
		)
	),
	'layouttab' => array(
		'title' => __('Layout', 'creatus'),
		'type' => 'tab',
		'options' => array(
			fw()->theme->get_options('slider_settings')
		)
	),
	
	
	'simpleslidereffects' => array(
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