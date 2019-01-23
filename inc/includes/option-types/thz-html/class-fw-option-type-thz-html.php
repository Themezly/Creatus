<?php if (!defined('FW')) {
	die('Forbidden');
}

class FW_Option_Type_ThzHtml extends FW_Option_Type
{
	public function get_type()
	{
		return 'thz-html';
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
		
		return fw_render_view(dirname(__FILE__) . '/view.php', array(
			'id' => $id,
			'option' => $option,
			'data' => $data,
		));
	}

	/**
	 * @internal
	 */
	protected function _get_value_from_input($option, $input_value)	{
		return false;
	}

	/**
	 * @internal
	 */
	protected function _get_defaults()
	{
		return array(
			'value' => '',
			'html'  => '<em>default html</em>',
		);
	}


}

FW_Option_Type::register('FW_Option_Type_ThzHtml');