<?php
/**
 * @package      Thz Framework
 * @author       Themezly
 * @websites     http://www.themezly.com | http://www.youjoomla.com | http://www.yjsimplegrid.com
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // No direct access
}

$show_author_avatar = thz_get_option('bpau/show/av/picked','show');
$author_avatar_size = (int) thz_get_option('bpau/show/av/show/size',85);
$heading_space 		= thz_get_option('bpau/show/as/heading',10);
$text_space 		= thz_get_option('bpau/show/as/text',10);
$link_space 		= thz_get_option('bpau/show/as/link',0);
$author_link_text	= thz_get_option('bpau/show/alt',__( 'More posts by', 'creatus' ));
$author_id 			= get_the_author_meta('ID');
$author_link		= get_author_posts_url($author_id );
$description		= get_the_author_meta('description');
$mode				= thz_get_option('bpau/show/as/mode','left');

// heading
$heading_classes 	='thz-author-bio-heading thz-mb-'.thz_m_ton($heading_space);

// text
$text_classes 		='thz-author-bio-text thz-mb-'.thz_m_ton($text_space);


// link
$link_classes 		='thz-author-bio-link thz-mt-'.thz_m_ton($link_space);

// description
if(empty($description)){

	$description  = esc_html__( 'I am still working on my short bio.', 'creatus' );
	$description  .= ' ' . sprintf( esc_html__( 'Until then you can browse my %1s posts and provide a feedback.', 'creatus' ), count_user_posts( $author_id ) );

}

?>
<div class="thz-author-bio thz-author-bio-mode-<?php echo thz_sanitize_class( $mode )?>"<?php thz_sdata('author')?>>
	<?php if (function_exists('get_avatar') && $show_author_avatar =='show') { ?>
	<div class="thz-author-avatar">
	<?php echo get_avatar( get_the_author_meta('email'), $author_avatar_size ); ?>
	</div>
	<?php }?>
	<div class="thz-autho-info">
		<h3 class="<?php echo thz_sanitize_class( $heading_classes )?>"<?php thz_sdata('name')?>>
		<?php the_author(); ?>
			<?php if ( current_user_can( 'edit_users' ) || get_current_user_id() == $author_id ) : ?>
				<span class="thz-author-profile-edit thz-fs-14">
					(<a href="<?php echo admin_url( 'profile.php?user_id=' . $author_id ); ?>"><?php _e( 'Edit profile', 'creatus' ); ?></a>)
				</span>
			<?php endif; ?>		
		</h3>
		<div class="<?php echo thz_sanitize_class( $text_classes )?>"><?php echo $description; ?></div>
		<?php echo '<a href="'.$author_link.'" class="'.thz_sanitize_class( $link_classes ).'">'. esc_html($author_link_text) .' '.get_the_author().' </a>'; ?>
	</div>
</div>