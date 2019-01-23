<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

//
$curf = get_post_format();

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
	'post_options_box' => array(
		'title'   => __( 'Creatus options', 'creatus' ),
		'type' => 'box',
		'options' => array(

			'box_options_tab0' => array(
				'title'   => __( 'Post format options', 'creatus' ),
				'type'    => 'tab',
				'li-attr' => array(
					'class' => 'thz-formats-li'.($curf ? ' ui-tabs-active ui-state-active' : ' thz-hide-li-tab')
				),
				'options' => array(
					fw()->theme->get_options('posts/post_formats')
				)
			),

			'box_options_tab1' => array(
				'title'   => __( 'Post options', 'creatus' ),
				'type'    => 'tab',
				'li-attr' => array(
					'class' => 'thz-post-li'.(!$curf ? ' ui-tabs-active ui-state-active' : '')
				),
				'options' => array(

					'custom_post_options' => array(
						'type' => 'addable-popup',
						'value' => array(),
						'label' => __('Custom post options', 'creatus'),
						'desc'  => esc_html__('Add custom  options for this page or leave as is for theme defaults.', 'creatus'),
						'template' => esc_html__('Custom post options for this page','creatus'),
						'popup-title' => null,
						'size' => 'large', 
						'limit' => 1,
						'attr' => array(
							'class' => 'custom_options_popup'
						),
						'add-button-text' => esc_html__('Add custom post options', 'creatus'),
						'sortable' => false,
						'popup-options' => array(
							fw()->theme->get_options( 'posts/post_options')
						),
					),

				)
			),// end tab media

			'box_options_tab2' => array(
				'title'   => __( 'Post media', 'creatus' ),
				'type'    => 'tab',
				'li-attr' => array(
					'class' => 'thz-media-li'.($curf ? ' thz-hide-li-tab' : '')
				),
				'options' => array(
					fw()->theme->get_options('posts/post_media')
				)
			),// end tab media
			
					
			'box_options_tab3' => array(
				'title'   => __( 'Page options', 'creatus' ),
				'li-attr' => array(
					'class' => 'thz-page-li'
				),
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