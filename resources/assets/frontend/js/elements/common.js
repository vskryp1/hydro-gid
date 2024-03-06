require('../libs/mask');
require('./preloader');
import 'jsvalidation';
//--------------------------------- Shop logic ---------------------------------//
var _wW = $(window).width();
(function () {
    "use strict";
    var body = document.querySelector('body'),
        isMobile = false,
        scrollTopPosition,
        browserYou,
        _winWidth = $(window).outerWidth();
    var genFunc = {
        initialized: false,
        initialize: function () {
            if (this.initialized) return;
            this.initialized = true;
            this.build();
        },
        build: function () {
            // browser
            browserYou = this.getBrowser();
            if (browserYou.platform == 'mobile') {
                isMobile = true;
                document.documentElement.classList.add('mobile');
            } else {
                document.documentElement.classList.add('desktop');
            }
            if ((browserYou.browser == 'ie')) {
                document.documentElement.classList.add('ie');
            }
            if (browserYou.browser == 'firefox') {
                document.documentElement.classList.add('fox');
            }
            if (navigator.userAgent.indexOf("Edge") > -1) {
                document.documentElement.classList.add('edge');
            }
            if (navigator.userAgent.search(/Macintosh/) > -1) {
                document.documentElement.classList.add('macintosh');
            }
            if ((browserYou.browser == 'ie' && browserYou.versionShort < 9) || ((browserYou.browser == 'opera' || browserYou.browser == 'operaWebkit') && browserYou.versionShort < 18) || (browserYou.browser == 'firefox' && browserYou.versionShort < 30)) {
                alert('Обновите браузер');
            }
            if (document.querySelector('.yearN') !== null) {
                this.copyright();
            }
            $(document).on('mouseover', '.js-navbar', function () {
                $(this).find('.js_dropdown').removeClass('visible');
                $(this).find('.js_dropdown').addClass('visible');
            });
            $(document).on('mouseout', '.js-navbar', function () {
                $(this).find('.js_dropdown').removeClass('visible');
            });

            if ($('.last-level').length) {
                sidebarH();
            }

            $('.js_open-cat').on('click', function () {
                $('.sidebar').toggleClass('vis-sidebar-table');
                $('html').toggleClass('open-sidebar--click');
                heightBlock();
            });
            $('.page-overlay').on('click', function () {
                $('html').removeClass('open-sidebar--click');
                if (_winWidth > 319) {
                    $('html').removeClass('open-sidebar');
                }
            });

            function sidebarH() {
                var lastL = $('.container').outerWidth() - $('.first-level').outerWidth() - $('.second-level').outerWidth();
                var lastLh = $('.first-level').outerHeight() - $('.sidebar-title').outerHeight();
                var lastLwidth = lastL + 'px';
                var lastLheight = lastLh + 'px';
                $('.last-level').css({'width': lastLwidth, 'height': lastLheight});
            }

            $('.tab-contact').each(function (i, e) {
                $(e).tabArt({
                    hash: false,
                    active: 1,
                    afterShow: function () {
                        setTimeout(function () {
                            $('.tab-box').not('.active').removeClass('visible');
                            $('.tab-box.active').addClass('visible');
                        }, 150);
                    }
                });
            });

            $('.js-cont-btn').on('mouseenter', function () {
                var $this = $(this);
                $this.addClass('visible');
                $('html').addClass('open-contact');
            });
            $('.js-cont-btn').on('mouseleave', function () {
                var $this = $(this);
                $this.removeClass('visible');
                $('html').removeClass('open-contact');
            });

            function myFunction() {
                var left = $('.mCSB_dragger').css("left");
                var item = $(document).find("#myBar");
                item.css("width", left);
            }

            /**===================================== scroll-review =====================================*/

            $(document).on('click', '.js_scroll-review', function (event) {
                if (_winWidth > 600) {
                    var anchor = $(this);
                    $('html, body').animate({
                        scrollTop: $(anchor.attr('href')).offset().top - 80
                    }, 500);
                    $(anchor.attr('href')).click();
                    return false;
                } else {
                    event.preventDefault();
                }
            });
            /**===================================== scroll-review end=====================================*/
            $('.js_open-box').on('click', function () {
                var _$this = $(this);
                $('.prod-accord-box').removeClass('open');
                $('.prod-accord-box').find('.js_content-bottom').slideUp();
                var _$thisPar = _$this.closest('.prod-accord-box');
                if (_$thisPar.hasClass('open')) {
                    _$thisPar.removeClass('open');
                    _$thisPar.find('.js_content-bottom').slideUp();
                } else {
                    _$thisPar.addClass('open');
                    _$thisPar.find('.js_content-bottom').slideDown();
                }
            });
            $('.js_open-content-btn').on('click', function () {
                var $this = $(this);
                var reviewAll = $this.closest('.js_content-bottom');
                var reviewBlock = $this.closest('.js_content-bottom').find('.js_vis-text');
                var reviewHeight = reviewBlock.height();
                if (reviewBlock.hasClass('vis-text-all')) {
                    reviewBlock.removeClass('vis-text-all');
                    reviewBlock.addClass('review-shadow');
                    $this.find('i').css('transform', 'rotate(0deg)');
                } else {
                    reviewBlock.addClass('vis-text-all');
                    reviewBlock.removeClass('review-shadow');
                    $this.find('i').css('transform', 'rotate(180deg)');
                }
                gallSwiperFunc();
            });






            $(document).on('click', '.js_open-main-menu', function () {
                $('.main-navigation-mobile').toggleClass('is-active');
                $('html').toggleClass('main-navigation-mobile-is-open');
            });

            $('.js_close-menu, .page-overlay').on('click', function () {
                $('.main-navigation-mobile').removeClass('is-active');
                $('html').removeClass('main-navigation-mobile-is-open');
                $('.sidebar').removeClass('vis-sidebar-table');
            });

            if ($('.js_star-box-mob').length) {
                var mark = $('.js_star-box-mob').closest('.star-box').find('.js_review').attr('data-mark');
                $('.js_star-box-mob').text(mark);
            }

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

            $("[type=file]").on("change", function () {
                // Name of file and placeholder
                var file = this.files[0].name;
                var dflt = $(this).attr("data-textfile");
                if ($(this).val() != "") {
                    $(this).next().text(file);
                } else {
                    $(this).next().text(dflt);
                }
            });

            //---------------------------------Footer Start---------------------------------------//
            function CallWhenResize(obj) {
                this.obj = obj;
                var _this = this;
                this.autoWidth();
                $(window).resize(function () {
                    _this.autoWidth()
                });
            }

            CallWhenResize.prototype.autoWidth = function () {
                var _w = $(window).width();
                if (_w > 800) {
                    this.maxWidth();
                }
                if (_w <= 800) {
                    this.minWidth();
                }
            };
            CallWhenResize.prototype.minWidth = function () {
                return this.obj.minWidth ? this.obj.minWidth() : null
            };
            CallWhenResize.prototype.maxWidth = function () {
                return this.obj.maxWidth ? this.obj.maxWidth() : null
            };
            var isMaxWidth = true;
            new CallWhenResize({
                minWidth: function () {
                    if (isMaxWidth) {
                        console.warn('minWidth');
                        var _$thisElem = $('.js_foot-open');
                        _$thisElem.closest('.footer-nav__title').next('.footer-nav__list').slideUp();
                        _$thisElem.removeClass('open');
                        $(document).on('click', '.js_foot-open', function () {
                            var $this = $(this);
                            $this.closest('.footer-nav__title').next('.footer-nav__list').slideToggle();
                            $this.toggleClass('open');
                        });
                    }
                    isMaxWidth = false;
                },
                maxWidth: function () {
                    if (!isMaxWidth) {
                        var _$thisElem = $('.js_foot-open').find('.footer-open');
                        _$thisElem.closest('.footer-nav__title').next('.footer-nav__list').slideDown();
                        _$thisElem.addClass('open');
                        $(document).off('click', '.js_foot-open');
                    }
                    isMaxWidth = true;
                },
            });
            //---------------------------------Footer End---------------------------------------//
            $('.js_tab').tabArt({
                hash: true,
                active: 1
            });
            $('.tab-news').tabArt({
                hash: false,
                active: 1,
                afterShow: function () {
                    // if (_winWidth > 600) {
                    //     heightBlockBlog();
                    // }
                    heightBlock();
                    setTimeout(function () {
                        $('.tab-box').not('.active').removeClass('visible');
                        $('.tab-box.active').addClass('visible');
                    }, 150);
                }
            });
            $('.tab-feature').tabArt({
                hash: false,
                active: 1,
                afterShow: function () {
                    setTimeout(function () {
                        $('.tab-box').not('.active').removeClass('visible');
                        $('.tab-box.active').addClass('visible');
                    }, 50);
                }
            });
            $('.tab--fill').tabArt({
                hash: false,
                active: 1,
                afterShow: function () {
                    setTimeout(function () {
                        $('.tab-box').not('.active').removeClass('visible');
                        $('.tab-box.active').addClass('visible');
                    }, 50);
                    $('.tab--form').tabArt({
                        hash: false,
                        active: 1,
                        afterShow: function () {
                            setTimeout(function () {
                                $('.tab-box').not('.active').removeClass('visible');
                                $('.tab-box.active').addClass('visible');
                            }, 50);
                        }
                    });
                    gallSwiperFunc();
                }
            });
            $('.tab--form--mob').tabArt({
                hash: false,
                active: 1,
                afterShow: function () {
                    setTimeout(function () {
                        $('.tab-box').not('.active').removeClass('visible');
                        $('.tab-box.active').addClass('visible');
                    }, 50);
                }
            });

            //--------------------------------- Filters start ---------------------------------//
            var rangeSlider = function () {
                var slider = $('.range-slider'),
                    range = $('.range-slider__range'),
                    value = $('.range-slider__value');
                slider.each(function () {
                    value.each(function () {
                        var value = $(this).prev().attr('value');
                        $(this).html(value);
                    });
                    range.on('input', function () {
                        $(this).next(value).html(this.value);
                    });
                });
            };
            rangeSlider();
            //--------------------------------- Filters start ---------------------------------//
            $('.select-list').each(function (i, e) {
                var placeholder = $(e).attr('placeholder');
                $(e).select2({
                    placeholder: {
                        id: '-1', // the value of the option
                        text: placeholder
                    },
                    minimumResultsForSearch: -1,
                    width: '100%'
                });
            });

            $(".js_many-levels-item").on("click", function (e) {
                $(this).closest(".many-levels-item").find(".menu-drop-down").slideToggle("slow");
                e.preventDefault();
                $(this).hasClass("active-arr") ? $(this).removeClass("active-arr") : $(this).addClass("active-arr");
            })
            //--------------------------------- Shop logic ---------------------------------//
            var hash = window.location.hash.replace('=', '');
            if (hash !== '' && hash) {
                var active_modal = $(hash + '.modal-g');
                if (active_modal.length > 0) {
                    // active_modal.modal('show')
                    $.fancybox.open({src: hash + '.modal-g'});
                }
                var _tab = $(".tab-navigation li [href='" + hash + "']");
                if (_tab.length > 0) {
                    _tab.trigger("click");
                    _tab.parents('.js_first_tab').removeClass('js_first_tab');
                }
            }
            if ($('.js_first_tab').length > 0) {
                $('.js_first_tab li:first').trigger("click");
            }
            $(document).on('click', '.tab-navigation li a', function (e) {
                window.location.hash = $(this).attr("href");
            });
            $(document).on('click', '[data-product-card]', function (e) {
                e.preventDefault();
                var _this = $(this);
                if (_this.data('product-card') !== undefined) {
                    $.ajax({
                        type: 'get',
                        url: window.shop.urls.product_card + '/' + _this.data('product-card'),
                        success: function (card) {
                            _this.parents('[data-product]').replaceWith(card);
                        }
                    });
                }
            });

            $(document).on('click', '.header__mobile-icon .icon', function (e) {
                $('.header__mobile-menu').addClass('open');
            });

            $(document).on('click', '.header__mobile-icons .icon-search', function (e) {
                $('.header__search').addClass('open');
            });

            (function onHandlerMenu() {
                const categoryMenu = $('.header__mobile-category-menu');
                const titleMenu = $('.header__mobile-category-menu .header__mobile-title .title');
                let textMain = '';

                $('.header__mobile-bottom .header__menu-dropbtn').on('click', '.header__menu-dropdown', () => {
                    categoryMenu.addClass('open');
                    textMain = titleMenu.text();
                });

                $('.header__mobile-title').on('click', '.icon-arrow-long ', () => {
                    $('.menu__dropdown-list').removeClass('open');
                    titleMenu.text(textMain);
                    categoryMenu.removeClass('submenu');
                });
            })();

            $('.menu__dropdown-top .menu__dropdown-list').closest("li").addClass('menu__dropdown-wrapper');

            $(".menu__dropdown-top").on('click','.menu__dropdown-wrapper', function (evt) {
                let target = evt && evt.target || event.srcElement;
                if (target.tagName.toLowerCase() === 'a') return;

                $('.menu__dropdown-list').removeClass('open');
                $(this).find('.menu__dropdown-list').addClass('open');
                $(this).closest('.header__mobile-category-menu').addClass('submenu');
                $(this).closest('.header__mobile-category-menu').find('.header__mobile-title').find('.title').text($(this).find('>a').text());
            });

            $(document).on('click', '.header__mobile-title .icon-x-circle', function () {
                $('.header__mobile-menu').removeClass('open');
                $('.header__search').removeClass('open');
                $('.header__mobile-category-menu').removeClass('open');
            });

            $('.js_show_more').on('click', function (e) {
                e.preventDefault();
                var limit = $('[name=limit]').length && $('[name=limit]').val()
                    ? parseInt($('[name=limit]').val())
                    : window.shop.filters.limit;
                limit = parseInt(limit);
                window.shop.filters.offset = parseInt(window.shop.filters.offset);
                window.shop.filters.offset += limit;
                showMore($(this), $('.js-items'), ($('#filters').length > 0 ? getFiltersUrl() : ''));
                testWebP(function(supported) {
                    if(supported){
                        lazySrcset();
                    } else{
                        $('.lazy').Lazy();
                    }
                });
                setTimeout(function (i,e){
                    heightBlock();
                }, 500)

            });
            //--------------------------------- Shop logic ---------------------------------//
        },
        copyright: function () {
            var yearBlock = document.querySelector('.yearN'),
                yearNow = new Date().getFullYear().toString();
            if (yearNow.length) {
                yearBlock.innerText = yearNow;
            }
        },
        getBrowser: function () {
            var ua = navigator.userAgent;
            var bName = function () {
                if (ua.search(/Edge/) > -1) return "edge";
                if (ua.search(/MSIE/) > -1) return "ie";
                if (ua.search(/Trident/) > -1) return "ie11";
                if (ua.search(/Firefox/) > -1) return "firefox";
                if (ua.search(/Opera/) > -1) return "opera";
                if (ua.search(/OPR/) > -1) return "operaWebkit";
                if (ua.search(/YaBrowser/) > -1) return "yabrowser";
                if (ua.search(/Chrome/) > -1) return "chrome";
                if (ua.search(/Safari/) > -1) return "safari";
                if (ua.search(/maxHhon/) > -1) return "maxHhon";
            }();
            var version;
            switch (bName) {
                case "edge":
                    version = (ua.split("Edge")[1]).split("/")[1];
                    break;
                case "ie":
                    version = (ua.split("MSIE ")[1]).split(";")[0];
                    break;
                case "ie11":
                    bName = "ie";
                    version = (ua.split("; rv:")[1]).split(")")[0];
                    break;
                case "firefox":
                    version = ua.split("Firefox/")[1];
                    break;
                case "opera":
                    version = ua.split("Version/")[1];
                    break;
                case "operaWebkit":
                    bName = "opera";
                    version = ua.split("OPR/")[1];
                    break;
                case "yabrowser":
                    version = (ua.split("YaBrowser/")[1]).split(" ")[0];
                    break;
                case "chrome":
                    version = (ua.split("Chrome/")[1]).split(" ")[0];
                    break;
                case "safari":
                    version = ua.split("Safari/")[1].split("")[0];
                    break;
                case "maxHhon":
                    version = ua.split("maxHhon/")[1];
                    break;
            }
            var platform = 'desktop';
            if (/iphone|ipad|ipod|android|blackberry|mini|windows\sce|palm/i.test(navigator.userAgent.toLowerCase())) platform = 'mobile';
            var browsrObj;
            try {
                browsrObj = {
                    platform: platform,
                    browser: bName,
                    versionFull: version,
                    versionShort: version.split(".")[0]
                };
            } catch (err) {
                browsrObj = {
                    platform: platform,
                    browser: 'unknown',
                    versionFull: 'unknown',
                    versionShort: 'unknown'
                };
            }
            return browsrObj;
        },
    };
    genFunc.initialize();
    $(document).on("click", ".js_validate button[type=submit], .js_validate input[type=submit]", function () {
        var valid = validate($(this).parents(".js_validate"));
        if (valid == false) {
            return false;
        }
    });




    /*Function for same height end*/

    /*Function validate*/
    function validate(form) {
        var error_class = "error";
        var norma_class = "pass";
        var item = form.find("[required]");
        var e = 0;
        var reg = undefined;
        var pass = form.find('.password').val();
        var pass_1 = form.find('.password_1').val();
        var email = false;
        var password = false;
        var phone = false;

        function mark(object, expression) {
            if (expression) {
                object.parents('.input-field').addClass(error_class).removeClass(norma_class);
                if (email && (object.val().length > 0)) {
                    object.parents('.input-field').attr('data-error', 'Некорректный email');
                }
                if (password && (object.val().length > 0)) {
                    object.parents('.input-field').attr('data-error', 'Пароль должен быть не менее 6 символов');
                }
                if (pass_1 !== pass) {
                    object.parents('.input-field').attr('data-error', 'Пароли не совпадают');
                }
                if (phone && (object.val().length > 0)) {
                    object.parents('.input-field').attr('data-error', 'Некорректный формат телефона');
                }
                e++;
            } else
                object.parents('.input-field').addClass(norma_class).removeClass(error_class);
        }

        form.find("[required]").each(function () {
            switch ($(this).attr("data-validate")) {
                case undefined:
                    mark($(this), $.trim($(this).val()).length == 0);
                    break;
                case "email":
                    email = true;
                    reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
                    mark($(this), !reg.test($.trim($(this).val())));
                    email = false;
                    break;
                case "phone":
                    reg = /[0-9 -()+]{10}$/;
                    mark($(this), !reg.test($.trim($(this).val())));
                    break;
                case "pass":
                    password = true;
                    reg = /^[a-zA-Z0-9_-]{6,}$/;
                    mark($(this), !reg.test($.trim($(this).val())));
                    password = false;
                    break;
                case "pass1":
                    mark($(this), pass_1 !== pass || $.trim($(this).val()).length === 0);
                    break;
                default:
                    reg = new RegExp($(this).attr("data-validate"), "g");
                    mark($(this), !reg.test($.trim($(this).val())));
                    break;
            }
        });
        console.log(rating)
        form.find('.js_review-form').each(function (indx, rating) {
            console.log(rating)
            var i = 0;
            $(rating).find(".star").each(function (indx, star) {
                if ($(star).hasClass("active")) {
                    console.log("star have active");
                    i++;
                } else {
                    console.log("star have not active");
                }
            });
            if (i > 0) {
                $(this).addClass(norma_class).removeClass(error - input);
            } else {
                $(rating).addClass(error - input).removeClass(norma_class);
                e = 1;
            }
        });

        e += form.find("." + error_class).length;
        if (e == 0)
            return true;
        else {
            $('.js_alert_error').show();
            setTimeout(function () {
                $('.js_alert_error').hide();
            }, 4000);
            form.find('.error input:first').focus();
            return false;
        }
    }

    function showMore(self, elementToAppend, filtersUrl = null) {
        $.ajax({
            url     : window.shop.more_url + filtersUrl,
            data    : { offset : window.shop.filters.offset },
            dataType: "json",
            type    : "GET",
            success : function (data) {
                if (data.html) {

                    elementToAppend.append(data.html);
                    data.showMoreAvailable
                        ? self.removeClass('display-none')
                        : self.addClass('display-none');
                    ratySort();
                    if (document.querySelector('.category-product')) {
                        heightDescription('.category-product .prod-cart__descr');
                        heightDescription('.category-product .prod-cart__list');
                        heightDescription('.category-product .prod-cart__bottom');
                    }

                    testWebP(function(supported) {
                        if(supported){
                            lazySrcset();
                        } else{
                            $('.lazy').Lazy();
                        }
                    });
                    setTimeout(function (i,e){
                        heightBlock();
                    }, 500)
                }
            }
        });
    }
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    function E(selector, parent)
    {
        if(selector instanceof HTMLElement)
            return selector;

        return (parent || document).querySelectorAll(selector);
    }

    function hasClass(element, className)
    {
        return element.classList.contains(className);
    }

    function radioClass(element, className)
    {
        E("." + className).forEach((elem) => elem.classList.remove(className));

        element.classList.toggle(className);
    }

    function tabs(nav) {
        nav.each(function (index, value) {
            $($(value).find(">div")[0]).addClass('active');
            $($(value).find("+div>div")[0]).addClass('visible');

            $($(value).find("div")).on('click', function () {
                $($(value).find("div")).removeClass("active");
                $(this).addClass("active");
                $($(value).find("+div>div")).removeClass('visible');
                $($(value).find("+div>div")).eq($(this).index()).addClass('visible');

                if (document.querySelector('.category-product')) {
                    heightDescription('.category-product .prod-cart__descr');
                    heightDescription('.category-product .prod-cart__list');
                    heightDescription('.category-product .prod-cart__bottom');
                }
            });
        });
    }



    if($(".header__tabs").length) {
        tabs($(".header__tabs"));
    }

    $('.js-add-to-cart').on('click', function (evt) {
        var _count = parseInt($('.js_hidden').attr('data-count'));
        var orderedQty = parseInt($('.js-changeAmount').val()) ? parseInt($('.js-changeAmount').val()) : 1;
        evt.preventDefault();
        var that = $(this);
        $.ajax({
                   url:      $(this).data('href') + '/' + orderedQty,
                   data:     { warranty_id: $('.js-warranty:checked').attr('data-warranty-id')},
                   dataType: "json",
                   type:     $(this).data('method'),
                   success:  function (data) {
                       Swal.fire({
                                     title:             data.title,
                                     type:              "success",
                                     html:              data.content,
                                     footer:            data.footer,
                                     showConfirmButton: false
                                 });
                       $('.js-swal-close').on('click', function (e) {
                           e.preventDefault();
                           $('.swal2-close').trigger('click');
                       });
                       window.updateCartCounter(_count + orderedQty);
                       productCardAddingEvent.call(that, orderedQty);
                   }
               });
    });

    function productCardAddingEvent(orderedQty) {
        window.dataLayer = window.dataLayer || [];
        dataLayer.push({
            'ecommerce': {
                'currencyCode': 'UAH',
                'add': {
                    'products': [{
                        'name': $(this).data('name'),
                        'id': $(this).data('sku'),
                        'price': $(this).data('price'),
                        'brand': $(this).data('brand'),
                        'category': $(this).data('category'),
                        'quantity': orderedQty
                    }]
                }
            },
            'event': 'gtmUaEvent',
            'gtmUaEventCategory': 'Enhanced Ecommerce',
            'gtmUaEventAction': 'Adding a Product to a Shopping Cart',
            'gtmUaEventNonInteraction': 'True'
        });
    }

    window.updateWishlist = function ($obj, type, action) {
        const $wishlist = $('.js_wishlist_count');
        var wishlistCount = parseInt($wishlist.text());
        $.ajax({
            url: $obj.data(action),
            method: $obj.data('method'),
            success: function (data) {
                if (type === 'personal') {
                    wishlistCount--;
                    $obj.removeClass('active');
                    $obj.closest('.js_product').detach();
                    if(!$('.wish-list .js_product').length){
                        $('.wish-list.personal__tab-content').append(window.nothing_found);
                    }
                } else if (type === 'category' || type === 'product') {
                    if (action === 'put') {
                        if ($wishlist.length === 0) {
                            $('.js_wishlist_counter').html('<span class="preview-tip js_wishlist_count">1</span><span class="header__pannel-link icon icon-bookmarks"></span>');
                        }
                        $obj.addClass('active');
                        wishlistCount++;
                        $obj.data('remove', data.removeUrl);
                    } else {
                        wishlistCount--;
                        $obj.removeClass('active');
                    }
                }
                $wishlist.html(wishlistCount);
                setTimeout(function () {
                    Swal.fire({
                        'html': data.html,
                        'type': data.type,
                        'showConfirmButton': false,
                        'showCloseButton': true,
                        'allowEscapeKey': false
                    });
                }, 500);
            }
        });
    };

    window.updateWaitingList = function ($obj, type, action) {
        if(action === 'put' && $obj.hasClass('active')){
            Swal.fire({
                          'html': $obj.attr('data-inlist-message'),
                          'type': 'success',
                          'showConfirmButton': false,
                          'showCloseButton': true,
                          'allowEscapeKey': false
                      });
        } else {
            $.ajax({
                       url: $obj.data(action),
                       method: $obj.data('method'),
                       success: function (data) {
                           if (type === 'personal') {
                               $obj.parents('.js_product').remove();
                               if(!$('.waiting-list .js_product').length){
                                   $('.waiting-list.personal__tab-content').append(window.nothing_found);
                               }

                           } else if (type === 'category' || type === 'product') {
                               if (action === 'put') {
                                   $obj.addClass('active');
                                   $obj.data('remove', data.removeUrl);
                               } else {
                                   $obj.removeClass('active');
                               }
                           }
                           setTimeout(function () {
                               Swal.fire({
                                             'html': data.html,
                                             'type': data.type,
                                             'showConfirmButton': false,
                                             'showCloseButton': true,
                                             'allowEscapeKey': false
                                         });
                           }, 500);
                       }
                   });
        }
    };

    window.updateCompareList = function ($obj, type, action, counterDomElem) {
        let counter = parseInt(counterDomElem.text());
        let span    = counterDomElem.find('.counter');
        $.ajax({
                   url:     $obj.data(action),
                   method:  $obj.data('method'),
                   success: function success(data) {
                       if (action === 'put') {
                           if (span.length === 0) {
                               counterDomElem.prepend('<span class="preview-tip counter">1' + '</span>');
                               span = counterDomElem.find('counter');
                           }
                           counter++;
                           $obj.addClass('active');
                           $obj.data('remove', data.removeUrl);
                       } else {
                           counter--;
                           if (counter === 0) {
                               span.remove();
                           }
                           $obj.removeClass('active');
                       }
                       span.text(counter);
                       setTimeout(function () {
                           Swal.fire({
                                         'html':              data.html,
                                         'type':              data.type,
                                         'showConfirmButton': false,
                                         'showCloseButton':   true,
                                         'allowEscapeKey':    false,
                                     });
                       }, 500);
                   }
               });
    };

    window.updateCartCounter = function (qty) {
        var $element = $('.js-head-cart-items-count');
        $element.show();
        $element.attr('data-count', qty);
        $element.text(qty);
    };

    $('#js-register-link').on('click', function () {
        $('#registration').click();
    });

    $('#js-login-link').on('click', function () {
        $('#login').click();
    });

    $(document).on('click', '.js_toggle_in_сomparelist', function () {
        var $this = $(this);
        window.updateCompareList(
            $this,
            'product',
            $this.hasClass('active') ? 'remove' : 'put',
            $('.js-comparelist-link')
        );
    });
    $(document).on('click', '.js_toggle_in_wishlist', function () {
        var $this = $(this);
        window.updateWishlist(
            $this,
            $this.attr('data-type') ? $this.attr('data-type') : 'category',
            $this.hasClass('active') ? 'remove' : 'put'
        );
    });

})();

$(document).ready(function() {
    $('[name="phone"]').mask("+38 (099) 999 99 99", {autoclear: false});
    var _count = $('.js_hidden').attr('data-count');
    if(_count == 0)
    {
        $('.js_hidden').hide();
    }
    else {
        $('.js_hidden').text(_count);
    }
    for (let selector in window.jsvalidation) {
        $(selector).each(function () {
            $(this).validate({
                                 errorElement:   'div',
                                 errorClass:     'invalid-feedback',
                                 errorPlacement: function (error, element) {
                                     if (element.parent('.input-group').length ||
                                         element.prop('type') === 'checkbox' || element.prop('type') === 'radio') {
                                         error.insertAfter(element.parent());
                                         // else just place the validation message immediately after the input
                                     } else {
                                         error.insertAfter(element);
                                     }
                                 },
                                 highlight:      function (element) {
                                     $(element).closest('.form-control')
                                         .removeClass('is-valid').addClass('is-invalid'); // add the Bootstrap error class to the control group
                                 },
                                 ignore:         window.jsvalidation[selector].ignore,
                                 unhighlight:    function (element) {
                                     $(element).closest('.form-control')
                                         .removeClass('is-invalid').addClass('is-valid');
                                 },
                                 success:        function (element) {
                                     $(element).closest('.form-control')
                                         .removeClass('is-invalid').addClass('is-valid'); // remove the Boostrap error class from the control group
                                 },
                                 focusInvalid:   true, // do not focus the last invalid input
                                 // <?php if (Config::get('jsvalidation.focus_on_error')): ?>
                                 //     invalidHandler: function (form, validator) {
                                 //         if (!validator.numberOfInvalids())
                                 //             return;
                                 //
                                 //         $('html, body').animate({
                                 //                                     scrollTop: $(validator.errorList[0].element).offset().top
                                 //                                 }, <?= Config::get('jsvalidation.duration_animate') ?>);
                                 //         $(validator.errorList[0].element).focus();
                                 //
                                 //     },
                                 // <?php endif; ?>
                                 rules: window.jsvalidation[selector].rules
                             });
        });
    }
    if (_wW > 1024) {
        $(".scroll-menu__wrap").mCustomScrollbar({
            axis: "y",
            contentTouchScroll: true,
            documentTouchScroll: true,
            autoDraggerLength: true,
            scrollButtons: {
                enable: true
            },
            advanced: {
                updateOnContentResize: true,
                autoExpandHorizontalScroll: true
            },
            theme: 'dark',
            live: true,

        });
    }

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
/*Function for same height*/
window.addEventListener('load', function () {
    // if (_winWidth > 600) {
    //     heightBlockBlog();
    // }
    heightBlock();
});
window.addEventListener('orientationchange', function () {
    // if (_winWidth > 600) {
    //     heightBlockBlog();
    // }
    heightBlock();
});
$(window).on('resize', function () {
    // if (_winWidth > 600) {
    //     heightBlockBlog();
    // }
    heightBlock();
});

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
        $('.main').removeClass('not-hover');
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
document.addEventListener('DOMContentLoaded', function () {
    if (document.querySelector('.product-page')) {
        heightDescription('.product-page .prod-cart__descr');
        heightDescription('.product-page .prod-cart__bottom');
    }

    if (document.querySelector('.container-main')) {
        heightDescription('.container-main .prod-cart__descr');
        heightDescription('.container-main .prod-cart__list');
        heightDescription('.container-main .prod-cart__bottom');
    }

    if (document.querySelector('.benefits')) {
        heightDescription('.benefits .prod-cart__descr');
        heightDescription('.benefits .prod-cart__bottom');
    }
});

function setVisibleBlock(elem) {
    if (elem === ".header__menu .header__menu-dropdown") {
        $(".nav__menu-dropdown").removeClass('open').closest('.header__menu-item').find('.menu__dropdown').slideUp();
    } else {
        $(".header__menu-dropdown").removeClass('open').closest('.header__menu-item').find('.menu__dropdown').slideUp();
    }
}

function onHandlerToggle(elem) {
    $(elem).on('click', function () {
        setVisibleBlock(elem);

        if ($(this).hasClass('open')) {
            $(this).removeClass('open').closest('.header__menu-item').find('.menu__dropdown').slideUp();
        } else {
            $(this).addClass('open').closest('.header__menu-item').find('.menu__dropdown').slideDown();
        }
    });
}

onHandlerToggle(".header__menu .header__menu-dropdown");
onHandlerToggle(".nav__menu-dropdown");

$("#call-me").change(function() {
    if(this.checked) {
        $('#btn_callback').text($('#btn_callback').attr('data-checkbox-call_me'))
    } else {
        $('#btn_callback').text($('#btn_callback').attr('data-checkbox-send'))
    }
})

var profileHash = window.location.hash.replace("=", "");
if ("" !== profileHash && $('.personal').length){
    $("a[href='" + profileHash + "']").trigger("click");
}

$.fancybox.defaults.afterShow = function(){
    var fancyEmpty = $(document).find('.fancybox-slide');
    fancyEmpty.each(function (i,e) {
        if($(e).html() == ''){
            $(e).closest('.fancybox-container').remove();
        }
    })
};
$("[data-fancybox]").fancybox({
    touch:false
});
window.priceFormat = function (price){
    let total = new Intl.NumberFormat('ru-RU', { maximumFractionDigits : 1 }).format( parseFloat(price));
    return total.replace(',', '.');
}
$(window).scroll(function () {
    var top = $(this).scrollTop();
    if (top > 30) {
        $('.header').addClass('fixed');
    } else {
        $('.header').removeClass('fixed');
    }
});
$(window).on('load', function () {
    testWebP(function(supported) {
        if(supported){
            lazySrcset();
            setTimeout(function (i,e){
                heightBlock();
            }, 700)
        } else{
            $('.lazy').Lazy();
            setTimeout(function (i,e){
                heightBlock();
            }, 700)
        }
    });

});
function lazySrcset(){
    var srcsetItem = $('.lazy-srcset');
    srcsetItem.each(function (i,e){
        var srcset = $(e).attr('data-srcset');
        $(e).attr('srcset', srcset);
        $(e).removeAttr('data-srcset');
    })
}
function testWebP(callback) {
    var webP = new Image();
    webP.src = 'data:image/webp;base64,UklGRi4AAABXRUJQVlA4TCEAAAAvAUAAEB8wAiMw' +
        'AgSSNtse/cXjxyCCmrYNWPwmHRH9jwMA';
    webP.onload = webP.onerror = function () {
        callback(webP.height === 2);
    };
};
