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
	


$cats= array();
foreach ($allgroups['cats'] as $cat ){
	
	$cats['category_'.$cat->cat_ID] = $cat->name;
}

$taxes= array();
foreach ($allgroups['taxes'] as $slug ){
	
	$taxonomy_details = get_taxonomy( $slug );
	
	$taxes['taxonomy_'.$slug] = $taxonomy_details->label;
}


$cposts= array();
foreach ($allgroups['cposts'] as $key => $cpt ){
	
	
	$cposts['cpt_'.$key] = $cpt->label;
}


$pages= array();
foreach ($allgroups['pages'] as $page ){
	
	
	$pages['pageid_'.$page] = get_the_title( $page );
}


//print_r($pages);
?>

<div <?php echo fw_attr_to_html($div_attr) ?> >





	<?php
//	echo fw()->backend->option_type('select')->render($id, $grouped_options, array(
//		'id_prefix' => 'fw-option-sidebars-for-',
//		'value' => ''
//	));
	?>




<?php /*?>	<select name="fw_options[grouped]" id="fw-option-sidebars-for-grouped" class="fw-option fw-option-type-select" data-saved-value="">
	
	
		<?php
			
			
			foreach($allgroups['pages'] as $page){
			//	print_r($page->post_title);
				$title = $page->post_title;
				if(empty($title)) continue;
				
				echo '<option value="'.$page->ID.'">'.$title.'</option>';
				
				
				unset($page);
			}			
			
			
			
			foreach($allgroups['pages'] as $page){
				
				$title = get_the_title( $page );
				if(empty($title)) continue;
				
				echo '<option value="'.$page.'">'.$title.'</option>';
			}
		
		?>
	

	</select><?php */?>
	<?php 
	
	
	
				echo fw()->backend->option_type('select-multiple')->render(
						'assignto',
						array(
							'label' => false,
							'desc'  => false,
							'type'  => 'select-multiple',
							'value' => array($option['value']['assignto']),
							'choices' => array(
								'all' =>  esc_html__('All pages', 'creatus'),
								
								array(
									'attr'    => array('label' => __('Miscellaneous', 'creatus')),
									'choices' => array(
										'is_front_page' => esc_html__('Home Page', 'creatus'),
										'is_search' => esc_html__('Search Page', 'creatus'),
										'is_404' => esc_html__('404 Page', 'creatus'),
										'is_author' => esc_html__('Author Page', 'creatus'),
										'is_archive' => esc_html__('Archive Page', 'creatus'),
									),
								),
								
/*								array(
									'attr'    => array('label' => __('Pages', 'creatus')),
									'choices' => array(
										'posts' => esc_html__('Blog posts', 'creatus'),
										'pages' => esc_html__('Pages', 'creatus'),
										'portfolio' => esc_html__('Portfolio project', 'creatus'),
									),
								),*/
								
								array(
									'attr'    => array('label' => __('Taxonomies', 'creatus')),
									'choices' => $taxes,
								),								
								array(
									'attr'    => array('label' => __('Categories', 'creatus')),
									'choices' => $cats,
								),
								array(
									'attr'    => array('label' => __('Custom Post Types', 'creatus')),
									'choices' => $cposts,
								),								

								array(
									'attr'    => array('label' => __('Pages', 'creatus')),
									'choices' => $pages,
								),	
								
																
								array(
									'attr'    => array('label' => __('Custom', 'creatus')),
									'choices' => array(
										'specific' =>  esc_html__('Specific pages', 'creatus'),
									),
								),
															
							),
						),
						array(
							'value' => $data['value']['assignto'],
							'id_prefix' => 'fw-option-' . $id . '-thz-pages-',
							'name_prefix' => $data['name_prefix'] . '[' . $id . ']',
						)
					)
	
/*foreach ($option['value'] as $key => $spinner){
	
	
	
	$html = '<div class="thz-spinners-holder">';
	$html .= '<span class="thz-spinners-title">'.$spinner['title'].'</span>';
	$html .=  fw()->backend->option_type( 'thz-spinner' )->render(
		$key,
		array(
			'type'  => 'thz-spinner',
			'addon' =>isset($spinner['addon']) ? $spinner['addon'] :'px',
			'min'=>isset($spinner['min']) ? $spinner['min'] : 0,
			'max'=>isset($spinner['max']) ? $spinner['max'] : 5000,
			'step'=>isset($spinner['step']) ? $spinner['step'] : 1,
			'value' => fw_akg($key.'/value', $option['value']),
			'attr'  => array(
				'data-thzspinners' => $group_name
			)
		),
		array(
			'value' => fw_akg($key.'/value', $data['value']),
			'id_prefix' => $option['attr']['id'] .'-',
			'name_prefix' => $option['attr']['name'],
		)
	);
	$html .= '</div>';
	
	echo $html;

}*/
?>
</div>
