<?php
if (!defined('FW')) {
	die('Forbidden');
}
$member_vars     = fw_get_variables_from_file(dirname(__FILE__) . '/member_settings.php', array(
	'options' => null
));
$member_settings = $member_vars['options'];
$options         = array(
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
				'label' => __('Container box style', 'creatus'),
				'preview' => true,
				'button-text' => esc_html__('Customize container box style', 'creatus'),
				'desc' => esc_html__('Adjust .thz-team-members-holder box style', 'creatus'),
				'popup' => true,
				'disable' => array(
					'video',
					'layout',
					'transform',
					'boxsize'
				),
				'units' => array(
					'borderradius',
					'boxsize',
					'padding',
					'margin',
				),
				'value' => array()
			),
			'in_bs' => array(
				'type' => 'thz-box-style',
				'label' => __('Holder box style', 'creatus'),
				'preview' => true,
				'button-text' => esc_html__('Customize holder box style', 'creatus'),
				'desc' => esc_html__('Adjust .thz-grid-item-in box style', 'creatus'),
				'popup' => true,
				'disable' => array('layout','boxsize','transform','video'),
				'value' => array(),
				'units' => array(
					'borderradius',
					'boxsize',
					'padding',
					'margin',
				),
			),
			'layout' => array(
				'label' => __('Layout mode', 'creatus'),
				'desc' => esc_html__('Select members layout mode', 'creatus'),
				'type' => 'short-select',
				'attr' => array(
					'class' => 'thz-select-switch'
				),
				'value' => 'grid',
				'choices' => array(
					'grid' => array(
						'text' => esc_html__('Grid', 'creatus'),
						'attr' => array(
							'data-enable' => 'grid,animate',
							'data-disable' => '.thz-tab-slider-li'
						)
					),
					'slider' => array(
						'text' => esc_html__('Slider', 'creatus'),
						'attr' => array(
							'data-enable' => '.thz-tab-slider-li',
							'data-disable' => 'grid,animate'
						)
					)
				)
			),
			'grid' => array(
				'type' => 'thz-multi-options',
				'label' => __('Grid settings', 'creatus'),
				'desc' => esc_html__('Adjust grid settings. See help for more info.', 'creatus'),
				'help' => esc_html__('If the .thz-grid-item-in width is less than desired min width, the columns number drops down by one in order to honor the min width setting. This adjustment is active only if image container height is anything else but metro. On the other hand if the window width is below 980px and grid has more than 2 columns, only 2 columns are shown. Under 767px 1 column is shown.', 'creatus'),
				'value' => array(
					'columns' => 3,
					'gutter' => 30,
					'minwidth' => 200,
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
	
	'teammembers' => array(
		'title' => __('Members', 'creatus'),
		'type' => 'tab',
		'lazy_tabs' => false,
		'options' => array(
			'post_media' => array(
				'type' => 'addable-popup',
				'value' => array(),
				'label' => __('Team members', 'creatus'),
				'desc' => esc_html__('Drag and drop to reorder', 'creatus'),
				'template' => '{{= name }}',
				'popup-title' => null,
				'size' => 'large',
				'add-button-text' => esc_html__('Add/edit team member', 'creatus'),
				'sortable' => true,
				'popup-options' => array(
					$member_settings
				)
			)
		)
	),
	'membersmode' => array(
		'title' => __('Members mode', 'creatus'),
		'type' => 'tab',
		'lazy_tabs' => false,
		'options' => array(
			'over_mode' => array(
				'label' => __('Display mode', 'creatus'),
				'desc' => esc_html__('Select members display mode', 'creatus'),
				'type' => 'select',
				'attr' => array(
					'class' => 'thz-select-switch'
				),
				'value' => 'infounder',
				'choices' => array(
					'infounder' => array(
						'text' => esc_html__(' Info under the image', 'creatus'),
						'attr' => array(
							'data-enable' => '#thz-hover-med_over-oeffect,#thz-hover-med_over-ieffect,#thz-hover-med_over-iceffect',
							'data-disable' => 'reveal_effect,info_align'
						)
					),
					'thzhover' => array(
						'text' => esc_html__(' Thz hover ( Info shows on hover )', 'creatus'),
						'attr' => array(
							'data-enable' => 'info_align,#thz-hover-med_over-oeffect,#thz-hover-med_over-ieffect,#thz-hover-med_over-iceffect',
							'data-disable' => 'reveal_effect'
						)
					),
					'reveal' => array(
						'text' => esc_html__('Reveal ( Info hides on hover )', 'creatus'),
						'attr' => array(
							'data-enable' => 'info_align,reveal_effect,#thz-hover-med_over-ieffect',
							'data-disable' => '#thz-hover-med_over-oeffect,#thz-hover-med_over-iceffect'
						)
					),
					'directional' => array(
						'text' => esc_html__('Directional ( Info shows on hover )', 'creatus'),
						'attr' => array(
							'data-enable' => 'info_align,#thz-hover-med_over-ieffect',
							'data-disable' => 'reveal_effect,#thz-hover-med_over-oeffect,#thz-hover-med_over-iceffect'
						)
					)
				)
			),
			'info_align' => array(
				'label' => __('Info box alignment', 'creatus'),
				'desc' => esc_html__('Align info box.', 'creatus'),
				'value' => 'middle',
				'type' => 'short-select',
				'inline' => true,
				'choices' => array(
					'top' => esc_html__('Top', 'creatus'),
					'middle' => esc_html__('Middle', 'creatus'),
					'bottom' => esc_html__('Bottom', 'creatus')
				)
			),
			'reveal_effect' => array(
				'type' => 'thz-multi-options',
				'label' => __('Overlay effect', 'creatus'),
				'desc' => esc_html__('Select overlay hover effect and duration', 'creatus'),
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
					'background' => esc_html__('Overlay background', 'creatus'),
					'overlay' => esc_html__('Overlay effect', 'creatus'),
					'image' => esc_html__('Image effect', 'creatus'),
					'icons' => esc_html__('Overlay element effect', 'creatus')
				),
				'descriptions' => array(
					'background' => esc_html__('Set overlay background', 'creatus'),
					'overlay' => esc_html__('Select overlay hover effect and duration', 'creatus'),
					'image' => esc_html__('Select image hover effect and duration', 'creatus'),
					'icons' => esc_html__('Select overlay element hover effect and duration', 'creatus')
				),
				'label' => false,
				'desc' => false
			),
			'distance' => array(
				'type' => 'thz-spinner',
				'label' => __('Overlay distance', 'creatus'),
				'desc' => esc_html__('Distance the overlay from image box edges', 'creatus'),
				'addon' => 'px',
				'min' => 0,
				'max' => 200,
				'value' => '0'
			)
		)
	),
	'imageboxtab' => array(
		'title' => __('Image container', 'creatus'),
		'type' => 'tab',
		'lazy_tabs' => false,
		'options' => array(
			'media_bs' => array(
				'type' => 'thz-box-style',
				'label' => __('Image box style', 'creatus'),
				'preview' => true,
				'button-text' => esc_html__('Customize image box style', 'creatus'),
				'desc' => esc_html__('Adjust .thz-team-member-media box style', 'creatus'),
				'help' => esc_html__('Known issue: If layout mode is slider and you add box-shadow to container, the box shadow is cut off due to sliders overflow hidden. One way to fix this is to add margin in the size of box shadow to the image container.', 'creatus'),
				'popup' => true,
				'disable' => array(
					'video',
					'layout',
					'transform',
					'boxsize'
				),
				'value' => array()
			),
			'grayscale' => array(
				'label' => __('Image grayscale', 'creatus'),
				'desc' => esc_html__('Add grayscale effect to member image', 'creatus'),
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
			'media_size' => array(
				'label' => __('Image size', 'creatus'),
				'desc' => esc_html__('Select the member image size.', 'creatus'),
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
						'label' => __('Image container height', 'creatus'),
						'desc' => esc_html__('Set image container height.', 'creatus'),
						'type' => 'select',
						'value' => 'thz-ratio-1-1',
						'choices' => array(
							array( // optgroup
								'attr' => array(
									'label' => __('Misc', 'creatus')
								),
								'choices' => array(
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
							'max' => 1000,
							'label' => '',
							'value' => 350,
							'desc' => esc_html__('Media container height. ', 'creatus')
						)
					)
				)
			)
		)
	),
	'tabcontainers' => array(
		'title' => __('Info containers', 'creatus'),
		'type' => 'tab',
		'lazy_tabs' => false,
		'options' => array(
			'ibs' => array(
				'type' => 'thz-box-style',
				'label' => __('Info box style', 'creatus'),
				'preview' => true,
				'button-text' => esc_html__('Customize team member info box style', 'creatus'),
				'desc' => esc_html__('Adjust .thz-team-member-info box style', 'creatus'),
				'popup' => true,
				'disable' => array(
					'video'
				),
				'value' => array(
					'padding' => array(
						'top' => 15,
						'right' => 0,
						'bottom' => 0,
						'left' => 0
					)
				)
			),
			'nbs' => array(
				'type' => 'thz-box-style',
				'label' => __('Name box style', 'creatus'),
				'preview' => true,
				'button-text' => esc_html__('Customize team member name box style', 'creatus'),
				'desc' => esc_html__('Adjust .thz-team-member-name box style', 'creatus'),
				'popup' => true,
				'disable' => array(
					'video'
				),
				'value' => array()
			),
			'jbs' => array(
				'type' => 'thz-box-style',
				'label' => __('Job box style', 'creatus'),
				'preview' => true,
				'button-text' => esc_html__('Customize team member job box style', 'creatus'),
				'desc' => esc_html__('Adjust .thz-team-member-job box style', 'creatus'),
				'popup' => true,
				'disable' => array(
					'video'
				),
				'value' => array(
					'margin' => array(
						'top' => 0,
						'right' => 0,
						'bottom' => 15,
						'left' => 0
					)
				)
			),
			'dbs' => array(
				'type' => 'thz-box-style',
				'label' => __('Description box style', 'creatus'),
				'preview' => true,
				'button-text' => esc_html__('Customize team member description box style', 'creatus'),
				'desc' => esc_html__('Adjust .thz-team-member-description box style', 'creatus'),
				'popup' => true,
				'disable' => array(
					'video'
				),
				'value' => array(
					'margin' => array(
						'top' => 0,
						'right' => 0,
						'bottom' => 15,
						'left' => 0
					)
				)
			),
			'sbs' => array(
				'type' => 'thz-box-style',
				'label' => __('Socials box style', 'creatus'),
				'preview' => true,
				'button-text' => esc_html__('Customize team member socials box style', 'creatus'),
				'desc' => esc_html__('Adjust .thz-team-member-socials box style', 'creatus'),
				'popup' => true,
				'disable' => array(
					'video'
				),
				'value' => array()
			)
		)
	),
	'typotab' => array(
		'title' => __('Typography', 'creatus'),
		'type' => 'tab',
		'options' => array(
			'nf' => array(
				'label' => __('Name font', 'creatus'),
				'desc' => esc_html__('Adjust member name font.', 'creatus'),
				'type' => 'thz-typography',
				'value' => array(
					'size' => 16,
				),
				'disable' => array('hovered')
			),
			'jf' => array(
				'label' => __('Job font', 'creatus'),
				'desc' => esc_html__('Adjust member job font.', 'creatus'),
				'type' => 'thz-typography',
				'value' => array(
					'size' => 13,
				),
				'disable' => array('hovered')
			),
			'df' => array(
				'label' => __('Description font', 'creatus'),
				'desc' => esc_html__('Adjust member description font.', 'creatus'),
				'type' => 'thz-typography',
				'value' => array(),
				'disable' => array('hovered')
			),
			'im' => array(
				'type' => 'thz-multi-options',
				'label' => __('Social links metrics', 'creatus'),
				'desc' => esc_html__('Adjust social links metrics', 'creatus'),
				'help' => esc_html__('Style color is used depending on the icon style. If outline, color is used for shape outline border, if flat, color is used as shape background color. Each member icon color setting will overide colors set here.', 'creatus'),
				'value' => array(
					'f' => 14,
					'sp' => 20,
					'a' => 'thz-align-none',
					's' => 'simple',
					'sh' => 'square',
					'r' => 2,
					'dl' => '',
					'dh' => '',
					'ds' => '',
					'dsh' => ''
				),
				'breakafter' => 'r',
				'thz_options' => array(
					'f' => array(
						'type' => 'spinner',
						'title' => esc_html__('Icon size', 'creatus'),
						'addon' => 'px',
						'min' => 0,
					),
					'sp' => array(
						'type' => 'spinner',
						'title' => esc_html__('Icons space', 'creatus'),
						'addon' => 'px',
						'min' => 0
					),
					'a' => array(
						'type' => 'short-select',
						'title' => esc_html__('Align', 'creatus'),
						'choices' => array(
							'thz-align-none' => esc_html__('Default', 'creatus'),
							'thz-align-left' => esc_html__('Left', 'creatus'),
							'thz-align-right' => esc_html__('Right', 'creatus'),
							'thz-align-center' => esc_html__('Center', 'creatus')
						)
					),
					's' => array(
						'type' => 'short-select',
						'title' => esc_html__('Style', 'creatus'),
						'attr' => array(
							'class' => 'thz-select-switch'
						),
						'choices' => array(
							'simple' => array(
								'text' => esc_html__('Simple', 'creatus'),
								'attr' => array(
									'data-disable' => '.socs-s-sh-parent,.socs-s-r-parent,.socs-s-ds-parent,.socs-s-dsh-parent'
								)
							),
							'outline' => array(
								'text' => esc_html__('Outline', 'creatus'),
								'attr' => array(
									'data-enable' => '.socs-s-sh-parent,.socs-s-r-parent,.socs-s-ds-parent,.socs-s-dsh-parent'
								)
							),
							'flat' => array(
								'text' => esc_html__('Flat', 'creatus'),
								'attr' => array(
									'data-enable' => '.socs-s-sh-parent,.socs-s-r-parent,.socs-s-ds-parent,.socs-s-dsh-parent'
								)
							)
						)
					),
					'sh' => array(
						'type' => 'short-select',
						'title' => esc_html__('Shape', 'creatus'),
						'choices' => array(
							'circle' => esc_html__('Circle', 'creatus'),
							'square' => esc_html__('Square', 'creatus'),
							'rounded' => esc_html__('Rounded', 'creatus')
						),
						'attr' => array(
							'class' => 'socs-s-sh'
						),
					),
					'r' => array(
						'type' => 'spinner',
						'title' => esc_html__('Shape ratio', 'creatus'),
						'addon' => 'X',
						'attr' => array(
							'class' => 'socs-s-r'
						),
					),
					
					'dl' => array(
						'type' => 'color',
						'title' => esc_html__('Color', 'creatus'),
						'box' => true
					),
					'dh' => array(
						'type' => 'color',
						'title' => esc_html__('Hovered', 'creatus'),
						'box' => true
					),
					'ds' => array(
						'type' => 'color',
						'title' => esc_html__('Style color', 'creatus'),
						'box' => true,
						'attr' => array(
							'class' => 'socs-s-ds'
						),
					),
					'dsh' => array(
						'type' => 'color',
						'title' => esc_html__('Style hovered', 'creatus'),
						'box' => true,
						'attr' => array(
							'class' => 'socs-s-dsh'
						),
					)
				)
			),
			
		)
	),
	
	'memberseffects' => array(
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
				'addlabel' => esc_html__('Animate members', 'creatus'),
				'adddesc' => esc_html__('Add animation to the member HTML container', 'creatus')
			),
			'cpx' => _thz_container_parallax_default(),
			'mpx' => _thz_media_parallax_default()
		)
	)
);
