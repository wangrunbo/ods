$(function () {
    initApplyForm();
});

function initApplyForm() {
    $('#form-apply').submit(function (e) {
        e.preventDefault();

        clear_validation_errors(this);

        $.ajax({
            url: $(this).attr('action'),
            data: $(this).serialize(),
            context: this
        }).done(function (res) {
            if ($.isEmptyObject(res.errors)) {
                $(this).parent().html(apply_complete_template);
            } else {
                set_validation_errors(this, res.errors);
                refresh_form_values(this, res.default);
            }
        }).fail(function (jqXHR) {
            console.error(jqXHR);

            alert('网络异常');
        });
    });
}