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
<div <?php echo fw_attr_to_html($div_attr) ?> >

	<div class="thz-content-layout-typechoice-holder thz-content-row">
	<?php
	
	echo  fw()->backend->option_type('thz-radio')->render(
			'typechoice',
			array(
				'type'  => 'thz-radio',
				'value' => 'grouped',
				'choices' => array(
					'grouped' => esc_html__('Grouped pages', 'creatus'),
					'specific' => esc_html__('Specific pages', 'creatus'),
				),
				'attr'	=> array (
				
					'class' =>'thz-content-layout-typechoice'
				
				),
				'inline' => true
			),
			array(
				'id_prefix' => 'fw-option-' . $id . '-thz-content-layout-',
				'name_prefix' => $data['name_prefix'] . '[' . $id . ']',
			)
		)
	?>
	</div>

	<div class="thz-content-layout-specific-holder thz-content-row">
		<div class="ui-widget fw-border-box-sizing" >
			<input id="thz-content-layout-specific" class="thz-content-layout-specific" type="text" data-item-info="" class="autocomplete-ui fw-option" name="thz-content-layout-specific" placeholder="<?php echo esc_attr(__('Type to search ...', 'creatus')) ?>" />
		</div>
	</div>
	<div class="thz-content-layout-assignto-holder thz-content-row">
		<?php 
            echo fw()->backend->option_type('thz-post-type')->render(
            'assignto',
            array(
                'label' =>  esc_html__('Select pages', 'creatus'),
                'desc'  => false,
                'type'  => 'thz-post-type',
                'multi'  => false,
                'value' => '',
                'attr'	=> array (
                    'class' =>'thz-content-layout-dropdown'
                ),
            ),
            array(
                'id_prefix' => 'fw-option-' . $id . '-thz-content-layout-',
                'name_prefix' => $data['name_prefix'] . '[' . $id . ']',
            )
        )
        ?>
	</div>
	<div class="thz-content-layout-desc"><?php echo esc_html__('Choose the page you want to set the layout for','creatus') ?></div>
	
	<div class="thz-content-layout-layouts-holder thz-content-row">
	<?php 
	echo fw()->backend->option_type( 'image-picker' )->render(
		'layout',
		array(
			'label' => __('Set layout', 'creatus'),
			'type' => 'image-picker',
			'value' => '',
			'attr' => array(
				'data-height' => 39,
				'class'=>'thz-content-layout-layouts'
			),
			'choices' => array(
				'full' => array(
					'small' => array(
						'height' => 39,
						'src' => $uri . '/images/full.png'
					),
					'large' => array(
						'src' => $uri . '/images/full_large.png',
						'height' => 77
					)
				),
				'left' => array(
					'small' => array(
						'height' => 39,
						'src' => $uri . '/images/left_content.png'
					),
					'large' => array(
						'src' => $uri . '/images/left_content_large.png',
						'height' => 77
					)
				),
				'right' => array(
					'small' => array(
						'height' => 39,
						'src' => $uri . '/images/right_content.png'
					),
					'large' => array(
						'src' => $uri . '/images/right_content_large.png',
						'height' => 77
					)
				),
				'left_content_right' => array(
					'small' => array(
						'height' => 39,
						'src' => $uri . '/images/left_content_right.png'
					),
					'large' => array(
						'src' => $uri . '/images/left_content_right_large.png',
						'height' => 77
					)
				),
				'left_right_content' => array(
					'small' => array(
						'height' => 39,
						'src' => $uri . '/images/left_right_content.png'
					),
					'large' => array(
						'src' => $uri . '/images/left_right_content_large.png',
						'height' => 77
					)
				),
				'content_left_right' => array(
					'small' => array(
						'height' => 39,
						'src' => $uri . '/images/content_left_right.png'
					),
					'large' => array(
						'src' => $uri . '/images/content_left_right_large.png',
						'height' => 77
					)
				)
			),
			'desc' => esc_html__('Choose layout on selected pages', 'creatus')
		),
		array(
			'value' => '',
			'id_prefix' => 'fw-option-' . $id . '-thz-content-layout-',
			'name_prefix' => $data['name_prefix'] . '[' . $id . ']',
		)
	);
	?>
	<div class="thz-content-layout-desc"><?php echo esc_html__('Choose the layout for the selected page','creatus') ?></div>
	</div>
	<div class="thz-content-layout-spinners-holder thz-content-row">
		<?php
		
		echo fw()->backend->option_type( 'thz-multi-options' )->render(
			'sidebarswidth',

			array(
				'type' => 'thz-multi-options',
				'label' => __('Content + sidebars width', 'creatus'),
				'desc'  => esc_html__('Set content and sidebars width. Total sum of these values should not exceed 100.', 'creatus'),
				'help'  => esc_html__('Please note that if you choose one sidebar layout the content block width gets missing sidebar value.', 'creatus'),
				'value' => array(
					'leftblock' =>22.5,
					'contentblock' =>55,
					'rightblock' =>22.5
				),
				'thz_options' => array(
					'leftblock' => array(
						'title' => esc_html__('Left sidebar', 'creatus'),
						'type' => 'spinner',
						'addon' =>'%',
						'min'	=> 0,
						'max'	=> 100,
						'step'	=> 0.01,
						'attr'=> array('class'=>'thz-content-layout-leftblock')
						
					),
					'contentblock' => array(
						'title' => esc_html__('Content', 'creatus'),
						'type' => 'spinner',
						'addon' =>'%',
						'min'	=> 0,
						'max'	=> 100,
						'step'	=> 0.01,
						'attr'=> array('class'=>'thz-content-layout-contentblock')
						//'class'=>'thz-content-layout-contentblock'
					),
					'rightblock' => array(
						'title' => esc_html__('Right sidebar', 'creatus'),
						'type' => 'spinner',
						'addon' =>'%',
						'min'	=> 0,
						'max'	=> 100,
						'step'	=> 0.01,
						'attr'=> array('class'=>'thz-content-layout-rightblock')
					),
				),
			),

			array(
				'value' => '',
				'id_prefix' => 'fw-option-' . $id . '-thz-content-sidebarswidth-',
				'name_prefix' => $data['name_prefix'] . '[' . $id . ']',
			)
		);	
		?>
		<div class="thz-content-layout-desc"><?php echo esc_html__('Set content and sidebars width. Total sum of these values should not exceed 100.','creatus') ?></div>
	</div>
	<div class="thz-content-layout-button thz-content-row">
		<a href="#" class="button-primary add-layout"><?php echo esc_html__('Add new layout','creatus') ?></a>
		<a href="#" class="button update-layout hide_update_button"><?php echo esc_html__('Update layout for','creatus') ?></a>
	</div>
	<?php
		echo fw()->backend->option_type( 'hidden' )->render(
			'',
			array(
				'type'  => 'hidden',
				'value' => $value,
				'attr'  => array(
					'class' => 'thz-content-layout-input'
				)
			),
			array(
				'value' => $datavalue,
				'id_prefix' => 'fw-option-' . $id ,
				'name_prefix' => $data['name_prefix'] . '[' . $id . ']',
			)
		);					
	?>
	<div class="thz-content-layout-flashinfo"></div>
	<div class="thz-content-layout-titles"><?php echo esc_html__('List of generated layouts','creatus') ?></div>
	<div class="thz-content-layout-layoutsbox"></div>
</div>