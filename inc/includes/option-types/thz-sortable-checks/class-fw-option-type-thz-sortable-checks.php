<?php if ( ! defined( 'ABSPATH' ) ) die( 'Direct access forbidden.' );


class FW_Option_Type_ThzSortableChecks extends FW_Option_Type
{
    public function get_type()
    {
        return 'thz-sortable-checks';
    }

    /**
     * @internal
     */
	protected function _enqueue_static( $id, $option, $data ) {
		
		
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
		return 'full';
	}
	/**
	 * @internal
	 */
	protected function _render($id, $option, $data)
	{
		
		
		if(is_array($option['value'])){
			
			$optionvalue = json_encode($option['value'],true);
			
		}else{
			$optionvalue = $option['value'];
			
		}
		
		
		if(is_array($data['value'])){
			
			$datavalue = json_encode($data['value'],true);
			
		}else{
			$datavalue = $data['value'];
			
		}

		if(isset($data['value']) && !empty($data['value'])){
			foreach ($data['value'] as $key) {
				$order[$key] = $option['choices'][$key] ;
			}
		
			$option['choices'] 	= array_merge($order,$option['choices']);
		}
		
		$checkarray 		= isset($data['value'])? $data['value'] : $option['value'];
		$inline_class		= $option['inline'] ? ' thz-sortable-inline' :' thz-sortable-vertical';
		
		return fw_render_view(dirname(__FILE__) . '/view.php', array(
			'id' => $id,
			'option' => $option,
			'data' => $data,
			'optionvalue' => $optionvalue,
			'datavalue' => $datavalue,
			'checkarray' => $checkarray,
			'inline_class'	=> $inline_class
		));
	}


	/**
	 * @internal
	 */
	protected function _get_value_from_input($option, $input_value)
	{
		
		if($input_value){
			
			if ( is_array( $input_value ) ) {
				
				$value = $input_value;
				
			}else{
				
				
				$value = json_decode($input_value,true);
			}
			
		}else{
			
			
			$value = $option['value'];
		}

		return $value;

	}

    /**
     * @internal
     */
    protected function _get_defaults()
    {

        return array(
            'value' => array(),
			'choices' => array(),
			'inline' => true,	
        );
    }
}

FW_Option_Type::register('FW_Option_Type_ThzSortableChecks');