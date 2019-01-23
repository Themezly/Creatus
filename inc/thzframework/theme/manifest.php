<?php if ( ! defined( 'ABSPATH' ) ) die( 'Direct access forbidden.' ); 


//http://manual.unyson.io/en/latest/manifest/theme.html#content
$manifest = array();
$manifest['id']				= get_template();
$manifest['name']         	= esc_html__('Creatus', 'creatus');
$manifest['uri']          	= 'http://themezly.com/themes/creatus';
$manifest['description']  	= esc_html__('Sophisticated WordPress Theme that helps you build unique WordPress websites.', 'creatus');
$manifest['version']      	= thz_theme_version();
$manifest['author']       	= 'Themezly';
$manifest['author_uri']   	= 'http://themezly.com/';

$manifest['requirements'] = array(
    'wordpress' => array(
        'min_version' => '4.0'
    ),
    'framework' => array(
        'min_version' => '1.0.0',
		//'max_version' => '2.7.1'
    ),
    'extensions' => array(
		'page-builder' => array(
            'min_version' => '1.0.0',
        ),
/*		'slider' => array(
            'min_version' => '1.0.0',
        ),
		'portfolio' => array(
            'min_version' => '1.0.0',
        ),
		'events' => array(
            'min_version' => '1.0.0',
        ),*/
		'breadcrumbs' => array(
            'min_version' => '1.0.0',
        ),
		'shortcodes' => array(
            'min_version' => '1.0.0',
        ),
		'megamenu' =>  array(
            'min_version' => '1.0.0',
        ),
		'backups' => array(
            'min_version' => '1.0.0',
        ),
		'wp-shortcodes' => array(
            'min_version' => '1.0.0',
        ),
    )
);

$manifest['supported_extensions'] = array(
	'page-builder' => array(),
	'slider' => array(),
	'breadcrumbs' => array(),
	'shortcodes' => array(),
	'megamenu' => array(),
	'portfolio' => array(),
	'events' => array(),
	'backups' => array(),
	'wp-shortcodes' => array(),
);

$manifest['server_requirements'] = array(
	'server' => array(
		'wp_memory_limit'          => '128M', // use M for MB, G for GB
		'php_version'              => '5.6',
		'post_max_size'            => '32M',
		'php_time_limit'           => '300',
		'php_max_input_vars'       => '3000',
		'suhosin_post_max_vars'    => '3000',
		'suhosin_request_max_vars' => '3000',
		'mysql_version'            => '5.0',
		'max_upload_size'          => '32M',
	),
);

