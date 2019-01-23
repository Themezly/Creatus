/* globals jQuery, _, ajaxurl, auto_setup_data */
(function ($) {

	$(document).on('ready', function () {
		
		var $current_url = $('.update-plugins-btn').attr('href');
		var $count		 = $('.theme-plugins').length;
		

		 $(".update-all-plugins").on('click', function() {
			 $('.theme-plugins').not(this).prop('checked', this.checked).trigger('change');
		 });

		$('.theme-plugins').on('change',function (){
			
			var checkboxArray = $(".theme-plugins:not(:checked)").map(function() {
				return this.value;
			}).get();

			$qstring = JSON.stringify( Object.assign({}, checkboxArray));

			if( checkboxArray.length > 0){
				
				$new_url = $current_url + '&skip_plugins=' + $qstring;
				
				if( $count == checkboxArray.length ){
					
					$(".update-all-plugins").prop('checked',false);
					$('.postbox-holder .actions').hide();
					
				}else{
					
					$('.postbox-holder .actions').show();
				}
				
				$('.update-plugins-btn').attr('href', $new_url);
			
			}else{
				
				$('.postbox-holder .actions').show();
				$('.update-plugins-btn').attr('href',$current_url);
			
			}

			
		});	
		
			
	});


})(jQuery);