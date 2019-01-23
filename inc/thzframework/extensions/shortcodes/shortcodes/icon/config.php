<?php if (!defined('FW')) die('Forbidden');

$cfg = array();

$cfg['page_builder'] = array(
	'disable_correction' => true, 
	'title'         => esc_html__('Icon', 'creatus'),
	'description'   => esc_html__('Add an Icon', 'creatus'),
	'tab'           => esc_html__('Content Elements', 'creatus'),
	'popup_size'  	=> 'large',
	'title_template' => '{{-title}}{{ if (o.metrics.icon) { }} : <i class="{{= o.metrics.icon}}"></i>{{ } }}',
	'icon' => 'thzadmin thzadmin-shortcode_icon',
	'popup_header_elements' => '<a class="thz-docs-link" target="_blank" href="https://themezly.com/docs/icon/">'.__(' Visit Docs', 'creatus').' <span class="thz-docs-info thzicon thzicon-link-external"></span></a>',
);