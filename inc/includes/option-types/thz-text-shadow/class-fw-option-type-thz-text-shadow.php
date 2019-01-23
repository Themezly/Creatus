<?php if ( ! defined( 'ABSPATH' ) ) die( 'Direct access forbidden.' );


class FW_Option_Type_ThzTextShadow extends FW_Option_Type
{
    public function get_type()
    {
        return 'thz-text-shadow';
    }

    /**
     * @internal
     */
    protected function _enqueue_static($id, $option, $data)
    {
        $uri = get_template_directory_uri() .'/inc/includes/option-types/'. $this->get_type() .'/static';
		
		fw()->backend->option_type('thz-color-picker')->enqueue_static();
		
        wp_enqueue_style(
            'fw-option-'. $this->get_type(),
            $uri .'/css/styles.css'
        );
		
		wp_enqueue_script(
			'fw-option-' . $this->get_type().'ThzTextShadow',
			$uri . '/js/ThzTextShadow.js',
			array('jquery', 'fw-events'),
			fw()->theme->manifest->get_version()
		);
		
		wp_enqueue_script(
			'fw-option-' . $this->get_type(),
			$uri .'/js/scripts.js',
			array('jquery', 'fw-events'),
			fw()->manifest->get_version()
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
		
		
		$defaultoption = _thz_print_shadows($option['value']);
		
		if( !empty($data['value']) ){
			$defaultoption = _thz_print_shadows($data['value']);
		}
		
		return fw_render_view(dirname(__FILE__) . '/view.php', array(
			'id' => $id,
			'option' => $option,
			'data' => $data,
			'defaultoption' => $defaultoption,
			'defaultdata' => _thz_print_shadows($data['value']),
			'shadowsoption' => _thz_build_shadows($option['value']),
			'shadowsdata' => _thz_build_shadows($data['value'])
		));
	}
	
	/**
	 * @internal
	 */
	protected function _get_value_from_input($option, $input_value)
	{
		
		if(is_null($input_value) && is_array($option['value'])){
			
			$input_value  = _thz_print_shadows($option['value']);
		}
		
		
		$value = $input_value;

		return $value;

	}

    /**
     * @internal
     */
    protected function _get_defaults()
    {

        return array(
			'value' => array(),
        );
    }
}

FW_Option_Type::register('FW_Option_Type_ThzTextShadow');