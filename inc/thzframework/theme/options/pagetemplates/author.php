<?php
if (!defined('FW')) {
	die('Forbidden');
}
$options = array(
	'author_imx' => array(
		'type' => 'thz-multi-options',
		'label' => __('Author info box settings', 'creatus'),
		'desc' => esc_html__('Adjust author info box mode and elements spacings.', 'creatus'),
		'value' => array(
			'mode' => 'left',
			'heading' => 15,
			'text' => 15,
			'contact' => 0
		),
		'thz_options' => array(
			'mode' => array(
				'type' => 'short-select',
				'title' => esc_html__('Mode', 'creatus'),
				'attr' => array(
					'class' => 'thz-select-switch'
				),
				'choices' => array(
					'left' => array(
						'text' => esc_html__('Left aligned', 'creatus'),
						'attr' => array(
							'data-enable' => '.aopt-parent,author_box_style,show_author_avatar,author_heading,author_text,author_contact'
						)
					),
					'centered' => array(
						'text' => esc_html__('Centered', 'creatus'),
						'attr' => array(
							'data-enable' => '.aopt-parent,author_box_style,show_author_avatar,author_heading,author_text,author_contact'
						)
					),
					'hide' => array(
						'text' => esc_html__('Hide info box', 'creatus'),
						'attr' => array(
							'data-disable' => '.aopt-parent,author_box_style,show_author_avatar,author_heading,author_text,author_contact'
						)
					),
				),
			),
			'heading' => array(
				'type' => 'spinner',
				'title' => esc_html__('Heading', 'creatus'),
				'addon' => 'px',
				'min' => -100,
				'max' => 100,
				'attr' => array(
					'class' => 'aopt'
				),
			),
			'text' => array(
				'type' => 'spinner',
				'title' => esc_html__('Text', 'creatus'),
				'addon' => 'px',
				'min' => 0,
				'max' => 100,
				'attr' => array(
					'class' => 'aopt'
				),
			),
			'contact' => array(
				'type' => 'spinner',
				'title' => esc_html__('Contact', 'creatus'),
				'addon' => 'px',
				'min' => -100,
				'max' => 100,
				'attr' => array(
					'class' => 'aopt'
				),
			)
		)
	),
	'author_box_style' => array(
		'type' => 'thz-box-style',
		'label' => __('Author info box style', 'creatus'),
		'preview' => true,
		'button-text' => esc_html__('Customize author info box style', 'creatus'),
		'desc' => esc_html__('Adjust .thz-author-info box style','creatus'),
		'popup' => true,
		'disable' => array('video'),
		'value' => array(
			'background' => array(
				'type' => 'color',
				'color' => 'color_5',
			)
		)
	),
	'show_author_avatar' => array(
		'type' => 'multi-picker',
		'label' => false,
		'desc' => false,
		'show_borders' => true,
		'picker' => array(
			'picked' => array(
				'label' => __('Show author avatar', 'creatus'),
				'desc' => esc_html__('Show/hide author avatar', 'creatus'),
				'type' => 'switch',
				'right-choice' => array(
					'value' => 'hide',
					'label' => __('Hide', 'creatus')
				),
				'left-choice' => array(
					'value' => 'show',
					'label' => __('Show', 'creatus')
				),
				'value' => 'show'
			)
		),
		'choices' => array(
			'show' => array(
				'size' => array(
					'type' => 'thz-spinner',
					'label' => __('Author avatar size', 'creatus'),
					'desc' => esc_html__('Set author avatar image size', 'creatus'),
					'addon' => 'px',
					'min' => 0,
					'value' => 75
				),
				'avatar_boxstyle' => array(
					'type' => 'thz-box-style',
					'label' => __('Avatar box style', 'creatus'),
					'desc' => esc_html__('Adjust .thz-author-avatar box style','creatus'),
					'preview' => true,
					'button-text' => esc_html__('Customize avatar box style', 'creatus'),
					'popup' => true,
					'disable' => array('video'),
					'value' => array(
						'padding' => array(
							'top' => '5',
							'right' => '5',
							'bottom' => '5',
							'left' => '5'
						),
						'margin' => array(
							'top' => '0',
							'right' => '30',
							'bottom' => '0',
							'left' => '0'
						),
						'borderradius' => array(
							'top-left' => 75,
							'top-right' => 75,
							'bottom-right' => 75,
							'bottom-left' => 75,
						),	
						'background' => array(
							'type' => 'color',
							'color' => '#ffffff'
						)
					)
				)
			)
		)
	),
	'author_heading' => array(
		'type' => 'thz-typography',
		'label' => __('Author heading metrics', 'creatus'),
		'desc' => esc_html__('Adjust author heading font metrics.', 'creatus'),
		'value' => array(
			'size' => 24,
		),
		'disable' => array('hovered','align'),
	),
	'author_text' => array(
		'type' => 'thz-typography',
		'label' => __('Author text metrics', 'creatus'),
		'desc' => esc_html__('Adjust author text font metrics.', 'creatus'),
		'value' => array(),
		'disable' => array('hovered','align','text-shadow'),
	),

	'author_contact' => array(
		'type' => 'multi-picker',
		'label' => false,
		'desc' => false,
		'show_borders' => true,
		'picker' => array(
			'picked' => array(
				'label' => __('Show contact links', 'creatus'),
				'desc' => esc_html__('Show/hide author contact links', 'creatus'),
				'type' => 'switch',
				'right-choice' => array(
					'value' => 'hide',
					'label' => __('Hide', 'creatus')
				),
				'left-choice' => array(
					'value' => 'show',
					'label' => __('Show', 'creatus')
				),
				'value' => 'show'
			)
		),
		'choices' => array(
			'show' => array(
			
				'contact_label' => array(
					'type' => 'text',
					'value' => esc_html__('Contact me:', 'creatus'),
					'label' => __('Contact label', 'creatus'),
					'desc' => esc_html__('Insert contact label', 'creatus')
				),
				
				'label_metrics' => array(
					'type' => 'thz-typography',
					'label' => __('Contact label metrics', 'creatus'),
					'desc' => esc_html__('Adjust contact label font metrics.', 'creatus'),
					'value' => array(
						'size' => 14,
						'weight' => 600,
					),
					'disable' => array('hovered','align','text-shadow'),
				),							

				'contacts' => array(
					'type' => 'thz-sortable-checks',
					'value' => array(
						'twitter',
						'facebook',
						'github',
						'googleplus',
						'linkedin',
						'dribbble',
						'url',
					),
					'label' => __('Contact links', 'creatus'),
					'desc' => esc_html__('Check to show/hide specific contact links. Click and drag the label to sort.', 'creatus'),
					'choices' => array(
						'twitter' => esc_html__('Twitter', 'creatus'),
						'facebook' => esc_html__('Facebook', 'creatus'),
						'github' => esc_html__('GitHub', 'creatus'),
						'googleplus' => esc_html__('Google+', 'creatus'),
						'linkedin' => esc_html__('Linkedin', 'creatus'),
						'dribbble' => esc_html__('Dribbble', 'creatus'),
						'url' => esc_html__('Website', 'creatus'),
						'email' => esc_html__('Email', 'creatus')
					),
				),
								
				'icon_boxstyle' => array(
					'type' => 'thz-box-style',
					'label' => __('Contact icons box style', 'creatus'),
					'desc' => esc_html__('Adjust .thz-author-contact box style','creatus'),
					'preview' => true,
					'button-text' => esc_html__('Customize contact icons box style', 'creatus'),
					'popup' => true,
					'disable' => array('video'),
					'value' => array(
						'margin' => array(
							'top' => '4',
							'right' => '20',
							'bottom' => '0',
							'left' => '0'
						),
					)
				),
				'icons_metrics' => array(
					'type' => 'thz-multi-options',
					'label' => __('Contact icons metrics', 'creatus'),
					'desc' => esc_html__('Adjust contact icons metrics', 'creatus'),
					'value' => array(
						'fs' => 16,
						'tip' => 'hide',
						'co' => '',
						'hc' => '',
						'bgh' => '',
						'boh' => ''
					),
					'breakafter' => 'tip',
					'thz_options' => array(
						'fs' => array(
							'type' => 'spinner',
							'title' => esc_html__('Icon size', 'creatus'),
							'addon' => 'px',
							'min' => 0,
							'max' => 100
						),
						'tip' => array(
							'type' => 'short-select',
							'title' => esc_html__('Icon tooltip', 'creatus'),
							'choices' => array(
								'hide' => esc_html__('Hide', 'creatus'),
								'top' => esc_html__('Top', 'creatus'),
								'right' => esc_html__('Right', 'creatus'),
								'bottom' => esc_html__('Bottom', 'creatus'),
								'left' => esc_html__('Left', 'creatus')
							),
						),
						'co' => array(
							'type' => 'color',
							'title' => esc_html__('Icon color', 'creatus'),
							'box' => true
						),
						'hc' => array(
							'type' => 'color',
							'title' => esc_html__('Icon hovered', 'creatus'),
							'box' => true
						),
						'bgh' => array(
							'type' => 'color',
							'title' => esc_html__('Background hovered', 'creatus'),
							'box' => true
						),
						'boh' => array(
							'type' => 'color',
							'title' => esc_html__('Border hovered', 'creatus'),
							'box' => true
						)
					)
				)
			)
		)
	)
);