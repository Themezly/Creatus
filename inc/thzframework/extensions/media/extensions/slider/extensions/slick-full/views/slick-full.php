<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$slider_id			= thz_akg('settings/post_id',$data);
$css_id 			= thz_akg('settings/extra/style/cmx/i',$data);
$id_out				= !empty($css_id) ? str_replace(' ','',$css_id): 'thz-slider-'.$slider_id;
$css_class 			= thz_akg('settings/extra/style/cmx/c',$data);
$css_class			= $css_class !='' ? $css_class.' ':'';
$res_class			= _thz_responsive_classes(thz_akg('settings/extra/style/cmx',$data));
$ratio				= thz_akg('settings/extra/ratio/picked',$data);
$animation			= thz_akg('settings/extra/slider_animation',$data);

// animations
$ata				= thz_akg('settings/extra/style/at',$data);
$ata_data			= thz_print_animation($ata);
$ata_aclass			= thz_print_animation($ata,true);
$asa				= thz_akg('settings/extra/style/as',$data);
$asa_data			= thz_print_animation($asa);
$asa_aclass			= thz_print_animation($asa,true);
$ada				= thz_akg('settings/extra/style/ad',$data);
$ada_data			= thz_print_animation($ada);
$ada_aclass			= thz_print_animation($ada,true);
$aba				= thz_akg('settings/extra/style/ab',$data);
$aba_data			= thz_print_animation($aba);
$aba_aclass			= thz_print_animation($aba,true);
// slick
$show_dots			= thz_akg('settings/extra/style/nav/show',$data);
$show_arrows		= thz_akg('settings/extra/style/arr/show',$data);
$dost_style			= thz_akg('settings/extra/style/nav/style',$data,'rings');
$dshadows			= thz_akg('settings/extra/style/nav/shadows',$data,'active');
$dopacities			= thz_akg('settings/extra/style/nav/opacities',$data,'active');
$dost_style			= $dost_style.' dsh-'.$dshadows.' dop-'.$dopacities.' ';

$dpoz				= thz_akg('settings/extra/style/nav/p',$data,'bc');
$dots_p				= $dpoz == 'c' ? ' dots-'.thz_akg('settings/extra/style/nav/o',$data,'h') : ' dots-'.$dpoz;


$slick_data 		= thz_slick_data(array('show' => '1','scroll' => '1','space' => '0','dots' => $show_dots,'arrows' => $show_arrows),$animation);
$classes 			= $css_class.'thz-shc thz-slick-holder thz-sliders-slick-full'.$res_class;
$slider_classes		= 'thz-sliders-slick thz-slick-slider thz-slick-active thz-slick-initiating thz-slick-'.$dost_style.$dots_p;
?>
<div id="<?php echo esc_attr($id_out) ?>" class="<?php echo thz_sanitize_class($classes) ?>">
	<div id="thz-sf-<?php echo esc_attr($slider_id) ?>" class="<?php echo thz_sanitize_class($slider_classes) ?>"<?php echo thz_sanitize_data($slick_data) ?>>
		<?php foreach(  $data['slides'] as $key => $slide  ) : 

			$title 		= thz_akg('title',$slide);
			$intro 		= thz_akg('desc',$slide);
			$subloc 	= thz_akg('extra/subloc',$slide);
			$sub 		= thz_akg('extra/sub',$slide);
			$btns		= thz_akg('extra/btns',$slide);
			$imgp		= thz_akg('extra/imgp',$slide);
			$class 		= 'thz-sliders-img '.$imgp;
			$style 		= ' style="background-image:url('.esc_url( thz_akg('src',$slide) ).');"';
			
			
			// parallax
			$parallax 	= $slide['extra']['px']['picked'];
			$px_data	= '';
			
			if($parallax == 'active'){
				
				$class .= ' thz-parallax thz-parallax-scroll';
				$velocity 	= thz_akg('extra/px/active/p/v',$slide);
				$direction 	= thz_akg('extra/px/active/p/d',$slide);
				$scale 		= thz_akg('extra/px/active/p/s',$slide);// up | down
				$px_data .= ' data-thzplx-type="scroll"';
				$px_data .= ' data-thzplx-onmobile="0"';
				$px_data .= ' data-thzplx-size="default"';
				$px_data .= ' data-thzplx-velocity="'.esc_attr($velocity).'"';
				$px_data .= ' data-thzplx-direction="'.esc_attr($direction).'"';
				$px_data .= ' data-thzplx-scale="'.esc_attr($scale).'"';
			}
		?>
		<div id="<?php echo 'thz-slider-'.esc_attr($slider_id).'-s-'.$key ?>" class="thz-slick-slide">
			<div class="thz-slick-slide-in thz-aspect <?php echo thz_sanitize_class($ratio) ?>">
				<div class="thz-ratio-in">
					<div class="<?php echo thz_sanitize_class($class); ?>"<?php echo thz_sanitize_data($style.$px_data); ?>>
					</div>
					<div class="thz-sliders-table">
						<div class="thz-sliders-table-cell">
							<div class="thz-sliders-table-cell-in">
								<div class="thz-sliders-container thz-site-width">
									<div class="thz-sliders-content thz-animate-parent">
										<?php if($sub !='' && $subloc =='above'){ ?>
										<div class="thz-sliders-sub<?php echo thz_sanitize_class($asa_aclass)?>"<?php echo thz_sanitize_data($asa_data) ?>>
											<?php echo esc_attr( $sub ); ?>
										</div>
										<?php } ?>
										<?php if($title !=''){ ?>
										<div class="thz-sliders-title<?php echo thz_sanitize_class($ata_aclass)?>"<?php echo thz_sanitize_data($ata_data) ?>>
											<?php echo esc_attr( $title ); ?>
										</div>
										<?php } ?>
										<?php if($sub !='' && $subloc =='under'){ ?>
										<div class="thz-sliders-sub<?php echo thz_sanitize_class($asa_aclass)?>"<?php echo thz_sanitize_data($asa_data) ?>>
											<?php echo esc_attr( $sub ); ?>
										</div>
										<?php } ?>
										<?php if($intro !=''){ ?>
										<div class="thz-sliders-desc<?php echo thz_sanitize_class($ada_aclass)?>"<?php echo thz_sanitize_data($ada_data) ?>>
											<?php echo esc_attr( $intro );?>
										</div>
										<?php } ?>
										<?php if(!empty($btns)){ ?>
										<div class="thz-sliders-buttons<?php echo thz_sanitize_class($aba_aclass)?>"<?php echo thz_sanitize_data($aba_data) ?>>
											<?php 
										foreach($btns as $btn){						
											echo thz_akg('b/html',$btn);
										}
									?>
										</div>
										<?php } ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php endforeach; ?>
	</div>
</div>