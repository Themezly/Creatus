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

$disabled = $option['disable'];
unset($defaults['color'],$defaults['image'],$defaults['video'],$defaults['gradient'],$defaults['shape']);

$single_tab_class 	= '';
$is_single 			= false;
$default_order		= array('layout','padding','margin','borders','borderradius','boxsize','boxshadow','background');
$current_tabs 		= array_diff($default_order,$disabled);
$factive 			= current ($current_tabs);
$number_of_options 	= count($current_tabs);

if($number_of_options == 1){
	$single_tab_class =' thz-boxstyle-singletab';
	$is_single = true;
}

?>
<!-- START BOX-STYLE -->
<div <?php echo fw_attr_to_html($div_attr) ?> >
	<div class="thz-boxstyle-holder thz-tabs-group<?php echo esc_attr($single_tab_class)?>" data-isopen="<?php echo esc_attr($factive) ?>" data-tabs-group="<?php echo esc_attr($id) ?>">
		<?php if($number_of_options > 1) { ?>
		<div class="thz-tabs-list-holder">
			<ul class="thz-tabs-list">
				<?php if (!in_array('layout',$option['disable'])) : ?>
				<li class="<?php echo $factive == 'layout' ? 'active-tab-link' : 'notactive-tab-link'; ?>" data-tabs-group="<?php echo esc_attr($id) ?>">
					<a href="#" class="thz-tab-link" data-tab="<?php echo esc_attr($id)?>-layout" data-group="layout">
						<?php echo esc_html__( 'Layout', 'creatus' ) ?>
					</a>
				</li>
				<?php endif; ?>
				<?php if (!in_array('padding',$option['disable'])) : ?>
				<li class="<?php echo $factive == 'padding' ? 'active-tab-link' : 'notactive-tab-link'; ?>" data-tabs-group="<?php echo esc_attr($id) ?>">
					<a href="#" class="thz-tab-link" data-tab="<?php echo esc_attr($id)?>-padding" data-group="padding">
						<?php echo esc_html__( 'Padding', 'creatus' ) ?>
					</a>
				</li>
				<?php endif; ?>
				<?php if (!in_array('margin',$option['disable'])) : ?>
				<li class="<?php echo $factive == 'margin' ? 'active-tab-link' : 'notactive-tab-link'; ?>" data-tabs-group="<?php echo esc_attr($id) ?>">
					<a href="#" class="thz-tab-link" data-tab="<?php echo $id?>-margin" data-group="margin">
						<?php echo esc_html__( 'Margin', 'creatus' ) ?>
					</a>
				</li>
				<?php endif; ?>
				<?php if (!in_array('borders',$option['disable'])) : ?>
				<li class="<?php echo $factive == 'borders' ? 'active-tab-link' : 'notactive-tab-link'; ?>" data-tabs-group="<?php echo esc_attr($id) ?>">
					<a href="#" class="thz-tab-link" data-tab="<?php echo esc_attr($id)?>-borders" data-group="borders">
						<?php echo esc_html__( 'Border', 'creatus' ) ?>
					</a>
				</li>
				<?php endif; ?>
				<?php if (!in_array('borderradius',$option['disable'])) : ?>
				<li class="<?php echo $factive == 'borderradius' ? 'active-tab-link' : 'notactive-tab-link'; ?>" data-tabs-group="<?php echo esc_attr($id) ?>">
					<a href="#" class="thz-tab-link" data-tab="<?php echo esc_attr($id)?>-borderradius" data-group="borderradius">
						<?php echo esc_html__( 'Border radius', 'creatus' ) ?>
					</a>
				</li>
				<?php endif; ?>
				<?php if (!in_array('boxsize',$option['disable'])) : ?>
				<li class="<?php echo $factive == 'boxsize' ? 'active-tab-link' : 'notactive-tab-link'; ?>" data-tabs-group="<?php echo esc_attr($id) ?>">
					<a href="#" class="thz-tab-link" data-tab="<?php echo esc_attr($id)?>-boxsize" data-group="boxsize">
						<?php echo esc_html__( 'Boxsize', 'creatus' ) ?>
					</a>
				</li>
				<?php endif; ?>
				<?php if (!in_array('boxshadow',$option['disable'])) : ?>
				<li class="<?php echo $factive == 'boxshadow' ? 'active-tab-link' : 'notactive-tab-link'; ?>" data-tabs-group="<?php echo esc_attr($id) ?>">
					<a href="#" class="thz-tab-link" data-tab="<?php echo esc_attr($id)?>-boxshadow" data-group="boxshadow">
						<?php echo esc_html__( 'Box shadow', 'creatus' ) ?>
					</a>
				</li>
				<?php endif; ?>
				<?php if (!in_array('transform',$option['disable'])) : ?>
				<li class="<?php echo $factive == 'transform' ? 'active-tab-link' : 'notactive-tab-link'; ?>" data-tabs-group="<?php echo esc_attr($id) ?>">
					<a href="#" class="thz-tab-link" data-tab="<?php echo esc_attr($id)?>-transform" data-group="transform">
						<?php echo esc_html__( 'Transform', 'creatus' ) ?>
					</a>
				</li>
				<?php endif; ?>            
				<?php if (!in_array('background',$option['disable'])) : ?>
				<li class="<?php echo $factive == 'background' ? 'active-tab-link' : 'notactive-tab-link'; ?>" data-tabs-group="<?php echo esc_attr($id) ?>">
					<a href="#" class="thz-tab-link" data-tab="<?php echo esc_attr($id)?>-background" data-group="background">
						<?php echo esc_html__( 'Background', 'creatus' ) ?>
					</a>
				</li>
				<?php endif; ?>
			</ul>
			<div class="fw-clear">
			</div>
		</div>
		<?php  } ?>
		<div class="thz-tabs-content">
			<?php if (!in_array('layout',$option['disable'])) : ?>
			<div class="thz-tab <?php echo $factive == 'layout' ? 'active-tab' : 'notactive-tab'; ?>" data-tab="<?php echo esc_attr($id)?>-layout" data-tabs-group="<?php echo esc_attr($id) ?>">
				<div class="thz-box-style-element thz-bs-layout">
					<?php 

					$corder = array('display', 'float', 'clear', 'overflow','visibility', 'opacity',  'position', 'top', 'right', 'bottom', 'left', 'z-index');
					$layoutOrder = thz_reorder_array($option['value']['layout'],$corder);
					
					echo fw()->backend->option_type( 'thz-multi-options' )->render(
						'layout',
						array(
							'type'  => 'thz-multi-options',
							'label' => false,
							'value'  => $layoutOrder,
							'breakafter'=> array('clear','position'),
							'thz_options' => array(
								'display' => array(
									'type' => 'short-select',
									'title' => esc_html__('Display', 'creatus'),
									'attr' => array(
										'class' => 'thz-bs-display'
									),
									'choices'=> array(
										'default' =>__('Default', 'creatus'),
										'inline' =>__('Inline', 'creatus'),
										'block' =>__('Block', 'creatus'),
										'none' =>__('None', 'creatus'),
										'flex' =>__('Flex', 'creatus'),
										'inline-block' =>__('Inline block', 'creatus'),
										'inline-flex' =>__('Inline flex', 'creatus'),
										'inline-table' =>__('Inlne table', 'creatus'),
										'list-item' =>__('List item', 'creatus'),
										'run-in' =>__('Run in', 'creatus'),
										'table' =>__('Table', 'creatus'),
										'table-caption' =>__('Table caption', 'creatus'),
										'table-column-group' =>__('Table column group', 'creatus'),
										'table-header-group' =>__('Table header group', 'creatus'),
										'table-footer-group' =>__('Table footer group', 'creatus'),
										'table-cell' =>__('Table cell', 'creatus'),
										'table-column' =>__('Table column', 'creatus'),
										'table-row' =>__('Table row', 'creatus'),
									)
								),	
								
								'float' => array(
									'type' => 'short-select',
									'title' => esc_html__('Float', 'creatus'),
									'choices'=> array(
										'default' =>__('Default', 'creatus'),
										'left' =>__('Left', 'creatus'),
										'right' =>__('Right', 'creatus'),
										'none' =>__('None', 'creatus'),
									)
								),	
														
								'clear' => array(
									'type' => 'short-select',
									'title' => esc_html__('Clear', 'creatus'),
									'choices'=> array(
										'default' =>__('Default', 'creatus'),
										'both' =>__('Both', 'creatus'),
										'left' =>__('Left', 'creatus'),
										'right' =>__('Right', 'creatus'),
										'none' =>__('None', 'creatus'),
										
									)
								),
								
								'overflow' => array(
									'type' => 'short-select',
									'title' => esc_html__('Overflow', 'creatus'),
									'choices'=> array(
										'default' =>__('Default', 'creatus'),
										'hidden' =>__('Hidden', 'creatus'),
										'visible' =>__('Visible', 'creatus'),
										'x-hidden' =>__('X-hidden', 'creatus'),
										'y-hidden' =>__('Y-hidden', 'creatus'),
										'x-visible' =>__('X-visible', 'creatus'),
										'y-visible' =>__('Y-visible', 'creatus'),
										'scroll' =>__('Scroll', 'creatus'),
										'auto' =>__('Auto', 'creatus'),
									)
								),	
							
								'opacity' => array(
									'type' => 'spinner',
									'addon' => 'na',
									'title' => esc_html__('Opacity', 'creatus'),
									'max' => 1,
									'min' => 0,
									'step' => 0.01
								),	
								
								'visibility' => array(
									'type' => 'short-select',
									'title' => esc_html__('Visibility', 'creatus'),
									'choices'=> array(
										'default' =>__('Default', 'creatus'),
										'visible' =>__('Visible', 'creatus'),
										'hidden' =>__('Hidden', 'creatus'),
										'collapse' =>__('Collapse', 'creatus'),
									)
								),	
								'position' => array(
									'type' => 'short-select',
									'title' => esc_html__('Position', 'creatus'),
									'attr' => array(
										'class' => 'thz-bs-poz'
									),
									'choices'=> array(
										'default' => esc_html__('Default', 'creatus'),
										'static' => esc_html__('Static', 'creatus'),
										'relative' => esc_html__('Relative', 'creatus'),
										'absolute' => esc_html__('Absolute', 'creatus'),
										'fixed' =>  esc_html__('Fixed', 'creatus'),
									)
								),
								'top' => array(
									'type' => 'spinner',
									'title' => esc_html__('Top', 'creatus'),
									'addon' =>'px',
									'units' => array('px','auto','%'),
								),
								'right' => array(
									'type' => 'spinner',
									'title' => esc_html__('Right', 'creatus'),
									'addon' =>'px',
									'units' => array('px','auto','%'),
								),
								'bottom' => array(
									'type' => 'spinner',
									'title' => esc_html__('Bottom', 'creatus'),
									'addon' =>'px',
									'units' => array('px','auto','%'),
								),
								'left' => array(
									'type' => 'spinner',
									'title' => esc_html__('Left', 'creatus'),
									'addon' =>'px',
									'units' => array('px','auto','%'),
								),								
								'z-index' => array(
									'type' => 'spinner',
									'title' => esc_html__('Z-index', 'creatus'),
									'addon' =>'#',
									'units' => array('#','auto'),
								),

												
							)
						),
						array(
							'value' => fw_akg('layout', $data['value']),
							'id_prefix' => $option['attr']['id'] .'-',
							'name_prefix' => $option['attr']['name'],
						)
					);	
					?>
                <?php if (!$is_single) {?>
				<span class="thz-box-style-desc">
					<?php echo esc_html__('If default is choosen, theme selector CSS property value is used if exists', 'creatus') ?>
                </span>
				<?php } ?>
				</div>
			</div>
			<?php endif; ?>
			
			<?php if (!in_array('padding',$option['disable'])) : ?>
			<div class="thz-tab <?php echo $factive == 'padding' ? 'active-tab' : 'notactive-tab'; ?>" data-tab="<?php echo esc_attr($id)?>-padding" data-tabs-group="<?php echo esc_attr($id) ?>">
				<div class="thz-box-style-element">
					<?php
						
						$padding_units = $option['units'] && in_array('padding',$option['units']) ?  array('px','%','em','vw','vh','none') :  false;

						echo fw()->backend->option_type( 'thz-multi-options' )->render(
							'padding',
							array(
								'type'  => 'thz-multi-options',
								'label' => false,
								'value' => fw_akg('padding', $option['value']),
								'thz_options' => array(
									'top' => array(
										'type' => 'spinner',
										'title' => esc_html__('Top', 'creatus'),
										'addon' =>'px',
										'min'=> 0,
										'units' => $padding_units,
										'attr'  => array(
											'class' => 'padding-top',
											'placeholder' => fw_akg('padding/top', $option['placeholders'])
										),
									),
									'right' => array(
										'type' => 'spinner',
										'title' => esc_html__('Right', 'creatus'),
										'addon' =>'px',
										'min'=> 0,
										'units' => $padding_units,
										'attr'  => array(
											'class' => 'padding-right',
											'placeholder' => fw_akg('padding/right', $option['placeholders'])
										),
									),
									'bottom' => array(
										'type' => 'spinner',
										'title' => esc_html__('Bottom', 'creatus'),
										'addon' =>'px',
										'min'=> 0,
										'units' => $padding_units,
										'attr'  => array(
											'class' => 'padding-bottom',
											'placeholder' => fw_akg('padding/bottom', $option['placeholders'])
										),
									),	
									'left' => array(
										'type' => 'spinner',
										'title' => esc_html__('Left', 'creatus'),
										'addon' =>'px',
										'min'=> 0,
										'units' => $padding_units,
										'attr'  => array(
											'class' => 'padding-left',
											'placeholder' => fw_akg('padding/left', $option['placeholders'])
										),
									),							
								)
							),
							array(
								'value' => fw_akg('padding', $data['value']),
								'id_prefix' => $option['attr']['id'] .'-',
								'name_prefix' => $option['attr']['name'],
							)
						);

					?>
					<?php if (!$is_single) {?>
                    <span class="thz-box-style-desc"><br />
                        <?php echo esc_html__('All values must be entered for CSS property to be applied. If none is selected as property unit, the property is not used.', 'creatus') ?>
                    </span>
                    <?php } ?>
				</div>
			</div>
			<?php endif; ?>
			<?php if (!in_array('margin',$option['disable'])) : ?>
			<div class="thz-tab <?php echo $factive == 'margin' ? 'active-tab' : 'notactive-tab'; ?>" data-tab="<?php echo esc_attr($id)?>-margin" data-tabs-group="<?php echo esc_attr($id) ?>">
				<div class="thz-box-style-element">
					<?php
						
						$margin_units = $option['units'] && in_array('margin',$option['units']) ? array('px','%','em','auto','vw','vh','none') :  false;
						
						if(!$margin_units){
							
							$margin_units = array('px','auto');
						}
						
						
						echo fw()->backend->option_type( 'thz-multi-options' )->render(
							'margin',
							array(
								'type'  => 'thz-multi-options',
								'label' => false,
								'value' => fw_akg('margin', $option['value']),
								'thz_options' => array(
									'top' => array(
										'type' => 'spinner',
										'title' => esc_html__('Top', 'creatus'),
										'addon' =>'px',
										'min'=> 'min',
										'units' => $margin_units,
										'attr'  => array(
											'class' => 'margin-top',
											'placeholder' => fw_akg('margin/top', $option['placeholders'])
										),
									),
									'right' => array(
										'type' => 'spinner',
										'title' => esc_html__('Right', 'creatus'),
										'addon' =>'px',
										'min'=> 'min',
										'units' => $margin_units,
										'attr'  => array(
											'class' => 'margin-right',
											'placeholder' => fw_akg('margin/right', $option['placeholders'])
										),
									),
									'bottom' => array(
										'type' => 'spinner',
										'title' => esc_html__('Bottom', 'creatus'),
										'addon' =>'px',
										'min'=> 'min',
										'units' => $margin_units,
										'attr'  => array(
											'class' => 'margin-bottom',
											'placeholder' => fw_akg('margin/bottom', $option['placeholders'])
										),
									),	
									'left' => array(
										'type' => 'spinner',
										'title' => esc_html__('Left', 'creatus'),
										'addon' =>'px',
										'min'=> 'min',
										'units' => $margin_units,
										'attr'  => array(
											'class' => 'margin-left',
											'placeholder' => fw_akg('margin/left', $option['placeholders'])
										),
									),							
								)
							),
							array(
								'value' => fw_akg('margin', $data['value']),
								'id_prefix' => $option['attr']['id'] .'-',
								'name_prefix' => $option['attr']['name'],
							)
						);

					?>
					<?php if (!$is_single) {?>
                    <span class="thz-box-style-desc"><br />
                        <?php echo esc_html__('All values must be entered for CSS property to be applied. If none is selected as property unit, the property is not used.', 'creatus') ?>
                    </span>
                    <?php } ?>
				</div>
			</div>
			<?php endif; ?>
			<?php if (!in_array('borders',$option['disable'])) : ?>
			<div class="thz-tab <?php echo $factive == 'borders' ? 'active-tab' : 'notactive-tab'; ?>" data-tab="<?php echo esc_attr($id)?>-borders" data-tabs-group="<?php echo esc_attr($id) ?>">
				<div class="thz-box-style-element thz-bs-borders">
				
						<div class="borders-same-container">
							<?php 
							echo fw()->backend->option_type( 'short-select' )->render(
								'all',
								array(
									'type'  => 'short-select',
									'label' => false,
									'value'  => fw_akg('borders/all', $option['value']),
									'attr'  => array(
										'class' => 'borders-same'
									),
									'choices' => array(
										'same' => esc_html__('All same', 'creatus'),
										'separate' => esc_html__('Each separate', 'creatus')
									)
								),
								array(
									'value' => fw_akg('borders/all', $data['value']),
									'id_prefix' => $option['attr']['id'] .'-borders-',
									'name_prefix' => $option['attr']['name'] . '[borders]',
								)
							);	
							?>				
						</div>
						
						<?php 
							$border_sides =  array('top','right','bottom','left');
							foreach($border_sides as $side ): 
						?>
						<div class="border-side-holder borders-<?php echo $side ?>-container">
							<h4><?php echo esc_attr(ucfirst($side)); ?></h4>
							<?php 
							echo fw()->backend->option_type( 'thz-multi-options' )->render(
								$side,
								array(
									'type'  => 'thz-multi-options',
									'label' => false,
									'value'  => fw_akg('borders/'.$side, $option['value']),
									'thz_options' => array(
									
										'w' => array(
											'type' => 'spinner',
											'addon' => 'px',
											'title' => esc_html__('Width', 'creatus'),
											'min'=> 0,
											'attr'  => array(
												'class' => 'border-width'
											)
										),
										's' => array(
											'type' => 'short-select',
											'title' => esc_html__('Style', 'creatus'),
											'attr'  => array(
												'class' => 'border-style'
											),
											'choices' => array(
												'solid' 		=> esc_html__('Solid', 'creatus'),
												'dashed' 		=> esc_html__('Dashed', 'creatus'),
												'dotted' 		=> esc_html__('Dotted', 'creatus'),
												'double' 		=> esc_html__('Double', 'creatus'),
												'groove' 		=> esc_html__('Groove', 'creatus'),
												'inset' 		=> esc_html__('Inset', 'creatus'),
												'outset' 		=> esc_html__('Outset', 'creatus'),
												'ridge' 		=> esc_html__('Ridge', 'creatus'),
												'inherit' 		=> esc_html__('Inherit', 'creatus'),
												'hidden' 		=> esc_html__('Hidden', 'creatus'),
												'none' 			=> esc_html__('None', 'creatus'),
											),
										),
										'c' => array(
											'type' => 'color',
											'title' => esc_html__('Color', 'creatus'),
											'box' => true,
											'attr'  => array(
												'class' => 'border-color'
											)
										),
									
									)
								),
								array(
									'value' => fw_akg('borders/'.$side, $data['value']),
									'id_prefix' => $option['attr']['id'] .'-borders-',
									'name_prefix' => $option['attr']['name'] . '[borders]',
								)
							);	
							?>				
						</div>
						<?php endforeach;// end border side loop ?>
				</div>
			</div>
			<?php endif; ?>
			<?php if (!in_array('borderradius',$option['disable'])) : ?>
			<div class="thz-tab <?php echo $factive == 'borderradius' ? 'active-tab' : 'notactive-tab'; ?>" data-tab="<?php echo esc_attr($id)?>-borderradius" data-tabs-group="<?php echo esc_attr($id) ?>">
				<div class="thz-box-style-element thz-bs-radius-holder">
					<?php
					
					$borderradius_units = $option['units'] && in_array('borderradius',$option['units']) ? array('px','%') :  false;
					
					foreach (array('top-left', 'top-right', 'bottom-right', 'bottom-left') as $side) {
							echo '<div class="thz-box-style-element-inner">'.  
							fw()->backend->option_type( 'thz-spinner' )->render(
							$side,
							array(
								'addon' =>'px',
								'units' => $borderradius_units,
								'title' => ucfirst(str_replace('-',' ',$side)),
								'value' => fw_akg('borderradius/'. $side, $option['value']),
								'step' => 1,
								'min' => 0,
								'attr'  => array(
									'class' => 'borderradius-'. $side,
									'placeholder' => fw_akg('borderradius/'.$side, $option['placeholders'])
								),
							),
							array(
								'value' => fw_akg('borderradius/'. $side, $data['value']),
								'id_prefix' => $option['attr']['id'] .'-borderradius-',
								'name_prefix' => $option['attr']['name'] . '[borderradius]',
							)
						).'</div>';
					}
					?>
                    <span class="thz-box-style-desc"><br />
                        <?php echo esc_html__('All values must be entered for CSS property to be applied.', 'creatus') ?>
                    </span>
				</div>
			</div>
			<?php endif; ?>
			<?php if (!in_array('boxsize',$option['disable'])) : ?>
			<div class="thz-tab <?php echo $factive == 'boxsize' ? 'active-tab' : 'notactive-tab'; ?>" data-tab="<?php echo esc_attr($id)?>-boxsize" data-tabs-group="<?php echo esc_attr($id) ?>">
				<div class="thz-box-style-element">
					<?php
					
					$bscorder  = array('width', 'height', 'min-width', 'min-height', 'max-width', 'max-height');

					$boxsizeOrder   = thz_reorder_array($option['value']['boxsize'],$bscorder);
					$boxsize_units  = $option['units'] && in_array('boxsize',$option['units']) ? array('px','%','vw','vh','em','rem','auto','none') :  false;
					$default_props  =  $boxsize_units;
					$max_props  	=  $boxsize_units;
					
					if($boxsize_units){
						
						$none_key 	    = thz_find_key_by_val('none',$boxsize_units);
						$auto_key 	    = thz_find_key_by_val('auto',$boxsize_units);
												
						unset($default_props[$none_key],$max_props[$auto_key]);

					}

					echo fw()->backend->option_type( 'thz-multi-options' )->render(
						'boxsize',
						array(
							'type'  => 'thz-multi-options',
							'label' => false,
							'value'  => $boxsizeOrder ,
							'thz_options' => array(
								'width' => array(
									'type' => 'spinner',
									'title' => esc_html__('Width', 'creatus'),
									'addon' =>'px',
									'min'=> 0,
									'units' => $default_props,
								),
								'height' => array(
									'type' => 'spinner',
									'title' => esc_html__('Height', 'creatus'),
									'addon' =>'px',
									'min'=> 0,
									'units' => $default_props,
								),
								'min-width' => array(
									'type' => 'spinner',
									'title' => esc_html__('Min width', 'creatus'),
									'addon' =>'px',
									'min'=> 0,
									'units' => $default_props,
								),								
								'min-height' => array(
									'type' => 'spinner',
									'title' => esc_html__('Min height', 'creatus'),
									'addon' =>'px',
									'min'=> 0,
									'units' => $default_props,
								),	
								'max-width' => array(
									'type' => 'spinner',
									'title' => esc_html__('Max width', 'creatus'),
									'addon' =>'px',
									'min'=> 0,
									'units' => $max_props,
								),
								'max-height' => array(
									'type' => 'spinner',
									'title' => esc_html__('Max height', 'creatus'),
									'addon' =>'px',
									'min'=> 0,
									'units' => $max_props,
								),								
							)
						),
						array(
							'value' => fw_akg('boxsize', $data['value']),
							'id_prefix' => $option['attr']['id'] .'-',
							'name_prefix' => $option['attr']['name'],
						)
					);
					?>
				</div>
			</div>
			<?php endif; ?>
			<?php if (!in_array('boxshadow',$option['disable'])) : ?>
			<div class="thz-tab <?php echo $factive == 'boxshadow' ? 'active-tab' : 'notactive-tab'; ?>" data-tab="<?php echo esc_attr($id)?>-boxshadow" data-tabs-group="<?php echo esc_attr($id) ?>">
				<?php 
				echo fw()->backend->option_type( 'thz-box-shadow' )->render(
					'boxshadow',
					array(
						'type'  => 'thz-box-shadow',
						'label' => false,
						'value'  => fw_akg('boxshadow', $option['value']),
					),
					array(
						'value' => fw_akg('boxshadow', $data['value']),
						'id_prefix' => $option['attr']['id'] .'-',
						'name_prefix' => $option['attr']['name'],
					)
				);	
				?>
			</div>
			<?php endif; ?>
			<?php if (!in_array('transform',$option['disable'])) : ?>
			<div class="thz-tab <?php echo $factive == 'transform' ? 'active-tab' : 'notactive-tab'; ?>" data-tab="<?php echo esc_attr($id)?>-transform" data-tabs-group="<?php echo esc_attr($id) ?>">
				<div class="thz-box-style-element">
					<?php
					
					$trsorder  = array('rotate','scale-x','scale-y','skew-x','skew-y','translate-x','translate-y');

					$transformOrder   = thz_reorder_array($option['value']['transform'],$trsorder);

					echo fw()->backend->option_type( 'thz-multi-options' )->render(
						'transform',
						array(
							'type'  => 'thz-multi-options',
							'label' => false,
							'value'  => $transformOrder ,
							'thz_options' => array(
								
								'rotate' => array(
									'type' => 'spinner',
									'title' => esc_html__('Rotate', 'creatus'),
									'addon' =>'deg',
									'min' => -360,
									'max' => 360,

								),								
								'scale-x' => array(
									'type' => 'spinner',
									'title' => esc_html__('Scale X', 'creatus'),
									'addon' =>'na',
									'min' => 0,
									'step' => 0.01,

								),
								
								'scale-y' => array(
									'type' => 'spinner',
									'title' => esc_html__('Scale Y', 'creatus'),
									'addon' =>'na',
									'min' => 0,
									'step' => 0.01,

								),
								'skew-x' => array(
									'type' => 'spinner',
									'title' => esc_html__('Skew X', 'creatus'),
									'addon' =>'deg',
									'min' => -180,
									'max' => 180,

								),
								
								'skew-y' => array(
									'type' => 'spinner',
									'title' => esc_html__('Skew Y', 'creatus'),
									'addon' =>'deg',
									'min' => -180,
									'max' => 180,

								),	
															
								'translate-x' => array(
									'type' => 'spinner',
									'title' => esc_html__('Translate X', 'creatus'),
									'addon' =>'px',
									'units' => array('px','%'),
								),
				
								'translate-y' => array(
									'type' => 'spinner',
									'title' => esc_html__('Translate Y', 'creatus'),
									'addon' =>'px',
									'units' => array('px','%'),
								),								
							)
						),
						array(
							'value' => fw_akg('transform', $data['value']),
							'id_prefix' => $option['attr']['id'] .'-',
							'name_prefix' => $option['attr']['name'],
						)
					);
					?>
				</div>
			</div>
			<?php endif; ?>           
			<?php if (!in_array('background',$option['disable'])) : ?>
			<div class="thz-tab <?php echo $factive == 'background' ? 'active-tab' : 'notactive-tab'; ?>" data-tab="<?php echo esc_attr($id)?>-background" data-tabs-group="<?php echo esc_attr($id)?>">
				<div class="thz-box-style-element">
				<?php
					
					$bg_disable = empty($option['disable']) ? array() : $option['disable'];
					$bg_disable[] = 'shape';
					
					echo fw()->backend->option_type( 'thz-background' )->render(
					'background',
					array(
						'type'  => 'thz-background',
						'value' => fw_akg('background', $option['value']),
						'featured' => $option['featured'],
						'attr'  => array(
							'class' => 'thz-style-background'
						),
						'print-css'=>false,
						'disable' => $bg_disable
					),
					array(
						'value' => fw_akg('background', $data['value']),
						'id_prefix' => $option['attr']['id'] .'-',
						'name_prefix' => $option['attr']['name'],
					)
				);
				?>
				</div>
			</div>
			<?php endif; ?>

		</div>
	<div class="fw-clear">
	</div>
	<?php if (isset($option['preview']) && $option['preview'] !== false) : 
		$bgdisabledclass = in_array('background',$option['disable']) ? ' bg-disabled' : '';
		$preview = '<div class="thz-box-style-preview-holder'.$bgdisabledclass.'">';
		$preview .='<div class="thz-box-style-preview-desc">';
		$preview .='<span>';
		$preview .=__('This is your rough preview. Click around the options to see it.','creatus');
		$preview .='</span>';
		$preview .='</div>';
		$preview .='<div class="thz-box-style-preview"></div>';
		$preview .='</div>';
		echo fw()->backend->option_type( 'thz-separator' )->render(
		'background',
			array(
				'type'  => 'thz-separator',
				'value' => false,
				'html'	=>$preview
			)
		);
	endif; ?>
	</div>
	<?php
	echo fw()->backend->option_type( 'hidden' )->render(
		'css',
		array(
			'value' => $optioncss,
			'attr'  => array(
				'class' => 'thz-boxstyle-css'
			)
		),
		array(
			'value' => $datacss,
			'id_prefix' => $option['attr']['id'].'-',
			'name_prefix' => $option['attr']['name'],
		)
	);					
	?>
</div>
<!-- END BOX-STYLE -->