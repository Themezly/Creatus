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
 * Get Fontface kits list
 * @return array
 */	
function thz_get_fontface_kits() {
	
	$kits = array(

		'thz' => array( // kit name /ID
			
			'css_file_path' 	=> thz_theme_file_path('/assets/fonts/thz-ff-kit/stylesheet.css'),
			'css_file_uri' 		=> thz_theme_file_uri('/assets/fonts/thz-ff-kit/stylesheet.css'),
			
			'fonts' => array( // kit fonts collection
				'creatus' => array( // font key
					'name' => 'Creatus', // Label for typography option
					'family' => 'Creatus', // Font family used in frontend should be same as in CSS
					'variants' => array(
						'100',
						'100italic',
						'200',
						'200italic',
						'300',
						'300italic',
						'400',
						'400italic',
						'500',
						'500italic',
						'600',
						'600italic',
						'700',
						'700italic',
						'800',
						'800italic',
						'900',
						'900italic',
					)
				),
				
				'open_sans' => array( // font key
					'name' => 'Open Sans Creatus', // Label for typography option
					'family' => 'Open Sans Creatus', // Font family used in frontend should be same as in CSS
					'variants' => array(
						'300',
						'300italic',
						'regular',
						'italic',
						'600',
						'600italic',
						'700',
						'700italic',
						'800',
						'800italic',
					)
				),
				
				'roboto' => array( // font key
					'name' => 'Roboto Creatus', // Label for typography option
					'family' => 'Roboto Creatus', // Font family used in frontend should be same as in CSS
					'variants' => array(
						'100',
						'100italic',
						'300',
						'300italic',
						'regular',
						'italic',
						'500',
						'500italic',
						'600',
						'600italic',
						'700',
						'700italic',
						'900',
						'900italic',
					)
				),

			)
		),

	);
	
	if( function_exists('thz_add_fontface_kits') ){
		
		return thz_add_fontface_kits( $kits );
	}
	
	return $kits;
}

/**
 * Register all fontface kits
 */	
function thz_register_font_face_kits(){
	
	$kits  	= thz_get_fontface_kits();
	
	if(!$kits){
		return;
	}
	
	foreach($kits as $kitname => $kit){
		
		if( $kit['css_file_path'] ){;
			wp_register_style( $kitname. '-ff-kit', $kit['css_file_uri'], false, thz_theme_version() ,'all' );
		}		
		
	}
	
}

/**
 * Admin enqueue all fontface kits
 */	
function thz_admin_enqueue_font_face_kits_styles(){
	
	$kits  	= thz_get_fontface_kits();
	
	if(!$kits){
		return;
	}
	
	foreach($kits as $kitname => $kit){
		if( wp_style_is( $kitname.'-ff-kit', 'registered')){
			wp_enqueue_style( $kitname. '-ff-kit');
		}		
	}
	
}


/**
 * Get Fontface kit data based on font-family value
 * @return bool|array
 */	
function thz_fontface_kit_data($family) {
	
	$kits  	= thz_get_fontface_kits();
	
	if(!$kits){
		return;
	}
	
	$data	= false;
	
	foreach($kits as $kit => $kitname){
		
		if(empty($kitname['fonts'])){
			return false;
		}

		foreach($kitname['fonts'] as $f => $fam){
		
			if(in_array($family,$fam)){
				
				$data = $kitname['fonts'][$f];
				$data['kitname'] = $kit;
				$data['css_file_uri'] = $kitname['css_file_uri'];
				unset($fam);
				break;
			}
		
		}
	}
	unset($kits);
	
	return $data;
	
}


 /**
 * Build google fonts url
 * @return string
 */
 
function thz_get_google_font_url(){

	$all_fonts 		= Thz_Doc::get('googlefont');
	$fonts_data 	= array();
	$fonts_links 	= array();
	
	foreach($all_fonts as $font){
		
		if(!$font){
			continue;
		}
				
		$name 	= explode(':',$font);
		$name 	= $name[0];
		
		$weight = explode('&',$font);
		
		
		$weight = explode(':',$weight[0]);
		$weight = $weight[1];
		
		$subset = explode('&subset=',$font); 
		$subset = $subset[1];
		
		
		$fonts_data[$name]['name'] = $name;
		$fonts_data[$name]['weights'][$weight] = $weight;
		$fonts_data[$name]['subsets'][$subset] = $subset;

		
	}
	
	unset($all_fonts,$font);
	
	foreach($fonts_data as $font){
		
		$weights = implode(',',$font['weights']);
		$subsets = implode(',',$font['subsets']);
		
		$fonts_links[] = $font['name'].':'.$weights.'&subset='.$subsets;
	}
	
	unset($fonts_data,$font);
	
	$all_google_fonts = implode( '|', $fonts_links );
	$google_font_url  = add_query_arg( 'family', urlencode( $all_google_fonts ), "//fonts.googleapis.com/css" );
	
	return $google_font_url;
}

 /**
 * Load any additional fonts
 */
function thz_fonts_loader(){

	// check if we have additional fonts
	$floader = thz_get_option('floader',null);

	if ( !empty( $floader ) ) { 
	 
		if (isset($floader[0]['l'][0])){
			
			foreach($floader[0]['l'] as $load_font){

				if(isset($load_font['f']['google_font_link'])){
					
					Thz_Doc::set( 'googlefont', $load_font['f']['google_font_link'] );
					
				}else if('fsq' == $load_font['f']['subset']){
				
					$family  = $load_font['f']['family'];
					$variant = $load_font['f']['weight'];
					$fsq_css = thz_get_fsq_css( $family, $variant );
					if ( $fsq_css ) {
						Thz_Doc::set( 'fontsquirell', $fsq_css,$variant);
					}
									
				}else if('ffk' == $load_font['f']['subset']){
				
					$family  = $load_font['f']['family'];
					$ffk_data	= thz_fontface_kit_data($family);
					
					if($ffk_data){
						Thz_Doc::set( 'fontfacekits',$ffk_data['css_file_uri'],true,$ffk_data['kitname'].'-ff-kit');
					}

				}else if(isset($load_font['f']['typekitid'])){
				
					if ( !empty($load_font['f']['typekitid']) ) {
						Thz_Doc::set( 'typekitids', $load_font['f']['typekitid']);
					}
									
				}else{
					continue;	
				}
			}
			
		}
	}
	
}