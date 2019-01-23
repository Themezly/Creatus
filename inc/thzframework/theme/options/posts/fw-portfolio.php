<?php
if (!defined('FW')) {
	die('Forbidden');
}
$options = array(
	'featuredimage_group' => array(
		'type' => 'group',
		'options' => array(
			'featured_size' => array(
				'label' => __('Featured image size', 'creatus'),
				'desc' => esc_html__('Select the featured image size to be used.', 'creatus'),
				'value' => 'original',
				'type' => 'short-select',
				'choices' => thz_get_image_sizes_list()
			),
		),
	),
	'postcssbox' => array(
		'type' => 'box',
		'options' => array(
			'pcss' => array(
				'type' => 'addable-popup',
				'value' => array(),
				'label' => false,
				'desc'  => esc_html__('Add CSS for this post', 'creatus'),
				'template' => esc_html__('Post CSS is active','creatus'),
				'popup-title' => esc_html__('Post CSS', 'creatus'),
				'size' => 'large', 
				'limit' => 1,
				'attr' => array(
					'class' => 'custom_options_popup'
				),
				'add-button-text' => esc_html__('Click to add post CSS', 'creatus'),
				'sortable' => false,
				'popup-options' => array(
					'css' => array(
						'type' => 'thz-ace',
						'label' => __('Post CSS', 'creatus'),
						'desc' => esc_html__('Insert your CSS code in the field below. Do not use any HTML tags. This CSS is loaded last after all CSS files and gives you the option to override every theme CSS property. If you need to override certain CSS selector add #thz-wrapper before selector to avoid the use of !important rule.', 'creatus'),
						'value'=>'',
						'mode'=>'css',
						'theme'=>'chrome',
						'height'=>450
					),
				),
			),
		

		),
		'title' => esc_html__('Post CSS', 'creatus'),
		'context' => 'side',
		'priority' => 'low',
	),
	'project_options_box' => array(
		'type' => 'box',
		'title'   => __( 'Creatus options', 'creatus' ),
		'options' => array(
			
			// tab general
			
			'project_options_tab1' => array(
				'title' => __('Project options', 'creatus'),
				'type' => 'tab',
				'options' => array(
					fw()->theme->get_options('posts/project_options')
				)
			), // end tab general
			
			 'project_options_tab2' => array(
				'title'   => __( 'Project media', 'creatus' ),
				'type'    => 'tab',
				'options' => array(
					fw()->theme->get_options('posts/post_media')
				)
			),// end tab media


			// tab page options
			'project_options_tab3' => array(
				'title'   => __( 'Page options', 'creatus' ),
				'type'    => 'tab',
				'attr'	  => array(
					'class' => 'thz-page-options-container'
				),
				'options' => array(
		
					fw()->theme->get_options( 'posts/page_options',array('usefeatured' => true))
		
				),
			),

			
			
		)
	),

);