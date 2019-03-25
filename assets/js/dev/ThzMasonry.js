/**
 * @package      ThzFramework
 * @copyright    Copyright(C) since 2007  Themezly.com. All Rights Reserved.
 * @author       Themezly
 * @license      http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 * @websites     http://www.themezly.com | http://www.youjoomla.com
 */
;(function($, window, document, undefined) {

    "use strict";

    var pluginName = "ThzMasonry",
        defaults = {

            masonry: true
        };

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

            this.grid = $(self.element).find('.thz-items-grid');

            if (this.grid.length < 1) {
                $(self.element).addClass('thz-items-grid-loaded thz-items-grid-missing');
                return;
            }

            this.more_holder 	= $(self.element).find('.thz-items-more');
            this.more_link 		= this.more_holder.find('a');
            this.scroll_to 		= $(self.element).find('.thz-items-scrollto');
            this.pagination 	= this.grid.attr('data-pagination');
            this.display_mode 	= this.grid.attr('data-display-mode');
			this.layout_type 	= this.grid.attr('data-layout-type');
			this.layoutMode 	= this.grid.attr('data-isotope-mode') ? this.grid.attr('data-isotope-mode') :'packery';
			
            this.loadAgain 	= true;
            this.processing;
			

			
            self.ThzCheckCats();
           
		    if (self.settings.masonry === true) {
                
				self.ThzMasonryLoad();
				
            }else{
				
				self.ThzPozLoader();
				$(window).on('resize', function() {
					self.ThzPozLoader();
				});
			
			}
			
            self.ThzMasonryMore();
            self.ThzMasonryCats();
            self.ThzMasonryAjaxPagination();

        },
		
		ThzPozLoader: function (){

			var self = this;
			var $loading = $(self.element).find('.thz-items-loading');

			if($loading.length > 0){
			
				var height = $(self.element).outerHeight();
				var topmax = height - 200;
				
				$loading.css({
					'bottom':'auto',
					'top':topmax
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
		
		ThzMasnorySizeItems: function($grid) {
			
			var self = this;
			
			
			if($grid){
				
				$grid = $grid;
				
			}else{
				
				$grid = self.grid;
			}
			
			var $window_w 		= self.ThzWindowSize().width; 
			var $container_w 	= $grid.outerWidth();
			var $sizer_w 		= $grid.find('.thz-items-sizer').outerWidth();
			var $columns		= Math.round( $container_w  / $sizer_w );
			var $minWidth 		= $grid.attr('data-minwidth') ? $grid.attr('data-minwidth') : false;
			var layoutMode		= $grid.attr('data-isotope-mode') ? $grid.attr('data-isotope-mode') :'packery';
			
			if($minWidth && ( $sizer_w < $minWidth ) ){
				
				$columns = Math.floor( $container_w  / $minWidth);
				
			}
			
			if( layoutMode =='vertical' ){
				
				$columns = 1;
			}
			
			if($window_w < 980 && $window_w > 767){
				
				 $columns = $columns > 2 ? 2 : $columns;
				
				
			} else if($window_w < 768){
				
				 $columns = $columns > 1 ? 1 : $columns;
				
			}
			
			var $items_w 		= Math.floor( $container_w  / $columns );
			var $grid_diff		= $container_w - ($items_w * $columns);
			var $findslick		= $grid.find('.thz-slick-active');
			
			if($grid_diff > 0 && $('.thz-wrapper').hasClass('thz-layout-boxed')){
				$grid.css('left',$grid_diff / 2);
			}


			
			$grid.find('.thz-grid-item').each(function(index, element) {

				var $this 			= $(this);
				var $item_size 		= $items_w;
				var $multiplier 	= $columns > 1 ? 2 : 1;
				
				if($this.hasClass('thz-item-metro-double') || $this.hasClass('thz-item-metro-landscape')){
					
					$item_size = $items_w * $multiplier ;
				}

				$this.css('width',$item_size);

				self.ThzAdjustMetros($grid,$this,$item_size,$columns);
				
				$this.find('.mejs-video,.mejs-audio').each(function() {
					$(this).trigger('resize');
				});
				
				if( !$this.hasClass('size-set') ){
					$this.addClass('size-set');
				}
				
			});	
			
			if($findslick.length > 0){
				setTimeout(function() {
					$grid.isotope('layout');
				}, 400);
			}
		},

		ThzAdjustMetros: function($grid,$item,$size,$columns){
			
			var self		= this;
			
			if( $grid.attr('data-layout-type') == 'metro' ){

				var $item_in		= $item.find('.thz-grid-item-in');
				var $media_h 		= $item.find('.thz-media-custom-size');
				var $intro_height 	= $item_in.outerHeight() - $media_h.outerHeight();
				var $new_height		= $item_in.outerWidth();
				var $gap			= parseInt( $item.css('padding-left') );
				var $multiplier 	= $columns > 1 ? 2 : 1;
	
				if( $item.hasClass('thz-item-metro-landscape') ){
					
					$new_height = ( $new_height / $multiplier ) - ( $gap / 2 );
				}
				
				if( $item.hasClass('thz-item-metro-portrait') ){
					
					$new_height = $new_height * $multiplier + $gap;
				}

				$item_in.css('height',$new_height);
				
				$media_h.css({
				
					'height':$new_height - $intro_height,
					'padding-bottom':'0px'
					
				});
			
			}
		},
		
        ThzMasonryLoad: function() {

			var self = this;
			self.ThzMasnorySizeItems();
			Isotope.prototype.onresize   = function() {
				self.ThzMasnorySizeItems($(this.element));
				this.resize();
			};
			
            self.grid.isotope({
                itemSelector: '.thz-grid-item',
                layoutMode: self.layoutMode,
                transitionDuration: '0.4s',
                masonry: {
                    columnWidth: '.thz-items-sizer',
					gutterWidth: 0,
                },
                packery: {
                    gutter: 0
                },

                hiddenStyle: {
                    opacity: 0
                },
                visibleStyle: {
                    opacity: 1
                },
            });

            self.grid.on('arrangeComplete', function(event, filteredItems) {

                $(document).ThzSite('thzAnimations', self.grid.find('.thz-grid-item:not(.thz-animate-parent-done) .thz-isotope-animate'));
				
            });

            if (self.layout_type == 'masonry') {

                self.grid.imagesLoaded().always(function() {
                   
				    self.grid.isotope('layout');

                    var runanimations = self.grid.find('.thz-isotope-animate:not(.thz-animate)');

                    if (runanimations.length > 0) {
                        runanimations.addClass('thz-animate');
                    }

                    $(self.element).addClass('thz-items-grid-loaded');

                    if (runanimations.length > 0) {
                        $(document).ThzSite('thzAnimations', runanimations);
                    }

                });

            } else {
                self.grid.imagesLoaded({
                    background: '.thz-items-grid-image'
                
				}, function() {
					
                    self.grid.isotope('layout');

                    var runanimations = self.grid.find('.thz-isotope-animate:not(.thz-animate)');

                    if (runanimations.length > 0) {
                        runanimations.addClass('thz-animate');
                    }

                    $(self.element).addClass('thz-items-grid-loaded');

                    if (runanimations.length > 0) {
                        $(document).ThzSite('thzAnimations', runanimations);
                    }

                });
            }

        },

        ThzCheckCats: function() {


            var self = this;

            $(self.element).find('.thz-items-grid-categories a').each(function(index, element) {


                var $cat = $(element).attr('data-filter-value');

                if ($cat != '.category_all') {

                    if (self.grid.find('.thz-grid-item' + $cat).length == 0) {

                        $(element).parent().addClass('hide-cat');

                    } else {

                        $(element).parent().removeClass('hide-cat');
                    }
                }

            });

        },

        ThzMasonryCats: function() {
            
			var self = this;

            $(self.element).find('.thz-items-grid-categories a').on('click', function(e) {

                e.stopPropagation();
                e.preventDefault();

                var $this = $(this);
                if ($this.hasClass('active')) {
                    return;
                }
                var $selector = $this.attr('data-filter-value');
                var $catItems = self.grid.find($selector);

                if ($catItems.length < 1) {
                    return;
                }

                $this.parents('.thz-items-grid-categories').find('a.active').removeClass('active');
                $this.addClass('active');

                self.grid.isotope({
                    filter: $selector
                }).isotope('layout');
				
				self.ThzMasnorySizeItems();
				self.grid.isotope('layout');
				
            });

        },

        ThzMasonryAjaxPagination: function() {

            var self = this;


            if (!$(self.element).hasClass('thz-posts-holder')) {
                return;
            }

            var $links 	= $(self.element).find("a.thz-pagination-button");
            var $id 	= $(self.element).attr('id');

            $($links).on('click', function(e) {
                e.preventDefault();

                var $href = $(this).attr('href');

                $('html, body').animate({
                    scrollTop: $(self.element).offset().top,
                }, 800, 'easeInOutCubic');

                $(self.element).addClass('loading-items').find(".thz-items-loading").fadeIn(500,function(){
					$(this).css({
						'bottom':'auto',
						'top':'40%'
					});	
				});


                $.ajax({
                    url: $href
                }).done(function(data) {

					var $newgrid 		= $('<div>').append($(data).find('#' + $id)).html();
                    var newItems 		= $($newgrid).find('.thz-grid-item');
                    var newPagination 	= $($newgrid).find('.thz-pagination-nav');
					var newFilter 		= $($newgrid).find('.thz-items-grid-categories');


                    $(self.element).find('.thz-grid-item').addClass('thz-zoomOut');

                    setTimeout(function() {
						
                        
						if (self.grid.hasClass('thz-timeline-double')) {
							
							self.grid.find('.thz-timeline-left').html('');
							self.grid.find('.thz-timeline-right').html('');
							
						}else{
							
							$(self.grid).html('<div class="thz-items-sizer"></div>');
						}
						
                        self.ThzMasonryNewitems(newItems, 300);
						
						$(self.element).find('.thz-pagination-nav').replaceWith($(newPagination));
						
						if (!self.grid.hasClass('thz-grid-timeline')) {
							$(self.element).find('.thz-items-grid-categories').replaceWith($(newFilter));
							self.ThzMasonryCats();
							self.ThzCheckCats();
						}
						
						
						self.ThzMasonryAjaxPagination();
						
						$(self.element).find(".thz-items-loading").fadeOut(400,function(){
							$(self.element).removeClass('loading-items');
						});
						  
						  
					}, 280);
					
                  

                });

            });
        },

        ThzMasonryMore: function() {

            var self = this;

            if (self.pagination == "click") {
                self.more_link.on('click', function(e) {
                    e.preventDefault();

                    if ($(this).hasClass('loading-posts')) {
                        return;
                    }
                    self.ThzMasonryAjax(true);
                    $(this).addClass('loading-posts');
					$('body').removeClass('posts-loaded');

                });
            }
            if (self.pagination == "scroll") {

                $(document).scroll(function(e) {

                    var $last = self.grid.find(".thz-grid-item:last");
                    if (!self.processing && self.ThzLastInView($last)) {
                        self.processing = true;
                        self.ThzMasonryAjax();
                    }

                });

            }

        },

        ThzLastInView: function(el) {

            var self = this;
            var docViewTop = $(window).scrollTop();
            var docViewBottom = docViewTop + $(window).height();

            var elTop = $(el).offset().top;
            var elBottom = elTop + $(el).height();

            return ((elBottom <= docViewBottom) && (elTop >= docViewTop));
        },

        ThzMasonryAjax: function( load_by_cat ) {

            var self = this;
            var maxpages = self.grid.attr('data-maxpages');

            if (!self.loadAgain || maxpages < 2) {

                return;
            }

            $(self.element).find(".thz-items-loading").fadeIn(500);

            var currentItems = $(self.element).find(".thz-grid-item").map(function() {
                return $(this).data("itemid");
            }).get();

            var catID = self.grid.attr('data-catid');
            var itemsLoad = self.grid.attr('data-itemsload');
			var active_cat = load_by_cat ? $(self.element).find('.thz-posts-filter-link.active').attr('data-filter-value') : false;
            var postType = self.grid.attr('data-posttype');
            var taxOnomy = self.grid.attr('data-taxonomy');
            var order = self.grid.attr('data-order');
            var orderby = self.grid.attr('data-orderby');
            var layouthook = self.grid.attr('data-layouthook');
            var postauthor = self.grid.attr('data-postauthor');
            var sqlhook = self.grid.attr('data-sqlhook');
            var shortcodeid = self.grid.attr('data-shortcodeid');
            var objectid = self.grid.attr('data-objectid');
			var preview_atts = self.grid.data('atts') ? JSON.stringify(self.grid.data('atts')) : false;
            var useaction = shortcodeid != undefined ? 'thz_shortcode_posts' : 'thz_get_posts_action';

			 return $.ajax({
					type: 'post',
					url: thzsite.ajaxurl,
					data: {
						action: useaction,
						nonce: thzsite.masonrynonce,
						category: catID,
						itemsload: itemsLoad,
						posttype: postType,
						taxonomy: taxOnomy,
						order: order,
						orderby: orderby,
						current: JSON.stringify(currentItems),
						layouttype: self.layout_type,
						layouthook: layouthook,
						postauthor: postauthor,
						sqlhook: sqlhook,
						shortcodeid: shortcodeid,
						objectid: objectid,
						preview_atts: preview_atts
					},
					success: function(response) {
	
						var $items 			= $(response);
						var $items_count 	= $items.find('.thz-grid-item-in').length;
						
						
						
						if (($items_count > itemsLoad) && itemsLoad != -1 ) {

							var $new_items = $items.not(':last');
	
						} else {
	
							self.loadAgain = false;
							var $new_items = $items;
							self.more_holder.fadeOut(400);
	
						}
						
	
						self.ThzMasonryNewitems($new_items, 0, active_cat);
						self.ThzAddCats($new_items);
						
						$(self.element).find(".thz-items-loading").fadeOut(400);
					
					},
					complete: function() {
						self.processing = false;
						self.more_link.removeClass('loading-posts');
						$('body').addClass('posts-loaded');
					},
	
				});

        },

        ThzMasonryItemsEffects: function(newItems, timeout) {

            var self = this;

            var newslick = newItems.find('.thz-slick-active');

            if (newslick.length > 0) {
                $(document).ThzSite('thzSlick', newslick);
            }

            var inactiveslick = newItems.find('.thz-slick-inactive');

            if (inactiveslick.length > 0) {
                var medias = inactiveslick.find('.thz-slick-media');


                if (medias.length > 0) {
                    medias.mediaelementplayer();
                }

            }

            var newmedias = newItems.find('.thz-media');

            if (newmedias.length > 0) {
                newmedias.mediaelementplayer();
            }

            var hasanimaton = newItems.find('.thz-isotope-animate');

            if (hasanimaton.length > 0) {

                hasanimaton.addClass('thz-animate');
            }

            if (self.settings.masonry === true) {
                self.grid.isotope('layout');
            }

            $(document).ThzSite('thzGridItemEffects', newItems);
			

            setTimeout(function() {
                $(document).ThzSite('thzAnimations', hasanimaton);
            }, timeout);

            self.ThzCheckCats();
        },

		
		
		ThzAddCats : function (newItems){
			
			var self = this;
			
			if( $('.thz-items-grid-categories').length < 1){
				return;
			}
			
			newItems.each(function(index, element) {
			
				var $this 		= $(element);
				var $get_data 	= $this.data('cats').replace(/(&quot\;)/g,"\"");
				
				if($get_data.length > 0 ){
				
					var $cat_data =  JSON.parse( $get_data );
				
					$.each($cat_data, function ($class,$title){
					
						if( !$("[data-filter-value='." + $class + "']")[0] ){
							
							var $li ='<li class="thz-items-categories-item">';
								$li +='<a href="#" class="thz-posts-filter-link" data-filter-value=".'+ $class +'">';
								$li += $title;
								$li +='</a>';
								$li +='</li>';
								
							$('.thz-items-grid-categories').append($li);
							
						}
					});
				}
			
			});
			
			self.ThzMasonryCats();

		},
		
		
        ThzMasonryNewitems: function(newItems, timeout, active_cat) {

            var self = this;
			var current_category = active_cat ? active_cat.replace('.','') : false;
			
			if( active_cat && active_cat !='category_all' ){
				newItems = newItems.sort(function (a, b) {
					return $(b).hasClass(current_category) - $(a).hasClass(current_category);
				});	
			}
			
            newItems.imagesLoaded(function() {

                newItems.find('.thz-grid-item-in').addClass('thz-new-grid-item');
				
                if (self.settings.masonry === true) {
					
                    self.grid.append(newItems).isotope('appended', newItems);
					self.ThzMasnorySizeItems();

                } else {

                    if (self.grid.hasClass('thz-timeline-double')) {

                        newItems.each(function(index, element) {
							
                            if ($(element).hasClass('thz-timeline-item-left')) {
								
                                self.grid.find('.thz-timeline-left').append(element);

                            } else {

                                self.grid.find('.thz-timeline-right').append(element);

                            }

                        });

                    } else {

                        self.grid.append(newItems);
                    }
					
					self.ThzPozLoader();

                }
                self.ThzMasonryItemsEffects(newItems, timeout);


            });
        },


    });

    $.fn[pluginName] = function(options) {
        return this.each(function() {
            if (!$.data(this, 'plugin_' + pluginName)) {
                $.data(this, 'plugin_' + pluginName, new Plugin(this, options));
            } else if (Plugin.prototype[options]) {
                $.data(this, 'plugin_' + pluginName)[options]();
            }
        });
    }


})(jQuery, window, document); // JavaScript Document