(function ($) {

    $('.header__top-btn').on('click', function () {
        $('.mobmenu').addClass('active');
    });

    $('.header__mobile-dropdown').on('click', function () {
        $('.header-dropdown__popup').addClass('active');
    });

    $('.header-dropdown__close').on('click', function () {
        $('.header-dropdown__popup').removeClass('active');
        $('.menu__mobdropdown-listbox').removeClass('active');
        $('.mobmenu').removeClass('active');
    });

    $('.menu__mobdropdown-prev').on('click', function () {
        $('.menu__mobdropdown-listbox').removeClass('active');
    });

    $('.header-dropdown__popup-list li span').on('click', function () {
        $('.menu__mobdropdown-listbox').addClass('active');
    });

    $('.modal-pass__content label .eye').on('click', function () {
        if ($(this).prev("input").prop("type") === "text") {
            $(this).prev("input").prop("type", "password");
        } else {
            $(this).prev("input").prop("type", "text");
        }
    });


    $('.footer__column-title').on('click', function () {
        $(this).next(".footer__column-list").slideToggle();
        $(this).toggleClass('close');
        if($(this).parent().hasClass("footer__column footer__column-2")) {
            $('.footer-column-more').toggleClass('visible');
        }
    });



    $(".footer-column-more").click(function () {
        $(this).toggleClass("active");
        $(".footer__column-2 .footer__column-list").toggleClass("active");
    });

    $('.questions').on('click', '.questions__item', function () {
        $(this).next(".questions__item-answer").slideToggle();
        $(this).toggleClass('active');
    });

    $('.top__slider').slick({
        dots: true,
        prevArrow: '<button type="button" aria-label="предыдущий слайд" class="slider__btn slider__btn-prev"></button>',
        nextArrow: '<button type="button" aria-label="следующий слайд" class="slider__btn slider__btn-next"></button>',
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    arrows: false
                }
            }
        ]
    });

    $(function () {
        $('.login__form #inputIsLegalEntity, #legal-entity-input-cart').on('change', function () {
            if ($(this).prop('checked')) {
                $('.legal--entity').append(window.global_var.legalEntityTemplate);
            } else {
                $('.legal--entity label').remove();
            }
        });
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

    // radiobuttons toogle order
    $(".checkout__radio-form .delivery input[type=radio]").on('click', function(e){
        var thisRadio = $(this)[0].classList;
        $(".checkout__radio-box").slideUp();
        for (var i=0; i<thisRadio.length; i++) {
            if (thisRadio[i]=="js__delivery-pickup") {
                $(".delivery-pickup").slideToggle();
            } else if(thisRadio[i]=="js__delivery-postofficeNP") {
                $(".delivery-postofficeNP").slideToggle();
            } else if(thisRadio[i]=="js__delivery-courier") {
                $(".delivery-courier").slideToggle();
            } else if(thisRadio[i]=="js__delivery-postofficeOther") {
                $(".delivery-postofficeOther").slideToggle();
            }
        }
    });

    $('.js-blog-select').on('change', function () {
        $(this).parents('form').submit();
    });

    var reviewMark = $('#reviews_rating').attr('data-mark');
    var reviewOn = $('#reviews_rating').attr('data-star-on');
    var reviewOff = $('#reviews_rating').attr('data-star-off');
    $('#reviews_rating').raty({
        starOff: reviewOff,
        starOn: reviewOn,
        readOnly: false,
        scoreName: 'rating',
        score: reviewMark,
        hints: ['', '', '', '', ''],
    });

    $("#call-me").change(function() {
        if(this.checked) {
            $('#btn_callback').text($("#call-me").attr('data-checkbox-call_me'))
        }
    });

    function initMap() {
        // var dataXY = $('#map').data('coords'),
        //     console.warn(dataXY);
        //     newData = void 0;
        // newData = dataXY.split(',');
        var myLatlng = window.hydrogidGeo,
            mapOptions = {
                zoom: 16,
                center: myLatlng,
                scrollwheel: false,
                styles: [{ "stylers": [{ "saturation": -100 }, { "gamma": 0.8 }, { "lightness": 4 }, { "visibility": "on" }] }, { "featureType": "landscape.natural", "stylers": [{ "visibility": "on" }, { "color": "#5dff00" }, { "gamma": 4.97 }, { "lightness": -5 }, { "saturation": 100 }] }]
            };
        var map = new google.maps.Map(document.getElementById('map'), mapOptions),
            marker = new google.maps.Marker({
                position: myLatlng,
                map: map,
                icon: "/assets/frontend/images/marker.png"
            });
    }

    if (document.querySelector("#map")) initMap();

})(jQuery);
