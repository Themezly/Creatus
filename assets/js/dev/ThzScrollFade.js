 /**
 * @plugin		ThzScrollFade
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

    $.fn.thz_scroll_fade = function(startFadeAt) {

        var $this = $(this);
			
		if( $this.length == 0 ){
			return;
		}

        function runEffect() {
			
            var windowScroll = $window.scrollTop();

            $this.each(function(index, element) {

                var $element = $(this);

                if ($element.attr('data-fadestart')) {

                    startFadeAt = $element.attr('data-fadestart');
                }
				
                var percentage 		= startFadeAt != undefined ? startFadeAt : 40;
                var percentCalc 	= (100 - percentage) / 100;
                var elementHeight 	= $element.outerHeight();
                var elementTop 		= $element.offset().top;
                var elementPoz 		= elementTop - windowScroll;
                var elementBottom 	= elementPoz + elementHeight;
                var elementOpacity 	= 1;
                var elementVisible 	= windowHeight - (windowHeight * percentCalc);
				var setOpacity		= (elementVisible - elementBottom) / elementVisible;
				var effectElement 	= $element;

                if ($element.attr('data-whattofade')) {

                    effectElement = $element.find($element.attr('data-whattofade'));
                }
				               
			    if (setOpacity > 0){
                    elementOpacity = 1 - setOpacity;
				}

				var setOpacity = function(){
					
					if (elementBottom <= elementVisible) {
						if (elementOpacity < 0) {
							elementOpacity = 0;
						} else if (elementOpacity > 1) {
							elementOpacity = 1;
						}
						effectElement.css({
							'opacity': elementOpacity
						});
					} else {
						effectElement.css({
							'opacity': elementOpacity
						});
					}					
					
				}
				
				if ($element.hasClass('thz-animate')) {
					
					$element.on('thz:animation:done', function(e) {
						setOpacity();
					});	
					
				}else{
					setOpacity();
				}

            });

        }

        $window.bind('scroll', runEffect).resize(runEffect);
        runEffect();

    };

})(jQuery);
