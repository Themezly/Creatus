(function($, _, fwEvents, window) {

    function thzTabs(element) {

        element.find('.thz-tab-link').on('click', function(event) {

            event.preventDefault();

            var target = $(this).attr('data-tab');
            var group = $(this).attr('data-group');
            var dataGroup = $(this).parent().attr('data-tabs-group');

            element.find('li[data-tabs-group="' + dataGroup + '"]')
                .removeClass('active-tab-link').addClass('notactive-tab-link');

            element.find('.thz-tab[data-tabs-group="' + dataGroup + '"]')
                .removeClass('active-tab').addClass('notactive-tab');

            element.find('div[data-tab="' + target + '"]')
                .removeClass('notactive-tab').addClass('active-tab');

            $(this).parent()
                .removeClass('notactive-tab-link').addClass('active-tab-link');

            element.find('.thz-tabs-group[data-tabs-group="' + dataGroup + '"]').attr('data-isopen', group);
        });

    }

    function thzstylepopup(el) {

        var $this = el,
            $defaultItem = $this.find('.item.default'),
            nodes = {
                $optionWrapper: $this,
                $itemsWrapper: $this.find('.items-wrapper'),
                $disabledItem: $defaultItem.clone().removeClass('default').addClass('disabled'),
                getDefaultItem: function() {
                    return $defaultItem.clone().removeClass('default');
                }
            },

            data = JSON.parse(nodes.$optionWrapper.attr('data-for-js')),
            utils = {
                modal: new fw.OptionsModal({
                    title: data.title,
                    options: data.options,
                    size: data.size
                }),

                editItem: function(item, values) {
                    var $input = item.find('input'),
                        val = $input.val();

                    $input.val(values = JSON.stringify(values));

                    if (val != values) {
                        $this.trigger('fw:option-type:popup:change');
                        $input.trigger('change');
                    }
                }
            };

        nodes.$itemsWrapper.on('click', '.item > .button', function(e) {
            e.preventDefault();

            var values = {},
                $item = $(this).closest('.item'),
                $input = $item.find('input');

            if ($input.length && $input.val().length) {
				
				values = JSON.parse($input.val());
				
/*				if(toString.call($input.val()) === '[object Object]'){
                	values = JSON.parse($input.val());
				}else{
					
					console.log($input.val());
				}*/
            }

            utils.modal.set('edit', true);
            utils.modal.set('values', values, {
                silent: true
            });
            utils.modal.set('itemRef', $item);
            utils.modal.open();

            $(utils.modal.frame.$el).addClass('thz-box-style-modal');

            $input.trigger('change');
        });

        utils.modal.on({
            'change:values': function(modal, values) {
                utils.editItem(utils.modal.get('itemRef'), values);

                fwEvents.trigger('fw:option-type:thz-box-style-popup:change', {
                    element: $this,
                    values: values
                });
            },
            'open': function() {
                $this.trigger('fw:option-type:thz-box-style-popup:open');
            },
            'close': function() {
                $this.trigger('fw:option-type:thz-box-style-popup:close');
            },
            'render': function() {
                $this.trigger('fw:option-type:thz-box-style-popup:render');
				

            }
        });

        utils.modal.on('render', function() {
            setTimeout(function() {
                $('.media-frame-content').find('.thz-box-style-preview-holder').trigger('click');
            }, 500);

        });
    };

    fwEvents.on('fw:options:init', function(data) {

        data.$elements.find('.fw-option-type-thz-box-style:not(.thz-option-initialized)').each(function() {

            var $this = $(this);

            thzTabs($this);

            if ($this.hasClass('thz-box-style-in-popup')) {
                thzstylepopup($this);
            }

            $this.find('.borders-same').on('change', function(e) {

                var $val = $(this).val();
                var $el_hide = '.borders-top-container h4,.borders-right-container,.borders-bottom-container,.borders-left-container';

                if ($val == 'same') {

                    $this.find($el_hide).hide();

                    var $width = $this.find('.borders-top-container .border-width').val();
                    var $style = $this.find('.borders-top-container .border-style').val();
                    var $color = $this.find('.borders-top-container .border-color').val();

                    $this.find('.border-width').val($width).trigger('change');
                    $this.find('.border-style').val($style).trigger('change');
                    $this.find('.border-color').val($color).trigger('fw:thz:color:picker:changed');
                    //$this.find('.thz-color-picker-trigger').css('background-color', $color);

                } else {

                    $this.find($el_hide).show();
                }

            }).trigger('change');

            $this.find('.thz-bs-poz').on('change', function(e) {

                var $val = $(this).val();

                var $el_hide = '[class$="-layout-top"],[class$="-layout-right"],[class$="-layout-bottom"],[class$="-layout-left"],[class$="-layout-z-index"]';

                if ($val == 'default' || $val == 'static') {

                    $this.find($el_hide).hide();

                } else {

                    $this.find($el_hide).show();

                }

            }).trigger('change');
			
			
            $this.find('.thz-bs-display').on('change', function(e) {

                var $val = $(this).val();

                if ($val == 'none') {

                    $this.find('.thz-bs-layout .thz-multi-options-holder:not(:first-child)').css('opacity',0.5);

                } else {

                    $this.find('.thz-bs-layout .thz-multi-options-holder:not(:first-child)').css('opacity',1);

                }

            }).trigger('change');
			

        }).addClass('thz-option-initialized');

    });

})(jQuery, _, fwEvents, window);