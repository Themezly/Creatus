<?php if ( ! defined( 'FW' ) ) { die( 'Forbidden' ); }

/**
 * @var string $id
 * @var  array $option
 * @var  array $data
 * @var  array $buttons_names
 * @var  string $oid
 * @var  array $btn
 * @var  array $buttons_names
 * @var  array $custombuttons
 * @var  array $split_names
 * @var  array $palette
 * @var  string $generator_layout
 */

{
	$div_attr = $option['attr'];

	unset(
		$div_attr['value'],
		$div_attr['name']
	);
}


$vPaddingOptions 		= '{"min":0,"max":100,"step":1,"type":"single","from":'.$btn['paddingY'].'}';
$hPaddingOptions 		= '{"min":0,"max":100,"step":1,"type":"single","from":'.$btn['paddingX'].'}';
$tMarginOptions 		= '{"min":-100,"max":100,"step":1,"type":"single","from":'.$btn['marginTop'].'}';
$rMarginOptions 		= '{"min":-100,"max":100,"step":1,"type":"single","from":'.$btn['marginRight'].'}';
$bMarginOptions 		= '{"min":-100,"max":100,"step":1,"type":"single","from":'.$btn['marginBottom'].'}';
$lMarginOptions 		= '{"min":-100,"max":100,"step":1,"type":"single","from":'.$btn['marginLeft'].'}';
$BorderSizeOptions 		= '{"min":0,"max":20,"step":1,"type":"single","from":'.$btn['borderWidth'].'}';
$BorderRadiusOptions 	= '{"min":0,"max":50,"step":1,"type":"single","from":'.$btn['borderRadius'].'}';
$letterSpacingOptions 	= '{"min":-10,"max":50,"step":1,"type":"single","from":'.$btn['letterSpacing'].'}';
$TextshadowY			= '{"min":-50,"max":50,"step":1,"type":"single","from":'.$btn['textshadowY'].'}';
$TextshadowX			= '{"min":-50,"max":50,"step":1,"type":"single","from":'.$btn['textshadowX'].'}';
$TextshadowBlur			= '{"min":0,"max":50,"step":1,"type":"single","from":'.$btn['textshadowBlur'].'}';
$boxShadowOpacity		= '{"min":0,"max":1,"step":0.1,"type":"single","from":'.$btn['boxShadowOpacity'].'}';
$FontSizeOptions		= '{"min":0,"max":100,"step":1,"type":"single","from":'.$btn['fontSize'].'}';
$textNudgeVOptions 		= '{"min":-20,"max":20,"step":1,"type":"single","from":'.$btn['textNudgeV'].'}';
$textNudgeHOptions 		= '{"min":-20,"max":20,"step":1,"type":"single","from":'.$btn['textNudgeH'].'}';
$iconNudgeVOptions 		= '{"min":-20,"max":20,"step":1,"type":"single","from":'.$btn['iconNudgeV'].'}';
$iconNudgeHOptions 		= '{"min":-20,"max":20,"step":1,"type":"single","from":'.$btn['iconNudgeH'].'}';
$iconSpaceOptions		= '{"min":0,"max":20,"step":1,"type":"single","from":'.$btn['iconSpace'].'}';
$SubTextNudgeVOptions 	= '{"min":-20,"max":20,"step":1,"type":"single","from":'.$btn['SubTextNudgeV'].'}';
$SubTextNudgeHOptions 	= '{"min":-20,"max":20,"step":1,"type":"single","from":'.$btn['SubTextNudgeH'].'}';
$SubTextFontSizeOptions = '{"min":0,"max":100,"step":1,"type":"single","from":'.$btn['SubTextfontSize'].'}';
$SubTextletterSpacingOptions = '{"min":-10,"max":50,"step":1,"type":"single","from":'.$btn['SubTextletterSpacing'].'}';


$textShadoOption = array(
'none' 		=>'{"textshadowX":0,"textshadowY":0,"textshadowBlur":0,"normalTshColor":"rgba(0,0,0,0.0)","hoveredTshColor":"rgba(0,0,0,0.0)"}',
'light' 	=>'{"textshadowX":2,"textshadowY":2,"textshadowBlur":5,"normalTshColor":"rgba(255,255,255,0.3)","hoveredTshColor":"rgba(255,255,255,0.3)"}',
'dark' 		=>'{"textshadowX":2,"textshadowY":2,"textshadowBlur":5,"normalTshColor":"rgba(0,0,0,0.3)","hoveredTshColor":"rgba(0,0,0,0.3)"}',
);

									
$boxShadoOption = array(
	'none' 		=>'{"shadowInset1":false,"boxshadowX1":0,"boxshadowY1":0,"boxshadowBlurRadius1":0,"boxshadowSpreadRadius1":0,"boxShadowOpacity":0}',
	'full' 		=>'{"shadowInset1":false,"boxshadowX1":0,"boxshadowY1":0,"boxshadowBlurRadius1":15,"boxshadowSpreadRadius1":0,"boxShadowOpacity":0.3}',
	'inset' =>'{"shadowInset1":true,"boxshadowX1":0,"boxshadowY1":0,"boxshadowBlurRadius1":15,"boxshadowSpreadRadius1":5,"boxShadowOpacity":0.3}',
	'down' =>'{"shadowInset1":false,"boxshadowX1":0,"boxshadowY1":5,"boxshadowBlurRadius1":15,"boxshadowSpreadRadius1":0,"boxShadowOpacity":0.3}',
	'down-left' =>'{"shadowInset1":false,"boxshadowX1":-5,"boxshadowY1":5,"boxshadowBlurRadius1":15,"boxshadowSpreadRadius1":0,"boxShadowOpacity":0.3}',
	'down-right' =>'{"shadowInset1":false,"boxshadowX1":5,"boxshadowY1":5,"boxshadowBlurRadius1":15,"boxshadowSpreadRadius1":0,"boxShadowOpacity":0.3}',
	'up' =>'{"shadowInset1":false,"boxshadowX1":0,"boxshadowY1":-5,"boxshadowBlurRadius1":15,"boxshadowSpreadRadius1":0,"boxShadowOpacity":0.3}',
	'up-left' =>'{"shadowInset1":false,"boxshadowY1":-5,"boxshadowY1":-5,"boxshadowBlurRadius1":15,"boxshadowSpreadRadius1":0,"boxShadowOpacity":0.3}',
	'up-right' =>'{"shadowInset1":false,"boxshadowX1":5,"boxshadowY1":-5,"boxshadowBlurRadius1":15,"boxshadowSpreadRadius1":0,"boxShadowOpacity":0.3}',
	
);


$hide_links = '';

if($option['hidelinks']){
	$hide_links = ' thz-btn-hide-links';	
}

////////////
if (!function_exists('to_spc')) {
	function to_spc($html){
		
		return htmlspecialchars($html, ENT_QUOTES);
	}
}

if (!function_exists('thz_btn_slider')) {
	function thz_btn_slider($id,$slider_options,$btn,$oid){
		
		
		$options = json_decode ($slider_options,true);
		$data = 'data-min="'.$options['min'].'" data-max="'.$options['max'].'" data-step="'.$options['step'].'"';
		$data .=' data-type="'.$options['type'].'" data-from="'.$options['from'].'"';
		
		$html ='<div class="thz-btn-gen-slider-holder">';
		$html .='<div class="thz-btn-gen-slider-input custom">';
		$html .='<input type="text" value="'.$btn[$id].'" class="thz-btn-gen-slider-custom" />';
		$html .='</div>';
		$html .='<div class="thz-btn-gen-slider-input ions" data-slider-options="'.to_spc($slider_options).'">';
		$html .='<input type="text" id="'.$oid.$id.'" value="'.$btn[$id].'" class="thz-btn-gen-slider" data-css-hook="'.$id.'" '.$data.' />';
		$html .='</div>';
		$html .='</div>';
		
		return $html;
	}
}

if (!function_exists('thz_btn_color')) {
	
	function thz_btn_color($id,$btn,$oid){
		
	$mainid  = $oid.$id;
	$palette_color ='';
	$using ='';

	if (strpos($btn[$id], 'color_') !== false) {
		$palette_color =' palette-color';
		$using = ' using-'.$btn[$id];
	}
		
	$html = fw()->backend->option_type('thz-color-picker')->render(
		$mainid,
		array(
			'label' => false,
			'desc'  => false,
			'box'=> true,
			'type'  => 'thz-color-picker',
			'value' => $btn[$id],
			'attr'	=> array(
				'class' =>'thz-btn-gen-color-input thz-bt-col-pick '.$id.$using,
				'data-css-hook' => $id,
				'data-reset' => $btn[$id],
			),
			array(
				'id_prefix' => $id,
				'name_prefix' => $id,
			)
		)
	);
	
	$html =  str_replace('fw-option-'.$mainid,$mainid,$html);
	$html =  str_replace('name="fw_options['.$mainid.']"','',$html);
	
	
	//fw_options[tesbuttonpreviewBg]
/*		$html ='<div class="thz-btn-gen-color">';
		$html .='<a href="#" class="thz-btn-gen-color-trigger"></a>';
		$html .='<div class="thz-btn-gen-color-holder">';
		$html .='<input type="text" id="'.$oid.$id.'" value="'.$btn[$id].'" class="thz-btn-gen-color-input '.$id.'"';
		$html .=' data-css-hook="'.$id.'" data-reset="'.$btn[$id].'" />';
		$html .='</div>';
		$html .='</div>';*/
		
		return $html;
	}
}

if (!function_exists('thz_btn_fonts')) {
	
	function thz_btn_fonts($current){
		
		$html = '<optgroup label="'.__('Default Fonts','creatus').'">';
		
		$fontsArray = array(
			'inherit' => 'Inherit',
			'thz-ff-verdana' => 'Verdana',
			'thz-ff-georgia' => 'Georgia',
			'thz-ff-courier' => 'Courier',
			'thz-ff-arial' => 'Arial',
			'thz-ff-tahoma' => 'Tahoma',
			'thz-ff-trebuchet' => 'Trebuchet',
			'thz-ff-arialblack' => 'Arial Black',
			'thz-ff-times' => 'Times New Roman',
			'thz-ff-palatino' => 'Palatino',
			'thz-ff-lucida' => 'Lucida',
			'thz-ff-msserif' => 'MS Serif',
			'thz-ff-lucidaconsole' => 'Lucida Console',
			'thz-ff-comicsans' => 'Comic Sans',
		
		);
		
		foreach($fontsArray as $key => $font){
			$html .='<option value="'.$key.'">'.$font.'</option>';
		}
		$html .='</optgroup>';
		$html .= '<optgroup label="'.__('Google Fonts','creatus').'">';
		$html .= thz_google_fonts_data(true);
		$html .='</optgroup>';
		
		$html = str_replace('value="'.$current.'"','value="'.$current.'" selected="selected"',$html);
		return	$html;	
		
	}	
	
}


if (!function_exists('thz_btn_font_weight')) {
	
	function thz_btn_font_weight($current){
		
		$html = '';
		
		$weightArray = array(
			'100' => '100',
			'200' => '200',
			'300' => '300',
			'400' => '400',
			'500' => '500',
			'600' => '600',
			'700' => '700',
			'800' => '800',
			'900' => '900',
		
		);
		
		foreach($weightArray as $key => $fontweight){
			$selected ='';
			if($current == $key){
				$selected =' selected="selected"';
			}
			
			$html .='<option value="'.$key.'"'.$selected.'>'.$fontweight.'</option>';
		}
		return	$html;	
		
	}	
	
}
if (!function_exists('thz_btn_effects')) {
	
	function thz_btn_effects($current){
		
		$html = '';
		
		$effectsArray =  _thz_animations_list();
		
		foreach($effectsArray as $key => $effect){
			$selected ='';
			if($current == $key){
				$selected =' selected="selected"';
			}
			
			$html .='<option value="'.$key.'"'.$selected.'>'.$effect.'</option>';
		}
		return	$html;	
		
	}	
	
}
?>
<div <?php echo fw_attr_to_html($div_attr) ?>>

	<div class="thz-button-generator<?php echo $generator_layout.$hide_links ?> thz-wrapper" id="<?php echo esc_attr($oid)?>">
		<!-- preview -->
		<div class="thz-btn-gen-preview">
			<div class="thz-btn-gen-preview-table">
				<div class="thz-btn-gen-option create-button">
					<label for="<?php echo esc_attr($oid)?>createButton">
						<input type="checkbox" id="<?php echo esc_attr($oid)?>createButton" class="thz-btn-gen-checkbox createButton" data-css-hook="createButton">
						<?php echo esc_html__('Create own button','creatus'); ?>
					</label>
					<div class="buttonfloat">
						<label for="<?php echo esc_attr($oid)?>buttonFloat">
							<?php echo esc_html__('Position:','creatus'); ?>
						</label>
						<select id="<?php echo esc_attr($oid)?>buttonFloat" class="thz-btn-gen-select buttonFloat" data-css-hook="buttonFloat">
							<?php
							$floatsArray = array(
								'none' 	=>__('None','creatus'),
								'left' 	=>__('Left','creatus'),
								'center' =>__('Centered','creatus'),
								'right' =>__('Right','creatus'),
							);
							foreach($floatsArray as $float => $floatText ){
								$floatSelected ='';
								if($btn['buttonFloat'] == $float){
									$floatSelected =' selected="selected"';
								}
										
							?>
							<option value="<?php echo $float ?>"<?php echo $floatSelected ?>><?php echo $floatText ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
				<div class="thz-btn-gen-preview-table-inner">
					<div class="thz-btn-gen-preview-cell">
						<div class="thz-btn-metrics" data-btn-metrics="<?php echo to_spc ( json_encode ( $btn ,true ) ) ?>">
						</div>
						<!-- preview button -->
						<div class="thz-btn-container">
							<a class="thz-button thz-btn-<?php echo $btn['activeColor'] ?>">
								<span class="thz-btn-text"><?php echo $btn['buttonText']?></span>
							</a>
						</div>
						<!-- end preview button -->
					</div>
				</div>
				<div class="buttontypes">
					<div class="btntypes">
						<?php 
					$typesArray = array('normal','3d' ,'outline','flat');
					 foreach($typesArray as $type){ // phpcs:ignore WordPress.WP.GlobalVariablesOverride.OverrideProhibited
						
						$typeChecked ='';
						
						if($btn['buttonType'] == $type){
							$typeChecked =' checked="checked"';
						}
						
						$id = $oid.'buttonType'.$type; // phpcs:ignore WordPress.WP.GlobalVariablesOverride.OverrideProhibited
				
						$label = ucfirst($type);
				
						$input = '<input type="radio" value="'.$type.'" data-css-hook="buttonType" id="'.$id.'"';
						$input .=' class="thz-btn-gen-radioinput thz-btn-gen-type-predefined"'.$typeChecked.'>';						
					?>
						<label for="<?php echo $id?>">
							<?php echo $input.$label?>
						</label>
						<?php } ?>
					</div>
					<div class="btngradient">
						<label for="<?php echo esc_attr($oid)?>buttonGradient">
							<?php echo esc_html__('Gradient:','creatus'); ?>
						</label>
						<select id="<?php echo esc_attr($oid)?>buttonGradient" class="thz-btn-gen-select buttonGradient" data-css-hook="buttonGradient">
							<?php
							$gradientArray = array(
								'none' => esc_html__('None','creatus'),
								'tobottom' => esc_html__('To bottom','creatus'),
								'totop' => esc_html__('To top','creatus'),
								'toleft' => esc_html__('To left','creatus'),
								'toright' => esc_html__('To right','creatus'),
								'tobottom-light' => esc_html__('To bottom light','creatus'),
								'totop-light' => esc_html__('To top light','creatus'),
								'toleft-light' => esc_html__('To left light','creatus'),
								'toright-light' => esc_html__('To right light','creatus')
							);
							foreach($gradientArray as $gradient =>  $gradientLabel){
								$gradientSelected ='';
								if($btn['buttonGradient'] == $gradient){
									$gradientSelected =' selected="selected"';
								}
										
							?>
							<option value="<?php echo $gradient ?>"<?php echo $gradientSelected ?>><?php echo $gradientLabel ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
			</div>
			<div class="thz-btn-color-palette">
				<?php foreach($palette as $key => $colors ) { 
									
									$active_class = '';
									
									if($btn['activeColor'] == $key){
										$active_class = ' thz-active-color';	
									}
									
									$color_metrics = to_spc ( json_encode ( $colors ,true ) );
									$css_class = 'thz-btn-pick thz-button thz-btn-'.$key.$active_class.' thz-radius-4';
									$data_print = ' data-color="'.$key.'"';
									$data_print .=' data-colors-metrics="'.$color_metrics.'"';
							?>
				<span class="<?php echo $css_class ?>"<?php echo $data_print ?> title="thz-btn-<?php echo $key ?>"></span>
				<?php } ?>
				<!-- color start -->
				<div class="thz-btn-gen-option preview-bg coloroption-previewBg">
					<label for="<?php echo esc_attr($oid)?>previewBg">
						<?php echo esc_html__('Preview Background:','creatus'); ?>
					</label>
					<?php echo thz_btn_color('previewBg',$btn,$oid) ?>
				</div>
				<!-- color end -->
				<span class="thz-btn-show-data"><?php echo esc_html__('Click to show/hide data','creatus'); ?></span>
			</div>
		</div>
		<!-- options -->
		<div class="thz-btn-gen-options-set">
			<div class="thz-tabs-group" data-isopen="text" data-tabs-group="options">
				<div class="thz-tabs-list-holder">
					<ul class="thz-tabs-list">
						<li class="active-tab-link" data-tabs-group="options">
							<a href="#" class="thz-tab-link" data-tab="elementstyle-defaults" data-group="defaults">
								<?php echo esc_html__('Defaults','creatus'); ?>
							</a>
						</li>
						<li class="notactive-tab-link" data-tabs-group="options">
							<a href="#" class="thz-tab-link" data-tab="elementstyle-btnboxmodel" data-group="btnboxmodel">
								<?php echo esc_html__('Box model','creatus'); ?>
							</a>
						</li>
						<li class="notactive-tab-link" data-tabs-group="options">
							<a href="#" class="thz-tab-link" data-tab="elementstyle-text" data-group="text">
								<?php echo esc_html__('Text','creatus'); ?>
							</a>
						</li>
						<li class="notactive-tab-link" data-tabs-group="options">
							<a href="#" class="thz-tab-link" data-tab="elementstyle-boxshadow" data-group="boxshadow">
								<?php echo esc_html__('Box shadow','creatus'); ?>
							</a>
						</li>
						<li class="notactive-tab-link" data-tabs-group="options">
							<a href="#" class="thz-tab-link" data-tab="elementstyle-icon" data-group="icon">
								<?php echo esc_html__('Icon','creatus'); ?>
							</a>
						</li>
						<li class="notactive-tab-link thz-btn-gen-hide-option" data-tabs-group="options">
							<a href="#" class="thz-tab-link" data-tab="elementstyle-colors" data-group="colors">
								<?php echo esc_html__('Colors','creatus'); ?>
							</a>
						</li>
						<li class="notactive-tab-link" data-tabs-group="options">
							<a href="#" class="thz-tab-link" data-tab="elementstyle-effects" data-group="effects">
								<?php echo esc_html__('Effects','creatus'); ?>
							</a>
						</li>
						<li class="notactive-tab-link" data-tabs-group="options">
							<a href="#" class="thz-tab-link" data-tab="elementstyle-styles" data-group="styles">
								<?php echo esc_html__('Styles','creatus'); ?>
							</a>
						</li>
					</ul>
				</div>
				<div class="thz-tabs-content">
					<div class="thz-tab active-tab" data-tab="elementstyle-defaults" data-tabs-group="options">
						<div class="thz-btn-gen-option-horizontal-group">
							<div class="thz-btn-gen-option hide-links-group">
								<label for="<?php echo esc_attr($oid)?>buttonTag">
									<?php echo esc_html__('Button tag:','creatus'); ?>
								</label>
								<select id="<?php echo esc_attr($oid)?>buttonTag" class="thz-btn-gen-select" data-css-hook="buttonTag">
									<option value="a"<?php if($btn['linkType'] == 'a'){echo ' selected="selected"';}; ?>><?php echo esc_html__('a ( link )','creatus'); ?></option>
									<option value="button"<?php if($btn['linkType'] == 'button'){echo ' selected="selected"';}; ?>><?php echo esc_html__('Button','creatus'); ?></option>
								</select>
							</div>
							<div class="thz-btn-gen-option">
								<label for="<?php echo esc_attr($oid)?>customClass">
									<?php echo esc_html__('Button class:','creatus'); ?>
								</label>
								<input type="text" id="<?php echo esc_attr($oid)?>customClass" maxlength="40" class="thz-btn-gen-textinput customClass" value="<?php echo $btn['customClass']?>"  data-css-hook="customClass" />
							</div>
						</div>
						<div class="thz-btn-gen-option-horizontal-group thz-btn-hide-set">
							<div class="thz-btn-gen-option linkOptions">
								<label for="<?php echo esc_attr($oid)?>linkTarget">
									<?php echo esc_html__('Link traget:','creatus'); ?>
								</label>
								<select id="<?php echo esc_attr($oid)?>linkTarget" class="thz-btn-gen-select linkTarget" data-css-hook="linkTarget">
									<option value="_self"<?php if($btn['linkTarget'] == '_self'){echo ' selected="selected"';}; ?>><?php echo esc_html__('Same window','creatus'); ?></option>
									<option value="_blank"<?php if($btn['linkTarget'] == '_blank'){echo ' selected="selected"';}; ?>><?php echo esc_html__('New window','creatus'); ?></option>
								</select>
							</div>
							<div class="thz-btn-gen-option linkOptions">
								<label for="<?php echo esc_attr($oid)?>linkTitle">
									<?php echo esc_html__('Link title:','creatus'); ?>
								</label>
								<input type="text" id="<?php echo esc_attr($oid)?>linkTitle" maxlength="40" class="thz-btn-gen-textinput linkTitle" value="<?php echo $btn['linkTitle']?>"  data-css-hook="linkTitle" />
							</div>
						</div>
						<div class="thz-btn-gen-option-horizontal-group thz-btn-linksgroup hide-links-group">
							<div class="thz-btn-gen-option linkOptions">
								<label for="<?php echo esc_attr($oid)?>linkType">
									<?php echo esc_html__('Link type:','creatus'); ?>
								</label>
								<select id="<?php echo esc_attr($oid)?>linkType" class="thz-btn-gen-select linkType" data-css-hook="linkType">
									<option value="normal"<?php if($btn['linkType'] == 'normal'){echo ' selected="selected"';}; ?>><?php echo esc_html__('Normal link','creatus'); ?></option>
									<option value="magnific"<?php if($btn['linkType'] == 'magnific'){echo ' selected="selected"';}; ?>><?php echo esc_html__('Magnific popup','creatus'); ?></option>
								</select>
							</div>
							<div class="thz-btn-gen-option linkOptions">
								<label for="<?php echo esc_attr($oid)?>normalLink">
									<?php echo esc_html__('Button link:','creatus'); ?>
								</label>
								<?php
									
									$url_data_attr = 'data-parent="#'.$oid.'"';
									$url_data_attr .= ' data-type=".linkType"';
									$url_data_attr .= ' data-link=".normalLink"';
									$url_data_attr .= ' data-title=".linkTitle"';
									$url_data_attr .= ' data-target=".linkTarget"';	
									$url_data_attr .= ' data-magnific=".magnificId"';							
								?>
								<a class="thz-select-link button button-primary" <?php echo $url_data_attr ?> id="<?php echo esc_attr($oid) ?>add_link"><?php echo esc_html__('Add/edit','creatus'); ?></a>
								<input type="text" id="<?php echo esc_attr($oid)?>normalLink" maxlength="300" class="thz-btn-gen-textinput normalLink" value="<?php echo $btn['normalLink']?>"  data-css-hook="normalLink" readonly="readonly" />
							</div>
							<div class="thz-btn-gen-option linkOptions">
								<label for="<?php echo esc_attr($oid)?>magnificId">
									<?php echo esc_html__('Magnific popup:','creatus'); ?>
								</label>
								<input type="text" id="<?php echo esc_attr($oid)?>magnificId" maxlength="300" class="thz-btn-gen-textinput magnificId" value="<?php echo $btn['magnificId']?>"  data-css-hook="magnificId" />
								<span class="thz-btn-help dashicons dashicons-info" title="<?php echo esc_html__('Add a link to an image or video. If link is not an image the popup will be opened as Magnific popup iframe. There is also a Magnific Popup page builder shortcode and it contains an ID option. You can add that ID here if you wish to open it via click.','creatus') ?>"></span>
							</div>
						</div>
					</div>
					<div class="thz-tab notactive-tab" data-tab="elementstyle-text" data-tabs-group="options">
						<div class="thz-btn-gen-options-group thz-btn-gen-text">
							<div class="thz-btn-gen-options-group-inner">
								<div class="thz-tabs-group" data-isopen="maintext" data-tabs-group="textgroup">
									<div class="thz-tabs-list-holder">
										<ul class="thz-tabs-list">
											<li class="active-tab-link" data-tabs-group="textgroup">
												<a href="#" class="thz-tab-link" data-tab="elementstyle-maintext" data-group="maintext">
													<?php echo esc_html__('Main text','creatus') ?>
												</a>
											</li>
											<li class="notactive-tab-link" data-tabs-group="textgroup">
												<a href="#" class="thz-tab-link" data-tab="elementstyle-subtext" data-group="subtext">
													<?php echo esc_html__('Sub text','creatus') ?>
												</a>
											</li>
											<li class="notactive-tab-link" data-tabs-group="textgroup">
												<a href="#" class="thz-tab-link" data-tab="elementstyle-textshadow" data-group="textshadow">
													<?php echo esc_html__('Text shadow','creatus') ?>
												</a>
											</li>
										</ul>
									</div>
									<div class="thz-tabs-content">
										<div class="thz-tab active-tab" data-tab="elementstyle-maintext" data-tabs-group="textgroup">
											<div class="thz-btn-gen-option-horizontal-group">
												<div class="thz-btn-gen-option">
													<label for="<?php echo esc_attr($oid)?>buttonText">
														<?php echo esc_html__('Button Text:','creatus'); ?>
													</label>
													<input type="text" id="<?php echo esc_attr($oid)?>buttonText" maxlength="300" class="thz-btn-gen-textinput buttonText" value="<?php echo $btn['buttonText']?>"  data-css-hook="buttonText" />
												</div>
												<div class="thz-btn-gen-option">
													<label for="<?php echo esc_attr($oid)?>letterSpacing">
														<?php echo esc_html__('Letter spacing:','creatus'); ?>
													</label>
													<?php echo thz_btn_slider('letterSpacing',$letterSpacingOptions,$btn,$oid) ?>
												</div>
											</div>
											<div class="thz-btn-gen-option-horizontal-group">
												<div class="thz-btn-gen-option">
													<label for="<?php echo esc_attr($oid)?>fontFamily">
														<?php echo esc_html__('Font Family:','creatus'); ?>
													</label>
													<select id="<?php echo esc_attr($oid)?>fontFamily" class="thz-btn-gen-select" data-css-hook="fontFamily">
														<?php echo thz_btn_fonts($btn['fontFamily']) ?>
													</select>
													<span class="thz-btn-help dashicons dashicons-info" title="<?php echo esc_html__('If inherit is selected, button will inehrit the body or container font-family. Note that only some Google fonts will react to Font Weight and Italic change.','creatus') ?>"></span>
												</div>
												<div class="thz-btn-gen-option">
													<label for="<?php echo esc_attr($oid)?>fontSize">
														<?php echo esc_html__('Font Size:','creatus'); ?>
													</label>
													<?php echo thz_btn_slider('fontSize',$FontSizeOptions,$btn,$oid) ?>
												</div>
											</div>
											<div class="thz-btn-gen-option-horizontal-group">
												<div class="thz-btn-gen-option">
													<label for="<?php echo esc_attr($oid)?>fontWeight">
														<?php echo esc_html__('Font Weight:','creatus'); ?>
													</label>
													<select id="<?php echo esc_attr($oid)?>fontWeight" class="thz-btn-gen-select fontWeight" data-css-hook="fontWeight">
														<?php echo thz_btn_font_weight($btn['fontWeight']) ?>
													</select>
												</div>
												<div class="thz-btn-gen-option">
													<label for="<?php echo esc_attr($oid)?>textNudgeH">
														<?php echo esc_html__('Nudge horizontal:','creatus'); ?>
													</label>
													<?php echo thz_btn_slider('textNudgeH',$textNudgeHOptions,$btn,$oid) ?>
												</div>
											</div>
											<div class="thz-btn-gen-option-horizontal-group">
												<div class="thz-btn-gen-option">
													<label for="<?php echo esc_attr($oid)?>textAlign">
														<?php echo esc_html__('Text align:','creatus'); ?>
													</label>
													<select id="<?php echo esc_attr($oid)?>textAlign" class="thz-btn-gen-select textAlign" data-css-hook="textAlign">
														<?php
														$textAlignArray = array('left','center','right');
														foreach($textAlignArray as $align){
															$alignSelected ='';
															if($btn['textAlign'] == $align){
															$alignSelected =' selected="selected"';
														}
														?>
														<option value="<?php echo $align ?>"<?php echo $alignSelected ?>><?php echo ucfirst( $align ) ?></option>
														<?php } ?>
													</select>
												</div>
												<div class="thz-btn-gen-option textnudge">
													<label for="<?php echo esc_attr($oid)?>textNudgeV">
														<?php echo esc_html__('Nudge vertical:','creatus'); ?>
													</label>
													<?php echo thz_btn_slider('textNudgeV',$textNudgeVOptions,$btn,$oid) ?>
												</div>
											</div>
											<div class="thz-btn-gen-option checks">
												<label for="<?php echo esc_attr($oid)?>textItalic">
													<input type="checkbox" id="<?php echo esc_attr($oid)?>textItalic" class="thz-btn-gen-checkbox" value="italic" data-css-hook="textItalic"<?php if($btn['textItalic']){echo ' checked="checked"';}?>>
													<?php echo esc_html__('Italic','creatus'); ?>
												</label>
												<label for="<?php echo esc_attr($oid)?>textUppercase">
													<input type="checkbox"  class="thz-btn-gen-checkbox" id="<?php echo esc_attr($oid)?>textUppercase" value="uppercase" data-css-hook="textUppercase"<?php if($btn['textUppercase']){echo ' checked="checked"';}?>>
													<?php echo esc_html__('Uppercase','creatus'); ?>
												</label>
											</div>
										</div>
										<div class="thz-tab notactive-tab" data-tab="elementstyle-subtext" data-tabs-group="textgroup">
											<div class="thz-btn-gen-option-horizontal-group">
												<div class="thz-btn-gen-option">
													<label for="<?php echo esc_attr($oid)?>buttonSubText">
														<?php echo esc_html__('Button Sub Text:','creatus'); ?>
													</label>
													<input type="text" id="<?php echo esc_attr($oid)?>buttonSubText" maxlength="300" class="thz-btn-gen-textinput buttonSubText" value="<?php echo $btn['buttonSubText']?>"  data-css-hook="buttonSubText" />
												</div>
												<div class="thz-btn-gen-option">
													<label for="<?php echo esc_attr($oid)?>SubTextletterSpacing">
														<?php echo esc_html__('Letter spacing:','creatus'); ?>
													</label>
													<?php echo thz_btn_slider('SubTextletterSpacing',$SubTextletterSpacingOptions,$btn,$oid) ?>
												</div>
											</div>
											<div class="thz-btn-gen-option-horizontal-group">
												<div class="thz-btn-gen-option">
													<label for="<?php echo esc_attr($oid)?>SubTextfontFamily">
														<?php echo esc_html__('Font Family:','creatus'); ?>
													</label>
													<select id="<?php echo esc_attr($oid)?>SubTextfontFamily" class="thz-btn-gen-select" data-css-hook="SubTextfontFamily">
														<?php echo thz_btn_fonts($btn['SubTextfontFamily']) ?>
													</select>
													<span class="thz-btn-help dashicons dashicons-info" title="<?php echo esc_html__('If inherit is selected, sub text will inehrit the button, body or container font-family. Note that only some Google fonts will react to Font Weight and Italic change.','creatus') ?>"></span>
												</div>
												<div class="thz-btn-gen-option">
													<label for="<?php echo esc_attr($oid)?>SubTextfontSize">
														<?php echo esc_html__('Font Size:','creatus'); ?>
													</label>
													<?php echo thz_btn_slider('SubTextfontSize',$SubTextFontSizeOptions,$btn,$oid) ?>
												</div>
											</div>
											<div class="thz-btn-gen-option-horizontal-group">
												<div class="thz-btn-gen-option">
													<label for="<?php echo esc_attr($oid)?>SubTextfontWeight">
														<?php echo esc_html__('Font Weight:','creatus'); ?>
													</label>
													<select id="<?php echo esc_attr($oid)?>SubTextfontWeight" class="thz-btn-gen-select SubTextfontWeight" data-css-hook="SubTextfontWeight">
														<?php echo thz_btn_font_weight($btn['SubTextfontWeight']) ?>
													</select>
												</div>
												<div class="thz-btn-gen-option textnudge">
													<label for="<?php echo esc_attr($oid)?>SubTextNudgeH">
														<?php echo esc_html__('Nudge horizontal:','creatus'); ?>
													</label>
													<?php echo thz_btn_slider('SubTextNudgeH',$SubTextNudgeHOptions,$btn,$oid) ?>
												</div>
											</div>
											<div class="thz-btn-gen-option-horizontal-group">
												<div class="thz-btn-gen-option checks">
													<label for="<?php echo esc_attr($oid)?>SubTextItalic">
														<input type="checkbox" id="<?php echo esc_attr($oid)?>SubTextItalic" class="thz-btn-gen-checkbox" value="italic" data-css-hook="SubTextItalic"<?php if($btn['SubTextItalic']){echo ' checked="checked"';}?>>
														<?php echo esc_html__('Italic','creatus'); ?>
													</label>
													<label for="<?php echo esc_attr($oid)?>SubTextUppercase">
														<input type="checkbox"  class="thz-btn-gen-checkbox" id="<?php echo esc_attr($oid)?>SubTextUppercase" value="uppercase" data-css-hook="SubTextUppercase"<?php if($btn['SubTextUppercase']){echo ' checked="checked"';}?>>
														<?php echo esc_html__('Uppercase','creatus'); ?>
													</label>
												</div>
												<div class="thz-btn-gen-option textnudge">
													<label for="<?php echo esc_attr($oid)?>SubTextNudgeV">
														<?php echo esc_html__('Nudge vertical:','creatus'); ?>
													</label>
													<?php echo thz_btn_slider('SubTextNudgeV',$SubTextNudgeVOptions,$btn,$oid) ?>
												</div>
											</div>
										</div>
										<div class="thz-tab notactive-tab" data-tab="elementstyle-textshadow" data-tabs-group="textgroup">
											<div class="thz-btn-gen-options-group-single textShadow">
												<div class="thz-btn-gen-option">
													<label for="<?php echo esc_attr($oid)?>borderStyle">
														<?php echo esc_html__('Select text shadow:','creatus'); ?>
													</label>
													<select id="<?php echo esc_attr($oid)?>textShadow" data-css-hook="textShadow" class="thz-btn-gen-select textShadow">
														<?php
													foreach($textShadoOption as $shadow => $shadowMetrics ){
														$shadowSelected ='';
														if($btn['textShadow'] == $shadow){
															$shadowSelected =' selected="selected"';
														}
														$dataMetrics = ' data-metrics="'.to_spc ( $shadowMetrics ).'"';
												?>
														<option value="<?php echo $shadow ?>"<?php echo $shadowSelected.$dataMetrics ?>><?php echo ucfirst ( $shadow ) ?></option>
														<?php } ?>
													</select>
												</div>
											</div>
											<div class="thz-btn-gen-options-group-single thz-btn-gen-textshadow thz-btn-gen-hide-option">
												<div class="thz-btn-gen-options-group-inner">
													<div class="thz-btn-gen-option">
														<label for="<?php echo esc_attr($oid)?>textshadowX">
															<?php echo esc_html__('Horizontal Position:','creatus'); ?>
														</label>
														<?php echo thz_btn_slider('textshadowX',$TextshadowX,$btn,$oid) ?>
													</div>
													<div class="thz-btn-gen-option">
														<label for="<?php echo esc_attr($oid)?>textshadowY">
															<?php echo esc_html__('Vertical Position:','creatus'); ?>
														</label>
														<?php echo thz_btn_slider('textshadowY',$TextshadowY,$btn,$oid) ?>
													</div>
													<div class="thz-btn-gen-option">
														<label for="<?php echo esc_attr($oid)?>textshadowBlur">
															<?php echo esc_html__('Blur Radius:','creatus'); ?>
														</label>
														<?php echo thz_btn_slider('textshadowBlur',$TextshadowBlur,$btn,$oid) ?>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="thz-tab notactive-tab" data-tab="elementstyle-btnboxmodel" data-tabs-group="options">
						<div class="thz-btn-gen-options-group thz-btn-gen-padding">
							<div class="thz-btn-gen-options-group-inner">
								<div class="thz-tabs-group" data-isopen="size" data-tabs-group="metricsgroup">
									<div class="thz-tabs-list-holder">
										<ul class="thz-tabs-list">
											<li class="active-tab-link" data-tabs-group="metricsgroup">
												<a href="#" class="thz-tab-link" data-tab="elementstyle-size" data-group="size">
													<?php echo esc_html__('Size','creatus') ?>
												</a>
											</li>
											<li class="notactive-tab-link" data-tabs-group="metricsgroup">
												<a href="#" class="thz-tab-link" data-tab="elementstyle-margin" data-group="margin">
													<?php echo esc_html__('Margin','creatus') ?>
												</a>
											</li>
											<li class="notactive-tab-link" data-tabs-group="metricsgroup">
												<a href="#" class="thz-tab-link" data-tab="elementstyle-border" data-group="border">
													<?php echo esc_html__('Border','creatus') ?>
												</a>
											</li>
										</ul>
									</div>
									<div class="thz-tabs-content">
										<div class="thz-tab active-tab" data-tab="elementstyle-size" data-tabs-group="metricsgroup">
											<div class="thz-btn-gen-option predefined">
												<?php 
				
				$sizesArray = array(
					'none' =>'{"paddingY":0,"paddingX":0,"fontSize":14,"fontWeight":400}',
					'small' =>'{"paddingY":10,"paddingX":20,"fontSize":12,"fontWeight":400}',
					'normal' =>'{"paddingY":12,"paddingX":24,"fontSize":14,"fontWeight":400}',
					'medium' =>'{"paddingY":16,"paddingX":34,"fontSize":14,"fontWeight":400}',
					'large' =>'{"paddingY":18,"paddingX":44,"fontSize":14,"fontWeight":400}',
					'xlarge' =>'{"paddingY":22,"paddingX":54,"fontSize":14,"fontWeight":400}',
					'custom' =>''
				);
				 foreach($sizesArray as $size => $sizeMetrics ){
					
					$sizeChecked ='';
					
					if($btn['buttonSizeClass'] == $size){
						$sizeChecked =' checked="checked"';
					}
					
					$id = $oid.'buttonSizeClass'.$size; // phpcs:ignore WordPress.WP.GlobalVariablesOverride.OverrideProhibited
					$dataMetrics = ' data-metrics="'.to_spc ( $sizeMetrics ).'"';
					
					if($size =='custom'){
						$dataMetrics ='';
					}
					
					$label = ucfirst($size);
					
					if($size =='xlarge'){
						$label ='X-large';
					}	
					
					$input = '<input type="radio" value="'.$size.'" data-css-hook="buttonSizeClass" id="'.$id.'"';
					$input .=' class="thz-btn-gen-radioinput thz-btn-gen-size-predefined"'. $dataMetrics.$sizeChecked.'>';						
				?>
												<label for="<?php echo $id?>">
													<?php echo $input.$label?>
												</label>
												<?php } ?>
											</div>
											<div class="thz-btn-gen-option-horizontal-group customsize">
												<div class="thz-btn-gen-option">
													<label for="<?php echo esc_attr($oid)?>paddingX">
														<?php echo esc_html__('Horizontal:','creatus'); ?>
													</label>
													<?php echo thz_btn_slider('paddingX',$hPaddingOptions,$btn,$oid) ?>
												</div>
												<div class="thz-btn-gen-option">
													<label for="<?php echo esc_attr($oid)?>paddingY">
														<?php echo esc_html__('Vertical:','creatus'); ?>
													</label>
													<?php echo thz_btn_slider('paddingY',$vPaddingOptions,$btn,$oid) ?>
												</div>
											</div>
											<div class="thz-btn-gen-option">
												<label for="<?php echo esc_attr($oid)?>buttonFullWidth">
													<input type="checkbox"  class="thz-btn-gen-checkbox" id="<?php echo esc_attr($oid)?>buttonFullWidth" value="full" data-css-hook="buttonFullWidth"<?php if($btn['buttonFullWidth']){echo ' checked="checked"';}?>>
													<?php echo esc_html__('Full width','creatus'); ?>
												</label>
											</div>
										</div>
										<div class="thz-tab notactive-tab" data-tab="elementstyle-margin" data-tabs-group="metricsgroup">
											<div class="thz-btn-gen-options-group-inner">
												<div class="thz-btn-gen-option-horizontal-group">
													<div class="thz-btn-gen-option">
														<label for="<?php echo esc_attr($oid)?>marginTop">
															<?php echo esc_html__('Top:','creatus'); ?>
														</label>
														<?php echo thz_btn_slider('marginTop',$tMarginOptions,$btn,$oid) ?>
													</div>
													<div class="thz-btn-gen-option">
														<label for="<?php echo esc_attr($oid)?>marginRight">
															<?php echo esc_html__('Right:','creatus'); ?>
														</label>
														<?php echo thz_btn_slider('marginRight',$rMarginOptions,$btn,$oid) ?>
													</div>
												</div>
												<div class="thz-btn-gen-option-horizontal-group">
													<div class="thz-btn-gen-option">
														<label for="<?php echo esc_attr($oid)?>marginBottom">
															<?php echo esc_html__('Bottom:','creatus'); ?>
														</label>
														<?php echo thz_btn_slider('marginBottom',$bMarginOptions,$btn,$oid) ?>
													</div>
													<div class="thz-btn-gen-option">
														<label for="<?php echo esc_attr($oid)?>marginLeft">
															<?php echo esc_html__('Left:','creatus'); ?>
														</label>
														<?php echo thz_btn_slider('marginLeft',$lMarginOptions,$btn,$oid) ?>
													</div>
												</div>
											</div>
										</div>
										<div class="thz-tab notactive-tab" data-tab="elementstyle-border" data-tabs-group="metricsgroup">
											<div class="thz-btn-gen-options-group thz-btn-gen-border">
												<div class="thz-btn-gen-options-group-inner">
													<div class="thz-btn-gen-option-horizontal-group">
														<div class="thz-btn-gen-option">
															<label for="<?php echo esc_attr($oid)?>borderWidth">
																<?php echo esc_html__('Border size:','creatus'); ?>
															</label>
															<?php echo thz_btn_slider('borderWidth',$BorderSizeOptions,$btn,$oid) ?>
														</div>
														<div class="thz-btn-gen-option">
															<label for="<?php echo esc_attr($oid)?>borderRadius">
																<?php echo esc_html__('Border radius:','creatus'); ?>
															</label>
															<?php echo thz_btn_slider('borderRadius',$BorderRadiusOptions,$btn,$oid) ?>
														</div>
													</div>
                                                    <div class="thz-btn-gen-option-horizontal-group">
                                                        <div class="thz-btn-gen-option side">
                                                            <label for="<?php echo esc_attr($oid)?>borderSide">
                                                                <?php echo esc_html__('Border side:','creatus'); ?>
                                                            </label>
                                                            <select id="<?php echo esc_attr($oid)?>borderSide" class="thz-btn-gen-select" data-css-hook="borderSide">
															<?php
                                                                    $borderSideArr = array(
                                                                        'all' 		=>'All',
                                                                        'top' 		=>'Top',
                                                                        'bottom' 	=>'Bottom',
                                                                        'v' 		=>'Vertical',
                                                                        'h' 		=>'Horizontal',
                                                                    );
                        
                                                                    foreach($borderSideArr as $side => $selectText ){
                                                                    $sideSelected ='';
                                                                    if($btn['borderSide'] == $side){
                                                                        $sideSelected =' selected="selected"';
                                                                    }
                                                                ?>
                                                            <option value="<?php echo $side ?>"<?php echo $sideSelected ?>><?php echo $selectText ?></option>
                                                            <?php } ?>
                                                            </select>
                                                        </div>

                                                        <div class="thz-btn-gen-option style">
                                                            <label for="<?php echo esc_attr($oid)?>borderStyle">
                                                                <?php echo esc_html__('Border style:','creatus'); ?>
                                                            </label>
                                                            <select id="<?php echo esc_attr($oid)?>borderStyle" class="thz-btn-gen-select" data-css-hook="borderStyle">
															<?php
                                                                    $borderStyleArr = array(
                                                                        'none' 			=>'None',
                                                                        'solid' 		=>'Solid',
                                                                        'dashed' 		=>'Dashed',
																		'dotted' 		=>'Dotted',
                                                                        'double' 		=>'Double',
                                                                        'groove' 		=>'Groove',
                                                                        'inset' 		=>'Inset',
                                                                        'outset' 		=>'Outset',
                                                                        'ridge' 		=>'Ridge',
                                                                        'transparent' 	=>'Transparent',
                                                                    );
                        
                                                                    foreach($borderStyleArr as $style => $selectText ){
                                                                    $styleSelected ='';
                                                                    if($btn['borderStyle'] == $style){
                                                                        $styleSelected =' selected="selected"';
                                                                    }
                                                                ?>
                                                            <option value="<?php echo $style ?>"<?php echo $styleSelected ?>><?php echo $selectText ?></option>
                                                            <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="thz-tab notactive-tab" data-tab="elementstyle-boxshadow" data-tabs-group="options">
						<div class="thz-btn-gen-options-group thz-btn-gen-boxshadow">
							<div class="thz-btn-gen-options-group-inner">
								<div class="thz-btn-gen-option-horizontal-group boxshadowpredefined">
									<div class="thz-btn-gen-option">
										<label for="<?php echo esc_attr($oid)?>boxShadow">
											<?php echo esc_html__('Select box shadow:','creatus'); ?>
										</label>
										<select id="<?php echo esc_attr($oid)?>boxShadow" data-css-hook="boxShadow" class="thz-btn-gen-select boxShadow">
											<?php
														foreach($boxShadoOption as $shadow => $shadowMetrics ){
															$shadowSelected ='';
															if($btn['boxShadow'] == $shadow){
																$shadowSelected =' selected="selected"';
															}
															$dataMetrics = ' data-metrics="'.to_spc ( $shadowMetrics ).'"';
															
															$name = str_replace('-',' ',$shadow );
														?>
											<option value="<?php echo $shadow ?>"<?php echo $shadowSelected.$dataMetrics ?>><?php echo ucfirst ( $name ) ?></option>
											<?php } ?>
										</select>
									</div>
									<div class="thz-btn-gen-option">
										<label for="<?php echo esc_attr($oid)?>boxShadowOpacity">
											<?php echo esc_html__('Opacity:','creatus'); ?>
										</label>
										<?php echo thz_btn_slider('boxShadowOpacity',$boxShadowOpacity,$btn,$oid) ?>
									</div>
								</div>
								<div class="thz-tabs-group thz-btn-gen-hide-option" data-isopen="shadow1" data-tabs-group="shadows">
									<div class="thz-tabs-list-holder">
										<ul class="thz-tabs-list">
											<?php 
															for ($shadow = 1; $shadow <= $btn['boxShadowsCount']; $shadow++) {
																$isactive = 'notactive-tab-link';
																if($shadow == 1){
																	$isactive = 'active-tab-link';
																}
														?>
											<li class="<?php echo $isactive ?>" data-tabs-group="shadows">
												<a href="#" class="thz-tab-link" data-tab="elementstyle-shadow<?php echo $shadow ?>" data-group="shadow<?php echo $shadow ?>">
													Shadow <?php echo $shadow ?>
												</a>
											</li>
											<?php  }?>
										</ul>
									</div>
									<?php 
													for ($shadow = 1; $shadow <= $btn['boxShadowsCount']; $shadow++) {
													
														$isactive = 'notactive-tab';
														if($shadow == 1){
															$isactive = 'active-tab';
														}
														
														$boxshadowX 			= '{"min":-50,"max":50,"step":1,"type":"single","from":'.$btn['boxshadowX'.$shadow].'}';
														$boxshadowY				= '{"min":-50,"max":50,"step":1,"type":"single","from":'.$btn['boxshadowY'.$shadow].'}';
														$boxshadowBlurRadius 	= '{"min":0,"max":50,"step":1,"type":"single","from":'.$btn['boxshadowBlurRadius'.$shadow].'}';
														$boxshadowSpreadRadius	= '{"min":-50,"max":50,"step":1,"type":"single","from":'.$btn['boxshadowSpreadRadius'.$shadow].'}';
												?>
									<div class="thz-tabs-content">
										<div class="thz-tab <?php echo $isactive ?>" data-tab="elementstyle-shadow<?php echo $shadow ?>" data-tabs-group="shadows">
											<div class="thz-btn-gen-option-horizontal-group">
												<div class="thz-btn-gen-option">
													<!-- color start -->
													<div class="thz-btn-gen-color-outer coloroption-boxshadow">
														<label for="<?php echo esc_attr($oid)?>boxshadow<?php echo $shadow ?>Color">
															<?php echo esc_html__('Box shadow color:','creatus'); ?>
														</label>
														<?php echo thz_btn_color('boxshadow'.$shadow.'Color',$btn,$oid) ?>
													</div>
												</div>
												<!-- color end -->
												
												<div class="thz-btn-gen-option">
													<label for="<?php echo esc_attr($oid)?>shadowInset<?php echo $shadow ?>">
														<input id="<?php echo esc_attr($oid)?>shadowInset<?php echo $shadow ?>" type="checkbox" class="thz-btn-gen-checkbox" data-css-hook="shadowInset<?php echo $shadow ?>"<?php if($btn['shadowInset'.$shadow]){?> checked="checked"<?php } ?>>
														<?php echo esc_html__('Inset:','creatus'); ?>
													</label>
												</div>
											</div>
											<div class="thz-btn-gen-option-horizontal-group">
												<div class="thz-btn-gen-option">
													<label for="<?php echo esc_attr($oid)?>boxshadowX<?php echo $shadow ?>">
														<?php echo esc_html__('Horizontal Position:','creatus'); ?>
													</label>
													<?php echo thz_btn_slider('boxshadowX'.$shadow ,$boxshadowX,$btn,$oid) ?>
												</div>
												<div class="thz-btn-gen-option">
													<label for="<?php echo esc_attr($oid)?>boxshadowY<?php echo $shadow ?>">
														<?php echo esc_html__('Vertical Position:','creatus'); ?>
													</label>
													<?php echo thz_btn_slider('boxshadowY'.$shadow ,$boxshadowY,$btn,$oid) ?>
												</div>
											</div>
											<div class="thz-btn-gen-option-horizontal-group">
												<div class="thz-btn-gen-option">
													<label for="<?php echo esc_attr($oid)?>boxshadowBlurRadius<?php echo $shadow ?>">
														<?php echo esc_html__('Blur Radius:','creatus'); ?>
													</label>
													<?php echo thz_btn_slider('boxshadowBlurRadius'.$shadow ,$boxshadowBlurRadius,$btn,$oid) ?>
												</div>
												<div class="thz-btn-gen-option">
													<label for="<?php echo esc_attr($oid)?>boxshadowSpreadRadius<?php echo $shadow ?>">
														<?php echo esc_html__('Spread Radius:','creatus'); ?>
													</label>
													<?php echo thz_btn_slider('boxshadowSpreadRadius'.$shadow ,$boxshadowSpreadRadius,$btn,$oid) ?>
												</div>
											</div>
										</div>
									</div>
									<?php  }?>
								</div>
							</div>
						</div>
					</div>
					<div class="thz-tab notactive-tab" data-tab="elementstyle-icon" data-tabs-group="options">
						<div class="thz-btn-gen-options-group thz-btn-gen-icon">
							<div class="thz-btn-gen-options-group-inner">
								<div class="thz-btn-gen-option">
									<label for="<?php echo esc_attr($oid)?>buttonIcon">
										<?php echo esc_html__('Select icon:','creatus'); ?>
									</label>
									<div class="thz-icons">
										<input type="text" id="<?php echo esc_attr($oid)?>buttonIcon" data-current="<?php echo $btn['buttonIcon'] ?>" class="thz-icon-input" value="<?php echo $btn['buttonIcon'] ?>"  data-css-hook="buttonIcon" />
										<input type="text" class="thz-icon-name" value="<?php echo $btn['buttonIcon'] ?>" readonly />
									</div>
								</div>
								<div class="thz-btn-gen-option-horizontal-group">
									<div class="thz-btn-gen-option type">
										<label for="<?php echo esc_attr($oid)?>iconType">
											<?php echo esc_html__('Icon type:','creatus'); ?>
										</label>
										<select id="<?php echo esc_attr($oid)?>iconType" class="thz-btn-gen-select" data-css-hook="iconType">
											<option value="inline"<?php echo $btn['iconType'] == 'inline' ? ' selected="selected"': ''; ?>>Inline</option>
											<option value="boxed"<?php echo $btn['iconType'] == 'boxed' ? ' selected="selected"': ''; ?>>Boxed</option>
										</select>
									</div>
									<div class="thz-btn-gen-option">
										<label for="<?php echo esc_attr($oid)?>iconSpace">
											<?php echo esc_html__('Icon Space:','creatus'); ?>
										</label>
										<?php echo thz_btn_slider('iconSpace',$iconSpaceOptions,$btn,$oid) ?>
									</div>
								</div>
								<div class="thz-btn-gen-option-horizontal-group">
									<div class="thz-btn-gen-option size">
										<label for="<?php echo esc_attr($oid)?>iconSize">
											Icon size:
										</label>
										<select id="<?php echo esc_attr($oid)?>iconSize" class="thz-btn-gen-select" data-css-hook="iconSize">
											<?php
													
													$iconSizeArray = array(
														'inherit' 		=>'Inherit',
														'thz-is-md' 	=>'Medium (em)',
														'thz-is-lg' 	=>'Large (em)',
														'thz-is-xl' 	=>'X-large (em)',
														'thz-is-x4' 	=>'Jumbo (em)',
														'thz-is-x5' 	=>'Mega (em)',
														'thz-is-sm-px' 	=>'Small (px)',
														'thz-is-md-px' 	=>'Medium (px)',
														'thz-is-lg-px' 	=>'Large (px)',
														'thz-is-x4-px' 	=>'X-Large (px)',
														'thz-is-x5-px' 	=>'Jumbo (px)',
													
													);
		
													foreach($iconSizeArray as $size => $selectText ){
														//print_r($selectText);
													$sizeSelected ='';
													if($btn['iconSize'] == $size){
														$sizeSelected =' selected="selected"';
													}
												?>
											<option value="<?php echo $size ?>"<?php echo $sizeSelected ?>><?php echo $selectText ?></option>
											<?php } ?>
										</select>
									</div>
									<div class="thz-btn-gen-option">
										<label for="<?php echo esc_attr($oid)?>iconNudgeH">
											<?php echo esc_html__('Nudge horizontal:','creatus'); ?>
										</label>
										<?php echo thz_btn_slider('iconNudgeH',$iconNudgeHOptions,$btn,$oid) ?>
									</div>
								</div>
								<div class="thz-btn-gen-option-horizontal-group">
									<div class="thz-btn-gen-option position">
										<label for="<?php echo esc_attr($oid)?>iconPosition">
											<?php echo esc_html__('Icon position:','creatus'); ?>
										</label>
										<select id="<?php echo esc_attr($oid)?>iconPosition" class="thz-btn-gen-select" data-css-hook="iconPosition">
											<option value="left"<?php echo $btn['iconPosition'] == 'left' ? ' selected="selected"': ''; ?>>Left</option>
											<option value="right"<?php echo $btn['iconPosition'] == 'right' ? ' selected="selected"': ''; ?>>Right</option>
										</select>
									</div>
									<div class="thz-btn-gen-option">
										<label for="<?php echo esc_attr($oid)?>iconNudgeV">
											<?php echo esc_html__('Nudge vertical:','creatus'); ?>
										</label>
										<?php echo thz_btn_slider('iconNudgeV',$iconNudgeVOptions,$btn,$oid) ?>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="thz-tab notactive-tab" data-tab="elementstyle-colors" data-tabs-group="options">
						<!-- color options -->
						<div class="thz-btn-gen-color-options thz-btn-gen-hide-option">
							<div class="thz-btn-gen-color-set">
								<div class="thz-btn-gen-color-set-inner">
									<span class="thz-btn-gen-color-set-title"> Normal state </span>
									
									<!-- color start -->
									<div class="thz-btn-gen-color-outer coloroption-normalTextColor">
										<label for="<?php echo esc_attr($oid)?>normalTextColor">
											<?php echo esc_html__('Text color:','creatus'); ?>
										</label>
										<?php echo thz_btn_color('normalTextColor',$btn,$oid) ?>
									</div>
									<!-- color end -->
									
									<!-- color start -->
									<div class="thz-btn-gen-color-outer coloroption-normalBgColor">
										<label for="<?php echo esc_attr($oid)?>normalBgColor">
											<?php echo esc_html__('Background color:','creatus'); ?>
										</label>
										<?php echo thz_btn_color('normalBgColor',$btn,$oid) ?>
									</div>
									
									<!-- color end -->
									
									<!-- color start -->
									<div class="thz-btn-gen-color-outer coloroption-normalBorderColor">
										<label for="<?php echo esc_attr($oid)?>normalBorderColor">
											<?php echo esc_html__('Border color:','creatus'); ?>
										</label>
										<?php echo thz_btn_color('normalBorderColor',$btn,$oid) ?>
									</div>
									
									<!-- color end -->
									
									<!-- color start -->
									<div class="thz-btn-gen-color-outer coloroption-normalIconColor">
										<label for="<?php echo esc_attr($oid)?>normalIconColor">
											<?php echo esc_html__('Icon color:','creatus'); ?>
										</label>
										<?php echo thz_btn_color('normalIconColor',$btn,$oid) ?>
									</div>
									<!-- color end -->
									
									<!-- color start -->
									<div class="thz-btn-gen-color-outer coloroption-normalIconBg">
										<label for="<?php echo esc_attr($oid)?>normalIconBg">
											<?php echo esc_html__('Icon background:','creatus'); ?>
										</label>
										<?php echo thz_btn_color('normalIconBg',$btn,$oid) ?>
									</div>
									<!-- color end -->
									
									<!-- color start -->
									<div class="thz-btn-gen-color-outer coloroption-normalTshColor">
										<label for="<?php echo esc_attr($oid)?>normalTshColor">
											<?php echo esc_html__('Text shadow color:','creatus'); ?>
										</label>
										<?php echo thz_btn_color('normalTshColor',$btn,$oid) ?>
									</div>
									
									<!-- color end -->
									
									<!-- color start -->
									<div class="thz-btn-gen-color-outer coloroption-normalGradient1">
										<label for="<?php echo esc_attr($oid)?>normalGradient1">
											<?php echo esc_html__('Gradient color 1:','creatus'); ?>
										</label>
										<?php echo thz_btn_color('normalGradient1',$btn,$oid) ?>
									</div>
									
									<!-- color end -->
									
									<!-- color start -->
									<div class="thz-btn-gen-color-outer coloroption-normalGradient2">
										<label for="<?php echo esc_attr($oid)?>normalGradient2">
											<?php echo esc_html__('Gradient color 2:','creatus'); ?>
										</label>
										<?php echo thz_btn_color('normalGradient2',$btn,$oid) ?>
									</div>
									
									<!-- color end -->
									
								</div>
							</div>
							<div class="thz-btn-gen-color-set">
								<div class="thz-btn-gen-color-set-inner">
									<span class="thz-btn-gen-color-set-title"> Hovered state </span>
									
									<!-- color start -->
									<div class="thz-btn-gen-color-outer coloroption-hoveredTextColor">
										<label for="<?php echo esc_attr($oid)?>hoveredTextColor">
											<?php echo esc_html__('Text color:','creatus'); ?>
										</label>
										<?php echo thz_btn_color('hoveredTextColor',$btn,$oid) ?>
									</div>
									<!-- color end -->
									
									<!-- color start -->
									<div class="thz-btn-gen-color-outer coloroption-hoveredBgColor">
										<label for="<?php echo esc_attr($oid)?>hoveredBgColor">
											<?php echo esc_html__('Background color:','creatus'); ?>
										</label>
										<?php echo thz_btn_color('hoveredBgColor',$btn,$oid) ?>
									</div>
									
									<!-- color end -->
									
									<!-- color start -->
									<div class="thz-btn-gen-color-outer coloroption-hoveredBorderColor">
										<label for="<?php echo esc_attr($oid)?>hoveredBorderColor">
											<?php echo esc_html__('Border color:','creatus'); ?>
										</label>
										<?php echo thz_btn_color('hoveredBorderColor',$btn,$oid) ?>
									</div>
									
									<!-- color end -->
									
									<!-- color start -->
									<div class="thz-btn-gen-color-outer coloroption-hoveredIconColor">
										<label for="<?php echo esc_attr($oid)?>hoveredIconColor">
											<?php echo esc_html__('Icon color:','creatus'); ?>
										</label>
										<?php echo thz_btn_color('hoveredIconColor',$btn,$oid) ?>
									</div>
									<!-- color end -->
									
									<!-- color start -->
									<div class="thz-btn-gen-color-outer coloroption-hoveredIconBg">
										<label for="<?php echo esc_attr($oid)?>hoveredIconBg">
											<?php echo esc_html__('Icon background:','creatus'); ?>
										</label>
										<?php echo thz_btn_color('hoveredIconBg',$btn,$oid) ?>
									</div>
									<!-- color end -->
									
									<!-- color start -->
									<div class="thz-btn-gen-color-outer coloroption-hoveredTshColor">
										<label for="<?php echo esc_attr($oid)?>hoveredTshColor">
											<?php echo esc_html__('Text shadow color:','creatus'); ?>
										</label>
										<?php echo thz_btn_color('hoveredTshColor',$btn,$oid) ?>
									</div>
									
									<!-- color end -->
									
									<!-- color start -->
									<div class="thz-btn-gen-color-outer coloroption-hoveredGradient1">
										<label for="<?php echo esc_attr($oid)?>hoveredGradient1">
											<?php echo esc_html__('Gradient color 1:','creatus'); ?>
										</label>
										<?php echo thz_btn_color('hoveredGradient1',$btn,$oid) ?>
									</div>
									
									<!-- color end -->
									
									<!-- color start -->
									<div class="thz-btn-gen-color-outer coloroption-hoveredGradient2">
										<label for="<?php echo esc_attr($oid)?>hoveredGradient2">
											<?php echo esc_html__('Gradient color 2:','creatus'); ?>
										</label>
										<?php echo thz_btn_color('hoveredGradient2',$btn,$oid) ?>
									</div>
									
									<!-- color end -->
									
								</div>
							</div>
						</div>
					</div>
					<div class="thz-tab notactive-tab" data-tab="elementstyle-effects" data-tabs-group="options">
						<div class="thz-btn-gen-option-horizontal-groupx3">
							<div class="thz-btn-gen-option">
								<label for="<?php echo esc_attr($oid)?>buttonAnimation">
									<input type="checkbox" id="<?php echo esc_attr($oid)?>buttonAnimation" class="thz-btn-gen-checkbox" data-css-hook="buttonAnimation"<?php if($btn['buttonAnimation']){echo ' checked="checked"';}?>>
									<?php echo esc_html__('Animate','creatus'); ?>
								</label>
							</div>
							<div class="thz-btn-gen-option">
								<label for="<?php echo esc_attr($oid)?>buttonTransition">
									<input type="checkbox"  class="thz-btn-gen-checkbox" id="<?php echo esc_attr($oid)?>buttonTransition" data-css-hook="buttonTransition"<?php if($btn['buttonTransition']){echo ' checked="checked"';}?>>
									<?php echo esc_html__('Hover transition','creatus'); ?>
								</label>
							</div>
                            <div class="thz-btn-gen-option">
                                <label for="<?php echo esc_attr($oid)?>iconOnHover">
                                    <input type="checkbox"  class="thz-btn-gen-checkbox" id="<?php echo esc_attr($oid)?>iconOnHover" data-css-hook="iconOnHover"<?php if($btn['iconOnHover']){echo ' checked="checked"';}?>>
                                    <?php echo esc_html__('Show icon on hover','creatus'); ?>
                                </label>
                            </div>
						</div>
						<div class="thz-btn-gen-option-horizontal-groupx3 animationoptions">
							<div class="thz-btn-gen-option">
								<label for="<?php echo esc_attr($oid)?>animateEffect">
									<?php echo esc_html__('Effect:','creatus'); ?>
								</label>
								<select id="<?php echo esc_attr($oid)?>animateEffect" class="thz-btn-gen-select animateEffect" data-css-hook="animateEffect">
									<?php echo thz_btn_effects($btn['animateEffect']) ?>
								</select>
								<span class="thz-btn-help dashicons dashicons-info" title="<?php echo esc_html__('Select the animation effect.','creatus') ?>"></span>
							</div>
							<div class="thz-btn-gen-option">
								<label for="<?php echo esc_attr($oid)?>effectDuration">
									<?php echo esc_html__('Duration:','creatus'); ?>
								</label>
								<input type="text" id="<?php echo esc_attr($oid)?>effectDuration" maxlength="300" class="thz-btn-gen-textinput effectDuration thz-btn-number" value="<?php echo $btn['effectDuration']?>"  data-css-hook="effectDuration" />
							</div>
							<div class="thz-btn-gen-option">
								<label for="<?php echo esc_attr($oid)?>animateDelay">
									<?php echo esc_html__('Delay:','creatus'); ?>
								</label>
								<input type="text" id="<?php echo esc_attr($oid)?>animateDelay" maxlength="300" class="thz-btn-gen-textinput animateDelay thz-btn-number" value="<?php echo $btn['animateDelay']?>"  data-css-hook="animateDelay" />
							</div>
						</div>
                        <div class="thz-btn-gen-option-horizontal-groupx3">
                            <div class="thz-btn-gen-option">
                                <label for="<?php echo esc_attr($oid)?>moveEffect">
                                    <?php echo esc_html__('Move on hover:','creatus'); ?>
                                </label>
                                <select id="<?php echo esc_attr($oid)?>moveEffect" class="thz-btn-gen-select moveEffect" data-css-hook="moveEffect">
                                    <option value="none"<?php echo $btn['moveEffect'] == 'none' ? ' selected="selected"': ''; ?>>Do not move</option>
                                    <option value="thz-btn-move-left"<?php echo $btn['moveEffect'] == 'thz-btn-move-left' ? ' selected="selected"': ''; ?>>Left</option>
                                    <option value="thz-btn-move-right"<?php echo $btn['moveEffect'] == 'thz-btn-move-right' ? ' selected="selected"': ''; ?>>Right</option>
                                    <option value="thz-btn-move-up"<?php echo $btn['moveEffect'] == 'thz-btn-move-up' ? ' selected="selected"': ''; ?>>Up</option>
                                    <option value="thz-btn-move-down"<?php echo $btn['moveEffect'] == 'thz-btn-move-down' ? ' selected="selected"': ''; ?>>Down</option>
                                </select>
                            </div>  
                            <div class="thz-btn-gen-option">
                                <label for="<?php echo esc_attr($oid)?>shadowShow">
                                    <?php echo esc_html__('Shadow on hover:','creatus'); ?>
                                </label>
                                <select id="<?php echo esc_attr($oid)?>shadowShow" class="thz-btn-gen-select shadowShow" data-css-hook="shadowShow">
                                    <option value="none"<?php echo $btn['shadowShow'] == 'always' ? ' selected="selected"': ''; ?>>Always shown</option>
                                    <option value="thz-btn-sh-ishidden"<?php echo $btn['shadowShow'] == 'thz-btn-sh-ishidden' ? ' selected="selected"': ''; ?>>Shows on hover</option>
                                    <option value="thz-btn-sh-hide"<?php echo $btn['shadowShow'] == 'thz-btn-sh-hide' ? ' selected="selected"': ''; ?>>Hides on hover</option>
                                </select>
                            </div> 
                        </div>
					</div>
					<div class="thz-tab notactive-tab" data-tab="elementstyle-styles" data-tabs-group="options">
						<div class="customButtonStyles" data-names="<?php echo to_spc($buttons_names) ?>">
							<div class="thz-add-button-holder">
								<a href="#" class="thz-add-button button button-primary"><?php echo esc_html__('Add current button to styles','creatus'); ?></a>
							</div>
							<?php 

								foreach ($custombuttons as $key => $btn){
									
								$customBtnHtml = $btn['html'];
								$customBtnCss  = to_spc ( str_replace('.'.$key,'.customButtonStyles .'.$key,$btn['css']));
								$customBtnJson = to_spc ( $btn['json'] );
								
								$removable ='';
								
								if(in_array($key,$split_names['user'])){
									$removable ='<span class="thz-remove-btn dashicons fw-x" data-name="'.$key.'"></span>';
								}
												
							?>
							<div class="thz-btn-custom-holder" data-metrics="<?php echo $customBtnJson ?>" data-btn-css="<?php echo $customBtnCss ?>">
								<?php echo $removable.$customBtnHtml ?>
							</div>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="fw-clear"></div>
		<?php
		
			echo fw()->backend->option_type( 'textarea' )->render(
				'html',
				array(
					'value' => fw_akg('html',$option['value']),
					'attr' => array (
						'class' => 'thz-button-html-print',
						'readonly' =>'readonly'
					)
				),
				array(
					'value' => fw_akg('html',$data['value']),
					'id_prefix' => $option['attr']['id'] ,
					'name_prefix' => $option['attr']['name'] ,
				)
			);	
		?>
		<?php
			echo fw()->backend->option_type( 'textarea' )->render(
				'css',
				array(
					'value' => fw_akg('css',$option['value']),
					'attr' => array (
						'class' => 'thz-button-css-print',
						'readonly' =>'readonly'
					)
				),
				array(
					'value' => fw_akg('css',$data['value']),
					'id_prefix' => $option['attr']['id'] ,
					'name_prefix' => $option['attr']['name'] ,
				)
			);	
		?>
		<?php
			echo fw()->backend->option_type( 'textarea' )->render(
				'json',
				array(
					'value' => fw_akg('json',$option['value']),
					'attr' => array (
						'class' => 'thz-button-json-print',
						'readonly' =>'readonly'
					)
				),
				array(
					'value' => fw_akg('json',$data['value']),
					'id_prefix' => $option['attr']['id'] ,
					'name_prefix' => $option['attr']['name'] ,
				)
			);	
		?>
	</div>
</div>