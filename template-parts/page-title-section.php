<?php
/**
 * @package      Thz Framework
 * @author       Themezly
 * @websites     http://www.themezly.com | http://www.youjoomla.com | http://www.yjsimplegrid.com
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // No direct access
}

$atts 					= thz_get_option('page_title_options','active');
$id 					= thz_akg('id',$atts);
$id_out					= 'thz-pagetitle-container-'.$id;
$res_class				= _thz_responsive_classes(thz_akg('pre',$atts));
$s_contained 			= thz_akg('section_contained/picked',$atts,'contained');
$c_contained 			= thz_akg('section_contained/notcontained/content_contained',$atts,'contained');
$contain_section		= thz_contained( $s_contained , false);
$contain_content		= thz_contained( $c_contained , false);
$section_video			= thz_akg('section_boxstyle/background',$atts);
$animate				= thz_akg('animate',$atts);
$animation_data			= thz_print_animation($animate);
$animation_class		= thz_print_animation($animate,true);
$overlay				= thz_akg('overlay',$atts);
$background_layers		= thz_akg('background_layers',$atts); 
$page_title_layout 		= thz_get_option('page_title_metrics/layout','table');
$page_title_align 		= thz_get_option('page_title_metrics/align','center');
$pagetitle_classes		= 'thz-pagetitle thz-pagetitle-layout-'.$page_title_layout.' stack-'.$page_title_align;

$sc_class	= 'thz-pagetitle-section section-'.$s_contained.$contain_section.$animation_class.$res_class; 
$cc_class	= 'thz-container content-'.$c_contained.$contain_content;
?>
<div id="<?php echo esc_attr( $id_out ) ?>" class="<?php echo thz_sanitize_class ( $sc_class ) ?>"<?php echo thz_sanitize_data($animation_data) ?>>
	<section>
		<div class="thz-section-in">
			<div class="<?php echo thz_sanitize_class ( $cc_class ) ?>">
				<div class="thz-row">
					<div class="thz-column thz-col-1">
						<div class="<?php echo thz_sanitize_class ( $pagetitle_classes ) ?>">
							<div class="thz-pagetitle-holder">
								<?php thz_print_page_title() ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php echo thz_background_layers_print($background_layers); ?>
		<?php echo thz_video_bg($section_video,false) ?>
	</section>
</div>