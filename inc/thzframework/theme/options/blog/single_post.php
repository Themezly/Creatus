<?php
if (!defined('FW'))
	die('Forbidden');

$nafixedgroup   = 'nfstyle,nfcolors,nfthumb';
$navlinksgroup  = 'nrbs,nhbs,btnel_mx,btnthbs,btnm,btnc,btnf,btnptf';

$nav_location_choices = array(
	'fixed' => array(
		'text' => esc_html__('Fixed ( centered arrows on side of the page )', 'creatus'),
		'attr' => array(
			'data-enable' => $nafixedgroup,
			'data-disable' => $navlinksgroup
		)
	),
	'under_footer' => array(
		'text' => esc_html__('Under the post footer ( inside the post )', 'creatus'),
		'attr' => array(
			'data-enable' => $navlinksgroup,
			'data-disable' => $nafixedgroup
		)
	),
	'above_related' => array(
		'text' => esc_html__('Above the related ( inside the post )', 'creatus'),
		'attr' => array(
			'data-enable' => $navlinksgroup,
			'data-disable' => $nafixedgroup
		)
	),	
	'under_related' => array(
		'text' => esc_html__('Under the related ( inside the post )', 'creatus'),
		'attr' => array(
			'data-enable' => $navlinksgroup,
			'data-disable' => $nafixedgroup
		)
	),			
	'inside' => array(
		'text' => esc_html__('Under the comments ( outside the post )', 'creatus'),
		'attr' => array(
			'data-enable' => $navlinksgroup,
			'data-disable' => $nafixedgroup
		)
	),
	'outside' => array(
		'text' => esc_html__('Above the footer section ( outside the main )', 'creatus'),
		'attr' => array(
			'data-enable' => $navlinksgroup,
			'data-disable' => $nafixedgroup
		)
	)
);

$options = array(
	'post_box_style' => array(
		'type' => 'thz-box-style',
		'label' => __('Post box style', 'creatus'),
		'preview' => true,
		'button-text' => esc_html__('Customize post box style', 'creatus'),
		'desc' => esc_html__('Adjust .thz-single-post box style', 'creatus'),
		'popup' => true,
		'disable' => array(
			'layout',
			'video',
			'transform',
			'boxsize'
		),
		'value' => array(),
		'units' => array(
			'borderradius',
			'padding',
			'margin',
		),
	),
	'pdetails_mx' => array(
		'type' => 'thz-multi-options',
		'label' => __('Details holder', 'creatus'),
		'desc' => esc_html__('Adjust .thz-post-details-holder. See help for more info.', 'creatus'),
		'help' => esc_html__('Post details holder holds, title, post meta and post content. Note that the holder and max width settings are effective only if there is no active page sidebar. The media container (.thz-post-media) has been deliberately moved out of the containment area. If you wish to contain the media adjust Post media box style option located in Media tab.', 'creatus'),
		'value' => array(
			'h' => 'contained',
			'm' => 100
		),
		'thz_options' => array(
			'h' => array(
				'type' => 'short-select',
				'title' => __('Holder', 'creatus'),
				'choices' => array(
					'contained' => __('Contained', 'creatus'),
					'notcontained' => __('Not contained', 'creatus')
				)
			),
			'm' => array(
				'type' => 'select',
				'title' => esc_html__('Max width', 'creatus'),
				'choices' => _thz_max_width_list()
			)
		)
	),
	'brel_mx' => array(
		'type' => 'thz-multi-options',
		'label' => __('Related posts', 'creatus'),
		'desc' => esc_html__('Adjust related posts visibility and holder. See help for more info.', 'creatus'),
		'help' => esc_html__('Note that the holder and max width settings are effective only if there is no active page sidebar or location is outside.', 'creatus'),
		'value' => array(
			'v' => 'show',
			'l' => 'inside',
			'h' => 'contained',
			'm' => 100
		),
		'thz_options' => array(
			'v' => array(
				'title' => esc_html__('Visibility', 'creatus'),
				'type' => 'short-select',
				'attr' => array(
					'class' => 'thz-select-switch'
				),
				'choices' => array(
					'show' => array(
						'text' => esc_html__('Show', 'creatus'),
						'attr' => array(
							'data-enable' => '.brel-hol-mx-parent,.thz-related-posts-li'
						)
					),
					'hide' => array(
						'text' => esc_html__('Hide', 'creatus'),
						'attr' => array(
							'data-disable' => '.brel-hol-mx-parent,.thz-related-posts-li'
						)
					)
				)
			),
			'l' => array(
				'type' => 'short-select',
				'title' => __('Location', 'creatus'),
				'choices' => array(
					'outside' => __('Outside ( above the footer )', 'creatus'),
					'inside' => __('Inside ( inside the article ) ', 'creatus')
				),
				'attr' => array(
					'class' => 'brel-hol-mx'
				)
			),
			'h' => array(
				'type' => 'short-select',
				'title' => __('Holder', 'creatus'),
				'choices' => array(
					'contained' => __('Contained', 'creatus'),
					'notcontained' => __('Not contained', 'creatus')
				),
				'attr' => array(
					'class' => 'brel-hol-mx'
				)
			),
			'm' => array(
				'type' => 'select',
				'title' => esc_html__('Max width', 'creatus'),
				'choices' => _thz_max_width_list(),
				'attr' => array(
					'class' => 'brel-hol-mx'
				)
			)
		)
	),
	'bcom_mx' => array(
		'type' => 'thz-multi-options',
		'label' => __('Post comments', 'creatus'),
		'desc' => esc_html__('Adjust post comments visibility and holder. See help for more info.', 'creatus'),
		'help' => esc_html__('Note that the holder and max width settings are effective only if there is no active page sidebar or location is outside.', 'creatus'),
		'value' => array(
			'v' => 'show',
			'l' => 'inside',
			'h' => 'contained',
			'm' => 100
		),
		'thz_options' => array(
			'v' => array(
				'title' => esc_html__('Visibility', 'creatus'),
				'type' => 'short-select',
				'attr' => array(
					'class' => 'thz-select-switch'
				),
				'choices' => array(
					'show' => array(
						'text' => esc_html__('Show', 'creatus'),
						'attr' => array(
							'data-enable' => '.bcom-hol-mx-parent'
						)
					),
					'hide' => array(
						'text' => esc_html__('Hide', 'creatus'),
						'attr' => array(
							'data-disable' => '.bcom-hol-mx-parent'
						)
					)
				)
			),
			'l' => array(
				'type' => 'short-select',
				'title' => __('Location', 'creatus'),
				'choices' => array(
					'outside' => __('Outside ( above the footer )', 'creatus'),
					'inside' => __('Inside ( inside the article ) ', 'creatus')
				),
				'attr' => array(
					'class' => 'bcom-hol-mx'
				)
			),
			'h' => array(
				'type' => 'short-select',
				'title' => __('Holder', 'creatus'),
				'choices' => array(
					'contained' => __('Contained', 'creatus'),
					'notcontained' => __('Not contained', 'creatus')
				),
				'attr' => array(
					'class' => 'bcom-hol-mx'
				)
			),
			'm' => array(
				'type' => 'select',
				'title' => esc_html__('Max width', 'creatus'),
				'choices' => _thz_max_width_list(),
				'attr' => array(
					'class' => 'bcom-hol-mx'
				)
			)
		)
	),
	'bnav_mx' => array(
		'type' => 'thz-multi-options',
		'label' => __('Posts navigation', 'creatus'),
		'desc' => esc_html__('Adjust posts navigation ( next/previous ) visibility and holder. See help for more info.', 'creatus'),
		'help' => esc_html__('Note that the holder and max width settings are effective only if there is no active page sidebar.', 'creatus'),
		'value' => array(
			'v' => 'show',
			'h' => 'contained',
			'm' => 100
		),
		'thz_options' => array(
			'v' => array(
				'title' => esc_html__('Visibility', 'creatus'),
				'type' => 'short-select',
				'attr' => array(
					'class' => 'thz-select-switch'
				),
				'choices' => array(
					'show' => array(
						'text' => esc_html__('Show', 'creatus'),
						'attr' => array(
							'data-enable' => '.bnav-hol-mx-parent',
							'data-disable' => 'cup_nav'
						)
					),
					'hide' => array(
						'text' => esc_html__('Hide', 'creatus'),
						'attr' => array(
							'data-disable' => '.bnav-hol-mx-parent,cup_nav'
						)
					),
					'custom' => array(
						'text' => esc_html__('Custom ( show and override default )', 'creatus'),
						'attr' => array(
							'data-enable' => '.bnav-hol-mx-parent,cup_nav'
						)
					),
				)
			),
			'h' => array(
				'type' => 'short-select',
				'title' => __('Holder', 'creatus'),
				'choices' => array(
					'contained' => __('Contained', 'creatus'),
					'notcontained' => __('Not contained', 'creatus')
				),
				'attr' => array(
					'class' => 'bnav-hol-mx'
				)
			),
			'm' => array(
				'type' => 'select',
				'title' => esc_html__('Max width', 'creatus'),
				'choices' => _thz_max_width_list(),
				'attr' => array(
					'class' => 'bnav-hol-mx'
				)
			)
		)
	),
	
	'cup_nav' => array(
		'type' => 'addable-popup',
		'value' => array(),
		'label' => __('Custom navigation', 'creatus'),
		'desc'  => esc_html__('Add custom navigation options for this post type.', 'creatus'),
		'template' => esc_html__('Custom navigation settings are active','creatus'),
		'popup-title' => null,
		'size' => 'large', 
		'limit' => 1,
		'add-button-text' => esc_html__('Add custom navigation options', 'creatus'),
		'sortable' => true,
		'popup-options' => array(
			fw()->theme->get_options('additional/navigation', array( 
				'nav_location_choices' => $nav_location_choices
			)),
		),
	),
	
	'ps_sep' => array(
		'type' => 'thz-multi-options',
		'label' => __('Elements separator', 'creatus'),
		'desc' => esc_html__('Select meta/footer elements separator. See help for more info.', 'creatus'),
		'help' => esc_html__('This option will let you adjust space between separator and elements. Nudge option can help you align the separator verticaly. This can come in handy if separator is icon and icon font does not place the icon in absolute vertical middle. Nudge moves relative top position of the separator.', 'creatus'),
		'value' => array(
			'ty' => 'textual',
			't' => '|',
			'i' => 'thzicon thzicon-primitive-dot',
			'fs' => '',
			's' => 5,
			'n' => 0
		),
		'thz_options' => array(
			'ty' => array(
				'title' => esc_html__('Type', 'creatus'),
				'type' => 'short-select',
				'value' => 'show',
				'attr' => array(
					'class' => 'thz-select-switch'
				),
				'choices' => array(
					'textual' => array(
						'text' => esc_html__('Textual', 'creatus'),
						'attr' => array(
							'data-enable' => '.postsingle_sep-text-parent',
							'data-disable' => '.postsingle_sep-icon-parent'
						)
					),
					'icon' => array(
						'text' => esc_html__('Icon', 'creatus'),
						'attr' => array(
							'data-enable' => '.postsingle_sep-icon-parent',
							'data-disable' => '.postsingle_sep-text-parent'
						)
					)
				)
			),
			't' => array(
				'type' => 'short-text',
				'title' => esc_html__('Separator', 'creatus'),
				'attr' => array(
					'class' => 'postsingle_sep-text'
				)
			),
			'i' => array(
				'type' => 'icon',
				'title' => esc_html__('Icon', 'creatus'),
				'attr' => array(
					'class' => 'postsingle_sep-icon'
				)
			),
			'fs' => array(
				'type' => 'spinner',
				'title' => esc_html__('Size', 'creatus'),
				'addon' => 'px',
				'min' => 0,
				'max' => 100
			),
			's' => array(
				'type' => 'spinner',
				'title' => esc_html__('Space', 'creatus'),
				'addon' => 'px',
				'max' => 100
			),
			'n' => array(
				'type' => 'spinner',
				'title' => esc_html__('Nudge', 'creatus'),
				'addon' => 'px',
				'min' => -20,
				'max' => 20
			)
		)
	)	
);