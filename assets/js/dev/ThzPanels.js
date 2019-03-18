 /**
 * @plugin		ThzPanels
 * @version		1.0.0
 * @package		Thz Framework
 * @copyright	Copyright(C) since 2015  Themezly.com. All Rights Reserved.
 * @author		Themezly
 * @license		MIT License (MIT) http://www.opensource.org/licenses/mit-license.php
 * @websites	http://www.themezly.com | http://www.youjoomla.com
 */
;
(function($, window, document, undefined) {

   "use strict";

   var pluginName = "ThzPanels",
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

		
            self.setPanel();
			
            $(window).on('resize', function() {
				self.panelResize();
            });		
		
      },
	  
        panelResize: function () {

            var self = this;
			
			$('#thz_toppanel:not(.panelOpen)').each(function () {
				
				var container = $(this).find('.thz-panel-content');
				$(this).css({
					'height':container.height(),
					'top':-container.height()
				});
				$(this).find('.thz-panel-sizer').css('height',container.height());
				
			});
			
			$('#thz_botpanel:not(.panelOpen)').each(function () {
				
				var container = $(this).find('.thz-panel-content');
				$(this).css({
					'height':container.height(),
					'bottom':-container.height()
				});
				$(this).find('.thz-panel-sizer').css('height',container.height());
				
			});
			
            $('.panelOpen:not(#thz_sidepanel)').each(function () {

                var container = $(this).find('.thz-panel-content');

                $(this).stop(true).animate({
                    height: container.height()
                });

                $(this).find('.thz-panel-sizer').stop(true).animate({
                    height: container.height()
                });
            });
        },
		
		
        setPanel: function () {

            var self = this;
			
			
			$(document).on('click', function (event) {
				event.stopImmediatePropagation();
				if ($(event.target).parents('.panelOpen').length == 0) {
					$('.panelOpen').find('.thz-panel-open').trigger('click');
				}
			
			});
			
            $('.thz-panel-open').each(function () {

                var panel 			= '#' +$(this).parent().attr('id');
                var getDirection 	= $(panel).data('direction');
                var tranSpeed 		= $(panel).data('speed');
                var panelHeight 	= $(panel).find('.thz-panel-content').height();
                var panelSizer 		= $(panel).find('.thz-panel-sizer');
				var openerWidth		= $(this).outerWidth();
				var openerHeight	= $(this).outerHeight();


					
					
                switch (panel) {
                case '#thz_toppanel':
                case '#thz_botpanel':
					var side = getDirection == 'top' ? 'bottom':'top';
					$(this).css(side,- openerHeight);
					
                    $(panel).css('height', panelHeight);
                    $(panel).css(getDirection, -panelHeight);
                    $(panelSizer).css('height', panelHeight);
                    break;

                case '#thz_sidepanel':
				
					var panelWidth 		= $(panel).data('width');
					$(panel).css('width', panelWidth);
					
					if(getDirection == 'left'){
						
						$(panel).css('left', '-'+panelWidth+'');
						
					}else{
						
						$(panel).css('right', '-'+panelWidth+'');
					}
					
					var side = getDirection == 'left' ? 'right':'left';
					$(this).css(side,- openerWidth);

                    break;
                }

                $(this).click(function (e) {
					
					e.preventDefault();
                    e.stopPropagation();
                    var getPoz = parseInt($(panel).css(getDirection));
                    switch (panel) {

                    case '#thz_toppanel':

                        if (getPoz < 0) {

                            $(panel).addClass('panelOpen');
                            $(panel).animate({
                                'top': 0
                            }, tranSpeed);

                        } else {

                            $(panel).animate({
                                'top': -$(panelSizer).height()
                            }, tranSpeed);

                            $(panel).removeClass('panelOpen');
                        }

                        break;

                    case '#thz_botpanel':

                        if (getPoz < 0) {
                            $(panel).addClass('panelOpen');
                            $(panel).animate({
                                'bottom': 0
                            }, tranSpeed);
                        } else {

                            $(panel).animate({
                                'bottom': -$(panelSizer).height()
                            }, tranSpeed);
                            $(panel).removeClass('panelOpen');
                        }

                        break;

                    case '#thz_sidepanel':
						
						if (getPoz < 0) {
							$(panel).addClass('panelOpen');
							if(getDirection == 'right'){
								$(panel).animate({
									'right': 0
								}, tranSpeed);
							}else{
								$(panel).animate({
									'left': 0
								}, tranSpeed);									
								
							}
						} else {
							if(getDirection == 'right'){
								$(panel).animate({
									'right': -$(panel).width()
								}, tranSpeed);
							}else{
								$(panel).animate({
									'left': -$(panel).width()
								}, tranSpeed);									
							}
							$(panel).removeClass('panelOpen');
						}
						

                        break;
                    }

                });

            });

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
     
})(jQuery, window, document);
