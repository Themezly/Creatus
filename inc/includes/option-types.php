<?php
/**
 * @package      Thz Framework
 * @author       Themezly
 * @license      http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 * @websites     http://www.themezly.com | http://www.youjoomla.com | http://www.yjsimplegrid.com
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // No direct access
}

/** @internal */
function _action_theme_include_custom_option_types() {

	require_once get_template_directory().'/inc/includes/option-types/thz-icon/class-fw-option-type-thz-icon.php';
	require_once get_template_directory().'/inc/includes/option-types/thz-box-shadow/class-fw-option-type-thz-box-shadow.php';
	require_once get_template_directory().'/inc/includes/option-types/thz-text-shadow/class-fw-option-type-thz-text-shadow.php';
	require_once get_template_directory().'/inc/includes/option-types/thz-animation/class-fw-option-type-thz-animation.php';
	require_once get_template_directory().'/inc/includes/option-types/thz-box-style/class-fw-option-type-thz-box-style.php';
	require_once get_template_directory().'/inc/includes/option-types/thz-separator/class-fw-option-type-thz-separator.php';
	require_once get_template_directory().'/inc/includes/option-types/thz-mainmenu/class-fw-option-type-thz-mainmenu.php';
	require_once get_template_directory().'/inc/includes/option-types/thz-slider/class-fw-option-type-thz-slider.php';
	require_once get_template_directory().'/inc/includes/option-types/thz-spinner/class-fw-option-type-thz-spinner.php';
	require_once get_template_directory().'/inc/includes/option-types/thz-colorset/class-fw-option-type-thz-colorset.php';
	require_once get_template_directory().'/inc/includes/option-types/thz-background/class-fw-option-type-thz-background.php';
	require_once get_template_directory().'/inc/includes/option-types/thz-color-picker/class-fw-option-type-thz-color-picker.php';
	require_once get_template_directory().'/inc/includes/option-types/thz-border-radius/class-fw-option-type-thz-border-radius.php';
	require_once get_template_directory().'/inc/includes/option-types/thz-radio/class-fw-option-type-thz-radio.php';
	require_once get_template_directory().'/inc/includes/option-types/thz-image/class-fw-option-type-thz-image.php';
	require_once get_template_directory().'/inc/includes/option-types/thz-typography/class-fw-option-type-thz-typography.php';
	require_once get_template_directory().'/inc/includes/option-types/thz-logo/class-fw-option-type-thz-logo.php';
	require_once get_template_directory().'/inc/includes/option-types/thz-multi-options/class-fw-option-type-thz-multi-options.php';
	require_once get_template_directory().'/inc/includes/option-types/thz-hover/class-fw-option-type-thz-hover.php';
	require_once get_template_directory().'/inc/includes/option-types/thz-ace/class-fw-option-type-thz-ace.php';
	require_once get_template_directory().'/inc/includes/option-types/thz-html/class-fw-option-type-thz-html.php';
	require_once get_template_directory().'/inc/includes/option-types/thz-palette/class-fw-option-type-thz-palette.php';
	require_once get_template_directory().'/inc/includes/option-types/thz-sortable-checks/class-fw-option-type-thz-sortable-checks.php';
	require_once get_template_directory().'/inc/includes/option-types/thz-post-type/class-fw-option-type-thz-post-type.php';
	require_once get_template_directory().'/inc/includes/option-types/thz-hotspots/class-fw-option-type-thz-hotspots.php';
	require_once get_template_directory().'/inc/includes/option-types/thz-addable-layer/class-fw-option-type-thz-addable-layer.php';
	require_once get_template_directory().'/inc/includes/option-types/thz-page-content-layout/class-fw-option-type-thz-page-content-layout.php';
	
	
	if (fw_ext('builder')){
		require_once get_template_directory().'/inc/includes/option-types/thz-section-builder/class-fw-option-type-thz-section-builder.php';
		require_once get_template_directory().'/inc/includes/option-types/thz-panel-builder/class-fw-option-type-thz-panel-builder.php';
	}
	if (fw_ext('events')){
		require_once get_template_directory().'/inc/includes/option-types/thz-event/class-fw-option-type-thz-event.php';
	}

}


function _action_theme_include_custom_option_types_have_ajax() {
	
	require_once get_template_directory().'/inc/includes/option-types/thz-export-import/class-fw-option-type-thz-export-import.php';
	require_once get_template_directory().'/inc/includes/option-types/thz-import-fonts/class-fw-option-type-thz-import-fonts.php';
	require_once get_template_directory().'/inc/includes/option-types/thz-content-layout/class-fw-option-type-thz-content-layout.php';
	require_once get_template_directory().'/inc/includes/option-types/thz-button/class-fw-option-type-thz-button.php';
	require_once get_template_directory().'/inc/includes/option-types/thz-url/class-fw-option-type-thz-url.php';
	require_once get_template_directory().'/inc/includes/option-types/thz-page-templates/class-fw-option-type-thz-page-templates.php';
	require_once get_template_directory().'/inc/includes/option-types/thz-assign-to/class-fw-option-type-thz-assign-to.php';
	require_once get_template_directory().'/inc/includes/option-types/thz-customizer-popup/class-fw-option-type-thz-customizer-popup.php';
	
}

function _action_theme_include_custom_container_types(){
	
	require_once get_template_directory().'/inc/includes/container-types/thz-side-tab/class-fw-container-type-thz-side-tab.php';
}


add_action('fw_option_types_init', '_action_theme_include_custom_option_types');
add_action('fw_option_types_init', '_action_theme_include_custom_option_types_have_ajax');
add_action('fw_container_types_init', '_action_theme_include_custom_container_types');