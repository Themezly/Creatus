<?php
if (!defined('FW')) {
	die('Forbidden');
}

$thumbsize = get_option('thumbnail_size_w').'x'.get_option('thumbnail_size_h');

$options = array(
	'media_layout' => array(
		'type' => 'multi-picker',
		'label' => false,
		'desc' => false,
		'picker' => array(
			'picked' => array(
				'label' => __('Media layout', 'creatus'),
				'desc' => esc_html__('Select media layout mode', 'creatus'),
				'type' => 'short-select',
				'value' => 'slider',
				'choices' => array(
					'slider' => esc_html__('Slider', 'creatus'),
					'grid' => esc_html__('Grid', 'creatus')
				)
			)
		),
		'choices' => array(
			'grid' => array(
				'columns' => array(
					'label' => __('Number of columns', 'creatus'),
					'desc' => esc_html__('Select number of columns', 'creatus'),
					'value' => 3,
					'type' => 'radio',
					'inline' => true,
					'choices' => array(
						'1' => esc_html__('1', 'creatus'),
						'2' => esc_html__('2', 'creatus'),
						'3' => esc_html__('3', 'creatus'),
						'4' => esc_html__('4', 'creatus'),
						'5' => esc_html__('5', 'creatus'),
						'6' => esc_html__('6', 'creatus')
					)
				),
				'gutter' => array(
					'type' => 'thz-slider',
					'value' => '15',
					'properties' => array(
						'min' => 0,
						'step' => 1,
						'max' => 100
					),
					'showinput' => true,
					'label' => __('Media gutter', 'creatus'),
					'desc' => esc_html__('This is the space between the media items', 'creatus')
				)
			)
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
				'value' => 'auto',
				'choices' => array(
					array( // optgroup
						'attr' => array(
							'label' => __('Misc', 'creatus')
						),
						'choices' => array(
							'auto' => esc_html__('Auto ( masonry if grid layout)', 'creatus'),
							'metro' => esc_html__('Metro ( use in grid layout only ) ', 'creatus'),
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
			'metro' => array(
				'sequence' => _thz_metro_sequence_option()
			),
			'custom' => array(
				'height' => array(
					'type' => 'thz-spinner',
					'addon' => 'px',
					'min' => 0,
					'label' => '',
					'value' => 650,
					'desc' => esc_html__('Media container height. ', 'creatus')
				)
			)
		)
	),

	'media_size' => array(
		'label' => __('Media image size', 'creatus'),
		'desc' => esc_html__('Select the media image size to be used.', 'creatus'),
		'value' => 'original',
		'type' => 'short-select',
		'choices' => thz_get_image_sizes_list()
	),

	'incfeatured' => array(
		'label' => __('Include featured image', 'creatus'),
		'desc' => esc_html__('Include/exclude featured image in post media.', 'creatus'),
		'type' => 'switch',
		'right-choice' => array(
			'value' => 'exclude',
			'label' => __('Exclude', 'creatus')
		),
		'left-choice' => array(
			'value' => 'include',
			'label' => __('Include', 'creatus')
		),
		'value' => 'include'
	),
	'use_poster' => array(
		'label' => __('Media posters', 'creatus'),
		'desc' => esc_html__('Activate media posters for all media types except images. See help for more info. ', 'creatus'),
		'help' => esc_html__('If this option is inactive, all videos and iframes load on pageload and increase page load time. This option adds a preview poster wich than activates the media on click. ', 'creatus'),
		'type' => 'switch',
		'right-choice' => array(
			'value' => 'inactive',
			'label' => __('Inactive', 'creatus')
		),
		'left-choice' => array(
			'value' => 'active',
			'label' => __('Active', 'creatus')
		),
		'value' => 'active'
	),
	'post_media' => array(
		'type' => 'addable-popup',
		'value' => array(),
		'label' => __('Post media', 'creatus'),
		'desc' => esc_html__('Drag and drop to reorder', 'creatus'),
		'template' => '{{ thz.thz_popup_thumbs_template(type.picked,media_title,\''.$thumbsize.'\',type[type.picked].media,_context) }}',
		'popup-title' => null,
		'size' => 'large',
		'add-button-text' => esc_html__('Add/edit post media', 'creatus'),
		'sortable' => true,
		'popup-options' => array(
			'pid' => array(
				'type' => 'unique',
				'length' => 8
			),
			'media_title' => array(
				'type' => 'text',
				'label' => __('Sorting title', 'creatus'),
				'value' => '',
				'desc' => esc_html__('This option is used in popup option type for easy sorting', 'creatus')
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
						'value' => 'image',
						'choices' => array(
							'images' => esc_html__('Images', 'creatus'),
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
					'images' => array(
						'media' => array(
							'label' => __('Select images', 'creatus'),
							'type' => 'multi-upload',
							'desc' => esc_html__('Drag and drop selected images to change the order.', 'creatus'),
							'texts' => array(
								'button_add' => esc_html__('Select images', 'creatus'),
								'button_edit' => esc_html__('Edit images', 'creatus')
							)
						)
					),
					'vimeo' => array(
						'poster' => array(
							'type' => 'upload',
							'value' => array(),
							'label' => __('Poster image', 'creatus'),
							'desc' => esc_html__('Insert a poster image for this media. Used only if Media posters are active.', 'creatus'),
							'images_only' => true
						),
						'media' => array(
							'type' => 'text',
							'label' => __('Insert Vimeo link', 'creatus'),
							'desc' => esc_html__('Paste copied link from Vimeo', 'creatus')
						),
						'qtitle' => array(
							'type' => 'text',
							'label' => __('Quick title', 'creatus'),
							'desc' => esc_html__('Add quick title. See help for more info', 'creatus'),
							'help' => esc_html__('Quick title takes precedence over self hosted media title and gives you an option to add titles for external hosted medias.', 'creatus')
						)
					),
					'youtube' => array(
						'poster' => array(
							'type' => 'upload',
							'value' => array(),
							'label' => __('Poster image', 'creatus'),
							'desc' => esc_html__('Insert a poster image for this media. Used only if Media posters are active.', 'creatus'),
							'images_only' => true
						),
						'media' => array(
							'type' => 'text',
							'label' => __('Insert Youtube link', 'creatus'),
							'desc' => esc_html__('Paste copied link from Youtube', 'creatus')
						),
						'qtitle' => array(
							'type' => 'text',
							'label' => __('Quick title', 'creatus'),
							'desc' => esc_html__('Add quick title. See help for more info', 'creatus'),
							'help' => esc_html__('Quick title takes precedence over self hosted media title and gives you an option to add titles for external hosted medias.', 'creatus')
						)
					),
					'html5video' => array(
						'poster' => array(
							'type' => 'upload',
							'value' => array(),
							'label' => __('Poster image', 'creatus'),
							'desc' => esc_html__('Insert a poster image for this media.', 'creatus'),
							'images_only' => true
						),
						'media' => array(
							'type' => 'text',
							'label' => __('Insert Video link', 'creatus'),
							'desc' => esc_html__('Paste link to your video file', 'creatus')
						),
						'qtitle' => array(
							'type' => 'text',
							'label' => __('Quick title', 'creatus'),
							'desc' => esc_html__('Add quick title. See help for more info', 'creatus'),
							'help' => esc_html__('Quick title takes precedence over self hosted media title and gives you an option to add titles for external hosted medias.', 'creatus')
						)
					),
					'html5audio' => array(
						'poster' => array(
							'type' => 'upload',
							'value' => array(),
							'label' => __('Poster image', 'creatus'),
							'desc' => esc_html__('Insert a poster image for this media. Used only if Media posters are active.', 'creatus'),
							'images_only' => true
						),
						'media' => array(
							'type' => 'text',
							'label' => __('Insert Audio link', 'creatus'),
							'desc' => esc_html__('Paste link to your audio file', 'creatus')
						),
						'qtitle' => array(
							'type' => 'text',
							'label' => __('Quick title', 'creatus'),
							'desc' => esc_html__('Add quick title. See help for more info', 'creatus'),
							'help' => esc_html__('Quick title takes precedence over self hosted media title and gives you an option to add titles for external hosted medias.', 'creatus')
						)
					),
					'iframe' => array(
						'poster' => array(
							'type' => 'upload',
							'value' => array(),
							'label' => __('Poster image', 'creatus'),
							'desc' => esc_html__('Insert a poster image for this media. Used only if Media posters are active.', 'creatus'),
							'images_only' => true
						),
						'media' => array(
							'type' => 'textarea',
							'label' => __('Insert iframe', 'creatus'),
							'desc' => esc_html__('Paste an iframe/embed code here', 'creatus')
						),
						'qtitle' => array(
							'type' => 'text',
							'label' => __('Quick title', 'creatus'),
							'desc' => esc_html__('Add quick title. See help for more info', 'creatus'),
							'help' => esc_html__('Quick title takes precedence over self hosted media title and gives you an option to add titles for external hosted medias.', 'creatus')
						)
					),
					'oembed' => array(
						'poster' => array(
							'type' => 'upload',
							'value' => array(),
							'label' => __('Poster image', 'creatus'),
							'desc' => esc_html__('Insert a poster image for this media. Used only if Media posters are active.', 'creatus'),
							'images_only' => true
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
							'label' => __('Quick title', 'creatus'),
							'desc' => esc_html__('Add quick title. See help for more info', 'creatus'),
							'help' => esc_html__('Quick title takes precedence over self hosted media title and gives you an option to add titles for external hosted medias.', 'creatus')
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
						'qtitle' => array(
							'type' => 'text',
							'label' => __('Quick title', 'creatus'),
							'desc' => esc_html__('Add quick title. See help for more info', 'creatus'),
							'help' => esc_html__('Quick title takes precedence over self hosted media title and gives you an option to add titles for external hosted medias.', 'creatus')
						)
					),
					'selfaudio' => array(
						'poster' => array(
							'type' => 'upload',
							'value' => array(),
							'label' => __('Poster image', 'creatus'),
							'desc' => esc_html__('Insert a poster image for this media. Used only if Media posters are active.', 'creatus'),
							'images_only' => true
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
							'label' => __('Quick title', 'creatus'),
							'desc' => esc_html__('Add quick title. See help for more info', 'creatus'),
							'help' => esc_html__('Quick title takes precedence over self hosted media title and gives you an option to add titles for external hosted medias.', 'creatus')
						)
					)
				)
			)
		)
	)
);