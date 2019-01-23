<?php if ( ! defined( 'FW' ) ) { die( 'Forbidden' ); }

/**
 * @var string $id
 * @var  array $option
 * @var  array $data
 */

{
	$div_attr = $option['attr'];
	$input_attr = $option['attr'];

	unset(
		$div_attr['value'],
		$div_attr['name']
	);

}

$style = $current !='' ? ' style="background-color:'.$current.';"':'';
?>
<div class="thz-color-picker-holder<?php echo esc_attr($is_boxed) ?>">
	<a href="#" class="thz-color-picker-trigger"<?php echo $style; ?>></a>
	<div class="thz-color-picker-holder-in<?php echo esc_attr($palette_color) ?>">
		<div class="thz-cp-palettes">
			<div class="thz-cp-palettes-colors">
			</div>
		</div>
		<div class="palette-color-preview"></div>
		<input type="text" <?php echo fw_attr_to_html($input_attr); ?> />
	</div>
</div>
