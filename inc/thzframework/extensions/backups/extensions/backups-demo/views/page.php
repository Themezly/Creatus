<?php if ( ! defined( 'FW' ) ) die( 'Forbidden' );
/**
 * @var FW_Ext_Backups_Demo[] $demos
 */

/**
 * @var FW_Extension_Backups $backups
 */
$backups = fw_ext('backups');

if ($backups->is_disabled()) {
	$confirm = '';
} else {
	$confirm = esc_html__('IMPORTANT: Installing this demo content will delete the content you currently have on your website. However, we create a backup of your current content in (Tools > Backup). You can restore the backup from there at any time in the future.',	'creatus');
}

$ThzDemos 			= ThzDemos::getInstance();
$can_refresh 		= $ThzDemos->can_refresh();
$page_builder 		= filter_input( INPUT_GET, "thz_page_builder", FILTER_SANITIZE_STRING );
$current_builder 	= !$page_builder || 'unyson' == $page_builder ? 'unyson' : $page_builder;
$active_elementor 	= 'elementor' == $current_builder ? 'page_builders active-builder' :'page_builders inactive-builder';
$active_unyson 		= 'unyson' == $current_builder ? 'page_builders active-builder' :'page_builders inactive-builder';

?>
<script type="text/javascript">
(function ($, fwe, window, document) {
	
	$(document).ready(function() {
		
		$('.thz-refresh-demos-list').on('click',function(e){
			
			e.preventDefault();
			
			var $this = $(this);
			$this.addClass('refreshing');
			
			$.ajax({
				type: 'post',
				dataType: 'json',
				url: ajaxurl,
				data: {
					'action': 'thz_refresh_demos_list',
				}
			}).done(function (response) {

				if( response.success ){
					location.reload();
					
				}else{
					$this.removeClass('refreshing');
				}
								
			}).fail(function(xhr, status, error){
				$this.removeClass('refreshing');
				console.warn(status);
			});		
					
		});

	});
	
})(jQuery, fwEvents, window, document);
</script>
<h1>
	<?php esc_html_e('Demo Content Install', 'creatus') ?>
    <?php if($can_refresh){ ?>
    <a class="thz-refresh-demos-list" href="#" title="<?php esc_html_e('Click to refresh demos list', 'creatus') ?>">
    	<span class="thz-admin-system-state dashicons dashicons-update"></span>
    </a>
    <?php } ?>
</h1>
<div>
	<?php if ( !class_exists('ZipArchive') ): ?>
		<div class="error below-h2">
			<p>
				<strong><?php _e( 'Important', 'creatus' ); ?></strong>:
				<?php printf(
					__( 'You need to activate %s.', 'creatus' ),
					'<a href="http://php.net/manual/en/book.zip.php" target="_blank">'. __('zip extension', 'creatus') .'</a>'
				); ?>
			</p>
		</div>
	<?php endif; ?>

	<?php if ($http_loopback_warning = fw_ext_backups_loopback_test()) : ?>
		<div class="error">
			<p><strong><?php _e( 'Important', 'creatus' ); ?>:</strong> <?php echo $http_loopback_warning; ?></p>
		</div>
		<script type="text/javascript">var fw_ext_backups_loopback_failed = true;</script>
	<?php endif; ?>
</div>

<p></p>
<div class="thz-select-builder">
	<h3><?php esc_html_e('Select your page builder', 'creatus'); ?>:</h3>
    <a class="<?php echo $active_unyson; ?>" href="<?php echo self_admin_url( 'tools.php?page=fw-backups-demo-content');?>"><?php esc_html_e('Unyson', 'creatus'); ?></a>
    <a class="<?php echo $active_elementor; ?>" href="<?php echo esc_url( add_query_arg( 'thz_page_builder', 'elementor') )?>"><?php esc_html_e('Elementor', 'creatus'); ?></a>
</div>
<div class="theme-browser rendered" id="fw-ext-backups-demo-list">
<?php foreach ($demos as $demo): 

		$extra = $demo->get_extra(); 
		
		if(!$page_builder && thz_contains($demo->get_id(),'-')){
			continue;
		}
		
		if($page_builder && !thz_contains($demo->get_id(),$page_builder)){
			continue;
		}

?>
	<div class="theme fw-ext-backups-demo-item" id="demo-<?php echo esc_attr($demo->get_id()) ?>">
		<div class="theme-screenshot">
			<img src="<?php echo esc_attr($demo->get_screenshot()); ?>" alt="Screenshot" />
		</div>
		<?php if ($demo->get_preview_link()): ?>
			<a class="more-details" target="_blank" href="<?php echo esc_attr($demo->get_preview_link()) ?>">
				<?php esc_html_e('Live Preview', 'creatus') ?>
			</a>
		<?php endif; ?>
		<h3 class="theme-name"><?php echo esc_html($demo->get_title()); ?></h3>
		<div class="theme-actions">
        	<?php if ( isset($extra['type']) && !thz_has_cpac() ): ?>
             <a class="button button-primary thz-install-demo-cp-link" href="https://themezly.com/pricing/" target="_blank">
                <?php esc_html_e('Go Pro', 'creatus') ?>
             </a>
            <?php else: ?>
			<a class="button button-primary demo-install"
			   href="#" onclick="return false;"
			   data-confirm="<?php echo esc_attr($confirm); ?>"
			   data-install="<?php echo esc_attr($demo->get_id()) ?>"><?php esc_html_e('Install', 'creatus'); ?></a>            
            <?php endif; ?>
		</div>
	</div>
<?php endforeach; ?>
</div>
