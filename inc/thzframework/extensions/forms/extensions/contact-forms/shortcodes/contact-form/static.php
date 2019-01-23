<?php if (!defined('FW')) die('Forbidden');
/*
	custom css for forms
*/

if (!is_admin()) {
    wp_enqueue_script(
        'fw-form-helpers',
        fw_get_framework_directory_uri('/static/js/fw-form-helpers.js')
    );
    wp_localize_script('fw-form-helpers', 'fwAjaxUrl', admin_url( 'admin-ajax.php', 'relative' ));
}


if(!function_exists('_thz_contact_form_css')){
	
	function _thz_contact_form_css($data) {
		
		$atts 			= _thz_shortcode_options($data,'contact_form');
		
		$id 			= thz_akg('id',$atts);
		$css_id 		= thz_akg('cmx/i',$atts);
		$id_out			= !(empty($css_id )) ? $css_id : 'thz-contact-form-'.$id;
		
		$button 		= thz_akg('b',$atts,null);
		$input_style 	= thz_akg('i',$atts,null);
		$bs 			= thz_print_box_css(thz_akg('bs',$atts,null));
		$sh				= thz_akg('spacings/h',$atts); 
		$sv 			= thz_akg('spacings/v',$atts); 
		
		$add_css 		= '';

		if($sv !=''){
			$add_css .=	'#'.$id_out.'.thz-shortcode-form * + .thz-row,';
			$add_css .=	'#'.$id_out.'.thz-shortcode-form .thz-shortcode-form-button{';
			$add_css .=	'margin-top:'.thz_property_unit($sv,'px').';';
			$add_css .=	'}';			
			
		}
		
		if($sh !=''){
			$add_css .= '#'.$id_out.'.thz-shortcode-form .thz-row{margin-left:-'.thz_property_unit($sh,'px').';}';
			$add_css .= '#'.$id_out.'.thz-shortcode-form .thz-column{padding-left:'.thz_property_unit($sh,'px').';}';
		}
		

		
				
		if(!empty($button)){
			$btn_data = thz_akg('b/0/b',$atts);
			$add_css .= thz_print_button_css($btn_data,'#'.$id_out);
		}
		
		if($bs !=''){
			$add_css .='#'.$id_out.'.thz-shortcode-form.thz-shc{';
			$add_css .= $bs;
			$add_css .= '}';
		}
		
				
		// msg styles
		$msgbs 	 = thz_print_box_css(thz_akg('msgbs',$atts,null));
		$suf	 = thz_typo_css(thz_akg('suf',$atts,null));
		$faf	 = thz_typo_css(thz_akg('faf',$atts,null));

		if($msgbs !=''){
			$add_css .='#'.$id_out.'.thz-shortcode-form .thz-shortcode-form-msg{';
			$add_css .= $msgbs;
			$add_css .= '}';
		}
				
		if($suf !=''){
			
			$add_css .='#'.$id_out.'.thz-shortcode-form .fw-flash-type-success .fw-flash-message{';
			$add_css .= $suf;
			$add_css .= '}';			
			
		}
		
		if($faf !=''){
			
			$add_css .='#'.$id_out.'.thz-shortcode-form .fw-flash-type-error .fw-flash-message{';
			$add_css .= $faf;
			$add_css .= '}';			
			
		}
		
		if(!empty($input_style)){
			
				
				$els ='#'.$id_out.' input:not([type="checkbox"]):not([type="radio"]),';
				$els .='#'.$id_out.' textarea,';
				$els .='#'.$id_out.' select';
				
				
				$classes = explode(',',$els);
				$clean_classes = array_filter($classes);
				$normal_classes = implode(',',$clean_classes);
				
				$hover_classes = preg_replace('/$/', ':hover', $clean_classes);
				$hover_classes = implode(',',$hover_classes);
				
				$focus_classes = preg_replace('/$/', ':focus', $clean_classes);
				$focus_classes = implode(',',$focus_classes);

				$metrics = thz_akg('i/0/bs',$atts,array());
				
				$bgh 		= thz_akg('i/0/thzelch/bg',$atts,null);
				$coh 		= thz_akg('i/0/thzelch/color',$atts,null);
				$bch 		= thz_akg('i/0/thzelch/bcolor',$atts,null);
				
				$bgf 		= thz_akg('i/0/thzelcf/bg',$atts,null);
				$cof 		= thz_akg('i/0/thzelcf/color',$atts,null);
				$bcf 		= thz_akg('i/0/thzelcf/bcolor',$atts,null);	
				
				$if	 		= thz_typo_css(thz_akg('i/0/if',$atts,null));	
				$lf	 		= thz_typo_css(thz_akg('i/0/lf',$atts,null));
				
				
				$elmetrics = thz_print_box_css($metrics);	
				
				
				// label
				if($lf !=''){
					
					$add_css .= '#'.$id_out.' label {';
					$add_css .= $lf;
					$add_css .= '}';
					
				}
				
				// normal	
				if($elmetrics !='' || $if !=''){
					
					$add_css .= $normal_classes.'{';
					
					if($elmetrics !=''){
						$add_css .= $elmetrics;
					}
					
					if($if !=''){
						
						$add_css .= $if;
						
					}
	
					$add_css .= '}';
				}
				
				
				// hover
				if($bgh !='' || $coh !='' || $bch !=''){
					$add_css .= $hover_classes.'{';
					if($bgh !=''){
						$add_css .= 'background:'.$bgh.';';
					}
					if($coh !=''){
						$add_css .= 'color:'.$coh.';';
					}
					if($bch !=''){
						$add_css .= 'border-color:'.$bch.';';
					}
					$add_css .= '}';
				}
				
				// focus
				if($bgf !='' || $cof !='' || $bcf !=''){
					$add_css .= $focus_classes.'{';
					if($bgf !=''){
						$add_css .= 'background:'.$bgf.';';
					}
					if($cof !=''){
						$add_css .= 'color:'.$cof.';';
					}
					if($bcf !=''){
						$add_css .= 'border-color:'.$bcf.';';
					}
					$add_css .= '}';
				}

		}
		
		if($add_css !=''){
			Thz_Doc::set( 'cssinhead', $add_css );
		}		
	}
	if( !thz_is_inline_css_cached() ){
		add_action('fw_ext_shortcodes_enqueue_static:contact_form','_thz_contact_form_css');
	}
}