
jQuery(document).ready(function($) {

   fwEvents.on('fw-builder:' + 'thz-panel-builder' + ':register-items', function(builder) {
	   
	  var sectionsOrder = fwThzPanelBuilder.setOrder(50);
      var currentItemType = 'section';
      var localized = window['fw_thz_panel_builder_item_type_' + currentItemType];
	  var $inputid  = $(builder.$input).attr('id');
	  
	  
	  
	  function SectionLimit(){
		  
		var $stop =  false;
		var newindex = sectionsOrder.indexOf(true);
		if(newindex > 0){
			$stop =  true;
		}		 
		return $stop;		  
		  
	  }

      var SectionView = builder.classes.ItemView.extend({
		
		template: _.template(
			'<div class="pb-item-type-column pb-item custom-section">' +
				'<div class="panel fw-row">' +
					'<div class="panel-left fw-col-xs-6">' +
						'<div class="section-title"><%- section_name %></div>' +
					'</div>' +
					'<div class="panel-right fw-col-xs-6">' +
						'<div class="controls">' +
							'<i class="dashicons dashicons-edit edit-section-options" data-hover-tip="<%- edit_tip %>"></i>' +
							'<i class="dashicons dashicons-admin-page custom-section-clone" data-hover-tip="<%- clone_tip %>"></i>' +
							'<i class="dashicons dashicons-no custom-section-delete" data-hover-tip="<%- delete_tip %>"></i>' +
						'</div>' +
					'</div>' +
				'</div>' +
				'<div class="builder-items"></div>' +
			'</div>'
		),
         events: {
            'click': 'onSectionWrapperClick',
            'click .edit-section-options': 'openSectionEdit',
            'click .custom-section-clone': 'cloneItem',
            'click .custom-section-delete': 'removeItem',
         },
		 
		 checklimit: function (){
			 

		 },
		 
         initialize: function() {
			
	
            this.defaultInitialize();
			
			var ispanel = false;

			if( $inputid.indexOf('side_panel') !== -1){
				
				ispanel = true;
				
				var $newoptions = _.clone(this.model.modalOptions);

				delete $newoptions[0].sectionlayouttab.options.section_contained;
				
			}
			

            // prepare edit options modal
            {
               this.modal = new fw.OptionsModal({
                  title: localized.l10n.item_title,
                  options: ispanel ? $newoptions : this.model.modalOptions ,
                  values: this.model.get('options'),
                  size: 'large',
				  modalCustomClass: 'modal-'+$inputid
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

			
         },

         render: function() {
				
			if(this.checklimit()){
				return;
			}				

            this.defaultRender({
               label: fw.opg('label', this.model.get('options')) || localized.l10n.item_title,
               clone_tip: localized.l10n.clone_tip,
			   edit_tip: localized.l10n.edit_tip,
               delete_tip: localized.l10n.delete_tip,
               section_name:fw.opg('section_name', this.model.get('options'))
            });


            if (this.labelInlineEditor) {
               this.$('.fw-form-item-preview-label-edit').append(
                  this.labelInlineEditor.$el
               );
               this.labelInlineEditor.delegateEvents();
            }
         },

		 assignNewName: function (optionsSet){

			var newindex = sectionsOrder.indexOf(true);
			var sectionName = 'Section '+ (newindex + 1);
			var options = _.clone(optionsSet.view.model.get('options'));
			fw.ops('section_name', sectionName, options);
			optionsSet.view.model.set('options', options);	
			 
		 },
		 
         cloneItem: function(e) {
			 
			 
			var self = this;
			 
			if(SectionLimit()){
				return false;
			}
			
			
            e.stopPropagation();
			
			
            var index = this.model.collection.indexOf(this.model),
               attributes = this.model.toJSON(),
               _items = attributes['_items'],
               clonedSection;

            delete attributes['_items'];

            clonedSection = new Section(attributes);
            this.model.collection.add(clonedSection, {
               at: index + 1
            });

            clonedSection.get('_items').reset(_items);
			
			self.assignNewName(clonedSection);
			
		 },

         openSectionEdit: function() {
            this.modal.open();
         },
         removeItem: function() {
			 
			 
			var self = this; 
			
			$(builder.$input).trigger('widgets:section:before:removed', [$(this.el)]);
			
			var deletedName 	= $(this.el).find('.section-title').text().replace('Section ','');
			sectionsOrder[deletedName - 1] = true;// this name is available

            this.remove();

            this.model.collection.remove(this.model);
			
			
         },

         onSectionWrapperClick: function(e) {
            if (!this.$el.parent().length) {
               // The element doesn't exist in DOM. This listener was executed after the item was deleted
               return;
            }
            if (!fw.elementEventHasListenerInContainer(jQuery(e.srcElement).parent(), 'click', this.$el)) {
               this.openSectionEdit();
            }
         }
      });

      var Section = builder.classes.Item.extend({


		

         defaults: function() {
            var defaults = _.clone(localized.defaults);

            defaults.shortcode = fwThzPanelBuilder.uniqueShortcode(defaults.type + '_');

            return defaults;
         },
		 
		 
		 
		 
         initialize: function() {
			 
			 
			 
			 var self = this;
			 
			 
            this.defaultInitialize();


			
            /**
             * get options from wp_localize_script() variable
             */
            this.modalOptions = localized.options;

            this.view = new SectionView({
               
			   id: 'fw-builder-item-' + this.cid,
               model: this
			   
            });

			setTimeout(function(){
				
				var newindex = sectionsOrder.indexOf(true);
				var sectionName = 'Section '+ (newindex + 1);
				var options = _.clone(self.view.model.get('options'));
				var currentName = fw.opg('section_name', options);
	
				if(currentName == ''){
					fw.ops('section_name', sectionName, options);
					//self.view.model.set('options', options);
					
				}
				
				var panelName = 'top_panel';
				
				if( $inputid.indexOf('bottom_panel') !== -1){
					
					panelName = 'bottom_panel';
					
				}else if( $inputid.indexOf('side_panel') !== -1){
					
					panelName = 'side_panel';
					
				}
				
				fw.ops('panel_name', panelName, options);
				self.view.model.set('options', options);
				
				
				
				
				var hasName = fw.opg('section_name', options).replace('Section ','') ;
				sectionsOrder[hasName -1] = false; // this name is taken

			}, 15);
				
		
         },

		 
			allowIncomingType: function (type) {
				jQuery('#fw-backend-option-fw-option-wb_msg').hide();

				return 'section' !== type;
			},
			allowDestinationType: function (type) {
				jQuery('#fw-backend-option-fw-option-wb_msg').hide();
				
				if(SectionLimit()){
					return false;
				}
				
				return 'columns' !== type;
			}		

      });
  		
		
		
      builder.registerItemClass(Section);
   });
 

});