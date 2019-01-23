<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$cfg = array();
$title_template = '{{-title}}: <strong>{{= o.sidebar }}</strong>';

$cfg['page_builder'] = array(
	'title'       => esc_html__( 'Widget Area', 'creatus' ),
	'description' => esc_html__( 'Add a Widget Area', 'creatus' ),
	'tab'         => esc_html__( 'Content Elements', 'creatus' ),
	'popup_size'  => 'large',
	'title_template' => $title_template,
	'icon' => 'thzadmin thzadmin-shortcode_widget_area',
	'popup_header_elements' => '<a class="thz-docs-link" target="_blank" href="https://themezly.com/docs/widget-area/">'.__(' Visit Docs', 'creatus').' <span class="thz-docs-info thzicon thzicon-link-external"></span></a>',
);
