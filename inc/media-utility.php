<?php
/**
 * @package      Thz Framework
 * @author       Themezly
 * @license      http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 * @websites     http://www.themezly.com | http://www.youjoomla.com | http://www.yjsimplegrid.com
 * Functions for video, audio, image, social medias
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // No direct access
}

/**
 * Get all registered image sizes
 */
if( ! function_exists('thz_all_image_sizes')){
	function thz_all_image_sizes(){
		
		global $_wp_additional_image_sizes;
	
		$default_image_sizes = get_intermediate_image_sizes();
	
		foreach ( $default_image_sizes as $size ) {
			$image_sizes[ $size ][ 'width' ] = intval( get_option( "{$size}_size_w" ) );
			$image_sizes[ $size ][ 'height' ] = intval( get_option( "{$size}_size_h" ) );
			$image_sizes[ $size ][ 'crop' ] = get_option( "{$size}_crop" ) ? get_option( "{$size}_crop" ) : false;
		}
	
		if ( isset( $_wp_additional_image_sizes ) && count( $_wp_additional_image_sizes ) ) {
			$image_sizes = array_merge( $image_sizes, $_wp_additional_image_sizes );
		}	
		
		return $image_sizes;
	}
}

/**
 * Make list of all image sizes
 * Used in select option types
 */
if ( ! function_exists( 'thz_get_image_sizes_list' ) ) {
	
	function thz_get_image_sizes_list( $original = true, $exclude = array() ) {
		
		$image_sizes =	thz_all_image_sizes();
		$sizes_list  = array();

		if ( $original ) {

			$sizes_list['original'] = esc_html__( 'Original', 'creatus' );
		}

		foreach ( $image_sizes as $size => $data ) {

			if ( in_array( $size, $exclude ) ) {
				continue;
			}

			$name = str_replace( array( '_', '-' ), ' ', $size );
			$name = str_replace( 'img', '', $name );
			$name = str_replace( '  ', ' ', $name );

			$w = $data['width'];
			$h = $data['height'];

			if ( $h != 0 ) {
				$suffix = $w . 'x' . $h;
			} else {
				$suffix = $w;
			}

			$sizes_list[ $size ] = ucfirst( $name ) . ' (' . $suffix . ')';
			
		}

		unset( $image_sizes );

		return $sizes_list;		
	}
}


/**
 * Get attachment size url
 * if not available create it
 * returns resource image if dummy attachment_id
 * returns placeholder if no attachment_id
 * @data int|array if array must contain attachment_id
 * @handle the size handle eg; thz-img-medium
 * @return string
 */
if( ! function_exists('thz_get_img_src')){
	
	function thz_get_img_src( $data = false , $handle = false ){
		
		$attachment_id = thz_get_attachment_id( $data );
		
		// show resource image if dummy attachment_id
		if ( 
			is_array( $data ) 
			&& 
			thz_is_dattch( $attachment_id ) 
			&& 
			! empty( $data['url'] ) ) {
				
			return $data['url'];
			
		}
		
		// show placeholder if no attachment_id
		if( ! $attachment_id  ){
			
			if( isset( $data['url'] ) ){
				
				return $data['url'];
				
			}else{
			
				return thz_img_placeholder();
			
			}
		}
	
		// if we already have that size return it
		$has_size = wp_get_attachment_image_src( $attachment_id , $handle );
		
		if( $has_size && $has_size[3] ){
			
			return $has_size[0];
			
		}
		
		// No size, lets first get all registered image sizes
		$image_sizes = thz_all_image_sizes();
		
		// We got the handle now lets create the image
		if( isset( $image_sizes[$handle] ) ) {
			
			$file_path 	= get_attached_file( $attachment_id );
			$editor		= wp_get_image_editor( $file_path );
			
			// No error, proceed
			if ( ! is_wp_error( $editor ) ) {
				
				
				$info 			= pathinfo( $file_path );
				$dir  			= $info['dirname'];
				$ext  			= ( isset( $info['extension'] ) ) ? $info['extension'] : 'jpg';
				$name 			= wp_basename( $file_path, ".$ext" );
				$name 			= preg_replace( '/(.+)(\-\d+x\d+)$/', '$1', $name );
				
				$width			= $image_sizes[$handle]['width'];
				$height			= $image_sizes[$handle]['height'];
				$crop			= $image_sizes[$handle]['crop'];
				
				$size         	= $editor->get_size();
				$orig_width   	= $size['width'];
				$orig_height  	= $size['height'];
				
				if ( ! $height && $width ) {
					$height = round( ( $orig_height * $width ) / $orig_width );
				} elseif ( ! $width && $height ) {
					$width = round( ( $orig_width * $height ) / $orig_height );
				}
				
				$suffix 				= "{$width}x{$height}";
				$new_img				= "{$dir}/{$name}-{$suffix}.{$ext}";
				
				/**
				 * We got the image already try to get it again
				 * see https://core.trac.wordpress.org/ticket/43413
				 */						
				if ( file_exists( $new_img ) ){
	
					$image = wp_get_attachment_image_src( $attachment_id , $handle );
					
					if( $image && $image[3] ){
						
						return $image[0];
						
					}				
				}
				
				// If image does not exists lets try to create, save and return it
				if( $editor->resize( $width, $height, $crop ) && $editor->save( $new_img ) ) {
					
					$meta 					= wp_get_attachment_metadata($attachment_id);
					$meta['sizes'][$handle]	= array(
					
						'file' => "{$name}-{$suffix}.{$ext}",
						'width' => $width,
						'height' => $height,
						'mime-type' => "image/{$ext}"
					
					);	
								
					wp_update_attachment_metadata( $attachment_id, $meta );
					
					$image = wp_get_attachment_image_src( $attachment_id , $handle );
					
					if( $image && $image[3] ){
						
						return $image[0];
						
					}
				}
			
			}
			
			// error, return original
			return wp_get_attachment_url( $attachment_id );
		
		}
		
		// we dont have that handle, return original
		return wp_get_attachment_url( $attachment_id );
	
	}
}

/**
 * Print inline style for img container
 */
if( ! function_exists('thz_print_img_style')){
	
	function thz_print_img_style( $data, $size ){
		
		$img_src = thz_get_img_src( $data, $size );
		$style = ' style="background-image:url('.esc_url ( $img_src ).');"';
		
		return $style;		
	}
}


/**
 * Print img html
 */
if( ! function_exists('thz_print_img_html')){
	
	function thz_print_img_html( $data, $size, $attr = ''){
		
		$attachment_id 	= thz_get_attachment_id( $data );
		$html 			= wp_get_attachment_image($attachment_id, $size , false, $attr );
		
		if( '' ==  $html ){

			if( is_array($attr) ){
				
				$attr = thz_print_attr( $attr );
				
			}
			
			$html ='<img src="'.thz_get_img_src( $data, $size ).'" '.$attr.' />';
		}
		
		return $html;
	
	}
}

/**
 * Get attachment ID
 */
if( ! function_exists('thz_get_attachment_id')){
	
	function thz_get_attachment_id( $data ){
		
		if( is_array( $data ) ){
			
			if(isset($data['attachment_id'])){
			
				return $data['attachment_id'];	
				
			}
			
			if( !isset($data['attachment_id']) && isset($data['id']) ){
				return $data['id'];
			}
			
		}else{
			
			return $data;
			
		}
	}
}



/**
 * Print posts media icons
 */
 
if( ! function_exists('thz_print_post_media_icons')){
	
	function thz_print_post_media_icons( $atts, $item_link, $media_data = array() , $element = false ) {
	
		$show_icons = thz_akg( 'show_icons/picked', $atts );
		if ( $show_icons == 'show' ) {
	
			$link_icon_show  = thz_akg( 'show_icons/show/link_icon/picked', $atts );
			$media_icon_show = thz_akg( 'show_icons/show/media_icon/picked', $atts );
			$icon_shape_type = thz_akg( 'show_icons/show/iconsbg_metrics/sh', $atts );
			$icon_pa         = thz_akg( 'show_icons/show/icons_metrics/pa', $atts );
			$icon_fs         = thz_akg( 'show_icons/show/icons_metrics/fs', $atts );
			$icon_classes    = $icon_shape_type . ' thz-fs-' . $icon_fs . ' thz-vp-' . $icon_pa . ' thz-hp-' . $icon_pa;
			$icons_output    = '';
			$attachment_id   = isset( $media_data['media']['attachment_id'] ) ? $media_data['media']['attachment_id'] : null;
	
			if ( is_numeric( $media_data ) ) {
				$attachment_id = $media_data;
			}
	
			if ( $link_icon_show == 'show' ) {
	
				$link_icon    = thz_akg( 'show_icons/show/link_icon/show/icon', $atts );
				$icons_output .= '<a class="thz-hover-icon thz-hover-link-icon ' . esc_attr( $icon_classes ) . '" href="' . esc_url( $item_link ) . '">';
				$icons_output .= '<span class="' . esc_attr( $link_icon ) . '"></span>';
				$icons_output .= '</a>';
			}
	
	
			if ( $media_icon_show == 'show' && $attachment_id ) {
	
				$img_meta      = wp_prepare_attachment_for_js( $attachment_id );
				$qtitle        = isset($media_data['qtitle']) ? $media_data['qtitle'] : null;
				$img_title     = $qtitle ? $qtitle : $img_meta['title'];
				$media_src     = $img_meta['url'];
				$media_icon    = thz_akg( 'show_icons/show/media_icon/show/icon', $atts );
				$mfp_type      = 'mfp-image';
				$mfp_src       = 'data-mfp-src';
				$mfp_href      = '#';
				$lightbox_data = $element ? thz_lightbox_data( $atts ) : thz_lightbox_data();
				$magnific_data = $lightbox_data . ' data-mfp-title="' . $img_title . '" data-modal-size="large"';
	
	
				if ( isset( $media_data['media']['magnific_div'] ) ) {
	
					$type    = $media_data['type'];
					$mfp_src = 'data-mfp-poster';
	
					if ( $type == 'vimeo' || $type == 'youtube' ) {
	
						$mfp_type = 'mfp-iframe';
	
					} else {
	
						$mfp_type = 'mfp-inline';
						$mfp_href = '#thz_media-' . $media_data['mediaid'];
					}
	
				}
	
				if ( isset( $media_data['media']['mfp_src'] ) ) {
	
					$mfp_type      = 'mfp-iframe';
					$media_src     = $media_data['media']['mfp_src'];
					$magnific_data .= ' data-mfp-poster="' . esc_url( $img_meta['url'] ) . '"';
	
				}
	
				$icons_output .= '<a class="thz-hover-icon thz-hover-media-icon ' . thz_sanitize_class( $icon_classes ) . ' thz-lightbox ' . $mfp_type . '"';
				$icons_output .= ' href="' . $mfp_href . '"';
				$icons_output .= ' ' . $mfp_src . '="' . esc_url( $media_src ) . '" ' . $magnific_data . '>';
				$icons_output .= '<span class="' . esc_attr( $media_icon ) . '"></span>';
				$icons_output .= '</a>';
				if ( isset( $media_data['media']['magnific_div'] ) ) {
					$icons_output .= $media_data['media']['magnific_div'];
				}
	
	
			}
	
			return $icons_output;
		}
	
	}
}

/**
 * Get attachment id from url
 */
function thz_get_attachment_id_from_url( $url ) {

	if( function_exists('attachment_url_to_postid')){
		
		return attachment_url_to_postid( $url );
	}
	
	// backup
	global $wpdb;
	
    $dir = wp_get_upload_dir();
    $path = $url;
 
    $site_url = parse_url( $dir['url'] );
    $image_path = parse_url( $path );
 
    //force the protocols to match if needed
    if ( isset( $image_path['scheme'] ) && ( $image_path['scheme'] !== $site_url['scheme'] ) ) {
        $path = str_replace( $image_path['scheme'], $site_url['scheme'], $path );
    }
 
    if ( 0 === strpos( $path, $dir['baseurl'] . '/' ) ) {
        $path = substr( $path, strlen( $dir['baseurl'] . '/' ) );
    }
 
    $sql = $wpdb->prepare(
        "SELECT post_id FROM $wpdb->postmeta WHERE meta_key = '_wp_attached_file' AND meta_value = %s",
        $path
    );
    $post_id = $wpdb->get_var( $sql ); // phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared
 
    return (int) $post_id;

}


/**
 * Print svg icon
 * @return string
 */	
function thz_svg_icon($iconsvg,$add_id = false){
	
	if(!is_array($iconsvg)){
		return;
	}
	
	$svg_attch			= $iconsvg['attachment_id'];
	$id					= $add_id ? '-'.$add_id : '';
	
	if(thz_is_dattch($svg_attch)){
		
		$svg_print		= thz_get_contents($iconsvg['url']);
		
	}else{
		
		$svg_print 		= _thz_output_req_file( get_attached_file( $svg_attch ) );
	}
	
	if($svg_print){
		
		$svg_print			= strstr($svg_print, '<svg');
		$svg_print	 		= str_replace('<svg','<svg id="svg-'.$svg_attch.$id.'" ',$svg_print);	
		
		return $svg_print;
		
	}else{
		
		$svg_print			= 'SVG?';
		
	}
	
	return $svg_print;
}

/**
 * Get placeholder image
 * @return string
 */	
function thz_img_placeholder($number = false){
	
	if(!$number){
		$range = range(0, 5);
		unset($range[0]);
		$rand = array_rand($range, 1);
		$number = $range[$rand];
	}
	
	if('product' === get_post_type() && function_exists('wc_placeholder_img_src')){
		return wc_placeholder_img_src();
	}
	
	return thz_theme_file_uri('/assets/images/placeholders/'.$number.'.jpg');	
	
}


/**
 * Remove specific image sizes
 * Do not use it if you do not understand!!!
 * @remove array('size_to_remove','size_to_remove'...)
 */
function _thz_remove_image_sizes( $remove = array() ){
	
	if( empty( $remove ) ){
		return;
	}
	
	$args = array(
		'post_type' => 'attachment',
		'numberposts' => -1,
		'post_status' => null,
		'post_parent' => null, // any parent
    ); 
	
	$attachments = get_posts($args);
	
	if ( $attachments ) {
		
		$wpfs    	 = thz_wp_file_system();
		
		foreach ($attachments as $item) {
			
			$attachment_id 	= $item->ID;
			$meta = wp_get_attachment_metadata($attachment_id); 
			$file = get_attached_file($attachment_id, true);
						
			foreach($remove as $size){
			 	
				 if( !isset($meta['sizes'][$size]) ){
					 continue;
				 }
				 
				 $data 		= image_get_intermediate_size($attachment_id,$size);
				 $img_path 	= realpath(str_replace(wp_basename($file), $data['file'], $file));
				
				 unset($meta['sizes'][$size]);
			 
				 wp_update_attachment_metadata( $attachment_id, $meta );		
				 $wpfs->delete( $img_path );
				
			}
			
		}

	}
	
}




/**
 * Display user instagram images
 */
if ( ! function_exists( 'thz_instagram_images' ) ){
	
	function thz_instagram_images($username, $number = 5,$widget_id = 'thz_instagram_0',$custom_trans = false, $keep_data = false){

		
		$trans_name = $custom_trans ? $custom_trans : 'thz-instagram-images-' . sanitize_title_with_dashes( $username.$widget_id ) . '-'.$number;
		$instagram = $keep_data == 'a' ? get_option( $trans_name ) : get_transient( $trans_name );
		
		if ( false === $instagram ) {

			$connect = wp_remote_get( 'http://instagram.com/' . trim( $username ) );
	
			if ( is_wp_error( $connect ) ) {
				return esc_html__( 'Connection error. Instagram is currently down.', 'creatus' );
			}
	
			if ( 200 != wp_remote_retrieve_response_code( $connect ) ) {
				return esc_html__( 'Response error. Invalid response.', 'creatus' );
			}

			$inst_data  = explode( 'window._sharedData = ', $connect['body'] );	
			$inst_json  = explode( ';</script>', $inst_data[1] );	
			$inst_array = json_decode( $inst_json[0], true );

			$images		= array();
	
			if ( ! $inst_array ) {
				return new WP_Error( 'invalid_json', esc_html__( 'Invalid json data.', 'creatus' ) );
			}

			if(isset($inst_array['entry_data']['ProfilePage']['0']['graphql']['user']['edge_owner_to_timeline_media']['edges'])) {
				$images = $inst_array['entry_data']['ProfilePage']['0']['graphql']['user']['edge_owner_to_timeline_media']['edges'];
			}
			
			$instagram = array();
			$count     = 0;
			
			foreach ( $images as $image ) {
				if ( !$image['node']['is_video'] ) {
					
					$title 		 =  thz_remove_empty_lines(strip_tags(thz_remove_emoji($image['node']['edge_media_to_caption']['edges'][0]['node']['text'])));
					$instagram[] = array(
						'code'        => $image['node']['shortcode'],
						'link'        => $image['node']['display_url'],
						'likes'       => $image['node']['edge_media_preview_like']['count'],
						'title'       => substr($title,0,100),
					);
					$count ++;
				}
				
				if ( $count == $number ) {
					break;
				}
			}

			$instagram = maybe_serialize( $instagram );
			
			if($keep_data == 'a'){
				
				update_option( $trans_name, $instagram );
			
			}else{
				
				set_transient( $trans_name, $instagram, apply_filters( 'thz_instagram_cache_time', HOUR_IN_SECONDS * 3  ) );
			}

		}
		
		$instagram = maybe_unserialize( $instagram );
	
		return array_slice( $instagram, 0, $number );
	}
}

/**
 * Display user flickr images
 */
if ( ! function_exists( 'thz_flickr_images' ) ){
	
	function thz_flickr_images($api, $userid, $photoset, $number = 5, $size = 'm', $widget_id = 'thz_flickr_0',$custom_trans = false, $keep_data = false){
		
		$trans_name = $custom_trans ? $custom_trans : 'thz-flickr-images-' . sanitize_title_with_dashes( $userid.$widget_id ) . '-'.$number;
		$ordered_images = $keep_data == 'a' ? get_option( $trans_name ) : get_transient( $trans_name );
		
		if ( false === $ordered_images ) {

			$url = 'https://api.flickr.com/services/rest/?';
			$url .= 'method=';
			$url .= !empty($photoset) ? 'flickr.photosets.getPhotos' : 'flickr.photos.search';
			$url .= '&api_key='.$api;
			$url .= !empty($photoset) ? '&photoset_id='.$photoset :'';
			$url .= '&user_id='.$userid;
			$url .= '&per_page='.$number;
			$url .= '&media=photos&format=json&nojsoncallback=1&privacy_filter=1';
					
			$connect = wp_remote_get( $url ) ;

			if ( is_wp_error( $connect ) ) {
				return esc_html__( 'Connection error. Flickr is currently down.', 'creatus' );
			}
	
			if ( 200 != wp_remote_retrieve_response_code( $connect ) ) {
				return esc_html__( 'Response error. Invalid response.', 'creatus' );
			}
			
			$response = json_decode( $connect['body'],true );
			$ordered_images = array();
			
			if ( !empty ( $response ) && json_last_error() == JSON_ERROR_NONE ) {
				
				$p_key = !empty($photoset) ? 'photoset' : 'photos';
				
				$images = isset($response[$p_key]['photo']) ? $response[$p_key]['photo'] : array();
				$owner  = !empty($photoset) ? $response[$p_key]['owner'] : false;
				
				foreach( $images as $image ){
					
					if($image['ispublic'] != 1 ){
						continue;
					}
					
					$image_thumb = '//farm';
					$image_thumb .= $image['farm'];
					$image_thumb .= '.static.flickr.com/';
					$image_thumb .= $image['server'];
					$image_thumb .= '/'.$image['id'];
					$image_thumb .= '_'.$image['secret'];
					$image_thumb .= '_'.$size.'.jpg';
					
					
					$image_link = '//www.flickr.com/photos/';
					$image_link .= $owner ? $owner : $image['owner'];
					$image_link .= '/'.$image['id'];
					
					$ordered_images[$image['id']] = array(
						'thumb' => $image_thumb,
						'url' 	=> $image_link,
						'title' => $image['title']
					);
					unset($image);
				}
				
				unset($images);
				
			}

			$ordered_images = maybe_serialize( $ordered_images );
			
			if($keep_data == 'a'){
				
				update_option( $trans_name, $ordered_images );
			
			}else{
			
				set_transient( $trans_name, $ordered_images, apply_filters( 'thz_flickr_cache_time', HOUR_IN_SECONDS * 6 ) );
				
			}
		}
		
		$ordered_images = maybe_unserialize( $ordered_images );
		return $ordered_images;
	
	}
}


/**
 * Get twitter feed
 */
if ( ! function_exists( 'thz_twitter_feed' ) ){
	
	function thz_twitter_feed($atts = array()) {

		if(!class_exists('TwitterOAuth')){
			
			return esc_html__('Missing TwitterOAuth class','creatus');
		}
				
		$transient				= $atts['transient'];
		$tkeys					= $atts['apikeys'] == 'theme' ? true : false;
		$consumer_key 			= $tkeys ? thz_get_theme_option('twck'): $atts['consumer_key'];
		$consumer_secret 		= $tkeys ? thz_get_theme_option('twcs'): $atts['consumer_secret'];
		$access_token 			= $tkeys ? thz_get_theme_option('twat'): $atts['access_token'];
		$access_token_secret 	= $tkeys ? thz_get_theme_option('twts'): $atts['access_token_secret'];
		$twitter_id 			= $atts['twitter_id'];
		$count 					= $atts['count'];		
		
		if($twitter_id && $consumer_key && $consumer_secret && $access_token && $access_token_secret && $count) { 
			
			if(false === ($sorted_tweets = get_transient($transient))) {
				 
				 $TwitterOAuth = new TwitterOAuth(
					$consumer_key,	
					$consumer_secret,  
					$access_token, 
					$access_token_secret 
				);
				
				$twitterData = $TwitterOAuth->get(
				  'statuses/user_timeline',
				  array(
					'screen_name'     => $twitter_id,
					'count'           => $count,
					'exclude_replies' => false
				  )
				);
				
				if(empty($twitterData)){
					return false;
				}
				
				$sorted_tweets = array();
				
				foreach($twitterData as $key => $tweet){

					$tweet->text_parsed = thz_parse_tweet($tweet) ;
					$sorted_tweets[] = $tweet;
					
					unset($tweet);
				}
				
				unset($twitterData);
				
				$httpCode  		= $TwitterOAuth->http_code;
				$sorted_tweets 	= json_encode($sorted_tweets);
				
				if ($httpCode >= 200 && $httpCode < 300) {
				  
				  set_transient($transient,$sorted_tweets,apply_filters( 'thz_tw_feed_cache_time', HOUR_IN_SECONDS * 6 ));
				  
				}
				
			}
		}
		
		$sorted_tweets = isset($sorted_tweets) ? json_decode($sorted_tweets) : false;
		return $sorted_tweets;	
	}
	
}

/**
 * Parse twitter text
 */
function thz_parse_tweet($tweet) {
	
  	$text = $tweet->text;
	
	// url
	if (is_array($tweet->entities->urls)) {
		
		foreach ($tweet->entities->urls as $e) {
			$parsed_url = '<a href="' . $e->expanded_url . '" target="_blank">' . $e->display_url . '</a>';
			$text = str_replace($e->url,$parsed_url,$text);
		}		
		
	}
	
	// hastags
	if (is_array($tweet->entities->hashtags)) {
		foreach ($tweet->entities->hashtags as $e) {
			$parsed_hash = '<a href="https://twitter.com/hashtag/' . $e->text . '?src=hash" target="_blank">#' . $e->text . '</a>';
			$text = str_replace('#'.$e->text,$parsed_hash,$text);
		}
	}
	
	// user
	if (is_array($tweet->entities->user_mentions)) {
		foreach ($tweet->entities->user_mentions as $e) {
			$parsed_user = '<a href="https://twitter.com/' . $e->screen_name . '" target="_blank">@' . $e->screen_name . '</a>';
			$text = str_replace('@'.$e->screen_name,$parsed_user,$text);
		}
	}
	
	return $text;

}


/**
 * Process iframes and cleanup
 * @return string
*/
function thz_media_iframe_helper($iframe, $echo =  true,$autoplay = false){
	
	$allowed_html = array(
		'iframe' => array(
			'src' => array(),
			'id' => array(),
			'width' => array(),
			'height' => array(),
			'scrolling' => array(),
			'frameborder' => array(),
			'allowfullscreen' => array(),
	 ));
	 
	if (strpos($iframe, 'vimeo') !== false) {
		
		preg_match('/src="([^"]+)"/', $iframe, $match);
		$src 	= thz_add_media_players_api($match[1],'vimeo',$autoplay );
		$iframe = str_replace($match[1],$src,$iframe);
	}
	
	if (strpos($iframe, 'youtu') !== false) {
		
		preg_match('/src="([^"]+)"/', $iframe, $match);
		$src 	= thz_add_media_players_api($match[1],'youtube',$autoplay );
		$iframe = str_replace($match[1],$src,$iframe);
	}
	
	if($echo){
	
		echo wp_kses( $iframe, $allowed_html );
	
	}else{
		
		return wp_kses( $iframe, $allowed_html );
	}
	
}


/**
 * Add api to mfp-iframe 
 * video link for Vimeo and Youtube
 * @return string
*/
function thz_add_media_players_api($source,$type,$autoplay = true){
	
	$api = $type == 'vimeo' ? '?api=1' : '?enablejsapi=1';
	
	if( $autoplay ){
		
		$api .= $type == 'vimeo' ? '&amp;autoplay=1' : '&amp;autoplay=1';
	}
	
	if (strpos($source, 'api=') !== false) {
		
		return esc_url ( trim($source) );
	}
	
	if (strpos($source, '?') !== false) {
		
		$source = str_replace('?',$api.'&amp;',$source);
		$api 	='';
	}	
	
	return esc_url ( trim($source) ).$api;
}




/**
 * Merge media
 * @return array
 */
function thz_merge_media( $media_array ) {


	$new_media   = array();
	$attachments = array();

	if ( empty( $media_array ) ) {
		return $new_media;
	}

	foreach ( $media_array as $media ) {

		$type     = thz_akg( 'type/picked', $media );
		$source   = thz_akg( 'type/' . $type . '/media', $media );
		$mediaid  = thz_akg( 'pid', $media );
		$category = isset( $media['category'] ) ? $media['category'] : false;
		$featured = isset( $media['type']['featured'] ) ? true : false;

		if ( $type === 'images' ) {

			foreach ( $source as $key => $images ) {

				if ( isset( $attachments[ $images['attachment_id'] ] ) ) {

					continue;
				}

				$attachments[ $images['attachment_id'] ] = $images['attachment_id'];


				$link = thz_akg( 'type/images/link', $media, null );

				if ( $link === 'p' ) {
					$link = null;
				}

				$url = wp_get_attachment_url( $images['attachment_id'] );

				if ( thz_is_dattch( $images['attachment_id'] ) && ! empty( $images['url'] ) ) {
					$url = $images['url'];
				}

				$new_media[] = array(

					'type'     => 'image',
					'category' => $category,
					'featured'  => $featured,
					'media'    => array(
						'attachment_id' => $images['attachment_id'],
						'url'           => $url,
					),
					'link'     => $link,
					'mediaid'  => $mediaid . $key,

				);

			}
			unset( $source );

		} elseif ( $type === 'flickr' ) {

			$api        = thz_akg( 'type/' . $type . '/api', $media );
			$userid     = thz_akg( 'type/' . $type . '/userid', $media );
			$photoset   = thz_akg( 'type/' . $type . '/photoset', $media );
			$number     = thz_akg( 'type/' . $type . '/mx/n', $media );
			$size       = thz_akg( 'type/' . $type . '/mx/s', $media );
			$action     = thz_akg( 'type/' . $type . '/mx/l', $media );
			$keep_data  = thz_akg( 'type/' . $type . '/mx/k', $media );
			$trans_name = 'thz-media-flickr-' . get_post_modified_time() . thz_remove_whitespace( $userid ) . $mediaid . $number;
			$fimages    = thz_flickr_images( $api, $userid, $photoset, $number, $size, false, $trans_name, $keep_data );
			$link       = null;

			if ( is_array( $fimages ) ) {
				foreach ( $fimages as $key => $image ) {

					if ( $action == 'f' ) {
						$link = array(
							'type'     => 'normal',
							'url'      => $image['url'],
							'target'   => 'blank',
							'magnific' => ''
						);
					}

					$new_media[] = array(

						'type'     => 'image',
						'category' => $category,
						'media'    => array(
							'attachment_id' => '',
							'url'           => $image['thumb'],
						),
						'link'     => $link,
						'title'    => $image['title'],
						'mediaid'  => $mediaid . $key,

					);

				}
				unset( $fimages );

			} else {

				$new_media[] = array(

					'type'     => 'image',
					'category' => $category,
					'media'    => array(
						'attachment_id' => '',
						'url'           => thz_img_placeholder( 1 ),
					),
					'link'     => null,
					'title'    => esc_html__( 'Not able to display user images. Check Flickr settings.', 'creatus' ),
					'mediaid'  => $mediaid,

				);

			}

		} elseif ( $type === 'instagram' ) {

			$userid     = thz_akg( 'type/' . $type . '/userid', $media );
			$number     = thz_akg( 'type/' . $type . '/mx/n', $media );
			$action     = thz_akg( 'type/' . $type . '/mx/l', $media );
			$keep_data  = thz_akg( 'type/' . $type . '/mx/k', $media );
			$trans_name = 'thz-media-instagram-' . get_post_modified_time() . thz_remove_whitespace( $userid ) . $mediaid . $number;
			$iimages    = thz_instagram_images( $userid, $number, false, $trans_name, $keep_data );
			$link       = null;

			if ( is_array( $iimages ) ) {
				foreach ( $iimages as $key => $image ) {

					if ( $action == 'f' ) {
						$link = array(
							'type'     => 'normal',
							'url'      => 'http://instagram.com/p/' . $image['code'],
							'target'   => 'blank',
							'magnific' => ''
						);
					}

					$new_media[] = array(

						'type'     => 'image',
						'category' => $category,
						'media'    => array(
							'attachment_id' => '',
							'url'           => $image['link'],
						),
						'link'     => $link,
						'title'    => $image['title'],
						'mediaid'  => $mediaid . $key,

					);

				}
				unset( $iimages );

			} else {

				$new_media[] = array(

					'type'     => 'image',
					'category' => $category,
					'media'    => array(
						'attachment_id' => '',
						'url'           => thz_img_placeholder( 1 ),
					),
					'link'     => null,
					'title'    => esc_html__( 'Not able to display user images. Check Instagram settings.', 'creatus' ),
					'mediaid'  => $mediaid,

				);

			}

		} elseif ( $type === 'image' ) {

			$link   = thz_akg( 'type/' . $type . '/link', $media, null );
			$qtitle = thz_akg( 'type/' . $type . '/qtitle', $media, null );

			if ( ! isset( $attachments[ $source['attachment_id'] ] ) ) {

				$attachments[ $source['attachment_id'] ] = $source['attachment_id'];

				if ( $link ) {

					if ( $link['type'] === 'normal' ) {

						$link = $link['url'] == '' ? null : $link;

					} else {

						$link = $link['magnific'] == '' ? null : $link;
					}
				}

				$url = wp_get_attachment_url( $source['attachment_id'] );

				if ( thz_is_dattch( $source['attachment_id'] ) && ! empty( $source['url'] ) ) {
					$url = $source['url'];
				}

				$new_media[] = array(

					'type'     => 'image',
					'category' => $category,
					'media'    => array(
						'attachment_id' => $source['attachment_id'],
						'url'           => $url,
					),
					'mediaid'  => $mediaid,
					'link'     => $link,
					'qtitle'   => $qtitle,

				);
			}


		} else {

			$poster = thz_akg( 'type/' . $type . '/poster', $media );
			$qtitle = thz_akg( 'type/' . $type . '/qtitle', $media, null );

			$new_media[] = array(

				'type'     => $type,
				'category' => $category,
				'media'    => $source,
				'mediaid'  => $mediaid,
				'poster'   => $poster,
				'qtitle'   => $qtitle,
			);

		}


	}

	unset( $media_array, $attachments );

	return $new_media;
}


/**
 *  Check if post has media
 */
function thz_post_has_media( $in_loop = false ) {

	$has_media    = false;
	$post_media   = thz_get_post_option( 'post_media', array() );
	$thumbnail_id = get_post_thumbnail_id();

	if ( ! $in_loop && is_singular() ) {

		$incfeatured  = thz_get_post_option( 'incfeatured', 'include' );
		$thumbnail_id = $incfeatured == 'include' ? get_post_thumbnail_id() : false;
	}

	if ( ! empty( $post_media ) || ! empty( $thumbnail_id ) ) {
		$has_media = true;
	}

	return $has_media;
}


/**
 * Get post media
 * @return array
 */
function thz_get_post_media( $placeholder = true, $featured = true, $count = false) {

	$post_media = thz_get_post_option( 'post_media', array() );
	
	if($count){
		
		if( count($post_media) == 0 && $featured == false){
			$featured = true;
		}
	}
	
	if ( $placeholder || $featured ) {
		$thumbnail_id = get_post_thumbnail_id();
	}

	// add featured image to media array
	if ( $featured ) {

		if ( ! empty( $thumbnail_id ) || ( empty( $post_media ) && ! empty( $thumbnail_id ) ) ) {

			$add_media = array(

				'type' => array(
					'picked' => 'images',
					'featured' => true,
					'images' => array(
						'media' => array(

							array(
								'attachment_id' => $thumbnail_id,
								'url'           => wp_get_attachment_url( $thumbnail_id )
							)
						)
					)
				)


			);
			array_unshift( $post_media, $add_media );

		}

	}

	// add placeholder image to media array
	if ( $placeholder ) {
		if ( empty( $post_media ) && empty( $thumbnail_id ) ) {

			$add_media = array(

				'type' => array(
					'picked' => 'images',
					'images' => array(
						'media' => array(

							array(
								'attachment_id' => '',
								'url'           => thz_img_placeholder()
							)
						)
					)
				)


			);
			array_unshift( $post_media, $add_media );
		}
	}

	return thz_merge_media( $post_media );

}

/**
 * Get post media for magnific popup
 * @return array
 */
function thz_magnific_media( $postmedia, $options = null ) {


	if ( empty( $postmedia ) ) {
		return array();
	}

	$media_images = array();

	foreach ( $postmedia as $media ) {

		$type    = thz_akg( 'type', $media );
		$source  = thz_akg( 'media', $media );
		$mediaid = thz_akg( 'mediaid', $media );

		if ( 'image' === $type ) {
			$media_images[] = $media;

		} else {

			$poster   = thz_akg( 'poster', $media, array() );
			$qtitle   = thz_akg( 'qtitle', $media, null );
			$category = isset( $media['category'] ) ? $media['category'] : false;

			if ( empty( $poster ) ) {

				$poster['attachment_id'] = null;
				$poster['url']           = thz_img_placeholder();
				$img_title               = $qtitle ? $qtitle : 'image-placeholer';

			} else {

				$img_meta  = wp_prepare_attachment_for_js( $poster['attachment_id'] );
				$img_title = $qtitle ? $qtitle : $img_meta['title'];

				if ( ! thz_is_dattch( $poster['attachment_id'] ) && empty( $poster['url'] ) ) {
					$poster['url'] = wp_get_attachment_url( $poster['attachment_id'] );
				}
			}


			if ( $type == 'vimeo' || $type == 'youtube' ) {

				$magnific_link = '<a class="thz-hover-link thz-lightbox mfp-iframe" href="#" ';
				$magnific_link .= thz_lightbox_data( $options );
				$magnific_link .= ' data-mfp-src="' . thz_add_media_players_api( $source, $type ) . '"';
				$magnific_link .= ' data-mfp-poster="' . esc_url( $poster['url'] ) . '"';
				$magnific_link .= ' data-mfp-title="' . esc_attr( $img_title ) . '">';
				$magnific_link .= '</a>';
				$magnific_div  = null;
				$mfp_src       = thz_add_media_players_api( $source, $type );

			} else {

				$mfp_src       = null;
				$magnific_link = '<a class="thz-hover-link thz-lightbox mfp-inline" href="#thz_media-' . $mediaid . '" ';
				$magnific_link .= thz_lightbox_data( $options );
				$magnific_link .= ' data-modal-size="xlarge"';
				$magnific_link .= ' data-mfp-poster="' . esc_url( $poster['url'] ) . '"';
				$magnific_link .= ' data-mfp-title="' . esc_attr( $img_title ) . '">';
				$magnific_link .= '</a>';


				$magnific_div = '<div id="thz_media-' . $mediaid . '" class="thz-selfmedia-popup thz-modal-box mfp-hide">';

				$magnific_div .= '<div class="thz-aspect thz-ratio-16-9">';
				$magnific_div .= '<div class="thz-ratio-in">';


				if ( $type == 'selfvideo' || $type == 'html5video' ) {

					$video_poster = ! empty( $poster ) ? $poster['url'] : null;
					$has_poster   = $video_poster ? ' thz-media-has-poster' : '';

					$magnific_div .= '<video id="thz_media_video-' . $mediaid . '" class="thz-media-mfp thz-video-html5 thz-media-respond' . $has_poster . '"';
					if ( $video_poster ) {
						$magnific_div .= ' poster="' . esc_url( $video_poster ) . '"';
					}
					$magnific_div .= '>';

					if ( $type == 'html5video' ) {

						$magnific_div .= '<source src="' . esc_url( trim( $source ) ) . '" type="video/mp4" />';

					} else {

						foreach ( $source as $source_ext ) {
							$ext_type     = wp_check_filetype( $source_ext['url'] );
							$media_url    = wp_get_attachment_url( $source_ext['attachment_id'] );
							$magnific_div .= '<source src="' . esc_url( trim( $media_url ) ) . '" type="' . $ext_type['type'] . '" />';
						}
					}


					$magnific_div .= '</video>';

				} elseif ( $type == 'selfaudio' || $type == 'html5audio' ) {

					$magnific_div .= '<div class="thz-media-audio-holder">';
					$magnific_div .= '<audio id="thz_media_audio-' . $mediaid . '" class="thz-media-mfp thz-audio thz-media-respond">';

					if ( $type == 'html5audio' ) {

						$magnific_div .= '<source src="' . esc_url( trim( $source ) ) . '" type="audio/mp3" />';

					} else {
						foreach ( $source as $source_ext ) {
							$ext_type     = wp_check_filetype( $source_ext['url'] );
							$media_url    = wp_get_attachment_url( $source_ext['attachment_id'] );
							$magnific_div .= '<source src="' . esc_url( trim( $media_url ) ) . '" type="' . $ext_type['type'] . '" />';
						}
					}


					$magnific_div .= '</audio>';
					$magnific_div .= '</div>';

				} elseif ( $type == 'oembed' ) {

					$nonce        = wp_create_nonce( '_thz_action_get_oembed_response' );
					$magnific_div .= '<div class="thz-media-oembed" data-nonce="' . $nonce . '" data-url="' . esc_url( trim( $source ) ) . '">';
					$magnific_div .= '</div>';

				} elseif ( $type == 'iframe' ) {

					$source       = thz_media_iframe_helper( $source, false, true );
					$magnific_div .= '<div class="thz-media-oembed" data-embed="' . thz_htmlspecialchars( $source ) . '">';
					$magnific_div .= '</div>';

				}

				$magnific_div .= '</div>';
				$magnific_div .= '</div>';
				$magnific_div .= '</div>';

			}

			$overlay_icon = strpos( $magnific_div, 'twitter' ) !== false ? 'fa fa-twitter' : 'thzicon thzicon-play2';

			if ( $type == 'selfaudio' || $type == 'html5audio' ) {

				$overlay_icon = 'thzicon thzicon-musical-note';
			}

			$new_media = array(
				'type'     => 'image',
				'mediaid'  => $mediaid,
				'qtitle'   => $qtitle,
				'category' => $category,
				'media'    => array(
					'attachment_id' => $poster['attachment_id'],
					'url'           => $poster['url'],
					'magnific_link' => $magnific_link . $magnific_div,
					'magnific_div'  => $magnific_div,
					'overlay_icon'  => $overlay_icon,
					'mfp_src'       => $mfp_src
				),

			);

			$media_images[] = $new_media;

		}

	}

	return $media_images;

}

/**
 * Print post thumbnail.
 * Wraps the post thumbnail in an anchor element on index views, or a div
 * element when on single views.
 * @return string
 */
if ( ! function_exists( 'thz_post_thumbnail' ) ) {

	function thz_post_thumbnail( $media_height = 'thz-ratio-16-9', $img = false, $elements = false, $effects = true ) {

		if ( post_password_required() || is_attachment() ) {
			return;
		}

		if ( ! $img ) {
			$thumbnail_id = get_post_thumbnail_id();
		}

		if ( ! $img && ! $thumbnail_id ) {
			return;
		}

		if ( $img ) {

			$featured_image = $img;

		} else {

			$thumbnail      = get_post( $thumbnail_id );
			$featured_image = wp_get_attachment_url( $thumbnail_id );
		}

		$style      = ' style="background-image:url(' . esc_url( $featured_image ) . ');"';
		$obgtype  	= thz_get_theme_option( 'med_over/background/type', null );
		$oeffect    = thz_get_theme_option( 'med_over/oeffect', null );
		$oduration  = thz_get_theme_option( 'med_over/oduration', null );
		$ieffect    = thz_get_theme_option( 'med_over/ieffect', null );
		$iduration  = thz_get_theme_option( 'med_over/iduration', null );
		$iceffect   = thz_get_theme_option( 'med_over/iceffect', null );
		$icduration = thz_get_theme_option( 'med_over/icduration', null );

		if ( $media_height == 'custom' ) {

			$img_ratio = 'thz-media-custom-size';
			$img_mask  = ' thz-hover-img-mask';

		} else if ( $media_height == 'auto' ) {

			$img_ratio = 'thz-media-height-auto';
			$img_mask  = '';
			$style     = '';

		} else {
			$img_ratio = 'thz-aspect ' . $media_height;
			$img_mask  = ' thz-hover-img-mask';
		}


		$hover_classes = 'thz-hover thz-hover-bg-'.$obgtype.' ' . $oeffect . ' ' . $oduration . ' ' . $ieffect . '' . $img_mask;
		$icons_classes = 'thz-hover-icons ' . $iceffect . ' ' . $icduration . '';
		$ratio_style   = ! $effects ? $style : '';
		$ratio_class   = ! $effects ? ' thz-ratio-img' : '';

		$hover_link = '<a class="thz-hover-link" href="' . get_the_permalink() . '">';
		$hover_link .= '</a>';


		if ( is_singular() ) {
			$hover_link = '';
		}

		$html = '<div class="' . thz_sanitize_class( $img_ratio ) . '">';
		$html .= '<div class="thz-ratio-in' . $ratio_class . '"' . $ratio_style . '>';

		if ( $effects ) {
			$html .= '<div class="' . thz_sanitize_class( $hover_classes ) . '"' . $style . '>';
			if ( $media_height == 'auto' ) {
				$html .= '<img class="' . thz_sanitize_class( $iduration ) . '" src="' . esc_url( $featured_image ) . '" alt="' . get_the_title() . '" />';
			}
			$html .= '<div class="thz-hover-mask ' . thz_sanitize_class( $oduration ) . '">';
			$html .= '<div class="thz-hover-mask-table">';
			$html .= $hover_link;
			if ( $elements ) {
				$html .= '<div class="' . thz_sanitize_class( $icons_classes ) . '">';
				$html .= '<div class="thz-hover-icon">';
				$html .= $elements;
				$html .= '</div>';
				$html .= '</div>';
			}
			$html .= '</div>';
			$html .= '</div>';
			$html .= '</div>';
		} else {
			if ( $media_height == 'auto' ) {
				$html .= '<img src="' . esc_url( $featured_image ) . '" alt="' . get_the_title() . '" />';
			}
			$html .= $hover_link;
		}

		$html .= '</div>';
		$html .= '</div>';

		echo $html;
	}
}


/**
 * Alternate items media border radius.
 * @return string
 */
if ( ! function_exists( 'thz_alt_radius' ) ) {

	function thz_alt_radius( $radius , $side, $resp = false ) {
		
		$tl 	=  thz_akg('top-left',$radius);
		$tr 	=  thz_akg('top-right',$radius);
		$bl 	=  thz_akg('bottom-left',$radius);
		$br 	=  thz_akg('bottom-right',$radius);
		
		$lb 	= (float)$tl + (float)$bl;
		$rb 	= (float)$tr + (float)$br;
		$css	=  false;
		

		
		if('left' == $side && $rb > 0 && ($tl == $bl) && $lb == 0){

			if($resp){
				
				$css = 'border-radius:0;';
				$css .= 'border-top-left-radius:'.thz_property_unit($tr,'px').';';
				$css .= 'border-top-right-radius:'.thz_property_unit($tr,'px').';';	
							
			}else{
			
				$css = 'border-radius:'.thz_property_unit($tr,'px').';';
				$css .= 'border-top-right-radius:0;';
				$css .= 'border-bottom-right-radius:0;';				
				
			}
		}
		
		if('right' == $side && $lb > 0  && ($tr == $br) && $rb == 0 ){
			
			if($resp){
				
				$css = 'border-radius:0;';
				$css .= 'border-top-left-radius:'.thz_property_unit($tl,'px').';';
				$css .= 'border-top-right-radius:'.thz_property_unit($tl,'px').';';	
							
			}else{
							
				$css = 'border-radius:'.thz_property_unit($tl,'px').';';
				$css .= 'border-top-left-radius:0;';
				$css .= 'border-bottom-left-radius:0;';
				
			}
		}
		
		return $css;
	}
}



/**
 * Load mediaelement when needed
 * @ref https://core.trac.wordpress.org/ticket/44484
 */
function thz_enqueue_mediaelement_scripts( $load_it = false ){
	
	static $enqueued = false;
	
	if( !$enqueued ){
		
		$enqueued = true;
		
		$shortcodes = array(
			'html5video',
			'html5audio',
			'vimeo',
			'mfp-video',
			'mfp-audio',
			'media_gallery',
			'media_media',
			'audio_height',
		);
		
		if( thz_is_post() || thz_has_shortcodes( $shortcodes ) || $load_it ){
			
			wp_enqueue_script('mediaelement-vimeo');
			wp_enqueue_script('wp-mediaelement');
			
		}
	
	}
}