<?php if (!defined('FW')) {
	die('Forbidden');
}
/**
 * @var string $id
 * @var  array $option
 * @var  array $data
 */

{
	$div_attr = $option['attr'];
	$input_attr = $option['attr'];

	unset(
		$div_attr['id'],
		$div_attr['value'],
		$div_attr['name'],
		$div_attr['data-add-icons'],
		$div_attr['data-remove-icons'],
		$div_attr['data-remove-categories'],
		$div_attr['data-categories']
	);
	
}

if(is_array($option['value'])) {
	
	
	$inputa_attr = $option['attr'];
	$inputa_attr['class'] = 'thz-icon-input';
	unset(
		$inputa_attr['id'],
		$inputa_attr['value'],
		$inputa_attr['name']
	);	
}
?>
<div <?php echo fw_attr_to_html($div_attr); ?>>
	<?php if(is_array($option['value'])) { ?>
	<div class="thz-icons thz-opt-icons">
		<?php if(isset($option['value']['icon']) ) { ?>
		<div class="thz-icon-opt-holder thz-ih-holds-icon">
        	<div class="fw-option-help dashicons dashicons-info thz-icon-name" title="Select an icon to see the class name"></div>
			<?php
				echo fw()->backend->option_type( 'text' )->render(
					'icon',
					array(
						'type'  => 'text',
						'value' => fw_akg('icon', $option['value']),
						'attr' => $inputa_attr,
					),
					array(
						'value' => fw_akg('icon', $data['value']),
						'id_prefix' => $option['attr']['id'] .'-',
						'name_prefix' => $option['attr']['name'],
					)
				);			
			?>
		</div>
		<?php } ?>
		<?php if(isset($option['value']['size']) ) { ?>
		<div class="thz-icon-opt-holder thz-ih-holds-size">
			<?php
				echo fw()->backend->option_type( 'thz-spinner' )->render(
					'size',
					array(
						'type'  => 'thz-spinner',
						'value' => fw_akg('size', $option['value']),
						'addon' => 'px',
						'step'	=> 1,
					),
					array(
						'value' => fw_akg('size', $data['value']),
						'id_prefix' => $option['attr']['id'] .'-',
						'name_prefix' => $option['attr']['name'],
					)
				);			
			?>
		</div>
		<?php } ?>
        
        
		<?php if(isset($option['value']['v-nudge']) ) { ?>
		<div class="thz-icon-opt-holder thz-ih-holds-nudge">
			<?php
				echo fw()->backend->option_type( 'thz-spinner' )->render(
					'v-nudge',
					array(
						'type'  => 'thz-spinner',
						'value' => fw_akg('v-nudge', $option['value']),
						'addon' => 'v-nudge',
						'step'	=> 1,
					),
					array(
						'value' => fw_akg('v-nudge', $data['value']),
						'id_prefix' => $option['attr']['id'] .'-',
						'name_prefix' => $option['attr']['name'],
					)
				);			
			?>
		</div>
		<?php } ?>
        
        
		<?php if(isset($option['value']['h-nudge']) ) { ?>
		<div class="thz-icon-opt-holder thz-ih-holds-nudge">
			<?php
				echo fw()->backend->option_type( 'thz-spinner' )->render(
					'h-nudge',
					array(
						'type'  => 'thz-spinner',
						'value' => fw_akg('h-nudge', $option['value']),
						'addon' => 'h-nudge',
						'step'	=> 1,
					),
					array(
						'value' => fw_akg('h-nudge', $data['value']),
						'id_prefix' => $option['attr']['id'] .'-',
						'name_prefix' => $option['attr']['name'],
					)
				);			
			?>
		</div>
		<?php } ?>
        
        
        
		<?php if(isset($option['value']['space']) ) { ?>
		<div class="thz-icon-opt-holder thz-ih-holds-nudge">
			<?php
				echo fw()->backend->option_type( 'thz-spinner' )->render(
					'space',
					array(
						'type'  => 'thz-spinner',
						'value' => fw_akg('space', $option['value']),
						'addon' => 'space',
						'step'	=> 1,
					),
					array(
						'value' => fw_akg('space', $data['value']),
						'id_prefix' => $option['attr']['id'] .'-',
						'name_prefix' => $option['attr']['name'],
					)
				);			
			?>
		</div>
		<?php } ?>
        
        
		<?php if(isset($option['value']['color']) ) { ?>
		<div class="thz-icon-opt-holder thz-ih-holds-color">
			<?php
				echo fw()->backend->option_type( 'thz-color-picker' )->render(
					'color',
					array(
						'type'  => 'thz-color-picker',
						'value' => fw_akg('color', $option['value']),
						'box' => true
					),
					array(
						'value' => fw_akg('color', $data['value']),
						'id_prefix' => $option['attr']['id'] .'-',
						'name_prefix' => $option['attr']['name'],
					)
				);			
			?>
		</div>
		<?php } ?>
	</div>
	<?php } else { ?>
	<div class="thz-icons thz-single-icons">
    	<div class="fw-option-help dashicons dashicons-info thz-icon-name" title="Select an icon to see the class name"></div>
		<input class="thz-icon-input" type="text" <?php echo fw_attr_to_html($input_attr); ?> />
	</div>
	<?php } ?>
</div>