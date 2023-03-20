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
    jsTree.bind("changed.jstree", function (e, data) {
        if (data.node) {
            $('#parent_page_id').val(data.node.id);
        }
    });
});
