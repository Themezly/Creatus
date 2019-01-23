<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

if ( !is_admin() ) {
	
	
	$ext_instance = fw()->extensions->get( 'events' );

	if ( is_singular($ext_instance->get_post_type_name()) ) {
		wp_enqueue_style(
			'fw-extension-'. $ext_instance->get_name() .'-event-style',
			$ext_instance->locate_css_URI( 'event' ),
			array(),
			$ext_instance->manifest->get_version()
		);

		wp_enqueue_script(
			'fw-extension-'. $ext_instance->get_name() .'-event-script',
			$ext_instance->locate_js_URI( 'event' ),
			array( 'jquery'),
			$ext_instance->manifest->get_version(),
			true
		);
		
		$add_css ='';
		
		// event  
		$ev_bs	   		= thz_get_option('ev_bs',null); 
		$ev_bs_print 	= thz_print_box_css($ev_bs);		
		
		if(!empty($ev_bs_print)){
			$add_css .= '.thz-single-event{';
			$add_css .= $ev_bs_print;
			$add_css .= '}';
		}
		
		// event  info 
		$ev_inbs	   	= thz_get_option('ev_inbs',null); 
		$ev_inbs_print 	= thz_print_box_css($ev_inbs);		
		
		if(!empty($ev_inbs_print)){
			$add_css .= '.thz-event-info-in{';
			$add_css .= $ev_inbs_print;
			$add_css .= '}';
		}
		
		// media 
		$ev_med_bs	   			= thz_get_option('ev_med_bs',null); 
		$ev_med_bs_print 		= thz_print_box_css($ev_med_bs);		
		$media_height_picked 	= thz_get_post_option('media_height/picked','thz-ratio-16-9');
		if(!empty($ev_med_bs_print)){
			$add_css .= '.thz-event-media-container{';
			$add_css .= $ev_med_bs_print;
			$add_css .= '}';
		}		
		
			
		if($media_height_picked =='custom'){
			$media_height = thz_get_post_option('media_height/custom/height',350);
			$add_css .='.thz-event-media-container .thz-event-media,';
			$add_css .='.thz-event-media-container .thz-media-custom-size';
			$add_css .='{height:'.thz_property_unit ($media_height,'px').';}';
			
		}
		// headings
		
		
		$ev_hbs = thz_print_box_css(thz_get_option('ev_hbs',null));	
		$ev_hmx = thz_typo_css(thz_get_option('ev_hmx',null));
		
		if(!empty($ev_hbs) || !empty($ev_hmx)){
			$add_css .= '.thz-event-meta-title{';
			if(!empty($ev_hbs)){
				$add_css .= $ev_hbs;
			}
			if(!empty($ev_hmx)){
				$add_css .= $ev_hmx;
			}
			$add_css .= '}';
		}			
		
		
		// title
		$ev_title			 	= thz_get_option('ev_title/picked','show');
		
		if($ev_title =='show'){
			$ev_title_bs	   	 = thz_get_option('ev_title/show/bs',null); 
			$ev_title_bs_print 	 = thz_print_box_css($ev_title_bs);		
	
			$ev_title_font	   	 = thz_get_option('ev_title/show/f',null); 
			$ev_title_font_print = thz_typo_css($ev_title_font);
			
			$ev_title_co		 = thz_get_option('ev_title/show/c/co',''); 
			$ev_title_hc		 = thz_get_option('ev_title/show/c/hc','');
			
			$add_css .= '.thz-event-title{';
			if(!empty($ev_title_bs_print)){
				$add_css .= $ev_title_bs_print;
			}
			if(!empty($ev_title_font_print)){
				$add_css .= $ev_title_font_print;
			}
			$add_css .= '}';
			
			
			if($ev_title_co !='' || $ev_title_hc !=''){
				
				if($ev_title_co !=''){
					$add_css .= '.thz-event-title a{';
					$add_css .= 'color:'.$ev_title_co.';';
					$add_css .= '}';	
				}
				
				if($ev_title_hc !=''){
					$add_css .= '.thz-event-title a:hover{';
					$add_css .= 'color:'.$ev_title_hc.';';
					$add_css .= '}';	
				}	
							
			}
		}
				
		// date & time
		$ev_dt				= thz_get_option('ev_dt/picked','show'); 
		if($ev_dt =='show'){

			$ev_dt_bs	   	 = thz_get_option('ev_dt/show/bs',null); 
			$ev_dt_bs_print  = thz_print_box_css($ev_dt_bs);		
	
			$ev_dt_font	   	 = thz_get_option('ev_dt/show/f',null); 
			$ev_dt_font_print = thz_typo_css($ev_dt_font);
			
					
			$add_css .= '.thz-event-date-time{';
			if(!empty($ev_dt_bs_print)){
				$add_css .= $ev_dt_bs_print;
			}
			if(!empty($ev_dt_font_print)){
				$add_css .= $ev_dt_font_print;
			}
			$add_css .= '}';			
			
		}
		
		// event content
		$eventcontent_bs 		= thz_get_option('ev_cbs',null);
		$eventcontent_bs_print 	= thz_print_box_css($eventcontent_bs);

		if(!empty($eventcontent_bs_print)){
			$add_css .= '.thz-event-content{';
			if(!empty($eventcontent_bs_print)){
				$add_css .= $eventcontent_bs_print;
			}
			$add_css .='}';
		}		
		
		$ecc_text	   = thz_get_option('ev_cc/text','');
		$ecc_link	   = thz_get_option('ev_cc/link','');
		$ecc_linkh	   = thz_get_option('ev_cc/linkhovered','');
		$ecc_headings   = thz_get_option('ev_cc/headings','');
		
		if($ecc_text !='' || $ecc_link !='' || $ecc_linkh !='' || $ecc_headings !=''){
			
				if( $ecc_text !=''){
					
					$add_css .='.thz-event-content{';
					$add_css .='color:'.esc_attr($ecc_text).';';
					$add_css .='}';	
					
				}
				
				if( $ecc_link !=''){
					
					$add_css .='.thz-event-content a{';
					$add_css .='color:'.esc_attr($ecc_link).';';
					$add_css .='}';	
					
				}
				
				if( $ecc_linkh !=''){
					
					$add_css .='.thz-event-content a:hover{';
					$add_css .='color:'.esc_attr($ecc_linkh).';';
					$add_css .='}';	
					
				}
				
				if( $ecc_headings !=''){
					
					$add_css .='.thz-event-content h1,';
					$add_css .='.thz-event-content h2,';
					$add_css .='.thz-event-content h3,';
					$add_css .='.thz-event-content h4,';
					$add_css .='.thz-event-content h5,';
					$add_css .='.thz-event-content h6{';
					$add_css .='color:'.esc_attr($ecc_headings).';';
					$add_css .='}';	
					
				}				
			
		}
		
		
		// event related
		$ev_related			= thz_get_option('erel_mx/v','show');
		if($ev_related =='show'){
			$add_css .= _thz_related_static();
		}
		
		// comments
		$add_css .= _thz_post_comments_static();

		// post shares
		$ev_shares   = thz_get_option('ev_shares/picked','show');

		if($ev_shares =='show'){
			$postshares_bs 	   	 = thz_get_option('ev_shares/show/bs');
			$postshares_bs_print = thz_print_box_css($postshares_bs);
			if(!empty($postshares_bs_print)){
				$add_css .= '.thz-post-shares{'.$postshares_bs_print.'}';
			}
			$add_css .= thz_social_shares_css('ev_shares/show/im','.thz-post-shares');
		
			$show_sharing_label   = thz_get_option('ev_shares/show/sl/picked','show');
			
			if($show_sharing_label =='show'){
				$sl_font   = thz_get_option('ev_shares/show/sl/show/f',null);
				$sl_font   = thz_typo_css($sl_font);
				if($sl_font !='' ){
					$add_css .= '.thz-post-shares .thz-post-share-label{';
					$add_css .= $sl_font;
					$add_css .= '}';
				}
			}
			
		}
		
		
		
		// agenda 
		$ev_agenda			= thz_get_post_option('ev_agenda',null); 
		if (!empty($ev_agenda)){ 
			$ev_ag_bs = thz_get_option('ev_ag_bs',null);
			$ev_ag_bs_print = thz_print_box_css($ev_ag_bs);
			if(!empty($ev_ag_bs_print)){
				$add_css .= '.thz-event-agenda-container{'.$ev_ag_bs_print.'}';
			}	
				
			$ev_agi_bs = thz_get_option('ev_agi_bs',null);
			$ev_agi_bs_print = thz_print_box_css($ev_agi_bs);
			if(!empty($ev_agi_bs_print)){
				$add_css .= 'ul.thz-event-agenda .thz-event-agenda-item{'.$ev_agi_bs_print.'}';
			}
			
			
			// time
			$ev_aitf	   = thz_get_option('ev_aitf',null); 
			$ev_aitf_print = thz_typo_css($ev_aitf);
			
			if(!empty($ev_aitf_print)){		
				$add_css .= '.thz-event-agenda-time{';
				$add_css .= $ev_aitf_print;
				$add_css .= '}';
			}
			
			// title
			$ev_aitif	   	 = thz_get_option('ev_aitif',null); 
			$ev_aitif_print = thz_typo_css($ev_aitif);
			
			if(!empty($ev_aitif_print)){		
				$add_css .= '.thz-event-agenda-title{';
				$add_css .= $ev_aitif_print;
				$add_css .= '}';
			}
			
			// text
			$ev_aitef	   	 = thz_get_option('ev_aitef',null); 
			$ev_aitef_print = thz_typo_css($ev_aitef);
			
			if(!empty($ev_aitef_print)){		
				$add_css .= '.thz-event-agenda-text{';
				$add_css .= $ev_aitef_print;
				$add_css .= '}';
			}			
			
			
			
			$ev_aitec_link	   = thz_get_option('ev_aitec/link','');
			$ev_aitec_linkh	   = thz_get_option('ev_aitec/linkhovered','');
			$ev_aitec_headings = thz_get_option('ev_aitec/headings','');
			
			if($ev_aitec_link !='' || $ev_aitec_linkh !='' || $ev_aitec_headings !=''){
				
					if( $ev_aitec_link !=''){
						
						$add_css .='.thz-event-agenda-text a{';
						$add_css .='color:'.esc_attr($ev_aitec_link).';';
						$add_css .='}';	
						
					}
					
					if( $ev_aitec_linkh !=''){
						
						$add_css .='.thz-event-agenda-text a:hover{';
						$add_css .='color:'.esc_attr($ev_aitec_linkh).';';
						$add_css .='}';	
						
					}
					
					if( $ev_aitec_headings !=''){
						
						$add_css .='.thz-event-agenda-text h1,';
						$add_css .='.thz-event-agenda-text h2,';
						$add_css .='.thz-event-agenda-text h3,';
						$add_css .='.thz-event-agenda-text h4,';
						$add_css .='.thz-event-agenda-text h5,';
						$add_css .='.thz-event-agenda-text h6{';
						$add_css .='color:'.esc_attr($ev_aitec_headings).';';
						$add_css .='}';	
						
					}				
				
			}			
			
			
		}
		
		// sidebar space
		$side_space	= thz_get_option('ev_smx/w',60);
		
		$add_css .='.thz-single-event .thz-event-row{';
		$add_css .='margin-left:-'.thz_property_unit($side_space,'px').';';
		$add_css .='}';
		
		$add_css .='.thz-single-event .thz-event-row .thz-event-column{';
		$add_css .='padding-left:'.thz_property_unit($side_space,'px').';';
		$add_css .='}';		
		
		
		
		// project meta container
		
		$projectmetasc_bs = thz_get_option('ev_mbs',null);
		$projectmetas_bs_print = thz_print_box_css($projectmetasc_bs);
		
		
		
		if(!empty($projectmetas_bs_print)){
			$add_css .= '.thz-event-meta-block{'.$projectmetas_bs_print.'}';
		}
		
		// event meta
		
		$eventmeta_bs = thz_get_option('ev_mibs',null);
		$eventmeta_bs_print = thz_print_box_css($eventmeta_bs);
		if(!empty($eventmeta_bs_print)){

			$add_css .= '.thz-event-meta-block li{'.$eventmeta_bs_print.'}';
		}		
		

		// meta label
		$label_metrics 		= thz_get_option('ev_mlf',null);
		$label_css			= thz_typo_css($label_metrics);	
		$label_width 		= thz_get_option('ev_mlw',null);
		$add_css .= '.thz-event-meta-block li .label{';
		$add_css .='width:'.thz_property_unit($label_width,'%').';';
		$add_css .= $label_css;
		$add_css .='}';
		
		// meta font
		$prmeta_metrics 	= thz_get_option('ev_mf',null);
		$prmeta_css			= thz_typo_css($prmeta_metrics);
		$prmeta_co			= thz_get_option('ev_mfc/co','');
		$prmeta_lc			= thz_get_option('ev_mfc/lc','');
		$prmeta_hc			= thz_get_option('ev_mfc/hc','');
		
		if($prmeta_css !='' || $prmeta_co !=''){
			$add_css .= '.thz-event-meta-block li .detail{';
			
			if($prmeta_css !=''){
				$add_css .= $prmeta_css;
			}
			if($prmeta_co !=''){	
				$add_css .='color:'.$prmeta_co.';';	
			}
			
			$add_css .='}';
		}
		
		if($prmeta_lc !='' || $prmeta_hc !=''){
			if($prmeta_lc !=''){	
				$add_css .='.thz-event-meta-block li .detail a{';	
				$add_css .='color:'.$prmeta_lc.';';	
				$add_css .='}';	
			}
			
			if($prmeta_hc !=''){	
				$add_css .='.thz-event-meta-block li .detail a:hover{';	
				$add_css .='color:'.$prmeta_hc.';';	
				$add_css .='}';	
			}
		}
		
		
		if(	$add_css !=''){
			Thz_Doc::set( 'cssinhead', $add_css );
		}
	
	}

	if (get_post_type() == 'fw-event' && is_archive()) {
		
		$ext_instance = fw()->extensions->get( 'events' );
		
		wp_enqueue_style(
			'fw-extension-'. $ext_instance->get_name() .'-events-cat',
			$ext_instance->locate_css_URI( 'events-cat' ),
			array(),
			$ext_instance->manifest->get_version()
		);
		
		wp_enqueue_script(
			'thz-isotope',
			thz_theme_file_uri(  '/assets/js/isotope.pkgd.min.js' ),
			array( 'jquery',THEME_NAME. '-plugins' ),
			thz_theme_version(),
			true
		);
		
		wp_enqueue_script(
			'thz-imagesloaded',
			thz_theme_file_uri(  '/assets/js/imagesLoaded.js' ),
			array( 'jquery','thz-isotope' ),
			thz_theme_version(),
			true
		);
		
		wp_enqueue_script(
			'thz-masonry',
			thz_theme_file_uri( '/assets/js/thz.masonry.js' ),
			array( 'jquery','thz-isotope',THEME_NAME. '-site' ),
			thz_theme_version(),
			true
		);
		
		wp_localize_script( 'thz-masonry', 'masonryajax', array(
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
			'nonce' => wp_create_nonce( 'thz-masonry' )
		));

		$event_col 				= thz_get_theme_option('ev_grid/columns',2);
		$event_gutter 			= thz_get_theme_option('ev_grid/gutter',30);
		$media_align 			= thz_get_theme_option('ev_ma/picked','left');
		$media_height_picked	= thz_get_theme_option('ev_mh/picked','thz-aspect-16-9');

		$add_css ='';
		
		$add_css .='.thz-events.thz-items-grid{';
		$add_css .='margin-left:-'.($event_col > 1 ? $event_gutter : 0).'px;';
		$add_css .='}';
		
		$add_css .='.thz-events .thz-grid-item{';
		$add_css .='padding-left:'.($event_col > 1 ? $event_gutter : 0).'px;';
		$add_css .='}';	
		
		$add_css .='.thz-events .thz-grid-item-in{';
		$add_css .='margin-bottom:'.$event_gutter.'px;';
		$add_css .='}';	
		
		$add_css .='.thz-events-archive .thz-items-gutter-adjust{';
		$add_css .='margin-bottom:-'.$event_gutter.'px;';
		$add_css .='}';	
		
		$add_css .='.thz-events-archive .thz-items-sizer{';
		$add_css .='width:'.(100/$event_col).'%;';
		$add_css .='}';	
		
		if($media_align !='full'){
			
			$media_width 	= thz_get_theme_option('ev_ma/'.$media_align.'/media_width',40);
			
			
			$add_css .='.thz-events.left .thz-grid-item-media-holder,';
			$add_css .='.thz-events.right .thz-grid-item-media-holder{';
			$add_css .='width:'.thz_property_unit($media_width,'%').';';	
			$add_css .='}';	
			
			
			$add_css .='.thz-events.left .has-post-thumbnail .thz-events-intro,';
			$add_css .='.thz-events.right .has-post-thumbnail .thz-events-intro{';
			$add_css .='margin-'.$media_align.':'.thz_property_unit($media_width,'%').';';	
			$add_css .='}';	
		}
		
		if($media_height_picked =='custom'){
			$media_height = thz_get_theme_option('ev_mh/custom/height',350);
			$add_css .='.thz-events .thz-grid-item-media,';
			$add_css .='.thz-events .thz-media-custom-size{';
			$add_css .='height:'.thz_property_unit ($media_height,'px').';';
			$add_css .='}';	
		}
		
		// holder style
		$holder_bs				= thz_get_theme_option('ev_style/hbs',null); 
		$holder_bs_print = thz_print_box_css($holder_bs);
		if(!empty($holder_bs_print)){
			$add_css .= '.thz-events .thz-grid-item-in{'.$holder_bs_print.'}';
		}
		
		// media holder margin
		$me_bs	   = thz_get_theme_option('ev_style/me_bs',null); 
		$me_bs_print = thz_print_box_css($me_bs);
		if(!empty($me_bs_print)){
			$add_css .= '.thz-events .thz-grid-item-media{'.$me_bs_print.'}';
		}
		
		// intro holder 
		
		$ib_bs	   		= thz_get_theme_option('ev_style/ib_bs',null); 
		$ib_bs_print 	= thz_print_box_css($ib_bs);
		
		if(!empty($ib_bs_print)){
			$add_css .= '.thz-events-intro{';
			$add_css .= $ib_bs_print;
			$add_css .= '}';
		}

		// title
		$ti_bs	   		= thz_get_theme_option('ev_style/ti_bs',null); 
		$ti_bs_print 	= thz_print_box_css($ti_bs);
		$timx	   		= thz_get_theme_option('ev_style/timx',null); 
		$timx_print 	= thz_typo_css($timx);
		$tic_co			= thz_get_theme_option('ev_style/timx/color','');  
		$tic_hc			= thz_get_theme_option('ev_style/timx/hovered',''); 
		
		$add_css .= '.thz-events .thz-grid-item-title{';
		if(!empty($ti_bs_print)){
			$add_css .= $ti_bs_print;
		}
		if(!empty($timx_print)){
			$add_css .= $timx_print;
		}
		$add_css .= '}';
		
		if($tic_co !=''){
			
			$add_css .= '.thz-events .thz-grid-item-title a{';
			$add_css .= 'color:'.$tic_co.';';
			$add_css .= '}';
		}

		if($tic_hc !=''){
			
			$add_css .= '.thz-events .thz-grid-item-title a:hover{';
			$add_css .= 'color:'.$tic_hc.';';
			$add_css .= '}';
		}		
		
		// meta 
		$metm	   		= thz_get_theme_option('ev_style/metm',null); 
		$metm_print 	= thz_print_box_css($metm);
		$metf	   		= thz_get_theme_option('ev_style/metf',null); 
		$metf_print  	= thz_typo_css($metf);		


		$add_css .= '.thz-events .thz-events-meta{';
		if(!empty($metm_print)){
			$add_css .= $metm_print;
		}
		if(!empty($metf_print)){
			$add_css .= $metf_print;
		}
		$add_css .= '}';
		
		// intro text
		$show_introtext			= thz_get_theme_option('ev_style/show_it/picked','show'); 
		if($show_introtext =='show'){
			
			$int_bs	   		= thz_get_theme_option('ev_style/show_it/show/int_bs',null); 
			$int_bs_print 	= thz_print_box_css($int_bs);
			$int_f	   		= thz_get_theme_option('ev_style/show_it/show/int_f',null); 
			$int_f_print 	= thz_typo_css($int_f);
			
			if(!empty($int_bs) || !empty($int_f_print)){
				$add_css .= '.thz-events .thz-events-intro-text{';
				if(!empty($int_bs_print)){
					$add_css .= $int_bs_print;
				}
				if(!empty($int_f_print)){
					$add_css .= $int_f_print;
				}
				$add_css .= '}';
			}
		}
		
		// button
		$show_button	= thz_get_theme_option('ev_style/show_button/picked');
		if('show' == $show_button){
			$button_cbs	= thz_print_box_css(thz_get_theme_option('ev_style/show_button/show/cbs'));
			$btn_data = thz_get_theme_option('ev_style/show_button/show/button',array());
			$add_css .= thz_print_button_css($btn_data,'.thz-events');
			
			if(!empty($button_cbs)){
				$add_css .= '.thz-events .thz-grid-item-button{'.$button_cbs.'}';
			}
		}
		
		if(	$add_css !=''){
			Thz_Doc::set( 'cssinhead', $add_css );
		}	
	}
	
}