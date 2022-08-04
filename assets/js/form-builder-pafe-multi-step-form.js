jQuery(document).ready(function( $ ) {
	function multiStepFormSignature( $selector ) {
		var $pafeSingature = $selector.find('[data-pafe-signature] canvas.not-resize');

		if ($pafeSingature.length > 0) {
			$pafeSingature.each(function(){
	    		var width = parseInt( $(this).css('max-width').replace('px','') ),
	    			height = parseInt( $(this).css('height').replace('px','') ),
	    			widthOuter = parseInt( $(this).closest('.elementor-form-fields-wrapper').width() ); 

				if(widthOuter > 0) {
					if (width > widthOuter) {
						$(this).attr('width',widthOuter);
					} else {
						$(this).attr('width',width);
					}

					$(this).removeClass('not-resize');
				}
	    	});

		}
    }

	$(document).on('click','[data-pafe-form-builder-nav="next"]',function(){
		var formID = $(this).data('pafe-form-builder-nav-form-id'),
			$wrapper = $(this).closest('.pafe-multi-step-form__content-item'),
    		$fields = $wrapper.find('[data-pafe-form-builder-form-id='+ formID +']'),
    		requiredText = $(this).data('pafe-form-builder-required-text'), 
    		error = 0;
    	var isAlertRequired = false;

		$fields.each(function(){
			if ( $(this).data('pafe-form-builder-stripe') == undefined && $(this).data('pafe-form-builder-html') == undefined ) {
				var $checkboxRequired = $(this).closest('.elementor-field-type-checkbox.elementor-field-required');
				var checked = 0;
				if ($checkboxRequired.length > 0) {
					checked = $checkboxRequired.find("input[type=checkbox]:checked").length;
				} 

				// if ( !$(this)[0].checkValidity() && $(this).closest('.elementor-widget').css('display') != 'none' && $(this).data('pafe-form-builder-honeypot') == undefined || checked == 0 && $checkboxRequired.length > 0) {
				// 	if ($(this).css('display') == 'none' || $(this).data('pafe-form-builder-image-select') != undefined || $checkboxRequired.length > 0) {
				// 		$(this).closest('.elementor-field-group').find('[data-pafe-form-builder-required]').html(requiredText);
				// 	} else {
				// 		if ($(this).data('pafe-form-builder-image-select') == undefined) {
				// 			$(this)[0].reportValidity();
				// 		}
				// 	}
				// 	error++;
				// } else {
				// 	$(this).closest('.elementor-field-group').find('[data-pafe-form-builder-required]').html('');
				// }

				if ($(this).attr('oninvalid') != undefined) {
					requiredText = $(this).attr('oninvalid').replace("this.setCustomValidity('","").replace("')","");
				}

				var isValid = $(this)[0].checkValidity();
				var next_ele = $($(this)[0]).next()[0];
				if ($(next_ele).hasClass('flatpickr-mobile')) {
					isValid = next_ele.checkValidity();
				}

				if ( ( !isValid || checked == 0 && $checkboxRequired.length > 0 ) && $(this).closest('.pafe-form-builder-conditional-logic-hidden').length == 0 && $(this).closest('[data-pafe-form-builder-conditional-logic]').css('display') != 'none' && $(this).data('pafe-form-builder-honeypot') == undefined &&  $(this).closest('[data-pafe-signature]').length == 0 || checked == 0 && $checkboxRequired.length > 0 && $(this).closest('.elementor-element').css('display') != 'none') {
					if ($(this).css('display') == 'none' || $(this).closest('div').css('display') == 'none' || $(this).data('pafe-form-builder-image-select') != undefined || $checkboxRequired.length > 0) {
						$(this).closest('.elementor-field-group').find('[data-pafe-form-builder-required]').html(requiredText);
					} else {
						if (!isAlertRequired && $(this).data('pafe-form-builder-image-select') == undefined) {
							$(this)[0].reportValidity();
							isAlertRequired = true;
						}
					}

					error++;
				} else {
					if ($(this).val()=='' && $(this).closest('.pafe-form-builder-conditional-logic-hidden').length == 0 && $(this).attr('aria-required') == "true" && $(this).attr('data-pafe-form-builder-select-autocomplete') !== undefined) {
						$(this).closest('.elementor-field-group').find('[data-pafe-form-builder-required]').html(requiredText);
						error++;
					} else {

						if ( $(this).data('pafe-form-builder-image-select') != undefined ) {
							if ( $(this).closest('.pafe-image-select-field').find('.image_picker_selector').find('.selected').length < $(this).data('pafe-form-builder-image-select-min-select') ) {
								$(this).closest('.elementor-field-group').find('[data-pafe-image_select_min_select_check]').html($(this).data('pafe-form-builder-image-select-min-select-message')).fadeIn();
								error++;
							} else {
								$(this).closest('.elementor-field-group').find('[data-pafe-image_select_min_select_check]').fadeOut();
							}
						}

						var $label = $(this).closest('.pafe-field-container').find('label'),
								$container = $(this).closest('.pafe-field-container'),
								minFiles = 1;
							if ($label.attr('data-pafe-form-builder-image-upload-min-files') != undefined) {
								minFiles = parseInt($label.attr('data-pafe-form-builder-image-upload-min-files'));
								var filesCurrent = $container.find('.pafe-form-builder-image-upload-uploaded').length;
								if ( filesCurrent < minFiles ) {
									$container.find('[data-pafe-form-builder-image-upload-check]').html($label.attr('data-pafe-form-builder-image-upload-min-files-message'));
									error++;
								} else {
									$container.find('[data-pafe-form-builder-image-upload-check]').remove();
								}
							}

						$(this).closest('.elementor-field-group').find('[data-pafe-form-builder-required]').html('');

						if ($(this).data('pafe-flatpickr-custom-options')!= undefined) {
                            if ($(this).val() == '' && $(this).closest('.pafe-form-builder-conditional-logic-hidden').length == 0 && $(this).attr('required') != undefined) {
                                $(this).closest('.elementor-field-group').find('[data-pafe-form-builder-required]').html(requiredText);
                                error++;
                            }
                        }

						if ($(this).closest('[data-pafe-signature]').length > 0) {
							var $pafeSingature = $(this).closest('[data-pafe-signature]'),
								$exportButton = $pafeSingature.find('[data-pafe-signature-export]');

							$exportButton.trigger('click');

							if ($(this).val() == '' && $(this).closest('.pafe-form-builder-conditional-logic-hidden').length == 0 && $(this).attr('required') != undefined) {
								$(this).closest('.elementor-field-group').find('[data-pafe-form-builder-required]').html(requiredText);
								error++;
							}
						}
					}
				}
			}
		});

		if (error == 0) {
			$wrapper.removeClass('active');
			$wrapper.next().addClass('active');
			var index = $wrapper.next().index(),
				$progressbarItem = $(this).closest('.pafe-multi-step-form').find('.pafe-multi-step-form__progressbar-item');
			$progressbarItem.eq(index).addClass('active');

			var $scrollToTop = $(this).closest('[data-pafe-multi-step-form-scroll-to-top]');

			if ($scrollToTop.length > 0) {
				var breakPointMd = $('[data-pafe-break-point-md]').data('pafe-break-point-md'),
					breakPointLg = $('[data-pafe-break-point-lg]').data('pafe-break-point-lg'),
					windowWidth = window.innerWidth;

				if( windowWidth >= breakPointLg ) {
					$('html, body').animate({
						scrollTop: $scrollToTop.offset().top - $scrollToTop.data('pafe-multi-step-form-scroll-to-top-offset-desktop') }
					, 300);
				}

				if( windowWidth >= breakPointMd && windowWidth < breakPointLg ) {
					$('html, body').animate({
						scrollTop: $scrollToTop.offset().top - $scrollToTop.data('pafe-multi-step-form-scroll-to-top-offset-tablet') }
					, 300);
				}

				if( windowWidth < breakPointMd ) {
					$('html, body').animate({
						scrollTop: $scrollToTop.offset().top - $scrollToTop.data('pafe-multi-step-form-scroll-to-top-offset-mobile') }
					, 300);
				}
			}

			multiStepFormSignature( $wrapper.next() );
		}
	});

	function nextMultiStepForm($this) {
		var $wrapper = $this.closest('.pafe-multi-step-form__content-item'),
			formID = $wrapper.find('[data-pafe-form-builder-form-id]').data('pafe-form-builder-form-id');

		$wrapper.removeClass('active');
		$wrapper.next().addClass('active');
		var index = $wrapper.next().index(),
			$progressbarItem = $this.closest('.pafe-multi-step-form').find('.pafe-multi-step-form__progressbar-item');
		$progressbarItem.eq(index).addClass('active');

		var $scrollToTop = $this.closest('[data-pafe-multi-step-form-scroll-to-top]');

		if ($scrollToTop.length > 0) {
			var breakPointMd = $('[data-pafe-break-point-md]').data('pafe-break-point-md'),
				breakPointLg = $('[data-pafe-break-point-lg]').data('pafe-break-point-lg'),
				windowWidth = window.innerWidth;

			if( windowWidth >= breakPointLg ) {
				$('html, body').animate({
					scrollTop: $scrollToTop.offset().top - $scrollToTop.data('pafe-multi-step-form-scroll-to-top-offset-desktop') }
				, 300);
			}

			if( windowWidth >= breakPointMd && windowWidth < breakPointLg ) {
				$('html, body').animate({
					scrollTop: $scrollToTop.offset().top - $scrollToTop.data('pafe-multi-step-form-scroll-to-top-offset-tablet') }
				, 300);
			}

			if( windowWidth < breakPointMd ) {
				$('html, body').animate({
					scrollTop: $scrollToTop.offset().top - $scrollToTop.data('pafe-multi-step-form-scroll-to-top-offset-mobile') }
				, 300);
			}
		}

		multiStepFormSignature( $wrapper.next() );
	}

	$(document).on('change','[data-pafe-form-builder-multi-step-form-autonext]',function(){
		nextMultiStepForm($(this));
	});

	$(document).on('click','.image_picker_selector>li>div',function(){
		if ($(this).closest('.elementor-field').find('[data-pafe-form-builder-multi-step-form-autonext]').length > 0) {
			nextMultiStepForm($(this));
		}
	});

	$(document).on('click','[data-pafe-form-builder-nav="prev"]',function(){
		var formID = $(this).data('pafe-form-builder-nav-form-id'),
			$wrapper = $(this).closest('.pafe-multi-step-form__content-item');

		$wrapper.removeClass('active');
		$wrapper.prev().addClass('active');
		var index = $wrapper.index(),
			$progressbarItem = $(this).closest('.pafe-multi-step-form').find('.pafe-multi-step-form__progressbar-item');
		$progressbarItem.eq(index).removeClass('active');

		var $scrollToTop = $(this).closest('[data-pafe-multi-step-form-scroll-to-top]');

		if ($scrollToTop.length > 0) {
			var breakPointMd = $('[data-pafe-break-point-md]').data('pafe-break-point-md'),
				breakPointLg = $('[data-pafe-break-point-lg]').data('pafe-break-point-lg'),
				windowWidth = window.innerWidth;

			if( windowWidth >= breakPointLg ) {
				$('html, body').animate({
					scrollTop: $scrollToTop.offset().top - $scrollToTop.data('pafe-multi-step-form-scroll-to-top-offset-desktop') }
				, 300);
			}

			if( windowWidth >= breakPointMd && windowWidth < breakPointLg ) {
				$('html, body').animate({
					scrollTop: $scrollToTop.offset().top - $scrollToTop.data('pafe-multi-step-form-scroll-to-top-offset-tablet') }
				, 300);
			}

			if( windowWidth < breakPointMd ) {
				$('html, body').animate({
					scrollTop: $scrollToTop.offset().top - $scrollToTop.data('pafe-multi-step-form-scroll-to-top-offset-mobile') }
				, 300);
			}
		}
	});
});