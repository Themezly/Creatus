<?php
if (!defined('FW')){
	die('Forbidden');
}
$site_settings = fw()->theme->get_options( 'site/settings');
$s_collected = array();
fw_collect_options($s_collected, $site_settings);
foreach ($s_collected as $id => $option) { // phpcs:ignore WordPress.WP.GlobalVariablesOverride.OverrideProhibited
    $s_collected[$id]['value'] = fw_get_db_settings_option($id, isset($option['value']) ? $option['value'] : null);
}
unset($site_settings['contentlayouttab'],$site_settings['stylingtab']['options']['theme_palette']);


// preloader
$preloader_settings = fw()->theme->get_options('additional/preloader');
$preloader_collected = array();
fw_collect_options($preloader_collected, $preloader_settings);
foreach ($preloader_collected as $id => $option) { // phpcs:ignore WordPress.WP.GlobalVariablesOverride.OverrideProhibited
    $preloader_collected[$id]['value'] = fw_get_db_settings_option($id, isset($option['value']) ? $option['value'] : null);
}


// comments
$comments_settings = fw()->theme->get_options('additional/comments');
$comments_collected = array();
fw_collect_options($comments_collected, $comments_settings);
foreach ($comments_collected as $id => $option) { // phpcs:ignore WordPress.WP.GlobalVariablesOverride.OverrideProhibited
    $comments_collected[$id]['value'] = fw_get_db_settings_option($id, isset($option['value']) ? $option['value'] : null);
}

$sticky_sidebars = array(

	'stsb' => array(
		'type' => 'thz-multi-options',
		'label' => __('Sticky sidebars', 'creatus'),
		'desc' => esc_html__('Activate/deactive sticky sidebar for left or right sidebar positions.', 'creatus'),
		'value' => array(
			'l' => fw_get_db_settings_option('stsb/l','inactive'),
			'r' => fw_get_db_settings_option('stsb/r','inactive'),
		),
		'thz_options' => array(
			'l' => array(
				'type' => 'short-select',
				'title' => esc_html__('Left', 'creatus'),
				'choices' => array(
					'inactive' => esc_html__('Inactive', 'creatus'),
					'active' => esc_html__('Active', 'creatus'),
				),
			),
			'r' => array(
				'type' => 'short-select',
				'title' => esc_html__('Right', 'creatus'),
				'choices' => array(
					'inactive' => esc_html__('Inactive', 'creatus'),
					'active' => esc_html__('Active', 'creatus'),
				),
			),
		)
	),

);

$smoothscroll = array(

	'smoothscroll' => array(
		'label' => __('Smooth scroll', 'creatus'),
		'desc' => esc_html__('Activate/deactivate site smooth scroll effect.', 'creatus'),
		'type' => 'short-select',
		'value' => fw_get_db_settings_option('smoothscroll','inactive'),
		'choices' => array(
			'active' => __('Active', 'creatus'),
			'inactive' => __('Active only on pages with parallax', 'creatus'),
			'disabled' => __('Inactive', 'creatus'),
		)
	),

);

$site_settings['sitemiscellaneous'] = array(
		'title' => __('Miscellaneous', 'creatus'),
		'type' => 'tab',
		'options' => array_merge( $comments_settings, $smoothscroll, $sticky_sidebars, $preloader_settings )
);

$options = $site_settings;