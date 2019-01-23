<?php if (!defined('FW')) {
	die('Forbidden');
}
/**
 * @var  string $id
 * @var  array $option
 * @var  array $data
 * @var  $value
 */

{
	$wrapper_attr = $option['attr'];

	unset(
	$wrapper_attr['value'],
	$wrapper_attr['name']
	);
}

{
	$input_attr['value'] = $value;
	$input_attr['name']  = $option['attr']['name'];
}

?>
<div <?php echo fw_attr_to_html($wrapper_attr); ?>>
	<?php if($option['showinput']){ ?>
		<div class="thz-slider-inputs<?php echo $option['above'] == true ? ' input-above' : '' ;?><?php echo $option['grid'] == false ? ' hide-grid' : '' ;?>">
			<div class="thz-slider-block thz-slider_input">
				<input type="text" value="" class="thz-slider-custom" />
			</div>
			<div class="thz-slider-block thz-slider_range">
				<div class="fw-irs-range-slider"></div>
				<input class="fw-irs-range-slider-hidden-input" type="hidden" <?php echo fw_attr_to_html($input_attr); ?>/>
			</div>
		</div>
	<?php }else{ ?>
		<div class="fw-irs-range-slider"></div>
		<input class="fw-irs-range-slider-hidden-input" type="hidden" <?php echo fw_attr_to_html($input_attr); ?>/>
	<?php }?>
</div>
