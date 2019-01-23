(function($, fwe) {

    fwe.on('fw:options:init', function(data) {
		
        data.$elements.find('.fw-option.fw-option-type-thz-url:not(.thz-option-initialized)').each(function() {

            var $this = $(this).find('.thz-url');
			
			$this.ThzAddLink();
			

        }).addClass('thz-option-initialized');

    });

})(jQuery, fwEvents);