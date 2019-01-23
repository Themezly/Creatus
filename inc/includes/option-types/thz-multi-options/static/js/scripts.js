(function($, fwe) {

    fwe.on('fw:options:init', function(data) {

        data.$elements.find('.fw-option-type-thz-multi-options:not(.thz-option-initialized)').each(function() {

            var $this = $(this);
            var $box_style_button = $this.find('.thz-multi-options-box-style');


            if( $box_style_button.length > 0 ){

                  $box_style_button.each(function(i,el){

                      var $btn = $(this);
                      var $connect = $btn.attr('data-connect');

						$('#fw-backend-option-fw-edit-options-modal-' + $connect ).addClass('for-multi');
						$('#fw-backend-option-fw-option-' + $connect ).addClass('for-multi');
                      

                      $btn.on('click',function(e){
                        e.preventDefault();
						$('#fw-edit-options-modal-' + $connect).find('.item > .content.button').trigger('click');
						$('#fw-option-' + $connect).find('.item > .content.button').trigger('click');
                      });



                  });

            }

			var $values 		= $this.find('.thz-multi-options-group :input:not(.thz-spinner-units):not(.fake-input)');
			var $value_data 	= $this.find('.thz-value-data input');
			var $current_data 	= JSON.parse($value_data.val());

			$values.on('change keyup paste thz:spinner:real:input:changed',function(){

				var $input 	= $(this);
				var $name 	= $input.parents('.thz-multi-options-holder').attr('data-name');
				var $val 	= $input.val();

				$current_data[$name] = $val;

				$value_data.val(JSON.stringify($current_data));

			});

            $this.addClass('thz-option-initialized');
        });

    });

})(jQuery, fwEvents);
