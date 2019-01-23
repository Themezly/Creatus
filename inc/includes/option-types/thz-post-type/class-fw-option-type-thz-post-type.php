<?php if ( ! defined( 'ABSPATH' ) ) die( 'Direct access forbidden.' );


class FW_Option_Type_ThzPostType extends FW_Option_Type
{


    public function get_type()
    {
        return 'thz-post-type';
    }

    /**
     * @internal
     */
    protected function _enqueue_static($id, $option, $data){
		
/*        $uri = get_template_directory_uri() .'/inc/includes/option-types/'. $this->get_type() .'/static';
		

        wp_enqueue_style(
            'fw-option-'. $this->get_type(),
            $uri .'/css/styles.css'
        );*/

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
		
		return fw_render_view(dirname(__FILE__) . '/view.php', array(
			'id' 				=> $id,
			'option' 			=> $option,
			'data'				=> $data,
			'post_types' 		=> $this->thz_list_post_types(),
			'taxonomies' 		=> $this->thz_list_taxonomies(),
			'miscellaneous' 	=> $this->thz_list_miscellaneous(),
			'archives' 			=> $this->thz_list_archives(),
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
			'multi' => true
        );
    }
	
	
}

FW_Option_Type::register('FW_Option_Type_ThzPostType');