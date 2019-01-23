<?php if ( ! defined( 'ABSPATH' ) ) die( 'Direct access forbidden.' );


class FW_Option_Type_ThzImage extends FW_Option_Type
{
    public function get_type()
    {
        return 'thz-image';
    }

    /**
     * @internal
     */
    protected function _enqueue_static($id, $option, $data)
    {
        $uri = get_template_directory_uri() .'/inc/includes/option-types/'. $this->get_type() .'/static';


        wp_enqueue_script('thickbox');
        wp_enqueue_style('thickbox');
        wp_enqueue_script('media-upload');
		
        wp_enqueue_style(
            'fw-option-'. $this->get_type(),
            $uri .'/css/styles.css'
        );
		
        wp_enqueue_script(
            'fw-option-'. $this->get_type(),
            $uri .'/js/scripts.js',
            array('fw-events', 'jquery')
        );
		
		wp_localize_script(
			'fw-option-'. $this->get_type(),
			'thz_image',
			array(
				'title' => esc_html__('Select or upload image', 'creatus'),
				'button' => esc_html__('Insert image', 'creatus'),
			)
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
		

		$is_empty               = empty($data['value']);
		
		if(!is_array($data['value'])){
			
			$data['value'] = json_decode($data['value'],true);
		}
		
		$this_image_id			= isset($data['value']['id']) ? $data['value']['id'] : 0;
		$this_image_src			= isset($data['value']['url']) ? $data['value']['url'] : '';	
		$no_image				= get_template_directory_uri() .'/inc/includes/option-types/'. $this->get_type() .'/static/img/no-image.png';
		$f_image				= get_template_directory_uri() .'/inc/includes/option-types/'. $this->get_type() .'/static/img/featured-image.png';
		
		if($option['featured'] && $data['value'] == 'featured'){
			
			$thumb_url         		= $no_image;
			$button_remove_class	= ' thz-remove-image';
			$hasImage_class			= '';	
					
		}else{

			if($is_empty){
				
				$thumb_url         		= $no_image;
				$button_remove_class	= ' thz-remove-image';
				$hasImage_class			= '';	
				
			}else{
				
				$thumb_url         		= wp_get_attachment_image_src($this_image_id, 'thumbnail');
				$thumb_url				= $thumb_url[0];
				$button_remove_class	= ' thz-remove-image show_button';	
				$hasImage_class			= ' hasImage';
			}
			
			
			if($this_image_id == 0 && $this->_is_image( $this_image_src )){
				
				$thumb_url = $this_image_src;
				
			}
			
		}
		
		$url 			= isset( $data['value']['url'] ) ?  $data['value']['url'] : '';
		$this_image_src = $option['featured']  && $url == 'featured' ? 'featured' : esc_url($this_image_src);
		
		return fw_render_view(dirname(__FILE__) . '/view.php', array(
		
			'id' 					=> $id,
			'option' 	   			=> $option,
			'data' 		   			=> $data,
			'is_empty'     			=> $is_empty,
			'this_image_id'			=> esc_attr($this_image_id),
			'no_image'     			=> $no_image,
			'f_image'     			=> $f_image,
			'this_image_src'		=> $this_image_src,
			'thumb_url'				=> esc_url($thumb_url),
			'button_remove_class'	=> $button_remove_class,
			'hasImage_class'		=> $hasImage_class,
			'json_val'				=> json_encode($data['value'],true)
		));
	}
	
	
	protected function _is_image( $src ){
		
		$extensions 	= array("gif", "jpg", "jpeg", "png", "tiff", "tif");
		$filetype       = wp_check_filetype( $src );
		if (in_array((string) $filetype['ext'], $extensions)) {
			return true;
		}		
		
	}
	/**
	 * @internal
	 */
	protected function _get_value_from_input($option, $input_value)
	{
		
		if( !empty($input_value) ){
			
			$value = $input_value;
			
		}else{
			
			$value = $option['value'] ;
		}		


		if(!is_array($value)){
			
			$value = json_decode($value,true);
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
			'featured'=> false // featured image
        );
    }
}

FW_Option_Type::register('FW_Option_Type_ThzImage');