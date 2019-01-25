<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$ext = fw_ext('shortcodes');

wp_enqueue_style(
	'fw-shortcode-calendar-bootstrap3',
	$ext->locate_URI('/shortcodes/calendar/static/libs/bootstrap3/css/bootstrap-grid.css')
);
wp_enqueue_style(
	'fw-shortcode-calendar-calendar',
	$ext->locate_URI('/shortcodes/calendar/static/css/calendar.css')
);
wp_enqueue_style(
	'fw-shortcode-calendar',
	$ext->locate_URI('/shortcodes/calendar/static/css/styles.css')
);


wp_enqueue_script(
	'fw-shortcode-calendar-bootstrap3',
	$ext->locate_URI('/shortcodes/calendar/static/libs/bootstrap3/js/bootstrap.min.js'),
	array( 'jquery', 'underscore' ),
	fw()->manifest->get_version(),
	true
);
wp_enqueue_script(
	'fw-shortcode-calendar-timezone',
	$ext->locate_URI('/shortcodes/calendar/static/libs/jstimezonedetect/jstz.min.js'),
	array( 'jquery', 'underscore' ),
	fw()->manifest->get_version(),
	true
);
wp_enqueue_script(
	'fw-shortcode-calendar-calendar',
	$ext->locate_URI('/shortcodes/calendar/static/js/calendar.js'),
	array( 'jquery', 'underscore', 'fw-shortcode-calendar-bootstrap3', 'fw-shortcode-calendar-timezone' ),
	fw()->manifest->get_version(),
	true
);
wp_enqueue_script(
	'fw-shortcode-calendar',
	$ext->locate_URI('/shortcodes/calendar/static/js/scripts.js'),
	array( 'jquery', 'underscore', 'fw-shortcode-calendar-calendar' ),
	fw()->manifest->get_version(),
	true
);

$locale = get_locale();
wp_localize_script(
	'fw-shortcode-calendar',
	'fwShortcodeCalendarLocalize',
	array(
		'event'  => esc_html__( 'Event', 'creatus' ),
		'events' => esc_html__( 'Events', 'creatus' ),
		'today'  => esc_html__( 'Today', 'creatus' ),
		'locale' => $locale
	)
);
wp_localize_script(
	'fw-shortcode-calendar',
	'calendar_languages',
	array(
		$locale => array(
			'error_noview'     => sprintf( esc_html__( 'Calendar: View %s not found', 'creatus' ), '{0}' ),
			'error_dateformat' => sprintf( esc_html__( 'Calendar: Wrong date format %s. Should be either "now" or "yyyy-mm-dd"',
					'creatus' ), '{0}' ),
			'error_loadurl'    => esc_html__( 'Calendar: Event URL is not set', 'creatus' ),
			'error_where'      => sprintf( esc_html__( 'Calendar: Wrong navigation direction %s. Can be only "next" or "prev" or "today"',
					'creatus' ), '{0}' ),
			'error_timedevide' => esc_html__( 'Calendar: Time split parameter should divide 60 without decimals. Something like 10, 15, 30',
				'creatus' ),
			'no_events_in_day' => esc_html__( 'No events in this day.', 'creatus' ),
			'title_year'       => '{0}',
			'title_month'      => '{0} {1}',
			'title_week'       => sprintf( esc_html__( 'week %1$s of %2$s', 'creatus' ), '{0}', '{1}' ),
			'title_day'        => '{0} {1} {2}, {3}',
			'week'             => esc_html__( 'Week ', 'creatus' ) . '{0}',
			'all_day'          => esc_html__( 'All day', 'creatus' ),
			'time'             => esc_html__( 'Time', 'creatus' ),
			'events'           => esc_html__( 'Events', 'creatus' ),
			'before_time'      => esc_html__( 'Ends before timeline', 'creatus' ),
			'after_time'       => esc_html__( 'Starts after timeline', 'creatus' ),
			'm0'               => esc_html__( 'January', 'creatus' ),
			'm1'               => esc_html__( 'February', 'creatus' ),
			'm2'               => esc_html__( 'March', 'creatus' ),
			'm3'               => esc_html__( 'April', 'creatus' ),
			'm4'               => esc_html__( 'May', 'creatus' ),
			'm5'               => esc_html__( 'June', 'creatus' ),
			'm6'               => esc_html__( 'July', 'creatus' ),
			'm7'               => esc_html__( 'August', 'creatus' ),
			'm8'               => esc_html__( 'September', 'creatus' ),
			'm9'               => esc_html__( 'October', 'creatus' ),
			'm10'              => esc_html__( 'November', 'creatus' ),
			'm11'              => esc_html__( 'December', 'creatus' ),
			'ms0'              => esc_html__( 'Jan', 'creatus' ),
			'ms1'              => esc_html__( 'Feb', 'creatus' ),
			'ms2'              => esc_html__( 'Mar', 'creatus' ),
			'ms3'              => esc_html__( 'Apr', 'creatus' ),
			'ms4'              => esc_html__( 'May', 'creatus' ),
			'ms5'              => esc_html__( 'Jun', 'creatus' ),
			'ms6'              => esc_html__( 'Jul', 'creatus' ),
			'ms7'              => esc_html__( 'Aug', 'creatus' ),
			'ms8'              => esc_html__( 'Sep', 'creatus' ),
			'ms9'              => esc_html__( 'Oct', 'creatus' ),
			'ms10'             => esc_html__( 'Nov', 'creatus' ),
			'ms11'             => esc_html__( 'Dec', 'creatus' ),
			'd0'               => esc_html__( 'Sun', 'creatus' ),
			'd1'               => esc_html__( 'Mon', 'creatus' ),
			'd2'               => esc_html__( 'Tue', 'creatus' ),
			'd3'               => esc_html__( 'Wed', 'creatus' ),
			'd4'               => esc_html__( 'Thu', 'creatus' ),
			'd5'               => esc_html__( 'Fri', 'creatus' ),
			'd6'               => esc_html__( 'Sat', 'creatus' ),
		)
	)
);




/*
	custom css for calendar

*/
if(!function_exists('_thz_calendar_css')){
	
	function _thz_calendar_css ($data) {
	
		$atts 				= _thz_shortcode_options($data,'calendar');
		$id 				= thz_akg('id',$atts);
		$css_id 			= thz_akg('cmx/i',$atts);
		$id_out				= !(empty($css_id)) ? str_replace(' ','',$css_id) : 'thz-calendar-'.$id;
		$add_css 			= '';
		
		$type 				= thz_akg('type/picked',$atts); 
		$style_type			= strpos($type, 'custom') !== false? 'custom':'predefined';
		$bs					= thz_print_box_css(thz_akg('bs',$atts));
		
		
		if($bs !=''){
			$add_css .= '#'.$id_out.'.thz-calendar-wrapper.thz-shc{';
			$add_css .= $bs;
			$add_css .='}';
		}

		if($style_type == 'predefined'){
			
				
			
				if($type == 'day'){
					
					
					$calendar			= thz_akg('type/day/calendar',$atts);
					$row_even			= thz_akg('type/day/row_even',$atts);
					$row_odd			= thz_akg('type/day/row_odd',$atts);
		
					$dayc_border_size 	= thz_akg('border_size',$calendar);
					$dayc_border_style	= thz_akg('border_style',$calendar);
					$dayc_border_color	= thz_akg('border_color',$calendar);
					$dayc_background	= thz_akg('background',$calendar);
					$dayc_color			= thz_akg('color',$calendar);
		
					
					$re_border_size 	= thz_akg('border_size',$row_even);
					$re_border_style	= thz_akg('border_style',$row_even);
					$re_border_color	= thz_akg('border_color',$row_even);
					$re_background		= thz_akg('background',$row_even);
					$re_color			= thz_akg('color',$row_even);
					
								
					$ro_border_size 	= thz_akg('border_size',$row_odd);
					$ro_border_style	= thz_akg('border_style',$row_odd);
					$ro_border_color	= thz_akg('border_color',$row_odd);
					$ro_background		= thz_akg('background',$row_odd);
					$ro_color			= thz_akg('color',$row_odd);
					
					$day_event_links	= thz_akg('event_links',$atts);	
					$day_link_color		= thz_akg('color',$day_event_links);		
					$day_link_hovered	= thz_akg('hovered',$day_event_links);	
					
					if($day_link_color !=''){
						$add_css 		.= '#'.$id_out.' a{';
						$add_css 		.= 'color:'.$day_link_color.';';
						$add_css 		.= '}';
					}
					if($day_link_hovered !=''){
						$add_css 		.= '#'.$id_out.' a:hover{';
						$add_css 		.= 'color:'.$day_link_hovered.';';
						$add_css 		.= '}';				
					}
					
					$add_css 		.= '#'.$id_out.' .thz-calendar{';
					if($dayc_border_size > 0 && $dayc_border_color !=''){
						$add_css 		.='border:'.$dayc_border_size.'px '.$dayc_border_style.' '.$dayc_border_color.';';
					}
					if($dayc_background !=''){
						$add_css 		.='background:'.$dayc_background.';';
					}
					if($dayc_color !=''){
						$add_css 		.='color:'.$dayc_color.';';
					}
					$add_css 		.='}';
					
								
					$add_css 		.= '#'.$id_out.' .row-fluid:nth-child(even){';
					$add_css 		.='border-bottom:'.$re_border_size.'px '.$re_border_style.' '.$re_border_color.';';
					$add_css 		.='}';
					
					$add_css 		.= '#'.$id_out.' .cal-day-hour:nth-child(even){';
					$add_css 		.='background:'.$re_background.';';
					$add_css 		.='color:'.$re_color.';';
					$add_css 		.='}';
					
					$add_css 		.= '#'.$id_out.' .time-col{';
					$add_css 		.='border-right:'.$ro_border_size.'px '.$ro_border_style.' '.$ro_border_color.';';
					$add_css 		.='}';
					
					$add_css 		.= '#'.$id_out.' .row-fluid:nth-child(odd){';
					$add_css 		.='border-bottom:'.$ro_border_size.'px '.$ro_border_style.' '.$ro_border_color.';';
					$add_css 		.='}';
					
					$add_css 		.= '#'.$id_out.' .cal-day-hour:nth-child(odd){';
					$add_css 		.='background:'.$ro_background.';';
					$add_css 		.='color:'.$ro_color.';';
					$add_css 		.='}';
				}
				
				
				if($type == 'week'){
					
					$day_settings			= thz_akg('type/week/day_settings',$atts);
					$day_border_size		= thz_akg('border_size',$day_settings);
					$day_border_style		= thz_akg('border_style',$day_settings);
					$day_border_color		= thz_akg('border_color',$day_settings);
					$day_background			= thz_akg('background',$day_settings);
					$day_color				= thz_akg('color',$day_settings);
					
					$today_settings			= thz_akg('type/week/today_settings',$atts);
					$today_background		= thz_akg('background',$today_settings);
					$today_color			= thz_akg('color',$today_settings);			
					
					
					
					$date_settings			= thz_akg('type/week/date_settings',$atts);	
					$date_color				= thz_akg('color',$date_settings);
					$date_hovered			= thz_akg('hovered',$date_settings);
					
							
					$event_links			= thz_akg('type/week/event_links',$atts);
					$day_link_color			= thz_akg('color',$event_links);		
					$day_link_hovered		= thz_akg('hovered',$event_links);
					
		
					if($day_link_color !=''){
						$add_css 		.= '#'.$id_out.' a{';
						$add_css 		.= 'color:'.$day_link_color.';';
						$add_css 		.= '}';
					}
					if($day_link_hovered !=''){
						$add_css 		.= '#'.$id_out.' a:hover{';
						$add_css 		.= 'color:'.$day_link_hovered.';';
						$add_css 		.= '}';				
					}
		
					$add_css 		.= '#'.$id_out.' .week-days{';
					$add_css 		.='border-right:'.$day_border_size.'px '.$day_border_style.' '.$day_border_color.';';
					$add_css 		.='border-bottom:'.$day_border_size.'px '.$day_border_style.' '.$day_border_color.';';
					$add_css 		.='background:'.$day_background.';';
					$add_css 		.='color:'.$day_color.';';
					$add_css 		.='}';
					
					
					$add_css 		.= '#'.$id_out.' [data-event-class]{';
					$add_css 		.='background:'.$day_background.';';
					$add_css 		.='margin-bottom:'.$day_border_size.'px;';
					$add_css 		.='}';
					
					$add_css 		.= '#'.$id_out.' .week-days small{';
					$add_css 		.='color:'.$date_color.';';
					$add_css 		.='}';			
					
					
					$add_css 		.= '#'.$id_out.' .week-days small:hover{';
					$add_css 		.='color:'.$date_hovered.';';
					$add_css 		.='}';	
					
					
					$add_css 		.= '#'.$id_out.' .cal-day-today,';
					$add_css 		.= '#'.$id_out.' .cal-day-today small,';
					$add_css 		.= '#'.$id_out.' .cal-day-today small:hover{';
					$add_css 		.='background:'.$today_background.';';
					$add_css 		.='color:'.$today_color.';';
					$add_css 		.='}';
					
				}
				
				
				if($type == 'month'){
					
					$day				= thz_akg('type/month/day',$atts);
					$day_border_size		= thz_akg('border_size',$day);
					$day_border_style		= thz_akg('border_style',$day);
					$day_border_color		= thz_akg('border_color',$day);
					$day_background			= thz_akg('background',$day);
					$day_color				= thz_akg('color',$day);
					
					
					
					$day_hovered		= thz_akg('type/month/day_hovered',$atts);
					$hovered_background	= thz_akg('background',$day_hovered);
					$hovered_color		= thz_akg('color',$day_hovered);
					
					
					
					$event_day			= thz_akg('type/month/event_day',$atts);
					$event_background	= thz_akg('background',$event_day);
					$event_color		= thz_akg('color',$event_day);			
					
					
					
					$header_settings	= thz_akg('type/month/header_settings',$atts);
					$header_background	= thz_akg('background',$header_settings);
					$header_color		= thz_akg('color',$header_settings);
					
					
					
					$event_links		= thz_akg('type/month/event_links',$atts);
					
					
					
					$day_link_color			= thz_akg('color',$event_links);		
					$day_link_hovered		= thz_akg('hovered',$event_links);
					
		
					if($day_link_color !=''){
						$add_css 		.= '#'.$id_out.' a{';
						$add_css 		.= 'color:'.$day_link_color.';';
						$add_css 		.= '}';
					}
					if($day_link_hovered !=''){
						$add_css 		.= '#'.$id_out.' a:hover{';
						$add_css 		.= 'color:'.$day_link_hovered.';';
						$add_css 		.= '}';				
					}
					
					
					
					
					
					
					$add_css 		.= '#'.$id_out.' .month-days{';
					$add_css 		.='border-right:'.$day_border_size.'px '.$day_border_style.' '.$day_border_color.';';
					$add_css 		.='border-bottom:'.$day_border_size.'px '.$day_border_style.' '.$day_border_color.';';
					$add_css 		.='background:'.$day_background.';';
					$add_css 		.='color:'.$day_color.';';
					$add_css 		.='}';			
					
					
					
					
					$add_css 		.= '#'.$id_out.' .month-header-days{';
					$add_css 		.='border-bottom:'.$day_border_size.'px '.$day_border_style.' '.$day_border_color.';';
					$add_css 		.='background:'.$header_background.';';
					$add_css 		.='color:'.$header_color.';';
					$add_css 		.='}';				
					
					
					
					$add_css 		.= '#'.$id_out.' .event-day{';
					$add_css 		.='background:'.$event_background.';';
					$add_css 		.='color:'.$event_color.';';
					$add_css 		.='}';
					
					
					$add_css 		.= '#'.$id_out.' .cal-day-today,';
					$add_css 		.= '#'.$id_out.' .cal-month-day:hover{';
					$add_css 		.='background:'.$hovered_background.';';
					$add_css 		.='color:'.$hovered_color.';';
					$add_css 		.='}';			
					
					
					
				}
				
				if($add_css  !=''){
					Thz_Doc::set( 'cssinhead', $add_css );
				}
		}
	}
	
	if( !thz_is_inline_css_cached() ){
		add_action('fw_ext_shortcodes_enqueue_static:calendar','_thz_calendar_css');
	}

}

