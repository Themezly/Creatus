<?php
if (!defined('FW'))
	die('Forbidden');
$options = array(
	'ev_sw' => array(
		'label' => __('Event layout', 'creatus'),
		'desc' => esc_html__('Select event layout. See help for more info.', 'creatus'),
		'help' => esc_html__('If Stacked meta is selected, event meta is displayed under the meta sharing links in grid layout where details, organizer and venue with map are in 100% width column stacked on top of each other, otherwise event meta is displayed in a right sidebar.', 'creatus'),
		'type' => 'short-select',
		'value' => 'thz-col-1-3',
		'attr' => array(
			'class' => 'thz-select-switch'
		),
		'choices' => array(
			'thz-col-1' => array(
				'text' => esc_html__('Stacked meta', 'creatus'),
				'attr' => array(
					'data-enable' => 'eagenda_mx,emeta_mx',
					'data-disable' => 'ev_smx',
				)
			),
			'thz-col-1-2' => array(
				'text' => esc_html__('Meta Sidebar 50% width', 'creatus'),
				'attr' => array(
					'data-enable' => 'ev_smx',
					'data-disable' => 'eagenda_mx,emeta_mx',
				)
			),
			'thz-col-1-3' => array(
				'text' => esc_html__('Meta Sidebar 33% width', 'creatus'),
				'attr' => array(
					'data-enable' => 'ev_smx',
					'data-disable' => 'eagenda_mx,emeta_mx',
				)
			),
			'thz-col-1-4' => array(
				'text' => esc_html__('Meta Sidebar 20% width', 'creatus'),
				'attr' => array(
					'data-enable' => 'ev_smx,',
					'data-disable' => 'eagenda_mx,emeta_mx',
				)
			),
		)
	),

	'ev_smx' => array(
		'type' => 'thz-multi-options',
		'label' => __('Sidebar metrics', 'creatus'),
		'desc' => __('Adjust event meta sidebar metrics.', 'creatus'),
		'value' => array(
			'w' => 60,
			's' => 'active',
		),
		'thz_options' => array(
			'w' => array(
				'type' => 'spinner',
				'title' => __('Sidebar space', 'creatus'),
				'addon' => 'px',
				'min' => 0,
				'max' => 300,
				'value' => 60
			),
			's' => array(
				'type' => 'select',
				'title' => __('Sticky sidebar', 'creatus'),
				'choices' => array(
					'active' => __('Active', 'creatus'),
					'inactive' => __('Inactive', 'creatus'),
				)
			),				

		)
	),

	'ev_bs' => array(
		'type' => 'thz-box-style',
		'label' => __('Event box style', 'creatus'),
		'preview' => true,
		'button-text' => esc_html__('Customize event box style', 'creatus'),
		'desc' => esc_html__('Adjust .thz-single-event box style', 'creatus'),
		'popup' => true,
		'disable' => array(
			'layout',
			'video',
		),
		'value' => array()
	),
	'ev_med_bs' => array(
		'type' => 'thz-box-style',
		'label' => __('Event media box style', 'creatus'),
		'preview' => true,
		'button-text' => esc_html__('Customize event media box style', 'creatus'),
		'desc' => esc_html__('Adjust .thz-event-media-container box style', 'creatus'),
		'popup' => true,
		'disable' => array(
			'video',
		),
		'value' => array(
			'margin' => array(
				'top' => 0,
				'right' => 'auto',
				'bottom' => 30,
				'left' => 'auto'
			)						
		)
	),

	'edetails_mx' => array(
		'type' => 'thz-multi-options',
		'label' => __('Details holder', 'creatus'),
		'desc' => esc_html__('Adjust .thz-event-details-holder. See help for more info.', 'creatus'),
		'help' => esc_html__('Event details holder holds, media, title and date, event content, event sharing links. If event layout is Meta sidebar it also holds event agenda and event meta. Note that the holder and max width settings are effective only if there is no active page sidebar.', 'creatus'),
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

	
	'emeta_mx' => array(
		'type' => 'thz-multi-options',
		'label' => __('Meta holder', 'creatus'),
		'desc' => esc_html__('Adjust .thz-event-meta-holder. See help for more info.', 'creatus'),
		'help' => esc_html__('Note that the holder and max width settings are effective only if there is no active page sidebar.', 'creatus'),
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
		
	'eagenda_mx' => array(
		'type' => 'thz-multi-options',
		'label' => __('Agenda holder', 'creatus'),
		'desc' => esc_html__('Adjust .thz-event-agenda-holder. See help for more info.', 'creatus'),
		'help' => esc_html__('Note that the holder and max width settings are effective only if there is no active page sidebar.', 'creatus'),
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
	
	'erel_mx' => array(
		'type' => 'thz-multi-options',
		'label' => __('Related events', 'creatus'),
		'desc' => esc_html__('Adjust related events visibility and holder. See help for more info.', 'creatus'),
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
							'data-enable' => '.erel-hol-mx-parent,.thz-related-events-li'
						)
					),
					'hide' => array(
						'text' => esc_html__('Hide', 'creatus'),
						'attr' => array(
							'data-disable' => '.erel-hol-mx-parent,.thz-related-events-li'
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
					'class' => 'erel-hol-mx'
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
					'class' => 'erel-hol-mx'
				)
			),
			'm' => array(
				'type' => 'select',
				'title' => esc_html__('Max width', 'creatus'),
				'choices' => _thz_max_width_list(),
				'attr' => array(
					'class' => 'erel-hol-mx'
				)
			)
		)
	),
	'ecom_mx' => array(
		'type' => 'thz-multi-options',
		'label' => __('Event comments', 'creatus'),
		'desc' => esc_html__('Adjust event comments visibility and holder. See help for more info.', 'creatus'),
		'help' => esc_html__('Note that the holder and max width settings are effective only if there is no active page sidebar or location is outside.', 'creatus'),
		'value' => array(
			'v' => 'hide',
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
							'data-enable' => '.ecom-hol-mx-parent'
						)
					),
					'hide' => array(
						'text' => esc_html__('Hide', 'creatus'),
						'attr' => array(
							'data-disable' => '.ecom-hol-mx-parent'
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
					'class' => 'ecom-hol-mx'
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
					'class' => 'ecom-hol-mx'
				)
			),
			'm' => array(
				'type' => 'select',
				'title' => esc_html__('Max width', 'creatus'),
				'choices' => _thz_max_width_list(),
				'attr' => array(
					'class' => 'ecom-hol-mx'
				)
			)
		)
	),
	'enav_mx' => array(
		'type' => 'thz-multi-options',
		'label' => __('Events navigation', 'creatus'),
		'desc' => esc_html__('Adjust events navigation ( next/previous ) visibility and holder. See help for more info.', 'creatus'),
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
							'data-enable' => '.enav-hol-mx-parent'
						)
					),
					'hide' => array(
						'text' => esc_html__('Hide', 'creatus'),
						'attr' => array(
							'data-disable' => '.enav-hol-mx-parent'
						)
					)
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
					'class' => 'enav-hol-mx'
				)
			),
			'm' => array(
				'type' => 'select',
				'title' => esc_html__('Max width', 'creatus'),
				'choices' => _thz_max_width_list(),
				'attr' => array(
					'class' => 'enav-hol-mx'

				)
			)
		)
	)	
);