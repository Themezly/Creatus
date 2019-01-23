<?php
/**
 * @package      Thz Framework
 * @author       Themezly
 * @websites     http://www.themezly.com | http://www.youjoomla.com | http://www.yjsimplegrid.com
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // No direct access
}

$tax 		= get_post_taxonomies();
$tax 		= isset($tax[0]) ? $tax[0] : false;
$prefix		= 'pr_';

if($tax){

	$post_type	= get_post_type();
	if($post_type =='fw-portfolio'){
		
		$default_text 	= esc_html__( 'Related Projects', 'creatus');
		$heading_text	= thz_get_option('prr_ht',$default_text );
		$relh_mx 		= 'prel_mx';
		$prefix			= 'prr_';
		$hover_ovc		= '.thz-fw-portfolio-related-holder';
		
	}else if($post_type =='fw-event'){
		
		$default_text 	= esc_html__( 'Related Events', 'creatus');
		$heading_text	= thz_get_option('er_ht',$default_text );
		$relh_mx 		= 'erel_mx';
		$prefix			= 'er_';
		$hover_ovc		= '.thz-fw-event-related-holder';
		
	}else{
		
		$default_text 	= esc_html__( 'Related Posts', 'creatus');
		$heading_text	= thz_get_option('pr_ht',$default_text );
		$relh_mx 		= 'brel_mx';
		$hover_ovc		= '.thz-post-related-holder';
	}
	
	$items 				  = thz_get_option($prefix.'type/slider/layout/items',8);
	$related_layout 	  = thz_get_option($prefix.'type/slider/layout',null);
	$related_animation 	  = thz_get_option($prefix.'type/slider/animation',null);
	$slick_data 		  = thz_slick_data($related_layout,$related_animation);
	$slidesToShow		  = thz_akg('show',$related_layout,1);
	$heading_classes 	  = 'thz-related-heading';	
	$multiple			  = $slidesToShow > 1 ? ' thz-slick-show-multiple' :'';	
	$related_items		  = thz_related_posts($post_type,$tax,$items);
	
	$rel_media		 	  = thz_get_option($prefix.'media/picked','show');
	$rel_title 	 	 	  = thz_get_option($prefix.'title/picked','show');
	$rel_intro		 	  = thz_get_option($prefix.'intro/picked','show');
	$align		 	 	  = 'full';
	
	if($rel_media =='show'){
		$align		 	 = thz_get_option($prefix.'media/show/align/picked','full');
		$hover_bgtype	 = thz_ov_ef($hover_ovc,'background/type');
		$hover_ef 		 = thz_ov_ef($hover_ovc,'oeffect');
		$hover_tr 		 = thz_ov_ef($hover_ovc,'oduration');
		$img_ef	     	 = thz_ov_ef($hover_ovc,'ieffect');
		$img_tr 		 = thz_ov_ef($hover_ovc,'iduration');
		$title_ef 		 = thz_ov_ef($hover_ovc,'iceffect');
		$title_tr 		 = thz_ov_ef($hover_ovc,'icduration');
		$rel_ind		 = thz_get_option($prefix.'media/show/rel_ind/picked','icon');
		$icon			 = thz_get_option($prefix.'media/show/rel_ind/icon/icon/icon',''); 
		$hover_classes  = 'thz-hover-bg-'.$hover_bgtype.' '.$hover_ef.' '.$img_ef.' '.$img_tr;
		$title_classes  = $title_ef.' '.$title_tr;
	
	}
	
	if($rel_intro =='show'){
		$limit_by		= thz_get_option($prefix.'intro/show/intro_length/picked','words');
		$limit_length	= thz_get_option($prefix.'intro/show/intro_length/'.$limit_by.'/limit',10);
	}
?>
<?php if ( $related_items->have_posts()) : ?>
<div class="thz-<?php echo esc_attr($post_type) ?>-related-row thz-related-posts-row thz-content-row">
    <div class="thz-<?php echo esc_attr($post_type) ?>-related-holder<?php thz_single_cmx($relh_mx) ?>">
        <div class="thz-max-holder<?php thz_single_cmx($relh_mx,true) ?>">
            <div class="thz-related-holder">
                <h3 class="<?php echo thz_sanitize_class($heading_classes) ?>"><?php echo esc_html( $heading_text ) ?></h3>
                <div class="thz-slick-holder<?php echo esc_attr( $multiple )?>">
                    <div class="thz-slick-slider thz-slick-active thz-slick-initiating"<?php echo thz_sanitize_data($slick_data)?>>
                        <?php  while ( $related_items->have_posts() ): $related_items->the_post(); ?>
                        <div class="thz-slick-slide" data-type="image">
                            <div class="thz-slick-slide-in">
                                <div class="thz-related-item-box thz-related-box-<?php echo thz_sanitize_class($align) ?>">
                                    <?php if(($rel_title =='show' || $rel_intro =='show') && $align =='right'){ ?>
                                    <div class="thz-related-intro-holder">
                                        <?php if($rel_title =='show'){ ?>
                                        <h3 class="thz-related-item-title">
                                            <a href="<?php echo get_the_permalink() ?>">
                                                <?php echo get_the_title() ?>
                                            </a>
                                        </h3>
                                        <?php } ?>
                                        <?php if($rel_intro =='show'){?>
                                        <div class="thz-related-intro-text">
                                            <?php echo $introtext_print ?>
                                        </div>
                                        <?php } ?>
                                    </div>
                                    <?php } ?>
                                    <?php if($rel_media =='show'){ 
                                    
                                        $thumbnail_id 	= thz_related_image(false,true);
                                        $hover_style = 'style="background-image:url('.thz_related_image(false).');"';
                                    ?>
                                    <div class="thz-related-media thz-media-custom-size">
                                        <div class="thz-ratio-in">
                                            <div class="thz-hover thz-hover-img-mask <?php echo thz_sanitize_class($hover_classes) ?>" <?php echo $hover_style ?>>
                                                <div class="thz-hover-mask <?php echo thz_sanitize_class($hover_tr) ?>">
                                                    <div class="thz-hover-mask-table">
                                                        <a href="<?php echo get_the_permalink() ?>" class="thz-hover-link">
                                                        </a>
                                                        <div class="thz-hover-icons <?php echo thz_sanitize_class($title_classes) ?>">
                                                            <a href="<?php echo get_the_permalink() ?>" class="thz-hover-icon">
                                                                <?php if($rel_ind =='title'){ ?>
                                                                <?php echo get_the_title() ?>
                                                                <?php }else if($icon !=''){ ?>
                                                                <span class="<?php echo thz_sanitize_class($icon) ?>"></span>
                                                                <?php } ?>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>
                                    <?php if(($rel_title =='show' || $rel_intro =='show') && $align !='right'){ ?>
                                    <div class="thz-related-intro-holder">
                                        <?php if($rel_title =='show'){ ?>
                                        <h3 class="thz-related-item-title">
                                            <a href="<?php echo get_the_permalink() ?>">
                                                <?php echo get_the_title() ?>
                                            </a>
                                        </h3>
                                        <?php } ?>
                                        <?php if($rel_intro =='show'){ ?>
                                        <div class="thz-related-intro-text">
                                            <?php echo thz_intro_text($limit_by,$limit_length); ?>
                                        </div>
                                        <?php } ?>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div><?php endwhile;wp_reset_postdata(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; 

}// end if tax
?>