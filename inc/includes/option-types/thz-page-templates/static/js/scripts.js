(function($, fwe) {

    fwe.on('fw:options:init', function(data) {
		
        data.$elements.find('.fw-backend-option-type-thz-page-templates:not(.thz-option-initialized)').each(function() {

			var $button =  $(this).find('.thz-add-page-template');
			
			$button.ThzPageTemplates();

        }).addClass('thz-option-initialized');

    });

})(jQuery, fwEvents);