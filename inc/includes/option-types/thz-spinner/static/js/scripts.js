(function($, fwe) {

    fwEvents.on('fw:options:init', function(data) {

        data.$elements.find('.fw-option.fw-option-type-thz-spinner:not(.thz-option-initialized)').each(function() {

            var $this = $(this);
            $this.thzspinner();

        }).addClass('thz-option-initialized');

    });

})(jQuery, fwEvents);

(function($) {
    $(function() {

        $.fn.thzMouseHold = function(f) {
            var timeout = 100;
            if (f && typeof f == 'function') {
                var intervalId = 0;
                var firstStep = false;
                var clearMousehold = undefined;
                var thisInput = $(this).parent().find('input');

                return this.each(function() {
                    $(this).mousedown(function() {
                        firstStep = true;
                        var ctr = 0;
                        var t = this;
                        intervalId = setInterval(function() {
                            ctr++;
                            f.call(t, ctr);
                            firstStep = false;
                        }, timeout);
                    });

                    clearMousehold = function() {
                        clearInterval(intervalId);
                        if (firstStep) f.call(this, 1);
                        firstStep = false;
                    };

                    $(this).mouseout(clearMousehold);
                    $(this).mouseup(clearMousehold);

                    $(this).on('mouseup', function() {
                        thisInput.trigger('thz:spinner:changed');
                    });
                });
            }
        };

    });
})(jQuery);

! function($) {

    var countDecimals = function(value) {
        return value % 1 ? value.toString().split(".")[1].length : 0;
    };

    var ThzSpinner = function(element, options) {


        var self = this;
        this.element = $(element);
        this.intervalId = undefined;
        this.realinput = this.element.parent().parent().find('.thz-spinner-value');
        this.units = this.element.parent().find('.thz-spinner-units');
        this.current_unit = thz_get_unit(this.realinput.val());


        if (this.units.length && this.current_unit != '') {

            this.units.val(this.current_unit);
        }


        var hasOptions = typeof options == 'object';

        this.minimum = $.fn.thzspinner.defaults.minimum;

        if (this.element.attr('data-min')) {
            this.setMinimum(this.element.attr('data-min'));
        }
        if (hasOptions && typeof options.minimum == 'number') {
            this.setMinimum(options.minimum);
        }

        this.maximum = $.fn.thzspinner.defaults.maximum;

        if (this.element.attr('data-max')) {
            this.setMaximum(this.element.attr('data-max'));
        }
        if (hasOptions && typeof options.maximum == 'number') {
            this.setMaximum(options.maximum);
        }

        this.numberOfDecimals = $.fn.thzspinner.defaults.numberOfDecimals;

        if (this.element.attr('data-step')) {
            this.numberOfDecimals = countDecimals(this.element.attr('data-step'));
        }

        if (hasOptions && typeof options.numberOfDecimals == 'number') {
            this.setNumberOfDecimals(options.numberOfDecimals);
        }


        this.step = $.fn.thzspinner.defaults.step;

        if (this.element.attr('data-step')) {
            this.setStep(this.element.attr('data-step'));
        }

        if (hasOptions && typeof options.step == 'number') {
            this.setStep(options.step);
        }

        this.element.parent().find('.thz-spinner-up').thzMouseHold($.proxy(this.increase, this));
        this.element.parent().find('.thz-spinner-down').thzMouseHold($.proxy(this.decrease, this));


        this.element.on('keyup paste', function() {
			
			if(self.minimum < 0 && self.element.val() == '-' ){
				
				self.element.trigger('thz:spinner:changed');
				
			}else{
				
				var value = parseFloat(self.element.val());
	
				if (value > self.maximum) {
					self.element.val(self.maximum);
				}
	
				if (value < self.minimum) {
					self.element.val(self.minimum);
				}
	
				if (!isNumber(self.element.val()) && !thz_has_textual_value(self.element.val())) {
	
					$startval = parseFloat(self.element.val());
	
					if (!isNumber($startval)) {
						$startval = 0;
					}
	
					self.element.val($startval);
				}
	
				self.element.trigger('thz:spinner:changed');
			}

        });


        this.element.bind("mousewheel DOMMouseScroll", function(e, delta) {

            var value = parseFloat(self.element.val());

            var newvalue = 0;

            if (isNaN(value)) {
                value = 0;
            }

            if (e.originalEvent.wheelDelta / 120 > 0) {

                newvalue = value + self.step;
                if (newvalue > self.maximum) {

                    self.element.val(self.maximum);
					self.element.trigger('thz:spinner:changed');
                    return false;
                } else {
                    self.element.val(newvalue.toFixed(self.numberOfDecimals));
                }

            } else {

                newvalue = value - self.step;

                if (newvalue < self.minimum) {

                    self.element.val(self.minimum);
					self.element.trigger('thz:spinner:changed');
                    return false;
                } else {
                    self.element.val(newvalue.toFixed(self.numberOfDecimals));
                }
            }

            self.element.trigger('thz:spinner:changed');

            return false;
        });


        this.element.on('thz:spinner:changed', function() {

            var $this = $(this);
            var $val = $this.val();
            var $addon = $this.attr('data-addon');
            var $units_val = thz_has_unit(self.realinput.val());

            var $real_value = $val + $units_val;

            if ($val == '') {

                $real_value = '';
            }

			
			self.realinput.val($real_value).trigger('thz:spinner:real:input:changed');
			$this.trigger('change');
			
            if (self.units.length && isNumber($real_value)) {
                self.units.val($addon);
            }

        });

        if (this.units.length) {

            this.units.on('change', function() {
                self.element.trigger('units:changed');
            });

            this.element.on('units:changed', function() {

                var $val = $(this).val();
                var $unit = self.units.val();

                thz_set_unit($val, $unit);
            });
        }

        function thz_set_unit(val, selected_unit) {

            var $allowed = ['px', 'em', 'rem', '%', 'vh', 'vw', 'vmin', 'vmax', 'auto', 'normal', 'none'];

            var $value = val;

            $.each($allowed, function(index, un) {

                if (selected_unit == un) {

                    var $new_value = $value + un;
                    $value = $new_value;
                }

            });


            self.realinput.val($value);

            if (thz_has_textual_value(selected_unit)) {

                self.element.val(selected_unit);

            } else {

                if (thz_has_textual_value(val)) {
                    self.realinput.val(val);
                }
            }

            self.element.trigger('thz:spinner:changed');

        }
    };

    var ThzDelay = (function() {
        var timer = 0;
        return function(callback, ms) {
            clearTimeout(timer);
            timer = setTimeout(callback, ms);
        };
    })();


    ThzSpinner.prototype = {
        constructor: ThzSpinner,

        setMinimum: function(value) {
			
            this.minimum = value ==='min' ? -1 * Math.pow(2, 53) - 1 : parseFloat(value);
        },

        setMaximum: function(value) {
            this.maximum = value ==='max' ? Math.pow(2, 53) - 1 : parseFloat(value);
			
        },

        setStep: function(value) {
            this.step = parseFloat(value);
        },

        setNumberOfDecimals: function(value) {
            this.numberOfDecimals = parseInt(value);
        },

        setValue: function(value) {

            value = parseFloat(value);

            if (this.value == value) {
                return;
            }

            if (value < this.minimum) value = this.minimum;
            if (value > this.maximum) value = this.maximum;
            this.value = value;

            if (this.value % 1 === 0) {
                var decimals = 0;
            } else {
                decimals = this.numberOfDecimals;
            }


            this.element.val(this.value.toFixed(decimals));
        },

        increase: function() {

            var currentvalue = this.element.val();

            if (!isNumber(currentvalue) || currentvalue == '') {
                currentvalue = 0;
            }


            this.setValue(currentvalue);

            this.setValue(this.value + this.step);
        },

        decrease: function() {

            var currentvalue = this.element.val();

            if (!isNumber(currentvalue) || currentvalue == '') {
                currentvalue = 0;
            }

            this.setValue(currentvalue);
            this.setValue(this.value - this.step);
        },

    };




    function thz_has_unit(val) {

        var $allowed = ['px', 'em', 'rem', '%', 'vh', 'vw', 'vmin', 'vmax'];
        var hasunit = '';

        if (!val) {

            return hasunit;
        }

        $.each($allowed, function(index, un) {

            if (val.indexOf(un) !== -1) {
                hasunit = un;
            }

        });

        return hasunit;
    }


    function thz_has_textual_value(val) {

        var $allowed = ['auto', 'normal', 'none'];
        var has = false;

        if (!val) {

            return has;
        }

        $.each($allowed, function(index, textual) {

            if (val.indexOf(textual) !== -1) {
                has = true;
            }

        });

        return has;
    }



    function thz_get_unit(val) {

        var $allowed = ['px', 'em', 'rem', '%', 'vh', 'vw', 'vmin', 'vmax', 'auto', 'normal', 'none'];
        var hasunit = '';


        if (!val) {

            return hasunit;
        }

        $.each($allowed, function(index, un) {

            if (val.indexOf(un) !== -1) {
                hasunit = un;
            }

        });

        return hasunit;
    }

    function isNumber(n) {
		/*
			do not change. is not checking empty
			and it is needed for delete operation
		*/
       return !isNaN(+n) && isFinite(n);
    }

    $.fn.thzspinner = function(option) {
        var args = Array.apply(null, arguments);
        args.shift();
        return this.each(function() {
            var $this = $(this),
                data = $this.data('thzspinner'),
                options = typeof option == 'object' && option;

            if (!data) {
                $this.data('thzspinner', new ThzSpinner(this, $.extend({}, $.fn.thzspinner().defaults, options)));
                data = $this.data('thzspinner');
            }
            if (typeof option == 'string' && typeof data[option] == 'function') {
                data[option].apply(data, args);
            }
        });
    };

    $.fn.thzspinner.defaults = {
        value: 0,
        minimum: 'min',
        maximum: 'max',
        step: 1,
        numberOfDecimals: 0
    };

    $.fn.thzspinner.Constructor = ThzSpinner;

}(window.jQuery);


//http://jsfiddle.net/hbtxdg4m/1/
//http://jsfiddle.net/hbtxdg4m/6/
//http://jsfiddle.net/opkumba6/3/
//http://jsfiddle.net/opkumba6/4/