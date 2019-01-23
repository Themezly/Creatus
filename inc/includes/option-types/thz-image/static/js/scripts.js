(function($, fwe) {

	var init = function() {

		var $this = $(this);
		var $select_button 	= $this.find('.thz-select-image');
		var $input 			= $this.find('.thz-image-input');
		var $real_input 	= $this.find('.thz-image-data');
		
		try{	
			var $real_input_val	= JSON.parse($real_input.val());
			
		}catch (error){
			
			var $real_input_val = [];
			
		};
		
		if($real_input_val  == null ){
			
			$real_input_val = [];
			
		}
		
		var $thumb			= $this.find('.thz-thumb img');
		var thz_media_frame;

		var thzMakeFrame = function (){


			thz_media_frame = wp.media.frames.thz_media_frame = wp.media({

				className: 'media-frame thz-media-frame',
				frame: 'post',
				state:    'insert',
				multiple: false,
				title: thz_image.title,
				library: {
					type: 'image'
				}

			});


			$(thz_media_frame.$el).on( 'click','.thumbnail', function() {
				var $sizes = $(thz_media_frame.$el).find('.media-frame-content select.size');
				if($sizes.length > 0){
					$sizes.val('full');
				}
	     	});

			thz_media_frame.on('open', function() {

				var selection = thz_media_frame.state().get('selection'),
					attatchmentId = $real_input_val['id'],
					attachment = wp.media.attachment(attatchmentId);

				thz_media_frame.reset();
				if (attatchmentId) {
					selection.add(attachment);
				}
			});

			thz_media_frame.on('insert', function(){

				var media_attachment = thz_media_frame.state().get('selection').first().toJSON();

				if( media_attachment.sizes.thumbnail ){

					var thumb_url = media_attachment.sizes.thumbnail.url;

				}else{

					var thumb_url = media_attachment.sizes.full.url;
				}

				var $sizes = $(thz_media_frame.$el).find('.media-frame-content select.size');
				var $media_url = media_attachment.url;


				if($sizes.length > 0){

						var $current_size = $sizes.val();
						 	$media_url = media_attachment.sizes[$current_size].url;

				}

				$input.val($media_url).attr('data-imageid',media_attachment.id).trigger('change');
				$thumb.attr('src',thumb_url);
				$this.find('.thz-remove-image').addClass('show_button');
				$this.find('.thz-thumb').addClass('hasImage');
				$this.find('.use-featured').attr('checked', false);
				
				
				var $realinput_val = {};
				
				$realinput_val['id'] = media_attachment.id;
				$realinput_val['url']= $media_url;
				$realinput_val['size'] = $current_size;
				
				$real_input.val(JSON.stringify($realinput_val)).trigger('change');
				
				
			});

		};


		if( $real_input_val['url'] =='featured' ){
			$thumb.attr('src',$thumb.attr('data-featured-image'));
			$this.parents('.thz-boxstyle-holder').find('.thz-box-style-preview').addClass('thz-bg-featuerd-image');
		}

		$select_button.on('click', function(e){

			e.preventDefault();

			if (!thz_media_frame) {
				thzMakeFrame();
			}
			thz_media_frame.open();

		});


		$this.on('click', '.thz-thumb img', function() {
			$select_button.trigger('click');
		});

		$this.on('click', '.thz-remove-image', function() {
			$input.val('').attr('data-imageid','').trigger('change');
			$thumb.attr('src',$thumb.attr('data-noimage'));

			$(this).removeClass('show_button');
			$this.find('.thz-thumb').removeClass('hasImage');
			
			var $realinput_val = [];
			$real_input.val(JSON.stringify($realinput_val)).trigger('change');
		});


		$this.on('change', '.use-featured', function() {

			var $featured = '';

			if($(this).is(":checked")) {

				$featured = 'featured';
				$thumb.attr('src',$thumb.attr('data-featured-image'));
				$this.find('.thz-remove-image').removeClass('show_button');
				$this.find('.thz-thumb').removeClass('hasImage');
				$this.parents('.thz-boxstyle-holder').find('.thz-box-style-preview').addClass('thz-bg-featuerd-image');
				
				var $realinput_val = {};
				
				$realinput_val['id'] = 0;
				$realinput_val['url']= $featured;
				$realinput_val['size'] = 'full';
				$real_input.val(JSON.stringify($realinput_val)).trigger('change');

			}else{

				$thumb.attr('src',$thumb.attr('data-noimage'));

				$this.parents('.thz-boxstyle-holder').find('.thz-box-style-preview').removeClass('thz-bg-featuerd-image');
				
				var $realinput_val = [];
				$real_input.val(JSON.stringify($realinput_val)).trigger('change');

			}
			$input.val($featured).trigger('change');
			

		});



	};


	fwe.on('fw:options:init', function(data) {
		data.$elements.find('.fw-option-type-thz-image:not(.thz-option-initialized)').each(init).addClass('thz-option-initialized');
	});

})(jQuery, fwEvents);
