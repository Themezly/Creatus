<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access forbidden.' );
}

require('class-thz-plugins-install.php');

class Thz_Simple_Auto_Install {
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


	public function __construct() {
		$this->file_uri    = get_template_directory_uri() . '/inc/includes/auto-setup';
		$this->file_path   = get_template_directory() . '/inc/includes/auto-setup';
		$this->config_path = $this->file_path . '/config';
		$this->view_path   = $this->file_path . '/views';
		$this->css_uri     = $this->file_uri . '/css';
		$this->js_uri      = $this->file_uri . '/js';

		$this->config           = require $this->config_path . '/config.php';
		$this->plugins          = $this->config['plugins'];
		$this->demos            = ! empty( $this->config['demos'] ) ? $this->config['demos'] : '';
		$this->has_demo_content = ! empty( $this->config['has_demo_content'] );
		$this->theme_id         = $this->config['theme_id'];
		$this->option_key       = $this->_prefix . '_' . $this->theme_id . '_auto_install_state';
		$this->credentials_key  = $this->_prefix . '_' . $this->theme_id . '_auto_install_credentials';

		if ( ! function_exists( 'get_plugins' ) ) {
			require_once ABSPATH . 'wp-admin/includes/plugin.php';
		}

		$this->redirect_after_activation();

		add_action( 'init', array( $this, 'ob_start_action' ), - 1 );

		if ( ! $this->install_finished() ) {
			$this->add_actions();
			$this->add_ajax_requests();
		}
	}

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

	public function get_theme_id() {
		return $this->theme_id;
	}

	public function get_required_plugins() {
		return $this->plugins;
	}

	public function add_ajax_requests() {
		add_action( 'wp_ajax_' . $this->_prefix . '_activate_supported_extensions', array(
			$this,
			'activate_supported_extensions'
		) );

		add_action( 'wp_ajax_' . $this->_prefix . '_finish_install_process', array(
			$this,
			'finish_install_process'
		) );
	}

	public function item_menu_page() {
		add_theme_page( esc_html('Auto Setup','creatus'), esc_html('Auto Setup','creatus'), 'manage_options', $this->page_slug, array(
			$this,
			'auto_setup_page'
		) );
	}

	public function finish_install_process() {
		ob_end_clean();

		if ( ! current_user_can( 'manage_options' ) ) {
			wp_send_json_error( array( 'message' => esc_html('Current user can\'t manage options','creatus') ) );
		}

		check_ajax_referer( 'finish-install-process' );

		$this->insert_step_status( 'finish-install-process', true );
		
		// set next steps to be plugins update
		$option = $this->set_plugins_update_steps();
		update_option( $this->option_key, $option );
		// end set plugins update steps

		wp_send_json_success();
	}
	
	private function set_plugins_update_steps() {
		return array(
			'steps'           => array(
				'install-required-plugins' => true,
				'finish-install-process' => true,
				'auto-setup-step-choosed' => 'plugins_update'
			),
			'install_process' => array(
				'install_dependencies' => false,
				'import_demo_content'  => false
			)
		);
	}

	public function activate_supported_extensions() {

		ob_end_clean();

		if ( ! current_user_can( 'manage_options' ) && ! defined( 'FW' ) ) {
			wp_send_json_error( array( 'message' => esc_html('Current user can\'t manage options or the Unyson Plugin is not yet installed','creatus') ) );
		}

		check_ajax_referer( 'activate-supported-extensions' );

		$supported_extensions = fw()->theme->manifest->get( 'supported_extensions', array() );

		if ( $this->get_import_demo_content_state() ) {
			if ( ! array_key_exists( 'backups', $supported_extensions ) ) {
				$supported_extensions['backups'] = array();
			}
			unset( $supported_extensions['backup'] );
		}

		$result = fw()->extensions->manager->activate_extensions( $supported_extensions );

		if ( is_wp_error( $result ) ) {
			$this->insert_step_status( 'activate-supported-extensions', false, $result );
			wp_send_json_error( array( 'message' => $result ) );
		}

		if ( is_array( $result ) ) {
			$failed_extensions = array();
			foreach ( $result as $extension => $response ) {
				if ( is_wp_error( $response ) ) {
					$failed_extensions[] = ucfirst( $extension );
				}
			}

			if ( ! empty( $failed_extensions ) ) {
				$this->insert_step_status( 'activate-supported-extensions', false, $result );

				wp_send_json_error( array(
					'message' => sprintf( esc_html__( 'Failed to activate supported extensions. %s ', 'creatus' ), implode( ', ', $failed_extensions ) ),
				) );
			}
		}

		$this->insert_step_status( 'activate-supported-extensions', true, $result );
		wp_send_json_success();
	}

	protected function insert_step_status( $step, $status, $message = null ) {
		$option                      = get_option( $this->option_key );
		$option['steps'][ $step ]    = (bool) $status;
		$option['messages'][ $step ] = $message;
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
			'plugins_only'      => sprintf( esc_html__( 'This option will activate theme dependencies. You will %s not be redirected to demo content installer %s.', 'creatus' ), '<b>', '</b>' ),
			'plugins_and_demo'  => sprintf( esc_html__( 'This option will activate theme dependencies and %s redirect you to demo content installer %s.', 'creatus' ), '<b>', '</b>' ),
			'skip_auto_install' => esc_html__( 'Skip the auto setup all together and activate all the theme dependencies manually. Note that this page will not be  accessible until you deactivate/activate the theme again.', 'creatus' )
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
		return $this->js_uri . '/simple_auto_install.js';
	}

	private function admin_enqueue_scripts() {


		$settings_link = self_admin_url( 'themes.php');
		
		if(thz_fw_loaded()  && thz_fw_active()){
			
			$settings_link = self_admin_url( 'themes.php?page=' . fw()->backend->_get_settings_page_slug() );
		}

		$auto_setup_data = array(
			'admin_url'                 => admin_url(),
			'theme_settings_url'        => $settings_link,
			'demo_content_url'          => add_query_arg( array(
				'page'              => 'fw-backups-demo-content',
				'from_auto_install' => 1
			), admin_url( 'tools.php' ) ),
			'steps'                     => $this->get_steps(),
			'messages'                  => array(
				'on_leave_alert'    => esc_html__( 'Attention, the installation process is not finished, if you leave this page the information stored will be lost!', 'creatus' ),
				'server_problems'   => esc_html__( 'Sorry, we\'ve encountered some errors, try to access this page later.', 'creatus' ),
				'process_completed' => esc_html__( 'The installation process was completed successfully.', 'creatus' )
			),
			'import_demo_content_state' => $this->get_import_demo_content_state()
		);

		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'underscore' );

		wp_enqueue_script( $this->_prefix . '-auto-setup', $this->get_js_uri(), array(
			'jquery',
			'underscore'
		) );
		wp_localize_script( $this->_prefix . '-auto-setup', 'auto_setup_data', $auto_setup_data );

	}


	public function initialize_filesystem( $credentials = false, $context ) {
		return ( WP_Filesystem( $credentials, $context ) === true );
	}

	public function auto_setup_page_view() {

		if ( $this->process_is_running() ) {
			$this->admin_enqueue_scripts();
			echo $this->render_view( $this->view_path . '/auto_setup.php' );

		} else {
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
				'has_demo_content'         => $this->has_demo_content(),
				'system_info'			   => $this->render_view( $this->view_path . '/system_info.php', array() )
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

	private function get_steps_keys( $fill_value = false ) {
		return array_fill_keys( array_keys( $this->get_steps() ), $fill_value );
	}

	protected function get_steps() {
		return array(
			'activate-supported-extensions' => array(
				'ajax_action' => $this->_prefix . '_activate_supported_extensions',
				'nonce'       => wp_create_nonce( 'activate-supported-extensions' ),
				'message'     => esc_html__( 'Activating supported extensions', 'creatus' )
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
		add_action( 'wp_loaded', array( $this, 'set_option_values' ), 10 );
		add_action( 'wp_loaded', array( $this, 'skip_auto_install' ), 12 );
	}

	public function ob_start_action() {
		$ajax_actions = $this->get_list_of_ajax_actions();

		if ( defined( 'DOING_AJAX' ) && DOING_AJAX && isset( $_REQUEST['action'] ) && in_array( $_REQUEST['action'], $ajax_actions ) ) {
			ob_start();
		}
	}

	public function skip_auto_install() {

		if ( isset( $_GET['install_dependencies'] ) &&
		     isset( $_GET['import_demo_content'] ) &&
		     $_GET['install_dependencies'] == false &&
		     $_GET['import_demo_content'] == false
		) {
			$option_value          = get_option( $this->option_key );
			$option_value['steps'] = $this->get_steps_keys( true );
			// added for know that auto-setup is skiped
			$option_value['steps']['auto-setup-step-choosed'] = 'skip';
			update_option( $this->option_key, $option_value, false );
			wp_redirect( admin_url() );
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
			$option_value['install_process']['install_dependencies'] = ( ! empty( $_GET['install_dependencies'] ) );
			$option_value['install_process']['import_demo_content']  = ( ! empty( $_GET['import_demo_content'] ) );
			update_option( $this->option_key, $option_value, false );
		}
	}

	public function get_import_demo_content_state() {
		$option = get_option( $this->option_key );

		return (bool) $option['install_process']['import_demo_content'];
	}

	public function render_install_setup( $params ) {
		wp_enqueue_style( $this->_prefix.'-auto-setup-css', $this->css_uri . '/styles.css' );

		echo $this->render_view( $this->view_path . '/install_setup.php', $params );
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

class Thz_Admin_Auto_Install extends Thz_Simple_Auto_Install {

	const ERR = 0;
	const ERR_REQUIRED = 1;

	public function __construct() {
		parent::__construct();
		//for demo page, install plugins for demos
		add_action( 'load-tools_page_fw-backups-demo-content', array( $this, 'load_page_tools_callback' ) );

		add_action( 'wp_ajax_' . $this->_prefix . '_activate_demo_plugins', array(
			$this,
			'activate_demo_plugins'
		) );

	}

	public function get_list_of_ajax_actions() {
		$demo_list = array_values( wp_list_pluck( $this->get_demo_steps(), 'ajax_action' ) );

		return array_merge( parent::get_list_of_ajax_actions(), $demo_list );
	}

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
						'installing'              => esc_html__( 'Installing, please wait', 'creatus' ),
						'start_install_plugins'   => esc_html__( 'Installing required plugins, please wait ...', 'creatus' ),
						'finish_install_plugins'  => esc_html__( 'Finished installing required plugins, please wait', 'creatus' ),
						'start_activate_plugins'  => esc_html__( 'Activating required plugins, please wait...', 'creatus' ),
						'finish_activate_plugins' => esc_html__( 'Finished Activating required plugins, please wait', 'creatus' ),
					)
				)
			);
		}
	}

	public function get_demo_js_uri() {
		return $this->js_uri . '/admin_demo_content_install.js';
	}

	public function get_demo_steps() {
		return array(
			'activate-demo-plugins' => array(
				'ajax_action' => $this->_prefix . '_activate_demo_plugins',
				'nonce'       => wp_create_nonce( 'activate-demo-plugins' ),
				'message'     => esc_html__( 'Activate required demo plugins', 'creatus' ),
			)
		);
	}

	public function activate_demo_plugins() {
		check_ajax_referer( 'activate-demo-plugins' );

		if( !isset($_POST['demo_plugins']) ) {
			$_POST['demo_plugins'] = array();
		}

		$this->send_response( $this->activate_plugins( $_POST['demo_plugins'] ) );
	}

	public function get_steps() {
		return array_merge(
			parent::get_steps(),
			array(
				'activate-unyson'           => array(
					'ajax_action' => $this->_prefix . '_activate_unyson',
					'nonce'       => wp_create_nonce( 'activate-unyson' ),
					'message'     => esc_html__( 'Activating Unyson', 'creatus' ),
				),
				'activate-required-plugins' => array(
					'ajax_action' => $this->_prefix . '_activate_required_plugins',
					'nonce'       => wp_create_nonce( 'activate-required-plugins' ),
					'message'     => esc_html__( 'Activate required plugins', 'creatus' ),
				)
			)
		);
	}

	public function get_setup_messages() {
		return array(
			'plugins_only'      => sprintf( esc_html__( 'This option will activate %s already installed plugins and dependencies %s by Network Administrator. You will %s not be redirected to theme demo content installer %s.', 'creatus' ), '<b>', '</b>', '<b>', '</b>' ),
			'plugins_and_demo'  => sprintf( esc_html__( 'This option will activate theme dependencies %s and redirect you to theme demo content installer %s.', 'creatus' ), '<b>', '</b>' ),
			'skip_auto_install' => esc_html__( 'Skip the auto setup all together and activate all the plugins manually. Note that this page will not be accessible until you deactivate/activate the theme again.', 'creatus' )
		);
	}

	public function get_js_uri() {
		return $this->js_uri . '/admin_auto_install.js';
	}

	public function add_ajax_requests() {
		parent::add_ajax_requests();

		add_action( 'wp_ajax_' . $this->_prefix . '_activate_required_plugins', array(
			$this,
			'activate_required_plugins'
		) );

		add_action( 'wp_ajax_' . $this->_prefix . '_activate_unyson', array(
			$this,
			'activate_unyson'
		) );

		add_action( 'wp_ajax_' . $this->_prefix . '_activate_unyson', array(
			$this,
			'activate_unyson'
		) );
	}

	public function activate_unyson() {
		ob_end_clean();

		if ( ! current_user_can( 'activate_plugins' ) ) {
			wp_send_json_error( array( 'message' => 'Current user can\'t activate plugins' ) );
		}

		check_ajax_referer( 'activate-unyson' );

		$response = Thz_Plugin_Installer_Helper::activate( array(
			'name' => 'Unyson',
			'slug' => 'unyson'
		) );
		$message  = ( $response['success'] === true ) ? null : $response['data']['message'];
		$this->insert_step_status( 'activate-unyson', $response['success'], $message );

		wp_send_json( $response );
	}

	public function activate_required_plugins() {
		check_ajax_referer( 'activate-required-plugins' );
		$response = $this->activate_plugins( $this->get_required_plugins() );

		if ( is_wp_error( $response ) ) {
			$this->insert_step_status( 'activate-required-plugins', false, $response->get_error_message() );
		} else {
			$this->insert_step_status( 'activate-required-plugins', true, $response );
		}

		$this->send_response( $response );
	}

	public function activate_plugins( $plugins ) {
		if ( ! current_user_can( 'activate_plugins' ) ) {
			return new WP_Error( 0, esc_html__( 'Current user can\'t activate plugins', 'creatus' ) );
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

	/**
	 * @param bool $error
	 * @param WP_Error $response
	 */
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
}

class Thz_Super_Admin_Auto_Install extends Thz_Admin_Auto_Install {
	private $child_theme_source;

	public function __construct() {
		parent::__construct();
		$this->child_theme_source = $this->config['child_theme_source'];

		add_action( 'wp_ajax_' . $this->_prefix . '_install_demo_plugins', array(
			$this,
			'install_demo_plugins'
		) );
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

	public function get_js_uri() {
		return $this->js_uri . '/super_admin_auto_install.js';
	}

	public function get_steps() {
		return array_merge(
			parent::get_steps(),
			array(
				'install-unyson'               => array(
					'ajax_action' => $this->_prefix . '_install_unyson',
					'nonce'       => wp_create_nonce( 'install-unyson' ),
					'message'     => esc_html__( 'Downloading and installing Unyson', 'creatus' ),
				),
				'install-required-plugins'     => array(
					'ajax_action' => $this->_prefix . '_install_required_plugins',
					'nonce'       => wp_create_nonce( 'install-required-plugins' ),
					'message'     => esc_html__( 'Installing required plugins', 'creatus' ),
				),
				'install-supported-extensions' => array(
					'ajax_action' => $this->_prefix . '_install_supported_extensions',
					'nonce'       => wp_create_nonce( 'install-supported-extensions' ),
					'message'     => esc_html__( 'Installing supported extensions', 'creatus' ),
				),
				'install-child-theme'          => array(
					'ajax_action' => $this->_prefix . '_install_child_theme',
					'nonce'       => wp_create_nonce( 'install-child-theme' ),
					'message'     => esc_html__( 'Downloading and installing child theme', 'creatus' ),
				),
			)
		);
	}

	public function add_ajax_requests() {

		parent::add_ajax_requests();
		add_action( 'wp_ajax_' . $this->_prefix . '_install_required_plugins', array(
			$this,
			'install_required_plugins'
		) );

		add_action( 'wp_ajax_' . $this->_prefix . '_install_unyson', array(
			$this,
			'install_unyson'
		) );

		add_action( 'wp_ajax_' . $this->_prefix . '_install_supported_extensions', array(
			$this,
			'install_supported_extensions'
		) );

		add_action( 'wp_ajax_' . $this->_prefix . '_install_child_theme', array(
			$this,
			'install_child_theme'
		) );
	}

	public function install_supported_extensions() {

		ob_end_clean();

		if ( ! current_user_can( 'install_plugins' ) ) {
			wp_send_json_error( array( 'message' => esc_html__( 'Current user can\'t install plugins', 'creatus' ) ) );
		}

		check_ajax_referer( 'install-supported-extensions' );

		$credentials = get_site_transient( $this->credentials_key );

		if ( ! $this->initialize_filesystem( $credentials, WP_PLUGIN_DIR ) ) {
			wp_send_json_error( array(
				'message' => sprintf( esc_html__( 'Failed to install supported extensions. Folder %s is not writable', 'creatus' ), WP_PLUGIN_DIR ),
			) );
		}

		$supported_extensions = fw()->theme->manifest->get( 'supported_extensions', array() );

		if ( $this->get_import_demo_content_state() ) {
			if ( ! array_key_exists( 'backups', $supported_extensions ) ) {
				$supported_extensions['backups'] = array();
			}
			unset( $supported_extensions['backup'] );
		}

		$result = fw()->extensions->manager->install_extensions( $supported_extensions, array( 'activate' => false ) );


		if ( is_wp_error( $result ) ) {
			$this->insert_step_status( 'install-supported-extensions', false, $result );
			wp_send_json_error( array( 'message' => $result ) );
		}

		if ( is_array( $result ) ) {
			$failed_extensions = array();
			foreach ( $result as $extension => $response ) {
				if ( is_wp_error( $response ) && ! isset( $response->errors['extension_installed'] ) ) {
					$failed_extensions[] = ucfirst( $extension );
				}
			}

			if ( ! empty( $failed_extensions ) ) {
				$this->insert_step_status( 'install-supported-extensions', false, $result );

				wp_send_json_error( array(
					'message' => sprintf( esc_html__( 'Failed to install supported extensions. %s ', 'creatus' ), implode( ', ', $failed_extensions ) ),
				) );
			}
		}

		$this->insert_step_status( 'install-supported-extensions', true, $result );
		wp_send_json_success();
	}

	/**
	 * Install Unyson Plugin.
	 */
	public function install_unyson() {
		ob_end_clean();

		if ( ! current_user_can( 'install_plugins' ) ) {
			wp_send_json_error( array( 'message' => esc_html__( 'Current user can\'t install plugins','creatus') ) );
		}

		check_ajax_referer( 'install-unyson' );
		$credentials = get_site_transient( $this->credentials_key );

		if ( ! $this->initialize_filesystem( $credentials, WP_PLUGIN_DIR ) ) {
			wp_send_json_error( array(
				'message' => sprintf( esc_html__( 'Failed to install Unyson. Folder %s is not writable', 'creatus' ), WP_PLUGIN_DIR ),
			) );
		}

		$response = Thz_Plugin_Installer_Helper::install( array(
			'name' => 'Unyson',
			'slug' => 'unyson'
		) );

		$this->insert_step_status( 'install-unyson', $response['success'] );

		wp_send_json( $response );
	}

	public function install_required_plugins() {


		if ( ! current_user_can( 'install_plugins' ) ) {
			wp_send_json_error( array( 'message' => esc_html__( 'Current user can\'t install plugins','creatus')) );
		}

		check_ajax_referer( 'install-required-plugins' );

		$credentials = get_site_transient( $this->credentials_key );

		if ( ! $this->initialize_filesystem( $credentials, WP_PLUGIN_DIR ) ) {
			wp_send_json_error( array(
				'message' => sprintf( esc_html__( 'Failed to install required plugins. Folder %s is not writable', 'creatus' ), WP_PLUGIN_DIR ),
			) );
		}

		$response = Thz_Plugin_Installer_Helper::bulk_install( $this->get_required_plugins() );

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

	public function install_child_theme() {
		ob_end_clean();
		if ( ! current_user_can( 'install_themes' ) || empty( $this->child_theme_source ) ) {
			wp_send_json_error( array( 'message' => esc_html__( 'Current user can\'t install themes or child theme source must be specified','creatus') ) );
		}

		check_ajax_referer( 'install-child-theme' );
		$credentials = get_site_transient( $this->credentials_key );

		if ( ! $this->initialize_filesystem( $credentials, wp_normalize_path( get_theme_root() ) ) ) {
			wp_send_json_error( array(
				'message' => sprintf( esc_html__( 'Failed to install Theme. Folder %s is not writable', 'creatus' ), wp_normalize_path( get_theme_root() ) ),
			) );
		}

		/**
		 * @var WP_Filesystem_Base $wp_filesystem
		 */
		global $wp_filesystem;

		$response = array( 'success' => true );

		$theme_path = pathinfo( get_template_directory() );
		$child_path = $theme_path['dirname'];

		$child_name     = $child_path . '/' . $this->get_theme_id() . '-child';
		$child_rel_path = str_replace( get_theme_root() . '/', '', $child_name );

		if ( ! $wp_filesystem->is_dir( $child_name ) ) {
			$response = Thz_Installer_Helper::download_and_install_a_package(
				$this->child_theme_source,
				$child_name,
				array(
					'type'   => 'theme',
					'action' => 'install',
				),
				$this->get_theme_id() . '-child'
			);
		}

		switch_theme( $child_rel_path );

		$this->insert_step_status( 'install-child-theme', $response['success'] );
		wp_send_json_success();
	}


	public function get_setup_messages() {
		return array(
			'plugins_and_demo'  => sprintf( esc_html__( 'This option will install and activate all theme plugins and dependencies and %s redirect you to theme demo content installer%s.', 'creatus' ), '<b>', '</b>' ),
			'plugins_only'      => sprintf( esc_html__( 'This option will install and activate all theme plugins and dependencies. You will %s not be redirected to theme demo content installer%s.', 'creatus' ), '<b>', '</b>' ),
			'skip_auto_install' => esc_html__( 'Skip the auto setup all together and install all the plugins manually. Note that this page will not be accessible until you deactivate/activate the theme again.', 'creatus' )
		);
	}
}

class Thz_Installer_Helper {
	public static function download_and_install_a_package( $package, $destination, $hook_extra = array(), $folder = false ) {

		if ( ! class_exists( 'WP_Upgrader' ) ) {
			require_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
		}

		@set_time_limit( 60 * 10 );

		/**
		 * @var WP_Upgrader $upgrader
		 */
		$upgrader = new WP_Upgrader( new Thz_Auto_Install_Upgrader_Skin() );

		$upgrader->generic_strings();
		$download = $upgrader->download_package( $package );
		if ( is_wp_error( $download ) ) {
			return array(
				'success' => false,
				'data'    => array(
					'message' => $download->get_error_message()
				)
			);
		}

		//Unzips the file into a temporary directory
		$working_dir = $upgrader->unpack_package( $download, true );
		if ( is_wp_error( $working_dir ) ) {
			return array(
				'success' => false,
				'data'    => array(
					'message' => $working_dir->get_error_message()
				)
			);
		}

		if ( $folder ) {
			/**
			 * @var WP_Filesystem_Base $wp_filesystem
			 */
			global $wp_filesystem;
			$upgrade_folder = $wp_filesystem->wp_content_dir() . 'upgrade/';
			$source         = $upgrade_folder . $folder;
			if ( $wp_filesystem->move( $working_dir, $source, true ) ) {
				$working_dir = $source;
			};
		}

		if ( is_wp_error( $working_dir ) ) {
			return array(
				'success' => false,
				'data'    => array(
					'message' => $working_dir->get_error_message()
				)
			);
		}

		$result = $upgrader->install_package( array(
			'source'                      => $working_dir,
			'destination'                 => $destination,
			'clear_destination'           => true,
			'abort_if_destination_exists' => false,
			'clear_working'               => true,
			'hook_extra'                  => $hook_extra
		) );

		return array(
			'success' => true,
			'data'    => array(
				'message' => $result
			)
		);
	}
}

class Thz_Plugin_Installer_Helper extends Thz_Installer_Helper {
	/**
	 * Install multiple plugin in sa me time.
	 *
	 * @param array $plugins
	 * @param bool $force - in case the plugin is installed already, re-install it
	 *
	 * @return array
	 */
	public static function bulk_install( $plugins, $force = false ) {

		$status = array();

		foreach ( $plugins as $plugin ) {
			$status[ $plugin['slug'] ]['install'] = self::install( $plugin, $force );
		}

		return $status;
	}

	/**
	 * Install plugin
	 *
	 * @param array $plugin
	 * @param bool $force - in case the plugin is installed already, re-install it
	 *
	 * @return array
	 */
	public static function install( $plugin, $force = false ) {
		return self::is_installed( $plugin ) && ! $force
			? array(
				'success' => true,
				'data'    => array(
					'message' => esc_html__( 'Plugin is already installed.', 'creatus' )
				)
			)
			: self::process_package( $plugin, 'install' );
	}

	public static function process_package( $plugin, $action ) {
		@set_time_limit( 60 * 5 );

		$download = self::get_link($plugin);

		if ( is_wp_error( $download ) ) {
			return array(
				'success' => false,
				'data'    => array(
					'message' => $download->get_error_message()
				)
			);
		}

		return self::download_and_install_a_package( $download, WP_PLUGIN_DIR, array(
			'type'   => 'plugin',
			'action' => $action
		) );
	}

	public static function activate( $plugin ) {
		if ( ! self::is_installed( $plugin ) ) {
			return array(
				'success' => false,
				'data'    => array(
					'message' => sprintf( esc_html__( 'It was not possible to activate %s. Because it isn\'t installed.', 'creatus' ), $plugin['name'] )
				)
			);
		}

		if ( self::is_active( $plugin ) ) {
			return array(
				'success' => true,
			);
		}

		$activate = activate_plugin( self::get_name( $plugin['slug'] ) );

		if ( is_wp_error( $activate ) ) {
			return array(
				'success' => false,
				'data'    => array(
					'message' => $activate->get_error_message()
				)
			);
		}

		return array(
			'success' => true
		);
	}

	public static function bulk_activate( $plugins ) {

		if ( ! current_user_can( 'activate_plugins' ) ) {
			return array(
				'message' => sprintf( esc_html__( 'Current user can\'t activate plugins.', 'creatus' ), WP_PLUGIN_DIR ),
			);
		}

		$status = array();

		wp_clean_plugins_cache( false );

		//Activate installed plugins
		foreach ( $plugins as $plugin ) {
			$status[ $plugin['slug'] ]['activate'] = self::activate( $plugin );
		}

		return $status;
	}

	private static function api( $action, $args = null ) {

		if ( is_array( $args ) ) {
			$args = (object) $args;
		}

		if ( ! isset( $args->per_page ) ) {
			$args->per_page = 24;
		}

		// Allows a plugin to override the WordPress.org API entirely.
		// Use the filter 'plugins_api_result' to merely add results.
		// Please ensure that a object is returned from the following filters.
		$args = apply_filters( 'plugins_api_args', $args, $action );
		$res  = apply_filters( 'plugins_api', false, $action, $args );

		if ( false === $res ) {
			$url = 'http://api.wordpress.org/plugins/info/1.0/';
			if ( wp_http_supports( array( 'ssl' ) ) ) {
				$url = set_url_scheme( $url, 'https' );
			}

			$request = wp_remote_post( $url, array(
				'timeout' => 15,
				'body'    => array(
					'action'  => $action,
					'request' => serialize( $args )
				)
			) );

			if ( is_wp_error( $request ) ) {
				$res = new WP_Error( 'plugins_api_failed', esc_html__( 'An unexpected error occurred. Something may be wrong with WordPress.org or this server&#8217;s configuration. If you continue to have problems, please try the <a href="http://wordpress.org/support/">support forums</a>.', 'creatus' ), $request->get_error_message() );
			} else {
				$res = maybe_unserialize( wp_remote_retrieve_body( $request ) );
				if ( ! is_object( $res ) && ! is_array( $res ) ) {
					$res = new WP_Error( 'plugins_api_failed', esc_html__( 'An unexpected error occurred. Something may be wrong with WordPress.org or this server&#8217;s configuration. If you continue to have problems, please try the <a href="http://wordpress.org/support/">support forums</a>.', 'creatus' ), wp_remote_retrieve_body( $request ) );
				}
			}
		} elseif ( ! is_wp_error( $res ) ) {
			$res->external = true;
		}

		return apply_filters( 'plugins_api_result', $res, $action, $args );
	}

	/**
	 * Return plugin path name with plugin file
	 * E.g. "unyson/unyson.php"
	 *
	 * @param $slug
	 *
	 * @return null|string
	 */
	public static function get_name( $slug ) {
		$data = get_plugins( "/$slug" );

		if ( empty( $data ) ) {
			return null;
		}

		// Reverse the array as for some plugins is are returned multiple keys,
		// and the last one is the real plugin
		$file = array_reverse( array_keys( $data ) );

		return $slug . '/' . $file[0];
	}

	/**
	 * Return the plugin data in case the plugin is active,
	 * in other case returns null
	 *
	 * @param $slug
	 *
	 * @return array|null
	 */
	public static function get_data( $slug ) {
		$data = get_plugins( "/$slug" );
		return empty($data) ? null : array_shift($data);
	}

	/**
	 * Check if the plugin is installed
	 *
	 * @param array $plugin - Plugin slug name
	 *
	 * @return bool
	 */
	public static function is_installed( $plugin ) {
		return ! ( self::get_data( $plugin['slug'] ) === null );
	}

	/**
	 * Checks is the plugin is active
	 *
	 * @param array $plugin
	 *
	 * @return bool
	 */
	public static function is_active( $plugin ) {
		//Check if the functions existsw, in case the class is used in frontend
		//https://codex.wordpress.org/Function_Reference/is_plugin_active
		if ( ! function_exists( 'is_plugin_active' ) ) {
			include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		}

		return ! self::is_installed( $plugin ) ? false : is_plugin_active( self::get_name( $plugin['slug'] ) );
	}

	public static function get_link( $plugin ) {
		if ( isset( $plugin['source'] ) ) {
			return $plugin['source'];
		}

		$call_api = self::api( 'plugin_information', array( 'slug' => $plugin['slug'] ) );

		if ( is_wp_error( $call_api ) ) {
			return $call_api;
		}

		return $call_api->download_link;
	}
}




if ( ! class_exists( 'WP_Upgrader' ) ) {
	require_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
}

class Thz_Auto_Install_Upgrader_Skin extends WP_Upgrader_Skin {

	public function feedback( $string ) {
		return;
	}
}

class Thz_Auto_Install {
	public function __construct() {
		if( check_auto_setup_plugins_status() ) {
			new Thz_Admin_Plugins_Install();
		} elseif  ( current_user_can( 'install_plugins' ) ) {
			new Thz_Super_Admin_Auto_Install();
		} elseif ( current_user_can( 'activate_plugins' ) && current_user_can( 'switch_themes' ) ) {
			new Thz_Admin_Auto_Install();
		} else {
			new Thz_Simple_Auto_Install();
		}
	}
}

new Thz_Auto_Install();


function check_auto_setup_plugins_status() {
	
	$theme_id          = 'creatus';
	$option_auto_setup = get_option('thz' . '_' . $theme_id . '_auto_install_state', array() );

	if( isset( $option_auto_setup['steps']['auto-setup-step-choosed'] ) && ($option_auto_setup['steps']['auto-setup-step-choosed'] == 'skip' || $option_auto_setup['steps']['auto-setup-step-choosed'] == 'plugins_update' ) ) {
		return true;
	}
	elseif( isset( $option_auto_setup['steps'] ) ) {
		$plugin_checker = true;
		foreach ( $option_auto_setup['steps'] as $step ) {
			if( ! $step ) {
				// if isset a step that is false return that process is not finished
				$plugin_checker = false;
				break;
			}
		}

		return $plugin_checker;
	}

	return false;
}