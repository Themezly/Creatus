(function ($, _, plugins, fw) {
	var demoInstall = {
		wrapId: '#fw-ext-backups-demo-list',
		$link: '',
		$loadingImage: '<img src="' + fw.SITE_URI + '/wp-admin/images/spinner.gif" alt="Loading" class="wp-spinner">',
		init: function () {
			$(this.wrapId).on('click', '[data-install]', function (e) {
				e.preventDefault();
				demoInstall.$link = $(this);
				var demoId = $(this).data('install');
				if (!demoInstall.$link.data('stop-propagation') && plugins['demo_plugins'][demoId] !== undefined) {
					e.stopImmediatePropagation();
					$(this).data('stop-propagation', true);

					var confirm_message = $(this).attr('data-confirm');

					if (confirm_message) {
						if (!confirm(confirm_message)) {
							demoInstall.$link.removeData('stop-propagation');
							return;
						}
					}

					demoInstall.activate_plugins(demoId);
				}
			});
		},
		activate_plugins: function (demoId) {
			if (plugins['demo_plugins'][demoId] !== undefined) {
				var data = {
					action: plugins['steps']['activate-demo-plugins']['ajax_action'],
					_ajax_nonce: plugins['steps']['activate-demo-plugins']['nonce'],
					demo_plugins: plugins['demo_plugins'][demoId]
				};

				fw.soleModal.show('fw-demo-content-install-plugins',
					'<h2 class="fw-text-muted">' +
					demoInstall.$loadingImage +
					'&nbsp;' + plugins.messages.installing + '&nbsp;</h2><p class="fw-text-muted"><em>' + plugins.messages.start_activate_plugins + '</em></p>', {
						updateIfCurrent: true,
						showCloseButton: false,
						allowClose: false
					});

				$.ajax({
					url: ajaxurl,
					type: 'POST',
					data: data,
					dataType: 'json'
				}).done(function (response) {

					$.get(plugins.admin_url + '?fake=true', function () {
						var success_message = '<h2 class="fw-text-muted">' + demoInstall.$loadingImage + '&nbsp;' + plugins.messages.installing + '&nbsp;</h2>' +
							'<p class="fw-text-muted"><em>' + plugins.messages.finish_activate_plugins + '</em></p>';
						var $html = response['success'] ? success_message : '<p class="fw-text-danger">' + response.data.message + '</p>';

						fw.soleModal.show('fw-demo-content-install-plugins', $html, {
							updateIfCurrent: true,
							showCloseButton: false,
							allowClose: true
						});

						_.delay(function () {
							fw.soleModal.hide('fw-demo-content-install-plugins');
						}, 1000);

						if (response['success']) {
							demoInstall.$link.removeAttr('data-confirm');
							demoInstall.$link.trigger('click');
							demoInstall.$link.removeData('stop-propagation');
						} else {
							demoInstall.alertSoleModal(response.data.message);
							demoInstall.$link.removeData('stop-propagation');
						}
					});

				}).fail(demoInstall.processFailed);
			}
		},
		processFailed: function (jqXHR, textStatus, errorThrown) {
			var message = String(errorThrown);

			if (jqXHR.responseText &&
				(
				jqXHR.responseText.indexOf('Fatal error') > -1 ||
				jqXHR.responseText.indexOf('Parse error') > -1 ||
				jqXHR.responseText.indexOf('Notice') > -1
				)
			) {
				message = $(jqXHR.responseText).text();
			}

			demoInstall.alertSoleModal(message);
			demoInstall.$link.removeData('stop-propagation');

		},
		alertSoleModal: function (message) {
			fw.soleModal.show('fw-demo-content-install-plugins', '<p class="fw-text-danger">' + String(message) + '</p>', {
				updateIfCurrent: true,
				showCloseButton: true,
				autoHide: 10000
			});
		}
	};

	$(document).ready(function () {
		demoInstall.init();
	});
})(jQuery, _, demo_plugins, fw);