<?php if ( ! defined( 'ABSPATH' ) ) die( 'Direct access forbidden.' );


class FW_Option_Type_ThzBoxShadow extends FW_Option_Type
{
    public function get_type()
    {
        return 'thz-box-shadow';
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
			'fw-option-' . $this->get_type().'ThzBoxShadow',
			$uri . '/js/ThzBoxShadow.js',
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

		$defaultoption 	= $option['value'];
		$defaultdata 	= $data['value'];

		unset($defaultoption['box_shadow_css'],$defaultdata['box_shadow_css']);

		
		return fw_render_view(dirname(__FILE__) . '/view.php', array(
			'id' => $id,
			'option' => $option,
			'data' => $data,
			'defaultoption' => $defaultoption,
			'defaultdata' => $defaultdata
		));
	}
	
	

	/**
	 * @internal
	 */
	protected function _get_value_from_input($option, $input_value)
	{
		
		if (!is_array($input_value)) {
			return $option['value'];
		}
		
		$value = $input_value;

		if(count($value) > 1){
			
			$print_css 		= new Thz_Css_Generator();
			$process_css	= $value;
			
			unset($process_css['box_shadow_css']);
			
			$shadow_css 	= $print_css->box_shadow(array('boxshadow' => $process_css ));
			$value['box_shadow_css'] = $shadow_css;
			
		}else{
			
			$value = array();
			
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
        );
    }
}

FW_Option_Type::register('FW_Option_Type_ThzBoxShadow');