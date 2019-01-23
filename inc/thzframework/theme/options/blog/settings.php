<?php
if (!defined('FW'))
	die('Forbidden');
	
$is_archive_settings = isset($archives_settings) ? $archives_settings : false;

$options = array(
	'blog_options_group' => array(
		'type' => 'group',
		'options' => array(
			'bloggeneraltab' => array(
				'title' => __('General', 'creatus'),
				'type' => 'tab',
				'options' => fw()->theme->get_options('blog/general',array('archives_settings' => $is_archive_settings))
			),
			'blogpostsstyletab' => array(
				'title' => __('Posts style', 'creatus'),
				'type' => 'tab',
				'options' =>  fw()->theme->get_options('blog/posts_style')
			)
		)
	)
);