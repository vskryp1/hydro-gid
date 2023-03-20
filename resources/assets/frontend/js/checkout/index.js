(function ($) {
    $(".js__map-toggle").on('click', function (e) {
        e.stopPropagation();
        e.preventDefault();
        $(this).closest(".checkout__radio-box").find(".delivery-map").slideToggle();
    });

})(jQuery);


