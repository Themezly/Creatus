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
	<div class="thz-shadows-holder">
		<?php
			echo fw()->backend->option_type( 'addable-option' )->render(
			$id,
				array(
					'label' => false,
					'desc'  => false,
					'add-button-text' => esc_html__('Add boxshadow', 'creatus'),
					'sortable' => true,
					'value' => $defaultoption,
					'option' => array( 
						'type' => 'multi',
						'inner-options' => array(
							'inset' => array( 
								'type' => 'checkbox',
								'value' => false,
								'label' => __('Inset','creatus'),
								'attr' => array (
									'class' => 'thz_shadow_inset'
								)
							),
							'horizontal-offset' => array(
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
	
							'vertical-offset' => array(
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
							
							'blur-radius' => array(
								'label' => false,
								'type' => 'thz-spinner',
								'value' => 5,
								'title' => esc_html__('Blur radius','creatus'),
								'addon' =>'px',
								'min'=> 'min',
								'attr' => array (
									'class' => 'thz_blur_radius'
								)
							),
							
							'spread-radius' => array(
								'label' => false,
								'type' => 'thz-spinner',
								'value' => 0,
								'title' => esc_html__('Spread radius','creatus'),
								'addon' =>'px',
								'min'=> 'min',
								'attr' => array (
									'class' => 'thz_spread_radius'
								)
							),
	
							
							'shadow-color' => array( 
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
				   'value'		 => $defaultdata,
				   'id_prefix'   => $data['id_prefix'],
				   'name_prefix' => $data['name_prefix']
				)
			);
		?>
		<?php
			echo fw()->backend->option_type( 'hidden' )->render(
				'box_shadow_css',
				array(
					'value' => fw_akg('box_shadow_css',$option['value']),
					'attr' => array (
						'class' => 'thz-box-shadow-css'
					)
				),
				array(
					'value' => fw_akg('box_shadow_css',$data['value']),
					'id_prefix' => $option['attr']['id'] . '-box_shadow_css-',
					'name_prefix' => $option['attr']['name'] ,
				)
			);	
		?>
	</div>
</div>