<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$cfg = array();

$cfg['page_builder'] = array(
	'disable_correction' => true,
	'title'       => esc_html__( 'Notification', 'creatus' ),
	'title_template' => '{{-title}}{{ if (o.notification) { }} : <strong>{{= o.notification}}</strong>{{ } }}',
	'description' => esc_html__( 'Add a Notification Box', 'creatus' ),
	'tab'         => esc_html__( 'Content Elements', 'creatus' ),
	'popup_size'  	=> 'large',
	'icon' => 'thzadmin thzadmin-shortcode_notification',
	'popup_header_elements' => '<a class="thz-docs-link" target="_blank" href="https://themezly.com/docs/notification/">'.__(' Visit Docs', 'creatus').' <span class="thz-docs-info thzicon thzicon-link-external"></span></a>',
);