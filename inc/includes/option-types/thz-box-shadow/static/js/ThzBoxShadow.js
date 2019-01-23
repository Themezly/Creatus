;
(function($, window, document, undefined) {

   "use strict";

   var pluginName = "ThzBoxShadow",
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
		
		
  		 this.addshadow = $(this.element).find('.fw-option-type-addable-option-add');
		
		
		 $(this.addshadow).on('click',function () {
				setTimeout(function() {
				   self.ThzBoxShadowCss();
				}, 300);
		 });
		 
		 $(document).on('click','.thz-remove-shadow', function(){
			 
				setTimeout(function() {
				   self.ThzBoxShadowCss();
				}, 300);			

		 });
		 
		 $(document).on('change keyup fw:thz:color:picker:changed thzshadow','.thz-shadows-holder :input', function(){
			 
			self.ThzBoxShadowCss();

		 });
		 
		 $(this.element).find('.fw-option-type-addable-option').on('change', function (){
			 
			 self.ThzBoxShadowCss();
		 });

		 
		 self.ThzBoxShadowCss();
		
      },
	  
	  ThzBoxShadowCss: function (){
		  
		 var self 		= this;
		 var shadow 	= $(this.element).find('.fw-option-type-addable-option-option');
		 var css_print 	= $(this.element).find('.thz-box-shadow-css');
		 var shadow_css = [];
		
		 $.each(shadow, function (index, element){
			 
			 
			 
			 var inset 		='';
			 var getinset 	= $(element).find('.thz_shadow_inset').prop('checked');
			 
			 if(getinset == true){
				 inset ='inset ';
			 }
			 
			 var hoffset		= $(element).find('.thz_h_offset').val();
			 var voffset		= $(element).find('.thz_v_offset').val();
			 var blurRadius		= $(element).find('.thz_blur_radius').val();
			 var spreadRadius	= $(element).find('.thz_spread_radius').val();
			 var shadowColor	= $(element).find('.thz_shadow_color').val();
			 
			 var css = inset + hoffset+'px ' + voffset+'px ' + blurRadius+'px ' + spreadRadius+'px ' + shadowColor;
			 
			 shadow_css.push(css); 

		 });
		 
		    var box_shadow_metrics = shadow_css.join(',');
			var box_shadow ='';
			if(box_shadow_metrics !=''){
				
/*				box_shadow += '-webkit-box-shadow:'+ box_shadow_metrics +';';
				box_shadow += '-moz-box-shadow:'+ box_shadow_metrics +';';*/
				box_shadow += 'box-shadow:'+ box_shadow_metrics +';';
			}
		
			css_print.val(box_shadow);
			
			$(self.element).find('.fw-option-type-addable-option-remove').addClass('thz-remove-shadow');
			$(self.element).trigger('thzshadow');
		 
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