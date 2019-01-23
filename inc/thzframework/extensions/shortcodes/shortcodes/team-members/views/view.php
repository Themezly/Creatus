<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$id 				= thz_akg('id',$atts);
$css_id 			= thz_akg('cmx/i',$atts);
$id_out				= !empty($css_id) ? str_replace(' ','',$css_id): 'thz-team-members-'.$id;
$css_class 			= thz_akg('cmx/c',$atts);
$css_class			= $css_class !='' ? $css_class.' ':'';
$res_class			= _thz_responsive_classes(thz_akg('cmx',$atts));
$layout				= thz_akg('layout',$atts,'grid');
$team_members		= thz_akg('post_media',$atts,null);
$media_height		= thz_akg('media_height/picked',$atts,'thz-ratio-16-9'); 
$mfp_classes		= ' '.thz_lightbox_classes();
$over_mode			= thz_akg('over_mode',$atts,'thzhover');
$mode_class			= ' thz-media-mode-'.$over_mode;
$hover_bgtype		= thz_akg('med_over/background/type',$atts,'solid');
$hover_ef 			= thz_akg('med_over/oeffect',$atts,'thz-hover-fadein');
$hover_tr 			= thz_akg('med_over/oduration',$atts,'thz-transease-04');
$img_ef				= thz_akg('med_over/ieffect',$atts,'thz-img-zoomin');
$img_tr 			= thz_akg('med_over/iduration',$atts,'thz-transease-04');
$grayscale			= thz_akg('grayscale',$atts,'none');
$grayscale			= $grayscale !='none' ? ' '.$grayscale :'';
$media_size			= thz_akg('media_size',$atts,'thz-img-medium'); 
$info_align			= thz_akg('info_align',$atts,'middle'); 
$icons_ef 			= thz_akg('med_over/iceffect',$atts,'thz-comein-bottom');
$icons_tr 			= thz_akg('med_over/icduration',$atts,'thz-transease-05');
$iconef_classes 	= ' '.$icons_ef.' '.$icons_tr;
$hover_classes 		= 'thz-hover-bg-'.$hover_bgtype.' '.$hover_ef.' '.$img_ef.' '.$img_tr.$grayscale;
$socials_align		= thz_akg('im/a',$atts,'thz-align-none');
$cpx				= thz_akg('cpx',$atts);
$cpx_data			= thz_print_cpx($cpx);
$cpx_class			= thz_print_cpx($cpx,true);
$mpx				= thz_akg('mpx',$atts);
$mpx_print			= thz_print_mpx($mpx);
$mpx_specific		= thz_akg('mpx/s',$atts);
$mpx_specific 		= $mpx_specific !='' ? explode(',',$mpx_specific) : false;

if($media_height == 'custom' || $media_height == 'metro'){
	
	$ratio_class 	= ' thz-media-custom-size';
	$img_ratio		= ' thz-media-custom-size';
	$img_mask		= ' thz-hover-img-mask';
	
}else{
	$ratio_class 	= ' thz-aspect '.$media_height;
	$img_ratio		= ' thz-aspect '.$media_height;
	$img_mask		= ' thz-hover-img-mask';
}

if('slider' == $layout){
	

	$slider_layout 	 	 		= thz_akg('slider',$atts,null);
	$slider_animation 	 		= thz_akg('san',$atts,null);
	$slider_layout['dots'] 		= thz_akg('nav/show',$atts,'outside');
	$slider_layout['arrows'] 	= thz_akg('arr/show',$atts,'hide');
	$slider_breakpoints			= thz_akg('slbp',$atts,false);
	$slick_data 		 		= thz_slick_data($slider_layout,$slider_animation,$slider_breakpoints);
	$slidesToShow		 		= thz_akg('show',$slider_layout,1);
	$dstyle						= thz_akg('nav/style',$atts,'rings');
	$dshadows					= thz_akg('nav/shadows',$atts,'active');
	$dopacities					= thz_akg('nav/opacities',$atts,'active');
	$dstyle						= $dstyle.' dsh-'.$dshadows.' dop-'.$dopacities.' ';
	$dpoz						= thz_akg('nav/p',$atts,'bc');	
	$dots_p						= $dpoz == 'c' ? ' dots-'.thz_akg('nav/o',$atts,'h') : ' dots-'.$dpoz;
	$show_filter		 		= false;
	$multiple			 		= '';
	$mediacount 		 		= count($team_members);
	$activate_slider 	 		= ' thz-slick-inactive';
	
	if( $mediacount > 1 ){
		$activate_slider = ' thz-slick-active thz-slick-initiating thz-slick-'.$dstyle.$dots_p;
		$multiple	= $slidesToShow > 1 ? ' thz-slick-show-multiple' :'';	
	}
	
	$grid_holder_classes 	= $css_class.'thz-shc thz-team-members-holder thz-info-'.$info_align.' thz-slick-holder'.$multiple.$mfp_classes.$mode_class.$cpx_class.$res_class;
	$grid_classes			= 'thz-slick-slider'.$activate_slider;
	
	$column_classes 		= 'thz-slick-slide thz-team-member-item';
	$column_in_classes 		= 'thz-slick-slide-in thz-media-item';
	$animate_data			= '';
	
	$grid_data 			 	= $slick_data;
	
}else{
	
	
	$columns 				= thz_akg('grid/columns',$atts,3);
	$gutter					= thz_akg('grid/gutter',$atts,null);
	$animate				= thz_akg('animate',$atts);
	$animate_data			= thz_print_animation($animate);
	$animation_class		= thz_print_animation($animate,true,'thz-isotope-animate');
	$animate_parent			= $animation_class != '' ? ' thz-animate-parent ' :'';	
	
	$data_layout			= $media_height == 'auto' ? 'masonry' : $media_height;
	$no_response 			= $columns < 3 ? ' thz-grid-noresponse' :'';
	$gutter_class			= $gutter == 0 ? ' thz-items-grid-nogutter' : '';
	$grid_holder_classes 	= $css_class.'thz-shc thz-team-members-holder thz-info-'.$info_align.' thz-items-grid-holder thz-grid-has-col-'.$columns.$cpx_class;
	$grid_holder_classes 	.= ' thz-media-grid-isotope thz-is-isotope '.$mode_class.$gutter_class.$res_class;
	$grid_classes 			= 'thz-items-grid thz-team-members-grid'.$no_response.$mfp_classes;
	$column_classes 		= 'thz-grid-item'.$animate_parent;
	$column_in_classes 		= 'thz-grid-item-in thz-media-item'.$animation_class;
	$grid_data 				= ' data-isotope-mode="packery" data-layout-type="'.esc_attr( $data_layout ).'" data-display-mode="'.esc_attr( $over_mode ).'"';
	
	if($media_height !='metro'){
		$minwidth			= thz_akg('grid/minwidth',$atts,200);
		$grid_data 			.= ' data-minwidth="'.esc_attr($minwidth + $gutter ).'"';
	}

}
	
?>
<div id="<?php echo esc_attr($id_out) ?>" class="<?php echo thz_sanitize_class ( $grid_holder_classes ) ?>"<?php echo thz_sanitize_data($cpx_data)?>>
  <?php if ( !empty($team_members) ){ ?>
  <div id="<?php echo esc_attr($id_out) ?>-inner" class="<?php echo thz_sanitize_class ( $grid_classes ) ?>"<?php echo thz_sanitize_data($grid_data)?>>
      <?php if('grid' == $layout) {?>
      <div class="thz-items-sizer"></div>
      <?php } ?>
      <?php foreach($team_members as $memberkey => $member ) :

          $source 		= thz_akg('image',$member);
          $mediaid 		= thz_akg('mediaid',$member); 
          $qtitle 		= thz_akg('qtitle',$member,null);
          $memberid		= thz_akg('id',$member,null);
          $soc_links	= thz_akg('links',$member,null);
          $soc_metrics	= thz_akg('im',$atts,null);
		  $soc_class	= 'thz-socials-'.$id_out;		
          $name			= thz_akg('name',$member,null);
          $job			= thz_akg('job',$member,null);
          $desc			= thz_akg('desc',$member,null);	
		  $click		= thz_akg('click',$member,'none');
		  $link			= thz_akg('link',$member,null);
		  $link_output	= null;		
          $metroitem 	= '';
          $member_info 	= '';
		  $print_mpx 		= ($mpx_specific && !in_array($memberkey + 1, $mpx_specific ) || $media_height == 'auto') ? false : $mpx_print ;
		  $has_media_cpx	= $print_mpx ? ' has-media-cpx' :'';

		  
		if($click !='none'){
			
			if($click =='lightbox'){
				
				$link_output ='<a class="thz-hover-link thz-lightbox mfp-image" href="#" '.thz_lightbox_data().'';
				$link_output .=' data-mfp-src="'.esc_url( $source['url'] ).'" data-mfp-title="'.esc_attr( $name ).'">';
				$link_output .='</a>';
			}
		
			if($click =='link' && $link){
				$link_output ='<a ';
				if($link['type'] == 'normal'){
					
					$link_output .='class="thz-hover-link" href="'.esc_url( $link['url'] ).'" target="'.esc_attr($link['target']).'">';
					
				}else{
					
					$link_output .='class="thz-hover-link thz-trigger-lightbox" href="'.esc_url($link['magnific']).'">';
				}
				$link_output .='</a>';
			}
			
		}
 
		  
          if($name || $job || !empty($soc_links) || $desc){
              $member_info .='<div class="thz-team-member-info-holder">';
			  
			  if($link_output && $over_mode == 'reveal'){
				  
				  $reveal_effect 	= thz_akg('reveal_effect/effect',$atts,'thz-reveal-goleft'); 
				  
				  if($reveal_effect == 'thz-reveal-none'){
					  $member_info .= $link_output;
					  $link_output = false;
				  }
			  }
			  
              $member_info .='<div class="thz-team-member-info">';
              if($name){
                  $member_info .='<h3 class="thz-tm-el thz-team-member-name">'.esc_attr($name).'</h3>';
              }
              if($job){
                  $member_info .='<div class="thz-tm-el thz-team-member-job">'.esc_attr($job).'</div>';
              }
              if($desc){
                  $member_info .='<div class="thz-tm-el thz-team-member-description">';
                  $member_info .= esc_html($desc);
                  $member_info .='</div>';
              }
              if(!empty($soc_links)){
                  $member_info .='<div class="soc-'.$memberid.' thz-tm-el thz-team-member-socials '.thz_sanitize_class($socials_align).'">';
                  $member_info .= thz_social_links_print($soc_metrics,'ic',$soc_class,false,false,$soc_links);
                  $member_info .='</div>';
              }
              $member_info .='</div>';
			  
			  if( $link_output && ( $over_mode == 'thzhover' || $over_mode == 'directional' ) ){
				  
				  $member_info .= $link_output;
			  }
			  
              $member_info .='</div>';
          }
		  

          
          // metro
          if( $media_height == 'metro' ){
              
			$sequence_type = thz_akg('media_height/metro/sequence',$atts,1);
			
			$sequence = thz_metro_sequence_maker($sequence_type);
			
			foreach ($sequence['items'] as $key => $size){
			
				if($memberkey % $sequence['count'] == $key){
				  
				  $metroitem = ' thz-item-metro-'. $size ;
				}
				
				unset($key,$size);
			}
			unset($sequence);
          
          }	
                  
		  $style 		= thz_print_img_style( $source, $media_size );
          $info_under 	= null;
		  
          if($over_mode == 'infounder'){

              $info_under .= $member_info;
          }
          $hover_out = 'thz-hover'.$img_mask.' '.$hover_classes.$has_media_cpx;

      ?>
      <div class="<?php echo thz_sanitize_class( $column_classes.$metroitem ); ?>" data-type="image">
          <div class="<?php echo thz_sanitize_class ( $column_in_classes ) ?>"<?php echo thz_sanitize_data($animate_data) ?>>
              <div class="thz-team-member-media">
                  <div class="thz-media-item-ratio<?php echo thz_sanitize_class($img_ratio) ?>">
                      <div class="thz-ratio-in">
                          <div class="<?php echo thz_sanitize_class($hover_out) ?>"<?php echo thz_sanitize_data($style) ?>>																					 							<?php 
							  
							  if($print_mpx){
							  	echo $print_mpx;
							  }
							  
							  if( $link_output && ( $over_mode == 'infounder' || $over_mode == 'reveal' ) ){
					
								  echo $link_output;
							  }
							  
							  if($over_mode == 'reveal' || $over_mode == 'directional'){
								  
								  $overlay_box ='';
								  
								  if($over_mode == 'reveal'){
									  
									  $reveal_effect 	= thz_akg('reveal_effect/effect',$atts,'thz-reveal-goleft'); 
									  $transition 		= thz_akg('reveal_effect/transition',$atts,'thz-transease-04'); 
									  $reveal_class		= 'thz-overlay-box '.$reveal_effect.' '.$transition;
									  
								  }else{
									  
									  $reveal_class = 'thz-overlay-box'; 
								  }
								  
								  if($over_mode == 'directional'){
									  $overlay_box .='<div class="thz-overlay-box-directional">';
								  }
								  
								  $overlay_box .='<div class="'.thz_sanitize_class($reveal_class).'">';
								  
									  $overlay_box .='<div class="thz-overlay-box-icon">';
									  $overlay_box .='<div class="thz-hover-icon">';
									  $overlay_box .= $member_info;
									  $overlay_box .='</div>';
									  $overlay_box .='</div>';
								  
								  
								  $overlay_box .='</div>';
								  
								  if($over_mode == 'directional'){
									   $overlay_box .='</div>';
								  }
								  
								  echo $overlay_box;	
							  }							
                              ?>
                              <div class="thz-hover-mask <?php echo thz_sanitize_class($hover_tr) ?>">
                                  <div class="thz-hover-mask-table">
                                      <?php if($over_mode =='thzhover'){ ?>
                                      <div class="thz-hover-icons <?php echo thz_sanitize_class($iconef_classes) ?>">
                                          <div class="thz-hover-icon">
                                              <?php echo $member_info ?>
                                          </div>
                                      </div>
                                      <?php } ?>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div><?php echo $info_under ?>
          </div>
      </div>
      <?php endforeach;?>
  </div>
  <?php }?>
  <?php if('grid' == $layout) {?>
  <div class="thz-items-gutter-adjust"></div>
  <?php }?>
</div>