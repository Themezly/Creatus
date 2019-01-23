<?php
/**
 * @package      Thz Framework
 * @author       Themezly
 * @license      http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 * @websites     http://www.themezly.com | http://www.youjoomla.com | http://www.yjsimplegrid.com
 */
 // Thz_Doc::set( 'googlefont', 'set value' );
 // Thz_Doc::get('googlefont')
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // No direct access
}

class Thz_Doc {
    
    
    /**
     * Global array
     *
     * @since  1.0.0
     */
	
	private static $docdata = array(
	
		'cssinhead' => array(),
		'googleclassname' => array(),
		'googlefont' => array(),
		'typekitids' => array(),
		'fontsquirell' => array(),
		'inline_css_cached' => false,
	);

    /**
     * Global instance object
     *
     * @since  1.0.0
     */
    
   private static $_instance = null;

	
    /**
     * Set a document data array.
     *
     * @return  Thz_Doc array
     *
     * @since   1.0.0
     */

   public static function set( $data, $val, $key = false, $single_key = false , $data_val = false ) {
        
		if('cssinhead' ==  $data){
			
			if($single_key){
				
				self::$docdata[$data][$single_key] = $val;
				
			}else{
				
        		self::$docdata[$data][] = $val;
			}
			
		}else if($key){
			
			if($single_key){
				
				self::$docdata[$data][$single_key] = $val;
				
			}else{
				
        		self::$docdata[$data][$key][] = $val;
			}
			
		}else if($data_val){
			
			self::$docdata[$data] = $val;	
			
		}else{
			
			self::$docdata[$data][$val] = $val;
			
		}
    }
	

    /**
     * Get a document data array.
     *
     * @return  Thz_Doc array
     *
     * @since   1.0.0
     */
	 
    public static function get( $data = false ) {
		
		
		if($data){
			
			if(isset(self::$docdata[$data])){
				return self::$docdata[$data];
			}
			
		}else{
			
			return self::$docdata;
			
		}
		
    }
	
	    
    /**
     * Returns the class instance
     *
     * @return  Thz_Doc instance
     *
     * @since   1.0.0
     */
    
    public static function getInstance() {
        
        
        if ( self::$_instance == null ) {
            self::$_instance = new Thz_Doc();
        }
        return self::$_instance;
    }

    
}

Thz_Doc::getInstance();