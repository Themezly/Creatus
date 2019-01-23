<?php if (!defined('FW')) {
	die('Forbidden');
}

class FW_Option_Type_ThzButton extends FW_Option_Type
{
	public function get_type()
	{
		return 'thz-button';
	}

	/**
	 * @internal
	 */
	public function _get_backend_width_type()
	{
		return 'full';
	}

	/**
	 * @internal
	 * {@inheritdoc}
	 */
	protected function _enqueue_static($id, $option, $data)
	{
		$uri = get_template_directory_uri() . '/inc/includes/option-types/' . $this->get_type();
		
		fw()->backend->option_type('thz-slider')->enqueue_static();
		fw()->backend->option_type('thz-icon')->enqueue_static();
		fw()->backend->option_type('thz-url')->enqueue_static();

		wp_enqueue_style(
			'fw-option-' . $this->get_type().'thz-btn',
			thz_theme_file_uri ( '/assets/css/thz-buttons.css' ),
			array(),
			fw()->theme->manifest->get_version()
		);
		
		
		// theme button
		$add_css  = thz_theme_button_css();
		
		wp_add_inline_style( 'fw-option-' . $this->get_type().'thz-btn' , $add_css );

		wp_enqueue_style(
			'fw-option-' . $this->get_type().'thz-units',
			thz_theme_file_uri ( '/assets/css/thz-units.css'),
			array(),
			fw()->theme->manifest->get_version()
		);
		
		wp_enqueue_style(
			'fw-option-' . $this->get_type().'thz-utility',
			thz_theme_file_uri ( '/assets/css/thz-utility.css' ),
			array(),
			fw()->theme->manifest->get_version()
		);	
		
		
		
        $turi = get_template_directory_uri() .'/inc/includes/option-types/thz-typography/static';

        wp_enqueue_style(
            'fw-option-thz-typography-chosen',
            $turi .'/assets/chosen/chosen.min.css'
        );

		wp_enqueue_style(
			'fw-option-' . $this->get_type(),
			$uri . '/static/css/styles.css',
			array(),
			fw()->theme->manifest->get_version()
		);
		
		fw()->backend->option_type('thz-color-picker')->enqueue_static();
		

		wp_enqueue_script(
			'fw-option-' . $this->get_type().'thz-add-link',
			thz_theme_file_uri( '/inc/thzframework/admin/js/ThzAddLink.js'),
			array('jquery', 'fw-events', 'jquery-ui-autocomplete'),
			fw()->theme->manifest->get_version()
		);
		
       wp_enqueue_script(
            'fw-option-thz-typography-chosen',
            $turi .'/assets/chosen/chosen.jquery.min.js',
            array('fw-events', 'jquery')
        );
		
		wp_enqueue_script(
			'fw-option-' . $this->get_type().'thz-btn-generator',
			$uri . '/static/js/ThzButtonGenerator.js',
			array('jquery', 'fw-events','fw-option-thz-palette'),
			fw()->theme->manifest->get_version()
		);
		
		wp_enqueue_script(
			'fw-option-' . $this->get_type(),
			$uri . '/static/js/scripts.js',
			array('jquery', 'fw-events'),
			fw()->theme->manifest->get_version()
		);

		wp_localize_script('fw-option-'. $this->get_type(), '_thzbtn', array(
		
				'deleting'=>__('Deleting button ','creatus'),
				'saving'=>__('Saving button ','creatus'),
				'continuedeleting'=>__('Continue deleting ','creatus'),
				'continuedeleting2'=>__(' button?','creatus'),
				'abouttodelete'=>__('You are about to delete button  ','creatus'),
				'clicktocontinue'=>__('. Please click on the button below to continue.','creatus'),
				'pleasewait' => esc_html__('Please wait...','creatus'),
				'exists'=> esc_html__('Button exists','creatus'),
				'exists_text'=> esc_html__(' button exists. To add a button, please use unique button class name.','creatus'),
			)
		);

		
	}

	/**
	 * @internal
	 */
	protected function _render($id, $option, $data)
	{
		
		
		$generator_layout = '';
		if($option['layout'] == 'inline'){
			
			$generator_layout = ' thz-btn-gen-inline';
			
		}

		return fw_render_view(dirname(__FILE__) . '/view.php', array(

			'id'	 			=> $id,
			'option'			=> $option,
			'data' 				=> $data,
			'oid'				=> $id,
			'btn'				=> $this->_thz_btn($option, $data),
			'buttons_names' 	=> json_encode( array_keys($this->_thz_get_buttons()) ),
			'custombuttons' 	=> $this->_thz_get_buttons(),
			'split_names'		=> $this->_thz_get_buttons(true),
			'palette'			=> $this->_default_palette(),
			'generator_layout'	=> $generator_layout
		));
	}
	
	
	
	
	protected function _thz_get_buttons($splitnames = false){
		
		$db_user_buttons = 'thz_button_generator:'. fw()->theme->manifest->get_id(); 
		
		$user_buttons = get_option( $db_user_buttons );
		
		if ( !$user_buttons ) {
			
			add_option($db_user_buttons,array());
		}
		
		$btndir 			= get_template_directory().'/inc/includes/option-types/thz-button';
		$buttonsfile 		= $btndir .'/custombuttons.php';
		$predefined_buttons = fw_get_variables_from_file($buttonsfile,array('customButtonsArray' => array()));
		$allbuttons			= $predefined_buttons['customButtonsArray'];
		
		if(!empty($user_buttons)){
			$allbuttons = array_merge(
				$user_buttons,
				$predefined_buttons['customButtonsArray']
			);
		}
		
		
		foreach($allbuttons as $name => $button){
			
			$button_json = $button['json'] !=='' ? json_decode($button['json'],true) : false;
			if($button_json){
				$adjust_defaults = $this->_set_default_values($button_json);
				$allbuttons[$name]['json'] = json_encode($adjust_defaults,true);
			}			
		}
			
		if($splitnames){
			
			$names = array();
			$names['user']	 	= array_keys($user_buttons);
			$names['defaults'] 	= array_keys($predefined_buttons['customButtonsArray']);
			 
			return $names;
			
		}else{
		
			return $allbuttons;
			
		}
	}
	
	/**
	* Delete button
	*/
	public static function _action_ajax_delete_button(){
		
		if(!is_admin()
		&& !isset($_POST['name'])) {
			return;
		}		
		
		$name 	= FW_Request::POST('name');
		$db_user_buttons = 'thz_button_generator:'. fw()->theme->manifest->get_id(); 
		$get_user_buttons 	= get_option( $db_user_buttons);
		
		unset($get_user_buttons[$name]);
		
		update_option($db_user_buttons, $get_user_buttons);
		
		wp_send_json_success(array(
			'deleted'=> $name 
		));			
	}
	
	
	/**
	* Save button
	*/
	public static function _action_ajax_add_button(){
		
		
		if(!is_admin()
		&& !isset($_POST['name'])
		&& !isset($_POST['html'])
		&& !isset($_POST['css'])
		&& !isset($_POST['json'])) {
			return;
		}
		
		$name 	= FW_Request::POST('name');
		$html 	= FW_Request::POST('html');
		$css 	= FW_Request::POST('css');
		$json 	= FW_Request::POST('json');
		

		$db_user_buttons 	= 'thz_button_generator:'. fw()->theme->manifest->get_id(); 
		$get_user_buttons 	= get_option( $db_user_buttons );
		
		
		$user_buttons	= $get_user_buttons;
		$user_buttons[$name] 			= array();
		$user_buttons[$name]['html'] 	= $html;
		$user_buttons[$name]['css'] 	= $css;
		$user_buttons[$name]['json'] 	= $json;
		
		
		update_option($db_user_buttons, $user_buttons);
		
		wp_send_json_success(array(
			'saved'=> $name
		));			
		
	}


	/**
	 * Default button
	 */
	protected function _thz_btn($option,$data){

		$btn 							= $this->_set_default_values($option['value']);

		for ($shadow = 1; $shadow <= $btn['boxShadowsCount']; $shadow++) {
			$btn['shadowInset'.$shadow] =false;
			$btn['boxshadowX'.$shadow] =0;
			$btn['boxshadowY'.$shadow] =0;
			$btn['boxshadowBlurRadius'.$shadow] =0;
			$btn['boxshadowSpreadRadius'.$shadow] =0;
			$btn['boxshadow'.$shadow.'Color'] ='rgba(0,0,0,0.3)';
		}
		
		if(isset($data['value']['json'])){
			
			$button_json = $data['value']['json'] !=='' ? json_decode($data['value']['json'],true) : false;
			
			if($button_json){
				$btn = $this->_set_default_values($button_json);
			}
		
		}
		
		return $btn;	
	}
	


	/**
	 * @internal
	 */
	protected function _get_value_from_input($option, $input_value)
	{
		
		
		if (!is_array($input_value)) {
			return $option['value'];
		}
		
		if(isset($input_value['json'])){
			
			$button_json 		= json_decode($input_value['json'],true);
			
			$fontFamily 		= $button_json['fontFamily'];
			$SubTextfontFamily 	= $button_json['SubTextfontFamily'];
			
			$input_value['gfonts'] = array();
			
			
			if(strpos($fontFamily,'thz-ff-g-') !== false){
				$input_value['gfonts']['maintext'] = $fontFamily;
			}
			
			if(strpos($SubTextfontFamily,'thz-ff-g-') !== false){
				$input_value['gfonts']['subtext'] = $SubTextfontFamily;
			}
			
			$new_json = $this->_unset_unused( $button_json );
			$input_value['json'] = json_encode($new_json,true);
		}
		
		return $input_value;

	}

	/**
	 * @internal
	 */
	protected function _get_defaults()
	{
		
		
		$value = $this->_default_values();
		
		$value['html'] = '';
		$value['css'] = '';
		$value['json'] = '';
		
		return array(

			'value' => $value,
			'layout' =>'inline',
			'hidelinks'=>false,
			'shortcode' => false
		);
	}
	
	
	/**
	 * @internal
	 */	
	protected function _unset_unused( $value ) {
		
		$defaults = $this->_default_values( $value );
		
		foreach ($defaults as $key => $val){
			
			if( $key =='activeColor' || $key =='buttonSizeClass'){
				continue;
				
			}
			
			if($value[$key] == $defaults[$key]){
				
				unset($value[$key]);	

			}			
		}
		
		return $value;
	}

	/**
	 * @internal
	 */	
	protected function _set_default_values( $values ) {
		
		$defaults = $this->_default_values( $values );
		
		foreach ($defaults as $key => $val){
			
			if (!isset($values[$key])) {
				$values[$key] = $val;
			}
		}
		
		return $values;
	}	

	/**
	 * @internal
	 */	
	protected function _default_values( $value = null ){


		$defaults = array(
		
		   'createButton' => false,
		   'buttonTransition' => false,
		   'buttonAnimation' => false,
		   'animateDelay' => 0,
		   'animateEffect' => 'thz-anim-slideIn-up',
		   'effectDuration' => 400,
		   'buttonTag' => 'a',
		   'buttonType' => 'normal',
		   'buttonText' => 'Lovely!',
		   'buttonSizeClass' => 'normal',
		   'activeColor' => 'blue',
		   'buttonFloat' => 'none',
		   'linkType' => 'normal',
		   'linkTarget' => '_self',
		   'linkTitle' => '',
		   'normalLink' => '#',
		   'magnificId' => '',
		   'customClass' => '',
		   'textNudgeV' => 0,
		   'textNudgeH' => 0,
		   'paddingY' => 12,
		   'paddingX' => 24,
		   'marginTop' => 0,
		   'marginRight' => 0,
		   'marginBottom' => 0,
		   'marginLeft' => 0,
		   'fontFamily' => 'inherit',
		   'fontSize' => 14,
		   'fontWeight' => 400,
		   'textAlign' => 'center',
		   'textItalic' => false,
		   'textUppercase' => false,
		   'letterSpacing' => 0,
		   'buttonFullWidth' => false,
		   'borderRadius' => 4,
		   'borderWidth' => 1,
		   'borderSide' => 'all',
		   'borderStyle' => 'solid',
		   'normalTextColor' => '#ffffff',
		   'normalBgColor' => '#3bafda',
		   'normalBorderColor' => '#3294b8',
		   'hoveredTextColor' => '#ffffff',
		   'hoveredBgColor' => '#3294b8',
		   'hoveredBorderColor' => '#3294b8',
		   'normalIconColor' => '#ffffff',
		   'hoveredIconColor' => '#ffffff',
		   'normalIconBg' => 'rgba(0,0,0,0.2)',
		   'hoveredIconBg' => 'rgba(0,0,0,0.2)',
		   'buttonIcon' => '',
		   'iconType' => 'boxed',
		   'iconPosition' => 'right',
		   'iconOnHover' => false,
		   'iconSize' => 'inherit',
		   'iconSpace' => 8,
		   'iconNudgeV' => 0,
		   'iconNudgeH' => 0,
		   'previewBg' => '#efefef',
		   'textShadow' => 'none',
		   'textshadowY' => 0,
		   'textshadowX' => 0,
		   'textshadowBlur' => 0,
		   'normalTshColor' => 'rgba(0,0,0,0.3)',
		   'hoveredTshColor' => 'rgba(0,0,0,0.3)',
		   'buttonGradient' => 'none',
		   'normalGradient1' => 'rgba(255,255,255,0.08)',
		   'normalGradient2' => 'rgba(0,0,0,0.15)',
		   'hoveredGradient1' => '',
		   'hoveredGradient2' => '',
		   'boxShadow' => 'none',
		   'boxShadowOpacity' => 0,
		   'boxShadowsCount' => 3,
		   'buttonSubText' => '',
		   'SubTextNudgeV' => 0,
		   'SubTextNudgeH' => 0,
		   'SubTextfontSize' => 12,
		   'SubTextfontFamily' => 'inherit',
		   'SubTextletterSpacing' => 0,
		   'SubTextfontWeight' => 400,
		   'SubTextItalic' => false,
		   'SubTextUppercase' => false,
		   'shadowInset1' => false,
		   'boxshadowX1' => 0,
		   'boxshadowY1' => 0,
		   'boxshadowBlurRadius1' => 0,
		   'boxshadowSpreadRadius1' => 0,
		   'boxshadow1Color' => 'rgba(0,0,0,0.3)',
		   'shadowInset2' => false,
		   'boxshadowX2' => 0,
		   'boxshadowY2' => 0,
		   'boxshadowBlurRadius2' => 0,
		   'boxshadowSpreadRadius2' => 0,
		   'boxshadow2Color' => 'rgba(0,0,0,0.3)',
		   'shadowInset3' => false,
		   'boxshadowX3' => 0,
		   'boxshadowY3' => 0,
		   'boxshadowBlurRadius3' => 0,
		   'boxshadowSpreadRadius3' => 0,
		   'boxshadow3Color' => 'rgba(0,0,0,0.3)',	
		   'moveEffect' => 'none',	
		   'shadowShow' => 'always',	
	
		);		

		if($value){
			
			$defaults = $this->_compare_defaults( $defaults, $value );
			
		}
		
		
		return $defaults ;
		
	}
	
	/**
	 * @internal
	 */		
	protected function  _compare_defaults( $defaults, $value ){
		
		if($value){
			
			$default_size = isset($value['buttonSizeClass']) ? $value['buttonSizeClass'] : $defaults['buttonSizeClass'];
			
			$size_attr = $this->_default_sizes($default_size);
			
			if($size_attr){
				
				foreach ($size_attr as $attr => $val){
					
					$defaults[$attr] = $val;
					
				}
				
				unset($size_attr);
			}
			
			$default_color = isset($value['activeColor']) ? $value['activeColor'] : $defaults['activeColor'];
			$color_attr = $this->_default_palette($default_color);
			
			foreach ($color_attr as $attr => $val){
				
				$defaults[$attr] = $val;
				
			}
			
			unset($color_attr);
			
			$defaults['activeColor'] = $default_color;	
		
		}
		
		
		return $defaults;
		
	}
	
	
	
	/**
	 * @internal
	 */	
	protected function _default_sizes( $size ){
		
		
		$sizes = array(

			'none'=> array(
				"buttonSizeClass"	=>'none',
				"paddingX"	=> 0,
				"paddingY"	=> 0,
			 ),	
			 
			 
			'normal'=> array(
				"buttonSizeClass"	=>'normal',
				"paddingY"	=> 12,
				"paddingX"	=> 24,
				"fontSize"	=> 14,
				
			 ),	
			 	
			'small'=> array(
				"buttonSizeClass"	=>'small',
				"paddingY"	=> 10,
				"paddingX"	=> 20,
				"fontSize"	=> 12,
			 ),
			 
			'medium'=> array(
				"buttonSizeClass"	=>'medium',
				"paddingY"	=> 16,
				"paddingX"	=> 34,
				"fontSize"	=> 14,
			 ),			 
			 
			 
			'large'=> array(
				"buttonSizeClass"	=>'large',
				"paddingY"	=> 18,
				"paddingX"	=> 44,
				"fontSize"	=> 14,
			 ),	
			 
			'xlarge'=> array(
				"buttonSizeClass"	=>'xlarge',
				"paddingY"	=> 22,
				"paddingX"	=> 54,
				"fontSize"	=> 14,
			 ),	
			 
		);
		
		
		if(isset($sizes[$size])){
			return $sizes[$size] ;
		}
		
	}
	
	
	
	
	/**
	 * Color palette
	 */
	protected function _default_palette($color = null){


		$palette = array(
		
			'theme'=> array(
				"normalTextColor"	=>'color_contrast',
				"normalBgColor"		=>'color_1',
				"normalBorderColor"	=>'color_darker_5',
				"hoveredTextColor"	=>'color_contrast',
				"hoveredBgColor"	=>'color_darker_5',
				"hoveredBorderColor"=>'color_darker_5',
				"previewBg"			=>"#efefef",
			 ),

			'blue' => array(
				"normalTextColor"	=>"#ffffff",
				"normalBgColor"		=>"#27b7f8",
				"normalBorderColor"	=>"#009fe8",
				"hoveredTextColor"	=>"#ffffff",
				"hoveredBgColor"	=>"#009fe8",
				"hoveredBorderColor"=>"#009fe8",
				"previewBg"			=>"#efefef",
			),
			
			'azure' => array(
				"normalTextColor"	=>"#ffffff",
				"normalBgColor"		=>"#0a7de8",
				"normalBorderColor"	=>"#0a65e8",
				"hoveredTextColor"	=>"#ffffff",
				"hoveredBgColor"	=>"#0a65e8",
				"hoveredBorderColor"=>"#0a65e8",
				"previewBg"			=>"#efefef",
			),
						
			'sapphire' => array(
				"normalTextColor"	=>"#ffffff",
				"normalBgColor"		=>"#2962ff",
				"normalBorderColor"	=>"#0044ff",
				"hoveredTextColor"	=>"#ffffff",
				"hoveredBgColor"	=>"#0044ff",
				"hoveredBorderColor"=>"#0044ff",
				"previewBg"			=>"#efefef",
			),
			
			'red' => array(
				"normalTextColor"	=>"#ffffff",
				"normalBgColor"		=>"#f3413e",
				"normalBorderColor"	=>"#df2e2b",
				"hoveredTextColor"	=>"#ffffff",
				"hoveredBgColor"	=>"#df2e2b",
				"hoveredBorderColor"=>"#df2e2b",
				"previewBg"			=>"#efefef",
			),
			'green'=> array(
				"normalTextColor"	=>"#ffffff",
				"normalBgColor"		=>"#1ecb67",
				"normalBorderColor"	=>"#0eb258",
				"hoveredTextColor"	=>"#ffffff",
				"hoveredBgColor"	=>"#0eb258",
				"hoveredBorderColor"=>"#0eb258",
				"previewBg"			=>"#efefef",
			),
			
			'cyan'=> array(
				"normalTextColor"	=>"#ffffff",
				"normalBgColor"		=>"#25c9dd",
				"normalBorderColor"	=>"#04b8cf",
				"hoveredTextColor"	=>"#ffffff",
				"hoveredBgColor"	=>"#04b8cf",
				"hoveredBorderColor"=>"#04b8cf",
				"previewBg"			=>"#efefef",
			),
			
			'orange'=> array(
				"normalTextColor"	=>"#ffffff",
				"normalBgColor"		=>"#ff5722",
				"normalBorderColor"	=>"#f3410b",
				"hoveredTextColor"	=>"#ffffff",
				"hoveredBgColor"	=>"#f3410b",
				"hoveredBorderColor"=>"#f3410b",
				"previewBg"			=>"#efefef",
			),
			
			'pink'=> array(
				"normalTextColor"	=>"#ffffff",
				"normalBgColor"		=>"#e83570",
				"normalBorderColor"	=>"#d81b60",
				"hoveredTextColor"	=>"#ffffff",
				"hoveredBgColor"	=>"#d81b60",
				"hoveredBorderColor"=>"#d81b60",
				"previewBg"			=>"#efefef",
			),
			
			'yellow'=> array(
				"normalTextColor"	=>"#ffffff",
				"normalBgColor"		=>"#ffb401",
				"normalBorderColor"	=>"#ff9701",
				"hoveredTextColor"	=>"#ffffff",
				"hoveredBgColor"	=>"#ff9701",
				"hoveredBorderColor"=>"#ff9701",
				"previewBg"			=>"#efefef",
			),

			'purple'=> array(
				"normalTextColor"	=>"#ffffff",
				"normalBgColor"		=>"#764dff",
				"normalBorderColor"	=>"#6238ea",
				"hoveredTextColor"	=>"#ffffff",
				"hoveredBgColor"	=>"#6238ea",
				"hoveredBorderColor"=>"#6238ea",
				"previewBg"			=>"#efefef",
			),
			
			
			'dark'=> array(
				"normalTextColor"	=>"#ffffff",
				"normalBgColor"		=>"#2c2e30",
				"normalBorderColor"	=>"#0c0e10",
				"hoveredTextColor"	=>"#ffffff",
				"hoveredBgColor"	=>"#0c0e10",
				"hoveredBorderColor"=>"#0c0e10",
				"previewBg"			=>"#f9f9f9",
			),
			
			'gray'=> array(
				"normalTextColor"	=>"#121212",
				"normalBgColor"		=>"#efefef",
				"normalBorderColor"	=>"#d4d4d4",
				"hoveredTextColor"	=>"#121212",
				"hoveredBgColor"	=>"#d4d4d4",
				"hoveredBorderColor"=>"#d4d4d4",
				"previewBg"			=>"#fefefe",
			 ),
			 
			'white'=> array(
				"normalTextColor"	=>"#121212",
				"normalBgColor"		=>"#ffffff",
				"normalBorderColor"	=>"#ffffff",
				"hoveredTextColor"	=>"#121212",
				"hoveredBgColor"	=>"#ffffff",
				"hoveredBorderColor"=>"#ffffff",
				"previewBg"			=>"#a3a3a3",
			 ),
		 
			'none'=> array(
				"normalTextColor"	=>"",
				"normalBgColor"		=>"",
				"normalBorderColor"	=>"",
				"hoveredTextColor"	=>"",
				"hoveredBgColor"	=>"",
				"hoveredBorderColor"=>"",
				"previewBg"			=>"#ffffff",
			 ),
			 
					
						
		);	
		
		if($color){
		
			return $palette[$color];	
		
		}
		
		return 	$palette;


	}
}

FW_Option_Type::register('FW_Option_Type_ThzButton');
add_action( 'wp_ajax_thz_save_button',array( "FW_Option_Type_ThzButton", '_action_ajax_add_button' ) );
add_action( 'wp_ajax_thz_delete_button',array( "FW_Option_Type_ThzButton", '_action_ajax_delete_button' ) );