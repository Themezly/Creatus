<?php
if (!defined('FW'))
	die('Forbidden');
	
$options = array(
	'mainmenugeneral' => array(
		'title' => __('General', 'creatus'),
		'type' => 'tab',
		'lazy_tabs' => false,
		'options' => fw()->theme->get_options( 'mainmenu/general')
	),
	'mainmenucontainers' => array(
		'title' => __('Containers', 'creatus'),
		'type' => 'tab',
		'lazy_tabs' => false,
		'options' => array(
			'containerstoplevel' => array(
				'title' => __('Top level', 'creatus'),
				'type' => 'tab',
				'options' => fw()->theme->get_options( 'mainmenu/containers_top_level')
			),
			'containerssublevel' => array(
				'title' => __('Sub level', 'creatus'),
				'type' => 'tab',
				'options' => fw()->theme->get_options( 'mainmenu/containers_sub_level')
			),
			'containersmega' => array(
				'title' => __('Mega menu', 'creatus'),
				'type' => 'tab',
				'options' => fw()->theme->get_options( 'mainmenu/containers_mega')
			)
		)
	),
	'mainmenulinks' => array(
		'title' => __('Links', 'creatus'),
		'type' => 'tab',
		'attr' => array(
			'data-tmcontainer' => 'tm_colors_container'
		),
		'options' => array(
			'mainmenulinkslayout' => array(
				'title' => __('Layout', 'creatus'),
				'type' => 'tab',
				'options' => fw()->theme->get_options( 'mainmenu/links_layout')
			),
			'mainmenucolorslink' => array(
				'title' => __('Link', 'creatus'),
				'type' => 'tab',
				'options' => fw()->theme->get_options( 'mainmenu/link_style')
			),
			'mainmenucolorshovered' => array(
				'title' => __('Hovered link', 'creatus'),
				'type' => 'tab',
				'options' => fw()->theme->get_options( 'mainmenu/hovered_style')
			),
			'mainmenucolorsactive' => array(
				'title' => __('Active link', 'creatus'),
				'type' => 'tab',
				'options' => fw()->theme->get_options( 'mainmenu/active_style')
			)
		)
	),
	'mainmenumobile' => array(
		'title' => __('Mobile', 'creatus'),
		'type' => 'tab',
		'options' => fw()->theme->get_options( 'mainmenu/mobile')
	)
);