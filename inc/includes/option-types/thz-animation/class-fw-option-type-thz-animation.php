<?php if (!defined('FW')) {
	die('Forbidden');
}

class FW_Option_Type_Thzanimation extends FW_Option_Type
{
	public function get_type()
	{
		return 'thz-animation';
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
		
		fw()->backend->option_type('multi-picker')->enqueue_static();
		
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
			'data' => $data,
			'inner_option' => $this->get_inner_option($option)
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

		$inner_option = $this->get_inner_option($option);

		$value = fw()->backend->option_type($inner_option['type'])->get_value_from_input(
			$inner_option,
			$input_value
		);

		return array(
			'animate' => $value['picked'],
			'effect' => $value['active']['effect'],
			'duration' => $value['active']['duration'],
			'delay' => $value['active']['delay'],
			'kb' => $value['active']['kb'],
		);
	}

	/**
	 * @internal
	 */
	protected function _get_defaults()
	{
		return array(
			'value' => array(
				'animate' => 'inactive',
				'effect' => 'thz-anim-fadeIn',
				'duration'=> 1000,
				'delay' => 0,
				'kb' => array(
					'a' => 'inactive',
					'e' => 'in',
					'd' => 7				
				),
			),
			'addlabel'=>''
		);
	}

	/**
	 * @param array $set_multikeys array('multi/key', 'value')
	 * @return array
	 */
	private function get_inner_option($option)
	{
		
		
		$label = (isset($option['addlabel']) && !empty($option['addlabel'])) ? $option['addlabel'] : esc_html__('Animate', 'creatus');
		$desc = (isset($option['adddesc']) && !empty($option['adddesc'])) ? $option['adddesc'] : esc_html__('Add animation to the HTML container', 'creatus');
		$help = (isset($option['addhelp']) && !empty($option['addhelp'])) ? $option['addhelp'] :'';
		$draw = isset($option['draw']) ? $option['draw'] : false;
		
		return array(
			'type' => 'multi-picker',
			'label' => false,
			'desc' => false,
			'picker' => array(
				'picked' => array(
					'label' => $label,
					'desc' => $desc,
					'help' => $help,
					'type' => 'switch',
					'right-choice' => array(
						'value' => 'active',
						'label' => __('Yes', 'creatus')
					),
					'left-choice' => array(
						'value' => 'inactive',
						'label' => __('No', 'creatus')
					),
				)
			),

			'choices' => array(
				'active' => array(
					'effect' => array(
						'type' => 'select',
						'label' => __('Effect', 'creatus'),
						'desc' => esc_html__('Select the animation effect.', 'creatus'),
						'choices' => _thz_animations_list( $draw )
					),
					'duration' => array(
						'type' => 'thz-spinner',
						'label' => __('Duration', 'creatus'),
						'desc' => esc_html__('Set duration in milliseconds. 1000ms = 1s', 'creatus'),
						'addon' => 'ms',
						'min' => 0,
						'max' => 2000,
						'step' => 100,
					),
					'delay' => array(
						'type' => 'thz-spinner',
						'label' => __('Delay', 'creatus'),
						'desc' => esc_html__('Set delay in milliseconds. 1000ms = 1s', 'creatus'),
						'addon' => 'ms',
						'min' => 0,
						'max' => 10000,
						'step' => 100,
					),
					'kb' => array(
						'type' => 'thz-multi-options',
						'label' => __('Ken Burns', 'creatus'),
						'desc' => esc_html__('Activate Ken Burns effect after the animation.', 'creatus'),
						'help' => esc_html__('This option is best used on background layers or single elements. It is not recommend to be used on element groups such as posts or media gallery. Note that Zoom Out is best to be used with Fade In effect.', 'creatus'),
						'value' => array(
							'a' => 'inactive',
							'e' => 'in',
							'd' => 7
						),
						'thz_options' => array(
							'a' => array(
								'type' => 'select',
								'title' => esc_html__('Mode', 'creatus'),
								'attr' => array(
									'class' => 'thz-select-switch'
								),
								'choices' => array(
									'inactive' => array(
										'text' => esc_html__('Inactive', 'creatus') ,
										'attr' => array(
											'data-disable' => '.kb-items-parent',
										)
									),
									'active' => array(
										'text' => esc_html__('Active', 'creatus') ,
										'attr' => array(
											'data-enable' => '.kb-items-parent',
										)
									),
								)
							),
							'e' => array(
								'type' => 'select',
								'title' => esc_html__('Effect', 'creatus'),
								'attr' => array(
									'class' =>'kb-items'
								),
								'choices' => array(
									'in' => esc_html__('Zoom in', 'creatus'),
									'out' => esc_html__('Zoom out', 'creatus'),
								)
							),
							'd' => array(
								'type' => 'spinner',
								'attr' => array(
									'class' =>'kb-items'
								),
								'title' => esc_html__('Duration', 'creatus'),
								'addon' => 's',
								'min' => 0,
								'step' => 0.5,
								'max' => 30
							),
						)
					),

				)
			),
			'show_borders' => false
		);
	}
}

FW_Option_Type::register('FW_Option_Type_Thzanimation');
