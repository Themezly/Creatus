<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$id 				= thz_akg('id',$atts); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.OverrideProhibited
$css_id 			= thz_akg('cmx/i',$atts);
$id_out				= !empty($css_id) ? str_replace(' ','',$css_id): 'thz-media-gallery-'.$id;
$css_class 			= thz_akg('cmx/c',$atts);
$css_class			= $css_class !='' ? $css_class.' ':'';
$res_class			= _thz_responsive_classes(thz_akg('cmx',$atts));
$media_layout		= thz_akg('media_layout',$atts,'grid');
$use_poster			= thz_akg('use_poster',$atts,'active'); 
$post_media			= thz_merge_media(thz_akg('post_media',$atts,null));
$post_media 		= $use_poster == 'active' ? thz_magnific_media( $post_media,$atts ) : $post_media ;
$media_height		= thz_akg('media_height/picked',$atts,'thz-ratio-16-9'); 
$data_layout		= $media_height == 'auto' ? 'masonry' : $media_height;
$mfp_classes		= ' '.thz_lightbox_classes($atts);
$show_title 		= thz_akg('show_title/picked',$atts,'hide');
$over_mode			= thz_akg('over_mode',$atts,'thzhover');
$mode_class			= ' thz-media-mode-'.$over_mode;
$show_media_icon	= thz_akg('mi/picked',$atts,'show');
$hover_bgtype		= thz_akg('med_over/background/type',$atts,'solid'); 
$hover_ef 			= thz_akg('med_over/oeffect',$atts,'thz-hover-fadein');
$hover_tr 			= thz_akg('med_over/oduration',$atts,'thz-transease-04');
$img_ef				= thz_akg('med_over/ieffect',$atts,'thz-img-zoomin');
$img_tr 			= thz_akg('med_over/iduration',$atts,'thz-transease-04');
$grayscale			= thz_akg('grayscale',$atts,'none');
$grayscale			= $grayscale !='none' ? ' '.$grayscale :'';
$media_size			= thz_akg('media_size',$atts,'thz-img-medium'); 
$cpx				= thz_akg('cpx',$atts);
$cpx_data			= thz_print_cpx($cpx);
$cpx_class			= thz_print_cpx($cpx,true);
$mpx				= thz_akg('mpx',$atts);
$mpx_print			= thz_print_mpx($mpx);
$mpx_specific		= thz_akg('mpx/s',$atts);
$mpx_specific 		= $mpx_specific !='' ? explode(',',$mpx_specific) : false;

if($show_media_icon =='show'){
	$icons_ef 			= thz_akg('med_over/iceffect',$atts,'thz-comein-bottom');
	$icons_tr 			= thz_akg('med_over/icduration',$atts,'thz-transease-05');
	$icon_shape			= thz_akg('mi/show/iconbg_metrics/sh',$atts,'square');
	$icon_pa			= thz_akg('mi/show/icon_metrics/pa',$atts,10);
	$icon_fs			= thz_akg('mi/show/icon_metrics/fs',$atts,16);
	$overlay_icon		= thz_akg('mi/show/icon_metrics/ic',$atts,'thzicon thzicon-plus');
	$play_icon			= thz_akg('mi/show/icon_metrics/pic',$atts,'thzicon thzicon-play2');
	$audio_icon			= thz_akg('mi/show/icon_metrics/aic',$atts,'thzicon thzicon-musical-note');
	$icon_classes		= $icon_shape.' thz-fs-'.$icon_fs.' thz-vp-'.$icon_pa.' thz-hp-'.$icon_pa;	
	$iconef_classes 	= ' '.$icons_ef.' '.$icons_tr;
}
$hover_classes 			= 'thz-hover-bg-'.$hover_bgtype.' '.$hover_ef.' '.$img_ef.' '.$img_tr.$grayscale;


if($media_height == 'custom' || $media_height == 'metro'){
	
	$ratio_class 	= ' thz-media-custom-size';
	$img_ratio		= ' thz-media-custom-size';
	$img_mask		= ' thz-hover-img-mask';
	
}else if ($media_height == 'auto'){
	
	$ratio_class 	= ' thz-aspect thz-media-height-auto';
	$img_ratio		= ' thz-media-height-auto';
	$img_mask		= '';
	
}else{
	$ratio_class 	= ' thz-aspect '.$media_height;
	$img_ratio		= ' thz-aspect '.$media_height;
	$img_mask		= ' thz-hover-img-mask';
}





if('slider' == $media_layout){
	

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
	$show_filter				= false;
	$multiple			 		= '';
	$mediacount 		 		= count($post_media);
	$activate_slider 	 		= ' thz-slick-inactive';
	
	if( $mediacount > 1 ){
		$activate_slider = ' thz-slick-active thz-slick-initiating thz-slick-'.$dstyle.$dots_p;
		$multiple	= $slidesToShow > 1 ? ' thz-slick-show-multiple' :'';	
	}
	
	$grid_holder_classes 	= $css_class.'thz-shc thz-media-holder thz-slick-holder '.$multiple.$mfp_classes.$mode_class.$cpx_class.$res_class;
	$grid_classes			= 'thz-slick-slider'.$activate_slider;
	
	$column_classes 		= 'thz-slick-slide thz-slide-media-gallery-item';
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

	$display_mode			= $show_title == 'show' ? 'introunder' :'thzhover';
	$no_response 			= $columns < 3 ? ' thz-grid-noresponse' :'';
	$gutter_class			= $gutter == 0 ? ' thz-items-grid-nogutter' : '';
	$grid_holder_classes 	= $css_class.'thz-shc thz-media-holder thz-items-grid-holder thz-grid-has-col-'.$columns;
	$grid_holder_classes 	.= ' thz-media-grid-isotope thz-is-isotope '.$mode_class.$gutter_class.$cpx_class.$res_class;
	$grid_classes 			= 'thz-items-grid thz-media-gallery-grid '.$no_response.$mfp_classes;
	$column_classes 		= 'thz-grid-item'.$animate_parent;
	$column_in_classes 		= 'thz-grid-item-in thz-media-item'.$animation_class;
	$grid_data 			 	= '';
	
	$isotope		= thz_akg('grid/isotope',$atts,'packery');
	$isotope		= $columns == 1 ? 'vertical' : $isotope;
	$grid_data 		.= ' data-isotope-mode="'.esc_attr($isotope).'" data-layout-type="'.esc_attr( $data_layout ).'" data-display-mode="'.esc_attr( $display_mode ).'"';
	

	if($media_height !='metro'){
		$minwidth			= thz_akg('grid/minwidth',$atts,200);
		$grid_data 			.= ' data-minwidth="'.esc_attr($minwidth + $gutter ).'"';
	}	
	
	$show_filter 	= thz_akg('filter/picked',$atts,'show');
	
	
	// filter
	if ('show' == $show_filter && !empty($post_media)) {	
	
		$categories				= array();
		$filter_all 			= thz_akg('filter/show/fm/at',$atts,'All');
		
		foreach($post_media as $media){
			
			if(empty($media['category'])){
				continue;
			}
			
			$cat_classes = explode(',',$media['category']);
			
			foreach($cat_classes as $category_class){
				
				$category_name 	= $category_class;
				$category_class = strtolower(str_replace(array(',',' ','-','_'),'',$category_class));
				
				$categories[$category_class] = array(
				
					'name' => $category_name,
					'class' => $category_class,
					
				);
				
				unset($category_class);
			}
			
			unset($cat_classes);

		}
	}
	
}

?>
<div id="<?php echo esc_attr($id_out) ?>" class="<?php echo thz_sanitize_class ( $grid_holder_classes ) ?>"<?php echo thz_sanitize_data($cpx_data); ?>>
	<?php if ( !empty($post_media) ){ ?>
    
	 <?php if ('grid' == $media_layout && 'show' == $show_filter && !is_admin()) {?>
        <ul id="thz-posts-filter-<?php echo esc_attr( $id ) ?>" class="thz-items-grid-categories thz-media-filter">
            <li class="thz-items-categories-item">
                <a class="active thz-posts-filter-link" href='#' data-filter-value=".category_all">
                    <?php echo $filter_all; ?>
                </a>
            </li>
            <?php foreach ( $categories as $category ) : ?>
            <li class="thz-items-categories-item">
                <a class="thz-posts-filter-link" href='#' data-filter-value=".category_<?php echo $category['class'] ?>">
                    <?php echo $category['name']; ?>
                </a>
            </li>
            <?php endforeach; ?>
        </ul>
     <?php } ?>
    
	<div id="<?php echo esc_attr($id_out) ?>-inner" class="<?php echo thz_sanitize_class ( $grid_classes ) ?>"<?php echo thz_sanitize_data($grid_data)?>>
		<?php if('grid' == $media_layout) {?>
        <div class="thz-items-sizer"></div>
        <?php } ?>
		<?php foreach($post_media as $mediakey => $media ) :
				
			$type 		= thz_akg('type',$media); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.OverrideProhibited
			$category	= thz_akg('category',$media,false);
			$source 	= thz_akg('media',$media);
			$mediaid 	= thz_akg('mediaid',$media); 
			$qtitle 	= thz_akg('qtitle',$media,null);
			$metroitem 	= '';
			$mp			= '';
			$cat 		= ''; // phpcs:ignore WordPress.WP.GlobalVariablesOverride.OverrideProhibited
			
			if($category && 'show' == $show_filter){
				
				$cats = array();
				$cats['all'] = 'category_all';
				$cat_c = explode(',',$category);
				
				foreach($cat_c as $item_cat){
					
					$cat_class = strtolower(str_replace(array(',',' ','-','_'),'',$item_cat));
					
					$cats[$cat_class] = 'category_'.$cat_class;
					
					unset($item_cat);
				}	
				
				unset($cat_c);			
				$cat = ' '.implode(' ',$cats); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.OverrideProhibited
				
			}
			
			// metro
			if( $media_height == 'metro' ){
				
				$sequence_type = thz_akg('media_height/metro/sequence',$atts,1);
				
				$sequence = thz_metro_sequence_maker($sequence_type);
				
				foreach ($sequence['items'] as $key => $size){
					
					if($mediakey % $sequence['count'] == $key){
						
						$metroitem = ' thz-item-metro-'. $size ;
					}
					
					unset($key,$size);
				}
				unset($sequence);
			
			}	
					
			if($type ==='image') {
				
				$img_meta 		= !empty($source['attachment_id']) ? wp_prepare_attachment_for_js($source['attachment_id']) : null; 
                $img_title 		= $qtitle ? esc_attr( $qtitle ) : esc_attr( $img_meta['title']);
				$img_title 		= isset($media['title']) ? $media['title'] : $img_title;
                $img_alt 		= $img_meta['alt'] == '' ? $img_title : esc_attr( $img_meta['alt']);
				$style 			= $media_height == 'auto' ? '' : thz_print_img_style( $source, $media_size );
				$magnific_link 	= isset($source['magnific_link']) ? $source['magnific_link'] : null;
				$print_mpx 		= ($mpx_specific && !in_array($mediakey + 1, $mpx_specific ) || $media_height == 'auto') ? false : $mpx_print ;
				$has_media_cpx	= $print_mpx ? ' has-media-cpx' :'';
								
				if($show_media_icon =='show'){
					
					$hover_icon = isset($source['overlay_icon']) ? $source['overlay_icon'] : $overlay_icon;
					
					if(strpos($hover_icon, 'play') !== false){
						
						$hover_icon = $play_icon !='' ? $play_icon : $hover_icon;
					}
					
					if(strpos($hover_icon, 'musical') !== false){
						
						$hover_icon = $audio_icon !='' ? $audio_icon : $hover_icon;
					}
					
				}
								
				$link			= isset($media['link']) ? $media['link'] : null; // phpcs:ignore WordPress.WP.GlobalVariablesOverride.OverrideProhibited
				
				if($link){
					
					if($link == 'h'){
						
						$link_output = '<a class="thz-hover-link" href="#"></a>';
						
					}else if($link == 'd'){
						
						$link_output = ' ';
						
					}else{
						
					
						$link_output ='<a ';
						if($link['type'] == 'normal'){
							
							$link_output .='class="thz-hover-link" href="'.esc_url($link['url']).'" target="'.esc_attr($link['target']).'">';
							
						}else{
							
							$hash = thz_contains($link['magnific'],array('#','http')) ? '' :'#';
							$link_output .='class="thz-hover-link thz-trigger-lightbox" href="'.$hash.esc_attr($link['magnific']).'">';
							
						}
						$link_output .='</a>';
						
					}
					
				}
				
				$extra_link		= $link ? $link_output : $magnific_link;
				
			}

			$media_item_title = null;
			if($show_title == 'show'){
				
				$media_item_title .= '<div class="thz-media-item-title thz-grid-item-intro-holder">';
				
				if($type ==='image' ){
					
					$media_item_title .= $img_title;
				
				}elseif($type ==='selfaudio' || $type ==='selfvideo'){
					
					$media_item_title .=  $qtitle ? $qtitle : get_the_title($source[0]['attachment_id']);
					
				}else{
					
					$media_item_title .= $qtitle ? $qtitle : esc_html_e('Missing title','creatus');
					
				}
				$media_item_title .= '</div>';
			}
			$hover_out = 'thz-hover'.$img_mask.' '.$hover_classes.$has_media_cpx;
			
			
			
			$has_poster ='';
			if($type === 'html5video' || $type === 'selfvideo') {
				
				$poster	=  thz_akg('poster',$media,array());
				$poster = !empty($poster) ? $poster['url'] : null;
				$has_poster = ' thz-media-has-poster';
				
			}
		
			
		?>
		<?php if($type ==='image') {?>
		<div class="<?php echo thz_sanitize_class( $column_classes.$metroitem.$cat ); ?>" data-type="image">
			<div class="<?php echo thz_sanitize_class ( $column_in_classes ) ?>"<?php echo thz_sanitize_data($animate_data) ?>>
            	<div class="thz-media-item-media">
                    <div class="thz-media-item-ratio<?php echo thz_sanitize_class($img_ratio) ?>">
                        <div class="thz-ratio-in">
                                <div class="<?php echo thz_sanitize_class($hover_out) ?>"<?php echo $style; ?>>																					 								<?php 
								
                                	if($print_mpx){
										echo $print_mpx;
									}
									
                                    if($over_mode == 'reveal' || $over_mode == 'directional'){
                                        
                                        $overlay_box ='';
                                        
                                        if($over_mode == 'reveal'){
                                            
                                            $reveal_effect 	= thz_akg('reveal_effect/effect',$atts,'thz-reveal-goleft'); 
                                            $transition 	= thz_akg('reveal_effect/transition',$atts,'thz-transease-04'); 
                                            $reveal_class	= 'thz-overlay-box '.$reveal_effect.' '.$transition;
                                            
                                        }else{
                                            
                                            $reveal_class = 'thz-overlay-box'; 
                                        }
                                        
                                        if($over_mode == 'directional'){
                                            $overlay_box .='<div class="thz-overlay-box-directional">';
                                        }
                                        
                                        $overlay_box .='<div class="'.thz_sanitize_class($reveal_class).'">';
                                        if($show_media_icon =='show'){
                                            $overlay_box .='<div class="thz-overlay-box-icon">';
                                            $overlay_box .='<div class="thz-hover-icon '.thz_sanitize_class($icon_classes).'">';
                                            $overlay_box .='<span class="'.thz_sanitize_class($hover_icon).'">';
                                            $overlay_box .='</span>';
                                            $overlay_box .='</div>';
                                            $overlay_box .='</div>';
                                        }
                                        
                                        $overlay_box .='</div>';
                                        
                                        if($over_mode == 'directional'){
                                             $overlay_box .='</div>';
                                        }
                                        
                                        echo $overlay_box;	
                                    }							
        
                                
                                ?>
                                <?php if ($media_height =='auto' ) { ?>
                                <?php echo thz_print_img_html($source, $media_size, array('class' => $img_tr , 'alt' => $img_alt)) ?>
                                <?php } ?>
                                <div class="thz-hover-mask <?php echo thz_sanitize_class($hover_tr) ?>">
                                    <div class="thz-hover-mask-table">
                                    <?php if( $extra_link ) { echo $extra_link ; }else{ ?>
                                    <a class="thz-hover-link thz-lightbox mfp-image" href="#" <?php echo thz_lightbox_data($atts); ?> data-mfp-src="<?php echo esc_url( $source['url'] ) ?>" data-mfp-title="<?php echo esc_attr( $img_title ) ?>"></a><?php } ?>
                                        <?php if($show_media_icon =='show' && $over_mode =='thzhover'){ ?>
                                        <div class="thz-hover-icons <?php echo thz_sanitize_class($iconef_classes) ?>">
                                            <div class="thz-hover-icon <?php echo thz_sanitize_class($icon_classes) ?>">
                                                <span class="<?php echo thz_sanitize_class($hover_icon) ?>"></span>
                                            </div>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><?php echo $media_item_title ?>
			</div>
		</div>
		<?php }?>
		<?php if($type ==='vimeo') {?>
		<div class="<?php echo thz_sanitize_class( $column_classes.$cat ) ?>" data-type="vimeo">
			<div class="<?php echo thz_sanitize_class ( $column_in_classes ) ?>"<?php echo thz_sanitize_data($animate_data) ?>>
            	<div class="thz-media-item-media">
                    <div class="<?php echo $ratio_class ?>">
                        <div class="thz-ratio-in">
                            <video id="thz_media<?php echo $mediaid ?>" class="thz-media thz-video-vimeo thz-media-respond" width="640" height="360">
                                <source src="<?php echo esc_url ( $source ) ?>" type="video/vimeo">
                            </video>
                        </div>
                    </div>
                </div><?php echo $media_item_title ?>
			</div>
		</div>
		<?php }?>
		<?php if($type ==='youtube') {?>
		<div class="<?php echo thz_sanitize_class( $column_classes.$cat ) ?>" data-type="youtube">
			<div class="<?php echo thz_sanitize_class ( $column_in_classes ) ?>"<?php echo thz_sanitize_data($animate_data) ?>>
            	<div class="thz-media-item-media">
                    <div class="<?php echo $ratio_class ?>">
                        <div class="thz-ratio-in">
                            <video id="thz_media<?php echo esc_attr($mediaid) ?>" width="640" height="360" class="thz-media thz-video-youtube thz-media-respond">
                                <source src="<?php echo esc_url ( $source ) ?>" type="video/youtube">
                            </video>
                        </div>
                    </div>
                </div><?php echo $media_item_title ?>
			</div>
		</div>
		<?php }?>
		<?php if($type ==='html5video') {?>
		<div class="<?php echo thz_sanitize_class( $column_classes.$cat ) ?>" data-type="html5video">
			<div class="<?php echo thz_sanitize_class ( $column_in_classes ) ?>"<?php echo thz_sanitize_data($animate_data) ?>>
            	<div class="thz-media-item-media">
                    <div class="<?php echo $ratio_class ?>">
                        <div class="thz-ratio-in">
                            <video id="thz_media<?php echo esc_attr($mediaid) ?>" width="640" height="360" class="thz-media thz-video-html5 thz-media-respond<?php echo thz_sanitize_class($has_poster) ?>"<?php if( $poster ){ echo ' poster="'.esc_url($poster).'"';}?>
                                <source src="<?php echo esc_url ( $source ) ?>" />
                            </video>
                        </div>
                    </div>
                </div><?php echo $media_item_title ?>
			</div>
		</div>
		<?php }?>
		<?php if($type ==='html5audio') {?>
		<div class="<?php echo thz_sanitize_class( $column_classes.$cat ) ?>" data-type="html5audio">
			<div class="<?php echo thz_sanitize_class ( $column_in_classes ) ?>"<?php echo thz_sanitize_data($animate_data) ?>>
            	<div class="thz-media-item-media">
                    <div class="<?php echo $ratio_class ?>">
                        <div class="thz-ratio-in">
                            <div class="thz-media-audio-holder">
                                <audio id="thz_media<?php echo esc_attr($mediaid) ?>" height="30px" class="thz-media thz-audio thz-media-respond">
                                    <source src="<?php echo esc_url ( trim($source) ) ?>" type="audio/mp3">
                                </audio>
                            </div>
                        </div>
                    </div>
                </div><?php echo $media_item_title ?>
			</div>
		</div>
		<?php }?>
		<?php if($type ==='iframe') {?>
		<div class="<?php echo thz_sanitize_class( $column_classes.$cat ) ?>" data-type="iframe">
			<div class="<?php echo thz_sanitize_class ( $column_in_classes ) ?>"<?php echo thz_sanitize_data($animate_data) ?>>
            	<div class="thz-media-item-media">
                    <div class="<?php echo $ratio_class ?>">
                        <div class="thz-ratio-in">
                            <?php thz_media_iframe_helper($source); ?>
                        </div>
                    </div>
                </div><?php echo $media_item_title ?>
			</div>
		</div>
		<?php }?>
		<?php if($type ==='oembed') {?>
		<div class="<?php echo thz_sanitize_class( $column_classes.$cat ) ?>" data-type="iframe">
			<div class="<?php echo thz_sanitize_class ( $column_in_classes ) ?>"<?php echo thz_sanitize_data($animate_data) ?>>
            	<div class="thz-media-item-media">
                    <div class="<?php echo $ratio_class ?>">
                        <div class="thz-ratio-in">
                            <?php echo thz_get_oembed( esc_url ( trim($source) ) , array('width'  => 640,'height' => 360) );?>
                        </div>
                    </div>
                </div><?php echo $media_item_title ?>
			</div>
		</div>
		<?php }?>
		<?php if($type ==='selfvideo') {?>
		<div class="<?php echo thz_sanitize_class( $column_classes.$cat ) ?>" data-type="html5video">
			<div class="<?php echo thz_sanitize_class ( $column_in_classes ) ?>"<?php echo thz_sanitize_data($animate_data) ?>>
            	<div class="thz-media-item-media">
                    <div class="<?php echo $ratio_class ?>">
                        <div class="thz-ratio-in">
                            <video id="thz_media<?php echo esc_attr($mediaid) ?>" width="640" height="360" class="thz-media thz-video-html5 thz-media-respond<?php echo thz_sanitize_class($has_poster) ?>"<?php if( $poster ){ echo ' poster="'.esc_url($poster).'"';}?>>
                                <?php foreach($source as $video_ext){ $type = wp_check_filetype( $video_ext['url']); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.OverrideProhibited ?>
                                    <source src="<?php echo esc_url ( $video_ext['url'] ) ?>" type="<?php echo $type['type'] ?>" />
                                <?php } unset($video_ext);?>
                            </video>
                        </div>
                    </div>
                </div><?php echo $media_item_title ?>
			</div>
		</div>
		<?php }?>
		<?php if($type ==='selfaudio') {?>
		<div class="<?php echo thz_sanitize_class( $column_classes.$cat ) ?>" data-type="html5audio">
			<div class="<?php echo thz_sanitize_class ( $column_in_classes ) ?>"<?php echo thz_sanitize_data($animate_data)?>>
            	<div class="thz-media-item-media">
                    <div class="<?php echo $ratio_class ?>">
                        <div class="thz-ratio-in">
                            <div class="thz-media-audio-holder">
                                <audio id="thz_media<?php echo esc_attr($mediaid)?>" height="30px" class="thz-media thz-audio thz-media-respond">
                                <?php foreach($source as $audio_ext){ $type = wp_check_filetype( $audio_ext['url']); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.OverrideProhibited ?>
                                    <source src="<?php echo esc_url ( $audio_ext['url'] ) ?>" type="<?php echo $type['type'] ?>" />
                                <?php } unset($audio_ext);?>
                                </audio>
                            </div>
                        </div>
                    </div>
                </div><?php echo $media_item_title ?>
			</div>
		</div>
		<?php }?>
		<?php endforeach;?>
	</div>
	<?php }?>
    <?php if('grid' == $media_layout) {?>
	<div class="thz-items-gutter-adjust"></div>
    <?php }?>
</div>