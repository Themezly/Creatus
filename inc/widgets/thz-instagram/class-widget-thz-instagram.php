<?php if ( ! defined( 'ABSPATH' ) ) die( 'Direct access forbidden.' );

class Widget_Thz_Instagram extends WP_Widget {
	
	
	function __construct() {
		$widget_ops = array( 'description' => esc_html__( 'Instagram images widget', 'creatus' ) );
		parent::__construct( false, esc_html__( 'Creatus - Instagram images', 'creatus' ), $widget_ops );
		
        $this->defaults = array(
			'title'         => '',
			'username'      => '',
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

		$filepath = thz_theme_file_path ( '/inc/widgets/thz-instagram/views/widget.php' );
		
		$params['widget_id'] = $args['widget_id'];
		
		$data = array(
			'instance'      => $params,
			'title'         => $title,
			'before_widget' => str_replace( 'class="widget ', 'class="widget thz-instagram-widget ', $before_widget ),
			'after_widget'  => $after_widget,
		);

		echo thz_render_view( $filepath, $data );
	}
	
	
	function update( $new_instance, $old_instance ) {
		
		$username 	= $new_instance['username'];
		$widget_id 	= $this->id;
		$number 	= $new_instance['number'];
		$trans_name = 'thz-instagram-images-' . sanitize_title_with_dashes( $username.$widget_id ) . '-'.$number;
		delete_transient($trans_name);
		delete_option($trans_name);
		
		return $new_instance;
	}
	
	
	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, $this->defaults );
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'creatus' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>"/>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'username' ) ); ?>"><?php esc_html_e( 'Username:', 'creatus' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'username' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'username' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['username'] ); ?>"/>
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
