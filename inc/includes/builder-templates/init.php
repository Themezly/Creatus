<?php if (!defined('FW')) die('Forbidden');
// Page Builder Templates

/** @internal */
function _thz_builder_templates_init() {
	
	remove_action(
		'fw_ext_builder:option_type:builder:before_enqueue',
		'_thz_builder_templates_init'
	);

	require_once get_template_directory().'/inc/includes/builder-templates/class-thz-builder-templates.php';
	new ThzBuilderTemplates();
}

if (defined('DOING_AJAX') && DOING_AJAX) {
	_thz_builder_templates_init();
} else {
	add_action(
		'fw_ext_builder:option_type:builder:before_enqueue',
		'_thz_builder_templates_init'
	);
}