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
$opt_type = $option['multi'] ? 'select-multiple' : 'select';
?>
<div <?php echo fw_attr_to_html($div_attr) ?>>
	<?php 
		echo fw()->backend->option_type( $opt_type )->render(
		$id,
		array(
			'label' =>  esc_html__('Select pages', 'creatus'),
			'desc'  => false,
			'type'  => $opt_type,
			'value' => $option['value'],
			'choices' => array(
				'all' =>  esc_html__('All pages', 'creatus'),
				
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