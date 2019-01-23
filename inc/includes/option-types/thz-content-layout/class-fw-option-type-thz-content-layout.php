<?php if ( ! defined( 'ABSPATH' ) ) die( 'Direct access forbidden.' );


class FW_Option_Type_ThzContentLayout extends FW_Option_Type
{


    public function get_type()
    {
        return 'thz-content-layout';
    }

    /**
     * @internal
     */
    protected function _enqueue_static($id, $option, $data)
    {
        $uri = get_template_directory_uri() .'/inc/includes/option-types/'. $this->get_type() .'/static';
		

        wp_enqueue_style(
            'fw-option-'. $this->get_type(),
            $uri .'/css/styles.css'
        );

        wp_enqueue_script(
            'fw-option-'. $this->get_type(),
            $uri .'/js/scripts.js',
            array( 'fw-events', 'jquery', 'jquery-ui-autocomplete','jquery-ui-sortable')
        );

		wp_localize_script('fw-option-'. $this->get_type(), 'thzlayout_vars', array(
				'noMatchesFoundMsg' => esc_html__( 'No matches found', 'creatus' ),
				'layoutExists1' => esc_html__( 'Layout for ', 'creatus' ),
				'layoutExists2' => esc_html__( ' already exists', 'creatus' ),
				'updatingLayout1' => esc_html__( 'Layout for ', 'creatus' ),
				'updatingLayout2' => esc_html__( ' has been updated. Please save the settings.', 'creatus' ),
				'updatingLayoutButton' => esc_html__( 'Update layout for ', 'creatus' ),
				'thz_cl_nonce' => wp_create_nonce( 'thz_cl_nonce' ),
			)
		);
		
		fw()->backend->option_type('thz-radio')->enqueue_static();
		
		fw()->backend->option_type('thz-spinner')->enqueue_static();
		
    }


	/**
	 * @internal
	 */
	public function _get_backend_width_type()
	{
		return 'fixed';
	}



	public static function thz_action_get_ajax_posts(){

		if ( ! wp_verify_nonce( $_POST['thz_cl_nonce'], 'thz_cl_nonce' ) ) {
			die(-1);
		}
		
		if(!isset($_POST['searchTerm'])) {
			return;
		}

		$search_term = esc_sql( $_POST['searchTerm'] );
		if( empty( $search_term ) ) return;
				
		$all_posts = array();

		global $wpdb;
		
		$all_post_types = get_post_types();
		foreach ( array( 'revision', 'link_category', 'attachment', 'nav_menu_item','bp-email' ) as $unset ) {
			unset($all_post_types[$unset]);
		}
		
		$posts = $wpdb->get_results(
			"SELECT posts.ID, posts.post_title, posts.post_type " .
			"FROM $wpdb->posts as posts " .
			"WHERE post_type IN ('" . implode( "', '", $all_post_types ) . "') " .
			"AND post_status IN ( 'publish', 'private' ) " .
			"AND post_title LIKE  '%".$search_term."%' " .
			"ORDER BY post_date DESC LIMIT 100"
		);
		
		unset($all_post_types);

		if ( ! empty( $posts ) || ! is_wp_error( $posts ) ) {

			foreach ($posts as $post ){
				
				$title = $post->post_title;
				$slug = 'pt_'.$post->post_type;
				
				$all_posts[$slug.'_'.$post->ID] = empty( $title ) ? $post->ID .__('-no title','creatus') : $title;
				
			}
			
			unset($posts);
		}
		
		
		$taxonimies = get_taxonomies(array(
			'public' => true
		));	
		
			
		$items = get_terms( $taxonimies, array(
			'name__like' => $search_term,
			'hide_empty' => false,
			'number'     => 100
		));
		
		foreach ( $items as $item ) {
			$slug = 'tx_'.$item->taxonomy;
			$all_posts[ $slug.'_'.$item->term_id ] = $item->name;
		}
		unset($items);		

		wp_send_json_success( $all_posts );
		
	}
	
	/**
	 * @internal
	 */
	protected function _render($id, $option, $data)
	{

		$uri = get_template_directory_uri() .'/inc/includes/option-types/'. $this->get_type() .'/static';
		
		return fw_render_view(dirname(__FILE__) . '/view.php', array(
			'id' => $id,
			'option' => $option,
			'data'=>$data,
			'value'=> json_encode($option['value']),
			'datavalue' => json_encode($data['value']),
			'uri'=>$uri
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

		$value = $option['value'];


		foreach ($option['value'] as $key => $val){
			
			if (isset($input_value[$key])) {
				$value[$key] = json_decode($input_value[$key]);
			}
		}
		
		return $value[0];
	}


    /**
     * @internal
     */
    protected function _get_defaults()
    {

        return array(
			'value'	=>	array(
				array(
					'title'=>'',
					'page' =>'all',
					'layout'=>'left',
					'leftblock'=>25,
					'contentblock'=>75,
					'rightblock'=>0,
				)
			)
        );
    }
	
	
}

FW_Option_Type::register('FW_Option_Type_ThzContentLayout');
add_action( 'wp_ajax_thz_action_get_ajax_posts',array( "FW_Option_Type_ThzContentLayout", 'thz_action_get_ajax_posts' ) );