<?php if ( ! defined( 'ABSPATH' ) ) die( 'Direct access forbidden.' );


class FW_Option_Type_ThzLogo extends FW_Option_Type
{
    public function get_type()
    {
        return 'thz-logo';
    }

    /**
     * @internal
     */
    protected function _enqueue_static($id, $option, $data)
    {
        $uri = get_template_directory_uri() .'/inc/includes/option-types/'. $this->get_type() .'/static';
		
		
		fw()->backend->option_type('thz-typography')->enqueue_static();
		fw()->backend->option_type('thz-box-style')->enqueue_static();
		fw()->backend->option_type('thz-color-picker')->enqueue_static();
		fw()->backend->option_type('thz-spinner')->enqueue_static();
		fw()->backend->option_type('thz-radio')->enqueue_static();
		fw()->backend->option_type('upload')->enqueue_static();
		
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
		return fw_render_view(dirname(__FILE__) . '/view.php', array(
			'id' => $id,
			'option' => $option,
			'data' => $data,

		));
	}
	
	

	/**
	 * @internal
	 */
	protected function _get_value_from_input($option, $input_value)
	{
		
		
		
		if (!is_array($input_value)) {
			
			$value =  $option['value'];
			$input_value = $value;
			
		}else{
			
			$input_value = $this->_check_multi_value_data($input_value);
			
			$value = $input_value;
			
		}
		 
		foreach ($option['value'] as $key => $val){
			
			if (isset($input_value[$key])) {
				$value[$key] = $input_value[$key];
			}
			
			if($key == 'boxstyle'){	
			
				foreach ($value[$key]['margin'] as $sub => $prop){
					
					if( $prop === '' ){
						
						unset($value[$key]);
						break;
					}
					
				}
			}
			
			if($key == 'image' || $key == 'sticky' || $key == 'mobile' || $key == 'svgimg' || $key == 'darksections' || $key == 'lightsections'){	
				if(isset($input_value[$key])){
					
					$value[$key] = $this->_process_images($input_value[$key]);
					
				}else{
					
					$value[$key] = '';
					
				}
			}
			
		}
		
		if(isset($value['f'])){
			$f_gfont 		= thz_typo_get_google_link($value['f']);
			if($f_gfont){
				$value['f']['google_font_link'] 	= $f_gfont;
			}
		}
        
		if(isset($value['sub-f'])){
			$subf_gfont 	= thz_typo_get_google_link($value['sub-f']);
			if($subf_gfont){
				$value['sub-f']['google_font_link'] = $subf_gfont;
			}
		}
        
		return $value;

	}

	/**
	 * @internal
	 */	
	protected function _process_images($value){
		
		$url = wp_get_attachment_url($value);
		
		if ($url) {
			$src = wp_get_attachment_image_src($value,'full');
			return array(
				'attachment_id' => $value,
				'url'           => preg_replace('/^https?:\/\//', '//', $url),
				'width' => $src[1],
				'height' => $src[2],
			);
		} else {
		
			return $value;
		}		
	}
	/**
	 * @internal
	 */	
	protected function _check_multi_value_data($value){
		
		foreach($value as $key => $group){
			
			if(isset($group['value_data'])){
				$value[$key] = json_decode($group['value_data'],true);
			}	
			
					
			if('boxstyle' == $key){
				
				foreach($group as $prop => $v){
					
					if(isset($v['value_data'])){
						$value[$key][$prop] = json_decode($v['value_data'],true);
					}
				}				
				
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
				'type'=>'textual',
				'image' => array(),
				'darksections' => array(),
				'lightsections' => array(),
				'sticky' => array(),
				'mobile' => array(),
				'svgimg' => array(),
				'text'=> '',
				'f'=> array(
					'family'  		=> 'Arial, Helvetica, sans-serif',
					'style'     	=> '400',
					'subset'    	=> false,
					'size' 			=> 14,
					'line-height' 	=> 1.618,
					'spacing'		=>'normal',
					'color' 		=> '#444444',				
				),
				'sub-text'=> '',
				'sub-f'=> array(
					'family'  		=> 'Arial, Helvetica, sans-serif',
					'style'     	=> '400',
					'subset'    	=> false,
					'size' 			=> 14,
					'line-height' 	=> 1.618,
					'spacing'		=>'normal',
					'color' 		=> '#444444',				
				),
				'sc'=> array(
					't'=> '',
					's'=> '',
				),
				'mc'=> array(
					't'=> '',
					's'=> '',
				),
				'ds'=> array(
					't'=> '',
					's'=> '',
				),
				'ls'=> array(
					't'=> '',
					's'=> '',
				),
				'svg'=> array(
					'd'=> '',
					'ds'=> '',
					'ls'=> '',
					's'=> '',
					'm'=> '',
					'a'=> 'fill',
				),
				'width'=> 90,
				'height'=> 80,
				'mwidth'=> 90,
				'mheight'=> 80,
				'boxstyle'=>array(
					'margin' => array(
						'top' => '0',
						'right' => 'auto',
						'bottom' => '0',
						'left' => 'auto'
					),			
				),
			)
			
        );
    }
}

FW_Option_Type::register('FW_Option_Type_ThzLogo');