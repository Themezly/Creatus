<?php
/**
 * @package      Thz Framework
 * @author       Themezly
 * @websites     http://www.themezly.com | http://www.youjoomla.com | http://www.yjsimplegrid.com
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // No direct access
}
/**
 * This is a default customizer hero section
 */
 
$before 		= get_option('creatus_before_hero_title',false);
$title 			= get_option('creatus_hero_title',false); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.OverrideProhibited
$sub 			= get_option('creatus_hero_subtitle',false);
$button_text 	= get_option('creatus_hero_button_text',false);
$button_link 	= get_option('creatus_hero_button_link',false);

if( !$before && !$title && !$sub && !$button_text && !$button_link ) {
	return;
}

$allow = array(
    'a' => array(
        'href' => array(),
        'title' => array()
    ),
    'br' => array(),
    'em' => array(),
    'strong' => array(),
);

?>
<div id="thz-customizer-hero">
  <div class="thz-container content-contained thz-site-width">
    <div class="thz-row">
      <div class="thz-column thz-col-1">
        <?php if( $before ) { ?>
        <span class="thz-heading-before">
          <?php echo wp_kses( $before, $allow ); ?>
        </span>
        <?php } ?>
        <?php if( $title ) { ?>
        <h2 class="thz-heading-title"><?php echo wp_kses( $title, $allow ); ?></h2>
        <?php } ?>
        <?php if( $sub ) { ?>
        <p class="thz-heading-sub">
          <?php echo wp_kses( $sub, $allow ); ?>
        </p>
        <?php } ?>
        <?php if( $button_text || $button_link ) { ?>
        <div class="thz-btn-center-wrap">
          <div class="thz-btn-container thz-btn-move-up thz-btn-sh-ishidden thz-mt-30 thz-btn-flat">
            <a class="thz-button thz-btn-green thz-btn-trans thz-btn-medium thz-radius-50 thz-align-center thz-boxshadow-down-02" href="<?php echo esc_html( $button_link ); ?>">
              <span class="thz-btn-text thz-fs-14 thz-fw-600 thz-lsp1">
               <?php echo esc_html( $button_text ); ?>
              </span>
            </a>
          </div>
        </div>
        <?php } ?>
      </div>
    </div>
  </div>
</div>