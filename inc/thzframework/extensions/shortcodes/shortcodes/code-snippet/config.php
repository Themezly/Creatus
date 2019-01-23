<?php if (!defined('FW')) die('Forbidden');

$cfg = array();


$title_template = '{{-title}}<br />';
$title_template .= '<br /><strong>Style: </strong> {{= o.style }}';
$title_template .= '<br /><strong>Limit height: </strong> {{= o.height }}';
$title_template .= '<br /><strong>Syntax highlighting: </strong> {{= o.highlight.picked }}';
$title_template .= '{{  var $highlight = o.highlight.picked; if($highlight == "active" ){ }}';
$title_template .= '<br /><strong>Line numbers: </strong> {{= o.highlight.active.linenums }}';
$title_template .= '{{ } }}';

$cfg['page_builder'] = array(
	'title'         => esc_html__('Code snippet', 'creatus'),
	'description'   => esc_html__('Add a Code snippet', 'creatus'),
	'tab'           => esc_html__('Content Elements', 'creatus'),
	'popup_size'    => 'large',
	'title_template' => $title_template,
	'icon' => 'thzadmin thzadmin-shortcode_code_snippet',
	'popup_header_elements' => '<a class="thz-docs-link" target="_blank" href="https://themezly.com/docs/code-snippet/">'.__(' Visit Docs', 'creatus').' <span class="thz-docs-info thzicon thzicon-link-external"></span></a>',
);