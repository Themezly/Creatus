<?php if (!defined('FW')) die('Forbidden');

$cfg = array();

$title_template = '{{-title}}<br />';
$title_template .= '<span class="thz-bsp"></span><strong>List type: </strong> {{= o.type.picked }}';

$title_template .= '{{  if(o.items.length > 0){ }}';
$title_template .= '<ul>{{ var titles = ""; for (i = 0; i < o.items.length; i++) { titles +=  "<li>" + o.items[i].title + "</li>"; }  }}';
$title_template .= '{{= titles }}</ul>';
$title_template .= '{{ } }}';

$cfg['page_builder'] = array(
	'disable_correction' => true,
	'title'         => esc_html__('List', 'creatus'),
	'description'   => esc_html__('Add a List', 'creatus'),
	'tab'           => esc_html__('Content Elements', 'creatus'),
	'popup_size'    => 'large',
	'title_template' => $title_template,
	'icon' => 'thzadmin thzadmin-shortcode_list',
	'popup_header_elements' => '<a class="thz-docs-link" target="_blank" href="https://themezly.com/docs/list/">'.__(' Visit Docs', 'creatus').' <span class="thz-docs-info thzicon thzicon-link-external"></span></a>',
);