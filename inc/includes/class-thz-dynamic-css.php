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

if ( ! defined('THEME_NAME')){
	
	define( 'THZDS', DIRECTORY_SEPARATOR );
	define( 'THEME_NAME', strtolower( get_template() ) ); 
	  
}

class Thz_Dynamic_Css {

	public $css_is_compiled 		= false;
	public $compiled_name 			= '-compiled.css';
	public $fontface_kits 			= false;
	public $is_preview 				= false;
	public $donotcompileinlines 	= true;
	public $donotcompilefiles 		= true;
	public $donotprocess			= false;
	
	public function __construct() {

		add_action( 'after_setup_theme', array( $this, 'thz_dynamic_css_init' ) );
		add_action( 'wp', array( $this, 'thz_register_compiled' ));
		add_action( 'wp_enqueue_scripts', array( $this, '_thz_compile_theme_files' ));
		add_action( 'wp_enqueue_scripts', array( $this, 'thz_remove_shortcodes_inline_css' ));
		add_action( 'wp_enqueue_scripts', array( $this, '_thz_action_enqueue_dynamic_scripts' ), 
		
		/** 
		 * do this late because shortcodes static runs on 30
		 * https://github.com/ThemeFuse/Unyson-Shortcodes-Extension/blob/master/class-fw-extension-shortcodes.php#L68
		 */
		
		31 );
		
		/** 
		 * Update log options
		 */		
		add_action( 'save_post', array( $this, '_thz_post_update_option' ) );
		add_action( 'before_delete_post', array( $this, '_thz_post_update_option' ));
		add_action( 'edited_term', array( $this, '_thz_tax_update_option' ), 10, 3 );
		add_action( 'delete_term', array( $this, '_thz_tax_update_option' ), 10, 3 );
		add_action('fw_settings_form_saved', array( $this, '_thz_action_clean_option' ));
		add_filter( 'widget_update_callback', array( $this, '_thz_widget_update_option' ), 10, 3 );
		
		/** 
		 * this runs only if localhost to track and combine
		 * shortcodes css files in to thz-shortcodes.css and places them in
		 * theme/assest/css folder
		 */
		add_action('fw_init', array( $this, '_thz_combine_shortcodes_css' ));
		
	}

	/**
	 * Add options and set vars
	 * Make required directories
	 */	
	public function thz_dynamic_css_init(){
		
		$this->thz_add_options();
		
		$this->fontface_kits 			= thz_get_fontface_kits();
		$compileinline					= thz_get_theme_option_early ('thzopt/compileinline','donotcompile');
		$compilecss						= thz_get_theme_option_early ('thzopt/compilecss','donotcompile');
		$this->donotcompileinline		= $compileinline == 'donotcompile' ? true : false;
		$this->donotcompilefiles		= $compilecss == 'donotcompile' ? true : false;
				
		$path 					= $this->thz_files_path();
		$css_path 				= $this->thz_files_path(true);
		$f_path 				= $this->thz_files_path(false,true);
		
		if (is_dir($this->thz_files_path())){
			return;
		}
		
		if (wp_mkdir_p($path)) {
			
			$this->_thz_add_indexes($path);
			
			if (wp_mkdir_p($css_path)) {
				$this->_thz_add_indexes($css_path);
			}
			
			if (wp_mkdir_p($f_path)) {
				$this->_thz_add_indexes($f_path);
			}

		}else{
			
			add_action( 'admin_notices', array( $this, '_thz_action_makedir_notice' ) );
			
		}


	}
	

	/**
	 * Add required options
	 */
	public function thz_add_options(){
		
		add_option( 'thz_dynamic_css:'.get_template(), array(), '', 'yes' );
		add_option( 'thz_theme_files_log:'.get_template(), array(), '', 'yes' );
		
	}
	
		
	/**
	 * Check if THEME_NAME-$this->compiled_name exists and register it
	 */	
	public function thz_register_compiled(){
		
		// earliest we can get the is_preview()
		$this->is_preview = is_preview();
		
		if( $this->is_preview || is_admin() || is_customize_preview() ){
			
			$this->donotprocess = true;
		}
		
		if( $this->donotcompilefiles || $this->donotprocess ){
			return;
		}
	
		$path 	= $this->thz_files_path(true);
		$dirs 	= wp_upload_dir();	
		
		if(is_file($path.THEME_NAME.$this->compiled_name)){
			
			$compiled_url = $this->thz_get_css_url().THEME_NAME.$this->compiled_name;

			if( ! $this->donotcompileinline ){

				$cached_file 		= $this->thz_cached_file();
				
				if( $cached_file ){
					$compiled_url = $this->thz_get_css_url().$cached_file;
				}
				
				
			}
			
			wp_register_style( THEME_NAME. '-compiled', $compiled_url, false, thz_theme_version() ,'all'  );
			
		}
		
	}
	
		
	/**
	 * Check files log for any changes in theme files.
	 * Delete the THEME_NAME-$this->compiled_name if change is detected
	 */
	private function thz_check_log(){
		
		$path 		= $this->thz_files_path(true);
		$thz_fs 	= thz_wp_file_system();
		$files 		= get_option( 'thz_theme_files_log:'.get_template(),array() );

		if(empty($files) && is_file($path.THEME_NAME.$this->compiled_name)){
			
			if($thz_fs->delete($path.THEME_NAME.$this->compiled_name)){
				
				$this->css_is_compiled = false;
				
			}else{
				
				error_log("Not able to delete compiled CSS file", 0);
				
			}
		}

		foreach($files as $filename => $filetime){
			
			if($filename == 'created'){
				continue;
			}
			
		   if ((!is_file($filename)) or filemtime($filename) > $files['created']) {
			 		
				if($thz_fs->delete($path.THEME_NAME.$this->compiled_name)){
					
					$this->css_is_compiled = false;
					
					update_option( 'thz_theme_files_log:'.get_template(),array() );
					
				}else{
					
					error_log("Not able to delete compiled CSS file", 0);
				}
				break;
			}
		}
	
	}
	

	
	/**
	 * Compile all theme files in to one THEME_NAME-$this->compiled_name
	 */	
	public function _thz_compile_theme_files(){


		if( $this->donotcompilefiles || $this->donotprocess ){
			
			return;
			
		}

		$path 				= $this->thz_files_path(true);	
		$log_array 			= array();
		$css_file_content 	= array();
		$preset 			= get_option('thz_default_preset','starter');
		
		if( wp_style_is( THEME_NAME.'-compiled', 'registered')){
			
			$this->css_is_compiled = true;
			
			$this->thz_check_log();
		}
		
		if($this->css_is_compiled){
			return;
		}

		$cssfiles = $this->thz_theme_files_list();
		$thz_fs = thz_wp_file_system();
		
		$asset_path = thz_theme_file_uri('/assets/images/');
		$asset_path = str_replace( 'https://', '//', $asset_path );
		$asset_path = str_replace( 'http://', '//', $asset_path );
		
		$fw_fonts_path  = fw_get_framework_directory_uri('/static/libs/font-awesome/fonts/');
		$fw_fonts_path 	= str_replace( 'https://', '//', $fw_fonts_path );
		$fw_fonts_path 	= str_replace( 'http://', '//', $fw_fonts_path );
		
		$fonts_path  = thz_theme_file_uri('/assets/fonts/');
		$fonts_path = str_replace( 'https://', '//', $fonts_path );
		$fonts_path = str_replace( 'http://', '//', $fonts_path );
		
		$fonts_pack  = str_replace( 'thz-icons-pack/', '', thz_theme_file_uri('/assets/fonts/thz-icons-pack/') );
		$fonts_pack  = str_replace( 'https://', '//', $fonts_pack );
		$fonts_pack  = str_replace( 'http://', '//', $fonts_pack );

		
		foreach ($cssfiles as $key => $file){
			
			$log_array[$file] = filemtime($file);
			
			if( is_file($file) ){	
				
				$get_content = $thz_fs->get_contents($file);

				if (strpos($file, 'font-awesome') !== false) {
					
					$get_content = str_replace('../fonts/', $fw_fonts_path , $get_content);
					
				}else if (strpos($file, 'thz-icons-pack') !== false) {
					
					$get_content = str_replace('../', $fonts_pack , $get_content);
					
				}else if ( $this->fontface_kits && strpos($key, '-ff-kit') !== false) {
					
					$kit_key	= str_replace('-ff-kit','',$key);
					$kit_info	= pathinfo( $this->fontface_kits[$kit_key]['css_file_uri'] );
					$kit_file	= $kit_info['dirname'].'/';
					$ff_kit  	= str_replace( 'https://', '//', $kit_file );
					$ff_kit  	= str_replace( 'http://', '//', $ff_kit );
					$get_content = str_replace(array('url("',"url('"), array('url("'.$ff_kit,"url('".$ff_kit ) , $get_content);
					
				}else{
					
					$get_content = str_replace('../images/', $asset_path , $get_content);
					$get_content = str_replace('../fonts/', $fonts_path , $get_content);
				}
				
				$css_file_content[] = $get_content;
			
			}
			
			
		}
		$log_array['created'] = time();
		
		update_option( 'thz_theme_files_log:'.get_template(),$log_array );
		
		$minify_css = implode('',$css_file_content);
		$minify_css = thz_remove_comments ($minify_css );
		$minify_css = thz_minify_css ($minify_css);
						
		$add_css ='/**'.PHP_EOL;
		$add_css .='* DO NOT EDIT'.PHP_EOL;
		$add_css .='* This is compiled '.ucfirst( THEME_NAME ).' theme file'.PHP_EOL;
		$add_css .='**/'.PHP_EOL;
		$add_css .= $minify_css;

		if($thz_fs->put_contents($path.THEME_NAME.$this->compiled_name,$add_css)){
		
			$this->css_is_compiled = true;
		}
		
		
		
	}
	
	
	/**
	 * Create theme  folders fail notification
	 */
	public function _thz_action_makedir_notice(){
		
		$notice = '<div class="error">';
		$notice .= '<p>';
		$notice .= esc_html__( 'Not able to create folders. Check wp-content/uploads folder permissions.', 'creatus' ) . '<br />';
		$notice .= '</p>';
		$notice .= '</div>';
		echo $notice;	
		
	}
	
	
	/**
	 * Add blank index files
	 */	
	public function _thz_add_indexes($path){
		
		$thz_fs = thz_wp_file_system();
		$thz_fs->put_contents($path.'index.html','');		
		
	}
	
		
	/**
	 * Get page ID
	 */	
	public function thz_page_id() {

		if( defined('WP_USE_THEMES') && !WP_USE_THEMES ){
			global $wp;
			return 'notheme'.$wp->request;	
		}
		
		return thz_global_page_id();
	}
	
	
	/**
	 * Get upload dir theme or CSS folder path
	 */	
	public function thz_files_path($css = false,$f = false){
		
		$dirs 		= wp_upload_dir();
		$basedir 	= $dirs['basedir'];	
		$path 		= $basedir.THZDS.THEME_NAME.THZDS;
		$css_path	= $path.'css'.THZDS;
		$f_path		= $path.'f'.THZDS;
		
		if($css){
			
			return $css_path;
			
		}
		
		if($f){
			
			return $f_path;
			
		}
			
		return $path;
		
	}
	
	/**
	 * Get the correct URL to CSS file
	 * check DOMAIN_MAPPING
	 */	
	public function thz_get_css_url(){
		
		$dirs 			= wp_upload_dir();
		$css_file_url 	= $dirs['baseurl'].'/'.THEME_NAME.'/css/';
		$css_file_url 	= str_replace( 'https://', '//', $css_file_url );
		$css_file_url 	= str_replace( 'http://', '//', $css_file_url );
			
		if ( defined( 'DOMAIN_MAPPING' ) && DOMAIN_MAPPING ) {
			
			if ( function_exists( 'domain_mapping_siteurl' ) && function_exists( 'get_original_url' ) ) {
				
				$mapped_domain   = domain_mapping_siteurl( false );
				$original_domain = get_original_url( 'siteurl' );
				$css_file_url = str_replace( $original_domain, $mapped_domain, $css_file_url );
				
			}
		}		
		
		return $css_file_url;
	}

	
	/**
	 * Compile dynamic inline CSS in to one file
	 */	
	public function thz_compile_inline_css($css,$page_fonts,$doc_data){
		
		if( $this->donotcompileinline || $this->donotprocess ){
			return;
		}
		
		$path 			= $this->thz_files_path(true);
		$thz_fs 		= thz_wp_file_system();
		$option 		= get_option( 'thz_dynamic_css:'.get_template(), array() );
		$check_time 	= isset($option[ 'last_update' ]) ? $option[ 'last_update' ] : 0;
		$current_time 	= (int) time();	
		$pageid			= $this->thz_page_id();	
		$unique_name	= wp_hash($css);
		
		if (( $current_time - $check_time ) < 5) {
			return;
		}
		
		$option[ $pageid ] = array(
		
			'time' => time(),
			'fonts' => $page_fonts,
			'cached' => $unique_name,
			'doc_data' => $doc_data
		
		);
		
		$option[ 'last_update' ] 		= time();
		
		update_option( 'thz_dynamic_css:'.get_template(), $option );
		
		if($this->css_is_compiled){
			
			$add_css = $thz_fs->get_contents($path.THEME_NAME.$this->compiled_name);
			
		}else{
			
			$add_css ='/**'.PHP_EOL;
			$add_css .='* DO NOT EDIT'.PHP_EOL;
			$add_css .='* This is compiled '.ucfirst( THEME_NAME ).' theme file'.PHP_EOL;
			$add_css .='* for '.$this->thz_page_id().PHP_EOL;
			$add_css .='**/'.PHP_EOL;			
		}
		
		$add_css .= thz_minify_css($css);
		
		$thz_fs->put_contents($path.$unique_name.'.css',$add_css);
	}
	


	/**
	 * Get inline style handle
	 */
	public function _thz_get_inline_style_handle(){

		$handle = THEME_NAME. '-print';
		return $handle;
		
	}
		
	/**
	 * Load compiled CSS file
	 */	
	public function thz_load_compiled_css_file(){


		if( $this->donotcompileinline || $this->donotprocess ){
			
			return false;
			
		}
		
		$dirs 			= wp_upload_dir();
		$option 		= get_option( 'thz_dynamic_css:'.get_template(), array() );
		$path 			= $this->thz_files_path(true);
		$pageid			= $this->thz_page_id();
		$page_data		= isset($option[$pageid]) ? $option[$pageid] : null;
		$cached_file	= $this->thz_cached_file();
		
		// check if we have custom doc_data that is always needed
		if( isset($page_data['doc_data']) && !empty($page_data['doc_data']) ){
			
			foreach($page_data['doc_data'] as $key => $data){
				Thz_Doc::set( $key, $data, false, false, true );
			}
		}
		
		if( $cached_file && !empty($option) && !empty($page_data)){		
		
			$dynamic_url 		= $this->thz_get_css_url().$cached_file;
			
			// nudge editor shortcodes to load their CSS files
			_thz_hero_editor_shortcodes_static();
			
			$handle = $this->_thz_get_inline_style_handle();
			
			if( wp_style_is( THEME_NAME.'-compiled', 'registered')){
				$handle = THEME_NAME.'-compiled';
			}
			
			if(!$this->css_is_compiled){

				wp_enqueue_style( THEME_NAME . '-dynamic', $dynamic_url, array($handle) );
				
				/*  
					since theme static.php  loads on wp_enqueue_scripts 20 
					and this on 90 we must dequeue
					and enque these 2 styles to maintain same order as when inlines
					are not compressed
					
					inline
					style
					child
					
				*/
				
				$remch	 	= thz_get_theme_option('thzopt/remch','donotremove');
				
				if( wp_style_is( THEME_NAME.'-style', 'registered')){
					wp_dequeue_style( THEME_NAME. '-style');
					wp_enqueue_style( THEME_NAME. '-style');
				}
				
				if( 'donotremove' == $remch && is_child_theme() ){
					wp_dequeue_style( THEME_NAME. '-child');
					wp_enqueue_style( THEME_NAME. '-child');
				}
			}
			
			if(!empty($page_data['fonts'])){
				
				foreach($page_data['fonts'] as $handle => $font ){
					
					wp_enqueue_style( $handle , esc_url( $font ), false, null, 'all' );
				}
						
			}

			return true;
			
		}else{

			return false;
		}
		
		
	}
	

	/**
	 * Remove shortcode static if cached
	 */
	public function thz_remove_shortcodes_inline_css(){

		if( function_exists('fw') && $this->thz_cached_file() ){
			Thz_Doc::set('inline_css_cached',true,false,true,true);
		}
	}	
	
	
	/**
	 * Print or load dynamic inline CSS
	 */
	public function _thz_action_enqueue_dynamic_scripts() {
		
		// if we have a file just load it
		if($this->thz_load_compiled_css_file()){
			return;
		}
		
		
		$compiled_reg = wp_style_is( THEME_NAME.'-compiled', 'registered');
		
		// theme settings collection
		$add_css 			= _thz_site_dynamic_css();
		
		// load all additional fonts
		thz_fonts_loader();
		
		$doc_data			= array();
		$page_fonts			= array();
		$typekitids			= Thz_Doc::get('typekitids');
		$fontsquirell		= Thz_Doc::get('fontsquirell');
		$fontfacekits		= Thz_Doc::get('fontfacekits');
		$googleclassnames	= Thz_Doc::get('googleclassname' );
		$googlefonts		= Thz_Doc::get('googlefont');
		$cssinhead			= Thz_Doc::get('cssinhead');
		$brightness			= Thz_Doc::get('brightness');

		// Google fonts class names , mainly used by buttons
		if ( !empty( $googleclassnames ) ) { 
		
			$gfonts_data = thz_google_fonts_data();
			$gfonts_css_array = array();

			foreach($googleclassnames as $gfcn){
				$g_font_link = $gfonts_data[$gfcn]['link'];
				$gfonts_css_array[$gfcn] = $gfonts_data[$gfcn]['css'];
				Thz_Doc::set( 'googlefont', $g_font_link );				
			}

			$add_css .= implode ('',$gfonts_css_array);
		}
		
		// Google fonts collection
		if ( !empty( $googlefonts ) ) {        
			
			$page_fonts[THEME_NAME . '-google-font'] = thz_get_google_font_url();
			wp_enqueue_style( THEME_NAME . '-google-font', esc_url( thz_get_google_font_url() ), false, null, 'all' );
			
		}

		// Typekit id's 
		if ( !empty( $typekitids ) ) { 

			foreach($typekitids as $kit_id){
				$page_fonts[THEME_NAME . '-typekit-'.esc_attr( $kit_id )] = '//use.typekit.net/'.esc_attr( $kit_id ).'.css';
				wp_enqueue_style( THEME_NAME . '-typekit-'.esc_attr( $kit_id ), '//use.typekit.net/'.esc_attr( $kit_id ).'.css', false, null, 'all' );
				unset($kit_id);
			}
			unset($typekitids);
		}
		
		// Fontsquirell
		if ( !empty( $fontsquirell ) ) { 
			
			$fsq_css = '';
			foreach($fontsquirell as $fsq){
				if($fsq){
					$fsq_css .= implode($fsq);
					unset($fsq);
				}
			}
			
			unset($fontsquirell);
			// moving Fontsquirell on top of all CSS
			$add_css = $fsq_css.$add_css;
		}
		
		// Fontfacekits
		if ( ! $compiled_reg && ! empty( $fontfacekits ) ) { 
			
			foreach($fontfacekits as $k => $kit){
				if( wp_style_is( $k, 'registered')){
					$page_fonts[$k] = $kit;
					wp_enqueue_style($k);
				}		
			}
		}
		unset($fontfacekits);
	
		// cssinhead shortcodes collection
		if ( !empty( $cssinhead ) ) {
			$add_css .= implode( $cssinhead );
		}

		// responsive fonts
		thz_add_responsive_font($add_css);

		// responsive CSS collection
		$add_css .= thz_responsive_print();
	
		// custom CSS , last
		$add_css .= thz_print_codes('custom_css');
		
		// page/post CSS trumps all 
		$pcss = thz_get_post_option('pcss/0/css','');
		if(!empty($pcss)){
			$add_css .= $pcss;
		}
		
		$handle = $this->_thz_get_inline_style_handle();

		if( $compiled_reg ){
			$handle = THEME_NAME.'-compiled';
		}
		
		// pass brightness to thz_compile_inline_css
		if ( !empty( $brightness ) ) {
			
			$doc_data['brightness'] = $brightness;
		}
		
		/* Clean and sanitize CSS before output 
		 * This is the ONLY CSS output.
		 * $add_css variable is cleaned and moved to
		 * $print_clean_css wich is used only here.
		*/
		
		//- replace palette colors
		$print_clean_css = thz_replace_palette_colors( $add_css );
		
		//- remove any tags
		$print_clean_css = wp_strip_all_tags( $print_clean_css );
		
		//- minify CSS
		$print_clean_css = thz_minify_css( $print_clean_css , true );
		
		//- print inline CSS
		wp_add_inline_style($handle, $print_clean_css );
		
		//- create CSS file and update thz_dynamic_css option
		$this->thz_compile_inline_css( $print_clean_css, $page_fonts, $doc_data);

	
	}

	
	/**
	 * Update dynamic css option on post save/delete
	 */
	public function _thz_post_update_option( $post_id ){
		
		if( $this->donotcompileinline ){
			return;
		}
		
		$siteid = thz_multisite_id();
		$option = get_option( 'thz_dynamic_css:'.get_template(), array() );
		$option[ $siteid.$post_id ] = null;
		
		// check if edited page is used on frontpage, if yes remove it to get fresh one
		if ( 'page' == get_option( 'show_on_front' ) && $post_id == get_option( 'page_on_front' )  ) {
			$option[ $siteid.'frontpage' ] = null;
		}
		
		update_option( 'thz_dynamic_css:'.get_template(), $option );
		
	}
	
	
	/**
	 * Update dynamic css option on tax edit/delete
	 */		
	public function _thz_tax_update_option($term_id, $tt_id, $taxonomy ){

		if( $this->donotcompileinline ){
			return;
		}
				
		$siteid = thz_multisite_id();
		$option = get_option( 'thz_dynamic_css:'.get_template(), array() );
		$option[ $siteid.$taxonomy.$term_id ] = null;
		update_option( 'thz_dynamic_css:'.get_template(), $option );
	}
	
	
		
	/**
	 * Empty thz_dynamic_css and thz_theme_files_log
	 * on theme options save
	 */		
	public function _thz_action_clean_option(){
		
		update_option( 'thz_dynamic_css:'.get_template(), array() );
		update_option( 'thz_theme_files_log:'.get_template(),array() );
		
	}

	/**
	 * Empty dynamic css option on widget save
	 */	
	public function _thz_widget_update_option( $instance, $new_instance, $old_instance) {
		if( is_admin() && !is_customize_preview()){
			$this->_thz_action_clean_option();
		}
		
		return $instance; 
	}
	
		
	/**
	 * List of theme files
	 */	
	public function thz_theme_files_list(){

		$preset = get_option('thz_default_preset','starter');
		
		$css_files = array(
			
			fw_get_framework_directory('/static/libs/font-awesome/css/font-awesome.min.css'),
			thz_theme_file_path( '/assets/fonts/thz-icons-pack/style.css' ),
			thz_theme_file_path( '/assets/css/thz-theme.css' ),
			thz_theme_file_path( '/assets/css/thz-menus.css' ),
			thz_theme_file_path( '/assets/css/thz-shortcodes.css' ),
			thz_theme_file_path( '/assets/css/thz-layout.css' ),
			thz_theme_file_path( '/assets/css/thz-units.css' ),
			thz_theme_file_path( '/assets/css/thz-utility.css' ),
			thz_theme_file_path( '/assets/css/thz-buttons.css' ),
			thz_theme_file_path( '/assets/css/thz-animate.css' ),
			thz_theme_file_path( '/assets/css/thz-hovers.css' ),
			thz_theme_file_path( '/assets/css/thz-magnific.css' ),
			
		);	
		
		// fontface kits
		if( $this->fontface_kits ){
			foreach( $this->fontface_kits as $kitname => $kit ){
				
				if($kit['css_file_path']){
					// add to top of the list
					$css_files = array( $kitname.'-ff-kit' => $kit['css_file_path'] ) + $css_files; 
				}
				
			}
		}
		
		if(thz_theme_file_path( '/assets/css/'.$preset.'.css' )){
			
			$css_files[] = thz_theme_file_path( '/assets/css/'.$preset.'.css' );
		}
		
		if(is_child_theme()){
			
			$css_files[] = thz_theme_file_path( '/style.css' );
		}

		return $css_files;	
		
	}	
	
	


	/**
	 * Get cache file name
	 */	
	 
	public function thz_cached_file(){
		
		if( $this->donotprocess ){
			
			return false;
			
		}
		
		$path 		= $this->thz_files_path(true);
		$option 	= get_option( 'thz_dynamic_css:'.get_template(), array() );
		$pageid		= $this->thz_page_id();
		$cached		= isset($option[$pageid]['cached']) ? $option[$pageid]['cached'].'.css' : false;
		
		if( $cached	&& is_file($path.$cached)){
			
			return $cached;
			
		}else{
			return false;
		}

	}
	
	

	/**
	 * For developers only to compile shortcodes CSS 
	 * in one file. It also keeps track of the changes
	 * to recompile again
	 */
	public function _thz_combine_shortcodes_css(){
		
		if( is_customize_preview() ){
			return;
		}
		
		$site 			= get_site_url();
		$locals			= array(
				'localhost', 
				'127.0.0.1', 
				'192.168',
				'.test', 
				'.example', 
				'.invalid', 
		);
		
		$local_hosts 	= apply_filters('thz_filter_combine_shortcodes_local_hosts', $locals );
		
		// if not localhost return
		if( !thz_contains( $site, $local_hosts ) ){
			
			return;
			
		}

		if( false === $this->_thz_recompile_shortcodes()){
			
			return;

		}		

		$css_file_content 		= array();
		$shortcodes_combined	= thz_theme_file_path( '/assets/css/' ).'thz-shortcodes.css';
		$thz_fs 				= thz_wp_file_system();
		$shortcodes				= $this->_thz_shortcodes_css_files();
		
		if( $shortcodes	){
		
			unset($shortcodes['lastchange']);
			
			foreach ($shortcodes as $shortcode_css => $css_time){
	
				$css_file_content[] = $thz_fs->get_contents($shortcode_css);
			}
	
			$add_css ='/**'.PHP_EOL;
			$add_css .='* @package      Thz Framework'.PHP_EOL;
			$add_css .='* @copyright    Copyright(C) since 2015  Themezly.com. All Rights Reserved.'.PHP_EOL;
			$add_css .='* @author       Themezly'.PHP_EOL;
			$add_css .='* @license      http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only'.PHP_EOL;
			$add_css .='* @websites     http://www.themezly.com | http://www.youjoomla.com'.PHP_EOL;
			$add_css .='* @notice       This is a auto generated CSS file. Do not edit directly.'.PHP_EOL;
			$add_css .='**/'.PHP_EOL;
			$add_css .= implode(PHP_EOL,$css_file_content);
			
			
			
			if(!$thz_fs->put_contents($shortcodes_combined,$add_css)){
				
				fw_print('Cant compile shortcodes CSS');
				
			}
		
		}


	}
	
	/**
	 * Check if we need to recompile shortcodes
	 */
	public function _thz_recompile_shortcodes(){
	
		$css_files = $this->_thz_shortcodes_css_files();
		
		if(empty($css_files)){
			return;
		}
		
		$thz_fs    = thz_wp_file_system();
		
		foreach($css_files as $filename => $filetime){
			
			if($filename == 'lastchange'){
				continue;
			}
			
		   if ( filemtime($filename) > $css_files['lastchange'] ) {
					
				return true;
				
				break;
			}
		}
		
		return false;
	}
	
	
	/**
	 * Array of shortcodes CSS files and
	 * their filemtime
	 * framework ref https://github.com/ThemeFuse/Unyson/blob/master/framework/core/Fw.php#L71
	 */	
	public function _thz_shortcodes_css_files(){
		
		if( function_exists('fw_ext') && fw_ext('shortcodes') && thz_fw_loaded() && thz_fw_active() ){

			$css_files 				 	= array();
			$shortcodes_combined	 	= thz_theme_file_path( '/assets/css/thz-shortcodes.css' );		
			$all_shortcodes  			= fw()->extensions->get( 'shortcodes' )->get_shortcodes();
			$css_files['lastchange'] 	= filemtime($shortcodes_combined);
	
			foreach( $all_shortcodes as $tag => $shortcode ){
				
				if( $tag =='calendar' ){
					continue;
				}
				
				$style = $shortcode->locate_path('/static/css/styles.css');
				
				if( $style && thz_contains($style,'thzframework')){
					
					$css_files[$style] = filemtime($style);
				}
				
			}
	
			return $css_files;
		
		}
		
	}

}


new Thz_Dynamic_Css();