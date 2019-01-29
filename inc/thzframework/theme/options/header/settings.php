<?php
if (!defined('FW'))
	die('Forbidden');
$options = array_merge( array(
		thz_theme()->get_options('header/general_tab'),
		thz_theme()->get_options('header/sticky_tab'),
		thz_theme()->get_options('header/brightness_tab'),
		thz_theme()->get_options('header/toolbar_tab')
	)
);