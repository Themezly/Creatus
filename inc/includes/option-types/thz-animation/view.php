<?php if ( ! defined( 'FW' ) ) { die( 'Forbidden' ); }

/**
 * @var string $id
 * @var  array $option
 * @var  array $data
 * @var  array $inner_option
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
<?php
	echo fw()->backend->option_type( 'multi-picker' )->render(
		$id,
		$inner_option,
		array(
			'value' => array(
				'picked' => fw_akg('value/animate',$data,'inactive'),
				'active' => array(
					'effect' => fw_akg('value/effect',$data,'thz-anim-fadeIn'),
					'duration' => fw_akg('value/duration',$data,1000),
					'delay' => fw_akg('value/delay',$data,0),
					'kb' => fw_akg('value/kb',$data,array(
						'a' => 'inactive',
						'e' => 'in',
						'd' => 7					
					)),
				),
			),
			'id_prefix' => $data['id_prefix'] .'inner-',
			'name_prefix' => $data['name_prefix'],
		)
	);
?>
</div>