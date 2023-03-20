function formatState(state) {
    if (!state.id || state.cover === undefined) {
        return state.text;
    } else {
        return $('<span><img src="/cache/prod_sm/' + (state.cover.image !== undefined ? state.cover.image : '') + '" width="40px" class="" /> ' + state.text + '</span>');
    }
}

Sortable.create(document.getElementById('group_products'), {
    animation: 150,
    handle: "tr"
});


$(document).ready(function () {
    var _products_search = $('.js_products_search');
    var _products_list = {};
    _products_search.select2({
        width: '100%',
        minimumInputLength: 3,
        allowClear: true,
        templateResult: formatState,
        placeholder: {
            id: "-1",
            text: window.custom_var.placeholder_products
        },
        ajax: {
            url: window.custom_var.product_search_url,
            dataType: 'json',
            data: function (params) {
                return {
                    q: params.term,
                    type: 'group'
                };
            },
            delay: 250,
            processResults: function (data) {
                data.map(function (item, i) {
                    data[i].text = item.full_name;
                    _products_list[item.id] = item;
                });
                return {
                    results: data
                };
            }

        }
    });
    $(document).on('click', '.js_parent', function () {
        $('.js_product_remove').attr('disabled', false);
        $(this).parents('tr').find('.js_product_remove').attr('disabled', true);
    });

    $(document).on('click', '.js_product_remove', function (e) {
        e.preventDefault();

        var _pid = $(this).parents('tr').data('product');
        var _parent = $('.js_parent:checked');

        $(this).parents('tr').remove();
        if (_parent.length === 0) {
            var new_parent = $('.js_parent:first');
            new_parent.prop('checked', true);
        }

        $.ajax({
            url: window.custom_var.product_remove_url + '/' + _pid + (new_parent !== undefined ? '/' + new_parent.val() : ''),
            method: 'post',
            success: function (data) {

            }
        });

    });

    _products_search.on('change.select2', function (e) {
        var _pid = $(this).val();
        if (_pid !== null) {
            if ($('[data-product="' + _products_list[_pid].id + '"]').length === 0) {
                _row = $(window.custom_var.product_template);
                _row.attr('data-product', _products_list[_pid].id);
                _row.find('img').attr('src', (_products_list[_pid].cover !== undefined && _products_list[_pid].cover.image !== undefined ? '/cache/prod_sm/' + _products_list[_pid].cover.image : ''));
                _row.find('.js_name').text(_products_list[_pid].full_name);
                _row.find('.js_sku').text(_products_list[_pid].sku);
                _row.find('.js_parent').val(_products_list[_pid].id);
                _row.find('.js_edit_product').attr('href', _row.find('.js_edit_product').attr('href').replace(/\/\/edit/gm, '/' + _products_list[_pid].id + '/edit'));
                _row.find('[name="products[]"]').val(_products_list[_pid].id);
                $('#group_products').append(_row.clone());
                $('#group_products tr:last input.flat').iCheck({
                    checkboxClass: 'icheckbox_flat-green',
                    radioClass: 'iradio_flat-green'
                });
            }
            _products_search.val(null).trigger('change.select2');
            _products_list = {};
        }
    });
});