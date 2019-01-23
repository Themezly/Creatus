<?php
/**
 * @package      Thz Framework
 * @author       Themezly
 * @websites     http://www.themezly.com | http://www.youjoomla.com | http://www.yjsimplegrid.com
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // No direct access
}

$side_width				= thz_get_option('project_layout/sidebar/side_width','thz-col-1-3');
$side_space				= thz_get_option('project_layout/sidebar/side_space',60);
$media_width			= 'thz-col-2-3';
$sidebar_side			= thz_get_option('project_layout/sidebar/sidebar_side','right');
$sticky_sidebar			= thz_get_option('project_layout/sidebar/sticky_sidebar','active'); 
$show_project_media		= thz_get_option('ppm/picked','show');
$show_project_title		= thz_get_option('ppt/picked','show');
$project_meta			= thz_get_post_option('project_meta',array());
$show_project_shares	= thz_get_option('ppps/picked','show');
$show_project_nav		= thz_get_option('pnav_mx/v','show');
$project_info_classes 	= ' thz-project-meta-'.$sidebar_side.' thz-project-meta-sidebar';
$sticky_class			= $sticky_sidebar =='active' ? ' thz-sticky-element' : '';
$media_layout			= thz_get_post_option('media_layout/picked','slider');
$get_content 			= thz_get_the_content();
$has_media				= ' has-media';
$builder_active_content	= thz_get_option('ppbac','excerpt');

if( thz_has_builder() && $builder_active_content == 'excerpt'){
	$get_content 		=  get_the_excerpt();
}
if($side_width == 'thz-col-1-4'){
	
	$media_width	 = 'thz-col-3-4';
	
}else if($side_width == 'thz-col-1-2'){
	
	$media_width	 = 'thz-col-1-2';	
}

if($show_project_media =='hide' || !thz_post_has_media()) {
	$side_width	= 'thz-col-1';
	$has_media	= ' no-media';
}

$has_elements =  ( $show_project_media =='show' && thz_post_has_media()) || $show_project_title == 'show' || !empty($project_meta) || !empty($get_content) ? true : false;
?>
<div class="thz-project thz-project-layout-sidebar thz-project-media-layout-<?php echo thz_sanitize_class ( $media_layout.$has_media ) ?>">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php if($has_elements){ ?>
        <div class="thz-project-holder-row thz-content-row">
            <div class="thz-project-holder<?php thz_single_cmx('project_layout/sidebar/holder_mx') ?>">
                <div class="thz-max-holder<?php thz_single_cmx('project_layout/sidebar/holder_mx',true) ?>">
                    <div class="thz-row thz-project-row thz-project-info<?php echo esc_attr($project_info_classes) ?>">
                        <?php if($show_project_media =='show' && thz_post_has_media()) { ?>
                            <div class="thz-column <?php echo esc_attr($media_width) ?> thz-project-desc thz-project-column">
                                <div class="thz-project-media">
                                    <?php  get_template_part( 'template-parts/post', 'media-'.$media_layout ); ?>
                                </div>
                            </div><!-- / thz-col -->
                        <?php } ?>
                        <div class="thz-column <?php echo esc_attr($side_width) ?> thz-project-metas<?php echo esc_attr( $sticky_class ) ?> thz-project-column" data-offset="<?php echo esc_attr($side_space) ?>">
                            <div class="thz-project-info-sidebar">
                                <?php if($show_project_title == 'show') { ?>
                                <h2 class="thz-project-title entry-title">
                                    <a href="<?php echo esc_url( get_permalink() ) ?>" rel="bookmark">
                                        <?php echo get_the_title() ?>
                                    </a>
                                </h2>
                                <?php } ?>
                                <?php if(!empty($get_content)){ ?>
                                <div class="thz-project-content">
                                    <?php echo $get_content;  ?>
                                    <?php
                                        wp_link_pages( array(
                                            'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'creatus' ),
                                            'after'  => '</div>',
                                        ) );
                                    ?>
                                </div>
                                <?php } ?>
                                <?php thz_project_meta ( $project_meta ) ?>
                            </div><!-- / thz-project-info-sidebar -->
                        </div><!-- / thz-col -->
                    </div><!-- / thz-row -->
                 </div> 
            </div>
        </div>
        <?php } ?>
        <?php thz_page_block('above_related'); ?>
		<?php thz_related_posts_output('inside') ?>
        <?php thz_page_block('under_related'); ?>
        <?php thz_comments_output('inside'); ?>
		<?php thz_sdata('project',true,true); ?>
	</article>
</div>
<?php thz_single_post_navigation('inside'); ?>