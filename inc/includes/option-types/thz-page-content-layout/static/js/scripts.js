(function($, fwe) {


	function thzPageSpinnerWidths (){
		
		
		var sum = 0;
		var is_warend = false;
		var element = $('.thz-page-content-layout-spinners-holder .thz-multi-holding-spinner:visible').find('.fw-option-type-thz-spinner');
		element.each(function() {
			if (!isNaN(this.value) && this.value.length != 0 && !is_warend) {
				sum += parseFloat(this.value);
			}
		});
		
		if( sum > 100 && !is_warend){
			
			element.animate({
				'background-color':'#E74C3C',
				'color':'#ffffff'
			},100,function(){
				
				is_warend = true;
				
			});
			
		}else if(sum < 100 && !is_warend){
			
			element.animate({
				'background-color':'#fff993',
				'color':'#837e2d'
			},100,function(){
				
				is_warend = true;
				
			});			
			
		}else{
			
			element.animate({
				'background-color': '#ffffff',
				'color':'#454545'
			},100,function(){
				
				is_warend = false;
				
			});					
			
		}
		
	}

    fwe.on('fw:options:init', function(data) {

        data.$elements.find('.fw-option-type-thz-page-content-layout:not(.thz-option-initialized)').each(function() {

            var $this 				= $(this);
			var $layout_type_list 	= $this.find('.thz-page-content-layout-layouts select');
			var $layouts_holder		= $this.find('.thz-page-content-layout-spinners-holder');
			var	$content_spinners	= $this.find('.fw-option-type-thz-spinner');
			
			$layout_type_list.on('change',function (){
				
				var $current_layout = $(this).val();
				$layouts_holder.removeClass('left right full left_content_right left_right_content content_left_right').addClass($current_layout);

				thzPageSpinnerWidths();

			}).trigger('change');
			
			
			$content_spinners.on('keydown keyup change',function (){
				thzPageSpinnerWidths();
			});	


            $this.addClass('thz-option-initialized');
        });

    });

})(jQuery, fwEvents);