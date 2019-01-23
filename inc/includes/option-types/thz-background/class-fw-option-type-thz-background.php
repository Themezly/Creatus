<?php if ( ! defined( 'ABSPATH' ) ) die( 'Direct access forbidden.' );


class FW_Option_Type_ThzBackground extends FW_Option_Type
{
    public function get_type()
    {
        return 'thz-background';
    }

    /**
     * @internal
     */
    protected function _enqueue_static($id, $option, $data)
    {
		fw()->backend->option_type('thz-multi-options')->enqueue_static();
		fw()->backend->option_type('thz-radio')->enqueue_static();
		fw()->backend->option_type('thz-spinner')->enqueue_static();
		fw()->backend->option_type('thz-slider')->enqueue_static();
		fw()->backend->option_type('thz-image')->enqueue_static();
		fw()->backend->option_type('thz-color-picker')->enqueue_static();
		fw()->backend->option_type('addable-option')->enqueue_static();
		fw()->backend->option_type('switch')->enqueue_static();
		
		
        $uri = get_template_directory_uri() .'/inc/includes/option-types/'. $this->get_type() .'/static';

        wp_enqueue_style(
            'fw-option-'. $this->get_type(),
            $uri .'/css/styles.css'
        );
		
        wp_enqueue_script(
            'fw-option-'. $this->get_type(),
            $uri .'/js/scripts.js',
            array('fw-events', 'jquery')
        );

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
	 */
	protected function _render($id, $option, $data)
	{
		
		
		$gradient_preview = '';
		$_optioncss ='';
		$_datacss ='';
		
		if($option['gradient-preview']){
			$gradient_preview = '<div class="thz-bg-gradient-preview-holder">';
			$gradient_preview .= '<div class="thz-bg-gradient-preview"></div>';
			$gradient_preview .= '</div>';
		}
		$option['attr']['data-name'] = $option['attr']['name'];
		$option['attr']['class']	.=' thz-bg-gencss';
		
		
		if(isset($data['value']['video-link'])){
			$video_id		= $data['value']['video-link'];
			
			if (!is_numeric($video_id)) {
				
				$video_id	= $this->_get_id_from_url($data['value']['video-link']);
			}
		}else{
			
			$video_id = 0;
		}
		
		if($option['print-css']){
			
			$print_css = new Thz_Css_Generator();
			$_optioncss = $print_css->background(array('background'=>$option['value']));
			$_datacss = $print_css->background(array('background'=>$data['value']));
		}
		
		
		return fw_render_view(dirname(__FILE__) . '/view.php', array(
			'id' => $id,
			'option' => $this->_set_default_values($option),
			'data' => $this->_set_default_values($data),
			'gradient_preview'=> $gradient_preview,
			'optioncss'=> $_optioncss,
			'datacss'=> $_datacss,
			'video_id'=> $video_id,
			
		));
	}
	
	

	
	protected function _get_id_from_url( $url ) {

		return thz_get_attachment_id_from_url( $url );
	}	

	/**
	 * @internal
	 */
	protected function _get_value_from_input($option, $input_value)
	{
		if (!is_array($input_value)) {
			return $option['value'];
		}
		
		$value = $this->_check_multi_value_data($input_value);
		$value = $this->_check_images($value);
		
		if($option['print-css'] && 'none' != $value['type'] && 'shape' != $value['type']){
			$print_css = new Thz_Css_Generator();
			$value['css-print'] = $print_css->background(array('background'=>$value));
		}
		
		$value =  $this->_unset_unused( $value );
		
		return $value;

	}


	
	
	/**
	 * @internal
	 */	
	protected function _check_multi_value_data($value){
		
		foreach($value as $key => $group){
			
			if(isset($group['value_data'])){
				$value[$key] = json_decode($group['value_data'],true);
			}

		}	
		
		return $value;	
	}
	
	/**
	 * @internal
	 */		
	protected function _unset_unused($value){
		
		
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
	
	
	protected function _check_images ( $value ){
		
		
		if(isset($value['image']) && !is_array($value['image'])){
			
			try {
			
				$value['image'] = json_decode($value['image'],true);
			
			} catch (Exception $e) {
				
				$value['image'] = $value['image'];
			
			}
		}
		
		if(isset($value['video-poster']) && !is_array($value['video-poster'])){
			
			try {
			
				$value['video-poster'] = json_decode($value['video-poster'],true);
			
			} catch (Exception $e) {
				
				$value['video-poster'] = $value['video-poster'];
			
			}
		}		
		
		return $value;
	}
	

    /**
     * @internal
     */
    protected function _get_defaults()
    {

        return array(
			'value' => $this->_default_values(),
			'print-css'=> true,
			'css-print'=>'',
			'gradient-preview' => true,
			'disable' => array(),
			'featured'=> false, // featured image
			'shapes'=> false 
			
        );
    }
	


	
	
	protected function _set_default_values( $values ) {
		
		$defaults = $this->_default_values();
		
		foreach ($defaults as $key => $val){
			
			if (!isset($values['value'][$key])) {
				$values['value'][$key] = $val;
			}
		}
		
		return $values;
	}
	
		
    protected function _default_values()
    {

        return  array(
			'type' => 'none',
			'color' => '',
			'image' => array(),
			'repeat' => 'no-repeat',
			'position' => 'left-top',
			'size' => 'cover',
			'attachment' => 'scroll',
			'gradient-style' => 'linear', // linear, radial
			'gradient-angle' => '0',
			'gradient-size' => 'farthest-corner',//closest-corner, closest-side,farthest-corner,farthest-side
			'gradient-shape' => 'circle',//circle,ellipse
			'gradient-h-poz' => '50',
			'gradient-v-poz' => '50',
			'gradient-start' => '0',
			'gradient-start-color' => '#ffffff',
			'gradient-add-stop' => array(),
			'gradient-end' => '100',
			'gradient-end-color' => 'color_1',
			'video-link' => '',
			'video-poster' => array(),
			'video-sound' => 0,
			'video-loop' => 1,
			'shape' => array(
				's' =>'waves', // shape name
				'p' =>'bottom', // shape position
				'f' =>'no', // shape flip
				'c' =>'color_1', // shape color
				'b' =>'',//  background color
				'w' => 100,// shape  width
				'h' =>''//  shape height
			)
        );
    }
}

FW_Option_Type::register('FW_Option_Type_ThzBackground');