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

    var pluginName = "ThzAddLink",
        defaults = {
            mode: 'switch'
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


            this.data_parent = $(self.element).attr('data-parent');
			
			if(this.data_parent =='parent'){
				this.data_parent = $(self.element).parent();
			}
			
            this.data_type = $(self.element).attr('data-type');
            this.data_link = $(self.element).attr('data-link');
            this.data_title = $(self.element).attr('data-title');
            this.data_target = $(self.element).attr('data-target');
            this.data_magnific = $(self.element).attr('data-magnific');


            this.connect_type = $(self.data_parent).find(self.data_type);
            this.connect_link = $(self.data_parent).find(self.data_link);
            this.connect_title = $(self.data_parent).find(self.data_title);
            this.connect_target = $(self.data_parent).find(self.data_target);
            this.connect_magnific = $(self.data_parent).find(self.data_magnific);

            self.ThzLink();



        },


        ThzLink: function() {


            var self = this;


            $(self.element).on("click", function(e) {
                e.preventDefault();

                self.ThzLinkModal();
                return false;
            });
        },



        ThzLinkModal: function() {

            var self = this;

            var current_type = $(self.connect_type).val();
            var current_link = $(self.connect_link).val();
            var current_title = $(self.connect_title).val();
            var current_target = $(self.connect_target).val();
            var current_magnific = $(self.connect_magnific).val();
			var $hideclass ='';
			


            if (self.settings.mode == 'switch') {
                var modaloptions = [{

                    'thz_link_type': {
                        'type': 'multi-picker',
                        'label': false,
                        'picker': {
                            'picked': {
                                'label':_thz_add_link.typelabel,
                                'desc': _thz_add_link.typedesc,
                                'type': 'switch',
                                'left-choice': {

                                    'value': 'normal',
                                    'label': _thz_add_link.typenormal

                                },
                                'right-choice': {
                                    'value': 'magnific',
                                    'label': _thz_add_link.typemagnific
                                },
                                'attr': {
                                    'class': 'thz_url_type',
                                },
                                'value': current_type,

                            },


                        },
                        'choices': {
                            'normal': {

                                'thz_url': {
                                    'type': 'text',
                                    'label': _thz_add_link.urllabel,
                                    'value': current_link,
                                    'attr': {
                                        'class': 'thz_url',
                                    },
                                    'desc': _thz_add_link.urldesc
                                },


                                'thz_title': {
                                    'type': 'text',
                                    'label': _thz_add_link.titlelabel,
                                    'value': current_title,

                                    'attr': {
                                        'class': 'thz_url_title',
                                    },
                                    'desc': _thz_add_link.titledesc
                                },


                                'thz_target': {
                                    'type': 'switch',
                                    'label': _thz_add_link.targetlabel,
                                    'value': current_target,
                                    'left-choice': {

                                        'value': '_self',
                                        'label': _thz_add_link.same

                                    },
                                    'right-choice': {
                                        'value': '_blank',
                                        'label': _thz_add_link.new
                                    },

                                    'attr': {
                                        'class': 'thz_url_target',
                                    },
                                    'desc': _thz_add_link.targetdesc
                                },

                                'thz_find_url': {
                                    'type': 'text',
                                    'label': _thz_add_link.searchlabel,

                                    'attr': {
                                        'class': 'thz_find_url',
                                    },
                                    'desc': _thz_add_link.searchdesc
                                }


                            },
                            'magnific': {

                                'thz_popup_id': {
                                    'type': 'text',
                                    'label': _thz_add_link.magnificlabel,
                                    'value': current_magnific,

                                    'attr': {
                                        'class': 'thz_url_magnific',
                                    },
                                    'desc': _thz_add_link.magnificdesc,
                                    'help': _thz_add_link.magnifichelp
                                },


                            }
                        },
                        'show_borders': false,

                        'attr': {
                            'class': 'thz_type',
                        },
                        'desc': false
                    },




                }];
            } else {

                modaloptions = [{

                    'thz_url': {
                        'type': 'text',
                        'label': _thz_add_link.urllabel,
                        'value': current_link,

                        'attr': {
                            'class': 'thz_url',
                        },
                        'desc': _thz_add_link.urldesc
                    },


                    'thz_title': {
                        'type': 'text',
                        'label': _thz_add_link.titlelabel,
                        'value': current_title,

                        'attr': {
                            'class': 'thz_url_title',
                        },
                        'desc': _thz_add_link.titledesc
                    },


                    'thz_target': {
                        'type': 'switch',
                        'label': _thz_add_link.targetlabel,
                        'value': current_target,
                        'left-choice': {

                            'value': '_self',
                            'label': _thz_add_link.same

                        },
                        'right-choice': {
                            'value': '_blank',
                            'label': _thz_add_link.new
                        },

                        'attr': {
                            'class': 'thz_url_target',
                        },
                        'desc': _thz_add_link.targetdesc
                    },

                    'thz_find_url': {
                        'type': 'text',
                        'label': _thz_add_link.searchlabel,

                        'attr': {
                            'class': 'thz_find_url',
                        },
                        'desc': _thz_add_link.searchdesc
                    }

                }];

            }
			
			$hideclass ='';
			if($(self.element).attr('data-hide')){
				$hideclass = ' '+$(self.element).attr('data-hide')
			}
			
            var save_link_modal = new fw.OptionsModal({

                title: _thz_add_link.addlink,
                options: modaloptions,
                size: 'large',
				modalCustomClass: 'thz-url-modal' + $hideclass
            });

            save_link_modal.on('change:values', function(modal, values) {


                if (self.settings.mode == 'switch') {

                    var new_type = values.thz_link_type.picked;
                    var new_link = values.thz_link_type.normal.thz_url;
                    var new_title = values.thz_link_type.normal.thz_title;
                    var new_target = values.thz_link_type.normal.thz_target;
                    var new_magnific = values.thz_link_type.magnific.thz_popup_id;

                    if (new_type == 'magnific') {

                        new_link = new_magnific;
                    }

                } else {

                    var new_link = values.thz_url;
                    var new_title = values.thz_title;
                    var new_target = values.thz_target;

                }
				

                if (self.settings.mode == 'switch') {
                    $(self.connect_type).val(new_type).trigger('change');
                    $(self.connect_magnific).val(self.ThzStripTags(new_magnific)).trigger('change');
                }

                $(self.connect_link).val(self.ThzStripTags(new_link)).trigger('change');
                $(self.connect_title).val(self.ThzStripTags(new_title)).trigger('change');
                $(self.connect_target).val(new_target).trigger('change');



            });

			save_link_modal.on('render', function(e) {
				self.ThzLinkSearch('.thz_find_url');
			});
			
			
/*            save_link_modal.on('open', function() {

                setTimeout(function() {
                    self.ThzLinkSearch('.thz_find_url');
                }, 500);

            });*/

            save_link_modal.open();

            $('.media-modal-content').on('change keyup paste', '.thz_find_url', function() {
                self.ThzLinkSearch('.thz_find_url');
            });

            $('.media-modal-content').on('change', '.thz_url_type :checkbox', function() {
                self.ThzLinkSearch('.thz_find_url');
            });


        },


		ThzStripTags: function (string) {
			
			var self = this;
			
			var decoded_string = $("<div/>").html(string).text();
			return $("<div/>").html(decoded_string).text();
			
		},
		
		
        ThzLinkSearch: function(element) {


            var self = this;

            $(element).autocomplete({
                source: function(request, response) {

                    $.ajax({

                        url: ajaxurl,
                        type: 'POST',
                        data: {
                            'action': 'thz_get_links_action',
                            'linkSearch': request.term

                        },
                        dataType: 'json',
                        success: function(data) {

                            $(this).removeClass('ui-autocomplete-loading');
                            if (data.success === false || typeof data.data === 'undefined') {
                                return false;
                            }



                            if (data.data.length === 0) {
                                response({
                                    label: _thz_add_link.nomatch
                                });

                            } else {

                                response($.map(data.data, function(val, index) {

                                    return {
                                        label: data.data[index].label,
                                        value: data.data[index].value,
                                        id: index,
                                    }

                                }));

                            }

                        },
                        error: function(e) {
                            $(this).removeClass('ui-autocomplete-loading');
                            return false;
                        }
                    });

                },


                select: function(event, ui) {


                    if (ui.item.value != _thz_add_link.nomatch) {
                        $(element).closest('.media-modal-content')
                            .find('.thz_url').val(ui.item.value);
                    }

                    $(element).autocomplete("destroy");
                    self.ThzLinkSearch(element);

                    $(this).val('');
                    return false;

                },


                open: function() {
                    $(this).data("uiAutocomplete").menu.element.addClass("thz-link-autocomplete-menu")
                        .css('z-index', 180000);

                },
                close: function() {
                    $(this).removeClass("ui-corner-top").addClass("ui-corner-all");
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

})(jQuery, window, document);