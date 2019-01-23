<?php if (!defined('FW')) die('Forbidden');

$options = array(

	'button' => array(
		'type' => 'addable-popup',
		'value' => array(),
		'label' => __('Custom button', 'creatus'),
		'desc'  => esc_html__('Use custom button for this menu item.', 'creatus'),
		'template' => 'This menu item is using custom button',
		'popup-title' => null,
		'size' => 'large',
		'add-button-text' => esc_html__('Make/edit custom button', 'creatus'),
		'sortable' => false,
		'limit' => 1,
		'popup-options' => array(
			'btn' => array(
				'type' => 'thz-button',
				'value' => array(
					'buttonText' => 'Custom text',
					'activeColor' => 'theme',
					'html' => '<div class="thz-btn-container"><a class="thz-button thz-btn-theme thz-btn-normal thz-radius-4 thz-btn-border-1 thz-align-center" href="#"><span class="thz-btn-text thz-fs-14 thz-fw-400">Custom text</span></a></div>'
				),
				'label' => false,
				'hidelinks' => true
			)
		),
	),	
	
	'di_mx' => array(
		'type' => 'thz-multi-options',
		'label' => esc_html__('Item metrics', 'creatus'),
		'desc' => esc_html__('Adjust item metrics. See help for more info.', 'creatus'),
		'help' => esc_html__('Title hidden is useful if you want to display only item icon. Dislay mode separator sets the item as a separator between items which helps separate vertical items in to groups. Note that separator item link is disabled.', 'creatus'),
		'value' => array(
			't' => 'show',
			'm' => 'd',
		),
		'thz_options' => array(
			't' => array(
				'type' => 'short-select',
				'title' => esc_html__('Title', 'creatus'),
				'choices' => array(
					'show' => esc_html__('Visible', 'creatus'),
					'hide' => esc_html__('Hidden', 'creatus')
				)
			),
			'm' => array(
				'type' => 'short-select',
				'title' => esc_html__('Display mode', 'creatus'),
				'choices' => array(
					'd' => esc_html__('Default', 'creatus'),
					's' => esc_html__('Separator', 'creatus')
				)
			),
		),
	),

	'visibleto' => array(
		'type'  => 'checkboxes',
		'value' => array(),
		'label' => __('Visible to', 'creatus'),
		'desc'  => esc_html__('Select user roles that can see this menu item. Leave unchecked to be visible to everyone. See help for more info.', 'creatus'),
		'help' => esc_html__('Please note that this restricts visibility only, not the page/post access. Note that child elements will inherit the visibility. If you select Logged in than all users that are logged in will see this item. For more restrictive visibility do not use Logged in but rather select the user role. Logged out option makes this item visible to site visitors only.', 'creatus'),
		'vertical' => true,
		'choices' => _thz_get_user_roles_list(true,true),
	),

);