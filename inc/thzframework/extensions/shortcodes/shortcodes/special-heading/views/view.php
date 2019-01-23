<?php if (!defined('FW')) die( 'Forbidden' );
/**
 * @var $atts
 */
$id 				= thz_akg('id',$atts);
$css_id 			= thz_akg('cmx/i',$atts);
$id_out				= !empty($css_id) ? str_replace(' ','',$css_id): 'thz-sh-'.$id;
$css_class 			= thz_akg('cmx/c',$atts);
$css_class			= $css_class !='' ? $css_class.' ':'';
$instyle			= thz_akg('instyle',$atts);
$instyle			= $instyle !='' ? $instyle.' ':'';
$res_class			= _thz_responsive_classes(thz_akg('cmx',$atts));
$tag				= thz_akg('tag',$atts);
$heading			= thz_akg('heading',$atts); 
$heading_strip		= thz_akg('hm/s',$atts,'active');
$style				= thz_akg('style',$atts);
$pos				= thz_akg('slm/pos',$atts);
$slm_tc				= $style == 'sideline'? ' thz-sh-sl-type-'.thz_akg('slm/type',$atts):'';		
$show_sub			= thz_akg('shsub/picked',$atts);
$sub_location		= thz_akg('shsub/show/metrics/loc',$atts);
$sub_text			= thz_akg('shsub/show/text',$atts);
$sub_strip			= thz_akg('shsub/show/metrics/strip',$atts);
$animate			= thz_akg('animate',$atts);
$animation_data		= thz_print_animation($animate);
$animation_class	= thz_print_animation($animate,true);
$cpx				= thz_akg('cpx',$atts);
$cpx_data			= thz_print_cpx($cpx);
$cpx_class			= thz_print_cpx($cpx,true);
$parts				= _thz_special_heading_parts( thz_akg('hp',$atts,null));
$classes			= $instyle.$css_class.'thz-shc thz-heading '.$id_out.' thz-sh-'.$style.' thz-sh-pos-'.$pos.$slm_tc.$animation_class.$cpx_class.$res_class;
$html  				= '';
$sub				= '';
$gr_mode 			= thz_akg('gr/mode',$atts,'inactive');
$heading_t			= $heading_strip =='active' ? thz_p2br( strip_tags( do_shortcode ( $heading ),'<p><br><span><b><strong><a><i><em>')) : do_shortcode ( $heading ); 
$heading 			= thz_akg('hb',$parts).$heading_t.thz_akg('ha',$parts);


if($show_sub =='show'){
	
	$sub_t	 = $sub_strip =='active' ? strip_tags ( do_shortcode ( $sub_text ),'<br><span><b><strong><a><i><em>' ) : do_shortcode ( $sub_text );
	$sub_heading = thz_akg('sb',$parts).$sub_t.thz_akg('sa',$parts);
	$sub_tag	 = thz_akg('shsub/show/metrics/tag',$atts,'div'); 
	if(!empty($sub_heading)){
		$sub	.= '<'.$sub_tag.' class="thz-sh-sub">';	
		$sub	.= $sub_heading;
		$sub	.= '</'.$sub_tag.'>';
	}
}
if($sub_location =='above' && $show_sub =='show'){
	$html .=$sub;
}
if ($style == 'sideline' && $pos !='right'){
	$html .= '<span class="thz-sh-ls"></span>';
}
if(!empty($heading)){
	$html .= '<'.$tag.' class="thz-heading-title">';
	
	if('active' == $gr_mode){
		$html .= '<span class="thz-gradient-text">';
	}
	$html .= $heading;
	
	if('active' == $gr_mode){
		$html .= '</span>';
	}
	
	$html .= '</'.$tag.'>';
}
if ($style == 'sideline' && $pos !='left'){
	$html .= '<span class="thz-sh-rs"></span>';
}
if ($style == 'underline'){
	$html .= '<span class="thz-sh-line"></span>';	
}
if($sub_location =='under' && $show_sub =='show'){
	$html .= $sub;
}
?>
<div id="<?php echo esc_attr($id_out); ?>" class="<?php echo thz_sanitize_class( $classes ) ?>"<?php echo thz_sanitize_data($animation_data.$cpx_data)?>>
	<div class="thz-heading-holder">
		<?php if ($style == 'textbefore'): ?>
			<div class="thz-heading-textbefore"><?php echo thz_html_trans(esc_textarea($textbefore)); ?></div>
		<?php endif; ?>
		<?php echo $html; ?>
		<?php if ($style == 'textafter'): ?>
			<div class="thz-heading-textafter"><?php echo thz_html_trans(esc_textarea($textafter)); ?></div>
		<?php endif; ?>
	</div>
</div>