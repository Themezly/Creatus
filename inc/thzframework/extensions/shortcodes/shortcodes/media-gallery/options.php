<?php
if (!defined('FW')) {
	die('Forbidden');
}


$thumbsize = get_option('thumbnail_size_w').'x'.get_option('thumbnail_size_h');
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
				'desc' => esc_html__('Adjust .thz-media-holder box style', 'creatus'),
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
			
			'media_layout' => array(
				'label' => __('Media layout', 'creatus'),
				'desc' => esc_html__('Select media layout mode', 'creatus'),
				'type' => 'short-select',
				'attr' => array(
					'class' => 'thz-select-switch'
				),
				'value' => 'grid',
				'choices' => array(
					'grid' => array(
						'text' => esc_html__('Grid', 'creatus'),
						'attr' => array(
							'data-enable' => 'grid,animate,.thz-posts-filter-li',
							'data-disable' => '.thz-tab-slider-li'
						)
					),
					'slider' => array(
						'text' => esc_html__('Slider', 'creatus'),
						'attr' => array(
							'data-enable' => '.thz-tab-slider-li',
							'data-disable' => 'grid,animate,.thz-posts-filter-li'
						)
					),
				)
			),
			'grid' => array(
				'type' => 'thz-multi-options',
				'label' => __('Media grid settings', 'creatus'),
				'desc' => esc_html__('Adjust grid settings. See help for more info.', 'creatus'),
				'help' => esc_html__('If the .thz-grid-item-in width is less than desired min width, the columns number drops down by one in order to honor the min width setting. This adjustment is active only if media container height is anything else but metro. On the other hand if the window width is below 980px and grid has more than 2 columns, only 2 columns are shown. Under 767px 1 column is shown.', 'creatus'),
				'value' => array(
					'columns' => 3,
					'gutter' => 30,
					'minwidth' => 200,
					'isotope' => 'packery'
				),
				'thz_options' => array(
					'gutter' => array(
						'type' => 'spinner',
						'title' => esc_html__('Gutter', 'creatus'),
						'addon' => 'px',
						'min' => 0,
						'max' => 200
					),
					'columns' => array(
						'type' => 'select',
						'title' => esc_html__('Columns', 'creatus'),
						'choices' => array(
							'1' => esc_html__('1', 'creatus'),
							'2' => esc_html__('2', 'creatus'),
							'3' => esc_html__('3', 'creatus'),
							'4' => esc_html__('4', 'creatus'),
							'5' => esc_html__('5', 'creatus'),
							'6' => esc_html__('6', 'creatus')
						)
					),
					'minwidth' => array(
						'type' => 'spinner',
						'title' => esc_html__('Item min width', 'creatus'),
						'addon' => 'px',
					),
					'isotope' => array(
						'type' => 'short-select',
						'title' => esc_html__('Isotope mode', 'creatus'),
						'choices' => array(
							'packery' => esc_html__('Packery ( Masonry, place items where they fit )', 'creatus'),
							'fitRows' => esc_html__('fitRows ( Row height by tallest item in row )', 'creatus'),
							'vertical' => esc_html__('Vertical ( best with 1 column grid ) ', 'creatus'),
						)
					),
				)
			),
			'cmx' => _thz_container_metrics_defaults()
		)
	),
	'slidertab' => array(
		'title' => __('Slider settings', 'creatus'),
		'type' => 'tab',
		'li-attr' => array(
			'class' => 'thz-tab-slider-li'
		),
		'lazy_tabs' => false,
		'options' => array(	

			fw()->theme->get_options( 'slider_settings')
		)
	),	
	'mediaboxtab' => array(
		'title' => __('Media box', 'creatus'),
		'type' => 'tab',
		'lazy_tabs' => false,
		'options' => array(
			'use_poster' => array(
				'label' => __('Media posters', 'creatus'),
				'desc' => esc_html__('Activate media posters for all media types except images. See help for more info. ', 'creatus'),
				'help' => esc_html__('If this option is inactive, all videos and iframes load on pageload and increase page load time. This option adds a preview poster which than activates the media on click. ', 'creatus'),
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
			'grayscale' => array(
				'label' => __('Media grayscale', 'creatus'),
				'desc' => esc_html__('Add grayscale effect to media images', 'creatus'),
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
			'media_bs' => array(
				'type' => 'thz-box-style',
				'label' => __('Media box style', 'creatus'),
				'preview' => true,
				'button-text' => esc_html__('Customize media box style', 'creatus'),
				'desc' => esc_html__('Adjust .thz-media-item-media box style', 'creatus'),
				'help' => esc_html__('Known issue: If layout mode is slider and you add box-shadow to container, the box shadow is cut off due to sliders overflow hidden. One way to fix this is to add margin in the size of box shadow to the media container.', 'creatus'),
				'popup' => true,
				'disable' => array(
					'video',
					'layout',
					'transform',
				),
				'units' => array(
					'borderradius',
					'boxsize',
					'padding',
					'margin',
				),
				'value' => array()
			),
			'media_size' => array(
				'label' => __('Image size', 'creatus'),
				'desc' => esc_html__('Select the image size to be used in gallery.', 'creatus'),
				'value' => 'thz-img-medium',
				'type' => 'short-select',
				'choices' => thz_get_image_sizes_list()
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
						'value' => 'thz-ratio-1-1',
						'choices' => array(
							array( // optgroup
								'attr' => array(
									'label' => __('Misc', 'creatus')
								),
								'choices' => array(
									'auto' => esc_html__('Auto ( masonry if grid layout )', 'creatus'),
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
							'value' => 350,
							'desc' => esc_html__('Media container height. ', 'creatus')
						)
					)
				)
			),

		)
	),
	'mediatab' => array(
		'title' => __('Media', 'creatus'),
		'type' => 'tab',
		'lazy_tabs' => false,
		'options' => array(
			'post_media' => array(
				'type' => 'addable-popup',
				'value' => array(),
				'label' => __('Media items', 'creatus'),
				'desc' => esc_html__('Drag and drop to reorder', 'creatus'),
				'template' => '{{ thz.thz_popup_thumbs_template(type.picked,media_title,\''.$thumbsize.'\',type[type.picked].media,_context) }}',
				'popup-title' => null,
				'size' => 'large',
				'add-button-text' => esc_html__('Add/edit media items', 'creatus'),
				'sortable' => true,
				'popup-options' => array(
					'pid' => array(
						'type' => 'unique',
						'length' => 8
					),
					'media_title' => array(
						'type' => 'short-text',
						'label' => __('Sorting title', 'creatus'),
						'value' => '',
						'desc' => esc_html__('This option is used in popup option type for easy sorting', 'creatus')
					),
					'category' => array(
						'type' => 'text',
						'label' => __('Media category', 'creatus'),
						'value' => '',
						'desc' => esc_html__('This option is used by media filter. See help for more info', 'creatus'),
						'help' => esc_html__('If media is "Images", all images are assigned to this category. Use comma separated values for multiple item categories, eg: Category 1, Category 2', 'creatus')
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
								'value' => 'images',
								'choices' => array(
									'images' => esc_html__('Multiple Images', 'creatus'),
									'image' => esc_html__('Single image', 'creatus'),
									'vimeo' => esc_html__('Vimeo', 'creatus'),
									'youtube' => esc_html__('Youtube', 'creatus'),
									'html5video' => esc_html__('Html5 Video', 'creatus'),
									'html5audio' => esc_html__('Html5 Audio', 'creatus'),
									'iframe' => esc_html__('Iframe/Embed', 'creatus'),
									'oembed' => esc_html__('oEmbed', 'creatus'),
									'selfvideo' => esc_html__('Self hosted video', 'creatus'),
									'selfaudio' => esc_html__('Self hosted audio', 'creatus'),
									'flickr' => esc_html__('Flickr', 'creatus'),
									'instagram' => esc_html__('Instagram', 'creatus')
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
								),
								
								'link' => array(
									'label' => __('Link mode', 'creatus'),
									'desc' => __('Select images link mode', 'creatus'),
									'type' => 'select',
									'value' => 'p',
									'choices' => array(
										'p' => __('Open images in popup', 'creatus'),
										'h' => __('Dead link', 'creatus'),
										'd' => __('No link', 'creatus'),
									)
								),
							),
							'image' => array(
								'media' => array(
									'label' => __('Select image', 'creatus'),
									'type' => 'upload',
									'images_only' => true,
									'desc' => esc_html__('Select or upload an image.', 'creatus')
								),
								'link' => array(
									'label' => __('Add custom link', 'creatus'),
									'desc' => esc_html__('Add custom link for this image', 'creatus'),
									'help' => esc_html__('By default all media items open up in a media gallery, this option will let you add a custom link for this image.', 'creatus'),
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
								'qtitle' => array(
									'type' => 'text',
									'label' => __('Popup title', 'creatus'),
									'desc' => esc_html__('Add Popup title. See help for more info', 'creatus'),
									'help' => esc_html__('Popup title is used only if Media posters are active. If empty, poster image title is used if available.', 'creatus')
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
									'label' => __('Popup title', 'creatus'),
									'desc' => esc_html__('Add Popup title. See help for more info', 'creatus'),
									'help' => esc_html__('Popup title is used only if Media posters are active. If empty, poster image title is used if available.', 'creatus')
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
									'label' => __('Popup title', 'creatus'),
									'desc' => esc_html__('Add Popup title. See help for more info', 'creatus'),
									'help' => esc_html__('Popup title is used only if Media posters are active. If empty, poster image title is used if available.', 'creatus')
								)
							),
							'html5video' => array(
								'poster' => array(
									'type' => 'upload',
									'value' => array(),
									'label' => __('Poster image', 'creatus'),
									'desc' => esc_html__('Insert a poster image for this media. Used only if Media posters are active.', 'creatus'),
									'images_only' => true
								),
								'media' => array(
									'type' => 'text',
									'label' => __('Insert Video link', 'creatus'),
									'desc' => esc_html__('Paste link to your video file', 'creatus')
								),
								'qtitle' => array(
									'type' => 'text',
									'label' => __('Popup title', 'creatus'),
									'desc' => esc_html__('Add Popup title. See help for more info', 'creatus'),
									'help' => esc_html__('Popup title is used only if Media posters are active. If empty, poster image title is used if available.', 'creatus')
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
									'label' => __('Popup title', 'creatus'),
									'desc' => esc_html__('Add Popup title. See help for more info', 'creatus'),
									'help' => esc_html__('Popup title is used only if Media posters are active. If empty, poster image title is used if available.', 'creatus')
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
									'label' => __('Popup title', 'creatus'),
									'desc' => esc_html__('Add Popup title. See help for more info', 'creatus'),
									'help' => esc_html__('Popup title is used only if Media posters are active. If empty, poster image title is used if available.', 'creatus')
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
									'label' => __('Popup title', 'creatus'),
									'desc' => esc_html__('Add Popup title. See help for more info', 'creatus'),
									'help' => esc_html__('Popup title is used only if Media posters are active. If empty, poster image title is used if available.', 'creatus')
								)
							),
							'selfvideo' => array(
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
									'label' => __('Popup title', 'creatus'),
									'desc' => esc_html__('Add Popup title. See help for more info', 'creatus'),
									'help' => esc_html__('Popup title is used only if Media posters are active. If empty, poster image title is used if available.', 'creatus')
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
									'label' => __('Popup title', 'creatus'),
									'desc' => esc_html__('Add Popup title. See help for more info', 'creatus'),
									'help' => esc_html__('Popup title is used only if Media posters are active. If empty, poster image title is used if available.', 'creatus')
								)
							),
							'flickr' => array(
								'api'    => array(
									'type'  => 'text',
									'label' => __( 'API key', 'creatus' ),
									'value' => 'c5125a0fd25d986b2ec17e1c2b5d2c7d',
									'desc'  => sprintf(__('Use this key until you %1s: %2s', 'creatus'),
									'<a href="http://www.flickr.com/services/apps/create/apply" target="_blank">get your own</a>',
									'c5125a0fd25d986b2ec17e1c2b5d2c7d'
									)
								),
								'userid'    => array(
									'type'  => 'text',
									'value' => '',
									'label' => __( 'User ID', 'creatus' ),
									'desc'  => sprintf(__('Get %1s', 'creatus'),'<a href="http://www.webpagefx.com/tools/idgettr/" target="_blank">user ID</a>')
								),
								
								'photoset'    => array(
									'type'  => 'text',
									'value' => '',
									'label' => __( 'Photo set ID', 'creatus' ),
									'desc'  => sprintf(__('Get %1s. If this is used than only images from this photoset are displayed.', 'creatus'),'<a href="https://www.flickr.com/services/api/explore/flickr.photosets.getPhotos" target="_blank">photo set ID</a>')
								),
								'mx' => array(
									'type' => 'thz-multi-options',
									'label' => __('Images metrics', 'creatus'),
									'desc' => __('Adjust Flickr images metrics', 'creatus'),
									'help' => esc_html__('These images are saved by default as expiring transient. If you activate Keep data option than the images are saved in the database without an expiration. This is useful if you want to show same set of images all the time. Note that the first load is always bit slower untill the data is saved.', 'creatus'),
									'value' => array(
										'n' => 6,
										's' => 'b',
										'l' => 'm',
										'k' => 'i',
									),
									'thz_options' => array(
										'n' => array(
											'type' => 'spinner',
											'title' => esc_html__('Images count', 'creatus'),
											'addon' => '#',
										),
										's' => array(
											'type' => 'select',
											'title' => esc_html__('Image size', 'creatus'),
											'choices' => array(
												's' => esc_html__('Small', 'creatus'),
												'm' => esc_html__('Medium', 'creatus'),
												'b' => esc_html__('Large', 'creatus'),
											)
										),
										'l' => array(
											'type' => 'select',
											'title' => esc_html__('Link action', 'creatus'),
											'choices' => array(
												'm' => esc_html__('Open image in modal', 'creatus'),
												'f' => esc_html__('Open image on Flickr', 'creatus'),
											)
										),
										'k' => array(
											'type' => 'select',
											'title' => esc_html__('Keep data', 'creatus'),
											'choices' => array(
												'i' => esc_html__('Inactive', 'creatus'),
												'a' => esc_html__('Active', 'creatus'),
											)
										),							
									)
								),								
							),
							'instagram' => array(
								'userid'    => array(
									'type'  => 'text',
									'value' => '',
									'label' => __( 'User ID', 'creatus' ),
									'desc'  => esc_html__('Enter Instagram user id', 'creatus'),
								),
								'mx' => array(
									'type' => 'thz-multi-options',
									'label' => __('Images metrics', 'creatus'),
									'desc' => __('Adjust Instagram images metrics', 'creatus'),
									'help' => esc_html__('These images are saved by default as expiring transient. If you activate Keep data option than the images are saved in the database without an expiration. This is useful if you want to show same set of images all the time. Note that the first load is always bit slower untill the data is saved.', 'creatus'),
									'value' => array(
										'n' => 6,
										'l' => 'm',
										'k' => 'i',
									),
									'thz_options' => array(
										'n' => array(
											'type' => 'spinner',
											'title' => esc_html__('Images count', 'creatus'),
											'addon' => '#',
										),
										'l' => array(
											'type' => 'select',
											'title' => esc_html__('Link action', 'creatus'),
											'choices' => array(
												'm' => esc_html__('Open image in modal', 'creatus'),
												'f' => esc_html__('Open image on Instagram', 'creatus'),
											)
										),	
										'k' => array(
											'type' => 'select',
											'title' => esc_html__('Keep data', 'creatus'),
											'choices' => array(
												'i' => esc_html__('Inactive', 'creatus'),
												'a' => esc_html__('Active', 'creatus'),
											)
										),						
									)
								),								
							)
						)
					)
				)
			)
		)
	),
	'tabtitlesettings' => array(
		'title' => __('Media Title', 'creatus'),
		'type' => 'tab',
		'options' => array(
			'show_title' => array(
				'type' => 'multi-picker',
				'label' => false,
				'desc' => false,
				'show_borders' => true,
				'picker' => array(
					'picked' => array(
						'label' => __('Show title', 'creatus'),
						'desc' => esc_html__('Show/hide media title', 'creatus'),
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
						'title_bs' => array(
							'type' => 'thz-box-style',
							'label' => __('Title margin', 'creatus'),
							'desc' => esc_html__('Adjust title margin', 'creatus'),
							'popup' => false,
							'disable' => array('layout','padding','borders','borderradius','boxsize','transform','boxshadow','background'),
							'value' => array(
								'margin' => array(
									'top' => 20,
									'right' => 0,
									'bottom' => 0,
									'left' => 0
								)
							)
						),
						'title_f' => array(
							'label' => __('Title font', 'creatus'),
							'desc' => esc_html__('Adjust item title font.', 'creatus'),
							'type' => 'thz-typography',
							'value' => array(
								'size' => 13,
							),
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
			fw()->theme->get_options('additional/lightbox'),
		)
	),
	'overlayoptionstab' => array(
		'title' => __('Media overlay', 'creatus'),
		'type' => 'tab',
		'lazy_tabs' => false,
		'options' => array(
			'over_mode' => array(
				'label' => __('Overlay display mode', 'creatus'),
				'desc' => esc_html__('Select overlay display mode', 'creatus'),
				'type' => 'select',
				'attr' => array(
					'class' => 'thz-select-switch'
				),
				'value' => 'thzhover',
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
			)
		)
	),
	'iconsettings' => array(
		'title' => __('Overlay icon', 'creatus'),
		'type' => 'tab',
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
						'icon_metrics' => array(
							'type' => 'thz-multi-options',
							'label' => __('Icon metrics', 'creatus'),
							'desc' => esc_html__('Adjust icon metrics', 'creatus'),
							'value' => array(
								'ic' => 'thzicon thzicon-plus',
								'pic' => 'thzicon thzicon-play2',
								'aic' => 'thzicon thzicon-musical-note',
								'pa' => 10,
								'fs' => 16,
								'co' => '#ffffff'
							),
							'thz_options' => array(
								'ic' => array(
									'type' => 'icon',
									'title' => esc_html__('Images Icon', 'creatus'),
								),
								'pic' => array(
									'type' => 'icon',
									'title' => esc_html__('Play icon', 'creatus'),
								),
								'aic' => array(
									'type' => 'icon',
									'title' => esc_html__('Audio icon', 'creatus'),
								),
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
	'tabfiltersettings' => array(
		'title' => __('Filter', 'creatus'),
		'type' => 'tab',
		'lazy_tabs' => false,
		'li-attr' => array(
			'class' => 'thz-posts-filter-li'
		),
		'options' => array(
			'filter' => _thz_items_filter_options('hide')
		)
	),
	'mediagaleffects' => array(
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
			'cpx' => _thz_container_parallax_default(),
			'mpx' => _thz_media_parallax_default()
		)
	)
);
