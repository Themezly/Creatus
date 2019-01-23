<?php if (!defined('FW')) die('Forbidden');

/*
	custom css for section

*/
if(!function_exists('_thz_section_css')){
	
	function _thz_section_css($data) {
	
		$atts 					= _thz_shortcode_options($data,'section');
		$id 					= thz_akg('id',$atts);
		$css_id 				= thz_akg('cmx/i',$atts);
		$id_out					= !empty($css_id) ? str_replace(' ','',$css_id): 'thz-section-holder-s'.$id;
		$add_css 				= '';

		// colorset
		$section_color_set			= thz_akg('tl',$atts);
		if(!empty($section_color_set)){
			$add_css .= thz_print_colorset(thz_akg('tl/0/c',$atts),'#'.$id_out.''); 
		}
	
		// boxstyle
		$section_box_style 	   		= thz_akg('bs',$atts);
		$section_boxstyle_print		= thz_print_box_css(thz_akg('bs',$atts));
		
		if(!empty($section_boxstyle_print)){
			$add_css .= '#'.$id_out.' > section {'.$section_boxstyle_print.'}';
			
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
		$elm_s  = thz_akg('spacings/el',$atts,''); 
		
		
		// containers spacings
		if($con_s !=''){
			$add_css .= '#'.$id_out.' section .thz-container{padding-left:'.thz_property_unit($con_s,'px').';padding-right:'.thz_property_unit($con_s,'px').';}';
		}
		
		//rows spacings
		if($row_s !=''){
			$add_css .=	'#'.$id_out.' section .thz-container > .thz-row  + .thz-row{margin-top:'.thz_property_unit($row_s,'px').';}';			
		}
		
		// columns spacings
		if($col_s !=''){
			$add_css .= '#'.$id_out.' section .thz-container > .thz-row{margin-left:-'.thz_property_unit($col_s,'px').';}';
			if($row_s ==''){
				$add_css .=	'#'.$id_out.' section .thz-container > .thz-row  + .thz-row{margin-top:'.thz_property_unit($col_s,'px').';}';
			}
			$add_css .= '#'.$id_out.' section .thz-container > .thz-row > .thz-column{padding-left:'.thz_property_unit($col_s,'px').';}';
			$add_css .= '#'.$id_out.' section .thz-container > .thz-row > div > .thz-column{padding-left:'.thz_property_unit($col_s,'px').';}';
			
			$add_css .=	'@media screen and (max-width: 979px) {';
			$add_css .=	'#'.$id_out.' section .thz-container > .thz-row > .thz-column .thz-column  + .thz-column,';
			$add_css .=	'#'.$id_out.' section .thz-container > .thz-row > .thz-column + .thz-column + .thz-column{';
			$add_css .=	'margin-top:'.thz_property_unit($col_s,'px').';';
			$add_css .=	'}';
			$add_css .=	'}';
			
			$add_css .=	'@media screen and (max-width: 767px) {';
			$add_css .=	'#'.$id_out.' section .thz-container > .thz-row > .thz-column + .thz-column{';
			$add_css .=	'margin-top:'.thz_property_unit($col_s,'px').';';
			$add_css .=	'}';
			$add_css .=	'}';
		}
		
		//elements spacings
		if($elm_s !=''){
			
			$add_css .=	'#'.$id_out.' .thz-shc + .thz-shc{';
			$add_css .=	'margin-top:'.thz_property_unit($elm_s,'px').';';
			$add_css .=	'}';			
		}
			
		// vieport height
		$fullheight					= thz_akg('fh',$atts);
		$full_page_row				= thz_get_option( 'fpr/0', array() );
		$vpheight					= thz_full_rows() ? 100 : (int) thz_akg('fh/0/height',$atts);		
		
		if( !empty($fullheight) || thz_full_rows() ){

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
				
				$at 	= thz_akg('m/b',$c_bp);
				$w  	= thz_akg('m/w',$c_bp,'default');
				$t  	= thz_akg('m/t',$c_bp,'default');
				$fnot 	= ':not(#♥)';
				
				$re_column_in_bs	= thz_print_box_css(thz_akg('b',$c_bp));
				
				if(!empty($re_column_in_bs)){
					
					if(8888 == $at){
						
						$add_css .= '#'.$id_out.' .thz-column-in{'.$re_column_in_bs.'}';
						
					}else{
						
						$re_add_css = '#'.$id_out.$fnot.' .thz-row .thz-column-in{'.$re_column_in_bs.'}';
						
						Thz_Doc::set('responsive', $re_add_css, $at );
					}
					
				}

				if('default' != $w ){
					
					$top_space 		= thz_akg('m/s',$c_bp);
					$re_add_css 	= '#'.$id_out.$fnot.' .thz-row > .thz-column,';
					$re_add_css 	.= '#'.$id_out.$fnot.' .thz-row > .thz-col-centered > .thz-column-container{';
					$re_add_css 	.= 'width:'.thz_fra_to_per($w).';';
					$re_add_css 	.= '}';
					
					if($top_space !=''){
						$re_add_css 	.= '#'.$id_out.$fnot.' .thz-row > .thz-column + .thz-column{';
						$re_add_css 	.= 'margin-top:'.thz_property_unit($top_space,'px').';';
						$re_add_css 	.= '}';
					}
					
					Thz_Doc::set('responsive', $re_add_css, $at );
				}
				
				if('default' != $t ){
					
					$re_add_css  = '#'.$id_out.$fnot.' .thz-row > .thz-column *{';
					$re_add_css .= 'text-align:'.$t.';';
					$re_add_css .= '}';	
					Thz_Doc::set('responsive', $re_add_css, $at );			
					
				}
				
				unset($c_bp);

			}
			unset($rec);
		}
		
		// add brightness to Thz_Doc
		$brightness	= thz_akg('cmx/b',$atts,'none');
		Thz_Doc::set( 'brightness', $brightness );

		if(!empty($add_css)){
			Thz_Doc::set( 'cssinhead', $add_css );
		}
	
	
	
	}
	
	if( !thz_is_inline_css_cached() ){
		add_action('fw_ext_shortcodes_enqueue_static:section','_thz_section_css');
	}

}