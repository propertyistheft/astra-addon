jQuery(document).ready(function($) {

    function pafeConditionalLogicFormCheck() {
        $(document).find('[data-pafe-conditional-logic-form]').each(function(){
            var $form = $(this),
                popupLength = $(this).closest('.elementor-location-popup').length,
                speed = $form.data('pafe-conditional-logic-form-speed'),
                easing = $form.data('pafe-conditional-logic-form-easing'),
                conditionals = $form.data('pafe-conditional-logic-form');

            // Loop qua tat ca field trong form
            $form.find('[name^="form_fields"]').each(function(){
                if ($(this).attr('id') != undefined) {
                    var $fieldGroup = $(this).closest('.elementor-field-group'), // Selector field group
                        fieldName = $(this).attr('name').replace('[]','').replace('form_fields[','').replace(']',''), // Field name hien tai
                        error = 0, // So dieu kien khong thoa man
                        conditionalsCount = 0, // Tinh tong so dieu kien
                        conditionalsAndOr = '';  // Dieu kien And hay Or

                    // Loop qua tat ca cac dieu kien
                    for (var i = 0; i < conditionals.length; i++) {
                        var show = conditionals[i]['pafe_conditional_logic_form_show'],
                            fieldIf = conditionals[i]['pafe_conditional_logic_form_if'].trim(),
                            comparison = conditionals[i]['pafe_conditional_logic_form_comparison_operators'],
                            value = conditionals[i]['pafe_conditional_logic_form_value'],
                            type = conditionals[i]['pafe_conditional_logic_form_type'],
                            required = conditionals[i]['pafe_conditional_logic_form_required_field'] ? true : false;

                        if (type == 'number') {
                            value = parseFloat( value );
                        }

                        // Neu field nay chi hien thi khi co dieu kien
                        if(fieldName == show) {
                            conditionalsCount++;
                            conditionalsAndOr = conditionals[i]['pafe_conditional_logic_form_and_or_operators'];
                            if(fieldIf != '') {
                                var $fieldIfSelector = $form.find('[name="form_fields[' + fieldIf + ']"]'),
                                    fieldIfType = $form.find('[name="form_fields[' + fieldIf + ']"]').attr('type');

                                if($fieldIfSelector.length > 0) {

                                    if (fieldIfType == 'radio' || fieldIfType == 'checkbox') {
                                        var fieldIfValue = $form.find('[name="form_fields[' + fieldIf + ']"]:checked').val();
                                    } else {
                                        var fieldIfValue = $fieldIfSelector.val().trim();
                                    }
                                    
                                    if (fieldIfValue != undefined && fieldIfValue.indexOf(';') !== -1) {
                                        fieldIfValue = fieldIfValue.split(';');
                                        fieldIfValue = fieldIfValue[0];
                                    }

                                    if (type == 'number') {
                                        if (fieldIfValue == undefined) {
                                            fieldIfValue = 0;
                                        } else {
                                            fieldIfValue = parseFloat( fieldIfValue );
                                            if (isNaN(fieldIfValue)) {
                                                fieldIfValue = 0;
                                            }
                                        }
                                    }

                                    if(comparison == 'not-empty') {
                                        if (fieldIfValue == '' || fieldIfValue == 0) {
                                            error += 1;
                                        }
                                    }
                                    if(comparison == 'empty') {
                                        if (fieldIfValue != '' || fieldIfValue != 0) {
                                            error += 1;
                                        }
                                    }
                                    if(comparison == '=') {
                                        if (fieldIfValue != value) {
                                            error += 1;
                                        }
                                    }
                                    if(comparison == '!=') {
                                        if (fieldIfValue == value) {
                                            error += 1;
                                        }
                                    }
                                    if(comparison == '>') {
                                        if (fieldIfValue <= value) {
                                            error += 1;
                                        }
                                    }
                                    if(comparison == '>=') {
                                        if (fieldIfValue < value) {
                                            error += 1;
                                        }
                                    }
                                    if(comparison == '<') {
                                        if (fieldIfValue >= value) {
                                            error += 1;
                                        }
                                    }
                                    if(comparison == '<=') {
                                        if (fieldIfValue > value) {
                                            error += 1;
                                        }
                                    }
                                    if(comparison == 'checked') {
                                        if (!$fieldIfSelector.prop('checked')) {
                                            error += 1;
                                        }
                                    }
                                    if(comparison == 'unchecked') {
                                        if ($fieldIfSelector.prop('checked')) {
                                            error += 1;
                                        }
                                    }
                                }

                                var $fieldIfSelectorMultiple = $form.find('[name="form_fields[' + fieldIf + '][]"]');
                                if($fieldIfSelectorMultiple.length > 0) {
                                    fieldIfTypeMultiple = $form.find('[name="form_fields[' + fieldIf + '][]"]').attr('type');
                                    var fieldIfValueMultiple = $fieldIfSelectorMultiple.val(),
                                        fieldIfValueMultiple = [];

                                    if (fieldIfTypeMultiple == 'checkbox') {
                                        $form.find('[name="form_fields[' + fieldIf + '][]"]:checked').each(function () {
                                            fieldIfValueMultiple.push($(this).val());
                                        });
                                    } else {
                                        fieldIfValueMultiple = $fieldIfSelectorMultiple.val();
                                        if (fieldIfValueMultiple == null) {
                                            var fieldIfValueMultiple = [];
                                        }
                                    }

                                    if(comparison == 'not-empty') {
                                        if (fieldIfValueMultiple.length == 0) {
                                            error += 1;
                                        }
                                    }
                                    if(comparison == 'empty') {
                                        if (fieldIfValueMultiple.length > 0) {
                                            error += 1;
                                        }
                                    }
                                    if(comparison == '=' || comparison == '!=' || comparison == '>' || comparison == '>=' || comparison == '<' || comparison == '<=') {
                                        if (fieldIfValueMultiple.length == 0) {
                                            error += 1;
                                        }
                                    }
                                    if(comparison == '=') {
                                        for (var j = 0; j < fieldIfValueMultiple.length; j++) {
                                            if (fieldIfValueMultiple[j] != value) {
                                                error += 1;
                                            }
                                        }
                                    }
                                    if(comparison == '!=') {
                                        for (var j = 0; j < fieldIfValueMultiple.length; j++) {
                                            if (fieldIfValueMultiple[j] == value) {
                                                error += 1;
                                            }
                                        }
                                    }
                                    if(comparison == '>') {
                                        for (var j = 0; j < fieldIfValueMultiple.length; j++) {
                                            if (fieldIfValueMultiple[j] <= value) {
                                                error += 1;
                                            }
                                        }
                                    }
                                    if(comparison == '>=') {
                                        for (var j = 0; j < fieldIfValueMultiple.length; j++) {
                                            if (fieldIfValueMultiple[j] < value) {
                                                error += 1;
                                            }
                                        }
                                    }
                                    if(comparison == '<') {
                                        for (var j = 0; j < fieldIfValueMultiple.length; j++) {
                                            if (fieldIfValueMultiple[j] >= value) {
                                                error += 1;
                                            }
                                        }
                                    }
                                    if(comparison == '<=') {
                                        for (var j = 0; j < fieldIfValueMultiple.length; j++) {
                                            if (fieldIfValueMultiple[j] > value) {
                                                error += 1;
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                    
                    if (conditionalsAndOr == 'or') {
                        if (conditionalsCount > error) {
                            if (popupLength > 0) {
                                $fieldGroup.show();
                            } else {
                                $fieldGroup.slideDown(speed,easing);
                            }

                            pafeSetRequired($fieldGroup, required, true);
                        } else {
                            if (popupLength > 0) {
                                $fieldGroup.hide();
                            } else {
                                $fieldGroup.slideUp(speed,easing);
                            }

                            pafeSetRequired($fieldGroup, required, false);
                        }
                    } 

                    if (conditionalsAndOr == 'and') {
                        if (error == 0) {
                            if (popupLength > 0) {
                                $fieldGroup.show();
                            } else {
                                $fieldGroup.slideDown(speed,easing);
                            }

                            pafeSetRequired($fieldGroup, required, true);
                        } else {
                            if (popupLength > 0) {
                                $fieldGroup.hide();
                            } else {
                                $fieldGroup.slideUp(speed,easing);
                            }

                            pafeSetRequired($fieldGroup, required, false);
                        }
                    }
                }
            });

            var $fieldGroupSubmit = $form.find('.elementor-field-type-submit'),
                fieldNameSubmit = 'submit',
                errorSubmit = 0,
                conditionalsCountSubmit = 0,
                conditionalsAndOrSubmit = '';

            for (var i = 0; i < conditionals.length; i++) {
                var show = conditionals[i]['pafe_conditional_logic_form_show'],
                    fieldIf = conditionals[i]['pafe_conditional_logic_form_if'].trim(),
                    comparison = conditionals[i]['pafe_conditional_logic_form_comparison_operators'],
                    value = conditionals[i]['pafe_conditional_logic_form_value'],
                    type = conditionals[i]['pafe_conditional_logic_form_type'];

                if (type == 'number') {
                    value = parseFloat( value );
                }

                if(fieldNameSubmit == show) {
                    conditionalsCountSubmit++;
                    conditionalsAndOrSubmit = conditionals[i]['pafe_conditional_logic_form_and_or_operators'];
                    if(fieldIf != '') {
                        var $fieldIfSelector = $form.find('[name="form_fields[' + fieldIf + ']"]'),
                            fieldIfType = $form.find('[name="form_fields[' + fieldIf + ']"]').attr('type');

                        if($fieldIfSelector.length > 0) {

                            if (fieldIfType == 'radio') {
                                var fieldIfValue = $form.find('[name="form_fields[' + fieldIf + ']"]:checked').val();
                            } else {
                                var fieldIfValue = $fieldIfSelector.val().trim();
                            }
                            
                            if (fieldIfValue != undefined && fieldIfValue.indexOf(';') !== -1) {
                                fieldIfValue = fieldIfValue.split(';');
                                fieldIfValue = fieldIfValue[0];
                            }

                            if (type == 'number') {
                                if (fieldIfValue == undefined) {
                                    fieldIfValue = 0;
                                } else {
                                    fieldIfValue = parseFloat( fieldIfValue );
                                    if (isNaN(fieldIfValue)) {
                                        fieldIfValue = 0;
                                    }
                                }
                            }

                            if(comparison == 'not-empty') {
                                if (fieldIfValue == '' || fieldIfValue == 0) {
                                    errorSubmit += 1;
                                }
                            }
                            if(comparison == 'empty') {
                                if (fieldIfValue != '' || fieldIfValue != 0) {
                                    errorSubmit += 1;
                                }
                            }
                            if(comparison == '=') {
                                if (fieldIfValue != value) {
                                    errorSubmit += 1;
                                }
                            }
                            if(comparison == '!=') {
                                if (fieldIfValue == value) {
                                    errorSubmit += 1;
                                }
                            }
                            if(comparison == '>') {
                                if (fieldIfValue <= value) {
                                    errorSubmit += 1;
                                }
                            }
                            if(comparison == '>=') {
                                if (fieldIfValue < value) {
                                    errorSubmit += 1;
                                }
                            }
                            if(comparison == '<') {
                                if (fieldIfValue >= value) {
                                    errorSubmit += 1;
                                }
                            }
                            if(comparison == '<=') {
                                if (fieldIfValue > value) {
                                    errorSubmit += 1;
                                }
                            }
                            if(comparison == 'checked') {
                                if (!$fieldIfSelector.prop('checked')) {
                                    errorSubmit += 1;
                                }
                            }
                            if(comparison == 'unchecked') {
                                if ($fieldIfSelector.prop('checked')) {
                                    errorSubmit += 1;
                                }
                            }
                        }

                        var $fieldIfSelectorMultiple = $form.find('[name="form_fields[' + fieldIf + '][]"]');
                        if($fieldIfSelectorMultiple.length > 0) {
                            fieldIfTypeMultiple = $form.find('[name="form_fields[' + fieldIf + '][]"]').attr('type');
                            var fieldIfValueMultiple = $fieldIfSelectorMultiple.val(),
                                fieldIfValueMultiple = [];

                            if (fieldIfTypeMultiple == 'checkbox') {
                                $form.find('[name="form_fields[' + fieldIf + '][]"]:checked').each(function () {
                                    fieldIfValueMultiple.push($(this).val());
                                });
                            } else {
                                fieldIfValueMultiple = $fieldIfSelectorMultiple.val();
                                if (fieldIfValueMultiple == null) {
                                    var fieldIfValueMultiple = [];
                                }
                            }

                            if(comparison == 'not-empty') {
                                if (fieldIfValueMultiple.length == 0) {
                                    errorSubmit += 1;
                                }
                            }
                            if(comparison == 'empty') {
                                if (fieldIfValueMultiple.length > 0) {
                                    errorSubmit += 1;
                                }
                            }
                            if(comparison == '=' || comparison == '!=' || comparison == '>' || comparison == '>=' || comparison == '<' || comparison == '<=') {
                                if (fieldIfValueMultiple.length == 0) {
                                    errorSubmit += 1;
                                }
                            }
                            if(comparison == '=') {
                                for (var j = 0; j < fieldIfValueMultiple.length; j++) {
                                    if (fieldIfValueMultiple[j] != value) {
                                        errorSubmit += 1;
                                    }
                                }
                            }
                            if(comparison == '!=') {
                                for (var j = 0; j < fieldIfValueMultiple.length; j++) {
                                    if (fieldIfValueMultiple[j] == value) {
                                        errorSubmit += 1;
                                    }
                                }
                            }
                            if(comparison == '>') {
                                for (var j = 0; j < fieldIfValueMultiple.length; j++) {
                                    if (fieldIfValueMultiple[j] <= value) {
                                        errorSubmit += 1;
                                    }
                                }
                            }
                            if(comparison == '>=') {
                                for (var j = 0; j < fieldIfValueMultiple.length; j++) {
                                    if (fieldIfValueMultiple[j] < value) {
                                        errorSubmit += 1;
                                    }
                                }
                            }
                            if(comparison == '<') {
                                for (var j = 0; j < fieldIfValueMultiple.length; j++) {
                                    if (fieldIfValueMultiple[j] >= value) {
                                        errorSubmit += 1;
                                    }
                                }
                            }
                            if(comparison == '<=') {
                                for (var j = 0; j < fieldIfValueMultiple.length; j++) {
                                    if (fieldIfValueMultiple[j] > value) {
                                        errorSubmit += 1;
                                    }
                                }
                            }
                        }
                    }
                }
            }

            if (conditionalsAndOrSubmit == 'or') {
                if (conditionalsCountSubmit > errorSubmit) {
                    $fieldGroupSubmit.slideDown(speed,easing);
                } else {
                    $fieldGroupSubmit.slideUp(speed,easing);
                }
            } 

            if (conditionalsAndOrSubmit == 'and') {
                if (error == 0) {
                    $fieldGroupSubmit.slideDown(speed,easing);
                } else {
                    $fieldGroupSubmit.slideUp(speed,easing);
                }
            }
        });
    }

    pafeConditionalLogicFormCheck();

    $(document).on('keyup change','[data-pafe-conditional-logic-form] [name^="form_fields"]', function(){
        pafeConditionalLogicFormCheck();
    });

    function pafeSetRequired($fieldGroup, $first_status, $status) {
        if ($first_status) {
            let $requiredField = $fieldGroup.find('.elementor-field');
            $requiredField.each(function(){
                $(this).attr('required', $status);
                if ($(this).closest('[data-pafe-conditional-logic-form-mark-required]').length > 0) {
                    $fieldGroup.addClass('elementor-mark-required');
                }
            });
        }
    }

});