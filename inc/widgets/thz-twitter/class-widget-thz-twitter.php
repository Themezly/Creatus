<?php if ( ! defined( 'ABSPATH' ) ) die( 'Direct access forbidden.' );

class Widget_Thz_Twitter extends WP_Widget {
	
	
	function __construct() {
		$widget_ops = array( 'description' => esc_html__( 'Twitter widget', 'creatus' ) );
		parent::__construct( false, esc_html__( 'Creatus - Twitter', 'creatus' ), $widget_ops );
		
        $this->defaults = array(
			'title'         		=> 'Recent Tweets',
			'apikeys'    			=> 'theme',
			'consumer_key'    		=> '',
			'consumer_secret'    	=> '',
			'access_token'    		=> '',
			'access_token_secret'   => '',
			'twitter_id'    		=> '',
			'count'        			=> 3,
			'tweet_limit'         	=> ''
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
		
		
		$haslist = isset($instance['haslist'])  ? 'thz-has-list ' :'';
		$tweet_link = isset($instance['tweet_link']) ? 1 : 0; 
		
		$filepath = thz_theme_file_path( '/inc/widgets/thz-twitter/views/widget.php' );

		$data = array(
			'instance'      => $params,
			'title'         => $title,
			'before_widget' => str_replace( 'class="widget ', 'class="widget thz-twitter-widget '.$haslist, $before_widget ),
			'after_widget'  => $after_widget,
			'transient'		=> 'thz_tweets_'.$widget_id,
			'widget_id'  	=> $args['widget_id'],
			'tweet_link'  	=> $tweet_link,
			'tweet_limit'  	=> $instance['tweet_limit'],
		);

		echo thz_render_view( $filepath, $data );
	}
	
	
	function update( $new_instance, $old_instance ) {
		
		$transName = 'thz_tweets_'.$this->id;
		delete_transient($transName);

		return $new_instance;
	}
	
	
	function form( $instance ) {

		if(empty($instance)) {
			$instance['haslist'] = 1;
		}
				
		$instance = wp_parse_args( (array) $instance, $this->defaults );
		
		$haslist = isset($instance['haslist']) ? 1 : 0;
		$tweet_link = isset($instance['tweet_link']) ? 1 : 0;
		?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php echo esc_html__('Title','creatus') ?>:</label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" value="<?php echo esc_attr($instance['title']); ?>" />
        </p>
		<p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'apikeys' ) ); ?>"><?php esc_html_e( 'Api keys:', 'creatus' ); ?></label>
        <select name="<?php echo esc_attr( $this->get_field_name( 'apikeys' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'apikeys' ) ); ?>" class="widefat thz-select-switch">
            <option data-enable=".thz-go-twc-<?php echo $this->id?>" data-disable=".thz-twc-<?php echo $this->id?>" value="theme" <?php selected( $instance['apikeys'], 'theme' ); ?>><?php esc_html_e( 'Use theme api keys', 'creatus' ); ?></option>
            <option data-enable=".thz-twc-<?php echo $this->id?>" data-disable=".thz-go-twc-<?php echo $this->id?>" value="custom" <?php selected( $instance['apikeys'], 'custom' ); ?>><?php esc_html_e( 'Insert custom api keys', 'creatus' ); ?></option>
        </select>
		</p>
		<p class="thz-go-twc-<?php echo $this->id?>">
        	<a href="<?php echo self_admin_url( 'themes.php?page=fw-settings#fw-options-tab-advanced') ?>">
        		<?php echo esc_html__('Please go to theme settings and add you Twitter App api keys','creatus'); ?>
            </a>
        </p>
        <div class="thz-twc-<?php echo $this->id?>">
			<p><?php echo esc_html__('To obtain Twitter API keys please visit','creatus') ?> <a href="https://dev.twitter.com/apps" target="_blank">https://dev.twitter.com/apps</a> <?php echo esc_html__('and create new application','creatus') ?>.
            </p>
            <p>
                <label for="<?php echo esc_attr($this->get_field_id('consumer_key')); ?>"><?php echo esc_html__('Consumer Key','creatus') ?>:</label>
                <input class="widefat" id="<?php echo esc_attr($this->get_field_id('consumer_key')); ?>" name="<?php echo esc_attr($this->get_field_name('consumer_key')); ?>" value="<?php echo esc_attr($instance['consumer_key']); ?>" />
            </p>
            
            <p>
                <label for="<?php echo esc_attr($this->get_field_id('consumer_secret')); ?>"><?php echo esc_html__('Consumer Secret','creatus') ?>:</label>
                <input class="widefat" id="<?php echo esc_attr($this->get_field_id('consumer_secret')); ?>" name="<?php echo esc_attr($this->get_field_name('consumer_secret')); ?>" value="<?php echo esc_attr($instance['consumer_secret']); ?>" />
            </p>
    
            <p>
                <label for="<?php echo esc_attr($this->get_field_id('access_token')); ?>"><?php echo esc_html__('Access Token','creatus') ?>:</label>
                <input class="widefat" id="<?php echo esc_attr($this->get_field_id('access_token')); ?>" name="<?php echo esc_attr($this->get_field_name('access_token')); ?>" value="<?php echo esc_attr($instance['access_token']); ?>" />
            </p>
    
            <p>
                <label for="<?php echo esc_attr($this->get_field_id('access_token_secret')); ?>"><?php echo esc_html__('Access Token Secret','creatus') ?>:</label>
                <input class="widefat" id="<?php echo esc_attr($this->get_field_id('access_token_secret')); ?>" name="<?php echo esc_attr($this->get_field_name('access_token_secret')); ?>" value="<?php echo esc_attr($instance['access_token_secret']); ?>" />
            </p>
		</div>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('twitter_id')); ?>"><?php echo esc_html__('Twitter User','creatus') ?>:</label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('twitter_id')); ?>" name="<?php echo esc_attr($this->get_field_name('twitter_id')); ?>" value="<?php echo esc_attr($instance['twitter_id']); ?>" />
		</p>

			<label for="<?php echo esc_attr($this->get_field_id('count')); ?>"><?php echo esc_html__('Number of Tweets','creatus') ?>:</label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('count')); ?>" name="<?php echo esc_attr($this->get_field_name('count')); ?>" value="<?php echo esc_attr($instance['count']); ?>" />


        <p>
            <label for="<?php echo esc_attr($this->get_field_id('tweet_limit')); ?>"><?php echo esc_html__('Tweet characters limit','creatus') ?>:</label>
            <input size="3" style="width: 45px;" class="widefat" id="<?php echo esc_attr($this->get_field_id('tweet_limit')); ?>" name="<?php echo esc_attr($this->get_field_name('tweet_limit')); ?>" value="<?php echo esc_attr($instance['tweet_limit']); ?>" />
        </p>


        <p>
            <input class="checkbox" type="checkbox" <?php checked( $tweet_link, 1 ); ?> id="<?php echo $this->get_field_id( 'tweet_link' ); ?>" name="<?php echo $this->get_field_name( 'tweet_link' ); ?>" /> 
            <label for="<?php echo $this->get_field_id( 'tweet_link',1 ); ?>"><?php esc_html_e('Display tweet as link','creatus') ?></label>
        </p>

        <p>
            <input class="checkbox" type="checkbox" <?php checked( $haslist, 1 ); ?> id="<?php echo $this->get_field_id( 'haslist' ); ?>" name="<?php echo $this->get_field_name( 'haslist' ); ?>" /> 
            <label for="<?php echo $this->get_field_id( 'haslist',1 ); ?>"><?php esc_html_e('Use .thz-has-list class','creatus') ?></label>
        </p>

		<p></p>
	<?php
	}
}
