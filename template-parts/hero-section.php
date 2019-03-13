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
 * This is a default hero section
 */

$atts 					= thz_get_hero_options();
$id 					= thz_akg('id',$atts); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.OverrideProhibited
$css_id 				= thz_akg('cmx/i',$atts);
$id_out					= !empty($css_id) ? str_replace(' ','',$css_id): 'thz-section-holder-s'.$id;
$css_class 				= thz_akg('cmx/c',$atts);
$css_class				= $css_class !='' ? $css_class.' ':'';
$res_class				= _thz_responsive_classes(thz_akg('cmx',$atts));
$hero_type				= thz_akg('hero_type/picked',$atts,'title');
$s_contained 			= thz_akg('section_contained/picked',$atts);
$c_contained 			= thz_akg('section_contained/notcontained/content_contained',$atts);;
$contain_section		= thz_contained( $s_contained , false);
$contain_content		= thz_contained( $c_contained , false);
$section_video			= thz_akg('bs/background',$atts);
$animate				= thz_akg('an',$atts);
$animation_data			= thz_print_animation($animate);
$animation_class		= thz_print_animation($animate,true);
$cpx					= thz_akg('cpx',$atts);
$cpx_data				= thz_print_cpx($cpx);
$cpx_class				= thz_print_cpx($cpx,true);
$smootha 				= thz_akg('smootha/m',$atts);
$anchordata				= '';
$cp_o					= thz_akg('cp',$atts);
$cp_speed				= (int) esc_attr( thz_akg('cp/0/s',$atts));
$cp_data				= !empty($cp_o) ? ' data-parallaxspeed="'.$cp_speed.'"' : '';
$scrollfade_o			= thz_akg('sf',$atts);
$scrollfade_at			= (int) esc_attr( thz_akg('sf/0/fadeat',$atts));
$scrollfade_class		= !empty($scrollfade_o) ? ' thz-scroll-fade' : '';
$whattofade_o			= thz_akg('sf/0/whattofade',$atts); 
$whattofade				= $whattofade_o == 'content' ? ' data-whattofade=".thz-container"' : '';
$scrollfade_data		= !empty($scrollfade_o) ? ' data-fadestart="'.$scrollfade_at.'"'.$whattofade.'' : '';
$separator 				= thz_akg('se',$atts);
$background_layers		= thz_akg('bl',$atts); 
$fullheight				= thz_akg('fh',$atts);
$contentalign			= thz_akg('fh/0/contentalign',$atts);
$op_classes				= !empty($cp_o) ?' thz-parallax-over':'';

if($smootha != 'inactive' && $css_id){
	$stop 				= (int) thz_akg('smootha/p',$atts);
	$duration			= (int) thz_akg('smootha/d',$atts);	
	$op_classes 		.= ' thz-element-anchor';
	$anchordata			= ' data-anchor-'.esc_attr( $smootha ).'="'.esc_attr( $stop ).'" data-anchor-duration="'.esc_attr( $duration ).'"';
}

$sc_class	= $css_class.'thz-hero-section thz-section-holder section-'.$s_contained.$contain_section.$animation_class.$scrollfade_class.$op_classes.$cpx_class.$res_class; 
$cc_class	= ' content-'.$c_contained.$contain_content;
$cc_datas	= $animation_data.$scrollfade_data.$cp_data.$cpx_data.$anchordata;
$arrow		= ($hero_type =='title' || $hero_type =='editor') ? thz_akg('hero_type/'.$hero_type.'/arrow/s',$atts,'show'):'hide';
?>
<div id="<?php echo esc_attr( $id_out ) ?>" class="<?php echo thz_sanitize_class( $sc_class ) ?>"<?php echo thz_sanitize_data($cc_datas) ?>>
	<section class="thz-section">
		<div class="thz-section-in">
		<?php if(!empty($fullheight)) { ?>
		<div class="thz-full-height">
			<div class="thz-full-height-in <?php echo thz_sanitize_class ( $contentalign ) ?>">
		<?php } ?>
			<div class="thz-container<?php echo thz_sanitize_class ( $cc_class ) ?>">
				<?php 
					if($hero_type =='slider' || $hero_type =='layer' || $hero_type =='rev'){
						
						$slider_id	= thz_akg('hero_type/'.$hero_type.'/id',$atts,'');
						echo thz_hero_section_sliders($hero_type,$slider_id);
						
					}else if($hero_type =='editor'){
						
						$content	= thz_akg('hero_type/editor/e',$atts,'');
						echo do_shortcode( $content );
						
					}else if($hero_type =='title'){
						
						echo thz_hero_section_post_title($atts);
						
					}
				?>
			</div>
		<?php if(!empty($fullheight)) { ?>
			</div>
		</div>
		<?php } ?>
		</div>
	<?php echo thz_separators_print($separator); ?>
	<?php echo thz_background_layers_print($background_layers); ?>
	<?php echo thz_video_bg($section_video,false) ?>
    <?php if( ($hero_type =='title' || $hero_type =='editor')  && 'show' == $arrow ){ ?>
	<a class="thz-section-scroll-arrow thz-animate" href="#thz-main-wrap" data-anim-effect="thz-anim-fadeIn" data-anim-duration="700" data-anim-delay="0">
    	<i class="thz-scroll-fade fa fa-angle-down" data-fadestart="70" ></i>
    </a>
    <?php } ?>
	</section>
</div>