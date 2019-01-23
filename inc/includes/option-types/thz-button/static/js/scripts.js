(function($, fwe) {

    fwe.on('fw:options:init', function(data) {
		
        data.$elements.find('.fw-option.fw-option-type-thz-button:not(.thz-option-initialized)').each(function() {

            var $this = $(this).find('.thz-button-generator');
			
			$this.ThzButtonGenerator();
			

        }).addClass('thz-option-initialized');

    });

})(jQuery, fwEvents);