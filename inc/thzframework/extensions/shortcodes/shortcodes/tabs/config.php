<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$cfg = array();

$cfg['page_builder'] = array(
	'disable_correction' => true,
	'title'       => esc_html__( 'Tabs', 'creatus' ),
	'description' => esc_html__( 'Add some Tabs', 'creatus' ),
	'title_template' => '{{-title}}{{ if (o.sort_title) { }} : <strong>{{= o.sort_title}}</strong>{{ } }}',
	'tab'         => esc_html__( 'Content Elements', 'creatus' ),
	'popup_size'  	=> 'large',
	'icon' => 'thzadmin thzadmin-shortcode_tabs',
	'popup_header_elements' => '<a class="thz-docs-link" target="_blank" href="https://themezly.com/docs/tabs/">'.__(' Visit Docs', 'creatus').' <span class="thz-docs-info thzicon thzicon-link-external"></span></a>',
);