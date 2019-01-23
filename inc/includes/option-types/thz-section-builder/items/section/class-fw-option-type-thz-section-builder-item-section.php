<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

class FW_Option_Type_ThzSection_Builder_Item_Section extends FW_Option_Type_ThzSection_Builder_Item {
	
	
	public function get_type() {
		return 'section';
	}

	private function get_uri( $append = '' ) {
		
		$uri = get_template_directory_uri() .'/inc/includes/option-types/'.$this->get_builder_type();
		
		return $uri. '/items/' . $this->get_type() . $append ;
	}

	public function get_thumbnails() {
		return array(
			array(
				'html' =>
					'<div class="item-type-icon-title" data-hover-tip="' . esc_html__( 'Add a new section', 'creatus' ) . '">' .
					'<div class="item-type-title">' . esc_html__( 'Section', 'creatus' ) . '</div>' .
					'</div>'
			)
		);
	}

	public function enqueue_static() {
		
		
		
		wp_enqueue_style(
			'fw-builder-' . $this->get_builder_type() . '-item-' . $this->get_type(),
			$this->get_uri( '/static/css/styles.css' )
		);

		wp_enqueue_script(
			'fw-builder-' . $this->get_builder_type() . '-item-' . $this->get_type(),
			$this->get_uri( '/static/js/scripts.js' ),
			array(
				'fw-events',
			),
			false,
			true
		);

		wp_localize_script(
			'fw-builder-' . $this->get_builder_type() . '-item-' . $this->get_type(),
			'fw_thz_section_builder_item_type_' . $this->get_type(),
			array(
				'l10n'     => array(
					'item_title'      => esc_html__( 'Section options', 'creatus' ),
					'clone_tip'           => esc_html__( 'Clone', 'creatus' ),
					'edit_tip'            => esc_html__( 'Edit', 'creatus' ),
					'delete_tip'          => esc_html__( 'Delete', 'creatus' ),
				),
				'options'  => $this->get_options(),
				'defaults' => array(
					'type'    => $this->get_type(),
					'options' => fw_get_options_values_from_input( $this->get_options(), array() )
				)
			)
		);

		fw()->backend->enqueue_options_static( $this->get_options() );
	}

	public static function get_options() {
		
		$options = fw_get_variables_from_file(dirname ( __FILE__ ).'/options.php', array('options' => array()));
		
		return array(
				$options['options']
		);

	}

	protected function get_fixed_attributes( $attributes ) {

		$default_attributes = array(
			'type'      => $this->get_type(),
			'shortcode' => false, // the builder will generate new shortcode if this value will be empty()
			'width'     => '',
			'_items'     => $attributes['_items'],
			'options'   => array()
		);


		// remove unknown attributes
		$attributes = array_intersect_key( $attributes, $default_attributes );
		$attributes = array_merge( $default_attributes, $attributes );
		/**
		 * Fix $attributes['options']
		 * Run the _get_value_from_input() method for each option
		 */
		{
			$only_options = array();
			foreach (fw_extract_only_options($this->get_options()) as $option_id => $option) {
				if (array_key_exists($option_id, $attributes['options'])) {
					$option['value'] = $attributes['options'][$option_id];
				}
				$only_options[$option_id] = $option;
			}
			$attributes['options'] = fw_get_options_values_from_input($only_options, array());
			unset($only_options, $option_id, $option);
		}

		return $attributes;
	}

	/**
	 * {@inheritdoc}
	 */
	public function get_value_from_attributes( $attributes ) {
		
		return $this->get_fixed_attributes( $attributes );
	}

}

FW_Option_Type_Builder::register_item_type( 'FW_Option_Type_ThzSection_Builder_Item_Section' );
