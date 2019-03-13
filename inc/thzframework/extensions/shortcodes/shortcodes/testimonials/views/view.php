<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}
if(count($atts['testimonials']) < 1){
	
	$n_title 	= esc_html__('Testimonials missing','creatus');
	$n_msg 		= esc_html__('Please go in testimonials settings and add minimum one testimonial','creatus');
	thz_notify('yellow thz-shc',$n_title,$n_msg);
	return;
}
$id 				= thz_akg('id',$atts); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.OverrideProhibited
$css_id 			= thz_akg('cmx/i',$atts);
$id_out				= !empty($css_id) ? str_replace(' ','',$css_id): 'thz-testimonials-'.$id;
$css_class 			= thz_akg('cmx/c',$atts);
$css_class			= $css_class !='' ? $css_class.' ':'';
$res_class			= _thz_responsive_classes(thz_akg('cmx',$atts));
$testimonials 		= thz_akg('testimonials',$atts,null);
$info_side	  		= thz_akg('tm/info_side',$atts,'center');
$image_shape  		= thz_akg('tm/image_shape',$atts,'circle');
$arrow_show  		= thz_akg('tm/ar',$atts,'show-arrow');
$quotes_show  		= thz_akg('tm/qu',$atts,'show');
$layout_mode  		= thz_akg('layout_mode',$atts,'slider');
$cpx				= thz_akg('cpx',$atts);
$cpx_data			= thz_print_cpx($cpx);
$cpx_class			= thz_print_cpx($cpx,true);
$multiple			= '';
$testcount			= count($testimonials);
$activate_slider	= ' thz-slick-inactive';




if('slider' == $layout_mode){

	$slider_layout 	 	 		= thz_akg('slider',$atts,null);
	$slider_animation 	 		= thz_akg('san',$atts,null);
	$slider_layout['dots'] 		= thz_akg('nav/show',$atts,'outside');
	$slider_layout['arrows'] 	= thz_akg('arr/show',$atts,'hide');
	$slider_breakpoints			= thz_akg('slbp',$atts,false);
	$holder_in_data 		 	= thz_slick_data($slider_layout,$slider_animation,$slider_breakpoints);
	$slidesToShow		 		= thz_akg('show',$slider_layout,1);
	$dstyle						= thz_akg('nav/style',$atts,'rings');
	$dshadows					= thz_akg('nav/shadows',$atts,'active');
	$dopacities					= thz_akg('nav/opacities',$atts,'active');
	$dstyle						= $dstyle.' dsh-'.$dshadows.' dop-'.$dopacities.' ';
	$dpoz						= thz_akg('nav/p',$atts,'bc');	
	$dots_p						= $dpoz == 'c' ? ' dots-'.thz_akg('nav/o',$atts,'h') : ' dots-'.$dpoz;

	if( $testcount > 1 ){
		
		$activate_slider = ' thz-slick-active thz-slick-initiating thz-slick-'.$dstyle.$dots_p;
		$multiple	= $slidesToShow > 1 ? ' thz-slick-show-multiple' :'';	
		$holder_classes = $css_class.'thz-shc thz-testimonials-holder thz-slick-holder'.$multiple.' '.$arrow_show;
		$holder_in_classes = 'thz-slick-slider'.$activate_slider;
	
	}else{
		
		$holder_in_data ='';
		$holder_classes = $css_class.'thz-shc thz-testimonials-holder '.$arrow_show.$cpx_class.$res_class;
		$holder_in_classes = 'thz-testimonials-container';	
	}

	$column_classes 		= 'thz-slick-slide';
	$column_in_classes 		= 'thz-slick-slide-in';
	$animate_data			= '';
			
}else{
	
	$columns 				= thz_akg('grid/columns',$atts,3);
	$gutter					= thz_akg('grid/gutter',$atts,null);
	$animate				= thz_akg('animate',$atts);
	$animate_data			= thz_print_animation($animate);
	$animation_class		= thz_print_animation($animate,true,'thz-isotope-animate');
	$animate_parent			= $animation_class != '' ? ' thz-animate-parent' :'';	

	
	$no_response 			= $columns < 3 ? ' thz-grid-noresponse' :'';
	$gutter_class			= $gutter == 0 ? ' thz-items-grid-nogutter' : '';
	$holder_classes 		= $css_class.'thz-shc thz-testimonials-holder thz-items-grid-holder thz-grid-has-col-'.$columns.' '.$arrow_show;
	$holder_classes 		.= ' thz-media-grid-isotope thz-is-isotope '.$gutter_class.$cpx_class.$res_class;
	$holder_in_classes 		= 'thz-items-grid thz-media-gallery-grid '.$no_response;
	$column_classes 		= 'thz-grid-item'.$animate_parent;
	$column_in_classes 		= 'thz-grid-item-in '.$animation_class;
	$holder_in_data 		= '';
	
	$isotope		= thz_akg('grid/isotope',$atts,'packery');
	$isotope		= $columns == 1 ? 'vertical' : $isotope;
	$holder_in_data .= ' data-isotope-mode="'.esc_attr($isotope).'"';
}

if( 'hide' == $quotes_show ){
	
	$holder_classes .=' hide-quotes';
}

?>
<div id="<?php echo esc_attr($id_out)?>" class="<?php echo thz_sanitize_class($holder_classes) ?>">
  <div class="<?php echo thz_sanitize_class($holder_in_classes) ?>"<?php echo thz_sanitize_data($holder_in_data)?>>
	<?php if('grid' == $layout_mode) {?>
    <div class="thz-items-sizer"></div>
    <?php } ?>
    <?php foreach ($testimonials as $item) { 

		$author_quote	= thz_akg('author_quote',$item,null); 
		$author_avatar 	= thz_akg('author_avatar',$item,null); 
		$author_name  	= thz_akg('author_name',$item,null); 
		$author_job		= thz_akg('author_job',$item,null); 
		$author_website	= thz_akg('author_website',$item,null); 
		$author_url		= thz_akg('author_url',$item,null); 
		$avatar			= false;
		
		if(!empty($author_avatar)){
			$av_aid 		= $author_avatar['attachment_id'];
			$avatar_atch	= !empty($av_aid) && !thz_is_dattch($av_aid) ? $av_aid : false;
			if($avatar_atch){
				
				$avatar	= $avatar_atch ? wp_get_attachment_image_src( $avatar_atch,'thumbnail') : null;
				$avatar = isset($avatar[0]) ? $avatar[0] : false;
				
			}else if(thz_is_dattch($av_aid) && !empty($author_avatar['url'])){
				$avatar = $author_avatar['url'];
			}
		}

		if($author_url){
			
			$website ='<a href="'.esc_url($author_url).'" target="_blank">';
			$website .= esc_attr($author_website);
			$website .='</a>';
			
		}else{
			
			$website = $author_website;
			
		}
		
		if($author_quote ==''){
			continue;
		}

	?>
    <?php if( $testcount > 1  || 'grid' == $layout_mode ){?>
    <div class="<?php echo thz_sanitize_class($column_classes) ?>"<?php echo thz_sanitize_data($cpx_data) ?>>
      <div class="<?php echo thz_sanitize_class($column_in_classes) ?>"<?php echo thz_sanitize_data($animate_data) ?>>
        <?php } ?>
        <div class="thz-testimonial <?php echo thz_sanitize_class($info_side); ?>">
          <div class="thz-testimonial-quote">
            <div class="quote">
              <?php echo esc_attr($author_quote); ?>
            </div>
          </div>
          <div class="thz-testimonial-info">
            <?php if(($info_side =='left' || $info_side =='center' ) && $avatar) {?>
            <div class="thz-testimonial-avatar">
              <div class="thz-testimonial-avatar-image <?php echo thz_sanitize_class($image_shape); ?>">
                <img src="<?php echo esc_url($avatar); ?>" alt="<?php echo esc_attr($author_name); ?>" />
              </div>
            </div>
            <?php } ?>
            <div class="thz-testimonial-author">
              <?php if( $author_name !='' ){?>
              <span class="thz-testimonial-name">
                <?php echo esc_attr($author_name); ?>
              </span>
              <?php } ?>
              <?php if( $author_job !='' ){?>
              <span class="thz-testimonial-job">
                <?php echo esc_attr($author_job); ?>
              </span>
              <?php } ?>
              <?php if( $website !='' ){?>
              <span class="thz-testimonial-website">
                - <?php echo $website; ?>
              </span>
              <?php } ?>
            </div>
            <?php if($info_side =='right' && $avatar) {?>
            <div class="thz-testimonial-avatar">
              <div class="thz-testimonial-avatar-image <?php echo thz_sanitize_class($image_shape); ?>">
                <img src="<?php echo esc_url($avatar); ?>" alt="<?php echo esc_attr($author_name); ?>" />
              </div>
            </div>
            <?php } ?>
          </div>
        </div>
        <?php if( $testcount > 1 || 'grid' == $layout_mode ){?>
      </div>
    </div>
    <?php } ?>
    <?php } ?>
  </div>
<?php if('grid' == $layout_mode) {?>
<div class="thz-items-gutter-adjust"></div>
<?php }?>
</div>