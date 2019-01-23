(function ($, fwe, _, localized) {
	$(document.body).on('fw:option-type:builder:init', function(e, data) {
		if (data.type !== 'page-builder') {
			return;
		}

		var prefix = 'thz-theme-';
		var inst = {
			$el: {
				builder: $(e.target),
				tooltipContent: $('<div class="'+ prefix +'pred-tpl-tooltip-content"></div>'),
				tooltipLoading: $(
					'<div class="'+ prefix +'pred-tpl-tooltip-loading">'+
					/**/'<div class="loading-icon fa-spin thzicon thzicon-spinner10"></div>'+
					'</div>'
				),
				headerTools: data.$headerTools
			},
			builder: data.builder,
			isBusy: false,
			tooltipLoading: {
				show: function() {
					inst.$el.tooltipContent.prepend(inst.$el.tooltipLoading);
				},
				hide: function() {
					inst.$el.tooltipLoading.detach();
					inst.$el.tooltipContent.removeClass('show-content');
				}
			},
			tooltipApi: null, // initialized below
			refresh: function() {
				if (this.isBusy) {
					console.log('Working... Try again later');
					return;
				} else {
					this.isBusy = true;
					this.tooltipLoading.show();
				}

				$.ajax({
					type: 'post',
					dataType: 'json',
					url: ajaxurl,
					data: {
						'action': prefix +'builder-templates-render'
					}
				})
				.done(_.bind(function(json){
					this.isBusy = false;
					this.tooltipLoading.hide();

					if (!json.success) {
						console.error('Failed to render builder templates', json);
						return;
					}

					this.$el.tooltipContent
						.html(json.data.html)
						.trigger('fw:option-type:page-builder:'+ prefix +'pred-tpl:after-html-replace');
				}, this))
				.fail(_.bind(function(xhr, status, error){
					this.isBusy = false;
					this.tooltipLoading.hide();

					fw.soleModal.show(
						prefix +'templates-error',
						'<h4>Ajax Error</h4><p class="fw-text-danger">'+ String(error) +'</p>',
						{showCloseButton: false}
					);
				}, this));
			},
			load: function (id,cats) {
				
				var self = this;
				
				if (this.isBusy) {
					console.log('Working... Try again later');
					return;
				} else {
					this.isBusy = true;
					this.tooltipLoading.show();
				}
				
				var categories = JSON.parse(cats);
				
				$.ajax({
					type: 'post',
					dataType: 'json',
					url: ajaxurl,
					data: {
						'action': prefix +'builder-templates-load',
						id: id
					}
				})
				.done(_.bind(function(r){
					this.isBusy = false;
					//this.tooltipLoading.hide();

					if (!r.success) {
						console.error('Failed to load template', r);
						return;
					}

					if(categories.hasOwnProperty('pages')){
						
						var builder_json 	= JSON.parse(r.data.json);
						var page_json 		= builder_json[0].pagejson;
						var page_template 	= page_json.page_template;
						
						delete builder_json[0].pagejson;
						delete page_json.page_template;
						
						self.ThzFillTemplate( page_json );
						
						this.builder.rootItems.reset( builder_json );
						
						$('#page_template').val( page_template ).trigger('change');
						$('#fw-option-pcss').trigger('change');
						
					}else{
						
						this.builder.rootItems.add(JSON.parse(r.data.json));
					}
					
					this.tooltipApi.hide();
					
				}, this))
				.fail(_.bind(function(xhr, status, error){
					this.isBusy = false;
					this.tooltipLoading.hide();

					fw.soleModal.show(
						prefix +'templates-error',
						'<h4>Ajax Error</h4><p class="fw-text-danger">'+ String(error) +'</p>',
						{showCloseButton: false}
					);
				}, this));
			},
			
			force_update: function () {
				
				var self = this;
				
				$.ajax({
					type: 'post',
					dataType: 'json',
					url: ajaxurl,
					data: {
						'action': prefix +'builder-templates-update',
					}
				})
				.done(_.bind(function(r){
					
					this.isBusy = false;
					
					if (!r.success) {
						console.error('Failed to refresh library', r);
						return;
					}
					
					self.refresh();

				}, this))
				.fail(_.bind(function(xhr, status, error){
					this.isBusy = false;
					this.tooltipLoading.hide();

					fw.soleModal.show(
						prefix +'templates-error',
						'<h4>Ajax Error</h4><p class="fw-text-danger">'+ String(error) +'</p>',
						{showCloseButton: false}
					);
				}, this));
			},

			ThzFillTemplate: function($data) {
	
				var self = this;

				if($('#fw-options-box-page_options_box').length < 1){
					return;
				}
	
				var $options = $data;

				$('.thz-page-options-container .items-wrapper,#fw-option-pcss .items-wrapper').find('.delete-item').trigger('click');
				
				$.each($options, function(id, json) {
	
					var $split = id.split('-');
					var $realinput = $split[2];
					var $option = $('div#fw-backend-option-fw-option-' + $realinput);
					var $dataforjs = JSON.parse($option.find('.fw-option-type-addable-popup').attr('data-for-js'));
					var $params = JSON.parse($dataforjs.join('{{'));
					var title = $params.template;
	
					if ($realinput == 'custom_pagetitle_options') {
	
						var $seto_opt = JSON.parse(json);
						title = 'Page title mode is: <b>' + $seto_opt.page_title_metrics.mode + '</b>';
	
					}
	
					if ($realinput == 'hero') {
	
						var $seto_opt = JSON.parse(json);
						title = 'Hero section is: <b>' + $seto_opt.disable + '</b>';
	
					}
	
					if ($realinput == 'custom_footer_options') {
	
						var $seto_opt = JSON.parse(json);
						var $footer_txt = 'Footer and widgets sections';
						if($seto_opt.footer_mx.m == 'both'){
							
							$footer_txt ='Only footer';
							
						}else if($seto_opt.footer_mx.m == 'widgets'){
							
							$footer_txt ='Only widgets sections';
							
						}else if($seto_opt.footer_mx.m == 'hidden'){
							
							$footer_txt ='Hidden';
							
						}
						
						title = 'Custom footer options are active and display mode is: <b>' + $footer_txt + '</b>';
	
					}
					
					var new_item = self.ThzNewItemTemplate(id, $realinput, title);
	
					$option.find('.items-wrapper').html(new_item).show({
						duration: 0,
						done: function() {
	
							$('#' + id).attr('value', json);
							$option.find('.add-new-item').hide();
	
						}
					});
	
	
				});
	
			},	
			
			ThzNewItemTemplate: function(id, name, title) {
	
				var self = this;
	
				var new_item = '<div class="item">';
				new_item += '<div class="input-wrapper">';
				new_item += '<input name="fw_options[' + name + '][]" id="' + id + '" class="fw-option fw-option-type-hidden" value="" type="hidden">';
				new_item += '</div>';
				new_item += '<div class="content">' + title + '</div>';
				new_item += '<a href="#" class="dashicons fw-x delete-item"></a>';
				new_item += '</div>';
	
	
				return new_item;
			},
					
		};

		inst.$el.headerTools
			.removeClass('fw-hidden')
			.append(
				'<div class="'+ prefix +'pred-tpl-add-btn-wrap fw-pull-right">' +
				/**/'<a class="tpl-btn" href="#" onclick="return false;"><span title="'+ localized.l10n.add_button +'"></span></a>' +
				'</div>'
			);
		
		
		
		inst.tooltipApi = inst.$el.headerTools
			.find('.'+ prefix +'pred-tpl-add-btn-wrap .tpl-btn')
			.qtip({
				show: 'click',
				hide: 'unfocus',
				position: {
					at: 'center',
					my: 'center',
					viewport: $(window),
					target: $(window) // my target
				},
				events: {
					show: function () {
						
						inst.refresh();
						
					},
					hide: function(event, api) {
						
						inst.$el.tooltipContent.html('');
					}
				},
				style: {
					classes: 'qtip-fw qtip-fw-builder '+ prefix +'pred-tpl-qtip',
				},
				content: {
					text: inst.$el.tooltipContent
				}
			})
			.qtip('api');



						
		inst.$el.tooltipContent.on('fw:option-type:page-builder:'+ prefix +'pred-tpl:after-html-replace', function (e) {
				
				var $this = $(this);
				
				setTimeout(function(){
					$this.addClass('show-content');
				},50);
				
				
			$('.'+ prefix +'pred-tpl-cat li a').each(function(index, element) {
				
					var $cat = $(element).attr('data-val');
					
					if ($cat.length) {
						var $count = $('.thz-theme-pred-tpl-item-img.' + $cat).length;
						$(element).find('.'+ prefix +'items-count').text($count);
					}
					
				
			});
		});	
		
		
		inst.$el.tooltipContent
			.on('click', '.'+ prefix +'pred-tpl-cat li a', function (e) {
				e.preventDefault();
				
				$('.'+ prefix +'pred-tpl-cat li a').removeClass('active');
				$(this).addClass('active');
				
				var cat = $(this).attr('data-val'),
					$thumbs = inst.$el.tooltipContent.find('.'+ prefix +'pred-tpl-thumb-list .'+ prefix +'pred-tpl-thumb');

				if (!cat.length) { // show all
					$thumbs.removeClass('fw-hidden');
				} else { // show one category
					$thumbs.each(function(){
						var $thumb = $(this),
							categs = JSON.parse($thumb.attr('data-categs'));

						$thumb[ (typeof categs[cat] === 'undefined') ? 'addClass' : 'removeClass' ]('fw-hidden');
					});
				}
			})
			.on('click', '.'+ prefix +'pred-tpl-thumb-list .'+ prefix +'pred-tpl-thumb .'+ prefix +'pred-tpl-item-img > img', function (e) {
				
				var $thumb_item = $(this).closest('.'+ prefix +'pred-tpl-thumb'),
					$thumb_id = $thumb_item.attr('data-id'),
					$thumb_cats = $thumb_item.attr('data-categs');
					
				inst.load($thumb_id,$thumb_cats);
				
			})
			.on('fw:option-type:page-builder:'+ prefix +'pred-tpl:after-html-replace', function(){
				//
				var $tsearch = $('#tsearch');
				
				$tsearch.hideseek({
					highlight: true,
					nodata: 'No results found'
				});
				
				$tsearch.on("input", function(){
					$(this).parent().addClass('searching');
				});
				
				$('.clear-tsearch').on("click", function(e){
					e.preventDefault();
					 var kp = jQuery.Event("keyup"); 
					 kp.which = kp.keyCode = 8;
					$tsearch.val('').trigger(kp);
					$tsearch.parent().removeClass('searching');
				});
				
				$('.'+ prefix +'pred-tpl-item-img').on({
					mouseenter: function() {
						$(this).parents('.'+ prefix +'pred-tpl-thumb').addClass('active');
					},
					mouseleave: function() {
						$(this).parents('.'+ prefix +'pred-tpl-thumb').removeClass('active');
					}
				});
				
			}).on('click', '.'+ prefix +'pred-tpl-lib-update .force-update', function (e) {
				
				e.preventDefault();
				
				inst.force_update();
				
/*				var $thumb_item = $(this).closest('.'+ prefix +'pred-tpl-thumb'),
					$thumb_id = $thumb_item.attr('data-id'),
					$thumb_cats = $thumb_item.attr('data-categs');
					
				inst.load($thumb_id,$thumb_cats);*/
				
			});
	});
})(jQuery, fwEvents, _, _theme_pb_pred_tpl);