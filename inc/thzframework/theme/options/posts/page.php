<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$page_css = thz_theme()->get_options( 'posts/page_css_box');

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

	'page_options_box' => array(
		'title'   => __( 'Creatus options', 'creatus' ),
		'type' => 'box',
		'options' => array(
		
			'page_options_tab1' => array(
				'title'   => __( 'Page options', 'creatus' ),
				'type'    => 'tab',
				'attr'	  => array(
					'class' => 'thz-page-options-container'
				),
				'options' => array(
					fw()->theme->get_options( 'posts/page_options',array('usefeatured' => true,'ispage' => true))
				),
			),

		)
	),

);

$options = array_merge($options,$page_css);