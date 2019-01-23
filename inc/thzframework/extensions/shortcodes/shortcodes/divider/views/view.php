<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}
$id					= thz_akg('id',$atts);
$css_id 			= thz_akg('cmx/i',$atts);
$id_out				= !empty($css_id) ? str_replace(' ','',$css_id): 'thz-divider-'.$id;
$css_class 			= thz_akg('cmx/c',$atts);
$css_class			= $css_class !='' ? $css_class.' ':'';
$res_class			= _thz_responsive_classes(thz_akg('cmx',$atts));
$animate			= thz_akg('animate',$atts);
$animation_data		= thz_print_animation($animate);
$animation_class	= thz_print_animation($animate,true);
$cpx				= thz_akg('cpx',$atts);
$cpx_data			= thz_print_cpx($cpx);
$cpx_class			= thz_print_cpx($cpx,true);
$type  				= thz_akg('divider_type',$atts);
$style				= thz_akg('style/picked',$atts); 
$divider_poz		= thz_akg('style/'.$style.'/divider_position',$atts);
$holder				= $type ==='horizontal' ? ' thz-divider-holder' :' thz-divider-spacer';
$template			= '';

/* none */
if($style === 'none'){
	$template .='<div class="thz-divider"></div>';
}

/* line */
if($style === 'line'){
	
	$line_type 		= thz_akg('style/line/linetype/picked',$atts); 
	$divider_icon 	= thz_akg('style/line/divider_icon/picked',$atts);
	$icon 			= thz_akg('style/line/divider_icon/show/icon_metrics/icon',$atts);
	

	if($divider_icon ==='show' && !empty($icon)){
		
		$icon_position 	= thz_akg('style/line/divider_icon/show/icon_position',$atts); 
		
		if($icon_position === 'left'){
			
			$classes = 'thz-divider-hasicon thz-divider-'.$line_type.' thz-di-left '.$divider_poz;
			
			$template .='<div class="'.thz_sanitize_class($classes).'">';
				$template .='<span class="thz-divider-icon '.thz_sanitize_class($icon).'"></span>';
				$template .='<span class="thz-divider-left"></span>';
				$template .='<span class="thz-divider-right"></span>';
			$template .='</div>';
			
		}elseif($icon_position === 'right'){
			
			$classes = 'thz-divider-hasicon thz-divider-'.$line_type.' thz-di-right '.$divider_poz;
			
			$template .='<div class="'.thz_sanitize_class($classes).'">';
				$template .='<span class="thz-divider-left"></span>';
				$template .='<span class="thz-divider-right"></span>';
				$template .='<span class="thz-divider-icon '.thz_sanitize_class($icon).'"></span>';
			$template .='</div>';
			
			
		}else{
			
			$classes = 'thz-divider-hasicon thz-divider-'.$line_type.' '.$divider_poz;
			
			$template .='<div class="'.thz_sanitize_class($classes).'">';
				$template .='<span class="thz-divider-left"></span>';
				$template .='<span class="thz-divider-icon '.thz_sanitize_class($icon).'"></span>';
				$template .='<span class="thz-divider-right"></span>';
			$template .='</div>';
			
		}

	}else{
		
		$classes = 'thz-divider thz-divider-'.$line_type.' '.$divider_poz;
		$template .='<div class="'.thz_sanitize_class($classes).'"></div>';
	}
		
}

/* dualcolor */
if($style === 'dualcolor'){
	
	$short_position  = thz_akg('style/dualcolor/short_position',$atts); 
	$classes = 'thz-divider thz-divider-dualcolor '.$short_position.' '.$divider_poz;
	$template .='<div class="'.thz_sanitize_class($classes).'"></div>';
	
}


/* shadow */
if($style === 'shadow'){
	
	
	$divider_icon 	= thz_akg('style/shadow/divider_icon/picked',$atts);
	$icon 			= thz_akg('style/shadow/divider_icon/show/icon_metrics/icon',$atts);
	
	
	if($divider_icon ==='show' && !empty($icon)){
		
		$classes = 'thz-divider-hasicon thz-divider-has-icon-shadow '.esc_attr($divider_poz);
		
		$template .='<div class="'.thz_sanitize_class($classes).'">';
			$template .='<span class="thz-divider-left"></span>';
			$template .='<span class="thz-divider-icon '.thz_sanitize_class($icon).'"></span>';
			$template .='<span class="thz-divider-right"></span>';
		$template .='</div>';
		
	}else{
		
		$classes = 'thz-divider thz-divider-shadow '.esc_attr($divider_poz);
		$template .='<div class="'.thz_sanitize_class($classes).'"></div>';
	}
	
}

$classes = $css_class.'thz-shc thz-divider-'.$id.$holder.$animation_class.$cpx_class.$res_class;
?>
<?php if ($type === 'horizontal'){ ?><div class="thz-clear"></div><?php } ?>
<div id="<?php echo esc_attr($id_out)?>" class="<?php echo thz_sanitize_class($classes)?>"<?php echo thz_sanitize_data($animation_data.$cpx_data); ?>><?php echo $template ?></div>