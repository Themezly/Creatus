<?php if (!defined('FW')) {
	die('Forbidden');
}


class FW_Option_Type_ThzPalette extends FW_Option_Type {
	public function get_type() {
		return 'thz-palette';
	}
	/**
	 * @internal
	 * {@inheritdoc}
	 */
	protected function _enqueue_static( $id, $option, $data ) {
		
        $uri = get_template_directory_uri() .'/inc/includes/option-types/'. $this->get_type() .'/static';
		
        wp_enqueue_style(
            'fw-option-'. $this->get_type(),
            $uri .'/css/styles.css'
        );

		wp_enqueue_script(
			'fw-option-' . $this->get_type(),
			$uri . '/js/scripts.js',
			array( 'fw-events', 'iris','fw-option-thz-color-picker-palette', ),
			fw()->theme->manifest->get_version(),
			true
		);			
	}
	/**
	 * @param string $id
	 * @param array $option
	 * @param array $data
	 *
	 * @return string
	 *
	 * @internal
	 */
	protected function _render( $id, $option, $data ) {

		$palette = isset($data['value']) ? $data['value'] : $option['value'];
		$palette = thz_array_insert($palette,$this->_palette_shades(),1);
		
		
		$option['attr']['data-palette-set'] = json_encode($palette);
		return fw_render_view(dirname(__FILE__) . '/view.php', array(
			'id' => $id,
			'option' => $option,
			'data' => $data,
		));

	}
	
	
	protected function _palette_shades(){
	
		return thz_palette_shades();
		
	}
	
	
	/**
	 * @internal
	 */
	protected function _get_value_from_input($option, $input_value)	{

		if ( is_array( $input_value ) ) {
			
			$value = $input_value;

		} else {
			
			$value = $option['value'];
		}
		
		return $value;

	}
	/**
	 * @internal
	 */
	protected function _get_defaults() {
        return array(
			'value' => array(
				'color_1' => '#039bf4',
				'color_2' => '#454545',
				'color_3' => '#8f8f8f',
			),
        );
	}
}

FW_Option_Type::register('FW_Option_Type_ThzPalette');
