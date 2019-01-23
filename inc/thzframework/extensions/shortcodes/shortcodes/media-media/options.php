<?php
if (!defined('FW')) {
	die('Forbidden');
}
$options = array(
	'layouttab' => array(
		'title' => __('Layout', 'creatus'),
		'type' => 'tab',
		'options' => array(
			'id' => array(
				'type' => 'unique',
				'length' => 8
			),
			'holder_bs' => array(
				'type' => 'thz-box-style',
				'label' => __('Holder box style', 'creatus'),
				'preview' => true,
				'button-text' => esc_html__('Customize media holder box style', 'creatus'),
				'desc' => esc_html__('Adjust .thz-media-item-container box style', 'creatus'),
				'popup' => true,
				'disable' => array(
					'video',
					'layout',
					'transform',
				),
				'units' => array(
					'borderradius',
					'padding',
					'margin',
					'boxsize'
				),
				'value' => array()
			),
			'media_bs' => array(
				'type' => 'thz-box-style',
				'label' => __('Media box style', 'creatus'),
				'preview' => true,
				'button-text' => esc_html__('Customize media box style', 'creatus'),
				'desc' => esc_html__('Adjust .thz-media-item-media box style', 'creatus'),
				'popup' => true,
				'disable' => array(
					'video',
					'layout',
					'transform',
				),
				'units' => array(
					'borderradius',
					'padding',
					'margin',
					'boxsize'

				),
				'value' => array()
			),
			'cmx' => _thz_container_metrics_defaults()
		)
	),
	'mediaboxtab' => array(
		'title' => __('Media box', 'creatus'),
		'type' => 'tab',
		'lazy_tabs' => false,
		'options' => array(
			'use_poster' => array(
				'label' => __('Media poster', 'creatus'),
				'desc' => esc_html__('Activate media poster. See help for more info. ', 'creatus'),
				'help' => esc_html__('If this option is inactive, media loads on pageload and increases page load time. This option adds a preview poster which than activates the media on click.', 'creatus'),
				'type' => 'short-select',
				'attr' => array(
					'class' => 'thz-select-switch'
				),
				'value' => 'active',
				'choices' => array(
					'active' => array(
						'text' => esc_html__('Active', 'creatus'),
						'attr' => array(
							'data-enable' => 'media_size,grayscale,.p-getp,.t-getp,.thz-media-over',
							'data-disable' => '.a-getp'
						)
					),
					'inactive' => array(
						'text' => esc_html__('Inactive', 'creatus'),
						'attr' => array(
							'data-enable' => '.a-getp',
							'data-disable' => 'media_size,grayscale,.p-getp,.t-getp,.thz-media-over'
						)
					)
				)
			),
			'media_size' => array(
				'label' => __('Image size', 'creatus'),
				'desc' => esc_html__('Select the poster image size.', 'creatus'),
				'value' => 'thz-img-medium',
				'type' => 'short-select',
				'choices' => thz_get_image_sizes_list()
			),
			'grayscale' => array(
				'label' => __('Poster grayscale', 'creatus'),
				'desc' => esc_html__('Add grayscale effect to media poster', 'creatus'),
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
			'media_height' => array(
				'type' => 'multi-picker',
				'label' => false,
				'desc' => false,
				'picker' => array(
					'picked' => array(
						'label' => __('Media container height', 'creatus'),
						'desc' => esc_html__('Set media container height.', 'creatus'),
						'type' => 'select',
						'value' => 'thz-ratio-16-9',
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
							'desc' => esc_html__('Media container height. ', 'creatus')
						)
					)
				)
			),

		)
	),
	'mediaitemtab' => array(
		'title' => __('Media', 'creatus'),
		'type' => 'tab',
		'lazy_tabs' => false,
		'options' => array(
			'm' => array(
				'type' => 'multi',
				'label' => false,
				'inner-options' => array(
					'pid' => array(
						'type' => 'unique',
						'length' => 8
					),
					'type' => array(
						'type' => 'multi-picker',
						'label' => false,
						'desc' => false,
						'show_borders' => true,
						'picker' => array(
							'picked' => array(
								'label' => __('Media Type', 'creatus'),
								'desc' => esc_html__('Select media type', 'creatus'),
								'type' => 'select',
								'value' => 'vimeo',
								'attr' => array(
									'class' => 'thz-select-switch-picker'
								),
								'choices' => array(
									'vimeo' => esc_html__('Vimeo', 'creatus'),
									'youtube' => esc_html__('Youtube', 'creatus'),
									'html5video' => esc_html__('Html5 Video', 'creatus'),
									'html5audio' => esc_html__('Html5 Audio', 'creatus'),
									'iframe' => esc_html__('Iframe/Embed', 'creatus'),
									'oembed' => esc_html__('oEmbed', 'creatus'),
									'selfvideo' => esc_html__('Self hosted video', 'creatus'),
									'selfaudio' => esc_html__('Self hosted audio', 'creatus')
								)
							)
						),
						'choices' => array(
							'vimeo' => array(
								'poster' => array(
									'type' => 'upload',
									'value' => array(),
									'label' => __('Poster image', 'creatus'),
									'desc' => esc_html__('Insert a poster image for this media.', 'creatus'),
									'images_only' => true,
									'attr' => array(
										'class' => 'p-getp'
									)
								),
								'media' => array(
									'type' => 'text',
									'label' => __('Insert Vimeo link', 'creatus'),
									'desc' => esc_html__('Paste copied link from Vimeo', 'creatus')
								),
								'vmx' => array(
									'label' => __('Video attributes', 'creatus'),
									'type'  => 'checkboxes',
									'value' => array(),
									'desc'  => __('Adjust video attributes', 'creatus'),
									'choices' => array(
										'autoplay' => __('Autoplay', 'creatus'),
										'loop' => __('Loop', 'creatus'),
										'muted' => __('Muted', 'creatus'),
									),
									'inline' => true,
									'attr' => array(
										'class' => 'a-getp'
									)
								),
								'qtitle' => array(
									'type' => 'text',
									'label' => __('Popup title', 'creatus'),
									'desc' => esc_html__('Add Popup title. See help for more info', 'creatus'),
									'help' => esc_html__('Popup title is used when media is opened in popup. If empty poster image title is used if available.', 'creatus'),							'attr' => array(
										'class' => 't-getp'
									)
								)
							),
							'youtube' => array(
								'poster' => array(
									'type' => 'upload',
									'value' => array(),
									'label' => __('Poster image', 'creatus'),
									'desc' => esc_html__('Insert a poster image for this media.', 'creatus'),
									'images_only' => true,
									'attr' => array(
										'class' => 'p-getp'
									)
								),
								'media' => array(
									'type' => 'text',
									'label' => __('Insert Youtube link', 'creatus'),
									'desc' => esc_html__('Paste copied link from Youtube', 'creatus')
								),
								'vmx' => array(
									'label' => __('Video attributes', 'creatus'),
									'type'  => 'checkboxes',
									'value' => array(
										'controls' => true,
									),
									'desc'  => __('Adjust video attributes', 'creatus'),
									'choices' => array(
										'autoplay' => __('Autoplay', 'creatus'),
										'loop' => __('Loop', 'creatus'),
										'muted' => __('Muted', 'creatus'),
										'controls' => __('Player Controls', 'creatus'),
									),
									'inline' => true,
									'attr' => array(
										'class' => 'a-getp'
									)
								),
								'qtitle' => array(
									'type' => 'text',
									'label' => __('Popup title', 'creatus'),
									'desc' => esc_html__('Add Popup title. See help for more info', 'creatus'),
									'help' => esc_html__('Popup title is used when media is opened in popup. If empty poster image title is used if available.', 'creatus'),							'attr' => array(
										'class' => 't-getp'
									)
								)
							),
							'html5video' => array(
								'poster' => array(
									'type' => 'upload',
									'value' => array(),
									'label' => __('Poster image', 'creatus'),
									'desc' => esc_html__('Insert a poster image for this media.', 'creatus'),
									'images_only' => true,
								),
								'media' => array(
									'type' => 'text',
									'label' => __('Insert Video link', 'creatus'),
									'desc' => esc_html__('Paste link to your video file', 'creatus')
								),
								'vmx' => array(
									'label' => __('Video attributes', 'creatus'),
									'type'  => 'checkboxes',
									'value' => array(
										'controls' => true,
									),
									'desc'  => __('Adjust video attributes.', 'creatus'),
									'help'  => __('If No MediaElement is checked the markup does not rely on MediaElement script to load the video.', 'creatus'),
									'choices' => array(
										'autoplay' => __('Autoplay', 'creatus'),
										'loop' => __('Loop', 'creatus'),
										'muted' => __('Muted', 'creatus'),
										'controls' => __('Player Controls', 'creatus'),
										'dmejs' => __('No MediaElement', 'creatus'),
									),
									'inline' => true,
									'attr' => array(
										'class' => 'a-getp'
									)
								),
								'qtitle' => array(
									'type' => 'text',
									'label' => __('Popup title', 'creatus'),
									'desc' => esc_html__('Add Popup title. See help for more info', 'creatus'),
									'help' => esc_html__('Popup title is used when media is opened in popup. If empty poster image title is used if available.', 'creatus'),							'attr' => array(
										'class' => 't-getp'
									)
								)
							),
							'html5audio' => array(
								'poster' => array(
									'type' => 'upload',
									'value' => array(),
									'label' => __('Poster image', 'creatus'),
									'desc' => esc_html__('Insert a poster image for this media.', 'creatus'),
									'images_only' => true,
									'attr' => array(
										'class' => 'p-getp'
									)
								),
								'media' => array(
									'type' => 'text',
									'label' => __('Insert Audio link', 'creatus'),
									'desc' => esc_html__('Paste link to your audio file', 'creatus')
								),
								'qtitle' => array(
									'type' => 'text',
									'label' => __('Popup title', 'creatus'),
									'desc' => esc_html__('Add Popup title. See help for more info', 'creatus'),
									'help' => esc_html__('Popup title is used when media is opened in popup. If empty poster image title is used if available.', 'creatus'),							'attr' => array(
										'class' => 't-getp'
									)
								)
							),
							'iframe' => array(
								'poster' => array(
									'type' => 'upload',
									'value' => array(),
									'label' => __('Poster image', 'creatus'),
									'desc' => esc_html__('Insert a poster image for this media.', 'creatus'),
									'images_only' => true,
									'attr' => array(
										'class' => 'p-getp'
									)
								),
								'media' => array(
									'type' => 'textarea',
									'label' => __('Insert iframe', 'creatus'),
									'desc' => esc_html__('Paste an iframe/embed code here', 'creatus')
								),
								'qtitle' => array(
									'type' => 'text',
									'label' => __('Popup title', 'creatus'),
									'desc' => esc_html__('Add Popup title. See help for more info', 'creatus'),
									'help' => esc_html__('Popup title is used when media is opened in popup. If empty poster image title is used if available.', 'creatus'),							'attr' => array(
										'class' => 't-getp'
									)
								)
							),
							'oembed' => array(
								'poster' => array(
									'type' => 'upload',
									'value' => array(),
									'label' => __('Poster image', 'creatus'),
									'desc' => esc_html__('Insert a poster image for this media.', 'creatus'),
									'images_only' => true,
									'attr' => array(
										'class' => 'p-getp'
									)
								),
								'autoplay' => array(
									'label' => __('Autoplay', 'creatus'),
									'desc' => esc_html__('Automatically play this media on page load. Works for Vimeo, Youtube, Dailymotion and Soundcloud', 'creatus'),
									'type' => 'switch',
									'right-choice' => array(
										'value' => 'inactive',
										'label' => __('Inactive', 'creatus')
									),
									'left-choice' => array(
										'value' => 'active',
										'label' => __('Active', 'creatus')
									),
									'value' => 'inactive',
									'attr' => array(
										'class' => 'a-getp'
									)
								),
								'media' => array(
									'type' => 'oembed',
									'value' => '',
									'label' => __('Insert media', 'creatus'),
									'desc' => esc_html__('Add any WordPress supported oEmbed link here', 'creatus'),
									'preview' => array(
										'keep_ratio' => true
									)
								),
								'qtitle' => array(
									'type' => 'text',
									'label' => __('Popup title', 'creatus'),
									'desc' => esc_html__('Add Popup title. See help for more info', 'creatus'),
									'help' => esc_html__('Popup title is used when media is opened in popup. If empty poster image title is used if available.', 'creatus'),							'attr' => array(
										'class' => 't-getp'
									)
								)
							),
							'selfvideo' => array(
								'poster' => array(
									'type' => 'upload',
									'value' => array(),
									'label' => __('Poster image', 'creatus'),
									'desc' => esc_html__('Insert a poster image for this media.', 'creatus'),
									'images_only' => true
								),
								'media' => array(
									'type' => 'multi-upload',
									'value' => array(),
									'label' => __('Upload/select video', 'creatus'),
									'desc' => esc_html__('Allowed  video formats are; mp4, webm, and ogv. You can select all 3 video types at once.', 'creatus'),
									'images_only' => false,
									'files_ext' => array(
										'mp4',
										'webm',
										'ogv'
									)
								),
								'vmx' => array(
									'label' => __('Video attributes', 'creatus'),
									'type'  => 'checkboxes',
									'value' => array(
										'controls' => true,
									),
									'desc'  => __('Adjust video attributes', 'creatus'),
									'help'  => __('If No MediaElement is checked the markup does not rely on MediaElement script to load the video.', 'creatus'),
									'choices' => array(
										'autoplay' => __('Autoplay', 'creatus'),
										'loop' => __('Loop', 'creatus'),
										'muted' => __('Muted', 'creatus'),
										'controls' => __('Player Controls', 'creatus'),
										'dmejs' => __('No MediaElement', 'creatus'),
									),
									'inline' => true,
									'attr' => array(
										'class' => 'a-getp'
									)
								),
								'qtitle' => array(
									'type' => 'text',
									'label' => __('Popup title', 'creatus'),
									'desc' => esc_html__('Add Popup title. See help for more info', 'creatus'),
									'help' => esc_html__('Popup title is used when media is opened in popup. If empty poster image title is used if available.', 'creatus'),							'attr' => array(
										'class' => 't-getp'
									)
								),
							),
							'selfaudio' => array(
								'poster' => array(
									'type' => 'upload',
									'value' => array(),
									'label' => __('Poster image', 'creatus'),
									'desc' => esc_html__('Insert a poster image for this media.', 'creatus'),
									'images_only' => true,
									'attr' => array(
										'class' => 'p-getp'
									)
								),
								'media' => array(
									'type' => 'multi-upload',
									'value' => array(),
									'label' => __('Upload/select audio', 'creatus'),
									'desc' => esc_html__('Allowed audio formats are; mp3, wav, and ogg. You can select all 3 audio types at once.', 'creatus'),
									'images_only' => false,
									'files_ext' => array(
										'mp3',
										'wav',
										'ogg'
									)
								),
								'qtitle' => array(
									'type' => 'text',
									'label' => __('Popup title', 'creatus'),
									'desc' => esc_html__('Add Popup title. See help for more info', 'creatus'),
									'help' => esc_html__('Popup title is used when media is opened in popup. If empty poster image title is used if available.', 'creatus'),							'attr' => array(
										'class' => 't-getp'
									)
								)
							)
						)
					)
				)
			)
		)
	),
	'overlayoptionstab' => array(
		'title' => __('Media overlay', 'creatus'),
		'type' => 'tab',
		'lazy_tabs' => false,
		'li-attr' => array(
			'class' => 'thz-media-over'
		),
		'options' => array(
			'over_mode' => array(
				'label' => __('Overlay display mode', 'creatus'),
				'desc' => esc_html__('Select overlay display mode', 'creatus'),
				'type' => 'select',
				'attr' => array(
					'class' => 'thz-select-switch'
				),
				'value' => 'reveal',
				'choices' => array(
					'thzhover' => array(
						'text' => esc_html__(' Thz hover ( Overlay shows on hover )', 'creatus'),
						'attr' => array(
							'data-enable' => '#thz-hover-med_over-oeffect,#thz-hover-med_over-ieffect,#thz-hover-med_over-iceffect',
							'data-disable' => 'reveal_effect'
						)
					),
					'reveal' => array(
						'text' => esc_html__('Reveal ( Overlay hides on hover )', 'creatus'),
						'attr' => array(
							'data-enable' => 'reveal_effect,#thz-hover-med_over-ieffect',
							'data-disable' => '#thz-hover-med_over-oeffect,#thz-hover-med_over-iceffect'
						)
					),
					'directional' => array(
						'text' => esc_html__('Directional ( Overlay shows on hover )', 'creatus'),
						'attr' => array(
							'data-enable' => '#thz-hover-med_over-ieffect',
							'data-disable' => 'reveal_effect,#thz-hover-med_over-oeffect,#thz-hover-med_over-iceffect'
						)
					)
				)
			),
			'reveal_effect' => array(
				'type' => 'thz-multi-options',
				'label' => __('Media overlay effect', 'creatus'),
				'desc' => esc_html__('Select media overlay hover effect and duration', 'creatus'),
				'value' => array(
					'effect' => 'thz-reveal-fadeout',
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
						'type' => 'gradient',
						'gradient' => 'radial',
						'color1' => 'rgba(0,0,0,0.1)',
						'color2' => 'rgba(0,0,0,0.8)'
					),
					'oeffect' => 'thz-hover-fadein',
					'oduration' => 'thz-transease-04',
					'ieffect' => 'thz-img-zoomin',
					'iduration' => 'thz-transease-04',
					'iceffect' => 'thz-comein-bottom',
					'icduration' => 'thz-transease-05'
				),
				'labels' => array(
					'background' => esc_html__('Media overlay background', 'creatus'),
					'overlay' => esc_html__('Media overlay effect', 'creatus'),
					'image' => esc_html__('Media image effect', 'creatus'),
					'icons' => esc_html__('Overlay element effect', 'creatus')
				),
				'descriptions' => array(
					'background' => esc_html__('Set media overlay background', 'creatus'),
					'overlay' => esc_html__('Select media overlay hover effect and duration', 'creatus'),
					'image' => esc_html__('Select media image hover effect and duration', 'creatus'),
					'icons' => esc_html__('Select media overlay element hover effect and duration', 'creatus')
				),
				'label' => false,
				'desc' => false
			),
			'distance' => array(
				'type' => 'thz-spinner',
				'label' => __('Media overlay distance', 'creatus'),
				'desc' => esc_html__('Distance the media overlay from media box edges', 'creatus'),
				'addon' => 'px',
				'min' => 0,
				'max' => 200,
				'value' => '0'
			),
			'icon_mx' => array(
				'type' => 'thz-multi-options',
				'label' => __('Overlay icon metrics', 'creatus'),
				'desc' => esc_html__('Adjust overlay icon metrics', 'creatus'),
				'value' => array(
					'i' => 'thzicon thzicon-play3',
					's' => 18,
					'c' => '#ffffff'
				),
				'thz_options' => array(
					'i' => array(
						'type' => 'icon',
						'title' => esc_html__('Icon', 'creatus'),
					),
					's' => array(
						'type' => 'spinner',
						'title' => esc_html__('Size', 'creatus'),
						'addon' => 'px',
						'max' => 100
					),
					'c' => array(
						'type' => 'color',
						'title' => esc_html__('Color', 'creatus'),
						'box' => true
					)
				)
			)
		)
	),
	
	'mediaeffects' => array(
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
				'addlabel' => esc_html__('Animate media', 'creatus'),
				'adddesc' => esc_html__('Add animation to the media HTML container', 'creatus')
			),
			'cpx' => _thz_container_parallax_default()
		)
	)
);