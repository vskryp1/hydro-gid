(function ($) {
    var _wW = $(window).width();
    var stickySidebar = $('.sticky');

    if (stickySidebar.length > 0 && _wW > 1030) {
        var stickyHeight = stickySidebar.height(),
            sidebarTop = stickySidebar.offset().top;
    }

    $(window).scroll(function () {
        if (stickySidebar.length > 0 && _wW > 1030) {
            var scrollTop = $(window).scrollTop();

            if (sidebarTop < scrollTop) {
                stickySidebar.css('top', scrollTop - sidebarTop + 10);

                var sidebarBottom = stickySidebar.offset().top + stickyHeight,
                    stickyStop = $('.sticky-container').offset().top + $('.sticky-container').height();
                if (stickyStop < sidebarBottom) {
                    var stopPosition = $('.sticky-container').height() - stickyHeight;
                    stickySidebar.css('top', stopPosition - 10);
                }
            } else {
                stickySidebar.css('top', '0');
            }
        }
    });

    $(window).resize(function () {
        if (stickySidebar.length > 0 && _wW > 1030) {
            stickyHeight = stickySidebar.height();
        }
    });

})(jQuery);