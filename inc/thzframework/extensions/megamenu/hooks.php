<?php if (!defined('FW')) die('Forbidden');

// replace default walker and restrict mega to mainmenu only
{
    remove_filter('wp_nav_menu_args', '_filter_fw_ext_mega_menu_wp_nav_menu_args');

    /** @internal */
	if (!function_exists('_thz_filter_ext_mega_menu_wp_nav_menu_args')) {
		function _thz_filter_ext_mega_menu_wp_nav_menu_args($args) {
			
			
			$header_type = thz_get_option('headers/picked','inline');
			
			if($args['theme_location'] !=='mainmenu' || thz_detect_lateral_header()){
				
				$args['walker'] = new Thz_Mainmenu_Walker();
				
				return $args;
				
			}
			
			$args['walker'] = new FW_Ext_Mega_Menu_Walker();
	
			return $args;
		}
	}
    add_filter('wp_nav_menu_args', '_thz_filter_ext_mega_menu_wp_nav_menu_args');
}


// removing additional description markup
//https://github.com/ThemeFuse/Unyson/issues/2197

add_filter('fw:ext:megamenu:start_el_item_content:disable', '__return_true'); 

// add custom checks for column item output
if (!function_exists('_thz_filter_fw_ext_mega_menu_walker_nav_menu_start_el')) {
	function _thz_filter_fw_ext_mega_menu_walker_nav_menu_start_el($item_output, $item, $depth, $args) {
		
		if (!fw_ext_mega_menu_is_mm_item($item)) {
			return $item_output;
		}
	
		$id 		= $item->ID;
		$item_type 	= fw_ext_mega_menu_get_db_item_option($id,'type');
		
		
		if ($item_type =='column' && fw_ext_mega_menu_get_meta($item, 'title-off') && !thz_detect_lateral_header() ) {
			
			$mode  	= fw_ext_mega_menu_get_db_item_option($id,'column/mode',null);
			$thumb 	= $mode !='thumb' ? false : fw_ext_mega_menu_get_db_item_option($id,'column/thumb',null);
			
			if( empty( $thumb ) && $mode !='widget'){
				$item_output = '';
			}
		}
	
		return $item_output;
	}
}
add_filter('walker_nav_menu_start_el', '_thz_filter_fw_ext_mega_menu_walker_nav_menu_start_el', 10, 4);



// add custom class to li
function _thz_filter_menu_items_classes($classes, $item, $args) {
	
	if( !function_exists('fw_ext_mega_menu_get_db_item_option') ){
	
		return $classes;
	}	
	
	if (fw_ext_mega_menu_is_mm_item($item)) {
	  
	  $id 			= $item->ID;
	  $item_type 	= fw_ext_mega_menu_get_db_item_option($id,'type');
	  
	  if($item_type =='default' || $item_type =='item'){
		  
		  $separator  = fw_ext_mega_menu_get_db_item_option($id,$item_type.'/di_mx/m','d');
		  
		  if( 's' ==  $separator ){
			  
			  $classes[] = 'separator-parent';
		  }
	  }
	}
	
	if($args->theme_location == 'secondary') {
		$classes[] = 'thz-secondary-item';
	}
	return $classes;
}
add_filter('nav_menu_css_class','_thz_filter_menu_items_classes',1,3);