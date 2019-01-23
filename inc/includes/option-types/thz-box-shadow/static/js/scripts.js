(function($, fwe) {

    fwe.on('fw:options:init', function(data) {
		
        data.$elements.find('.fw-option.fw-option-type-thz-box-shadow:not(.thz-option-initialized)').each(function() {

            var $this = $(this).find('.thz-shadows-holder');
			
			$this.ThzBoxShadow();

        }).addClass('thz-option-initialized');

    });

})(jQuery, fwEvents);