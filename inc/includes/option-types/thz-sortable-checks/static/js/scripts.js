(function($, fwe) {
	
	
	function initSortable ($element) {
		try {
			$element.sortable('destroy');
		} catch (e) {
			// happens when sortable was not initialized before
		}
		
		$axis = $element.hasClass('thz-sortable-inline') ? 'x' : 'y';
		
		if($element.parents('.fw-backend-option-design-customizer').length){
			
			$element.removeClass('thz-sortable-inline').addClass('thz-sortable-vertical')
			$axis ='y';
		}
		
		$element.sortable({

			cursor: 'move',
			distance: 2,
			tolerance: 'pointer',
			forcePlaceholderSize: true,
			axis: $axis,
			start: function(e, ui){
				// Update the height of the placeholder to match the moving item.
				{
					var height = ui.item.outerHeight();

					ui.placeholder.height(height);
					
				}
			},

			stop: function( event, ui ) {
				triggerSorting($(this));
			}

		});

	}
	
	
	function triggerSorting($element){
		
		
		var $sorder = [];
		
		$element.find('.thz-sort-choice').each(function(index, element) {
			
			var $order_title = $(this).attr('data-order');
			
			if ($(this).find('input.thz-sort-checkbox').is(':checked')) {
			
				$sorder.push($order_title);
			
			}else{
				
				var index = $sorder.indexOf($order_title);	
				if (index > -1) {
					$sorder.splice(index, 1);
				}						
			}
			
		});

		$element.parent().find('.thz-sortable-input').val(JSON.stringify($sorder));
		$element.trigger('change');// for customizer
		$sorder = [];		
		
	}	
	
    fwe.on('fw:options:init', function(data) {
		
        data.$elements.find('.fw-option .thz-sortable-checks:not(.thz-option-initialized)').each(function() {

			var $this = $(this);
			
			initSortable($this);
			
			$this.find('input.thz-sort-checkbox').on('change',function() {
				triggerSorting($this);
			});
			

        }).addClass('thz-option-initialized');

    });

})(jQuery, fwEvents);