(function($, fwe) {

    fwe.on('fw:options:init', function(data) {
		
        data.$elements.find('.fw-option.fw-option-type-thz-text-shadow:not(.thz-option-initialized)').each(function() {

            var $this 	= $(this);
		    var $holder = $this.find('.thz-text-shadows-holder');
			
			
			if($this.hasClass('isboxed')){
				
				 var $shadowsbox	= $this.parents('.thz-box-holding-text-shadow');
				 var $trigger 		= $shadowsbox.find('.thz-show-text-shadow');
				 
				 $trigger.on('click',function () {
					$holder.ThzTextShadow();
				 });
				 				
			}else{
			
				$holder.ThzTextShadow();
			
			}

        }).addClass('thz-option-initialized');

    });

})(jQuery, fwEvents);