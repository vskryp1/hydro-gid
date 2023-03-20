(function ($) {
    //jcarousel
    var jcarousel = $('.jcarousel').jcarousel();

    $('.jcarousel-control-prev')
        .on('jcarouselcontrol:active', function () {
            $(this).removeClass('inactive');
        })
        .on('jcarouselcontrol:inactive', function () {
            $(this).addClass('inactive');
        })
        .jcarouselControl({
            target: '-=1'
        });

    $('.jcarousel-control-next')
        .on('jcarouselcontrol:active', function () {
            $(this).removeClass('inactive');
        })
        .on('jcarouselcontrol:inactive', function () {
            $(this).addClass('inactive');
        })
        .jcarouselControl({
            target: '+=1'
        });
})(jQuery);

if(window.custom_var !== undefined && window.custom_var.orders_labels !== undefined) {
    var ctx = document.getElementById("chart_orders");
    var lineChart = new Chart(ctx, {
        type: 'line',
        responsive: true,
        legend: {
            display: true,
            position: 'right',
        },
        data: {
            labels: window.custom_var.orders_labels,
            datasets: window.custom_var.orders_data
        },
    });
}