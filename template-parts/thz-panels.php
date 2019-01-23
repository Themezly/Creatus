<?php
/**
 * @package      Thz Framework
 * @author       Themezly
 * @websites     http://www.themezly.com | http://www.youjoomla.com | http://www.yjsimplegrid.com
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // No direct access
}
?>
<?php if ( thz_panel('top_panel') && thz_widgets_section_print('tp','top_panel',false) ) {
	$atts  		= thz_panel('top_panel');
	$speed 		= $atts['speed'];
	$res_class	= _thz_responsive_classes($atts['cmx']);
	$classes	= 'thz-panel top_panel'.$res_class;
?>
<div id="thz_toppanel" class="<?php echo thz_sanitize_class($classes)?>" data-direction="top" data-speed="<?php echo esc_attr($speed) ?>">
	<a id="thz_toppanel_open" href="#" class="thz-panel-open"></a>
    <div class="thz-panel-sizer">
        <div id="thz_toppanel_content" class="thz-panel-content">
            <?php thz_widgets_section_print('tp','top_panel'); ?>
        </div>
    </div>
</div>
<?php } ?>
<?php if (thz_panel('bottom_panel') && thz_widgets_section_print('bp','bottom_panel',false)) { 
	$atts  		= thz_panel('bottom_panel');
	$speed 		= $atts['speed'];
	$res_class	= _thz_responsive_classes($atts['cmx']);
	$classes	= 'thz-panel bottom_panel'.$res_class;
?>
<div id="thz_botpanel" class="<?php echo thz_sanitize_class($classes)?>" data-direction="bottom" data-speed="<?php echo esc_attr($speed) ?>">
	<a id="thz_botpanel_open" href="#" class="thz-panel-open"></a>
    <div class="thz-panel-sizer">
        <div id="thz_botpanel_content" class="thz-panel-content">
             <?php thz_widgets_section_print('bp','bottom_panel'); ?>
        </div>
    </div>
</div>
<?php } ?>
<?php  if ( thz_panel('side_panel') && thz_widgets_section_print('sp','side_panel',false)) { 
	$atts 			= thz_panel('side_panel');
	$speed 			= $atts['speed'];
	$direction 		= $atts['direction'];
	$width 			= thz_property_unit($atts['width'],'px');
	$panel_data 	= 'data-direction="'.$direction.'" data-speed="'.$direction.'" data-width="'.$width.'"';
	$res_class		= _thz_responsive_classes($atts['cmx']);
	$classes		= 'thz-panel side_panel'.$res_class;
	
?>
<div id="thz_sidepanel" class="<?php echo thz_sanitize_class($classes)?>" <?php echo thz_sanitize_data($panel_data) ?>>
	<a id="thz_sidepanel_open" href="#" class="thz-panel-open"></a>
    <div class="thz-panel-sizer">
        <div id="thz_sidepanel_content" class="thz-panel-content">
             <?php thz_widgets_section_print('sp','side_panel'); ?>
        </div>
    </div>
</div>
<?php } ?>