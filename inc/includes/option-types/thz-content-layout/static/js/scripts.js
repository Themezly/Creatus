(function($,fwe){

	function layoutAutocomplete ($element){

			$element.autocomplete({
				minLength: 2,
				source: function( request, response ) {
	
					$.ajax({
						url: ajaxurl,
						dataType: "json",
						data: {
							action: 'thz_action_get_ajax_posts',
							searchTerm: request.term,
							thz_cl_nonce:thzlayout_vars.thz_cl_nonce
						},
						type: 'POST',
						success: function( data ) {
	
							$(this).removeClass('ui-autocomplete-loading');
							if (data.success === false || typeof data.data === 'undefined') {
								return false;
							}
	
							if (data.data.length === 0) {
								response({
									label: thzlayout_vars.noMatchesFoundMsg
								});
							} else {
								response( $.map( data.data, function( val, index) {
	
								return {
									label: val,
									value: val,
									id: index,
								}
							}));
							}
						},
						error: function (e) {
							$(this).removeClass('ui-autocomplete-loading');
							return false;
						}
					});
				},
	
				select: function( event, ui ) {
					
					var newValue = ui.item.id;
					$( this ).attr('data-item-info',newValue);
					$element.autocomplete("destroy");
					layoutAutocomplete($element);	
					
				},
				open: function() {
					$( this ).data("uiAutocomplete").menu.element.addClass("thz-content-layout-autocomplete-menu");
	
				},
				close: function() {
					$( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
				}
			});	
		
	}


	jQuery(document).ready(function ($) {
		
		function thzCreateLayoutLink ($data_page,$data_layout,$data_leftblock,$data_contentblock,$data_rightblock,$title,$newone){
	
			
			if($newone){
				$newLayout = $('<div/>', {
					class: 'thz-assign-new-layout-wrapper',
				}).prependTo($add_layouts_box);
			}else{
				$newLayout = $('<div/>', {
					class: 'thz-assign-new-layout-wrapper',
				}).appendTo($add_layouts_box);				
			}
	
			$main_parent = $newLayout.parent().parent();
			$('<a/>', {
				class: 'thz-assign-new-layout',
				'data-page': $data_page,
				'data-layout': $data_layout,
				'data-leftblock': $data_leftblock,
				'data-contentblock': $data_contentblock,
				'data-rightblock': $data_rightblock,
				'data-title': $title,
				'href':'#',
				text: $title,
				click: function(e) {
					e.preventDefault();
					
					$add_layout_button.removeClass('hide_action_button');
					$(this).parent().siblings().removeClass('selected_layout');

					$leftblock_width.val($(this).attr('data-leftblock'));
					$contentblock_width.val($(this).attr('data-contentblock'));
					$rightblock_width.val($(this).attr('data-rightblock'));
					$layout_type_list.val($(this).attr('data-layout')).trigger('change');
					
					$(this).parent().addClass('selected_layout');
					$update_layout_button.addClass('hide_action_button');
					
				}
			}).appendTo($newLayout);
			
			
			$('<span/>', {
				class: 'remove-layout dashicons fw-x',
				click: function(e) {
					e.preventDefault();
					
					var $layouts_input			= $main_parent.find('.thz-content-layout-input');
					var $layouts_input_value 	= JSON.parse($layouts_input.val());
					var $data_option_value 		= $(this).parent().find('a').attr('data-page');
					var $pages_list 			= $main_parent.find('.thz-content-layout-dropdown select');
	
					$pages_list.find("option[value='"+$data_option_value+"']").prop("disabled",false);
								
								
					var $new_input_val = $.grep($layouts_input_value, function(data, index) {
						return data.page != $data_option_value;
					});
					
					$layouts_input.val(JSON.stringify($new_input_val));
					
					$(this).parent().remove();
					
					$update_layout_button.addClass('hide_action_button');
					$add_layout_button.removeClass('hide_action_button');
					
				}
			}).appendTo($newLayout);
			
			
			
			
			$('<span/>', {
				class: 'activate-edit-layout dashicons dashicons-edit',
				click: function(e) {
					
					e.preventDefault();
					$update_layout_button.text( thzlayout_vars.updatingLayoutButton + $title )
					.removeClass('hide_action_button');
					$add_layout_button.addClass('hide_action_button');
					
				}
			}).appendTo($newLayout);
			
			
			
	
		}
		
		function thzSpinnerWidths (){
			
			
			var sum = 0;
			var is_warend = false;
			var element = $('.thz-content-layout-spinners-holder .thz-multi-holding-spinner:visible').find('.fw-option-type-thz-spinner');
			element.each(function() {
				if (!isNaN(this.value) && this.value.length != 0 && !is_warend) {
					sum += parseFloat(this.value);
				}
			});
			
			if( sum > 100 && !is_warend){
				
				element.animate({
					'background-color':'#E74C3C',
					'color':'#ffffff'
				},100,function(){
					
					is_warend = true;
					
				});
				
			}else if(sum < 100 && !is_warend){
				
				element.animate({
					'background-color':'#fff993',
					'color':'#837e2d'
				},100,function(){
					
					is_warend = true;
					
				});			
				
			}else{
				
				element.animate({
					'background-color': '#ffffff',
					'color':'#454545'
				},100,function(){
					
					is_warend = false;
					
				});					
				
			}
			
		}
		
		function updateLayout(jsonObj, page, newLayout,newLeftblock,newContentblock,newRightblock) {

		 
		 for (var i=0; i<jsonObj.length; i++) {
			if (jsonObj[i].page === page) {
			  jsonObj[i].layout = newLayout;
			  jsonObj[i].leftblock = newLeftblock;
			  jsonObj[i].contentblock = newContentblock;
			  jsonObj[i].rightblock = newRightblock;
			}
		  }
		  
		  return jsonObj;
		}
		
		
		
		function thzShowMsg ($flashinfo_box,$msg){
			
			$flashinfo_box.html('<span>' +$msg +'</span>')
			.fadeIn(200).fadeOut(200).fadeIn(200).delay(3000).fadeOut(200,function(){
				$(this).html('');
			});			
			
		}
		
				
		fwEvents.on('fw:options:init', function (data) {
	
			var obj = data.$elements.find('.fw-option-type-thz-content-layout:not(.thz-option-initialized)');

			obj.each(function () {

					
					var $this				= $(this);
					$add_layout_button  	= $this.find('.add-layout');
					$update_layout_button	= $this.find('.update-layout');
					$add_layouts_box 		= $this.find('.thz-content-layout-layoutsbox');
					$pages_list 			= $this.find('.thz-content-layout-dropdown select');
					$layout_type_list 		= $this.find('.thz-content-layout-layouts select');
					$layouts_input			= $this.find('.thz-content-layout-input');
					$leftblock_width		= $this.find('.thz-content-layout-leftblock-parent input');
					$contentblock_width		= $this.find('.thz-content-layout-contentblock-parent input');
					$rightblock_width		= $this.find('.thz-content-layout-rightblock-parent input');
					$content_spinners		= $this.find('.fw-option-type-thz-spinner');
					$specific_list			= $this.find('.thz-content-layout-specific');
					$typechoice				= $this.find('.thz-content-layout-typechoice :radio');
					$flashinfo_box			= $this.find('.thz-content-layout-flashinfo');
					$layouts_holder			= $this.find('.thz-content-layout-spinners-holder');
					 
					layoutAutocomplete ($specific_list);	
	
					// on add layout
					$add_layout_button.on('click',function(e){
						
						e.preventDefault();
						var $data_page 				= $pages_list.val();
						var $data_layout 			= $layout_type_list.val();
						var $data_leftblock			= $leftblock_width.val();
						var $data_contentblock		= $contentblock_width.val();
						var $data_rightblock		= $rightblock_width.val();
						var $data_title				= $pages_list.find('option:selected').text();
						var $typechoice_val			= $typechoice.filter(':checked').val();
						$specific_list.removeClass('higlight_specific');
						
						if($specific_list.length && $specific_list.val() !==''){
							$data_page 	= $specific_list.attr('data-item-info');
							$data_title	= $specific_list.val();
						}
						
						
						if($add_layouts_box.find('[data-page="'+$data_page+'"]').length > 0 || $data_page == ''){
							
							// add info that the layout for that page exists
							thzShowMsg ($flashinfo_box,thzlayout_vars.layoutExists1 + $data_title + thzlayout_vars.layoutExists2);
							$specific_list.val('');
							return;	
						}
						
						if($typechoice_val	== 'specific' && $specific_list.val() ==''){
							$specific_list.addClass('higlight_specific');
							return;
						}
								
						
						var $layouts_input_value 	= JSON.parse($layouts_input.val());
						
						$layouts_input_value.unshift({
								
								title		:$data_title,
								page		:$data_page, 
								layout		:$data_layout,
								leftblock	:$data_leftblock,
								contentblock:$data_contentblock,
								rightblock	:$data_rightblock,
								
						});
		
						
						thzCreateLayoutLink($data_page,$data_layout,$data_leftblock,$data_contentblock,$data_rightblock,$data_title,true);
		
						$layouts_input.val(JSON.stringify($layouts_input_value));
						
	
						$pages_list.find('option:selected').attr("disabled","disabled").removeAttr('selected');
						$pages_list.find('option:enabled:first').prop("disabled",false).prop("selected", true);
						$specific_list.val('');

					});
					
					
					// on update layout
					$update_layout_button.on('click',function(e){
						
						e.preventDefault();
						
						var $selected_layout		= $this.find('.selected_layout .thz-assign-new-layout');
						var $data_title				= $selected_layout.attr('data-title');
						var $data_page 				= $selected_layout.attr('data-page');
						var $data_layout 			= $layout_type_list.val();
						var $data_leftblock			= $leftblock_width.val();
						var $data_contentblock		= $contentblock_width.val();
						var $data_rightblock		= $rightblock_width.val();
						
						$selected_layout.attr('data-layout',$data_layout);
						$selected_layout.attr('data-leftblock',$data_leftblock);
						$selected_layout.attr('data-contentblock',$data_contentblock);
						$selected_layout.attr('data-rightblock',$data_rightblock);
						
						var $current_value = JSON.parse($layouts_input.val());
						
						var $updated_value = updateLayout($current_value,$data_page,$data_layout,$data_leftblock,$data_contentblock,$data_rightblock);
		
						$layouts_input.val(JSON.stringify($updated_value));
						
						thzShowMsg ($flashinfo_box,thzlayout_vars.updatingLayout1 + $data_title + thzlayout_vars.updatingLayout2 );
						
						$(this).addClass('hide_action_button'); 
						$add_layout_button.removeClass('hide_action_button');		
									
					});
					

					
					var $current_layouts = JSON.parse($layouts_input.val()) ;
					
					if($current_layouts !=="undefined"){
						$.each($current_layouts, function( index, $data ) {
		
								
								var $this_title 		= $data.title;
								var $this_page 			= $data.page;
								var $this_layout 		= $data.layout;
								var $this_leftblock 	= $data.leftblock;
								var $this_contentblock 	= $data.contentblock;	
								var $this_rightblock 	= $data.rightblock;
																
								
								$pages_list.val($this_page);
								$leftblock_width.val($this_leftblock);
								$contentblock_width.val($this_contentblock );
								$rightblock_width.val($this_rightblock);
								
								thzCreateLayoutLink ($this_page,$this_layout,$this_leftblock,$this_contentblock,$this_rightblock,$this_title);
	
								
								$pages_list.find("option[value='"+$this_page+"']").attr("disabled","disabled").removeAttr('selected');
								$pages_list.find('option:enabled:first').prop("disabled",false).prop("selected", true);
								
						});
					}
					
					
					
					$layout_type_list.on('change',function (){
						
						var $current_layout = $(this).val();
						$layouts_holder.removeClass('left right full left_content_right left_right_content content_left_right').addClass($current_layout);

						thzSpinnerWidths();
	
					});
					
					
					// sorting
					$add_layouts_box.sortable({
						stop: function( event, ui ) {
							
							var $sorder = [];
							var $orderObject = {};
							
							$(this).find('a.thz-assign-new-layout').each(function(index, element) {
								
								var $order_title = $(this).attr('data-title');
								$sorder.push($order_title);
								
							});
					
							$sorder.forEach(function (a, i) {
								$orderObject[a] = i;
							});
							
							var $current = JSON.parse($layouts_input.val());
							var $new_order = $current.sort(function (a, b) {
								return $orderObject[a.title] - $orderObject[b.title];
							});
							$layouts_input.val(JSON.stringify($new_order));	
							$sorder = [];
					
						}
					});
					
					
					$content_spinners.on('keydown keyup change',function (){
						thzSpinnerWidths();
					});	
					
					// on load values 
					
					$add_layouts_box.find('.thz-assign-new-layout:first').trigger('click');
					
					if($add_layouts_box.find('.thz-assign-new-layout').length < 1){
						
						$leftblock_width.val(22.5);
						$contentblock_width.val(55);
						$rightblock_width.val(22.5);
						$layout_type_list.val('left_content_right').change();					
						
					}
					

					$typechoice.on('change', function (e) {
		
						var $value 		= $(this).filter(':checked').val();
						var $grouped	= $this.find('.thz-content-layout-assignto-holder');
						var $specific 	= $this.find('.thz-content-layout-specific-holder');
						
						if ($value === 'grouped'){
							
							
							$specific.hide();
							$grouped.show();
					
						}else{
							
							
							$grouped.hide();
							$specific.show();
						}
						
					});				
					
					
					$specific_list.on('blur', function(){
						
					   $(this).removeClass('higlight_specific');
					   
					}).on('focus', function(){
						
					  $(this).removeClass('higlight_specific');
					  
					});				
					
					obj.addClass('thz-option-initialized');
			});
			
				
		});
	});

})(jQuery,fwEvents);