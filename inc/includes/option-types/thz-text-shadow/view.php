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

?>
<div <?php echo fw_attr_to_html($div_attr) ?>>
	<div class="thz-text-shadows-holder">
    	<?php if( !is_customize_preview()){ ?>
    	<div class="thz-text-shadow-preview">
        	<div class="thz-text-shadow-text" contenteditable="true"><?php echo esc_html__('Click to edit sample text','creatus') ?></div>
        </div>
        <div class="thz-text-shadow-preview-colors">
         	<div class="thz-text-shadow-c thz-text-shadow-bg">
                <span class="thz-text-shadow-title"><?php echo esc_html__('Preview bg','creatus') ?></span>
                <?php
                    _thz_remove_name_from_option( fw()->backend->option_type( 'thz-color-picker' )->render(
                        'bg',
                        array(
                            'type'  => 'thz-color-picker',
                            'value' => '#ffffff',
                            'box' => true,
							'attr' => array (
								'class' => 'thz_s_bg'
							)
                        ),
                        array(
                            'value' => '#ffffff',
                            'id_prefix' => '',
                            'name_prefix' => '',
                        )
                    ));			
                ?>
        	</div>
            
        	<div class="thz-text-shadow-c thz-text-shadow-color">
                <span class="thz-text-shadow-title"><?php echo esc_html__('Preview color','creatus') ?></span>
                <?php
                    _thz_remove_name_from_option( fw()->backend->option_type( 'thz-color-picker' )->render(
                        'bg',
                        array(
                            'type'  => 'thz-color-picker',
                            'value' => '#121212',
                            'box' => true,
							'attr' => array (
								'class' => 'thz_s_co'
							)
                        ),
                        array(
                            'value' => '#121212',
                            'id_prefix' => '',
                            'name_prefix' => '',
                        )
                    ));			
                ?>
        	</div>       
        </div>
        <?php } ?>
        <div class="thz-text-shadows-container<?php if( is_customize_preview()){ ?> no-preview<?php } ?>">
		<?php
			$html  = fw()->backend->option_type( 'addable-option' )->render(
			$id.'-shadows',
				array(
					'label' => false,
					'desc'  => false,
					'add-button-text' => esc_html__('Add text shadow', 'creatus'),
					'sortable' => false,
					'value' => $shadowsoption,
					'option' => array( 
						'type' => 'multi',
						'inner-options' => array(
							'h' => array(
								'label' => false,
								'type' => 'thz-spinner',
								'value' => 0,
								'title' => esc_html__('H-offset','creatus'),
								'addon' =>'px',
								'min'=> 'min',
								'attr' => array (
									'class' => 'thz_h_offset'
								)
							),
	
							'v' => array(
								'label' => false,
								'type' => 'thz-spinner',
								'value' => 0,
								'title' => esc_html__('V-offset','creatus'),
								'addon' =>'px',
								'min'=> 'min',
								'attr' => array (
									'class' => 'thz_v_offset'
								)
							),
							
							'b' => array(
								'label' => false,
								'type' => 'thz-spinner',
								'value' => 5,
								'title' => esc_html__('Blur radius','creatus'),
								'addon' =>'px',
								'min' => 0,
								'attr' => array (
									'class' => 'thz_blur_radius'
								)
							),
							'c' => array( 
								'type' => 'thz-color-picker',
								'value' => 'rgba(0,0,0,0.5)',
								'label' => __('Color','creatus'),
								'box' => true,
								'attr' => array (
									'class' => 'thz_shadow_color'
								)
							),
						),
									
					 ),
	
				),
				
				array(
				   'value'		 => $shadowsdata,
				   'id_prefix'   => $data['id_prefix'],
				   'name_prefix' => $data['name_prefix']
				)
			);
			
			$html = str_replace('name=','data-name-removed=',$html);
			echo $html;

		?>
        </div>
		<?php
			echo fw()->backend->option_type( 'hidden' )->render(
				$id,
				array(
					'value' => $defaultoption,
					'type' =>'hidden',
					'attr' => array (
						'class' => 'thz-text-shadow-css'
					)
				),
				array(
				   'value'		 => $defaultdata,
				   'id_prefix'   => $data['id_prefix'],
				   'name_prefix' => $data['name_prefix']
				)

			);	
		?>
	</div>
</div>