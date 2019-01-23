<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$cfg = array();
$title_template = '{{-title}}';

$title_template .= '{{  if(o.bs.background && o.bs.background.type == "color"){ }}';
$title_template .= '<span class="thz_shc_bg"';
$title_template .= ' style="background-color:{{= thz.thz_replace_palette_colors(o.bs.background.color) }};">';
$title_template .= '</span>';
$title_template .= '{{ } }}';

$title_template .= '{{  if(o.text.length > 0){ }}';
$title_template .= '{{  var clean_text = thz.thz_strip_tags_to_space(o.text); }}';
$title_template .= '{{  if(clean_text.length > 60){ clean_text = clean_text.substring(0, 60) + \'...\'; } }}';
$title_template .= '<span class="thz-bsp"></span>{{= clean_text }}';
$title_template .= '{{ }else{ }}';
$title_template .= '<span class="thz-bsp"></span>';
$title_template .= '<span style="color:red;">empty text block</span>';
$title_template .= '{{ } }}';



$cfg['page_builder'] = array(
	'disable_correction' => true,
	'title'       => esc_html__( 'Text Block', 'creatus' ),
	'description' => esc_html__( 'Add a Text Block', 'creatus' ),
	'tab'         => esc_html__( 'Content Elements', 'creatus' ),
	'popup_size'    => 'large',
	'title_template' => $title_template,
	'icon' => 'thzadmin thzadmin-shortcode_text_block',
	'popup_header_elements' => '<a class="thz-docs-link" target="_blank" href="https://themezly.com/docs/text-block/">'.__(' Visit Docs', 'creatus').' <span class="thz-docs-info thzicon thzicon-link-external"></span></a>',
);
