<?php
/**
 * @package      Thz Framework
 * @author       Themezly
 * @websites     http://www.themezly.com | http://www.youjoomla.com | http://www.yjsimplegrid.com
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // No direct access
}

$side_width				= thz_get_option('project_layout/full/side_width','thz-col-1-3');
$desc_width				= 'thz-col-2-3';
$media_location			= thz_get_option('project_layout/full/media_mx/l','under');
$prmeta_side			= thz_get_option('project_layout/full/prmeta_side','right');
$show_project_media		= thz_get_option('ppm/picked','show');
$show_project_title		= thz_get_option('ppt/picked','show');
$project_meta			= thz_get_post_option('project_meta',array());
$show_project_shares	= thz_get_option('ppps/picked','show');
$show_project_nav		= thz_get_option('pnav_mx/v','show');
$project_info_classes 	= ' thz-project-meta-'.$prmeta_side.' thz-project-meta-full';
$media_layout			= thz_get_post_option('media_layout/picked','slider');
$get_content 			= thz_get_the_content();
$builder_active_content	= thz_get_option('ppbac','excerpt');

if( thz_has_builder() && $builder_active_content == 'excerpt'){
	$get_content 		=  get_the_excerpt();
}

if($side_width == 'thz-col-1-4'){
	
	$desc_width	 = 'thz-col-3-4';
	
}else if($side_width == 'thz-col-1-2'){
	
	$desc_width	 = 'thz-col-1-2';	
}

if(empty($project_meta)){
 $desc_width  = 'thz-col-1';
}

if(empty($get_content)){
 $side_width  = 'thz-col-1';
}

$has_elements =  ( $show_project_media =='show' && thz_post_has_media()) || $show_project_title == 'show' || !empty($project_meta) || !empty($get_content) ? true : false;

?>
<div class="thz-project thz-project-layout-full thz-project-media-layout-<?php echo esc_attr ( $media_layout ) ?>">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php if($has_elements){ ?>
			<?php if($media_location == 'above' && $show_project_media =='show' && thz_post_has_media()) { ?>
            <div class="thz-project-media-row thz-content-row">
                <div class="thz-project-media-holder<?php thz_single_cmx('project_layout/full/media_mx') ?>">
                    <div class="thz-max-holder<?php thz_single_cmx('project_layout/full/media_mx',true) ?>">
                        <div class="thz-project-media">
                            <?php  get_template_part( 'template-parts/post', 'media-'.$media_layout ); ?>
                        </div>
                    </div>
                </div>
            </div>
			<?php } ?>
            <div class="thz-project-details-row thz-content-row">
                <div class="thz-project-details-holder<?php thz_single_cmx('project_layout/full/details_mx') ?>">
                    <div class="thz-max-holder<?php thz_single_cmx('project_layout/full/details_mx',true) ?>">
                        <div class="thz-row thz-project-row thz-project-info<?php echo esc_attr($project_info_classes) ?>">
                            <div class="thz-column thz-col-1 thz-project-column">
                                <?php if($show_project_title == 'show') { ?>
                                <h2 class="thz-project-title entry-title">
                                    <a href="<?php echo esc_url( get_permalink() ) ?>" rel="bookmark">
                                        <?php echo get_the_title() ?>
                                    </a>
                                </h2>
                                <?php } ?>  
                            </div>                      
                            <div class="thz-column <?php echo esc_attr($desc_width) ?> thz-project-desc thz-project-column">
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
                            </div><!-- / thz-col -->
                            <?php if(!empty($project_meta)){ ?>
                            <div class="thz-column <?php echo esc_attr($side_width) ?> thz-project-metas thz-project-column">
                                <?php thz_project_meta ( $project_meta ) ?>
                            </div><!-- / thz-col -->
                             <?php } ?>
                        </div><!-- / thz-row -->
                    </div>
                </div>
            </div>
			<?php if($media_location == 'under' && $show_project_media =='show' && thz_post_has_media() ) { ?>
            <div class="thz-project-media-row thz-content-row">
                <div class="thz-project-media-holder<?php thz_single_cmx('project_layout/full/media_mx') ?>">
                    <div class="thz-max-holder<?php thz_single_cmx('project_layout/full/media_mx',true) ?>">
                        <div class="thz-project-media">
                            <?php  get_template_part( 'template-parts/post', 'media-'.$media_layout ); ?>
                        </div>
                    </div>
                </div>
            </div>
			<?php } ?>
        <?php } ?>
        <?php thz_page_block('above_related'); ?>
		<?php thz_related_posts_output('inside') ?>
        <?php thz_page_block('under_related'); ?>
        <?php thz_comments_output('inside'); ?>
		<?php thz_sdata('project',true,true); ?>
	</article>
</div>
<?php thz_single_post_navigation('inside'); ?>