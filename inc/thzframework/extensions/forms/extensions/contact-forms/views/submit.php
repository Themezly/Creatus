<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}
/**
 * @var int $form_id
 * @var string $submit_button_text
 * @var array $extra_data
 */
 
$button = thz_akg('b',$extra_data,array());

if(!empty($button)){
	
	$button_html = thz_akg('b/0/b/html',$extra_data,array());
	$button_html = str_replace('<button','<button type="submit"',$button_html);
	
}else{
	
	$button_html = '<input type="submit" value="'.esc_attr( $submit_button_text ) .'" />';
}
?>
<div class="thz-shortcode-form-button">
   <?php echo $button_html ?>
</div>