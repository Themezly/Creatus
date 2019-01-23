<?php if ( ! defined( 'ABSPATH' ) ) die( 'Direct access forbidden.' );

class FW_Option_Type_ThzImportFonts extends FW_Option_Type {


	private $option_type = 'thz-import-fonts';

	public function get_type() {
		return $this->option_type;
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
	protected function _enqueue_static( $id, $option, $data ) {

		$uri = get_template_directory_uri() .'/inc/includes/option-types/'. $this->get_type() .'/static';

		wp_enqueue_style(
			'fw-option-' . $this->get_type(),
			$uri . '/css/styles.css'
		);

		wp_enqueue_script(
			'fw-option-' . $this->get_type(),
			$uri . '/js/scripts.js',
			array('jquery', 'fw-events'),
			fw()->manifest->get_version()
		);
		
		wp_localize_script('fw-option-'. $this->get_type(), '_thzimportfonts', array(
			'typekit_input' => esc_html__('Please verify the Typekit API Token and Project ID','creatus'),
			'downloaded_title' => esc_html__('Downloaded fonts','creatus'),
			'importsnonce' 	=> wp_create_nonce( 'thz-import-fonts' ),
			'cantdownload' 	=> esc_html__('Not able to download fonts check folders permissions.','creatus'),
			'cantdelete' 	=> esc_html__('Not able to delete font check folders permissions.','creatus'),
			)
		);

	}

	/**
	 * @param string $id
	 * @param array $option
	 * @param array $data
	 *
	 * @return string
	 *
	 * @internal
	 */
	protected function _render( $id, $option, $data ) {

		
		if($option['provider'] == 'typekit'){
			$fonts = thz_build_typekit_list( $this->_get_typekit_fonts( true ) );
		}
		
		if($option['provider'] == 'fontsquirrel'){
			$fonts = '';
		}
		
		return fw_render_view( dirname(__FILE__) . '/view.php', array(
			'fonts' 		=> $fonts,
			'id'            => $id,
			'option'        => $option,
			'data'          => $data,

		) );

	}
	
	
	/**
	 * @internal
	 */	
	public static function _get_typekit_fonts( $saved = false ) {
		
		$thz_imported_fonts = get_option('thz_imported_fonts');

		if($saved){
			
			$tykfonts		= thz_akg('tykfonts',$thz_imported_fonts,false);
			return $tykfonts;
			
		}else{
			
			$tyk_token 			= thz_akg('tyktoken',$thz_imported_fonts,false);
			$tykit_ids 			= thz_akg('tykids',$thz_imported_fonts,array());
			
			return thz_get_typekit_fonts($tyk_token,$tykit_ids);
		}
		
		return false;
	}

	/**
	 * @param array $option
	 * @param array|null|string $input_value
	 *
	 * @return string
	 *
	 * @internal
	 */
	protected function _get_value_from_input( $option, $input_value ) {
       
	    if (is_null($input_value)) {
            
			$value = $option['value'];
			
        }else{
			
		 $value = json_decode($input_value,true);
		 
		}
		
		return $value;
	}

	/**
	 * @internal
	 */
	protected function _get_defaults() {
		return array(
			'value' => array()
		);
	}


	/**
	 * @internal
	 */
	public static function _action_build_typekit_list(){

		if ( !current_user_can( 'edit_theme_options' ) ) {
			
			return;
			
		}
		
		$nonce = isset($_POST['nonce']) ? $_POST['nonce'] : false;

		if ( ! wp_verify_nonce( $nonce, 'thz-import-fonts' ) ) {
			
			return;
		}
		
		if ( empty ( $_POST['kit_token'] ) || empty ( $_POST['kit_ids'] )) {
			
			wp_send_json_error( 
				array(
					'list' => esc_html__('Please verify the Typekit API Token and Project ID', 'creatus'),
				)
			);
			exit;
		}
		
		$thz_imported_fonts = get_option('thz_imported_fonts');
		$tyk_token 			= $_POST['kit_token'];
		$tykit_ids 			= $_POST['kit_ids'] ;
		
		$typekit_fonts		= thz_get_typekit_fonts($tyk_token,$tykit_ids);
		$list_html 			= thz_build_typekit_list( $typekit_fonts );
		
		wp_send_json_success( 
			array(
				'list' => $list_html,
				'fonts' => $typekit_fonts
			)
		);
	}


	/**
	 * @internal
	 */
	public static function _action_get_fsq_fontface_kit(){
		
		
		if ( !current_user_can( 'edit_theme_options' ) ) {
			
			return;
			
		}
		
		$nonce = isset($_POST['nonce']) ? $_POST['nonce'] : false;

		if ( ! wp_verify_nonce( $nonce, 'thz-import-fonts' ) ) {
			
			return;
		}
		
		if ( empty ( $_POST['family_urlname'] )) {
			
			wp_send_json_error( 
				array(
					'error' => esc_html__('Missing font url name', 'creatus'),
				)
			);
			exit;
		}

		$family_urlname		= $_POST['family_urlname'];
		$response 			= false;
		
		if(thz_get_fsq_fontfacekit( $family_urlname )){
			
			$response = true;
		}
		
		wp_send_json_success( 
			array(
				'fonts' => $response
			)
		);
	}
	
	
	/**
	 * @internal
	 */
	public static function _action_delete_fsq_fontface_kit(){
		
		
		if ( !current_user_can( 'edit_theme_options' ) ) {
			
			return;
			
		}
		
		$nonce = isset($_POST['nonce']) ? $_POST['nonce'] : false;

		if ( ! wp_verify_nonce( $nonce, 'thz-import-fonts' ) ) {
			
			return;
		}
		
		if ( empty ( $_POST['family_urlname'] )) {
			
			wp_send_json_error( 
				array(
					'error' => esc_html__('Missing font url name', 'creatus'),
				)
			);
			exit;
		}

		$family_urlname		= $_POST['family_urlname'];
		$response 			= false;

		if(thz_delete_fsq_fontfacekit( $family_urlname )){
			
			$response = true;
		}
		
		wp_send_json_success( 
			array(
				'removed' => $response
			)
		);
	}
}



add_action('wp_ajax_thz_build_typekit_list', array('FW_Option_Type_ThzImportFonts', '_action_build_typekit_list'));
add_action('wp_ajax_thz_get_fsq_fontface_kit', array('FW_Option_Type_ThzImportFonts', '_action_get_fsq_fontface_kit'));
add_action('wp_ajax_thz_delete_fsq_fontface_kit', array('FW_Option_Type_ThzImportFonts', '_action_delete_fsq_fontface_kit'));

FW_Option_Type::register( 'FW_Option_Type_ThzImportFonts' );