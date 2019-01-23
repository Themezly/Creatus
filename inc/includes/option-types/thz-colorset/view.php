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
			
	<?php if (isset($option['value']['text_color'])) { ?>
	<div class="thz-colorset-box">
	<div class="thz-colorset-label"><?php echo esc_html__('Text', 'creatus') ?></div>
	<?php
	echo fw()->backend->option_type('thz-color-picker')->render(
		'text_color',
		array(
			'label' => false,
			'desc'  => false,
			'type'  => 'thz-color-picker',
			'value' => fw_akg('text_color',$option['value']),
			'box' => true
		),
		array(
			'value' => fw_akg('text_color',$data['value']),
			'id_prefix' => 'fw-option-' . $id . '-',
			'name_prefix' => $data['name_prefix'] . '[' . $id . ']',
		)
	)
	?>
	</div>
	<?php } ?>
	<?php if (isset($option['value']['link_color'])) { ?>
	<div class="thz-colorset-box">
	<div class="thz-colorset-label"><?php echo esc_html__('Link', 'creatus') ?></div>
	<?php
	echo fw()->backend->option_type('thz-color-picker')->render(
		'link_color',
		array(
			'label' => false,
			'desc'  => false,
			'type'  => 'thz-color-picker',
			'value' => fw_akg('link_color',$option['value']),
			'box' => true
		),
		array(
			'value' => fw_akg('link_color',$data['value']),
			'id_prefix' => 'fw-option-' . $id . '-',
			'name_prefix' => $data['name_prefix'] . '[' . $id . ']',
		)
	)
	?>
	</div>
	<?php } ?>
	<?php if (isset($option['value']['link_hover_color'])) { ?>
	<div class="thz-colorset-box">
	<div class="thz-colorset-label"><?php echo esc_html__('Link hovered', 'creatus') ?></div>
	<?php
	echo fw()->backend->option_type('thz-color-picker')->render(
		'link_hover_color',
		array(
			'label' => false,
			'desc'  => false,
			'type'  => 'thz-color-picker',
			'value' => fw_akg('link_hover_color',$option['value']),
			'box' => true
		),
		array(
			'value' => fw_akg('link_hover_color',$data['value']),
			'id_prefix' => 'fw-option-' . $id . '-',
			'name_prefix' => $data['name_prefix'] . '[' . $id . ']',
		)
	)
	?>
	</div>
	<?php } ?>
	<?php if (isset($option['value']['headings_color'])) { ?>
	<div class="thz-colorset-box">
	<div class="thz-colorset-label"><?php echo esc_html__('Headings', 'creatus') ?></div>
	<?php
	echo fw()->backend->option_type('thz-color-picker')->render(
		'headings_color',
		array(
			'label' => false,
			'desc'  => false,
			'type'  => 'thz-color-picker',
			'value' => fw_akg('headings_color',$option['value']),
			'box' => true
		),
		array(
			'value' => fw_akg('headings_color',$data['value']),
			'id_prefix' => 'fw-option-' . $id . '-',
			'name_prefix' => $data['name_prefix'] . '[' . $id . ']',
		)
	)
	?>
	</div>
	<?php } ?>
</div>