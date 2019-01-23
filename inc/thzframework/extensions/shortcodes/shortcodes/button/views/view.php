<?php if (!defined('FW')) die( 'Forbidden' ); 
if(isset($atts['shortcode_button']['html'])){
	echo thz_btn_print ( $atts['shortcode_button']['html'] );
}
?>