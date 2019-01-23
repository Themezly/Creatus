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
	<div class="thz-multi-options-group">
		<?php foreach ($option['value'] as $key => $options_group){

				$type = $option['thz_options'][$key]['type'];
				$html ='';
				$addbrake ='';
				if(isset($option['breakafter'])){
					
					$found = false;
					if(is_array($option['breakafter']) && in_array($key,$option['breakafter'])){
						
						$found = true;
						
					}else if($option['breakafter'] == $key ){
						
						$found = true;
					}
					
					$addbrake = $found ? '<div class="thz-multi-brake"></div>' :'';
				}

				$att_class = isset($option['thz_options'][$key]['attr']['class']) ? $option['thz_options'][$key]['attr']['class'] : false;

				// spinner
				if($type === 'spinner'){

					$parent = $att_class ? implode('-parent ',explode(' ',$att_class)).'-parent ' :'';
					$html .= '<div class="'.$parent.'thz-multi-options-holder thz-multi-holding-spinner thz-mh-'.$option['attr']['id'].'-'.$key.'"';
					$html .= ' data-name="'.$key.'">';
					$spinner = $option['thz_options'][$key];


					//fw_print($spinner);
					$spinner_html  =  fw()->backend->option_type( 'thz-spinner' )->render(
						$key,
						array(
							'type'  => 'thz-spinner',
							'addon' => isset($spinner['addon']) ? $spinner['addon'] :'px',
							'units'	=> isset($spinner['units']) ? $spinner['units'] : false,
							'min'	=> isset($spinner['min']) ? $spinner['min'] : 'min',
							'max'	=> isset($spinner['max']) ? $spinner['max'] : 'max',
							'step'	=> isset($spinner['step']) ? $spinner['step'] : 1,
							'value' => fw_akg($key, $option['value']),
							'class' => isset($spinner['class']) ? $spinner['class'] :'',
							'title' => isset($spinner['title']) ? $spinner['title'] :'',
							'attr'  => isset($spinner['attr']) ? $spinner['attr'] :array(),
						),
						array(
							'value' => fw_akg($key, $value_data['value']),
							'id_prefix' => $option['attr']['id'] .'-',
							'name_prefix' => $option['attr']['name'],
						)
					);
					$spinner_html .= '</div>'.$addbrake;

					$html .= _thz_remove_name_from_option($spinner_html,true);

				}


				// short text
				if($type === 'short-text'){

					$parent = $att_class ? implode('-parent ',explode(' ',$att_class)).'-parent ' :'';
					$html .= '<div class="'.$parent .'thz-multi-options-holder thz-multi-holding-text thz-mh-'.$option['attr']['id'].'-'.$key.'"';
					$html .= ' data-name="'.$key.'">';
					$html .= '<span class="thz-multi-options-title">'.$option['thz_options'][$key]['title'].'</span>';

					$short_text_html =  fw()->backend->option_type( 'short-text' )->render(
						$key,
						array(
							'type'  => 'short-text',
							'value' => fw_akg($key, $option['value']),
							'attr'  => isset($option['thz_options'][$key]['attr']) ? $option['thz_options'][$key]['attr'] :array(),
						),
						array(
							'value' => fw_akg($key, $value_data['value']),
							'id_prefix' => $option['attr']['id'] .'-',
							'name_prefix' => $option['attr']['name'],
						)
					);

					$short_text_html .= '</div>'.$addbrake;

					$html .= _thz_remove_name_from_option($short_text_html,true);

				}

				// text
				if($type === 'text'){

					$parent = $att_class ? implode('-parent ',explode(' ',$att_class)).'-parent ' :'';
					$html .= '<div class="'.$parent.'thz-multi-options-holder thz-multi-holding-text thz-mh-'.$option['attr']['id'].'-'.$key.'"';
					$html .= ' data-name="'.$key.'">';
					$html .= '<span class="thz-multi-options-title">'.$option['thz_options'][$key]['title'].'</span>';

					$text_html =  fw()->backend->option_type( 'text' )->render(
						$key,
						array(
							'type'  => 'short-text',
							'value' => fw_akg($key, $option['value']),
							'attr'  => isset($option['thz_options'][$key]['attr']) ? $option['thz_options'][$key]['attr'] :array(),
						),
						array(
							'value' => fw_akg($key, $value_data['value']),
							'id_prefix' => $option['attr']['id'] .'-',
							'name_prefix' => $option['attr']['name'],
						)
					);

					$text_html .= '</div>'.$addbrake;

					$html .= _thz_remove_name_from_option($text_html,true);

				}
				
				
				// textarea
				if($type === 'textarea'){

					$parent = $att_class ? implode('-parent ',explode(' ',$att_class)).'-parent ' :'';
					$html .= '<div class="'.$parent.'thz-multi-options-holder thz-multi-holding-textarea thz-mh-'.$option['attr']['id'].'-'.$key.'"';
					$html .= ' data-name="'.$key.'">';
					$html .= '<span class="thz-multi-options-title">'.$option['thz_options'][$key]['title'].'</span>';

					$text_html =  fw()->backend->option_type( 'textarea' )->render(
						$key,
						array(
							'type'  => 'textarea',
							'value' => fw_akg($key, $option['value']),
							'attr'  => isset($option['thz_options'][$key]['attr']) ? $option['thz_options'][$key]['attr'] :array(),
						),
						array(
							'value' => fw_akg($key, $value_data['value']),
							'id_prefix' => $option['attr']['id'] .'-',
							'name_prefix' => $option['attr']['name'],
						)
					);

					$text_html .= '</div>'.$addbrake;

					$html .= _thz_remove_name_from_option($text_html,true);

				}


				// color
				if($type === 'color'){

					$parent = $att_class ? implode('-parent ',explode(' ',$att_class)).'-parent ' :'';
					$html .= '<div class="'.$parent.'thz-multi-options-holder thz-multi-holding-color thz-mh-'.$option['attr']['id'].'-'.$key.'"';
					$html .= ' data-name="'.$key.'">';
					$html .= '<span class="thz-multi-options-title">'.$option['thz_options'][$key]['title'].'</span>';

					$color_html =  fw()->backend->option_type( 'thz-color-picker' )->render(
						$key,
						array(
							'type'  => 'thz-color-picker',
							'value' => fw_akg($key, $option['value']),
							'box' => isset($option['thz_options'][$key]['box']) ? $option['thz_options'][$key]['box'] :false,
							'attr'  => isset($option['thz_options'][$key]['attr']) ? $option['thz_options'][$key]['attr'] :array(),
						),
						array(
							'value' => fw_akg($key, $value_data['value']),
							'id_prefix' => $option['attr']['id'] .'-',
							'name_prefix' => $option['attr']['name'],
						)
					);

					$color_html .= '</div>'.$addbrake;

					$html .= _thz_remove_name_from_option($color_html,true);

				}


				// short select
				if($type === 'short-select'){

					$parent = $att_class ? implode('-parent ',explode(' ',$att_class)).'-parent ' :'';
					$html .= '<div class="'.$parent.'thz-multi-options-holder thz-multi-holding-select thz-mh-'.$option['attr']['id'].'-'.$key.'"';
					$html .= ' data-name="'.$key.'">';
					$html .= '<span class="thz-multi-options-title">'.$option['thz_options'][$key]['title'].'</span>';

					$short_select_html =  fw()->backend->option_type( 'short-select' )->render(
						$key,
						array(
							'type'  => 'short-select',
							'value' => fw_akg($key, $option['value']),
							'choices' => fw_akg($key.'/choices', $option['thz_options']),
							'attr'  => isset($option['thz_options'][$key]['attr']) ? $option['thz_options'][$key]['attr'] :array(),
						),
						array(
							'value' => fw_akg($key, $value_data['value']),
							'id_prefix' => $option['attr']['id'] .'-',
							'name_prefix' => $option['attr']['name'],
						)
					);

					$short_select_html .= '</div>'.$addbrake;

					$html .= _thz_remove_name_from_option($short_select_html,true);
				}

				// select
				if($type === 'select'){

					$parent = $att_class ? implode('-parent ',explode(' ',$att_class)).'-parent ' :'';
					$html .= '<div class="'.$parent.'thz-multi-options-holder thz-multi-holding-select thz-mh-'.$option['attr']['id'].'-'.$key.'"';
					$html .= ' data-name="'.$key.'">';
					$html .= '<span class="thz-multi-options-title">'.$option['thz_options'][$key]['title'].'</span>';

					$select_html =  fw()->backend->option_type( 'select' )->render(
						$key,
						array(
							'type'  => 'select',
							'value' => fw_akg($key, $option['value']),
							'choices' => fw_akg($key.'/choices', $option['thz_options']),
							'attr'  => isset($option['thz_options'][$key]['attr']) ? $option['thz_options'][$key]['attr'] :array(),
						),
						array(
							'value' => fw_akg($key, $value_data['value']),
							'id_prefix' => $option['attr']['id'] .'-',
							'name_prefix' => $option['attr']['name'],
						)
					);

					$select_html .= '</div>'.$addbrake;

					$html .= _thz_remove_name_from_option($select_html,true);
				}

				// image-picker
				if($type === 'image-picker'){

					$parent = $att_class ? implode('-parent ',explode(' ',$att_class)).'-parent ' :'';
					$html .= '<div class="'.$parent.'thz-multi-options-holder thz-multi-holding-image-picker thz-mh-'.$option['attr']['id'].'-'.$key.'"';
					$html .= ' data-name="'.$key.'">';
					$html .= '<span class="thz-multi-options-title">'.$option['thz_options'][$key]['title'].'</span>';

					$select_html =  fw()->backend->option_type( 'image-picker' )->render(
						$key,
						array(
							'type'  => 'image-picker',
							'value' => fw_akg($key, $option['value']),
							'choices' => fw_akg($key.'/choices', $option['thz_options']),
							'attr'  => isset($option['thz_options'][$key]['attr']) ? $option['thz_options'][$key]['attr'] :array(),
						),
						array(
							'value' => fw_akg($key, $value_data['value']),
							'id_prefix' => $option['attr']['id'] .'-',
							'name_prefix' => $option['attr']['name'],
						)
					);

					$select_html .= '</div>'.$addbrake;

					$html .= _thz_remove_name_from_option($select_html,true);
				}

				// checkboxes
				if($type === 'checkboxes'){
					
					$choices = fw_akg($key.'/choices', $option['thz_options']) === 'posts' ? 
						thz_list_post_types(true, array('forum',
							'topic',
							'reply'
						))
					: fw_akg($key.'/choices', $option['thz_options']);
					
					$parent = $att_class ? implode('-parent ',explode(' ',$att_class)).'-parent ' :'';
					$html .= '<div class="'.$parent.'thz-multi-options-holder thz-multi-holding-checkboxes thz-mh-'.$option['attr']['id'].'-'.$key.'"';
					$html .= ' data-name="'.$key.'">';
					$html .= '<span class="thz-multi-options-title">'.$option['thz_options'][$key]['title'].'</span>';
					
					$html .=  fw()->backend->option_type( 'checkboxes' )->render(
						$key,
						array(
							'type'  => 'checkboxes',
							'value' => fw_akg($key, $option['value']),
							'inline' => true,
							'choices' => $choices,
							'attr'  => isset($option['thz_options'][$key]['attr']) ? $option['thz_options'][$key]['attr'] :array(),
						),
						array(
							'value' => fw_akg($key, $data['value']),
							'id_prefix' => $option['attr']['id'] .'-',
							'name_prefix' => $option['attr']['name'],
						)
					);

					$html .= '</div>'.$addbrake;

					//$html .= _thz_remove_name_from_option($checkboxes_html,true);
				}


				// radio
				if($type === 'radio'){

					$parent = $att_class ? implode('-parent ',explode(' ',$att_class)).'-parent ' :'';
					$html .= '<div class="'.$parent.'thz-multi-options-holder thz-multi-holding-radio thz-mh-'.$option['attr']['id'].'-'.$key.'"';
					$html .= ' data-name="'.$key.'">';
					$html .= '<span class="thz-multi-options-title">'.$option['thz_options'][$key]['title'].'</span>';

					$html .=  fw()->backend->option_type( 'radio' )->render(
						$key,
						array(
							'type'  => 'radio',
							'value' => fw_akg($key, $option['value']),
							'choices' => fw_akg($key.'/choices', $option['thz_options']),
							'inline' => true,
							'attr'  => isset($option['thz_options'][$key]['attr']) ? $option['thz_options'][$key]['attr'] :array(),
						),
						array(
							'value' => fw_akg($key, $value_data['value']),
							'id_prefix' => $option['attr']['id'] .'-',
							'name_prefix' => $option['attr']['name'],
						)
					);

					$html .= '</div>'.$addbrake;

					//$html .= _thz_remove_name_from_option($radio_html,true);
				}


				// icon
				if($type === 'icon'){

					$parent = $att_class ? implode('-parent ',explode(' ',$att_class)).'-parent ' :'';
					$html .= '<div class="'.$parent.'thz-multi-options-holder thz-multi-holding-icon thz-mh-'.$option['attr']['id'].'-'.$key.'"';
					$html .= ' data-name="'.$key.'">';
					$html .= '<span class="thz-multi-options-title">'.$option['thz_options'][$key]['title'].'</span>';

					$icon_html =  fw()->backend->option_type( 'thz-icon' )->render(
						$key,
						array(
							'type'  => 'thz-icon',
							'value' => fw_akg($key, $option['value']),
							'attr'  => isset($option['thz_options'][$key]['attr']) ? $option['thz_options'][$key]['attr'] :array(),
						),
						array(
							'value' => fw_akg($key, $value_data['value']),
							'id_prefix' => $option['attr']['id'] .'-',
							'name_prefix' => $option['attr']['name'],
						)
					);

					$icon_html .= '</div>'.$addbrake;

					$html .= _thz_remove_name_from_option($icon_html,true);
				}


				// box style
				if($type === 'box-style'){

					$parent = $att_class ? implode('-parent ',explode(' ',$att_class)).'-parent ' :'';
					$html .= '<div class="'.$parent.'thz-multi-options-holder thz-multi-holding-box-style thz-mh-'.$option['attr']['id'].'-'.$key.'"';
					$html .= ' data-name="'.$key.'">';
					$html .= '<span class="thz-multi-options-title">'.$option['thz_options'][$key]['title'].'</span>';
					$html .= fw_html_tag('button',
						array(
							'type'  => 'button',
							'class' => 'button button-primary thz-multi-options-box-style',
							'data-connect' => $option['thz_options'][$key]['connect']
						),
						$option['thz_options'][$key]['button-text']
					);
					$html .= '</div>'.$addbrake;

				}


				echo $html;
		}
		?>
	</div>
    <div class="thz-value-data">
	<?php
            echo fw()->backend->option_type( 'hidden' )->render(
                'value_data',
                array(
                    'type'  => 'hidden',
                    'value' => json_encode( $option['value'],true),
                ),
                array(
                    'value' => json_encode($data['value'],true),
                    'id_prefix' => $option['attr']['id'],
                    'name_prefix' => $option['attr']['name'],
                )
            );
    ?>
    </div>
</div>
