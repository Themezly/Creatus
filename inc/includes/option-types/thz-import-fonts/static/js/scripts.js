(function($, fwe) {
	
	function thz_fetch_typekit_fonts($this){
		
		var $kit_token = $('.thz-typekit-token').val();
		var $ids = $('.thz-typekit-id');
		var $kit_ids = [];
		
		if($ids.length < 1 || $kit_token == ''){
			
			$('.thz-typekit-list').html('');
			$this.find('.font-input').val(JSON.stringify([]));
			
			return;
			
		}
		
		$ids.each(function(index, element) {
			$kit_ids.push($(element).val());
		});
		
		
		$('.thz-typekit-list').addClass('loading');
		
		$.ajax({
			url: ajaxurl,
			data: {
				action: 'thz_build_typekit_list',
				kit_token: $kit_token,
				kit_ids: $kit_ids,
				nonce: _thzimportfonts.importsnonce,
			},
			method: 'post',
			dataType: 'json'
		}).done(function(r) {
			
			if (r.success) {
				
				
				var $fonts  = JSON.stringify(r.data.fonts);
				
				if($fonts !== 'false'){
					
					$('.thz-typekit-list').html(r.data.list);
					$this.find('.font-input').val($fonts);
					
				}else{
					
					$('.thz-typekit-list').html(_thzimportfonts.typekit_input);
					$this.find('.font-input').val(JSON.stringify([]));
				}
				
				

			} else {
				try {
					alert(r.data.message);
				} catch (e) {
					alert('Request failed');
				}
			}
			
		}).fail(function(jqXHR, textStatus, errorThrown) {
			alert('AJAX error: ' + String(errorThrown));
		}).always(function() {
            $('.thz-typekit-list').removeClass('loading');
        });		
		
		
	}
	
	function thz_fsq_list( $this ){
		
		thz_fsq_downloaded_fonts( $this );
		
		$this.find('.category-link').on('click',function(e){
		
			e.preventDefault();
			
			var category = $(this).attr('data-filter');
			$this.find('.fonts li').addClass('inactive');
			$this.find('.fonts ' + category).removeClass('inactive');
			
		});	
		
		
		$this.find('.download-font').on('click',function(e){
		
			e.preventDefault();
			var $family_urlname = $(this).attr('data-font');
			thz_get_fsq_fontface_kit( $family_urlname , $this);
		});	
		
		
		$this.find('.delete-font').on('click',function(e){
		
			e.preventDefault();
			var $family_urlname = $(this).attr('data-font');
			thz_delete_fsq_fontface_kit( $family_urlname, $this );
		});	
	  
	  
		var $fsearch = $this.find('.fsearch');
		
		$fsearch.hideseek({
			highlight: true,
			nodata: 'No results found'
		});
		
		$fsearch.on("keyup", function(){
			$(this).parent().addClass('searching');
		});
		
		$('.clear-fsearch').on("click", function(e){
			e.preventDefault();
			 var kp = jQuery.Event("keyup"); 
			 kp.which = kp.keyCode = 8;
			$fsearch.val('').trigger(kp);
			$fsearch.parent().removeClass('searching');
			$this.find('.fonts li').attr('style','');
			$this.find('.Blackletter .category-link').trigger('click');
		});

		
	}
	
	
	function thz_get_fsq_fontface_kit($family_urlname, $this){
		
		$('.' + $family_urlname).addClass('loading');
				
		$.ajax({
			url: ajaxurl,
			data: {
				action: 'thz_get_fsq_fontface_kit',
				family_urlname: $family_urlname,
				nonce: _thzimportfonts.importsnonce,
			},
			method: 'post',
			dataType: 'json'
		}).done(function(r) {
			
			if (r.success) {
				
				
				if( r.data.fonts ){
				
					$('.' + $family_urlname).removeClass('loading').addClass('is-down');
					$('.' + $family_urlname + ' .download-font').addClass('hide-icon');
					$('.' + $family_urlname + ' .delete-font').removeClass('hide-icon');
					
					thz_fsq_downloaded_fonts( $this );
				
				}else{
					
					$('.' + $family_urlname).removeClass('loading').addClass('is-down');
					$this.find(".downloaded-fonts").append('<span class="cant-proceed">'+ _thzimportfonts.cantdownload +'</span>');	
					
				}

			} else {
				try {
					alert(r.data.message);
				} catch (e) {
					alert('Request failed');
				}
			}
			
		}).fail(function(jqXHR, textStatus, errorThrown) {
			alert('AJAX error: ' + String(errorThrown));
		}).always(function() {
            $('.thz-typekit-list').removeClass('loading');
        });		
		
		
	}
	
	
	function thz_delete_fsq_fontface_kit($family_urlname, $this){
		
		$('.' + $family_urlname).addClass('loading');
				
		$.ajax({
			url: ajaxurl,
			data: {
				action: 'thz_delete_fsq_fontface_kit',
				family_urlname: $family_urlname,
				nonce: _thzimportfonts.importsnonce,
			},
			method: 'post',
			dataType: 'json'
		}).done(function(r) {
			
			if (r.success) {
				
				
				if( r.data.removed ){
					
					$('.' + $family_urlname).removeClass('loading is-down');
					$('.' + $family_urlname + ' .download-font').removeClass('hide-icon');
					$('.' + $family_urlname + ' .delete-font').addClass('hide-icon');
					
					thz_fsq_downloaded_fonts( $this );
					
				}else{
					
					$('.' + $family_urlname).removeClass('loading').addClass('is-down');
					$this.find(".downloaded-fonts").append('<span class="cant-proceed">'+ _thzimportfonts.cantdelete +'</span>');	
					
				}


			} else {
				try {
					alert(r.data.message);
				} catch (e) {
					alert('Request failed');
				}
			}
			
		}).fail(function(jqXHR, textStatus, errorThrown) {
			alert('AJAX error: ' + String(errorThrown));
		}).always(function() {
            $('.thz-typekit-list').removeClass('loading');
        });		
		
		
	}
	
	
	function thz_fsq_downloaded_fonts( $this ){

		var $list 				= '';
		var $donws 				= $this.find(".is-down");
		var $donws_container 	= $this.find(".downloaded-fonts");
		
		if($donws.length > 0){
			
			$donws_container.addClass('has-fonts');
			$list +='<span class="downloaded-title"> '+_thzimportfonts.downloaded_title+' </span>';
			
		}else{
			
			$donws_container.removeClass('has-fonts');
		}
		
		$donws.each(function(index, element) {
			var $name = $(this).attr('data-name');
			$list +='<a href="#" class="downloaded">'+$name+'</a>';
        });
		
		$donws_container.html( $list );
		
		$this.find('.downloaded').on('click',function(e){
			e.preventDefault();
			var $search = $(this).text();

			$this.find('.fsearch').val( $search ).trigger('keyup');
		});
	}
	
	
    fwe.on('fw:options:init', function(data) {
		
        data.$elements.find('.fw-option.fw-option-type-thz-import-fonts:not(.thz-option-initialized)').each(function() {
				
			var $this = $(this); 
			
			if($this.hasClass('typekit')){
				
				$(document).on('input', '.thz-typekit-input', function() {
					
					thz_fetch_typekit_fonts($this);
					
				});
				
				$(document).on('click', '.fw-x', function() {
					
					thz_fetch_typekit_fonts($this);
					
				});
			}
			
			
			if($this.hasClass('fontsquirrel')){
				
				thz_fsq_list($this);
				
			}

        }).addClass('thz-option-initialized');

    });
	
})(jQuery, fwEvents);