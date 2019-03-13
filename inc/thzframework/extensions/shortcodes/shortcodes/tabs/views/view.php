<?php if (!defined('FW')) die( 'Forbidden' );

if(count($atts['tabs']) < 1){
	
	$n_title 	= esc_html__('Shortcode tabs missing','creatus');
	$n_msg 		= esc_html__('Please go in tab settings and add minimum one tab','creatus');
	thz_notify('yellow thz-shc',$n_title,$n_msg);
	return;
}

$id 				= thz_akg('id',$atts); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.OverrideProhibited
$css_id 			= thz_akg('cmx/i',$atts);
$id_out				= !empty($css_id) ? str_replace(' ','',$css_id): 'thz-tabs-'.$id;
$css_class 			= thz_akg('cmx/c',$atts);
$css_class			= $css_class !='' ? $css_class.' ':'';
$res_class			= _thz_responsive_classes(thz_akg('cmx',$atts));
$animate			= thz_akg('animate',$atts);
$animation_data		= thz_print_animation($animate);
$animation_class	= thz_print_animation($animate,true);
$cpx				= thz_akg('cpx',$atts);
$cpx_data			= thz_print_cpx($cpx);
$cpx_class			= thz_print_cpx($cpx,true);
$tabs_layout		= thz_akg('tabl/lay',$atts,'top');
$above				= ($tabs_layout !='left' && $tabs_layout !='right' ) ? ' thz-tabs-above' :'';
$tabs_count			= ' thz-tabs-count-'.count($atts['tabs']); 
$tabs_mainc			= 'thz-tabs-'.thz_akg('id',$atts);
$l_space			= thz_akg('tabl/lsp',$atts,0);
$l_bradius			= thz_akg('tabl/lbr',$atts,0);
$has_radius			= $l_bradius > 0  && ($tabs_layout !='left' && $tabs_layout !='right') ? ' thz-tabl-radius' : ' thz-tabl-noradius';
$has_space			= $l_space > 0 && ($tabs_layout =='top' || $tabs_layout =='centered') ? ' thz-tabl-space' : ' thz-tabl-nospace';
$c_classes			= $css_class.'thz-shc thz-shortcode-tabs thz-tabs-'.$tabs_layout.$above.$tabs_count.$has_space.$has_radius.' '.$tabs_mainc.$animation_class.$cpx_class.$res_class;

//Note: space before and after li removed to fix browser default display-inline space
?>
<div id="<?php echo esc_attr($id_out); ?>" class="<?php echo thz_sanitize_class($c_classes); ?>"<?php echo thz_sanitize_data($animation_data.$cpx_data); ?>>
	<ul class="thz-tabs-menu">
		<?php foreach ($atts['tabs'] as $key => $tab) :  // phpcs:ignore WordPress.WP.GlobalVariablesOverride.OverrideProhibited ?><li class="tab-li-<?php echo $id.'-'.$key;?> <?php echo $key == 0 ? 'thz-active-tab' : 'thz-inactive-tab'; ?>">
			<a class="thz-tab-button" href="#<?php echo $tabs_mainc . '-' .$key; ?>">
				<?php 
					
					$icon = thz_akg('imx/i',$tab);
					$icon_l = '';
					$icon_r = '';
					
					if(!empty($icon)){
						$poz  = thz_akg('imx/p',$tab);
						$icon_html = '<span class="'.thz_sanitize_class($icon).' tab-ic-'.$poz.'"></span>';
						if($poz =='right'){
							$icon_r = $icon_html;
						}else{
							$icon_l = $icon_html;
						}
					}
									
					echo $icon_l.esc_attr($tab['tab_title']).$icon_r; 
				?>
			</a>
		</li><?php endforeach;?>
	</ul>
	<?php foreach ( $atts['tabs'] as $key => $tab ) : // phpcs:ignore WordPress.WP.GlobalVariablesOverride.OverrideProhibited 
	
			$ctype  			= thz_akg('ctype',$tab,'editor');
			if('editor' == $ctype){
				$tab_content  	= thz_akg('tab_content',$tab);
				$content = do_shortcode($tab_content);
			}else{
				$page_blocks = thz_akg('page_blocks',$tab); 
				$content = thz_print_page_blocks( $page_blocks,'thz-tabs-pageblocks', false );
				
			}
	?>
	<div id="<?php echo $tabs_mainc . '-' .$key; ?>" class="thz-tab-content<?php echo $key == 0 ? ' thz-tabs-active-content' : ' thz-tabs-inactive-content'; ?>">
		<div class="thz-tab-content-inner">
			<?php echo $content; ?>
		</div>
	</div>
	<?php endforeach; ?>
</div>