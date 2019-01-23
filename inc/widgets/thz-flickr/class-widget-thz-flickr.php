<?php if ( ! defined( 'ABSPATH' ) ) die( 'Direct access forbidden.' );

class Widget_Thz_Flickr extends WP_Widget {
	
	
	function __construct() {
		$widget_ops = array( 'description' => esc_html__( 'Flickr images widget', 'creatus' ) );
		parent::__construct( false, esc_html__( 'Creatus - Flickr images', 'creatus' ), $widget_ops );
		
        $this->defaults = array(
			'title'         => '',
			'api'        	=> '',
			'userid'        => '',
			'photoset'      => '',
			'number'        => '',
			'keep_data'     => 'i',
        );
	}


	function widget( $args, $instance ) {
		
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

		$filepath = thz_theme_file_path ( '/inc/widgets/thz-flickr/views/widget.php' );
		
		$params['widget_id'] = $args['widget_id'];
		
		$data = array(
			'instance'      => $params,
			'title'         => $title,
			'before_widget' => str_replace( 'class="widget ', 'class="widget thz-flickr-widget ', $before_widget ),
			'after_widget'  => $after_widget,
		);
		
		
		echo thz_render_view( $filepath, $data );
	}
	
	
	function update( $new_instance, $old_instance ) {
		
		$userid 	= $new_instance['userid'];
		$widget_id 	= $this->id;
		$number 	= $new_instance['number'];
		$trans_name = 'thz-flickr-images-' . sanitize_title_with_dashes( $userid.$widget_id ) . '-'.$number;
		delete_transient($trans_name);
		delete_option($trans_name);
		
		return $new_instance;
	}
	
	
	function form( $instance ) {
		$instance 	= wp_parse_args( (array) $instance, $this->defaults);
		$api 		= $instance['api'];
		
		if ( empty( $api ) ) {
			$api = 'c9d2c2fda03a2ff487cb4769dc0781ea';
		}
		
		$userid_link = 'http://www.webpagefx.com/tools/idgettr/';
		$userapi_link = 'http://www.flickr.com/services/apps/create/apply';
		$photoset_link = 'https://www.flickr.com/services/api/explore/flickr.photosets.getPhotos';
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'creatus' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>"/>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'api' ) ); ?>"><?php esc_html_e( 'API key ', 'creatus' ); ?> (<a href="<?php echo esc_url($userapi_link); ?>" target="_blank"><?php esc_html_e('Get API key', 'creatus'); ?></a>):</label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'api' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'api' ) ); ?>" type="text" value="<?php echo esc_attr( $api ); ?>"/>
            <small><?php printf( __( 'Use this key until you get your own: %s', 'creatus' ), 'c5125a0fd25d986b2ec17e1c2b5d2c7d' ); ?></small>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'userid' ) ); ?>"><?php esc_html_e( 'User ID', 'creatus' ); ?> (<a href="<?php echo esc_url($userid_link); ?>" target="_blank"><?php esc_html_e('Get user ID', 'creatus'); ?></a>):</label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'userid' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'userid' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['userid'] ); ?>"/>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'photoset' ) ); ?>"><?php esc_html_e( 'Photo set ID', 'creatus' ); ?> (<a href="<?php echo esc_url($photoset_link); ?>" target="_blank"><?php esc_html_e('Get photo set ID', 'creatus'); ?></a>):</label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'photoset' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'photoset' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['photoset'] ); ?>"/>
             <small><?php esc_html_e( 'If this is used than only images from this photoset are displayed.', 'creatus' ); ?></small>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php esc_html_e( 'Number of images:', 'creatus' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['number'] ); ?>"/>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'keep_data' ) ); ?>"><?php esc_html_e( 'Keep data:', 'creatus' ); ?></label>
			<select name="<?php echo esc_attr( $this->get_field_name( 'keep_data' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'keep_data' ) ); ?>" class="widefat">
				<option value="a" <?php selected( $instance['keep_data'], 'a' ); ?>><?php esc_html_e( 'Acitve', 'creatus' ); ?></option>
				<option value="i" <?php selected( $instance['keep_data'], 'i' ); ?>><?php esc_html_e( 'Inactive', 'creatus' ); ?></option>
			</select>
            <small><?php esc_html_e( 'If this option is active, data is saved as WP option, otherwise it is saved as expiring transient.', 'creatus' ); ?></small>
		</p>
	<?php
	}
}
