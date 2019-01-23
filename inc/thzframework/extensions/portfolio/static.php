<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}
//thz_theme_file_uri( '/inc/thzframework/
$ext_instance = fw()->extensions->get( 'portfolio' );
$ext = fw_ext('portfolio');
if ( ! is_admin() ) {
	
	
	$settings = $ext_instance->get_settings();
	
	if( is_singular( $settings['post_type'] ) || is_tax( 'fw-portfolio-category' ) || is_tax( 'fw-portfolio-tag' )){
		
		wp_enqueue_style(
			'thz-portfolio',
			$ext->locate_URI ( '/static/css/styles.css'),
			array( THEME_NAME. '-theme' )
		);
		
		thz_enqueue_mediaelement_scripts(true);

	}
	
	if( is_singular( $settings['post_type'] )){
		
		$media_height_picked	= thz_get_post_option('media_height/picked');
		$show_project_related	= thz_get_option('prel_mx/v','show');
		$project_layout		 	= thz_get_option('project_layout/picked','full');
		$side_space		 		= thz_get_option('project_layout/'.$project_layout.'/side_space',50);
		
		$add_css ='';
		
		
		$add_css .='.thz-project div.thz-project-row{';
		$add_css .='margin-left:-'.thz_property_unit($side_space,'px').';';
		$add_css .='}';
		
		$add_css .='.thz-project div.thz-project-row .thz-column.thz-project-column{';
		$add_css .='padding-left:'.thz_property_unit($side_space,'px').';';
		$add_css .='}';
		
		if($media_height_picked =='custom'){
			$media_height = thz_get_post_option('media_height/custom/height',650);
			$add_css .='.thz-grid-item-media,';
			$add_css .='.thz-media-custom-size';
			$add_css .='{height:'.thz_property_unit ($media_height,'px').';}';
		}
		
		// container
		$container_bs 	  = thz_print_box_css( thz_get_option('project_layout/'.$project_layout.'/bs',null));
		
		if(!empty($container_bs)){
			if($project_layout =='full'){
				$add_css .= '.thz-project-info-container{'.$container_bs.'}';
			}else if($project_layout =='sidebar'){
				$add_css .= '.thz-project-container{'.$container_bs.'}';
			}
			
		}
		
		// project media
		$show_project_media   = thz_get_option('ppm/picked',null);
		
		if($show_project_media =='show'){

			$projectmedia_bs 	   = thz_get_option('ppm/show/bs',null);
			$projectmedia_bs_print = thz_print_box_css($projectmedia_bs);
			if(!empty($projectmedia_bs_print)){
				$add_css .= '.thz-project-media{'.$projectmedia_bs_print.'}';
			}

			// icon
			$show_media_icon	= thz_get_option('ppm/show/mi/picked'); 
			
			if($show_media_icon =='show'){
				
				$icon_co 	= thz_get_option('ppm/show/mi/show/icon_metrics/co');
				$icon_bg 	= thz_get_option('ppm/show/mi/show/iconbg_metrics/bg');
				$icon_bs 	= thz_get_option('ppm/show/mi/show/iconbg_metrics/bs');
				$icon_bsi 	= thz_get_option('ppm/show/mi/show/iconbg_metrics/bsi');
				$icon_bc 	= thz_get_option('ppm/show/mi/show/iconbg_metrics/bc');
				$icon_fs 	= thz_get_option('ppm/show/mi/show/icon_metrics/fs',16);
				
				if($icon_co !='' || $icon_bg !='' || ($icon_bsi > 0 && $icon_bc !='')){
					
					$add_css .='.thz-project-media .thz-hover-icon,';
					$add_css .='.thz-project-media  .thz-hover-icon:focus{';
					if($icon_co !=''){
						$add_css .='color:'.esc_attr($icon_co).';';
					}
					if($icon_bg !=''){
						$add_css .='background:'.esc_attr($icon_bg).';';
					}
					if($icon_bsi > 0 && $icon_bc !=''){
						$add_css .='border:'.esc_attr($icon_bsi).'px '.esc_attr($icon_bs).' '.esc_attr($icon_bc).';';
					}
					$add_css .='}';	
					
					
					$add_css .='.thz-project-media .thz-hover-icon span{';
					$add_css .='width:'.thz_property_unit($icon_fs,'px').';';
					$add_css .='height:'.thz_property_unit($icon_fs,'px').';';	
					$add_css .='}';				
					
				}

				
			}
			
			/* multiple slides preload calc */
			$slider_show   = thz_get_option('ppm/show/lay/show',null);
			$slider_space  = thz_get_option('ppm/show/lay/space',null);
			if($slider_show > 1){
				$add_css .= thz_slick_multiple_css('.thz-project-media', $slider_show, $slider_space, 0 );
			}
			
		}
		
		// project title
		$show_project_title   = thz_get_option('ppt/picked');
		
		if($show_project_title =='show'){
			$projectitle_bs 	   	= thz_get_option('ppt/show/bs',null);
			$projectitle_bs_print 	= thz_print_box_css($projectitle_bs);
			$projectitle_font		= thz_get_option('ppt/show/tm',null);
			$projectitle_font		= thz_typo_css($projectitle_font);
			$ptc 					= thz_get_option('ppt/show/c/co',null); 
			$ptch 					= thz_get_option('ppt/show/c/hc',null);
			if(!empty($projectitle_bs_print) || !empty($projectitle_font)){
				$add_css .= '.thz-project-title{';
				if(!empty($projectitle_bs_print) ){
					$add_css .= $projectitle_bs_print;
				}
				if(!empty($projectitle_font) ){
					$add_css .= $projectitle_font;
				}
				$add_css .='}';
			}
			
			if($ptc !=''){
				$add_css .= '.thz-project-title a{';
				$add_css .='color:'.$ptc.';';
				$add_css .='}';
			}
			
			if($ptch !=''){
				$add_css .= '.thz-project-title a:hover{';
				$add_css .='color:'.$ptch.';';
				$add_css .='}';
			}
		}
		
		
		// project content
		$projectcontent_bs 			= thz_get_option('ppcbs',null);
		$projectcontent_bs_print 	= thz_print_box_css($projectcontent_bs);

		if(!empty($projectcontent_bs_print)){
			$add_css .= '.thz-project-content{';
			if(!empty($projectcontent_bs_print) ){
				$add_css .= $projectcontent_bs_print;
			}
			$add_css .='}';
		}
				
		$pc_text	   = thz_get_option('ppcc/text',null);
		$pc_link	   = thz_get_option('ppcc/link',null);
		$pc_linkh	   = thz_get_option('ppcc/linkhovered',null);
		$pc_headings   = thz_get_option('ppcc/headings',null);
		
		if($pc_text !='' || $pc_link !='' || $pc_linkh !='' || $pc_headings !=''){
			
				if( $pc_text !=''){
					
					$add_css .='.thz-project-content{';
					$add_css .='color:'.esc_attr($pc_text).';';
					$add_css .='}';	
					
				}
				
				if( $pc_link !=''){
					
					$add_css .='.thz-project-content a{';
					$add_css .='color:'.esc_attr($pc_link).';';
					$add_css .='}';	
					
				}
				
				if( $pc_linkh !=''){
					
					$add_css .='.thz-project-content a:hover{';
					$add_css .='color:'.esc_attr($pc_linkh).';';
					$add_css .='}';	
					
				}
				
				if( $pc_headings !=''){
					
					$add_css .='.thz-project-content h1,';
					$add_css .='.thz-project-content h2,';
					$add_css .='.thz-project-content h3,';
					$add_css .='.thz-project-content h4,';
					$add_css .='.thz-project-content h5,';
					$add_css .='.thz-project-content h6{';
					$add_css .='color:'.esc_attr($pc_linkh).';';
					$add_css .='}';	
					
				}				
			
		}
		
		// project meta container
		
		$projectmetasc_bs 		= thz_get_option('ppmcbs',null);
		$projectmetas_bs_print = thz_print_box_css($projectmetasc_bs);
		if(!empty($projectmetac_bs_print)){
			$add_css .= '.thz-project-meta-container{'.$projectmetac_bs_print.'}';
		}
		
		// project meta
		
		$projectmeta_bs 		= thz_get_option('ppmbs',null);
		$projectmeta_bs_print 	= thz_print_box_css($projectmeta_bs);
		if(!empty($projectmeta_bs_print)){
			$add_css .= '.thz-project-meta{'.$projectmeta_bs_print.'}';
		}	
		

		// meta label
		$label_metrics 		= thz_get_option('ppmlm',null);
		$label_css			= thz_typo_css($label_metrics);	
		$label_width 		= thz_get_option('ppmlw',null);
		$add_css .= '.thz-project-meta-cell.thz-prmeta-label{';
		$add_css .='width:'.thz_property_unit($label_width,'%').';';
		$add_css .= $label_css;
		$add_css .='}';
		
		// meta font
		$prmeta_metrics 	= thz_get_option('ppmm',null);
		$prmeta_css			= thz_typo_css($prmeta_metrics);
		$prmeta_co			= thz_get_option('ppmc/co','');
		$prmeta_lc			= thz_get_option('ppmc/lc','');
		$prmeta_hc			= thz_get_option('ppmc/hc','');
		
			
		$add_css .= '.thz-project-meta-cell.thz-prmeta-info{';
		$add_css .= $prmeta_css;
		if($prmeta_co !=''){	
			$add_css .='color:'.$prmeta_co.';';	
		}
		$add_css .='}';
		
		if($prmeta_lc !='' || $prmeta_hc !=''){
			if($prmeta_lc !=''){	
				$add_css .='.thz-project-meta-cell.thz-prmeta-info a{';	
				$add_css .='color:'.$prmeta_lc.';';	
				$add_css .='}';	
			}
			
			if($prmeta_hc !=''){	
				$add_css .='.thz-project-meta-cell.thz-prmeta-info a:hover{';	
				$add_css .='color:'.$prmeta_hc.';';	
				$add_css .='}';	
			}
		}
		
		
		// project shares
		$show_project_shares   = thz_get_option('ppps/picked','show');
		
		if($show_project_shares =='show'){
			$postshares_bs 	   	 = thz_get_option('ppps/show/shares_box_style');
			$postshares_bs_print = thz_print_box_css($postshares_bs);
			if(!empty($postshares_bs_print)){
				$add_css .= '.thz-post-shares{'.$postshares_bs_print.'}';
			}

			$add_css .= thz_social_shares_css('ppps/show/im','.thz-project-shares');
			
		}
				
		// project related
		if($show_project_related =='show'){
			$add_css .= _thz_related_static();
		}
		
		// comments
		$add_css .= _thz_post_comments_static();

		// item resets 
		
		$p_reset		= thz_get_option('ppmc/pr','donotreset');	
		$m_reset		= thz_get_option('ppmc/mr','donotreset');	
		$b_reset		= thz_get_option('ppmc/bo','donotreset');	

		if($p_reset !='donotreset'){
			
			$reset_p = explode('_',$p_reset);
			
			$p_item  = $reset_p[0];
			$p_side  = $reset_p[1];
			
			$add_css .= '.thz-project-meta:'.$p_item.'-child{';
			$add_css .= 'padding-'.$p_side.':0px;';
			$add_css .= '}';			
			
		}
		
		if($m_reset !='donotreset'){
			
			$reset_m = explode('_',$m_reset);
			
			$m_item  = $reset_m[0];
			$m_side  = $reset_m[1];
			
			$add_css .= '.thz-project-meta:'.$m_item.'-child{';
			$add_css .= 'margin-'.$m_side.':0px;';
			$add_css .= '}';			
			
		}
		
		if($b_reset !='donotreset'){
			
			$reset_b = explode('_',$b_reset);
			
			$b_item  = $reset_b[0];
			$b_side  = $reset_b[1];
			
			$add_css .= '.thz-project-meta:'.$b_item.'-child{';
			$add_css .= 'border-'.$b_side.'-color:transparent;';
			$add_css .= '}';			
			
		}

		if($add_css  !=''){
			Thz_Doc::set( 'cssinhead', $add_css );
		}
		
	}
	
	if ( is_tax( 'fw-portfolio-category' ) || is_tax( 'fw-portfolio-tag' ) || is_post_type_archive( $settings['post_type'] ) ) {


		$taxonomy 				= $settings['taxonomy_name'];
		$term     	 			= get_queried_object();
		$term_id  	  			= isset($term->term_id) ? get_queried_object_id() : 0;
		$columns				= thz_get_theme_option('pgrid/columns',null);
		$gutter					= esc_attr( thz_get_theme_option('pgrid/gutter',null) );
		$more_button_css		= thz_get_theme_option('projects_pagination/click/more_button/button/css',null);
		$item_more_css			= thz_get_theme_option('project_style/show_button/show/button/css',null); 
		$display_mode			= thz_get_theme_option('project_style/display_mode/picked',null);
		$media_height_picked	= thz_get_theme_option('project_style/media_height/picked',null);
		
		
		$columns_width 	= 33.33;
		$add_css		= '';
		if($columns){
			$columns_width 	= $columns == 0 ? 100 : (100) / $columns;
		}
	
		$media_bs 	   	= thz_get_theme_option('project_style/media_bs');
		$media_bs_print = thz_print_box_css($media_bs);			
		
		if(!empty($media_bs_print)){
			$add_css .='#thz-items-grid-'.$term_id.' .thz-grid-item-media{';
			$add_css .= $media_bs_print;
			$add_css .='}';	
		}
	
		$add_css .='#thz-items-grid-'.$term_id.'.thz-items-grid{';
		$add_css .='margin-left:-'.($columns > 1 ? $gutter : 0).'px;';
		$add_css .='}';
	
		$add_css .='#thz-items-grid-'.$term_id.' .thz-grid-item{';
		$add_css .='padding-left:'.($columns > 1 ? $gutter : 0).'px;';
		$add_css .='}';		
		$add_css .='#thz-items-grid-'.$term_id.' .thz-grid-item-in{';
		$add_css .='margin-bottom:'.$gutter.'px;';
		$add_css .='}';
		$add_css .='#thz-portfolio-'.$term_id.' .thz-items-gutter-adjust{';
		$add_css .='margin-bottom:-'.$gutter.'px;';
		$add_css .='}';
		
		$add_css .='#thz-portfolio-'.$term_id.' .thz-items-sizer{';
		$add_css .='width:'.(100/$columns).'%;';
		$add_css .='}';		
		
		$grid_space = $gutter ;

		if($media_height_picked =='custom'){
			$media_height = thz_get_theme_option('project_style/media_height/custom/height',350);
			$add_css .='#thz-items-grid-'.$term_id.' .thz-grid-item-media,';
			$add_css .='#thz-items-grid-'.$term_id.' .thz-media-custom-size';
			$add_css .='{height:'.thz_property_unit ($media_height,'px').';}';
		}

		if($display_mode == 'reveal' || $display_mode == 'directional'){
			
			$distance	= thz_get_theme_option('project_style/display_mode/'.$display_mode.'/distance',0);
			
			if($distance > 0 && $display_mode == 'reveal'){
				$add_css .='#thz-items-grid-'.$term_id.' .thz-grid-item-intro-holder{';
				$add_css .='top:'.esc_attr($distance).'px;';
				$add_css .='right:'.esc_attr($distance).'px;';
				$add_css .='bottom:'.esc_attr($distance).'px;';
				$add_css .='left:'.esc_attr($distance).'px;';
				$add_css .='}';				
			}
			
			if($distance > 0 && $display_mode == 'directional'){
				$add_css .='#thz-items-grid-'.$term_id.' .thz-grid-item-poz{';
				$add_css .='padding:'.esc_attr($distance).'px;';
				$add_css .='}';				
			}
		}
		
		$add_css .='.thz-portfolio .thz-grid-item,.thz-portfolio .thz-items-sizer {width:'.$columns_width.'%;}';


		$more_btn_data = thz_get_theme_option('projects_pagination/click/more_button/button',array());
		$add_css .= thz_print_button_css($more_btn_data,'#thz-items-more-'.$term_id);

		// item more button css
		$show_button	= thz_get_theme_option('project_style/show_button/picked');
		if('show' == $show_button){
			$button_cbs			= thz_print_box_css(thz_get_theme_option('project_style/show_button/show/cbs'));
			$item_more_btn_data	= thz_get_theme_option('project_style/show_button/show/button',array());
			$add_css .= thz_print_button_css($item_more_btn_data,'#thz-items-grid-'.$term_id);
			
			if(!empty($button_cbs)){
				$add_css .= '#thz-items-grid-'.$term_id.' .thz-grid-item-button{'.$button_cbs.'}';
			}	
		}
		
		// holder
		$holder_box_style 		= thz_get_theme_option('project_style/holder_box_style',null);
		$holder_boxstyle_print	= thz_print_box_css($holder_box_style);
		if(!empty($holder_boxstyle_print)){
			$add_css .= '#thz-items-grid-'.$term_id.' .thz-grid-item .thz-grid-item-in{'.$holder_boxstyle_print.'}';
		}		

		
		// intro box
		$introbox_bs		= thz_get_theme_option('project_style/intro_bs');
		$introbox_bs_print	= thz_print_box_css($introbox_bs);
		if(!empty($introbox_bs_print)){
			$add_css .='#thz-items-grid-'.$term_id.' .thz-grid-item .thz-grid-item-intro{';
			$add_css .= $introbox_bs_print;
			$add_css .='}';	
		}		
		
		// title
		$show_title 			= thz_get_theme_option('project_style/show_title/picked',null);
		
		if($show_title =='show'){
			
			$title_bs		= thz_get_theme_option('project_style/show_title/show/title_bs');
			$title_bs_print	= thz_print_box_css($title_bs);
			$title_font		= thz_get_theme_option('project_style/show_title/show/title_font');
			$title_font		= thz_typo_css($title_font);
			$title_co		= thz_get_theme_option('project_style/show_title/show/title_font/color');
			$title_hc		= thz_get_theme_option('project_style/show_title/show/title_font/hovered');
			
			if(!empty($title_bs_print) || !empty($title_font)){
				$add_css .='#thz-items-grid-'.$term_id.' .thz-grid-item .thz-grid-item-title{';
				if(!empty($title_bs_print)){
					$add_css .= $title_bs_print;
				}
				if(!empty($title_font)){
					$add_css .= $title_font;
				}
				$add_css .='}';	
			}
			
			if($title_co !='' || $title_hc !=''){
				
				if( $title_co !=''){
					$add_css .='#thz-items-grid-'.$term_id.' .thz-grid-item .thz-grid-item-title a{';
					$add_css .='color:'.esc_attr($title_co).';';
					$add_css .='}';	
				}
				
				if( $title_hc !=''){
					$add_css .='#thz-items-grid-'.$term_id.' .thz-grid-item .thz-grid-item-title a:hover{';
					$add_css .='color:'.esc_attr($title_hc).';';
					$add_css .='}';
				}
			}
		}


		// meta
		$meta_bs		= thz_get_theme_option('project_style/meta_bs');
		$meta_bs_print	= thz_print_box_css($meta_bs);
		$meta_font		= thz_get_theme_option('project_style/meta_font');
		$meta_font		= thz_typo_css($meta_font);
		$meta_tc		= thz_get_theme_option('project_style/meta_colors/tc');
		
		$meta_lc		= thz_get_theme_option('project_style/meta_colors/lc');
		$meta_hlc		= thz_get_theme_option('project_style/meta_colors/hlc');	
		$meta_sep		= thz_get_theme_option('project_style/meta_colors/sep');
		
		if( !empty($meta_bs_print) || !empty($meta_font) || $meta_tc !=''){
			$add_css .='#thz-items-grid-'.$term_id.' .thz-grid-item-meta{';
			if(!empty($meta_bs_print)){
				$add_css .= $meta_bs_print;
			}
			if(!empty($meta_font)){
				$add_css .= $meta_font;
			}
			if( $meta_tc !=''){
				$add_css .='color:'.esc_attr($meta_tc).';';
			}
			$add_css .='}';	
		}
					
		if($meta_lc !='' || $meta_hlc !='' || $meta_sep !=''){

			if( $meta_lc !=''){
				$add_css .='#thz-items-grid-'.$term_id.' .thz-grid-item-meta a{';
				$add_css .='color:'.esc_attr($meta_lc).';';
				$add_css .='}';	
			}
			
			if( $meta_hlc !=''){
				
				$add_css .='#thz-items-grid-'.$term_id.' .thz-grid-item-meta a:hover{';
				$add_css .='color:'.esc_attr($meta_hlc).';';
				$add_css .='}';	
				
			}

			if( $meta_sep !=''){
				
				$add_css .='#thz-items-grid-'.$term_id.' .thz-grid-item-meta .thz-meta-separator{';
				$add_css .='color:'.esc_attr($meta_sep).';';
				$add_css .='}';	
				
			}		
	   }	
	   
		// footer
		$footer_bs			= thz_get_theme_option('project_style/footer_bs');
		$footer_bs_print	= thz_print_box_css($footer_bs);
		$footer_font		= thz_get_theme_option('project_style/footer_font');
		$footer_font		= thz_typo_css($footer_font);
		$footer_tc			= thz_get_theme_option('project_style/footer_colors/tc');
		
		
		$footer_lc			= thz_get_theme_option('project_style/footer_colors/lc');
		$footer_hlc			= thz_get_theme_option('project_style/footer_colors/hlc');
		$footer_sep			= thz_get_theme_option('project_style/footer_colors/sep');		
		
		if( !empty($footer_bs_print) || !empty($footer_font) || $footer_tc !=''){
			$add_css .='#thz-items-grid-'.$term_id.' .thz-grid-item-footer{';
			if(!empty($footer_bs_print)){
				$add_css .= $footer_bs_print;
			}
			if(!empty($footer_font)){
				$add_css .= $footer_font;
			}
			if( $footer_tc !=''){
				$add_css .='color:'.esc_attr($footer_tc).';';
			}
			$add_css .='}';	
		}
					
		if($footer_tc !='' || $footer_lc !='' || $footer_hlc !='' || $footer_sep !=''){
			
			
			if( $footer_lc !=''){
				$add_css .='#thz-items-grid-'.$term_id.' .thz-grid-item-footer a{';
				$add_css .='color:'.esc_attr($footer_lc).';';
				$add_css .='}';	
			}
			
			if( $footer_hlc !=''){
				
				$add_css .='#thz-items-grid-'.$term_id.' .thz-grid-item-footer a:hover{';
				$add_css .='color:'.esc_attr($footer_hlc).';';
				$add_css .='}';	
				
			}

			if( $footer_sep !=''){
				
				$add_css .='#thz-items-grid-'.$term_id.' .thz-grid-item-footer .thz-meta-separator{';
				$add_css .='color:'.esc_attr($footer_sep).';';
				$add_css .='}';	
				
			}		
	   }	

		// intro text
		$show_introtext			= thz_get_theme_option('project_style/show_introtext/picked',null); 
		
		if($show_introtext =='show'){
			
			$introtext_bs		= thz_get_theme_option('project_style/show_introtext/show/introtext_bs');
			$introtext_bs_print	= thz_print_box_css($introtext_bs);			
			$introtext_font		= thz_get_theme_option('project_style/show_introtext/show/introtext_font'); 
			$introtext_font		= thz_typo_css($introtext_font);
			
			if(!empty($introtext_bs_print) || !empty($introtext_font)){
				
				$add_css .='#thz-items-grid-'.$term_id.' .thz-grid-item-intro-text{';
				if(!empty($introtext_bs_print)){
					$add_css .= $introtext_bs_print;
				}
				if(!empty($introtext_font)){
					$add_css .= $introtext_font;
				}
				$add_css .='}';	
			}			
		}
		
		// filter
		$show_filter	= thz_get_theme_option('project_style/filter/picked',null);
		
		if($show_filter == 'show'){
			$filter_atts = thz_get_theme_option('project_style/filter/show',null);
			$add_css .= _thz_posts_filter_css_print($filter_atts,'#thz-portfolio-filter-'.$term_id);
		}
	

		// icons
		$show_icons		= thz_get_theme_option('project_style/show_icons/picked',null); 
		if($show_icons =='show'){
			
			$icons_co 	= thz_get_theme_option('project_style/show_icons/show/icons_metrics/co',null);
			$icons_bg 	= thz_get_theme_option('project_style/show_icons/show/iconsbg_metrics/bg',null);
			$icons_bgh 	= thz_get_theme_option('project_style/show_icons/show/iconsbg_metrics/bgh',null);
			$icons_bs 	= thz_get_theme_option('project_style/show_icons/show/iconsbg_metrics/bs',null);
			$icons_bsi 	= thz_get_theme_option('project_style/show_icons/show/iconsbg_metrics/bsi',null);
			$icons_bc 	= thz_get_theme_option('project_style/show_icons/show/iconsbg_metrics/bc',null);
			$icons_fs 	= thz_get_theme_option('project_style/show_icons/show/icons_metrics/fs',16);
			
			if($icons_co !='' || $icons_bg !='' || ($icons_bsi > 0 && $icons_bc !='')){
				
				$add_css .='#thz-items-grid-'.$term_id.' .thz-grid-item-in .thz-hover-icon,';
				$add_css .='#thz-items-grid-'.$term_id.' .thz-grid-item-in .thz-hover-icon:focus{';
				if($icons_co !=''){
					$add_css .='color:'.esc_attr($icons_co).';';
				}
				if($icons_bg !=''){
					$add_css .='background:'.esc_attr($icons_bg).';';
				}
				if($icons_bsi > 0 && $icons_bc !=''){
					$add_css .='border:'.esc_attr($icons_bsi).'px '.esc_attr($icons_bs).' '.esc_attr($icons_bc).';';
				}
				$add_css .='}';	
								
				$add_css .='#thz-items-grid-'.$term_id.' .thz-grid-item-in .thz-hover-icon span{';
				$add_css .='width:'.thz_property_unit($icons_fs,'px').';';
				$add_css .='height:'.thz_property_unit($icons_fs,'px').';';	
				$add_css .='}';					
			}
			
			if( $icons_bgh !=''){
				$add_css .='#thz-items-grid-'.$term_id.' .thz-grid-item-in .thz-hover-icon:hover{';
				$add_css .='background:'.esc_attr($icons_bgh).';';
				$add_css .='}';					
			}
			
		}
		
		// overlay color
		if($display_mode !='directional'){
			
			
			
			$overlay	= thz_get_theme_option('med_over/color');
			if( $overlay !=''){
				$add_css .='#thz-items-grid-'.$term_id.' .thz-hover-mask{';
				$add_css .='background:'.esc_attr($overlay).';';
				$add_css .='}';					
			}			
		}
		
		if($add_css  !=''){
			Thz_Doc::set( 'cssinhead', $add_css );
		}

	}
	
}