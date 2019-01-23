<?php
/**
 * @package      Thz Framework
 * @author       Themezly
 * @websites     http://www.themezly.com | http://www.youjoomla.com | http://www.yjsimplegrid.com
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // No direct access
}

$show_author_avatar = thz_get_theme_option('show_author_avatar/picked','show');
$author_avatar_size = (int) thz_get_theme_option('show_author_avatar/show/size',85);
$heading_space 		= thz_get_theme_option('author_imx/heading',10);
$text_space 		= thz_get_theme_option('author_imx/text',10);
$author_link_text	= thz_get_theme_option('author_link_text',__( 'More posts by', 'creatus' ));
$author_id 			= get_the_author_meta('ID');
$author_link		= get_author_posts_url($author_id );
$description		= get_the_author_meta('description');
$mode				= thz_get_option('author_imx/mode','left');

// heading
$heading_classes 	='thz-author-info-heading thz-mb-'.thz_m_ton($heading_space);

// text
$text_classes 		='thz-author-info-text thz-mb-'.thz_m_ton($text_space);


// description
if(empty($description)){

	$description  = esc_html__( 'I am still working on my short bio.', 'creatus' );
	$description  .= ' ' . sprintf( esc_html__( 'Until then you can browse my %1s posts and provide a feedback.', 'creatus' ), count_user_posts( $author_id ) );

}

?>
<div class="thz-author-info thz-author-info-mode-<?php echo thz_sanitize_class( $mode )?>"<?php thz_sdata('author')?>>
	<?php if (function_exists('get_avatar') && $show_author_avatar =='show') { ?>
	<div class="thz-author-avatar">
	<?php echo get_avatar( get_the_author_meta('email'), $author_avatar_size ); ?>
	</div>
	<?php }?>
	<div class="thz-author-info-data">
		<h3 class="<?php echo thz_sanitize_class( $heading_classes )?>"<?php thz_sdata('name')?>>
		<?php the_author(); ?>
			<?php if ( current_user_can( 'edit_users' ) || get_current_user_id() == $author_id ) : ?>
				<span class="thz-author-profile-edit thz-fs-14">
					(<a href="<?php echo admin_url( 'profile.php?user_id=' . $author_id ); ?>"><?php _e( 'Edit profile', 'creatus' ); ?></a>)
				</span>
			<?php endif; ?>		
		</h3>
		<p class="<?php echo thz_sanitize_class( $text_classes )?>"><?php echo $description; ?></p>
		<?php echo thz_author_contacts($author_id); ?>
	</div>
</div>