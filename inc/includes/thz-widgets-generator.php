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
 * Register widget areas.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function _thz_action_widgets_init() {
	// left sidebar
	register_sidebar(array(
		'name' =>  esc_html__('Left Sidebar','creatus'),
		'id' => 'left',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<div class="widget_title_holder"><h3 class="widget-title">',
		'after_title' => '</h3></div>',
	));	
	
   // right sidebar
	register_sidebar(array(
		'name' => esc_html__('Right Sidebar','creatus'),
		'id' => 'right',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<div class="widget_title_holder"><h3 class="widget-title">',
		'after_title' => '</h3></div>',
	));
	
	// lateral header sidebar
	register_sidebar(array(
		'name' => esc_html__('Lateral header sidebar','creatus'),
		'id' => 'lateral-header-sidebar',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<div class="widget_title_holder"><h3 class="widget-title">',
		'after_title' => '</h3></div>',
	));

	// grid widget areas
	$ah_sections 		= thz_get_theme_option_early('above_header_section',null);
	$uh_sections 		= thz_get_theme_option_early('under_header_section',null);
	$footer_sections 	= thz_get_theme_option_early('footer_section',null);
	$top_panel 			= thz_get_theme_option_early('top_panel',null);
	$bottom_panel 		= thz_get_theme_option_early('bottom_panel',null);
	$side_panel 		= thz_get_theme_option_early('side_panel',null);
	
	thz_register_section_widgets('ah',$ah_sections);
	thz_register_section_widgets('uh',$uh_sections);
	thz_register_section_widgets('f',$footer_sections);
	thz_register_section_widgets('tp',$top_panel);
	thz_register_section_widgets('bp',$bottom_panel);
	thz_register_section_widgets('sp',$side_panel);
	
}
add_action( 'widgets_init', '_thz_action_widgets_init' );


/*
* Create widget id and name based on section
*/
function thz_widget_name_id($name,$section_name,$widget,$return='name'){
	
	$widget_sfx			= thz_akg('widget_name',$widget['options']);
	$widget_name  		= $name.'-'.str_replace('ection ','',$section_name).' '.$widget_sfx;
	$widget_id 			= strtolower(str_replace(' ','_',$widget_name));
	
	
	if($name == 'ah'){
		
		$name_full = esc_html__('Above header','creatus');
		
	}elseif($name == 'uh'){
		
		$name_full = esc_html__('Under header','creatus');
	
	}elseif($name == 'f'){
		
		$name_full = esc_html__('Footer','creatus');
		
	}elseif($name == 'tp'){
		
		$name_full = esc_html__('Top panel','creatus');
		
	}elseif($name == 'bp'){
		
		$name_full = esc_html__('Bottom panel','creatus');
		
	}elseif($name == 'sp'){
		
		$name_full = esc_html__('Side panel','creatus');
		
	}
	
	$widget_display_name = $name_full.'-'.$section_name.' '.$widget_sfx;
	
	if($return == 'name'){
		
		return ucfirst($widget_display_name);
		
	}elseif($return == 'id'){
		
		return strtolower($widget_id);
	}
}


/*
* Register all section widget areas
* @internal
*/
function thz_register_section_widgets($name,$option_array){
	
	$section_array  = json_decode(thz_akg('json',$option_array),true);
	
	if(!is_array($section_array)){
		return;
	}
	
	$sections_count  = count($section_array);
	
	if(!$sections_count) {
		return;
	}
	
	foreach ($section_array as $section ){
		
		
		$widgets_count 			= count($section['_items']);
		
		if(!$widgets_count) {
			continue;
		}
		$section_name 		= thz_akg('section_name',$section['options']);
		
		
		foreach ($section['_items'] as $widget){

			register_sidebar(array(
				'name' => thz_widget_name_id($name,$section_name,$widget),
				'id' => thz_widget_name_id($name,$section_name,$widget,'id'),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget' => '</div>',
				'before_title' => '<div class="widget_title_holder"><h3 class="widget-title">',
				'after_title' => '</h3></div>'
			));			
			
			unset($widget);
		}
		
		unset($section);
	}

	
}

/*
* Print widgets section
*/
function thz_widgets_section_print($name,$option_name,$echo = true){
	
	$section_array  = json_decode(thz_get_theme_option($option_name.'/json','none'),true);
	
	if(!is_array($section_array)){
		
		return;
		
	}
	
	$sections_count 	= count($section_array);
	
	if(!$sections_count){
		 return;
	}
	
	$html ='';
	
	foreach ($section_array as $section ){
		
		$widgets_html 		='';
		$widgets_count 		= count($section['_items']);
		$atts				= $section['options'];
		$section_name 		= thz_akg('section_name',$atts);
		$show_empty			= thz_akg('show_empty',$atts,'hide');
		$widgets_html		= thz_section_widget_print($section['_items'],$section_name,$name);
		
		if($widgets_html === -1 && $show_empty =='hide'){
			return;
		}
		
		$widgets_html			= $widgets_html === -1 ? '' : $widgets_html;
		$id 					= thz_akg('id',$atts);
		$css_id 				= thz_akg('cmx/i',$atts);
		$id_out					= !empty($css_id) ? str_replace(' ','',$css_id): 'thz-section-holder-s'.$id;
		$css_class 				= thz_akg('cmx/c',$atts);
		$css_class				= $css_class !='' ? $css_class.' ':'';
		$res_class				= _thz_responsive_classes(thz_akg('cmx',$atts));
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
		$mode					= thz_akg('mode',$atts,'default');
		$op_classes				= !empty($cp_o) ?' thz-parallax-over':'';
		$panel_data				= '';

		if($smootha != 'inactive' && $css_id){
			$stop 				= (int) thz_akg('smootha/p',$atts);
			$duration			= (int) thz_akg('smootha/d',$atts);	
			$op_classes 		.= ' thz-element-anchor';
			$anchordata			= ' data-anchor-'.esc_attr( $smootha ).'="'.esc_attr( $stop ).'" data-anchor-duration="'.esc_attr( $duration ).'"';
		}
		

		$sc_class	= $css_class.'thz-widgets-section thz-section-holder section-'.$s_contained.$contain_section.$animation_class.$scrollfade_class.$cpx_class.$res_class; 
		$cc_class	= ' content-'.$c_contained.$contain_content;
		$cc_datas	= $animation_data.$scrollfade_data.$cp_data.$anchordata.$cpx_data;
		$s_class	= $mode == 'default' ? 'thz-section' : 'thz-section '.$mode;

		
		
		$html .= '<div id="'.esc_attr( $id_out ).'" class="'.thz_sanitize_class( $sc_class ).'"'.thz_sanitize_data($cc_datas).'>';
			$html .='<section class="'.thz_sanitize_class( $s_class ).'">';
				$html .='<div class="thz-section-in">';
				if(!empty($fullheight)) { 
					$html .='<div class="thz-full-height">';
					$html .='<div class="thz-full-height-in '.thz_sanitize_class ( $contentalign ).'">';
				}
				if(!empty($widgets_html)){
					$html .='<div class="thz-container'.thz_sanitize_class ( $cc_class ).'">';
						$html .= '<div class="thz-row">';
						$html .= $widgets_html;
						$html .= '</div>';
					$html .='</div>';
				}
				if(!empty($fullheight)) { 
					$html .='</div>';
					$html .='</div>';
				}
				$html .='</div>';
			$html .= thz_separators_print($separator);
			$html .= thz_background_layers_print($background_layers);
			$html .= thz_video_bg($section_video,false);
			$html .='</section>';
		$html .='</div>';
		
		unset($section); 
		unset($section_array);
			
	}
	
	
	if( '' != $html ){
		
		if($echo){
			
			echo $html;
			
		}else{
			
			return $html;
			
		}
	}

}


/*
* Widget html print
*/
function thz_section_widget_print($section_items,$section_name,$name){
	
	$html 	='';
	$widgets_count 	= count($section_items);
	$active_count 	= 0;
	
	if(!$widgets_count){
		
		return $html;
	}
	
	
	
	foreach ( $section_items as $widget){
		
		$widget_id 			= thz_widget_name_id($name,$section_name,$widget,'id');
		$atts				= $widget['options'];
		$widget_width 		= str_replace('_','-',thz_akg('width',$widget));
		$single_widget		 = '';
		
		if($widgets_count == 1){
			$single_widget		 = ' single_column';	
		}
		if($widget_width == '1-1'){
			$widget_width = '1';	
		}

		$id 				= thz_akg('id',$atts);
		$css_id 			= thz_akg('cmx/i',$atts);
		$id_out				= !empty($css_id) ? str_replace(' ','',$css_id): 'thz-column-c'.$id;
		$css_class 			= thz_akg('cmx/c',$atts);
		$css_class			= $css_class !='' ? $css_class.' ':'';
		$res_class			= _thz_responsive_classes(thz_akg('cmx',$atts));
		$column_video		= thz_akg('bs/background',$atts);
		$animate			= thz_akg('an',$atts);
		$animation_data		= thz_print_animation($animate);
		$animation_class	= thz_print_animation($animate,true);
		$cpx				= thz_akg('cpx',$atts);
		$cpx_data			= thz_print_cpx($cpx);
		$cpx_class			= thz_print_cpx($cpx,true);
		$background_layers	= thz_akg('bl',$atts); 
		$scrollfade_o		= thz_akg('sf',$atts);
		$scrollfade_at		= (int) esc_attr( thz_akg('sf/0/fadeat',$atts));
		$scrollfade_class	= !empty($scrollfade_o) ? ' thz-scroll-fade' : '';
		$whattofade_o		= thz_akg('sf/0/whattofade',$atts); 
		$whattofade			= $whattofade_o == 'content' ? ' data-whattofade=".thz-column-shortcodes"' : '';
		$scrollfade_data	= !empty($scrollfade_o) ? ' data-fadestart="'.$scrollfade_at.'"'.$whattofade.'' : '';
		$fullheight			= thz_akg('fh',$atts);
		$contentalign		= thz_akg('fh/0/contentalign',$atts);
		$smootha 			= thz_akg('smootha/m',$atts);
		$centered 			= thz_akg('centered',$atts);
		$anchordata			= '';
		$flexalign			= ' '.thz_akg('flexalign',$atts,'fstart');
		$op_classes			= $centered == 'center' ? ' thz-col-centered' :'';
		$panel_data			= '';
		
		if($smootha != 'inactive' && $css_id){
			$stop 			= (int) thz_akg('smootha/p',$atts);
			$duration		= (int) thz_akg('smootha/d',$atts);	
			$op_classes 	.= ' thz-element-anchor';
			$anchordata		= ' data-anchor-'.esc_attr( $smootha ).'="'.esc_attr( $stop ).'" data-anchor-duration="'.esc_attr( $duration ).'"';
		}
		
		
		$w_class 	= 'thz-column thz-col-'.$widget_width;
		$class 		= $css_class.$w_class.$single_widget.$animation_class.$flexalign.$op_classes.$cpx_class.$res_class;
		$con_class	= $centered == 'center' ? ' thz-col-'.$widget_width :''; 

		if ( is_active_sidebar( $widget_id ) ) {
			$active_count ++;
			$html .='<div id="'.esc_attr( $id_out ).'" class="'.thz_sanitize_class ( $class ).'"'.thz_sanitize_data($animation_data.$anchordata.$cpx_data).'>';
			$html .='<div class="thz-column-container'.thz_sanitize_class ( $con_class ).'">';
			$html .='<div class="thz-widget-column-in thz-column-in'.$scrollfade_class.'"'.$scrollfade_data.'>';
			if(!empty($fullheight)) { 
				$html .='<div class="thz-full-height">';
				$html .='<div class="thz-full-height-in '.thz_sanitize_class ( $contentalign ).'">';
			}
			$html .='<div class="thz-column-shortcodes">';
				ob_start();
				dynamic_sidebar( $widget_id );
				$html .= ob_get_contents();
				ob_end_clean();
			$html .='</div>';
			
			if(!empty($fullheight)) { 
				$html .='</div>';
				$html .='</div>';
			}
			$html .= thz_video_bg($column_video,false);
			$html .= thz_background_layers_print($background_layers);
			$html .='</div>';
			$html .='</div>';
			$html .='</div>';

		}
		unset($widget);
	}	
	
	
	if($active_count == 0){
		$html = -1;	
	}
	
	return $html;
	
	
}

/*
* Widgets section section CSS
*/
function thz_widgets_section_css($data) {

	$atts 					= thz_akg('options',$data);
	
	$id 					= thz_akg('id',$atts);
	$css_id 				= thz_akg('cmx/i',$atts);
	$id_out					= !empty($css_id) ? str_replace(' ','',$css_id): 'thz-section-holder-s'.$id;
	$add_css 			= '';


	// panels
	if(isset($atts['panel_name'])){
		
		$panel 			= thz_akg('panel_name',$atts); 
		$panel_bg 		= thz_akg('pc/b',$atts); 
		$opener_bg 		= thz_akg('pc/o',$atts); 
		$opener_icon	= thz_akg('pc/i',$atts);
		
		if($panel_bg !=''){
			$add_css .= '.'.$panel.' .thz-panel-content{';
			$add_css .= 'background:'.$panel_bg.';';
			$add_css .= '}';
		}
		
		if($opener_bg !='' || $opener_icon !=''){
			$add_css .= '.'.$panel.' .thz-panel-open {';
			if($opener_bg !=''){
				$add_css .= 'background:'.$opener_bg.';';
			}
			if($opener_icon !=''){
				$add_css .= 'color:'.$opener_icon.';';
			}
			$add_css .= '}';
		}

	}
	
	
	// boxstyle
	$section_box_style			= thz_akg('bs',$atts);
	$section_boxstyle_print		= thz_print_box_css($section_box_style);
	
	if(!empty($section_boxstyle_print)){
		$add_css .= '#'.$id_out.' section {'.$section_boxstyle_print.'}';
		
		$z_index = thz_akg('layout/z-index',$section_box_style);
		
		if($z_index && $z_index !='auto'){
			$add_css .= '#'.$id_out.'{';
			$add_css .=	'z-index:'.(int) $z_index.';';
			$add_css .=	'}';
		}
	}
	
	// spacings
	$con_s 	= thz_akg('spacings/con',$atts); 
	$row_s 	= thz_akg('spacings/row',$atts); 
	$col_s 	= thz_akg('spacings/col',$atts); 
	
	// containers spacings
	if($con_s !=''){
		$add_css .= '#'.$id_out.' section .thz-container{padding-left:'.thz_property_unit($con_s,'px').';padding-right:'.thz_property_unit($con_s,'px').';}';
	}
	
	//rows spacings
	if($row_s !=''){
		$add_css .=	'#'.$id_out.' section * + .thz-row{margin-top:'.thz_property_unit($col_s,'px').';}';		
	}
	
	// columns spacings
	if($col_s !=''){
		$add_css .= '#'.$id_out.' section .thz-row{margin-left:-'.thz_property_unit($col_s,'px').';}';
		if($row_s ==''){
			$add_css .=	'#'.$id_out.' section * + .thz-row{margin-top:'.thz_property_unit($col_s,'px').';}';
		}
		$add_css .= '#'.$id_out.' section .thz-column{padding-left:'.thz_property_unit($col_s,'px').';}';
		$add_css .=	'#'.$id_out.' section .thz-column .widget + .widget{margin-top:'.thz_property_unit($col_s,'px').';}';
		
		$add_css .=	'@media screen and (max-width: 979px) {';
		$add_css .=	'#'.$id_out.' section .thz-column .thz-column  + .thz-column,';
		$add_css .=	'#'.$id_out.' section .thz-column + .thz-column + .thz-column{';
		$add_css .=	'margin-top:'.thz_property_unit($col_s,'px').';';
		$add_css .=	'}';
		$add_css .=	'}';
		
		$add_css .=	'@media screen and (max-width: 767px) {';
		$add_css .=	'#'.$id_out.' section .thz-column + .thz-column{';
		$add_css .=	'margin-top:'.thz_property_unit($col_s,'px').';';
		$add_css .=	'}';
		$add_css .=	'}';
	}


	// vieport height
	$fullheight					= thz_akg('fh',$atts);
	$vpheight					= (int) thz_akg('fh/0/height',$atts);		
	if(!empty($fullheight)){

		$calc 		= thz_full_height_calc(thz_akg('bs/padding',$atts),$vpheight);
		$add_css 	.= '#'.$id_out.' .thz-full-height .thz-full-height-in{height:'.$calc.';}';
	}

	// separator
	$separator	  = thz_akg('se',$atts);
	$add_css .= thz_separators_css($separator,'#'.$id_out.'');
	
	// section font settings
	$section_font_settings = thz_akg('tf',$atts);
	if(!empty($section_font_settings )){
		
		$section_font 				= thz_akg('tf/0/f',$atts);
		$section_headings_font 		= thz_akg('tf/0/h',$atts);
		
		$h1_font 					= thz_typo_css(thz_akg('tf/0/h1',$atts));
		$h2_font 					= thz_typo_css(thz_akg('tf/0/h2',$atts));
		$h3_font 					= thz_typo_css(thz_akg('tf/0/h3',$atts));
		$h4_font 					= thz_typo_css(thz_akg('tf/0/h4',$atts));
		$h5_font  					= thz_typo_css(thz_akg('tf/0/h5',$atts));
		$h6_font  					= thz_typo_css(thz_akg('tf/0/h6',$atts));
		
		
		$section_font_print 		= thz_typo_css($section_font);
		$section_heading_font_print = thz_typo_css($section_headings_font);
		
		
		$add_css .='#'.$id_out.'{'.$section_font_print.'}';
		$add_css .='#'.$id_out.' h1{'.$section_heading_font_print.$h1_font.'}';
		$add_css .='#'.$id_out.' h2{'.$section_heading_font_print.$h2_font.'}';
		$add_css .='#'.$id_out.' h3{'.$section_heading_font_print.$h3_font.'}';
		$add_css .='#'.$id_out.' h4{'.$section_heading_font_print.$h4_font.'}';
		$add_css .='#'.$id_out.' h5{'.$section_heading_font_print.$h5_font.'}';
		$add_css .='#'.$id_out.' h6{'.$section_heading_font_print.$h6_font.'}';
	}
	
	// background layers
	$background_layers			= thz_akg('bl',$atts); 
	if(!empty($background_layers)){
		
		$add_css .= thz_background_layers_css($background_layers);
	}
	
	// widgets css
	$add_css .= _thz_sidebars_css($atts,'#'.$id_out);
	
	// responsive section
	$res 		= thz_akg('res',$atts,array()); 
	
	if(!empty($res)){
		foreach($res as $s_bp){
			
			$at = thz_akg('m/b',$s_bp);
			$re_section_in_bs	= thz_print_box_css(thz_akg('b',$s_bp));
			if(!empty($re_section_in_bs)){
				$res_add_css = '#'.$id_out.' section {'.$re_section_in_bs.'}';
				Thz_Doc::set('responsive', $res_add_css, $at );
			}
			
			unset($s_bp);

		}
		unset($res);
	}
	
	// responsive columns
	$rec 		= thz_akg('rec',$atts,array()); 
	
	if(!empty($rec)){
		foreach($rec as $c_bp){
			
			$at = thz_akg('m/b',$c_bp);
			$w  = thz_akg('m/w',$c_bp,'default');
			$t  = thz_akg('m/t',$c_bp,'default');
			
			$re_column_in_bs	= thz_print_box_css(thz_akg('b',$c_bp));
			
			if(!empty($re_column_in_bs)){
				$re_add_css = '#'.$id_out.'  > section .thz-row .thz-column-in{'.$re_column_in_bs.'}';
				Thz_Doc::set('responsive', $re_add_css, $at );
			}
			
			if('default' != $w ){
				
				$top_space 		= thz_akg('m/s',$c_bp);
				$re_add_css 	= '#'.$id_out.' > section .thz-row > .thz-column,';
				$re_add_css 	.= '#'.$id_out.' > section .thz-row > .thz-col-centered > .thz-column-container{';
				$re_add_css 	.= 'width:'.thz_fra_to_per($w).';';
				$re_add_css 	.= '}';
				
				if($top_space !=''){
					$re_add_css 	.= '#'.$id_out.' > section .thz-row > .thz-column + .thz-column{';
					$re_add_css 	.= 'margin-top:'.thz_property_unit($top_space,'px').';';
					$re_add_css 	.= '}';
				}
				
				Thz_Doc::set('responsive', $re_add_css, $at );
			}

			if('default' != $t ){
				
				$re_add_css  = '#'.$id_out.' > section .thz-row > .thz-column *{';
				$re_add_css .= 'text-align:'.$t.';';
				$re_add_css .= '}';	
				Thz_Doc::set('responsive', $re_add_css, $at );
				
			}
							
			unset($c_bp);

		}
		unset($rec);
	}
	
	
	if(!empty($add_css)){
		return $add_css;
	}

}

/*
* Widget CSS
*/
function thz_section_widget_css ($data) {

	$atts 				= thz_akg('options',$data);
	$id 				= thz_akg('id',$atts);
	$css_id 			= thz_akg('cmx/i',$atts);
	$id_out				= !(empty($css_id)) ? str_replace(' ','',$css_id) : 'thz-column-c'.$id;
	$add_css 			='';

	// colorset
	$column_in_color_set		= thz_akg('tl',$atts);
	
	if(!empty($column_in_color_set)){
		$add_css .= thz_print_colorset(thz_akg('tl/0/c',$atts),'#'.$id_out.' .thz-column-in'); 
	}	

	// boxstyle
	$column_in_boxstyle_print	= thz_print_box_css(thz_akg('bs',$atts));
	
	if(!empty($column_in_boxstyle_print)){
		$add_css .= '#'.$id_out.' .thz-column-in{'.$column_in_boxstyle_print.'}';
	}
	
	
	// vieport height
	$fullheight			= thz_akg('fh',$atts);
	$vpheight			= (int) thz_akg('fh/0/height',$atts);		
	if(!empty($fullheight)){

		$calc 		= thz_full_height_calc(thz_akg('bs/padding',$atts),$vpheight,'column');
		$add_css 	.= '#'.$id_out.' .thz-full-height .thz-full-height-in{height:'.$calc.';}';
	}

	// background layers
	$background_layers	= thz_akg('bl',$atts); 
	if(!empty($background_layers)){
		
		$add_css .= thz_background_layers_css($background_layers);
	}
	
	
	// responsive
	$re 		= thz_akg('re',$atts,array()); 
	if(!empty($re)){
		foreach($re as $breakpoint){
			
			$at = thz_akg('m/b',$breakpoint);
			$w  = thz_akg('m/w',$breakpoint,'default');
			$t  = thz_akg('m/t',$breakpoint,'default');
			
			$re_column_in_bs	= thz_print_box_css(thz_akg('b',$breakpoint));
			
			if(!empty($re_column_in_bs)){
				$re_add_css = '#thz-wrapper #'.$id_out.' .thz-column-in{'.$re_column_in_bs.'}';
				Thz_Doc::set('responsive', $re_add_css, $at );
			}

			if('default' != $w ){
				
				$top_space 		= thz_akg('m/s',$breakpoint);
				$re_add_css 	= '#thz-wrapper #'.$id_out.'.thz-column{';
				$re_add_css 	.= 'width:'.thz_fra_to_per($w).';';
				if($top_space !=''){
					$re_add_css .= 'margin-top:'.thz_property_unit($top_space,'px').';';
				}
				$re_add_css .= '}';
				
				$re_add_css .= '#thz-wrapper #'.$id_out.'.thz-col-centered > .thz-column-container{';
				$re_add_css .= 'width:'.thz_fra_to_per($w).';';
				$re_add_css .= '}';
				
				Thz_Doc::set('responsive', $re_add_css, $at );
			}
			
			if('default' != $t ){
				
				$re_add_css  = '#thz-wrapper #'.$id_out.'.thz-column *{';
				$re_add_css .= 'text-align:'.$t.';';
				$re_add_css .= '}';	
				Thz_Doc::set('responsive', $re_add_css, $at );
				
			}
			
			unset($breakpoint);

		}
		unset($re);
	}

	if(!empty($add_css)){
		
		return $add_css;
	}
}

/*
* Widget generator CSS
* combine section and widget CSS
*/
function thz_widget_generator_css ($name,$option_array){
	
	$section_css 	= array();
	$this_section_css = array();
	$section_array  = json_decode(thz_akg('json',$option_array),true);
	
	if(!is_array($section_array)){
		return;
	}
	
	$sections_count 		= count($section_array);
	
	if(!$sections_count) {
		
		return;
	}
	
	foreach ($section_array as $s => $section ){
		
		
		$section_name 		= thz_akg('section_name',$section['options']);
		$section_css[$s] 	= '';
		
		// section css
		$section_css[$s] 	.= thz_widgets_section_css( $section );
		
		// widget css
		foreach ($section['_items'] as $widget){

			$section_css[$s] 	.= thz_section_widget_css( $widget );
			$widget_id  		= thz_widget_name_id($name,$section_name,$widget,'id');

			unset($widget);
		}

		unset($section);
	}
	unset($section_array);
	
	
	if(!empty($section_css)){
		return implode($section_css);
	}

}

/*
* Get widgets options
*/
function thz_get_widget_options ($sidebar_id) {
	
    global $wp_registered_widgets;
	
    $widget_options = array();
    $sidebars_widgets = wp_get_sidebars_widgets();
	$widget_ids = $sidebars_widgets[$sidebar_id];
    
	if (!$widget_ids) {
        return array();
    }
    foreach ($widget_ids as $id) {
		
        $option_name = $wp_registered_widgets[$id]['callback'][0]->option_name;
        $key = $wp_registered_widgets[$id]['params'][0]['number'];
        $widget_data = get_option($option_name);
        $widget_options[] = (object) $widget_data[$key];
    }
    return $widget_options;
}