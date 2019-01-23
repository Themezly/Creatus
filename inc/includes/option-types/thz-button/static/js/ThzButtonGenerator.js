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

    var pluginName = "ThzButtonGenerator",
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

            this.CssData = new Object();
            this.newMetrics = new Object();
            this.vPadding = $(this.element).find('.setting-input');
            this.styleid = $(this.element).attr('id');
            this.previewBox = $(this.element).find('.thz-btn-gen-preview');
            this.previewBtnCon = $(this.element).find('.thz-btn-gen-preview .thz-btn-container');
            this.previewBtn = this.previewBtnCon.find('.thz-button');
            this.customButtons = $(this.element).find('.thz-btn-custom-holder');
            this.elid = $(this.element).attr('id');
			
            this.CssData['createButton'] = $(this.element).find('.createButton').prop('checked');

            this.previewBtn.on('click', function(e) {
                e.preventDefault();
            });
			
			
            if (!$('#' + this.styleid + 'thz-btn-style').lengh) {
                $("head").append('<style id="' + this.styleid + 'thz-btn-style" type="text/css"></style>');
            }
            if (!$('#' + this.styleid + 'thz-custom-btn-style').lengh) {
                $("head").append('<style id="' + this.styleid + 'thz-custom-btn-style" type="text/css"></style>');
            }
		


			$(self.element).find('.thz-select-link').ThzAddLink({mode:'single'});
			
			$(self.element).find('.thz-btn-show-data').on('click',function (){
				
				$(self.element).find('.thz-button-html-print,.thz-button-css-print,.thz-button-json-print')
				.toggleClass( "show_data" );
			});


			
            self.ThzLoadTabs();
            self.ThzLoadIcons();
            self.ThzPickColor();
            self.ThzPreloadButton();
            self.ThzButtonType();
            self.ThzCustomSize();
            self.ThzChecksChange();
            self.ThzSelectsChange();
            self.ThzTexthange();
            self.ThzRadioChange();
            self.ThzSliderOptions();
            self.ThzButtonHtml();
            self.ThzButtonStyles();
            self.ThzBtnCustomCss();
            self.ThzBtnHelp();
            self.ThzAddButton();
			self.ThzButtonGfont();
			self.ThzThemeButtonColors();
			self.ThzButtonShadowEffects();
            self.ThzObserveCssData();

        },
		
        ThzObserveCssData: function() {
            var self = this;

            self.ThzBtnApplyCss();
            self.ThzPrintButtonData();
            watch(self.CssData, function(e) {

                self.CssData['allchanged'] = Math.random();
            });

            watch(self.CssData, ["allchanged"], function(e) {

                self.ThzButtonHtml();
                self.ThzBtnApplyCss();

                self.ThzPrintButtonData();

            });

            watch(self.CssData, ["buttonchanged"], function(e) {
                self.newMetrics = {};
            });

        },

		ThzButtonShadowEffects: function(){

			
			$(document).on({
				mouseenter: function () {
					 $(this).addClass('is-shown');
				},
			
				mouseleave: function () {
					$(this).removeClass('is-shown');
				}
			}, '.thz-btn-sh-ishidden');
					
			$(document).on({
				mouseenter: function () {
					$(this).addClass('is-hidden');
				},
			
				mouseleave: function () {
					$(this).removeClass('is-hidden');
				}
			}, '.thz-btn-sh-hide');
						
		},
		
		ThzButtonGfont: function (){
			
			var self = this;
			$(self.element).find('[data-css-hook="fontFamily"],[data-css-hook="SubTextfontFamily"]').chosen();
			$(self.element).find('[data-css-hook="fontFamily"],[data-css-hook="SubTextfontFamily"]').on('change',function(){
				
				var $datalink = $('option:selected', this).attr('data-link');
				var $current  = $(this).attr('data-css-hook');
				
				if($datalink){
					
					$current = $current == 'fontFamily' ? 'MainText':'SubSub';
					var $datafamily = $('option:selected', this).attr('data-family');
					var $datafont = $('option:selected', this).attr('data-font');
					var $handle = $(this).val();
					
					$("style[id$="+$current+"]").remove();
					$("link[id$="+$current+"]").remove();

					var $head_css ='<style id="'+$handle+$current+'" type="text/css">';
						$head_css +='.'+$handle+'{';
						$head_css +='font-family:\''+$datafamily+'\',sans-serif;';
						$head_css += $datafont;
						$head_css +='</style>';
						
					var $head_link 	='<link rel="stylesheet" id="'+$handle+'-gf-'+$current+'"  href="';
						$head_link 	+='//fonts.googleapis.com/css?family='+$datalink+'';
						$head_link 	+='" type="text/css" media="all" />';
					
					$("head").append($head_link + $head_css);

				}
				
			}).trigger('change');
			
		},

        ThzSaveButton: function(name, html, css, json) {

            var self = this;

            var container = $(self.element).find('.customButtonStyles');
            var buttonNames = JSON.parse(container.attr('data-names'));

            self.customMsg(_thzbtn.saving + name, '<img src="' + fw.img.loadingSpinner + '" style="vertical-align: top;" /> ' + _thzbtn.pleasewait, 'savingbutton');

            $.ajax({
                url: ajaxurl,
                type: 'POST',
                data: {
                    'action': 'thz_save_button',
                    'name': name,
                    'html': html,
                    'css': css,
                    'json': json,

                },
                dataType: 'json',
                success: function(response, status, xhr) {

                    var newButton = '<div class="thz-btn-custom-holder"';
                    newButton += ' data-metrics="' + _.escape(json) + '"'; // underscore specialchars
                    newButton += ' data-css="' + css + '">';
                    newButton += '<span class="thz-remove-btn dashicons fw-x" data-name="' + name + '"></span>';
                    newButton += html;
                    newButton += '</div>';


                    buttonNames.push(name);
                    container.attr('data-names', JSON.stringify(buttonNames));

                    //$(self.element).find('.customButtonStyles .thz-add-button').parent().after(newButton);
					// to all existing ones
					$('.customButtonStyles .thz-add-button').parent().after(newButton);
					
					
                    $('#' + self.styleid + 'thz-custom-btn-style').append(thz.thz_replace_palette_colors(css));

                    self.customMsgClose('savingbutton');


                },
                error: function(xhr, status, error) {

                    alert(status + ': ' + error.message);
                }
            });

        },


        ThzAddButton: function() {

            var self = this;



            self.ThzTriggerRemoval();


            $(self.element).find('.thz-add-button').on('click', function(e) {
				
				 e.preventDefault();
				
                var btnName = self.CssData['customClass'];
                var btnHtml = self.ThzHtmlCleanup(self.previewBox.find(".thz-btn-container").prop("outerHTML"), true);
                var btnCss = '';
                if (self.CssData['createButton']) {

                    btnCss = self.ThzBtnCss(true);
                }

                var btnJson = JSON.stringify(self.CssData);

                var container = $(self.element).find('.customButtonStyles');
                var buttonNames = JSON.parse(container.attr('data-names'));


                if ($.inArray(btnName, buttonNames) != -1) {
                    self.customMsg(_thzbtn.exists, btnName + _thzbtn.exists_text, 'exists' + self.elid);
                    return;
                }

                self.ThzSaveButton(btnName, btnHtml, btnCss, btnJson);

            });


        },


		ThzStripTags: function (string) {
			
			var self = this;
			
			var decoded_string = $("<div/>").html(string).text();
			return $("<div/>").html(decoded_string).text();
			
		},
		
        ThzTriggerRemoval: function(trigger) {

            var self = this;

            $(self.element).on('click', '.customButtonStyles .thz-remove-btn', function(e) {
                e.preventDefault();
                self.ThzRemoveButton($(this));
            });
        },



        ThzRemoveButton: function(trigger) {

            var self = this;

            var name = trigger.attr('data-name');

            var container = $(self.element).find('.customButtonStyles');
            var buttonNames = container.attr('data-names');

            self.deliteWarningMsg(name);

            $(document).on('click', '.thz_btn_delete', function(e) {

                fw.soleModal.hide('thz_deleting_button');

                $.ajax({
                    url: ajaxurl,
                    type: 'POST',
                    data: {
                        'action': 'thz_delete_button',
                        'name': name
                    },
                    dataType: 'json',
                    success: function(response, status, xhr) {

                        $(self.element).find('.customButtonStyles .' + name).parent().remove();
						
						$('.customButtonStyles .' + name).parent().hide();
						
                        var newNames = buttonNames.replace(',"' + name + '"', '');
                        container.attr('data-names', newNames);

                    },
                    error: function(xhr, status, error) {

                        alert(status + ': ' + error.message);
                    }
                });

            });

        },

		ThzSetThemeButton: function ($new_color){
			
			var self = this;
			
			
			var $theme_palette  = JSON.parse(thz_picker_vars.thz_palette);
			var $color_1 		= $theme_palette['color_1'];
			var $darker 		= tinycolor($color_1).darken(5).toString();
			var $contrast 		= tinycolor($color_1).getBrightness() >= 128 || tinycolor($color_1).getAlpha() < 0.45? '#000000' : '#ffffff';
			
			
			var $theme_button = '.thz-button.thz-btn-theme,.thz-button.thz-btn-theme:focus {';
			$theme_button +='background-color:'+$color_1+';';
			$theme_button +='border-color:'+$darker+';';
			$theme_button +='color:'+$contrast+';';
			$theme_button +='}';
			
			$theme_button +='.thz-btn-outline .thz-button.thz-btn-theme{';
			$theme_button +='color:'+$darker+';';
			$theme_button +='}';			
			
			$theme_button +='.thz-button.thz-btn-theme:hover,.thz-btn-hover .thz-button.thz-btn-theme {';
			$theme_button +='background-color:'+$darker+';';
			$theme_button +='border-color:'+$darker+';';
			$theme_button +='color:'+$contrast+'';
			$theme_button +='}';

			self.ThzBtnApplyCss();
			$('#fw-option-thz-buttonthz-btn-inline-css').text($theme_button);	
			
		},
		
		ThzThemeButtonColors: function() {
			
			var self = this;
			
			self.ThzSetThemeButton();
			
			$('#fw-option-theme_palette-color_1').on('fw:thz:color:picker:changed', function(e) {
				self.ThzSetThemeButton();
			});
			
		},
		
        ThzPickColor: function() {

            var self = this;

            $(self.element).find('.thz-btn-pick').off('click').on('click', function() {

                var $this = $(this);
                var myColor = $this.attr('data-color');

			    var colorsMetrics = JSON.parse($this.attr('data-colors-metrics'));

                $.each(colorsMetrics, function(property, value) {

                    if (self.CssData['buttonType'] == 'outline') {

                        if (property == 'normalTextColor' || property == 'normalBorderColor') {

                            value = colorsMetrics.normalBgColor;
                        }

                        if (property == 'normalBgColor') {

                            value = '';
                        }

                    }
					
                    self.ThzChangeColor(property, value);

                });

                var currrentColor = $this.parent().find('.thz-active-color').attr('data-color');

                self.previewBtn.
                removeClass('thz-btn-' + currrentColor)
                    .addClass('thz-btn-' + myColor);

                $this.siblings().removeClass('thz-active-color');
                $this.addClass('thz-active-color');
                self.CssData['activeColor'] = myColor;
				
				self.ThzSetThemeButton();
            });

        },

        ThzButtonClass: function() {

            var self = this;

            if (self.CssData['createButton'] && self.CssData['customClass'] == '') {

                var rand = Math.floor(Math.random() * 90000) + 10000;
                var customclass = 'thz-custom-btn-' + rand;

                self.CssData['customClass'] = customclass;
                $("#" + self.elid + 'customClass').val(customclass);

            }

        },

        ThzBtnCss: function(custom) {

            var self = this;

            var customclass = self.CssData['customClass'] != '' ? ' .' + self.CssData['customClass'].split(" ").join(".") : '';

            var button_class = '.thz-btn-gen-preview' + customclass;

            if (custom) {
                button_class = '.' + self.CssData['customClass'].split(" ").join(".");
            }

            var cssPrint = '';

            cssPrint += button_class + ' .thz-button{';

            if (self.CssData['normalTextColor']) {
                cssPrint += 'color:' + self.CssData['normalTextColor'] + ';';
            }
            if (self.CssData['normalBgColor']) {
                cssPrint += 'background-color:' + self.ThzIsTrans(self.CssData['normalBgColor']) + ';';
            }
            if (self.CssData['normalBorderColor'] && self.CssData['buttonType'] !='flat') {
                cssPrint += 'border-color:' + self.CssData['normalBorderColor'] + ';';
            }

            if (self.CssData['textshadowX'] != 0 || self.CssData['textshadowY'] != 0 || self.CssData['textshadowBlur'] != 0) {

                cssPrint += 'text-shadow: ' + self.CssData['textshadowX'] + 'px ';
                cssPrint += self.CssData['textshadowY'] + 'px ';
                cssPrint += self.CssData['textshadowBlur'] + 'px ';
                cssPrint += self.CssData['normalTshColor'] + ';';
            }
            if (self.ThzPrintBoxShadow()) {
                cssPrint += self.ThzPrintBoxShadow();
            }
            cssPrint += '}';

            cssPrint += button_class + ' .thz-button:hover,';
            cssPrint += button_class + '.thz-btn-hover .thz-button {';
            if (self.CssData['hoveredTextColor']) {
                cssPrint += 'color:' + self.CssData['hoveredTextColor'] + ';';
            }
            if (self.CssData['hoveredBgColor']) {
                cssPrint += 'background-color:' + self.ThzIsTrans(self.CssData['hoveredBgColor']) + ';';
            }
            if (self.CssData['hoveredBorderColor'] && self.CssData['buttonType'] !='flat') {
                cssPrint += 'border-color:' + self.CssData['hoveredBorderColor'] + ';';
            }

            if (self.CssData['textshadowX'] != 0 || self.CssData['textshadowY'] != 0 || self.CssData['textshadowBlur'] != 0) {

                cssPrint += 'text-shadow: ' + self.CssData['textshadowX'] + 'px ';
                cssPrint += self.CssData['textshadowY'] + 'px ';
                cssPrint += self.CssData['textshadowBlur'] + 'px ';
                cssPrint += self.CssData['hoveredTshColor'] + ';';
            }

            cssPrint += '}';

            if (self.CssData['buttonGradient'] != 'none') {

                var poz = self.CssData['buttonGradient'];
                var ngr1 = self.ThzIsTrans(self.CssData['normalGradient1']);
                var ngr2 = self.ThzIsTrans(self.CssData['normalGradient2']);
                var hgr1 = self.ThzIsTrans(self.CssData['hoveredGradient1']);
                var hgr2 = self.ThzIsTrans(self.CssData['hoveredGradient2']);

                var deg = 180;

                if (poz.indexOf('totop') > -1) {
                    deg = 0;
                }

                if (poz.indexOf('toleft') > -1) {
                    deg = -90;
                }

                if (poz.indexOf('toright') > -1) {
                    deg = 90;
                }


                cssPrint += button_class + ' .thz-button .thz-btn-ga-' + poz + ':before{';
                cssPrint += 'background: -moz-linear-gradient(' + deg + 'deg, ' + ngr1 + ' 0%, ' + ngr2 + ' 100%);';
                cssPrint += 'background: -webkit-linear-gradient(' + deg + 'deg, ' + ngr1 + ' 0%, ' + ngr2 + ' 100%);';
                cssPrint += 'background: -o-linear-gradient(' + deg + 'deg, ' + ngr1 + ' 0%, ' + ngr2 + ' 100%);';
                cssPrint += 'background: -ms-linear-gradient(' + deg + 'deg, ' + ngr1 + ' 0%, ' + ngr2 + ' 100%);';
                cssPrint += 'background: linear-gradient(' + deg + 'deg, ' + ngr1 + ' 0%, ' + ngr2 + ' 100%);';
                cssPrint += '}';

                cssPrint += button_class + ' .thz-button .thz-btn-ga-' + poz + ':after{';
                cssPrint += 'background: -moz-linear-gradient(' + deg + 'deg, ' + hgr1 + ' 0%, ' + hgr2 + ' 100%);';
                cssPrint += 'background: -webkit-linear-gradient(' + deg + 'deg, ' + hgr1 + ' 0%, ' + hgr2 + ' 100%);';
                cssPrint += 'background: -o-linear-gradient(' + deg + 'deg, ' + hgr1 + ' 0%, ' + hgr2 + ' 100%);';
                cssPrint += 'background: -ms-linear-gradient(' + deg + 'deg, ' + hgr1 + ' 0%, ' + hgr2 + ' 100%);';
                cssPrint += 'background: linear-gradient(' + deg + 'deg, ' + hgr1 + ' 0%, ' + hgr2 + ' 100%);';
                cssPrint += '}';
            }

            if (self.CssData['buttonIcon'] != '') {

                cssPrint += button_class + ' i{';
                cssPrint += 'color:' + self.CssData['normalIconColor'] + ';';
                cssPrint += '}';
				
				cssPrint += button_class + ':hover i,';
				cssPrint += button_class + '.thz-btn-hover i{';
                cssPrint += 'color:' + self.CssData['hoveredIconColor'] + ';';
                cssPrint += '}';
            }

            if (self.CssData['buttonIcon'] != '' && self.CssData['iconType'] == 'boxed') {

                cssPrint += button_class + '.thz-btn-icon-boxed-' + self.CssData['iconPosition'] + ' .thz-btn-icon{';
                cssPrint += 'background:' + self.CssData['normalIconBg'] + ';';
                cssPrint += '}';

                cssPrint += button_class + '.thz-btn-icon-boxed-' + self.CssData['iconPosition'] + ':hover .thz-btn-icon,';
				cssPrint += button_class + '.thz-btn-icon-boxed-' + self.CssData['iconPosition'] + '.thz-btn-hover .thz-btn-icon{';
                cssPrint += 'background:' + self.CssData['hoveredIconBg'] + ';';
                cssPrint += '}';

            }
			
			var cleanupCss = cssPrint.replace(button_class + ' .thz-button{}',"")
			.replace(button_class + ' .thz-button:hover,'+ button_class +'.thz-btn-hover .thz-button {}','');
            
			return cleanupCss;

        },

        ThzBtnCustomCss: function() {

            var self = this;
            var customCss = '';

            self.customButtons.each(function(index, element) {

                customCss += $(element).attr('data-btn-css');

            });

            $('#' + self.styleid + 'thz-custom-btn-style').html(thz.thz_replace_palette_colors(customCss));

        },

        ThzNclass: function(value) {

            var self = this;

            if (value !== undefined) {
                return value.toString().replace('-', 'n');
            }

        },

        ThzBtnApplyCss: function() {

            var self = this;

            self.ThzButtonClass();

            self.ThzBtnApplyClasses();

            if (self.CssData['createButton']) {
				
                var cssPrint = self.ThzBtnCss();

            } else {

                cssPrint = '';
            }
            $('#' + self.styleid + 'thz-btn-style').html(thz.thz_replace_palette_colors(cssPrint));

        },

        ThzBtnApplyClasses: function() {

            var self = this;
            var active_color = $(self.element).find('.thz-active-color').attr('data-color');

            if (self.CssData['buttonSizeClass'] != 'custom') {

                self.previewBtn.
                thzAlterClass(
                    'thz-btn-small thz-btn-normal thz-btn-medium thz-btn-large thz-btn-xlarge',
                    'thz-btn-' + self.CssData['buttonSizeClass']).
                find('.thz-btn-text').
                thzAlterClass('thz-vp-* thz-hp-*');

                $(self.element).find('.thz-btn-gen-option-horizontal-group.customsize').hide();

            } else {

                self.previewBtn.
                thzAlterClass('thz-btn-small thz-btn-normal thz-btn-medium thz-btn-large thz-btn-xlarge').
                find('.thz-btn-text').
                thzAlterClass(
                    'thz-vp-* thz-hp-*',
                    'thz-vp-' + self.CssData['paddingY'].toString() +
                    ' thz-hp-' + self.CssData['paddingX'].toString()
                );
                $(self.element).find('.thz-btn-gen-option-horizontal-group.customsize').show();
            }

            self.previewBtn.
            find('.thz-btn-text').
            thzAlterClass(
                'thz-fs-* thz-fw-*',
                'thz-fs-' + self.CssData['fontSize'].toString() +
                ' thz-fw-' + self.CssData['fontWeight'].toString()
            );

			self.previewBtn.thzAlterClass(
				'thz-radius-*',
				'thz-radius-' + self.CssData['borderRadius'].toString()
			);

            if (self.CssData['borderWidth'] > 0) {

                self.previewBtn.thzAlterClass(
                    'thz-btn-border-*',
                    'thz-btn-border-' + self.CssData['borderWidth'].toString()
                );

            } else {

                self.previewBtn.thzAlterClass('thz-btn-border-*');

            }

            if (self.CssData['borderStyle'] != 'solid' && self.CssData['borderWidth'] > 0) {

                self.previewBtn.thzAlterClass(
                    'thz-border-style-*',
                    'thz-border-style-' + self.CssData['borderStyle']
                );

            } else {

                self.previewBtn.thzAlterClass('thz-border-style-*');

            }
			
			
			
            if (self.CssData['borderSide'] != 'all' && self.CssData['borderWidth'] > 0) {

                self.previewBtn.thzAlterClass(
                    'thz-btn-border-side-*',
                    'thz-btn-border-side-' + self.CssData['borderSide']
                );

            } else {

                self.previewBtn.thzAlterClass('thz-btn-border-side-*');

            }

            if (self.CssData['textItalic']) {

                self.previewBtn.find('.thz-btn-text').addClass('thz-font-italic');

            } else {

                self.previewBtn.find('.thz-btn-text').removeClass('thz-font-italic');

            }

            if (self.CssData['textUppercase']) {

                self.previewBtn.find('.thz-btn-text').addClass('thz-text-uppercase');

            } else {

                self.previewBtn.find('.thz-btn-text').removeClass('thz-text-uppercase');

            }

            if (self.CssData['buttonFullWidth']) {

                self.previewBtn.parent().addClass('thz-btn-full');

            } else {

                self.previewBtn.parent().removeClass('thz-btn-full');

            }

            self.previewBtnCon.addClass(self.CssData['customClass']);

            if (self.CssData['createButton']) {
				
                $(self.element).find('.thz-btn-gen-hide-option').show();
                $(self.element).find('.createButton').prop('checked', true);
                $(self.element).find('.textShadow').hide();
                $(self.element).find('.boxshadowpredefined').hide();
				
				self.previewBtnCon.addClass('ctm-btn');
                self.previewBtn.removeClass('thz-btn-' + active_color);
                self.previewBox.addClass('iscustom');

            } else {

                $(self.element).find('.thz-btn-gen-hide-option').hide();
                $(self.element).find('.createButton').prop('checked', false);
                $(self.element).find('.textShadow').show();
                $(self.element).find('.boxshadowpredefined').show();

                var currentTab = $(self.element).find('.active-tab-link a').attr('data-group');
                if (currentTab == 'colors') {
                    $(self.element).find('.thz-tab-link[data-group=text]').trigger('click');
                }
				
				self.previewBtnCon.removeClass('ctm-btn');
                self.previewBtn.addClass('thz-btn-' + active_color);
                self.previewBox.removeClass('iscustom');
				
            }

            if (self.CssData['iconSize'] != 'inherit') {

                self.previewBtn.find('i').thzAlterClass(
                    'thz-is-* thz-fs-*',
                    self.CssData['iconSize']
                );

            } else {

                self.previewBtn.find('i').thzAlterClass('thz-is-*', 'thz-fs-' + self.CssData['fontSize'].toString());

            }
			
			 if (self.CssData['moveEffect'] != 'none') {
				 
				 self.previewBtnCon.thzAlterClass('thz-btn-move-*')
				 .addClass(self.CssData['moveEffect']);
				 
			 }else{
				 
				 self.previewBtnCon.thzAlterClass('thz-btn-move-*'); 
			 }
			 
			 if (self.CssData['shadowShow'] != 'always') {
				 
				 self.previewBtnCon.thzAlterClass('thz-btn-sh-*')
				 .addClass(self.CssData['shadowShow']);
				 
			 }else{
				 
				 self.previewBtnCon.thzAlterClass('thz-btn-sh-*'); 
			 }

            if (self.CssData['buttonText'] != '') {

                self.previewBtn.find('.thz-btn-text').
                thzAlterClass(
                    'thz-ngv* thz-ngh*',
                    'thz-ngv-' + self.ThzNclass(self.CssData['textNudgeV']) +
                    ' thz-ngh-' + self.ThzNclass(self.CssData['textNudgeH'])
                );

                if (self.CssData['textNudgeV'] == 0) {
                    self.previewBtn.find('.thz-btn-text').
                    thzAlterClass('thz-ngv*');
                }

                if (self.CssData['textNudgeH'] == 0) {
                    self.previewBtn.find('.thz-btn-text').
                    thzAlterClass('thz-ngh*');
                }
            }

            self.previewBtnCon.
            thzAlterClass(
                'thz-mt-* thz-mr-* thz-mb-* thz-ml-*',
                'thz-mt-' + self.ThzNclass(self.CssData['marginTop']) +
                ' thz-mr-' + self.ThzNclass(self.CssData['marginRight']) +
                ' thz-mb-' + self.ThzNclass(self.CssData['marginBottom']) +
                ' thz-ml-' + self.ThzNclass(self.CssData['marginLeft'])
            );

            if (self.CssData['marginTop'] == 0) {
                self.previewBtnCon.
                thzAlterClass('thz-mt-*');
            }

            if (self.CssData['marginRight'] == 0) {
                self.previewBtnCon.
                thzAlterClass('thz-mr-*');
            }
            if (self.CssData['marginBottom'] == 0) {
                self.previewBtnCon.
                thzAlterClass('thz-mb-*');
            }
            if (self.CssData['marginLeft'] == 0) {
                self.previewBtnCon.
                thzAlterClass('thz-ml-*');
            }

            $(self.element).find('.thz-btn-gen-preview-table').css({

                'background-color': thz.thz_replace_palette_colors(self.CssData['previewBg']),

            });

            if (self.CssData['textShadow'] != 'none' && !self.CssData['createButton']) {

                self.previewBtn.find('.thz-btn-text').thzAlterClass(
                    'thz-tsh-*',
                    'thz-tsh-' + self.CssData['textShadow'].toString()
                );

            } else {

                self.previewBtn.find('.thz-btn-text').thzAlterClass('thz-tsh-*');

            }

            self.previewBtn.
            thzAlterClass(
                'thz-align-*',
                'thz-align-' + self.CssData['textAlign']
            );

            if (self.CssData['letterSpacing'] != 0) {

                self.previewBtn.
                find('.thz-btn-text').
                thzAlterClass(
                    'thz-lsp*',
                    'thz-lsp' + self.CssData['letterSpacing'].toString()
                )

            } else {

                self.previewBtn.find('.thz-btn-text').thzAlterClass('thz-lsp*');

            }

            if (self.CssData['buttonType'] != 'normal') {
                self.previewBtn.parent().
                thzAlterClass(
                    'thz-btn-outline thz-btn-3d thz-btn-flat',
                    'thz-btn-' + self.CssData['buttonType']
                );
            } else {

                self.previewBtn.parent().removeClass('thz-btn-outline thz-btn-3d thz-btn-flat');
            }

            if (self.CssData['buttonType'] == '3d') {
                self.previewBtn.find('.thz-btn-3d-line').remove();
                self.previewBtn.append('<span class="thz-btn-3d-line"></span>');
            } else {
                self.previewBtn.find('.thz-btn-3d-line').remove();
            }

            if (self.CssData['buttonGradient'] != 'none') {
                self.previewBtn.find('.thz-btn-gradient-overlay').remove();
                self.previewBtn.append('<span class="thz-btn-gradient-overlay thz-btn-ga-' + self.CssData['buttonGradient'] + '"></span>');
            } else {
                self.previewBtn.find('.thz-btn-gradient-overlay').remove();
            }

            if (self.CssData['textshadowX'] == 0 && self.CssData['textshadowY'] == 0 && self.CssData['textshadowBlur'] == 0) {

                $(self.element).find(".coloroption-normalTshColor").hide();
                $(self.element).find(".coloroption-hoveredTshColor").hide();

            } else {

                $(self.element).find(".coloroption-normalTshColor").show();
                $(self.element).find(".coloroption-hoveredTshColor").show();
            }

            if (self.CssData['buttonGradient'] == 'none') {

                $(self.element).find(".coloroption-normalGradient1").hide();
                $(self.element).find(".coloroption-normalGradient2").hide();
                $(self.element).find(".coloroption-hoveredGradient1").hide();
                $(self.element).find(".coloroption-hoveredGradient2").hide();

            } else {

                $(self.element).find(".coloroption-normalGradient1").show();
                $(self.element).find(".coloroption-normalGradient2").show();
                $(self.element).find(".coloroption-hoveredGradient1").show();
                $(self.element).find(".coloroption-hoveredGradient2").show();

            }

            if (self.CssData['borderWidth'] == 0) {

                $(self.element).find(".coloroption-normalBorderColor").hide();
                $(self.element).find(".coloroption-hoveredBorderColor").hide();

            } else {

                $(self.element).find(".coloroption-normalBorderColor").show();
                $(self.element).find(".coloroption-hoveredBorderColor").show();

            }

            if (self.CssData['boxShadow'] != 'none' && self.CssData['boxShadowOpacity'] > 0) {

                var shadowOpacity = self.CssData['boxShadowOpacity'].toString().replace('.', '');

                self.previewBtn.
                thzAlterClass(
                    'thz-boxshadow-*',
                    'thz-boxshadow-' + self.CssData['boxShadow'] + '-' + shadowOpacity
                );

            } else {

                self.previewBtn.thzAlterClass('thz-boxshadow-*');

            }

            if (self.CssData['fontFamily'] != 'inherit') {

                self.previewBtn.
                thzAlterClass(
                    'thz-ff-*',
                    self.CssData['fontFamily']
                );
				
				
				
            } else {

                self.previewBtn.thzAlterClass('thz-ff-*');

            }

            if (self.CssData['SubTextfontFamily'] != 'inherit') {

                self.previewBtn.
                find('.thz-btn-subtext').
                thzAlterClass(
                    'thz-ff-*',
                    self.CssData['SubTextfontFamily']
                );
				

            } else {

                self.previewBtn.find('.thz-btn-subtext').thzAlterClass('thz-ff-*');

            }

            if (self.CssData['buttonTransition']) {

                self.previewBtn.addClass('thz-btn-trans');

            } else {

                self.previewBtn.removeClass('thz-btn-trans');

            }

            if (self.CssData['buttonAnimation']) {

                $(self.element).find('.animationoptions').show();


                self.previewBtnCon.attr('data-anim-effect', self.CssData['animateEffect']);
                self.previewBtnCon.attr('data-anim-duration', self.CssData['effectDuration']);
                self.previewBtnCon.attr('data-anim-delay', self.CssData['animateDelay']);

                var allAnimations = $("#" + self.elid + 'animateEffect option').map(function() {
                    return $(this).val();
                }).get().join(' ');

                self.previewBtnCon.addClass('thz-animate');

            } else {

                $(self.element).find('.animationoptions').hide();
                self.previewBtnCon
                    .removeClass('thz-animate')
                    .removeAttr('data-anim-effect data-anim-duration data-anim-delay');

            }

            if (self.CssData['buttonFloat'] != 'none' && self.CssData['buttonFloat'] != 'center') {

                self.previewBtnCon.
                thzAlterClass(
                    'thz-float-*',
                    'thz-float-' + self.CssData['buttonFloat']);

            } else {

                self.previewBtnCon.
                thzAlterClass('thz-float-*');
            }


            if (self.CssData['buttonIcon'] != '') {

                $(self.element).find(".coloroption-normalIconColor").show();
                $(self.element).find(".coloroption-hoveredIconColor").show();

            } else {

                $(self.element).find(".coloroption-normalIconColor").hide();
                $(self.element).find(".coloroption-hoveredIconColor").hide();
            }

            if (self.CssData['buttonIcon'] != '' && self.CssData['iconType'] == 'boxed') {

                $(self.element).find(".coloroption-normalIconBg").show();
                $(self.element).find(".coloroption-hoveredIconBg").show();

            } else {

                $(self.element).find(".coloroption-normalIconBg").hide();
                $(self.element).find(".coloroption-hoveredIconBg").hide();
            }


			

            $(self.element).find(".thz-remove-btn").each(function(index, element) {

                var $name = $(this).attr('data-name');

                if ($name == self.CssData['customClass']) {

                    $(this).hide();

                } else {

                    $(this).show();
                }

            });

        },

        ThzCssFormating: function(cssprint, format) {

            if (format) {
                return cssprint.replace(/;/g, ";\n&nbsp;&nbsp;").replace(/{/g, "{\n&nbsp;&nbsp;").replace(/}/g, "&nbsp;}\n");
            } else {
                return cssprint;
            }

        },

        ThzHtmlCleanup: function(buttonhtml, cleanup) {

            if (cleanup) {
                return buttonhtml.replace(/\s+/g, ' ').replace(/>\s+</g, '><');
            } else {
                return buttonhtml;
            }

        },
        ThzPrintButtonData: function() {
            var self = this;
			
			
			var printb ='';
			var printa ='';
			if(self.CssData['buttonFloat'] == 'center'){
				
				printb ='<div class="thz-btn-center-wrap">';
			 	printa ='</div>';	
				
			}
			
            var printHtml = printb  + self.ThzHtmlCleanup(self.previewBox.find(".thz-btn-container").prop("outerHTML"), true) + printa;
            var jsonData = jQuery.extend(true, {}, self.CssData);

            delete jsonData.buttonchanged;
            delete jsonData.allchanged;

            var printJson = JSON.stringify(jsonData);

            if (self.CssData['buttonTag'] == 'button') {

                $(self.element).find(".thz-button-html-print")
                    .val(printHtml.replace('<a', '<button').replace('</a>', '</button>'));

            } else {

                $(self.element).find(".thz-button-html-print").val(printHtml);
            }

            var buttonArray = "$customButtonsArray['" + self.CssData['customClass'] + "']=array(\n";
            buttonArray += "		'html' 	=> '" + printHtml + "',\n"; //$(self.element).find(".thz-button-html-print").val()
            buttonArray += "		'css' 	=> '" + self.ThzBtnCss(true) + "',\n";
            buttonArray += "		'json' 	=> '" + printJson + "',\n";
            buttonArray += ");";

            $(self.element).find(".thz-button-json-print").val(printJson);

            if (self.CssData['createButton']) {
				
                var printCss = self.ThzCssFormating(self.ThzBtnCss(true));
                $(self.element).find(".thz-button-css-print").val(printCss);

            } else {

                $(self.element).find(".thz-button-css-print").val('');
            }

        },

		
        ThzButtonHtml: function() {

            var self = this;
            var btnText = self.CssData['buttonText'];
            var btnlink;
            var linktarget = self.CssData['linkTarget'];

            if (self.CssData['linkType'] == 'normal') {

                $("#" + self.elid + 'magnificId').parent().hide();
                $("#" + self.elid + 'normalLink').parent().show();
                btnlink = self.CssData['normalLink'];
                self.previewBtn.removeClass('thz-trigger-lightbox');

            } else {

                $("#" + self.elid + 'magnificId').parent().show();
                $("#" + self.elid + 'normalLink').parent().hide();
                btnlink = self.CssData['magnificId'];
                self.previewBtn.addClass('thz-trigger-lightbox');
            }

            if (btnlink != '') {
				
                if (self.CssData['linkType'] == 'magnific') {
					
					var $mfp_type	= thz.is_image( btnlink ) ? 'mfp-image': 'mfp-iframe';
					
					if( btnlink.indexOf('http') !== -1){
						
						self.previewBtn.
						removeClass('thz-trigger-lightbox mfp-image mfp-iframe').
						addClass('thz-lightbox ' + $mfp_type );
						
					}else{
						
						self.previewBtn.
						removeClass('thz-lightbox thz-trigger-lightbox mfp-image mfp-iframe').
						addClass('thz-trigger-lightbox');
						
						btnlink = btnlink.indexOf('#') !== -1 ? btnlink : '#' + btnlink;

					}

                }

                self.previewBtn.attr('href', btnlink);

            } else {

                self.previewBtn.removeAttr('href').
				removeClass('thz-lightbox thz-trigger-lightbox mfp-image mfp-iframe');
            }

            if (self.CssData['linkTarget'] == '_blank' && self.CssData['linkType'] != 'magnific') {

                self.previewBtn.attr('target', '_blank');

            } else {

                self.previewBtn.removeAttr('target');
            }

            if (self.CssData['linkTitle'] != '') {

                self.previewBtn.attr('title', self.CssData['linkTitle']);

            } else {

                self.previewBtn.removeAttr('title');
            }

            if (self.CssData['buttonTag'] == 'button') {

                $(self.element).find('.linkOptions :input').addClass('thz-disabled').attr('disabled', 'disabled');
				$(self.element).find('.thz-select-link').hide();
				
                self.previewBtn.removeAttr('href target');

            } else {

                $(self.element).find('.linkOptions :input')
                    .removeAttr('disabled').removeClass('thz-disabled');
				$(self.element).find('.thz-select-link').show();

            }

            if (self.CssData['buttonSubText'] != '') {

                btnText = '<span class="thz-btn-maintext">' + self.CssData['buttonText'];
                btnText += '<span class="thz-btn-subtext thz-fs-' + self.CssData['SubTextfontSize'];
                btnText += ' thz-fw-' + self.CssData['SubTextfontWeight'];
                btnText += ' thz-lsp' + self.CssData['SubTextletterSpacing'];

                if (self.CssData['SubTextNudgeV'] != 0) {
                    btnText += ' thz-ngv-' + self.ThzNclass(self.CssData['SubTextNudgeV']);
                }
                if (self.CssData['SubTextNudgeH'] != 0) {
                    btnText += ' thz-ngh-' + self.ThzNclass(self.CssData['SubTextNudgeH']);
                }

                if (self.CssData['SubTextUppercase']) {
                    btnText += ' thz-text-uppercase';
                }

                if (self.CssData['SubTextItalic']) {
                    btnText += ' thz-font-italic';
                }

                btnText += '">';
                btnText += self.CssData['buttonSubText'];
                btnText += '</span>';
                btnText += '</span>';

                self.previewBtn.find('.thz-btn-text').addClass('thz-btn-has-subtext');

            } else {

                self.previewBtn.find('.thz-btn-text').removeClass('thz-btn-has-subtext');

            }

            self.previewBtn.parent().removeClass('thz-btn-icon-left thz-btn-icon-hidden thz-btn-icon-right thz-btn-icon-boxed-left thz-btn-icon-boxed-right');
            self.previewBtn.find('.thz-btn-icon').remove();
            self.previewBtn.find('.thz-btn-text').html(btnText);

            if (self.CssData['buttonIcon'] == '') {
				
				self.ThzChangeCheckbox('iconOnHover', false);
				
                return;
            }

            var iconClass = self.CssData['buttonIcon'];
            iconClass += ' thz-ifw-' + self.CssData['iconSpace'].toString();

            if (self.CssData['iconNudgeV'] != 0) {
                iconClass += ' thz-ngv-' + self.ThzNclass(self.CssData['iconNudgeV']);
            }
            if (self.CssData['iconNudgeH'] != 0) {
                iconClass += ' thz-ngh-' + self.ThzNclass(self.CssData['iconNudgeH']);
            }

            var iconHtml = '<i class="' + iconClass + '"></i>';

            if (self.CssData['iconPosition'] == 'left') {

                if (self.CssData['iconType'] == 'inline') {

                    self.previewBtn.parent().addClass('thz-btn-icon-left');
                    self.previewBtn.find('.thz-btn-text').html(iconHtml + btnText);

                } else if (self.CssData['iconType'] == 'boxed') {

                    self.previewBtn.parent().addClass('thz-btn-icon-boxed-left');
                    self.previewBtn.find('.thz-btn-text').before('<span class="thz-btn-icon">' + iconHtml + '</i></span>');

                }

            } else if (self.CssData['iconPosition'] == 'right') {

                if (self.CssData['iconType'] == 'inline') {

                    self.previewBtn.parent().addClass('thz-btn-icon-right');
                    self.previewBtn.find('.thz-btn-text').html(btnText + iconHtml);

                } else if (self.CssData['iconType'] == 'boxed') {

                    self.previewBtn.parent().addClass('thz-btn-icon-boxed-right');
                    self.previewBtn.find('.thz-btn-text').after('<span class="thz-btn-icon">' + iconHtml + '</i></span>');

                }

            }
			
			
            if (self.CssData['iconOnHover']) {

                self.previewBtn.parent().addClass('thz-btn-icon-hidden');

            } else {

                self.previewBtn.parent().removeClass('thz-btn-icon-hidden');

            }
			

        },
		
		ThzIsHtml: function (str) {
			
			var self = this;
			
			return /<[a-z\][\s\S]*>/i.test(str);

		},
		
		
        ThzTexthange: function() {

            var self = this;

            $(".thz-btn-number").keypress(function(e) {
                if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                    return false;
                }
            });

            $(self.element).find('input[type=text][data-css-hook]').on('change keyup paste', function() {
				
				if(self.ThzIsHtml( $(this).val() ) ){

				
					var cleanup = self.ThzStripTags( $(this).val() );
					$(this).val(cleanup);
				}
				
                var cssHook = $(this).attr('data-css-hook');
                var value = $(this).val();

                if (cssHook == 'customClass') {

                    self.previewBtnCon.
                    removeClass(self.CssData['customClass']).
                    addClass(value);
                }

                self.CssData[cssHook] = value;

            });

        },

        ThzPrintBoxShadow: function(prefixed) {

            var self = this;
            var shadow_css = [];
            var shadow = new Array(self.CssData['boxShadowsCount']);

            $.each(shadow, function(index, element) {

                var index = index + 1;
                var inset = '';

                if (self.CssData['shadowInset' + index]) {
                    inset = 'inset ';
                }

                var hoffset = self.CssData['boxshadowX' + index];
                var voffset = self.CssData['boxshadowY' + index];
                var blurRadius = self.CssData['boxshadowBlurRadius' + index];
                var spreadRadius = self.CssData['boxshadowSpreadRadius' + index];
                var shadowColor = self.CssData['boxshadow' + index + 'Color'];

                if (hoffset == 0 && voffset == 0 && blurRadius == 0 && spreadRadius == 0) {

                    return;
                }

                var css = inset + hoffset + 'px ' + voffset + 'px ' + blurRadius + 'px ' + spreadRadius + 'px ' + shadowColor;

                shadow_css.push(css);
            });

            var box_shadow_metrics = shadow_css.join(',');
            var box_shadow = '';
            if (box_shadow_metrics != '') {

                box_shadow += 'box-shadow:' + box_shadow_metrics + ';';
            }

            return box_shadow;
        },

        ThzSelectsChange: function() {

            var self = this;

            $(self.element).find('select').on('change', function() {

                var cssHook = $(this).attr('data-css-hook');
                var value = $(this).val();
                self.CssData[cssHook] = value;

                if (cssHook == 'textShadow') {

                    var selected = $(this).find(":selected").attr('data-metrics');
                    var metrics = JSON.parse(selected);

                    self.ThzChangeSlider('textshadowY', metrics.textshadowY);
                    self.ThzChangeSlider('textshadowX', metrics.textshadowX);
                    self.ThzChangeSlider('textshadowBlur', metrics.textshadowBlur);

                    self.ThzChangeColor('normalTshColor', metrics.normalTshColor);
                    self.ThzChangeColor('hoveredTshColor', metrics.hoveredTshColor);

                    self.CssData['normalTshColor'] = metrics.normalTshColor;
                    self.CssData['hoveredTshColor'] = metrics.hoveredTshColor;

                }

                if (cssHook == 'boxShadow') {

                    var selected = $(this).find(":selected").attr('data-metrics');
                    var metrics = JSON.parse(selected);

                    self.ThzChangeCheckbox('shadowInset1', metrics.shadowInset1);
                    self.ThzChangeSlider('boxshadowX1', metrics.boxshadowX1);
                    self.ThzChangeSlider('boxshadowY1', metrics.boxshadowY1);
                    self.ThzChangeSlider('boxshadowBlurRadius1', metrics.boxshadowBlurRadius1);
                    self.ThzChangeSlider('boxshadowSpreadRadius1', metrics.boxshadowSpreadRadius1);
                    self.ThzChangeSlider('boxShadowOpacity', metrics.boxShadowOpacity);

                }


            });

        },

        ThzChecksChange: function() {

            var self = this;

            $(self.element).find(':checkbox').on('change', function() {

                var cssHook = $(this).attr('data-css-hook');
                var checked = $(this).prop('checked');
                var value = false;

                if (checked) {
                    value = $(this).val();
                }

                self.CssData[cssHook] = value;

            });

        },

        ThzPopulate: function(metrics) {

            var self = this;
            var keys = Object.keys(metrics);

            for (var i = 0; i < keys.length; i++) {

                var property = keys[i];
                var value = metrics[keys[i]];
                var element = $(self.element).find("[data-css-hook='" + property + "']");

                if (element.hasClass('thz-btn-gen-slider')) {
                    self.ThzChangeSlider(property, value);
                }

                if (element.hasClass('thz-btn-gen-color-input')) {
                    self.ThzChangeColor(property, value);
                }

                if (element.hasClass('thz-btn-gen-select')) {
                    self.ThzChangeMulti(property, value);
                }

                if (element.hasClass('thz-btn-gen-checkbox')) {

                    self.ThzChangeCheckbox(property, value);
                }
                if (element.hasClass('thz-btn-gen-textinput')) {
                    self.ThzChangeMulti(property, value);
                }

                if (element.hasClass('thz-icon-input')) {
                    self.ThzChangeMulti(property, value);
                    $(self.element).find('.icons-search-input').trigger('click');
                }

                if (element.hasClass('thz-btn-gen-radioinput')) {
                    self.ThzChangeRadio(property, value);
                }

            }
        },

        ThzUpdateInputs: function(metrics) {

            var self = this;
            var keys = Object.keys(metrics);

            for (var i = 0; i < keys.length; i++) {

                var property = keys[i];
                var value = metrics[keys[i]];

                self.CssData[property] = value;

                var element = $(self.element).find("[data-css-hook='" + property + "']");

                if (element.hasClass('thz-btn-gen-slider')) {
                    self.ThzChangeSlider(property, value);
                }

                if (element.hasClass('thz-btn-gen-color-input')) {
                    self.ThzChangeColor(property, value);
                }

                if (element.hasClass('thz-btn-gen-select')) {
                    self.ThzChangeMulti(property, value);
                }

                if (element.hasClass('thz-btn-gen-checkbox')) {

                    self.ThzChangeCheckbox(property, value);
                }
                if (element.hasClass('thz-btn-gen-textinput')) {
                    self.ThzChangeMulti(property, value);
                }

                if (element.hasClass('thz-icon-input')) {
                    self.ThzChangeMulti(property, value);
                    $(self.element).find('.icons-search-input').trigger('click');
                }

                if (element.hasClass('thz-btn-gen-radioinput')) {
                    self.ThzChangeRadio(property, value);
                }

            }

            self.CssData['buttonchanged'] = Math.random();

        },

        ThzButtonStyles: function() {

            var self = this;

            $(self.element).on('click', '.customButtonStyles .thz-button', function(e) {

                e.preventDefault();

                var metrics = JSON.parse($(this).parent().parent().attr('data-metrics'));
                var isCustom = metrics.createButton;
				
				var restricted = ['buttonTag','linkType','normalLink','linkTarget','linkTitle','magnificId'];

                if (!isCustom) {

                    $(self.element).find('.thz-btn-pick[data-color=' + metrics.activeColor + ']').trigger('click');

                }

                self.previewBtnCon
                    .removeClass(self.CssData['customClass'])
                    .addClass(metrics['customClass']);
				
				
				
                $.each(metrics, function(index, value) {
					
					if ($.inArray(index, restricted) != -1) {
						
						return;
					}
						
                    if (self.CssData[index] != value) {

                        self.newMetrics[index] = value;

                    }

                });

                self.ThzUpdateInputs(self.newMetrics);

            });

        },

        ThzButtonType: function() {
            var self = this;

            $(self.element).find('.thz-btn-gen-type-predefined').on('change', function() {

                var selected = $(this).val();
                self.CssData['buttonType'] = selected;

                $(self.element).find('.thz-active-color').trigger('click');

                if (selected === 'outline') {
                    self.ThzChangeSlider('borderWidth', 2);
                }

                if (selected === '3d') {

                    self.ThzChangeSlider('borderWidth', 0);
                }

                if (selected === 'normal') {
                    self.ThzChangeSlider('borderWidth', 1);

                }

                if (selected === 'flat') {

                    self.ThzChangeSlider('borderWidth', 0);
                    $(self.element).find("[data-css-hook='buttonGradient']").val('none').trigger('change');
                }

            });

        },

        ThzCustomSize: function() {

            var self = this;
            $(self.element).find('.thz-btn-gen-size-predefined').on('click', function() {


                var selected = $(this).val();

                self.CssData['buttonSizeClass'] = selected;

                if (selected === 'custom') {
                    return;
                }

                var metrics = JSON.parse($(this).attr('data-metrics'));

                self.ThzChangeSlider('paddingY', metrics.paddingY);
                self.ThzChangeSlider('paddingX', metrics.paddingX);
                self.ThzChangeSlider('fontSize', metrics.fontSize);
                $(self.element).find("[data-css-hook='fontWeight']").val(metrics.fontWeight);

                self.CssData['fontWeight'] = metrics.fontWeight;

            });

        },

        ThzChangeSlider: function(csshook, newvalue) {

            var self = this;

            var slider = $("#" + self.elid + csshook).data("ionRangeSlider");

            slider.update({
                from: newvalue,
            });

        },

        ThzSliderOptions: function() {

            var self = this;

            var $slider = $(self.element).find('.thz-btn-gen-slider').ionRangeSlider({

                hide_min_max: true,
                grid: true,

                onChange: function(data) {
                    var from = (data.from_value) ? data.from_value : data.from;
                    data.input.parent().parent().find('.thz-btn-gen-slider-custom').val(from);

                    var cssHook = data.input.attr('data-css-hook');
                    self.CssData[cssHook] = from;
                },

                onUpdate: function(data) {
                    var from = (data.from_value) ? data.from_value : data.from;
                    data.input.parent().parent().find('.thz-btn-gen-slider-custom').val(from);

                    var cssHook = data.input.attr('data-css-hook');
                    self.CssData[cssHook] = from;


                }

            });

            $(self.element).find('.thz-btn-gen-slider-custom').on('keyup change paste', function() {

                var range = $(this).parent().parent().find('.thz-btn-gen-slider').data("ionRangeSlider");

                var newvalue = parseInt($(this).val());
				
                if (newvalue > range.options.max) {

                    newvalue = range.options.from;
                }
				
				if(!isNaN(newvalue)){
					range.update({
						from: newvalue,
					});
				}

            });

        },

        ThzPreloadButton: function(buttonName) {

            var self = this;
            var preloadContainer = $(self.element).find('.thz-btn-metrics');
            var preloadData = JSON.parse(preloadContainer.attr('data-btn-metrics'));

            $.each(preloadData, function(property, value) {
                self.CssData[property] = value;
            });

        },

        ThzChangeColor: function(csshook, newvalue) {

            var self = this;

            var colorInput = $("#" + self.elid + csshook);
            colorInput.val(newvalue).trigger('change');
        },

        ThzChangeRadio: function(csshook, newvalue) {

            var self = this;

            $("#" + self.elid + csshook + newvalue).
            prop("checked", true).trigger('change');

        },

        ThzChangeCheckbox: function(csshook, newvalue) {

            var self = this;

            $("#" + self.elid + csshook).
            prop('checked', newvalue).trigger('change');

        },

        ThzChangeMulti: function(csshook, newvalue) {

            var self = this;
            $("#" + self.elid + csshook).
            val(newvalue).trigger('change');

        },

        ThzRadioChange: function() {

            var self = this;

            $('.thz-btn-gen-radioinput').on('change', function() {
                $(this).parent().parent().find('.thz-btn-gen-radioinput').prop("checked", false);
                $(this).prop("checked", true);
            });

        },

        ThzLoadTabs: function() {

            var self = this;

            $(self.element).find('.thz-tab-link').on('click', function(event) {

                event.preventDefault();

                var target = $(this).attr('data-tab');
                var group = $(this).attr('data-group');
                var dataGroup = $(this).parent().attr('data-tabs-group');

                $(self.element).find('li[data-tabs-group="' + dataGroup + '"]')
                    .removeClass('active-tab-link').addClass('notactive-tab-link');

                $(self.element).find('.thz-tab[data-tabs-group="' + dataGroup + '"]')
                    .removeClass('active-tab').addClass('notactive-tab');

                $(self.element).find('div[data-tab="' + target + '"]')
                    .removeClass('notactive-tab').addClass('active-tab');

                $(this).parent()
                    .removeClass('notactive-tab-link').addClass('active-tab-link');

                $(self.element).find('.thz-tabs-group[data-tabs-group="' + dataGroup + '"]').attr('data-isopen', group);
            });

        },

        ThzLoadIcons: function() {

            var self = this;

            $(self.element).find('.thz-icons').each(function(index, element) {

                var $element = $(element);
                var $iconsholder = $element.find('.thz-icon-input');
                var $icon_name = $element.find('.thz-icon-name');
                var $add_icons = $iconsholder.attr('data-add-icons');
                var $remove_icons = $iconsholder.attr('data-remove-icons');
                var $remove_categories = $iconsholder.attr('data-remove-categories');
                var $categories = $iconsholder.attr('data-categories');
                var thz_icons_list = $.extend(true, {}, thz_icon_source);
                var thz_icons_search_list = $.extend(true, {}, thz_icon_search);

                // global custom set
                if ($customIconSet != undefined && $customIconSet != '') {

                    $.each($customIconSet, function(cat, items) {

                        if (thz_icons_list[cat] == undefined) {
                            thz_icons_list[cat] = [];
                        }

                        for (var i = 0; i < items.length; i++) {
                            thz_icons_list[cat].push(items[i]);
                        }
                    });
                }

                // add icons
                if ($add_icons != undefined) {

                    var $addIconsArray = JSON.parse($add_icons);

                    if ($addIconsArray != '') {
                        $.each($addIconsArray, function(cat, items) {

                            if (thz_icons_list[cat] == undefined) {
                                thz_icons_list[cat] = [];
                            }

                            for (var i = 0; i < items.length; i++) {
                                thz_icons_list[cat].push(items[i]);
                            }
                        });
                    }
                }

                // remove icons 

                if ($remove_icons != undefined) {

                    var $removeIconsArray = JSON.parse($remove_icons);
                    if ($removeIconsArray != '') {
                        $.each(thz_icons_list, function(cat, items) {

                            $.each($removeIconsArray, function(i, icon) {
                                var index = thz_icons_list[cat].indexOf(icon);
                                if (index > -1) {
                                    thz_icons_list[cat].splice(index, 1);
                                }
                            });

                        });
                    }

                }

                // remove categories 
                if ($remove_categories != undefined) {

                    var $removeCatsArray = JSON.parse($remove_categories);
                    if ($removeCatsArray != '') {

                        for (var i = 0; i < $removeCatsArray.length; i++) {

                            delete thz_icons_list[$removeCatsArray[i]];
                        }
                    }
                }

                // specific categories

                if ($categories != undefined) {

                    var $CatsArray = JSON.parse($categories);

                    if ($CatsArray != '') {

                        var kept = {};
                        for (var i = 0; i < $CatsArray.length; i++) {
                            kept[$CatsArray[i]] = thz_icons_list[$CatsArray[i]];
                        }

                        thz_icons_list = kept;
                    }
                }

                var $thz_icon_picker = $iconsholder.fontIconPicker({
                    theme: 'fip-grey',
                    source: thz_icons_list,
                    allCategoryText: 'All icon sets',
                    searchSource: thz_icons_search_list,
                    appendTo: 'self',
                });

                var $current = $iconsholder.val();
                var $selected = $element.find('.selected-icon i');
                var $trigger = $element.find('.selector-button');
                var $category = $element.find('.icon-category-select');

                $icon_name.val($current);
                $iconsholder.on('change', function(e) {
                    var $val = $(this).val();
                    $icon_name.val($val);

                });

            });

        },

        ThzIsTrans: function(color) {

            var self = this;
            var colorsplit;

            if (color.indexOf('rgba') > -1) {

                colorsplit = color.
                replace('rgba', '').
                replace('(', '').
                replace(')', '').
                replace(';', '').
                replace(' ', '').
                split(',');

                if (colorsplit.length == 4 && colorsplit[colorsplit.length - 1] == 0) {
                    color = 'transparent';
                }

            }

            return color;

        },


        customMsg: function(title, msg, id) {

            var self = this;
            var modal_html = '<div class="thz-template-msg-holder">';
            modal_html += '<h2 class="thz-template-msg-title">';
            modal_html += title;
            modal_html += '</h2>';
            modal_html += '<div class="thz-button-msg">';
            modal_html += '<div class="thz-button-msg-in">';
            modal_html += msg;
            modal_html += '</div>';
            modal_html += '</div>';
            modal_html += '</div>';
            fw.soleModal.show('thz_modal_btn_' + id, modal_html, {
                autoHide: 5000,
                allowClose: true
            });

        },

        customMsgClose: function(id) {
            fw.soleModal.hide('thz_modal_btn_' + id);
        },


        deliteWarningMsg: function(label) {


            var self = this;


            var modal_html = '<h2 class="fw-text-muted">';
            modal_html += _thzbtn.deleting + label;
            modal_html += '</h2>';
            modal_html += '<div class="thz_deleting_button_text">';
            modal_html += _thzbtn.abouttodelete + label;
            modal_html += _thzbtn.clicktocontinue;
            modal_html += '</div>';
            modal_html += '<a class="button-primary thz_btn_delete">' + _thzbtn.continuedeleting + label + _thzbtn.continuedeleting2 + '</a>';
            fw.soleModal.show('thz_deleting_button', modal_html, {
                autoHide: 0,
                width: 500,
                height: 300,
                allowClose: true,
            });

        },

        ThzBtnHelp: function() {

            var self = this;
            var idIncrement = 1;

            function initHide($i) {
                var api = $i.qtip('api');

                var hideTimeout = 0;
                var hideDelay = 200;

                var hide = function() {
                    clearTimeout(hideTimeout);

                    hideTimeout = setTimeout(function() {
                        $i.trigger('thz-qtip:hide');
                    }, hideDelay);
                };

                {
                    api.elements.tooltip
                        .on('mouseenter', function() {
                            clearTimeout(hideTimeout);
                        })
                        .on('mouseleave', function() {
                            hide();
                        });

                    $i
                        .on('mouseenter', function() {
                            clearTimeout(hideTimeout);
                        })
                        .on('mouseleave', function() {
                            hide();
                        });
                }
            };

            $('.thz-btn-help').each(function() {
                var $i = $(this);

                var id = 'thz-qtip-' + idIncrement++;

                var hideInitialized = false;

                $i.qtip({
                    id: id,
                    position: {
                        viewport: $(document.body),
                        at: 'top center',
                        my: 'bottom center',
                        adjust: {
                            y: 2
                        }
                    },
                    style: {
                        classes: $i.hasClass('dashicons-info') ? 'qtip-thz thz-tip-info' : 'qtip-thz',
                        tip: {
                            width: 12,
                            height: 5
                        }
                    },
                    show: {
                        solo: true,
                        event: 'mouseover',
                        effect: function(offset) {
                            // fix tip position
                            setTimeout(function() {
                                offset.elements.tooltip.css('top', (parseInt(offset.elements.tooltip.css('top')) + 5) + 'px');
                            }, 12);

                            if (!hideInitialized) {
                                initHide($i);

                                hideInitialized = true;
                            }

                            $(this).fadeIn(300);
                        }
                    },
                    hide: {
                        event: 'thz-qtip:hide',
                        effect: function(offset) {
                            $(this).fadeOut(300, function() {
                                /**
                                 * Reset tip content html.
                                 * Needed for video tips, after hide the video should stop.
                                 */
                                api.elements.content.html($i.attr('title'))
                            });
                        }
                    }
                });

                $i.on('remove', function() {
                    api.hide();
                });

                var api = $i.qtip('api');
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


})(jQuery, window, document); // JavaScript Document



"use strict";(function(t){"object"===typeof exports?module.exports=t():"function"===typeof define&&define.amd?define(t):(window.WatchJS=t(),window.watch=window.WatchJS.watch,window.unwatch=window.WatchJS.unwatch,window.callWatchers=window.WatchJS.callWatchers)})(function(){function t(){u=null;for(var a=0;a<v.length;a++)v[a]();v.length=0}var k={noMore:!1,useDirtyCheck:!1},p=[],l=[],w=[],C=!1;try{C=Object.defineProperty&&Object.defineProperty({},"x",{})}catch(Y){}var x=function(a){var b={};return a&&"[object Function]"==b.toString.call(a)},g=function(a){return"[object Array]"===Object.prototype.toString.call(a)},y=function(a){return"[object Object]"==={}.toString.apply(a)},H=function(a,b){var c=[],d=[];if("string"!=typeof a&&"string"!=typeof b){if(g(a))for(var e=0;e<a.length;e++)void 0===b[e]&&c.push(e);else for(e in a)a.hasOwnProperty(e)&&void 0===b[e]&&c.push(e);if(g(b))for(var f=0;f<b.length;f++)void 0===a[f]&&d.push(f);else for(f in b)b.hasOwnProperty(f)&&void 0===a[f]&&d.push(f)}return{added:c,removed:d}},q=function(a){if(null==a||"object"!=typeof a)return a;var b=a.constructor(),c;for(c in a)b[c]=a[c];return b},R=function(a,b,c,d){try{Object.observe(a,function(a){a.forEach(function(a){a.name===b&&d(a.object[a.name])})})}catch(e){try{Object.defineProperty(a,b,{get:c,set:function(a){d.call(this,a,!0)},enumerable:!0,configurable:!0})}catch(f){try{Object.prototype.__defineGetter__.call(a,b,c),Object.prototype.__defineSetter__.call(a,b,function(a){d.call(this,a,!0)})}catch(h){I(a,b,d)}}}},J=function(a,b,c){try{Object.defineProperty(a,b,{enumerable:!1,configurable:!0,writable:!1,value:c})}catch(d){a[b]=c}},I=function(a,b,c){l[l.length]={prop:b,object:a,orig:q(a[b]),callback:c}},n=function(a,b,c,d){if("string"!=typeof a&&(a instanceof Object||g(a))){if(g(a)){if(K(a,"__watchall__",b,c),void 0===c||0<c)for(var e=0;e<a.length;e++)n(a[e],b,c,d)}else{var f=[];for(e in a)"$val"==e||!C&&"watchers"===e||Object.prototype.hasOwnProperty.call(a,e)&&f.push(e);B(a,f,b,c,d)}d&&L(a,"$$watchlengthsubjectroot",b,c)}},B=function(a,b,c,d,e){if("string"!=typeof a&&(a instanceof Object||g(a)))for(var f=0;f<b.length;f++)D(a,b[f],c,d,e)},D=function(a,b,c,d,e){"string"!=typeof a&&(a instanceof Object||g(a))&&!x(a[b])&&(null!=a[b]&&(void 0===d||0<d)&&n(a[b],c,void 0!==d?d-1:d),K(a,b,c,d),e&&(void 0===d||0<d)&&L(a,b,c,d))},S=function(a,b){if(!(a instanceof String)&&(a instanceof Object||g(a)))if(g(a)){for(var c=["__watchall__"],d=0;d<a.length;d++)c.push(d);E(a,c,b)}else{var e=function(a){var c=[],d;for(d in a)a.hasOwnProperty(d)&&(a[d]instanceof Object?e(a[d]):c.push(d));E(a,c,b)};e(a)}},E=function(a,b,c){for(var d in b)b.hasOwnProperty(d)&&M(a,b[d],c)},v=[],u=null,N=function(){u||(u=setTimeout(t));return u},O=function(a){null==u&&N();v[v.length]=a},F=function(a,b,c,d){var e=null,f=-1,h=g(a);n(a,function(d,c,r,m){var g=N();f!==g&&(f=g,e={type:"update"},e.value=a,e.splices=null,O(function(){b.call(this,e);e=null}));if(h&&a===this&&null!==e){if("pop"===c||"shift"===c)r=[],m=[m];else if("push"===c||"unshift"===c)r=[r],m=[];else if("splice"!==c)return;e.splices||(e.splices=[]);e.splices[e.splices.length]={index:d,deleteCount:m?m.length:0,addedCount:r?r.length:0,added:r,deleted:m}}},1==c?void 0:0,d)},T=function(a,b,c,d,e){a&&b&&(D(a,b,function(a,b,A,k){a={type:"update"};a.value=A;a.oldvalue=k;(d&&y(A)||g(A))&&F(A,c,d,e);c.call(this,a)},0),(d&&y(a[b])||g(a[b]))&&F(a[b],c,d,e))},K=function(a,b,c,d){var e=!1,f=g(a);a.watchers||(J(a,"watchers",{}),f&&U(a,function(c,e,f,h){P(a,c,e,f,h);if(0!==d&&f&&(y(f)||g(f))){var k,l;c=a.watchers[b];if(h=a.watchers.__watchall__)c=c?c.concat(h):h;l=c?c.length:0;for(h=0;h<l;h++)if("splice"!==e)n(f,c[h],void 0===d?d:d-1);else for(k=0;k<f.length;k++)n(f[k],c[h],void 0===d?d:d-1)}}));a.watchers[b]||(a.watchers[b]=[],f||(e=!0));for(f=0;f<a.watchers[b].length;f++)if(a.watchers[b][f]===c)return;a.watchers[b].push(c);if(e){var h=a[b];c=function(){return h};e=function(c,e){var f=h;h=c;if(0!==d&&a[b]&&(y(a[b])||g(a[b]))&&!a[b].watchers){var m,l=a.watchers[b].length;for(m=0;m<l;m++)n(a[b],a.watchers[b][m],void 0===d?d:d-1)}a.watchers&&(a.watchers.__wjs_suspend__||a.watchers["__wjs_suspend__"+b])?V(a,b):k.noMore||f===c||(e?P(a,b,"set",c,f):z(a,b,"set",c,f),k.noMore=!1)};k.useDirtyCheck?I(a,b,e):R(a,b,c,e)}},z=function(a,b,c,d,e){if(void 0!==b){var f,h=a.watchers[b];if(f=a.watchers.__watchall__)h=h?h.concat(f):f;f=h?h.length:0;for(var g=0;g<f;g++)h[g].call(a,b,c,d,e)}else for(b in a)a.hasOwnProperty(b)&&z(a,b,c,d,e)},Q="pop push reverse shift sort slice unshift splice".split(" "),W=function(a,b,c,d){J(a,c,function(){var e=0,f,h,g;if("splice"===c){g=arguments[0];h=a.slice(g,g+arguments[1]);f=[];for(e=2;e<arguments.length;e++)f[e-2]=arguments[e];e=g}else f=0<arguments.length?arguments[0]:void 0;g=b.apply(a,arguments);"slice"!==c&&("pop"===c?(h=g,e=a.length):"push"===c?e=a.length-1:"shift"===c?h=g:"unshift"!==c&&void 0===f&&(f=g),d.call(a,e,c,f,h));return g})},U=function(a,b){if(x(b)&&a&&!(a instanceof String)&&g(a))for(var c=Q.length,d;c--;)d=Q[c],W(a,a[d],d,b)},M=function(a,b,c){if(void 0===c&&a.watchers[b])delete a.watchers[b];else for(var d=0;d<a.watchers[b].length;d++)a.watchers[b][d]==c&&a.watchers[b].splice(d,1);for(d=0;d<p.length;d++){var e=p[d];e.obj==a&&e.prop==b&&e.watcher==c&&p.splice(d,1)}for(c=0;c<l.length;c++)d=l[c],e=d.object.watchers,(d=d.object==a&&d.prop==b&&e&&(!e[b]||0==e[b].length))&&l.splice(c,1)},V=function(a,b){O(function(){delete a.watchers.__wjs_suspend__;delete a.watchers["__wjs_suspend__"+b]})},G=null,P=function(a,b,c,d,e){w[w.length]={obj:a,prop:b,mode:c,newval:d,oldval:e};null===G&&(G=setTimeout(X))},X=function(){var a=null;G=null;for(var b=0;b<w.length;b++)a=w[b],z(a.obj,a.prop,a.mode,a.newval,a.oldval);a&&(w=[])},L=function(a,b,c,d){var e;e="$$watchlengthsubjectroot"===b?q(a):q(a[b]);p.push({obj:a,prop:b,actual:e,watcher:c,level:d})};setInterval(function(){for(var a=0;a<p.length;a++){var b=p[a];if("$$watchlengthsubjectroot"===b.prop){var c=H(b.obj,b.actual);if(c.added.length||c.removed.length)c.added.length&&B(b.obj,c.added,b.watcher,b.level-1,!0),b.watcher.call(b.obj,"root","differentattr",c,b.actual);b.actual=q(b.obj)}else{c=H(b.obj[b.prop],b.actual);if(c.added.length||c.removed.length){if(c.added.length)for(var d=0;d<b.obj.watchers[b.prop].length;d++)B(b.obj[b.prop],c.added,b.obj.watchers[b.prop][d],b.level-1,!0);z(b.obj,b.prop,"differentattr",c,b.actual)}b.actual=q(b.obj[b.prop])}}for(a in l){var b=l[a],c=b.object[b.prop],d=b.orig,e=c,f=void 0,g=!0;if(d!==e)if(y(d))for(f in d){if((C||"watchers"!==f)&&d[f]!==e[f]){g=!1;break}}else g=!1;g||(b.orig=q(c),b.callback(c))}},50);k.watch=function(){x(arguments[1])?n.apply(this,arguments):g(arguments[1])?B.apply(this,arguments):D.apply(this,arguments)};k.unwatch=function(){x(arguments[1])?S.apply(this,arguments):g(arguments[1])?E.apply(this,arguments):M.apply(this,arguments)};k.callWatchers=z;k.suspend=function(a,b){a.watchers&&(a.watchers["__wjs_suspend__"+(void 0!==b?b:"")]=!0)};k.onChange=function(){(x(arguments[2])?T:F).apply(this,arguments)};return k});