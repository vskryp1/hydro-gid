(function ($) {
    function testWebP(callback) {
        var webP = new Image();
        webP.src = 'data:image/webp;base64,UklGRi4AAABXRUJQVlA4TCEAAAAvAUAAEB8wAiMw' +
            'AgSSNtse/cXjxyCCmrYNWPwmHRH9jwMA';
        webP.onload = webP.onerror = function () {
            callback(webP.height === 2);
        };
    };

    function itemProdHeight(){
        if($('.item-prod').length){
            $('.prod-cart').each(function (i,e) {
                var prodHeight = $(e).outerHeight();
                $(e).closest('.item-prod').css('min-height', prodHeight);
            });
        }
    }
    function heightBlock() {
        $('.js_height-block').each(function (i, e) {
                let elH = e.getElementsByClassName("height");
                let maxHeight = 0;

                for (let i = 0; i < elH.length; ++i) {
                    elH[i].style.height = "";
                    if (maxHeight < elH[i].clientHeight) {
                        maxHeight = elH[i].clientHeight;
                    }
                }
                for (let i = 0; i < elH.length; ++i) {
                    elH[i].style.height = maxHeight + "px";
                }
            }
        )
        itemProdHeight();
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
    $('.tab-navigation li').on('click', function () {
        setTimeout(()=> {
            heightBlock();
        },100)
    });

    $('.filter-item a').click(function() {
        $('input:checked').prop('checked', false);
        showFilterSearch($(this) ,$('.js-items'));
    });

    $('.filter-item input').on('click', function (event) {
        showFilterSearch($(this) ,$('.js-items'));
    });

    function showFilterSearch(self, elementToAppend) {
        var items = [];
        items = $('.filter-area input[type="checkbox"]:checked').map(function() {
            return '&category[]=' + $(this).attr('id');
        }).get();

        window.shop.more_url = window.shop.more_url.replace(/(&category.*)/g, '') + items.join('');
        window.shop.filters.offset = 0;

        $.ajax({
            url: window.shop.more_url,
            dataType: 'json',
            type: 'GET',
            success: function (data) {
                data.showMoreAvailable
                ? $('.js_show_more').removeClass('display-none')
                : $('.js_show_more').addClass('display-none');
                elementToAppend.children().not('.list-menu').remove();
                elementToAppend.append(data.html);
                testWebP(function(supported) {
                //    if(supported){
                //        lazySrcset();
                 //   } else{
                        $('.lazy').Lazy();
                //    }
                });
                setTimeout(function() {
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
})(jQuery);
