<?php if ( ! defined( 'ABSPATH' ) ) die( 'Direct access forbidden.' );


class FW_Option_Type_ThzAssignTo extends FW_Option_Type
{


    public function get_type()
    {
        return 'thz-assign-to';
    }

    /**
     * @internal
     */
    protected function _enqueue_static($id, $option, $data){
		
        $uri = get_template_directory_uri() .'/inc/includes/option-types/'. $this->get_type() .'/static';
		

        wp_enqueue_style(
            'fw-option-'. $this->get_type(),
            $uri .'/css/styles.css',
			array( 'fw-selectize' )
        );

        wp_enqueue_script(
            'fw-option-'. $this->get_type(),
            $uri .'/js/scripts.js',
            array( 'fw-selectize' )
        );
		
		
		wp_localize_script('fw-option-'. $this->get_type(), 'thz_ast_vars', array(
				'noMatchesFoundMsg' => esc_html__( 'No matches found', 'creatus' ),
				'thz_ast_nonce' => wp_create_nonce( 'thz_ast_nonce' ),
			)
		);
		
    }


	/**
	 * @internal
	 */
	public function _get_backend_width_type()	{
		return 'fixed';
	}


	protected function thz_list_post_types(){
		
		$pots_types = array();
		$all_post_types = get_post_types( array(
                'public' => true,
            ), 'object');
            
		foreach ( array( 'revision', 'link_category', 'attachment', 'nav_menu_item' ) as $unset ) {
			unset($all_post_types[$unset]);
		}
		foreach ($all_post_types as $type => $post_type ){
			
			
			$label = $post_type->label;
			if($type =='post'){
				$label = esc_html__('Blog ','creatus').$label;
			}
			$pots_types['pt_'.$type] = esc_html__('Single ','creatus').$label;
		}
		unset($all_post_types);
		return $pots_types;
	}
	
	
	protected function thz_list_taxonomies(){
		
		$taxonomies = array();
		
		$all_taxonimies = get_taxonomies(array(
				'public' => true
		));
		foreach ($all_taxonimies as $taxonomy ){
			
			
			if($taxonomy =='post_tag' || $taxonomy =='post_format'){
				continue;
			}
			
			$taxonomy_details = get_taxonomy( $taxonomy );
			$label = $taxonomy_details->label;
			
			if($taxonomy =='category'){
				$label = esc_html__('Blog ','creatus').$label;
			}
			
			$taxonomies['tx_'.$taxonomy] = $label;
		}		
		unset($all_taxonimies);
		return $taxonomies;
	}
	
	
	protected function thz_list_miscellaneous(){
		
		$miscellaneous = array(
			'is_front_page' => esc_html__('Front Page', 'creatus'),
			'is_home' => esc_html__('Blog Home Page', 'creatus'),
			'is_postspage' => esc_html__('Posts page', 'creatus'),
			'is_attachment' => esc_html__('Attachment Page', 'creatus'),
			'is_search' => esc_html__('Search Page', 'creatus'),
			'is_404' => esc_html__('404 Page', 'creatus'),
			'is_author' => esc_html__('Author Archive', 'creatus'),
			'is_tag' => esc_html__('Tags Archive', 'creatus'),
		);
		
		if(function_exists('bp_is_my_profile')){
			$miscellaneous['buddy_press'] = esc_html__('BuddyPress','creatus');
		}
		
		if ( class_exists( 'WooCommerce' )  ) {
			$pageid = get_option( 'woocommerce_shop_page_id' );
			$miscellaneous['pt_page_'.$pageid] = esc_html__('Shop Homepage','creatus');
		}
		
		
		return $miscellaneous;
		
	}
	
	
	protected function thz_list_archives(){
		
		$archives = array();
		$allarchives = get_post_types(
			array(
				'public' => true,
				'has_archive' => true
			),
			'objects'
		);
		
		
		$archives['ar_post'] = esc_html__('Posts Archive', 'creatus');
		foreach ($allarchives as $type => $archive ){
			
			$label = $archive->label;

			$archives['ar_'.$type] = $label.__(' Archive','creatus');
		}
		unset($allarchives);
		return $archives;
	}
	
	/**
	 * @internal
	 */
	protected function _render($id, $option, $data)
	{
		

		$uri = get_template_directory_uri() .'/inc/includes/option-types/'. $this->get_type() .'/static';
		
		
		$data_select = array();
		$json_data	 = '';
		if(!empty($data['value'])){
			foreach($data['value'] as $key => $page){
				
				$pageinfo 	= explode('_',$page);
				$title  	= '';
				
				if(isset($pageinfo[2])){
					
					$pageid = end($pageinfo);
					
					if( 'tx' == $pageinfo[0] ){
						
						$title = thz_get_term_by_id( $pageid );
						
						if( $title ){
							
							$title = $title->name;
							
						}else{
							
							$title = $pageid;
						}
						
					}else{
						
						$title = get_the_title( $pageid );
					}
					
				}
				
				
				$data_select[] = array(
					'text'   => $title,
					'value' =>  $page,
				);
				
			}
			
		}
		
		if(!empty($data_select)){
			$json_data = json_encode($data_select);
		}
		
		return fw_render_view(dirname(__FILE__) . '/view.php', array(
			'id' 				=> $id,
			'option' 			=> $option,
			'data'				=> $data,
			'post_types' 		=> $this->thz_list_post_types(),
			'taxonomies' 		=> $this->thz_list_taxonomies(),
			'miscellaneous' 	=> $this->thz_list_miscellaneous(),
			'archives' 			=> $this->thz_list_archives(),
			'jsondata'			=> $json_data,
		));
	}	
	
	/**
	 * @internal
	 */
	protected function _get_value_from_input($option, $input_value)
	{

		
		if ( is_null( $input_value ) ) {
			$input_value = $option['value'];
		}
		
		if ( ! is_array( $input_value ) ) {
			$input_value = array();
		}

		return $input_value;
	}

    /**
     * @internal
     */
    protected function _get_defaults()
    {

        return array(
			'value'	=> array(),
        );
    }


	public static function thz_action_at_get_ajax_posts(){

		if ( ! wp_verify_nonce( $_POST['thz_ast_nonce'], 'thz_ast_nonce' ) ) {
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
	
}

FW_Option_Type::register('FW_Option_Type_ThzAssignTo');
add_action( 'wp_ajax_thz_action_at_get_ajax_posts',array( "FW_Option_Type_ThzAssignTo", 'thz_action_at_get_ajax_posts' ) );