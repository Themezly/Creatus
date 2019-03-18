/**
 * @package		Thz Get Transform Decompose Matrix
 * @copyright	Copyright(C) FT Web Studio Inc since 2015. All Rights Reserved.
 * @author		Themezly
 * @license		MIT License (MIT) http://www.opensource.org/licenses/mit-license.php
 * @websites	http://www.themezly.com | http://www.youjoomla.com
 */
(function($) {
	
	 $.fn.ThzGetTransform = function(options) {
		
		var matrix 	= this.is(":visible") ? this.css( 'transform' ) : this.actual( 'transform' );
		
		if( matrix == 'none' ){
			return;
		}
		
		var a = matrix.split('(')[1].split(')')[0].split(',');
		
		var angle = Math.atan2(a[1], a[0]),
		  denom = Math.pow(a[0], 2) + Math.pow(a[1], 2),
		  scaleX = Math.sqrt(denom),
		  scaleY = (a[0] * a[3] - a[2] * a[1]) / scaleX,
		  skewX = Math.atan2(a[0] * a[2] + a[1] * a[3], denom);
		var data = {
			angle: angle / (Math.PI / 180),  // this is rotation angle in degrees
			scaleX: scaleX,                  // scaleX factor  
			scaleY: scaleY,                  // scaleY factor
			skewX: skewX / (Math.PI / 180),  // skewX angle degrees
			skewY: 0,                        // skewY angle degrees
			translateX: a[4],                // translation point  x
			translateY: a[5]                 // translation point  y
		};	
		
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
		
		
		
		
		if( options.current ){
			
			var current = [];
			
			if( data.angle != 0 ){
				current.push('rotate('+data.angle+'deg)');
			}
			
			var scale = parseFloat(data.scaleX) + parseFloat(data.scaleY);
			if( scale.toFixed(2) != 2 ){
				current.push('scale('+data.scaleX+','+data.scaleY+')');
			}
			
			var skew = parseFloat(data.skewX) + parseFloat(data.skewY);
			if( skew != 0){
				current.push('skew('+data.skewX+','+data.skewY+')');
			}
			
			if( data.translateX != 0 || data.translateY != 0 ){
				
				var $translate = ThzHas3d() ? 'translate3d('+data.translateY+','+data.translateX+',0px)' : 'translate('+data.translateY+','+data.translateX+')' ;
				
				current.push($translate);
			}
			
			if( current.length > 0){
				
				return current.join(' ');	
				
			}else{
				
				return false;
				
			}
			
		}else{
		
			return data;
		
		}
		
	};
	
})(jQuery);
