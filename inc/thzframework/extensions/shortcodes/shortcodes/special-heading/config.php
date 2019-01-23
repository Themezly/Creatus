<?php if (!defined('FW')) die('Forbidden');

$cfg = array();
$title_template = '{{-title}}';

$title_template .= '{{  if(o.heading.length > 0){ }}';
$title_template .= '{{  var clean_heading = thz.thz_strip_tags_to_space(o.heading); }}';
$title_template .= '{{  if(clean_heading.length > 60){ clean_heading = clean_heading.substring(0, 60) + \'...\'; } }}';
$title_template .= '<span class="thz-bsp"></span><b>{{= clean_heading }}</b>';
$title_template .= '{{ } }}';



$title_template .= '{{  if(o.shsub.picked == "show" && o.shsub.show.text.length > 0){ }}';
$title_template .= '{{  var clean_sub = thz.thz_strip_tags_to_space(o.shsub.show.text); }}';
$title_template .= '{{  if(clean_sub.length > 60){ clean_sub = clean_sub.substring(0, 60) + \'...\'; } }}';
$title_template .= '<span class="thz-bsp"></span>{{= clean_sub }}';
$title_template .= '{{ } }}';


$cfg['page_builder'] = array(
	'disable_correction' => true,
	'title'         => esc_html__('Special Heading', 'creatus'),
	'title_template' => $title_template,
	'description'   => esc_html__('Add a Special Heading', 'creatus'),
	'popup_size'  	=> 'large',
	'tab'           => esc_html__('Content Elements', 'creatus'),
	'icon' => 'thzadmin thzadmin-shortcode_special_heading',
	'popup_header_elements' => '<a class="thz-docs-link" target="_blank" href="https://themezly.com/docs/special-heading/">'.__(' Visit Docs', 'creatus').' <span class="thz-docs-info thzicon thzicon-link-external"></span></a>',
	
);