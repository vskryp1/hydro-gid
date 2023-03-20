function formatState(state) {
    if (!state.id || state.cover === undefined) {
        return state.text;
    } else {
        return $('<span><img src="' + (state.image_url !== undefined ? state.image_url : '') + '" width="40px" class="" />' + state.text + '</span>');
    }
}

var _items_search = $('.js_items_search');
_items_search.select2({
    width: '100%',
    minimumInputLength: 3,
    allowClear: true,
    templateResult: formatState,
    placeholder: {
        id: "-1",
        text: 'Поиск...'
    },
    ajax: {
        url: () => window.custom_var.search_url,
        dataType: 'json',
        delay: 250,
        data: function (params) {
            return {
                q: params.term,
                type: 'query',
                currency: window.custom_var.currency,
            };
        },
        processResults: function (data) {
            data.map(function (item, i) {
                data[i].text = getText(item);
            });
            return {
                results: data
            };
        }

    }
});

$('#inputType').change(function() {
    model = $(this).val();
    $('#select2-inputObject-container').attr('title', 'Поиск...');
    _items_search.val(null).trigger("change");
    if(model !== ''){
        $('#inputObject').prop('disabled', false);
        switch (model){
            case 'App\\Models\\Page\\Page' : window.custom_var.search_url = window.custom_var.page_search_url;
                break;
            case 'App\\Models\\Product\\Product' : window.custom_var.search_url = window.custom_var.product_search_url;
                break;
        }
    } else {
        $('#inputObject').prop('disabled', 'disabled');
    }
});

function getText(item) {
    model = $('#inputType').val();
    let text = '';
    switch (model){
        case 'App\\Models\\Page\\Page' : text = item.name;
            break;
        case 'App\\Models\\Product\\Product' : text = item.full_name + ' - ' + item.price + ' ' + item.currency_order.sign;
            break;
    }
    return text;
}

$(document).ready(function () {
    $(document).on('click', '.js_product_remove', function (e) {
        e.preventDefault();
    });
});