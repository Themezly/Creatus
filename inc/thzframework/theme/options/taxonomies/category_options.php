<?php
if (!defined('FW')) {
	die('Forbidden');
}
$options = array(

	// tab page options
	'category_options_tab1' => array(
		'title'   => __( 'Page options', 'creatus' ),
		'type'    => 'tab',
		'lazy_tabs' => false,
		'attr'	  => array(
			'class' => 'thz-page-options-container'
		),
		'options' => array(
			fw()->theme->get_options( 'posts/page_options')
		),
	),
	
	// tab category options
	'category_options_tab2' => array(
		'title'   => __( 'Category options', 'creatus' ),
		'type'    => 'tab',
		'lazy_tabs' => false,
		'attr'	  => array(
			'class' => 'thz-category-options-container'
		),
		'options' => array(
			'cat_image' => array(
				'type' => 'upload',
				'label' => __('Category Image', 'creatus'),
				'desc' => esc_html__('Select or upload category image', 'creatus')
			),
			
			'pcss' => array(
				'type' => 'addable-popup',
				'value' => array(),
				'label' => __( 'Category CSS', 'creatus' ),
				'desc'  => esc_html__('Add CSS for this category', 'creatus'),
				'template' => esc_html__('Category CSS is active','creatus'),
				'popup-title' => esc_html__('Category CSS', 'creatus'),
				'size' => 'large', 
				'limit' => 1,
				'attr' => array(
					'class' => 'custom_options_popup'
				),
				'add-button-text' => esc_html__('Click to add category CSS', 'creatus'),
				'sortable' => false,
				'popup-options' => array(
					'css' => array(
						'type' => 'thz-ace',
						'label' => __('Category CSS', 'creatus'),
						'desc' => esc_html__('Insert your CSS code in the field below. Do not use any HTML tags. This CSS is loaded last after all CSS files and gives you the option to override every theme CSS property. If you need to override certain CSS selector add #thz-wrapper before selector to avoid the use of !important rule.', 'creatus'),
						'value'=>'',
						'mode'=>'css',
						'theme'=>'chrome',
						'height'=>450
					),
				),
			),
		),
	),
);

