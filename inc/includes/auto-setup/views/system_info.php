<?php 

if ( ! defined( 'ABSPATH' ) ) die( 'Direct access forbidden.' ); 


$manifest = thz_get_variables_from_file(thz_theme_file_path ( '/inc/thzframework/theme/manifest.php' ),array('manifest' => array()));
$manifest = $manifest['manifest'];


$thz_server_requirements = thz_akg('server_requirements',$manifest);
$has_issue = false;

// wp version
global $wp_version;
$thz_wp_required_version = thz_akg('requirements/wordpress/min_version',$manifest);

if( version_compare($wp_version, $thz_wp_required_version , '<=') ){
	$thz_wp_version_text = '<i class="fw-no-icon dashicons dashicons-info"></i>'.'<strong>'.$wp_version.'</strong>';
	$thz_wp_version_description_text = '<span class="fw-error-message">' .__( "The version of WordPress installed on your site.", "creatus" ). ' '. esc_html__( 'We recommend you update WordPress to the latest version. The minimum required version for this theme is:', 'creatus' ) .' <strong>'.$thz_wp_required_version. '</strong>. <a target="_blank" href="'.esc_url( admin_url('update-core.php') ).'">'.__('Do that right now', 'creatus').'</a></span>';
	
	$has_issue = true;
}
else{
	$thz_wp_version_text = '<i class="fw-yes-icon dashicons dashicons-yes"></i>'.'<strong>'.$wp_version.'</strong>';
	$thz_wp_version_description_text = esc_html__( "The version of WordPress installed on your site", "creatus" );
}

// wp multisite
if ( is_multisite() ){
	$thz_multisite_text = '<i class="fw-yes-icon dashicons dashicons-yes"></i>'.'<strong>'.__('Yes', 'creatus').'</strong>';
}
else{
	$thz_multisite_text = '<i class="fw-yes-icon dashicons dashicons-yes"></i>'.'<strong>'.__('No', 'creatus').'</strong>';
}

// wp debug mode
if ( defined('WP_DEBUG') && WP_DEBUG ){
	$thz_wp_debug_mode_text = '<i class="fw-no-icon dashicons dashicons-info"></i>'.'<strong>'.__('Yes', 'creatus').'</strong>';
	$thz_wp_debug_mode_description_text = '<span class="fw-error-message">' .__( 'Displays whether or not WordPress is in Debug Mode. This mode is used by developers to test the theme. We recommend you turn it off for an optimal user experience on your website.', 'creatus' ).' <a href="https://codex.wordpress.org/WP_DEBUG" target="_blank">'.__('Learn how to do it', 'creatus').'</a></span>';
	
	$has_issue = true;
	
}
else{
	$thz_wp_debug_mode_text = '<i class="fw-yes-icon dashicons dashicons-yes"></i>'.'<strong>'.__('No', 'creatus').'</strong>';
	$thz_wp_debug_mode_description_text = esc_html__( 'Displays whether or not WordPress is in Debug Mode', 'creatus' );
}

// wp memory limit
$thz_memory = _thz_return_memory_size( WP_MEMORY_LIMIT );
$thz_requirements_wp_memory_limit = _thz_return_memory_size($thz_server_requirements['server']['wp_memory_limit']);
if ( $thz_memory < $thz_requirements_wp_memory_limit ) {
	$thz_wp_memory_limit_text = '<i class="fw-no-icon dashicons dashicons-info"></i>'.'<strong>'.size_format( $thz_memory ).'</strong>';
	$thz_wp_memory_limit_description_text = '<span class="fw-error-message">' . esc_html__('The maximum amount of memory (RAM) that your site can use at one time.', 'creatus') . ' '.__( 'We recommend setting memory to at least <strong>128MB</strong>. Please define memory limit in <strong>wp-config.php</strong> file.', 'creatus').' <a href="http://codex.wordpress.org/Editing_wp-config.php#Increasing_memory_allocated_to_PHP" target="_blank">'.__('Learn how to do it', 'creatus' ).'</a></span>';
	$has_issue = true;
	
} else {
	$thz_wp_memory_limit_text = '<i class="fw-yes-icon dashicons dashicons-yes"></i>'.'<strong>'.size_format( $thz_memory ).'</strong>';
	$thz_wp_memory_limit_description_text = esc_html__('The maximum amount of memory (RAM) that your site can use at one time', 'creatus');
}

// php version
if ( function_exists( 'phpversion' ) ) {
	if( version_compare(phpversion(), $thz_server_requirements['server']['php_version'], '<=') ){
		$thz_php_version_text = '<i class="fw-no-icon dashicons dashicons-info"></i><strong>'.esc_html( phpversion() ).'</strong>';
		$thz_php_version_description_text = '<span class="fw-error-message">' .esc_html__( 'The version of PHP installed on your hosting server.', 'creatus' ).' '.esc_html__( 'We recommend you update PHP to the latest version. The minimum required version for this theme is:', 'creatus' ) .' <strong>'.$thz_server_requirements['server']['php_version']. '</strong>. '.__('Contact your hosting provider, they can install it for you.', 'creatus').'</span>';
		
		$has_issue = true;
	}
	else{
		$thz_php_version_text = '<i class="fw-yes-icon dashicons dashicons-yes"></i><strong>'.esc_html( phpversion() ).'</strong>';
		$thz_php_version_description_text =  esc_html__( 'The version of PHP installed on your hosting server', 'creatus' );
	}
}
else{
	$thz_php_version_text = esc_html__('No PHP Installed', 'creatus');
}

// php post max size
$thz_requirements_post_max_size = _thz_return_memory_size($thz_server_requirements['server']['post_max_size']);
if ( _thz_return_memory_size( ini_get('post_max_size') ) < $thz_requirements_post_max_size ) {
	$thz_php_post_max_size_text = '<i class="fw-no-icon dashicons dashicons-info"></i><strong>'.size_format(_thz_return_memory_size( ini_get('post_max_size') ) ).'</strong>';
	$thz_php_post_max_size_description_text = '<span class="fw-error-message">' .esc_html__( 'The maximum size for all POST body data.', 'creatus'  ).' '. esc_html__( 'We recommend setting the post maximum size to at least:', 'creatus' ) .' <strong>'.size_format($thz_requirements_post_max_size). '</strong>'.'. <a href="https://themezly.com/docs/how-to-increase-the-post-max-size-limit/" target="_blank">'.__('Learn how to do it','creatus').'</a></span>';
	
	$has_issue = true;
}
else{
	$thz_php_post_max_size_text = '<i class="fw-yes-icon dashicons dashicons-yes"></i><strong>'.size_format(_thz_return_memory_size( ini_get('post_max_size') ) ).'</strong>';
	$thz_php_post_max_size_description_text = esc_html__( 'The largest file size that can be contained in one post', 'creatus'  );
}

// php time limit
$thz_time_limit = ini_get('max_execution_time');
$thz_required_php_time_limit = (int)$thz_server_requirements['server']['php_time_limit'];
if ( $thz_time_limit < $thz_required_php_time_limit && $thz_time_limit != 0 ) {
	$thz_php_time_limit_text = '<i class="fw-no-icon dashicons dashicons-info"></i>'.'<strong>'.$thz_time_limit.'</strong>';
	$thz_php_time_limit_description_text = '<span class="fw-error-message">'.esc_html__( 'The amount of time (in seconds) that your site will spend on a single operation before timing out (to avoid server lockups).', 'creatus'  ).' '.__( 'We recommend setting the maximum execution time to at least', 'creatus').' <strong>'.$thz_required_php_time_limit.'</strong>'.'. <a href="http://codex.wordpress.org/Common_WordPress_Errors#Maximum_execution_time_exceeded" target="_blank">'.__('Learn how to do it','creatus').'</a></span>';
	
	$has_issue = true;
	
} else {
	$thz_php_time_limit_description_text = esc_html__( 'The amount of time (in seconds) that your site will spend on a single operation before timing out (to avoid server lockups)', 'creatus'  );
	$thz_php_time_limit_text = '<i class="fw-yes-icon dashicons dashicons-yes"></i>'.'<strong>'.$thz_time_limit.'</strong>';
}

// php max input vars
$thz_max_input_vars = ini_get('max_input_vars');
$thz_required_input_vars = $thz_server_requirements['server']['php_max_input_vars'];
if ( $thz_max_input_vars < $thz_required_input_vars ) {
	$thz_php_max_input_vars_description_text = '<span class="fw-error-message">'.esc_html__( 'The maximum number of variables your server can use for a single function to avoid overloads.', 'creatus'  ). ' '.__( 'Please increase the maximum input variables limit to:','creatus').' <strong>' . $thz_required_input_vars . '</strong>'.'. <a href="https://themezly.com/docs/how-to-increase-the-maximum-input-variables-limit/" target="_blank">'.__('Learn how to do it','creatus').'</a></span>';
	$thz_php_max_input_vars_text = '<i class="fw-no-icon dashicons dashicons-info"></i><strong>'.$thz_max_input_vars.'</strong>';
	
	$has_issue = true;
	
} else {
	$thz_php_max_input_vars_description_text = esc_html__( 'The maximum number of variables your server can use for a single function to avoid overloads.', 'creatus'  );
	$thz_php_max_input_vars_text = '<i class="fw-yes-icon dashicons dashicons-yes"></i><strong>'.$thz_max_input_vars.'</strong>';
}

// suhosin
if( extension_loaded( 'suhosin' ) ) {
	$thz_suhosin_text = '<i class="fw-no-icon dashicons dashicons-info"></i><strong>'.__('Yes', 'creatus').'</strong>';
	$thz_suhosin_description_text = '<span class="fw-error-message">'. esc_html__( 'Suhosin is an advanced protection system for PHP installations and may need to be configured to increase its data submission limits', 'creatus'  ).'</span>';
	$thz_max_input_vars      = ini_get( 'suhosin.post.max_vars' );
	$thz_required_input_vars = $thz_server_requirements['server']['suhosin_post_max_vars'];
	if ( $thz_max_input_vars < $thz_required_input_vars ) {

		$thz_suhosin_description_text .= '<span class="fw-error-message">' . sprintf( esc_html__( '%s - Recommended Value is: %s.', 'creatus' ), $thz_max_input_vars, '<strong>' . ( $thz_required_input_vars ) . '</strong>' ) . '</span> <a href="https://themezly.com/docs/how-to-increase-the-max-input-vars-limit/" target="_blank">'.__('Increasing max input vars limit','creatus').'</a>';

		$has_issue = true;
		
	}
}
else {
	$thz_suhosin_text = '<i class="fw-yes-icon dashicons dashicons-yes"></i><strong>'.__('No', 'creatus').'</strong>';
	$thz_suhosin_description_text = esc_html__( 'Suhosin is an advanced protection system for PHP installations.', 'creatus'  );
}

// mysql version
global $wpdb;
if( version_compare($wpdb->db_version(), $thz_server_requirements['server']['mysql_version'], '<=') ){
	$thz_mysql_version_text = '<i class="fw-no-icon dashicons dashicons-info"></i><strong>'.$wpdb->db_version().'</strong>';
	$thz_mysql_version_description_text = '<span class="fw-error-message">' . esc_html__( 'The version of MySQL installed on your hosting server.', 'creatus'  ).' '. esc_html__( 'We recommend you update MySQL to the latest version. The minimum required version for this theme is:', 'creatus' ) .' <strong>'.$thz_server_requirements['server']['mysql_version']. '</strong> '.__('Contact your hosting provider, they can install it for you.', 'creatus').'</span>';
	
	$has_issue = true;
}
else{
	$thz_mysql_version_text = '<i class="fw-yes-icon dashicons dashicons-yes"></i><strong>'.$wpdb->db_version().'</strong>';
	$thz_mysql_version_description_text = esc_html__( 'The version of MySQL installed on your hosting server', 'creatus'  );
}

// max upload size
$thz_requirements_max_upload_size = _thz_return_memory_size($thz_server_requirements['server']['max_upload_size']);
if ( wp_max_upload_size() < $thz_requirements_max_upload_size ) {
	$thz_max_upload_size_text = '<i class="fw-no-icon dashicons dashicons-info"></i><strong>'.size_format(wp_max_upload_size()).'</strong>';
	$thz_max_upload_size_description_text = '<span class="fw-error-message">' . esc_attr__( 'The largest file size that can be uploaded to your WordPress installation.', 'creatus'  ). ' '.esc_html__( 'We recommend setting the maximum upload file size to at least:', 'creatus' ) .' <strong>'.size_format($thz_requirements_max_upload_size). '</strong>. <a href="https://themezly.com/docs/how-to-increase-the-max-upload-size-limit/" target="_blank">'.__('Learn how to do it', 'creatus').'</a></span>';
	
	$has_issue = true;
	
}
else{
	$thz_max_upload_size_text = '<i class="fw-yes-icon dashicons dashicons-yes"></i><strong>'.size_format(wp_max_upload_size()).'</strong>';
	$thz_max_upload_size_description_text = esc_attr__( 'The largest file size that can be uploaded to your WordPress installation', 'creatus'  );
}

// fsockopen
if( function_exists( 'fsockopen' ) || function_exists( 'curl_init' ) ) {
	$thz_fsockopen_text = '<i class="fw-yes-icon dashicons dashicons-yes"></i><strong>'.esc_html__('Yes', 'creatus').'</strong>';
	$thz_fsockopen_description_text = esc_html__( 'Payment gateways can use cURL to communicate with remote servers to authorize payments, other plugins may also use it when communicating with remote services', 'creatus' );
}
else{
	$thz_fsockopen_text = '<i class="fw-no-icon dashicons dashicons-info"></i><strong>'.esc_html__('No', 'creatus').'</strong>';
	$thz_fsockopen_description_text = '<span class="fw-error-message">'.__( 'Payment gateways can use cURL to communicate with remote servers to authorize payments, other plugins may also use it when communicating with remote services. Your server does not have <strong>fsockopen</strong> or <strong>cURL</strong> enabled thus PayPal IPN and other scripts which communicate with other servers will not work. Contact your hosting provider, they can install it for you.', 'creatus' ).'</span>';
	
	$has_issue = true;
	
}

$hass_issue_class = $has_issue ? ' fw-no-icon dashicons dashicons-info':' fw-yes-icon dashicons dashicons-yes';





$options = array(

	'wordpress-environment-box' => array(
		'title'   => __( 'WordPress Environment', 'creatus' ),
		'options' => array(
			'home_url' => array(
				'label' => __( 'Home URL', 'creatus' ),
				'desc'  => esc_html__( "The URL of your site's homepage", "creatus" ),
				'html'  => '<i class="fw-yes-icon dashicons dashicons-yes"></i>'.'<strong>'.esc_url(home_url()).'</strong>',
			),
			'site_url' => array(
				'label' => __( 'Site URL', 'creatus' ),
				'desc'  => esc_html__( "The root URL of your site", "creatus" ),
				'html'  => '<i class="fw-yes-icon dashicons dashicons-yes"></i>'.'<strong>'.esc_url(site_url()).'</strong>',
			),
			'wp_version' => array(
				'label' => __( 'WP Version', 'creatus' ),
				'desc'  => $thz_wp_version_description_text,
				'html'  => $thz_wp_version_text,
			),
			'wp_multisite' => array(
				'label' => __( 'WP Multisite', 'creatus' ),
				'desc'  => esc_html__( 'Whether or not you have WordPress Multisite enabled', 'creatus' ),
				'html'  => $thz_multisite_text,
			),
			'wp_debug_mode' => array(
				'label' => __( 'WP Debug Mode', 'creatus' ),
				'desc'  => $thz_wp_debug_mode_description_text,
				'html'  => $thz_wp_debug_mode_text,
			),
			'wp_memory_limit' => array(
				'label' => __( 'WP Memory Limit', 'creatus' ),
				'desc'  => $thz_wp_memory_limit_description_text,
				'html'  => $thz_wp_memory_limit_text,
			),
		)
	),
	'server-environment-box' => array(
		'title'   => __( 'Server Environment', 'creatus' ),
		'options' => array(
			'server_info' => array(
				'label' => __( 'Server Info', 'creatus' ),
				'desc'  => esc_html__( "Information about the web server that is currently hosting your site", "creatus" ),
				'type'  => 'thz-html',
				'html'  => '<i class="fw-yes-icon dashicons dashicons-yes"></i><strong>'.esc_html( $_SERVER['SERVER_SOFTWARE'] ).'</strong>',
			),
			'php_version' => array(
				'label' => __( 'PHP Version', 'creatus' ),
				'desc'  => $thz_php_version_description_text,
				'html'  => $thz_php_version_text,
			),
			'php_post_max_size' => array(
				'attr'  => array( 'class' => 'fw-theme-requirements-option', ),
				'label' => __( 'PHP Post Max Size', 'creatus' ),
				'desc'  => $thz_php_post_max_size_description_text,
				'html'  => $thz_php_post_max_size_text,
			),
			'php_time_limit' => array(
				'attr'  => array( 'class' => 'fw-theme-requirements-option', ),
				'label' => __( 'PHP Time Limit', 'creatus' ),
				'desc'  => $thz_php_time_limit_description_text,
				'html'  => $thz_php_time_limit_text,
			),
			'php_max_input_vars' => array(
				'attr'  => array( 'class' => 'fw-theme-requirements-option', ),
				'label' => __( 'PHP Max Input Vars', 'creatus' ),
				'desc'  => $thz_php_max_input_vars_description_text,
				'html'  => $thz_php_max_input_vars_text,
			),
			'suhosin_installed' => array(
				'attr'  => array( 'class' => 'fw-theme-requirements-option', ),
				'label' => __( 'SUHOSIN Installed', 'creatus' ),
				'desc'  => $thz_suhosin_description_text,
				'html'  => $thz_suhosin_text,
			),
			'zip_archive' => array(
				'attr'  => array( 'class' => 'fw-theme-requirements-option', ),
				'label' => __( 'ZipArchive', 'creatus' ),
				'desc'  => class_exists( 'ZipArchive' ) ? esc_html__('ZipArchive is required for importing demos. They are used to import and export zip files specifically for sliders', 'creatus') : '<span class="fw-error-message">'.esc_html__('ZipArchive is required for importing demos. They are used to import and export zip files specifically for sliders.', 'creatus').' '.__('Contact your hosting provider, they can install it for you.', 'creatus').'</span>',
				'html'  => class_exists( 'ZipArchive' ) ? '<i class="fw-yes-icon dashicons dashicons-yes"></i><strong>'.esc_html__('Yes', 'creatus').'</strong>' : '<i class="fw-no-icon dashicons dashicons-info"></i><strong>'.esc_html__('No', 'creatus').'</strong>',
			),
			'mysql_version' => array(
				'attr'  => array( 'class' => 'fw-theme-requirements-option', ),
				'label' => __( 'MySQL Version', 'creatus' ),
				'desc'  => $thz_mysql_version_description_text,
				'html'  => $thz_mysql_version_text,
			),
			'max_upload_size' => array(
				'attr'  => array( 'class' => 'fw-theme-requirements-option', ),
				'label' => __( 'Max Upload Size', 'creatus' ),
				'desc'  => $thz_max_upload_size_description_text,
				'html'  => $thz_max_upload_size_text,
			),
			'fsockopen' => array(
				'attr'  => array( 'class' => 'fw-theme-requirements-option', ),
				'label' => __( 'fsockopen/cURL', 'creatus' ),
				'desc'  => $thz_fsockopen_description_text,
				'html'  => $thz_fsockopen_text,
			),
		)
	),
);


?>
<div class="wrap creatus-system-info">
	<div class="thz-system-info">
		<h1><?php esc_html_e( 'System info', 'creatus' ) ?> <span class="thz-admin-system-state<?php echo $hass_issue_class; ?>"></span></h1>
		<p class="sub-header">
		<?php echo __( 'Please make sure all items below are marked with a green check <b>before</b> proceeding with the auto setup or saving the theme options.', 'creatus' ) ?>
        </p>
        <br/>
    	<?php foreach ($options as $key => $tab ){ ?>
        	<div class="thz-system-group">
            	<h3 class="thz-system-group-title"><?php echo $tab['title']; ?></h3>
            	<?php foreach ($tab['options'] as $o ){ ?>
                    <div class="thz-system-option">
                    	<div class="thz-system-option-in">
                    		<div class="thz-system-option-label cell"><?php echo $o['label']?></div>
                        	<div class="thz-system-option-info cell">
								<?php echo $o['html']?>
                                <div class="thz-system-option-desc"><?php echo $o['desc']?></div>
                            </div>
                        </div>
                       
                    </div>
                <?php } ?>
            </div>
        <?php } ?>
        <div class="thz-system-info-legend">
    <i class="fw-yes-icon dashicons dashicons-yes"></i><span class="fw-success-message"><?php echo esc_html__('Meets minimum requirements', 'creatus') ?></span><br><i class="fw-no-icon dashicons dashicons-info"></i><span class="fw-error-message"><?php echo esc_html__("We have some improvements to suggest", "creatus") ?></span>    
        </div>
    </div>
</div>