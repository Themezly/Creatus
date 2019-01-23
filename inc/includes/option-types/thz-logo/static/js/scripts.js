(function($, fwe) {
	
	
	var showOptions = function () {
		
			var $this = $(this);
			
			
			
			
			var loadTemplate = function (groupId,callback){
				
				$choicesToReveal = $this.find(groupId);
				if ($choicesToReveal.attr('data-options-template')) {
					$choicesToReveal.html(
						$choicesToReveal.attr('data-options-template')
					);

					$choicesToReveal.removeAttr('data-options-template');

					fwEvents.trigger('fw:options:init', {
						$elements: $choicesToReveal
					});
				}	
				
			};
			
			
			$this.find('.thz-option-logo-type .fw-option-type-thz-radio :radio').on('change', function (e) {
				
				var $textual = $(this).closest('.fw-inner').find('.thz-template-logo-textual');
				var $image 	 = $(this).closest('.fw-inner').find('.thz-template-logo-image');
				var $svg 	 = $(this).closest('.fw-inner').find('.thz-template-logo-svg');
				
				var $value = $(this).filter(':checked').val();

				if ($value === 'textual'){
					
					loadTemplate('.thz-template-logo-textual');
					$image.hide();
					$svg.hide();	
					$textual.show();
					
				}
				
				if ($value === 'image'){
					
					loadTemplate('.thz-template-logo-image');
					$textual.hide();
					$svg.hide();	
					$image.show();				
				}
				
				
				if ($value === 'svg'){
					
					loadTemplate('.thz-template-logo-svg');
					$textual.hide();
					$image.hide();
					$svg.show();
					
				}
				
				
													
			}).trigger('change');
			
			
	};


	fwe.on('fw:options:init', function(data) {
		data.$elements.find('.fw-option-type-thz-logo:not(.thz-option-initialized)').each(showOptions).addClass('thz-option-initialized');
	});

})(jQuery, fwEvents);
