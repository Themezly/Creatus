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
$div_attr['class'] .=' connect-text-shadow';

?>
<div <?php echo fw_attr_to_html($div_attr) ?>>
	<!-- .thz-fontbox -->
	<div class="thz-fontbox<?php echo $extra_class?>">
		<?php if (!in_array('family',$option['disable'])) :?>
		<div class="thz-typography-group font-input thz-typo-input" data-name="family">
			<span><?php echo esc_html__('Family','creatus') ?></span>
			<?php
				_thz_remove_name_from_option( fw()->backend->option_type( 'short-text' )->render(
					'family',
					array(
						'type'  => 'short-text',
						'value' => fw_akg('family', $option['value']),
						'attr'  => array(
							'class' => 'thz-font-input is-text',
							'readonly'=>'readonly',
							'data-css-prop' => 'font-family'
						 ),
					),
					array(
						'value' => fw_akg('family', $data['value']),
						'id_prefix' => $option['attr']['id'],
						'name_prefix' => $option['attr']['name'],
					)
				) );
										
			?>
		</div>
		<?php endif; ?>

		<?php if (!in_array('size',$option['disable'])) : ?>
		<div class="thz-typography-group size thz-typo-input" data-name="size">
			<?php
			
				if($option['cssclasses']){
					
					_thz_remove_name_from_option( fw()->backend->option_type( 'thz-spinner' )->render(
						'size',
						array(
							'type'  => 'thz-spinner',
							'addon' => 'px',
							'min'	=>  0,
							'max'	=>  $option['sizelimit'],
							'step'	=> 1,
							'value' => fw_akg('size', $option['value']),
							'title' => esc_html__('Size','creatus'),
							'attr'  => array(
								'class' => 'thz-font-size is-text',
								'data-css-prop' => 'font-size'
							 ),
						),
						array(
							'value' => fw_akg('size', $data['value']),
							'id_prefix' => $option['attr']['id'],
							'name_prefix' => $option['attr']['name'],
						)
					));							
					
				}else{
					
					echo '<span>'.esc_html__('Size','creatus').'</span>';
					
					_thz_remove_name_from_option( fw()->backend->option_type( 'short-text' )->render(
						'size',
						array(
							'type'  => 'short-text',
							'value' => fw_akg('size', $option['value']),
							'attr'  => array(
								'class' => 'thz-font-size is-text',
								'data-css-prop' => 'font-size'
							 ),
						),
						array(
							'value' => fw_akg('size', $data['value']),
							'id_prefix' => $option['attr']['id'],
							'name_prefix' => $option['attr']['name'],
						)
					));
				}
										
			?>
		</div>
		<?php endif; ?>
                
		<?php if (!in_array('weight',$option['disable'])) : ?>
		<div class="thz-typography-group weight thz-typo-input" data-name="weight">
			<span class="weight-label"><?php echo ( $variants ) ? 'Variants' : 'Weight'; ?></span>
			<?php
				
				$has_variants = $variants ? ' has-variants' : ' no-variants';
				$weightchoices = array(
					'default' => 'Default',
					'normal' => 'Normal',
					'bold' => 'Bold',
					100 => 100,
					200 => 200,
					300 => 300,
					400 => 400,
					500 => 500,
					600 => 600,
					700 => 700,
					800 => 800,
					900 => 900						
				);
				
				if($variants){
					
					$weightchoices = array();
					foreach ( $variants as $variant ) { 
						$weightchoices[$variant] = ucfirst($variant);
					}
				}
				
				
				_thz_remove_name_from_option( fw()->backend->option_type( 'short-select' )->render(
					'weight',
					array(
						'type'  => 'short-select',
						'value' => (string) fw_akg('weight', $option['value']),
						'choices' => $weightchoices,
						'attr'  => array(
							'class' => 'thz-font-weight is-select '.$has_variants,
							'data-css-prop' => 'font-weight'
						 ),
					),
					array(
						'value' => (string) fw_akg('weight', $data['value']),
						'id_prefix' => $option['attr']['id'],
						'name_prefix' => $option['attr']['name'],
					)
				));
										
			?>
		</div>
		<?php endif; ?>
        
		<?php if (!in_array('style',$option['disable'])) : 
		
		
			$style_display = 'block';
			
			$first_subset = $subsets ? $subsets[0] : false;
		
			if($first_subset =='fsq' || $variants){
				$style_display = 'none';
			}	
				
		
		?>
		<div class="thz-typography-group style thz-typo-input" style="display: <?php echo $style_display; ?>;" data-name="style">
			<span><?php echo esc_html__('Style','creatus') ?></span>
			<?php
				_thz_remove_name_from_option( fw()->backend->option_type( 'short-select' )->render(
					'style',
					array(
						'type'  => 'short-select',
						'value' => fw_akg('style', $option['value']),
						'choices' => array(
							'default'  => __('Default', 'creatus'),
							'normal'  => __('Normal', 'creatus'),
							'italic'  => __('Italic', 'creatus'),
							'oblique' => __('Oblique', 'creatus')						
						 ),
						'attr'  => array(
							'class' => 'thz-font-style is-select',
							'data-css-prop' => 'font-style'
						 ),
					),
					array(
						'value' => fw_akg('style', $data['value']),
						'id_prefix' => $option['attr']['id'],
						'name_prefix' => $option['attr']['name'],
					)
				));
										
			?>
		</div>
		<?php endif; ?>
        
        
			<?php if (!in_array('family',$option['disable'])) : 
					
					
					$subset_display = 'block';
					
					$first_subset = $subsets ? $subsets[0] : false;
					
					if($first_subset =='ffk' && !$variants || !$first_subset){
						$subset_display = 'none';
					}
		
			?>
			<div class="thz-typography-group subset thz-typo-input" style="display: <?php echo $subset_display ; ?>;" data-name="subset">
			<span><?php echo esc_html__('Subset','creatus') ?></span>
			<?php

				$subsetchoices = array();
				
				if ($subsets){
					foreach ( $subsets as $subset ) { 
					
						$subsetchoices[$subset] = ucfirst($subset);
					
					}
				}
				
				_thz_remove_name_from_option( fw()->backend->option_type( 'short-select' )->render(
					'subset',
					array(
						'type'  => 'short-select',
						'value' => fw_akg('subset', $option['value']),
						'choices' => $subsetchoices,
						'attr'  => array(
							'class' => 'thz-font-subset is-select',
							'data-css-prop' => 'font-subset'
						 ),
					),
					array(
						'value' => fw_akg('subset', $data['value']),
						'id_prefix' => $option['attr']['id'],
						'name_prefix' => $option['attr']['name'],
					)
				));
										
			?>
		</div>
		<?php endif; ?>


		<?php if (!in_array('line-height',$option['disable'])) : ?>
		<div class="thz-typography-group lineheight thz-typo-input" data-name="line-height">
			<?php
			
				if($option['cssclasses']){
					
					_thz_remove_name_from_option( fw()->backend->option_type( 'thz-spinner' )->render(
						'line-height',
						array(
							'type'  => 'thz-spinner',
							'addon' => 'px',
							'min'	=>  0,
							'max'	=>  $option['sizelimit'],
							'step'	=> 1,
							'value' => fw_akg('line-height', $option['value']),
							'title' => esc_html__('Line height','creatus'),
							'attr'  => array(
								'class' => 'thz-font-lineheight is-text',
								'data-css-prop' => 'line-height'
							 ),
						),
						array(
							'value' => fw_akg('line-height', $data['value']),
							'id_prefix' => $option['attr']['id'],
							'name_prefix' => $option['attr']['name'],
						)
					));							
					
				}else{
					
					 echo '<span>'.esc_html__('Line height','creatus').'</span>';
					 
					_thz_remove_name_from_option( fw()->backend->option_type( 'short-text' )->render(
						'line-height',
						array(
							'type'  => 'short-text',
							'value' => fw_akg('line-height', $option['value']),
							'attr'  => array(
								'class' => 'thz-font-lineheight is-text',
								'data-css-prop' => 'line-height'
							),
						),
						array(
							'value' => fw_akg('line-height', $data['value']),
							'id_prefix' => $option['attr']['id'],
							'name_prefix' => $option['attr']['name'],
						)
					));
				}
			?>
		</div>
		<?php endif; ?>
		<?php if (!in_array('spacing',$option['disable'])) : ?>
		<div class="thz-typography-group letterspacing thz-typo-input" data-name="spacing">
			<?php
			
				if($option['cssclasses']){
					
					_thz_remove_name_from_option( fw()->backend->option_type( 'thz-spinner' )->render(
						'spacing',
						array(
							'type'  => 'thz-spinner',
							'addon' => 'px',
							'min'	=>  -10,
							'max'	=>  50,
							'step'	=> 1,
							'value' => fw_akg('spacing', $option['value']),
							'title' => esc_html__('Spacing','creatus'),
							'attr'  => array(
								'class' => 'thz-letter-spacing is-text',
								'data-css-prop' => 'letter-spacing'
							 ),
						),
						array(
							'value' => fw_akg('spacing', $data['value']),
							'id_prefix' => $option['attr']['id'],
							'name_prefix' => $option['attr']['name'],
						)
					));							
					
				}else{
					
					 echo '<span>'.esc_html__('Spacing','creatus').'</span>';
					_thz_remove_name_from_option( fw()->backend->option_type( 'short-text' )->render(
						'spacing',
						array(
							'type'  => 'short-text',
							'value' => fw_akg('spacing', $option['value']),
							'attr'  => array(
								'class' => 'thz-letter-spacing is-text',
								'data-css-prop' => 'letter-spacing'
							),
	
						),
						array(
							'value' => fw_akg('spacing', $data['value']),
							'id_prefix' => $option['attr']['id'],
							'name_prefix' => $option['attr']['name'],
						)
					));
				}
										
			?>
		</div>
		<?php endif; ?>
        
 		<?php if (!in_array('transform',$option['disable'])) : ?>
		<div class="thz-typography-group transform thz-typo-input" data-name="transform">
			<span><?php echo esc_html__('Transform','creatus') ?></span>
			<?php
				_thz_remove_name_from_option( fw()->backend->option_type( 'short-select' )->render(
					'transform',
					array(
						'type'  => 'short-select',
						'value' => fw_akg('transform', $option['value']),
						'choices' => array(
							'default' => esc_html__('Default','creatus'),
							'uppercase' => esc_html__('Uppercase','creatus'),
							'lowercase' => esc_html__('Lowercase','creatus'),
							'capitalize' => esc_html__('Capitalize','creatus')
						),
						'attr'  => array(
							'class' => 'thz-font-transform is-select',
							'data-css-prop' => 'text-transform'
						 ),
					),
					array(
						'value' => fw_akg('transform', $data['value']),
						'id_prefix' => $option['attr']['id'],
						'name_prefix' => $option['attr']['name'],
					)
				));
										
			?>
		</div>
		<?php endif; ?> 
        
 		<?php if (!in_array('align',$option['disable'])) : ?>
		<div class="thz-typography-group align thz-typo-input" data-name="align">
			<span><?php echo esc_html__('Text align','creatus') ?></span>
			<?php
				_thz_remove_name_from_option( fw()->backend->option_type( 'short-select' )->render(
					'align',
					array(
						'type'  => 'short-select',
						'value' => fw_akg('align', $option['value']),
						'choices' => array(
							'default' => esc_html__('Default','creatus'),
							'left' => esc_html__('Left','creatus'),
							'right' => esc_html__('Right','creatus'),
							'center' => esc_html__('Center','creatus'),
							'justify' => esc_html__('Justify','creatus'),
							'inherit' => esc_html__('Inherit','creatus')
						),
						'attr'  => array(
							'class' => 'thz-font-align is-select',
							'data-css-prop' => 'text-align'
						 ),
					),
					array(
						'value' => fw_akg('align', $data['value']),
						'id_prefix' => $option['attr']['id'],
						'name_prefix' => $option['attr']['name'],
					)
				));
										
			?>
		</div>
		<?php endif; ?>      
        
		<?php if (!in_array('color',$option['disable'])) : ?>
		<div class="thz-typography-group color thz-typo-input" data-name="color">
			<span><?php echo esc_html__('Color','creatus') ?></span>
			<?php
			_thz_remove_name_from_option( fw()->backend->option_type( 'thz-color-picker' )->render(
				'color',
				array(
					'type'  => 'thz-color-picker',
					'value' => fw_akg('color', $option['value']),
					'box'	=> true,
					'attr'  => array(
						'class' => 'thz-font-color',
						'data-css-prop' => 'color'
					 ),
				),
				array(
					'value' => fw_akg('color', $data['value']),
					'id_prefix' => $option['attr']['id'],
					'name_prefix' => $option['attr']['name'],
				)
			));
			?>
		</div>
		<?php endif; ?>
		<?php if (!in_array('hovered',$option['disable'])) : ?>
		<div class="thz-typography-group hovered thz-typo-input" data-name="hovered">
			<span><?php echo esc_html__('Hovered','creatus') ?></span>
			<?php
			_thz_remove_name_from_option( fw()->backend->option_type( 'thz-color-picker' )->render(
				'hovered',
				array(
					'type'  => 'thz-color-picker',
					'value' => fw_akg('hovered', $option['value']),
					'box'	=> true,
					'attr'  => array(
						'class' => 'thz-font-hovered',
						'data-css-prop' => 'hovered'
					 ),
				),
				array(
					'value' => fw_akg('hovered', $data['value']),
					'id_prefix' => $option['attr']['id'],
					'name_prefix' => $option['attr']['name'],
				)
			));
			?>
		</div>
		<?php endif; ?>
        
        
		<?php if (!in_array('text-shadow',$option['disable'])) { 
        
            $data_shadows 	= _thz_build_shadows( fw_akg('text-shadow', $data['value']));
            $hassahdows 	= count($data_shadows) > 0 ? ' show' :'';
        ?>
        <div class="thz-box-holding-text-shadow thz-typo-input" data-name="text-shadow">
            <span class="thz-font-title thz-show-text-shadow">
                <?php echo esc_html__('Show/hide text shadow options','creatus') ?>
                <span class="has-shadows<?php echo $hassahdows ?>">( <?php echo esc_html__('Text shadow is active','creatus') ?> )</span>
            </span>
            <?php
                $text_shadow_html =  fw()->backend->option_type( 'thz-text-shadow' )->render(
                    'text-shadow',
                    array(
                        'type'  => 'thz-text-shadow',
                        'value' => _thz_build_shadows( fw_akg('text-shadow', $option['value'])),
                        'attr' => array(
                            'class' => 'isboxed'
                        )
                    ),
                    array(
                        'value' => $data_shadows,
                        'id_prefix' => $option['attr']['id'] .'-',
                        'name_prefix' => $option['attr']['name'],
                    )
                );		
                echo $text_shadow_html;	
            ?>
        </div>
        <?php } ?>
        
	</div>
	<!-- /.thz-fontbox -->

    <div class="thz-value-data">
	<?php
		echo fw()->backend->option_type( 'hidden' )->render(
			'value_data',
			array(
				'type'  => 'hidden',
				'value' => json_encode( $option['value'],true),
			),
			array(
				'value' => json_encode($data['value'],true),
				'id_prefix' => $option['attr']['id'],
				'name_prefix' => $option['attr']['name'],
			)
		);			
    ?>
    </div>
</div>