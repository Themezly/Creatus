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
 * Layouts
 */

function thz_get_page_type_info( $assigned_page = null ,$show_info = false) {
			
	$data =  array();

	
	if ( 'page' == get_option( 'show_on_front' ) && is_front_page() && !is_home()  ) {
		$data['type']     = 'is_front_page';
		$data['sub_type'] = get_post_type();
		$data['id']       = get_queried_object_id();
		$data['slug']	  = 'is_front_page';
		$data['setby']	  = 'is_front_page()';

		if($data['slug'] == $assigned_page || $show_info){			
			return $data;
		}

	}
	

	if ( 'posts' == get_option( 'show_on_front' ) && is_home() && is_front_page()  ) {
		
		
		$data['type']     = 'is_home';
		$data['slug']	  = 'is_home';
		$data['setby']	  = 'is_home()';			

		if($data['slug'] == $assigned_page || $show_info){			
			return $data;
		}
	}
	
		
	if ( 'page' == get_option( 'show_on_front' ) && is_home() && !is_front_page()  ) {
		
		
		$data['type']     = 'is_postspage';
		$data['slug']	  = 'is_postspage';
		$data['setby']	  = 'is_postspage';			

		if($data['slug'] == $assigned_page || $show_info){			
			return $data;
		}
	}

	if ( is_attachment() ) {
		$data['type']     = 'is_attachment';
		$data['slug']	  = 'is_attachment';
		$data['setby']	  = 'is_attachment()';

		if($data['slug'] == $assigned_page || $show_info){			
			return $data;
		}
	}

	if ( is_author() ) {
		$data['type']     = 'is_author';
		$data['slug']	  = 'is_author';
		$data['setby']	  = 'is_author()';

		if($data['slug'] == $assigned_page || $show_info){			
			return $data;
		}
	}
	
	if ( is_category() ) {
		
		$data['type']     = 'tx';
		$data['sub_type'] = $data['type'].'_category';
		$data['id']       = get_queried_object_id();
		$data['slug']	  = $data['sub_type'].'_'.$data['id'] ;
		$data['setby']	  = 'is_category()';

		if($data['slug'] == $assigned_page || $show_info){			
			return $data;
		}
		if($data['sub_type'] == $assigned_page || $show_info){			
			return $data;
		}
		
	}
	
	if ( is_tag() ) {
		
		$data['type']     = 'is_tag';
		$data['slug']	  = 'is_tag';
		$data['setby']	  = 'is_tag()';

		if($data['slug'] == $assigned_page || $show_info){			
			return $data;
		}
	}
	
	if ( is_tax() ) {

		$data['type']     ='tx';
		$data['sub_type'] = $data['type'].'_'.get_queried_object()->taxonomy;
		$data['id']       = get_queried_object_id();
		$data['slug']	  = $data['sub_type'].'_'.$data['id'];
		$data['setby']	  = 'is_tax()';

		if($data['slug'] == $assigned_page || $show_info){			
			return $data;
		}
		if($data['sub_type'] == $assigned_page || $show_info){			
			return $data;
		}

	}
	
	if ( is_archive() && ! is_tax() ) {
		$data['type']     = 'ar';
		$data['sub_type'] = get_post_type();
		$data['slug']	  = $data['type'].'_'.$data['sub_type'];
		$data['setby']	  = 'is_archive()';

		if($data['slug'] == $assigned_page || $show_info){			
			return $data;
		}
	}
	
	if ( function_exists('bp_is_my_profile') && bp_is_my_profile()) {
		$data['type']     = 'is_bp';
		$data['sub_type'] = 'buddy_press';
		$data['slug']	  = 'is_bp';
		$data['setby']	  = 'bp_is_my_profile()';

		if($data['slug'] == $assigned_page || $show_info){			
			return $data;
		}
	}
	
	if ( is_404() ) {
		$data['type']     = 'is_404';
		$data['slug']	  = 'is_404';
		$data['setby']	  = 'is_404()';

		if($data['slug'] == $assigned_page || $show_info){			
			return $data;
		}
	}
	
	if ( is_search() ) {
		$data['type']     = 'is_search';
		$data['slug']	  = 'is_search';
		$data['setby']	  = 'is_search()';

		if($data['slug'] == $assigned_page || $show_info){			
			return $data;
		}
		
	}

	if ( class_exists( 'WooCommerce' )  ) {
		if(	is_shop() ){
			
			$pageid = get_option( 'woocommerce_shop_page_id' );
			
			$data['type']     = 'pt';
			$data['sub_type'] = $data['type'].'_page';
			$data['id']       = $pageid ;
			$data['slug']	  = $data['sub_type'].'_'.$pageid ;	
			$data['setby']	  = 'is_shop()';
			
			if($data['slug'] == $assigned_page || $show_info){			
				return $data;
			}
			
			if($data['sub_type'] == $assigned_page || $show_info){			
				return $data;
			}			
			
		}	
	}

	if ( is_thz_post_type() ){
		
		$data['type']     = 'pt';
		$data['sub_type'] = $data['type'].'_'.get_post_type();
		$data['id']       = get_queried_object_id();
		$data['slug']	  = $data['sub_type'].'_'.$data['id'];	
		$data['setby']	  = 'is_thz_post_type()';	
		
		if($data['slug'] == $assigned_page || $show_info){			
			return $data;
		}
		if($data['sub_type'] == $assigned_page || $show_info){			
			return $data;
		}		
	}
	
}


function is_thz_post_type( $post = null ) {
	
	if( !is_singular() ){
		return false;
	}
	
    $all_post_types = get_post_types();

    if ( empty ( $all_post_types ) ) {
        return false;
	}

    $all_types      = array_keys( $all_post_types );
    $current_post_type = get_post_type( $post );

    if ( ! $current_post_type ) {
        return false;
	}

    return in_array( $current_post_type, $all_types );
}

function thz_current_position(){
	
	
	$custom_layout	= thz_get_option('custom_layout_options/0/l');
	
	if(!empty($custom_layout)){
		
		$this_position = $custom_layout['layout'];
		
	}else{
	
		$default = 	array(
		
			array(
				'page' => 'all',
				'layout' => 'left',
				'leftblock' => 25,
				'contentblock' => 75,
				'rightblock' => 0
			)
		
		);
	
		$pages_layouts	= thz_get_theme_option('content_layout',$default);
		$this_position 	= '';
		
		foreach ($pages_layouts as $wp_page){
			
			if(!is_object($wp_page) && is_array($wp_page)){
				$wp_page = (object)$wp_page;
			}
	
			$pageinfo = thz_get_page_type_info( $wp_page->page );
			$sub_type = isset($pageinfo['sub_type']) ? $pageinfo['sub_type'] : null; 
	
	
			// found by slug , brake loop
			if($wp_page->page == $pageinfo['slug']){
				
				$this_position =  $wp_page->layout;
				
				break;
			}
	
			// found by sub_type
			if($wp_page->page == $sub_type){
				
				$this_position =  $wp_page->layout;
				
				break;
			}
	
			if($wp_page->page == 'all'){
				
				$this_position =  $wp_page->layout;
				
				break;
			}
		}
	}
	
	return $this_position;

}

function thz_get_page_preset(){
	
	
	$custom_layout	= thz_get_option('custom_layout_options/0/l');
	
	if(!empty($custom_layout)){
		
		$this_preset =  (object) $custom_layout;
		
	}else{
	
		$default = 	array(
		
			array(
				'page' => 'all',
				'layout' => 'left',
				'leftblock' => 25,
				'contentblock' => 75,
				'rightblock' => 0
			)
		
		);
		
		$pages_layouts	= thz_get_theme_option('content_layout',$default);
		$this_preset 	= null;
	
	
		foreach ($pages_layouts as $wp_page){
	
			if(!is_object($wp_page) && is_array($wp_page)){
				$wp_page = (object)$wp_page;
			}
	
	
			$pageinfo = thz_get_page_type_info( $wp_page->page );
			$sub_type = isset($pageinfo['sub_type']) ? $pageinfo['sub_type'] : null; 
	
		
	
			// found by slug , brake loop
			if($wp_page->page == $pageinfo['slug']){
				
				$this_preset =  $wp_page;
				
				break;
				
			}
			// found by sub_type
			if($wp_page->page == $sub_type){
				
				$this_preset =  $wp_page;
				
				break;
			}
			
			// no preset for this page use all if exists
			if( $wp_page->page == 'all'){
				
				$this_preset =  $wp_page;
				
				break;
			}
		}
	
	}
	
/* 	global $wp_registered_widgets;
 
    $sidebars_widgets = wp_get_sidebars_widgets();
  
    fw_print($sidebars_widgets);*/
 
	thz_unset_hidden_sidebars($this_preset);
	return $this_preset;
	
}



function thz_unset_hidden_sidebars($this_preset){
	
	// unset hidden sidebars
	if($this_preset->layout == 'left'){
		
		unset($this_preset->rightblock);
	}
	
	if($this_preset->layout == 'right'){
		
		unset($this_preset->leftblock);
	}
	
	if($this_preset->layout == 'full'){
		
		unset($this_preset->rightblock);
		unset($this_preset->leftblock);
	}	

}


function thz_show_left (){
	
	
	if(!is_active_sidebar( 'left' )) {
		 return;
	}
	
	$show_left_array 	= array('left','left_right_content','content_left_right');

	if(in_array(thz_current_position(),$show_left_array)){
		return true;
	}
	

	
}

function thz_show_right (){
	
	if(!is_active_sidebar( 'right' )) {
		return;
	}
	
	$show_right_array 	= array('right','left_content_right','left_right_content','content_left_right');
	
	if(in_array(thz_current_position(),$show_right_array)){
		return true;
	}
	

}

function thz_show_left_content_right (){
	
	if(!is_active_sidebar( 'left' )) {
		 return;
	}
	
	if(thz_current_position() == 'left_content_right'){
		return true;
	}
}

function thz_set_holder(){
	
	$holder = 'holder';
	if(thz_current_position() == 'left' || thz_current_position() == 'left_right_content'){
		
		$holder = 'holder3';
	}
	
	echo $holder;
	
}

function thz_layout_boxed(){
	
    if (thz_get_option('layout_type','full') == 'boxed') {
        return true;
    }	

}


function thz_layout(){
	
    if (thz_layout_boxed()) {
        echo ' thz-layout-boxed thz-site-width';
    }	

}
function thz_menu_container($poz){

	if (thz_layout_boxed() && $poz == 'out') {
		 echo 'thz-container';
	}
	
	if (thz_layout_boxed() && $poz == 'in') {
		 echo ' false-container';
	}
	
	
	if (!thz_layout_boxed() && $poz == 'out') {
		 echo 'outside-container';
	}
	
	if (!thz_layout_boxed() && $poz == 'in') {
		 echo ' thz-container';
	}
}

/**
 * Check if sidebar is active. 
 * Return false on page-builder
 * @return bool
 */
function thz_is_sidebar_active( $side ){
	
	if ( is_singular() && 
		 is_page_template( array(
			'template-parts/page-builder.php',
			'template-parts/page-blank.php',
		) )
	) {
		
		return false;
		
	}
	
	return is_active_sidebar( $side );
	
}


/**
 * Generate layout css based on left/right sidebar position
 * @return string $layout_css
 */
function _thz_layout_css(){

	$page_preset	= thz_get_page_preset();
	$left_width 	= isset($page_preset->leftblock) ? $page_preset->leftblock: 0;
	$content_width 	= isset($page_preset->contentblock) ? $page_preset->contentblock : 0;
	$right_width 	= isset($page_preset->rightblock) ? $page_preset->rightblock : 0;
	
	$layout_css 	='#contentblock{width:100%;}';
	
	if('full' == $page_preset->layout){
	
		$layout_css ='#contentblock{width:'.thz_property_unit($content_width,'%').';float:none;margin-left:auto;margin-right:auto;}';
		
		return $layout_css;
	}

	if ( thz_is_sidebar_active( 'left' ) && !thz_is_sidebar_active( 'right' )) {
	
		$layout_css  ='#contentblock{width:'.thz_property_unit(($content_width + $right_width),'%').';}';
		$layout_css .='#leftblock{width:'.thz_property_unit($left_width,'%').';}';
	}
	
	if ( thz_is_sidebar_active( 'right' ) && !thz_is_sidebar_active( 'left' ) ) {
		
		$layout_css  ='#contentblock{width:'.thz_property_unit(($content_width + $left_width),'%').';}';
		$layout_css .='#rightblock{width:'.thz_property_unit($right_width,'%').';}';

	}
	
	if ( thz_is_sidebar_active( 'left' ) && thz_is_sidebar_active( 'right' )) {
			 
		$layout_css  ='#contentblock{width:'.thz_property_unit(($content_width),'%').';}';
		$layout_css .='#leftblock{width:'.thz_property_unit($left_width,'%').';}';
		$layout_css .='#rightblock{width:'.thz_property_unit($right_width,'%').';}';
		
	}

	return $layout_css;		

}


function thz_has_sidebar(){

	if ( thz_show_left() || thz_show_right() || thz_show_left_content_right() ){
		
		return true;
		
	}

}

function thz_load_sidebar($sidebar){
	
	if($sidebar == 'left'){
		
		dynamic_sidebar( 'left' );
		
	}
	
	if($sidebar == 'right'){
		
		dynamic_sidebar( 'right' );
	}
	
}