(function($) {
    Color.prototype.toString = function(remove_alpha) {
        if (remove_alpha == 'no-alpha') {
            return this.toCSS('rgba', '1').replace(/\s+/g, '');
        }
        if (this._alpha < 1) {
            return this.toCSS('rgba', this._alpha).replace(/\s+/g, '');
        }
        var hex = parseInt(this._color, 10).toString(16);
        if (this.error) return '';
        if (hex.length < 6) {
            for (var i = 6 - hex.length - 1; i >= 0; i--) {
                hex = '0' + hex;
            }
        }
        return '#' + hex;
    };

    Color.prototype.toHex = function() {
        var hex = parseInt(this._color, 10).toString(16);
        if (this.error) return '';
        if (hex.length < 6) {
            for (var i = 6 - hex.length - 1; i >= 0; i--) {
                hex = '0' + hex;
            }
        }
        return '#' + hex;
    };

    function SetPreviewColors($this) {

		var $trigger 			= $this.parent().parent().find('.thz-color-picker-trigger');
		var $palette_preview 	= $this.parent().find('.palette-color-preview');
		var $current 			= thz.thz_replace_palette_colors ( $this.val() );
		var $bgcontrast 		= tinycolor( $current  ).getBrightness() >= 128 || tinycolor( $current  ).getAlpha() < 0.45? '#000000' : '#ffffff';
		var $preview_text 		= $current;
		
		if ($this.val().indexOf('color_') !== -1) {
			
			$preview_text = 'Palette ' + $this.val().split('_').join(' ') + ' ' + $current;	
			$this.addClass('using-' + $this.val());
		}
		
		if ($current != '') {
		
			$trigger.css('background-color', $current);
			
			$this.css({
				'background-color': $current,
				'color': $bgcontrast
			})
			
			$palette_preview.css({
				'background-color': $current,
				'color': $bgcontrast
			}).html( $preview_text );            
		}
		

    }

    function activateIris(input, trigger) {

        var $input = input,
            changeTimeoutId = 0,
            $real_input = $input.parent().find('.real-input'),
            $trigger = trigger;

        $input.iris({
            palettes: ['#27b7f8','#0a7de8', '#f3413e', '#1ecb67', '#ff5722', '#e83570', '#ffb401', '#764dff', '#2c2e30', '#ffffff'],
            defaultColor: false,
            change: function(event, ui) {
                var $transparency = $input.next('.iris-picker').find('.transparency');
                $transparency.css('backgroundColor', ui.color.toString('no-alpha'));

                $alpha_slider.slider("option", "value", ui.color._alpha * 100);

                $input.css('background-color', ui.color.toCSS());
                $input.css('color', ($alpha_slider.slider("value") > 40) ? ui.color.getMaxContrastColor().toCSS() : '#000000');

                clearTimeout(changeTimeoutId);
                changeTimeoutId = setTimeout(function() {
                    $input.trigger('fw:thz:color:picker:changed', {
                        $element: $input,
                        iris: $input.data('a8cIris'),
                        alphaSlider: $alpha_slider.data('uiSlider')
                    });
                    $input.trigger('change');
                }, 2);
				
				
            }
        });

		
        $(document.body).on('click', function(e) {
            if (!$(e.target).parents('.thz-color-picker-holder').length) {
				
				 if($('.thz-color-picker-holder-in').hasClass('picker-opened')) {
					$('.thz-color-picker-holder-in').removeClass('picker-opened').hide();
					$('.iris-picker').hide();

				 }

            }

        });

        if (!$input.hasClass('thz-option-initialized')) {


            var addhtml = '<div class="fw-alpha-container">';
            addhtml += '<div class="slider-alpha"></div>';
            addhtml += '<div class="transparency"></div>';
            addhtml += '<a href="#" class="resetcolor button">' + thz_picker_vars.reset_txt + '</a>';
            addhtml += '</div>';

            $(addhtml).appendTo($input.next('.iris-picker'));

        }

        var $alpha_slider = $input.next('.iris-picker:first').find('.slider-alpha');

        $alpha_slider.slider({
            value: Color($input.val())._alpha * 100,
            range: "max",
            step: 1,
            min: 0,
            max: 100,
            slide: function(event, ui) {
                
				$(this).find('.ui-slider-handle').text(ui.value);
				
				$input.data('a8cIris')._color._alpha = parseFloat(ui.value) / 100.0;
				
				var color = $input.iris('color', true);
				
				var	cssColor = (
					(ui.value < 100) ? color.toCSS('rgba', ui.value / 100) : 
					color.toHex()).replace(/\s/g, ''
				);				

				$input.val(cssColor);
                $input.css('background-color', cssColor).val(cssColor);
                $input.css('color', (ui.value > 40) ? color.getMaxContrastColor().toCSS() : '#000000');

                clearTimeout(changeTimeoutId);
                changeTimeoutId = setTimeout(function() {
                    $input.trigger('fw:thz:color:picker:changed', {
                        $element: $input,
                        iris: $input.data('a8cIris'),
                        alphaSlider: $alpha_slider.data('uiSlider')
                    });
                    $input.trigger('change');
                }, 2);
				

            },
            create: function(event, ui) {
                var v = $(this).slider('value');
                $(this).find('.ui-slider-handle').text(v);
                var $transparency = $input.next('.iris-picker:first').find('.transparency');
                $transparency.css('backgroundColor', Color($input.val()).toCSS('rgb', 1));
            },

        });

        $input.iris('show').addClass('thz-option-initialized');

        $input.next('.iris-picker:first').find('.resetcolor')
		.off('click.resetbutton')
		.on('click.resetbutton', function(e) {
            e.preventDefault();
            $input.iris('color', $input.attr('data-reset'));
		    $input.val($input.attr('data-reset')).trigger('change');
			SetPreviewColors($input);
        });


    }
	
	function customizerPosition($trigger,$holder){

		var $max 	= $('.wp-full-overlay').height() - 355;
		var $left 	= $trigger.offset().left;
		var $top 	= $trigger.offset().top + 35;
		
		if ( $max < $top ) {
			$top -= 405;
		}
		
		$holder.css({
			'left' : $left +'px',
			'top' : $top +'px'
		});
		
	}

    function InitPreviewColor($this,$trigger) {

		var $current 	= thz.thz_replace_palette_colors ( $this.val() );

		if ($current != '') {
			$trigger.css('background-color', $current);
		}
    }
		
    fwEvents.on('fw:options:init', function(data) {
		
        data.$elements.find('input.fw-option-type-thz-color-picker').each(function() {

            var $this = $(this);
            var $trigger = $this.parent().parent().find('.thz-color-picker-trigger');
            var $holder = $this.parent().parent().find('.thz-color-picker-holder-in');
			var $in_customizer = $this.parents('.fw-backend-option-design-customizer').length;
			
			InitPreviewColor($this,$trigger);
			
            $trigger.on('click', function(e) {
                e.preventDefault();
				
                $('.thz-color-picker-holder-in').hide();
                $('.thz-color-picker-holder,.thz-palette-box .fw-backend-option-descriptor').css('z-index', 1);
                $holder.parent().css('z-index', 2);
				$holder.parents('.fw-backend-option-descriptor').css('z-index', 2);
                SetPreviewColors($this);
				if( $in_customizer ){
					customizerPosition($trigger,$holder);
				}
				$holder.addClass('picker-opened').show();
			    activateIris($this, $(this));
				$this.trigger('fw:thz:color:picker:opened');
				
				
            });
		
			$this.on('change keyup', function(e) {
				
				
				var $input = $(this);
				var $new_color = $input.val();
				
				SetPreviewColors($input);
				
				if ($new_color.indexOf('color_') !== -1) {
	
					$input.parent().addClass('palette-color');
	
					return;
	
				} else {
					
					$('.palette-button').removeClass('active-color');
					$input.parent().removeClass('palette-color');
					$input.thzAlterClass('using-*');
				}
	
				
				
				//	* iris::change is not triggered when the input is empty or color is wrong
				if (Color($(this).val()).error) {
					
					$input.css('background-color', '');
					$input.css('color', '');
					$trigger.css('background-color', '');
					$input.trigger('iris-empty');
				}
	
			});
			
			if( $in_customizer ){
				$('.wp-full-overlay-sidebar-content').on('scroll', function(e) {
					if( $holder.hasClass('picker-opened') ){
						console.log('0');
						customizerPosition($trigger,$holder);
					}
				});
			}
        });
    });


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


})(jQuery);

