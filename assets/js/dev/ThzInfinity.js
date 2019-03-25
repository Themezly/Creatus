/**
 * @package		ThzInfinity
 * @copyright	Copyright(C) FT Web Studio Inc since 2015. All Rights Reserved.
 * @author		Themezly
 * @license		MIT License (MIT) http://www.opensource.org/licenses/mit-license.php
 * @websites	http://www.themezly.com | http://www.youjoomla.com
 */
(function($) {

    $.fn.ThzInfinity = function(options) {

        var defaults = {
            duration: 60,
            direction: 'up',
			onmobile:0
        };
        var self = this,
            options = $.extend({}, defaults, options),
			Thz3d = ThzHas3d();

        function Thzinit() {

            self.each(function(index, el) {

				var $this = $(el);
				var $c_tr = $this.ThzGetTransform({
					current:true
				});
                options.duration 	= $this.attr('data-thzinf-duration') ? $this.data('thzinf-duration') : options.duration;
                options.direction 	= $this.attr('data-thzinf-direction') ? $this.data('thzinf-direction') : options.direction;
				options.onmobile 	= $this.attr('data-thzinf-onmobile') ? $this.data('thzinf-onmobile') :options.onmobile;
				options.c_tr		= $c_tr ? ' ' + $c_tr : '';

				// hide on mobiles |  if set to 1 than show
				if(navigator.userAgent.match(/Mobi/) && options.onmobile === 0) return;

				var direction 		= options.direction;
				var current 		= 0;
				var width			= $this.outerWidth();
				var height			= $this.outerHeight();
			
				function bgscroll(){
					
					if (!$this.parent().ThzIsVisible()) return;
					
					
					if(direction == 'right' || direction == 'down'){
						 current -= -1;
					}else{
						current -= 1;
					}

					var mutliplier 	= direction == 'left'|| direction == 'up' ? -1 : 1;
					var pauseX 		= (width /2) * mutliplier; 
					var pauseY 		= (height / 2) * mutliplier; 
					var pause 		= direction == 'left'|| direction == 'right' ? pauseX : pauseY;
					
					
					if(current == pause.toFixed(0)){
						current = 0;
					}

					var operator = 'px';
					var tX = direction == 'left' || direction == 'right' ? current  : 0;
					var tY = direction == 'up' || direction == 'down' ? current  : 0;
					
					
					$this.css({
						'transform': ThzTranslate(tX+operator,tY+operator) + options.c_tr
					});
	

				}

				setInterval(bgscroll, options.duration); 

            });

        }

		// check for transform
		function ThzHas3d() {
			
			if (!window.getComputedStyle) {
				return false;
			}
		
			var el = document.createElement('p'), 
				has3d,
				transforms = {
					'webkitTransform':'-webkit-transform',
					'OTransform':'-o-transform',
					'msTransform':'-ms-transform',
					'MozTransform':'-moz-transform',
					'transform':'transform'
				};
		
			// Add it to the body to get the computed style.
			document.body.insertBefore(el, null);
		
			for (var t in transforms) {
				if (el.style[t] !== undefined) {
					el.style[t] = "translate3d(1px,1px,1px)";
					has3d = window.getComputedStyle(el).getPropertyValue(transforms[t]);
				}
			}
		
			document.body.removeChild(el);
		
			return (has3d !== undefined && has3d.length > 0 && has3d !== "none");
		}	
		
		
		// translate based on transform check. fallback to 2d
		function ThzTranslate(x,y){
			
			if(Thz3d){
				return 'translate3d('+x+','+y+',0px)';
			}
			
			return 'translate('+x+','+y+')';
			
		}
		
		
        return Thzinit();

		
    };


})(jQuery);
