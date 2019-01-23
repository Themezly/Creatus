<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

/**
 * @var array $atts
 */
$id 				= thz_akg('id',$atts);
$css_id 			= thz_akg('cmx/i',$atts);
$id_out				= !empty($css_id) ? str_replace(' ','',$css_id): 'thz-table-'.$id;
$css_class 			= thz_akg('cmx/c',$atts);
$css_class			= $css_class !='' ? $css_class.' ':'';
$res_class			= _thz_responsive_classes(thz_akg('cmx',$atts));
$type				= thz_akg('table/header_options/table_purpose',$atts);
$animate			= thz_akg('animate',$atts);
$animation_data		= thz_print_animation($animate);
$animation_class	= thz_print_animation($animate,true);
$cpx				= thz_akg('cpx',$atts);
$cpx_data			= thz_print_cpx($cpx);
$cpx_class			= thz_print_cpx($cpx,true);
$style 				= thz_akg('pricing_style/picked',$atts);
$box_shadow  		= thz_akg('pricing_style/'.$style.'/package/shadow',$atts);
$shadow_class 		= ' thz-boxshadow-full-'.str_replace('.','',$box_shadow);
$class_width 		= 'thz-pricing-col-' . count($atts['table']['cols']);
$has_desc 	 		= thz_in_array_r('desc-col',$atts['table']['cols'],true) ? ' thz-pricing-hasdes' :'';
$has_highlight		= thz_in_array_r('highlight-col',$atts['table']['cols'],true) ? ' has-highlight' :'';
$classes			= $css_class.'thz-shc thz-table-container thz-pricing thz-pricing-'.$style.$animation_class.$has_desc.$has_highlight.$cpx_class.$res_class;
?>
<div id="<?php echo esc_attr($id_out)?>" class="<?php echo thz_sanitize_class($classes) ?>"<?php echo thz_sanitize_data($animation_data.$cpx_data)?>>
	<div class="thz-pricing-in">
	<?php foreach ($atts['table']['cols'] as $col_key => $col): $shadow = $col['name'] =='highlight-col' ? $shadow_class :'';?>
		<?php $shadow = $col['name'] =='highlight-col' ? $shadow_class :'';?>
		<?php $style3_shadow = $style =='style3' ? $shadow_class :'';?>
		<div class="thz-pricing-wrap <?php echo esc_attr($class_width . ' ' . $col['name']); ?>">
			<div class="thz-pricing-package<?php echo thz_sanitize_class($shadow.$style3_shadow); ?>">
				<?php foreach ($atts['table']['rows'] as $row_key => $row):?>
					<?php if( $col['name'] == 'desc-col' ) : ?>
						<?php  if( $row['name'] == 'button-row' 
						|| ($row['name'] == 'heading-row' && $style == 'style3')
						|| ($row['name'] == 'pricing-row' && $style == 'style3')){continue;} ?>
						<div class="thz-pricing-default-row thz-pricing-rows thz-pricing-desc-<?php echo esc_attr($row['name']); ?>">
							<?php 
							
								$value = $atts['table']['content'][$row_key][$col_key]['textarea'];
								if($row['name'] == 'heading-row'){
									$value ='<span class="thzicon thzicon-gift"></span>';
								}
								if($row['name'] == 'pricing-row'){
									$value ='<div class="thz-pricing-cell"><span class="thzicon thzicon-money"></span></div>';
								}
							 ?>
							<?php echo $value ?>
						</div>
					<?php continue; endif; ?>
					<?php if ($row['name'] === 'heading-row'): ?>
						<div class="thz-pricing-heading thz-pricing-rows">
							<?php $value = $atts['table']['content'][$row_key][$col_key]['textarea']; ?>
							<?php echo (empty($value) && $col['name'] === 'desc-col') ? '&nbps;' : esc_attr($value); ?>
						</div>
					<?php elseif ($row['name'] === 'pricing-row'): ?>
						<div class="thz-pricing-price-row thz-pricing-rows">
							<div class="thz-price-holder thz-pricing-cell">
								<?php $amount = $atts['table']['content'][$row_key][$col_key]['amount'] ?>
								<?php $desc   = $atts['table']['content'][$row_key][$col_key]['description']; ?>
								<span class="thz-pricing-price">
									<?php echo (empty($value) && $col['name'] === 'desc-col') ? '&nbps;' : esc_attr($amount); ?>
								</span>
								<small>
									<?php echo (empty($value) && $col['name'] === 'desc-col') ? '&nbps;' : esc_attr($desc); ?>
								</small>
							</div>
						</div>
					<?php elseif ( $row['name'] == 'button-row' ) : ?>
						<?php $button = fw_ext( 'shortcodes' )->get_shortcode( 'button' ); ?>
							<div class="thz-pricing-button-row thz-pricing-rows">
								<?php if ( false === empty( $atts['table']['content'][ $row_key ][ $col_key ]['button'] ) and false === empty($button) ) : ?>
									<?php echo $button->render($atts['table']['content'][ $row_key ][ $col_key ]['button']); ?>
								<?php else : ?>
									<span>&nbsp;</span>
								<?php endif; ?>
							</div>
					<?php elseif ($row['name'] === 'switch-row') : ?>
						<div class="thz-pricing-switch-row thz-pricing-rows">
							<?php 
								$value = $atts['table']['content'][$row_key][$col_key]['switch']; 
								if($value == 'yes'){
									$icon_name = 'fa-check';
								}else{
									$icon_name = 'fa-times';
								}
							?>
							<span>
								<i class="fa <?php echo esc_attr($icon_name) ?>"></i>
							</span>
						</div>
					<?php elseif ($row['name'] === 'default-row') : 
					
						$value = $atts['table']['content'][$row_key][$col_key]['textarea'];
						if($value == ''){
							continue;
						}
					?>
						<div class="thz-pricing-default-row thz-pricing-rows">
							<?php echo $value; ?>
						</div>
					<?php endif; ?>
				<?php endforeach; ?>
			</div>
		</div>
	<?php endforeach; ?>
	</div>
</div>