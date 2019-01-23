<?php if ( ! defined( 'FW' ) ) die( 'Forbidden' );

$options = array(
	'lightbox_style' => array(
		'label' => __('Backdrop Style', 'creatus'),
		'desc' => esc_html__('Select backdrop ( popup background ) style', 'creatus'),
		'type' => 'select',
		'value' => 'mfp-dark',
		'choices' => array(
			'mfp-light' => esc_html__('Light', 'creatus'),
			'mfp-dark' => esc_html__('Dark', 'creatus')
		)
	),
	'lightbox_opacity' => array(
		'label' => __('Backdrop Opacity', 'creatus'),
		'desc' => esc_html__('Set backdrop ( popup background ) opacity', 'creatus'),
		'type' => 'select',
		'value' => 'mfp-opacity-08',
		'choices' => array(
			'mfp-opacity-0' => esc_html__('Invisible', 'creatus'),
			'mfp-opacity-01' => esc_html__('0.1', 'creatus'),
			'mfp-opacity-02' => esc_html__('0.2', 'creatus'),
			'mfp-opacity-03' => esc_html__('0.3', 'creatus'),
			'mfp-opacity-04' => esc_html__('0.4', 'creatus'),
			'mfp-opacity-05' => esc_html__('0.5', 'creatus'),
			'mfp-opacity-06' => esc_html__('0.6', 'creatus'),
			'mfp-opacity-07' => esc_html__('0.7', 'creatus'),
			'mfp-opacity-08' => esc_html__('0.8', 'creatus'),
			'mfp-opacity-09' => esc_html__('0.9', 'creatus'),
			'mfp-opacity-1' => esc_html__('No opacity', 'creatus')
		)
	),
	
	'lightbox_effect' => array(
		'label' => __('Popup effect', 'creatus'),
		'desc' => esc_html__('Select popup window opening effect', 'creatus'),
		'type' => 'select',
		'value' => 'mfp-zoom-in',
		'choices' => array(
			'mfp-fade-in' => esc_html__('Fade in', 'creatus'),
			'mfp-zoom-in' => esc_html__('Zoom in', 'creatus'),
			'mfp-zoom-out' => esc_html__('Zoom out', 'creatus'),
			'mfp-newspaper' => esc_html__('Newspaper', 'creatus'),
			'mfp-move-horizontal' => esc_html__('Move horizontal', 'creatus'),
			'mfp-move-from-top' => esc_html__('From top', 'creatus'),
			'mfp-3d-unfold' => esc_html__('3d unfold', 'creatus'),
			'mfp-3d-flip' => esc_html__('3d flip', 'creatus')
		)
	),
	
	
	'lightbox_slider' => array(
		'label' => __('Show thumbnails slider', 'creatus'),
		'desc' => esc_html__('Show/hide lightbox thumbnails slider', 'creatus'),
		'type' => 'switch',
		'right-choice' => array(
			'value' => 'thz-mfp-hide-slider',
			'label' => __('Hide', 'creatus')
		),
		'left-choice' => array(
			'value' => 'thz-mfp-show-slider',
			'label' => __('Show', 'creatus')
		),
		'value' => 'thz-mfp-show-slider'
	),
	
	'lightbox_mode' => array(
		'label' => __('Lightbox mode', 'creatus'),
		'desc' => esc_html__('If single mode the lighbox gallery is inactive', 'creatus'),
		'type' => 'switch',
		'right-choice' => array(
			'value' => 'thz-lightbox-mode-single',
			'label' => __('Single item', 'creatus')
		),
		'left-choice' => array(
			'value' => 'thz-lightbox-gallery-simple',
			'label' => __('Group items in a gallery', 'creatus')
		),
		'value' => 'thz-lightbox-gallery-simple'
	)

);