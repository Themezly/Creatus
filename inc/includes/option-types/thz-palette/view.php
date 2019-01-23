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
	<?php foreach ( $option['value'] as $name => $color ) :?>
	<div class="thz-palette-box">
	<div class="thz-palette-label"><?php echo ucfirst(str_replace('_',' ',$name) ) ?></div>
	<?php
	echo fw()->backend->option_type('thz-color-picker')->render(
		$name,
		array(
			'label' => false,
			'desc'  => false,
			'type'  => 'thz-color-picker',
			'value' => fw_akg($name,$option['value']),
			'attr'	=> array(
				'data-name' => $name,
				'class' => 'is-palette',
			),
			'box' => true,
		),
		array(
			'value' => fw_akg($name,$data['value']),
			'id_prefix' => 'fw-option-' . $id . '-',
			'name_prefix' => $data['name_prefix'] . '[' . $id . ']',
		)
	)
	?>
	</div>
	<?php endforeach; ?>
</div>