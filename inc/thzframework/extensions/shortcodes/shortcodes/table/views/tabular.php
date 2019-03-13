<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

/**
 * @var array $atts
 */
$id 				= thz_akg('id',$atts); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.OverrideProhibited
$css_id 			= thz_akg('cmx/i',$atts);
$id_out				= !empty($css_id) ? str_replace(' ','',$css_id): 'thz-table-'.$id;
$css_class 			= thz_akg('cmx/c',$atts);
$css_class			= $css_class !='' ? $css_class.' ':'';
$res_class			= _thz_responsive_classes(thz_akg('cmx',$atts));
$type				= thz_akg('table/header_options/table_purpose',$atts); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.OverrideProhibited
$table_style		= thz_akg('table_style/picked',$atts);
$stripes			= thz_akg('stripes/picked',$atts);
$stripe_class		= $stripes == 'show' ? ' thz-table-stripe' :'';
$animate			= thz_akg('animate',$atts);
$animation_data		= thz_print_animation($animate);
$animation_class	= thz_print_animation($animate,true);
$cpx				= thz_akg('cpx',$atts);
$cpx_data			= thz_print_cpx($cpx);
$cpx_class			= thz_print_cpx($cpx,true);

$holder_class		= $css_class.'thz-shc thz-table-container'.$animation_class.$cpx_class.$res_class;
$table_class		= 'thz-table '.$table_style.$stripe_class;
?>
<div id="<?php echo esc_attr($id_out) ?>" class="<?php echo thz_sanitize_class($holder_class) ?>"<?php echo thz_sanitize_data($animation_data.$cpx_data)?>>
	<table class="<?php echo thz_sanitize_class($table_class) ?>">
		<?php foreach ( $atts['table']['rows'] as $row_key => $row ) : ?>
			<?php if ( $row['name'] == 'heading-row' ) : ?>
				<thead>
					<tr class="<?php echo thz_sanitize_class($row['name']); ?>">
						<?php foreach ( $atts['table']['cols'] as $col_key => $col ) : ?>
							<th class="<?php echo thz_sanitize_class($col['name']); ?>">
								<?php echo $atts['table']['content'][ $row_key ][ $col_key ]['textarea']; ?>
							</th>
						<?php endforeach; ?>
					</tr>
				</thead>
			<?php elseif ( $row['name'] == 'default-row' ) : ?>
				<tr class="<?php echo thz_sanitize_class($row['name']); ?>">
					<?php foreach ( $atts['table']['cols'] as $col_key => $col ) : ?>
						<td class="<?php echo thz_sanitize_class($col['name']); ?>">
							<?php echo $atts['table']['content'][ $row_key ][ $col_key ]['textarea']; ?>
						</td>
					<?php endforeach; ?>
				</tr>
			<?php endif; ?>
		<?php endforeach; ?>
	</table>
</div>