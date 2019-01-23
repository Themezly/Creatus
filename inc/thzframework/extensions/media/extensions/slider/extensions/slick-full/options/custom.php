<?php
if (!defined('FW')) {
	die('Forbidden');
}
$options = array(

	'imgp' => array(
		'label' => __('Image position', 'creatus'),
		'desc' => __('Select slide background image position.', 'creatus'),
		'type' => 'select',
		'value' => 'thz-center-top',
		'choices' => _thz_bg_positions_list( true )
	),

	'px' => array(
		'type' => 'multi-picker',
		'label' => false,
		'desc' => false,
		'show_borders' => true,
		'picker' => array(
			'picked' => array(
				'label' => __('Parallax', 'creatus'),
				'desc' => esc_html__('Activate parallax effect', 'creatus'),
				'type' => 'switch',
				'right-choice' => array(
					'value' => 'inactive',
					'label' => __('Inactive', 'creatus')
				),
				'left-choice' => array(
					'value' => 'active',
					'label' => __('Active', 'creatus')
				),
				'value' => 'active'
			)
		),
		'choices' => array(
			'active' => array(
				'p' => array(
					'type' => 'thz-multi-options',
					'label' => '',
					'desc' => esc_html__('Adjust parallax settings', 'creatus'),
					'value' => array(
						'v' => 10,
						'd' => 'up',
						's' => 'no'
					),
					'thz_options' => array(
						'v' => array(
							'type' => 'spinner',
							'title' => esc_html__('Velocity', 'creatus'),
							'addon' => 'v',
							'min' => 1,
							'max' => 100
						),
						'd' => array(
							'type' => 'short-select',
							'title' => esc_html__('Direction', 'creatus'),
							'choices' => array(
								'up' => esc_html__('Up', 'creatus'),
								'down' => esc_html__('Down', 'creatus'),
								'left' => esc_html__('Left', 'creatus'),
								'right' => esc_html__('Right', 'creatus'),
								'fixed' => esc_html__('Fixed', 'creatus')
							)
						),
						's' => array(
							'type' => 'short-select',
							'title' => esc_html__('Scale', 'creatus'),
							'choices' => array(
								'up' => esc_html__('Up', 'creatus'),
								'down' => esc_html__('Down', 'creatus'),
								'no' => esc_html__('Do not scale', 'creatus')
							)
						)
					)
				)
			)
		)
	),
	'sub' => array(
		'type' => 'text',
		'label' => __('Subtitle text', 'creatus'),
		'desc' => esc_html__('Add subtitle text', 'creatus'),
		'value' => ''
	),
	'subloc' => array(
		'label' => __('Subtitle location', 'creatus'),
		'desc' => esc_html__('Set subtitle location', 'creatus'),
		'type' => 'switch',
		'right-choice' => array(
			'value' => 'under',
			'label' => __('Under the title', 'creatus')
		),
		'left-choice' => array(
			'value' => 'above',
			'label' => __('Above the title', 'creatus')
		),
		'value' => 'above'
	),
	'btns' => array(
		'type' => 'addable-popup',
		'value' => array(),
		'label' => __('Add button', 'creatus'),
		'desc' => esc_html__('Add up to 2 slide buttons.', 'creatus'),
		'template' => '{{ if (b) { }}{{- JSON.parse(b.json).buttonText }}{{ } }}',
		'popup-title' => esc_html__('Slide button settings', 'creatus'),
		'size' => 'large',
		'add-button-text' => esc_html__('Add', 'creatus'),
		'sortable' => true,
		'limit' => 2,
		'popup-options' => array(
			'b' => array(
				'type' => 'thz-button',
				'value' => array(
					'buttonText' => 'Learn more',
					'activeColor' => 'theme',
					'html' => '<div class="thz-btn-container"><a class="thz-button thz-btn-theme thz-btn-normal thz-radius-4 thz-btn-border-1 thz-align-center" href="#"><span class="thz-btn-text thz-fs-14 thz-fw-400">Learn more</span></a></div>'
				),
				'label' => false
			)
		)
	),
	'colors' => array(
		'type' => 'thz-multi-options',
		'label' => __('Colors', 'creatus'),
		'desc' => esc_html__('Adjust slide text and overlay colors', 'creatus'),
		'value' => array(
			't' => '#ffffff',
			's' => '#ffffff',
			'd' => '#ffffff',
			'o' => 'rgba(15,15,15,0.5)'
		),
		'thz_options' => array(
			't' => array(
				'type' => 'color',
				'title' => esc_html__('Title', 'creatus'),
				'box' => true
			),
			's' => array(
				'type' => 'color',
				'title' => esc_html__('Sub title', 'creatus'),
				'box' => true
			),
			'd' => array(
				'type' => 'color',
				'title' => esc_html__('Description', 'creatus'),
				'box' => true
			),
			'o' => array(
				'type' => 'color',
				'title' => esc_html__('Overlay', 'creatus'),
				'box' => true
			)
		)
	),
	'smx' => array(
		'type' => 'thz-multi-options',
		'label' => __('Content metrics', 'creatus'),
		'desc' => esc_html__('Adjust slide content metrics. Max width can be px or %. If no unit is set, % is default.', 'creatus'),
		'value' => array(
			'w' => '100%',
			'p' => 'center',
			'a' => 'center'
		),
		'thz_options' => array(
			'w' => array(
				'type' => 'short-text',
				'title' => esc_html__('Max width', 'creatus')
			),
			'p' => array(
				'type' => 'short-select',
				'title' => esc_html__('Position', 'creatus'),
				'choices' => array(
					'left' => esc_html__('Left', 'creatus'),
					'center' => esc_html__('Center', 'creatus'),
					'right' => esc_html__('Right', 'creatus')
				)
			),
			'a' => array(
				'type' => 'short-select',
				'title' => esc_html__('Text align', 'creatus'),
				'choices' => array(
					'default' => esc_html__('Default', 'creatus'),
					'left' => esc_html__('Left', 'creatus'),
					'center' => esc_html__('Center', 'creatus'),
					'right' => esc_html__('Right', 'creatus')
				)
			)
		)
	),
	'tm' => array(
		'type' => 'thz-box-style',
		'label' => esc_html__('Title box style', 'creatus'),
		'popup' => true,
		'preview' => true,
		'button-text' => esc_html__('Customize .thz-sliders-title box style', 'creatus'),
		'desc' => esc_html__('Adjust .thz-sliders-title box style', 'creatus'),
		'disable' => array('video'),
		'units' => array(
			'borderradius',
			'boxsize',
			'padding',
			'margin',
		),
		'value' => array(
			'margin' => array(
				'top' => '0',
				'right' => '0',
				'bottom' => '0',
				'left' => '0'
			)
		)
	),
	'sm' => array(
		'type' => 'thz-box-style',
		'label' => esc_html__('Sub title box style', 'creatus'),
		'popup' => true,
		'preview' => true,
		'button-text' => esc_html__('Customize .thz-sliders-sub box style', 'creatus'),
		'desc' => esc_html__('Adjust .thz-sliders-sub box style', 'creatus'),
		'disable' => array('video'),
		'units' => array(
			'borderradius',
			'boxsize',
			'padding',
			'margin',
		),

		'value' => array(
			'margin' => array(
				'top' => '20',
				'right' => '0',
				'bottom' => '0',
				'left' => '0'
			)
		)
	),
	'dm' => array(
		'type' => 'thz-box-style',
		'label' => esc_html__('Description box style', 'creatus'),
		'popup' => true,
		'preview' => true,
		'button-text' => esc_html__('Customize .thz-sliders-desc box style', 'creatus'),
		'desc' => esc_html__('Adjust .thz-sliders-desc box style', 'creatus'),
		'disable' => array('video'),
		'units' => array(
			'borderradius',
			'boxsize',
			'padding',
			'margin',
		),
		'value' => array(
			'margin' => array(
				'top' => 0,
				'right' => 0,
				'bottom' => 0,
				'left' => 0
			)
		)
	),
	'bm' => array(
		'type' => 'thz-box-style',
		'label' => esc_html__('Buttons container box style', 'creatus'),
		'popup' => true,
		'preview' => true,
		'button-text' => esc_html__('Customize .thz-sliders-buttons box style', 'creatus'),
		'desc' => esc_html__('Adjust .thz-sliders-buttons box style', 'creatus'),
		'disable' => array('video'),
		'units' => array(
			'borderradius',
			'boxsize',
			'padding',
			'margin',
		),
		'value' => array(
			'margin' => array(
				'top' => '0',
				'right' => '0',
				'bottom' => '0',
				'left' => '0'
			)
		)
	)
);