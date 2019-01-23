<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$cfg = array();

$title_template = '{{-title}}<br />';
$title_template .= '<span class="thz-bsp"></span><strong>Slides to show: </strong> {{= o.slider.show }}<br /> ';
$title_template .= '<strong>Slides to scroll: </strong> {{= o.slider.scroll }}<br /> ';
$title_template .= '<strong>Slides space: </strong> {{= o.slider.space }}<br /> ';
$title_template .= '<strong>Navigation dots: </strong> {{= o.slider.dots }}<br />';
$title_template .= '<strong>Navigation arrows: </strong> {{= o.slider.arrows }}';

$cfg['page_builder'] = array(
	'title'       => esc_html__( 'Simple slider', 'creatus' ),
	'description' => esc_html__( 'Add simple slider', 'creatus' ),
	'tab'         => esc_html__( 'Content Elements', 'creatus' ),
	'popup_size'  	=> 'large',
	'title_template' => $title_template,
	'icon' => 'thzadmin thzadmin-shortcode_simple_slider',
	'popup_header_elements' => '<a class="thz-docs-link" target="_blank" href="https://themezly.com/docs/simple-slider/">'.__(' Visit Docs', 'creatus').' <span class="thz-docs-info thzicon thzicon-link-external"></span></a>',
);