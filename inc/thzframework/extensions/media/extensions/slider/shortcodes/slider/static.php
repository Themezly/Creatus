<?php if (!defined('FW')) die('Forbidden');
/*
	custom css for slider
*/
if( !thz_is_inline_css_cached() ){
	add_action('fw_ext_shortcodes_enqueue_static:slider','_thz_slider_css');
}