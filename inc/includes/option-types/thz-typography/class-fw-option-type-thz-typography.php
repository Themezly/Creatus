<?php if ( ! defined( 'ABSPATH' ) ) die( 'Direct access forbidden.' );
/**
 * @derived      ThzTypo
 * @package      ThzTypo
 * @copyright    Copyright(C) since 2015  Themezly.com. All Rights Reserved.
 * @author       Themezly.com
 * @version      1.0.0
 * @license      MIT License, https://github.com/Themezly/ThzTypo/blob/master/LICENSE
 * @website      http://www.themezly.com
 */
 
class FW_Option_Type_ThzTypography extends FW_Option_Type
{
    public function get_type()
    {
        return 'thz-typography';
    }

    /**
     * @internal
     */
    protected function _enqueue_static($id, $option, $data)
    {
        $uri = get_template_directory_uri() .'/inc/includes/option-types/'. $this->get_type() .'/static';

        wp_enqueue_style(
            'fw-option-'. $this->get_type(),
            $uri .'/css/styles.css'
        );
		
        wp_enqueue_style(
            'fw-option-'. $this->get_type().'-chosen',
            $uri .'/assets/chosen/chosen.min.css'
        );

       wp_enqueue_script(
            'fw-option-'. $this->get_type().'-chosen',
            $uri .'/assets/chosen/chosen.jquery.min.js',
            array('fw-events', 'jquery')
        );
				
        wp_enqueue_script(
            'fw-option-'. $this->get_type().'-thztypo',
            $uri .'/js/thztypo.js',
            array('fw-events', 'jquery')
        );
		
        wp_enqueue_script(
            'fw-option-'. $this->get_type(),
            $uri .'/js/scripts.js',
            array('fw-events', 'jquery')
        );
		
		fw()->backend->option_type('thz-text-shadow')->enqueue_static();
		fw()->backend->option_type('thz-spinner')->enqueue_static();	
			
		wp_localize_script('fw-option-'. $this->get_type(), 'thz_typo', array(
				'fonts' => $this->thz_typogrpahy_print_fonts(),
				'notFound' => esc_html__('Oops, nothing found!','creatus')
			)
		);

    }

	/**
	 * @internal
	 */	
	protected function thz_typogrpahy_print_fonts() {
		
		return htmlentities( $this->thz_font_print() );
	}
	
	/**
	 * @internal
	 */
	public function _get_backend_width_type(){
		return 'auto';
	}
	
	
	/**
	 * Returns fonts
	 * @return array
	 */
	public function thz_get_fonts() {
		
		$cache_key = 'fw_option_type/'. $this->get_type();

		try {
			
			return FW_Cache::get($cache_key);
		
		} catch (FW_Cache_Not_Found_Exception $e) {
			
			$standard_fonts = array(
				'defaul'=> 'default',
				'arial'=> 'Arial, Helvetica, sans-serif',
				'arial_black'=> "'Arial Black', Gadget, sans-serif" ,
				'bookman'=> "'Bookman Old Style', serif",
				'comic'=> "'Comic Sans MS', cursive",
				'courier'=> "'Courier New', Courier, monospace" ,
				'gothic'=> "'Century Gothic', sans-serif",
				'garamond'=> "Garamond, serif",
				'georgia'=> "Georgia, serif",
				'cambria'=> "Cambria,serif",
				'times'=> "'Times New Roman', Times, serif",
				'tahoma'=> "Tahoma, Geneva, sans-serif",
				'impact'=> "Impact, Charcoal, sans-serif",
				'helvetica'=> "'Helvetica Neue', Helvetica, Arial, sans-serif",
				'lucida'=> "'Lucida Sans Unicode', 'Lucida Grande', sans-serif",
				'verdana'=> "Verdana, Geneva, sans-serif",
				'stack1'=> "Geneva, Tahoma, Verdana, sans-serif",
				'stack2'=> "'Lucida Console', Monaco, monospace",
				'stack3'=> "'MS Sans Serif', Geneva, sans-serif" ,
				'stack4'=> "'MS Serif', 'New York', sans-serif",
				'stack5'=> "'Trebuchet MS', Helvetica, sans-serif",
				'stack6'=> "'Palatino Linotype','Book Antiqua', Palatino, serif",
				'stack7'=> "Georgia, Cambria, 'Times New Roman' ,Times ,serif",
				'stack8'=> "Constantia, 'Lucida Bright', Lucidabright,'Lucida Serif',Lucida,'DejaVu Serif','Bitstream Vera Serif','Liberation Serif',Georgia,serif",
				'stack9'=> "-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Oxygen-Sans,Ubuntu,Cantarell,'Helvetica Neue',sans-serif",
				'stack10'=> "ProximaNova,-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,'Helvetica Neue',Arial,sans-serif"
			);	
			
			$custom_list =  apply_filters ('thz_filter_typography_standard_fonts',array());
			
			if(!empty($custom_list)){
				
				$standard_fonts = array_merge($standard_fonts, $custom_list);
			}
			
			$google_fonts_json = fw_get_google_fonts_v2();
		
			$fonts = array(
				'standard' => $standard_fonts,
				'google' => apply_filters(
					'thz_typography_google_fonts',
					json_decode( $google_fonts_json , true )
				)
			);

			FW_Cache::set($cache_key, $fonts);

			return $fonts;
		}
	}

	public function thz_get_google_font( $font ) {
		
		$fonts = $this->thz_get_fonts();

		foreach ( $fonts['google']['items'] as $g_font ) {
			if ( $font === $g_font['family'] ) {
				return $g_font;
			}
		}

		return false;
	}
	
		
	/**
	 * Creates a dropdown list with standard fonts
	 */	
	public function thz_standard_fonts_list(){
		
		$standard_fonts = $this->thz_get_fonts();
		
		$html ='<optgroup class="thz-font-standard-fonts" label="Standard Fonts">';
		foreach($standard_fonts['standard'] as $sf){
			$font_type 		= $sf == 'default' ? 'default' : 'standard';
			$html .='<option value="'.(string) $sf.'" data-type="'.$font_type.'">';
			$html .= $sf;
			$html .='</option>';
			
		}
		$html .='</optgroup>';
		return $html;
				
	}
	
	
	/**
	 * Creates a dropdown list with Fontsquirell fonts
	 */	
	public function thz_fontsquirell_fonts_list(){
			
		$imported  	= get_option('thz_imported_fonts');
		$fsqfonts 	= thz_akg('fsqfonts',$imported, array());
		$html 		='';
		
		if(!empty($fsqfonts)){
			
			$html .='<optgroup class="thz-font-fontsquirell-fonts" label="Fontsquirell Fonts">';
			foreach($fsqfonts as $fam => $variants){
				
				$font_variants 	= implode(',',array_keys($variants));
				$variant_data 	= ''; 
				
				foreach($variants as $v) { 
					$variant_data .= ' data-'.$v["font_family"].'-file="'.$v["font_file"].'"'; 
					unset($v);
				} 
				
				$html .='<option value="'.(string) $fam.'" data-type="fontsquirell" data-variants="'.$font_variants.'"  data-subsets="fsq"'.$variant_data.'>';
				$html .= ucfirst($fam);
				$html .='</option>';
	
			}
			
			$html .='</optgroup>';	
		}
		
		return $html;
				
	}
	
	
	/**
	 * Creates a dropdown list with Fontface kits fonts
	 */	
	public function thz_fontfacekits_list(){
			
		$kits  	= thz_get_fontface_kits();
		$html 	= '';
		
		if(!empty($kits)){
			
			$html .='<optgroup class="thz-font-fontfacekits-fonts" label="Fontface Kits Fonts">';
			
			foreach( $kits as $kitname ){
				foreach($kitname['fonts'] as $f => $fam){
					
					$font_name 		= $fam['name'];
					$font_variants 	= $fam['variants'] ? ' data-variants="'.implode(',',$fam['variants']).'"':'';
					$family			= $fam['family'];
					
					$html .='<option value="'.(string) $family.'" data-subsets="ffk" data-type="fontfacekit"'.$font_variants.'>';
					$html .= $font_name;
					$html .='</option>';
		
				}
			}
			
			$html .='</optgroup>';	
		}
		
		return $html;
				
	}
	
	
	/**
	 * Creates a dropdown list with Typekit fonts
	 */	
	public function thz_typekit_fonts_list(){
			
		$imported  	= get_option('thz_imported_fonts');
		$tykfonts 	= thz_akg('tykfonts',$imported, array());
		$html 		='';
		
		if(!empty($tykfonts) && isset($tykfonts['select'])){
			
			$html .='<optgroup class="thz-font-typekit-fonts" label="Typekit Fonts">';
			$html .= $tykfonts['select'];
			$html .='</optgroup>';	
		}
		
		return $html;
				
	}
	
	/**
	 * Creates a dropdown list with google fonts
	 */		
	public function thz_google_fonts_list(){

		$get_fonts 		= $this->thz_get_fonts();
		$fonts 			= $get_fonts['google'];
		$google_fonts 	= array();
	
		foreach ($fonts['items'] as $font) {
			$google_fonts[$font['family']] = array(
				'label'    => $font['family'],
				'variants' => $font['variants'],
				'subsets'  => $font['subsets'],
			);
			unset($font);
		}
		
		unset($fonts);

		$html ='<optgroup class="thz-font-google-fonts" label="Google Fonts">';
						
		foreach($google_fonts as $gf){
			
			$font_name 		= $gf['label'];
			$font_variants 	= implode(',',$gf['variants']);
			$font_subsets 	= implode(',',$gf['subsets']);
			$font_type 		= 'google';
			
			$html .='<option value="'.(string) $font_name.'" data-type="'.$font_type.'" data-variants="'.$font_variants.'" data-subsets="'.$font_subsets.'">';
			$html .=$font_name;
			$html .='</option>';
			
			unset($gf);
		}
		unset($google_fonts,$get_fonts);
		
		$html .='</optgroup>';	
		
		return $html;
	}
	
	/**
	 * Creates a preview box
	 */		
	public function thz_font_preview(){
		
		$html ='<div class="thz-typography-preview" contenteditable="true">';
		$html .='1 2 3 4 5 6 7 8 9 0 A B C D E F G H I J K L M N O P Q R S T U V W X Y Z a b c d e f g h i j k l m n o p q r s t u v w x y z';
		$html .='</div>';
		
		return $html;
		
	}
	
	
	public function thz_font_print(){
		
		$html ='<div id="thz-font-selector">';
			$html .='<div class="thz-typography-group family-dropdown">';
				$html .='<select id="thz-font-family">';
					$html .= $this->thz_standard_fonts_list();
					$html .= $this->thz_fontfacekits_list();
					$html .= $this->thz_fontsquirell_fonts_list();
					$html .= $this->thz_typekit_fonts_list();
					$html .= $this->thz_google_fonts_list();
				$html .='</select>';
			$html .='</div>';
			
			if( !is_customize_preview() ){
				$html .= $this->thz_font_preview();
			}
			
			
		$html .='</div>';
		
		return $html;		
	}
	
	/**
	 * @internal
	 */
	protected function _render($id, $option, $data)
	{
		
		$extra_class ='';	
		if($option['cssclasses']){
			$extra_class .=' has-spinners';
		}
		
		$current = isset($data['value']) ? $data['value'] : $option['value'];
		$cfamily = isset($current['family']) ? $current['family'] : false;
		$csubset = isset($current['subset']) ? $current['subset'] : false;

		return fw_render_view(dirname(__FILE__) . '/view.php', array(
			'thz_typo' => $this,
			'id' => $id,
			'option' => $this->_set_default_values($option),
			'data' => $this->_set_default_values($data),
			'extra_class' => $extra_class,
			'variants' => $this->_get_current_font_data($cfamily,$csubset),
			'subsets' => $this->_get_current_font_data($cfamily,$csubset,'subsets'),
		));
	}
	
	
	
	public function _get_current_font_data( $font, $subset, $return = 'variants'){
		
		if(!$font && !$subset){
			return;
		}
		
		$current_data = array(
			'variants' => array(),
			'subsets' => false
		);
		
		if( thz_creatus_extended() ){
			
			// typekit
			if( $subset == 'default' || $subset == 'all'){
				
				$imported  	= get_option('thz_imported_fonts');
				$slug		= thz_typekit_slug($font);
				$current_data['variants'] 	= thz_akg('tykfonts/fonts_data/'.$slug.'/variations',$imported,false);
				$current_data['subsets'] 	= array($subset);
				
				return $current_data[$return];
			}
			
			
			// fontsquirell
			if( $subset == 'fsq' ){
				
				$imported  	= get_option('thz_imported_fonts');
				$variants 	= thz_akg('fsqfonts/'.$font,$imported,false);
				$current_data['variants'] 	= $variants ? array_keys($variants) : array();
				$current_data['subsets'] 	= array($subset);
				
				return $current_data[$return];
			}
		
		}

		// fontfacekit
		if( $subset == 'ffk' ){
			
			$ffk_data	= thz_fontface_kit_data($font);
			
			if($ffk_data){
				$current_data['variants'] 	= $ffk_data['variants'] ? $ffk_data['variants'] : array();
				$current_data['subsets'] 	= array($subset);

			}	
			return $current_data[$return];
		}
		
		// google
		$google_font = $this->thz_get_google_font( $font );
		
		if( $google_font ){
			
			$current_data['variants'] 	= $google_font['variants'];
			$current_data['subsets'] 	= $google_font['subsets'];
			return $current_data[$return];
		}
		
		
		return $current_data[$return];

	}
	
	
	
	/**
	 * @internal
	 */
	protected function _get_value_from_input($option, $input_value)
	{
		
		if (!is_array($input_value)) {
			
			$value = $option['value'];
			
		}else{
			
			if(isset($input_value['value_data'])){
			
				$input_value = json_decode($input_value['value_data'],true);
				
				if(isset($input_value['text-shadow']) && !empty($input_value['text-shadow'])){
					$input_value['text-shadow'] = str_replace(array('text-shadow:',';'),'',$input_value['text-shadow']);
				}
				
				$value = $input_value;
			}
			
		}
		
		$value = $this->_unset_unused($value);
		
		if($option['cssprint']){
			$value['css'] 	= thz_process_typo_css($value,false);
		}
		
		if( isset($value['subset']) && ( $value['subset']  == 'default' || $value['subset']  == 'all')){
			
			$value['typekitid'] 	= thz_typo_get_typekit_id($value);
			
		}else{
			
			if(isset($value['typekitid'])){
				unset($value['typekitid']);
			}
		}
		
		$gfont 				= thz_typo_get_google_link($value);
		
		if($gfont){
			
			$value['google_font_link'] 	= $gfont;
			
		}else{
			
			if(isset($value['google_font_link'])){
				unset($value['google_font_link']);
			}
		}
		
		if($option['cssclasses']){
			$value['classes'] 	= thz_font_classes($value,false);
		}
		
		return $value;

	}

    /**
     * @internal
     */
    protected function _unset_unused($value){
		
		$defaults  = $this->_get_defaults();

		foreach ( $defaults['value']  as $key => $def_val){
			
			 if(isset($value[$key]) && ( $def_val === $value[$key] || $value[$key] ==='')){
				 
				 unset( $value[$key] );
			 }
						
		}
		
		return $value;
		
	}

    /**
     * @internal
     */	
	protected function _set_default_values( $values ) {
		
		$defaults = $this->_get_defaults();
		
		foreach ($defaults['value'] as $key => $val){

			if('google_font_link' == $key){
				continue;
			}
						
			if (!isset($values['value'][$key])) {
				$values['value'][$key] = $val;
			}
		}
		
		return $values;
	}

	
    /**
     * @internal
     */
    protected function _get_defaults()
    {

        return array(
			'value' => array(
				'family'  		=> 'default',
				'size' 			=> '',
				'weight'     	=> 'default',
				'style'     	=> 'default',
				'subset'    	=> false,
				'line-height' 	=> '',
				'spacing'		=> '',
				'transform' 	=> 'default',
				'align'     	=> 'default',
				'color' 		=> '',
				'hovered' 		=> '',
				'text-shadow' 	=> array()
			),
			'cssprint' => true,
			'cssclasses' => false,
			'disable' => array(),
			'sizelimit' => 100,
        );
    }

	
	
}

FW_Option_Type::register('FW_Option_Type_ThzTypography');