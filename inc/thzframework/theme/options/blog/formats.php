<?php
if (!defined('FW')) {
	die('Forbidden');
}
$options = array(
	'postformatssetingsgroup' => array(
		'type' => 'group',
		'options' => array(
			'tabaudioformat' => array(
				'title' => __('Audio format', 'creatus'),
				'type' => 'tab',
				'options' => fw()->theme->get_options('blog/audio_format')
			),
			'tabquoteformat' => array(
				'title' => __('Quote format', 'creatus'),
				'type' => 'tab',
				'options' => fw()->theme->get_options('blog/quote_format')
			),
			'tablinkformat' => array(
				'title' => __('Link format', 'creatus'),
				'type' => 'tab',
				'options' => fw()->theme->get_options('blog/link_format')
			)
		)
	)
);