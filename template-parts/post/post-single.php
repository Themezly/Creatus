<?php
/**
 * @package      Thz Framework
 * @author       Themezly
 * @websites     http://www.themezly.com | http://www.youjoomla.com | http://www.yjsimplegrid.com
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // No direct access
}

$post_format 		= get_post_format();
$item_media 		= !$post_format ? 'catview' : $post_format;
$media_layout		= thz_get_post_option('media_layout/picked','slider');
$show_post_media	= $post_format ? 'show' : thz_get_option('bpm/picked','show');
$show_post_title	= thz_get_option('bpt/picked','show');
$show_post_meta		= thz_get_option('bpme/picked','show');
$show_post_footer	= thz_get_option('bpfo/picked','show');
$show_post_tags		= thz_get_option('bptags/picked','hide');
$show_post_nav		= thz_get_option('bnav_mx/v','show');
$show_post_author	= thz_get_option('bpau/picked','show');
$show_post_shares	= thz_get_option('bps/picked','show');
$show_sharing_label = thz_get_option('bps/show/sl/picked','show');
$sharing_layout 	= thz_get_option('bps/show/layout','separated');
$sharing_label  	= thz_get_option('bps/show/sl/show/l',''); 
$title_location  	= thz_get_option('bpt/show/single_title_location',null);
$meta_location   	= thz_get_option('bpme/show/loc',null);
$meta_elements		= thz_get_option('bpme/show/me',null); 
$footer_elements	= thz_get_option('bpfo/show/fe',null);
$separator			= thz_get_option('ps_sep',null);
$separator			= thz_get_separator ($separator,'thz-meta-separator');
$left_separator 	= $sharing_layout == 'leftsided' ? '<span class="thz-sharing-sep"></span>' : '' ;

$meta_elements['separator'] 	= $separator;
$footer_elements['separator'] 	= $separator;
$meta_elements['pref'] 			= thz_get_option('bpme/show/mep',null);
$footer_elements['pref'] 		= thz_get_option('bpfo/show/fop',null);

$has_media			= thz_post_has_media() || $post_format ? true : false;
$title_classes		='thz-post-title';
$post_classes		= array(
	'thz-single-post'
);


if($show_post_shares =='show'){
	$bps_style = thz_get_option('bps/show/im/s','simple');
	$bps_shape = thz_get_option('bps/show/im/sh','square');
	$bps_shclass = $bps_style !='simple' ? ' thz-so-'.$bps_shape :'';
	$bps_class =' thz-so-'.$bps_style.$bps_shclass;
}

?>
<article id="post-<?php the_ID(); ?>" <?php post_class($post_classes); ?>>
    <div class="thz-post-details-row thz-content-row">
        <div class="thz-post-details-holder<?php thz_single_cmx('pdetails_mx') ?>">
			<?php 
                
                if($show_post_meta == 'show' && $meta_location =='above' && $title_location =='above' && !is_attachment()){
                    
                    thz_theme_post_meta('meta','above',$meta_location,'<div class="thz-post-meta">','</div>',$meta_elements);
                }
                if ($show_post_title == 'show' && $title_location =='above') { 
        
                    thz_post_title('above',$title_location,$title_classes,'h1','under');
                
                }
                if($show_post_meta == 'show' && $meta_location =='under'&& $title_location =='above' && !is_attachment()){
                    
                    thz_theme_post_meta('meta','under',$meta_location,'<div class="thz-post-meta">','</div>',$meta_elements);
                } 
                
            ?>
            <?php if( $show_post_media == 'show' && $has_media ){ ?>
            <div class="thz-post-media-container">
                <div class="thz-post-media thz-single-post-media">
                    <?php if( !$post_format ){ ?>
                    <?php get_template_part( 'template-parts/post', 'media-'.$media_layout ); ?>
                    <?php }else{ ?>
                    <?php get_template_part( 'template-parts/post/post-media',$item_media); ?>
                    <?php  } ?>
                </div>
            </div>
            <?php  } ?>
            <div class="thz-max-holder<?php thz_single_cmx('pdetails_mx',true) ?>">
                <?php 
                    if($show_post_meta == 'show' && $meta_location =='above' && $title_location =='under' && !is_attachment()){
                        
                        thz_theme_post_meta('meta','above',$meta_location,'<div class="thz-post-meta">','</div>',$meta_elements);
                    }
                    if ($show_post_title == 'show' && $title_location =='under') { 
            
                        thz_post_title('under',$title_location,$title_classes,'h1','under');
                    
                    }
                    if($show_post_meta == 'show' && $meta_location =='under' && $title_location =='under' && !is_attachment()){
                        
                        thz_theme_post_meta('meta','under',$meta_location,'<div class="thz-post-meta">','</div>',$meta_elements); 
                    }
                ?>
                <div class="entry-content thz-entry-content">
                    <?php  
                        the_content();		
                        wp_link_pages( array(
                            'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'creatus' ),
                            'after'  => '</div>',
                        ) );
                    ?>
                </div>
            </div>
        </div>
    </div>
    <?php if ($show_post_footer == 'show' && !is_attachment()) { ?>
    <div class="thz-post-footer-row thz-content-row">
        <div class="thz-post-footer-holder<?php thz_single_cmx('bpfo/show/holder_mx') ?>">
            <div class="thz-max-holder<?php thz_single_cmx('bpfo/show/holder_mx',true) ?>">
                <?php thz_theme_post_footer('footer','under','','<div class="thz-post-footer">','</div>',$footer_elements); ?>
            </div>
        </div>
    </div>
    <?php  } ?>
    <?php if ($show_post_tags == 'show' && !is_attachment() && thz_post_tags_links() ) { ?>
    <div class="thz-post-tags-row thz-content-row">
        <div class="thz-post-tags-holder<?php thz_single_cmx('bptags/show/holder_mx') ?>">
            <div class="thz-max-holder<?php thz_single_cmx('bptags/show/holder_mx',true) ?>">
            	<div class="thz-single-post-tags">
                	<?php echo thz_post_tags_links( '<span class="thz-post-tag-separator"></span>' );?>
                </div>
            </div>
        </div>
    </div>
    <?php  } ?>
    <?php thz_single_post_navigation('under_footer'); ?>
	<?php if ( thz_has_shares() && $show_post_shares == 'show' && !is_attachment()) { ?>
    <div class="thz-post-sharing-row thz-content-row">
        <div class="thz-post-sharing-holder<?php thz_single_cmx('bps/show/holder_mx') ?>">
            <div class="thz-max-holder<?php thz_single_cmx('bps/show/holder_mx',true) ?>">
                <div class="thz-post-shares thz-shares-<?php echo thz_sanitize_class( $sharing_layout ) ?>">
                    <?php if ($show_sharing_label == 'show' && $sharing_label !='') { ?>
                    <div class="thz-post-share-label">
                        <div class="thz-post-share-label-in">
                            <?php echo esc_html($sharing_label).$left_separator; ?>
                        </div>
                    </div>
                    <?php  } ?>
                    <div class="thz-post-share-links<?php echo thz_sanitize_class($bps_class) ?>">
                        <div class="thz-post-share-links-in">
                            <?php thz_core_post_shares(true,false); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
	<?php } ?>
	<?php if ($show_post_author == 'show' && !is_attachment()) { ?>
    <div class="thz-post-author-row thz-content-row">
        <div class="thz-post-author-holder<?php thz_single_cmx('bpau/show/holder_mx') ?>">
            <div class="thz-max-holder<?php thz_single_cmx('bpau/show/holder_mx',true) ?>">
                <?php  get_template_part( 'template-parts/author', 'bio' ); ?>
            </div>
        </div>
    </div>
	<?php } ?>
    <?php thz_single_post_navigation('above_related'); ?>
    <?php thz_page_block('above_related'); ?>
	<?php thz_related_posts_output('inside') ?>
    <?php thz_page_block('under_related'); ?>
    <?php thz_single_post_navigation('under_related'); ?>
	<?php thz_comments_output('inside'); ?>
	<?php thz_sdata('post',true,true); ?>
</article>
<?php thz_single_post_navigation('inside'); ?>