<?php if (!defined('FW')) {
	die('Forbidden');
}

class FW_Option_Type_ThzHotSpots extends FW_Option_Type
{
	public function get_type()
	{
		return 'thz-hotspots';
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
	 * {@inheritdoc}
	 */
	protected function _enqueue_static($id, $option, $data)
	{
		$uri = get_template_directory_uri() . '/inc/includes/option-types/' . $this->get_type();
		
		fw()->backend->option_type('thz-multi-options')->enqueue_static();
		fw()->backend->option_type('thz-color-picker')->enqueue_static();
		fw()->backend->option_type('thz-url')->enqueue_static();
		fw()->backend->option_type('upload')->enqueue_static();
		
		wp_enqueue_style(
			'fw-option-' . $this->get_type(),
			$uri . '/static/css/styles.css',
			array(),
			fw()->theme->manifest->get_version()
		);
		
		wp_enqueue_script(
			'fw-option-' . $this->get_type().'thz-add-link',
			$uri . '/static/js/ThzHotSpots.js',
			array('jquery', 'fw-events', 'jquery-ui-draggable'),
			fw()->theme->manifest->get_version()
		);
		
		
		wp_enqueue_script(
			'fw-option-' . $this->get_type(),
			$uri . '/static/js/scripts.js',
			array('jquery', 'fw-events'),
			fw()->theme->manifest->get_version()
		);
		
		

		
		
	}

	/**
	 * @internal
	 */
	protected function _render($id, $option, $data)
	{
		

		$option['attr']['data-for-js'] =
			/**
			 * Prevent js error when the generated html is used in another option type js template with {{...}}
			 * Do this trick because {{ is not escaped/encoded by fw_htmlspecialchars()
			 * Fixes https://github.com/ThemeFuse/Unyson/issues/1877
			 */
			json_encode(explode('{{',
			json_encode($this->_hotspot_defaults())
		));		
		
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
			return $option['value'];
		}
		
		$input_value['image'] 		= $this->get_attachment_info($input_value['image']);
		$input_value['hotspots'] 	= json_decode($input_value['hotspots'],true);
		
		return $input_value;


	}


	private function get_attachment_info($attachment_id)
	{
		$url = wp_get_attachment_url($attachment_id);
		if ($url) {
			return array(
				'attachment_id' => $attachment_id,
				'url'           => preg_replace('/^https?:\/\//', '//', $url)
			);
		} else {
			$defaults = $this->get_defaults();
			return $defaults['value']['image'];
		}
	}


	/**
	 * @internal
	 */
	protected function _get_defaults()
	{
		return array(
			'value' => array(
				'image' => array(),
				'hotspots' => array()
			),
		);
	}
	

	/*
	 * Puts each option into a separate array
	 * to keep their order inside the modal dialog
	 */
	private function transform_options($options)
	{
		$new_options = array();
		foreach ($options as $id => $option) {
			if (is_int($id)) {
				/**
				 * this happens when in options array are loaded external options using fw()->theme->get_options()
				 * and the array looks like this
				 * array(
				 *    'hello' => array('type' => 'text'), // this has string key
				 *    array('hi' => array('type' => 'text')) // this has int key
				 * )
				 */
				$new_options[] = $option;
			} else {
				$new_options[] = array($id => $option);
			}
		}
		return $new_options;
	}
		
	/**
	 * @internal
	 */
	protected function _hotspot_defaults()
	{
		$defaults = array(
			'defaulttab' => array(
				'title' => __('Defaults', 'creatus'),
				'type' => 'tab',
				'lazy_tabs' => false,
				'options' => array(
					'mx' => array(
						'type' => 'thz-multi-options',
						'label' => __('Hotspot colors', 'creatus'),
						'desc' => esc_html__('Adjust hotspot colors. See help for more info.', 'creatus'),
						'help' => esc_html__('This option overrides global hotspots colors.', 'creatus'),
						'value' => array(
							'bg' => '',
							'mark' => '',
							'halo' => ''
						),
						'thz_options' => array(
							'bg' => array(
								'type' => 'color',
								'title' => esc_html__('Background', 'creatus'),
								'box' => true
							),
							'mark' => array(
								'type' => 'color',
								'title' => esc_html__('Mark', 'creatus'),
								'box' => true
							),
							'halo' => array(
								'type' => 'color',
								'title' => esc_html__('Halo', 'creatus'),
								'box' => true
							)
						)
					),
					'link' => array(
						'type' => 'thz-url',
						'value' => array(
							'type' => 'normal',
							'url' => '',
							'title' => '',
							'target' => '_self',
							'magnific' => ''
						),
						'data-parent' => 'parent',
						'data-type' => '.thz-url-type,.linkType',
						'data-link' => '.thz-url-input,.normalLink',
						'data-title' => '.thz-url-title,.linkTitle',
						'data-target' => '.thz-url-target,.linkTarget',
						'data-magnific' => '.thz-url-magnific,.magnificId',
						'label' => __('Hotspot link', 'creatus'),
						'desc' => esc_html__('Add hotspot link.', 'creatus'),
					),				

					'remove' => array(
						'type' => 'html',
						'html' => '<a class="thz-remove-hotspot" href="#">'.esc_html__('Delete this hotspot', 'creatus').'</a>',
						'label' => __('Delete hotspot', 'creatus'),
						'desc' => __('Click on the button to delete this hotspot. Note that there is no warning before the removal!', 'creatus')
					)
				)
			),
			'tooltiptab' => array(
				'title' => __('Tooltip', 'creatus'),
				'type' => 'tab',
				'lazy_tabs' => false,
				'options' => array(
					'tmx' => array(
						'type' => 'thz-multi-options',
						'label' => __('Tooltip metrics', 'creatus'),
						'desc' => esc_html__('Adjust tooltip metrics.', 'creatus'),
						'value' => array(
							'style' => 'light',
							'size' => 'default',
							'position' => 'top',
							'visibility' => 'hover'
						),
						'breakafter' => 'select',
						'thz_options' => array(
							'style' => array(
								'type' => 'short-select',
								'title' => esc_html__('Style', 'creatus'),
								'choices' => array(
									'light' => esc_html__('Light', 'creatus'),
									'dark' => esc_html__('Dark', 'creatus'),
								)
							),							
							'size' => array(
								'type' => 'short-select',
								'title' => esc_html__('Size', 'creatus'),
								'choices' => array(
									'default' => esc_html__('Default ( max-width 200px )', 'creatus'),
									'medium' => esc_html__('Medium ( max-width 350px )' , 'creatus'),
									'large' => esc_html__('Large ( max-width 500px )', 'creatus'),
								)
							),
							'position' => array(
								'type' => 'short-select',
								'title' => esc_html__('Position', 'creatus'),
								'choices' => array(
									'top' => esc_html__('Top', 'creatus'),
									'top-left' => esc_html__('Top left', 'creatus'),
									'top-right' => esc_html__('Top right', 'creatus'),
									'right' => esc_html__('Right', 'creatus'),
									'bottom' => esc_html__('Bottom', 'creatus'),
									'bottom-left' => esc_html__('Bottom left', 'creatus'),
									'bottom-right' => esc_html__('Bottom right', 'creatus'),
									'left' => esc_html__('Left', 'creatus')
								)
							),
							'visibility' => array(
								'type' => 'short-select',
								'title' => esc_html__('Visibility', 'creatus'),
								'choices' => array(
									'always' => esc_html__('Always visible', 'creatus'),
									'hover' => esc_html__('Show on hover', 'creatus'),
								)
							),
							
						)
					),
					'tooltip' => array(
						'type' => 'wp-editor',
						'size' => 'large',
						'editor_height' => 100,
						'editor_type' => 'tinymce',
						'wpautop' => true,
						'shortcodes' => false,
						'value' => '',
						'label' => __('Tooltip text', 'creatus'),
						'desc' => esc_html__('Add tooltip text', 'creatus')
					)
				)
			)
		);
		
		
		return $this->transform_options($defaults);
	}	

}

FW_Option_Type::register('FW_Option_Type_ThzHotSpots');
