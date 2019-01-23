(function($, window, document ) {
	
	$(window).load(function() {
		
		setTimeout(function(){
			
			$('#accordion-section-headerstickytab > h3').addClass('thz-sthe-tab');
			$('#accordion-section-headerdarksectionstab > h3').addClass('thz-sehe-tab');
			$('#accordion-section-toolbartab > h3').addClass('thz-heto-tab');
			$('#accordion-section-titlesettings > h3').addClass('thz-pagetitle-title-li');
			$('#accordion-section-breadcrumbssettings > h3').addClass('thz-pagetitle-breadcrumbs-li');
			$('#accordion-section-pagetitlesubtitle > h3').addClass('thz-pagetitle-subtitle-li');
			
			
			$('#accordion-section-blog_related > h3').addClass('thz-related-posts-li');
			$('#accordion-section-blog_related_media > h3').addClass('thz-related-posts-li');
			$('#accordion-section-blog_related_title > h3').addClass('thz-related-posts-li');
			$('#accordion-section-blog_related_intro > h3').addClass('thz-related-posts-li');
			
			
			$('#accordion-section-portfolio_related > h3').addClass('thz-related-projects-li');
			$('#accordion-section-portfolio_related_media > h3').addClass('thz-related-projects-li');
			$('#accordion-section-portfolio_related_title > h3').addClass('thz-related-projects-li');
			$('#accordion-section-portfolio_related_intro > h3').addClass('thz-related-projects-li');
			
			
			$('#accordion-section-portfolio_single_media > h3').addClass('proj-elements');
			$('#accordion-section-portfolio_single_title > h3').addClass('proj-elements');
			$('#accordion-section-portfolio_single_content > h3').addClass('proj-elements');
			$('#accordion-section-portfolio_single_meta > h3').addClass('proj-elements');
			$('#accordion-section-portfolio_single_sharing > h3').addClass('proj-elements');
			
			$('#accordion-section-events_related > h3').addClass('thz-related-events-li');
			$('#accordion-section-events_related_media > h3').addClass('thz-related-events-li');
			$('#accordion-section-events_related_title > h3').addClass('thz-related-events-li');
			$('#accordion-section-events_related_intro > h3').addClass('thz-related-events-li');


			$(document).ThzAdmin('ThzCheckSelects');
			
			
			$('#thz-customizer-preloader').addClass('finished');

			var more_options = $('<a class="more-options"></a>')
				.attr('href', thzcustomizer.more_options_link)
				.attr('target', '_self')
				.text(thzcustomizer.more_options_text)
				.on('click', function(e) {
					e.stopPropagation();
				});
				
			var thz_customizer_links = $('<div class="thz-customizer-links"></div>')
			
			thz_customizer_links.append(more_options);
			
			$('#accordion-section-themes').append(thz_customizer_links);

			
					
		},405);
	});

})(jQuery, window, document);


( function( $, fwe, api ) {

	api.bind( 'ready', function() {

		Cookies.set('page_options_notices', []);
			
		api.section.each( function ( section ) { 

			section.expanded.bind( function( isExpanding ) {
			
				if(isExpanding){
					
					var $sec = $(section.contentContainer);
					
					setTimeout( function () {
						
						var $thz_sections = $(section.contentContainer).not('.thz-section-initialized');
						
						if( $thz_sections.length > 0 ){
							
							fwEvents.trigger( 'fw:options:init', {
								$elements: $thz_sections 
							});	
						}
						
					}, 80);					
				}
			});
		});
		
		
		fwe.on('fw:options:init', function(data) {
			
			data.$elements.each(function() {
				if($(this).is('.customize-pane-child')){
					$(this).addClass('thz-section-initialized');
				}
			});
	
		});

		api.previewer.bind( 'documentTitle', function( data ) {
			
			var page_options = $("#customize-preview iframe")[0].contentWindow.thzsite.page_options;

			if( page_options != 0 ){
				
				var current_url  = api.previewer.previewUrl.get();
				var page_options_notices = Cookies.getJSON('page_options_notices');
				
				if( page_options_notices.indexOf(current_url) != -1 ){  
				   return;
				}	
				
				var modal_html = '<div class="thz-page-has-options">';
                modal_html += '<h2 class="has-options-heading">' + thzcustomizer.options_heading + '</h2>';
				modal_html += '<span class="has-options-title">' + thzcustomizer.options_title + '</span>';
                modal_html += '<span class="has-options-options">' + page_options + '</span>';
				modal_html += '<span class="has-options-info">' + thzcustomizer.options_info + '</span>';
				modal_html += '<a href="#" class="has-options-disable-notice">' + thzcustomizer.options_disable_notice + '</a>';
				modal_html += '</div>';
								
                fw.soleModal.show('thz_page_custom_options', modal_html, {
                    autoHide: 0,
                    width: 500,
                    height: 300,
                    allowClose: true,
                    backdrop: false
                });
				
				$('.has-options-disable-notice').on('click', function (e) {
					e.preventDefault();
					page_options_notices.push(current_url);
					Cookies.set('page_options_notices', page_options_notices);
					fw.soleModal.hide('thz_page_custom_options');
				});
			}
		});

	});
	



} )( jQuery, fwEvents, wp.customize  );

/*!
 * JavaScript Cookie v2.1.3
 * https://github.com/js-cookie/js-cookie
 *
 * Copyright 2006, 2015 Klaus Hartl & Fagner Brack
 * Released under the MIT license
 */
!function(e){var n=!1;if("function"==typeof define&&define.amd&&(define(e),n=!0),"object"==typeof exports&&(module.exports=e(),n=!0),!n){var t=window.Cookies,o=window.Cookies=e();o.noConflict=function(){return window.Cookies=t,o}}}(function(){function e(){for(var e=0,n={};e<arguments.length;e++){var t=arguments[e];for(var o in t)n[o]=t[o]}return n}function n(t){function o(n,r,i){var c;if("undefined"!=typeof document){if(arguments.length>1){if(i=e({path:"/"},o.defaults,i),"number"==typeof i.expires){var a=new Date;a.setMilliseconds(a.getMilliseconds()+864e5*i.expires),i.expires=a}try{c=JSON.stringify(r),/^[\{\[]/.test(c)&&(r=c)}catch(s){}return r=t.write?t.write(r,n):encodeURIComponent(String(r)).replace(/%(23|24|26|2B|3A|3C|3E|3D|2F|3F|40|5B|5D|5E|60|7B|7D|7C)/g,decodeURIComponent),n=encodeURIComponent(String(n)),n=n.replace(/%(23|24|26|2B|5E|60|7C)/g,decodeURIComponent),n=n.replace(/[\(\)]/g,escape),document.cookie=[n,"=",r,i.expires?"; expires="+i.expires.toUTCString():"",i.path?"; path="+i.path:"",i.domain?"; domain="+i.domain:"",i.secure?"; secure":""].join("")}n||(c={});for(var p=document.cookie?document.cookie.split("; "):[],u=/(%[0-9A-Z]{2})+/g,d=0;d<p.length;d++){var f=p[d].split("="),l=f.slice(1).join("=");'"'===l.charAt(0)&&(l=l.slice(1,-1));try{var m=f[0].replace(u,decodeURIComponent);if(l=t.read?t.read(l,m):t(l,m)||l.replace(u,decodeURIComponent),this.json)try{l=JSON.parse(l)}catch(s){}if(n===m){c=l;break}n||(c[m]=l)}catch(s){}}return c}}return o.set=o,o.get=function(e){return o.call(o,e)},o.getJSON=function(){return o.apply({json:!0},[].slice.call(arguments))},o.defaults={},o.remove=function(n,t){o(n,"",e(t,{expires:-1}))},o.withConverter=n,o}return n(function(){})});