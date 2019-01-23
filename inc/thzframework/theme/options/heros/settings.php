<?php
if (!defined('FW')) {
	die('Forbidden');
}

$hero_options = fw()->theme->get_options('heros/heros', array('usefeatured' => true));

$ops = $hero_options['defaults']['options'];
$hero_page = array(
			
	'label' =>  esc_html__('Select page', 'creatus'),
	'type'  => 'thz-post-type',
	'attr'	=> array (
		'class' =>'thz-hero-page-select'
	),
);

$ops = array_merge(array('hero_page' => $hero_page), $ops);
$hero_options['defaults']['options'] = $ops;

$title_template = '<span class="page">';
$title_template .= '{{= hero_page }}';
$title_template .= '</span> ';

$title_template .= '<span class="pages-visual">';

$title_template .= '{{  if(hero_page.length > 0 ){ }}';

$title_template .= '{{= hero_page.join(\', \').split(\'pt_page_\').join(\'Shop homepage-\').split(\'pt_\').join(\'Single \').split(\'is_\').join(\'\').split(\'tx_\').join(\'Taxonomy \').split(\'ar_\').join(\'Archive \').split(\'-\').join(\' \') .split(\'_\').join(\' \')}}';

$title_template .= '{{ }else{ }}';

$title_template .= '<b style="color:red;">'.esc_html__('Missing hero page selection!', 'creatus').'</b>';

$title_template .= '{{ } }}';

$title_template .= '</span> ';

$title_template .= '{{  if(hero_page.length > 0 ){ }}';
$title_template .= esc_html__('hero section is active', 'creatus');
$title_template .= '{{ } }}';

$options = array(
	'heroinfo' => array(
		'type' => 'thz-html',
		'label' => false,
		'html' => '<h4>Here you can add global hero section for specifig page.<br />Note that you can still change the hero section on per <br />page, post or category basis in their respective page settings. </h4>'
	),
	'heros' => array(
		'type' => 'addable-popup',
		'value' => array(),
		'label' => __('Hero sections', 'creatus'),
		'desc' => esc_html__('Add hero section for specific pages.', 'creatus'),
		'template' => $title_template,
		'popup-title' => null,
		'size' => 'large',
		'limit' => 15,
		'add-button-text' => esc_html__('Add hero section', 'creatus'),
		'sortable' => true,
		'popup-options' => array(
			$hero_options
		)
	),
);