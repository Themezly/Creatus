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

    var pluginName = "ThzHotspots",
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


            this.preview 			= $(this.element).find('.thz-hotspots-preview');
            this.input 				= $(this.element).find('.thz-hotspots-input');
            this.hotspots 			= $(this.element).find('.thz-hotspot');
			this.hotspotsInfo		= $(this.element).find('.thz-hotspot-info');
			this.hotspotImage		= $(this.element).find('.thz-hotspot-image');
			this.addimage			= $(this.element).find('.hotspot-add-image');
			this.removeimage		= $(this.element).find('.hotspot-remove-image');
			this.removehotspots		= $(this.element).find('.hotspot-remove-hotspots');
			this.previewsize		= $(this.element).find('.hotspot-preview-size');
            this.current 			= self.input.val();

			try{
				
				this.hotspotsArrObj = JSON.parse(self.current);
			}
			catch (error){
				
				this.hotspotsArrObj 	= [];
			}
			
			
			self.ThzHotspotImage();		
            self.ThzCreateHotspots();
			self.ThzAddRemove();
        },
		
		
		
		ThzAddRemove: function() {
			
			var self = this;
			
			self.addimage.on('click', function(e) {
				
				e.preventDefault();
				
				self.hotspotImage.find('p > a').trigger('click');
			});
			
			self.removeimage.on('click', function(e) {
				
				e.preventDefault();
				
				self.hotspotImage.find('.clear-uploads-thumb').trigger('click');
				$(self.element).removeAttr('style');
			});
			

			
			self.removehotspots.on('click', function(e) {
				
				e.preventDefault();
				
				
				var removalconfirm = fw.soleConfirm.create({
				  severity: 'warning', 
				  message: 'Click OK to delete all hotspots.',
				  backdrop: false 
				});
				
				removalconfirm.result.then(function (confirm_instance) {
				
					$(self.element).find('.thz-hotspot').remove();
	
					self.hotspotsArrObj = [];
										
					self.input.trigger('change');
				});

				removalconfirm.show();
				
				

			});
			
			
			self.previewsize.on('click', function(e) {
				
				e.preventDefault();
				$(self.element).parents('.fw-backend-option-type-thz-hotspots').toggleClass('full-preview');
				
			});
		},

        ThzCreateHotspots: function() {


            var self = this;


			self.hotspots.each(function(index, element) {
                
				var $hotspot = $(this);
				self.ThzHotspotAction($hotspot);
				
            });
			
			
            self.preview.on('click', function(e) {

                if ($(e.target).is('.thz-hotspot')) {
                    return;
                }
                var $this = $(this);
                var $id = $this.find('.thz-hotspot').length;

                var $hotspot = $('<span>').
                attr('data-id', $id).
                attr('class', 'thz-hotspot').
                html($id + 1);

                var $top = e.offsetX;
                var $left = e.offsetY;

                $hotspot.css({
                    'left': $top - 13,
                    'top': $left - 13,
                });

                $this.append($hotspot);

                self.ThzSetHotspotData($id, $hotspot);

                self.input.trigger('change');

                self.ThzHotspotAction($hotspot);
            });

            self.input.on('change', function() {
                var $this = $(this);
                var $newdata = JSON.stringify(self.hotspotsArrObj);
				
				
				if(self.hotspotsArrObj.length > 0){
					
					$(self.element).addClass('has-hotspots');
					
				}else{
					
					$(self.element).removeClass('has-hotspots');
				}
				
                $this.val($newdata);
            });
        },

		ThzHotspotOptions: function (){
			
			var self = this;
					
			return JSON.parse(
				JSON.parse($(self.element).parent().attr('data-for-js')).join('{{')
			);			
		},
		
		ThzSetHotspotPopup: function($hotspot) {
			
			var self = this;
			
			var $id = $hotspot.attr('data-id');

			var modal = new fw.OptionsModal({
				title: 'Hotspot settings',
				options: self.ThzHotspotOptions(),
				values: {
					'mx': self.hotspotsArrObj[$id]['mx'],
					'link': self.hotspotsArrObj[$id]['link'],
					'tmx': self.hotspotsArrObj[$id]['tmx'],
					'tooltip': self.hotspotsArrObj[$id]['tooltip'],
				},
				size: 'large',
				modalCustomClass: 'thz-hotspot-modal'

			});
			
			modal.on('change:values', function(modal, values) {
				
				self.hotspotsArrObj[$id]['mx'] = values.mx;
				self.hotspotsArrObj[$id]['link'] = values.link;
				self.hotspotsArrObj[$id]['tmx'] = values.tmx;
				self.hotspotsArrObj[$id]['tooltip'] = values.tooltip;
				
				self.input.trigger('change');
								
			});
			
			 modal.on('render', function() {
				
				modal.content.$el.find('.thz-remove-hotspot').attr('data-remove',$id);
								
			});
			
			$hotspot.on('click', function(e) {
				modal.open();
			});
			
			$(document).one('click','.thz-remove-hotspot[data-remove="'+$id +'"]', function(e) {
				e.preventDefault();
				
				modal.close();
				
				var $this =  $(this);
				
				$hotspot.remove();

				self.hotspotsArrObj = $.grep(self.hotspotsArrObj, function(data, index) {
					return data.id != $id;
				});
								
				self.input.trigger('change');
				
			});
			
		},

        ThzSetHotspotData: function($id, $hotspot) {

            var self = this;
			
			var $data 		= {};
			var $tooltip 	= $(self.element).find('.thz-hotspot-info[data-id="'+$id +'"] textarea').val();
			var $options 	= self.ThzHotspotOptions();

            $data['id'] 	= $id;
            $data['top'] 	= $hotspot.position().top / self.preview.height() * 100;
            $data['left'] 	= $hotspot.position().left / self.preview.width() * 100;
			$data['mx'] 	= self.hotspotsArrObj[$id] !== undefined ? self.hotspotsArrObj[$id]['mx'] : $options[0].defaulttab.options.mx.value;
			$data['link'] 	= self.hotspotsArrObj[$id] !== undefined ? self.hotspotsArrObj[$id]['link'] : $options[0].defaulttab.options.link.value;
			$data['tmx'] 	= self.hotspotsArrObj[$id] !== undefined ? self.hotspotsArrObj[$id]['tmx'] : $options[1].tooltiptab.options.tmx.value;
			$data['tooltip'] = self.hotspotsArrObj[$id] !== undefined ? self.hotspotsArrObj[$id]['tooltip'] : $options[1].tooltiptab.options.tooltip.value;

            self.hotspotsArrObj[$id] = $data;
			
        },


		 ThzHotspotImage: function() {
			 
			 var self = this;

			 self.hotspotImage.on('fw:option-type:upload:change', function(el, data) {
				 
				 var $new_image = self.hotspotImage.find('.thumb').attr('data-origsrc');
				 self.preview.find('img').remove();
				 $(self.element).removeClass('has-image');
				 self.preview.prepend($('<img>').attr('src',$new_image));
				 $(self.element).addClass('has-image');
			});
			
			 self.hotspotImage.on('fw:option-type:upload:clear', function(el, data) {
				self.preview.find('img').remove();
				$(self.element).removeClass('has-image');
			});
		 },
		 
		 
        ThzPercentPosition: function($hotspot) {


            var self = this;

            var $top = $hotspot.position().top / self.preview.height() * 100;
            var $left = $hotspot.position().left / self.preview.width() * 100;

            $hotspot.css({
                'left': $left + '%',
                'top': $top + '%'
            });

        },

        ThzhotspotPosition: function(evt,el, hotspotsize, percent) {


            var self = this;

			var left = el.offset().left;
			var top = el.offset().top;
			var hotspot = hotspotsize ? hotspotsize : 0;
			var x,y;
			if (percent) {
			
				x = (evt.pageX - left - (hotspot / 2)) / el.outerWidth() * 100;
				y = (evt.pageY - top - (hotspot / 2)) / el.outerHeight() * 100;
			
			} else {
				
				x = (evt.pageX - left - (hotspot / 2));
				y = (evt.pageY - top - (hotspot / 2));
			}
			
			return {
				x: x,
				y: y
			};

        },

        ThzHotspotAction: function($hotspot) {
            var self = this;
           
		    $hotspot.draggable({
				containment: "parent"  
			});
           
		    self.ThzPercentPosition($hotspot);

            $hotspot.on("dragstop", function(e, ui) {

                var $this 	= $(this);
                var $id 	= $this.attr('data-id');
                var $top 	= e.pageX;
                var $left 	= e.pageY;


                self.ThzPercentPosition($hotspot);

                self.ThzSetHotspotData($id, $hotspot);

                self.input.trigger('change');
				
				
            });
			
			self.ThzSetHotspotPopup($hotspot);
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