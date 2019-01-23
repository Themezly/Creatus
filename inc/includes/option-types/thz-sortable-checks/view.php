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
    <div class="thz-sortable-checks<?php echo $inline_class ?>">
        <?php foreach($option['choices'] as $key => $choice ) {  
        
                $checked = in_array($key,$checkarray) ? ' checked="checked"' :'';
        
        ?>
          <div class="thz-sort-choice" data-order="<?php echo esc_attr($key); ?>">
            <label for="fw-option-<?php echo esc_attr($id); ?>-<?php echo esc_attr($key); ?>">
              <input class="thz-sort-checkbox"  type="checkbox" value="true" id="<?php echo esc_attr($id); ?>-<?php echo esc_attr($key); ?>"<?php echo $checked ?>>
              <?php echo $choice ?></label>
          </div>  
        <?php } ?>
    </div>
	<?php
		echo fw()->backend->option_type( 'hidden' )->render(
			$id,
			array(
				'type'  => 'hidden',
				'value' => $optionvalue,
				'attr'  => array(
					'class' => 'thz-sortable-input'
				)
			),
			array(
			   'value' => $datavalue,
			   'id_prefix'   => $data['id_prefix'],
			   'name_prefix' => $data['name_prefix']
			)
		);					
	?>
</div>