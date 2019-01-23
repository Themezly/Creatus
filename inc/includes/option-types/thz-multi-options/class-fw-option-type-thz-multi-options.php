<?php if ( ! defined( 'ABSPATH' ) ) die( 'Direct access forbidden.' );


class FW_Option_Type_ThzMultiOptions extends FW_Option_Type
{
    public function get_type()
    {
        return 'thz-multi-options';
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
		
		wp_enqueue_script(
			'fw-option-' . $this->get_type(),
			$uri . '/js/scripts.js',
			array('jquery', 'fw-events'),
			fw()->manifest->get_version()
		);
		
		fw()->backend->option_type('thz-icon')->enqueue_static();
		fw()->backend->option_type('thz-spinner')->enqueue_static();
		fw()->backend->option_type('thz-color-picker')->enqueue_static();
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

		return fw_render_view(dirname(__FILE__) . '/view.php', array(
			'id' => $id,
			'option' => $option,
			'data' => $data,
			'value_data' => $data
		));
	}
	
	

	/**
	 * @internal
	 */
	protected function _get_value_from_input($option, $input_value)
	{
		
		
		if ( is_array( $input_value ) ) {

			$value 		= $this->_process_value_data($option,$input_value);

		} else {
			
			$value = $option['value'];
		}

		return $value;

	}
	
	/**
	 * @internal
	 */
	protected function _process_value_data($option, $input) {
		
		$value_data = false;
		
		if(isset($input['value_data'])){
			
			$value_data = json_decode($input['value_data'],true);
		
			foreach($option['thz_options'] as $name => $opt){
	
				if('radio' == $opt['type'] || 'checkboxes' == $opt['type']){
					
					unset($value_data[$name]);
					
				}
				
			}
			
			unset ($input['value_data']);
		}
		
		
		// checkboxes trailing
		foreach ( $input as $choice => $val ) {
			
			if(is_array($val)){
				
				foreach ($val as $key => $v){
					
					if ( $v === '' ) {
						unset($input[$choice][$key]);
					}						
				}
			}
		}
		
		
		if(!$value_data){
			return $input;
		}
		
		return array_merge($input,$value_data);

	}	
	
	

    /**
     * @internal
     */
    protected function _get_defaults()
    {

        return array(
            'value' => array(
				'firstoption' => 'select2'
			),
			'breakafter' => false,
			'thz_options' => array(
				'firstoption' => array(
					'type' => 'select',// select |  text | spinner
					'title' => esc_html__('Title', 'creatus'),
					'choices' => array(
						'select1' => esc_html__('select1', 'creatus'),
						'select2' => esc_html__('select2', 'creatus'),
						'select3' => esc_html__('select3', 'creatus')
					),
				)			
			),
        );
    }
}

FW_Option_Type::register('FW_Option_Type_ThzMultiOptions');