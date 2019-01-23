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
if($option['featured']){
	$f_image = ' data-featured-image ="'.$f_image.'"';
}
?>
<div <?php echo fw_attr_to_html($div_attr) ?>>
	<div class="thz-thumb<?php echo $hasImage_class ?>">
		<img src="<?php echo $thumb_url ?>" data-noimage="<?php echo $no_image?>"<?php echo $f_image?> />
	</div>
	<input type="text" id="<?php echo esc_attr($id) ?>" class="thz-image-input" value="<?php echo $this_image_src ?>" />
	<input type="button" class="button thz-select-image" value="<?php _e( 'Select image', 'creatus' ); ?>" />
	<input type="button" class="button<?php echo $button_remove_class?>" value="<?php _e( 'Remove', 'creatus' ); ?>" />
    <?php 
	
		if($option['featured']){
		
		$checked = $this_image_src =='featured' ? ' checked="checked"':'';
		
	?>
    <label class="use-featured-label"><input type="checkbox" class="use-featured" value="featured"<?php echo $checked?>><?php _e( 'Use featured image', 'creatus' ); ?></label>
    <?php } ?>
	<?php echo fw_html_tag('input', array(
		'type' => 'hidden',
		'name' => $option['attr']['name'],
		'value' => json_encode($data['value'],true),
		'class' => 'thz-image-data'
	));?>
</div>
