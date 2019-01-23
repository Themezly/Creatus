<?php if ( ! defined( 'FW' ) ) { die( 'Forbidden' ); }

/**
 * @var string $id
 * @var  array $option
 * @var  array $data
 */

{
	$wrapper_attr = array(
		'id'    => $option['attr']['id'],
		'class' => $option['attr']['class'],
	);

	unset(
		$option['attr']['id'],
		$option['attr']['class']
	);
}

?>
<div <?php echo fw_attr_to_html($wrapper_attr) ?>>
	<a class="thz-show-menu-preview button button-primary" href="#" ><?php echo esc_html__('Show/hide menu preview','creatus') ?></a>
	<div class="thz-mainmenu-preview-container">
	<h2><?php echo esc_html__('This is rough menu preview','creatus') ?></h2>
	<span class="thz-menu-note"><?php echo esc_html__('Note that font-family preview is active only while you change the font values and is set to either toplevel or bottom level menu.','creatus') ?></span>
	<span class="mainmenutitlesep"></span>
	<div class="thz-mainmenu-css-collector" data-header-side="<?php echo fw_get_db_settings_option('headers/picked', 'inline') ?>"><?php echo $html ?></div>
	</div>
</div>