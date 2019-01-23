<?php if (!defined('FW')) die('Forbidden');

$cfg = array();

$title_template = '{{-title}}<br />';
$title_template .= '<span class="thz-bsp"></span><strong>Image ID: </strong> {{= o.image.attachment_id }}';
$title_template .= '<br /><strong>Image size: </strong> {{= o.media_size }}';
$title_template .= '<br /><strong>Click action: </strong> {{= o.click }}';
$title_template .= '<br /><strong>Container height: </strong> {{= o.height.picked }}';

$cfg['page_builder'] = array(
	'disable_correction' => true,
	'title'         => esc_html__('Image', 'creatus'),
	'description'   => esc_html__('Add an Image', 'creatus'),
	'tab'           => esc_html__('Media Elements', 'creatus'),
	'popup_size'  	=> 'large',
	'title_template' => $title_template,
	'icon' => 'thzadmin thzadmin-shortcode_image',
	'popup_header_elements' => '<a class="thz-docs-link" target="_blank" href="https://themezly.com/docs/image/">'.__(' Visit Docs', 'creatus').' <span class="thz-docs-info thzicon thzicon-link-external"></span></a>',
);