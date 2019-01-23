<?php
if (!defined('FW')) {
	die('Forbidden');
}
$options = array(

	'pgrid' => array(
		'type' => 'thz-multi-options',
		'label' => __('Grid settings', 'creatus'),
		'desc' => esc_html__('Adjust grid settings. Items -1 = all. See help for more info.', 'creatus'),
		'help' => esc_html__('If the .thz-grid-item-in width is less than desired min width, the columns number drops down by one in order to honor the min width setting. This adjustment is active only if project media container height is anything else but metro. On the other hand if the window width is below 980px and grid has more than 2 columns, only 2 columns are shown. Under 767px 1 column is shown.', 'creatus'),
		'value' => array(
			'columns' => 3,
			'gutter' => 30,
			'minwidth' => 200,
			'items' => 9,
			'isotope' => 'packery'
		),
		'thz_options' => array(
			'gutter' => array(
				'type' => 'spinner',
				'title' => esc_html__('Gutter', 'creatus'),
				'addon' => 'px',
				'min' => 0,
				'max' => 200
			),
			'columns' => array(
				'type' => 'select',
				'title' => esc_html__('Columns', 'creatus'),
				'choices' => array(
					'1' => esc_html__('1', 'creatus'),
					'2' => esc_html__('2', 'creatus'),
					'3' => esc_html__('3', 'creatus'),
					'4' => esc_html__('4', 'creatus'),
					'5' => esc_html__('5', 'creatus'),
					'6' => esc_html__('6', 'creatus')
				)
			),
			'minwidth' => array(
				'type' => 'spinner',
				'title' => esc_html__('Item min width', 'creatus'),
				'addon' => 'px',
			),
			'items' => array(
				'type' => 'spinner',
				'title' => esc_html__('Items', 'creatus'),
				'addon' => '#',
				'min' => -1,
				'max' => 100
			),
			'isotope' => array(
				'type' => 'short-select',
				'title' => esc_html__('Isotope mode', 'creatus'),
				'choices' => array(
					'packery' => esc_html__('Packery ( Masonry, place items where they fit )', 'creatus'),
					'fitRows' => esc_html__('fitRows ( Row height by tallest item in row )', 'creatus'),
					'vertical' => esc_html__('Vertical ( best with 1 column grid ) ', 'creatus'),
				)
			),
		)
	),
	'projects_order' => array(
		'type' => 'thz-multi-options',
		'label' => __('Order projects by', 'creatus'),
		'desc' => esc_html__('Select projects order', 'creatus'),
		'value' => array(
			'order' => 'DESC',
			'orderby' => 'date'
		),
		'thz_options' => array(
			'order' => array(
				'type' => 'select',
				'title' => esc_html__('Order', 'creatus'),
				'choices' => array(
					'DESC' => esc_html__('Descending ( newest first )', 'creatus'),
					'ASC' => esc_html__('Ascending ( oldest first )', 'creatus')
				)
			),
			'orderby' => array(
				'type' => 'select',
				'title' => esc_html__('Order by', 'creatus'),
				'choices' => array(
					'title' => esc_html__('Title', 'creatus'),
					'name' => esc_html__('Name', 'creatus'),
					'date' => esc_html__('Create date', 'creatus'),
					'modified' => esc_html__('Modified date', 'creatus'),
					'rand' => esc_html__('Random', 'creatus'),
					'none' => esc_html__('None', 'creatus')
				)
			)
		)
	),
	'projects_pagination' => array(
		'type' => 'multi-picker',
		'label' => false,
		'desc' => false,
		'picker' => array(
			'picked' => array(
				'label' => __('Pagination type', 'creatus'),
				'desc' => esc_html__('Select projects pagination type', 'creatus'),
				'type' => 'radio',
				'value' => 'click',
				'choices' => array(
					'click' => esc_html__('On click ( ajax ) ', 'creatus'),
					'scroll' => esc_html__('On scroll ( ajax )', 'creatus'),
					'pagination' => esc_html__('Pagination', 'creatus'),
					'none' => esc_html__('None ( no pagination )', 'creatus')
				),
				'inline' => true
			)
		),
		'choices' => array(
			'click' => array(
				'items_load' => array(
					'type' => 'thz-spinner',
					'addon' => '#',
					'min' => -1,
					'max' => 100,
					'label' => __('Number of projects', 'creatus'),
					'value' => 4,
					'desc' => esc_html__('Number of projects to load on more button click.( -1 = all )', 'creatus')
				),
				'more_button' => array(
					'type' => 'popup',
					'size' => 'large',
					'label' => __('Load more button', 'creatus'),
					'button' => esc_html__('Edit load more button', 'creatus'),
					'popup-title' => esc_html__('More button settings', 'creatus'),
					'popup-options' => array(
						'button' => array(
							'type' => 'thz-button',
							'value' => array(
							'html' 	=> '<div class="thz-btn-container load-more-btn thz-mt-60 thz-mb-28 thz-btn-outline"><a class="thz-button thz-btn-trans thz-radius-50 thz-btn-border-2 thz-align-center" href="#"><span class="thz-btn-text thz-vp-14 thz-hp-34 thz-fs-14 thz-fw-600">Load more</span></a></div>',
							'css' 	=> '.load-more-btn .thz-button{color:color_2;border-color:#ffffff;box-shadow:0px 2px 28px 0px rgba(0,0,0,0.05);}.load-more-btn .thz-button:hover,.load-more-btn.thz-btn-hover .thz-button {color:color_1;border-color:color_1;}',
							'json' 	=> '{"createButton":"on","activeColor":"theme","buttonText":"Load more","buttonTransition":"on","buttonType":"outline","buttonSizeClass":"custom","customClass":"load-more-btn","paddingY":14,"paddingX":34,"marginTop":60,"marginBottom":28,"fontSize":14,"fontWeight":"600","textAlign":"center","borderRadius":50,"borderWidth":2,"borderSide":"all","borderStyle":"solid","normalTextColor":"color_2","normalBgColor":"","normalBorderColor":"#ffffff","hoveredTextColor":"color_1","hoveredBgColor":"","hoveredBorderColor":"color_1","boxShadowsCount":1,"shadowInset1":false,"boxshadowX1":0,"boxshadowY1":2,"boxshadowBlurRadius1":28,"boxshadowSpreadRadius1":0,"boxshadow1Color":"rgba(0,0,0,0.05)"}',
							),
							'label' => false,
							'hidelinks' => true
						)
					)
				)
			),
			'scroll' => array(
				'items_load' => array(
					'type' => 'thz-spinner',
					'addon' => '#',
					'min' => -1,
					'max' => 100,
					'label' => __('Number of projects', 'creatus'),
					'value' => 4,
					'desc' => esc_html__('Number of projects to load on scroll.( -1 = all )', 'creatus')
				)
			)
		)
	),
	'project_animate' => array(
		'type' => 'thz-animation',
		'label' => false,
		'value' => array(
			'animate' => 'inactive',
			'effect' => 'thz-anim-fadeIn',
			'duration' => 1000,
			'delay' => 0
		),
		'addlabel' => esc_html__('Animate projects', 'creatus'),
		'adddesc' => esc_html__('Add animation to the project HTML container', 'creatus')
	)

);