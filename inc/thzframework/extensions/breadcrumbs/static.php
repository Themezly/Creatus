<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

if (!is_admin()) { // phpcs:ignore Generic.CodeAnalysis.EmptyStatement.DetectedIf
	//wp_enqueue_style( 'fw-ext-breadcrumbs-add-css', fw()->extensions->get( 'breadcrumbs' )->locate_css_URI( 'style' ) );
}