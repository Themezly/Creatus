<?php if (!defined('FW')) {
	die('Forbidden');
}

class FW_Option_Type_ThzBoxStyle extends FW_Option_Type
{
	public function get_type()
	{
		return 'thz-box-style';
	}

	/**
	 * @internal
	 */
	public function _get_backend_width_type()
	{
		return 'auto';
	}

	/**
	 * @internal
	 * {@inheritdoc}
	 */
	protected function _enqueue_static($id, $option, $data)
	{
		$uri = get_template_directory_uri() . '/inc/includes/option-types/' . $this->get_type();

		fw()->backend->option_type('thz-multi-options')->enqueue_static();
		fw()->backend->option_type('thz-radio')->enqueue_static();
		fw()->backend->option_type('thz-box-shadow')->enqueue_static();
		fw()->backend->option_type('thz-spinner')->enqueue_static();
		fw()->backend->option_type('thz-color-picker')->enqueue_static();
		fw()->backend->option_type('thz-image')->enqueue_static();
		fw()->backend->option_type('thz-background')->enqueue_static();
		fw()->backend->option_type('multi')->enqueue_static();
		fw()->backend->option_type('addable-option')->enqueue_static();
		fw()->backend->option_type('switch')->enqueue_static();
		
		wp_enqueue_style(
			'fw-option-' . $this->get_type(),
			$uri . '/static/css/styles.css',
			array(),
			fw()->theme->manifest->get_version()
		);
		
		wp_enqueue_script(
			'fw-option-' . $this->get_type().'thz-generate-css',
			$uri . '/static/js/thz-generate-css.js',
			array('jquery', 'fw-events'),
			fw()->theme->manifest->get_version()
		);
		
		wp_enqueue_script(
			'fw-option-' . $this->get_type(),
			$uri . '/static/js/scripts.js',
			array('jquery', 'fw-events'),
			fw()->theme->manifest->get_version()
		);

	}

	/**
	 * @internal
	 */
	protected function _render($id, $option, $data)
	{

		$option['attr']['data-name'] = $option['attr']['name'];
		$print_css = new Thz_Css_Generator();
		$view = $option['popup'] ? 'view-popup' :'view';
		

		if($option['popup']){
			

			$this_options = array(
			  'elementstyle' => array(
					'type' => 'thz-box-style',
					'label' => false,
					'preview' => true,
					'popup' => false,
					'value' => $data['value'],
					'disable'=> $option['disable'],
					'placeholders'=> $option['placeholders'],
					'featured'=> $option['featured'],
					'units' => $option['units'],
					'attr'  => array (
					
						'class'=>'thz-box-style-popup thz-boxstyle-element-holder'
					),
				)
			
			);

			$option['attr']['data-hook'] = $id;
			$option['attr']['class'] ='fw-option-type-thz-box-style thz-box-style-in-popup';
			
			$option['attr']['data-for-js'] = json_encode( array(
				'title'   => $option['label'],
				'options' => $this_options,
				'button'  => $option['button-text'],
				'size' => 'large',
				'custom-events' => array(
					'open' => 'thz:boxstyle:opened',
					'close' => 'thz:boxstyle:closed',
					'render' => 'thz:boxstyle:render'
				)
			));	

			
			if ( ! empty( $data['value'] )) {
				if (is_array( $data['value'] )) {
					
					$data['value'] = json_encode( $data['value'] );
					
				}else{
					
					$data['value'] = $option['value'];
					
				}
			}		
			
			// JSON.parse fix
			$data['value'] = empty( $data['value'] ) ? '' : $data['value'];
			
			$renderview = @fw_render_view(dirname(__FILE__) . '/views/'.$view.'.php', array(
				'id' => $id,
				'option' => $option,
				'data' => $data,
				'optioncss'=> $print_css->generate_css($option['value']),
				'datacss'=> $print_css->generate_css($data['value']),
			));			

			
		}else{
			
			
			$renderview = @fw_render_view(dirname(__FILE__) . '/views/'.$view.'.php', array(
				'id' => $id,
				'option' => $this->_set_default_values($option),
				'data' => $this->_set_default_values($data),
				'optioncss'=> $print_css->generate_css($option['value']),
				'datacss'=> $print_css->generate_css($data['value']),
			));			
			
		}
		
		
		return $renderview;
	}


	
	/**
	 * @internal
	 */
	protected function _get_value_from_input($option, $input_value)
	{
		
		$print_css = new Thz_Css_Generator();
		
		
		if($option['popup']){
			
			$getvalues = empty( $input_value ) ? $option['value'] : $input_value;
			
			$getvalues = is_array($getvalues) ? $getvalues : json_decode( $input_value, true );
			
			
			if(is_array($getvalues)){
				$getvalues = $this->_check_images( $getvalues );
				$getvalues['css'] = isset($getvalues['css']) ? $getvalues['css'] : $print_css->generate_css($getvalues);
			}
			
			return isset($getvalues['elementstyle']) ? $getvalues['elementstyle'] : $getvalues;
			
		}else{
		
		   if (!is_array($input_value)) {
				return $option['value'];
			}
			
			$value = $this->_check_multi_value_data($input_value);
			
			$value = $this->_unset_unused_arrays( $value );
			$value = $this->_check_images( $value );
				
			if(is_array($value)){

				$value['css'] = $print_css->generate_css($value);
			}
			
			return $value;
		}
		
		
	}
	/**
	 * @internal
	 */	
	protected function _check_multi_value_data($value){
		
		foreach($value as $key => $group){
			
			if(isset($group['value_data'])){
				$value[$key] = json_decode($group['value_data'],true);
			}
			
			if('borders' == $key){
				
				foreach($value[$key] as $b => $j){
					
					if(isset($j['value_data'])){
						$value[$key][$b] = json_decode($j['value_data'],true);
					}
				}				
			}

		}	
		
		return $value;	
	}
	
	
	
	
	protected function _check_images ( $value ){
		
		
		if(isset($value['background']['image']) && !is_array($value['background']['image'])){
			
			try {
			
				$value['background']['image'] = json_decode($value['background']['image'],true);
			
			} catch (Exception $e) {
				
				$value['background']['image'] = $value['background']['image'];
			
			}			
		}
		
		if(isset($value['background']['video-poster']) && !is_array($value['background']['video-poster'])){
			
			try {
			
				$value['background']['video-poster'] = json_decode($value['background']['video-poster'],true);
			
			} catch (Exception $e) {
				
				$value['background']['video-poster'] = $value['background']['video-poster'];
			
			}
			
		}		
		
		return $value;
	}
	
	/**
	 * @internal
	 */
	protected function _get_id_from_url( $url ) {

		return thz_get_attachment_id_from_url( $url );
	}	



	/**
	 * @internal
	 */
	protected function _get_defaults()
	{
		
		$default = array(
			'value' => $this->_default_values(),
			'disable' => array(),
			'preview' => false,
			'singletab' => false,
			'popup' => false,
			'units' => array(
				'borderradius',
				'boxsize' ,
			),
			'placeholders'=> array(),
			'button-text' =>  esc_html__('Customize box style', 'creatus'),
			'featured'=> false, // featured image
			'attr'  => array (
				'class'=>'thz-boxstyle-element-holder'
			),
			
	
		);
		
		return $default;
	}
	
	/**
	 * @internal
	 */	
	protected function _set_default_values( $values ) {
		
		$defaults = $this->_default_values();
		
		foreach ($defaults as $key => $val){
			
			if (!isset($values['value'][$key])) {
				$values['value'][$key] = $val;
			
			}else{
				
				if(is_array($values['value'][$key])){
					
					foreach ($defaults[$key] as $sub => $prop){
						
						if(!isset($values['value'][$key][$sub])){
							
							$values['value'][$key][$sub] = $prop;
						}
					}
					
				}				
				
			}
			
		}
		
		return $values;
	}
	
	
	/**
	 * @internal
	 */	
	protected function _unset_unused_arrays( $value ) {
		
		$defaults = $this->_default_values();
		
		foreach ($defaults as $key => $val){

			if (isset($value[$key]) && is_array($defaults[$key])) {
				
				if($value[$key] == $defaults[$key]){
					
					unset($value[$key]);	

				}else{
					
					if($key == 'boxsize' || $key == 'layout' || $key == 'transform'){
						
						foreach ($value[$key] as $sub => $prop){
							
							if( $prop === 'default' || $prop === '' ){
								
								unset($value[$key][$sub]);
							}
							
							if( $key == 'layout' && $sub == 'position' && ( $prop == 'static' || $prop == 'default') ){
								
								unset($value[$key]['top'],$value[$key]['right'],$value[$key]['bottom'],$value[$key]['left'],$value[$key]['z-index']);
							}
						}
						
					}	
					
					
					if($key == 'padding' || $key == 'margin' || $key == 'borderradius'){	
					
						foreach ($value[$key] as $sub => $prop){
							
							if( $prop === '' ){
								
								unset($value[$key]);
								break;
							}
							
						}
					}
					
					if( $key == 'borders'){
						
						if( $value[$key]['all'] == 'same' ){

							unset($value[$key]['right'],$value[$key]['bottom'],$value[$key]['left']);
							
							if($value[$key]['top']['w'] === '' || $value[$key]['top']['c'] === ''){
								
								unset($value[$key]);
							}
							
						}
						
					}
					
					if( $key == 'boxshadow' && count($value[$key]) <= 1){
						unset($value[$key]);
					}
					
					if( $key == 'background'){
						
						$value[$key] = $this->_unset_background_unused($value[$key]);
					}
					
				}
				
			}
		}
		
		return $value;
	}

	/**
	 * @internal
	 */	
	protected function _unset_background_unused($value){
		
		
		if('color' == $value['type']){
			
			unset(
				$value['image'] ,
				$value['repeat'] ,
				$value['position'] ,
				$value['size'] ,
				$value['attachment'] ,
				$value['gradient-style'] ,
				$value['gradient-angle'],
				$value['gradient-size'] ,
				$value['gradient-shape'] ,
				$value['gradient-h-poz'] ,
				$value['gradient-v-poz'] ,
				$value['gradient-start'] ,
				$value['gradient-start-color'] ,
				$value['gradient-add-stop'],
				$value['gradient-end'] ,
				$value['gradient-end-color'],
				$value['video-link'] ,
				$value['video-poster'] ,
				$value['video-sound'] ,
				$value['video-loop'],
				$value['shape']
			);
		}
		
		
		if('image' == $value['type']){
			unset(
				$value['gradient-style'] ,
				$value['gradient-angle'],
				$value['gradient-size'] ,
				$value['gradient-shape'] ,
				$value['gradient-h-poz'] ,
				$value['gradient-v-poz'] ,
				$value['gradient-start'] ,
				$value['gradient-start-color'] ,
				$value['gradient-add-stop'],
				$value['gradient-end'] ,
				$value['gradient-end-color'],
				$value['video-link'] ,
				$value['video-poster'] ,
				$value['video-sound'] ,
				$value['video-loop'],
				$value['shape']
			);
		}
		
		if('video' == $value['type']){
			unset(
				$value['image'] ,
				$value['repeat'] ,
				$value['position'] ,
				$value['size'] ,
				$value['attachment'] ,
				$value['gradient-style'] ,
				$value['gradient-angle'],
				$value['gradient-size'] ,
				$value['gradient-shape'] ,
				$value['gradient-h-poz'] ,
				$value['gradient-v-poz'] ,
				$value['gradient-start'] ,
				$value['gradient-start-color'] ,
				$value['gradient-add-stop'],
				$value['gradient-end'] ,
				$value['gradient-end-color'],
				$value['shape']
			);
		}
		
		if('gradient' == $value['type']){
			unset(
				$value['color'] ,
				$value['image'] ,
				$value['repeat'] ,
				$value['position'] ,
				$value['size'] ,
				$value['attachment'] ,
				$value['video-link'] ,
				$value['video-poster'] ,
				$value['video-sound'] ,
				$value['video-loop'],
				$value['shape']
			);
		}
		
		if('shape' == $value['type']){
			unset(
				$value['color'] ,
				$value['image'] ,
				$value['repeat'] ,
				$value['position'] ,
				$value['size'] ,
				$value['attachment'] ,
				$value['gradient-style'] ,
				$value['gradient-angle'],
				$value['gradient-size'] ,
				$value['gradient-shape'] ,
				$value['gradient-h-poz'] ,
				$value['gradient-v-poz'] ,
				$value['gradient-start'] ,
				$value['gradient-start-color'] ,
				$value['gradient-add-stop'],
				$value['gradient-end'] ,
				$value['gradient-end-color'],
				$value['video-link'] ,
				$value['video-poster'] ,
				$value['video-sound'] ,
				$value['video-loop']
			);
		}
		
		if('none' == $value['type']){
			unset(
				$value['color'] ,
				$value['image'] ,
				$value['repeat'] ,
				$value['position'] ,
				$value['size'] ,
				$value['attachment'] ,
				$value['gradient-style'] ,
				$value['gradient-angle'],
				$value['gradient-size'] ,
				$value['gradient-shape'] ,
				$value['gradient-h-poz'] ,
				$value['gradient-v-poz'] ,
				$value['gradient-start'] ,
				$value['gradient-start-color'] ,
				$value['gradient-add-stop'],
				$value['gradient-end'] ,
				$value['gradient-end-color'],
				$value['video-link'] ,
				$value['video-poster'] ,
				$value['video-sound'] ,
				$value['video-loop'],
				$value['shape']
			);
		}
		
		
		return $value;		
	}
	
	/**
	 * @internal
	 */		
    protected function _default_values()
    {

        return  array(
			'layout' => array(
				'display' => 'default',
				'float' => 'default',
				'clear' => 'default',
				'overflow' => 'default',
				'opacity' => '',
				'visibility' => 'default',
				'position' => 'default',
				'top' => 'auto',
				'right' => 'auto',
				'bottom' => 'auto',
				'left' => 'auto',
				'z-index' => 'auto',
			),
			'padding' => array(
				'top' => '',
				'right' => '',
				'bottom' => '',
				'left' => '',
			) ,
			'margin' => array(
				'top' => '',
				'right' => '',
				'bottom' => '',
				'left' => '',
			) ,
			'borders' => array(
				'all'=> 'same',			
				'top'=> array(
					'w' => '',
					's' => 'solid',
					'c' => ''
				),
				'right'=> array(
					'w' => '',
					's' => 'solid',
					'c' => ''
				),
				'bottom'=> array(
					'w' => '',
					's' => 'solid',
					'c' => ''
				),
				'left'=> array(
					'w' => '',
					's' => 'solid',
					'c' => ''
				)
			),
			'borderradius' => array(
				'top-left' => '',
				'top-right' => '',
				'bottom-right' => '',
				'bottom-left' => '',
			),
			'boxsize' => array(
				'width' => '',
				'height' => '',
				'min-width' => '',
				'min-height' => '',
				'max-width' => '',
				'max-height' => ''
			),
			'transform' => array(
				'rotate' => '',
				'scale-x' => '',
				'scale-y' => '',
				'skew-x' => '',
				'skew-y' => '',
				'translate-x' => '',
				'translate-y' => '',
			),
			'boxshadow' => array(),
			'background' => array(
				'type' => 'none',
			),
			'css'=>''
        );
    }
	
}

FW_Option_Type::register('FW_Option_Type_ThzBoxStyle');