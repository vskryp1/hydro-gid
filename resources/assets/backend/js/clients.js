$(document).ready(function () {
    $(document).on('click', '.js_add_field', function (e) {
        e.preventDefault();
        var field = $(this).closest('.js_fields_list').clone();
        $(field).find('input').val('');
        $(field).find('select').val('');
        $(this).closest('.js_parent').append(field);
    })

    $(document).on('click', '.js_remove_field', function (e) {
        e.preventDefault();
        if ($(this).parents('.js_parent').find('.js_fields_list').length > 1) {
            $(this).closest('.js_fields_list').detach();
        }
    })
});