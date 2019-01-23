<?php if (!defined('FW')) die('Forbidden');

$cfg = array();

$cfg['page_builder'] = array(
	'disable_correction' => true,
	'title'         => esc_html__('Divider', 'creatus'),
	'description'   => esc_html__('Add a Divider', 'creatus'),
	'tab'           => esc_html__('Content Elements', 'creatus'),
	'popup_size'    => 'large',
	'title_template' =>'{{-title}} - {{- o.divider_type }}'.
	'{{ if (o.divider_type ==\'horizontal\') {'.
	' }} - style: <strong> {{= o.style.picked}}</strong>{{'.
	' } }}',
	'icon' => 'thzadmin thzadmin-shortcode_divider',
	'popup_header_elements' => '<a class="thz-docs-link" target="_blank" href="https://themezly.com/docs/divider/">'.__(' Visit Docs', 'creatus').' <span class="thz-docs-info thzicon thzicon-link-external"></span></a>',
	
);