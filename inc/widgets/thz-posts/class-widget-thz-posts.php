<?php if ( ! defined( 'ABSPATH' ) ) die( 'Direct access forbidden.' );

class Widget_Thz_Posts extends WP_Widget {
	
	protected $defaults;
	
	public function __construct() {
		
		$widget_ops = array( 'description' => esc_html__( 'Posts widget', 'creatus' ) );
		parent::__construct( false, esc_html__( 'Creatus - Posts', 'creatus' ), $widget_ops );
		
        $this->defaults = array(
			'title'         => 'Posts',
			'posts'      	=> array(
				'post' 		=> true
			),
			'cats'      	=> array(),
			'metrics'      	=> array(
				'thumbnail' => true,
				'thumbnail_only' => true, 
				'date' 		=> true,
			),
			'mode'      	=> 'list',
			'col'			=> 4,
			'gut'			=> 10,
			'intro_limit_by' => 'words',
			'intro_limit' 	=> 15,
			'ratio'			=> 'thz-ratio-1-1',
			'thumbnail_size' => 'thumbnail',
			'order'      	=> 'DESC',
			'orderby'      	=> 'date',
			'title_tag'		=> 'span',
			'number'        => 5,
			'thumbpoz'		=> 'left',
			'days'          => 'all_posts',
        );		
	}


	public function widget( $args, $instance ) {

		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}
		
		extract( $args );
		$params = array();
		
		if( empty($instance) ){
			$instance = $this->defaults;
		}

		foreach ( $instance as $key => $value ) {
			$params[ $key ] = $value;
		}
		
		$title = apply_filters( 'widget_title', $params['title'], $instance, $this->id_base );
		$title = $params['title'] ? $before_title . $title . $after_title: '';
		unset( $params['title'] );

		$filepath = thz_theme_file_path( '/inc/widgets/thz-posts/views/widget.php' );
		
		$wmode = $instance['mode'] == 'list' ? 'thz-has-list' :'thz-tumbnail-grid'; 
		
		if($instance['mode'] == 'list' && !isset($instance['metrics']['listclass']) ){
			
			$wmode ='thz-posts-widget-list';
		}
		
		$data = array(
			'instance'      => $params,
			'title'         => $title,
			'before_widget' => str_replace( 'class="widget ', 'class="widget thz-posts-widget '.$wmode.' ', $before_widget ),
			'after_widget'  => $after_widget,
		);

		echo thz_render_view( $filepath, $data );
	}
	
	
	public function update( $new_instance, $old_instance ) {
		return $new_instance;
	}
	
	
	public function form( $instance ) {
		
		$instance 			= wp_parse_args( (array) $instance, $this->defaults);
		$types_with_label 	= thz_list_post_types(true,array('forum','topic','reply' ));
		$all_types 			= thz_list_post_types(false,array('forum','topic','reply' ));
		$tax_names 			= thz_get_post_taxonomies($all_types,'objects');
		$metrics 			= array(
			'thumbnail'=> esc_html__('Show Thumbnail','creatus'),
			'thumbnail_only'=> esc_html__('Show only posts with thumbnail','creatus'),
			'date'=> esc_html__('Show Post Date','creatus'),
			'intro_text'=> esc_html__('Show intro text','creatus'),
			'listclass'=> esc_html__('Use .thz-has-list class','creatus'),
		);
		
		$categories = array();
		
		foreach ($tax_names as $tax){

			if (!$tax->hierarchical) {
				continue;
			}
								
			$terms = get_terms( array(
				'taxonomy'     => $tax->name,
			));
			
			if($terms){
				
				foreach ($terms as $term){
					if (!is_object($term)) {
						continue;
					}
					
					if ( 0 == $term->count ) {
						continue;
					}
					$categories[$term->term_id] = $term->name;
				}
			}
			
		}	
		unset($tax_names,$tax);
		
		
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'creatus' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>"/>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php esc_html_e( 'Number of posts:', 'creatus' ); ?></label>
			<input size="3" style="width: 45px;" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['number'] ); ?>"/>
		</p>
        <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'posts' ) ); ?>"><?php esc_html_e( 'Select post types:', 'creatus' ); ?></label><br />
        <?php foreach($types_with_label as $id => $name){ ?>
   	 		<input id="<?php echo $this->get_field_id('posts') . $id; ?>" name="<?php echo $this->get_field_name('posts'); ?>[<?php echo esc_attr($id) ?>]" type="checkbox" value="true" <?php checked(isset( $instance['posts'][$id] ) ? 1 : 0); ?> />
			<label for="<?php echo esc_attr( $this->get_field_id('posts') . $id ); ?>"><?php echo esc_attr( $name ); ?></label>
        <?php } ?>
        </p>

        <p class="thz-pw-cats">
        <label for="<?php echo esc_attr( $this->get_field_id( 'cats' ) ); ?>"><?php esc_html_e( 'Specific tax terms:', 'creatus' ); ?></label><br />
        <?php foreach($categories as $id => $name){ ?>
   	 		<input id="<?php echo $this->get_field_id('cats') . $id; ?>" name="<?php echo $this->get_field_name('cats'); ?>[<?php echo esc_attr($id) ?>]" type="checkbox" value="true" <?php checked(isset( $instance['cats'][$id] ) ? 1 : 0); ?> />
			<label for="<?php echo esc_attr( $this->get_field_id('cats') . $id ); ?>"><?php echo esc_attr( $name ); ?></label><br />
        <?php } ?>
        </p>
		<p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'order' ) ); ?>"><?php esc_html_e( 'Order:', 'creatus' ); ?></label>
        <select name="<?php echo esc_attr( $this->get_field_name( 'order' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'order' ) ); ?>" class="widefat">
            <option value="DESC" <?php selected( $instance['order'], 'DESC' ); ?>><?php esc_html_e( 'Descending ( newest first )', 'creatus' ); ?></option>
            <option value="ASC" <?php selected( $instance['order'], 'ASC' ); ?>><?php esc_html_e( 'Ascending ( oldest first )', 'creatus' ); ?></option>
        </select>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'days' ) ); ?>"><?php esc_html_e( 'Select posts published limit:', 'creatus' ); ?></label>
			<select name="<?php echo esc_attr( $this->get_field_name( 'days' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'days' ) ); ?>" class="widefat">
				<option value="all_posts" <?php selected( $instance['days'], 'all_posts' ); ?>><?php esc_html_e( 'No limit', 'creatus' ); ?></option>
				<option value="7" <?php selected( $instance['days'], '7' ); ?>><?php esc_html_e( 'Show 1 Week old posts', 'creatus' ); ?></option>
				<option value="30" <?php selected( $instance['days'], '30' ); ?>><?php esc_html_e( 'Show 1 Month old posts', 'creatus' ); ?></option>
				<option value="90" <?php selected( $instance['days'], '90' ); ?>><?php esc_html_e( 'Show 3 Months old posts', 'creatus' ); ?></option>
				<option value="180" <?php selected( $instance['days'], '180' ); ?>><?php esc_html_e( 'Show 6 Months old posts', 'creatus' ); ?></option>
				<option value="360" <?php selected( $instance['days'], '360' ); ?>><?php esc_html_e( 'Show 1 Year old posts', 'creatus' ); ?></option>
			</select>
		</p>
		<p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'orderby' ) ); ?>"><?php esc_html_e( 'Order by:', 'creatus' ); ?></label>
        <select name="<?php echo esc_attr( $this->get_field_name( 'orderby' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'orderby' ) ); ?>" class="widefat">
            <option value="ID" <?php selected( $instance['orderby'], 'ID' ); ?>><?php esc_html_e( 'ID', 'creatus' ); ?></option>
            <option value="author" <?php selected( $instance['orderby'], 'author' ); ?>><?php esc_html_e( 'Author', 'creatus' ); ?></option>
            <option value="title" <?php selected( $instance['orderby'], 'title' ); ?>><?php esc_html_e( 'Title', 'creatus' ); ?></option>
            <option value="name" <?php selected( $instance['orderby'], 'name' ); ?>><?php esc_html_e( 'Name', 'creatus' ); ?></option>
            <option value="date" <?php selected( $instance['orderby'], 'date' ); ?>><?php esc_html_e( 'Create date', 'creatus' ); ?></option>
            <option value="modified" <?php selected( $instance['orderby'], 'modified' ); ?>><?php esc_html_e( 'Modified date', 'creatus' ); ?></option>
            <option value="rand" <?php selected( $instance['orderby'], 'rand' ); ?>><?php esc_html_e( 'Random', 'creatus' ); ?></option>
            <option value="comment_count" <?php selected( $instance['orderby'], 'comment_count' ); ?>><?php esc_html_e( 'Number of comments', 'creatus' ); ?></option>
			<option value="meta_value" <?php selected( $instance['orderby'], 'meta_value' ); ?>><?php esc_html_e( 'Post views count', 'creatus' ); ?></option>
            <option value="meta_value" <?php selected( $instance['orderby'], 'none' ); ?>><?php esc_html_e( 'None', 'creatus' ); ?></option>
        </select>
		</p>
		<p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'title_tag' ) ); ?>"><?php esc_html_e( 'Title tag:', 'creatus' ); ?></label>
        <select style="width: 45px;" name="<?php echo esc_attr( $this->get_field_name( 'title_tag' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'title_tag' ) ); ?>" class="widefat">
        	<option value="span" <?php selected( $instance['title_tag'], 'span' ); ?>><?php esc_html_e( 'span', 'creatus' ); ?></option>
            <option value="div" <?php selected( $instance['title_tag'], 'h1' ); ?>><?php esc_html_e( 'div', 'creatus' ); ?></option>
            <option value="h1" <?php selected( $instance['title_tag'], 'h1' ); ?>><?php esc_html_e( 'h1', 'creatus' ); ?></option>
            <option value="h2" <?php selected( $instance['title_tag'], 'h2' ); ?>><?php esc_html_e( 'h2', 'creatus' ); ?></option>
            <option value="h3" <?php selected( $instance['title_tag'], 'h3' ); ?>><?php esc_html_e( 'h3', 'creatus' ); ?></option>
            <option value="h4" <?php selected( $instance['title_tag'], 'h4' ); ?>><?php esc_html_e( 'h4', 'creatus' ); ?></option>
            <option value="h5" <?php selected( $instance['title_tag'], 'h5' ); ?>><?php esc_html_e( 'h5', 'creatus' ); ?></option>
            <option value="h6" <?php selected( $instance['title_tag'], 'h6' ); ?>><?php esc_html_e( 'h6', 'creatus' ); ?></option>
        </select>
        </p>
		<p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'mode' ) ); ?>"><?php esc_html_e( 'Display Mode:', 'creatus' ); ?></label>
        <select name="<?php echo esc_attr( $this->get_field_name( 'mode' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'mode' ) ); ?>" class="widefat thz-select-switch">
            <option data-enable=".thz-pwm-<?php echo $this->id?>" data-disable=".thz-pwc-<?php echo $this->id?>" value="list" <?php selected( $instance['mode'], 'list' ); ?>><?php esc_html_e( 'List', 'creatus' ); ?></option>
            <option data-enable=".thz-pwc-<?php echo $this->id?>" data-disable=".thz-pwm-<?php echo $this->id?>" value="thumbnails" <?php selected( $instance['mode'], 'thumbnails' ); ?>><?php esc_html_e( 'Thumbnails grid', 'creatus' ); ?></option>
        </select>
		</p>
        <p class="thz-pwm-<?php echo $this->id?>">
        <label for="<?php echo esc_attr( $this->get_field_id( 'metrics' ) ); ?>"><?php esc_html_e( 'Widget metrics:', 'creatus' ); ?></label><br />
        <?php foreach($metrics as $id => $name){ ?>
   	 		<input id="<?php echo $this->get_field_id('metrics') . $id; ?>" name="<?php echo $this->get_field_name('metrics'); ?>[<?php echo esc_attr($id) ?>]" type="checkbox" value="true" <?php checked(isset( $instance['metrics'][$id] ) ? 1 : 0); ?> />
			<label for="<?php echo esc_attr( $this->get_field_id('metrics') . $id ); ?>"><?php echo esc_attr( $name ); ?></label><br />
        <?php } ?>
        <br />
        <label for="<?php echo esc_attr( $this->get_field_id( 'intro_limit_by' ) ); ?>"><?php esc_html_e( 'Intro limit by:', 'creatus' ); ?></label>
        <select name="<?php echo esc_attr( $this->get_field_name( 'intro_limit_by' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'intro_limit_by' ) ); ?>" class="widefat">
            <option value="chars" <?php selected( $instance['intro_limit_by'], 'chars' ); ?>><?php esc_html_e( 'By characters', 'creatus' ); ?></option>
            <option value="words" <?php selected( $instance['intro_limit_by'], 'words' ); ?>><?php esc_html_e( 'By words', 'creatus' ); ?></option>
        </select>  <br />  <br />
        <label for="<?php echo esc_attr( $this->get_field_id( 'intro_limit' ) ); ?>"><?php esc_html_e( 'Intro limit:', 'creatus' ); ?></label>
        <input  size="3" style="width: 45px;" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'intro_limit' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'intro_limit' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['intro_limit'] ); ?>"/> <br /><br />
        <label for="<?php echo esc_attr( $this->get_field_id( 'thumbpoz' ) ); ?>"><?php esc_html_e( 'Thumbnail position:', 'creatus' ); ?></label>
        <select name="<?php echo esc_attr( $this->get_field_name( 'thumbpoz' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'thumbpoz' ) ); ?>" class="widefat">
            <option value="left" <?php selected( $instance['thumbpoz'], 'left' ); ?>><?php esc_html_e( 'Left', 'creatus' ); ?></option>
            <option value="right" <?php selected( $instance['thumbpoz'], 'right' ); ?>><?php esc_html_e( 'Right', 'creatus' ); ?></option>
        	<option value="above" <?php selected( $instance['thumbpoz'], 'above' ); ?>><?php esc_html_e( 'Above the title', 'creatus' ); ?></option>
            <option value="under" <?php selected( $instance['thumbpoz'], 'under' ); ?>><?php esc_html_e( 'Under the title', 'creatus' ); ?></option>
        </select><br />
        </p>
 		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'ratio' ) ); ?>"><?php esc_html_e( 'Thumbnail Width:', 'creatus' ); ?></label>
            <select name="<?php echo esc_attr( $this->get_field_name( 'ratio' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'ratio' ) ); ?>" class="widefat">
              <optgroup label="<?php esc_html_e( 'Square', 'creatus' ); ?>">
              <option value="thz-ratio-1-1" <?php selected( $instance['ratio'], 'thz-ratio-1-1' ); ?>><?php esc_html_e( 'Aspect ratio 1:1', 'creatus' ); ?></option>
              </optgroup>
              <optgroup label="<?php esc_html_e( 'Landscape', 'creatus' ); ?>">
              <option value="thz-ratio-2-1" <?php selected( $instance['ratio'], 'thz-ratio-2-1' ); ?>><?php esc_html_e( 'Aspect ratio 2:1', 'creatus' ); ?></option>
              <option value="thz-ratio-3-2" <?php selected( $instance['ratio'], 'thz-ratio-3-2' ); ?>><?php esc_html_e( 'Aspect ratio 3:2', 'creatus' ); ?></option>
              <option value="thz-ratio-4-3" <?php selected( $instance['ratio'], 'thz-ratio-4-3' ); ?>><?php esc_html_e( 'Aspect ratio 4:3', 'creatus' ); ?></option>
              <option value="thz-ratio-16-9" <?php selected( $instance['ratio'], 'thz-ratio-16-9' ); ?>><?php esc_html_e( 'Aspect ratio 16:9', 'creatus' ); ?></option>
              <option value="thz-ratio-21-9" <?php selected( $instance['ratio'], 'thz-ratio-21-9' ); ?>><?php esc_html_e( 'Aspect ratio 21:9', 'creatus' ); ?></option>
              </optgroup>
              <optgroup label="<?php esc_html_e( 'Portrait', 'creatus' ); ?>">
              <option value="thz-ratio-1-2" <?php selected( $instance['ratio'], 'thz-ratio-1-2' ); ?>><?php esc_html_e( 'Aspect ratio 1:2', 'creatus' ); ?></option>
              <option value="thz-ratio-3-4" <?php selected( $instance['ratio'], 'thz-ratio-3-4' ); ?>><?php esc_html_e( 'Aspect ratio 3:4', 'creatus' ); ?></option>
              <option value="thz-ratio-2-3" <?php selected( $instance['ratio'], 'thz-ratio-2-3' ); ?>><?php esc_html_e( 'Aspect ratio 2:3', 'creatus' ); ?></option>
              <option value="thz-ratio-9-16" <?php selected( $instance['ratio'], 'thz-ratio-9-16' ); ?>><?php esc_html_e( 'Aspect ratio 9:16', 'creatus' ); ?></option>
              </optgroup>
            </select>
         </p>
         <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'thumbnail_size' ) ); ?>"><?php esc_html_e( 'Thumbnail Size:', 'creatus' ); ?></label>
              <select name="<?php echo esc_attr( $this->get_field_name( 'thumbnail_size' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'thumbnail_size' ) ); ?>" class="widefat">
            <?php foreach(thz_get_image_sizes_list() as $size => $name){ ?>
                <option value="<?php echo esc_attr($size)?>" <?php selected( $instance['thumbnail_size'], $size ); ?>><?php echo esc_attr( $name ); ?></option>
            <?php } ?>
              </select>
        </p>        
		<p class="thz-pwc-<?php echo $this->id?>">
			<label for="<?php echo esc_attr( $this->get_field_id( 'col' ) ); ?>"><?php esc_html_e( 'Number of columns:', 'creatus' ); ?></label>
			<select style="width: 45px;" name="<?php echo esc_attr( $this->get_field_name( 'col' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'col' ) ); ?>" class="widefat">
				<option value="1" <?php selected( $instance['col'], '1' ); ?>><?php esc_html_e( '1', 'creatus' ); ?></option>
				<option value="2" <?php selected( $instance['col'], '2' ); ?>><?php esc_html_e( '2', 'creatus' ); ?></option>
				<option value="3" <?php selected( $instance['col'], '3' ); ?>><?php esc_html_e( '3', 'creatus' ); ?></option>
				<option value="4" <?php selected( $instance['col'], '4' ); ?>><?php esc_html_e( '4', 'creatus' ); ?></option>
				<option value="5" <?php selected( $instance['col'], '5' ); ?>><?php esc_html_e( '5', 'creatus' ); ?></option>
                <option value="6" <?php selected( $instance['col'], '6' ); ?>><?php esc_html_e( '6', 'creatus' ); ?></option>
			</select>
            
			<label for="<?php echo esc_attr( $this->get_field_id( 'gut' ) ); ?>"><?php esc_html_e( 'Gutter:', 'creatus' ); ?></label>
			<select style="width: 45px;" name="<?php echo esc_attr( $this->get_field_name( 'gut' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'gut' ) ); ?>" class="widefat">
				<option value="0" <?php selected( $instance['gut'], '0' ); ?>><?php esc_html_e( '0px', 'creatus' ); ?></option>
                <option value="5" <?php selected( $instance['gut'], '5' ); ?>><?php esc_html_e( '5px', 'creatus' ); ?></option>
				<option value="10" <?php selected( $instance['gut'], '10' ); ?>><?php esc_html_e( '10px', 'creatus' ); ?></option>
				<option value="15" <?php selected( $instance['gut'], '15' ); ?>><?php esc_html_e( '15px', 'creatus' ); ?></option>
				<option value="20" <?php selected( $instance['gut'], '20' ); ?>><?php esc_html_e( '20px', 'creatus' ); ?></option>
				<option value="25" <?php selected( $instance['gut'], '25' ); ?>><?php esc_html_e( '25px', 'creatus' ); ?></option>
                <option value="30" <?php selected( $instance['gut'], '30' ); ?>><?php esc_html_e( '30px', 'creatus' ); ?></option>
			</select>
		</p>
	<?php
	}
}