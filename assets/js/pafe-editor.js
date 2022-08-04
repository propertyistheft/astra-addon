// (function ($) {

// 	var WidgetPafeFormBuilderHandlerDate = function ($scope, $) {

//         var $elements = $scope.find('.elementor-date-field');

// 		if (!$elements.length) {
// 			return;
// 		}

// 		var addDatePicker = function addDatePicker($element) {
// 			if ($($element).hasClass('elementor-use-native')) {
// 				return;
// 			} 
// 			var options = {
// 				minDate: $($element).attr('min') || null,
// 				maxDate: $($element).attr('max') || null,
// 				allowInput: true
// 			};
// 			$element.flatpickr(options);
// 		};

// 		$.each($elements, function (i, $element) {
// 			addDatePicker($element);
// 		});

//     };

//     var WidgetPafeFormBuilderHandlerTime = function ($scope, $) {

// 	    var $elements = $scope.find('.elementor-time-field');

// 		if (!$elements.length) {
// 			return;
// 		}

// 		var addTimePicker = function addTimePicker($element) {
// 			if ($($element).hasClass('elementor-use-native')) {
// 				return;
// 			}
// 			$element.flatpickr({
// 				noCalendar: true,
// 				enableTime: true,
// 				allowInput: true
// 			});
// 		};
// 		$.each($elements, function (i, $element) {
// 			addTimePicker($element);
// 		});

// 	};

// 	$(window).on('elementor/frontend/init', function () {

//         elementor.hooks.addAction( 'panel/open_editor/widget/slider', function( panel, model, view ) {
// 			var $element = view.$el.find( '.elementor-selector' );

// 			if ( $element.length ) {
// 				$element.click( function() {
// 					alert( 'Some Message' );
// 				} );
// 			}
// 		} );

//     });

// })(jQuery);

function pafeGenerateElementID(length) {
	var result           = 'p';
	var characters       = 'abcdefghijklmnopqrstuvwxyz';
	var charactersLength = characters.length;
	for ( var i = 0; i < length - 1; i++ ) {
		result += characters.charAt(Math.floor(Math.random() *
			charactersLength));
	}
	return result;
}

function pafeReplaceID(str) {
	str = str.replace(new RegExp('0', 'g'), 'a');
	str = str.replace(new RegExp('1', 'g'), 'b');
	str = str.replace(new RegExp('2', 'g'), 'c');
	str = str.replace(new RegExp('3', 'g'), 'd');
	str = str.replace(new RegExp('4', 'g'), 'e');
	str = str.replace(new RegExp('5', 'g'), 'f');
	str = str.replace(new RegExp('6', 'g'), 'g');
	str = str.replace(new RegExp('7', 'g'), 'h');
	str = str.replace(new RegExp('8', 'g'), 'i');
	str = str.replace(new RegExp('9', 'g'), 'j');

	return str;
}

jQuery(document).ready(function( $ ) {
	elementor.hooks.addAction( 'panel/open_editor/widget/pafe-form-builder-field', function( panel, model, view ) {
		var $element = panel.$el.find( '.elementor-form-field-shortcode' ),
			$fieldID = panel.$el.find( '[data-setting="field_id"]' ),
			elementID = pafeReplaceID(model.attributes.id);

		if ( $element.length ) {
			var id = $fieldID.val().trim();
			if (id != '') {
				$element.val('[field id="' + id + '"]');
			} else {
				$element.val('');
				$fieldID.val(elementID).change();
				$element.val('[field id="' + elementID + '"]');
			}
		}

		$fieldID.on('change, keyup',function(){
			var id = $fieldID.val().trim();
			if (id != '') {
				$element.val('[field id="' + id + '"]');
			} else {
				$element.val('');
			}
		});
	} );

	elementor.hooks.addAction( 'panel/open_editor/widget/pafe-form-booking', function( panel, model, view ) {
		var $element = panel.$el.find( '.elementor-form-field-shortcode' ),
			$fieldID = panel.$el.find( '[data-setting="pafe_form_booking_id"]' );

		if ( $element.length ) {
			var id = $fieldID.val().trim();
			if (id != '') {
				$element.val('[field id="' + id + '"]');
			} else {
				$element.val('');
			}
		}

		$fieldID.on('change, keyup',function(){
			var id = $fieldID.val().trim();
			if (id != '') {
				$element.val('[field id="' + id + '"]');
			} else {
				$element.val('');
			}
		});
	} );

	elementor.hooks.addAction( 'panel/open_editor/widget/pafe-form-builder-field', function( panel, model, view ) {
		var $element = panel.$el.find( '.pafe-form-builder-live-preview-code' ),
			$fieldID = panel.$el.find( '[data-setting="field_id"]' ),
			$image_preview = panel.$el.find( '.pafe-form-builder-live-preview-image' ),
			$image_preview_w = panel.$el.find( '[data-setting="live_preview_image_width"]' ),
			$image_preview_h = panel.$el.find( '[data-setting="live_preview_image_height"]' );
		if($image_preview_h.length){
			var id = $fieldID.val().trim();
			if (id != '') {
				$image_preview.val('<div class="pafe-live-preivew-image" data-pafe-form-builder-live-preview="' + id + '" data-image-width="'+$image_preview_w.val()+'" data-image-height="'+$image_preview_h.val()+'"></div>');
			} else {
				$image_preview.val('');
			}
		}
		($image_preview_w, $image_preview_h).on('change, keyup', function(){
			var id = $fieldID.val().trim();
			if (id != '') {
				$image_preview.val('<div class="pafe-live-preivew-image" data-pafe-form-builder-live-preview="' + id + '" data-image-width="'+$image_preview_w.val()+'" data-image-height="'+$image_preview_h.val()+'"></div>');
			} else {
				$image_preview.val('');
			}
		});
		if ( $element.length ) {
			var id = $fieldID.val().trim();
			if (id != '') {
				$element.val('<span data-pafe-form-builder-live-preview="' + id + '"></span>');
			} else {
				$element.val('');
			}
		}

		$fieldID.on('change, keyup',function(){
			var id = $fieldID.val().trim();
			if (id != '') {
				$element.val('<span data-pafe-form-builder-live-preview="' + id + '"></span>');
			} else {
				$element.val('');
			}
		});
	} );

	elementor.hooks.addAction( 'panel/open_editor/section', function( panel, model, view ) {
		
		panel.$el.on('click', function(){
			var $element = panel.$el.find( '.elementor-form-field-shortcode' ),
			$fieldID = panel.$el.find( '[data-setting="pafe_form_builder_repeater_id"]' ),
			$shortcode = panel.$el.find( '.elementor-control-pafe_form_builder_repeater_shortcode' );

			if ( $element.length ) {
				var id = $fieldID.val() == undefined ? '' : $fieldID.val().trim();
				if ($fieldID.val() !== undefined) {
					if (id != '') {
						$element.val('[repeater id="' + id + '"]');
					} else {
						$element.val('');
					}
				}
			}

			$fieldID.on('click, change, keyup',function(){
				var id = $fieldID.val() == undefined ? '' : $fieldID.val().trim();
				if ($fieldID.val() !== undefined) {
					if (id != '') {
						$element.val('[repeater id="' + id + '"]');
					} else {
						$element.val('');
					}
				}
			});

			$shortcode.on('click',function(){
				var id = $fieldID.val() == undefined ? '' : $fieldID.val().trim();
				if ($fieldID.val() !== undefined) {
					if (id != '') {
						$element.val('[repeater id="' + id + '"]');
					} else {
						$element.val('');
					}
				}
			});
		});
		
	} );

	elementor.hooks.addAction( 'panel/open_editor/column', function( panel, model, view ) {
		
		panel.$el.on('click', function(){
			var $element = panel.$el.find( '.elementor-form-field-shortcode' ),
			$fieldID = panel.$el.find( '[data-setting="pafe_form_builder_repeater_id"]' ),
			$shortcode = panel.$el.find( '.elementor-control-pafe_form_builder_repeater_shortcode' );

			if ( $element.length ) {
				var id = $fieldID.val().trim();
				if (id != '') {
					$element.val('[repeater id="' + id + '"]');
				} else {
					$element.val('');
				}
			}

			$fieldID.on('click, change, keyup',function(){
				var id = $fieldID.val().trim();
				if (id != '') {
					$element.val('[repeater id="' + id + '"]');
				} else {
					$element.val('');
				}
			});

			$shortcode.on('click',function(){
				var id = $fieldID.val().trim();
				if (id != '') {
					$element.val('[repeater id="' + id + '"]');
				} else {
					$element.val('');
				}
			});
		});
		
	} );

	$(document).on('click','[data-pafe-campaign-get-data-list]', function() {
		$(document).find('[data-pafe-campaign-get-data-list]').addClass('loading');
		var $parent = $(this).closest('#elementor-controls');
		var $results = $parent.find('[data-pafe-campaign-get-data-list-results]');
		var campaign = $parent.find( '[data-setting="activecampaign_api_key_source"]' ).val();
		if(campaign == 'custom'){
			campaign_url = $parent.find( '[data-setting="activecampaign_api_url"]' ).val();
			campaign_key = $parent.find( '[data-setting="activecampaign_api_key"]' ).val();
		}else{
			campaign_url = false;
			campaign_key = false;
		}
		var data = {
			'action': 'pafe_campaign_select_list',
			'campaign_url': campaign_url,
			'campaign_key': campaign_key,
		};
		$.post(ajaxurl, data, function(response) {
			if(response){
				$results.html(response);
				$parent.find('[data-setting="activecampaign_list"]').change();
				$(document).find('[data-pafe-campaign-get-data-list]').removeClass('loading');
			}
		});
	});

	$(document).on('keyup, change','[data-setting="activecampaign_list"]', function() {
		var $parent = $(this).closest('#elementor-controls');
		var campaign = $parent.find( '[data-setting="activecampaign_api_key_source"]' ).val();
		var listId = $(this).val();
 		if(campaign == 'custom'){
			campaign_url = $parent.find( '[data-setting="activecampaign_api_url"]' ).val();
			campaign_key = $parent.find( '[data-setting="activecampaign_api_key"]' ).val();
		}else{
			campaign_url = false;
			campaign_key = false;
		}
		var data = {
			'action': 'pafe_campaign_fields',
			'campaign_url': campaign_url,
			'campaign_key': campaign_key,
			'list_id': listId
		};
		$.post(ajaxurl, data, function(response) {
			if(response){
				$parent.find('[data-pafe-campaign-get-fields]').html(response);
			}
		});
	});

	//Hubspot
	$(document).on('click','[data-pafe-hubspot-get-property-list]', function() {
		$('[data-pafe-hubspot-get-property-list]').addClass('loading');
		let $parent = $(this).closest('#elementor-controls');
		let hubspotGroup = $parent.find( '[data-setting="pafe_hubspot_group_key"]' ).val();
		let data = {
			'action': 'pafe_hubspot_contact_property_list',
			'group' : hubspotGroup,
		};
		$.post(ajaxurl, data, function(response) {
			if(response){
				$('.pafe-hubspot-property-list').html(response);
				$('[data-pafe-hubspot-get-property-list]').removeClass('loading');
			}
		});
	});

	$(document).on('click','[data-pafe-hubspot-get-group-list]', function() {
		console.log('1')
		$('[data-pafe-hubspot-get-group-list]').addClass('loading');
		var data = {
			'action': 'pafe_hubspot_group_list',
		};
		$.post(ajaxurl, data, function(response) {
			if(response){
				$('.pafe-hubspot-group-list').html(response);
				$('[data-pafe-hubspot-get-group-list]').removeClass('loading');
			}
		});
	});

	//get response
	$(document).on('click','[data-pafe-getresponse-get-data-list]', function() {
		$('[data-pafe-getresponse-get-data-list]').addClass('loading');
		var $parent = $(this).closest('#elementor-controls');
		var getresponseApi = $parent.find( '[data-setting="getresponse_api_key_source"]' ).val();
		if(getresponseApi == 'custom'){
			var getresponseApiKey = $parent.find( '[data-setting="getresponse_api_key"]' ).val();
		}else{
			var getresponseApiKey = false;
		}
		var data = {
			'action': 'pafe_getresponse_select_list',
			'api': getresponseApiKey,
		};
		$.post(ajaxurl, data, function(response) {
			if(response){
				$('#pafe-getresponse-list').html(response);
				$('[data-pafe-getresponse-get-data-list]').removeClass('loading');
			}
		});
	});

	$(document).on('click','[data-pafe-getresponse-get-data-custom-fields]', function() {
		$('[data-pafe-getresponse-get-data-custom-fields]').addClass('loading');
		var $parent = $(this).closest('#elementor-controls');
		var getresponseApi = $parent.find( '[data-setting="getresponse_api_key_source"]' ).val();
		if(getresponseApi == 'custom'){
			var getresponseApiKey = $parent.find( '[data-setting="getresponse_api_key"]' ).val();
		}else{
			var getresponseApiKey = false;
		}
		var data = {
			'action': 'pafe_getresponse_custom_fields',
			'api' : getresponseApiKey
		}
		$.post(ajaxurl, data, function(response) {
			if(response){
				$('#pafe-getresponse-custom-fields').html(response);
				$('[data-pafe-getresponse-get-data-custom-fields]').removeClass('loading');
			}
		});
	});

	//mailchip v3
	$(document).on('click', '[data-pafe-mailchimp-get-data-list]', function(){
		$(this).addClass('loading');
		var $parent = $(this).closest('#elementor-controls');
		var mailchimp_api = $parent.find('[data-setting="mailchimp_api_key_source_v3"]').val();
		if(mailchimp_api == 'custom'){
			var api_key = $parent.find('[data-setting="mailchimp_api_key_v3"]').val();
		}else{
			var api_key = false;
		}
		var data = {
			'action': 'pafe_mailchimp_select_list',
			'api': api_key,
		};
		$.post(ajaxurl, data, function(response) {
			if(response){
				$('[data-pafe-mailchimp-get-data-list-results]').html(response);
				$('[data-pafe-mailchimp-get-data-list]').removeClass('loading');
			}
		});
	});

	$(document).on('click', '[data-pafe-mailchimp-get-group-and-field]', function(){
		$(this).attr('disabled', 'disabled');
		$(this).addClass('loading');
		var $parent = $(this).closest('#elementor-controls');
		var listId = $parent.find('[data-setting="mailchimp_list_id"]').val();
		var mailchimp_api = $parent.find('[data-setting="mailchimp_api_key_source_v3"]').val();
		if(mailchimp_api == 'custom'){
			var api_key = $parent.find('[data-setting="mailchimp_api_key_v3"]').val();
		}else{
			var api_key = false;
		}
		var data_fields = {
			'action': 'pafe_mailchimp_merge_fields',
			'api': api_key,
			'list_id': listId
		};
		var data_groups = {
			'action': 'pafe_mailchimp_get_groups',
			'api': api_key,
			'list_id': listId
		}
		$.post(ajaxurl, data_groups, function(response) {
			if(response){
				$('[data-pafe-mailchimp-get-groups]').html(response);
			}
		});
		$.post(ajaxurl, data_fields, function(response) {
			if(response){
				$('[data-pafe-mailchimp-get-data-merge-fields]').html(response);
				$('[data-pafe-mailchimp-get-group-and-field]').removeClass('loading');
				$('[data-pafe-mailchimp-get-group-and-field]').removeAttr('disabled');
			}
		});
	});

	//SendGrid
	$(document).on('click', '[data-pafe-twilio-sendgrid-get-data-list]', function(){
		$(this).attr('disabled', 'disabled');
		$(this).addClass('loading');
		var $parent = $(this).closest('#elementor-controls');
		var apiKey = $parent.find('[data-setting="twilio_sendgrid_api_key"]').val();
		var dataSendgrid = {
			'action': 'pafe_twilio_sendgrid_get_list',
			'api': apiKey
		}
		$.post(ajaxurl, dataSendgrid, function(response) {
			if(response){
				$('[data-pafe-twilio-sendgrid-get-data-list-results]').html(response);
				$('[data-pafe-twilio-sendgrid-get-data-list]').removeClass('loading');
			}
		});
	});

	// Mailpoet
	$(document).on('click', '[data-piotnet-mailpoet-get-custom-fields]', function(){
		$(this).addClass('loading');
		var data = {
			action: 'pafe_mailpoet_get_custom_fields'
		}
		$.post(ajaxurl, data, function(response) {
			if(response){
				$('[data-piotnet-mailpoet-result-custom-field]').html(response);
				$('[data-piotnet-mailpoet-get-custom-fields]').removeClass('loading');
			}
		})
	});
	//Zoho
	$(document).on('click', '[data-pafe-zohocrm-get-tag-name]', function(){
		$(this).addClass('loading');
		$parent = $(this).closest('#elementor-controls');
		var module = $parent.find('[data-setting="zohocrm_module"]').val();
		module = module == 'custom' ? $parent.find('[data-setting="zohocrm_custom_module"]').val() : module;
		var zoho_data = {
			action: 'zoho_get_tag_name',
			module: module
		}
		$.post(ajaxurl, zoho_data, function(response){
			$('#pafe-zohocrm-tag-name').html(response);
			$('[data-pafe-zohocrm-get-tag-name]').removeClass('loading');
		});
	});
	//Mailerlite
	$(document).on('click', '[data-pafe-mailerlite_api_get_groups]', function(){
		$(this).addClass('loading');
		const parent = $(this).closest('#elementor-controls');
		var mailerliteType = parent.find('[data-setting="mailerlite_api_key_source_v2"]').val();
		if(mailerliteType === 'default'){
			var mailerliteApiKey = false;
		}else{
			var mailerliteApiKey = parent.find('[data-setting="mailerlite_api_key_v2"]').val();
		}
		var mailerlite_groups = {
			action: 'mailerlite_get_groups',
			apiKey: mailerliteApiKey
		}
		$.post(ajaxurl, mailerlite_groups, function(response) {
			if(response){
				$('[data-pafe-mailerlite-api-get-groups-results]').html(response);
				//$('[data-pafe-mailerlite_api_get_groups]').removeClass('loading');
			}
		});
		$.post(ajaxurl, {action: 'mailerlite_get_fields',apiKey: mailerliteApiKey}, function(response) {
			if(response){
				$('[data-pafe-mailerlite-api-get-fields-results]').html(response);
				$('[data-pafe-mailerlite_api_get_groups]').removeClass('loading');
			}
		});
	});
	//Sendinblue
	$(document).on('click', '[data-pafe-sendinblue-get-list]', function(){
		$(this).addClass('loading');
		const parent = $(this).closest('#elementor-controls');
		let sendinblueTypeApi;
		let sendinblueType = parent.find('[data-setting="sendinblue_api_key_source"]').val();
		if(sendinblueType == 'default'){
			sendinblueTypeApi = false;
		}else{
			sendinblueTypeApi = parent.find('[data-setting="sendinblue_api_key"]').val();
		}
		let sendinblueList = {
			action: 'pafe_sendinblue_get_list',
			apiKey: sendinblueTypeApi
		}
		$.post(ajaxurl, sendinblueList, function(response) {
			if(response){
				$('[data-pafe-sendinblue-api-get-list-results]').html(response);
			}
		});
		let sendinblueAttributes = {
			action: 'pafe_sendinblue_get_attributes',
			apiKey: sendinblueTypeApi
		}
		$.post(ajaxurl, sendinblueAttributes, function(response) {
			if(response){
				$('[data-pafe-sendinblue-api-get-attributes-result]').html(response);
				$('[data-pafe-sendinblue-get-list]').removeClass('loading');
			}
		});
	});
	//Convertkit
	$(document).on('click', '[data-pafe-convertkit-get-data]', function(){
		$(this).addClass('loading');
		let convertkitApi, convertkitData;
		let parent = $(this).closest('#elementor-controls');
		let convertkit = parent.find('[data-setting="convertkit_api_key_source"]').val();
		if(convertkit == 'default'){
			convertkitApi = false;
		}else{
			convertkitApi = parent.find('[data-setting="convertkit_api_key"]').val();
		}
		convertkitDataForm = {
			action: 'pafe_convertkit_get_form',
			api_key: convertkitApi
		}
		$.post(ajaxurl, convertkitDataForm, function(response) {
			$('[data-pafe-convertkit-get-data-results]').html(response);
			$('[data-pafe-convertkit-get-data]').removeClass('loading');
		});
		convertkitDataField = {
			action: 'pafe_convertkit_get_fields',
			api_key: convertkitApi
		}
		$.post(ajaxurl, convertkitDataField, function(response) {
			$('[data-pafe-convertkit-fields]').html(response);
		});
	});
	//Constant contact
	$(document).on('click', '[data-pafe-constant-contact-get-tag-name]', function(){
		$(this).addClass('loading');
		let dataAjax = {
			action: 'pafe_constant_contact_get_custom_field',
		}
		$.post(ajaxurl, dataAjax, function(response) {
			if(response){
				$('#pafe-constant-contact-tag-name').html(response);
				$('[data-pafe-constant-contact-get-tag-name]').removeClass('loading');
			}
		});
	});
	$(document).on('click', '[data-pafe-constant-contact-get-list]', function(){
		$(this).addClass('loading');
		let dataAjax = {
			action: 'pafe_constant_contact_get_list',
		}
		$.post(ajaxurl, dataAjax, function(response) {
			if(response){
				$('#pafe-constant-contact-list').html(response);
				$('[data-pafe-constant-contact-get-list]').removeClass('loading');
			}
		});
	})
	// Distance Calculation Google Maps
	// $(document).on('click', '[data-setting="pafe_calculated_fields_form_distance_calculation_from_specific_location"], [data-setting="pafe_calculated_fields_form_distance_calculation_to_specific_location"]', function(){
	// 	var autocomplete = new google.maps.places.Autocomplete(this);

	// 	autocomplete.addListener('place_changed', function() {
 //          var place = autocomplete.getPlace();
 //          $(document).find('[data-setting="pafe_calculated_fields_form_distance_calculation_from_specific_location_hidden"]').attr( 'value', place.formatted_address ).change().trigger('keyup');
 //        });
	// });

});