<?php if ( ! defined( 'ABSPATH' ) ) die( 'Direct access forbidden.' );


class FW_Option_Type_Thzcolorset extends FW_Option_Type
{
    public function get_type()
    {
        return 'thz-colorset';
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
		return fw_render_view(dirname(__FILE__) . '/view.php', array(
			'id' => $id,
			'option' => $option,
			'data' => $data
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

		$value = $this->_get_defaults();
		$value = $value['value'];
		
		foreach ($value as $key => $val){

			if (!isset($input_value[$key])) {
				unset($value[$key]);
			}
			
			if(isset($input_value[$key])){		
				$value[$key] = $this->process_input( $option, $input_value[$key],$key );
			}
			
		}



		return $value;

	}
	
	protected function process_input( $option, $input_value,$key  ) {
	
		if (strpos($input_value, 'color_') !== false) {
			
			return (string) $input_value;
			
		}
		
		if (
			is_null($input_value)
			||
			(
				!empty($input_value)
				&&
				!(
					preg_match( '/^#[a-f0-9]{3}([a-f0-9]{3})?$/i', $input_value )
					||
					preg_match( '/^rgba\( *([01]?\d\d?|2[0-4]\d|25[0-5]) *\, *([01]?\d\d?|2[0-4]\d|25[0-5]) *\, *([01]?\d\d?|2[0-4]\d|25[0-5]) *\, *(1|0|0?.\d+) *\)$/', $input_value )
				)
			)
		) {
			return (string)$option['value'][$key];
		} else {
			return (string)$input_value;
		}

	}

    /**
     * @internal
     */
    protected function _get_defaults()
    {

        return array(
            'value' => array(
				'text_color'=>'#444444',
				'link_color'=>'#039bf4',
				'link_hover_color'=>'#454545',
				'headings_color'=>'#454545'
			)
        );
    }
}

FW_Option_Type::register('FW_Option_Type_Thzcolorset');