/* globals jQuery, _, ajaxurl, auto_setup_data */
(function ($) {
	var autoSetupProcess;

	autoSetupProcess = {
		$infoContainer: null,
		initialize: function ($infoContainer) {

			autoSetupProcess.$infoContainer = $infoContainer;

			$(window).on('beforeunload', autoSetupProcess.onLeaveAlert);
			autoSetupProcess.activate_supported_extensions();
		},

		/*
		 @finished default is false
		 */
		showInfo: function (info, finished) {

			var processing = (_.isUndefined(finished)) ? ' ...' : '';
			autoSetupProcess.$infoContainer.append('<p>' + info + processing + '</p>');
		},

		processFailed: function (jqXHR, textStatus) {
			autoSetupProcess.showInfo(auto_setup_data['messages']['server_problems'], true);
			$(window).off('beforeunload', autoSetupProcess.onLeaveAlert);
		},

		checkResponse: function (response, nextStep) {
			if (response['success'] === true) {
				nextStep.call();
			} else {
				autoSetupProcess.showInfo(response['data']['message'], true);
				autoSetupProcess.showInfo('Please access this page later, it will be remain in menu.', true);
				$(window).off('beforeunload', autoSetupProcess.onLeaveAlert);
			}
		},

		activate_supported_extensions: function () {

			autoSetupProcess.showInfo(auto_setup_data['steps']['activate-supported-extensions']['message']);
			var data = {
				action: auto_setup_data['steps']['activate-supported-extensions']['ajax_action'],
				_ajax_nonce: auto_setup_data['steps']['activate-supported-extensions']['nonce']
			};
			return $.ajax({
				url: ajaxurl,
				type: 'POST',
				data: data,
				dataType: 'json'
			}).done(function (response) {
				autoSetupProcess.checkResponse(response, autoSetupProcess.finish_install_process);
			}).fail(autoSetupProcess.processFailed);
		},
		finish_install_process: function(){
			autoSetupProcess.showInfo(auto_setup_data['steps']['finish-install-process']['message']);
			var data = {
				action: auto_setup_data['steps']['finish-install-process']['ajax_action'],
				_ajax_nonce: auto_setup_data['steps']['finish-install-process']['nonce']
			};
			return $.ajax({
				url: ajaxurl,
				type: 'POST',
				data: data,
				dataType: 'json'
			}).done(function (response) {
				autoSetupProcess.checkResponse(response, autoSetupProcess.finishAutoSetupProcess);
			}).fail(autoSetupProcess.processFailed);
		},
		finishAutoSetupProcess: function () {
			$(window).off('beforeunload', autoSetupProcess.onLeaveAlert);
			var redirectUrl = !!auto_setup_data.import_demo_content_state ? auto_setup_data.demo_content_url : auto_setup_data.admin_url;
			autoSetupProcess.showInfo(auto_setup_data['messages']['process_completed'], true);
			window.location.replace(redirectUrl);
		},

		onLeaveAlert: function () {
			return auto_setup_data['messages']['on_leave_alert'];
		}
	};

	$(document).on('ready', function () {
		autoSetupProcess.initialize($('.wrap'));
	});


})(jQuery);