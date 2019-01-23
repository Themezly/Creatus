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
	<div class="thz-border-radius-titles">
		<span><?php echo esc_html__( 'Top left', 'creatus' ) ?></span>
		<span><?php echo esc_html__( 'Top Right', 'creatus' ) ?></span>
		<span><?php echo esc_html__( 'Bottom left', 'creatus' ) ?></span>
		<span><?php echo esc_html__( 'Bottom Right', 'creatus' ) ?></span>
	</div>
	<?php
	foreach (array('top-left', 'top-right', 'bottom-left', 'bottom-right') as $side) {
		echo fw()->backend->option_type( 'thz-spinner' )->render(
			$side,
			array(
				'type'  => 'thz-spinner',
				'addon' =>'px',
				'min'	=> 0,
				'value' => fw_akg($side, $option['value']),
				'attr'  => array(
					'class' => $side
				),
			),
			array(
				'value' => fw_akg($side, $data['value']),
				'id_prefix' => $option['attr']['id'] .'-',
				'name_prefix' => $option['attr']['name'],
			)
		);
	}
	?>
</div>