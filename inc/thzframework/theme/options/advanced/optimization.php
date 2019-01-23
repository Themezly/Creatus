<?php if ( ! defined( 'FW' ) ) die( 'Forbidden' );


$options = array(

	'thzopt' => array(
		'type'  => 'multi',
		'attr'  => array(
			'class' => 'fw-option-type-multi-show-borders',
		),
		'inner-options' => array(
		
			'compileinline' => array(
				'label' => __('Compile inline CSS', 'creatus'),
				'desc' => esc_html__('Compile dynamic inline CSS to a file.', 'creatus'),
				'type' => 'switch',
				'right-choice' => array(
					'value' => 'donotcompile',
					'label' => __('Do not compile', 'creatus')
				),
				'left-choice' => array(
					'value' => 'compile',
					'label' => __('compile', 'creatus')
				),
				'value' => 'donotcompile'
			),
			
			'compilecss' => array(
				'label' => __('Compile theme CSS files', 'creatus'),
				'desc' => esc_html__('Compile theme CSS files to a single file.', 'creatus'),
				'type' => 'switch',
				'right-choice' => array(
					'value' => 'donotcompile',
					'label' => __('Do not compile', 'creatus')
				),
				'left-choice' => array(
					'value' => 'compile',
					'label' => __('compile', 'creatus')
				),
				'value' => 'donotcompile'
			),
			
			'minjs' => array(
				'label' => __('Minify theme JS files', 'creatus'),
				'desc' => esc_html__('Minify theme JS files to a single file.', 'creatus'),
				'type' => 'switch',
				'right-choice' => array(
					'value' => 'donotminify',
					'label' => __('Do not minify', 'creatus')
				),
				'left-choice' => array(
					'value' => 'minify',
					'label' => __('Minify', 'creatus')
				),
				'value' => 'donotminify'
			),
			
			'remqs' => array(
				'label' => __('Remove ver query strings', 'creatus'),
				'desc' => esc_html__('Remove ver query string from CSS/JS files', 'creatus'),
				'help' => esc_html__('This option will remove version query strings ( ?ver=1.0.0 ), from JS and CSS files. Please note that this option should be used when you are completely done modifying your CSS and JS files. If you set it to Remove and update your files in meantime, switch to Do not remove for few days untill your visitors get the fresh browser copy of modified files. Othervise they will have to do "hard" browser refresh in order to see the modifications.', 'creatus'),
				'type' => 'switch',
				'right-choice' => array(
					'value' => 'donotremove',
					'label' => __('Do not remove', 'creatus')
				),
				'left-choice' => array(
					'value' => 'remove',
					'label' => __('Remove', 'creatus')
				),
				'value' => 'donotremove'
			),
			
			'remch' => array(
				'label' => __('Remove child style', 'creatus'),
				'desc' => esc_html__('Disable child stylesheet. See help for more info.', 'creatus'),
				'help' => esc_html__('Some users prefer to use preset assigned stylesheet ( assets/preset_name.css ) over creatus-child/style.css. In this case there is no need to load the child style and you can disable it here.', 'creatus'),
				'type' => 'switch',
				'right-choice' => array(
					'value' => 'donotremove',
					'label' => __('Do not remove', 'creatus')
				),
				'left-choice' => array(
					'value' => 'remove',
					'label' => __('Remove', 'creatus')
				),
				'value' => 'donotremove'
			),
			
		)
	),

);