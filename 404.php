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
 * The template for displaying 404 pages (not found).
 */
$etype = thz_get_theme_option('etype','theme');

if($etype == 'redirect'){
	
	$epage = thz_get_theme_option('epage',array()); 
	
	if(!empty($epage)){
		$redirect_to_page = get_permalink($epage[0]);
		wp_redirect($redirect_to_page,301);
	}
}
get_header();
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
				<?php get_template_part( 'template-parts/404','section'); ?>
			</div>
		</div>
	</main>
	<!-- #contentblock -->
	<?php get_sidebar(); ?>
</div>
<!-- .holders -->
<?php get_footer(); ?>
