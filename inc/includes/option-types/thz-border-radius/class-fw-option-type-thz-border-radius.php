<?php if (!defined('FW')) {
	die('Forbidden');
}

class FW_Option_Type_Thzborderradius extends FW_Option_Type
{
	public function get_type()
	{
		return 'thz-border-radius';
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
	 * {@inheritdoc}
	 */
	protected function _enqueue_static($id, $option, $data)
	{
		$uri = get_template_directory_uri() . '/inc/includes/option-types/' . $this->get_type();

		wp_enqueue_style(
			'fw-option-' . $this->get_type(),
			$uri . '/static/css/styles.css',
			array(),
			fw()->theme->manifest->get_version()
		);
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

		foreach ($value as $property => $sub_props) {
			if (isset($input_value[$property])) {
				$value[$property]= (string)$input_value[$property];
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
				'top-left' => 0,
				'top-right' => 0,
				'bottom-left' => 0,
				'bottom-right' => 0,
			)
		);
	}
}

FW_Option_Type::register('FW_Option_Type_Thzborderradius');
