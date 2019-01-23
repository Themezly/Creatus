<?php
if (!defined('FW'))
	die('Forbidden');
$options = array(
	'socialmediatab' => array(
		'title' => __('Social media', 'creatus'),
		'type' => 'tab',
		'lazy_tabs'=> false,
		'options' => fw()->theme->get_options( 'socials/media' )
	),
	thz_theme()->get_options( 'socials/sharing_tab' ),
);