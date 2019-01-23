<?php
if (!defined('FW'))
	die('Forbidden');
	
$options = array(

	'tm_contained' => array(
		'type' => 'multi-picker',
		'label' => false,
		'desc' => false,
		'picker' => array(
			'picked' => array(
				'label' => __('Top menu holder contained?', 'creatus'),
				'type' => 'switch',
				'right-choice' => array(
					'value' => 'contained',
					'label' => __('Contained', 'creatus')
				),
				'left-choice' => array(
					'value' => 'notcontained',
					'label' => __('Not contained', 'creatus')
				),
				'value' => 'contained',
				'desc' => esc_html__('If set to contained div#mainmenu_holder will be contained by max site width.', 'creatus')
			)
		),
		'choices' => array(
			'notcontained' => array(
				'nav_contained' => array(
					'label' => __('Top menu nav contained?', 'creatus'),
					'desc' => esc_html__('If set to contained nav#thz-nav will be contained by max site width', 'creatus'),
					'type' => 'switch',
					'right-choice' => array(
						'value' => 'contained',
						'label' => __('Contained', 'creatus')
					),
					'left-choice' => array(
						'value' => 'notcontained',
						'label' => __('Not contained', 'creatus')
					),
					'value' => 'contained'
				)
			)
		)
	),
	
	'tm_boxstyle' => array(
		'type' => 'thz-box-style',
		'label' => __('Mainmenu box style', 'creatus'),
		'desc' => esc_html__('Adjust #mainmenu_holder box style', 'creatus'),
		'button-text' => esc_html__('Customize menu holder box style', 'creatus'),
		'popup' => true,
		'attr' => array(
			'data-tminputid' => 'tm_boxstyle',
			'data-changing' => 'padding,margin,border,border-radius,box-shadow,background,background-color'
		),
		'disable' => array(
			'layout',
			'boxsize',
			'video',
			'transform'
		),
		'value' => array()
	),
	
	'tm_nav_bs' => array(
		'type' => 'thz-box-style',
		'label' => __('Mainmenu nav box style', 'creatus'),
		'preview' => true,
		'button-text' => esc_html__('Customize menu nav box style', 'creatus'),
		'desc' => esc_html__('Adjust #thz-nav box tyle', 'creatus'),
		'popup' => true,
		'disable' => array('video','transform','layout','boxsize'),
		'value' => array()
	),
	
	'fsm_bs' => array(
		'type' => 'thz-box-style',
		'label' => __('First secondary menu box style', 'creatus'),
		'preview' => true,
		'button-text' => esc_html__('Customize secondary menu box style', 'creatus'),
		'desc' => esc_html__('Adjust .thz-secondary-menu:first-child box style. See help for more info.', 'creatus'),
		'help' => esc_html__('In some header menu layouts you have 2 secondary menu containers. This option styles the secondary menu located before the main menu ( .thz-secondary-menu:first-child ).', 'creatus'),
		'popup' => true,
		'disable' => array('video','transform','layout','boxsize'),
		'value' => array()
	),
	
	'lsm_bs' => array(
		'type' => 'thz-box-style',
		'label' => __('Last secondary menu box style', 'creatus'),
		'preview' => true,
		'button-text' => esc_html__('Customize secondary menu box style', 'creatus'),
		'desc' => esc_html__('Adjust .thz-secondary-menu:last-child box style. See help for more info.', 'creatus'),
		'help' => esc_html__('In some header menu layouts you have 2 secondary menu containers. This option styles the secondary menu located after the main menu ( .thz-secondary-menu:last-child ).', 'creatus'),
		'popup' => true,
		'disable' => array('video','transform','layout','boxsize'),
		'value' => array()
	),

);
