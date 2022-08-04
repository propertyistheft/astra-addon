jQuery(document).ready(function($) {

    function pafeCalculatedFieldsForm() {
        $(document).find('[data-pafe-calculated-fields-form]').each(function(){
            var $form = $(this),
                calculations = $form.data('pafe-calculated-fields-form');

            $form.find('[name^="form_fields"]').each(function(){

                if ($(this).attr('id') != undefined) {
                    var fieldName = $(this).attr('name').replace('form_fields[','').replace(']',''),
                        $fieldSelector = $form.find('[name="form_fields[' + fieldName + ']"]'),
                        fieldType = $form.find('[name="form_fields[' + fieldName + ']"]').attr('type');

                    if($fieldSelector.length > 0) {

                        if (fieldType == 'radio' || fieldType == 'checkbox') {
                            var fieldValue = $form.find('[name="form_fields[' + fieldName + ']"]:checked').val();
                        } else {
                            var fieldValue = $fieldSelector.val().trim();
                        }

                        if (fieldValue == undefined) {
                            fieldValue = 0;
                        } else {
                            fieldValue = parseFloat( fieldValue );
                            if (isNaN(fieldValue)) {
                                fieldValue = 0;
                            }
                        }

                        window[fieldName] = parseFloat( fieldValue );
                    }

                    if (fieldName.indexOf('[]') !== -1) {
                        fieldName = fieldName.replace('[]','');
                        var $fieldSelectorMultiple = $form.find('[name="form_fields[' + fieldName + '][]"]');
                        if($fieldSelectorMultiple.length > 0) {
                            fieldTypeMultiple = $form.find('[name="form_fields[' + fieldName + '][]"]').attr('type');
                            var fieldValueMultiple = $fieldSelectorMultiple.val(),
                                fieldValueMultiple = [];

                            if (fieldTypeMultiple == 'checkbox') {
                                $form.find('[name="form_fields[' + fieldName + '][]"]:checked').each(function (index,element) {
                                    fieldValueMultiple.push($(this).val());
                                });
                            } else {
                                fieldValueMultiple = $fieldSelectorMultiple.val();
                                if (fieldValueMultiple == null) {
                                    var fieldValueMultiple = [];
                                }
                            }

                            fieldValueMultipleTotal = 0;

                            for (var j = 0; j < fieldValueMultiple.length; j++) {
                                fieldValue = parseFloat( fieldValueMultiple[j] );
                                if (isNaN(fieldValue)) {
                                    fieldValue = 0;
                                }
                                fieldValueMultipleTotal += fieldValue;
                            }

                            window[fieldName] = fieldValueMultipleTotal;
                        }
                    }
                }
            });

            for (var i = 0; i < calculations.length; i++) {
                var $totalField = $form.find('[name="form_fields[' + calculations[i]['pafe_calculated_fields_form_id'] + ']"]');
                if ($totalField.length > 0) {
                    var $totalFieldContent = $totalField.closest('.elementor-field-group').find('.pafe-calculated-fields-form');
                    if ($totalFieldContent.length == 0) {
                        $totalField.after('<div class="pafe-calculated-fields-form" style="width: 100%"></div>');
                    }
                    
                    var totalFieldContent = calculations[i]['pafe_calculated_fields_form_before'] + eval(calculations[i]['pafe_calculated_fields_form_calculation']) + calculations[i]['pafe_calculated_fields_form_after'];
                    $totalField.hide();
                    $totalField.closest('.elementor-field-group').find('.pafe-calculated-fields-form').html(totalFieldContent);
                    $totalField.val(totalFieldContent);
                }
            }
        });
    }

    pafeCalculatedFieldsForm();

    $(document).on('keyup change','[data-pafe-calculated-fields-form] [name^="form_fields"]', function(){
		pafeCalculatedFieldsForm();
	});

});