<?php
if (!defined('FW')) {
	die('Forbidden');
}
$options = array(

	'custom_post_options' => array(
		'type' => 'addable-popup',
		'value' => array(),
		'label' => __('Custom event options', 'creatus'),
		'desc'  => esc_html__('Add custom  event options for this page or leave as is for theme defaults.', 'creatus'),
		'template' => esc_html__('Custom event options for this page','creatus'),
		'popup-title' => null,
		'size' => 'large', 
		'limit' => 1,
		'attr' => array(
			'class' => 'custom_options_popup'
		),
		'add-button-text' => esc_html__('Add custom event options', 'creatus'),
		'sortable' => false,
		'popup-options' => array(
			fw()->theme->get_options('posts/event_custom_options')
		),
	),
					
	'featured_img' => array(
		'label' => __('Featured image', 'creatus'),
		'desc' => esc_html__('Show/hide featured image', 'creatus'),
		'type' => 'short-select',
		'value' => 'show',
		'attr' => array(
			'class' => 'thz-select-switch'
		),
		'choices' => array(
			'show' => array(
				'text' => esc_html__('Show', 'creatus'),
				'attr' => array(
					'data-enable' => 'media_height',
				)
			),
			'hide' => array(
				'text' => esc_html__('Hide', 'creatus'),
				'attr' => array(
					'data-disable' => 'media_height',
				)
			),
		)
	),
	'media_height' => array(
		'type' => 'multi-picker',
		'label' => false,
		'desc' => false,
		'picker' => array(
			'picked' => array(
				'label' => __('Featured image height', 'creatus'),
				'desc' => esc_html__('Set featured image height.', 'creatus'),
				'type' => 'select',
				'value' => 'thz-ratio-16-9',
				'choices' => array(
					array( // optgroup
						'attr' => array(
							'label' => __('Square', 'creatus')
						),
						'choices' => array(
							'thz-ratio-1-1' => esc_html__('Aspect ratio 1:1', 'creatus')
						)
					),
					array( // optgroup
						'attr' => array(
							'label' => __('Landscape', 'creatus')
						),
						'choices' => array(
							'thz-ratio-2-1' => esc_html__('Aspect ratio 2:1', 'creatus'),
							'thz-ratio-3-2' => esc_html__('Aspect ratio 3:2', 'creatus'),
							'thz-ratio-4-3' => esc_html__('Aspect ratio 4:3', 'creatus'),
							'thz-ratio-16-9' => esc_html__('Aspect ratio 16:9', 'creatus'),
							'thz-ratio-21-9' => esc_html__('Aspect ratio 21:9', 'creatus')
						)
					),
					array( // optgroup
						'attr' => array(
							'label' => __('Portrait', 'creatus')
						),
						'choices' => array(
							'thz-ratio-1-2' => esc_html__('Aspect ratio 1:2', 'creatus'),
							'thz-ratio-3-4' => esc_html__('Aspect ratio 3:4', 'creatus'),
							'thz-ratio-2-3' => esc_html__('Aspect ratio 2:3', 'creatus'),
							'thz-ratio-9-16' => esc_html__('Aspect ratio 9:16', 'creatus')
						)
					),
					'custom' => esc_html__('Custom', 'creatus')
				)
			)
		),
		'choices' => array(
			'custom' => array(
				'height' => array(
					'type' => 'thz-spinner',
					'addon' => 'px',
					'min' => 0,
					'max' => 1000,
					'label' => '',
					'value' => 650,
					'desc' => esc_html__('Set custom featured image height.', 'creatus')
				)
			)
		)
	),
	'general-event' => array(
		'type' => 'thz-event',
		'label' => false,
		'desc' => false
	),
	'ev_organizer' => array(
		'type' => 'multi-picker',
		'label' => false,
		'desc' => false,
		'picker' => array(
			'picked' => array(
				'label' => __('Organizer name', 'creatus'),
				'desc' => esc_html__('Select custom or specific user', 'creatus'),
				'type' => 'switch',
				'right-choice' => array(
					'value' => 'c',
					'label' => __('Custom', 'creatus')
				),
				'left-choice' => array(
					'value' => 's',
					'label' => __('Select user', 'creatus')
				),
				'value' => 'c'
			)
		),
		'choices' => array(
			'c' => array(
				'user' => array(
					'label' => '',
					'type' => 'text',
					'value' => '',
					'desc' => esc_html__('Insert organizer name', 'creatus')
				),
			),
			's' => array(
				'user' => array(
					'type' => 'multi-select',
					'value' => array(),
					'label' => '',
					'desc' => esc_html__('Start typing username than click to select.', 'creatus'),
					'population' => 'users',
					'prepopulate' => false,
					'limit' => 1
				),
				'display' => array(
					'label' => __('Display name', 'creatus'),
					'desc' => esc_html__('Choose how to display organizer name', 'creatus'),
					'type' => 'switch',
					'right-choice' => array(
						'value' => 'user_nicename',
						'label' => __('Username', 'creatus')
					),
					'left-choice' => array(
						'value' => 'display_name',
						'label' => __('Display name', 'creatus')
					),
					'value' => 'display_name'
				)
			)
		)
	),
	'ev_odetails' => array(
		'label' => __('Organizer details', 'creatus'),
		'type' => 'thz-multi-options',
		'value' => array(
			'p' => '',
			'e' => '',
			'w' => '',
		),
		'thz_options' => array(
			'p' => array(
				'type' => 'text',
				'title' => esc_html__('Phone', 'creatus'),
			),
			'e' => array(
				'type' => 'text',
				'title' => esc_html__('Email', 'creatus'),
			),
			'w' => array(
				'type' => 'text',
				'title' => esc_html__('Website', 'creatus'),
			),

		),
		'desc' => esc_html__('Insert organizer details', 'creatus')
	),	
	
	'ev_vdetails' => array(
		'label' => __('Venue details', 'creatus'),
		'type' => 'thz-multi-options',
		'value' => array(
			'p' => '',
			'e' => '',
			'w' => '',
		),
		'thz_options' => array(
			'p' => array(
				'type' => 'text',
				'title' => esc_html__('Phone', 'creatus'),
			),
			'e' => array(
				'type' => 'text',
				'title' => esc_html__('Email', 'creatus'),
			),
			'w' => array(
				'type' => 'text',
				'title' => esc_html__('Website', 'creatus'),
			),

		),
		'desc' => esc_html__('Insert venue details', 'creatus')
	),
	
	'ev_price' => array(
		'type' => 'thz-multi-options',
		'label' => __('Event price', 'creatus'),
		'desc' => esc_html__('Add event price and or link to ticket purchase', 'creatus'),
		'value' => array(
			'c' => '',
			's' => '',
			'sl' => '',
			'l' => '',
		),
		'thz_options' => array(
			'c' => array(
				'type' => 'short-text',
				'title' => esc_html__('Cost', 'creatus'),
			),
			's' => array(
				'type' => 'short-text',
				'title' => esc_html__('Currency symbol', 'creatus'),
			),
			'sl' => array(
				'type' => 'short-select',
				'title' => esc_html__('Symbol location', 'creatus'),
				'choices' => array(
				
					'b' => esc_html__('Before price', 'creatus'),
					'a' => esc_html__('After price', 'creatus')
				
				)

			),
			'l' => array(
				'type' => 'text',
				'title' => esc_html__('Purchase link', 'creatus'),
			),

		)
	),	
	
	'ev_agenda' => array(
		'type' => 'addable-popup',
		'value' => array(),
		'label' => __('Agenda', 'creatus'),
		'desc' => esc_html__('Add agenda items', 'creatus'),
		'template' => '{{- title}} - {{- time}}',
		'popup-title' => esc_html__('Agenda details', 'creatus'),
		'size' => 'large',
		'add-button-text' => esc_html__('Add agenda item', 'creatus'),
		'sortable' => true,
		'popup-options' => array(
			'time' => array(
				'type' => 'datetime-picker',
				'value' => '',
				'label' => __('Time', 'creatus'),
				'desc' => esc_html__('Agenda item time. This option uses WordPress default Time Format setting', 'creatus'),
				'datetime-picker' => array(
					'format' => get_option('time_format','g:i a'),
					'maxDate' => false, 
					'minDate' => false, 
					'timepicker' => true, 
					'datepicker' => false, 
					'defaultTime' => '08:00' 
				)
			),
			'title' => array(
				'label' => __('Title', 'creatus'),
				'type' => 'text',
				'value' => '',
				'desc' => esc_html__('Add agenda title', 'creatus')
			),
			'text' => array(
				'label' => __('Text', 'creatus'),
				'type' => 'wp-editor',
				'tinymce' => true,
				'size' => 'large',
				'reinit' => true,
				'wpautop' => false,
				'editor_height' => 100,
				'editor_type' => 'html',
				'value' => '',
				'desc' => esc_html__('Add agenda text', 'creatus')
			)
		)
	)
);