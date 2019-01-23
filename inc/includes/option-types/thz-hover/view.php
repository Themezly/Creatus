<?php if ( ! defined( 'FW' ) ) { die( 'Forbidden' ); }

/**
 * @var string $id
 * @var  array $option
 * @var  array $data
 */

{
	$div_attr = $option['attr'];

	unset(
		$div_attr['value'],
		$div_attr['name']
	);
	
}

?>

<div <?php echo fw_attr_to_html($div_attr) ?>>
	<?php if(isset($option['value']['background']) ) { ?>
	<div id="thz-hover-<?php echo esc_attr($id) ?>-color" class="thz-hover-option-holder">
    	<div class="thz-hover-inner-<?php echo esc_attr($id) ?>-color">
            <div class="thz-hover-label fw-col-xs-12 fw-col-sm-3 fw-col-lg-2">
                <?php echo fw_akg('background', $option['labels']) ?>
            </div>
            <div class="thz-hover-option fw-col-xs-12 fw-col-sm-9 fw-col-lg-10">
                <?php
        
                    echo fw()->backend->option_type( 'thz-multi-options' )->render(
                        'background',
                            array(
                                'type'  => 'thz-multi-options',
                                'value' => fw_akg('background', $data['value']),
                                'thz_options' => array(
                                    'type' => array(
                                        'title' => esc_html__('Type', 'creatus'),
                                        'type' => 'short-select',
                                        'attr' => array(
                                            'class' => 'thz-select-switch'
                                        ),
                                        'choices' => array(
                                            'none' => array(
                                                'text' => esc_html__('None', 'creatus'),
                                                'attr' => array(
                                                    'data-disable' => '.'.esc_attr($id).'-gradient-parent,.'.esc_attr($id).'-color-1-parent,.'.esc_attr($id).'-color-2-parent'
                                                )
                                            ),
                                            'solid' => array(
                                                'text' => esc_html__('Solid color', 'creatus'),
                                                'attr' => array(
                                                    'data-disable' => '.'.$id.'-gradient-parent,.'.$id.'-color-2-parent',
                                                    'data-enable' => '.'.esc_attr($id).'-color-1-parent'
                                                )
                                            ),
                                            'gradient' => array(
                                                'text' => esc_html__('Gradient', 'creatus'),
                                                'attr' => array(
                                                    'data-enable' => '.'.$id.'-gradient-parent,.'.$id.'-color-1-parent,.'.$id.'-color-2-parent'
                                                )
                                            )
                                        )
                                    ),
                                    'gradient' => array(
                                        'type' => 'short-select',
                                        'title' => esc_html__('Gradient type', 'creatus'),
                                        'attr' => array(
                                            'class' => $id.'-gradient'
                                        ),
                                        'choices' => array(
                                            'vertical' => esc_html__('Vertical', 'creatus'),
                                            'horizontal' => esc_html__('Horizontal', 'creatus'),
                                            'radial' => esc_html__('Radial', 'creatus')
                                        )
                                    ),
                                    'color1' => array(
                                        'type' => 'color',
                                        'title' => esc_html__('Color 1', 'creatus'),
                                        'box' => true,
                                        'attr' => array(
                                            'class' => $id.'-color-1'
                                        ),
                                    ),	
                                    'color2' => array(
                                        'type' => 'color',
                                        'title' => esc_html__('Color 2', 'creatus'),
                                        'box' => true,
                                        'attr' => array(
                                            'class' => $id.'-color-2'
                                        ),
                                    ),							
                                ),
                            ),
                            array(
                                'value' => fw_akg('background', $data['value']),
                                'id_prefix' => $option['attr']['id'] .'-',
                                'name_prefix' => $option['attr']['name'],
                            )
                        );			
                    ?>
                <div class="thz-hover-desc">
                    <?php echo fw_akg('background', $option['descriptions']) ?>
                </div>
            </div>
        </div>
	</div>
	<?php } ?>
	<?php if(isset($option['value']['oeffect']) && isset($option['value']['oduration'])) { ?>
	<div id="thz-hover-<?php echo esc_attr($id) ?>-oeffect" class="thz-hover-option-holder">
    	<div class="thz-hover-inner-<?php echo esc_attr($id) ?>-oeffect">
            <div class="thz-hover-label fw-col-xs-12 fw-col-sm-3 fw-col-lg-2">
                <?php echo fw_akg('overlay', $option['labels']) ?>
            </div>
            <div class="thz-hover-option fw-col-xs-12 fw-col-sm-9 fw-col-lg-10">
                <div class="thz-hover-options-group">
                    <div class="thz-hover-group-option">
                        <div class="thz-hover-option-title">
                            <?php echo esc_html__('Effect','creatus') ?>
                        </div>
                        <?php
                                    echo fw()->backend->option_type( 'short-select' )->render(
                                        'oeffect',
                                        array(
                                            'type'  => 'short-select',
                                            'value' => fw_akg('oeffect', $option['value']),
                                            'choices' => _thz_hover_list()
                                        ),
                                        array(
                                            'value' => fw_akg('oeffect', $data['value']),
                                            'id_prefix' => $option['attr']['id'] .'-',
                                            'name_prefix' => $option['attr']['name'],
                                        )
                                    );			
                                ?>
                    </div>
                    <div class="thz-hover-group-option">
                        <div class="thz-hover-option-title">
                            <?php echo esc_html__('Duration','creatus') ?>
                        </div>
                        <?php
                                    echo fw()->backend->option_type( 'short-select' )->render(
                                        'oduration',
                                        array(
                                            'type'  => 'short-select',
                                            'value' => fw_akg('oduration', $option['value']),
                                            'choices' => _thz_transition_duration_list()
                                        ),
                                        array(
                                            'value' => fw_akg('oduration', $data['value']),
                                            'id_prefix' => $option['attr']['id'] .'-',
                                            'name_prefix' => $option['attr']['name'],
                                        )
                                    );			
                                ?>
                    </div>
                </div>
                <div class="thz-hover-desc">
                    <?php echo fw_akg('overlay', $option['descriptions']) ?>
                </div>
            </div>
        </div>
	</div>
	<?php } ?>
	<?php if(isset($option['value']['ieffect']) && isset($option['value']['iduration'])) { ?>
	<div id="thz-hover-<?php echo esc_attr($id) ?>-ieffect" class="thz-hover-option-holder">
    	<div class="thz-hover-inner-<?php echo esc_attr($id) ?>-ieffect">
            <div class="thz-hover-label fw-col-xs-12 fw-col-sm-3 fw-col-lg-2">
                <?php echo fw_akg('image', $option['labels']) ?>
            </div>
            <div class="thz-hover-option fw-col-xs-12 fw-col-sm-9 fw-col-lg-10">
                <div class="thz-hover-options-group">
                    <div class="thz-hover-group-option">
                        <div class="thz-hover-option-title">
                            <?php echo esc_html__('Effect','creatus') ?>
                        </div>
                        <?php
                                    echo fw()->backend->option_type( 'short-select' )->render(
                                        'ieffect',
                                        array(
                                            'type'  => 'short-select',
                                            'value' => fw_akg('ieffect', $option['value']),
                                            'choices' => array(
                                                'thz-img-none' => esc_html__('None', 'creatus'),
                                                'thz-img-zoomout' => esc_html__('Zoom out', 'creatus'),
                                                'thz-img-zoomin' => esc_html__('Zoom in', 'creatus'),
                                                'thz-img-zoomin-rotate-right' => esc_html__('Zoom in rotate right', 'creatus'),
                                                'thz-img-zoomin-rotate-left' => esc_html__('Zoom in rotate left', 'creatus')
                                            )
                                        ),
                                        array(
                                            'value' => fw_akg('ieffect', $data['value']),
                                            'id_prefix' => $option['attr']['id'] .'-',
                                            'name_prefix' => $option['attr']['name'],
                                        )
                                    );			
                                ?>
                    </div>
                    <div class="thz-hover-group-option">
                        <div class="thz-hover-option-title">
                            <?php echo esc_html__('Duration','creatus') ?>
                        </div>
                        <?php
                                    echo fw()->backend->option_type( 'short-select' )->render(
                                        'iduration',
                                        array(
                                            'type'  => 'short-select',
                                            'value' => fw_akg('iduration', $option['value']),
                                            'choices' => _thz_transition_duration_list()
                                        ),
                                        array(
                                            'value' => fw_akg('iduration', $data['value']),
                                            'id_prefix' => $option['attr']['id'] .'-',
                                            'name_prefix' => $option['attr']['name'],
                                        )
                                    );			
                                ?>
                    </div>
                </div>
                <div class="thz-hover-desc">
                    <?php echo fw_akg('image', $option['descriptions']) ?>
                </div>
            </div>
        </div>
	</div>
	<?php } ?>
	<?php if(isset($option['value']['iceffect']) && isset($option['value']['icduration'])) { ?>
	<div id="thz-hover-<?php echo esc_attr($id) ?>-iceffect" class="thz-hover-option-holder">
    	<div class="thz-hover-inner-<?php echo esc_attr($id) ?>-iceffect">
            <div class="thz-hover-label fw-col-xs-12 fw-col-sm-3 fw-col-lg-2">
                <?php echo fw_akg('icons', $option['labels']) ?>
            </div>
            <div class="thz-hover-option fw-col-xs-12 fw-col-sm-9 fw-col-lg-10">
                <div class="thz-hover-options-group">
                    <div class="thz-hover-group-option">
                        <div class="thz-hover-option-title">
                            <?php echo esc_html__('Effect','creatus') ?>
                        </div>
                        <?php
                                    echo fw()->backend->option_type( 'short-select' )->render(
                                        'iceffect',
                                        array(
                                            'type'  => 'short-select',
                                            'value' => fw_akg('iceffect', $option['value']),
                                            'choices' => _thz_hover_element_list()
                                        ),
                                        array(
                                            'value' => fw_akg('iceffect', $data['value']),
                                            'id_prefix' => $option['attr']['id'] .'-',
                                            'name_prefix' => $option['attr']['name'],
                                        )
                                    );			
                                ?>
                    </div>
                    <div class="thz-hover-group-option">
                        <div class="thz-hover-option-title">
                            <?php echo esc_html__('Duration','creatus') ?>
                        </div>
                        <?php
                                    echo fw()->backend->option_type( 'short-select' )->render(
                                        'icduration',
                                        array(
                                            'type'  => 'short-select',
                                            'value' => fw_akg('icduration', $option['value']),
                                            'choices' => _thz_transition_duration_list()
                                        ),
                                        array(
                                            'value' => fw_akg('icduration', $data['value']),
                                            'id_prefix' => $option['attr']['id'] .'-',
                                            'name_prefix' => $option['attr']['name'],
                                        )
                                    );			
                                ?>
                    </div>
                </div>
                <div class="thz-hover-desc">
                    <?php echo fw_akg('icons', $option['descriptions']) ?>
                </div>
            </div>
        </div>
	</div>
	<?php } ?>
</div>
