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
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.4.0
 */
get_header( 'shop' );
?>
<div id="<?php thz_set_holder() ?>" class="holders">
	<?php if (thz_show_left_content_right ()): ?>
	<aside id="leftblock" class="thz-block"<?php thz_sdata('sidebar')?>>
		<div class="thz-block-spacer">
			<div class="thz-sidebars">
				<?php thz_load_sidebar('left') ?>
			</div>
		</div>
	</aside>
	<?php endif; ?>
	<main id="contentblock" class="thz-block thz-block-main"<?php thz_sdata('main'); ?>>
		<div class="thz-block-spacer">
			<div class="thz-main-in">
				<?php wc_get_template_part( 'thz-archive','product'); ?>
			</div>
		</div>
	</main>
	<!-- #contentblock -->
	<?php get_sidebar(); ?>
</div>
<!-- .holders -->
<?php get_footer( 'shop' ); ?>