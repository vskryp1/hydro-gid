window.getFiltersUrl = function () {
    var filter_url = [];
    var form_data  = {};
    var prices     = {};
    var slider     = {};
    var sorts      = {};
    var regexp = /filters\[(.*)\]\[\]|\[\]/gm;
    $.map($("#filters :not(.filter-url-ignore)").serializeArray(), function (n, i) {
        if (n['value'] !== '') {
            switch (n['name']) {
                case "_token":
                    break;
                case window.shop.filters.price:
                    n['value'] = n['value'].replace(',', window.shop.filters.value_value);
                    var _input = $('[name="' + n['name'] + '"]');
                    if (n['value'] !== _input.data('slider-min') + window.shop.filters.value_value + _input.data('slider-max')) {
                        prices[n['name']] = [n['value']];
                    }
                    break;
                case window.shop.filters.sort:
                    n['name'] = n['name'].replace(regexp, '$1');
                    if (n['value'] != 0) {
                        if (sorts[n['name']] === undefined) {
                            sorts[n['name']] = [n['value']];
                        } else {
                            sorts[n['name']].push(n['value']);
                        }
                    }
                    break;
                default:
                    if($('[name="' + n['name'] + '"]').attr('id') && $('[name="' + n['name'] + '"]').attr('id').includes(window.shop.filters.slider))
                    {
                        n['value'] = n['value'].replace(',', window.shop.filters.value_value);
                        var _input = $('[name="' + n['name'] + '"]');
                        if (n['value'] !== _input.data('slider-min') + window.shop.filters.value_value + _input.data('slider-max')) {
                            slider[n['name']] = [n['value']];
                        }
                    } else {
                        n['name'] = n['name'].replace(regexp, '$1');
                        if (form_data[n['name']] === undefined) {
                            form_data[n['name']] = [n['value']];
                        } else {
                            form_data[n['name']].push(n['value']);
                        }
                    }
                    break;
            }
        }
    });
    if (prices !== {}) {
        form_data = {...form_data, ...prices};
    }
    if (slider !== {}) {
        form_data = {...form_data, ...slider};
    }
    if (sorts !== {}) {
        form_data = {...form_data, ...sorts};
    }
    $.map(form_data, function (n, i) {
        filter_url.push(i + window.shop.filters.filter_value + n.join(window.shop.filters.value_value));
    });
    filter_url    = filter_url.join(window.shop.filters.filter_filter);

    return filter_url
        ? '/' + (window.shop.filters.start !== '' ? window.shop.filters.start + '/' : '') + filter_url
        : '';
};

function acceptFilters() {
    var filtersUrl = getFiltersUrl();
    history.pushState(null, null, window.shop.filters.url + filtersUrl);
    window.shop.filters.offset = 0;
    getFilterBlock(filtersUrl);
    $('body, html').removeClass('open-nav');
}

//slider range
function sliderInit(_slider) {
    if (_slider.length > 0) {
        _slider.slider({
            tooltip: 'always',
            tooltip_split: true,
            tooltip_position: 'bottom',
        }).on("slideStop", function (ev) {
            $(this).closest(".row-m").find("[name*='min']").val(ev.value[0]);
            $(this).closest(".row-m").find("[name*='max']").val(ev.value[1]);
        });
        $(document).on("change", ".range-slider-row .form-control", function (event) {
            alias = event.target.getAttribute('data-slider-alias');
            var newVal = parseInt($("." + alias + '-min').val());
            var nevVal = parseInt($("." + alias + '-max').val());
            $('#slider' + alias).val(newVal + ',' + nevVal);
        });
        $(document).on('keyup', ".range-slider-row .form-control", function (e) {
            this.value = this.value.replace(/[^0-9\.]/g, '');
        });
    }
}

function onHandlerFilter() {
    const btnOpenFilter = document.querySelector('.js-openFilter');
    const closeBlockFilter = document.querySelector('.js-close_filter');
    const closeOverlay = document.querySelector('.page-overlay');
    const blockFilter = document.querySelector('.filter-nav');

    btnOpenFilter.classList.remove("active");

    btnOpenFilter.addEventListener('click', function () {
        if ( blockFilter.classList.contains('open') ) {
            blockFilter.classList.remove('open');
            this.classList.remove('active');
            $('body, html').removeClass('open-nav');
        } else {
            blockFilter.classList.add('open');
            this.classList.add('active');
            $('body, html').addClass('open-nav');
        }
    });

    closeBlockFilter.addEventListener('click', () => {
        blockFilter.classList.remove('open');
        btnOpenFilter.classList.remove('active');
        $('body, html').removeClass('open-nav');
    });
    closeOverlay.addEventListener('click', () => {
        console.log('cfas');
        blockFilter.classList.remove('open');
        btnOpenFilter.classList.remove('active');
        $('body, html').removeClass('open-nav');
    });
}

if ( window.innerWidth <= 1030 && document.querySelector('.js-openFilter') !== null ) onHandlerFilter();

function getFilterBlock(filtersUrl) {
    $.ajax({
        url: window.shop.filters.ajax_url + filtersUrl,
        dataType: "json",
        data: {
            'path': window.location.pathname,
        },
        type: "GET",
        success: function (data) {
            $('.main').addClass('not-hover');
            if (data && data.html_products) {
                $('.js-products-block').html(data.html_products);
                data.showMoreAvailable
                    ? $('.js_show_more').removeClass('display-none')
                    : $('.js_show_more').addClass('display-none');
            }
            if (data && data.html_filters) {
                $('.js-filter-nav').replaceWith(data.html_filters);
                $('[id^="slider"]').each(function(){
                    sliderInit($("#" + $( this ).attr('id')));
                });
            }
            if (data && data.seo_meta) {
                document.title = data.seo_meta.seo_title;
                $("meta[name='description']").attr("content", data.seo_meta.seo_description);
                $("meta[name='keywords']").attr("content", data.seo_meta.seo_keywords);
                $("meta[name='robots']").attr("content", data.seo_meta.seo_robots);
                $("link[rel='canonical']").attr("href", data.seo_meta.seo_canonical);
                $('.seo__title').text(data.seo_meta.seo_h1);
                $('.products__title h1').text(data.seo_meta.seo_h1);
                if(data.seo_meta.seo_content === null || data.seo_meta.seo_content.length == 0) {
                    $('.seo__text').remove();
                } else {
                    if($('.sep__text-wrapper').find('div.seo__text').length === 0) {
                        $('.sep__text-wrapper').append('<div class="seo__text"></div>');
                        $('.seo__text').html(data.seo_meta.seo_content);
                    } else {
                        $('.seo__text').html(data.seo_meta.seo_content);
                    }
                }
            }
            if ( window.innerWidth <= 1030 && document.querySelector('.js-openFilter') !== null) onHandlerFilter();
            testWebP(function(supported) {
                if(supported){
                    lazySrcset();
                } else{
                    $('.lazy').Lazy();
                }
            });
            setTimeout(function(){
                ratySort();
                if (document.querySelector('.category-product')) {
                    heightDescription('.category-product .prod-cart__descr');
                    heightDescription('.category-product .prod-cart__list');
                    heightDescription('.category-product .prod-cart__bottom');
                }
                heightBlock();
            }, 500);
        }
    });
}
$(document).ready(function () {
    $(document).on('click', '.js-filter-more', function () {
        $(this).parents('.filter__items').toggleClass('checkbox-all');
        var toggleText = $(this).data('toggle-text');
        $(this).data('toggle-text', $(this).text())
            .text(toggleText);
    });
    $(document).on('click', '.js_filters_accept', function (e) {
        e.preventDefault();
        acceptFilters();
    });
    $(document).on('change', '.filter-item input[type="checkbox"], .select-filter select', function (e) {
        if(window.innerWidth > 1030) {
            acceptFilters();
        }
    });
    $(document).on('change', '.js_sort_select', function (e) {
        $('.main').addClass('not-hover');
        $('[name=sort]').val($(this).val());
        acceptFilters();
        $('select.js_sort_select option:first').attr({'disabled': true});
        testWebP(function(supported) {
            if(supported){
                lazySrcset();
            } else{
                $('.lazy').Lazy();
            }
        });
        setTimeout(function(){
            ratySort();
            if (document.querySelector('.category-product')) {
                heightDescription('.category-product .prod-cart__descr');
                heightDescription('.category-product .prod-cart__list');
                heightDescription('.category-product .prod-cart__bottom');
            }
            heightBlock();

        }, 1000);
    });
    $(document).on('click', '.sort-limit-accept', function (e) {
        $('.main').addClass('not-hover');
        e.preventDefault();
        $(this).addClass('active').siblings().removeClass("active");
        $('[name=limit]').val($(this).data('limit'));
        acceptFilters();
        testWebP(function(supported) {
            if(supported){
                lazySrcset();
            } else{
                $('.lazy').Lazy();
            }
        });
        setTimeout(function(){
            ratySort();
            if (document.querySelector('.category-product')) {
                heightDescription('.category-product .prod-cart__descr');
                heightDescription('.category-product .prod-cart__list');
                heightDescription('.category-product .prod-cart__bottom');
            }
            heightBlock();
        }, 1000);
    });

    if ($(window).width() <= 570) {
        $(document).on('click', '.js_open-filter', function () {
            $(this).closest('.input-field--inline').find('.input-field').slideToggle();
            $(this).closest('.input-field--inline').toggleClass('open');
        });
    }

    $(document).on('click', '.js_filter-mob', function () {
        $('.filter-nav').toggleClass('open-filters');
        var headerH = $('.header').outerHeight();
        $('.filter-nav').css('top', headerH);
        $('body').toggleClass('modal-open');
    });

    $(document).on('click', '.js_open-filter', function () {
        $(this).closest('.filter-wrapp').find('.filter__items').slideToggle();
        if ($(this).hasClass('close-filter')) {
            $(this).removeClass('close-filter');
        } else {
            $(this).addClass('close-filter');
        }
    });

    $(document).on('click', '.js-uncheck-filter-value', function (e) {
        $('.main').addClass('not-hover');
        e.preventDefault();
        let filterValId = $(this).data('id');
        let filterType = $(this).data('type');
        switch (filterType) {
            case "slider":
                $('#' + filterValId).prop('value', '');
                break;
            default:
                $('#' + filterValId).prop('checked', '');
                break;
        }
        acceptFilters();
        setTimeout(function(){
            ratySort();
            if (document.querySelector('.category-product')) {
                heightDescription('.category-product .prod-cart__descr');
                heightDescription('.category-product .prod-cart__list');
                heightDescription('.category-product .prod-cart__bottom');
            }
            heightBlock();
        }, 1000);
    });

    $(document).on('click', '.js-reset-all-filters', function (e) {
        $('.main').addClass('not-hover');
        e.preventDefault();
        $('#filters input[type=checkbox]').prop('checked', '');
        $('#filters input[type=hidden]').prop('value', '');
        $('[id^="slider"]').each(function(){
            $( this ).prop('value', '');
        });
        acceptFilters();
        setTimeout(function(){
            ratySort();
            if (document.querySelector('.category-product')) {
                heightDescription('.category-product .prod-cart__descr');
                heightDescription('.category-product .prod-cart__list');
                heightDescription('.category-product .prod-cart__bottom');
            }
            heightBlock();
        }, 1000);
    });
    //---------------------------------Prod Slider End---------------------------------------//
    $('[id^="slider"]').each(function(){
        sliderInit($("#" + $( this ).attr('id')));
    })




});
function getMaxOfArray(numArray) {
    return Math.max.apply(null, numArray);
}
function heightDescription(elem) {
    const descriptionList = document.querySelectorAll(elem);

    function getHeightList() {
        let getDescriptionListArray = [];

        for (let i = 0; i < descriptionList.length; i++) {
            getDescriptionListArray.push(descriptionList[i].clientHeight);
        }
        return getDescriptionListArray;
    }

    const maxHeightBlock = getMaxOfArray(getHeightList());

    for (let i = 0; i < descriptionList.length; i++) {
        descriptionList[i].style.minHeight = `${maxHeightBlock}px`;
    }
}
function heightBlock() {
    $('.js_height-block').each(function (i, e) {
            var elH = e.getElementsByClassName("height");
            var maxHeight = 0;
            for (var i = 0; i < elH.length; ++i) {
                elH[i].style.height = "";
                if (maxHeight < elH[i].clientHeight) {
                    maxHeight = elH[i].clientHeight;
                }
            }
            for (var i = 0; i < elH.length; ++i) {
                elH[i].style.height = maxHeight + "px";
            }
        }
    )
    itemProdHeight();
    if($('.not-hover').length){
        setTimeout(function () {
            $('.main').removeClass('not-hover');
        }, 1000)

    }
}
function itemProdHeight(){
    if($('.item-prod').length){
            $('.prod-cart').each(function (i,e) {
                var prodHeight = $(e).outerHeight();
                $(e).closest('.item-prod').css('min-height', prodHeight);
            });
    }
}
function ratySort() {
    if ($('.js_review').length) {
        $('.js_review-form').raty({
            starOff: 'images/off.svg',
            starOn: 'images/on.svg',
            readOnly: false,
            scoreName: 'rating',
            score: 5,
            hints: ['', '', '', '', ''],
        });

        $('.js_review').each(function (index, element) {
            var reviewMark = $(element).attr('data-mark');
            var reviewOn = $(element).attr('data-star-on');
            var reviewOff = $(element).attr('data-star-off');
            $(element).raty({
                starOff: reviewOff,
                starOn: reviewOn,
                readOnly: true,
                score: reviewMark,
                hints: ['', '', '', '', '']
            });
        });
    }
}
function testWebP(callback) {
    var webP = new Image();
    webP.src = 'data:image/webp;base64,UklGRi4AAABXRUJQVlA4TCEAAAAvAUAAEB8wAiMw' +
        'AgSSNtse/cXjxyCCmrYNWPwmHRH9jwMA';
    webP.onload = webP.onerror = function () {
        callback(webP.height === 2);
    };
};

function lazySrcset(){
    var srcsetItem = $('.lazy-srcset');
    srcsetItem.each(function (i,e){
        var srcset = $(e).attr('data-srcset');
        $(e).attr('srcset', srcset);
        $(e).removeAttr('data-srcset');
    })
}