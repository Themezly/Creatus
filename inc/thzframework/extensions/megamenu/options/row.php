<?php if (!defined('FW')) die('Forbidden');

$options = array(

	'rowoptions' => array(
		'title' => __('Defaults', 'creatus'),
		'type' => 'tab',
		'options' => array(
			'mega_bs' => array(
				'type' => 'thz-box-style',
				'label' => __('Row box style', 'creatus'),
				'desc' => esc_html__('Adjust .mega-menu-row box style','creatus'),
				'preview' => true,
				'button-text' => esc_html__('Customize row box style', 'creatus'),
				'popup' => true,
				'disable' => array('layout','margin','borders','borderradius','boxsize','video','shape'),
				'units' => array(
					'borderradius',
					'boxsize',
					'padding',
					'margin',
				),
				'value' => array()
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
			
		)
	),
	
	'rowwidgetsoptions' => array(
		'title' => __('Widgets options', 'creatus'),
		'type' => 'tab',
		'options' => array(
			'wo' => array(
				'type' => 'addable-popup',
				'value' => array(),
				'label' => __('Widgets options', 'creatus'),
				'desc'  => esc_html__('Add widget options for this row or leave as is for theme defaults.', 'creatus'),
				'template' => esc_html__('Widget options are active','creatus'),
				'popup-title' => null,
				'size' => 'large', 
				'limit' => 1,
				'add-button-text' => esc_html__('Add widget options', 'creatus'),
				'sortable' => false,
				'popup-options' => array(
					fw()->theme->get_options( 'widgets_settings')
				),
			),	
		)
	),
	
	'rowthumbs' => array(
		'title' => __('Thumbnail options', 'creatus'),
		'type' => 'tab',
		'options' => array(
			'tbs' => array(
				'type' => 'thz-box-style',
				'label' => __('Thumbnail holder box style', 'creatus'),
				'preview' => true,
				'button-text' => esc_html__('Customize thumbnail holder box style', 'creatus'),
				'desc' => esc_html__('Adjust a.itemlink.has-thumbnail box style', 'creatus'),
				'popup' => true,
				'disable' => array('video'),
				'units' => array(
					'borderradius',
					'boxsize',
					'padding',
					'margin',
				),
				'value' => array(),
			),
		)
	),	
);