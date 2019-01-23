<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}
$options = array(
	'pagecssbox' => array(
		'type' => 'box',
		'options' => array(
			'pcss' => array(
				'type' => 'addable-popup',
				'value' => array(),
				'label' => false,
				'desc'  => esc_html__('Add CSS for this page', 'creatus'),
				'template' => esc_html__('Page CSS is active','creatus'),
				'popup-title' => esc_html__('Page CSS', 'creatus'),
				'size' => 'large', 
				'limit' => 1,
				'attr' => array(
					'class' => 'custom_options_popup'
				),
				'add-button-text' => esc_html__('Click to add page CSS', 'creatus'),
				'sortable' => false,
				'popup-options' => array(
					'css' => array(
						'type' => 'thz-ace',
						'label' => __('Page CSS', 'creatus'),
						'desc' => esc_html__('Insert your CSS code in the field below. Do not use any HTML tags. This CSS is loaded last after all CSS files and gives you the option to override every theme CSS property. If you need to override certain CSS selector add #thz-wrapper before selector to avoid the use of !important rule.', 'creatus'),
						'value'=>'',
						'mode'=>'css',
						'theme'=>'chrome',
						'height'=>450
					),
				),
			),
		),
		'title' => esc_html__('Page CSS', 'creatus'),
		'context' => 'side',
		'priority' => 'core',
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
					fw()->theme->get_options( 'posts/page_options' )
				),
			),

		)
	),

);