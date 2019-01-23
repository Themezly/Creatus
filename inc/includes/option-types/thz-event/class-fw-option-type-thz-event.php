<?php if ( ! defined( 'FW' ) ) die( 'Forbidden' );

/**
 * Class FW_Option_Type_Event
 *
 * The option FW_Option_Type_Event is for internal use only.
 * Do not use it for posts/terms options as it will not affect events functionality.
 * It works only in the events page.
 *
 */

class FW_Option_Type_ThzEvent extends FW_Option_Type {
	private $internal_options = array();

	private static $extension;
	private $only_date_format = 'Y/m/d';
	private $min_date = '1970/01/01';
	private $max_date = '2038/01/19';

	public function get_type()
	{
		return 'thz-event';
	}

	/**
	 * @internal
	 */
	public function _init() {

		$this->internal_options = array(
			'event_location' => array(
				'label' => __('Event Location', 'creatus'),
				'type'  => 'map',
				'desc'  => esc_html__('Where does the event take place?', 'creatus'),
			),

			'show_map' => array(
				'label' => __('Show map?', 'creatus'),
				'desc'  => esc_html__('Show/hide event map location', 'creatus'),
				'type'  => 'switch',
				'right-choice' => array(
					'value' => 'show',
					'label' => __('Show', 'creatus')
				),
				'left-choice' => array(
					'value' => 'hide',
					'label' => __('Hide', 'creatus')
				),
				'value' => 'show',
			),


			'event_children' => array(
				'label' => false,
				'type' => 'multi',
				'desc'  => false,
				'attr' => array('class' => 'fw-event-datetime'),
				'inner-options' => array(
					apply_filters('fw_option_type_event_popup_options:before', array()),

					'e' => array(
						'type'  => 'multi',
						'value' => array(),
						'label' => false,
						'desc'  => false,
						'inner-options' => array(
							'event_date_range' => array(
								'type'  => 'datetime-range',
								'label' => __( 'Start & End of Event', 'creatus' ),
								'desc'  => esc_html__( 'Set start and end events datetime', 'creatus' ),
								'datetime-pickers' => apply_filters( 'fw_option_type_event_datetime_pickers', array(
									'from' => array(
										'maxDate'       => $this->max_date,
										'minDate'       => $this->min_date,
										//'extra-formats' => array( $this->only_date_format ),
										'fixed'         => true,
										'timepicker'    => true,
										'datepicker'    => true,
										'defaultTime'   => '08:00',
										'step'			=> 15
									),
									'to'   => array(
										'maxDate'       => $this->max_date,
										'minDate'       => $this->min_date,
										//'extra-formats' => array( $this->only_date_format ),
										'fixed'         => true,
										'timepicker'    => true,
										'datepicker'    => true,
										'defaultTime'   => '18:00',
										'step'			=> 15
									)
								) ),
								'value' => array(
									'from' => '',
									'to'   => ''
								)
							),      
						)
					),

					apply_filters('fw_option_type_event_popup_options:after', array()),
				),
			),
			'all_day' => array(
				'label' => __('All Day Event?', 'creatus'),
				'desc'  => esc_html__('Is your event an all day event?', 'creatus'),
				'type'  => 'switch',
				'right-choice' => array(
					'value' => 'yes',
					'label' => __('Yes', 'creatus')
				),
				'left-choice' => array(
					'value' => 'no',
					'label' => __('No', 'creatus')
				),
				'value' => 'no',
			),

		);
	}

	/**
	 * @internal
	 * {@inheritdoc}
	 */
	protected function _enqueue_static($id, $option, $data)
	{
		
		$uri = get_template_directory_uri() . '/inc/includes/option-types/' . $this->get_type();
		
		wp_enqueue_script('fw-option-' . $this->get_type(),
			$uri . '/static/js/scripts.js',
			array('jquery', 'fw-events', 'editor', 'fw'),
			fw()->manifest->get_version()
		);
		wp_enqueue_style('fw-option-' . $this->get_type(),
			$uri . '/static/css/styles.css',
			array(),
			fw()->manifest->get_version()
		);

		fw()->backend->enqueue_options_static($this->internal_options);

	}


	/**
	 * @internal
	 */
	protected function _render($id, $option, $data)
	{
		return fw_render_view( dirname(__FILE__) . '/view.php', array(
			'id'     => $id,
			'option' => $option,
			'data'   => $data,
			'internal_options' => $this->internal_options,
		) );
	}

	/**
	 * @internal
	 */
	protected function _get_value_from_input($option, $input_value)
	{

		if (is_null($input_value)) {
			return $option['value'];
		} else {
			$value = fw_get_options_values_from_input(
				$this->internal_options,
				$input_value
			);

			//remove time, if all_day selected
			$all_day = fw_akg('event_durability', $value);
			if ($all_day === 'yes') {
				foreach($value['event_datetime'] as $key => &$row) {
					if (isset($row['event_date_range']['from'])) {
						$row['event_date_range']['from'] = date($this->only_date_format, strtotime($row['event_date_range']['from']));
					}
					if (isset($row['event_date_range']['to'])) {
						$row['event_date_range']['to'] = date($this->only_date_format, strtotime($row['event_date_range']['to']));
					}
				}
			}

			return $value;
		}
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
	 */
	protected function _get_defaults()
	{
		return array(
			'value' => array(
			)
		);
	}

}
FW_Option_Type::register('FW_Option_Type_ThzEvent');
