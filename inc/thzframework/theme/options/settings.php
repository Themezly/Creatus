<?php if ( ! defined( 'FW' ) ) die( 'Forbidden' );


$options = array(
	'sitetab' => array(
		'title'   => __( 'Site', 'creatus' ),
		'type'    => 'thz-side-tab',
		'lazy_tabs'=> false,
		'li-attr' => array('class' => 'thz-admin-li thz-admin-li-site'),
		'options' => array(
			'site_subbox' => array(
				'title'   => __( 'Site options', 'creatus' ),
				'type'    => 'box',
				'options' => array(
					fw()->theme->get_options( 'site/settings')
				),
			),
		),
	),
	'headertab' => array(
		'title'   => __( 'Header', 'creatus' ),
		'type'    => 'thz-side-tab',
		'lazy_tabs'=> false,
		'li-attr' => array('class' => 'thz-admin-li thz-admin-li-header'),
		'options' => array(
			'header_subbox' => array(
				'title'   => __( 'Header options', 'creatus' ),
				'type'    => 'box',
				'options' => array(
					fw()->theme->get_options( 'header/settings' ),
				),
			),
		),
	),
	'logotab' => array(
		'title'   => __( 'Logo', 'creatus' ),
		'type'    => 'thz-side-tab',
		'li-attr' => array('class' => 'thz-admin-li thz-admin-li-logo'),
		'options' => array(
			'logo_subbox' => array(
				'title'   => __( 'Logo options', 'creatus' ),
				'type'    => 'box',
				'options' => array(
					fw()->theme->get_options( 'logo_settings' ),
				),
			),
		),
	),
	'mainmenutab' => array(
		'title'   => __( 'Main menu', 'creatus' ),
		'type'    => 'thz-side-tab',
		'lazy_tabs'=> false,
		'li-attr' => array('class' => 'thz-admin-li thz-admin-li-menu'),
		'options' => array(
			'mainmenu_subbox' => array(
				'title'   => __( 'Main menu options', 'creatus' ),
				'type'    => 'box',
				'options' => array(
					fw()->theme->get_options( 'mainmenu/settings')
				),
			),
		),
	),	
	'herostab' => array(
		'title'   => __( 'Hero sections', 'creatus' ),
		'type'    => 'thz-side-tab',
		'li-attr' => array('class' => 'thz-admin-li thz-admin-li-heros'),
		'options' => array(
			'heros_subbox' => array(
				'title'   => __( 'Hero sections options', 'creatus' ),
				'type'    => 'box',
				'options' => array(
					fw()->theme->get_options( 'heros/settings' ),
				),
			),
		),
	),	
	'pagetitletab' => array(
		'title'   => __( 'Page title', 'creatus' ),
		'type'    => 'thz-side-tab',
		'li-attr' => array('class' => 'thz-admin-li thz-admin-li-pagetitle'),
		'options' => array(
			'pagetitle_subbox' => array(
				'title'   => __( 'Page title section options', 'creatus' ),
				'type'    => 'box',
				'options' => array(
					fw()->theme->get_options( 'pagetitle/settings',array('nosubtitle' => true))	
				),
			),
		),
	),	
	'poststab' => array(
		'title'   => __( 'Posts', 'creatus' ),
		'type'    => 'thz-side-tab',
		'li-attr' => array('class' => 'thz-admin-li thz-admin-li-posts'),
		'options' => array(
			'posts_subbox' => array(
				'title'   => __( 'Posts options', 'creatus' ),
				'type'    => 'box',
				'options' => array(
					fw()->theme->get_options( 'posts_settings' ),
				),
			),
		),
	),
	'footertab' => array(
		'title'   => __( 'Footer', 'creatus' ),
		'type'    => 'thz-side-tab',
		'li-attr' => array('class' => 'thz-admin-li thz-admin-li-footer'),
		'options' => array(
			'footer_subbox' => array(
				'title'   => __( 'Footer options', 'creatus' ),
				'type'    => 'box',
				'options' => array(
					fw()->theme->get_options( 'footer_settings' ),
				),
			),
		),
	),
	'pagetemplatestab' => array(
		'title'   => __( 'Page templates', 'creatus' ),
		'type'    => 'thz-side-tab',
		'li-attr' => array('class' => 'thz-admin-li thz-admin-li-pagetemplates'),
		'options' => array(
			'pagetemplates_subbox' => array(
				'title'   => __( 'Page templates options', 'creatus' ),
				'type'    => 'box',
				'options' => array(
					fw()->theme->get_options( 'pagetemplates/settings' ),
				),
			),
		),
	),
	'widgetsgeneratortab' => array(
		'title'   => __( 'Widgets generator', 'creatus' ),
		'type'    => 'thz-side-tab',
		'li-attr' => array('class' => 'thz-admin-li thz-admin-li-widgets'),
		'options' => array(
			'widgets_subbox' => array(
				'title'   => __( 'Widgets area sections generator', 'creatus' ),
				'type'    => 'box',
				'options' => array(
					fw()->theme->get_options( 'widgetsgenerator' ),
				),
			),
		),
	),	
	'socialstab' => array(
		'title'   => __( 'Socials', 'creatus' ),
		'type'    => 'thz-side-tab',
		'li-attr' => array('class' => 'thz-admin-li thz-admin-li-socials'),
		'options' => array(
			'socials_subbox' => array(
				'title'   => __( 'Socials links options', 'creatus' ),
				'type'    => 'box',
				'options' => array(
					fw()->theme->get_options( 'socials/settings' ),
				),
			),
		),
	),
	'woocommercetab' => array(
		'title' => __('WooCommerce', 'creatus'),
		'type' => 'thz-side-tab',
		'li-attr' => array('class' => 'thz-admin-li thz-admin-li-woo'),
		'options' => array(
			'woocommerce_subbox' => array(
				'title' => esc_html__('WooCommerce options', 'creatus'),
				'type' => 'box',
				'options' => fw()->theme->get_options('woo/settings')
			)
		)
	),
	'bbbuddytab' => array(
		'title'   => __( 'bb & Budy Press', 'creatus' ),
		'type'    => 'thz-side-tab',
		'li-attr' => array('class' => 'thz-admin-li thz-admin-li-bbpress'),
		'options' => array(
			'bbpress_subbox' => array(
				'title'   => __( 'bbPress & BuddyPress options', 'creatus' ),
				'type'    => 'box',
				'options' => fw()->theme->get_options('bb/settings'),
			),
		),
	),
	'customcsstab' => array(
		'title'   => __( 'Custom CSS', 'creatus' ),
		'type'    => 'thz-side-tab',
		'li-attr' => array('class' => 'thz-admin-li thz-admin-li-customcss'),
		'options' => array(
			'customcss_subbox' => array(
				'title'   => __( 'Custom CSS options', 'creatus' ),
				'type'    => 'box',
				'options' => array(
					fw()->theme->get_options( 'custom_css_settings' ),
				),
			),
		),
	),		
	'codetab' => array(
		'title'   => __( 'Code', 'creatus' ),
		'type'    => 'thz-side-tab',
		'li-attr' => array('class' => 'thz-admin-li thz-admin-li-code'),
		'options' => array(
			'code_subbox' => array(
				'title'   => __( 'Code options', 'creatus' ),
				'type'    => 'box',
				'options' => array(
					fw()->theme->get_options( 'code_settings' ),
				),
			),
		),
	),
	'additionaltab' => array(
		'title'   => __( 'Additional', 'creatus' ),
		'type'    => 'thz-side-tab',
		'li-attr' => array('class' => 'thz-admin-li thz-admin-li-additional'),
		'options' => array(
			'additional_subbox' => array(
				'title'   => __( 'Additional options', 'creatus' ),
				'type'    => 'box',
				'options' => array(
					fw()->theme->get_options( 'additional/settings' ),
				),
			),
		),
	),	
	'advanced' => array(
		'title'   => __( 'Advanced', 'creatus' ),
		'type'    => 'thz-side-tab',
		'li-attr' => array('class' => 'thz-admin-li thz-admin-li-advanced'),
		'options' => array(
			'advanced_subbox' => array(
				'title'   => __( 'Advanced options', 'creatus' ),
				'type'    => 'box',
				'options' => array(
					fw()->theme->get_options( 'advanced/settings' ),
				),
			),
		),
	),
	'exportimport' => array(
		'title'   => __( 'Export/import', 'creatus' ),
		'type'    => 'thz-side-tab',
		'li-attr' => array('class' => 'thz-admin-li thz-admin-li-exportimport'),
		'options' => array(
			'exportimport_subbox' => array(
				'title'   => __( 'Export/Import Theme Settings', 'creatus' ),
				'type'    => 'box',
				'options' => array(
					'presets' => array(
						'label' => false,
						'type' => 'thz-export-import',
						'value' => 'starter',
						'fw-storage' => array(
							'type' => 'wp-option',
							'wp-option' => 'thz_default_preset',
						),
					),
				),
			),
		),
	),
);

if ( !class_exists( 'WooCommerce' ) ) {
	unset($options['woocommercetab']);
}

if ( !class_exists( 'bbPress' ) && !class_exists( 'BuddyPress' ) ) {
	unset($options['bbbuddytab']);
}

$special_settings = fw()->theme->get_options( 'special_settings' );

if( $special_settings ){
	
	$options['special_settings'] = array(
		'title'   => __( 'Special', 'creatus' ),
		'type'    => 'thz-side-tab',
		'li-attr' => array('class' => 'thz-admin-li thz-admin-li-special'),
		'options' => array(
			'advanced_subbox' => array(
				'title'   => __( 'Special options', 'creatus' ),
				'type'    => 'box',
				'options' => $special_settings,
			),
		),
	);	
	
}