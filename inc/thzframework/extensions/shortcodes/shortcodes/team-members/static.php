<?php if (!defined('FW')) die('Forbidden');




if(!function_exists('_thz_team_memebers_css')){
	
	function _thz_team_memebers_css ($data) {
	
		$atts 			= _thz_shortcode_options($data,'team_members');
		$id 			= thz_akg('id',$atts);
		$css_id 		= thz_akg('cmx/i',$atts);
		$id_out			= !empty($css_id) ? str_replace(' ','',$css_id): 'thz-team-members-'.$id;
		$layout			= thz_akg('layout',$atts,'grid');
		$med_over_bg    = thz_akg('med_over/background',$atts,array());
		$over_mode		= thz_akg('over_mode',$atts,'thzhover');
		$distance		= thz_akg('distance',$atts,0);
		$columns		= thz_akg('grid/columns',$atts,null);
		$gutter			= thz_akg('grid/gutter',$atts,null);
		
		
		$holder_bs		= thz_print_box_css( thz_akg('holder_bs',$atts,null));
		$in_bs			= thz_print_box_css( thz_akg('in_bs',$atts,null));
		$media_bs		= thz_print_box_css( thz_akg('media_bs',$atts,null));
		$info_bs		= thz_print_box_css( thz_akg('ibs',$atts,null));
		$name_bs		= thz_print_box_css( thz_akg('nbs',$atts,null));
		$job_bs			= thz_print_box_css( thz_akg('jbs',$atts,null));
		$desc_bs		= thz_print_box_css( thz_akg('dbs',$atts,null));
		$soc_bs			= thz_print_box_css( thz_akg('sbs',$atts,null));
		
		$name_f			= thz_typo_css( thz_akg('nf',$atts,null));
		$job_f			= thz_typo_css( thz_akg('jf',$atts,null));
		$desc_f			= thz_typo_css( thz_akg('df',$atts,null));		
		
		$team_member			= thz_akg('post_media',$atts,null);
		
		$add_css		= '';
		$columns_width 	= 33.33;
		if($columns){
			$columns_width 	= $columns == 0 ? 100 :  (100) / $columns ;
		}

		// container
		if(!empty($holder_bs)){
			$add_css .= '#'.$id_out.'.thz-team-members-holder.thz-shc{'.$holder_bs.'}';
		}

		// holder
		if(!empty($in_bs)){
			$add_css .= '#'.$id_out.' .thz-grid-item-in{'.$in_bs.'}';
		}
		
		// media
		if(!empty($media_bs)){
			$add_css .= '#'.$id_out.' .thz-team-member-media{'.$media_bs.'}';
		}	
		
		// info 
		if(!empty($info_bs)){
			$add_css .= '#'.$id_out.' .thz-team-member-info{'.$info_bs.'}';
		}	
		
		// name 
		if(!empty($name_bs) || !empty($name_f)){
			$add_css .= '#'.$id_out.' .thz-team-member-name{';
			if(!empty($name_bs)){
				$add_css .= $name_bs;
			}
			if(!empty($name_f)){
				$add_css .= $name_f;
			}
			$add_css .= '}';
		}
		
		// job 
		if(!empty($job_bs) || !empty($job_f)){
			$add_css .= '#'.$id_out.' .thz-team-member-job{';
			if(!empty($job_bs)){
				$add_css .= $job_bs;
			}
			if(!empty($job_f)){
				$add_css .= $job_f;
			}
			$add_css .= '}';
		}
		
		// description 
		if(!empty($desc_bs) || !empty($desc_f)){
			$add_css .= '#'.$id_out.' .thz-team-member-description{';
			if(!empty($desc_bs)){
				$add_css .= $desc_bs;
			}
			if(!empty($desc_f)){
				$add_css .= $desc_f;
			}
			$add_css .= '}';
		}	
			
		// socials 
		if(!empty($soc_bs)){
			$add_css .= '#'.$id_out.' .thz-team-member-socials{'.$soc_bs.'}';
		}

		if($over_mode =='thzhover' || $over_mode =='infounder'){

			$add_css .='#'.$id_out.' .thz-hover-mask{';
			$add_css .= _thz_media_overlay_background_css_print($med_over_bg).';';
			
			if($distance > 0){
				$add_css .='margin:'.thz_property_unit($distance,'px').';';
			}
			
			$add_css .='}';
			
			
		}else{
			
			$add_css .='#'.$id_out.' .thz-overlay-box{';
			$add_css .= _thz_media_overlay_background_css_print($med_over_bg).';';
			
			if($distance > 0){
				$add_css .='top:'.thz_property_unit($distance,'px').';';
				$add_css .='right:'.thz_property_unit($distance,'px').';';
				$add_css .='bottom:'.thz_property_unit($distance,'px').';';
				$add_css .='left:'.thz_property_unit($distance,'px').';';				
			}
			
			$add_css .='}';
			
			$add_css .='#'.$id_out.' .thz-hover-mask{';
			$add_css .='background:none;';
			$add_css .='}';				
		}
		
		
		if($layout == 'slider'){
			
			$columns = 1;
			$columns_width 	= 100;
			$gutter 	= 0;
			
			/* multiple slides preload calc */
			$slider_show   		= thz_akg('slider/show',$atts,null);
			$slider_space  		= thz_akg('slider/space',$atts,null);
			$slider_vertical	= thz_akg('san/vertical',$atts,null);
			
			if($slider_show > 1){
				
				$add_css .= thz_slick_multiple_css('#'.$id_out, $slider_show, $slider_space, $slider_vertical,'.thz-team-member-item');
	
			}
			
			// navigations
			$nav_ar	  = thz_akg('nav',$atts,null);
			$arr_ar	  = thz_akg('arr',$atts,null);
			$add_css .= _thz_slider_navigations_css($nav_ar,$arr_ar,'#'.$id_out.' > .thz-slick-slider');			
			
		}

		if($layout == 'grid'){
		
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
		}
		
		
		$media_height_picked	= thz_akg('media_height/picked',$atts,'thz-ratio-16-9');
		
		if($media_height_picked =='custom'){
			$media_height = thz_akg('media_height/custom/height',$atts,350);
			$add_css .='#'.$id_out.' .thz-team-member-media,';
			$add_css .='#'.$id_out.' .thz-media-custom-size';
			$add_css .='{height:'.thz_property_unit ($media_height,'px').';}';
			
		}
		
		
		// member socials CSS
		$has_socials			= false;
		$add_soc_cs				= '';
		$c_soc_css				= '';
		
		foreach( $team_member as $member ){
			
			$soc_links			= thz_akg('links',$member,null);
			
			if(empty($soc_links)){
				continue;
			}
			
			$has_socials = true;
			$memberid	 = thz_akg('id',$member,null);
			
			foreach ($soc_links as $link){
				
				$custom_colors 	= thz_akg('ic',$link,false);
				
				if(empty(array_filter($custom_colors))) {
					continue;
				}
				
				$s_pre 		= 'soc-'.$memberid.' .thz-socials-'.$id_out;
				$s_suf 		= 'thz-social-'.esc_attr(str_replace(' ','',strtolower($link['name'])));
				$so_style 	= thz_akg('im/s',$atts,'simple');
				$l  		= thz_akg('l',$custom_colors,false);
				$h  		= thz_akg('h',$custom_colors,false);
				$s  		= thz_akg('s',$custom_colors,false);
				$sh 		= thz_akg('sh',$custom_colors,false);
	
				if( $l || $s){
					$c_soc_css .='.'.$s_pre.' a.'.$s_suf.'{';
					if( $l ){
						$c_soc_css .='color:'.$l.';';
					}
					if($so_style == 'flat' && $s){
						$c_soc_css .='background:'.$s.';';
					}
					if($so_style == 'outline' && $s){
						$c_soc_css .='border-color:'.$s.';';
					}			
					$c_soc_css .='}';
				}
	
				if( $h || $sh ){
					$c_soc_css .= '.'.$s_pre.' a.'.$s_suf.':hover{';
					if( $h ){
						$c_soc_css .='color:'.$h.';';
					}
					if($so_style == 'flat' && $sh){
						$c_soc_css .='background:'.$sh.';';
					}
					if($so_style == 'outline' && $sh){
						$c_soc_css .='border-color:'.$sh.';';
					}	
					$c_soc_css .='}';
				}	
	
			}

		}
		unset($team_member,$soc_links);
		
		if( $has_socials ){
			
			$soc_metrics	= thz_akg('im',$atts,null);
			$soc_space		= thz_akg('im/sp',$atts,20);
			$socials_align	= thz_akg('im/a',$atts,'thz-align-none');
			$soc_class		= 'thz-socials-'.$id_out;
			$socials_css 	= thz_social_links_print($soc_metrics,'ic',$soc_class,true,false,array(0)); 
			
			$add_soc_cs	.= '#'.$id_out.' .'.$soc_class.' .thz-social-links a{';
			if($socials_align =='thz-align-center'){
				$add_soc_cs	.= 'margin: 0 '.thz_property_unit(($soc_space/2),'px').';';
			}elseif($socials_align =='thz-align-left' || $socials_align =='thz-align-none'){
				$add_soc_cs	.= 'margin: 0 '.thz_property_unit($soc_space,'px').' 0 0;';
			}else{
				$add_soc_cs	.= 'margin: 0 0 0 '.thz_property_unit($soc_space,'px').';';
			}
			$add_soc_cs	.= '}';		
			
			$add_soc_cs	.= $socials_css;	
			
			if( !empty($c_soc_css) ){
				$add_soc_cs	.= $c_soc_css;
			}

		}
		
		if($add_soc_cs !=''){
			$add_css	.= $add_soc_cs;
		}
		
		
		if($add_css !=''){
			Thz_Doc::set( 'cssinhead', $add_css );
		}
		
	}
	
	if( !thz_is_inline_css_cached() ){
		add_action('fw_ext_shortcodes_enqueue_static:team_members','_thz_team_memebers_css');
	}
}