<?php
if (!defined('FW'))
	die('Forbidden');


$options = array(
	'singlepostsetingsgroup' => array(
		'type' => 'group',
		'options' => array(
			'singleposttab' => array(
				'title' => __('Post', 'creatus'),
				'type' => 'tab',
				'options' => fw()->theme->get_options('blog/single_post')
			),
			'singlemediatab' => array(
				'title' => __('Media', 'creatus'),
				'type' => 'tab',
				'options' => fw()->theme->get_options('blog/single_media')
			),
			'singletitletab' => array(
				'title' => __('Title', 'creatus'),
				'type' => 'tab',
				'options' => fw()->theme->get_options('blog/single_title')
			),
			'singlemetatab' => array(
				'title' => __('Meta', 'creatus'),
				'type' => 'tab',
				'options' => fw()->theme->get_options('blog/single_meta')
			),
			'singlecontenttab' => array(
				'title' => __('Content', 'creatus'),
				'type' => 'tab',
				'options' => fw()->theme->get_options('blog/single_content')
			),
			'singlefootertab' => array(
				'title' => __('Footer', 'creatus'),
				'type' => 'tab',
				'options' => fw()->theme->get_options('blog/single_footer')
			),
			'singletagstab' => array(
				'title'   => __( 'Tags', 'creatus' ),
				'type'    => 'tab',
				'options' => fw()->theme->get_options('blog/single_tags')
			),			
			thz_theme()->get_options('blog/single_sharing_tab'),
			'singleauthortab' => array(
				'title' => __('Author', 'creatus'),
				'type' => 'tab',
				'options' => fw()->theme->get_options('blog/single_author')
			),
			'relatedpostssettings' => array(
				'title' => __('Related posts', 'creatus'),
				'type' => 'tab',
				'li-attr' => array('class' => 'thz-related-posts-li'),
				'lazy_tabs'=> false,
				'options' => array(
					fw()->theme->get_options('blog/related')
				)
			),
		)
	)
);