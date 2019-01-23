<?php
if (!defined('FW'))
	die('Forbidden');
$options = array(
	'pagetitlesectionsettings' => array(
		'title' => __('Section ', 'creatus'),
		'type' => 'tab',
		'lazy_tabs' => false,
		'li-attr' => array('class' => 'thz-pagetitle-section-li'),
		'options' => fw()->theme->get_options( 'pagetitle/section')	
	),
	'titlesettings' => array(
		'title' => __('Title ', 'creatus'),
		'type' => 'tab',
		'li-attr' => array('class' => 'thz-pagetitle-title-li'),
		'lazy_tabs' => false,
		'options' => fw()->theme->get_options( 'pagetitle/title')	
	),
	'breadcrumbssettings' => array(
		'title' => __('Breadcrumbs ', 'creatus'),
		'type' => 'tab',
		'li-attr' => array('class' => 'thz-pagetitle-breadcrumbs-li'),
		'lazy_tabs' => false,
		'options' => fw()->theme->get_options( 'pagetitle/breadcrumbs')
	),
	'pagetitlesubtitle' => array(
		'title' => __('Subtitle ', 'creatus'),
		'type' => 'tab',
		'li-attr' => array('class' => 'thz-pagetitle-subtitle-li'),
		'lazy_tabs' => false,
		'options' => fw()->theme->get_options( 'pagetitle/sub_title')
	)
);

$no_subtitle =  isset($nosubtitle) ? $nosubtitle : false;

if( $no_subtitle ) {
	
	unset($options['pagetitlesubtitle']);
	
}