<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access forbidden.' );
}
return array(
	/**
	 * Array for demos
	 */
	'demos'          => _thz_get_demos_plugins_list(),
	'plugins'        => array(
		array(
			'name'   => 'Thz Core',
			'slug'   => 'thz-core',
			'source' => esc_url('https://updates.themezly.io/plugins/thz-core.zip')
		),
		array(
			'name'   => 'Assign Widgets',
			'slug'   => 'assign-widgets',
			'source' => esc_url('https://updates.themezly.io/plugins/assign-widgets.zip')
		),
	),
	'theme_id'           => 'creatus',
	'child_theme_source' => esc_url('https://updates.themezly.io/plugins/creatus-child.zip'),
	'has_demo_content'   => true
);
