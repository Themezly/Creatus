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

    var pluginName = "ThzPageTemplates",
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

            self.ThzCreateTemplate();
            self.ThzLoadTemplate();
            self.ThzDeleteTemplate();

        },


        ThzCollectData: function() {

            var self = this;

            var $inputs = $('.thz-page-options-container .items-wrapper .item .input-wrapper :input,#fw-option-pcss .items-wrapper .item .input-wrapper :input');
            var $data = {};
			
			if($('#page_template').length > 0){
				var $template = $('#page_template').val();
				$data['page_template'] = $template;
			}
			
			if($('.header_brightness').length > 0){
				var $brightness = $('.header_brightness').val();
				
				if($brightness !='none'){
					$data['header_brightness'] = $brightness;
				}
			}

            $inputs.each(function(index, element) {

                var $this = $(this);
                var $name = $this.attr('id');
                var $val = $this.val();


                if ($val != '') {

                    $data[$name] = $val;

                }

            });


            return $data;

        },


        ThzAddToTemplateList: function(title, id) {

            var self = this;

            var $list = $('.thz-page-options-templates-list ul');

            var $li = $('<li/>')
                .appendTo($list);

            var $load_btn = $('<a/>')
				.addClass('template-load')
                .attr('data-load-pagetmpl', id)
                .attr('href', '#')
                .attr('onclick', 'return false')
                .html(title)
                .appendTo($li);

            var $delete_btn = $('<a/>')
                .addClass('template-delete dashicons fw-x')
                .attr('data-delete-pagetmpl', id)
                .attr('href', '#')
                .attr('onclick', 'return false')
                .appendTo($li);

        },

        ThzCreateTemplate: function() {

            var self = this;


            var loadingId = 'thz-page-templates-modal';
            var modal = new fw.OptionsModal({
                title: _thzoptmpl.modal_title,
                options: [{
                    'template_name': {
                        'type': 'text',
                        'label': _thzoptmpl.modal_label,
                        'desc': _thzoptmpl.modal_desc
                    }
                }],
                values: ''
            });


            modal.on('open', function(modal, values) {

            });


            $('.thz-add-page-template').on('click', function(e) {

                e.stopPropagation();
                e.preventDefault();


                var $json = self.ThzCollectData();

                // reset previous values
                modal.set('values', {}, {
                    silent: true
                });

                // remove previous listener
                modal.off('change:values');

                modal.on('change:values', function(modal, values) {

                    fw.loading.show(loadingId);

                    $.ajax({
                            type: 'post',
                            dataType: 'json',
                            url: ajaxurl,
                            data: {
                                'action': 'thz_page_templates_save',
                                'template_name': values.template_name,
                                'json': JSON.stringify($json),
                            }
                        })
                        .done(function(json) {
                            fw.loading.hide(loadingId);

                            if (!json.success) {
                                console.error('Failed to save options template', json);
                                return;
                            }

                            self.ThzAddToTemplateList(json.data.title, json.data.id);

                        })
                        .fail(function(xhr, status, error) {
                            fw.loading.hide(loadingId);

                            console.error('Ajax save error', error);
                        });
                });


                if (Object.keys($json).length === 0) {

                    var modal_html = '<div class="thz-template-msg-holder">';
                    modal_html += '<h2 class="thz-template-msg-title">';
                    modal_html += _thzoptmpl.no_opt_title;
                    modal_html += '</h2>';
                    modal_html += '<div class="thz-template-msg">';
                    modal_html += '<div class="thz-template-msg-in">';
                    modal_html += _thzoptmpl.no_opt_msg;
                    modal_html += '</div>';
                    modal_html += '</div>';
                    modal_html += '</div>';
                    fw.soleModal.show('thz_modal_msg_templates_empty', modal_html, {
                        autoHide: 5000,
                        allowClose: true
                    });


                } else {

                    modal.open();
                }



            });

        },


        ThzNewItemTemplate: function(id, name, title) {

            var self = this;

            var new_item = '<div class="item">';
            new_item += '<div class="input-wrapper">';
            new_item += '<input name="fw_options[' + name + '][]" id="' + id + '" class="fw-option fw-option-type-hidden" value="" type="hidden">';
            new_item += '</div>';
            new_item += '<div class="content">' + title + '</div>';
            new_item += '<a href="#" class="dashicons fw-x delete-item"></a>';
            new_item += '</div>';


            return new_item;
        },

        ThzFillTemplate: function($data) {

            var self = this;

            var $options = JSON.parse($data.json);
			
			if("page_template" in $options){
				var page_template 	= $options.page_template;
				delete $options.page_template;
				$('#page_template').val( page_template ).trigger('change');
			
			}
			
			if("header_brightness" in $options){
				var header_brightness 	= $options.header_brightness;
				delete $options.header_brightness;
				$('.header_brightness').val( header_brightness ).trigger('change');
			}			
			
            $.each($options, function(id, json) {

                var $split = id.split('-');
                var $realinput = $split[2];
                var $option = $('div#fw-backend-option-fw-option-' + $realinput);
				
				if( $option.length < 1 ){
					return;
				}
				
                var $dataforjs = JSON.parse($option.find('.fw-option-type-addable-popup').attr('data-for-js'));
                var $params = JSON.parse($dataforjs.join('{{'));
                var title = $params.template;

                if ($realinput == 'custom_pagetitle_options') {

                    var $seto_opt = JSON.parse(json);
                    title = 'Page title mode is: <b>' + $seto_opt.page_title_metrics.mode + '</b>';

                }

                if ($realinput == 'hero') {

                    var $seto_opt = JSON.parse(json);
                    title = 'Hero section is: <b>' + $seto_opt.disable + '</b>';

                }

				if ($realinput == 'custom_footer_options') {

					var $seto_opt = JSON.parse(json);
					var $footer_txt = 'Footer and widgets sections';
					if($seto_opt.footer_mx.m == 'both'){
						
						$footer_txt ='Only footer';
						
					}else if($seto_opt.footer_mx.m == 'widgets'){
						
						$footer_txt ='Only widgets sections';
						
					}else if($seto_opt.footer_mx.m == 'hidden'){
						
						$footer_txt ='Hidden';
						
					}
					
					title = 'Custom footer options are active and display mode is: <b>' + $footer_txt + '</b>';

				}
					
                var new_item = self.ThzNewItemTemplate(id, $realinput, title);

                $option.find('.items-wrapper').html(new_item).show({
                    duration: 0,
                    done: function() {

                        $('#' + id).attr('value', json);
                        $option.find('.add-new-item').hide();

                    }
                });


            });

        },

        ThzLoadTemplate: function() {


            var self = this;
            var loadingId = 'thz-loading-template';
            $(document).on('click', '.thz-page-options-templates-list a[data-load-pagetmpl]', function() {

                var $this = $(this);
                var templateId = $(this).attr('data-load-pagetmpl');

                fw.loading.show(loadingId);

                $.ajax({
                        type: 'post',
                        dataType: 'json',
                        url: ajaxurl,
                        data: {
                            'action': 'thz_page_templates_load',
                            'template_id': templateId
                        }
                    })
                    .done(function(json) {
                        fw.loading.hide(loadingId);

                        if (!json.success) {
                            console.error('Failed to load page options template', json);
                            return;
                        }


                        self.ThzFillTemplate(json.data);


                    })
                    .fail(function(xhr, status, error) {
                        fw.loading.hide(loadingId);

                        console.error('Ajax error', error);
                    });
            });

        },

        ThzDeleteTemplate: function() {


            var self = this;
            var loadingId = 'thz-deliting-template';
            $(document).on('click', '.thz-page-options-templates-list a[data-delete-pagetmpl]', function() {

                var $this = $(this);
                var templateId = $(this).attr('data-delete-pagetmpl');

                fw.loading.show(loadingId);

                $.ajax({
                        type: 'post',
                        dataType: 'json',
                        url: ajaxurl,
                        data: {
                            'action': 'thz_page_templates_delete',
                            'template_id': templateId
                        }
                    })
                    .done(function(json) {
                        fw.loading.hide(loadingId);

                        if (!json.success) {
                            console.error('Failed to delete page options template', json);
                            return;
                        }

                        $this.parent().remove();
                    })
                    .fail(function(xhr, status, error) {
                        fw.loading.hide(loadingId);

                        console.error('Ajax error', error);
                    });
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