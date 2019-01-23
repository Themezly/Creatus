(function($, fwe) {

	function thzAssignToSelectize(element) {
	
		if ($(element).hasClass('selectized')){
			 return;
		}
	
		var xhr;
		var $select = $(element).selectize({
			plugins: ['remove_button'],
			delimiter: ',',
			options: [],
			create: false,
			onType: function(value) {
	
				if (value.length < 2) {
					return;
				}

				this.load(function(callback) {
	
					xhr && xhr.abort();
	
					var data = {
						action: 'thz_action_at_get_ajax_posts',
						searchTerm: value,
						thz_ast_nonce: thz_ast_vars.thz_ast_nonce,
						data: {
							searchTerm: value
						}
					};
	
					xhr = jQuery.post(
						ajaxurl,
						data,
						function(response) {
	
							thzAtSelectizeAdd(response.data,$select[0].selectize);				
							callback(response.data)

						}
					)
				});
	
			}
		});
		
		
		var selectize = $select[0].selectize;
	
		if ($(element).attr('data-current') && $(element).attr('data-current') != '') {
	
			var preload = JSON.parse($(element).attr('data-current'));
			
			selectize.load(function(callback) {
				callback(preload);
			});
			
			$.each(preload, function(index,object) {
	
				selectize.addItem(object.value);
	
			});
		}
	
	}
		
	
	function thzAtSelectizeAdd($items, $selectize){
		
		$.each($items, function(val,title) {

			$selectize.addOption({value: val, text: title});

		});		
		
	}

    fwe.on('fw:options:init', function(data) {
		
        data.$elements.find('.fw-option-type-thz-assign-to:not(.thz-option-initialized)').each(function() {

			var $this = $(this);
			var thisSelect = $this.find('select');
			
			thzAssignToSelectize( thisSelect );


        }).addClass('thz-option-initialized');

    });

})(jQuery, fwEvents);