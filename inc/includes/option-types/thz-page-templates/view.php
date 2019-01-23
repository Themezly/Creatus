<?php if ( ! defined( 'FW' ) ) { die( 'Forbidden' ); }

/**
 * @var string $id
 * @var  array $option
 * @var  array $data
 */

{
	$div_attr = $option['attr'];
	$input_attr = $option['attr'];

	unset(
		$div_attr['value'],
		$div_attr['name']
	);

}

?>
<div class="thz-page-options-templates-list">
    <ul>
         <li class="no-saved-templates">
            <?php echo esc_html__('There are no saved templates.', 'creatus') ?><br />
             <?php echo esc_html__('Click on the button below to create first template.', 'creatus') ?>
         </li>
    	<?php 
			if(!empty($templates)):
			
				foreach ($templates as $id => $template){ ?>
        
                    <li>
                        <a class="template-load" href="#" onclick="return false;" data-load-pagetmpl="<?php echo esc_attr($id) ?>">
							<?php echo esc_attr($template['title']) ?>
                        </a>
                        <a class="template-delete dashicons fw-x" href="#" onclick="return false;" data-delete-pagetmpl="<?php echo esc_attr($id) ?>"></a>
                    </li>
        
        <?php }; endif; ?>
    </ul>
    <a class="button button-primary thz-add-page-template" href="#"><?php echo esc_html__('Save as template', 'creatus') ?></a>
</div>