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

	<div class="thz-page-content-layout-layouts-holder thz-content-row">
	<?php 
	echo fw()->backend->option_type( 'image-picker' )->render(
		'layout',
		array(
			'label' => __('Set layout', 'creatus'),
			'type' => 'image-picker',
			'value' => fw_akg('value/layout',$option),
			'attr' => array(
				'data-height' => 39,
				'class'=>'thz-page-content-layout-layouts'
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
			'value' => fw_akg('value/layout',$data),
			'id_prefix' => 'fw-option-' . $id . '-',
			'name_prefix' => $data['name_prefix'] . '[' . $id . ']',
		)
	);
	?>
	<div class="thz-page-content-layout-desc"><?php echo esc_html__('Choose content layout for this page','creatus') ?></div>
	</div>
	<div class="thz-page-content-layout-spinners-holder thz-content-row">
		<?php
		
		echo fw()->backend->option_type( 'thz-multi-options' )->render(
			$id,
			array(
				'type' => 'thz-multi-options',
				'label' => __('Content + sidebars width', 'creatus'),
				'desc'  => esc_html__('Set content and sidebars width. Total sum of these values should not exceed 100.', 'creatus'),
				'help'  => esc_html__('Please note that if you choose one sidebar layout the content block width gets missing sidebar value.', 'creatus'),
				'value' => array(
					'leftblock' =>  fw_akg('value/leftblock',$option),
					'contentblock' => fw_akg('value/contentblock',$option),
					'rightblock' => fw_akg('value/rightblock',$option)
				),
				'thz_options' => array(
					'leftblock' => array(
						'title' => esc_html__('Left sidebar', 'creatus'),
						'type' => 'spinner',
						'addon' =>'%',
						'min'	=> 0,
						'max'	=> 100,
						'step'	=> 0.01,
						'attr'=> array('class'=>'thz-page-content-layout-leftblock')
						
					),
					'contentblock' => array(
						'title' => esc_html__('Content', 'creatus'),
						'type' => 'spinner',
						'addon' =>'%',
						'min'	=> 0,
						'max'	=> 100,
						'step'	=> 0.01,
						'attr'=> array('class'=>'thz-page-content-layout-contentblock')
					),
					'rightblock' => array(
						'title' => esc_html__('Right sidebar', 'creatus'),
						'type' => 'spinner',
						'addon' =>'%',
						'min'	=> 0,
						'max'	=> 100,
						'step'	=> 0.01,
						'attr'=> array('class'=>'thz-page-content-layout-rightblock')
					),
				),
			),

			array(
				'value' => array(
					'leftblock' =>  fw_akg('value/leftblock',$data),
					'contentblock' => fw_akg('value/contentblock',$data),
					'rightblock' => fw_akg('value/rightblock',$data)
				),
			   'id_prefix'   => $data['id_prefix'],
			   'name_prefix' => $data['name_prefix']
			)
		);	
		?>
        <div class="thz-page-content-layout-desc"><?php echo esc_html__('Set content and sidebars width. Total sum of these values should not exceed 100.','creatus') ?></div>
	</div>
</div>