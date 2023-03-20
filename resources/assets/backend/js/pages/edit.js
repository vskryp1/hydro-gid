$(document).ready(function () {
    $(document).on('submit', '#needs-validation', function (event) {
        form = $(this)[0];
        if (form.checkValidity() === false) {
            var errMessage = "";
            $(this).find(':invalid').each(function (errIndex) {
                errMessage = errMessage + " " + ++errIndex + ') ' + this.placeholder + "<br>";
            });
            form.classList.add('was-validated');
            toastr.error(errMessage, 'Required fields:');
            return false;
        }
    });

    $('.modal').on('shown.bs.modal', function () {
        $('[data-toggle=toggle]').bootstrapToggle('destroy');
        $('[data-toggle=toggle]').bootstrapToggle();
    })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function () {
        $('[data-toggle=toggle]').bootstrapToggle('destroy');
        $('[data-toggle=toggle]').bootstrapToggle();
    });

    jsTree.bind("changed.jstree", function (e, data) {
        if (data.node && data.node.state.selected) {
            $('#parent_page_id').val(data.node.id);
        }
    });
});
