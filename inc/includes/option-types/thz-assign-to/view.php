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

//fw_print($jsondata);
?>
<div <?php echo fw_attr_to_html($div_attr) ?>>
	<?php 
		echo fw()->backend->option_type( 'select-multiple' )->render(
		$id,
		array(
			'label' =>  esc_html__('Select pages', 'creatus'),
			'desc'  => false,
			'type'  => 'select-multiple',
			'value' => $option['value'],
			'attr' => array(
			
				'data-current' => "".$jsondata.""
			),
			'choices' => array(
				
				array(
					'attr'    => array('label' => __('Miscellaneous', 'creatus')),
					'choices' => $miscellaneous,
				),


				array(
					'attr'    => array('label' => __('Post types', 'creatus')),
					'choices' => $post_types,
				),


				array(
					'attr'    => array('label' => __('Taxonomy Categories', 'creatus')),
					'choices' => $taxonomies,
				),	
				
				array(
					'attr'    => array('label' => __('Archives', 'creatus')),
					'choices' => $archives,
				),							

			),
		),
		array(
		   'value' => $data['value'],
		   'id_prefix'   => $data['id_prefix'],
		   'name_prefix' => $data['name_prefix']
		)
	)
	?>
</div>