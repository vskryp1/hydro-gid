(function ($) {
    var _wW = $(window).width();
    $(document).ready(function () {
        if (_wW > 600) {
            $(".main-table").clone(true).appendTo('#table-scroll').addClass('clone');
        }
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
    }

    heightBlock();


    function myFunction() {
        var left = $('.mCSB_dragger').css("left");
        var item = $(document).find("#myBar");
        item.css("width", left);
    }


    if (_wW > 300) {
        $(".table-wrap").mCustomScrollbar({
            axis: "x",
            contentTouchScroll: true,
            documentTouchScroll: true,
            autoDraggerLength: true,
            mouseWheel: {

                invert: true
            },
            scrollButtons: {

                enable: true
            },
            advanced: {updateOnContentResize: true},
            theme: 'dark',
            live: true,
            callbacks: {
                whileScrolling: function () {
                    myFunction();
                }
            }

        });
        $("<div class='progress-container'><div id='myBar' class='progress-bar'></div></div>").appendTo($(".mCSB_draggerRail"));
    } else {
        $('.table-wrap').mCustomScrollbar("destroy");
    }


    $('.js-btn-close').click(function () {
        var index = $(this).parent('.col').index() + 1;
        $('table td:nth-child(' + index + '),table th:nth-child(' + index + ')').remove();
    });

    $(document).on('click', ".clone .filter-area input", function () {
        $(this).addClass("bred");

    });

    $(".clone input").on('click',function () {
        $(this).addClass("bred");
    });

    $('#js-difference').on('change', function () {
        $('.js-difference-label').toggleClass('checked');
        if ($(this).prop('checked')) {
            $('.js-filter').parent().each(function (key, filterRow) {
                var value      = null;
                var duplicates = true;
                $(filterRow).find('.js-filter-value').each(function (key, filterValueRow) {
                    var currentValue = $(filterValueRow).text();
                    if (!value) {
                        value = currentValue;
                    }
                    if (value !== currentValue) {
                        duplicates = false;
                        return false;
                    }
                });
                if (duplicates) {
                    $(filterRow).hide();
                } else {
                    $(filterRow).show();
                }
            })
        } else {
            $('.js-filter').parent().show();
        }
    });

    $('.js-btn-remove').on('click', function () {
        $.post($(this).data('action'), function(data){
            if(data.count == 0) {
                window.location.replace(window.compare_list_url);
            }
        });
    });

    $('.js-compare-delete').on('click', function (e) {
        e.preventDefault();
        $(this).parents('form').submit();
    })

})(jQuery);
