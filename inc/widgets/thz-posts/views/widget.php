<?php
/**
 * @package      Thz Framework
 * @author       Themezly
 * @websites     http://www.themezly.com | http://www.youjoomla.com | http://www.yjsimplegrid.com
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // No direct access
}
/**
 * @var $instance
 * @var $before_widget
 * @var $after_widget
 * @var $title
 */
 
$number	 		= (int) $instance['number'];
$mode			= $instance['mode'];
$posts			= isset($instance['posts']) ? array_keys( $instance['posts'] ) : array('post');
$cats			= isset($instance['cats']) ? array_keys( $instance['cats'] ) : array();
$order			= $instance['order'];
$orderby		= $instance['orderby'];
$date			= isset($instance['metrics']['date']) ? true : false;
$thumbnail  	= isset($instance['metrics']['thumbnail']) || 'thumbnails' == $mode ? true : false;
$thumbnail_only = isset($instance['metrics']['thumbnail_only']) ? true : false;
$showtitle  	= isset($instance['metrics']['showtitle']) ? true : false;
$intro_text  	= isset($instance['metrics']['intro_text']) ? true : false;
$intro_limit_by	= $intro_text ? $instance['intro_limit_by'] : 'words';
$intro_limit	= $intro_text ? $instance['intro_limit'] : 20;
$title_tag		= $instance['title_tag']; 
$thumbpoz		= ' thumbnail-'.$instance['thumbpoz'];
$thumbnail_size = $instance['thumbnail_size'];
$ratio			= $instance['ratio'];
$col			= (int) $instance['col'];
$gut			= (int) $instance['gut'];
$ul_class		= ' thz-ml-n'.$gut;
$top_gut 		= '';
$li_class		= ' '.thz_col_width( $col, 4 ).' thz-pl-'.$gut;

echo $before_widget;
echo $title;

$args = array(
  'posts_per_page'  => $number,
  'post_type'  		=> $posts,
  'tax_query'  		=> thz_post_tax_query( $cats,array(),$posts ),
  'order'			=> $order,
  'orderby'			=> $orderby,
  'ignore_sticky_posts' => true,
  'date_query'		=> thz_date_query_helper($instance['days'])
);


if('meta_value' == $orderby){
	
	$args['meta_key'] = 'thz_post_views';
}

if('thumbnails' == $mode || $thumbnail_only){
	
	$args['meta_query'] = array( 
        array(
            'key' => '_thumbnail_id'
        ) 
    );
}




$posts_query 	= new WP_Query( $args );


if ($posts_query->have_posts()) :

$counter = 0;
?>
<ul class="thz-posts-widget-list<?php if( 'thumbnails' == $mode ) { echo thz_sanitize_class($ul_class); } ?>">
<?php while ( $posts_query->have_posts() ) : $counter++; $posts_query->the_post(); 
	
	if ('thumbnails' == $mode && $counter > $col){
		$top_gut =' thz-pt-'.$gut;
	}
?>
    <li class="thz-posts-widget-item<?php if( 'thumbnails' == $mode ) { echo thz_sanitize_class($li_class.$top_gut); } ?>">
    <div class="post-holder<?php if( 'list' == $mode ) { echo thz_sanitize_class($thumbpoz); } ?>">
			<?php 
                $thumbnail_print 	= null;
				if ( $thumbnail ) {
                    
                    $thumbnail_id 		= get_post_thumbnail_id( get_the_ID() );
                    
                    if(!empty($thumbnail_id)){

                        $img_src 			= get_the_post_thumbnail_url( get_the_ID(), $thumbnail_size );
						$hover_bgtype		= thz_ov_ef('.thz-posts-widget-list','background/type');
                        $hover_ef 			= thz_ov_ef('.thz-posts-widget-list','oeffect');
                        $hover_tr 			= thz_ov_ef('.thz-posts-widget-list','oduration');
                        $img_ef				= thz_ov_ef('.thz-posts-widget-list','ieffect');
                        $img_tr 			= thz_ov_ef('.thz-posts-widget-list','iduration');			
                        
                        $style 				= ' style="background-image:url('.esc_url ( $img_src ).');"';
                        $hover_classes 		= 'thz-hover thz-hover-img-mask thz-hover-bg-'.$hover_bgtype.' '.$hover_ef.' '.$img_ef.' '.$img_tr;
                        
                        
                        $thumbnail_print .='<div class="post-thumbnail">';
                        $thumbnail_print .='<div class="thz-aspect '.$ratio.'">';
                        $thumbnail_print .='<div class="thz-ratio-in">';
                        $thumbnail_print .='<div class="'.thz_sanitize_class($hover_classes).'"'.$style.'>';
                        $thumbnail_print .='<div class="thz-hover-mask '.$hover_tr.'">';
                        $thumbnail_print .='<div class="thz-hover-mask-table">';
                        $thumbnail_print .='<a href="'.get_the_permalink().'" class="thz-hover-link" title="'.get_the_title().'"></a>';
                        $thumbnail_print .='</div>';
                        $thumbnail_print .='</div>';
                        $thumbnail_print .='</div>';	
                        $thumbnail_print .='</div>';
                        $thumbnail_print .='</div>';
                        $thumbnail_print .='</div>';
                        
						if($instance['thumbpoz'] == 'left' || $instance['thumbpoz'] == 'above'){
                        	echo $thumbnail_print;
						}
                    }
                }
             ?>
             <?php if('list' == $mode ) : ?>
            <div class="post-data">
                <<?php echo esc_attr($title_tag)?> class="post-title">
                	<a href="<?php the_permalink(); ?>"><?php get_the_title() ? the_title() : the_ID(); ?></a>
                </<?php echo esc_attr($title_tag)?>>
                <?php if ( $date ) : ?>
                <span class="post-date"><?php echo get_the_date(); ?></span>
                <?php endif; ?>
                <?php if ( $intro_text ) : ?>
                <div class="post-intro-text"><?php echo thz_intro_text($intro_limit_by,$intro_limit); ?></div>
                <?php endif; ?>
            </div>
            <?php endif; ?>
			<?php 
				if($thumbnail_print && ( $instance['thumbpoz'] == 'right' || $instance['thumbpoz'] == 'under')){
					echo $thumbnail_print;
				}
			?>
    	</div>
    </li>
<?php  endwhile; ?>
</ul>
<?php wp_reset_postdata(); 	endif; echo $after_widget; ?>