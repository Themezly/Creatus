<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}
if(count($atts['accordions']) < 1){
	
	$n_title 	= esc_html__('Shortcode accordion missing','creatus');
	$n_msg 		= esc_html__('Please go in accordion settings and add minimum one accordion','creatus');
	thz_notify('yellow thz-shc',$n_title,$n_msg);
	return;
}

$id					= thz_akg('id',$atts); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.OverrideProhibited
$css_id 			= thz_akg('cmx/i',$atts);
$id_out				= !empty($css_id) ? str_replace(' ','',$css_id): 'thz-accordion-'.$id; 
$css_class 			= thz_akg('cmx/c',$atts);
$css_class			= $css_class !='' ? $css_class.' ':'';
$res_class			= _thz_responsive_classes(thz_akg('cmx',$atts));		
$openonload			= thz_akg('gm/openonload',$atts,'loadopened');
$togglearrow		= thz_akg('gm/togglearrow',$atts,'show');
$animate			= thz_akg('animate',$atts);
$animation_data		= thz_print_animation($animate);
$animation_class	= thz_print_animation($animate,true);
$cpx				= thz_akg('cpx',$atts);
$cpx_data			= thz_print_cpx($cpx);
$cpx_class			= thz_print_cpx($cpx,true);
$anchor 			= thz_akg('anchor',$atts);
$t_borders			= ' thz-acc-b-'.thz_akg('gm/tb',$atts,'hideside');
$c_borders			= ' thz-acc-b-'.thz_akg('gm/cb',$atts,'hide');
$acc_class			= $css_class.'thz-shc thz-accordion-'.$id.' thz-shortcode-accordion '.$openonload.$animation_class.$cpx_class.$res_class;
?>
<div id="<?php echo esc_attr($id_out) ?>" class="<?php echo thz_sanitize_class($acc_class); ?>"<?php echo thz_sanitize_data($animation_data.$cpx_data) ?>>
	<?php foreach ( $atts['accordions'] as $key => $acc ) : 
			
			$ctype  			= thz_akg('ctype',$acc,'editor');
			if('editor' == $ctype){
				$accordion_content  	= thz_akg('accordion_content',$acc);
				$content = thz_html_trans(esc_textarea( do_shortcode($accordion_content)) );
			}else{
				$page_blocks = thz_akg('page_blocks',$acc); 
				$content = thz_print_page_blocks( $page_blocks,'thz-accordion-pageblocks', false );
				
			}
	
	?>
		<div class="thz-accordion-group<?php echo $key == 0 && $openonload == 'loadopened' ? ' active-group' : ''; ?>">
			<div class="thz-accordion-title<?php echo $key == 0  && $openonload == 'loadopened' ? ' active'.$t_borders : $t_borders; ?>">
				<a href="#">
					<?php if(!empty($acc['accordion_icon'])){?>
					<span class="thz-acc-title-icon <?php echo esc_attr( $acc['accordion_icon'] ); ?>"></span> 
					<?php } ?>
					<span class="thz-acc-title-text"><?php echo esc_attr($acc['accordion_title']); ?></span>
					<?php if($togglearrow =='show'){ ?>
						<span class="thz-acc-toggle"></span>
					<?php } ?>
				</a>
			</div>
			<div class="thz-accordion-content<?php echo $key == 0  && $openonload == 'loadopened' ? ' active-content'.$c_borders : $c_borders; ?>">
				<?php echo $content; ?>
			</div>
		</div>
	<?php endforeach; ?>
</div>