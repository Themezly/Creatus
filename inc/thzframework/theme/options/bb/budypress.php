<?php
if (!defined('FW'))
	die('Forbidden');
	
if ( !class_exists( 'BuddyPress' ) ) {
	$options = array();
	return;
}

$options = array(
	'bplt' => array(
		'label' => __('Layout type', 'creatus'),
		'desc' => esc_html__('Select default layout type', 'creatus'),
		'type' => 'switch',
		'right-choice' => array(
			'value' => 'default',
			'label' => __('Boxed', 'creatus')
		),
		'left-choice' => array(
			'value' => 'timeline',
			'label' => __('Timeline', 'creatus')
		),
		'value' => 'timeline'
	),
	'bp_animate' => array(
		'type' => 'thz-animation',
		'label' => false,
		'value' => array(
			'animate' => 'inactive',
			'effect' => 'thz-anim-slideIn-up',
			'duration' => 500,
			'delay' => 0
		),
		'addlabel' => esc_html__('Animate items', 'creatus'),
		'adddesc' => esc_html__('Add animation to activity, friends and groups HTML container', 'creatus')
	),
	'bbci' => array(
		'type' => 'thz-multi-options',
		'label' => __('Cover images height', 'creatus'),
		'desc' => esc_html__('Adjust group and profile cover image height', 'creatus'),
		'value' => array(
			'p' => 450,
			'g' => 450
		),
		'thz_options' => array(
			'p' => array(
				'type' => 'spinner',
				'title' => esc_html__('Profile', 'creatus'),
				'addon' => 'px'
			),
			'g' => array(
				'type' => 'spinner',
				'title' => esc_html__('Group', 'creatus'),
				'addon' => 'px'
			)
		)
	),
	'bptmc' => array(
		'type' => 'thz-multi-options',
		'label' => __('Top level menu', 'creatus'),
		'desc' => esc_html__('Adjust BuddyPress top level user menu colors', 'creatus'),
		'value' => array(
			'cbg' => '#fafafa',
			'lbg' => '#fafafa',
			'lco' => '#999999',
			'crbg' => '#f3f3f3',
			'crco' => '#121212'
		),
		'thz_options' => array(
			'cbg' => array(
				'type' => 'color',
				'title' => esc_html__('Container bg', 'creatus'),
				'box' => true
			),
			'lbg' => array(
				'type' => 'color',
				'title' => esc_html__('Link bg', 'creatus'),
				'box' => true
			),
			'lco' => array(
				'type' => 'color',
				'title' => esc_html__('Link color', 'creatus'),
				'box' => true
			),
			'crbg' => array(
				'type' => 'color',
				'title' => esc_html__('Current bg', 'creatus'),
				'box' => true
			),
			'crco' => array(
				'type' => 'color',
				'title' => esc_html__('Current color', 'creatus'),
				'box' => true
			)
		)
	),
	'bpsmc' => array(
		'type' => 'thz-multi-options',
		'label' => __('Sub level menu', 'creatus'),
		'desc' => esc_html__('Adjust BuddyPress sub level user menu colors', 'creatus'),
		'value' => array(
			'cbg' => '#f3f3f3',
			'lbg' => '#f3f3f3',
			'lco' => '#999999',
			'crbg' => '',
			'crco' => '#121212'
		),
		'thz_options' => array(
			'cbg' => array(
				'type' => 'color',
				'title' => esc_html__('Container bg', 'creatus'),
				'box' => true
			),
			'lbg' => array(
				'type' => 'color',
				'title' => esc_html__('Link bg', 'creatus'),
				'box' => true
			),
			'lco' => array(
				'type' => 'color',
				'title' => esc_html__('Link color', 'creatus'),
				'box' => true
			),
			'crbg' => array(
				'type' => 'color',
				'title' => esc_html__('Current bg', 'creatus'),
				'box' => true
			),
			'crco' => array(
				'type' => 'color',
				'title' => esc_html__('Current color', 'creatus'),
				'box' => true
			)
		)
	),
	'bpbc' => array(
		'type' => 'thz-multi-options',
		'label' => __('Counts bubble', 'creatus'),
		'desc' => esc_html__('Adjust BuddyPress menu counts bubble colors', 'creatus'),
		'value' => array(
			'bg' => '#dddddd',
			'co' => '#121212'
		),
		'thz_options' => array(
			'bg' => array(
				'type' => 'color',
				'title' => esc_html__('Background', 'creatus'),
				'box' => true
			),
			'co' => array(
				'type' => 'color',
				'title' => esc_html__('Color', 'creatus'),
				'box' => true
			)
		)
	),
	'bpic' => array(
		'type' => 'thz-multi-options',
		'label' => __('Items colors', 'creatus'),
		'desc' => esc_html__('Adjust BuddyPress items and bits colors', 'creatus'),
		'value' => array(
			'bo' => '#eaeaea',
			'bit' => '#b4b4b4'
		),
		'thz_options' => array(
			'bo' => array(
				'type' => 'color',
				'title' => esc_html__('Borders', 'creatus'),
				'box' => true
			),
			'bit' => array(
				'type' => 'color',
				'title' => esc_html__('Bits', 'creatus'),
				'box' => true
			)
		)
	),
	'bpbtn' => array(
		'type' => 'thz-multi-options',
		'label' => __('Buttons', 'creatus'),
		'desc' => esc_html__('Adjust BuddyPress buttons colors', 'creatus'),
		'value' => array(
			'bg' => '#ffffff',
			'bo' => '#eaeaea',
			'co' => '#aaaaaa'
		),
		'thz_options' => array(
			'bg' => array(
				'type' => 'color',
				'title' => esc_html__('Background', 'creatus'),
				'box' => true
			),
			'bo' => array(
				'type' => 'color',
				'title' => esc_html__('Border', 'creatus'),
				'box' => true
			),
			'co' => array(
				'type' => 'color',
				'title' => esc_html__('Color', 'creatus'),
				'box' => true
			)
		)
	),
	'bpbtnh' => array(
		'type' => 'thz-multi-options',
		'label' => __('Buttons hovered', 'creatus'),
		'desc' => esc_html__('Adjust BuddyPress hovered buttons colors', 'creatus'),
		'value' => array(
			'bg' => '#fafafa',
			'bo' => '#eaeaea',
			'co' => '#444444'
		),
		'thz_options' => array(
			'bg' => array(
				'type' => 'color',
				'title' => esc_html__('Background', 'creatus'),
				'box' => true
			),
			'bo' => array(
				'type' => 'color',
				'title' => esc_html__('Border', 'creatus'),
				'box' => true
			),
			'co' => array(
				'type' => 'color',
				'title' => esc_html__('Color', 'creatus'),
				'box' => true
			)
		)
	),
	'bpwt' => array(
		'type' => 'thz-multi-options',
		'label' => __('Widgets tabs', 'creatus'),
		'desc' => esc_html__('Adjust BuddyPress widgets tabs navigation colors', 'creatus'),
		'value' => array(
			'bg' => '#ffffff',
			'bo' => '#eaeaea',
			'co' => '#aaaaaa'
		),
		'thz_options' => array(
			'bg' => array(
				'type' => 'color',
				'title' => esc_html__('Background', 'creatus'),
				'box' => true
			),
			'bo' => array(
				'type' => 'color',
				'title' => esc_html__('Border', 'creatus'),
				'box' => true
			),
			'co' => array(
				'type' => 'color',
				'title' => esc_html__('Color', 'creatus'),
				'box' => true
			)
		)
	),
	'bpwth' => array(
		'type' => 'thz-multi-options',
		'label' => __('Widgets tabs hovered', 'creatus'),
		'desc' => esc_html__('Adjust BuddyPress widgets tabs navigation hovered colors', 'creatus'),
		'value' => array(
			'bg' => '#fafafa',
			'bo' => '#eaeaea',
			'co' => '#444444'
		),
		'thz_options' => array(
			'bg' => array(
				'type' => 'color',
				'title' => esc_html__('Background', 'creatus'),
				'box' => true
			),
			'bo' => array(
				'type' => 'color',
				'title' => esc_html__('Border', 'creatus'),
				'box' => true
			),
			'co' => array(
				'type' => 'color',
				'title' => esc_html__('Color', 'creatus'),
				'box' => true
			)
		)
	),
	'bplmb' => array(
		'type' => 'thz-multi-options',
		'label' => __('Load more', 'creatus'),
		'desc' => esc_html__('Adjust BuddyPress load more button colors', 'creatus'),
		'value' => array(
			'bg' => '#fafafa',
			'bo' => '#eaeaea',
			'co' => '#cccccc'
		),
		'thz_options' => array(
			'bg' => array(
				'type' => 'color',
				'title' => esc_html__('Background', 'creatus'),
				'box' => true
			),
			'bo' => array(
				'type' => 'color',
				'title' => esc_html__('Border', 'creatus'),
				'box' => true
			),
			'co' => array(
				'type' => 'color',
				'title' => esc_html__('Color', 'creatus'),
				'box' => true
			)
		)
	),
	'bplmbh' => array(
		'type' => 'thz-multi-options',
		'label' => __('Load more hovered', 'creatus'),
		'desc' => esc_html__('Adjust BuddyPress load more button hovered colors', 'creatus'),
		'value' => array(
			'bg' => '#fafafa',
			'bo' => '#eaeaea',
			'co' => '#121212'
		),
		'thz_options' => array(
			'bg' => array(
				'type' => 'color',
				'title' => esc_html__('Background', 'creatus'),
				'box' => true
			),
			'bo' => array(
				'type' => 'color',
				'title' => esc_html__('Border', 'creatus'),
				'box' => true
			),
			'co' => array(
				'type' => 'color',
				'title' => esc_html__('Color', 'creatus'),
				'box' => true
			)
		)
	)
);