<?php if (!defined('FW')) die('Forbidden');

if (!is_admin()) {

	$locations 	= get_nav_menu_locations();
	
	foreach($locations as $locname => $loc ){
		
		if( $locname !='mainmenu' && $locname !='secondary' ){
			continue;
		}
				  
		$add_css		= '';
		$menu 			= wp_get_nav_menu_object( $locations[ $locname ] );
		$page_menu		= thz_get_post_option('page_menu',array());
		$term_id		= $menu ? $menu->term_id : 0;
		$current_menu	= !empty($page_menu) ? $page_menu[0] : $term_id;
		$menuitems 		= wp_get_nav_menu_items( $current_menu );
		$widgets_css	= '';
		$thumbs_css		= '';
		$has_widgets 	= false;
		$has_thumbs 	= false;
		
		if(!empty($menuitems)){
		
		  foreach ($menuitems as $menuitem){
			  
			  $id 		= $menuitem->ID;
			  $item_type 	= fw_ext_mega_menu_get_db_item_option($id,'type');
			  
			  if($item_type == 'row'){
				  
				  $mega_bs 			= thz_print_box_css( fw_ext_mega_menu_get_db_item_option($id,'row/mega_bs'));
				  $wo 				= fw_ext_mega_menu_get_db_item_option($id,'row/wo');
				  $tbs 				= thz_print_box_css( fw_ext_mega_menu_get_db_item_option($id,'row/tbs'));
				  
				  if(!empty($mega_bs)){
					  $add_css .= 'ul.thz-mega-menu div.ulholder ul.sub-menu.mega-menu-row.rowid-'.$id.' {'.$mega_bs.'}';
				  }
				  
				  if(!empty($wo)){
					  
					  $wi_atts = fw_ext_mega_menu_get_db_item_option($id,'row/wo/0');
					  $widgets_css .= _thz_sidebars_css($wi_atts,'ul.sub-menu.mega-menu-row.rowid-'.$id);
					  
				  }
				  
				  if(!empty($tbs)){
					  $thumbs_css .= 'ul.sub-menu.mega-menu-row.rowid-'.$id.' a.itemlink.has-thumbnail.holdsgroupTitle,';
					  $thumbs_css .= 'ul.sub-menu.mega-menu-row.rowid-'.$id.' a.itemlink.has-thumbnail.holdsgroupTitle:hover{';
					  $thumbs_css .= $tbs;
					  $thumbs_css .= '}';
				  }
			  }
			  
			  if($item_type == 'column'){
				  
				  $mode 			= fw_ext_mega_menu_get_db_item_option($id,'column/mode');
				  $col_bs 		= thz_print_box_css( fw_ext_mega_menu_get_db_item_option($id,'column/bs'));
				  
				  if(!empty($col_bs)){
					  $add_css .= 'ul.thz-mega-menu div.ulholder li.mega-menu-col.menu-item-'.$id.' {'.$col_bs.'}';
				  }					
				  if($mode  == 'widget' ){
					  
					  $has_widgets = true;
				  }
				  
				  if($mode  == 'thumb' ){
					  
					  $has_thumbs = true;
					  
				  }
				  
			  }
			  
			  if($item_type == 'default' || $item_type == 'item'){
		
				  $button = fw_ext_mega_menu_get_db_item_option($id,$item_type.'/button');
				  if(!empty($button)){
					  
					  $btn_data		= $button[0]['btn'];
					  $font_family 	= thz_get_option('toplevel_font/family');
					  
					  $add_css .= thz_print_button_css($btn_data,'#thz-custom-menu-button-'.$id);	
					  $add_css . '#thz-custom-menu-button-'.$id.':not([class*="thz-ff-"]) .thz-button{';
					  $add_css .'font-family:'.$font_family.',sans-serif;';
					  $add_css .'}';
				  }
				  
			  }
		  }
		  
		  if( $has_widgets && empty($widgets_css) ){
			  $wi_atts = thz_get_option('sb_style',null);
			  $widgets_css .= _thz_sidebars_css($wi_atts,'ul.sub-menu.mega-menu-row');
		  }
		  
		  if(!empty($widgets_css)){
			  
			  $add_css .= $widgets_css;
		  }
		  
		  
		  if( $has_thumbs && !empty($thumbs_css) ){
			  $add_css .= $thumbs_css;
		  }
		
		  
		  if(!empty($add_css)){
			  Thz_Doc::set( 'cssinhead', $add_css );
		  }
		}

	}	
}