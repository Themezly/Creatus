/**
 * @package      ThzFramework
 * @copyright    Copyright(C) since 2007  Themezly.com. All Rights Reserved.
 * @author       Themezly
 * @license      http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 * @websites     http://www.themezly.com | http://www.youjoomla.com
 */
;
(function($, window, document, undefined) {

	"use strict";

	var pluginName = "ThzAdmin",
		defaults = {/*option:*/};

	function Plugin(element, options) {
		this.element = element;

		this.settings = $.extend({}, defaults, options);
		this._defaults = defaults;
		this._name = pluginName;
		this.init();
	}

	$.extend(Plugin.prototype, {
		init: function() {

			var self = this;

			self.ThzIntAdjust();
			self.ThzFlexColumn();
			self.ThzCenterBuilderColumn();
			self.ThzTableStyle();
			//self.ThzPostFormats();
			self.ThzSelectSwitch();
			self.ThzHeroSelect();
			self.ThzPageTemplateSwitch();
			self.ThzAttachmentFields();
			self.ThzBuilderButtons();
			self.ThzLinkDialogMagnific();
			//fwEvents.debug(true);

		},

		ThzIntAdjust: function(){
			
			var self = this;
			
			if($('.thz-side-tabs-list').length){
				$(document.body).addClass('thz-admin-settings-form');
			}
						
			if($('.system-display-notice').length){
				$('#fw-options-box-site_subbox .hndle').after(thzadminLocalize.system_notice);
			}
			
			if($('.fw-settings-form-header h2').length){
				$('.fw-settings-form-header h2').append('<br /><small>v '+thzadminLocalize.themeversion+'</small>');
			}
			
			

			$(document).on("click", '.go_to_tab', function(e, status) {
				e.preventDefault();
				var $href = $(this).attr('href');
				$('[aria-controls="'+$href+'"] a').trigger('click');
			});
			
			
			if (typeof fwEvents == 'undefined') {
				return;
			}			
			
			fwEvents.on('fw:ext:page-builder:editor-integration:show', function () {
				$('html').addClass('fw-page-builder-active').trigger('thz:builder:activated');
			});	
			
			fwEvents.on('fw:ext:page-builder:editor-integration:hide', function () {
				$('html').removeClass('fw-page-builder-active').trigger('thz:builder:deactivated');
			});		


		},
		
		
		ThzFeaturedImageOptions: function(){
			
			// move featured image options to featured image postbox
			$('#fw-options-box-featuredimage_group > .inside').contents().appendTo('#postimagediv,.editor-post-featured-image > div');
			
			/* bc */
			if($('#fw-options-group-featuredimage_group').length < 1){
				$('#fw-backend-options-group-featuredimage_group').parents('.postbox').addClass('featured_options_parent');
				$('.featured_options_parent > .inside').contents().appendTo('#postimagediv');				
			}			
		},
		
		
		/* Add thz-lightbox classes to WP link options
		 * thnx do detailed info by
		 * https://gist.github.com/bueltge/c6198b9a2b32b2d5a43b72eb841f6592
		 */
		ThzLinkDialogMagnific: function(){
			
			var self = this;
			
			var originalWpLink;
			
			if ( typeof tinymce !== 'undefined' && typeof _ !== 'undefined' && typeof wpLink !== 'undefined' ) {
				
				if ( tinymce.$('#link-options').length ) {
					
					tinymce.$('#link-options').append('<div class="thz-link-options-magnific"><label title="'+ thzadminLocalize.magnificlink2 +'"><span></span><input type="checkbox" id="wp-link-thz-magnific" /> '+ thzadminLocalize.magnificlink1 +' </label></div>');
					
					originalWpLink = _.clone( wpLink );
					wpLink.addThzMagnific = tinymce.$('#wp-link-thz-magnific');
					
					wpLink = _.extend( wpLink, {

						getAttrs: function() {
							
							var attrs 		= originalWpLink.getAttrs();
							var $mfp_type	= thz.is_image( attrs.href ) ? 'mfp-image': 'mfp-iframe';
							attrs.class 	= wpLink.addThzMagnific.prop( 'checked' ) ? 'thz-lightbox '+ $mfp_type : null;
	
							return attrs;
						},

						buildHtml: function( attrs ) {
							
							var $mfp_type	= thz.is_image( attrs.href ) ? 'mfp-image': 'mfp-iframe';

							var html = '<a href="' + attrs.href + '"';
							
							if ( attrs.class ) {
								
								if( attrs.class.indexOf('thz-lightbox') !== -1 ){
								
									html += ' class="thz-lightbox '+ $mfp_type +' thz-wp-link-magnific"';
								
								}
							}
							
							if ( attrs.target ) {
								html += ' target="' + attrs.target + '"';
							}
							return html + '>';
						},

						mceRefresh: function( searchStr, text ) {
							originalWpLink.mceRefresh( searchStr, text );
							var editor = window.tinymce.get( window.wpActiveEditor )
							if ( typeof editor !== 'undefined' && ! editor.isHidden() ) {
								var linkNode = editor.dom.getParent( editor.selection.getNode(), 'a[href]' );
								if ( linkNode ) {
									
									var hasmagnific = editor.dom.getAttrib( linkNode, 'class' ).indexOf('thz-lightbox') !== -1 ? true : false;
									wpLink.addThzMagnific.prop( 'checked', hasmagnific );
								}
							}
						}
					});
				}
			}
		
			
		},
		
		
		
		ThzAddCSSButton: function (){
			
			var self = this;
			
			if( $('#fw-options-box-pagecssbox').length < 1 ){
				return;	
			}
			
			if( $('.thz-theme-pred-tpl-add-btn-wrap').length > 0){
				
				$('.thz-theme-pred-tpl-add-btn-wrap').append('<a class="page-css-btn" href="#" onclick="return false;" title="Page css"></a>');
				
			}else{
				
				$('.fw-builder-header-tools.fw-clearfix')
				.removeClass('fw-hidden')
				.append(
					'<div class="thz-theme-pred-tpl-add-btn-wrap fw-pull-right">' +
					/**/'<a class="page-css-btn" href="#" onclick="return false;" title="Page css"></a>' +
					'</div>'
				);					
			}

			
			if( $('#fw-option-pcss-1').length > 0 ){
				
				$('.page-css-btn').addClass('has-css');
			}
			
			fwEvents.on('fw:option-type:addable-popup:options-modal:close', function (data) {
			  
				if(data.modal.attributes.title == 'Page CSS'){
	
					var $options = data.modal.get('values');
					
					if($options.css && $options.css.trim() != '' ){	
						
						$('.page-css-btn').addClass('has-css');
	
					}else{
						
						$('.page-css-btn').removeClass('has-css');
						$('#fw-option-pcss .delete-item').trigger('click');
						
					}
				}
	
			});	
			
			$(document).on("change","#fw-option-pcss",function(e) {
			
				if( $('#fw-option-pcss-1').length > 0 ){
					
					$('.page-css-btn').addClass('has-css');
					
				}else{
					
					$('.page-css-btn').removeClass('has-css');
				}
				
			});
	
			$('.page-css-btn').on('click',function(e){
				
				e.preventDefault();
				
				var $page_css_item = $('#fw-option-pcss .item');
				
				if( $('#fw-option-pcss .item').length > 0 ){
					
					$page_css_item.trigger('click');
					
				}else{
					
					$('#fw-option-pcss .button.add-new-item').trigger('click');
				}
				
			});			
			
		},
		
		
		ThzBuilderButtons: function (){
			
			var self = this;
			
			// trigger autosave on preview click to 
			$('#post-preview').on( 'click.post-preview', function( event ) {
				if ( wp.autosave.server ) {
					wp.autosave.server.triggerSave();
				}
			});
			
			
			$(document.body).on('fw:option-type:builder:init', function(e, data) {
				
				if (data.builder.get('type') !== 'page-builder') {
					return;
				}
				
				self.ThzAddCSSButton();
					
			
			    thz_page_builder_data = data.builder;
			
				$('#fw-option-page-builder .fw-builder-header-tools .template-container').before(
					$('<a>', {
						class: 'button fw-pull-right thz-builder-preview',
						html: 'Preview',
						href: '#',
					})
				);
				
				
/*				$('.thz-builder-preview').on('click',function(e){
					
					e.preventDefault();
					
					$( '#post-preview' ).trigger('mousedown').trigger('click');
					
				});*/
				
				self.ThzBuilderPreview();
				
			});			
			
		},
		
		
		ThzBuilderPreview: function (){
			
			var self = this;

			$('.thz-builder-preview').on('click',function(e){
				e.preventDefault();
			});
						
			$( '.thz-builder-preview' ).on( 'mousedown touchend', function (e) {
				
				e.preventDefault();
				
				var $content = $( '#content' );
				
				if( $content.length > 0 ){
					
					var $contentValue = tinymce.get( 'content' ) ? tinymce.get( 'content' ).getContent() : $content.val(),
						$session      = '<!-- <fw_preview_session>' + new Date().getTime() + '</fw_preview_session> -->';
			
					if ( $contentValue.indexOf( '<!-- <fw_preview_session>' ) !== -1 ) {
						$contentValue = $contentValue.replace( /<!-- <fw_preview_session>(.*?)<\/fw_preview_session> -->/gi, $session );
					} else {
						$contentValue = $contentValue + $session;
					}
			
					self.ThzBuilderUpdateContent( $contentValue );
					self.ThzBuilderUpdateContent( $contentValue.replace( /<!-- <fw_preview_session>(.*?)<\/fw_preview_session> -->/gi, '' ) );
				
				}
				
				if($('.editor-post-preview').length > 0 ){
					$('.editor-post-preview')[0].click();
				}else{
					$( '#post-preview' ).trigger('click');
				}
				
			});
			
			
		},
		
		ThzBuilderUpdateContent: function( $content ){
			
			var self = this;
			
			if ( tinymce.get( 'content' ) ) {
				tinymce.get( 'content' ).setContent( $content );
			} else {
				$( '#content' ).val( $content );
			}			
		},
		
		ThzAttachmentFields: function (){
			
			var self = this;
			
			if (wp.media) {
				
				wp.media.view.Modal.prototype.on('open', function(data) {
					
					if (wp.media.frame) {
						
						var $trigger = $(wp.media.frame.modal.clickedOpenerEl);
						
						if($trigger.hasClass('add_media')){
							
							$('body').addClass('thz-hide-custom-media-fields');
							
						}else{
							
							$('body').removeClass('thz-hide-custom-media-fields');
						}
					}
		
				});
			}			
		},
		
		ThzPageTemplateSwitch: function (){
			
			var self = this;
			
			if (typeof fwEvents == 'undefined') {
				return;
			}
		
			if($('#page_template').length > 0){
				
				fwEvents.on('fw:ext:page-builder:editor-integration:show', function () {
					
					if($('#page_template').val() !='template-parts/page-builder.php' && $('#page_template').val() !='template-parts/page-blank.php'){
						
							$('#edit-slug-box').append('<span class="template-flash">Page builder is active, you might need to use Page builder template.</span>');
							$('.template-flash').fadeOut(200).fadeIn(200).delay(4000).fadeOut(200,function(){
								$(this).remove();
							});
						
					}
				});

			}
			
		},
		
		ThzHeroSelect: function (){
			
			var self = this;

			if (typeof fwEvents == 'undefined') {
				return;
			}
			
			fwEvents.on('fw:option-type:addable-popup:options-modal:render', function (data) {
			  
				var frame = data.modal.frame.$el;
				
				if(frame.find('.thz-hero-page-select').length < 1){
				  return;
				}
				
				var $options = data.modal.get('values');
				var $hero_page = $options.hero_page;
				var $taken = []; 

				$('#fw-option-heros .items-wrapper .item .content .page').each(function(index, element) {
					
					var $picked = $(this).text().split(',');
					
					$.each($picked,function(index,val){
						$taken.push(val);
					});
					
				});
				
				if ($taken[0] != null) {
					$.each($taken,function(index,val){
				
						if($hero_page == undefined || $hero_page.indexOf(val) == -1){
							$(".thz-hero-page-select option[value='"+val+"']").remove();
						}
					});
				}
				
			});	
					
			
			
		},
		
		
		
		Tsan: function ( $selector, $elements ){
			
			var self = this;
			
			var $addon = '#fw-backend-option-fw-option-';
			
			if($selector.parents('.media-frame-content').length){
				$addon = '#fw-backend-option-fw-edit-options-modal-';
			}
			
			if($selector.parents('li.customize-control').length){
				$addon = '#customize-control-';
			}
			
/*			if($selector.parents('.widget-content').length){
				console.log('da');
				$addon = '#widget-';
			}*/
			
			var $replace = new Array();
			var $leave = new Array();
			
			if($elements){
				var $all_el = $elements.split(',');
				
				$.each($all_el,function(index,el){
					if(el.indexOf('-getp') !== -1){
						$(el).each(function(i, e) {
                            var parent = $(e).parents('.fw-backend-option').attr('id');
							var newe = '#' + parent;
							$all_el.push(newe);
                        });
					}
				});

				$.each($all_el,function(index,el){

					if(el.indexOf('.') == -1 && el.indexOf('#') == -1){
						
						$replace.push($addon + el);
						
					}else{
						
						$leave.push( el );
					}
					
					
				});
			}
			var $new_elements = $leave.concat($replace).join(',');
			
			return $new_elements;
		},
		
		
		ThzCheckSelects: function ($trigger){
			
			var self = this;

			$('.thz-select-switch:not(.thz-switch-initialized)').each(function(i, el) {
				
				
				
				var $this = $(this);
				var $ldisable = self.Tsan($this, $this.find('option:selected').attr('data-disable'));
				var $lenable = self.Tsan($this,$this.find('option:selected').attr('data-enable'));
				var $lcheck = self.Tsan($this, $this.find('option:selected').attr('data-check'));

				$($ldisable).not( ".is_done" ).hide().addClass('is_done');
				$($lenable).not( ".is_done" ).show().addClass('is_done');

											
				$this.on('change.checkselect', function(e) {
					
					
					
					// e.stopImmediatePropagation();
					
					var $disable = self.Tsan($this, $('option:selected', this).attr('data-disable'));
					var $enable = self.Tsan($this, $('option:selected', this).attr('data-enable'));
					var $check = self.Tsan($this, $('option:selected', this).attr('data-check'));
					
					if($check){
						
						if($($check).is('select')){
							
							$($check).trigger('change');
							
						}else{
						
							$($check).find('select').trigger('change');
						}
					}

					$($disable).hide();
					$($enable).show();	
					
					//e.stopPropagation();
					//e.stopPropagation(); //e.stopImmediatePropagation();
					//console.log($this);
					//$this.unbind('change.checkselect');
					
				});
				
				if($trigger){
					$(this).trigger('change');
				}
				
			}).addClass('thz-switch-initialized');
			

						
		},
		
		
		ThzSelectSwitch: function (){
			
			var self = this;

			$(document).on('widget-updated', function(event, widget){
				self.ThzCheckSelects(true);				
				
			});
			
			$(document).on('widget-added', function(event, widget){
				setTimeout(
					function(){
						widget.find('.thz-select-switch').removeClass('thz-switch-initialized');
						self.ThzCheckSelects();
				},20);
			});

			$(document.body).on('click.widgets-toggle', '#widgets-right .widget,#wp_inactive_widgets .widget', function(e) {
				self.ThzCheckSelects(true);
			});
			
			$(document.body).on('click.widgets-toggle','.widget-tpl',function(e) {
				self.ThzCheckSelects(true);
			});			

			
			if (typeof fwEvents == 'undefined') {
				return;
			}
			
			$(document.body).on('change', '.thz-select-switch-picker', function(e) {
				setTimeout(
					function(){
						$('.thz-select-switch').removeClass('thz-switch-initialized');
						self.ThzCheckSelects();
				},20);
			});
			

			setTimeout(	
				function(){	
					fwEvents.on('fw:options:init', function(data){	
 						if (data.lazyTabsUpdated && !data.lazyTabsUpdated){	
							 return;	
						}	
 						self.ThzCheckSelects();	
							
					})	
			},20);
						
/*			fwEvents.on('fw:options:init', function(data){
				
				if (data.lazyTabsUpdated && !data.lazyTabsUpdated){
					 return;
				}
				setTimeout(	function(){
					self.ThzCheckSelects();
				},20);
				
			});*/
			
		},


		thzFormatsSwitch: function($val){
			
			var self = this;

				
			var $all_lis = $('#fw-options-box-post_options_box .fw-options-tabs-list ul li');
			
			
			if($('html').hasClass('fw-page-builder-active')){
				$val = 0
			}
			
			if( $val == 0 ){
				
				$('.thz-formats-li').hide();
				$('.thz-media-li').show();
				$('.thz-post-li').find('a').trigger('click');
				
			}else{
				
				$('.thz-media-li').hide();
				$('.thz-formats-li').show().find('a').trigger('click');
			}
			
			
			$('.thz-formats-group').hide();
			$('.thz-format-'+$val).show();
						
		},
		
		
		ThzPostFormats: function (){
			var self = this;
			
			if($('body').hasClass('post-type-post')){
				
				$('html').on('thz:builder:activated thz:builder:deactivated', function() {
					
					setTimeout(
						function(){
							$( "input[name=post_format]:checked" ).trigger('change');
					},20);
					
				});
				
				$( "input[name=post_format]" ).on('change', function() {
					
					var $val = $(this).val();
					self.thzFormatsSwitch($val);
				
				});	
				
			}
			
			
		},

		
		ThzTableStyle: function (){
			
			var self = this;

			if (typeof fwEvents == 'undefined') {
				return;
			}
			
						
			fwEvents.on('fw:builder-type:page-builder:item-type:simple:options-modal:render fw:ext:wp-shortcodes:options-modal:render', function(data){
				
				if (data.shortcode != 'table') {
					return;
				}
				
				var table_options =  data.modal.get('values');

				
				if(table_options.style_type == 'tabular'){
					
					$('#fw-backend-option-fw-edit-options-modal-pricing_style').addClass('thz-hide-options');
					$('#fw-backend-option-fw-edit-options-modal-table_style').removeClass('thz-hide-options');
					$('#fw-backend-option-fw-edit-options-modal-stripes').removeClass('thz-hide-options');
					$('#fw-backend-option-fw-edit-options-modal-tr_mx').removeClass('thz-hide-options');
					
				}else{
					
					$('#fw-backend-option-fw-edit-options-modal-pricing_style').removeClass('thz-hide-options');
					$('#fw-backend-option-fw-edit-options-modal-table_style').addClass('thz-hide-options');
					$('#fw-backend-option-fw-edit-options-modal-stripes').addClass('thz-hide-options');
					$('#fw-backend-option-fw-edit-options-modal-tr_mx').addClass('thz-hide-options');
				}	
				
				
				
				$('#fw-edit-options-modal-table-header-optionstable_purpose').on('change', function(data){
					
					var val =  $(this).find(':checked').val();
					if(val == 'tabular'){
						
						$('#fw-backend-option-fw-edit-options-modal-pricing_style').addClass('thz-hide-options');
						$('#fw-backend-option-fw-edit-options-modal-table_style').removeClass('thz-hide-options');
						$('#fw-backend-option-fw-edit-options-modal-stripes').removeClass('thz-hide-options');
						$('#fw-backend-option-fw-edit-options-modal-tr_mx').removeClass('thz-hide-options');
						
					}else{
						
						$('#fw-backend-option-fw-edit-options-modal-pricing_style').removeClass('thz-hide-options');
						$('#fw-backend-option-fw-edit-options-modal-table_style').addClass('thz-hide-options');
						$('#fw-backend-option-fw-edit-options-modal-stripes').addClass('thz-hide-options');
						$('#fw-backend-option-fw-edit-options-modal-tr_mx').addClass('thz-hide-options');
						
					}
						
				}).trigger('change');
							
								
			});
		},
		

		ThzFlexColumn :function (){
			
			var self = this;
			var $mode;

			if (typeof fwEvents == 'undefined') {
				return;
			}
			
/*			fwEvents.on('fw:builder:page-builder:column:filter:allow-incomming-type', function(data){		
				
				
					
					
					if(data.type =='column'){
						data.allow = true;
						
						console.log(data);
					}
			});*/
			
			
				
			fwEvents.on('fw:page-builder:shortcode:column:modal:before-open', function(data){
				
				var $parentItem = data.model.collection.view.$el.closest('.builder-item'),
					parentItem;
				if (
					!$parentItem.length
					||
					!(parentItem = data.builder.findItemRecursive($parentItem.attr('id').split('-').pop()))
				) {
					$mode = false;
					return;
				}
				
				if(  parentItem.attributes.atts !== undefined && parentItem.attributes.atts.mode !== undefined){
					$mode = parentItem.attributes.atts.mode;
				}

			});
			
			
			fwEvents.on('fw:page-builder:shortcode:innercolumn:modal:before-open', function(data){
				
				var $parentItem = data.model.collection.view.$el.closest('.custom-section').parent(),
					parentItem;
				if (
					!$parentItem.length
					||
					!(parentItem = data.builder.findItemRecursive($parentItem.attr('id').split('-').pop()))
				) {
					$mode = false;
					return;
				}
				//console.log(parentItem);
				if(  parentItem.attributes.atts !== undefined && parentItem.attributes.atts.mode !== undefined){
					$mode = parentItem.attributes.atts.mode;
				}

			});
			
			
			fwEvents.on('fw:builder:thz-column:modal:before-open', function(data){
				
				var $parentItem = data.model.collection.view.$el.closest('.builder-item'),
					parentItem;
				if (
					!$parentItem.length
					||
					!(parentItem = data.builder.findItemRecursive($parentItem.attr('id').split('-').pop()))
				) {
					$mode = false;
					return;
				}
				
				if( parentItem.attributes.options !== undefined && parentItem.attributes.options.mode !== undefined){
					$mode = parentItem.attributes.options.mode;
				}

			});		
			
			
			fwEvents.on('fw:builder-type:page-builder:item-type:column:options-modal:render fw:builder-type:page-builder:item-type:innercolumn:options-modal:render fw:builder:thz-column:modal:render', function(data){
				
				if($mode != 'default'){
					$('#fw-backend-option-fw-edit-options-modal-flexalign').show();
				}else{
					$('#fw-backend-option-fw-edit-options-modal-flexalign').hide();
				}
			});	
			
		},
		
		
		
		ThzCenterBuilderColumn :function (){


			if (typeof fwEvents == 'undefined') {
				return;
			}
			
						
			fwEvents.on('fw:page-builder:shortcode:column:controls fw:page-builder:shortcode:innercolumn:controls', function(data){
				
				var column_options = data.model.get('atts');
				var centered;
				var background;
				
				if (column_options && column_options.centered){
					centered = column_options.centered;
				}				

				
				if(centered == 'center'){
					
					$(data.model.view.$el).addClass('thz-center-builder-column');
					
				}else{
					
					$(data.model.view.$el).removeClass('thz-center-builder-column');
				}
				
				
				if (column_options && column_options.bs.background){
					
					background = column_options.bs.background.type == 'color' ? column_options.bs.background.color : false;
				}
				
				if(background){
					
					var $bgspan = '<span class="thz_shc_bg" style="background-color:'+thz.thz_replace_palette_colors(background)+';"></span>';
					
					$(data.model.view.$el).find('.fw-builder-item-width-changer .thz_shc_bg').remove();
					$(data.model.view.$el).find('.fw-builder-item-width-changer').eq(0).append($bgspan);
					
				}else{
					
					$(data.model.view.$el).find('.fw-builder-item-width-changer .thz_shc_bg').remove();
					
				}
				
			
			});			
			
		},

	});

	
	
	$.fn[pluginName] = function(options) {
		return this.each(function() {
			if (!$.data(this, 'plugin_' + pluginName)) {
				$.data(this, 'plugin_' + pluginName, new Plugin(this, options));
			} else if (Plugin.prototype[options]) {
				$.data(this, 'plugin_' + pluginName)[options]();
			}
		});
	}

})(jQuery, window, document); // JavaScript Document


/* Page builder data */
var thz_page_builder_data;

/* Run */
(function ($) {
	$(function ($) {
		
		$(document).on('ready', function(){
			$(document).ThzAdmin();
		});

		$(window).on('load',function() {
		   $(document).ThzAdmin('ThzPostFormats');
		   $(document).ThzAdmin('ThzFeaturedImageOptions');
		});
		
		$(document.body).on({
			'fw:settings-form:before-reset': function (e) {
				$(this).addClass('fw-resetting');
			},
			'fw:settings-form:reset': function (e) {
				$(document).ThzAdmin('ThzIntAdjust');
				$(this).removeClass('fw-resetting');
			}
		});

	});
})(jQuery);



/* Helper functions */

var thz;

if (typeof Object['create'] != 'undefined') {
	/**
	 * create clean object
	 * autocomplete in console to show only defined methods, without other unnecesary methods from Object prototype
	 */
	thz = Object.create(null);
} else {
	thz = {};
}

(function($){

	 /**
	 * Replace multiple color palette strings with color value
	 * @return string
	 */
	thz.thz_replace_palette_colors = function(string) {
	
		if (string.indexOf('color_') !== -1) {
	
			
	
			if ($('#fw-option-theme_palette').length > 0) {
				
				var $theme_palette = JSON.parse($('#fw-option-theme_palette').attr('data-palette-set'));
				
			}else{
				
				var $theme_palette = JSON.parse(thz_picker_vars.thz_palette);
			}
	
			$.each($theme_palette, function(name, color) {
				
				 if (color.indexOf('darker') !== -1 || color.indexOf('lighter') !== -1 || color.indexOf('contrast') !== -1) {
					 
					 var $data 		= color.split('_');
					 var $shade 	= $data[1];
					 var $percent 	= $data[2] ? $data[2] : null;
					 var $color_1 	= $theme_palette['color_1'];
					 
					 if($shade =='darker'){
						
						color  = tinycolor( $color_1 ).darken($percent).toString();
					 
					 }else if($shade =='lighter'){
						 
						 color  = tinycolor( $color_1 ).lighten($percent).toString();
						 
					 }else if($shade =='contrast'){
						 
						 color  = tinycolor( $color_1 ).getBrightness() >= 128 || tinycolor( $color_1 ).getAlpha() < 0.45 ? '#000000' : '#ffffff';
					 }
	
				 }
				 
				// https://jsfiddle.net/fqqLdxkz/3/
				string = string.replace(new RegExp('\\b' + name + '\\b', 'g'), color);
	
			});
	
		}
	
		return string;

	};
	

	/**
	* Check element unit
	* returns clean number with specified unit
	*/
	thz.thz_property_unit = function($val,$default,$auto,$none) {	
		
		if($val ==''){
			return;
		}
		
		
		if($auto && $val.indexOf('auto') !== -1){
			
			return 'auto';
		}
		
		if($none && $val.indexOf('none') !== -1){
			
			return 'none';
		}
		
		var $allowed = ['px','em','rem','%','vh','vw','vmin','vmax','auto'];	
		
		var $value 	= parseFloat($val);
		var $unit 	= $default;
		
		$.each($allowed, function (index, un){
			
			if($val.indexOf(un) !== -1){
				$unit = un;
			}
			
		});
	
		return $value + $unit;
	};
	
	/**
	* Strip tags from string
	* returns string
	*/	
	thz.thz_strip_tags = function(string) {
	  var decoded_string = $("<div/>").html(string).text();
	  return $("<div/>").html(decoded_string).text();
	};
	
	
	/**
	* Strip tags from string and replace with space
	* returns string
	*/		
	thz.thz_strip_tags_to_space = function(string) {
	  return string.replace(/(<([^>]+)>)/g, " ");
	};
	
	
	
	/**
	* Get specific image size url from original image url
	* @original //image_url.ext
	* @size 80x80  
	* returns string
	*/		

	thz.thz_get_image_size_url = function(original,size) {
		
		var re = new RegExp("(.+)\\.(gif|png|jpg|jpeg|svg)", "g");
		return original.replace(re, "$1-"+size+".$2");
		
	}
	
	
	
	/**
	* Check if uri is image
	* returns bool
	*/		

	thz.is_image = function( uri ) {
		
		uri = uri.split('?')[0];
		var parts = uri.split('.');
		var extension = parts[parts.length-1];
		var imageTypes = ['jpg','jpeg','tiff','png','gif','bmp'];
		
		if(imageTypes.indexOf(extension) !== -1) {
			return true;   
		}
		
	}

	
	/**
	* Populate popup template for medias with media thumbs
	* returns string
	*/	
	thz.thz_popup_thumbs_template = function(media_type,media_title,thumbs_size,medsrc,container) {
		
		setTimeout(function () {

			var html 	='';
			var plh		= thzadminLocalize.themeurl + '/assets/images/placeholders/thumb.jpg';
			
			if (media_type =='images') {
				
				var multi_title = media_title == '' ? 'Mulitple images' : media_title;
				
				html += '<b class="thz-popup-media-type-images">'+multi_title+'</b>';
				jQuery.each(medsrc, function( index, img ) {
					
					var aid 	= parseInt ( img.attachment_id );
					var url 	= isNaN(aid) ? plh : thz.thz_get_image_size_url(img.url,thumbs_size);

					var imghtml = '<img src="'+url+'" />';
					
					html += '<div id="thzpopthumb'+aid+'" class="thz-popthumb">'+imghtml+'</div> ';
				});
				
				
			} else if (media_type =='image') {
				
				var aid 			= parseInt ( medsrc.attachment_id );
				var url 			= isNaN(aid) ? plh : thz.thz_get_image_size_url(medsrc.url,thumbs_size);

				var imghtml 		= '<img src="'+url+'" />';
				var single_title 	= media_title == '' ? 'Single image' : media_title;
				
				html += '<div id="thzpopthumb'+aid+'" class="thz-popthumb">'+imghtml+'</div> ';			
				html += '<b class="thz-popup-media-type">'+single_title+'</b>';
				
			}else{
				
				if( ( media_type =='flickr'  || media_type =='instagram') && media_title == '' ){
					media_title = media_type;
				}
				
				html += '<div class="thz-popthumb thz-pop-'+media_type+'"></div><b class="thz-popup-media-type">'+media_title+'</b>';
			}
			
			
			container.append(html);
		
		 }, 100);

	}
	
	thz.image_layer_template = function( $layer_data, $options, $layer ) {
		
		utils = {

			ThzGetLayerImage: function( $layer_data, $options, $layer ){
				
				var $item_in 		= $layer.find('.item-in');
				var $item_in_over 	= $layer.find('.item-in-over');
				var $style 			= thz.thz_replace_palette_colors($options.bs.css);
				
				$item_in_over.removeClass('has-img');
				
				if($options.image.url != undefined ){
					
					var $position = $options.img_mx.position.replace('-',' ');
					var $bg_image = $options.image.sizes != undefined ? $options.image.sizes['thz-img-small']['url'] : $options.image.url;
					
					$item_in_over.addClass('has-img').css({
						'background-image': 'url( '+ $bg_image +' )',
						'background-position': $position
					});
				
				}
				
				if($options.cmx.i !=''){

					$item_in.attr('data-l-id',$options.cmx.i);
				}
				
				if ($options.instyle !=''){
					$item_in.attr('data-l-inh',$options.instyle);
				}else{
					$item_in.attr('style',$style);
				}
				
				// set style
				if($options.cmx.i !=''){
					
					$('#'+$options.cmx.i+'-layer').remove();
					
					var css = '[data-l-id="'+$options.cmx.i+'"],';
						css +='[data-l-inh="'+$options.cmx.i+'"]{';
						css += $style
						css +='}';
						
					$("head").append('<style id="' + $options.cmx.i + '-layer" type="text/css">'+css+'</style>');
				}

			},
			
		};
		
		utils.ThzGetLayerImage( $layer_data, $options, $layer);
		
	}
	
})(jQuery);