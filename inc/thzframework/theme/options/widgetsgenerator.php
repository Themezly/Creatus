<?php
if (!defined('FW')){
	die('Forbidden');
}
	
	if (!fw_ext('builder')){
		
		
		$options = array(
		
			'no_builder_text' => array(
				'type' => 'thz-separator',
				'label'=>'Grids generator',
				'value' => false,
				'html' => esc_html__('<h2>This option requires Unyson Page Builder extension to be active. Please go to Unyson plugin and activate </h2>','creatus'),
			),
		
		);
		
		return;
		
	}
	
	
$options = array(

	'wb_msg'=>array(
		'type'  => 'html',
		'label' => false,
		'html'  => '<div class="notice notice-error widget-builder-msg">'.__('Create section than drag the Widget area into the section', 'creatus').'</div>',
	),
	'aboveheaderwidgetsgeneratortab' => array(
		'type' => 'tab',
		'lazy_tabs'=> false,
		'title' => __('Above header', 'creatus'),
		'options' => array(

			'above_header_section' => array(
				'label' => false,
				'type'  => 'thz-section-builder',
				'history' => true,
				'template_saving'    => true,
			),

		)
	),
	'underheaderwidgetsgeneratortab' => array(
		'type' => 'tab',
		'lazy_tabs'=> false,
		'title' => __('Under header', 'creatus'),
		'options' => array(
		
			'under_header_section' => array(
				'label' => false,
				'type'  => 'thz-section-builder',
				'history' => true,
				'template_saving'    => true,
			),

		)
	),
	'footerwidgetsgeneratortab' => array(
		'type' => 'tab',
		'lazy_tabs'=> false,
		'title' => __('Footer', 'creatus'),
		'options' => array(
		
			'footer_section' => array(
				'label' => false,
				'type'  => 'thz-section-builder',
				'history' => true,
				'template_saving'    => true,
				'value' => array(
					'json' =>'[{"type":"section","shortcode":"section_b73f57c","width":"","_items":[{"type":"columns","shortcode":"columns_a7345eb","width":"1_4","options":{"widget_name":"Widget 1","centered":"donotcenter","flexalign":"fstart","bs":{"css":""},"smootha":{"m":"inactive","p":0,"d":800},"id":"21521bd1","cmx":{"i":"","c":"","d":"show","t":"show","m":"show"},"bl":[],"an":[],"sf":[],"fh":[],"cpx":[],"re":[]}},{"type":"columns","shortcode":"columns_425ee21","width":"1_4","options":{"widget_name":"Widget 2","centered":"donotcenter","flexalign":"fstart","bs":{"css":""},"smootha":{"m":"inactive","p":0,"d":800},"id":"6dd30883","cmx":{"i":"","c":"","d":"show","t":"show","m":"show"},"bl":[],"an":[],"sf":[],"fh":[],"cpx":[],"re":[]}},{"type":"columns","shortcode":"columns_e51158d","width":"1_4","options":{"widget_name":"Widget 3","centered":"donotcenter","flexalign":"fstart","bs":{"css":""},"smootha":{"m":"inactive","p":0,"d":800},"id":"01b6e627","cmx":{"i":"","c":"","d":"show","t":"show","m":"show"},"bl":[],"an":[],"sf":[],"fh":[],"cpx":[],"re":[]}},{"type":"columns","shortcode":"columns_8653514","width":"1_4","options":{"widget_name":"Widget 4","centered":"donotcenter","flexalign":"fstart","bs":{"css":""},"smootha":{"m":"inactive","p":0,"d":800},"id":"1724c26a","cmx":{"i":"","c":"","d":"show","t":"show","m":"show"},"bl":[],"an":[],"sf":[],"fh":[],"cpx":[],"re":[]}}],"options":{"show_empty":"hide","section_name":"Section 1","mode":"default","bs":{"padding":{"top":"90","right":"0","bottom":"0","left":"0"},"background":{"type":"color","color":"color_5"},"css":"padding:90px 0px 0px 0px;background-color:color_5;"},"section_contained":{"picked":"notcontained","notcontained":{"content_contained":"contained"}},"spacings":{"con":"","col":""},"smootha":{"m":"inactive","p":0,"d":800},"id":"a248e261","cmx":{"i":"","c":"","d":"show","t":"show","m":"show"},"bl":[],"an":[],"cp":[],"sf":[],"fh":[],"se":[],"cpx":[],"tf":[],"wi_tbs":{"margin":{"top":"0","right":"0","bottom":"30","left":"0"},"css":"margin:0px 0px 30px 0px;"},"wi_title":{"css":"font-size:14px;font-weight:600;text-transform:uppercase;","weight":"600","size":"14","transform":"uppercase"},"wi_metrics":{"tx":"","he":"","li":"","lih":"","set":"","seb":"","sep":"","tab":"color_4"},"wi_tagbs":{"padding":{"top":"5","right":5,"bottom":5,"left":5},"margin":{"top":"0","right":5,"bottom":5,"left":0},"borders":{"all":"same","top":{"w":"1","s":"solid","c":"color_4"},"right":{"w":"","s":"solid","c":""},"bottom":{"w":"","s":"solid","c":""},"left":{"w":"","s":"solid","c":""}},"borderradius":{"top-left":"4","top-right":"4","bottom-right":"4","bottom-left":"4"},"css":"padding:5px 5px 5px 5px;margin:0px 5px 5px 0px;border-width:1px;border-style:solid;border-color:color_4;border-radius:4px;"},"wi_tagfm":{"size":"10","weight":600,"transform":"uppercase","css":"font-size:10px;font-weight:600;text-transform:uppercase;"},"res":[],"rec":[]}}]'
				
				)
			),		

		)
	),

	'toppanelwidgetstab' => array(
		'type' => 'tab',
		'lazy_tabs'=> false,
		'title' => __('Top panel', 'creatus'),
		'options' => array(
			'top_panel' => array(
				'label' => false,
				'type'  => 'thz-panel-builder',
				'history' => true,
				'template_saving'    => true,
			),

		)
	),
	
	'bottompanelwidgesttab' => array(
		'type' => 'tab',
		'lazy_tabs'=> false,
		'title' => __('Bottom panel', 'creatus'),
		'options' => array(

			'bottom_panel' => array(
				'label' => false,
				'type'  => 'thz-panel-builder',
				'history' => true,
				'template_saving'    => true,
			),

		)
	),
	
	'sidepanelwidgetstab' => array(
		'type' => 'tab',
		'lazy_tabs'=> false,
		'title' => __('Side panel', 'creatus'),
		'options' => array(

			'side_panel' => array(
				'label' => false,
				'type'  => 'thz-panel-builder',
				'history' => true,
				'template_saving'    => true,
			),

		)
	),
);