<?php if (!defined('FW')) {
	die('Forbidden');
}

class FW_Option_Type_ThzUrl extends FW_Option_Type
{
	public function get_type()
	{
		return 'thz-url';
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
		
		wp_enqueue_script(
			'fw-option-' . $this->get_type().'thz-add-link',
			thz_theme_file_uri( '/inc/thzframework/admin/js/ThzAddLink.js'),
			array('jquery', 'fw-events', 'jquery-ui-autocomplete'),
			fw()->theme->manifest->get_version()
		);
		
		
		wp_enqueue_script(
			'fw-option-' . $this->get_type(),
			$uri . '/static/js/scripts.js',
			array('jquery', 'fw-events'),
			fw()->theme->manifest->get_version()
		);
		
		wp_localize_script('fw-option-' . $this->get_type().'thz-add-link', '_thz_add_link', array(


				'typelabel'=> esc_html__('Link type','creatus'),
				'typedesc'=> esc_html__('Select link type','creatus'),
				'typenormal'=> esc_html__('Normal link','creatus'),
				'typemagnific'=> esc_html__('Magnific popup','creatus'),
				'magnificlabel'=> esc_html__('Magnific popup','creatus'),
				'magnificdesc'=> esc_html__('Insert Magnific popup. See help for more info','creatus'),
				'magnifichelp'=> esc_html__('Add a link to an image or video. If link is not an image the popup will be opened as Magnific popup iframe. There is also a Magnific Popup page builder shortcode and it contains an ID option. You can add that ID here if you wish to open it via click. Remeber to use the # sign infront of the magnific popup id like this; #somepopupid','creatus'),
				'urllabel'=> esc_html__('URL','creatus'),
				'urldesc'=> esc_html__('Insert URL','creatus'),
				'titlelabel'=> esc_html__('Title','creatus'),
				'titledesc'=> esc_html__('Insert link title. Not used if empty','creatus'),
				'targetlabel'=> esc_html__('Target','creatus'),
				'same'=> esc_html__('Same window','creatus'),
				'new'=> esc_html__('New window','creatus'),
				'targetdesc'=> esc_html__('Select here if you want to open the linked page in a new window','creatus'),				
				'searchlabel'=> esc_html__('Search','creatus'),
				'searchdesc'=> esc_html__('Start typing to search for URL','creatus'),
				'addlink'=> esc_html__('Add / edit link','creatus'),
				'nomatch' => esc_html__('No match','creatus'),
			)
		);
		
		
	}

	/**
	 * @internal
	 */
	protected function _render($id, $option, $data)
	{
		
		
		$link_data_attr = 'data-parent="'.$option['data-parent'].'"';
		$link_data_attr .= ' data-type="'.$option['data-type'].'"';
		$link_data_attr .= ' data-link="'.$option['data-link'].'"';
		$link_data_attr .= ' data-title="'.$option['data-title'].'"';
		$link_data_attr .= ' data-target="'.$option['data-target'].'"';
		$link_data_attr .= ' data-magnific="'.$option['data-magnific'].'"';
		if(isset($option['data-hide'])){
			$link_data_attr .= ' data-hide="'.$option['data-hide'].'"';
		}
	
	
		return fw_render_view(dirname(__FILE__) . '/view.php', array(
			'id' => $id,
			'option' => $option,
			'data' => $data,
			'link_data_attr'=>$link_data_attr
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
		return $input_value;


	}

	/**
	 * @internal
	 */
	protected function _get_defaults()
	{
		return array(
			'value' => array(
				'type' =>'normal',
				'url' => '',
				'title' =>'',
				'target' =>'_self',
				'magnific' => '',
			),
			'data-parent'=>'parent',
			'data-type'=>'.thz-url-type',
			'data-link'=>'.thz-url-input',
			'data-title'=>'.thz-url-title',
			'data-target'=>'.thz-url-target',
			'data-magnific'=>'.thz-url-magnific'
		);
	}


}

FW_Option_Type::register('FW_Option_Type_ThzUrl');
