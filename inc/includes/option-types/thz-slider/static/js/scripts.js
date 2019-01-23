(function ($, fwEvents) {
	var defaults = {
		onChange: function (data) {
			var from = (data.from_value) ? data.from_value : data.from;
			data.input.next('.fw-irs-range-slider-hidden-input').val(from);
			data.input.parent().parent().find('.thz-slider-custom').val(from);
			data.input.closest('.fw-option-type-thz-slider').find('span span.irs-slider.single').html(from);
			
		},
		onStart: function (data) {
			var from = (data.from_value) ? data.from_value : data.from;
			data.input.parent().parent().find('.thz-slider-custom').val(from);
			data.input.closest('.fw-option-type-thz-slider').find('span span.irs-slider.single').html(from);
			data.input.closest('.fw-option-type-thz-slider').find('.irs-bar-edge').remove();
		},
		onUpdate: function (data) {
			var from = (data.from_value) ? data.from_value : data.from;
			data.input.next('.fw-irs-range-slider-hidden-input').val(from);
			data.input.parent().parent().find('.thz-slider-custom').val(from);
			data.input.closest('.fw-option-type-thz-slider').find('span span.irs-slider.single').html(from);
			data.input.closest('.fw-option-type-thz-slider').find('.irs-bar-edge').remove();
		},
		onFinish: function (data) {
			data.input.parent().parent().find('.thz-slider-custom').trigger('thzslider');
		},
		grid: true
	};

	fwEvents.on('fw:options:init', function (data) {
		data.$elements.find('.fw-option-type-thz-slider:not(.thz-option-initialized)').each(function () {
			
			
			var options = JSON.parse($(this).attr('data-fw-irs-options'));
			
			var slider 	= $(this).find('.fw-irs-range-slider').ionRangeSlider(_.defaults(options, defaults));
			
			
			$(this).parent().parent().find('.thz-slider-custom').on('keyup', _.debounce(function () {
				
				var range 	= $(this).parent().parent().find('.fw-irs-range-slider').data("ionRangeSlider");
				
				var newvalue = $(this).val();
				
				if(newvalue > options.max){
					
					newvalue = options.from;	
				}
				
				range.update({
					from: newvalue,
				});

				$(this).trigger('thzslider');
				
			},300));

		}).addClass('thz-option-initialized');
	});

})(jQuery, fwEvents);