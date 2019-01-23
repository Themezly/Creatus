<?php if (!defined('FW')) die('Forbidden');

class FW_Option_Type_Thz_Addable_Layer extends FW_Option_Type
{
	public function get_type()
	{
		return 'thz-addable-layer';
	}

	public function _get_backend_width_type()
	{
		return 'full';
	}


	protected function _get_data_for_js($id, $option, $data = array()) {
		return false;
	}

	/**
	 * @internal
	 * {@inheritdoc}
	 */
	protected function _enqueue_static($id, $option, $data)
	{
		static $enqueue = true;

		/**
		 * Use hardcoded type because this class is extended and type is changed, but the paths must be the same
		 * Fixes https://github.com/ThemeFuse/Unyson/issues/1769#issuecomment-247054955
		 */
		$uri = get_template_directory_uri() . '/inc/includes/option-types/' . $this->get_type();

		if ($enqueue) {
			wp_enqueue_style(
				'fw-option-' . $this->get_type(),
				$uri . '/static/css/styles.css',
				array('fw'),
				fw()->manifest->get_version()
			);

			wp_enqueue_script(
				'fw-option-' . $this->get_type(),
				$uri . '/static/js/scripts.js',
				array('underscore', 'fw-events', 'jquery-ui-resizable', 'jquery-ui-draggable', 'fw'),
				fw()->manifest->get_version(),
				true
			);
			
			
			wp_enqueue_style(
				'fw-option-' . $this->get_type().'-rotate',
				$uri . '/static/js/rotate/jquery.ui.rotatable.css',
				array('fw'),
				fw()->manifest->get_version()
			);
			
			wp_enqueue_script(
				'fw-option-' . $this->get_type().'-rotate',
				$uri . '/static/js/rotate/jquery.ui.rotatable.min.js',
				array('underscore', 'fw-events', 'jquery-ui-resizable', 'jquery-ui-draggable', 'fw'),
				fw()->manifest->get_version(),
				true
			);

			$enqueue = false;
		}

		fw()->backend->enqueue_options_static($option['layer-options']);

		return true;
	}

	/**
	 * Generate option's html from option array
	 * @param string $id
	 * @param array $option
	 * @param array $data
	 * @return string HTML
	 * @internal
	 */
	protected function _render($id, $option, $data)
	{
		unset($option['attr']['name'], $option['attr']['value']);
		
		
/*		$all_img_sizes 	= thz_all_image_sizes();
		$thz_small 		= $all_img_sizes['thz-img-small']['width'];
		
		fw_print($thz_small);*/
		
		$layer_options = array_merge($this->_layer_defaults(),$option['layer-options']);
		
		$option['attr']['data-for-js'] =
			/**
			 * Prevent js error when the generated html is used in another option type js template with {{...}}
			 * Do this trick because {{ is not escaped/encoded by fw_htmlspecialchars()
			 * Fixes https://github.com/ThemeFuse/Unyson/issues/1877
			 */
			json_encode(explode('{{',
			json_encode(array(
				'title' => empty($option['layer-title']) ? $option['label'] : $option['layer-title'],
				'options' => $this->transform_options( $layer_options ),
				'template' => $option['template'],
				'size' => $option['size'],
				'limit' => $option['limit'],
			))
		));

		$data_items = $data['value'];
		
		unset($data_items['c~s']);
		
		return fw_render_view(
			dirname(__FILE__) . '/view.php',
			compact('id', 'option', 'data','data_items')
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
	 * Extract correct value for $option['value'] from input array
	 * If input value is empty, will be returned $option['value']
	 * @param array $option
	 * @param array|string|null $input_value
	 * @return string|array|int|bool Correct value
	 * @internal
	 */
	protected function _get_value_from_input($option, $input_value)
	{
		if (is_null($input_value)) {
			$values = $option['value'];
		} elseif (is_array($input_value)) {
			
			$values = array();
			$cs = $input_value['c~s'];
			
			unset($input_value['c~s']);
			
			foreach ($input_value as $key => $elem){

				/**
				 * Do JSON deconding only if $elem is not already parsed.
				 * json_decode will throw an error when passing him anything
				 * but a string.
				 */
				if (is_array($elem)) {
					$values[] = $elem;
				} else {
					$values[] = json_decode($elem, true);
				}
				

			}

			if ( $option['limit'] = intval( $option['limit'] ) ) {
				$values = array_slice( $values, 0, $option['limit'] );
			}
			
			$values['c~s'] = $cs;
			
		} else {
			$values = array();
		}
		
		
		// values filter
		$values = apply_filters('fw:option-type:thz-addable-layer:value-from-input', $values, $option);
		
		
		
		/**
		 * For e.g. option type 'unique' needs to execute _get_value_from_input() for each option
		 * to prevent duplicate values
		 */
		return apply_filters('fw:option-type:addable-popup:value-from-input', $values, $option);
	}


	protected function _layer_defaults()
	{
		
		$defaults = array(
		
			'layer_data' => array(
				'label' => __('Layer metrics', 'creatus'),
				'type'  => 'thz-multi-options',
				'desc' => esc_html__('Use these options to precisely position the layer.', 'creatus'),
				'help' => esc_html__('Sometimes you need a specific position between the layers and drag might be cumbersome in that case. The exact coordinates can help you set the layer exactly where you need it. Note that all layer dimensions are in percentages.', 'creatus'),
				'value' => array(
					'y' => 0,
					'x' => 0,
					'w' => 40,
					'h' => 30,
					'r' => 0,
					'z' => 0,
				),
				'thz_options' => array(
					'y' => array(
						'title' => __('Top', 'creatus'),
						'type' => 'spinner',
						'addon' => '%',
					),
					'x' => array(
						'title' => __('Left', 'creatus'),
						'type' => 'spinner',
						'addon' => '%',
					),
					'w' => array(
						'title' => __('Width', 'creatus'),
						'type' => 'spinner',
						'addon' => '%',
					),
					'h' => array(
						'title' => __('Height', 'creatus'),
						'type' => 'spinner',
						'addon' => '%',
					),
					'r' => array(
						'title' => __('Rotate', 'creatus'),
						'type' => 'spinner',
						'addon' => 'deg',
					),
					'z' => array(
						'title' => __('Z-index', 'creatus'),
						'type' => 'spinner',
						'min' => 0,
						'addon' => '#',
					),
				)
			)
		

		);
		
		
		return $defaults;
	}	


	/**
	 * Default option array
	 *
	 * This makes possible an option array to have required only one parameter: array('type' => '...')
	 * Other parameters are merged with array returned from this method
	 *
	 * @return array
	 *
	 * array(
	 *     'value' => '',
	 *     ...
	 * )
	 * @internal
	 */
	protected function _get_defaults()
	{
		return array(
			'value' => array(),
			'layer-options' => array(
				'default' => array('type' => 'text'),
			),
			'template' => '',
			'layer-title' => null,
			'limit' => 0,
			'size' => 'small', // small, medium, large
			'add-button-text' => __('Add', 'creatus'),
		);
	}

}

FW_Option_Type::register('FW_Option_Type_Thz_Addable_Layer');