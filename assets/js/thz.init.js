/**
 * @package      Thz Framework
 * @copyright    Copyright(C) since 2015  Themezly.com. All Rights Reserved.
 * @author       Themezly
 * @license      http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 * @websites     http://www.themezly.com | http://www.youjoomla.com
 *
 * Small scripts that need to run before the domready. 
 * All other scripts and plugins are loaded in page footer. 
 */
var thz;

if (typeof Object['create'] != 'undefined') {
	thz = Object.create(null);
} else {
	thz = {};
}

/*! ready v1.2.0 | https://github.com/ryanmorr/ready */
!function(e){if("object"==typeof exports&&"undefined"!=typeof module)module.exports=e();else if("function"==typeof define&&define.amd)define([],e);else{var n;n="undefined"!=typeof window?window:"undefined"!=typeof global?global:"undefined"!=typeof self?self:this,n.ready=e()}}(function(){return function e(n,r,t){function o(i,u){if(!r[i]){if(!n[i]){var d="function"==typeof require&&require;if(!u&&d)return d(i,!0);if(f)return f(i,!0);var l=new Error("Cannot find module '"+i+"'");throw l.code="MODULE_NOT_FOUND",l}var c=r[i]={exports:{}};n[i][0].call(c.exports,function(e){var r=n[i][1][e];return o(r||e)},c,c.exports,e,n,r,t)}return r[i].exports}for(var f="function"==typeof require&&require,i=0;i<t.length;i++)o(t[i]);return o}({1:[function(e,n,r){"use strict";function t(e,n){for(var r=l.querySelectorAll(e),t=0,o=r.length;t<o;t++){var f=r[t];f.ready||(f.ready=!0,n.call(f,f))}}function o(){d.forEach(function(e){return t(e.selector,e.fn)})}function f(e,n){for(var r=d.length;r--;){var t=d[r];t.selector===e&&t.fn===n&&(d.splice(r,1),!d.length&&u&&(u.disconnect(),u=null))}}function i(e,n){return u||(u=new c(o),u.observe(l.documentElement,{childList:!0,subtree:!0})),d.push({selector:e,fn:n}),t(e,n),function(){return f(e,n)}}Object.defineProperty(r,"__esModule",{value:!0}),r.default=i;var u=void 0,d=[],l=window.document,c=window.MutationObserver||window.WebKitMutationObserver;n.exports=r.default},{}]},{},[1])(1)});


/* Init */
(function(window, undefined) {
	
	'use strict';

	thz.body_container_width = function(){
		
		var $wrapper = document.getElementsByClassName("thz-wrapper")[0];
		
		if( $wrapper.className.indexOf('thz-layout-boxed') > 1 ) { 
		  return;
		}
		
		var $box 			= document.getElementsByClassName("thz-body-box")[0];
		var $container 		= document.getElementsByClassName("thz-body-container")[0];
		var $windowWidth 	= $box.clientWidth,
		 	$newWidth 		= 12 * Math.ceil( $windowWidth  / 12 ),
		 	$difference		= ( $windowWidth - $newWidth ) / 2;	
		
		$container.style.width = $newWidth + "px";
		$container.style.marginLeft = $difference + "px";
		
		ready('.header-lateral-left', function(lateral_header) {

			lateral_header.style.left = Math.abs($difference) + "px";
			
		});
		
		ready('.header-lateral-right', function(lateral_header) {

			lateral_header.style.left = $difference + "px";
			
		});
		
	}
	
	
	thz.admin_bar_on = function(){
		
		var $adminbar 		= document.getElementById("wpadminbar"),
			$height			= $adminbar.clientHeight,
			$body_frame		= document.getElementsByClassName("thz-bf-top"),
			$full_heights	= document.getElementsByClassName("thz-full-height-in"),
			$offcanvas		= document.getElementsByClassName("thz-offcanvas-menu")[0];
		
		
		if($full_heights.length > 0){
			for (var i=0; i < $full_heights.length; i++) {
				
				var $this = $full_heights[i];
				var $el_height = window.getComputedStyle($this).getPropertyValue("height");
				var $percent = parseFloat($el_height) / window.innerHeight * 100;
				
				if($percent != 0){
					$full_heights[i].style.height = "calc("+ $percent +"vh - "+ $height +"px)";
				}
			}			
		}
		
		if($body_frame.length > 0){
			for (var i=0; i < $body_frame.length; i++) {
				
				$body_frame[i].style.top = $height + "px";
			}			
		}
		
		ready('.header-lateral-in', function(lateral_header) {
			
			if($offcanvas != undefined){
				$offcanvas.style.top = ( parseFloat($offcanvas.offsetTop) + $height )+ "px";
			}

			if($body_frame.length > 0){
				
				$height += $body_frame[0].clientHeight * 2;
			}
			
			lateral_header.style.height = "calc(100% - "+$height+"px)";
			
		});
	}
	
	ready('#wpadminbar', function(element) {
		
		thz.admin_bar_on();
		
	});
	
	ready('.thz-body-container', function(element) {
	   thz.body_container_width();
	   
	});	

})(window);


(function($, window, document, undefined) {
	
	thz.elOffset = function(el,x){
		
		var property = el.hasClass('thz-offset-left') ? 'padding-left' :'padding-right';
		
		if( !el.parent().hasClass('thz-offset-container')){
			
			var wrapper = $('<div class="thz-offset-container"></div>')
			.css(property,x + "px")
			.insertBefore(el)
			.append(el);

		}else{
			
			el.parent().css(property,x + "px");
		}		
	}
	
	
	thz.setOffsets = function(element){
		
		var h 	= $('.thz-site-width').first();
		
		if( h.length < 1 ){
			return;
		}
		
		var p	= parseFloat($('.thz-container').first().css('padding-left'));
		var lh	= $('.header-lateral-left');
		if( lh.length > 0){
			p -= parseFloat(lh.outerWidth());
		}
	    
		var x	= h.offset().left + p;
		
		if( window.innerWidth < 979 ){
			
			x = 0;
		}
		
		if(element){
			
			thz.elOffset($(element),x);	
			
		}else{
			
			var els = $(".thz-offset-left,.thz-offset-right");
			
			if( els.length < 1 ){
				return;
			}		
	
			els.each(function(index, element) {
				var el = $(this);
				thz.elOffset(el,x);			
			});
		}
		
	}	
	
	ready('.thz-offset-left,.thz-offset-right', function(element) {
	   thz.setOffsets(element);
	});
	
	$(document).ready(function() {
		
		if($(".thz-offset-left,.thz-offset-right").length > 0){
			$(window).on('resize', function(){
				thz.setOffsets();	
			});
		}
	});

})(jQuery, window, document);