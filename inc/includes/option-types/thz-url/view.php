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
<div <?php echo fw_attr_to_html($div_attr); ?>>
	<div class="thz-url-holder">
		<a class="thz-url button button-primary" <?php echo $link_data_attr ?> id="<?php echo $id ?>add_url"><?php echo esc_html__('Add/edit','creatus'); ?></a>
		<?php
		echo fw()->backend->option_type( 'text' )->render(
			'url',
			array(
				'value' => fw_akg('url',$option['value']),
				'attr'  => array(
					'class' => 'thz-url-input',
					'readonly' =>'readonly'
				)
			),
			array(
				'value' => fw_akg('url',$data['value']),
				'id_prefix' => $option['attr']['id'].'-',
				'name_prefix' => $option['attr']['name'],
			)
		);	
		// hidden below				
		?>
		<?php
		echo fw()->backend->option_type( 'hidden' )->render(
			'type',
			array(
				'value' => fw_akg('type',$option['value']),
				'attr'  => array(
					'class' => 'thz-url-type'
				)
			),
			array(
				'value' => fw_akg('type',$data['value']),
				'id_prefix' => $option['attr']['id'].'-',
				'name_prefix' => $option['attr']['name'],
			)
		);					
		?>
		<?php
		echo fw()->backend->option_type( 'hidden' )->render(
			'title',
			array(
				'value' => fw_akg('title',$option['value']),
				'attr'  => array(
					'class' => 'thz-url-title'
				)
			),
			array(
				'value' => fw_akg('title',$data['value']),
				'id_prefix' => $option['attr']['id'].'-',
				'name_prefix' => $option['attr']['name'],
			)
		);					
		?>
				
		<?php
		echo fw()->backend->option_type( 'hidden' )->render(
			'target',
			array(
				'value' => fw_akg('target',$option['value']),
				'attr'  => array(
					'class' => 'thz-url-target'
				)
			),
			array(
				'value' => fw_akg('target',$data['value']),
				'id_prefix' => $option['attr']['id'].'-',
				'name_prefix' => $option['attr']['name'],
			)
		);					
		?>
		
		<?php
		echo fw()->backend->option_type( 'hidden' )->render(
			'magnific',
			array(
				'value' => fw_akg('magnific',$option['value']),
				'attr'  => array(
					'class' => 'thz-url-magnific'
				)
			),
			array(
				'value' => fw_akg('magnific',$data['value']),
				'id_prefix' => $option['attr']['id'].'-',
				'name_prefix' => $option['attr']['name'],
			)
		);					
		?>		
	</div>
</div>