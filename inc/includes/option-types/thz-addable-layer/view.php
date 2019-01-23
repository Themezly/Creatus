<?php if (!defined('FW')) die('Forbidden');
/**
 * @var string $id
 * @var array $option
 * @var array $data,
 * @var array $data_items
 */
$attr = $option['attr'];
unset($attr['name']);
unset($attr['value']);

// must contain characters that will remain the same after htmlspecialchars()
$increment_placeholder = '###-thz-addable-layer-increment-'. fw_rand_md5() .'-###';

?>
<div <?php echo fw_attr_to_html($attr); ?>>
	<!-- Fixes https://github.com/ThemeFuse/Unyson/issues/1278 -->
	<?php echo fw()->backend->option_type('hidden')->render($id, array('value' => '~'), array(
		'id_prefix' => $data['id_prefix'],
		'name_prefix' => $data['name_prefix'],
	)); ?>
    
    <div class="container-options">
        <div class="c-option">
			<?php echo fw()->backend->option_type('short-select')->render(
                'c~s', 
                array(
                    'label' => __('Container size', 'creatus'),
                    'desc' => esc_html__('Set layers container size.', 'creatus'),
                    'value' => 'thz-ratio-1-1',
                    'type' => 'short-select',
                    'attr' => array(
                        'class' => 'container-size'
                    ),
                    'choices' => array(
                        array( // optgroup
                            'attr' => array(
                                'label' => __('Square', 'creatus')
                            ),
                            'choices' => array(
                                'thz-ratio-1-1' => esc_html__('Aspect ratio 1:1', 'creatus')
                            )
                        ),
                        array( // optgroup
                            'attr' => array(
                                'label' => __('Landscape', 'creatus')
                            ),
                            'choices' => array(
                                'thz-ratio-2-1' => esc_html__('Aspect ratio 2:1', 'creatus'),
                                'thz-ratio-3-2' => esc_html__('Aspect ratio 3:2', 'creatus'),
                                'thz-ratio-4-3' => esc_html__('Aspect ratio 4:3', 'creatus'),
                                'thz-ratio-16-9' => esc_html__('Aspect ratio 16:9', 'creatus'),
                                'thz-ratio-21-9' => esc_html__('Aspect ratio 21:9', 'creatus')
                            )
                        ),
                        array( // optgroup
                            'attr' => array(
                                'label' => __('Portrait', 'creatus')
                            ),
                            'choices' => array(
                                'thz-ratio-1-2' => esc_html__('Aspect ratio 1:2', 'creatus'),
                                'thz-ratio-3-4' => esc_html__('Aspect ratio 3:4', 'creatus'),
                                'thz-ratio-2-3' => esc_html__('Aspect ratio 2:3', 'creatus'),
                                'thz-ratio-9-16' => esc_html__('Aspect ratio 9:16', 'creatus')
                            )
                        )
                    )
                
                ), array(
                    'value' => fw_akg('c~s', $data['value']),
                    'id_prefix' => $data['id_prefix'] . $id . '-',
                    'name_prefix' => $data['name_prefix'] . '[' . $id . ']',
            )); ?>
        </div>
        <div class="c-option">
			<?php
            echo fw_html_tag('button', array(
                'type' => 'button',
                'class' => 'button add-new-item',
                'onclick' => 'return false;',
                'data-increment-placeholder' => $increment_placeholder,
            ), fw_htmlspecialchars($option['add-button-text']));
            ?>
        </div>
	</div>
    <div class="thz-aspect <?php echo fw_akg('c~s', $data['value'],'thz-ratio-1-1') ?>">
        <div class="thz-ratio-in">
            <div class="items-wrapper">
                <?php foreach ($data_items as $key => $value): 	?>
                <div class="item fw-backend-options-virtual-context" style="position:absolute;">
                	<div class="item-in">
                    	<div class="item-in-over">
                            <div class="input-wrapper">
                                <?php echo fw()->backend->option_type('hidden')->render('', array('value' => json_encode($value)), array(
                                    'id_prefix' => $data['id_prefix'] . $id . '-' . $key . '-',
                                    'name_prefix' => $data['name_prefix'] . '[' . $id . ']',
                                ));?>
                            </div>
                            <div class="content"><!-- will be populated from js --></div>
                            <div class="layer-icons">
                                <small class="dashicons dashicons-plus z-plus" title="<?php echo __('Bring forward','creatus') ?>"></small>
                                <small class="dashicons dashicons-minus z-minus" title="<?php echo __('Send back','creatus') ?>"></small> 
                                <small class="dashicons dashicons-editor-contract reset-all" title="<?php echo __('Reset','creatus') ?>"></small>
                             </div>
                            <div class="layer-icons icons-b">
                                <small class="dashicons dashicons-undo reset-rotation" title="<?php echo __('Reset rotation','creatus') ?>"></small>
                                <small class="dashicons dashicons-admin-page clone-item" title="<?php echo __('Clone','creatus') ?>"></small>
                                <a href="#" class="dashicons fw-x delete-item"></a>
                            </div>
                        </div>
                	</div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
	<div class="default-item fw-backend-options-virtual-context" style="position:absolute;">
        <div class="item-in">
        	<div class="item-in-over">
                <div class="input-wrapper">
                    <?php echo fw()->backend->option_type('hidden')->render('', array('value' => '[]'), array(
                        'id_prefix' => $data['id_prefix'] . $id . '-' . $increment_placeholder,
                        'name_prefix' => $data['name_prefix'] . '[' . $id . ']',
                    )); ?>
                </div>
                <div class="content"></div>
                <div class="layer-icons">
                    <small class="dashicons dashicons-plus z-plus" title="<?php echo __('Bring forward','creatus') ?>"></small>
                    <small class="dashicons dashicons-minus z-minus" title="<?php echo __('Send back','creatus') ?>"></small> 
                    <small class="dashicons dashicons-editor-contract reset-all" title="<?php echo __('Reset','creatus') ?>"></small>
                 </div>
                <div class="layer-icons icons-b">
                    <small class="dashicons dashicons-undo reset-rotation" title="<?php echo __('Reset rotation','creatus') ?>"></small>
                    <small class="dashicons dashicons-admin-page clone-item" title="<?php echo __('Clone','creatus') ?>"></small>
                    <a href="#" class="dashicons fw-x delete-item"></a>
                </div>
            </div>
        </div>
	</div>
</div>

