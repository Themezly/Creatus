/**
 * @package      Thz Framework
 * @author       Themezly
 * @license      http://opensource.org/licenses/MIT
 * @websites     http://www.themezly.com | http://www.youjoomla.com | http://www.yjsimplegrid.com
 */
;
(function($, window, document, undefined) {

    "use strict";

    var pluginName = "ThzPalette",
        defaults = {
            somesetting: "somesetting",
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

            self.CreatePalette();
			self.ActivatePalette();
            self.PaletteClick();
			
        },

        ThemePalette: function() {
			
            var self = this;

			if ($('#fw-option-theme_palette').length > 0) {
		
				 var $theme_palette = JSON.parse($('#fw-option-theme_palette').attr('data-palette-set'));
		
			}else{
				 
				 var $theme_palette = JSON.parse(thz_picker_vars.thz_palette);
			}
			
			
			return $theme_palette;

        },


        CreatePalette: function() {

            var self = this;

			if ($('.thz-palette-menu').length > 0) {
				
				return;
			}

            var $theme_palette = self.ThemePalette();
			
            var $flat_palette = {};
            $flat_palette.turquoise = "#1abc9c";
            $flat_palette.emerald = "#2ecc71";
            $flat_palette.peterriver = "#3498db";
            $flat_palette.amethist = "#9b59b6";
            $flat_palette.wetaphalt = "#34495e";
            $flat_palette.greensea = "#16a085";
            $flat_palette.nephritis = "#27ae60";
            $flat_palette.belizehole = "#2980b9";
            $flat_palette.wisteria = "#8e44ad";
            $flat_palette.midnightblue = "#2c3e50";
            $flat_palette.sunflower = "#f1c40f";
            $flat_palette.carrot = "#e67e22";
            $flat_palette.alizarin = "#e74c3c";
            $flat_palette.clouds = "#ecf0f1";
            $flat_palette.conrete = "#95a5a6";
            $flat_palette.orange = "#f39c12";
            $flat_palette.pumpkin = "#d35400";
            $flat_palette.pomergranate = "#c0392b";
            $flat_palette.silver = "#bdc3c7";
            $flat_palette.aspestot = "#7f8c8d";


            var $metro_palette = {};
            $metro_palette.red = "#f44336";
            $metro_palette.pink = "#e91e63";
            $metro_palette.purple = "#9c27b0";
            $metro_palette.deeppurple = "#673ab7";
            $metro_palette.indigo = "#3f51b5";
            $metro_palette.blue = "#2196f3";
            $metro_palette.lightblue = "#03a9f4";
            $metro_palette.cyan = "#00bcd4";
            $metro_palette.teal = "#009688";
            $metro_palette.green = "#4caf50";
            $metro_palette.lightgreen = "#8bc34a";
            $metro_palette.lime = "#cddc39";
            $metro_palette.yellow = "#ffeb3b";
            $metro_palette.amber = "#ffc107";
            $metro_palette.orange = "#ff9800";
            $metro_palette.deeporange = "#ff5722";
            $metro_palette.brown = "#795548";
            $metro_palette.gray = "#9e9e9e";
            $metro_palette.bluegray = "#607d8b";

            var $palette_menu = '<ul class="thz-palette-menu">';
            $palette_menu += '<li class="palette-menu theme"><a class="palette-link" href="#" data-set="theme">' + thz_picker_vars.theme_txt + '</a></li>';
            $palette_menu += '<li class="palette-menu flat"><a class="palette-link" href="#" data-set="flat">' + thz_picker_vars.flat_txt + '</a></li>';
            $palette_menu += '<li class="palette-menu material"><a class="palette-link" href="#" data-set="material">' + thz_picker_vars.material_txt + '</a></li>';
            $palette_menu += '<li class="palette-menu picker"><a class="palette-link" href="#" data-set="picker">' + thz_picker_vars.picker_txt + '</a></li>';
            $palette_menu += '</ul>';


            var $palette_html = self.PaletteTemplate($theme_palette, 'theme');
            $palette_html += self.PaletteTemplate($flat_palette, 'flat');
            $palette_html += self.PaletteTemplate($metro_palette, 'material');


           $(document.body).append($palette_menu, $palette_html);
		   
		   self.ShowHidePalette();

 
        },
		
		
		ActivatePalette: function (){
			
			var self = this;
			 
           $(document.body).on('click', '.thz-color-picker-trigger', function(e) {

			   self.CreatePalette();

                var $input = $(this).parent().find('.fw-option-type-thz-color-picker');
                var $iriscontainer = $(this).parent().find('.thz-cp-palettes-colors');
                var $real_input = $(this).parent().find('.real-input');
                var $current = $real_input.val();

                $input.before($('.thz-palette-menu'));
                $iriscontainer.append($('.theme-palette'));
                self.PaletteActiveColor($input);
            });

            $(document.body).on('click', '.fw-option-type-thz-color-picker', function(e) {
				
				 self.CreatePalette();

                 self.ShowHidePalette(true);
            });

            $(document.body).on('click', '.thz-palette-box .thz-color-picker-trigger', function(e) {
				
				 self.CreatePalette();
				
                 self.ShowHidePalette(true);
            });


            $(document.body).on('click', '.resetcolor', function(e) {
				
				self.CreatePalette();
				
                var $input = $(this).parent().parent().parent().find('.fw-option-type-thz-color-picker');
                self.PaletteActiveColor($input);
            });			
		},

        PaletteTemplate: function($set, $set_name) {

            var self = this;

            var $palette_html = '<div class="theme-palette ' + $set_name + '">';
            $.each($set, function(index, val) {

                $palette_html += '<span class="palette-button ' + index + '" data-palette="' + $set_name + '" data-color="' + val + '"';
                $palette_html += ' style="background:' + val + ';" title="' + index + '"></span>';
            });
            $palette_html += '</div>';

            return $palette_html;

        },
		
		
		ThemePaletteShades: function($palette){
			
			var self = this;

			var $color = $palette['color_1'];
			$.each($palette, function(index, val) {
				
				 if (index.indexOf('darker') !== -1 || index.indexOf('lighter') !== -1 || index.indexOf('contrast') !== -1) {
					 
					 var $data = index.split('_');
					 var $shade = $data[1];
					 var $percent = $data[2] ? $data[2] : null;
					 
					 if($shade =='darker'){
						
						$palette[index]   = tinycolor( $color ).darken($percent).toString();
					 
					 }else if($shade =='lighter'){
						  
						 $palette[index]   = tinycolor( $color ).lighten($percent).toString();
						 
						 
					 }else if($shade =='contrast'){
						  
						 $palette[index]  = tinycolor( $color ).getBrightness() >= 128 || tinycolor( $color ).getAlpha() < 0.45 ? '#000000' : '#ffffff';
					 }
		
				 }

			});
			
			
			return $palette;
					
		},	
		
		ThemePalettePreviewColors: function() {

			var self = this;
			var $palette 	= self.ThemePaletteShades ( self.ThemePalette() );
			
			$.each($palette, function(index, val) {
				 
				 if ($('input.using-'+ index ).length > 0){
				 	var $input 				= $('input.using-'+ index );
					var $trigger 			= $input.parent().parent().find('.thz-color-picker-trigger');

					$input.parent().addClass('palette-color');
					$trigger.css('background-color', val);
		
				}
				
			});

		},		

		ThemePaletteChanged: function() {
			
			var self = this;
				 
			var $theme_palette 	= self.ThemePaletteShades ( self.ThemePalette() );
			var $palette_html 	= self.PaletteTemplate( $theme_palette, 'theme');

			$('.theme-palette.theme').replaceWith($($palette_html));
			
			$('.theme-palette.theme').addClass('new-palette');
			
			 self.ThemePalettePreviewColors();
			 thz_picker_vars.thz_palette = JSON.stringify($theme_palette);
				

		},

        ShowHidePalette: function($hide) {

            var self = this;

            if ($hide) {

                $('.thz-cp-palettes').hide();
				$('.thz-cp-palettes').parent().removeClass('pallets-shown');
                $('.palette-link').removeClass('active-palette');
                $('.picker a').addClass('active-palette');
                return;
            }

			$(document.body).on('click', '.palette-link', function(e) {

                e.preventDefault();
                $('.palette-link').removeClass('active-palette');
                $(this).addClass('active-palette');

                var $link = $(this).attr('data-set');

                if ($link == 'picker') {
                    $('.thz-cp-palettes').hide();
					$('.thz-cp-palettes').parent().removeClass('pallets-shown');
                    return;
                }

				if($link =='theme'){
					
					var $holder = $(this).parent().parent().parent();
					var $input  = $holder.find('input');
					
					if(	$input.hasClass('using-'+$input.val()) ){
						$(this).parent().parent().parent().addClass('palette-color');
					}
				}
				
                $('.theme-palette').hide();
                $('.thz-cp-palettes').show();
				$('.thz-cp-palettes').parent().addClass('pallets-shown');
                $('.theme-palette.' + $link).show();

            });

			$(document.body).on('click', '.palette-color-preview', function(e) {
               
			    $('.palette-menu.picker .palette-link').trigger('click');
				var $input = $(this).parent().find('.fw-option-type-thz-color-picker');
				var $palette_color = $('.palette-button.active-color').attr('title');
				var $current = thz.thz_replace_palette_colors($palette_color);
				$input.iris('color',$current);
				$input.val($palette_color);				
				
				
				setTimeout(function() {
					$input.parent().removeClass('palette-color');
					$input.select();
				 }, 50);

            });
        },


        PaletteActiveColor: function($input) {

            var self = this;

            $('.theme-palette.theme').removeClass('noclick');

            if ($input.hasClass('is-palette')) {// used by thz-palette option type only

                $('.theme-palette.theme').addClass('noclick');

            }

            var changeTimeoutId = 0;
            clearTimeout(changeTimeoutId);
            changeTimeoutId = setTimeout(function() {
				
                var $current = thz.thz_replace_palette_colors($input.val());
                var $button = $(".theme-palette:not(.noclick) .palette-button[data-color='" + $current + "']");
                var $palette = $button.attr('data-palette');
                $('.palette-button').removeClass('active-color');
                

                if ($palette == undefined) {
                    $palette = 'picker';
                }
				
				
				if($palette =='theme' && !$input.hasClass('using-'+$input.val())){
					$palette = 'picker';
				}
				
				if ($palette != 'picker') {
					
					$button.addClass('active-color');
					
				}

                $(".palette-link[data-set='" + $palette + "']").trigger('click');
				$('.thz-typography-preview').trigger('change');
				
            }, 5);

			
        },


        PaletteClick: function() {

            var self = this;

            $(document.body).on('click', '.palette-button', function(e) {

                e.preventDefault();
                var $new_color = $(this).attr('data-color');
                var $set = $(this).attr('data-palette');
                var $name = $(this).attr('title');
                var $input = $(this).parents('.thz-color-picker-holder-in').find('.fw-option-type-thz-color-picker');

                if ($set !== 'theme') {

                    $input.iris('color', $new_color);

                } else {


                    if ($(this).parents('.fw-option-type-thz-palette').length) {

                        return;

                    }

                    $input.iris('color', $new_color).thzAlterClass('using-*');
                    $input.parent().addClass('palette-color');
					$input.val($name).addClass('using-' + $name).trigger('change');


                }
                self.PaletteActiveColor($input);

            });

        },

    });
	
	
    (function() {
        var ev = new $.Event('stylechange'),
            orig = $.fn.css;
        $.fn.css = function() {
            $(this).trigger(ev);
            return orig.apply(this, arguments);
        }
    })();
	
    $.fn.thzAlterClass = function(removals, additions) {

        var self = this;

        if (removals.indexOf('*') === -1) {
            // Use native jQuery methods if there is no wildcard matching
            self.removeClass(removals);
            return !additions ? self : self.addClass(additions);
        }

        var patt = new RegExp('\\s' +
            removals.replace(/\*/g, '[A-Za-z0-9-_]+').split(' ').join('\\s|\\s') +
            '\\s', 'g');

        self.each(function(i, it) {
            var cn = ' ' + it.className + ' ';
            while (patt.test(cn)) {
                cn = cn.replace(patt, ' ');
            }
            it.className = $.trim(cn);
        });

        return !additions ? self : self.addClass(additions);
    };
	
    $.fn[pluginName] = function(options, additionaloptions) {
        return this.each(function() {
            if (!$.data(this, 'plugin_' + pluginName)) {
                $.data(this, 'plugin_' + pluginName, new Plugin(this, options));
            } else if (Plugin.prototype[options]) {
                $.data(this, 'plugin_' + pluginName)[options](additionaloptions);
            }
        });
    }

})(jQuery, window, document); // JavaScript Document



(function($) {
    $(document).ready(function() {
        $(document).ThzPalette();
    });
}(jQuery));