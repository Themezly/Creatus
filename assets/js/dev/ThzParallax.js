/**
 * @package		Thz Parallax
 * @copyright	Copyright(C) FT Web Studio Inc since 2015. All Rights Reserved.
 * @author		Themezly
 * @license		MIT License (MIT) http://www.opensource.org/licenses/mit-license.php
 * @websites	http://www.themezly.com | http://www.youjoomla.com
 */
(function($) {

    var $window = $(window);
    var windowHeight = document.documentElement.clientHeight;
	var windowWidth = document.documentElement.clientWidth;

    $window.resize(function() {
        windowHeight = document.documentElement.clientHeight;
		windowWidth = document.documentElement.clientWidth;
    });

    $.fn.ThzParallax = function(options) {

        var defaults = {
            velocity: 0.3,
            direction: 'up',
            scale: '',
			onmobile:0,
			size:'full'
        };
        var self = this,
            options = $.extend({}, defaults, options),
            ThzParallaxes = [], // global array
            scrollTopMin,
            scrollTopMax,
            moveMax,
			Thz3d = ThzHas3d();


        function Thzinit() {
			
			if( self.length == 0){
				return;
			}
			
            self.each(function(index, el) {
				
				var $this = $(el);
				var $c_tr = $this.ThzGetTransform({
					current:true
				});
				
                options.velocity 	= $this.attr('data-thzplx-velocity') ? parseFloat($this.data('thzplx-velocity') / 10) : options.velocity;
                options.direction 	= $this.attr('data-thzplx-direction') ? $this.data('thzplx-direction') : options.direction;
                options.scale 		= $this.attr('data-thzplx-scale') ? $this.data('thzplx-scale') : options.scale;
				options.onmobile 	= $this.attr('data-thzplx-onmobile') ? $this.data('thzplx-onmobile') :options.onmobile;
				options.size 		= $this.attr('data-thzplx-size') ? $this.data('thzplx-size') :options.size;
				options.in_sticky	= $this.attr('data-thzplx-insticky') ? true : false;

				// hide on mobiles |  if set to 1 than show
				if(navigator.userAgent.match(/Mobi/) && options.onmobile === 0){
					$(el).addClass('thz-no-mobile-parallax');
					 return;
					 
				}
				
				// set widths and positions
				
				ThzSetDimensions(el, options, $c_tr);

				// push all info in to global array
				var parallaxItem = {};

				parallaxItem.element 		= $this;
				parallaxItem.height 		= $this.outerHeight();
				parallaxItem.width 			= $this.outerWidth();
				parallaxItem.parentTop 		= $this.parent().offset().top;
				parallaxItem.direction 		= options.direction;
				parallaxItem.velocity 		= options.velocity;
				parallaxItem.scale 			= options.scale;
				parallaxItem.scrollTopMin 	= scrollTopMin;
				parallaxItem.scrollTopMax 	= scrollTopMax;
				parallaxItem.moveMax 		= moveMax;
				parallaxItem.c_tr 			= $c_tr ? ' ' + $c_tr : '';

				ThzParallaxes.push(parallaxItem);
					
				
            });

        }

		
		// set dimensions
        function ThzSetDimensions(el, options, current_transform) {

            var element 	= $(el);
            var myparent 	= element.parent();
            var direction 	= options.direction;
			var size 		= options.size;
			var velocity 	= options.velocity;
            var getWidth 	= isNaN(parseFloat(size)) ? myparent.outerWidth() : parseFloat(size) ;
			var getHeight 	= myparent.outerHeight();
            var getTop 		= myparent.offset().top;

           
			var upWidth 	= 250 * Math.abs(parseFloat(velocity));
			var upHeight 	= 350 * Math.abs(parseFloat(velocity));
            
           // var setHeight 	= direction == 'down' || direction == 'fixed'? (getHeight + upHeight) * 1.3 : getHeight + upHeight;
			var setWidth 	= direction == 'left' || direction == 'right' ? getWidth + upWidth : getWidth;
			var setHeight 	= getHeight + upHeight;

            var setTop 		= direction == 'down' ? getHeight - setHeight : 0;
           // var setTop 		= 0;
			var setLeft 	= direction == 'right' ? getWidth - setWidth : 0;

            var scrollTopMinV = 0;
            var scrollTopMaxV = getTop + getHeight;

            if (getTop > windowHeight) {
                scrollTopMinV = getTop - windowHeight;
            }

            moveMax 		= direction == 'left' || direction == 'right' ? setWidth - getWidth : setHeight - getHeight;
            scrollTopMin 	= scrollTopMinV;
            scrollTopMax 	= scrollTopMaxV;
            elemDirection 	= direction;
            elemVelocity 	= velocity;
			
			
			if(size === 'custom') {
				
            	element.addClass('thz-parallaxing');
				
			}else{
				
				element.css({
	
					height: setHeight + 'px',
					width: setWidth + 'px',
					top: setTop + 'px',
					left: setLeft + 'px',
					'transform': ThzTranslate('0px','0px') + current_transform
					
				}).addClass('thz-parallaxing');
			
			}
			
        }

		// run parallax
		function ThzRunParallax() {
		
			for (i = 0; i < ThzParallaxes.length; i++) {
				ThzParallaxItems(ThzParallaxes[i]);
			}
		
		}
		
		// on scroll
		function ThzOnScroll() {
		
			for (var i = 0, len = ThzParallaxes.length; i < len; i++) {
				 
				var $element = ThzParallaxes[i].element.parent();
				
				// check if visible
				if ($element.ThzIsVisible(200)) {
					ThzParallaxItems(ThzParallaxes[i]);
				}

			 }
					
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
		
		
		// parallax 
        function ThzParallaxItems(el) {

            
		    var $element 			= $(el.element);
            var scrollTop 			= $window.scrollTop();
			var velocity 			= el.velocity;
            var direction 			= el.direction;
			var current_transform 	= el.c_tr;
			
			if(options.in_sticky){
				if (direction === 'down' || direction === 'up') {
					if(scrollTop  > ($element.outerHeight() - el.moveMax)){
						return;
					}
				}
				if (direction === 'left' || direction === 'right') {
					
					if(scrollTop  > ($element.parent().outerHeight() - el.moveMax)){
						return;
					}
					
				}
				if(direction === 'fixed'){
					return;
				}
			}
			
            var scale 		= el.scale;
            var elemScale 	= ThzParallaxScale(el, scrollTop);

            var scrollPercentage = (scrollTop - el.scrollTopMin) / (el.scrollTopMax - el.scrollTopMin);

            var elemMove = el.moveMax * scrollPercentage;
            var mesunit = 'px';

            if (direction === 'left' || direction === 'up') {
                elemMove *= -1;
            }

            elemMove = Math.round(elemMove);
			

		   var transform = elemScale + ThzTranslate('0px',elemMove + mesunit);

            if (direction === 'left' || direction === 'right') {

				 transform = elemScale + ThzTranslate(elemMove + mesunit,'0px');
            }
			
			if(direction === 'fixed'){

				elemMove = Math.round((el.parentTop - scrollTop));
				elemMove *= -1;
				
				transform = elemScale + ThzTranslate('0px',elemMove + mesunit);
			}

			if ($element.hasClass('thz-animate')) {
				
				$element.off("thz:animation:done").on('thz:animation:done', function(e) {

					$element.addClass('thz-starting-parallax');
					
					setTimeout(function (){
						$element.css({
							'transform': transform + current_transform
						});
					},1);
					
					setTimeout(function (){
						$element.removeClass('thz-starting-parallax');						
					},401);	
									
				});		
							
			}else{

				$element.css({
					'transform': transform + current_transform
				});				
			}

			 
        }
		

		// scale
        function ThzParallaxScale(el, scrollTop) {
			
			
			var velocity 	= el.velocity;
			var direction 	= el.direction;
            var elemScale 	= '';
			
			if(direction === 'fixed') return elemScale;
			
			
            var scale = el.scale;
            if (scale === 'up') {
                var scaleCalc = 1 + (scrollTop * 0.0002);
                if (scaleCalc < 1) {
                    scaleCalc = 1;
                }
                scaleCalc = scaleCalc + 0.001;
                elemScale = 'scale3d(' + scaleCalc + ',' + scaleCalc + ',1) ';
            }

            if (scale === 'down') {
                var scaleCalc = 1 - (scrollTop * 0.0002);
                if (scaleCalc > 1) {
                    scaleCalc = 1;
                }
                
				//scaleCalc = scaleCalc - 0.01;
                elemScale = 'scale3d(' + scaleCalc + ',' + scaleCalc + ',1) ';
            }

            return elemScale;
        }
		
		
		var ThzWait = (function () {
		  var timers = {};
		  return function (callback, ms, uniqueId) {
			if (!uniqueId) {
			  uniqueId = "Don't call this twice without a uniqueId";
			}
			if (timers[uniqueId]) {
			  clearTimeout (timers[uniqueId]);
			}
			timers[uniqueId] = setTimeout(callback, ms);
		  };
		})();
		
        function ThzListeners() {
			
			$window.resize(function () {
				ThzWait(function(){
				 Thzinit();
				 ThzRunParallax();
				}, 150, "thzparallax resized");
			});
			$window.on('scroll touchmove', function() {
               requestAnimationFrame(ThzOnScroll);
            });
			
        }

        Thzinit();
		ThzRunParallax();
        ThzListeners();
		
    };

})(jQuery);