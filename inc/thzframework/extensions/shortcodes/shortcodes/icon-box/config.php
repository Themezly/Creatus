<?php if (!defined('FW')) die('Forbidden');

$cfg = array();



$title_template = '{{-title}}<br />';
$title_template  .= '<span class="thz-bsp"></span><strong>Icon:</strong>&nbsp;&nbsp;&nbsp;<span class="{{- o.icon_metrics.icon }}"></span><br />';
$title_template .= '<strong>Heading:</strong> {{= o.heading }}';

$cfg['page_builder'] = array(
	'title'         => esc_html__('Icon Box', 'creatus'),
	'description'   => esc_html__('Add an Icon Box', 'creatus'),
	'tab'           => esc_html__('Content Elements', 'creatus'),
	'popup_size'  	=> 'large',
	'title_template' => $title_template,
	'icon' => 'thzadmin thzadmin-shortcode_icon_box',
	'popup_header_elements' => '<a class="thz-docs-link" target="_blank" href="https://themezly.com/docs/icon-box/">'.__(' Visit Docs', 'creatus').' <span class="thz-docs-info thzicon thzicon-link-external"></span></a>',
);