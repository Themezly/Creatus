(function($, fwe) {

    fwe.on('fw:options:init', function(data) {
		
        data.$elements.find('.fw-option.fw-option-type-thz-typography:not(.thz-option-initialized)').each(function() {
				
			var $this = $(this); 
			
			$this.find('.thz-fontbox').ThzTypo();
			
			$this.find('.thz-font-color').on('fw:thz:color:picker:changed', function(e) {
				
				if($(this).closest('.thz-fontbox').find('#thz-font-selector').length){
				
					$(this).closest('.thz-fontbox').ThzTypo('ThzChange');
				}

			});


        }).addClass('thz-option-initialized');

    });

})(jQuery, fwEvents);