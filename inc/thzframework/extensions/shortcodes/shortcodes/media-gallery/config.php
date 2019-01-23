<?php if (!defined('FW')) die('Forbidden');

$cfg = array();

$title_template = '{{-title}}<br />';


$title_template .= '<span class="thz-bsp"></span><strong>Layout mode: </strong> {{= o.media_layout}}';

$title_template .= '{{  if(o.media_layout == "grid" ){ }}';
$title_template .= '<br /><strong>Grid settings: </strong>  ';
$title_template .= 'Columns: {{= o.grid.columns }}, ';
$title_template .= 'Gutter: {{= o.grid.gutter }}';
$title_template .= '{{ } }}';


$title_template .= '{{  if(o.media_layout == "slider" ){ }}';
$title_template .= '<br /><strong>Slider layout: </strong>  ';
$title_template .= 'Slides to show: {{= o.slider.show }}, ';
$title_template .= 'Slides to scroll: {{= o.slider.scroll }}, ';
$title_template .= 'Slides space: {{= o.slider.space }}, ';
$title_template .= 'Navigation dots: {{= o.slider.dots }},';
$title_template .= 'Navigation arrows: {{= o.slider.arrows }}';
$title_template .= '{{ } }}';

$cfg['page_builder'] = array(
	'title'         => esc_html__('Media gallery', 'creatus'),
	'description'   => esc_html__('Add a Media gallery', 'creatus'),
	'tab'         => esc_html__( 'Media Elements', 'creatus' ),
	'popup_size'    => 'large',
	'title_template' => $title_template,
	'icon' => 'thzadmin thzadmin-shortcode_media_gallery',
	'popup_header_elements' => '<a class="thz-docs-link" target="_blank" href="https://themezly.com/docs/media-gallery/">'.__(' Visit Docs', 'creatus').' <span class="thz-docs-info thzicon thzicon-link-external"></span></a>',

);