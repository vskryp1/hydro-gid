(function ($) {

    // $('.header__menu-dropdown').on('click', function () {
    //     let menuDropdownWrapper = $('.menu__dropdown');
    //     menuDropdownWrapper.slideToggle();
    // });

    $('.btn-filter-mob').on('click', function () {
        $('.column-right').toggleClass('open-filter');
    });


    var $slickEl = $('.js-slider-prod');
    $slickEl.slick({
        slidesToShow: 6,
        infinite: true,
        slidesToScroll: 1,
        focusOnSelect: true,
        dots: false,
        prevArrow: '<button type="button" class="slick-prev"><i class="icon icon-right"></i></button>',
        nextArrow: '<button type="button" class="slick-next"><i class="icon icon-left"></i></button>',

        responsive: [
            {
                breakpoint: 1370,
                settings: {
                    adaptiveHeight: true,
                    slidesToShow: 5
                }
            },
            {
                breakpoint: 992,
                settings: {
                    adaptiveHeight: true,
                    slidesToShow: 3
                }
            },
            {
                breakpoint: 700,
                settings: {
                    adaptiveHeight: true,
                    slidesToShow: 2
                }
            },
            {
                breakpoint: 600,
                settings: {
                    infinite: false,
                    slidesToShow: 2.5,
                    arrows: false
                }
            },
            {
                breakpoint: 440,
                settings: {
                    infinite: false,
                    slidesToShow: 1.5,
                    arrows: false,
                }
            },
        ]
    });


    $('.sort-select').each(function (i, e) {
        var placeholder = $(e).attr('data-placeholder');
        var select = $(e).find('select');
        $(e).select2({
            placeholder: {
                id: '-1',
                text: placeholder
            },
            theme: 'sort select2-container--default',
            minimumResultsForSearch: -1,
            width: '100%'

        });
    });


    var _wW = $(window).width();

    $('.js_close-bnt').on('click', function () {
        $(this).parents('.tags__item').fadeOut();
    });

    $('.js_btn-more').on('click', function () {
        $('.selections__parent').toggleClass('open');
    });

    $('.checkout__step-next').on('click', function (e) {
        let step = 1;
        e.preventDefault();
        var form = $('#page-register-form');
        form.submit();
        if($('.checkout').data('step') == 1){
            productOrderEvent(step);
        }
    });

    $('.js-checkout__step-next').on('click', function (e) {
        e.preventDefault();
        let step = 2;
        var form = $('#delivery_payment_form');
        if (form.valid()) {
            $(this).hide();
        }
        form.submit();
        productOrderEvent(step);
    });

    function productOrderEvent(step) {
        $('.checkout__aside-info').each(function () {
            if($(this).data('name')){
                window.dataLayer = window.dataLayer || [];
                dataLayer.push({
                    'ecommerce': {
                        'currencyCode': 'UAH',
                        'checkout': {
                            'actionField': {'step': step},
                            'products': [{
                                'name': $(this).data('name'),
                                'id': $(this).data('sku'),
                                'price': $(this).data('price'),
                                'brand': $(this).data('brand'),
                                'category': $(this).data('category'),
                                'quantity': $(this).data('qty')
                            }]
                        }
                    },
                    'event': 'gtmUaEvent',
                    'gtmUaEventCategory': 'Enhanced Ecommerce',
                    'gtmUaEventAction': 'Checkout Step ' + step,
                    'gtmUaEventNonInteraction': 'True'
                });
            }
        });
    }

    var deliveries = new Deliveries();
    var payments = new Payments();

    function changeDeliveryBlock() {
        const addresses = document.querySelectorAll(".js-delivery-address");
        const addressBlock = document.querySelector('.delivery_address');
        const deliveryCitySelect2 = $('#delivery_place_id');
        for (let i = 0; i < addresses.length; i++) {
            addresses[i].addEventListener("click", function () {
                let isNewAddress = this.classList.contains('newAddressRadio');
                if (isNewAddress) {
                    $('.delivery_address').show();
                } else {
                    $('.delivery_address').hide();
                }
            });
        }
    }

    $('.js-delivery-radio').on('click', function (e) {
        let deliveryId = $(this).val();
        let deliveryAction = $(this).data('type').toLowerCase();
        $('.js-delivery-type').addClass('display-none');
        $('.js-' + deliveryAction).removeClass('display-none');
        $('.js-delivery-type-input').val($(this).data('type-id'));
        deliveries.setDelivery(deliveryId);
        deliveries.setDeliveryType(deliveryAction);
        runFunction(deliveries, deliveryAction);
        setTimeout(() => changeDeliveryBlock(), 1000);
    });


    $('.js-payment-radio').on('click', function (e) {
        let paymentId = $(this).val();
        let paymentAction = $(this).data('type').toLowerCase();
        $('.js-payment-type').addClass('display-none');
        $('.js-' + paymentAction).removeClass('display-none');
        $('.js-payment-type-input').val($(this).data('type-id'));
        payments.setPaymentId(paymentId);
        payments.changePayment();
    });

    $('.js-delivery-radio:checked').trigger('click');
    $('.js-payment-radio:checked').trigger('click');

    /**
     *
     * @param object context
     * @param string name
     * @param array  data
     */
    function runFunction(context, name, data = []) {
        var fn = context[name];
        if (typeof fn !== 'function')
            return;
        fn.apply(context, data);
    }

    function Deliveries() {
        /**
         *
         * @type {Array}
         */
        this.renderDeliveries = [];

        /**
         *
         * @type {int}
         */
        this.deliveryId = 0;

        /**
         *
         * @type {string}
         */
        this.deliveryType = '';

        /**
         *
         * @type {bool}
         */
        this.withWareHouses = false;

        /**
         *
         * @type {bool}
         */
        this.withDeliveryPlaceSelect = false;

        /**
         *
         * @param {int} deliveryId
         */
        this.addRenderedDelivery = function (deliveryId) {
            this.renderDeliveries.push(deliveryId);
        };

        /**
         *
         * @param {string} type
         */
        this.setDeliveryType = function (type) {
            this.deliveryType = type;
        };

        /**
         *
         * @param {int} deliveryId
         */
        this.setDelivery = function (deliveryId) {
            this.deliveryId = (deliveryId);
        };

        /**
         *
         * @param {string} url
         * @param {string} param
         */
        this.addParamToUrl = function (url, param) {
            return url + '/' + param;
        };

        /**
         *
         * @param {float} deliveryPrice
         * @param {float} totalPrice
         *
         */
        this.updatePrices = function (deliveryPrice, totalPrice) {
            if (typeof totalPrice === 'string' || totalPrice instanceof String){
                totalPrice = totalPrice.replace(/\s/g, '');
            }
            $('.js-checkout-delivery-price').text(deliveryPrice);
            $('.js-checkout-total-price').text(priceFormat(totalPrice));
        };

        /**
         *
         * @param {bool} deliveryId
         */
        this.isDeliveryRendered = function (deliveryId) {
            return this.renderDeliveries.indexOf(deliveryId) !== -1;
        };

        /**
         *
         */
        this.pickup_np = function () {
            this.withWareHouses = true;
            this.withDeliveryPlaceSelect = true;
            this.changeDelivery(true);
        };

        this.changeDelivery = function () {
            var self = this;
            var rendered = self.isDeliveryRendered(self.deliveryId);
            $.get(window.routes.change_delivery + '/' + self.deliveryId + '/' + rendered, function (data) {
                    if (data.html) {
                        $('.js-delivery-blocks').append(data.html);
                        if (self.withDeliveryPlaceSelect) {
                            self.initSelectDeliveryPlace();
                        }
                        if (self.deliveryType === 'pickup') {
                            self.renderMap(window.hydrogidGeo, window.hydrogidTitle);
                        }
                        self.addRenderedDelivery(self.deliveryId);
                    }
                    let deliveryBlock = $('.js-checkout-delivery-price').parents('.basket__summarize-item');
                    if (data.deliveryPrice && data.totalPrice) {
                        deliveryBlock.removeClass('d-none');
                        self.updatePrices(data.deliveryPrice, data.totalPrice);
                    } else if (data.totalPrice) {
                        deliveryBlock.addClass('d-none');
                        self.updatePrices(data.deliveryPrice, data.totalPrice);
                    }
                }
            );
        };

        /**
         *
         */
        this.pickup = function () {
            this.changeDelivery();
        };

        /**
         *
         */
        this.courier_np = function () {
            this.withDeliveryPlaceSelect = true;
            this.changeDelivery();
        };

        /**
         *
         */
        this.delivery_company = function () {
            this.changeDelivery();
        };

        /**
         *
         */
        this.initSubSelectBranch = function (url) {
            let self = this;
            $.get(url, function (data) {
                    if (data.warehouses) {
                        var select2Class = data.select2_class ? data.select2_class : '';
                        var deliveryBlock = $('.js-' + self.deliveryType + ' .warehouses-block');
                        var deliverySelectElem = deliveryBlock.find(select2Class);
                        deliverySelectElem.next('span.select2').remove();
                        deliverySelectElem.replaceWith(data.warehouses);
                        deliverySelectElem = deliveryBlock.find(select2Class);
                        self.initSelect(deliverySelectElem);
                        self.initSubSelectHandlers(deliverySelectElem);
                    }
                }
            );
        };

        /**
         *
         */
        this.checkSubSelectBranch = function (select2Elem) {
            let self = this;
            if (select2Elem.data('url')) {
                select2Elem.on('select2:opening', function (event) {
                    select2Elem.val(null);
                }).on("select2:select", function (e) {
                    self.initSubSelectBranch(self.addParamToUrl(select2Elem.data('url'), this.value));
                });
            }
        };

        this.initSelectDeliveryPlace = function () {
            let self = this;
            let select2Element = $('.js-' + self.deliveryType + ' .delivery-select');
            this.initSelect(select2Element, this.addParamToUrl(window.routes.search_delivery, this.deliveryId));
            this.checkSubSelectBranch(select2Element);
        };

        this.initSelect = function (select2Element, url = null) {
            let self = this;
            let initData = {
                width: '100%'
            };
            if (url) {
                initData.minimumInputLength = 3;
                initData.language = {
                    inputTooShort: function(args) {
                        return window.translates.search_message;
                    },
                    noResults: function(){
                        return window.translates.not_found_message;
                    },
                    searching: function() {
                        return window.translates.searching_message;
                    }
                };
                initData.placeholder = {
                    id: 0,
                    text: window.translates.search
                };
                initData.ajax = {
                    delay: 250,
                    url: url,
                    data: function (params) {
                        return {
                            search: params.term,
                        };
                    },
                    processResults: function (data, params) {
                        return {
                            results: data,
                        };
                    },
                }
            }
            select2Element.select2(initData);
            select2Element.on('change', function () {
                $('.js-city-hidden').val($(this).text());
            })
        };

        this.initSubSelectHandlers = function (select2Element) {
            let self = this;
            self.initMap(select2Element);
            select2Element.on('select2:opening', function (event) {
                select2Element.val(null);
            }).on("select2:select", function (e) {
                self.initMap(select2Element);
            });
        };

        this.initMap = function (select2Element) {
            let checked = select2Element.find('option:checked');
            let geo = {
                lng: parseFloat(checked.data('longitude')),
                lat: parseFloat(checked.data('latitude'))
            };
            this.renderMap(geo, select2Element.text());
        };

        this.renderMap = function (geo, title) {
            var map = new google.maps.Map(document.getElementById('map-' + this.deliveryId), {
                center: geo,
                zoom: window.data.map_zoom
            });
            var marker = new google.maps.Marker({
                position: geo,
                map: map,
                title: title
            });
        }
    }

    function Payments() {
        /**
         *
         * @type {int}
         */
        this.paymentId = 0;

        /**
         *
         * @type {string}
         */
        this.paymentType = '';

        /**
         *
         * @param {int} paymentId
         */
        this.setPaymentId = function (paymentId) {
            this.paymentId = paymentId;
        };

        this.changePayment = function () {
            var self = this;
            $.get(window.routes.change_payment + '/' + self.paymentId, function (data) {
                console.log($('.js-payments-blocks').children().length == 0, $('.js-payments-blocks').children().length, data.html === "", data.html);
                if (data.html && $('.js-payments-blocks').children().length == 0) {
                    $('.js-payments-blocks').append(data.html);
                    var res = PP_CALCULATOR.calculatePhys(1, window.totalProductsPrice);
                    $(".payparts_month").text(res.ppValue);
                    $("#js-payparts-first-payment").text(res.ppValue);
                    $('.payparts-first-payment').show();
                    $('.select-list').each(function (i, e) {
                        var placeholder = $(e).attr('placeholder');
                        $(e).select2({
                            placeholder: {
                                id: '-1',
                                // the value of the option
                                text: placeholder
                            },
                            minimumResultsForSearch: -1,
                            width: '100%'
                        });
                    });
                } else if(data.html === "") {
                    $('.js-payments-blocks').empty();
                    $('.payparts-first-payment').hide();
                }
            });
        };

    }

    $(document).on('change', '#payparts_month', function () {
        res = PP_CALCULATOR.calculatePhys($(this).find(":selected").attr("data-credit-term"), window.totalProductsPrice);
        $(".payparts_month").text(res.ppValue);
        $("#js-payparts-first-payment").text(res.ppValue);
    });

    $(document).on('click', '.js_put_in_waitinglist', function () {
        var $this = $(this);
        window.updateWaitingList($this, 'category', 'put');
    });

})(jQuery);
