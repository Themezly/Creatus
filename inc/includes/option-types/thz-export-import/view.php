<?php if ( ! defined( 'FW' ) ) { die( 'Forbidden' ); }

	echo fw_html_tag('h3', 
		array(),
		esc_html__('Export theme settings', 'creatus')
	);
	echo '<p class="thz-export-import-paragraph">';
	echo esc_html__('Click on the button below to generate .json file containing current theme settings.', 'creatus');
	echo '</br>';
	echo esc_html__('Note that options will be saved prior to export.', 'creatus');
	echo '</p>';
	echo '<a href="' . esc_url( $export_url ) . '">';
	
	echo fw_html_tag('button', 
		array(
			'type'  => 'button',
			'class' => 'button button-primary thz-export-settings',
		),
		esc_html__('Export theme settings', 'creatus')
	);

	echo '</a>';

	echo '<br /><br /><br />';
	
	echo fw_html_tag('h3', 
		array(),
		esc_html__('Import theme settings', 'creatus')
	);
	
	echo fw_html_tag('p', 
		array('class'=>'thz-export-import-paragraph'),
		esc_html__('Upload the theme .json file. Choose the file from your computer and click on "Import theme settings" button.', 'creatus')
	);	

	
	echo fw_html_tag('input', 
		array(
			'type' =>'file',
			'id'	=> 'thz-settings-import',
			'name' => 'thz-settings-import',
		)
	);
	
	echo '<br />';
	
	
	echo fw_html_tag('p', 
		array('class'=>'thz-import-warn'),
		esc_html__('We strongly suggest to export and backup theme settings before clicking on the button below!', 'creatus')
	);
	
		
	echo fw_html_tag('button', 
		array(
			'type'  => 'button',
			'class' => 'button button-primary thz-import-settings',
		),
		esc_html__('Import theme settings', 'creatus')
	);

	
	echo '<br /><br /><br />';
	
	echo fw_html_tag('h3', 
		array(),
		esc_html__('Import page settings', 'creatus')
	);
	
	echo fw_html_tag('p', 
		array('class'=>'thz-export-import-paragraph'),
		esc_html__('Select the page to import the settings from. Start typing to find specific page.', 'creatus')
	);

	$page_id = fw()->backend->option_type('multi-select')->render(
		'importpageid',
		array( 
			'value' =>'',
			'label' => __('Select post/page', 'creatus'),
			'desc' => esc_html__('Start typing the post/page name.', 'creatus'),
			'population' => 'posts',
			'source' => array('post','page'),
			'attr' => array(
				'class' => 'thz-import-from-pageid'
			),
			'prepopulate' => 3,
			'limit' => 1
		),
		array(
		   'value'		 => array(),
		   'id_prefix'   => $data['id_prefix'],
		   'name_prefix' => $data['name_prefix']
		)
	);

	echo _thz_remove_name_from_option( $page_id, true);
	
	echo '<br />';
	
	echo fw_html_tag('button', 
		array(
			'type'  => 'button',
			'class' => 'button button-primary thz-import-page-settings',
		),
		esc_html__('Import page settings', 'creatus')
	);

	
	echo '<br /><br /><br />';
	
	echo fw_html_tag('h3', 
		array(),
		esc_html__('Import theme preset', 'creatus')
	);
	
	echo fw_html_tag('p', 
		array('class'=>'thz-export-import-paragraph'),
		esc_html__('For your convenience we have gathered a list of theme presets. These come in handy when you dont need the complete theme demo but rather just want the demo theme settings. Choose the desired preset and follow instructions in modal window.', 'creatus')
	);
	
	echo fw_html_tag('b', 
		array('class'=>'thz-export-import-bold'),
		esc_html__('To find a preset faster hit backspace once than type the preset name.', 'creatus')
	);
	
	echo '<br /><br />';

	echo fw()->backend->option_type('select')->render(
		$id,
		array( 
			'value' => $option['value'],
			'choices' => thz_presets_select(),
		),
		array(
		   'value'		 => $data['value'],
		   'id_prefix'   => $data['id_prefix'],
		   'name_prefix' => $data['name_prefix']
		)
	);

?>