(function ($) {

    $('.product-one-slider__img').slick({
        slidesToShow  : 1,
        slidesToScroll: 1,
        arrows        : false,
        fade          : true,
        asNavFor      : '.product-one-slider__thumb'
    });
    $('.product-one-slider__thumb').slick({
        slidesToShow  : 4,
        slidesToScroll: 1,
        asNavFor      : '.product-one-slider__img',
        dots          : false,
        arrows        : false,
        focusOnSelect : true
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
    var $slickEl = $('.js-slider-prod');
    $slickEl.slick({
        slidesToShow: 6,
        infinite: true,
        slidesToScroll: 1,
        focusOnSelect: false,
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
                    arrows: false
                }
            },
        ]
    });

    $('.tab-container .tab-box').hide();
    $('.tab-container .tab-box:first').show();
    $('.tab-navigation li:first').addClass('active');

// Change tab class and display content
/*    $('.tab-navigation a').on('click', function(event){
        event.preventDefault();
        $('.tab-navigation li').removeClass('active');
        $(this).parent().addClass('active');
        $('.tab-container  .tab-box').hide();
        $($(this).attr('href')).show();
    });*/

    $('a.js_scroll-review').on('click', function(event) {
        event.preventDefault();
        var target = $( $(this).attr('href') );
        $(".tab-general-box .tab-navigation li:nth-child(3) a").trigger('click');
        if( target.length ) {
            $('html, body').animate({
                scrollTop: target.offset().top
            }, 800);
        }
    });

    $(document).ready(function() {
        let hash = window.location.hash;

        if(hash) {
            $(`.tab-general-box .tab-navigation li a[href=\"${hash}\"]`).trigger('click');
            if($(window.location.hash).length) {
                $('html, body').animate({
                    scrollTop: $(window.location.hash).offset().top - 20
                }, 500);
            }
        }
    });

    $(".tab-general-box .tab-navigation").on('click', 'li', function (e) {
        e.preventDefault();
        $(this).addClass("active").siblings().removeClass("active");
        $(".tab-general-box .tab-box").hide().eq($(this).index()).fadeIn();
    });

    $(".input-field").click(function (e) {
        e.preventDefault();
        $(".input-field").removeClass('focus');
        $(this).addClass('focus');
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

})(jQuery);


(function ($) {
    var _wW = $(window).width();

    $('.js_close-bnt').on('click', function () {
        $(this).parents('.tags__item').fadeOut();
    });

    $(document).ready(function() {
        let child = $('.characterisrics-prod li');
        if (child.length <= 4) {
            $('.js-btn-more-chk').hide();
        }
    });

    $('.js-btn-more-chk').on('click', function () {
        let child = $(this).prev().children('li');
        if (child.length > 4) {
            $('.characterisrics-prod').addClass('open');
            $(this).hide();
        }
    });


})(jQuery);

function onCopyList() {
    const copyList = document.querySelectorAll('.js-copy');

    for (let i = 0; i < copyList.length; i++) {
        copyList[i].addEventListener('click', function () {
            this.nextElementSibling.select();
            document.execCommand("copy");
        })
    }
}

if (document.querySelector('.js-copy') !== null) onCopyList();

if (window.innerWidth <= 650) $('.prod-feature-all').insertBefore('.item-prod-right');

$('.js-buy-in-one-click').on('click', function (event) {
    event.preventDefault();

    var $button = $(this),
        url = $button.data('href'),
        type = $button.data('method');

    var data = {
        pid: $button.data('pid'),
    };

    $.ajax({
        url: url,
        data: data,
        type: type,
        success: function (data) {
            Swal.fire({
                title            : data.title,
                html             : data.content,
                showConfirmButton: false
            });
            $('.js-swal-close').on('click', function (e) {
                e.preventDefault();
                $('.swal2-close').trigger('click');
            });
        }
    });
});
$('.js_put_in_waitinglist').on('click', function () {
    var $this = $(this);
    window.updateWaitingList($this, 'category', 'put');
});

$('.js_remove_from_waitinglist').on('click', function () {
    var $this = $(this);
    window.updateWaitingList($this, 'personal', 'remove');
});