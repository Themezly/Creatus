/**
 * @package      ThzTypo
 * @copyright    Copyright(C) since 2015  Themezly.com. All Rights Reserved.
 * @author       Themezly.com
 * @version      1.0.0
 * @license      MIT License, https://github.com/Themezly/ThzTypo/blob/master/LICENSE
 * @website      http://www.themezly.com
 */
;
(function($, window, document, undefined) {

   "use strict";

   var pluginName = "ThzTypo",
      defaults = {
         fontselector: "#thz-font-selector",
         fontfamily: "#thz-font-family",
      };

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

         this.settings.fontvariant		= $(self.element).find('.thz-font-weight');
		 this.settings.fontstyle		= $(self.element).find('.thz-font-style');
         this.settings.fontsubset		= $(self.element).find('.thz-font-subset');
		 this.settings.texttransform	= $(self.element).find('.thz-font-transform');
		 this.settings.textalign		= $(self.element).find('.thz-font-align');
         this.settings.fontinput		= $(self.element).find('.thz-font-input');
         this.settings.fontbox			= $(self.element).find('.thz-fontbox');
         this.settings.fontSize			= $(self.element).find('.thz-font-size');
         this.settings.lineHeight		= $(self.element).find('.thz-font-lineheight');
         this.settings.letterSpacing	= $(self.element).find('.thz-letter-spacing');
         this.settings.fontColor		= $(self.element).find('.thz-font-color');	
		 this.settings.weightlabel		= $(self.element).find('.weight-label');	
		 this.settings.textshadow		= $(self.element).find('.thz-box-holding-text-shadow');
		
		
		 self.ThzLoadFonts();
         self.ThzFontChange();
         self.ThzFontChangeFamily();
         self.ThzFontClose();
         self.ThzMetricsChange();
		 self.ThzPreviewConnected();
		 self.ThzUpdateValues();
		 
     },
	
	
	 ThzLoadChosen: function (){
		 
		 var self = this;
		 
		 
		 $(self.settings.fontfamily).chosen({
				disable_search_threshold: 10,
				no_results_text: thz_typo.notFound,
				width: "100%"
		 });
		 
	 },
	
	 ThzLoadFonts: function (){
		 
		  var self = this;
		  
		  if($(self.settings.fontselector).length) {
			  return;
		  }
		 
		  $(document.body).append(thz_typo.fonts);

			setTimeout(function() {
				self.ThzLoadChosen();
			}, 1);	

	 },
	
	 ThzPu:function ($val,$default,$auto){
		
		var self = this;
		
		var $val = String($val);
		
		
		if($val === '') {
			return;
		}
		
		if($auto){
		
			if ($val.indexOf('auto') > -1) { 
				return 'auto';
			}			
			
		}	
		
		
		var $get_number = parseFloat($val);
		var $unit 	= $default;
		
		if ($val.indexOf('%') > -1) { 
			$unit ='%';
		}
		
		if ($val.indexOf('px') > -1) { 
			$unit ='px';
		}
		
		if ($val.indexOf('em') > -1) { 
			$unit ='em';
		}
		
		if ($val.indexOf('rem') > -1) { 
			$unit ='rem';
		}
		
		if ($val.indexOf('vw') > -1) { 
			$unit ='vw';
		}
		
		if ($val.indexOf('vh') > -1) { 
			$unit ='vh';
		}
		
		if ($val.indexOf('vmin') > -1) { 
			$unit ='vmin';
		}
		
		if ($val.indexOf('vmax') > -1) { 
			$unit ='vmax';
		}
		 
		return $get_number + $unit;
		 
	 },
	 
	 
	 
     ThzPreviewAppend: function() {

         var self = this;
		 
		
		if(!self.settings.fontinput.length){
			return;
		}
		
		self.ThzLoadFonts();
		
		if(!$(self.element).find(self.settings.fontselector).length){
			
			if(self.settings.textshadow.length){
				$(self.settings.textshadow).ThzTextShadow();
				$(self.settings.textshadow).before($(self.settings.fontselector));
				$(self.element).trigger('typochanged');
				
			}else{
				
				$(self.element).append($(self.settings.fontselector)).trigger('typochanged');
			}
			
			
		}
		self.ThzPreviewText();
		
		self.ThzFontOpen();
        var font_family 	= self.settings.fontinput.val();
		 
		$(self.element).find(self.settings.fontfamily).val(font_family).trigger('chosen:updated');
		 self.ThzPreviewCss();
		
      },

		ThzMetricsChange: function() {
		
		 var self = this;
		
		 
		 $(self.element).find('input,select,.thz-color-picker-trigger').on('click', function(e) {
			 if(!$(self.element).find(self.settings.fontselector).length){
				 self.ThzPreviewAppend();
			 }else{
				 self.ThzFontOpen();
			 }
		
		 });
		
		},

		
		ThzWeightsHtml: function() {
			
			var self = this;
			
			var $default_weights = ['default','normal','bold',100,200,300,400,500,600,700,800,900],
			$weights_html ='';
			
			$.each($default_weights, function (i,w) {
				$weights_html += '<option value="' + w.toString() + '">' + w + '</option>';
			});
			
			return $weights_html;				
		},
			
			
      ThzChange: function() {

         var self = this;
         $(self.element).find(self.settings.fontselector).trigger('change');
		
      },
	  
      ThzFontChange: function() {
         
		  var self = this;
		
		 $(self.element).on('change keyup', '.is-text,.is-select', function(e) {
			 self.ThzChange();
		 });

		 $(self.settings.fontinput).on('click',function(e) {
			 setTimeout(function(){ 
				 $(self.settings.fontfamily).trigger("chosen:open");
			 },1);
		 });
		 		 
         $(self.element).on('change', self.settings.fontselector, function(e) {

            self.ThzPreviewCss();
			
            e.stopImmediatePropagation();
         });
      },
	  
	  
	 ThzUpdateValues: function(){
		 
		var self = this;
		
		$(self.element).on('change keyup thz:text:shadow:change typochanged', function(e) {
			
			var $this 			= $(this);
			var $all_values 	= $this.find('.thz-typo-input :input');
			var $value_data 	= $this.parent().find('.thz-value-data input');
			var $current_data 	= JSON.parse($value_data.val());
			
			$all_values.each(function(index, element) {
				var $input 	= $(this); 
				var $name 	= $input.parents('.thz-typo-input').attr('data-name');
				
				var $val 	= $input.val();
				
				$current_data[$name] = $val;
				
				$value_data.val(JSON.stringify($current_data));

				
			});
		});

		 
	 },
	  
	   ThzPreviewConnected : function (){
		   var self = this;
		   
		   if($(self.element).parent().attr('data-typo-connect')){
			   
			   var connect  = $(self.element).parent().attr('data-typo-connect');
			   $(connect).on('change',function(){
				   
					self.ThzPreviewText();  
			   });
			   
		   }
		   
	   },
	 
	 
	  ThzPreviewText : function (){
		  
		 var self = this;
		 
		 
		 if($('.thz-typography-preview').length > 0){
		   
			 if($(self.element).parent().attr('data-typo-connect')){
		
				 var connect  		= $(self.element).parent().attr('data-typo-connect');
				 var preview_text 	= $(connect).val();
				 
			 }else{
				
				preview_text = '1 2 3 4 5 6 7 8 9 0 A B C D E F G H I J K L M N O P Q R S T U V W X Y Z a b c d e f g h i j k l m n o p q r s t u v w x y z';
				 
			 }
		 
			$(self.element).find('.thz-typography-preview').text(preview_text);		
		
		 }

	  }, 
	
	
	
	
	  ThzFontOpen: function(){
		   var self = this;
		   
		   $(self.settings.fontselector)
		   .removeClass('thz-fonts-closed')
		   .addClass('thz-fonts-opened');		  
	  },
	  
	  
      ThzFontClose: function() {
         var self = this;
         $(document).on('click', function(event) {

            if ($(event.target).parents('.thz-fontbox').length == 0) {
				
			   if(!$(self.settings.fontselector).hasClass('thz-fonts-closed')){
				   
				   $(self.settings.fontselector)
				   .removeClass('thz-fonts-opened')
				   .addClass('thz-fonts-closed');
				   
				   self.ThzPreviewText();
			   }
			   
            }
			
         });

      },

      ThzFontChangeFamily: function() {

         var self = this;
		
         $(self.element).on('change', self.settings.fontfamily, function(e) {

            $(self.settings.fontsubset).parents('.thz-typography-group').css('display', 'none');
			$(self.settings.fontstyle).parents('.thz-typography-group').css('display', 'block');
			 
            var $font_subsets 	= $(this).find(':selected').attr('data-subsets');
            var $font_variants 	= $(this).find(':selected').attr('data-variants');
			var $font_type 		= $(this).find(':selected').attr('data-type');
			
			

			
            if ($font_subsets) {
               
			   self.ThzBuildSelectList($font_subsets, self.settings.fontsubset);
               $(self.settings.fontsubset).parents('.thz-typography-group').css('display', 'block');
			   $(self.settings.fontstyle).parents('.thz-typography-group').css('display', 'none');
			   
            } else {

               $(self.settings.fontsubset).html('');
            }
			
            if ($font_variants === undefined) {
				
				var $weights_html = '<option value="default">Default</option>';
					$weights_html += '<option value="normal">Normal</option>';
					$weights_html += '<option value="bold">Bold</option>';
					$weights_html += '<option value="100">100</option>';
					$weights_html += '<option value="200">200</option>';
					$weights_html += '<option value="300">300</option>';
					$weights_html += '<option value="400">400</option>';
					$weights_html += '<option value="500">500</option>';
					$weights_html += '<option value="600">600</option>';
					$weights_html += '<option value="700">700</option>';
					$weights_html += '<option value="800">800</option>';
					$weights_html += '<option value="900">900</option>';
				
				$(self.settings.fontvariant).empty().html($weights_html);
				
				$(self.settings.weightlabel).text('Weight');
				
				
				if($font_type =='fontfacekit'){
				   $(self.settings.fontsubset).parents('.thz-typography-group').css('display', 'none');
				   $(self.settings.fontstyle).parents('.thz-typography-group').css('display', 'block');
				}
				
				
            }else{
				
				self.ThzBuildSelectList($font_variants, self.settings.fontvariant);
				$(self.settings.weightlabel).text('Variants');
				$(self.settings.fontstyle).val('default');
			}

         });

      },

      ThzBuildSelectList: function($collection, $container) {

         var self = this;
         var $options_array = $collection.split(',');
         var $container_html = '';

         $.each($options_array, function(index, value) {

            $container_html += '<option value="' + value + '">' + self.ThzCapitalize(value) + '</option>';

         });

         return $container.empty().html($container_html);

      },

      ThzCapitalize: function(string) {
         var self = this;
         return string.charAt(0).toUpperCase() + string.slice(1);

      },


      ThzPreviewCss: function() {

			
         	var self 			= this;
			var fontFamily 		= $(self.settings.fontfamily).val();
			var font_type 		= $(self.settings.fontfamily).find(':selected').attr('data-type');
            var fontWeight 		= $(self.settings.fontvariant).val();
            var fontSubset 		= $(self.settings.fontsubset).val();
            var fontStyle 		= $(self.settings.fontstyle).val();
			
			if(font_type == 'google' || font_type == 'typekit' || font_type == 'fontsquirell'){
				fontStyle = 'normal';
			}
			
            var fontSize 		= $(self.settings.fontSize).val();
            var lineHeight 		= $(self.settings.lineHeight).val();
            var letterSpacing 	= $(self.settings.letterSpacing).val();
			var textTransform 	= $(self.settings.texttransform).val();
			var textAlign 		= $(self.settings.textalign).val();

            if (self.ThzIsNumber(letterSpacing)) {
               letterSpacing = letterSpacing + "px"
            }

            var fontColor = self.settings.fontColor.val();
			
			
			if(self.settings.fontColor.length){
			
				fontColor = thz.thz_replace_palette_colors(fontColor);
			
			}

            $(self.settings.fontinput).val(fontFamily).trigger('thz:typo:changed');

            if (font_type !== 'fontsquirell' && fontWeight !== undefined && fontWeight.indexOf('italic') > -1) {

               fontWeight = fontWeight.replace('italic', '');
               fontStyle = 'italic';
            }

            if (fontWeight === 'regular') {
               fontWeight = 400;
            }
			
			var $font_hook = fontFamily + fontWeight + fontSubset;
			
            if (font_type === 'google' && !$('.thz_typo_head_font').hasClass($font_hook) ) {
               var google_font_link = '//fonts.googleapis.com/css?family=' + fontFamily + ':' + fontWeight + '&subset=' + fontSubset;
               $('.thz_typo_head_font').remove();
               $('link:last').after('<link href="' + google_font_link + '" rel="stylesheet" class="thz_typo_head_font '+$font_hook+'" type="text/css">');
               fontFamily = fontFamily + ',sans-serif';
            }
			
			
			if (font_type === 'fontsquirell'){
				
				var fsq_family = fontWeight;
				var fsq_file   = $(self.settings.fontfamily).find(':selected').attr('data-'+fontWeight+'-file');
				
				fontFamily = fsq_family + ',sans-serif';
				fontWeight = 'normal';	
				
				if (!$('.thz_typo_head_font').hasClass($font_hook) ) {
					
					var $style ='<style class="thz_typo_head_font '+$font_hook+'" type="text/css">';
						$style +='@font-face {';
						$style +='font-family:'+fsq_family+';';
						$style +='src: url('+fsq_file+')  format(\'woff\');';
						$style +='font-weight: normal;';
						$style +='font-style: normal;';
						$style +='}';
						$style +='</style>';
						
						$('.thz_typo_head_font').remove();
						$('link:last').after( $style );
					
				}			
			}
			
            if (font_type === 'typekit' && !$('.thz_typo_head_font').hasClass($font_hook) ) {
			   var $kit_id = $(self.settings.fontfamily).find(':selected').attr('data-kitid');	
               var typekit_css_link = '//use.typekit.net/'+ $kit_id +'.css';
               $('.thz_typo_head_font').remove();
               $('link:last').after('<link href="' + typekit_css_link + '" rel="stylesheet" class="thz_typo_head_font '+$font_hook+'" type="text/css">');
            }
			

			if(!self.settings.fontSize.length || fontSize == ''){
				fontSize = 24;	
			}

			if(!self.settings.fontColor.length){
				fontColor = '#000000';	
			}

			if(lineHeight == ''){
				lineHeight = 1.618;
			}
			
			if(letterSpacing == ''){
				letterSpacing = 0;
			}
			
			if(textAlign =='default'){
				textAlign = 'center';
			}
			
			if(fontStyle =='default'){
				fontStyle = 'normal';
			}
			
			if(textTransform =='default'){
				textTransform = 'none';
			}
			
			if(fontFamily =='default'){
				fontFamily = 'inherit';
			}

            var newCSS = {
               'font-family': fontFamily,
               'font-size': self.ThzPu(fontSize,"px"),
               'font-style': fontStyle,
               'font-weight': fontWeight,
               'line-height': self.ThzPu(lineHeight,"em"),
               'letter-spacing': self.ThzPu(letterSpacing,"px"),
               'color': fontColor,
			   'text-transform': textTransform,
			   'text-align': textAlign
            };

		   if($('.thz-typography-preview').length > 0){
         	$('.thz-typography-preview').css(newCSS);
         	self.ThzPreviewContrast('.thz-typography-preview');
		  }
		  
		 $(self.element).trigger('typochanged');

      },

      ThzIsNumber: function(n) {
         return !isNaN(parseFloat(n)) && isFinite(n);
      },

      ThzPreviewContrast: function(container) {

         var self = this;

         var bg = $(container).css('color');
         //use first opaque parent bg if element is transparent
         if (bg == 'transparent' || bg == 'rgba(0, 0, 0, 0)') {
            $(container).parents().each(function() {
               bg = $(container).css('color')
               if (bg != 'transparent' && bg != 'rgba(0, 0, 0, 0)') return false;
            });
            //exit if all parents are transparent
            if (bg == 'transparent' || bg == 'rgba(0, 0, 0, 0)') return false;
         }
         //get r,g,b and decide
         var rgb = bg.replace(/^(rgb|rgba)\(/, '').replace(/\)$/, '').replace(/\s/g, '').split(',');
         var yiq = ((rgb[0] * 299) + (rgb[1] * 587) + (rgb[2] * 114)) / 1000;
         if (yiq >= 128) {

            $(container).css('background-color', '#000000');

         } else {

            $(container).css('background-color', '#ffffff');
         }

      }

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
   
$.fn.selectText = function () {
    return $(this).each(function (index, el) {
        if (document.selection) {
            var range = document.body.createTextRange();
            range.moveToElementText(el);
            range.select();
        } else if (window.getSelection) {
            var range = document.createRange();
            range.selectNode(el);
            window.getSelection().addRange(range);
        }
    });
}

})(jQuery, window, document);