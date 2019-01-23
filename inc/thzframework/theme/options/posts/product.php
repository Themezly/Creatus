<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
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
	'product_options_box' => array(
		'title'   => __( 'Creatus options', 'creatus' ),
		'type' => 'box',
		'options' => array(
	
			'product_options_tab1' => array(
				'title'   => __( 'Product options', 'creatus' ),
				'type'    => 'tab',
				'attr'	  => array(
					'class' => 'thz-product-options-container'
				),
				'options' => array(
		
					'custom_post_options' => array(
						'type' => 'addable-popup',
						'value' => array(),
						'label' => __('Custom product options', 'creatus'),
						'desc'  => esc_html__('Add custom  product options for this page or leave as is for theme defaults.', 'creatus'),
						'template' => esc_html__('Custom product options for this page','creatus'),
						'popup-title' => null,
						'size' => 'large', 
						'limit' => 1,
						'attr' => array(
							'class' => 'custom_options_popup'
						),
						'add-button-text' => esc_html__('Add custom product options', 'creatus'),
						'sortable' => false,
						'popup-options' => array(
							fw()->theme->get_options('posts/product_options')
						),
					),
		
				),
			),
				
			'product_options_tab2' => array(
				'title'   => __( 'Page options', 'creatus' ),
				'type'    => 'tab',
				'attr'	  => array(
					'class' => 'thz-page-options-container'
				),
				'options' => array(
		
					fw()->theme->get_options( 'posts/page_options')
		
				),
			),
			
			


		)
	),

);