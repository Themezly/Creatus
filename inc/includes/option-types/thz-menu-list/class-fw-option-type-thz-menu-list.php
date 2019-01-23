<?php if ( ! defined( 'ABSPATH' ) ) die( 'Direct access forbidden.' );


class FW_Option_Type_ThzMenuList extends FW_Option_Type
{

	
    // pages on site
    var $pages = array();
    
    // custom post types
    var $cposts = array();
    
    // taxonomies
    var $taxes = array();
    
    // categories
    var $cats = array();
    
    // WPML languages
    var $langs = array();
	
	
	
    public function get_type()
    {
        return 'thz-menu-list';
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
	protected function _render($id, $option, $data)
	{
		return fw_render_view(dirname(__FILE__) . '/view.php', array(
			'id' => $id,
			'option' => $option,
			'data' => $data,
			'allgroups'=> $this->_get_groups()
		));
	}
	
	
	
	
	
	
    protected function _get_groups(){
		
		$all_groups = array();
		
        if ( empty($this->pages) ) {
			
			
			$args = array(
                'post_type' => array('page'), 
				'posts_per_page' => -1,
				'post_status' => 'publish',
				'orderby' => 'title', 
				'order' => 'ASC',
				'fields' => 'ids'
            );		
			
			$posts =  new WP_Query( $args );
            $this->pages =  $posts->posts;
        }	
		
/*        if ( empty($this->pages) ) {
            $this->pages = get_posts( array(
                'post_type' => 'page', 'post_status' => 'publish', 
                'numberposts' => -1, 'orderby' => 'title', 'order' => 'ASC',
                'fields' => array('ID', 'name'),
            ));
        }*/
		
        if ( empty($this->cats) ) {
            $this->cats = get_categories( array(
                'hide_empty'    => false,
            ) );    
        }	
		
		
        if ( empty($this->cposts) ) {
            $this->cposts = get_post_types( array(
                'public' => true,
            ), 'object');
            
            foreach ( array( 'revision', 'post', 'page', 'attachment', 'nav_menu_item' ) as $unset ) {
                unset($this->cposts[$unset]);
            }
            
            foreach ( $this->cposts as $c => $type ) {
                $post_taxes = get_object_taxonomies($c);
                foreach ( $post_taxes as $post_tax) {
                    $this->taxes[] = $post_tax;
                }
            }
        }
        
        if ( empty($this->langs) && function_exists('icl_get_languages') ) {
            $this->langs = icl_get_languages('skip_missing=0&orderby=code');
        }
		
		
		$all_groups['pages'] 	= $this->pages;
		$all_groups['cposts'] 	= $this->cposts;
		$all_groups['taxes'] 	= $this->taxes;
		$all_groups['cats'] 	= $this->cats;
		$all_groups['langs'] 	= $this->langs;
		
		
		return $all_groups;
		
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
				$value[$key] = $input_value[$key];
			}
		}

		return $value;

	}

    /**
     * @internal
     */
    protected function _get_defaults()
    {

        return array(
            'value' => array(
				'assignto'=>array('all'),
				'layout'=>'right'
			)
        );
    }
}

FW_Option_Type::register('FW_Option_Type_ThzMenuList');