/**
 * @package      Thz Framework
 * @author       Themezly
 * @license      http://opensource.org/licenses/MIT
 * @websites     http://www.themezly.com | http://www.youjoomla.com | http://www.yjsimplegrid.com
 */
(function($, fwe) {
	
	
	function triggerRadios (el) {
		
			var $this = el;

			var loadTemplate = function (groupId,callback){
				
				$choicesToReveal = $this.find(groupId);
				
				
				if ($choicesToReveal.attr('data-options-template')) {
					$choicesToReveal.html(
						$choicesToReveal.attr('data-options-template')
					);

					$choicesToReveal.removeAttr('data-options-template');

					fwEvents.trigger('fw:options:init', {
						$elements: $choicesToReveal
					});
				}	
				
			};
			
			var checkSize = function (){
				
				$this.find('.thz-background-size-radio :radio').on('change', function (e) {
						
					var $value 		= $this.find(".thz-background-size-radio :radio:checked").val();
					var $size 		= $this.find('.thz-background-size-text');
					var $sizeinput 	= $size.find('.fw-option-type-text');
					
					if ($value === 'custom'){
						
						$size.show();

					}else{
						
						$size.hide();
						$sizeinput.val($value);
					}
					
				}).trigger('change');				
				
			};
			
			
			$this.find('.thz-background-type .fw-option-type-thz-radio :radio').on('change', function (e) {

				
				var $color 		= $(this).closest('.fw-inner').find('.thz-group-color');
				var $image 		= $(this).closest('.fw-inner').find('.thz-group-image');
				var $video 		= $(this).closest('.fw-inner').find('.thz-group-video');	
				var $gradient 	= $(this).closest('.fw-inner').find('.thz-group-gradient');
				var $shape 		= $(this).closest('.fw-inner').find('.thz-group-shape');	
				
				var $value = $(this).filter(':checked').val();
				
/*				if( $this.parents('.thz-boxstyle-element-holder').length ){
					
					$this.parents('.thz-boxstyle-holder')
					.removeClass('is-open-none is-open-undefined is-open-color is-open-image is-open-color is-open-video is-open-gradient is-open-shape')	
					.addClass('is-open-' + $value);
					
				}*/
				
				
				if ($value === 'color'){
					

					loadTemplate('.thz-template-color');
					
					$image.hide();
					$video.hide();
					$gradient.hide();
					$shape.hide();
					$color.show();			
				}
				
				if ($value === 'image'){
					
					
					loadTemplate('.thz-template-color');
					loadTemplate('.thz-template-image');
					checkSize();
					
					$video.hide();
					$gradient.hide();
					$shape.hide();
					$color.show();
					$image.show();	
						
				}
				
				if ($value === 'video'){
					
					loadTemplate('.thz-template-color');
					loadTemplate('.thz-template-video');
					$color.hide();
					$image.hide();
					$gradient.hide();
					$shape.hide();		
					$video.show();
				
				}
				
				
				if ($value === 'gradient'){

					loadTemplate('.thz-template-gradient');
					$color.hide();
					$image.hide();
					$video.hide();
					$shape.hide();
					$gradient.show();
					gradient($this);

				}
				
				
				if ($value === 'shape'){

					loadTemplate('.thz-template-shape');
					$color.hide();
					$image.hide();
					$video.hide();
					$gradient.hide();
					$shape.show();
					shape($this);

				}
				
				if ($value === 'none'){
					
					$video.hide();
					$color.hide();
					$image.hide();	
					$gradient.hide();
					$shape.hide();		
				}	

			}).trigger('change');
			
			
			checkSize();
			
			
	};
	
	
	
	
	function gradient(el){
		
			var $this = el;
				
			if($this.find('.thz-bg-gradient-preview').length){
				
				gradientPreview($this);
			}				
				
			$this.find('.thz-background-gradient-style :radio').on('change', function (e) {
					
				var $value 		= $this.find(".thz-background-gradient-style :radio:checked").val();
				
				if ($value === 'linear'){
					
					$this.find('.gradient-group-linear.thz-bg-gradient-element').show();
					$this.find('.gradient-group-radial.thz-bg-gradient-element').hide();

				}else{
					
					$this.find('.gradient-group-radial.thz-bg-gradient-element').show();
					$this.find('.gradient-group-linear.thz-bg-gradient-element').hide();
				}
				

			}).trigger('change');
		
	};
	
	
	function gradientValues (el){
		
		var $this = el;
		var data = $this.find('.thz-background-gradient :input').serializeArray();
		return data;
	}
	
	function gradientPreview(el){
		
		var $this = el;
		
		$(document).on('change keyup fw:thz:color:picker:changed thzslider click', 
		'.thz-background-gradient :input,.td-remove a' ,function(event){
	
			var data = gradientValues($this);
			gradientCSS(data,$this);
			
		});
		
	}

	function dataObject(data,gradient){
		
			var properties = {};
			var stops = {};
			var stopsArray= [];
			
			$.each(data,function(index, oldName) {
	
				var thisValue = oldName.value;

				var re = /\[([^\]]*)\]$/g; 
				var str = oldName.name;
					
				if ((m = re.exec(str)) !== null) {
				   newName = m[1];
				}

				if(gradient && oldName.name.indexOf('gradient-add-stop') > -1){
					
					var stopName = oldName.name.replace(/[\[\]']+/g,'');
					
					
					stops[stopName] = thisValue;
				}
				
				properties[newName] = thisValue;
		
	
			});	

			Object.keys(stops).forEach(function(key) {
			  var num= key.match(/(\d+)/)[0] - 1;
			  stopsArray[num] = stopsArray[num] || {};
			  stopsArray[num][key.replace(num+1,'')]= stops[key];
			});
			
			if(gradient){
				properties['gradient-add-stop'] = stopsArray;
			}
			

		return properties;
	}

	 function gradientCSS(data,element){
		 
			$array					= dataObject(data, true);
			
			$gradient_style 		= $array['gradient-style'];
			
			$angle					= parseInt($array['gradient-angle']);
			$gradient_angle 		= ( -1 * $angle ) +'deg,';
			$w3c_angle 				= ($angle - 90 < 360 ? $angle + 90: 90) +'deg,';
			
			$gradient_size		 	= $array['gradient-size'];
			$gradient_shape		 	= $array['gradient-shape'];
			$gradient_h_poz		 	= $array['gradient-h-poz'];
			$gradient_v_poz		 	= $array['gradient-v-poz'];
			
			$gradient_start 		= $array['gradient-start'];
			$gradient_start_color 	= $array['gradient-start-color'];
			$gradient_add_stop 		= $array['gradient-add-stop'];
			$gradient_end 			= $array['gradient-end'];
			$gradient_end_color	 	= $array['gradient-end-color'];
			$custom_stop			= '';
			

			
			if($gradient_start_color == '' || $gradient_end_color =='') return;
			
			
			if($.isArray($gradient_add_stop) && $gradient_add_stop !=''){
				
				$custom_stop = [];
				
				$.each($gradient_add_stop,function ($key,$customstop){
					
					if($customstop == undefined) return;
					
					var start = Object.keys($customstop)[0];
					var color = Object.keys($customstop)[1];
					
					$custom_stop.push($customstop[color]+' '+$customstop[start]+'%');
					
				});
				
			};
			

			if($custom_stop != undefined  && $.isArray($custom_stop)){
				
				$custom_stop = ' '+$custom_stop.join(',')+',';
				
			}

			
			if($gradient_style == 'radial'){

				$gradient_angle =''+$gradient_h_poz+'% '+$gradient_v_poz+'%,'+$gradient_shape+' '+$gradient_size+','; 
				$w3c_angle 		=''+$gradient_shape+' '+$gradient_size+' at '+$gradient_h_poz+'% '+$gradient_v_poz+'%,';
			}


			$gradient 		= ''+$gradient_angle+$gradient_start_color+' '+$gradient_start+'%,'+$custom_stop+$gradient_end_color+' '+$gradient_end+'%';
			$w3cgradient 	= ''+$w3c_angle+$gradient_start_color+' '+$gradient_start+'%,'+$custom_stop+$gradient_end_color+' '+$gradient_end+'%';

			$background ='background: '+$gradient_start_color+';';
			$background +='background: -moz-'+$gradient_style+'-gradient('+$gradient+');';
			$background +='background: -webkit-'+$gradient_style+'-gradient('+$gradient+');';
			$background +='background: -o-'+$gradient_style+'-gradient('+$gradient+');';
			$background +='background: -ms-'+$gradient_style+'-gradient('+$gradient+');';
			$background +='background: '+$gradient_style+'-gradient('+$w3cgradient+');';
			
			$background = thz.thz_replace_palette_colors($background); 
			element.find('.thz-bg-gradient-preview').attr('style',$background);
			element.find('.thz-background-gradient').trigger('thzgradient');
			
	}

	var uploads = function(el) {
		
		var $this = el;
		
		var $select_button 	= $this.find('.upload-video');
		var $input 			= $this.find('.video-input');
		var $thumb			= $this.find('.thz-thumb img');				
		var thz_videos_frame;
		
		var thzMakeVideoFrame = function (){
			
			thz_videos_frame = wp.media.frames.thz_videos_frame = wp.media({
	
				className: 'media-frame thz-videos-frame',
				frame: 'select',
				multiple: false,
				title: thz_image.title,
				library: {
					type: 'video/mp4,video/ogg,video/webm'
				}

			});

			thz_videos_frame.on('open', function() {
				var selection = thz_videos_frame.state().get('selection'),
					attatchmentId = $this.find('.video-input').attr('data-videoid'),
					attachment = wp.media.attachment(attatchmentId);

				thz_videos_frame.reset();
				if (attachment.id) {
					selection.add(attachment);
				}
			});
			
			thz_videos_frame.on('select', function(){
				var media_attachment = thz_videos_frame.state().get('selection').first().toJSON();
				$this.find('.video-input').val(media_attachment.url).attr('data-videoid',media_attachment.id).trigger('change');

			});			
			
		};
		
		$this.on('click','.upload-video', function(e) {

			e.preventDefault();
			if (!thz_videos_frame) {
				thzMakeVideoFrame();
			}
			thz_videos_frame.open();

		});	

		
	};	
	
	
	function shapeValues (el){
		
		var $this = el;
		var data = $this.find('.thz-background-shape :input').serializeArray();
		
		return data;
	}
	
	function shapePreview(el){
		
		var $this = el;
		
		$(document).on('change keyup fw:thz:color:picker:changed','.thz-background-shape :input' ,function(event){
	
			var data = shapeValues($this);
			shapeCSS(data,$this);
			
		});
		
	}
	
	
	
	function shape(el){
		
		var $this = el;
			
		if($this.find('.thz-bg-shape-preview').length){
			
			shapePreview($this);
			
			$this.find('.thz-background-shape select:first-of-type').trigger('change');	
		}	
		
		
				
	};
	
	function shapeCSS(data,element){
		
		$array	= dataObject(data);
		
		if (data[0]['name'].indexOf('value_data') > -1) {
			
			$array = JSON.parse(data[0]['value']);
			
		}
		
		$shape 		= $array['s'];
		$position 	= $array['p'];
		$flip 		= $array['f'];
		$fill 		= $array['c'];
		$background = $array['b'];
		$width 		= $array['w'];
		$height 	= $array['h'];
		
		
		
		element.find('.thz-shape-bglayer svg').removeClass('current').removeAttr('style');
		element.find('.thz-svg-' + $shape).addClass('current');
		
		
		element.find('.thz-shape-bglayer').removeClass('top center bottom flip').addClass($position);
		
		if($flip == 'yes'){
			
			element.find('.thz-shape-bglayer').addClass('flip');
		}
		
		if($background !='' ){
			$preview_style = 'background-color:'+$background+';';
			$preview_style = thz.thz_replace_palette_colors($preview_style); 
			element.find('.thz-bg-shape-preview').attr('style',$preview_style);
			
		}else{
			
			element.find('.thz-bg-shape-preview').removeAttr('style');
		}
		
		
		$svg_style = '';
		
		if($width > 100 ){
			$svg_style += 'width:'+$width+'%;';
		}
		
		if($height > 0 ){
			$svg_style += 'height:'+$height+'px;';
		}
		
		if($fill !='' ){
			
			if( $shape.indexOf('-stroke') !== -1 ){
				
				$svg_style += 'stroke:'+$fill+';';
				
			}else{
			
				$svg_style += 'fill:'+$fill+';';
			
			}
		
		}
		
		$svg_style = thz.thz_replace_palette_colors($svg_style); 
		
		
		if($svg_style !='' ){
			
			element.find('.thz-bg-shape-preview svg.current').attr('style',$svg_style);
			
		}else{
			
			element.find('.thz-bg-shape-preview svg.current').removeAttr('style');
		}
		

	}
	
	fwEvents.on('fw:options:init', function (data) {
		data.$elements.find('.fw-option-type-thz-background:not(.thz-option-initialized)').each( function (){
				
				triggerRadios($(this));
				uploads($(this) );
				

		}).addClass('thz-option-initialized');
			
	});
	

})(jQuery, fwEvents);