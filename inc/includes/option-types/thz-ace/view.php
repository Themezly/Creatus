<?php if ( ! defined( 'FW' ) ) { die( 'Forbidden' ); }

/**
 * @var string $id
 * @var  array $option
 * @var  array $data
 * @var  array $inner_option
 */

{
	$div_attr = $option['attr'];
	$input_attr = $option['attr'];

	unset(
		$div_attr['value'],
		$div_attr['name']
	);
}
?>
<?php if(isset($option['label'] ) || isset($option['desc'] )) { ?>
<div class="thz-ace-info">
   <?php if(isset($option['label'] )) { ?>
   <div class="thz-ace-label"><?php echo esc_attr( $option['label'] )?></div>
   <?php } ?>
   <?php if(isset($option['desc'] )) { ?>
   <div class="thz-ace-desc"><?php echo esc_attr( $option['desc']) ?></div>
    <?php } ?>
</div>
<?php } ?>
<div class="thz-ace-holder" style="height:<?php echo esc_attr($option['height']); ?>px;width:<?php echo esc_attr($option['width']); ?>;">
   <div id="thz-ace-editor-<?php echo esc_attr($id) ?>" class="thz-ace-editor"><?php echo htmlspecialchars( $option['value'], ENT_COMPAT, 'UTF-8' ); ?></div>
	<textarea <?php echo fw_attr_to_html( $input_attr ) ?>><?php echo htmlspecialchars( $option['value'], ENT_COMPAT, 'UTF-8' ); ?></textarea>
</div>