<?php if (!defined('FW')) die('Forbidden');

/*
	custom css for column in

*/

if(!function_exists('_thz_column_in_css')){
	
	function _thz_column_in_css($data) {
	
		$atts 				= _thz_shortcode_options($data,'column');
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
			$add_css .= '#'.$id_out.' > * > .thz-column-in{'.$column_in_boxstyle_print.'}';
		}
		
		// vieport height
		$fullheight			= thz_akg('fh',$atts);
		$vpheight			= (int) thz_akg('fh/0/height',$atts);		
		if(!empty($fullheight)){
	
			$calc 		= thz_full_height_calc(thz_akg('bs/padding',$atts),$vpheight,'column');
			$add_css 	.= '#'.$id_out.' .thz-full-height .thz-full-height-in{height:'.$calc.';}';
		}

		// column font settings
		$column_font_settings = thz_akg('tf',$atts);
		if(!empty($column_font_settings )){
			
			
			$column_font 				= thz_akg('tf/0/f',$atts);
			$column_headings_font 		= thz_akg('tf/0/h',$atts);
			
			$h1_font 					= thz_typo_css(thz_akg('tf/0/h1',$atts));
			$h2_font 					= thz_typo_css(thz_akg('tf/0/h2',$atts));
			$h3_font 					= thz_typo_css(thz_akg('tf/0/h3',$atts));
			$h4_font 					= thz_typo_css(thz_akg('tf/0/h4',$atts));
			$h5_font  					= thz_typo_css(thz_akg('tf/0/h5',$atts));
			$h6_font  					= thz_typo_css(thz_akg('tf/0/h6',$atts));
			
			
			$column_font_print 			= thz_typo_css($column_font);
			$column_heading_font_print 	= thz_typo_css($column_headings_font);
			
			$add_css .='#'.$id_out.'{'.$column_font_print.'}';
			$add_css .='#'.$id_out.' h1{'.$column_heading_font_print.$h1_font.'}';
			$add_css .='#'.$id_out.' h2{'.$column_heading_font_print.$h2_font.'}';
			$add_css .='#'.$id_out.' h3{'.$column_heading_font_print.$h3_font.'}';
			$add_css .='#'.$id_out.' h4{'.$column_heading_font_print.$h4_font.'}';
			$add_css .='#'.$id_out.' h5{'.$column_heading_font_print.$h5_font.'}';
			$add_css .='#'.$id_out.' h6{'.$column_heading_font_print.$h6_font.'}';
	
		}
		
		// background layers
		$background_layers	= thz_akg('bl',$atts); 
		if(!empty($background_layers)){
			
			$add_css .= thz_background_layers_css($background_layers);
		}

		// inner rows spacings
		$row_s 		= thz_akg('spacings/row',$atts,''); 
		if($row_s !=''){
			$add_css .=	'#'.$id_out.' .thz-column-in .thz-column-shortcodes * + .thz-row{margin-top:'.thz_property_unit($row_s,'px').';}';		
		}
				
		// inner column spacings
		$col_s 		= thz_akg('spacings/col',$atts,''); 

		if($col_s !=''){
			$add_css .= '#'.$id_out.' .thz-column-in .thz-column-shortcodes > .thz-row{margin-left:-'.thz_property_unit($col_s,'px').';}';
			if($row_s ==''){
				$add_css .=	'#'.$id_out.' .thz-column-in .thz-column-shortcodes * + .thz-row{margin-top:'.thz_property_unit($col_s,'px').';}';
			}
			$add_css .= '#'.$id_out.' .thz-column-in .thz-column-shortcodes > .thz-row > .thz-column{padding-left:'.thz_property_unit($col_s,'px').';}';
			
			$add_css .=	'@media screen and (max-width: 979px) {';
			$add_css .=	'#'.$id_out.' .thz-column-in .thz-column-shortcodes > .thz-row > .thz-column + .thz-column,';
			$add_css .=	'#'.$id_out.' .thz-column-in .thz-column-shortcodes .thz-row > .thz-column + .thz-column + .thz-column{';
			$add_css .=	'margin-top:'.thz_property_unit($col_s,'px').';';
			$add_css .=	'}';
			$add_css .=	'}';
			
			$add_css .=	'@media screen and (max-width: 767px) {';
			$add_css .=	'#'.$id_out.' .thz-column-in .thz-column-shortcodes > .thz-row > .thz-column + .thz-column{';
			$add_css .=	'margin-top:'.thz_property_unit($col_s,'px').';';
			$add_css .=	'}';
			$add_css .=	'}';
		}
		
		
		//elements spacings
		$col_el 	= thz_akg('spacings/el',$atts,''); 
		if($col_el !=''){
			
			$add_css .=	'#'.$id_out.' .thz-shc + .thz-shc{';
			$add_css .=	'margin-top:'.thz_property_unit($col_el,'px').';';
			$add_css .=	'}';			
		}
		
		// responsive
		$re 		= thz_akg('re',$atts,array()); 
		
		if(!empty($re)){
			foreach($re as $breakpoint){
				
				$at = thz_akg('m/b',$breakpoint);
				$w  = thz_akg('m/w',$breakpoint,'default');
				$t  = thz_akg('m/t',$breakpoint,'default');
				$fnot 	= ':not(#♥)';
				
				$re_column_in_bs	= thz_print_box_css(thz_akg('b',$breakpoint));
				
				if(!empty($re_column_in_bs)){
					$re_add_css = '#thz-wrapper #'.$id_out.$fnot.' > * > .thz-column-in{'.$re_column_in_bs.'}';
					Thz_Doc::set('responsive', $re_add_css, $at );
				}
				
				if('default' != $w ){
					
					$top_space 		= thz_akg('m/s',$breakpoint);
					$re_add_css 	= '#thz-wrapper #'.$id_out.$fnot.'.thz-column{';
					$re_add_css 	.= 'width:'.thz_fra_to_per($w).';';
					if($top_space !=''){
						$re_add_css .= 'margin-top:'.thz_property_unit($top_space,'px').';';
					}
					$re_add_css .= '}';
					
					$re_add_css .= '#thz-wrapper #'.$id_out.$fnot.'.thz-col-centered > .thz-column-container{';
					$re_add_css .= 'width:'.thz_fra_to_per($w).';';
					$re_add_css .= '}';
					
					Thz_Doc::set('responsive', $re_add_css, $at );
				}
				
				if('default' != $t ){
					
					$re_add_css  = '#thz-wrapper #'.$id_out.$fnot.'.thz-column *{';
					$re_add_css .= 'text-align:'.$t.';';
					$re_add_css .= '}';	
					Thz_Doc::set('responsive', $re_add_css, $at );			
					
				}
				
				unset($breakpoint);

			}
			unset($re);
		}
		
	
		if(!empty($add_css)){
			
			Thz_Doc::set( 'cssinhead', $add_css );
		}
	
	
	}
	
	if( !thz_is_inline_css_cached() ){
		add_action('fw_ext_shortcodes_enqueue_static:column','_thz_column_in_css');
	}

}