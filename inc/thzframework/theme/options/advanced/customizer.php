<?php if ( ! defined( 'FW' ) ) die( 'Forbidden' );

$options = array(
	'customizer_mode' => array(
		'type' => 'multi-picker',
		'label' => false,
		'desc' => false,
		'picker' => array(
			'picked' => array(
				'label' => __('Customizer mode', 'creatus'),
				'desc' => esc_html__('Set default customizer theme options mode. See help for more info', 'creatus'),
				'help' => esc_html__('If mode is popups, every theme options set you see in theme panel will be opened in a customizer popup and preview is visible once the popup is saved and closed. The popup setting will also speed up the first page load when entering the customizer.', 'creatus'),
				'type' => 'switch',
				'right-choice' => array(
					'value' => 'accordions',
					'label' => __('Accordions', 'creatus')
				),
				'left-choice' => array(
					'value' => 'popups',
					'label' => __('Popups', 'creatus')
				),
				'value' => 'accordions',
			)
		),
		'fw-storage' => array(
			'type' => 'wp-option',
			'wp-option' => 'thz_customizer_mode',
		),
		'choices' => array(
			'accordions' => array(
				'panels' => array(
					'type'  => 'checkboxes',
					'value' => array(
						'site' => true,
						'header' => true,
						'logo' => true,
						'mainmenu' => true,
						'pagetitle' => true,
						'blog' => true,
						'footer' => true,
					),
					'label' => __('Accordion panels', 'creatus'),
					'desc'  => esc_html__('Activate/deactivate specific customizer accordion panels', 'creatus'),
					'vertical' => true,
					'choices' =>array(
						'site' => __('Site', 'creatus'),
						'header' => __('Header', 'creatus'),
						'logo' => __('Logo', 'creatus'),
						'mainmenu' => __('Menu', 'creatus'),
						'hero' => __('Hero sections', 'creatus'),
						'pagetitle' => __('Page title', 'creatus'),
						'blog' => __('Blog', 'creatus'),
						'portfolio' => __('Portfolio', 'creatus'),
						'events' => __('Events', 'creatus'),
						'footer' => __('Footer', 'creatus'),
						'pagetemplates' => __('Page Templates', 'creatus'),
						'socials' => __('Socials', 'creatus'),
						'woo' => __('WooCommerce', 'creatus'),
						'bb' => __('bb & Budy Press', 'creatus'),
						'css' => __('Custom CSS', 'creatus'),
						'code' => __('Code', 'creatus'),
						'additional' => __('Additional', 'creatus'),
						'advanced' => __('Advanced', 'creatus'),
					),
				),						
			),
			'popups' => array(
				'panels' => array(
					'type'  => 'checkboxes',
					'value' => array(
						'site' => true,
						'header' => true,
						'logo' => true,
						'mainmenu' => true,
						'pagetitle' => true,
						'blog' => true,
						'footer' => true,
					),
					'label' => __('Popup panels', 'creatus'),
					'desc'  => esc_html__('Activate/deactivate specific customizer popup panels', 'creatus'),
					'vertical' => true,
					'choices' =>array(
						'site' => __('Site', 'creatus'),
						'header' => __('Header', 'creatus'),
						'logo' => __('Logo', 'creatus'),
						'mainmenu' => __('Menu', 'creatus'),
						'hero' => __('Hero sections', 'creatus'),
						'pagetitle' => __('Page title', 'creatus'),
						'blog' => __('Blog', 'creatus'),
						'portfolio' => __('Portfolio', 'creatus'),
						'events' => __('Events', 'creatus'),
						'footer' => __('Footer', 'creatus'),
						'searchpage' => __('Search page', 'creatus'),
						'404page' => __('404 page', 'creatus'),
						'authorpage' => __('Author page', 'creatus'),
						'socials' => __('Socials', 'creatus'),
						'woo' => __('WooCommerce', 'creatus'),
						'bb' => __('bb & Budy Press', 'creatus'),
						'css' => __('Custom CSS', 'creatus'),
						'code' => __('Code', 'creatus'),
						'additional' => __('Additional', 'creatus'),
						'advanced' => __('Advanced', 'creatus'),
					),
				),						
			),
		)			
	),
	'customizer_oon' => array(
		'label' => __('Options override notice', 'creatus'),
		'desc' => esc_html__('Activate/deactivate theme options override notice. See help for more info', 'creatus'),
		'help' => esc_html__('While working in customizer some pages might have theme options override. This option enables the notice advising you that some of the live preview options will not be affected by customizer option value change.', 'creatus'),
		'type' => 'switch',
		'right-choice' => array(
			'value' => 'inactive',
			'label' => __('Inactive', 'creatus')
		),
		'left-choice' => array(
			'value' => 'active',
			'label' => __('Active', 'creatus')
		),
		'value' => 'active',
	)
);


if ( !class_exists( 'WooCommerce' ) ) {
	
	unset(
		$options['customizer_mode']['choices']['accordions']['panels']['choices']['woo'],
		$options['customizer_mode']['choices']['popups']['panels']['choices']['woo']
	);
}

if ( !class_exists( 'bbPress' ) && !class_exists( 'BuddyPress' ) ) {
	
	unset(
		$options['customizer_mode']['choices']['accordions']['panels']['choices']['bb'],
		$options['customizer_mode']['choices']['popups']['panels']['choices']['bb']
	);
}

if ( !fw_ext( 'portfolio' ) ) {
	
	unset(
		$options['customizer_mode']['choices']['accordions']['panels']['choices']['portfolio'],
		$options['customizer_mode']['choices']['popups']['panels']['choices']['portfolio']
	);
}

if ( !fw_ext( 'events' ) ) {
	
	unset(
		$options['customizer_mode']['choices']['accordions']['panels']['choices']['events'],
		$options['customizer_mode']['choices']['popups']['panels']['choices']['events']
	);
}