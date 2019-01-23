<?php if ( ! defined( 'FW' ) ) { die( 'Forbidden' ); }

/**
 * @var string $id
 * @var  array $option
 * @var  array $data
 */

{
	$div_attr = $option['attr'];

	unset(
		$div_attr['value'],
		$div_attr['name']
	);
	
}
//fw_print($data['value']);

$color_print 	='';
$image_print 	='';
$video_print 	='';
$gradient_print ='';
$shape_print	='';

// color
if(!in_array('color',$option['disable'])){
	$color_print .='<span class="thz-bg-title">'.__('Background color', 'creatus').'</span>';
	$color_print .=	fw()->backend->option_type('thz-color-picker')->render(
					'color',
					array(
						'label' => false,
						'desc'  => false,
						'type' => 'thz-color-picker',
						'value' => $option['value']['color'],
					),
					array(
						'value' => $data['value']['color'],
						'id_prefix' => $option['attr']['id'] . '-thz-background-',
						'name_prefix' => $option['attr']['name'],
					)
				);
}
// image
if(!in_array('image',$option['disable'])){
	$image_print .='<div class="thz-background-image">';
	$image_print .='<span class="thz-bg-title">'. esc_html__('Background image', 'creatus').'</span>';
	$image_print .=	fw()->backend->option_type('thz-image')->render(
							'image',
							array(
								'label' => false,
								'desc'  => false,
								'type' => 'thz-image',
								'value' => $option['value']['image'],
								'featured' => $option['featured'],
							),
							array(
								'value' => $data['value']['image'],
								'id_prefix' => $option['attr']['id'] . '-thz-background-',
								'name_prefix' => $option['attr']['name'],
							)
					);
	$image_print .='</div>';
	
	if(isset($option['value']['repeat']) || isset($option['value']['position'])){
	
		// bg position/repeat
		$image_print .='<div class="thz-bg-group thz-bg-element">';
		
		if(isset($option['value']['repeat'])){
		// bg repeat
		$image_print .='<div class="thz-background-repeat thz-bg-element">';
		$image_print .='<span class="thz-bg-title">'.__('Background repeat', 'creatus').' </span>';
		$image_print .=	fw()->backend->option_type('short-select')->render(
									'repeat',
									array(
										'label' => false,
										'desc'  => false,
										'type'  => 'short-select',
										'value' => $option['value']['repeat'],
										'choices' => array(
											'no-repeat' => esc_html__('No repeat', 'creatus'),
											'repeat' => esc_html__('Repeat', 'creatus'),
											'repeat-x' => esc_html__('Repeat horizontaly', 'creatus'),
											'repeat-y' => esc_html__('Repeat verticaly', 'creatus'),
											
										),
									),
									array(
										'value' => $data['value']['repeat'],
										'id_prefix' => $option['attr']['id'] . '-thz-background-',
										'name_prefix' => $option['attr']['name'],
									)
						);
		$image_print .='</div>';// bg repeat end
		}
		
		if(isset($option['value']['position'])){
			// bg position
			$image_print .='<div class="thz-background-position thz-bg-element">';
			$image_print .='<span class="thz-bg-title">'. esc_html__('Background position', 'creatus').'</span>';
			$image_print .=fw()->backend->option_type('short-select')->render(
										'position',
										array(
											'label' => false,
											'desc'  => false,
											'type'  => 'short-select',
											'value' => $option['value']['position'],
											'choices' => _thz_bg_positions_list(),
										),
										array(
											'value' => $data['value']['position'],
											'id_prefix' => $option['attr']['id'] . '-thz-background-',
											'name_prefix' => $option['attr']['name'],
										)
							);
			$image_print .='</div>';// bg position end
		}
		$image_print .='</div>';// bg position/repeat end
	
	}
	
	
	
	if(isset($option['value']['size'])){
		
		$ok_value = array('auto','cover','contain');
		
		if(in_array($option['value']['size'],$ok_value)){
			$default_value = $option['value']['size'];
		}else{
			$default_value ='custom';
		}
		
		if(in_array($data['value']['size'],$ok_value)){
			$default_data = $data['value']['size'];
		}else{
			$default_data ='custom';
		}
		// bg size/ size custom
		$image_print .='<div class="thz-background-size thz-bg-element">';
		// bg size
		$image_print .='<div class="thz-background-size-radio thz-bg-element">';
		$image_print .='<span class="thz-bg-title">'.__('Background size', 'creatus').' </span>';
		$image_print .=fw()->backend->option_type('thz-radio')->render(
									'size',
									array(
										'label' => false,
										'desc'  => false,
										'type'  => 'thz-radio',
										'value' => $default_value,
										'choices' => array(
											'auto' => esc_html__('Auto', 'creatus'),
											'cover' => esc_html__('Cover', 'creatus'),
											'contain' => esc_html__('Contain', 'creatus'),
											'custom' => esc_html__('Custom value', 'creatus')
										),
										'inline' => true
									),
									array(
										'value' => $default_data,
										'id_prefix' => $option['attr']['id'] . '-thz-background-',
										'name_prefix' => $data['name_prefix'] . '[' . $id . '-radiocheck]',
									)
						);
		$image_print .='</div>';// bg size end
		
		// bg size custom 
		$image_print .='<div class="thz-background-size-text thz-bg-element thz-group-size">';
		$image_print .='<span class="thz-bg-title">'. esc_html__('Custom Background size', 'creatus').'</span>';
		$image_print .= fw()->backend->option_type('text')->render(
									'size',
									array(
										'label' => false,
										'desc'  => false,
										'type'  => 'text',
										'value' => $option['value']['size'],
									),
									array(
										'value' => $data['value']['size'],
										'id_prefix' => $option['attr']['id'] . '-thz-background-',
										'name_prefix' => $option['attr']['name'],
									)
						);
		$image_print .='</div>';// bg size custom end
		$image_print .='</div>';// bg size/size custom end
	}
	
	if(isset($option['value']['attachment'])){
		// bg attachment
		$image_print .='<div class="thz-background-attachment thz-bg-element">';
		$image_print .='<span class="thz-bg-title">'.__('Background attachment', 'creatus').'</span>';
		$image_print .=fw()->backend->option_type('thz-radio')->render(
								'attachment',
								array(
									'label' => false,
									'desc'  => false,
									'type'  => 'thz-radio',
									'value' => $option['value']['attachment'],
									'choices' => array(
										'fixed' => esc_html__('Fixed', 'creatus'),
										'scroll' => esc_html__('Scroll', 'creatus')
									),
									'inline' => true
								),
								array(
									'value' => $data['value']['attachment'],
									'id_prefix' => $option['attr']['id'] . '-thz-background-',
									'name_prefix' => $option['attr']['name'],
								)
						);
		$image_print .='</div>';// bg attachment end
	}

}

if(!in_array('video',$option['disable'])){
	
	// video
	if(isset($option['value']['video-link'])){
		// video link
		$video_print .='<div class="thz-background-video-style thz-bg-video-element">';
		$video_print .='<span class="thz-bg-title">'.__('Insert Youtube video link or upload mp4, ogg, webm', 'creatus').'</span>';
		$video_print .=	fw()->backend->option_type('text')->render(
			'video-link',
			array(
				'label' => false,
				'desc'  => false,
				'type'  => 'text',
				'attr' => array(
					'class' =>'video-input',
					'data-videoid'=> $video_id
				),
				'value' => $option['value']['video-link'],
			),
			array(
				'value' => $data['value']['video-link'],
				'id_prefix' => $option['attr']['id'] . '-thz-background-',
				'name_prefix' => $option['attr']['name'],
			)
		);
		
		$video_print .= fw_html_tag('button', 
			array(
				'type' 		=> 'button',
				'class' 	=> 'button button-primary upload-video',
			), 
			__('Upload video', 'creatus')
		);
		$video_print .='</div>';// video link end
	}
	
	if(isset($option['value']['video-poster'])){
		// video poster
		$video_print .='<div class="thz-background-video-poster thz-bg-video-element">';
		$video_print .='<span class="thz-bg-title">'. esc_html__('Video poster', 'creatus').'</span>';
		$video_print .=	fw()->backend->option_type('thz-image')->render(
				'video-poster',
				array(
					'label' => false,
					'desc'  => false,
					'type' => 'thz-image',
					'value' => $option['value']['video-poster'],
				),
				array(
					'value' => $data['value']['video-poster'],
					'id_prefix' => $option['attr']['id'] . '-thz-background-',
					'name_prefix' => $option['attr']['name'],
				)
			);
		$video_print .='</div>';// video poster end
	}
	
	
	
	if(isset($option['value']['video-sound']) || isset($option['value']['video-loop'])){
		// video sound/loop group
		$video_print .='<div class="thz-background-video-sound thz-bg-video-element">';
		$video_print .='<div class="thz-bg-group thz-bg-element">';
		
		if(isset($option['value']['video-sound'])){
		
			// video sound
			$video_print .='<div class="thz-bg-element">';
			$video_print .='<span class="thz-bg-title">'.__('Video sound', 'creatus').'</span>';
			$video_print .=	fw()->backend->option_type('thz-radio')->render(
				'video-sound',
				array(
					'label' => false,
					'desc'  => false,
					'choices' => array(
						0 => esc_html__('Mute', 'creatus'),
						1 => esc_html__('Play', 'creatus'),
						
					),
					'value' => $option['value']['video-sound'],
					'inline' => true
				),
				array(
					'value' => $data['value']['video-sound'],
					'id_prefix' => $option['attr']['id'] . '-thz-background-',
					'name_prefix' => $option['attr']['name'],
				)
			);
			$video_print .='</div>';// video sound end
		}
		
		if(isset($option['value']['video-loop'])){
			// video loop
			$video_print .='<div class="thz-bg-element">';
			$video_print .='<span class="thz-bg-title">'.__('Video loop', 'creatus').'</span>';
			$video_print .=fw()->backend->option_type('thz-radio')->render(
				'video-loop',
				array(
					'label' => false,
					'desc'  => false,
					'choices' => array(
						1 => esc_html__('Loop', 'creatus'),
						0 => esc_html__('Do not loop', 'creatus'),
					),
					'value' => $option['value']['video-loop'],
					'inline' => true
				),
				array(
					'value' => $data['value']['video-loop'],
					'id_prefix' => $option['attr']['id'] . '-thz-background-',
					'name_prefix' => $option['attr']['name'],
				)
			);
			$video_print .='</div>';// video loop end
		}
	
		$video_print .='</div>';// video sound/loop group end
		$video_print .='</div>';// video sound/loop group end
	}
}
// gradient

if(!in_array('gradient',$option['disable'])){

	// gradient preview
	$gradient_print .=$gradient_preview;
	// gradient style
	$gradient_print .='<div class="thz-background-gradient-style thz-bg-gradient-element">';
	$gradient_print .='<span class="thz-bg-title">'.__('Style', 'creatus').'</span>';
	$gradient_print .=fw()->backend->option_type('thz-radio')->render(
							'gradient-style',
							array(
								'label' => false,
								'desc'  => false,
								'value' => $option['value']['gradient-style'],
								'choices' => array(
									'linear' => esc_html__('Linear', 'creatus'),
									'radial' => esc_html__('Radial', 'creatus')
								),
								'inline' => true
							),
							array(
								'value' => $data['value']['gradient-style'],
								'id_prefix' => $option['attr']['id'] . '-thz-background-',
								'name_prefix' => $option['attr']['name'],
							)
						);
	$gradient_print .='</div>';// gradient style done
	// gradient angle
	$gradient_print .='<div class="thz-background-gradient-angle gradient-group-linear thz-bg-gradient-element">';
	$gradient_print .='<span class="thz-bg-title">'.__('Angle', 'creatus').'</span>';
	$gradient_print .=fw()->backend->option_type('thz-slider')->render(
								'gradient-angle',
								array(
									'label' => false,
									'desc'  => false,
									'value' => $option['value']['gradient-angle'],
									//'above' => true,
									'grid'	=> false,
									'showinput'	=> true,
									'properties' => array(
										'min' => 0,
										'max' => 360,
										'sep' => 1,
									),
								),
	
							array(
								'value' => $data['value']['gradient-angle'],
								'id_prefix' => $option['attr']['id'] . '-thz-background-',
								'name_prefix' => $option['attr']['name'],
							)
						);
	$gradient_print .='</div>';// gradient angle end
	
	// gradient size
	$gradient_print .='<div class="thz-background-gradient-size gradient-group-radial thz-bg-gradient-element">';
	$gradient_print .='<span class="thz-bg-title">'.__('Size', 'creatus').'</span>';
	$gradient_print .=fw()->backend->option_type('thz-radio')->render(
							'gradient-size',
							array(
								'label' => false,
								'desc'  => false,
								'value' => $option['value']['gradient-size'],
								'choices' => array(
									'closest-side' => esc_html__('Closest side', 'creatus'),
									'closest-corner' => esc_html__('Closest corner', 'creatus'),
									'farthest-side' => esc_html__('Farthest side', 'creatus'),
									'farthest-corner' => esc_html__('Farthest corner', 'creatus')
								),
								'inline' => true
							),
	
							array(
								'value' => $data['value']['gradient-size'],
								'id_prefix' => $option['attr']['id'] . '-thz-background-',
								'name_prefix' => $option['attr']['name'],
							)
						);
	$gradient_print .='</div>';// gradient size end
	
	// gradient shape
	$gradient_print .='<div class="thz-background-gradient-shape gradient-group-radial thz-bg-gradient-element">';
	$gradient_print .='<span class="thz-bg-title">'.__('Shape', 'creatus').'</span>';
	$gradient_print .=fw()->backend->option_type('thz-radio')->render(
							'gradient-shape',
							array(
								'label' => false,
								'desc'  => false,
								'value' => $option['value']['gradient-shape'],
								'choices' => array(
									'circle' => esc_html__('Circle', 'creatus'),
									'ellipse' => esc_html__('Ellipse', 'creatus'),
								),
								'inline' => true
							),
	
							array(
								'value' => $data['value']['gradient-shape'],
								'id_prefix' => $option['attr']['id'] . '-thz-background-',
								'name_prefix' => $option['attr']['name'],
							)
						);
	$gradient_print .='</div>';// gradient shape end
	
	
	// gradient v/h position
	$gradient_print .='<div class="thz-gradient-stopbox">';
	// gradient h position
	$gradient_print .='<div class="thz-background-gradient-h-poz gradient-group-radial thz-bg-gradient-element">';
	$gradient_print .='<span class="thz-bg-title">'.__('H-Position', 'creatus').'</span>';
	$gradient_print .=fw()->backend->option_type('thz-slider')->render(
						'gradient-h-poz',
						array(
							'label' => false,
							'desc'  => false,
							'title' => esc_html__('H-Position','creatus'),
							'value' => $option['value']['gradient-h-poz'],
								'grid'	=> false,
								'showinput'	=> true,
								'properties' => array(
									'min' => -100,
									'max' => 100,
									'sep' => 1,
								),
						),
						array(
							'value' => $data['value']['gradient-h-poz'],
							'id_prefix' => $option['attr']['id'] . '-thz-background-',
							'name_prefix' => $option['attr']['name'],
						)
					);
	$gradient_print .='</div>';// gradient h position end
	
	// gradient v position
	$gradient_print .='<div class="thz-background-gradient-v-poz gradient-group-radial thz-bg-gradient-element">';
	$gradient_print .='<span class="thz-bg-title">'.__('V-Position', 'creatus').'</span>';
	$gradient_print .=fw()->backend->option_type('thz-slider')->render(
						'gradient-v-poz',
						array(
							'label' => false,
							'desc'  => false,
							'title' => esc_html__('V-Position','creatus'),
							'value' => $option['value']['gradient-v-poz'],
								'grid'	=> false,
								'showinput'	=> true,
								'properties' => array(
									'min' => -100,
									'max' => 100,
									'sep' => 1,
								),
						),
						array(
							'value' => $data['value']['gradient-v-poz'],
							'id_prefix' => $option['attr']['id'] . '-thz-background-',
							'name_prefix' => $option['attr']['name'],
						)
					);
	$gradient_print .='</div>';// gradient v position end
	$gradient_print .='</div>';// gradient v/h position end
	
	// gradient start
	$gradient_print .='<div class="thz-gradient-stopbox">';
	$gradient_print .='<div class="thz-background-gradient-start thz-bg-gradient-element">';
	$gradient_print .='<span class="thz-bg-title">'.__('Start', 'creatus').'</span>';
	$gradient_print .=fw()->backend->option_type('thz-slider')->render(
						'gradient-start',
						array(
							'label' => false,
							'desc'  => false,
							'title' => esc_html__('Start','creatus'),
							'value' => $option['value']['gradient-start'],
							//'above' => true,
							'grid'	=> false,
							'showinput'	=> true,
							'properties' => array(
								'min' => -100,
								'max' => 100,
								'sep' => 1,
							),
						),
						array(
							'value' => $data['value']['gradient-start'],
							'id_prefix' => $option['attr']['id'] . '-thz-background-',
							'name_prefix' => $option['attr']['name'],
						)
					);
	$gradient_print .='</div>';
	$gradient_print .='<div class="thz-background-gradient-start-color thz-bg-gradient-element">';
	$gradient_print .='<span class="thz-bg-title">'.__('Start color', 'creatus').'</span>';
	$gradient_print .=fw()->backend->option_type('thz-color-picker')->render(
						'gradient-start-color',
						array(
							'label' => false,
							'desc'  => false,
							'value' => $option['value']['gradient-start-color'],
						),
						array(
							'value' => $data['value']['gradient-start-color'],
							'id_prefix' => $option['attr']['id'] . '-thz-background-',
							'name_prefix' => $option['attr']['name'],
						)
					);
	$gradient_print .='</div>';
	$gradient_print .='</div>';// gradient start end
	
	// add stop
	$gradient_print .='<div class="thz-gradient-stopbox">';
	$gradient_print .='<div class="thz-background-gradient-add-stop thz-gradient-element">';
	$gradient_print .=fw()->backend->option_type('addable-option')->render(
						'gradient-add-stop',
							array(
								'label' => false,
								'desc'  => false,
								'value' => fw_akg('gradient-add-stop', $option['value']),
								'option' => array( 
									'type' => 'multi',
									'inner-options' => array(
										'custom-stop-start' => array( 
											'type' => 'thz-slider',
											'label' => __('Stop','creatus'),
											'value' => 50,
											'grid'	=> false,
											'showinput'	=> true,
											'properties' => array(
												'min' => -100,
												'max' => 100,
												'sep' => 1,
											)
										 ),
										'custom-stop-color' => array( 
												'type' => 'thz-color-picker',
												'value' => '#4bb5e6',
												'label' => __('Stop color','creatus'),
										),
									),
									'attr'	=> array(
										'class' => 'thz-bg-multi-gradient'
									),							
							 ),
	
						),
						array(
							'value' => fw_akg('gradient-add-stop', $data['value']),
							'id_prefix' => $option['attr']['id'] . '-thz-background-',
							'name_prefix' => $option['attr']['name'],
						)
					);
	$gradient_print .='</div>';
	$gradient_print .='</div>';// add stop end
	
	// gradient end
	$gradient_print .='<div class="thz-gradient-stopbox">';
	$gradient_print .='<div class="thz-background-gradient-end thz-bg-gradient-element">';
	$gradient_print .='<span class="thz-bg-title">'.__('End', 'creatus').'</span>';
	$gradient_print .=fw()->backend->option_type('thz-slider')->render(
						'gradient-end',
						array(
							'label' => false,
							'desc'  => false,
							'title' => esc_html__('Start','creatus'),
							'value' => $option['value']['gradient-end'],
								'grid'	=> false,
								'showinput'	=> true,
								'properties' => array(
									'min' => -100,
									'max' => 100,
									'sep' => 1,
								),
						),
						array(
							'value' => $data['value']['gradient-end'],
							'id_prefix' => $option['attr']['id'] . '-thz-background-',
							'name_prefix' => $option['attr']['name'],
						)
					);
	$gradient_print .='</div>';
	$gradient_print .='<div class="thz-background-gradient-end-color thz-bg-gradient-element">';
	$gradient_print .='<span class="thz-bg-title">'.__('End color', 'creatus').'</span>';
	$gradient_print .=fw()->backend->option_type('thz-color-picker')->render(
						'gradient-end-color',
						array(
							'label' => false,
							'desc'  => false,
							'value' => $option['value']['gradient-end-color'],
						),
						array(
							'value' => $data['value']['gradient-end-color'],
							'id_prefix' => $option['attr']['id'] . '-thz-background-',
							'name_prefix' => $option['attr']['name'],
						)
					);
	$gradient_print .='</div>';
	$gradient_print .='</div>';// gradient end end

}
// shape
if(!in_array('shape',$option['disable'])){
	//$shape_print .='<div class="thz-background-gradient-style thz-bg-gradient-element">';
	$shape_print .='<span class="thz-bg-title">'.__('Shape metrics', 'creatus').'</span>';
	$shape_print .=	fw()->backend->option_type('thz-multi-options')->render(
					'shape',
					array(
						'label' => false,
						'desc'  => false,
						'type' => 'thz-multi-options',
						'value' => $option['value']['shape'],
						'breakafter' => 'f',
						'thz_options' => array(
							's' => array(
								'title' => esc_html__('Shape', 'creatus'),
								'type' => 'short-select',
								'value' => 'show',
								'choices' => _thz_background_shapes_list($id),
								'attr' => array(
									'class' => 'thz-select-switch'
								),
							),
							'p' => array(
								'title' => esc_html__('Position', 'creatus'),
								'type' => 'short-select',
								'value' => 'show',
								'choices' => array(
									'top' => esc_html__('Top', 'creatus'),
									'center' => esc_html__('Center', 'creatus'),
									'bottom' => esc_html__('Bottom', 'creatus'),
								),
								'attr' => array(
									'class' => $id.'-shape-position thz-shape-poz'
								),
							),
							'f' => array(
								'title' => esc_html__('Flip', 'creatus'),
								'type' => 'short-select',
								'value' => 'show',
								'choices' => array(
									'yes' => esc_html__('Yes', 'creatus'),
									'no' => esc_html__('No', 'creatus'),
								),
								'attr' => array(
									'class' => $id.'-shape-flip'
								),
							),
							'c' => array(
								'type' => 'color',
								'title' => esc_html__('Color', 'creatus'),
								'box' => true,
								'attr' => array(
									'class' => $id.'-shape-color'
								),
							),
							'b' => array(
								'type' => 'color',
								'title' => esc_html__('Background', 'creatus'),
								'box' => true,
								'attr' => array(
									'class' => $id.'-shape-background'
								),
							),
							'w' => array(
								'type' => 'spinner',
								'title' => esc_html__('Width', 'creatus'),
								'addon' => '%',
								'min' => 0,
								'attr' => array(
									'class' => $id.'-shape-width'
								),
							),
							'h' => array(
								'type' => 'spinner',
								'title' => esc_html__('Height', 'creatus'),
								'addon' => 'px',
								'min' => 0,
								'attr' => array(
									'class' => $id.'-shape-height'
								),
							),				
						)
					),
					array(
						'value' => $data['value']['shape'],
						'id_prefix' => $option['attr']['id'] . '-thz-background-',
						'name_prefix' => $option['attr']['name'],
					)
				);
				$shape_print .= '<div class="thz-bg-shape-preview-holder">';
				$shape_print .= '<div class="thz-bg-shape-preview">';
				$shape_print .= '<div class="thz-shape-bglayer">';
				
				foreach ( array_keys( _thz_background_shapes_list() ) as $svg ){
					
					$shape_print .= _thz_output_req_file( thz_theme_file_path('/assets/images/shapes/'.$svg.'.svg') );
					
				}
				$shape_print .= '</div>';
				$shape_print .= '</div>';
				$shape_print .= '</div>';
}

$choices = array();

$choices['none'] 	= esc_html__('None', 'creatus');
if(!empty($color_print) && !in_array('color',$option['disable'])){
	$choices['color'] 	= esc_html__('Color', 'creatus');	
}

if(!empty($image_print) && !in_array('image',$option['disable'])){
	$choices['image'] 	= esc_html__('Image', 'creatus');
}

if(!empty($video_print)  && !in_array('video',$option['disable'])){
	$choices['video'] = esc_html__('Video', 'creatus');	
}
if(!empty($gradient_print) && !in_array('gradient',$option['disable'])){
	$choices['gradient']= esc_html__('Gradient', 'creatus');	
}
if(!empty($shape_print) && !in_array('shape',$option['disable'])){
	$choices['shape']= esc_html__('Shape', 'creatus');	
}
?>
<div <?php echo fw_attr_to_html($div_attr) ?>>
	<div class="thz-background-holder">
		<div class="thz-background-type thz-bg-element">
		<?php
			echo fw()->backend->option_type('thz-radio')->render(
				'type',
				array(
					'label' => false,
					'desc'  => false,
					'type'  => 'thz-radio',
					'attr'	=> array(
						'class' =>'type-trigger'
					),
					'value' => $option['value']['type'],
					'choices' => $choices,
					'inline' => true
				),
				array(
					'value' => $data['value']['type'],
					'id_prefix' => $option['attr']['id'] . '-thz-background-',
					'name_prefix' => $option['attr']['name'] ,
				)
			)
		?>
		</div>
		<?php if(!empty($color_print)){ ?>
		<div class="thz-background-color thz-template-color thz-bg-element thz-group-color thz-group-image thz-group-video" data-options-template="<?php echo fw_htmlspecialchars($color_print )?>"></div>
		<?php } ?>
		
		<?php if(!empty($image_print)){ ?>
		<div class="thz-template-image thz-group-image" data-options-template="<?php echo fw_htmlspecialchars($image_print);?>"></div>
		<?php } ?>
		
		<?php if(!empty($video_print)){ ?>
		<div class="thz-background-video thz-bg-element thz-group-video thz-template-video" data-options-template="<?php echo fw_htmlspecialchars($video_print) ?>"></div>
		<?php } ?>
		<?php if(!empty($gradient_print)){ ?>
		<div class="thz-background-gradient thz-bg-gradient-element thz-group-gradient thz-template-gradient" data-options-template="<?php echo fw_htmlspecialchars($gradient_print)?>">		 </div>
		<?php } ?>
        
		<?php if(!empty($shape_print)){ ?>
		<div class="thz-background-shape thz-template-shape thz-bg-element thz-group-shape" data-options-template="<?php echo fw_htmlspecialchars($shape_print)?>"></div>
		<?php } ?>
	</div>
	<?php
	if($option['print-css']){
		echo fw()->backend->option_type( 'hidden' )->render(
			'css-print',
			array(
				'value' => $optioncss,
				'attr'  => array(
					'class' => 'thz-background-css'
				)
			),
			array(
				'value' => $datacss,
				'id_prefix' => $option['attr']['id'] . '-thz-background-',
				'name_prefix' => $option['attr']['name'] ,
			)
		);	
	}
	?>
</div>