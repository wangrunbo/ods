"use strict";
$(function () {
    initAjax();
    initTextEditor();
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

            let container = $('.validationContainer-' + name);
            if (container.length > 0) {
                container.append(template);
            } else {
                field.after(template);
            }
        })
    });
}

function clear_validation_errors(form, fields) {
    if (!form) {
        form = $('body');
    }

    if (fields === undefined) {
        $(form).find('.validation-error').remove();
    } else {
        if (typeof fields === 'string') {
            fields = [fields];
        }

        $.each(fields, function (index, name) {
            $(form).find('#validation-' + name + '.validation-error').remove();
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

function initTextEditor() {
    let textBlock = $('.textEditor-text');
    let editorBlock = $('.textEditor-editor');

    // 开始编辑
    $('.textEditor-text .buttonContainer i').click(function () {
        let textEditor = $(this).closest('.textEditor');

        textEditor.find('.textEditor-text').hide();
        textEditor.find('.textEditor-editor').show();
    });

    // 取消编辑
    $('.textEditor-editor .buttonContainer .cancel').click(function () {
        let textEditor = $(this).closest('.textEditor');

        textEditor.find('.textEditor-editor').hide();
        textEditor.find('.textEditor-text').show();

        textEditor.find('.textEditor-editor input[type="text"]').val(
            textEditor.find('.textEditor-text span.textContainer').text()
        );
    });

    // 上传编辑
    $('.textEditor-editor form').submit(function (e) {
        e.preventDefault();

        clear_validation_errors(this);

        $.ajax({
            url: $(this).attr('action'),
            data: $(this).serialize(),
            context: this
        }).done(function (res) {
            if ($.isEmptyObject(res.errors)) {
                let textEditor = $(this).closest('.textEditor');

                $.each(res.default, function (key, value) {
                    textEditor.find('.textEditor-text span.textContainer').text(value);
                });

                textEditor.find('.textEditor-editor').hide();
                textEditor.find('.textEditor-text').show();
            } else {
                set_validation_errors(this, res.errors);
            }

            refresh_form_values(this, res.default);
        }).fail(function (jqXHR) {
            console.error(jqXHR);

            alert('网络异常');
        });
    });
}