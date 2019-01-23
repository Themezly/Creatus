;
(function($, window, document, undefined) {

    "use strict";

    var pluginName = "ThzMenuPreview",
        defaults = { /**/ };

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

            self.start();

        },

        start: function() {

            var self = this;

            self.headerSide();
            self.toplevelHeight();

            self.toplevelRadius();
            self.subulRadius();
            self.sublevelWidth();
            self.sublevelHeight();
            self.sublevelTopoffset();
            self.sublevelLeftoffset();
            self.mainmenuColors();
            self.indicatorIcons();

            self.mainmenuBoxstyle('[data-tminputid="tm_tl_boxstyle"]', '.tm_toplevel a');
            self.mainmenuBoxstyle('[data-tminputid="tm_sl_boxstyle"]', '.tm_sublevel a');
            self.mainmenuBoxstyle('[data-boxstyle="logo_boxstyle"]', '.thz-logo-option .thumb');

            self.styleChange('[data-tminputid="tm_subul_style"]', '.tm_sublevel,.tm_childul');
            self.styleChange('[data-tminputid="tm_boxstyle"]', '.tm_toplevel');
            self.styleChange('[data-tminputid="tm_subli_border"]', '.tm_sublevel li');
            self.styleChange('[data-tmborders="tm_tl_border"]', '.tm_link a');
            self.styleChange('[data-tmborders="tm_link_hover_border"]', '.tm_hovered a');
            self.styleChange('[data-tmborders="tm_active_link_border"]', '.tm_active a');

            $('.thz-mainmenu-css-collector a').on("click", function(e) {
                e.preventDefault();
            });

            self.mainmenuFontCss();
        },

        styleChange: function(selector, itemtochange) {
            var self = this;

            $(selector).find('.thz-boxstyle-css').on('change', function() {

                var $changing = $(selector).data('changing') ? $(selector).data('changing').split(',') : null;

                $.each($changing, function(index, property) {
                    $(itemtochange).css(property, '');
                });

                var $newstyle = self.cssToObj($(this).val());
                $(itemtochange).css($newstyle);

                $('.thz-mainmenu-css-collector').trigger('menu:preview:changed');
				
				
            }).trigger('change');

            self.toplevelSpacing();

        },

        cssToObj: function(css) {

            var self = this,
                css = thz.thz_replace_palette_colors(css),
                cssObj = {},
                cssArr = css.split(';');

            for (var i = 0; i < cssArr.length; i++) {
                var declaration = cssArr[i].split(':');
                cssObj[declaration.splice(0, 1)[0]] = declaration.join(':');
            }

            return cssObj;
        },

        headerSide: function() {

            var self = this;

            var $inbutton = $('#fw-option-custom_header_options');

            if ($inbutton.length) {

                var $inbuttonval = $inbutton.find('.input-wrapper input');

                if ($inbuttonval.length) {

                    var $header_js = $inbuttonval.val();
                    var $header_options = JSON.parse($header_js);
                    var header_layout = $header_options.headers;

                } else {

                    var header_layout = $('.thz-mainmenu-css-collector').attr('data-header-side');
                }

                if (header_layout == 'left' || header_layout == 'right' || header_layout == 'mini') {

                    $('.thz-mainmenu-css-collector').addClass('header_side');

                } else {

                    $('.thz-mainmenu-css-collector').removeClass('header_side');
                }

                self.toplevelSpacing();

                return;
            }

            //$(document).on('change', '.thz_option_headers select', function (){
            $('.thz_option_headers select').on('change', function() {
                var header_layout = $(this).val();

                if (header_layout == 'left' || header_layout == 'right' || header_layout == 'mini' || header_layout == 'miniright' || header_layout == 'offcanvas' || header_layout == 'overlay') {

                    $('.thz-mainmenu-css-collector').addClass('header_side');

                } else {
                    $('.thz-mainmenu-css-collector').removeClass('header_side');
                }

                self.toplevelSpacing();

            }).trigger('change');

        },

        collectCSS: function() {
            var self = this;
            var allelements = $('.thz-mainmenu-css-collector').html();
            $('.thz-mainmenu-css-values').val(allelements);
        },

        previewFonts: function() {
            var self = this;
            self.setFontsCSS('.thztoplevelfont', '.tm_toplevel');
            self.setFontsCSS('.thzsublevelfont', '.tm_sublevel');
        },

        setFontsCSS: function(collect, apply) {

            var self = this;

			/*$('.thztoplevelfont .thz-font-input').trigger('click');
			$('.thzsublevelfont .thz-font-input').trigger('click');
			$('#thz-font-selector').removeClass('thz-fonts-opened').addClass('thz-fonts-closed');
*/
            $(collect).on('typochanged', function() {

                var fontbox = $(this).find('.thz-typography-preview');
                var family = fontbox.css('font-family');
                var size = fontbox.css('font-size');
                var style = fontbox.css('font-style');
                var weight = fontbox.css('font-weight');
                var transform = fontbox.css('text-transform');
                var letterspacing = fontbox.css('letter-spacing');
				
				var taselect = fontbox.parent().find('#thz-text-align').val();
                var textalign = taselect !='default' && taselect != undefined ? fontbox.css('text-align') : 'left';
				
				console.log(taselect);
				
                $(apply).css({
                    'font-family': family,
                    'font-size': size,
                    'font-style': style,
                    'font-weight': weight,
                    'text-transform': transform,
                    'letter-spacing': letterspacing,
                    'text-align': textalign
                });
                
				$('.thz-mainmenu-css-collector').trigger('menu:preview:changed');
				
            });

        },

        indicatorIcons: function() {
            var self = this;

            $('.thz-child-toplevel .thz-icon-input').on('change', function() {
				
                var $icon = $(this).val();
                $('.child-toplevel').removeAttr('class').addClass('childicon child-toplevel ' + $icon);
				
            }).trigger('change');

            $('.thz-child-sublevel .thz-icon-input').on('change', function() {
                
				var $icon = $(this).val();
                $('.child-sublevel').removeAttr('class').addClass('childicon child-sublevel ' + $icon);
				
            }).trigger('change');
        },

        mainmenuFontCss: function() {

            var self = this;

            self.previewFonts();
        },

        mainmenuColors: function() {
            var self = this;


            var element = $('.fw-option-type-thz-color-picker[data-tminputid]');

            $(element).on('change fw:thz:color:picker:changed iris-empty fw:thz:color:picker:palette', function() {

                var lookfor = $(this).attr('data-tminputid');
                var stylefor = $('[data-' + lookfor + ']');
                var cssproperty = $('[data-' + lookfor + ']').attr('data-' + lookfor);
                var colortoset = $(this).val();

                if (colortoset.indexOf('color_') !== -1) {

                    colortoset = thz.thz_replace_palette_colors(colortoset);
                }


                if (cssproperty.indexOf("border") == -1) {
                    $(stylefor).css(cssproperty, colortoset);
                }

                $('.thz-mainmenu-css-collector').trigger('menu:preview:changed');


            }).trigger('change');


        },

        toplevelHeight: function() {

            var self = this;

            $('[data-tminputid="tm_tl_height"]').find('input.thz-slider-custom').on('thzslider', function(e) {

                var height = $(this).val();
                $('.tm_toplevel a').animate({

                    'height': height,
                    'line-height': height

                }, {
                    duration: 200,
                    complete: function() {
                        $('.thz-mainmenu-css-collector').trigger('menu:preview:changed');
                    }
                });

            }).trigger('thzslider');

        },

        sublevelWidth: function() {

            $('[data-tminputid="tm_subul_link_width"]').find('input.thz-slider-custom').on('thzslider', function(e) {

                var width = $(this).val();

                $('.tm_childul').animate({
                    'left': width,
                    'width': width
                }, 200, function() {
                    $('.tm_sublevel').animate({
                        'max-width': width
                    }, {
                        duration: 200,
                        complete: function() {
                            $('.thz-mainmenu-css-collector').trigger('menu:preview:changed');
                        }
                    });
                });

            }).trigger('thzslider');

        },

        sublevelHeight: function() {

            $('[data-tminputid="tm_subul_link_height"]').find('input.thz-slider-custom').on('thzslider', function(e) {

                var height = $(this).val();

                $('.tm_sublevel a').animate({
                    'line-height': height
                }, {
                    duration: 200,
                    complete: function() {
                        $('.thz-mainmenu-css-collector').trigger('menu:preview:changed');
                    }
                });

            }).trigger('thzslider');

        },

        sublevelTopoffset: function() {

            $('[data-tminputid="tm_top_offset"]').find('input.thz-slider-custom').on('thzslider', function(e) {

                var topoffset = $(this).val();

                $('.tm_sublevel').animate({
                    'margin-top': topoffset
                }, {
                    duration: 200,
                    complete: function() {
                        $('.thz-mainmenu-css-collector').trigger('menu:preview:changed');
                    }
                });

            }).trigger('thzslider');

        },

        sublevelLeftoffset: function() {

            $('[data-tminputid="tm_left_offset"]').find('input.thz-slider-custom').on('thzslider', function(e) {

                var leftoffset = $(this).val();

                $('.tm_childul').animate({
                    'margin-left': leftoffset
                }, {
                    duration: 200,
                    complete: function() {
                        $('.thz-mainmenu-css-collector').trigger('menu:preview:changed');
                    }
                });

            }).trigger('thzslider');

        },

        toplevelSpacing: function() {

            $('[data-tminputid="tm_tl_spacing"]').find('input.thz-slider-custom').on('thzslider', function(e) {

                var spacing = $(this).val();

                if ($('.thz-mainmenu-css-collector').hasClass('header_side')) {

                    //$('#fw-backend-option-fw-option-tm_top_offset').hide();

                    $('.tm_toplevel li').animate({
                        'margin-bottom': spacing,
                        'margin-right': 0
                    }, {
                        duration: 200,
                        complete: function() {
                            $('.thz-mainmenu-css-collector').trigger('menu:preview:changed');
                        }
                    });

                } else {

                    //$('#fw-backend-option-fw-option-tm_top_offset').show();

                    $('.tm_toplevel li').animate({
                        'margin-right': spacing,
                        'margin-bottom': 0
                    }, {
                        duration: 200,
                        complete: function() {
                            $('.thz-mainmenu-css-collector').trigger('menu:preview:changed');
                        }
                    });
                }

            }).trigger('thzslider');

        },

        toplevelRadius: function() {

            $('[data-tminputid="tm_tl_radius"]').find('input.thz-slider-custom').on('thzslider', function(e) {

                var radius = $(this).val();

                $('.tm_toplevel a').animate({
                    'border-radius': radius
                }, {
                    duration: 200,
                    complete: function() {
                        $('.thz-mainmenu-css-collector').trigger('menu:preview:changed');
                    }
                });

            }).trigger('thzslider');

        },

        subulRadius: function() {

            $('[data-tminputid="tm_subul_radius"]').find('input.thz-slider-custom').on('thzslider', function(e) {

                var radius = $(this).val();

                $('.tm_sublevel').animate({
                    'border-radius': radius
                }, {

                    duration: 200,
                    complete: function() {
                        $('.thz-mainmenu-css-collector').trigger('menu:preview:changed');
                    }
                });

                $('.tm_sublevel li:first-child').animate({
                    'border-top-left-radius': radius,
                    'border-top-right-radius': radius
                }, {
                    duration: 200,
                    complete: function() {
                        $('.thz-mainmenu-css-collector').trigger('menu:preview:changed');
                    }
                });

                $('.tm_sublevel li:last-child').animate({
                    'border-bottom-left-radius': radius,
                    'border-bottom-right-radius': radius
                }, {
                    duration: 200,
                    complete: function() {
                        $('.thz-mainmenu-css-collector').trigger('menu:preview:changed');
                    }
                });

                $('.tm_sublevel li:first-child a').animate({
                    'border-top-left-radius': radius,
                    'border-top-right-radius': radius
                }, {
                    duration: 200,
                    complete: function() {
                        $('.thz-mainmenu-css-collector').trigger('menu:preview:changed');
                    }
                });

                $('.tm_sublevel li:last-child a').animate({
                    'border-bottom-left-radius': radius,
                    'border-bottom-right-radius': radius
                }, {
                    duration: 200,
                    complete: function() {
                        $('.thz-mainmenu-css-collector').trigger('menu:preview:changed');
                    }
                });

            }).trigger('thzslider');
        },

        mainmenuBoxstyle: function(selector, itemtochange) {

            var self = this;

            var paddings = [selector + " .padding-top", selector + " .padding-right", selector + " .padding-bottom", selector + " .padding-left"];

            $(paddings).each(function(index, element) {

                $(element).on('change', function(e) {

                    var value = $(this).val();
                    if ($(this).hasClass('padding-top')) {
                        $(itemtochange).css({
                            'padding-top': value + "px"
                        });
                    }

                    if ($(this).hasClass('padding-right')) {
						
						if(selector =='[data-tminputid="tm_sl_boxstyle"]'){
							
							var chil_icon_p = value > 0 ? value / 2 : 10;
							
							$('.child-sublevel').css({
								'right': chil_icon_p + "px"
							});							
						}
						
                        $(itemtochange).css({
                            'padding-right': value + "px"
                        });
                    }

                    if ($(this).hasClass('padding-bottom')) {
                        $(itemtochange).css({
                            'padding-bottom': value + "px"
                        });
                    }

                    if ($(this).hasClass('padding-left')) {
                        $(itemtochange).css({
                            'padding-left': value + "px"
                        });
                    }

                    $('.thz-mainmenu-css-collector').trigger('menu:preview:changed');
					
                }).trigger('change');

            });

            var margins = [selector + " .margin-top", selector + " .margin-right", selector + " .margin-bottom", selector + " .margin-left"];

            $(margins).each(function(index, element) {

                $(element).on('change', function(e) {

                    var value = $(this).val();
                    var sufffix = "px";
                    if (value == 'auto') {
                        sufffix = '';
                    }
                    var effectitem = itemtochange;

                    if (itemtochange == '.tm_toplevel') {

                        effectitem = '.mainmenu_preview_holder';
                    }
                    if ($(this).hasClass('margin-top')) {
                        $(effectitem).css({
                            'margin-top': value + sufffix
                        });
                    }

                    if ($(this).hasClass('margin-right')) {
                        $(effectitem).css({
                            'margin-right': value + sufffix
                        });
                    }

                    if ($(this).hasClass('margin-bottom')) {

                        $(effectitem).css({
                            'margin-bottom': value + sufffix
                        });
                    }

                    if ($(this).hasClass('margin-left')) {
                        $(effectitem).css({
                            'margin-left': value + sufffix
                        });
                    }
                    $('.thz-mainmenu-css-collector').trigger('menu:preview:changed');
					
                }).trigger('change');

            });

        },

    });

    $.fn[pluginName] = function(options, additionaloptions) {
        return this.each(function() {
            if (!$.data(this, 'plugin_' + pluginName)) {
                $.data(this, 'plugin_' + pluginName, new Plugin(this, options));
            } else if (Plugin.prototype[options]) {
                $.data(this, 'plugin_' + pluginName)[options](additionaloptions);
            }
        });
    }

})(jQuery, window, document);