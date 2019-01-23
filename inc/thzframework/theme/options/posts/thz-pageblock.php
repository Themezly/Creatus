<?php
if (!defined('FW')) {
	die('Forbidden');
}
global $post;

$post_id = isset($post->ID) ? $post->ID : false;

$options = array(
	'postcssbox' => array(
		'type' => 'box',
		'options' => array(
			'pcss' => array(
				'type' => 'addable-popup',
				'value' => array(),
				'label' => false,
				'desc'  => esc_html__('Add CSS for this post', 'creatus'),
				'template' => esc_html__('Post CSS is active','creatus'),
				'popup-title' => esc_html__('Post CSS', 'creatus'),
				'size' => 'large', 
				'limit' => 1,
				'attr' => array(
					'class' => 'custom_options_popup'
				),
				'add-button-text' => esc_html__('Click to add post CSS', 'creatus'),
				'sortable' => false,
				'popup-options' => array(
					'css' => array(
						'type' => 'thz-ace',
						'label' => __('Post CSS', 'creatus'),
						'desc' => esc_html__('Insert your CSS code in the field below. Do not use any HTML tags. This CSS is loaded last after all CSS files and gives you the option to override every theme CSS property. If you need to override certain CSS selector add #thz-wrapper before selector to avoid the use of !important rule.', 'creatus'),
						'value'=>'',
						'mode'=>'css',
						'theme'=>'chrome',
						'height'=>450
					),
				),
			),
		

		),
		'title' => esc_html__('Post CSS', 'creatus'),
		'context' => 'side',
		'priority' => 'low',
	),
	
	'options_box' => array(
		'type' => 'box',
		'title'   => __( 'Creatus options', 'creatus' ),
		'options' => array(

			'docs' => array(
				'type' => 'thz-html',
				'label' => false,
				'html' => '<h3>For more details and positions map please visit <a href="https://themezly.com/docs/page-blocks/" target="_blank">Page blocks documentation page</a>.<h3>'
			),
		
			'position' => array(
				'type'  => 'select',
				'value' => 'unassigned',
				'label' => __('Block Position', 'creatus'),
				'desc'  => esc_html__('Select page block position.', 'creatus'),
				'fw-storage' => array(
					'type' => 'wp-option',
					'wp-option' => 'thz_page_blocks_positions',
					'key' => $post_id
				),
				'choices' => thz_pageblocks_positions_list(),
			),

			'assignment' => array(
				'type'  => 'select',
				'value' => 'all',
				'label' => __('Block Assignment', 'creatus'),
				'desc'  => esc_html__('Select page block assignment. Not effective if "Assign to" option is empty. ', 'creatus'),
				'attr' => array(
					'class' => 'thz-select-switch'
				),
				'choices' => array(
					'all' =>array(
						'text' => esc_html__('On all pages', 'creatus'),
						'attr' => array(
							'data-disable' => 'assignto,unassignfrom',
						)
					),
					'show' =>array(
						'text' =>  esc_html__('Show only on assigned pages', 'creatus'),
						'attr' => array(
							'data-enable' => 'assignto,unassignfrom',
						)
					),
					'hide' =>array(
						'text' => esc_html__('Hide on assigned pages', 'creatus'),
						'attr' => array(
							'data-enable' => 'assignto,unassignfrom',
						)
					),
				),
			),	
			
			'assignto' => array(
				'type' => 'thz-assign-to',
				'value' => array(),
				'label' => __('Assign to', 'creatus'),
				'desc' => esc_html__('Assign this page block to specific page. Select from the list or start typing to load specific pages. If empty page block is visible on all pages.', 'creatus')
			),
			
			'unassignfrom' => array(
				'type' => 'thz-assign-to',
				'value' => array(),
				'label' => __('Unassign from', 'creatus'),
				'desc' => esc_html__('Unassign this page block from specific page. Select from the list or start typing to load specific pages. See help for more info.', 'creatus'),
				'help' => esc_html__('This options works in conjunction with Assign to. Example; if Block assignment is Show and you assign this block to all single posts and unassign from specific single post, the block is not visible on that specific post. If however the Block assignment is Hide than the block is visible only on specific single post and hidden from all other single posts.', 'creatus')
			),

			'visibility' => array(
				'type'  => 'select',
				'value' => 'everyone',
				'label' => __('Block visibility', 'creatus'),
				'desc'  => esc_html__('Select user roles that can see this page block', 'creatus'),
				'attr' => array(
					'class' => 'thz-select-switch'
				),
				'choices' => array(
					'everyone' =>array(
						'text' => esc_html__('Everyone', 'creatus'),
						'attr' => array(
							'data-disable' => 'visibleto',
						)
					),
					'custom' =>array(
						'text' => esc_html__('Custom', 'creatus'),
						'attr' => array(
							'data-enable' => 'visibleto',
						)
					),

				),
			),
		
			'visibleto' => array(
				'type'  => 'checkboxes',
				'value' => array(),
				'label' => __('Visible to', 'creatus'),
				'desc'  => esc_html__('If unchecked everyone can still see this page block. See help for more info.', 'creatus'),
				'help' => esc_html__('If you select Logged in than all users that are logged in will see this block. For more restrictive visibility do not use Logged in but rather select the user role. Logged out option makes this block visible to site visitors only.', 'creatus'),
				'vertical' => true,
				'choices' => _thz_get_user_roles_list(true,true),
			),		
		)
	),
);

