<?php
if (!defined('FW')) {
	die('Forbidden');
}
$options = array(
	'shortcode_button' => array(
		'type' => 'thz-button',
		'value' => array(
			'buttonText'=>'Button',
			'activeColor' => 'theme',
			'html'=>'<div class="thz-btn-container"><a class="thz-button thz-btn-theme thz-btn-normal thz-radius-4 thz-btn-border-1 thz-align-center" href="#"><span class="thz-btn-text thz-fs-14 thz-fw-400">Button</span></a></div>'
		),
		'label' => false,
		'shortcode' => true
	),
);