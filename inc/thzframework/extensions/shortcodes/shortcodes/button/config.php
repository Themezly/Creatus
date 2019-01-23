<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$cfg = array();


$title_template = '{{-title}}';
$title_template .= '{{ if (o.shortcode_button.json) { }}';
	$title_template .= '{{ var btnjson = JSON.parse(o.shortcode_button.json); if (btnjson.buttonText) { }}';
	$title_template .= ': <strong>{{= btnjson.buttonText}}</strong>';
	$title_template .= '{{ } }}';
$title_template .= '{{ } }}';

$cfg['page_builder'] = array(
	'disable_correction' => true,
	'title'       => esc_html__( 'Button', 'creatus' ),
	'description' => esc_html__( 'Add a Button', 'creatus' ),
	'tab'         => esc_html__( 'Content Elements', 'creatus' ),
	'popup_size'  => 'large',
	'title_template' => $title_template,
	'icon' => 'thzadmin thzadmin-shortcode_button',
	'popup_header_elements' => '<a class="thz-docs-link" target="_blank" href="https://themezly.com/docs/button/">'.__(' Visit Docs', 'creatus').' <span class="thz-docs-info thzicon thzicon-link-external"></span></a>',
);