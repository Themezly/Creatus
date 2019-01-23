<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

class FW_Option_Type_Thzicon extends FW_Option_Type {

	public function get_type() {
		return 'thz-icon';
	}

    /**
     * @internal
     */
    protected function _enqueue_static($id, $option, $data)
    {
        $uri = get_template_directory_uri() .'/inc/includes/option-types/'. $this->get_type() .'/static';


		fw()->backend->option_type('thz-spinner')->enqueue_static();
		fw()->backend->option_type('thz-color-picker')->enqueue_static();
		
        wp_enqueue_style(
            'fw-option-'. $this->get_type().'-fontpicker',
            $uri .'/css/jquery.fonticonpicker.css'
        );
		
        wp_enqueue_style(
            'fw-option-'. $this->get_type().'-pickertheme',
            $uri .'/css/jquery.fonticonpicker.grey.css'
        );
		
        wp_enqueue_style(
            'fw-option-'. $this->get_type(),
            $uri .'/css/styles.css'
        );
		
		wp_enqueue_style('font-awesome');
		wp_enqueue_style('thz-icons');
		
		
        wp_enqueue_script(
            'fw-option-'. $this->get_type().'-fontpicker',
            $uri .'/js/jquery.fonticonpicker.min.js',
            array('jquery')
        );		
		
        wp_enqueue_script(
            'fw-option-'. $this->get_type().'-script',
            $uri .'/js/scripts.js',
            array('fw-events', 'jquery')
        );
		
		$this->_enqueue_custom_icon_packs();
    }
	
	
	public function _get_custom_font_icon_packs(){
		
		$packs = apply_filters('thz_filter_font_icon_packs',array());
		
		return $packs;
		
	}
	
	public function _enqueue_custom_icon_packs(){
		
		$icon_packs = $this->_get_custom_font_icon_packs();
		
		if(empty($icon_packs)){
			
			return;
		}
				
		foreach($icon_packs as $handle => $pack){
			
			wp_enqueue_style(
				'fw-option-'. $this->get_type().'-'.$handle,
				$pack['css_file_uri']
			);			
		}
		
		
		wp_localize_script('fw-option-'. $this->get_type().'-fontpicker', '_thicon', array(
		
				'packs'=> $this->_build_font_icon_packs_list(),

			)
		);
		
	}

	
	/**
	 * Generate icons list from icons CSS files
	 * @return JSON string
	 */
	public function _build_font_icon_packs_list() {
		
		
		$icon_packs = $this->_get_custom_font_icon_packs();
		$transient  = 'thz_custom_font_icon_packs';

		if(empty($icon_packs)){
			
			if(get_transient($transient)){
				delete_transient($transient);
			}
			
			return;
			
		}

		if(false === ($icon_list = get_transient($transient))) {

			delete_transient($transient);

			$icon_list 	= array();
			$wpfs 		= thz_wp_file_system();
			
			foreach ($icon_packs as $pack_name => $pack) {
		
				if(!$pack['css_file_path']){
					continue;
				}
/*				
				$css = file_get_contents(
					$pack['css_file_path']
				);
				*/
				
				$css	= $wpfs->get_contents( $pack['css_file_path'] );
				
				$parser_matches = array();
				preg_match_all(
					'/(?ims)([a-z0-9\s\,\.\:#_\-@]+)\{([^\}]*)\}/',
					$css,
					$parser_matches
				);
				foreach ($parser_matches[0] as $i => $x) {
					$selector = trim($parser_matches[1][$i]);
					$value = trim($parser_matches[2][$i]);
					$is_correct_prefix = substr(
						$selector, 0,
						strlen('.' . $pack['css_class_prefix'])
					) === '.' . $pack['css_class_prefix'];
					$is_with_pseudo_element = is_numeric(strpos($selector, ':'));
					$has_content_for_pseudo = is_numeric(strpos($value, 'content'));
					/**
					 * It's probably an icon definition at this point.
					 */
					$selector_is_icon = $is_correct_prefix &&
										$is_with_pseudo_element &&
										$has_content_for_pseudo;
					if ($selector_is_icon) {
						$icon = explode(':', ltrim($selector, '.'));
						$icon = $icon[0];
						$title = isset($pack['title']) ? $pack['title'] : $pack_name;
						$icon_list[$title][] = $pack['css_class_prefix'].' '.$icon;
					}
					
					unset($x);
				}
				
				unset($pack);
			}
			
			if(!empty($icon_list)){
				set_transient($transient, $icon_list, 7 * DAY_IN_SECONDS);
			}
			
		}		
		
		return json_encode($icon_list);
			
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
		
		if ( is_array($option['value'])){
			
			$option['attr']['value'] = (string) $data['value']['icon'];
			
		}else{
		
			$option['attr']['value'] = (string) $data['value'];
		}

		
		if(isset($option['add-icons']) && !empty($option['add-icons'])){
			$option['attr']['data-add-icons'] =  json_encode($option['add-icons']);
		}
	
		if(isset($option['remove-icons']) && !empty($option['remove-icons'])){
			$option['attr']['data-remove-icons'] =  json_encode($option['remove-icons']);
		}	
		
		if(isset($option['remove-categories']) && !empty($option['remove-categories'])){
			$option['attr']['data-remove-categories'] =  json_encode($option['remove-categories']);
		}
		
		if(isset($option['categories']) && !empty($option['categories'])){
			$option['attr']['data-categories'] =  json_encode($option['categories']);
		}	
		
		return fw_render_view(dirname(__FILE__) . '/view.php', array(
			'id' => $id,
			'option' => $option,
			'data' => $data,
		));

	}

	/**
	 * @param array $option
	 * @param array|null|string $input_value
	 *
	 * @return string
	 *
	 * @internal
	 */
	protected function _get_value_from_input( $option, $input_value ) {
		
		
		if( is_null( $input_value ) ){
			
			$val = $option['value'];
			
		}else{
			
			$val = $input_value;
		}
		
		if ( is_array($val)){
			
			return $val;
			
		}else{
			
			return (string) $val;
		}
	}

	/**
	 * @internal
	 */
	protected function _get_defaults() {
		return array(
			'value' => '',
			'add-icons'=> array(),
			'remove-icons'=> array(),
			'remove-categories'=> array(),
			'categories'=> array(),
		);
	}
}

FW_Option_Type::register( 'FW_Option_Type_Thzicon' );
