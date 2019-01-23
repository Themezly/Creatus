<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}
/**
 * Radio list
 */
class FW_Option_Type_ThzRadio extends FW_Option_Type
{
	public function get_type()
	{
		return 'thz-radio';
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
	protected function _render($id, $option, $data)
	{
		$option['value'] = (string)$data['value'];
		$div_attr = $option['attr'];
		unset($div_attr['name']);
		unset($div_attr['value']);
		if (  $option['inline'] ) {
			$div_attr['class'] .= ' fw-option-type-thz-radio-inline fw-clearfix thz-radio-group';
		}else{
			$div_attr['class'] .= ' fw-option-type-thz-radio-vertical fw-clearfix thz-radio-group';
		}
		$html = '<div '. fw_attr_to_html($div_attr) .'>';
		foreach ($option['choices'] as $value => $text) {
			$choice_id = $option['attr']['id'] .'-'. $value;
			$html .= '<div>'.
				'<label for="'. esc_attr($choice_id) .'">'.
					'<input type="radio" '.
						'name="'. esc_attr($option['attr']['name']) .'" '.
						'value="'. esc_attr($value) .'" '.
						'id="'. esc_attr($choice_id) .'" '.
						($option['value'] == $value ? 'checked="checked" ' : '').
					'> <span>'. htmlspecialchars($text, ENT_COMPAT, 'UTF-8').'</span>'.
				'</label>'.
			'</div>';
		}
		$html .= '</div>';
		return $html;
	}
	/**
	 * @internal
	 */
	protected function _get_value_from_input($option, $input_value)
	{
		if (!isset($option['choices'][$input_value])) {
			if (
				empty($option['choices']) ||
				isset($option['choices'][ $option['value'] ])
			) {
				$input_value = $option['value'];
			} else {
				reset($option['choices']);
				$input_value = key($option['choices']);
			}
		}
		return (string)$input_value;
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
	protected function _get_defaults()
	{
		return array(
			'inline'   => false, // Set this parameter to true in case you want all radio inputs to be rendered inline
			'value'   => '',
			'choices' => array()
		);
	}
}
FW_Option_Type::register('FW_Option_Type_ThzRadio');