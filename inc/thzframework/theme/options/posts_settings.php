<?php if ( ! defined( 'FW' ) ) die( 'Forbidden' );

$thz_portfolio_tab = array();
$thz_events_tab = array();

if ( fw_ext( 'portfolio' ) ) {
	$thz_portfolio_tab = fw()->theme->get_options( 'portfolio/portfolio_tab' );
}
if ( fw_ext( 'events' ) ) {
	$thz_events_tab = fw()->theme->get_options( 'events/events_tab' );
}

$options = array(
	fw()->theme->get_options( 'blog/post_tab' ),
	$thz_portfolio_tab,
	$thz_events_tab,
);