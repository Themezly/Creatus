<?php if ( ! defined( 'ABSPATH' ) ) die( 'Direct access forbidden.' );


class FW_Option_Type_Thzspinner extends FW_Option_Type
{
	public function get_type()
	{
		return 'thz-spinner';
	}
	/**
	 * @internal
	 * {@inheritdoc}
	 */
	protected function _enqueue_static($id, $option, $data) {
		
		
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
	
	public function _get_backend_width_type()
	{
		return 'auto';
	}
	/**
	 * @internal
	 */
	protected function _render($id, $option, $data){
		
		
		$option['attr']['value'] = (string)$data['value'];
		$data_attr ='';
		
		if(isset($option['min'])){
			$data_attr .=' data-min="'.$option['min'].'"';
		}
		if(isset($option['max'])){
			$data_attr .=' data-max="'.$option['max'].'"';
		}
		if(isset($option['step'])){
			$data_attr .=' data-step="'.$option['step'].'"';
		}
		
		if(isset($option['addon'])){
			$data_attr .=' data-addon="'.$option['addon'].'"';
		}
		
		$data_class = isset($option['class']) ? ' '.$option['class'] :'';
		
		$units 		= false;

		if(isset($option['units']) && !empty($option['units'])){
			
			
			$units .= '<select class="add-on thz-spinner-units" tabindex="-1">';
			foreach($option['units'] as $unit){
				
				$units .= '<option value="'.$unit.'">'.$unit.'</option>';
			}
			$units .= '</select>';
			
		}

		
		if($units){
			
			return fw_render_view( get_template_directory() .'/inc/includes/option-types/'. $this->get_type() .'/view.php', array(
				'id'     => $id,
				'option' => $option,
				'data'   => $data,
				'data_attr'   => $data_attr,
				'data_class'   => $data_class,
				'units'   => $units,
			));
			
		
		}else{
			
			$html ='<div class="thz-spinners-holder'.$data_class.'">';
			if(isset($option['title'])){
				$html .= '<span class="thz-spinner-title">'.$option['title'].'</span>';
			}		
			$html .= '<div id="' . $id . '-thz-spinner" class="thz-spinner">';
			$html .='<input '. fw_attr_to_html($option['attr']) .' type="text"'.$data_attr.' />';
			if(isset($option['addon'])){
				$html .='<span class="add-on">'.$option['addon'].'</span>';
			}
			$html .='<a class="thz-spinner-up" role="button">&#9650;</a>';
			$html .='<a class="thz-spinner-down" role="button">&#9660;</a>';
			$html .='</div>';
			$html .='</div>';	
			return $html;			
			
		}
		
	}
	/**
	 * @internal
	 */
	protected function _get_value_from_input($option, $input_value){
		
		$units 		= array('px','em','rem','%','vh','vw','vmin','vmax');
		$value  	= is_null($input_value) ? $option['value'] : $input_value;
		
		// cleanup if only unit
		if(in_array($value,$units)){
			
			$value = '';
		}
		
		return (string)($value);
	}
	/**
	 * @internal
	 */
	protected function _get_defaults(){
		
		return array(
			'value' => ''
		);
	}
}
FW_Option_Type::register('FW_Option_Type_Thzspinner');