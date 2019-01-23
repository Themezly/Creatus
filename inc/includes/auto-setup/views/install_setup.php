<?php if ( ! defined( 'ABSPATH' ) ) die( 'Direct access forbidden.' ); ?>
<div class="wrap install-setup">

	<?php if( $auto_install_finished ) : ?>
		<h1><?php esc_html_e( 'Themezly Plugins Updates', 'creatus' ) ?></h1>
		<br/>
		<!-- START INSTALL PLUGINS UPDATE -->
        <div class="postbox-holder plugins-update-holder">
            <div class="postbox auto-setup-box plugins-update">
                <div class="header hndle">
                    <h3><span><?php esc_html_e( 'Plugins Update', 'creatus' ) ?></span></h3>
                </div>
                <div class="content">
                    <p>
                        <?php esc_html_e('This utility can reinstall the latest versions of plugins provided by Themezly.com. Check the plugins you wish to update than click on Update Plugins button.', 'creatus'); ?>
                    </p>
                    <p><input type="checkbox" class="update-all-plugins"><?php esc_html_e( 'Update All', 'creatus' ) ?></p>
                    <ul class="update-plugins-list">
                        <?php
						
						 $tgmpa_plugins = _thz_get_tgmpa_plugins_list();
						
						if(!empty($plugins_data)){
						 foreach ( $plugins_data as $key => $plugin ):
						
							$path 			= ABSPATH . 'wp-content/plugins/'.$plugin['slug'].'/'.$plugin['slug'].'.php';
							$version 		= is_file( $path ) ? get_plugin_data( $path, false, false ) : false;
							$version_html 	= '<span class="version-info">'.__( 'Not installed', 'creatus' ).'</span>';
							
							if ( $version && isset($version['Version']) ){
								
								$plugin_version = $version['Version'];
								$latest_version = $tgmpa_plugins[$plugin['slug']]['version'];
								
								if ( version_compare($plugin_version, $latest_version, '<') ) {
									
									$version_html = '<span class="version-info need-update">'.$plugin_version.'<span> ->';
									$version_html .= '<span class="version-info latest-version">'.$latest_version.'<span>';
									
								}else{
									
									$version_html = '<span class="version-info latest-version">'.$plugin_version.'<span>';
									
								}
								
							}
							
						?>
                            <li>
                                <input type="checkbox" class="theme-plugins" value="<?php echo $plugin['name'] ?>"> 
								<?php printf( esc_html__( '%s Plugin', 'creatus' ), $plugin['name'] ); ?><?php echo $version_html ?><br />
                            </li>
                        <?php endforeach; }?>
                    </ul>
                </div>
                <div class="actions">
                    <a class="button button-primary update-plugins-btn" href="<?php echo esc_url($update_auto_install_url); ?>"><?php esc_html_e( 'Update Plugins', 'creatus' ) ?></a>
                </div>
            </div>
        </div>
		<!-- END INSTALL PLUGINS UPDATE -->
	<?php else: ?>

	<h1><?php esc_html_e( 'Auto Setup', 'creatus' ) ?></h1>
	<p class="sub-header"><?php esc_html_e( 'Choose one of the install methods below.', 'creatus' ) ?></p>
	<br/>
	<?php if($has_demo_content): ?>
	<!-- START INSTALL PLUGINS AND DEMO CONTENT -->
    <div class="postbox-holder">
        <div class="postbox auto-setup-box plugins-and-demo">
            <div class="header hndle">
                <h3><span><?php esc_html_e( 'Plugins & Demo Content', 'creatus' ) ?></span></h3>
            </div>
            <div class="content">
    
                <p>
                    <?php echo $messages['plugins_and_demo'] ?>
                </p>
                <ul>
                    <li>
                        <div class="dashicons dashicons-yes"></div>
                        <span><?php esc_html_e( 'Unyson Framework', 'creatus' ) ?></span></li>
                    <?php foreach ( $plugins_list as $plugin_name ): ?>
                        <li>
                            <div class="dashicons dashicons-yes"></div>
                            <span><?php printf( esc_html__( '%s Plugin', 'creatus' ), $plugin_name ); ?></span></li>
                    <?php endforeach; ?>
                    <li>
                        <div class="dashicons dashicons-yes"></div>
                        <span><?php esc_html_e( 'Download and Activate Child Theme', 'creatus' ) ?></span>
                    </li>
                    <li>
                        <div class="dashicons dashicons-yes"></div>
                        <span><?php esc_html_e( 'Redirect to Demo Content Installer', 'creatus' ) ?></span>
                    </li>
                </ul>
            </div>
            <div class="actions">
                <a class="button button-primary"
                   href="<?php echo $import_demo_content_url; ?>"><?php esc_html_e( 'Install Plugins & Demo Content', 'creatus' ) ?></a>
    
            </div>
        </div>
    </div>
	<!-- END INSTALL PLUGINS AND DEMO CONTENT -->
	<?php endif; ?>
	<!-- START INSTALL PLUGINS ONLY CONTENT -->
    <div class="postbox-holder">
        <div class="postbox auto-setup-box plugins-only">
            <div class="header hndle">
                <h3><span><?php esc_html_e( 'Plugins Only', 'creatus' ) ?></span></h3>
            </div>
            <div class="content">
    
                <p>
                    <?php echo $messages['plugins_only'] ?>
                </p>
                <ul>
                    <li>
                        <div class="dashicons dashicons-yes"></div>
                        <span><?php esc_html_e( 'Unyson Framework', 'creatus' ) ?></span></li>
                    <?php foreach ( $plugins_list as $plugin_name ): ?>
                        <li>
                            <div class="dashicons dashicons-yes"></div>
                            <span><?php printf( esc_html__( '%s Plugin', 'creatus' ), $plugin_name ); ?></span></li>
                    <?php endforeach; ?>
                    <li>
                        <div class="dashicons dashicons-yes"></div>
                        <span><?php esc_html_e( 'Download and Activate Child Theme', 'creatus' ) ?></span>
                    </li>
                    <li>
                        <div class="dashicons dashicons-no-alt"></div>
                        <span><?php esc_html_e( 'Redirect to Demo Content Installer', 'creatus' ) ?></span>
                    </li>
                </ul>
            </div>
            <div class="actions">
                <a class="button button-primary"
                   href="<?php echo $install_dependencies_url; ?>"><?php esc_html_e( 'Install Plugins Only', 'creatus' ) ?></a>
    
            </div>
        </div>
    </div>
	<!-- END INSTALL PLUGINS ONLY CONTENT -->

	<!-- START SKIP AUTO SETUP -->
    <div class="postbox-holder">
        <div class="postbox auto-setup-box skip-auto-setup">
            <div class="header hndle">
                <h3><span><?php esc_html_e( 'Skip Auto Setup', 'creatus' ) ?></span></h3>
            </div>
            <div class="content">
    
                <p>
                    <?php echo $messages['skip_auto_install'] ?>
                </p>
                <ul>
                    <li>
                        <div class="dashicons dashicons-no-alt"></div>
                        <span><?php esc_html_e( 'Unyson Framework', 'creatus' ) ?></span></li>
                    <?php foreach ( $plugins_list as $plugin_name ): ?>
                        <li>
                            <div class="dashicons dashicons-no-alt"></div>
                            <span><?php printf( esc_html__( '%s Plugin', 'creatus' ), $plugin_name ); ?></span></li>
                    <?php endforeach; ?>
                    <li>
                        <div class="dashicons dashicons-no-alt"></div>
                        <span><?php esc_html_e( 'Download and Activate Child Theme', 'creatus' ) ?></span>
                    </li>
                    <li>
                        <div class="dashicons dashicons-no-alt"></div>
                        <span><?php esc_html_e( 'Redirect to Demo Content Installer', 'creatus' ) ?></span>
                   </li>
                </ul>
            </div>
            <div class="actions">
                <a class="button button-secondary"
                   href="<?php echo $skip_auto_install_url; ?>"><?php esc_html_e( 'Skip Auto Setup', 'creatus' ) ?></a>
    
            </div>
        </div>
    </div>
	<!-- END SKIP AUTO SETUP -->
    <?php endif; ?>
</div>
<?php 
if( !$auto_install_finished  ) {
	echo $system_info;
}
?>