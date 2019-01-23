<?php if ( ! defined( 'FW' ) ) die( 'Forbidden' );

$options = array(
    'site_panel' => array(
        'title' => __('Site', 'creatus'),
        'options' =>  fw()->theme->get_options( 'site/settings'),
		'wp-customizer-args' => array(
			'priority' => 1,
		),
    ),
    'header_panel' => array(
        'title' => __('Header', 'creatus'),
        'options' => fw()->theme->get_options( 'header/settings'),
		'wp-customizer-args' => array(
			'priority' => 2,
		),
    ),
    'logo_panel' => array(
        'title' => __('Logo', 'creatus'),
        'options' =>  fw()->theme->get_options( 'logo_settings'),
		'wp-customizer-args' => array(
			'priority' => 3,
		),
    ),
    'mainmenu_panel' => array(
        'title' => __('Main Menu', 'creatus'),
        'options' => array(
			'mainmenu_general' => array(
				'title' => __('General', 'creatus'),
				'options' => fw()->theme->get_options( 'mainmenu/general')
			),
			'mainmenu_containerstoplevel' => array(
				'title' => __('Top level containers', 'creatus'),
				'options' => fw()->theme->get_options( 'mainmenu/containers_top_level')
			),
			'mainmenu_containerssublevel' => array(
				'title' => __('Sub level containers', 'creatus'),
				'options' => fw()->theme->get_options( 'mainmenu/containers_sub_level')
			),
			'mainmenu_containersmega' => array(
				'title' => __('Mega menu containers', 'creatus'),
				'options' => fw()->theme->get_options( 'mainmenu/containers_mega')
			),
			'mainmenu_linkslayout' => array(
				'title' => __('Links layout', 'creatus'),
				'options' => fw()->theme->get_options( 'mainmenu/links_layout')
			),
			'mainmenu_colorslink' => array(
				'title' => __('Link style', 'creatus'),
				'options' => fw()->theme->get_options( 'mainmenu/link_style')
			),
			'mainmenu_colorshovered' => array(
				'title' => __('Hovered style', 'creatus'),
				'options' => fw()->theme->get_options( 'mainmenu/hovered_style')
			),
			'mainmenu_colorsactive' => array(
				'title' => __('Active style', 'creatus'),
				'options' => fw()->theme->get_options( 'mainmenu/active_style')
			),
			'mainmenu_mobile' => array(
				'title' => __('Mobile', 'creatus'),
				'options' => fw()->theme->get_options( 'mainmenu/mobile')
			)
        ),
		'wp-customizer-args' => array(
			'priority' => 4,
		),
    ),
    'hero_panel' => array(
        'title' => __('Hero Sections', 'creatus'),
        'options' => array(
           fw()->theme->get_options( 'heros/settings')
        ),
		'wp-customizer-args' => array(
			'priority' => 5,
		),
    ),
    'pagetitle_panel' => array(
        'title' => __('Page title', 'creatus'),
        'options' => fw()->theme->get_options( 'pagetitle/settings',array('nosubtitle' => true)),
		'wp-customizer-args' => array(
			'priority' => 6,
		),
    ),
	'blog_panel' => array(
		'title' => __('Blog', 'creatus'),
		'options' => array(
			'blog_general' => array(
				'title' => __('General', 'creatus'),
				'options' => array(
				  fw()->theme->get_options('blog/general'),
				  fw()->theme->get_options('blog/posts_style'),
				  fw()->theme->get_options('blog/archives')
				),
				'wp-customizer-args' => array(
					'active_callback' => 'thz_customizer_is_posts_archive',
				),
			),
			'blog_post_formats' => array(
				'title' => __('Post formats', 'creatus'),
				'options' => array(
				  fw()->theme->get_options('blog/audio_format'),
				  fw()->theme->get_options('blog/quote_format'),
				  fw()->theme->get_options('blog/link_format')
				),
			),
			'blog_single' => array(
				'title' => __('Single Post', 'creatus'),
				'options' => fw()->theme->get_options('blog/single_post'),
				'wp-customizer-args' => array(
					'active_callback' => 'thz_customizer_single_post',
				),
			),
			'blog_single_media' => array(
				'title' => __('Single Media', 'creatus'),
				'options' => fw()->theme->get_options('blog/single_media'),
				'wp-customizer-args' => array(
					'active_callback' => 'thz_customizer_single_post',
				),
			),
			'blog_single_title' => array(
				'title' => __('Single Title', 'creatus'),
				'options' => fw()->theme->get_options('blog/single_title'),
				'wp-customizer-args' => array(
					'active_callback' => 'thz_customizer_single_post',
				),
			),
			'blog_single_meta' => array(
				'title' => __('Single Meta', 'creatus'),
				'options' => fw()->theme->get_options('blog/single_meta'),
				'wp-customizer-args' => array(
					'active_callback' => 'thz_customizer_single_post',
				),
			),
			'blog_single_content' => array(
				'title' => __('Single Content', 'creatus'),
				'options' => fw()->theme->get_options('blog/single_content'),
				'wp-customizer-args' => array(
					'active_callback' => 'thz_customizer_single_post',
				),
			),
			'blog_single_footer' => array(
				'title' => __('Single Footer', 'creatus'),
				'options' => fw()->theme->get_options('blog/single_footer'),
				'wp-customizer-args' => array(
					'active_callback' => 'thz_customizer_single_post',
				),
			),
			'blog_single_tags' => array(
				'title'   => __( 'Single Tags', 'creatus' ),
				'options' => fw()->theme->get_options('blog/single_tags'),
				'wp-customizer-args' => array(
					'active_callback' => 'thz_customizer_single_post',
				),
			),			
			'blog_single_sharing' => array(
				'title' => __('Single Sharing Links', 'creatus'),
				'options' => thz_theme()->get_options('blog/single_sharing_links'),
				'wp-customizer-args' => array(
					'active_callback' => 'thz_customizer_single_post',
				),
			),
			'blog_single_author' => array(
				'title' => __('Single Author', 'creatus'),
				'options' => fw()->theme->get_options('blog/single_author'),
				'wp-customizer-args' => array(
					'active_callback' => 'thz_customizer_single_post',
				),
			),	
			'blog_related' => array(
				'title' => __('Single Related', 'creatus'),
				'options' => fw()->theme->get_options('blog/related_general'),
				'wp-customizer-args' => array(
					'active_callback' => 'thz_customizer_single_post',
				),
			),
			'blog_related_media' => array(
				'title' => __('Single Related Media', 'creatus'),
				'options' => fw()->theme->get_options('blog/related_media'),
				'wp-customizer-args' => array(
					'active_callback' => 'thz_customizer_single_post',
				),
			),
			'blog_related_title' => array(
				'title' => __('Single Related Title', 'creatus'),
				'options' => fw()->theme->get_options('blog/related_title'),
				'wp-customizer-args' => array(
					'active_callback' => 'thz_customizer_single_post',
				),
			),
			'blog_related_intro' => array(
				'title' => __('Single Related Intro text', 'creatus'),
				'options' => fw()->theme->get_options('blog/related_intro'),
				'wp-customizer-args' => array(
					'active_callback' => 'thz_customizer_single_post',
				),
			)
		),
		'wp-customizer-args' => array(
			'priority' => 7,
			'active_callback' => 'thz_is_post',
		),
	),	
	'portfolio_panel' => array(
		'title' => __('Portfolio', 'creatus'),
		'options' => array(
			'portfolio_general' => array(
				'title' => __('General', 'creatus'),
				'options' => array(
				  fw()->theme->get_options('portfolio/general'),
				  fw()->theme->get_options('portfolio/projects_style'),
				),
				'wp-customizer-args' => array(
					'active_callback' => 'thz_customizer_is_portfolio_archive',
				),
			),
			'portfolio_single' => array(
				'title' => __('Single Project', 'creatus'),
				'options' => fw()->theme->get_options('portfolio/single_project'),
				'wp-customizer-args' => array(
					'active_callback' => 'thz_customizer_single_project',
				),
			),
			'portfolio_single_media' => array(
				'title' => __('Single Media', 'creatus'),
				'options' => fw()->theme->get_options('portfolio/single_media'),
				'wp-customizer-args' => array(
					'active_callback' => 'thz_customizer_single_project',
				),
			),
			'portfolio_single_title' => array(
				'title' => __('Single Title', 'creatus'),
				'options' => fw()->theme->get_options('portfolio/single_title'),
				'wp-customizer-args' => array(
					'active_callback' => 'thz_customizer_single_project',
				),
			),
			'portfolio_single_meta' => array(
				'title' => __('Single Meta', 'creatus'),
				'options' => fw()->theme->get_options('portfolio/single_meta'),
				'wp-customizer-args' => array(
					'active_callback' => 'thz_customizer_single_project',
				),
			),
			'portfolio_single_content' => array(
				'title' => __('Single Content', 'creatus'),
				'options' => fw()->theme->get_options('portfolio/single_content'),
				'wp-customizer-args' => array(
					'active_callback' => 'thz_customizer_single_project',
				),
			),
			'portfolio_single_sharing' => array(
				'title' => __('Single Sharing Links', 'creatus'),
				'options' => thz_theme()->get_options('portfolio/single_sharing_links'),
				'wp-customizer-args' => array(
					'active_callback' => 'thz_customizer_single_project',
				),
			),
			'portfolio_related' => array(
				'title' => __('Single Related', 'creatus'),
				'options' => fw()->theme->get_options('portfolio/related_general'),
				'wp-customizer-args' => array(
					'active_callback' => 'thz_customizer_single_project',
				),
			),
			'portfolio_related_media' => array(
				'title' => __('Single Related Media', 'creatus'),
				'options' => fw()->theme->get_options('portfolio/related_media'),
				'wp-customizer-args' => array(
					'active_callback' => 'thz_customizer_single_project',
				),
			),
			'portfolio_related_title' => array(
				'title' => __('Single Related Title', 'creatus'),
				'options' => fw()->theme->get_options('portfolio/related_title'),
				'wp-customizer-args' => array(
					'active_callback' => 'thz_customizer_single_project',
				),
			),
			'portfolio_related_intro' => array(
				'title' => __('Single Related Intro text', 'creatus'),
				'options' => fw()->theme->get_options('portfolio/related_intro'),
				'wp-customizer-args' => array(
					'active_callback' => 'thz_customizer_single_project',
				),
			)
		),
		'wp-customizer-args' => array(
			'priority' => 8,
			'active_callback' => 'thz_customizer_is_portfolio',
		),
	),
	'events_panel' => array(
		'title' => __('Events', 'creatus'),
		'options' => array(
			'events_general' => array(
				'title' => __('General', 'creatus'),
				'options' => array(
				  fw()->theme->get_options('events/general'),
				),
				'wp-customizer-args' => array(
					'active_callback' => 'thz_customizer_is_event_archive',
				),
			),
			'events_single' => array(
				'title' => __('Single Event', 'creatus'),
				'options' => fw()->theme->get_options('events/single_event'),
				'wp-customizer-args' => array(
					'active_callback' => 'thz_customizer_single_event',
				),
			),
			'events_single_title_date' => array(
				'title' => __('Titles & date', 'creatus'),
				'options' => fw()->theme->get_options('events/single_title_and_date'),
				'wp-customizer-args' => array(
					'active_callback' => 'thz_customizer_single_event',
				),
			),
			'events_single_content' => array(
				'title' => __('Single Content', 'creatus'),
				'options' => fw()->theme->get_options('events/single_content'),
				'wp-customizer-args' => array(
					'active_callback' => 'thz_customizer_single_event',
				),
			),
			'events_single_sharing' => array(
				'title' => __('Single Sharing Links', 'creatus'),
				'options' => thz_theme()->get_options('events/single_sharing_links'),
				'wp-customizer-args' => array(
					'active_callback' => 'thz_customizer_single_event',
				),
			),
			'events_single_meta' => array(
				'title' => __('Single Meta', 'creatus'),
				'options' => fw()->theme->get_options('events/single_meta'),
				'wp-customizer-args' => array(
					'active_callback' => 'thz_customizer_single_event',
				),
			),
			'events_related' => array(
				'title' => __('Single Related', 'creatus'),
				'options' => fw()->theme->get_options('events/related_general'),
				'wp-customizer-args' => array(
					'active_callback' => 'thz_customizer_single_event',
				),
			),
			'events_related_media' => array(
				'title' => __('Single Related Media', 'creatus'),
				'options' => fw()->theme->get_options('events/related_media'),
				'wp-customizer-args' => array(
					'active_callback' => 'thz_customizer_single_event',
				),
			),
			'events_related_title' => array(
				'title' => __('Single Related Title', 'creatus'),
				'options' => fw()->theme->get_options('events/related_title'),
				'wp-customizer-args' => array(
					'active_callback' => 'thz_customizer_single_event',
				),
			),
			'events_related_intro' => array(
				'title' => __('Single Related Intro text', 'creatus'),
				'options' => fw()->theme->get_options('events/related_intro'),
				'wp-customizer-args' => array(
					'active_callback' => 'thz_customizer_single_event',
				),
			)
		),
		'wp-customizer-args' => array(
			'priority' => 8,
			'active_callback' => 'thz_customizer_is_event',
		),
	),
    'footer_panel' => array(
        'title' => __('Footer', 'creatus'),
        'options' => fw()->theme->get_options( 'footer_settings'),
		'wp-customizer-args' => array(
			'priority' => 10,
		),
    ),
    'pagetemplates_panel' => array(
        'title' => __('Page Templates', 'creatus'),
        'options' => fw()->theme->get_options( 'pagetemplates/settings'),
		'wp-customizer-args' => array(
			'priority' => 11,
		),
    ),
    'socials_panel' => array(
        'title' => __('Socials', 'creatus'),
        'options' => fw()->theme->get_options( 'socials/settings'),
		'wp-customizer-args' => array(
			'priority' => 12,
		),
    ),
    'woo_panel' => array(
        'title' => __('WooCommerce', 'creatus'),
        'options' => array(
			'woo_shop' => array(
				'title' => __('Shop', 'creatus'),
				'options' => fw()->theme->get_options('woo/shop'),
				'wp-customizer-args' => array(
					'active_callback' => 'thz_customizer_is_woo_archive',
				),
			),
			'woo_single' => array(
				'title' => __('Single Product', 'creatus'),
				'options' => fw()->theme->get_options('woo/single_product'),
				'wp-customizer-args' => array(
					'active_callback' => 'thz_customizer_single_product',
				),
			),
			'woo_single_elements' => array(
				'title'   => __( 'Single Elements', 'creatus' ),
				'options' => fw()->theme->get_options('woo/single_elements'),
				'wp-customizer-args' => array(
					'active_callback' => 'thz_customizer_single_product',
				),
			),	
			'woo_single_image' => array(
				'title' => __('Single Image', 'creatus'),
				'options' => fw()->theme->get_options('woo/single_image'),
				'wp-customizer-args' => array(
					'active_callback' => 'thz_customizer_single_product',
				),
			),
			'woo_single_meta' => array(
				'title' => __('Single Meta', 'creatus'),
				'options' => fw()->theme->get_options('woo/single_meta'),
				'wp-customizer-args' => array(
					'active_callback' => 'thz_customizer_single_product',
				),
			),
			'woo_single_tabs' => array(
				'title' => __('Single Tabs', 'creatus'),
				'options' => fw()->theme->get_options('woo/single_tabs'),
				'wp-customizer-args' => array(
					'active_callback' => 'thz_customizer_single_product',
				),
			),
			'woo_single_related' => array(
				'title' => __('Single Related', 'creatus'),
				'options' => fw()->theme->get_options('woo/single_related'),
				'wp-customizer-args' => array(
					'active_callback' => 'thz_customizer_single_product',
				),
			),
			'woo_single_upsell' => array(
				'title' => __('Single Up sells', 'creatus'),
				'type' => 'tab',
				'options' => fw()->theme->get_options('woo/single_upsell'),
				'wp-customizer-args' => array(
					'active_callback' => 'thz_customizer_single_product',
				),
			),
			'woo_single_sharing' => array(
				'title' => __('Single Sharing Links', 'creatus'),
				'options' => thz_theme()->get_options('woo/single_sharing_links'),
				'wp-customizer-args' => array(
					'active_callback' => 'thz_customizer_single_product',
				),
			),
			'woo_miscellaneous' => array(
				'title' => __('Miscellaneous', 'creatus'),
				'options' => fw()->theme->get_options('woo/miscellaneous')
			),
        ),
		'wp-customizer-args' => array(
			'priority' => 13,
			'active_callback' => 'thz_customizer_is_woo',
		),
    ),
    'bb_panel' => array(
        'title' => __('bbPress & BuddyPress', 'creatus'),
        'options' => fw()->theme->get_options( 'bb/settings' ),
		'wp-customizer-args' => array(
			'priority' => 14,
		),
    ),
    'css_panel' => array(
        'title' => __('Custom CSS', 'creatus'),
        'options' => fw()->theme->get_options( 'custom_css_settings',array('forcustomizer' => true)),
		'wp-customizer-args' => array(
			'priority' => 15,
		),
    ),
    'code_panel' => array(
        'title' => __('Code', 'creatus'),
        'options' => fw()->theme->get_options( 'code_settings'),
		'wp-customizer-args' => array(
			'priority' => 16,
		),
    ),
    'additional_panel' => array(
        'title' => __('Additional', 'creatus'),
        'options' => array(
			'additional_overlay' => array(
				'title' => __('Media overlay', 'creatus'),
				'options' => array(
					fw()->theme->get_options('additional/overlay'),
					fw()->theme->get_options('additional/custom_overlay'),
				)
			),
			'additional_lightbox' => array(
				'title' => __('Lightbox', 'creatus'),
				'options' => fw()->theme->get_options('additional/lightbox')
			),
			'additional_pagination' => array(
				'title'   => __( 'Pagination', 'creatus' ),
				'options' => fw()->theme->get_options('additional/pagination')
			),
			'additional_navigation' => array(
				'title'   => __( 'Navigation', 'creatus' ),
				'options' => fw()->theme->get_options('additional/navigation')
			),
			thz_theme()->get_options( 'site_offline_tab' ),
			'additional_miscellaneous' => array(
				'title'   => __( 'Miscellaneous', 'creatus' ),
				'options' => fw()->theme->get_options( 'additional/miscellaneous' )
			),			
			
        ),
		'wp-customizer-args' => array(
			'priority' => 17,
		),
	),
    'advanced_panel' => array(
        'title' => __('Advanced', 'creatus'),
        'options' => fw()->theme->get_options( 'advanced/settings', array('forcustomzier' => true ) ),
		'wp-customizer-args' => array(
			'priority' => 18,
		),
    ),	

);


if ( !class_exists( 'WooCommerce' ) ) {
	
	unset($options['woo_panel']);
}

if ( !class_exists( 'bbPress' ) && !class_exists( 'BuddyPress' ) ) {
	
	unset($options['bb_panel']);
}

if ( !fw_ext( 'portfolio' ) ) {
	
	unset($options['portfolio_panel']);
}

if ( !fw_ext( 'events' ) ) {
	
	unset($options['events_panel']);
}