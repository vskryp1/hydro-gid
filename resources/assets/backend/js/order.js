function formatState(state) {
    if (!state.id || state.cover === undefined) {
        return state.text;
    } else {
        return $('<span><img src="' + (state.image_url !== undefined ? state.image_url : '') + '" width="40px" class="" />' + state.text + '</span>');
    }
}

function calculateCart() {
    var _total = 0;
    var _product_items = $("#products .product-list tr");
    $('.js_no_item').hide();
    if (_product_items.length === 0) {
        $('.js_no_item').show();
    } else {
        _product_items.each(function () {
            var _item = $(this);
            _sum = parseFloat(_item.find('.js_price').val()) * parseInt(_item.find('.js_quantity').val());
            _sum += parseFloat(_item.find('.js_warranty_price').val()) * parseInt(_item.find('.js_quantity').val());
            _item.find(".js_sub_total").html(_sum.toFixed(2));
            _total += _sum;
        });
    }
    var _delivery = parseFloat($('.js_order_delivery').val());
    if(isNaN(_delivery)){
       _delivery = 0;
    }

    var _total_amount = _total + _delivery;
    if($('.js_order_discount').attr("data-order-discount-percentage") == 1){
        _total_amount -= parseFloat($('.js_order_discount').val())/100*_total_amount;
    } else {
        _total_amount -= parseFloat($('.js_order_discount').val());
    }

    $(".js_order_sum").html((_total_amount).toFixed(2));
}

$('#inputIsPercentage').change(function(){
    $('.js_order_discount').attr("data-order-discount-percentage", $('#inputIsPercentage').is(":checked") ? 1 : 0);
    calculateCart();
});

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
        delay: 250,
        data: function (params) {
            return {
                q: params.term,
                type: 'query',
                currency: $("[name=currency_id]").val(),
            };
        },
        processResults: function (data) {
            data.map(function (item, i) {
                data[i].text = item.full_name + ' - ' + item.price + ' ' + item.currency_order.sign;
                _products_list[item.id] = item;
            });
            return {
                results: data
            };
        }

    }
});

_products_search.on('change.select2', function (e) {
    var _pid = $(this).val();
    if (_pid !== null) {
        if ($('[data-product="' + _products_list[_pid].id + '"]').length > 0) {
            var _quantity = $('[data-product="' + _products_list[_pid].id + '"] .js_quantity');
            _quantity.val(parseInt(_quantity.val()) + 1);
        } else {
            _row = $(window.custom_var.product_template);
            _row.attr('data-product', _products_list[_pid].id);
            _row.find('img').attr('src', (_products_list[_pid].cover !== undefined && _products_list[_pid].cover.image !== undefined ? '/cache/prod_sm/'+_products_list[_pid].cover.image : ''));
            _row.find('.js_name').text(_products_list[_pid].format_name);
            _row.find('.js_option').text(_products_list[_pid].modification_name);
            _row.find('.js_price').attr('name', 'products[' + _products_list[_pid].id + '][price]');
            _row.find('.js_warranty_price').attr('name', 'products[' + _products_list[_pid].id + '][options][warranty][price]');
            _row.find('.js_warranty_amount').attr('name', 'products[' + _products_list[_pid].id + '][options][warranty][amount]');
            _row.find('.js_price').val(_products_list[_pid].price);
            _row.find('.js_quantity').attr('name', 'products[' + _products_list[_pid].id + '][qty]');
            $('#products .product-list').append(_row.clone());
        }
        _products_search.val(null).trigger('change.select2');
        _products_list = {};
        calculateCart();
    }
});

var _clients_search = $('.js_clients_search');
_clients_search.select2({
    width: '100%',
    minimumInputLength: 3,
    allowClear: true,
    placeholder: {
        id: "-1",
        text: window.custom_var.placeholder_clients
    },
    ajax: {
        url: window.custom_var.client_search_url,
        dataType: 'json',
        delay: 250,
        processResults: function (data) {
            data.map(function (item, i) {
                data[i].text = item.name;
            });
            return {
                results: data
            };
        }
    }
});
_clients_search.on('select2:opening', function(event){
    _clients_search.val(null);
});
_clients_search.on('select2:select', function (e) {
    $(".js_addresses").remove();
    $(".has-feedback input[type='text']").val('');
    $(".has-feedback input[type='email']").val('');
    $.ajax({
        type: "GET",
        url: window.custom_var.address_search_url + "/" + $(this).val(),
        data: {id: $(this).val()},
        success: function (data) {
            $('#name').val(data.name);
            $('#email').val(data.email);
            $('#contact-number').val(data.phone);
            $('#city').val('');
            $('#street').val('');
            $('#house').val('');
            if (data.addresses !== undefined && data.addresses.length > 0) {
                var addressSelect = $('<select name="address_id" class="form-control js_addresses">');
                addressSelect.appendTo('#exist-address');
                $.each(data.addresses, function (key, value) {
                    $("<option>").val(value.id).html(value.formatted).appendTo(addressSelect)
                        .attr('data-address-city', value.city)
                        .attr('data-address-street', value.street)
                        .attr('data-address-house', value.house);
                });
                $(".js_addresses").trigger('change')
            }
        }
    });
});

$(document).on('change', '.js_addresses', function () {
    _option = $(this).find('option:selected');
    $("[name=street]").val(_option.attr('data-address-street'));
    $("[name=house]").val(_option.attr('data-address-house'));
    $('#client .js-select-places').find('option').remove();
    var option = new Option(_option.attr('data-address-place-name'), _option.attr('data-address-place-id'), true, true);
    $('#client .js-select-places').append(option);
});


$(document).on('change', '.js_delivery', function(){
    $('.js-select-places').data('delivery', $(this).val());
    $('.js-select-places').html('');
    $('.js-select-np-warehouses').empty();
});

$(document).on('change', '.js_order_create', function(){
    _price = $(this).find('option:checked').attr('data-delivery-price');
    $(".js_order_delivery").val(_price);
    calculateCart();
});
$(".js_order_create").trigger('change');

$(document).on('change.select2', '.js_np_cities', function(){
    $('.js-select-np-warehouses').select2('destroy');
    $.ajax({
        url: window.shop.cart.urls.nova_poshta_warehouses[$('.js_delivery').val()] + '/' + $('.js_np_cities').val(),
        dataType: "json",
        type: "GET",
        success: function (data) {
            $('.js-select-np-warehouses').replaceWith(data.warehouses);
            if ($('.js-select-np-warehouses').length > 0) {
                $('.js-select-np-warehouses').select2({
                    placeholder: {
                        id: "-1",
                        text: ''
                    },
                    width: '100%',
                });
            }
        }
    });
});


$(document).ready(function () {
    $('.js-select-np-warehouses').select2({
        placeholder: {
            id: "-1",
            text: ''
        },
        width: '100%',
    });
    calculateCart();
    $(document).on('change', '.js_price, .js_quantity, .js_order_delivery, .js_order_discount', function (e) {
        var _val = $(this).val();
        if (_val === undefined || _val < $(this).attr('min') || _val === '') {
            $(this).val($(this).attr('min'));
        }
        calculateCart();
    });

    $(document).on('change', '.js_order_status', function (e) {
        $('.js_status_notification').iCheck('check');
    });
    $(document).on('click', '.js_product_remove', function (e) {
        e.preventDefault();
        $(this).parents('tr').remove();
        calculateCart();
    });
});