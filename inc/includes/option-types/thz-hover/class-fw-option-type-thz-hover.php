<?php if ( ! defined( 'ABSPATH' ) ) die( 'Direct access forbidden.' );


class FW_Option_Type_ThzHover extends FW_Option_Type
{
    public function get_type()
    {
        return 'thz-hover';
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
		fw()->backend->option_type('thz-spinner')->enqueue_static();
		fw()->backend->option_type('thz-color-picker')->enqueue_static();
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
	protected function _get_value_from_input($option, $input_value)	{
		
		if ( is_array( $input_value ) ) {
			
			$value = $this->_check_multi_value_data($input_value);

		} else {
			
			$value = $option['value'];
		}

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
    protected function _get_defaults()
    {

        return array(
            'value' => array(
				'background'=> array(),
				'oeffect' => 'thz-hover-fadein',
				'oduration' => 'thz-transease-04',
				'ieffect' => 'thz-img-zoomin',
				'iduration' => 'thz-transease-04',
				'iceffect' => 'thz-comein-bottom',
				'icduration' => 'thz-transease-05',
			),
			'labels' => array(
				'background' => esc_html__('Overlay background','creatus'),
				'overlay' => esc_html__('Overlay effect','creatus'),
				'image' => esc_html__('Image effect','creatus'),
				'icons' => esc_html__('Icons effect','creatus'),
			),
			'descriptions' => array(
				'background' => esc_html__('Set overlay background', 'creatus'),
				'overlay' => esc_html__('Select overlay hover effect and duration','creatus'),
				'image' => esc_html__('Select image hover effect and duration', 'creatus'),
				'icons' => esc_html__('Select icons hover effect and duration', 'creatus'),
			),			
        );
    }
}

FW_Option_Type::register('FW_Option_Type_ThzHover');