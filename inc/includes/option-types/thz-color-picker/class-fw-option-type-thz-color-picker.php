<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

/**
 * RGBA Color Picker
 */
class FW_Option_Type_thz_Color_Picker extends FW_Option_Type {
	/**
	 * @internal
	 */
	public function _get_backend_width_type() {
		return 'auto';
	}

	/**
	 * @internal
	 * {@inheritdoc}
	 */
	protected function _enqueue_static( $id, $option, $data ) {
		
		$uri = get_template_directory_uri() .'/inc/includes/option-types/'. $this->get_type() .'/static';
		
		
		fw()->backend->option_type('thz-palette')->enqueue_static();
		
		
		wp_enqueue_style(
			'fw-option-' . $this->get_type(),
			$uri . '/css/styles.css' ,
			array(),
			fw()->theme->manifest->get_version()
		);

		wp_enqueue_script(
			'fw-option-' . $this->get_type(),
			$uri . '/js/scripts.js',
			array( 'fw-events', 'iris' ),
			fw()->theme->manifest->get_version(),
			true
		);
		
		wp_enqueue_script(
			'fw-option-' . $this->get_type().'-palette',
			$uri . '/js/ThzPalette.js',
			array( 'jquery','fw-events', 'iris' ,'fw-option-' . $this->get_type() ),
			fw()->theme->manifest->get_version(),
			true
		);
		
		
		wp_localize_script('fw-option-' . $this->get_type(), 'thz_picker_vars', array(
				'reset_txt' => esc_html__('Reset', 'creatus'),
				'theme_txt' => esc_html__('Theme', 'creatus'),
				'flat_txt' => esc_html__('Flat', 'creatus'),
				'material_txt' => esc_html__('Material', 'creatus'),
				'picker_txt' => esc_html__('Picker', 'creatus'),
				'thz_palette' => json_encode($this->_get_palette()),
			)
		);
	}

	public function get_type() {
		return 'thz-color-picker';
	}
	
	
	protected function _get_palette(){
		
		$get_palette = fw_get_db_settings_option('theme_palette', array(
				'color_1' => '#039bf4',
				'color_2' => '#454545',
				'color_3' => '#8f8f8f',
				'color_4' => '#eaeaea',
				'color_5' => '#fafafa',
		));
		$color_1		= fw_get_db_settings_option('theme_palette/color_1','#039bf4');
		$get_palette 	= thz_array_insert($get_palette,thz_palette_shades($color_1),1);
		
		return $get_palette;
		
	}
	
	
	/**
	 * @internal
	 */
	protected function _render( $id, $option, $data ) {
		
		$current = isset($data['value']) ? $data['value'] : $option['value'];
		
		$option['attr']['value'] = $data['value'];
		
		$is_boxed = $option['box'] ? ' is-boxed' : ' is-boxed is-full';
		
		$option['attr']['data-reset'] = $option['value'];
		
		$palette_color ='';
		
		if (strpos($current, 'color_') !== false) {
			$palette_color =' palette-color';
			$option['attr']['class'] .= ' using-'.$current;
		}
		
		return fw_render_view(dirname(__FILE__) . '/view.php', array(
			'id' => $id,
			'option' => $option,
			'data' => $data,
			'is_boxed' => $is_boxed,
			'palette_color' => $palette_color,
			'current' => thz_replace_palette_colors( $current, $this->_get_palette() )
		));
	}

	/**
	 * @internal
	 */
	 
		protected function _get_value_from_input( $option, $input_value ) {
		
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
				return (string)$option['value'];
			} else {
				return (string)$input_value;
			}

		}

	/**
	 * @internal
	 */
	protected function _get_defaults() {
		return array(
			'value' => '',
			'box' => false
		);
	}
}

FW_Option_Type::register( 'FW_Option_Type_thz_Color_Picker' );
