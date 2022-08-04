jQuery(document).ready(function( $ ) {

	function IDGenerator() {
		this.length = 8;
		this.timestamp = +new Date;

		var _getRandomInt = function( min, max ) {
			return Math.floor( Math.random() * ( max - min + 1 ) ) + min;
		}

		this.generate = function() {
			var ts = this.timestamp.toString();
			var parts = ts.split( "" ).reverse();
			var id = "";

			for( var i = 0; i < this.length; ++i ) {
				var index = _getRandomInt( 0, parts.length - 1 );
				id += parts[index];	 
			}

			return id;
		}
	}

	// Elementor Form

	$(document).on('keyup change', '[data-pafe-form-abandonment].elementor-widget-form [name^="form_fields"]', function() {
		var $form = $(this).closest('.elementor-form'),
			formId = $form.attr('name'),
			fieldValue = $(this).val(),
			fieldID = $(this).attr('name').replace('form_fields[','').replace(']','').replace('[]',''),
			abandonmentID = 'pafe-form-abandonment-' + formId;

		if ($(this).attr('type') == 'checkbox') {
			if ($(this).attr('name').includes('[]')) {
				fieldValue = [];
				$form.find('[name="form_fields[' + fieldID + '][]"]').each(function(){
					if ($(this).is(':checked')) {
						fieldValue.push($(this).val());
					}
				});
			} else {
				if (!$(this).is(':checked')) {
					fieldValue = '';
				}
			}
		}

		if (localStorage[abandonmentID]) {
			var pafeFormAbandonmentData = JSON.parse(localStorage.getItem(abandonmentID));
			pafeFormAbandonmentData[fieldID] = fieldValue;
		} else {
			var userIdObject = new IDGenerator(),
				userId = userIdObject.generate();

			var pafeFormAbandonmentData = { userId : userId, form_id : formId };
			pafeFormAbandonmentData[fieldID] = fieldValue;
		}

		localStorage.setItem(abandonmentID, JSON.stringify(pafeFormAbandonmentData));
	});

	// PAFE Form Builder

	$(document).on('keyup change', '[data-pafe-form-builder-form-id]', function() {
		var formId = $(this).attr('data-pafe-form-builder-form-id');

		if ($('[data-pafe-form-abandonment] [data-pafe-form-builder-submit-form-id="' + formId + '"]').length > 0) {
			var	fieldValue = $(this).val(),
				fieldID = $(this).attr('name').replace('form_fields[','').replace(']','').replace('[]',''),
				abandonmentID = 'pafe-form-abandonment-' + formId;

			if ($(this).attr('type') == 'checkbox') {
				if ($(this).attr('name').includes('[]')) {
					fieldValue = [];
					var $form = $(this).closest('form');
					$form.find('[name="form_fields[' + fieldID + '][]"]').each(function(){
						if ($(this).is(':checked')) {
							fieldValue.push($(this).val());
						}
					});
				} else {
					if (!$(this).is(':checked')) {
						fieldValue = '';
					}
				}
			}

			if (localStorage[abandonmentID]) {
				var pafeFormAbandonmentData = JSON.parse(localStorage.getItem(abandonmentID));
				pafeFormAbandonmentData[fieldID] = fieldValue;
			} else {
				var userIdObject = new IDGenerator(),
					userId = userIdObject.generate();

				var pafeFormAbandonmentData = { userId : userId, form_id : formId };
				pafeFormAbandonmentData[fieldID] = fieldValue;
			}

			localStorage.setItem(abandonmentID, JSON.stringify(pafeFormAbandonmentData));
		}
	});

	// Elementor Form

	$('[data-pafe-form-abandonment].elementor-widget-form .elementor-form').each(function() {
		var formId = $(this).attr('name'),
			abandonmentID = 'pafe-form-abandonment-' + formId,
			$fields = $(this).find('[name^="form_fields"]');

		if (localStorage[abandonmentID]) {
			var pafeFormAbandonmentData = JSON.parse(localStorage.getItem(abandonmentID));

			$fields.each(function(){
				var fieldType = $(this).attr('type');
				var fieldID = $(this).attr('name').replace('form_fields[','').replace(']','').replace('[]','');

				if (fieldType == 'radio') {
					if (pafeFormAbandonmentData[fieldID] !== undefined && $(this).attr('value') == pafeFormAbandonmentData[fieldID]) {
						$(this).prop('checked', true);
					}
				} else if (fieldType == 'checkbox') {
					if (pafeFormAbandonmentData[fieldID] !== undefined) {
						if ($(this).attr('name').includes('[]')) {
							if (pafeFormAbandonmentData[fieldID].includes($(this).attr('value'))) {
								$(this).prop('checked', true);
							}
						} else {
							if ($(this).attr('value') == pafeFormAbandonmentData[fieldID]) {
								$(this).prop('checked', true);
							}
						}
					}
				} else {
					if (pafeFormAbandonmentData[fieldID] !== undefined) {
						$(this).val(pafeFormAbandonmentData[fieldID]);
					}
				}
				
			});
		}
	});

	// PAFE Form Builder

	$('[data-pafe-form-abandonment] [data-pafe-form-builder-submit-form-id]').each(function() {
		var formId = $(this).attr('data-pafe-form-builder-submit-form-id'),
			abandonmentID = 'pafe-form-abandonment-' + formId,
			$fields = $('[data-pafe-form-builder-form-id][name^="form_fields"]');

		if (localStorage[abandonmentID]) {
			var pafeFormAbandonmentData = JSON.parse(localStorage.getItem(abandonmentID));

			$fields.each(function(){
				var fieldType = $(this).attr('type');
				var fieldID = $(this).attr('name').replace('form_fields[','').replace(']','').replace('[]','');

				if (fieldType == 'radio') {
					if (pafeFormAbandonmentData[fieldID] !== undefined && $(this).attr('value') == pafeFormAbandonmentData[fieldID]) {
						$(this).prop('checked', true);
					}
				} else if (fieldType == 'checkbox') {
					if (pafeFormAbandonmentData[fieldID] !== undefined) {
						if ($(this).attr('name').includes('[]')) {
							if (pafeFormAbandonmentData[fieldID].includes($(this).attr('value'))) {
								$(this).prop('checked', true);
							}
						} else {
							if ($(this).attr('value') == pafeFormAbandonmentData[fieldID]) {
								$(this).prop('checked', true);
							}
						}
					}
				} else {
					if (pafeFormAbandonmentData[fieldID] !== undefined) {
						$(this).val(pafeFormAbandonmentData[fieldID]);
					}
				}
				
			});
		}
	});

	// Elementor Form

	$(document).on('submit_success', function(event, response){
		let $webhook_attr = $('[data-pafe-form-abandonment-webhook]');
		let webhook_url = $webhook_attr.length > 0 ? $webhook_attr.attr('data-pafe-form-abandonment-webhook') : false;
		var formId = event.target.name,
			abandonmentID = 'pafe-form-abandonment-' + formId;

		if (localStorage[abandonmentID]) {

			var pafeFormAbandonmentData = JSON.parse(localStorage.getItem(abandonmentID));

			var data = new FormData();

			data.append('action', 'pafe_form_abandonment');
			data.append('fields', JSON.stringify(pafeFormAbandonmentData));
			data.append('form_type', 'Elementor Form');
			data.append('function', 'success');
			data.append('webhook', webhook_url);

			navigator.sendBeacon($('[data-pafe-ajax-url]').data('pafe-ajax-url'), data);

			localStorage.removeItem(abandonmentID);
		}
	});

	// PAFE Form Builder

	$(document).on('click','[data-pafe-form-builder-trigger-success]',function(){
		let $webhook_attr = $('[data-pafe-form-abandonment-webhook]');
		let webhook_url = $webhook_attr.length > 0 ? $webhook_attr.attr('data-pafe-form-abandonment-webhook') : false;
		var formId = $(this).attr('data-pafe-form-builder-trigger-success'),
			abandonmentID = 'pafe-form-abandonment-' + formId;

		if (localStorage[abandonmentID]) {

			var pafeFormAbandonmentData = JSON.parse(localStorage.getItem(abandonmentID));

			var data = new FormData();

			data.append('action', 'pafe_form_abandonment');
			data.append('fields', JSON.stringify(pafeFormAbandonmentData));
			data.append('form_type', 'PAFE Form');
			data.append('function', 'success');
			data.append('webhook', webhook_url);

			navigator.sendBeacon($('[data-pafe-ajax-url]').data('pafe-ajax-url'), data);

			localStorage.removeItem(abandonmentID);
		}
	});	

	function pafeAbandonment(event) {
		$('[data-pafe-form-abandonment].elementor-widget-form .elementor-form').each(function() {
			let $webhook_attr = $('[data-pafe-form-abandonment-webhook]');
			let webhook_url = $webhook_attr.length > 0 ? $webhook_attr.attr('data-pafe-form-abandonment-webhook') : false;
			event == 'blur' ? webhook_url = false : '';
			var formId = $(this).attr('name'),
			abandonmentID = 'pafe-form-abandonment-' + formId;

			if (localStorage[abandonmentID]) { 

				var pafeFormAbandonmentData = JSON.parse(localStorage.getItem(abandonmentID));

				var data = new FormData();

				data.append('action', 'pafe_form_abandonment');
				data.append('fields', JSON.stringify(pafeFormAbandonmentData));
				data.append('form_type', 'Elementor Form');
				data.append('function', 'abandonment');
				data.append('webhook', webhook_url);

				navigator.sendBeacon($('[data-pafe-ajax-url]').data('pafe-ajax-url'), data);
			}
		});

		$('[data-pafe-form-abandonment] [data-pafe-form-builder-submit-form-id]').each(function() {
			let $webhook_attr = $('[data-pafe-form-abandonment-webhook]');
			let webhook_url = $webhook_attr.length > 0 ? $webhook_attr.attr('data-pafe-form-abandonment-webhook') : false;
			event == 'blur' ? webhook_url = false : '';
			var formId = $(this).attr('data-pafe-form-builder-submit-form-id'),
			abandonmentID = 'pafe-form-abandonment-' + formId;

			if (localStorage[abandonmentID]) { 

				var pafeFormAbandonmentData = JSON.parse(localStorage.getItem(abandonmentID));

				var data = new FormData();

				data.append('action', 'pafe_form_abandonment');
				data.append('fields', JSON.stringify(pafeFormAbandonmentData));
				data.append('form_type', 'PAFE Form');
				data.append('function', 'abandonment');
				data.append('webhook', webhook_url);

				navigator.sendBeacon($('[data-pafe-ajax-url]').data('pafe-ajax-url'), data);
			}
		});
	}

	$(window).on('blur beforeunload', function(e) {
		pafeAbandonment(e.type);
	});

});