<?php if (!defined('FW')) {
	die('Forbidden');
}
/**
 * @var  string $id
 * @var  array $option
 * @var  array $data
 * @var  $value
 */

/*{
	$wrapper_attr = $option['attr'];

	unset(
	$wrapper_attr['value'],
	$wrapper_attr['name']
	);
}

{
	$input_attr['value'] = $value;
	$input_attr['name']  = $option['attr']['name'];
}*/

$fake_attr = $option['attr'];
unset($fake_attr['name']);

$fake_attr['class'] .=' fake-input';

$alowed_strings = array('auto','normal','none');

if(!in_array($data['value'],$alowed_strings)){
	$fake_attr['value'] = $data['value'] !='' ? (float)$data['value'] : $data['value'];
}

$opt_attr = $option['attr'];
unset($opt_attr['id']);

?>
<div id="<?php echo esc_attr($option['attr']['id']); ?>-holder" class="thz-spinners-holder <?php echo $data_class ?>">
	<?php if(isset($option['title'])){ ?>
        <span class="thz-spinner-title"><?php echo $option['title'] ?></span>
    <?php }?>
	<div id="<?php echo esc_attr($option['attr']['id']); ?>-thz-spinner" class="thz-spinner has-units">
        <input <?php echo fw_attr_to_html($fake_attr) ?> type="text"<?php echo $data_attr ?> />
        <?php echo $units ?>
        <a class="thz-spinner-up" role="button">&#9650;</a><a class="thz-spinner-down" role="button">&#9660;</a>
	</div>
	<input class="thz-spinner-value" type="hidden" <?php echo fw_attr_to_html($opt_attr); ?> tabindex="-1" />
</div>