<?php
if (!defined('FW')) {
	die('Forbidden');
}
$options = array(
'layouttab' => array(
		'title' => __('Layout', 'creatus'),
		'type' => 'tab',
		'options' => array(
			'tabcm' => array(
				'type' => 'thz-box-style',
				'label' => __('Tabs container margin', 'creatus'),
				'preview' => false,
				'popup' => false,
				'desc' => esc_html__('Set tabs container margin', 'creatus'),
				'disable' => array('layout','padding','borders','borderradius','boxsize','transform','boxshadow','background'),
				'value' => array(
					'margin' => array(
						'top' => 0,
						'right' => 0,
						'bottom' => 0,
						'left' => 0
					)
				)
			),
			'tabl' => array(
				'type' => 'thz-multi-options',
				'label' => __('Tab links setting', 'creatus'),
				'desc' => esc_html__('Choose tabs links layout, border radius or set the space between the tab links', 'creatus'),
				'value' => array(
					'lay' => 'centered',
					'lsp' => 0,
					'lbr' => 4
				),
				'thz_options' => array(
					'lay' => array(
						'type' => 'short-select',
						'title' => esc_html__('Layout', 'creatus'),
						'attr' => array(
							'class' => 'thz-select-switch'
						),
						'choices' => array(
							'top' => array(
								'text' => esc_html__('Top left', 'creatus'),
								'attr' => array(
									'data-enable' => '.thz-mh-fw-edit-options-modal-tabl-lsp,.thz-mh-fw-edit-options-modal-tabl-lbr'
								)
							),
							'centered' => array(
								'text' => esc_html__('Top centered', 'creatus'),
								'attr' => array(
									'data-enable' => '.thz-mh-fw-edit-options-modal-tabl-lsp,.thz-mh-fw-edit-options-modal-tabl-lbr'
								)
							),
							'topright' => array(
								'text' => esc_html__('Top right', 'creatus'),
								'attr' => array(
									'data-enable' => '.thz-mh-fw-edit-options-modal-tabl-lsp,.thz-mh-fw-edit-options-modal-tabl-lbr'
								)
							),
							'left' => array(
								'text' => esc_html__('Left side', 'creatus'),
								'attr' => array(
									'data-disable' => '.thz-mh-fw-edit-options-modal-tabl-lsp,.thz-mh-fw-edit-options-modal-tabl-lbr'
								)
							),
							'right' => array(
								'text' => esc_html__('Right side', 'creatus'),
								'attr' => array(
									'data-disable' => '.thz-mh-fw-edit-options-modal-tabl-lsp,.thz-mh-fw-edit-options-modal-tabl-lbr'
								)
							),
							'full' => array(
								'text' => esc_html__('Full width', 'creatus'),
								'attr' => array(
									'data-disable' => '.thz-mh-fw-edit-options-modal-tabl-lsp',
									'data-enable' => '.thz-mh-fw-edit-options-modal-tabl-lbr'
								)
							)
						)
					),
					'lsp' => array(
						'type' => 'spinner',
						'addon' => 'px',
						'title' => esc_html__('Space', 'creatus')
					),
					'lbr' => array(
						'type' => 'spinner',
						'addon' => 'px',
						'title' => esc_html__('Border radius', 'creatus')
					)
				)
			),
			'tablp' => array(
				'type' => 'thz-box-style',
				'label' => __('Tab link padding', 'creatus'),
				'preview' => false,
				'popup' => false,
				'desc' => esc_html__('Set the padding of tabs menu link item.', 'creatus'),
				'disable' => array('layout','margin','borders','borderradius','boxsize','transform','boxshadow','background'),
				'value' => array(
					'padding' => array(
						'top' => '0',
						'right' => '15',
						'bottom' => '7.5',
						'left' => '15'
					)
				)
			),
			'tabcbs' => array(
				'type' => 'thz-box-style',
				'label' => __('Content box style', 'creatus'),
				'desc' => esc_html__('Adjust .thz-tab-content', 'creatus'),
				'preview' => true,
				'popup' => true,
				'button-text' => esc_html__('Customize content box', 'creatus'),
				'disable' => array('layout','margin','borderradius','boxsize','transform','boxshadow','video'),
				'value' => array(
					'padding' => array(
						'top' => 60,
						'right' => 120,
						'bottom' => 60,
						'left' => 120
					),
					'borders' => array(
						'all' => 'separate',
						'top' => array(
							'w' => 1,
							's' => 'solid',
							'c' => 'color_4'
						),
						'right' => array(
							'w' => 0,
							's' => 'solid',
							'c' => ''
						),
						'bottom' => array(
							'w' => 0,
							's' => 'solid',
							'c' => ''
						),
						'left' => array(
							'w' => 0,
							's' => 'solid',
							'c' => ''
						)
					),
				)
			),
			'tabcibs' => array(
				'type' => 'thz-box-style',
				'label' => __('Content inner box style', 'creatus'),
				'desc' => esc_html__('Adjust .thz-tab-content-inner', 'creatus'),
				'preview' => true,
				'popup' => true,
				'button-text' => esc_html__('Customize content inner box style', 'creatus'),
				'disable' => array('layout','video'),
				'value' => array()
			)
			
		)
	),
	'stylingtab' => array(
		'title' => __('Styling', 'creatus'),
		'type' => 'tab',
		'options' => array(
			'tabf' => array(
				'type' => 'thz-typography',
				'label' => __('Title font', 'creatus'),
				'desc' => esc_html__('Tabs title font metrics', 'creatus'),
				'value' => array(
					'size' => 16,
					'weight' => 600
				),
				'disable' => array('color','hovered','align'),
			),
			'tababs' => array(
				'type' => 'thz-box-style',
				'label' => __('Active link', 'creatus'),
				'desc' => esc_html__('Adjust .thz-active-tab .thz-tab-button', 'creatus'),
				'preview' => true,
				'popup' => true,
				'button-text' => esc_html__('Customize active tab', 'creatus'),
				'disable' => array('layout','padding','margin','borderradius','boxsize','transform','boxshadow','video'),
				'value' => array(
					'borders' => array(
						'all' => 'separate',
						'top' => array(
							'w' => 0,
							's' => 'solid',
							'c' => ''
						),
						'right' => array(
							'w' => 0,
							's' => 'solid',
							'c' => ''
						),
						'bottom' => array(
							'w' => 2,
							's' => 'solid',
							'c' => 'color_2'
						),
						'left' => array(
							'w' => 0,
							's' => 'solid',
							'c' => ''
						)
					),

				)
			),
			'tabibs' => array(
				'type' => 'thz-box-style',
				'label' => __('Inactive link', 'creatus'),
				'desc' => esc_html__('Adjust .thz-inactive-tab .thz-tab-button', 'creatus'),
				'preview' => true,
				'popup' => true,
				'button-text' => esc_html__('Customize inactive tab', 'creatus'),
				'disable' => array('layout','padding','margin','borderradius','boxsize','transform','boxshadow','video'),
				'value' => array(
					'borders' => array(
						'all' => 'separate',
						'top' => array(
							'w' => 0,
							's' => 'solid',
							'c' => ''
						),
						'right' => array(
							'w' => 0,
							's' => 'solid',
							'c' => ''
						),
						'bottom' => array(
							'w' => 2,
							's' => 'solid',
							'c' => 'rgba(0,0,0,0)'
						),
						'left' => array(
							'w' => 0,
							's' => 'solid',
							'c' => ''
						)
					),
				)
			),
			'tablc' => array(
				'type' => 'thz-multi-options',
				'label' => __('Tab links colors', 'creatus'),
				'desc' => esc_html__('Adjust tab links colors', 'creatus'),
				'value' => array(
					'al' => 'color_2',
					'alh' => '#121212',
					'il' => 'color_3',
					'ilh' => '#121212'
				),
				'thz_options' => array(
					'al' => array(
						'type' => 'color',

						'title' => esc_html__('Active', 'creatus'),
						'box' => true
					),
					'alh' => array(
						'type' => 'color',
						'title' => esc_html__('Active hovered', 'creatus'),
						'box' => true
					),
					'il' => array(
						'type' => 'color',
						'title' => esc_html__('Inactive', 'creatus'),
						'box' => true
					),
					'ilh' => array(
						'type' => 'color',
						'title' => esc_html__('Inactive hovered', 'creatus'),
						'box' => true
					)
				)
			),
			'tabcc' => array(
				'type' => 'thz-multi-options',
				'label' => __('Tab content colors', 'creatus'),
				'desc' => esc_html__('Adjust tab content colors', 'creatus'),
				'value' => array(
					'ctc' => '',
					'clc' => '',
					'clh' => '',
					'chc' => ''
				),
				'thz_options' => array(
					'ctc' => array(
						'type' => 'color',
						'title' => esc_html__('Text', 'creatus'),
						'box' => true
					),
					'clc' => array(
						'type' => 'color',
						'title' => esc_html__('Link', 'creatus'),
						'box' => true
					),
					'clh' => array(
						'type' => 'color',
						'title' => esc_html__('Link hovered', 'creatus'),
						'box' => true
					),
					'chc' => array(
						'type' => 'color',
						'title' => esc_html__('Headings', 'creatus'),
						'box' => true
					)
				)
			)
		)
	)
);