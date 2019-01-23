<?php if ( ! defined( 'FW' ) ) die( 'Forbidden' );

$options = array(
	'bbpresstab' => array(
		'title' => __('bbPress', 'creatus'),
		'type' => 'tab',
		'lazy_tabs'=> false,
		'options' => fw()->theme->get_options( 'bb/bbpress' )
		
	),
	'buddypresstab' => array(
		'title' => __('BuddyPress', 'creatus'),
		'type' => 'tab',
		'lazy_tabs'=> false,
		'options' => fw()->theme->get_options( 'bb/budypress' )
	)
);

if ( !class_exists( 'bbPress' ) ) {
	unset($options['bbpresstab']);
}

if ( !class_exists( 'BuddyPress' ) ) {
	unset($options['buddypresstab']);
}