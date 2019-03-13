<?php if ( ! defined( 'FW' ) ) die( 'Forbidden' );

$notice ='system-is-ok';
$server_requirements 	= fw()->theme->manifest->get('server_requirements');
$required_input_vars 	= $server_requirements['server']['php_max_input_vars'];
$required_php_version 	= $server_requirements['server']['php_version']; // phpcs:ignore WordPress.WP.GlobalVariablesOverride.OverrideProhibited

if ( ( ini_get('max_input_vars') < $required_input_vars ) || ( version_compare(phpversion(),$required_php_version, '<') ) ) {
	$notice ='system-display-notice';
}

$options = array(
	'sitelayouttab' => array(
		'title' => __('Site layout', 'creatus'),
		'type' => 'tab',
		'attr' => array(
			'class' => $notice
		),
		'lazy_tabs'=> false,
		'options' => fw()->theme->get_options('site/layout')
	),
	'contentlayouttab' => array(
		'title' => __('Content layouts', 'creatus'),
		'type' => 'tab',
		'lazy_tabs'=> false,
		'options' => fw()->theme->get_options('site/content_layouts')
	),
	'stylingtab' => array(
		'title' => __('Styling', 'creatus'),
		'type' => 'tab',
		'lazy_tabs' => false,
		'options' => fw()->theme->get_options('site/styling')
	),
	'sitetypotab' => array(
		'title' => __('Typography', 'creatus'),
		'type' => 'tab',
		'lazy_tabs'=> false,
		'options' => fw()->theme->get_options('site/typography')
	)
);