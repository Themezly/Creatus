<?php if ( ! defined( 'FW' ) ) die( 'Forbidden' );


$options = array(
	
	'before_head' => array(
		'type' => 'thz-ace',
		'label' => __('Before &lt;/head&gt;', 'creatus'),
		'desc' => esc_html__('Add code before &lt;/head&gt; tag. Use valid Javascript or HTML.', 'creatus'),
		'value'=>'',
		'mode'=>'html',
		'theme'=>'chrome',
		'height'=>250
		
	),
	
	
	'after_body' => array(
		'type' => 'thz-ace',
		'label' => __('After &lt;body&gt;', 'creatus'),
		'desc' => esc_html__('Add code after &lt;body&gt; tag. Use valid Javascript or HTML.', 'creatus'),
		'value'=>'',
		'mode'=>'html',
		'theme'=>'chrome',
		'height'=>250
		
	),
	
	
	'before_body' => array(
		'type' => 'thz-ace',
		'label' => __('Before &lt;/body&gt;', 'creatus'),
		'desc' => esc_html__('Add code before &lt;/body&gt; tag. Use valid Javascript or HTML.', 'creatus'),
		'value'=>'',
		'mode'=>'html',
		'theme'=>'chrome',
		'height'=>250
		
	),		
);