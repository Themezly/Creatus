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

class ThzDemos {

    /**
     * Global instance object
     */
    private static $_instance = null;

    /**
     * API url
     */   	
	private $api_uri;

	/**
	 * Allow or bypass request cache
	 * @var bool - allow cache (false) or bypass it (true)
	 */
	private $no_cache;
	
    /**
     * Transient name
     */   	
	private $transient;
	

    /**
     * Last update option
     */   	
	private $last_update;

	/**
	 * ThzBuilderTemplates constructor.
	 */
	public function __construct() {
		
		$this->no_cache 	= apply_filters( '_thz_filter_demos_list_no_cache', false );
		$this->api_uri 		= apply_filters( '_thz_filter_demos_api_url', 'https://resources.themezly.io/api/v1/demos' );
		$this->transient 	= 'thz:demos:list';
		$this->last_update 	= 'thz:demos:list:last:update';
		
		add_action('wp_ajax_thz_refresh_demos_list', array($this, 'demos_list_refresh'));

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
            self::$_instance = new ThzDemos();
        }
        return self::$_instance;
    }
	
	
	public function demos_list(){
		
		$transient = $this->transient;

		if ( $this->no_cache || false === ( $demos_list = get_transient( $transient ) ) ) {
			
			delete_transient( $transient );
			
			$response = wp_remote_get( $this->api_uri , array( 'timeout' => 20 ) );
			$httpCode = wp_remote_retrieve_response_code( $response );
	
			if ( $httpCode >= 200 && $httpCode < 300 ) {
				
				$demos_list = wp_remote_retrieve_body( $response );
				
			} else {
				
				$demos_list = esc_html__( 'Not able to load demos', 'creatus' );
				
			}
			
			update_option ($this->last_update, time() );
			set_transient( $transient, $demos_list, 7 * DAY_IN_SECONDS );
		
		}

		$data = json_decode($demos_list ,true );

		return $data;
							
	}	
	
	public function demos_list_refresh(){
		
		$transient = $this->transient;
		
		if( $this->can_refresh() && delete_transient( $transient )){

			wp_send_json_success();
			
		}else{
			
			wp_send_json_error();
			
		}
		
	}
		
	public function can_refresh(){
		
		$last_update = get_option($this->last_update, 0);
		
		if( $this->no_cache || $last_update <= strtotime('-15 minutes') ){
			
			return true;
		}
		
		return false;
	}

}

ThzDemos::getInstance();