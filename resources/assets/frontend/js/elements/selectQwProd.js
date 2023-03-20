$(document).on('click', '.js_minus, .js_plus', function () {
    var increment = $(this).hasClass('js_plus') ? 1 : -1;
    var $input    = $(this).parent().find('input');
    var count     = parseInt($input.attr('value')) + increment;
    count         = count < 1 ? 1 : count;
    $input.attr('value', count);
    $input.change();
    var $this      = $(this);
    var inputVal   = $input.attr('value');
    var inputValue = +inputVal;
    if (inputValue <= 1) {
        $(this).addClass('btn-count--disable')
    } else {
        $(this).removeClass('btn-count--disable')
    }
    $input.val(inputValue);
    if (!$input.hasClass('product-page-increment')) {
        updateCartQty(inputValue, $input);
    }
});

function updateCartQty(count, element) {
    $.ajax({
               url:     element.data('action') + '/' + count,
               type:    element.data('method'),
               success: function (data) {
                   var $baksetItem = element.parents('.js-basket__item');
                   var prodPrice = parseFloat($baksetItem.find('.js-price-block').data('price')) * count;
                   var prodDiscountPrice = parseFloat($baksetItem.find('.js-price-block').data('discount-price')) * count;
                   $baksetItem.find('.js-sum-item-price').text(priceFormat(prodPrice));
                   $baksetItem.find('.js-sum-item-price').attr('data-sum-price', prodPrice);
                   $baksetItem.find('.js-sum-item-price').attr('data-sum-discount-price', prodDiscountPrice);
                   updateCartSummary();
               }
           });
}

$('.js-basket-item-delete').on('click', function (e) {
    e.preventDefault();
    var self = $(this);
    $.ajax({
               url:     self.data('href'),
               type:    self.data('method'),
               success: function (data) {
                   self.parents('.js-basket__item').remove();
                   redirectIfCartIsEmpty(data);
                   updateCartSummary();
               }
           });
});

$('.js-basket__clear').on('click', function (e) {
    e.preventDefault();
    var self = $(this);
    $.ajax({
               url:     self.data('href'),
               type:    self.data('method'),
               success: function (data) {
                   $('.js-basket__item').remove();
                   redirectIfCartIsEmpty(data);
                   updateCartSummary();
               }
           });
});

function updateCartSummary() {
    let count = calculateCartAmount();
    updateCartCounter(count);
    updateCartSidebarCounter(count);
    updateCartTotal();
}

function redirectIfCartIsEmpty (response) {
    if(response && response.redirect){
        window.location.href = response.redirect;
    }
}


function updateCartTotal() {
    let sum = 0;
    let sumWithDiscount = 0;
    $('.js-basket__item .js-sum-item-price').each(function () {
        sum += parseFloat($(this).attr('data-sum-price'));
        sumWithDiscount += parseFloat($(this).attr('data-sum-discount-price'));
    });
    let deliveryPrice = $('.js-basket-delivery-price').data('delivery-price')
                        ? $('.js-basket-delivery-price').data('delivery-price')
                        : 0;
    $('.js-checkout-discount').text(priceFormat(sum - sumWithDiscount));
    $('.js-sum-prod-price').text(priceFormat(sum + deliveryPrice));
    $('.js-checkout-total-price').text(priceFormat(sumWithDiscount + deliveryPrice));
}

function calculateCartAmount() {
    var count = 0;
    $('.js-changeAmount').each(function () {
        count += parseInt($(this).val());
    });
    return count;
}

function updateCartSidebarCounter(count) {
    $('.js-prod-count').text(count);
}