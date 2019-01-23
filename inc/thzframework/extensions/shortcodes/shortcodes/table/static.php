<?php if (!defined('FW')) die('Forbidden');
/*
	custom css for table

*/
if(!function_exists('_thz_table_css')){
	
	function _thz_table_css ($data) {
	
		$atts 				= _thz_shortcode_options($data,'table');
		$id 				= thz_akg('id',$atts);
		$css_id 			= thz_akg('cmx/i',$atts);
		$id_out				= !empty($css_id) ? str_replace(' ','',$css_id): 'thz-table-'.$id;
		$bs					= thz_print_box_css(thz_akg('bs',$atts));
		$type				= thz_akg('table/header_options/table_purpose',$atts);
		$add_css 			= '';
		
		if($bs !=''){
			$add_css .= '#'.$id_out.'.thz-table-container.thz-shc{';
			$add_css .= $bs;
			$add_css .='}';
		}
		
		if($type == 'tabular'){
			
			$table_style 			= thz_akg('table_style/picked',$atts);
			$table_settings 		= thz_akg('table_style/'.$table_style.'/table_settings',$atts);
			$table_bg 				= thz_akg('background',$table_settings);
			$table_grad 			= thz_akg('gradient',$table_settings);
			$table_border 			= thz_akg('border_color',$table_settings);
			$text_color 			= thz_akg('text_color',$table_settings);
			$stripes				= thz_akg('stripes/picked',$atts);
			$stripes_settings		= thz_akg('stripes/show/stripes_settings',$atts);
			$stripes_bg				= thz_akg('background',$stripes_settings);
			$stripes_bg_hovered		= thz_akg('hovered_background',$stripes_settings);
			$stripes_text_color		= thz_akg('text_color',$stripes_settings);
			$stripes_text_hovered	= thz_akg('hovered_text',$stripes_settings);
			$vp						= thz_akg('tr_mx/vp',$atts);
			$hp						= thz_akg('tr_mx/hp',$atts);
			
			
			if($vp !='' || $hp !=''){
				
				$v = $vp !='' ? $vp : 10;
				$h = $hp !='' ? $hp : 10;
				
				$add_css .= '#'.$id_out.' .thz-table > thead > tr > th,';
				$add_css .= '#'.$id_out.' .thz-table > tbody > tr > th,';
				$add_css .= '#'.$id_out.' .thz-table > tfoot > tr > th,';
				$add_css .= '#'.$id_out.' .thz-table > thead > tr > td,';
				$add_css .= '#'.$id_out.' .thz-table > tbody > tr > td,';
				$add_css .= '#'.$id_out.' .thz-table > tfoot > tr > td{';
				$add_css .= 'padding:'.thz_property_unit($v,'px').' '.thz_property_unit($h,'px').';';
				$add_css .= '}';
			}
			
			if($table_style == 'thz-table-bordered'){
				$add_css .= '#'.$id_out.' .thz-table-bordered,';
				$add_css .= '#'.$id_out.' .thz-table-bordered td,';
				$add_css .= '#'.$id_out.' .thz-table-bordered th{';
				$add_css .= 'border-color:'.$table_border.';';
				$add_css .= 'background:'.$table_bg.';';
				if($text_color !=''){
					$add_css .= 'color:'.$text_color.';';
				}
				$add_css .= '}';	
			}
			
			
			if($table_style == 'thz-table-lines'){
				$add_css .= '#'.$id_out.' .thz-table-lines,';
				$add_css .= '#'.$id_out.' .thz-table-lines td,';
				$add_css .= '#'.$id_out.' .thz-table-lines th{';
				$add_css .= 'border-color:'.$table_border.';';
				$add_css .= 'background:'.$table_bg.';';
				if($text_color !=''){
					$add_css .= 'color:'.$text_color.';';
				}
				$add_css .= '}';	
			}
			
			if($stripes == 'show'){
				
				$add_css .= '#'.$id_out.' .thz-table-stripe tr:nth-child(odd) td{';
				$add_css .= 'background-color:'.$stripes_bg.';';
				if($stripes_text_color !=''){
					$add_css .= 'color:'.$stripes_text_color.';';
				}
				$add_css .= '}';
				
				
				$add_css .= '#'.$id_out.' .thz-table-stripe tr:hover td{';
				$add_css .= 'background-color:'.$stripes_bg_hovered.';';
				if($stripes_text_hovered !=''){
					$add_css .= 'color:'.$stripes_text_hovered.';';
				}
				$add_css .= '}';				
				
			}
		}
		if($type == 'pricing'){
				
			$style 				= thz_akg('pricing_style/picked',$atts);
			
			if($style == 'none'){
				return;
			}
			
			
			$misc				= thz_akg('pricing_style/'. $style .'/misc_colors',$atts);
			$switchyes 			= thz_akg('switchyes',$misc);
			$switchno 			= thz_akg('switchno',$misc);
			$descrow 			= thz_akg('descrow',$misc);
			$text_color 		= thz_akg('text_color',$misc);		
		
			if($switchyes !=''){
				$add_css .= '#'.$id_out.' .fa.fa-check{';
				$add_css .= 'color:'.$switchyes.';';
				$add_css .= '}';
			}
			if($switchno !=''){
				$add_css .= '#'.$id_out.' .fa.fa-times{';
				$add_css .= 'color:'.$switchno.';';
				$add_css .= '}';
			}
			
			if($descrow !=''){
				$add_css .= '#'.$id_out.' .desc-col .thz-pricing-rows{';
				$add_css .= 'color:'.$descrow.';';
				$add_css .= '}';
			}		
			
			if($style == 'style1'){
				
				$package	= thz_akg('pricing_style/style1/package',$atts);
				$heading	= thz_akg('pricing_style/style1/heading',$atts);
				$price		= thz_akg('pricing_style/style1/price',$atts);
				
				
				$package_bg 	= thz_akg('background',$package);
				$package_bg2 	= thz_akg('background2',$package);
				$package_grad 	= thz_akg('gradient',$package);
				$package_border = thz_akg('border_color',$package);
				
				
				$heading_bg 	= thz_akg('background',$heading);
				$heading_bg2 	= thz_akg('background2',$heading);
				$heading_grad 	= thz_akg('gradient',$heading);
				$heading_text 	= thz_akg('text_color',$heading);
				$heading_small 	= thz_akg('small_color',$heading);
				
				$price_bg 		= thz_akg('background',$price);
				$price_bg2 		= thz_akg('background2',$price);
				$price_grad 	= thz_akg('gradient',$price);
				$price_text 	= thz_akg('text_color',$price);
					
					
					
				$add_css .= '#'.$id_out.' .thz-pricing-package{';
				$add_css .= 'border-color:'.$package_border.';';
				
				if($package_bg !=='' && $package_bg2 !=''){
					
					$add_css .= thz_bg_gradient($package_bg,$package_bg2,$package_grad);
					
				}else{
					
					$add_css .= 'background:'.$package_bg.';';
				}
				$add_css .= 'color:'.$text_color.';';
				$add_css .= '}';
	
				$add_css .= '#'.$id_out.' .thz-pricing-rows{';
				$add_css .= 'border-color:'.$package_border.';';
				$add_css .= '}';
				
				
				$add_css .= '#'.$id_out.' .thz-pricing-desc-heading-row ,';
				$add_css .= '#'.$id_out.' .thz-pricing-heading {';
				
				if($heading_bg !=='' && $heading_bg2 !=''){
					
					$add_css .= thz_bg_gradient($heading_bg,$heading_bg2,$heading_grad);
					
				}else{
					
					$add_css .= 'background:'.$heading_bg.';';
				}
	
				if($heading_text !=''){
					
					$add_css .= 'color:'.$heading_text.';';
				}
				$add_css .= '}';	
				
				
				$add_css .= '#'.$id_out.' .thz-pricing-desc-pricing-row,';
				$add_css .= '#'.$id_out.' .thz-pricing-price-row {';
				
				if($price_bg !=='' && $price_bg2 !=''){
					
					$add_css .= thz_bg_gradient($price_bg,$price_bg2,$price_grad);
					
				}else{
					
					$add_css .= 'background:'.$price_bg.';';
				}
				
				if($price_text !=''){
					$add_css .= 'color:'.$price_text.';';
				}
				$add_css .= '}';	
				
				$add_css .= '#'.$id_out.' .thz-pricing-price-row small{';
				$add_css .= 'color:'.$heading_small.';';
				$add_css .= '}';	
				
			}
			
			
			if($style == 'style2'){
				
				
				$package		= thz_akg('pricing_style/style2/package',$atts);
				$package_bg 	= thz_akg('background',$package);
				$package_bg2 	= thz_akg('background2',$package);
				$package_grad 	= thz_akg('gradient',$package);
				$package_border = thz_akg('border_color',$package);	
				
				
				$heading		= thz_akg('pricing_style/style2/heading',$atts);
				$heading_bg 	= thz_akg('background',$heading);
				$heading_bg2 	= thz_akg('background2',$heading);
				$heading_grad 	= thz_akg('gradient',$heading);
				$heading_text 	= thz_akg('text_color',$heading);
				
				
				
				
				$price			= thz_akg('pricing_style/style2/price',$atts);
				$price_bg 		= thz_akg('background',$price);
				$price_bg2 		= thz_akg('background2',$price);
				$price_grad 	= thz_akg('gradient',$price);
				$price_border 	= thz_akg('border_color',$price);
				$price_text 	= thz_akg('text_color',$price);
				
				
				
				
				
				$add_css .= '#'.$id_out.' .thz-pricing-package{';
				$add_css .= 'border-color:'.$package_border.';';
				
				if($package_bg !=='' && $package_bg2 !=''){
					
					$add_css .= thz_bg_gradient($package_bg,$package_bg2,$package_grad);
					
				}else{
					
					$add_css .= 'background:'.$package_bg.';';
				}
				$add_css .= 'color:'.$text_color.';';
				$add_css .= '}';
	
				$add_css .= '#'.$id_out.' .thz-pricing-rows{';
				$add_css .= 'border-color:'.$package_border.';';
				$add_css .= '}';
				
				
				
				$add_css .= '#'.$id_out.' .thz-pricing-rows.thz-pricing-desc-heading-row,';
				$add_css .= '#'.$id_out.' .thz-pricing-desc-heading-row ,';
				$add_css .= '#'.$id_out.' .thz-pricing-heading {';
				
				if($heading_bg !=='' && $heading_bg2 !=''){
					
					$add_css .= thz_bg_gradient($heading_bg,$heading_bg2,$heading_grad);
					
				}else{
					
					$add_css .= 'background:'.$heading_bg.';';
				}
	
				if($heading_text !=''){
					
					$add_css .= 'color:'.$heading_text.';';
				}
				$add_css .= '}';
				
				
				
				$add_css .= '#'.$id_out.' .thz-price-holder{';
				
				if($price_bg !=='' && $price_bg2 !=''){
					
					$add_css .= thz_bg_gradient($price_bg,$price_bg2,$price_grad);
					
				}else{
					
					$add_css .= 'background:'.$price_bg.';';
				}
				
				if($price_border !=''){
					$add_css .= 'border-color:'.$price_border.';';
				}
				
				if($price_text !=''){
					$add_css .= 'color:'.$price_text.';';
				}
				
				$add_css .= '}';	
				
						
				
			}
			
			if($style == 'style3'){
				
				
				$package		= thz_akg('pricing_style/style3/package',$atts);
				$package_bg 	= thz_akg('background',$package);
				$package_bg2 	= thz_akg('background2',$package);
				$package_grad 	= thz_akg('gradient',$package);
				$package_border = thz_akg('border_color',$package);	
				
				
				$heading		= thz_akg('pricing_style/style3/heading',$atts);
				$heading_bg 	= thz_akg('background',$heading);
				$heading_bg2 	= thz_akg('background2',$heading);
				$heading_grad 	= thz_akg('gradient',$heading);
				$heading_text 	= thz_akg('text_color',$heading);
				
				
				$h_heading		= thz_akg('pricing_style/style3/highlight_heading',$atts);
				$h_heading_bg 	= thz_akg('background',$h_heading);
				$h_heading_bg2 	= thz_akg('background2',$h_heading);
				$h_heading_grad = thz_akg('gradient',$h_heading);
				$h_heading_text = thz_akg('text_color',$h_heading);
				
				$add_css .= '#'.$id_out.' .thz-pricing-package{';
				if($package_bg !=='' && $package_bg2 !=''){
					
					$add_css .= thz_bg_gradient($package_bg,$package_bg2,$package_grad);
					
				}else{
					
					$add_css .= 'background:'.$package_bg.';';
				}
				$add_css .= 'color:'.$text_color.';';
				$add_css .= '}';
	
				$add_css .= '#'.$id_out.' .thz-pricing-rows{';
				$add_css .= 'border-color:'.$package_border.';';
				$add_css .= '}';	
				
				
				
				$add_css .= '#'.$id_out.' .thz-pricing-heading,';
				$add_css .= '#'.$id_out.' .thz-pricing-price-row{';
				
				if($heading_bg !=='' && $heading_bg2 !=''){
					
					$add_css .= thz_bg_gradient($heading_bg,$heading_bg2,$heading_grad);
					
				}else{
					
					$add_css .= 'background:'.$heading_bg.';';
				}
	
				if($heading_text !=''){
					
					$add_css .= 'color:'.$heading_text.';';
				}
				$add_css .= '}';
				
				
				
				$add_css .= '#'.$id_out.' .highlight-col .thz-pricing-heading,';
				$add_css .= '#'.$id_out.' .highlight-col .thz-pricing-price-row{';
				
				if($h_heading_bg !=='' && $h_heading_bg2 !=''){
					
					$add_css .= thz_bg_gradient($h_heading_bg,$h_heading_bg2,$h_heading_grad);
					
				}else{
					
					$add_css .= 'background:'.$h_heading_bg.';';
				}
	
				if($h_heading_text !=''){
					
					$add_css .= 'color:'.$h_heading_text.';';
				}
				$add_css .= '}';
						
				
			}
		
		}
		if($add_css  !=''){
			Thz_Doc::set( 'cssinhead', $add_css );
		}
	}
	
	if( !thz_is_inline_css_cached() ){
		add_action('fw_ext_shortcodes_enqueue_static:table','_thz_table_css');
	}

}