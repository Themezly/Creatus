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
* Sanitize element class names
*/
function thz_sanitize_class($classnames,$fallback = null ){
	
  	$classnames = is_array($classnames) ? join(' ', $classnames) : $classnames;
	$classnames = explode(' ', $classnames);
	
    foreach($classnames as $k => $v){
        $classnames[$k] = sanitize_html_class($v,$fallback);
    }
	
    return join(' ', $classnames);

}

/**
* Check element unit
* returns clean number with specified unit
*/

function thz_property_unit($val,$default,$auto = false,$none = false){
	
	
		if($val === '' || is_array($val)) {
			return;
		}
		
		if($auto){
		
			if (strpos($val, 'auto') !== false) { 
				return 'auto';
			}			
			
		}	
		
		if($none){
		
			if (strpos($val, 'none') !== false) { 
				return 'none';
			}			
			
		}
		
		$allowed = array('px','%','rem','em','vw','vh','vmin','vmax');	
		
		$value 	= (float) esc_attr($val);
		$unit 	= $default;
		
		foreach($allowed as $allowed_unit){
			
			if (strpos($val, $allowed_unit) !== false) { 
				
				$unit = $allowed_unit;
				break;
			}
		}
		
		unset($allowed,$allowed_unit);
		
		return $value.$unit;	
	
}

/**
* Get unit from value
*/

function thz_get_unit( $val, $default = 'px' ){
	
	$clean	= (float) $val;
	$values = explode($clean,$val);
	$unit 	= $default;
	
	if(isset($values[1]) & !empty($values[1])){
		$unit =  $values[1];	
	}
	
	return $unit;
	
}

/**
* Browser prefix
* returns prefixed CSS value
*/
function thz_property_prefix ( $val ){
		
	$property = $val;
	$property .= '-webkit-'.$val;
	$property .= '-mos-'.$val;
	$property .= '-o-'.$val;
	
	return $property;
}

 /**
 * Specialchars short
 * @return string
 */
function thz_htmlspecialchars($string,$only_single = false) {
	
	if($only_single){
		
		return htmlspecialchars( $string , ENT_QUOTES & ~ENT_COMPAT,'UTF-8');
	}
	
	return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}



 /**
 * Sanitaize data attributes leave double quote
 * @return string
 */
function thz_sanitize_data($string){
	
	return htmlspecialchars( $string , ENT_QUOTES & ~ENT_COMPAT,'UTF-8');
}

 /**
 * Find key by value
 * @return index
 */
function thz_find_key_by_val($find,$arr){
	
	if(in_array($find,$arr)){
		$key = array_search ($find,$arr);
		return $key;
	}
		
}


/**
 * get number of decimals
*/
function thz_count_decimals($number){
	
	$split = explode(".", $number);
	
	if(isset($split[1])){
		
		$decimals = strlen($split[1]);
	
	}else{
		
		$decimals = 0;
	}
	
	return $decimals;
}


/**
 * get difference between current and future date
 @returns date object
*/
function thz_date_diff($target_date,$offset){
	
	$start_date 	= new DateTime();
	$time_offset 	= new DateTime(date('Y-m-d H:i:s', $start_date->format('U') + ($offset*3600)));
	$date_diff 		= $time_offset->diff(new DateTime($target_date));
	
	return $date_diff;
	
}

/**
 * Recursively find array value
 @returns bool
*/

function thz_in_array_r($needle, $haystack, $strict = false) {
	
    foreach ($haystack as $item) {
        if (($strict ? $item === $needle : $item == $needle) 
			|| (is_array($item) && thz_in_array_r($needle, $item, $strict))) {
            return true;
        }
    }

    return false;
}


/**
 * Recursively replace array value
 @returns array
*/
function thz_recursive_replace($find, $replace, $array) {
    if (!is_array($array)) {
        return str_replace($find, $replace, $array);
    }
    $newArray = array();
    foreach ($array as $key => $value) {
        $newArray[$key] = thz_recursive_replace($find, $replace, $value);
    }
    return $newArray;
}


/**
 * Replace value minus to n class
 * @returns string
*/
function thz_m_ton($val) {
	$val = str_replace('-','n',$val);
	
	return esc_attr($val);
}
/**
 * Limit number of words in a string
 * @returns string
*/
function thz_words_limit($string, $word_limit){
	
	$words = explode(" ",$string);
	
	if(count($words) > $word_limit){
		
	   return implode(" ",array_splice($words,0,$word_limit));
	   
	}else{
		
	   return $string;
	}
}

/**
 * Limit number of characters in a string
 * @returns string
*/
function thz_chars_limit($string, $limit){
  
  if(strlen($string) <= $limit)  {
    return $string;
	
  }  else  {
    $limited_string = substr($string,0,$limit);
    return $limited_string;
  }
}

/**
 * Remove empty lines
 * can be used for CSS compression
*/
function thz_remove_empty_lines($string) {
	$string = str_replace(array(
		"\r\n",
		"\r",
		"\n",
		"\t",
		'  ',
		'    ',
		'    '
	), '', $string);
	return $string;
}
/**
 * Remove white space
 * can be used for js
*/
function thz_remove_whitespace($string) {
	
	$string = preg_replace(array(
		'/[^(http:)]\/\/.*$/m',
		'/\/\*.*\*\//U',
		'/\s+/'
	), array(
		'',
		'',
		' '
	), $string);
	return trim( $string );
}


// Remove comments
function thz_remove_comments($txt) {
	$txt = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $txt);
	return $txt;
}

/**
 * Strip close comment and close php tags from file headers
 * @param string $str Header comment to clean up.
 * @return string
 */
function thz_remove_header_comment( $str ) {
	return trim(preg_replace("/\s*(?:\*\/|\?>).*/", '', $str));
}
	

// Fast CSS minify
function thz_minify_css( $css, $check_ssl = false ) {
	
	$css = preg_replace( '#\s+#', ' ', $css );
	$css = preg_replace( '#/\*.*?\*/#s', '', $css );
	$css = str_replace( '; ', ';', $css );
	$css = str_replace( ': ', ':', $css );
	$css = str_replace( ' {', '{', $css );
	$css = str_replace( '{ ', '{', $css );
	$css = str_replace( ', ', ',', $css );
	$css = str_replace( '} ', '}', $css );
	$css = str_replace( ';}', '}', $css );
	
	if( $check_ssl && thz_contains( get_site_url() ,'https://') ){
		$css = str_replace( 'http://', 'https://', $css );
	}

	$css = thz_remove_css_qs($css);
	return trim( $css );
}


/**
 * Remove query strings from CSS string
 * @return string
 */
function thz_remove_css_qs( $css ) {
	
	if( 'remove' == thz_get_theme_option('thzopt/remqs','donotremove')){
		
		$re = '%\?(.*)\)%U';
		
		preg_match_all($re, $css, $matches, PREG_SET_ORDER, 0);
		
		if(empty($matches)){
			
			return $css;
		}
		
		foreach($matches as $q){
			
			if( isset($q[0]) ){
				
				$clean 	= str_replace(array("'",')'),array('',''),$q[0]);
				$css 	= str_replace($clean, '', $css );
			}
			
		}	
		
		unset($matches);
	
	}
	
	return $css;
	
}


/**
 * Remove emoji chars from sting
 * @return string
 */	
function thz_remove_emoji($string){
   $string = str_replace( "?", "{%}", $string );
    $string  = mb_convert_encoding( $string, "ISO-8859-1", "UTF-8" );
    $string  = mb_convert_encoding( $string, "UTF-8", "ISO-8859-1" );
    $string  = str_replace( array( "?", "? ", " ?" ), array(""), $string );
    $string  = str_replace( "{%}", "?", $string );
    return trim( $string );
}


/**
 * Print code
*/
function thz_print_codes($hook,$echo = false){
	
	$code = thz_get_theme_option($hook,null);
	
	if($code !=''){
		
		if (strpos($hook, 'css') !== false) {
			
			$code = thz_remove_empty_lines(wp_strip_all_tags($code));
			
		}else{
			
			$code = $code."\n";
		}
		
		if($echo){
			echo $code;
		}else{
			return $code;
		}
	}
}

/**
 * Protect email
*/
function thz_protect_email ($email,$mailto = false){
	 
	 if ( thz_core() ) {
		 
		 return thz_core_protect_email ( $email,$mailto );
		 
	 }else{
		 
		 $mailto = $mailto ? 'mailto:' :'';
		 $link = $mailto.$email;
		 if($link !=''){
			return $link;
		 }		 
		 
	 }
}


/**
 * Generate random unique md5
 */
function thz_rand_md5() {
	return md5(time() .'-'. uniqid(rand(), true) .'-'. mt_rand(1, 1000));
}

/**
 * Cleanup html
 */
function thz_clean_html($content,$allowjs = false) {
    
    $search = array(
        '@<.*?<body.*?>@si',
        '@<\/body.*?>@si',
        '@<\/html.*?>@si',
        '@<![\s\S]*?--[ \t\n\r]*>@'
    );
	
	if(!$allowjs){
		
		$search[] = '@<script[^>]*?>.*?</script>@si';
		
	}
    
    $content = preg_replace($search, '', $content);
    return $content;
}


/**
 * Cleanup string from spaces and special chars
 */
function thz_clean_string($string) {
	
   // Replace spaces with hyphens.
   $string = str_replace(' ', '-', $string); 

   return preg_replace('/[^A-Za-z0-9\-]/', '', $string);
}
/**
 * Wrap words in tags
 *
 * @param  $words string|array
 * @param  $tag   default span
 * @param  $separator default space
 * @param  $class default thz-word-split
 * @return string
 */
 
function thz_words_to_tags($words,$tag = 'span', $separator = ' ',$class = 'thz-word-split') {
	
	if( empty( $words ) ){
		return $words;
	}
	
	if( !is_array($words) ){
		$words = strip_tags($words);
		$words = explode(' ', $words);
	}
	
	$new_words 	= array();
	$counter 	= 0;
	
	foreach($words as $word){
		$new_words[]= '<'.$tag.' class="'.$class.' split'.(++$counter).'">'.$word.'</'.$tag.'>';
	}
	
	unset( $words );
	
	return implode( $separator,$new_words );	
}


class ThzShortcodeOptions {
	
	
	public function __construct($id,$shortcode_id,$shortcode_type) {
		
		
		$this->id = $id;
		$this->shortcode_id = $shortcode_id;
		$this->shortcode_type = $shortcode_type;
		$this->result = null;
		
		
		$this->parse();
		
	}

	public function get_result () {
		return $this->result;
	}

	private function parse() {
		$json = $this->read_json();
		$this->parse_options($json);
	}
	
	private function read_json () {
		
		$json = fw_get_db_post_option($this->id,'page-builder/json');
		$json = json_decode($json,true);
		return $json;
	}

	private function parse_options($json) {
		
		if(!is_array($json) || empty($json)){
			return;
		}		
		
		foreach ( $json as $item ) {
			
			if(empty($item)){
				continue;
			}
			
			if('contact-form' === $item['type'] ){
				continue;
			}

			if ( 'column' === $item['type'] || 'innercolumn' === $item['type'] ) {
				
				$this->parse_options($item['_items']);
				
			} elseif ( 'section' === $item['type'] || 'sections-slider'=== $item['type']  ) {
				
				$this->parse_options($item['_items']);
				
			} else {
				
				$this->parse_options_simple($item);
			}
		}
	}

	private function parse_options_simple($item) {
		
		if(!isset($item['shortcode'])){
		 	return;	
		}
		
		if (
			$item['shortcode'] === $this->shortcode_type && 
			$item['atts']['id'] === $this->shortcode_id
		) {
			$this->result = $item['atts'];
		}
	}
}


/**
 * @package      YJSG Framework
 * @copyright    Copyright(C) since 2007  Youjoomla.com. All Rights Reserved.
 * @author       YouJoomla
 * @license      http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 * @websites     http://www.youjoomla.com | http://www.yjsimplegrid.com
 */
class ThzBrowser {
    
	
	
	public $useragent 		= '';
    public $Name 			= '';
    public $Version 		= '';
    public $isMobile 		= false;
    public $isIphone 		= false;
    public $isIpad 			= false;
    public $isIpod 			= false;
	public $isBlackBerry 	= false;
    public $isiOS 			= false;
    public $isAndroidOS 	= false;
    public $isBlackBerryOS 	= false;
	public $isWinOS 		= false;
	
	
	
    public function __construct() {
		
        if (isset($_SERVER['HTTP_USER_AGENT'])) {
            $this->useragent = strtolower($_SERVER['HTTP_USER_AGENT']);
            $this->getBrowsers();
            $this->setVars();
        }
		
    }
	
    /**
     * Get browsers
     *
     * @return  Name
	 * @return  Version
     *
     * @since   2.0.0
     */	
	
    public function getBrowsers() {
        $getBrowsers = array(
            "firefox",
			"edge",
            "msie",
			"opr",
            "opera",
            "chrome",
            "safari",
			"trident",
            "mozilla",
            "seamonkey",
            "konqueror",
            "netscape",
            "gecko",
            "navigator",
            "mosaic",
            "lynx",
            "amaya",
            "omniweb",
            "avant",
            "camino",
            "flock",
            "aol"
        );
		
        foreach ($getBrowsers as $browser) {
			
            if (preg_match("#($browser)[/ ]?([0-9.]*)#", $this->useragent, $match)) {
                $this->Name    = $match[1];
                $this->Version = $match[2];
                break;
            }
        }
    }
	
    /**
     * Set variables
     *
     * @return  Variable bool true
     *
     * @since   2.0.0
     */	
	 	
    public function setVars() {
		
		
        $getStrings = array(
		
            'isMobile' 			=> 'mobile|tablet',
            'isIphone' 			=> 'iphone',
            'isIpad' 			=> 'ipad',
            'isIpod' 			=> 'ipod',
            'isBlackBerry' 		=> 'playbook|rim tablet|blackberry|bb10|rim[0-9]+',
            'isiOS' 			=> 'mac os',
            'isAndroidOS' 		=> 'android',
            'isBlackBerryOS' 	=> 'rim tablet os',
			'isWinOS' 			=> 'windows'
			
        );
		
		
        foreach ($getStrings as $key => $pattern) {
            if (preg_match('/' . $pattern . '/', $this->useragent, $matches)) {
                $this->$key = true;
            }
        }
		
		
    }
	
    /**
     * backwards compatibility
     * @since   2.0.0
     */	
    public function isMobile() {
        return $this->isMobile;
    }
    public function isIphone() {
        return $this->isIphone;
    }
    public function isIpad() {
        return $this->isIpad;
    }
    public function isIpod() {
        return $this->isIpod;
    }
    public function isBlackBerry() {
        return $this->isBlackBerry;
    }
    public function isiOS() {
        return $this->isiOS;
    }
    public function isAndroidOS() {
        return $this->isAndroidOS;
    }
    public function BlackBerryOS() {
        return $this->BlackBerryOS;
    }
}


/**
 * Get header response
 * @$url | request uri
 * @$header | specific header key
 * @return bool|string|array
 */
 
if ( ! function_exists( 'thz_get_response_headers' ) ){
	
	function thz_get_response_headers( $url, $header = false ) {
		
		$request 	= new WP_Http;
		$response 	= $request->head( $url );

		if ( is_wp_error( $response ) || ! isset( $response['headers'] ) ) {
			
			return false;
			
		}

		if( $header ){
			
			if( isset( $response['headers'][ $header ] ) ){
				
				return $response['headers'][$header];
				
			}else{
				
				return false;
				
			}
			
		}else{
			
			return $response['headers'];
		}
		
		return false;
		
	}
}


/**
 * Parse page
 */
if ( ! function_exists( 'thz_parse_page' ) ){
	
	function thz_parse_page($atts = array()) {
		
		if(!class_exists('Parsedown')){
			
			return esc_html__('Missing Parsedown class','creatus');
		}
		
		$id 		= isset($atts['id']) ? $atts['id'] : false;
		$url 		= isset($atts['url']) ? str_replace(' ', '%20', $atts['url']) : false;
		$days 		= isset($atts['days']) ? $atts['days'] : -1;
		$hours  	= isset($atts['hours']) ? $atts['hours'] : 0;
		$auto  		= isset($atts['auto']) ? $atts['auto'] : 'active';
		$markdown 	= isset($atts['markdown']) ? $atts['markdown'] : false;
		$mdengine 	= isset($atts['mdengine']) ? $atts['mdengine'] : 'parsedownextra';
		$add_name 	= isset($atts['add_name']) ? preg_replace('/[^A-Za-z0-9\-]/', '', $atts['add_name']) : '';
		$escaped 	= isset($atts['escaped']) ? $atts['escaped'] : true;
		
		if(!$url || !$id){
			
			return esc_html__('Missing URL or ID. Check shortcode setting','creatus');
		}
		
		$day  			= 24 * 3600;
		$hour 			= 60 * 60 * $hours;
		$cachetime 		= ($day * $days) + ( $hour * $hours);	
		$modified   	= get_post_modified_time();	
		$option_name	= 'thz-parse-page-'.sanitize_title_with_dashes( $id.get_the_title() );
		$parsed_page 	= $days == -1 ? get_option( $option_name ) : get_transient( $option_name );
		
		if( 'active' == $auto){
			
			$etag = thz_get_response_headers( $url, 'etag' );

			if( isset($etag) && isset( $parsed_page['etag'] ) && ( $etag != $parsed_page['etag'] ) ){
				
				delete_option( $option_name );
				delete_transient( $option_name );
				
				$parsed_page =  false;
			}
		
		}
	
		if( isset( $parsed_page['time'] ) && ( $modified > $parsed_page['time'] ) ){
			
			delete_option( $option_name );
			delete_transient( $option_name );
			
			$parsed_page =  false;
		}

		if( false === $parsed_page ) {
			 
			$response	= wp_remote_get( $url, array( 'timeout' => 20) );
			$httpCode   = wp_remote_retrieve_response_code( $response ) ;
			$rEtag		= wp_remote_retrieve_header( $response, 'etag' );
			
			if ($httpCode >= 200 && $httpCode < 300) {
				
				$content = wp_remote_retrieve_body( $response ) ;
				
				if(!$content){
					
					$parsed_page = array(
						
						'etag' => false,
						'time' => $modified,
						'content' =>  esc_html__('Missing page response content','creatus'),
					
					);
					
				}
				
				if($markdown){
					
					if('parsedownextra' == $mdengine){
						
						$Parsedown 	= new ParsedownExtra();
						
					}else{
						
						$Parsedown 	= new Parsedown();
					}
					
					$Parsedown->setMarkupEscaped($escaped);
					
					$content 	= $Parsedown->text($content);
					
				}
				
				$content = apply_filters( 'thz_filter_shortcode_parse_page', $content );
				
				$parsed_page =  array(
					
					'etag' => $rEtag,
					'time' => $modified,
					'content' => $content
				
				);
				
				if($days == -1){
					
					update_option( $option_name, $parsed_page );
				
				}else{
					
					set_transient( $option_name, $parsed_page, apply_filters( 'thz_parse_page_cache_time', $cachetime ) ); 
				
				}
							
			}else{
				
				$parsed_page = array(
					
					'etag' => false,
					'time' => $modified,
					'content' => esc_html__('Error processing url response is empty error code','creatus')  .' '. $httpCode,
				
				);
				
			}

			
		}

		
		return do_shortcode( $parsed_page['content'] );

	}
}

/**
 * Merge 2 arrays on specific position
 * and keep array indexes
 */
function thz_array_insert($array,$values,$offset) {
    return array_slice($array, 0, $offset, true) + $values + array_slice($array, $offset, NULL, true);  
}

/**
 * Order array by another array
 */
function thz_reorder_array($array,$order_by_array){
	
	if(empty($array) || empty($order_by_array)){
		return $array;
	}	
	
	$ordered_array = array();
	
	foreach ($order_by_array as $key) {
		
		if ( ! isset( $array[$key] ) ) {
			continue;
		}			
		
		$ordered_array[$key] = $array[$key] ;
	}
	
	unset($array,$order_by_array);
	return $ordered_array;

}



if ( ! function_exists( 'thz_render_view' ) ){
	/**
	 * Safe render a view and return html
	 * In view will be accessible only passed variables
	 * Use this function to not include files directly and to not give access to current context variables (like $this)
	 *
	 * @param string $file_path
	 * @param array $view_variables
	 * @param bool $return In some cases, for memory saving reasons, you can disable the use of output buffering
	 *
	 * @return string HTML
	 */
	function thz_render_view( $file_path, $view_variables = array(), $return = true ) {

		if ( ! is_file( $file_path ) ) {
			return '';
		}
		
		extract( $view_variables, EXTR_REFS );
		unset( $view_variables );
		if ( $return ) {
			ob_start();
			require $file_path;
			return ob_get_clean();
		} else {
			require $file_path;
		}
		
		return '';
	}
}

 /**
 * Time ago
 * @return string
 */
function thz_ago( $timestamp ){
	
	return human_time_diff( $timestamp, current_time('timestamp') ) . ' ago';
	
}
 /**
 * Time agi used by Twitter apps
 * @return string
 */
function thz_twitter_ago($timestamp){
	

	$format_time_array = explode(" ",$timestamp);
	$year = preg_grep("/^([0-9]{4})/", $format_time_array);
	$day = preg_grep("/^([0-9]{2})/", $format_time_array);
	$time = preg_grep("/^([0-9]{2}:[0-9]{2}:[0-9]{2})/", $format_time_array);
	$time = array_values($time);
	$time_array = explode(":",$time[0]);
	$month = preg_grep("/^([a-zA-Z]{3})/", $format_time_array);
	switch($month[1]){
		case 'Jan':
			$month_nr = 1;
		break;
		case 'Feb':
			$month_nr = 2;
		break;
		case 'Mar':
			$month_nr = 3;
		break;
		case 'Apr':
			$month_nr = 4;
		break;
		case 'May':
			$month_nr = 5;
		break;
		case 'Jun':
			$month_nr = 6;
		break;
		case 'Jul':
			$month_nr = 7;
		break;
		case 'Aug':
			$month_nr = 8;
		break;
		case 'Sep':
			$month_nr = 9;
		break;
		case 'Oct':
			$month_nr = 10;
		break;
		case 'Nov':
			$month_nr = 11;
		break;																					
		case 'Dec':
			$month_nr = 12;
		break;
		default :
			$month_nr = 1;
		break;
	}
	
	// Evaluate how much difference there is between local and GTM/UTC
	// Don't forget to correct for daylight saving time...
	$aNow = localtime();
	$iDelta = gmmktime(1, 1, 1, 1, 1, 1970) - mktime(1, 1, 1, 1, 1, 1970);
	
	$timestamp = mktime($time_array[0], $time_array[1], $time_array[2], $month_nr, $day[2], $year[5]);
	$difference = time() - ($timestamp + $iDelta);
	//if difference in smaller than 0 sec put the difference to 1 second
	if($difference <= 0){
		$difference = 1;
	}
	$periods = array("second", "minute", "hour", "day", "week", "month", "year");
	$lengths = array("60","60","24","7","4.35","12","10");
	for($j = 0; $difference >= $lengths[$j]; $j++){
		$difference /= $lengths[$j];
	}
	
	//$difference = floor($difference);
	$difference = round($difference);   
	if($difference != 1) $periods[$j].= "s";
	$text = "$difference $periods[$j] ".esc_html__( 'ago', 'creatus' );
	
	return $text;
}

 /**
 * Prints separator
 * @return string
 */
function thz_get_separator ($atts,$class){
	
	
	if(!is_array($atts)){
		
		return '<span class="thz-bad-separator">?</span>';
		
	}
	
	$type 	= thz_akg('ty',$atts,'textual'); 
	$out 	= $type =='icon' ? thz_akg('i',$atts,null): thz_akg('t',$atts,null);
	$space 	= thz_akg('s',$atts,5);
	$fsize 	= thz_akg('fs',$atts,'');  
	$nudge	= (int) thz_akg('n',$atts,0); 
	
	
	
	$class .= ' thz-separator-'.$type;
	
	if($fsize !== '' ){
		
		$class .= ' thz-fs-'.$fsize;
		
	}
	
	if($nudge !== 0 ){
		
		$class .= ' thz-ngv-'.str_replace('-','n',$nudge);
		
	}
	
	if($type == 'icon'){
		$separator = '<span class="'.$class.' '.esc_attr($out).' thz-pl-'.$space.' thz-pr-'.$space.'"></span>';
	}else{
		$separator = '<span class="'.$class.' thz-pl-'.$space.' thz-pr-'.$space.'">'.esc_attr($out).'</span>';
	}
	
	return $separator;	
	
}


 /**
 * List of hover effects
 * @return array
 */
 
if ( ! function_exists( '_thz_hover_list' ) ) {
	function _thz_hover_list(){
		
		$defaults = array(
			'thz-hover-none' => esc_html__('None', 'creatus'),
			'thz-hover-fadein' => esc_html__('Fade in', 'creatus'),
			'thz-hover-scalein' => esc_html__('Scale in', 'creatus'),
			'thz-hover-scaleout' => esc_html__('Scale out', 'creatus'),
			'thz-hover-spin' => esc_html__('Spin', 'creatus'),
			'thz-hover-spin-right' => esc_html__('Spin right', 'creatus'),
			'thz-hover-spin-left' => esc_html__('Spin left', 'creatus'),
			'thz-hover-spin-top-left' => esc_html__('Spin top left', 'creatus'),
			'thz-hover-spin-top-right' => esc_html__('Spin top right', 'creatus'),
			'thz-hover-spin-bottom-right' => esc_html__('Spin bottom right', 'creatus'),
			'thz-hover-spin-bottom-left' => esc_html__('Spin bottom left', 'creatus'),
			'thz-hover-curtain' => esc_html__('Curtain', 'creatus'),
			'thz-hover-vertical-curtain' => esc_html__('Vertical curtain', 'creatus'),
			'thz-hover-from-top' => esc_html__('From top', 'creatus'),
			'thz-hover-from-right' => esc_html__('From right', 'creatus'),
			'thz-hover-from-bottom' => esc_html__('From bottom', 'creatus'),
			'thz-hover-from-left' => esc_html__('From left', 'creatus')
		);	
		
		return  $defaults;
		
	}
}

 /**
 * List of hover element effects
 * @return array
 */
 
if ( ! function_exists( '_thz_hover_element_list' ) ) {
	function _thz_hover_element_list(){
		
		$defaults = array(
			'thz-comein-none' => esc_html__('None', 'creatus'),
			'thz-comein-top' => esc_html__('Come in from top', 'creatus'),
			'thz-comein-right' => esc_html__('Come in from right', 'creatus'),
			'thz-comein-bottom' => esc_html__('Come in from bottom', 'creatus'),
			'thz-comein-left' => esc_html__('Come in from left', 'creatus')
		);	
		
		return  $defaults;
		
	}
}


 /**
 * List of transition durations
 * @return array
 */
 
if ( ! function_exists( '_thz_transition_duration_list' ) ) {
	
	function _thz_transition_duration_list(){
		
		$defaults = array(
			'thz-transease-01' => esc_html__('100ms', 'creatus'),
			'thz-transease-02' => esc_html__('200ms', 'creatus'),
			'thz-transease-03' => esc_html__('300ms', 'creatus'),
			'thz-transease-04' => esc_html__('400ms', 'creatus'),
			'thz-transease-05' => esc_html__('500ms', 'creatus'),
			'thz-transease-06' => esc_html__('600ms', 'creatus'),
			'thz-transease-07' => esc_html__('700ms', 'creatus'),
			'thz-transease-08' => esc_html__('800ms', 'creatus'),
			'thz-transease-09' => esc_html__('900ms', 'creatus'),
			'thz-transease-1' => esc_html__('1s', 'creatus'),
			'thz-transease-11' => esc_html__('1.1s', 'creatus'),
			'thz-transease-12' => esc_html__('1.2s', 'creatus'),
			'thz-transease-13' => esc_html__('1.3s', 'creatus'),
			'thz-transease-14' => esc_html__('1.4s', 'creatus'),
			'thz-transease-15' => esc_html__('1.5s', 'creatus'),
		);	
		
		return  $defaults;
		
	}
}


 /**
 * List of reveal effects
 * @return array
 */
 
if ( ! function_exists( '_thz_reveal_list' ) ) {
	
	function _thz_reveal_list( $reveal_none_txt = false ){
		
		$reveal_none = $reveal_none_txt ? $reveal_none_txt : esc_html__('No effect ( intro stays on hover )', 'creatus');
		
		$defaults = array(
		
			'thz-reveal-none' => $reveal_none,
			'thz-reveal-fadeout' => esc_html__('Fade out', 'creatus'),
			'thz-reveal-goleft' => esc_html__('Go left', 'creatus'),
			'thz-reveal-goleft-zoomout' => esc_html__('Go left zoom out', 'creatus'),
			'thz-reveal-goright' => esc_html__('Go right', 'creatus'),
			'thz-reveal-goright-zoomout' => esc_html__('Go right zoom out', 'creatus'),
			'thz-reveal-goup' => esc_html__('Go up', 'creatus'),
			'thz-reveal-goup-zoomout' => esc_html__('Go up zoom out', 'creatus'),
			'thz-reveal-godown' => esc_html__('Go down', 'creatus'),
			'thz-reveal-godown-zoomout' => esc_html__('Go down zoom out', 'creatus'),
			'thz-reveal-zoomout' => esc_html__('Zoom out', 'creatus'),
			'thz-reveal-zoomin' => esc_html__('Zoom in', 'creatus'),
			'thz-reveal-curtain' => esc_html__('Curtain', 'creatus'),
			'thz-reveal-curtain-vertical' => esc_html__('Curtain vertical', 'creatus'),
			'thz-reveal-swooshup' => esc_html__('Swoosh up', 'creatus'),
			'thz-reveal-swooshdown' => esc_html__('Swoosh down', 'creatus'),
			
		);	
		
		return  $defaults;
		
	}
}

/**
 * Animations list
*/
if ( ! function_exists( '_thz_animations_list' ) ) {
	
	function _thz_animations_list($draw = false){
		
		$defaults =	array(
			'thz-anim-fadeIn' => esc_html__('Fade in', 'creatus'),
			'thz-anim-slideIn-up' => esc_html__('Slide in from Bottom', 'creatus'),
			'thz-anim-slideIn-down' => esc_html__('Slide in from Top', 'creatus'),
			'thz-anim-slideIn-left' => esc_html__('Slide in from Right', 'creatus'),
			'thz-anim-slideIn-right' => esc_html__('Slide in from Left', 'creatus'),
			'thz-anim-zoomIn' => esc_html__('Zoom In', 'creatus'),
			'thz-anim-zoomOut' => esc_html__('Zoom Out', 'creatus'),
			'thz-anim-zoomIn-up' => esc_html__('Zoom in from Bottom', 'creatus'),
			'thz-anim-zoomIn-down' => esc_html__('Zoom in from Top', 'creatus'),
			'thz-anim-zoomIn-left' => esc_html__('Zoom in from Right', 'creatus'),
			'thz-anim-zoomIn-right' => esc_html__('Zoom in from Left', 'creatus'),
			'thz-anim-newspaper' => esc_html__('Newspaper', 'creatus'),
			'thz-anim-flipIn' => esc_html__('Flip In', 'creatus'),
			'thz-anim-unfold' => esc_html__('Unfold', 'creatus'),
			'thz-anim-spiral' => esc_html__('Spiral', 'creatus'),
		);
		if($draw){
			$defaults ['thz-anim-draw-svg'] = esc_html__('Drawing ( SVG stroke color only )', 'creatus');
		}
		return  $defaults;
	}
}


/**
 * Max width list
*/
if ( ! function_exists( '_thz_max_width_list' ) ) {
	
	function _thz_max_width_list(){
		
		$defaults =	array();
		
		for ($i = 20; $i <= 100; $i=$i+5) {
		  $defaults[$i] = 'Max width '.$i.'%';
		}
		
		return  $defaults;
	}
}


/**
 * Single containers classes
*/
if ( ! function_exists( 'thz_single_cmx' ) ) {
	
	function thz_single_cmx($option,$max = false, $echo = true){
		
		
		$location = thz_get_option($option.'/l',false);

		if( thz_has_sidebar() && ( !$location || 'inside' == $location ) ){
			return;
		}
		
		$has_builder = thz_has_builder() ? ' thz-has-builder' : '';
				
		if($max){
		
			$classes = ' thz-max-'.thz_get_option($option.'/m',100);
		
		}else{
			
			$classes 	= ' thz-cmx-container thz-container';
			$contained 	= thz_get_option($option.'/h','contained');

			if( 'full' == $contained ){
				
				$classes .= '-full';
			}
						
			if( 'contained' == $contained ){
				
				$classes .= ' thz-site-width';
			}		
			
			if( 'pdetails_mx' == $option && thz_has_builder() && 'notcontained' == $contained ){
				$classes ='';
			}
			
		}
		
		if($echo){
			
			echo $classes.$has_builder;
		
		}else{
			 
			return $classes.$has_builder;
			
		}
	}
}


/**
* Animations data and class
*/
function thz_print_animation($option,$class = false,$add_class = false){

	if(empty($option)) {
		return;
	}
	
	$animate 	= thz_akg('animate',  $option);
	$option_set	=  $option;
	
	if(isset($option[0])){
		$animate 		= 'active';
		$option_set 	= $option[0];
	}
	
	if($animate == 'inactive') {
		return;
	}

	$effect 		= thz_akg('effect',  $option_set);
	$duration 		= (int) thz_akg('duration',  $option_set,1000);	
	$delay 			= (int) thz_akg('delay', $option_set,0);
	$kba 			= thz_akg('kb/a', $option_set,'inactive');
	$data			= $animate == 'active' ? ' data-anim-effect="'.esc_attr( $effect ).'" data-anim-duration="'.esc_attr($duration).'" data-anim-delay="'.esc_attr( $delay ).'"' : '';
	
	
	if( 'active' == $kba && 'active' == $animate ){

		$kbe 	= thz_akg('kb/e', $option_set,'in');
		$kbd 	= (float) thz_akg('kb/d', $option_set,7);
			
		$data .= 'data-anim-kbe="'.esc_attr( $kbe ).'" data-anim-kbd="'.esc_attr($kbd).'"';
	}
	
	$add_class		= $add_class ? ' '.$add_class :'';
	$print_class	= $animate =='active' ? ' thz-animate'.$add_class : '';

	if($class){
		return esc_attr( $print_class );
	}	
	
	if(!empty($data)){
		return $data;
	}	
	
}



 /**
 * List of background shapes
 * @return array
 */
 
if ( ! function_exists( '_thz_background_shapes_list' ) ) {
	
	function _thz_background_shapes_list($id = ''){
		

		$shapes_path 	= get_template_directory().'/assets/images/shapes/';
		$svg_list 		= array();
		$noflips 		= array(
			'book',
			'circle',
			'curve',
			'curve-multiple',
			'fan',
			'mid-waves',
			'mid-waves-multiple',
			'small-waves',
			'small-waves-multiple',
			'small-zigzag',
			'spike',
			'triangle',
			'water-waves',
			'water-waves-multiple',
			'zigzag-multiple',
			'zigzag'
		);
		
		foreach (glob($shapes_path .'/*.svg') as $path) {
			
			$svg = preg_replace('/\.svg$/', '', basename($path));
			
			if(in_array($svg,$noflips)){

				$data = array(
					'data-disable' => '.'.$id.'-shape-flip-parent'
				);
							
			}else{
				
			
				$data = array(
					'data-enable' => '.'.$id.'-shape-flip-parent'
				);				
			}

			$name = str_replace('-',' ',$svg);
			$name = str_replace('stroke','',$name);
			$svg_array =  array();
			
			$svg_list [$svg] = array(
			
				'text' => ucfirst($name),
				'attr' => $data
			
			);

		}

		$custom_shapes =  apply_filters ('thz_filter_background_shapes_list',array(),$id);
		
		if(!empty($custom_shapes)){
			
			$svg_list = array_merge($svg_list, $custom_shapes);	
			
		}
		

		
		return  $svg_list;
		
	}
}

/**
 * Background positions list
*/
if ( ! function_exists( '_thz_bg_positions_list' ) ) {
	
	function _thz_bg_positions_list($class = false){
		
		$pfx = '';
		
		if($class){
			$pfx = 'thz-';
		}
		
		$defaults = array(
		
			$pfx.'left-top' =>  esc_html__('Left Top', 'creatus'),
			$pfx.'left-center' =>  esc_html__('Left Center', 'creatus'),
			$pfx.'left-bottom' =>  esc_html__('Left Bottom', 'creatus'),
			$pfx.'center-top' =>  esc_html__('Center Top', 'creatus'),
			$pfx.'center-center' =>  esc_html__('Center Center', 'creatus'),
			$pfx.'center-bottom' =>  esc_html__('Center Bottom', 'creatus')	,
			$pfx.'right-top' =>  esc_html__('Right Top', 'creatus'),
			$pfx.'right-center' =>  esc_html__('Right Center', 'creatus'),
			$pfx.'right-bottom' =>  esc_html__('Right Bottom', 'creatus'),
	
		
		);
		
		return $defaults;
	
	}

}


/**
 * Default responsive options
 * @return array use as 'option_name' => _thz_responsive_options()
*/
function _thz_responsive_options (){
	
	$responsive =  array(
	
		'type' => 'thz-multi-options',
		'label' => __('Responsive behavior', 'creatus'),
		'desc' => esc_html__('Show/hide element on specific devices', 'creatus'),
		'value' => array(
			'd' => 'show',
			't' => 'show',
			'm' => 'show',
		),
		'thz_options' => array(

			'd' => array(
				'type' => 'short-select',
				'title' => esc_html__('Desktop', 'creatus'),
				'choices' => array(
					'show' => esc_html__('Show', 'creatus'),
					'thz-desktop-hidden' => esc_html__('Hide', 'creatus'),
				),
			),
			't' => array(
				'type' => 'short-select',
				'title' => esc_html__('Tablets', 'creatus'),
				'choices' => array(
					'show' => esc_html__('Show', 'creatus'),
					'thz-tablet-hidden' => esc_html__('Hide', 'creatus'),
				),
			),
			'm' => array(
				'type' => 'short-select',
				'title' => esc_html__('Mobiles', 'creatus'),
				'choices' => array(
					'show' => esc_html__('Show', 'creatus'),
					'thz-mobile-hidden' => esc_html__('Hide', 'creatus'),
				),
			),

		)
			
		
	);
	
	return 	 $responsive;
	
}


/**
 * Default items filter options
 * @return array 
 * @default  show/hide
*/
if ( ! function_exists( '_thz_items_filter_options' ) ){
	
	function _thz_items_filter_options( $default = 'show' ){
		
		$options = array(
		
			'type' => 'multi-picker',
			'label' => false,
			'desc' => false,
			'show_borders' => true,
			'picker' => array(
				'picked' => array(
					'label' => __('Show filter', 'creatus'),
					'desc' => esc_html__('Show/hide sorting filter.', 'creatus'),
					'type' => 'switch',
					'right-choice' => array(
						'value' => 'hide',
						'label' => __('Hide', 'creatus')
					),
					'left-choice' => array(
						'value' => 'show',
						'label' => __('Show', 'creatus')
					),
					'value' => $default
				)
			),
			'choices' => array(
				'show' => array(
					'filter_bs' => array(
						'type' => 'thz-box-style',
						'label' => __('Filter box style', 'creatus'),
						'preview' => true,
						'desc' => esc_html__('Adjust .thz-posts-filter box style', 'creatus'),
						'button-text' => esc_html__('Customize filter box style', 'creatus'),
						'popup' => true,
						'disable' => array(
							'video'
						),
						'value' => array(
							'margin' => array(
								'top' => 0,
								'right' => 0,
								'bottom' => 30,
								'left' => 0
							)
						)
					),
					'fm' => array(
						'type' => 'thz-multi-options',
						'label' => __('Filter link metrics', 'creatus'),
						'desc' => esc_html__('Adjust filter link metrics.', 'creatus'),
						'value' => array(
							'at' => 'All',
							'ta' => 'left',
							'vp' => 0,
							'hp' => 0,
							'mr' => 15,
							'br' => 0
						),
						'thz_options' => array(
							'at' => array(
								'type' => 'short-text',
								'title' => esc_html__('All text', 'creatus'),
							),
							'ta' => array(
								'type' => 'short-select',
								'title' => esc_html__('Links position', 'creatus'),
								'choices' => array(
									'left' => esc_html__('Left', 'creatus'),
									'right' => esc_html__('Right', 'creatus'),
									'center' => esc_html__('Center', 'creatus')
								)
							),
							'vp' => array(
								'type' => 'spinner',
								'title' => esc_html__('Padding-v', 'creatus'),
								'addon' => 'px'
							),
							'hp' => array(
								'type' => 'spinner',
								'title' => esc_html__('Padding-h', 'creatus'),
								'addon' => 'px',
								'min' => 0
							),
							'mr' => array(
								'type' => 'spinner',
								'title' => esc_html__('Side space', 'creatus'),
								'addon' => 'px',
								'min' => -500
							),
							'br' => array(
								'type' => 'spinner',
								'title' => esc_html__('Border radius', 'creatus'),
								'addon' => 'px'
							)
						)
					),
					'fl' => array(
						'type' => 'thz-multi-options',
						'label' => __('Filter link style', 'creatus'),
						'desc' => esc_html__('Adjust filter links style. Hovered link takes properties from active link.', 'creatus'),
						'value' => array(
							'ac' => '',
							'ab' => '',
							'hc' => '',
							'hb' => ''
						),
						'thz_options' => array(
							'ac' => array(
								'type' => 'color',
								'title' => esc_html__('Active color', 'creatus'),
								'box' => true
							),
							'ab' => array(
								'type' => 'color',
								'title' => esc_html__('Active background', 'creatus'),
								'box' => true
							),
							'hc' => array(
								'type' => 'color',
								'title' => esc_html__('Inactive color', 'creatus'),
								'box' => true
							),
							'hb' => array(
								'type' => 'color',
								'title' => esc_html__('Inactive background', 'creatus'),
								'box' => true
							)
						)
					),
					'ff' => array(
						'label' => __('Filter font', 'creatus'),
						'desc' => esc_html__('Filter links font metrics', 'creatus'),
						'type' => 'thz-typography',
						'value' => array(
							'weight'     => 600,
							'transform' => 'uppercase',
							'size' => 13,
						),
						'disable' => array('color','hovered','align'),
					)
				)
			)		
		
		);
		
		return $options;
		
	}

}

/**
 * Default container metrics 
 * @return array use as 'cmx' => _thz_container_metrics_defaults()
*/
function _thz_container_metrics_defaults ($element = false){
	
	$cmx =  array(
	
		'type' => 'thz-multi-options',
		'label' => __('Container metrics', 'creatus'),
		'desc' => esc_html__('Add custom class or ID to HTML container and adjust visibility on specific devices.', 'creatus'),
		'value' => array(
			'i' => '',
			'c' => '',
			'd' => 'show',
			't' => 'show',
			'm' => 'show',
		),
		'thz_options' => array(
			'i' => array(
				'type' => 'short-text',
				'title' => esc_html__('Custom ID', 'creatus'),
			),
			'c' => array(
				'type' => 'short-text',
				'title' => esc_html__('Custom class', 'creatus'),
			),
			'd' => array(
				'type' => 'short-select',
				'title' => esc_html__('Desktop', 'creatus'),
				'choices' => array(
					'show' => esc_html__('Show', 'creatus'),
					'thz-desktop-hidden' => esc_html__('Hide', 'creatus'),
				),
			),
			't' => array(
				'type' => 'short-select',
				'title' => esc_html__('Tablets', 'creatus'),
				'choices' => array(
					'show' => esc_html__('Show', 'creatus'),
					'thz-tablet-hidden' => esc_html__('Hide', 'creatus'),
				),
			),
			'm' => array(
				'type' => 'short-select',
				'title' => esc_html__('Mobiles', 'creatus'),
				'choices' => array(
					'show' => esc_html__('Show', 'creatus'),
					'thz-mobile-hidden' => esc_html__('Hide', 'creatus'),
				),
			),
		)	
		
	);
	
	if( $element && 'section'== $element ){
		
		$cmx['value']['b'] = 'none';
		$cmx['thz_options']['b'] = array(
			'type' => 'short-select',
			'title' => esc_html__('Brightness', 'creatus'),
			'choices' => array(
				'light' => esc_html__('Light', 'creatus'),
				'dark' => esc_html__('Dark', 'creatus'),
				'none' => esc_html__('Do not use', 'creatus'),
			)
		);
		$cmx['desc'] = esc_html__('Add custom class or ID to HTML container and adjust visibility on specific devices. See help for more info.', 'creatus');
		$cmx['help'] = esc_html__('The brightness option will add thz-section-light or thz-section-dark class name to the body container when this section is in the view port. This way you can do additional CSS styling based on the section brihtness.', 'creatus');
		
	}

	return 	 $cmx;
	
}


/**
 * Default container parallax 
 * @return array use as 'cpx' => _thz_container_parallax_default()
*/
function _thz_container_parallax_default ( $swith_class = 'px-opt' ){
	
	$cpx =  array(
		'type' => 'thz-multi-options',
		'label' => __('Container parallax', 'creatus'),
		'desc' => esc_html__('Activate/deactivate container parallax.', 'creatus'),
		'value' => array(
			'p' => 'inactive',
			'd' => 'up',
			'v' => 5,
			'm' => 0,
		),
		'thz_options' => array(
			'p' => array(
				'type' => 'short-select',
				'title' => esc_html__('Mode', 'creatus'),
				'attr' => array(
					'class' => 'thz-select-switch',
				),
				'choices' => array(
					'active' => array(
						'text' => esc_html__('Active', 'creatus'),
						'attr' => array(
							'data-enable' => '.'.$swith_class.'-parent'
						)
					),
					'inactive' => array(
						'text' => esc_html__('Inactive', 'creatus'),
						'attr' => array(
							'data-disable' => '.'.$swith_class.'-parent'
						)
					)
				),
			),
			'd' => array(
				'type' => 'short-select',
				'title' => esc_html__('Direction', 'creatus'),
				'attr' => array(
					'class' => $swith_class,
				),
				'choices' => array(
					'up' => esc_html__('Up', 'creatus'),
					'down' => esc_html__('Down', 'creatus'),
					'left' => esc_html__('Left', 'creatus'),
					'right' => esc_html__('Right', 'creatus'),
				),
			),
			'v' => array(
				'type' => 'spinner',
				'title' => esc_html__('Speed', 'creatus'),
				'addon' => 'v',
				'min' => 1,
				'step' => 1,
				'max' => 100,
				'attr' => array(
					'class' => $swith_class,
				),
			),
			'm' => array(
				'type' => 'short-select',
				'title' => esc_html__('Parallax on mobile', 'creatus'),
				'attr' => array(
					'class' => $swith_class,
				),
				'choices' => array(
					1 => esc_html__('Active', 'creatus'),
					0 => esc_html__('Inactive', 'creatus'),
				),
			),
		)	
		
	);
	
	return 	 $cpx;
	
}

/**
 * Default media parallax 
 * @return array use as 'mpx' => _thz_media_parallax_default()
*/
function _thz_media_parallax_default ( $swith_class = 'mpx-opt' , $specific  =  true){
	
	$mpx =  array(
		'type' => 'thz-multi-options',
		'label' => __('Media parallax', 'creatus'),
		'desc' => esc_html__('Activate/deactivate media parallax.  See help for more info.', 'creatus'),
		'help' => esc_html__('This effect works for images only and it does NOT work if media height is auto! To parallax media for specific items only, add specific items in the order that you see them separated by comma like; 1,5,7. This would parallax media for 1st 5th and 7th item.', 'creatus'),
		'value' => array(
			'p' => 'inactive',
			'd' => 'up',
			'v' => 5,
			'm' => 0,
			's' => '',
		),
		'breakafter' => array('m'),
		'thz_options' => array(
			'p' => array(
				'type' => 'short-select',
				'title' => esc_html__('Mode', 'creatus'),
				'attr' => array(
					'class' => 'thz-select-switch',
				),
				'choices' => array(
					'active' => array(
						'text' => esc_html__('Active', 'creatus'),
						'attr' => array(
							'data-enable' => '.'.$swith_class.'-parent'
						)
					),
					'inactive' => array(
						'text' => esc_html__('Inactive', 'creatus'),
						'attr' => array(
							'data-disable' => '.'.$swith_class.'-parent'
						)
					)
				),
			),
			'd' => array(
				'type' => 'short-select',
				'title' => esc_html__('Direction', 'creatus'),
				'attr' => array(
					'class' => $swith_class,
				),
				'choices' => array(
					'up' => esc_html__('Up', 'creatus'),
					'down' => esc_html__('Down', 'creatus'),
					'left' => esc_html__('Left', 'creatus'),
					'right' => esc_html__('Right', 'creatus'),
				),
			),
			'v' => array(
				'type' => 'spinner',
				'title' => esc_html__('Speed', 'creatus'),
				'addon' => 'v',
				'min' => 1,
				'step' => 1,
				'max' => 100,
				'attr' => array(
					'class' => $swith_class,
				),
			),
			'm' => array(
				'type' => 'short-select',
				'title' => esc_html__('Parallax on mobile', 'creatus'),
				'attr' => array(
					'class' => $swith_class,
				),
				'choices' => array(
					1 => esc_html__('Active', 'creatus'),
					0 => esc_html__('Inactive', 'creatus'),
				),
			),
			's' => array(
				'type' => 'text',
				'title' => esc_html__('Specific items', 'creatus'),
				'attr' => array(
					'class' => $swith_class,
				),
			),
		)	
		
	);
	
	if(!$specific){
		$mpx['help'] = esc_html__('This effect does NOT work if media height is auto.', 'creatus');
		unset($mpx['value']['s'],$mpx['thz_options']['s']);
	}
	
	return 	 $mpx;
	
}

/**
* Container parallax data and class
*/
function thz_print_cpx($data,$class = false,$custom_class = false){

	if(empty($data)) {
		return;
	}


	$active 	= isset($data[0]) ? 'active' : thz_akg('p',  $data,'inactive');
	
	if('active' == $active ){
		
		if($class){
			
			return $custom_class ? ' '.$custom_class : ' thz-cpx';
			
		}else{
			
			$data		= isset($data[0]) ? $data[0]['p'] : $data;
			
			$direction 	= thz_akg('d',  $data,'up');
			$velocity 	= thz_akg('v',  $data, 5);
			$onmobile 	= thz_akg('m',  $data, 0);
			
			$data_att  = ' data-thzplx-direction="'.esc_attr( $direction ).'"';
			$data_att .= ' data-thzplx-velocity="'.esc_attr( $velocity ).'"';
			$data_att .= ' data-thzplx-onmobile="'.esc_attr( $onmobile ).'"';
			
			return $data_att;
		
		}
		
	}

}

/**
* Media parallax output
*/
function thz_print_mpx($data,$custom_class = false){
	
	if(empty($data)) {
		return;
	}

	$active 	= isset($data[0]) ? 'active' : thz_akg('p',  $data,'inactive');
	
	if('active' == $active ){
			
		$data		= isset($data[0]) ? $data[0]['p'] : $data;
		
		$direction 	= thz_akg('d',  $data,'up');
		$velocity 	= thz_akg('v',  $data, 5);
		$onmobile 	= thz_akg('m',  $data, 0);
		
		$data_att  = ' data-thzplx-direction="'.esc_attr( $direction ).'"';
		$data_att .= ' data-thzplx-velocity="'.esc_attr( $velocity ).'"';
		$data_att .= ' data-thzplx-onmobile="'.esc_attr( $onmobile ).'"';
		
		$custom_class = $custom_class ? ' '.$custom_class : '';
		
		$mcpx_html = '<div class="thz-media-cpx-holder'.$custom_class.'">';
		$mcpx_html .= '<div class="thz-media-cpx"'.$data_att.'></div>';
		$mcpx_html .= '</div>';
		
		return $mcpx_html;
	}

}


/**
 * Print responsive classes
 * @return string
*/
function _thz_responsive_classes ($cmx,$unset = array()){
	
	if(!is_array($cmx)){
		return;
	}
	
	if(!empty($unset)){
		foreach($unset as $u){
			unset($cmx[$u]);
			unset($u);
		}
		unset($unset);
	}
	
	unset($cmx['i'],$cmx['c']);
	
	$add_class = '';
	
	$devices = array();
	
	foreach ($cmx as $device){

		if($device != 'show' ){
			$add_class .= ' '.$device;
		}
		
	}
	
	unset($cmx,$device);

	if($add_class !=''){
		return $add_class;
	}
	
}


/**
 * Rename input name="?"  to data-value-name="?"
 * so that it is not sent via post
*/
function  _thz_remove_name_from_option($html, $return = false){
	
	preg_match('/name="(.*)"/U',$html,$name);
	
	if(isset($name[0])){
		
		$new_name = str_replace('name','data-value-name',$name[0]);
		$html = str_replace($name[0],$new_name,$html);
	}
	
	if($return){
		return $html;
	}
	
	echo $html;
	
}

/**
 * Print simple notification
 * @return string
*/
function thz_notify($color_class ='blue',$title = '',$msg ='',$echo = true){
	
	$html ='<div class="thz-notification thz-notification-'.thz_sanitize_class( $color_class ).' thz-text-left">';
	$html .='<div class="thz-notification-box">';
	$html .='<div class="thz-notification-text">';
	if($title !=''){
		$html .='<h3 class="thz-notification-title">';
		$html .= $title;
		$html .='</h3>';
	}
	$html .= $msg;
	$html .='</div>';
	$html .='</div>';
	$html .='</div>';
	
	if($msg !='' ){
		if($echo){
			
			echo $html;
			
		}else{
			
			return $html;
		}
	}
}


/**
 * Build text-shadow options array from string
 * @return array
*/
function _thz_build_shadows($value){
	
	if(is_array($value)){
		return $value;
		
	}
	if($value ==''){
		return array();
	}
	
	$value = str_replace(array('text-shadow:',';'),'',$value);
	
	
	$value = explode(', ',$value);
	$shadows = array();
	
	foreach( $value as $key => $shadow){
		
		$split = explode(' ',$shadow);
		
		$shadows[$key]['h'] = str_replace('px','',$split[0]);
		$shadows[$key]['v'] = str_replace('px','',$split[1]);
		$shadows[$key]['b'] = str_replace('px','',$split[2]);
		$shadows[$key]['c'] = $split[3];
	
		unset($shadow);
	}
	
	unset($value);
	
	if(!empty($shadows)){
		return $shadows;
	}
}


/**
 * Print text-shadow css from text-shadow array
 * @return string
*/
function _thz_print_shadows($value){
	
	if(!is_array($value)){
		return 	$value;
	}
	
	$shadows = array();
	
	if( !empty($value) ){
		
		foreach( $value as $key => $shadow_val){
			
			$shadow_val['h'] = str_replace($shadow_val['h'],$shadow_val['h'].'px',$shadow_val['h']);
			$shadow_val['v'] = str_replace($shadow_val['v'],$shadow_val['v'].'px',$shadow_val['v']);
			$shadow_val['b'] = str_replace($shadow_val['b'],$shadow_val['b'].'px',$shadow_val['b']);
			
			$shadows[$key] = implode(' ',$shadow_val);
			unset($shadow_val);
		}
		unset($value);
		
		return 'text-shadow:'.implode(', ',$shadows).';';
	}
	
}

/**
 * Replace p with br
 * @return string
*/
function thz_p2br($string){
	
	// replace all p's with br
	$string 	= preg_replace('#<p(.*?)>(.*?)</p>#is', '$2<br/>', $string);
	
	// remove br at the end of the string
	$string 	= preg_replace('/<br\/>$/', '', $string);
	
	return $string ;	
}


/**
 * Get hotspots css or html
 * @return string
*/
function thz_get_hotspots($globals = array(),$css = false,$parentid = false){
	
	$html 		= '';
	$add_css 	= '';
	$hotspots	= isset($globals['hotspots']) ? $globals['hotspots'] : false;
	
	if(!$hotspots){
		return;
	}
	
	$mark 		= isset($globals['mark']) ? $globals['mark'] : 'numerical';
	$size 		= isset($globals['size']) ? $globals['size'] : 'default';
	$icon 		= isset($globals['icon']) ? $globals['icon'] : 'fa fa-star';  
	$animate 	= isset($globals['animate']) ? $globals['animate'] : null;
	
	foreach ( $hotspots as $hotspot){ 
				
		$hid 		= thz_akg('id',$hotspot);
		$left		= thz_akg('left',$hotspot);
		$top		= thz_akg('top',$hotspot); 
		$tip_class	= array('thz-hotspot-tip');
		$hs_class	= array('thz-hotspot');
		$hs_class[] = 'hs-'.$hid;
		
		
		if($css && $parentid){

			$cbg 		= thz_akg('mx/bg',$hotspot);
			$cmark 		= thz_akg('mx/mark',$hotspot);
			$chalo 		= thz_akg('mx/halo',$hotspot);
			
			$add_css	.= $parentid.' .hs-'.$hid.'{';
			$add_css	.='left:'.$left.'%;';
			$add_css	.='top:'.$top.'%;';
			$add_css	.='}';
			
			
			if($cbg !='' || $cmark !=''){
	
				$add_css	.= $parentid.' .hs-'.$hid.' .thz-hotspot-mark{';
				if($cbg !=''){
					$add_css	.='background:'.$cbg.';';
				}
				if($cmark !=''){
					$add_css	.='color:'.$cmark.';';
				}
				$add_css	.='}';
				
			}
			if($chalo !=''){
				$add_css	.= $parentid.' .hs-'.$hid.' .thz-hotspot-halo{';
				$add_css	.='background:'.$chalo.';';
				$add_css	.='}';
			}
			
		}else{
		 	
			if($animate['delay'] > 0 && $hid != 0){
				$animate['delay'] = $animate['delay'] + 200;
			}
			
			$animate_data		= thz_print_animation($animate);
			$animation_class	= thz_print_animation($animate,true);
			
			$hs_link 		= thz_akg('link',$hotspot);
			$hs_link 		= $hs_link['url'] == '' && $hs_link['magnific'] =='' ?  false : $hs_link;
			$hs_class[] 	= $animation_class;
			$hs_class[]		= 'thz-hotspot-'.$size;
			
			$tooltip		= thz_akg('tooltip',$hotspot);
			$tip_style 		= thz_akg('tmx/style',$hotspot);
			$tip_size 		= thz_akg('tmx/size',$hotspot);
			$tip_position 	= thz_akg('tmx/position',$hotspot);
			$tip_visibility = thz_akg('tmx/visibility',$hotspot);
			
			$tip_class[] 	= 'thz-tip-'.$tip_style;
			$tip_class[] 	= 'thz-tip-'.$tip_size;
			$tip_class[]	= 'thz-hotspot-tip-'.$size;
			
			if('always' == $tip_visibility){
				
				$tip_class[] = 'thz-tip-visible';
			}
			
			
			$mark_print  = '';
			if('alphabetical' == $mark){
				$abc 		= range('A', 'Z');
				$mark_print 		= $abc[$hid];
			}
			
			if('icon' == $mark){
				$mark_print = $icon !='' ? '<i class="'.esc_attr($icon).'"></i>' :'';
			}
			
			if('numerical' == $mark){
				
				$mark_print = $hid + 1;
			}
			
			$html .='<div class="'.implode(' ',$hs_class).'"';
			if($tooltip !=''){
				$html .=' title="'.htmlspecialchars ($tooltip ).'"';
				$html .=' data-tip-class="'.implode(' ',$tip_class).'" data-placement="'.esc_attr($tip_position).'"';
			}
			$html .= $animate_data.'>';
			
			$html .= '<span class="thz-hotspot-mark" data-mark="'.$mark.'">';
			if('small' != $size){
				$html .= $mark_print;
			}
			$html .= '</span>';
			
			$html .= '<span class="thz-hotspot-halo"></span>';
			
			if($hs_link){
				$html .='<a ';
				if($hs_link['type'] == 'normal'){
					
					$html .='class="thz-hotspot-link" href="'.esc_url( $hs_link['url'] ).'" target="'.esc_attr($hs_link['target']).'">';
					
				}else{
					$magnific_link = thz_contains($hs_link['magnific'],array('#','http')) ? '' :'#';
					$html .='class="thz-hotspot-link thz-trigger-lightbox" href="'.esc_url( $magnific_link ).'">';
				}
				$html .='</a>';
			}
			$html .='</div>';

		}
		
		unset($hotspot);
	}
	unset($hotspots);
	
	if($css && $parentid){
		
		return $add_css;
	}
	
	if($html !=''){
		return $html;
	}
	
}


/**
 * Output file via readfile
 */
function _thz_output_req_file( $file_path ) {

	if ( is_file( $file_path ) ) {
		
		ob_start();
		$wpfs    = thz_wp_file_system();
		echo $wpfs->get_contents( $file_path );
		return ob_get_clean();
	}

	return false;
}


/**
 * Fraction to percent
 * @return string
 */	
function thz_fra_to_per($fraction,$delimiter = '_'){

	$n = explode($delimiter,$fraction);
	// ( numerator / denominator ) * 100
	$p = ( $n[0] / $n[1] ) * 100; 
	
	unset($n);
	
	return $p.'%'; 
}


/**
 * CSS Parser
 * https://github.com/intekhabrizvi/cssparser
 */	
class ThzCssParser{

	protected $raw_css;
	public $css;

	public function read_from_string($str)
	{
		if(!empty($str))
		{
			$this->raw_css = $str;
			$this->do_operation();
		}
		else
		{
			echo "String is empty.";
			exit(0);
		}
	}

	private function do_operation()
	{
		preg_match_all('/(.+?)\s?\{\s?(.+?)\s?\}/', $this->raw_css, $level1);
		unset($this->raw_css);
		if(count($level1) == 3)
		{
			$parent = count($level1[1]);
			$parent_value = count($level1[2]);
			if($parent == $parent_value)
			{
				for($i=0; $i<$parent; $i++)
				{
					$level2 = explode(";",trim($level1[2][$i]));

					if(count($level2) > 1){
						
						foreach($level2 as $l2)
						{
							if(!empty($l2))
							{
								$level3 = explode(":", trim($l2));
								
								
								if(isset($level3[1])){
									$this->css[$this->clean($level1[1][$i])][$this->clean($level3[0])] = $this->clean($level3[1]);
									unset($level3);
								}
							}
						}
						unset($l2);
					}
					unset($level2);
				}
			}
			else
			{
				echo "css is not parsable";
				exit(0);
			}

			unset($level1);
		}
		else{
			echo "css is not parsable";
			exit(0);
		}
	}

	public function find_parent($parent)
	{
		$parent = $this->clean($parent);
		if(isset($this->css[$parent]))
		{
			return $this->css[$parent];
		}
		else
		{
			return array();
		}
	}

	public function find_parent_by_property($property)
	{
		$results = array();
		$property = $this->clean($property);
		foreach($this->css as $key1 => $css)
		{
			foreach ($css as $key2 => $value2)
			{
				if($key2 == $property)
				{
					$results[][$key1] = $css;
					break 1;
				}	
			}
		}
		return $results;
	}

	public function find_parent_by_value($pvalue)
	{
		$results = array();
		$pvalue = $this->clean($pvalue);
		foreach($this->css as $key1 => $css)
		{
			foreach ($css as $key2 => $value2)
			{
				if($value2 == $pvalue)
				{
					$results[][$key1] = $css;
					break 1;
				}	
			}
		}
		return $results;
	}

	public function find_property_value_pair($property, $value)
	{
		$results = array();
		$one = $this->clean($property);
		$two = $this->clean($value);
		foreach($this->css as $key1 => $css)
		{
			foreach ($css as $key2 => $value2)
			{
				if($key2 == $one && $value2 == $two)
				{
					$results[][$key1] = $css;
					break 1;
				}	
			}
		}
		return $results;
	}

	public function add_parent($parent, $value=array())
	{
		if(!empty($parent))
		{
			$parent = $this->clean($parent);
			if(isset($this->css[$parent]) == false)
			{
				if(is_array($value) == TRUE)
				{
					$this->css[$parent] = $value;
					return true;
				}
				else if(empty($value) == TRUE)
				{
					$this->css[$parent] = array();
					return true;
				}
				else
				{
					echo "2nd argument should be an array.";
					exit(0);
				}
			}
			else
			{
				if(is_array($value) == TRUE && !empty($value))
				{
					foreach($value as $k=>$v)
					{
						$this->css[$parent][$k] = $v;
						return true;
					}
				}
				else
				{
					echo "2nd argument should be an array.";
					exit(0);
				}
			}
		}
		else
		{
			echo "Need parent tag name before performing any addition.";
			exit(0);
		}
	}

	public function remove_parent($parent)
	{
		$parent = $this->clean($parent);
		if(isset($this->css[$parent]) == TRUE)
		{
			unset($this->css[$parent]);
			return true;
		}
		else
		{
			return false;
		}
	}

	public function rename_parent($current_name, $new_name)
	{
		$current_name = $this->clean($current_name);
		$new_name = $this->clean($new_name);
		if(!empty($current_name) && !empty($new_name) && ($current_name != $new_name))
		{

			if(isset($this->css[$current_name]) == TRUE)
			{
				$this->css[$new_name] = $this->css[$current_name];
				$this->remove_parent($current_name);
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			echo "Parent tag's current and new require both names.";
			exit(0);
		}
	}

	public function add_property($parent, $property, $value, $upsert=false)
	{
		if(!empty($parent) && !empty($property) && !empty($value))
		{
			$parent = $this->clean($parent);
			$property = $this->clean($property);
			$value = $this->clean($value);
			if(isset($this->css[$parent]) == true || (isset($this->css[$parent]) == false && $upsert == true))
			{
				$this->css[$parent][$property] = $value;
				return true;
			}
			return false;
		}
		else
		{
			echo "Need all 3 values.";
			exit(0);
		}
	}

	public function update_property($parent, $property, $value)
	{
		if(!empty($parent) && !empty($property) && !empty($value))
		{
			$parent = $this->clean($parent);
			$property = $this->clean($property);
			$value = $this->clean($value);
			if(isset($this->css[$parent]) == true)
			{
				$this->css[$parent][$property] = $value;
				return true;
			}
			return false;
		}
		else
		{
			echo "Need all 3 value.";
			exit(0);
		}
	}

	public function remove_property($parent, $property)
	{
		if(!empty($parent) && !empty($property))
		{
			$parent = $this->clean($parent);
			$property = $this->clean($property);
			if(isset($this->css[$parent]) == true)
			{
				unset($this->css[$parent][$property]);
				return true;
			}
			return false;
		}
		else
		{
			echo "Need both values.";
			exit(0);
		}
	}
	
	public function export_css()
	{
		$css = '';
		if(isset($this->css) && count($this->css) > 0)
		{
		  foreach($this->css as $level_1_key=>$level_1_value)
		  {
		    $css .= stripslashes($level_1_key)." {\n";
		      foreach($level_1_value as $level_2_key=>$level_2_value)
		      {
		        $css .= "\t".stripslashes($level_2_key)." : ".stripslashes($level_2_value).";\n";
		      }
		    $css .= "}\n";
		  }
		}
		return $css;
	}
	
	
	public function combine_css( $properties = array() )
	{
		
		if(isset($this->css) && count($this->css) > 0){
			
			 $combined = array();
			 foreach ( $properties as $prop){
				 
				 $collection = $this->find_parent_by_property($prop);
				 
				 	foreach (  $collection as $p ){
						
						$sel  	= key($p);
						$key 	= $p[$sel][$prop];	
						
						$combined[$prop][$key][] = $sel;	
						$this->remove_property($sel, $prop);
						
					}
					unset($collection,$p);
				
			 }
			 unset($properties,$prop);
			 
			 foreach ( $combined as $prop => $value){
				 
				   foreach ( $value as  $val => $selectors){
					   
					    $sel = implode(',', $selectors);
					    $this->add_property(stripslashes($sel), $prop,$val, true);
				   }
				    unset($value,$selectors);
			 }
			 unset($combined,$value);
				
		}
		
		return $this->export_css();
	}	
	

	public function __destruct()
	{
		unset($this->css, $this->raw_css, $this->file);
	}

	private function clean($value)
	{	
		$value = trim($value, '{}');
		return addslashes(trim($value));
	}
}



/**
 * Color SVG
 * @return CSS string for SVG
 */	
function thz_color_svg ($svg_content, $mode, $color){
	
	$add_css = '';
	
	if($mode == 'both'){
		
		$add_css .= $svg_content.'{';
		$add_css .= 'fill:'.$color.'!important;';
		$add_css .= 'stroke:'.$color.'!important;';
		$add_css .= '}';
		
	}else if($mode == 'fill' || $mode == 'stroke'){
		
		$add_css .= $svg_content.'{';
		$add_css .= $mode.':'.$color.'!important;';
		$add_css .= '}';
	}
	
	if($add_css !=''){
		return $add_css;
	}
}

/**
 * Custom post shortcode item data
 * @return array
 */	
function thz_custom_post_data($post_id,$custom_sql){
	
	if(empty($custom_sql)){
		return false;
	}
	
	$new_order = array();
	foreach($custom_sql as $custom_item){
		
		if(!isset($custom_item['p'][0])){
			continue;
		}
		
		$media = $custom_item['m'];
		$order_media = array();
		
		if(!empty($media)){
			foreach($media as $m ){
				$order_media[] = array(
					'type' => 'image',
					'category' => false,
					'media' => $m,
					'mediaid' => '',
				);
				
				unset($m);
			}
			unset($media);
		}
		
		$key = $custom_item['p'][0];
		
		$new_order[$key] = array(
			'id' => $custom_item['p'][0],
			'title' => $custom_item['t'],
			'link' => $custom_item['l'],
			'media' => $order_media,
			'price' => $custom_item['pp'],
			'intro' => $custom_item['i'],
		);
		
		$ms = isset($custom_item['ms']) ? $custom_item['ms'] : false;
		
		if( 'default' != $ms ){
			
			$new_order[$key]['ms'] = $ms;
		}
		
		unset($custom_item);
	}
	unset($custom_sql);
	
	if(isset($new_order[$post_id])){
		return $new_order[$post_id];
	}
}

/**
 * Custom post shortcode item price
 * @return string
 */	
function thz_custom_post_price($price_data){
	
	$currency  = '';
	$currency_poz = $price_data['cp'];
	
	if($price_data['c'] !=''){
		
		$currency .='<span class="woocommerce-Price-currencySymbol">';
		$currency .= $price_data['c'];
		$currency .='</span>';			
	}
	
	$price		 = '<div class="thz-woo-item-price thz-woo-custom-price">';
	if($price_data['o'] !=''){
		
		$price		.= '<del>';
		$price 		.= '<span class="woocommerce-Price-amount amount">';
		if($currency_poz =='left'){
			$price .= $currency;
		}
		$price		.= $price_data['o'];
		if($currency_poz =='right'){
			$price .= $currency;
		}
		$price		.= '</span>';
		$price		.= '</del>';
		
		$price	.= '<ins>';
	}
	$price 		.= '<span class="woocommerce-Price-amount amount">';
	if($currency_poz =='left'){
		$price .= $currency;
	}
	$price		.= $price_data['p'];
	if($currency_poz =='right'){
		$price .= $currency;
	}
	$price		.= '</span>';
	if($price_data['o'] !=''){
		$price	.= '</ins>';
	}
	$price		.= '</div>';
		
	return $price;
}

/**
 * Get dummy post ID
 * @return string
 */	
function thz_dummy_post_ids($number,$key){
	
	$args = array(
		'numberposts' => $number,
		'post_type' => thz_list_post_types(false,array('forum','topic','reply','page' )),
		'post_status' => 'publish',
	);
	
	$recent_posts = wp_get_recent_posts( $args, ARRAY_A );	
	
	if(!empty($recent_posts) && isset($recent_posts[$key])){
		
		return $recent_posts[$key]['ID'];
		
	}else{
		return 0;
	}
}

/**
 * Check if this is demo attachment_id
 * @return bool
 */	
function thz_is_dattch($attachment_id){

	return thz_contains($attachment_id,'dattch');
	
}

/**
 * Safely get contents
 * @return string
 */	
function thz_get_contents($url){
	
	$url		= set_url_scheme($url,'https');
	$response	= wp_remote_get( $url, array( 'timeout' => 20) );
	$httpCode   = wp_remote_retrieve_response_code( $response ) ;
	
	if ($httpCode >= 200 && $httpCode < 300) {
		return wp_remote_retrieve_body( $response ) ;
	}	
	
	return false;
}

/**
 * Check if string contains string
 * @return bool
 */	
function thz_contains($str,$search){
	
	if(is_array($search)){
		
		foreach($search as $find){
			if(strpos($str,$find) !== false ){
				return true;
			}
		}
		
	}else{
	
		if(strpos($str,$search) !== false ){
			return true;
		}
		
	}
	
	return false;
}

/**
 * Retrieve metadata from a string.
 *
 * Searches for metadata in the first 8kiB of a string.
 * Each piece of metadata must be on its own line. Fields can not span multiple
 * lines, the value will get cut at the end of the first line.
 *
 * If the file data is not within that first 8kiB, then the author should correct
 * their plugin file and move the data headers to the top.
 *
 * @param string $string     String to parse.
 * @param array  $headers 	 List of headers, in the format array('HeaderKey' => 'Header Name').
 * @param string $bytes     Max bytes to read 8kb is default.
 * @return array Array of file headers in `HeaderKey => Header Value` format.
 */
function thz_get_string_data( $string, $headers, $bytes = 8192 ){
	
	if (function_exists('mb_substr')) {
		$string_data = mb_substr($string, 0, $bytes, '8bit');
	} else {
		$string_data = substr($string, 0, $bytes);
	}
 
    // Make sure we catch CR-only line endings.
    $string_data = str_replace( "\r", "\n", $string_data );

    foreach ( $headers as $field => $regex ) {
        if ( preg_match( '/^[ \t\/*#@]*' . preg_quote( $regex, '/' ) . ':(.*)$/mi', $string_data, $match ) && $match[1] )
            $headers[ $field ] = thz_remove_header_comment( $match[1] );
        else
            $headers[ $field ] = '';
    }
 
    return $headers;	
}


/**
 * Get current post type
 * @return string
 */	
function thz_get_current_post_type(){
	
  global $post, $typenow, $current_screen;

  if ( $typenow ) {
	return $typenow;
  }
  
  if ( $current_screen && $current_screen->post_type ) {
	return $current_screen->post_type;
  }

  if ( isset( $_GET['post_type'] ) ) {
	return sanitize_key( $_GET['post_type'] );
  }
  
  if ( isset( $_GET['post'] ) ) {
	return get_post_type( $_GET['post'] );
  }

  if ( $post && $post->post_type ) {
	return $post->post_type;
  }

  return null;	
	
}

/**
 * Standalone function that
 * check if the inline CSS is cached
 * @return bool
 */	
function _thz_is_inline_css_cached(){
	
	if( thz_get_theme_option ('thzopt/compileinline','donotcompile') == 'donotcompile' ){
		
		return false;
	}
	
	if( defined('WP_USE_THEMES') && !WP_USE_THEMES ){
		
		global $wp;
		$pageid = 'notheme'.$wp->request;	
		
	}else{
		
		$pageid = thz_global_page_id();
	}
	
	$option 	= get_option( 'thz_dynamic_css:'.get_template(), array() );
	$cached		= isset($option[$pageid]['cached']) ? $option[$pageid]['cached'] : false;	
	
	if( $cached ){
		
		return true;
		
	}
	
	return false;
}


/**
 * Convert path to url
 * @return string
 */
function thz_path_to_url( $path = '' ) {
	
    $url = str_replace(
        wp_normalize_path( untrailingslashit( ABSPATH ) ),
        site_url(),
        wp_normalize_path( $path )
    );
    
	return esc_url_raw( $url );
}


/**
 * Print element attributes from array
 * @return string
 */
function thz_print_attr( $attr = array() ) {
	
	if( is_array($attr) && !empty($attr) ){
		
		return implode(' ', array_map(
			function ($k, $v) { return $k .'="'. htmlspecialchars($v) .'"'; },
			array_keys($attr), $attr
		));
		
	}
}


/**
 * Force update template library data
 * @return bool
 */
function _thz_force_template_library_update(){
	
	global $wpdb;
	
	if( $wpdb->query("DELETE FROM wp_options WHERE option_name LIKE '%thz:builder:tpl:%'") ){
		
		return true;
			
	}else{
		
		return false;
		
	}
	
}

/**
 * Remove shortcode wraps 
 * @param $content
 * @return string
 */
if ( ! function_exists( 'thz_remove_shp' ) ){
	function thz_remove_sh_wraps( $content ) {
	
		$find = array(
			'<p>[',
			']</p>',
			']<br />',
			']&nbsp;',
			']</p>[',
			']<br />[',
			']&nbsp;['
		);
		$replace = array(
			'[',
			']',
			']',
			']',
			'][',
			'][',
			']['
		);
		 
		$content = str_replace($find, $replace , $content);
		
		return do_shortcode( $content );
	
	}
}

/**
 * Find year tag 
 * and replace with current year
 * @param $content
 * @return string
 */
if ( ! function_exists( 'thz_current_year' ) ){
	function thz_current_year( $content ) {
	
		if ( thz_contains($content,'{year}')) {

			$content = str_replace( '{year}', ( Date( "Y" ) ), $content );

		}
		
		return $content;
	}
}

/**
 * Get current category ID
 * outside of the loop
 */
if ( ! function_exists( 'thz_get_current_cat_id' ) ){
	function thz_get_current_cat_id(){

		if ( is_tax() || is_category() ) {		
			$current_cat = get_the_category();
			
			if(!empty($current_cat)){
				$catid   	 = $current_cat[0]->cat_ID;
				return $catid;	
			}
		}
		
		return 0;
	}
}

/**
 * Overlay effect class helper
 */
if ( ! function_exists( 'thz_ov_ef' ) ){
	
	function thz_ov_ef( $element = false, $effect = null){

		$custom_overlays	= thz_get_theme_option('co',null);
		$effect_option		= thz_get_theme_option('med_over/'.$effect,null);
		
		if(!empty($custom_overlays)){
			
			foreach($custom_overlays as $co){
				
				$co_el = $co['e'];
				
				if($element != $co_el ){
					continue;
				}
				
				$effect_option = thz_akg('o/'.$effect,$co,null);
				
				break;
				
			}
			
		}
		
		unset($custom_overlays);
		
		return $effect_option;

	}
}


/**
 * Flip string side
 * if RTL
 */
function thz_rtl_helper( $string ){
	
	if( $string && is_rtl() ){
		
		if ( thz_contains($string, 'left') ){
			
			return str_replace('left','right', $string );
		}

		if ( thz_contains($string, 'right') ){
			
			return str_replace('right','left', $string );
		}
		
				
	}
	return $string;
}

/**
 * Check if inline CSS is cached
 */
function thz_is_inline_css_cached(){
	
	static $cached = false;
	
	if( !$cached && class_exists('Thz_Doc') ){
		$cached = Thz_Doc::get( 'inline_css_cached');
	}
	
	return $cached;
}