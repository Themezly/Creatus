;
(function($, window, document, undefined) {

   "use strict";

   var pluginName = "ThzTextShadow",
      defaults = {};

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
		
		 this.name 			= $(this.element).parent().attr('id');
  		 this.addshadow 	= $(this.element).find('.fw-option-type-addable-option-add');
		 this.switchstyle 	= $(this.element).find('.switch-style');
		 var $button		= $(this.element).find('.fw-option-type-addable-option-add');
		 this.remove		= $(this.element).find('.thz-remove-shadow') ;
		 this.shadowsbox	= $(this.element).parents('.thz-box-holding-text-shadow');
		 this.text			= $(this.element).find('.thz-text-shadow-text');
		 this.previewbox	= $(this.element).find('.thz-text-shadow-preview');
		 this.connected		= $(this.element).parents('.connect-text-shadow');

		 

		 if (typeof(Storage) !== "undefined") {
			 
			 if(localStorage.getItem(self.name +'_bg')){
				
				 $(self.element).find('.thz_s_bg').val(localStorage.getItem(self.name +'_bg')).trigger('change');
			 }

			 if(localStorage.getItem(self.name +'_co')){
				
				 $(self.element).find('.thz_s_co').val(localStorage.getItem(self.name +'_co')).trigger('change');
			 }			 
		 }

		
		 $(this.addshadow).on('click',function () {
			setTimeout(function() {
			   self.ThzTextShadowCss();
			}, 20);
		 });
		 
		 $(document).off('click.showshadow').on('click.showshadow','.thz-show-text-shadow', function(){
			
			$(this).parents('.thz-box-holding-text-shadow,.fw-option').toggleClass('show-shadows').promise().done(function(){
   				
				var $this = $(this);
				if($(this).is('.show-shadows') && self.connected.find('.thz-typography-group.family').length > 0){
					setTimeout(function() {
						self.connected.find('.thz-typography-group.family input').trigger('click')
					}, 20);
				} 
			});
			
	
			
		 });
		 
		 
/*		$(document).off('click.hideshadows').on('click.hideshadows',function (e) {
			
			var container = $('.thz-box-holding-text-shadow');
			if (!container.is(e.target)	&& container.find(e.target).length === 0 && !$(e.target).hasClass('thz-remove-shadow')){
				container.removeClass('show-shadows');
			}
				
		});*/

		$(document).on('click','.thz-remove-shadow', function(){
			 setTimeout(function() {
				   self.ThzTextShadowCss();
			 }, 20);			

		 });

		 $(document).on('change keyup fw:thz:color:picker:changed thz:text:shadow','.thz-text-shadows-holder :input', function(){
			self.ThzTextShadowCss();

		 });
		 
		 $(this.element).find('.fw-option-type-addable-option').on('change', function (){
			 
			 self.ThzTextShadowCss();
		 });

		 self.ThzTextShadowCss();
		 
		 if(self.previewbox.length > 0){
		 	self.ThzSetPreviewCss();
		 }
      },
	  
	  
	  ThzTypoSplitVal: function ($val){
		  
		 var self 					= this;
		 var $cc_obsj				= {}; 
         var $current 				= $val.split('|');
         $cc_obsj['font-family'] 	= $current[0];
         $cc_obsj['font-weight']	= $current[1];
		 $cc_obsj['text-transform'] = $current[2];
		 $cc_obsj['text-align'] 	= $current[3];
		 $cc_obsj['font-style']		= 'normal';
		 
		 if($current.length == 5 ){
			 $cc_obsj['text-transform']= $current[3];
			 $cc_obsj['text-align'] = $current[4];
		 }

		if ($cc_obsj['font-weight'].indexOf('italic') > -1) {

		   $cc_obsj['font-weight'] = $cc_obsj['font-weight'].replace('italic', '');
		   $cc_obsj['font-style'] = 'italic';
		}

		if ($cc_obsj['font-weight'] === 'regular') {
		   $cc_obsj['font-weight'] = 400;
		}
		
		if ($cc_obsj['text-align'] === 'default') {
		   $cc_obsj['text-align'] = 'center';
		}	
		
		if ($cc_obsj['font-style'] === 'default') {
		   $cc_obsj['font-style'] = 'normal';
		}

		if ($cc_obsj['text-transform'] === 'default') {
		   $cc_obsj['text-transform'] = 'none';
		}
		
				
		 return $cc_obsj;  
	  },
	  
	  
	  ThzSetPreviewCss: function(){
		  
		  
		 var self 			= this;
		 var properties		= $(this.connected).find('[data-css-prop]');
		 var cssobject		= {};
		 
		 
		 if( properties.length  > 0 ){
		 
			$(self.element).find('.thz-text-shadow-color').addClass('using-connected-color');
		 
		 
			 properties.each(function(index, element) {
				
				  var $this = $(this);
				  var $prop = $(this).attr('data-css-prop');
				  var $val 	=  $this.val();

				  
				  if($prop =='font-size' || $prop =='letter-spacing'){
					  $val = thz.thz_property_unit($val,'px');
				  }
				  if($prop =='color'){
					  $val = thz.thz_replace_palette_colors($val);
				  }	
				  	
				  if($prop =='text-align' && $val == 'default'){
					  $val = 'center';
				  }
				  	 
				  if($prop =='font-style' && $val == 'default'){
					$val = 'normal';
				  }	
				  
				  if($prop =='text-transform' && $val == 'default'){
					$val = 'none';
				  }	
				  
				  if($prop =='letter-spacing' && ( $val == '' || $val == 0 || $val == undefined ) ){
					$val = 'normal';
				  }
				  
				  if($prop =='font-size' && ( $val == '' ||  $val == undefined ) ){
					$val = '28px';
				  }	 
				  
				  if($prop =='all'){
					  
					  $val = self.ThzTypoSplitVal($val);
					  
					  $.each($val,function(index,val){
						  
						  cssobject[index] = val;
					  });
					  
				  }else{
				  	
					cssobject[$prop] = $val;
					
				  }
				  
				  self.previewbox.css(cssobject);
				  
				  
				  $this.on('change keyup thz:typo:changed',function () {
					  
					  var $new_val = $(this).val(); 
					  
					  
					  if($prop =='font-size' || $prop =='letter-spacing'){
						  $new_val = thz.thz_property_unit($new_val,'px');
					  }
					  
					  if($prop =='color'){
						  $new_val = thz.thz_replace_palette_colors($new_val);
					  }	
					  
					  if($prop =='text-align' && $new_val == 'default'){
					  	$new_val = 'center';
				 	  }	
					  
					  if($prop =='font-style' && $new_val == 'default'){
					  	$new_val = 'normal';
				 	  }	

					  if($prop =='text-transform' && $new_val == 'default'){
						$new_val = 'none';
					  }	
					  
					  if($prop =='letter-spacing' && ( $new_val == '' || $new_val == 0 || $new_val == undefined ) ){
						$new_val = 'normal';
					  }

					  if($prop =='font-size' && ( $new_val == '' ||  $new_val == undefined ) ){
						$new_val = '28px';
					  }
					  
					  if($prop =='font-family' && $new_val == 'default'){
					 	$new_val = 'inherit';
					  }
						
					  if($prop =='all'){
						  
						  $new_val = self.ThzTypoSplitVal($new_val);
						  
						  $.each($new_val,function(index,val){
							  
							  cssobject[index] = val;
						  });
						  
					  }else{
						  
						  cssobject[$prop] = $new_val;
						  
					  }
					  
					  self.previewbox.css(cssobject);
				  });

			});
		
		}

	  },
	  
	  
	  ThzTextShadowCheck : function (){
		  
		var self 		= this;

		var hasshadows	= $(self.shadowsbox).find('.fw-option-type-addable-option-option').length;
		var showmsg		= $(self.shadowsbox).find('.has-shadows');

		if(hasshadows > 0){
			
			showmsg.addClass('show'); 
		}else{
			
			showmsg.removeClass('show'); 
		}

	  },
	  
	  ThzTextShadowCss: function (){
		  
		 var self 		= this;
		 var shadow 	= $(self.element).find('.fw-option-type-addable-option-option');
		 var css_print 	= $(self.element).find('.thz-text-shadow-css');
		 var name		= self.name;
		 
		 
		 if(self.previewbox.length > 0){
			 var p_bg 		= thz.thz_replace_palette_colors($(self.element).find('.thz_s_bg').val());
			 var p_co 		= thz.thz_replace_palette_colors($(self.element).find('.thz_s_co').val());
			 
			 
			 if (typeof(Storage) !== "undefined") {
				 
				 
				 if(localStorage.getItem(name +'_bg')){
					
					 localStorage.setItem(name +'_bg', p_bg);
					 
					 p_bg = localStorage.getItem(name +'_bg');
					 
				 }else{
					 
					 localStorage.setItem(name +'_bg', p_bg);
				 }
				 
				 if(localStorage.getItem(name +'_co')){
					
					 localStorage.setItem(name +'_co', p_co);
					 
					 p_co = localStorage.getItem(name +'_co');
					 
				 }else{
					 
					 localStorage.setItem(name +'_co', p_co);
				 }
	
			 }
		 }
		 
		 
		 var shadow_css = [];
		
		 $.each(shadow, function (index, element){

			 var hoffset		= $(element).find('.thz_h_offset').val();
			 var voffset		= $(element).find('.thz_v_offset').val();
			 var blurRadius		= $(element).find('.thz_blur_radius').val();
			 var shadowColor	= $(element).find('.thz_shadow_color').val();
			 var css 			= hoffset+'px ' + voffset+'px ' + blurRadius+'px ' + shadowColor;
			 
			 shadow_css.push(css); 

		 });
	 
		var text_shadow_metrics = shadow_css.join(', ');
		var text_shadow ='';
		if(text_shadow_metrics !=''){

			text_shadow += text_shadow_metrics;
		}
		
		
		
		css_print.val(text_shadow).trigger('thz:text:shadow:change');
		
		self.text.attr('style','text-shadow:'+thz.thz_replace_palette_colors(text_shadow)+';');
		$(self.element).find('.fw-option-type-addable-option-remove').addClass('thz-remove-shadow');
		$(self.element).trigger('thz:text:shadow');
		
		if(self.previewbox.length > 0){
			self.ThzChangePreviewCss(p_bg,p_co);
		}
		
		self.ThzTextShadowCheck();
	  },
	  
	 
	 ThzChangePreviewCss: function(bg,color,fontsize){
		 
		var self = this;
		
		var cssobj = {'background-color':bg};
		
		if(self.connected.length < 1){
			cssobj['color'] = color;
		}
		self.previewbox.css(cssobj);	
			 
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