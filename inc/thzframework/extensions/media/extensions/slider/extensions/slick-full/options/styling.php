<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}
$options = array(
	'generaltab' => array(
		'title'   => __( 'General', 'creatus' ),
		'type'    => 'tab',
		'options' => array(
		
			'bs' => array(
				'type' => 'thz-box-style',
				'label' => __('Container box style', 'creatus'),
				'preview' => false,
				'popup' => true,
				'desc' => esc_html__('Adjust .thz-slick-holder box style', 'creatus'),
				'button-text' => __('Customize container box style', 'creatus'),
				'disable' => array('layout','boxsize','video','transform'),
				'value' => array(
					'background' => array(
						'type' => 'color',
						'color' => '#222222'
					)
				)
			),

			'cmx' => _thz_container_metrics_defaults(),	
		),
	),
	
	'navigationstab' => array(
		'title' => __('Navigations', 'creatus') ,
		'type' => 'tab',
		'options' => array(	
			fw()->theme->get_options('sliders_ext_navigations'),
		) // end options
	 ),
	
	'typotab' => array(
		'title'   => __( 'Typography', 'creatus' ),
		'type'    => 'tab',
		'options' => array(

			't' => array(
				'label' => __('Title font', 'creatus'),
				'type' => 'thz-typography',
				'value' => array(
					'family' => fw_get_db_settings_option('headings_font/family','Arial, Helvetica, sans-serif'),
					'weight'  => fw_get_db_settings_option('headings_font/weight',400),
					'subset' => fw_get_db_settings_option('headings_font/subset',false),
					'size' => 48,
					'line-height' => 1.1,
				),
				'disable' => array('color','hovered'),
				'desc' => esc_html__('Adjust title font', 'creatus')
			),
			
			
			's' => array(
				'label' => __('Sub title font', 'creatus'),
				'type' => 'thz-typography',
				'value' => array(
					'size' => 18,
				),
				'disable' => array('color','hovered'),
				'desc' => esc_html__('Adjust sub title font', 'creatus')
			),
			
			'd' => array(
				'label' => __('Description font', 'creatus'),
				'type' => 'thz-typography',
				'value' => array(
					'size' => 16,
				),
				'disable' => array('color','hovered'),
				'desc' => esc_html__('Adjust intro text font', 'creatus')
			),
		),
	),	

	
	'animationstab' => array(
		'title'   => __( 'Animations', 'creatus' ),
		'type'    => 'tab',
		'options' => array(
	'at' => array(
		'type' => 'thz-animation',
		'label' => false,
		'value' => array(
			'animate' => 'inactive',
			'effect' => 'thz-anim-slideIn-up',
			'duration' => 400,
			'delay' => 400
		),
		'addlabel' => esc_html__('Animate title', 'creatus'),
		'adddesc' => esc_html__('Add animation to slide title', 'creatus')
	),
	
	'as' => array(
		'type' => 'thz-animation',
		'label' => false,
		'value' => array(
			'animate' => 'inactive',
			'effect' => 'thz-anim-slideIn-up',
			'duration' => 400,
			'delay' => 400
		),
		'addlabel' => esc_html__('Animate sub title', 'creatus'),
		'adddesc' => esc_html__('Add animation to slide sub title', 'creatus')
	),
	'ad' => array(
		'type' => 'thz-animation',
		'label' => false,
		'value' => array(
			'animate' => 'inactive',
			'effect' => 'thz-anim-slideIn-up',
			'duration' => 400,
			'delay' => 400
		),
		'addlabel' => esc_html__('Animate description', 'creatus'),
		'adddesc' => esc_html__('Add animation to slide description', 'creatus')
	),
	
	'ab' => array(
		'type' => 'thz-animation',
		'label' => false,
		'value' => array(
			'animate' => 'inactive',
			'effect' => 'thz-anim-slideIn-up',
			'duration' => 400,
			'delay' => 400
		),
		'addlabel' => esc_html__('Animate buttons', 'creatus'),
		'adddesc' => esc_html__('Add animation to slide buttons container.', 'creatus'),
		'addhelp' => esc_html__('Note that this animation is for the buttons container and if activated it animates both buttons at once. You can also set this option to No and activate animation on per button basis.', 'creatus'),
	),
		),
	),
	
	'customtab' => array(
		'title'   => __( 'Custom css', 'creatus' ),
		'type'    => 'tab',
		'options' => array(
			'css' => array(
				'type' => 'thz-ace',
				'label' => __('Custom CSS', 'creatus'),
				'desc' => esc_html__('Insert your CSS code in the field below. Do not use any HTML tags.', 'creatus'),
				'value'=>'',
				'mode'=>'css',
				'theme'=>'chrome',
				'height'=>450
				
			),	
		),
	),	
);