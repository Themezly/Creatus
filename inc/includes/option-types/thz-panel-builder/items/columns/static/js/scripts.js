jQuery(document).ready(function($) {

	fwEvents.on('fw-builder:'+ 'thz-panel-builder' +':register-items', function(builder){
	
	
		var widgetsOrder = fwThzPanelBuilder.setOrder(100);
		var currentItemType = 'columns';
		var localized = window['fw_thz_panel_builder_item_type_'+ currentItemType];
		var $inputid  = $(builder.$input).attr('id');
		
		function ColumnnLimit(){
		  
		
		var $stop =  false;
		
			if( $inputid.indexOf('side_panel') !== -1){
				
				var newindex = widgetsOrder.indexOf(true);
				
				if(newindex > 0){
					
					$stop =  true;
				}				
				
			}	
			
			return $stop;		  
		  
		}	
		
		var ColumnView = builder.classes.ItemView.extend({
	
				
				template: _.template(
					'<div class="pb-item-type-column pb-item has-options custom-column">' +
						'<div class="panel fw-row">' +
							'<div class="panel-left fw-col-xs-6">' +
								'<div class="column-title"><%- widget_name %></div>' +
								'<div class="width-changer"></div>' +
							'</div>' +
							'<div class="panel-right fw-col-xs-6">' +
								'<div class="controls">' +
									'<i class="dashicons dashicons-edit edit-column-options" data-hover-tip="<%- edit_tip %>"></i>' +
									'<i class="dashicons dashicons-admin-page column-item-clone" data-hover-tip="<%- clone_tip %>"></i>' +
									'<i class="dashicons dashicons-no column-item-delete" data-hover-tip="<%- delete_tip %>"></i>' +
								'</div>' +
							'</div>' +
						'</div>' +
						'<div class="builder-items"></div>' +
					'</div>'
				),
				events: {
					'click': 'onColumnWrapperClick',
					'click .edit-column-options': 'openColumnEdit',
					'click .column-item-clone': 'cloneItem',
					'click .column-item-delete': 'removeItem'
				},
				
				
			initialize: function() {
	
							
				var self = this;
				
				
				
				
				this.defaultInitialize();
				

/*				var ispanel = false;
	
				if( $inputid.indexOf('panel') !== -1){
					
					ispanel = true;
					
					var $newoptions = jQuery.extend(true, {}, this.model.modalOptions);
					 
					delete $newoptions[0].columneffectstab;
					delete $newoptions[0].columninlayouttab.options.useanchor;

					
				}*/
	
				// prepare edit options modal
				{
					this.modal = new fw.OptionsModal({
						title: localized.l10n.item_title,
						options: this.model.modalOptions ,
						values: this.model.get('options'),
						size: 'large'
					});
	
					this.listenTo(this.modal, 'change:values', function(modal, values) {
						this.model.set('options', values);
					});
	
					this.model.on('change:options', function() {
						this.modal.set(
							'values',
							this.model.get('options')
						);
					}, this);
				}
	
				this.widthChangerView = new FwBuilderComponents.ItemView.WidthChanger({
					model: this.model,
					view: this
				});
	
	
			},
			centerColumn :function ($options,$model){
					
				var column_options = $options;
				var centered;
				
				if (column_options && column_options.centered){
					centered = column_options.centered;
				}				
	
				
				if(centered == 'center'){
					
					jQuery($model.view.$el).addClass('thz-center-builder-column');
					
				}else{
					
					jQuery($model.view.$el).removeClass('thz-center-builder-column');
				}
				
			},
			render: function () {
				this.defaultRender({
				   label: fw.opg('label', this.model.get('options')) || localized.l10n.item_title,
				   clone_tip: localized.l10n.clone_tip,
				   edit_tip: localized.l10n.edit_tip,
				   delete_tip: localized.l10n.delete_tip,
				   widget_name:fw.opg('widget_name', this.model.get('options'))
				});
				this.centerColumn(this.model.get('options'),this.model);
				if (this.widthChangerView) {
					this.$('.width-changer').append(
						this.widthChangerView.$el
					);
					this.widthChangerView.delegateEvents();
				}
	
			},
			openColumnEdit: function(e) {
				
				
				if (!this.modal) {
					return;
				}
	
				var flow = {cancelModalOpening: false};
	
				/**
				 * Trigger before-open model just like we do this for
				 * item-simple shortcodes.
				 *
				 * http://bit.ly/1KY6tpP
				 */	
				 
				fwEvents.trigger('fw:builder:thz-column:modal:before-open', {
					modal: this.modal,
					model: this.model,
					builder: builder,
					flow: flow
				});
	
				if (! flow.cancelModalOpening) {
					this.modal.open();
				}
			},
			removeItem: function() {
				
				
				var self = this; 
	
				var deletedName = jQuery(this.el).find('.column-title').text().replace('Widget ','');
				
				
				widgetsOrder[deletedName - 1] = true;// this name is available
				
				
				this.remove();
	
				this.model.collection.remove(this.model);
				
				
				
			},
			
			 assignNewName: function (optionsSet){
				
				var self = this;
				//console.log(widgetsOrder);
				
				var newindex = widgetsOrder.indexOf(true);
				var widgetName = 'Widget '+ (newindex + 1);
				var options = _.clone(optionsSet.view.model.get('options'));
				fw.ops('widget_name', widgetName, options);
				optionsSet.view.model.set('options', options);	
	
				 
			 },
			 
			 
			 
			cloneItem: function(e) {
				
				var self = this;
				if(ColumnnLimit()){
					return false;
				}			
				e.stopPropagation();
	
				var index = this.model.collection.indexOf(this.model),
					attributes = this.model.toJSON(),
					_items = attributes['_items'],
					clonedColumn;
	
				delete attributes['_items'];
	
				clonedColumn = new Column(attributes);
				this.model.collection.add(clonedColumn, {at: index + 1});
				
				clonedColumn.get('_items').reset(_items);
				
				self.assignNewName(clonedColumn);
				
			},
	
			onColumnWrapperClick: function(e) {
				if (!this.$el.parent().length) {
					// The element doesn't exist in DOM. This listener was executed after the item was deleted
					return;
				}
				if (!fw.elementEventHasListenerInContainer(jQuery(e.srcElement).parent(), 'click', this.$el)) {
					this.openColumnEdit();
				}
			}
		});
	
	
		$(builder.$input).on('widgets:section:before:removed',function(event,section){
			
			var deletedColumns 	= $(section).find('.column-title');
			
			if (deletedColumns){
				$.each(deletedColumns,function(index,els){
					var deletedColumn = $(els).text().replace('Widget ','');
					widgetsOrder[deletedColumn - 1] = true;					
				});	
			}
			
		});
	
		var Column = builder.classes.Item.extend({
			
	
			defaults: function() {
				var defaults = _.clone(localized.defaults);
	
				defaults.shortcode = fwThzPanelBuilder.uniqueShortcode(defaults.type +'_');
	
				return defaults;
			},
			initialize: function() {
	
				
				var self = this;
				
				this.defaultInitialize();
	
				if (!this.get('width')) {
					this.set('width', '1_1');
				}			
				
				/**
				 * get options from wp_localize_script() variable
				 */
				this.modalOptions = localized.options;
	
				this.view = new ColumnView({
					id: 'fw-builder-item-'+ this.cid,
					model: this
				});
				
				setTimeout(function(){
					
					var newindex = widgetsOrder.indexOf(true);
					var widgetName = 'Widget '+ (newindex + 1);
					var options = _.clone(self.view.model.get('options'));
					var currentName = fw.opg('widget_name', options);
		
					if(currentName == ''){
						fw.ops('widget_name', widgetName, options);
						self.view.model.set('options', options);
						
					}
					
					var hasName = fw.opg('widget_name', options).replace('Widget ','') ;
					widgetsOrder[hasName -1] = false; // this name is taken
	
	
				}, 15);
				
	
			},
		
			allowIncomingType: function() {
				return false;
			},
			
			allowDestinationType: function(type) {
				
				
				
				if(ColumnnLimit()){
					return false;
				}
				
				if (type == 'section') {
					jQuery('#fw-backend-option-fw-option-wb_msg').hide();
					return true;
				} else {
					jQuery('#fw-backend-option-fw-option-wb_msg').show();
					return false;
				}
			}
			
			
		});
	
		builder.registerItemClass(Column);
	});
});