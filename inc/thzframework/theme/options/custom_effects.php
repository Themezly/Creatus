<?php
if (!defined('FW'))
	die('Forbidden');

$usefeatured = isset($usefeatured) ? $usefeatured : false;
$issection 	 = isset($issection) ? true : false;

if ( 'thz-pageblock' === thz_get_current_post_type() ){
  $usefeatured =  true;
}

$options = array_merge(
	// background layers
	thz_theme()->get_options('effects/background_layers',array('usefeatured' => $usefeatured)),
	// animation
	thz_theme()->get_options('effects/animation'),
	// content parallax
	thz_theme()->get_options('effects/content_parallax'),
	// scroll fade
	thz_theme()->get_options('effects/scroll_fade'),
	// full height
	thz_theme()->get_options('effects/full_height'),
	// separator
	thz_theme()->get_options('effects/separator'),
	// container parallax
	thz_theme()->get_options('effects/container_parallax'),
	// lightbox
	thz_theme()->get_options('effects/section_lightbox')
);

// in lightbox for builder section only
if(!$issection && isset($options['lb'])){
	
	unset($options['lb']);	
}