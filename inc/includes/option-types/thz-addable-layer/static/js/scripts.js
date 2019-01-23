(function ($, _, fwEvents, window) {
	var dragging = false;
	var ThzaddableLayer = function () {
		var $this = $(this),
			$defaultItem = $this.find('.default-item:first'),
			nodes = {
				$optionWrapper: $this,
				$addButton: $this.find('.add-new-item'),
				$itemsWrapper: $this.find('.items-wrapper'),
				$layerItems: $this.find('.items-wrapper > .item'),
				$container_size: $this.find('.container-size'),
				$aspect: $this.find('.thz-aspect'),
				getDefaultItem: function () {
					return $defaultItem.clone().removeClass('default-item').addClass('item');
				}
			},

			data = JSON.parse(
				JSON.parse(nodes.$optionWrapper.attr('data-for-js')).join('{{') // check option php class
			),

			utils = {
				modal: new fw.OptionsModal({
					title: data.title,
					options: data.options,
					size : data.size
				}),

				countItems: function () {
					return nodes.$itemsWrapper.find('> .item').length;
				},

				removeDefaultItem: function () {
					nodes.$optionWrapper.find('.default-item:first').remove();
				},

				toogleNodes : function(){
					//utils.toogleItemsWrapper();
					utils.toogleAddButton();
					utils.toogleClone();
				},

				toogleItemsWrapper: function () {

					if (utils.countItems() === 0) {
						nodes.$itemsWrapper.hide();
					} else {
						nodes.$itemsWrapper.show();
					}

				},

				toogleAddButton: function(){
					if(data.limit !== 0 ){
						(utils.countItems() >= data.limit ) ?
							nodes.$addButton.hide() :
							nodes.$addButton.show();
					}
				},

				toogleClone: function(){
					if(data.limit !== 0 ){
						(utils.countItems() >= data.limit ) ?
							nodes.$itemsWrapper.addClass('hide-clone') :
							nodes.$itemsWrapper.removeClass('hide-clone');
					}
				},

				init: function () {
					
					utils.initItemsTemplates();
					utils.toogleNodes();
					utils.removeDefaultItem();
				},

				layerAction: function($layer, $values) {
					
					var container 		= nodes.$itemsWrapper;

					$layer.draggable({

						containment: 'document',
						snap:'.items-wrapper',
						snapTolerance:5,
						snapMode: "both",
        				start: function(e, ui) {
                   			$layer.addClass('noclick');
               			},
						stop: function(e, ui){ 
							utils.setLayerPosition($(this));
						}  
						
					});
					
					$layer.find('.item-in').resizable({

						handles: 'se',
						maxHeight: container.height(),
						maxWidth: container.width(),
						minWidth: 20,
						minHeight: 20,
        				start: function(e, ui) {
                   			$layer.addClass('noclick');
               			},
						resize: function(e, ui){ 
							utils.setLayerPosition($(this).parent());
						},
						stop: function(e, ui){ 
							utils.setLayerPosition($(this).parent());
						}
						
					}).rotatable({
						degrees: $values.layer_data.r,
						wheelRotate: false,
        				start: function(e, ui) {
                   			$layer.addClass('noclick');
               			},
						stop: function(e, ui){ 
							
							var angle = utils.getAngle( $layer.find('.item-in') );
							var current = JSON.parse( $layer.find('input').val() );
							current.layer_data.r = angle;
							$layer.find('input').attr('value', JSON.stringify(current));
							
							utils.setLayerPosition($(this).parent());
						}						
					});
					
					utils.setLayerPosition($layer, $values);
				},
				
				getAngle: function ($layer) {
					var matrix = $layer.css("-webkit-transform") ||
					$layer.css("-moz-transform")    ||
					$layer.css("-ms-transform")     ||
					$layer.css("-o-transform")      ||
					$layer.css("transform");
					if(typeof matrix === 'string' && matrix !== 'none') {
						var values = matrix.split('(')[1].split(')')[0].split(',');
						var a = values[0];
						var b = values[1];
						var angle = Math.round(Math.atan2(b, a) * (180/Math.PI));
					} else { var angle = 0; }
					return angle;
				},
				
				getLayerData: function($values) {
					
					return $values.layer_data;
					
				},
				
				setLayerPosition: function($layer, $values) {
		
					var self = this;
					
					$values = $values ? $values : false;
					
					var current 	= JSON.parse( $layer.find('input').val() );
					var $layer_data = $values ? utils.getLayerData($values) : utils.getLayerData(current);
					var $left 		= $values ? $layer_data.x : $layer.position().left / nodes.$itemsWrapper.width() * 100;
					var $top 		= $values ? $layer_data.y : $layer.position().top / nodes.$itemsWrapper.height() * 100;
					var $width 		= $values ? $layer_data.w : $layer.find('.item-in').width() / nodes.$itemsWrapper.width() * 100;
					var $height		= $values ? $layer_data.h : $layer.find('.item-in').height() / nodes.$itemsWrapper.height() * 100;
					var $zindex		= $layer_data.z;
					var $rotate		= $layer_data.r;
					
					if( !$values ){
						
						current.layer_data.x = $left;
						current.layer_data.y = $top;
						current.layer_data.w = $width;
						current.layer_data.h = $height;
						
						$layer.find('input').attr('value', JSON.stringify(current));

					}
					
					
					$layer.css({
						'position':'absolute',
						'top': $top + '%',
						'left': $left + '%',
						'width': $width + '%',
						'height': $height + '%',
						'z-index': $zindex,
					});
					
					$layer.find('.item-in').css({
						'transform': 'rotate('+$rotate+'deg)'
					});
					
					setTimeout(function(){
						$layer.removeClass('noclick');
					},100);
					
				},
				

				
				initItemsTemplates: function () {
					var $items = nodes.$itemsWrapper.find('> .item');

					if ($items.length > 0) {
						$items.each(function () {
							utils.editItem($(this), JSON.parse($(this).find('input').val()));
						});
					}
				},

				createItem: function (values) {
					var $clonedItem = nodes.getDefaultItem(),
						$clonedInput = $clonedItem.find('.input-wrapper');

					var $inputTemplate = $(
						$.trim($clonedInput.html())
							.split(
								nodes.$addButton.attr('data-increment-placeholder')
							)
							.join(utils.countItems())
					);
					
					$inputTemplate.find('input').attr('value', JSON.stringify(values));

					$clonedInput.children().first().replaceWith($inputTemplate);

					var template = '';

					try {
						/**
						 * may throw error in in template is used an option id
						 * added after some items was already saved
						 */
						values._layer_data = values.layer_data;
						values._layer = $clonedItem
						values._context = $clonedItem.find('.content');

						template = _.template(
							$.trim(data.template),
							undefined,
							{
								evaluate: /\{\{([\s\S]+?)\}\}/g,
								interpolate: /\{\{=([\s\S]+?)\}\}/g,
								escape: /\{\{-([\s\S]+?)\}\}/g
							}
						)(values);
					} catch (e) {
						template = '[Template Error] '+ e.message;
					}

					$clonedItem.find('.content').html(template);

					utils.layerAction($clonedItem, values);
					
					return $clonedItem;
				},

				addNewItem: function (values) {
					
					values.layer_data.z = utils.countItems() + 1;
					$new_item = utils.createItem(values);
					
					nodes.$itemsWrapper.append( $new_item );
				},

				
				editItem: function (item, values) {
					
					item.replaceWith( utils.createItem(values) );
	
				},
				
				setItemZ: function ($item, $mode){
					
					var current = JSON.parse( $item.find('input').val() );
					var $z	  	= parseInt( $item.css('z-index') );
					var $new_z  = $mode =='increase' ? $z + 1 : $z - 1;
					
					if( utils.countItems() == $new_z ){
						$new_z = utils.countItems();
					}	
					
					if( $new_z < 1 ){
						$new_z = 0;
					}

					$item.css('z-index', $new_z );
					
					current.layer_data.z = parseInt( $new_z );
					$item.find('input').attr('value', JSON.stringify(current));	
					
				}
			};

		nodes.$itemsWrapper.on('click', '.delete-item', function (e) {
			e.stopPropagation();
			e.preventDefault();
			$(this).closest('.item').remove();
			utils.toogleNodes();
			nodes.$optionWrapper.trigger('change'); // for customizer
			fw.options.trigger.changeForEl(nodes.$optionWrapper);
		});

		nodes.$itemsWrapper.on('click', '.clone-item', function (e) {
			e.stopPropagation();
			var $item  = $(this).closest('.item');
			var $vals  = JSON.parse($($item).find('input').val());
			utils.addNewItem($vals);
			utils.toogleNodes();
			nodes.$optionWrapper.trigger('change'); // for customizer
			fw.options.trigger.changeForEl(nodes.$optionWrapper);
		});
		
		
		nodes.$itemsWrapper.on('click', '.reset-rotation', function (e) {
			
			e.stopPropagation();
			
			var $item  = $(this).closest('.item');
			var current = JSON.parse( $item.find('input').val() );
			$item.find('.item-in').css('transform','rotate(0deg)' );
			
			current.layer_data.r = 0;
			$item.find('input').attr('value', JSON.stringify(current));	

		});
		
		nodes.$itemsWrapper.on('click', '.reset-all', function (e) {
			
			e.stopPropagation();
			
			var $item  = $(this).closest('.item');
			var current = JSON.parse( $item.find('input').val() );
			
			$item.css({
				'top':'0%',
				'left':'0%'  
			});
			
			$item.find('.item-in').css('transform','rotate(0deg)' );
			
			current.layer_data.x = 0;
			current.layer_data.y = 0;
			current.layer_data.r = 0;
			
			$item.find('input').attr('value', JSON.stringify(current));	

		});

		nodes.$itemsWrapper.on('click', '> .item', function (e) {
			
			if (! $(this).hasClass('noclick')) {
				
				e.preventDefault();
				
				var values = {};
				var $input = $(this).find('input');
	
				if ($input.length) {
					values = JSON.parse($input.val());
				}
	
				utils.modal.set('edit', true);
				utils.modal.set('values', values, {silent: true});
				utils.modal.set('itemRef', $(this));
				utils.modal.open();				
			}
			

		});

		nodes.$addButton.on('click', function () {
			utils.modal.set('edit', false);
			utils.modal.set('values', {}, {silent: true});
			utils.modal.open();
		});
		
		
		nodes.$container_size.on('change', function(){
			
			var $size = $(this).val();
			nodes.$aspect.removeClass (function (index, className) {
    			return (className.match (/(^|\s)thz-ratio-\S+/g) || []).join(' ');
			}).addClass($size);
			
		});

		nodes.$itemsWrapper.on('click', '.z-plus', function (e) {
			e.stopPropagation();
			e.preventDefault();
			
			var $this 	= $(this).closest('.item');
			utils.setItemZ($this,'increase');			
			
		});
		
		nodes.$itemsWrapper.on('click', '.z-minus', function (e) {
			
			e.stopPropagation();
			e.preventDefault();
			
			var $this 	= $(this).closest('.item');
			
			utils.setItemZ($this,'decrease');			
			
		});

		utils.modal.on('change:values', function (modal, values) {
			
			if (!modal.get('edit')) {
				
				utils.addNewItem(values);
				utils.toogleNodes();
				
				
			} else {
				
				utils.editItem(utils.modal.get('itemRef'), values);
				
			}

			nodes.$optionWrapper.trigger('change'); // for customizer
			fw.options.trigger.changeForEl(nodes.$optionWrapper);
		});

		_.map(
			[
				'open',
				'render',
				'close'
			],

			function (ev) {
				utils.modal.on(ev, _.partial(triggerEvent, ev));

				function triggerEvent (eventName, modal) {
					eventName = 'fw:option-type:thz-addable-layer:options-modal:' + eventName;
					fwEvents.trigger(eventName, { modal: this });
				}
			}
		);

		$this.on('remove', function(){ // fixes https://github.com/ThemeFuse/Unyson/issues/2167
			utils.modal.frame.$el.closest('.fw-modal').remove(); // remove modal from DOM
			nodes = data = utils = undefined; // clear memory
		});

		utils.init();
	};

	fwEvents.on('fw:options:init', function (data) {
		data.$elements
			.find('.fw-option-type-thz-addable-layer:not(.fw-option-initialized)').each(ThzaddableLayer)
			.addClass('fw-option-initialized');
	});
	
	fwEvents.on('fw:option-type:thz-addable-layer:options-modal:render', function (data) {
	  var frame = data.modal.frame.$el;
	  var ldata = frame.find('#fw-backend-option-fw-edit-options-modal-layer_data');
	  var inner = frame.find('#fw-options-tab-defaultstab');
	  inner.append(ldata);
	});

	fw.options.register('thz-addable-layer', {
		getValue: function (optionDescriptor) {
			var promise = $.Deferred();

			fw.whenAll(
				$(optionDescriptor.el).find(
					'> .fw-option-type-thz-addable-layer > .items-wrapper'
				).first().find(
					'> .item.fw-backend-options-virtual-context'
				).toArray().map(fw.options.getContextValue)
			).then(function (valuesAsArray) {
				promise.resolve({
					value: _.map(
						valuesAsArray,
						_.compose(JSON.parse, _.first, _.values, _.property('value'))
					),

					optionDescriptor: optionDescriptor
				})
			});

			return promise;
		},

		startListeningForChanges: $.noop
	});
	
})(jQuery, _, fwEvents, window);