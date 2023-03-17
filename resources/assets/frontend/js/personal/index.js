(function ($) {
    $('.personal__reviews-item').on('click', function () {
        $(this).next(".personal__reviews-component").slideToggle();
        $(this).toggleClass('active');
    });

    $('.js_put_in_waitinglist').on('click', function () {
        var $this = $(this);
        window.updateWaitingList($this, 'category', 'put');
    });

    $('.js_remove_from_waitinglist').on('click', function () {
        var $this = $(this);
        window.updateWaitingList($this, 'personal', 'remove');
    });

    if ($('.delivery-select').length) {
        initSelect2City($('.delivery-select'));
    }

})(jQuery);

(changeAttrSelect = (thisForm, attr) => {
    $(thisForm).find('select').prop("disabled", attr);
})(1);

// Account data edit
function toggleButtonDelete(el) {
    $(el).closest('form').find('input').each(function () {
        if ($(this).is('[readonly]')) {
            $(this).removeAttr('readonly');
        } else {
            $(this).attr('readonly', true);
        }
    });
}

$(document).on('click','[data-block-save] button', function () {
    let thisForm = $(this).closest('form');
    $(this).closest("form").find('[data-block-edit]').show();
    $(this).closest("form").find('.per_edit').hide();
    $(this).closest("form").next().show();
    changeAttrSelect(thisForm,1);
    toggleButtonDelete(this);
});

$(document).on('click', '[data-block-edit] button.edit-btn', function () {
    let thisForm = $(this).closest('form');

    $(this).closest("form").find('[data-block-edit]').hide();
    $(this).closest("form").find('.per_edit').show();
    $(this).closest("form").next().hide();
    changeAttrSelect(thisForm,0);
    toggleButtonDelete(this);
});


$('.js-menuOpen').on('click', function() {
    $('.personal__tabs').slideToggle();
});



$(".personal_table").on('click','.more', function(event) {
    let target = event.target;

    if(target.tagName.toLocaleLowerCase() !== 'button') {
        event.preventDefault();
        let countOpen = $(this).data('open');
        $(this).toggleClass('active');
        $(".more_open_" + countOpen).toggle();
    }
});

$(".personal_table").on('click','.more-history', function(event) {
    event.preventDefault();
    let countOpen = $(this).data('open');
    $(this).toggleClass('active');
    $(".more_history_open_" + countOpen).toggle();
});
$('.js_location-btn .main-btn--green').on('click', function(event){
    event.preventDefault();
    var url = $(this).attr('href');
    window.open(url);
});
 switchBlocks = () => {
    const firstName = document.getElementById('firstName');
    const secondName = document.getElementById('secondName');
    const companyName = document.getElementById('companyName');
    const code = document.getElementById('code');

    firstName.insertAdjacentElement('afterend', secondName);
    companyName.insertAdjacentElement('afterend', code);
};

window.onresize = () => {
    if (window.innerWidth <= 768 && document.getElementById('firstName')) switchBlocks();
};

function initSelect2City(select2Element) {
    let initData = {
        width: '100%'
    };
    initData.minimumInputLength = 3;
    initData.placeholder = {
        id: 0,
        text: window.translates.search
    };
    initData.ajax = {
        delay: 250,
        url: select2Element.data('url'),
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
    };
    select2Element.select2(initData);
}

const orderItem = document.querySelector('#orders');
if  (orderItem.classList.contains('active') ) orderItem.click();
