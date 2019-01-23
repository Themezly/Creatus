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

/**
* Print logo CSS
*/
function _thz_logo_css(){
	
	$logo_options			= _thz_logo_options();
	$headers				= thz_get_option('headers/picked','inline');
	$logo_type				= thz_akg('type',$logo_options,'textual');
	$logo_width				= thz_property_unit( thz_akg('width',$logo_options,90),'px');
	$logo_height			= thz_property_unit ( thz_akg('height',$logo_options,80),'px');
	$mlogo_width			= thz_property_unit( thz_akg('mwidth',$logo_options,90),'px');
	$mlogo_height			= thz_property_unit ( thz_akg('mheight',$logo_options,80),'px');
	$sticky 				= thz_get_option('sthe/picked','inactive');
	$logo_boxstyle_array	= thz_akg('boxstyle',$logo_options,null); 
	$logo_boxstyle			= $logo_boxstyle_array ? thz_print_box_css($logo_boxstyle_array): ''; 
	$add_css				='';
	
	if($logo_type == 'textual'){
		
		$f 			= thz_akg('f',$logo_options,null);
		$sub_f 		= thz_akg('sub-f',$logo_options,null);
		
		
		$add_css .= '.thz-logo-holder{width:'.$logo_width.';}';	
		$add_css .=	'.thz-logo{min-height:'.$logo_height.';'.$logo_boxstyle.'}';
		$add_css .=	'.thz-logo-holder.type-textual .thz-logo .site-title{height:'.$logo_height.';}';
		$add_css .=	'.thz-logo-holder.type-textual .thz-logo .site-title{'.thz_typo_css($f).'}';
		$add_css .= '.thz-logo-holder.type-textual .thz-logo .site-title .site-description{';
		$add_css .= thz_typo_css( $sub_f );
		if(!isset($sub_f['text-shadow']) || $sub_f['text-shadow'] ==''){
			$add_css .= 'text-shadow:none;';
		}
		$add_css .= '}';
		
		$add_css .= '.thz-mobile-menu-holder #logomobileholder{width:'.$mlogo_width.';}';	
		$add_css .=	'.thz-mobile-menu-holder #logomobile{min-height:'.$mlogo_height.';}';
		$add_css .=	'.thz-mobile-menu-holder #logomobileholder.type-textual .thz-logo .site-title{height:'.$mlogo_height.';}';
				
		$mc_t		= thz_akg('mc/t',$logo_options,'');
		$mc_s		= thz_akg('mc/s',$logo_options,'');
		
		
		if($mc_t && $mc_t !==''){
			$add_css .=	'.thz-mobile-menu-holder #logomobileholder.type-textual .site-title{color:'.$mc_t.';}';
		}
		if($mc_s && $mc_s !==''){
			$add_css .=	'.thz-mobile-menu-holder #logomobileholder.type-textual .site-title .site-description{color:'.$mc_s.';}';
		}	
		
		if( $sticky == 'active' ){
			$sc_t		= thz_akg('sc/t',$logo_options,'');
			$sc_s		= thz_akg('sc/s',$logo_options,'');
			if($sc_t && $sc_t !==''){
				$add_css .=	'.thz-sticky-header.isvisible .thz-logo-holder .site-title{color:'.$sc_t.';}';
			}
			if($sc_s && $sc_s !==''){
				$add_css .=	'.thz-sticky-header.isvisible .thz-logo-holder .site-title .site-description{color:'.$sc_s.';}';
			}
		}

		// dark body class
		$ds_t		= thz_akg('ds/t',$logo_options,'');
		$ds_s		= thz_akg('ds/s',$logo_options,'');
		
		
		if($ds_t && $ds_t !==''){
			$add_css .=	'.thz-brightness-dark .thz-logo-holder.type-textual .site-title{color:'.$ds_t.';}';
		}
		if($ds_s && $ds_s !==''){
			$add_css .=	'.thz-brightness-dark .thz-logo-holder.type-textual .site-title .site-description{color:'.$ds_s.';}';
		}
		
		// light body class
		$ls_t		= thz_akg('ls/t',$logo_options,'');
		$ls_s		= thz_akg('ls/s',$logo_options,'');
		
		
		if($ls_t && $ls_t !==''){
			$add_css .=	'.thz-brightness-light .thz-logo-holder.type-textual .site-title{color:'.$ls_t.';}';
		}
		if($ls_s && $ls_s !==''){
			$add_css .=	'.thz-brightness-light .thz-logo-holder.type-textual .site-title .site-description{color:'.$ls_s.';}';
		}
		

		
	}else if( 'image' == $logo_type ){

		$add_css .= '.thz-logo-holder{width:'.$logo_width.';}';
		$add_css .=	'.thz-logo{width:'.$logo_width.';min-height:'.$logo_height.';'.$logo_boxstyle.'}';
		$add_css .=	'.thz-logo-in a{height:'.$logo_height.';}';
		
		$add_css .= '.thz-mobile-menu-holder #logomobileholder{width:'.$mlogo_width.';}';
		$add_css .=	'.thz-mobile-menu-holder #logomobile{width:'.$mlogo_width.';min-height:'.$mlogo_height.';}';
		$add_css .=	'.thz-mobile-menu-holder #logomobile-in a{height:'.$mlogo_height.';}';
		
		// svg
	}else{

		$add_css .= '.thz-logo-holder{width:'.$logo_width.';}';
		$add_css .=	'.thz-logo{width:'.$logo_width.';min-height:'.$logo_height.';'.$logo_boxstyle.'}';
		$add_css .=	'.thz-logo-in a{height:'.$logo_height.';}';
		$add_css .=	'.thz-logo-holder.type-svg .thz-logo svg{';
		$add_css .= 'width:'.$logo_width.';';
		$add_css .= 'height:'.$logo_height.';';
		$add_css .= '}';
		
		$add_css .= '.thz-mobile-menu-holder #logomobileholder{width:'.$mlogo_width.';}';
		$add_css .=	'.thz-mobile-menu-holder #logomobile{width:'.$mlogo_width.';min-height:'.$mlogo_height.';}';
		$add_css .=	'.thz-mobile-menu-holder #logomobile-in a{height:'.$mlogo_height.';}';
		
		
		
		$svg_d		= thz_akg('svg/d',$logo_options,'');
		$svg_ds		= thz_akg('svg/ds',$logo_options,'');
		$svg_ls		= thz_akg('svg/ls',$logo_options,'');
		$svg_m		= thz_akg('svg/m',$logo_options,'');
		$svg_a		= thz_akg('svg/a',$logo_options,'fill');
		
		if($svg_d !=''){
			$add_css .=	'.thz-logo-holder.type-svg svg *{';
			if($svg_a =='fill' || $svg_a =='both'){
				$add_css .= 'fill:'.$svg_d.';';
			}
			if($svg_a =='stroke' || $svg_a =='both'){
				$add_css .= 'stroke:'.$svg_d.';';
			}
			$add_css .= '}';
		}

		if($svg_m !=''){
			$add_css .=	'.thz-mobile-menu-holder #logomobileholder.type-svg svg *{';
			if($svg_a =='fill' || $svg_a =='both'){
				$add_css .= 'fill:'.$svg_m.';';
			}
			if($svg_a =='stroke' || $svg_a =='both'){
				$add_css .= 'stroke:'.$svg_m.';';
			}
			$add_css .= '}';
		}	
		
		if($sticky == 'active' ){
			$svg_s		= thz_akg('svg/s',$logo_options,'');
			if($svg_s !==''){
				$add_css .=	'.thz-sticky-header.isvisible .thz-logo-holder.type-svg svg *{';
				if($svg_a =='fill' || $svg_a =='both'){
					$add_css .= 'fill:'.$svg_s.';';
				}
				if($svg_a =='stroke' || $svg_a =='both'){
					$add_css .= 'stroke:'.$svg_s.';';
				}
				$add_css .= '}';
			}

		}
		
		// dark body class
		if($svg_ds !=''){
			$add_css .=	'.thz-brightness-dark .thz-sticky-header.isvisible .thz-logo-holder.type-svg svg *,';
			$add_css .=	'.thz-brightness-dark .thz-logo-holder.type-svg svg *{';
			if($svg_a =='fill' || $svg_a =='both'){
				$add_css .= 'fill:'.$svg_ds.';';
			}
			if($svg_a =='stroke' || $svg_a =='both'){
				$add_css .= 'stroke:'.$svg_ds.';';
			}
			$add_css .= '}';
		}
		
		// light body class
		if($svg_ls !=''){
			$add_css .=	'.thz-brightness-light .thz-sticky-header.isvisible .thz-logo-holder.type-svg svg *,';
			$add_css .=	'.thz-brightness-light .thz-logo-holder.type-svg svg *{';
			if($svg_a =='fill' || $svg_a =='both'){
				$add_css .= 'fill:'.$svg_ls.';';
			}
			if($svg_a =='stroke' || $svg_a =='both'){
				$add_css .= 'stroke:'.$svg_ls.';';
			}
			$add_css .= '}';
		}
		
	}	
	
	return $add_css;
	
}

/**
 * Top menu CSS
 */
function _thz_mainmenu_css(){
	
	$add_css					='';
	$header_type 				= thz_get_option('headers/picked','inline');
	$site_width					= thz_property_unit(thz_get_option('site_width'),'px');
	$toplevel_typo 				= thz_typo_css(thz_get_option('toplevel_font'));
	$sublevel_typo 				= thz_typo_css(thz_get_option('sublevel_font'));
	$headers					= thz_get_option('headers/picked','inline');
	
	// layout
	$tm_boxstyle				= thz_print_box_css( thz_get_option('tm_boxstyle',array()));
	$tm_nav_bs					= thz_print_box_css( thz_get_option('tm_nav_bs',array()));
	$tm_tl_height 				= thz_get_option('tm_tl_height',85);
	$tm_tl_boxstyle 			= thz_get_option('tm_tl_boxstyle');
	$tm_tl_spacing 				= thz_get_option('tm_tl_spacing',0);
	$tm_tl_radius 				= thz_get_option('tm_tl_radius',0);
	$tm_subul_radius			= thz_get_option('tm_subul_radius');

	$tm_sl_boxstyle 			= thz_get_option('tm_sl_boxstyle');
	$tm_sl_radius 				= thz_get_option('tm_sl_radius');
	
	$tm_subul_link_width 		= thz_get_option('tm_subul_link_width',220);
	$tm_subul_link_height 		= thz_get_option('tm_subul_link_height',50);
	$tm_top_offset 				= thz_get_option('tm_top_offset','10');
	$tm_left_offset 			= thz_get_option('tm_left_offset','10');
	
	// Containers
	$fsm_boxstyle				= thz_print_box_css( thz_get_option('fsm_bs',array()));
	$lsm_boxstyle				= thz_print_box_css( thz_get_option('lsm_bs',array()));
	$tm_subul_style				= thz_get_option('tm_subul_style',array('background' => array('type' => 'color','color' => '#ffffff',)));
	$tm_subli_border			= thz_get_option('tm_subli_border');
	
	// Link
	$tm_link					= thz_get_option('tm_link/co','color_2');
	$tm_link_bg					= thz_get_option('tm_link/bg','#ffffff');
	$tm_tl_border				= thz_get_option('tm_tl_border');
	$tm_subul_link				= thz_get_option('tm_subul_link/co','color_2');
	$tm_subul_link_bg			= thz_get_option('tm_subul_link/bg','#ffffff');
	
	
	// Hovered
	$tm_link_hover				= thz_get_option('tm_link_hover/co','color_1');
	$tm_link_hover_bg			= thz_get_option('tm_link_hover/bg','#fafafa');
	$tm_link_hover_border		= thz_get_option('tm_link_hover_border');
	$tm_subul_link_hover		= thz_get_option('tm_subul_link_hover/co','color_1');
	$tm_subul_link_hover_bg		= thz_get_option('tm_subul_link_hover/bg','#fafafa');
	
	
	// Active
	$tm_active_link				= thz_get_option('tm_active_link/co','color_1');
	$tm_active_link_bg			= thz_get_option('tm_active_link/bg','#fafafa');
	$tm_active_link_border		= thz_get_option('tm_active_link_border');
	$tm_subul_active_link		= thz_get_option('tm_subul_active_link/co','color_1');
	$tm_subul_active_link_bg	= thz_get_option('tm_subul_active_link/bg','#fafafa');
	 
	 // Link
	 if(!empty($tm_link)){
		 $add_css .=".thz-menu li a.itemlink{color:".$tm_link.";}";
	 }
	 if(!empty($tm_link_bg)){
		 $add_css .=".thz-menu a.itemlink{background-color:".$tm_link_bg.";}";
	 }
	 if(!empty($tm_subul_link)){
		 $add_css .=".thz-menu ul li a.itemlink{color:".$tm_subul_link.";}";
	 }
	 if(!empty($tm_subul_link_bg)){
		 $add_css .=".thz-menu ul a.itemlink{background-color:".$tm_subul_link_bg.";}";
	 }
	 
	
	 // top level links borders
	 $tm_tl_border_pr = thz_print_box_css($tm_tl_border);
	 $tm_link_hover_border_pr = thz_print_box_css($tm_link_hover_border);
	 $tm_active_link_border_pr = thz_print_box_css($tm_active_link_border);
	 
	 if(!empty($tm_tl_border_pr)){
		 
	 	$add_css .=".thz-menu li.level0 > span a.itemlink{".$tm_tl_border_pr."}";
	 }
	 if(!empty($tm_link_hover_border_pr)){
	 	$add_css .=".thz-menu li.level0 > span a.itemlink:hover,.thz-menu li.level0:hover > span a.itemlink{border:none;".$tm_link_hover_border_pr."}";
	 }
	 
	 if(!empty($tm_active_link_border_pr)){
		 $add_css .=".thz-menu li.level0 > span a.itemlink.activepath{border:none;".$tm_active_link_border_pr."}";
	 }
	 
	 
	 // Hovered
	 
	 if(!empty($tm_link_hover)){
		 $add_css .=".thz-menu li a.itemlink:hover,.thz-menu li:hover > .child a{color:".$tm_link_hover.";}";
	 }
	 if(!empty($tm_link_hover_bg)){
		 $add_css .=".thz-menu li a.itemlink:hover,.thz-menu li:hover > .child a{background-color:".$tm_link_hover_bg.";}";
	 }	
	 if(!empty($tm_subul_link_hover)){
		 $add_css .=".thz-menu ul li a.itemlink:hover,.thz-menu ul li:hover > .child a{color:".$tm_subul_link_hover.";}";
	 }
	 if(!empty($tm_subul_link_hover_bg)){
		 $add_css .=".thz-menu ul li a.itemlink:hover,.thz-menu ul li:hover > .child a{background-color:".$tm_subul_link_hover_bg.";}";
	 }
	 
	 
	 // Active
	if(!empty($tm_active_link)){
		$add_css .=".thz-menu a.itemlink.activepath{color:".$tm_active_link.";}";
	}	 
	if(!empty($tm_active_link_bg)){
		$add_css .=".thz-menu a.itemlink.activepath{background-color:".$tm_active_link_bg.";}";
	}
	if(!empty($tm_subul_active_link)){
		$add_css .=".thz-menu ul a.itemlink.activepath{color:".$tm_subul_active_link.";}";
	}	 
	if(!empty($tm_subul_active_link_bg)){
		$add_css .=".thz-menu ul a.itemlink.activepath{background-color:".$tm_subul_active_link_bg.";}";
	}	
	

	$add_css .= "ul.thz-menu li a.itemlink,.thz-menu li div.itemlink,.thz-custom-menu-button{".thz_print_box_css($tm_tl_boxstyle)."height:".$tm_tl_height."px;line-height:".$tm_tl_height."px;}ul.thz-menu ul li a.itemlink{line-height:".$tm_subul_link_height."px;border:none;height:auto;}";
	
	
	if(($tm_tl_spacing) > 0){
		
		$tm_tl_margin_side = 'right';
		if(thz_detect_lateral_header()){
			$tm_tl_margin_side = 'bottom';
		}
		$add_css .= ".thz-menu li.menu-item.level0{margin-".$tm_tl_margin_side.":".$tm_tl_spacing."px;}";
	}
	
	if($tm_tl_radius > 0){
		$add_css .= ".thz-menu li.menu-item.level0 > span > a{border-radius:".$tm_tl_radius."px;}";
	}
	
	$add_css .= 'ul.thz-menu ul.sub-menu a.itemlink{';
	$add_css .= thz_print_box_css($tm_sl_boxstyle);
	$add_css .='}';
	
	if($tm_sl_radius > 0){
		$add_css .= 'ul.thz-menu ul.sub-menu .linkholder > a:not(.citem){';
		$add_css .= 'border-radius:'.$tm_sl_radius.'px;';
		$add_css .='}';
	}
	
	
	// sublink
	$sub_link_pr = thz_akg('padding/right',$tm_sl_boxstyle,0);
	$chil_icon_p = $sub_link_pr > 0 ?  $sub_link_pr/* / 2 */: 10;
	$add_css .= 'ul.thz-menu ul span.child i.childicon{right:'.$chil_icon_p .'px;}';
	
	
	$add_css .= "ul.thz-menu div.ulholder ul.sub-menu{width:".$tm_subul_link_width."px;}";
	$add_css .= "ul.thz-menu ul.sub-menu.level1{margin-top:".($tm_top_offset)."px;}";
	$add_css .= "ul.thz-menu ul.sub-menu ul.sub-menu,ul.thz-menu div.ulholder.ulgroup > ul > li > div.ulholder > ul.sub-menu{margin-left:".$tm_left_offset."px;}";

	
	$tm_subul_bw = (int) thz_akg('borders/top/w',$tm_subul_style,0);
	$sub_ul_pr 	 = (int) thz_akg('padding/right',$tm_subul_style,0);
	
	
	// in case of border fix position
	$add_css .= "ul.thz-menu ul > li > div.ulholder.notulgroup > ul{";
	$add_css .= "margin-top:-".$tm_subul_bw."px;";
	$add_css .= "".thz_rtl_helper('margin-left').":".($tm_subul_bw + $tm_left_offset + $sub_ul_pr)."px;";
	$add_css .= "}";
	
	$add_css .= "ul.thz-menu li.flip div.ulholder > ul{";
	$add_css .= "".thz_rtl_helper('margin-left').":0px;";
	$add_css .= "".thz_rtl_helper('margin-right').":".($tm_subul_bw + $tm_left_offset + $sub_ul_pr)."px;";
	$add_css .= "}";
	
	// mainmenu colors
	
	if($tm_subul_radius > 0 ){
		$add_css .="ul.thz-menu ul.notulgroup,ul.thz-menu ul.mega-menu-group{border-radius:".$tm_subul_radius."px;}ul.thz-menu ul.notulgroup > li.menu-item:first-child,ul.thz-menu ul.notulgroup > li.menu-item:first-child a.itemlink{border-top-left-radius:".$tm_subul_radius."px;border-top-right-radius:".$tm_subul_radius."px;}ul.thz-menu ul.notulgroup > li.menu-item:last-child,ul.thz-menu ul.notulgroup > li.menu-item:last-child a.itemlink{border-bottom-right-radius:".$tm_subul_radius."px;border-bottom-left-radius:".$tm_subul_radius."px;}";
	}

	$tm_subul_style_print = thz_print_box_css($tm_subul_style);
	
	
	$add_css .="ul.thz-menu ul.sub-menu,.thz-menu li.holdsgroup ul ul{".$tm_subul_style_print."}";
	
	
	$tm_subli_border_print = thz_print_box_css($tm_subli_border);
	if($tm_subli_border_print !=''){
		$add_css .= '.thz-menu ul li.menu-item{'.thz_print_box_css($tm_subli_border).'}';	
	}


	if(!empty($tm_boxstyle)){
		$add_css .='#mainmenu_holder{';
		$add_css .= $tm_boxstyle;
		$add_css .='}';
	}
	
	if(!empty($tm_nav_bs)){
		$add_css .='#mainmenu_holder #thz-nav{';
		$add_css .= $tm_nav_bs;
		$add_css .='}';
	}
	
	// first secondary menu
	if( $fsm_boxstyle !=''){
		
		$add_css .= 'ul.thz-menu.thz-secondary-menu:first-child{';
		$add_css .= $fsm_boxstyle;
		$add_css .= '}';		
	}
	
	// last secondary menu
	if( $lsm_boxstyle !=''){
		
		$add_css .= 'ul.thz-menu.thz-secondary-menu:last-child{';
		$add_css .= $lsm_boxstyle;
		$add_css .= '}';		
	}
	
	
	// items-separator
	$separator_f 	= thz_typo_css(thz_get_option('tm_sepf'));
	$separator_h	= thz_get_option('tm_sepf/hovered');
	$separator_bs	= thz_get_option('tm_sep_bs');
	
	$add_css .='ul.thz-menu ul.sub-menu li a.items-separator{';
	$add_css .= thz_print_box_css($separator_bs);
	if(!empty($separator_f)){
		$add_css .= $separator_f;
	}
	$add_css .='}';
	
	if(!empty($separator_h)){
		$add_css .= 'ul.thz-menu ul.sub-menu .linkholder:not(.donotlink) .items-separator:hover{';
		$add_css .= 'color:'.$separator_h.';';
		$add_css .='}';	
	}
	
	// MegaMenu
	$row_contained		= thz_get_option('tm_mr_co');
	$row_bs   			= thz_print_box_css(thz_get_option('tm_mr_bs'));
	$columns_bs   		= thz_print_box_css(thz_get_option('tm_mr_cbs'));
	$columns_sep_t   	= thz_get_option('tm_mr_cmx/t');
	
	if($row_bs !=''){
		$add_css .= 'ul.thz-mega-menu div.ulholder ul.sub-menu.mega-menu-row{';
		$add_css .= $row_bs;
		$add_css .= '}';
	}
	
	if($row_contained =='contained'){
		
		$container_spacing	= thz_get_option('spacings/con',30);
		$add_css .= 'ul.thz-mega-contained div.ulholder ul.sub-menu.mega-menu-row{';
		$add_css .= 'max-width: calc('.thz_property_unit($site_width,'px').' - ('.thz_property_unit($container_spacing,'px').' * 2));';
		$add_css .= '}';
	}
	
	if($columns_bs !=''){
		$add_css .= 'ul.thz-mega-menu li.menu-item.mega-menu-col{';
		$add_css .= $columns_bs;
		$add_css .= '}';
	}
	
	if($columns_sep_t =='show'){
		
		$columns_sep_w   	= thz_get_option('tm_mr_cmx/w');
		$columns_sep_s   	= thz_get_option('tm_mr_cmx/s');
		$columns_sep_c   	= thz_get_option('tm_mr_cmx/c');
		
		$add_css .= 'ul.thz-mega-menu li.menu-item.mega-menu-col{';
		$add_css .= 'border-right-width:'.thz_property_unit($columns_sep_w ,'px').';';
		$add_css .= 'border-right-style:'.$columns_sep_s .';';
		if($columns_sep_c !=''){
			$add_css .= 'border-right-color:'.$columns_sep_c .';';
		}
		$add_css .= '}';
	}
	
	
	
	// holdsgroupTitle
	$column_titles_f 	= thz_typo_css(thz_get_option('tm_mr_ctf'));
	$column_titles_h	= thz_get_option('tm_mr_ctf/hovered');
	$column_titles_bs	= thz_get_option('tm_mr_ctp');
	
	$add_css .='ul.thz-menu ul.sub-menu li a.holdsgroupTitle{';
	$add_css .= thz_print_box_css($column_titles_bs);
	if(!empty($column_titles_f)){
		$add_css .= $column_titles_f;
	}
	$add_css .='}';
	
	if(!empty($column_titles_h)){
		$add_css .= 'ul.thz-menu ul.sub-menu .linkholder:not(.donotlink) .holdsgroupTitle:hover{';
		$add_css .= 'color:'.$column_titles_h.';';
		$add_css .='}';	
	}
		
	
	// font-family
	if(!empty($toplevel_typo)){
		$add_css .="#mainmenu_holder ul.thz-menu > li.menu-item > .linkholder{".$toplevel_typo."}";
	}
	if(!empty($sublevel_typo)){
		$add_css .="#mainmenu_holder ul.thz-menu ul li.menu-item .linkholder{".$sublevel_typo."}";
	}


	// menu mini
	$woommini = thz_get_option('tm_elmx/mc','only');
	$woommini = $woommini == 'only' ? thz_has_woo() ? 'show' :'hide' : $woommini;
	
	if ( class_exists( 'WooCommerce' ) && $woommini =='show') {
		
		$woomminic_bg		= thz_get_option('wminc/bg','');
		$woomminic_tx		= thz_get_option('wminc/tx','');
		$woomminic_lic		= thz_get_option('wminc/lic','');	
		$woomminic_lihc		= thz_get_option('wminc/lihc','');
		$woomminic_cbg		= thz_get_option('wminc/cbg','');
		$woomminic_cco		= thz_get_option('wminc/cco','');	
		
		if($woomminic_bg !='' || $woomminic_tx){
			$add_css .= '.thz-menu-woo-cart-holder{';
			if($woomminic_bg !=''){
				$add_css .= 'background:'.$woomminic_bg.';';
			}
			if($woomminic_tx !=''){
				$add_css .= 'color:'.$woomminic_tx.';';
			}
			$add_css .= '}';
		}			
	
		if($woomminic_lic !=''){
			$add_css .= '.thz-menu-woo-cart-holder a,';
			$add_css .= '.thz-menu-woo-cart-holder a.thz-woo-cart-btn i{';
			$add_css .= 'color:'.$woomminic_lic.';';
			$add_css .= '}';
		}
	
		if($woomminic_lihc !=''){
			$add_css .= '.thz-menu-woo-cart-holder a:hover,';
			$add_css .= '.thz-menu-woo-cart-holder a.thz-woo-cart-btn:hover i{';
			$add_css .= 'color:'.$woomminic_lihc.';';
			$add_css .= '}';
		}
		
		if($woomminic_cbg !='' || $woomminic_cco !=''){
			$add_css .= '.thz-menu-woo-cart .thz-woo-cart-badge{';
			if($woomminic_cbg !=''){
				$add_css .= 'background:'.$woomminic_cbg.';';
			}
			if($woomminic_cco !=''){
				$add_css .= 'color:'.$woomminic_cco.';';
			}
			$add_css .= '}';
		}
	}
	
	// centered needs nudge left 
	if( $headers =='inline' ){
		
		$menu_position = thz_get_option('htmp','left');
		
		if($menu_position =='center'){
			$logo_options 	= thz_get_option('site_logo');
			$logo_width = (float) thz_akg('width',$logo_options ,'115px');
			
			$add_css .= '.thz-poz-menu-center ul.thz-menu.thz-mega-menu:before{';
			$add_css .= 'margin-left:-'.$logo_width.'px;';
			$add_css .= '}';
		}
		
	}
	
	// mobile menu 

		$mm_bs 			= thz_print_box_css( thz_get_option('mm_bs',null) );
		$mm_burger_i 	= thz_get_option('mm_c/i','');
		$mm_burger_a 	= thz_get_option('mm_c/a','');


		if( !empty($mm_bs) ){
			$add_css .= '.thz-mobile-menu-holder{';
			$add_css .= $mm_bs;
			$add_css .= '}';
		}
		
		
		if( '' != $mm_burger_i  ){
			
			$add_css .= '.thz-mobile-menu-holder .thz-burger-inner{';
			$add_css .= 'background:'.$mm_burger_i.';';
			$add_css .= '}';
		}
		
		if( '' != $mm_burger_a  ){
			
			$add_css .= '.thz-mobile-menu-holder .is-active .thz-burger-inner{';
			$add_css .= 'background:'.$mm_burger_a.';';
			$add_css .= '}';
		}	
			
		
		$mm_link_c = thz_get_option('mm_l/c','');
		$mm_link_bg = thz_get_option('mm_l/bg','');
		$mm_link_b = thz_get_option('mm_l/b','');
		
		
		$mm_link_h_c = thz_get_option('mm_h/c','');
		$mm_link_h_bg = thz_get_option('mm_h/bg','');
		$mm_link_h_b = thz_get_option('mm_h/b','');
		
		
		$mm_link_a_c = thz_get_option('mm_a/c','');
		$mm_link_a_bg = thz_get_option('mm_a/bg','');
		$mm_link_a_b = thz_get_option('mm_a/b','');
	
		if( '' != $mm_link_c || '' != $mm_link_bg || '' != $mm_link_b ){
			
			$add_css .= 'ul.thz-mobile-menu li a{';
			if(''!= $mm_link_c){
				$add_css .= 'color:'.$mm_link_c.';';
			}
			if(''!= $mm_link_bg){
				$add_css .= 'background:'.$mm_link_bg.';';
			}
			if(''!= $mm_link_b){
				$add_css .= 'border-color:'.$mm_link_b.';';
			}
			$add_css .= '}';
		}	
	
		if( '' != $mm_link_h_c || '' != $mm_link_h_bg || '' != $mm_link_h_b ){
			
			$add_css .= 'ul.thz-mobile-menu li a:hover{';
			if(''!= $mm_link_h_c){
				$add_css .= 'color:'.$mm_link_h_c.';';
			}
			if(''!= $mm_link_h_bg){
				$add_css .= 'background:'.$mm_link_h_bg.';';
			}
			if(''!= $mm_link_h_b){
				$add_css .= 'border-color:'.$mm_link_h_b.';';
			}
			$add_css .= '}';
		}
		
		if( '' != $mm_link_a_c || '' != $mm_link_a_bg || '' != $mm_link_a_b ){
			
			$add_css .= 'ul.thz-mobile-menu li.active a{';
			if(''!= $mm_link_a_c){
				$add_css .= 'color:'.$mm_link_a_c.';';
			}
			if(''!= $mm_link_a_bg){
				$add_css .= 'background:'.$mm_link_a_bg.';';
			}
			if(''!= $mm_link_a_b){
				$add_css .= 'border-color:'.$mm_link_a_b.';';
			}
			$add_css .= '}';
		}	
	
	// overlay search
	
	$ovsrc_o = thz_get_option('ovsrc/o','');
	$ovsrc_t = thz_get_option('ovsrc/t','');
	$ovsrc_b = thz_get_option('ovsrc/b','');
	$ovsrc_i = thz_get_option('ovsrc/i','');
	
	if($ovsrc_o != '' || $ovsrc_t != '' || $ovsrc_b != '' || $ovsrc_i != ''){
		if($ovsrc_o != ''){
			$add_css .='html.searchOpen .thz-search-overlay{';
			$add_css .='background-color:'.$ovsrc_o.';';
			$add_css .='}';		
		}
		if($ovsrc_t != ''){
			$add_css .='.thz-search-overlay .thz-close-search,';
			$add_css .='.thz-search-overlay .thz-close-search:hover,';
			$add_css .='.thz-search-overlay .thz-close-search:focus,';
			$add_css .='.thz-search-overlay-in .thz-search-form:before,';
			$add_css .='#thz-site-html .thz-search-overlay .thz-search-form .text-input{';
			$add_css .='color:'.$ovsrc_t.';';
			$add_css .='}';	
			
			$add_css .='.thz-search-overlay .thz-search-form  ::-webkit-input-placeholder{';
			$add_css .='color:'.$ovsrc_t.';';
			$add_css .='}';	
			
			$add_css .='.thz-search-overlay .thz-search-form  ::-moz-placeholder{';
			$add_css .='color:'.$ovsrc_t.';';
			$add_css .='}';	
			
			$add_css .='.thz-search-overlay .thz-search-form  :-ms-input-placeholder{';
			$add_css .='color:'.$ovsrc_t.';';
			$add_css .='}';	
			
			$add_css .='.thz-search-overlay .thz-search-form  input:-moz-placeholder{';
			$add_css .='color:'.$ovsrc_t.';';
			$add_css .='}';		
		}
		if($ovsrc_b != '' || $ovsrc_i != ''){
			$add_css .='#thz-site-html .thz-search-overlay .thz-search-form .text-input{';
			if($ovsrc_i != ''){
				$add_css .='background-color:'.$ovsrc_i.';';
			}
			if($ovsrc_b != ''){
				$add_css .='border-color:'.$ovsrc_b.';';
			}
			$add_css .='}';		
		}
		
	}
	
	// icons metrics 
	$icons_size 	= thz_get_option('tm_elmx/is',null);
	$icons_nudge 	= thz_get_option('tm_elmx/in',null);
	$icons_color 	= thz_get_option('tm_elmx/ic',null);
	$icons_hovered 	= thz_get_option('tm_elmx/ih',null);
	
	if($icons_size != '' || $icons_nudge != '' || $icons_color != '' || $icons_hovered != ''){
		
		$add_css .='.thz-menu-addon i{';
		if($icons_size != ''){
			$add_css .='font-size:'.thz_property_unit($icons_size,'px').';';
		}
		if($icons_nudge != ''){
			$add_css .='top:'.thz_property_unit($icons_nudge,'px').';';
		}
		if($icons_color != ''){
			$add_css .='color:'.$icons_color.';';
		}
		$add_css .='}';	
		
		if($icons_hovered != ''){
			$add_css .='.thz-menu-addon a:hover i{';
			$add_css .='color:'.$icons_hovered.';';
			$add_css .='}';
		}	
	}	
	
	
	return $add_css;	
	
}

/**
 * Header toolbar CSS
 */
function _thz_header_toolbar_css(){
	
	$add_css		='';
	$show_toolbar	= thz_get_option('htb/picked','show');
	
	if($show_toolbar == 'show'){
		
		// toolbar metrics
		$toolbar_bs 		= thz_get_option('htb/show/bs','show');
		$toolbar_bs_print 	= thz_print_box_css($toolbar_bs);
		$toolbar_fs			= thz_get_option('htb/show/m/f',13);
		$toolbar_lh			= thz_get_option('htb/show/m/lh',45);
		$toolbar_t			= thz_get_option('htb/show/m/t','');
		$toolbar_l			= thz_get_option('htb/show/m/l','');
		$toolbar_h			= thz_get_option('htb/show/m/h','');
		
		$add_css .='.thz-header-toolbar{';
		if($toolbar_bs_print !=''){
			$add_css .=$toolbar_bs_print;
		}
		$add_css .='font-size:'.thz_property_unit($toolbar_fs,'px').';';
		$add_css .='line-height:'.thz_property_unit($toolbar_lh,'px').';';
		if($toolbar_t !=''){
			$add_css .='color:'.$toolbar_t.';';
		}
		$add_css .='}';
		
		if($toolbar_l !=''){
			$add_css .='.thz-header-toolbar a{';
			$add_css .='color:'.$toolbar_l.';';
			$add_css .='}';
		}
		if($toolbar_h !=''){
			$add_css .='.thz-header-toolbar a:hover{';
			$add_css .='color:'.$toolbar_h.';';
			$add_css .='}';
		}	
		
		
		// toolbar navigation
		// top level
		$ntt_pl		= thz_get_option('htb/show/nt/pl',10);
		$ntt_pr		= thz_get_option('htb/show/nt/pr',10);
		$ntt_bg		= thz_get_option('htb/show/nt/bg','');
		$ntt_l		= thz_get_option('htb/show/nt/l','');
		$ntt_hbg	= thz_get_option('htb/show/nt/hbg','');
		$ntt_h		= thz_get_option('htb/show/nt/h','');
		$ntt_b		= thz_get_option('htb/show/nt/b','');
		
		$add_css .='.thz-toolbar-menu > li > a{';
		$add_css .='height:'.thz_property_unit($toolbar_lh,'px').';';
		$add_css .='line-height:'.thz_property_unit($toolbar_lh,'px').';';
		$add_css .='padding:0 '.thz_property_unit($ntt_pr,'px').' 0 '.thz_property_unit($ntt_pl,'px').';';
		if($ntt_bg !=''){
			$add_css .='background:'.$ntt_bg.';';
		}
		if($ntt_l !=''){
			$add_css .='color:'.$ntt_l.';';
		}
		if($ntt_b !=''){
			$add_css .='border-right-color:'.$ntt_b.';';
		}
		$add_css .='}';	
		
		if($ntt_b !=''){
			$add_css .='.thz-toolbar-menu > li.lifirst > a{';
			$add_css .='border-left-color:'.$ntt_b.';';
			$add_css .='}';	
		}
		
		if($ntt_hbg !='' || $ntt_h !=''){
			$add_css .='.thz-toolbar-menu > li:hover > a{';
			if($ntt_hbg !=''){
				$add_css .='background:'.$ntt_hbg.';';
			}
			if($ntt_h !=''){
				$add_css .='color:'.$ntt_h.';';
			}
			$add_css .='}';
		}
		
		
		$ns_bg		= thz_get_option('htb/show/ns/bg','');
		$ns_l		= thz_get_option('htb/show/ns/l','');
		$ns_hbg		= thz_get_option('htb/show/ns/hbg','');
		$ns_h		= thz_get_option('htb/show/ns/h','');
		$ns_b		= thz_get_option('htb/show/ns/b','');
		$ns_w		= thz_get_option('htb/show/ns/w',160);
		
		// sub level
		if($ns_bg !='' || $ns_b !=''){
			$add_css .='.thz-toolbar-menu ul{';
			if($ns_bg !=''){
				$add_css .='background:'.$ns_bg.';';
			}
			if($ns_b !=''){
				$add_css .='border-color:'.$ns_b.';';
			}

			$add_css .='}';	
		}
		
		if($ns_bg !='' || $ns_b !='' || $ns_l !=''){
		
			$add_css .='.thz-toolbar-menu ul li a{';
			if($ns_bg !=''){
				$add_css .='background:'.$ns_bg.';';
			}
			if($ns_b !=''){
				$add_css .='border-bottom-color:'.$ns_b.';';
			}
			if($ns_l !=''){
				$add_css .='color:'.$ns_l.';';
			}
			$add_css .='}';	
			
		}
		if($ns_hbg !='' || $ns_h !=''){
			$add_css .='.thz-toolbar-menu ul li a:hover{';
			if($ns_hbg !=''){
				$add_css .='background:'.$ns_hbg.';';
			}
			if($ns_h !=''){
				$add_css .='color:'.$ns_h.';';
			}
			$add_css .='}';	
		}
		
		if($ns_w !=''){
			$add_css .='.thz-toolbar-menu ul li{';
			$add_css .='width:'.thz_property_unit($ns_w,'px').';';
			$add_css .='}';	
		}
		
	}
	
	
	if($add_css !=''){
		return $add_css;
	}
	
}

/**
 * Header CSS
 */
function _thz_header_css(){
	
	$add_css	='';
	$headers					= thz_get_option('headers/picked','inline');
	$header_boxstyle			= thz_print_box_css(thz_get_option('header_boxstyle',null));
	$sticky 					= thz_get_option('sthe/picked','inactive');
	$dark_sections				= thz_get_option('dshe/picked','inactive');
	$light_sections				= thz_get_option('lshe/picked','inactive');
	$site_width 				= thz_get_option('site_width','1200px');
	
	
	$add_css	.=_thz_header_toolbar_css();
	
	if($header_boxstyle !=''){
		$add_css .="#header_holder{".$header_boxstyle."}";
	}
	
	if($sticky == 'active'){
		
		$sticky_bs = thz_print_box_css( thz_get_option('sthe/active/bs',null));
		
		if($sticky_bs !=''){
			
			$add_css .='#thz-site-html .thz-sticky-header.isvisible{';
			$add_css .= $sticky_bs;
			$add_css .='}';

		}
		
		$inactives_co 	= thz_get_option('sthe/active/i/co','');
		$inactives_bg 	= thz_get_option('sthe/active/i/bg','');
		$inactives_bo 	= thz_get_option('sthe/active/i/bo','');
		
		$hovereds_co 	= thz_get_option('sthe/active/h/co','');
		$hovereds_bg 	= thz_get_option('sthe/active/h/bg','');
		$hovereds_bo 	= thz_get_option('sthe/active/h/bo','');
		
		$actives_co 	= thz_get_option('sthe/active/a/co','');
		$actives_bg 	= thz_get_option('sthe/active/a/bg','');
		$actives_bo 	= thz_get_option('sthe/active/a/bo','');

		if($inactives_co  !='' || $inactives_bg  !='' || $inactives_bo  !=''){
			$add_css .='.thz-sticky-header.isvisible .thz-menu > li.level0 > span > a.itemlink{';
			if($inactives_co  !=''){
				$add_css .='color:'.$inactives_co .';';
			}
			if($inactives_bg  !=''){
				$add_css .='background:'.$inactives_bg .';';
			}
			if($inactives_bo  !=''){
				$add_css .='border-color:'.$inactives_bo .';';
			}
			$add_css .='}';
		}

		if($hovereds_co  !='' || $hovereds_bg  !='' || $hovereds_bo  !=''){
			$add_css .='.thz-sticky-header.isvisible .thz-menu > li.level0 > span > a.itemlink:hover{';
			if($hovereds_co  !=''){
				$add_css .='color:'.$hovereds_co .';';
			}
			if($hovereds_bg  !=''){
				$add_css .='background:'.$hovereds_bg .';';
			}
			if($hovereds_bo  !=''){
				$add_css .='border-color:'.$hovereds_bo .';';
			}
			$add_css .='}';
		}				
		if($actives_co  !='' || $actives_bg  !='' || $actives_bo  !=''){
			$add_css .='.thz-sticky-header.isvisible .thz-menu > li.level0 > span > a.itemlink.activepath{';
			if($actives_co  !=''){
				$add_css .='color:'.$actives_co .';';
			}
			if($actives_bg  !=''){
				$add_css .='background:'.$actives_bg .';';
			}
			if($actives_bo  !=''){
				$add_css .='border-color:'.$actives_bo .';';
			}
			$add_css .='}';
		}
		
	}
	
	
	// dark body class
	if($dark_sections == 'active'){
		
		$darkse_bs = thz_print_box_css( thz_get_option('dshe/active/bs',null));
		
		if($darkse_bs !=''){
			
			$add_css .='#thz-site-html .thz-brightness-dark .header_holder{';
			$add_css .= $darkse_bs;
			$add_css .='}';

		}
		
		$ds_tives_co 	= thz_get_option('dshe/active/i/co','');
		$ds_tives_bg 	= thz_get_option('dshe/active/i/bg','');
		$ds_tives_bo 	= thz_get_option('dshe/active/i/bo','');
		
		$ds_hovereds_co 	= thz_get_option('dshe/active/h/co','');
		$ds_hovereds_bg 	= thz_get_option('dshe/active/h/bg','');
		$ds_hovereds_bo 	= thz_get_option('dshe/active/h/bo','');
		
		$ds_actives_co 	= thz_get_option('dshe/active/a/co','');
		$ds_actives_bg 	= thz_get_option('dshe/active/a/bg','');
		$ds_actives_bo 	= thz_get_option('dshe/active/a/bo','');

		if($ds_tives_co  !='' || $ds_tives_bg  !='' || $ds_tives_bo  !=''){
			$add_css .='.thz-brightness-dark .header_holder .thz-menu > li.level0 > span > a.itemlink{';
			if($ds_tives_co  !=''){
				$add_css .='color:'.$ds_tives_co .';';
			}
			if($ds_tives_bg  !=''){
				$add_css .='background:'.$ds_tives_bg .';';
			}
			if($ds_tives_bo  !=''){
				$add_css .='border-color:'.$ds_tives_bo .';';
			}
			$add_css .='}';
		}

		if($ds_hovereds_co  !='' || $ds_hovereds_bg  !='' || $ds_hovereds_bo  !=''){
			$add_css .='.thz-brightness-dark .header_holder .thz-menu > li.level0 > span > a.itemlink:hover{';
			if($ds_hovereds_co  !=''){
				$add_css .='color:'.$ds_hovereds_co .';';
			}
			if($ds_hovereds_bg  !=''){
				$add_css .='background:'.$ds_hovereds_bg .';';
			}
			if($ds_hovereds_bo  !=''){
				$add_css .='border-color:'.$ds_hovereds_bo .';';
			}
			$add_css .='}';
		}				
		if($ds_actives_co  !='' || $ds_actives_bg  !='' || $ds_actives_bo  !=''){
			$add_css .='.thz-brightness-dark .header_holder .thz-menu > li.level0 > span > a.itemlink.activepath{';
			if($ds_actives_co  !=''){
				$add_css .='color:'.$ds_actives_co .';';
			}
			if($ds_actives_bg  !=''){
				$add_css .='background:'.$ds_actives_bg .';';
			}
			if($ds_actives_bo  !=''){
				$add_css .='border-color:'.$ds_actives_bo .';';
			}
			$add_css .='}';
		}
		
	}
	
	
	// light body class
	
	if($light_sections == 'active'){
		
		$lightse_bs = thz_print_box_css( thz_get_option('lshe/active/bs',null));
		
		if($lightse_bs !=''){
			
			$add_css .='#thz-site-html .thz-brightness-light .header_holder{';
			$add_css .= $lightse_bs;
			$add_css .='}';

		}
		
		$ls_tives_co 	= thz_get_option('lshe/active/i/co','');
		$ls_tives_bg 	= thz_get_option('lshe/active/i/bg','');
		$ls_tives_bo 	= thz_get_option('lshe/active/i/bo','');
		
		$ls_hovereds_co 	= thz_get_option('lshe/active/h/co','');
		$ls_hovereds_bg 	= thz_get_option('lshe/active/h/bg','');
		$ls_hovereds_bo 	= thz_get_option('lshe/active/h/bo','');
		
		$ls_actives_co 	= thz_get_option('lshe/active/a/co','');
		$ls_actives_bg 	= thz_get_option('lshe/active/a/bg','');
		$ls_actives_bo 	= thz_get_option('lshe/active/a/bo','');

		if($ls_tives_co  !='' || $ls_tives_bg  !='' || $ls_tives_bo  !=''){
			$add_css .='.thz-brightness-light .header_holder .thz-menu > li.level0 > span > a.itemlink{';
			if($ls_tives_co  !=''){
				$add_css .='color:'.$ls_tives_co .';';
			}
			if($ls_tives_bg  !=''){
				$add_css .='background:'.$ls_tives_bg .';';
			}
			if($ls_tives_bo  !=''){
				$add_css .='border-color:'.$ls_tives_bo .';';
			}
			$add_css .='}';
		}

		if($ls_hovereds_co  !='' || $ls_hovereds_bg  !='' || $ls_hovereds_bo  !=''){
			$add_css .='.thz-brightness-light .header_holder .thz-menu > li.level0 > span > a.itemlink:hover{';
			if($ls_hovereds_co  !=''){
				$add_css .='color:'.$ls_hovereds_co .';';
			}
			if($ls_hovereds_bg  !=''){
				$add_css .='background:'.$ls_hovereds_bg .';';
			}
			if($ls_hovereds_bo  !=''){
				$add_css .='border-color:'.$ls_hovereds_bo .';';
			}
			$add_css .='}';
		}				
		if($ls_actives_co  !='' || $ls_actives_bg  !='' || $ls_actives_bo  !=''){
			$add_css .='.thz-brightness-light .header_holder .thz-menu > li.level0 > span > a.itemlink.activepath{';
			if($ls_actives_co  !=''){
				$add_css .='color:'.$ls_actives_co .';';
			}
			if($ls_actives_bg  !=''){
				$add_css .='background:'.$ls_actives_bg .';';
			}
			if($ls_actives_bo  !=''){
				$add_css .='border-color:'.$ls_actives_bo .';';
			}
			$add_css .='}';
		}
		
	}
	
	
	
	if(thz_detect_lateral_header()){
		
		$hemw 		= thz_get_option('hemmx/w',300);
		$hems 		= thz_get_option('hemmx/s',15); 
		$hemmx_t 	= thz_get_option('hemmx/t',null);
		$hemmx_l 	= thz_get_option('hemmx/l',null);
		$hemmx_lh 	= thz_get_option('hemmx/lh',null);
		$hemmx_h 	= thz_get_option('hemmx/h',null);
				
		$add_css .='.header-lateral-table .header-lateral-sidebar,';
		$add_css .='.header-lateral-table .header-lateral-footer{';
		$add_css .='padding-left:'.thz_property_unit($hems,'px').';';
		$add_css .='padding-right:'.thz_property_unit($hems,'px').';';
		$add_css .='}';
		
		

		if($hemmx_t  !=''){
			$add_css .='.header-lateral-sidebar,';
			$add_css .='.header-lateral-footer{';
			$add_css .='color:'.$hemmx_t.';';
			$add_css .='}';
		}
		
		if($hemmx_l  !=''){
			$add_css .='.header-lateral-footer a{';
			$add_css .='color:'.$hemmx_l.';';
			$add_css .='}';
		}
		
		if($hemmx_lh  !=''){
			$add_css .='.header-lateral-footer a:hover{';
			$add_css .='color:'.$hemmx_lh.';';
			$add_css .='}';
		}
		
		if($hemmx_h  !=''){
			$add_css .='.header-lateral-sidebar h1,';
			$add_css .='.header-lateral-sidebar h2,';
			$add_css .='.header-lateral-sidebar h3,';
			$add_css .='.header-lateral-sidebar h4,';
			$add_css .='.header-lateral-sidebar h5,';
			$add_css .='.header-lateral-sidebar h6{';
			$add_css .='color:'.$hemmx_h.';';
			$add_css .='}';
		}
		
		if($headers != 'offcanvas'){
			
			$add_css .='#header_holder.header-'.$headers.'{width:'.thz_property_unit($hemw,'px').';}';
			
			if('mini' == $headers || 'miniright' == $headers){
				
				$mini_poz = 'mini' == $headers ? 'left' : 'right';
				$add_css .='#header_holder.header-'.$headers.' .header-lateral-table{min-width:'.thz_property_unit($hemw,'px').';}';
				
				$add_css .='.thz-offcanvas-pageblock-holder{';
				$add_css .= 'padding-'.esc_attr($mini_poz).':'.thz_property_unit($hemw,'px').';';
				$add_css .='}';
			}
			
		}else{
			
			
			$offcanvas_type		= thz_get_option('hofmx/t','push'); 
			$offcanvas_poz		= thz_get_option('hofmx/p','left');
			$offcanvas_bg		= thz_get_option('hofmx/bg','#ffffff');
			$overlay_color 		= thz_get_option('hofmx/oc','');
			$close_i 			= thz_get_option('hofmx/ci','');
			$header_icon 		= thz_get_option('hicmx/i','');
			$header_icona 		= thz_get_option('hicmx/a','');
			$show_count 		= thz_get_option('hicmx/ico','hide');
			$inactives_co 		= thz_get_option('sthe/active/i/co','');
			$hovereds_co 		= thz_get_option('sthe/active/h/co','');
			$ds_inactives_co 	= thz_get_option('dshe/active/i/co','');
			$ds_hovereds_co 	= thz_get_option('dshe/active/h/co','');
			$ls_inactives_co 	= thz_get_option('lshe/active/i/co','');
			$ls_hovereds_co 	= thz_get_option('lshe/active/h/co','');
			$body_frame			= thz_get_option('bf/m','inactive');
			
			if($offcanvas_type =='push'){
				
				
				$canvas_push = $offcanvas_poz =='right' ? '-'.thz_property_unit($hemw,'px'): thz_property_unit($hemw,'px');

				$add_css .='.canvasOpen{margin-left:'.$canvas_push.';}';
				
			}
			
			if($offcanvas_type !='overlay'){
				
				$poz_px 	= $body_frame == 'active' ?  thz_get_option('bf/w',20) : 0;

				if($poz_px > 0){
					
					$add_css .='.thz-offcanvas-menu{';
					$add_css .= esc_attr($offcanvas_poz).':'.thz_property_unit($poz_px - $hemw,'px').';';
					$add_css .='top:'.thz_property_unit($poz_px,'px').';';
					$add_css .='}';
				}

				$add_css .='.thz-offcanvas-menu.off-to-'.$offcanvas_poz.'{';
				$add_css .='width:'.thz_property_unit($hemw,'px').';';
				$add_css .= esc_attr($offcanvas_poz).':-'.thz_property_unit($hemw,'px').';';
				$add_css .='}';
								
				$add_css .='.canvasOpen .thz-offcanvas-menu{';
				$add_css .= esc_attr($offcanvas_poz).':'.thz_property_unit($poz_px,'px').';';
				$add_css .='}';

				$add_css .='.thz-offcanvas-pageblock-holder{';
				$add_css .= 'padding-'.esc_attr($offcanvas_poz).':'.thz_property_unit($hemw,'px').';';
				$add_css .='}';
								
			}
			
			if($offcanvas_type =='overlay'){
				$add_css .='.header_offcanvas .thz-offcanvas-menu.off-to-overlay .header-lateral-in{width:'.thz_property_unit($hemw,'px').';}';
			}
			
			
			
			if($overlay_color  !=''){
				$add_css .='html.canvasOpen .thz-canvas-overlay{';
				$add_css .='background-color:'.$overlay_color.';';
				$add_css .='}';	
			}
			
			$add_css .='.thz-offcanvas-menu{';
			$add_css .='background-color:'.$offcanvas_bg.';';
			$add_css .='}';	
			
			if($header_icon  !=''){
				$add_css .='.thz-canvas-burger .thz-burger-inner{';
				$add_css .='background-color:'.$header_icon.';';
				$add_css .='}';
				
				$add_css .='.header-offcanvas .thz-offcanvas-buttons a{';
				$add_css .='color:'.$header_icon.';';
				$add_css .='}';
			}
			
			if($header_icona  !=''){
				$add_css .='.thz-canvas-burger:hover .thz-burger-inner,';
				$add_css .='html.canvasOpen .thz-canvas-burger.is-active .thz-burger-inner,';
				$add_css .='.thz-canvas-burger.is-active .thz-burger-inner{';
				$add_css .='background-color:'.$header_icona.';';
				$add_css .='}';
				
				$add_css .='.header-offcanvas .thz-offcanvas-buttons a:hover,';
				$add_css .='.header-offcanvas .thz-offcanvas-buttons a:focus{';
				$add_css .='color:'.$header_icona.';';
				$add_css .='}';
			}
			
			if($close_i  !=''){
				$add_css .='html.canvasOpen .thz-burger.is-active .thz-burger-inner,';
				$add_css .='.thz-burger.is-active .thz-burger-inner{';
				$add_css .='background-color:'.$close_i.';';
				$add_css .='}';
			}
			
						
			// woo conter badge
			if ( $show_count == 'show' ){
				
				$woo_badge_cbg 	= thz_get_option('hicmx/cbg','');
				$woo_badge_cco 	= thz_get_option('hicmx/cco','');	
				
				if($woo_badge_cbg  !='' || $woo_badge_cco  !=''){
					$add_css .='.thz-offcanvas-buttons .thz-woo-cart-badge{';
					if($woo_badge_cbg  !=''){
						$add_css .='background-color:'.$woo_badge_cbg.';';
					}
					if($woo_badge_cco  !=''){
						$add_css .='color:'.$woo_badge_cco.';';
					}
					$add_css .='}';		
				}
				
			}
			
			
			// offcanvas sticky
			if($inactives_co  !=''){
	
				$add_css .='.thz-sticky-header.isvisible.header-offcanvas .thz-burger-inner{';
				$add_css .='background-color:'.$inactives_co.';';
				$add_css .='}';
				
				$add_css .='.thz-sticky-header.isvisible.header-offcanvas .thz-offcanvas-buttons a{';
				$add_css .='color:'.$inactives_co.';';
				$add_css .='}';
			}
			
			if($hovereds_co  !=''){
				$add_css .='.thz-sticky-header.isvisible.header-offcanvas .thz-offcanvas-buttons .thz-burger-box:hover .thz-burger-inner{';
				$add_css .='background-color:'.$hovereds_co.';';
				$add_css .='}';
				
				$add_css .='.thz-sticky-header.isvisible.header-offcanvas .thz-offcanvas-buttons a:hover,';
				$add_css .='.thz-sticky-header.isvisible.header-offcanvas .thz-offcanvas-buttons a:focus{';
				$add_css .='color:'.$hovereds_co.';';
				$add_css .='}';
			}
			
			// offcanvas dark body class
			if($ds_inactives_co  !=''){
	
				$add_css .='html.header_offcanvas .thz-brightness-dark .thz-sticky-header .thz-burger-inner{';
				$add_css .='background-color:'.$ds_inactives_co.';';
				$add_css .='}';
				
				$add_css .='html.header_offcanvas .thz-brightness-dark .thz-sticky-header .thz-offcanvas-buttons a{';
				$add_css .='color:'.$ds_inactives_co.';';
				$add_css .='}';
			}
			
			if($ds_hovereds_co  !=''){
				$add_css .='html.header_offcanvas .thz-brightness-dark .thz-sticky-header .thz-offcanvas-buttons .thz-burger-box:hover .thz-burger-inner{';
				$add_css .='background-color:'.$ds_hovereds_co.';';
				$add_css .='}';
				
				$add_css .='html.header_offcanvas .thz-brightness-dark .thz-sticky-header .thz-offcanvas-buttons a:hover,';
				$add_css .='html.header_offcanvas .thz-brightness-dark .thz-sticky-header .thz-brightness-dark .thz-offcanvas-buttons a:focus{';
				$add_css .='color:'.$ds_hovereds_co.';';
				$add_css .='}';
			}
			
			// offcanvas light body class
			if($ls_inactives_co  !=''){

				$add_css .='html.header_offcanvas .thz-brightness-light .thz-sticky-header .thz-burger-inner{';
				$add_css .='background-color:'.$ls_inactives_co.';';
				$add_css .='}';
				
				$add_css .='html.header_offcanvas .thz-brightness-light .thz-sticky-header .thz-offcanvas-buttons a{';
				$add_css .='color:'.$ls_inactives_co.';';
				$add_css .='}';
			}
			
			if($ls_hovereds_co  !=''){
				$add_css .='html.header_offcanvas .thz-brightness-light .thz-sticky-header .thz-offcanvas-buttons .thz-burger-box:hover .thz-burger-inner{';
				$add_css .='background-color:'.$ls_hovereds_co.';';
				$add_css .='}';
				
				$add_css .='html.header_offcanvas .thz-brightness-light .thz-sticky-header .thz-offcanvas-buttons a:hover,';
				$add_css .='html.header_offcanvas .thz-brightness-light .thz-sticky-header .thz-offcanvas-buttons a:focus{';
				$add_css .='color:'.$ls_hovereds_co.';';
				$add_css .='}';
			}			
		
		}
	}
	
	
	
	
	if($headers == 'mini' || $headers == 'miniright'){
		
		$hamx_i 	= thz_get_option('hamx/i','');
		$hamx_a 	= thz_get_option('hamx/a','');
		$hamx_o 	= thz_get_option('hamx/o','show');
		
		if($hamx_i  !=''){
			$add_css .='#header_holder.header-'.$headers.' .thz-burger-inner{';
			$add_css .='background-color:'.$hamx_i.';';
			$add_css .='}';
			
			$add_css .='#header_holder.header-'.$headers.' .thz-social-links a{';
			$add_css .='color:'.$hamx_i.';';
			$add_css .='}';
		}
		
		if($hamx_a  !=''){
			$add_css .='html.canvasOpen #header_holder.header-'.$headers.' .thz-burger-inner,';
			$add_css .='#header_holder.header-'.$headers.' .thz-burger-box:hover .thz-burger-inner{';
			$add_css .='background-color:'.$hamx_a.';';
			$add_css .='}';
			
			$add_css .='#header_holder.header-'.$headers.' .thz-social-links a:hover{';
			$add_css .='color:'.$hamx_a.';';
			$add_css .='}';
		}
		if($hamx_o  =='show'){
			
			$hamx_oc 	= thz_get_option('hamx/oc','');
			if($hamx_oc  !=''){
				$add_css .='html.canvasOpen .thz-canvas-overlay{';
				$add_css .='background-color:'.$hamx_oc.';';
				$add_css .='}';	
			}
		}
	}
	
	if($headers == 'mini' || $headers == 'miniright' || $headers == 'offcanvas'){
		
		$hami_mx_o 	= $headers == 'offcanvas' ? 'hamimx' :'hamx';
		$hami_hih 	= thz_get_option($hami_mx_o.'/hih',2);
		$hami_hfw 	= thz_get_option($hami_mx_o.'/hfw',20);
		$hami_hsw 	= thz_get_option($hami_mx_o.'/hsw',20);
		$hami_htw 	= thz_get_option($hami_mx_o.'/htw',20);
		$hami_hid 	= thz_get_option($hami_mx_o.'/hid',5);
		
		$add_css .='.thz-burger-inner:before{';
		$add_css .='width:'.thz_property_unit($hami_hfw,'px').';';
		$add_css .='top:-'.thz_property_unit($hami_hid,'px').';';
		$add_css .='}';
		
		$add_css .='.thz-burger-inner{';
		$add_css .='width:'.thz_property_unit($hami_hsw,'px').';';
		$add_css .='}';	
		
		$add_css .='.thz-burger-inner:after{';
		$add_css .='width:'.thz_property_unit($hami_htw,'px').';';
		$add_css .='bottom:-'.thz_property_unit($hami_hid,'px').';';
		$add_css .='}';	
		
		$add_css .='.thz-burger-inner, .thz-burger-inner:before, .thz-burger-inner:after{';
		$add_css .='height:'.thz_property_unit($hami_hih,'px').';';
		$add_css .='}';	
		
		$max_w  = max($hami_hfw, $hami_hsw, $hami_htw);
		$add_css .='.thz-burger-box,';
		$add_css .='.thz-burger.is-active .thz-burger-inner,';
		$add_css .='.thz-burger.is-active .thz-burger-inner:before,';
		$add_css .='.thz-burger.is-active .thz-burger-inner:after,';
		$add_css .='.mobileOpen .thz-burger .thz-burger-inner,';
		$add_css .='.mobileOpen .thz-burger .thz-burger-inner:before,';
		$add_css .='.mobileOpen .thz-burger .thz-burger-inner:after,';
		$add_css .='.canvasOpen .thz-burger .thz-burger-inner,';
		$add_css .='.canvasOpen .thz-burger .thz-burger-inner:before,';
		$add_css .='.canvasOpen .thz-burger .thz-burger-inner:after{';
		$add_css .='width:'.thz_property_unit($max_w,'px').';';
		$add_css .='}';			
		
	}
	
	
	$add_css .='.thz-layout-boxed .header_holder{max-width:'.thz_property_unit($site_width,'px').';}';

	return $add_css;
	
}

/**
 * Footer css
 */
function _thz_footer_css(){
	
	$add_css	='';
	
	$display_mode	= thz_get_option ('footer_mx/m','both');
	
	if(thz_fw_loaded() && thz_fw_active() && $display_mode == 'block'){
		$page_blocks 	= thz_get_option('fpb',null);
		thz_page_blocks_css( $page_blocks );
	}
	
	if('both' == $display_mode || 'footer' == $display_mode){
	
		$footer_boxstyle			= thz_print_box_css( thz_get_option('footer_boxstyle',null));
		$footable_bs				= thz_print_box_css( thz_get_option('footable_bs',null));
		$footer_colors 				= thz_get_option('footer_colors',array());
		$footer_colors_print 		= thz_print_colorset($footer_colors,'.footer',false);
		$footer_fonts 				= thz_get_option('fof',array());
		
		if(!empty($footer_boxstyle)){
			$add_css .='.footer{'.$footer_boxstyle.'}';
		}
		if(!empty($footable_bs)){
			$add_css .='.footer .thz-footer-table{'.$footable_bs.'}';
		}
		if($footer_colors_print){
			$add_css .= $footer_colors_print;	
		}
		
		if( !empty( $footer_fonts )){
			
			$menu_typo 	= thz_get_option('fof/0/n',array());
			$menu_color = thz_get_option('fof/0/n/color',null);
			$menu_hover = thz_get_option('fof/0/n/hovered',null);
			
			$add_css .='.thz-copyright{'.thz_typo_css(thz_get_option('fof/0/b',array())).'}';
			$add_css .='.thz-footer-menu {'.thz_typo_css($menu_typo).'}';
			
			if( $menu_color && $menu_color !=''){
				$add_css .='.thz-footer-menu a{color:'.$menu_color.';}';
			}
			
			if( $menu_hover && $menu_hover !=''){
				$add_css .='.thz-footer-menu a:hover{color:'.$menu_hover.';}';
			}
		}
	}
	
	
	// scrolll to top
	$scrolltop		= thz_get_option('scrolltop','enable');
	
	if('enable' == $scrolltop){
		
		$size_sh		= thz_get_option('scrolltc/size_sh',null);
		$radius_sh		= thz_get_option('scrolltc/radius_sh',null);
		$size_f			= thz_get_option('scrolltc/size_f',null);
		$bottom			= thz_get_option('scrolltc/bottom',70);
		$right			= thz_get_option('scrolltc/right',20);
		$color_i		= thz_get_option('scrolltc/color_i',null);
		$color_sh		= thz_get_option('scrolltc/color_sh',null);
		$color_b		= thz_get_option('scrolltc/color_b',null);
		
		
		$add_css .= '.thz-to-top{';
		$add_css .= 'width:'.thz_property_unit($size_sh,'px').';';
		$add_css .= 'height:'.thz_property_unit($size_sh,'px').';';
		$add_css .= 'border-radius:'.thz_property_unit($radius_sh,'px').';';
		$add_css .= 'background-color:'.$color_sh.';';
		$add_css .= 'border-color:'.$color_b.';';
		if($right !=''){
			$add_css .= 'right:'.thz_property_unit($right,'px').';';
		}
		if($bottom !=''){
			$add_css .= 'bottom:'.thz_property_unit($bottom,'px').';';
		}
		$add_css .= '}';
		
		
	  $add_css .= '.thz-to-top i{';
	  $add_css .= 'line-height:calc('.thz_property_unit($size_sh,'px').' - 4px);';
	  $add_css .= 'font-size:'.thz_property_unit($size_f,'px').';';
	  if( $color_i !='' ){
		  $add_css .= 'color:'.$color_i.';';
		  
	  }
	  $add_css .= '}';
		
	}
	
	$add_css .= thz_preloader(true);
	
	return $add_css;
}


/**
 * Typography CSS
 */
function _thz_typography_css(){
	
	$add_css	='';
	
	$headings_typo 				= thz_typo_css(thz_get_option('headings_font'));
	$h1_font 					= thz_typo_css(thz_get_option('h1_font'));
	$h2_font 					= thz_typo_css(thz_get_option('h2_font'));
	$h3_font 					= thz_typo_css(thz_get_option('h3_font'));
	$h4_font 					= thz_typo_css(thz_get_option('h4_font'));
	$h5_font  					= thz_typo_css(thz_get_option('h5_font'));
	$h6_font  					= thz_typo_css(thz_get_option('h6_font'));
	$link_color 				= thz_get_option('sitelc/lc','color_2');
	$hovered_color 				= thz_get_option('sitelc/lh','color_1');
	$an_plus_el 				= thz_get_option('thzbelsp/ae',30);
	$h_plus_an 					= thz_get_option('thzbelsp/ha',15);
	
	// site colors 
	$add_css .=	'a,.thz-btn-none{color:'.$link_color.';}';
	$add_css .=	'a:focus,a:hover,.thz-btn-none:hover,.thz-btn-hover .thz-btn-none {color:'.$hovered_color.';}';	
	
	// headings
	if(!empty($headings_typo)){
		$add_css .= 'h1,h2,h3,h4,h5,h6{'.$headings_typo.'}';
	}
	$add_css .=	'h1{'.$h1_font.'}h2{'.$h2_font.'}h3{'.$h3_font.'}';
	$add_css .= 'h4{'.$h4_font.'}h5{'.$h5_font.';}h6{'.$h6_font.'}';
	
	
	// block elements
	$add_css .='* + h1,* + h2,* + h3,* + h4,* + h5,* + h6,* + p,* + ul,* + ol,* + dl,* + fieldset,* + address,* + blockquote,* + .thz-content-85,* + .thz-content-75,
* + .thz-content-50,* + .thz-content-40,* + .thz-stretch-content,* + pre,* + figure, * + form,* + table,.wp-caption,.gallery-caption,[class*=\'thz-text-column-\']{';
	$add_css .='margin-top:'.thz_property_unit($an_plus_el,'px').';';
	$add_css .='}';	
	
	$add_css .='h1 + *,h2 + *,h3 + *,h4 + *,h5 + *,h6 + *{';
	$add_css .='margin-top:'.thz_property_unit($h_plus_an,'px').';';
	$add_css .='}';	
	
	// text columns
	$add_css .='[class*=\'thz-text-column-\']{';
	$add_css .='column-gap:'.thz_property_unit($an_plus_el,'px').';';
	$add_css .='}';	
	
	// selections
	$add_css .='::selection{background:color_1;color:color_contrast;}';
	$add_css .='::-moz-selection{background:color_1;color:color_contrast;}';	
	
	// elements with main color

	$add_css .='.thz-bold-primary,';
	$add_css .='.thz-primary-color,';
	$add_css .='.thz-bold-primary a,';
	$add_css .='.thz-primary-color a{';
	$add_css .='color:color_1!important;';
	$add_css .='}';	
	
	$add_css .='.mejs-controls .mejs-time-rail .mejs-time-current{';
	$add_css .='background:color_1;';
	$add_css .='}';	
	
	$add_css .='.thz-highlight{';
	$add_css .='background:color_1!important;';
	$add_css .='color:color_contrast!important;';
	$add_css .='}';	
	
	$add_css .='.thz-underline-primary,';
	$add_css .='blockquote,';
	$add_css .='blockquote.quote-right,';
	$add_css .='blockquote.quote-centered  p:first-of-type:after{';
	$add_css .='border-color:color_1!important;';
	$add_css .='}';	
	
	$add_css .='.thz-dropcap.box:first-letter,';
	$add_css .='.thz-dropcap.rounded:first-letter,';
	$add_css .='.thz-dropcap.circle:first-letter{';
	$add_css .='background:color_1!important;';
	$add_css .='color:color_contrast!important;';
	$add_css .='}';	
	
	$add_css .='.thz-dropcap.outline:first-letter{';
	$add_css .='border-color:color_1;';
	$add_css .='color:color_1!important;';
	$add_css .='background:none!important;';
	$add_css .='}';	


	// theme button
	$add_css .=	thz_theme_button_css();

	// main layout CSS
	$add_css .=	_thz_layout_css();
	
		
	return $add_css;
}


/**
 * Theme button CSS based on color_1
 * theme palette color value
 */
function thz_theme_button_css(){
	
	// theme button
	$color_1 			= thz_get_theme_option('theme_palette/color_1','#039bf4');
	$thz_color 			= new Thz_Color($color_1);
	$color_darker 		= $thz_color->darker(5);
	$contrast			= $thz_color->isLight($color_1) ? '#000000' : '#ffffff';


	$add_css = '.thz-button.thz-btn-theme,';
	$add_css .= '.thz-button.thz-btn-theme:focus {';
	$add_css .= 'background-color:'.esc_attr($color_1).';';
	$add_css .= 'border-color:'.esc_attr( $color_darker ).';';
	$add_css .= 'color:'.esc_attr( $contrast ).';';
	$add_css .= '}';
	$add_css .= '.thz-btn-outline .thz-button.thz-btn-theme {';
	$add_css .= 'color:'.esc_attr( $color_darker ).';';
	$add_css .= '}';
	$add_css .= '.thz-button.thz-btn-theme:hover,';
	$add_css .= '.thz-btn-hover .thz-button.thz-btn-theme {';
	$add_css .= 'background-color:'.esc_attr( $color_darker ).';';
	$add_css .= 'border-color:'.esc_attr( $color_darker ).';';
	$add_css .= 'color:'.esc_attr( $contrast ).';';
	$add_css .= '}';	
	
	return $add_css;
}

/**
 * Site spacings CSS
 */
function _thz_site_spacings_css(){
	
	$container_spacing			= thz_get_option('spacings/con',30);
	$columns_spacing			= thz_get_option('spacings/col',30);
	$section_spacing			= thz_get_option('spacings/sec',3);	
	$blocks_spacing_t			= thz_get_option('blocks_spacing/t',60);
	$blocks_spacing_b			= thz_get_option('blocks_spacing/b',60);
	$blocks_spacing_h			= thz_get_option('blocks_spacing/h',60);
	
	$add_css  =	'.thz-container,.thz-sliders-container{';
	$add_css .=	'padding-left:'.thz_property_unit($container_spacing,'px').';';
	$add_css .=	'padding-right:'.thz_property_unit($container_spacing,'px').';';
	$add_css .=	'}';
	
	$add_css .=	'.holders{';
	$add_css .=	'margin-left:-'.thz_property_unit($blocks_spacing_h,'px').';margin-right:0px;';
	$add_css .=	'}';
	
	$add_css .=	'.thz-block-spacer{';
	$add_css .=	'padding:'.thz_property_unit($blocks_spacing_t,'px');
	$add_css .=	' 0px';
	$add_css .=	' '.thz_property_unit($blocks_spacing_b,'px');
	$add_css .=	' '.thz_property_unit($blocks_spacing_h,'px').';';
	$add_css .=	'}';
	
	$add_css .=	'.thz-container .thz-row{margin-left:-'.thz_property_unit($columns_spacing,'px').';margin-right:0px;}';
	$add_css .=	'* + .thz-row{margin-top:'.thz_property_unit($columns_spacing,'px').';}';
	
	$add_css .=	'.thz-column{padding-left:'.thz_property_unit($columns_spacing,'px').';padding-right:0px;}';
	$add_css .= '* + .thz-shc{margin-top:'.thz_property_unit($columns_spacing,'px').';}';
	
	$add_css .=	'@media screen and (max-width: 979px) {';
	$add_css .=	'.thz-column .thz-column  + .thz-column,';
	$add_css .=	'.thz-column + .thz-column + .thz-column{';
	$add_css .=	'margin-top:'.thz_property_unit($columns_spacing,'px').';';
	$add_css .=	'}';
	$add_css .=	'}';
	
	$add_css .=	'@media screen and (max-width: 767px) {';
	$add_css .=	'.thz-column + .thz-column{';
	$add_css .=	'margin-top:'.thz_property_unit($columns_spacing,'px').';';
	$add_css .=	'}';
	$add_css .=	'}';
	
	$unit 		= thz_get_unit($columns_spacing,'px');
	$sec_space = (float) $section_spacing * (float) $columns_spacing;
	$add_css .=	'.thz-page-builder-content .thz-section{';
	$add_css .=	'padding-top:'.thz_property_unit($sec_space,$unit).';';
	$add_css .=	'padding-bottom:'.thz_property_unit($sec_space,$unit).';';
	$add_css .=	'}';
	
	$add_css .=	'.thz-column .widget + .widget{margin-top:'.thz_property_unit($columns_spacing,'px').';}';	
	
	return $add_css;
	
}

/**
 * Responsive site spacings CSS
 */
function _thz_site_responsive_spacings_css(){
	
	$sp_res	= thz_get_option('sp_res',array());
	
	if(empty($sp_res)){
		return;
	}
	
	foreach($sp_res as $re_spo){
		
		$at = thz_akg('m/b',$re_spo);

		$container_spacing			= thz_akg('s/con',$re_spo);
		$columns_spacing			= thz_akg('s/col',$re_spo);
		$section_spacing			= thz_akg('s/sec',$re_spo);	
		$blocks_spacing_t			= thz_akg('bs/t',$re_spo);
		$blocks_spacing_b			= thz_akg('bs/b',$re_spo);
		$blocks_spacing_h			= thz_akg('bs/h',$re_spo);
		
		$add_css  =	'.thz-container,.thz-sliders-container{';
		$add_css .=	'padding-left:'.thz_property_unit($container_spacing,'px').';';
		$add_css .=	'padding-right:'.thz_property_unit($container_spacing,'px').';';
		$add_css .=	'}';
		
		$add_css .=	'.holders{';
		$add_css .=	'margin-left:-'.thz_property_unit($blocks_spacing_h,'px').';margin-right:0px;';
		$add_css .=	'}';
		
		$add_css .=	'.thz-block-spacer{';
		$add_css .=	'padding:'.thz_property_unit($blocks_spacing_t,'px');
		$add_css .=	' 0px';
		$add_css .=	' '.thz_property_unit($blocks_spacing_b,'px');
		$add_css .=	' '.thz_property_unit($blocks_spacing_h,'px').';';
		$add_css .=	'}';
		
		$add_css .=	'.thz-container .thz-row{margin-left:-'.thz_property_unit($columns_spacing,'px').';margin-right:0px;}';
		$add_css .=	'* + .thz-row{margin-top:'.thz_property_unit($columns_spacing,'px').';}';
		
		$add_css .=	'.thz-column{padding-left:'.thz_property_unit($columns_spacing,'px').';padding-right:0px;}';
		$add_css .= '* + .thz-shc{margin-top:'.thz_property_unit($columns_spacing,'px').';}';
		
		if( 979 == $at ){
			$add_css .=	'.thz-column .thz-column  + .thz-column,';
			$add_css .=	'.thz-column + .thz-column + .thz-column{';
			$add_css .=	'margin-top:'.thz_property_unit($columns_spacing,'px').';';
			$add_css .=	'}';
		}
		
		if( 767 == $at ){
			$add_css .=	'.thz-column + .thz-column{';
			$add_css .=	'margin-top:'.thz_property_unit($columns_spacing,'px').';';
			$add_css .=	'}';
		}

		$unit 		= thz_get_unit($columns_spacing,'px');
		$sec_space = (float) $section_spacing * (float) $columns_spacing;
		$add_css .=	'.thz-page-builder-content .thz-section{';
		$add_css .=	'padding-top:'.thz_property_unit($sec_space,$unit).';';
		$add_css .=	'padding-bottom:'.thz_property_unit($sec_space,$unit).';';
		$add_css .=	'}';
		
		$add_css .=	'.thz-column .widget + .widget{margin-top:'.thz_property_unit($columns_spacing,'px').';}';	
		
		
		Thz_Doc::set('responsive', $add_css, $at );
	}
	
}

/**
 * Containers CSS
 */
function _thz_containers_css(){
	
	$add_css					='';
	$site_width					= thz_property_unit(thz_get_option('site_width',1200),'px');
	$body_typo 					= thz_typo_css(thz_get_option('body_font',null));
	$body_frame					= thz_get_option('bf/m','inactive');
	
	$body_boxstyle_array		= thz_get_option('body_boxstyle',array());
	$body_boxstyle				= thz_print_box_css($body_boxstyle_array);
	$wrapper_boxstyle_array		= thz_get_option('wrapper_boxstyle',array());
	$wrapper_boxstyle			= thz_print_box_css($wrapper_boxstyle_array);


	$main_boxstyle_array		= thz_get_option('main_boxstyle');
	$main_boxstyle				= thz_print_box_css($main_boxstyle_array);	
	
	$fpr_boxstyle				= thz_print_box_css(thz_full_rows(true,'bg'));

	$add_css .= 'body{'. $body_typo . $body_boxstyle .'}';
	$add_css .= '.thz-wrapper{'. $wrapper_boxstyle .'}';
	$add_css .= '.thz-main{'. $main_boxstyle .'}';
	
	// spacings
	$add_css .= _thz_site_spacings_css();
	
	// responsive spacings
	_thz_site_responsive_spacings_css();

	$add_css .=	'.thz-site-width,.thz-wrapper.thz-site-width .thz-reveal-footer{max-width:'.$site_width.';}';
	
	$overlay_bg	= thz_get_theme_option('med_over/background',null);
	
	$add_css .= '.thz-hover-mask{';	
	$add_css .= _thz_media_overlay_background_css_print($overlay_bg);	
	$add_css .= '}';
	
	
	// body frame 
	if('active' == $body_frame ){
		
		$bodyf_width 	= thz_get_option('bf/w',20);
		$bodyf_color 	= thz_get_option('bf/c','#ffffff');
		$bodyf_shs 		= thz_get_option('bf/ss',20);
		$bodyf_shc 		= thz_get_option('bf/sc','rgba(0,0,0,0.1)');
		
		if($bodyf_color !=''){
			$add_css .=	'.thz-body-frame *{';
			$add_css .=	'background:'.$bodyf_color.';';
			$add_css .=	'}';
		}
		
		
		if( $bodyf_width > 0 ){
			
			$add_css .=	'.thz-body-is-framed .thz-body-box{';
			$add_css .=	'margin:'.thz_property_unit($bodyf_width,'px').';';
			$add_css .=	'}';
			
			$add_css .=	'.thz-bf-top,.thz-bf-bottom{';
			$add_css .=	'height:'.thz_property_unit($bodyf_width,'px').';';
			$add_css .=	'}';
			
			$add_css .=	'.thz-bf-left,.thz-bf-right{';
			$add_css .=	'width:'.thz_property_unit($bodyf_width,'px').';';
			$add_css .=	'}';	
		}
		
		if( $bodyf_shs > 0 ){
			$add_css .=	'.thz-body-frame .shadow{';
			$add_css .=	'box-shadow: 0 0px '.thz_property_unit($bodyf_shs,'px').' 0px '.$bodyf_shc.';';
			$add_css .=	'}';
		}
		
		if(thz_detect_lateral_header()){
			
			$add_css .=	'.thz-body-is-framed .header-lateral-in{';
			$add_css .=	'height:calc(100% - '.thz_property_unit(( $bodyf_width * 2 ),'px').');';
			$add_css .=	'}';			

			
		}
		
	}
	
	// custom overlays
	$custom_overlays	= thz_get_theme_option('co',null);
	
	if(!empty($custom_overlays)){
		
		foreach($custom_overlays as $co){
			
			$co_el = $co['e'];
			$co_bg = $co['o']['background'];
			
			if('.thz-post-media' == $co_el){
				$co_el = '.thz-single-post-media';
			}
			
			$add_css .= $co_el.' .thz-hover-mask{';	
			$add_css .= _thz_media_overlay_background_css_print($co_bg);	
			$add_css .= '}';			
		}
		
		unset($custom_overlays,$co);
	}
	
	// full page rows bg
	if($fpr_boxstyle){
		$add_css .=	'main .thz-page-builder-content{';
		$add_css .=	$fpr_boxstyle;
		$add_css .=	'}';
	}
	

	return $add_css;
	
}



/**
 * Prints overlay background
 */
function _thz_media_overlay_background_css_print($options){
	
	if(!is_array($options)){
		
		return;
		
	}
	
	$type 		= thz_akg('type',$options,'color');
	$color1 	= thz_akg('color1',$options,'');
	
	$bg_color	= ( $color1 == '' || $type == 'none' ) ? 'none' : $color1;
	
	$add_css 	='background:'.$bg_color.';';
	
	if('gradient' == $type){
		
		$gradient 	= thz_akg('gradient',$options,'vertical');
		$color2 	= thz_akg('color2',$options,'');
		$color2 	= $color2 == '' ? $color1  : $color2 ;
		
		if('horizontal' == $gradient){
			
			$add_css .='background: -moz-linear-gradient(0deg,'.$color1.' 0%,'.$color2.' 100%);';
			$add_css .='background: -webkit-linear-gradient(0deg,'.$color1.' 0%,'.$color2.' 100%);';
			$add_css .='background: -o-linear-gradient(0deg,'.$color1.' 0%,'.$color2.' 100%);';
			$add_css .='background: -ms-linear-gradient(0deg,'.$color1.' 0%,'.$color2.' 100%);';
			$add_css .='background: linear-gradient(90deg,'.$color1.' 0%,'.$color2.' 100%);';
			
		}else if('vertical' == $gradient){
			
			$add_css .='background: -moz-linear-gradient(-90deg,'.$color1.' 0%,'.$color2.' 100%);';
			$add_css .='background: -webkit-linear-gradient(-90deg,'.$color1.' 0%,'.$color2.' 100%);';
			$add_css .='background: -o-linear-gradient(-90deg,'.$color1.' 0%,'.$color2.' 100%);';
			$add_css .='background: -ms-linear-gradient(-90deg,'.$color1.' 0%,'.$color2.' 100%);';
			$add_css .='background: linear-gradient(180deg,'.$color1.' 0%,'.$color2.' 100%);';			
			
			
		}else if('radial' == $gradient){
			
			$add_css .='background: -moz-radial-gradient(50% 50%,circle farthest-corner,'.$color1.'  0%,'.$color2.' 100%);';
			$add_css .='background: -webkit-radial-gradient(50% 50%,circle farthest-corner,'.$color1.'  0%,'.$color2.' 100%);';
			$add_css .='background: -o-radial-gradient(50% 50%,circle farthest-corner,'.$color1.'  0%,'.$color2.' 100%);';
			$add_css .='background: -ms-radial-gradient(50% 50%,circle farthest-corner,'.$color1.'  0%,'.$color2.' 100%);';
			$add_css .='background: radial-gradient(circle farthest-corner at 50% 50%,'.$color1.' 0%,'.$color2.' 100%);';		
			
			
		}
	}
	
		
	return $add_css;
	
}


/**
 * Prints gradient background
 */
function _thz_gradient_background_css($color1,$color2,$type){

	$add_css 	='background:'.$color1.';';
	$color2 	= $color2 == '' ? $color1  : $color2 ;
	
	if('horizontal' == $type){
		
		$add_css .='background: -moz-linear-gradient(0deg,'.$color1.' 0%,'.$color2.' 100%);';
		$add_css .='background: -webkit-linear-gradient(0deg,'.$color1.' 0%,'.$color2.' 100%);';
		$add_css .='background: -o-linear-gradient(0deg,'.$color1.' 0%,'.$color2.' 100%);';
		$add_css .='background: -ms-linear-gradient(0deg,'.$color1.' 0%,'.$color2.' 100%);';
		$add_css .='background: linear-gradient(90deg,'.$color1.' 0%,'.$color2.' 100%);';
		
	}else if('vertical' == $type){
		
		$add_css .='background: -moz-linear-gradient(90deg,'.$color1.' 0%,'.$color2.' 100%);';
		$add_css .='background: -webkit-linear-gradient(90deg,'.$color1.' 0%,'.$color2.' 100%);';
		$add_css .='background: -o-linear-gradient(90deg,'.$color1.' 0%,'.$color2.' 100%);';
		$add_css .='background: -ms-linear-gradient(90deg,'.$color1.' 0%,'.$color2.' 100%);';
		$add_css .='background: linear-gradient(180deg,'.$color1.' 0%,'.$color2.' 100%);';			
		
		
	}else if('radial' == $type){
		
		$add_css .='background: -moz-radial-gradient(50% 50%,circle farthest-corner,'.$color2.'  0%,'.$color1.' 100%);';
		$add_css .='background: -webkit-radial-gradient(50% 50%,circle farthest-corner,'.$color2.'  0%,'.$color1.' 100%);';
		$add_css .='background: -o-radial-gradient(50% 50%,circle farthest-corner,'.$color2.'  0%,'.$color1.' 100%);';
		$add_css .='background: -ms-radial-gradient(50% 50%,circle farthest-corner,'.$color2.'  0%,'.$color1.' 100%);';
		$add_css .='background: radial-gradient(circle farthest-corner at 50% 50%,'.$color2.' 0%,'.$color1.' 100%);';		
		
	}
	
	return $add_css;
	
}

/**
 * Prints gradient border
 */
function _thz_gradient_border_css($color1,$color2,$type){

	$add_css 	='';
	if('horizontal' == $type){
		
		$add_css .='-moz-border-image: -moz-linear-gradient(0deg,'.$color1.' 0%,'.$color2.' 100%);';
		$add_css .='-webkit-border-image: -webkit-linear-gradient(0deg,'.$color1.' 0%,'.$color2.' 100%);';
		$add_css .='-o-border-image: -o-linear-gradient(0deg,'.$color1.' 0%,'.$color2.' 100%);';
		$add_css .='-ms-border-image: -ms-linear-gradient(0deg,'.$color1.' 0%,'.$color2.' 100%);';
		$add_css .='border-image: linear-gradient(90deg,'.$color1.' 0%,'.$color2.' 100%);';
		
	}else if('vertical' == $type){
		
		$add_css .='-moz-border-image: -moz-linear-gradient(90deg,'.$color1.' 0%,'.$color2.' 100%);';
		$add_css .='-webkit-border-image: -webkit-linear-gradient(90deg,'.$color1.' 0%,'.$color2.' 100%);';
		$add_css .='-o-border-image: -o-linear-gradient(90deg,'.$color1.' 0%,'.$color2.' 100%);';
		$add_css .='-ms-border-image: -ms-linear-gradient(90deg,'.$color1.' 0%,'.$color2.' 100%);';
		$add_css .='border-image: linear-gradient(180deg,'.$color1.' 0%,'.$color2.' 100%);';			
		
		
	}else if('radial' == $type){
		
		$add_css .='-moz-border-image: -moz-radial-gradient(50% 50%,circle farthest-corner,'.$color2.'  0%,'.$color1.' 100%);';
		$add_css .='-webkit-border-image: -webkit-radial-gradient(50% 50%,circle farthest-corner,'.$color2.'  0%,'.$color1.' 100%);';
		$add_css .='-o-border-image: -o-radial-gradient(50% 50%,circle farthest-corner,'.$color2.'  0%,'.$color1.' 100%);';
		$add_css .='-ms-border-image: -ms-radial-gradient(50% 50%,circle farthest-corner,'.$color2.'  0%,'.$color1.' 100%);';
		$add_css .='border-image: radial-gradient(circle farthest-corner at 50% 50%,'.$color2.' 0%,'.$color1.' 100%);';		
		
	}
	
	$add_css 	.='border-image-slice: 1;';
	
	return $add_css;
	
}

/**
 * Prints text gradiend color
 */
function _thz_gradient_text_css($options,$custom = false){
	
	if(!is_array($options)){
		return false;
	}
	
	$mode 		= $custom ? 'active' : thz_akg('mode',$options,'inactive');
	
	if('active' == $mode){
		
		$color1 	= thz_akg('color1',$options,'');
		$color2 	= thz_akg('color2',$options,'');
		$color2 	= $color2 == '' ? $color1  : $color2 ;
		
		if($color1 != '' && $color1 != ''){
		
			$gradient 	= thz_akg('gradient',$options,'vertical');
			$add_css 	='color:'.$color1.';';
			
			if('horizontal' == $gradient){
				
				$add_css .='background: -moz-linear-gradient(0deg,'.$color1.' 0%,'.$color2.' 100%);';
				$add_css .='background: -webkit-linear-gradient(0deg,'.$color1.' 0%,'.$color2.' 100%);';
				$add_css .='background: -o-linear-gradient(0deg,'.$color1.' 0%,'.$color2.' 100%);';
				$add_css .='background: -ms-linear-gradient(0deg,'.$color1.' 0%,'.$color2.' 100%);';
				$add_css .='background: linear-gradient(90deg,'.$color1.' 0%,'.$color2.' 100%);';
				
			}else if('vertical' == $gradient){
				
				$add_css .='background: -moz-linear-gradient(90deg,'.$color1.' 0%,'.$color2.' 100%);';
				$add_css .='background: -webkit-linear-gradient(90deg,'.$color1.' 0%,'.$color2.' 100%);';
				$add_css .='background: -o-linear-gradient(90deg,'.$color1.' 0%,'.$color2.' 100%);';
				$add_css .='background: -ms-linear-gradient(90deg,'.$color1.' 0%,'.$color2.' 100%);';
				$add_css .='background: linear-gradient(180deg,'.$color1.' 0%,'.$color2.' 100%);';			
				
				
			}else if('radial' == $gradient){
				
				$add_css .='background: -moz-radial-gradient(50% 50%,circle farthest-corner,'.$color1.'  0%,'.$color2.' 100%);';
				$add_css .='background: -webkit-radial-gradient(50% 50%,circle farthest-corner,'.$color1.'  0%,'.$color2.' 100%);';
				$add_css .='background: -o-radial-gradient(50% 50%,circle farthest-corner,'.$color1.'  0%,'.$color2.' 100%);';
				$add_css .='background: -ms-radial-gradient(50% 50%,circle farthest-corner,'.$color1.'  0%,'.$color2.' 100%);';
				$add_css .='background: radial-gradient(circle farthest-corner at 50% 50%,'.$color1.' 0%,'.$color2.' 100%);';		
				
				
			}

			$add_css .='-webkit-background-clip: text;';
			$add_css .='-webkit-text-fill-color: transparent;';
			$add_css .='background-clip: text;';
			$add_css .='text-fill-color: transparent;padding-top:1px;';	
			
			$add_css .='-webkit-background-clip: text;';
			$add_css .='-webkit-text-fill-color: transparent;';
			$add_css .='background-clip: text;';
						
			return $add_css;
			
		}
	}
	
	return false;
}

/**
 * Widgets generator CSS print
 */
function _thz_widgets_generator_css_print(){
	
	$footer_display_mode	= thz_get_option ('footer_mx/m','both');
	
	$add_css	='';
	
	$add_css .= thz_widget_generator_css('ah',thz_get_option('above_header_section'));
	$add_css .= thz_widget_generator_css('uh',thz_get_option('under_header_section'));
	if('both' == $footer_display_mode || 'widgets' == $footer_display_mode){
		$add_css .= thz_widget_generator_css('f',thz_get_option('footer_section'));
	}
	$add_css .= thz_widget_generator_css('tp',thz_get_option('top_panel'));
	$add_css .= thz_widget_generator_css('bp',thz_get_option('bottom_panel'));
	$add_css .= thz_widget_generator_css('sp',thz_get_option('side_panel'));
	
	return $add_css;
}


/**
 * Posts pagination css
 */
function _thz_pagination_css($selector ='',$options = false){
	
	
	if($options){
		
		$pagl_bs	= thz_akg('pagl_bs',$options,null);

		$absh 		= thz_akg('pagination_active/bsh',$options,'s');
		$abg 		= thz_akg('pagination_active/bg',$options,'#f2f2f2');
		$ac	 		= thz_akg('pagination_active/color',$options,'#5b5b5b');
		
		$ibsh 		= thz_akg('pagination_inactive/bsh',$options,'h');
		$ibg 		= thz_akg('pagination_inactive/bg',$options,'#ffffff');
		$ic	 		= thz_akg('pagination_inactive/color',$options,'#121212');
		$ibc 		= thz_akg('pagination_inactive/bcolor',$options,'#eaeaea');
		$idc 		= thz_akg('pagination_inactive/disabled',$options,'#ccc');
		
		$hbsh 		= thz_akg('pagination_hovered/bsh',$options,'s');
		$hbg 		= thz_akg('pagination_hovered/bg',$options,'#e8e8e8');
		$hc	 		= thz_akg('pagination_hovered/color',$options,'#121212');
		$hbc 		= thz_akg('pagination_hovered/bcolor',$options,'#eaeaea');
		
		$space		= thz_akg('pagination_metrics/space',$options,5);
		$pagf 		= thz_akg('pagf',$options,null);
		$phbs		= thz_akg('phbs',$options,null);

		
	}else{
		
		$pagl_bs	= thz_get_theme_option('pagl_bs',null);
		$absh		= thz_get_theme_option('pagination_active/bsh','s');
		$abg 		= thz_get_theme_option('pagination_active/bg','#f2f2f2');
		$ac	 		= thz_get_theme_option('pagination_active/color','#5b5b5b');
		
		$ibsh		= thz_get_theme_option('pagination_inactive/bsh','h');
		$ibg 		= thz_get_theme_option('pagination_inactive/bg','#ffffff');
		$ic	 		= thz_get_theme_option('pagination_inactive/color','#121212');
		$ibc 		= thz_get_theme_option('pagination_inactive/bcolor','#eaeaea');
		$idc 		= thz_get_theme_option('pagination_inactive/disabled','#ccc');
		
		$hbsh		= thz_get_theme_option('pagination_hovered/bsh','s');
		$hbg 		= thz_get_theme_option('pagination_hovered/bg','#e8e8e8');
		$hc	 		= thz_get_theme_option('pagination_hovered/color','#121212');
		$hbc 		= thz_get_theme_option('pagination_hovered/bcolor','#eaeaea');
		
		$space		= thz_get_theme_option('pagination_metrics/space',5);
		$pagf 		= thz_get_theme_option('pagf',null);
		$phbs		= thz_get_theme_option('phbs',null);
	
	}
	
	$add_css	= '';
	$width		= thz_akg('boxsize/width',$pagl_bs,'');
	$height		= thz_akg('boxsize/height',$pagl_bs,'');
	$p_top		= thz_akg('padding/top', $pagl_bs, 10 );
	$p_bot		= thz_akg('padding/bottom', $pagl_bs, 10 );
	$bradius	= (float) thz_akg('borderradius/top-left',$pagl_bs);
	$vpadding   = (float)$p_top + (float) $p_bot;
	$box_shadow = thz_akg('boxshadow',$pagl_bs,'');
	$borders 	= thz_akg('borders',$pagl_bs,'');
	$b_top		= thz_akg('top', $borders, 0 );
	
	if( !empty($box_shadow) ){
		$print_css = new Thz_Css_Generator();
		$box_shadow = $print_css->box_shadow(array('boxshadow'=>$box_shadow));
	}

	// holder 
	$phbs_print	= thz_print_box_css($phbs);
	if(!empty($phbs_print)){
		$add_css .= $selector.'.thz-pagination-nav{'.$phbs_print.'}';
	}
	
	// all
	$pagl_bs_print = thz_print_box_css($pagl_bs);
	$add_css .= $selector.'.thz-pagination a,'.$selector.'.thz-pagination span{';
	if(!empty($pagl_bs_print)){
		$add_css	.= $pagl_bs_print;
		if($height !=''){
			$lineheight = (float)$height - (float) ($vpadding);
			$add_css	.='line-height:'.thz_property_unit($lineheight - (float)$b_top,'px').';';
		}
	}
	if(empty($borders)){
		$add_css	.='border:none;';
	}
	if($bradius < 1){
		$add_css	.='border-radius:0;';
	}
	$add_css	.= thz_typo_css($pagf);
	$add_css	.='}';
	
	
	// inactive
	$add_css	.= $selector.'.thz-pagination .inactive,'.$selector.'.thz-pagination.no-spacing .thz-pagination-dots{';
	$add_css	.='background:'.($ibg == '' ? 'transparent' : $ibg).';';
	$add_css	.='border-color:'.($ibc == '' ? 'transparent' : $ibc).';';
	$add_css	.='color:'.($ic == '' ? 'transparent' : $ic).';';
	if( $ibsh =='h'){
		$add_css	.='box-shadow:none;';
	}
	$add_css	.='}';

	// disabled
	$add_css	.= $selector.'.thz-pagination .thz-pagination-disabled{';
	$add_css	.='color:'.($idc == '' ? 'transparent' : $idc).';';
	$add_css	.='}';
	
	// current
	$add_css	.= $selector.'.thz-pagination .thz-pagination-current{';
	$add_css	.='background:'.($abg == '' ? 'transparent' : $abg).';';
	$add_css	.='color:'.($ac == '' ? 'transparent' : $ac).';';
	if($absh =='h'){
		$add_css	.='box-shadow:none;';
	}
	$add_css	.='}';

	// hover
	$add_css	.= $selector.'.thz-pagination a:hover{';
	$add_css	.='background:'.($hbg == '' ? 'transparent' : $hbg).';';
	$add_css	.='border-color:'.($hbc == '' ? 'transparent' : $hbc).';';
	$add_css	.='color:'.($hc == '' ? 'transparent' : $hc).';';
	if($hbsh =='h'){
		$add_css	.='box-shadow:none;';
	}
	if($hbsh =='s' && !empty($box_shadow)){
		$add_css	.= $box_shadow;
	}
	$add_css	.='}';
	
	// radius when no space
	if($bradius > 0 && $space == 0){
		
		$add_css	.= $selector.'.thz-pagination.no-spacing.has-radius li:first-of-type a,';
		$add_css	.= $selector.'.thz-pagination.no-spacing.has-radius li:first-of-type span{';
		$add_css	.='border-top-left-radius:'.thz_property_unit($bradius,'px').';';
		$add_css	.='border-bottom-left-radius:'.thz_property_unit($bradius,'px').';';
		$add_css	.='}';	
		
		$add_css	.= $selector.'.thz-pagination.no-spacing.has-radius li:last-of-type a,';
		$add_css	.= $selector.'.thz-pagination.no-spacing.has-radius li:last-of-type span{';
		$add_css	.='border-top-right-radius:'.thz_property_unit($bradius,'px').';';
		$add_css	.='border-bottom-right-radius:'.thz_property_unit($bradius,'px').';';
		$add_css	.='}';	
	}

	return $add_css;
}

/**
 * Navigation static
 */
function _thz_navigation_static() {
	
	if( !is_single() ){
		return;
	}	
	
	$post_type 	= get_post_type();
	$nav_data 	= 'bnav_mx';
	$custom_nav = 'cup_nav';
	
	if ( $post_type == 'fw-portfolio' ) {
		$nav_data = 'pnav_mx';
		$custom_nav = false;
	}
	
	if ( $post_type == 'product' ) {
		$nav_data = 'woonav_mx';
		$custom_nav = false;
	}

	if ( $post_type == 'fw-event' ) {
		$nav_data = 'enav_mx';
		$custom_nav = false;
	}
	
	$show_navigation	= thz_get_option( $nav_data . '/v', 'show' );
	
	if( $show_navigation == 'hide' ){
		return;
	}

	$add_css 	='';
	$cup_nav	= $custom_nav ? thz_get_option( $custom_nav, null ) : array();
	$prefix		= !empty($cup_nav) ? $custom_nav.'/0/' : '';
	$pnav_loc	= thz_get_option($prefix.'pnav_loc','fixed');
	
	if( $pnav_loc !='fixed' ){
		
		$mode 		= thz_get_option($prefix.'btnel_mx/m','table');
		$nrbs 		= thz_print_box_css( thz_get_option($prefix.'nrbs',null));
		$nhbs 		= thz_print_box_css( thz_get_option($prefix.'nhbs',null));
		$btnf 		= thz_typo_css(thz_get_option($prefix.'btnf',null));
		$btnptf 	= thz_typo_css(thz_get_option($prefix.'btnptf',null));		
		
		if(!empty($nrbs)){
			$add_css .= '.thz-post-navigation-row{'.$nrbs.'}';
		}
				
		if(!empty($nhbs)){
			$add_css .= '.thz-post-navigation{'.$nhbs.'}';
		}
	
		if('table' == $mode){

			$btvp 	= thz_get_option($prefix.'btnm/vp',8);
			$bthp 	= thz_get_option($prefix.'btnm/hp',14);
			$btbw 	= thz_get_option($prefix.'btnm/bw',1);
			$btbs 	= thz_get_option($prefix.'btnm/bs','solid');
			$btbr 	= thz_get_option($prefix.'btnm/br',0);
			$btbg 	= thz_get_option($prefix.'btnc/bg','#ffffff');
			$btbgh 	= thz_get_option($prefix.'btnc/bgh','#fafafa');
			$btco 	= thz_get_option($prefix.'btnc/co','#5b5b5b');
			$btcoh 	= thz_get_option($prefix.'btnc/coh','#121212');
			$btbc 	= thz_get_option($prefix.'btnc/bc','#eaeaea');
			$btbch 	= thz_get_option($prefix.'btnc/bch','#eaeaea');
			$btnthbs 	= thz_print_box_css( thz_get_option($prefix.'btnthbs',null));
			
			if(!empty($btnthbs)){
				$add_css .= '.thz-nav-thumb{'.$btnthbs.'}';
			}
			
			$add_css .='.thz-nav-link a,.thz-nav-link-empty{';
			$add_css .='padding:'.thz_property_unit($btvp,'px').' '.thz_property_unit($bthp,'px').';';
			if($btbg !=''){
				$add_css .='background:'.$btbg.';';
			}
			if($btco !=''){
				$add_css .='color:'.$btco.';';
			}
			if($btbw > 0 && $btbc !=''){
				$add_css .='border: '.thz_property_unit($btbw,'px').' '.$btbs.' '.$btbc.';';
			}
			if($btbr > 0){
				$add_css .='border-radius:'.thz_property_unit($btbr,'px').';';
			}
			$add_css .='}';
			
			if($btbgh !='' || $btcoh !='' || $btbw > 0){
				$add_css .='.thz-nav-link a:hover{';
				if($btbgh !=''){
					$add_css .='background:'.$btbgh.';';
				}
				if($btcoh !=''){
					$add_css .='color:'.$btcoh.';';
				}
				if($btbw > 0 && $btbch !=''){
					$add_css .='border-color:'.$btbch.';';
				}
				$add_css .='}';
			}
		
		}

		if('overlay' == $mode){
			
			$min_he		= thz_get_option($prefix.'btnel_mx/mh','300');
			$btnc_ov 	= thz_get_option($prefix.'btnc/ov',null);
			$btnc_ovh 	= thz_get_option($prefix.'btnc/ovh',null);
			$btco 		= thz_get_option($prefix.'btnc/co','#5b5b5b');
			$btcoh 		= thz_get_option($prefix.'btnc/coh','#121212');		

			if($min_he !=''){
				$add_css .='.thz-nav-mode-overlay .thz-nav-wrap{';
				$add_css .='min-height:'.thz_property_unit($min_he,'px').';';
				$add_css .='}';
			}
						
			if($btco !=''){
				$add_css .='.thz-nav-link a,.thz-nav-link-empty{';
				$add_css .='color:'.$btco.';';
				$add_css .='}';
			}
			
			if($btcoh !=''){
				$add_css .='.thz-nav-link a:hover{';
				$add_css .='color:'.$btcoh.';';
				$add_css .='}';
			}
			
			if( $btnc_ov !=''){
				$add_css .='.thz-nav-mode-overlay .thz-nav-link .el-thumb:before{';
				$add_css .='background:'.esc_attr($btnc_ov).';';
				$add_css .='}';
			}
			
			if( $btnc_ovh !=''){
				$add_css .='.thz-nav-mode-overlay .thz-nav-link a:hover .el-thumb:before{';
				$add_css .='background:'.esc_attr($btnc_ovh).';';
				$add_css .='}';
			}
		}
		
		if(!empty($btnf)){
			$add_css .='.thz-nav-link .thz-nav-direction{';
			$add_css .= $btnf;
			$add_css .='}';
			$dir_hc		= thz_get_option($prefix.'btnf/hovered');
			if( $dir_hc !=''){
				$add_css .='.thz-nav-link a:hover .thz-nav-direction{';
				$add_css .='color:'.esc_attr($dir_hc).';';
				$add_css .='}';
			}
		}
		if(!empty($btnptf)){
			$add_css .='.thz-nav-link .thz-nav-title{';
			$add_css .= $btnptf;
			$add_css .='}';
			
			$title_hc		= thz_get_option($prefix.'btnptf/hovered');
			if( $title_hc !=''){
				$add_css .='.thz-nav-link a:hover .thz-nav-title{';
				$add_css .='color:'.esc_attr($title_hc).';';
				$add_css .='}';
			}
		}
			
	}
	
	if($pnav_loc =='fixed'){
		
		$bg 		= thz_get_option($prefix.'nfstyle/bg','#fafafa');
		$bcolor 	= thz_get_option($prefix.'nfstyle/bcolor','#eeeeee');
		$bwidth 	= thz_get_option($prefix.'nfstyle/width',1);
		$bstyle 	= thz_get_option($prefix.'nfstyle/style','solid');
		$bradius 	= thz_get_option($prefix.'nfstyle/radius',0);
		$ic 		= thz_get_option($prefix.'nfcolors/ic','#444444');
		$ti 		= thz_get_option($prefix.'nfcolors/ti','');
		$tih 		= thz_get_option($prefix.'nfcolors/tih','');
		$show_thumb = thz_get_option($prefix.'nfthumb/picked','show');
		
		if($bg !='' || ( $bcolor !='' && $bwidth > 0 )){
			$add_css .='.thz-fixed-nav{';
			if($bg !=''){
				$add_css .='background:'.$bg.';';
			}
			if($bcolor !='' && $bwidth > 0){
				$add_css .='border:'.thz_property_unit($bwidth,'px').' '.$bstyle.' '.$bcolor.';';
			}
			$add_css .='}';
		}
		
		if($bradius > 0 ){
			
			$add_css .='.thz-fixed-nav.nav-previous{';
			$add_css .='border-top-right-radius:'.thz_property_unit($bradius,'px').';';
			$add_css .='border-bottom-right-radius:'.thz_property_unit($bradius,'px').';';
			$add_css .='}';
			
			$add_css .='.thz-fixed-nav.nav-next{';
			$add_css .='border-top-left-radius:'.thz_property_unit($bradius,'px').';';
			$add_css .='border-bottom-left-radius:'.thz_property_unit($bradius,'px').';';
			$add_css .='}';
			
		}
		
		if($ic !=''){
			$add_css .='.thz-fixed-nav-icon{';
			$add_css .='color:'.$ic.';';
			$add_css .='}';
		}
		
		
		if($ti !=''){
			$add_css .='.thz-fixed-nav-title{';
			$add_css .='color:'.$ti.';';
			$add_css .='}';
		}
	
		if($tih !=''){
			$add_css .='.thz-fixed-nav-title:hover{';
			$add_css .='color:'.$tih.';';
			$add_css .='}';
		}
		
		if($show_thumb == 'show'){
			
			$tr = thz_get_option($prefix.'nfthumb/show/radius',0);
			if($tr > 0){
				$add_css .='.thz-fixed-nav-thumb{';
				$add_css .='border-radius:'.thz_property_unit($tr,'px').';';
				$add_css .='}';		
			}
		}
				
	}
	
	if($add_css !=''){
		return $add_css;
	}	
}


/** 
 * Search static
 */
function _thz_search_static(){
	
	if( is_search ()){
		

		$add_css 			=''; 
		$search_bs 	 		= thz_print_box_css( thz_get_theme_option('search_bs',null) );
		$show_type 			= thz_get_theme_option('search_type/picked','show');
		$show_meta 			= thz_get_theme_option('search_meta/picked','show');
		$title_font			= thz_get_theme_option('search_title');
		$search_tic			= thz_get_theme_option('search_title/color');
		$search_tih			= thz_get_theme_option('search_title/hovered');
		
		
		if(!empty($search_bs)){
			$add_css .= '.thz-search-isotope .thz-grid-item-in{'.$search_bs.'}';
		}
		
		// type
		if($show_type =='show' ){ 
		
			$type_font		= thz_typo_css( thz_get_theme_option('search_type/show/font'));
			if( ! empty( $type_font ) ){
				$add_css .='.thz-search-item-type{';
				$add_css .= $type_font;
				$add_css .='}';	
			}
				
		}
		
		// title
		$add_css .='.thz-search-item-title{';
		$add_css .= thz_typo_css($title_font);
		$add_css .='}';	

		if( $search_tic !='' ){
			$add_css .='.thz-search-item-title a{';
			$add_css .='color:'.esc_attr($search_tic).';';
			$add_css .='}';	
		}
				
		if( $search_tih !='' ){
			$add_css .='.thz-search-item-title a:hover{';
			$add_css .='color:'.esc_attr($search_tih).';';
			$add_css .='}';	
		}
		
		
		// meta
		if($show_meta =='show' ){ 
		
			$meta_font		= thz_typo_css( thz_get_theme_option('search_meta/show/font'));
			$meta_tc		= thz_get_theme_option('search_meta/show/colors/tc',null);
			$meta_lc		= thz_get_theme_option('search_meta/show/colors/lc',null);
			$meta_hlc		= thz_get_theme_option('search_meta/show/colors/hlc',null);
			$meta_sep		= thz_get_theme_option('search_meta/show/colors/sep',null);
			
			if( ! empty( $meta_font ) ){
				$add_css .='.thz-search-item-meta{';
				$add_css .= $meta_font;
				$add_css .='}';				
			}
			
			if($meta_tc !='' || $meta_lc !='' || $meta_hlc !='' || $meta_sep !=''){
				
				if( $meta_tc !=''){
					$add_css .='.thz-search-item-meta{';
					$add_css .='color:'.esc_attr($meta_tc).';';
					$add_css .='}';	
				}
				
				
				if( $meta_lc !=''){
					$add_css .='.thz-search-item-meta a{';
					$add_css .='color:'.esc_attr($meta_lc).';';
					$add_css .='}';	
				}
				
				if( $meta_hlc !=''){
					
					$add_css .='.thz-search-item-meta a:hover{';
					$add_css .='color:'.esc_attr($meta_hlc).';';
					$add_css .='}';	
					
				}
				if( $meta_sep !=''){
					
					$add_css .='.thz-search-item-meta .thz-meta-separator{';
					$add_css .='color:'.esc_attr($meta_sep).';';
					$add_css .='}';	
					
				}
		   }
	
		}

		
		if($add_css !=''){
			return $add_css;
		}
		
	}
	
}

/**
 * Cookies consent static
 */
function _thz_cookies_consent_static(){
	
	$active 		= thz_get_theme_option( 'cookcn/picked', 'inactive' );
	
	if ( 'active' == $active ) {
		
		$add_css 		='';
		$c_bs			= thz_print_box_css(thz_get_theme_option('cookcn/active/cs/bs',null));
		$c_tbs			= thz_print_box_css(thz_get_theme_option('cookcn/active/cs/cbs',null));
		$c_font			= thz_typo_css(thz_get_theme_option('cookcn/active/cs/font',null));
		$c_lc			= thz_get_theme_option('cookcn/active/cs/colors/lc',null); 
		$c_lh			= thz_get_theme_option('cookcn/active/cs/colors/lh',null);
		
		if(!empty($c_bs)){
			$add_css .='#thz_cookies_consent{';
			$add_css .= $c_bs;
			$add_css .='}';
		}
		
		$add_css .='.thz-consent-container{';
		if(!empty($c_tbs)){
			$add_css .= $c_tbs;
		}
		if(!empty($c_font)){
			$add_css .= $c_font;
		}
		$add_css .='}';

		if($c_lc !=''){
			$add_css .='.thz-consent-container a{';
			$add_css .='color:'.$c_lc.';';
			$add_css .='}';
		}
		
		if($c_lh !=''){
			$add_css .='.thz-consent-container a:hover{';
			$add_css .='color:'.$c_lh.';';
			$add_css .='}';
		}
			
		$button_data = thz_get_theme_option('cookcn/active/cs/button',array());
		$add_css .= thz_print_button_css($button_data,'.thz-consent-button');
	
		if($add_css !=''){
			return $add_css;
		}
	}
}


/**
 * Posts category static
 */
function _thz_posts_cat_static(){

	if(!is_single()){

		$add_css 				= '';
		$term_id				= thz_get_current_cat_id();
		$arch					= thz_get_theme_option('arch',array());
		$prefix					= thz_passed_var('blog_layout') =='archive' && !empty($arch) ? 'arch/0/' : '';
		$cap					= thz_get_option('cap/0',array());
		$prefix					= !empty($cap) ? 'cap/0/' : $prefix;
		
		$blog_layout_type 		= thz_get_option($prefix.'blog_layout_type/picked','classic');
		$more_button_css		= thz_get_option($prefix.'posts_pagination/click/more_button/button/css');
		$media_height_picked	= thz_get_option($prefix.'posts_style/media_height/picked','thz-ratio-16-9');
		$show_media 			= thz_get_option($prefix.'posts_style/hmx/media','show');
		
		
		
		if($show_media =='show'){
			
			$media_bs 	   	= thz_get_option($prefix.'posts_style/media_bs');
			$media_bs_print = thz_print_box_css($media_bs);			
			
			if(!empty($media_bs_print)){
				$add_css .='.thz-grid-item-media.thz-blog-post-media,';
				$add_css .='.thz-grid-item-media.thz-grid-item-media-quote,';
				$add_css .='.thz-grid-item-media.thz-grid-item-media-link{';
				$add_css .= $media_bs_print;
				$add_css .='}';	
			}
		}
		
		if($blog_layout_type === 'classic'){
			
			$media_alignment 		= thz_get_option($prefix.'blog_layout_type/classic/ma','full');
			
			if($media_alignment =='left' || $media_alignment =='right' ){
				$media_width	= thz_get_option($prefix.'blog_layout_type/classic/mx/w',40); 
				$add_css .= '.thz-item-aligned .thz-grid-item-media-holder{';
				$add_css .='width:'.$media_width.'%;';
				$add_css .='}';
				
				$add_css .= '.thz-item-aligned .thz-grid-item-intro-holder{';
				$add_css .='width:'.(100 - $media_width).'%;';
				$add_css .='}';
			}
			
			$posts_space 		= thz_get_option($prefix.'blog_layout_type/classic/mx/s',30);
			
			$add_css .='.thz-archive .thz-items-grid{';
			$add_css .='margin-left:-'.($posts_space > 1 ? $posts_space : 0).'px;';
			$add_css .='}';
		
			$add_css .='.thz-archive .thz-grid-item{';
			$add_css .='padding-left:'.($posts_space > 1 ? $posts_space : 0).'px;';
			$add_css .='}';	
		
			$add_css .='.thz-archive .thz-grid-item-in{';
			$add_css .='margin-bottom:'.$posts_space.'px;';
			$add_css .='}';
			
			$add_css .='.thz-archive .thz-items-gutter-adjust{';
			$add_css .='margin-bottom:-'.$posts_space.'px;';
			$add_css .='}';
			$add_css .='.thz-archive .thz-items-sizer{';
			$add_css .='width:100%;';
			$add_css .='}';		
			
			$alternate	= thz_get_option($prefix.'blog_layout_type/classic/mx/a','inactive');

			if( $alternate	== 'active' ){

				if(!empty($media_bs_print)){
					
					$alt_ml 		= thz_get_option($prefix.'posts_style/media_bs/margin/right',null);
					$alt_mr 		= thz_get_option($prefix.'posts_style/media_bs/margin/left',null);
					$media_radius	= thz_akg('borderradius',$media_bs,null);
					
					if($alt_ml !='' || $alt_mr !=''){
						$add_css .= '.thz-grid-item.thz-grid-item-even .thz-grid-item-media{';
						if($alt_ml !=''){
							$add_css .='margin-left:'.thz_property_unit($alt_ml,'px').';';	
						}
						if($alt_mr !=''){
							$add_css .='margin-right:'.thz_property_unit($alt_mr,'px').';';	
						}
						$add_css .='}';	
					}
					
					if(!empty($media_radius)){
						$add_css .= '.thz-grid-item.thz-grid-item-even .thz-grid-item-media{';
						$add_css .= thz_alt_radius( $media_radius ,($media_alignment == 'left' ? 'right' : 'left'));
						$add_css .='}';
						
						$add_css .='@media screen and (max-width: 979px) {';
						$add_css .='.thz-grid-item .thz-item-aligned .thz-grid-item-media{';
						$add_css .= thz_alt_radius( $media_radius ,($media_alignment == 'left' ? 'right' : 'left'),true);
						$add_css .='}';							
						$add_css .='}';
					}
					
				}
									
			}
			
		}
		
		
		if($blog_layout_type === 'grid'){
				$posts_gutter 	= thz_get_option($prefix.'blog_layout_type/grid/bgrid/gutter',15);
				$posts_col 		= thz_get_option($prefix.'blog_layout_type/grid/bgrid/columns',2);
				$add_css .='.thz-items-grid.thz-blog-layout-grid{';
				$add_css .='margin-left:-'.($posts_col > 1 ? $posts_gutter : 0).'px;';
				$add_css .='}';
				
				$add_css .='.thz-blog-layout-grid .thz-grid-item{';
				$add_css .='padding-left:'.($posts_col > 1 ? $posts_gutter : 0).'px;';
				$add_css .='}';	
				
				$add_css .='.thz-blog-layout-grid .thz-grid-item-in{';
				$add_css .='margin-bottom:'.$posts_gutter.'px;';
				$add_css .='}';	
				
				$add_css .='.thz-archive .thz-items-gutter-adjust{';
				$add_css .='margin-bottom:-'.$posts_gutter.'px;';
				$add_css .='}';
				
				$add_css .='.thz-archive .thz-items-sizer{';
				$add_css .='width:'.(100/$posts_col).'%;';
				$add_css .='}';				
		}
			
		if($media_height_picked =='custom'){
			$media_height = thz_get_option($prefix.'posts_style/media_height/custom/height',350);
			$add_css .='#thz-items-grid-'.$term_id.' .thz-grid-item-media,';
			$add_css .='#thz-items-grid-'.$term_id.' .thz-media-custom-size';
			$add_css .='{height:'.thz_property_unit ($media_height,'px').';}';
			
			
			
		}
		
		if($blog_layout_type === 'timeline'){
			
			$tl_border	= thz_get_option($prefix.'blog_layout_type/timeline/mx/b','');
			$tl_bgs		= thz_get_option($prefix.'blog_layout_type/timeline/mx/bg','');
			$tl_day		= thz_get_option($prefix.'blog_layout_type/timeline/mx/d','');
			$tl_my		= thz_get_option($prefix.'blog_layout_type/timeline/mx/my','');
			$tl_col		= thz_get_option($prefix.'blog_layout_type/timeline/mx/c',2);
			
			if($tl_border !=''){
				$add_css .='#thz-items-grid-'.$term_id.'.thz-grid-timeline:before,';
				$add_css .='#thz-items-grid-'.$term_id.' .thz-timeline-line';
				$add_css .='{background:'.$tl_border.';}';	
				
				$add_css .='#thz-items-grid-'.$term_id.' .thz-timeline-line:before,';
				$add_css .='#thz-items-grid-'.$term_id.' .thz-timeline-date';
				$add_css .='{border-color:'.$tl_border.';}';			
			}
			
			
			if($tl_bgs !=''){
				$add_css .='#thz-items-grid-'.$term_id.' .thz-timeline-line:before,';
				$add_css .='#thz-items-grid-'.$term_id.' .thz-timeline-date';
				$add_css .='{background:'.$tl_bgs.';}';			
			}
			
			if($tl_day !=''){
				$add_css .='#thz-items-grid-'.$term_id.' .thz-timeline-day';
				$add_css .='{color:'.$tl_day.';}';			
			}
			
			if($tl_my !=''){
				$add_css .='#thz-items-grid-'.$term_id.' .thz-timeline-monthyear';
				$add_css .='{color:'.$tl_my.';}';			
			}

			$add_css .='.thz-archive .thz-items-sizer{';
			$add_css .='width:'.(100/$tl_col).'%;';
			$add_css .='}';			
		}
		
		// load more button css
		
		$more_btn_data = thz_get_option($prefix.'posts_pagination/click/more_button/button',array());
		$add_css .= thz_print_button_css($more_btn_data,'#thz-items-more-'.$term_id);

		// item more button css
		$show_button	= thz_get_option($prefix.'posts_style/show_button/picked');
		if('show' == $show_button){
			$button_cbs			= thz_print_box_css(thz_get_option($prefix.'posts_style/show_button/show/cbs'));
			$item_more_btn_data	= thz_get_option($prefix.'posts_style/show_button/show/button',array());
			$add_css .= thz_print_button_css($item_more_btn_data,'#thz-items-grid-'.$term_id);	
			
			if(!empty($button_cbs)){
				$add_css .= '#thz-items-grid-'.$term_id.' .thz-grid-item-button{'.$button_cbs.'}';
			}			
		}
		
		// holder
		$holder_box_style 		= thz_get_option($prefix.'posts_style/holder_box_style');
		$holder_boxstyle_print	= thz_print_box_css($holder_box_style);
		if(!empty($holder_boxstyle_print)){
			$add_css .= '#thz-items-grid-'.$term_id.' .thz-grid-item .thz-grid-item-in{'.$holder_boxstyle_print.'}';
		}

		
		// intro box
		$introbox_bs		= thz_get_option($prefix.'posts_style/intro_bs');
		$introbox_bs_print	= thz_print_box_css($introbox_bs);
		if(!empty($introbox_bs_print)){
			$add_css .='#thz-items-grid-'.$term_id.' .thz-grid-item .thz-grid-item-intro{';
			$add_css .= $introbox_bs_print;
			$add_css .='}';	
		}
		
		
		// title
		$show_title 			= thz_get_option($prefix.'posts_style/show_title/picked');
		
		if($show_title =='show'){
			
			$title_bs		= thz_get_option($prefix.'posts_style/show_title/show/title_bs');
			$title_bs_print	= thz_print_box_css($title_bs);
			$title_font		= thz_get_option($prefix.'posts_style/show_title/show/title_font');
			$title_font		= thz_typo_css($title_font);
			$title_co		= thz_get_option($prefix.'posts_style/show_title/show/title_font/color');
			$title_hc		= thz_get_option($prefix.'posts_style/show_title/show/title_font/hovered');
			
			if(!empty($title_bs_print) || !empty($title_font)){
				$add_css .='#thz-items-grid-'.$term_id.' .thz-grid-item .thz-grid-item-title{';
				if(!empty($title_bs_print)){
					$add_css .= $title_bs_print;
				}
				if(!empty($title_font)){
					$add_css .= $title_font;
				}
				$add_css .='}';	
			}
			
			if($title_co !='' || $title_hc !=''){
				
				if( $title_co !=''){
					$add_css .='#thz-items-grid-'.$term_id.' .thz-grid-item .thz-grid-item-title a{';
					$add_css .='color:'.esc_attr($title_co).';';
					$add_css .='}';	
				}
				
				if( $title_hc !=''){
					$add_css .='#thz-items-grid-'.$term_id.' .thz-grid-item .thz-grid-item-title a:hover{';
					$add_css .='color:'.esc_attr($title_hc).';';
					$add_css .='}';
				}
			}
		}
		

		// meta
		$meta_bs		= thz_get_option($prefix.'posts_style/meta_bs');
		$meta_bs_print	= thz_print_box_css($meta_bs);
		$meta_font		= thz_get_option($prefix.'posts_style/meta_font');
		$meta_font		= thz_typo_css($meta_font);
		$meta_tc		= thz_get_option($prefix.'posts_style/meta_colors/tc');
		
		$meta_lc		= thz_get_option($prefix.'posts_style/meta_colors/lc');
		$meta_hlc		= thz_get_option($prefix.'posts_style/meta_colors/hlc');	
		$meta_sep		= thz_get_option($prefix.'posts_style/meta_colors/sep');
		
		if( !empty($meta_bs_print) || !empty($meta_font) || $meta_tc !=''){
			$add_css .='#thz-items-grid-'.$term_id.' .thz-grid-item-meta{';
			if(!empty($meta_bs_print)){
				$add_css .= $meta_bs_print;
			}
			if(!empty($meta_font)){
				$add_css .= $meta_font;
			}
			if( $meta_tc !=''){
				$add_css .='color:'.esc_attr($meta_tc).';';
			}
			$add_css .='}';	
		}
					
		if($meta_lc !='' || $meta_hlc !='' || $meta_sep !=''){

			if( $meta_lc !=''){
				$add_css .='#thz-items-grid-'.$term_id.' .thz-grid-item-meta a{';
				$add_css .='color:'.esc_attr($meta_lc).';';
				$add_css .='}';	
			}
			
			if( $meta_hlc !=''){
				
				$add_css .='#thz-items-grid-'.$term_id.' .thz-grid-item-meta a:hover{';
				$add_css .='color:'.esc_attr($meta_hlc).';';
				$add_css .='}';	
				
			}
			
			if( $meta_sep !=''){
				
				$add_css .='#thz-items-grid-'.$term_id.' .thz-grid-item-meta .thz-meta-separator{';
				$add_css .='color:'.esc_attr($meta_sep).';';
				$add_css .='}';	
				
			}
		
	   }
		   
		// footer
		$footer_bs			= thz_get_option($prefix.'posts_style/footer_bs');
		$footer_bs_print	= thz_print_box_css($footer_bs);
		$footer_font		= thz_get_option($prefix.'posts_style/footer_font');
		$footer_font		= thz_typo_css($footer_font);
		$footer_tc			= thz_get_option($prefix.'posts_style/footer_colors/tc');
		
		
		$footer_lc			= thz_get_option($prefix.'posts_style/footer_colors/lc');
		$footer_hlc			= thz_get_option($prefix.'posts_style/footer_colors/hlc');	
		$footer_sep			= thz_get_option($prefix.'posts_style/footer_colors/sep');
		
		if( !empty($footer_bs_print) || !empty($footer_font) || $footer_tc !=''){
			$add_css .='#thz-items-grid-'.$term_id.' .thz-grid-item-footer{';
			if(!empty($footer_bs_print)){
				$add_css .= $footer_bs_print;
			}
			if(!empty($footer_font)){
				$add_css .= $footer_font;
			}
			if( $footer_tc !=''){
				$add_css .='color:'.esc_attr($footer_tc).';';
			}
			$add_css .='}';	
		}
					
		if($footer_tc !='' || $footer_lc !='' || $footer_hlc !='' || $footer_sep !=''){
			
			
			if( $footer_lc !=''){
				$add_css .='#thz-items-grid-'.$term_id.' .thz-grid-item-footer a{';
				$add_css .='color:'.esc_attr($footer_lc).';';
				$add_css .='}';	
			}
			
			if( $footer_hlc !=''){
				
				$add_css .='#thz-items-grid-'.$term_id.' .thz-grid-item-footer a:hover{';
				$add_css .='color:'.esc_attr($footer_hlc).';';
				$add_css .='}';	
				
			}
			
			if( $footer_sep !=''){
				
				$add_css .='#thz-items-grid-'.$term_id.' .thz-grid-item-footer .thz-meta-separator{';
				$add_css .='color:'.esc_attr($footer_sep).';';
				$add_css .='}';	
				
			}

		
	   }
		
		// intro text
		$show_introtext			= thz_get_option($prefix.'posts_style/show_introtext/picked'); 
		
		if($show_introtext =='show'){
			
			$introtext_bs		= thz_get_option($prefix.'posts_style/show_introtext/show/introtext_bs');
			$introtext_bs_print	= thz_print_box_css($introtext_bs);			
			$introtext_font		= thz_get_option($prefix.'posts_style/show_introtext/show/introtext_font'); 
			$introtext_font		= thz_typo_css($introtext_font);
			
			if(!empty($introtext_bs_print) || !empty($introtext_font)){
				
				$add_css .='#thz-items-grid-'.$term_id.' .thz-grid-item-intro-text{';
				if(!empty($introtext_bs_print)){
					$add_css .= $introtext_bs_print;
				}
				if(!empty($introtext_font)){
					$add_css .= $introtext_font;
				}
				$add_css .='}';	
			}			
		}
		

		// icons
		$show_icons		= thz_get_option($prefix.'posts_style/show_icons/picked'); 
		if($show_icons =='show' && $show_media =='show'){
			
			$icons_co = thz_get_option($prefix.'posts_style/show_icons/show/icons_metrics/co');
			$icons_bg = thz_get_option($prefix.'posts_style/show_icons/show/iconsbg_metrics/bg');
			$icons_bgh = thz_get_option($prefix.'posts_style/show_icons/show/iconsbg_metrics/bgh');
			$icons_bs = thz_get_option($prefix.'posts_style/show_icons/show/iconsbg_metrics/bs');
			$icons_bsi = thz_get_option($prefix.'posts_style/show_icons/show/iconsbg_metrics/bsi');
			$icons_bc = thz_get_option($prefix.'posts_style/show_icons/show/iconsbg_metrics/bc');
			$icons_fs = thz_get_option($prefix.'posts_style/show_icons/show/icons_metrics/fs',16);
			
			if($icons_co !='' || $icons_bg !='' || ($icons_bsi > 0 && $icons_bc !='')){
				
				$add_css .='#thz-items-grid-'.$term_id.' .thz-grid-item-in .thz-hover-icon,';
				$add_css .='#thz-items-grid-'.$term_id.' .thz-grid-item-in .thz-hover-icon:focus{';
				if($icons_co !=''){
					$add_css .='color:'.esc_attr($icons_co).';';
				}
				if($icons_bg !=''){
					$add_css .='background:'.esc_attr($icons_bg).';';
				}
				if($icons_bsi > 0 && $icons_bc !=''){
					$add_css .='border:'.esc_attr($icons_bsi).'px '.esc_attr($icons_bs).' '.esc_attr($icons_bc).';';
				}
				$add_css .='}';	
				
				$add_css .='#thz-items-grid-'.$term_id.' .thz-grid-item-in .thz-hover-icon span{';
				$add_css .='width:'.thz_property_unit($icons_fs,'px').';';
				$add_css .='height:'.thz_property_unit($icons_fs,'px').';';	
				$add_css .='}';					
				
			}
			
			if( $icons_bgh !=''){
				$add_css .='#thz-items-grid-'.$term_id.' .thz-grid-item-in .thz-hover-icon:hover{';
				$add_css .='background:'.esc_attr($icons_bgh).';';
				$add_css .='}';					
			}
			
		}
		
		
		/* multiple slides preload calc */
		$slider_show   = thz_get_option($prefix.'posts_slider_layout/show',null);
		$slider_space  = thz_get_option($prefix.'posts_slider_layout/space',null);
		
		if($slider_show > 1 && $show_media =='show'){
			
			$add_css .= thz_slick_multiple_css('.thz-grid-item-media', $slider_show, $slider_space, 0 );

		}
		
		
		//author
		$author_mode	= thz_get_theme_option('author_imx/mode','left');
		if( is_author() && 'hide' != $author_mode ){
			
			$postauthor_bs 	   	= thz_get_theme_option('author_box_style');
			$postauthor_bs_print = thz_print_box_css($postauthor_bs);
			if(!empty($postauthor_bs_print)){
				$add_css .= '.thz-author-info{'.$postauthor_bs_print.'}';
			}
			
			$show_author_avatar = thz_get_theme_option('show_author_avatar/picked','show');
			
			if($show_author_avatar =='show'){
				
				$authoravatar_bs 	 = thz_get_theme_option('show_author_avatar/show/avatar_boxstyle');
				$authoravatar_bs_print = thz_print_box_css($authoravatar_bs);
				if(!empty($authoravatar_bs_print)){
					$add_css .= '.thz-author-info .thz-author-avatar img{'.$authoravatar_bs_print.'}';
				}					
				
			}
			
			$ah_font 	= thz_typo_css( thz_get_theme_option('author_heading'));
			$at_font 	= thz_typo_css( thz_get_theme_option('author_text'));

			$add_css .= '.thz-author-info .thz-author-info-heading{';
			$add_css .= $ah_font;
			$add_css .= '}';
			
			$add_css .= '.thz-author-info .thz-author-info-text{';
			$add_css .= $at_font;
			$add_css .= '}';

			
			// author contact
			$author_contact   = thz_get_theme_option('author_contact/picked','show');
			
			if($author_contact =='show'){
	
				$authoricon_bs 	   	 = thz_get_theme_option('author_contact/show/icon_boxstyle',null);
				$authoricon_bs_print = thz_print_box_css($authoricon_bs);
	
				$aui_fs			= thz_get_theme_option('author_contact/show/icons_metrics/fs',14);
				$aui_co			= thz_get_theme_option('author_contact/show/icons_metrics/co','');
				$aui_hc			= thz_get_theme_option('author_contact/show/icons_metrics/hc','');
				$aui_bgh		= thz_get_theme_option('author_contact/show/icons_metrics/bgh','');
				$aui_boh		= thz_get_theme_option('author_contact/show/icons_metrics/boh','');
				$aui_lab_font	= thz_typo_css ( thz_get_theme_option('author_contact/show/label_metrics',''));
				
				if(!empty($authoricon_bs_print) || $aui_fs !='' || $aui_co !=''){
					$add_css .= '.thz-author-contact{';
					if(!empty($authoricon_bs_print)){
						$add_css .= $authoricon_bs_print;
					}
					if($aui_fs !=''){
						$add_css .= 'font-size:'.thz_property_unit($aui_fs,'px').';';
					}
					if($aui_co !=''){
						$add_css .= 'color:'.$aui_co.';';
					}
					$add_css .= '}';
				}	
				
				
				if($aui_hc !='' || $aui_bgh !='' || $aui_boh !=''){
					$add_css .= '.thz-author-contact:hover{';
					if($aui_hc !=''){
						$add_css .= 'color:'.$aui_hc.';';
					}
					if($aui_bgh !=''){
						$add_css .= 'background:'.$aui_bgh.';';
					}
					if($aui_boh !=''){
						$add_css .= 'border-color:'.$aui_boh.';';
					}
					$add_css .= '}';
				}	
				
				$add_css .= '.thz-author-contact-label{';
				$add_css .= $aui_lab_font;
				$add_css .= '}';
	
			}
		}
		
		if($add_css !=''){
			return $add_css;
			
		}		
	}else{
		
		return '';	
	}
		

}


/**
 * Post single static
 */
function _thz_post_single_static(){

	if(is_single()){
			
		$add_css	   = '';
		// post
		$post_bs 	   = thz_get_option('post_box_style');
		
		$post_bs_print = thz_print_box_css($post_bs);
		if(!empty($post_bs_print)){
			$add_css .= '.thz-single-post{'.$post_bs_print.'}';
		}

		// post media
		$show_post_media   = thz_get_option('bpm/picked');
		
		if($show_post_media =='show'){
			$postmedia_bs 	   = thz_get_option('bpm/show/bs');
			$postmedia_bs_print = thz_print_box_css($postmedia_bs);
			if(!empty($postmedia_bs_print)){
				$add_css .= '.thz-post-media{'.$postmedia_bs_print.'}';
			}
			
			/* multiple slides preload calc */
			$slider_show   = thz_get_option('bpm/show/lay/show',null);
			$slider_space  = thz_get_option('bpm/show/lay/space',null);
			if($slider_show > 1){
				
				$add_css .= thz_slick_multiple_css('.thz-post-media', $slider_show, $slider_space, 0 );
				
			}
	
			// icon
			$show_media_icon	= thz_get_option('bpm/show/mi/picked'); 
			
			if($show_media_icon =='show'){
				
				$icon_co 	= thz_get_option('bpm/show/mi/show/icon_metrics/co');
				$icon_bg 	= thz_get_option('bpm/show/mi/show/iconbg_metrics/bg');
				$icon_bs 	= thz_get_option('bpm/show/mi/show/iconbg_metrics/bs');
				$icon_bsi 	= thz_get_option('bpm/show/mi/show/iconbg_metrics/bsi');
				$icon_bc 	= thz_get_option('bpm/show/mi/show/iconbg_metrics/bc');
				$icon_fs 	= thz_get_option('bpm/show/mi/show/icon_metrics/fs',16);
				
				if($icon_co !='' || $icon_bg !='' || ($icon_bsi > 0 && $icon_bc !='')){
					
					$add_css .='.thz-post-media .thz-hover-icon,';
					$add_css .='.thz-post-media  .thz-hover-icon:focus{';
					if($icon_co !=''){
						$add_css .='color:'.esc_attr($icon_co).';';
					}
					if($icon_bg !=''){
						$add_css .='background:'.esc_attr($icon_bg).';';
					}
					if($icon_bsi > 0 && $icon_bc !=''){
						$add_css .='border:'.esc_attr($icon_bsi).'px '.esc_attr($icon_bs).' '.esc_attr($icon_bc).';';
					}
					$add_css .='}';	
					
					$add_css .='.thz-post-media .thz-hover-icon span{';
					$add_css .='width:'.thz_property_unit($icon_fs,'px').';';
					$add_css .='height:'.thz_property_unit($icon_fs,'px').';';	
					$add_css .='}';					
					
				}

				
			}

			
		}
		
		
		// post title
		$show_post_title   = thz_get_option('bpt/picked','show');
		if($show_post_title =='show'){
			
			$posttitle_font		= thz_get_option('bpt/show/m',null);
			$posttitle_font		= thz_typo_css($posttitle_font);
			$posttitle_bs 	   	= thz_get_option('bpt/show/bs');
			$posttitle_bs_print = thz_print_box_css($posttitle_bs);
			$ptc 				= thz_get_option('bpt/show/c/co'); 
			$ptch 				= thz_get_option('bpt/show/c/hc');
			
			if(!empty($posttitle_bs_print) || !empty($posttitle_font)){
				$add_css .= '.thz-post-title{';
				if(!empty($posttitle_bs_print)){
					$add_css .= $posttitle_bs_print;
				}
				if(!empty($posttitle_font)){
					$add_css .= $posttitle_font;
				}
				$add_css .='}';
			}
			
			if($ptc !=''){
				$add_css .= '.thz-post-title a{';
				$add_css .='color:'.$ptc.';';
				$add_css .='}';
			}
			
			if($ptch !=''){
				$add_css .= '.thz-post-title a:hover{';
				$add_css .='color:'.$ptch.';';
				$add_css .='}';
			}
		}
		
		// post meta
		$show_post_meta   = thz_get_option('bpme/picked');
		
		if($show_post_meta =='show'){
			
			$postmeta_font		= thz_get_option('bpme/show/f',null);
			$postmeta_font		= thz_typo_css($postmeta_font);
			$postmeta_bs 	   	= thz_get_option('bpme/show/bs');
			$meta_tc			= thz_get_option('bpme/show/c/tc');
			$meta_lc			= thz_get_option('bpme/show/c/lc');
			$meta_hlc			= thz_get_option('bpme/show/c/hlc');
			$meta_sep			= thz_get_option('bpme/show/c/sep');
			$postmeta_bs_print  = thz_print_box_css($postmeta_bs);
			
			if(!empty($postmeta_bs_print) || !empty($postmeta_font)){
				$add_css .= '.thz-post-meta{';
				if(!empty($postmeta_bs_print)){
					$add_css .=$postmeta_bs_print;	
				}
				if(!empty($postmeta_font)){
					$add_css .=$postmeta_font;	
				}
				$add_css .='}';	
			}
			
			
			
			if($meta_tc !='' || $meta_lc !='' || $meta_hlc !='' || $meta_sep !=''){
				
				if( $meta_tc !=''){
					$add_css .='.thz-post-meta{';
					$add_css .='color:'.esc_attr($meta_tc).';';
					$add_css .='}';	
				}
				
				
				if( $meta_lc !=''){
					$add_css .='.thz-post-meta a{';
					$add_css .='color:'.esc_attr($meta_lc).';';
					$add_css .='}';	
				}
				
				if( $meta_hlc !=''){
					
					$add_css .='.thz-post-meta a:hover{';
					$add_css .='color:'.esc_attr($meta_hlc).';';
					$add_css .='}';	
					
				}
				
				if( $meta_sep !=''){
					
					$add_css .='.thz-post-meta .thz-meta-separator{';
					$add_css .='color:'.esc_attr($meta_sep).';';
					$add_css .='}';	
					
				}

			
		   }
			
			
			
		}


		// post content
		$postdetails_row_bs 	= thz_print_box_css( thz_get_option('bprowbs') );
		$postcontent_bs 		= thz_get_option('bpcbs');
		$postcontent_bs_print 	= thz_print_box_css($postcontent_bs);

		if(!empty($postdetails_row_bs)){
			$add_css .= '.thz-post-details-row{'.$postdetails_row_bs.'}';
		}
		
		if(!empty($postcontent_bs_print)){
			$add_css .= '.thz-entry-content{';
			if(!empty($postcontent_bs_print)){
				$add_css .=$postcontent_bs_print;	
			}
			$add_css .='}';	
		}
				
		$pc_text	   = thz_get_option('bpcc/text');
		$pc_link	   = thz_get_option('bpcc/link');
		$pc_linkh	   = thz_get_option('bpcc/linkhovered');
		$pc_headings   = thz_get_option('bpcc/headings');
		
		if($pc_text !='' || $pc_link !='' || $pc_linkh !='' || $pc_headings !=''){
			
			if( $pc_text !=''){
				
				$add_css .='.thz-entry-content{';
				$add_css .='color:'.esc_attr($pc_text).';';
				$add_css .='}';	
				
			}
			
			if( $pc_link !=''){
				
				$add_css .='.thz-entry-content a{';
				$add_css .='color:'.esc_attr($pc_link).';';
				$add_css .='}';	
				
			}
			
			if( $pc_linkh !=''){
				
				$add_css .='.thz-entry-content a:hover{';
				$add_css .='color:'.esc_attr($pc_linkh).';';
				$add_css .='}';	
				
			}
			
			if( $pc_headings !=''){
				
				$add_css .='.thz-entry-content h1,';
				$add_css .='.thz-entry-content h2,';
				$add_css .='.thz-entry-content h3,';
				$add_css .='.thz-entry-content h4,';
				$add_css .='.thz-entry-content h5,';
				$add_css .='.thz-entry-content h6{';
				$add_css .='color:'.esc_attr($pc_headings).';';
				$add_css .='}';	
				
			}				
			
		}
		
		// post footer
		$show_post_footer   = thz_get_option('bpfo/picked','show');
		
		if($show_post_footer =='show'){
			$postfooter_font		= thz_get_option('bpfo/show/f',null);
			$postfooter_font		= thz_typo_css($postfooter_font);
			$postfooter_bs 	   		= thz_get_option('bpfo/show/bs');
			$postfooter_bs_print 	= thz_print_box_css($postfooter_bs);
			$postfooter_row_bs 		= thz_print_box_css( thz_get_option('bpfo/show/rowbs') );
			
			if(!empty($postfooter_row_bs)){
				$add_css .= '.thz-post-footer-row{'.$postfooter_row_bs.'}';
			}
			
			if(!empty($postfooter_bs_print) || !empty($postfooter_font)){
				$add_css .= '.thz-post-footer{';
				if(!empty($postfooter_bs_print)){
					$add_css .=$postfooter_bs_print;	
				}
				if(!empty($postfooter_font)){
					$add_css .=$postfooter_font;	
				}
				$add_css .='}';	
			}
			
			
			$footer_tc			= thz_get_option('bpfo/show/c/tc');
			$footer_lc			= thz_get_option('bpfo/show/c/lc');
			$footer_hlc			= thz_get_option('bpfo/show/c/hlc');
			$footer_sep			= thz_get_option('bpfo/show/c/sep');
							
			if($footer_tc !='' || $footer_lc !='' || $footer_hlc !='' || $footer_sep !=''){
				
				if( $footer_tc !=''){
					$add_css .='.thz-post-footer{';
					$add_css .='color:'.esc_attr($footer_tc).';';
					$add_css .='}';	
				}
				
				
				if( $footer_lc !=''){
					$add_css .='.thz-post-footer a{';
					$add_css .='color:'.esc_attr($footer_lc).';';
					$add_css .='}';	
				}
				
				if( $footer_hlc !=''){
					
					$add_css .='.thz-post-footer a:hover{';
					$add_css .='color:'.esc_attr($footer_hlc).';';
					$add_css .='}';	
					
				}
				
				if( $footer_sep !=''){
					
					$add_css .='.thz-post-footer .thz-meta-separator{';
					$add_css .='color:'.esc_attr($footer_sep).';';
					$add_css .='}';	
					
				}
			
		   }
			
			
		}
		
		
		// post tags
		$show_post_tags   = thz_get_option('bptags/picked','hide');
		
		if($show_post_tags =='show'){
			$posttags_font		= thz_get_option('bptags/show/f',null);
			$posttags_font		= thz_typo_css($posttags_font);
			$posttags_bs 	   	= thz_get_option('bptags/show/bs');
			$posttags_bs_print 	= thz_print_box_css($posttags_bs);
			$posttags_row_bs 	= thz_print_box_css( thz_get_option('bpfo/show/rowbs') );
			
			if(!empty($posttags_row_bs)){
				$add_css .= '.thz-post-tags-row{'.$posttags_row_bs.'}';
			}
			
			if(!empty($posttags_bs_print) || !empty($posttags_font)){
				$add_css .= '.thz-single-post-tags{';
				if(!empty($posttags_bs_print)){
					$add_css .=$posttags_bs_print;	
				}
				if(!empty($posttags_font)){
					$add_css .=$posttags_font;	
				}
				$add_css .='}';	
			}
			
			$posttag_tbs 	   		= thz_print_box_css(thz_get_option('bptags/show/tbs'));
			$posttag_thbs 	   		= thz_print_box_css(thz_get_option('bptags/show/thbs'));
			$posttags_lc			= thz_get_option('bptags/show/c/lc');
			$posttags_hlc			= thz_get_option('bptags/show/c/hlc');
			$posttags_bef			= thz_get_option('bptags/show/c/bef');
			$posttags_beft			= thz_get_option('bptags/show/c/beft');			
						
			if( !empty($posttag_tbs) || $posttags_lc !=''){
				$add_css .='.thz-single-post-tags a{';
				if(!empty($posttag_tbs)){
					$add_css .=$posttag_tbs;	
				}
				if($posttags_lc !=''){
					$add_css .='color:'.esc_attr($posttags_lc).';';
				}
				$add_css .='}';	
			}
			
			if( !empty($posttag_thbs) ||  $posttags_hlc !=''){
				
				$add_css .='.thz-single-post-tags a:hover{';
				if(!empty($posttag_thbs)){
					$add_css .=$posttag_thbs;	
				}
				if($posttags_hlc !=''){
					$add_css .='color:'.esc_attr($posttags_hlc).';';
				}
				$add_css .='}';	
				
			}
					
			if( $posttags_bef !='' || $posttags_beft !=''){
				$add_css .='.thz-single-post-tags a:before{';
				if($posttags_bef !=''){
					$add_css .='color:'.esc_attr($posttags_bef).';';
				}
				if($posttags_beft !=''){
					$add_css .='content:"'.esc_attr($posttags_beft).'";';
				}
				$add_css .='}';	
			}
			
			
		}
		
		// post shares
		$show_post_shares   = thz_get_option('bps/picked','show');
		
		if($show_post_shares =='show'){
			
			$postsharing_row_bs 	= thz_print_box_css( thz_get_option('bps/show/rowbs') );
			$postshares_bs 	   	 	= thz_get_option('bps/show/bs');
			$postshares_bs_print 	= thz_print_box_css($postshares_bs);
			
			if(!empty($postsharing_row_bs)){
				$add_css .= '.thz-post-sharing-row{'.$postsharing_row_bs.'}';
			}
			
			if(!empty($postshares_bs_print)){
				$add_css .= '.thz-post-shares{'.$postshares_bs_print.'}';
			}
			
			$add_css .= thz_social_shares_css('bps/show/im','.thz-post-shares');
			
			$show_sharing_label   = thz_get_option('bps/show/sl/picked','show');
			
			if($show_sharing_label =='show'){
				$sl_font   = thz_get_option('bps/show/sl/show/f');
				$sl_font   = thz_typo_css($sl_font);
				if($sl_font !='' ){
					$add_css .= '.thz-post-shares .thz-post-share-label{';
					$add_css .= $sl_font;
					$add_css .= '}';
				}
			}
			
		}
		
		// post author
		$show_post_author   = thz_get_option('bpau/picked');
		
		if($show_post_author =='show'){
			
			$postauthor_row_bs 		= thz_print_box_css( thz_get_option('bpau/show/rowbs') );
			$postauthor_bs 	   		= thz_get_option('bpau/show/bs');
			$postauthor_bs_print 	= thz_print_box_css($postauthor_bs);
			
			if(!empty($postauthor_row_bs)){
				$add_css .= '.thz-post-author-row{'.$postauthor_row_bs.'}';
			}
			
			if(!empty($postauthor_bs_print)){
				$add_css .= '.thz-author-bio{'.$postauthor_bs_print.'}';
			}
			
			$show_author_avatar = thz_get_option('bpau/show/av/picked','show');
			
			if($show_author_avatar =='show'){
				
				$authoravatar_bs 	 = thz_get_option('bpau/show/av/show/bs');
				$authoravatar_bs_print = thz_print_box_css($authoravatar_bs);
				if(!empty($authoravatar_bs_print)){
					$add_css .= '.thz-author-bio .thz-author-avatar img{'.$authoravatar_bs_print.'}';
				}					
				
			}
			
			$ah_font 	= thz_typo_css( thz_get_option('bpau/show/ah'));
			$at_font 	= thz_typo_css( thz_get_option('bpau/show/at'));
			$al_font 	= thz_typo_css( thz_get_option('bpau/show/al'));
			$al_hc		= thz_get_option('bpau/show/al/hovered','');
			
			
			if($ah_font !=''){
				$add_css .= '.thz-author-bio .thz-author-bio-heading{';
				$add_css .= $ah_font;
				$add_css .= '}';
			}
			
			if($at_font !=''){
				$add_css .= '.thz-author-bio .thz-author-bio-text{';
				$add_css .= $at_font;
				$add_css .= '}';
			}
			
			if($al_font !=''){
				$add_css .= '.thz-author-bio .thz-author-bio-link{';
				$add_css .= $al_font;
				$add_css .= '}';
			}
			
			if($al_hc !=''){
				$add_css .= '.thz-author-bio .thz-author-bio-link:hover {color:'.$al_hc.';}';
			}
			
		}

		// post related
		$show_post_related			= thz_get_option('brel_mx/v','show');
		if($show_post_related =='show'){
			$add_css .= _thz_related_static();
		}
		
		// comments
		$add_css .= _thz_post_comments_static();
		
		if($add_css !=''){
			return $add_css;
		}	
				
	}else{
		
		return '';	
	}
}
/**
 * Posts formats static
 */
function _thz_posts_formats_static($options = false, $selector = false) {
	
	$add_css ='';

	// Audio post format
	$audio_format_colors	= $options ? thz_akg('audio_format_colors',$options) : thz_get_theme_option('audio_format_colors');
	$selector				= $selector ? $selector.' ' : '';
	
	$audio_bg  				= thz_akg('bg',$audio_format_colors,'');
	$audio_controlls  		= thz_akg('controlls',$audio_format_colors,'');
	$audio_current 			= thz_akg('current',$audio_format_colors,'');
	
	if($audio_bg !=''){
		$add_css .= $selector.'.thz-post-format-audio .thz-media-audio-holder,';
		$add_css .= $selector.'.thz-post-format-audio .thz-media-audio-holder .mejs-container .mejs-controls{';
		$add_css .='background:'.esc_attr($audio_bg).';';
		$add_css .='}';	
	}
	if($audio_controlls !=''){
		$add_css .= $selector.'.thz-post-format-audio .thz-media-audio-holder .mejs-controls .mejs-button button:before,';
		$add_css .= $selector.'.thz-post-format-audio .thz-media-audio-holder .mejs-container .mejs-controls .mejs-time,';
		$add_css .= $selector.'.thz-post-format-audio .thz-ratio-in .thz-media-audio-holder:before{';
		$add_css .='color:'.esc_attr($audio_controlls).';';
		$add_css .='}';	
		
		$add_css .= $selector.'.thz-post-format-audio .thz-media-audio-holder .mejs-controls .mejs-horizontal-volume-slider .mejs-horizontal-volume-current,';
		$add_css .= $selector.'.thz-post-format-audio .thz-media-audio-holder .mejs-controls .mejs-time-rail .mejs-time-loaded{';
		$add_css .='background:'.esc_attr($audio_controlls).';';
		$add_css .='}';	
	}
	
	
	if($audio_current !=''){
		$add_css .= $selector.'.thz-post-format-audio .thz-media-audio-holder .mejs-controls .mejs-time-rail .mejs-time-current{';
		$add_css .='background:'.esc_attr($audio_current).';';
		$add_css .='}';	
	}			
	
	
	// Quote post format
	$quote_format_colors	= $options ? thz_akg('quote_format_colors',$options) : thz_get_theme_option('quote_format_colors');
	$quote_metrics			= $options ? thz_akg('quote_metrics',$options) : thz_get_theme_option('quote_metrics');
	$quote_metrics			= thz_typo_css($quote_metrics);
	$quote_author_metrics	= $options ? thz_akg('quote_author_metrics',$options) : thz_get_theme_option('quote_author_metrics');
	$quote_author_metrics	= thz_typo_css($quote_author_metrics);
	
	if(!empty($quote_metrics)){
		
		$add_css .= $selector.'.thz-post-format-quote .thz-custom-format-title{';
		$add_css .= $quote_metrics;
		$add_css .='}';				
	}
	
	if(!empty($quote_author_metrics)){
		
		$add_css .= $selector.'.thz-post-format-quote .thz-post-format-quote-author{';
		$add_css .= $quote_author_metrics;
		$add_css .='}';				
	}
	

	$qbg  = thz_akg('bg',$quote_format_colors,'');
	$qqc  = thz_akg('qc',$quote_format_colors,'');
	$qac  = thz_akg('ac',$quote_format_colors,'');
	$qbgh = thz_akg('bgh',$quote_format_colors,'');
	$qqch = thz_akg('qch',$quote_format_colors,'');
	$qach = thz_akg('ach',$quote_format_colors,'');	
	
	
	if($qbg !=''){
		$add_css .= $selector.'.thz-post-format-quote.thz-custom-format-item{';
		$add_css .='background:'.esc_attr($qbg).';';
		$add_css .='}';	
	}
	if($qbgh !=''){
		$add_css .= $selector.'.thz-post-format-quote.thz-custom-format-item:hover{';
		$add_css .='background:'.esc_attr($qbgh).';';
		$add_css .='}';	
	}
	
	
	if($qqc !=''){
		$add_css .= $selector.'.thz-post-format-quote.thz-custom-format-item .thz-custom-format-title{';
		$add_css .='color:'.esc_attr($qqc).';';
		$add_css .='}';	
	}
	
	if($qqch !=''){
		$add_css .= $selector.'.thz-post-format-quote.thz-custom-format-item:hover .thz-custom-format-title{';
		$add_css .='color:'.esc_attr($qqch).';';
		$add_css .='}';	
	}	
	
		
	if($qac !=''){
		$add_css .= $selector.'.thz-post-format-quote.thz-custom-format-item .thz-custom-format-sub,';
		$add_css .= $selector.'.thz-post-format-quote.thz-custom-format-item:before,';
		$add_css .= $selector.'.thz-post-format-quote.thz-custom-format-item:after{';
		$add_css .='color:'.esc_attr($qac).';';
		$add_css .='}';	
	}		
	
	if($qach !=''){
		$add_css .= $selector.'.thz-post-format-quote.thz-custom-format-item:hover .thz-custom-format-sub,';
		$add_css .= $selector.'.thz-post-format-quote.thz-custom-format-item:hover:before,';
		$add_css .= $selector.'.thz-post-format-quote.thz-custom-format-item:hover:after{';
		$add_css .='color:'.esc_attr($qach).';';
		$add_css .='}';	
	}		
	
	// Link post format
	
	$link_format_colors		= $options ? thz_akg('link_format_colors',$options) : thz_get_theme_option('link_format_colors'); 
	$link_title_metrics		= $options ? thz_akg('link_title_metrics',$options) : thz_get_theme_option('link_title_metrics');
	$link_title_metrics		= thz_typo_css($link_title_metrics);
	$link_url_metrics		= $options ? thz_akg('link_url_metrics',$options) : thz_get_theme_option('link_url_metrics');
	$link_url_metrics		= thz_typo_css($link_url_metrics);
	
	if(!empty($link_title_metrics)){
		
		$add_css .= $selector.'.thz-post-format-link .thz-custom-format-title{';
		$add_css .= $link_title_metrics;
		$add_css .='}';				
	}
	
	if(!empty($link_url_metrics)){
		
		$add_css .= $selector.'.thz-post-format-link .thz-post-format-link-url{';
		$add_css .= $link_url_metrics;
		$add_css .='}';				
	}
	
	
	$lbg  = thz_akg('bg',$link_format_colors,'');
	$ltc  = thz_akg('tc',$link_format_colors,'');
	$luc  = thz_akg('uc',$link_format_colors,'');
	$lbgh = thz_akg('bgh',$link_format_colors,'');
	$ltch = thz_akg('tch',$link_format_colors,'');
	$luch = thz_akg('uch',$link_format_colors,'');	

	if($lbg !=''){
		$add_css .= $selector.'.thz-post-format-link.thz-custom-format-item{';
		$add_css .='background:'.esc_attr($lbg).';';
		$add_css .='}';	
	}
	if($lbgh !=''){
		$add_css .= $selector.'.thz-post-format-link.thz-custom-format-item:hover{';
		$add_css .='background:'.esc_attr($lbgh).';';
		$add_css .='}';	
	}
	
	
	if($ltc !=''){
		$add_css .= $selector.'.thz-post-format-link.thz-custom-format-item .thz-custom-format-title{';
		$add_css .='color:'.esc_attr($ltc).';';
		$add_css .='}';	
	}
	
	if($ltch !=''){
		$add_css .= $selector.'.thz-post-format-link.thz-custom-format-item:hover .thz-custom-format-title{';
		$add_css .='color:'.esc_attr($ltch).';';
		$add_css .='}';	
	}	
	
		
	if($luc !=''){
		$add_css .= $selector.'.thz-post-format-link.thz-custom-format-item .thz-custom-format-sub,';
		$add_css .= $selector.'.thz-post-format-link.thz-custom-format-item:before,';
		$add_css .= $selector.'.thz-post-format-link.thz-custom-format-item:after{';
		$add_css .='color:'.esc_attr($luc).';';
		$add_css .='}';	
	}		
	
	if($luch !=''){
		$add_css .= $selector.'.thz-post-format-link.thz-custom-format-item:hover .thz-custom-format-sub,';
		$add_css .= $selector.'.thz-post-format-link.thz-custom-format-item:hover:before,';
		$add_css .= $selector.'.thz-post-format-link.thz-custom-format-item:hover:after{';
		$add_css .='color:'.esc_attr($luch).';';
		$add_css .='}';	
	}

	if($add_css !=''){
		return $add_css;
	}	
	
}


/**
 * Comments static
 */
function _thz_post_comments_static() {
	
	if(	comments_open() ) {
		
		$add_css 				='';
		$comments_headings		= thz_typo_css( thz_get_option('comm_h') );
		$com_rbs				= thz_print_box_css( thz_get_option('com_rbs') );
		$com_hbs				= thz_print_box_css( thz_get_option('com_hbs') );
		$com_bbs				= thz_print_box_css( thz_get_option('com_bbs') );
		$com_t					= thz_get_option('comm_mx/t');
		$com_l					= thz_get_option('comm_mx/l');
		$com_lh					= thz_get_option('comm_mx/lh');
		
		
		//row
		if($com_rbs!=''){
			
			$add_css .='.thz-post-comments-row{';
			$add_css .= $com_rbs;
			$add_css .='}';					
		}
		
		// coomments area
		if($com_hbs!=''){
			
			$add_css .='.thz-content-row .comments-area{';
			$add_css .= $com_hbs;
			$add_css .='}';					
		}
		
		// comment body
		if($com_bbs!=''){
			
			$t_p = thz_get_option('com_bbs/padding/top');
			$r_p = thz_get_option('com_bbs/padding/right');
						
			$add_css .='ol.comment-list li.comment .comment-body,';
			$add_css .='ol.comment-list li.comment .comment_container{';
			$add_css .= $com_bbs;
			$add_css .='}';	
			
			$add_css .='ol.comment-list li.comment .reply{';
			$add_css .= 'top:'.thz_property_unit($t_p,'px').';';
			$add_css .= 'right:'.thz_property_unit($r_p,'px').';';
			$add_css .='}';				
		}
		
		// text and links colors
		if($com_t !=''){
			$add_css .= 'ol.comment-list li.comment{';
			$add_css .='color:'.esc_attr($com_t).';';
			$add_css .='}';	

		}
		
		if($com_l !=''){
			$add_css .= 'ol.comment-list li.comment a{';
			$add_css .='color:'.esc_attr($com_l).';';
			$add_css .='}';	
		}	
		
			
		if($com_lh !=''){
			$add_css .= 'ol.comment-list li.comment a:hover{';
			$add_css .='color:'.esc_attr($com_lh).';';
			$add_css .='}';	
		}	
		
		
		// heading

		if($comments_headings!=''){

			$add_css .='.comments-title,';
			$add_css .='.comment-reply-title{';
			$add_css .= $comments_headings;
			$add_css .='}';			

		}	

		if($add_css !=''){
			return $add_css;
		}		
	}	
	
}

/**
 * Posts static
 */
function _thz_posts_static() {
	
	if( thz_is_post ()){
		
		$add_css ='';
		$add_css .= _thz_posts_cat_static();
		$add_css .= _thz_post_single_static();
		$add_css .= _thz_posts_formats_static();

		if($add_css !=''){
			return $add_css;
		}
		
	}	
}



/**
 * Posts filter CSS
 */
function _thz_posts_filter_css_print($atts, $name){
	
	if(!is_array($atts)){
		return;
	}
	
	$add_css	= '';
	$fl_ac 		= thz_akg('fl/ac',$atts,null);
	$fl_ab 		= thz_akg('fl/ab',$atts,null);
	$fl_hc 		= thz_akg('fl/hc',$atts,null);
	$fl_hb 		= thz_akg('fl/hb',$atts,null);
	$filter_ta	= thz_akg('fm/ta',$atts,'left');
	
	// link
	$fl_vp					= thz_akg('fm/vp',$atts,null);
	$fl_hp					= thz_akg('fm/hp',$atts,null);
	$fl_mr					= thz_akg('fm/mr',$atts,null);
	$fl_ms					= $filter_ta == 'right' ? 'left' : 'right';
	$fl_br					= thz_akg('fm/br',$atts,null);
	$ff	   					= thz_typo_css( thz_akg('ff',$atts,null));
	$filter_bs		 		= thz_akg('filter_bs',$atts,null); 
	$filter_bs_print 		= thz_print_box_css($filter_bs);
	
	$add_css .= $name.'{';
	$add_css .='text-align:'.$filter_ta.';';	
		if(!empty($filter_bs_print)){
			$add_css .= $filter_bs_print;
		}
	$add_css .='}';	

	$add_css .= $name.' li a{';
	$add_css .='padding:'.thz_property_unit($fl_vp,'px').' '.thz_property_unit($fl_hp,'px').';';
	$add_css .='margin-'.$fl_ms.':'.thz_property_unit($fl_mr,'px').';';	
	$add_css .='border-radius:'.thz_property_unit($fl_br,'px').';';	
	
	if($fl_hc !=''){
		$add_css .='color:'.esc_attr($fl_hc).';';
	}
	if($fl_hb !=''){
		$add_css .='background:'.esc_attr($fl_hb).';';
	}
	if($ff !=''){
		$add_css .= $ff;
	}
	$add_css .='}';					
	

	if($fl_ac !='' || $fl_ab !=''){

		$add_css .= $name.' li a.active,';
		$add_css .= $name.' li a:hover{';
		if($fl_ac !=''){
			$add_css .='color:'.esc_attr($fl_ac).';';
		}
		if($fl_ab !=''){
			$add_css .='background:'.esc_attr($fl_ab).';';
		}
		$add_css .='}';					
	}
	
	
	if($fl_hc !='' || $fl_hb !=''){

		$add_css .= $name.' li a{';
		if($fl_hc !=''){
			$add_css .='color:'.esc_attr($fl_hc).';';
		}
		if($fl_hb !=''){
			$add_css .='background:'.esc_attr($fl_hb).';';
		}
		$add_css .='}';					
	}	
	
	return $add_css;
}

/**
 * Related posts CSS
 */
function _thz_related_static(){
	
		$add_css 		='';
		$prefix			= 'pr_';
		$post_type		= get_post_type();
		if($post_type =='fw-portfolio'){
			
			$prefix	= 'prr_';
			
		}else if($post_type =='fw-event'){
			
			$prefix	= 'er_';
			
		}
		
		$related_type	 = thz_get_option($prefix.'type/picked','slider');
		$rel_media		 = thz_get_option($prefix.'media/picked','show');
		$rel_title 		 = thz_get_option($prefix.'title/picked','show');
		$rel_intro		 = thz_get_option($prefix.'intro/picked','show');

		// row
		$rel_rbs 		= thz_get_option($prefix.'rbs',null);
		$rel_rbs_print  = thz_print_box_css($rel_rbs);
		if(!empty($rel_rbs_print)){
			$add_css .= '.thz-related-posts-row{'.$rel_rbs_print.'}';
		}
		
		// holder
		$rel_hbs 		= thz_get_option($prefix.'hbs',null);
		$rel_hbs_print  = thz_print_box_css($rel_hbs);
		if(!empty($rel_hbs_print)){
			$add_css .= '.thz-related-holder{'.$rel_hbs_print.'}';
		}
		
		// heading
		$rel_hebs 		= thz_get_option($prefix.'hebs',null);
		$rel_hebs_print = thz_print_box_css($rel_hebs);
		$rel_heading 	= thz_get_option($prefix.'h',null);
		$rel_heading	= thz_typo_css($rel_heading);
		
		if(!empty($rel_hebs_print) || !empty($rel_heading)){
			$add_css .= '.thz-related-holder .thz-related-heading{';
			if(!empty($rel_hebs_print)){
				$add_css .= $rel_hebs_print;
			}
			if(!empty($rel_heading)){
				$add_css .= $rel_heading;
			}
			$add_css .='}';	
		}	

		// item
		$rel_ibs 		= thz_get_option($prefix.'ibs',null);
		$rel_ibs_print  = thz_print_box_css($rel_ibs);
		if(!empty($rel_ibs_print)){
			$add_css .= '.thz-related-holder .thz-related-item-box{'.$rel_ibs_print.'}';
		}
		
		// item intro	
		if($rel_title =='show' || $rel_intro =='show'){
			$rel_inbs 		= thz_get_option($prefix.'inbs',null);
			$rel_inbs_print = thz_print_box_css($rel_inbs);
			if(!empty($rel_inbs_print)){
				$add_css .= '.thz-related-holder .thz-related-intro-holder{'.$rel_inbs_print.'}';
			}	
		}
		
							
		// media
		if($rel_media =='show'){

			$mheight  		= thz_get_option($prefix.'media/show/height',100);
			$align	  		= thz_get_option($prefix.'media/show/align/picked','full');
			$mwidth	  		= $align !='full' ? thz_get_option($prefix.'media/show/align/'.$align.'/width',40) : false;
			$rel_ind		= thz_get_option($prefix.'media/show/rel_ind/picked','icon');
			$rel_mbs 		= thz_get_option($prefix.'media/show/rel_mbs',null);
			$rel_mbs_print  = thz_print_box_css($rel_mbs);

						
			$add_css .='.thz-related-holder .thz-media-custom-size{';
			$add_css .='height:'.thz_property_unit( $mheight,'px' ).';';	
			if($mwidth){
				$add_css .='width:'.thz_property_unit( $mwidth,'%' ).';';	
			}
			if(!empty($rel_mbs_print)){
				$add_css .= $rel_mbs_print;
			}	
			$add_css .='}';	
			
			if($mwidth){
				$iwidth = 100 - $mwidth;
				$add_css .='.thz-related-holder .thz-related-intro-holder{';
				$add_css .='width:'.thz_property_unit( $iwidth,'%' ).';';
				$add_css .='}';	

			}

			// hover indicator 
			if($rel_ind == 'icon'){
				$r_ind_c	= thz_get_option($prefix.'media/show/rel_ind/icon/icon/color','');	
				$r_ind_s	= thz_get_option($prefix.'media/show/rel_ind/icon/icon/size','');
				$add_css .='.thz-related-holder .thz-hover-icon{';
				$add_css .='font-size:'.thz_property_unit( $r_ind_s,'px' ).';';
				if($r_ind_c !=''){
					$add_css .='color:'.$r_ind_c.';';	
				}
				$add_css .='}';	
			}	
			
			if($rel_ind == 'title'){
				$r_ind_f	= thz_get_option($prefix.'media/show/rel_ind/title/font',null);
				$add_css .='.thz-related-holder .thz-hover-icon{';
				$add_css .= thz_typo_css($r_ind_f);
				$add_css .='}';	
			}		
		}
		
		// title
		if($rel_title =='show'){
			
			$r_t_bs 	 = thz_print_box_css( thz_get_option($prefix.'title/show/bs',null));
			$r_t_f 		 = thz_get_option($prefix.'title/show/font',null);
			$r_t_ty		 = thz_typo_css($r_t_f);
			
			if(!empty($r_t_bs)){
				$add_css .='.thz-related-holder .thz-related-item-title{';
				$add_css .= $r_t_bs;
				$add_css .='}';					
			}
			
			if(!empty($r_t_ty)){
				$add_css .='.thz-related-holder .thz-related-item-title,';
				$add_css .='.thz-related-holder .thz-related-item-title a{';
				$add_css .= $r_t_ty;
				$add_css .='}';	
			}
			
			$add_css .= thz_hover_css('.thz-related-holder .thz-related-item-title a',thz_akg('hovered',$r_t_f));
		}
		
		// intro
		if($rel_intro =='show'){
			
			$r_int_bs		= thz_print_box_css(thz_get_option($prefix.'intro/show/bs',null));
			$r_int_f		= thz_typo_css( thz_get_option($prefix.'intro/show/font',null));
			if(!empty($r_int_bs) || !empty($r_int_f)){
				$add_css .='.thz-related-holder .thz-related-intro-text{';
				if(!empty($r_int_bs) ){
					$add_css .= $r_int_bs;
				}
				if(!empty($r_int_f) ){
					$add_css .= $r_int_f;
				}
				$add_css .='}';	
			}
			
		}

		
		if($related_type =='slider'){
		
			/* multiple slides preload calc */
			$related_show   = thz_get_option($prefix.'type/slider/layout/show',null);
			$related_space  = thz_get_option($prefix.'type/slider/layout/space',null);

			if($related_show > 1){
				$add_css .= thz_slick_multiple_css('.thz-related-holder', $related_show, $related_space, 0 );
			}
					
		}

		if($add_css !=''){
			return $add_css;
		}		
}


/**
 * Print element:hover CSS
 */
function thz_hover_css($el,$color){
	
	if(!empty($color)){
		
		$add_css  = $el.':hover{';
		$add_css .= 'color:'.$color.';';
		$add_css .='}';	
		
		return $add_css;
	}
	
	return;
}

/**
 * 404 page static
 */
function _thz_404_static(){
	
	if(!is_404()){
		return;
	}
	
	$add_css 		='';
	$etitlef		= thz_get_theme_option('etitlef',null);
	$esubf			= thz_get_theme_option('esubf',null);
	$etextf			= thz_get_theme_option('etextf',null);
	
	
	$add_css .='.thz-404-title{';
	$add_css .= thz_typo_css($etitlef);
	$add_css .='}';
	
	$add_css .='.thz-404-subtitle{';
	$add_css .= thz_typo_css($esubf);
	$add_css .='}';
	
	$add_css .='.thz-404-text{';
	$add_css .= thz_typo_css($etextf);
	$add_css .='}';	
		
		
	// load 404 back button google fonts
	
	$button_data = thz_get_theme_option('ebutton/button',array());
	$add_css .= thz_print_button_css($button_data,'.thz-404-button');



	if($add_css !=''){
		return $add_css;
	}	
}

/**
 * Woo static
*/
function _thz_woo_static(){
	
	if ( class_exists( 'WooCommerce' ) ) {
		
		if ( function_exists( 'is_woocommerce' ) ) {
			
			if ( !is_woocommerce() && !is_cart() && !is_checkout() && !thz_has_woo_shortcode() ) {
				return;
			}
			
			
			$add_css 	='';
			$woo_cat_ar	= thz_get_option('woo_cat/0',array());
			$prefix		= !empty($woo_cat_ar) ? 'woo_cat/0/' : '';
			
			
			// sub category holder
			$wooscbs		= thz_get_option($prefix.'wooscst/wooscbs',null);
			$wooscbs_print	= thz_print_box_css($wooscbs);
			if(!empty($wooscbs_print)){
				$add_css .= '.thz-woo-sub-category{'.$wooscbs_print.'}';
			}	
			
			
			
			// sub category title 
			$wooscst		= thz_get_option($prefix.'wooscst/title',null);
			$wooscst_print	= thz_print_box_css($wooscst);
			if(!empty($wooscst_print)){
				$add_css .= '.thz-woo-cat-title{'.$wooscst_print.'}';
			}	
			
			$woosctfont  = thz_typo_css(thz_get_option($prefix.'wooscst/tfont',null));
			$woosctfonth = thz_get_option($prefix.'wooscst/tfont/hovered',null); 
			
			if(!empty($woosctfont)){
				$add_css .='.thz-woo-cat-title a{';
				$add_css .= $woosctfont;	
				$add_css .='}';	
			}
			
			if($woosctfonth !=''){
				$add_css .='.thz-woo-cat-title a:hover{';
				$add_css .= 'color:'.$woosctfonth.';';	
				$add_css .='}';					
			}
	
			// product holder
			$woopbs		= thz_get_option($prefix.'woopst/woopbs',null);
			$woopbs_print	= thz_print_box_css($woopbs);
			if(!empty($woopbs_print)){
				$add_css .= '.thz-woo-grid-holder .thz-grid-item-in,.thz-woo-item-rel-holder .thz-woo-item{'.$woopbs_print.'}';
			}	

			// media 
			$woopimbs		= thz_get_option($prefix.'woopst/woopimbs',null);
			$woopimbs_print	= thz_print_box_css($woopimbs);
			if(!empty($woopimbs_print)){
				$add_css .= '.thz-woo-item-media{'.$woopimbs_print.'}';
			}
						
			// info 
			$woopibs		= thz_get_option($prefix.'woopst/woopibs',null);
			$woopibs_print	= thz_print_box_css($woopibs);
			if(!empty($woopibs_print)){
				$add_css .= '.thz-woo-item-info{'.$woopibs_print.'}';
			}					
			

			
			
			$imgh_picked		= thz_get_option($prefix.'woopst/imgh/picked','thz-ratio-16-9');
			if($imgh_picked =='custom'){
	
				$imgh_height = thz_get_option($prefix.'woopst/imgh/custom/height',350);
				$add_css .='.product .thz-grid-item-media,';
				$add_css .='.product .thz-media-custom-size';
				$add_css .='{height:'.thz_property_unit ($imgh_height,'px').';}';
				
			}
			
			// title 
			$wooptbs		= thz_get_option($prefix.'woopst/wooptbs',null);
			$wooptbs_print	= thz_print_box_css($wooptbs);
			if(!empty($wooptbs_print)){
				$add_css .= '.product .thz-woo-item-title{'.$wooptbs_print.'}';
			}	
			$wooptf  = thz_get_theme_option('woopst/wooptf',null);
			$wooptfh = thz_get_theme_option('woopst/wooptf/hovered',null); 
			
			$add_css .='.product .thz-woo-item-title a{';
			$add_css .= thz_typo_css($wooptf);	
			$add_css .='}';	
			
			if($wooptfh !=''){
				$add_css .='.product .thz-woo-item-title a:hover{';
				$add_css .= 'color:'.$wooptfh.';';	
				$add_css .='}';					
			}
			
			
			// price 
			$wooppbs		= thz_get_option($prefix.'woopst/wooppbs',null);
			$wooppbs_print	= thz_print_box_css($wooppbs);
			$woopptf  		= thz_get_option($prefix.'woopst/woopptf',null);
			$wooppoc  		= thz_get_option($prefix.'woopst/wooppoc/old',null);
			
			$add_css .= '.product .thz-woo-item-price{';
			$add_css .= $wooppbs_print;
			$add_css .= thz_typo_css($woopptf);	
			$add_css .= '}';
			
			if($wooppoc !=''){
				$add_css .='.product .thz-woo-item-price del{';
				$add_css .= 'color:'.$wooppoc.';';	
				$add_css .='}';					
			}
			
			
			
			// buttons	
			$btns_show	= thz_get_option($prefix.'woopst/btns_show','both');
			if($btns_show !='hide'){
				
				$woopbcbs		= thz_print_box_css(thz_get_option($prefix.'woopst/woopbcbs',null));
				$woopbbs		= thz_print_box_css( thz_get_option($prefix.'woopst/woopbbs',null));
				$woopbf  		= thz_get_option($prefix.'woopst/woopbf',null);
				
				if(!empty($woopbcbs)){
					$add_css .= '.product .thz-woo-buttons-container{';
					$add_css .= $woopbcbs;
					$add_css .= '}';					
					
				}
				
				$add_css .= '.product .thz-woo-item-cart-buttons,';
				$add_css .= '.product .thz-woo-item-cart-buttons:hover{';
				$add_css .= $woopbbs;
				$add_css .= thz_typo_css($woopbf);	
				$add_css .= '}';
			}
			
			// rating 
			$rating_show = thz_get_option($prefix.'woopst/wooprs/picked','show'); 
			if($rating_show =='show'){
				
				$rating_bs		= thz_print_box_css(thz_get_option($prefix.'woopst/wooprs/show/bs',null));
				$rating_color 	= thz_get_option($prefix.'woopst/wooprs/show/color','#121212');
				 
				if(!empty($rating_bs)){
					$add_css .= '.product .thz-woo-item-rating{';
					$add_css .= $rating_bs;
					$add_css .= '}';					
				}
				 
				if($rating_color !=''){
					$add_css .='.product .thz-woo-item-rating .star-rating:before,';
					$add_css .='.product .thz-woo-item-rating .star-rating span:before{';
					$add_css .= 'color:'.$rating_color.';';	
					$add_css .='}';					
				}				
			}
			
			
			// badges
			
			$woob_vp = thz_get_option($prefix.'woopbagbs/vp',8); 
			$woob_hp = thz_get_option($prefix.'woopbagbs/hp',15); 
			$woob_mt = thz_get_option($prefix.'woopbagbs/mt',15); 
			$woob_ml = thz_get_option($prefix.'woopbagbs/ml',15); 
			$woob_br = thz_get_option($prefix.'woopbagbs/br',4);
			$woob_f  = thz_get_option($prefix.'woopbf',null); 
			
			$add_css .='.product .thz-woo-item-badge{';
			$add_css .='padding:'.thz_property_unit($woob_vp,'px').' '.thz_property_unit($woob_hp,'px').';';
			$add_css .='margin:'.thz_property_unit($woob_mt,'px').' 0 0 '.thz_property_unit($woob_ml,'px').';';
			$add_css .='border-radius:'.thz_property_unit($woob_br,'px').';';
			$add_css .= thz_typo_css($woob_f);
			$add_css .='}';
			
			$sales_bg = thz_get_option($prefix.'woopbagc/sbg','#1ecb67'); 
			$sales_co = thz_get_option($prefix.'woopbagc/sco','#ffffff'); 
			
			$outofs_bg = thz_get_option($prefix.'woopbagc/obg','#ff4542'); 
			$outofs_co = thz_get_option($prefix.'woopbagc/oco','#ffffff'); 
			
			
			if($sales_bg !='' || $sales_co !=''){
				$add_css .='.product .thz-woo-item-on-sale{';
				if($sales_bg !=''){
					$add_css .= 'background:'.$sales_bg.';';
				}
				if($sales_co !=''){
					$add_css .= 'color:'.$sales_co.';';	
				}
				$add_css .='}';	
			}
						
			if($outofs_bg !='' || $outofs_co !=''){			
				$add_css .='.product .thz-woo-item-out-of-stock{';
				if($outofs_bg !=''){	
					$add_css .= 'background:'.$outofs_bg.';';
				}
				if($outofs_co !=''){	
					$add_css .= 'color:'.$outofs_co.';';	
				}
				$add_css .='}';
			}
			
			// action icons
			
			$spinn_c = thz_get_option($prefix.'woopaco/spin','#ffffff'); 
			$check_c = thz_get_option($prefix.'woopaco/check','#ffffff'); 			
			
			
			if($spinn_c !=''){
				$add_css .='.product .thz-item-adding-icon{';
				$add_css .= 'color:'.$spinn_c.';';	
				$add_css .='}';	
			}
			if($check_c !=''){
				$add_css .='.product .thz-item-in-cart-icon{';
				$add_css .= 'color:'.$check_c.';';	
				$add_css .='}';	
			}
			
			// post related
			if(is_product() || is_cart() || thz_has_woo_shortcode()){
				
				/* multiple slides preload calc */
				$rels_space  = thz_get_option('woorelgrid/gutter',30);
				$rels_show 	 = thz_get_option('woorelgrid/columns',3);

				if($rels_show > 1){
					
					$add_css .= thz_slick_multiple_css('.thz-woo-item-rel-holder', $rels_show, $rels_space, 0 );
					
				}
				if(is_product()){
				
					$ups_space  = thz_get_option('wooupgrid/gutter',30);
					$ups_show 	 = thz_get_option('wooupgrid/columns',3);
					if($ups_show > 1){
						
						$add_css .= thz_slick_multiple_css('.thz-woo-item-up-sells-holder', $ups_show, $ups_space, 0 );
						
					}
				}
			}
			
			if(is_cart()){
			
				$crs_space  = thz_get_option('woocrgrid/gutter',30);
				$crs_show 	= thz_get_option('woocrgrid/columns',3);
				if($crs_show > 1){
					
					$add_css .= thz_slick_multiple_css('.thz-woo-item-cross-sells-holder', $crs_show, $crs_space, 0 );
				}
			}
				
						
			if(is_product()){
				
				// columns space
				$wooimgcols 	= thz_get_option('wooimgcol/s',60);
				
				$add_css .='.thz-row.thz-woo-details-row{';
				$add_css .='margin-left:-'.thz_property_unit($wooimgcols,'px').';';
				$add_css .='margin-bottom:'.thz_property_unit($wooimgcols,'px').';';
				$add_css .='}';		
				
				$add_css .='.thz-row.thz-woo-details-row .thz-column{';
				$add_css .='padding-left:'.thz_property_unit($wooimgcols,'px').';';
				$add_css .='}';	
				
				// image height 
				$wooimgh_picked		= thz_get_option('wooimgh/picked','thz-ratio-16-9');
				if($wooimgh_picked =='custom'){
		
					$wooimgh_height = thz_get_option('wooimgh/custom/height',350);
					$add_css .='.thz-woo-slick-images .thz-grid-item-media,';
					$add_css .='.thz-woo-slick-images .thz-media-custom-size';
					$add_css .='{height:'.thz_property_unit ($wooimgh_height,'px').';}';
					
				}
			
				// image slider 
				/* multiple slides preload calc */
				$imgsl_space  	= thz_get_option('wooimgsl/space',0);
				$imgsl_show 	= thz_get_option('wooimgsl/show',1);
				
				if($imgsl_show > 1){
					$add_css .= thz_slick_multiple_css('.thz-woo-item-img-slick', $imgsl_show, $imgsl_space, 0 );
				}

				// thumbnail slider 
				/* multiple slides preload calc */			
				$thumb_show	 = thz_get_option('wooimgsl/showt',4);
				$thumb_space = thz_get_option('wooimgsl/spacet',20);
				$add_css .= thz_slick_multiple_css('.thz-woo-item-thumbs-slick', $thumb_show, $thumb_space, 0 );
				
				$add_css .='.thz-woo-item-thumbs-slick{';
				$add_css .='margin-top:'.thz_property_unit($thumb_space,'px').';';
				$add_css .='}';
								
				$add_css .='.thz-woo-item-thumbs-slick .slick-slide{';
				$add_css .='padding-right:'.thz_property_unit($thumb_space,'px').';';
				$add_css .='max-width:100%';
				$add_css .='}';
				
				// thumbnail height
				$wooim_thumbh	= thz_get_option('wooimgsl/thumbh',80);
				$add_css .='.thz-slick-woo-thumbs,';
				$add_css .='.thz-woo-item-thumbs-slick .thz-slick-slide-in{';
				$add_css .='height:'.thz_property_unit($wooim_thumbh,'px').';';	
				$add_css .='}';					

					
				// icon
				$show_media_icon	= thz_get_option('wooimgmi/picked'); 
				
				if($show_media_icon =='show'){
					
					$icon_co 	= thz_get_option('wooimgmi/show/icm/co');
					$icon_bg 	= thz_get_option('wooimgmi/show/ibgm/bg');
					$icon_bs 	= thz_get_option('wooimgmi/show/ibgm/bs');
					$icon_bsi 	= thz_get_option('wooimgmi/show/ibgm/bsi');
					$icon_bc 	= thz_get_option('wooimgmi/show/ibgm/bc');
					$icon_fs	= thz_get_option('wooimgmi/show/icm/fs',16);
					
					if($icon_co !='' || $icon_bg !='' || ($icon_bsi > 0 && $icon_bc !='')){
						
						$add_css .='.thz-product-media .thz-hover-icon,';
						$add_css .='.thz-product-media  .thz-hover-icon:focus{';
						if($icon_co !=''){
							$add_css .='color:'.esc_attr($icon_co).';';
						}
						if($icon_bg !=''){
							$add_css .='background:'.esc_attr($icon_bg).';';
						}
						if($icon_bsi > 0 && $icon_bc !=''){
							$add_css .='border:'.esc_attr($icon_bsi).'px '.esc_attr($icon_bs).' '.esc_attr($icon_bc).';';
						}
						$add_css .='}';	
						
						$add_css .='.thz-product-media .thz-hover-icon span{';
						$add_css .='width:'.thz_property_unit($icon_fs,'px').';';
						$add_css .='height:'.thz_property_unit($icon_fs,'px').';';	
						$add_css .='}';				
						
					}
	
					
				}
				

				// title 
				$woospt_show	= thz_get_option('woosingels/t',null);
				if( 'show' == $woospt_show ){
					
					$woospt_bs 	 	= thz_print_box_css(thz_get_option('woospt_bs',null));
					$woosptfm 	 	= thz_get_option('woosptfm',null);				
					$add_css .= '.thz-product-title{';
					if(!empty($woospt_bs)){
						$add_css .= $woospt_bs;
					}
					$add_css .= thz_typo_css($woosptfm);
					$add_css .= '}';
				
				}
				
				// single rating
				$woosprat_show	= thz_get_option('woosingels/r',null);
				if( 'show' == $woosprat_show ){
					$woospra_bs 	= thz_print_box_css(thz_get_option('woospra_bs',null));
					$woospra_size 	= thz_get_option('woospra_mx/s',null);
					$woospra_color 	= thz_get_option('woospra_mx/c',null);				
					$add_css .= '.woocommerce-product-rating{';
					if(!empty($woospra_bs)){
						$add_css .= $woospra_bs;
					}
					$add_css .= 'font-size:'.thz_property_unit($woospra_size,'px').';';
					$add_css .= '}';
					
					if(!empty($woospra_color)){
						$add_css .= '.woocommerce-product-rating .star-rating span:before,';
						$add_css .= '.comment-text .star-rating span:before{';
						$add_css .= 'color:'.$woospra_color.'';
						$add_css .= '}';
					}
				
				}
				
				// price 
				$woospp_bs 	 	= thz_print_box_css(thz_get_option('woospp_bs',null));
				$woosppfm 	 	= thz_get_option('woosppfm',null);
				$add_css .= '.thz-product-price{';
				if(!empty($woospp_bs)){
					$add_css .= $woospp_bs;
				}
				$add_css .= thz_typo_css($woosppfm);
				$add_css .= '}';
				// oldprice 
				
				$woosppoc 	 = thz_get_option('woosppoc',null);
				$add_css .= '.thz-product-price del{color:'.$woosppoc.';}';
				

				// product meta container
				
				$productmetasc_bs = thz_get_option('woopmc',null);
				$productmetasc_bs_print = thz_print_box_css($productmetasc_bs);
				if(!empty($productmetasc_bs_print)){
					$add_css .= '.thz-product-meta-container{'.$productmetasc_bs_print.'}';
				}
				
				// product meta
				
				$productmeta_bs = thz_get_option('woopmbs',null);
				$productmeta_bs_print = thz_print_box_css($productmeta_bs);
				if(!empty($productmeta_bs_print)){
					$add_css .= '.thz-product-meta{'.$productmeta_bs_print.'}';
				}	
				
				
				// meta label
				$label_metrics 		= thz_get_option('woometa_label_metrics',null);
				$label_css			= thz_typo_css($label_metrics);	
				$label_width 		= thz_get_option('woometa_label_width',null);
				$add_css .= '.thz-product-meta-cell.thz-product-meta-label{';
				$add_css .='width:'.thz_property_unit($label_width,'%').';';
				$add_css .= $label_css;
				$add_css .='}';
				
				// meta font
				$prmeta_metrics 	= thz_get_option('woometa_metrics',null);
				$prmeta_css			= thz_typo_css($prmeta_metrics);
				$prmeta_co			= thz_get_option('woometa_colors/co','');
				$prmeta_lc			= thz_get_option('woometa_colors/lc','');
				$prmeta_hc			= thz_get_option('woometa_colors/hc','');
				
					
				$add_css .= '.thz-product-meta-cell.thz-product-meta-info{';
				$add_css .= $prmeta_css;
				if($prmeta_co !=''){	
					$add_css .='color:'.$prmeta_co.';';	
				}
				$add_css .='}';
				
				if($prmeta_lc !='' || $prmeta_hc !=''){
					if($prmeta_lc !=''){	
						$add_css .='.thz-product-meta-cell.thz-product-meta-info a{';	
						$add_css .='color:'.$prmeta_lc.';';	
						$add_css .='}';	
					}
					
					if($prmeta_hc !=''){	
						$add_css .='.thz-product-meta-cell.thz-product-meta-info a:hover{';	
						$add_css .='color:'.$prmeta_hc.';';	
						$add_css .='}';	
					}
				}
				
				
				// product shares
				$show_product_shares   = thz_get_option('woopsh/picked','show');
				
				if($show_product_shares =='show'){
					$postshares_bs 	   	 = thz_get_option('woopsh/show/shares_box_style');
					$postshares_bs_print = thz_print_box_css($postshares_bs);
					if(!empty($postshares_bs_print)){
						$add_css .= '.thz-post-shares{'.$postshares_bs_print.'}';
					}
					
					$add_css .= thz_social_shares_css('woopsh/show/im','.thz-product-shares');

				}
				

				// tabs 
				$tabs_atts = thz_get_option('wootabs');
				$add_css .= thz_sh_tabs_css($tabs_atts,'.thz-woo-tabs');
				

				// comments
				$add_css .= _thz_post_comments_static();
				
				// up-sells
				$ups_rbs 		= thz_print_box_css( thz_get_option('wu_rbs',null) );
				$ups_hbs 		= thz_print_box_css( thz_get_option('wu_rhs',null) );
				$ups_heading	= thz_typo_css( thz_get_option('wu_hef',null) );
				$upsh_bs  		= thz_print_box_css( thz_get_option('wu_hebs',null) );
				
				
				if(!empty($ups_rbs)){
					$add_css .= '.thz-product-up-sells-row{';
					$add_css .= $ups_rbs;
					$add_css .='}';	
				}
				
				if(!empty($ups_hbs)){
					$add_css .= '.thz-woo-up-sells-holder{';
					$add_css .= $ups_hbs;
					$add_css .='}';	
				}
				
				if(!empty($upsh_bs) || !empty($ups_heading)){
					$add_css .= '.thz-woo-up-sells-heading{';
					if(!empty($upsh_bs)){
						$add_css .= $upsh_bs;
					}
					if(!empty($ups_heading)){
						$add_css .= $ups_heading;
					}
					$add_css .='}';	
				}
				
				// related
				$rel_rbs 		= thz_print_box_css( thz_get_option('wr_rbs',null) );
				$rel_hbs 		= thz_print_box_css( thz_get_option('wr_rhs',null) );
				$rel_heading	= thz_typo_css( thz_get_option('wr_hef',null) );
				$relh_bs 		= thz_print_box_css( thz_get_option('wr_hebs',null) );
				
				if(!empty($rel_rbs)){
					$add_css .= '.thz-product-related-row{';
					$add_css .= $rel_rbs;
					$add_css .='}';	
				}
				
				if(!empty($rel_hbs)){
					$add_css .= '.thz-woo-related-holder{';
					$add_css .= $rel_hbs;
					$add_css .='}';	
				}

				if(!empty($relh_bs) || !empty($rel_heading)){
					$add_css .= '.thz-woo-related-heading{';
					if(!empty($relh_bs)){
						$add_css .= $relh_bs;
					}
					if(!empty($rel_heading)){
						$add_css .= $rel_heading;
					}
					$add_css .='}';	
				}
				
			}
			
			// price filter 
			$woopfc_sbg		= thz_get_theme_option('woopfc/sbg','');
			$woopfc_rbg		= thz_get_theme_option('woopfc/rbg','');
			$woopfc_hbg		= thz_get_theme_option('woopfc/hbg','');	
			$woopfc_hbo		= thz_get_theme_option('woopfc/hbo','');
		
			if($woopfc_sbg !=''){
				$add_css .= '.price_slider_wrapper .ui-widget-content{';
				$add_css .= 'background:'.$woopfc_sbg.';';
				$add_css .= '}';
			}
			
			if($woopfc_rbg !=''){
				$add_css .= '.price_slider.ui-slider .ui-slider-range{';
				$add_css .= 'background:'.$woopfc_rbg.';';
				$add_css .= '}';
			}
			
			if($woopfc_hbg !='' || $woopfc_hbo){
				$add_css .= '.price_slider.ui-slider .ui-slider-handle{';
				if($woopfc_rbg !=''){
					$add_css .= 'background:'.$woopfc_hbg.';';
				}
				if($woopfc_hbo !=''){
					$add_css .= 'border-color:'.$woopfc_hbo.';';
				}
				$add_css .= '}';
			}


			if($add_css !=''){
				return $add_css;
			}			
			
		}
	}
	
}

/**
 * bbPress static
 */
function _thz_bbpress_static(){

	if(class_exists('bbPress')){
		
		if(!thz_is_bbpress()){
			return;	
		}
		
		$add_css ='';
		
		$bbp_hbg		= thz_get_theme_option('bbp/hbg','#fafafa');
		$bbp_bo			= thz_get_theme_option('bbp/bo','#eaeaea');
		$bbp_ft			= thz_get_theme_option('bbp/ft','#999999');	
		
		$bbpth_co		= thz_get_theme_option('bbpth/co','#a8a8a8');
		$bbpth_li		= thz_get_theme_option('bbpth/li','#a8a8a8');
		$bbpth_lih		= thz_get_theme_option('bbpth/lih','#222222');	
		
		
		$bbpl_li		= thz_get_theme_option('bbpl/li','#222222');
		$bbpl_lih		= thz_get_theme_option('bbpl/lih','#a8a8a8');
		$bbpl_bit		= thz_get_theme_option('bbpl/bit','#a8a8a8');	
		
		
		// Headers Backgrounds
		if($bbp_hbg !=''){
			$add_css .='#bbpress-forums li.bbp-header ul > li,';
			$add_css .='#bbpress-forums .bbp-reply-header,';
			$add_css .='#bbpress-forums .bbp-replies > li.bbp-header,';
			$add_css .='#bbpress-forums .bbp-search-results > li.bbp-header,';
			$add_css .='#bbpress-forums .bbp-topic-header,dl.bbp-dl-stats dt{';
			$add_css .='background-color:'.$bbp_hbg.';';
			$add_css .='}';
		}
				
		// Forum borders
		if($bbp_bo !=''){

			$add_css .='#bbpress-forums li.bbp-header ul > li,';
			$add_css .='#bbpress-forums li.bbp-body ul.forum > li,';
			$add_css .='#bbpress-forums li.bbp-body ul.topic > li,';
			$add_css .='#bbpress-forums .bbp-forums,';
			$add_css .='#bbpress-forums .bbp-topics,';
			$add_css .='#bbpress-forums .bbp-reply-header,';
			$add_css .='#bbpress-forums .bbp-body .type-topic,';
			$add_css .='#bbpress-forums .bbp-body .type-reply,';
			$add_css .='#bbpress-forums .bbp-replies > li.bbp-header,';
			$add_css .='#bbpress-forums .bbp-search-results > li.bbp-header,';
			$add_css .='#bbpress-forums .bbp-topic-header,';
			$add_css .='dl.bbp-dl-stats,dl.bbp-dl-stats dt,';
			$add_css .='dl.bbp-dl-stats dd,dl.bbp-dl-stats dt{';
			$add_css .='border-color:'.$bbp_bo.';';
			$add_css .='}';
		}			
		
		// Forum titles
		if($bbp_ft !=''){
			$add_css .='#bbpress-forums .forum-titles{';
			$add_css .='color:'.$bbp_ft.';';
			$add_css .='}';
		}
		
		
		
		// Topic header text
		if($bbpth_co !=''){
			$add_css .='#bbpress-forums .bbp-topic-header,';
			$add_css .='#bbpress-forums .bbp-replies .bbp-reply-header{';
			$add_css .='color:'.$bbpth_co.';';
			$add_css .='}';
		}
		
		// Topic header links
		if($bbpth_li !=''){
			
			$add_css .='#bbpress-forums .bbp-topic-header a,';
			$add_css .='#bbpress-forums .bbp-replies .bbp-header a,';
			$add_css .='#bbpress-forums .bbp-replies .bbp-reply-header a{';
			$add_css .='color:'.$bbpth_li.';';
			$add_css .='}';
		}	
			
		// Topic header links hovered
		if($bbpth_lih !=''){
			$add_css .='#bbpress-forums .bbp-topic-header a:hover,';
			$add_css .='#bbpress-forums .bbp-replies .bbp-header a:hover,';
			$add_css .='#bbpress-forums .bbp-replies .bbp-reply-header a:hover{';
			$add_css .='color:'.$bbpth_lih.';';
			$add_css .='}';
		}
		
		
		
		// Forum links
		if($bbpl_li !=''){
			$add_css .='#bbpress-forums .bbp-forum-title,';
			$add_css .='#bbpress-forums .bbp-topic-permalink,';
			$add_css .='#bbpress-forums .bbp-topic-started-in a,';
			$add_css .='#bbpress-forums .bbp-forums .bbp-author-name,';
			$add_css .='#bbpress-forums .bbp-topics .bbp-author-name,';
			$add_css .='#bbpress-forums .bbp-forum .bbp-forum-link,';
			$add_css .='#bbpress-forums .bbp-topic-header h3,';
			$add_css .='#bbpress-forums .bbp-topic-header h3 a{';
			$add_css .='color:'.$bbpl_li.';';
			$add_css .='}';
		}
		
		// Forum links hovered
		if($bbpl_lih !=''){
			$add_css .='#bbpress-forums .bbp-forum-title:hover,';
			$add_css .='#bbpress-forums .bbp-topic-permalink:hover,';
			$add_css .='#bbpress-forums .bbp-topic-started-in a:hover,';
			$add_css .='#bbpress-forums .bbp-forums .bbp-author-name:hover,';
			$add_css .='#bbpress-forums .bbp-topics .bbp-author-name:hover,';
			$add_css .='#bbpress-forums .bbp-forum .bbp-forum-link:hover,';
			$add_css .='#bbpress-forums .bbp-topic-header h3 a:hover{';
			$add_css .='color:'.$bbpl_lih.';';
			$add_css .='}';
		}
		
		
		
		// Forum bits
		if($bbpl_bit !=''){
			$add_css .='#bbpress-forums .bbp-forum-info .bbp-forum-content,';
			$add_css .='#bbpress-forums .bbp-topic-meta,';
			$add_css .='#bbpress-forums .bbp-forum-freshness > a,';
			$add_css .='#bbpress-forums .bbp-topic-freshness > a,';
			$add_css .='#bbpress-forums .bbp-pagination{';
			$add_css .='color:'.$bbpl_bit.';';
			$add_css .='}';
		}
				
				
		if($add_css !=''){
			return $add_css;
		}		
		
	}
	
}

/**
 * BuddyPress static
 */
function _thz_buddypress_static(){
	
	if (function_exists('bp_current_component')){ 
		
		if(!bp_current_component()){
			return;
		}
		
		$add_css ='';

		$cbg		= thz_get_theme_option('bptmc/cbg','#fafafa');
		$lbg		= thz_get_theme_option('bptmc/lbg','#fafafa');
		$lco		= thz_get_theme_option('bptmc/lco','#999999');
		$crbg		= thz_get_theme_option('bptmc/crbg','#f3f3f3');	
		$crco		= thz_get_theme_option('bptmc/crco','#121212');	

		//Top level menu container
		if($cbg !=''){
			$add_css .='#buddypress .item-list-tabs ul{';
			$add_css .='background-color:'.$cbg.';';
			$add_css .='}';
		}
		
		//Top level menu links
		if($lbg !='' || $lco !=''){
			$add_css .='#buddypress .item-list-tabs li > a,';
			$add_css .='.group-create #buddypress .item-list-tabs ul > li > span{';
			if($lbg !=''){
				$add_css .='background-color:'.$lbg.';';
			}
			if($lco !=''){
				$add_css .='color:'.$lco.';';
			}
			$add_css .='}';
		}	
		
		//Top level menu hover and current
		if($crbg !='' || $crco !=''){
			$add_css .='#buddypress .item-list-tabs li > a:hover,';
			$add_css .='#buddypress .item-list-tabs li.current > a{';
			if($crbg !=''){
				$add_css .='background-color:'.$crbg.';';
			}
			if($crco !=''){
				$add_css .='color:'.$crco.';';
			}
			$add_css .='}';
		}	
		

		$bpbc_bg	= thz_get_theme_option('bpbc/bg','#dddddd');	
		$bpbc_co	= thz_get_theme_option('bpbc/co','#121212');
				
		//Top level menu count bubble
		if($bpbc_bg !='' || $bpbc_co !=''){
			$add_css .='#buddypress .item-list-tabs ul > li > a > span{';
			if($bpbc_bg !=''){
				$add_css .='background-color:'.$bpbc_bg.';';
			}
			if($bpbc_co !=''){
				$add_css .='color:'.$bpbc_co.';';
			}
			$add_css .='}';
		}
		

		
		$smcbg		= thz_get_theme_option('bpsmc/cbg','#f3f3f3');
		$smlbg		= thz_get_theme_option('bpsmc/lbg','#f3f3f3');
		$smlco		= thz_get_theme_option('bpsmc/lco','#999999');
		$smcrbg		= thz_get_theme_option('bpsmc/crbg','');	
		$smcrco		= thz_get_theme_option('bpsmc/crco','#121212');			

		//Sub level menu container
		if($smcbg !=''){
			$add_css .='#buddypress #subnav ul{';
			$add_css .='background-color:'.$smcbg.';';
			$add_css .='}';
		}
		
		//Sub level menu links
		if($smlbg !='' || $smlco !=''){
			$add_css .='#buddypress #subnav li > a{';
			if($smlbg !=''){
				$add_css .='background-color:'.$smlbg.';';
			}
			if($smlco !=''){
				$add_css .='color:'.$smlco.';';
			}
			$add_css .='}';
		}	
		
		//Sub level menu hover and current
		if($smcrbg !='' || $smcrco !=''){
			$add_css .='#buddypress #subnav li > a:hover,';
			$add_css .='#buddypress #subnav li.current > a{';
			if($smcrbg !=''){
				$add_css .='background-color:'.$smcrbg.';';
			}
			if($smcrco !=''){
				$add_css .='color:'.$smcrco.';';
			}
			$add_css .='}';
		}
		

		$bo		= thz_get_theme_option('bpic/bo','#eaeaea');	
		$bit	= thz_get_theme_option('bpic/bit','#b4b4b4');
		
		// items border 
		if($bo !=''){
			$add_css .='#buddypress .activity-comments ul li,';
			$add_css .='#buddypress #member-list li,';
			$add_css .='#buddypress #members-list li,';
			$add_css .='#buddypress #admins-list li,';
			$add_css .='#buddypress #friend-list li,';
			$add_css .='#buddypress #group-list.invites li,';
			$add_css .='#buddypress .thz-bp-activity.default .item-list > li.activity-item,';
			$add_css .='.thz-bp-activity.timeline .activity-content{';
			$add_css .='border-color:'.$bo.';';
			$add_css .='}';
			
			$add_css .='.thz-bp-activity.timeline .activity-content:before{';
			$add_css .='background-color:'.$bo.';';
			$add_css .='}';
		}	
		
		// bits
		if($bit !=''){
			$add_css .='.activity-header,';
			$add_css .='.acomment-meta,';
			$add_css .='#item-header-content .activity,';
			$add_css .='#buddypress .pagination,';
			$add_css .='#buddypress ul#groups-list li .activity {';
			$add_css .='color:'.$bit.';';
			$add_css .='}';
		}	
		
		
		
		
		$bpbtn_bg	= thz_get_theme_option('bpbtn/bg','#ffffff');	
		$bpbtn_bo	= thz_get_theme_option('bpbtn/bo','#eaeaea');
		$bpbtn_co	= thz_get_theme_option('bpbtn/co','#aaaaaa');
		$bpbtnh_bg	= thz_get_theme_option('bpbtnh/bg','#fafafa');	
		$bpbtnh_bo	= thz_get_theme_option('bpbtnh/bo','#eaeaea');
		$bpbtnh_co	= thz_get_theme_option('bpbtnh/co','#444444');
				
		//Buttons
		if($bpbtn_bg !='' || $bpbtn_bo !='' || $bpbtn_co !=''){
			$add_css .='#buddypress li .button,';
			$add_css .='#buddypress li input[type="submit"],';
			$add_css .='#buddypress #aw-whats-new-submit,';
			$add_css .='#buddypress .groups-members-search input[type="text"],';
			$add_css .='#buddypress .acomment-options a,';
			$add_css .='#buddypress .generic-button a,';
			$add_css .='#buddypress ul li.last select,';
			$add_css .='#buddypress a.read,';
			$add_css .='#buddypress a.delete,';
			$add_css .='#buddypress a.primary{';
			if($bpbtn_bg !=''){
				$add_css .='background-color:'.$bpbtn_bg.';';
			}
			if($bpbtn_bo !=''){
				$add_css .='border-color:'.$bpbtn_bo.';';
			}
			if($bpbtn_co !=''){
				$add_css .='color:'.$bpbtn_co.';';
			}
			$add_css .='}';
		}
		
		//Buttons hovered
		if($bpbtnh_bg !='' || $bpbtnh_bo !='' || $bpbtnh_co !=''){
			$add_css .='#buddypress li .button:hover,';
			$add_css .='#buddypress li input[type="submit"]:hover,';
			$add_css .='#buddypress #aw-whats-new-submit:hover,';
			$add_css .='#buddypress .groups-members-search input[type="text"]:hover,';
			$add_css .='#buddypress .acomment-options a:hover,';
			$add_css .='#buddypress .generic-button a:hover,';
			$add_css .='#buddypress ul li.last select:hover,';
			$add_css .='#buddypress a.read:hover,';
			$add_css .='#buddypress a.delete:hover,';
			$add_css .='#buddypress a.primary:hover{';
			if($bpbtnh_bg !=''){
				$add_css .='background-color:'.$bpbtnh_bg.';';
			}
			if($bpbtnh_bo !=''){
				$add_css .='border-color:'.$bpbtnh_bo.';';
			}
			if($bpbtnh_co !=''){
				$add_css .='color:'.$bpbtnh_co.';';
			}
			$add_css .='}';
		}

		
		$bpwt_bg	= thz_get_theme_option('bpwt/bg','#ffffff');	
		$bpwt_bo	= thz_get_theme_option('bpwt/bo','#eaeaea');
		$bpwt_co	= thz_get_theme_option('bpwt/co','#aaaaaa');
		$bpwth_bg	= thz_get_theme_option('bpwth/bg','#fafafa');	
		$bpwth_bo	= thz_get_theme_option('bpwth/bo','#eaeaea');
		$bpwth_co	= thz_get_theme_option('bpwth/co','#444444');

		//Widgets tabs
		if($bpwt_bg !='' || $bpwt_bo !='' || $bpwt_co !=''){
			$add_css .='#buddypress .generic-button a,';
			$add_css .='.buddypress.widget .item-options a {';
			if($bpwt_bg !=''){
				$add_css .='background-color:'.$bpwt_bg.';';
			}
			if($bpwt_bo !=''){
				$add_css .='border-color:'.$bpwt_bo.';';
			}
			if($bpwt_co !=''){
				$add_css .='color:'.$bpwt_co.';';
			}
			$add_css .='}';
		}
		
		//Widgets tabs hovered
		if($bpwth_bg !='' || $bpwth_bo !='' || $bpwth_co !=''){
			$add_css .='.buddypress.widget .item-options a:hover,';
			$add_css .='.buddypress.widget .item-options a.selected{';
			if($bpwth_bg !=''){
				$add_css .='background-color:'.$bpwth_bg.';';
			}
			if($bpwth_bo !=''){
				$add_css .='border-color:'.$bpwth_bo.';';
			}
			if($bpwth_co !=''){
				$add_css .='color:'.$bpwth_co.';';
			}
			$add_css .='}';
		}	
		
		
		$bplmb_bg	= thz_get_theme_option('bplmb/bg','#fafafa');	
		$bplmb_bo	= thz_get_theme_option('bplmb/bo','#eaeaea');
		$bplmb_co	= thz_get_theme_option('bplmb/co','#cccccc');
		$bplmbh_bg	= thz_get_theme_option('bplmbh/bg','#fafafa');	
		$bplmbh_bo	= thz_get_theme_option('bplmbh/bo','#eaeaea');
		$bplmbh_co	= thz_get_theme_option('bplmbh/co','#121212');

		//Load more
		if($bplmb_bg !='' || $bplmb_bo !='' || $bplmb_co !=''){
			$add_css .='#buddypress ul.item-list li.load-more a{';
			if($bplmb_bg !=''){
				$add_css .='background-color:'.$bplmb_bg.';';
			}
			if($bplmb_bo !=''){
				$add_css .='border-color:'.$bplmb_bo.';';
			}
			if($bplmb_co !=''){
				$add_css .='color:'.$bplmb_co.';';
			}
			$add_css .='}';
		}
		
		//Load more hovered
		if($bplmbh_bg !='' || $bplmbh_bo !='' || $bplmbh_co !=''){
			$add_css .='#buddypress ul.item-list li.load-more a:hover,';
			$add_css .='#buddypress ul.item-list li.load-more a:focus{';
			if($bplmbh_bg !=''){
				$add_css .='background-color:'.$bplmbh_bg.';';
			}
			if($bplmbh_bo !=''){
				$add_css .='border-color:'.$bplmbh_bo.';';
			}
			if($bplmbh_co !=''){
				$add_css .='color:'.$bplmbh_co.';';
			}
			$add_css .='}';
		}
		
		if($add_css !=''){
			return $add_css;
		}	
	
	}
}

/**
 * Print social links
 */
function thz_social_links_print($metrics,$key,$class,$css = false,$echo = true,$links = false){
	
	if(is_array($links) && empty($links)){
		return;
	}
	
	$html ='';
	$add_css ='';
	$socials = $links ? $links : thz_get_theme_option('thz_sl',array());
	
	if(empty($socials)) {
		return;
	}
	
	$metrics 	= $links ? $metrics : thz_get_theme_option($metrics,array());
	$style 		= thz_akg('s',$metrics,'simple');
	
	if($css){
		
		$fsize = thz_akg('f',$metrics,14);
		$ratio = (int) thz_akg('r',$metrics,2);
		$size = thz_property_unit($fsize * $ratio,'px');
		$add_css .='.thz-socials-holder.'.$class.' a{';
		$add_css .='font-size:'.thz_property_unit($fsize,'px').';';
			
		if($style == 'simple'){
			$size = thz_property_unit($fsize,'px');
		}
		$add_css .='width:'.$size.';';
		$add_css .='height:'.$size.';';
		if($style == 'outline'){
			$size = thz_property_unit( ($fsize * $ratio) - 4,'px');
		}
		
		$add_css .='line-height:'.$size.';';
		$add_css .='}';
		
		$dl 	= thz_akg('dl',$metrics,null);
		$dh 	= thz_akg('dh',$metrics,null);
		$ds 	= thz_akg('ds',$metrics,null);
		$dsh 	= thz_akg('dsh',$metrics,null);
		
		if(!empty($dl) || !empty($ds)){
			$add_css .='.thz-socials-holder.'.$class.' a{';
			if( !empty($dl) ){
				$add_css .='color:'.$dl.';';
			}
			if($style == 'flat' && !empty($ds)){
				$add_css .='background:'.$ds.';';
			}
			if($style == 'outline' && !empty($ds)){
				$add_css .='border-color:'.$ds.';';
			}			
			$add_css .='}';
		}
		if(!empty($dh) || !empty($dsh)){
			$add_css .='.thz-socials-holder.'.$class.' a:hover{';
			if( !empty($dh) ){
				$add_css .='color:'.$dh.';';
			}
			if($style == 'flat' && !empty($dsh)){
				$add_css .='background:'.$dsh.';';
			}
			if($style == 'outline' && !empty($dsh)){
				$add_css .='border-color:'.$dsh.';';
			}	
			$add_css .='}';
		}
		
		foreach ($socials as $link){
			
			
			if( ('fsim' == $metrics && 'hide' == $link['showin']['f']) || 
				('tsim' == $metrics && 'hide' == $link['showin']['t'])
			){
				continue;
			}
			
			$l 	= isset($link[$key]['l']) && !empty($link[$key]['l']) ? $link[$key]['l'] : false;
			$h 	= isset($link[$key]['h']) && !empty($link[$key]['h']) ? $link[$key]['h'] : false;
			$s 	= isset($link[$key]['s']) && !empty($link[$key]['s']) ? $link[$key]['s'] : false;
			$sh = isset($link[$key]['sh']) && !empty($link[$key]['sh']) ? $link[$key]['sh'] : false;

			$class_name = 'thz-social-'.esc_attr(str_replace(' ','',strtolower($link['name'])));
			
			if( $l || $s){
				$add_css .='.'.$class.' a.'.$class_name.'{';
				if( $l ){
					$add_css .='color:'.$l.';';
				}
				if($style == 'flat' && $s){
					$add_css .='background:'.$s.';';
				}
				if($style == 'outline' && $s){
					$add_css .='border-color:'.$s.';';
				}			
				$add_css .='}';
			}

			if( $h || $sh ){
				$add_css .= '.'.$class.' a.'.$class_name.':hover{';
				if( $h ){
					$add_css .='color:'.$h.';';
				}
				if($style == 'flat' && $sh){
					$add_css .='background:'.$sh.';';
				}
				if($style == 'outline' && $sh){
					$add_css .='border-color:'.$sh.';';
				}	
				$add_css .='}';
			}	

		}
		unset($link);
		
		return $add_css;
		
		
	}else{
		
		$shape = thz_akg('sh',$metrics,'square');
		$shape_class = $style !='simple' ? ' thz-so-'.$shape :'';
		$hclass = $class.' thz-so-'.$style.$shape_class;
		$html .='<div class="thz-socials-holder '.$hclass.'">';
		$html .='<div class="thz-social-links">';
		
		
		foreach ($socials as $link){
			
			
			if( ('fsim' == $metrics && 'hide' == $link['showin']['f']) || 
				('tsim' == $metrics && 'hide' == $link['showin']['t'])
			){
				continue;
			}
			
			$class_name = 'thz-social-'.esc_attr(str_replace(' ','',strtolower($link['name'])));
			$target	= isset($link['target']) ? $link['target'] : '_blank';
			
			$html .='<a class="'.$class_name.'" href="'.esc_url($link['link']).'" target="'.$target.'">';
			$html .='<span class="'.esc_attr($link['icon']).'">';
			$html .='</span>';
			$html .='</a>';
			
		}
		
		unset($link);
		
		$html .='</div>';
		$html .='</div>';
		
		if($echo){
			echo $html;
		}else{
			return $html;
		}
	
	}

}
/**
 * Social shares CSS
 */
function thz_social_shares_css($opt,$container,$metrics = false){

	$add_css 	='';
	$fsize 		= $metrics ? thz_akg('f',$metrics,14) : thz_get_option($opt.'/f',14);
	$space 		= $metrics ? thz_akg('sp',$metrics,20) : thz_get_option($opt.'/sp',20);
	$style 		= $metrics ? thz_akg('s',$metrics,'simple') :thz_get_option($opt.'/s','simple');
	$shape 		= $metrics ? thz_akg('sh',$metrics,'square') :thz_get_option($opt.'/sh','square');
	$ratio 		= $metrics ? (int) thz_akg('r',$metrics,2) : (int) thz_get_option($opt.'/r',2);
	$color 		= $metrics ? thz_akg('c',$metrics,'') :thz_get_option($opt.'/c','');
	$hovered 	= $metrics ? thz_akg('ch',$metrics,'') :thz_get_option($opt.'/ch','');
	$stylec 	= $metrics ? thz_akg('sc',$metrics,'') :thz_get_option($opt.'/sc','');
	$stylech 	= $metrics ? thz_akg('sch',$metrics,'') :thz_get_option($opt.'/sch','');
	
	$shape_class = $style !='simple' ? ' thz-so-'.$shape :'';
	$size = thz_property_unit($fsize * $ratio,'px');

	
	
	$add_css .= $container.' a{';
	$add_css .='font-size:'.thz_property_unit($fsize,'px').';';
		
	if($style == 'simple'){
		$size = thz_property_unit($fsize,'px');
	}
	$add_css .='width:'.$size.';';
	$add_css .='height:'.$size.';';
	if($style == 'outline'){
		$size = thz_property_unit( ($fsize * $ratio) - 4,'px');
	}
	
	$add_css .='line-height:'.$size.';';
	$add_css .='}';
	
	$add_css .= $container.' .thz-sharing-sep{';
	$add_css .='width:'.thz_property_unit($space,'px').';';
	$add_css .='}';
	
	
	if(!empty($color) || !empty($stylec)){	
		$add_css .=$container.' a{';
		if(!empty($color)){
			$add_css .='color:'.$color.';';
		}
		if($style == 'flat' && !empty($stylec)){
			$add_css .='background:'.$stylec.';';
		}
		if($style == 'outline' && !empty($stylec)){
			$add_css .='border-color:'.$stylec.';';
		}			
		$add_css .='}';	
	}
	
	if(!empty($hovered)|| !empty($stylech)){	
		$add_css .=$container.' a:hover{';
		if(!empty($hovered)){
			$add_css .='color:'.$hovered.';';
		}
		if($style == 'flat' && !empty($stylech)){
			$add_css .='background:'.$stylech.';';
		}
		if($style == 'outline' && !empty($stylech)){
			$add_css .='border-color:'.$stylech.';';
		}
		$add_css .='}';
	}	
	
	return $add_css;
}

/**
 * Custom Elements CSS
 */
function _thz_elements_css(){
	
		$add_css = '';
		$thzeladd = thz_get_option('thzeladd',null);
		
		if(!empty($thzeladd)){
			
			foreach	($thzeladd as $element){
				
				$classes = explode(',',thz_akg('classes',$element));
				$clean_classes = array_filter($classes);
				$normal_classes = implode(',',$clean_classes);
				
				$hover_classes = preg_replace('/$/', ':hover', $clean_classes);
				$hover_classes = implode(',',$hover_classes);
				
				$focus_classes = preg_replace('/$/', ':focus', $clean_classes);
				$focus_classes = implode(',',$focus_classes);

				$metrics = thz_akg('thzelm',$element,array());
				
				$bgh = thz_akg('thzelch/bg',$element,null);
				$coh = thz_akg('thzelch/color',$element,null);
				$bch = thz_akg('thzelch/bcolor',$element,null);
				
				$bgf = thz_akg('thzelcf/bg',$element,null);
				$cof = thz_akg('thzelcf/color',$element,null);
				$bcf = thz_akg('thzelcf/bcolor',$element,null);	
				
				$thzelf	 	= thz_typo_css ( thz_akg('thzelf',$element,null));	
				$thzelco  	= thz_akg('thzelco',$element,null);
				$elmetrics 	= thz_print_box_css($metrics);			
				
				// normal	
				if($thzelco !='' || $elmetrics !='' || $thzelf !=''){
					
					$pseudo = thz_contains( $normal_classes, array(':before',':after') ) ? true : false;
					
					$add_css .= $normal_classes.'{';
					
					if($elmetrics !=''){
						$add_css .= $elmetrics;
					}
					
					if($thzelco !=''){
						$add_css .= 'color:'.$thzelco.';';
					}
					
					if($pseudo){
						$add_css .= "content:'';";
					}
					
					if($thzelf !=''){
						$add_css .= $thzelf;
					}
	
					$add_css .= '}';
				}
				
				
				// hover
				if($bgh !='' || $coh !='' || $bch !=''){
					$add_css .= $hover_classes.'{';
					if($bgh !=''){
						$add_css .= 'background:'.$bgh.';';
					}
					if($coh !=''){
						$add_css .= 'color:'.$coh.';';
					}
					if($bch !=''){
						$add_css .= 'border-color:'.$bch.';';
					}
					$add_css .= '}';
				}
				
				// focus
				if($bgf !='' || $cof !='' || $bcf !=''){
					$add_css .= $focus_classes.'{';
					if($bgf !=''){
						$add_css .= 'background:'.$bgf.';';
					}
					if($cof !=''){
						$add_css .= 'color:'.$cof.';';
					}
					if($bcf !=''){
						$add_css .= 'border-color:'.$bcf.';';
					}
					$add_css .= '}';
				}

			}
			unset($thzeladd,$element);
			
		}

	if($add_css !=''){		
		return $add_css;
	}
	
}


/**
 * Shortcode tabs CSS
 */
function thz_sh_tabs_css($atts,$container = false){
		
		if(empty($atts) || !$container){
			return;
		}

		$l_space				= thz_akg('tabl/lsp',$atts);
		$l_bradius				= thz_akg('tabl/lbr',$atts);
		$tabs_layout			= thz_akg('tabl/lay',$atts);
		$tabs_mainc				= 'thz-tabs-'.thz_akg('id',$atts);
		$tabscontainer_margin	= thz_print_box_css(thz_akg('tabcm',$atts));
		$tablink_padding		= thz_print_box_css(thz_akg('tablp',$atts));
		$tabcontent_bs			= thz_print_box_css(thz_akg('tabcbs',$atts));
		$tabcontent_inner_bs	= thz_print_box_css(thz_akg('tabcibs',$atts));
		$title_font 			= thz_akg('tabf',$atts, null);
		$add_css 				= '';
		
		// container margin
		$add_css .=  '.thz-shortcode-tabs{';
		$add_css .= $tabscontainer_margin;
		$add_css .='}';		
		
		// space
		if($l_space > 0 && ($tabs_layout =='top' || $tabs_layout =='centered') ){
			$add_css .= $container .' ul.thz-tabs-menu li{';
			$add_css .='margin-right:'.thz_property_unit($l_space,'px').';';
			$add_css .='}';
		}
		
		// link
		$add_css .=  $container .' ul.thz-tabs-menu li a{';
		$add_css .= $tablink_padding;
		if($l_bradius > 0  && ($tabs_layout !='left' && $tabs_layout !='right')){
			$add_css .='border-radius:'.thz_property_unit($l_bradius,'px').';';
		}
		$add_css .= thz_typo_css($title_font);
		$add_css .='}';
		
		// active 
		$active_link					= thz_akg('tablc/al',$atts);
		$active_linkh					= thz_akg('tablc/alh',$atts);
		$active_style 					= thz_print_box_css(thz_akg('tababs',$atts));
				
		$add_css .= $container .' ul.thz-tabs-menu li.thz-active-tab a{';
		$add_css .= $active_style;
		if($active_link !=''){
			$add_css .='color:'.$active_link.';';
		}
		$add_css .='}';
		
		if($active_linkh !=''){
			$add_css .= $container .' ul.thz-tabs-menu li.thz-active-tab a:hover{';
			$add_css .='color:'.$active_linkh.';';
			$add_css .='}';
		}
		
		// inactive
		$inactive_link					= thz_akg('tablc/il',$atts);
		$inactive_linkh					= thz_akg('tablc/ilh',$atts);
		$inactive_style 				= thz_print_box_css(thz_akg('tabibs',$atts));
				
		$add_css .= $container .' ul.thz-tabs-menu li.thz-inactive-tab a{';
		$add_css .= $inactive_style;
		if($inactive_link !=''){
			$add_css .='color:'.$inactive_link.';';
		}
		$add_css .='}';
		
		
		if($inactive_linkh !=''){
			$add_css .= $container .' ul.thz-tabs-menu li.thz-inactive-tab a:hover{';
			$add_css .='color:'.$inactive_linkh.';';
			$add_css .='}';
		}
		
		// content 
		
		
		if($tabs_layout == 'left'){
			
			$btype			= thz_akg('tabcbs/borders/all',$atts); 
			$bside			= $btype == 'same' ? 'top' : 'left';
			$adjust_margin  = thz_akg('tabcbs/borders/'.$bside.'/w',$atts);
			$margin 		= 'margin-right:-'.thz_property_unit($adjust_margin,'px').';';
			$tabs_class 	= $container .'.thz-tabs-left ul.thz-tabs-menu{';
						
		}elseif($tabs_layout == 'right'){
			
			$btype			= thz_akg('tabcbs/borders/all',$atts); 
			$bside			= $btype == 'same' ? 'top' : 'right';
			$adjust_margin  = thz_akg('tabcbs/borders/'.$bside.'/w',$atts);		
			$margin 		= 'margin-left:-'.thz_property_unit($adjust_margin,'px').';';
			$tabs_class 	= $container .'.thz-tabs-right ul.thz-tabs-menu{';
			
		}else{
			
			$adjust_margin 	= thz_akg('tabcbs/borders/top/w',$atts);
			$margin 		= 'margin-bottom:-'.thz_property_unit($adjust_margin,'px').';';
			$tabs_class 	= $container .'.thz-tabs-above ul.thz-tabs-menu li{';
		}
		
		if($adjust_margin > 0){
			
			$add_css .= $tabs_class;
			$add_css .= $margin;
			$add_css .='}';			
		}
		
		$content_txt				= thz_akg('tabcc/ctc',$atts);
		$content_link				= thz_akg('tabcc/clc',$atts);
		$content_linkh				= thz_akg('tabcc/clh',$atts);
		$content_heading			= thz_akg('tabcc/chc',$atts);
		
		$add_css .= $container .'.thz-shortcode-tabs .thz-tab-content{';
		$add_css .= $tabcontent_bs;
		if($content_txt !=''){
			$add_css .='color:'.$content_txt.';';
		}
		$add_css .='}';
		
		
		if($tabcontent_inner_bs !=''){
			
			$add_css .= $container .'.thz-shortcode-tabs .thz-tab-content-inner{';
			$add_css .= $tabcontent_inner_bs;
			$add_css .='}';
		}
		
		if($content_link !=''){
			$add_css .= $container .' .thz-tab-content a{';
			$add_css .='color:'.$content_link.';';
			$add_css .='}';
		}	
		if($content_linkh !=''){
			$add_css .= $container .' .thz-tab-content a:hover{';
			$add_css .='color:'.$content_linkh.';';
			$add_css .='}';
		}	
		if($content_heading !=''){
			$add_css .= $container .' .thz-tab-content h1,';
			$add_css .= $container .' .thz-tab-content h2,';

			$add_css .= $container .' .thz-tab-content h3,';
			$add_css .= $container .' .thz-tab-content h4,';
			$add_css .= $container .' .thz-tab-content h5,';
			$add_css .= $container .' .thz-tab-content h6{';
			$add_css .='color:'.$content_heading.';';
			$add_css .='}';
		}

	
		if(!empty($add_css)){
			return $add_css;
		}	
	
}


/**
 * Resize font for smaller devices
 */
function thz_resize_font($device,$size,$line_height = false){
	
	switch ($size) {
		case $size >= 26 && $size <= 30:
			$factor_t = 1;
			$factor_m = 0.9;
			break;
		case $size >= 31 && $size <= 45:
			$factor_t = 1;
			$factor_m = 0.85;
			break;
		case $size >= 46 && $size <= 65:
			$factor_t = 0.85;
			$factor_m = 0.75;
			break;
		case $size >= 66 && $size <= 80:
			$factor_t = 0.75;
			$factor_m = 0.65;
			break;
		case $size >= 81:
			$factor_t = 0.65;
			$factor_m = 0.50;
			break;
	}	
	
	if('mobile' == $device){
		
		return 	$size * $factor_m;
		
	}else if('tablet' == $device){
		
		return 	$size * $factor_t;
	}
	
}


/**
 * Print responsive CSS
 */
function thz_responsive_print(){
	
	$res = Thz_Doc::get('responsive') ;
	
	if ( !empty( $res ) ) {
		
		$add_css = '';
		krsort($res);
		
		foreach ($res as $at => $re_css){
			
			if(8888 == $at){
				
				$add_css .= implode('',$re_css);
				
			}else{
			
				$min_max = $at > 979 ? 'min' : 'max';
	
				$add_css .=	'@media screen and ('.$min_max.'-width: '.$at.'px) {';
				$add_css .= implode('',$re_css);
				$add_css .=	'}';
			
			}
			
			unset($re_css);
		}
		unset($res);
		return $add_css;
	}	

}


/**
 * Add responsive font to Thz_Doc
 */
function thz_add_responsive_font($add_css){

	$ThzCssParser = new ThzCssParser();
	$ThzCssParser->read_from_string($add_css);	
	$body_font = thz_get_option('body_font/size',14);
	
	$fonts = $ThzCssParser->find_parent_by_property('font-size');
	
	$dont_resize = apply_filters('thz_filter_dont_resize_font',array(
		'thz-logo',
		'icon',
	));
	
	foreach ($fonts as $font){
		
		$selector  = key($font);

		if($font[$selector]['font-size'] ==''){
			continue;
		}
				
		$font_size 	= (float) $font[$selector]['font-size'];
		$unit 		= str_replace($font_size,'',$font[$selector]['font-size']);

		if( 'em' == $unit || 'rem' == $unit || '' == $unit ){
			
			$font_size = (float) $body_font * $font_size;
			$unit = 'px';
			
		}
		
		if( ('px' == $unit && $font_size < 26 ) || 
			 preg_match("/\b(".implode('|',$dont_resize).")\b/", $selector) || 
			 'vw' == $unit || 'vh' == $unit || 'vmin' == $unit || 'vmax' == $unit || '%' == $unit
			 ){
			continue;
		}
		
		$re_mob_font_size = thz_resize_font('mobile',$font_size);
		$re_tab_font_size = thz_resize_font('tablet',$font_size);
		
		
		// mobiles
		if( $re_mob_font_size != $font_size ){
			$re_mob_css = $selector .'{';
			$re_mob_css .= 'font-size:'.thz_property_unit($re_mob_font_size,$unit).';';
			$re_mob_css .= '}';
			
			Thz_Doc::set('responsive', $re_mob_css, 767 );
			
		}
		
		// tablets
		if( $re_tab_font_size != $font_size ){
			$re_tab_css = $selector .'{';
			$re_tab_css .= 'font-size:'.thz_property_unit($re_tab_font_size,$unit).';';
			$re_tab_css .= '}';
			
			Thz_Doc::set('responsive', $re_tab_css, 979 );
			
		}
		
		
	}
	
	unset($fonts,$dont_resize,$ThzCssParser);

}


/**
 * Combine same CSS properties
 */
function thz_combine_css_properties($add_css){
	
	
	$ThzCssParser = new ThzCssParser();
	$ThzCssParser->read_from_string($add_css);	

	$add_css = $ThzCssParser->combine_css( array('color','font-size','background','background-color','line-height') );

	return $add_css;
	
}

/**
 * Element font classes
 */
function thz_font_classes($data, $use_css = true){
	
	if(!is_array($data)){
		return;
	}
	
	if(isset($data['classes']) && $data['classes'] !='' && $use_css) {
		return $data['classes'];	
	}
	
	$classes = array();
	
	if(isset($data['size']) ) {
		if($data['size'] != ''){
			$classes []= 'thz-fs-'.$data['size'];
		}
	}
	
	if(isset($data['weight']) ) {
		if($data['weight'] != 'default'){
			$classes []= 'thz-fw-'.str_replace('italic','',$data['weight']);
		}
	}
	
	if(isset($data['style']) ) {
		if($data['style'] != 'default'){
			$classes []= 'thz-font-'.$data['style'];
		}
	}
	
	if(isset($data['spacing']) ) {
		if($data['spacing'] != ''){
			$classes []= 'thz-lsp'.$data['spacing'];
		}
	}
	
	if(isset($data['transform']) ) {
		if($data['transform'] != 'default'){
			$classes []= 'thz-text-'.$data['transform'];
		}
	}
	
	if(isset($data['align']) ) {
		if($data['align'] != 'default'){
			$classes []= 'thz-align-'.$data['align'];
		}
	}
	
	
	if(!empty($classes)){
		
		$classes_out = thz_sanitize_class($classes);
		
		return $classes_out;
	}	
}
/**
 * Page title section CSS
 */
function _thz_page_title_section_css() {
	
	if( !thz_global_page_title() ){
		return;
	}	

	$atts 						= thz_get_option('page_title_options',null);
	$id 						= thz_akg('id',$atts);
	$id_out						= 'thz-pagetitle-container-'.$id;
	$overlay					= thz_akg('overlay/picked',$atts);
	$overlaybg					= thz_akg('overlay/active/overlaybg',$atts);
	$background_layers			= thz_akg('background_layers',$atts); 
	$page_title_mode 			= thz_get_option('page_title_metrics/mode','both');	
	$show_pagetitle				= $page_title_mode == 'both' || $page_title_mode == 'title' ? true : false;
	$show_breadcrumbs 			= $page_title_mode == 'both' || $page_title_mode == 'breadcrumbs' ? true : false;
	$show_subtitle 				= thz_get_option('pt_show_subtitle/picked','hide');	
	$add_css 					= '';

	// colorset
	$section_color_set			= thz_akg('sectioncolorset/picked',$atts);
	$section_color_set_print	= thz_print_colorset(thz_akg('sectioncolorset/custom/section_colors',$atts),'[data-cid='.'#'.$id_out.']');

	if($section_color_set == 'custom' && $section_color_set_print ){
		$add_css .= $section_color_set_print; 
	}

	// boxstyle
	$section_box_style			= thz_akg('section_boxstyle',$atts);
	$section_boxstyle_print		= thz_print_box_css($section_box_style);
	if(!empty($section_boxstyle_print)){
		$add_css .= '#'.$id_out.' section {'.$section_boxstyle_print.'}';
		
		$z_index = thz_akg('layout/z-index',$section_box_style);
		
		if($z_index && $z_index !='auto'){
			$add_css .= '#'.$id_out.'{';
			$add_css .=	'z-index:'.(int) $z_index.';';
			$add_css .=	'}';
		}
	}
	
	
	// container boxstyle
	$con_bs			= thz_akg('con_bs',$atts);
	$con_bs_print	= thz_print_box_css($con_bs);
	if(!empty($con_bs_print)){
		$add_css .= '#'.$id_out.' .thz-pagetitle {'.$con_bs_print.'}';
	}

	// containers spacings
	$con_s 	= thz_akg('spacings/con',$atts); 
	$col_s 	= thz_akg('spacings/col',$atts); 
	
	if($con_s !=''){
		$add_css .= '#'.$id_out.' section .thz-container{padding-left:'.thz_property_unit($con_s,'px').';padding-right:'.thz_property_unit($con_s,'px').';}';
	}
	if($col_s !=''){
		$add_css .= '#'.$id_out.' section .thz-row{margin-left:-'.thz_property_unit($col_s,'px').';}';
		$add_css .=	'#'.$id_out.' section * + .thz-row{margin-top:'.thz_property_unit($col_s,'px').';}';
		$add_css .= '#'.$id_out.' section .thz-column{padding-left:'.thz_property_unit($col_s,'px').';}';
	}

	
	if($show_pagetitle){
		
		// page title margin
		$page_title_margin		= thz_print_box_css(thz_get_option('page_title_margin',null));
		
		if(!empty($page_title_margin)){
			$add_css .= '#'.$id_out.' .thz-pagetitle-heading{'.$page_title_margin.'}';
		}
		
		// page title font settings
		$page_title_font 	= thz_typo_css(thz_get_option('page_title_font'));
		if(!empty($page_title_font )){
			
			$add_css .= '#'.$id_out.' .thz-pagetitle-heading{';
			$add_css .= $page_title_font;
			$add_css .= '}';
		}
		
	}
	
	
	if( $show_breadcrumbs ){
		
		$breadcrumb_tc 	= thz_get_option('pt_colors/text',null);							
		$breadcrumb_lc 	= thz_get_option('pt_colors/link',null);
		$breadcrumb_hc 	= thz_get_option('pt_colors/hover',null);	
		$breadcrumb_sep = thz_get_option('pt_colors/sep',null);
		
		$breadcrumb_font 	= thz_get_option('pt_font',array(
			'size' => 14,
			'weight' => 400,
			'spacing' => 0,
			'transform' => 'none',
			'style' => 'none',
			'color' =>''
		));
	
		$add_css .= '#'.$id_out.' .thz-breadcrumbs-links{';
		$add_css .= thz_typo_css($breadcrumb_font);
		if($breadcrumb_tc !=''){
			$add_css .= 'color:'.$breadcrumb_tc .';';
		}
		$add_css .= '}';

		if($breadcrumb_lc !=''){
			$add_css .= '#'.$id_out.' .thz-breadcrumbs-links a{';
			$add_css .= 'color:'.$breadcrumb_lc .';';
			$add_css .= '}';	
		}
		
		if($breadcrumb_hc !=''){
			$add_css .= '#'.$id_out.' .thz-breadcrumbs-links a:hover{';
			$add_css .= 'color:'.$breadcrumb_hc .';';
			$add_css .= '}';	
		}
		
		if( $breadcrumb_sep !=''){
			
			$add_css .= '#'.$id_out.' .thz-breadcrumbs-separator{';
			$add_css .='color:'.esc_attr($breadcrumb_sep).';';
			$add_css .='}';	
			
		}			
	}
	
	if($show_subtitle  =='show' ){
		
		// page title margin
		$subtitle_margin		= thz_print_box_css(thz_get_option('pt_show_subtitle/show/margin',null));
		

		if(!empty($subtitle_margin)){
			$add_css .= '#'.$id_out.' .thz-pagetitle-subtitle{'.$subtitle_margin.'}';
		}
		
		$subtitle_font		= thz_get_option('pt_show_subtitle/show/font',array(
			'size' => 18,
			'weight' => 400,
			'spacing' => 0,
			'transform' => 'none',
			'style' => 'none',

			'color' =>''
		));
		$add_css .= '#'.$id_out.' .thz-pagetitle-subtitle{';
		$add_css .= thz_typo_css($subtitle_font);
		$add_css .= '}';	
	}	
	
	
	// background layers
	if(!empty($background_layers)){
		
		$add_css .= thz_background_layers_css($background_layers);
	}
	
	
	if(!empty($add_css)){
		
		return $add_css;
	}

}

/**
 * Separators CSS
 */
function thz_separators_css($option,$container){

	if(empty($option)) {
		return;
	}

	$separator_type				= thz_akg('0/mx/t',$option);
	$separator_icon				= thz_akg('0/icon',$option);
	$separator_size				= (int)esc_attr(thz_akg('0/mx/s',$option));
	$separator_bg				= esc_attr(thz_akg('0/mx/b',$option));
	$separator_iconcolor		= esc_attr(thz_akg('0/iconcolor',$option));
	$separator_css				='';
	
	if( 'triangle' == $separator_type || 'circle' == $separator_type ){
			$separator_half = ($separator_size/2);
			$separator_css .= $container.' .thz-section-separator-'.$separator_type.'{'; 
			$separator_css .= 'width: '.$separator_size.'px;';
			$separator_css .= 'height: '.$separator_size.'px;';
			$separator_css .= 'margin-left: -'.$separator_half.'px;';
			$separator_css .= 'background:'.( empty($separator_bg) ? 'transparent': $separator_bg ).';';
		if($separator_type == 'circle'){
			$separator_css .='border-radius:'.$separator_half.'px;';
		}
			$separator_css .= '}';
			$separator_css .= $container.' .thz-ss-top{top:-'.$separator_half.'px;}';
			$separator_css .= $container.' .thz-ss-bottom{bottom:-'.$separator_half.'px;}';
		if(!empty($separator_icon)){
			$separator_css .= $container.' .thz-ss-icon{line-height:'.$separator_size.'px;color:'.$separator_iconcolor.';}';
		}
	}else if( 'arrow' == $separator_type ){
			$separator_css .= $container.' .thz-section-trans-separator-'.$separator_type.'{';
			$separator_css .= 'height:'.$separator_size.'px';
			$separator_css .= '}';
			$separator_css .= $container.' .thz-section-trans-separator-'.$separator_type.':before{';
			$separator_css .= 'border-right: '.$separator_size.'px solid transparent;';
			$separator_css .= '}';
			$separator_css .= $container.' .thz-section-trans-separator-'.$separator_type.':after{';
			$separator_css .= ' border-left: '.$separator_size.'px solid transparent;';
			$separator_css .= '}';
			$separator_css .= $container.' .thz-section-trans-separator-'.$separator_type.':before,'; 
			$separator_css .= $container.' .thz-section-trans-separator-'.$separator_type.':after{'; 
			$separator_css .= 'border-bottom:'.$separator_size.'px solid '.$separator_bg.';';
			$separator_css .= '}';
			
			$separator_css .= $container.' .thz-section-trans-separator-'.$separator_type.'.thz-ss-top:before,'; 
			$separator_css .= $container.' .thz-section-trans-separator-'.$separator_type.'.thz-ss-top:after{'; 
			$separator_css .= 'border-top:'.$separator_size.'px solid '.$separator_bg.';border-bottom:none;';
			$separator_css .= '}';
			
			if(!empty($separator_icon)){
				$separator_css .= $container.' .thz-ss-icon{color:'.$separator_iconcolor.';}';
			}			
	}else if( 'haflcircle' == $separator_type ){
		
			$separator_double = ($separator_size * 2);
			
			$separator_css .= $container.' .thz-section-trans-separator-haflcircle,';
			$separator_css .= $container.' .thz-haflcircle-holder{';
			$separator_css .= 'height:'.$separator_size.'px;';
			$separator_css .= '}';
			$separator_css .= $container.' .thz-section-trans-separator-haflcircle:before,';
			$separator_css .= $container.' .thz-section-trans-separator-haflcircle:after{';
			$separator_css .= 'height:'.$separator_size.'px;';
			$separator_css .= 'border-top:'.$separator_size.'px solid '.$separator_bg.';';
			$separator_css .= '}';
			$separator_css .= $container.' .thz-section-trans-separator-haflcircle:before{left:-'.$separator_size.'px;}';
			$separator_css .= $container.' .thz-section-trans-separator-haflcircle:after{right:-'.$separator_size.'px;}';
			$separator_css .= $container.' .thz-haflcircle{width:'.$separator_double.'px;height:'.$separator_double.'px;margin-left: -'.$separator_size.'px;}';
			$separator_css .= $container.' .thz-haflcircle:before{';
			$separator_css .= 'width:'.$separator_double.'px;height:'.$separator_double.'px;';
			$separator_css .= 'border-radius:'.$separator_double.'px;';
			$separator_css .= 'border: '.$separator_size.'px solid '.$separator_bg.';';
			$separator_css .= 'top: -'.$separator_double.'px;';
			$separator_css .= 'left: -'.$separator_size.'px;';
			$separator_css .= '}';
			$separator_css .= $container.' .thz-ss-top .thz-haflcircle:before{top: -'.$separator_size.'px;}';
			$separator_css .= $container.' .thz-separator-top-out{height:'.$separator_double.'px;}';
			$separator_css .= $container.' .thz-separator-bottom-out{height:'.$separator_double.'px;}';
			
			if(!empty($separator_icon)){
				$separator_css .= $container.' .thz-ss-icon{color:'.$separator_iconcolor.';}';
			}			
	}
		
	if(!empty($separator_css)){
		return $separator_css;
	}

}

/**
 * Featured image CSS
 */
function thz_featured_img_css($bg_array){
	
	
	if(!is_array($bg_array)){
		return;
	}
	
	$add_css 		= '';
	$bg_type	    = thz_akg('background/type',$bg_array);
	$featured_image	= thz_akg('background/image/url',$bg_array);
	$pageid 		= get_the_ID();
	$has_cat_image	= false;
	$thumbnail_id 	= get_post_thumbnail_id($pageid);
	
	if ( is_tax() || is_category() ) {
		
		$tax = is_tax() ? get_queried_object()->taxonomy : 'category';
		$has_cat_image = fw_get_db_term_option(get_queried_object_id(),$tax,'cat_image',null);
		$thumbnail_id = isset($has_cat_image['attachment_id']) ? $has_cat_image['attachment_id'] : null;
		if($has_cat_image){
			$has_cat_image = $has_cat_image['url'];
		}
	}
	
	
	if(class_exists( 'WooCommerce' )){
		
		
		if ( function_exists( 'is_woocommerce' ) ) {
			
			if( (is_shop() || is_cart() || is_checkout() || is_account_page()) ){
				
				$pageid = is_shop() ? wc_get_page_id('shop') : get_queried_object_id();
				$thumbnail_id 	= get_post_thumbnail_id($pageid);
				
			}else if ( is_product_category() ){
				
				global $wp_query;
				$cat 			= $wp_query->get_queried_object();
				$thumbnail_id 	= get_woocommerce_term_meta( $cat->term_id, 'thumbnail_id', true );
				$has_cat_image 	= wp_get_attachment_url( $thumbnail_id );			
			}
			
		}
		
	}
	
	
	if ('page' == get_option( 'show_on_front' ) && 	get_option( 'page_for_posts' ) != 0 && is_home() &&  !is_front_page() ) {
		
		$pageid =  get_option( 'page_for_posts' );
	}

	if($featured_image =='featured' && $bg_type =='image' && ( has_post_thumbnail($pageid) || $has_cat_image ) ){

		$featured_size = thz_get_post_option('featured_size','original');		
		
		if( !empty($featured_size) && $featured_size !='original' ){
			
			$featured_src = wp_get_attachment_image_src( $thumbnail_id ,$featured_size);
			
			if(isset($featured_src[0])){
			
				$featured_src = $featured_src[0];
			
			}else{
				
				$featured_src = $has_cat_image ? $has_cat_image : get_the_post_thumbnail_url($pageid);
			}
			
		}else{
			
			$featured_src = $has_cat_image ? $has_cat_image : get_the_post_thumbnail_url($pageid);
			
		}
		
		$add_css = 'background-image:url('.esc_url($featured_src).');';
		
	}
	
	if($add_css !=''){
		
		return $add_css;
	}
	
}


/**
 * thz-pageblock position CSS
 */
if ( ! function_exists( 'thz_page_block_positions_css' ) ) {
	
	function thz_page_block_positions_css(){
		
		$positions = get_option('thz_page_blocks_positions',array());
		
		if( thz_fw_loaded() && fw_ext('page-builder') && !empty( $positions ) ){
			
			foreach( $positions as $pb_id => $position ){
				
				if( 'unassigned' != $position && thz_page_block_visible( $pb_id )){
					
					$pb_content = fw_ext_page_builder_get_post_content( $pb_id );

					if( $pb_content ){
						
						//pageblock page CSS
						$pcss = fw_get_db_post_option ($pb_id,'pcss/0/css',null);
						
						if( !empty( $pcss )){
							Thz_Doc::set( 'cssinhead', $pcss, false, 'pb:css:'.$pb_id );
						}
						
						//pageblock shortcodes CSS
						fw_ext_shortcodes_enqueue_shortcodes_static( $pb_content );
						
					}					
					
				}
			}
			
		}

	}
	
	
}

/**
* thz-pageblock CSS
*/
function thz_page_blocks_css( $page_blocks ){
	
	$enqued = false;
	
	if( fw_ext('page-builder') && !empty( $page_blocks ) ){
		
		foreach( $page_blocks as $pb_id ){

			if( thz_page_block_visible( $pb_id ) ){
				
				$pb_content = fw_ext_page_builder_get_post_content( $pb_id );
				
				if( $pb_content ){
					
					//pageblock page CSS
					$pcss = fw_get_db_post_option ($pb_id,'pcss/0/css',null);
					
					if( !empty( $pcss )){
						Thz_Doc::set( 'cssinhead', $pcss, false, 'pb:css:'.$pb_id );
					}
					
					//pageblock shortcodes CSS
					fw_ext_shortcodes_enqueue_shortcodes_static( $pb_content );
					$enqued = true;
					
				}
			}			
			
		}
	}
	

	return $enqued;
}


/**
 * Hero section CSS
 */
function _thz_hero_section_css() {
	
	$atts 	= thz_get_hero_options();
	
	if(empty($atts)){
		return;
	}
	
	if(isset($atts['disable'])){
		
		if($atts['disable'] === 'inactive'){
			return;
		}
	}
	

	$hero_type				= thz_akg('hero_type/picked',$atts,'none'); 
	
	// if page block we dont need to print anything else
	if($hero_type == 'block' && fw_ext('page-builder')){
		
		$page_blocks = thz_akg('hero_type/block/pb',$atts,null);
		
		if( thz_page_blocks_css( $page_blocks ) ){
			return;
		}
	}
	
	$id 					= thz_akg('id',$atts);
	$css_id 				= thz_akg('cmx/i',$atts);
	$id_out					= !empty($css_id) ? str_replace(' ','',$css_id): 'thz-section-holder-s'.$id;
	$add_css 				= '';
	

	// colorset
	$section_color_set			= thz_akg('tl',$atts,'');
	if(!empty($section_color_set)){
		$hero_colors_print = thz_print_colorset(thz_akg('tl/0/c',$atts),'#'.$id_out.'');  
		if($hero_colors_print){
			$add_css  .= $hero_colors_print; 
		}
	}

	// boxstyle
	$section_box_style			= thz_akg('bs',$atts);
	$section_boxstyle_print		= thz_print_box_css($section_box_style);

	
	if(!empty($section_boxstyle_print)){
		$add_css  .= '#'.$id_out.' section {'.$section_boxstyle_print.'}';
		
		$z_index = thz_akg('layout/z-index',$section_box_style);
		
		if($z_index && $z_index !='auto'){
			$add_css .= '#'.$id_out.'{';
			$add_css .=	'z-index:'.(int) $z_index.';';
			$add_css .=	'}';
		}
		
		$featured_image = thz_featured_img_css(thz_akg('bs',$atts));
		if($featured_image){
			$add_css  .= '#'.$id_out.' section {'.$featured_image.'}';
		}
	}
	
	// containers spacings
	$con_s 	= thz_akg('spacings/con',$atts); 
	$col_s 	= thz_akg('spacings/col',$atts); 
	
	if($con_s !=''){
		$add_css .= '#'.$id_out.' section .thz-container{padding-left:'.thz_property_unit($con_s,'px').';padding-right:'.thz_property_unit($con_s,'px').';}';
	}
	if($col_s !=''){
		$add_css .= '#'.$id_out.' section .thz-row{margin-left:-'.thz_property_unit($col_s,'px').';}';
		$add_css .=	'#'.$id_out.' section * + .thz-row{margin-top:'.thz_property_unit($col_s,'px').';}';
		$add_css .= '#'.$id_out.' section .thz-column{padding-left:'.thz_property_unit($col_s,'px').';}';
	}

	// vieport height
	
	$fullheight					= thz_akg('fh',$atts);
	$vpheight					= (int) thz_akg('fh/0/height',$atts);	
	
	if(!empty($fullheight)){
			
		$top_p 		=  thz_akg('bs/padding/top',$atts);
		$bot_p 		=  thz_akg('bs/padding/bottom',$atts);
		$total_p 	= (int) $top_p + (int) $bot_p;
		$total_p 	= thz_body_frame_fh($total_p);	 
		$vpheight 	= $total_p > 0 ? 'calc('.$vpheight.'vh - '.$total_p.'px)': $vpheight.'vh';
		$add_css  .= '#'.$id_out.' .thz-full-height .thz-full-height-in{height:'.$vpheight.';}';
	}
	

	// separator
	$separator	  = thz_akg('se',$atts);
	$add_css  .= thz_separators_css($separator,'#'.$id_out.'');
	
	// section font settings
	if($hero_type == 'editor'){
		$section_font_settings = thz_akg('tf',$atts);
		if(!empty($section_font_settings )){
			
			$section_font 				= thz_akg('tf/0/f',$atts);
			$section_headings_font 		= thz_akg('tf/0/h',$atts);
			
			$h1_font 					= thz_typo_css(thz_akg('tf/0/h1',$atts));
			$h2_font 					= thz_typo_css(thz_akg('tf/0/h2',$atts));
			$h3_font 					= thz_typo_css(thz_akg('tf/0/h3',$atts));
			$h4_font 					= thz_typo_css(thz_akg('tf/0/h4',$atts));
			$h5_font  					= thz_typo_css(thz_akg('tf/0/h5',$atts));
			$h6_font  					= thz_typo_css(thz_akg('tf/0/h6',$atts));
			
			
			$section_font_print 		= thz_typo_css($section_font);
			$section_heading_font_print = thz_typo_css($section_headings_font);
			
			
			$add_css  .='#'.$id_out.'{'.$section_font_print.'}';
			$add_css  .='#'.$id_out.' h1{'.$section_heading_font_print.$h1_font.'}';
			$add_css  .='#'.$id_out.' h2{'.$section_heading_font_print.$h2_font.'}';
			$add_css  .='#'.$id_out.' h3{'.$section_heading_font_print.$h3_font.'}';
			$add_css  .='#'.$id_out.' h4{'.$section_heading_font_print.$h4_font.'}';
			$add_css  .='#'.$id_out.' h5{'.$section_heading_font_print.$h5_font.'}';
			$add_css  .='#'.$id_out.' h6{'.$section_heading_font_print.$h6_font.'}';
		}
		

	}
	
	// title  
	if($hero_type == 'title'){
		
		$tag 					= thz_akg('hptm/tag',$atts,'h2');
		$title_font				= thz_akg('hpt_f',$atts);
		$title_show_sub			= thz_akg('hptm/s',$atts,'s');
		$title_bs				= thz_print_box_css(thz_akg('hpt_bs',$atts));

		if(!empty($title_bs)){
			$add_css  .='.thz-hero-post-title{';
			$add_css  .= $title_bs;
			$add_css  .='}';
		}
		

		// avatar
		$show_avatar		= thz_akg('hpt_aum/show',$atts,'hide');
		
		if (function_exists('get_avatar') && $show_avatar == 'show') {
			
			$avatar_size 	= thz_akg('hpt_aum/size',$atts,50);
			
			$add_css  .='.thz-hero-post-title .thz-author-avatar{';
			$add_css  .= 'min-height:'.thz_property_unit($avatar_size,'px').';';
			$add_css  .= 'min-width:'.thz_property_unit($avatar_size,'px').';';

			$add_css  .='}';

		
		}
		
		

		
		$add_css  .='.thz-hero-post-title-heading{'.thz_typo_css( $title_font ).'}';

		// sub
		if($title_show_sub !='h'){
			$title_sub_font 	= thz_akg('hpt_sf',$atts);
			$title_sub_text 	= thz_akg('hpt_sm/text',$atts);
			$title_sub_sep 		= thz_akg('hpt_sm/sep',$atts);
			$title_sub_headings	= thz_akg('hpt_sm/headings',$atts);
			$title_sub_link 	= thz_akg('hpt_sm/link',$atts);
			$title_sub_hover 	= thz_akg('hpt_sm/hover',$atts);
			$title_sub_bs	 	= thz_print_box_css(thz_akg('hpt_sbs',$atts));
	
			$add_css  .='.thz-hero-post-title-sub{';
			if(!empty($title_sub_bs)){
				$add_css  .= $title_sub_bs;
			}
			$add_css  .= thz_typo_css( $title_sub_font );
			if($title_sub_text !=''){
				$add_css  .='color:'.$title_sub_text.';';
			}
			$add_css  .='}';
			
			if($title_sub_headings !=''){
				$add_css  .='.thz-hero-post-title-sub h1,';
				$add_css  .='.thz-hero-post-title-sub h2,';
				$add_css  .='.thz-hero-post-title-sub h3,';
				$add_css  .='.thz-hero-post-title-sub h4,';
				$add_css  .='.thz-hero-post-title-sub h5,';
				$add_css  .='.thz-hero-post-title-sub h6{';
				$add_css  .='color:'.$title_sub_headings.';';
				$add_css  .='}';
			}
			
			if($title_sub_link !=''){
				$add_css  .='.thz-hero-post-title-sub a{';
				$add_css  .='color:'.$title_sub_link.';';
				$add_css  .='}';
			}
			
			if($title_sub_hover !=''){
				$add_css  .='.thz-hero-post-title-sub a:hover{';
				$add_css  .='color:'.$title_sub_hover.';';
				$add_css  .='}';
			}
			
			if( $title_sub_sep !=''){
				
				$add_css .='.thz-hero-post-title-sub .thz-title-sub-spacer{';
				$add_css .='color:'.esc_attr($title_sub_sep).';';
				$add_css .='}';	
				
			}
		}
	}
	
	// arrow
	if($hero_type =='title' || $hero_type =='editor'){
		
		$show_arrow		= thz_akg($hero_type.'/arrow/s',$atts,'show');
		
		if( 'show' == $show_arrow){
			$arrow_color  = thz_akg('hero_type/'.$hero_type.'/arrow/c',$atts,'#ffffff');
			$arrow_size  = thz_akg('hero_type/'.$hero_type.'/arrow/si',$atts, 22);

			
			$add_css  .='.thz-section-scroll-arrow,';
			$add_css  .='.thz-section-scroll-arrow:focus,';
			$add_css  .='.thz-section-scroll-arrow:hover{';
			$add_css  .='font-size:'.thz_property_unit($arrow_size,'px').';';
			$add_css  .='width:'.thz_property_unit($arrow_size,'px').';';
			$add_css  .='margin-left:-'.($arrow_size/2).'px;';
			$add_css  .='color:'.$arrow_color.';';
			$add_css  .='}';
			
		}		
		
	}
	
	// background layers
	$background_layers			= thz_akg('bl',$atts); 
	if(!empty($background_layers)){
		
		$add_css  .= thz_background_layers_css($background_layers);
	}
	
	// slider css
	if( $hero_type =='slider' ){
		$slider_id	= thz_akg('hero_type/slider/id',$atts,'');
		$slider_data = fw_get_db_post_option($slider_id);
		$add_css  .= _thz_slider_css ($slider_data,true,$slider_id);
	}
	
	// responsive hero
	$res 		= thz_akg('res',$atts,array()); 
	if(!empty($res)){
		foreach($res as $s_bp){
			
			$at = thz_akg('m/b',$s_bp);
			
			$re_section_bs		= thz_print_box_css(thz_akg('b',$s_bp));
			$re_section_t_bs	= thz_print_box_css(thz_akg('tb',$s_bp));
			$re_section_st_bs	= thz_print_box_css(thz_akg('stb',$s_bp));
			$res_add_css 		= false;
			
			if(!empty($re_section_bs)){
				$res_add_css .= '#'.$id_out.' section {'.$re_section_bs.'}';
			}
			
			if(!empty($re_section_t_bs)){
				$res_add_css .= '#'.$id_out.' .thz-hero-post-title {'.$re_section_t_bs.'}';
			}
			
			if(!empty($re_section_st_bs)){
				$res_add_css .= '#'.$id_out.' .thz-hero-post-title-sub {'.$re_section_st_bs.'}';
				
			}
			if($res_add_css){
				Thz_Doc::set('responsive', $res_add_css, $at );
			}
			
			unset($s_bp);

		}
		unset($res);
	}
	
	// enque shortcode css if content is editor
	_thz_hero_editor_shortcodes_static();

	
	if(!empty($add_css )){
		
		return $add_css ;
	}

}


/**
 * Hero section type editor, print shortcodes static
 */
function _thz_hero_editor_shortcodes_static(){

	$atts 		= thz_get_hero_options();
	$hero_type	= thz_akg('hero_type/picked',$atts,'none');
	$sub_mode 	= thz_akg('hpt_sm/mode',$atts,'elements');
	
	
	if($hero_type =='editor'){
		$content	= thz_akg('hero_type/editor/e',$atts,'');
		fw_ext_shortcodes_enqueue_shortcodes_static($content);
	}
	
	if('custom' == $sub_mode){
		
		$sub =  thz_akg('hpt_stx',$atts,'');
		fw_ext_shortcodes_enqueue_shortcodes_static($sub);
	}
	
	
}

/**
 * Background layers css
 */
function thz_background_layers_css($array){
	
	if(empty($array)) {
		return;
	}
	
	$bg_css 	= new Thz_Css_Generator();
	$css = '';
	
	$layercount = count($array);
	
	foreach ($array as $key => $layer){
		
		$id             = thz_akg( 'id', $layer );
		$css_id 		= thz_akg('lre/i',$layer);
		$id_out			= !empty($css_id) ? str_replace(' ','',$css_id): 'thz-bglayer-'.$id;
		$css_class 		= thz_akg('lre/c',$layer);
		$type 			= thz_akg('layer_type/picked',$layer);
		$bg_type		= thz_akg('layer_type/'.$type.'/background/type',$layer);
		$bg				= array('background'=>thz_akg('layer_type/'.$type.'/background',$layer)); 
		$size 			= thz_akg('dimensions/picked',$layer);
		$animate_ac		= thz_akg('layeranimate/animate',$layer);
		$opacity 		= thz_akg('opacity',$layer);
		
		$dimensions_css	= '';
		$zindex 		= $layercount - 1 - $key;

		if($size == 'custom'){
			
			$pozO			= 'dimensions/custom/position/';
			$bs				= thz_print_box_css( thz_akg('dimensions/custom/bs',$layer));
			$top			= thz_akg($pozO.'top',$layer) == 'auto' ? thz_akg($pozO.'top',$layer) : thz_property_unit (thz_akg($pozO.'top',$layer),'px');
			$right			= thz_akg($pozO.'right',$layer)== 'auto' ? thz_akg($pozO.'right',$layer) : thz_property_unit (thz_akg($pozO.'right',$layer),'px');
			$bottom			= thz_akg($pozO.'bottom',$layer)== 'auto' ? thz_akg($pozO.'bottom',$layer) : thz_property_unit (thz_akg($pozO.'bottom',$layer),'px');
			$left			= thz_akg($pozO.'left',$layer)== 'auto' ? thz_akg($pozO.'left',$layer) : thz_property_unit (thz_akg($pozO.'left',$layer),'px');
			$dimensions_css	= '';
	
			if( $bs !='' ){
				$dimensions_css	.= $bs;
			}		

			if( $top !=''){
				$dimensions_css .='top:'.$top.';';
			}
			if( $right !=''){
				$dimensions_css .='right:'.$right.';';
			}
			if( $bottom !=''){
				$dimensions_css .='bottom:'.$bottom.';';
			}
			if( $left !=''){
				$dimensions_css .='left:'.$left.';';
			}
	
			
		}
		if($type == 'scroll'){
		
			$css .='#'.$id_out.'{'.$bg_css->background($bg).$dimensions_css.'z-index:'.$zindex.';}';
			
		}
		
		if($type == 'infinity'){
			$css .='#'.$id_out.' .thz-infinity-bg::before,#'.$id_out.' .thz-infinity-bg::after{'.$bg_css->background($bg).'}';
			
			if($size == 'custom'){
				$css .='#'.$id_out.'.thz-infinity{'.$dimensions_css.'z-index:'.$zindex.';}';
			}else{
				$css .='#'.$id_out.'.thz-infinity{z-index:'.$zindex.';}';
			}
		}
		
		if($type == 'basic'){
		
			$css .='#'.$id_out.'{'.$bg_css->background($bg).$dimensions_css.'z-index:'.$zindex.';}';
		
		}
		
		if($bg_type == 'shape'){

			$shape 				= thz_akg('layer_type/'.$type.'/background/shape/s',$layer);
			$shape_fill 		= thz_akg('layer_type/'.$type.'/background/shape/c',$layer);
			$shape_background 	= thz_akg('layer_type/'.$type.'/background/shape/b',$layer);
			$shape_width		= thz_akg('layer_type/'.$type.'/background/shape/w',$layer);
			$shape_height		= thz_akg('layer_type/'.$type.'/background/shape/h',$layer);	

			
			
			if($shape_background !=''){
				$css .='#'.$id_out.'{';
				$css .='background:'.$shape_background.';';
				$css .='}';
			}
			
			if($shape_width > 100 || $shape_height > 0  || $shape_fill !=''){	
			
				$css .='#'.$id_out.' svg.thz-svg-shape{';
				if($shape_width > 100 ){
					$css .='width:'.thz_property_unit($shape_width,'%').';';
				}
				if($shape_height > 0 ){
					$css .='height:'.thz_property_unit($shape_height,'px').';';
				}
				if($shape_fill !=''){
					
					if(strpos($shape,'-stroke') !== false ){
						$css .='stroke:'.$shape_fill.';';
					}else{
						$css .='fill:'.$shape_fill.';';
					}
				}
				$css .='}';
				
				if($shape_fill !=''){
					$css .='#'.$id_out.' svg.thz-svg-shape *{';
						if(strpos($shape,'-stroke') !== false ){
							$css .='stroke:'.$shape_fill.';';
						}else{
							$css .='fill:'.$shape_fill.';';
						}					
					$css .='}';
				}
			
			}
		
		}
		
		$featured_image = thz_featured_img_css($bg);
		if($featured_image){
			$css .= '#'.$id_out.'{'.$featured_image.'}';
		}
		
		if($animate_ac	=== 'active'){
			
			$css .='#'.$id_out.'-animation{z-index:'.$zindex.';}';
		}

		if($opacity < 100){
			
			
			$opacity = $opacity > 0 ? $opacity / 100 : 0;
			
			if($type == 'scroll'){
				
				$css .='#'.$id_out.'.thz-parallaxing,#'.$id_out.'.thz-no-mobile-parallax{opacity:'.$opacity.';}';
				
			}else{
				
				$css .='#'.$id_out.'{opacity:'.$opacity.';}';
				
			}
		}

	}

	
	return $css;
}


/**
* Colorset CSS
*/
 function thz_print_colorset($colors_array,$container,$exclude_button = true){
	
	if (empty($colors_array) || count(array_filter($colors_array)) == 0) {
		return;
	}
	
	$css ='';
	$not = $exclude_button ? ':not(.thz-button)' : '';

	foreach ($colors_array as $property => $value){
		
		
		$element_name = $container;
		
		if( $property == 'link_color'){
			$element_name = $container. ' a'.$not;
			
			$css .=	$container." .thz-btn-none{color:".esc_attr($value).";}";
		}
		
		if( $property == 'link_hover_color'){
			$element_name = $container. ' a'.$not.':hover';
			$css .=	$container." .thz-btn-none:hover,".$container." .thz-btn-hover .thz-btn-none{color:".esc_attr($value).";}";
		}
		
		if( $property == 'headings_color'){
			$element_name = $container.' h1,'.$container.' h2,'.$container.' h3,'.$container.' h4,'.$container.' h5,'.$container.' h6 ';
		}
		
		$css .= $element_name . '{color:'. esc_attr($value) .';}';
		
		
	}
	
	return $css;
	
	
}


/**
 * Thz slider CSS
 */
if(!function_exists('_thz_slider_css')){
	
	function _thz_slider_css ($data,$hero = false,$sliderID = false) {
		

		$atts 			=  $hero ? null : _thz_shortcode_options($data,'slider');
		$slider_id 		=  $hero ? $sliderID : thz_akg('slider_id',$atts);	
		
		if(!$slider_id && !is_numeric( $slider_id )){
			return;
		}
		
 		$slider_options = $hero ? $data : fw_get_db_post_option($slider_id);
		$css_id 		= thz_akg('custom-settings/style/cmx/i',$slider_options);
		$id_out			= !empty($css_id) ? str_replace(' ','',$css_id): 'thz-slider-'.$slider_id;
		
		$bs				= thz_print_box_css(thz_akg('custom-settings/style/bs',$slider_options));
		$slider_type	= thz_akg('slider/selected',$slider_options);
		$add_css		= '';
		
		
		if($bs !=''){
			$add_css .='#'.$id_out.'.thz-slick-holder{';
			$add_css .= $bs;
			$add_css .='}';
		}
		
		if($slider_type =='slick-full'){
			
			$bg				= thz_akg('custom-settings/style/bg',$slider_options,'#222222');
			$slides			= thz_akg('custom-slides',$slider_options,array()); 
			$ratio			= thz_akg('custom-settings/ratio/picked',$slider_options,'');
			
			// height
			if($ratio == 'custom' ){
				$height	 = thz_akg('custom-settings/ratio/custom/height',$slider_options,'');
				$add_css .='#'.$id_out.' .thz-aspect.custom{height:'.thz_property_unit($height,'px').';}';
			}
	
			
			// typography
			$tf 		= thz_typo_css(thz_akg('custom-settings/style/t',$slider_options,''));
			$sf 		= thz_typo_css(thz_akg('custom-settings/style/s',$slider_options,''));
			$df 		= thz_typo_css(thz_akg('custom-settings/style/d',$slider_options,''));
			
			//per slide options
			if(!empty($slides)){
				
				foreach ($slides as $key => $slide){
					
					//colors
					$t = thz_akg('extra-options/colors/t',$slide);
					$s = thz_akg('extra-options/colors/s',$slide);
					$d = thz_akg('extra-options/colors/d',$slide); 
					$o = thz_akg('extra-options/colors/o',$slide);
					
					// metrics
					$max_width		= thz_akg('extra-options/smx/w',$slide);
					$position		= thz_akg('extra-options/smx/p',$slide);
					$align			= thz_akg('extra-options/smx/a',$slide);
					$add_css .= '#'.$id_out.'-s-'.$key.' .thz-sliders-content{';
					$add_css .= 'max-width:'.thz_property_unit($max_width,'%').';';
					if($align !='default'){
						$add_css .= 'text-align:'.$align.';';
					}
					if($position !='center'){
						$add_css .= 'float:'.$position.';';
					}
					$add_css .='}';	
					
					if($t !=''){
						$add_css .='#'.$id_out.'-s-'.$key.' .thz-sliders-title{color:'.$t.';}';
					}
					if($s !=''){
						$add_css .='#'.$id_out.'-s-'.$key.' .thz-sliders-sub{color:'.$s.';}';
					}
					if($d !=''){
						$add_css .='#'.$id_out.'-s-'.$key.' .thz-sliders-desc{color:'.$d.';}';
					}
					
					if($o !=''){
						$add_css .='#'.$id_out.'-s-'.$key.' .thz-sliders-img:before{background:'.$o.';}';
					}				
					
					
					// margins
					$tm	   		= thz_akg('extra-options/tm',$slide);
					$sm	   		= thz_akg('extra-options/sm',$slide);
					$dm	   		= thz_akg('extra-options/dm',$slide);
					$bm	   		= thz_akg('extra-options/bm',$slide);
					
					$tm_print	= thz_print_box_css($tm);
					$sm_print	= thz_print_box_css($sm);
					$dm_print	= thz_print_box_css($dm);
					$bm_print	= thz_print_box_css($bm);
			
					$add_css .= '#'.$id_out.'-s-'.$key.' .thz-sliders-title{';
					$add_css .= $tf;
					if(!empty($tm_print)){
						$add_css .=$tm_print;
					}
					$add_css .='}';
					$add_css .= '#'.$id_out.'-s-'.$key.' .thz-sliders-sub{';
					$add_css .= $sf;
					if(!empty($sm_print)){
						$add_css .=$sm_print;
					}
					$add_css .='}';
					$add_css .= '#'.$id_out.'-s-'.$key.' .thz-sliders-desc{';
					$add_css .= $df;
					if(!empty($dm_print)){
						$add_css .=$dm_print;
					}
					$add_css .='}';
					
					if(!empty($bm_print)){
						$add_css .= '#'.$id_out.'-s-'.$key.' .thz-sliders-buttons{';
						$add_css .=$bm_print;
						$add_css .='}';
					}
					
					
					//buttons
					$btns		= thz_akg('extra-options/btns',$slide);
					
					foreach($btns as $btn){
						
						$button_data = thz_akg('b',$btn);
						$add_css .= thz_print_button_css($button_data,'#'.$id_out.'-s-'.$key);
						
					}
				}
				
			}
			
			// navigations
			$nav_ar	  = thz_akg('custom-settings/style/nav',$slider_options,null);
			$arr_ar	  = thz_akg('custom-settings/style/arr',$slider_options,null);
			$add_css  .= _thz_slider_navigations_css($nav_ar,$arr_ar,'#thz-sf-'.$slider_id.'.thz-slick-slider');

			// custom css
			$custom_css	= thz_akg('custom-settings/style/css',$slider_options,'');
			if($custom_css !=''){
				$add_css .= thz_remove_empty_lines(wp_strip_all_tags($custom_css));
			}
		}
		
		if( $add_css !=''){
			
			Thz_Doc::set( 'cssinhead', $add_css );
		}
		
	}
	
}


/**
 * Slick sliders navigations CSS
 */
function _thz_slider_navigations_css($nav,$arr,$selector){
	
	
	$add_css ='';
	
	// nav dots
	$show_dots	= thz_akg('show',$nav,'inside');
	
	if($show_dots !='hide'){
		
		$dost_style	= thz_akg('style',$nav,'rings');
		
		$ring 		= thz_akg('ring',$nav,'#ffffff');
		$dot 		= thz_akg('dot',$nav,'#000000');
		$idot 		= thz_akg('idot',$nav,'#000000');
		$dpoz		= thz_akg('p',$nav,'bc');
		
		
		if('c' == $dpoz){

			$top 		= thz_akg('t',$nav,'auto');
			$right 		= thz_akg('r',$nav,'0px');
			$bottom 	= thz_akg('b',$nav,'100px');
			$left 		= thz_akg('l',$nav,'0px');
		
			$add_css .= $selector.' > .slick-dots{';
			if($top !=''){
				$add_css .='top:'.thz_property_unit($top,'px',true).';';
			}
			if($right !=''){
				$add_css .='right:'.thz_property_unit($right,'px',true).';';
			}
			if($bottom !=''){
				$add_css .='bottom:'.thz_property_unit($bottom,'px',true).';';
			}
			if($left !=''){
				$add_css .='left:'.thz_property_unit($left,'px',true).';';
			}
			if($left =='auto' && $right !='auto'){
				$add_css .='min-width:1.3px;';
			}else if($right =='auto' && $left !='auto'){
				$add_css .='min-width:2.3px;';
			}
			$add_css .='}';					
			
		}
		
	
		if('rings' == $dost_style){
			
			$add_css .= $selector.' > .slick-dots > li.slick-active{';
			$add_css .='background:'.esc_attr($dot).';';
			$add_css .='}';	
		}	
		
		$add_css .= $selector.' > .slick-dots > li button:before{';
		if('rings' == $dost_style){
			$add_css .='border-color:'.esc_attr($ring).';';
		}else{
			$add_css .='background:'.esc_attr($idot).';';
		}
		$add_css .='}';	
		
		$add_css .= $selector.' > .slick-dots > li.slick-active button:before{';
		if('rings' == $dost_style){
			$add_css .='border-color:'.esc_attr($ring).';';
		}else{
			$add_css .='background:'.esc_attr($dot).';';
		}
		$add_css .='}';	
		
	}
	
	// arrows 
	$arrows_show  = thz_akg('show',$arr,'show');
	if($arrows_show =='show'){
	
		$arrows_color 	= thz_akg('color',$arr,'#ffffff');
		$arrows_size  	= thz_akg('size',$arr,28);
		$shapetype  	= thz_akg('shapetype',$arr,'rounded');
		$shapesize  	= thz_akg('shapesize',$arr,40);
		$shapebg  		= thz_akg('shapebg',$arr,'');
		$radius			= false;
		
		if($shapetype =='circle'){
			
			$radius	 = '100%';
			
		}else if($shapetype =='rounded'){
			
			$radius	 = '4px';
		}

		$add_css .= $selector.' > .slick-prev,';
		$add_css .= $selector.' > .slick-next{';
		$add_css .='width:'.thz_property_unit($shapesize,'px').';';	
		$add_css .='height:'.thz_property_unit($shapesize,'px').';';				
		$add_css .='}';
		
	
		$add_css .= $selector.' > .slick-prev:before,';
		$add_css .= $selector.' > .slick-next:before{';
		$add_css .='width:'.thz_property_unit($shapesize,'px').';';	
		$add_css .='height:'.thz_property_unit($shapesize,'px').';';
		$add_css .='line-height:'.thz_property_unit($shapesize,'px').';';
		$add_css .='font-size:'.thz_property_unit($arrows_size,'px').';';
		$add_css .='color:'.esc_attr($arrows_color).';';
		if($shapebg == ''){
			$add_css .='background:none;';
		}else{
			$add_css .='background:'.$shapebg.';';

		}
		if($radius){
			$add_css .='border-radius:'.$radius.';';
		}
		$add_css .='}';
		
	}	
	
	if( $add_css !=''){
		return $add_css;
	}
	
}



/**
* Print sidbears CSS
*/
function _thz_sidebars_css($atts = false, $sidebar = false){
	
	$add_css ='';
	
	$atts 		= $atts ? $atts : thz_get_option('sb_style',null) ;
	$sidebar 	= $sidebar ? $sidebar : 'aside .thz-sidebars';
	
	$sb_bs 		= thz_print_box_css ( thz_akg('sb_bs',$atts,null) ); 
	$wi_bs 		= thz_print_box_css ( thz_akg('wi_bs',$atts,null) );
	$wi_tbs 	= thz_print_box_css ( thz_akg('wi_tbs',$atts,null) );
	$wi_tagbs	= thz_print_box_css ( thz_akg('wi_tagbs',$atts,null) ); 
	$wi_tagfm 	= thz_typo_css(thz_akg('wi_tagfm',$atts));
	$wi_tagfm_h = thz_akg('wi_tagfm/hovered',$atts);
	$wi_tx 		= thz_akg('wi_metrics/tx',$atts);
	$wi_he 		= thz_akg('wi_metrics/he',$atts);
	$wi_tf 		= thz_typo_css(thz_akg('wi_title',$atts));
	$wi_li 		= thz_akg('wi_metrics/li',$atts,null);
	$wi_lih 	= thz_akg('wi_metrics/lih',$atts,null);
	$wi_set 	= thz_akg('wi_metrics/set',$atts,null);
	$wi_seb 	= thz_akg('wi_metrics/seb',$atts,null);
	$wi_sep 	= thz_akg('wi_metrics/sep',$atts,null);
	
	if(!empty($sb_bs)){
		
		$add_css .= $sidebar.'{';
		$add_css .= $sb_bs;
		$add_css .='}';
	}
	
	if(!empty($wi_bs) || !empty($wi_tx)){
		
		$add_css .= $sidebar.' .widget{';
		if(!empty($wi_bs)){
			$add_css .= $wi_bs;
		}
		if(!empty($wi_tx)){
			$add_css .= 'color:'.$wi_tx.';';
		}
		$add_css .='}';
	}

	if(!empty($wi_he)){
		
		$add_css .= $sidebar.' h1,';
		$add_css .= $sidebar.' h2,';
		$add_css .= $sidebar.' h3,';
		$add_css .= $sidebar.' h4,';
		$add_css .= $sidebar.' h5,';
		$add_css .= $sidebar.' h6{';
		$add_css .= 'color:'.$wi_he.';';
		$add_css .='}';
	}
		
	if(!empty($wi_tbs) || !empty($wi_tf)){
		
		$add_css .= $sidebar.' .widget-title{';
		if(!empty($wi_tbs)){
			$add_css .= $wi_tbs;
		}
		if(!empty($wi_tf)){
			$add_css .= $wi_tf;
		}
		$add_css .='}';
	}
	
	if(!empty($wi_li)){
		
		$add_css .= $sidebar.' a{';
		$add_css .= 'color:'.$wi_li.';';
		$add_css .='}';
	}
	
	if(!empty($wi_lih)){
		
		$add_css .= $sidebar.' a:hover{';
		$add_css .= 'color:'.$wi_lih.';';
		$add_css .='}';
	}
	
	
	if(!empty($wi_set) || !empty($wi_seb) || !empty($wi_sep)){
		
		$add_css .= $sidebar.' .thz-has-list:not(.thz-is-nav) li,';
		$add_css .= $sidebar.' .thz-has-list.thz-is-nav ul li a{';
		if(!empty($wi_set)){
			$add_css .= 'padding-top:'.thz_property_unit($wi_set,'px').';';
		}
		if(!empty($wi_seb)){
			$add_css .= 'padding-bottom:'.thz_property_unit($wi_seb,'px').';';
		}
		if(!empty($wi_sep)){
			$add_css .= 'border-color:'.$wi_sep.';';
		}
		$add_css .='}';
		
		if(!empty($wi_set)){
			
			$add_css .= $sidebar.' .thz-has-list ul li > span.count{';
			$add_css .= 'top:'.thz_property_unit($wi_set,'px').';';
			$add_css .='}';
		}
	}
	
	// tags widget
	if(!empty($wi_tagbs) || !empty($wi_tagfm)){
		
		$add_css .= $sidebar.' .widget_tag_cloud .tagcloud a{';
		if(!empty($wi_tagbs)){
			$add_css .= $wi_tagbs;
		}
		if(!empty($wi_tagfm)){
			$add_css .= $wi_tagfm;
		}
		$add_css .='}';
		
	}
	
	// tags widget hovered	
	if(!empty($wi_tagfm_h)){
		$add_css .= $sidebar.' .widget_tag_cloud .tagcloud a:hover{';
		$add_css .= 'color:'.$wi_tagfm_h.';';
		$add_css .='}';	
	}

	if( $add_css !=''){
		
		return  $add_css;
	}	
}

/**
 * Site CSS
 */
function _thz_site_dynamic_css(){
	
	$header_type 	= thz_get_option('headers/picked','inline');

	$footer_lsoc	= thz_get_option('foc/l','b');
	$footer_msoc	= thz_get_option('foc/m','h');
	$footer_rsoc	= thz_get_option('foc/r','s');
		
	// containers css
	$add_css  = _thz_containers_css();

	// typography css
	$add_css .= _thz_typography_css();

	// header css
	$add_css .= _thz_header_css();
	
	// socials css
	if($header_type =='stacked' || $header_type =='inline' || $header_type =='centered'){
		
		$toolbar		= thz_get_option('htb/picked','show');
		$toolbar_lsoc	= thz_get_option('htb/show/c/l','p');
		$toolbar_rsoc	= thz_get_option('htb/show/c/r','s');
		
		if($toolbar =='show' && ( $toolbar_lsoc =='s' || $toolbar_rsoc =='s' )){
			$add_css .= thz_social_links_print('tsim','tc','thz-socials-toolbar',true);
		}
	}

	if(thz_detect_lateral_header()){
		
		$lateral_soc 	= thz_get_option('lhs','show');
		
		if($lateral_soc =='show'){
			$add_css .= thz_social_links_print('lsim','lc','thz-socials-header-lateral',true);
		}
	}
	
	if($footer_lsoc =='s' || $footer_msoc =='s' || $footer_rsoc =='s'){
		$add_css .= thz_social_links_print('fsim','fc','thz-socials-footer',true);
	}
	
	// logo 
	$add_css .= _thz_logo_css();
	
	// mainmenu css
	$add_css .= _thz_mainmenu_css();
	
	// page blocks positions
	$add_css .= thz_page_block_positions_css();
	
	// hero section css
	$add_css .= _thz_hero_section_css();

	// blog css
	$add_css .= _thz_posts_static();
	
	// page title css
	$add_css .= _thz_page_title_section_css();
	
	// sidebars css
	$add_css .= _thz_sidebars_css();

	// search css
	$add_css .= _thz_search_static();
	
	// consent css
	$add_css .= _thz_cookies_consent_static();
	
	// pagination css
	$add_css .= _thz_pagination_css();	
	
	// navigation css
	$add_css .= _thz_navigation_static();	
	
	// 404 css
	$add_css .= _thz_404_static();

	// widget sections css
	$add_css .= _thz_widgets_generator_css_print();
	
	// footer css
	$add_css .= _thz_footer_css();	
	
	// Woo css
	$add_css .= _thz_woo_static();
	
	// bbPress css
	$add_css .= _thz_bbpress_static();
	
	// BuddyPress css
	$add_css .= _thz_buddypress_static();

	// elements css
	$add_css .= _thz_elements_css();
	
	return $add_css;	
	
}