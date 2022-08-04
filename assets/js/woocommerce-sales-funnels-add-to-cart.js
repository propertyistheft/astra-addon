/*
 * jQuery throttle / debounce - v1.1 - 3/7/2010
 * http://benalman.com/projects/jquery-throttle-debounce-plugin/
 * 
 * Copyright (c) 2010 "Cowboy" Ben Alman
 * Dual licensed under the MIT and GPL licenses.
 * http://benalman.com/about/license/
 */
(function(b,c){var $=b.jQuery||b.Cowboy||(b.Cowboy={}),a;$.throttle=a=function(e,f,j,i){var h,d=0;if(typeof f!=="boolean"){i=j;j=f;f=c}function g(){var o=this,m=+new Date()-d,n=arguments;function l(){d=+new Date();j.apply(o,n)}function k(){h=c}if(i&&!h){l()}h&&clearTimeout(h);if(i===c&&m>e){l()}else{if(f!==true){h=setTimeout(i?k:l,i===c?e-m:e)}}}if($.guid){g.guid=j.guid=j.guid||$.guid++}return g};$.debounce=function(d,e,f){return f===c?a(d,e,false):a(d,f,e!==false)}})(this);
  

jQuery(document).ready(function($) {

	$(document).on('keyup change','[data-pafe-form-builder-form-id]', $.debounce( 700, function(){
		var formID = $(this).attr('data-pafe-form-builder-form-id'); 
		pafeWoocommerceCheckout(formID);
	})
	);

	$(document).on( 'click', '[data-pafe-woocommerce-checkout-place-order]#place_order', function(e){
		var formID = $(this).closest('[data-pafe-woocommerce-checkout-form-id]').attr('data-pafe-woocommerce-checkout-form-id'),
		    $fields = $(document).find('[data-pafe-form-builder-form-id="'+ formID +'"]'),
		    error = window.pafeValidateFields($fields);
		if (error != 0) {
			e.preventDefault();
		}
	});

	$(window).on('load', function(){
		pafeWoocommerceCheckout();
	});

	function pafeWoocommerceCheckout(formID) {
        if (formID == undefined) {
			var $pafeWoocommerceCheckout = $(document).find('[data-pafe-woocommerce-checkout-form-id]');
		} else {
			var $pafeWoocommerceCheckout = $(document).find('[data-pafe-woocommerce-checkout-form-id="' + formID + '"]');
		}
		
		if ($pafeWoocommerceCheckout.length > 0) {
			$pafeWoocommerceCheckout.each(function(){
		    	var formID = $(this).attr('data-pafe-woocommerce-checkout-form-id'),
		    		$fields = $(document).find('[data-pafe-form-builder-form-id='+ formID +']'),
		    		fieldsOj = [],
		    		formData = new FormData();

				var $submit = $(this);
				var $parent = $submit.closest('.elementor-element');

				$fields.each(function(){
					if ( $(this).data('pafe-form-builder-stripe') == undefined && $(this).data('pafe-form-builder-html') == undefined ) {
						var $checkboxRequired = $(this).closest('.elementor-field-type-checkbox.elementor-field-required');
						var checked = 0;
						if ($checkboxRequired.length > 0) {
							checked = $checkboxRequired.find("input[type=checkbox]:checked").length;
						} 

						$(this).closest('.elementor-field-group').find('[data-pafe-form-builder-required]').html('');

						var fieldType = $(this).attr('type'),
							fieldName = $(this).attr('name');

						var $repeater = $(this).closest('[data-pafe-form-builder-repeater-form-id]'),
							repeaterID = '',
							repeaterIDOne = '',
							repeaterLabel = '',
							repeaterIndex = -1,
							repeaterLength = 0;

						if ($repeater.length > 0) {
							$repeaterParents = $(this).parents('[data-pafe-form-builder-repeater-form-id]');
							repeaterIDOne = $repeater.data('pafe-form-builder-repeater-id');
							$repeaterParents.each(function(){
								var repeaterParentID = $(this).data('pafe-form-builder-repeater-id'),
									$repeaterParentAll = $(document).find('[data-pafe-form-builder-repeater-form-id="' + formID + '"][data-pafe-form-builder-repeater-id="' + repeaterParentID + '"]');

								repeaterParentIndex = $(this).index() - $repeaterParentAll.index();
								repeaterID += repeaterParentID + '|index' + repeaterParentIndex + '|' + fieldName.replace('[]','').replace('form_fields[','').replace(']','') + ',';
							});

							repeaterLabel = $repeater.data('pafe-form-builder-repeater-label');

							var $repeaterAll = $(document).find('[data-pafe-form-builder-repeater-id="' + $repeater.data('pafe-form-builder-repeater-id') + '"]');
							repeaterLength = $repeater.siblings('[data-pafe-form-builder-repeater-id="' + $repeater.data('pafe-form-builder-repeater-id') + '"]').length + 1; 

							repeaterIndex = $repeater.index() - $repeaterAll.index();
						}

						if (fieldName.indexOf('[]') !== -1) {
		                    var fieldValueMultiple = [];

		                    if (fieldType == 'checkbox') {
		                        $(this).closest('.elementor-element').find('[name="'+ fieldName + '"]:checked').each(function () {
		                            fieldValueMultiple.push($(this).val());
		                        }); 
		                    } else {
		                        fieldValueMultiple = $(this).val();
		                        if (fieldValueMultiple == null) {
		                            var fieldValueMultiple = [];
		                        }
		                    }

		                    fieldValue = '';
		                    var fieldValueByLabel = '';

		                    var fieldBooking = [];

		                    for (var j = 0; j < fieldValueMultiple.length; j++) {
		                    	if ($(this).data('pafe-form-builder-send-data-by-label') != undefined) {
		                    		var fieldValueSelected = fieldValueMultiple[j];

		                    		if (fieldType == 'checkbox') {
			                    		var $optionSelected = $(this).closest('.elementor-element').find('[value="' + fieldValueSelected + '"]');
			                			if ($optionSelected.length > 0) {
			                				fieldValueByLabel += $optionSelected.data('pafe-form-builder-send-data-by-label') + ',';
			                			}
		                			} else {
		                				var $optionSelected = $(this).find('[value="' + fieldValueSelected + '"]');
			                			if ($optionSelected.length > 0) {
			                				fieldValueByLabel += $optionSelected.html() + ',';
			                			}
		                			}
		                		}

		                		fieldValue += fieldValueMultiple[j] + ',';

		                		if ($(this).attr('data-pafe-form-booking-item-options') != undefined) {
		                			var fieldValueSelected = fieldValueMultiple[j];
		                			
		                			var $optionSelected = $(this).closest('.elementor-element').find('[value="' + fieldValueSelected + '"]');
		                			if ($optionSelected.length > 0) {
	                					fieldBooking.push($optionSelected.attr('data-pafe-form-booking-item-options'));  
		                			}
                				}
		                    }

		                    fieldValue = fieldValue.replace(/,(\s+)?$/, '');
						} else {
							if (fieldType == 'radio' || fieldType == 'checkbox') {
								if ($(this).data('pafe-form-builder-send-data-by-label') != undefined) {
									var fieldValueByLabel = $(this).closest('.elementor-element').find('[name="'+ fieldName +'"]:checked').data('pafe-form-builder-send-data-by-label');
								}

								var fieldValue = $(this).closest('.elementor-element').find('[name="'+ fieldName +'"]:checked').val();
			                } else {
			                	if ($(this).data('pafe-form-builder-calculated-fields') != undefined) {
			                		var fieldValue = $(this).siblings('.pafe-calculated-fields-form').text();
			                	} else {
			                		if ($(this).data('pafe-form-builder-send-data-by-label') != undefined) {
			                			var fieldValueSelected = $(this).val().trim();
			                			var $optionSelected = $(this).find('[value="' + fieldValueSelected + '"]');
			                			if ($optionSelected.length > 0) {
			                				fieldValueByLabel = $optionSelected.html();
			                			}
			                		}

			                		var fieldValue = $(this).val().trim();
			                	}
			                }
						}
						
						if (fieldValue != undefined) {
							var fieldItem = {};
							fieldItem['label'] = $(this).closest('.elementor-field-group').find('.elementor-field-label').html();
							fieldItem['name'] = fieldName.replace('[]','').replace('form_fields[','').replace(']','');
							fieldItem['value'] = fieldValue;

							if (typeof fieldBooking !== 'undefined' && fieldBooking.length > 0) {
							    fieldItem['booking'] = fieldBooking;
							} 

							if (fieldValueByLabel != '') { 
								fieldItem['value_label'] = fieldValueByLabel;
							}
							
							if ($(this).closest('.elementor-field-type-calculated_fields').length > 0) {
								fieldItem['calculation_results'] = $(this).val().trim();
							}
							
							if (!$(this).closest('.elementor-widget').hasClass('pafe-form-builder-conditional-logic-hidden')) {
								fieldItem['repeater_id'] = repeaterID;
								fieldItem['repeater_id_one'] = repeaterIDOne;
								fieldItem['repeater_label'] = repeaterLabel;
								fieldItem['repeater_index'] = repeaterIndex; 
								fieldItem['repeater_length'] = repeaterLength;

							    fieldsOj.push(fieldItem); 
							}
						}						
					}
				});

				formData.append("action", "pafe_ajax_form_builder_woocommerce_checkout");
				formData.append("fields", JSON.stringify(fieldsOj)); 
				formData.append("form_id", $(this).attr('data-pafe-woocommerce-checkout-id'));

				if ($(this).closest('[data-elementor-id]') != undefined) {
					formData.append("post_id", $(this).closest('[data-elementor-id]').attr('data-elementor-id'));
				} else {
					formData.append("post_id", $(this).attr('data-pafe-woocommerce-checkout-post-id'));
				}
				
				formData.append("product_id", $(this).attr('data-pafe-woocommerce-checkout-product-id'));

				$.ajax({
					url: $('[data-pafe-ajax-url]').data('pafe-ajax-url'),
					type: 'POST',
					data: formData,
					processData: false,
					contentType: false,
					success: function (response) {
						if (response.trim() == '1') {
							$( 'body' ).trigger( 'update_checkout' );
							$( 'body' ).trigger( 'wc_update_cart' );
							var $place_order_button = $submit.find('#place_order');
							$place_order_button.attr('data-pafe-woocommerce-checkout-place-order', '');
						}
					}
				});
			});
		}
		
	}
	 
	$(document).on( 'click', '[data-pafe-woocommerce-sales-funnels-add-to-cart]', function(e){
		e.preventDefault();
		var $button = $(this);
		$button.css('opacity','0.5');
		$button.find('[data-pafe-woocommerce-sales-funnels-add-to-cart-message]').remove();

		var optionsJSON = $(this).attr('data-pafe-woocommerce-sales-funnels-add-to-cart'),
			options = JSON.parse(optionsJSON);

		$.ajax({
			url: $('[data-pafe-ajax-url]').data('pafe-ajax-url'),
			type: 'POST',
			data: {
				'action': 'pafe_ajax_woocommerce_sales_funnels_add_to_cart',
				'options': options,
			},
			success: function (response) {
				$button.css('opacity','1');
				var responseObj = JSON.parse(response);

				if (responseObj.status == 1) {
					$button.append('<div data-pafe-woocommerce-sales-funnels-add-to-cart-message class="pafe-woocommerce-sales-funnels-add-to-cart-message pafe-woocommerce-sales-funnels-add-to-cart-message--success">' + options['message_success'] + '</div>');
					$( 'body' ).trigger( 'update_checkout' );
					$( 'body' ).trigger( 'wc_update_cart' );
				} else {
					$button.append('<div data-pafe-woocommerce-sales-funnels-add-to-cart-message class="pafe-woocommerce-sales-funnels-add-to-cart-message pafe-woocommerce-sales-funnels-add-to-cart-message--out-of-stock">' + options['message_out_of_stock'] + '</div>');
					$( 'body' ).trigger( 'update_checkout' );
					$( 'body' ).trigger( 'wc_update_cart' );
				}
			}
		});
	});
 
});