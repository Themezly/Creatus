<?php if (!defined('FW')) die('Forbidden');

/**
 * @var WP_Post $item
 * @var string $title
 * @var array $attributes
 * @var object $args
 * @var int $depth
 * @var FW_Extension_Megamenu $megamenu
 */

$attributes['class'] = array();
$megamenu 		= fw()->extensions->get('megamenu');
$show_icon 		='';
$child_icon 	='';
$id 			= $item->ID;
$item_type 		= fw_ext_mega_menu_get_db_item_option($id,'type');
$thumb 			= false;
$mode 			= false;
$widget 		= false;
$button			= false;
$separator		= false;
$column_link 	= 'link';
$show_title		= 'show';
$addthumb		= '';
$donotlink		= '';

if($item_type =='column'){
	
	$mode  			= fw_ext_mega_menu_get_db_item_option($id,'column/mode',null);
	$thumb 			= $mode !='thumb' ? false : fw_ext_mega_menu_get_db_item_option($id,'column/thumb',null);
	$widget 		= fw_ext_mega_menu_get_db_item_option($id,'column/widget',null);
	$parent_id 		= $item-> menu_item_parent;
	$column_link 	= fw_ext_mega_menu_get_db_item_option($id,'column/link',$column_link,null);
	
}

if($item_type =='default' || $item_type =='item'){
	
	$show_title = fw_ext_mega_menu_get_db_item_option($id,$item_type.'/di_mx/t','show');
	$button 	= fw_ext_mega_menu_get_db_item_option($id,$item_type.'/button');
	$separator  = fw_ext_mega_menu_get_db_item_option($id,$item_type.'/di_mx/m','d') == 's' ? true : false;
	
	if(!empty($button)){
		
		$btn_attrbs		= array();
		$btn_target		= isset($attributes['target']) ? $btn_attrbs[] = 'target="'.$attributes['target'].'"' :'';
		$btn_title		= isset($attributes['title']) ? $btn_attrbs[] = 'title="'.$attributes['title'].'"' :'';
		$btn_attrbs_p	= !empty($btn_attrbs) ? ' '.implode(' ',$btn_attrbs) : '';

		$button_print	='<div id="thz-custom-menu-button-'.esc_attr($id).'" class="thz-custom-menu-button">';
		$button_print	.= str_replace('href="#"','href="'.$attributes['href'].'"'.$btn_attrbs_p,$button[0]['btn']['html']);
		$button_print	.='</div>';
		
		$button = $button_print;
	}
	
}

if($column_link == 'donotlink'){
	$attributes['href'] = '#';
	$attributes['class'][]= 'donotlink';
	$donotlink = ' donotlink';
}

// set icon if exists
if ($megamenu->show_icon()) {
	if ($icon = fw_mega_menu_get_meta($item, 'icon')) {
		$show_icon ='<i class="'.$icon.'"></i> ';
	}
}
// set default link class
if (empty($attributes['class'])) {
	$attributes['class'][]= 'itemlink';
}


// active path 
if($item->current || $item->current_item_parent || $item->current_item_ancestor){
	$attributes['class'][]= 'activepath';
}

// linkholder
$spanclass = 'linkholder';
if(in_array('menu-item-has-children',$item->classes)){
	
	$spanclass 	= 'linkholder child';
	$tl_icon 	= $childicons['tl'];
	$sl_icon 	= $childicons['sl'];
	$level  	= $childicons['level'];
	
	if($level== 0 && !empty($tl_icon)){
		
		$child_icon ='<i class="childicon child-toplevel '.$tl_icon.'"></i>';
		
	}elseif($level!= 0 && !empty($sl_icon)){
		
		$child_icon='<i class="childicon child-sublevel '.$sl_icon.'"></i>';
	}

}

// groups / column title 
if(in_array('mega-menu-col',$item->classes) && $depth != 2){
	$attributes['class'][]= !empty($thumb ) ? 'has-thumbnail holdsgroupTitle citem' :'holdsgroupTitle citem';
	$spanclass = 'linkholder'.$donotlink;
	$child_icon ='';
}

if($separator){
	$attributes['class'][]= 'items-separator citem';
	$spanclass = 'linkholder donotlink';
	$child_icon ='';	
}


// set default link holder
$args->before ='<span class="'. $spanclass .'">';
$args->after ='</span>';

if(!empty($thumb ) && $mode =='thumb'){
	$addthumb .='<span class="menu-column-thumb-holder">';
	$addthumb .='<img src="'.esc_url($thumb['url']).'" alt="'.$title.'" />';
	$addthumb .='</span>';
}

$attributes['class'] = implode(' ',$attributes['class']);


if($depth > 0){
	$title = '<span class="item-title">'.$title.'</span>';
}

if( 
	'hide' == $show_title 
	|| 
	( fw_ext_mega_menu_get_meta($item, 'title-off') 
	&& 
	!empty( $thumb ) && $mode =='thumb') )
	
{
	
	$title = '';
}

if($item_type =='column' && $widget && $mode =='widget'){

	dynamic_sidebar( $widget );
	
} else {
	
	// Make a menu WordPress way
	
	if($button){
		
		echo $button;
		
	}else{
		
		echo $args->before;
		echo fw_html_tag('a', $attributes, $args->link_before . $show_icon . $title . $child_icon . $addthumb . $args->link_after);
		echo $args->after;	
		
	}
	
}