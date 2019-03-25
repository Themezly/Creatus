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
			'name'   => 'Creatus Extended',
			'slug'   => 'creatus-extended',
		),
		array(
			'name'   => 'Assign Widgets',
			'slug'   => 'assign-widgets',
		),
	),
	'theme_id'           => 'creatus',
	'has_demo_content'   => true
);
