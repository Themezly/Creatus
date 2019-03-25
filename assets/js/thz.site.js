/**
 * @package      Thz Framework
 * @copyright    Copyright(C) since 2015  Themezly.com. All Rights Reserved.
 * @author       Themezly
 * @license      http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 * @websites     http://www.themezly.com | http://www.youjoomla.com
 */
;window.onerror = function(msg, url, line, col, error) {
   var extra = !col ? '' : '\ncolumn: ' + col;
   extra += !error ? '' : '\nerror: ' + error;
   url +=':'+line;
   console.log("Error: " + msg + "\nurl: " + url + "\nline: " + line + extra);
	
	var holders = document.getElementsByClassName('thz-items-grid-holder'),
		len = holders !== null ? holders.length : 0,
		i = 0;
	for(i; i < len; i++) {
		holders[i].className += " thz-items-grid-loaded"; 
	}
	
	var html = document.getElementById('thz-site-html');
	
	if (html.classList.contains('thz-preloader-active')) {
		html.classList.remove('thz-preloader-active');
	}

};

(function($, window, document, undefined) {

    "use strict";

    var pluginName = "ThzSite",
        defaults = {};

    function Plugin(element, options) {
        this.element = element;

        this.settings = $.extend({}, defaults, options);
        this._defaults = defaults;
        this._name = pluginName;
        this.init();
    }

    $.extend(Plugin.prototype, {
        init: function() {

            var self = this;
			
			this.haspreloader 	= $('.thz-preloader').length > 0 ? true : false;
			this.wpadminbar		= $('#wpadminbar').length > 0 ? $('#wpadminbar').outerHeight() : false;
			this.scrollTrigger	= false;
			
			self.thzBodyContainerWidth();
			self.thzOffcanvasPageBlock();
			self.thzMagnificPageBlocks();
			self.thzFullHeights();
			self.thzSectionBrightness();
            self.thzFooterReveal();
            self.thzAdjustMenu();
            self.thzPanels();
            self.thzSmoothScroll();
            self.thzShortcodeTabs();
            self.thzShortcodeAccordion();
            self.thzNotificationClose();
			self.thzSiteMasonry();
			self.thzInitAnimations( this.haspreloader );
			self.thzBeforeAfter();
            self.thzSlick();
            self.thzWallpaper();
            self.thzParallax();
            self.thzInfinity();
            self.thzParallaxOver();
            self.thzScrollFade();
            self.thzIconEffects();
            self.thzIconBoxEffects();
            self.thzSocialShare();
            self.thzWoo();
            self.thzMedia();
            self.thzMagnific();
            self.thzSticky();
			self.thzFullPageRows();
            self.thzUnfocus();
            self.thzBuddyPress();
            self.thzAccordionMenu();
            self.thzCanvasAndOverlays();
            self.thzGridItemEffects();
            self.thzMobileMenu();
            self.thzFormAjax();
			self.thzMediaItemHovered();
			self.thzSwapImg();
			self.thzTyping();
			self.thzExitPopup();
			self.thzLiveSearch();
			self.thzParticles();
			self.thzScroll();
			self.thzTooltip();
			self.thzCustomTooltips();
			self.thzSiteOffline();
			self.thzPostLikes();
			self.thzCookiesConsent();
			self.thzCommentsFocus();

			if($('.prettyprint').length > 0 ){
				 prettyPrint();
			}

        },

		thzInitOnLoad: function (){
			
			var self = this;
			self.thzPreloader(); 
			
		},
		
		thzInitOnResize: function (){
			
			var self = this;
			
			self.thzBodyContainerWidth();
			self.thzFullHeights();
			self.thzSlickNavsRelativeTo();
			self.thzFooterReveal();
			self.thzAdjustMenu();
			self.thzOffcanvasBugerPosition();
			self.thzStickyElement();			
		},
		
		thzInitAnimations: function (haspreloader){
			
			var self = this;
			
			// thzPreloader will init these
			if (!haspreloader) {
				 
				ThzSetTimeout(function (){
					
					self.thzAnimations();
					self.thzProgressBars();
					self.thzCounters();
					self.thzCircleProgress();
					self.thzCountdown();
					self.thzSetHoverNavs();
					self.thzButtonShadowEffects();
					self.thzTextRotate();
				
				},20);	
			}
		},	
		
		thzCommentsFocus: function(){
			
			var self = this;

 			$('.thz-comments-form-labels-inside').find('input, textarea').on('focus',function(){
				
				var $this = $(this);
				$this.parent().addClass('active-input');
				
			}).on('blur', function() {
				
				var $this = $(this);
				$this.parent().removeClass('active-input');
				
				if( $this.val() !== '' ){
					$this.parent().addClass('filled-input');
				} else {
					$this.parent().removeClass('filled-input');
				}				
               
            });			
		},
		
		thzTextRotate: function(){
			
			var self = this;
			
 			$('.thz-rotate-text').ThzTextRotator();			
			
		},
		
        thzCookiesConsent: function () {

            var self = this;
			
            if ( Cookies.get('ThzCookiesConsent' )){
				 return;
			}
			
			var $consent  	= $('#thz_cookies_consent');
			
			if($consent.length > 0){

				$('.thz-consent-button .thz-button').on('click', function (e) {
					e.preventDefault();
					$consent.slideToggle(400, function() {
						$consent.remove();
						Cookies.set('ThzCookiesConsent', true);
					});
				});
			}

        },
		
		thzBodyContainerWidth: function ( get_info ){
			
			var self = this;
	
			var $windowWidth 	= $('.thz-body-box').outerWidth();
			var $newWidth 		= 12 * Math.ceil( $windowWidth  / 12 );
			var $difference		= ( $windowWidth - $newWidth ) / 2;	
			
			if( get_info === true ){
				
				var info = {
					
					windowWidth: $windowWidth,
					newWidth: $newWidth,
					difference: $difference	
				};
				
				return info;
				
			}
					
			if($('.thz-wrapper').hasClass('thz-layout-boxed')){
				return;
			}
			
			$('.thz-body-container').css({
				width:$newWidth,
				'margin-left':$difference
			});
			
			if ( $('.header-lateral-left').length > 0 ){
				$('.header-lateral-left').css({
					'left':Math.abs($difference)
				});	
			}
			
			if ( $('.header-lateral-right').length > 0 ){
				$('.header-lateral-right').css({
					'left':$difference
				});	
			}
			

		}, 
		
		
		thzPostLikes: function() {

			var self = this;

			$(document).on('click','.thz-likes', function(e) {
				
				e.preventDefault();

				var $post 			= $(this);
				var $post_id 		= $(this).data('post-id');
				var $post_likes		= $('.thz-likes[data-post-id='+ $post_id +']');
				var $likes_count 	= $post_likes.find('.thz-likes-count');
				var $likes_icon 	= $post_likes.find('.thz-likes-icon');
				var $current_likes 	= $likes_count.html();
				var $icon_like 		= 'fa fa-heart-o';
				var $icon_has_liked	= 'fa fa-heart';
				var $icon_send 		= 'thzicon thzicon-spinner10 thz-spin';
				
				$post_likes.blur();
				
				if ( !$post_likes.hasClass("has-liked") ) {
					
					$likes_icon.removeClass($icon_like).addClass($icon_send);
					
					$.ajax({
						type: 'post',
						url: thzsite.ajaxurl,
						data: {
							action: 'thz_like',
							post_id: $post_id,
							nonce: thzsite.likesnonce,
						}
					}).done(function(response) {
						
						var likes = response.data.total;
						
						if ($current_likes < likes) {
							
							$likes_count.html(likes);
							$likes_icon.removeClass($icon_send).addClass($icon_has_liked);
							$post_likes.addClass('has-liked');
							var $likes_text = likes == 1 ? thzsite.likesingular : thzsite.likeplural;
							$post_likes.find('.thz-likes-text').html(' ' + $likes_text + ' ');
	
						}
						
						$post_likes.addClass('has-liked');

	
					}).fail(function(error) {
	
						console.error(error.status);
	
					});

				}
			});

		},
		
		thzFullHeights: function() {
			
			var self = this;
			
			if( $('.thz-full-height-in').length > 0 ){
				
				var $remove_from_height = 0;
				
				if($('.thz-mobile-menu-holder').is(':visible')){
					
					$remove_from_height += - $('.thz-mobile-menu-holder').outerHeight();
				}
				
				if(self.wpadminbar){
					
					$remove_from_height += self.wpadminbar;
				}
				
				if($remove_from_height > 0){

					$('.thz-full-height-in').each(function(index, element) {
						
						var $this =  $(this);
						$this.css('height','');
						
						var $percent 	= parseFloat($this.outerHeight()) / window.innerHeight * 100;
						
						$this.css('height','calc('+ $percent  +'vh - '+ $remove_from_height +'px)');
					});
				
				}else{
					
					$('.thz-full-height-in').css('height','');
					
				}
				
			}
			
		},
		
		thzSetViewBrightness: function(section){
			
			var self = this;
			
			if( section.length < 1 ){
				return;
			}
			
			var $brightness = section.attr('data-view-brightness');
			
			
			if( $brightness != undefined ){
				
				if( !$('body').hasClass('thz-brightness-' + $brightness) ){
				
					$('body').removeClass('thz-brightness-light thz-brightness-dark thz-brightness-none')
					.addClass('thz-brightness-' + $brightness);	
				
				}

			}else{
				
				$('body').removeClass('thz-brightness-light thz-brightness-dark thz-brightness-none');
			}
		}, 

		thzSectionBrightness: function() {

		    var self = this;

		    if ($('html').hasClass('header_left') || $('html').hasClass('header_right')) {

		        return;

		    }
			
            var stickyHeader = $('.thz-sticky-header');
			
			if( stickyHeader.length < 1 || !stickyHeader.hasClass('sticky-show') ){
				return;
			}

			var $brightness_els = $('[data-view-brightness="light"], [data-view-brightness="dark"]');
		   
		    if ( $brightness_els.length > 0 && typeof($.fn.waypoint) != 'undefined' ) {
				
				var $elements = $('[data-view-brightness]');
		        var outerH = $('.header_holder').actual( 'outerHeight' );
				
				if($('.thz-mobile-menu-holder').is(':visible') ){
					outerH += $('.thz-mobile-menu-holder').actual( 'outerHeight' );
				}
				
				$elements.waypoint({
					handler: function(direction) {
						
						 if (direction === 'down') {
							 self.thzSetViewBrightness($(this.element));
						 }
						 
						 if (direction === 'up') {
							 
							var prev = this.previous();
	
							if (prev) {
								
								self.thzSetViewBrightness($(prev.element));
	
							} else {
	
								$('body').removeClass('thz-brightness-light thz-brightness-dark');
								self.thzSetViewBrightness($(this.element));
							}
						 }
					},
					offset: outerH,
					group: 'brightness',
				});
			
		    }
		},

        thzFooterReveal: function() {

            var self = this;

            if ($(".thz-reveal-footer").length) {
				
				var $pusher = $('.thz-footer-reveal');
				var $reveal = $('.thz-reveal-footer');
                var $height = $reveal.outerHeight();
				var $width  = $pusher.outerWidth();
				var $bottom	= $('.thz-body-frame').length > 0 ? $('.thz-bf-top').outerHeight() : 0;
				var $doch	= $(document).height();
				var $winh	= $(window).height();
				
				if( $doch == $winh ){
					$reveal.css({
						'position':'relative',
						'z-index':'auto'
					});
					return;
				}
								
                $pusher.css('height', $height);
				$reveal.css({
					'width': $width,
					'bottom': $bottom,
				});
            }
        },
		
        thzAdjustMenu: function() {

            var self = this;

			if($('#thz-nav').length < 1){
				return;
			}

            if ($('.header-inline').length > 0) {
				
				var $menu_holder 	= $('.thzmega') ;
				var $pl				= parseFloat($('.thzmega').css('padding-left'));
				var $menuopos 		= $menu_holder.position();
				var $menuoffset 	= $menuopos.left + $pl;
				var $wrapper_pull	= self.thzBodyContainerWidth( true ).difference;		
				var $menu_position 	= $wrapper_pull == 0 ? -$menuoffset : -$menuoffset + $wrapper_pull;
				
                $('.header-inline ul.thz-menu div.ulholder.mega-menu-row').css({

                    'width': $('#header').css('width'),
                    'left': $menu_position

                });

                $('html').addClass('menuIsSet');
            }
			
			
			ThzSetTimeout(function (){
				
				$("#thz-nav li.menu-item-has-children > .ulholder").each(function(index, element) {
					var $this = $(this);
					
					$this.parent().removeClass('flip');
					
					if ($(window).width() < $this.offset().left + ($this.outerWidth())) {
						$this.parent().addClass('flip');
					}
				});
			},500);	
		
        },
							
		thzBeforeAfter: function (){
			
			var self = this;

			if (typeof($.fn.waypoint) != 'undefined') {
				
				  $('.thz-before-after').each(function() {
					
						var $el =  $(this);
						
						var inview = new Waypoint.Inview({
						  element: $el,
						  entered: function(direction) {
							  $el.twentytwenty();
						  },
						  exit: function(direction) {
							  this.destroy();
						  },
						  exited: function(direction) {
							this.destroy();
						  }
						});
					
				  });
			  
			}else{
				
				 $('.thz-before-after').twentytwenty();
				
			}
			

		},
		
		thzParticles: function (){
			
			var self = this;
			
			var $particles = $('.thz-particles');
			
			 if ($particles.length) {


				 
				$particles.each(function(index, element) {
                    
					var $this 	= $(this);
					var $id 	= $this.attr('id');
					var $data 	= $this.attr('data-particles');

					try{
						
						$data = JSON.parse($data);
						particlesJS($id,$data);
					}
					catch (error){
						
						console.warn('Bad particles JSON');
					}

					
                });
				 
			 }
	
		},
		
		thzLiveSearch: function (input,post_types,search_through,results_limit,show_intro,intro_limit,show_thumbnail){
			
			var self = this;
			
			var $el  = input != undefined ? input : $(".thz-live-search .text-input");
			
			if($el.length < 1){
				return;
			}

			var $post_types 	= post_types != undefined ?  post_types : [];
			var $search_through = search_through != undefined ?  search_through : 'post_title';
			var $results_limit 	= results_limit != undefined  ?  results_limit : 5;
			var $show_intro 	= show_intro != undefined ?  show_intro : true;
			var $intro_limit 	= intro_limit != undefined  ?  intro_limit : 20;
			var $show_thumbnail = show_thumbnail != undefined ?  show_thumbnail : true;
			var $id 			= $el.attr('id') ? ' id="'+$el.attr('id')+'-results"' : '';
			
			if($el.is('[data-post-types]')){
				
				$post_types = JSON.parse($el.attr('data-post-types'));
			}
			
			if($el.is('[data-search-through]')){
				
				$search_through = $el.attr('data-search-through');
			}
			
			if($el.is('[data-results-limit]')){
				
				$results_limit = $el.attr('data-results-limit');
			}
			
			if($el.is('[data-show-intro]')){
				
				$show_intro = $el.attr('data-show-intro');
			}
			
			if($el.is('[data-intro-limit]')){
				
				$intro_limit = $el.attr('data-intro-limit');
			}
			
			if($el.is('[data-show-thumbnail]')){
				
				$show_thumbnail = $el.attr('data-show-thumbnail');
			}
			
			
			$el.attr('autocomplete','off');
			
			$('body').remove('.thz-live-search-results')
			.append('<div'+$id +' class="thz-live-search-results"></div>');
			
			function searchResultPosition(element){
				
				var $position 	= element.offset();
				var $width 		= element.outerWidth();
				var $height 	= element.outerHeight();
				
				$('.thz-live-search-results').css({
					top:$position.top + $height,
					left:$position.left,
					width:$width
				});				
				
			}
			
			function searchItemTemplate(results){
				
				var html ='';
				
				var length = $.map(results, function(n, i) { return i; }).length;
				
				if(length === 0){
					
					html ='<span class="no-results">No results found</span>';
				}
				
				$.each(results,function(index,el){
					
					html +='<div class="thz-live-search-item">';
					if(el.item_thumbnail !='' && $show_thumbnail){
						html += '<div class="thz-live-search-item-thumbnail">';
						html +='<div class="thz-live-search-item-thumbnail-holder">';
						html += '<img src="'+el.item_thumbnail+'" alt="'+el.item_name+'" />';
						html +='</div>';
						html +='</div>';
					}
					html += '<div class="thz-live-search-item-text">';
					html += '<span class="thz-live-search-item-name">';
					html += el.item_name;
					html +='</span>';
					if(el.item_intro !='' && $show_intro){
						html += '<span class="thz-live-search-item-intro">';
						html += el.item_intro;
						html +='...</span>';
					}
					html +='</div>';
					html +='<a class="thz-live-search-item-link" href="'+el.item_link+'">';
					html +='</a>';
					html +='</div>';
				});
				
				return html;
			}
			
			function searchResultClose(){
				
				$('.thz-live-search-results').removeClass('active');
			}
			
			var $parent = $el.parent().attr('class');
			
			$(document.body).on('click', function(e) {
				
				if (!$(e.target).parents('.thz-live-search-results,.' + $parent).length) {
					searchResultClose()
				}
	
			});	
			
			window.onresize = searchResultClose;

			$el.on('keyup', function() {
				 
				 var $this = $(this);
				 var $term = $this.val();
				 
					if($term.length < 3 ){
						return;
					}
					
					$this.parents('.thz-search-form').addClass('loading');
					
					$.ajax({
	
						url: thzsite.ajaxurl,
						type: 'POST',
						data: {
							'action': 'thz_find_posts',
							'search_term': $term,
							'post_types': $post_types,
							'search_through':$search_through,
							'results_limit':$results_limit,
							'intro_limit': $intro_limit
	
						},
						dataType: 'json',
						success: function(response) {
							
							$this.parents('.thz-search-form').removeClass('loading');
							
							if (response.success === false || typeof response.data === 'undefined') {
								return;
							}
							
							var $html = searchItemTemplate(response.data);
							searchResultPosition($this);
							$('.thz-live-search-results').addClass('active').html($html);
	
						},
						error: function(e) {
							$this.parents('.thz-search-form').removeClass('loading');
							return false;
						}
					});				 
				 
			});
		},


		
		thzExitPopup: function (){
			
			var self = this;
			
			var $exists = $('.thz-exit-popup');

			if($exists.length < 1){
				return;
			}
			
			ThzSetTimeout(function (){
				$(document).mousemove(function(e) {

					if(e.clientY <= 5){
						
						$('.thz-exit-popup:not(.opened)').each(function(index, element) {
							
							var $this 		= $(this);
							var $expire  	= parseInt( $this.attr('data-expire') );
							
							if($expire == 0){
								
								$this.trigger('click').addClass('opened');
								
							}else{
								
								var $val		= $this.attr('href');
								
								if (Cookies.get($val)){
									return;
								}else{
									
									$this.trigger('click').addClass('opened');
									Cookies.set($val,$val, { expires: $expire });
								
								}
							}
							
						});
					}
				});
			
			},200)
   			
		},
		
		
		thzTyping: function (){
			
		  var self = this;
		  
		  function runTyped($el){
			 
			  if( $el.hasClass('is-typing') ){
				  return;
			  }
			  
			  var $id	   	= $el.attr('data-id');
			  var $options 	= JSON.parse($el.attr('data-options'));
			  
			  var options = {
				  stringsElement :'#thz-typed-strings-' + $id,
				  contentType: 'html',
				  typeSpeed:parseInt( $options.typespeed),
				  startDelay: parseInt($options.startdelay),
				  backSpeed: parseInt($options.backspeed),
				  fadeOut: $options.fadeout == 1 ? true: false,
				  loop: $options.loop == 1 ? true: false,
				  loopCount: parseInt($options.loopcount) > 0 ? parseInt($options.loopcount): false,
				  shuffle: $options.shuffle == 1 ? true: false,
				  showCursor: $options.showcursor == 1 ? true: false,
				  cursorChar: $options.cursorchar,
				  preStringTyped: function(pos, self) {
					  $el.addClass('is-typing');
				 },
			  };			  
			 
			  var typed = new Typed( '#thz-typed-' + $id , options );
	
		  }
		  
		  $('.thz-typist').each(function() {
			
				var $this 	=  $(this);
				var $parent =  $this.parents('.thz-typist-container');
				
                if ($parent.hasClass('thz-animate')) {

                    $parent.on('thz:animation:done', function(e) {
                        runTyped($this);
                    });

                } else {

                    if (typeof($.fn.waypoint) != 'undefined') {

						var inview = new Waypoint.Inview({
						  element: $this,
						  entered: function(direction) {
							  runTyped($this);
						  },
						  exit: function(direction) {
							  this.destroy();
						  },
						  exited: function(direction) {
							this.destroy();
						  }
						});

                    } else {

                        runTyped($this);
                    }

                }
		  });	
		  
		},
		
		thzPreloadImg: function(url, callback){
			
			var self = this;
			 
			var img = new Image();
			img.src=url;
			img.onload = callback;


			
		},
		
		thzSwapImg: function (){
			
			 var self = this;
			 

            $('.thz-swap-on-view').each(function() {
				
				var $this 	= $(this);
				var $parent = $this.parent();
				
				new Waypoint({
					element: $parent,
					handler: function() {
						$this.addClass('thz-swap-on');
						this.destroy();
					},
					offset: '40%'
				});

           	 });
			 
			 
			  $('.thz-swap-on-hover').each(function(el) {
				  
				var $this = $(this);
				  
				$this.parent().on('mouseenter', function (event) {
					$this.addClass('thz-swap-on');
				}).on('mouseleave', function (event) {
					$this.removeClass('thz-swap-on');
				});				  
			  });
			
		},
		
		
        thzOembed: function($wrapper) {

            var self = this;

            if ($wrapper.data('embed')) {

                $wrapper.html($wrapper.data('embed')).promise().done(function() {
                    $(this).addClass('thz-oembed-loaded').trigger('thz:oembed:loaded');
                });

            } else {

                $.ajax({
                    type: 'post',
                    url: thzsite.ajaxurl,
                    data: {
                        action: 'thz_oembed_response',
                        _nonce: $wrapper.data('nonce'),
                        url: $wrapper.data('url'),
                        width: $wrapper.outerWidth(),
                        height: $wrapper.outerHeight(),
                    }
                }).done(function(response) {

                    $wrapper.html(response.data).promise().done(function() {
                        $(this).addClass('thz-oembed-loaded').trigger('thz:oembed:loaded');
                    });

                }).fail(function(error) {

                    $wrapper.html('');
                    console.error(error.status);

                });

            }


        },

        thzFormAjax: function() {

            var self = this;

            if (typeof fwForm != 'undefined') {

                fwForm.initAjaxSubmit({
                    selector: '.thz-shortcode-form form',


                    loading: function(elements, show) {

                        elements.$form.parent().find('.thz-items-loading').fadeIn(400);

                    },

                    onSuccess: function(elements, ajaxData) {

                        var html = fwForm.frontend.renderFlashMessages(ajaxData.flash_messages);
                        var msbox_container = elements.$form.parent().find('.thz-shortcode-form-msg-container');
						var msbox = elements.$form.parent().find('.thz-shortcode-form-msg');
                        var loader = elements.$form.parent().find('.thz-items-loading');
						var hide = elements.$form.parent().is('.thz-hide-form');

                        msbox.html(html);
                        loader.fadeOut(400);

                        if (ajaxData.flash_messages.success.fw_ext_contact_form_process != undefined) {
							
							
							if(hide){
								
								$(elements.$form)[0].reset()
								$(elements.$form).slideUp(400);
								msbox_container.slideDown(400);

							}else{
							
								$(elements.$form)[0].reset();
								msbox_container.slideDown(400);
								ThzSetTimeout(function() {
									msbox_container.slideUp(400);
								}, 2000);
							}
							
                        } else {
							
							msbox_container.slideDown(400);
                            ThzSetTimeout(function() {
                                msbox_container.slideUp(400);
                            }, 4000);
                        }


                        if (typeof Recaptcha != 'undefined') {
                            Recaptcha.reload();
                        }

                        if (typeof grecaptcha != 'undefined') {
                            grecaptcha.reset();
                        }
                    },

                    onErrors: function(elements, data) {


                        var loader = elements.$form.parent().find('.thz-items-loading');
                        loader.fadeOut(400);

                        // Frontend
                        jQuery.each(data.errors, function(inputName, message) {

                            message = '<p class="form-error">{message}</p>'
                                .replace('{message}', message);

                            var $input = elements.$form.find('[name="' + inputName + '"]').last();

                            if (!$input.length) {
                                // maybe input name has array format, try to find by prefix: name[
                                $input = elements.$form.find('[name^="' + inputName + '["]').last();
                            }

                            if ($input.length) {
                                // error message under input
                                $input.parent().after(message);
                            } else {
                                // if input not found, show message in form
                                elements.$form.prepend(message);
                            }
                        });

                        if (typeof Recaptcha != 'undefined') {
                            Recaptcha.reload();
                        }

                        if (typeof grecaptcha != 'undefined') {
                            grecaptcha.reset();
                        }
                    }


                });
            }
        },
		
		thzMediaItemHovered: function() {
			
			
			 var self = this;
			
			$(".thz-media-item").on('mouseenter', function() {

				$(this).addClass("item-hovered thz-hover-on");

			}).on('mouseleave', function() {

				$(this).removeClass("item-hovered thz-hover-on");
			});			
			
			
			if($('.thz-media-mode-directional').length > 0){
				$('.thz-media-mode-directional .thz-media-item').hoverdir({
					hoverDelay: 75,
					hoverElem: '.thz-overlay-box-directional'
				});
			}
			
		},
		
		
		
        thzGridItemEffects: function(element) {

            var self = this;

            var $selector = $(".thz-grid-item");

            if (element) {

                $selector = element;
            }

            $selector.each(function(index, element) {

                var $this = $(this);
                var $mode = $this.attr('data-mode');
				
				if($this.hasClass('thz-new-window')){
					$this.find('.thz-hover-link,.thz-grid-item-title a,.thz-hover-link-icon,.thz-grid-item-button a').attr('target','_blank');
				}

                if ($mode == 'introunder') {
                    $this = $(this).find('.thz-grid-item-media');
                }

                if ($mode == 'reveal' || $mode == 'directional' || $mode == 'thzhover') {

                    $this.find('.thz-grid-item-in').on('mouseenter', $this, function() {

                        $(this).addClass("item-hovered thz-hover-on");

                    }).on('mouseleave', function() {

                        $(this).removeClass("item-hovered thz-hover-on not-first-slick");
                    });

                }

                if ($mode == 'directional') {

                    $this.find('.thz-grid-item-in').hoverdir({
                        hoverDelay: 75,
                        hoverElem: '.thz-grid-item-intro-holder'
                    });

                }


            });

            self.thzMagnific();
            self.thzTooltip();

        },

        thzPanels: function() {

            var self = this;


            if ($('.thz-panel').length) {

                $(document).ThzPanels();
            }


        },
		
		
		thzPreloaderClick: function (){
			
			var self = this;

			$('.thz-body-box a[href]:not([target="_blank"]):not([href^="#"]):not([href^="mailto:"]):not(.comment-edit-link):not(.thz-lightbox):not(.comments-link):not(#cancel-comment-reply-link):not(.comment-reply-link):not(.add_to_cart_button):not(.remove):not(.thz-entry-comments a):not(.thz-acc-toggler):not(.thz-fpr-link):not(.thz-scroll):not(.thz-mobile-toggler)').on("click",function(e) {		 
		 			
					var $link = $(this);
					var $href = $link.attr('href');
					var $delay = 0;
					
					if($link.is('[href^="#"]')){
						return;
					}
					
					e.preventDefault();
					
					$('.thz-preloader').removeClass('finished');
					$('html').toggleClass('thz-preloader-active thz-preloader-click');
					
					if(!$('.thz-preloader').hasClass('leave-fade')){
						$delay = 500;
					}
					
					if( thzsite.is_customizer == 0 ){
					
						ThzSetTimeout(function() {
							window.location = $href;
						}, $delay);	
									
					}
			 });			
		},
		
        thzPreloader: function() {

            var self = this;

            if (self.haspreloader) {
				
				
				
				var $init_delay = 0;
                var $delay = $('.thz-preloader').attr('data-delay');
				var $onclick = $('.thz-preloader').attr('data-onclick');
                var $delay2 = parseInt($delay) + 1200;
				
				if($onclick == 'active'){
					self.thzPreloaderClick();
				}
				
				if(!$('.thz-preloader').hasClass('leave-fade')){
					$init_delay = 350;
				}

				ThzSetTimeout(function() {
					
					$('html').toggleClass('thz-preloader-active');
					
					ThzSetTimeout(function() {
						
						self.thzInitAnimations(false);
						
					}, $init_delay );
					
				}, $delay);

				ThzSetTimeout(function() {
				   $('.thz-preloader').addClass('finished');
				}, $delay2);
				
            }
        },

		thzOffcanvasBugerPosition : function (changed){
			
			var self = this;
			var scrolltop = $(window).scrollTop();
			
			if($('.off-to-overlay').length > 0){
				var $bp = $('.header-offcanvas .thz-burger').offset();
				$('.off-to-overlay .thz-burger').css({
					'top':	$bp.top - scrolltop,
					'left':	$bp.left
				});	
			}

			if($('.thz-push-burger').length > 0){
				
				var $bp = $('.header-offcanvas .thz-burger').offset();
				
				$('.thz-push-burger').css({
					'top':	$bp.top - scrolltop,
					'left':	$bp.left
				});	
			}					
		},
		
		thzOffcanvasPageBlock: function(){

			var self = this;
			var pageblock = $('.thz-offcanvas-pageblock-holder');
			
			if ( pageblock.length < 1 ) {
				return;
			}
			
			pageblock.find('.thz-page-builder-content,.thz-full-page-row-in').unwrap();
			pageblock.find('.thz-section-holder').removeAttr('data-slabel').removeAttr('data-view-brightness')
			.removeClass('thz-fp-excluded light dark none');

			pageblock.find('[data-anim-effect]').removeClass('thz-animate');
			pageblock.find('.thz-cpx,.thz-parallax-scroll').css({
				'transform': ''	
			});
			
			$(document).on("thz:canvas:changed", "html", function(e) {
				
				if( $(e.target).hasClass('canvasOpen') ){
					
					pageblock.find('[data-anim-effect]').addClass('thz-animate')
					.removeClass('thz-anim-draw-svg');
					self.thzAnimations(pageblock.find('.thz-animate'));
					
				}else{
					
					ThzSetTimeout(function() {
						pageblock.find('[data-anim-effect]').addClass('thz-animate');
						pageblock.find('.thz-cpx,.thz-parallax-scroll').css({
							'transform': ''	
						});		
					}, 400);			
				}
				
			});			
		},
		

		thzMagnificPageBlocks: function(){

			var self = this;
			var pageblocks = $('.thz-popup-box .thz-page-block-holder');
			
			if ( pageblocks.length < 1 ) {
				return;
			}
			
			var $full_row = pageblocks.find('.thz-full-page-row-in');
			
			if ( $full_row.length > 0 ) {
				pageblocks.find('.thz-page-builder-content,.thz-full-page-row-in').unwrap();
			}
			
			pageblocks.find('.thz-section-holder').removeAttr('data-slabel').removeAttr('data-view-brightness')
			.removeClass('thz-fp-excluded light dark none');

			pageblocks.find('[data-anim-effect]').removeClass('thz-animate');
			pageblocks.find('.thz-cpx,.thz-parallax-scroll').css({
				'transform': ''	
			});
			
			$('.thz-lightbox.mfp-inline').on('mfpOpen', function(e) {
				pageblocks.find('[data-anim-effect]').addClass('thz-animate')
				.removeClass('thz-anim-draw-svg');
				self.thzAnimations(pageblocks.find('.thz-animate'));
			});
			
		},
		
        thzCanvasAndOverlays: function() {

            var self = this;

			self.thzOffcanvasBugerPosition();
			
			$(document).on("thz:canvas:changed", "html", function(e) {
				ThzSetTimeout(function() {
					self.thzOffcanvasBugerPosition(true);
				}, 400);
			 });
			
            $(".thz-open-mobile-menu").click(function(e) {
                e.preventDefault();

                $('ul.thz-mobile-menu ul:visible').slideUp('normal');
                $('ul.thz-mobile-menu li').removeClass('active_acc inactive_acc');

                $(this).toggleClass('is-active');
                
                $(".thz-nav-mobile").slideToggle(500);
				
                ThzSetTimeout(function() {

                    $("html").toggleClass("mobileOpen");

                }, 500);

            });

            $(".thz-open-search").click(function(e) {
                e.preventDefault();
                $(this).toggleClass('is-active');
                $("html").toggleClass("searchOpen");

            });

            $(".thz-open-canvas").click(function(e) {

                e.preventDefault();
				
				$("html").addClass('canvasClosing');
                $('ul.thz-acc-menu .ulholder:visible').slideUp('normal');

                $(this).toggleClass('is-active');
                $("html").toggleClass("canvasOpenDelay");
                $('.thz-burger-offcanvas').toggleClass('is-active');

                ThzSetTimeout(function() {

                    $("html").toggleClass("canvasOpen canvasOpenDelay")
					.removeClass('canvasClosing').trigger('thz:canvas:changed');
					
                }, 400);

            });

            if ($('.thz-burger-onboth').length) {
                $(document).on("mouseleave", ".canvasOpen .header_holder", function(e) {
                    var $this = $(this);
                    ThzSetTimeout(function() {
                        $this.find('.thz-burger-onboth').trigger('click');
                    }, 250);
                });
            }

            if ($('.thz-burger-onoverlay').length && $('.thz-offcanvas-pageblock-holder').length < 1) {
                $(document).on("click", ".canvasOpen .thz-canvas-overlay", function(e) {
					if($(e.target).hasClass('thz-canvas-overlay')){
                   		$('.thz-burger-onoverlay').trigger('click');
					}
                });
            }

            if ($('.thz-burger-offcanvas').length) {
                $(document).on("click", ".thz-burger-offcanvas", function(e) {
                    $('.thz-burger-onoverlay').trigger('click');
                });
            }


            if ($('.thz-close-search').length) {
                $(document).on("click", ".thz-close-search", function(e) {
                    e.preventDefault();

                    $('.thz-open-search').eq(0).trigger('click');
                });
            }
			
        },



        thzBuddyPress: function() {

            var self = this;


            $('.activity-list').bind("DOMSubtreeModified", function() {
                self.thzAnimations($('#buddypress li.thz-animate'));
            });



        },
		
        thzMobileMenu: function() {

			var self = this;

            $('.thz-mobile-menu li.has-children').each(function(el) {

                var $toggler = $(this).find('a').first();
                $toggler.addClass('thz-mobile-toggler');

                $toggler.on('click', function(e) {
                    e.preventDefault();
                });

            });

            $('ul.thz-mobile-menu > li:has(ul)').addClass("inactive_acc");
            $('ul.thz-mobile-menu > li:has(ul) ul').css('display', 'none');

            $('.thz-mobile-toggler').click(function() {

                var checkElement = $(this).next();

                $('.thz-mobile-menu li').removeClass('active_acc');
                $(this).closest('li').addClass('active_acc').removeClass("inactive_acc");

                if ((checkElement.is('ul')) && (checkElement.is(':visible'))) {
                    $(this).closest('li').removeClass('active_acc').addClass('inactive_acc');
                    checkElement.slideUp('normal');
                }

                if ((checkElement.is('ul')) && (!checkElement.is(':visible'))) {


                    $('ul.thz-mobile-menu ul:visible').not($(this).parents('ul')).slideUp('normal');
                    checkElement.slideDown('normal');
                }

                if (checkElement.is('ul')) {
                    return false;
                } else {
                    return true;
                }
            });


        },
		
        thzAccordionMenu: function() {

            var self = this;

            $('.thz-acc-menu .menu-item-has-children').each(function(el) {

                var $toggler = $(this).find('a').first();
                $toggler.addClass('thz-acc-toggler');

                $toggler.on('click', function(e) {
                    e.preventDefault();
                });

            });
            $('ul.thz-acc-menu > li:has(ul)').addClass("inactive_thzacc");

            $('.thz-acc-toggler').click(function() {

                var checkElement = $(this).parent().next();

                $('.thz-acc-menu li').removeClass('active_thzacc');
                $(this).closest('li').addClass('active_thzacc').removeClass("inactive_thzacc");

                if ((checkElement.is('.ulholder')) && (checkElement.is(':visible'))) {
                    $(this).closest('li').removeClass('active_thzacc').addClass('inactive_thzacc');
                    checkElement.slideUp('normal');
                }

                if ((checkElement.is('.ulholder')) && (!checkElement.is(':visible'))) {

                    if ($("ul.thz-acc-menu").hasClass("closeother")) {
                        $('ul.thz-acc-menu .ulholder:visible').not($(this).parents('.ulholder')).slideUp('normal');
                    }
                    checkElement.slideDown('normal');
                }

                if (checkElement.is('.ulholder')) {
                    return false;
                } else {
                    return true;
                }
            });

        },


        thzWoo: function() {

            var self = this;

            $(document.body).on('adding_to_cart', function(event, btn, data) {

                $(btn).parents('.thz-woo-item').addClass('thz-woo-item-adding');

            });

            $(document.body).on('added_to_cart', function(event, fragments, hash, btn) {

                $(btn).parents('.thz-woo-item')
                    .removeClass('thz-woo-item-adding')
                    .addClass('thz-woo-item-in-cart');

                $(btn).parent().attr('data-original-title', 'View cart');
				
				$('li.thz-menu-woo-cart').removeClass('thz-mini-no-items')
				.addClass('thz-mini-has-items');
					
            });

			 $(document.body).on('click','.mini_cart_item .remove', function(e){
				
				e.preventDefault();
				
				var $this =  $(this);
				var $product_id = $this.attr("data-product_id");
				
				$this.parent().addClass('thz-woo-item-removing');
				
				$.ajax({
					type: 'post',
					dataType: 'json',
					url: thzsite.ajaxurl,
					data: { 

						action: "thz_ajax_action_remove_from_cart", 
						product_id: $product_id,
						
					},success: function(data){
						
						if( data.fragments == null ){
							return;
						}
						
						$this.parent().slideUp(400, function() {
							
							var $cart_badge = data.fragments['span.thz-woo-cart-badge'];
							$('div.widget_shopping_cart_content').replaceWith(data.fragments['div.widget_shopping_cart_content']);
							$('span.thz-woo-cart-badge').replaceWith( $cart_badge );
							
							if( $($cart_badge).hasClass('thz-mini-no-items') ){
								$('li.thz-menu-woo-cart').addClass('thz-mini-no-items')
								.removeClass('thz-mini-has-items');								
							}
							//$('.post-'+product_id+'.product .thz-woo-item').removeClass('thz-woo-item-in-cart');// woo hook 260
						});

					}
				});
				
			});
			
			//  Wrapper before demo store banner if enabled.
            $('#thz-wrapper').before($('.demo_store'));
			
			
			// tabs

            if ($('.thz-woo-tabs').length > 0) {

                 if (location.href.match('#comment') || location.href.match('#reviews')) {
					
					$('a[href="#thz-tabs-woo-reviews"]').trigger('click');
					var lastSegment = location.href.split('/').pop();
	
					self.thzScrollToelement(lastSegment, -100, 800);

                }
				
				$('.woocommerce-review-link').on('click',function(){
					
					$('a[href="#thz-tabs-woo-reviews"]').trigger('click');
					self.thzScrollToelement('#reviews', -100, 800);
					
				});
            }
			
			// variation image change
			$.fn.thz_wc_variations_image_update = function( variation ) {
				
				if ( 
					( variation && variation.image && variation.image.src && variation.image.src.length > 1) 
					
					||
				
					(variation && variation.image_src && variation.image_src.length > 1 )
				 ) {
					
					var image = variation.image_id ? variation.image_id : 0;  
					
					$('.thz-woo-item-thumbs-slick .thz-hover[data-vid*="'+image+'"]' ).parents('.thz-slick-slide').trigger('click');

				} else {
					
					$( '.thz-woo-item-thumbs-slick .thz-slick-slide:eq(0)' ).trigger('click');

				}
			};

			$(document.body).on('check_variations','.variations_form',function(event,variation){
					
				$(this).thz_wc_variations_image_update( variation );
				
			});
			
						
			$(document.body).on('found_variation','.variations_form',function(event,variation){
					
				$(this).thz_wc_variations_image_update( variation );
				
			});
			
			
			$(document.body).on('reset_data','.variations_form',function(event,variation){

				$(this).thz_wc_variations_image_update( variation );
				
			});		
			
				
        },


        thzScrollToelement: function(el, poz, dur) {

            var self = this;

            var offset = $(el).offset().top + poz;

            $('html, body').animate({
                scrollTop: offset
            }, dur);

        },


        thzSiteMasonry: function() {

            if (typeof $.fn.ThzMasonry != 'undefined') {

				$('.thz-is-isotope').ThzMasonry();
				
				$('.thz-is-timeline').ThzMasonry({
					masonry: false
				});
				
            }else{
				
				$('.thz-items-grid-holder').addClass('thz-items-grid-loaded');
			}

        },

        thzSocialShare: function() {

            var self = this;

            $('.thz-social-share').on('click', function(e) {
                e.preventDefault();
                var $link = $(this).attr('data-link');

                window.open($link, 'ThzSocialPopup', 'height=450,width=500,scrollbars=yes,resizable=yes');

            });

        },


		thzSetHoverNavs: function (){
			
			var self = this;
			
			$('.thz-nav-wrap.has-hovers').each(function(index, element) {
                
				var x = 0;
				
				var els = $(element).find(".on-hover");
				var dir = $(element).hasClass('previous') ? -1 : 1;
		
				els.each(function(index, element) {
					var el = $(this);
					var elw = parseFloat(el.outerWidth());	
		
					x += elw;	
				});
				
				$(element).css({
					'transform':'translateX('+parseFloat(x) * dir+'px) translateZ(0)'	
				});					
            });
		},
		
        thzCountdown: function() {

            var self = this;
            $('.thz-countdown').ThzCountdown();

        },

        thzCircleProgress: function() {

            var self = this;

            function thzRunCircleProgress(element) {

                var $size = element.outerWidth();
                var $duration = element.attr('data-duration');

                element.circleProgress({

                    size: $size,
                    startAngle: -Math.PI / 2,
                    animation: {
                        duration: parseInt($duration),
                    },

                }).on('circle-animation-progress', function(event, progress, stepValue) {
                    $(this).find('.thz-circle-progress-value').html(parseInt(100 * stepValue));
                });
            }

            $('.thz-circle-progress-holder').each(function(index, element) {
                var $this = $(this);
                var $progress = $this.find('.thz-circle-progress');

                if ($this.hasClass('thz-animate')) {

                    $this.on('thz:animation:done', function(e) {
                        var $get_progress = $(this).find('.thz-circle-progress');
                        thzRunCircleProgress($get_progress);
                    });
                } else {

                    if (typeof($.fn.waypoint) != 'undefined') {

                        $progress.waypoint(function() {
                            this.destroy();
                            thzRunCircleProgress($(this.element));
                        }, {
                            offset: '100%'
                        });

                    } else {

                        thzRunCircleProgress($progress);
                    }

                }

            });

        },

        thzCounters: function() {

            var self = this;

            function thzRunCounter(element) {

                var $duration = element.attr('data-duration');
                var $count_to = element.attr('data-to');
                var $decimals = element.attr('data-decimals');

                element.numerator({
                    easing: 'linear',
                    rounding: $decimals,
                    delimiter: ',',
                    duration: $duration,
                    toValue: $count_to
                });

            }

            $('.thz-counter').each(function() {

                var $this = $(this);
                var $counter = $this.find('.thz-counter-count');

                if ($this.hasClass('thz-animate')) {

                    $this.on('thz:animation:done', function(e) {
                        var $get_counter = $(this).find('.thz-counter-count');
                        thzRunCounter($get_counter);
                    });

                } else {

                    if (typeof($.fn.waypoint) != 'undefined') {

                        $counter.waypoint(function() {
                            this.destroy();
                            thzRunCounter($(this.element));
                        }, {
                            offset: '100%'
                        });

                    } else {

                        thzRunCounter($counter);
                    }

                }

            });

        },

        thzProgressBars: function() {

            var self = this;

            function thzProgress(percent, $element, duration) {
                var progressBarWidth = parseInt(percent) * $element.parent().width() / 100;
                $element.animate({
                    width: progressBarWidth
                }, parseInt(duration));
            }

            $('.thz-progress-bar').each(function(index, element) {

                var $this = $(this);
                var $progress = $this.find('.thz-progress-bar-progress');
				
				if ($this.hasClass('thz-animate')) {
					
                    $this.on('thz:animation:done', function(e) {
                        
						var $Progress = $this.find('.thz-progress-bar-progress');
						var $Percentage = $Progress.data('percentage');
						var $Duration = $Progress.data('duration');
	
						thzProgress($Percentage, $Progress, $Duration);
                    });	
									
				}else{
					
					$this.waypoint(function() {
	
						var $wayThis = $(this.element);
						var $wayProgress = $wayThis.find('.thz-progress-bar-progress');
						var $wayPercentage = $wayProgress.data('percentage');
						var $wayDuration = $wayProgress.data('duration');
	
						thzProgress($wayPercentage, $wayProgress, $wayDuration);
	
						this.destroy();
	
					}, {
						offset: '100%'
					});					
					
				}
				
				


            });

        },

        thzUnfocus: function() {
            var self = this;

            $('.thz-button,.thz-tab-button').on('mouseup', function() {
                $(this).blur();
            });

        },

        thzIconBoxEffects: function() {
            var self = this;

            $('.thz-icon-box').hover(function() {
                $(this).addClass('thz-ib-hover');
                $(this).find('.triggerhover .thz-btn-container').addClass('thz-btn-hover');

            }, function() {
                $(this).removeClass('thz-ib-hover');
                $(this).find('.triggerhover .thz-btn-container').removeClass('thz-btn-hover');
            });

        },
		
		thzButtonShadowEffects: function(){

            var self = this;

            $('.thz-btn-sh-ishidden').mouseenter(function() {
               $(this).addClass('is-shown');

            }).mouseleave(function() {
               $(this).removeClass('is-shown');
            });
			
            $('.thz-btn-sh-hide').mouseenter(function() {
               $(this).addClass('is-hidden');

            }).mouseleave(function() {
               $(this).removeClass('is-hidden');
            });
						
		},

        thzIconEffects: function() {
            var self = this;

            $('.thz-icon-shape-effect').each(function(index, element) {

                var $this = $(this);
                var $trigger = $this.attr('data-trigger');
                var $effect = $this.attr('data-effect');
                var $el = '';
                var $parent = '';

                if ($trigger == 'section') {

                    var $closestparent = '.thz-section-in';

                } else if ($trigger == 'column') {

                    var $closestparent = '.thz-column-in';

                } else if ($trigger.indexOf('trigger') > -1) {

                    var $closestparent = $trigger.replace('trigger', '');

                } else {

                    var $closestparent = '.thz-icon-shape-container';
                }

                $this.closest($closestparent).hover(function() {

                    $(this).find('.thz-icon-shape-' + $effect).addClass('effectactive');
                    $(this).find('.thz-icon-shape-effect').addClass('effectactive');

                }, function() {

                    $(this).find('.thz-icon-shape-' + $effect).removeClass('effectactive');
                    $(this).find('.thz-icon-shape-effect').removeClass('effectactive');
                });

            });

        },
		
		thzSmoothScroll: function() {
			
			var self = this;
			
			if( $('.thz-full-page-row').length < 1 ){
				
				var $px_items 	= '.thz-parallax-scroll,.thz-overlay-fixed,.thz-parallax-over,.thz-media-cpx';
				var $onparallax = thzsite.smoothscroll == 'inactive' ? $($px_items).length > 0 : false;
				
				if( thzsite.smoothscroll == 'active' || $onparallax ){
					ThzSmoothScroll();
				}
			}
		},
		
        thzParallax: function() {

            var self = this;

            if (typeof($.fn.ThzParallax) == 'undefined') {
				return;
			}

            $('.thz-parallax-scroll').ThzParallax();
			
            $('.thz-cpx').ThzParallax({
				size:'custom'
            });
			
            $('.thz-overlay-fixed').ThzParallax({
                direction: 'fixed',
                velocity: 5
            });
			
			$('.thz-media-cpx').ThzParallax();

        },

        thzInfinity: function() {

            var self = this;

            if ( $('.thz-infinity-bg').length == 0 || typeof($.fn.ThzInfinity) == 'undefined'){
				 return;
			}

            $('.thz-infinity-bg').ThzInfinity();

        },

        thzParallaxOver: function() {

            if ($('.thz-parallax-over').length == 0 || typeof($.fn.thz_parallax_over) == 'undefined'){
				 return;
			}

            $('.thz-parallax-over').thz_parallax_over();

        },

        thzScrollFade: function() {

            if( $('.thz-scroll-fade').length == 0 || typeof($.fn.thz_scroll_fade) == 'undefined') {
				return;
			}

            $('.thz-scroll-fade').thz_scroll_fade();

        },


		thzRunAnimationsEffect: function($element){
			
			var self 		= this;
			var $effect 	= $element.data('anim-effect');
			
			$element.addClass('thz-animated ' + $effect);
			
			if($effect == 'thz-anim-draw-svg'){
				var $svg = $element.find('svg'); 
				if($svg.length > 0){
					var $duration 	= parseInt($element.data('anim-duration'));
					var $svg_id 	= $svg.attr('id');
					new Vivus($svg_id, {
					  duration: $duration / 10,
					  pathTimingFunction: Vivus.EASE_OUT, 
					  animTimingFunction: Vivus.LINEAR, 
					});
				}

			}

			$element.one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend',function(e) {
				$element.trigger('thz:animation:done').removeClass('thz-animated thz-animate ' + $effect).addClass('thz-animate-done');
				$element.parents('.thz-animate-parent').addClass('thz-animate-parent-done');
			});	
			
			// Ken Burns
			if( $element.data('anim-kbe') ){

				
				$element
				.removeClass( 'thz-anim-kenburns-'+ $element.data('anim-kbe') )
				.css({
					'animation-duration' : '',
					'-webkit-animation-duration' :  '',
					'-moz-animation-duration' :  '',
					'-o-animation-duration' : ''
				})
				.on('thz:animation:done',function(){
					
					
/*					
					// todo: if out we need to scale up first
					if( $element.css('transform') == 'none' ){
						
						$element.css({
							'animation-duration' : '1s',
							'-webkit-animation-duration' : '1s',
							'-moz-animation-duration' : '1s',
							'-o-animation-duration' :'1s'
						}).addClass( 'thz-anim-kenburns-in' );
						
						$element.one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend',function(e) {
							$element.removeClass( 'thz-anim-kenburns-in' ).css({
								'animation-duration' : parseFloat($element.data('anim-kbd')) + 's',
								'-webkit-animation-duration' : parseFloat($element.data('anim-kbd')) + 's',
								'-moz-animation-duration' : parseFloat($element.data('anim-kbd')) + 's',
								'-o-animation-duration' : parseFloat($element.data('anim-kbd')) + 's'
							}).addClass( 'thz-anim-kenburns-out' );
						});
						
					}else{*/
					
					
						$element.css({
							'animation-duration' : parseFloat($element.data('anim-kbd')) + 's',
							'-webkit-animation-duration' : parseFloat($element.data('anim-kbd')) + 's',
							'-moz-animation-duration' : parseFloat($element.data('anim-kbd')) + 's',
							'-o-animation-duration' : parseFloat($element.data('anim-kbd')) + 's'
						}).addClass( 'thz-anim-kenburns-'+ $element.data('anim-kbe') );
						
						$element.one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend',function(e) {
							$element.trigger('thz:kb:done').css({
								'animation-duration' : '',
								'-webkit-animation-duration' :  '',
								'-moz-animation-duration' :  '',
								'-o-animation-duration' : ''
							});
						});
					//}
				});
					
			}		
		},
		
		
        thzAnimations: function(elements) {

            var self = this;

            var animate = '.thz-animate';

            if (elements) {

                animate = elements;
            }

            var $hasindexed = 0;

            $(animate).each(function(index, element) {

                var $this = $(this),
               		$index = index + 1,
					$horiz =  false;
					
				if($this.parents('.thz-slick-slider').length > 0){
					
					$horiz = $this.parents('.thz-slick-slider').hasClass('slick-vertical') ? false : true;
				}

				new Waypoint({
					element: $this,
					handler: function() {
						
						var $element 	= $(this.element),
						 	$elindex 	= $index,
						 	$delay 		= parseInt($element.data('anim-delay'));

						if (isNaN($delay)) {
							$delay = 100;
						}
						
						$elindex -= $hasindexed;

						if ($elindex == 0 && !$element.parents('.thz-animate-parent').length == 0) {
							$elindex = 1;
						}
						
						if($element.parents('.thz-items-grid').length == 0 && $element.parents('.thz-anim-auto-delay').length == 0) {
							
							$elindex = 1;
						}
						
						ThzSetTimeout(function() {

							self.thzRunAnimationsEffect( $element );
								
							$hasindexed = $index;

						}, $elindex * $delay);

						this.destroy();
					},
					offset: '99%',
					horizontal: $horiz
				});
				
            });

        },

        thzWallpaper: function() {

            if (typeof($.fn.wallpaper) == 'undefined') return;

            $('[data-thz-wallpaper]').each(function(index, element) {

                var $this = $(this);
                var $mute = $(this).attr('data-sound') == 1 ? false : true;
                var $autoPlay = true;
                var $hoverPlay = false;

                $this.wallpaper();

            });

        },

        thzStickyHeader: function() {

            var self = this;

            var stickyHeader = $('.thz-sticky-header');
			
			
			if(stickyHeader.length < 1){
				return;
			}

			
			var $top = self.wpadminbar ? self.wpadminbar : 0;
			
			if($('.thz-body-frame').length > 0){
				
				$top += $('.thz-bf-top').outerHeight();
			}

			var $first_width 		= stickyHeader.outerWidth();
			var $first_height 		= stickyHeader.find('div:first-child').outerHeight();
			var $body_dark 			= $('body').hasClass('thz-brightness-dark');
			var $body_light 		= $('body').hasClass('thz-brightness-light');
			var $body_brightness 	= 'thz-brightness-none';
			var $no_builder			= $('.thz-main .thz-page-builder-content').length < 1;

			if($body_dark){
				
				$body_brightness = 'thz-brightness-dark';
				
			}else if($body_light){
				
				$body_brightness = 'thz-brightness-light';
				
			}

			// always visible sticky			
			if( stickyHeader.hasClass('sticky-show') ){
				
				var maxWidth	= $('.thz-wrapper').outerWidth();
				var $has_repl	= $('.thz-sticky-replacement').length > 0 ? true : false;

				if( $has_repl ){

					stickyHeader.css({
						'position': 'relative',
						'width': maxWidth + 'px',
						'min-height': $first_height + 'px'
	
					});	
									
					$('.thz-sticky-replacement').css({
						'width': maxWidth + 'px',
						'min-height': $first_height + 'px'
					});
				
				}else{
					
					stickyHeader.css({
						'position': 'fixed',
						'top': $top,
						'width': maxWidth + 'px',
						'min-height': $first_height + 'px'
	
					});					
				}
				
				$(window).scroll(function(event) {  
				 
					var scrollTop = $(this).scrollTop();
				
					if ( scrollTop >= $first_height ) {
						
						stickyHeader.addClass('isvisible').removeClass('ishidden');
						$('.thz-site-html').addClass('thz-sticky-moving');
						if( $no_builder	){
							$('body').removeClass('thz-brightness-light thz-brightness-dark thz-brightness-none');
						}
						
					} else {
						
						stickyHeader.removeClass('isvisible').addClass('ishidden');
						$('.thz-site-html').removeClass('thz-sticky-moving');
						if( $no_builder	){
							$('body').addClass($body_brightness);
						}
						
					}
					
				});
				
				$(window).on('resize', function() {
					
					var maxWidth	= $('.thz-wrapper').outerWidth();
					if($has_repl){
						
						stickyHeader.css({
							'width': maxWidth + 'px',
						});
											
					}else{
					
						stickyHeader.css({
							'position': 'fixed',
							'top': $top,
							'width': maxWidth + 'px',
							'min-height': $first_height + 'px'
		
						});
					
					}
				});
				
			}
			
			// hide on scroll sticky	
			function add_replacement ($width,$height){
				
				$('.thz-sticky-replacement').remove();
				
				var $replacement =  $('<div/>',{ class : 'thz-sticky-replacement'});
				
				var $replacement_css = {
					
					'vertical-align': 'baseline',
					'float': 'none',
					'top': $top,
					'width': $width + 'px',
					'height': $height + 'px'					
				
				};
				
				if (stickyHeader.hasClass('header-mode-absolute')){
					
					$replacement_css['position'] = 'absolute';
				}
				
				$replacement.css($replacement_css);
				
				stickyHeader.after($replacement);
			}
			
			

			function ThzShIsvisible(stickyHeader, maxWidth, outerH, diff ) {

				if( !stickyHeader.hasClass('isvisible') ){

					stickyHeader.css({
						'position': 'fixed',
						'top': $top,
						'width': maxWidth + 'px',
						'min-height': $first_height + 'px'
	
					}).addClass('isvisible').removeClass('ishidden');
					
					$('.thz-site-html').addClass('thz-sticky-moving');
					$('body').removeClass($body_brightness + ' thz-brightness-none');
				
				}
			}

			function ThzShIshidden(stickyHeader, maxWidth, outerH,diff ) {

				if( !stickyHeader.hasClass('ishidden') ){

					stickyHeader.css({
						'top': - outerH,
						'width': maxWidth + 'px',
						'min-height': $first_height + 'px'
	
					}).addClass('ishidden').removeClass('isvisible');
					
					$('body').removeClass('thz-brightness-light thz-brightness-dark thz-brightness-none')
					.addClass($body_brightness);
					
					ThzSetTimeout( function (){
					
						$('.thz-site-html:not(.header_centered)').addClass('thz-sticky-moving');
						
					},590);
				
				}
				
			}

			function ThzShIsreset(stickyHeader) {
				stickyHeader
					.removeClass('isvisible ishidden')
					.removeAttr('style');
				$('.thz-site-html').removeClass('thz-sticky-moving');
				
				$('body').removeClass('thz-brightness-light thz-brightness-dark thz-brightness-none')
				.addClass($body_brightness);
				
			}	
			
			if( stickyHeader.hasClass('sticky-hide') ){
				
				add_replacement ($first_width,$first_height);

				var prevScrollTop = 0;
				
				$(window).scroll(function(event) {
	
					var maxWidth	= $('.thz-wrapper').outerWidth();
					var diff 		= self.thzBodyContainerWidth( true ).difference;
					var outerH 		= stickyHeader.outerHeight();
					var stickywait 	= stickyHeader.hasClass('sticky-wait');
					var stickyearly = stickyHeader.hasClass('sticky-early');
					var scrollTop 	= $(this).scrollTop();
					var startAt		= outerH * 4;
					var lessThan	= 0;
					
					if($('.hero-location-above').length > 0){
						startAt	 = 0;
						lessThan = $('.hero-location-above').outerHeight();
					}
				   
					if ( scrollTop < lessThan ) {
						scrollTop = 0;
					}
					if (scrollTop > $('body').height() - $(window).height()) {
						scrollTop = $('body').height() - $(window).height();
					}
	
					if ( stickyearly && scrollTop < outerH ) {
						ThzShIsreset(stickyHeader);
						return;
					}
					
					if (scrollTop >= prevScrollTop && scrollTop) {
						// scrolling down
	
						if (stickywait && scrollTop > startAt) {
							 
							ThzShIshidden(stickyHeader, maxWidth, outerH, diff);
	
						} else if ( !stickywait ) {
							
							ThzShIshidden(stickyHeader, maxWidth, outerH, diff);
	
						}
	
					} else if ( scrollTop !== 0 && self.scrollTrigger != 'thz:scroll' ) {
						// scrolling up
	
						if (stickywait && scrollTop > startAt) {
	
							ThzShIsvisible(stickyHeader, maxWidth, outerH, diff);
	
						} else if (!stickywait) {
	
							ThzShIsvisible(stickyHeader, maxWidth, outerH, diff);
						}
	
					} else {
	
						ThzShIsreset(stickyHeader);
	
					}
	
					prevScrollTop = scrollTop;
				});
				
				$(window).on('resize', function() {
					
					 ThzShIsreset(stickyHeader);
				});
			
			}
        },
		
		thzStickyElement: function (){
			
			var self = this;
			
			if ($('.thz-sticky-element').length) {
				
				$('.thz-sticky-element').each(function(index, element) {
					
					var $this = $(this);
	
					if ( $(window).width() < 980 ) {
						$this.trigger("sticky_kit:detach");
						return;
					}
					
					var $offset = $this.attr('data-offset') ? parseInt($this.attr('data-offset')) : 60; 
					
					$this.stick_in_parent({
						offset_top:$offset,
						inner_scrolling: false
					});
					
				});
			}
			
			if ($('.thz-sidebars').length) {
				$('.thz-sticky-sidebar-right #rightblock .thz-sidebars,.thz-sticky-sidebar-left #leftblock .thz-sidebars').each(function(index, element) {
					
					var $this = $(this);
					
					if ( $(window).width() < 980 ) {
						$this.trigger("sticky_kit:detach");
						return;
					}
					
					var $adminbar 	= self.wpadminbar ? self.wpadminbar : 0;
					var $offset 	= parseInt($this.closest('.thz-block-spacer').css('padding-top')) + $adminbar; 
					
					$this.stick_in_parent({
						offset_top:$offset,
						parent:'.thz-main',
						inner_scrolling: false
					});
					
				});
			}
			
			var offsetAuto = function($el, $inner_column){
				
				var $adminbar 	= self.wpadminbar ? self.wpadminbar : 0;
				if($inner_column){
				
					var $offset		= parseInt($el.parents('.thz-section').css('padding-top'));
						$offset 	= $offset == 0 ? $el.closest('.thz-column-in').css('padding-top') : $offset;
					
					return parseInt($offset);
				
				}else{
					
					return parseInt($adminbar);
				}
			};
			
			if ($('.thz-sticky-column').length) {
				$('.thz-sticky-column').each(function(index, element) {
					
					var $this = $(this);
					
					if ( $(window).width() > 980 && $this.hasClass('thz-sticky-desktop-disable')	) {
						
						$this.trigger("sticky_kit:detach");
						return;
						
					} else if ( ( $(window).width() > 768 && $(window).width() < 980) && $this.hasClass('thz-sticky-tablet-disable')) {
						
						$this.trigger("sticky_kit:detach");
						return;
									
					}else if( $(window).width() < 768 && $this.hasClass('thz-sticky-mobile-disable')){
						
						$this.trigger("sticky_kit:detach");
						return;
					}
					
					var $offset = $this.attr('data-sticky-offset'); 
					var	$bottoming	= $this.attr('data-sticky-bottoming') == 'yes' ? true : false;
					var $innner_column = $this.parent().parent().hasClass('thz-column-shortcodes') ? true : false;
	
					if($innner_column){
						
						$offset = $offset =='auto' ? offsetAuto($this,true) : parseInt($offset);
						
						$this.stick_in_parent({
							offset_top:$offset,
							inner_scrolling: false,
							parent:'.thz-section-holder',
							bottoming:$bottoming,
						}).on('sticky_kit:bottom', function(e) {
							$(this).parent().parent().css({
								'position':'static',
							});
						})
						.on('sticky_kit:unbottom', function(e) {
							$(this).parent().parent().css({
								'position':'relative',
							});
						});
						
					}else{
						
						$offset = $offset =='auto' ? offsetAuto($this,false) : parseInt($offset);
						
						$this.stick_in_parent({
							offset_top:$offset,
							inner_scrolling: false,
							bottoming:$bottoming,
						});
	
					}
					
				});	
			}
			

					
		},
		
		
        thzSticky: function() {



            var self = this;

			self.thzStickyElement();
            self.thzStickyHeader();
			self.thzSectionsScrollTo();
			
			function elTopMargin ($el, $hide){
				
				var $ul_height = $el.show().find('.thz-dot-nav').outerHeight();
				if($hide){
					$el.hide();
				}
				var topmargin = ( $(window).height() / 2 ) - ( $ul_height / 2 );
				
				return topmargin;
			}

			if (  $(".thz-dot-navigation").length > 0 ){
			
				$(window).on('scroll', function() {
					
					var fromTop = $(this).scrollTop();
					var wHeight = $(this).height();
					var wHeightH = wHeight / 2;
					
					$(".thz-dot-navigation .thz-scroll").each(function(index, element) {
						
						var $link 	= $(this);
						var $hash	= this.hash;
						var $parent = $link.parents('.thz-dot-navigation');
						var $target = $($hash);
						var $pclass = $hash.replace('#','') + '-isactive';
						
						if (  $($target).length > 0 ){
							
							if ( ( $target.offset().top - wHeightH < fromTop ) && ( $target.offset().top + $target.height() - wHeightH > fromTop ) ) {
								$link.addClass("active-scroll");
								$parent.addClass($pclass);
							}else {
								$link.removeClass("active-scroll");
								$parent.removeClass($pclass);
							}
						}
	
					});
					
				});
			}
			
			
            $('.thz-dot-navigation').each(function(index, element) {

                var el = $(this),
                    effect = el.data('effect'),
                    hide = el.data('hide'),
                    position = el.data('position'),
                    appear = el.data('appear'),
                    active = false,
                    width = el.parent().outerWidth();

                if (hide == 'yes') {
                    el.addClass('fixed');
                }

				if (effect == 'fade') {
                   el.fadeIn(400);
                }
				
				if (position == 'centered') {
					
					el.css('margin-top', elTopMargin(el,true));
					
				}else if (parseInt(position) > 0 || position == 'auto' ) {

                    el.css('top', position);
                }
		
				$(window).on("resize", function(e) {
					if (position == 'centered') {
						
						el.css('margin-top', elTopMargin(el,false));
					}					
				 });

                $(document).on("scroll", function(evt) {

                    if ($(window).scrollTop() >= appear) {

                        el.addClass('fixed');

                        if (effect == 'slide') {
                            el.slideDown(400);
                        }
                        if (effect == 'fade') {
                            el.fadeIn(400);
                        }

                        active = true;
						

                    } else if (active) {

                        if (effect == 'slide') {
                            el.stop(true).slideUp(300, function(e) {

                                el.removeClass('fixed');
                                if (hide == 'no') {
                                    el.removeAttr('style');
                                }
                            });
                        }
                        if (effect == 'fade') {

                            el.stop(true).fadeOut(300, function(e) {

                                el.removeClass('fixed');

                                if (hide == 'no') {
                                    el.removeAttr('style');
                                }

                            });
                        }

                        active = false;

                    }

                });


				
				if ($(window).scrollTop() >= appear) {
					$(document).trigger('scroll');
				};
				
            });

        },

		thzSectionsScrollTo: function (){
			
			var self = this;
			var $scrollList = $('.thz-sections-scroll');
			
			
			if (  $scrollList.length < 1 ){
				return;
			}
			

			var $addh 			= $scrollList.attr('data-add-h');
			var $addf 			= $scrollList.attr('data-add-f');
			var $fpr 			= $('.thz-full-page-row');
			var $scrollspeed 	= $fpr.length > 0 ? parseInt($('body').attr('data-fpr-speed')) : 800;
			var $slabel			= 'data-slabel';
			
			
			if($addh && $addh !=''){
				$('.thz-hero-section').attr($slabel,$addh)
				.addClass('not-fpr');				
			}
			
			if($addf && $addf !=''){
				if($('.thz-footer-reveal').length > 0){
					
					$('.thz-footer-reveal').attr($slabel,$addf)
					.addClass('not-fpr');
					
				}else{
					
					$('.thz-footer-sections-holder').attr('id','footer-holder')
					.attr($slabel,$addf)
					.addClass('not-fpr');
				}				
			}

			
			var $links_list = [];
			
			$('['+$slabel+']').each(function(index, element) {
				
				var $this		= $(this);
				
				if( $this.parents('['+$slabel+']').length < 1 ){ 
				
					var $label 		= $this.attr($slabel);
					var $link 		= $this.attr('id');
					var $fpr_link	= $this.attr('data-fpr-link');
					var $fpr_class	= $fpr_link ? ' thz-fpr-link' : '';
					var $class 		= 'thz-dot-nav-item thz-scroll' + $fpr_class;

				   $links_list.push({
					  label: $label,
					  link : $link,
					  class: $class,
					  fprlink: $fpr_link
				   });	
				
				}

			});
			
			$.each($links_list,function(index, element) {

				var $label 		= element.label; 
				var $link 		= element.link;
				var $class 		= element.class;
				var $fprlink 	= element.fprlink;
				var $olink	 	= $link.replace('-fpr','');
				var $samelink 	= $("[href*=#" + $olink + "]");
				
				if( $samelink.length > 0 ){
					
					$samelink.addClass($class)
					.attr('data-before', 0)
					.attr('data-duration', $scrollspeed)
					.attr('data-label', $label);
					
					if($fprlink){
						$samelink.attr('data-fprlink', $fprlink);
					}
				}

				var $li = $('<li/>').appendTo($scrollList);
				var $el = $('<a/>');
				var $a = $el
					.addClass($class)
					.attr('data-before', 0)
					.attr('data-duration', $scrollspeed)
					.attr('data-label', $label)
					.attr('href', '#'+$link)
					.appendTo($li);	
					
				if($fprlink){
					$a.attr('data-fprlink', $fprlink)
				}
				var $span = $('<span/>')
					.addClass('indicator')
					.appendTo($a);	
					
				var $tip = $('<span/>')	
					.addClass('thz-dot-nav-tip')
					.html($label)
					.appendTo($a);		
			
				if($label == ''){
					
					$span.removeAttr('title');
				}				
			});
			
		},

		thFullPageReplayAnim: function(replay, scrollSpeed, current, prev, next, direction){
			
			var self 			= this;
			var $prev_panel		= direction == 'scrollingdown' ? prev : next;
			
			if(replay =='replay' && $prev_panel.length > 0 ){
				current.find('[data-anim-effect]').addClass('thz-animate')
				.removeClass('thz-anim-draw-svg');
				current.find('.thz-cpx,.thz-parallax-scroll').css({
					'transform': ''	
				});
				ThzSetTimeout(function (){
					self.thzAnimations(current.find('.thz-animate'));
				},scrollSpeed + 1 );
			}	
					
		},
		
		thFullPageDirection: function(i){
			
			var self 			= this;
			
			var direction,preIndex;
				
			preIndex = parseInt($('body').attr('data-preIndex'));
				
			if ( i > preIndex){
				
				direction = "scrollingdown";
				
			}else{
				
				direction = "scrollingup";
				
			}	
			
			return direction;
					
		},
		
		thzFullPageRows: function() {
			
			var self 			= this;
			var $rows			= $('.thz-full-page-row');

			if ( $rows.length > 0 && $.scrollify ) {
				
				$('.thz-footer-sections-holder .thz-fp-excluded').removeClass('thz-fp-excluded');
				$('.thz-footer-sections-holder,.header_holder:not(.header-mode-absolute):not(.header-lateral),.thz-mobile-menu-holder:visible').addClass('thz-fp-excluded');
				
				var $animation 		= $('body').attr('data-fpr-animation');
				var $scrollSpeed 	= parseInt($('body').attr('data-fpr-speed'));
				var $easing 		= $('body').attr('data-fpr-easing');
				var $scrollbars 	= $('.header-lateral').length > 0 ? false : $('body').attr('data-fpr-scrollbars');
				var $overflow 		= $('body').attr('data-fpr-overflow');
				var $updateHash 	= $('body').attr('data-fpr-hash');
				var $replayAnim 	= $('body').attr('data-fpr-replay');
				
				$.scrollify({
					section : '.thz-page-builder-content > .thz-full-page-row',
					sectionName: 'fpr-link',
					easing: $easing,
					interstitialSection : ".thz-fp-excluded",
					scrollSpeed: $scrollSpeed,
					offset : self.wpadminbar ? - self.wpadminbar : 0, // adminbar
					overflowScroll: $overflow =='enable' ? true : false,
					updateHash: $updateHash =='enable' ? true : false,
					touchScroll:true,
					scrollbars: $scrollbars =='hide' ? false : true,
					setHeights: $scrollbars =='hide' ? true : false,
					standardScrollElements: ".thz-map",
    				afterRender:function(){
					
               		 	$('body').attr('data-preIndex',$.scrollify.currentIndex());

               		},
					
					before:function(i) {
					
              			var direction = self.thFullPageDirection(i);	
						var preIndex = parseInt($('body').attr('data-preIndex'));	
						
						$('body').attr('data-preIndex',i).removeClass('scrollingup scrollingdown')
						.addClass(direction);
						
						var $current 	= $.scrollify.current();	
						var $prev  		= $.scrollify.current().prev('.thz-full-page-row');
						var $next  		= $.scrollify.current().next('.thz-full-page-row');
						
						$current.addClass('current-fpr');
								
						if($animation !='none' && !$current.hasClass('thz-fp-excluded')){
							
							if( $animation == 'thz-OutScalePauseOut' ){
								
								if ( $('.thz-mobile-menu-holder').is(":visible") ){
									
									$('.thz-mobile-menu-holder').addClass('thz-fp-excluded');
									
									preIndex -= 1;
									
								}else{
									
									$('.thz-mobile-menu-holder').removeClass('thz-fp-excluded');
									
								}

								var $elm = $($('.thz-full-page-row')[preIndex]);
								
								if( $elm.length > 0 ){
									
									var $prev_panel	= direction == 'scrollingdown' ? $prev : $next;
									var $delay 		= $prev_panel.length == 0 ? 0 : $scrollSpeed;
						
									$.scrollify.setOptions({
										'scrollSpeed':$scrollSpeed,
										'delay':$delay
									});	
									
									$elm.find('.thz-full-page-row-in').css({
										'transition-duration' : $scrollSpeed + 'ms',
									}).addClass('thz-anim-outs ' + $animation);
									
								
								}else{
									
									$.scrollify.setOptions({
										'scrollSpeed':400,
										'delay':0
									});
								}


							}else{
								
								var acss = {
									'transition-duration' : $scrollSpeed + 'ms',
									'z-index' : 0
								};
								
								if( $animation == 'thz-OutParallaxOut' ){
									
									acss = {
										'animation-duration' : $scrollSpeed + 'ms',
										'animation-delay' : $scrollSpeed * 0.2 + 'ms',
										'animation-timing-function' :'ease-in-out, steps(20, start), cubic-bezier(0.65, 0.05, 0.36, 1)',
										'z-index' : 0
									};

								}
								
								if(direction =='scrollingdown'){
									
									$prev.find('.thz-full-page-row-in').addClass('prev thz-anim-outs ' + $animation ).css(acss);
									
								}else{
									
									$next.find('.thz-full-page-row-in').addClass('next thz-anim-outs ' + $animation ).css(acss);
								}
							
							}

						}
						
						self.thFullPageReplayAnim( $replayAnim, $scrollSpeed, $current, $prev, $next ,direction );
						
					},
					after:function(i,s) {

              			var direction 	= self.thFullPageDirection(i);						
						var $current 	= $.scrollify.current();	
						var $prev  		= $.scrollify.current().prev('.thz-full-page-row');
						var $next  		= $.scrollify.current().next('.thz-full-page-row');
												
						$current.removeClass('current-fpr');
						
						var $prev_panel	= direction == 'scrollingdown' ? $prev : $next ;
						
						if( $prev_panel.length > 0 ){
							
							var $c_section = $.scrollify.current().find('[data-view-brightness]')[0];
							
							self.thzSetViewBrightness($($c_section));
									
						}
						
						if($animation !='none'){
							
							$('.thz-full-page-row-in').removeClass('prev next thz-anim-outs ' + $animation ).css({
								'animation-duration' :'',
								'animation-timing-function' : '',
								'transition-duration' :'',
								'z-index' :''
							});

						}
					}
					
				});	
              
								
				$('a.thz-fpr-link').each(function(index, element) {
					$(this).on('click',function(e){
						
						var $fprlink = $(this).attr('data-fprlink');
						$.scrollify.move('#'+ ($fprlink));

					});                
				});

			}
		},		

		thzMagnificMainClass: function($el, $modalsize){
			
			var self = this;
			
			var $modal_bg 	= $el.attr('data-bg') ? $el.attr('data-bg') + ' ' : thzsite.lightbox_style + ' ';
			var $opacity 	= $el.attr('data-opacity') ? $el.attr('data-opacity') + ' ' : thzsite.lightbox_opacity + ' ';
			var $effect 	= $el.attr('data-effect') ? $el.attr('data-effect') + ' ' : thzsite.lightbox_effect + ' ';
			
			if( !$modalsize ){
				var $modalsize 	= $el.attr('data-modal-size') ? 'thz-popup-box-' + $el.attr('data-modal-size') : '';
			}
			
			return $modal_bg + $opacity + $effect + $modalsize;
		},
		
		thzMagnificIframeExtend: function ($counter){
			
			var self 	= this;
			var $start 	= 0;
			
			var $markup ='<div class="mfp-iframe-scaler">';
				$markup +='<div class="mfp-close"></div>';
				$markup +='<iframe class="mfp-iframe" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
				$markup +='</div>';
				$markup +='<div class="mfp-bottom-bar">';
				$markup +='<div class="mfp-title"></div>';
				
				if( $counter ){
					$markup +='<div class="mfp-counter"></div>';
				}
				
				$markup +='</div>';
			
			var $iframe = {
				markup: $markup ,
					patterns: {
						youtube: {
							index: 'youtu', 
							id: function(url) {   
								 
								var m = url.match( /^.*(?:youtu.be\/|v\/|e\/|u\/\w+\/|embed\/|v=)([^#\&\?]*).*/ );
								if ( !m || !m[1] ) return null;
								
									if(url.indexOf('t=') != - 1){
										
										var $split = url.split('t=');
										var hms = $split[1].replace('h',':').replace('m',':').replace('s','');
										var a = hms.split(':');
										
										if (a.length == 1){
											
											$start = a[0]; 
										
										} else if (a.length == 2){
											
											$start = (+a[0]) * 60 + (+a[1]); 
											
										} else if (a.length == 3){
											
											$start = (+a[0]) * 60 * 60 + (+a[1]) * 60 + (+a[2]); 
											
										}
									}									
									
									var suffix = '?autoplay=1';
									
									if( $start > 0 ){
										
										suffix = '?start=' + $start + '&autoplay=1';
									}
								
								return m[1] + suffix;
							},
							src: 'https://www.youtube.com/embed/%id%'
						},
						vimeo: {
							index: 'vimeo.com/', 
							id: function(url) {        
								var m = url.match(/(https?:\/\/)?(www.)?(player.)?vimeo.com\/([a-z]*\/)*([0-9]{6,11})[?]?.*/);
								if ( !m || !m[5] ) return null;
									
								var suffix;
								if(url.indexOf('#t=') != - 1){
									var $split = url.split('#t=');
									suffix = '#t='+$split[1].replace('?api=1&autoplay=1','');
								}	
																
								var id = m[5] + '?autoplay=1'+ suffix;
								return id;
							},
							src: 'https://player.vimeo.com/video/%id%'
						}
					}
                };
				
			return $iframe;		
			
		},
		
		
        thzMagnific: function() {

            var self = this;

            if (typeof($.fn.magnificPopup) == 'undefined') return;

            $('.thz-lightbox').magnificPopup({
                removalDelay: 500,
				type:'inline',
                callbacks: {
                    beforeOpen: function() {
						
						var $link 	= $(this.st.el).attr('href');
						
						if($link.indexOf('#') != -1 ){	
										
							if($($link).length > 0){
								
								var $thz_media = $($link).find('.thz-media');
								if($thz_media.length > 0){
									
									ThzSetTimeout(function() {
										$thz_media.trigger('resize');
									}, 50);	
								}
								
								var $player = $($link).find('.thz-media-mfp');
								
								if($player.length > 0){
									
									ThzSetTimeout(function() {
			
										if (!$player.hasClass('mejs-container') && typeof mejs != 'undefined') {
											$player.mediaelementplayer({
												success: function(player, node) {
													player.play();
												}
											}).bind('ended pause',function () { 
												$(this).parents('.mejs-inner').find('.mejs-poster').show(); 
											});
			
										}
										
									}, 50);	
								
								}
							}
						}
			
						var bgclickoff = this.st.el.attr('data-bgclickoff');
						
						if(bgclickoff == 1){
							this.st.closeOnBgClick = false;
						}

                        this.st.mainClass = self.thzMagnificMainClass( this.st.el );
                        this.st.image.titleSrc = 'data-mfp-title';

						var $iframe_markup = $(this.st.iframe.markup);
						$iframe_markup.find('.mfp-title').text($(this.st.el).attr('data-mfp-title'));
						this.st.iframe.markup = $iframe_markup;						
                    },
					
					elementParse: function(item) {

						if (item.type == 'inline') {

							var $title = $(item.el).attr('data-mfp-title');
							$title = $title == undefined ? '': $title;
							var $addtitle = '<div class="mfp-bottom-bar">' +
								'<div class="mfp-title">' + $title + '</div>' +
								'</div>';
							$(item.src).append($addtitle);
						}
					},	
                },
                image: {
                    markup: '<div class="mfp-figure">' +
                        '<div class="mfp-close"></div>' +
                        '<div class="mfp-img"></div>' +
                        '</div>' +
                        '<div class="mfp-bottom-bar">' +
                        '<div class="mfp-title"></div>' +
                        '</div>'
                },
                iframe: self.thzMagnificIframeExtend() ,			
                markupParse: function(template, values, item) {

                    if (item.el.attr('data-mfp-title')) {
                        values.title = item.el.attr('data-mfp-title');
                    } else {
                        values.title = '';
                    }
                },

                midClick: true,
				autoFocusLast: false

            });

            $('.thz-lightbox-ajax').magnificPopup({
                type: 'ajax',
                // alignTop: false,
                removalDelay: 500,
                callbacks: {
                    beforeOpen: function() {

                        this.st.mainClass = self.thzMagnificMainClass( this.st.el );
                    }
                },
                overflowY: 'scroll',
				autoFocusLast: false

            });

            $('.thz-lightbox-iframe').magnificPopup({
                disableOn: 400,
                type: 'iframe',
                removalDelay: 500,
                mainClass: 'mfp-fade',
                iframe: self.thzMagnificIframeExtend(),
                callbacks: {
                    beforeOpen: function() {

                        this.st.mainClass = self.thzMagnificMainClass( this.st.el );
                    },
                    markupParse: function(template, values, item) {
                        if (item.el.attr('data-mfp-title')) {
                            values.title = item.el.attr('data-mfp-title');
                        } else {
                            values.title = '';
                        }
                    }
                },
                preloader: true,
                fixedContentPos: false,
				autoFocusLast: false
            });
			
			
            $('.thz-lightbox-gallery,.thz-lightbox-gallery-simple,.thz-lightbox-single').each(function() {

                var $lightbox = $(this);
                var $mfpslider = false;
                var $mfphasslider = '';
                var $closeOnContent = true;
				var $closeOnBg = true;
                var $galleryitems = $(this).find("a[class*='thz-lightbox']:not(.mfp-cloned)");
				
                var $total 		= $galleryitems.length;
                var lastItem 	= $galleryitems.last();
				var $clones 	= $lightbox.find("a.mfp-cloned:not(.thz-lightbox)");
				

				$clones.each(function(ci, cel) {
					
					var $this 		= $(this);
					var $trigger 	= $this.attr('data-mfp-src') ? 'data-mfp-src' : 'data-mfp-poster';
					var $src 		= $this.attr($trigger);
					var $original	= $lightbox.find("a["+$trigger+"='" + $src  + "']:not(.mfp-cloned)");
					
					$this.off('click').on('click',function(e){
						e.preventDefault();
						$($original[0]).trigger('click');
					});
					
				});
				
				
                if ($(lastItem).parents('.thz-grid-item-intro').length > 0) {

                    var reorder = [];

                    $lightbox.find(".thz-grid-item").each(function(index, element) {

                        var $trigger = $(element).find(".thz-grid-item-intro a[class*='thz-lightbox']:not(.mfp-cloned)");

                        $trigger.each(function(i, t) {
                            reorder.push(t);
                        });

                        var $others = $(element).find(".thz-grid-item-media a[class*='thz-lightbox']:not(.mfp-cloned)");

                        $others.each(function(i, o) {
                            reorder.push(o);
                        });

                    });

                    if (reorder.length > 0) {
                        $galleryitems = $(reorder);
                    }


                }


                if ($lightbox.hasClass('thz-mfp-show-slider') && $total > 1) {
                    $mfpslider = true;
				    $closeOnContent = false;
					$closeOnBg = false;
                    $mfphasslider = 'thz-mfp-has-slider ';
                }
				
				if ($lightbox.hasClass('thz-lightbox-single')) {
					
                    $closeOnContent = false;					
				}

                $galleryitems.magnificPopup({
                    type: 'image',
                    gallery: {
                        enabled: true,
                        navigateByImgClick: true,
                    },
                    removalDelay: 500,
                    callbacks: {


                        open: function() {

						  $.magnificPopup.instance.close = function() {
							var $trigger = $.magnificPopup.instance.st.el;
							
							$trigger.parents('.thz-slick-active').trigger('magnific:closed');
		
							// Call the original close method to close the popup
							$.magnificPopup.proto.close.call(this);
						  };
	  
                            var $player = $(this.contentContainer).find('.thz-media-mfp');

                            if (!$player.hasClass('mejs-container') && typeof mejs != 'undefined') {
                                $player.mediaelementplayer({
                                    success: function(player, node) {
                                        player.play();
                                    }
                                }).bind('ended pause',function () { 
									$(this).parents('.mejs-inner').find('.mejs-poster').show(); 
								});

                            }

                            var $oembed = $(this.contentContainer).find('.thz-media-oembed');
                            if ($oembed.length > 0 && !$oembed.hasClass('thz-oembed-loaded')) {
                                self.thzOembed($oembed);
                            }

                        },
                        change: function() {

                            if (this.isOpen) {

                                var $instance = this;
                                $instance.wrap.addClass('mfp-gallery-anim');
                                var $type = this.currItem.type;

                                var $player = $($instance.contentContainer).find('.thz-media-mfp');


                                if ($player.length > 0) {

                                    if (!$player.hasClass('mejs-container') && typeof mejs != 'undefined') {
                                        $player.mediaelementplayer({
                                            success: function(player, node) {
                                                player.play();
                                            }
										}).bind('ended pause',function () { 
											$(this).parents('.mejs-inner').find('.mejs-poster').show(); 
										});
                                    }

                                    ThzSetTimeout(function() {
                                        $player.trigger('resize');
                                    }, 50);


                                }

                                var $oembed = $($instance.contentContainer).find('.thz-media-oembed');
                                $('.thz-media-oembed').removeClass('thz-oembed-loaded').html('');

                                if ($oembed.length > 0) {
                                    ThzSetTimeout(function() {
                                        self.thzOembed($oembed);
                                    }, 50);
                                }

                                if ($mfpslider) {

                                    $('.thz-lightbox-slick').slick('setPosition');
                                    var slideIndex = this.index;
                                    ThzSetTimeout(function() {

                                        var $active_slide = '';

                                        if (i == slideIndex) {
                                            $active_slide = ' thz-mfp-active';
                                        }

                                        $('.thz-lightbox-slick .thz-slick-slide').removeClass('thz-mfp-active');
                                        $('.thz-lightbox-slick .thz-slick-slide').eq(slideIndex).addClass('thz-mfp-active');
                                        $('.thz-lightbox-slick').slick('slickGoTo', parseInt(slideIndex));
                                        $('.thz-lightbox-slick').trigger('afterChange');

                                    }, 100);
                                }



                            }

                        },


                        beforeOpen: function() {

                            if ($mfpslider) {
                                $(this.container).addClass($mfphasslider);
                                self.thzLightboxSlider();
                            }

                            var $modalsize 	= this.st.el.attr('data-modal-size') ? 'thz-popup-box-' + this.st.el.attr('data-modal-size') : '';
                            var $items = this.st.items;

                            $items.each(function(index, element) {

                                var $this = $(this);
                                if ($this.hasClass('mfp-inline')) {
                                    $modalsize = 'thz-popup-box-' + $this.attr('data-modal-size');
                                }

                            });

							this.st.mainClass = self.thzMagnificMainClass( this.st.el, $modalsize);
							
							if ($lightbox.hasClass('thz-lightbox-single')) {
								
								this.st.mainClass +=' thz-lightbox-single';
							}

                        },

                        beforeClose: function() {

                            $('.thz-mfp-slick').addClass('thz-mfp-slick-fade-out');
                            $(".thz-items-display-directional .thz-grid-item-intro-holder").removeAttr('style');
                            $(".thz-items-display-thzhover .thz-grid-item-intro-holder").removeAttr('style');
							

                        },


                        close: function() {

							ThzSetTimeout(function(){
								 
								 $('.thz-media-oembed').removeClass('thz-oembed-loaded').html('');
								 
							},501);
                           
                        },

                        elementParse: function(item) {

                            if (item.type == 'inline') {

                                var $fixindex = item.index + 1;
                                var $title = $(item.el).attr('data-mfp-title');
								$title = $title == undefined ? '': $title;
                                var $addtitle = '<div class="mfp-bottom-bar">' +
                                    '<div class="mfp-title">' + $title + '</div>' +
                                    '<div class="mfp-counter">' +
                                    '<span class="mfpcurrent">' + ($fixindex) + '</span/> of ' +
                                    '<span class="mfptotal">' + ($total) + '</span/>' +
                                    '</div>' +
                                    '</div>';

                                if ($(item.src).find('.mfp-bottom-bar').length == 0) {
                                    $(item.src).append($addtitle);
                                }

                            }

                        },
                        markupParse: function(template, values, item) {

                            if (item.el.attr('data-mfp-title')) {
                                values.title = item.el.attr('data-mfp-title');
                            } else {
                                values.title = '';
                            }

                        }
                    },

                    image: {
                        markup: '<div class="mfp-figure">' +
                            '<div class="mfp-close"></div>' +
                            '<div class="mfp-img"></div>' +
                            '</div>' +
                            '<div class="mfp-bottom-bar">' +
                            '<div class="mfp-title"></div>' +
                            '<div class="mfp-counter"></div>' +
                            '</div>'
                    },
                    iframe: self.thzMagnificIframeExtend(true),

                    closeOnContentClick: $closeOnContent,
                    closeOnBgClick: $closeOnBg,
                    midClick: true,
					autoFocusLast: false

                }).removeClass(':focus');
            });
			
			
			self.thzLightboxTrigger();

        },
		
		
		thzIsImage: function (uri){
			
			var self = this;
			
			uri = uri.split('?')[0];
			var parts = uri.split('.');
			var extension = parts[parts.length-1];
			var imageTypes = ['jpg','jpeg','tiff','png','gif','bmp'];
			
			if(imageTypes.indexOf(extension) !== -1) {
				return true;   
			}			
			
		},
		
		thzLightboxTrigger: function(){
			
			var self = this;
			
			$('.thz-trigger-lightbox').each(function(index, element) {
			
				var $this 		= $(element);
				var $lightbox 	= $this.attr('href');
				var $mfp_type	= self.thzIsImage( $lightbox ) ? 'mfp-image': 'mfp-iframe';

				
				if( $lightbox.indexOf('http') !== -1 ){
					
					if( $lightbox.indexOf('#') !== -1 ){
						
						$lightbox = $lightbox.replace('#','');
						
						$this.attr('href',$lightbox);
						
					}
					
					$this.addClass('thz-lightbox ' + $mfp_type );
					
				}else{
					
					$this.on('click', function(e) {

						var $found_sect	= $($lightbox).length && $($lightbox).hasClass('thz-open-in-lightbox');
						var $found_mfp	= $($lightbox).length && $($lightbox).is("a");
						var $found_gal	= $($lightbox).length && $($lightbox).hasClass('thz-lightbox-gallery');
						
						
						// section
						if ( $found_sect ) {
							
						  $.magnificPopup.open({
							  items: {
								  src: $lightbox
							  },
							  type: 'inline',
							  removalDelay: 500,
							  midClick: true,
							  autoFocusLast: false,
							  closeOnContentClick: false,
							  closeOnBgClick: true,
							  callbacks: {
								beforeOpen: function() {
								  this.st.mainClass = 'thz-page-builder-content ' + self.thzMagnificMainClass( $($lightbox) );
								},
								open: function() {
									$(document).trigger('thz:lightbox:section:opened');
								}
							  },
						  });
							
						// hidden lightbox
						} else if ( $found_mfp ) {
						
							$($lightbox).trigger('click');
						
						// hidden gallery
						} else if ( $found_gal ) {
						
							$($lightbox).find('a').eq(0).trigger('click');
						
						// basic lightbox
						} else {
						
							$('a.thz-lightbox[href=' + $lightbox + ']').trigger('click');
						}
					});	
				}
			});
			
			self.thzMagnificSectionRefresh();
			
		},
		
		thzMagnificSectionRefresh: function(){
			
			var self = this;
			  
			$(document).on('thz:lightbox:section:opened',function(e){
				
				// reset map in lightbox
				if($('.mfp-content .fw-map-canvas').length > 0){
				
					$('.mfp-content .fw-map-canvas').css({
						'transform' :'scale(1.1)'	
					});
					
					ThzSetTimeout(function(){
						 
						$('.mfp-content .fw-map-canvas').css({
							'transform' :''	
						});
						 
					},301);
				}
				
			});			
			
		},
		
        thzLightboxSlider: function() {

            var self = this;
            var $mfpslick = '';

            $(document).on('click', '.mfp-container', function(e) {

                if ($(e.target).parents('.thz-mfp-slick,.thz-modal-box,.thz-popup-box').length == 0 &&
                    !$(e.target).is('.mfp-arrow,.thz-modal-box,.thz-popup-box')) {
                    var $magn = $.magnificPopup.instance;
                    $magn.close();
                }

            });

            var $gallery = $.magnificPopup.instance;
            var slideIndex = $gallery.index;

            $mfpslick = '<div class="mfp-slick-holder">';
            $mfpslick += '<div class="thz-mfp-slick">';
            $mfpslick += '<div class="thz-slick-holder thz-slick-show-multiple">';
            $mfpslick += '<div class="thz-slick-slider thz-lightbox-slick"';
            $mfpslick += ' data-space="10" data-speed="300" data-dots="hide" data-arrows="show" data-autoplay="0" ';
            $mfpslick += 'data-autoplaySpeed="3000" data-fade="0" data-slidesToShow="1" data-slidesToScroll="1" data-infinite="0"';
            $mfpslick += '>';



            $($gallery.items).each(function(i, element) {


                var $thumb = $(element).attr('data-mfp-src');
                var $poster = $(element).attr('data-mfp-poster');

                if ($poster) {
                    $thumb = $poster;
                }

                var $bg = ' style="background-image:url(' + $thumb + ');';
                var $active_slide = '';
                var $typeclass = ' thz-mfp-img';

                if ($(element).is('.mfp-iframe')) {

                    if (!$poster) {
                        $typeclass = ' thz-mfp-slick-iframe';
                        $bg = '';
                    }

                }

                if ($(element).is('.mfp-inline')) {

                    if (!$poster) {
                        $typeclass = ' thz-mfp-slick-inline';
                        $bg = '';
                    }
                }
				
				 if ($(element).is('.mfp-ajax')) {
					 
                      $typeclass = ' thz-mfp-slick-iframe';
                      $bg = '';					 
				 }

                if (i == slideIndex) {
                    $active_slide = ' thz-mfp-active';
                }

                $mfpslick += '<div class="thz-slick-slide' + $active_slide + $typeclass + '" data-type="image">';
                $mfpslick += '<div class="thz-slick-slide-in thz-media-custom-size">';
                $mfpslick += '<div class="thz-ratio-in">';
                $mfpslick += '<div class="thz-mfp-slickbg thz-hover thz-hover-img-mask thz-hover-fadein thz-img-zoomin thz-transease-04"';
                $mfpslick += '' + $bg + '">';
                $mfpslick += '<div class="thz-hover-mask thz-transease-04">';
                $mfpslick += '<div class="thz-hover-mask-table">';
                $mfpslick += '<a class="thz-hover-link" href="#"';
                $mfpslick += ' onclick="javascript:jQuery(\'.thz-lightbox-slick .thz-lightbox\').magnificPopup(\'goTo\', ' + i + ');return false;">';
                $mfpslick += '</a>';
                $mfpslick += '</div>';
                $mfpslick += '</div>';
                $mfpslick += '</div>';
                $mfpslick += '</div>';
                $mfpslick += '</div>';
                $mfpslick += '</div>';

            });

            $mfpslick += '</div>';
            $mfpslick += '</div>';
            $mfpslick += '</div>';
            $mfpslick += '</div>';

            ThzSetTimeout(function() {

                $('.mfp-content').append($mfpslick);

                var $mfpslider = $('.thz-lightbox-slick');
                var mfpSlideIndex = $gallery.index;

                $mfpslider.slick({
                    dots: false,
                    focusOnSelect: true,
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    waitForAnimate: true,
                    centerMode: false,
                    variableWidth: true,
                    infinite: false,
					rtl: thzsite.is_rtl ?  true : false

                });

                $mfpslider.slick('slickGoTo', mfpSlideIndex, false);

                $mfpslider.on('afterChange', function(event, slick, index) {

                    var elm = $(this),
                        getSlick = elm.slick('getSlick');
                    if (getSlick.slideCount <= 3) {

                        elm.addClass('thz-mfp-slick-center');

                    } else {


                        elm.removeClass('thz-mfp-slick-center');

                    }

                }).trigger('afterChange');

            }, 200);

        },

        
		thzVimeoReady: function(player_id) {

			var self = this;
			 
			if(player_id.indexOf('vimeo') > 0 ){
				
				var player = new Vimeo.Player(player_id);
				player.on('play', function (data) {});
				player.on('pause', function (data) {});

			}
								
		},
		
		thzMedia: function() {

            var self = this;
			
            if (typeof mejs != 'undefined') {

				$('.thz-media').mediaelementplayer({
					success: function(player, node, container) {
						
						self.thzVimeoReady(player.id + '_player');
						
						if($(container.$media).hasClass('thz-media-autoplay')){
							player.play();
						}
						
					}
				}).bind('ended pause',function () { 
					$(this).parents('.mejs-inner').find('.mejs-poster').show(); 
				});

            }

        },


        ThzWindowSize: function () {
			
			var self = this;
			
            var e = window,
                a = 'inner';
            if (!('innerWidth' in window)) {
                a = 'client';
                e = document.documentElement || document.body;
            }
            return {
                width: e[a + 'Width'],
                height: e[a + 'Height']
            };
        },


		thzSlickNavsRelativeTo: function(){
			
			var self = this;
			
			var adjustNavs = function(){
				
				if($('.navs-rel-c').length > 0){
					
					$('.navs-rel-c').each(function(index, element) {
                        
						var $this 		= $(this);
						var $slider		= $this.find('.slick-slider');
						var $current_n 	= $this.find('.slick-current .thz-section-in .thz-container').eq(0);
						var $current_p	= parseFloat($current_n.css('padding-left'));
						var $multiplier = $slider.is('.dots-br','.dots-rt','.dots-rc','.dots-rb') ? -1 : 1;

						if($current_n.length > 0 ){

							var $dots = $this.find('.thz-slick-sections > ul.slick-dots');
							
							if($slider.is('.dots-h, .dots-v')){
								
								var $dothook	= parseFloat($dots.css('min-width'));

								if( $dothook == 1.3 ){
									
									$multiplier = -1;
								
								}else if( $dothook == 2.3 ){
									
									$multiplier = 1;
									
								}else{
									
									return;
								}
								
							}
							
							var $set_dcss = {};
							var $left_n = parseFloat($current_n.offset().left);
								$left_n = $left_n < 0 ? $left_n : $left_n * $multiplier;
							
							if( !$slider.is('.dots-h, .dots-v') ){
								
								if($multiplier == 1){
									$set_dcss['left'] = $current_p;
								}else{
									$set_dcss['right'] = $current_p;
								}
							}else{
								
								if($multiplier == 1){
									
									$left_n += $current_p;
									
								}else{
										
									$left_n -= $current_p;
								}
								
							}

							$set_dcss['transform'] = 'translateX('+ ( $left_n )+'px)';
							
							$dots.css($set_dcss);
						
						}						
						
                    });

				}
				
				if($('.arr-rel-c').length > 0){
					
					
					$('.arr-rel-c').each(function(index, element) {
                        
						var $this 	   = $(this);
						var $current_a = $this.find('.slick-current .thz-section-in .thz-container').eq(0);
						
						if($current_a.length > 0 ){
							var $left_a = parseFloat($current_a.offset().left) ;
								$left_a = $left_a < 0 ? $left_a : $left_a * -1;
							
							$this.find('.thz-slick-sections > .slick-prev').css({
								'transform':'translateX('+ Math.abs($left_a) +'px)'	
							});
							
							$this.find('.thz-slick-sections > .slick-next').css({
								'transform':'translateX('+ $left_a +'px)'	
							});
						}						
						
                    });
					

				}			 
			};	
					
			ThzSetTimeout(adjustNavs,100);
		},
		
        thzSlick: function(element) {

            var self = this;

            var slickselector = $('.thz-slick-active');

            if (element) {
                slickselector = element;
            }

            if (typeof($.fn.slick) == 'undefined') {
                return;
            }

            slickselector.each(function(index, element) {

                var $this = $(this);
				var $this_id = $this.attr('id') ? $this.attr('id') : false;
                var $dots = $this.attr('data-dots') == 'hide' ? false : true;
				var $arrows = $this.attr('data-arrows') == 'hide' ? false : true;
                var $autoplay = $this.attr('data-autoplay') == 1 ? true : false;
                var $autoplaySpeed = parseFloat($this.attr('data-autoplaySpeed'));
				var $pauseOnHover = $autoplay == 1 ? parseFloat($this.attr('data-pauseOnHover')) : true;
                var $fade = $this.attr('data-fade') == 1 ? true : false;
                var $infinite = $this.attr('data-infinite') == 1 ? true : false;
                var $speed = parseFloat($this.attr('data-speed'));
                var $slidesToShow = parseFloat($this.attr('data-slidesToShow'));
                var $slidesToScroll = parseFloat($this.attr('data-slidesToScroll'));
                var $space = parseFloat($this.attr('data-space'));
                var $asNavFor = $this.attr('data-navfor') && $($this.attr('data-navfor')).length ? $this.attr('data-navfor') : false;
                var $navfocus = $this.attr('data-navfocus') == 1 ? true : false;
                var $centermode = $this.attr('data-centermode') == 1 ? true : false;
				var $centerpadding = $this.attr('data-centermode') == 1 ? parseFloat($this.attr('data-centerpadding')) + 'px' : false;
				var $draggable = $this.attr('data-draggable') ? Number($this.attr('data-draggable')) : true;
				var $cssEase = $this.attr('data-cssease') ? $this.attr('data-cssease') : 'ease-in-out';
				var $vertical = $this.attr('data-vertical') == 1  || $this.attr('data-vertical') == 2 ? true : false;
				var $verticalReverse = $this.attr('data-vertical') == 2 ? true : false;
				var $listvisible = $this.attr('data-list') == 'visible' ? true : false;

				if($slidesToShow > 1  && $slidesToShow % 2){
					$this.addClass('thz-slick-centered');
				}


                $this.on('init', function(event, slick) {
					
					if($(slick.$slides).find('.thz-before-after').length > 0){
						
						slick.slickSetOption({ 
						
							'draggable': false,
							'swipe': false
						
						}, false, false);


					}
					
					$this.find('.slick-cloned .thz-slick-media').each(function(index, element) {
					    
						var $smv  = $(this);
						var $smid = $(this).attr('id');
						$smv.attr('id','mediacl-'+ $smid).addClass('media-cloned');

                    });
					
					if (typeof mejs != 'undefined') {
					  $this.find('.thz-slick-media').mediaelementplayer();
					}				
											
                    $(slick.$slides.get(0)).find('[data-anim-effect]').addClass('thz-animate');
					
					$(slick.$slides.get(0)).addClass('is-current-slide');
					
                    var $firstType = $(slick.$slides.get(0)).find('.thz-slick-slide').attr('data-type');
					
					if($firstType != undefined){
                    	$this.addClass('thz-slick-current0 thz-slick-' + $firstType);
					}
                    $this.removeClass('thz-slick-initiating');
                    $('.slick-cloned').find('.thz-lightbox').addClass('mfp-cloned').removeClass('thz-lightbox mfp-image');

					self.thzSlickNavsRelativeTo();
					
                    ThzSetTimeout(function() {
                        $this.find('.slick-dots').addClass('dots-active');
                    }, 100);

                });
				
				 
				var $breakPoints = [

					{
						breakpoint: 979,
						
						settings: {
							slidesToShow: $asNavFor ?  $slidesToShow : 1,
							slidesToScroll: $asNavFor ?  $slidesToScroll : 1,
							centerMode:false,
							centerPadding: '0px',
							thzSpace:0
						}
					},

            	];
					
				$breakPoints = $this.attr('data-breakpoints') ? JSON.parse($this.data('breakpoints').replace(/(&quot\;)/g,"\"")) : $breakPoints;
				
                $this.slick({
                    dots: $dots,
					arrows: $arrows,
                    autoplay: $autoplay,
                    autoplaySpeed: $autoplaySpeed,
					pauseOnHover: $pauseOnHover,
                    fade: $fade,
                    infinite: $verticalReverse ? true : $infinite,
                    speed: $speed,
                    slidesToShow: $slidesToShow,
                    slidesToScroll: $slidesToScroll,
					draggable:$draggable,
                    adaptiveHeight: $listvisible ? false : true,
                    lazyLoad: 'ondemand',
                    asNavFor: $asNavFor,
                    focusOnSelect: $navfocus,
                    centerMode: $centermode,
					centerPadding: $centerpadding,
					cssEase: $cssEase,
                    responsive: $breakPoints,
					thzSpace:$space,
					vertical: $vertical,
					verticalSwiping: $vertical,
					verticalReverse: $verticalReverse,
					rtl: thzsite.is_rtl ?  true : false
					
                       
                }).
                mousedown(function() {
                    
					$(this).addClass('grabbing')
					.find('.slick-slide:not(.is-current-slide) [data-anim-effect]')
					.addClass('thz-animate');
					
                }).mouseup(function() {
					
                    $(this).removeClass('grabbing');
					
                });

                $this.on('breakpoint', function(event, slick, breakpoint) {

                    ThzSetTimeout(function() {
                        $this.find('.slick-dots').addClass('dots-active');
                    }, 100);
                });

                $this.on('afterChange', function( event, slick, index ) {

					if( !$infinite && $autoplay ){
						
						if( index === slick.$slides.length - $slidesToShow  ) {
							 slick.slickPause();
						}						
					}
					
					ThzSetTimeout(function() {
						
						self.thzSlickNavsRelativeTo();
						
						if ($(slick.$slides.get(index)).find('.thz-animate').length) {
							self.thzAnimations($(slick.$slides.get(index)).find('.thz-animate'));
						}
					
						if (index > 0) {
	
							$this.parents('.thz-grid-item').addClass('not-first-slick');
	
						} else {
	
							$this.parents('.thz-grid-item').removeClass('not-first-slick');
	
	
						}
	
						var $type = $(slick.$slides.get(index)).find('.thz-slick-slide').attr('data-type');
						$this.removeClass('thz-slick-vimeo thz-slick-youtube thz-slick-html5audio thz-slick-html5video thz-slick-iframe');
						if($type != undefined){
							$this.addClass('thz-slick-' + $type);
						}
						
						if (typeof($.fn.isotope) != 'undefined') {
							if ($this.parents('.thz-is-isotope').length > 0) {
								$this.parents('.thz-items-grid').isotope('layout');
							}
						}
						$(slick.$slides).removeClass('is-current-slide');
						$(slick.$slides.get(index)).addClass('is-current-slide');
						
					}, 20);
					
                });

                $this.on('beforeChange', function(event, slick, index, next) {
					
					
					self.thzSlickBodyClass( $this_id , index, next);
					
					$(slick.$slides.get(next)).addClass('is-current-slide');

					self.thzPauseSlideVideo( $(slick.$slides.get(index)) );	
									
					if( index !== next ){
                    	$(slick.$slides.get(next)).find('[data-anim-effect]').addClass('thz-animate');
					}

                    if (next == 0 && $this.parents('.thz-grid-item').attr('data-mode') != 'introunder') {

                        $this.parents('.thz-grid-item').removeClass('thz-hover-on');
                        $(slick.$slides).removeClass('thz-slide-current');

                    }
					
					if ( $this.hasClass('thz-slick-sections') ) {
                    	ThzSetTimeout(function() {
							$this.find('.slick-dots').addClass('dots-active');
											
							var $section_brightness = $(slick.$slides.get(next)).find('[data-get-brightness]');
							if ( $section_brightness.length > 0 ){
								
								var $brightness 	= $section_brightness.attr('data-get-brightness');
								var $section_parent = $section_brightness.parents('.thz-sections-slider');
								
								$section_parent.attr('data-view-brightness',$brightness);
								self.thzSetViewBrightness( $section_parent );
							}
						  }, $speed / 2 );
					}
					

                    $this.
                    removeClass('thz-slick-current' + index).
                    addClass('thz-slick-current' + next);

                    if ($asNavFor) {

                        $($asNavFor).
                        removeClass('thz-slick-current' + index).
                        addClass('thz-slick-current' + next);

                    }

                });
				

            });
			
			


        },
		
		thzPauseSlideVideo: function($slide){
			
			var self = this;
			
			if (typeof mejs != 'undefined') {
				
				var $type = $slide.find('.thz-slick-slide').attr('data-type');
				var $mjstypes =['vimeo','youtube','html5video','html5audio','selfvideo','selfaudio'];
			
				if ( $mjstypes.indexOf($type) != -1 ) {
					
					var $mjsid = $type == 'html5audio' || $type == 'selfaudio' ? $slide.find('audio').attr('id') : $slide.find('video').attr('id');
					var $player = $('#' + $mjsid)[0].player;
					
					if($player != undefined){

						var $time = $player.media.currentTime;
						
						if( $time > 0){
							
							if($type == 'vimeo' || $type == 'youtube'){
								$slide.find('iframe').attr('src', function(i, val) {
									return val;
								});								
							}else{
								$player.pause();
								$player.remove();
								$slide.find('.thz-slick-media').mediaelementplayer();	
							}
						}

					}else{
						
						for (var player in mejs.players) {
							
							mejs.players[player].media.pause();
						} 
						
					}
				}
				
				if ($type == 'iframe') {
					$slide.find('iframe').attr('src', function(i, val) {
						return val;
					});
				}
			}			
		},
		
        thzSlickBodyClass: function( $this_id , index, next) {

            var self = this;

			if( $this_id ){
				
				$('body').removeClass('thz-b-slick-' + $this_id + '-' + index).
				addClass('thz-b-slick-' + $this_id + '-' + next);	
			}

        },		

        thzSlickCurrent: function($thzslick, $index) {

            var self = this;

            $thzslick.find('.slick-slide')
                .removeClass('thz-slide-current')
                .eq($index).addClass('thz-slide-current');

        },
		
		
		thzCustomTooltips: function (){
			
			var self = this;
			
			$('[data-tip-class]').each(function(index, element) {
				
				var $this 		= $(this);
				var $class 		= $this.attr('data-tip-class');
				var $visible 	= $class.indexOf('tip-visible') > -1 ? true: false;
				var $trigger	= $visible ? 'manual' : 'hover';
				
				$this.tooltip({
					trigger: $trigger,
					container: 'body',
					html:true,
					//placement: "bottom-left",
				}).data('bs.tooltip').tip().addClass($class); 
				
				if($visible){
					
					if($this.is('.thz-animate')){
	
						$this.on('thz:animation:done', function(e) {
							$this.tooltip('show');
						});					

					}else{
						
						$this.tooltip('show');
					}
					
				}

				
            });

			if($('[data-tip-class*="thz-tip-visible"]').length > 0){
				
				$(window).resize(function() {
					
					$(".thz-tip.thz-tip-visible").hide();
					
					clearTimeout(window.resizedFinished);
	
					window.resizedFinished = ThzSetTimeout(function(){
						$('[data-tip-class*="thz-tip-visible"]').tooltip('show');

					}, 250);
				});		
			}			   
		},
		
		
        thzTooltip: function() {

            var self = this;

            $('.thz-tips,[data-toggle="tooltip"],.thz-tips-top,.thz-btn-tips-top .thz-button').tooltip({
                container: 'body'
            });
			
            $('.thz-tips-bottom,.thz-btn-tips-bottom .thz-button').tooltip({
                container: 'body',
				placement:'bottom'
            });
			
            $('.thz-tips-left,.thz-btn-tips-left .thz-button').tooltip({
                container: 'body',
				placement:'left'
            });
			
            $('.thz-tips-right,.thz-btn-tips-right .thz-button').tooltip({
                container: 'body',
				placement:'right'
            });
			
            $('.thz-popovers,[data-toggle="popover"]').popover({
                container: 'body'
            });
						
        },

        thzShortcodeTabs: function() {

            var self = this;

            $('.thz-shortcode-tabs').each(function(index, element) {

                var holder = $(this);
                var navi = holder.find('.thz-tabs-menu');
                var navih = navi.height();
                var isactive = holder.find(".thz-tabs-active-content");
                isactive.show();
                isactive.find('.thz-tab-content-inner').fadeIn();

                navi.find('li a').click(function(e) {
                    e.preventDefault();
                    if ($(this).parent().hasClass('thz-active-tab')) {
                        return;
                    }
                    if ($(this).attr("class") == "thz-tabs-active-content") {
                        return
                    } else {
						
						if ( holder.find('[data-anim-effect]').length ) {
							holder.find('[data-anim-effect]').addClass('thz-animate');
						}
						
                        holder.find(".thz-tab-content").hide().removeClass('thz-tabs-active-content');
                        holder.find(".thz-tab-content-inner").hide();
                       
                        navi.find("li").removeClass("thz-active-tab").addClass("thz-inactive-tab");
                        $(this).parent().removeClass("thz-inactive-tab").addClass("thz-active-tab");
                        $($(this).attr('href')).show().removeClass("thz-tabs-inactive-content")
                            .addClass("thz-tabs-active-content");
                        $($(this).attr('href')).find('.thz-tab-content-inner').fadeIn();
                        var activeh = $($(this).attr('href')).height();
						
						if (holder.find('.thz-animate').length) {
							self.thzAnimations(holder.find('.thz-tabs-active-content .thz-animate'));
						}

                        if (navih < activeh && (holder.hasClass('thz-tabs-left') || holder.hasClass('thz-tabs-right'))) {

                            navi.height(activeh);

                        } else if (holder.hasClass('thz-tabs-left') || holder.hasClass('thz-tabs-right')) {

                            navi.height(navih);
                        }

                    }
                });

            });

        },

        thzShortcodeAccordion: function() {

			 var self = this;
			  
            $('.thz-shortcode-accordion').each(function(index, element) {

                var holder = $(this);
                var group = holder.find('.thz-accordion-group');
                var opener = group.find('.thz-accordion-title a');
                var active = group.find('.thz-accordion-title.active a');
                var content = group.find('.thz-accordion-content');

                $('.loadopened .active-content').slideDown(400);
				
				content.not('.active-content').find('[data-anim-effect]')
				.addClass('thz-animate-wait').removeClass('thz-animate');

                opener.on('click', function(event) {

                    event.preventDefault();

                    holder.find('.active').removeClass('active');
                    
					content.slideUp(400,function(){
						if ( $(this).find('[data-anim-effect]').length ) {
							$(this).find('[data-anim-effect]')
							.addClass('thz-animate')
							.removeClass('thz-animate-wait');
						}
					}).removeClass('active-content');
					
                    content.parent().removeClass('active-group');

                    if ($(this).parent().next().is(':hidden') == true) {

                        $(this).parent().addClass('active');
                        $(this).parent().parent().addClass('active-group');
                        $(this).parent().next().slideDown(400, function() {
   							if ( $(this).find('.thz-animate').length ) {
								self.thzAnimations($(this).find('.thz-animate'));
							}
  						}).addClass('active-content');

                    }

                });
				
                opener.on('mouseover', function() {
                    $(this).parent().addClass('hovered');
                }).on('mouseout', function() {
                    $(this).parent().removeClass('hovered');
                });

            });

        },

        thzNotificationClose: function() {

            var self = this;

            // close alerts
            $('.thz-notification-close').on('click', function(e) {
				
				var $this =  $(this);
				var $parent = 	$this.parents('.thz-notification-container').length > 0 ? $this.parent().parent() : $this.parent();
						
                $parent.animate({
                    top: -1000
                }, 500, function() {
                    $(this).hide();
                });


            });

        },

        thzScroll: function() {

            var self = this;
            var before;
            var after;
			var adjust = 0;
			
			if(self.wpadminbar){
				
				adjust += self.wpadminbar;
			}
			
			if( $('.sticky-show').length > 0 ){
				
				adjust += $('.sticky-show').outerHeight();
			}			

            $(".thz-menu-anchor,.thz-element-anchor").each(function() {

                var $id = $(this).attr('id');
                var $duration = $(this).attr('data-anchor-duration');
                var $before = $(this).attr('data-anchor-before');
                var $after = $(this).attr('data-anchor-after');
                var $element = $("[href*=#" + $id + "]");

                if ($element.length > 0) {
                    $element.addClass('thz-scroll');
                }

                if ($duration != undefined) {
                    $element.attr('data-duration', $duration);
                }

                if ($before != undefined) {
                    $element.attr('data-before', $before - adjust);
                }
                if ($after != undefined) {
                    $element.attr('data-after', $after - adjust);
                }
            });


            $('.thz-section-scroll-arrow').on('click', function(e) {
                e.preventDefault();
                var heroSection = $(e.target).parent().parent(),
                    heroTop = heroSection.offset().top - adjust,
                    heroHeight = heroSection.outerHeight(),
                    durration = Math.abs(heroTop + heroHeight) / 2;
                	durration = durration < 800 ? 800 : durration;
				
                $('html, body').animate({
                    scrollTop: heroTop + heroHeight
                }, durration, 'easeInOutCubic');

            });


            $(".thz-scroll").on('click', function(event) {
				
				
				self.scrollTrigger = 'thz:scroll';
				
				
                if ($(this.hash).length == 0) {
                    return;
                }

                if ($(this).data('duration')) {

                    var duration = $(this).data('duration');

                } else {

                    var duration = 800;

                }

                event.preventDefault();

				
                var el = $(this),
                    before = el.data('before'),
                    after = el.data('after'),
                    element = $(this.hash);
				
				
				if( $('.thz-canvas-burger.is-active').length > 0 ){
					$('.canvasOpen .thz-open-canvas').trigger('click');
				}
				
				if( $('.thz-open-mobile-menu.is-active').length > 0 ){
					$('.thz-open-mobile-menu').trigger('click');
				}
				
                if (!before) {
                    before = 0;
                }
                if (!after) {
                    after = 0;
                }
				
				if(self.wpadminbar){
					
					before += self.wpadminbar;
				}
				
				if( !$(this).hasClass('thz-fpr-link') ){
					var goTo = $(this.hash).offset().top - before + after;
					$('html, body').stop(true, true).animate({
						scrollTop: goTo
					}, duration, function(){
						
						self.scrollTrigger = false;
						
					});
				}

            });
			
			//self.thzToTopPosition();
            $(window).scroll(function() {

                if ($(this).scrollTop() > 300) {
                    $('.thz-to-top').addClass('shown').fadeIn(500);
                } else {
                    $('.thz-to-top').fadeOut(500).removeClass('shown');
                }
            });

        },

		thzToTopPosition : function (){
			
			var self 	= this;
			var right 	= $('.thz-body-frame').length > 0 ? $('.thz-bf-top').outerHeight() + parseInt($('.thz-to-top').css('right')) : false;
			
			
			if($('.thz-to-top').length > 0 && $('#footer').length > 0){

				var bottom 	= $('#footer').outerHeight() - ($('.thz-to-top').outerHeight() / 2 );

				$('.thz-to-top').css({
					'bottom': bottom +'px',
					'right': right +'px'
				});
				
			}else{
				
				if(right){
					
					var bottom 	= $('.thz-bf-top').outerHeight() + parseInt($('.thz-to-top').css('bottom'));
					
					$('.thz-to-top').css({
						'bottom': bottom +'px',
						'right': right +'px'
					});					
				}
				
			}
					
		},		
		
		thzSiteOffline: function (){
			
			var self = this;
			
			if(thzsite.offline !='inactive' && $('#wp-admin-bar-top-secondary').length > 0){
				

				var $offline_link = '<li class="thz-site-offline"><a href="wp-admin/admin.php?page=fw-settings#fw-options-tab-additionaltab">Offline mode is active</a></li>';
				$('#wp-admin-bar-top-secondary').prepend($offline_link);
			}
			
			
		},

    });

    $.fn[pluginName] = function(options, additionaloptions) {
        return this.each(function() {
            if (!$.data(this, 'plugin_' + pluginName)) {
                $.data(this, 'plugin_' + pluginName, new Plugin(this, options));
            } else if (Plugin.prototype[options]) {
                $.data(this, 'plugin_' + pluginName)[options](additionaloptions);
            }
        });
    }

})(jQuery, window, document);

(function($) {

    $(document).on('ready', function(){
        $(document).ThzSite();
    });

    $(window).on('load',function() {
       $(document).ThzSite('thzInitOnLoad');
    });
	
	$(window).on('resize', function() {
		$(document).ThzSite('thzInitOnResize');
	});

}(jQuery));	