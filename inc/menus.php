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
 * Return main menu
 */
 
if ( ! function_exists( 'thz_wp_nav_menu' ) ){
	
	function thz_wp_nav_menu($menutype = false){
	 
		$woommini 		= thz_get_option('tm_elmx/mc','only');
		$woommini 		= $woommini =='only' ? thz_has_woo() ? 'show' :'hide' : $woommini;
		$searchicon		= thz_get_option('tm_elmx/si','show');
		$page_menu		= thz_get_post_option('page_menu',array());
		$page_menu		= isset( $page_menu[0] ) ? $page_menu[0] :'';
		$tm_anim		= thz_get_option('tm_anim','fade');
		$add_class 		= ' thz-mega-menu';
		$show_soc		= thz_get_option('tm_elmx/so','show');
		$socials		= ('split' == $menutype || 'centered' == $menutype) && 'show' == $show_soc ? thz_socials_in_menu(true) :'';
		$nav_class 		='thz-nav thz-tablet-hidden thz-mobile-hidden';
		
		if(thz_detect_lateral_header()){
			
			$add_class	= ' thz-acc-menu closeother';
			
		}else{
			
			$row_contained	= thz_get_option('tm_mr_co');
			$add_class  	.=' thz-menu-anim-'.$tm_anim.' thz-mega-'.$row_contained;
		}
		
		$items_wrap = '<nav id="thz-nav" class="'.$nav_class.'"'.thz_sdata('nav',false).'>';
		$items_wrap .= $socials;
		$items_wrap .= '<ul class="%2$s">%3$s</ul>';
		$items_wrap .= thz_secondary_menu();
		$items_wrap .= '</nav>';
		
		$defaults = array(
			'theme_location'  => 'mainmenu',
			'menu'            => $page_menu,
			'container'       => '',// trick for sdata untill add attribute is fixed https://core.trac.wordpress.org/ticket/35127
			'container_class' => 'thz-nav thz-tablet-hidden thz-mobile-hidden',
			'container_id'    => 'thz-nav',
			'menu_class'      => 'thz-menu'.$add_class,
			'menu_id'         => '',
			'echo'            => true,
			'fallback_cb'     => 'wp_page_menu',
			'before'          => '',
			'after'           => '',
			'link_before'     => '',
			'depth'           => 0,
			'items_wrap' 	  => $items_wrap
		);
		
		if( has_nav_menu( 'mainmenu' ) ) {
			
			wp_nav_menu( $defaults );
			
		} else {


			$no_menu  ='<nav id="thz-nav" class="thz-nav thz-assign-nav thz-tablet-hidden thz-mobile-hidden"'.thz_sdata('nav',false).'>';
			$no_menu .='<ul class="thz-menu">';
			$no_menu .= '<li class="menu-item lifirst level0 active">';
			$no_menu .= '<span class="linkholder">';
			$no_menu .= '<a class="itemlink activepath" href="'.esc_url(admin_url('nav-menus.php')).'">';
			$no_menu .= esc_html__('Assign Menu','creatus');
			$no_menu .= '</a>';
			$no_menu .= '</span>';
			$no_menu .= '</li>';			
			$no_menu .='</ul>';
			$no_menu .='</nav>';
			
			echo $no_menu;
		}
	}
}


 /**
 * Return mobile menu
 */
if ( ! function_exists( 'thz_mobile_menu' ) ){
	
	function thz_mobile_menu(){
		
		$page_menu		= thz_get_post_option('page_menu',array());
		$page_menu		= isset( $page_menu[0] ) ? $page_menu[0] :'';	
		
		$nav_class ='thz-nav-mobile thz-desktop-hidden';
		
		$items_wrap = '<nav id="thz-nav-mobile" class="'.$nav_class.'"'.thz_sdata('nav',false).'>';
		$items_wrap .= '<ul class="%2$s">%3$s'.thz_secondary_menu_mobile().'</ul>';
		$items_wrap .= '</nav>';
		
		$defaults = array(
			'theme_location'  => 'mainmenu',
			'menu'            => $page_menu,
			'container'       => '',// trick for sdata untill add attribute is fixed https://core.trac.wordpress.org/ticket/35127
			'container_class' => 'thz-nav-mobile thz-desktop-hidden',
			'container_id'    => 'thz-nav-mobile',
			'menu_class'      => 'thz-mobile-menu closeother',
			'menu_id'         => '',
			'echo'            => true,
			'fallback_cb'     => 'wp_page_menu',
			'before'          => '',
			'after'           => '',
			'link_before'     => '',
			'depth'           => 0,
			'items_wrap' 	  => $items_wrap,
			
		);	
		
		if( has_nav_menu( 'mainmenu' ) ) {
			
			wp_nav_menu( $defaults );
			
		} else {

			$no_menu  ='<nav id="thz-nav" class="thz-nav-mobile thz-assign-mobile thz-desktop-hidden"'.thz_sdata('nav',false).'>';
			$no_menu .='<ul class="thz-mobile-menu">';
			$no_menu .= '<li class="menu-item lifirst level0 active">';
			$no_menu .= '<a class="itemlink active" href="'.esc_url ( admin_url('nav-menus.php') ).'"'.thz_sdata('url',false).'>';
			$no_menu .= esc_html__('Assign Menu','creatus');
			$no_menu .= '</a>';
			$no_menu .= '</li>';			
			$no_menu .='</ul>';
			$no_menu .='</nav>';
			
			echo $no_menu;
		}
	}

}



 /**
 * Return footer menu
 */
if ( ! function_exists( 'thz_footer_menu' ) ){
	
	function thz_footer_menu(){
		
		$defaults = array(
			'theme_location'  => 'footermenu',
			'menu'            => '',
			'container'       => '',// trick for sdata untill add attribute is fixed https://core.trac.wordpress.org/ticket/35127
			'container_class' => 'thz-nav-footer',
			'container_id'    => 'thz-nav-footer',
			'menu_class'      => 'thz-footer-menu',
			'menu_id'         => '',
			'echo'            => false,
			'fallback_cb'     => 'wp_page_menu',
			'before'          => '',
			'after'           => '',
			'link_before'     => '',
			'depth'           => 1,
			'items_wrap' 	  => '<div id="thz-nav-footer" class="thz-nav-footer"'.thz_sdata('nav',false).'><ul class="%2$s">%3$s</ul></div>',
			
		);	
		
		if( has_nav_menu( 'footermenu' ) ) {
			
			return wp_nav_menu( $defaults );
			
		} else {

			$no_menu  ='<div id="thz-nav-footer" class="thz-nav-footer thz-assign-footer"'.thz_sdata('nav',false).'>';
			$no_menu .= '<li class="menu-item lifirst">';
			$no_menu .= '<a class="active" href="'.esc_url ( admin_url('nav-menus.php') ).'"'.thz_sdata('url',false).'>';
			$no_menu .= esc_html__('Assign Menu','creatus');
			$no_menu .= '</a>';
			$no_menu .='</li>';
			$no_menu .='</div>';
			
			return $no_menu;
		}
	}

}

 /**
 * Return toolbar menu
 */
if ( ! function_exists( 'thz_toolbar_menu' ) ){
	
	function thz_toolbar_menu(){
		
		$nav_class ='thz-toolbar-nav';
		$defaults = array(
		
			'theme_location'  => 'toolbar',
			'menu'            => '',
			'container'       => '',// trick for sdata untill add attribute is fixed https://core.trac.wordpress.org/ticket/35127
			'container_class' => 'thz-toolbar-nav',
			'container_id'    => 'thz-toolbar-nav',
			'menu_class'      => 'thz-toolbar-menu',
			'menu_id'         => '',
			'echo'            => true,
			'fallback_cb'     => 'wp_page_menu',
			'before'          => '',
			'after'           => '',
			'link_before'     => '',
			'depth'           => 2,
			'items_wrap' 	  => '<nav id="thz-toolbar-nav" class="'.$nav_class.'"'.thz_sdata('nav',false).'><ul class="%2$s">%3$s</ul></nav>'
			
		);
		
		
		if( has_nav_menu( 'toolbar' ) ) {
			
			wp_nav_menu( $defaults );
			
		} else {

			$no_menu  ='<nav id="thz-toolbar-nav" class="thz-toolbar-nav thz-assign-toolbar"'.thz_sdata('nav',false).'>';
			$no_menu .='<ul class="thz-toolbar-menu">';
			$no_menu .= '<li class="menu-item lifirst">';
			$no_menu .= '<a class="itemlink active" href="'.esc_url ( admin_url('nav-menus.php') ).'"'.thz_sdata('url',false).'>';
			$no_menu .= esc_html__('Assign Menu','creatus');
			$no_menu .= '</a>';
			$no_menu .= '</li>';			
			$no_menu .='</ul>';
			$no_menu .='</nav>';
			
			echo $no_menu;
		}
	}

}


if ( ! function_exists( 'thz_socials_in_menu' ) ){
	
	function thz_socials_in_menu($wrapper = true){
		
		$socials_links	= thz_get_option('thz_sl',array());
		$socials_menu	= '';
		
		if(empty($socials_links)){
			return;
		}
		
		$socials_menu .= $wrapper ? '<ul class="thz-menu thz-secondary-menu thz-social-icons-menu">':'';
	
		foreach ($socials_links as $social_link){
			
			if('hide' == $social_link['showin']['m']){
				continue;
			}
			
			$li_class = ' thz-sim-'.esc_attr(str_replace(' ','-',$social_link['icon']));
			$socials_menu .= '<li class="menu-item thz-menu-addon thz-menu-social level0'.$li_class.'">';
			$socials_menu .= '<span class="linkholder child">';
			$socials_menu .= '<a href="'.esc_url($social_link['link']).'" target="_blank" class="thz-menu-social-link itemlink">';
			$socials_menu .= '<i class="'.esc_attr($social_link['icon']).'"></i>';
			$socials_menu .= '</a>';
			$socials_menu .= '</span>';
			$socials_menu .= '</li>';					
			
		}
		
		$socials_menu .= $wrapper ? '</ul>' : '';
		
		
		
		if($socials_menu !=''){
			return 	$socials_menu;
		}
				
	}
	
	
}





 /**
 * Return secondary menu items
 */
if ( ! function_exists( 'thz_secondary_menu_items' ) ){
	
	function thz_secondary_menu_items(){
	
		$secondary_menu		= thz_get_post_option('secondary_menu',array());
		$secondary_menu		= isset( $secondary_menu[0] ) ? $secondary_menu[0] :'';
		
		$defaults = array(
			'theme_location'  => 'secondary',
			'menu'            => $secondary_menu,
			'container'       => '',
			'container_class' => 'thz-nav thz-tablet-hidden thz-mobile-hidden',
			'container_id'    => 'thz-nav',
			'menu_class'      => 'thz-menu thz-secondary-menu',
			'menu_id'         => '',
			'echo'            => false,
			'fallback_cb'     => 'wp_page_menu',
			'before'          => '',
			'after'           => '',
			'link_before'     => '',
			'depth'           => 0,
			'items_wrap' 	  => '%3$s'
		);
		
		if( has_nav_menu( 'secondary' ) ) {
			
			return wp_nav_menu( $defaults );
			
		}
	}

}


 /**
 * Return secondary menu
 */
if ( ! function_exists( 'thz_secondary_menu' ) ){
	
	function thz_secondary_menu(){
		
	
		$woommini 		= thz_get_option('tm_elmx/mc','only');
		$woommini 		= $woommini =='only' ? thz_has_woo() ? 'show' :'hide' : $woommini;
		$searchicon		= thz_get_option('tm_elmx/si','show');
		$socials_links	= thz_get_option('thz_sl',array());
		$socials		= empty($socials_links) ? 'hide' : thz_get_option('tm_elmx/so','show');
		$headers  		= thz_get_option('headers/picked','inline');
		$secondary_il	= thz_get_option('tm_elmx/il','before');
		$tm_anim		= thz_get_option('tm_anim','fade');
		$secondary_menu	= '';	
		$add_class 		= '';
		
		if(thz_detect_lateral_header()){
			$add_class		= ' thz-acc-menu closeother';
		}else{
			$add_class  .=' thz-menu-anim-'.$tm_anim;
		}
		
		if( 'hide' != $secondary_il  || 'show' == $socials || 'show' == $searchicon || ('show' == $woommini && class_exists( 'WooCommerce' ) )){
			
			$secondary_menu .='<ul class="thz-menu thz-secondary-menu'.$add_class.'">';
			
			// secondary items before
			if( 'before' == $secondary_il ){
				$secondary_menu .= thz_secondary_menu_items();
			}
			
			// socials 
			if ( 'show' == $socials && ('split' != $headers && 'centered' != $headers)){
				
				$secondary_menu .= thz_socials_in_menu(false);
				
			}
			
			// search
			if ( 'show' == $searchicon ){
				
				$secondary_menu .= '<li class="menu-item thz-menu-addon thz-menu-search level0">';
				$secondary_menu .= '<span class="linkholder child">';
				$secondary_menu .= '<a class="thz-open-search itemlink" href="#">';
				$secondary_menu .= '<i class="thzicon thzicon-search3"></i>';
				$secondary_menu .= '</a>';
				$secondary_menu .= '</span>';
				$secondary_menu .= '</li>';
			}
			
			// woo cart
			if ( 'show' == $woommini && class_exists( 'WooCommerce' ) ){
			
				global $woocommerce;
				
				$nitems 	= $woocommerce->cart->cart_contents_count;
				$cart_url 	= wc_get_cart_url();
				$cart_icon	= thz_get_option('wooicons/mc','thzicon thzicon-shopping-cart2');
				$double		= $nitems > 9 ? ' thz-mini-double' :' thz-mini-single'; 
				$has_items	= $nitems > 0 ? ' thz-mini-has-items'.$double :' thz-mini-no-items'.$double;
				
				$secondary_menu .= '<li class="menu-item menu-item-has-children thz-menu-addon has-children thz-menu-woo-cart level0'.$has_items.'">';
				$secondary_menu .= '<span class="linkholder child">';
				$secondary_menu .= '<a class="itemlink" href="'.esc_url($cart_url).'"'.thz_sdata('url',false).'>';
				$secondary_menu .= '<i class="thz-woo-cart-icon '.$cart_icon.'">';
				$secondary_menu .= '<span class="thz-woo-cart-badge'.$has_items.'">';
				$secondary_menu .= '<span>';
				$secondary_menu .= $nitems;
				$secondary_menu .= '</span>';
				$secondary_menu .= '</span>';
				$secondary_menu .= '</i>';
				$secondary_menu .= '</a>';
				$secondary_menu .= '</span>';
				$secondary_menu .= '<div class="ulholder notulgroup level1">';
				$secondary_menu .= '<ul class="sub-menu dropdown notulgroup level1">';
				$secondary_menu .= '<li class="menu-item lilast">';
				$secondary_menu .= '<div class="thz-menu-addon-holder thz-menu-woo-cart-holder widget_shopping_cart">';
				$secondary_menu .= '<div class="widget_shopping_cart_content">';
				$secondary_menu .= thz_get_woo_cart_items();
				$secondary_menu .= '</div>';
				$secondary_menu .= '</div>';
				$secondary_menu .= '</li>';
				$secondary_menu .= '</ul>';
				$secondary_menu .= '</div>';
				$secondary_menu .= '</li>';
				
			}
			
			
			// secondary items after
			if( 'after' == $secondary_il ){
				$secondary_menu .=  thz_secondary_menu_items();
			}
			
			$secondary_menu .='</ul>';
		}
		
		
		if($secondary_menu !=''){
			return 	$secondary_menu;
		}
		
	}
}

 /**
 * Get woo cart items
 */
function thz_get_woo_cart_items(){
	
  	ob_start();
    wc_get_template( 'cart/mini-cart.php', array('list_class' => ''));
    return ob_get_clean();
	
}


 /**
 * Return mobile secondary menu
 */
 
if ( ! function_exists( 'thz_secondary_menu_mobile' ) ){
	
	function thz_secondary_menu_mobile(){
		
		$mobilewoo 		= thz_get_option('mm_elmx/mc','show');
		$mobilesearch	= thz_get_option('mm_elmx/si','show');
		$socials_links	= thz_get_theme_option('thz_sl',array());
		$socials		= empty($socials_links) ? 'hide' : thz_get_option('mm_elmx/so','show');
		$secondary_il	= thz_get_option('mm_elmx','before');
		$secondary_menu	= '';
	
		if( 'hide' != $secondary_il || 'show' == $socials || 'show' == $mobilesearch || ('show' == $mobilewoo && class_exists( 'WooCommerce' ) )){
			
			// secondary items before
			if( 'before' == $secondary_il ){
				$secondary_menu .= thz_secondary_menu_items();
			}
						
			// socials 
			if ( 'show' == $socials ){
				
				foreach ($socials_links as $social_link){

					if('hide' == $social_link['showin']['m']){
						continue;
					}
										
					$secondary_menu .= '<li>';
					$secondary_menu .= '<a href="'.esc_url($social_link['link']).'" target="_blank" class="thz-mobile-menu-social-link itemlink">';
					$secondary_menu .= '<i class="'.esc_attr($social_link['icon']).'"></i>';
					$secondary_menu .= '</a>';
					$secondary_menu .= '</li>';					
					
				}
				
			}
			// search
			if ( 'show' == $mobilesearch ){
			
				$secondary_menu .= '<li>';
				$secondary_menu .= '<a class="thz-open-search itemlink" href="#">';
				$secondary_menu .= '<i class="thzicon thzicon-search3"></i>';
				$secondary_menu .= '</a>';
				$secondary_menu .= '</li>';
			}
			
			// woo cart
			if ( 'show' == $mobilewoo && class_exists( 'WooCommerce' ) ){
			
				global $woocommerce;
				$cart_url 	= wc_get_cart_url();
				$cart_icon	= thz_get_option('wooicons/mc','thzicon thzicon-shopping-cart2');
				$secondary_menu .= '<li>';
				$secondary_menu .= '<a class="itemlink" href="'.esc_url($cart_url).'">';
				$secondary_menu .= '<i class="'.$cart_icon.'"></i>';
				$secondary_menu .= '</a>';
				$secondary_menu .= '</li>';
				
			}
			
			// secondary items after
			if( 'after' == $secondary_il ){
				$secondary_menu .= thz_secondary_menu_items();
			}
		}
		
		if($secondary_menu !=''){
			return 	$secondary_menu;
		}
		
	}
}

/**
 * Register theme menus
 */
register_nav_menus( array(
 
	'mainmenu'   	=> esc_html__( 'Main menu', 'creatus' ),
	'secondary'   	=> esc_html__( 'Secondary menu', 'creatus' ),
	'toolbar' 		=> esc_html__( 'Header toolbar menu', 'creatus' ),
	'footermenu'   	=> esc_html__( 'Footer menu', 'creatus' ),
	
	)
	
);


/**
 * Use custom walkers
 */
function _thz_filter_menu_walkers($args){
	
	
	$header_type = thz_get_option('headers/picked','inline');
	$megaon = true;
	if(thz_detect_lateral_header()){
		$megaon = false;
	}


	if($args['container_id'] =='thz-nav'){
		
		if(class_exists('FW_Walker_Mainmenu_Menu') && $megaon){
			
			$args['walker'] = new FW_Walker_Mainmenu_Menu();
			
		}else{
			
			// in case megamenu is disabled
			$args['walker'] = new Thz_Mainmenu_Walker();
			
		}
		
	}else{
		
		$args['walker'] = new Thz_Simple_Menu_Walker();
	}
	
	return $args;
}

add_filter('wp_nav_menu_args', '_thz_filter_menu_walkers', 100);



/**
 * Add first and last class to li's
 */
function _thz_li_first_last($items) {
	
	if(empty($items)) {
		return;
	}
	$header_type = thz_get_option('headers/picked','inline');
	$override = thz_detect_lateral_header();

	foreach($items as $k => $v){
		$parent[$v->menu_item_parent][] = $v;
	}
	
	foreach($parent as $k => $v){

		$v[0]->classes[] = 'lifirst';
		$v[count($v)-1]->classes[] = 'lilast';
	}
	
	return $items;
}
add_filter('wp_nav_menu_objects', '_thz_li_first_last');




/**
 *	Adjust top menu to fit specific headers
 */
function _thz_filter_adjust_menu($menu, $args) {
	
	if( 'mainmenu' != $args->theme_location ){
		return $menu;
	}
	
	$headers  = thz_get_option('headers/picked','inline');
	$menu_pos = thz_get_option('htmp','right');

	if('split' == $headers){
		
		// split logo
		preg_match_all('/<li.*?class=".*?level0.*?>/iU', $menu, $matches);
		
		$countlevel = count($matches[0]);
		$getindex = round( $countlevel / 2);
		
		if(isset($matches[0][$getindex])){
			$add_logo = '<li class="menu-item lihaslogo level0">';
			$add_logo .= thz_logo_print();
			$add_logo .='</li>';
			$add_logo .= $matches[0][$getindex];
			
			$menu = str_replace($matches[0][$getindex],$add_logo,$menu);
		}
		
	}
	
	// remove pesky inline-block space between items
	if('centered' == $headers || 'split' == $headers 
		|| ('inline' == $headers && 'center' == $menu_pos) 
		|| ('transparent' == $headers && 'center' == $menu_pos)){
		$menu = str_replace("\n", '',$menu);
	}
	
	return $menu;

}
if ( !is_admin() ) {
	add_filter('wp_nav_menu_items','_thz_filter_adjust_menu', 10, 2);
}


/**
 *	Adjust menu item visibility
 */
function thz_menu_item_visibility( $items, $menu, $args ) {
	
	if( ! function_exists('fw_ext_mega_menu_get_db_item_option')){
		return $items;
	}
	
	$user 			= wp_get_current_user();
	$user_roles		= $user->roles;
	$hide_children 	= array();
	
	foreach( $items as $key => $item ) {
		
		$item_parent 	= get_post_meta( $item->ID, '_menu_item_menu_item_parent', true );
		$item_options	= fw_ext_mega_menu_get_db_item_option ( $item->ID );
		$item_type 		= thz_akg ( 'type',$item_options,'default' );
		$visibleto 		= thz_akg ( $item_type.'/visibleto',$item_options,array() ) ;
		
		if( in_array('loggedout',$visibleto) && !$user->exists() ){
			
			$user_roles[] ='loggedout';
		}
		
		if( in_array('loggedin',$visibleto) && $user->exists() ){
			
			$user_roles[] ='loggedin';
		}		
		
		if( (!empty($visibleto)  && !array_intersect(array_keys( $visibleto ), $user_roles )) || isset( $hide_children[$item_parent] )  ){
			
			unset( $items[$key] );
			$hide_children[$item->ID] = '1';
		}

	}

	return $items;
}

if ( !is_admin() ) {
	add_filter( 'wp_get_nav_menu_items', 'thz_menu_item_visibility', 10, 3 );
}



// use thz-icon option
function _thz_filter_menu_item_icon($icon) {
	
	$icon['type'] = 'thz-icon';
	$icon['label']  = esc_html__('Select icon', 'creatus');
	
	return $icon;
}
	
add_filter( 'fw:ext:megamenu:icon-option', '_thz_filter_menu_item_icon');	

// add Structured data to menu links
function add_menu_attributes( $atts, $item, $args ) {

  $atts['itemprop'] = 'url';
 
  return $atts;
}

if( !is_admin() && thz_get_theme_option_early('sdata','active') == 'active'){
	add_filter( 'nav_menu_link_attributes', 'add_menu_attributes', 10, 3 );
}
