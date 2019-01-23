(function($, fwe) {

    fwe.on('fw:options:init', function(data) {
		
        data.$elements.find('.fw-option.fw-option-type-thz-hotspots:not(.thz-option-initialized)').each(function() {

            var $this = $(this).find('.thz-hotspots-generator');
			
			$this.ThzHotspots();
			

        }).addClass('thz-option-initialized');

    });

})(jQuery, fwEvents);