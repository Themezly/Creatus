(function($, fwe) {

    function thz_ucfirst(string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
    }
	
	
	function thz_import_reload(){
		
		var $exporttab = _fw_localized.SITE_URI + '/wp-admin/admin.php?page=fw-settings#fw-options-tab-exportimport';
		
		window.location.href = $exporttab;
		window.location.reload(true);
		
	}
	
    fwe.on('fw:options:init', function(data) {

        data.$elements.find('.fw-backend-option-type-thz-export-import:not(.thz-option-initialized)').each(function() {

            var $this 			= $(this);
            var $export 		= $this.find('.thz-export-settings');
            var $import 		= $this.find('.thz-import-settings');
			var $page_import 	= $this.find('.thz-import-page-settings');
            var $select 		= $this.find('select');
            var $current 		= $select.val();


            $import.on('click', function(e) {

                e.preventDefault();

                var $file = $('#thz-settings-import').prop('files')[0];

                if ( $file == undefined ) {
                    alert( _thzexpimp.importcustom );
                    return;
                }
				
				if($file.name){
					var isjson = $file.name.split('.').pop();
					if (  isjson !=='json' ) {
						alert( _thzexpimp.importcustom2 );
						return;
					}
				}

                var data = new FormData();
                data.append('file', $file);
                data.append('action', 'thz_settings_import');


                var importcustom_html = '<h2 class="fw-text-muted">';
                importcustom_html += '<img src="' + fw.img.loadingSpinner + '" alt="Loading" class="wp-spinner" /> ';
                importcustom_html += _thzexpimp.importcustom3;
                importcustom_html += '</h2>';
                importcustom_html += '<p class="fw-text-muted"><em>'+_thzexpimp.importcustom4+'</em></p>';


                fw.soleModal.show('thz_import_settings', importcustom_html, {
                    autoHide: 0,
                    width: 500,
                    height: 300,
                    allowClose: false,
                    backdrop: false,
                });


                $.ajax({
                    url: ajaxurl,
                    processData: false,
                    contentType: false,
                    data: data,
                    method: 'post',
                    dataType: 'json'
                }).done(function(r) {

                    if (r.success) {

                        //location.reload();
						thz_import_reload();

                    } else {
						
						fw.soleModal.hide('thz_import_settings');
                        try {
                            alert(r.data.message);
                        } catch (e) {
                            alert('Request failed');
                        }
                    }
					
					
                }).fail(function(jqXHR, textStatus, errorThrown) {
					
					fw.soleModal.hide('thz_import_settings');
					
                    alert('AJAX error: ' + String(errorThrown));
					
					
                }).always(function() {});


            });
			
			
            $(document).on("click", ".thz_cancel_page_import", function() {
                fw.soleModal.hide('thz_page_import_warning');
            });

            $page_import.on("click", function(e) {
				
				e.preventDefault();
				 
                var $page_id = $('.thz-import-from-pageid').val();
				
				if($page_id == ''){
					return;
				}
				
				var $title = $('.selectize-input [data-value="'+$page_id+'"] > .title').text();

                var modal_html = '<h2 class="fw-text-muted">';
                modal_html += _thzexpimp.pwarning + ' ' + thz_ucfirst($title);
                modal_html += '</h2>';
                modal_html += '<p class="fw-text-muted">' + _thzexpimp.pwarning2 + ' <strong>' + thz_ucfirst($title) + '</strong>';
                modal_html += '</br>' + _thzexpimp.pwarning3 + '</br>';
                modal_html += '<strong><em>' + _thzexpimp.pwarning4 + '</em></strong></br></br></p>';
                modal_html += '<a class="button thz_cancel_page_import">Cancel import</a></br></br></br>';
                modal_html += '<a class="button button-primary thz_proceed_with_page_import">' + _thzexpimp.pwarning5 + ' ' + thz_ucfirst($title) + '</a>';

                fw.soleModal.show('thz_page_import_warning', modal_html, {
                    autoHide: 0,
                    width: 500,
                    height: 300,
                    allowClose: false,
                    backdrop: false
                });

            });
			
			
            $(document).on("click", ".thz_proceed_with_page_import", function(e) {

                e.preventDefault();
				
				var $page_id = $('.thz-import-from-pageid').val();

				if($page_id == ''){
					return;
				}
				
				fw.soleModal.hide('thz_page_import_warning');
				 
                var data = new FormData();
                data.append('page_id', $page_id);
                data.append('action', 'thz_page_options_import');

                var importpage_html = '<h2 class="fw-text-muted">';
                importpage_html += '<img src="' + fw.img.loadingSpinner + '" alt="Loading" class="wp-spinner" /> ';
                importpage_html += _thzexpimp.importcustom5;
                importpage_html += '</h2>';
                importpage_html += '<p class="fw-text-muted"><em>'+_thzexpimp.importcustom4+'</em></p>';


                fw.soleModal.show('thz_import_page_settings', importpage_html, {
                    autoHide: 0,
                    width: 500,
                    height: 300,
                    allowClose: false,
                    backdrop: false,
                });


                $.ajax({
                    url: ajaxurl,
                    processData: false,
                    contentType: false,
                    data: data,
                    method: 'post',
                    dataType: 'json'
                }).done(function(r) {

                    if (r.success) {

						thz_import_reload();

                    } else {
						
						fw.soleModal.hide('thz_import_page_settings');
                        try {
                            alert(r.data.message);
                        } catch (e) {
                            alert('Request failed');
                        }
                    }
					
					
                }).fail(function(jqXHR, textStatus, errorThrown) {
					
					fw.soleModal.hide('thz_import_page_settings');
					
                    alert('AJAX error: ' + String(errorThrown));
					
					
                }).always(function() {});


            });


            $export.on('click', function(e) {

                var $this = $(this);

                if ($this.hasClass('continue_download')) {

                    $this.removeClass('continue_download');
                    return;

                } else {

                    e.preventDefault();
                }

                var saving_html = '<h2 class="fw-text-muted">';
                saving_html += '<img src="' + fw.img.loadingSpinner + '" alt="Loading" class="wp-spinner" /> ';
                saving_html += _thzexpimp.saving;
                saving_html += '</h2>';
                saving_html += '<p class="fw-text-muted"><em>' + _thzexpimp.saving2 + '</em></p>';

                fw.soleModal.show('thz_export_saving', saving_html, {
                    autoHide: 0,
                    width: 400,
                    height: 250,
                    allowClose: false,
                    backdrop: false,
                    afterOpen: function() {

                        fwEvents.trigger('fw:options:init:tabs', {
                            $elements: jQuery('.fw-settings-form')
                        });

						var $form = $('.fw-settings-form');
						var data = $form.serialize();
						
/*						var $submitButton = $form.find(':submit:focus');
						var data = $form.serialize() + ( $submitButton.length ? '&' + $submitButton.attr( 'name' ) + '=' + $submitButton.attr( 'value' ) : '' );
		
						if ( $form.attr( 'data-fw-form-id' ) === 'fw-settings-form:theme-settings' ) {
							data = {'fw_theme_settings_form': data};
						}*/

                        $.ajax({
                            type: 'post',
                            dataType: 'json',
                            url: ajaxurl,
                            data: data

                        }).done(function(data) {
							//$('.thz-export-preset-name').val('');
                            fw.soleModal.hide('thz_export_saving');

                        }).fail(function(jqXHR, textStatus, errorThrown) {
                            console.error(jqXHR, textStatus, errorThrown);
                        });

                    },
                    afterClose: function() {
                        $export.addClass('continue_download').trigger('click');
                    }

                });




            });


			if( $.fn.selectize ){
			
				$select.selectize({
					allowEmptyOption: false,
					onDropdownClose:function() {
						if(this.getValue() == '') {
							this.setValue( $current );
						}
					},
					maxItems: 1,
					closeAfterSelect: true,
					allowEmptyOption: false
				});
				
				var selectize = $select[0].selectize;
			
			}
			
            $(document).on("click", ".thz_cancel_import", function() {
                fw.soleModal.hide('thz_import_warning');
				
				if( $.fn.selectize ){
					selectize.setValue($current);
				}
				
                $select.val($current);
            });
			
            $select.on("change", function() {

                var $preset = $(this).val();

				if( $preset == $current  || $preset == '' ){
					return;
				}
				
                var modal_html = '<h2 class="fw-text-muted">';
                modal_html += _thzexpimp.warning + ' ' + thz_ucfirst($preset);
                modal_html += '</h2>';
                modal_html += '<p class="fw-text-muted">' + _thzexpimp.warning2 + ' <strong>' + thz_ucfirst($preset) + '</strong>';
                modal_html += '</br>' + _thzexpimp.warning3 + '</br>';
                modal_html += '<strong><em>' + _thzexpimp.warning4 + '</em></strong></br></p>';

                modal_html += '<a class="button thz_cancel_import">Cancel import</a>&nbsp;&nbsp;&nbsp;';
                modal_html += '<a class="button button-primary thz_proceed_with_import">' + _thzexpimp.warning5 + ' ' + thz_ucfirst($preset) + '</a>';

                fw.soleModal.show('thz_import_warning', modal_html, {
                    autoHide: 0,
                    width: 500,
                    height: 300,
                    allowClose: false,
                    backdrop: false
                });

            });




            $(document).on("click", ".thz_proceed_with_import", function() {


                var $preset = $this.find('select').val();
                fw.soleModal.hide('thz_import_warning');


                var loading_html = '<h2 class="fw-text-muted">';
                loading_html += '<img src="' + fw.img.loadingSpinner + '" alt="Loading" class="wp-spinner" /> ';
                loading_html += _thzexpimp.importing + ' ' + thz_ucfirst($preset);
                loading_html += '</h2>';
                loading_html += '<p class="fw-text-muted"><em>';
                loading_html += _thzexpimp.importing2;
                loading_html += '<br />';
                loading_html += _thzexpimp.importing3;
                loading_html += '</em></p>';

                fw.soleModal.show('thz_import_loading', loading_html, {
                    autoHide: 0,
                    allowClose: false,
                    backdrop: false
                });


                var reload_html = '<h2 class="fw-text-muted">';
                reload_html += '<img src="' + fw.img.loadingSpinner + '" alt="Loading" class="wp-spinner" /> ';
                reload_html += _thzexpimp.reloading;
                reload_html += '</h2>';
                reload_html += '<p class="fw-text-muted"><em>' + _thzexpimp.reloading2 + '</em></p>';



                $.ajax({
                    url: ajaxurl,
                    data: {
                        action: 'thz_import_preset',
                        preset: $preset
                    },
                    method: 'post',
                    dataType: 'json'
                }).done(function(r) {
                    if (r.success) {

                        fw.soleModal.show('thz_import_success', reload_html, {
                            autoHide: 2000,
                            allowClose: false,
                            backdrop: false
                        });

						thz_import_reload();


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
                    fw.soleModal.hide('thz_import_loading');
                });




            });
            $this.addClass('thz-option-initialized');
        });

    });

})(jQuery, fwEvents);