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
	<div class="thz-option-logo-type thz-logo-element">
		<div class="thz-logo-title fw-col-lg-2">
			<?php echo esc_html__('Select logo type', 'creatus') ?>
		</div>
		<div class="thz-logo-input-op fw-col-lg-10">
			<?php
			echo fw()->backend->option_type('thz-radio')->render(
				'type',
				array(
					'label' => false,
					'desc'  => false,
					'type'  => 'thz-radio',
					'value' => fw_akg('type',$option['value']),
					'choices' => array(
						'textual' => esc_html__('Textual', 'creatus'),
						'image' => esc_html__('Image', 'creatus'),
						'svg' => esc_html__('SVG', 'creatus'),
					),
					'inline' => true
				),
				array(
					'value' => fw_akg('type',$data['value']),
					'id_prefix' => 'fw-option-' . $id . '-thz-logo-',
					'name_prefix' => $data['name_prefix'] . '[' . $id . ']',
				)
			)
		?>
		</div>
	</div>
	
	<div class="thz-logo-element">
		<div class="thz-logo-title fw-col-lg-2">
			<?php echo esc_html__('Logo dimensions', 'creatus') ?>
		</div>
		<div class="thz-logo-input-op fw-col-lg-10">
			<div class="thz-logo-element-inline">
				<div class="thz-logo-inline-title">
					<?php echo esc_html__('Width', 'creatus') ?>
				</div>
				<?php
					echo fw()->backend->option_type('thz-spinner')->render(
						'width',
						array(
							'label' => false,
							'desc'  => false,
							'type'  => 'thz-spinner',
							'addon' => 'px',
							'min' => 0,
							'value' => fw_akg('width',$option['value']),
						),
						array(
							'value' => fw_akg('width',$data['value']),
							'id_prefix' => 'fw-option-' . $id . '-thz-logo-',
							'name_prefix' => $data['name_prefix'] . '[' . $id . ']',
						)
					)
				?>
			</div>
			<div class="thz-logo-element-inline">
				<div class="thz-logo-inline-title">
					<?php echo esc_html__('Height', 'creatus') ?>
				</div>
				<?php
					echo fw()->backend->option_type('thz-spinner')->render(
						'height',
						array(
							'label' => false,
							'desc'  => false,
							'addon' => 'px',
							'min' => 0,
							'type'  => 'thz-spinner',
							'value' => fw_akg('height',$option['value']),
						),
						array(
							'value' => fw_akg('height',$data['value']),
							'id_prefix' => 'fw-option-' . $id . '-thz-logo-',
							'name_prefix' => $data['name_prefix'] . '[' . $id . ']',
						)
					)
				?>
			</div>
			<div class="thz-logo-element-inline">
				<div class="thz-logo-inline-title">
					<?php echo esc_html__('Mobile width', 'creatus') ?>
				</div>
				<?php
					echo fw()->backend->option_type('thz-spinner')->render(
						'mwidth',
						array(
							'label' => false,
							'desc'  => false,
							'addon' => 'px',
							'min' => 0,
							'type'  => 'thz-spinner',
							'value' => fw_akg('mwidth',$option['value']),
						),
						array(
							'value' => fw_akg('mwidth',$data['value']),
							'id_prefix' => 'fw-option-' . $id . '-thz-logo-',
							'name_prefix' => $data['name_prefix'] . '[' . $id . ']',
						)
					)
				?>
			</div>
			<div class="thz-logo-element-inline">
				<div class="thz-logo-inline-title">
					<?php echo esc_html__('Mobile height', 'creatus') ?>
				</div>
				<?php
					echo fw()->backend->option_type('thz-spinner')->render(
						'mheight',
						array(
							'label' => false,
							'desc'  => false,
							'addon' => 'px',
							'min' => 0,
							'type'  => 'thz-spinner',
							'value' => fw_akg('mheight',$option['value']),
						),
						array(
							'value' => fw_akg('mheight',$data['value']),
							'id_prefix' => 'fw-option-' . $id . '-thz-logo-',
							'name_prefix' => $data['name_prefix'] . '[' . $id . ']',
						)
					)
				?>
			</div>
		</div>
	</div>
	<div class="thz-logo-element">
		<div class="thz-logo-title fw-col-lg-2">
			<?php echo esc_html__('Logo margin', 'creatus') ?>
		</div>
		<div class="thz-logo-input-op fw-col-lg-10">
			<?php
				echo fw()->backend->option_type('thz-box-style')->render(
					'boxstyle',
					array(
						'label' => false,
						'desc'  => false,
						'type'  => 'thz-box-style',
						'disable' => array('layout','padding','borders','borderradius','boxsize','transform','boxshadow','background'),
						'value' => array(
							'margin' => array(
								'top' => fw_akg('boxstyle/margin/top',$option['value']),
								'right' => fw_akg('boxstyle/margin/right',$option['value']),
								'bottom' => fw_akg('boxstyle/margin/bottom',$option['value']),
								'left' => fw_akg('boxstyle/margin/left',$option['value']),
							)
						)
					),
					array(
						'value' => array(
							'margin' => array(
								'top' => fw_akg('boxstyle/margin/top',$data['value']),
								'right' => fw_akg('boxstyle/margin/right',$data['value']),
								'bottom' => fw_akg('boxstyle/margin/bottom',$data['value']),
								'left' => fw_akg('boxstyle/margin/left',$data['value']),
							)
						),
						'id_prefix' => 'fw-option-' . $id . '-thz-logo-',
						'name_prefix' => $data['name_prefix'] . '[' . $id . ']',
					)
				)
			?>
		</div>
	</div>
	
	<div class="thz-template-logo-textual" data-options-template="<?php echo fw_htmlspecialchars(
	
		'<div class="thz-logo-element">'.
		'<div class="thz-logo-title fw-col-lg-2">'.__('Logo text', 'creatus').'</div>'.
		'<div class="thz-logo-input-op fw-col-lg-10">'.
		fw()->backend->option_type('text')->render(
			'text',
			array(
				'label' => false,
				'desc'  => false,
				'type' => 'text',
				'value' => fw_akg('text',$option['value']),
				'attr' => array(
					'class' =>'logo_preview'
				),
			),
			array(
				'value' => fw_akg('text',$data['value']),
				'id_prefix' => 'fw-option-' . $id . '-thz-logo-',
				'name_prefix' => $data['name_prefix'] . '[' . $id . ']',
			)
		).'</div>'
		.'</div>'.
		
		'<div class="thz-logo-element">'.		
		'<div class="thz-logo-title fw-col-lg-2">'.__('Logo text font', 'creatus').'</div>'.
		'<div class="thz-logo-input-op fw-col-lg-10">'.
		fw()->backend->option_type('thz-typography')->render(
			'f',
			array(
				'label' => false,
				'desc'  => false,
				'type' => 'thz-typography',
				'attr' => array(
					'data-typo-connect' =>'.logo_preview'
				),
				'value' => fw_akg('f',$option['value']),
				'disable' => array('hovered')
			),
			array(
				'value' => fw_akg('f',$data['value']),
				'id_prefix' => 'fw-option-' . $id . '-thz-logo-',
				'name_prefix' => $data['name_prefix'] . '[' . $id . ']',
			)
		).'</div>'
		.'</div>'.
		

		'<div class="thz-logo-element">'.
		'<div class="thz-logo-title fw-col-lg-2">'.__('Logo sub text', 'creatus').'</div>'.
		'<div class="thz-logo-input-op fw-col-lg-10">'.
		fw()->backend->option_type('text')->render(
			'sub-text',
			array(
				'label' => false,
				'desc'  => false,
				'type' => 'text',
				'value' => fw_akg('sub-text',$option['value']),
				'attr' => array(
					'class' =>'logo_sub_preview'
				),
			),
			array(
				'value' => fw_akg('sub-text',$data['value']),
				'id_prefix' => 'fw-option-' . $id . '-thz-logo-',
				'name_prefix' => $data['name_prefix'] . '[' . $id . ']',
			)
		).'</div>'
		.'</div>'.
		
		'<div class="thz-logo-element">'.		
		'<div class="thz-logo-title fw-col-lg-2">'.__('Logo sub text font', 'creatus').'</div>'.
		'<div class="thz-logo-input-op fw-col-lg-10">'.
		fw()->backend->option_type('thz-typography')->render(
			'sub-f',
			array(
				'label' => false,
				'desc'  => false,
				'type' => 'thz-typography',
				'attr' => array(
					'data-typo-connect' =>'.logo_sub_preview'
				),
				'value' => fw_akg('sub-f',$option['value']),
				'disable' => array('hovered')
			),
			array(
				'value' => fw_akg('sub-f',$data['value']),
				'id_prefix' => 'fw-option-' . $id . '-thz-logo-',
				'name_prefix' => $data['name_prefix'] . '[' . $id . ']',
			)
		).'</div></div>'.

		'<div class="thz-logo-element">'.		
		'<div class="thz-logo-title fw-col-lg-2">'.__('Dark header colors', 'creatus').'</div>'.
		'<div class="thz-logo-input-op fw-col-lg-10">'.
		fw()->backend->option_type('thz-multi-options')->render(
			'ds',
			array(
				'label' => false,
				'desc'  => false,
				'type' => 'thz-multi-options',
				'value' => array(
					't' => fw_akg('ds/t',$option['value'],''),
					's' => fw_akg('ds/s',$option['value'],'')
				),
				'thz_options' => array(
					't' => array(
						'type' => 'color',
						'title' => esc_html__('Text', 'creatus'),
						'box' => true,
					),
					's' => array(
						'type' => 'color',
						'title' => esc_html__('Sub text', 'creatus'),
						'box' => true,
					)
				)
			),
			array(
				'value' => array(
					't' => fw_akg('ds/t',$data['value'],''),
					's' => fw_akg('ds/s',$data['value'],'')
				),
				'id_prefix' => 'fw-option-' . $id . '-thz-logo-',
				'name_prefix' => $data['name_prefix'] . '[' . $id . ']',
			)
		).'<div class="thz-logo-desc">'.__('Select logo text colors for dark header', 'creatus').'</div></div></div>'.
		
		'<div class="thz-logo-element">'.		
		'<div class="thz-logo-title fw-col-lg-2">'.__('Light header colors', 'creatus').'</div>'.
		'<div class="thz-logo-input-op fw-col-lg-10">'.
		fw()->backend->option_type('thz-multi-options')->render(
			'ls',
			array(
				'label' => false,
				'desc'  => false,
				'type' => 'thz-multi-options',
				'value' => array(
					't' => fw_akg('ls/t',$option['value'],''),
					's' => fw_akg('ls/s',$option['value'],'')
				),
				'thz_options' => array(
					't' => array(
						'type' => 'color',
						'title' => esc_html__('Text', 'creatus'),
						'box' => true,
					),
					's' => array(
						'type' => 'color',
						'title' => esc_html__('Sub text', 'creatus'),
						'box' => true,
					)
				)
			),
			array(
				'value' => array(
					't' => fw_akg('ls/t',$data['value'],''),
					's' => fw_akg('ls/s',$data['value'],'')
				),
				'id_prefix' => 'fw-option-' . $id . '-thz-logo-',
				'name_prefix' => $data['name_prefix'] . '[' . $id . ']',
			)
		).'<div class="thz-logo-desc">'.__('Select logo text colors for light header', 'creatus').'</div></div></div>'.

		'<div class="thz-logo-element">'.		
		'<div class="thz-logo-title fw-col-lg-2">'.__('Sticky header colors', 'creatus').'</div>'.
		'<div class="thz-logo-input-op fw-col-lg-10">'.
		fw()->backend->option_type('thz-multi-options')->render(
			'sc',
			array(
				'label' => false,
				'desc'  => false,
				'type' => 'thz-multi-options',
				'value' => array(
					't' => fw_akg('sc/t',$option['value'],''),
					's' => fw_akg('sc/s',$option['value'],'')
				),
				'thz_options' => array(
					't' => array(
						'type' => 'color',
						'title' => esc_html__('Text', 'creatus'),
						'box' => true,
					),
					's' => array(
						'type' => 'color',
						'title' => esc_html__('Sub text', 'creatus'),
						'box' => true,
					)
				)
			),
			array(
				'value' => array(
					't' => fw_akg('sc/t',$data['value'],''),
					's' => fw_akg('sc/s',$data['value'],'')
				),
				'id_prefix' => 'fw-option-' . $id . '-thz-logo-',
				'name_prefix' => $data['name_prefix'] . '[' . $id . ']',
			)
		).'<div class="thz-logo-desc">'.__('Select logo text colors for sticky header', 'creatus').'</div></div></div>'.
		
		
		
		'<div class="thz-logo-element">'.		
		'<div class="thz-logo-title fw-col-lg-2">'.__('Mobile menu colors', 'creatus').'</div>'.
		'<div class="thz-logo-input-op fw-col-lg-10">'.
		fw()->backend->option_type('thz-multi-options')->render(
			'mc',
			array(
				'label' => false,
				'desc'  => false,
				'type' => 'thz-multi-options',
				'value' => array(
					't' => fw_akg('mc/t',$option['value'],''),
					's' => fw_akg('mc/s',$option['value'],'')
				),
				'thz_options' => array(
					't' => array(
						'type' => 'color',
						'title' => esc_html__('Text', 'creatus'),
						'box' => true,
					),
					's' => array(
						'type' => 'color',
						'title' => esc_html__('Sub text', 'creatus'),
						'box' => true,
					)
				)
			),
			array(
				'value' => array(
					't' => fw_akg('mc/t',$data['value'],''),
					's' => fw_akg('mc/s',$data['value'],'')
				),
				'id_prefix' => 'fw-option-' . $id . '-thz-logo-',
				'name_prefix' => $data['name_prefix'] . '[' . $id . ']',
			)
		).'<div class="thz-logo-desc">'.__('Select logo text colors for mobile menu', 'creatus').'</div></div></div>'
		
	
		
		

	) ?>">
	</div>
	<div class="thz-template-logo-svg" data-options-template="<?php echo fw_htmlspecialchars(
			
			
			
		'<div class="thz-logo-element">'.
		'<div class="thz-logo-title fw-col-lg-2">'. esc_html__('SVG logo', 'creatus').'</div>'.
		'<div class="thz-logo-input-op fw-col-lg-10">'.
			fw()->backend->option_type('upload')->render(
				'svgimg',
				array(
					'label' => false,
					'desc'  => false,
					'type' => 'upload',
					'images_only' => true,
					'value' => fw_akg('svgimg',$option['value']),
				),
				array(
					'value' => fw_akg('svgimg',$data['value']),
					'id_prefix' => 'fw-option-' . $id . '-thz-logo-',
					'name_prefix' => $data['name_prefix'] . '[' . $id . ']',
				)
			).'<div class="thz-logo-desc">'.__('Select SVG logo image', 'creatus').' <div class="fw-option-help fw-option-help-in-label dashicons dashicons-info" title="'.__('There are two ways to add logo SVG. Fast way is to select any image and add your logo SVG code in the image description textarea. Another way is to enable WordPress SVG uploads. To do so you need to use 3rd party plugin that allows this feature.', 'creatus').'"></div></div></div></div>'.
					
		'<div class="thz-logo-element">'.		
		'<div class="thz-logo-title fw-col-lg-2">'.__('SVG metrics', 'creatus').'</div>'.
		'<div class="thz-logo-input-op fw-col-lg-10">'.
		fw()->backend->option_type('thz-multi-options')->render(
			'svg',
			array(
				'label' => false,
				'desc'  => false,
				'type' => 'thz-multi-options',
				'value' => array(
					'd' => fw_akg('svg/d',$option['value']),
					'ds' => fw_akg('svg/ds',$option['value']),
					'ls' => fw_akg('svg/ls',$option['value']),
					's' => fw_akg('svg/s',$option['value']),
					'm' => fw_akg('svg/m',$option['value']),
					'a' => fw_akg('svg/a',$option['value'])
				),
				'breakafter' => 'c',
				'thz_options' => array(
					'd' => array(
						'type' => 'color',
						'title' => esc_html__('Default color', 'creatus'),
						'box' => true,
					),
					'ds' => array(
						'type' => 'color',
						'title' => esc_html__('Dark header color', 'creatus'),
						'box' => true,
					),
					'ls' => array(
						'type' => 'color',
						'title' => esc_html__('Light header color', 'creatus'),
						'box' => true,
					),
					's' => array(
						'type' => 'color',
						'title' => esc_html__('Sticky color', 'creatus'),
						'box' => true,
					),
					'm' => array(
						'type' => 'color',
						'title' => esc_html__('Mobile color', 'creatus'),
						'box' => true,
					),
					'a' => array(
						'type' => 'short-select',
						'title' => esc_html__('Apply colors to', 'creatus'),
						'choices' => array(
							'fill' =>  esc_html__('Fill', 'creatus'),
							'stroke' =>  esc_html__('Stroke', 'creatus'),
							'both' =>  esc_html__('Both', 'creatus')
						),
					)
				)
			),
			array(
				'value' => array(
					'd' => fw_akg('svg/d',$data['value'],''),
					'ds' => fw_akg('svg/ds',$data['value'],''),
					'ls' => fw_akg('svg/ls',$data['value'],''),
					's' => fw_akg('svg/s',$data['value'],''),
					'm' => fw_akg('svg/m',$data['value'],''),
					'a' => fw_akg('svg/a',$data['value'],'fill')
				),
				'id_prefix' => 'fw-option-' . $id . '-thz-logo-',
				'name_prefix' => $data['name_prefix'] . '[' . $id . ']',
			)
		).'<div class="thz-logo-desc">'.__('Add logo SVG code here and adjust the colors.', 'creatus').'</div></div></div>'

	) 
	?>">
	</div>
    
<div class="thz-template-logo-image" data-options-template="<?php echo fw_htmlspecialchars(
			
			'<div class="thz-logo-element">'.
			'<div class="thz-logo-title fw-col-lg-2">'. esc_html__('Default logo', 'creatus').'</div>'.
			'<div class="thz-logo-input-op fw-col-lg-10">'.
				fw()->backend->option_type('upload')->render(
					'image',
					array(
						'label' => false,
						'desc'  => false,
						'type' => 'upload',
						'images_only' => true,
						'value' => fw_akg('image',$option['value']),
					),
					array(
						'value' => fw_akg('image',$data['value']),
						'id_prefix' => 'fw-option-' . $id . '-thz-logo-',
						'name_prefix' => $data['name_prefix'] . '[' . $id . ']',
					)
				).'<div class="thz-logo-desc">'.__('Select default logo image', 'creatus').' <div class="fw-option-help fw-option-help-in-label dashicons dashicons-info" title="'.__('Upload double size ( retina logo ) image to have crisp looking logo on retina devices. You can than adjust desired width and height in the Logo dimensions option above.', 'creatus').'"></div></div></div></div>'.


			// dark header logo	
			'<div class="thz-logo-element">'.
			'<div class="thz-logo-title fw-col-lg-2">'. esc_html__('Dark header logo', 'creatus').'</div>'.
			'<div class="thz-logo-input-op fw-col-lg-10">'.
				fw()->backend->option_type('upload')->render(
					'darksections',
					array(
						'label' => false,
						'desc'  => false,
						'type' => 'upload',
						'images_only' => true,
						'value' => fw_akg('darksections',$option['value']),
					),
					array(
						'value' => fw_akg('darksections',$data['value']),
						'id_prefix' => 'fw-option-' . $id . '-thz-logo-',
						'name_prefix' => $data['name_prefix'] . '[' . $id . ']',
					)
				).'<div class="thz-logo-desc">'.__('Select logo image for dark header', 'creatus').' <div class="fw-option-help fw-option-help-in-label dashicons dashicons-info" title="'.__('Page builder sections have a brightness option and page itself has a Header brightness option. When you scroll the page up or down the body tag gets .thz-brightness-dark or light class name depending on the section in view brightness or page header brightness option. You can use this class to additionally style parts of the page based on brightness. This logo image should be same size as default logo. Preferably dark color. This logo will override sticky logo! Note that if image is not uploaded, default logo image is used.', 'creatus').'"></div></div></div></div>'.
				
				
			// light sections logo	
			'<div class="thz-logo-element">'.
			'<div class="thz-logo-title fw-col-lg-2">'. esc_html__('Light header logo', 'creatus').'</div>'.
			'<div class="thz-logo-input-op fw-col-lg-10">'.
				fw()->backend->option_type('upload')->render(
					'lightsections',
					array(
						'label' => false,
						'desc'  => false,
						'type' => 'upload',
						'images_only' => true,
						'value' => fw_akg('lightsections',$option['value']),
					),
					array(
						'value' => fw_akg('lightsections',$data['value']),
						'id_prefix' => 'fw-option-' . $id . '-thz-logo-',
						'name_prefix' => $data['name_prefix'] . '[' . $id . ']',
					)
				).'<div class="thz-logo-desc">'.__('Select logo image for light header', 'creatus').' <div class="fw-option-help fw-option-help-in-label dashicons dashicons-info" title="'.__('Page builder sections have a brightness option and page itself has a Header brightness option. When you scroll the page up or down the body tag gets .thz-brightness-dark or light class name depending on the section in view brightness or page header brightness option. You can use this class to additionally style parts of the page based on brightness. This logo image should be same size as default logo. Preferably light color. This logo will override sticky logo! Note that if image is not uploaded, default logo image is used.', 'creatus').'"></div></div></div></div>'.
				
			// sticky logo		
			'<div class="thz-logo-element">'.
			'<div class="thz-logo-title fw-col-lg-2">'. esc_html__('Sticky logo', 'creatus').'</div>'.
			'<div class="thz-logo-input-op fw-col-lg-10">'.
				fw()->backend->option_type('upload')->render(
					'sticky',
					array(
						'label' => false,
						'desc'  => false,
						'type' => 'upload',
						'images_only' => true,
						'value' => fw_akg('sticky',$option['value']),
					),
					array(
						'value' => fw_akg('sticky',$data['value']),
						'id_prefix' => 'fw-option-' . $id . '-thz-logo-',
						'name_prefix' => $data['name_prefix'] . '[' . $id . ']',
					)
				).'<div class="thz-logo-desc">'.__('Select logo image for sticky header', 'creatus').' <div class="fw-option-help fw-option-help-in-label dashicons dashicons-info" title="'.__('This should be same size as default logo. Preferably different color if your sticky header has different background. Note that if image is not uploaded, default logo image is used.', 'creatus').'"></div></div></div></div>'.
				
			// mobile logo	
			'<div class="thz-logo-element">'.
			'<div class="thz-logo-title fw-col-lg-2">'. esc_html__('Mobile logo', 'creatus').'</div>'.
			'<div class="thz-logo-input-op fw-col-lg-10">'.
				fw()->backend->option_type('upload')->render(
					'mobile',
					array(
						'label' => false,
						'desc'  => false,
						'type' => 'upload',
						'images_only' => true,
						'value' => fw_akg('mobile',$option['value']),
					),
					array(
						'value' => fw_akg('mobile',$data['value']),
						'id_prefix' => 'fw-option-' . $id . '-thz-logo-',
						'name_prefix' => $data['name_prefix'] . '[' . $id . ']',
					)
				).'<div class="thz-logo-desc">'.__('Select logo image for mobile devices', 'creatus').' <div class="fw-option-help fw-option-help-in-label dashicons dashicons-info" title="'.__('Upload double size ( retina logo ) image to have crisp looking logo on retina devices. You can than adjust desired width and height in the Logo dimensions option above. Note that if image is not uploaded, default logo image is used.', 'creatus').'"></div></div></div></div>'

	) 
	?>">
	</div>
</div>