<?php if ( ! defined( 'ABSPATH' ) ) {
    die( 'Direct access forbidden.' );
}

/*
 * Automatic install Unyson and install supported extensions after theme install/switch.
 */
if ( is_admin() && current_user_can('switch_themes') && !class_exists( 'Thz_Theme_Auto_Setup' )) {
	load_template( get_template_directory().'/inc/includes/auto-setup/class-thz-auto-install.php', true );
}
