"use strict";
$(function () {
    initAjax();
});

const TOKEN_FIELDS = ['_method', '_csrfToken', '_Token[fields]', '_Token[unlocked]', '_Token[debug]'];

function set_validation_errors(form, errors) {
    if (errors === undefined) {
        errors = form;
        form = $('body');
    }

    $.each(errors, function (name, error) {
        clear_validation_errors(form, name);

        let field = $(form).find('[name="' + name + '"]');

        let template;
        $.each(error, function (key, msg) {
            template = validation_error_template;

            template = template.replace('{{field}}', name).replace('{{message}}', msg);

            field.after(template);
        })
    });
}

function clear_validation_errors(form, fields) {
    if (!form) {
        form = $('body');
    }

    if (fields === undefined) {
        $(form).find('.validation-error').remove()
    } else {
        if (typeof fields === 'string') {
            fields = [fields];
        }

        $.each(fields, function (index, name) {
            $(form).find('#validation-' + name + '.validation-error').remove()
        })
    }
}

function refresh_form_values(form, values) {
    $.each(values, function (name, value) {
        $(form).find('[name="' + name + '"]').val(value);
    });
}

function initAjax() {
    $.ajaxSetup({
        type: 'post',
        dataType: 'json',
        cache: false,
        timeout: 600000
    });
}