<?php if (!defined('FW')) die('Forbidden');


if(!function_exists('_thz_testimonials_css')){
	
	function _thz_testimonials_css ($data) {

		$atts 				= _thz_shortcode_options($data,'testimonials');
		$id 				= thz_akg('id',$atts);
		$css_id 			= thz_akg('cmx/i',$atts);
		$id_out				= !empty($css_id) ? str_replace(' ','',$css_id): 'thz-testimonials-'.$id;
		$slider_show    	= thz_akg('slider/show',$atts,null);
		$slider_space   	= thz_akg('slider/space',$atts,null);
		$slider_vertical	= thz_akg('san/vertical',$atts,null);
		$arrow_show  		= thz_akg('tm/ar',$atts,'show-arrow');
		$info_side	  		= thz_akg('tm/info_side',$atts,'center');
		$quote_style		= thz_akg('tm/style',$atts,'quick');
		
		if( 'quick' == $quote_style ){

			$padding			= thz_akg('tm/padding',$atts,30);
			$bg	   				= thz_akg('tm/bg',$atts,'#ffffff');
			$bo	   				= thz_akg('tm/bo',$atts,'color_4');
			$br	   				= thz_akg('tm/br',$atts,3);
			$bw	   				= thz_akg('tm/bw',$atts,1);
			$bos   				= thz_akg('tm/bs',$atts,'solid');	
					
		}else{
			
			$bw = thz_akg('qbs/borders/top/w',$atts);
		}
		
		$bs					= thz_print_box_css(thz_akg('bs',$atts));
		$tbs				= thz_print_box_css(thz_akg('tbs',$atts));
		$layout_mode  		= thz_akg('layout_mode',$atts,'slider');
		$add_css			='';



		if($layout_mode == 'grid'){

			$columns		= thz_akg('grid/columns',$atts,null);
			$gutter			= thz_akg('grid/gutter',$atts,null);
			$columns_width 	= 33.33;
			if($columns){
				$columns_width 	= $columns == 0 ? 100 :  (100) / $columns ;
			}
				
			$add_css .='#'.$id_out.' .thz-items-grid{';
			$add_css .='margin-left:-'.($columns > 1 ? $gutter : 0).'px;';
			$add_css .='}';
		
			$add_css .='#'.$id_out.' .thz-grid-item{';
			$add_css .='padding-left:'.($columns > 1 ? $gutter : 0).'px;';
			$add_css .='}';	
		
			$add_css .='#'.$id_out.' .thz-grid-item-in{';
			$add_css .='margin-bottom:'.$gutter.'px;';
			$add_css .='}';
			$add_css .='#'.$id_out.' .thz-items-gutter-adjust{';
			$add_css .='margin-bottom:-'.$gutter.'px;';
			$add_css .='}';	
			
			
			$add_css .='#'.$id_out.' .thz-grid-item,#'.$id_out.' .thz-items-sizer {width:'.$columns_width.'%;}';
		
		}else{

			if($slider_show > 1){
				
				$add_css .= thz_slick_multiple_css('#'.$id_out, $slider_show, $slider_space, $slider_vertical );
	
			}
			
			// navigations
			$nav_ar	  = thz_akg('nav',$atts,null);
			$arr_ar	  = thz_akg('arr',$atts,null);
			$add_css .= _thz_slider_navigations_css($nav_ar,$arr_ar,'#'.$id_out.' > .thz-slick-slider');
		}
		
		if($bs !=''){
			$add_css .= '#'.$id_out.'.thz-testimonials-holder.thz-shc{';
			$add_css .= $bs;
			$add_css .='}';
		}
		
		if($tbs !=''){
			$add_css .= '#'.$id_out.' .thz-testimonial{';
			$add_css .= $tbs;
			$add_css .='}';
		}

		$qf		= thz_akg('qf',$atts,null);
		$add_css .='#'.$id_out.' .thz-testimonial-quote{';
		$add_css .= thz_typo_css($qf);
		
		if( 'custom' == $quote_style ){
			
			$qbs = thz_print_box_css(thz_akg('qbs',$atts));
			
			if($qbs !=''){
				$add_css .= $qbs;
			}
			
		}else{
		
			if($bg !=''){
				$add_css .='background:'.$bg.';';
			}
			if($bo !='' && $bw > 0){
				$add_css .='border:'.thz_property_unit($bw,'px').' '.$bos.' '.$bo.';';
			}
			if($br > 0 ){
				$add_css .='border-radius:'.thz_property_unit($br,'px').';';
			}
			$add_css .='padding:'.thz_property_unit($padding,'px').';';
		
		}
		$add_css .='}';	
		
		
		
		if($arrow_show =='show-arrow' && $bw !='' ){
			
			$move = $bw >= 3 ? $bw - 1 : $bw;
			$add_css .='#'.$id_out.' .thz-testimonial-quote:after{';
			$add_css .= 'bottom:-'.(8 + $move).'px;';
			if($info_side =='center'){
				$add_css .='margin-left:-'.(8 + ($bw/2)).'px;';		
			}
			$add_css .='}';				
		}


		$nf		= thz_akg('nf',$atts,null);
		
		if(thz_typo_css($nf)){
			$add_css .='#'.$id_out.' .thz-testimonial-name{';
			$add_css .= thz_typo_css($nf);
			$add_css .='}';	
		}
		
		
		$jf		= thz_akg('jf',$atts,null);
		
		if(thz_typo_css($jf)){
			$add_css .='#'.$id_out.' .thz-testimonial-job{';
			$add_css .= thz_typo_css($jf);
			$add_css .='}';	
		}
		
		$wf		= thz_akg('wf',$atts,null);
		$wfa	= thz_akg('wf/color',$atts,null);
		$wfh	= thz_akg('wf/hovered',$atts,null);
		
		if(thz_typo_css($wf)){
			$add_css .='#'.$id_out.' .thz-testimonial-website{';
			$add_css .= thz_typo_css($wf);
			$add_css .='}';	
		}
		
		if($wfa !=''){
			$add_css .='#'.$id_out.' .thz-testimonial-website a{';
			$add_css .= 'color:'.$wfa.';';
			$add_css .='}';	
		}
		
		if($wfh !=''){
			$add_css .='#'.$id_out.' .thz-testimonial-website a:hover{';
			$add_css .= 'color:'.$wfh.';';
			$add_css .='}';	
		}
			
		if($add_css !=''){
			Thz_Doc::set( 'cssinhead', $add_css );
		}
		
	}
	
	if( !thz_is_inline_css_cached() ){
		add_action('fw_ext_shortcodes_enqueue_static:testimonials','_thz_testimonials_css');
	}
}