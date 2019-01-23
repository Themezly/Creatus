<?php if (!defined('FW')) die('Forbidden');

$cfg = array();

$title_template = '{{-title}}<br />';
$title_template .= '<span class="thz-bsp"></span><strong>Type: </strong> {{= o.m.type.picked }}';
$title_template .= '<br /><strong>Container height: </strong> {{= o.media_height.picked }}';

$cfg['page_builder'] = array(
	'title'         => esc_html__('Media', 'creatus'),
	'description'   => esc_html__('Add a Media', 'creatus'),
	'tab'           => esc_html__('Media Elements', 'creatus'),
	'popup_size'  	=> 'large',
	'title_template' => $title_template,
	'icon' => 'thzadmin thzadmin-shortcode_media',
	'popup_header_elements' => '<a class="thz-docs-link" target="_blank" href="https://themezly.com/docs/media/">'.__(' Visit Docs', 'creatus').' <span class="thz-docs-info thzicon thzicon-link-external"></span></a>',
);