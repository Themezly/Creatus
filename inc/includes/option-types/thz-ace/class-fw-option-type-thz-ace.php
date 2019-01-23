<?php if (!defined('FW')) {
	die('Forbidden');
}

class FW_Option_Type_ThzAce extends FW_Option_Type
{
	public function get_type(){
		
		return 'thz-ace';
	}

	/**
	 * @internal
	 */
	public function _get_backend_width_type(){
		return 'full';
	}

	/**
	 * @internal
	 * {@inheritdoc}
	 */
	protected function _enqueue_static($id, $option, $data)
	{
		$uri = get_template_directory_uri() . '/inc/includes/option-types/' . $this->get_type();
		$mode = $option['mode'];
		
		
		wp_enqueue_style(
			'fw-option-' . $this->get_type(),
			$uri . '/static/css/styles.css',
			array(),
			fw()->theme->manifest->get_version()
		);
		
		wp_enqueue_script(
			'thz-ace',
			$uri . '/static/js/ace/ace.js',
			array('jquery', 'fw-events'),
			fw()->theme->manifest->get_version()
		);
		
		wp_enqueue_script(
			'fw-option-' . $this->get_type(),
			$uri . '/static/js/scripts.js',
			array('jquery', 'fw-events','thz-ace'),
			fw()->theme->manifest->get_version()
		);

		
		
	}


	/**
	 * @internal
	 */
	protected function _render($id, $option, $data)
	{

		$option['value'] = (string) $data['value'];
		unset( $option['attr']['value'] ); // be sure to remove value from attributes
		$option['attr'] = array_merge( array( 'rows' => '6' ), $option['attr'] );
		$option['attr']['data-mode'] 	= 	$option['mode'];
		$option['attr']['data-theme'] 	= 	$option['theme'];
	
		return fw_render_view(dirname(__FILE__) . '/view.php', array(
			'id' => $id,
			'option' => $option,
			'data' => $data,
		));
	}

	/**
	 * @internal
	 */
	protected function _get_value_from_input($option, $input_value){

		return (string) ( is_null( $input_value ) ? $option['value'] : $input_value );

	}

	/**
	 * @internal
	 */
	protected function _get_defaults()
	{
		return array(
			'value' => '',
			'mode' => 'css', // css,html,javascript,json
			'theme'=> 'chrome', // chrome, tomorrow_night
			'height'=> 300,
			'width'=> '100%'
		);
	}


}

FW_Option_Type::register('FW_Option_Type_ThzAce');
