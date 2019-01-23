<?php if (!defined('FW')) die('Forbidden');

$widget_areas = FW_Shortcode_Widget_Area::get_sidebars();

$options = array(

	'columndefault' => array(
		'title' => __('Defaults', 'creatus'),
		'type' => 'tab',
		'options' => array(

			'link' => array(
				'label' => __('Column titles link', 'creatus'),
				'desc' => esc_html__('Remove title links. See help for more info.', 'creatus'),
				'help' => esc_html__('By default column titles are treated as normal link. Set to "Do not link" to disable links for  this column title.', 'creatus'),
				'type' => 'switch',
				'right-choice' => array(
					'value' => 'donotlink',
					'label' => __('Do not link', 'creatus')
				),
				'left-choice' => array(
					'value' => 'link',
					'label' => __('Link', 'creatus')
				),
				'value' => 'link'
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
	
	'columnlayout' => array(
		'title' => __('Layout', 'creatus'),
		'type' => 'tab',
		'options' => array(
			'bs' => array(
				'type' => 'thz-box-style',
				'label' => __('Column box style', 'creatus'),
				'desc' => esc_html__('Adjust .mega-menu-col box style','creatus'),
				'preview' => true,
				'button-text' => esc_html__('Customize column box style', 'creatus'),
				'popup' => true,
				'disable' => array('layout','margin','borders','borderradius','video','shape'),
				'units' => array(
					'borderradius',
					'boxsize',
					'padding',
					'margin',
				),
				'value' => array()
			),

			'mode' => array(
				'label'   => esc_html__( 'Display mode', 'creatus' ),
				'desc'  => esc_html__('Select column display mode. Note that widget area mode disables the link and title completely.', 'creatus'),
				'type'    => 'short-select',
				'attr' => array(
					'class' => 'thz-select-switch'
				),
				'value' =>'default',
				'choices' => array(
		
					'default' =>array(
						'text' =>  esc_html__('Default', 'creatus'),
						'attr' => array(
							'data-enable' => '',
							'data-disable' => 'thumb,tbs,widget,wo',
						)
					),
					'thumb' =>array(
						'text' =>  esc_html__('Thumbnail', 'creatus'),
						'attr' => array(
							'data-enable' => 'thumb,tbs',
							'data-disable' => 'widget,wo',
						)
					),
					'widget' =>array(
						'text' =>  esc_html__('Widget area', 'creatus'),
						'attr' => array(
							'data-enable' => 'widget,wo',
							'data-disable' => 'thumb,tbs',
						)
					),
				
				)
			),	
			
			'thumb' => array(
				'type'  => 'upload',
				'value' => array(),
				'label' => __('Thumbnail image', 'creatus'),
				'desc'  => esc_html__('Insert a thumbnail image for this column.', 'creatus'),
				'images_only' => true,
			),
		
			'widget' => array(
				'label'   => esc_html__( 'Widget area', 'creatus' ),
				'desc'  => esc_html__('Load widget area instead of a link', 'creatus'),
				'type'    => 'select',
				'value' =>'none',
				'choices' => $widget_areas
			),
			
		)
	),

);