<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}
$id					= thz_akg('id',$atts);
$css_id 			= thz_akg('cmx/i',$atts);
$id_out				= !empty($css_id) ? str_replace(' ','',$css_id): 'thz-shortcode-list-'.$id;
$css_class 			= thz_akg('cmx/c',$atts);
$css_class			= $css_class !='' ? $css_class.' ':'';
$instyle			= thz_akg('instyle',$atts);
$instyle			= $instyle !='' ? $instyle.' ':'';
$res_class			= _thz_responsive_classes(thz_akg('cmx',$atts));
$animate			= thz_akg('animate',$atts);
$cpx				= thz_akg('cpx',$atts);
$items				= thz_akg('items',$atts);
$type				= thz_akg('type/picked',$atts,'default');
$tag 				= 'ul';
$icon_data 			= false;
$custom_data		= array(
	'animate' => $animate,
	'cpx' => $cpx
);

if($type =='ordered'){
	$tag = 'ol';
}

if($type =='icons'){
	
	$icon_data = array(
		'icon' => thz_akg('type/icons/icon/icon',$atts,null),
		'ip' => thz_akg('type/icons/ip',$atts,'left')
	);
}

$class = $instyle.$css_class.'thz-shc thz-'.$type.'-list '.$id_out.$res_class;
?>
<?php echo thz_build_list($items,$tag,$id_out,$class,$icon_data,$custom_data); ?>