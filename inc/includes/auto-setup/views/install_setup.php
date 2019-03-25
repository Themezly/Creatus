<?php if ( ! defined( 'ABSPATH' ) ) die( 'Direct access forbidden.' ); ?>
<div class="wrap install-setup">
	<?php if( !$auto_install_finished ) : ?>
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
    
</div>
<?php echo $system_info; ?>
<?php endif; ?>