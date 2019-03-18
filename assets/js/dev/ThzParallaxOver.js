/**
 * @plugin		ThzParallaxOver
 * @version		1.0.0
 * @package		Thz Framework
 * @copyright	Copyright(C) since 2015  Themezly.com. All Rights Reserved.
 * @author		Themezly
 * @license		MIT License (MIT) http://www.opensource.org/licenses/mit-license.php
 * @websites	http://www.themezly.com | http://www.youjoomla.com
 */
(function($) {

    var $window = $(window);
    var windowHeight = $window.height();

    $window.resize(function() {
        windowHeight = $window.height();
    });

    $.fn.thz_parallax_over = function(effectSpeed, effectElement) {

        var $this = $(this);
		
		if( $this.length == 0 ){
			return;
		}
		
		var Thz3d = ThzHas3d();

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

        function runEffect() {
			
            var windowScroll = $window.scrollTop();
			
            $this.each(function(index, element) {
				
                var $element 		= $(this);
				var $c_tr = $element.ThzGetTransform({
					current:true
				});
				
				if ($element.attr('data-parallaxspeed')) {
					
					effectSpeed = $element.attr('data-parallaxspeed');
				}
				
                var elementHeight 	= $element.outerHeight();
                var elementTop 		= $element.offset().top;
                var elementPoz 		= elementTop - windowScroll;
                var elementVisible 	= elementPoz + elementHeight;
                var moveSpeed 		= effectSpeed != undefined ? effectSpeed : 40;
                var speedCalc 		= moveSpeed / 100;
                var elementMove 	= 0;
                var moveContainer 	= effectElement != undefined ? effectElement : '.thz-container';
				var curr_transform	= $c_tr ? ' ' + $c_tr : '';

                if (elementVisible <= windowHeight && elementPoz <= 0) {
                    if (elementHeight > windowHeight) {
                        var elementMove = (windowHeight - elementVisible) * speedCalc;
                    } else {
                        var elementMove = -(elementPoz * speedCalc);
                    }
                    if (elementMove < 0) {
                        elementMove = 0;
                    }
                } else {
                    elementMove = 0;
                }
				
				var mesunit ='px';
				var transform = 'translate3d(0px,' + elementMove + mesunit + ',0px)';
				
                $element.find(moveContainer).each(function(index, container) {
					
                    $(container).css({
                      // bottom: "-" + elementMove + "px"
					  'transform': ThzTranslate('0px',elementMove + mesunit) + curr_transform
                    });

                });
				

            });

        }
		$(window).on('scroll', function() {
			requestAnimationFrame(runEffect);
		});
		$(window).on('resize', function() {
			requestAnimationFrame(runEffect);
		});


    };

})(jQuery);
