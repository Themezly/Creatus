<?php
/**
 * @package      Thz Framework
 * @author       Themezly
 * @websites     http://www.themezly.com | http://www.youjoomla.com | http://www.yjsimplegrid.com
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // No direct access
}

$consent_text 			= thz_get_theme_option('cookcn/active/cs/text');
$consent_button 		= thz_get_theme_option('cookcn/active/cs/button/html');
$t_display				= thz_get_theme_option('cookcn/active/cs/cbs/layout/display',null);
$animate				= thz_get_theme_option('cookcn/active/cs/a',null);
$animation_data			= thz_print_animation($animate);
$animation_class		= thz_print_animation($animate,true);
$consent_classes		= 'thz-animate-parent container-is-'.$t_display;
$container_classes		= 'thz-consent-container is-'.$t_display.$animation_class;
?>
<div id="thz_cookies_consent" class="<?php echo thz_sanitize_class($consent_classes); ?>">
  <div class="<?php echo thz_sanitize_class($container_classes); ?>"<?php echo thz_sanitize_data($animation_data); ?>>
  	  <?php if( $consent_text !='' ){ ?>
      <div class="thz-consent-block thz-consent-text">
      	<?php echo do_shortcode($consent_text) ?>
      </div><?php } ?>
      <div class="thz-consent-block thz-consent-button">
        <?php echo thz_btn_print ( $consent_button ) ?>
      </div>
  </div>
</div>