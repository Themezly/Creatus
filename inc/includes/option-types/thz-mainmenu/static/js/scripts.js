(function($, fwe) {

    fwe.on('fw:options:init', function(data) {

        data.$elements.find('.fw-option.fw-option-type-thz-mainmenu:not(.thz-option-initialized)').each(function() {

            var $this = $(this);
            var $show_preview = $this.find('.thz-show-menu-preview');
            var $show_box = $this.find('.thz-mainmenu-preview-container');

            $(document).on('click', '.thz-palette-box .thz-color-picker-trigger,.thz-templates.button,.submit-button-reset,.media-modal-backdrop,.media-modal-close,.media-toolbar .media-button', function(e) {


                if ($('.thz-menu-preview-dialog').length) {

                    $('.thz-menu-preview-dialog').hide("scale", {
                        percent: 0,
                        origin: ['middle', 'center']
                    }, 500, function() {

                        $('.thz-menu-preview-dialog').remove();
                    });

                }
            });

            $show_preview.on('click', function(e) {
                e.preventDefault();
                fwEvents.trigger('fw:options:init:tabs', {
                    $elements: $('#fw-options-tab-headertab,#fw-options-box-mainmenu_subbox,.media-frame-content')
                });
                var preview_dialog = $show_box.dialog({
					create: function(event, ui) {
						$(event.target).parent().css('position', 'fixed');
					},
					resizeStop: function(event, ui) {
						var position = [(Math.floor(ui.position.left) - $(window).scrollLeft()),
										 (Math.floor(ui.position.top) - $(window).scrollTop())];
						$(event.target).parent().css('position', 'fixed');
						$($show_box).dialog('option','position',position);
					},
                    dialogClass: "thz-menu-preview-dialog",
                    title: _thzmp.dialog_title,
                    autoOpen: false,
                    minWidth: 500,
                    width: 780,
                    show: {
                        effect: 'scale',
                        speed: 500
                    },
                    hide: {
                        effect: 'scale',
                        speed: 500
                    },
                    position: {
                        my: "right-20 top+20",
                        at: "right-20 top+20",
                        of: window
                    },
                    close: function(event, ui) {

                        preview_dialog.dialog('destroy');
                    }
                });

                $this.ThzMenuPreview();

                var previewState = preview_dialog.dialog('isOpen');

                if (previewState) {
                    preview_dialog.dialog('close');
                } else {
                    preview_dialog.dialog('open');
                }

            });

        }).addClass('thz-option-initialized');

    });

})(jQuery, fwEvents);