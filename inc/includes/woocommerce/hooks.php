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

if( !is_admin() ){ 
	/**
	 *	Dont clog the site with woocommerce stuff unless we are on it
	 *  @internal
	 */
			
	function _thz_action_clean_woo_head() {
		
		if ( class_exists( 'WooCommerce' ) ) {
			
			if ( function_exists( 'is_woocommerce' ) ) {

				//dequeue scripts and styles
				if ( !is_woocommerce() && !is_cart() && !is_checkout() 
				&& !is_account_page()
				&& !thz_has_woo_shortcode()
				&& !is_wc_endpoint_url('order-pay')
				&& !is_wc_endpoint_url('order-received')
				&& !is_wc_endpoint_url('view-order')
				&& !is_wc_endpoint_url('edit-account')
				&& !is_wc_endpoint_url('edit-address')
				&& !is_wc_endpoint_url('lost-password')
				&& !is_wc_endpoint_url('customer-logout')
				&& !is_wc_endpoint_url('add-payment-method')) {
					
					wp_dequeue_style( 'woocommerce_frontend_styles' );
					wp_dequeue_style( 'woocommerce-general');
					wp_dequeue_style( 'woocommerce-layout' );
					wp_dequeue_style( 'woocommerce-smallscreen' );
					wp_dequeue_style( 'woocommerce_fancybox_styles' );
					wp_dequeue_style( 'woocommerce_chosen_styles' );
					wp_dequeue_style( 'woocommerce_prettyPhoto_css' );
					wp_dequeue_style( 'select2' );
					wp_dequeue_script( 'wc-add-payment-method' );
					wp_dequeue_script( 'wc-lost-password' );
					wp_dequeue_script( 'wc_price_slider' );
					wp_dequeue_script( 'wc-single-product' );
					wp_dequeue_script( 'wc-add-to-cart' );
					wp_dequeue_script( 'wc-cart-fragments' );
					wp_dequeue_script( 'wc-credit-card-form' );
					wp_dequeue_script( 'wc-checkout' );
					wp_dequeue_script( 'wc-add-to-cart-variation' );
					wp_dequeue_script( 'wc-single-product' );
					wp_dequeue_script( 'wc-cart' );
					wp_dequeue_script( 'wc-chosen' );
					wp_dequeue_script( 'woocommerce' );
					wp_dequeue_script( 'prettyPhoto' );
					wp_dequeue_script( 'prettyPhoto-init' );
					wp_dequeue_script( 'jquery-blockui' );
					wp_dequeue_script( 'jquery-placeholder' );
					wp_dequeue_script( 'jquery-payment' );
					wp_dequeue_script( 'fancybox' );
					wp_dequeue_script( 'jqueryui' );
					
				}else{
					
					wp_dequeue_style( 'woocommerce-general' );
					wp_dequeue_style( 'woocommerce-layout' );
					wp_dequeue_style( 'woocommerce-smallscreen' );
					wp_dequeue_script( 'prettyPhoto' );
					wp_dequeue_script( 'prettyPhoto-init' );
					
					
					wp_enqueue_style( THEME_NAME. '-woocommerce' );	
									
				}
			}
		}
		

	}
	add_action( 'wp_enqueue_scripts', '_thz_action_clean_woo_head' );
	
	/**
	 * Remove Woo generator tag
	 */	
	function _thz_remove_woocommerce_generator_tag(){
	   remove_action('get_the_generator_html','wc_generator_tag', 10,2);
	   remove_action('get_the_generator_xhtml','wc_generator_tag', 10,2); 
	}
	add_action('get_header','_thz_remove_woocommerce_generator_tag');	
	
	/**
	 * Number of WooCommerce product columns
	 *
	 * @see wc_get_default_products_per_row()
	 *
	 * @return int
	 */
	
	if (!function_exists('_thz_filter_woo_loop_columns')) {
		function _thz_filter_woo_loop_columns() {
			return thz_get_woo_columns();
		}
	}
	add_filter('loop_shop_columns', '_thz_filter_woo_loop_columns');
	
	
	/**
	 * Number of WooCommerce products per page
	 *
	 * @see WC_Query::product_query()
	 *
	 * @return int
	 */
	function _thz_filter_woo_per_page(){
		return thz_get_woo_items_per_page();
	}
	add_filter( 'loop_shop_per_page','_thz_filter_woo_per_page', 20 );

	/**
	 * Set number of related products to display in product page
	 *
	 * @see woocommerce_output_related_products()
	 * @param array $args - query arguments
	 *
	 * @return array
	 */
	function _thz_filter_woo_related_per_page( $args ){
		$args[ 'posts_per_page' ] = thz_get_woo_items_per_page();
		return $args;
	}
	add_filter( 'woocommerce_output_related_products_args', '_thz_filter_woo_related_per_page' );

	/**
	 * Woo loop item view
	 */
	 
	function _thz_action_woo_loop_item(){
		
		global $product, $woocommerce, $woocommerce_loop;
					
		$image_id			= get_post_thumbnail_id();
		$obgtype			= thz_ov_ef('.thz-woo-item','background/type');
		$oeffect 			= thz_ov_ef('.thz-woo-item','oeffect'); 
		$oduration			= thz_ov_ef('.thz-woo-item','oduration');
		$ieffect			= thz_ov_ef('.thz-woo-item','ieffect'); 
		$iduration			= thz_ov_ef('.thz-woo-item','iduration'); 
		$iceffect			= thz_ov_ef('.thz-woo-item','iceffect');
		$icduration			= thz_ov_ef('.thz-woo-item','icduration');
		$prefix				= !empty(thz_get_option('woo_cat/0',array())) ? 'woo_cat/0/' : '';
		$btns_show			= thz_get_option($prefix.'woopst/btns_show','both');
		$rating_show 		= thz_get_option($prefix.'woopst/wooprs/picked','show'); 
		$imgs_opt 			= 'woopst/imgs';
		$check_custom 		= false;
		
		if(isset($woocommerce_loop['name'])){
			
			if($woocommerce_loop['name'] =='related'){
				$imgs_opt = 'woorelgrid/imgs';
				$check_custom = true;
			}
			
			if($woocommerce_loop['name'] =='up-sells'){
				$imgs_opt = 'wooupgrid/imgs';
				$check_custom = true;
			}
			
			if($woocommerce_loop['name'] =='cross-sells'){
				$imgs_opt = 'woocrgrid/imgs';
				
			}
			
		}
		/*
			must use fw_get_db_post_option here to get the current post 
			custom options. If we use thz_get_post_option it gets the 
			related item options instead. Cheking for FW for defaults
		
		*/
		$custom_opt = thz_fw_active() && $check_custom ? fw_get_db_post_option(get_queried_object_id(),'custom_post_options/0',null) : null;
		
		if($custom_opt){
			
			$image_size = fw_get_db_post_option(get_queried_object_id(), 'custom_post_options/0/'.$imgs_opt ,'thz-img-medium' );
			
		}else{
			
			$image_size = thz_get_option( $prefix.$imgs_opt ,'thz-img-medium' );
			
		}
		
		$thumb 				= wp_get_attachment_image_src($image_id,$image_size); 
		$product_image		= $thumb ? $thumb[0] : thz_img_placeholder();
		$media_height 		= thz_get_option($prefix.'woopst/imgh/picked','auto'); 
		$style 				= '';
		
		if($media_height == 'custom'){
			
			$img_ratio		= 'thz-media-custom-size';
			$img_mask		= ' thz-hover-img-mask';
			
		}else if ($media_height == 'auto'){
			
			$img_ratio		= 'thz-media-height-auto';
			$img_mask		= '';
			
		}else{
			$img_ratio		= 'thz-aspect '.$media_height;
			$img_mask		= ' thz-hover-img-mask';
		}
		
		
		$hover_classes 	= 'thz-hover thz-hover-bg-'.$obgtype.' '.$oeffect.' '.$iduration.' '.$ieffect.''.$img_mask;
		$icons_classes 	= 'thz-hover-icons '.$iceffect.' '.$icduration.'';
		$cartajax 	   	= thz_woo_product_type( $product ) == 'simple' ? ' ajax_add_to_cart':'';
		$item_badge		= '';
		$label_space 	= $btns_show == 'both' ? ' thz-ml-10' : '';
		
		
		
		switch ( thz_woo_product_type( $product ) ) {
			case "variable" :
				$link  = apply_filters( 'variable_add_to_cart_url', get_permalink( thz_woo_get_id( $product ) ) );
				$label  = apply_filters( 'variable_add_to_cart_text', esc_html__( 'Select Options', 'creatus' ) );
				$icon_class = 'thzicon thzicon-plus';
				break;
			case "grouped" :
				$link  = apply_filters( 'grouped_add_to_cart_url', get_permalink( thz_woo_get_id( $product ) ) );
				$label  = apply_filters( 'grouped_add_to_cart_text', esc_html__( 'View Options', 'creatus' ) );
				$icon_class = 'thzicon thzicon-search3';
				break;
			case "external" :
				$link  = apply_filters( 'external_add_to_cart_url', get_permalink( thz_woo_get_id( $product ) ) );
				$label  = apply_filters( 'external_add_to_cart_text', esc_html__( 'More Info', 'creatus' ) );
				$icon_class = 'thzicon thzicon-circle-plus';
				break;
			default :
				$link  = apply_filters( 'add_to_cart_url', esc_url( $product->add_to_cart_url() ) );
				$label  = apply_filters( 'add_to_cart_text', esc_html__( 'Add to Cart', 'creatus' ) );
				$icon_class = thz_get_option('wooicons/mc','thzicon thzicon-shopping-cart2');
				break;
		}
		
		
		if(thz_woo_in_cart(thz_woo_get_id( $product ))){
		
			$label = esc_html__( 'View cart', 'creatus' );
		
		}
		if ( !$product->is_in_stock() ) {
			$label = esc_html__( 'More Info', 'creatus' );
		}
		
		$tip = $btns_show =='icon' ? ' title="'.$label.'"' : '';
		$tip_class = $btns_show =='icon' ? ' thz-tips' : '';
	
		if ( thz_woo_product_type( $product ) && !thz_woo_in_cart(thz_woo_get_id( $product ))) {
			
			$eclass = 'thz-woo-item-add-to-cart thz-woo-item-cart-buttons add_to_cart_button product_type_'.thz_woo_product_type( $product ).$cartajax.'';
			
			$add_to_cart ='<a href="'. $link .'" rel="nofollow" data-product_id="'.thz_woo_get_id( $product ).'"';
			$add_to_cart .= ' class="'.thz_sanitize_class( $eclass ).'">';
			if($btns_show =='icon' || $btns_show =='both'){
				$add_to_cart .='<i class="'.$icon_class.'"></i>';
			}
			if($btns_show =='label' || $btns_show =='both'){
				$add_to_cart .= '<span class="thz-woo-item-cart-label'.$label_space.'">';
				$add_to_cart .= $label;
				$add_to_cart .= '</span>';
			}
			$add_to_cart .='</a>';
			
		} else {
			$add_to_cart = '';
		}
		
		if ( !$product->is_in_stock() ) {
			
			$item_badge	.= '<span class="thz-woo-item-badge thz-woo-item-out-of-stock">';
			$item_badge	.= esc_html__( 'Out of stock!', 'creatus' );
			$item_badge	.= '</span>';

			$link 		  = apply_filters( 'out_of_stock_add_to_cart_url', get_permalink( thz_woo_get_id( $product ) ) );
			$add_to_cart ='<a href="'. $link .'" rel="nofollow"';
			$add_to_cart .=' class="thz-woo-item-add-to-cart thz-woo-item-cart-buttons">';
			if($btns_show =='icon' || $btns_show =='both'){
				$add_to_cart .='<i class="thzicon thzicon-circle-plus"></i>';
			}
			if($btns_show =='label' || $btns_show =='both'){
				$add_to_cart .= '<span class="thz-woo-item-cart-label'.$label_space.'">';
				$add_to_cart .= esc_html__( 'More Info', 'creatus' );
				$add_to_cart .= '</span>';
			}
			$add_to_cart .='</a>';
		}
		
		if ( $product->is_on_sale() && $product->is_in_stock()) {
			
			$item_badge	.= '<span class="thz-woo-item-badge thz-woo-item-on-sale">';
			$item_badge	.= esc_html__( 'Sale!', 'creatus' );
			$item_badge	.= '</span>';			
		}
		
		$view_cart = '<a class="thz-woo-item-view-cart thz-woo-item-cart-buttons"';
		$view_cart .= ' href="'.wc_get_cart_url().'">';
		if($btns_show =='icon' || $btns_show =='both'){
			$view_cart .= '<i class="thzicon thzicon-check"></i>';
		}
		if($btns_show =='label' || $btns_show =='both'){
			$view_cart .= '<span class="thz-woo-item-cart-label'.$label_space.'">';
			$view_cart .= esc_html__( 'View cart', 'creatus' );
			$view_cart .= '</span>';
		}
		$view_cart .= '</a>';
		
		if ($media_height !='auto' ) { 
			$style = ' style="background-image:url('.esc_url ( $product_image ).');"';
		}
		
		$html  = '<div class="thz-woo-item-media">';
		$html .= '<div class="'.thz_sanitize_class( $img_ratio ).'">';
		$html .= '<div class="thz-ratio-in">';
		$html .= '<div class="'.thz_sanitize_class( $hover_classes ).'"'.$style.'>';
		$html .= $item_badge;
		if ($media_height == 'auto' ) { 
			$html .='<img class="'.thz_sanitize_class( $iduration ).'" src="'.esc_url( $product_image ).'" alt="'.get_the_title().'" />';
		}
		$html .='<div class="thz-hover-mask '.thz_sanitize_class( $oduration ).'">';
		$html .='<div class="thz-item-adding-icon">';
		$html .='<span class="thzicon thzicon-spinner9 thz-spin"></span>';
		$html .='</div>';
		$html .='<div class="thz-item-in-cart-icon">';
		$html .='<span class="thzicon thzicon-checkmark"></span>';
		$html .='</div>';
		$html .='<div class="thz-hover-mask-table">';
		$html .='<a href="'.esc_url(get_permalink()).'" class="thz-hover-link"></a>';
		if($btns_show !='hide'){
			$html .='<div class="'.thz_sanitize_class( $icons_classes ).'">';
			$html .='<div class="thz-hover-icon thz-woo-buttons-container'.$tip_class.'"'.$tip.'>';
			$html .= $add_to_cart;
			$html .= $view_cart;
			$html .='</div>';
			$html .='</div>';
		}
		$html .='</div>';
		if($rating_show =='show'){
			$html .='<div class="thz-woo-item-rating">';
			$html .= thz_woo_product_rating($product);
			$html .='</div>';
		}
		$html .='</div>';
		$html .='</div>';
		$html .='</div>';
		$html .='</div>';		
		$html .='</div>';
		$html .='<div class="thz-woo-item-info">';
		$html .='<h3 class="thz-woo-item-title">';
		$html .='<a href="'.esc_url(get_permalink()).'">';
		$html .= get_the_title();
		$html .='</a>';
		$html .='</h3>';
		$html .='<div class="thz-woo-item-price">';
		$html .= $product->get_price_html();
		$html .='</div>';		
		$html .='</div>';
	
		echo $html;
		
		
	}
	
	add_action( 'woocommerce_before_shop_loop_item_title', '_thz_action_woo_loop_item', 10 );
	remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
	remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
	remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
	remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
	remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
	remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
	remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
	remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );


	function _thz_filter_woo_sub_category( $category ) {
		
		$thumbnail_id  			= get_woocommerce_term_meta( $category->term_id, 'thumbnail_id', true  );
		$prefix					= !empty(thz_get_option('woo_cat/0',array())) ? 'woo_cat/0/' : '';	
		$image_size 			= thz_get_option( $prefix.'wooscst/imgs' ,'thz-img-medium');
		$thumb 					= wp_get_attachment_image_src($thumbnail_id,$image_size); 
		$counter 				= thz_get_option( $prefix.'wooscst/counter','show');
		$media_height 			= thz_get_option( $prefix.'wooscst/imgh/picked','auto'); 
		$obgtype				= thz_ov_ef('.thz-woo-sub-category','background/type');
		$oeffect 				= thz_ov_ef('.thz-woo-sub-category','oeffect'); 
		$oduration				= thz_ov_ef('.thz-woo-sub-category','oduration'); 
		$ieffect				= thz_ov_ef('.thz-woo-sub-category','ieffect'); 
		$iduration				= thz_ov_ef('.thz-woo-sub-category','iduration'); 
		$html					= '';
		$style 					= '';
		$img 					= '';
		
		if($media_height == 'custom'){
			
			$img_ratio		= 'thz-media-custom-size';
			$img_mask		= ' thz-hover-img-mask';
			
		}else if ($media_height == 'auto'){
			
			$img_ratio		= 'thz-media-height-auto';
			$img_mask		= '';
			
		}else{
			$img_ratio		= 'thz-aspect '.$media_height;
			$img_mask		= ' thz-hover-img-mask';
		}		
		
		$hover_classes 	= 'thz-hover thz-hover-bg-'.$obgtype.' '.$oeffect.' '.$oduration.' '.$ieffect.''.$img_mask;
		
		
		
		if ( $thumbnail_id ) {
			$image = $thumb;
			$image = $image[0];
		} else {
			$image = wc_placeholder_img_src();
		}
		if ( $image ) {
			// Prevent esc_url from breaking spaces in urls for image embeds
			// Ref: http://core.trac.wordpress.org/ticket/23605
			$image = str_replace( ' ', '%20', $image );

			$img = '<img class="'.thz_sanitize_class( $iduration ).'" src="' . esc_url( $image ) . '" alt="' . esc_attr( $category->name ) . '" />';
		}
		
		if ($media_height !='auto' ) { 
			$style = ' style="background-image:url('.esc_url ( $image ).');"';
		}
		

		if ( $image ) {
			$html .= '<div class="thz-woo-item-media">';
			$html .= '<div class="'.thz_sanitize_class( $img_ratio ).'">';
			$html .= '<div class="thz-ratio-in thz-ratio-img">';
			$html .= '<div class="'.thz_sanitize_class( $hover_classes ).'"'.$style.'>';
			if ($media_height =='auto' ) { 
				$html .= $img;
			}
			$html .='<div class="thz-hover-mask '.thz_sanitize_class( $oduration ).'">';
			$html .='<div class="thz-hover-mask-table">';
			$html .='<a href="'.get_term_link( $category->slug, 'product_cat' ) .'" class="thz-hover-link"></a>';
			$html .= '</div>';
			$html .= '</div>';
			$html .= '</div>';
			$html .= '</div>';
			$html .= '</div>';
			$html .= '</div>';
		}
		
		$html .= '<h3 class="thz-woo-cat-title">';
		$html .= '<a href="' . get_term_link( $category->slug, 'product_cat' ) . '">';
		$html .= $category->name;
		if($counter == 'show'){
			$html .= '<span class="thz-woo-cat-count">';
			$html .= '(';
			$html .= $category->count;
			$html .= ')';
			$html .= '</span>';
		}
		$html .= '</a>';
		$html .= '</h3>';
		

		echo $html;		
		
	}
	
	
	add_action( 'woocommerce_before_subcategory', '_thz_filter_woo_sub_category', 10 );
	remove_action( 'woocommerce_before_subcategory', 'woocommerce_template_loop_category_link_open', 10 );
	remove_action( 'woocommerce_before_subcategory_title', 'woocommerce_subcategory_thumbnail', 10 );
	remove_action( 'woocommerce_shop_loop_subcategory_title', 'woocommerce_template_loop_category_title', 10 );
	remove_action( 'woocommerce_after_subcategory_title', 'woocommerce_after_subcategory_title', 10 );
	remove_action( 'woocommerce_after_subcategory', 'woocommerce_template_loop_category_link_close', 10 );
	remove_action( 'woocommerce_before_single_product', 'wc_print_notices' );
	add_action( 'woocommerce_before_single_product_summary', 'wc_print_notices', 15 );
	remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash',10 );
	
	// using thz_woocommerce_subcategories  instead https://github.com/woocommerce/woocommerce/issues/18998
	remove_filter( 'woocommerce_product_loop_start', 'woocommerce_maybe_show_product_subcategories' );
}

/**
 * Old subcategories display
 * so that we can wrap them in a grid
 */
if ( ! function_exists( 'thz_woocommerce_subcategories' ) ) {
	function thz_woocommerce_subcategories($echo = true){
			
		$subcategories = woocommerce_maybe_show_product_subcategories('');
		
		if($subcategories !=''){
			
			$prefix		= !empty(thz_get_option('woo_cat/0',array())) ? 'woo_cat/0/' : '';
			$gutter  	 = thz_get_option($prefix.'wooscst/gutter',30);
			$cats_before ='<div class="thz-clear"></div>';
			$cats_before .='<div class="thz-items-grid-holder thz-woo-sub-categories-holder">';
			$cats_before .='<div class="thz-items-grid thz-ml-n'.esc_attr($gutter).'">';
			$cats_after ='</div>';
			$cats_after .='</div>';
			$cats_after .='<div class="thz-items-gutter-adjust thz-mb-n'.esc_attr($gutter).'"></div>';
			
			if($echo){
				echo $cats_before.$subcategories.$cats_after;	
			}else{
				return $cats_before.$subcategories.$cats_after;	
			}
		}
		
	}
}

/**
 * Remove catalog ordering filter
 */
function thz_woo_before_shop_loop (){
	
	$show_result	= thz_get_theme_option('wooshmx/result','hide') == 'show' ? true : false;
	$show_catalog	= thz_get_theme_option('wooshmx/catalog','hide') == 'show' ? true : false;
	
	if(!$show_result){
		remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
	}
	
	if(!$show_catalog){
		remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering',30);
	}
	
	if($show_result || $show_catalog){
		echo '<div class="thz-shop-header">';
	}
	
	do_action('woocommerce_before_shop_loop'); 
	
	if($show_result || $show_catalog){
		echo '</div>';
	}
	
}

/**
 * Remove title from product description tab if 
 * if product is using page builder
 */
function _thz_filter_remove_woo_desc_heading(){
	
	if( thz_has_builder() ){
		
		return false;
		
	}	
}

add_filter( 'woocommerce_product_description_heading', '_thz_filter_remove_woo_desc_heading' );



/**
 * Disable woo background
 * img regeneration
 */
if ( ! function_exists( '_thz_filter_woo_disable_img_regeneration' ) ) {
	
	function _thz_filter_woo_disable_img_regeneration() {
		
		return false;
	}
	
}

add_filter( 'woocommerce_background_image_regeneration', '_thz_filter_woo_disable_img_regeneration' );



/**
 * Update cart badge on add to cart
 */
function _thz_filter_woo_cart_badge_count( $fragments ) {
   
    global $woocommerce;

	$nitems 	= $woocommerce->cart->cart_contents_count;
	$double		= $nitems > 9 ? ' thz-mini-double' :' thz-mini-single'; 
	$has_items	= $nitems > 0 ? ' thz-mini-has-items'.$double :' thz-mini-no-items'.$double;
	$cart_badge  = '<span class="thz-woo-cart-badge'.$has_items.'">';
	$cart_badge .= '<span>';
	$cart_badge .= $nitems;
	$cart_badge .= '</span>';
	$cart_badge .= '</span>';
	
	$fragments['span.thz-woo-cart-badge'] = $cart_badge;
    return $fragments;
}


if( thz_woo_version( '2.4' ) ){
	
	add_filter('woocommerce_add_to_cart_fragments', '_thz_filter_woo_cart_badge_count');
	
}else{
	
	add_filter('add_to_cart_fragments', '_thz_filter_woo_cart_badge_count');
	
}

/**
 * Get cart item key
 */
function thz_woo_get_cart_item_key($product_id){
	
	global $woocommerce;
	 
	foreach ( $woocommerce->cart->get_cart() as $cart_item_key => $cart_item ) {
	
		if($cart_item['product_id'] == $product_id){
		
			return $cart_item_key;
			break;
		}
		
		return false;
		break;
	} 
	
	return false;
	
}

/**
 * Ajax remove item from cart
 */
function _thz_ajax_action_remove_from_cart() {
	
	$product_id = isset($_POST['product_id']) ? (int) $_POST['product_id'] : false;
	
	if(!$product_id){
		exit();
	}
	
	$item_key 	= thz_woo_get_cart_item_key( $product_id );
	
	if($item_key){
		
	   $cart 	= WC()->instance()->cart;
	   $cart->remove_cart_item( $item_key );
	   
	   wp_send_json_success( array(
		'fragments' => WC_AJAX::get_refreshed_fragments()
	   ));
	}
	
    exit();
}

add_action( 'wp_ajax_thz_ajax_action_remove_from_cart', '_thz_ajax_action_remove_from_cart' );
add_action( 'wp_ajax_nopriv_thz_ajax_action_remove_from_cart', '_thz_ajax_action_remove_from_cart' );