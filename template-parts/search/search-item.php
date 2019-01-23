<?php
/**
 * @package      Thz Framework
 * @author       Themezly
 * @websites     http://www.themezly.com | http://www.youjoomla.com | http://www.yjsimplegrid.com
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // No direct access
}

$show_type 			= thz_get_theme_option('search_type/picked','show');
$show_meta 			= thz_get_theme_option('search_meta/picked','show');
$title_mb			= thz_get_theme_option('search_spacings/title',null); 

$post_classes = array(
	'thz-search-item',
);

if($show_type =='show' ){
	
	$post_type 		= get_post_type();
	$type_mb		= thz_get_theme_option('search_spacings/type',null); 
	$type_classes 	= 'thz-search-item-type thz-mb-'.thz_m_ton($type_mb);
	
	if($post_type =='fw-portfolio'){
		$post_type ='project';	
	}
	
}

if($show_meta =='show' ){ 
	
	$meta_mb			= thz_get_theme_option('search_spacings/meta',null);  
	$meta_classes 		= 'thz-search-item-meta thz-mb-'.thz_m_ton($meta_mb);
	$separator			= thz_get_theme_option('search_meta/show/sep',null);
	$separator			= thz_get_separator ($separator,'thz-meta-separator');
	$meta				= thz_get_theme_option('search_meta/show/els',null);
	$meta['pref'] 		= thz_get_theme_option('search_meta/show/pref',null);
	$meta['separator'] 	= $separator;

}

?>
<article id="post-<?php the_ID(); ?>" <?php post_class($post_classes); ?>>
	<?php if($show_type =='show' ){ ?>
	<div class="<?php echo thz_sanitize_class($type_classes) ?>">
		<?php echo $post_type ?>
	</div>
	<?php } ?>
	<div class="thz-search-item-title-holder thz-mb-<?php echo thz_m_ton($title_mb) ?>">
		<?php the_title( sprintf( '<h2 class="thz-search-item-title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
	</div>
	<?php if($show_meta =='show' ){ ?>
	<?php thz_theme_post_meta('meta','under','under','<div class="'.$meta_classes.'">','</div>',$meta); ?>
	<?php } ?>
</article>