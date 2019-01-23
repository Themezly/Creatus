<?php
/**
 * @package      Thz Framework
 * @author       Themezly
 * @license      http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 * @websites     http://www.themezly.com | http://www.youjoomla.com | http://www.yjsimplegrid.com
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // No direct access
}
 
 /**
 Requires associative or JSON string array. Use as:
$array= array(
	'layout' => array(
		'display' => 'default',
		'float' => 'default',
		'clear' => 'default',
		'overflow' => 'default',
		'opacity' => '',
		'visibility' => 'default',
		'position' => 'default',
		'top' => 'auto',
		'right' => 'auto',
		'bottom' => 'auto',
		'left' => 'auto',
		'z-index' => 'auto',
	),
	'padding' => array(
		'top' => '0',
		'right' => '0',
		'bottom' => '0',
		'left' => '0'
	),
	'margin' => array(
		'top' => '100',
		'right' => 'auto',
		'bottom' => '0',
		'left' => 'auto'
	),
	'borders' => array(
		'all'=> 'same',			
		'top'=> array(
			'w' => 0,
			's' => 'solid',
			'c' => ''
		),
		'right'=> array(
			'w' => 0,
			's' => 'solid',
			'c' => ''
		),
		'bottom'=> array(
			'w' => 0,
			's' => 'solid',
			'c' => ''
		),
		'left'=> array(
			'w' => 0,
			's' => 'solid',
			'c' => ''
		)
	),
	'boxsize' => array(
		'width' => '',
		'height' => '580px',
		'min-width' => '33%',
		'min-height' => '250px',
		'max-width' => '250px',
		'max-height' => '250px'
	),
	'borderradius' => array(
		'top-left' => 1,
		'top-right' => 0,
		'bottom-left' => 0,
		'bottom-right' => 0,
	),

	'boxshadow' => array(),
	'transform' => array(
		'rotate' => '',
		'scale-x' => '',
		'scale-y' => '',
		'skew-x' => '',
		'skew-y' => '',
		'translate-x' => '',
		'translate-y' => '',
	),
	'background' => array(
		'type' => 'gradient', // none,color,image,gradient,video
		'color' => '#ff0000',
		'image' => 'DaVinciCode.jpg',
		'repeat' => 'no-repeat',
		'position' => 'center-top',
		'size' => 'auto',
		'attachment' => 'scroll',
		'gradient-style' => 'linear', // linear, radial
		'gradient-angle' => '0',
		'gradient-size' => 'farthest-corner',//closest-corner, closest-side,farthest-corner,farthest-side
		'gradient-shape' => 'circle',//circle,ellipse
		'gradient-h-poz' => '50',
		'gradient-v-poz' => '50',
		'gradient-start' => '0',
		'gradient-start-color' => '#ffffff',
		'gradient-add-stop' => array	(
			'0' => array(
				'custom-stop-start' => '25',
				'custom-stop-color' => '#eeee22'
			),
			'1' => array(
				'custom-stop-start' => '50',
				'custom-stop-color' => '#8224e3'
			)
		),
		'gradient-end' => '75',
		'gradient-end-color' => '#00A3EF',
		'video-poster' => '',
		'video-link' => '',
	),
	'boxtextcolors' => array(
		'text_color' => '#ff6600',
		'link_color' => '#f53232',
		'link_hover_color' => '#cccccc',
		'headings_color' => '#000000'
	)
);
$print_css 	= new Thz_Css_Generator();
$json_array = json_encode( $array );
print_r($print_css->generate_css($json_array,true));
print_r($print_css->generate_css( $array ));
print_r($print_css->box_height($json_value,true));
print_r($print_css->box_height( $array ));
 
 */


class Thz_Css_Generator{

	
	/**
	 * Print all CSS
	 */
	public function generate_css($array,$json = false){
		
		if($json){
			
			$array = json_decode($array, true);
			
		}
		
		if(!is_array( $array )) {
			return;
		}
		
		
		$printcss = $this->print_css( $array );
		
		return $printcss;
	}
	
	
	/**
	 * Return print
	 */	
	public function print_css( $array ){
		
		$printcss = $this->layout( $array );
		$printcss .= $this->padding( $array );
		$printcss .= $this->margin( $array );
		$printcss .= $this->borders( $array );
		$printcss .= $this->box_size( $array );
		$printcss .= $this->border_radius( $array );
		$printcss .= $this->box_shadow( $array );
		$printcss .= $this->transform( $array );
		$printcss .= $this->background( $array );
		
		return $printcss;
	}
	
	
	/**
	 * Generate layout CSS
	 */		
	public function layout ( $array ){


		if(!isset($array['layout']) 
		|| !is_array($array['layout'])){
			 return;
		}
		
		$layout = array();
		$numerics = array('top','right','bottom','left','z-index');
		$hasposition = true;
		
			
		if( 
		( isset($array['layout']['position']) 
		&& ( $array['layout']['position'] == 'static' || $array['layout']['position'] == 'default' )) || !isset($array['layout']['position']) )
		{
			
			unset($array['layout']['top'],$array['layout']['right'],$array['layout']['bottom'],$array['layout']['left'],$array['layout']['z-index']);
			$hasposition = false;
		}
			
		
		foreach($array['layout'] as $p => $v){

			
			if($v =='default' || $v ==''){
				continue;	
			}
			
			if($hasposition && in_array($p,$numerics)){
				
				
				
				if($p =='z-index'){
					
					$elv = $v == 'auto' ? 'auto' : (int)$v;
					
				}else{
					
					$elv = $this->property_unit($v,'px',true);
				}
				
				
			}else{
				
				$elv = $v;
				
			}
			

			if($p =='overflow' && strpos($v, '-') !== false){
				
				$osplit = explode('-',$v);
				
				$p = 'overflow-'.$osplit[0];
				$elv = $osplit[1];
			}
			
			
			if($p =='opacity'){
				
				$elv = $this->property_unit($v,'');
			}

			$layout[] = $p.':'.$elv.';';
		}
		
		if(!empty($layout)){
			return implode('',$layout);
		}

	}
	
	/**
	 * Generate padding CSS
	 */	
	public function padding ( $array ){
		
		if(!isset($array['padding'],
				$array['padding']['top'],
				$array['padding']['right'],
				$array['padding']['bottom'],
				$array['padding']['left']
		) 
		|| !is_array($array['padding'])
		|| in_array('', $array['padding'],true)) {
			return;
		}
		
		$padding 	= array();
		$shorthand  = in_array('none',$array['padding'],true) ? false: true;
		
		foreach($array['padding'] as $k => $v){
			
			if('none' === $v){
				continue;
			}
			
			if($shorthand){
				
				$padding[$k] = $this->property_unit($v,'px');
				
			}else{
				
				$padding[$k] = 'padding-'.$k.':'.$this->property_unit($v,'px').';';
			}

		}
		
		return $shorthand ? 'padding:'.implode(' ',$padding).';' : implode('',$padding);
		
	}	
	
	
	/**
	 * Generate margin CSS
	 */		
	public function margin ( $array ){
		
		if(!isset($array['margin'],
				$array['margin']['top'],
				$array['margin']['right'],
				$array['margin']['bottom'],
				$array['margin']['left']
		) 
		|| !is_array($array['margin'])
		|| in_array('', $array['margin'],true)) {
			return;
		}


		$margin 	= array();
		$shorthand  = in_array('none',$array['margin'],true) ? false: true;
		
		foreach($array['margin'] as $k => $v){
			
			if('none' === $v){
				continue;
			}
			
			if($shorthand){
				
				$margin[$k] = $this->property_unit($v,'px',true);
				
			}else{
				
				$margin[$k] = 'margin-'.$k.':'.$this->property_unit($v,'px',true).';';
			}

		}
		
		return $shorthand ? 'margin:'.implode(' ',$margin).';' : implode('',$margin);
		
	}	


	/**
	 * Generate border 
	 */	
	public function borders ( $array ){
		
		
		if(!isset($array['borders']) 
		|| !is_array($array['borders'])) {
			return;
		}
		
		$allb_same		= $array['borders']['all'];
		$borders    	= array();
		$border_print 	= '';
		
		if($allb_same == 'separate'){
			
			foreach($array['borders'] as $p => $v){
				
				if($p =='all'){
					continue;
				}
				
				$borders['w'][] = $v['w'] =='' ? 0 : $this->property_unit($v['w'],'px');
				$borders['s'][] = $v['s'];
				$borders['c'][] = $v['c'] == '' ? 'transparent' : $v['c'];	
	
			}
		
		}
		
		if($allb_same =='same'){
			
			$w = $array['borders']['top']['w'] == '' ? 0 : $array['borders']['top']['w'];
			$c = $array['borders']['top']['c'] == '' ? 'transparent' : $array['borders']['top']['c'];
			
			$border_print .= 'border-width:'.$this->property_unit($w,'px').';';
			$border_print .= 'border-style:'.$array['borders']['top']['s'].';';
			$border_print .= 'border-color:'.$c.';';	
			
						
			
		}else if(!empty($borders)){
			
			$same_w = array_unique($borders['w']);
			$same_s = array_unique($borders['s']);
			$same_c = array_unique($borders['c']);
			
			$w = count($same_w) == 1 ? $borders['w'][0] : implode(' ',$borders['w']);
			$s = count($same_s) == 1 ? $borders['s'][0] : implode(' ',$borders['s']);
			$c = count($same_c) == 1 ? $borders['c'][0] : implode(' ',$borders['c']);
			
			
			$border_print .= 'border-width:'.$w.';';
			$border_print .= 'border-style:'.$s.';';
			$border_print .= 'border-color:'.$c.';';			

		}
			
		return $border_print;
			
	}
	
	
	
	/**
	 * Generate border radius
	 */	
	public function border_radius ( $array ){
		
		
		if(!isset($array['borderradius']) 
		|| !is_array($array['borderradius'])) {
			return;
		}
		
		$all_values    = array();
		$border_radius = array();
		
		foreach($array['borderradius'] as  $v){
			
			$all_values[]   	= $v;
			$border_radius[] 	= $this->property_unit($v,'px');
		}
		
		
		$all_same = array_unique($all_values);
		
		if(count($all_same) == 1){
			return 'border-radius:'.$this->property_unit($all_same[0],'px').';';
		}
		
		
		return 'border-radius:'.implode(' ',$border_radius).';';
				

	}	
	
	/**
	 * Generate boxsize CSS
	 */		
	public function box_size ( $array ){


		if(!isset($array['boxsize']) 
		|| !is_array($array['boxsize'])){
			 return;
		}
		
		$boxsize = array();
		
		foreach($array['boxsize'] as $p => $v){
			
			if(empty($v)){
				continue;	
			}

			$boxsize[] = $p.':'.$this->property_unit($v,'px',true,true).';';
		}
		
		if(!empty($boxsize)){
			return implode('',$boxsize);
		}

	}
	
		
	/**
	 * Generate box shadow
	 */	
	public function box_shadow_single ( $array ){
		
		
		if(!isset($array['boxshadow']) 
		|| !is_array($array['boxshadow'])
		|| !$array['boxshadow']['active']
		|| empty($array['boxshadow']['shadow-color'])
		) {
			return;
		}
		

		$inset 			= $array['boxshadow']['inset'] == 'inset' ? 'inset ' : '';
		$hoffset		= (int)$array['boxshadow']['horizontal-offset'].'px ';
		$voffset		= (int)$array['boxshadow']['vertical-offset'].'px ';
		$blurRadius		= (int)$array['boxshadow']['blur-radius'].'px ';
		$spreadRadius	= (int)$array['boxshadow']['spread-radius'].'px ';
		$shadowColor	= $array['boxshadow']['shadow-color'];
		
		$box_shadow = 'box-shadow:'.$inset.$hoffset.$voffset.$blurRadius.$spreadRadius.$shadowColor.';';
				
		return $box_shadow;
	}
	
	
	
	/**
	 * Generate multiple box shadows
	 */	
	public function box_shadow ( $array ){
		
		
		if(!isset($array['boxshadow']) 
		|| !is_array($array['boxshadow']) ) {
			return;
		}
		
		if( isset($array['boxshadow']['box_shadow_css'])) {
			unset($array['boxshadow']['box_shadow_css']);
				
		}
		
		if( empty($array['boxshadow'])) {
			return;
		}
		
				
		$shadow_css	  = array();
		$color_empty  = false;
		
		foreach ($array['boxshadow'] as $key => $shadow){
		
			$inset 			= $shadow['inset'] ? 'inset ' : '';
			$hoffset		= (int)$shadow['horizontal-offset'].'px ';
			$voffset		= (int)$shadow['vertical-offset'].'px ';
			$blurRadius		= (int)$shadow['blur-radius'].'px ';
			$spreadRadius	= (int)$shadow['spread-radius'].'px ';
			$shadowColor	= $shadow['shadow-color'];
			
			
			if(empty($shadowColor)){
				$color_empty = true;
			}
			
			$shadow_css[]   = $inset.$hoffset.$voffset.$blurRadius.$spreadRadius.$shadowColor;
		
		
		}
		
		
		if( $color_empty ){
			
			return;	
		}
		
		$box_shadow = 'box-shadow:'.implode(',',$shadow_css).';';
				
		return $box_shadow;
	}
	
	
	/**
	 * Generate CSS transform
	 */	
	public function transform ( $array ){
		
		
		if(!isset($array['transform']) 
		|| !is_array($array['transform']) ) {
			return;
		}
		
		if( empty($array['transform'])) {
			return;
		}
		
		$transforms 		= $array['transform'];		
		$transfrom_css	  	= array();
		
		
		if( isset($transforms['rotate']) ){
			
			$transfrom_css['rotate']   = 'rotate('.(float)$transforms['rotate'].'deg)';
			
		}
		
		$scale_x = isset($transforms['scale-x']) ? $transforms['scale-x'] : 0;
		$scale_y = isset($transforms['scale-y']) ? $transforms['scale-y'] : 0;
		
		
		if( $scale_x || $scale_y ){
			
			$transfrom_css['scale']   = 'scale('.(float)$scale_x.', '.(float)$scale_y.')';
		}
		
		$skew_x = isset($transforms['skew-x']) ? $transforms['skew-x'] : 0;
		$skew_y = isset($transforms['skew-y']) ? $transforms['skew-y'] : 0;
		
		
		if( $skew_x || $skew_y ){
			
			$transfrom_css['skew']   = 'skew('.(float)$skew_x.'deg, '.(float)$skew_y.'deg)';
		}
		
		$translate_x = isset($transforms['translate-x']) ? $transforms['translate-x'] : 0;
		$translate_y = isset($transforms['translate-y']) ? $transforms['translate-y'] : 0;
		
		
		if( $translate_x  || $translate_y ){
			
			$transfrom_css['translate']   = 'translate('.$this->property_unit($translate_x,'px').', '.$this->property_unit($translate_y,'px').')';
		}


		$transfrom = $this->property_prefix( 'transform: '.implode(' ',$transfrom_css).';');
		
		return $transfrom;
	}
	

	/**
	 * Generate background CSS
	 */	
	public function background ( $array ){
		
		
		if(!isset($array['background']) || !is_array($array['background'])){
			 return;
		}
		
		$bg_type		= isset($array['background']['type']) ? $array['background']['type']:false;
		
		if($bg_type == 'none') {
			return;
		}
		
		$background				= '';
		
		$bg_color			= isset($array['background']['color']) ? $array['background']['color']:false;
		$bg_image			= isset($array['background']['image']) ? $array['background']['image']:false;
		$bg_image			= is_array($bg_image) && isset($bg_image['url']) ? $bg_image['url'] : $bg_image;
		$bg_repeat			= isset($array['background']['repeat']) ? $array['background']['repeat']:false;
		$bg_position		= isset($array['background']['position']) ? $array['background']['position']:false;
		$bg_size			= isset($array['background']['size']) ? $array['background']['size']:false;
		$bg_attachment		= isset($array['background']['attachment']) ? $array['background']['attachment']:false;
		
	
		if($bg_color){
			$background .="background-color:".$bg_color.";";
		}
		
		if($bg_type == 'image' && $bg_image){
			

			if($bg_image !='featured'){

				$bg_image = defined( 'ABSPATH' ) ? esc_url($bg_image) : $bg_image;
				$background .="background-image:url(".$bg_image.");";
			}
			
			if($bg_repeat){
				$background .="background-repeat:".$bg_repeat.";";
			}
			
			if($bg_position){
				$background .="background-position:".str_replace('-',' ',$bg_position).";";
			}
			
			if($bg_size){
				$background .="background-size:".$bg_size.";";
			}
			
			if($bg_attachment){
				$background .="background-attachment:".$bg_attachment.";";
			}
		}

		if($bg_type == 'gradient'){
			
			$gradient_style 		= $array['background']['gradient-style'];
			
			$angle 					= $array['background']['gradient-angle'];
			$gradient_angle 		= (-1 * $angle).'deg,';
			$w3c_angle 				= ($angle - 90 < 360 ? $angle + 90: 90).'deg,';
			
			$gradient_size		 	= $array['background']['gradient-size'];
			$gradient_shape		 	= $array['background']['gradient-shape'];
			$gradient_h_poz		 	= $array['background']['gradient-h-poz'];
			$gradient_v_poz		 	= $array['background']['gradient-v-poz'];
			
			$gradient_start 		= $array['background']['gradient-start'];
			$gradient_start_color 	= $array['background']['gradient-start-color'];
			$gradient_add_stop		= isset($array['background']['gradient-add-stop']) ? $array['background']['gradient-add-stop']:array();
			$gradient_end 			= $array['background']['gradient-end'];
			$gradient_end_color	 	= $array['background']['gradient-end-color'];
			$custom_stop			= '';
			

			
			if(empty($gradient_start_color) || empty($gradient_end_color)) return;

			if(is_array($gradient_add_stop) && !empty($gradient_add_stop)){
				
				$custom_stop = array();
				
				foreach($gradient_add_stop as $key => $customstop){
					
					$custom_stop[] = $customstop['custom-stop-color'].' '.$customstop['custom-stop-start'].'%';
					
				}
				
			}
			
			if(is_array($custom_stop)){
				$custom_stop = ' '.implode(',',$custom_stop).',';
			}

			
			if($gradient_style == 'radial'){

				$gradient_angle =''.$gradient_h_poz.'% '.$gradient_v_poz.'%,'.$gradient_shape.' '.$gradient_size.','; 
				$w3c_angle 		=''.$gradient_shape.' '.$gradient_size.' at '.$gradient_h_poz.'% '.$gradient_v_poz.'%,';
			}


			$gradient 		= ''.$gradient_angle.$gradient_start_color.' '.$gradient_start.'%,'.$custom_stop.$gradient_end_color.' '.$gradient_end.'%';
			$w3cgradient 	= ''.$w3c_angle.$gradient_start_color.' '.$gradient_start.'%,'.$custom_stop.$gradient_end_color.' '.$gradient_end.'%';
			
			$background  ='background: '.$gradient_start_color.';';
			$background .='background: -moz-'.$gradient_style.'-gradient('.$gradient.');';
			$background .='background: -webkit-'.$gradient_style.'-gradient('.$gradient.');';
			$background .='background: -o-'.$gradient_style.'-gradient('.$gradient.');';
			$background .='background: -ms-'.$gradient_style.'-gradient('.$gradient.');';
			$background .='background: '.$gradient_style.'-gradient('.$w3cgradient.');';
		

			
		}
		
		
		
		if($bg_type == 'video'){
			
			$bg_video_poster 	= isset($array['background']['video-poster']) ? $array['background']['video-poster']: null;
			$bg_video_poster	= is_array($bg_video_poster) && isset($bg_video_poster['url']) ? $bg_video_poster['url'] : $bg_video_poster;
			 
			if(!empty($bg_video_poster)){

				$bg_video_poster 	= defined( 'ABSPATH' ) ? esc_url($bg_video_poster) : $bg_video_poster;
				$background 		.="background-image:url(".$bg_video_poster.");";
				$background 		.="background-repeat:no-repeat;";
				$background 		.="background-size:cover;";
				$background 		.="background-position:center top;";
			}
		}
		
		if(!empty($background)){
			return $background;
		}
	}
	
	/**
	 * Generate box colors CSS
	 */	
	public function box_text_colors ( $array, $container ){
		
		if(!isset($array['boxtextcolors']) 
		|| !is_array($array['boxtextcolors'])
		) {
			return;
		}
		
		
		$text_color			= isset($array['boxtextcolors']['text_color']) ? $array['boxtextcolors']['text_color'] : null ;
		$link_color			= isset($array['boxtextcolors']['link_color']) ? $array['boxtextcolors']['link_color'] : null ;
		$link_hover_color	= isset($array['boxtextcolors']['link_hover_color']) ? $array['boxtextcolors']['link_hover_color'] : null ;
		$headings_color		= isset($array['boxtextcolors']['headings_color']) ? $array['boxtextcolors']['headings_color'] : null ;
		
		$box_colors 		= '';

		if($text_color){
			$box_colors 	.= $container.'{color:'.$text_color.';}';
		}
		
		if($link_color){
			$box_colors 	.= $container.' a{color:'.$link_color.';}';
		}
		
		if($link_hover_color){
			$box_colors 	.= $container.' a:hover{color:'.$link_hover_color.';}';
		}

		if($headings_color){
			$box_colors 	.= $container.' h1,';
			$box_colors 	.= $container.' h2,';
			$box_colors 	.= $container.' h3,';
			$box_colors 	.= $container.' h4,';
			$box_colors 	.= $container.' h5,';
			$box_colors 	.= $container.' h6{color:'.$link_hover_color.';}';
		}
		
		if(!empty( $box_colors  )){				
			return $box_colors;
		}
	}
	
	/**
	 * Get box height including padding, margin and border
	 */	
	public function box_height ($array, $json = false){
		
		if($json){
			
			$array = json_decode($array, true);
			
		}
		
		if(!is_array( $array )) {
			return;
		}

		$properties 	= array();
		$border 		= array();
		$height			= isset($array['boxsize']['height']) ? $array['boxsize']['height']: 0;
		$paddingtop		= isset($array['padding']['top']) ? $array['padding']['top']: 0;
		$paddingbottom	= isset($array['padding']['bottom']) ? $array['padding']['bottom']: 0;
		$borderwidth	= isset($array['border']['width']) ? $array['border']['width'] : 0;
		$borderall		= isset($array['borderside']['all']) ? $array['borderside']['all'] : false;
		$bordertop		= isset($array['borderside']['top']) ? $array['borderside']['top'] : false;
		$borderbottom	= isset($array['borderside']['bottom']) ? $array['borderside']['bottom'] : false;

		if($borderall){
			$border[] = $borderwidth * 2;
		}
		if($bordertop && !$borderall){
			$border[] = $borderwidth;
		}
		if($borderbottom && !$borderall){
			$border[] = $borderwidth;
		}
		
		$properties['height']	= $height;
		$properties['padding'] 	= $paddingtop + $paddingbottom;
		$properties['border'] 	= array_sum( $border );
		
		return array_sum( $properties ).'px';
			
	}



	/**
	* Browser prefix
	* returns prefixed CSS value
	*/
	
	public function property_prefix ( $val ){
		
		$property = $val;
		$property .= '-webkit-'.$val;
		$property .= '-mos-'.$val;
		$property .= '-o-'.$val;
		
		return $property;
	}

	/**
	* Check element operator
	* returns clean number with specified unit
	*/
	
	public function property_unit ($val,$default,$auto = false,$none = false){
		
		if($val === '') {
			return;
		}
		
		if($auto){
		
			if (strpos($val, 'auto') !== false) { 
				return 'auto';
			}			
			
		}	
		
		if($none){
		
			if (strpos($val, 'none') !== false) { 
				return 'none';
			}			
			
		}
		
		$allowed = array('px','%','rem','em','vw','vh','vmin','vmax');	
		
		$value 	= (float) esc_attr($val);
		$unit 	= $default;
		
		foreach($allowed as $allowed_unit){
			
			if (strpos($val, $allowed_unit) !== false) { 
				
				$unit = $allowed_unit;
				break;
			}
		}
		
		unset($allowed,$allowed_unit);
		
		return $value.$unit;
		
	}
}