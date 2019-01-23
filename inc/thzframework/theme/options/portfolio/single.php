<?php
if (!defined('FW')) {
	die('Forbidden');
}
$options = array(
	'singleprojectsetingsgroup' => array(
		'type' => 'group',
		'options' => array(
			'projectdefaultsstab' => array(
				'title' => __('Project', 'creatus'),
				'type' => 'tab',
				'options' => fw()->theme->get_options( 'portfolio/single_project' )
			),
			'projectmediastab' => array(
				'title' => __('Media', 'creatus'),
				'type' => 'tab',
				'li-attr' => array('class' => 'proj-elements'),
				'options' => fw()->theme->get_options( 'portfolio/single_media' )
			),
			'projecttitlestab' => array(
				'title' => __('Title', 'creatus'),
				'type' => 'tab',
				'li-attr' => array('class' => 'proj-elements'),
				'options' => fw()->theme->get_options( 'portfolio/single_title' )
			),
			'projectcontentstab' => array(
				'title' => __('Content', 'creatus'),
				'type' => 'tab',
				'li-attr' => array('class' => 'proj-elements'),
				'options' => fw()->theme->get_options( 'portfolio/single_content' )
			),
			'projectmetastab' => array(
				'title' => __('Meta', 'creatus'),
				'type' => 'tab',
				'li-attr' => array('class' => 'proj-elements'),
				'options' => fw()->theme->get_options( 'portfolio/single_meta' )
			),
			thz_theme()->get_options('portfolio/single_sharing_tab'),
			'relatedprojectstab' => array(
				'title' => __('Related projects', 'creatus'),
				'type' => 'tab',
				'li-attr' => array('class' => 'thz-related-projects-li'),
				'lazy_tabs'=> false,
				'options' => array(
					fw()->theme->get_options('portfolio/related')
				)
			),
		)
	)
);