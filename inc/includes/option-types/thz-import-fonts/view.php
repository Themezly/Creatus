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
	
$div_attr['class'] .= ' '.$option['provider'];
?>

<div <?php echo fw_attr_to_html($div_attr) ?>>

	<?php if( $option['provider'] == 'typekit' ){ ?>
	<div class="thz-typekit-list">
    	<?php echo $fonts; ?>
    </div>
    <?php } ?>
    
	<?php if( $option['provider'] == 'fontsquirrel' ){ ?>
	<div class="thz-fontsquirrel-list">
    	<?php echo thz_build_fsq_list(); ?>
    </div>
    <?php } ?>
    
    <?php 

		echo fw()->backend->option_type('hidden')->render(
			$id,
			array(
				'type'  => 'hidden',
				'value' => json_encode( $option['value'],true),
				'attr'  => array(
					'class' =>'font-input'
				)
			),
			array(
			   'value'		 => json_encode($data['value'],true),
			   'id_prefix'   => $data['id_prefix'],
			   'name_prefix' => $data['name_prefix']
			)
		);	
	
	
	?>

</div>