/**
 * @package      ThzTextRotator
 * @copyright    Copyright(C) since 2007  Themezly.com. All Rights Reserved.
 * @author       Themezly
 * @license      http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 * @websites     http://www.themezly.com | http://www.youjoomla.com
 */
;
(function($, window, document, undefined) {

    "use strict";

    var pluginName = "ThzTextRotator",
        defaults = {
            start_delay: 200,
            rotation_delay: 2e3,
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
            this.getlist = $(self.element).find('.text-string');

            if (self.getlist.length > 0) {

                if ($(self.element).attr('data-start-delay')) {
                    self.settings.start_delay = parseFloat($(self.element).attr('data-start-delay'));
                }

                if ($(self.element).attr('data-rotation-delay')) {
                    self.settings.rotation_delay = parseFloat($(self.element).attr('data-rotation-delay'));
                }

                self.slideIn(self.getlist[0]);
                $(self.element).addClass('isactive');
            }


        },

        resize: function(el) {
            var self = this;
            $(el).parent().css({
                width: $(el).width()
            });
        },

        slideIn: function(el) {

            var self = this;

            var $delay = self.settings.rotation_delay;
            if ($(el).hasClass('first')) {
                $delay = self.settings.start_delay;
            }

            // resize area to sliding element
            self.resize($(el));
            // add slide-in class
            $(el).addClass('text-active');
            // after 'hold' duration slide-out current item
            // then slide in next item
            setTimeout(function() {
                // check to see if loop should continue
                if (stop === true) {
                    stop = false;
                    return;
                }
                // slide current element out
                self.slideOut(el);
                // slide in next element in queue
                self.slideIn($(el).next());
            }, $delay);
        },

        slideOut: function(el) {

            var self = this;
            // remove current class and add slide-out transition
            $(el).removeClass('text-active').addClass('text-inactive')
                .removeClass('first');
            // wait for slide tramsition to finish then
            // call 'change' function
            setTimeout(function() {
                self.change();
            }, 600);
        },

        change: function() {

            var self = this;
            // store last item index
            var i = self.getlist.length - 1;
            // detach element that has slide-out class
            // put to the bottom of the list after
            // the last item
            //$(self.getlist).eq(i).after($('.slide-out').detach());

            //console.log($(self.getlist).eq(i), $('.adj:eq(' + i + ')'));
            var slideout = $(self.element).find('.text-inactive');
            $(self.element).find('.text-string:eq(' + i + ')').after(slideout.detach());
            //  $('.adj:eq(' + i + ')').after($('.slide-out').detach());
            // remove class to send element back to original position
            self.getlist.removeClass('text-inactive');
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