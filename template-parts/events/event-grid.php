<?php
/**
 * @package      Thz Framework
 * @author       Themezly
 * @websites     http://www.themezly.com | http://www.youjoomla.com | http://www.yjsimplegrid.com
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // No direct access
}
$options 		= thz_get_post_option('general-event',null);
$get_content 	= thz_get_the_content();
if( thz_has_builder() ){
	$get_content =  get_the_excerpt();
}
$postclasses 	= array(
	'thz-single-event thz-event-grid',
);
$ev_title			= thz_get_option('ev_title/picked','show');
$ev_title_loc		= thz_get_option('ev_title/show/location','under');
$ev_dt				= thz_get_option('ev_dt/picked','show'); 
$event_opt			= !empty($options['event_children']) ? reset($options['event_children']): array();
$ev_agenda			= thz_get_post_option('ev_agenda',null); 
$ev_odetails		= thz_get_post_option('ev_odetails',null);
$ev_vdetails 		= thz_get_post_option('ev_vdetails',null);
$categories 		= get_the_terms( get_the_ID(),'fw-event-taxonomy-name');
$show_map			= thz_get_post_option('general-event/show_map','show');
$ev_nav				= thz_get_option('enav_mx/v','hide');
$media_height		= thz_get_post_option('media_height/picked','thz-ratio-16-9');
$featured_img		= thz_get_post_option('featured_img','show');
$from 				= '';
$to 				= '';
$event_location		= isset($options['event_location']) ? $options['event_location'] : array('venue'=>'','address'=>'','city'=>'','country'=>'','zip'=>'');
if(!empty($event_opt)){
	$from 			= $event_opt['event_date_range']['from'];
	$to 			= $event_opt['event_date_range']['to'];
}
// sharing links
$show_post_shares	= thz_get_option('ev_shares/picked','show');
$show_sharing_label = thz_get_option('ev_shares/show/sl/picked','show');
$sharing_layout 	= thz_get_option('ev_shares/show/l','separated');
$sharing_label  	= thz_get_option('ev_shares/show/sl/show/l',''); 


if($show_post_shares =='show'){
	$ev_shares_style = thz_get_option('ev_shares/show/im/s','simple');
	$ev_shares_shape = thz_get_option('ev_shares/show/im/sh','square');
	$ev_shares_shclass = $ev_shares_style !='simple' ? ' thz-so-'.$ev_shares_shape :'';
	$ev_shares_class =' thz-so-'.$ev_shares_style.$ev_shares_shclass;
}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class($postclasses); ?>>
	<div class="thz-event-details-row thz-content-row">
        <div class="thz-event-details-holder<?php thz_single_cmx('edetails_mx') ?>">
            <div class="thz-max-holder<?php thz_single_cmx('edetails_mx',true) ?>">
                <div class="thz-event-row thz-row">
                    <div class="thz-event-article thz-event-column thz-column thz-col-1">
                        <div class="thz-event-article-in">
                            <?php if ($ev_title == 'show') { ?>
                            <?php thz_post_title('above',$ev_title_loc,'thz-event-title','h2','under'); ?>
                            <?php  } ?>
                            <?php if($ev_dt == 'show' && $ev_title_loc =='above' && !empty($event_opt)) { ?>
                            <div class="thz-event-date-time">
                                <?php echo thz_events_date($from,$to); ?>
                            </div>
                            <?php  } ?>
                            <?php if ( has_post_thumbnail() && 'show' == $featured_img ) : ?>
                            <div class="thz-event-media-container">
                                <div class="thz-event-media">
                                    <?php thz_post_thumbnail($media_height) ?>
                                </div>
                            </div>
                            <?php endif; ?>
                            <?php if ($ev_title == 'show') { ?>
                            <?php thz_post_title('under',$ev_title_loc,'thz-event-title','h2','under'); ?>
                            <?php  } ?>
                            <?php if($ev_dt == 'show' && $ev_title_loc =='under' && !empty($event_opt)) { ?>
                            <div class="thz-event-date-time">
                                <?php echo thz_events_date($from,$to); ?>
                            </div>
                            <?php  } ?>
                            <div class="thz-event-content">
                                <?php echo $get_content  ?>
                                <?php do_action('fw_theme_ext_events_after_content'); ?>
                            </div>
                            <div class="thz-event-buttons">
                                <button class="button" data-uri="<?php echo add_query_arg( array(
                                    'row_id'   => 0,
                                    'calendar' => 'google'
                                ), fw_current_url() ); ?>" type="button">
                                <?php _e( 'Google Calendar',
                                    'creatus' ) ?>
                                </button>
                            </div>
                            <?php if ( thz_has_shares() && $show_post_shares == 'show') { ?>
                            <div class="thz-post-shares thz-shares-<?php echo thz_sanitize_class($sharing_layout.$ev_shares_class) ?>">
                                <?php if ($show_sharing_label == 'show' && $sharing_label !='') { ?>
                                <div class="thz-post-share-label">
                                    <div class="thz-post-share-label-in">
                                        <?php echo esc_html($sharing_label) ?>
                                    </div>
                                </div>
                                <?php  } ?>
                                <div class="thz-post-share-links">
                                    <div class="thz-post-share-links-in">
                                        <?php thz_core_post_shares(true,false); ?>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
    
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="thz-event-meta-row thz-content-row">
        <div class="thz-event-meta-holder<?php thz_single_cmx('emeta_mx') ?>">
            <div class="thz-max-holder<?php thz_single_cmx('emeta_mx',true) ?>">
                <div class="thz-event-info">
                    <div class="thz-event-info-in">
                        <div class="thz-event-details thz-event-meta-block">
                            <h3 class="thz-event-meta-title">
                                <?php _e( 'Details','creatus' ) ?>
                            </h3>
                            <ul>
                                <li>
                                    <span class="thz-event-info-cell label"><?php _e( 'Date','creatus' ) ?>:</span>
                                    <span class="thz-event-info-cell detail"><?php echo thz_events_date($from,$to,true,false); ?></span>
                                </li>
                                <li>
                                    <span class="thz-event-info-cell label"><?php _e( 'Time','creatus' ) ?>:</span>
                                    <span class="thz-event-info-cell detail"><?php echo thz_events_date($from,$to,false,true); ?></span>
                                </li>
                                <?php if (thz_event_price() !=''){ ?>
                                <li>
                                    <span class="thz-event-info-cell label"><?php _e( 'Price','creatus' ) ?>:</span>
                                    <span class="thz-event-info-cell detail"><?php echo thz_event_price(); ?></span>
                                </li>
                                <?php } ?>
                                <?php if(!empty($categories )){ ?>
                                <li>
                                    <span class="thz-event-info-cell label"><?php _e( 'Categories','creatus' ) ?>:</span>
                                    <span class="thz-event-info-cell detail">
                                    <?php
                                    if(!empty($categories )){
                                        foreach($categories as $cat){
                                            $category_link = get_category_link( $cat->term_id );
                                            $cats_names[]= '<a href="'.esc_url( $category_link ).'" title="'.esc_attr( $cat->name ).'">'.esc_attr( $cat->name ).'</a>';
                                            
                                        }
                                        unset($categories);
                                        $out = implode(', ',$cats_names);
                                        echo $out;
                                    }
                                    ?>
                                    </span>
                                </li>
                                <?php } ?>
                            </ul>
                        </div>
                        <?php if ($ev_odetails['p'] !='' || $ev_odetails['e'] !='' || $ev_odetails['w'] !=''){ ?>
                        <div class="thz-event-organizer thz-event-meta-block">
                            <h3 class="thz-event-meta-title">
                                <?php _e( 'Organizer','creatus' ) ?>
                            </h3>
                            <ul>
                                <?php if (thz_event_organizer() !=''){ ?>
                                <li>
                                    <span class="thz-event-info-cell label"><?php _e( 'Name','creatus' ) ?>:</span>
                                    <span class="thz-event-info-cell detail"><?php echo thz_event_organizer(); ?></span>
                                </li>
                                <?php } ?>
                                <?php if ($ev_odetails['p'] !=''){ ?>
                                <li>
                                    <span class="thz-event-info-cell label"><?php _e( 'Phone','creatus' ) ?>:</span>
                                    <span class="thz-event-info-cell detail"><?php echo $ev_odetails['p'] ?></span>
                                </li>
                                <?php } ?>
                                <?php if ($ev_odetails['e'] !=''){ ?>
                                <li>
                                    <span class="thz-event-info-cell label"><?php _e( 'Email','creatus' ) ?>:</span>
                                    <span class="thz-event-info-cell detail">
                                    <a href="<?php echo thz_protect_email($ev_odetails['e'],true); ?>" target="_blank">
                                        <?php echo thz_protect_email($ev_odetails['e']); ?>
                                    </a>
                                    </span>
                                </li>
                                <?php } ?>
                                <?php if ($ev_odetails['w'] !=''){ ?>
                                <li>
                                    <span class="thz-event-info-cell label"><?php _e( 'Website','creatus' ) ?>:</span>
                                    <span class="thz-event-info-cell detail">
                                    <a href="<?php echo esc_url($ev_odetails['w']) ?>" target="_blank">
                                        <?php echo esc_attr($ev_odetails['w']) ?>
                                    </a>
                                    </span>
                                </li>
                                <?php } ?>
                            </ul>
                        </div>
                        <?php } ?>
                        <?php if ($ev_vdetails['p'] !='' || $ev_vdetails['e'] !='' || $ev_vdetails['w'] !='' || thz_ext_events_render_map() !=''){ ?>
                        <div class="thz-event-venue thz-event-meta-block">
                            <div class="thz-event-venue-info">
                                <h3 class="thz-event-meta-title">
                                    <?php _e( 'Venue','creatus' ) ?>
                                </h3>
                                <ul>
                                    <li>
                                        <span class="thz-event-info-cell detail">
                                            <span class="venue-adress"><?php echo esc_attr($options['event_location']['venue']) ?></span><br />
                                            <span class="venue-adress"><?php echo esc_attr($options['event_location']['address']) ?></span><br />
                                            <span class="venue-adress"><?php echo esc_attr($options['event_location']['city']) ?>, <?php echo esc_attr($options['event_location']['state']) ?></span><br />
                                            <span class="venue-adress"><?php echo esc_attr($options['event_location']['zip']) ?></span><br />
                                            <span class="venue-adress"><?php echo esc_attr($options['event_location']['country']) ?></span>
                                        </span>
                                    </li>
                                    <?php if ($ev_vdetails['p'] !=''){ ?>
                                    <li>
                                        <span class="thz-event-info-cell label"><?php _e( 'Phone','creatus' ) ?>:</span>
                                        <span class="thz-event-info-cell detail"><?php echo esc_attr($ev_vdetails['p']) ?></span>
                                    </li>
                                    <?php } ?>
                                    <?php if ($ev_vdetails['e'] !=''){ ?>
                                    <li>
                                        <span class="thz-event-info-cell label"><?php _e( 'Email','creatus' ) ?>:</span>
                                        <span class="thz-event-info-cell detail">
                                        <a href="<?php echo thz_protect_email($ev_vdetails['e'],true); ?>" target="_blank">
                                            <?php echo thz_protect_email($ev_vdetails['e']); ?>
                                        </a>
                                        </span>
                                    </li>
                                    <?php } ?>
                                    <?php if ($ev_vdetails['w'] !=''){ ?>
                                    <li>
                                        <span class="thz-event-info-cell label"><?php _e( 'Website','creatus' ) ?>:</span>
                                        <span class="thz-event-info-cell detail">
                                            <a href="<?php echo esc_url($ev_vdetails['w']) ?>" target="_blank">
                                                <?php echo esc_attr($ev_vdetails['w']) ?>
                                            </a>
                                        </span>
                                    </li>
                                    <?php } ?>
                                </ul>
                            </div>
                            <?php if ($show_map =='show') {?>
                            <div class="thz-event-map">
                                <?php echo thz_ext_events_render_map(get_the_ID(),450); ?>
                            </div>
                            <?php } ?>
                        </div>
                        <?php } ?>
                    </div>
                </div>            
            </div>
        </div>
    </div>
    
    <?php if (!empty($ev_agenda)){ ?>
    <div class="thz-event-agenda-row thz-content-row">
        <div class="thz-event-agenda-holder<?php thz_single_cmx('eagenda_mx') ?>">
            <div class="thz-max-holder<?php thz_single_cmx('eagenda_mx',true) ?>">
                <div class="thz-event-agenda-container">
                    <h3 class="thz-event-meta-title">
                        <?php _e( 'Agenda','creatus' ) ?>
                    </h3>
                    <ul class="thz-event-agenda">
                        <?php foreach ($ev_agenda as $item ){ ?>
                        <li class="thz-event-agenda-item">
                            <?php if (!empty($item['time'])){ ?>
                            <div class="thz-event-agenda-time">
                                <?php echo thz_ts_date(strtotime($item['time']),get_option('time_format','g:i a')); ?>
                            </div>
                            <?php } ?>
                            <div class="thz-event-agenda-detail">
                                <?php if (!empty($item['title'])){ ?>
                                <div class="thz-event-agenda-title">
                                    <?php echo esc_attr($item['title']); ?>
                                </div>
                                <?php } ?>
                                <?php if (!empty($item['text'])){ ?>
                                <div class="thz-event-agenda-text">
                                    <?php echo do_shortcode( $item['text'] ) ?>
                                </div>
                                <?php } ?>
                            </div>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
     <?php } ?>
    <?php thz_page_block('above_related'); ?>
	<?php thz_related_posts_output('inside') ?>
    <?php thz_page_block('under_related'); ?>
	<?php thz_comments_output('inside'); ?>
	<?php thz_sdata('event',true,true,array($from,$to,$event_location))?>
</article>
<?php thz_single_post_navigation('inside'); ?>