<?php if (!defined('FW')) die('Forbidden');

$cfg = array();

$title_template = '{{-title}}<br />';


$title_template .= '<span class="thz-bsp"></span><strong>Layout mode: </strong> {{= o.layout}}';

$title_template .= '{{  if(o.layout == "grid" ){ }}';
$title_template .= '<br /><strong>Grid settings: </strong>  ';
$title_template .= 'Columns: {{= o.grid.columns }}, ';
$title_template .= 'Gutter: {{= o.grid.gutter }}';
$title_template .= '{{ } }}';


$title_template .= '{{  if(o.layout == "slider" ){ }}';
$title_template .= '<br /><strong>Slider layout: </strong>  ';
$title_template .= 'Slides to show: {{= o.slider.show }}, ';
$title_template .= 'Slides to scroll: {{= o.slider.scroll }}, ';
$title_template .= 'Slides space: {{= o.slider.space }}, ';
$title_template .= 'Navigation dots: {{= o.slider.dots }},';
$title_template .= 'Navigation arrows: {{= o.slider.arrows }}';
$title_template .= '{{ } }}';


$title_template .= '{{  if(o.over_mode == "infounder" ){ }}';
$title_template .= '<br /><strong>Memebers mode: </strong> Info under image';
$title_template .= '{{ } }}';


$title_template .= '{{  if(o.over_mode == "thzhover" ){ }}';
$title_template .= '<br /><strong>Memebers mode: </strong> Thz hover ( Info shows on hover )';
$title_template .= '{{ } }}';


$title_template .= '{{  if(o.over_mode == "reveal" ){ }}';
$title_template .= '<br /><strong>Memebers mode: </strong> Reveal ( Info hides on hover )';
$title_template .= '{{ } }}';


$title_template .= '{{  if(o.over_mode == "directional" ){ }}';
$title_template .= '<br /><strong>Memebers mode: </strong> Directional ( Info shows on hover )';
$title_template .= '{{ } }}';


$cfg['page_builder'] = array(
	'title'         => esc_html__('Team members', 'creatus'),
	'description'   => esc_html__('Add Team members', 'creatus'),
	'tab'         => esc_html__( 'Content Elements', 'creatus' ),
	'popup_size'    => 'large',
	'title_template' => $title_template,
	'icon' => 'thzadmin thzadmin-shortcode_team_members',
	'popup_header_elements' => '<a class="thz-docs-link" target="_blank" href="https://themezly.com/docs/team-members/">'.__(' Visit Docs', 'creatus').' <span class="thz-docs-info thzicon thzicon-link-external"></span></a>',
);