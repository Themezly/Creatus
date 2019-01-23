/**
 * @package      Thz Framework
 * @copyright    Copyright(C) since 2015 FT Web Studio INC All Rights Reserved.
 * @author       Themezly
 * @license      http://opensource.org/licenses/MIT
 * @websites     http://www.themezly.com | http://www.youjoomla.com | http://www.yjsimplegrid.com
 */
;
(function($, window, document, undefined) {

    "use strict";

    var pluginName = "ThzGenerateCss",
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
            this.inputbox 	= $(this.element).find('.thz-boxstyle-css');
            this.previewbox = $(this.element).find('.thz-box-style-preview');
            this.dataname 	= $(this.element).attr('data-name');
            this.gradient 	= $(this.element).find('.thz-background-gradient');

            self.ThzCss();

        },


        ThzCss: function() {

            var self = this;
            self.ThzSetCss();
			
			$(document).on('updatecomplete', '.thz-boxstyle-holder :input', function(event) {
				 
				 var $current = $(this);
				 self.ThzCheckSiblings( $current );
				 
			});
			
            $(document).on('change keyup fw:thz:color:picker:changed thzslider', '.thz-boxstyle-holder :input', function(event) {
				
				var $current = $(this);
				
				self.ThzCheckNeighbours( $current );
				
				self.previewbox.trigger('change-preview');
				self.ThzSetCss();
				
            });

            $(document).on('thzgradient', '.thz-boxstyle-element-holder .thz-background-gradient', function(event) {
				self.previewbox.trigger('change-preview');
				self.ThzSetCss();
            });

            $(document).on('thzshadow', function(event) {
				self.previewbox.trigger('change-preview');
				self.ThzSetCss();
            });

        },

        ThzSetCss: function() {

            var self = this;
            var data = $(self.element).find(':input').serializeArray();
			var print_css = self.ThzGenerate(data);
            
			self.inputbox.val(print_css).trigger('change');
            self.previewbox.attr('style', thz.thz_replace_palette_colors( print_css ) );
			
			
			
        },
		
		

		
		ThzCheckNeighbours: function ($current){
			
			var self = this;
			
			var $class = $current.attr('class');
			
			if( $class && ( $class.match( /(padding|margin|borderradius)/ ) )){
			
				var $cid 	= $current.attr('id');
				var $cval 	= $current.val();
				
				$current.parents('.thz-box-style-element').find('.fw-option-type-thz-spinner').each(function(index, element) {
					
					var $input 	= $(element);
					var $iid 	= $input.attr('id');
					var $ival	= $input.val();
					
					if( $iid !== $cid ){
						
						
						if($cval !='' && $ival ==''){
							
							$input.val(0).trigger('thz:spinner:changed');
						
						} else if ($cval =='' && $ival !=''){
							
							$input.val('').trigger('thz:spinner:changed');
							
						}

					}
                    
                });
						
			}
		},
		
		
        ThzGenerate: function(data) {

            var self = this;
            var properties = {};

            $.each(data, function(index, oldName) {

                var newName = oldName.name.replace(self.dataname, '')
                    .replace('][', '-').replace(']', '').replace('[', '');

                if (newName != 'css') {

                    var thisValue = oldName.value;

                    properties[newName] = thisValue;

                }

            });

            return self.ThzPrintCss(properties);

        },

        ThzPrintCss: function(properties) {

            var self = this;

            var printcss = self.ThzPadding(properties);
            printcss += self.ThzMargin(properties);
            printcss += self.ThzBorders(properties);
            printcss += self.ThzBoxSize(properties);
            printcss += self.ThzBorderRadius(properties);
            printcss += self.ThzBoxShadow();
            printcss += self.ThzBackground(properties);

            return printcss;

        },
		

        ThzPadding: function(properties) {

            var self = this;

            var css = '';
            var h = 'padding-';
            var p = self.ThzIzolate(properties, h);
			
			p = self.ThzPtoO(p);
			
            if ($.isEmptyObject(p)){
				return css;
			}

            var csssarray = [];
			var has_none = Object.keys(p).some(function(k) {
				return p[k] === "none";
			});
			var shorthand = has_none ?  false : true;
			
            $.each(p, function(name, value) {

                if (value == 'none') {
                   return;
                }
				
                if (value == '') {
                    value = 0;
                }
				
				if(shorthand){
					
					var str = thz.thz_property_unit(String(value),'px');
					
				}else{
					
					var str = 'padding-' + name +':'+thz.thz_property_unit(String(value),'px')+';';
				}
				
                csssarray.push(str);
            });

            if (csssarray.length > 0) {
				
				var css = shorthand ? 'padding:' + csssarray.join(" ") + ';' : csssarray.join(" ");
            }
			
			csssarray = [];
            return css;

        },

        ThzMargin: function(properties) {

            var self = this;

            var css = '';
            var h = 'margin-';
            var p = self.ThzIzolate(properties, h);
			
			
			p = self.ThzPtoO(p);
			
			
            if ($.isEmptyObject(p)){
				return css;
			}

            var csssarray = [];
			var has_none = Object.keys(p).some(function(k) {
				return p[k] === "none";
			});
			var shorthand = has_none ?  false : true;

            $.each(p, function(name, value) {

                if (value == 'none') {
                   return;
                }
				
                if (value == '') {
                    value = 0;
                }
				
				if(shorthand){
					
					var str = thz.thz_property_unit(String(value),'px',true);
					
				}else{
					
					var str = 'margin-' + name +':'+thz.thz_property_unit(String(value),'px',true)+';';
				}
				
                csssarray.push(str);

            });

            if (csssarray.length > 0) {
				
				var css = shorthand ? 'margin:' + csssarray.join(" ") + ';' : csssarray.join(" ");
            }
			
			csssarray = [];

            return css;

        },

        ThzBorders: function(properties) {

            var self = this;

            var css = '';
            var h = 'borders-';
            var p = self.ThzIzolate(properties, h);

            if ($.isEmptyObject(p)){
				return css;
			}

            var csssarray = [];
            var allb_same = p['borders-all'];
            var sides = ['top', 'right', 'bottom', 'left'];
			var bordercss = {};
			var border_print = '';
			
			if(allb_same == 'separate'){
				
				bordercss['w'] = [];
				bordercss['s'] = [];
				bordercss['c'] = [];				
				
				for (var i in sides) {

					
					var $w = p['borders-' + sides[i]].w == '' ? 0 : p['borders-' + sides[i]].w;
					var $s = p['borders-' + sides[i]].s;
					var $c = p['borders-' + sides[i]].c == '' ? 'transparent' : p['borders-' + sides[i]].c;
					
					bordercss['w'].push($w + 'px');
					bordercss['s'].push($s);
					bordercss['c'].push($c);
	
				}
				
				border_print += 'border-width:' + bordercss['w'].join(" ") + ';';
				border_print += 'border-style:' + bordercss['s'].join(" ") + ';';
				border_print += 'border-color:' + bordercss['c'].join(" ") + ';';			
				
				csssarray.push(border_print);
				
				bordercss = {};
				
			}else{
				
				
				var bwidth = p['borders-top'].w == '' ? 0 : p['borders-top'].w;
				var bstyle = p['borders-top'].s;
				var bcolor = p['borders-top'].c == '' ? 'transparent' : p['borders-top'].c;

				border_print += 'border-width:' + bwidth + 'px;';
				border_print += 'border-style:' + bstyle + ';';
				border_print += 'border-color:' + bcolor + ';';				
				
				csssarray.push(border_print);
			}


            if (csssarray.length > 0) {
                var css = csssarray.join("");
            }
			
			bordercss = {};
			csssarray = [];
			
			
            return css;

        },

        ThzBoxSize: function(properties) {

            var self = this;

            var css = '';
            var h = 'boxsize-';
            var p = self.ThzIzolate(properties, h);
			
			p = self.ThzPtoO(p);
			
			
            if ($.isEmptyObject(p)){
				return css;
			}

            var csssarray = [];

            $.each(p, function(name, value) {

				var str = name.replace(h, '') + ':' + thz.thz_property_unit(String(value),'px',true,true) + ';';

                if (value != '') {
                    csssarray.push(str);
                }
            });

            if (csssarray.length > 0) {
                var css = csssarray.join("");
            }
			
			csssarray = [];
			
            return css;

        },

        ThzBorderRadius: function(properties) {

            var self = this;

            var css = '';
            var h = 'borderradius-';
            var p = self.ThzIzolate(properties, h);

            if ($.isEmptyObject(p)){
				return css;
			}

            var csssarray = [];

            $.each(p, function(name, value) {

                if (value == '') {
                    value = 0;
                }
				
				var str = thz.thz_property_unit(String(value),'px');
				
                csssarray.push(str);

            });

            if (csssarray.length > 0) {
                css = 'border-radius:' + csssarray.join(" ") + ';';
            }
			
			csssarray = [];
			
            return css;

        },
		
        ThzBoxShadow: function() {

            var self = this;
            var css = '';
            var box_shadow = $(self.element).find('.thz-box-shadow-css');

            if (box_shadow.length) {
                css = box_shadow.val();
            }
            return css;

        },

        ThzBackground: function(properties) {

            var self = this;

            var css = '';
            var h = 'background-';
            var p = self.ThzIzolate(properties, h);

            if ($.isEmptyObject(p)){
				return css;
			}

            var bg_type = p['background-type'];
            var bg_color = p['background-color'];
            var bg_image = p['background-image'];
			
			try{
				bg_image = JSON.parse(bg_image).url;
			}
			catch (error){
				
				bg_image = bg_image;
			}			

            var bg_repeat = p['background-repeat'];
            var bg_position = p['background-position'];
            var bg_size = (p['background-radiocheck-size'] == 'custom' ?
                p['background-size'] :
                p['background-radiocheck-size']);
            var bg_attachment = p['background-attachment'];
            var bg_video_link = p['background-video-link'];
            var bg_video_poster = p['background-video-poster'];
			
			try{
				bg_video_poster = JSON.parse(bg_video_poster).url;
			}
			catch (error){
				
				bg_video_poster = bg_video_poster;
			}

            if (bg_type == 'video' && bg_video_link !== '') {
				
				self.previewbox.removeClass('thz-bg-featuerd-image');
                self.previewbox.addClass('thz-bg-video-preview');

                if (bg_video_poster) {
                    css += "background-image:url(" + bg_video_poster + ");";
                }

            } else {

                self.previewbox.removeClass('thz-bg-video-preview thz-bg-featuerd-image');
            }

            if (bg_type == 'none'){
				
				self.previewbox.removeClass('thz-bg-featuerd-image');

				return css;
			}
			
			

            if (bg_type == 'gradient') {

                var gradientCSS = $(self.element).find('.thz-bg-gradient-preview');
                css = gradientCSS.attr('style');
                return css;
            }

            if (bg_color) {
                css += "background-color:" + bg_color + ";";
            }

            if (bg_type == 'image' && bg_image) {
				
				
				if(bg_image == 'featured'){
					
					css += "background-image:none;";
					self.previewbox.addClass('thz-bg-featuerd-image');
					
				}else{
					
					self.previewbox.removeClass('thz-bg-featuerd-image');
                	css += "background-image:url(" + bg_image + ");";
				
				}

                if (bg_repeat) {
                    css += "background-repeat:" + bg_repeat + ";";
                }

                if (bg_position) {
                    css += "background-position:" + bg_position.replace('-', ' ') + ";";
                }

                if (bg_size) {
                    css += "background-size:" + bg_size + ";";
                }

                if (bg_attachment) {
                    css += "background-attachment:" + bg_attachment + ";";
                }
            }

            return css;

        },

		ThzPtoO: function (p){
			
			var self = this;
			
            if ($.isEmptyObject(p)){
				return p;
			}

			var $first = Object.keys(p)[0];
			return p[$first];			
			
		},
		
		
		ThzCvdKey: function (key){
			
			var self = this;
			
			if (key.indexOf('[value_data]') > -1) {
				
				return key.replace('[value_data]','');
				
			}else if (key.indexOf('-value_data') > -1) {
				
				return key.replace('-value_data','');
			}
			
			return key;
			
		},
		
		ThzCvdVal: function (key,val){
			
			var self = this;

			if (key.indexOf('value_data') > -1) {

				return JSON.parse(val);
			}
			
			return val;
		},
		
				
        ThzIzolate: function(properties, hook) {

            var self = this;
            var newProperties = {};

            if (properties == undefined){
				 return;
			}

            $.each(properties, function(key, value) {

                if (key.indexOf(hook) > -1) {
					
					var newvalue 	= self.ThzCvdVal(key,value);
					var newkey 		= self.ThzCvdKey(key);
					
                    newProperties[newkey] = newvalue;
                }

            });
			
			return newProperties;
        },

        ThzArraySum: function array_sum(array) {

            var self = this;

            var key, sum = 0;

            if (array && typeof array === 'object' && array.change_key_case) {
                return array.sum.apply(array, Array.prototype.slice.call(arguments, 0));
            }

            // input sanitation
            if (typeof array !== 'object') {
                return null;
            }

            for (key in array) {
                if (!isNaN(parseFloat(array[key]))) {
                    sum += parseFloat(array[key]);
                }
            }

            return sum;
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

})(jQuery, window, document);
(function($) {
    $(document).on('mouseenter', '.thz-boxstyle-element-holder', function(event) {
        $(this).ThzGenerateCss();
    });
}(jQuery));