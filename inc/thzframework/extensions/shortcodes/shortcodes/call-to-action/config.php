<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$cfg = array();

$cfg['page_builder'] = array(
	'disable_correction' => true,
	'title'       => esc_html__( 'Call To Action', 'creatus' ),
	'description' => esc_html__( 'Add a Call to Action', 'creatus' ),
	'tab'         => esc_html__( 'Content Elements', 'creatus' ),
	'popup_size'  	=> 'large',
	'title_template' => '{{-title}}{{ if (o.heading) { }} : <strong>{{= o.heading}}</strong>{{ } }}',
	'icon' => 'thzadmin thzadmin-shortcode_call_to_action',
	'popup_header_elements' => '<a class="thz-docs-link" target="_blank" href="https://themezly.com/docs/call-to-action/">'.__(' Visit Docs', 'creatus').' <span class="thz-docs-info thzicon thzicon-link-external"></span></a>',
);