<?php
if (!defined('FW'))
	die('Forbidden');
$options = array(

	'hpt_bs' => array(
		'type' => 'thz-box-style',
		'label' => __('Title box style', 'creatus'),
		'preview' => true,
		'popup' => true,
		'button-text' => esc_html__('Customize title box style', 'creatus'),
		'desc' => esc_html__('Adjust .thz-hero-post-title box style','creatus'),
		'disable'=> array('video'),
		'value' => array(
			'padding' => array(
				'top' => 150,
				'right' => 0,
				'bottom' => 150,
				'left' => 0
			),
		),
		'units' => array(
			'borderradius',
			'boxsize',
			'padding',
			'margin',
		),
	),

	'hptm' => array(
		'type' => 'thz-multi-options',
		'label' => __('Title metrics', 'creatus'),
		'desc' => esc_html__('Adjust page title metrics', 'creatus'),
		'help' => esc_html__('Sub title (date, category and author) is visible on single post types only. On category, user or archive pages the description is shown instead if available. If custom hero option is set on page/category basis, you also have a custom sub title option wich is automaticaly visible for the page that it is set for.  Note, for vertical alignment to work properly you need either height or min-height set in title box style popup.', 'creatus'),
		'value' => array(
			'mode' => 'title',
			'tag' => 'h2',
			'va' => 'middle',
			'a' => 'center',
			's' => 'u',
		),
		'thz_options' => array(
			'mode' => array(
				'type' => 'short-select',
				'title' => esc_html__('Mode', 'creatus'),
				'attr' => array(
					'class' => 'thz-select-switch'
				),
				'choices' => array(
					'title' =>array(
						'text' =>  esc_html__('Page title', 'creatus'),
						'attr' => array(
							'data-disable' => 'hptm_txt',
						)
					),
					'custom' =>array(
						'text' =>  esc_html__('Custom text', 'creatus'),
						'attr' => array(
							'data-enable' => 'hptm_txt',
						)
					),
		
				),
			),
			'tag' => array(
				'type' => 'short-select',
				'title' => esc_html__('Tag', 'creatus'),
				'choices' => array(
					'h1' => esc_html__('H1', 'creatus'),
					'h2' => esc_html__('H2', 'creatus'),
					'h3' => esc_html__('H3', 'creatus'),
					'h4' => esc_html__('H4', 'creatus'),
					'h5' => esc_html__('H5', 'creatus'),
					'h6' => esc_html__('H6', 'creatus'),
					'div' => esc_html__('DIV', 'creatus'),
				)
			),
			'va' => array(
				'type' => 'short-select',
				'title' => esc_html__('Vertical align', 'creatus'),
				'choices' => array(
					'top' => esc_html__('Top', 'creatus'),
					'middle' => esc_html__('Middle', 'creatus'),
					'bottom' => esc_html__('Bottom', 'creatus'),
				)
			),
			'a' => array(
				'type' => 'short-select',
				'title' => esc_html__('Horizontal align', 'creatus'),
				'choices' => array(
					'left' => esc_html__('Left', 'creatus'),
					'center' => esc_html__('Center', 'creatus'),
					'right' => esc_html__('Right', 'creatus'),
				)
			),

			's' => array(
				'type' => 'short-select',
				'title' => esc_html__('Sub title', 'creatus'),
				'attr' => array(
					'class' => 'thz-select-switch sub-title-switch'
				),
				'choices' => array(
					'a' =>array(
						'text' =>  esc_html__('Above the title', 'creatus'),
						'attr' => array(
							'data-enable' => '.hero_sub_title_tab_li',
							'data-disable' => '',
						)
					),
					'u' =>array(
						'text' =>  esc_html__('Under the title', 'creatus'),
						'attr' => array(
							'data-enable' => '.hero_sub_title_tab_li',
							'data-disable' => '',
						)
					),
					'h' =>array(
						'text' =>  esc_html__('Hide', 'creatus'),
						'attr' => array(
							'data-enable' => '',
							'data-disable' => '.hero_sub_title_tab_li',
						)
					),
				)
			),

		)
	),
	'hptm_txt' => array(
		'type' => 'text',
		'label' => __('Custom title', 'creatus'),
		'value' => '',
		'desc' => esc_html__('Enter custom title text', 'creatus'),
	),

	'hpt_f' => array(
		'label' => __('Title font', 'creatus'),
		'type' => 'thz-typography',
		'value' => array(
			'size' 			=> 24,
		),
		'disable' => array('hovered'),
		'desc' => esc_html__('Adjust title font color family and metrics', 'creatus')
	),

	'hpt_aum' => array(
		'type' => 'thz-multi-options',
		'label' => __('Author metrics', 'creatus'),
		'desc' => esc_html__('Adjust author metrics', 'creatus'),
		'value' => array(
			'link' => 'link',
			'show' => 'show',
			'size' => 50,
			'shape' => 'circle',
			'location' => 'above',
			'space' => 10,
		),
		'thz_options' => array(
			'link' => array(
				'type' => 'short-select',
				'title' => esc_html__('Author link', 'creatus'),
				'choices' => array(
					'link' => esc_html__('Link to author page', 'creatus'),
					'donotlink' => esc_html__('Do not link to author page', 'creatus'),
				)
			),
			'show' => array(
				'title' => esc_html__('Avatar', 'creatus'),
				'type' => 'short-select',
				'value' => 'show',
				'attr' => array(
					'class' => 'thz-select-switch'
				),
				'choices' => array(
					'show' => array(
						'text' => esc_html__('Show', 'creatus'),
						'attr' => array(
							'data-enable' => '.hermea-size-parent,.hermea-shape-parent,.hermea-location-parent,.hermea-space-parent,hpt_avbs',
						)
					),
					'hide' => array(
						'text' => esc_html__('Hide', 'creatus'),
						'attr' => array(
							'data-disable' => '.hermea-size-parent,.hermea-shape-parent,.hermea-location-parent,.hermea-space-parent,hpt_avbs',
						)
					),
				)
			),
			'size' => array(
				'type' => 'spinner',
				'title' => esc_html__('Avatar size', 'creatus'),
				'addon' => 'px',
				'min' => 10,
				'attr' => array(
					'class' => 'hermea-size'
				),
			),
			'shape' => array(
				'type' => 'short-select',
				'title' => esc_html__('Avatar shape', 'creatus'),
				'choices' => array(
					'square' => esc_html__('Square', 'creatus'),
					'rounded' => esc_html__('Rounded', 'creatus'),
					'circle' => esc_html__('Circle', 'creatus'),
				),
				'attr' => array(
					'class' => 'hermea-shape'
				),
			),
			'location' => array(
				'type' => 'short-select',
				'title' => esc_html__('Avatar location', 'creatus'),
				'choices' => array(
					'above' => esc_html__('Above the title', 'creatus'),
					'under' => esc_html__('Under the title', 'creatus'),
					'undersub' => esc_html__('Under the sub title', 'creatus'),
					'nextto' => esc_html__('Next to the author name', 'creatus'),
				),
				'attr' => array(
					'class' => 'hermea-location'
				),
			),
			'space' => array(
				'type' => 'spinner',
				'title' => esc_html__('Avatar space', 'creatus'),
				'addon' => 'px',
				'max' => 100,
				'attr' => array(
					'class' => 'hermea-space'
				),
			),
		)
	),

	'hpt_an' => array(
		'type' => 'thz-animation',
		'label' => false,
		'value' => array(
			'animate' => 'inactive',
			'effect' => 'thz-anim-slideIn-up',
			'duration' => 400,
			'delay' => 0
		),
		'addlabel' => esc_html__('Animate title', 'creatus'),
		'adddesc' => esc_html__('Add animation to .thz-hero-post-title container', 'creatus')
	),
);


if(!$pageoptions){

	unset($options['hptm']['value']['mode'],$options['hptm']['thz_options']['mode'],$options['hptm_txt']);
	
}