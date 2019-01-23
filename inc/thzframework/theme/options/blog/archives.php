<?php
if (!defined('FW'))
	die('Forbidden');
$options = array(

	'arch' => array(
		'type' => 'addable-popup',
		'value' => array(),
		'label' => __('Custom archives settings', 'creatus'),
		'desc' => esc_html__('Add custom archives settings or leave as is for same layout as blog posts settings.', 'creatus'),
		'template' => 'Custom archives settings',
		'popup-title' => null,
		'size' => 'large',
		'limit' => 1,
		'add-button-text' => esc_html__('Add custom archives settings', 'creatus'),
		'sortable' => false,
		'popup-options' => array(
			fw()->theme->get_options('blog/settings',array('archives_settings' => true))
		)
	),

);