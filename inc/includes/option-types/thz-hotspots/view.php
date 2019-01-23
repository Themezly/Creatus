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
$classes = count($data['value']['hotspots']) > 0 ? ' has-hotspots' : '';

if(fw_akg('image/attachment_id',$data['value'])) {
	
	$image_url = wp_get_attachment_image_src( fw_akg('image/attachment_id',$data['value']), 'thz-img-medium' );
	$classes .=' has-image';
}
?>
<div <?php echo fw_attr_to_html($div_attr); ?>>
	<div class="thz-hotspots-generator<?php echo $classes?>">
    
        <div class="thz-hotspots-image-controlls">
        	<a href="#" class="button button-primary hotspot-add-image"><?php echo esc_html('Add/edit image') ?></a>
            <a href="#" class="button hotspot-remove-image"><?php echo esc_html('Remove image') ?></a>
            <a href="#" class="hotspot-preview-size"><?php echo esc_html('Toggle preview size') ?></a>
            <a href="#" class="hotspot-remove-hotspots"><?php echo esc_html('Remove all hotspots') ?></a>
        </div>
        
		<?php
        
			echo fw()->backend->option_type('upload')->render(
				'image',
				array(
					'type' => 'upload',
					'value' => fw_akg('image',$option['value']),
					'images_only' => true,
					'attr'	=> array (
						'class' =>'thz-hotspot-image'
					),
				),
				array(
					'value' => fw_akg('image',$data['value']),
					'id_prefix' => $option['attr']['id'].'-',
					'name_prefix' => $option['attr']['name'],
				)
			)
        ?>	

		<div class="thz-hotspots-preview">
        	<?php if(isset($image_url[0])) {?>
            	<img src="<?php echo esc_url( $image_url[0])?>" alt="hotspot image" />
        	<?php } ?>
		  <?php foreach ( $data['value']['hotspots'] as $hotspot){ ?>
          <span data-id="<?php echo $hotspot['id'] ?>" class="thz-hotspot" style="left:<?php echo $hotspot['left'] ?>%; top:<?php echo $hotspot['top'] ?>%;"><?php echo $hotspot['id'] + 1 ?></span>
          <?php } ?>
        </div>
        
		<?php
		echo fw()->backend->option_type( 'hidden' )->render(
			'hotspots',
			array(
				'value' => json_encode(fw_akg('hotspots',$option['value'])),
				'attr'  => array(
					'class' => 'thz-hotspots-input'
				)
			),
			array(
				'value' =>  json_encode(fw_akg('hotspots',$data['value'])),
				'id_prefix' => $option['attr']['id'].'-',
				'name_prefix' => $option['attr']['name'],
			)
		);					
		?>		
	</div>
</div>