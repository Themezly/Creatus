<?php
if (!defined('FW'))
	die('Forbidden');
$options = array(
	'postsoptionstab' => array(
		'title' => __('Post', 'creatus'),
		'type' => 'tab',
		'options' => array(
			'blogpoststab' => array(
				'title' => __('Blog posts', 'creatus'),
				'type' => 'tab',
				'options' => array(
					fw()->theme->get_options('blog/settings')
				)
			),
			'postsarchivetab' => array(
				'title' => __('Posts archive', 'creatus'),
				'type' => 'tab',
				'options' => array(
					fw()->theme->get_options('blog/archives')
				)
			),
			'singleposttab' => array(
				'title' => __('Single post', 'creatus'),
				'type' => 'tab',
				'options' => array(
					fw()->theme->get_options('blog/single')
				)
			),
			'postsformatstab' => array(
				'title' => __('Post formats', 'creatus'),
				'type' => 'tab',
				'options' => array(
					fw()->theme->get_options('blog/formats')
				)
			)
		)
	)
);