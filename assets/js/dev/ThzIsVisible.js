/**
 * @package		Thz IsVisible
 * @copyright 	Copyright(C) FT Web Studio Inc since 2015. All Rights Reserved.
 * @author		Themezly
 * @license		MIT
 * @websites	http://www.themezly.com | http://www.youjoomla.com
 */
(function($) {
	$.fn.ThzIsVisible = function(add){
		
		var element = this.get(0);
		var bounds = element.getBoundingClientRect();
		
		if(add == null || typeof add == 'undefined') add = 0;
		
		return bounds.top - add < window.innerHeight && bounds.bottom + add > 0;
	}
})(jQuery);