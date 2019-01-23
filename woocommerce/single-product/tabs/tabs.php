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
 * Single Product tabs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/tabs.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.4.0
 */

/**
 * Filter tabs and allow third parties to add their own.
 *
 * Each tab is an array containing title, callback and priority.
 * @see woocommerce_default_product_tabs()
 */
$tabs 			= apply_filters( 'woocommerce_product_tabs', array() );
$isFirstLi 		= true;
$isFirstCo 		= true;
$tabs_count 	= count($tabs);
$tabs_layout 	= thz_get_option('wootabs/tabl/lay','centered');
$above			= ($tabs_layout !='left' && $tabs_layout !='right' ) ? ' thz-tabs-above' :'';
$l_space		= thz_get_option('wootabs/tabl/lsp',0);
$l_bradius		= thz_get_option('wootabs/tabl/lbr',0);
$has_builder	= thz_has_builder() ? ' thz-tabs-have-builder' : '';
$has_radius		= $l_bradius > 0  && ($tabs_layout !='left' && $tabs_layout !='right') ? ' thz-tabl-radius' : ' thz-tabl-noradius';
$has_space		= $l_space > 0 && ($tabs_layout =='top' || $tabs_layout =='centered') ? ' thz-tabl-space' : ' thz-tabl-nospace';
$tabs_class 	= ' thz-shortcode-tabs thz-tabs-'.$tabs_layout.' thz-tabs-count-'.esc_attr($tabs_count).$above.$has_radius.$has_space;
$holder_c 		= thz_has_builder() ? ' thz-has-builder' : thz_single_cmx('wootabs_mx',false,false);
$max_c 			= thz_has_builder() ? ' thz-max-100' : thz_single_cmx('wootabs_mx',true, false);

//Note: space before and after li removed to fix browser default display-inline space
if ( ! empty( $tabs ) ) : ?>
<div class="thz-product-tabs-row thz-content-row">
    <div class="thz-product-tabs-holder<?php echo thz_sanitize_class( $holder_c ) ?>">
        <div class="thz-max-holder<?php echo thz_sanitize_class( $max_c ) ?>">
            <div class="thz-clear"></div>
            <div class="thz-woo-tabs<?php echo thz_sanitize_class($tabs_class); ?>">
                <?php if( thz_has_builder() ){ ?>
                    <div class="thz-tabs-menu-container<?php thz_single_cmx('wootabs_mx') ?>">
                        <ul class="thz-tabs-menu">
                            <?php foreach ( $tabs as $key => $tab ) : ?><li class="<?php echo $isFirstLi ? 'thz-active-tab' : 'thz-inactive-tab'; ?>">
                                    <a class="thz-tab-button" href="#thz-tabs-woo-<?php echo esc_attr( $key ); ?>">
                                        <?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', esc_html( $tab['title'] ), $key ); ?>
                                    </a>
                                </li><?php $isFirstLi = false; endforeach; ?>
                        </ul>
                    </div> 
                <?php }else { ?> 
                    <ul class="thz-tabs-menu">
                        <?php foreach ( $tabs as $key => $tab ) : ?><li class="<?php echo $isFirstLi ? 'thz-active-tab' : 'thz-inactive-tab'; ?>">
                                <a class="thz-tab-button" href="#thz-tabs-woo-<?php echo esc_attr( $key ); ?>">
                                    <?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', esc_html( $tab['title'] ), $key ); ?>
                                </a>
                            </li><?php $isFirstLi = false; endforeach; ?>
                    </ul>                 
                 <?php } ?>  
                <?php foreach ( $tabs as $key => $tab ) : ?>
                <div id="thz-tabs-woo-<?php echo esc_attr( $key ); ?>" class="thz-tab-content<?php echo $isFirstCo ? ' thz-tabs-active-content' : ' thz-tabs-inactive-content'; ?>">			
                    <?php if( thz_has_builder() && 'woocommerce_product_description_tab' == $tab['callback'] ){ ?>
                        <?php call_user_func( $tab['callback'], $key, $tab ); ?>
                    <?php }else { ?>
                        <?php if( thz_has_builder() ){ ?>
                            <div class="thz-tab-content-inner-container<?php thz_single_cmx('wootabs_mx') ?>">
                                <div class="thz-tab-content-inner">
                                    <?php call_user_func( $tab['callback'], $key, $tab ); ?>
                                </div> 
                            </div> 
                        <?php }else { ?> 
                            <div class="thz-tab-content-inner">
                                <?php call_user_func( $tab['callback'], $key, $tab ); ?>
                            </div>                    
                         <?php } ?>            
                    <?php } ?>
                </div>
                <?php $isFirstCo = false; endforeach; ?>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>