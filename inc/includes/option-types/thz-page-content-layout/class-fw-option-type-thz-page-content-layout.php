<?php if ( ! defined( 'ABSPATH' ) ) die( 'Direct access forbidden.' );


class FW_Option_Type_ThzPageContentLayout extends FW_Option_Type
{


    public function get_type()
    {
        return 'thz-page-content-layout';
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
            'fw-option-'. $this->get_type(),
            $uri .'/js/scripts.js',
            array( 'fw-events', 'jquery')
        );

		fw()->backend->option_type('image-picker')->enqueue_static();
		fw()->backend->option_type('thz-spinner')->enqueue_static();
		
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
		

		$uri = get_template_directory_uri() .'/inc/includes/option-types/'. $this->get_type() .'/static';
		
		return fw_render_view(dirname(__FILE__) . '/view.php', array(
			'id' => $id,
			'option' => $option,
			'data'=>$data,
			'uri'=>$uri
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

		if(isset($input_value['value_data'])){
			
			$value_data = json_decode($input_value['value_data'],true);
		
			foreach($value_data as $key => $opt){

				$input_value[$key] = $opt;
			}
			
			unset ($input_value['value_data']);
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
			'value'	=>	array(
				'layout'=>'left',
				'leftblock'=>25,
				'contentblock'=>75,
				'rightblock'=>0,
			)
        );
    }
	
	
}

FW_Option_Type::register('FW_Option_Type_ThzPageContentLayout');