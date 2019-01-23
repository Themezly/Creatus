<?php
/**
 * @package      Thz Framework
 * @author       Themezly
 * @websites     http://www.themezly.com | http://www.youjoomla.com | http://www.yjsimplegrid.com
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // No direct access
}

$options 			= thz_get_post_option('general-event',null);
$event_opt			= !empty($options['event_children']) ? reset($options['event_children']): array();
$columns 			= thz_get_theme_option('ev_grid/columns',1);
$media_height		= thz_get_theme_option('ev_mh/picked','thz-ratio-16-9'); 
$image_size 		= thz_get_theme_option('ev_is','thz-img-medium');
$thumb_id 			= get_post_thumbnail_id( $post->ID );
$img_src 			= thz_get_img_src( $thumb_id, $image_size ); 
$show_button		= thz_get_theme_option('ev_style/show_button/picked','hide');
$item_link 			= get_permalink();
$item_more_button	= $show_button =='show' ? str_replace('href="#"','href="'.$item_link.'"',thz_get_theme_option('ev_style/show_button/show/button/html')):'';
$show_introtext		= thz_get_theme_option('ev_style/show_it/picked','show');
$from				= '';
$to					= '';

if($show_introtext =='show'){
	$limit_by			= thz_get_theme_option('ev_style/show_it/show/itl/picked','words');
	$limit_lenght		= thz_get_theme_option('ev_style/show_it/show/itl/'.$limit_by.'/limit',40);
}
$postclasses = array(
	'thz-grid-item',
	'thz-events-item',
	thz_col_width( $columns ,3),
);
?>
<article id="post-<?php the_ID(); ?>"<?php post_class($postclasses); ?>>
	<div class="thz-grid-item-in">
		<?php if ( has_post_thumbnail()) : ?>
		<div class="thz-grid-item-media-holder"> 
			<div class="thz-grid-item-media">
				<?php thz_post_thumbnail($media_height,$img_src,false,true) ?>
			</div>
		</div>
		<?php endif; ?>
		<div class="thz-events-intro">
			<h2 class="entry-title thz-grid-item-title">
				<a href="<?php echo  esc_url( get_permalink() ) ?>" rel="bookmark">
					<?php echo get_the_title() ?>
				</a>
			</h2>
			<?php if ( !empty( $event_opt ) ) : ?>
			<ul class="thz-events-meta">
				<?php if ( !empty( $event_opt['event_date_range']['from'] ) ) : ?>
				<li class="thz-event-date">
				<?php 
					$from 	= $event_opt['event_date_range']['from'];
					$to 	= $event_opt['event_date_range']['to'];
					echo thz_events_date($from,$to);
				?>
				</li>
				<?php endif; ?>
				<?php if ( !empty( $options['event_location']['city'] ) ) : ?>
				<li class="thz-event-location">
				<?php 
				$city 		=  $options['event_location']['city'];
				$country 	=  $options['event_location']['country'];
				$location	=  empty($country) ? esc_attr($city) : esc_attr($city).', '.esc_attr($country);
				echo $location ?>
				</li>
				<?php endif; ?>
			</ul>
			<?php endif; ?>
			<?php if($show_introtext =='show'): if(thz_intro_text($limit_by,$limit_lenght) !=''){?>
				<div class="thz-events-intro-text">
				<?php echo thz_intro_text($limit_by,$limit_lenght); ?>
				</div>
			<?php } endif; ?>
			<?php if($show_button == 'show' ): ?>
			<div class="thz-grid-item-button">
				<?php echo thz_btn_print ( $item_more_button );	?>
			</div>
			<?php endif; ?>
		</div>
	</div><?php thz_sdata('event',true,true,array($from,$to,$options['event_location']))?>
</article>