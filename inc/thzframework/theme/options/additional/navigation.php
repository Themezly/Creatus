<?php
if (!defined('FW')) {
	die('Forbidden');
}
$nafixedgroup     = 'nfstyle,nfcolors,nfthumb';
$navlinksgroup    = 'nrbs,nhbs,btnel_mx,btnthbs,btnm,btnc,btnf,btnptf';
$location_choices = array(
	'fixed' => array(
		'text' => esc_html__('Fixed ( centered arrows on side of the page )', 'creatus'),
		'attr' => array(
			'data-enable' => $nafixedgroup,
			'data-disable' => $navlinksgroup
		)
	),
	'inside' => array(
		'text' => esc_html__('Under the comments ( inside the post )', 'creatus'),
		'attr' => array(
			'data-enable' => $navlinksgroup,
			'data-disable' => $nafixedgroup
		)
	),
	'outside' => array(
		'text' => esc_html__('Above the footer section ( outside the main )', 'creatus'),
		'attr' => array(
			'data-enable' => $navlinksgroup,
			'data-disable' => $nafixedgroup
		)
	)
);

$location_choices = isset($nav_location_choices) ? $nav_location_choices : $location_choices;

$options          = array(
	'pnav_loc' => array(
		'label' => __('Post navigation location', 'creatus'),
		'desc' => esc_html__('Set single post navigation location', 'creatus'),
		'type' => 'select',
		'value' => 'outside',
		'attr' => array(
			'class' => 'thz-select-switch'
		),
		'choices' => $location_choices
	),
	'nfstyle' => array(
		'type' => 'thz-multi-options',
		'label' => __('Link metrics', 'creatus'),
		'desc' => esc_html__('Adjust navigation link metrics', 'creatus'),
		'value' => array(
			'bg' => 'color_5',
			'bcolor' => 'color_4',
			'width' => 1,
			'style' => 'solid',
			'radius' => 0
		),
		'thz_options' => array(
			'bg' => array(
				'type' => 'color',
				'title' => esc_html__('Background', 'creatus'),
				'box' => true
			),
			'bcolor' => array(
				'type' => 'color',
				'title' => esc_html__('Border', 'creatus'),
				'box' => true
			),
			'width' => array(
				'type' => 'spinner',
				'title' => esc_html__('Border width', 'creatus'),
				'addon' => 'px',
				'min' => 0,
				'max' => 50
			),
			'style' => array(
				'type' => 'short-select',
				'title' => esc_html__('Border style', 'creatus'),
				'choices' => array(
					'solid' => esc_html__('Solid', 'creatus'),
					'dashed' => esc_html__('Dashed', 'creatus'),
					'dotted' => esc_html__('Dotted', 'creatus')
				)
			),
			'radius' => array(
				'type' => 'spinner',
				'title' => esc_html__('Border radius', 'creatus'),
				'addon' => 'px',
				'min' => 0,
				'max' => 50
			)
		)
	),
	'nfcolors' => array(
		'type' => 'thz-multi-options',
		'label' => __('Colors', 'creatus'),
		'desc' => esc_html__('Adjust navigation link icon and title colors', 'creatus'),
		'value' => array(
			'ic' => '#444444',
			'ti' => '',
			'tih' => ''
		),
		'thz_options' => array(
			'ic' => array(
				'type' => 'color',
				'title' => esc_html__('Icon', 'creatus'),
				'box' => true
			),
			'ti' => array(
				'type' => 'color',
				'title' => esc_html__('Title', 'creatus'),
				'box' => true
			),
			'tih' => array(
				'type' => 'color',
				'title' => esc_html__('Titler hovered', 'creatus'),
				'box' => true
			)
		)
	),
	'nfthumb' => array(
		'type' => 'multi-picker',
		'label' => false,
		'desc' => false,
		'picker' => array(
			'picked' => array(
				'label' => __('Show thumbnail', 'creatus'),
				'desc' => esc_html__('Show/hide previous/next post thumbnail', 'creatus'),
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
				'radius' => array(
					'type' => 'thz-spinner',
					'label' => __('Thumbnail border radius', 'creatus'),
					'desc' => esc_html__('Set previous/next post thumbnail border radius. Thumb size is 80px. ', 'creatus'),
					'addon' => 'px',
					'min' => 0,
					'value' => 0
				)
			)
		)
	),
	'nrbs' => array(
		'type' => 'thz-box-style',
		'label' => __('Row box style', 'creatus'),
		'preview' => true,
		'button-text' => esc_html__('Customize navigation row box style', 'creatus'),
		'desc' => esc_html__('Adjust .thz-post-navigation-row box style', 'creatus'),
		'popup' => true,
		'disable' => array(
			'video'
		),
		'units' => array(
			'borderradius',
			'boxsize',
			'padding',
			'margin'
		),
		'value' => array(
			'padding' => array(
				'top' => 30,
				'right' => 0,
				'bottom' => 30,
				'left' => 0
			),
			'borders' => array(
				'all' => 'separate',
				'top' => array(
					'w' => 1,
					's' => 'solid',
					'c' => 'color_4'
				),
				'right' => array(
					'w' => 0,
					's' => 'solid',
					'c' => ''
				),
				'bottom' => array(
					'w' => 1,
					's' => 'solid',
					'c' => 'color_4'
				),
				'left' => array(
					'w' => 0,
					's' => 'solid',
					'c' => ''
				)
			)
		)
	),
	'nhbs' => array(
		'type' => 'thz-box-style',
		'label' => __('Holder box style', 'creatus'),
		'preview' => true,
		'button-text' => esc_html__('Customize navigation box style', 'creatus'),
		'desc' => esc_html__('Adjust .thz-post-navigation box style', 'creatus'),
		'popup' => true,
		'disable' => array(
			'video'
		),
		'units' => array(
			'borderradius',
			'boxsize',
			'padding',
			'margin'
		),
		'value' => array()
	),
	'btnel_mx' => array(
		'type' => 'thz-multi-options',
		'label' => __('Button layout', 'creatus'),
		'desc' => esc_html__('Set navigation button layout metrics', 'creatus'),
		'help' => esc_html__('This option will let you adjust the navigation button layout. Table mode places button elements next to each other. Overlay mode places post fetured image as a button background. Icon nudge option can help you align the icon verticaly. This can come in handy if icon font does not place the icon in absolute vertical middle. Nudge moves relative top position of the icon.', 'creatus'),
		'value' => array(
			'm' => 'table',
			'mh' => '300',
			'ic' => 'show',
			'th' => 'hide',
			'di' => 'show',
			'ti' => 'hide',
			'ics' => '14',
			'icn' => ''
		),
		'breakafter' => array(
			'ti'
		),
		'thz_options' => array(
			'm' => array(
				'type' => 'short-select',
				'title' => esc_html__('Mode', 'creatus'),
				'attr' => array(
					'class' => 'thz-select-switch'
				),
				'choices' => array(
					'table' => array(
						'text' => esc_html__('Table', 'creatus'),
						'attr' => array(
							'data-enable' => 'btnm,btnthbs,.navtab-el-parent',
							'data-disable' => '.navover-el-parent'
						)
					),
					'overlay' => array(
						'text' => esc_html__('Overlay', 'creatus'),
						'attr' => array(
							'data-disable' => 'btnm,btnthbs,.navtab-el-parent',
							'data-enable' => '.navover-el-parent'
						)
					)
				)
			),
			'mh' => array(
				'type' => 'spinner',
				'title' => esc_html__('Min height', 'creatus'),
				'addon' => 'px',
				'min' => 0,
				'attr' => array(
					'class' => 'navover-el'
				)
			),
			'ic' => array(
				'type' => 'short-select',
				'title' => esc_html__('Icon', 'creatus'),
				'attr' => array(
					'class' => 'thz-select-switch'
				),
				'choices' => array(
					'show' => array(
						'text' => esc_html__('Show', 'creatus'),
						'attr' => array(
							'data-enable' => '.navic-el-parent'
						)
					),
					'hover' => array(
						'text' => esc_html__('Show on hover', 'creatus'),
						'attr' => array(
							'data-enable' => '.navic-el-parent'
						)
					),
					'hide' => array(
						'text' => esc_html__('Hide', 'creatus'),
						'attr' => array(
							'data-disable' => '.navic-el-parent'
						)
					)
				)
			),
			'th' => array(
				'type' => 'short-select',
				'title' => esc_html__('Thumbnail', 'creatus'),
				'attr' => array(
					'class' => 'thz-select-switch navtab-el'
				),
				'choices' => array(
					'show' => array(
						'text' => esc_html__('Show', 'creatus'),
						'attr' => array(
							'data-enable' => 'btnthbs'
						)
					),
					'hover' => array(
						'text' => esc_html__('Show on hover', 'creatus'),
						'attr' => array(
							'data-enable' => 'btnthbs'
						)
					),
					'hide' => array(
						'text' => esc_html__('Hide', 'creatus'),
						'attr' => array(
							'data-disable' => 'btnthbs'
						)
					)
				)
			),
			'di' => array(
				'type' => 'short-select',
				'title' => esc_html__('Direction', 'creatus'),
				'attr' => array(
					'class' => 'thz-select-switch'
				),
				'choices' => array(
					'show' => array(
						'text' => esc_html__('Show', 'creatus'),
						'attr' => array(
							'data-enable' => 'btnf'
						)
					),
					'hide' => array(
						'text' => esc_html__('Hide', 'creatus'),
						'attr' => array(
							'data-disable' => 'btnf'
						)
					)
				)
			),
			'ti' => array(
				'type' => 'short-select',
				'title' => esc_html__('Title', 'creatus'),
				'attr' => array(
					'class' => 'thz-select-switch'
				),
				'choices' => array(
					'show' => array(
						'text' => esc_html__('Show', 'creatus'),
						'attr' => array(
							'data-enable' => 'btnptf'
						)
					),
					'hide' => array(
						'text' => esc_html__('Hide', 'creatus'),
						'attr' => array(
							'data-disable' => 'btnptf'
						)
					)
				)
			),
			'ics' => array(
				'type' => 'spinner',
				'title' => esc_html__('Icon size', 'creatus'),
				'addon' => 'px',
				'min' => 0,
				'max' => 100,
				'attr' => array(
					'class' => 'navic-el'
				)
			),
			'icn' => array(
				'type' => 'spinner',
				'title' => esc_html__('Icon Nudge', 'creatus'),
				'addon' => 'px',
				'min' => -20,
				'max' => 20,
				'attr' => array(
					'class' => 'navic-el'
				)
			)
		)
	),
	'btnthbs' => array(
		'type' => 'thz-box-style',
		'label' => __('Thumbnail box style', 'creatus'),
		'preview' => true,
		'button-text' => esc_html__('Customize thumbnail box style', 'creatus'),
		'desc' => esc_html__('Adjust .thz-nav-thumb box style', 'creatus'),
		'popup' => true,
		'disable' => array(
			'layout',
			'video',
			'transform',
			'background'
		),
		'value' => array(
			'boxsize' => array(
				'width' => '35px',
				'height' => '35px'
			)
		)
	),
	'btnm' => array(
		'type' => 'thz-multi-options',
		'label' => __('Button metrics', 'creatus'),
		'desc' => esc_html__('Adjust navigation button metrics', 'creatus'),
		'value' => array(
			'vp' => 0,
			'hp' => 0,
			'bw' => 0,
			'bs' => 'solid',
			'br' => 0
		),
		'thz_options' => array(
			'vp' => array(
				'type' => 'spinner',
				'title' => esc_html__('V-Padding', 'creatus'),
				'addon' => 'px',
				'min' => 0,
				'max' => 100
			),
			'hp' => array(
				'type' => 'spinner',
				'title' => esc_html__('H-Padding', 'creatus'),
				'addon' => 'px',
				'min' => 0,
				'max' => 100
			),
			'bw' => array(
				'type' => 'spinner',
				'title' => esc_html__('Border width', 'creatus'),
				'addon' => 'px',
				'min' => 0,
				'max' => 50
			),
			'bs' => array(
				'type' => 'short-select',
				'title' => esc_html__('Border style', 'creatus'),
				'choices' => array(
					'solid' => esc_html__('Solid', 'creatus'),
					'dashed' => esc_html__('Dashed', 'creatus'),
					'dotted' => esc_html__('Dotted', 'creatus')
				)
			),
			'br' => array(
				'type' => 'spinner',
				'title' => esc_html__('Border radius', 'creatus'),
				'addon' => 'px',
				'min' => 0,
				'max' => 100
			)
		)
	),
	'btnc' => array(
		'type' => 'thz-multi-options',
		'label' => __('Button colors', 'creatus'),
		'desc' => esc_html__('Adjust navigation button (.thz-nav-link) colors', 'creatus'),
		'value' => array(
			'bg' => '',
			'bgh' => '',
			'bc' => '',
			'bch' => '',
			'co' => '#2c2e30',
			'coh' => 'color_1',
			'ov' => 'rgba(0, 0, 0, 0.60)',
			'ovh' => 'rgba(0, 0, 0, 0.85)'
		),
		'thz_options' => array(
			'bg' => array(
				'type' => 'color',
				'title' => esc_html__('Background', 'creatus'),
				'box' => true,
				'attr' => array(
					'class' => 'navtab-el'
				)
			),
			'bgh' => array(
				'type' => 'color',
				'title' => esc_html__('Background hovered', 'creatus'),
				'box' => true,
				'attr' => array(
					'class' => 'navtab-el'
				)
			),
			'bc' => array(
				'type' => 'color',
				'title' => esc_html__('Border', 'creatus'),
				'box' => true,
				'attr' => array(
					'class' => 'navtab-el'
				)
			),
			'bch' => array(
				'type' => 'color',
				'title' => esc_html__('Border hovered', 'creatus'),
				'box' => true,
				'attr' => array(
					'class' => 'navtab-el'
				)
			),
			'co' => array(
				'type' => 'color',
				'title' => esc_html__('Color', 'creatus'),
				'box' => true
			),
			'coh' => array(
				'type' => 'color',
				'title' => esc_html__('Color hovered', 'creatus'),
				'box' => true
			),
			'ov' => array(
				'type' => 'color',
				'title' => esc_html__('Overlay', 'creatus'),
				'box' => true,
				'attr' => array(
					'class' => 'navover-el'
				)
			),
			'ovh' => array(
				'type' => 'color',
				'title' => esc_html__('Overlay hovered', 'creatus'),
				'box' => true,
				'attr' => array(
					'class' => 'navover-el'
				)
			)
		)
	),
	'btnf' => array(
		'type' => 'thz-typography',
		'label' => __('Direction font metrics', 'creatus'),
		'desc' => esc_html__('Adjust navigation direction (.thz-nav-direction) font metrics.', 'creatus'),
		'value' => array(
			'size' => 11,
			'weight' => 700,
			'spacing' => '0.5px',
			'transform' => 'uppercase'
		),
		'disable' => array(
			'align'
		)
	),
	'btnptf' => array(
		'type' => 'thz-typography',
		'label' => __('Title font metrics', 'creatus'),
		'desc' => esc_html__('Adjust navigation title (.thz-nav-title) font metrics.', 'creatus'),
		'value' => array(),
		'disable' => array(
			'align'
		)
	)
);