<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access forbidden.' );
}

class Thz_Admin_Plugins_Install {
	
	private $page_slug = 'creatus_auto_setup';
	private $file_uri;
	private $file_path;
	private $config_path;
	private $view_path;
	private $css_uri;
	protected $config;
	private $plugins;
	private $theme_id;
	private $option_key;
	protected $_prefix = 'thz';

	const ERR = 0;
	const ERR_REQUIRED = 1;

	public function __construct() {
		$this->file_uri    = get_template_directory_uri() . '/inc/includes/auto-setup';
		$this->file_path   = get_template_directory() . '/inc/includes/auto-setup';
		$this->config_path = $this->file_path . '/config';
		$this->view_path   = $this->file_path . '/views';
		$this->css_uri     = $this->file_uri . '/css';
		$this->js_uri      = $this->file_uri . '/js';

		$this->config           = require $this->config_path . '/config.php';
		$this->demos            = ! empty( $this->config['demos'] ) ? $this->config['demos'] : '';
		$this->has_demo_content = ! empty( $this->config['has_demo_content'] );
		$this->theme_id         = $this->config['theme_id'];
		$this->option_key       = $this->_prefix . '_' . $this->theme_id . '_auto_install_state';
		$this->credentials_key  = $this->_prefix . '_' . $this->theme_id . '_auto_install_credentials';

		if ( ! function_exists( 'get_plugins' ) ) {
			require_once ABSPATH . 'wp-admin/includes/plugin.php';
		}

		// all installed plugins
		$all_plugins       = get_plugins();
		$all_plugins_names = array();
		foreach ( $all_plugins as $item ) {
			$all_plugins_names[ $item['Name'] ] = $item['Name'];
		}

		$plugin_demos = array();
		// parse all required plugins
		if ( isset( $this->config['plugins'] ) && ! empty( $this->config['plugins'] ) ) {
			foreach ( $this->config['plugins'] as $item ) {
				// if is an external plugin
				if ( isset( $item['source'] ) && thz_contains( $item['source'],'themezly.io' )) {
				//if ( isset( $item['source'] ) && in_array( $item['name'], $all_plugins_names ) ) {
					$plugin_demos[ $item['slug'] ] = $item;
				}
			}
		}

		// parse all demos plugins
		if ( isset( $this->config['demos'] ) && ! empty( $this->config['demos'] ) ) {
			foreach ( $this->config['demos'] as $demos_plugin ) {
				// parse all plugins for specific demo
				foreach ( $demos_plugin as $item ) {
					// if is an external plugin
					
					if ( isset( $item['source'] ) && thz_contains( $item['source'],'themezly.io' )) {
					//if ( isset( $item['source'] ) && in_array( $item['name'], $all_plugins_names ) ) {
						$plugin_demos[ $item['slug'] ] = $item;
					}

				}
			}
		}
		
		
		$this->plugins = $plugin_demos; // plugins for update

		$this->redirect_after_activation();

		add_action( 'init', array( $this, 'ob_start_action' ), - 1 );

		$this->add_actions();
		$this->add_ajax_requests();

		add_action( 'wp_ajax_' . $this->_prefix . '_install_demo_plugins', array(
			$this,
			'install_demo_plugins'
		) );

		// for demo page, install plugins for demos
		add_action( 'load-tools_page_fw-backups-demo-content', array( $this, 'load_page_tools_callback' ) );

		add_action( 'wp_ajax_' . $this->_prefix . '_activate_demo_plugins', array(
			$this,
			'activate_demo_plugins'
		) );
	}

	/* demo content install */
	public function load_page_tools_callback() {
		if ( ! empty( $this->demos ) ) {
			wp_enqueue_script(
				$this->_prefix . '-demo-content-install',
				$this->get_demo_js_uri(),
				array( 'jquery', 'underscore', 'fw' )
			);

			wp_localize_script(
				$this->_prefix . '-demo-content-install',
				'demo_plugins',
				array(
					'admin_url'    => admin_url(),
					'demo_plugins' => $this->demos,
					'steps'        => $this->get_demo_steps(),
					'messages'     => array(
						'installing'              => __( 'Installing', 'creatus' ),
						'start_install_plugins'   => __( 'Installing required plugins ...', 'creatus' ),
						'finish_install_plugins'  => __( 'Finished installing required plugins', 'creatus' ),
						'start_activate_plugins'  => __( 'Activating required plugins ...', 'creatus' ),
						'finish_activate_plugins' => __( 'Finished activating required plugins', 'creatus' ),
					)
				)
			);
		}
	}

	public function get_demo_js_uri() {
		return $this->js_uri . '/super_admin_demo_content_install.js';
	}

	public function get_demo_steps() {
		return array(
			'activate-demo-plugins' => array(
				'ajax_action' => $this->_prefix . '_activate_demo_plugins',
				'nonce'       => wp_create_nonce( 'activate-demo-plugins' ),
				'message'     => esc_html__( 'Activate required demo plugins', 'creatus' ),
			),
			'install-demo-plugins'  => array(
				'ajax_action' => $this->_prefix . '_install_demo_plugins',
				'nonce'       => wp_create_nonce( 'install-demo-plugins' ),
				'message'     => esc_html__( 'Install required demo plugins', 'creatus' ),
			),
		);
	}

	public function install_demo_plugins() {

		if ( ! current_user_can( 'install_plugins' ) ) {
			wp_send_json_error( array( 'message' => "Current user can't install plugins" ) );
		}

		check_ajax_referer( 'install-demo-plugins' );

		$credentials = get_site_transient( $this->credentials_key );

		if ( ! $this->initialize_filesystem( $credentials, WP_PLUGIN_DIR ) ) {
			if (empty($credentials) && get_filesystem_method() !== 'direct') {
				/**
				 * We don't have credentials and can't ask user for them.
				 * So instead of fail, just skip the plugin installation.
				 */
				wp_send_json_success();
			}

			wp_send_json_error( array(
				'message' => sprintf( esc_html__( 'Failed to install required plugins. Folder %s is not writable', 'creatus' ), WP_PLUGIN_DIR ),
			) );
		}

		if( !isset($_POST['demo_plugins']) ) {
			$_POST['demo_plugins'] = array();
		}
		
		$response = Thz_Plugin_Installer_Helper::bulk_install( $_POST['demo_plugins'] );

		$message        = array();
		$failed_plugins = array();
		foreach ( $response as $slug => $data ) {
			if ( ! $data['install']['success'] ) {
				$message[ $slug ] = $data;
				$failed_plugins[] = ucfirst( $slug );
			}
		}

		if ( ! empty( $failed_plugins ) ) {

			wp_send_json_error( array(
				'message' => sprintf( esc_html__( 'Failed to install required plugins. %s', 'creatus' ), implode( ', ', $failed_plugins ) ),
			) );
		}
		ob_end_clean();
		wp_send_json_success();
	}

	public function activate_demo_plugins() {
		/* skip the revslider templates check */
		update_option( 'revslider-templates-check',  time() );

		check_ajax_referer( 'activate-demo-plugins' );

		if( !isset($_POST['demo_plugins']) ) {
			$_POST['demo_plugins'] = array();
		}

		$this->send_response( $this->activate_plugins( $_POST['demo_plugins'] ) );
	}

	public function activate_plugins( $plugins ) {
		if ( ! current_user_can( 'activate_plugins' ) ) {
			return new WP_Error( 0, __( 'Current user can\'t activate plugins', 'creatus' ) );
		}

		$response = Thz_Plugin_Installer_Helper::bulk_activate( $plugins );

		$message        = array();
		$failed_plugins = array();
		$err = self::ERR;
		foreach ( $response as $slug => $data ) {
			if ( ! $data['activate']['success'] ) {
				$message[ $slug ] = $data;
				$failed_plugins[] = ucfirst( $slug );
			}
		}

		if ( ! empty( $failed_plugins ) ) {
			return new WP_Error( 0, sprintf(
					esc_html__( 'Failed to activate required plugins. %s', 'creatus' ),
					implode( ', ', $failed_plugins )
				)
			);
		}

		return array();
	}

	public function send_response( $response, $error = false ) {
		ob_end_clean();
		if ( is_wp_error( $response ) ) {
			wp_send_json( array(
				'success' => true,
				'data' => array(
					'message' => $response->get_error_message()
				)
			) );
		}

		wp_send_json_success();
	}
	/* end demo content install */

	private function redirect_after_activation() {
		if( is_customize_preview() ) {
			return;
		}

		global $pagenow;
		if ( is_admin() && ( ( isset( $_GET['activated'] ) && $pagenow == 'themes.php' ) || !get_option($this->option_key) ) ) {
			update_option( $this->option_key, $this->get_default_option_value(), false );

			header( 'Location: ' . add_query_arg(
					array(
						'page' => $this->page_slug,
					),
					admin_url( 'admin.php' )
				) );
		}
	}

	public function get_required_plugins() {
		return $this->plugins;
	}

	public function add_ajax_requests() {
		add_action( 'wp_ajax_' . $this->_prefix . '_install_required_plugins', array(
			$this,
			'install_required_plugins'
		) );

		add_action( 'wp_ajax_' . $this->_prefix . '_finish_install_process', array(
			$this,
			'finish_install_process'
		) );
	}

	public function item_menu_page() {
		add_theme_page( 'Thz Plugins Update', 'Thz Plugins Update', 'manage_options', $this->page_slug, array(
			$this,
			'auto_setup_page'
		) );
	}

	public function install_required_plugins() {
		if ( ! current_user_can( 'install_plugins' ) ) {
			wp_send_json_error( array( 'message' => "Current user can't install plugins" ) );
		}

		check_ajax_referer( 'install-required-plugins' );

		$credentials = get_site_transient( $this->credentials_key );

		if ( ! $this->initialize_filesystem( $credentials, WP_PLUGIN_DIR ) ) {
			wp_send_json_error( array(
				'message' => sprintf( esc_html__( 'Failed to install required plugins. Folder %s is not writable', 'creatus' ), WP_PLUGIN_DIR ),
			) );
		}
		
		
		$required_plugins = $this->get_required_plugins();

		if( isset($_POST['skip_plugins']) ){
			
			$skip_plugins = json_decode( urldecode($_POST['skip_plugins']), true);
			
			foreach( $required_plugins as $key => $pdata ){
				
				if( in_array( $pdata['name'], $skip_plugins)  ){
					
					unset($required_plugins[$key]);
				}
				
			}
			
		}
		
		if( empty($required_plugins) ){
			
			$this->insert_step_status( 'install-required-plugins', true, 'No plugins installed');
	
			ob_end_clean();
	
			wp_send_json_success();			
			
		}

		$response = Thz_Plugin_Installer_Helper::bulk_install( $required_plugins , true ); // force install plugins

		$message        = array();
		$failed_plugins = array();
		foreach ( $response as $slug => $data ) {
			if ( ! $data['install']['success'] ) {
				$message[ $slug ] = $data;
				$failed_plugins[] = ucfirst( $slug );
			}
		}

		if ( ! empty( $failed_plugins ) ) {
			$this->insert_step_status( 'install-required-plugins', false, $message );

			wp_send_json_error( array(
				'message' => sprintf( esc_html__( 'Failed to install required plugins. %s', 'creatus' ), implode( ', ', $failed_plugins ) ),
			) );
		}

		$this->insert_step_status( 'install-required-plugins', true, $message );

		ob_end_clean();

		wp_send_json_success();
	}

	public function finish_install_process() {
		ob_end_clean();

		if ( ! current_user_can( 'manage_options' ) ) {
			wp_send_json_error( array( 'message' => "Current user can't manage options" ) );
		}

		check_ajax_referer( 'finish-install-process' );

		$this->insert_step_status( 'finish-install-process', true );

		// set default steps
		$option = $this->get_finished_option_value();
		$option['steps']['auto-setup-step-choosed'] = 'plugins_update';
		update_option( $this->option_key, $option );
		// end set default steps

		wp_send_json_success();
	}

	protected function insert_step_status( $step, $status, $message = null ) {
		$option                      = get_option( $this->option_key );
		$option['steps'][ $step ]    = (bool) $status;
		$option['messages'][ $step ] = $message;

		$option['steps']['auto-setup-step-choosed'] = 'plugins_update';

		update_option( $this->option_key, $option );
	}

	public function install_finished() {
		$option = get_option( $this->option_key );

		$checker = false;

		if ( ! empty( $option['steps'] ) ) {
			$checker = true;
			foreach ( $option['steps'] as $step ) {
				if ( $step == false ) {
					$checker = false;
					break;
				}
			}
		}

		return $checker;
	}

	private function process_is_running() {
		$current_state = get_option( $this->option_key, array() );

		return ( ! empty( $current_state['install_process']['install_dependencies'] ) || ! empty( $current_state['install_process']['import_demo_content'] ) );
	}

	private function generate_url( $install_dependencies = 0, $import_demo_content = 0 ) {
		return add_query_arg( array(
			'page'                 => $this->page_slug,
			'install_dependencies' => $install_dependencies,
			'import_demo_content'  => $import_demo_content
		), admin_url( 'admin.php' )
		);
	}

	private function generate_request_credentials_url( $install_dependecies = 0, $import_demo_content = 0 ) {
		return add_query_arg( array(
			'page'                => $this->page_slug,
			'request_credentials' => true
		),
			$this->generate_url( $install_dependecies, $import_demo_content )
		);
	}

	public function get_setup_messages() {
		return array(
			'plugins_only'      => sprintf( esc_html__( 'This option will activate Unyson dependencies. The %s demo content will not be installed %s.', 'creatus' ), '<b>', '</b>' ),
			'plugins_and_demo'  => sprintf( esc_html__( 'This option will activate Unyson dependencies together %s with the demo content %s for the theme.', 'creatus' ), '<b>', '</b>' ),
			'skip_auto_install' => esc_html__( 'Skip the auto setup all together and activate all the Unyson dependencies manually. Note that this page will not be  accessible until you install the theme again.', 'creatus' )
		);
	}

	public function auto_setup_page() {

		$auto_setup_url = add_query_arg( array(
			'page' => $this->page_slug,
		), admin_url( 'admin.php' ) );

		$credentials = get_site_transient( $this->credentials_key );

		if ( ! empty( $_GET['request_credentials'] ) ) {
			request_filesystem_credentials( $auto_setup_url, '', false, false, null );

			return;
		}

		if ( ! $credentials && ! $this->initialize_filesystem( $credentials, WP_PLUGIN_DIR ) ) {
			ob_start();
			$credentials = request_filesystem_credentials( $auto_setup_url, '', false, false, null );
			ob_get_clean();
			set_site_transient( $this->credentials_key, $credentials, DAY_IN_SECONDS );
		}

		$this->auto_setup_page_view();
	}

	public function get_js_uri() {
		return $this->js_uri . '/plugins_install.js';
	}

	private function admin_enqueue_scripts( $view = 'install' ) {


		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'underscore' );
		
		if( 'choose' == $view ){
			
			wp_enqueue_script( $this->_prefix . '-plugins-install-choose', $this->js_uri . '/plugins_install_choose.js', array(
				'jquery',
				'underscore'
			) );			
		}
		
		if( 'install' == $view ){
			wp_enqueue_script( $this->_prefix . '-plugins-install', $this->get_js_uri(), array(
				'jquery',
				'underscore'
			) );
			
			$auto_setup_data = array(
				'admin_url'                 => admin_url(),
				'demo_content_url'          => add_query_arg( array(
					'page'              => 'fw-backups-demo-content',
					'from_auto_install' => 1
				), admin_url( 'tools.php' ) ),
				'steps'                     => $this->get_steps(),
				'messages'                  => array(
					'on_leave_alert'    => esc_html__( 'Attention, the installation process is not yet finished, if you leave this page, you will lose the information stored on the site!', 'creatus' ),
					'server_problems'   => esc_html__( "Sorry, we've encountered some errors, try to access this page later.", "creatus" ),
					'process_completed' => esc_html__( 'The installation process was completed successfully.', 'creatus' )
				),
			);
			
			wp_localize_script( $this->_prefix . '-plugins-install', 'auto_setup_data', $auto_setup_data );
		
		}
	}

	public function initialize_filesystem( $credentials = false, $context ) {
		return ( WP_Filesystem( $credentials, $context ) === true );
	}

	public function auto_setup_page_view() {

		if ( $this->process_is_running() ) {
			
			$this->admin_enqueue_scripts();
			echo ($this->render_view( $this->view_path . '/auto_setup.php' ));
			
		} else {
			
			//update_option( $this->option_key, array() );
			
			//echo print_r(get_option( $this->option_key ));
			$this->admin_enqueue_scripts('choose');
			
			
			$credentials              = get_site_transient( $this->credentials_key );
			$have_credentials         = $this->initialize_filesystem( $credentials, WP_PLUGIN_DIR );
			$install_dependencies_url = $have_credentials ? $this->generate_url( true, false ) : $this->generate_request_credentials_url( true, false );
			$import_demo_content_url  = $have_credentials ? $this->generate_url( true, true ) : $this->generate_request_credentials_url( true, true );
			$this->render_install_setup( array(
				'install_dependencies_url' => $install_dependencies_url,
				'import_demo_content_url'  => $import_demo_content_url,
				'skip_auto_install_url'    => $this->generate_url(),
				'update_auto_install_url'  => $this->generate_url(2),
				'auto_install_finished'    => $this->install_finished(),
				'messages'                 => $this->get_setup_messages(),
				'plugins_list'             => wp_list_pluck( $this->plugins, 'name' ),
				'plugins_data'             => $this->plugins,
				'has_demo_content'         => $this->has_demo_content()
			) );
		}
	}

	private function has_demo_content() {
		return $this->has_demo_content;
	}

	private function get_default_option_value() {
		return array(
			'steps'           => $this->get_steps_keys(),
			'install_process' => array(
				'install_dependencies' => false,
				'import_demo_content'  => false
			)
		);
	}

	private function get_finished_option_value() {
		return array(
			'steps'           => $this->get_steps_keys(true), // force to set steps to true (it's called on plugins_update_finished)
			'install_process' => array(
				'install_dependencies' => false,
				'import_demo_content'  => false
			)
		);
	}

	private function get_steps_keys( $fill_value = false ) {
		return array_fill_keys( array_keys( $this->get_steps() ), $fill_value );
	}

	protected function get_steps() {
		return array(
			'install-required-plugins'     => array(
				'ajax_action' => $this->_prefix . '_install_required_plugins',
				'nonce'       => wp_create_nonce( 'install-required-plugins' ),
				'message'     => esc_html__( 'Installing required plugins', 'creatus' ),
			),
			'finish-install-process'        => array(
				'ajax_action' => $this->_prefix . '_finish_install_process',
				'nonce'       => wp_create_nonce( 'finish-install-process' ),
				'message'     => esc_html__( 'Finish installing process', 'creatus' )
			)
		);
	}

	public function add_actions() {
		add_action( 'admin_menu', array( $this, 'item_menu_page' ), 20 );
		add_action( 'wp_loaded', array( $this, 'set_option_values' ), 21 );
	}

	public function ob_start_action() {
		$ajax_actions = $this->get_list_of_ajax_actions();

		if ( defined( 'DOING_AJAX' ) && DOING_AJAX && isset( $_REQUEST['action'] ) && in_array( $_REQUEST['action'], $ajax_actions ) ) {
			ob_start();
		}
	}

	public function get_list_of_ajax_actions() {
		return array_values( wp_list_pluck( $this->get_steps(), 'ajax_action' ) );
	}

	public function set_option_values() {
		$option_value = get_option( $this->option_key );

		if ( get_option( $this->option_key ) === false ) {
			update_option( $this->option_key, $this->get_default_option_value(), false );
			$option_value = get_option( $this->option_key );
		}

		if ( isset( $_GET['install_dependencies'] ) or isset( $_GET['import_demo_content'] ) ) {
			$option_value['install_process']['install_dependencies'] = ! empty( $_GET['install_dependencies'] ) ? $_GET['install_dependencies'] : false;
			$option_value['install_process']['import_demo_content']  = ( ! empty( $_GET['import_demo_content'] ) );
			update_option( $this->option_key, $option_value, false );
		}
	}

	public function render_install_setup( $params ) {
		wp_enqueue_style( $this->_prefix.'-auto-setup-css', $this->css_uri . '/styles.css' );

		echo ($this->render_view( $this->view_path . '/install_setup.php', $params ));
	}

	/**
	 * Safe render a view and return html
	 * In view will be accessible only passed variables
	 * Use this function to not include files directly and to not give access to current context variables (like $this)
	 *
	 * @param string $file_path
	 * @param array $view_variables
	 * @param bool $return In some cases, for memory saving reasons, you can disable the use of output buffering
	 *
	 * @return string HTML
	 */
	private function render_view( $file_path, $view_variables = array(), $return = true ) {
		extract( $view_variables, EXTR_REFS );

		unset( $view_variables );

		if ( $return ) {
			ob_start();

			require $file_path;

			return ob_get_clean();
		} else {
			require $file_path;
		}
	}
}