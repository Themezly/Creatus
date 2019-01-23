<?php if (!defined('FW')) {
	die('Forbidden');
}

class FW_Option_Type_ThzPageTemplates extends FW_Option_Type
{
	public function get_type()
	{
		return 'thz-page-templates';
	}

	/**
	 * @internal
	 */
	public function _get_backend_width_type(){
		return 'fixed';
	}


	public function _init()
	{
		add_action('wp_ajax_thz_page_templates_load',   array($this, '_action_ajax_load_template'));
		add_action('wp_ajax_thz_page_templates_save',   array($this, '_action_ajax_save_template'));
		add_action('wp_ajax_thz_page_templates_delete', array($this, '_action_ajax_delete_template'));
	}

	/**
	 * @internal
	 */
	protected function _enqueue_static( $id, $option, $data ) {

		$uri = get_template_directory_uri() .'/inc/includes/option-types/'. $this->get_type() .'/static';

		wp_enqueue_style(
			'fw-option-' . $this->get_type(),
			$uri . '/css/styles.css'
		);


		wp_enqueue_script(
			'fw-option-' . $this->get_type().'-thz-page-templates',
			$uri . '/js/ThzPageTemplates.js',
			array('jquery', 'fw-events'),
			fw()->manifest->get_version()
		);

		wp_enqueue_script(
			'fw-option-' . $this->get_type(),
			$uri . '/js/scripts.js',
			array('jquery', 'fw-events','fw-option-' . $this->get_type().'-thz-page-templates'),
			fw()->manifest->get_version()
		);



		wp_localize_script('fw-option-'. $this->get_type(), '_thzoptmpl', array(
			
			'modal_title' => esc_html__('Save page options as template','creatus'),
			'modal_label' => esc_html__('Template name','creatus'),
			'modal_desc' => esc_html__('Insert desired template name','creatus'),
			'no_opt_title' => esc_html__('No custom options for this page','creatus'),
			'no_opt_msg' => esc_html__('To save page options template add custom page options first','creatus'),
			)
		);

	}

	/**
	 * @internal
	 */
	public function _action_ajax_save_template()
	{
		if (!current_user_can('edit_posts')) {
			wp_send_json_error();
		}
		

		$template = array(
			'title' => trim((string)FW_Request::POST('template_name')),
			'json' => trim((string)FW_Request::POST('json')),
			'created' => time(),
		);
		

		if (
			empty($template['json'])
			||
			($decoded_json = json_decode($template['json'], true)) === null

		) {
			wp_send_json_error();
		}

		unset($decoded_json);

		if (empty($template['title'])) {
			$template['title'] = __('No Title', 'creatus');
		}
		
		$uniquename = trim(strtolower(str_replace(' ','',$template['title'])));
		
		$template_id = md5($template['json'].$uniquename);

		update_option(
			$this->get_wp_option_prefix() . $template_id,
			$template,
			false
		);

		wp_send_json_success(array(
			'title' => $template['title'],
			'id' 	=> $template_id,
		));
	}	


	/**
	 * @internal
	 */
	public function _action_ajax_load_template()
	{
		if (!current_user_can('edit_posts')) {
			wp_send_json_error();
		}

		$template_id = (string)FW_Request::POST('template_id');

		$templates = $this->get_db_templates();
		
		wp_send_json_success(array(
			'json' => $templates[$template_id]['json']
		));

	}
	
		
	/**
	 * @internal
	 */
	public function _action_ajax_delete_template()
	{
		if (!current_user_can('edit_posts')) {
			wp_send_json_error();
		}

		$template_id = (string)FW_Request::POST('template_id');

		delete_option($this->get_wp_option_prefix() . $template_id);


		wp_send_json_success();
	}
	
		
	protected function get_db_templates()
	{
		$templates = array();

		$option_prefix = $this->get_wp_option_prefix();

		global $wpdb;
		
		$query = (array) $wpdb->get_results($wpdb->prepare("SELECT option_name FROM {$wpdb->options} WHERE option_name LIKE %s",
			$wpdb->esc_like( $option_prefix ) .'%'
		), ARRAY_A);
		
		foreach ($query as $row) {
			
			$key = str_replace($option_prefix,'', $row['option_name']);
			$templates[$key] = get_option($row['option_name']);
			
			unset($row);
		}
		unset($query);
		
		
		return $templates;
	}

	private function get_wp_option_prefix()
	{
		return 'thz:po:tmpl:';
	}
	
	/**
	 * @internal
	 */
	protected function _render($id, $option, $data)
	{
		
		return fw_render_view(dirname(__FILE__) . '/view.php', array(
			'id' => $id,
			'option' => $option,
			'templates' => $this->get_db_templates(),
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
		);
	}


}

FW_Option_Type::register('FW_Option_Type_ThzPageTemplates');