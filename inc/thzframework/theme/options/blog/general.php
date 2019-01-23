<?php
if (!defined('FW'))
	die('Forbidden');
	
$is_archive_settings = isset($archives_settings) ? $archives_settings : false;

$label 	= esc_html__('Blog layout type', 'creatus');
$desc 	= esc_html__('Select blog layout type', 'creatus');

if($is_archive_settings){
	
	$label 	= esc_html__('Archives layout type', 'creatus');
	$desc 	= esc_html__('Select archives layout type', 'creatus');	
	
}

$options = array(
	'blog_layout_type' => array(
		'type' => 'multi-picker',
		'label' => false,
		'desc' => false,
		'show_borders' => true,
		'picker' => array(
			'picked' => array(
				'label' => $label,
				'desc' => $desc,
				'value' => 'classic',
				'type' => 'short-select',
				'choices' => array(
					'classic' => esc_html__('Classic', 'creatus'),
					'grid' => esc_html__('Grid', 'creatus'),
					'timeline' => esc_html__('Timeline', 'creatus')
				)
			)
		),
		'choices' => array(
			'classic' => array(
				'ma' => array(
					'label' => __('Post media alignment', 'creatus'),
					'type' => 'image-picker',
					'value' => 'full',
					'desc' => esc_html__('Select post media container alignment', 'creatus'),
					'attr' => array(
						'class' => 'thz-select-switch'
					),
					'choices' => array(
						'left' => array(
							'small' => array(
								'height' => 50,
								'src' => thz_theme_file_uri('/inc/thzframework/admin/images/post_media_left.jpg')
							),
							'attr' => array(
								'data-enable' => '.clsidemx-parent',
								'data-disable' => '.clabovemx-parent',
							),
						),
						'full' => array(
							'small' => array(
								'height' => 50,
								'src' => thz_theme_file_uri('/inc/thzframework/admin/images/post_media_full.jpg')
							),
							'attr' => array(
								'data-enable' => '.clabovemx-parent',
								'data-disable' => '.clsidemx-parent',
							),
						),
						'right' => array(
							'small' => array(
								'height' => 50,
								'src' => thz_theme_file_uri('/inc/thzframework/admin/images/post_media_right.jpg')
							),
							'attr' => array(
								'data-enable' => '.clsidemx-parent',
								'data-disable' => '.clabovemx-parent',
							),
						),
	
					),
				),
				'mx' => array(
					'type' => 'thz-multi-options',
					'label' => __('Posts metrics', 'creatus'),
					'desc' => esc_html__('Adjust media container metrics. See help for more info.', 'creatus'),
					'help' => sprintf( esc_html__('Posts space is vertical space between the posts.%1$sMedia width sets media container at the defined percentage width.%1$sV-align verticaly aligns the post intro text.%1$sAlternate sets every second post media container to the oposite side of the previous post.%1$sTitle and meta options set the title and or meta at the desired position.', 'creatus') ,'<br />'),
					'value' => array(
						's' => 75,
						'title' => 'under',
						'meta' => 'under',
						'w' => 40,
						'a' => 'inactive',
						'va' => 'middle',
						
					),
					'thz_options' => array(
						's' => array(
							'type' => 'spinner',
							'title' => esc_html__('Posts space', 'creatus'),
							'addon' => 'px',
	
						),
						'w' => array(
							'type' => 'spinner',
							'title' => esc_html__('Media width', 'creatus'),
							'addon' => '%',
							'attr' => array(
								'class' => 'clsidemx'
							),
						),
						'a' => array(
							'type' => 'short-select',
							'title' => esc_html__('Alternate', 'creatus'),
							'choices' => array(
								'inactive' => esc_html__('Do not Alternate', 'creatus'),
								'active' => esc_html__('Alternate', 'creatus')
							),
							'attr' => array(
								'class' => 'clsidemx'
							),
						),
						'va' => array(
							'type' => 'short-select',
							'title' => esc_html__('V-align', 'creatus'),
							'choices' => array(
								'top' => esc_html__('Top', 'creatus'),
								'middle' => esc_html__('Middle', 'creatus'),
								'bottom' => esc_html__('Bottom', 'creatus')
							),
							'attr' => array(
								'class' => 'clsidemx'
							),
						),
						'title' => array(
							'type' => 'short-select',
							'title' => esc_html__('Title', 'creatus'),
							'choices' => array(
								'under' => esc_html__('Under the media', 'creatus'),
								'above' => esc_html__('Above the media', 'creatus')
							),
							'attr' => array(
								'class' => 'clabovemx'
							),
						),
						'meta' => array(
							'type' => 'short-select',
							'title' => esc_html__('Meta', 'creatus'),
							'choices' => array(
								'under' => esc_html__('Under the title', 'creatus'),
								'above' => esc_html__('Above the title', 'creatus')
							),
						)
					)
				)
			),
			'grid' => array(
				'bgrid' => array(
					'type' => 'thz-multi-options',
					'label' => __('Grid settings', 'creatus'),
					'desc' => esc_html__('Adjust grid settings. See help for more info.', 'creatus'),
					'help' => esc_html__('If the .thz-grid-item-in width is less than desired min width, the columns number drops down by one in order to honor the min width setting. On the other hand if the window width is below 980px and grid has more than 2 columns, only 2 columns are shown. Under 767px 1 column is shown.', 'creatus'),
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
				'tm_loc' => array(
					'type' => 'thz-multi-options',
					'label' => __('Title and meta location', 'creatus'),
					'desc' => esc_html__('Set posts title and meta location', 'creatus'),
					'value' => array(
						'title' => 'under',
						'meta' => 'under'
					),
					'thz_options' => array(
						'title' => array(
							'type' => 'short-select',
							'title' => esc_html__('Title', 'creatus'),
							'choices' => array(
								'under' => esc_html__('Under the media', 'creatus'),
								'above' => esc_html__('Above the media', 'creatus')
							)
						),
						'meta' => array(
							'type' => 'short-select',
							'title' => esc_html__('Meta', 'creatus'),
							'choices' => array(
								'under' => esc_html__('Under the title', 'creatus'),
								'above' => esc_html__('Above the title', 'creatus'),
							)
						)
					)
				)
			),
			'timeline' => array(
				'mx' => array(
					'type' => 'thz-multi-options',
					'label' => __('Timeline metrics', 'creatus'),
					'desc' => esc_html__('Adjust timeline layout and colors', 'creatus'),
					'value' => array(
						'c' => 2,
						'w' => 1,
						'r' => 4,
						'b' => '',
						'bg' => '',
						'd' => '',
						'my' => ''
					),
					'thz_options' => array(
						'c' => array(
							'type' => 'select',
							'title' => esc_html__('Columns', 'creatus'),
							'choices' => array(
								'1' => esc_html__('1', 'creatus'),
								'2' => esc_html__('2', 'creatus')
							)
						),
						'w' => array(
							'type' => 'select',
							'title' => esc_html__('Borders width', 'creatus'),
							'choices' => array(
								'1' => esc_html__('1', 'creatus'),
								'2' => esc_html__('2', 'creatus'),
								'3' => esc_html__('3', 'creatus'),
							)
						),
						'r' => array(
							'type' => 'spinner',
							'title' => esc_html__('Date radius', 'creatus'),
							'addon' => 'px',
							'min' => 0,
							'max' => 20,
						),
						'b' => array(
							'type' => 'color',
							'title' => esc_html__('Borders', 'creatus'),
							'box' => true
						),
						'bg' => array(
							'type' => 'color',
							'title' => esc_html__('Backgrounds', 'creatus'),
							'box' => true
						),
						'd' => array(
							'type' => 'color',
							'title' => esc_html__('Day', 'creatus'),
							'box' => true
						),
						'my' => array(
							'type' => 'color',
							'title' => esc_html__('Month&year', 'creatus'),
							'box' => true
						)
					)
				),
				'tm_loc' => array(
					'type' => 'thz-multi-options',
					'label' => __('Title and meta location', 'creatus'),
					'desc' => esc_html__('Set posts title and meta location', 'creatus'),
					'value' => array(
						'title' => 'under',
						'meta' => 'under'
					),
					'thz_options' => array(
						'title' => array(
							'type' => 'short-select',
							'title' => esc_html__('Title', 'creatus'),
							'choices' => array(
								'under' => esc_html__('Under the media', 'creatus'),
								'above' => esc_html__('Above the media', 'creatus')
							)
						),
						'meta' => array(
							'type' => 'short-select',
							'title' => esc_html__('Meta', 'creatus'),
							'choices' => array(
								'under' => esc_html__('Under the title', 'creatus'),
								'above' => esc_html__('Above the title', 'creatus')
							)
						)
					)
				)
			)
		)
	),
	'posts_pagination' => array(
		'type' => 'multi-picker',
		'label' => false,
		'desc' => false,
		'picker' => array(
			'picked' => array(
				'label' => __('Pagination type', 'creatus'),
				'desc' => esc_html__('Select posts pagination type', 'creatus'),
				'type' => 'radio',
				'value' => 'pagination',
				'choices' => array(
					'click' => esc_html__('On click ( ajax ) ', 'creatus'),
					'scroll' => esc_html__('On scroll ( ajax )', 'creatus'),
					'pagination' => esc_html__('Pagination', 'creatus'),
					'none' => esc_html__('None ( no pagination )', 'creatus')
				),
				'inline' => true
			)
		),
		'choices' => array(
			'click' => array(
				'items_load' => array(
					'type' => 'thz-spinner',
					'addon' => '#',
					'min' => -1,
					'max' => 100,
					'label' => __('Number of posts', 'creatus'),
					'value' => 4,
					'desc' => esc_html__('Number of posts to load on more button click.( -1 = all )', 'creatus')
				),
				'more_button' => array(
					'type' => 'popup',
					'size' => 'large',
					'label' => __('Load more button', 'creatus'),
					'button' => esc_html__('Edit load more button', 'creatus'),
					'popup-title' => esc_html__('More button settings', 'creatus'),
					'popup-options' => array(
						'button' => array(
							'type' => 'thz-button',
							'value' => array(
								'activeColor' => 'theme',
								'buttonText' => 'Load more',
								'html' => '<div class="thz-btn-container"><a class="thz-button thz-btn-theme thz-btn-normal thz-radius-4 thz-btn-border-1 thz-align-center" href="#"><span class="thz-btn-text thz-fs-14 thz-fw-400">Load more</span></a></div>'
							),
							'label' => false,
							'hidelinks' => true
						)
					)
				)
			),
			'scroll' => array(
				'items_load' => array(
					'type' => 'thz-spinner',
					'addon' => '#',
					'min' => -1,
					'max' => 100,
					'label' => __('Number of posts', 'creatus'),
					'value' => 4,
					'desc' => esc_html__('Number of posts to load on scroll.( -1 = all )', 'creatus')
				)
			)
		)
	),
	'posts_animate' => array(
		'type' => 'thz-animation',
		'label' => false,
		'value' => array(
			'animate' => 'inactive',
			'effect' => 'thz-anim-fadeIn',
			'duration' => 700,
			'delay' => 100
		),
		'addlabel' => esc_html__('Animate posts', 'creatus'),
		'adddesc' => esc_html__('Add animation to the posts HTML container', 'creatus')
	)
);