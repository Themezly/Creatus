<?php if ( ! defined( 'FW' ) ) die( 'Forbidden' );

$options = array(
    'creatus_panel' => array(
        'title' => __('Theme Settings', 'creatus'),
        'options' => array(
			'customizer_site' => array(
				'type' => 'thz-customizer-popup',
				'value' => array(),
				'label' => false,
				'popup-title' => esc_html__('Site options','creatus'),
				'size' => 'large', 
				'attr' => array(
					'class' => 'customizer_options_popup'
				),
				'button' => esc_html__('Site', 'creatus'),
				'section' => 'customizer_site',
				'popup-options' => fw()->theme->get_options( 'site/settings'),
			),
			'customizer_header' => array(
				'type' => 'thz-customizer-popup',
				'value' => array(),
				'label' => false,
				'popup-title' => esc_html__('Header options','creatus'),
				'size' => 'large', 
				'attr' => array(
					'class' => 'customizer_options_popup'
				),
				'button' => esc_html__('Header', 'creatus'),
				'section' => 'customizer_header',
				'popup-options' => fw()->theme->get_options( 'header/settings'),
			),		 
			'customizer_logo' => array(
				'type' => 'thz-customizer-popup',
				'value' => array(),
				'label' => false,
				'popup-title' => esc_html__('Logo options','creatus'),
				'size' => 'large', 
				'attr' => array(
					'class' => 'customizer_options_popup'
				),
				'button' => esc_html__('Logo', 'creatus'),
				'section' => 'customizer_logo',
				'popup-options' => fw()->theme->get_options( 'logo_settings'),
			),
			'customizer_mainmenu' => array(
				'type' => 'thz-customizer-popup',
				'value' => array(),
				'label' => false,
				'popup-title' => esc_html__('Main menu options','creatus'),
				'size' => 'large', 
				'attr' => array(
					'class' => 'customizer_options_popup'
				),
				'button' => esc_html__('Main menu', 'creatus'),
				'section' => 'customizer_mainmenu',
				'popup-options' => fw()->theme->get_options( 'mainmenu/settings'),
			),
			'customizer_hero' => array(
				'type' => 'thz-customizer-popup',
				'value' => array(),
				'label' => false,
				'popup-title' => esc_html__('Hero sections options','creatus'),
				'size' => 'large', 
				'attr' => array(
					'class' => 'customizer_options_popup'
				),
				'button' => esc_html__('Hero sections', 'creatus'),
				'section' => 'customizer_hero',
				'popup-options' => fw()->theme->get_options( 'heros/settings' ),
			),
			'customizer_pagetitle' => array(
				'type' => 'thz-customizer-popup',
				'value' => array(),
				'label' => false,
				'popup-title' => esc_html__('Page title section options','creatus'),
				'size' => 'large', 
				'attr' => array(
					'class' => 'customizer_options_popup'
				),
				'button' => esc_html__('Page title', 'creatus'),
				'section' => 'customizer_pagetitle',
				'popup-options' => fw()->theme->get_options( 'pagetitle/settings',array('nosubtitle' => true)),
			),
			'customizer_blog' => array(
				'type' => 'thz-customizer-popup',
				'value' => array(),
				'label' => false,
				'popup-title' => esc_html__('Blog options','creatus'),
				'size' => 'large', 
				'attr' => array(
					'class' => 'customizer_options_popup'
				),
				'button' => esc_html__('Blog', 'creatus'),
				'section' => 'customizer_blog',
				'popup-options' => array(
				
					'general' => array(
						'title' => __('General', 'creatus'),
						'type' => 'tab',
						'options' => array(
						  fw()->theme->get_options('blog/general'),
						  fw()->theme->get_options('blog/posts_style'),
						  fw()->theme->get_options('blog/archives')
						)
					),
					'formats' => array(
						'title' => __('Post formats', 'creatus'),
						'type' => 'tab',
						'options' => array(
							fw()->theme->get_options('blog/formats')
						)
					),
					'single' => array(
						'title' => __('Single post', 'creatus'),
						'type' => 'tab',
						'options' => array(
							fw()->theme->get_options('blog/single')
						)
					),

				)
			),
			'customizer_portfolio' => array(
				'type' => 'thz-customizer-popup',
				'value' => array(),
				'label' => false,
				'popup-title' => esc_html__('Portfolio options','creatus'),
				'size' => 'large', 
				'attr' => array(
					'class' => 'customizer_options_popup'
				),
				'button' => esc_html__('Portfolio', 'creatus'),
				'section' => 'customizer_portfolio',
				'popup-options' => array(
					'general' => array(
						'title' => __('General', 'creatus'),
						'type' => 'tab',
						'options' => array(
						  fw()->theme->get_options('portfolio/general'),
						  fw()->theme->get_options('portfolio/projects_style'),
						)
					),
					'single' => array(
						'title' => __('Single project', 'creatus'),
						'type' => 'tab',
						'options' => array(
							fw()->theme->get_options('portfolio/single')
						)
					),

				)
			),
			'customizer_events' => array(
				'type' => 'thz-customizer-popup',
				'value' => array(),
				'label' => false,
				'popup-title' => esc_html__('Events options','creatus'),
				'size' => 'large', 
				'attr' => array(
					'class' => 'customizer_options_popup'
				),
				'button' => esc_html__('Events', 'creatus'),
				'section' => 'customizer_events',
				'popup-options' => array(
					'general' => array(
						'title' => __('General', 'creatus'),
						'type' => 'tab',
						'options' => array(
						  fw()->theme->get_options('events/general'),
						)
					),
					'single' => array(
						'title' => __('Single event', 'creatus'),
						'type' => 'tab',
						'options' => array(
							fw()->theme->get_options('events/single')
						)
					),

				)
			),
			'customizer_footer' => array(
				'type' => 'thz-customizer-popup',
				'value' => array(),
				'label' => false,
				'popup-title' => esc_html__('Footer options','creatus'),
				'size' => 'large', 
				'attr' => array(
					'class' => 'customizer_options_popup'
				),
				'button' => esc_html__('Footer', 'creatus'),
				'section' => 'customizer_footer',
				'popup-options' => fw()->theme->get_options( 'footer_settings' ),
			),
			'customizer_searchpage' => array(
				'type' => 'thz-customizer-popup',
				'value' => array(),
				'label' => false,
				'popup-title' => esc_html__('Search page options','creatus'),
				'size' => 'large', 
				'attr' => array(
					'class' => 'customizer_options_popup'
				),
				'button' => esc_html__('Search page', 'creatus'),
				'section' => 'customizer_searchpage',
				'popup-options' => fw()->theme->get_options( 'pagetemplates/search' ),
			),
			'customizer_404page' => array(
				'type' => 'thz-customizer-popup',
				'value' => array(),
				'label' => false,
				'popup-title' => esc_html__('404 page options','creatus'),
				'size' => 'large', 
				'attr' => array(
					'class' => 'customizer_options_popup'
				),
				'button' => esc_html__('404 page', 'creatus'),
				'section' => 'customizer_404page',
				'popup-options' => fw()->theme->get_options( 'pagetemplates/404' ),
			),
			'customizer_authorpage' => array(
				'type' => 'thz-customizer-popup',
				'value' => array(),
				'label' => false,
				'popup-title' => esc_html__('Author page options','creatus'),
				'size' => 'large', 
				'attr' => array(
					'class' => 'customizer_options_popup'
				),
				'button' => esc_html__('Author page', 'creatus'),
				'section' => 'customizer_authorpage',
				'popup-options' => fw()->theme->get_options( 'pagetemplates/author' ),
			),
			'customizer_socials' => array(
				'type' => 'thz-customizer-popup',
				'value' => array(),
				'label' => false,
				'popup-title' => esc_html__('Social links options','creatus'),
				'size' => 'large', 
				'attr' => array(
					'class' => 'customizer_options_popup'
				),
				'button' => esc_html__('Socials', 'creatus'),
				'section' => 'customizer_socials',
				'popup-options' => fw()->theme->get_options( 'socials/settings' ),
			),
			'customizer_woo' => array(
				'type' => 'thz-customizer-popup',
				'value' => array(),
				'label' => false,
				'template' => esc_html__('WooCommerce','creatus'),
				'popup-title' => esc_html__('WooCommerce options','creatus'),
				'size' => 'large', 
				'attr' => array(
					'class' => 'customizer_options_popup'
				),
				'button' => esc_html__('WooCommerce', 'creatus'),
				'section' => 'customizer_woo',
				'popup-options' => fw()->theme->get_options('woo/settings')
			),
			'customizer_bb' =>  array(
				'type' => 'thz-customizer-popup',
				'value' => array(),
				'label' => false,
				'popup-title' => __('bbPress & BuddyPress options','creatus'),
				'size' => 'large', 
				'attr' => array(
					'class' => 'customizer_options_popup'
				),
				'button' => esc_html__('bb & Budy Press', 'creatus'),
				'section' => 'customizer_bb',
				'popup-options' => fw()->theme->get_options( 'bb/settings' )
			),
			'customizer_css' => array(
				'type' => 'thz-customizer-popup',
				'value' => array(),
				'label' => false,
				'popup-title' => esc_html__('Custom CSS options','creatus'),
				'size' => 'large', 
				'attr' => array(
					'class' => 'customizer_options_popup'
				),
				'button' => esc_html__('Custom CSS', 'creatus'),
				'section' => 'customizer_css',
				'popup-options' => fw()->theme->get_options( 'custom_css_settings' ),
			),
			'customizer_code' => array(
				'type' => 'thz-customizer-popup',
				'value' => array(),
				'label' => false,
				'popup-title' => esc_html__('Code options','creatus'),
				'size' => 'large', 
				'attr' => array(
					'class' => 'customizer_options_popup'
				),
				'button' => esc_html__('Code', 'creatus'),
				'section' => 'customizer_code',
				'popup-options' => fw()->theme->get_options( 'code_settings' ),
			),
			'customizer_additional' => array(
				'type' => 'thz-customizer-popup',
				'value' => array(),
				'label' => false,
				'popup-title' => esc_html__('Additional options','creatus'),
				'size' => 'large', 
				'attr' => array(
					'class' => 'customizer_options_popup'
				),
				'button' => esc_html__('Additional', 'creatus'),
				'section' => 'customizer_additional',
				'popup-options' => fw()->theme->get_options( 'additional/settings' ),
			),
			'customizer_advanced' => array(
				'type' => 'thz-customizer-popup',
				'value' => array(),
				'label' => false,
				'popup-title' => esc_html__('Advanced options','creatus'),
				'size' => 'large', 
				'attr' => array(
					'class' => 'customizer_options_popup'
				),
				'button' => esc_html__('Advanced', 'creatus'),
				'section' => 'customizer_advanced',
				'popup-options' => fw()->theme->get_options( 'advanced/settings', array('forcustomzier' => true ) ),
			),
        ),
		
		'wp-customizer-args' => array(
			'priority' => 1,
		),
    )
);


if ( !class_exists( 'WooCommerce' ) ) {
	
	unset($options['creatus_panel']['options']['customizer_woo']);
}

if ( !class_exists( 'bbPress' ) && !class_exists( 'BuddyPress' ) ) {
	
	unset($options['creatus_panel']['options']['customizer_bb']);
}

if ( !fw_ext( 'portfolio' ) ) {
	
	unset($options['creatus_panel']['options']['customizer_portfolio']);
}

if ( !fw_ext( 'events' ) ) {
	
	unset($options['creatus_panel']['options']['customizer_events']);
}