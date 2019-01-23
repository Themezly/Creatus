<?php
if (!defined('FW')) {
	die('Forbidden');
}
$options = array(
	'defaultstab' => array(
		'title' => __('Defaults', 'creatus'),
		'type' => 'tab',
		'options' => array(
			'image' => array(
				'type' => 'upload',
				'label' => __('Select Image', 'creatus'),
				'desc' => esc_html__('Select or upload an image', 'creatus')
			),
			'media_size' => array(
				'label' => __('Image size', 'creatus'),
				'desc' => esc_html__('Select the image size to be used.', 'creatus'),
				'value' => 'thz-img-medium',
				'type' => 'short-select',
				'choices' => thz_get_image_sizes_list()
			),
			'grayscale' => array(
				'label' => __('Image grayscale', 'creatus'),
				'desc' => esc_html__('Add grayscale effect', 'creatus'),
				'value' => 'none',
				'type' => 'radio',
				'inline' => true,
				'choices' => array(
					'none' => esc_html__('Inactive', 'creatus'),
					'thz-grayscale' => esc_html__('Active', 'creatus'),
					'thz-grayscale-add' => esc_html__('Active on hover', 'creatus'),
					'thz-grayscale-remove' => esc_html__('Remove on hover', 'creatus')
				)
			),
			'id' => array(
				'type' => 'unique',
				'length' => 8
			),
			'cmx' => _thz_container_metrics_defaults()
		)
	),
	'actionstab' => array(
		'title' => __('Actions', 'creatus'),
		'type' => 'tab',
		'li-attr' => array(
			'class' => 'thz-li-actionstab'
		),
		'lazy_tabs' => false,
		'options' => array(
			'click' => array(
				'label' => __('Click action', 'creatus'),
				'desc' => esc_html__('Select image click action', 'creatus'),
				'type' => 'short-select',
				'attr' => array(
					'class' => 'thz-select-switch'
				),
				'value' => 'none',
				'choices' => array(
					'none' => array(
						'text' => esc_html__('None', 'creatus'),
						'attr' => array(
							'data-disable' => 'link'
						)
					),
					'link' => array(
						'text' => esc_html__('Open link', 'creatus'),
						'attr' => array(
							'data-enable' => 'link'
						)
					),
					'lightbox' => array(
						'text' => esc_html__('Open image in lightbox', 'creatus'),
						'attr' => array(
							'data-disable' => 'link'
						)
					)
				)
			),
			'link' => array(
				'label' => __('Add custom link', 'creatus'),
				'desc' => esc_html__('Add custom link for this image', 'creatus'),
				'type' => 'thz-url',
				'value' => array(
					'type' => 'normal',
					'url' => '',
					'title' => '',
					'target' => '_self',
					'magnific' => ''
				),
				'data-parent' => 'parent',
				'data-type' => '.thz-url-type,.linkType',
				'data-link' => '.thz-url-input,.normalLink',
				'data-title' => '.thz-url-title,.linkTitle',
				'data-target' => '.thz-url-target,.linkTarget',
				'data-magnific' => '.thz-url-magnific,.magnificId'
			),
			'swap' => array(
				'label' => __('Swap image', 'creatus'),
				'desc' => esc_html__('Swap image on hover or once in view', 'creatus'),
				'type' => 'short-select',
				'attr' => array(
					'class' => 'thz-select-switch'
				),
				'value' => 'none',
				'choices' => array(
					'inactive' => array(
						'text' => esc_html__('Inactive', 'creatus'),
						'attr' => array(
							'data-disable' => 'swapimg,swapimg_size,swap_action'
						)
					),
					'active' => array(
						'text' => esc_html__('Active', 'creatus'),
						'attr' => array(
							'data-enable' => 'swapimg,swapimg_size,swap_action'
						)
					)
				)
			),
			'swapimg' => array(
				'type' => 'upload',
				'label' => __('Swap Image', 'creatus'),
				'desc' => esc_html__('Select or upload a swap image', 'creatus')
			),
			'swapimg_size' => array(
				'label' => __('Swap image  size', 'creatus'),
				'desc' => esc_html__('Select the image size to be used.', 'creatus'),
				'value' => 'thz-img-medium',
				'type' => 'short-select',
				'choices' => thz_get_image_sizes_list()
			),
			'swap_action' => array(
				'label' => __('Swap action', 'creatus'),
				'desc' => esc_html__('Select the swap image action', 'creatus'),
				'help' => esc_html__('Swap image in view can be used when you need to present gif image but would like the gif animation to start once the image is in view. In this case make static image of your gif first animation frame, use that as default image than set your gif image as swap image.', 'creatus'),
				'type' => 'switch',
				'right-choice' => array(
					'value' => 'hover',
					'label' => __('On hover', 'creatus')
				),
				'left-choice' => array(
					'value' => 'view',
					'label' => __('In view', 'creatus')
				),
				'value' => 'hover'
			)
		)
	),
	'layouttab' => array(
		'title' => __('Layout', 'creatus'),
		'type' => 'tab',
		'lazy_tabs' => false,
		'options' => array(
			'height' => array(
				'type' => 'multi-picker',
				'label' => false,
				'desc' => false,
				'picker' => array(
					'picked' => array(
						'label' => __('Image height', 'creatus'),
						'desc' => esc_html__('Select image height.', 'creatus'),
						'type' => 'select',
						'value' => 'auto',
						'choices' => array(
							array( // optgroup
								'attr' => array(
									'label' => __('Misc', 'creatus')
								),
								'choices' => array(
									'auto' => esc_html__('Auto', 'creatus'),
									'custom' => esc_html__('Custom', 'creatus')
								)
							),
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
							)
						)
					)
				),
				'choices' => array(
					'custom' => array(
						'height' => array(
							'type' => 'thz-spinner',
							'addon' => 'px',
							'min' => 0,
							'label' => '',
							'value' => 350,
							'desc' => esc_html__('Image height. ', 'creatus')
						)
					)
				)
			),

			'media_bs' => array(
				'type' => 'thz-box-style',
				'label' => __('Image container box style', 'creatus'),
				'preview' => true,
				'button-text' => esc_html__('Customize image container box style', 'creatus'),
				'desc' => esc_html__('Adjust .thz-media-item-image box style', 'creatus'),
				'popup' => true,
				'disable' => array(
					'video',
				),
				'units' => array(
					'borderradius',
					'boxsize',
					'padding',
					'margin',
				),
				'value' => array()
			),
			
			'con_bs' => array(
				'type' => 'thz-box-style',
				'label' => __('Container box style', 'creatus'),
				'preview' => true,
				'button-text' => esc_html__('Customize container box style', 'creatus'),
				'desc' => esc_html__('Adjust .thz-media-image-container box style', 'creatus'),
				'popup' => true,
				'disable' => array(
					'video',
				),
				'units' => array(
					'borderradius',
					'boxsize',
					'padding',
					'margin',
				),
				'value' => array()
			),
			'caption' => array(
				'type' => 'multi-picker',
				'label' => false,
				'desc' => false,
				'show_borders' => true,
				'picker' => array(
					'picked' => array(
						'label' => __('Image caption', 'creatus'),
						'desc' => esc_html__('Show/hide image caption', 'creatus'),
						'type' => 'switch',
						'right-choice' => array(
							'value' => 'hide',
							'label' => __('Hide', 'creatus')
						),
						'left-choice' => array(
							'value' => 'show',
							'label' => __('Show', 'creatus')
						),
						'value' => 'hide'
					)
				),
				'choices' => array(
					'show' => array(
						'bs' => array(
							'type' => 'thz-box-style',
							'label' => __('Caption box style', 'creatus'),
							'desc' => esc_html__('Adjust caption margin', 'creatus'),
							'popup' => true,
							'preview' => true,
							'button-text' => esc_html__('Customize image caption box style', 'creatus'),
							'desc' => esc_html__('Adjust .thz-media-image-caption box style', 'creatus'),
							'disable' => array('video'),
							'value' => array(
								'margin' => array(
									'top' => 30,
									'right' => 0,
									'bottom' => 0,
									'left' => 0
								)
							)
						),
						'f' => array(
							'label' => __('Caption font', 'creatus'),
							'desc' => esc_html__('Adjust image caption font.', 'creatus'),
							'type' => 'thz-typography',
							'value' => array(),
							'disable' => array('hovered'),
						)
					)
				)
			)
		)
	),
	'lightboxoptionstab' => array(
		'title' => __('Lightbox', 'creatus'),
		'type' => 'tab',
		'lazy_tabs' => false,
		'options' => array(
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
			)
		)
	),
	'overlayoptionstab' => array(
		'title' => __('Overlay', 'creatus'),
		'type' => 'tab',
		'lazy_tabs' => false,
		'options' => array(
			'over_mode' => array(
				'label' => __('Overlay display mode', 'creatus'),
				'desc' => esc_html__('Select overlay display mode. It is active only if image action is enabled.', 'creatus'),
				'type' => 'select',
				'attr' => array(
					'class' => 'thz-select-switch'
				),
				'value' => 'none',
				'choices' => array(
					'none' => array(
						'text' => esc_html__('None', 'creatus'),
						'attr' => array(
							'data-disable' => 'reveal_effect,med_over,distance,.thz-overlayicon-li'
						)
					),
					'thzhover' => array(
						'text' => esc_html__('Thz hover ( Overlay shows on hover )', 'creatus'),
						'attr' => array(
							'data-enable' => '.thz-overlayicon-li,med_over,distance,#thz-hover-med_over-oeffect,#thz-hover-med_over-ieffect,#thz-hover-med_over-iceffect',

							'data-disable' => 'reveal_effect'
						)
					),
					'reveal' => array(
						'text' => esc_html__('Reveal ( Overlay hides on hover )', 'creatus'),
						'attr' => array(
							'data-enable' => '.thz-overlayicon-li,med_over,distance,reveal_effect,#thz-hover-med_over-ieffect',
							'data-disable' => '#thz-hover-med_over-oeffect,#thz-hover-med_over-iceffect'
						)
					),
					'directional' => array(
						'text' => esc_html__('Directional ( Overlay shows on hover )', 'creatus'),
						'attr' => array(
							'data-enable' => '.thz-overlayicon-li,med_over,distance,#thz-hover-med_over-ieffect',
							'data-disable' => 'reveal_effect,#thz-hover-med_over-oeffect,#thz-hover-med_over-iceffect'
						)
					)
				)
			),
			'reveal_effect' => array(
				'type' => 'thz-multi-options',
				'label' => __('Media overlay effec', 'creatus'),
				'desc' => esc_html__('Select media overlay hover effect and duration', 'creatus'),
				'value' => array(
					'effect' => 'thz-reveal-goleft',
					'transition' => 'thz-transease-04'
				),
				'thz_options' => array(
					'effect' => array(
						'type' => 'select',
						'title' => esc_html__('Effect', 'creatus'),
						'choices' => _thz_reveal_list()
					),
					'transition' => array(
						'type' => 'short-select',
						'title' => esc_html__('Duration', 'creatus'),
						'choices' => _thz_transition_duration_list()
					)
				)
			),
			'med_over' => array(
				'type' => 'thz-hover',
				'value' => array(
					'background' => array(
						'type' =>'gradient',
						'gradient' =>'radial',
						'color1' =>'rgba(0,0,0,0.1)',
						'color2' =>'rgba(0,0,0,0.8)',
					),
					'oeffect' => 'thz-hover-fadein',
					'oduration' => 'thz-transease-04',
					'ieffect' => 'thz-img-zoomin',
					'iduration' => 'thz-transease-04',
					'iceffect' => 'thz-comein-bottom',
					'icduration' => 'thz-transease-05'
				),
				'labels' => array(
					'background' => esc_html__('Image overlay background', 'creatus'),
					'overlay' => esc_html__('Image overlay effect', 'creatus'),
					'image' => esc_html__('Image effect', 'creatus'),
					'icons' => esc_html__('Overlay icon effect', 'creatus')
				),
				'descriptions' => array(
					'background' => esc_html__('Set image overlay background', 'creatus'),
					'overlay' => esc_html__('Select image overlay hover effect and duration', 'creatus'),
					'image' => esc_html__('Select image hover effect and duration', 'creatus'),
					'icons' => esc_html__('Select image overlay icon hover effect and duration', 'creatus')
				),
				'label' => false,
				'desc' => false
			),
			'distance' => array(
				'type' => 'thz-spinner',
				'label' => __('Image overlay distance', 'creatus'),
				'desc' => esc_html__('Distance the image overlay from image box edges', 'creatus'),
				'addon' => 'px',
				'min' => 0,
				'max' => 200,
				'value' => '0'
			)
		)
	),
	'iconsettings' => array(
		'title' => __('Overlay icon', 'creatus'),
		'type' => 'tab',
		'li-attr' => array(
			'class' => 'thz-overlayicon-li'
		),
		'options' => array(
			'mi' => array(
				'type' => 'multi-picker',
				'label' => false,
				'desc' => false,
				'show_borders' => true,
				'picker' => array(
					'picked' => array(
						'label' => __('Show overlay icon', 'creatus'),
						'desc' => esc_html__('Show/hide overlay icon', 'creatus'),
						'type' => 'switch',
						'right-choice' => array(
							'value' => 'hide',
							'label' => __('Hide', 'creatus')
						),
						'left-choice' => array(
							'value' => 'show',
							'label' => __('Show', 'creatus')
						),
						'value' => 'show'
					)
				),
				'choices' => array(
					'show' => array(
						'icon' => array(
							'type' => 'thz-icon',
							'value' => 'thzicon thzicon-plus',
							'label' => __('Overlay icon', 'creatus'),
							'desc' => esc_html__('Set overlay icon. Shown only if icon selected.', 'creatus')
						),
						'icon_metrics' => array(
							'type' => 'thz-multi-options',
							'label' => __('Icon metrics', 'creatus'),
							'desc' => esc_html__('Adjust icon metrics', 'creatus'),
							'value' => array(
								'pa' => 10,
								'fs' => 16,
								'co' => '#ffffff'
							),
							'thz_options' => array(
								'pa' => array(
									'type' => 'spinner',
									'title' => esc_html__('Padding', 'creatus'),
									'addon' => 'px',
									'min' => 0,
									'max' => 100
								),
								'fs' => array(
									'type' => 'spinner',
									'title' => esc_html__('Icon size', 'creatus'),
									'addon' => 'px',
									'min' => 0,
									'max' => 100
								),
								'co' => array(
									'type' => 'color',
									'title' => esc_html__('Icon color', 'creatus'),
									'box' => true
								)
							)
						),
						'iconbg_metrics' => array(
							'type' => 'thz-multi-options',
							'label' => __('Shape metrics', 'creatus'),
							'desc' => esc_html__('Adjust icon background shape metrics', 'creatus'),
							'value' => array(
								'sh' => 'square',
								'bg' => '',
								'bs' => 'solid',
								'bsi' => 0,
								'bc' => ''
							),
							'thz_options' => array(
								'sh' => array(
									'type' => 'short-select',
									'title' => esc_html__('Type', 'creatus'),
									'choices' => array(
										'circle' => esc_html__('Circle', 'creatus'),
										'square' => esc_html__('Square', 'creatus'),
										'rounded' => esc_html__('Rounded', 'creatus')
									)
								),
								'bg' => array(
									'type' => 'color',
									'title' => esc_html__('Background', 'creatus'),
									'box' => true
								),
								'bs' => array(
									'type' => 'short-select',
									'title' => esc_html__('Border style', 'creatus'),
									'choices' => array(
										'solid' => esc_html__('Solid', 'creatus'),
										'dashed' => esc_html__('Dashed', 'creatus'),
										'dotted' => esc_html__('Dotted', 'creatus')
									)
								),
								'bsi' => array(
									'type' => 'spinner',
									'title' => esc_html__('Border size', 'creatus'),
									'addon' => 'px',
									'min' => 0,
									'max' => 100
								),
								'bc' => array(
									'type' => 'color',
									'title' => esc_html__('Border color', 'creatus'),
									'box' => true
								)
							)
						)
					)
				)
			)
		)
	),

	'imageeffects' => array(
		'title' => __('Effects', 'creatus'),
		'type' => 'tab',
		'lazy_tabs'=> false,
		'options' => array(
			'animate' => array(
				'type' => 'thz-animation',
				'label' => false,
				'value' => array(
					'animate' => 'inactive',
					'effect' => 'thz-anim-slideIn-up',
					'duration' => 400,
					'delay' => 200
				),
				'addlabel' => esc_html__('Animate container', 'creatus'),
				'adddesc' => esc_html__('Add animation to the image HTML container', 'creatus')
			),
			'cpx' => _thz_container_parallax_default(),
			'mpx' => _thz_media_parallax_default('mpx-opt',false)
		)
	)
);