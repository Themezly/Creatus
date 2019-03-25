<?php
/**
 * @package      Thz Framework
 * @author       Themezly
 * @license      http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 * @websites     http://www.themezly.com | http://www.youjoomla.com | http://www.yjsimplegrid.com
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // No direct access
}
/**
 * https://gist.github.com/NateWr/5fd00beb412f78776e9d
*/
class Thz_Customizer_Notice_Control extends WP_Customize_Control {
	/**
	* Control type
	*/
	public $type = 'thz_customizer_notice';
	/**
	* HTML content to display
	*/
	public $content = '';
	public function render_content() {
	?>
    <div class="notice notice-success">
		<?php if ( !empty( $this->label ) ) :	?>
        <div class="customize-control-title">
            <?php echo esc_html( $this->label ); ?>
        </div>
        <?php endif; ?>
        <p>
            <?php echo $this->content; ?>
        </p>
    </div>     
		<?php 
	}
	
}

/**
 * Default customizer options if framework is not active
 */
function thz_action_default_customizer_options( $wp_customize ){
	
	$wp_customize->add_panel( 'creatus_default', array(
		'priority' => 30,
		'capability' => 'edit_theme_options',
		'title' => __('Theme Options', 'creatus'),
		'description' => __('Customize the login of your website.', 'creatus'),
	));	
	
	// hero section
	$wp_customize->add_section('creatus_default_hero', array(
		'priority' => 5,
		'title' => __('Hero Section', 'creatus'),
		'panel' => 'creatus_default',
	));
	
	// advise that recommended plugins are not installed
	$wp_customize->add_control(
		new Thz_Customizer_Notice_Control(
			$wp_customize,
			'hero_notice',
			array(
				'label'     => __( 'Install Recomended Plugins', 'creatus' ),
				'section'   => 'creatus_default_hero',
				'settings'   => array(),
				'content'   => sprintf(
					// Translators: 1 and 2 wrap a link to plugins installation utility.
					__( 'This is a default customizer setup. For advanced theme options Install and activate %1$srecommended plugins%2$s.', 'creatus' ),
					'<a href="' . esc_url( admin_url( 'themes.php?page=creatus-install-plugins' ) ) . '">',
					'</a>'
				),
			)
		)
	);
	
	// before title
	$wp_customize->add_setting('creatus_before_hero_title', array(
		'default'        => '',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
		'sanitize_callback' => 'esc_attr'
	));
	$wp_customize->add_control('creatus_before_hero_title', array(
		'label'   => __('Before Title', 'creatus'),
		'section' => 'creatus_default_hero',
		'type'    => 'text',
		'description' => __( 'Add text before hero section title.', 'creatus' )
	));
	
	// title
	$wp_customize->add_setting('creatus_hero_title', array(
		'default'        => '',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
		'sanitize_callback' => 'esc_attr'
	));
	$wp_customize->add_control('creatus_hero_title', array(
		'label'   => __('Hero Title', 'creatus'),
		'section' => 'creatus_default_hero',
		'type'    => 'text',
		'description' => __( 'Add hero section title.', 'creatus' )
	));	
	
	// subtitle
	$wp_customize->add_setting('creatus_hero_subtitle', array(
		'default'        => '',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
		'sanitize_callback' => 'esc_attr'
	));
	$wp_customize->add_control('creatus_hero_subtitle', array(
		'label'   => __('Sub Title', 'creatus'),
		'section' => 'creatus_default_hero',
		'type'    => 'text',
		'description' => __( 'Add hero section sub title', 'creatus' )
	));
	
	// button text
	$wp_customize->add_setting('creatus_hero_button_text', array(
		'default'        => '',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
		'sanitize_callback' => 'esc_attr'
	));
	$wp_customize->add_control('creatus_hero_button_text', array(
		'label'   => __('Button text', 'creatus'),
		'section' => 'creatus_default_hero',
		'type'    => 'text',
		'description' => __( 'Add hero button text', 'creatus' )
	));

	// button link
	$wp_customize->add_setting('creatus_hero_button_link', array(
		'default'        => '',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
		'sanitize_callback' => 'esc_attr'
	));
	$wp_customize->add_control('creatus_hero_button_link', array(
		'label'   => __('Button link', 'creatus'),
		'section' => 'creatus_default_hero',
		'type'    => 'text',
		'description' => __( 'Add hero button link', 'creatus' )
	));
		
	// branding section
	$wp_customize->add_section('creatus_default_branding', array(
		'priority' => 6,
		'title' => __('Branding', 'creatus'),
		'panel' => 'creatus_default',
	));	

	// advise that recommended plugins are not installed
	$wp_customize->add_control(
		new Thz_Customizer_Notice_Control(
			$wp_customize,
			'branding_notice',
			array(
				'label'     => __( 'Install Recomended Plugins', 'creatus' ),
				'section'   => 'creatus_default_branding',
				'settings'   => array(),
				'content'   => sprintf(
					// Translators: 1 and 2 wrap a link to plugins installation utility.
					__( 'This is a default customizer setup. For advanced theme options Install and activate %1$srecommended plugins%2$s.', 'creatus' ),
					'<a href="' . esc_url( admin_url( 'themes.php?page=creatus-install-plugins' ) ) . '">',
					'</a>'
				),
			)
		)
	);
		
	// branding text
	$wp_customize->add_setting('creatus_branding_text', array(
		'default'        => '',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
		'sanitize_callback' => 'esc_attr'
	));
	$wp_customize->add_control('creatus_branding_text', array(
		'label'   => __('Branding text', 'creatus'),
		'section' => 'creatus_default_branding',
		'type'    => 'text',
		'description' => __( 'Add branding ( copyright ) text', 'creatus' )
	));

	// branding link
	$wp_customize->add_setting('creatus_branding_link', array(
		'default'        => '',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
		'sanitize_callback' => 'esc_attr'
	));
	$wp_customize->add_control('creatus_branding_link', array(
		'label'   => __('Branding link', 'creatus'),
		'section' => 'creatus_default_branding',
		'type'    => 'text',
		'description' => __( 'Add branding link', 'creatus' )
	));
	
}

add_action('customize_register', 'thz_action_default_customizer_options');